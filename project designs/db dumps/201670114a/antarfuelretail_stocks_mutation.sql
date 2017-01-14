CREATE DATABASE  IF NOT EXISTS `antarfuelretail` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `antarfuelretail`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: antarfuelretail
-- ------------------------------------------------------
-- Server version	5.6.19-log

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
-- Table structure for table `stocks_mutation`
--

DROP TABLE IF EXISTS `stocks_mutation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks_mutation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mutation_date` datetime DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `mutation_types` int(11) DEFAULT NULL,
  `stocks_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nip_fk` (`nip`),
  KEY `stocksid_fk` (`stocks_id`),
  KEY `mutationtypes_fk` (`mutation_types`),
  CONSTRAINT `mutationtypes_fk` FOREIGN KEY (`mutation_types`) REFERENCES `mutation_types` (`id`),
  CONSTRAINT `nip_fk` FOREIGN KEY (`nip`) REFERENCES `users_table` (`nip`),
  CONSTRAINT `stocksid_fk` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks_mutation`
--

LOCK TABLES `stocks_mutation` WRITE;
/*!40000 ALTER TABLE `stocks_mutation` DISABLE KEYS */;
INSERT INTO `stocks_mutation` VALUES (1,'2017-01-12 16:18:50','OP0001',7,2,1),(2,'2017-01-12 16:25:28','OP0001',3,2,1),(3,'2017-01-13 22:52:23','OP0001',5,2,1),(4,'2017-01-14 14:35:22','OP0001',2,1,1),(5,'2017-01-14 14:35:37','OP0001',3,1,1),(6,'2017-01-14 15:27:31','OP0001',2,1,1),(7,'2016-12-01 15:28:59','OP0001',1,1,1);
/*!40000 ALTER TABLE `stocks_mutation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-14 17:01:58
