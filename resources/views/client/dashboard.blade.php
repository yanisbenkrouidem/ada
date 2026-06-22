@extends('layouts.app')

@section('title', 'Mon Espace - ' . ucfirst(strtolower($client->prenom)))

@section('content')

{{-- LOGIQUE PHP INTERNE POUR LE TRI DES VOYAGES --}}
@php
    $currentTrips = [];
    $pastTrips = [];
    $now = new \DateTime();
    if (isset($locations) && $locations->count()) {
        foreach ($locations as $loc) {
            try {
                $end = new \DateTime($loc->dateheurefin);
                $isCompleted = ($loc->nbkmfin !== null) || ($loc->dateheurefinreel !== null) || ($end < $now);
                if ($isCompleted) { $pastTrips[] = $loc; } else { $currentTrips[] = $loc; }
            } catch (\Exception $e) { continue; }
        }
    }
@endphp

<style>
    /* --- 1. FIX HEADER (NOIR SUR BLANC) --- */
    header, nav, #main-header, .navbar {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e5e5e5 !important;
        box-shadow: none !important;
    }
    header a, nav a, .nav-link, .navbar-brand { color: #000000 !important; }
    header i, nav i, header svg, nav svg { color: #000000 !important; fill: #000000 !important; stroke: #000000 !important; }
    header img, nav img, .logo-img { filter: brightness(0) !important; }

    /* --- 2. STYLE LV GENERAL --- */
    @font-face {
        font-family: 'FuturaLT';
        src: url("{{ asset('fonts/FuturaLT.ttf') }}") format('truetype');
        font-weight: normal; font-style: normal;
    }
    body { background-color: #ffffff; color: #000; font-family: 'Inter', sans-serif; }
    .lv-font { font-family: 'FuturaLT', 'Helvetica', sans-serif; letter-spacing: 0.05em; }

    /* NAVIGATION 5 ONGLETS */
    .sub-nav-container { 
        border-bottom: 1px solid #e5e5e5; position: sticky; top: 0; background: white; z-index: 40; 
        padding-top: 20px; margin-top: 0px; 
    }
    .sub-nav { display: flex; justify-content: center; gap: 30px; max-width: 1200px; margin: 0 auto; overflow-x: auto; padding-bottom: 0; }
    .sub-nav-btn {
        background: none; border: none; cursor: pointer; padding: 15px 5px;
        font-size: 13px; color: #767676; border-bottom: 2px solid transparent; transition: all 0.3s;
        white-space: nowrap; font-family: 'Inter', sans-serif;
    }
    .sub-nav-btn:hover { color: #000; }
    .sub-nav-btn.active { color: #000; border-bottom: 2px solid #000; font-weight: 500; }

    /* UI COMPONENTS */
    .btn-lv-black { background-color: #000; color: #fff; width: 100%; display: block; padding: 14px; text-align: center; border-radius: 999px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; transition: opacity 0.3s; cursor: pointer; border: 1px solid #000; }
    .btn-lv-black:hover { opacity: 0.8; }
    .btn-lv-outline { background-color: transparent; color: #000; width: 100%; display: block; padding: 14px; text-align: center; border-radius: 999px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s; cursor: pointer; border: 1px solid #e5e5e5; }
    .btn-lv-outline:hover { border-color: #000; }

    .card-lv { background: #fbfbfb; padding: 40px; min-height: 280px; display: flex; flex-direction: column; justify-content: space-between; transition: background 0.3s; }
    .card-lv:hover { background: #f6f6f6; }
    .card-title { font-size: 18px; margin-bottom: 15px; font-weight: 400; }

    .input-lv { background: transparent; border: none; border-bottom: 1px solid #e5e5e5; width: 100%; padding: 12px 0; outline: none; transition: border-color 0.3s; font-size: 14px; }
    .input-lv:focus { border-bottom-color: #000; }
    .label-lv { font-size: 10px; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em; font-weight: 700; }

    .tab-content { display: none; animation: fadeIn 0.4s ease-out; }
    .tab-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    
    .dashboard-grid { display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 40px; }
    @media(min-width: 768px) { .dashboard-grid { grid-template-columns: 1fr 1fr; } }
</style>

<div class="min-h-screen bg-white pb-24 pt-24">

    {{-- NAVIGATION SECONDAIRE (5 ITEMS) --}}
    <div class="sub-nav-container">
        <div class="sub-nav">
            <button onclick="switchTab('apercu')" id="nav-apercu" class="sub-nav-btn active">Aperçu</button>
            <button onclick="switchTab('profil')" id="nav-profil" class="sub-nav-btn">Mon profil</button>
            <button onclick="switchTab('locations')" id="nav-locations" class="sub-nav-btn">Mes locations</button>
            <button onclick="switchTab('wallet')" id="nav-wallet" class="sub-nav-btn">Wallet</button>
            <button onclick="switchTab('avantages')" id="nav-avantages" class="sub-nav-btn">Mes avantages</button>
            <button onclick="switchTab('preferences')" id="nav-preferences" class="sub-nav-btn">Préférences</button>
        </div>
    </div>

    {{-- FEEDBACK MESSAGES --}}
    <div class="max-w-6xl mx-auto px-6 mt-6">
        @if(session('success'))
            <div class="bg-gray-50 border-l-2 border-black p-4 text-sm text-gray-800 flex items-center gap-3">
                <i class="fa-solid fa-check"></i> {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="max-w-6xl mx-auto px-6 mt-10">

        {{-- ================= 1. APERÇU ================= --}}
        <div id="content-apercu" class="tab-content active">
            <div class="text-center mb-12">
                <h1 class="text-3xl lv-font">Bonjour {{ ucfirst(strtolower($client->prenom)) }}</h1>
            </div>

            <div class="dashboard-grid">
                <div class="card-lv">
                    <div>
                        <h2 class="card-title lv-font">Mon profil</h2>
                        <div class="text-sm text-gray-600 mt-6 space-y-2 font-light">
                            <p class="font-medium text-black">{{ $client->prenom }} {{ $client->nom }}</p>
                            <p>{{ $client->email }}</p>
                            <p class="text-xs uppercase text-gray-400 mt-4">ID: #{{ $client->id }}</p>
                        </div>
                    </div>
                    <button onclick="switchTab('profil')" class="btn-lv-black mt-6">Modifier</button>
                </div>

                <div class="card-lv">
                    <div>
                        <h2 class="card-title lv-font">Mes locations</h2>
                        @if(count($currentTrips) > 0)
                            <div class="mt-4 flex items-center gap-4">
                                <div class="w-24 h-16 bg-white flex items-center justify-center border border-gray-100 p-2">
                                    <img src="{{ asset('images/' . ($currentTrips[0]->vehicule->category->photo ?? 'default.png')) }}" class="w-full h-full object-contain mix-blend-multiply">
                                </div>
                                <div>
                                    <p class="font-bold text-sm">{{ $currentTrips[0]->vehicule->marque }}</p>
                                    <p class="text-xs text-green-600 uppercase font-bold mt-1">● En cours</p>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500 mt-4 font-light">Aucune location en cours.</p>
                        @endif
                    </div>
                    <button onclick="switchTab('locations')" class="btn-lv-black mt-6">{{ count($currentTrips) > 0 ? 'Gérer' : 'Réserver' }}</button>
                </div>

                <div class="card-lv">
                    <div>
                        <h2 class="card-title lv-font">Mon Statut</h2>
                        <div class="flex items-baseline gap-2 mt-4">
                            <span class="text-4xl lv-font">{{ $statut }}</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 font-medium">{{ number_format($points, 0, ',', ' ') }} pts</p>
                        <div class="w-full bg-gray-200 h-[2px] mt-6 relative">
                            @php 
                                $percent = ($nextTierName) ? ($points / $nextTierLimit) * 100 : 100;
                            @endphp
                            <div class="bg-black h-full absolute top-0 left-0" style="width: {{ min(100, $percent) }}%"></div>
                        </div>
                    </div>
                    {{-- LE BOUTON QUI REDIRIGE VERS LA NOUVELLE SECTION --}}
                    <button onclick="switchTab('avantages')" class="btn-lv-outline mt-6">Voir mes avantages</button>
                </div>

                <div class="card-lv">
                    <div>
                        <h2 class="card-title lv-font">Wallet</h2>
                        <p class="text-sm text-gray-500 mt-4 font-light">{{ count($cards) }} carte(s) enregistrée(s).</p>
                    </div>
                    <button onclick="switchTab('wallet')" class="btn-lv-outline mt-6">Gérer mon wallet</button>
                </div>
            </div>
        </div>

        {{-- ================= 2. PROFIL ================= --}}
        <div id="content-profil" class="tab-content">
            <h2 class="text-2xl lv-font mb-12 text-center">Informations personnelles</h2>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8">
                    <form action="{{ route('client.profile.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div><label class="label-lv">Prénom</label><input type="text" name="prenom" value="{{ $client->prenom }}" class="input-lv"></div>
                            <div><label class="label-lv">Nom</label><input type="text" name="nom" value="{{ $client->nom }}" class="input-lv"></div>
                        </div>
                        <div><label class="label-lv">Email</label><input type="email" name="email" value="{{ $client->email }}" class="input-lv bg-gray-50 cursor-not-allowed" readonly></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div><label class="label-lv">Téléphone</label><input type="text" name="telephone" value="{{ $client->telephone }}" class="input-lv"></div>
                            <div><label class="label-lv">Ville</label><input type="text" name="ville" value="{{ $client->ville }}" class="input-lv"></div>
                        </div>
                        <div><label class="label-lv">Adresse</label><input type="text" name="adresse" value="{{ $client->adresse }}" class="input-lv"></div>
                        <div class="pt-6 flex justify-end">
                            <button type="submit" class="btn-lv-black md:w-auto md:px-12">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <div class="lg:col-span-4 bg-gray-50 p-8 h-fit">
                    <h3 class="text-lg lv-font mb-6">Famille</h3>
                    @foreach($family as $member)
                        <div class="flex justify-between items-center pb-2 border-b border-gray-200 mb-2">
                            <div><p class="font-bold text-sm">{{ $member->prenom }}</p><p class="text-[10px]">{{ $member->relation }}</p></div>
                            <form action="{{ route('client.family.remove', $member->id) }}" method="POST">@csrf @method('DELETE')<button class="text-gray-400 hover:text-red-600"><i class="fa-solid fa-times"></i></button></form>
                        </div>
                    @endforeach
                    <form action="{{ route('client.family.add') }}" method="POST" class="mt-6 space-y-3">
                        @csrf
                        <input type="text" name="prenom" placeholder="Prénom" class="input-lv text-xs" required>
                        <input type="text" name="nom" placeholder="Nom" class="input-lv text-xs" required>
                        <select name="relation" class="input-lv text-xs"><option value="Conjoint">Conjoint</option><option value="Enfant">Enfant</option></select>
                        <button type="submit" class="btn-lv-outline mt-2">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= 3. LOCATIONS ================= --}}
        <div id="content-locations" class="tab-content">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-xl lv-font mb-8 border-b pb-4">En cours</h2>
                @if(count($currentTrips) > 0)
                    @foreach($currentTrips as $loc)
                        <div class="border border-gray-100 p-6 mb-6 flex flex-col md:flex-row gap-8 items-start">
                            <div class="w-full md:w-1/3 bg-gray-50 h-40 flex items-center justify-center p-4">
                                <img src="{{ asset('images/' . ($loc->vehicule->category->photo ?? 'default.png')) }}" class="max-h-full mix-blend-multiply">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl lv-font">{{ $loc->vehicule->marque }} {{ $loc->vehicule->modele }}</h3>
                                <p class="text-xs text-gray-400 mb-4">Ref: #LOC-{{ $loc->id }}</p>
                                <p class="text-sm">Du {{ \Carbon\Carbon::parse($loc->dateheuredebut)->format('d/m') }} au {{ \Carbon\Carbon::parse($loc->dateheurefin)->format('d/m') }}</p>
                                <form action="{{ route('location.stop', $loc->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="bg-black text-white px-6 py-3 text-xs uppercase font-bold tracking-widest hover:opacity-80">Restituer</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-[#F6F6F6] p-10 mb-10"><p class="text-sm">Aucune location en cours.</p></div>
                @endif

                <h2 class="text-xl lv-font mb-8 border-b pb-4">Historique</h2>
                @foreach($pastTrips as $loc)
                    <div class="flex items-center justify-between border-b border-gray-100 py-6 hover:bg-gray-50 px-4">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-10 bg-gray-100 flex items-center justify-center"><img src="{{ asset('images/' . ($loc->vehicule->category->photo ?? 'default.png')) }}" class="max-h-8 mix-blend-multiply grayscale"></div>
                            <div><h4 class="font-bold text-sm">{{ $loc->vehicule->marque }}</h4><p class="text-xs text-gray-500">Fin : {{ \Carbon\Carbon::parse($loc->dateheurefinreel)->format('d/m/Y') }}</p></div>
                        </div>
                        <p class="font-bold text-sm">{{ number_format($loc->montantfacture, 2, ',', ' ') }} €</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ================= 4. WALLET (SÉPARÉ) ================= --}}
        <div id="content-wallet" class="tab-content">
            <h2 class="text-2xl lv-font mb-12 text-center">Mon Wallet</h2>
            <div class="max-w-2xl mx-auto space-y-6">
                @foreach($cards as $card)
                    <div class="bg-black text-white p-6 rounded-xl relative overflow-hidden shadow-xl transform hover:scale-[1.02] transition-transform">
                        <div class="absolute top-0 right-0 p-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                        <p class="text-xs uppercase opacity-50 mb-6">{{ $card->brand }}</p>
                        <p class="font-mono text-xl tracking-widest mb-6">•••• •••• •••• {{ $card->last_four }}</p>
                        <div class="flex justify-between text-xs opacity-70">
                            <span>{{ strtoupper($client->nom) }}</span>
                            <span>EXP {{ $card->expiry_date }}</span>
                        </div>
                        <form action="{{ route('client.card.remove', $card->id) }}" method="POST" class="absolute top-4 right-4">@csrf @method('DELETE')<button class="text-white opacity-40 hover:opacity-100 hover:text-red-400"><i class="fa-solid fa-trash"></i></button></form>
                    </div>
                @endforeach
                
                <div onclick="document.getElementById('modal-card').classList.remove('hidden')" class="border border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-black hover:bg-gray-50 transition">
                    <i class="fa-solid fa-plus text-2xl mb-2 text-gray-400"></i>
                    <p class="text-sm font-bold text-gray-500">Ajouter une nouvelle carte</p>
                </div>
            </div>
        </div>

        {{-- ================= 5. AVANTAGES (NOUVEAU - BANGER) ================= --}}
        <div id="content-avantages" class="tab-content">
            <div class="text-center mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 block">Votre statut actuel</span>
                <h2 class="text-5xl lv-font mb-4">{{ $statut }}</h2>
                <div class="w-24 h-1 bg-black mx-auto mb-4"></div>
                <p class="text-sm text-gray-500">{{ number_format($points, 0, ',', ' ') }} points de fidélité</p>
            </div>

            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Colonne Gauche : Progression --}}
                <div class="bg-gray-50 p-8 rounded-lg h-fit">
                    <h3 class="text-lg lv-font mb-6">Prochain objectif</h3>
                    @if($nextTierName)
                        <div class="flex justify-between items-end mb-2">
                            <span class="font-bold text-sm">{{ $nextTierName }}</span>
                            <span class="text-xs text-gray-500">{{ $points }} / {{ $nextTierLimit }}</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden mb-4">
                            <div class="bg-black h-full transition-all duration-1000" style="width: {{ ($points / $nextTierLimit) * 100 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Il vous manque <strong>{{ $nextTierLimit - $points }} points</strong> pour atteindre le statut {{ $nextTierName }} et débloquer de nouveaux privilèges exclusifs.
                        </p>
                    @else
                        <p class="text-sm text-black">Vous avez atteint le statut suprême. Félicitations.</p>
                    @endif
                </div>

                {{-- Colonne Droite : Liste dynamique des avantages --}}
                <div class="space-y-6">
                    @foreach($tiersDefinition as $tierName => $tierData)
                        @php 
                            // On vérifie si ce palier est atteint par l'utilisateur
                            // Un utilisateur "Gold" a accès aux avantages "Membre" et "Silver" aussi.
                            // Ici simplifions : on affiche tout, grisés si pas atteint.
                            $isUnlocked = $points >= $tierData['limit'];
                            $isCurrent = $statut == $tierName;
                        @endphp

                        <div class="border-b border-gray-100 pb-6 {{ $isUnlocked ? 'opacity-100' : 'opacity-40 grayscale' }}">
                            <div class="flex items-center gap-3 mb-3">
                                <i class="fa-solid {{ $isUnlocked ? 'fa-lock-open text-black' : 'fa-lock text-gray-300' }}"></i>
                                <h4 class="font-bold uppercase text-sm tracking-widest {{ $isCurrent ? 'text-black' : 'text-gray-500' }}">
                                    {{ $tierName }} 
                                    @if($isCurrent) <span class="bg-black text-white text-[9px] px-2 py-0.5 rounded ml-2">ACTUEL</span> @endif
                                </h4>
                            </div>
                            <ul class="space-y-2 pl-7">
                                @foreach($tierData['benefits'] as $benefit)
                                    <li class="text-sm font-light text-gray-600 flex items-start gap-2">
                                        <span class="block w-1 h-1 bg-gray-400 rounded-full mt-2"></span> {{ $benefit }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ================= 6. PRÉFÉRENCES (SÉPARÉ) ================= --}}
        <div id="content-preferences" class="tab-content">
            <h2 class="text-2xl lv-font mb-12 text-center">Mes préférences</h2>
            <div class="max-w-xl mx-auto">
                <form action="{{ route('client.preferences.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <label class="flex items-start gap-4 p-6 border border-gray-200 cursor-pointer hover:bg-gray-50 transition group">
                        <div class="pt-1"><input type="checkbox" name="newsletter_optin" class="w-4 h-4 accent-black" {{ $client->newsletter_optin ? 'checked' : '' }}></div>
                        <div>
                            <span class="block font-bold text-sm mb-1 group-hover:text-black transition">Newsletter ADA</span>
                            <span class="text-xs text-gray-500 leading-relaxed">Recevez nos dernières actualités, les lancements de nouveaux véhicules et des invitations à nos événements privés.</span>
                        </div>
                    </label>
                    <label class="flex items-start gap-4 p-6 border border-gray-200 cursor-pointer hover:bg-gray-50 transition group">
                        <div class="pt-1"><input type="checkbox" name="sms_optin" class="w-4 h-4 accent-black" {{ $client->sms_optin ? 'checked' : '' }}></div>
                        <div>
                            <span class="block font-bold text-sm mb-1 group-hover:text-black transition">Notifications SMS</span>
                            <span class="text-xs text-gray-500 leading-relaxed">Soyez notifié en temps réel pour le début de votre location, le code d'accès au véhicule et la confirmation de restitution.</span>
                        </div>
                    </label>
                    <div class="pt-6">
                        <button type="submit" class="btn-lv-black">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- MODAL AJOUT CARTE --}}
    <div id="modal-card" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white p-8 max-w-md w-full shadow-2xl">
            <h3 class="text-xl lv-font mb-6">Ajouter une carte</h3>
            <form action="{{ route('client.card.add') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="number" placeholder="Numéro de carte" class="input-lv" required>
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="expiry" placeholder="MM/YY" class="input-lv" required>
                    <input type="text" name="cvv" placeholder="CVV" class="input-lv" required>
                </div>
                <div class="flex gap-4 mt-6">
                    <button type="button" onclick="document.getElementById('modal-card').classList.add('hidden')" class="btn-lv-outline">Annuler</button>
                    <button type="submit" class="btn-lv-black">Valider</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.sub-nav-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(div => div.classList.remove('active'));
        document.getElementById('nav-' + tabId).classList.add('active');
        document.getElementById('content-' + tabId).classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

@endsection
