-- phpMyAdmin SQL Dump
-- version 2.6.0-rc1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mardi 11 Janvier 2005 à 11:29
-- Version du serveur: 3.23.58
-- Version de PHP: 4.2.2
-- 
-- Base de données: `intervention`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `evenement`
-- 

CREATE TABLE `evenement` (
  `idevenement` mediumint(8) unsigned NOT NULL auto_increment,
  `libevent` varchar(255) NOT NULL default '',
  `codehex` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`idevenement`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `evenement`
-- 

INSERT INTO `evenement` VALUES (1, 'CONGES', '#0000FF');
INSERT INTO `evenement` VALUES (2, 'RTT', '#01FFC6');
INSERT INTO `evenement` VALUES (3, 'PONT MOBILE', '#FF8A01');
INSERT INTO `evenement` VALUES (4, 'FERIE', '#FF00FF');
INSERT INTO `evenement` VALUES (5, 'MALADIE', '#FF0000');
INSERT INTO `evenement` VALUES (6, 'FORMATION', '#004000');
INSERT INTO `evenement` VALUES (7, 'INTERVENTION', '#FFFF00');
INSERT INTO `evenement` VALUES (8, 'CE', '#FF4040');
INSERT INTO `evenement` VALUES (0, '', '');
