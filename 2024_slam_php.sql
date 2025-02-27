-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 fév. 2025 à 08:26
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `2024_slam_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id_ticket` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prestation` int NOT NULL,
  `nombre` int NOT NULL,
  PRIMARY KEY (`id_ticket`,`id_prestation`),
  KEY `id_prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `libelle_categorie` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `libelle_categorie`) VALUES
(1, 'Petits revenus'),
(2, 'Revenus moyens'),
(3, 'Gros revenus'),
(4, 'Visiteurs');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id_carte` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_depot` date NOT NULL,
  `montant` int NOT NULL,
  PRIMARY KEY (`id_carte`,`date_depot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id_droits` int NOT NULL AUTO_INCREMENT,
  `libelle_droits` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_droits`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id_droits`, `libelle_droits`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
CREATE TABLE IF NOT EXISTS `prestation` (
  `id_prestation` int NOT NULL AUTO_INCREMENT,
  `type_prestation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_prestation`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id_prestation`, `type_prestation`) VALUES
(1, 'Plat principal'),
(2, 'Plat + Dessert'),
(3, 'Entrée + Plat'),
(4, 'Supplément Entrée'),
(5, 'Supplément dessert'),
(6, 'Repas complet'),
(7, 'Alcool'),
(8, 'Apéritif'),
(9, 'Soda'),
(11, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_prestation` int NOT NULL,
  `id_categorie` int NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_prestation`,`id_categorie`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_prestation`, `id_categorie`, `prix`) VALUES
(1, 1, 2.5),
(1, 2, 2.7),
(1, 3, 3.1),
(1, 4, 5),
(2, 1, 3.1),
(2, 2, 3.8),
(2, 3, 4.5),
(2, 4, 7),
(3, 1, 2.9),
(3, 2, 3.1),
(3, 3, 3.7),
(3, 4, 6.5),
(4, 1, 0.2),
(4, 2, 0.4),
(4, 3, 0.9),
(4, 4, 1.2),
(5, 1, 0.15),
(5, 2, 0.3),
(5, 3, 0.7),
(5, 4, 1.1),
(6, 1, 3.8),
(6, 2, 4),
(6, 3, 4.3),
(6, 4, 9),
(7, 1, 1.2),
(7, 2, 1.3),
(7, 3, 1.5),
(7, 4, 2),
(8, 1, 1.3),
(8, 2, 1.4),
(8, 3, 1.6),
(8, 4, 2.1),
(9, 1, 0.8),
(9, 2, 0.9),
(9, 3, 1),
(9, 4, 1.3),
(11, 1, 60);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_carte` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `id_carte` (`id_carte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `id_carte` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_categorie` int NOT NULL,
  `montant_caution` int NOT NULL,
  `date_carte` date NOT NULL,
  PRIMARY KEY (`id_carte`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `usager`
--

INSERT INTO `usager` (`id_carte`, `nom`, `id_categorie`, `montant_caution`, `date_carte`) VALUES
('C10', 'Francesca Briggs', 2, 9, '2022-08-16'),
('C11', 'Abdul Weiss', 2, 9, '2022-09-19'),
('C12', 'Rinah Reilly', 1, 8, '2022-09-11'),
('C13', 'Kimberley Bryan', 1, 9, '2022-09-17'),
('C14', 'Galena Keller', 1, 7, '2022-08-16'),
('C15', 'Francesca Briggs', 1, 9, '2022-08-16'),
('C2', 'Murphy Lane', 2, 9, '2022-08-15'),
('C3', 'Hillary Garza', 2, 7, '2022-09-07'),
('C4', 'Ciaran Ball', 3, 6, '2022-09-11'),
('C5', 'Kirsten Norton', 3, 7, '2022-09-28'),
('C6', 'Abdul Weiss', 3, 9, '2022-09-19'),
('C7', 'Rinah Reilly', 1, 8, '2022-09-11'),
('C8', 'Kimberley Bryan', 3, 9, '2022-09-17'),
('C9', 'Galena Keller', 4, 7, '2022-08-16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `droits` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `droits` (`droits`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `droits`) VALUES
(4, 'Killian', 'Théo', 'theo.killian5700@Gmail.com', '$2y$10$r3ocT4sAPt/pCTHu5lMBQuvGArJyiNeeRe3/FrA7X0O6jIxD.gg7u', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `achat_ibfk_1` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id_prestation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_ibfk_2` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `depot_ibfk_1` FOREIGN KEY (`id_carte`) REFERENCES `usager` (`id_carte`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id_prestation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_carte`) REFERENCES `usager` (`id_carte`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `usager`
--
ALTER TABLE `usager`
  ADD CONSTRAINT `usager_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`droits`) REFERENCES `droits` (`id_droits`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
