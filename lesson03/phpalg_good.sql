CREATE DATABASE  IF NOT EXISTS `phpalg` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `phpalg`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: phpalg
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `clmenucat`
--

DROP TABLE IF EXISTS `clmenucat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clmenucat` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clmenucat`
--

LOCK TABLES `clmenucat` WRITE;
/*!40000 ALTER TABLE `clmenucat` DISABLE KEYS */;
INSERT INTO `clmenucat` VALUES (1,'MenuCL'),(2,'About'),(3,'Services'),(4,'Contacts'),(5,'Our History'),(6,'Our Mission'),(7,'Address'),(8,'Send Request'),(9,'Founders'),(10,'First project'),(11,'Milestones');
/*!40000 ALTER TABLE `clmenucat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clmenulink`
--

DROP TABLE IF EXISTS `clmenulink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clmenulink` (
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clmenulink`
--

LOCK TABLES `clmenulink` WRITE;
/*!40000 ALTER TABLE `clmenulink` DISABLE KEYS */;
INSERT INTO `clmenulink` VALUES (1,1,0),(1,2,1),(1,3,1),(1,4,1),(1,5,2),(1,6,2),(1,7,2),(1,8,2),(1,9,3),(1,10,3),(1,11,3),(2,2,1),(2,5,2),(2,6,2),(2,9,3),(2,10,3),(2,11,3),(5,5,2),(6,6,2),(5,9,3),(5,10,3),(5,11,3),(3,3,1),(4,4,1),(4,7,2),(4,8,2),(7,7,2),(8,8,2);
/*!40000 ALTER TABLE `clmenulink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `root` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Menu',0,21,0,1),(2,'About',1,12,1,1),(3,'Our History',2,9,2,1),(4,'Founders',3,4,3,1),(5,'First project',5,6,3,1),(6,'Milestones',7,8,3,1),(7,'Our Mission',10,11,2,1),(8,'Services',13,14,1,1),(9,'Contacts',15,20,1,1),(10,'Address',16,17,2,1),(11,'Send request',18,19,2,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-18 16:51:24
