<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Ada Location')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    
    {{-- CSS & Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { 'ada-red': '#5C0632' }
                }
            }
        }
    </script>

    <style>
        @font-face {
            font-family: 'FuturaLT';
            src: url('{{ asset("fonts/FuturaLT.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        body { font-family: 'Inter', sans-serif; }
        
        /* SIDEBARS */
        .sidebar-overlay {
            opacity: 0; visibility: hidden; transition: all 0.5s ease;
            position: fixed; inset: 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); z-index: 190;
        }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }

        #left-sidebar, #right-sidebar, #contact-sidebar, #cart-sidebar {
            transition: transform 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            position: fixed; top: 0; height: 100%; bg-white; z-index: 200;
            background-color: white;
        }
        
        #left-sidebar { left: 0; transform: translateX(-100%); }
        #right-sidebar { right: 0; transform: translateX(100%); }
        #contact-sidebar { right: 0; transform: translateX(100%); }
        #cart-sidebar { right: 0; transform: translateX(100%); }

        #left-sidebar.active, #right-sidebar.active, #contact-sidebar.active, #cart-sidebar.active { transform: translateX(0); }
    </style>
</head>
<body class="antialiased font-sans text-black bg-white">

    {{-- LOGIQUE PANIER SIDEBAR (CORRIGÉE) --}}
    @php
        $sidebarPaniers = collect([]);
        $cartCount = 0;
        $sidebarTotal = 0;

        if (\Illuminate\Support\Facades\Schema::hasTable('paniers')) {
            // C'EST ICI LA CORRECTION : 'vehicule.category' (ANGLAIS)
            $query = \App\Models\Panier::with('vehicule.category');
            
            if (auth()->guard('client')->check()) {
                $sidebarPaniers = $query->where('client_id', auth()->guard('client')->id())->get();
            } else {
                $sidebarPaniers = $query->where('session_id', session()->getId())->get();
            }
            
            $cartCount = $sidebarPaniers->count();
            $sidebarTotal = $sidebarPaniers->sum('prix_total');
        }
    @endphp

    {{-- Overlay sombre --}}
    <div id="sidebar-overlay" onclick="closeAllSidebars()" class="sidebar-overlay"></div>

    {{-- HEADER --}}
    @include('layouts.header') 

    {{-- CONTENU PRINCIPAL --}}
    <main>
        @yield('content')
    </main>

    {{-- CART SIDEBAR (INTEGRÉE DANS BASE POUR ETRE DISPO PARTOUT) --}}
    <div id="cart-sidebar" class="w-full md:w-[480px] flex flex-col shadow-2xl bg-white z-[200]">
        <div class="flex justify-between items-center p-8 md:p-10 border-b border-gray-100">
            <h2 class="text-xl font-normal tracking-wide font-sans">Mon Panier ({{ $cartCount }})</h2>
            <button onclick="closeAllSidebars()" class="p-2 hover:opacity-50 transition-opacity">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="square">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-8 md:px-10 py-6">
            @if($sidebarPaniers->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <p class="text-gray-500 font-light mb-6">Votre panier est actuellement vide.</p>
                    <a href="{{ route('vehicules.flotte') }}" class="inline-block bg-black text-white px-8 py-3 rounded-full text-sm font-medium">Voir les véhicules</a>
                </div>
            @else
                <div class="flex flex-col gap-8">
                    @foreach($sidebarPaniers as $item)
                        <div class="flex gap-6 border-b border-gray-50 pb-6 last:border-0">
                            <div class="w-24 h-24 bg-[#f6f5f3] flex items-center justify-center p-2 rounded-sm shrink-0">
                                {{-- Sécurité Image --}}
                                @php
                                    $catPhoto = $item->vehicule->category->photo ?? 'voiture.png';
                                @endphp
                                <img src="{{ asset('images/' . $catPhoto) }}" class="w-full h-full object-contain mix-blend-multiply" alt="Véhicule">
                            </div>
                            
                            <div class="flex-1 flex flex-col justify-between py-1">
                                <div>
                                    {{-- Sécurité Libellé --}}
                                    <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">{{ $item->vehicule->category->libelle ?? 'Catégorie' }}</p>
                                    <h3 class="text-sm font-medium text-black">{{ $item->vehicule->marque }} {{ $item->vehicule->modele }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($item->date_depart)->format('d/m') }} - {{ \Carbon\Carbon::parse($item->date_retour)->format('d/m') }}
                                    </p>
                                </div>
                                
                                <div class="flex justify-between items-end mt-2">
                                    <div class="border border-gray-200 rounded flex items-center h-8 bg-white">
                                        <form action="{{ route('panier.delete', $item->id) }}" method="POST" class="h-full">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-8 h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 transition-colors">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                        <div class="w-8 h-full flex items-center justify-center text-xs border-l border-gray-200">1</div>
                                    </div>
                                    <span class="text-sm font-medium">{{ number_format($item->prix_total, 2, ',', ' ') }} €</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @if(!$sidebarPaniers->isEmpty())
            <div class="p-8 md:p-10 border-t border-gray-100 bg-white">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-base font-normal text-gray-600">Total</span>
                    <span class="text-lg font-medium">{{ number_format($sidebarTotal, 2, ',', ' ') }} €</span>
                </div>
                
                <a href="{{ route('panier.index') }}" class="block w-full bg-black text-white text-center py-4 rounded-full text-sm font-medium hover:opacity-90 transition-opacity">
                    Valider mon panier
                </a>
            </div>
        @endif
    </div>

    {{-- SCRIPTS JS --}}
    <script>
        function closeAllSidebars(hideOverlay = true) {
            const sidebars = ['left-sidebar', 'right-sidebar', 'contact-sidebar', 'cart-sidebar'];
            sidebars.forEach(id => {
                const el = document.getElementById(id);
                if(el) el.classList.remove('active');
            });
            
            if(hideOverlay) {
                const overlay = document.getElementById('sidebar-overlay');
                if(overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Auto-open cart sidebar if session flash exists
        @if(session('cart_updated'))
            document.addEventListener('DOMContentLoaded', function() {
                const cart = document.getElementById('cart-sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                if(cart && overlay) {
                    cart.classList.add('active');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        @endif
    </script>

</body>
</html>
