<?php 
$title = 'Finaliser la réservation - ADA'; 
require resource_path('views/partials/header.php');

$img = $vehicule->category->photo ? 'images/'.$vehicule->category->photo : 'images/voiture.png';
$agenceVille = $vehicule->agence->ville ?? 'Agence ADA';
$tarifJour = $vehicule->category->tarifjournee ?? 50;
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    
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

        /* GLASSMORPHISM */
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }
        
        /* INPUTS GLASS */
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: white;
            outline: none;
        }

        /* --- DESIGN CALENDRIER FLATPICKR (COPIÉ COLLÉ DES AUTRES PAGES) --- */
        .flatpickr-calendar { 
            background: #ffffff !important; 
            border: none !important;
            border-radius: 20px !important;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25) !important;
            font-family: 'Schibsted Grotesk', sans-serif !important;
            padding: 15px !important;
            margin-top: 10px !important;
            z-index: 9999 !important;
        }
        
        .flatpickr-calendar.arrowTop:before, .flatpickr-calendar.arrowTop:after { display: none !important; }
        .flatpickr-months { padding-bottom: 10px !important; border-bottom: 1px solid #f0f0f0 !important; margin-bottom: 10px !important; }
        .flatpickr-month { color: #222 !important; fill: #222 !important; }
        .flatpickr-current-month { font-size: 16px !important; font-weight: 800 !important; padding-top: 0 !important; }
        .flatpickr-current-month input.cur-year { font-weight: 800 !important; color: #000 !important; }
        .flatpickr-weekdays { margin-bottom: 10px !important; }
        span.flatpickr-weekday { color: #888 !important; font-size: 12px !important; font-weight: 600 !important; }
        .flatpickr-day { color: #222 !important; font-weight: 600 !important; border-radius: 50% !important; height: 40px !important; line-height: 40px !important; margin-top: 2px !important; border: 1px solid transparent !important; }
        .flatpickr-day:hover { background: #f3f3f3 !important; border-color: transparent !important; }
        .flatpickr-day.today { border-color: #e5e5e5 !important; }
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { background: #000000 !important; color: #ffffff !important; border-color: #000000 !important; font-weight: bold !important; }
        .flatpickr-day.inRange { background: #f7f7f7 !important; color: #000 !important; border-radius: 0 !important; box-shadow: -5px 0 0 #f7f7f7, 5px 0 0 #f7f7f7 !important; border: none !important; }

        /* ANIMATIONS */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-up { animation: fadeUp 1s cubic-bezier(0.23, 1, 0.32, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; } .delay-200 { animation-delay: 0.2s; }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="h-24"></div>

    <div class="max-w-7xl mx-auto px-6 py-10 relative z-10">
        
        <div class="text-center mb-12 animate-up">
            <p class="text-gray-300 text-xs font-bold uppercase tracking-[0.2em] mb-3">Prochaine étape : L'aventure</p>
            <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-2xl">Finaliser votre réservation</h1>
        </div>

        <form action="<?php echo route('reservation.store', $vehicule->id); ?>" method="POST" id="resaForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="agence_id" value="<?php echo $vehicule->agence_id; ?>">
            <input type="hidden" name="real_start_date" id="real_start_date">
            <input type="hidden" name="real_end_date" id="real_end_date">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-8 space-y-8 animate-up delay-100">
                    
                    <div class="glass-panel rounded-[2rem] p-8 md:p-10 flex flex-col md:flex-row gap-8 items-center relative overflow-hidden group">
                        <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="w-full md:w-1/2 relative flex justify-center">
                            <div class="absolute top-0 left-0 bg-white/10 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded border border-white/20 uppercase tracking-wider">
                                <?php echo $vehicule->category->libelle; ?>
                            </div>
                            <img src="<?php echo asset($img); ?>" 
                                 class="w-full max-w-[300px] h-auto object-contain drop-shadow-2xl transform group-hover:scale-105 transition-transform duration-700"
                                 onerror="this.onerror=null; this.src='<?php echo asset('images/voiture.png'); ?>';">
                        </div>
                        
                        <div class="w-full md:w-1/2">
                            <h2 class="text-3xl font-bold text-white mb-1"><?php echo $vehicule->marque; ?></h2>
                            <p class="text-xl text-gray-300 font-light mb-6"><?php echo $vehicule->modele; ?></p>
                            
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-300">
                                <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                                    <i class="fa-solid fa-gas-pump text-white"></i> 
                                    <span><?php echo $vehicule->carburant ?? 'Essence'; ?></span>
                                </div>
                                <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                                    <i class="fa-solid fa-gear text-white"></i> 
                                    <span>Manuelle</span>
                                </div>
                                <div class="col-span-2 flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                                    <i class="fa-solid fa-store text-white"></i> 
                                    <span><?php echo $agenceVille; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-panel rounded-[2rem] p-8 md:p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white border border-white/20">
                                <i class="fa-regular fa-calendar-check"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white uppercase tracking-wide">Vos dates</h2>
                                <p class="text-gray-400 text-sm">Sélectionnez vos dates pour calculer le prix.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Départ</label>
                                <input type="text" id="start_date" name="dateheuredebut" required
                                       placeholder="Sélectionner..."
                                       class="w-full input-glass rounded-xl p-4 text-white font-bold cursor-pointer">
                            </div>

                            <div class="group">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Retour</label>
                                <input type="text" id="end_date" name="dateheurefin" required
                                       placeholder="Sélectionner..."
                                       class="w-full input-glass rounded-xl p-4 text-white font-bold cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <div class="glass-panel rounded-[2rem] p-8 md:p-10 relative overflow-hidden border-l-4 border-l-white/50">
                        <div class="absolute top-0 right-0 bg-white/20 backdrop-blur-md text-white text-[9px] font-bold px-3 py-1 rounded-bl-xl border-l border-b border-white/10">
                            SIMULATION
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center text-sm font-bold">2</div>
                            Paiement Sécurisé
                        </h3>

                        <div class="space-y-4 pointer-events-none select-none">
                            <div class="relative">
                                <input type="text" placeholder="•••• •••• •••• 4242" class="w-full pl-12 p-4 bg-white/10 border border-white/30 rounded-xl text-white placeholder:text-white/70 font-mono font-bold tracking-widest outline-none">
                                <i class="fa-regular fa-credit-card absolute left-4 top-4 text-white"></i>
                            </div>
                            
                            <div class="flex gap-4">
                                <div class="relative w-1/2">
                                    <input type="text" placeholder="MM/YY" class="w-full p-4 bg-white/10 border border-white/30 rounded-xl text-white placeholder:text-white/70 font-bold text-center">
                                </div>
                                <div class="relative w-1/2">
                                    <input type="text" placeholder="CVC" class="w-full p-4 bg-white/10 border border-white/30 rounded-xl text-white placeholder:text-white/70 font-bold text-center">
                                </div>
                            </div>
                        </div>

                        <p class="text-[10px] text-gray-300 mt-4 italic text-center opacity-80">
                            <i class="fa-solid fa-shield-halved mr-1"></i> Aucune somme réelle ne sera débitée (Projet Étudiant).
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-4 animate-up delay-200">
                    <div class="glass-panel rounded-[2rem] p-8 sticky top-8">
                        <h3 class="text-xl font-bold text-white mb-6">Résumé</h3>
                        
                        <div class="space-y-4 border-t border-white/10 pt-6 mb-6">
                            <div class="flex justify-between text-sm text-gray-300">
                                <span>Durée</span>
                                <span id="display_days" class="font-bold text-white">0 jours</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-300">
                                <span>Tarif journalier</span>
                                <span class="font-bold text-white"><?php echo number_format($tarifJour, 2, ',', ' '); ?> €</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-8 bg-white/5 p-4 rounded-xl border border-white/10">
                            <span class="text-lg font-bold text-white">Total</span>
                            <span class="text-2xl font-bold text-white"><span id="display_total">0,00</span> €</span>
                        </div>

                        <button type="submit" id="btn-submit" disabled class="w-full bg-white/10 text-gray-400 font-bold py-4 rounded-xl cursor-not-allowed transition-all duration-300 flex justify-center items-center gap-2 border border-white/10 backdrop-blur-md">
                            <span>Choisir des dates</span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <?php require resource_path('views/partials/footer.php'); ?>

    <script>
        const tarifJour = <?php echo $tarifJour; ?>;
        
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration Flatpickr
            const config = { 
                enableTime: true, 
                dateFormat: "Y-m-d H:i", // Format affiché et valeur
                time_24hr: true, 
                minDate: "today", 
                locale: "fr",
                disableMobile: "true",
                onChange: function(selectedDates, dateStr, instance) {
                    calculatePrice();
                }
            };

            const fpDebut = flatpickr("#start_date", {
                ...config,
                onChange: function(selectedDates, dateStr, instance) {
                    fpFin.set('minDate', dateStr);
                    calculatePrice();
                }
            });
            
            const fpFin = flatpickr("#end_date", config);
        });

        function calculatePrice() {
            const startInput = document.getElementById('start_date').value;
            const endInput = document.getElementById('end_date').value;
            const btn = document.getElementById('btn-submit');

            // Mise à jour des inputs cachés si besoin pour le backend
            document.getElementById('real_start_date').value = startInput;
            document.getElementById('real_end_date').value = endInput;

            if(startInput && endInput) {
                const start = new Date(startInput);
                const end = new Date(endInput);
                
                // Calcul différence
                const diffTime = end - start; 
                
                if (diffTime <= 0) {
                    disableBtn();
                    return;
                }

                // Arrondi au jour supérieur
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if(diffDays <= 0) diffDays = 1;

                const total = diffDays * tarifJour;

                document.getElementById('display_days').innerText = diffDays + " jours";
                document.getElementById('display_total').innerText = total.toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2});

                // Activation bouton
                btn.disabled = false;
                btn.classList.remove('bg-white/10', 'text-gray-400', 'cursor-not-allowed');
                btn.classList.add('bg-white', 'text-black', 'hover:bg-gray-200', 'shadow-lg', 'hover:scale-105');
                btn.innerHTML = '<span>Confirmer & Payer</span> <i class="fa-solid fa-arrow-right"></i>';
            } else {
                disableBtn();
            }
        }

        function disableBtn() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.classList.add('bg-white/10', 'text-gray-400', 'cursor-not-allowed');
            btn.classList.remove('bg-white', 'text-black', 'hover:bg-gray-200', 'shadow-lg', 'hover:scale-105');
            btn.innerHTML = '<span>Choisir des dates</span>';
            document.getElementById('display_total').innerText = "0,00";
            document.getElementById('display_days').innerText = "0 jours";
        }
    </script>

</body>
</html>