<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Location; // Modèle Location nécessaire ici
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // --- 1. AUTHENTIFICATION ---

    public function showLoginForm()
    {
        return view('client_login_formV');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'motpasse' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->motpasse 
        ];

        if (Auth::guard('client')->attempt($credentials)) {
            $request->session()->regenerate();
            
            $client = Auth::guard('client')->user();
            
            Session::put('client_id', $client->id);
            Session::put('client_email', $client->email);
            Session::put('client_nom', strtoupper($client->nom) . ' ' . ucfirst(strtolower($client->prenom)));

            return redirect()->route('home')->with('success', 'Connexion réussie !');
        }

        return back()->with('error', 'Email ou mot de passe incorrect.');
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        Session::forget(['client_id', 'client_email', 'client_nom']);
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('home')->with('success', 'Déconnexion réussie.');
    }

    // --- 2. INSCRIPTION ---

    public function showRegisterForm()
    {
        return view('client_register_formV');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom'       => 'required|string|max:50',
            'prenom'    => 'required|string|max:50',
            'email'     => 'required|email|unique:clients,email',
            'telephone' => 'required|string',
            'motpasse'  => 'required|min:6',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'motpasse.min' => 'Le mot de passe doit faire au moins 6 caractères.'
        ]);

        try {
            $clientId = DB::table('clients')->insertGetId([
                'nom' => strtoupper($request->nom),
                'prenom' => ucfirst(strtolower($request->prenom)),
                'email' => $request->email,
                'telephone' => $request->telephone,
                'motpasse' => Hash::make($request->motpasse),
                'newsletter_optin' => 0,
                'sms_optin' => 0
            ]);

            $client = Client::find($clientId);
            Auth::guard('client')->login($client);
            
            Session::put('client_id', $client->id);
            Session::put('client_nom', strtoupper($client->nom) . ' ' . ucfirst(strtolower($client->prenom)));

            return redirect()->route('home')->with('success', 'Compte créé avec succès ! Bienvenue.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', "Erreur lors de l'inscription : " . $e->getMessage());
        }
    }

    // --- 3. DASHBOARD UNIFIÉ (PROFIL + LOCATIONS + GAMIFICATION) ---

   public function showProfile() 
{
    if (!Auth::guard('client')->check()) return redirect()->route('client.login.form');

    $client = Auth::guard('client')->user();

    // 1. LOCATIONS
    $locations = Location::where('client_id', $client->id)
                         ->with(['vehicule.category', 'agence'])
                         ->orderBy('dateheuredebut', 'desc')
                         ->get();

    // 2. DONNÉES BASIQUES
    $cards = DB::getSchemaBuilder()->hasTable('client_cards') ? DB::table('client_cards')->where('client_id', $client->id)->get() : collect([]);
    $family = DB::getSchemaBuilder()->hasTable('client_family') ? DB::table('client_family')->where('client_id', $client->id)->get() : collect([]);
    
    // 3. LOGIQUE STATUT & AVANTAGES (NOUVEAU)
    $locationsCount = $locations->count();
    $points = $locationsCount * 150;

    // Définition des paliers et avantages
    $tiersDefinition = [
        'Membre' => [
            'limit' => 0, 
            'benefits' => ['Accès standard', 'Service client digital']
        ],
        'Silver' => [
            'limit' => 1000, 
            'benefits' => ['-5% sur les locations', 'Conducteur additionnel offert']
        ],
        'Gold' => [
            'limit' => 3000, 
            'benefits' => ['-10% sur les locations', 'Surclassement (selon dispo)', 'Annulation gratuite J-1']
        ],
        'Platinum' => [
            'limit' => 6000, 
            'benefits' => ['-15% sur les locations', 'Véhicule livré à domicile', 'Conciergerie 24/7', 'Accès prioritaire agence']
        ]
    ];

    // Calcul du statut actuel
    $statut = 'Membre';
    $nextTierName = 'Silver';
    $nextTierLimit = 1000;

    foreach ($tiersDefinition as $name => $data) {
        if ($points >= $data['limit']) {
            $statut = $name;
        }
    }

    // Calcul du prochain palier
    $keys = array_keys($tiersDefinition);
    $currentIndex = array_search($statut, $keys);
    if ($currentIndex < count($keys) - 1) {
        $nextTierName = $keys[$currentIndex + 1];
        $nextTierLimit = $tiersDefinition[$nextTierName]['limit'];
    } else {
        $nextTierName = null; // Niveau Max
    }

    // 4. SCORE PROFIL
    $score = 0; $maxScore = 5; $objectives = [];
    if(!empty($client->telephone) && !empty($client->adresse)) { $score++; } else { $objectives[] = "Compléter adresse"; }
    if($client->newsletter_optin) { $score++; } else { $objectives[] = "Newsletter"; }
    if($client->sms_optin) { $score++; } else { $objectives[] = "Alertes SMS"; }
    if($cards->count() > 0) { $score++; } else { $objectives[] = "Ajouter CB"; }
    if($family->count() > 0) { $score++; } else { $objectives[] = "Ajouter conducteur"; }
    $progress = ($maxScore > 0) ? ($score / $maxScore) * 100 : 0;

    return view('client.dashboard', compact(
        'client', 'locations', 'locationsCount', 'points', 'statut', 
        'progress', 'cards', 'family', 'objectives', 
        'tiersDefinition', 'nextTierName', 'nextTierLimit' // On passe ces nouvelles variables
    ));
}
    
    public function updateProfile(Request $request) 
    {
        $client = Auth::guard('client')->user();
        
        DB::table('clients')->where('id', $client->id)->update([
            'nom' => strtoupper($request->nom),
            'prenom' => ucfirst(strtolower($request->prenom)),
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'cp' => $request->cp, 
            'ville' => $request->ville,
        ]);
        
        Session::put('client_nom', strtoupper($request->nom) . ' ' . ucfirst(strtolower($request->prenom)));
        
        return back()->with('success', 'Profil mis à jour !');
    }

    // --- 4. FLOTTE & RECHERCHE ---

    public function touteLaFlotte(Request $request)
    {
        $query = Vehicule::with(['category', 'agence']);

        if ($request->has('type_vehicule')) {
            $type = $request->type_vehicule;
            if ($type === 'voiture') {
                $query->whereHas('category', function($q) { $q->where('genre_id', 15); });
            } elseif ($type === 'utilitaire') {
                $query->whereHas('category', function($q) { $q->where('genre_id', 17); });
            }
        }

        if ($request->filled('pickup_location')) {
            $lieu = $request->pickup_location;
            $query->whereHas('agence', function($q) use ($lieu) {
                $q->where('ville', 'LIKE', "%{$lieu}%")
                  ->orWhere('nom', 'LIKE', "%{$lieu}%");
            });
        }

        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $start = $request->date_debut;
            $end = $request->date_fin;
            $query->whereDoesntHave('locations', function($q) use ($start, $end) {
                $q->where('dateheuredebut', '<=', $end)
                  ->where('dateheurefin', '>=', $start);
            });
        }

        $vehicules = $query->get();
        return view('fleetV', ['vehicules' => $vehicules, 'title' => 'Notre Flotte']);
    }

    public function vehiculesParCategorie($id)
    {
        $categorie = DB::table('categories')->where('id', $id)->first();

        if (!$categorie) {
            return redirect()->route('vehicules.flotte')->with('error', 'Catégorie introuvable.');
        }

        $vehicules = Vehicule::with(['category', 'agence'])
            ->where('categorie_id', $id)
            ->get();

        return view('fleetV', [
            'vehicules' => $vehicules,
            'title' => 'Catégorie : ' . $categorie->libelle
        ]);
    }

    // Note : J'ai supprimé l'ancienne fonction 'mesLocations' de ce fichier
    // car elle faisait doublon et est maintenant gérée par showProfile.
    
    // --- ACTIONS DIVERSES ---
    public function updatePreferences(Request $request) { 
        $client = Auth::guard('client')->user();
        DB::table('clients')->where('id', $client->id)->update([
            'newsletter_optin' => $request->has('newsletter_optin') ? 1 : 0,
            'sms_optin' => $request->has('sms_optin') ? 1 : 0
        ]);
        return back()->with('success', 'Préférences mises à jour'); 
    }

    public function addCard(Request $request) { return back()->with('success', 'Carte ajoutée (Simulation)'); }
    public function removeCard($id) { return back()->with('success', 'Carte supprimée'); }
    public function addFamilyMember(Request $request) { return back()->with('success', 'Membre ajouté (Simulation)'); }
    public function removeFamilyMember($id) { return back()->with('success', 'Membre supprimé'); }
}