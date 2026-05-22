<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agence;
use App\Models\Vehicule;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationInscription; 

class AgenceController extends Controller
{
    // 1. PAGE D'ACCUEIL
    public function index()
    {
        $agences = Agence::with('jours')->get(); 
        $vehicules = Vehicule::with('agence', 'category.genre')->get(); 
        return view('indexV', compact('agences', 'vehicules'));
    }

    // 2. DÉTAILS D'UN VÉHICULE
    public function showVehiculeDetails(int $id)
    {
        $vehicule = Vehicule::with('agence', 'category.genre', 'category.attribut_categories.attribut')->find($id);
        if (!$vehicule) {
            return redirect()->route('home')->with('error', 'Véhicule non trouvé.');
        }
        return view('vehicule_detailsV', compact('vehicule'));
    }

    // 3. DÉTAILS D'UNE AGENCE
    public function details($id)
    {
        $agence = Agence::with(['jours', 'vehicules.category'])->findOrFail($id);
        return view('agence_detailsV', ['agence' => $agence]);
    }

    // 4. LISTE DE TOUTES LES AGENCES
    public function listeAgences()
    {
        $agences = Agence::all(); 
        return view('agences_listV', compact('agences'));
    }

    // 5. FORMULAIRE DE RECHERCHE
    public function searchForm()
    {
        $agences = Agence::all(['id', 'nom', 'ville']);
        $genres = Genre::all(['id', 'libelle']);
        $categories = Category::all(['id', 'libelle']);
        return view('location_search_formV', compact('agences', 'genres', 'categories'));
    }

    // 6. TRAITEMENT DE LA RECHERCHE
    public function searchAvailableVehicules(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date_format:Y-m-d H:i',
            'date_fin' => 'required|date_format:Y-m-d H:i|after:date_debut',
            'agence_id' => 'sometimes|nullable|exists:agences,id',
            'pickup_location' => 'sometimes|nullable|string|max:255',
            'genre_id' => 'sometimes|nullable|exists:genres,id',
            'categorie_id' => 'sometimes|nullable|exists:categories,id',
        ]);

        $dateDebut = Carbon::parse($request->input('date_debut'));
        $dateFin = Carbon::parse($request->input('date_fin'));

        // a. Véhicules occupés
        $vehiculesOccupesIds = Location::where(function ($query) use ($dateDebut, $dateFin) {
                $query->where('dateheuredebut', '<', $dateFin) 
                      ->where('dateheurefin', '>', $dateDebut); 
            })->pluck('vehicule_id');

        // b. Base de la requête (véhicules disponibles)
        $vehiculesDisponibles = Vehicule::whereNotIn('id', $vehiculesOccupesIds)
            ->with(['agence', 'category.genre']);

        // c. FILTRE TYPE (Voiture vs Utilitaire)
        if ($request->filled('type_vehicule')) {
            $type = $request->input('type_vehicule'); 
            $motCle = ($type === 'utilitaire') ? 'Utilitaire' : 'Tourisme'; 
            
            $vehiculesDisponibles->whereHas('category.genre', function($q) use ($motCle) {
                $q->where('libelle', 'LIKE', "%{$motCle}%");
            });
        }

        // d. FILTRE LOCALISATION
        if ($request->filled('agence_id')) {
            $vehiculesDisponibles->where('agence_id', $request->input('agence_id'));
        } elseif ($request->filled('pickup_location')) {
            $search = $request->input('pickup_location');
            $vehiculesDisponibles->whereHas('agence', function($q) use ($search) {
                $q->where('ville', 'LIKE', "%{$search}%")
                  ->orWhere('nom', 'LIKE', "%{$search}%")
                  ->orWhere('cp', 'LIKE', "%{$search}%");
            });
        }

        // e. Autres filtres
        if ($request->filled('categorie_id')) {
            $vehiculesDisponibles->where('categorie_id', $request->input('categorie_id'));
        } elseif ($request->filled('genre_id')) {
            $vehiculesDisponibles->whereHas('category', function($q) use ($request) {
                $q->where('genre_id', $request->input('genre_id'));
            });
        }

        $resultats = $vehiculesDisponibles->get();

        return view('location_resultsV', compact('resultats', 'dateDebut', 'dateFin'));
    }

    // 7. API RECHERCHE HOMEPAGE (AJAX)
    public function searchHomeVehicules(Request $request)
    {
        $search = $request->query('ville');
        
        // 1. Chercher l'agence correspondante
        $agence = Agence::where('ville', 'LIKE', "%{$search}%")
                        ->orWhere('nom', 'LIKE', "%{$search}%")
                        ->first();

        // 2. Si aucune agence trouvée
        if (!$agence) {
            return response()->json([
                'found' => false,
                'message' => 'Aucune agence trouvée dans ce secteur.',
                'suggestions' => ['Mâcon', 'Chalon sur Saône']
            ]);
        }

        // 3. Si agence trouvée, récupérer ses véhicules disponibles
        $vehicules = Vehicule::where('agence_id', $agence->id)
                             ->with(['category.genre'])
                             ->limit(9)
                             ->get();

        if ($vehicules->isEmpty()) {
            return response()->json([
                'found' => false,
                'message' => 'Aucun véhicule disponible dans cette agence pour le moment.',
                'suggestions' => ['Mâcon', 'Chalon sur Saône']
            ]);
        }

        // 4. Formater les données pour le JS
        $results = $vehicules->map(function($v) {
            $imgName = $v->category->photo ?? 'default.jpg'; 
            $imagePath = asset("images/{$imgName}");

            return [
                'id' => $v->id,
                't' => $v->marque . ' ' . $v->modele,
                'c' => $v->category->libelle ?? 'Catégorie inconnue',
                'p' => $v->category->tarifjournee ?? '??',
                'i' => $imagePath,
                'tp' => str_contains(strtolower($v->category->genre->libelle ?? ''), 'utilitaire') ? 'utilitaire' : 'voiture'
            ];
        });

        return response()->json([
            'found' => true,
            'vehicles' => $results
        ]);
    }
    
    // 8. GESTION NEWSLETTER (UNIQUE VERSION)
   // Fonction pour s'inscrire au CLUB
    public function subscribeClub(Request $request)
    {
        // 1. Validation
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            // 2. Envoi du mail réel via SMTP
            // On passe "Club ADA Premium" comme contexte pour l'affichage dans le mail
            Mail::to($request->email)->send(new ConfirmationEmail('Club ADA Premium'));

            // 3. Réponse succès au JS
            return response()->json(['success' => true, 'message' => 'Email envoyé avec succès']);

        } catch (\Exception $e) {
            // 4. Gestion erreur
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Fonction pour la NEWSLETTER (similaire)
    public function subscribeNewsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            Mail::to($request->email)->send(new ConfirmationEmail('Newsletter'));
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}