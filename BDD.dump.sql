-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Dim 27 Mai 2012 à 13:28
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ensisa_tp_festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `descr` longtext,
  `page` longtext,
  `gender` varchar(50) NOT NULL,
  `contry` varchar(100) NOT NULL,
  `www` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `artist`
--

INSERT INTO `artist` (`id`, `name`, `descr`, `page`, `gender`, `contry`, `www`, `youtube`, `image`) VALUES
(1, 'Liz Green', 'Liz Green est apparue une premire fois en 2008, pour dispara”tre presque instantanŽment. RepŽrŽe lÕannŽe prŽcŽdente au festival de Glastonbury, lÕAnglaise Žtait venue ˆ Paris jouer en Žpilogue dÕun concert organisŽ dans un appartement montmartrois par la Blogothque, le site musical qui se lanait alors dans ce genre de moments privilŽgiŽs offerts ˆ quelques-uns.', 'Liz Green est apparue une premire fois en 2008, pour dispara”tre presque instantanŽment. RepŽrŽe lÕannŽe prŽcŽdente au festival de Glastonbury, lÕAnglaise Žtait venue ˆ Paris jouer en Žpilogue dÕun concert organisŽ dans un appartement montmartrois par la Blogothque, le site musical qui se lanait alors dans ce genre de moments privilŽgiŽs offerts ˆ quelques-uns.\r\n\r\nBon Iver Žtait la star du soir, mais cÕest avec Liz Green quÕon avait fini la nuit dans un petit bar de la Butte. Elle avait chantŽ seule des complaintes blues-folk, avec une guitare pourrie et une voix de grand-mre du Lancashire. La bire aidant, Liz Green avait racontŽ des histoires de fant™mes, dÕoiseaux inquiŽtants et de french singer.\r\n\r\nParcimonie. Elle est revenue chanter en France quelquefois par la suite, puis elle sÕest noyŽe dans le paysage sans mme laisser dÕalbum. Plus de trois ans plus tard, revoilˆ Liz Green avec ce premier disque, O, Devotion ! o elle Žvolue dans sa zone de confort en mettant au propre les chansons quÕon lÕentendait dŽjˆ chanter en 2008.', 'Folk', 'Royaume-Uni', 'http://www.liz-green-music.fr', 'http://www.youtube.com/embed/Pnmc1J9jpBg', 'liz-green.jpg'),
(2, 'Brigitte Fontaine', 'Disque d''or ...', 'Disque d''or ...', 'Chanson', 'France', 'http://brigittefontaine.artiste.universalmusic.fr/', 'http://www.youtube.com/embed/IlLJqORNu2Q', 'brigitte-fontaine.jpg'),
(3, 'David Bowie', 'David Bowie, de son vrai nom David Robert Jones, né le 8 janvier 1947 à Londres, dans le quartier de Brixton est un chanteur, compositeur, producteur de disques et acteur britannique. Au long de plus de quatre décennies d''une carrière marquée par les changements fréquents de direction et de style, il s''est imposé comme un des personnages les plus originaux et imprévisibles de la musique rock, et de très nombreux artistes se sont réclamés de son influence. Il a écoulé plus de 140 millions d''albums dans le monde', 'David Bowie, de son vrai nom David Robert Jones, né le 8 janvier 1947 à Londres, dans le quartier de Brixton est un chanteur, compositeur, producteur de disques et acteur britannique. Au long de plus de quatre décennies d''une carrière marquée par les changements fréquents de direction et de style, il s''est imposé comme un des personnages les plus originaux et imprévisibles de la musique rock, et de très nombreux artistes se sont réclamés de son influence. Il a écoulé plus de 140 millions d''albums dans le monde.\r\n\r\nAprès des débuts hésitants entre le folk et la variété dans la deuxième moitié des années 60 et un détour par le mime, Bowie devient une vedette en 1972 par l''intermédiaire de son alter ego décadent Ziggy Stardust, et impose un glam rock sophistiqué et apocalyptique et des spectacles flamboyants. À cette époque, il participe aussi aux carrières solo de Lou Reed et d''Iggy Pop en tant que collaborateur et producteur. Pendant le reste de la décennie, il s''intéresse aux musiques noires (soul, funk et disco) et à la musique électronique émergente, créant des mélanges nouveaux notamment avec la complicité du producteur et musicien Brian Eno. Dans les années 80, il devient une vedette grand public et remplit les stades avec une pop efficace, puis finit la décennie avec un revirement complet, intégrant le groupe de garage rock Tin Machine. Les années 90 l''ont vu retourner à un style plus expérimental intégrant des musiques contemporaines telles la techno et le drum''n''bass. Depuis 2004 ses apparitions se font plus rares.\r\n\r\nIl a joué dans un certain nombre de films de divers genres : drame historique, science-fiction, thriller gothique, film pour enfants...\r\n\r\nDavid Bowie est le père du réalisateur de films Duncan Jones.', 'Pop', 'Royaume-Uni', 'davidbowie.com', 'http://www.youtube.com/embed/YYjBQKIOb-w', 'david-bowie.jpg'),
(4, 'Queen', 'Queen est un groupe de rock britannique, formé en 1970 à Londres par Freddie Mercury, Brian May et Roger Taylor, ces deux derniers étant issus du groupe Smile. L’année suivante, le bassiste John Deacon vient compléter la formation.', 'Queen est un groupe de rock britannique, formé en 1970 à Londres par Freddie Mercury, Brian May et Roger Taylor, ces deux derniers étant issus du groupe Smile. L’année suivante, le bassiste John Deacon vient compléter la formation.\r\n\r\nGroupe britannique qui a connu le plus grand succès commercial ces trente dernières années2, Queen aurait vendu plus de 300 millions d''albums à l''échelle internationale en 20093,4 dont 32,5 millions aux États-Unis5. Un sondage d''opinion commandé en Grande-Bretagne par la BBC Two et paru en 2007 fait de Queen le « meilleur groupe britannique de tous les temps », devançant de peu les Beatles et les Rolling Stones6. Queen est également l''un des pionniers du clip vidéo, ayant exploité avec succès ce mode de communication dès 1975. Queen a conservé, malgré la mort de son leader Freddie Mercury en 1991, de très nombreux admirateurs inconditionnels dans le monde entier.', 'Rock', 'Royaume-Uni', 'http://www.queenonline.com', 'http://www.youtube.com/embed/xtrEN-YKLBM', 'Queen.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `artistprogrammation`
--

CREATE TABLE IF NOT EXISTS `artistprogrammation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `programmation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `artist_programmation`
--

CREATE TABLE IF NOT EXISTS `artist_programmation` (
  `artist_id` int(11) NOT NULL,
  `programmation_id` int(11) NOT NULL,
  PRIMARY KEY (`artist_id`,`programmation_id`),
  KEY `IDX_C3A566A2B7970CF8` (`artist_id`),
  KEY `IDX_C3A566A296D6BD09` (`programmation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `artist_programmation`
--

INSERT INTO `artist_programmation` (`artist_id`, `programmation_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'georges.olivares', 'georges.olivares', 'olivares.georges@gmail.com', 'olivares.georges@gmail.com', 1, 'f9x2tpjfaxskcwg888440cks00gskgc', 'L2vSI0011W7Ddgs71dNSUi+C0vNc2w7evvWpFLA35+BC1uSz/AY7dwRzuiRM4HG/j9eWSaCid6gamyxB7PRkTw==', '2012-05-27 10:09:02', 0, 0, NULL, '48g02zb1pxyck4cgw8gocosk4wc08go0sococs40c0owkw844o', NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(2, 'florent', 'florent', 'forent', 'forent', 1, '6tp6hakdid8gscgcos4c0sosw80sogk', 'aI7Vm17EETz+UBYfybAx9tGmNk192ZlFZ9WChCl7pKfhJg49sGurFbHWnqD0pgMTwfoBiDc+A5+kBrFXqHNd9g==', '2012-05-27 00:33:41', 0, 0, NULL, 'gapyo7obuc8c8gocs8sck0g00k48s4ok84gcgw0cc0g4kwosw', NULL, 'a:0:{}', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `programmation`
--

CREATE TABLE IF NOT EXISTS `programmation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `programmation`
--

INSERT INTO `programmation` (`id`, `date`, `title`, `stock`) VALUES
(1, '2012-05-25', 'Vendredi', 1000),
(2, '2012-05-26', 'Samedi', 1000),
(3, '2012-05-27', 'Dimanche', 1000);

-- --------------------------------------------------------

--
-- Structure de la table `shoppedtickets`
--

CREATE TABLE IF NOT EXISTS `shoppedtickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tickets_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `salt` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C84EAB1C8FDC0E9A` (`tickets_id`),
  KEY `IDX_C84EAB1CA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `shoppedtickets`
--

INSERT INTO `shoppedtickets` (`id`, `tickets_id`, `user_id`, `name`, `date`, `paid`, `token`, `salt`) VALUES
(1, 1, 1, 'M. A', '2012-05-26 00:00:00', 1, 'EC-48N03335GU704460A', '14e7bbc062654046814a997407521c2e'),
(2, 3, 1, 'Mme J', '2012-05-26 00:00:00', 1, 'EC-4UJ81284YL477725U', '14e7bbc062654046814a997407521c2e'),
(3, 2, NULL, 'BB', '2012-05-27 00:31:44', NULL, NULL, '4c5a0d56821614651d755e055e9ff58e'),
(4, 3, 2, 'aa', '2012-05-27 00:36:26', 1, 'EC-76529070HY013054V', '8818a81a0d85a5d75bc8c48b32dfb195'),
(5, 2, 2, 'aa', '2012-05-27 00:37:33', 0, 'EC-1KX39630VJ705870D', 'cb951c526e1a2dc140b9a8ac5b7f09e5'),
(6, 4, 2, 'ccccc', '2012-05-27 00:39:12', 0, 'EC-1KX39630VJ705870D', 'ed61bf1b8d0c6b322c396892809fade4'),
(7, 1, 2, 'aaa', '2012-05-27 01:11:16', 1, NULL, '60c00d4d9cecb3e94771056382d56c29'),
(8, 1, 1, 'Mme Salomé', '2012-05-27 12:33:39', 1, 'EC-6LS45101AW3242425', 'fb5f3012ca89721531af76a4f0c10f77');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `price`) VALUES
(1, 'Pass 3 jours', '60.00'),
(2, 'Pass Vendredi', '25.00'),
(3, 'Pass Samedi', '25.00'),
(4, 'Pass Dimanche', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `tickets_programmation`
--

CREATE TABLE IF NOT EXISTS `tickets_programmation` (
  `tickets_id` int(11) NOT NULL,
  `programmation_id` int(11) NOT NULL,
  PRIMARY KEY (`tickets_id`,`programmation_id`),
  KEY `IDX_C5074C748FDC0E9A` (`tickets_id`),
  KEY `IDX_C5074C7496D6BD09` (`programmation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tickets_programmation`
--

INSERT INTO `tickets_programmation` (`tickets_id`, `programmation_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 2),
(4, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `artist_programmation`
--
ALTER TABLE `artist_programmation`
  ADD CONSTRAINT `FK_C3A566A296D6BD09` FOREIGN KEY (`programmation_id`) REFERENCES `programmation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C3A566A2B7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `shoppedtickets`
--
ALTER TABLE `shoppedtickets`
  ADD CONSTRAINT `FK_C84EAB1C8FDC0E9A` FOREIGN KEY (`tickets_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `FK_C84EAB1CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `tickets_programmation`
--
ALTER TABLE `tickets_programmation`
  ADD CONSTRAINT `FK_C5074C7496D6BD09` FOREIGN KEY (`programmation_id`) REFERENCES `programmation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C5074C748FDC0E9A` FOREIGN KEY (`tickets_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;