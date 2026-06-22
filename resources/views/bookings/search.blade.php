<?php 
$title = 'Rechercher un véhicule - Collection Complète'; 
require resource_path('views/layouts/header.blade.php'); 

// --- DONNÉES SIMULÉES (6 véhicules pour remplir la ligne) ---
$base_vehicules = [
    ['id' => 10, 'marque' => 'Renault', 'modele' => 'Twingo', 'prix' => 37, 'image' => asset('images/1A-sml.png'), 'tag' => 'Nouveau'],
    ['id' => 12, 'marque' => 'Fiat', 'modele' => '500', 'prix' => 47, 'image' => asset('images/7A-sml.png'), 'tag' => 'Nouveau'],
    ['id' => 14, 'marque' => 'Renault', 'modele' => 'Clio 5', 'prix' => 51, 'image' => asset('images/3A-sml.png'), 'tag' => 'Disponible'],
    ['id' => 21, 'marque' => 'Mercedes', 'modele' => 'Classe A', 'prix' => 63, 'image' => asset('images/4B-sml.png'), 'tag' => 'Premium'],
];
// On s'assure d'avoir assez d'items pour la grille de 6
$inspirations_femme = array_merge($base_vehicules, array_slice($base_vehicules, 0, 2)); 
$inspirations_homme = array_merge(array_reverse($base_vehicules), array_slice($base_vehicules, 0, 2));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif'],
                        futura: ['FuturaLT', 'sans-serif'] 
                    },
                    colors: { 
                        'lv-grey': '#f6f5f3', 
                    },
                    fontSize: { 'xxs': '0.65rem' }
                }
            }
        }
    </script>
    <style>
        @font-face { font-family: 'FuturaLT'; src: url('public/fonts/FuturaLT.ttf') format('truetype'); font-weight: normal; font-style: normal; }

        body { background-color: white; color: #191919; overflow-x: hidden; }

        /* --- CORRECTIF NAVBAR ANIMÉE MAIS NOIRE --- */
        /* On utilise sticky pour qu'elle bouge avec le scroll, mais on force le NOIR */
        header, nav, .navbar, #header {
            background-color: #000000 !important; /* Fond Noir */
            color: #ffffff !important;             /* Texte Blanc */
            position: sticky !important;           /* Reste accroché en haut (animation scroll) */
            top: 0 !important;
            width: 100% !important;
            z-index: 100 !important;
            transition: all 0.3s ease-in-out;      /* Douceur de l'animation */
        }
        
        /* Force les liens du header en blanc */
        header a, nav a, .navbar a, header span, nav span, header i, nav i {
            color: #ffffff !important;
            fill: #ffffff !important;
        }

        /* --- STYLES GENERAUX --- */
        .lv-input { border: none; background: transparent; width: 100%; outline: none; font-size: 0.75rem; color: #191919; font-weight: 500; }
        .lv-input::placeholder { color: #191919; opacity: 0.5; font-weight: 400; }
        .lv-input:focus { ring: 0; outline: none; }
        
        /* Flatpickr */
        .flatpickr-calendar {
            background: #fff !important; border: 1px solid #e5e5e5 !important; border-radius: 0 !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important; width: 300px !important; padding: 10px !important;
        }
        .flatpickr-day.selected { background: #191919 !important; color: #fff !important; border-color: #191919 !important; }
        .flatpickr-calendar.arrowTop:before, .flatpickr-calendar.arrowTop:after { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased text-sm">

    <div class="flex flex-col items-center mt-12 mb-16 px-4">
        
        <form action="<?php echo route('location.search.results'); ?>" method="POST" class="w-full max-w-[850px]">
            <?php echo csrf_field(); ?>
            
            <div class="w-full h-11 rounded-full border border-gray-300 flex items-center bg-white relative z-20 hover:shadow-md transition-shadow duration-300">
                <div class="pl-5 pr-3"><i class="fa-solid fa-magnifying-glass text-gray-900 text-xs"></i></div>
                
                <div class="flex-grow h-full flex items-center relative border-r border-gray-200">
                    <input type="text" id="agence_display" placeholder="Agence de départ" readonly class="lv-input cursor-pointer px-4" onclick="openAgencyPopup()">
                    <input type="hidden" name="agence_id" id="agence_id">
                </div>
                
                <div class="w-[22%] h-full flex items-center border-r border-gray-200 pl-2">
                    <input type="text" name="date_debut" id="date_debut" placeholder="Départ" class="lv-input cursor-pointer text-center" required>
                </div>
                
                <div class="w-[22%] h-full flex items-center pl-2">
                    <input type="text" name="date_fin" id="date_fin" placeholder="Retour" class="lv-input cursor-pointer text-center" required>
                </div>
                
                <button type="submit" class="pr-1.5 mr-0.5">
                    <div class="w-8 h-8 rounded-full bg-transparent flex items-center justify-center hover:bg-gray-100 transition-colors">
                        <i class="fa-solid fa-arrow-right text-xs text-gray-900"></i>
                    </div>
                </button>
            </div>
            
            <div class="flex justify-center mt-6 gap-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 font-medium">
                <span class="text-black font-bold">Populaires</span>
                <span class="hover:text-black cursor-pointer transition-colors">Citadine</span>
                <span class="hover:text-black cursor-pointer transition-colors">Berline</span>
                <span class="hover:text-black cursor-pointer transition-colors">SUV</span>
                <span class="hover:text-black cursor-pointer transition-colors">Utilitaire</span>
            </div>
        </form>
    </div>

    <main class="w-full px-0 pb-20">
        
        <div class="mb-12">
            <div class="mb-5 px-6">
                <h2 class="font-futura text-xl text-black tracking-wide">Inspirations pour femme</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 border-t border-gray-200">
                <?php foreach($inspirations_femme as $vehicule): ?>
                <div class="group cursor-pointer relative border-r border-b border-gray-200 bg-white" onclick='showCarDetails(<?php echo json_encode($vehicule); ?>)'>
                    
                    <div class="bg-lv-grey w-full aspect-[4/5] relative flex items-center justify-center overflow-hidden">
                        <div class="absolute top-3 right-3 z-10">
                            <i class="fa-regular fa-heart text-sm text-black opacity-40 hover:opacity-100 transition-opacity"></i>
                        </div>
                        <img src="<?php echo asset($vehicule['image']); ?>" 
                             class="w-[65%] h-auto object-contain mix-blend-multiply"
                             alt="<?php echo $vehicule['modele']; ?>">
                    </div>

                    <div class="pt-4 px-4 pb-8 bg-white h-[110px] flex flex-col justify-start">
                        <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest mb-1"><?php echo $vehicule['tag']; ?></p>
                        <h3 class="text-sm font-medium text-black mb-1"><?php echo $vehicule['marque'] . ' ' . $vehicule['modele']; ?></h3>
                        <p class="text-sm text-black"><?php echo number_format($vehicule['prix'], 2, ',', ' '); ?>€</p>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mb-12">
            <div class="mb-5 px-6">
                <h2 class="font-futura text-xl text-black tracking-wide">Inspirations pour homme</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 border-t border-gray-200">
                <?php foreach($inspirations_homme as $vehicule): ?>
                <div class="group cursor-pointer relative border-r border-b border-gray-200 bg-white" onclick='showCarDetails(<?php echo json_encode($vehicule); ?>)'>
                    
                    <div class="bg-lv-grey w-full aspect-[4/5] relative flex items-center justify-center overflow-hidden">
                        <div class="absolute top-3 right-3 z-10">
                            <i class="fa-regular fa-heart text-sm text-black opacity-40 hover:opacity-100 transition-opacity"></i>
                        </div>
                        <img src="<?php echo asset($vehicule['image']); ?>" 
                             class="w-[65%] h-auto object-contain mix-blend-multiply"
                             alt="<?php echo $vehicule['modele']; ?>">
                    </div>

                    <div class="pt-4 px-4 pb-8 bg-white h-[110px] flex flex-col justify-start">
                        <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest mb-1"><?php echo $vehicule['tag']; ?></p>
                        <h3 class="text-sm font-medium text-black mb-1"><?php echo $vehicule['marque'] . ' ' . $vehicule['modele']; ?></h3>
                        <p class="text-sm text-black"><?php echo number_format($vehicule['prix'], 2, ',', ' '); ?>€</p>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

    <div class="border-t border-gray-200 py-10 text-center bg-white">
        <a href="#" class="text-[10px] uppercase tracking-[0.15em] text-black underline underline-offset-4 decoration-1">Service client disponible 7j/7</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const config = { enableTime: true, dateFormat: "d/m/Y H:i", time_24hr: true, minDate: "today", locale: "fr", disableMobile: "true", nextArrow: '<i class="fa-solid fa-chevron-right text-xs"></i>', prevArrow: '<i class="fa-solid fa-chevron-left text-xs"></i>' };
            const fpDebut = flatpickr("#date_debut", config);
            const fpFin = flatpickr("#date_fin", { ...config });
            fpDebut.set('onChange', function(selectedDates, dateStr) { fpFin.set('minDate', dateStr); });
        });

        function openAgencyPopup() {
            const agences = { "1": "Paris - Champs Elysées", "2": "Lyon - Bellecour", "3": "Nice - Promenade" };
            Swal.fire({
                title: 'AGENCE', input: 'select', inputOptions: agences, inputPlaceholder: 'Sélectionner...',
                showCancelButton: true, confirmButtonColor: '#000', cancelButtonColor: '#fff', confirmButtonText: 'VALIDER', cancelButtonText: 'ANNULER',
                customClass: { popup: 'rounded-none', title: 'text-sm font-futura tracking-widest', confirmButton: 'rounded-none px-6 py-3 text-xs font-bold', cancelButton: 'rounded-none px-6 py-3 text-xs font-bold text-black border border-gray-200', input: 'rounded-none border-gray-300 focus:ring-0 text-xs' }
            }).then((r) => { if(r.value) { document.getElementById('agence_id').value = r.value; document.getElementById('agence_display').value = agences[r.value]; } });
        }

        function redirectToReservation(vehiculeId) {
            const agence = document.getElementById('agence_id').value;
            const debut = document.getElementById('date_debut').value;
            const fin = document.getElementById('date_fin').value;
            window.location.href = `<?php echo url('reservation'); ?>/${vehiculeId}?date_debut=${debut}&date_fin=${fin}&agence_id=${agence}`;
        }

        function showCarDetails(v) {
            Swal.fire({
                html: `<div class="text-left"><div class="bg-[#f6f5f3] p-8 mb-6 flex justify-center"><img src="${v.image}" style="max-height:150px;"></div><h2 class="text-lg font-bold uppercase mb-1 font-futura tracking-widest">${v.marque} ${v.modele}</h2><p class="text-lg font-normal text-gray-900 mb-6">${v.prix}€ <span class="text-xs text-gray-500">/ jour</span></p></div>`,
                showCancelButton: true, confirmButtonText: 'AJOUTER AU PANIER', cancelButtonText: 'FERMER', confirmButtonColor: '#000', width: 400, padding: '0',
                customClass: { popup: 'rounded-none', htmlContainer: 'm-0 p-6', confirmButton: 'rounded-none w-full py-4 text-xs font-bold tracking-[0.2em] uppercase m-0', cancelButton: 'hidden' },
                preConfirm: () => redirectToReservation(v.id)
            });
        }
    </script>
</body>
</html>
