@extends('base')

@section('title', 'Mes Locations - Espace Client')

@section('content')

{{-- LOGIQUE PHP : TRI DES VOYAGES --}}
@php
    $currentTrips = []; // Commandes en cours
    $pastTrips = [];    // Historique

    $now = new DateTime();

    if (isset($locations) && $locations->count()) {
        foreach ($locations as $loc) {
            try {
                $start = new DateTime($loc->dateheuredebut);
                $end = new DateTime($loc->dateheurefin);
                
                // Est terminé si : Km fin saisis OU Date fin réelle saisie OU Date fin dépassée
                $isCompleted = ($loc->nbkmfin !== null) || ($loc->dateheurefinreel !== null) || ($end < $now);
                
                if ($isCompleted) { 
                    $pastTrips[] = $loc; 
                } else { 
                    $currentTrips[] = $loc; 
                }
            } catch (Exception $e) { continue; }
        }
    }
@endphp

<style>
    /* 1. FORCE LA NAVBAR EN NOIR (VISIBILITÉ SUR FOND BLANC) */
    #main-header { 
        color: #000000 !important; 
        background-color: #ffffff !important; 
        box-shadow: none !important;
        border-bottom: 1px solid #f0f0f0;
    }
    .header-logo-img { 
        filter: none !important; /* Affiche le logo noir original */
    }
    .nav-icon {
        stroke: #000000 !important; /* Icônes noires */
    }
    .nav-text-color {
        color: #000000 !important;
    }

    /* 2. POLICE FUTURA LV */
    @font-face {
        font-family: 'FuturaLT';
        src: url("{{ asset('fonts/FuturaLT.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    /* GENERAL */
    body { background-color: #ffffff; color: #000; font-family: 'Inter', sans-serif; }
    
    /* TITRES & TEXTES */
    .lv-title { font-family: 'FuturaLT', sans-serif; font-weight: 400; letter-spacing: 0.02em; }
    
    /* MENU SECONDAIRE */
    .sub-nav { border-bottom: 1px solid #E5E5E5; display: flex; justify-content: center; margin-bottom: 60px; }
    .sub-nav-link {
        color: #000; font-size: 13px; text-transform: none; padding: 22px 30px; 
        border-bottom: 2px solid transparent; transition: all 0.3s; font-family: 'Inter', sans-serif;
    }
    .sub-nav-link:hover { opacity: 0.7; }
    .sub-nav-link.active { border-bottom: 2px solid #000; }

    /* ETATS VIDES (STYLE BANDEAU GRIS LV) */
    .lv-empty-box { 
        background-color: #F6F6F6; 
        padding: 40px 20px; 
        padding-left: 50px; /* Alignement LV */
        width: 100%; 
        font-size: 14px; 
        color: #000;
        margin-top: 10px;
        margin-bottom: 60px;
    }

    /* CARTES LISTE */
    .trip-card { background: white; border-bottom: 1px solid #f0f0f0; padding: 40px 0; display: flex; align-items: flex-start; gap: 40px; }
    .trip-card:last-child { border-bottom: none; }
    
    .status-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px; display: block; color: #666; }
</style>

<div class="pt-28 min-h-screen pb-32">
    
    <div class="hidden md:block">
        <div class="sub-nav">
            <a href="#" class="sub-nav-link">Aperçu</a>
            <a href="{{ route('client.profile') }}" class="sub-nav-link">Mon profil</a>
            <a href="#" class="sub-nav-link active">Mes locations</a>
            <a href="#" class="sub-nav-link">Mes factures</a>
            <a href="#" class="sub-nav-link">Ma wishlist</a>
        </div>
    </div>

    <div class="max-w-[1280px] mx-auto px-6 md:px-12">

        <div class="flex justify-between items-end mb-16">
            <h1 class="text-4xl lv-title">Mes locations</h1>
            <a href="#" class="text-xs underline text-gray-500 hover:text-black hidden md:block font-sans">Conditions générales de location</a>
        </div>

        <div class="mb-8">
            <h2 class="text-xl lv-title mb-6">Location en cours</h2>

            @if(empty($currentTrips))
                <div class="lv-empty-box">
                    Vous n'avez pas de location en cours
                </div>
            @else
                <div class="border-t border-gray-100">
                    @foreach($currentTrips as $loc)
                        @php 
                            $isUpcoming = new DateTime($loc->dateheuredebut) > new DateTime();
                        @endphp
                        <div class="trip-card">
                            <div class="w-48 h-32 bg-[#F6F6F6] flex items-center justify-center shrink-0">
                                @php $img = $loc->vehicule->category->photo ?? 'voiture.png'; @endphp
                                <img src="{{ asset('images/' . $img) }}" class="max-w-full max-h-full mix-blend-multiply object-contain p-4">
                            </div>

                            <div class="flex-1 pt-2">
                                <span class="status-label">{{ $isUpcoming ? 'À venir' : 'Actuellement en route' }}</span>
                                <h3 class="text-xl lv-title mb-2">{{ $loc->vehicule->marque }} {{ $loc->vehicule->modele }}</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-8 text-sm text-gray-600 font-light mt-4 font-sans">
                                    <p>Du : <span class="text-black">{{ \Carbon\Carbon::parse($loc->dateheuredebut)->format('d/m/Y') }}</span></p>
                                    <p>Au : <span class="text-black">{{ \Carbon\Carbon::parse($loc->dateheurefin)->format('d/m/Y') }}</span></p>
                                    <p>Agence : <span class="text-black">{{ $loc->agence->ville ?? 'Non spécifié' }}</span></p>
                                    <p>Référence : <span class="text-black">#LOC-{{ $loc->id }}</span></p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 pt-2 items-end">
                                @if(!$isUpcoming)
                                    <form action="{{ route('location.stop', $loc->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-black text-white px-8 py-3 text-xs uppercase tracking-widest hover:opacity-80 transition font-sans">
                                            Restituer
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('location.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Annuler cette réservation ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs uppercase tracking-widest border-b border-black pb-1 hover:opacity-60 transition font-sans">
                                            Annuler la réservation
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-16">
            <h2 class="text-xl lv-title mb-6">Historique des locations</h2>

            @if(empty($pastTrips))
                <div class="lv-empty-box">
                    Vous n'avez pas d'historique de location
                </div>
            @else
                <div class="border-t border-gray-100">
                    @foreach($pastTrips as $loc)
                        <div class="trip-card opacity-80 hover:opacity-100 transition">
                            <div class="w-48 h-32 bg-[#F6F6F6] flex items-center justify-center shrink-0">
                                @php $img = $loc->vehicule->category->photo ?? 'voiture.png'; @endphp
                                <img src="{{ asset('images/' . $img) }}" class="max-w-full max-h-full mix-blend-multiply object-contain grayscale p-4">
                            </div>

                            <div class="flex-1 pt-2">
                                <span class="status-label">Terminé le {{ \Carbon\Carbon::parse($loc->dateheurefinreel ?? $loc->dateheurefin)->format('d F Y') }}</span>
                                <h3 class="text-lg lv-title mb-2">{{ $loc->vehicule->marque }} {{ $loc->vehicule->modele }}</h3>
                                <p class="text-sm text-gray-500 mt-2 font-sans">Montant total : {{ number_format($loc->montantfacture, 2, ',', ' ') }} €</p>
                            </div>

                            <div class="pt-2">
                                <a href="#" class="text-xs font-medium uppercase tracking-widest border-b border-gray-300 pb-1 hover:border-black transition font-sans">
                                    Voir la facture
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

@endsection