<footer class="bg-[#111111] text-white pt-20 pb-10 border-t border-gray-900 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-16">
            
            <div class="col-span-2 lg:col-span-1">
                <a href="<?php echo route('home'); ?>" class="inline-block mb-8">
                    <img src="<?php echo asset('images/ADAlogo1.png'); ?>" alt="ADA Location" class="h-8 brightness-0 invert opacity-90 hover:opacity-100 transition-opacity">
                </a>
                
                <div class="flex space-x-3 mb-6">
                    <a href="https://github.com/yanisbenkrouidem" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-ada-red hover:text-white text-gray-400 transition-all duration-300"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.instagram.com/yanisbnkr?igsh=d2ZwMGcwanpyZmRo&utm_source=qr" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-ada-red hover:text-white text-gray-400 transition-all duration-300"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://x.com/yanisbnkr?s=21" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-ada-red hover:text-white text-gray-400 transition-all duration-300"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/in/yanisbenkrouidem" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-ada-red hover:text-white text-gray-400 transition-all duration-300"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div>
                <h4 class="font-bold text-gray-500 uppercase text-xs mb-6 tracking-wider">Nos produits</h4>
                <ul class="space-y-3 text-sm font-bold text-white">
                    <li><a href="#" data-modal="ada-plus" class="hover:text-ada-red transition-colors block">ADA+ Abonnement</a></li>
                    <li><a href="<?php echo route('location.search.form'); ?>" class="hover:text-ada-red transition-colors block">Location de voiture</a></li>
                    <li><a href="#" data-modal="location-utilitaire" class="hover:text-ada-red transition-colors block">Location utilitaire</a></li>
                    <li><a href="#" data-modal="nos-agences" class="hover:text-ada-red transition-colors block">Nos agences</a></li>
                    <li><a href="#" data-modal="vtc-chauffeur" class="hover:text-ada-red transition-colors block">VTC / Chauffeur</a></li>
                    <li><a href="#" data-modal="velo-electrique" class="hover:text-ada-red transition-colors block">Vélo électrique</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-500 uppercase text-xs mb-6 tracking-wider">ADA Entreprises</h4>
                <ul class="space-y-3 text-sm font-bold text-white">
                    <li><a href="#" data-modal="compte-pro" class="hover:text-ada-red transition-colors block">Créer un compte Pro</a></li>
                    <li><a href="#" data-modal="mobilite-affaires" class="hover:text-ada-red transition-colors block">Mobilité affaires</a></li>
                    <li><a href="#" data-modal="vehicules-fonction" class="hover:text-ada-red transition-colors block">Véhicules de fonction</a></li>
                    <li><a href="#" data-modal="gestion-flotte" class="hover:text-ada-red transition-colors block">Gestion de flotte</a></li>
                    <li><a href="#" data-modal="franchisé" class="hover:text-ada-red transition-colors block">Devenir franchisé</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-500 uppercase text-xs mb-6 tracking-wider">Aide et autres</h4>
                <ul class="space-y-3 text-sm font-bold text-white">
                    <li><a href="#" data-modal="centre-aide" class="hover:text-ada-red transition-colors block">Centre d'aide</a></li>
                    <li><a href="#" data-modal="contact" class="hover:text-ada-red transition-colors block">Contact</a></li>
                    <li><a href="#" data-modal="groupe-ada" class="hover:text-ada-red transition-colors block">Groupe ADA</a></li>
                    <li><a href="#" data-modal="recrutement" class="hover:text-ada-red transition-colors block">Recrutement</a></li>
                    <li><a href="#" data-modal="investisseurs" class="hover:text-ada-red transition-colors block">Investisseurs</a></li>
                </ul>
            </div>
             
            <div>
                <h4 class="font-bold text-gray-500 uppercase text-xs mb-6 tracking-wider">Application ADA</h4>
                <div class="space-y-3"> 
                    <a href="#" id="app-store-link" class="bg-white/10 border border-white/10 rounded-lg px-3 py-2 flex items-center hover:bg-white/20 hover:border-white/30 transition-all group w-full max-w-[160px]"> 
                        <i class="fa-brands fa-apple text-2xl mr-3 text-white group-hover:scale-110 transition-transform"></i>
                        <div class="flex flex-col">
                            <div class="text-[9px] text-gray-400 uppercase leading-tight">Télécharger dans</div>
                            <div class="font-bold text-sm leading-tight text-white">l'App Store</div>
                        </div>
                    </a>
                    <a href="#" id="google-play-link" class="bg-white/10 border border-white/10 rounded-lg px-3 py-2 flex items-center hover:bg-white/20 hover:border-white/30 transition-all group w-full max-w-[160px]">
                        <i class="fa-brands fa-google-play text-2xl mr-3 text-white group-hover:scale-110 transition-transform"></i>
                        <div class="flex flex-col">
                            <div class="text-[9px] text-gray-400 uppercase leading-tight">Disponible sur</div>
                            <div class="font-bold text-sm leading-tight text-white">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-[11px] font-bold text-gray-500 uppercase tracking-wide">
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-4 md:mb-0">
                <a href="#" data-modal="contact" class="hover:text-white transition-colors">Aide & Contact</a>
                <a href="#" data-modal="infos-generales" class="hover:text-white transition-colors">Informations générales</a>
                <a href="#" data-modal="mentions-legales" class="hover:text-white transition-colors">Mentions légales</a>
                <a href="#" data-modal="donnees-personnelles" class="hover:text-white transition-colors">Données personnelles</a>
                <a href="#" data-modal="cgl" class="hover:text-white transition-colors">CGL</a>
                <a href="#" id="cookie-settings-link" class="hover:text-white transition-colors cursor-pointer">Cookies</a>
            </div>
            <div class="opacity-60">
                &copy; <?php echo date('Y'); ?> ADA Location. Tous droits réservés. Site à but éducatif réalisé par Yanis Benkrouidem et Nathan Heu.
            </div>
        </div>
    </div>
</footer>

<!-- POP-UP DE GESTION DES COOKIES -->
<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-[#1a1a1a] border-t border-white/10 shadow-2xl z-[9999] transform translate-y-full transition-transform duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fa-solid fa-cookie-bite text-ada-red text-2xl"></i>
                    <h3 class="text-xl font-bold text-white">Gestion des cookies</h3>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Nous utilisons des cookies pour améliorer votre expérience de navigation, analyser le trafic et personnaliser le contenu. 
                    Vous pouvez accepter tous les cookies ou personnaliser vos préférences.
                </p>
            </div>
            <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                <button id="cookie-accept-all" class="flex-1 lg:flex-none bg-ada-red hover:bg-ada-red/90 text-white font-bold px-6 py-3 rounded-lg transition-colors">
                    Tout accepter
                </button>
                <button id="cookie-reject" class="flex-1 lg:flex-none bg-white/10 hover:bg-white/20 text-white font-bold px-6 py-3 rounded-lg transition-colors border border-white/10">
                    Tout refuser
                </button>
                <button id="cookie-customize" class="flex-1 lg:flex-none bg-white/10 hover:bg-white/20 text-white font-bold px-6 py-3 rounded-lg transition-colors border border-white/10">
                    Personnaliser
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE PERSONNALISATION DES COOKIES -->
<div id="cookie-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[10000] p-4">
    <div class="bg-[#1a1a1a] rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-white/10">
        <div class="sticky top-0 bg-[#1a1a1a] border-b border-white/10 px-6 py-4 flex items-center justify-between z-10">
            <h3 class="text-2xl font-bold text-white">Préférences des cookies</h3>
            <button id="cookie-modal-close" class="w-10 h-10 rounded-full bg-white/10 hover:bg-ada-red flex items-center justify-center text-white transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <div class="px-6 py-6 space-y-6">
            <p class="text-gray-300 text-sm">
                Choisissez les types de cookies que vous souhaitez autoriser. Ces préférences s'appliqueront uniquement à ce navigateur et cet appareil.
            </p>

            <!-- Cookies essentiels -->
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-shield-halved text-ada-red text-xl"></i>
                        <h4 class="font-bold text-white">Cookies essentiels</h4>
                    </div>
                    <span class="text-xs bg-green-500/20 text-green-400 px-3 py-1 rounded-full border border-green-500/30">Toujours actifs</span>
                </div>
                <p class="text-sm text-gray-400">
                    Nécessaires au bon fonctionnement du site (connexion, panier, sécurité). Ces cookies ne peuvent pas être désactivés.
                </p>
            </div>

            <!-- Cookies fonctionnels -->
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-sliders text-ada-red text-xl"></i>
                        <h4 class="font-bold text-white">Cookies fonctionnels</h4>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="cookie-functional" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-white/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                    </label>
                </div>
                <p class="text-sm text-gray-400">
                    Mémorisation des préférences (langue, devise, filtres de recherche) pour améliorer votre expérience.
                </p>
            </div>

            <!-- Cookies analytiques -->
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chart-line text-ada-red text-xl"></i>
                        <h4 class="font-bold text-white">Cookies analytiques</h4>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="cookie-analytics" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-white/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                    </label>
                </div>
                <p class="text-sm text-gray-400">
                    Analyse du trafic et du comportement des utilisateurs pour améliorer nos services (Google Analytics, Hotjar).
                </p>
            </div>

            <!-- Cookies marketing -->
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bullhorn text-ada-red text-xl"></i>
                        <h4 class="font-bold text-white">Cookies marketing</h4>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="cookie-marketing" class="sr-only peer">
                        <div class="w-11 h-6 bg-white/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ada-red"></div>
                    </label>
                </div>
                <p class="text-sm text-gray-400">
                    Publicités personnalisées basées sur vos centres d'intérêt (Facebook Pixel, Google Ads).
                </p>
            </div>

            <div class="flex gap-3 pt-4 border-t border-white/10">
                <button id="cookie-save-preferences" class="flex-1 bg-ada-red hover:bg-ada-red/90 text-white font-bold py-3 rounded-lg transition-colors">
                    Enregistrer les préférences
                </button>
                <button id="cookie-accept-all-modal" class="flex-1 bg-white/10 hover:bg-white/20 text-white font-bold py-3 rounded-lg transition-colors border border-white/10">
                    Tout accepter
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. GESTION DES APP STORES ---
    const appStoreLink = document.getElementById('app-store-link');
    const googlePlayLink = document.getElementById('google-play-link');
    
    if (appStoreLink) {
        appStoreLink.addEventListener('click', function(e) {
            e.preventDefault();
            createSimpleModal('Application iOS', `
                <div class="space-y-4">
                    <div class="bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
                        <i class="fa-brands fa-apple text-4xl text-white mb-3"></i>
                        <h4 class="font-bold text-white mb-2">Application ADA pour iOS</h4>
                        <p class="text-sm text-gray-300">Bientôt disponible sur l'App Store.</p>
                    </div>
                </div>`);
        });
    }
    
    if (googlePlayLink) {
        googlePlayLink.addEventListener('click', function(e) {
            e.preventDefault();
            createSimpleModal('Application Android', `
                <div class="space-y-4">
                    <div class="bg-green-500/10 border border-green-500/30 rounded-lg p-4">
                        <i class="fa-brands fa-google-play text-4xl text-white mb-3"></i>
                        <h4 class="font-bold text-white mb-2">Application ADA pour Android</h4>
                        <p class="text-sm text-gray-300">Bientôt disponible sur Google Play.</p>
                    </div>
                </div>`);
        });
    }

    function createSimpleModal(title, content) {
        const modalContent = { title: title, content: content };
        openModalFromData(modalContent);
    }

    // --- 2. DONNÉES DES MODALS DU FOOTER ---
    const modalContents = {
        'ada-plus': {
            title: 'ADA+ Abonnement',
            content: `<div class="space-y-4"><p class="text-gray-300">Découvrez notre offre d'abonnement flexible.</p><ul class="list-disc pl-5 text-gray-400"><li>Tarifs préférentiels</li><li>Annulation gratuite</li></ul></div>`
        },
        'location-utilitaire': {
            title: 'Location Utilitaire',
            content: `<div class="space-y-4"><p class="text-gray-300">Louez un véhicule utilitaire adapté.</p><p class="text-gray-400">Fourgons de 10 à 20m³ disponibles.</p></div>`
        },
        'nos-agences': {
            title: 'Nos Agences',
            content: `<div class="space-y-4"><p class="text-gray-300">Plus de 350 agences ADA à votre service.</p></div>`
        },
        'vtc-chauffeur': {
            title: 'VTC / Chauffeur',
            content: `<div class="space-y-4"><p class="text-gray-300">Service de chauffeur privé pour tous vos déplacements.</p></div>`
        },
        'velo-electrique': {
            title: 'Vélo Électrique',
            content: `<div class="space-y-4"><p class="text-gray-300">Mobilité urbaine écologique à partir de 25€/jour.</p></div>`
        },
        'compte-pro': {
            title: 'Compte Pro',
            content: `<div class="space-y-4"><p class="text-gray-300">Solution pour gérer la mobilité de votre entreprise.</p></div>`
        },
        'mobilite-affaires': {
            title: 'Mobilité Affaires',
            content: `<div class="space-y-4"><p class="text-gray-300">Solutions court, moyen et long terme pour les pros.</p></div>`
        },
        'vehicules-fonction': {
            title: 'Véhicules de Fonction',
            content: `<div class="space-y-4"><p class="text-gray-300">Flotte de véhicules avec gestion simplifiée.</p></div>`
        },
        'gestion-flotte': {
            title: 'Gestion de Flotte',
            content: `<div class="space-y-4"><p class="text-gray-300">Outils de suivi et de maintenance pour votre parc.</p></div>`
        },
        'franchisé': {
            title: 'Devenir Franchisé',
            content: `<div class="space-y-4"><p class="text-gray-300">Rejoignez le réseau ADA et ouvrez votre agence.</p></div>`
        },
        'centre-aide': {
            title: 'Centre d\'Aide',
            content: `<div class="space-y-4"><p class="text-gray-300">FAQ et service client disponible 7j/7.</p></div>`
        },
        'contact': {
            title: 'Contact',
            content: `<div class="space-y-4"><p class="text-gray-300">Envoyez-nous un message via le formulaire.</p></div>`
        },
        'groupe-ada': {
            title: 'Groupe ADA',
            content: `<div class="space-y-4"><p class="text-gray-300">Leader de la location de proximité depuis 1967.</p></div>`
        },
        'recrutement': {
            title: 'Recrutement',
            content: `<div class="space-y-4"><p class="text-gray-300">Consultez nos offres d'emploi actuelles.</p></div>`
        },
        'investisseurs': {
            title: 'Investisseurs',
            content: `<div class="space-y-4"><p class="text-gray-300">Informations financières et rapports annuels.</p></div>`
        },
        'infos-generales': {
            title: 'Informations Générales',
            content: `<div class="space-y-4 text-gray-300"><p>ADA Location SA au capital de 15M€.</p><p>Siège : Chez Yanis et Nathan (71).</p></div>`
        },
        'mentions-legales': {
            title: 'Mentions Légales',
            content: `<div class="space-y-4 text-gray-300"><p>Site hébergé par Infinity Free.</p><p>Projet éducatif.</p></div>`
        },
        'donnees-personnelles': {
            title: 'Données Personnelles',
            content: `<div class="space-y-4 text-gray-300"><p>Conformité RGPD garantie.</p></div>`
        },
        'cgl': {
            title: 'CGL',
            content: `<div class="space-y-4 text-gray-300"><p>Conditions Générales de Location applicables en agence.</p></div>`
        }
    };

    // --- 3. GESTION DES CLICS DU FOOTER ---
    const modalLinks = document.querySelectorAll('footer a[data-modal]');
    
    modalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); 
            const contentKey = this.getAttribute('data-modal');
            const data = modalContents[contentKey];
            if (data) {
                openModalFromData(data);
            }
        });
    });

    // --- 4. FONCTION D'OUVERTURE DU MODAL ---
    function openModalFromData(data) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[9999] p-4 animate-fadeIn';
        modal.innerHTML = `
            <div class="bg-[#1a1a1a] rounded-2xl max-w-xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-white/10 animate-slideUp">
                <div class="sticky top-0 bg-[#1a1a1a] border-b border-white/10 px-6 py-4 flex items-center justify-between z-10">
                    <h3 class="text-xl font-bold text-white">${data.title}</h3>
                    <button class="modal-close w-8 h-8 rounded-full bg-white/10 hover:bg-ada-red flex items-center justify-center text-white transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="px-6 py-6">
                    ${data.content}
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';

        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.closest('.modal-close')) {
                closeModal(modal);
            }
        });

        const escHandler = (e) => {
            if (e.key === 'Escape') closeModal(modal, escHandler);
        };
        document.addEventListener('keydown', escHandler);
    }

    function closeModal(modal, escHandler) {
        modal.classList.add('animate-fadeOut');
        modal.addEventListener('animationend', () => {
            modal.remove();
            document.body.style.overflow = '';
            if (escHandler) document.removeEventListener('keydown', escHandler);
        });
    }

    // Styles CSS pour les animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.2s ease-out forwards; }
        .animate-fadeOut { animation: fadeOut 0.2s ease-out forwards; }
        .animate-slideUp { animation: slideUp 0.3s ease-out forwards; }
    `;
    document.head.appendChild(style);
});
</script> 