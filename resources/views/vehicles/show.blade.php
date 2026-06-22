<?php 
$title = 'Détails du Véhicule'; 
// On n'inclut pas le header tout de suite, on le place dans le bloc noir plus bas
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ada-red': '#E2001A',
                        'ada-black': '#111111',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap');
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <div class="bg-ada-black pb-24">
        <div class="border-b border-white/10">
            <?php require 'partials/header.php'; ?>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <a href="<?php echo route('location.search.form'); ?>" class="inline-flex items-center text-xs font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-wider group">
                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-3 group-hover:bg-ada-red transition-colors">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                Retour aux résultats
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-20 relative z-10">
        
        <?php if (isset($vehicule)): ?>
            
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-8 border border-gray-100">
                <div class="grid grid-cols-1 lg:grid-cols-12 min-h-[500px]">
                    
                    <div class="lg:col-span-7 bg-gray-100 relative flex items-center justify-center p-8 lg:p-12 overflow-hidden group">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gray-200 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
                        
                        <div class="absolute top-6 left-6 z-20">
                            <span class="inline-block bg-ada-black text-white px-4 py-2 rounded-lg text-xs font-black uppercase tracking-widest shadow-lg">
                                <?php echo htmlspecialchars($vehicule->category->libelle); ?>
                            </span>
                        </div>

                        <img src="<?php echo asset('images/' . ($vehicule->category->photo ?? 'default.png')); ?>" 
                             alt="<?php echo htmlspecialchars($vehicule->marque); ?>" 
                             class="relative z-10 w-full max-w-lg object-contain transform group-hover:scale-105 transition-transform duration-500 drop-shadow-2xl"
                             onerror="this.onerror=null; this.src='https://placehold.co/600x400/transparent/9CA3AF?text=Photo+Non+Disponible';">
                    </div>

                    <div class="lg:col-span-5 p-8 lg:p-12 flex flex-col bg-white">
                        
                        <div class="mb-6">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Modèle sélectionné</p>
                            <h1 class="text-4xl lg:text-5xl font-black text-gray-900 uppercase leading-none mb-2">
                                <?php echo htmlspecialchars($vehicule->marque); ?>
                            </h1>
                            <h2 class="text-2xl font-bold text-ada-red uppercase">
                                <?php echo htmlspecialchars($vehicule->modele); ?>
                            </h2>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl mb-8 border border-gray-100">
                            <div class="text-ada-red text-xl mt-1"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Départ & Retour à</p>
                                <a href="#" class="font-bold text-gray-900 hover:underline decoration-ada-red decoration-2 underline-offset-4">
                                    Agence <?php echo htmlspecialchars($vehicule->agence->ville); ?>
                                </a>
                                <p class="text-xs text-gray-500 mt-0.5"><?php echo htmlspecialchars($vehicule->agence->nom); ?></p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-xs font-bold text-gray-900 uppercase mb-2 border-l-4 border-ada-red pl-3">Le mot de l'expert</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">
                                <?php echo htmlspecialchars($vehicule->category->description ?? "Ce véhicule allie confort de conduite et économie. Idéal pour vos trajets urbains comme pour vos escapades le week-end. Révisé et préparé par nos experts."); ?>
                            </p>
                        </div>

                        <div class="mt-auto pt-6 border-t border-gray-100">
                            <div class="flex items-end justify-between mb-4">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Prix par jour</p>
                                    <p class="text-4xl font-black text-gray-900"><?php echo number_format($vehicule->category->tarifjournee, 0, ',', ' '); ?><span class="text-xl align-top text-gray-400">€</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded uppercase">
                                        <i class="fa-solid fa-check mr-1"></i> Disponible
                                    </p>
                                </div>
                            </div>

                            <a href="<?php echo route('reservation.create', ['id' => $vehicule->id]); ?>" class="block w-full py-4 bg-ada-red text-white text-center rounded-xl font-bold uppercase tracking-wider hover:bg-red-700 transition-colors shadow-lg shadow-red-500/30 transform hover:-translate-y-1">
                                Réserver ce véhicule <i class="fa-solid fa-arrow-right ml-2"></i>
                            </a>
                            <p class="text-center text-[10px] text-gray-400 mt-3 font-medium">Annulation gratuite jusqu'à 48h avant le départ</p>
                        </div>

                    </div>
                </div>
            </div>

            <?php if ($vehicule->category->attribut_categories->count()): ?>
                <div class="mb-12 animate-fade-in-up">
                    <h3 class="text-xl font-black text-gray-900 uppercase mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-ada-red rounded-full"></span> 
                        Caractéristiques techniques
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        <?php foreach ($vehicule->category->attribut_categories as $attributCat): ?>
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center h-32 hover:border-ada-red hover:shadow-md transition-all group">
                                <div class="text-2xl text-gray-300 group-hover:text-ada-red transition-colors mb-2">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase mb-1">
                                    <?php echo htmlspecialchars($attributCat->attribut->libelle ?? 'Option'); ?>
                                </span>
                                <span class="text-sm font-bold text-gray-900 leading-tight">
                                    <?php echo htmlspecialchars($attributCat->valeur); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center h-32 opacity-60">
                            <i class="fa-solid fa-gas-pump text-gray-300 text-xl mb-2"></i>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Carburant</span>
                            <span class="text-sm font-bold text-gray-900">Plein inclus</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="bg-white rounded-3xl p-12 text-center shadow-lg border border-gray-100">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-red-50 rounded-full text-ada-red mb-6">
                    <i class="fa-solid fa-car-burst text-3xl"></i>
                </div>
                <h2 class="text-2xl font-black text-gray-900 uppercase mb-2">Véhicule introuvable</h2>
                <p class="text-gray-500 mb-8">Désolé, ce véhicule n'est plus disponible ou l'URL est incorrecte.</p>
                <a href="<?php echo route('location.search.form'); ?>" class="inline-block px-8 py-3 bg-ada-black text-white font-bold rounded-xl hover:bg-ada-red transition-colors uppercase text-xs tracking-widest">
                    Retour aux recherches
                </a>
            </div>
        <?php endif; ?>

    </div>

<?php require 'partials/footer.php'; ?>
</body>
</html>