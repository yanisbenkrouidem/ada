<?php
// --- 1. BLOC PHP DE CONFIGURATION (Pas de HTML ici) ---
$title = 'Location de véhicules - ADA';

// On charge le header partiel si la fonction existe (pour Laravel)
if (function_exists('resource_path')) {
    require resource_path('views/layouts/header.blade.php');
}

// DONNÉES DE DÉMO
$tourisme = [
    ['id' => 106, 'libelle' => 'Fun Premium', 'exemple' => 'Mini cooper ou similaire', 'photo' => function_exists('asset') ? asset('images/funpremium.jpg') : 'images/funpremium.jpg'],
    ['id' => 111, 'libelle' => 'SUV et tout chemin', 'exemple' => 'Opel Mokka ou similaire', 'photo' => function_exists('asset') ? asset('images/suv.jpg') : 'images/suv.jpg'],
    ['id' => 110, 'libelle' => 'Grande Premium', 'exemple' => 'Mercedes Classe C ou similaire', 'photo' => function_exists('asset') ? asset('images/grandepremium.jpg') : 'images/grandepremium.jpg'],
    ['id' => 114, 'libelle' => 'Monospace 7 Places', 'exemple' => 'Ford Galaxy ou similaire', 'photo' => function_exists('asset') ? asset('images/monospace.jpg') : 'images/monospace.jpg'],
    ['id' => 105, 'libelle' => 'Fun Confort', 'exemple' => 'Smart fortwo, Fiat 500', 'photo' => function_exists('asset') ? asset('images/funconfort.jpg') : 'images/funconfort.jpg']
];

$utilitaires = [
    ['id' => 117, 'libelle' => 'Catégorie A', 'exemple' => 'Renault Kangoo, 3 m³', 'photo' => function_exists('asset') ? asset('images/ca.jpg') : 'images/ca.jpg'],
    ['id' => 123, 'libelle' => 'Catégorie E', 'exemple' => 'Camion 20/23 m³', 'photo' => function_exists('asset') ? asset('images/ce.jpg') : 'images/ce.jpg'],
    ['id' => 125, 'libelle' => 'Catégorie G', 'exemple' => 'Camion benne (Gravats)', 'photo' => function_exists('asset') ? asset('images/cg.jpg') : 'images/cg.jpg'],
    ['id' => 119, 'libelle' => 'Catégorie B', 'exemple' => 'Fourgon 6/7 m³', 'photo' => function_exists('asset') ? asset('images/cb.jpg') : 'images/cb.jpg']
];

$heures = [];
for($h=7; $h<=22; $h++) {
    $heures[] = sprintf("%02d:00", $h);
    $heures[] = sprintf("%02d:30", $h);
}

// IMAGES A PRECHARGER
$heroImage1 = function_exists('asset') ? asset('images/2ff256d5c8.webp') : 'images/2ff256d5c8.webp';
$heroImage2 = function_exists('asset') ? asset('images/williamsreunauly.jpg') : 'images/williamsreunauly.jpg';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ada Location</title>
    <link rel="icon" type="image/png" href="<?php echo function_exists('asset') ? asset('images/ada.png') : 'images/ada.png'; ?>">
    
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover">
    <meta name="theme-color" content="#0a0a0f">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <link rel="preload" as="image" href="<?php echo $heroImage1; ?>">
    <link rel="preload" as="image" href="<?php echo $heroImage2; ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Schibsted+Grotesk:wght@300;400;500;600;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @font-face {
            font-family: 'FuturaLT';
            src: url('<?php echo function_exists('asset') ? asset('fonts/FuturaLT.ttf') : 'fonts/FuturaLT.ttf'; ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        :root {
            --liquid-border: rgba(255, 255, 255, 0.35);
            --liquid-bg: rgba(255, 255, 255, 0.20);
            --liquid-blur: blur(50px) saturate(180%);
        }

        html, body {
            height: 100%; margin: 0; padding: 0; overflow-x: hidden;
            background-color: #ffffff; color: #000;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* --- LAYOUT HERO --- */
        .hero-wrapper {
            position: relative;
            height: 100vh; /* Full viewport height */
            height: 100dvh; /* Dynamic viewport height for mobile */
            width: 100%;
            background: #000;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* --- SEARCH BAR RESPONSIVE --- */
        .ab-search-wrapper {
            position: relative;
            z-index: 100;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 16px; /* Padding mobile */
        }

        .ab-tabs { display: flex; justify-content: center; gap: 32px; margin-bottom: 20px; }
        .ab-tab-link { color: rgba(255, 255, 255, 0.7); font-size: 16px; font-weight: 400; cursor: pointer; padding-bottom: 8px; position: relative; transition: color 0.2s; }
        .ab-tab-link:hover { color: rgba(255, 255, 255, 0.9); }
        .ab-tab-link.active { color: white; font-weight: 600; }
        .ab-tab-link.active::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 100%; height: 2px; background: white; }

        .ab-bar {
            background: #EBEBEB;
            border-radius: 40px;
            display: flex;
            align-items: center;
            position: relative;
            height: 66px;
            border: 1px solid #DDDDDD;
            box-shadow: 0 16px 32px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        /* MOBILE: Transformation de la barre en pile verticale */
        @media (max-width: 768px) {
            .ab-bar {
                flex-direction: column;
                height: auto;
                border-radius: 24px;
                padding: 8px;
                gap: 8px;
                background: white;
            }
            .ab-divider { display: none; }
            .ab-section {
                width: 100%;
                height: 60px;
                border-radius: 16px;
                background: #F3F4F6;
                margin-bottom: 0;
                padding: 0 20px;
            }
            .ab-section:active, .ab-section:focus-within {
                background: #E5E7EB;
            }
            .highlight-blob { display: none; }
            .ab-search-btn {
                width: 100%;
                height: 56px;
                border-radius: 16px;
                margin-top: 4px;
            }
            .hero-wrapper {
                justify-content: center;
                padding-bottom: 80px;
            }
        }

        /* DESKTOP: Blob animation */
        @media (min-width: 769px) {
            .highlight-blob {
                position: absolute; top: 0; left: 0; height: 100%; background-color: #fff; border-radius: 40px;
                box-shadow: 0 6px 20px rgba(0,0,0,0.2); transition: all 0.25s cubic-bezier(0.2, 0, 0, 1); opacity: 0; pointer-events: none; z-index: 1;
            }
            .ab-section {
                position: relative; height: 100%; display: flex; flex-direction: column; justify-content: center;
                padding: 0 32px; cursor: pointer; border-radius: 32px; flex: 1; z-index: 2; background: transparent;
            }
            .ab-section:hover:not(.active-section) { background-color: rgba(255, 255, 255, 0.5); }
            .ab-section.search-button-section { flex: 0.8; padding: 0 10px; justify-content: center; align-items: center; }
            .ab-divider { width: 1px; height: 32px; background-color: #DDDDDD; flex-shrink: 0; transition: opacity 0.1s; z-index: 2; }
        }
          
        .ab-label { font-size: 12px; font-weight: 800; letter-spacing: 0.04em; color: #000; margin-bottom: 2px; display: block; }
        .ab-input { background: transparent; border: none; outline: none; font-size: 14px; color: #717171; font-weight: 400; width: 100%; padding: 0; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; display: block; }
        .ab-input::placeholder { color: #717171; opacity: 0.8; }

        .ab-search-btn {
            background: #0E2A47; 
            color: white; 
            border: none; 
            cursor: pointer; 
            flex-shrink: 0; 
            transition: all 0.2s ease; 
            font-weight: 600; 
            font-size: 15px; 
            display: flex; align-items: center; justify-content: center; gap: 8px; z-index: 10;
        }
        @media (min-width: 769px) {
            .ab-search-btn { height: 48px; width: 100%; border-radius: 24px; padding: 0 20px; }
        }
        .ab-search-btn:hover { background: #061524; transform: scale(1.02); }

        /* --- CALENDRIER RESPONSIVE OPTIMISÉ --- */
        .inline-calendar-container input, #inline-flatpickr, .flatpickr-input { position: fixed !important; top: -1000px !important; left: -1000px !important; visibility: hidden !important; pointer-events: none !important; }
        
        .date-popup-wrapper { 
            position: absolute; bottom: 85px; left: 50%; transform: translateX(-50%); 
            background: white; border-radius: 32px; padding: 24px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.15); z-index: 200; display: none; 
            width: 850px; max-width: 95vw; /* S'adapte mieux aux mobiles */
            animation: popupInUp 0.25s ease-out forwards; 
        }
        @media (max-width: 768px) {
            .date-popup-wrapper {
                bottom: 20px; 
                padding: 15px;
                border-radius: 20px;
                width: 95%; /* Prend presque tout l'écran */
                max-height: 85vh;
                overflow-y: auto;
            }
        }

        .inline-calendar-container { display: flex; justify-content: center; width: 100%; margin-top: 5px; }
        .flatpickr-calendar.inline { width: 100% !important; margin: 0 auto !important; box-shadow: none !important; border: none !important; background: transparent !important; }
        .flatpickr-innerContainer { display: flex !important; justify-content: center !important; gap: 30px !important; width: 100%; }
        .flatpickr-rContainer { display: block !important; width: 100%; }
        .flatpickr-months { display: flex !important; justify-content: center !important; gap: 30px !important; margin-bottom: 10px !important; width: 100%; }
        
        /* CSS SPÉCIFIQUE MOBILE POUR CALENDRIER */
        @media (max-width: 768px) {
            .flatpickr-innerContainer { flex-direction: column !important; gap: 10px !important; }
            .flatpickr-months { flex-wrap: wrap !important; gap: 0 !important; }
            .flatpickr-month { width: 100% !important; }
            .flatpickr-days { width: 100% !important; }
            .dayContainer { 
                width: 100% !important; 
                min-width: 0 !important; 
                max-width: none !important; 
                justify-content: space-around !important; 
            }
            .flatpickr-weekday-container { width: 100% !important; max-width: none !important; }
            .flatpickr-weekday { flex: 1 !important; }
        }

        /* CSS DESKTOP STANDARD */
        @media (min-width: 769px) {
            .flatpickr-month { height: 40px !important; overflow: visible !important; width: 320px !important; flex-shrink: 0 !important; }
            .dayContainer { display: flex !important; flex-wrap: wrap !important; justify-content: space-around !important; width: 320px !important; min-width: 320px !important; max-width: 320px !important; padding: 0 !important; margin: 0 !important; outline: none !important; flex-shrink: 0 !important; }
            .flatpickr-weekday-container { display: flex !important; width: 320px !important; max-width: 320px !important; justify-content: space-between !important; flex-shrink: 0 !important; }
        }

        .flatpickr-current-month { font-size: 16px !important; font-weight: 700 !important; padding-top: 0 !important; width: 100% !important; left: 0 !important; }
        .flatpickr-days { display: flex !important; justify-content: center !important; gap: 30px !important; width: auto !important; border: none !important; align-items: flex-start !important; flex-shrink: 0 !important; }
        
        .flatpickr-weekdays { display: flex !important; width: auto !important; justify-content: center !important; gap: 30px !important; margin-bottom: 10px; flex-shrink: 0 !important; overflow: hidden !important; }
        
        .flatpickr-weekday { font-weight: 600 !important; color: #717171 !important; font-size: 12px !important; text-align: center !important; flex: 1 !important; display: block !important; }
        .flatpickr-day { width: 14.28% !important; height: 40px !important; line-height: 40px !important; margin: 0 !important; border-radius: 50% !important; border: 1px solid transparent !important; font-weight: 500 !important; font-size: 14px !important; max-width: 40px !important; }
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { background: #000 !important; color: #fff !important; border-color: #000 !important; }
        .flatpickr-day.inRange { background: #F3F3F3 !important; border-color: #F3F3F3 !important; box-shadow: -5px 0 0 #F3F3F3, 5px 0 0 #F3F3F3 !important; color: #000 !important; border-radius: 0 !important; }
        .flatpickr-day.today { border-color: transparent !important; font-weight: 900 !important; }
        .flatpickr-day:hover { background: #EBEBEB !important; }
        .flatpickr-next-month, .flatpickr-prev-month { top: 0 !important; padding: 10px !important; z-index: 100; }
        .flatpickr-prev-month { left: 0 !important; }
        .flatpickr-next-month { right: 0 !important; }

        /* POPUPS LIEU */
        .location-popup-wrapper { 
            position: absolute; bottom: 85px; left: 0; width: 420px; background: white; border-radius: 32px; padding: 24px 0; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.15); z-index: 200; display: none; animation: popupInUp 0.25s ease-out forwards; overflow: hidden; 
        }
        @media (max-width: 768px) {
            .location-popup-wrapper { width: 100%; bottom: 10px; border-radius: 20px; }
        }

        .loc-title { padding: 0 24px 12px 24px; font-size: 12px; font-weight: 700; color: #717171; text-transform: uppercase; letter-spacing: 0.5px; }
        .loc-suggestion { display: flex; align-items: center; padding: 12px 24px; cursor: pointer; transition: background 0.1s; }
        .loc-suggestion:hover { background: #f7f7f7; }
        .loc-icon-bg { background: #F1F1F1; min-width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 16px; }
        .loc-icon-bg i { font-size: 20px; color: #222; }
        .loc-text { display: flex; flex-direction: column; }
        .loc-city { font-weight: 600; font-size: 16px; color: #222; }
        .loc-desc { font-size: 14px; color: #717171; }
        .time-selector-footer { border-top: 1px solid #EBEBEB; padding-top: 20px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; margin-top: 20px; gap: 15px; }
        .time-group { display: flex; align-items: center; gap: 10px; }
        .time-label { font-size: 14px; font-weight: 600; color: #717171; }
        .time-select { padding: 8px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; font-weight: 500; outline: none; cursor: pointer; background-color: white; }

        /* HERO SLIDES & OMBRES AMÉLIORÉES */
        /* Modification: contraste renforcé et qualité */
        .hero-slide { 
            position: absolute; inset: 0; background-size: cover; background-position: center; 
            transition: opacity 1s ease-in-out; will-change: opacity; 
            filter: contrast(1.1) saturate(1.15) brightness(0.95); 
            image-rendering: -webkit-optimize-contrast;
        }
        /* Modification: Ombres haut et bas */
        .hero-shadow-overlay { 
            position: absolute; inset: 0; z-index: 3; pointer-events: none; 
            background: linear-gradient(to bottom, 
                rgba(0,0,0,0.4) 0%, 
                rgba(0,0,0,0) 20%, 
                rgba(0,0,0,0) 60%, 
                rgba(0,0,0,0.8) 100%
            );
        }
        .slide-hidden { opacity: 0; z-index: 0; pointer-events: none; }
        .slide-visible { opacity: 1; z-index: 1; pointer-events: auto; }
        #slide-video-layer { z-index: 1; overflow: hidden; } 
        #slide-image-layer { z-index: 2; }

        /* CAROUSEL RESPONSIVE */
        .lv-marquee-wrapper { width: 100%; overflow: hidden; display: flex; white-space: nowrap; position: relative; }
        .lv-marquee-track { display: flex; align-items: flex-start; animation: lv-infinite-scroll 60s linear infinite; width: max-content; }
        @keyframes lv-infinite-scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-33.33%); } }
        
        .lv-carousel-item { width: 25vw; min-width: 320px; flex-shrink: 0; padding: 0 4px; cursor: pointer; text-decoration: none; }
        /* Mobile: Item plus grand pour tactile */
        @media (max-width: 768px) {
            .lv-carousel-item { width: 85vw; min-width: 85vw; }
        }

        /* MODALS */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(20px); z-index: 9999; display: none; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s ease; padding: 1rem; }
        .modal-overlay.active { display: flex; opacity: 1; }
        .modal-content { background: rgba(20, 20, 20, 0.7); backdrop-filter: blur(40px); border: 1px solid rgba(255,255,255,0.2); padding: 2rem; border-radius: 32px; max-width: 600px; width: 100%; color: white; }

        /* CREDITS */
        .credits-overlay { position: fixed; inset: 0; background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); z-index: 99999; display: none; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.5s ease; }
        .credits-overlay.visible { opacity: 1; }
        .credits-modal { background-color: #ffffff; width: 100%; max-width: 800px; padding: 40px 50px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); position: relative; transform: translateY(30px); opacity: 0; transition: all 0.8s cubic-bezier(0.19, 1, 0.22, 1); border: 1px solid #f0f0f0; }
        .credits-overlay.visible .credits-modal { transform: translateY(0); opacity: 1; }
        .credits-close-top { position: absolute; top: 20px; right: 30px; font-size: 11px; text-decoration: underline; color: #666; cursor: pointer; text-transform: uppercase; letter-spacing: 0.05em; }
        .credits-title { font-family: 'Inter', sans-serif; font-weight: 700; font-size: 20px; margin-bottom: 20px; color: #000; letter-spacing: -0.02em; }
        .credits-text { font-family: 'Inter', sans-serif; font-size: 13px; line-height: 1.8; color: #333; margin-bottom: 30px; text-align: justify; }
        .credits-profiles { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 40px; }
        .profile-link { border: 1px solid #000; padding: 8px 16px; font-size: 12px; font-weight: 600; color: #000; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; }
        .profile-link:hover { background-color: #f5f5f5; }
        .credits-actions { display: flex; justify-content: flex-end; align-items: center; gap: 30px; border-top: 1px solid #eee; padding-top: 25px; }
        .credits-btn-black { background-color: #000; color: #fff; padding: 15px 40px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; border: none; cursor: pointer; transition: background-color 0.3s; }
        .credits-btn-black:hover { background-color: #333; }
        @media (max-width: 768px) { .credits-modal { max-width: 90vw; padding: 30px 25px; } .credits-actions { flex-direction: column; align-items: stretch; } .credits-btn-black { width: 100%; } }
        .liquid-btn { background: rgba(255,255,255,0.25) !important; border: 1px solid rgba(255,255,255,0.4) !important; backdrop-filter: blur(20px); color: white !important; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px; }
        .liquid-btn:hover { background: white !important; color: black !important; }
        
        @keyframes popupInUp { from { opacity: 0; transform: translate(-50%, 20px); } to { opacity: 1; transform: translate(-50%, 0); } }
        
        /* Suppression des onglets Dates/Mois/Flexible dans CSS si nécessaire, ou on les retire du HTML */
        .popup-tabs { display: none; }
    </style>
</head>
<body>

<div class="w-full overflow-x-hidden font-sans bg-white" onclick="closePopupsOnClickOutside(event)">

    <section id="hero-section" class="hero-wrapper relative w-full flex flex-col items-center overflow-visible pb-[40px] md:pb-[40px]">
        <div id="slider-container" class="absolute inset-0 w-full h-full pointer-events-none">
            <div class="hero-shadow-overlay"></div>
            <div id="slide-video-layer" class="hero-slide slide-visible absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('<?php echo function_exists('asset') ? asset('images/2ff256d5c8.webp') : 'images/2ff256d5c8.webp'; ?>');"></div>
            <div id="slide-image-layer" class="hero-slide slide-hidden absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-1000" style="background-image: url('<?php echo function_exists('asset') ? asset('images/williamsreunauly.jpg') : 'images/williamsreunauly.jpg'; ?>');"></div>
        </div>
        
        <div class="relative w-full z-40 max-w-[1440px] mx-auto px-4 md:px-12 flex flex-col items-center justify-end h-full md:pb-10">
            
            <div class="text-center w-full mb-6 md:mb-8 drop-shadow-lg mt-auto">
                <p id="hero-subtitle" class="text-xs md:text-sm font-medium mb-2 tracking-widest text-white opacity-90">
                    L'élégance et la performance
                </p>
                <h1 id="hero-title" class="text-xl md:text-3xl lg:text-4xl mb-6 font-bold tracking-wide text-white" style="font-family: 'FuturaLT', sans-serif;">
                    Louez bien plus<br class="md:hidden"> qu'une voiture.
                </h1>
                <a href="<?php echo function_exists('route') ? route('vehicules.flotte') : '#'; ?>" class="inline-block border-b border-white pb-1 hover:text-gray-300 hover:border-gray-300 transition text-sm tracking-widest text-white">
                    Découvrir le catalogue
                </a>
            </div>

            <div class="ab-search-wrapper" onclick="event.stopPropagation()">
                
                <div class="ab-tabs">
                    <div class="ab-tab-link active" id="tab-voiture" onclick="switchTab('voiture')">Voitures</div>
                    <div class="ab-tab-link" id="tab-utilitaire" onclick="switchTab('utilitaire')">Utilitaires</div>
                </div>

                <?php if(isset($errors) && $errors->any()): ?>
                    <div class="bg-red-500 text-white p-4 rounded-xl mb-4 mx-auto max-w-lg shadow-lg">
                        <ul class="list-disc pl-5">
                            <?php foreach ($errors->all() as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo route('vehicules.flotte'); ?>" method="GET" id="search-form">
                    <input type="hidden" name="type_vehicule" id="type_vehicule" value="voiture">
                    <input type="hidden" name="date_debut" id="real_date_debut">
                    <input type="hidden" name="date_fin" id="real_date_fin">
                    <input type="hidden" name="heure_debut" id="real_heure_debut" value="09:00">
                    <input type="hidden" name="heure_fin" id="real_heure_fin" value="18:00">
                    <input type="hidden" name="driver_age" id="real_driver_age" value="25+">

                    <div class="ab-bar">
                        <div class="highlight-blob" id="blob"></div>

                        <div class="ab-section group" id="loc-section" onclick="moveBlob(this); closeDatePopup(); openLocationPopup()">
                            <label class="ab-label">Lieu</label>
                            <input type="text" id="pickup_location" name="pickup_location" class="ab-input text-black" placeholder="Départ ?" autocomplete="off" required>
                        </div>
                        
                        <div class="ab-divider"></div>

                        <div class="ab-section group" id="date-section" onclick="moveBlob(this); toggleDatePopup()">
                            <label class="ab-label">Dates</label>
                            <input type="text" id="display-dates" class="ab-input cursor-pointer text-black" placeholder="Quand ?" readonly>
                        </div>

                        <div class="ab-divider"></div>

                        <div class="ab-section search-button-section group" id="driver-section" onclick="moveBlob(this)">
                            <button type="submit" class="ab-search-btn expanded">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span>Rechercher</span>
                            </button>
                        </div>
                    </div>
                </form>

                <div id="location-popup" class="location-popup-wrapper" onclick="event.stopPropagation()">
                    <div class="loc-title">Destinations populaires</div>
                    
                    <div class="loc-suggestion" onclick="selectLocation('Mâcon')">
                        <div class="loc-icon-bg"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="loc-text">
                            <span class="loc-city">Mâcon</span>
                        </div>
                    </div>
                    
                    <div class="loc-suggestion" onclick="selectLocation('Châlon')">
                        <div class="loc-icon-bg"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="loc-text">
                            <span class="loc-city">Châlon</span>
                        </div>
                    </div>
                    
                    <div class="loc-suggestion" onclick="selectLocation('Chez Nathan')">
                        <div class="loc-icon-bg"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="loc-text">
                            <span class="loc-city">Chez Nathan</span>
                        </div>
                    </div>
                    
                    <div class="loc-suggestion" onclick="selectLocation('Chez Yanis')">
                        <div class="loc-icon-bg"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="loc-text">
                            <span class="loc-city">Chez Yanis</span>
                        </div>
                    </div>

                    <div class="loc-suggestion" onclick="selectLocation('Paris')">
                        <div class="loc-icon-bg"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="loc-text">
                            <span class="loc-city">Paris</span>
                        </div>
                    </div>
                </div>

                <div id="airbnb-date-popup" class="date-popup-wrapper" onclick="event.stopPropagation()">
                    <div id="view-dates" class="view-content active">
                        <div class="inline-calendar-container">
                            <input type="hidden" id="inline-flatpickr">
                        </div>
                    </div>

                    <div class="time-selector-footer">
                        <div class="time-group">
                            <span class="time-label">Heure départ :</span>
                            <select id="time-start-select" class="time-select" onchange="syncDataToBackend()">
                                <?php foreach($heures as $h): ?>
                                    <option value="<?php echo $h; ?>" <?php echo $h == '09:00' ? 'selected' : ''; ?>><?php echo $h; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="time-group">
                            <span class="time-label">Heure retour :</span>
                            <select id="time-end-select" class="time-select" onchange="syncDataToBackend()">
                                <?php foreach($heures as $h): ?>
                                    <option value="<?php echo $h; ?>" <?php echo $h == '18:00' ? 'selected' : ''; ?>><?php echo $h; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="hero-pagination" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 p-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 shadow-lg cursor-pointer hidden md:flex">
            <div class="hero-indicator active w-8 h-1.5 bg-white rounded-full transition-all duration-500" onclick="goToSlide(0)"></div>
            <div class="hero-indicator w-1.5 h-1.5 bg-white/40 rounded-full transition-all duration-500" onclick="goToSlide(1)"></div>
            <div class="hero-indicator w-1.5 h-1.5 bg-white/40 rounded-full transition-all duration-500" onclick="goToSlide(2)"></div>
            <div class="hero-indicator w-1.5 h-1.5 bg-white/40 rounded-full transition-all duration-500" onclick="goToSlide(3)"></div>
        </div>
    </section>

    <div id="modal-lld" class="modal-overlay z-[10000]">
        <div class="modal-content text-center py-10 px-8 max-w-[90vw] md:max-w-[600px] liquid-card">
            <span onclick="closeModal('modal-lld')" class="close-modal text-white text-3xl absolute top-4 right-6 cursor-pointer">&times;</span>
            <div class="w-20 h-20 bg-white rounded-full mx-auto mb-6 overflow-hidden flex items-center justify-center">
                <img src="<?php echo function_exists('asset') ? asset('images/9b3a652548_uid_65d8652a63005.webp') : 'images/quali.jpg'; ?>" class="w-full h-full object-cover">
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-white mb-4 tracking-wide uppercase">Abonnement Auto</h2>
            <p class="text-gray-200 mb-8 font-medium leading-relaxed text-sm md:text-base">
                Roulez sans contrainte avec nos offres de location moyenne et longue durée. Profitez d'un véhicule récent, entretien et assurance inclus, pour un loyer mensuel fixe. Idéal pour les professionnels et les particuliers.
            </p>
            <button onclick="window.location.href='#'" class="mt-4 w-full py-4 liquid-btn text-base uppercase tracking-widest">En savoir plus</button>
        </div>
    </div>

    <div id="modal-gift" class="modal-overlay z-[10000]">
        <div class="modal-content text-center py-10 px-8 max-w-[90vw] md:max-w-[600px] liquid-card">
            <span onclick="closeModal('modal-gift')" class="close-modal text-white text-3xl absolute top-4 right-6 cursor-pointer">&times;</span>
            <div class="w-20 h-20 bg-white rounded-full mx-auto mb-6 overflow-hidden flex items-center justify-center">
                <img src="<?php echo function_exists('asset') ? asset('images/bd18ff8cdd_uid_65d87a5ea3127.jpg') : 'images/peugeot3.webp'; ?>" class="w-full h-full object-cover">
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-white mb-4 tracking-wide uppercase">Carte Cadeau ADA</h2>
            <p class="text-gray-200 mb-8 font-medium leading-relaxed text-sm md:text-base">
                Offrez la liberté de mouvement ! Nos cartes cadeaux sont valables sur toute notre flotte de véhicules de tourisme et utilitaires. Le cadeau parfait pour un week-end évasion ou un déménagement serein.
            </p>
            <button onclick="window.location.href='#'" class="mt-4 w-full py-4 liquid-btn text-base uppercase tracking-widest">Acheter une carte</button>
        </div>
    </div>

    <div id="modal-options" class="modal-overlay z-[10000]">
        <div class="modal-content text-center py-10 px-8 max-w-[90vw] md:max-w-[600px] liquid-card">
            <span onclick="closeModal('modal-options')" class="close-modal text-white text-3xl absolute top-4 right-6 cursor-pointer">&times;</span>
            <div class="w-20 h-20 bg-white rounded-full mx-auto mb-6 overflow-hidden flex items-center justify-center">
                <img src="<?php echo function_exists('asset') ? asset('images/ead2e02571_uid_65d87a60c0c29.jpeg') : 'images/clubada.jpg'; ?>" class="w-full h-full object-cover">
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-white mb-4 tracking-wide uppercase">Options & Services</h2>
            <p class="text-gray-200 mb-8 font-medium leading-relaxed text-sm md:text-base">
                Personnalisez votre location avec nos options : conducteur additionnel, GPS, sièges enfants, rachat de franchise ou livraison du véhicule à domicile. Voyagez l'esprit tranquille.
            </p>
            <button onclick="window.location.href='#'" class="mt-4 w-full py-4 liquid-btn text-base uppercase tracking-widest">Voir les options</button>
        </div>
    </div>

    <div id="modal-success" class="modal-overlay z-[10000]">
        <div class="modal-content text-center py-10 px-8 max-w-[90vw] md:max-w-[650px] liquid-card">
            <span onclick="closeModal('modal-success')" class="close-modal text-white text-3xl absolute top-4 right-6 cursor-pointer">&times;</span>
            <h2 class="text-2xl md:text-4xl font-black text-white mb-4 tracking-wide uppercase">Confirmation</h2>
            <p class="text-white font-bold text-lg md:text-2xl mb-6">Traitement réussi</p>
            <p class="text-gray-200 mb-12 font-medium leading-relaxed text-sm md:text-lg" id="success-message"></p>
            <button onclick="closeModal('modal-success')" class="mt-4 w-full py-4 liquid-btn text-base uppercase tracking-widest">Fermer</button>
        </div>
    </div>
    
    <div id="modal-loader-mail" class="modal-overlay z-[10000]">
        <div class="modal-content flex flex-col items-center justify-center py-16 w-auto min-w-[300px] liquid-card">
             <i class="fa-solid fa-circle-notch fa-spin mb-8 text-white text-5xl"></i>
             <p class="text-white font-bold animate-pulse text-lg tracking-wider">Connexion sécurisée...</p>
        </div>
    </div>
    
    <div id="modal-faq" class="modal-overlay z-[10000]">
        <div class="modal-content text-left py-8 px-8 max-w-[90vw] md:max-w-[600px] bg-white text-black border-none relative" style="background:white; color:black;">
            <span onclick="closeModal('modal-faq')" class="absolute top-4 right-4 text-2xl cursor-pointer p-2">&times;</span>
            <h3 class="text-xl md:text-2xl font-bold mb-4 pr-8" id="faq-title">FAQ</h3>
            <p class="text-gray-700 leading-relaxed text-sm md:text-base" id="faq-body">Contenu de la réponse...</p>
            <button onclick="closeModal('modal-faq')" class="mt-8 w-full py-3 bg-black text-white rounded-full font-bold uppercase text-xs">J'ai compris</button>
        </div>
    </div>

    <div id="credits-overlay" class="credits-overlay" onclick="event.stopPropagation()">
        <div class="credits-modal">
            <a onclick="closeCredits()" class="credits-close-top">Continuer vers le site</a>
            <h2 class="credits-title">Bienvenue sur notre plateforme !</h2>
            <p class="credits-text">
Vous explorez ici une version de démonstration d’un projet développé dans le cadre d’un projet étudiant. Nous espérons que vous apprécierez votre visite et que vous trouverez l’expérience claire et agréable. Merci pour votre intérêt !</p>
            <div class="credits-profiles">
                <a href="https://www.linkedin.com/in/yanisbenkrouidem" class="profile-link">YANIS BENKROUIDEM (Architecture & Développement)</a>
                <a href="https://www.linkedin.com/in/nathanheu" class="profile-link">NATHAN HEU (Documentation)</a>
            </div>
            <div class="credits-actions">
                <button onclick="closeCredits()" class="credits-btn-black">ACCÉDER AU PROJET</button>
            </div>
        </div>
    </div>
</div>

<script>
// --- LOGIQUE ANIMATION BLOB ---
const blob = document.getElementById('blob');
function moveBlob(element) {
    // Le blob ne s'active que sur Desktop (> 768px)
    if (window.innerWidth > 768) {
        blob.style.opacity = '1';
        const leftPosition = element.offsetLeft;
        const width = element.offsetWidth;
        blob.style.transform = `translateX(${leftPosition}px)`;
        blob.style.width = `${width}px`;
        document.querySelectorAll('.ab-section').forEach(el => el.classList.remove('active-section'));
        element.classList.add('active-section');
    }
}

// --- VARIABLES GLOBALES ---
const datePopup = document.getElementById('airbnb-date-popup');
const locationPopup = document.getElementById('location-popup');
const displayDates = document.getElementById('display-dates');
const realDateDebut = document.getElementById('real_date_debut');
const realDateFin = document.getElementById('real_date_fin');

// --- SYNCHRONISATION DONNÉES ---
function syncDataToBackend() {
    const timeStart = document.getElementById('time-start-select').value;
    const timeEnd = document.getElementById('time-end-select').value;
    if (!calendar || !calendar.selectedDates || calendar.selectedDates.length === 0) return;
    const dateStartObj = calendar.selectedDates[0];
    const dateEndObj = calendar.selectedDates[1];

    const dateStartStr = flatpickr.formatDate(dateStartObj, "Y-m-d");
    document.getElementById('real_date_debut').value = `${dateStartStr} ${timeStart}`;
    document.getElementById('real_heure_debut').value = timeStart;
    document.getElementById('real_heure_fin').value = timeEnd;

    if (dateEndObj) {
        const dateEndStr = flatpickr.formatDate(dateEndObj, "Y-m-d");
        document.getElementById('real_date_fin').value = `${dateEndStr} ${timeEnd}`;
        const displayStart = flatpickr.formatDate(dateStartObj, "d M");
        const displayEnd = flatpickr.formatDate(dateEndObj, "d M");
        displayDates.value = `${displayStart} (${timeStart}) - ${displayEnd} (${timeEnd})`;
    } else {
        document.getElementById('real_date_fin').value = "";
        const displayStart = flatpickr.formatDate(dateStartObj, "d M");
        displayDates.value = `${displayStart} (${timeStart}) - ...`;
    }
}

// --- INITIALISATION FLATPICKR RESPONSIVE ---
// Détection du mobile pour ajuster le nombre de mois affichés
const isMobile = window.innerWidth <= 768;

const calendar = flatpickr("#inline-flatpickr", {
    mode: 'range',
    inline: true,
    showMonths: isMobile ? 1 : 2, // 1 mois sur mobile, 2 sur desktop
    dateFormat: "Y-m-d",
    minDate: "today",
    locale: "fr",
    onChange: function(selectedDates) { syncDataToBackend(); }
});

// --- GESTION DES POPUPS ---
function toggleDatePopup() {
    closeLocationPopup();
    if (datePopup.style.display === 'block') {
        datePopup.style.display = 'none';
        document.getElementById('date-section').classList.remove('active-section');
    } else {
        datePopup.style.display = 'block';
    }
}
function closeDatePopup() { datePopup.style.display = 'none'; }

function openLocationPopup() {
    closeDatePopup();
    locationPopup.style.display = 'block';
}
function closeLocationPopup() { locationPopup.style.display = 'none'; }

function selectLocation(name) {
    document.getElementById('pickup_location').value = name;
    closeLocationPopup();
}

function closePopupsOnClickOutside(event) {
    // Vérification basique pour ne pas fermer si on clique DANS la popup
    const isClickInsideDate = datePopup.contains(event.target);
    const isClickInsideLoc = locationPopup.contains(event.target);
    const isClickInsideSearch = document.querySelector('.ab-search-wrapper').contains(event.target);

    if (!isClickInsideDate && !isClickInsideLoc && !isClickInsideSearch) {
        closeDatePopup();
        closeLocationPopup();
    }
}

// --- FONCTIONS GENERALES ---
function openServiceModal(id) {
    openModal(id);
}

function showFAQ(topic) {
    const titles = {
        'Retour': "Procédure de retour",
        'Paiement': "Moyens de paiement",
        'Livraison': "Livraison",
        'VIA': "ADA VIA France",
        'Facture': "Facturation",
        'Entretien': "Entretien véhicule"
    };
    const bodies = {
        'Retour': "Vous disposez de 1 heure de battement pour retourner le véhicule en agence. Au-delà, une journée supplémentaire sera facturée.",
        'Paiement': "Nous acceptons les cartes CB, Visa, Mastercard et American Express. Les chèques ne sont pas acceptés.",
        'Livraison': "Le service voiturier est disponible dans Paris Intra-muros pour 35€ TTC.",
        'VIA': "ADA VIA est notre service de télépéage inclus dans tous nos forfaits Premium.",
        'Facture': "Votre facture est envoyée automatiquement par email 24h après la clôture du contrat.",
        'Entretien': "Le véhicule est livré propre et avec le plein. Merci de le restituer dans le même état."
    };
    
    document.getElementById('faq-title').innerText = titles[topic];
    document.getElementById('faq-body').innerText = bodies[topic];
    openModal('modal-faq');
}

// --- INITIALISATION ---
document.addEventListener('DOMContentLoaded', function() {
    syncDataToBackend();
      
    const locInput = document.getElementById('pickup_location');
    if(locInput) {
        locInput.addEventListener('click', function() {
            moveBlob(document.getElementById('loc-section'));
            openLocationPopup();
        });
    }

    // Hero Slider Initialisation
    heroInterval = setInterval(() => goToSlide(1), 5500); // Demarrage

    // Credits
    const hasSeenCredits = localStorage.getItem('hasSeenCreditsProject_V1');
    if (!hasSeenCredits) {
        const overlay = document.getElementById('credits-overlay');
        overlay.style.display = 'flex';
        setTimeout(() => { overlay.classList.add('visible'); }, 100);
    }
});

function closeCredits() {
    const overlay = document.getElementById('credits-overlay');
    overlay.classList.remove('visible');
    setTimeout(() => { overlay.style.display = 'none'; }, 500);
    localStorage.setItem('hasSeenCreditsProject_V1', 'true');
}

// --- TABS & SLIDER (VITESSE HOMOGENEISEE) ---
function switchTab(type) {
    document.querySelectorAll('.ab-tab-link').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + type).classList.add('active');
    document.getElementById('type_vehicule').value = type;
}

let heroInterval;
let currentHeroIndex = 0;
const heroImgs = [
    'VID_PLACEHOLDER', 
    '<?php echo function_exists('asset') ? asset("images/317230b7fb.jpg") : 'images/94222d5ddc.webp'; ?>',
    '<?php echo function_exists('asset') ? asset("images/552d5de20e.webp") : 'images/552d5de20e.webp'; ?>',
    '<?php echo function_exists('asset') ? asset("images/a0bf2358bc.webp") : 'images/a0bf2358bc.webp'; ?>'
];

function goToSlide(index) {
    if (index === currentHeroIndex && heroInterval) return;
    if (heroInterval) clearInterval(heroInterval);
    
    const videoLayer = document.getElementById('slide-video-layer');
    const imageLayer = document.getElementById('slide-image-layer');
    updateHeroIndicators(index);
    
    if (index === 0) {
        // VIDEO SLIDE
        imageLayer.classList.remove('slide-visible'); imageLayer.classList.add('slide-hidden');
        videoLayer.classList.remove('slide-hidden'); videoLayer.classList.add('slide-visible');
        currentHeroIndex = 0;
        
        // ACCELERE (5.5s)
        heroInterval = setInterval(() => goToSlide((currentHeroIndex + 1) % heroImgs.length), 5500);
    } else {
        // IMAGE SLIDE
        imageLayer.style.backgroundImage = `url('${heroImgs[index]}')`;
        videoLayer.classList.remove('slide-visible'); videoLayer.classList.add('slide-hidden');
        imageLayer.classList.remove('slide-hidden'); imageLayer.classList.add('slide-visible');
        currentHeroIndex = index;
        
        // RALENTI (9s)
        heroInterval = setInterval(() => goToSlide((currentHeroIndex + 1) % heroImgs.length), 9000);
    }
}
function updateHeroIndicators(activeIndex) {
    const indicators = document.querySelectorAll('.hero-indicator');
    indicators.forEach((ind, index) => {
        if (index === activeIndex) {
            ind.classList.add('w-8', 'bg-white');
            ind.classList.remove('w-1.5', 'bg-white/40');
        } else {
            ind.classList.remove('w-8', 'bg-white');
            ind.classList.add('w-1.5', 'bg-white/40');
        }
    });
}

function closeModal(id) { document.getElementById(id).classList.remove('active'); }
function openModal(id) { document.getElementById(id).classList.add('active'); }

// FONCTION CLUB / NEWSLETTER RÉELLE (SMTP)
async function handleClub(e) {
    e.preventDefault(); 
    
    // 1. Récupération des données du formulaire
    const form = document.getElementById('lv-club-form');
    const formData = new FormData(form);
    
    // 2. Affichage du loader (Visuel style Netflix)
    openModal('modal-loader-mail');

    try {
        // 3. Appel au serveur Laravel via la route définie dans web.php
        const response = await fetch('/club', { // correspond à route('club.subscribe')
            method: 'POST',
            headers: {
                // IMPORTANT : Récupère le token CSRF de Laravel
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await response.json();

        // 4. Fin du chargement
        document.getElementById('modal-loader-mail').classList.remove('active');

        if (response.ok && data.success) {
            // SUCCÈS : Le mail est parti via Gmail
            document.getElementById('success-message').innerText = "Bienvenue au Club ADA. Votre carte de membre virtuelle a été envoyée sur votre boîte mail.";
            openModal('modal-success');
            form.reset(); // Vide le champ email
        } else {
            // ERREUR
            console.error(data);
            alert("Erreur lors de l'envoi : " + (data.message || "Vérifiez votre email."));
        }

    } catch (error) {
        document.getElementById('modal-loader-mail').classList.remove('active');
        console.error('Erreur technique:', error);
        alert("Impossible de contacter le serveur SMTP. Vérifiez votre connexion.");
    }
}
</script>

</body>
</html>
