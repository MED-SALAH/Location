-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 23 Novembre 2017 à 18:13
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet_708`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `numeroIterneClient` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` enum('M','Mme') NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  PRIMARY KEY (`numeroIterneClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`numeroIterneClient`, `civilite`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `dateNaissance`) VALUES
(1, 'M', 'hugo', 'Lorris', 'Reims 51100', '05647979756', 'hugo@lor.com', '1994-05-19'),
(2, 'M', 'karim', 'ok', 'Reims,51100', '0754083248', 'idr.karim90@gmail.com', '2017-11-02');

-- --------------------------------------------------------

--
-- Structure de la table `comptoir`
--

CREATE TABLE IF NOT EXISTS `comptoir` (
  `idComptoir` int(11) NOT NULL AUTO_INCREMENT,
  `adresseComptoir` varchar(255) NOT NULL,
  PRIMARY KEY (`idComptoir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `comptoir`
--

INSERT INTO `comptoir` (`idComptoir`, `adresseComptoir`) VALUES
(1, 'Reims'),
(2, 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `numeroIterneLocation` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebutLoc` date NOT NULL,
  `dateFinLoc` date NOT NULL,
  `dateFacturation` date NOT NULL,
  `totalAchat` varchar(255) NOT NULL,
  `totalTva` varchar(255) NOT NULL,
  `totalTtc` varchar(255) NOT NULL,
  `numeroInterneClient` int(11) NOT NULL,
  `numeroInternePorduit` int(11) NOT NULL,
  PRIMARY KEY (`numeroIterneLocation`),
  KEY `numeroInterne` (`numeroInterneClient`),
  KEY `numeroInterneClient` (`numeroInternePorduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`numeroIterneLocation`, `dateDebutLoc`, `dateFinLoc`, `dateFacturation`, `totalAchat`, `totalTva`, `totalTtc`, `numeroInterneClient`, `numeroInternePorduit`) VALUES
(7, '2017-11-10', '2017-11-05', '0000-00-00', '', '', '', 1, 1),
(8, '2017-11-09', '2017-11-18', '0000-00-00', '', '', '', 1, 2),
(9, '2017-11-22', '2017-11-30', '0000-00-00', '', '', '', 1, 4),
(10, '2017-11-16', '2017-11-26', '0000-00-00', '', '', '', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `idNot` int(11) NOT NULL AUTO_INCREMENT,
  `idE` int(11) NOT NULL,
  `idR` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `idP` int(11) NOT NULL,
  PRIMARY KEY (`idNot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`idNot`, `idE`, `idR`, `etat`, `info`, `idP`) VALUES
(12, 2, 1, 'non confirme', 'false', 2),
(13, 2, 1, 'non confirme', 'false', 4),
(14, 2, 1, 'confirme', 'false', 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `libelleProduit` varchar(11) NOT NULL,
  `prixHt` varchar(11) NOT NULL,
  `tauxTva` varchar(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `etat` enum('louer','non louer') NOT NULL,
  `adresse` text NOT NULL,
  `img` text NOT NULL,
  `idTypeProduit` int(11) NOT NULL,
  `idComptoir` int(11) NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `idComptoir` (`idComptoir`),
  KEY `idTypeProduit` (`idTypeProduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `libelleProduit`, `prixHt`, `tauxTva`, `description`, `etat`, `adresse`, `img`, `idTypeProduit`, `idComptoir`) VALUES
(1, 'tendeuse', '10', '15', 'tendeuse pour les barbes ', 'louer', '', 'tondeuse.jpg', 2, 1),
(2, 'ferrari', '15000', '20000', 'une voiture ferrari sport', 'louer', '', 'ferrari.jpg', 1, 2),
(3, 'Audi A4', '35000', '19.2', 'Une audi a4', 'louer', '', 'audiA4.jpg', 1, 1),
(4, 'Audi R8', '60000', '20', 'une audi R8', 'louer', '', 'audiR8.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebutRes` date NOT NULL,
  `dateFinRes` date NOT NULL,
  `numeroInternePorduit` int(11) NOT NULL,
  `numeroInterneClient` int(11) NOT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `idProduit` (`numeroInternePorduit`),
  KEY `idClient` (`numeroInterneClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `typeproduit`
--

CREATE TABLE IF NOT EXISTS `typeproduit` (
  `idTypeProduit` int(11) NOT NULL AUTO_INCREMENT,
  `libelleTypeProduit` varchar(255) NOT NULL,
  PRIMARY KEY (`idTypeProduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `typeproduit`
--

INSERT INTO `typeproduit` (`idTypeProduit`, `libelleTypeProduit`) VALUES
(1, 'Vehicule'),
(2, 'Dangereux');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `passe` varchar(255) NOT NULL,
  `type` enum('client','gerant','admin') NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `passe`, `type`, `idUser`) VALUES
(1, 'hugo', 'hugo', 'client', 1),
(2, 'karim', 'karim', 'client', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`numeroInterneClient`) REFERENCES `client` (`numeroIterneClient`),
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`numeroInternePorduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`idComptoir`) REFERENCES `comptoir` (`idComptoir`),
  ADD CONSTRAINT `produit_ibfk_3` FOREIGN KEY (`idTypeProduit`) REFERENCES `typeproduit` (`idTypeProduit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
