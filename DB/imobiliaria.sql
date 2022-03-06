-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: imobiliaria
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `faturas`
--

DROP TABLE IF EXISTS `faturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) DEFAULT NULL,
  `observacoes` longtext,
  `codFatura` varchar(45) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `valor_fatura` decimal(10,2) DEFAULT NULL,
  `valor_repasse` decimal(10,2) DEFAULT NULL,
  `valor_taxaadministrativa` decimal(10,2) DEFAULT NULL,
  `status_fatura` int(11) DEFAULT '0' COMMENT '0 - em aberto | 1 - pago',
  `parcela_concorrente` int(11) DEFAULT NULL,
  `status_repasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faturas_contrato_aluguel_idx` (`contrato_id`),
  CONSTRAINT `fk_faturas_contrato_aluguel` FOREIGN KEY (`contrato_id`) REFERENCES `contrato_aluguel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturas`
--

LOCK TABLES `faturas` WRITE;
/*!40000 ALTER TABLE `faturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `faturas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-06 13:37:58
