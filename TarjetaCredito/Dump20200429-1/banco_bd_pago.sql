CREATE DATABASE  IF NOT EXISTS `banco_bd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `banco_bd`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: banco_bd
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.38-MariaDB

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
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `idPago` int(10) NOT NULL AUTO_INCREMENT,
  `num_tarjetaPago` varchar(128) NOT NULL,
  `montoPago` int(10) NOT NULL,
  `fechaPago` date NOT NULL,
  `clientePago` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`idPago`),
  KEY `num_tarjetaPago` (`num_tarjetaPago`),
  CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`num_tarjetaPago`) REFERENCES `tarjetas` (`Num_Tarjeta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` VALUES (5,'a6d8e15390bb03c910ae73a989ab6c2c433c8443a06c66db6f6e777d8c47c7f1dbef86d6127f7a4588a56e9e096fadf1ae1b0fa4fd552090f7698a128296cd46',344444,'2020-04-29','michael'),(6,'a6d8e15390bb03c910ae73a989ab6c2c433c8443a06c66db6f6e777d8c47c7f1dbef86d6127f7a4588a56e9e096fadf1ae1b0fa4fd552090f7698a128296cd46',344444,'2020-04-29','michael');
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-29 17:36:34
