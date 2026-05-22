<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Vehicule;
use App\Models\Location; // Important pour la validation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PanierController extends Controller
{
    // --- 1. AFFICHER LE PANIER ---
    public function index()
    {
        if (Auth::guard('client')->check()) {
            $paniers = Panier::where('client_id', Auth::guard('client')->id())
                             ->with('vehicule.category', 'agenceDepart', 'agenceRetour')
                             ->get();
        } else {
            $paniers = Panier::where('session_id', Session::getId())
                             ->with('vehicule.category', 'agenceDepart', 'agenceRetour')
                             ->get();
        }

        $totalGeneral = $paniers->sum('prix_total');

        return view('panierV', compact('paniers', 'totalGeneral'));
    }

    // --- 2. AJOUTER AU PANIER ---
    public function store(Request $request)
    {
        // 1. Infos de base (Dates par défaut si non fournies dans la session)
        $dateDepart = session('search_date_debut') ?? now()->addDay();
        $dateRetour = session('search_date_fin') ?? now()->addDays(3);
        $agenceDepart = session('search_agence_depart') ?? 1; 
        $agenceRetour = session('search_agence_retour') ?? 1; 

        // 2. Récupérer le véhicule
        $vehicule = Vehicule::with('category')->find($request->input('vehicule_id'));

        if (!$vehicule) {
            return back()->with('error', 'Véhicule introuvable.');
        }

        // 3. Calcul du prix
        $start = Carbon::parse($dateDepart);
        $end = Carbon::parse($dateRetour);
        $jours = $start->diffInDays($end) ?: 1; 
        
        $tarif = $vehicule->category->tarifjournee ?? 50; 
        $prixTotal = $tarif * $jours;

        // 4. Préparer les données
        $data = [
            'vehicule_id' => $vehicule->id,
            'agence_depart_id' => $agenceDepart,
            'agence_retour_id' => $agenceRetour,
            'date_depart' => $start,
            'date_retour' => $end,
            'prix_total' => $prixTotal,
        ];

        // 5. Lier au Client ou Session
        if (Auth::guard('client')->check()) {
            $data['client_id'] = Auth::guard('client')->id();
        } else {
            $data['session_id'] = Session::getId();
        }

        // 6. Créer
        Panier::create($data);

        return back()->with('cart_updated', true);
    }

    // --- 3. SUPPRIMER DU PANIER ---
    public function destroy($id)
    {
        $panier = Panier::findOrFail($id);
        
        if (Auth::guard('client')->check()) {
            if($panier->client_id != Auth::guard('client')->id()) abort(403);
        } else {
            if($panier->session_id != Session::getId()) abort(403);
        }

        $panier->delete();
        return back()->with('success', 'Supprimé du panier.');
    }

    // --- 4. VALIDER LA COMMANDE (TRANSFORMER EN LOCATION) ---
    public function validerCommande(Request $request)
    {
        // 1. Vérifier si connecté
        if (!Auth::guard('client')->check()) {
            // Sauvegarder l'url pour rediriger après login
            session(['url.intended' => route('panier.index')]);
            return redirect()->route('client.login.form')->with('error', 'Veuillez vous connecter pour valider votre réservation.');
        }

        $clientId = Auth::guard('client')->id();
        
        // 2. Récupérer le panier
        $paniers = Panier::where('client_id', $clientId)->with('vehicule.category')->get();

        if ($paniers->isEmpty()) {
            return back()->with('error', 'Votre panier est vide.');
        }

        // 3. Récupérer les dates du formulaire (envoyées par Flatpickr)
        $dateDebut = $request->input('date_depart');
        $dateFin = $request->input('date_retour');

        if (!$dateDebut || !$dateFin) {
            return back()->with('error', 'Veuillez sélectionner vos dates.');
        }

        // 4. Boucle : Créer chaque location
        foreach ($paniers as $item) {
            
            // On recalcule le prix final basé sur les dates choisies dans le formulaire
            $start = Carbon::parse($dateDebut);
            $end = Carbon::parse($dateFin);
            $jours = $start->diffInDays($end) ?: 1;
            
            // Prix unitaire du véhicule
            $prixUnitaire = $item->vehicule->category->tarifjournee ?? 50;
            $montantFinal = $prixUnitaire * $jours;

            Location::create([
                'datesignature'  => now(),
                'dateheuredebut' => $dateDebut,
                'dateheurefin'   => $dateFin,
                'montantfacture' => $montantFinal,
                'vehicule_id'    => $item->vehicule_id,
                'client_id'      => $clientId,
                'agence_id'      => $item->agence_depart_id,
                'nbkmdebut'      => 0, 
            ]);
        }

        // 5. Vider le panier
        Panier::where('client_id', $clientId)->delete();

        // 6. Rediriger vers l'historique
        return redirect()->route('client.locations')->with('success', 'Félicitations ! Votre réservation est confirmée.');
    }
}