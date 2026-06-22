<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffreController extends Controller
{
    public function index()
    {
        // 1. Récupération des catégories réelles depuis la BDD pour les images
        // On utilise les IDs de votre dump SQL : 101 (Eco), 107 (Moyenne), 110 (Grande), 113 (Monospace)
        
        $catAccess = DB::table('categories')->where('id', 101)->first(); 
        $catSelect = DB::table('categories')->where('id', 107)->first(); 
        $catExclusive = DB::table('categories')->where('id', 110)->first();
        $catUltimate = DB::table('categories')->where('id', 113)->first();

        // Helpers pour les images (fallback si pas d'image en BDD)
        $imgAccess = $catAccess ? asset('images/' . $catAccess->photo) : asset('images/voiture.png');
        $imgSelect = $catSelect ? asset('images/' . $catSelect->photo) : asset('images/voiture.png');
        $imgExclusive = $catExclusive ? asset('images/' . $catExclusive->photo) : asset('images/voiture.png');
        $imgUltimate = $catUltimate ? asset('images/' . $catUltimate->photo) : asset('images/voiture.png');

        // 2. Construction des Plans Complets (avec tagline et benefits qui manquaient)
        $plans = [
            [
                'name' => 'Access',
                'tagline' => 'L\'essentiel de la mobilité',
                'points' => 'Cumulez 2 500 Points / mois',
                'price' => '49 € / mois',
                'image' => $imgAccess,
                'benefits' => [
                    'Accès prioritaire',
                    '10% de réduction sur les locations',
                    'Service client dédié'
                ],
                'color' => 'from-gray-900 to-gray-800',
                'route' => 'client.register.form'
            ],
            [
                'name' => 'Select',
                'tagline' => 'Plus de confort au quotidien',
                'points' => 'Cumulez 5 000 Points / mois',
                'price' => '99 € / mois',
                'image' => $imgSelect,
                'benefits' => [
                    'Tous les avantages Access',
                    '1 Surclassement offert / an',
                    'Conducteur additionnel gratuit'
                ],
                'color' => 'from-[#5C0632] to-[#3d0321]', // Rouge ADA
                'route' => 'client.register.form'
            ],
            [
                'name' => 'Exclusive',
                'tagline' => 'Voyagez en première classe',
                'points' => 'Cumulez 10 000 Points / mois',
                'price' => '199 € / mois',
                'image' => $imgExclusive,
                'benefits' => [
                    'Tous les avantages Select',
                    'Surclassements illimités',
                    'Annulation gratuite J-1'
                ],
                'color' => 'from-gray-800 to-black',
                'route' => 'client.register.form'
            ],
            [
                'name' => 'Ultimate',
                'tagline' => 'L\'expérience sans limites',
                'points' => 'Cumulez 20 000 Points + Statut Gold',
                'price' => '299 € / mois',
                'image' => $imgUltimate,
                'benefits' => [
                    'Statut Gold immédiat',
                    'Accès Lounge Aéroports',
                    'Service Voiturier offert',
                    'Véhicule livré à domicile'
                ],
                'color' => 'from-[#8A1B4A] to-[#5C0632]',
                'route' => 'client.register.form'
            ]
        ];

        return view('pages.offers', compact('plans'));
    }
}
