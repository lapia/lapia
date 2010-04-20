-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2010 at 09:11 AM
-- Server version: 5.1.45
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`idAdminuser`, `AdminEmailaddress`, `Address`, `Contactperson`, `password`, `phone`) VALUES
(1, 'admin@o2.pl', 'lomza', 'Zdzisiek', '123', '321');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `registereduser`
--

INSERT INTO `registereduser` (`idRegistereduser`, `RegisteredEmailaddress`, `Address`, `Contactperson`, `Organizationname`, `password`, `phone`, `confirmationcode`) VALUES
(1, 'ludo@o2.pl', 'ludo', 'ludo', 'ludo', 'ludo', 'ludo', ''),
(2, 'x', 'x', 'x', 'x', 'x', 'x', ''),
(3, 'a', 'a', 'a', 'a', 'a', 'a', ''),
(4, 'wa', 'wa', 'wa', 'wa', 'wa', 'wa', ''),
(8, 'boromil@gmail.com', 'none', 'mememe', 'boromil@gmai', 'qweqweqwe', '123123123', ''),
(9, 'test@test.fi', 'test', 'test', 'test', 'testtest', '1234', ''),
(10, 'abbeyola@yahoo.com', 'Sammonkatu4, B3 Kemi', 'Abbey', 'kingbios', 'kingstar', '445311318', ''),
(11, 'ludomirc@gmail.com', 'home', 'home', 'home', 'beniamin', 'home', ''),
(12, 'walecoolfm@yahoo.com', 'sammonkatu 4 c 1', 'Mr Thai Bui', 'kemi-tornio ', 'walenchy1939', '0443233475', ''),
(13, 'valeloclan@hotmail.com', 'reservi', 'Mr Thai Bui', 'TEKU', 'ghana12', '256498745', '');

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
  PRIMARY KEY (`idReservation`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`idReservation`, `Reservecode`, `area`, `Statingtime`, `Endingtime`, `Startingdate`, `Endingdate`, `idRegistereduser`, `idUnregistereduser`, `idAdminuser`, `TimeStemp`) VALUES
(4, NULL, 'A', '00:00:00', '01:00:00', '2010-03-09', '2010-03-09', NULL, 11, NULL, 1267707874),
(3, NULL, 'A', '00:00:00', '01:00:00', '2010-03-09', '2010-03-09', 2, NULL, NULL, 1267697015),
(5, NULL, 'A', '00:00:00', '01:00:00', '2010-03-08', '2010-03-08', 2, NULL, NULL, 1267708090),
(6, NULL, 'A', '00:00:00', '01:00:00', '2010-03-10', '2010-03-10', 2, NULL, NULL, 1267708104),
(7, NULL, 'A', '03:00:00', '06:00:00', '2010-03-10', '2010-03-10', NULL, 12, NULL, 1267708457),
(8, NULL, 'A', '08:00:00', '18:00:00', '2010-03-05', '2010-03-05', 2, NULL, NULL, 1267708690),
(9, NULL, 'A', '10:00:00', '22:00:00', '2010-03-08', '2010-03-08', NULL, 13, NULL, 1267708771),
(10, NULL, 'A', '21:00:00', '01:00:00', '2010-03-01', '2010-03-02', NULL, 14, NULL, 1267718596),
(11, NULL, 'A', '07:00:00', '11:00:00', '2010-03-01', '2010-03-01', NULL, 15, NULL, 1267718790),
(12, NULL, 'A', '22:00:00', '02:00:00', '2010-03-04', '2010-03-05', NULL, 11, NULL, 1267718919),
(13, NULL, 'A', '10:00:00', '12:00:00', '2010-03-05', '2010-03-05', NULL, 16, NULL, 1267718992),
(14, NULL, 'A', '06:00:00', '08:00:00', '2010-03-05', '2010-03-05', 2, NULL, NULL, 1267719059),
(15, NULL, 'B', '05:00:00', '08:00:00', '2010-03-05', '2010-03-05', NULL, 11, 1, 1267749122),
(16, NULL, 'B', '04:00:00', '06:00:00', '2010-03-10', '2010-03-10', 2, NULL, NULL, 1267749198),
(17, NULL, 'A', '10:00:00', '12:00:00', '2010-03-05', '2010-03-05', NULL, 17, NULL, 1267781975),
(18, NULL, 'B', '04:00:00', '05:00:00', '1999-11-30', '1999-11-30', NULL, 12, NULL, 1267858890),
(19, NULL, 'A', '03:00:00', '04:00:00', '2010-03-05', '2010-03-05', NULL, 11, NULL, 1267858943),
(20, NULL, 'B', '04:00:00', '05:00:00', '2010-03-05', '2010-03-05', NULL, 12, 1, 1267859336),
(21, NULL, 'B', '01:00:00', '02:00:00', '2010-03-05', '2010-03-05', NULL, 18, 1, 1267859576),
(22, NULL, 'B', '03:00:00', '04:00:00', '2010-03-05', '2010-03-05', NULL, 14, NULL, 1267859618),
(23, 'fff731', 'A', '00:00:00', '01:00:00', '2010-03-04', '2010-03-04', 8, NULL, NULL, 1269931436),
(24, 'c22ace', 'A', '03:00:00', '08:00:00', '2010-03-17', '2010-03-17', 8, NULL, NULL, 1269931444),
(25, '008143', 'A', '00:00:00', '01:00:00', '2010-03-30', '2010-03-30', 8, NULL, NULL, 1269931634),
(26, 'fc505b', 'A', '00:00:00', '01:00:00', '2010-03-30', '2010-03-30', 8, NULL, NULL, 1269931639),
(27, 'c3e8f9', 'A', '00:00:00', '01:00:00', '2010-03-30', '2010-03-30', 8, NULL, NULL, 1269931642),
(28, 'fefcba', 'A', '00:00:00', '01:00:00', '2010-03-16', '2010-03-16', 8, NULL, NULL, 1269931644),
(29, 'd2487a', 'A', '00:00:00', '01:00:00', '2010-03-30', '2010-03-30', 8, NULL, NULL, 1269931692),
(30, 'f6f521', 'A', '00:00:00', '01:00:00', '2010-03-30', '2010-03-30', 8, NULL, NULL, 1269931697),
(31, '5e6d10', 'A', '00:00:00', '01:00:00', '2010-04-10', '2010-04-10', 8, NULL, NULL, 1270805534),
(32, '8879cc', 'A', '00:00:00', '01:00:00', '2010-04-10', '2010-04-10', 8, NULL, NULL, 1270805620),
(33, 'ea67fd', 'A', '00:00:00', '01:00:00', '2010-04-14', '2010-04-14', 8, NULL, NULL, 1271137387);

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE IF NOT EXISTS `time_table` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `duration` time NOT NULL,
  `date` date NOT NULL,
  `time` varchar(40) NOT NULL,
  `date2` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `authcode` varchar(40) NOT NULL,
  PRIMARY KEY (`time_id`),
  KEY `service_id` (`date2`),
  KEY `staff_id` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`time_id`, `duration`, `date`, `time`, `date2`, `email`, `name`, `status`, `authcode`) VALUES
(1, '30:00:00', '2009-10-14', '08:00', '13:00', 'kate@hotmail.com', 'kate', 'denied', 'sdf456'),
(2, '00:03:00', '2009-10-11', '09:00', '13:00', 'zone@hotmail.com', 'zone', 'denied', 'wer489'),
(3, '00:03:00', '2009-10-11', '09:00', '13:00', 'poll@yahoo.com', 'poll', 'denied', 'qwe153'),
(4, '00:03:00', '2009-10-11', '09:00', '13:00', 'jone@yahoo.com', 'jone', 'pending', 'zxc444'),
(5, '00:03:00', '2009-10-12', '09:00', '13:00', 'shala@yahoo.com', 'shala', 'denied', 'fgh153'),
(6, '00:03:00', '2009-10-13', '09:00', '13:00', 'telisa', 'telisa', 'denied', 'wer777');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `Unregistereduser`
--

INSERT INTO `Unregistereduser` (`idUnregistereduser`, `UnregisteredEmailaddress`, `Address`, `Contactperson`, `OrganizatioNname`, `phone`) VALUES
(12, 'a', 'a', 'a', 'a', 'a'),
(11, 'x', 'x', 'x', 'x', 'x'),
(10, 'x1', 'x1', 'x1', 'x1', 'x1'),
(9, 'lolek@o2.pl', 'warszawa', 'Lolek', 'home', '23232323'),
(13, 'xa', 'xa', 'xa', 'xa', 'xa'),
(14, 'q', 'q', 'q', 'q', 'q'),
(15, 'aa', 'aa', 'aa', 'aa', 'aa'),
(16, 'f', 'f', 'f', 'f', 'f'),
(17, 'cos@mail', 'kemi', 'Zdzisiek', 'home', '123343434'),
(18, 's', 's', 's', 's', 's');

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

