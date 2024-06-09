-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 09 juin 2024 à 14:19
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet-cabrel`
--

-- --------------------------------------------------------

--
-- Structure de la table `associations`
--

CREATE TABLE `associations` (
  `ID` tinyint(30) NOT NULL,
  `role` tinytext NOT NULL,
  `pseudo` tinytext NOT NULL,
  `mdp` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `associations`
--

INSERT INTO `associations` (`ID`, `role`, `pseudo`, `mdp`) VALUES
(1, 'Association', 'IsHelp', '$2y$10$E7M2cUkP23S8/PA.XEIBr.upunlu/bPGN3vEsmqbF4rbwAUTq4L7W'),
(2, 'Admin', 'admin', '$2y$10$EF5Iz04z1DCGaVfqUoRY7erjBkDQfp6pytHLeheWcXhuk2zoTl18e'),
(3, 'Association', 'IGC', '$2y$10$wawQ1NIAsIolu27dm9N7Q.HGSSlOagOzf.HHAT.m1/4.OSQKAk9De'),
(4, 'Association', 'BTR', '$2y$10$XcTsm3s5fKRp9eRbj5bJiObkMeGP1igdolO8n5uUSCE/G2tsoXfOm');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `ID` tinyint(30) NOT NULL,
  `ID_association` tinyint(30) DEFAULT NULL,
  `nom` text NOT NULL,
  `NDC_NDL` varchar(3) NOT NULL,
  `type` varchar(255) NOT NULL,
  `etage` int(11) NOT NULL,
  `description_lieu` varchar(300) DEFAULT NULL,
  `largeur` int(11) NOT NULL,
  `profondeur` int(11) NOT NULL,
  `longueur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`ID`, `ID_association`, `nom`, `NDC_NDL`, `type`, `etage`, `description_lieu`, `largeur`, `profondeur`, `longueur`) VALUES
(1, 2, 'Stockage 1', 'NDL', 'Armoire', 1, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID` tinyint(30) NOT NULL,
  `ID_association` tinyint(30) NOT NULL,
  `ID_lieu` tinyint(30) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ID`, `ID_association`, `ID_lieu`, `date_debut`, `date_fin`, `status`) VALUES
(1, 4, 1, '2024-06-10', '2024-06-12', 'good'),
(2, 4, 1, '2024-06-25', '2024-06-27', 'good');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `associations`
--
ALTER TABLE `associations`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `pseudo` (`pseudo`) USING HASH;

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_association` (`ID_association`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_association` (`ID_association`),
  ADD KEY `ID_lieu` (`ID_lieu`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `associations`
--
ALTER TABLE `associations`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `lieu_ibfk_1` FOREIGN KEY (`ID_association`) REFERENCES `associations` (`ID`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_association`) REFERENCES `associations` (`ID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ID_lieu`) REFERENCES `lieu` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
