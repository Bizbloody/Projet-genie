-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 05 juin 2024 à 09:27
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
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `associations`
--

CREATE TABLE `associations` (
  `ID` tinyint(30) NOT NULL,
  `nom` tinytext NOT NULL,
  `pseudo` tinytext NOT NULL,
  `mdp` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `associations`
--

INSERT INTO `associations` (`ID`, `nom`, `pseudo`, `mdp`) VALUES
(2, 'bizou', 'bibi', ''),
(3, 'blabla', 'blabla', '$2y$10$Pz79GPpyyc9nkhtjsBhcHeD.CHOCBZ747fIaUZhE6l3rY7cA3IUWW'),
(4, 'blabla2', 'blabla2', '$2y$10$kkoHHKAISfPojLEUMORy0u4RtdQYLDO0OXlJU66NQM6fJ5MtRqSAG');

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
  `taille` varchar(255) NOT NULL,
  `description_taille` varchar(200) DEFAULT NULL,
  `etage` int(11) NOT NULL,
  `description_lieu` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`ID`, `ID_association`, `nom`, `NDC_NDL`, `type`, `taille`, `description_taille`, `etage`, `description_lieu`) VALUES
(1, 2, 'Stockage 1', 'NDL', 'armoire', 'Grand', NULL, 1, NULL);

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
-- Index pour les tables déchargées
--

--
-- Index pour la table `associations`
--
ALTER TABLE `associations`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `lieu_ibfk_1` FOREIGN KEY (`ID_association`) REFERENCES `associations` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_lieu`) REFERENCES `lieu` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ID_association`) REFERENCES `associations` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
