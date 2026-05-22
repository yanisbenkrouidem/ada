<?php 
$title = 'Collection - ADA'; 
if (function_exists('resource_path')) {
    require resource_path('views/partials/header.php'); 
}

// --- LOGIQUE BACKEND (FILTRES) ---
$searchStart = request('date_debut');
$searchEnd = request('date_fin');
$searchCity = request('search_ville');

// 1. Récupération de base
if (!isset($vehicules)) {
    $vehicules = \App\Models\Vehicule::with('category')->get();
}

$currentAgenceName = 'Toute la France';

// 2. Filtrage par Ville
if ($searchCity) {
    $agence = \App\Models\Agence::where('ville', 'LIKE', '%'.$searchCity.'%')
                ->orWhere('nom', 'LIKE', '%'.$searchCity.'%')
                ->first();

    if ($agence) {
        $vehicules = $vehicules->where('agence_id', $agence->id);
        $currentAgenceName = $agence->ville;
    } else {
        $vehicules = collect([]); 
        $currentAgenceName = 'Inconnue (' . htmlspecialchars($searchCity) . ')';
    }
}

// 3. Récupération des favoris
$favorisIds = [];
if (auth('client')->check()) {
    $favorisIds = \Illuminate\Support\Facades\DB::table('favoris')
        ->where('client_id', auth('client')->id())
        ->pluck('vehicule_id')
        ->toArray();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #ffffff; color: #19110b; overflow-x: hidden; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .product-bg { background-color: #f6f5f3; }
        
        /* Loader */
        .loader-overlay {
            position: fixed; inset: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(5px);
            z-index: 9999; display: none; justify-content: center; align-items: center;
        }
        .loader-overlay.active { display: flex; }
        .spinner {
            width: 40px; height: 40px; border: 3px solid #f3f3f3; border-top: 3px solid #000;
            border-radius: 50%; animation: spin 0.8s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* Styles Recherche LV - GLASSMORPHISM & REDUITE */
        .lv-search-container { width: 100%; max-width: 550px; }
        .lv-input {
            width: 100%; 
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px); 
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 9999px;
            padding: 14px 24px;
            font-size: 14px; 
            font-weight: 500; 
            color: #ffffff;
            outline: none;
            transition: all 0.3s ease; 
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        .lv-input::placeholder { color: rgba(255, 255, 255, 0.8); font-weight: 300; }
        .lv-input:focus {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
        }

        .lv-label {
            font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em;
            color: rgba(255, 255, 255, 0.9); font-weight: 600; margin-right: 15px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }
        .lv-tag {
            font-size: 13px; color: #fff; cursor: pointer; font-weight: 400; margin-right: 20px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5); transition: opacity 0.2s;
        }
        .lv-tag:hover { opacity: 0.8; text-decoration: underline; text-underline-offset: 4px; }

        /* Toast Styles */
        .toast-hidden { transform: translate(-50%, 100%); opacity: 0; visibility: hidden; }
        .toast-visible { transform: translate(-50%, 0); opacity: 1; visibility: visible; }

        /* MODAL STYLES */
        #vehicle-modal { transition: opacity 0.3s ease, visibility 0.3s ease; }
        #vehicle-modal.hidden-modal { opacity: 0; visibility: hidden; pointer-events: none; }
        #vehicle-modal.visible-modal { opacity: 1; visibility: visible; pointer-events: auto; }
        .modal-content { transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        #vehicle-modal.visible-modal .modal-content { transform: scale(1); }
    </style>
</head>
<body class="antialiased">

    <div id="page-loader" class="loader-overlay">
        <div class="flex flex-col items-center">
            <div class="spinner mb-4"></div>
            <p class="text-xs uppercase tracking-widest font-bold">Chargement...</p>
        </div>
    </div>

    <div class="relative w-full h-[60vh] md:h-[85vh] overflow-hidden">
        <img src="<?php echo function_exists('asset') ? asset('images/d832d89491.webp') : 'images/d832d89491.webp'; ?>" class="absolute inset-0 w-full h-full object-cover object-center" alt="Campagne">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/40"></div>
        
        <div class="absolute top-[120px] left-1/2 transform -translate-x-1/2 w-full px-6 z-30 flex flex-col items-center animate-[fadeIn_0.8s_ease-out]">
            <div class="lv-search-container">
                <form action="" method="GET" class="w-full relative" onsubmit="showLoader()">
                    <?php if($searchStart): ?><input type="hidden" name="date_debut" value="<?php echo $searchStart; ?>"><?php endif; ?>
                    <?php if($searchEnd): ?><input type="hidden" name="date_fin" value="<?php echo $searchEnd; ?>"><?php endif; ?>

                    <input type="text" 
                           name="search_ville" 
                           id="searchInput"
                           class="lv-input" 
                           placeholder="Rechercher une agence" 
                           value="<?php echo htmlspecialchars($searchCity); ?>" 
                           autocomplete="off">
                </form>

                <div class="flex flex-wrap justify-center items-center mt-4">
                    <span class="lv-label">RECHERCHES POPULAIRES</span>
                    <span onclick="triggerSearch('Mâcon')" class="lv-tag">Mâcon</span>
                    <span onclick="triggerSearch('Chalon')" class="lv-tag">Chalon</span>
                    <span onclick="triggerSearch('Lyon')" class="lv-tag">Lyon</span>
                    <span onclick="triggerSearch('Dijon')" class="lv-tag">Dijon</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-12 left-6 md:bottom-20 md:left-14 max-w-xl text-white z-10">
            <h2 class="text-3xl md:text-4xl font-normal mb-4 tracking-wide">Hiver 2025-2026</h2>
            <p class="text-sm md:text-[15px] font-light leading-7 md:leading-8 opacity-90 mb-8 max-w-lg">
                Une nouvelle interprétation de l'esprit du voyage. <br>
                Flotte actuelle : <strong><?php echo $currentAgenceName; ?></strong>.
            </p>
            
            <button onclick="document.getElementById('grid-anchor').scrollIntoView({behavior: 'smooth'})" 
                    class="bg-white/10 backdrop-blur-md border border-white/30 text-white px-8 py-3.5 rounded-full text-[11px] font-bold uppercase tracking-widest hover:bg-white/20 transition duration-300 shadow-[0_8px_32px_0_rgba(31,38,135,0.15)]">
                Voir les véhicules
            </button>
        </div>
    </div>

    <div id="grid-anchor"></div>

    <div class="sticky top-[80px] z-20 bg-white/95 backdrop-blur-sm border-b border-gray-100 py-3 px-6 flex justify-end shadow-sm">
        <div class="text-[10px] text-gray-500 uppercase tracking-widest font-bold flex items-center gap-2">
            <?php if($searchCity): ?>
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Agence : <?php echo $currentAgenceName; ?> — 
            <?php endif; ?>
            <?php echo isset($vehicules) ? $vehicules->count() : '0'; ?> Résultats
        </div>
    </div>

    <div class="w-full bg-white min-h-[50vh] py-8">
        <?php if(isset($vehicules) && $vehicules->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 w-full gap-6 px-6">
                <?php 
                $counter = 0;
                foreach($vehicules as $vehicule): 
                    $counter++;
                    
                    // --- LOGIQUE IMAGE ---
                    $photoName = !empty($vehicule->image) ? $vehicule->image : $vehicule->category->photo;
                    $img = $photoName ? 'images/'.$photoName : 'images/voiture.png';
                    
                    if(function_exists('public_path') && !file_exists(public_path($img))) $img = 'images/voiture.png';
                    $fullImgPath = function_exists('asset') ? asset($img) : $img;
                    
                    $isFavori = in_array($vehicule->id, $favorisIds);
                    $heartClass = $isFavori ? 'fa-solid text-black' : 'fa-regular';

                    // --- URL DE RESERVATION ---
                    $reserveUrl = function_exists('route') ? route('reservation.create', ['id' => $vehicule->id]) : '#';
                ?>

                <div class="group flex flex-col fleet-item cursor-pointer relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-50"
                     onclick="openModal(
                         '<?php echo addslashes($vehicule->marque); ?>',
                         '<?php echo addslashes($vehicule->modele); ?>',
                         '<?php echo addslashes($vehicule->category->libelle); ?>',
                         '<?php echo number_format($vehicule->category->tarifjournee, 0, ',', ' '); ?>',
                         '<?php echo $fullImgPath; ?>',
                         '<?php echo addslashes($vehicule->category->description ?? 'Ce véhicule allie confort de conduite et économie. Idéal pour vos trajets urbains.'); ?>',
                         '<?php echo addslashes($vehicule->agence->ville ?? 'France'); ?>',
                         '<?php echo $reserveUrl; ?>'
                     )">
                    
                    <div class="product-bg w-full aspect-[4/3] relative overflow-hidden">
                        
                        <button onclick="event.stopPropagation(); addToWishlist(this, <?php echo $vehicule->id; ?>, '<?php echo addslashes($vehicule->marque . ' ' . $vehicule->modele); ?>', '<?php echo $fullImgPath; ?>')" 
                                class="absolute top-4 right-4 z-20 text-black/40 hover:text-black hover:scale-110 transition duration-300">
                            <i class="<?php echo $heartClass; ?> fa-heart text-lg"></i>
                        </button>

                        <img src="<?php echo $fullImgPath; ?>" 
                             class="absolute inset-0 w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500" 
                             alt="<?php echo $vehicule->marque; ?>">
                        
                        <div class="absolute bottom-4 left-4 right-4 translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-10">
                            <form action="<?php echo function_exists('route') ? route('panier.add') : '#'; ?>" method="POST" onsubmit="event.stopPropagation(); showLoader()">
                                <?php if(function_exists('csrf_field')) echo csrf_field(); ?>
                                <input type="hidden" name="vehicule_id" value="<?php echo $vehicule->id; ?>">
                                <?php if($searchStart && $searchEnd): ?>
                                    <input type="hidden" name="date_debut" value="<?php echo $searchStart; ?>">
                                    <input type="hidden" name="date_fin" value="<?php echo $searchEnd; ?>">
                                <?php endif; ?>
                                <button type="submit" onclick="event.stopPropagation();" class="w-full bg-white/90 backdrop-blur text-black text-[11px] uppercase font-bold py-3.5 shadow-xl hover:bg-black hover:text-white transition-colors border border-white/50 rounded-lg">
                                    Ajouter au panier
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-start">
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider mb-1">
                            <?php echo $vehicule->category->libelle; ?>
                        </p>
                        <h3 class="text-sm font-normal text-gray-900 leading-snug truncate"><?php echo $vehicule->marque; ?> <?php echo $vehicule->modele; ?></h3>
                        <p class="text-sm font-normal text-gray-900 mt-1"><?php echo number_format($vehicule->category->tarifjournee, 2, ',', ' '); ?>€ / jour</p>
                    </div>
                </div>

                <?php if($counter == 4): ?>
                    <div class="col-span-1 md:col-span-2 lg:col-span-4 relative aspect-[21/9] flex fleet-item rounded-2xl overflow-hidden shadow-sm">
                        <div class="relative w-full h-full overflow-hidden">
                            <img src="<?php echo function_exists('asset') ? asset('images/2023-audi-r8-v10-gt-rwd.jpg') : 'images/image_89c921.jpg'; ?>" class="absolute inset-0 w-full h-full object-cover" alt="Lifestyle">
                            
                            <div class="absolute inset-0 flex flex-col justify-center items-center text-center p-6 text-white">
                                <p class="uppercase tracking-[0.2em] text-xs font-bold mb-3 drop-shadow-md">Exclusivité Web</p>
                                <h2 class="text-3xl md:text-5xl font-normal mb-6 drop-shadow-lg">Audi R8</h2>
                                <a href="#" class="bg-white text-black px-8 py-3 rounded-full text-xs font-bold uppercase hover:bg-black hover:text-white transition shadow-xl transform hover:-translate-y-1 duration-300">
                                    Découvrir
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <i class="fa-solid fa-store-slash text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">Aucun véhicule trouvé</h3>
                <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
                    Nous n'avons trouvé aucun véhicule correspondant à l'agence <strong>"<?php echo htmlspecialchars($searchCity); ?>"</strong>.
                </p>
                <button onclick="triggerSearch('')" class="mt-6 text-xs uppercase font-bold underline hover:text-gray-600 transition">Voir tout le catalogue</button>
            </div>
        <?php endif; ?>
    </div>

    <div class="border-t border-gray-200 py-16 text-center bg-white">
        <h3 class="text-xl mb-6 font-normal">ADA France</h3>
        <p class="text-[10px] text-gray-400">© 2026 ADA - Tous droits réservés</p>
    </div>

    <div id="vehicle-modal" class="hidden-modal fixed inset-0 z-[9999] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md" onclick="closeModal()"></div>
        
        <div class="modal-content relative bg-white w-full max-w-5xl rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row max-h-[90vh] md:max-h-[800px]">
            
            <button onclick="closeModal()" class="absolute top-4 right-4 z-50 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-black hover:bg-white hover:scale-110 transition-all">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <div class="w-full md:w-3/5 bg-gray-100 relative flex items-center justify-center p-8 md:p-12 overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gray-200 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute top-6 left-6 z-20">
                    <span id="modal-category" class="inline-block bg-black text-white px-4 py-2 rounded-lg text-xs font-black uppercase tracking-widest shadow-lg">
                        CATEGORIE
                    </span>
                </div>
                <img id="modal-img" src="" class="relative z-10 w-full max-w-md object-contain drop-shadow-2xl transform hover:scale-105 transition-transform duration-700">
            </div>

            <div class="w-full md:w-2/5 p-8 md:p-10 flex flex-col bg-white overflow-y-auto">
                <div class="mb-6">
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Modèle sélectionné</p>
                    <h2 id="modal-marque" class="text-3xl font-black text-gray-900 uppercase leading-none">MARQUE</h2>
                    <h3 id="modal-modele" class="text-xl font-bold text-[#E2001A] uppercase">MODELE</h3>
                </div>

                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl mb-6 border border-gray-100">
                    <div class="text-[#E2001A] text-lg mt-1"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Départ & Retour</p>
                        <p id="modal-agence" class="font-bold text-gray-900">Agence</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xs font-bold text-gray-900 uppercase mb-2 border-l-4 border-[#E2001A] pl-3">Description</h3>
                    <p id="modal-desc" class="text-sm text-gray-500 leading-relaxed">Description...</p>
                </div>

                <div class="mt-auto pt-6 border-t border-gray-100">
                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Prix par jour</p>
                            <p class="text-4xl font-black text-gray-900"><span id="modal-price">0</span><span class="text-xl align-top text-gray-400">€</span></p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded uppercase">
                                <i class="fa-solid fa-check mr-1"></i> Dispo
                            </p>
                        </div>
                    </div>

                    <a id="modal-link" href="#" class="block w-full py-4 bg-[#E2001A] text-white text-center rounded-xl font-bold uppercase tracking-wider hover:bg-red-700 transition-colors shadow-lg shadow-red-500/30 transform hover:-translate-y-1">
                        Réserver maintenant <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="wishlist-toast" class="toast-hidden fixed bottom-10 left-1/2 z-50 w-[95%] max-w-[600px] bg-white rounded-lg shadow-2xl overflow-hidden transition-all duration-500 ease-in-out flex items-stretch border border-gray-100">
        <div class="w-20 bg-gray-100 flex-shrink-0">
            <img id="toast-img" src="" class="w-full h-full object-contain p-2 mix-blend-multiply">
        </div>
        <div class="flex-1 p-4 flex flex-col justify-center">
            <p class="text-sm text-gray-900 leading-snug" id="toast-text">
                L'article <span id="toast-name" class="font-medium">Produit</span> a été ajouté à votre wishlist
            </p>
            <a href="<?php echo route('favoris.index'); ?>" class="text-sm text-black underline decoration-1 underline-offset-2 mt-1 hover:text-gray-600 transition-colors">Voir votre wishlist</a>
        </div>
        <button onclick="closeToast()" class="px-6 text-gray-400 hover:text-black transition-colors text-xl font-light">&times;</button>
    </div>

    <script>
        // --- LOGIQUE MODALE ---
        function openModal(marque, modele, cat, prix, img, desc, agence, link) {
            document.getElementById('modal-marque').innerText = marque;
            document.getElementById('modal-modele').innerText = modele;
            document.getElementById('modal-category').innerText = cat;
            document.getElementById('modal-price').innerText = prix;
            document.getElementById('modal-img').src = img;
            document.getElementById('modal-desc').innerText = desc;
            document.getElementById('modal-agence').innerText = "Agence " + agence;
            document.getElementById('modal-link').href = link;

            const modal = document.getElementById('vehicle-modal');
            modal.classList.remove('hidden-modal');
            modal.classList.add('visible-modal');
            document.body.style.overflow = 'hidden'; // Empêche le scroll derrière
        }

        function closeModal() {
            const modal = document.getElementById('vehicle-modal');
            modal.classList.remove('visible-modal');
            modal.classList.add('hidden-modal');
            document.body.style.overflow = 'auto'; // Réactive le scroll
        }

        // Fermer avec Echap
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });

        // --- RECHERCHE ---
        function showLoader() { document.getElementById('page-loader').classList.add('active'); }

        const citiesToType = ["Rechercher Mâcon", "Rechercher Chalon", "Rechercher Lyon", "Rechercher Paris"];
        const inputElement = document.getElementById("searchInput");
        let cityIndex = 0, charIndex = 0, isDeleting = false, typeSpeed = 80;

        function typeWriterEffect() {
            if (inputElement.value.length > 0 && inputElement !== document.activeElement) return;
            const currentText = citiesToType[cityIndex];
            if (isDeleting) {
                inputElement.setAttribute("placeholder", currentText.substring(0, charIndex - 1));
                charIndex--; typeSpeed = 40;
            } else {
                inputElement.setAttribute("placeholder", currentText.substring(0, charIndex + 1));
                charIndex++; typeSpeed = 80;
            }
            if (!isDeleting && charIndex === currentText.length) {
                isDeleting = true; typeSpeed = 2000;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false; cityIndex = (cityIndex + 1) % citiesToType.length; typeSpeed = 500;
            }
            setTimeout(typeWriterEffect, typeSpeed);
        }
        document.addEventListener('DOMContentLoaded', function() {
            if(!inputElement.value) setTimeout(typeWriterEffect, 1000);
        });

        function triggerSearch(ville) {
            showLoader();
            inputElement.value = ville;
            inputElement.form.submit();
        }

        // --- WISHLIST ---
        let toastTimeout;
        async function addToWishlist(btn, vehiculeId, name, imgUrl) {
            if(btn.disabled) return;
            btn.disabled = true;
            const icon = btn.querySelector('i');
            
            try {
                const response = await fetch("<?php echo route('favoris.toggle'); ?>", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': "<?php echo csrf_token(); ?>" },
                    body: JSON.stringify({ vehicule_id: vehiculeId })
                });

                if (response.status === 401) {
                    window.location.href = "<?php echo route('client.login.form'); ?>";
                    btn.disabled = false;
                    return;
                }

                const data = await response.json();
                if (data.status === 'success') {
                    if (data.action === 'added') {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid', 'text-black');
                        showToast(name, imgUrl, true);
                    } else {
                        icon.classList.add('fa-regular');
                        icon.classList.remove('fa-solid', 'text-black');
                        showToast(name, imgUrl, false);
                    }
                }
            } catch (error) { console.error('Erreur API Favoris:', error); } 
            finally { btn.disabled = false; }
        }

        function showToast(name, imgUrl, added) {
            const toast = document.getElementById('wishlist-toast');
            document.getElementById('toast-name').textContent = name;
            document.getElementById('toast-img').src = imgUrl;
            const p = toast.querySelector('#toast-text');
            if(added) p.innerHTML = `L'article <span class="font-medium">${name}</span> a été ajouté à votre wishlist`;
            else p.innerHTML = `L'article <span class="font-medium">${name}</span> a été retiré de votre wishlist`;

            toast.classList.remove('toast-hidden'); toast.classList.add('toast-visible');
            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(closeToast, 4000);
        }
        function closeToast() {
            const toast = document.getElementById('wishlist-toast');
            toast.classList.remove('toast-visible'); toast.classList.add('toast-hidden');
        }
    </script>
</body>
</html>