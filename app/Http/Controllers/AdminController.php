<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    // 1. DASHBOARD
    public function index()
    {
        // Chiffres Clés
        $totalRevenue = DB::table('locations')->sum('montantfacture');
        $rentalsThisMonth = DB::table('locations')
            ->whereMonth('dateheuredebut', Carbon::now()->month)
            ->whereYear('dateheuredebut', Carbon::now()->year)
            ->count();
        $totalClients = DB::table('clients')->count();

        // Feedbacks
      // Dans AdminController.php, assure-toi d'avoir cette ligne :
$feedbacks = DB::table('feedbacks')->orderBy('created_at', 'desc')->limit(5)->get();
        $ratingsMap = ['Excellent' => 5, 'Good' => 4, 'Average' => 3, 'Needs improvement' => 2, 'Poor' => 1];
        $totalScore = 0; $count = 0;
        foreach(DB::table('feedbacks')->get() as $f) {
            if(isset($ratingsMap[$f->rating])) { $totalScore += $ratingsMap[$f->rating]; $count++; }
        }
        $averageNote = $count > 0 ? round($totalScore / $count, 1) : 0;

        // Top Véhicules (Version Compatible SQL Strict)
        $topVehicules = DB::table('locations')
            ->join('vehicules', 'locations.vehicule_id', '=', 'vehicules.id')
            ->join('categories', 'vehicules.categorie_id', '=', 'categories.id')
            ->select(
                'vehicules.id', 'vehicules.marque', 'vehicules.modele', 'vehicules.immat',
                'categories.libelle as categorie_nom', 'categories.tarifjournee', 'categories.photo',
                DB::raw('count(locations.id) as total_locations'),
                DB::raw('sum(locations.montantfacture) as revenu_genere')
            )
            ->groupBy('vehicules.id', 'vehicules.marque', 'vehicules.modele', 'vehicules.immat', 'categories.libelle', 'categories.tarifjournee', 'categories.photo')
            ->orderByDesc('total_locations')
            ->limit(5)
            ->get();

        foreach($topVehicules as $v) {
            $isRented = DB::table('locations')->where('vehicule_id', $v->id)
                ->where('dateheuredebut', '<=', Carbon::now())
                ->where('dateheurefin', '>=', Carbon::now())->exists();
            $v->statut = $isRented ? 'Louée' : 'Disponible';
        }

        // Graphique
        $chartData = []; $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('D');
            $chartData[] = DB::table('locations')->whereDate('dateheuredebut', $date->format('Y-m-d'))->sum('montantfacture');
        }

        $stats = [
            'revenue' => $totalRevenue, 'rentals_month' => $rentalsThisMonth, 'rental_growth' => 0,
            'total_clients' => $totalClients, 'average_rating' => $averageNote,
            'chart_labels' => $chartLabels, 'chart_data' => $chartData
        ];

        return view('admin.dashboard', compact('feedbacks', 'stats', 'topVehicules'));
    }

    // 2. PAGE VÉHICULES
    public function vehicules()
    {
        $vehicules = DB::table('vehicules')
            ->join('categories', 'vehicules.categorie_id', '=', 'categories.id')
            ->join('agences', 'vehicules.agence_id', '=', 'agences.id')
            ->select('vehicules.*', 'categories.libelle as categorie', 'categories.tarifjournee', 'categories.photo', 'agences.ville as agence_ville')
            ->paginate(10);
        
        // On réutilise les feedbacks pour la sidebar (compteur)
        $feedbacks = DB::table('feedbacks')->limit(5)->get(); 

        return view('admin.vehicules', compact('vehicules', 'feedbacks'));
    }

    // 3. PAGE CLIENTS
    public function clients()
    {
        $clients = DB::table('clients')->orderBy('nom')->paginate(15);
        $feedbacks = DB::table('feedbacks')->limit(5)->get(); // Pour sidebar
        return view('admin.clients', compact('clients', 'feedbacks'));
    }

    // 4. PAGE FEEDBACKS
    public function feedbacks()
    {
        $feedbacks = DB::table('feedbacks')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.feedbacks', compact('feedbacks'));
    }
}