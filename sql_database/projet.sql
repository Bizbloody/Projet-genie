-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 09:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `associations`
--

CREATE TABLE `associations` (
  `ID` tinyint(30) NOT NULL,
  `nom` tinytext NOT NULL,
  `pseudo` tinytext NOT NULL,
  `mdp` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `associations`
--

INSERT INTO `associations` (`ID`, `nom`, `pseudo`, `mdp`) VALUES
(2, 'bizou', 'bibi', ''),
(3, 'blabla', 'blabla', '$2y$10$Pz79GPpyyc9nkhtjsBhcHeD.CHOCBZ747fIaUZhE6l3rY7cA3IUWW'),
(4, 'blabla2', 'blabla2', '$2y$10$kkoHHKAISfPojLEUMORy0u4RtdQYLDO0OXlJU66NQM6fJ5MtRqSAG');

-- --------------------------------------------------------

--
-- Table structure for table `lieu`
--

CREATE TABLE `lieu` (
  `ID` tinyint(30) NOT NULL,
  `ID_association` tinyint(30) DEFAULT NULL,
  `nom` text NOT NULL,
  `NDC_NDL` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `associations`
--
ALTER TABLE `associations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_association` (`ID_association`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_association` (`ID_association`),
  ADD KEY `ID_lieu` (`ID_lieu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associations`
--
ALTER TABLE `associations`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID` tinyint(30) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `lieu_ibfk_1` FOREIGN KEY (`ID_association`) REFERENCES `associations` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_lieu`) REFERENCES `lieu` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ID_association`) REFERENCES `associations` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
