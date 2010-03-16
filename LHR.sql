-- MySQL dump 10.13  Distrib 5.1.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: LHR
-- ------------------------------------------------------
-- Server version	5.1.37-1ubuntu5.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservation` (
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservation`
--

LOCK TABLES `Reservation` WRITE;
/*!40000 ALTER TABLE `Reservation` DISABLE KEYS */;
INSERT INTO `Reservation` VALUES (4,NULL,'A','00:00:00','01:00:00','2010-03-09','2010-03-09',NULL,11,NULL,1267707874),(3,NULL,'A','00:00:00','01:00:00','2010-03-09','2010-03-09',2,NULL,NULL,1267697015),(5,NULL,'A','00:00:00','01:00:00','2010-03-08','2010-03-08',2,NULL,NULL,1267708090),(6,NULL,'A','00:00:00','01:00:00','2010-03-10','2010-03-10',2,NULL,NULL,1267708104),(7,NULL,'A','03:00:00','06:00:00','2010-03-10','2010-03-10',NULL,12,NULL,1267708457),(8,NULL,'A','08:00:00','18:00:00','2010-03-05','2010-03-05',2,NULL,NULL,1267708690),(9,NULL,'A','10:00:00','22:00:00','2010-03-08','2010-03-08',NULL,13,NULL,1267708771),(10,NULL,'A','21:00:00','01:00:00','2010-03-01','2010-03-02',NULL,14,NULL,1267718596),(11,NULL,'A','07:00:00','11:00:00','2010-03-01','2010-03-01',NULL,15,NULL,1267718790),(12,NULL,'A','22:00:00','02:00:00','2010-03-04','2010-03-05',NULL,11,NULL,1267718919),(13,NULL,'A','10:00:00','12:00:00','2010-03-05','2010-03-05',NULL,16,NULL,1267718992),(14,NULL,'A','06:00:00','08:00:00','2010-03-05','2010-03-05',2,NULL,NULL,1267719059),(15,NULL,'B','05:00:00','08:00:00','2010-03-05','2010-03-05',NULL,11,1,1267749122),(16,NULL,'B','04:00:00','06:00:00','2010-03-10','2010-03-10',2,NULL,NULL,1267749198),(17,NULL,'A','10:00:00','12:00:00','2010-03-05','2010-03-05',NULL,17,NULL,1267781975),(18,NULL,'B','04:00:00','05:00:00','1999-11-30','1999-11-30',NULL,12,NULL,1267858890),(19,NULL,'A','03:00:00','04:00:00','2010-03-05','2010-03-05',NULL,11,NULL,1267858943),(20,NULL,'B','04:00:00','05:00:00','2010-03-05','2010-03-05',NULL,12,1,1267859336),(21,NULL,'B','01:00:00','02:00:00','2010-03-05','2010-03-05',NULL,18,1,1267859576),(22,NULL,'B','03:00:00','04:00:00','2010-03-05','2010-03-05',NULL,14,NULL,1267859618);
/*!40000 ALTER TABLE `Reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Unregistereduser`
--

DROP TABLE IF EXISTS `Unregistereduser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Unregistereduser` (
  `idUnregistereduser` int(11) NOT NULL AUTO_INCREMENT,
  `UnregisteredEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `OrganizatioNname` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`idUnregistereduser`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Unregistereduser`
--

LOCK TABLES `Unregistereduser` WRITE;
/*!40000 ALTER TABLE `Unregistereduser` DISABLE KEYS */;
INSERT INTO `Unregistereduser` VALUES (12,'a','a','a','a','a'),(11,'x','x','x','x','x'),(10,'x1','x1','x1','x1','x1'),(9,'lolek@o2.pl','warszawa','Lolek','home','23232323'),(13,'xa','xa','xa','xa','xa'),(14,'q','q','q','q','q'),(15,'aa','aa','aa','aa','aa'),(16,'f','f','f','f','f'),(17,'cos@mail','kemi','Zdzisiek','home','123343434'),(18,'s','s','s','s','s');
/*!40000 ALTER TABLE `Unregistereduser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UpcomingEvents`
--

DROP TABLE IF EXISTS `UpcomingEvents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UpcomingEvents` (
  `idUpcomingEvents` int(11) NOT NULL DEFAULT '0',
  `Title` varchar(25) NOT NULL,
  `Content` text NOT NULL,
  PRIMARY KEY (`idUpcomingEvents`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UpcomingEvents`
--

LOCK TABLES `UpcomingEvents` WRITE;
/*!40000 ALTER TABLE `UpcomingEvents` DISABLE KEYS */;
/*!40000 ALTER TABLE `UpcomingEvents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminusers`
--

DROP TABLE IF EXISTS `adminusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminusers` (
  `idAdminuser` int(11) NOT NULL AUTO_INCREMENT,
  `AdminEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `password` varchar(12) NOT NULL,
  `phone` varchar(12) NOT NULL,
  PRIMARY KEY (`idAdminuser`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminusers`
--

LOCK TABLES `adminusers` WRITE;
/*!40000 ALTER TABLE `adminusers` DISABLE KEYS */;
INSERT INTO `adminusers` VALUES (1,'admin@o2.pl','lomza','Zdzisiek','123','321');
/*!40000 ALTER TABLE `adminusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registereduser`
--

DROP TABLE IF EXISTS `registereduser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registereduser` (
  `idRegistereduser` int(11) NOT NULL AUTO_INCREMENT,
  `RegisteredEmailaddress` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Contactperson` varchar(25) NOT NULL,
  `Organizationname` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `confirmationcode` varchar(25) NOT NULL,
  PRIMARY KEY (`idRegistereduser`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registereduser`
--

LOCK TABLES `registereduser` WRITE;
/*!40000 ALTER TABLE `registereduser` DISABLE KEYS */;
INSERT INTO `registereduser` VALUES (1,'ludo@o2.pl','ludo','ludo','ludo','ludo','ludo',''),(2,'x','x','x','x','x','x',''),(3,'a','a','a','a','a','a',''),(4,'wa','wa','wa','wa','wa','wa','');
/*!40000 ALTER TABLE `registereduser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-03-06 10:59:37
