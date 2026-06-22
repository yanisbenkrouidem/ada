<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Vehicule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    // --- 1. REDIRECTION VERS LE DASHBOARD UNIFIÉ ---
    // Cette fonction ne sert plus à afficher la vue, mais à rediriger
    // vers le nouveau controller principal (ClientController@showProfile)
    public function mesLocations()
    {
        // Vérification de connexion
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login.form');
        }

        // On redirige vers la route qui affiche le nouveau dashboard unifié
        // Assure-toi que la route s'appelle bien 'client.profile' dans web.php
        return redirect()->route('client.profile'); 
    }

    // --- 2. TERMINER UN VOYAGE (STOP) ---
    // Cette fonction reste utile pour l'action du bouton "Restituer"
    public function stop($id)
    {
        $location = Location::findOrFail($id);

        if ($location->client_id != Auth::guard('client')->id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        $location->update([
            'dateheurefinreel' => now(),
            'nbkmfin' => 0 
        ]);

        // Le 'back()' renverra l'utilisateur sur le dashboard
        return back()->with('success', 'Véhicule restitué avec succès.');
    }

    // --- 3. ANNULER UNE RÉSERVATION ---
    // Cette fonction reste utile pour l'action du bouton "Annuler"
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        if ($location->client_id != Auth::guard('client')->id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        $location->delete();

        return back()->with('success', 'Réservation annulée.');
    }

    // --- 4. COMPATIBILITÉ (ANCIENS LIENS) ---
    
    public function create(Request $request, $id)
    {
        if (!Session::has('client_id')) {
             session(['url.intended' => url()->full()]);
             return redirect()->route('client.login.form');
        }
        
        $vehicule = Vehicule::with('agence', 'category')->findOrFail($id);
        
        $date_debut = $request->query('date_debut');
        $date_fin   = $request->query('date_fin');
        $prixTotal = 0;
        $nbJours = 0;

        return view('bookings.create', compact('vehicule', 'date_debut', 'date_fin', 'prixTotal', 'nbJours'));
    }

    public function reserver(Request $request, $vehicule_id)
    {
        // Redirige vers le dashboard unifié après réservation
        return redirect()->route('client.profile')->with('success', 'Réservation effectuée !');
    }
}
