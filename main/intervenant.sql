-- phpMyAdmin SQL Dump
-- version 2.6.0-rc1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mardi 11 Janvier 2005 à 11:30
-- Version du serveur: 3.23.58
-- Version de PHP: 4.2.2
-- 
-- Base de données: `intervention`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `intervenant`
-- 

CREATE TABLE `intervenant` (
  `idintervenant` mediumint(8) unsigned NOT NULL auto_increment,
  `code` varchar(7) NOT NULL default '',
  `nom` varchar(255) NOT NULL default '',
  `prenom` varchar(255) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `inter` char(1) NOT NULL default '',
  PRIMARY KEY  (`idintervenant`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Contenu de la table `intervenant`
-- 

INSERT INTO `intervenant` VALUES (1, 'M62MDAM', 'Damie', 'Mickael', '12b3638553c1f4a535a047e7003d9ac4', 'damie.mickael@msa62.msa.fr', '1');
INSERT INTO `intervenant` VALUES (2, 'M62YTIL', 'Tilliette', 'Yvan', '6cc02a857c3235736e2d181c7144232b', 'tilliette.yvan@msa62.msa.fr', '1');
INSERT INTO `intervenant` VALUES (3, 'M62SLAM', 'Lambert', 'Sébastien', '8399b576723c5b942adabc54f18ca97b', 'lambert.sebastien@msa62.msa.fr', '1');
INSERT INTO `intervenant` VALUES (4, 'M62VBOC', 'Bocquet', 'Vincent', '4f9b50895cdd24488503da0975207be2', 'bocquet.vincent@msa62.msa.fr', '1');
INSERT INTO `intervenant` VALUES (5, 'M62SFLA', 'Szymanek', 'Sandra', '', '', '0');
INSERT INTO `intervenant` VALUES (6, 'M62DBRU', 'Brunet', 'Didier', '22db4a45a1f11865391270fa94dd7696', 'brunet.didier@msa62.msa.fr', '0');
