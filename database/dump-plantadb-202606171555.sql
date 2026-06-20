-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: plantadb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Hortaliças','Plantas cultivadas para consumo alimentar');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fase_planta`
--

DROP TABLE IF EXISTS `fase_planta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fase_planta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem` int(11) NOT NULL,
  `nome_fase` varchar(25) NOT NULL,
  `descricao` text DEFAULT NULL,
  `duracao_dias` int(11) NOT NULL,
  `agua_ml_dia` int(11) DEFAULT NULL,
  `frequencia_rega_dias` int(11) DEFAULT NULL,
  `dica_cuidado` text DEFAULT NULL,
  `imagem_url` varchar(90) DEFAULT NULL,
  `id_planta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_planta` (`id_planta`),
  CONSTRAINT `fase_planta_ibfk_1` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fase_planta`
--

LOCK TABLES `fase_planta` WRITE;
/*!40000 ALTER TABLE `fase_planta` DISABLE KEYS */;
INSERT INTO `fase_planta` VALUES (1,1,'Semeadura','Plantio das sementes no solo.',7,NULL,NULL,'Manter o solo umido.','https://exemplo.com/fase1.jpg',1),(2,2,'Germinacao','As sementes comecam a brotar.',7,NULL,NULL,'Evitar excesso de agua.','https://exemplo.com/fase2.jpg',1),(3,3,'Muda','Desenvolvimento inicial das folhas.',10,NULL,NULL,'Garantir boa iluminacao.','https://exemplo.com/fase3.jpg',1),(4,4,'Crescimento','Expansao das folhas e fortalecimento da planta.',20,NULL,NULL,'Adubar conforme necessario.','https://exemplo.com/fase4.jpg',1),(5,5,'Colheita','Planta pronta para consumo.',5,NULL,NULL,'Colher preferencialmente pela manha.','https://exemplo.com/fase5.jpg',1);
/*!40000 ALTER TABLE `fase_planta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_registros`
--

DROP TABLE IF EXISTS `historico_registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historico_registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_progresso_usuario` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_acao` enum('poda','rega','adubo','observacao') NOT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_progresso_usuario` (`id_progresso_usuario`),
  CONSTRAINT `historico_registros_ibfk_1` FOREIGN KEY (`id_progresso_usuario`) REFERENCES `progresso_usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_registros`
--

LOCK TABLES `historico_registros` WRITE;
/*!40000 ALTER TABLE `historico_registros` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantas`
--

DROP TABLE IF EXISTS `plantas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plantas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_comum` varchar(30) NOT NULL,
  `nome_cientifico` varchar(50) NOT NULL,
  `descricao` varchar(90) NOT NULL,
  `horas_sol_dia` int(11) DEFAULT NULL,
  `tipo_solo` varchar(20) DEFAULT NULL,
  `ph_solo_ideal` varchar(20) DEFAULT NULL,
  `clima_adequado` varchar(30) DEFAULT NULL,
  `temperatura_min` int(11) NOT NULL,
  `temperatura_max` int(11) NOT NULL,
  `umidade_ideal` varchar(30) DEFAULT NULL,
  `regiao_ideal` varchar(30) DEFAULT NULL,
  `tipo_adubo` varchar(30) DEFAULT NULL,
  `frequencia_adubacao` varchar(30) DEFAULT NULL,
  `espacamento_cm` varchar(10) DEFAULT NULL,
  `profundidade_plantio_cm` int(11) DEFAULT NULL,
  `pragas_comuns` text DEFAULT NULL,
  `doencas_comuns` text DEFAULT NULL,
  `imagem_url` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `plantas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantas`
--

LOCK TABLES `plantas` WRITE;
/*!40000 ALTER TABLE `plantas` DISABLE KEYS */;
INSERT INTO `plantas` VALUES (1,'Alface','Lactuca sativa','Hortalica folhosa de crescimento rapido.',6,'Argiloso','6.0-7.0','Temperado',10,28,'60-80%','Sul e Sudeste','Composto organico','A cada 15 dias','30',1,'Pulhoes, lagartas','Mildio, podridao radicular','https://exemplo.com/alface.jpg',1);
/*!40000 ALTER TABLE `plantas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progresso_usuario`
--

DROP TABLE IF EXISTS `progresso_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progresso_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_planta` int(11) NOT NULL,
  `data_inicio_cultivo` date NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('ativo','concluido','cancelado') DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_planta` (`id_planta`),
  CONSTRAINT `progresso_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `progresso_usuario_ibfk_2` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progresso_usuario`
--

LOCK TABLES `progresso_usuario` WRITE;
/*!40000 ALTER TABLE `progresso_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `progresso_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `criacao_conta` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'juan','juanjuan@gmail.com','$2y$10$C17wGUGVvxQ8mlXybSCNI.tkCfRFgP7qpM12ax812/dMEEGtIq6nq','','','2026-06-17 11:42:43',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'plantadb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-17 15:55:44
