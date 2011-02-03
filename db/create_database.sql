-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2011 at 10:06 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `eindwerk`
--

-- --------------------------------------------------------

--
-- Table structure for table `bas_divisies`
--

CREATE TABLE `bas_divisies` (
  `divisie_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`divisie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bas_divisies`
--


-- --------------------------------------------------------

--
-- Table structure for table `bas_financi‘n`
--

CREATE TABLE `bas_financi‘n` (
  `financien_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsors` int(11) DEFAULT NULL,
  `wedstrijdinkomsten` int(11) DEFAULT NULL,
  `varia` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`financien_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bas_financi‘n`
--


-- --------------------------------------------------------

--
-- Table structure for table `bas_spelers`
--

CREATE TABLE `bas_spelers` (
  `speler_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) DEFAULT NULL,
  `leeftijd` int(11) DEFAULT NULL,
  `ervaring` varchar(45) DEFAULT NULL,
  `FK_team_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`speler_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `bas_spelers`
--

INSERT INTO `bas_spelers` VALUES(21, 'nele', 'deboi', 18, NULL, '3');
INSERT INTO `bas_spelers` VALUES(20, 'nele', 'vandevelde', 19, NULL, '3');
INSERT INTO `bas_spelers` VALUES(19, 'mieke', 'vandevelde', 16, NULL, '3');
INSERT INTO `bas_spelers` VALUES(18, 'maria', 'vandevelde', 23, NULL, '3');
INSERT INTO `bas_spelers` VALUES(17, 'nele', 'deschelde', 17, NULL, '3');
INSERT INTO `bas_spelers` VALUES(16, 'maria', 'pony', 16, NULL, '3');
INSERT INTO `bas_spelers` VALUES(15, 'anke', 'deschelde', 22, NULL, '3');
INSERT INTO `bas_spelers` VALUES(14, 'maria', 'deboi', 22, NULL, '3');
INSERT INTO `bas_spelers` VALUES(13, 'josefien', 'de moeder', 22, NULL, '3');
INSERT INTO `bas_spelers` VALUES(22, 'mieke', 'de moeder', 17, NULL, '3');
INSERT INTO `bas_spelers` VALUES(23, 'maria', 'vandevelde', 16, NULL, '3');
INSERT INTO `bas_spelers` VALUES(24, 'maria', 'deschelde', 22, NULL, '3');

-- --------------------------------------------------------

--
-- Table structure for table `bas_stadion`
--

CREATE TABLE `bas_stadion` (
  `stadion_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `aantal_plaatsen` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stadion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bas_stadion`
--

INSERT INTO `bas_stadion` VALUES(2, 'basket arena', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bas_teams`
--

CREATE TABLE `bas_teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `startdatum` date DEFAULT NULL,
  `FK_user_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bas_teams`
--

INSERT INTO `bas_teams` VALUES(3, 'basketteam', '0000-00-00', '4');

-- --------------------------------------------------------

--
-- Table structure for table `bas_transfers`
--

CREATE TABLE `bas_transfers` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `minimum_bod` int(11) DEFAULT NULL,
  `huidig_bod` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `FK_speler_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bas_transfers`
--


-- --------------------------------------------------------

--
-- Table structure for table `bas_trophies`
--

CREATE TABLE `bas_trophies` (
  `trophy_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `datum` varchar(45) DEFAULT NULL,
  `FK_user_id` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trophy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bas_trophies`
--


-- --------------------------------------------------------

--
-- Table structure for table `bas_wedstrijden`
--

CREATE TABLE `bas_wedstrijden` (
  `wedstrijd_id` int(11) NOT NULL AUTO_INCREMENT,
  `verslag` longtext,
  `uitslag` varchar(45) DEFAULT NULL,
  `thuisteam_id` varchar(45) DEFAULT NULL,
  `bezoekersteam_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`wedstrijd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bas_wedstrijden`
--


-- --------------------------------------------------------

--
-- Table structure for table `korf_divisies`
--

CREATE TABLE `korf_divisies` (
  `divisie_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`divisie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `korf_divisies`
--


-- --------------------------------------------------------

--
-- Table structure for table `korf_financi‘n`
--

CREATE TABLE `korf_financi‘n` (
  `financien_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsors` int(11) DEFAULT NULL,
  `wedstrijdinkomsten` int(11) DEFAULT NULL,
  `varia` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`financien_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `korf_financi‘n`
--


-- --------------------------------------------------------

--
-- Table structure for table `korf_opstelling`
--

CREATE TABLE `korf_opstelling` (
  `opstelling_id` int(11) NOT NULL AUTO_INCREMENT,
  `spelernaam` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`opstelling_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `korf_opstelling`
--

INSERT INTO `korf_opstelling` VALUES(1, NULL);
INSERT INTO `korf_opstelling` VALUES(5, 'nele deschelde');
INSERT INTO `korf_opstelling` VALUES(4, 'jos Cline');
INSERT INTO `korf_opstelling` VALUES(6, 'mieke deboi');
INSERT INTO `korf_opstelling` VALUES(7, 'nele deschelde');

-- --------------------------------------------------------

--
-- Table structure for table `korf_spelers`
--

CREATE TABLE `korf_spelers` (
  `speler_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) DEFAULT NULL,
  `leeftijd` int(11) DEFAULT NULL,
  `ervaring` varchar(45) DEFAULT NULL,
  `FK_team_id` varchar(45) DEFAULT NULL,
  `geslacht` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`speler_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=205 ;

--
-- Dumping data for table `korf_spelers`
--

INSERT INTO `korf_spelers` VALUES(204, 'mieke', 'deboi', 23, NULL, '19', 'vrouw');
INSERT INTO `korf_spelers` VALUES(203, 'jozef', 'Jones', 21, NULL, '19', 'man');
INSERT INTO `korf_spelers` VALUES(202, 'nele', 'de moeder', 20, NULL, '19', 'vrouw');
INSERT INTO `korf_spelers` VALUES(201, 'jos', 'Cline', 23, NULL, '19', 'man');
INSERT INTO `korf_spelers` VALUES(200, 'maria', 'deboi', 23, NULL, '19', 'vrouw');
INSERT INTO `korf_spelers` VALUES(199, 'flupke', 'Jones', 22, NULL, '19', 'man');
INSERT INTO `korf_spelers` VALUES(198, 'nele', 'deschelde', 19, NULL, '19', 'vrouw');
INSERT INTO `korf_spelers` VALUES(197, 'jozef', 'Cline', 23, NULL, '19', 'man');
INSERT INTO `korf_spelers` VALUES(196, 'maria', 'de moeder', 20, NULL, '19', 'vrouw');
INSERT INTO `korf_spelers` VALUES(195, 'flupke', 'Cooper', 22, NULL, '19', 'man');
INSERT INTO `korf_spelers` VALUES(194, 'anke', 'deschelde', 19, NULL, '19', 'vrouw');
INSERT INTO `korf_spelers` VALUES(193, 'flupke', 'Smith', 18, NULL, '19', 'man');

-- --------------------------------------------------------

--
-- Table structure for table `korf_stadion`
--

CREATE TABLE `korf_stadion` (
  `stadion_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `aantal_plaatsen` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stadion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `korf_stadion`
--

INSERT INTO `korf_stadion` VALUES(10, 'toppers arena', NULL, 19);

-- --------------------------------------------------------

--
-- Table structure for table `korf_teams`
--

CREATE TABLE `korf_teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `startdatum` date DEFAULT NULL,
  `FK_user_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `korf_teams`
--

INSERT INTO `korf_teams` VALUES(19, 'de toppers', '0000-00-00', '4');

-- --------------------------------------------------------

--
-- Table structure for table `korf_transfers`
--

CREATE TABLE `korf_transfers` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `minimum_bod` int(11) DEFAULT NULL,
  `huidig_bod` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `FK_speler_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `korf_transfers`
--


-- --------------------------------------------------------

--
-- Table structure for table `korf_trophies`
--

CREATE TABLE `korf_trophies` (
  `trophy_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `datum` varchar(45) DEFAULT NULL,
  `FK_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trophy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `korf_trophies`
--


-- --------------------------------------------------------

--
-- Table structure for table `korf_wedstrijden`
--

CREATE TABLE `korf_wedstrijden` (
  `wedstrijd_id` int(11) NOT NULL AUTO_INCREMENT,
  `verslag` longtext,
  `uitslag` varchar(45) DEFAULT NULL,
  `thuisteam_id` varchar(45) DEFAULT NULL,
  `bezoekersteam_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`wedstrijd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `korf_wedstrijden`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) DEFAULT NULL,
  `land` varchar(45) DEFAULT NULL,
  `gemeente` varchar(45) DEFAULT NULL,
  `adres` varchar(100) DEFAULT NULL,
  `gebruikersnaam` varchar(100) DEFAULT NULL,
  `paswoord` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `datum_creatie` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'dimitri', 'leonidas', 'belgie', 'emblem', 'spoorweglei', 'dimitri', '6358b71804dfa8ab069cf05ed1b0ed2a', NULL, NULL);
INSERT INTO `users` VALUES(3, 'dimitri', 'leonidas', 'Belgie', 'Antwerp', 'spoorweglei', 'leonidas', '6358b71804dfa8ab069cf05ed1b0ed2a', 'dimitri_leonidas@hotmail.com', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES(4, 'First Name', 'Last Name', 'Country', 'State', 'address', 'Username', 'dc647eb65e6711e155375218212b3964', 'E-Mail@email.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vol_divisies`
--

CREATE TABLE `vol_divisies` (
  `divisie_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`divisie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vol_divisies`
--


-- --------------------------------------------------------

--
-- Table structure for table `vol_financi‘n`
--

CREATE TABLE `vol_financi‘n` (
  `financien_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsors` int(11) DEFAULT NULL,
  `wedstrijdinkomsten` int(11) DEFAULT NULL,
  `varia` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`financien_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vol_financi‘n`
--


-- --------------------------------------------------------

--
-- Table structure for table `vol_spelers`
--

CREATE TABLE `vol_spelers` (
  `speler_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) DEFAULT NULL,
  `leeftijd` int(11) DEFAULT NULL,
  `ervaring` varchar(45) DEFAULT NULL,
  `FK_team_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`speler_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `vol_spelers`
--

INSERT INTO `vol_spelers` VALUES(36, 'josefien', 'deboi', 16, NULL, '4');
INSERT INTO `vol_spelers` VALUES(35, 'josefien', 'deboi', 18, NULL, '4');
INSERT INTO `vol_spelers` VALUES(34, 'maria', 'deschelde', 16, NULL, '4');
INSERT INTO `vol_spelers` VALUES(33, 'mieke', 'de moeder', 16, NULL, '4');
INSERT INTO `vol_spelers` VALUES(32, 'anke', 'pony', 20, NULL, '4');
INSERT INTO `vol_spelers` VALUES(31, 'mieke', 'pony', 19, NULL, '4');
INSERT INTO `vol_spelers` VALUES(30, 'nele', 'pony', 20, NULL, '4');
INSERT INTO `vol_spelers` VALUES(29, 'nele', 'pony', 22, NULL, '4');
INSERT INTO `vol_spelers` VALUES(28, 'mieke', 'deboi', 21, NULL, '4');
INSERT INTO `vol_spelers` VALUES(27, 'maria', 'vandevelde', 21, NULL, '4');
INSERT INTO `vol_spelers` VALUES(26, 'josefien', 'de moeder', 16, NULL, '4');
INSERT INTO `vol_spelers` VALUES(25, 'anke', 'deboi', 21, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `vol_stadion`
--

CREATE TABLE `vol_stadion` (
  `stadion_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `aantal_plaatsen` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stadion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vol_stadion`
--

INSERT INTO `vol_stadion` VALUES(3, 'Volleybal Arena', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vol_teams`
--

CREATE TABLE `vol_teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `startdatum` date DEFAULT NULL,
  `FK_user_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vol_teams`
--

INSERT INTO `vol_teams` VALUES(4, 'Volleybal Team', '0000-00-00', '4');

-- --------------------------------------------------------

--
-- Table structure for table `vol_transfers`
--

CREATE TABLE `vol_transfers` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `minimum_bod` int(11) DEFAULT NULL,
  `huidig_bod` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `FK_speler_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vol_transfers`
--


-- --------------------------------------------------------

--
-- Table structure for table `vol_trophies`
--

CREATE TABLE `vol_trophies` (
  `trophy_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `datum` varchar(45) DEFAULT NULL,
  `FK_user_id` int(11) DEFAULT NULL,
  `FK_team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trophy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vol_trophies`
--


-- --------------------------------------------------------

--
-- Table structure for table `vol_wedstrijden`
--

CREATE TABLE `vol_wedstrijden` (
  `wedstrijd_id` int(11) NOT NULL AUTO_INCREMENT,
  `verslag` longtext,
  `uitslag` varchar(45) DEFAULT NULL,
  `thuisteam_id` varchar(45) DEFAULT NULL,
  `bezoekersteam_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`wedstrijd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vol_wedstrijden`
--

