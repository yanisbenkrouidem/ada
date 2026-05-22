<?php
// --- 1. LOGIQUE BACKEND (PHP) ---
$isConnected = false;
$headerPrenom = '';
$headerNom = '';
$clientId = '';

// Vérification de la session client
if (session()->has('client_id')) {
    $clientId = session('client_id');
    $clientDB = \App\Models\Client::find($clientId);
    
    if ($clientDB) {
        $isConnected = true;
        $headerPrenom = ucfirst(strtolower($clientDB->prenom)); 
        $headerNom = strtoupper($clientDB->nom);
    }
}

// --- LOGIQUE PANIER SIDEBAR ---
$sidebarPaniers = collect([]);
$cartCount = 0;

if (\Illuminate\Support\Facades\Schema::hasTable('paniers')) {
    $query = \App\Models\Panier::with('vehicule.category');
    
    if ($isConnected) {
        $sidebarPaniers = $query->where('client_id', $clientId)->get();
    } else {
        $sidebarPaniers = $query->where('session_id', session()->getId())->get();
    }
    
    $cartCount = $sidebarPaniers->count();
}

// --- LOGIQUE FAVORIS (Compteur) ---
$favorisCount = 0;
if ($isConnected && \Illuminate\Support\Facades\Schema::hasTable('favoris')) {
    $favorisCount = \Illuminate\Support\Facades\DB::table('favoris')
        ->where('client_id', $clientId)
        ->count();
}
?> 
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    
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
                    colors: { 'ada-red': '#5C0632' },
                    screens: {
                        'xs': '375px', // Petit mobile
                        'sm': '640px',
                        'md': '768px',
                        'lg': '1024px',
                        'xl': '1280px',
                    }
                }
            }
        }
    </script>

    <style>
        /* TYPOGRAPHIE & STYLE LV */
        @font-face {
            font-family: 'FuturaLT';
            src: url('<?php echo asset("fonts/FuturaLT.ttf"); ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        html, body {
            height: auto !important; 
            min-height: 100% !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }

        /* NAVBAR STYLE - FIXE SANS ANIMATION DE TAILLE */
        #main-header {
            transition: background-color 0.4s ease, color 0.4s ease, box-shadow 0.4s ease;
            background-color: transparent;
            color: #ffffff;
            border: none !important;
        }

        /* Style quand on SCROLLE ou au SURVOL */
        #main-header.scrolled, 
        #main-header:hover {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            color: #000000;
            box-shadow: 0 4px 30px rgba(0,0,0,0.03);
        }

        /* --- LOGO LOGIC --- */
        .header-logo-img {
            transition: all 0.5s ease;
            height: 1.8rem; /* Plus petit sur mobile */
            width: auto;
            filter: brightness(0) invert(1);
        }
        @media (min-width: 768px) {
            .header-logo-img { height: 2.5rem; }
        }
        
        #main-header.scrolled .header-logo-img,
        #main-header:hover .header-logo-img {
            filter: brightness(0);
        }

        /* ICONES */
        .nav-icon { 
            stroke: currentColor; 
            transition: stroke 0.5s ease;
            stroke-width: 1.5px; 
        }
        .nav-fill { fill: currentColor; transition: fill 0.5s ease; }

        .lv-text {
            font-family: 'FuturaLT', 'Inter', sans-serif;
            font-size: 13px; 
            font-weight: 400; 
            color: currentColor; 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0.04em; 
            text-transform: none;
        }
        .lv-text::first-letter { text-transform: uppercase; }

        /* --- SEARCH BAR NAVBAR STYLE (Desktop) --- */
        .nav-search-container {
            position: relative;
            display: none; /* Caché sur mobile/tablette */
        }
        @media (min-width: 1024px) { .nav-search-container { display: block; } }

        .nav-search-input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 9999px;
            padding: 8px 20px 8px 40px;
            width: 240px;
            transition: all 0.3s ease;
            font-size: 13px;
            outline: none;
            backdrop-filter: blur(4px);
        }
        .nav-search-input::placeholder { color: rgba(255, 255, 255, 0.7); opacity: 1; }
        
        .nav-search-input:focus {
            background: white;
            color: black;
            border-color: white;
            width: 280px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .nav-search-input:focus::placeholder { color: #999; }

        .nav-search-icon-pos {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: rgba(255,255,255,0.7); pointer-events: none; transition: color 0.3s;
            font-size: 12px;
        }

        /* Suggestions Dropdown */
        .nav-suggestions {
            position: absolute; top: 120%; left: 0; width: 100%;
            background: white; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 10px 0;
            opacity: 0; visibility: hidden; transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 50;
        }
        .nav-search-container:focus-within .nav-suggestions {
            opacity: 1; visibility: visible; transform: translateY(0);
        }
        .nav-suggestion-item {
            display: block; padding: 8px 20px; font-size: 12px; color: #333;
            cursor: pointer; transition: background 0.1s;
        }
        .nav-suggestion-item:hover { background: #f5f5f5; color: black; }
        .nav-suggestion-title {
            padding: 5px 20px; font-size: 10px; font-weight: 700; color: #999; letter-spacing: 0.05em; text-transform: uppercase;
        }

        /* SEARCH BAR ON SCROLLED HEADER */
        #main-header.scrolled .nav-search-input,
        #main-header:hover .nav-search-input {
            background: #f5f5f5;
            border-color: #e5e5e5;
            color: black;
        }
        #main-header.scrolled .nav-search-input:focus,
        #main-header:hover .nav-search-input:focus {
            background: white;
            border-color: #000;
        }
        #main-header.scrolled .nav-search-input::placeholder,
        #main-header:hover .nav-search-input::placeholder { color: #666; }
        
        #main-header.scrolled .nav-search-icon-pos,
        #main-header:hover .nav-search-icon-pos { color: #666; }


        /* SIDEBARS */
        .sidebar-overlay {
            opacity: 0; visibility: hidden; transition: all 0.5s ease;
            position: fixed; inset: 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); z-index: 190;
        }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }

        /* Sidebars responsive width handled by Tailwind classes */
        #left-sidebar, #right-sidebar, #contact-sidebar, #cart-sidebar {
            transition: transform 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            position: fixed; top: 0; height: 100%; 
            background-color: white;
            z-index: 200;
        }
        
        #left-sidebar { left: 0; transform: translateX(-100%); }
        #right-sidebar { right: 0; transform: translateX(100%); }
        #contact-sidebar { right: 0; transform: translateX(100%); }
        #cart-sidebar { right: 0; transform: translateX(100%); }

        #left-sidebar.active, #right-sidebar.active, #contact-sidebar.active, #cart-sidebar.active { transform: translateX(0); }

        /* LIENS SIDEBAR */
        .sidebar-menu-link {
            font-size: 16px; 
            font-weight: 400; 
            color: #1a1a1a; 
            padding: 16px 0; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            border-bottom: 1px solid transparent; 
            transition: color 0.3s;
            cursor: pointer;
        }
        
        .sidebar-menu-text { position: relative; display: inline-block; }
        .sidebar-menu-text::after {
            content: ''; position: absolute; left: 0; bottom: -2px; width: 100%; height: 1px;
            background-color: #000; transform: scaleX(0); transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .sidebar-menu-link:hover .sidebar-menu-text::after { transform: scaleX(1); }

        .sidebar-arrow {
            opacity: 0; transform: translateX(-10px); transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            color: #1a1a1a; font-size: 14px;
        }
        .sidebar-menu-link:hover .sidebar-arrow { opacity: 1; transform: translateX(0); }

        /* BOUTONS AUTH */
        .auth-btn-black {
            background-color: #000; color: #fff; border-radius: 9999px; width: 100%; display: block;
            padding: 16px 0; text-align: center; font-size: 13px; font-weight: 500; transition: opacity 0.3s;
        }
        .auth-btn-black:hover { opacity: 0.8; }

        .auth-btn-white {
            background-color: #fff; color: #000; border: 1px solid #e5e5e5; border-radius: 9999px; width: 100%; display: block;
            padding: 16px 0; text-align: center; font-size: 13px; font-weight: 500; transition: border-color 0.3s;
        }
        .auth-btn-white:hover { border-color: #000; }
        
        .logout-link {
            text-align: left; color: #d62828; font-size: 14px; margin-top: 10px; cursor: pointer; display: block;
        }
        .logout-link:hover { text-decoration: underline; }

        /* CONTACT */
        .contact-item {
            display: flex; align-items: center; gap: 1rem; padding: 1rem 0; 
            font-size: 13px; color: #000; cursor: pointer; transition: opacity 0.3s;
        }
        .contact-item:hover { opacity: 0.6; }
        .contact-icon { width: 20px; height: 20px; object-fit: contain; }
    </style>
</head>
<body class="antialiased font-sans">

    <div id="sidebar-overlay" onclick="closeAllSidebars()" class="sidebar-overlay"></div>

    <div id="left-sidebar" class="w-full md:w-[480px] flex flex-col p-6 md:p-10 shadow-2xl overflow-y-auto">
        <button onclick="closeAllSidebars()" class="flex items-center gap-4 text-black mb-12 md:mb-16 hover:opacity-60 transition-opacity w-fit group">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="square">
                <path d="M18 6L6 18M6 6l12 12"></path>
            </svg>
            <span class="text-sm font-light tracking-wide">Fermer</span>
        </button>
        
        <nav class="flex flex-col gap-2">
            <a href="<?php echo route('vehicules.flotte'); ?>" class="sidebar-menu-link group">
                <span class="sidebar-menu-text">Véhicules</span>
                <i class="fa-solid fa-chevron-right sidebar-arrow"></i>
            </a>
            <a href="<?php echo route('agences.liste'); ?>" class="sidebar-menu-link group">
                <span class="sidebar-menu-text">Agences</span>
                <i class="fa-solid fa-chevron-right sidebar-arrow"></i>
            </a>
            </nav>

        <div class="mt-auto pt-8 border-t border-gray-100">
            <p class="text-xs text-gray-400 mb-2">Besoin d'aide ?</p>
            <p class="text-sm text-black cursor-pointer hover:underline" onclick="openContactSidebar()">Contactez-nous</p>
        </div>
    </div>

    <div id="right-sidebar" class="w-full md:w-[480px] flex flex-col p-6 md:p-10 shadow-2xl overflow-y-auto">
        <div class="flex justify-between items-center mb-12 md:mb-16">
            <h2 class="text-lg font-normal">
                <?php if($isConnected): ?>
                    Mon espace
                <?php else: ?>
                    Identification
                <?php endif; ?>
            </h2>
            <button onclick="closeAllSidebars()" class="p-2 hover:opacity-50 transition-opacity">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="square">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex flex-col gap-10">
            <?php if($isConnected): ?>
                <div>
                    <h3 class="text-xl font-medium mb-1 text-gray-900">Bonjour <?php echo $headerPrenom; ?>,</h3>
                    <p class="text-sm text-gray-500 mb-8">Ravi de vous revoir chez Ada.</p>

                    <nav class="flex flex-col gap-4">
                        <a href="<?php echo route('client.profile'); ?>" class="sidebar-menu-link group">
                            <span class="sidebar-menu-text">Mon Tableau de Bord</span>
                            <i class="fa-solid fa-chevron-right sidebar-arrow"></i>
                        </a>
                        <a href="<?php echo route('favoris.index'); ?>" class="sidebar-menu-link group">
                            <span class="sidebar-menu-text">Ma Wishlist (<?php echo $favorisCount; ?>)</span>
                            <i class="fa-solid fa-chevron-right sidebar-arrow"></i>
                        </a>
                    </nav>

                    <div class="mt-10 border-t pt-6">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
                            Se déconnecter
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <div>
                    <h3 class="text-sm font-normal mb-6 text-gray-900">J'ai déjà un compte</h3>
                    <a href="<?php echo route('client.login.form'); ?>" class="auth-btn-black">M'identifier</a>
                </div>
                <div class="w-full h-px bg-gray-200"></div>
                <div>
                    <h3 class="text-sm font-normal mb-2 text-gray-900">Nouveau Client</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mb-6 font-light">Créez votre profil Ada pour une expérience personnalisée et plus rapide.</p>
                    <a href="<?php echo route('client.register.form'); ?>" class="auth-btn-white">Créer un compte</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="contact-sidebar" class="w-full md:w-[480px] flex flex-col p-6 md:p-12 shadow-2xl bg-white overflow-y-auto">
        <div class="flex justify-between items-start mb-12 md:mb-16">
            <h2 class="text-lg font-normal tracking-wide">Contactez-nous</h2>
            <button onclick="closeAllSidebars()" class="p-1 hover:opacity-50 transition-opacity">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <p class="text-xs md:text-[13px] text-gray-600 mb-12 font-light leading-relaxed">
            Où que vous soyez, les conseillers clientèle Ada seront ravis de vous aider.
        </p>

        <div class="flex flex-col gap-2 mb-12">
            <a href="tel:0805285959" class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="18" x2="12" y2="18"></line>
                </svg>
                <span>0 805 28 59 59</span>
            </a>

            <a href="mailto:serviceclient@ada.fr" class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span>serviceclient@ada.fr</span>
            </a>
        </div>
        <div class="w-full h-px bg-gray-100 mb-8"></div>

        <div class="mb-8">
            <h3 class="text-sm font-semibold text-black mb-2 uppercase tracking-wide">Message du concepteur,</h3>
            <p class="text-xs text-gray-500 mb-4 leading-relaxed">
               Pour toute question concernant le projet, suggestion d’amélioration, remarque ou signalement de problème, n’hésitez pas à me contacter.
            </p>
            <a href="https://fr.linkedin.com/in/yanisbenkrouidem" target="_blank" class="contact-item group" style="opacity: 1 !important;">
                <i class="fa-brands fa-linkedin text-xl text-[#0077b5] group-hover:scale-110 transition-transform"></i>
                <span class="font-medium text-[#0077b5]">Yanis Benkrouidem</span>
            </a>
        </div>
    </div>

    <div id="cart-sidebar" class="w-full md:w-[480px] flex flex-col shadow-2xl bg-white z-[200]">
        <div class="flex justify-between items-center p-6 md:p-10 border-b border-gray-100">
            <h2 class="text-xl font-normal tracking-wide font-sans">Mon Panier (<?php echo $cartCount; ?>)</h2>
            <button onclick="closeAllSidebars()" class="p-2 hover:opacity-50 transition-opacity">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="square">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-6 md:px-10 py-6">
            <?php if($sidebarPaniers->isEmpty()): ?>
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <p class="text-gray-500 font-light mb-6">Votre panier est actuellement vide.</p>
                    <a href="<?php echo route('vehicules.flotte'); ?>" class="auth-btn-black w-2/3">Voir les véhicules</a>
                </div>
            <?php else: ?>
                <div class="flex flex-col gap-8">
                    <?php foreach($sidebarPaniers as $item): ?>
                        <div class="flex gap-6 border-b border-gray-50 pb-6 last:border-0">
                            <div class="w-24 h-24 bg-[#f6f5f3] flex items-center justify-center p-2 rounded-sm shrink-0 overflow-hidden">
                                <?php 
                                    // --- MISE A JOUR LOGIQUE IMAGE ---
                                    // Priorité : Image spécifique Véhicule > Image Catégorie > Défaut
                                    $photoName = !empty($item->vehicule->image) ? $item->vehicule->image : ($item->vehicule->category->photo ?? 'voiture.png');
                                ?>
                                <img src="<?php echo asset('images/' . $photoName); ?>" class="w-full h-full object-cover" alt="Véhicule">
                            </div>
                            
                            <div class="flex-1 flex flex-col justify-between py-1">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider"><?php echo $item->vehicule->category->libelle ?? 'Premium'; ?></p>
                                    <h3 class="text-sm font-medium text-black"><?php echo $item->vehicule->marque . ' ' . $item->vehicule->modele; ?></h3>
                                    
                                    <p class="text-xs text-gray-400 mt-1 italic">
                                        Dates à confirmer
                                    </p>
                                </div>
                                
                                <div class="flex justify-between items-end mt-2">
                                    <div class="border border-gray-200 rounded flex items-center h-8 bg-white">
                                        <form action="<?php echo route('panier.delete', $item->id); ?>" method="POST" class="h-full">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="w-8 h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 transition-colors">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                        <div class="w-8 h-full flex items-center justify-center text-xs border-l border-gray-200">1</div>
                                    </div>
                                    
                                    <span class="text-sm font-medium text-gray-400">-- €</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!$sidebarPaniers->isEmpty()): ?>
            <div class="p-6 md:p-10 border-t border-gray-100 bg-white">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-base font-normal text-gray-600">Total estimé</span>
                    <span class="text-lg font-medium">-- €</span>
                </div>
                
                <a href="<?php echo route('panier.index'); ?>" class="block w-full bg-black text-white text-center py-4 rounded-full text-sm font-medium hover:opacity-90 transition-opacity">
                    Finaliser la commande
                </a>
            </div>
        <?php endif; ?>
    </div>

    <header id="main-header" class="fixed top-0 w-full z-[100] px-4 md:px-12 py-6 md:py-8 group">
        <div class="max-w-[1920px] mx-auto flex items-center justify-between">
            
            <div class="flex items-center gap-4 md:gap-6">
                <button onclick="openLeftSidebar()" class="flex items-center gap-3 cursor-pointer hover:opacity-70 transition-opacity focus:outline-none">
                    <svg width="20" height="12" viewBox="0 0 22 14" fill="none">
                        <line y1="1" x2="22" y2="1" class="nav-icon" />
                        <line y1="7" x2="22" y2="7" class="nav-icon" />
                        <line y1="13" x2="22" y2="13" class="nav-icon" />
                    </svg>
                    <span class="lv-text nav-text-color hidden md:block">Menu</span>
                </button>
                
                <div class="nav-search-container">
                    <form action="<?php echo route('vehicules.flotte'); ?>" method="GET">
                        <i class="fa-solid fa-magnifying-glass nav-search-icon-pos"></i>
                        <input type="text" id="navSearchInput" name="search_ville" class="nav-search-input" placeholder="Rechercher..." autocomplete="off">
                        
                        <div class="nav-suggestions">
                            <div class="nav-suggestion-title">Agences Populaires</div>
                            <span onclick="fillNavSearch('Mâcon')" class="nav-suggestion-item">Mâcon</span>
                            <span onclick="fillNavSearch('Chalon')" class="nav-suggestion-item">Chalon</span>
                            <span onclick="fillNavSearch('Lyon')" class="nav-suggestion-item">Lyon</span>
                            <span onclick="fillNavSearch('Paris')" class="nav-suggestion-item">Paris</span>
                        </div>
                    </form>
                </div>

                <a href="<?php echo route('location.search.form'); ?>" class="lg:hidden flex items-center gap-3 cursor-pointer hover:opacity-70 transition-opacity">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="block">
                        <circle cx="11" cy="11" r="7" class="nav-icon" />
                        <path d="M20 20L16 16" class="nav-icon" stroke-linecap="square"/>
                    </svg>
                </a>
            </div>

            <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <a href="<?php echo route('home'); ?>" class="block hover:opacity-80 transition-opacity">
                    <img class="header-logo-img object-contain" src="<?php echo asset('images/ADAlogo1.png'); ?>" alt="ADA">
                </a>
            </div>

            <div class="flex items-center gap-4 md:gap-10">
                <?php if($isConnected): ?>
                    <a href="#" onclick="openRightSidebar(); return false;" class="lv-text nav-text-color hidden md:block hover:opacity-70 transition-opacity font-medium">
                        Bonjour <?php echo $headerPrenom; ?>
                    </a>
                <?php else: ?>
                    <a href="#" onclick="openContactSidebar(); return false;" class="lv-text nav-text-color hidden md:block hover:opacity-70 transition-opacity cursor-pointer">
                        Contactez-nous
                    </a>
                <?php endif; ?>
                
                <div class="flex items-center gap-4 md:gap-6">
                    <a href="#" onclick="openContactSidebar(); return false;" class="hover:opacity-60 transition-opacity md:hidden">
                       <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="nav-icon">
                           <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                       </svg>
                    </a>

                    <?php 
                        // Si connecté -> Mes Favoris
                        // Si PAS connecté -> Login Client (et non Admin)
                        $favorisLink = $isConnected ? route('favoris.index') : route('client.login.form');
                    ?>
                    <a href="<?php echo $favorisLink; ?>" class="relative hover:opacity-60 transition-opacity flex items-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="nav-icon">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <?php if($favorisCount > 0): ?>
                            <span class="absolute -right-0.5 -top-0.5 w-2.5 h-2.5 rounded-full border border-current flex items-center justify-center text-[6px] font-medium nav-text-color shrink-0" style="border-width: 1px;">
                                <?php echo $favorisCount; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    
                    <button onclick="openRightSidebar()" class="hover:opacity-60 transition-opacity focus:outline-none">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" class="nav-icon">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                    
                    <a href="#" onclick="openCartSidebar(); return false;" class="relative hover:opacity-60 transition-opacity flex items-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="nav-icon">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="absolute -right-0.5 -top-0.5 w-2.5 h-2.5 rounded-full border border-current flex items-center justify-center text-[6px] font-medium nav-text-color shrink-0" style="border-width: 1px;">
                            <?php echo $cartCount; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <form id="logout-form" action="<?php echo route('client.logout'); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>

    <script>
        // HEADER SCROLL LOGIC
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('main-header');
            function updateHeader() {
                if (window.scrollY > 20) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            window.addEventListener('scroll', updateHeader);
            updateHeader();
        });

        // NAVBAR TYPING EFFECT
        const citiesNav = ["Rechercher Mâcon", "Rechercher Chalon", "Rechercher Lyon"];
        const navInput = document.getElementById("navSearchInput");
        if(navInput) {
            let nCityIndex = 0, nCharIndex = 0, nIsDeleting = false;
            function navTypeEffect() {
                if (navInput.value.length > 0 && navInput !== document.activeElement) return;
                const current = citiesNav[nCityIndex];
                if (nIsDeleting) {
                    navInput.setAttribute("placeholder", current.substring(0, nCharIndex - 1));
                    nCharIndex--;
                } else {
                    navInput.setAttribute("placeholder", current.substring(0, nCharIndex + 1));
                    nCharIndex++;
                }
                let speed = nIsDeleting ? 40 : 80;
                if (!nIsDeleting && nCharIndex === current.length) { nIsDeleting = true; speed = 2000; }
                else if (nIsDeleting && nCharIndex === 0) { nIsDeleting = false; nCityIndex = (nCityIndex + 1) % citiesNav.length; speed = 500; }
                setTimeout(navTypeEffect, speed);
            }
            setTimeout(navTypeEffect, 1000);
        }

        // FILL SEARCH FROM SUGGESTION
        function fillNavSearch(ville) {
            const input = document.getElementById('navSearchInput');
            input.value = ville;
            input.form.submit();
        }

        // SIDEBARS LOGIC
        const leftSidebar = document.getElementById('left-sidebar');
        const rightSidebar = document.getElementById('right-sidebar');
        const contactSidebar = document.getElementById('contact-sidebar');
        const cartSidebar = document.getElementById('cart-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openLeftSidebar() { closeAllSidebars(false); leftSidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
        function openRightSidebar() { closeAllSidebars(false); rightSidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
        function openContactSidebar() { closeAllSidebars(false); contactSidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
        function openCartSidebar() { closeAllSidebars(false); cartSidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }

        function closeAllSidebars(hideOverlay = true) {
            leftSidebar.classList.remove('active');
            rightSidebar.classList.remove('active');
            contactSidebar.classList.remove('active');
            cartSidebar.classList.remove('active');
            if(hideOverlay) { overlay.classList.remove('active'); document.body.style.overflow = ''; }
        }
    </script>
    
    <?php if(session('cart_updated')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() { openCartSidebar(); });
    </script>
    <?php endif; ?>

    <style>
        #main-header { z-index: 100 !important; }
        .cursor-pointer { cursor: pointer !important; }
    </style>
</body>
</html>