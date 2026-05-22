<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau UX - ADA Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ada-red': '#C80000',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-900 min-h-screen text-white p-8">
    
    <!-- Bouton flottant pour ouvrir le panel -->
    <button id="openPanel" class="fixed bottom-6 right-6 w-16 h-16 bg-ada-red rounded-full shadow-2xl hover:scale-110 transition-transform z-50 flex items-center justify-center">
        <i class="fa-solid fa-sliders text-2xl"></i>
    </button>
    
    <!-- Panel de configuration -->
    <div id="configPanel" class="hidden fixed inset-0 bg-black/80 backdrop-blur-lg z-50 overflow-y-auto">
        <div class="max-w-4xl mx-auto my-8 bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700">
            
            <!-- Header -->
            <div class="bg-ada-red p-6 rounded-t-2xl flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-black">⚡ PANNEAU UX EXTRÊME</h1>
                    <p class="text-white/80 text-sm mt-1">Personnalisez l'expérience utilisateur</p>
                </div>
                <button id="closePanel" class="w-10 h-10 bg-white/20 rounded-full hover:bg-white/30 transition-colors">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <!-- Corps -->
            <div class="p-8 space-y-6">
                
                <!-- Section Visuel -->
                <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fa-solid fa-eye mr-3 text-ada-red"></i>
                        Effets Visuels
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Curseur personnalisé</p>
                                <p class="text-sm text-gray-400">Curseur animé avec effet de suivi</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="customCursor" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Barre de progression</p>
                                <p class="text-sm text-gray-400">Affiche la progression du scroll</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="progressBar" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Particules animées</p>
                                <p class="text-sm text-gray-400">Particules flottantes sur le hero</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="particles" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Effet parallax</p>
                                <p class="text-sm text-gray-400">Défilement avec profondeur</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="parallax" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Section Interactions -->
                <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fa-solid fa-hand-pointer mr-3 text-ada-red"></i>
                        Interactions
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Effet ripple</p>
                                <p class="text-sm text-gray-400">Onde au clic sur les boutons</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="ripple" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Tooltips premium</p>
                                <p class="text-sm text-gray-400">Info-bulles au survol</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="tooltips" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Feedback haptique</p>
                                <p class="text-sm text-gray-400">Vibration mobile au clic</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="haptic" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Sons interactifs</p>
                                <p class="text-sm text-gray-400">Feedback sonore subtil</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="sounds">
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Section Performance -->
                <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fa-solid fa-gauge-high mr-3 text-ada-red"></i>
                        Performance
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Skeleton loaders</p>
                                <p class="text-sm text-gray-400">Chargement progressif des images</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="skeleton" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Préchargement</p>
                                <p class="text-sm text-gray-400">Pages préchargées au survol</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="preload" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Animations au scroll</p>
                                <p class="text-sm text-gray-400">Apparition progressive des éléments</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="scrollAnimations" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-ada-red rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Section Fun -->
                <div class="bg-gradient-to-r from-purple-900/30 to-pink-900/30 rounded-xl p-6 border border-purple-500/30">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fa-solid fa-star mr-3 text-yellow-400"></i>
                        Fonctionnalités Fun
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Easter Egg (Konami Code)</p>
                                <p class="text-sm text-gray-400">↑↑↓↓←→←→BA</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="easterEgg" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-purple-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-500"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Confettis</p>
                                <p class="text-sm text-gray-400">Célébration après réservation</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="confetti" checked>
                                <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-purple-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-500"></div>
                            </label>
                        </div>
                        
                        <button onclick="window.launchConfetti()" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-3 rounded-lg transition-all transform hover:scale-105">
                            🎉 Tester les confettis
                        </button>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex gap-4">
                    <button id="saveConfig" class="flex-1 bg-ada-red hover:bg-red-700 text-white font-bold py-4 rounded-xl transition-all transform hover:scale-105 shadow-lg">
                        <i class="fa-solid fa-save mr-2"></i>
                        Sauvegarder
                    </button>
                    <button id="resetConfig" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-4 rounded-xl transition-all">
                        <i class="fa-solid fa-rotate-right mr-2"></i>
                        Réinitialiser
                    </button>
                </div>
                
                <!-- Info -->
                <div class="bg-blue-900/30 border border-blue-500/30 rounded-lg p-4 text-sm">
                    <p class="flex items-start">
                        <i class="fa-solid fa-info-circle mr-2 mt-0.5 text-blue-400"></i>
                        <span class="text-gray-300">Les paramètres sont sauvegardés localement dans votre navigateur. Ils persisteront entre les sessions.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Gestion du panel
        const openBtn = document.getElementById('openPanel');
        const closeBtn = document.getElementById('closePanel');
        const panel = document.getElementById('configPanel');
        
        openBtn.addEventListener('click', () => {
            panel.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        
        closeBtn.addEventListener('click', () => {
            panel.classList.add('hidden');
            document.body.style.overflow = '';
        });
        
        // Sauvegarde de la configuration
        document.getElementById('saveConfig').addEventListener('click', () => {
            const config = {};
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                config[checkbox.id] = checkbox.checked;
            });
            localStorage.setItem('adaUxConfig', JSON.stringify(config));
            
            // Notification
            const notif = document.createElement('div');
            notif.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            notif.innerHTML = '<i class="fa-solid fa-check mr-2"></i>Configuration sauvegardée !';
            document.body.appendChild(notif);
            setTimeout(() => notif.remove(), 2000);
        });
        
        // Réinitialisation
        document.getElementById('resetConfig').addEventListener('click', () => {
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = true;
            });
            localStorage.removeItem('adaUxConfig');
            
            const notif = document.createElement('div');
            notif.className = 'fixed top-4 right-4 bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            notif.innerHTML = '<i class="fa-solid fa-rotate-right mr-2"></i>Configuration réinitialisée !';
            document.body.appendChild(notif);
            setTimeout(() => notif.remove(), 2000);
        });
        
        // Charger la configuration au démarrage
        const savedConfig = localStorage.getItem('adaUxConfig');
        if (savedConfig) {
            const config = JSON.parse(savedConfig);
            Object.keys(config).forEach(key => {
                const checkbox = document.getElementById(key);
                if (checkbox) checkbox.checked = config[key];
            });
        }
    </script>
</body>
</html>