-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2010 at 01:31 PM
-- Server version: 5.1.42
-- PHP Version: 5.3.1



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
  `AdminEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `password` varchar(12) NOT NULL,
  `phone` int(17) NOT NULL,
  PRIMARY KEY (`AdminEmailaddress`)
) TYPE=MyISAM;

--
-- Dumping data for table `adminusers`
--


-- --------------------------------------------------------

--
-- Table structure for table `registereduser`
--

CREATE TABLE IF NOT EXISTS `registereduser` (
  `RegisteredEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contact person` varchar(25) NOT NULL,
  `Organizationname` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `phone` int(17) NOT NULL,
  `confirmationcode` varchar(25) NOT NULL,
  PRIMARY KEY (`RegisteredEmailaddress`)
) TYPE=MyISAM;

--
-- Dumping data for table `registereduser`
--


-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
  `Reservecode` varchar(25) NOT NULL,
  `area` varchar(25) NOT NULL,
  `Statingtime` time NOT NULL,
  `Endingtime` time NOT NULL,
  `Startingdate` date NOT NULL,
  `Endingdate` date NOT NULL,
  `RegisteredEmailaddress` varchar(25) DEFAULT NULL,
  `AdminEmailaddress` varchar(25) DEFAULT NULL,
  `UnregisteredEmailaddress` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Reservecode`),
  FULLTEXT KEY `RegisteredEmailaddress` (`RegisteredEmailaddress`)
) TYPE=MyISAM;

--
-- Dumping data for table `Reservation`
--


-- --------------------------------------------------------

--
-- Table structure for table `Unregistereduser`
--

CREATE TABLE IF NOT EXISTS `Unregistereduser` (
  `UnregisteredEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `phone` int(17) NOT NULL,
  `organizationName` varchar(30) NOT NULL,
  PRIMARY KEY (`UnregisteredEmailaddress`)
) TYPE=MyISAM;

--
-- Dumping data for table `Unregistereduser`
--

