-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 07 mai 2025 à 09:40
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
DROP DATABASE IF EXISTS VirtualTrader;
CREATE DATABASE IF NOT EXISTS VirtualTrader;
USE VirtualTrader;
-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE `action` (
  `code` varchar(5) NOT NULL PRIMARY KEY,
  `name` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `value` float DEFAULT 0,
  `evolution` float DEFAULT 0,
  `default_value`float DEFAULT 0,
  `default_evolution` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`code`, `name`, `description`, `value`, `evolution`) VALUES
('AAPL', 'Apple Inc.', 'Technologie, fabricant de produits électroniques.', 20400, -5.07),
('AMZN', 'Amazon.com Inc.', 'E-commerce, services cloud.', 3575, -8.7),
('BA', 'Boeing Co.', 'Aéronautique et défense.', 7660, -4.12),
('GOOGL', 'Alphabet Inc.', 'Secteur technologique, maison-mère de Google.', 155,  4.37),
('JNJ', 'Johnson & Johnson', 'Secteur pharmaceutique et produits de soins de santé.', 160, 9.35),
('KO', 'Coca-Cola Company', 'Boissons non alcoolisées.', 10075, -0.8),
('MSFT', 'Microsoft Corporation', 'Technologie, logiciels et services cloud.', 370,  -9.66),
('NKE', 'Nike Inc.', 'Vêtements et équipements sportifs.', 555,  -2.88),
('TSLA', 'Tesla', ' Automobile, spécialisé dans les véhicules électriques.', 279,  0.85),
('V', 'Visa Inc.', 'Services financiers et paiements électroniques.', 38739, -4.69),
('NVDA', 'NVIDIA Corporation', 'Technologie, processeurs graphiques et intelligence artificielle.', 180880, 81.49),
('PG', 'Procter & Gamble Co.', 'Biens de consommation, produits d''hygiène et ménagers.', 2267, 2.06),
('MCD', 'McDonald''s Corporation', 'Restauration rapide.', 9613, 4.42),
('BRK', 'Berkshire Hathaway', 'Géant financier dirigé par Warren Buffett.', 555000, 0);
UPDATE `action` SET `default_value` = `value`, `default_evolution` = `evolution` WHERE TRUE;
-- --------------------------------------------------------
--
-- Structure de la table `historique`
--

-- --------------------------------------------------------
--
-- Structure de la table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `balance` float DEFAULT 10000,
  `gameDate` date DEFAULT '2000-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ownby`
--

CREATE TABLE `ownby` (
 `actionCode` varchar(5) NOT NULL,
 `playerId` int(11) NOT NULL,
 PRIMARY KEY (`actionCode`, `playerId`),
 FOREIGN KEY (`actionCode`) REFERENCES action(`code`),
 FOREIGN KEY (`playerId`) REFERENCES player(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
