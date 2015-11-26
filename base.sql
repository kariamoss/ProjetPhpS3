-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 26 Novembre 2015 à 09:51
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet_2_s3`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_lieu` int(11) NOT NULL,
  `prix` float(5,2) NOT NULL,
  `date_achat` date NOT NULL,
  `id_etat` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_user` (`id_user`),
  KEY `id_lieu` (`id_lieu`),
  KEY `id_etat` (`id_etat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_user`, `id_lieu`, `prix`, `date_achat`, `id_etat`) VALUES
(1, 3, 1, 0.00, '2001-01-01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id_etat`, `libelle`) VALUES
(1, 'A préparer'),
(2, 'Expédié');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float(5,2) NOT NULL,
  `id_commande` int(1) NOT NULL,
  `dateAjoutPanier` datetime NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `id_user` (`id_user`),
  KEY `id_produit` (`id_produit`),
  KEY `panier_fk_3` (`id_commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_user`, `id_produit`, `quantite`, `prix`, `id_commande`, `dateAjoutPanier`) VALUES
(23, 6, 4, 7, 999.99, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_type` int(10) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prix` float(5,2) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `dispo` tinyint(4) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `id_type`, `nom`, `prix`, `photo`, `dispo`, `stock`) VALUES
(5, 1, 'GTX 970', 299.99, '970.png', 3, 3),
(4, 1, 'GTX 960', 189.99, '960.png', 2, 3),
(3, 1, 'GTX 950', 179.00, '950.jpg', 1, 10),
(2, 2, 'R9 270', 94.99, '270.jpg', 1, 4),
(1, 2, 'R9 380', 229.99, '380.jpg', 1, 5),
(6, 1, 'GTX 980', 499.99, '980.jpg', 2, 5),
(7, 2, 'R9 290X', 189.98, '290x.jpg', 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `typeproduit`
--

CREATE TABLE IF NOT EXISTS `typeproduit` (
  `id_type` int(10) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typeproduit`
--

INSERT INTO `typeproduit` (`id_type`, `libelle`) VALUES
(1, 'nVidia'),
(2, 'AMD');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `valide` tinyint(4) NOT NULL,
  `droit` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `login`, `nom`, `code_postal`, `ville`, `adresse`, `valide`, `droit`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', '', '', '', '', 1, 2),
(2, 'vendeur@gmail.com', 'vendeur', 'vendeur', '', '', '', '', 1, 2),
(3, 'client@gmail.com', 'client', 'client', '', '', '', '', 1, 1),
(4, 'client2@gmail.com', 'client2', 'client2', '', '', '', '', 1, 1),
(5, 'client3@gmail.com', 'client3', 'client3', '', '', '', '', 1, 1),
(6, 'toto@gmail.com', 'toto', 'toto', '', '', '', '', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
