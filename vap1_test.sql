-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 01 Novembre 2017 à 11:34
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `vap1_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectaationmembre`
--

CREATE TABLE IF NOT EXISTS `affectaationmembre` (
  `dateAffectation` date DEFAULT NULL,
  `idMembre` int(11) NOT NULL,
  `idT` int(11) NOT NULL,
  PRIMARY KEY (`idMembre`,`idT`),
  KEY `FK_affectaationMembre_idT` (`idT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `affprojetmembre`
--

CREATE TABLE IF NOT EXISTS `affprojetmembre` (
  `dateAffP` date DEFAULT NULL,
  `idProjet` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  PRIMARY KEY (`idProjet`,`idMembre`),
  KEY `FK_AffProjetMembre_idMembre` (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `checkliste`
--

CREATE TABLE IF NOT EXISTS `checkliste` (
  `idCheckliste` int(11) NOT NULL AUTO_INCREMENT,
  `nomCheckliste` varchar(255) DEFAULT NULL,
  `idProjet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCheckliste`),
  KEY `FK_checkliste_idProjet` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idC` int(11) NOT NULL AUTO_INCREMENT,
  `cinC` varchar(25) DEFAULT NULL,
  `nomC` varchar(25) DEFAULT NULL,
  `prenomC` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `idEntreprise` int(11) NOT NULL AUTO_INCREMENT,
  `nomEntreprise` varchar(250) DEFAULT NULL,
  `adresseEntreprise` varchar(250) DEFAULT NULL,
  `telEntreprise` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idEntreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`idEntreprise`, `nomEntreprise`, `adresseEntreprise`, `telEntreprise`) VALUES
(1, 'BMW', 'almagne', '0084002541'),
(2, 'google', 'états unis', '+12548798852');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `idMembre` int(11) NOT NULL AUTO_INCREMENT,
  `nomMembre` varchar(255) DEFAULT NULL,
  `prenomMembre` varchar(255) DEFAULT NULL,
  `mdpMembre` varchar(255) DEFAULT NULL,
  `emailMembre` varchar(255) DEFAULT NULL,
  `telMembre` varchar(255) DEFAULT NULL,
  `fonctionMembre` varchar(255) NOT NULL,
  `roleMembre` varchar(255) NOT NULL DEFAULT 'admin',
  `compteActive` int(2) NOT NULL DEFAULT '0',
  `activationToken` varchar(255) NOT NULL,
  `idEntreprise` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMembre`),
  KEY `FK_membre_idEntreprise` (`idEntreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`idMembre`, `nomMembre`, `prenomMembre`, `mdpMembre`, `emailMembre`, `telMembre`, `fonctionMembre`, `roleMembre`, `compteActive`, `activationToken`, `idEntreprise`) VALUES
(1, 'nouriddin', '', '', '', NULL, '', 'admin', 1, '', 2),
(2, 'adil', '', '', '', NULL, '', 'admin', 1, '', 1),
(3, 'adilo', 'Benz', '74107410', 'benz@gmail.com', NULL, '', 'admin', 1, '', 1),
(4, 'Rabab', 'chahboune', '74107410', 'rabab@gmail.com', NULL, '', 'admin', 1, '', 2),
(5, 'n', 'Benz', '74107410', 'benzn@gmail.com', NULL, '', 'admin', 0, 'd41d8cd98f00b204e9800998ecf8427e', 1),
(6, 'nori', 'ben', '1178692fc49d8631a6aec13891b0522d', 'z@gmail.com', NULL, '', 'admin', 0, 'd41d8cd98f00b204e9800998ecf8427e', 1),
(12, 'nouriddin', 'Benzz', '1178692fc49d8631a6aec13891b0522d', 'nouriddinbnz@gmail.comm', NULL, '', 'admin', 1, '197ed43740c4763b58b55915a46add27', 2),
(13, 'nouriddinn', 's', '1178692fc49d8631a6aec13891b0522d', 'nouriddinbnz@gmail.com0', NULL, '', 'admin', 1, '574f861e5b0c1c984ad3f5c925727b01', 1),
(19, 'nouriddin', 'Ben', '1178692fc49d8631a6aec13891b0522d', 'nouriddin.benzekri@gmail.com', NULL, '', 'admin', 1, '1178692fc49d8631a6aec13891b0522d', 2),
(23, 'nouriddin', 'BEN ZEKRI', '1178692fc49d8631a6aec13891b0522d', 'nouriddinbnz@gmail.com', NULL, '', 'admin', 1, '197ed43740c4763b58b55915a46add27', 1),
(24, 'Reda', 'Pich Pich ', '1178692fc49d8631a6aec13891b0522d', 'medredabenchraa@gmail.com', NULL, '', 'admin', 0, 'a5ea11ec19019b889c0561768df2eb66', 2),
(25, 'Chahboun', 'Rabab - the Female God', '1178692fc49d8631a6aec13891b0522d', 'rabab.chahboune@gmail.com', NULL, '', 'admin', 0, 'c22789d28d39954a0de9a48220d25999', 2),
(26, 'nouriddin', 'Benzzzzz', '1178692fc49d8631a6aec13891b0522d', 'benz.morocco@gmail.com', NULL, '', 'admin', 0, 'a3ee7eae0529d78a4f37f2d52237ee48', 2);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
  `nomProjet` varchar(255) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `idC` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProjet`),
  KEY `FK_projet_idC` (`idC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `idQ` int(11) NOT NULL AUTO_INCREMENT,
  `question1` text,
  `idRu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idQ`),
  KEY `FK_question_idRu` (`idRu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `questionvalidationprojet`
--

CREATE TABLE IF NOT EXISTS `questionvalidationprojet` (
  `idQVP` int(11) NOT NULL AUTO_INCREMENT,
  `qst1` varchar(255) DEFAULT NULL,
  `qst2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idQVP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reeunion`
--

CREATE TABLE IF NOT EXISTS `reeunion` (
  `idR` int(11) NOT NULL AUTO_INCREMENT,
  `dateR` date DEFAULT NULL,
  `objectifR` varchar(255) DEFAULT NULL,
  `idProjet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idR`),
  KEY `FK_reeunion_idProjet` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `idRep` int(11) NOT NULL AUTO_INCREMENT,
  `rep1` text,
  `idQ` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRep`),
  KEY `FK_reponse_idQ` (`idQ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE IF NOT EXISTS `rubrique` (
  `idRu` int(11) NOT NULL AUTO_INCREMENT,
  `nomRu` varchar(255) DEFAULT NULL,
  `idCheckliste` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRu`),
  KEY `FK_rubrique_idCheckliste` (`idCheckliste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
  `idT` int(11) NOT NULL AUTO_INCREMENT,
  `intituleT` varchar(255) DEFAULT NULL,
  `dateDebutT` date DEFAULT NULL,
  `dateFinT` date DEFAULT NULL,
  `idR` int(11) DEFAULT NULL,
  PRIMARY KEY (`idT`),
  KEY `FK_tache_idR` (`idR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `validationprojet`
--

CREATE TABLE IF NOT EXISTS `validationprojet` (
  `idV` int(11) NOT NULL AUTO_INCREMENT,
  `q1` text,
  `idProjet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idV`),
  KEY `FK_validationprojet_idProjet` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `affectaationmembre`
--
ALTER TABLE `affectaationmembre`
  ADD CONSTRAINT `FK_affectaationMembre_idMembre` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`),
  ADD CONSTRAINT `FK_affectaationMembre_idT` FOREIGN KEY (`idT`) REFERENCES `tache` (`idT`);

--
-- Contraintes pour la table `affprojetmembre`
--
ALTER TABLE `affprojetmembre`
  ADD CONSTRAINT `FK_AffProjetMembre_idMembre` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`),
  ADD CONSTRAINT `FK_AffProjetMembre_idProjet` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`);

--
-- Contraintes pour la table `checkliste`
--
ALTER TABLE `checkliste`
  ADD CONSTRAINT `FK_checkliste_idProjet` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_membre_idEntreprise` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `FK_projet_idC` FOREIGN KEY (`idC`) REFERENCES `client` (`idC`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_question_idRu` FOREIGN KEY (`idRu`) REFERENCES `rubrique` (`idRu`);

--
-- Contraintes pour la table `reeunion`
--
ALTER TABLE `reeunion`
  ADD CONSTRAINT `FK_reeunion_idProjet` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_reponse_idQ` FOREIGN KEY (`idQ`) REFERENCES `question` (`idQ`);

--
-- Contraintes pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD CONSTRAINT `FK_rubrique_idCheckliste` FOREIGN KEY (`idCheckliste`) REFERENCES `checkliste` (`idCheckliste`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `FK_tache_idR` FOREIGN KEY (`idR`) REFERENCES `reeunion` (`idR`);

--
-- Contraintes pour la table `validationprojet`
--
ALTER TABLE `validationprojet`
  ADD CONSTRAINT `FK_validationprojet_idProjet` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
