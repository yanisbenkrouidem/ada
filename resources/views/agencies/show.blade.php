<?php 
$title = 'ADA ' . $agence->ville; 
require 'partials/header.php'; 

// --- SETUP IMAGE DE FOND ---
// On essaie de trouver une image spécifique à la ville, sinon fallback montagne
$villeImage = 'images/' . strtolower(str_replace(' ', '', $agence->ville)) . '.jpg';
$bgImage = file_exists(public_path($villeImage)) ? asset($villeImage) : asset('images/montagne.jpg');
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        /* FOND GLOBAL (Ville ou Montagne) */
        body {
            background-color: #000;
            color: white;
            font-family: 'Schibsted Grotesk', sans-serif;
            overflow-x: hidden;
            /* Image de fond fixe et couvrante */
            background-image: url('<?php echo $bgImage; ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        @media (max-width: 768px) {
            body { background-image: none !important; background-color: #050505 !important; }
        }

        /* GLASSMORPHISM LUMINEUX */
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .glass-panel:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        /* ANIMATIONS */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        .animate-up { animation: fadeUp 1s cubic-bezier(0.23, 1, 0.32, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; } .delay-200 { animation-delay: 0.2s; }
        
        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="relative min-h-[50vh] flex flex-col items-center justify-center pt-32 pb-20 px-6">
        <div class="w-full max-w-5xl text-center">
            
            <div class="animate-up">
                <h1 class="text-6xl md:text-9xl font-black text-white uppercase tracking-tighter mb-4 leading-none drop-shadow-2xl">
                    <?php echo htmlspecialchars($agence->ville); ?>
                </h1>
                
                <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto drop-shadow-md">
                    L'excellence de la location automobile au cœur de <span class="font-bold text-white"><?php echo htmlspecialchars($agence->nom); ?></span>.
                </p>
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-20 relative z-20">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-24">
            
            <div class="lg:col-span-5 flex flex-col gap-6 animate-up delay-100">
                <div class="glass-panel rounded-[2rem] p-10 h-full flex flex-col justify-between">
                    <div>
                        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6">Localisation</h3>
                        <p class="text-3xl md:text-4xl font-bold text-white leading-tight mb-2">
                            <?php echo htmlspecialchars($agence->adresse); ?>
                        </p>
                        <p class="text-2xl md:text-3xl font-light text-gray-300 mb-8">
                            <?php echo htmlspecialchars($agence->code_postal); ?> <?php echo htmlspecialchars($agence->ville); ?>
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                        <a href="http://googleusercontent.com/maps.google.com/maps?q=<?php echo urlencode($agence->adresse . ' ' . $agence->ville); ?>" target="_blank" 
                           class="group flex-1 inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-black rounded-xl font-bold transition-all hover:bg-gray-200 hover:scale-105 shadow-lg">
                            <i class="fa-solid fa-location-arrow group-hover:-translate-y-1 transition-transform"></i> 
                            Y aller
                        </a>
                        <a href="tel:<?php echo htmlspecialchars($agence->telephone); ?>" 
                           class="inline-flex items-center justify-center w-14 h-14 rounded-xl border border-white/30 text-white hover:bg-white/10 transition-colors text-xl backdrop-blur-md">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 animate-up delay-200">
                <div class="glass-panel rounded-[2rem] p-10 h-full">
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6">Horaires d'ouverture</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php 
                        $joursSemaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                        $aujourdhui = strtolower(\Carbon\Carbon::now()->locale('fr')->isoFormat('dddd'));

                        // Mapping des horaires
                        $horairesMap = [];
                        foreach ($agence->jours as $j) {
                            $horairesMap[strtolower($j->libelle)] = $j;
                        }

                        foreach ($joursSemaine as $jourNom):
                            $isToday = ($jourNom == $aujourdhui);
                            $donneesJour = $horairesMap[$jourNom] ?? null;
                            
                            $displayTime = '<span class="text-gray-500 text-xs">Fermé</span>';
                            $statusClass = "bg-white/5 border-white/5 opacity-60"; 

                            if ($donneesJour) {
                                $hDebut = substr($donneesJour->pivot->heuredebut, 0, 5);
                                $hFin = substr($donneesJour->pivot->heurefin, 0, 5);
                                if ($hDebut != '00:00' || $hFin != '00:00') {
                                    $displayTime = "<span class='font-mono font-medium text-white'>{$hDebut} - {$hFin}</span>";
                                    $statusClass = "bg-white/10 border-white/10"; 
                                }
                            }
                            
                            // Highlight aujourd'hui
                            if ($isToday) $statusClass = "bg-white/20 border-white text-white ring-1 ring-white/30 scale-105 shadow-lg z-10"; 
                        ?>
                            <div class="flex justify-between items-center p-4 rounded-xl border transition-all <?php echo $statusClass; ?>">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold uppercase <?php echo $isToday ? 'text-white' : 'text-gray-300'; ?>">
                                        <?php echo substr($jourNom, 0, 3); ?>.
                                    </span>
                                    <?php if($isToday): ?><span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span><?php endif; ?>
                                </div>
                                <div class="text-sm">
                                    <?php echo $displayTime; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-16 reveal">
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 drop-shadow-lg">
                Le Garage
            </h2>
            <p class="text-gray-300 text-lg max-w-2xl font-light drop-shadow-md">
                Sélectionnez votre véhicule parmi notre flotte disponible immédiatement à <strong class="text-white"><?php echo htmlspecialchars($agence->ville); ?></strong>.
            </p>
        </div>

        <?php if ($agence->vehicules && $agence->vehicules->count()): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <?php foreach ($agence->vehicules as $index => $vehicule): ?>
                    
                    <div class="group relative glass-panel rounded-[2.5rem] p-4 flex flex-col reveal" style="transition-delay: <?php echo $index * 100; ?>ms">
                        
                        <div class="relative h-64 rounded-[2rem] bg-white/5 overflow-hidden mb-6 flex items-center justify-center border border-white/10">
                            <div class="absolute top-6 left-6 z-10">
                                <span class="px-3 py-1.5 bg-white/10 backdrop-blur-md rounded-lg text-[10px] font-bold uppercase tracking-wider text-white border border-white/20">
                                    <?php echo htmlspecialchars($vehicule->category->libelle); ?>
                                </span>
                            </div>

                            <?php 
                                // Gestion Image
                                $photoName = $vehicule->category->photo;
                                $imagePath = 'images/' . $photoName;
                                if(empty($photoName)) { $imagePath = 'images/voiture.png'; }
                            ?>
                            <img src="<?php echo asset($imagePath); ?>" 
                                 alt="<?php echo htmlspecialchars($vehicule->marque); ?>" 
                                 class="w-full h-full object-contain transform transition-transform duration-700 group-hover:scale-110 group-hover:-translate-x-2 drop-shadow-2xl"
                                 onerror="this.onerror=null; this.src='<?php echo asset('images/voiture.png'); ?>';">
                        </div>

                        <div class="px-4 pb-4 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h3 class="text-2xl font-bold text-white leading-none mb-1">
                                        <?php echo htmlspecialchars($vehicule->marque); ?>
                                    </h3>
                                    <p class="text-gray-400 font-medium"><?php echo htmlspecialchars($vehicule->modele); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-black text-white">
                                        <?php echo number_format($vehicule->category->tarifjournee, 0, ',', ' '); ?>€
                                    </p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Par jour</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-2 mb-8">
                                <div class="p-3 rounded-2xl bg-white/5 flex flex-col items-center justify-center gap-1 text-center border border-white/5">
                                    <i class="fa-solid fa-gas-pump text-white text-sm"></i>
                                    <span class="text-xs font-bold text-gray-300 truncate w-full"><?php echo htmlspecialchars($vehicule->carburant ?? 'Essence'); ?></span>
                                </div>
                                <div class="p-3 rounded-2xl bg-white/5 flex flex-col items-center justify-center gap-1 text-center border border-white/5">
                                    <i class="fa-solid fa-gear text-white text-sm"></i>
                                    <span class="text-xs font-bold text-gray-300 truncate w-full"><?php echo htmlspecialchars($vehicule->boite_vitesse ?? 'Manuelle'); ?></span>
                                </div>
                                <div class="p-3 rounded-2xl bg-white/5 flex flex-col items-center justify-center gap-1 text-center border border-white/5">
                                    <i class="fa-solid fa-snowflake text-white text-sm"></i>
                                    <span class="text-xs font-bold text-gray-300">Clim.</span>
                                </div>
                            </div>

                            <a href="<?php echo route('reservation.create', ['id' => $vehicule->id]); ?>" 
                               class="block w-full py-5 rounded-2xl bg-white text-black font-bold text-center uppercase tracking-widest hover:bg-gray-200 transition-all duration-300 relative overflow-hidden group/btn shadow-lg mt-auto">
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    Réserver <i class="fa-solid fa-arrow-right -rotate-45 group-hover/btn:rotate-0 transition-transform duration-300"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="glass-panel rounded-[2rem] flex flex-col items-center justify-center py-32 text-center opacity-70">
                <i class="fa-solid fa-garage-open text-6xl text-gray-400 mb-6"></i>
                <h3 class="text-2xl font-bold text-white">Garage Vide</h3>
                <p class="text-gray-400">Aucun véhicule disponible dans cette agence pour le moment.</p>
            </div>
        <?php endif; ?>

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

    <?php require 'partials/footer.php'; ?>

</body>
</html>