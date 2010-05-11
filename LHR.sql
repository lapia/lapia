-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2010 at 10:19 AM
-- Server version: 5.1.46
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `LHR`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE IF NOT EXISTS `adminusers` (
  `idAdminuser` int(11) NOT NULL AUTO_INCREMENT,
  `AdminEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `password` varchar(12) NOT NULL,
  `phone` varchar(12) NOT NULL,
  PRIMARY KEY (`idAdminuser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`idAdminuser`, `AdminEmailaddress`, `Address`, `Contactperson`, `password`, `phone`) VALUES
(1, 'admin@o2.pl', 'lomza', 'Zdzisiek', '123', '321'),
(2, 'administrator@lappia.fi', 'administrator@lappia.fi', 'administrator@lappia.fi', 'password', '123123123');

-- --------------------------------------------------------

--
-- Table structure for table `registereduser`
--

CREATE TABLE IF NOT EXISTS `registereduser` (
  `idRegistereduser` int(11) NOT NULL AUTO_INCREMENT,
  `RegisteredEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `Organizationname` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `confirmationcode` varchar(25) NOT NULL,
  PRIMARY KEY (`idRegistereduser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `registereduser`
--

INSERT INTO `registereduser` (`idRegistereduser`, `RegisteredEmailaddress`, `Address`, `Contactperson`, `Organizationname`, `password`, `phone`, `confirmationcode`) VALUES
(1, 'ludo@o2.pl', 'ludo', 'ludo', 'ludo', 'ludo', 'ludo', ''),
(3, 'a', 'a', 'a', 'a', 'a', 'a', ''),
(4, 'wa', 'wa', 'wa', 'wa', 'wa', 'wa', ''),
(8, 'boromil@gmail.com', 'sdfrsdf', 'krzysztof', 'boromil@gmai', 'qweqweqwe', '123123123', ''),
(9, 'test@test.fi', 'test', 'test', 'test', 'testtest', '1234', ''),
(10, 'abbeyola@yahoo.com', 'Sammonkatu4, B3 Kemi', 'Abbey', 'kingbios', 'kingstar', '445311318', ''),
(11, 'ludomirc@gmail.com', 'home', 'home', 'home', 'beniamin', 'home', ''),
(12, 'walecoolfm@yahoo.com', 'sammonkatu 4 c 1', 'Mr Thai Bui', 'kemi-tornio ', 'walenchy1939', '0443233475', ''),
(13, 'valeloclan@hotmail.com', 'Teku', 'Mr Elorm Damalie', 'Teku', 'ghana12', '256498745', ''),
(14, 'isaakay111@yahoo.com', 'hillevinkatu 37', 'Thai Bui', 'kingbios', 'kilowade', '0442099307', ''),
(15, 'abbeygold101@yahoo.com', 'sammon 4', 'Abbey', 'Abbey int', '123456', '54689721', ''),
(16, '', '', '', '', '', '', ''),
(18, 'kayode_ogunlolu@yahoo.com', 'kemi city', 'benek', 'kemi tornoi ', 'commando', '000000', ''),
(19, 'abbeygold101@hotmail.com', 'ksjsjio', 'Abbey', 'Abeey', '123456', '12525', ''),
(20, 'elorm.damale@tokem.fi', 'Tema', 'Kwaku Damalie', 'school', 'allen12', '543762', ''),
(21, 'kingbios2000@yahoo.co.uk', 'hjhkjjo', 'abey', 'ade', '123456', '11454564', ''),
(22, 'boromil3@dasd.fi', 'kjhkjhkjh', 'Abbey', 'Abbey int', 'qwertyu', '12321321', ''),
(23, 'fdsdas@dad.ds', 'sammon 4', 'kjhkjhkjh', 'rfwekjhk', 'qweqweqweqwe', '12321321', ''),
(24, 'test@test.com', 'deletemeimmediately', 'test', 'justtesting', 'deleteme', '000', ''),
(26, 'kryszlef@o2.pl', 'kjhkjhkjh', 'krzysztof', 'rfwekjhk', 'qweqweqwe', '12321321', ''),
(27, 'bunmiabodunrin@yahoo.com', 'nt', 'da', 'ng', 'mamami', '2344556', '');

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `Reservecode` varchar(25) DEFAULT NULL,
  `area` varchar(25) NOT NULL,
  `Statingtime` time NOT NULL,
  `Endingtime` time NOT NULL,
  `Startingdate` date NOT NULL,
  `Endingdate` date NOT NULL,
  `idRegistereduser` int(11) DEFAULT NULL,
  `idUnregistereduser` int(11) DEFAULT NULL,
  `idAdminuser` int(11) DEFAULT NULL,
  `TimeStemp` int(11) NOT NULL,
  `Status` int(11) DEFAULT '0',
  PRIMARY KEY (`idReservation`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`idReservation`, `Reservecode`, `area`, `Statingtime`, `Endingtime`, `Startingdate`, `Endingdate`, `idRegistereduser`, `idUnregistereduser`, `idAdminuser`, `TimeStemp`, `Status`) VALUES
(109, '26d5ae', 'A', '00:00:00', '01:00:00', '2010-05-18', '2010-05-18', 8, NULL, NULL, 1272961319, 0),
(108, '57bded', 'B', '01:00:00', '02:00:00', '2010-05-18', '2010-05-18', 8, NULL, NULL, 1272961287, 2),
(106, '293b0e', 'A', '00:00:00', '01:00:00', '2015-05-04', '2015-05-04', NULL, NULL, NULL, 1272959613, 0),
(105, '363e9f', 'A', '00:00:00', '01:00:00', '2012-03-26', '2012-03-26', NULL, NULL, NULL, 1272959598, 0),
(107, 'fcf7f8', 'B', '01:00:00', '09:00:00', '2010-05-18', '2010-05-18', 8, NULL, NULL, 1272961101, 1),
(103, '1128f5', 'A', '00:00:00', '01:00:00', '1999-11-30', '1999-11-30', 18, NULL, NULL, 1272958642, 0),
(102, '9088d1', 'B', '00:00:00', '03:00:00', '2010-05-06', '2010-05-06', 18, NULL, NULL, 1272958504, 0),
(101, '73f335', 'A', '00:00:00', '01:00:00', '1999-11-30', '1999-11-30', NULL, NULL, NULL, 1272957603, 0),
(100, '40a38e', 'A-B', '00:00:00', '02:00:00', '2011-02-04', '2011-02-04', NULL, NULL, NULL, 1272957570, 0),
(99, '69f345', 'B', '02:00:00', '06:00:00', '2010-06-04', '2010-06-04', NULL, NULL, NULL, 1272957484, 0),
(98, '87bc08', 'B', '04:00:00', '06:00:00', '2010-07-06', '2010-07-06', NULL, NULL, NULL, 1272957405, 0),
(97, '61f2f2', 'A', '02:00:00', '06:00:00', '2010-06-06', '2010-06-06', NULL, NULL, NULL, 1272957371, 0),
(96, 'ef67e8', 'A', '00:00:00', '01:00:00', '2010-05-05', '2010-05-05', 13, NULL, NULL, 1272956865, 1),
(93, 'bfdee2', 'A', '00:00:00', '01:00:00', '2010-05-05', '2010-05-05', NULL, NULL, NULL, 1272956315, 0),
(91, 'e621b9', 'A', '00:00:00', '01:00:00', '2010-05-05', '2010-05-05', 8, NULL, NULL, 1272955052, 0),
(89, '1e7255', 'A', '01:00:00', '18:00:00', '2010-05-18', '2010-05-18', 8, NULL, NULL, 1272614090, 0),
(88, 'c5fb91', 'A', '01:00:00', '02:00:00', '2010-05-26', '2010-05-26', 8, NULL, NULL, 1272613821, 0),
(90, '7990de', 'A', '01:00:00', '03:00:00', '2010-05-11', '2010-05-11', 8, NULL, NULL, 1272617699, 0),
(85, 'f2a7d8', 'A', '06:00:00', '13:00:00', '2010-05-30', '2010-05-30', 14, NULL, NULL, 1272612998, 0),
(82, 'ed922c', 'A', '01:00:00', '02:00:00', '2010-05-19', '2010-05-19', 8, NULL, NULL, 1272612362, 0),
(81, '57cfee', 'B', '10:00:00', '16:00:00', '2010-05-08', '2010-05-08', 14, NULL, NULL, 1272612312, 2),
(80, '57cfee', 'A', '10:00:00', '16:00:00', '2010-05-08', '2010-05-08', 14, NULL, NULL, 1272612312, 2),
(79, '008001', 'B', '02:00:00', '17:00:00', '2010-05-14', '2010-05-14', 8, NULL, NULL, 1272612169, 1),
(78, '008001', 'A', '02:00:00', '17:00:00', '2010-05-14', '2010-05-14', 8, NULL, NULL, 1272612169, 0),
(77, 'c51ce5', 'B', '01:00:00', '20:00:00', '2010-05-13', '2010-05-13', 8, NULL, NULL, 1272612105, 0),
(76, '5e8c94', 'A', '02:00:00', '15:00:00', '2010-05-13', '2010-05-13', 8, NULL, NULL, 1272611055, 0),
(75, '46d568', 'A', '02:00:00', '15:00:00', '2010-05-13', '2010-05-13', 8, NULL, NULL, 1272610914, 0),
(117, '00ed3c', 'B', '02:00:00', '06:00:00', '2010-05-15', '2010-05-15', 15, NULL, NULL, 1273558514, 1),
(116, 'a0bb10', 'A', '09:00:00', '10:00:00', '2010-05-20', '2010-05-20', 8, NULL, NULL, 1273558344, 0),
(67, 'ef3e5e', 'A', '06:00:00', '12:00:00', '2010-04-30', '2010-04-30', 13, NULL, NULL, 1272536377, 0),
(94, '90f4a4', 'A', '00:00:00', '01:00:00', '2010-05-06', '2010-05-06', NULL, NULL, NULL, 1272956354, 0),
(95, '3e41fc', 'A', '00:00:00', '01:00:00', '2010-05-06', '2010-05-06', NULL, NULL, NULL, 1272956502, 0),
(69, '22d7fc', 'A', '14:00:00', '16:00:00', '2010-05-01', '2010-05-01', 15, NULL, NULL, 1272607641, 1),
(110, '2f7ece', 'A', '18:00:00', '19:00:00', '2010-05-04', '2010-05-04', 8, NULL, NULL, 1272961397, 0),
(111, '7cebb9', 'A', '04:00:00', '05:00:00', '2010-05-05', '2010-05-05', NULL, NULL, NULL, 1272961611, 0),
(112, '68416d', 'A', '04:00:00', '05:00:00', '2010-05-05', '2010-05-05', 13, NULL, NULL, 1272965348, 0),
(113, 'cdd4d7', 'A', '17:00:00', '18:00:00', '2010-05-14', '2010-05-14', 8, NULL, NULL, 1272965791, 0),
(118, '7d6e53', 'A', '01:00:00', '02:00:00', '2010-05-28', '2010-05-28', 8, NULL, NULL, 1273560725, 0),
(119, 'c8fee5', 'A', '02:00:00', '03:00:00', '2010-05-22', '2010-05-22', 8, NULL, NULL, 1273562297, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Unregistereduser`
--

CREATE TABLE IF NOT EXISTS `Unregistereduser` (
  `idUnregistereduser` int(11) NOT NULL AUTO_INCREMENT,
  `UnregisteredEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `OrganizatioNname` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`idUnregistereduser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `Unregistereduser`
--

INSERT INTO `Unregistereduser` (`idUnregistereduser`, `UnregisteredEmailaddress`, `Address`, `Contactperson`, `OrganizatioNname`, `phone`) VALUES
(36, 'abbeygold101@yahoo.com', 'sammon 4', 'Abbey', 'Abbey int', '54689721'),
(42, 'boromil@gmail.com', 'kjhkjhkjh', 'kjhkjhkjh', 'rfwekjhk', '+23485205521'),
(38, 'valeloclan@hotmail.com', 'teree', 'elorm', 'TEKU', '123234223'),
(33, 'kayode_ogunlolu@yahoo.com', 'silicon valley 18', 'Prof. kay', 'Google inc.', '0404042200'),
(32, 'eloclan@yahoo.com', 'ghana', 'christoopher', 'teku', '2345678'),
(39, 'ab@ol.com', 'dhbjdjn', 'hidghujhfd', 'hdbdhg', '5112545615'),
(43, 'elorm.damalie@tokem.fi', 'teku', 'muhammes ali', 'scxhool', '2334556');

-- --------------------------------------------------------

--
-- Table structure for table `UpcomingEvents`
--

CREATE TABLE IF NOT EXISTS `UpcomingEvents` (
  `idUpcomingEvents` int(11) NOT NULL DEFAULT '0',
  `Title` varchar(25) NOT NULL,
  `Content` text NOT NULL,
  PRIMARY KEY (`idUpcomingEvents`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UpcomingEvents`
--

INSERT INTO `UpcomingEvents` (`idUpcomingEvents`, `Title`, `Content`) VALUES
(0, '2010.05.06', 'Kemi - Tornio'),
(1, '2010.08.07', 'Tornio - Rovaniemi'),
(2, '2010.08.15', 'Kemi - Helsinki');
