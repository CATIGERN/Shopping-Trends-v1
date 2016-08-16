-- MySQL dump 10.13  Distrib 5.6.26, for Win64 (x86_64)
--
-- Host: localhost    Database: shoppingtrends
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `cartitems`
--

DROP TABLE IF EXISTS `cartitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartitems` (
  `idcart` int(11) NOT NULL,
  `iditem` int(11) NOT NULL,
  `itembought` binary(1) NOT NULL DEFAULT '0',
  `idstore` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `itemaddedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `itemupdatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idcart_idx` (`idcart`),
  KEY `iditem_idx` (`iditem`),
  KEY `idstore_idx` (`idstore`),
  CONSTRAINT `idcart` FOREIGN KEY (`idcart`) REFERENCES `carts` (`idcart`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `iditem` FOREIGN KEY (`iditem`) REFERENCES `items` (`iditem`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idstore` FOREIGN KEY (`idstore`) REFERENCES `stores` (`idstore`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartitems`
--

LOCK TABLES `cartitems` WRITE;
/*!40000 ALTER TABLE `cartitems` DISABLE KEYS */;
INSERT INTO `cartitems` VALUES (1,2,'1',16,20,6,'2016-08-13 19:07:26','2016-08-14 19:59:35'),(1,3,'1',14,100,100,'2016-08-13 19:07:39','2016-08-14 19:57:07'),(1,11,'0',NULL,NULL,NULL,'2016-08-14 13:58:38','2016-08-14 13:58:38'),(1,15,'1',15,200,1000,'2016-08-14 14:52:52','2016-08-14 19:59:13'),(1,16,'0',NULL,NULL,NULL,'2016-08-14 14:53:46','2016-08-14 14:53:46'),(1,17,'0',NULL,NULL,NULL,'2016-08-14 15:22:21','2016-08-14 15:22:21'),(1,18,'1',28,40,1,'2016-08-14 15:22:57','2016-08-15 20:17:29'),(4,11,'1',15,50,100,'2016-08-14 18:12:26','2016-08-15 05:43:06'),(3,8,'1',24,40,5,'2016-08-14 20:06:14','2016-08-15 11:22:00'),(4,19,'0',NULL,NULL,NULL,'2016-08-15 05:41:53','2016-08-15 05:41:53'),(1,20,'1',23,500,1,'2016-08-15 11:12:49','2016-08-15 11:20:07'),(3,21,'1',25,230,1,'2016-08-15 12:59:09','2016-08-15 13:00:28'),(3,22,'1',26,520,1,'2016-08-15 12:59:22','2016-08-15 13:00:49'),(3,23,'1',27,80,1,'2016-08-15 12:59:32','2016-08-15 13:01:05'),(1,19,'0',NULL,NULL,NULL,'2016-08-15 19:12:07','2016-08-15 19:12:07'),(4,26,'0',NULL,NULL,NULL,'2016-08-16 06:24:46','2016-08-16 06:24:46');
/*!40000 ALTER TABLE `cartitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `idcart` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `cartname` varchar(45) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcart`),
  KEY `userid_idx` (`userid`),
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,'Sunday List','2016-08-13 15:38:22','2016-08-13 15:38:22'),(3,1,'Month End Shopping','2016-08-14 18:11:03','2016-08-14 18:11:03'),(4,1,'Friday Shopping','2016-08-14 18:12:19','2016-08-14 18:12:19'),(5,1,'Random Shopping','2016-08-16 07:19:08','2016-08-16 07:19:08');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `iditem` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(45) NOT NULL,
  PRIMARY KEY (`iditem`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Eggs'),(2,'Banana'),(3,'Chicken'),(4,'Apple'),(5,'Bread'),(6,'Haldi'),(7,'Mango'),(8,'Guava'),(9,'Deodrant'),(11,'Rice'),(15,'Fish'),(16,'Raita'),(17,'Spinach'),(18,'Brocolli'),(19,'Wheat'),(20,'Headphones'),(21,'Ice Cream'),(22,'Pizza'),(23,'Chocolate'),(25,'Oats'),(26,'Tea');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `idstore` int(11) NOT NULL AUTO_INCREMENT,
  `storename` varchar(45) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`idstore`),
  KEY `iduser_idx` (`iduser`),
  CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (4,'Reliance',1),(14,'Reliance Fresh',1),(15,'Local Store',1),(16,'More',1),(23,'Amazon',1),(24,'Big Bazaar',1),(25,'Kwality walls',1),(26,'Dominos',1),(27,'DMart',1),(28,'Om Traders',1);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vishal','vishal');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-16 18:19:38
