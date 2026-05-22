<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        // Données riches pour chaque page (Style Qatar Airways)
        $pages = [
            // --- DÉCOUVRIR ---
            'utilitaires' => [
                'title' => 'Véhicules Utilitaires',
                'subtitle' => 'Transport & Déménagement',
                'intro' => 'Que vous déménagiez un studio ou une maison entière, notre flotte d\'utilitaires s\'adapte à vos besoins avec des volumes allant du 3m³ au 22m³ avec hayon.',
                'icon' => 'fa-truck-moving',
                'features' => [
                    ['icon' => 'fa-box', 'title' => 'Volumes Modulables', 'desc' => 'Du Kangoo au Master Grand Volume.'],
                    ['icon' => 'fa-id-card', 'title' => 'Permis B Suffisant', 'desc' => 'Tous nos véhicules se conduisent sans permis poids lourd.'],
                    ['icon' => 'fa-dolly', 'title' => 'Kit Déménagement', 'desc' => 'Diables et cartons disponibles en agence.'],
                ]
            ],
            'abonnement' => [
                'title' => 'Abonnement Flexible',
                'subtitle' => 'La liberté sans les contraintes',
                'intro' => 'Oubliez l\'achat, l\'assurance et l\'entretien. Avec l\'abonnement ADA, vous profitez d\'un véhicule récent au mois, sans engagement de durée.',
                'icon' => 'fa-calendar-check',
                'features' => [
                    ['icon' => 'fa-file-signature', 'title' => 'Sans Engagement', 'desc' => 'Arrêtez quand vous voulez après le 1er mois.'],
                    ['icon' => 'fa-shield-heart', 'title' => 'Tout Inclus', 'desc' => 'Assurance, assistance et entretien compris.'],
                    ['icon' => 'fa-car-side', 'title' => 'Véhicules Récents', 'desc' => 'Roulez toujours dans les derniers modèles.'],
                ]
            ],
            'offres' => [
                'title' => 'Offres & Privilèges',
                'subtitle' => 'Voyagez malin',
                'intro' => 'Profitez de nos codes promotionnels exclusifs et de nos offres de dernière minute pour économiser sur vos locations en France et à l\'étranger.',
                'icon' => 'fa-tags',
                'features' => [
                    ['icon' => 'fa-percent', 'title' => 'Promo Web', 'desc' => '-10% garantis sur toute réservation en ligne.'],
                    ['icon' => 'fa-graduation-cap', 'title' => 'Offre Étudiant', 'desc' => 'Tarifs réduits pour les moins de 25 ans.'],
                    ['icon' => 'fa-plane-departure', 'title' => 'Aller-Simple', 'desc' => 'Louez ici, laissez ailleurs à prix réduit.'],
                ]
            ],
            'blog' => [
                'title' => 'Le Mag ADA',
                'subtitle' => 'Inspiration & Conseils',
                'intro' => 'Retrouvez nos itinéraires de roadtrip, nos conseils de sécurité routière et toute l\'actualité de la mobilité automobile.',
                'icon' => 'fa-newspaper',
                'features' => [
                    ['icon' => 'fa-map-location-dot', 'title' => 'Itinéraires', 'desc' => 'Les plus belles routes de France.'],
                    ['icon' => 'fa-wrench', 'title' => 'Conseils Méca', 'desc' => 'Entretenir et vérifier son véhicule.'],
                    ['icon' => 'fa-leaf', 'title' => 'Éco-conduite', 'desc' => 'Réduire sa consommation au quotidien.'],
                ]
            ],

            // --- PRO ---
            'espace-pro' => [
                'title' => 'Espace Entreprise',
                'subtitle' => 'Solutions Business',
                'intro' => 'Connectez-vous à votre portail dédié pour gérer vos réservations, vos factures et vos conducteurs en toute simplicité.',
                'icon' => 'fa-briefcase',
                'features' => [
                    ['icon' => 'fa-file-invoice', 'title' => 'Facturation Centralisée', 'desc' => 'Une seule facture mensuelle détaillée.'],
                    ['icon' => 'fa-users', 'title' => 'Multi-conducteurs', 'desc' => 'Ajoutez vos collaborateurs en un clic.'],
                    ['icon' => 'fa-headset', 'title' => 'Support Dédié', 'desc' => 'Une ligne prioritaire pour les pros.'],
                ]
            ],
            'gestion-flotte' => [
                'title' => 'Gestion de Flotte',
                'subtitle' => 'Optimisation des coûts',
                'intro' => 'Externalisez la gestion de votre parc automobile. ADA s\'occupe de tout : maintenance, rotation, assurance. Concentrez-vous sur votre business.',
                'icon' => 'fa-chart-line',
                'features' => [
                    ['icon' => 'fa-coins', 'title' => 'TCO Maîtrisé', 'desc' => 'Réduisez vos coûts globaux de mobilité.'],
                    ['icon' => 'fa-screwdriver-wrench', 'title' => 'Maintenance Incluse', 'desc' => 'Plus de frais imprévus au garage.'],
                    ['icon' => 'fa-network-wired', 'title' => 'Maillage National', 'desc' => '1000 agences à votre service.'],
                ]
            ],
            'franchise' => [
                'title' => 'Devenir Franchisé',
                'subtitle' => 'Entreprenez avec le N°1',
                'intro' => 'Rejoignez le réseau leader de la location de proximité. Bénéficiez de la force d\'une marque reconnue et d\'un accompagnement sur-mesure.',
                'icon' => 'fa-handshake',
                'features' => [
                    ['icon' => 'fa-bullhorn', 'title' => 'Marque Forte', 'desc' => 'Une notoriété nationale immédiate.'],
                    ['icon' => 'fa-graduation-cap', 'title' => 'Formation', 'desc' => '6 semaines de formation initiale.'],
                    ['icon' => 'fa-chart-pie', 'title' => 'Rentabilité', 'desc' => 'Un modèle économique éprouvé.'],
                ]
            ],
            'publicite' => [
                'title' => 'Régie Publicitaire',
                'subtitle' => 'Communiquez avec nous',
                'intro' => 'Associez votre image à celle d\'ADA. Nos véhicules et nos agences offrent une visibilité unique au cœur des villes.',
                'icon' => 'fa-bullseye',
                'features' => [
                    ['icon' => 'fa-car', 'title' => 'Covering', 'desc' => 'Habillage publicitaire sur nos véhicules.'],
                    ['icon' => 'fa-desktop', 'title' => 'Digital', 'desc' => 'Visibilité sur notre site et application.'],
                    ['icon' => 'fa-store', 'title' => 'In-Store', 'desc' => 'Affichage dans nos 1000 agences.'],
                ]
            ],

            // --- AIDE ---
            'centre-aide' => [
                'title' => 'Centre d\'Aide',
                'subtitle' => 'Support Client',
                'intro' => 'Une question sur votre réservation ? Un problème technique ? Notre équipe est là pour vous accompagner à chaque étape.',
                'icon' => 'fa-life-ring',
                'features' => [
                    ['icon' => 'fa-book', 'title' => 'Documentation', 'desc' => 'Guides d\'utilisation des véhicules.'],
                    ['icon' => 'fa-envelope', 'title' => 'Email', 'desc' => 'Réponse garantie sous 24h ouvrées.'],
                    ['icon' => 'fa-phone', 'title' => 'Téléphone', 'desc' => 'Disponible du lundi au samedi.'],
                ]
            ],
            'faq' => [
                'title' => 'Foire Aux Questions',
                'subtitle' => 'Réponses rapides',
                'intro' => 'Retrouvez ici les réponses aux questions les plus fréquentes concernant la caution, l\'assurance, le kilométrage et l\'annulation.',
                'icon' => 'fa-circle-question',
                'features' => [
                    ['icon' => 'fa-credit-card', 'title' => 'Caution', 'desc' => 'Montants et modalités de blocage.'],
                    ['icon' => 'fa-gas-pump', 'title' => 'Carburant', 'desc' => 'Politique plein-plein expliquée.'],
                    ['icon' => 'fa-road', 'title' => 'Kilométrage', 'desc' => 'Fonctionnement des forfaits km.'],
                ]
            ],
            'assistance' => [
                'title' => 'Assistance 24/7',
                'subtitle' => 'En cas d\'urgence',
                'intro' => 'En cas de panne, d\'accident ou de vol, notre assistance intervient partout en Europe, 24h/24 et 7j/7.',
                'icon' => 'fa-truck-medical',
                'features' => [
                    ['icon' => 'fa-phone-volume', 'title' => 'Numéro Vert', 'desc' => '0 800 123 456 (Appel gratuit).'],
                    ['icon' => 'fa-hotel', 'title' => 'Hébergement', 'desc' => 'Prise en charge hôtel si immobilisation.'],
                    ['icon' => 'fa-taxi', 'title' => 'Rapatriement', 'desc' => 'Taxi ou train pour rentrer chez vous.'],
                ]
            ],
            'contact' => [
                'title' => 'Contactez-nous',
                'subtitle' => 'Nous sommes à l\'écoute',
                'intro' => 'Vous souhaitez nous faire part d\'une suggestion ou d\'une réclamation ? Utilisez le formulaire ci-dessous pour contacter le siège.',
                'icon' => 'fa-paper-plane',
                'features' => [
                    ['icon' => 'fa-building', 'title' => 'Siège Social', 'desc' => '22 Rue des Archives, 75004 Paris.'],
                    ['icon' => 'fa-at', 'title' => 'Service Client', 'desc' => 'service.client@ada.fr'],
                    ['icon' => 'fa-briefcase', 'title' => 'Recrutement', 'desc' => 'Rejoignez nos équipes.'],
                ]
            ],

            // --- LEGAL ---
            'confidentialite' => [
                'title' => 'Politique de Confidentialité',
                'subtitle' => 'Données Personnelles',
                'intro' => 'Conformément au RGPD, nous nous engageons à protéger vos données. Nous ne vendons aucune information personnelle à des tiers.',
                'icon' => 'fa-user-shield',
                'features' => [
                    ['icon' => 'fa-database', 'title' => 'Stockage', 'desc' => 'Données hébergées en France (UE).'],
                    ['icon' => 'fa-eraser', 'title' => 'Droit à l\'oubli', 'desc' => 'Suppression sur simple demande.'],
                    ['icon' => 'fa-cookie', 'title' => 'Cookies', 'desc' => 'Gestion transparente des traceurs.'],
                ]
            ],
            'mentions-legales' => [
                'title' => 'Mentions Légales',
                'subtitle' => 'Informations Société',
                'intro' => 'Le site ADA Location est édité par la société ADA S.A., au capital de 15 000 000 Euros, immatriculée au RCS de Paris.',
                'icon' => 'fa-scale-balanced',
                'features' => [
                    ['icon' => 'fa-copyright', 'title' => 'Propriété', 'desc' => 'Tous droits réservés ADA 2025.'],
                    ['icon' => 'fa-server', 'title' => 'Hébergeur', 'desc' => 'Infomaniak Network SA.'],
                    ['icon' => 'fa-user-tie', 'title' => 'Directeur', 'desc' => 'Directeur de la publication : M. Dupont.'],
                ]
            ],
            'cgv' => [
                'title' => 'Conditions Générales',
                'subtitle' => 'Contrat de location',
                'intro' => 'Les présentes conditions régissent toutes les locations de véhicules effectuées dans le réseau ADA. Elles définissent les responsabilités de chacun.',
                'icon' => 'fa-file-contract',
                'features' => [
                    ['icon' => 'fa-id-card', 'title' => 'Conducteur', 'desc' => 'Conditions d\'âge et de permis.'],
                    ['icon' => 'fa-car-burst', 'title' => 'Assurances', 'desc' => 'Détails des couvertures et franchises.'],
                    ['icon' => 'fa-money-bill', 'title' => 'Paiement', 'desc' => 'Moyens de paiement acceptés.'],
                ]
            ],
            'application-mobile' => [
                'title' => 'Application Mobile',
                'subtitle' => 'ADA dans votre poche',
                'intro' => 'Téléchargez l\'app pour réserver en 3 clics, faire votre état des lieux numérique et utiliser votre téléphone comme clé de voiture.',
                'icon' => 'fa-mobile-screen',
                'features' => [
                    ['icon' => 'fa-bolt', 'title' => 'Rapide', 'desc' => 'Réservez 24h/24 en quelques secondes.'],
                    ['icon' => 'fa-key', 'title' => 'Clé Digitale', 'desc' => 'Ouvrez la voiture en Bluetooth.'],
                    ['icon' => 'fa-camera', 'title' => 'État des lieux', 'desc' => 'Photos certifiées par l\'application.'],
                ]
            ],
        ];

        if (!array_key_exists($slug, $pages)) {
            abort(404);
        }

        return view('pages.generic', [
            'page' => $pages[$slug],
            'slug' => $slug
        ]);
    }
}