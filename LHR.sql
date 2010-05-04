-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2010 at 09:45 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `registereduser`
--

INSERT INTO `registereduser` (`idRegistereduser`, `RegisteredEmailaddress`, `Address`, `Contactperson`, `Organizationname`, `password`, `phone`, `confirmationcode`) VALUES
(1, 'ludo@o2.pl', 'ludo', 'ludo', 'ludo', 'ludo', 'ludo', ''),
(2, 'x', 'x', 'x', 'x', 'x', 'x', ''),
(3, 'a', 'a', 'a', 'a', 'a', 'a', ''),
(4, 'wa', 'wa', 'wa', 'wa', 'wa', 'wa', ''),
(8, 'boromil@gmail.com', 'sdfrsdf', 'fghvch', 'boromil@gmai', 'qweqweqwe', '123123123', ''),
(9, 'test@test.fi', 'test', 'test', 'test', 'testtest', '1234', ''),
(10, 'abbeyola@yahoo.com', 'Sammonkatu4, B3 Kemi', 'Abbey', 'kingbios', 'kingstar', '445311318', ''),
(11, 'ludomirc@gmail.com', 'home', 'home', 'home', 'beniamin', 'home', ''),
(12, 'walecoolfm@yahoo.com', 'sammonkatu 4 c 1', 'Mr Thai Bui', 'kemi-tornio ', 'walenchy1939', '0443233475', ''),
(13, 'valeloclan@hotmail.com', 'Teku', 'Mr Elorm Damalie', 'teku', 'ghana12', '256498745', ''),
(14, 'isaakay111@yahoo.com', 'hillevinkatu 37', 'Thai Bui', 'kingbios', 'kilowade', '0442099307', ''),
(15, 'abbeygold101@yahoo.com', 'sammon 4', 'Abbey', 'Abbey int', '123456', '54689721', ''),
(16, '', '', '', '', '', '', ''),
(17, 'eloclan@yahoo.com', 'reser', 'mr thai', 'teku', 'finland', '987678', ''),
(18, 'kayode_ogunlolu@yahoo.com', 'kemi city', 'benek', 'kemi tornoi ', 'commando', '000000', ''),
(19, 'abbeygold101@hotmail.com', 'ksjsjio', 'Abbey', 'Abeey', '123456', '12525', ''),
(20, 'elorm.damale@tokem.fi', 'Tema', 'Kwaku Damalie', 'school', 'allen12', '543762', ''),
(21, 'kingbios2000@yahoo.co.uk', 'hjhkjjo', 'abey', 'ade', '123456', '11454564', ''),
(22, 'boromil3@dasd.fi', 'kjhkjhkjh', 'Abbey', 'Abbey int', 'qwertyu', '12321321', ''),
(23, 'fdsdas@dad.ds', 'sammon 4', 'kjhkjhkjh', 'rfwekjhk', 'qweqweqweqwe', '12321321', ''),
(24, 'test@test.com', 'deletemeimmediately', 'test', 'justtesting', 'deleteme', '000', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`idReservation`, `Reservecode`, `area`, `Statingtime`, `Endingtime`, `Startingdate`, `Endingdate`, `idRegistereduser`, `idUnregistereduser`, `idAdminuser`, `TimeStemp`, `Status`) VALUES
(91, 'e621b9', 'A', '00:00:00', '01:00:00', '2010-05-05', '2010-05-05', 8, NULL, NULL, 1272955052, 0),
(89, '1e7255', 'A', '01:00:00', '18:00:00', '2010-05-18', '2010-05-18', 8, NULL, NULL, 1272614090, 1),
(88, 'c5fb91', 'A', '01:00:00', '02:00:00', '2010-05-26', '2010-05-26', 8, NULL, NULL, 1272613821, 0),
(90, '7990de', 'A', '01:00:00', '03:00:00', '2010-05-11', '2010-05-11', 8, NULL, NULL, 1272617699, 0),
(85, 'f2a7d8', 'A', '06:00:00', '13:00:00', '2010-05-30', '2010-05-30', 14, NULL, NULL, 1272612998, 0),
(82, 'ed922c', 'A', '01:00:00', '02:00:00', '2010-05-19', '2010-05-19', 8, NULL, NULL, 1272612362, 0),
(81, '57cfee', 'B', '10:00:00', '16:00:00', '2010-05-08', '2010-05-08', 14, NULL, NULL, 1272612312, 2),
(80, '57cfee', 'A', '10:00:00', '16:00:00', '2010-05-08', '2010-05-08', 14, NULL, NULL, 1272612312, 2),
(79, '008001', 'B', '02:00:00', '17:00:00', '2010-05-14', '2010-05-14', 8, NULL, NULL, 1272612169, 0),
(78, '008001', 'A', '02:00:00', '17:00:00', '2010-05-14', '2010-05-14', 8, NULL, NULL, 1272612169, 0),
(77, 'c51ce5', 'B', '01:00:00', '20:00:00', '2010-05-13', '2010-05-13', 8, NULL, NULL, 1272612105, 0),
(76, '5e8c94', 'A', '02:00:00', '15:00:00', '2010-05-13', '2010-05-13', 8, NULL, NULL, 1272611055, 0),
(75, '46d568', 'A', '02:00:00', '15:00:00', '2010-05-13', '2010-05-13', 8, NULL, NULL, 1272610914, 0),
(73, '774f1d', 'B', '01:00:00', '15:00:00', '2010-05-12', '2010-05-12', 8, NULL, NULL, 1272609970, 0),
(72, '774f1d', 'A', '01:00:00', '15:00:00', '2010-05-12', '2010-05-12', 8, NULL, NULL, 1272609970, 0),
(70, '0ff883', 'A', '02:00:00', '17:00:00', '2010-05-01', '2010-05-01', 8, NULL, NULL, 1272609933, 0),
(67, 'ef3e5e', 'A', '06:00:00', '12:00:00', '2010-04-30', '2010-04-30', 13, NULL, NULL, 1272536377, 0),
(74, 'b173a9', 'A', '02:00:00', '03:00:00', '2010-05-14', '2010-05-14', 8, NULL, NULL, 1272610812, 0),
(69, '22d7fc', 'A', '14:00:00', '16:00:00', '2010-05-01', '2010-05-01', 15, NULL, NULL, 1272607641, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `Unregistereduser`
--

INSERT INTO `Unregistereduser` (`idUnregistereduser`, `UnregisteredEmailaddress`, `Address`, `Contactperson`, `OrganizatioNname`, `phone`) VALUES
(33, 'kayode_ogunlolu@yahoo.com', 'silicon valley 18', 'Prof. kay', 'Google inc.', '0404042200'),
(32, 'eloclan@yahoo.com', 'ghana', 'christoopher', 'teku', '2345678'),
(31, 'kurisu@o2.pl', 'kjhkjhkjh', 'kjhkjhkjh', 'rfwekjhk', '12321321'),
(30, 'boromil@gmail.com', 'kjhkjhkjh', 'kjhkjhkjh', 'rfwekjhk', '12321321');

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
