-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mercredi 04 Mai 2016 à 10:53
-- Version du serveur: 5.0.27
-- Version de PHP: 5.2.0
-- 
-- Base de données: `boisv163`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `tbldemandes`
-- 

CREATE TABLE `tbldemandes` (
  `ID` int(11) NOT NULL auto_increment,
  `Prenom` varchar(45) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `Objet` varchar(250) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `DateDemande` date NOT NULL,
  `DateRequise` date NOT NULL,
  `Statut` varchar(25) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- 
-- Contenu de la table `tbldemandes`
-- 

INSERT INTO `tbldemandes` VALUES (18, 'Stephane', '111', 'Conseil', '111', '1111', '0000-00-00', '0000-00-00', '111');
INSERT INTO `tbldemandes` VALUES (26, 'Jimmy', 'Hendrix', 'Conseil', '123', '123', '0000-00-00', '0000-00-00', '123');
INSERT INTO `tbldemandes` VALUES (40, 'Stephane', 'Poirier', 'Conseil', '678967', '67896', '0000-00-00', '0000-00-00', '7896');
INSERT INTO `tbldemandes` VALUES (41, 'Stephane', 'Poirier', 'Conseil', '56785', '56785', '0000-00-00', '0000-00-00', '56785');
INSERT INTO `tbldemandes` VALUES (33, 'Jimmy', 'Hendrix', 'Conseil', 'sdfs', 'sdfsd', '0000-00-00', '0000-00-00', 'sdfs');
INSERT INTO `tbldemandes` VALUES (39, 'Stephane', 'Poirier', 'Nettoyage Antivirus', 'sdFSDAF', 'ASDFADSF', '0000-00-00', '0000-00-00', 'asdfasdf');

-- --------------------------------------------------------

-- 
-- Structure de la table `tblproduits`
-- 

CREATE TABLE `tblproduits` (
  `ID` bigint(20) NOT NULL auto_increment,
  `nom` varchar(250) character set latin1 NOT NULL,
  `description` mediumtext character set latin1 NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  `photo` varchar(250) character set latin1 NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=57 ;

-- 
-- Contenu de la table `tblproduits`
-- 

INSERT INTO `tblproduits` VALUES (2, 'Ultra-Edit', 'UltraEdit est un éditeur de texte commercial créé par IDM Computer Solutions.\r\n                    UltraEdit supporte entre autres l''édition de fichiers de taille virtuellement illimitée,\r\n                    la coloration syntaxique de code source (lorsque le langage est reconnu ou si ses mots-clés\r\n                    sont définis), les expressions rationnelles permettant d''assez puissantes possibilités de\r\n                    recherche et de remplacement de texte (y compris pour plusieurs fichiers simultanément),\r\n                    l''édition de fichiers distants (par FTP ou par SSH), l''affichage et l''édition de fichier\r\n                    binaire en hexadécimal ou en format texte, ...', 59.99, 500, 'ultraedit.jpg');
INSERT INTO `tblproduits` VALUES (3, 'Maguma Studio', 'Maguma studio est un éditeur PHP très complet.\r\n                    Il possède un module permettant de se connecter à un FTP et de modifier directement les\r\n                    fichiers. Basé pour PHP4, Maguma Studio possède un débuggeur, un module de coloration\r\n                    syntaxique ainsi que la technologie d''encryptions. C''est un logiciel léger et rapide et\r\n                    très conviviale contrairement à la majorité des éditeurs texte ou ceux spécialisés. Maguma\r\n                    existe également en licence OpenSource sous le nom de Magma OpenSource.', 190.00, 500, 'maguma.jpg');
INSERT INTO `tblproduits` VALUES (5, 'Microsoft FrontPage', 'Microsoft FrontPage (officiellement Microsoft Office FrontPage) était un logiciel\r\n                    propriétaire inclus dans la suite Microsoft Office entre 1997 et 2003. C''était un\r\n                    logiciel de création de page Web de type WYSIWYG, permettant de travailler avec le\r\n                    code HTML fonctionnant sur les systèmes d''exploitation Windows. Une version Macintosh\r\n                    a également été publié en 1998.\r\n                    Depuis décembre 2006, il a été remplacé par Microsoft Expression Web et Microsoft\r\n                    Office SharePoint Designer.', 150.00, 500, 'frontpage.jpg');
INSERT INTO `tblproduits` VALUES (6, 'Macromedia Dreamweaver', 'Dreamweaver fut l''un des premiers éditeurs HTML de type tel écrit tel\r\n                    écran, mais également l''un des premiers à intégrer un gestionnaire de\r\n                    site (CyberStudio GoLive étant le premier). L''utilisateur peut choisir\r\n                    entre un mode création permettant d''effectuer la mise en page directement\r\n                    à l''aide d''outils simples, comparables à un logiciel de traitement de texte\r\n                    (insertion de tableau, d''image, etc.). Il est également possible d''afficher\r\n                    et de modifier directement le code (HTML ou autre) qui compose la page.', 450.00, 500, 'dreamweaver.jpg');
INSERT INTO `tblproduits` VALUES (55, 'Eclipse', 'Eclipse[note 1] est un environnement de développement intégré libre extensible,\r\n                    universel et polyvalent, permettant de créer des projets de développement mettant\r\n                    en oeuvre n''importe quel langage de programmation. Eclipse IDE est principalement\r\n                    écrit en Java (à l''aide de la bibliothèque graphique SWT, d''IBM), et ce langage,\r\n                    grâce à des bibliothèques spécifiques, est également utilisé pour écrire des extensions.\r\n                    La spécificité d''Eclipse IDE vient du fait de son architecture totalement développée\r\n                    autour de la notion de plugin (en conformité avec la norme OSGi) ...', 0.00, 500, 'eclipse.jpg');
INSERT INTO `tblproduits` VALUES (56, 'WebExpert', 'WebExpert est un puissant logiciel d''édition Web qui vous permet de concevoir et de\r\n                    gérer des sites Web, de façon professionnelle en toute simplicité.\r\n                    Grâce à une interface ergonomique et à un éventail impressionnant d''outils riches en\r\n                    fonctionnalités, WebExpert vous procure une parfaite maîtrise de la conception Web.\r\n                    À l''aide de WebExpert, vous détenez le plein contrôle sur tous les standards du Web\r\n                    comme le HTML, le JavaScript, les feuilles de styles CSS, le ASP et le PHP. ', 199.00, 500, 'webexpert.jpg');
