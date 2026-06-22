<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil Ada</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Manrope', 'sans-serif'] },
                    colors: { 
                        'ada-red': '#5C0632',
                        'ada-dark': '#1A1A1A',
                    }
                }
            }
        }
    </script>
    <style>
        .progress-ring__circle { transition: stroke-dashoffset 1.5s ease-in-out; transform: rotate(-90deg); transform-origin: 50% 50%; }
        .input-profile { background-color: #f9fafb; border: 1px solid #e5e7eb; transition: all 0.3s; }
        .input-profile:focus { background-color: #fff; border-color: #5C0632; box-shadow: 0 0 0 1px #5C0632; }
        .tab-btn.active { border-bottom-color: #5C0632; color: #5C0632; background-color: white; }
        .tab-content { display: none; animation: fadeIn 0.4s ease-out; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        /* Modal Style */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 50; justify-content: center; align-items: center; }
        .modal-overlay.active { display: flex; }
        
        /* Effet verre pour la carte de gauche */
        .glass-panel { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-white font-sans text-gray-600">

    @include('partials.header')

    {{-- LOGIQUE DE GAMIFICATION (FRONT-END) --}}
    <?php
        // DÃ©finition des paliers
        $tiers = [
            ['name' => 'Membre', 'limit' => 0, 'icon' => 'fa-user'],
            ['name' => 'Silver', 'limit' => 1000, 'icon' => 'fa-medal'],
            ['name' => 'Gold', 'limit' => 3000, 'icon' => 'fa-crown'],
            ['name' => 'Platinum', 'limit' => 6000, 'icon' => 'fa-gem']
        ];

        // Trouver le niveau actuel et le suivant
        $currentTierIndex = 0;
        foreach ($tiers as $index => $tier) {
            if ($points >= $tier['limit']) {
                $currentTierIndex = $index;
            }
        }

        $nextTier = $tiers[$currentTierIndex + 1] ?? null;
        $prevLimit = $tiers[$currentTierIndex]['limit'];
        
        // Calcul pourcentage vers le prochain niveau
        if ($nextTier) {
            $range = $nextTier['limit'] - $prevLimit;
            $currentInProgress = $points - $prevLimit;
            $percentToNext = min(100, round(($currentInProgress / $range) * 100));
            $pointsNeeded = $nextTier['limit'] - $points;
        } else {
            $percentToNext = 100; // Niveau Max atteint
            $pointsNeeded = 0;
        }
    ?>

    <div class="relative h-[320px] w-full overflow-hidden">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-[#5C0632]/90 via-[#5C0632]/30 to-transparent"></div>
        <div class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center pb-8">
            <h1 class="text-4xl text-white font-light tracking-wide drop-shadow-md">GÃ©rer votre profil</h1>
        </div>
        <div class="custom-shape-divider-bottom-16">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path></svg>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-20 -mt-16 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4"> <div class="bg-gradient-to-b from-[#5C0632] to-[#2b0217] text-white rounded-2xl shadow-2xl overflow-hidden relative p-8 border border-white/10">
                    
                    <div class="flex items-center gap-4 mb-8">
                        <div class="relative w-16 h-16">
                            <div class="w-full h-full rounded-full border-2 border-white/30 flex items-center justify-center text-xl bg-white/10 font-bold">
                                {{ strtoupper(substr($client->prenom, 0, 1)) }}{{ strtoupper(substr($client->nom, 0, 1)) }}
                            </div>
                            <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-400 border-2 border-[#5C0632] rounded-full"></div>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold leading-tight">{{ ucfirst(strtolower($client->prenom)) }} {{ strtoupper($client->nom) }}</h2>
                            <p class="text-xs text-white/50 font-mono">ID: {{ str_pad($client->id, 8, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>

                    <div class="mb-8 p-4 glass-panel rounded-xl">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-sm font-bold text-yellow-400"><i class="fa-solid fa-trophy mr-1"></i> {{ $statut }}</span>
                            @if($nextTier)
                                <span class="text-[10px] text-white/70">Prochain : <strong>{{ $nextTier['name'] }}</strong></span>
                            @else
                                <span class="text-[10px] text-yellow-400 font-bold">Niveau Max !</span>
                            @endif
                        </div>

                        <div class="w-full h-3 bg-black/40 rounded-full overflow-hidden mb-2 relative">
                            <div class="h-full bg-gradient-to-r from-yellow-600 to-yellow-300 transition-all duration-1000 ease-out" style="width: {{ $percentToNext }}%"></div>
                            <div class="absolute top-0 left-0 w-full h-full bg-white/10" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); width: 50%; transform: skewX(-20deg) translateX(-150%); animation: shimmer 2s infinite;"></div>
                        </div>

                        @if($nextTier)
                            <p class="text-xs text-center text-white/80">
                                Plus que <span class="font-bold text-white">{{ number_format($pointsNeeded, 0, ',', ' ') }} pts</span> pour dÃ©bloquer le statut {{ $nextTier['name'] }} !
                            </p>
                        @endif
                    </div>

                    <div class="space-y-3 mb-8">
                        <p class="text-[10px] uppercase tracking-widest text-white/40 mb-3 font-bold">Votre Parcours VIP</p>
                        
                        @foreach($tiers as $index => $tier)
                            <?php 
                                $isReached = $points >= $tier['limit'];
                                $isNext = !$isReached && ($index == $currentTierIndex + 1);
                                $opacity = $isReached ? 'opacity-100' : ($isNext ? 'opacity-60' : 'opacity-30');
                                $bg = $isReached ? 'bg-white/10 border-white/20' : 'bg-transparent border-transparent';
                            ?>
                            <div class="flex items-center gap-3 p-2.5 rounded-lg border {{ $bg }} {{ $opacity }} transition-all">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center bg-black/20 text-xs">
                                    @if($isReached)
                                        <i class="fa-solid fa-check text-green-400"></i>
                                    @else
                                        <i class="fa-solid fa-lock text-white"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold flex items-center gap-2">
                                        {{ $tier['name'] }}
                                        @if($index == $currentTierIndex) <span class="text-[9px] bg-white text-ada-red px-1.5 py-0.5 rounded font-bold">ACTUEL</span> @endif
                                    </p>
                                    <p class="text-[10px] text-white/60">DÃ¨s {{ number_format($tier['limit'], 0, ',', ' ') }} pts</p>
                                </div>
                                <i class="fa-solid {{ $tier['icon'] }} text-lg {{ $isReached ? 'text-yellow-400' : 'text-white' }}"></i>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-6 border-t border-white/10">
                        <div class="text-center">
                            <span class="block text-2xl font-bold">{{ $locationsCount }}</span>
                            <span class="text-[10px] uppercase text-white/50">Locations</span>
                        </div>
                        <div class="text-center border-l border-white/10">
                            <span class="block text-2xl font-bold text-yellow-400">{{ number_format($points, 0, ',', ' ') }}</span>
                            <span class="text-[10px] uppercase text-white/50">Points CumulÃ©s</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="lg:col-span-8 bg-gray-50/50 rounded-lg">
                <div class="flex border-b border-gray-200 bg-gray-100 rounded-t-lg overflow-hidden">
                    <button onclick="switchTab('infos')" id="tab-infos" class="tab-btn active flex-1 py-5 border-b-4 border-ada-red text-ada-red bg-white flex flex-col items-center gap-1.5 hover:bg-white transition-colors">
                        <i class="fa-solid fa-user text-lg"></i><span class="text-[10px] font-bold uppercase tracking-widest hidden md:inline">Infos</span>
                    </button>
                    <button onclick="switchTab('paiement')" id="tab-paiement" class="tab-btn flex-1 py-5 border-b-4 border-transparent text-gray-400 flex flex-col items-center gap-1.5 hover:bg-white hover:text-gray-600 transition-colors">
                        <i class="fa-regular fa-credit-card text-lg"></i><span class="text-[10px] font-bold uppercase tracking-widest hidden md:inline">Paiement</span>
                    </button>
                    <button onclick="switchTab('preferences')" id="tab-preferences" class="tab-btn flex-1 py-5 border-b-4 border-transparent text-gray-400 flex flex-col items-center gap-1.5 hover:bg-white hover:text-gray-600 transition-colors">
                        <i class="fa-solid fa-sliders text-lg"></i><span class="text-[10px] font-bold uppercase tracking-widest hidden md:inline">PrÃ©fÃ©rences</span>
                    </button>
                    <button onclick="switchTab('famille')" id="tab-famille" class="tab-btn flex-1 py-5 border-b-4 border-transparent text-gray-400 flex flex-col items-center gap-1.5 hover:bg-white hover:text-gray-600 transition-colors">
                        <i class="fa-solid fa-users text-lg"></i><span class="text-[10px] font-bold uppercase tracking-widest hidden md:inline">Famille</span>
                    </button>
                </div>

                <div class="p-8 md:p-12 bg-white rounded-b-lg shadow-sm border border-t-0 border-gray-100 min-h-[600px]">

                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 flex items-center gap-3 rounded-r shadow-sm">
                            <i class="fa-solid fa-check-circle text-green-500"></i>
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div id="content-infos" class="tab-content active">
                        <h3 class="text-3xl font-light text-ada-red mb-2">Ã€ propos de vous</h3>
                        <div class="mb-8 flex items-center gap-4 bg-gray-50 p-4 rounded-lg border border-gray-100">
                             <div class="relative w-12 h-12">
                                <svg class="w-full h-full" viewBox="0 0 100 100">
                                    <circle class="text-gray-200 stroke-current" stroke-width="8" cx="50" cy="50" r="40" fill="transparent"></circle>
                                    <circle class="text-ada-red progress-ring__circle stroke-current" stroke-width="8" stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent" 
                                            stroke-dasharray="251" 
                                            stroke-dashoffset="{{ 251 - ($progress / 100 * 251) }}"></circle>
                                </svg>
                                <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold">{{ round($progress) }}%</span>
                             </div>
                             <div>
                                 <p class="text-sm font-bold text-gray-800">ComplÃ©tion du profil</p>
                                 @if(!empty($objectives))
                                     <p class="text-xs text-red-500">Manquant : {{ $objectives[0] }}</p>
                                 @else
                                     <p class="text-xs text-green-500">Profil Ã  jour !</p>
                                 @endif
                             </div>
                        </div>

                        <form action="{{ route('client.profile.update') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">PrÃ©nom</label><input type="text" name="prenom" value="{{ ucfirst(strtolower($client->prenom)) }}" class="input-profile w-full p-3 rounded-md"></div>
                                <div><label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Nom</label><input type="text" name="nom" value="{{ strtoupper($client->nom) }}" class="input-profile w-full p-3 rounded-md"></div>
                                <div class="col-span-2"><label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Email</label><input type="email" name="email" value="{{ $client->email }}" class="input-profile w-full p-3 rounded-md"></div>
                                <div><label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">TÃ©lÃ©phone</label><input type="text" name="telephone" value="{{ $client->telephone }}" placeholder="06..." class="input-profile w-full p-3 rounded-md"></div>
                                <div><label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Ville</label><input type="text" name="ville" value="{{ $client->ville }}" placeholder="Paris..." class="input-profile w-full p-3 rounded-md"></div>
                                <div class="col-span-2"><label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Adresse</label><input type="text" name="adresse" value="{{ $client->adresse }}" placeholder="12 rue de..." class="input-profile w-full p-3 rounded-md"></div>
                            </div>
                            <div class="mt-8 flex justify-end">
                                <button type="submit" class="bg-ada-red text-white px-6 py-3 rounded-md font-bold text-xs uppercase hover:bg-black transition-colors">Sauvegarder</button>
                            </div>
                        </form>
                    </div>

                    <div id="content-paiement" class="tab-content">
                        <h3 class="text-3xl font-light text-ada-red mb-6">Moyens de paiement</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($cards as $card)
                            <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-6 rounded-xl text-white shadow-lg relative overflow-hidden group">
                                <form action="{{ route('client.card.remove', $card->id) }}" method="POST" class="absolute top-2 right-2 z-10">
                                    @csrf @method('DELETE')
                                    <button class="text-white/30 hover:text-red-500 transition-colors"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                <div class="absolute bottom-4 right-4 opacity-30"><i class="fa-brands fa-cc-{{ strtolower($card->brand) }} text-4xl"></i></div>
                                <p class="text-xs uppercase opacity-60 mb-6">{{ $card->brand }}</p>
                                <p class="text-xl font-mono tracking-widest mb-6">â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ {{ $card->last_four }}</p>
                                <div class="flex justify-between items-end">
                                    <p class="text-xs opacity-70">{{ strtoupper($client->nom) }}</p>
                                    <p class="text-sm font-bold">{{ $card->expiry_date }}</p>
                                </div>
                            </div>
                            @endforeach

                            <button onclick="document.getElementById('modal-card').classList.add('active')" class="border-2 border-dashed border-gray-300 rounded-xl p-4 min-h-[160px] flex flex-col items-center justify-center gap-2 text-gray-400 hover:border-ada-red hover:text-ada-red transition-colors">
                                <i class="fa-solid fa-plus text-2xl"></i><span class="font-bold text-sm">Ajouter une carte</span>
                            </button>
                        </div>
                    </div>

                    <div id="content-preferences" class="tab-content">
                        <h3 class="text-3xl font-light text-ada-red mb-6">PrÃ©fÃ©rences</h3>
                        <form action="{{ route('client.preferences.update') }}" method="POST" class="space-y-4">
                            @csrf
                            <label class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <div><span class="block font-bold text-sm">Newsletter ADA</span><span class="text-xs text-gray-500">Recevez nos offres exclusives.</span></div>
                                <input type="checkbox" name="newsletter" class="accent-ada-red h-5 w-5" {{ $client->newsletter_optin ? 'checked' : '' }}>
                            </label>
                            <label class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                <div><span class="block font-bold text-sm">SMS Notifications</span><span class="text-xs text-gray-500">Suivi de rÃ©servation en temps rÃ©el.</span></div>
                                <input type="checkbox" name="sms" class="accent-ada-red h-5 w-5" {{ $client->sms_optin ? 'checked' : '' }}>
                            </label>
                            <div class="pt-4"><button type="submit" class="bg-ada-red text-white px-6 py-2 rounded-md font-bold text-xs uppercase hover:bg-black transition-colors">Enregistrer</button></div>
                        </form>
                    </div>

                    <div id="content-famille" class="tab-content">
                        <h3 class="text-3xl font-light text-ada-red mb-6">Famille & Conducteurs</h3>
                        
                        <div class="space-y-4 mb-8">
                            @foreach($family as $member)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-ada-red/10 text-ada-red rounded-full flex items-center justify-center"><i class="fa-solid fa-user"></i></div>
                                    <div><p class="font-bold text-sm">{{ $member->prenom }} {{ $member->nom }}</p><p class="text-xs text-gray-500">{{ $member->relation }}</p></div>
                                </div>
                                <form action="{{ route('client.family.remove', $member->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-gray-400 hover:text-red-600"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                            @endforeach
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h4 class="font-bold text-sm mb-4">Ajouter un proche</h4>
                            <form action="{{ route('client.family.add') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @csrf
                                <input type="text" name="prenom" placeholder="PrÃ©nom" class="input-profile p-2 rounded text-sm" required>
                                <input type="text" name="nom" placeholder="Nom" class="input-profile p-2 rounded text-sm" required>
                                <select name="relation" class="input-profile p-2 rounded text-sm">
                                    <option value="Conjoint">Conjoint(e)</option>
                                    <option value="Enfant">Enfant</option>
                                    <option value="Ami">Ami(e)</option>
                                </select>
                                <div class="md:col-span-3 text-right">
                                    <button type="submit" class="bg-ada-dark text-white px-4 py-2 rounded text-xs font-bold uppercase hover:bg-black">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="modal-card" class="modal-overlay">
        <div class="bg-white p-8 rounded-xl max-w-md w-full m-4 shadow-2xl transform scale-100 transition-transform">
            <h3 class="text-xl font-bold mb-4 text-gray-800">Ajouter une carte</h3>
            <form action="{{ route('client.card.add') }}" method="POST" class="space-y-4">
                @csrf
                <div><label class="text-xs font-bold uppercase text-gray-500">NumÃ©ro</label><input type="text" name="number" placeholder="0000 0000 0000 0000" class="input-profile w-full p-3 rounded" maxlength="16" required></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-xs font-bold uppercase text-gray-500">Date (MM/YY)</label><input type="text" name="expiry" placeholder="12/26" class="input-profile w-full p-3 rounded" maxlength="5" required></div>
                    <div><label class="text-xs font-bold uppercase text-gray-500">CVV</label><input type="text" name="cvv" placeholder="123" class="input-profile w-full p-3 rounded" maxlength="3" required></div>
                </div>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="document.getElementById('modal-card').classList.remove('active')" class="text-gray-500 text-sm font-bold hover:underline">Annuler</button>
                    <button type="submit" class="bg-ada-red text-white px-6 py-2 rounded font-bold text-sm hover:bg-[#4a0528]">Valider</button>
                </div>
            </form>
        </div>
    </div>

    @keyframes shimmer { 100% { transform: skewX(-20deg) translateX(150%); } }

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-ada-red', 'text-ada-red', 'bg-white');
                btn.classList.add('border-transparent', 'text-gray-400');
                if(btn.querySelector('i')) btn.querySelector('i').classList.remove('text-ada-red');
            });
            const active = document.getElementById('tab-' + tabId);
            active.classList.add('active', 'border-ada-red', 'text-ada-red', 'bg-white');
            active.classList.remove('border-transparent', 'text-gray-400');
            if(active.querySelector('i')) active.querySelector('i').classList.add('text-ada-red');
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById('content-' + tabId).classList.add('active');
        }
    </script>
</body>
</html>
