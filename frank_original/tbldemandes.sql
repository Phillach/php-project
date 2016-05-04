-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Mars 2016 à 14:52
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbinfoshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbldemandes`
--

CREATE TABLE `tbldemandes` (
  `ID` int(11) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `Objet` varchar(250) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `DateDemande` date NOT NULL,
  `DateRequise` date NOT NULL,
  `Statut` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbldemandes`
--

INSERT INTO `tbldemandes` (`ID`, `Prenom`, `Nom`, `Type`, `Objet`, `Description`, `DateDemande`, `DateRequise`, `Statut`) VALUES
(1, 'dfghdfgh', 'dfghdfg', 'dfghdf', 'dfghdfg', 'dfghdfg', '2016-03-01', '2016-03-10', 'dfhgdfg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbldemandes`
--
ALTER TABLE `tbldemandes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tbldemandes`
--
ALTER TABLE `tbldemandes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
