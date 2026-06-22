<?php 
$title = 'Mes Favoris - ADA'; 
if (function_exists('resource_path')) {
    require resource_path('views/layouts/header.blade.php'); 
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
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: #19110b; }
        .product-bg { background-color: #f6f5f3; }

        /* --- CORRECTION NAVBAR POUR PAGE BLANCHE --- */
        #main-header {
            background-color: rgba(255, 255, 255, 0.95) !important; /* Fond blanc forcé */
            backdrop-filter: blur(12px) !important;
            color: #000000 !important; /* Texte noir forcé */
            box-shadow: 0 4px 30px rgba(0,0,0,0.03) !important;
        }
        
        /* Force les icônes en noir */
        #main-header .nav-icon { stroke: #000000 !important; }
        
        /* Force le logo en noir */
        #main-header .header-logo-img { filter: brightness(0) !important; }
    </style>
</head>
<body class="antialiased pt-48">

    <div class="max-w-[1440px] mx-auto px-6 md:px-12 mb-20">
        <div class="flex flex-col items-center md:items-start text-center md:text-left mb-16">
            <h1 class="text-3xl md:text-4xl font-normal mb-2">Ma Wishlist</h1>
            <p class="text-sm text-gray-500"><?php echo count($vehicules); ?> articles sauvegardés</p>
        </div>

        <?php if(count($vehicules) > 0): ?>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-12">
                <?php foreach($vehicules as $vehicule): 
                    $img = $vehicule->photo ? 'images/'.$vehicule->photo : 'images/voiture.png';
                    $fullImgPath = function_exists('asset') ? asset($img) : $img;
                ?>
                <div class="group flex flex-col cursor-pointer relative fleet-item">
                    <button onclick="removeFromWishlist(<?php echo $vehicule->id; ?>, this)" class="absolute top-2 right-2 z-20 w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-md text-gray-400 hover:text-red-500 transition border border-gray-100">
                        <i class="fa-solid fa-times text-sm"></i>
                    </button>

                    <div class="product-bg w-full aspect-[3/4] relative overflow-hidden mb-4 rounded-sm">
                        <img src="<?php echo $fullImgPath; ?>" class="absolute inset-0 w-full h-full object-contain p-6 mix-blend-multiply transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute bottom-4 left-4 right-4 translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                            <form action="<?php echo route('panier.add'); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="vehicule_id" value="<?php echo $vehicule->id; ?>">
                                <button type="submit" class="w-full bg-white/90 backdrop-blur text-black text-[10px] uppercase font-bold py-3 shadow-lg hover:bg-black hover:text-white transition-colors rounded-sm border border-white/50">
                                    Ajouter au panier
                                </button>
                            </form>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider mb-1"><?php echo $vehicule->categorie_libelle; ?></p>
                        <h3 class="text-sm font-normal text-gray-900 truncate"><?php echo $vehicule->marque; ?> <?php echo $vehicule->modele; ?></h3>
                        <p class="text-sm font-normal text-gray-900 mt-1"><?php echo number_format($vehicule->tarifjournee, 2, ',', ' '); ?>€ / jour</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-20 border-t border-gray-100 mt-10">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-regular fa-heart text-2xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Votre wishlist est vide</h3>
                <p class="text-gray-500 mb-8 max-w-sm text-center text-sm">Explorez notre collection et sauvegardez vos véhicules préférés pour plus tard.</p>
                <a href="<?php echo route('vehicules.flotte'); ?>" class="bg-black text-white px-8 py-3.5 rounded-full text-xs font-bold uppercase tracking-wide hover:bg-gray-800 transition">
                    Parcourir la collection
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php 
    if (function_exists('resource_path')) {
        require resource_path('views/layouts/footer.blade.php'); 
    }
    ?>

    <script>
        async function removeFromWishlist(id, btn) {
            // Animation immédiate pour fluidité
            const card = btn.closest('.fleet-item');
            card.style.opacity = '0.5';
            
            try {
                const response = await fetch("<?php echo route('favoris.toggle'); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "<?php echo csrf_token(); ?>"
                    },
                    body: JSON.stringify({ vehicule_id: id })
                });
                
                const data = await response.json();
                
                if(data.status === 'success') {
                    // Animation suppression
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        card.remove();
                        // Rechargement si vide pour afficher le message "vide"
                        const remaining = document.querySelectorAll('.fleet-item').length;
                        if(remaining === 0) location.reload();
                    }, 300);
                } else {
                    card.style.opacity = '1'; // Rétablir si erreur
                }
            } catch (e) {
                console.error(e);
                card.style.opacity = '1';
            }
        }
    </script>
</body>
</html>
