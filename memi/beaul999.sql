-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 09 Mars 2016 à 10:27
-- Version du serveur: 5.1.37
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `beaul999`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbldemande`
--

CREATE TABLE IF NOT EXISTS `tbldemande` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `prenom` varchar(35) NOT NULL,
  `nom` varchar(35) NOT NULL,
  `type_travail` varchar(20) NOT NULL,
  `objet` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_demande` datetime NOT NULL,
  `date_requise` datetime NOT NULL,
  `statut` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `tbldemande`
--

INSERT INTO `tbldemande` (`id`, `prenom`, `nom`, `type_travail`, `objet`, `description`, `date_demande`, `date_requise`, `statut`) VALUES
(20, 'Jimmy', 'Hendrix', 'Information', 'sauvegarde', 'svp faire une sauvegarde de mon disque', '2016-03-07 14:37:56', '2016-03-11 00:00:00', 'Non-assignée'),
(18, 'Jacques', 'St-Jacques', 'Information', '123123', '12323123', '2016-03-08 00:00:00', '2016-03-09 00:00:00', 'En Cours'),
(3, 'Jean', 'Valjean', 'Information', 'XP', 'Installer Service pack 3', '2010-01-13 14:50:50', '2010-01-22 14:50:59', 'Non-assignée'),
(9, 'Pierre', 'Lapierre', 'Télé intervention', '???', 'blablabla', '2016-03-08 00:00:00', '2016-03-09 00:00:00', 'Terminée'),
(8, 'Pierre', 'Lapierre', 'Reconfiguration', 'remonter le poste', 'profil corrompu', '2016-03-07 00:00:00', '2016-03-10 00:00:00', 'Reportée'),
(23, 'Jimmy', 'Hendrix', 'Télé intervention', 'test123', 'kjlfdskfdfs', '2016-03-08 08:20:17', '2016-03-14 12:12:00', 'Non-assignée');

-- --------------------------------------------------------

--
-- Structure de la table `tblproduits`
--

CREATE TABLE IF NOT EXISTS `tblproduits` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET latin1 NOT NULL,
  `description` mediumtext CHARACTER SET latin1 NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  `photo` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=57 ;

--
-- Contenu de la table `tblproduits`
--

INSERT INTO `tblproduits` (`ID`, `nom`, `description`, `prix`, `quantite`, `photo`) VALUES
(2, 'Ultra-Edit', 'UltraEdit est un éditeur de texte commercial créé par IDM Computer Solutions.\r\n                    UltraEdit supporte entre autres l''édition de fichiers de taille virtuellement illimitée,\r\n                    la coloration syntaxique de code source (lorsque le langage est reconnu ou si ses mots-clés\r\n                    sont définis), les expressions rationnelles permettant d''assez puissantes possibilités de\r\n                    recherche et de remplacement de texte (y compris pour plusieurs fichiers simultanément),\r\n                    l''édition de fichiers distants (par FTP ou par SSH), l''affichage et l''édition de fichier\r\n                    binaire en hexadécimal ou en format texte, ...', '59.99', 500, 'ultraedit.jpg'),
(3, 'Maguma Studio', 'Maguma studio est un éditeur PHP très complet.\r\n                    Il possède un module permettant de se connecter à un FTP et de modifier directement les\r\n                    fichiers. Basé pour PHP4, Maguma Studio possède un débuggeur, un module de coloration\r\n                    syntaxique ainsi que la technologie d''encryptions. C''est un logiciel léger et rapide et\r\n                    très conviviale contrairement à la majorité des éditeurs texte ou ceux spécialisés. Maguma\r\n                    existe également en licence OpenSource sous le nom de Magma OpenSource.', '190.00', 500, 'maguma.jpg'),
(5, 'Microsoft FrontPage', 'Microsoft FrontPage (officiellement Microsoft Office FrontPage) était un logiciel\r\n                    propriétaire inclus dans la suite Microsoft Office entre 1997 et 2003. C''était un\r\n                    logiciel de création de page Web de type WYSIWYG, permettant de travailler avec le\r\n                    code HTML fonctionnant sur les systèmes d''exploitation Windows. Une version Macintosh\r\n                    a également été publié en 1998.\r\n                    Depuis décembre 2006, il a été remplacé par Microsoft Expression Web et Microsoft\r\n                    Office SharePoint Designer.', '150.00', 500, 'frontpage.jpg'),
(6, 'Macromedia Dreamweaver', 'Dreamweaver fut l''un des premiers éditeurs HTML de type tel écrit tel\r\n                    écran, mais également l''un des premiers à intégrer un gestionnaire de\r\n                    site (CyberStudio GoLive étant le premier). L''utilisateur peut choisir\r\n                    entre un mode création permettant d''effectuer la mise en page directement\r\n                    à l''aide d''outils simples, comparables à un logiciel de traitement de texte\r\n                    (insertion de tableau, d''image, etc.). Il est également possible d''afficher\r\n                    et de modifier directement le code (HTML ou autre) qui compose la page.', '450.00', 500, 'dreamweaver.jpg'),
(55, 'Eclipse', 'Eclipse[note 1] est un environnement de développement intégré libre extensible,\r\n                    universel et polyvalent, permettant de créer des projets de développement mettant\r\n                    en oeuvre n''importe quel langage de programmation. Eclipse IDE est principalement\r\n                    écrit en Java (à l''aide de la bibliothèque graphique SWT, d''IBM), et ce langage,\r\n                    grâce à des bibliothèques spécifiques, est également utilisé pour écrire des extensions.\r\n                    La spécificité d''Eclipse IDE vient du fait de son architecture totalement développée\r\n                    autour de la notion de plugin (en conformité avec la norme OSGi) ...', '0.00', 500, 'eclipse.jpg'),
(56, 'WebExpert', 'WebExpert est un puissant logiciel d''édition Web qui vous permet de concevoir et de\r\n                    gérer des sites Web, de façon professionnelle en toute simplicité.\r\n                    Grâce à une interface ergonomique et à un éventail impressionnant d''outils riches en\r\n                    fonctionnalités, WebExpert vous procure une parfaite maîtrise de la conception Web.\r\n                    À l''aide de WebExpert, vous détenez le plein contrôle sur tous les standards du Web\r\n                    comme le HTML, le JavaScript, les feuilles de styles CSS, le ASP et le PHP. ', '199.00', 500, 'webexpert.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
