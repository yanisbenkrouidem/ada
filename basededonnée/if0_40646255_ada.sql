-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql212.infinityfree.com
-- Généré le :  mar. 24 mars 2026 à 18:57
-- Version du serveur :  11.4.10-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_40646255_ada`
--

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

CREATE TABLE `agences` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `telephone` varchar(14) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `motpasse` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id`, `nom`, `adresse`, `cp`, `ville`, `telephone`, `email`, `motpasse`) VALUES
(1, 'ADA Mâcon', '4 Quai Jean Jaurès', '71000', 'Mâcon', '0385204000', 'macon@ada.fr', 'gt=oaG87z%32'),
(2, 'ADA Chalon', '385 Boulevard Victor Hugo', '71100', 'Chalon sur Saône', '0385980720', 'chalon@ada.fr', 'HK89/sebf+t');

-- --------------------------------------------------------

--
-- Structure de la table `agence_jour`
--

CREATE TABLE `agence_jour` (
  `agence_id` int(11) NOT NULL,
  `jour_id` int(11) NOT NULL,
  `heuredebut` time DEFAULT NULL,
  `heurefin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `agence_jour`
--

INSERT INTO `agence_jour` (`agence_id`, `jour_id`, `heuredebut`, `heurefin`) VALUES
(1, 1, '08:00:00', '19:00:00'),
(1, 2, '08:00:00', '19:00:00'),
(1, 3, '08:30:00', '19:30:00'),
(1, 4, '08:00:00', '19:00:00'),
(1, 5, '08:00:00', '19:00:00'),
(1, 6, '08:30:00', '18:00:00'),
(1, 7, '00:00:00', '00:00:00'),
(2, 1, '07:00:00', '19:00:00'),
(2, 2, '09:00:00', '19:00:00'),
(2, 3, '09:00:00', '19:00:00'),
(2, 4, '09:00:00', '19:00:00'),
(2, 5, '08:00:00', '19:30:00'),
(2, 6, '08:00:00', '20:00:00'),
(2, 7, '08:30:00', '12:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `attributs`
--

CREATE TABLE `attributs` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `attributs`
--

INSERT INTO `attributs` (`id`, `libelle`, `logo`) VALUES
(10, 'Bagages', 'bagages.png'),
(12, 'Chargement', 'chargement.png'),
(13, 'Dimensions', 'dimensions.png'),
(14, 'Energie', 'energie.png'),
(16, 'Personnes', 'personnes.png'),
(17, 'Places', 'places.png'),
(18, 'Portes', 'portes.png'),
(20, 'Sacs', 'sacs.png'),
(21, 'Age', 'age.png'),
(23, 'Permis', 'permis.png');

-- --------------------------------------------------------

--
-- Structure de la table `attribut_categorie`
--

CREATE TABLE `attribut_categorie` (
  `categorie_id` int(11) NOT NULL,
  `attribut_id` int(11) NOT NULL,
  `valeur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `attribut_categorie`
--

INSERT INTO `attribut_categorie` (`categorie_id`, `attribut_id`, `valeur`) VALUES
(101, 10, '1 bagage'),
(101, 14, 'Electrique ou Essence'),
(101, 17, '4 places'),
(101, 18, '3 portes'),
(101, 20, '1 sac'),
(101, 21, '+21 ans'),
(101, 23, 'permis 1 an'),
(102, 14, 'Essence'),
(102, 17, '4 places'),
(102, 18, '3 portes'),
(102, 20, '2 sacs'),
(102, 21, '+18 ans'),
(102, 23, 'permis 0 an'),
(103, 10, '1 bagage'),
(103, 14, 'Electrique ou Essence'),
(103, 17, '4 ou 5 places'),
(103, 18, '3 ou 5 portes'),
(103, 20, '2 sacs'),
(103, 21, '+18 ans'),
(103, 23, 'permis 0 an'),
(104, 10, '1 bagage'),
(104, 14, 'Electrique ou Essence'),
(104, 17, '5 places'),
(104, 18, '3 ou 5 portes'),
(104, 20, '2 sacs'),
(104, 21, '+18 ans'),
(104, 23, 'permis 0 an'),
(105, 14, 'Electrique ou Essence'),
(105, 17, '2 places'),
(105, 18, '3 portes'),
(105, 20, '2 sacs'),
(105, 21, '+18 ans'),
(105, 23, 'permis 0 an'),
(106, 10, '2 bagages'),
(106, 14, 'Electrique ou Essence'),
(106, 17, '4 places'),
(106, 18, '3 ou 5 portes'),
(106, 20, '1 sac'),
(106, 21, '+18 ans'),
(106, 23, 'permis 1 an'),
(107, 10, '2 bagages'),
(107, 14, 'Electrique ou Essence'),
(107, 17, '5 places'),
(107, 18, '5 portes'),
(107, 20, '1 sac'),
(107, 21, '+18 ans'),
(107, 23, 'permis 0 an'),
(108, 10, '2 bagages'),
(108, 14, 'Electrique ou Essence'),
(108, 17, '5 places'),
(108, 18, '5 portes'),
(108, 20, '1 sac'),
(108, 21, '+18 ans'),
(108, 23, 'permis 0 an'),
(109, 10, '2 bagages'),
(109, 14, 'Essence'),
(109, 17, '5 places'),
(109, 18, '5 portes'),
(109, 20, '2 sacs'),
(109, 21, '+18 ans'),
(109, 23, 'permis 1 an'),
(110, 10, '3 bagages'),
(110, 14, 'Essence'),
(110, 17, '5 places'),
(110, 18, '5 portes'),
(110, 20, '1 sac'),
(110, 21, '+23 ans'),
(110, 23, 'permis 5 ans'),
(111, 10, '2 bagages'),
(111, 14, 'Essence'),
(111, 17, '5 places'),
(111, 18, '5 portes'),
(111, 20, '2 sacs'),
(111, 21, '+18 ans'),
(111, 23, 'permis 1 an'),
(112, 10, '3 bagages'),
(112, 14, 'Essence'),
(112, 17, '5 places'),
(112, 18, '5 portes'),
(112, 20, '2 sacs'),
(112, 21, '+18 ans'),
(112, 23, 'permis 1 an'),
(113, 10, '3 bagages'),
(113, 14, 'Essence'),
(113, 17, '7 places'),
(113, 18, '5 portes'),
(113, 20, '2 sacs'),
(113, 21, '+18 ans'),
(113, 23, 'permis 1 an'),
(114, 10, '3 bagages'),
(114, 14, 'Essence'),
(114, 17, '7 places'),
(114, 18, '5 portes'),
(114, 20, '2 sacs'),
(114, 21, '+18 ans'),
(114, 23, 'permis 1 an'),
(115, 10, '2 bagages'),
(115, 14, 'Essence'),
(115, 17, '9 places'),
(115, 18, '5 portes'),
(115, 20, '2 sacs'),
(115, 21, '+23 ans'),
(115, 23, 'permis 5 ans'),
(117, 12, '625 Kg'),
(117, 13, 'Int. utiles : L 1.45m x l 1.35m x H 1.25m'),
(117, 14, 'Essence'),
(117, 16, '2'),
(117, 21, '+18 ans'),
(117, 23, 'permis 0 an'),
(118, 12, '815 Kg'),
(118, 13, 'Int. utiles : L 1.85m x l 1.55m x H 1.41m'),
(118, 14, 'Essence'),
(118, 16, '2 ou 3'),
(118, 21, '+18 ans'),
(118, 23, 'permis 0 an'),
(119, 12, '1000 Kg'),
(119, 13, 'Int. utiles : L 2.5m x l 1.6m x H 1.5m'),
(119, 14, 'Essence'),
(119, 16, '2 ou 3'),
(119, 21, '+18 ans'),
(119, 23, 'permis 0 an'),
(120, 12, '1100'),
(120, 13, 'Int. utiles : L 2.7m x l 1.7m x H 1.7m'),
(120, 14, 'Essence'),
(120, 16, '3'),
(120, 21, '+18 ans'),
(120, 23, 'permis 0 an'),
(121, 12, '1300'),
(121, 13, 'Int. utiles : L 3m x l 1.8m x H 1.82m'),
(121, 14, 'Essence'),
(121, 16, '3'),
(121, 21, '+18 ans'),
(121, 23, 'permis 1 an'),
(122, 12, '1200'),
(122, 13, 'Int. utiles : L 4.3m x l 1.4m x H 1.9m'),
(122, 14, 'Essence'),
(122, 16, '2 ou 3'),
(122, 21, '+18 ans'),
(122, 23, 'permis 1 an'),
(123, 12, '850'),
(123, 13, 'Int. utiles : L 4.2m x l 2.04m x H 2.28m'),
(123, 14, 'Essence'),
(123, 16, '3'),
(123, 21, '+23 ans'),
(123, 23, 'permis 5 ans'),
(124, 12, '650'),
(124, 13, 'Int. utiles : L 4.2m x l 2.04m x H 2.28m'),
(124, 14, 'Essence'),
(124, 16, '3'),
(124, 21, '+23 ans'),
(124, 23, 'permis 5 ans'),
(125, 12, '1100'),
(125, 14, 'Essence'),
(125, 16, '3'),
(125, 21, '+23 ans'),
(125, 23, 'permis 5 ans');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `complement` varchar(50) DEFAULT NULL,
  `exemple` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tarifjournee` float DEFAULT NULL,
  `tarifkm` float DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `complement`, `exemple`, `description`, `tarifjournee`, `tarifkm`, `photo`, `genre_id`) VALUES
(101, 'ADA Premier Prix', NULL, 'Ford Ka ou similaire', NULL, 29, 0.2, '0-sml.png', 15),
(102, 'Super Eco', NULL, 'Renault Twingo ou similaire', NULL, 37, 0.25, '1A-sml.png', 15),
(103, 'Petite 	Confort', NULL, 'Ford Fiesta ou similaire', NULL, 45, 0.3, '2A-sml.png', 15),
(104, 'Petite Premium', NULL, 'Opel Corsa ou similaire', NULL, 50, 0.3, '2B-sml.png', 15),
(105, 'Fun Confort', NULL, 'Smart fortwo, Fiat 500 ou similaire', NULL, 47, 0.3, '7A-sml.png', 15),
(106, 'Fun Premium', NULL, 'Mini cooper ou similaire', NULL, 52, 0.3, '7B-sml.png', 15),
(107, 'Moyenne Confort', NULL, 'Renault Clio IV, VW Polo ou similaire', NULL, 51, 0.3, '3A-sml.png', 15),
(108, 'Moyenne Premium', NULL, 'Opel Astra ou similaire', NULL, 55, 0.3, '3B-sml.png', 15),
(109, 'Grande Confort', NULL, 'Ford Focus ou similaire', NULL, 59, 0.3, '4A-sml.png', 15),
(110, 'Grande Premium', NULL, 'Ford Mondeo, Mercedes Classe C ou similaire', NULL, 63, 0.3, '4B-sml.png', 15),
(111, 'SUV et tout chemin', NULL, 'Opel Mokka ou similaire', NULL, 62, 0.4, '5A-sml.png', 15),
(112, 'Monospace 5 Places - break', NULL, 'Renault Scenic, Ford C-Max ou similaire', NULL, 81, 0.4, '6A-sml.png', 15),
(113, 'Monospace 5+2 places - break', NULL, 'BMW 2 Series, Ford Grand C-Max ou similaire', NULL, 98, 0.4, '6B-sml.png', 15),
(114, 'Monospace 7 Places - break', NULL, 'Ford Galaxy ou similaire', NULL, 114, 0.4, '6C-sml.png', 15),
(115, 'Minibus', NULL, 'Renault Traffic, Fiat Scudo combi ou similaire', NULL, 157, 0.4, '6D-sml.png', 15),
(117, 'Catégorie A', 'Fourgonnette 3 m³', 'Renault Kangoo, Fiat Doblo ou modèle similaire', 'Idéal pour transporter des petits volumes et très maniable.', 40, 0.2, 'A-sml.png', 17),
(118, 'Catégorie A\'', 'Fourgonnette 4 /5 m³', 'Fiat Scudo, Peugeot Expert ou modèle similaire', 'Parfait pour transporter de petits électroménagers.', 49, 0.2, 'A\'-sml.png', 17),
(119, 'Catégorie B', 'Fourgon 6/7 m³', 'Renault Trafic, Fiat Ducato ou modèle similaire', 'Idéal pour deux électroménagers, un lit et un canapé.', 45, 0.25, 'B-sml.png', 17),
(120, 'Catégorie C', 'Fourgon 8/9 m³', 'Renault Master, Opel Movano ou modèle similaire', 'Parfait pour déménager un studio et des objets hauts.', 52, 0.25, 'C-sml.png', 17),
(121, 'Catégorie D', 'Petit camion 10/12 m³', 'Iveco Daily, Mercedes Sprinter ou similaire', 'Pour déménager un appartement 2-3 pièces.', 54, 0.25, 'D-sml.png', 17),
(122, 'Catégorie D+', 'Petit camion 14/15 m³', 'Mercedes Sprinter', 'Parfait pour déménager un 4 pièces. ', 56, 0.3, 'D+-sml.png', 17),
(123, 'Catégorie E', 'Camion 20/23 m³', 'Iveco Daily, Mercedes Sprinter ou modèle similaire', 'Idéal pour déménager un pavillon.', 59, 0.3, 'E-sml.png', 17),
(124, 'Catégorie E\'', '20/23 m³ avec hayon', 'Mercedes Sprinter, Iveco Daily ou modèle similaire', 'l\'élévateur facilite le chargement et déchargement d\'objets lourds.', 71, 0.3, 'E\'-sml.png', 17),
(125, 'Catégorie G', 'Camion benne', 'Iveco, Mitsubishi', 'Benne à basculement arrière, adaptée pour les transports de gravas.', 88, 0.3, 'G-sml.png', 17);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `telephone` varchar(14) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `motpasse` varchar(255) DEFAULT NULL,
  `newsletter_optin` tinyint(1) DEFAULT 0,
  `sms_optin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `telephone`, `email`, `motpasse`, `newsletter_optin`, `sms_optin`) VALUES
(1, 'LEHY', 'Kévin', '125 quai Lamartine', '71000', 'MACON', '06 80 33 29 40', 'kevin.lehy@gmail.com', '1111', 0, 0),
(2, 'GIRAUD', 'Martin', '210 allée des brumes', '71850', 'CHARNAY', '07 50 12 15 22', 'martin.giraud@gmail.com', '2222', 0, 0),
(6, 'sdgdsgds', 'yze', 'qfsqzehyez', '71000', 'gdsgdsgdsg', '065054885', 'yanis@y.fr', 'yanis', 0, 0),
(7, 'sgdsgds', 'gqsgsq', 'tutruturtu', '71000', 'ttutueueruerur', '063467676343', 'y@y.fr', '1234', 0, 0),
(8, 'sdgsdgdsg', 'sgdgds', 'qsggqgsgqsgqsg', '71000', 'macon', '054646645', 'n@n.fr', '$2y$12$4R.ZjSrDSC0evfuxZAaz3.2XKq/xc82sgbw6yWGp4IpR.zCRa5IKy', 0, 0),
(9, 'Benkrouidem', 'Yanis', '8 rue de bretagne', '71000', 'macon', '0652793654', 'yanis@yanis.com', '$2y$12$4eiU3Z/JNTk1VZBZSirqsev4DK0SGSRiQwFjByKa4a7ht23z24mq2', 0, 0),
(10, 'bancaire', 'Carte', 'sdggsdds', '01000', 'qfgsqdgqgqsd', '0658794542', 'banque@b.fr', '$2y$12$Wpl8I4MAMJJ9B0yYkh0exOasyIshUZ9o0lfe2jFTMrAE.LISq9bAu', 0, 0),
(11, 'Hashage', 'HAsh', 'sddsgdsgsdgdsgds', '71000', 'macon', '0056640684', 'hashage@ok.fr', '$2y$12$E9hnFiCno61OckT.tjW7Mu31.3pwShL6aUeoOU6R6edNIQ/pNEdOi', 0, 0),
(12, 'ada', 'nathan', NULL, NULL, NULL, NULL, 'n@gmail.com', '$2y$12$DynIYlxe4/r4qEMHwSH4bu31MwaWu/rkC6H22w51dGVLrih./R5U.', 0, 0),
(13, 'ada', 'ada', 'Yanis', '71000', 'Mâcon', '0652793654', 'admin@ada.fr', '$2y$12$vOKpj3r1kR35mlvHL/jULewpGfaNcUnmw6RrHlILhC0YcVX/4fbQm', 0, 0),
(14, 'yanis', 'portfolio', 'Yanis', '71000', 'macon', '0652793654', 'portfolio@encours.fr', '$2y$12$n/Bx9YE8fMex8Feaf5wla.RKAhEifL8xh0sdiAYlmOiuZ6/NfPp7i', 0, 0),
(15, 'QSFSQFSQ', 'WDSFGFSQ', 'qsfsqfsqf', '71000', 'MACON', '08753873553', 'a@a.a', '$2y$12$9LO0iT94uO6/3FwOXbf30O.F9JIP0u7iBWfC8kbe82wzNm0MCIMbK', 0, 0),
(16, 'viande', 'test', NULL, NULL, NULL, NULL, 'test@gmail.com', '$2y$12$lCqpOlDpwc/XmgRRO/IzneS0/5O9aG06wDEzK328zoxGW3LFPaZJ.', 0, 0),
(17, 'rivé', 'versleciel', 'rue', 'test', 'test', '01 01 01 01 01', 'vf@gmail.com', '$2y$12$LLbhX80sylqGE1IoeDsxpeI1mARZH1VDJon/cDbZa37DPzy5SMurC', 0, 0),
(18, 'test', 'test', 'qq', '22222', 'F', '01 01 01 01 01', 'c@gmail.com', '$2y$12$hucQeMugtGMERgi8NP5TgO7HR/5ZATXV/g6cpb8ypgT8oX059KrEK', 0, 0),
(19, 'sdqfsqgfsqfq', 'qsfsqfsqfsqsq', 'QSSSQFF', '71000', 'macon', '0652793654', 'e@e.e.e', '$2y$12$iy9JAnuEe7Itui3Bw5N68OjLh3HbyV61ljueldtFEsACPkjvu97p6', 0, 0),
(20, 'BENKROUIDEM', 'Yanis', 'SQFSQFSQFQF', NULL, 'Mâcon', '08457355332', 'yanis.benkrouidem@gmail.com', '$2y$12$N.9NWGnINHSKeaUbfhVZRe2CGJBBSbHNUT1xgp4OHqRjoRdTI..Ga', 1, 1),
(21, 'Benkrouidem', 'Yanis', '8 Rue de Bretagne', '71000', 'Mâcon', '0652793654', 'yanis.benkrouidem@gmail.com', '$2y$12$RUR7yE0Bl0nLG5gN1PRcXO/CauuHvH2.cUdVbXBxhuo7bRQyESQGG', 0, 0),
(22, 'Heu', 'NATHAN', NULL, NULL, NULL, '08535393595355', 'nathan@heu.fr', '$2y$12$68HZVc5FBzxoNJLLParJaeVeLmv72Rvtvizk5ww9xhEyWXPUDwACG', 0, 0),
(23, 'HEU', 'Nehuq', NULL, NULL, NULL, 'fsdfsqfsfq', 'Heu@heu.fr', '$2y$12$9RuYzvGNA/yvYHE3ryRGCO5OObp30EDFBXxFPYq200ap0kYtxjAbG', 0, 0),
(24, 'ZRERZEREER', 'Zetzerrzer', '', '', '', '0652793654', 'test@video.fr', '$2y$12$H6uuFbU8Qnfkkm9geGXj8uRZnUMl6anAxhkmwUW4xgSCK.r48UFPe', 0, 0),
(25, 'NAT', 'Nat', NULL, NULL, NULL, NULL, 'nat@gmail.com', '$2y$12$NRkyeW/nrv5h97MuOKFyj.DXfNQS6YNXxdvc2JW3JBUetYZGDa6m.', 0, 0),
(26, 'NAT', 'Nat', NULL, NULL, NULL, NULL, 'natnat@gmail.com', '$2y$12$RwW8VOUZleaMGpXTiCL5CewSkcwUXkaMMTGL/jxt4gNbh/3sfuVXq', 0, 0),
(27, 'LACHAIZE', 'Aymeric', NULL, NULL, NULL, NULL, 'lachaize.aymeric@gmail.com', '$2y$12$YzNDADfX1AOWqUBJaNRm6.rHAqFhLZmaSPDAM6/qROU2mrLeQFd/y', 0, 0),
(28, 'JSSJSJKSSJ', 'Ldkskssksks', NULL, NULL, NULL, NULL, 'yayaya@yyaya.fr', '$2y$12$boSAzESnENwPanL/8yN8wOGhnIq/zXaw2yjKvQdjf6EJlvwED26aO', 0, 0),
(29, 'DSFDFSDSFDSFDSF', 'Rffdfdfs', NULL, NULL, NULL, NULL, 'dsfdsfdsffds@dsfdsf.fr', '$2y$12$BrvVHYLq7Z8XHGwwveuIJuhLjDD.HEiQ5hczf48mLUL7Qs8UvdSVe', 0, 0),
(30, 'QFFFSQFDQFDS', 'Ezfdfsqfdqdf', NULL, NULL, NULL, NULL, 'qsqffsq@dsd.fr', '$2y$12$sMNaPTa2fTI.cN04LDJ7cOFR2MiLY5XjWjB0aYhmBTIhvoCRP9cKu', 0, 0),
(31, 'SDGGDSDGDS', 'Dsegsgdsfg', NULL, NULL, NULL, NULL, 'SGSDGDSG@GDG.fr', '$2y$12$ob7YbLEEswRKg5Dej/XUq.7RFvLF3sQ.7YRLBBy53POUgNOI9IiPa', 0, 0),
(32, 'FFFSQ', 'Aaff', NULL, NULL, NULL, NULL, 'a@a.fr', '$2y$12$XD2up0pJ9zYZ1D2oHtkESOBKRgrRdFbzIaTmbTqL0M6WsopMQyeTy', 0, 0),
(33, 'SQDFDFQDSFSQ', 'Bbvjhjhj', 'sdsfdfsdfs', NULL, 'qfsqfsqf', '76434343646', 'b@b.fr', '$2y$12$3AtZzXC4zmywhpGtOeATdux3XX0vVLLt0kYtT7adiNXLXDjWcSrbe', 0, 0),
(34, 'QSFSQFQF', 'Qsfqssfsqfqq', NULL, NULL, NULL, '0652793654', '1@g.fr', '$2y$12$b.P5edMPUBczYTQP9ooHJeWRzDthC8DN3dEPhnJ4xhuQJ3GwK0i3O', 0, 0),
(35, 'QSFSQF', 'Qsfsqf', NULL, NULL, NULL, '0642525225', 'nom@domaine.com', '$2y$12$LyPudHl5U71ju2gjnQcnPelhy5TE/sLecwdt2rwG4yGMu93hnTh.W', 0, 0),
(36, 'SQSQSFQ', 'Qssfsqf', NULL, NULL, NULL, '06532523235352', 'd@d.fr', '$2y$12$kHoG9Okibeobs3sXMtyJvu67BaYi3r.z1vg0FJvdyYYVfyKVa/8vy', 0, 0),
(37, 'LACHAIZE', 'Aymeric', '12 avenue Alain Savary', NULL, 'Dijon', '0749368903', 'aymeric.lachaize71@gmail.com', '$2y$12$bI0Oy6ucY3g1r8bEh9X.yuJd.00zi89JbOCrL5S1sb/dcov.UV6O6', 0, 0),
(38, 'NATHAN', 'Test', NULL, NULL, NULL, '0101010101', 'nathan@gmail.com', '$2y$12$bgQis5Hi9bUzg3nWI9GBFefpxWsbhXLQOlAGTBqPLzg7YvVzndIhO', 0, 0),
(39, 'SSFSF', 'Sfsfs', NULL, NULL, NULL, '325352352532', 'sfssf@fss.fr', '$2y$12$hKkG9k260D1PnXXA88/MCukLH74i34ztBfLrcpqy1L1F8ZPPsHOUu', 0, 0),
(40, 'QSFSQFSQF', 'Qsdsqfqfds', NULL, NULL, NULL, '07553953953', 'r@r.fr', '$2y$12$zcwIi0Vo6ZY6gEIjymbkq.Pw7KS5rMZ0N6rftQymRKJIXKYnK1uaC', 0, 0),
(41, 'ZBEUB', 'Zbeub', NULL, NULL, NULL, '9000230523523', 'zbeub@zbeub.fr', '$2y$12$P1q9STZAZ7JPWUCYhXuyH.3P.0mZ.R.KJUz1rJWkPZvEr1mW1F64q', 0, 0),
(42, 'CACAO', 'Cacao', NULL, NULL, NULL, '90532590325235', 'CACAO@CACAO.fr', '$2y$12$KIAs7h2rF8KvI057kbtgU.RqXAR7ZrY24IW3tH4ajEMzY4UhWXcmK', 0, 0),
(43, 'GGFGFDGFD', 'Gdfg', NULL, NULL, NULL, '477347437437', 'sfsfssffssfsffsf@fs.fr', '$2y$12$WhPgz.3YMlARsFrEOUp2wePLJPXpaFo3n7iJT9nhFbVMALYTywvYm', 0, 0),
(44, 'QQSF', 'Sfqfq', NULL, NULL, NULL, '02545542555', 'k@k.fr', '$2y$12$M8FyVonLd/ZsDRGWqCZWROEdr.gbpU6tWEeCc1GsWkfvbN7F4ActW', 0, 0),
(45, 'FFFFF', 'Nathan', NULL, NULL, NULL, '02545542555', 'ueh@gmail.com', '$2y$12$M6GskvEsbsbuR.mJwQncLOQocxcJaCoTymgPLT4mHT7n5B1S8ytCa', 0, 0),
(46, 'EZR', 'Eez', NULL, NULL, NULL, '06 00 00 00 00', 'e@t.com', '$2y$12$0zdilrSnrZmHYH1cdruPW.ZogS35miy4IePhb1XSn2Em89aT93VIq', 0, 0),
(47, 'HEU', 'Nathan', NULL, NULL, NULL, '6767676767', 'nathannathan@gmail.com', '$2y$12$X.8gLQAo8Wvear7QovMCr.m6BGxS2OWxYxq5fiYtoTwhdHT0SPkFu', 0, 0),
(48, 'HEU', 'Nathan', NULL, NULL, NULL, '06 11 11 11 11', 'nathannathannathan@gmail.com', '$2y$12$tI/fSD79DEgzKOChdttKTuR5P56axHXE.QgkBpdfsWQjc56kaZWSW', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client_cards`
--

CREATE TABLE `client_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `last_four` varchar(4) NOT NULL,
  `brand` varchar(20) DEFAULT 'Visa',
  `expiry_date` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `client_cards`
--

INSERT INTO `client_cards` (`id`, `client_id`, `last_four`, `brand`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 20, '1535', 'Mastercard', '35225', '2025-12-25 22:36:30', '2025-12-25 22:36:30'),
(3, 20, '4242', 'Mastercard', '24424', '2025-12-25 22:48:56', '2025-12-25 22:48:56');

-- --------------------------------------------------------

--
-- Structure de la table `client_family`
--

CREATE TABLE `client_family` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `relation` varchar(50) DEFAULT 'Famille',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `client_family`
--

INSERT INTO `client_family` (`id`, `client_id`, `prenom`, `nom`, `relation`, `created_at`, `updated_at`) VALUES
(3, 20, 'Wxxwvvxw', 'XWVVXWWXV', 'Enfant', '2025-12-26 21:49:17', '2025-12-26 21:49:17'),
(2, 26, 'Test', 'VIANDE YANIS ATT JTESTE LE SITE', 'Enfant', '2025-12-26 07:18:50', '2025-12-26 07:18:50');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` varchar(255) NOT NULL,
  `page` varchar(255) DEFAULT 'home',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `rating`, `page`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'Excellent', 'home', '89.92.242.15', '2025-12-27 08:26:36', '2025-12-27 08:26:36'),
(2, 'Needs improvement', 'home', '89.92.242.15', '2025-12-27 08:28:32', '2025-12-27 08:28:32'),
(3, 'Excellent', 'home', '89.92.242.15', '2025-12-27 08:31:43', '2025-12-27 08:31:43'),
(4, 'Excellent', 'home', '89.92.242.15', '2025-12-27 08:31:59', '2025-12-27 08:31:59'),
(5, 'Excellent', 'home', '89.92.242.15', '2025-12-28 00:25:56', '2025-12-28 00:25:56');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `libelle`, `titre`, `description`, `logo`) VALUES
(15, 'Voitures de tourisme', 'Location de voiture de tourisme adaptée à vos besoins avec ADA', 'Pour vos week-ends prolongés comme pour vos vacances en famille ou vos déplacements professionnels, vous trouverez toujours chez ADA la voiture qui vous convient. Nos modèles vont de la citadine qui se faufile partout au monospace 7 places, en passant par les catégories économique, compacte, familiale et grande routière.', 'voiture.png'),
(17, 'Véhicules utilitaires', 'La location d\'utilitaire : fourgon ou camion partout en France avec ADA', 'Numéro un de la location de véhicules de proximité en France, ADA accompagne au quotidien celles et ceux qui expriment le besoin de louer un véhicule type fourgon ou camion pour un usage ponctuel. Déménagement, transport de matériel encombrant... Quelle que soit la raison qui vous incite à louer une fourgonnette ou un camion, ADA dispose dans sa flotte de véhicules du modèle adapté à vos besoins.', 'utilitaire.png'),
(18, 'Voitures sans permis', 'Retrouvez toute la gamme de location de voiture sans permis avec ADA', 'ADA met à votre disposition des Véhicules sans permis\r\n(voitures sans permis et scooters 50cc) pour vous déplacer, même sans permis !', 'sanspermis.png'),
(20, 'Deux roues', 'Location d\'une moto, d\'un vélo ou un scooter ?', 'Le plus grand réseau français de location de 2 roues', 'deuxroues.png');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jours`
--

CREATE TABLE `jours` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `jours`
--

INSERT INTO `jours` (`id`, `libelle`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi'),
(7, 'Dimanche');

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `datesignature` date DEFAULT NULL,
  `dateheuredebut` datetime DEFAULT NULL,
  `dateheurefin` datetime DEFAULT NULL,
  `dateheurefinreel` datetime DEFAULT NULL,
  `nbkmdebut` int(11) DEFAULT NULL,
  `nbkmfin` int(11) DEFAULT NULL,
  `montantfacture` float DEFAULT NULL,
  `agence_id` int(11) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`id`, `datesignature`, `dateheuredebut`, `dateheurefin`, `dateheurefinreel`, `nbkmdebut`, `nbkmfin`, `montantfacture`, `agence_id`, `vehicule_id`, `client_id`) VALUES
(1, '2025-09-30', '2025-10-01 08:00:00', '2025-10-02 18:00:00', NULL, 1000, 1200, 100, 1, 3, 1),
(2, '2025-09-25', '2025-10-12 09:00:00', '2025-10-15 19:00:00', NULL, 5600, 6000, 250, 2, 2, 2),
(3, '2025-11-05', '2025-11-01 08:00:00', '2025-11-03 18:00:00', NULL, 1200, 1600, 300, 1, 10, 1),
(4, '2025-11-10', '2025-11-21 10:00:00', '2025-11-22 19:00:00', NULL, 0, 0, 0, 2, 3, 2),
(5, '2025-12-03', '2026-03-18 15:00:00', '2026-04-15 14:00:00', NULL, NULL, NULL, NULL, 2, 2, 6),
(6, '2025-12-03', '2026-03-12 14:00:00', '2026-04-15 18:00:00', NULL, NULL, NULL, NULL, 1, 3, 6),
(7, '2025-12-03', '2026-04-16 15:00:00', '2026-04-23 14:00:00', NULL, NULL, NULL, NULL, 1, 10, 6),
(8, '2025-12-04', '2026-04-16 14:00:00', '2026-05-21 15:00:00', NULL, NULL, NULL, NULL, 2, 2, 7),
(9, '2025-12-04', '2026-04-10 15:00:00', '2026-04-22 14:00:00', NULL, NULL, NULL, NULL, 2, 11, 7),
(10, '2025-12-04', '2026-04-21 14:00:00', '2026-04-29 15:00:00', NULL, NULL, NULL, NULL, 2, 1, 7),
(11, '2025-12-04', '2026-03-12 09:00:00', '2026-03-13 15:00:00', NULL, NULL, NULL, NULL, 2, 2, 7),
(12, '2025-12-04', '2025-06-14 10:00:00', '2025-06-15 18:00:00', NULL, NULL, NULL, NULL, 2, 2, 7),
(13, '2025-12-04', '2025-06-12 10:00:00', '2025-06-18 17:00:00', NULL, NULL, NULL, NULL, 2, 1, 7),
(14, '2025-12-05', '2025-07-12 10:00:00', '2025-07-13 16:00:00', NULL, NULL, NULL, NULL, 1, 25, 8),
(15, '2025-12-05', '2025-07-12 10:00:00', '2025-07-12 17:00:00', NULL, NULL, NULL, NULL, 1, 16, 9),
(16, '2025-12-05', '2025-07-12 10:00:00', '2025-07-12 14:00:00', NULL, NULL, NULL, NULL, 1, 17, 9),
(17, '2025-12-05', '2025-08-12 14:00:00', '2025-08-15 16:00:00', NULL, NULL, NULL, NULL, 2, 2, 9),
(18, '2025-12-05', '2025-08-12 14:00:00', '2025-08-15 16:00:00', NULL, NULL, NULL, NULL, 2, 11, 9),
(19, '2025-12-10', '2025-09-14 14:00:00', '2025-10-17 15:00:00', NULL, NULL, NULL, NULL, 1, 25, 10),
(20, '2025-12-19', '2025-09-05 09:00:00', '2026-03-19 17:00:00', NULL, NULL, NULL, NULL, 1, 17, 16),
(21, '2025-12-19', '2025-12-05 05:31:00', '2026-01-02 20:28:00', NULL, NULL, NULL, NULL, 2, 1, 18),
(22, '2025-12-19', '2025-09-12 12:00:00', '2025-09-14 16:00:00', NULL, NULL, NULL, NULL, 2, 2, 20),
(23, '2025-12-19', '2025-12-01 06:59:00', '2025-12-31 19:11:00', '2025-12-25 15:19:15', NULL, 0, NULL, 2, 11, 20),
(24, '2025-12-19', '2025-12-12 13:00:00', '2026-02-14 14:00:00', '2025-12-25 14:57:28', NULL, 0, NULL, 1, 3, 20),
(25, '2025-12-19', '2025-12-05 00:00:00', '2026-03-19 01:11:00', '2025-12-25 15:19:13', NULL, 0, NULL, 2, 13, 20),
(26, '2025-12-19', '2025-07-12 14:56:00', '2026-02-15 13:54:00', '2025-12-25 15:19:17', NULL, 0, NULL, 2, 18, 20),
(27, '2025-12-19', '2025-07-12 14:56:00', '2026-02-15 13:54:00', '2025-12-25 15:19:18', NULL, 0, NULL, 2, 19, 20),
(56, '2025-12-22', '2025-12-10 12:00:00', '2025-12-31 12:00:00', NULL, 0, NULL, 1701, 1, 12, 23),
(61, '2025-12-22', '2025-12-19 00:07:00', '2025-12-24 00:07:00', '2025-12-25 14:57:25', 0, 0, 280, 2, 23, 20),
(64, '2025-12-23', '2025-12-11 13:03:00', '4422-04-14 22:44:00', '2025-12-25 15:19:08', 0, 0, 25382100, 1, 10, 20),
(65, '2025-12-24', '2025-12-25 12:00:00', '2025-12-31 12:00:00', '2025-12-25 14:57:23', 0, 0, 306, 1, 14, 20),
(66, '2025-12-24', '2025-12-25 12:00:00', '2025-12-31 12:00:00', '2025-12-25 14:57:19', 0, 0, 330, 1, 27, 20),
(67, '2025-12-25', '2025-12-11 23:44:00', '2025-12-17 04:04:00', NULL, 0, NULL, 339.931, 1, 27, 20),
(68, '2025-12-25', '2025-12-11 23:44:00', '2026-01-30 04:04:00', '2025-12-25 23:09:30', 0, 0, 2759.93, 1, 27, 20),
(69, '2025-12-25', '2025-12-25 18:46:00', '2025-12-30 18:46:00', '2025-12-25 22:15:16', 0, 0, 185, 2, 11, 25),
(70, '2025-12-25', '2025-12-25 12:00:00', '2025-12-31 12:00:00', '2025-12-25 22:15:18', 0, 0, 306, 1, 15, 25),
(71, '2025-12-25', '2025-12-25 23:13:00', '2025-12-27 23:13:00', NULL, 0, NULL, 58, 2, 1, 25),
(72, '2025-12-25', '2025-12-24 23:13:00', '2025-12-27 23:13:00', '2025-12-25 22:20:28', 0, 0, 87, 2, 1, 25),
(73, '2025-12-25', '2025-12-24 23:16:00', '2025-12-27 23:16:00', '2025-12-25 22:21:44', 0, 0, 87, 2, 1, 26),
(74, '2025-12-26', '2025-12-27 15:17:00', '2025-12-30 15:17:00', NULL, 0, NULL, 87, 2, 1, 37),
(76, '2025-12-26', '2025-12-30 08:00:00', '2026-01-01 08:00:00', NULL, 0, NULL, 58, 2, 1, 37),
(78, '2025-12-26', '2025-12-26 12:00:00', '2025-12-31 12:00:00', '2025-12-26 14:31:00', 0, 0, 260, 1, 25, 20),
(79, '2025-12-26', '2025-12-18 20:21:00', '2025-12-26 22:24:00', NULL, 0, 0, 890.371, 1, 20, 20),
(81, '2025-12-26', '2025-12-26 12:00:00', '2025-12-31 12:00:00', NULL, 0, 0, 260, 2, 2, 38),
(83, '2025-12-29', '2025-12-30 12:00:00', '2026-02-26 12:00:00', NULL, 0, 0, 3016, 1, 2, 20),
(85, '2025-12-31', '2026-01-23 15:07:00', '2026-01-30 15:07:00', NULL, 0, 0, 567, 1, 12, 20),
(86, '2026-01-01', '2026-01-14 12:00:00', '2026-01-31 12:00:00', NULL, 0, 0, 493, 1, 10, 20),
(87, '2026-01-05', '2026-04-24 12:00:00', '2026-04-30 12:00:00', NULL, 0, 0, 588, 1, 30, 20),
(88, '2026-01-05', '2026-04-24 12:00:00', '2026-04-30 12:00:00', NULL, 0, 0, 222, 1, 11, 20),
(89, '2026-01-13', '2026-01-13 12:00:00', '2026-01-15 12:00:00', NULL, 0, 0, 58, 1, 1, 25),
(90, '2026-02-04', '2026-02-11 12:00:00', '2026-02-19 12:00:00', NULL, 0, NULL, 416, 1, 2, 46),
(91, '2026-02-04', '2026-02-25 12:00:00', '2026-02-26 12:00:00', NULL, 0, NULL, 47, 1, 3, 46),
(92, '2026-02-25', '2026-06-27 12:00:00', '2026-10-23 12:00:00', NULL, 0, 0, 18526, 1, 13, 20),
(93, '2026-03-11', '2026-04-24 16:42:00', '2026-04-25 16:43:00', NULL, 0, NULL, 29.0201, 1, 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `vehicule_id` int(11) NOT NULL,
  `agence_depart_id` int(11) NOT NULL,
  `agence_retour_id` int(11) NOT NULL,
  `date_depart` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `prix_total` float DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`id`, `client_id`, `session_id`, `vehicule_id`, `agence_depart_id`, `agence_retour_id`, `date_depart`, `date_retour`, `prix_total`, `created_at`, `updated_at`) VALUES
(8, NULL, '4qhnILvAKTucYkQya37j9rPASyCh4Ym7okopTZnQ', 2, 1, 1, '2025-12-31 07:29:25', '2026-01-02 07:29:25', 104, '2025-12-30 15:29:25', '2025-12-30 15:29:25'),
(9, NULL, '4qhnILvAKTucYkQya37j9rPASyCh4Ym7okopTZnQ', 1, 1, 1, '2025-12-31 07:29:32', '2026-01-02 07:29:32', 58, '2025-12-30 15:29:32', '2025-12-30 15:29:32'),
(10, NULL, 'ciir7antlqxs15CLa3yqEeDwbTy3zIz6CnHjCFWE', 30, 1, 1, '2025-12-31 12:40:10', '2026-01-02 12:40:10', 196, '2025-12-30 20:40:10', '2025-12-30 20:40:10'),
(21, NULL, 'Jza7iTSOaR4yUIeK59VOlYVfcMljBt2hRbJAjlEa', 30, 1, 1, '2026-01-01 18:55:59', '2026-01-03 18:55:59', 196, '2026-01-01 02:55:59', '2026-01-01 02:55:59'),
(30, NULL, 'kW0ksJSlzXC31zzgrZkLIfMki4974B7C2S2UMITr', 16, 1, 1, '2026-01-02 20:13:32', '2026-01-04 20:13:32', 118, '2026-01-02 04:13:32', '2026-01-02 04:13:32'),
(32, NULL, 'kW0ksJSlzXC31zzgrZkLIfMki4974B7C2S2UMITr', 20, 1, 1, '2026-01-02 21:58:32', '2026-01-04 21:58:32', 196, '2026-01-02 05:58:32', '2026-01-02 05:58:32'),
(35, NULL, 'xWMc3ryRW6OIINBAgkMCEXfmmvdxxivDV49vd4k8', 15, 1, 1, '2026-01-03 15:00:30', '2026-01-05 15:00:30', 102, '2026-01-02 23:00:30', '2026-01-02 23:00:30'),
(40, NULL, 'PeSWLjY63W02kJdzYbjZ0nNfilKrxUYdNWnwpyF9', 12, 1, 1, '2026-01-07 10:25:06', '2026-01-09 10:25:06', 162, '2026-01-06 18:25:06', '2026-01-06 18:25:06'),
(41, NULL, 'xtm9z5ieMG8MBFktZNiZJjTWa5lICocYAxgZqTmI', 28, 1, 1, '2026-01-08 13:50:15', '2026-01-10 13:50:15', 124, '2026-01-07 21:50:15', '2026-01-07 21:50:15'),
(42, NULL, 'iwU2ZNpSQqN6KJiC8TTGmLPt9X37MsnjUE7sF8Jl', 15, 1, 1, '2026-01-11 15:14:15', '2026-01-13 15:14:15', 102, '2026-01-10 23:14:16', '2026-01-10 23:14:16'),
(43, NULL, 'sT4rpUBOZFj791SYNBEq97jo31bmP4hrm8EZ5oiF', 10, 1, 1, '2026-01-13 13:57:47', '2026-01-15 13:57:47', 58, '2026-01-12 21:57:47', '2026-01-12 21:57:47'),
(44, 45, NULL, 14, 1, 1, '2026-01-14 15:10:37', '2026-01-16 15:10:37', 102, '2026-01-13 23:10:37', '2026-01-13 23:10:37'),
(45, 45, NULL, 17, 1, 1, '2026-01-14 15:10:47', '2026-01-16 15:10:47', 314, '2026-01-13 23:10:47', '2026-01-13 23:10:47'),
(47, NULL, '1gVSx0yQlZS3DtU36l7RbN74sAaEVtFmKAUYnIvI', 1, 1, 1, '2026-01-14 19:07:30', '2026-01-16 19:07:30', 58, '2026-01-14 03:07:30', '2026-01-14 03:07:30'),
(48, NULL, 'sJqgyGV1FQTaPPSeXc6bTkOu1N5m8zI1HmguL9I5', 1, 1, 1, '2026-01-14 19:10:21', '2026-01-16 19:10:21', 58, '2026-01-14 03:10:21', '2026-01-14 03:10:21'),
(56, 20, NULL, 29, 1, 1, '2026-03-13 20:49:56', '2026-03-15 20:49:56', 80, '2026-03-13 03:49:56', '2026-03-13 03:49:56'),
(57, NULL, 'uYQQfc3bR6fSHmup1LFLTGem2RPUuvR3ANj9IoFS', 21, 1, 1, '2026-03-20 13:47:46', '2026-03-22 13:47:46', 142, '2026-03-19 20:47:46', '2026-03-19 20:47:46');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('11npND7aRPKI3uybwod5ZUn2smu6JvvQGElxPxfG', 48, '89.227.209.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN0RDSnV6M1V5NVdwV0Y2VWhBMU9RN1FXTzdIMTFZek9YQVdMdkV0YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL21vbi1wcm9maWwiO3M6NToicm91dGUiO3M6MTQ6ImNsaWVudC5wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MzoibG9naW5fY2xpZW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDg7czo5OiJjbGllbnRfaWQiO2k6NDg7czoxMDoiY2xpZW50X25vbSI7czoxMDoiSEVVIE5hdGhhbiI7fQ==', 1774266714),
('2eGU4pWhi8ONNhXdJNxZG3pxRmb3z1orwcK7iwzI', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkZLSjIxNXQwZVdid0Rrb3hRSmVaR2J6SmlpOWRvMWk2aUJWTmFtYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774392755),
('2hpCXBhyKRXDPwU5qcOxTU3cTD2jEJAAdUaeJVZ7', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFFiTUY5Q3k1MDFyeE9GdjdOaVVaaW1DV0ZYdzVnTEdlM1h1cHJyNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773261731),
('5s2om6fXlcSdIJn2UVVsk3oBQ7vZ5GwA17ZWb55y', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkl3NVFCY0pEc1JiT1QwQXdDZGZwZmtKTGVyd1EwYml5TE1NUDVXTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773107582),
('6yQbBIY9Z6IO7KrKgFEhYTjvEMTNVFqPp8C88lzj', NULL, '213.44.27.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVRIQjdKOUh1bXQ3YmpDampVa2dpdjJDYlZIT2Y1UVZIVnpaYnJkciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772217113),
('9uz8O7Ji45vrgEpaxeYA9eJElc28b88vPUpfaUzK', NULL, '176.223.130.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVBMazJpY0JFV1J4S3RZR3FtdG5tYTJVeXVVOTVNeWZGc0VPVkRycCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmFkYS40MndlYi5pby8/d2JUb2tlblZlcmlmeURpYWc9MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772530463),
('afJfULln4QKQtHkYRRPZHP4oKLYf4TfIDlxuPc1E', NULL, '89.47.161.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRE9WOG10YkM3bFZSWTIzTjl0NzhIWG5iQWJXYXhLRDByNnc5RWlPQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz93YlRva2VuVmVyaWZ5RGlhZz0xIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773787490),
('AVKsgxqcfMyfJKrmWVdMpdz1421bFR4XFUoTPXxQ', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMU5IVHN1d1ZYRGNPaFMzWnNTMElReFlNNlc5YmlIOEVNRHlNejlYbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL2Zsb3R0ZSI7czo1OiJyb3V0ZSI7czoxNjoidmVoaWN1bGVzLmZsb3R0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773685788),
('bCFyT1Zxfzgf6jx8D8AboA93uAiy7rSCchE0ZL3w', NULL, '213.44.27.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjdGSVNRZ2hQNldtRFFYaExnUndCVHRLQTdTT1Z0Zm83Z01WNm1OSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL2Zsb3R0ZT9pPTEiO3M6NToicm91dGUiO3M6MTY6InZlaGljdWxlcy5mbG90dGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772218704),
('bngCbZoepwXZ6Hqzb7vgsLbxvKkscEOxzKbmHF7z', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2h3OXNzajU5ZDJJVlExM1hoa3BIWnR4SUs1SHBlam9leVV1a0E1TiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772217101),
('cBp4yFx3aWAhkDPH0fMSS4pgKZUG3oDydGkAsI4e', NULL, '212.24.108.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRktma2pOSWhnYlVieEtwRHp1RDZNYWtNZFFnYzdYbnNlbHU5YU0xeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmFkYS40MndlYi5pby8/d2JUb2tlblZlcmlmeURpYWc9MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1773333617),
('CnR0Kc6teU2Zq7QaLUaDqGaVpdFhxIGduy3pF8nb', NULL, '94.176.235.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWk1IUUN1NXk4ZUJFQ3p3VTJUM1M5dDV1UUViUjZHSXNOemh1MUxyRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz93YlRva2VuVmVyaWZ5RGlhZz0xIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772938940),
('D2pTYeqc1bKXEVnfdL6DUkGyGxxcaHsaEg6SaK3p', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjByczVJNFlNQ3lRVWxlbHl0MFpUQVU5dEdlc0E2cEQyOUdBcnc0eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774010265),
('DL4cWJBD5QJeJYDEsgpiUnPPtzdWx2FpPfZjFhtP', NULL, '176.129.188.169', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTBUM0lCcHgyOW1OUzlQQVR1RlpkOW04ZVpYYXhQS2JmMEI5bkdXYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773664512),
('DYoF3tmyl216MBbXEm3AHzP84bzL6Z7HBf3ottGm', NULL, '77.158.226.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWN0ZjlEcmlDWDNrRGplalIzZmRwM1I4SXBhQlpkZWNmOVpLWTBkVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773054701),
('FMSiYxwLpkd22aMm3kargzw1zC4USb3wmLnhDb4T', NULL, '213.44.27.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjFxQ0RFVjBXTWFKYmZScHY5dmhqQ1hYQ1Q0UFRLc2NSa1VYMmpaMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL2luc2NyaXB0aW9uP2k9MSI7czo1OiJyb3V0ZSI7czoyMDoiY2xpZW50LnJlZ2lzdGVyLmZvcm0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772218711),
('Fyyn5WgjUojtZhhvapkn5yoyk417yRnfvCMmWR5n', NULL, '77.159.251.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialNWbFRPMlNZeFRVQWx0dzR0R3o1Vlc2VWFnaDVjcVJreThDOHg5UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773836632),
('GAltGNEsnrdo6npOYVCxseAZuSmyWkyatajnA4mo', NULL, '77.159.251.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoicW9ESjVSVUdzZUNsQUxndnV1aUs5MmxXTEpBWDlRMUZqem5YVlhHaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUzOiJsb2dpbl9jbGllbnRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMDtzOjk6ImNsaWVudF9pZCI7aToyMDtzOjEyOiJjbGllbnRfZW1haWwiO3M6Mjc6InlhbmlzLmJlbmtyb3VpZGVtQGdtYWlsLmNvbSI7czoxMDoiY2xpZW50X25vbSI7czoxNzoiQkVOS1JPVUlERU0gWWFuaXMiO30=', 1773841264),
('Gamf5Q82IWBz9XjzukkBJOUOWNDKTQOndaXAg9Ut', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUElMRWxaRGVjVGx4bGtaNmlMNWxKaGRwNElkQ3ZxOFZYYjE3ZFNrRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772352292),
('GBPzorinLTZ6jBn0mUFDHV99Hbn20DmxCcIDgs4W', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamFFOEhJbUFzakhqV2tETDZvZzJBcWFqYmZRUlFVa1o3Y3hBN1p0QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772233366),
('HQM5AfPc5ENwXBw0Uy7Px9bWD6z34twP67Zq3ANM', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFltTnBFcm5UNjczM0NBelE2NVI2a3F5S1N4elZrdDA0dWltTXNOdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL2VzcGFjZS1jbGllbnQvY29ubmV4aW9uIjtzOjU6InJvdXRlIjtzOjE3OiJjbGllbnQubG9naW4uZm9ybSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774125983),
('iDK8Esxt7lsnJzN6J1QzTHmSdGh5lOtIwqQ5YPVv', NULL, '77.158.132.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTFNPZ1IycDlaclo5Nm80U1BmYkMwTXI2V3NpaVhHbERTNUF2RDM5QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL3Jlc2VydmF0aW9uLzIiO3M6NToicm91dGUiO3M6MTg6InJlc2VydmF0aW9uLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTM6ImxvZ2luX2NsaWVudF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIwO3M6OToiY2xpZW50X2lkIjtpOjIwO3M6MTI6ImNsaWVudF9lbWFpbCI7czoyNzoieWFuaXMuYmVua3JvdWlkZW1AZ21haWwuY29tIjtzOjEwOiJjbGllbnRfbm9tIjtzOjE3OiJCRU5LUk9VSURFTSBZYW5pcyI7fQ==', 1773662998),
('IoAHvjGAkgV2Rj44eXiTZBuWgh1aFIdcm8rCssND', NULL, '77.158.226.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnZGeG5kTHBDQ2ZGR2c5dkJFRG5DNlVLYzEwbjFUUGIwTkJOc3k3biI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772523613),
('ioBTy0QBVKbNdWh3wrgCMSQVmSzgFbkiJq166jeZ', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajdtTFJxMHJ5ZXJ3ZVhwTTlVNmpqMmphVmt3ZHd3Q2tBVVlVTDltaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL2VzcGFjZS1jbGllbnQvY29ubmV4aW9uIjtzOjU6InJvdXRlIjtzOjE3OiJjbGllbnQubG9naW4uZm9ybSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774383127),
('J4HHkwe1JyhbvXwrpzAt5aBm1CNplVkKzB7VwgL8', NULL, '213.44.27.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVk4aDhRVDQzaTdmc0F4UEkzU0FYOGp3Q1drNXl1U2lsR3F6c1QxYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTIiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772217116),
('KEjuTPSDY3TC6n3VP8pJtYKyET6pAy3ECb60lNj0', NULL, '87.89.21.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUF2SkhVcmcwUXFaUzdERnpic2pHdUVBNHZ0Nk9VckJiQlNESU5GZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTIiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773046295),
('kxfULqLaDYZCY8yQhSE0j2cwCDLScZyMGtuhz6Xg', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkxadG9XSFNzMnB0TVkwVW1mdWpSRHZETGdMN0JxSHZWR09PYVVEciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772217108),
('KzNuTm4oYCmoImA99Y7o4M4PnNWQgLZoWmYuLNVw', NULL, '89.47.161.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEtQd1cxT0Vmc0c2dWY3YXdXdHNSbVBqZ1ozeUoxd29JMk80RExCNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmFkYS40MndlYi5pby8/d2JUb2tlblZlcmlmeURpYWc9MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1773787491),
('mXofXST6dvPASTSpHY0DzYBfiLBq5TLZyDSOjM89', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0lHTjhxekhRemFoOTVlS1duWWVETG1DT04zU3NSY3U2THZZT1RGbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL2luc2NyaXB0aW9uIjtzOjU6InJvdXRlIjtzOjIwOiJjbGllbnQucmVnaXN0ZXIuZm9ybSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772218704),
('neJF3DGchKGIafcQ3MBCMSt10VPP9Sbc87u78t5Y', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGFVUnlkbHpCb0pLT2F1SHg0VFdqN2NmUExXSWxoV1Z1SU5UMmhDMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772379241),
('NklePnBUHhLfey421lgs4YUF3iD5moKe9TzvibjC', NULL, '212.24.107.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWJZS2VwOURKN2xPaHdrckpzQ1BnRmhCRHBSaTMyNkRoaU1nS29RZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmFkYS40MndlYi5pby8/d2JUb2tlblZlcmlmeURpYWc9MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774175540),
('Qxj0ytGzmUzU7tEQwxwEX9jsC31pn5O9Sfew7sT3', 20, '31.33.52.122', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibU5HRzNxTlZPNWhHMTJYYmVQSEtVWHJ0RFVScmNDOHFORE42RlFpaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL21lcy1mYXZvcmlzIjtzOjU6InJvdXRlIjtzOjEzOiJmYXZvcmlzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MzoibG9naW5fY2xpZW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjA7czo5OiJjbGllbnRfaWQiO2k6MjA7czoxMjoiY2xpZW50X2VtYWlsIjtzOjI3OiJ5YW5pcy5iZW5rcm91aWRlbUBnbWFpbC5jb20iO3M6MTA6ImNsaWVudF9ub20iO3M6MTc6IkJFTktST1VJREVNIFlhbmlzIjt9', 1773243814),
('tcJcSptCbGzFrMKxVbcCWAr2ykZjUPYzaN2QXNBp', 47, '88.177.251.201', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSUFHUmhaS2pRYzZqRDRWWFJUdUhHMXV3RWZKaXJkY0FqUUtiRWZWbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvL21vbi1wcm9maWwiO3M6NToicm91dGUiO3M6MTQ6ImNsaWVudC5wcm9maWxlIjt9czo1MzoibG9naW5fY2xpZW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDc7czo5OiJjbGllbnRfaWQiO2k6NDc7czoxMDoiY2xpZW50X25vbSI7czoxMDoiSEVVIE5hdGhhbiI7fQ==', 1773859286),
('TINjfd5r3J0IptpljMzp6d3aghMyHYCI6YPkDVri', NULL, '77.158.226.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1VMcG9WNUJTdkQzMEQ1SlgzaW1kbVJwOVJqZ0Q3UXZZT3c3UDlYTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773130829),
('TusgShz99AcrM2RMv2Ro6glPeNmkiNfZIIUUEnPv', NULL, '66.249.70.32', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGtZV3NhUHVDNjJPR291ZU5qNVZTRVlXdFVEQmhIRXpSUjkzc0h2ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772217300),
('TyamVRs9aVJEEtpnRM3lBn3j9FWTo2uYQ1jon7NO', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTZzaUlKNldpVmVJak93djNUYW01MXMwbWRXZ1NHdnVLSjZtUzdxUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO319', 1773353411),
('u9FvzXxjt2KhcFoAsR2sFvMmIyjjxSnAjeAe7zqr', NULL, '193.50.152.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVm0wM0VySXVQRk02cGtrZGIzZEg4Y1BFSVR0TDNNUU5ScjVpZHJEciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773236858),
('ufa9dJapY9TBhzbfeKd9AyG0UgOtTjVuZAEKU7sc', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHZta2VOOERXODRLUVZqYjF4MXZuVno5UzY4cEk4dWhIMjNSbW5tNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773511857),
('uiuoRBpCEpKaiBJQFmwAEI7LnXBRTvdgpr3UYwib', NULL, '94.176.235.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmw0a0ZkR2tscnRmbmUwUVZFOGVtMGVvOVNPVTZmYVNLZlE3MTJreSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmFkYS40MndlYi5pby8/d2JUb2tlblZlcmlmeURpYWc9MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772938942),
('uYQQfc3bR6fSHmup1LFLTGem2RPUuvR3ANj9IoFS', NULL, '89.227.209.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXZEdkk2OVhmVDNqNzVNN1VLRTlpNHlWOUlBWFp6cWJYa3FwRGo1dyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773928069),
('UZDmsDOivtNkfiZUx3XzDY4sldbYHkeQ52MjXdxi', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGtvdU40ZXlQMDhQRjRocjQ3YU1EakZ2YXNSdE9zWXJwcndrUVZ5YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773951630),
('vTgz2LDZgl5xVCLDtNZ9sNTNcsusQFNsQQX7ooV4', NULL, '77.158.226.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEQycTcxVEZyMjNOS1ZhS2lWT09XSXU1R05JTVhSeG5VRENXUlZXTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772527843),
('vvHfrkRelRYeRiDF0XFpP0hRX2b2usn0pinVk33U', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0M5dzVYQzRtOElXc3ZZdWhYZjZwS2pwaGhXaUU1aUlQd0duZEg5aiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773940667),
('vZcl2g7H8X4J4KMr0pn5nnS2WGpE8ZGutl0ZMt7n', NULL, '212.24.107.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiandSMFN5Z082MDFpVTJhVHh2bTBaRDZrd0hCM3NsMzZQbDE0VzZEMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz93YlRva2VuVmVyaWZ5RGlhZz0xIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774175538),
('W7po9hLlU4cBQmyZ2hqarKx79ZhQ80oT6zJcqBSa', NULL, '89.92.242.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUE4WmJmSVV3ZXlycFBLVFE1R0h4UDdyazF0b2dWeEFqNWduVkRJTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772942722),
('wXtMOpUFEQBVrDFvrF11Dl88xoQqIsSmrwZq71rZ', NULL, '212.24.108.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmFibFROZGdjalNReDR0Ujl3NThtYm1NQzRJT0ZVc1VjZzVJVFRyeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz93YlRva2VuVmVyaWZ5RGlhZz0xIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773333615),
('YBqM8Q08XHcpvGmuELtS0d1tGbDZcPdHErRRRCIR', NULL, '89.227.209.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEx5WHU3ZFNJSmFCWk84dlNseHZCd3BPRXR2NlJwbVZYVFhDazhYWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773828085),
('z9lX85Pr8Ib8C0Oa0IKTL6cjs0iJy9umBj9l4hsd', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamlsY01lZEJkMFIzSW5nWTFxa2VwMjZQblJxckNacEtQVXg3b0FHNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773073865),
('zaj70bPYdw408U3NPKnihLT7jWM1zGT1dvqfiZt3', NULL, '176.223.130.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGtuNUV5ZDhnZFl3WlFDSlJ2azM5VE9NZUw2eE5RT1dTUWJlcXdoVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz93YlRva2VuVmVyaWZ5RGlhZz0xIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772530462),
('ZlwnuDbZaj1hLWDSRSeaihsmA6hWZee427jIcW3R', NULL, '66.249.70.39', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHJoZFhyMHF3VGdBdWgyZU5ET1Q5UkVhOFp2NlhDb3Y0ZTJ2UUt2YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772217300),
('zOCWG8X2ALypbfKjrOYzrdob2sSnSB9fdehWXISa', NULL, '89.92.242.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVm5LOWlXdkJUQm5PaUJINWswMDVuMjhGUzFhTXJIUHp5aXZYa29WTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vYWRhLjQyd2ViLmlvIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772942857),
('zVhaAL9kzxm1rkb6J4R6NNJiSPH28Cj7CFkcT59w', NULL, '89.227.209.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzd5VFdsbkFRYjBkWmg0YkQxVlRBN00yZmZEOHM0MWdtUWprM2lFUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYWRhLjQyd2ViLmlvLz9pPTEiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774266984);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yanis Admin', 'yanis.benkrouidem@gmail.com', NULL, '$2y$12$YocNYWJgtCyxSQsr00/78eOpSjBh88VYSKvqtXZLW2FRWuP6kyg2a', NULL, '2025-12-27 07:41:03', '2025-12-27 07:41:03');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` int(11) NOT NULL,
  `immat` varchar(20) NOT NULL,
  `marque` varchar(30) DEFAULT NULL,
  `modele` varchar(30) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `etatdeslieux` text DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id`, `immat`, `marque`, `modele`, `image`, `etatdeslieux`, `categorie_id`, `agence_id`) VALUES
(1, 'AX-971-DH', 'Peugeot', '108', 'peugeot_108.jpg', 'Très bon état', 101, 2),
(2, 'DH-456-QT', 'Mini', 'Countryman', 'mini_countryman.jpg', 'Bon état. 1 éraflure porte arrière droite', 106, 2),
(3, 'BV-830-XC', 'Peugeot', '208', 'peugeot_208.jpg', 'Bon état', 105, 1),
(10, 'GM-830-SP', 'Renault', 'Twingo', 'renault_twingo.jpg', 'Neuf', 101, 1),
(11, 'LM-450-PM', 'Citroën', 'C1', 'citroen_c1.jpg', 'Neuf', 102, 2),
(12, 'YB-744-KS', 'Fiat', '500', 'fiat_500.jpg', NULL, 112, 1),
(13, 'IN-402-BD', 'Renault', 'Twingo', 'renault_twingo_2.jpg', NULL, 115, 2),
(14, 'WA-237-YR', 'Renault', 'Clio 5', 'renault_clio5.jpg', NULL, 107, 1),
(15, 'RT-115-NS', 'Peugeot', '208', 'peugeot_208_new.jpg', NULL, 107, 1),
(16, 'CG-581-MJ', 'Renault', 'Captur', 'renault_captur.jpg', NULL, 109, 1),
(17, 'UP-885-IX', 'Peugeot', '2008', 'peugeot_2008.jpg', NULL, 115, 1),
(18, 'VB-327-BR', 'Renault', 'Megane', 'renault_megane.jpg', NULL, 101, 2),
(19, 'HO-354-BV', 'Peugeot', '308', 'peugeot_308.jpg', NULL, 119, 2),
(20, 'CJ-475-BC', 'Ford', 'Mondeo', 'ford_mondeo.jpg', NULL, 113, 1),
(21, 'FI-239-ZN', 'Mercedes', 'Classe A', 'mercedes_classe_a.jpg', NULL, 124, 2),
(22, 'OT-748-ER', 'BMW', 'Série 1', 'bmw_serie1.jpg', NULL, 118, 1),
(23, 'YQ-922-TU', 'Mercedes', 'Classe C', 'mercedes_classe_c.jpg', NULL, 122, 2),
(24, 'XV-927-ON', 'BMW', 'X5', 'bmw_x5.jpg', NULL, 121, 2),
(25, 'MH-535-UR', 'Renault', 'Trafic', 'renault_trafic.jpg', NULL, 120, 1),
(26, 'MU-489-LN', 'Mercedes', 'Sprinter', 'mercedes_sprinter.jpg', NULL, 115, 2),
(27, 'SB-532-QK', 'Iveco', 'Daily Hayon', 'iveco_daily.jpg', NULL, 108, 1),
(28, 'JN-269-JE', 'Yamaha', 'X-Max', 'yamaha_xmax.jpg', NULL, 111, 2),
(29, 'GZ-511-CM', 'Aixam', 'City', 'aixam_city.jpg', NULL, 117, 2),
(30, 'BA-660-RX', 'Tesla', 'Model 3', 'tesla_model3.jpg', NULL, 113, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agences`
--
ALTER TABLE `agences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agence_jour`
--
ALTER TABLE `agence_jour`
  ADD PRIMARY KEY (`agence_id`,`jour_id`),
  ADD KEY `FK_agencejour_jour` (`jour_id`);

--
-- Index pour la table `attributs`
--
ALTER TABLE `attributs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `attribut_categorie`
--
ALTER TABLE `attribut_categorie`
  ADD PRIMARY KEY (`categorie_id`,`attribut_id`),
  ADD KEY `FK_attributcategorie_attribut` (`attribut_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categorie_genre` (`genre_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client_cards`
--
ALTER TABLE `client_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `client_family`
--
ALTER TABLE `client_family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favori` (`client_id`,`vehicule_id`),
  ADD KEY `vehicule_id` (`vehicule_id`);

--
-- Index pour la table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jours`
--
ALTER TABLE `jours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_location_agence` (`agence_id`),
  ADD KEY `FK_location_client` (`client_id`),
  ADD KEY `FK_location_vehicule` (`vehicule_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panier_client_fk` (`client_id`),
  ADD KEY `panier_vehicule_fk` (`vehicule_id`),
  ADD KEY `panier_agencedep_fk` (`agence_depart_id`),
  ADD KEY `panier_agenceret_fk` (`agence_retour_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_vehicule_agence` (`agence_id`),
  ADD KEY `FK_vehicule_categorie` (`categorie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `client_cards`
--
ALTER TABLE `client_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client_family`
--
ALTER TABLE `client_family`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agence_jour`
--
ALTER TABLE `agence_jour`
  ADD CONSTRAINT `FK_agencejour_agence` FOREIGN KEY (`agence_id`) REFERENCES `agences` (`id`),
  ADD CONSTRAINT `FK_agencejour_jour` FOREIGN KEY (`jour_id`) REFERENCES `jours` (`id`);

--
-- Contraintes pour la table `attribut_categorie`
--
ALTER TABLE `attribut_categorie`
  ADD CONSTRAINT `FK_attributcategorie_attribut` FOREIGN KEY (`attribut_id`) REFERENCES `attributs` (`id`),
  ADD CONSTRAINT `FK_attributcategorie_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_categorie_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `FK_location_agence` FOREIGN KEY (`agence_id`) REFERENCES `agences` (`id`),
  ADD CONSTRAINT `FK_location_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_location_vehicule` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`);

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `panier_agencedep_fk` FOREIGN KEY (`agence_depart_id`) REFERENCES `agences` (`id`),
  ADD CONSTRAINT `panier_agenceret_fk` FOREIGN KEY (`agence_retour_id`) REFERENCES `agences` (`id`),
  ADD CONSTRAINT `panier_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `panier_vehicule_fk` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `FK_vehicule_agence` FOREIGN KEY (`agence_id`) REFERENCES `agences` (`id`),
  ADD CONSTRAINT `FK_vehicule_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
