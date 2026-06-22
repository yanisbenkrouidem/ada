<?php 
$title = 'La Maison ADA - Héritage & Savoir-faire'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* IMPORT FONTE CUSTOM */
        @font-face {
            font-family: 'FuturaLT';
            src: url('Public/fonts/FuturaLT.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* RESET & BASE */
        body {
            font-family: 'FuturaLT', 'Futura', 'Helvetica Neue', sans-serif;
            background-color: #ffffff;
            color: #000000;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            /* Espace pour ne pas cacher le contenu sous le header fixe */
            padding-top: 100px;
        }

        h1, h2, h3, h4, .lv-title {
            font-weight: 400; 
            letter-spacing: 0.02em;
        }
        
        /* --- HEADER STYLES (INTÉGRÉS) --- */
        #main-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #f3f3f3;
            color: #000000 !important;
            transition: all 0.3s ease;
        }
        /* Force les éléments du header en noir */
        #main-header a, #main-header span, #main-header button, #main-header i {
            color: #000000 !important;
        }
        #main-header img {
            filter: brightness(0) !important;
        }
        #main-header .nav-icon { stroke: #000000 !important; }
        
        /* SEARCH BAR HEADER */
        .nav-search-input {
            background-color: #f5f5f5 !important;
            border: 1px solid #e5e5e5 !important;
            color: #000000 !important;
            border-radius: 9999px;
            padding: 8px 20px 8px 40px;
            width: 240px;
            font-size: 13px;
            outline: none;
        }
        .nav-search-input::placeholder { color: #999 !important; }
        .nav-search-icon-pos {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #999 !important; pointer-events: none; font-size: 12px;
        }

        /* --- NAVIGATION SECONDAIRE (PAGE) --- */
        .nav-link {
            font-size: 13px;
            font-weight: 500;
            color: #6b7280; 
            text-decoration: none;
            margin: 0 15px;
            position: relative;
            transition: color 0.3s;
        }
        .nav-link:hover, .nav-link.active { color: #000; }
        .nav-link.active { border-bottom: 1px solid #000; padding-bottom: 4px; }

        /* --- UI ELEMENTS --- */
        .btn-lv {
            background-color: #000;
            color: #fff;
            padding: 14px 40px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            transition: all 0.3s ease;
            display: inline-block;
            border: 1px solid #000;
        }
        .btn-lv:hover {
            background-color: #fff;
            color: #000;
        }

        /* --- TIMELINE --- */
        .timeline-item {
            position: relative;
            padding-left: 0;
            padding-bottom: 60px;
            border-left: 1px solid #e5e5e5;
            margin-left: 20px;
            padding-left: 40px;
        }
        .timeline-item:last-child { border-left: transparent; }
        .timeline-year {
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 10px;
            line-height: 1;
        }
        .timeline-marker {
            position: absolute;
            left: -5px;
            top: 10px;
            width: 9px;
            height: 9px;
            background: #000;
            border-radius: 50%;
        }
    </style>
</head>
<body class="pb-20">

    <header id="main-header" class="fixed top-0 w-full z-[100] px-4 md:px-12 py-6 md:py-8 group">
        <div class="max-w-[1920px] mx-auto flex items-center justify-between">
            
            <div class="flex items-center gap-4 md:gap-6">
                <button class="flex items-center gap-3 cursor-pointer hover:opacity-70 transition-opacity focus:outline-none">
                    <svg width="20" height="12" viewBox="0 0 22 14" fill="none">
                        <line y1="1" x2="22" y2="1" class="nav-icon" style="stroke:black; stroke-width:1.5px;" />
                        <line y1="7" x2="22" y2="7" class="nav-icon" style="stroke:black; stroke-width:1.5px;" />
                        <line y1="13" x2="22" y2="13" class="nav-icon" style="stroke:black; stroke-width:1.5px;" />
                    </svg>
                    <span class="text-[13px] hidden md:block">Menu</span>
                </button>
                
                <div class="relative hidden lg:block">
                    <form action="{{ route('vehicules.flotte') }}" method="GET">
                        <i class="fa-solid fa-magnifying-glass nav-search-icon-pos"></i>
                        <input type="text" name="search_ville" class="nav-search-input" placeholder="Rechercher..." autocomplete="off">
                    </form>
                </div>
            </div>

            <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <a href="{{ route('home') }}" class="block hover:opacity-80 transition-opacity">
                    <img class="h-8 md:h-10 object-contain" src="{{ asset('images/ADAlogo1.png') }}" alt="ADA">
                </a>
            </div>

            <div class="flex items-center gap-4 md:gap-10">
                <a href="#" class="text-[13px] hidden md:block hover:opacity-70 transition-opacity font-medium">
                    Contactez-nous
                </a>
                
                <div class="flex items-center gap-4 md:gap-6">
                    <a href="{{ route('favoris.index') }}" class="relative hover:opacity-60 transition-opacity flex items-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="nav-icon" style="stroke:black; stroke-width:1.5px;">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="relative hover:opacity-60 transition-opacity flex items-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="nav-icon" style="stroke:black; stroke-width:1.5px;">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-[1400px] mx-auto px-6 text-center mt-10">
        <h1 class="text-4xl md:text-5xl mb-12">ADA France présenté par Yanis et Nathan,</h1>
        
        <div class="flex flex-wrap justify-center gap-4 md:gap-8 mb-24 border-b border-gray-100 pb-8">
            <a href="#propos" class="nav-link">À propos</a>
            <a href="#histoire" class="nav-link">Héritage</a>
            <a href="#agences" class="nav-link">Nos Agences</a>
            <a href="{{ route('carrieres') }}" class="nav-link">Carrières</a>
            <a href="#franchise" class="nav-link">Franchise</a>
            <a href="#actualites" class="nav-link">Actualités</a>
        </div>
    </div>

    <div id="propos" class="max-w-[1200px] mx-auto px-6 mb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="relative h-[600px] bg-gray-100 overflow-hidden">
                <img src="images/application_ADA_carre_a9ff601444.webp" class="w-full h-full object-cover">
                <div class="absolute bottom-10 left-10 text-white">
                    <span class="text-xs uppercase tracking-[0.3em] block mb-2">Vision</span>
                    <h3 class="text-3xl">Proximité & Liberté.</h3>
                </div>
            </div>
            
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6 block">Le Groupe ADA</span>
                <h2 class="text-3xl md:text-4xl mb-8 leading-tight">La location accessible partout et pour tous.</h2>
                
                <div class="text-gray-600 font-light leading-relaxed space-y-6 text-lg">
                    <p>
                        ADA œuvre chaque jour pour rapprocher les Français grâce à une offre de mobilité accessible à tous, à travers un réseau d’entrepreneurs présents sur tout le territoire.
                    </p>
                    <p>
                        Depuis sa création en 1984, ADA relève le défi de surprendre jour après jour ses clients avec une raison d’être simple et forte : <strong>démocratiser l’accès à la mobilité</strong> dans les territoires.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="histoire" class="bg-[#f9f9f9] py-24 mb-32">
        <div class="max-w-[1000px] mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Chronologie</span>
                <h2 class="text-4xl mt-3">Les grandes étapes.</h2>
                <p class="text-gray-500 mt-4">Découvrez les événements marquants et emblématiques du Groupe Ada.</p>
            </div>

            <div class="pl-4 md:pl-0">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">1984</div>
                    <h3 class="text-lg font-bold mb-2">L'Origine</h3>
                    <p class="text-gray-600 font-light max-w-2xl">Le concept de la « location à prix discount » canadien franchit l’Atlantique. Jean-Yves Vigouroux ouvre une première agence ADA à Brest.</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">1992</div>
                    <h3 class="text-lg font-bold mb-2">L'Expansion</h3>
                    <p class="text-gray-600 font-light max-w-2xl">Avec l’entrée du Groupe G7 (Groupe Rousselet) dans son capital, ADA passe à la vitesse supérieure.</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">2008</div>
                    <h3 class="text-lg font-bold mb-2">Innovation</h3>
                    <p class="text-gray-600 font-light max-w-2xl">Lancement d'une offre innovante d’auto-partage : avec ADA Malin, ADA propose la location à l’heure avant tout le monde.</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">2016 – 2017</div>
                    <h3 class="text-lg font-bold mb-2">Digitalisation & Services</h3>
                    <p class="text-gray-600 font-light max-w-2xl">Lancement de demenager.fr et de l’enseigne ADA Express : véhicules en libre-service 24h/24 via mobile.</p>
                </div>

                <div class="timeline-item border-l-0">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">2022</div>
                    <h3 class="text-lg font-bold mb-2">1000 Points de vente</h3>
                    <p class="text-gray-600 font-light max-w-2xl">Le réseau compte désormais 1000 points de vente en France, un maillage inégalé.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="agences" class="max-w-[1400px] mx-auto px-6 mb-32">
        <div class="text-center md:text-left mb-6">
            <span class="text-xs uppercase tracking-widest text-gray-500 block mb-2">Le Réseau</span>
            <h2 class="text-3xl md:text-4xl mb-2">Nos Adresses d'Exception.</h2>
            <p class="text-gray-600 mb-10">Un réseau de professionnels enraciné dans les territoires.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
            
            <a href="{{ route('agence.details', 1) }}" class="group cursor-pointer block">
                <div class="w-full aspect-[4/5] md:aspect-[1.2/1] mb-4 overflow-hidden">
                    <img src="{{ asset('images/macon.jpg') }}" alt="Agence Mâcon" class="w-full h-full object-cover">
                </div>
                <div class="text-left">
                    <span class="text-xs font-bold uppercase tracking-wide">Bourgogne</span>
                    <h3 class="text-xl mt-1 mb-1">Agence Mâcon Centre</h3>
                    <p class="text-xs text-gray-500 mb-4">26 Rue de la République • Professionnel de confiance</p>
                    <span class="text-xs font-bold border-b border-gray-300 pb-1 group-hover:border-black transition-colors">DÉCOUVRIR</span>
                </div>
            </a>

            <a href="{{ route('agence.details', 2) }}" class="group cursor-pointer block">
                <div class="w-full aspect-[4/5] md:aspect-[1.2/1] mb-4 overflow-hidden">
                    <img src="{{ asset('images/chalon.jpg') }}" alt="Agence Chalon" class="w-full h-full object-cover">
                </div>
                <div class="text-left">
                    <span class="text-xs font-bold uppercase tracking-wide">Bourgogne</span>
                    <h3 class="text-xl mt-1 mb-1">Agence Chalon-sur-Saône</h3>
                    <p class="text-xs text-gray-500 mb-4">12 Avenue Jean Jaurès • Service de proximité</p>
                    <span class="text-xs font-bold border-b border-gray-300 pb-1 group-hover:border-black transition-colors">DÉCOUVRIR</span>
                </div>
            </a>

        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="btn-lv">Trouver une agence</a>
        </div>
    </div>

    <div id="carrieres-section" class="bg-black text-white py-24 mb-32">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 block">Talents</span>
                    <h2 class="text-3xl md:text-4xl mb-6">Carrière chez ADA.</h2>
                    <p class="text-gray-400 font-light leading-relaxed mb-8">
                        Pour démarrer l’aventure ADA, ça se passe ici ! Nous sommes constamment à la recherche de nouveaux talents motivés.
                    </p>
                    <a href="{{ route('carrieres') }}" class="inline-block border-b border-white pb-1 text-sm hover:text-gray-300 transition-colors">Voir nos offres d'emploi</a>
                </div>

                <div id="franchise" class="border-t md:border-t-0 md:border-l border-gray-800 pt-12 md:pt-0 md:pl-16">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 block">Entreprendre</span>
                    <h2 class="text-3xl md:text-4xl mb-6">Devenez Franchisé.</h2>
                    <p class="text-gray-400 font-light leading-relaxed mb-8">
                        Envie d’ouvrir une franchise ou une licence ? Devenez acteur de la mobilité de demain avec le Groupe Ada.
                    </p>
                    <a href="#" class="btn-lv bg-white text-black border-white hover:bg-gray-200">Devenir Franchisé</a>
                </div>
            </div>
        </div>
    </div>

    <div id="actualites" class="max-w-[1000px] mx-auto px-6 mb-32 text-center">
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 block">Espace Presse</span>
        <h2 class="text-3xl md:text-4xl mb-8">Les dernières Actualités.</h2>

        <div class="bg-gray-50 p-8 md:p-12 mb-12 text-left flex flex-col md:flex-row gap-8 items-center">
            <div class="w-full md:w-1/3 aspect-video bg-gray-200 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-3">Partenariat Charge-In</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Ada a signé un partenariat stratégique avec Charge-in pour l'installation de bornes de recharge, facilitant le développement de sa flotte électrifiée.
                </p>
                <a href="#" class="text-xs font-bold underline">Lire le communiqué</a>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-16">
            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-4 block">Newsletter</span>
            <h3 class="text-2xl mb-8">Restez informé des innovations ADA.</h3>
            <button class="btn-lv">S'abonner</button>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
