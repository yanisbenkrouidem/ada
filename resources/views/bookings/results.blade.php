<?php 
$title = 'Résultats de recherche - ADA France'; 
require resource_path('views/layouts/header.blade.php');

// Calcul durée (simulé si non dispo)
$duree = isset($dateDebut) && isset($dateFin) ? ($dateDebut->diffInDays($dateFin) ?: 1) : 1;
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Schibsted Grotesk', 'sans-serif'] },
                    colors: { 'ada-red': '#ffffff', 'ada-dark': '#ffffff' }
                }
            }
        }
    </script>

    <style>
        /* FOND MONTAGNE PUR */
        body {
            background-color: #000 !important;
            background-image: url('<?php echo asset("images/montagne.jpg"); ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: white;
            overflow-x: hidden;
        }
        @media (max-width: 768px) {
            body { background-image: none !important; background-color: #050505 !important; }
        }

        /* ANIMATIONS PREMIUM */
        :root { --ease-premium: cubic-bezier(0.23, 1, 0.32, 1); }
        @keyframes heroFadeUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        .hero-animate-1 { animation: heroFadeUp 1s var(--ease-premium) forwards; opacity: 0; }
        .hero-animate-2 { animation: heroFadeUp 1s var(--ease-premium) 0.2s forwards; opacity: 0; }
        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.8s var(--ease-premium); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .delay-100 { transition-delay: 0.1s; } .delay-200 { transition-delay: 0.2s; } .delay-300 { transition-delay: 0.3s; }

        /* GLASSMORPHISM */
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.4s var(--ease-premium);
        }
        /* Effet survol cartes résultats */
        .glass-panel:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        /* DETAILS / ACCORDÉON */
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] summary ~ * { animation: sweep .4s ease-out; }
        @keyframes sweep { 0% {opacity: 0; transform: translateY(-10px)} 100% {opacity: 1; transform: translateY(0)} }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="relative h-[40vh] min-h-[300px] flex items-center justify-center pt-20">
        <div class="relative z-10 max-w-5xl mx-auto px-6 w-full text-center flex flex-col items-center">
            
            <div class="hero-animate-1">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-2 drop-shadow-2xl">
                    Réservez maintenant pour <span class="text-white border-b-2 border-white/30">ADA® 2026</span>
                </h1>
                <div class="flex items-center justify-center gap-4 mt-4 opacity-80">
                    <img src="<?php echo asset('images/ADAlogo1.png'); ?>" class="h-8 brightness-0 invert">
                    <div class="h-4 w-px bg-white/50"></div>
                    <span class="text-white text-xs font-bold uppercase tracking-widest">Partenaire Global de Mobilité</span>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-20 relative z-20">
        
        <div class="mb-16 text-center max-w-3xl mx-auto hero-animate-2">
            <h2 class="text-3xl font-bold mb-4">Démarrez vos moteurs : Économisez jusqu'à 20%</h2>
            <p class="text-gray-200 text-lg leading-relaxed mb-4">
                Attachez votre ceinture pour un voyage extraordinaire sur les routes de France. Sécurisez votre forfait ADA Premium 2026 à l'avance et profitez d'un voyage sans encombre.
            </p>
            <p class="text-gray-400 text-xs italic bg-white/10 inline-block px-3 py-1 rounded-full">
                *Réservez maintenant pour bénéficier de la promotion YanisetNathan10.
            </p>
        </div>

        <div class="mb-24">
            <h3 class="text-2xl font-bold mb-8 pl-2 reveal">Forfaits Véhicules ADA® 2026</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <?php if($resultats->isEmpty()): ?>
                    <div class="col-span-full glass-panel rounded-[2rem] p-12 text-center reveal delay-100">
                        <i class="fa-solid fa-car-tunnel text-4xl text-gray-400 mb-4"></i>
                        <h3 class="font-bold text-lg text-white">Aucun véhicule disponible</h3>
                        <p class="text-sm text-gray-400 mt-1">Modifiez vos dates ou l'agence de départ.</p>
                        <button onclick="window.history.back()" class="mt-6 px-6 py-2 border border-white/30 rounded-full hover:bg-white hover:text-black transition-all text-sm font-bold">Retour</button>
                    </div>
                <?php else: ?>

                    <?php 
                    $delay = 100; 
                    foreach($resultats as $vehicule): 
                        $prixTotal = ($vehicule->category->tarifjournee ?? 0) * $duree;
                        $img = $vehicule->category->photo ? 'images/'.$vehicule->category->photo : 'images/voiture.png';
                    ?>
                    
                    <a href="<?php echo route('reservation.create', ['id' => $vehicule->id, 'date_debut' => $dateDebut->format('Y-m-d H:i'), 'date_fin' => $dateFin->format('Y-m-d H:i')]); ?>" 
                       class="group block glass-panel rounded-[24px] overflow-hidden flex flex-col reveal"
                       style="transition-delay: <?php echo $delay; ?>ms">
                        
                        <div class="h-[240px] relative overflow-hidden bg-white/5 flex items-center justify-center p-6">
                            <img src="<?php echo asset($img); ?>" 
                                 class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.onerror=null; this.src='<?php echo asset('images/voiture.png'); ?>';">
                            
                            <div class="absolute top-4 left-4 bg-white/10 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded flex items-center gap-1.5 border border-white/20">
                                <i class="fa-solid fa-star text-[9px]"></i> YanisetNathan10
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1 border-t border-white/10">
                            <div class="mb-4">
                                <h3 class="text-2xl font-bold leading-tight mb-1 text-white">
                                    <?php echo $vehicule->marque; ?> <span class="font-normal text-gray-300"><?php echo $vehicule->modele; ?></span>
                                </h3>
                                <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">
                                    Forfait <?php echo $vehicule->category->libelle ?? 'Standard'; ?>
                                </p>
                                <p class="text-[10px] text-gray-500 mt-1">
                                    <?php echo $request->pickup_location ?? 'France'; ?>
                                </p>
                            </div>

                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-white/10">
                                <span class="text-xs font-medium text-gray-400 group-hover:text-white transition-colors">Sélectionner</span>
                                <div class="text-right">
                                    <span class="block text-xl font-bold text-white"><?php echo number_format($prixTotal, 0, ',', ' '); ?> €</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php 
                        $delay += 100; 
                    endforeach; 
                    ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="mb-24 glass-panel rounded-[32px] p-10 md:p-14 reveal delay-200">
            <h2 class="text-3xl font-bold text-white mb-10">Points forts des forfaits ADA®</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-12">
                <div class="group">
                    <div class="w-10 h-10 mb-5 text-white"><i class="fa-solid fa-car-side text-3xl"></i></div>
                    <h3 class="text-xl font-bold text-white mb-3">Flotte Premium</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">Prenez la route avec nos derniers modèles, des citadines aux SUV de luxe.</p>
                </div>
                <div class="group">
                    <div class="w-10 h-10 mb-5 text-white"><i class="fa-solid fa-road text-3xl"></i></div>
                    <h3 class="text-xl font-bold text-white mb-3">Kilométrage Illimité</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">Profitez d'une liberté sans limites. Roulez aussi loin que vous le souhaitez.</p>
                </div>
                <div class="group">
                    <div class="w-10 h-10 mb-5 text-white"><i class="fa-solid fa-ticket text-3xl"></i></div>
                    <h3 class="text-xl font-bold text-white mb-3">Assurance Complète</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">Sécurisez votre voyage avec une couverture complète incluse.</p>
                </div>
                <div class="group">
                    <div class="w-10 h-10 mb-5 text-white"><i class="fa-solid fa-star text-3xl"></i></div>
                    <h3 class="text-xl font-bold text-white mb-3">Surclassements</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">Réservez une catégorie Premium pour savourer un confort inégalé.</p>
                </div>
                <div class="group">
                    <div class="w-10 h-10 mb-5 text-white"><i class="fa-solid fa-gem text-3xl"></i></div>
                    <h3 class="text-xl font-bold text-white mb-3">Cumulez des Points</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">Gagnez des points de fidélité sur l'ensemble de votre location.</p>
                </div>
                <div class="group">
                    <div class="w-10 h-10 mb-5 text-white"><i class="fa-solid fa-wallet text-3xl"></i></div>
                    <h3 class="text-xl font-bold text-white mb-3">Payez avec des Points</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">Économisez en utilisant Cash + Points pour votre forfait vacances.</p>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10">
                <a href="#" class="text-white text-sm font-medium hover:underline flex items-center gap-2 transition-colors opacity-70 hover:opacity-100">
                    Conditions générales applicables <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <div class="mb-24 relative rounded-[24px] overflow-hidden h-[360px] flex items-center shadow-2xl group cursor-pointer reveal delay-300">
            <img src="<?php echo asset('images/cheval.jpg'); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-105 opacity-80">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/20 to-transparent"></div>

            <div class="relative z-10 px-12 md:px-20 max-w-2xl transform transition-transform duration-700 group-hover:translate-x-2">
                <h2 class="text-4xl text-white font-bold mb-6 drop-shadow-lg">Débloquez un monde de récompenses exclusives</h2>
                <p class="text-gray-200 text-sm leading-relaxed mb-10 font-medium max-w-lg drop-shadow-md">
                    Devenez membre du Club Privilège et soyez parmi les premiers à découvrir des expériences extraordinaires. Cumulez des points sur tous les forfaits ADA®.
                </p>
                <a href="<?php echo route('client.register.form'); ?>" class="inline-block bg-white text-black font-bold py-3.5 px-10 rounded-full transition-all shadow-lg text-sm hover:bg-gray-200 hover:scale-105">
                    Rejoindre maintenant
                </a>
            </div>
        </div>

        <div class="glass-panel rounded-[20px] overflow-hidden divide-y divide-white/10 reveal delay-400">
            <details class="group">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-white/5 transition-colors list-none">
                    <span class="text-white text-sm flex items-center gap-3 font-bold">
                        <span class="text-gray-400 font-light">1.</span> Conditions Générales & Tarifs :
                    </span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-gray-400">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-300 text-xs px-6 pb-6 pt-0 leading-relaxed pl-10">
                    <ul class="list-disc space-y-2 ml-4">
                        <li>Les forfaits sont soumis à disponibilité au moment de la confirmation de réservation.</li>
                        <li>Les tarifs sont sujets à modification sans préavis.</li>
                        <li>Les forfaits sont non-remboursables. L'annulation du service entraînera des frais de 100%.</li>
                    </ul>
                </div>
            </details>

            <details class="group">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-white/5 transition-colors list-none">
                    <span class="text-white text-sm flex items-center gap-3 font-bold">
                        <span class="text-gray-400 font-light">2.</span> Hébergement
                    </span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-gray-400">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-300 text-xs px-6 pb-6 pt-0 leading-relaxed pl-10">
                    <p>Détails sur les hôtels partenaires et les politiques d'hébergement.</p>
                </div>
            </details>

            <details class="group">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-white/5 transition-colors list-none">
                    <span class="text-white text-sm flex items-center gap-3 font-bold">
                        <span class="text-gray-400 font-light">3.</span> Billetterie
                    </span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-gray-400">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-300 text-xs px-6 pb-6 pt-0 leading-relaxed pl-10">
                    <p>Informations concernant l'émission et la validation du contrat de location.</p>
                </div>
            </details>
            
            <details class="group">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-white/5 transition-colors list-none">
                    <span class="text-white text-sm flex items-center gap-3 font-bold">
                        <span class="text-gray-400 font-light">4.</span> Foire aux questions (FAQ)
                    </span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-gray-400">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-300 text-xs px-6 pb-6 pt-0 leading-relaxed pl-10">
                    <p>Lisez notre FAQ pour les forfaits de voyage ADA Ultimate <a href="#" class="text-white font-bold hover:underline">ici</a>.</p>
                </div>
            </details>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver(e => e.forEach(en => { 
                if(en.isIntersecting) { 
                    en.target.classList.add('active'); 
                    obs.unobserve(en.target); 
                } 
            }), { threshold: 0.1 });
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        });
    </script>

    <?php require resource_path('views/layouts/footer.blade.php'); ?>

</body>
</html>
