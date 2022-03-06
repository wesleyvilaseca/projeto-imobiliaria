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
-- Table structure for table `contrato_aluguel`
--

DROP TABLE IF EXISTS `contrato_aluguel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrato_aluguel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locatario_id` int(11) DEFAULT NULL,
  `imovel_id` int(11) DEFAULT NULL,
  `contrato` longtext,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `taxa_administracao` decimal(10,2) DEFAULT NULL,
  `valor_aluguel` decimal(10,2) DEFAULT NULL,
  `valor_condominio` decimal(10,2) DEFAULT NULL,
  `valor_iptu` decimal(10,2) DEFAULT NULL,
  `codigo_contrato` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contrato_aluguel_locatario1_idx` (`locatario_id`),
  KEY `fk_contrato_aluguel_imoveis1_idx` (`imovel_id`),
  CONSTRAINT `fk_contrato_aluguel_imoveis1` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_aluguel_locatario1` FOREIGN KEY (`locatario_id`) REFERENCES `locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_aluguel`
--

LOCK TABLES `contrato_aluguel` WRITE;
/*!40000 ALTER TABLE `contrato_aluguel` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato_aluguel` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locador_id` int(11) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `numero` decimal(10,0) DEFAULT NULL,
  `bairro` varchar(200) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imoveis_locador1_idx` (`locador_id`),
  CONSTRAINT `fk_imoveis_locador1` FOREIGN KEY (`locador_id`) REFERENCES `locador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES (6,3,'66623-270','Passagem H-1',20,'Marambaia','PA','proximo a sn6',NULL,'Belém'),(7,3,'68459-810','Travessa W-Nove',521,'COHAB','PA','Prox a Perimetral',NULL,'Tucuruí'),(8,4,'66053-430','Alameda Maria José Nobre',10,'Reduto','PA','Prédio Abílio Velho AP 502',NULL,'Belém'),(9,4,'66053-430','Alameda Maria José Nobre',20,'Reduto','PA','Prédio Abílio Velho AP 602',NULL,'Belém');
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locador`
--

DROP TABLE IF EXISTS `locador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `data_repasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locador`
--

LOCK TABLES `locador` WRITE;
/*!40000 ALTER TABLE `locador` DISABLE KEYS */;
INSERT INTO `locador` VALUES (3,'Wesley Vila Seca Sanches','wesley@mail.com','(91) 98820-3132',5),(4,'Jeremias Sanches','jeremias@mail.com','(91) 88888-8888',1);
/*!40000 ALTER TABLE `locador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locatario`
--

DROP TABLE IF EXISTS `locatario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locatario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locatario`
--

LOCK TABLES `locatario` WRITE;
/*!40000 ALTER TABLE `locatario` DISABLE KEYS */;
INSERT INTO `locatario` VALUES (9,'Camila Oliveira','camila@mail.com','(91) 98820-3131'),(10,'Maria do Socorro Vila Seca','maria@mail.com','(91) 98888-8888');
/*!40000 ALTER TABLE `locatario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `enable` varchar(1) NOT NULL DEFAULT 'N',
  `enabled` varchar(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Wesley Sanches','wesley.vilaseca@hotmail.com','wesley','e10adc3949ba59abbe56e057f20f883e','S','S');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-06 13:30:13
