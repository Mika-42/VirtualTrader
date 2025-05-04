-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 02 mai 2025 à 08:29
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `virtualtrader`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE `action` (
  `code` varchar(5) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `value` float DEFAULT NULL,
  `distribDate` date DEFAULT NULL,
  `nbDetenue` int(11) DEFAULT 0,
  `evolution` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`code`, `name`, `description`, `value`, `distribDate`, `nbDetenue`, `evolution`) VALUES
('AAPL', 'Apple Inc.', 'Technologie, fabricant de produits électroniques.', 200, '2025-04-21', 0, -5.07),
('AMZN', 'Amazon.com Inc.', 'E-commerce, services cloud.', 175, '2025-04-21', 0, -8.7),
('BA', 'Boeing Co.', 'Aéronautique et défense.', 160, '2025-04-21', 0, -4.12),
('GOOGL', 'Alphabet Inc.', 'Secteur technologique, maison-mère de Google.', 155, '2025-04-21', 0, 4.37),
('JNJ', 'Johnson & Johnson', 'Secteur pharmaceutique et produits de soins de santé.', 160, '2025-04-21', 0, 9.35),
('KO', 'Coca-Cola Company', 'Boissons non alcoolisées.', 75, '2025-04-21', 0, -0.8),
('MSFT', 'Microsoft Corporatio', 'Technologie, logiciels et services cloud.', 370, '2025-04-21', 0, -9.66),
('NKE', 'Nike Inc.', 'Vêtements et équipements sportifs.', 55, '2025-04-21', 0, -2.88),
('TSLA', 'Tesla', ' Automobile, spécialisé dans les véhicules électriques.', 240, '2025-04-21', 0, 0.85),
('V', 'Visa Inc.', 'Services financiers et paiements électroniques.', 330, '2025-04-21', 0, -4.69);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `code_action` varchar(5) NOT NULL,
  `value_date` date NOT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `balance` float DEFAULT 10000,
  `balanceAction` float DEFAULT 0,
  `gameDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`code_action`,`value_date`);

--
-- Index pour la table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`code_action`) REFERENCES `action` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
