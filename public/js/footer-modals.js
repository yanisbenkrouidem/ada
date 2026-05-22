// footer-modals.js - À placer dans public/js/

document.addEventListener('DOMContentLoaded', function() {
    
    // Contenu des différentes sections
    const modalContents = {
        'ada-plus': {
            title: 'ADA+ Abonnement',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Découvrez notre offre d'abonnement flexible qui s'adapte à vos besoins de mobilité.</p>
                    <div class="bg-ada-red/10 border border-ada-red/30 rounded-lg p-4">
                        <h4 class="font-bold text-white mb-2">Avantages ADA+</h4>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li>✓ Tarifs préférentiels jusqu'à -30%</li>
                            <li>✓ Réservation prioritaire</li>
                            <li>✓ Annulation gratuite</li>
                            <li>✓ Assurance tous risques incluse</li>
                            <li>✓ Points de fidélité à chaque location</li>
                        </ul>
                    </div>
                    <p class="text-sm text-gray-400">À partir de 19,90€/mois sans engagement</p>
                </div>
            `
        },
        'location-utilitaire': {
            title: 'Location Utilitaire',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Louez un véhicule utilitaire adapté à vos besoins professionnels ou personnels.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-lg p-4">
                            <h4 class="font-bold text-white mb-2">Fourgons</h4>
                            <p class="text-sm text-gray-400">De 10 à 20m³</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <h4 class="font-bold text-white mb-2">Camions</h4>
                            <p class="text-sm text-gray-400">Jusqu'à 30m³</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <h4 class="font-bold text-white mb-2">Pick-up</h4>
                            <p class="text-sm text-gray-400">Tout terrain</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <h4 class="font-bold text-white mb-2">Frigorifiques</h4>
                            <p class="text-sm text-gray-400">Transport frais</p>
                        </div>
                    </div>
                </div>
            `
        },
        'nos-agences': {
            title: 'Nos Agences',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Plus de 350 agences ADA à votre service partout en France.</p>
                    <div class="bg-white/5 rounded-lg p-4">
                        <h4 class="font-bold text-white mb-3">Trouvez l'agence la plus proche</h4>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-300">
                                <i class="fa-solid fa-location-dot text-ada-red mr-3"></i>
                                <div>
                                    <p class="font-semibold">Paris Centre</p>
                                    <p class="text-sm text-gray-400">15 rue de la République, 75001 Paris</p>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-300">
                                <i class="fa-solid fa-location-dot text-ada-red mr-3"></i>
                                <div>
                                    <p class="font-semibold">Paris CDG Aéroport</p>
                                    <p class="text-sm text-gray-400">Terminal 2, 95700 Roissy</p>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-300">
                                <i class="fa-solid fa-location-dot text-ada-red mr-3"></i>
                                <div>
                                    <p class="font-semibold">Lyon Part-Dieu</p>
                                    <p class="text-sm text-gray-400">Gare Part-Dieu, 69003 Lyon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `
        },
        'vtc-chauffeur': {
            title: 'VTC / Chauffeur Privé',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Service de chauffeur privé pour tous vos déplacements professionnels et personnels.</p>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white/5 rounded-lg p-3 text-center">
                            <i class="fa-solid fa-briefcase text-2xl text-ada-red mb-2"></i>
                            <p class="text-sm font-semibold text-white">Business</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 text-center">
                            <i class="fa-solid fa-plane-departure text-2xl text-ada-red mb-2"></i>
                            <p class="text-sm font-semibold text-white">Aéroport</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 text-center">
                            <i class="fa-solid fa-champagne-glasses text-2xl text-ada-red mb-2"></i>
                            <p class="text-sm font-semibold text-white">Événements</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400">Disponible 24h/24, 7j/7</p>
                </div>
            `
        },
        'velo-electrique': {
            title: 'Vélo Électrique',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Location de vélos électriques pour une mobilité urbaine écologique et pratique.</p>
                    <div class="bg-gradient-to-r from-ada-red/20 to-ada-red/5 rounded-lg p-4 border border-ada-red/30">
                        <h4 class="font-bold text-white mb-2">🌱 Mode éco-responsable</h4>
                        <p class="text-sm text-gray-300">Réduisez votre empreinte carbone tout en profitant d'une mobilité flexible en ville.</p>
                    </div>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p>• Autonomie jusqu'à 80km</p>
                        <p>• Assistance électrique intelligente</p>
                        <p>• Casque et antivol inclus</p>
                        <p>• Tarif journée : 25€</p>
                    </div>
                </div>
            `
        },
        'compte-pro': {
            title: 'Créer un Compte Pro',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Gérez la mobilité de votre entreprise avec notre solution professionnelle.</p>
                    <div class="bg-white/5 rounded-lg p-4">
                        <h4 class="font-bold text-white mb-3">Avantages Entreprise</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p>✓ Facturation centralisée</p>
                            <p>✓ Tableau de bord dédié</p>
                            <p>✓ Tarifs négociés</p>
                            <p>✓ Gestionnaire de compte</p>
                            <p>✓ Reporting détaillé</p>
                        </div>
                    </div>
                    <button class="w-full bg-ada-red hover:bg-ada-red/90 text-white font-bold py-3 rounded-lg transition-colors">
                        S'inscrire gratuitement
                    </button>
                </div>
            `
        },
        'mobilite-affaires': {
            title: 'Mobilité Affaires',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Solutions de mobilité adaptées aux déplacements professionnels de vos collaborateurs.</p>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">Court terme</h5>
                            <p class="text-xs text-gray-400">Location à la journée</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">Moyen terme</h5>
                            <p class="text-xs text-gray-400">1 à 12 mois</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">Long terme</h5>
                            <p class="text-xs text-gray-400">LLD / LOA</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">Sur-mesure</h5>
                            <p class="text-xs text-gray-400">Solution adaptée</p>
                        </div>
                    </div>
                </div>
            `
        },
        'vehicules-fonction': {
            title: 'Véhicules de Fonction',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Flotte de véhicules de fonction pour vos collaborateurs avec une gestion simplifiée.</p>
                    <div class="bg-ada-red/10 border border-ada-red/30 rounded-lg p-4">
                        <h4 class="font-bold text-white mb-2">Formules All-Inclusive</h4>
                        <p class="text-sm text-gray-300">Entretien, assurance, assistance 24/7 inclus</p>
                    </div>
                    <div class="text-sm text-gray-300 space-y-1">
                        <p>• Large choix de véhicules</p>
                        <p>• Renouvellement régulier</p>
                        <p>• Gestion administrative simplifiée</p>
                        <p>• Flexibilité des contrats</p>
                    </div>
                </div>
            `
        },
        'gestion-flotte': {
            title: 'Gestion de Flotte',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Optimisez la gestion de votre parc automobile avec nos outils professionnels.</p>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-white/5 rounded-lg p-3">
                            <i class="fa-solid fa-chart-line text-ada-red text-xl mb-2"></i>
                            <p class="font-semibold text-white">Suivi en temps réel</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <i class="fa-solid fa-file-invoice text-ada-red text-xl mb-2"></i>
                            <p class="font-semibold text-white">Facturation centralisée</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <i class="fa-solid fa-calendar-check text-ada-red text-xl mb-2"></i>
                            <p class="font-semibold text-white">Planification</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <i class="fa-solid fa-wrench text-ada-red text-xl mb-2"></i>
                            <p class="font-semibold text-white">Maintenance</p>
                        </div>
                    </div>
                </div>
            `
        },
        'franchisé': {
            title: 'Devenir Franchisé ADA',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Rejoignez le réseau ADA et développez votre propre agence de location.</p>
                    <div class="bg-gradient-to-r from-ada-red/20 to-ada-red/5 rounded-lg p-4 border border-ada-red/30">
                        <h4 class="font-bold text-white mb-2">🚀 Opportunité Business</h4>
                        <p class="text-sm text-gray-300">Plus de 50 ans d'expertise dans la location automobile</p>
                    </div>
                    <div class="text-sm text-gray-300 space-y-2">
                        <p>✓ Formation complète</p>
                        <p>✓ Support marketing</p>
                        <p>✓ Système de réservation</p>
                        <p>✓ Notoriété de la marque</p>
                    </div>
                    <button class="w-full bg-ada-red hover:bg-ada-red/90 text-white font-bold py-3 rounded-lg transition-colors">
                        Recevoir la documentation
                    </button>
                </div>
            `
        },
        'centre-aide': {
            title: 'Centre d\'Aide',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Trouvez rapidement des réponses à vos questions.</p>
                    <div class="space-y-3">
                        <a href="#" class="block bg-white/5 hover:bg-white/10 rounded-lg p-3 transition-colors">
                            <h5 class="font-bold text-white text-sm mb-1">❓ FAQ - Questions fréquentes</h5>
                            <p class="text-xs text-gray-400">Consultez notre base de connaissances</p>
                        </a>
                        <a href="#" class="block bg-white/5 hover:bg-white/10 rounded-lg p-3 transition-colors">
                            <h5 class="font-bold text-white text-sm mb-1">📞 Service client : 01 XX XX XX XX</h5>
                            <p class="text-xs text-gray-400">Du lundi au vendredi, 9h-18h</p>
                        </a>
                        <a href="#" class="block bg-white/5 hover:bg-white/10 rounded-lg p-3 transition-colors">
                            <h5 class="font-bold text-white text-sm mb-1">💬 Chat en direct</h5>
                            <p class="text-xs text-gray-400">Réponse immédiate à vos questions</p>
                        </a>
                    </div>
                </div>
            `
        },
        'contact': {
            title: 'Contact',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Envoyez-nous un message, notre équipe vous répondra rapidement.</p>
                    <form class="space-y-3">
                        <input type="text" placeholder="Nom complet" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-ada-red">
                        <input type="email" placeholder="Email" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-ada-red">
                        <select class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-ada-red">
                            <option>Sujet de votre demande</option>
                            <option>Réservation</option>
                            <option>Réclamation</option>
                            <option>Information</option>
                            <option>Autre</option>
                        </select>
                        <textarea placeholder="Votre message" rows="4" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-ada-red resize-none"></textarea>
                        <button type="submit" class="w-full bg-ada-red hover:bg-ada-red/90 text-white font-bold py-3 rounded-lg transition-colors">
                            Envoyer le message
                        </button>
                    </form>
                </div>
            `
        },
        'groupe-ada': {
            title: 'Groupe ADA',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Leader français de la location de véhicules depuis 1967.</p>
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="bg-white/5 rounded-lg p-3">
                            <p class="text-2xl font-bold text-ada-red">350+</p>
                            <p class="text-xs text-gray-400">Agences</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <p class="text-2xl font-bold text-ada-red">15K+</p>
                            <p class="text-xs text-gray-400">Véhicules</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <p class="text-2xl font-bold text-ada-red">1M+</p>
                            <p class="text-xs text-gray-400">Clients</p>
                        </div>
                    </div>
                    <div class="bg-ada-red/10 border border-ada-red/30 rounded-lg p-4">
                        <h4 class="font-bold text-white mb-2">Notre Mission</h4>
                        <p class="text-sm text-gray-300">Offrir des solutions de mobilité accessibles, flexibles et durables pour tous.</p>
                    </div>
                </div>
            `
        },
        'recrutement': {
            title: 'Recrutement',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Rejoignez l'équipe ADA et participez à notre aventure !</p>
                    <div class="bg-gradient-to-r from-ada-red/20 to-ada-red/5 rounded-lg p-4 border border-ada-red/30">
                        <h4 class="font-bold text-white mb-2">🎯 Postes actuellement ouverts</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p>• Conseiller location (Paris, Lyon, Marseille)</p>
                            <p>• Mécanicien automobile (Toulouse)</p>
                            <p>• Responsable d'agence (Bordeaux)</p>
                            <p>• Développeur Full Stack (Paris)</p>
                        </div>
                    </div>
                    <button class="w-full bg-ada-red hover:bg-ada-red/90 text-white font-bold py-3 rounded-lg transition-colors">
                        Voir toutes les offres
                    </button>
                </div>
            `
        },
        'investisseurs': {
            title: 'Relations Investisseurs',
            content: `
                <div class="space-y-4">
                    <p class="text-gray-300">Informations financières et relations investisseurs du Groupe ADA.</p>
                    <div class="space-y-3">
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">📊 Résultats financiers</h5>
                            <p class="text-xs text-gray-400">Chiffre d'affaires : 245M€ (2024)</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">📈 Croissance</h5>
                            <p class="text-xs text-gray-400">+12% vs année précédente</p>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3">
                            <h5 class="font-bold text-white text-sm mb-1">📄 Documents</h5>
                            <p class="text-xs text-gray-400">Rapport annuel, communiqués de presse</p>
                        </div>
                    </div>
                </div>
            `
        }, // <--- C'EST ICI QU'IL MANQUAIT LA SUITE DANS TON FICHIER

        // --- PARTIE AJOUTÉE ---
        'infos-generales': {
            title: 'Informations Générales',
            content: `
                <div class="space-y-4 text-gray-300">
                    <p><strong>ADA Location</strong> est une société anonyme au capital de 15 000 000 €.</p>
                    <p>Siège social : 22-28 rue Henri Barbusse, 92110 Clichy.</p>
                    <p>Immatriculée au RCS de Nanterre sous le numéro B 315 284 658.</p>
                    <p>Directeur de la publication : Yanis Benkrouidem.</p>
                </div>
            `
        },
        'mentions-legales': {
            title: 'Mentions Légales',
            content: `
                <div class="space-y-4 text-gray-300 text-sm">
                    <h4 class="font-bold text-white">1. Hébergement</h4>
                    <p>Le site est hébergé par Vercel Inc. / ou Localhost (Projet éducatif).</p>
                    <h4 class="font-bold text-white">2. Propriété intellectuelle</h4>
                    <p>L'ensemble de ce site relève de la législation française et internationale sur le droit d'auteur.</p>
                    <h4 class="font-bold text-white">3. Responsabilité</h4>
                    <p>Ce site est un projet étudiant à but pédagogique.</p>
                </div>
            `
        },
        'donnees-personnelles': {
            title: 'Données Personnelles (RGPD)',
            content: `
                <div class="space-y-4 text-gray-300 text-sm">
                    <p>ADA s'engage à protéger la vie privée de ses utilisateurs.</p>
                    <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                        <ul class="list-disc pl-4 space-y-2">
                            <li>Données utilisées uniquement pour la gestion des locations.</li>
                            <li>Aucune revente à des tiers.</li>
                            <li>Droit d'accès et de suppression sur demande.</li>
                        </ul>
                    </div>
                </div>
            `
        },
        'cgl': {
            title: 'Conditions Générales de Location',
            content: `
                <div class="space-y-4 text-gray-300 text-sm">
                    <p><strong>Article 1 :</strong> Conducteur âgé d'au moins 21 ans et permis valide.</p>
                    <p><strong>Article 2 :</strong> Véhicule remis en bon état, à restituer idem.</p>
                    <p><strong>Article 3 :</strong> Durée déterminée au contrat.</p>
                    <p><strong>Article 4 :</strong> Assurance tous risques incluse avec franchise.</p>
                </div>
            `
        },
        'cookies': {
            title: 'Gestion des Cookies',
            content: `
                <div class="space-y-4 text-gray-300">
                    <p>Configuration de vos préférences cookies.</p>
                    <div class="space-y-3">
                        <div class="flex justify-between bg-white/5 p-3 rounded">
                            <span>Essentiels</span><span class="text-green-400 text-xs border border-green-400 px-2 rounded">Requis</span>
                        </div>
                        <div class="flex justify-between bg-white/5 p-3 rounded">
                            <span>Analytiques</span><i class="fa-solid fa-toggle-on text-ada-red"></i>
                        </div>
                    </div>
                    <button class="w-full bg-ada-red text-white font-bold py-2 rounded mt-2">Sauvegarder</button>
                </div>
            `
        }
    };

    // Fonction pour ouvrir un modal
    function openModal(contentKey) {
        const content = modalContents[contentKey];
        if (!content) {
            console.error('Contenu introuvable pour la clé :', contentKey);
            return;
        }

        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4 animate-fadeIn';
        modal.innerHTML = `
            <div class="bg-[#1a1a1a] rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-white/10 animate-slideUp">
                <div class="sticky top-0 bg-[#1a1a1a] border-b border-white/10 px-6 py-4 flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-white">${content.title}</h3>
                    <button class="modal-close w-10 h-10 rounded-full bg-white/10 hover:bg-ada-red flex items-center justify-center text-white transition-colors">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <div class="px-6 py-6">
                    ${content.content}
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';

        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.closest('.modal-close')) {
                modal.classList.add('animate-fadeOut');
                setTimeout(() => {
                    modal.remove();
                    document.body.style.overflow = '';
                }, 200);
            }
        });

        const escHandler = (e) => {
            if (e.key === 'Escape') {
                modal.remove();
                document.body.style.overflow = '';
                document.removeEventListener('keydown', escHandler);
            }
        };
        document.addEventListener('keydown', escHandler);
    }

    // Gestion des clics
    const modalLinks = document.querySelectorAll('footer a[data-modal]');
    modalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const contentKey = this.getAttribute('data-modal');
            if (contentKey) {
                openModal(contentKey);
            }
        });
    });
});

// CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fadeIn { animation: fadeIn 0.2s ease-out; }
    .animate-fadeOut { animation: fadeOut 0.2s ease-out; }
    .animate-slideUp { animation: slideUp 0.3s ease-out; }
`;
document.head.appendChild(style);