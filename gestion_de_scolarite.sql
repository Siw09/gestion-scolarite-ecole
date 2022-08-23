-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 mai 2022 à 19:23
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_de_scolarite`
--

-- --------------------------------------------------------

--
-- Structure de la table `coefficient`
--

DROP TABLE IF EXISTS `coefficient`;
CREATE TABLE IF NOT EXISTS `coefficient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codefil` varchar(255) NOT NULL,
  `codemat` varchar(255) NOT NULL,
  `coef` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codefil` (`codefil`),
  KEY `codemat` (`codemat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `composition`
--

DROP TABLE IF EXISTS `composition`;
CREATE TABLE IF NOT EXISTS `composition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numins` int(11) NOT NULL,
  `datecomp` date NOT NULL,
  `notecomp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numins` (`numins`),
  KEY `datecomp` (`datecomp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `echeance`
--

DROP TABLE IF EXISTS `echeance`;
CREATE TABLE IF NOT EXISTS `echeance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numins` int(11) NOT NULL,
  `numech` int(11) NOT NULL,
  `datech` date NOT NULL,
  `montech` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numins` (`numins`),
  KEY `numech` (`numech`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `matricule` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `filliere`
--

DROP TABLE IF EXISTS `filliere`;
CREATE TABLE IF NOT EXISTS `filliere` (
  `codefil` varchar(255) NOT NULL,
  `libfil` varchar(255) NOT NULL,
  `cout` int(11) NOT NULL,
  PRIMARY KEY (`codefil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `numins` int(11) NOT NULL AUTO_INCREMENT,
  `dateinscription` date NOT NULL,
  `anne` year(4) NOT NULL,
  `matricule` int(11) NOT NULL,
  `codefil` varchar(255) NOT NULL,
  PRIMARY KEY (`numins`),
  KEY `matricule` (`matricule`),
  KEY `codefil` (`codefil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `codmat` varchar(255) NOT NULL,
  `libmat` varchar(255) NOT NULL,
  PRIMARY KEY (`codmat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

DROP TABLE IF EXISTS `reglement`;
CREATE TABLE IF NOT EXISTS `reglement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datreg` date NOT NULL,
  `numins` int(11) NOT NULL,
  `numech` int(11) NOT NULL,
  `montreg` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `datreg` (`datreg`),
  KEY `numins` (`numins`),
  KEY `numech` (`numech`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `coefficient`
--
ALTER TABLE `coefficient`
  ADD CONSTRAINT `coefficient_filiere_codefil` FOREIGN KEY (`codefil`) REFERENCES `filliere` (`codefil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coefficient_matiere_codemat` FOREIGN KEY (`codemat`) REFERENCES `matiere` (`codmat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `composition`
--
ALTER TABLE `composition`
  ADD CONSTRAINT `composition_inscription_numins` FOREIGN KEY (`numins`) REFERENCES `inscription` (`numins`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `echeance`
--
ALTER TABLE `echeance`
  ADD CONSTRAINT `echeance_inscription_numins` FOREIGN KEY (`numins`) REFERENCES `inscription` (`numins`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_etudiants_matricule` FOREIGN KEY (`matricule`) REFERENCES `etudiants` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_filiere_codefil` FOREIGN KEY (`codefil`) REFERENCES `filliere` (`codefil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD CONSTRAINT `reglement_echeance_numech` FOREIGN KEY (`numech`) REFERENCES `echeance` (`numech`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reglement_inscription_numins` FOREIGN KEY (`numins`) REFERENCES `inscription` (`numins`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
