-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: proshop
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Roupas Mulher',1,1,NULL),(2,'Roupas Homem',2,1,NULL),(3,'Jóias e Relógios ',3,1,NULL),(4,'Computadores e Escritórios',4,1,NULL),(5,'Telefones e Acessórios',5,1,NULL),(6,'Pastas e Calçados',6,1,NULL);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_envio`
--

DROP TABLE IF EXISTS `metodo_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_envio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `detalhes` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_envio`
--

LOCK TABLES `metodo_envio` WRITE;
/*!40000 ALTER TABLE `metodo_envio` DISABLE KEYS */;
INSERT INTO `metodo_envio` VALUES (1,'Envia grátis',0,'Envio da mercadoria e/ou produto sem cobranças adicionais',1),(2,'Padão',1000,'Envio padão, com a cobrança de uma pequena taxa',1);
/*!40000 ALTER TABLE `metodo_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pagamentos`
--

DROP TABLE IF EXISTS `metodo_pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `detalhes` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pagamentos`
--

LOCK TABLES `metodo_pagamentos` WRITE;
/*!40000 ALTER TABLE `metodo_pagamentos` DISABLE KEYS */;
INSERT INTO `metodo_pagamentos` VALUES (1,'Tranferência Bancária','Transferência de um Banco para o outro através do IBAN',1),(2,'A vista','Pagamento feito com os valores em mão, sem haver necessidaed de transfência ou depósito bancário',1),(3,'Multicaixa','Pagamento com o cartão Multicaixa do cliente',1);
/*!40000 ALTER TABLE `metodo_pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_atributos`
--

DROP TABLE IF EXISTS `produto_atributos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_atributos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atributo` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `fk_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_atributos`
--

LOCK TABLES `produto_atributos` WRITE;
/*!40000 ALTER TABLE `produto_atributos` DISABLE KEYS */;
INSERT INTO `produto_atributos` VALUES (1,'Salto','8 cm',1,1),(2,'Feixo','SIM',1,1),(3,'Bolso moeda','SIM',1,2),(4,'Atributo','valor',1,3),(5,'Bracelete','Cabedal',1,4);
/*!40000 ALTER TABLE `produto_atributos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) DEFAULT NULL,
  `descricao` text,
  `codigo` varchar(45) DEFAULT NULL,
  `qtd_minima` int(11) DEFAULT NULL,
  `palavra_chave` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `venda` int(11) DEFAULT NULL,
  `preco` double DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `fk_categoria` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Sapato Salto alto estilo Bota','Sapato salta alto estilo Bota, para ocasiões diversas  ','001',5,'sapato',1,1,7500,'Gucci',6,NULL),(2,'Carteira do Bolso','Carteira do Bolso, para homens, com tamanhos diversos que cabem em qualquer bolso.','011',10,'Carteira',1,1,2700,'TOMMY',6,NULL),(3,'Tênis Desportivo','Tênis Desportivo de marca NIKE, usado para actividades desportivas e de relaxamento','028',10,'tênis',1,1,25000,'NIKE',6,NULL),(4,'Relógio ','Relógio Masculino, com Bracelete cabedal','090',5,'Relógio',1,1,14500,'Swotch',3,NULL);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos_imagens`
--

DROP TABLE IF EXISTS `produtos_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_imagens` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fk_produto` int(11) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `cor` varchar(45) DEFAULT NULL,
  `tamanho` varchar(45) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_imagens`
--

LOCK TABLES `produtos_imagens` WRITE;
/*!40000 ALTER TABLE `produtos_imagens` DISABLE KEYS */;
INSERT INTO `produtos_imagens` VALUES (1,1,'Sapato Salto alto estilo Bota_0_001.jpg','#000000','42',5,1,NULL),(2,1,'Sapato Salto alto estilo Bota_1_001.jpg','#000000','39',8,1,NULL),(3,1,'Sapato Salto alto estilo Bota_2_001.jpg','#000000','37',4,1,NULL),(4,1,'Sapato Salto alto estilo Bota_3_001.jpg','#000000','38',2,1,NULL),(5,2,'Carteira do Bolso_0_011.jpg','#837777','120',4,1,NULL),(6,2,'Carteira do Bolso_1_011.jpg','#837777','100',4,1,NULL),(7,2,'Carteira do Bolso_2_011.jpg','#837777','150',4,1,NULL),(8,2,'Carteira do Bolso_3_011.jpg','#837777','110',4,1,NULL),(9,3,'Tênis Desportivo_0_028.jpg','#ffffff','42',10,1,NULL),(10,3,'Tênis Desportivo_1_028.jpg','#ffffff','44',5,1,NULL),(11,3,'Tênis Desportivo_2_028.jpg','#ffffff','39',12,1,NULL),(12,4,'Relógio _0_090.jpg','#000000','90',2,1,NULL),(13,4,'Relógio _1_090.jpg','#000000','80',2,1,NULL),(14,4,'Relógio _2_090.jpg','#000000','85',2,1,NULL);
/*!40000 ALTER TABLE `produtos_imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos_promocao`
--

DROP TABLE IF EXISTS `produtos_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_promocao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_produto` int(11) DEFAULT NULL,
  `preco` double DEFAULT NULL,
  `data_criada` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_promocao`
--

LOCK TABLES `produtos_promocao` WRITE;
/*!40000 ALTER TABLE `produtos_promocao` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categorias`
--

DROP TABLE IF EXISTS `sub_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `fk_categoria` int(11) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categorias`
--

LOCK TABLES `sub_categorias` WRITE;
/*!40000 ALTER TABLE `sub_categorias` DISABLE KEYS */;
INSERT INTO `sub_categorias` VALUES (1,'Bolsa',1,1,1,NULL),(2,'Calças',1,1,2,NULL);
/*!40000 ALTER TABLE `sub_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proshop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-19 16:22:39
