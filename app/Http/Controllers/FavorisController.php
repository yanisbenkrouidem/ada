<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    // Affiche la page des favoris
    public function index()
    {
        $clientId = session('client_id'); // Ou Auth::guard('client')->id();
        
        $favoris = DB::table('favoris')
            ->join('vehicules', 'favoris.vehicule_id', '=', 'vehicules.id')
            ->join('categories', 'vehicules.categorie_id', '=', 'categories.id')
            ->where('favoris.client_id', $clientId)
            ->select('vehicules.*', 'categories.libelle as categorie_libelle', 'categories.photo', 'categories.tarifjournee')
            ->get();

        return view('client.wishlist', ['vehicules' => $favoris]);
    }

    // Ajoute ou supprime un favori (AJAX)
    public function toggle(Request $request)
    {
        $clientId = session('client_id');
        $vehiculeId = $request->input('vehicule_id');

        if (!$clientId) {
            return response()->json(['status' => 'error', 'message' => 'Non connecté'], 401);
        }

        $exists = DB::table('favoris')
            ->where('client_id', $clientId)
            ->where('vehicule_id', $vehiculeId)
            ->exists();

        if ($exists) {
            DB::table('favoris')
                ->where('client_id', $clientId)
                ->where('vehicule_id', $vehiculeId)
                ->delete();
            $action = 'removed';
        } else {
            DB::table('favoris')->insert([
                'client_id' => $clientId,
                'vehicule_id' => $vehiculeId
            ]);
            $action = 'added';
        }

        return response()->json(['status' => 'success', 'action' => $action]);
    }
}
