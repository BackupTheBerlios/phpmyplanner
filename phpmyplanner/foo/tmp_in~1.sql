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
-- Structure de la table `tmp_intervention`
-- 

CREATE TABLE `tmp_intervention` (
  `idtmpintervention` mediumint(8) unsigned NOT NULL auto_increment,
  `date` int(11) NOT NULL default '0',
  `am` tinyint(1) NOT NULL default '0',
  `pm` tinyint(1) NOT NULL default '0',
  `intervenantid` mediumint(8) unsigned NOT NULL default '0',
  `evtidam` mediumint(8) unsigned NOT NULL default '0',
  `evtidpm` mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (`idtmpintervention`),
  KEY `intervenantid` (`intervenantid`,`evtidam`)
) TYPE=MyISAM AUTO_INCREMENT=41 ;

-- 
-- Contenu de la table `tmp_intervention`
-- 

INSERT INTO `tmp_intervention` VALUES (1, 1104750000, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (2, 1104750000, 0, 1, 1, 0, 7);
INSERT INTO `tmp_intervention` VALUES (3, 1104836400, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (4, 1104836400, 0, 1, 1, 0, 7);
INSERT INTO `tmp_intervention` VALUES (5, 1104922800, 1, 0, 3, 7, 0);
INSERT INTO `tmp_intervention` VALUES (6, 1104922800, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (7, 1105009200, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (8, 1105009200, 0, 1, 3, 0, 7);
INSERT INTO `tmp_intervention` VALUES (9, 1105095600, 1, 0, 3, 7, 0);
INSERT INTO `tmp_intervention` VALUES (10, 1105095600, 0, 1, 1, 0, 7);
INSERT INTO `tmp_intervention` VALUES (11, 1105354800, 1, 0, 3, 7, 0);
INSERT INTO `tmp_intervention` VALUES (12, 1105354800, 0, 1, 2, 0, 7);
INSERT INTO `tmp_intervention` VALUES (13, 1105441200, 1, 0, 3, 7, 0);
INSERT INTO `tmp_intervention` VALUES (14, 1105441200, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (15, 1105527600, 1, 0, 1, 7, 0);
INSERT INTO `tmp_intervention` VALUES (16, 1105527600, 0, 1, 2, 0, 7);
INSERT INTO `tmp_intervention` VALUES (17, 1105614000, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (18, 1105614000, 0, 1, 3, 0, 7);
INSERT INTO `tmp_intervention` VALUES (19, 1105700400, 1, 0, 1, 7, 0);
INSERT INTO `tmp_intervention` VALUES (20, 1105700400, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (21, 1105959600, 1, 0, 1, 7, 0);
INSERT INTO `tmp_intervention` VALUES (22, 1105959600, 0, 1, 3, 0, 7);
INSERT INTO `tmp_intervention` VALUES (23, 1106046000, 1, 0, 3, 7, 0);
INSERT INTO `tmp_intervention` VALUES (24, 1106046000, 0, 1, 2, 0, 7);
INSERT INTO `tmp_intervention` VALUES (25, 1106132400, 1, 0, 3, 7, 0);
INSERT INTO `tmp_intervention` VALUES (26, 1106132400, 0, 1, 1, 0, 7);
INSERT INTO `tmp_intervention` VALUES (27, 1106218800, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (28, 1106218800, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (29, 1106305200, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (30, 1106305200, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (31, 1106564400, 1, 0, 1, 7, 0);
INSERT INTO `tmp_intervention` VALUES (32, 1106564400, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (33, 1106650800, 1, 0, 1, 7, 0);
INSERT INTO `tmp_intervention` VALUES (34, 1106650800, 0, 1, 3, 0, 7);
INSERT INTO `tmp_intervention` VALUES (35, 1106737200, 1, 0, 1, 7, 0);
INSERT INTO `tmp_intervention` VALUES (36, 1106737200, 0, 1, 3, 0, 7);
INSERT INTO `tmp_intervention` VALUES (37, 1106823600, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (38, 1106823600, 0, 1, 4, 0, 7);
INSERT INTO `tmp_intervention` VALUES (39, 1106910000, 1, 0, 2, 7, 0);
INSERT INTO `tmp_intervention` VALUES (40, 1106910000, 0, 1, 4, 0, 7);
