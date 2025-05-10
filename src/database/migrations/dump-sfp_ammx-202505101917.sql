-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 172.30.0.59    Database: sfp_ammx
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.27-MariaDB-0+deb10u1

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
-- Table structure for table `etapa_vendas_alinhamento`
--

DROP TABLE IF EXISTS `etapa_vendas_alinhamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etapa_vendas_alinhamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processo_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `familia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prazo_entrega` date DEFAULT NULL,
  `documentacao_suplementar` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentacao_descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receita_linha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destino` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solicitante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prazo_entrega_cliente` date DEFAULT NULL,
  `frete_tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frete_tipo_transporte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentual_comissao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporto` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `etapa_vendas_alinhamento_unique` (`processo_uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapa_vendas_alinhamento`
--

LOCK TABLES `etapa_vendas_alinhamento` WRITE;
/*!40000 ALTER TABLE `etapa_vendas_alinhamento` DISABLE KEYS */;
INSERT INTO `etapa_vendas_alinhamento` VALUES (1,'78107aea-4ea7-4f60-a8c4-8624c55849db','2bb22029-bfc1-4d6b-ab58-4391b7ff24a7','2025-05-07 14:32:38','2025-05-07 14:32:38',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'55eae3c7-4630-4cf8-b6a2-5279c6bda122','403bc4df-743f-40b6-833a-31d73924f9e2','2025-05-07 14:43:42','2025-05-07 14:43:42',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'3c0cf910-9589-4c58-bcf6-e4728a225a6f','3d6d37b6-8aa5-477e-b758-5c4731c8cd62','2025-05-07 14:44:01','2025-05-07 14:44:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'797943de-9218-43b0-b824-44e0fd7bbe8b','f33bd5f1-d179-4ac0-8156-d1437974576b','2025-05-07 14:46:13','2025-05-07 14:46:13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'6a9430a1-733b-4a64-8822-e20461930c4d','c7861355-1692-4855-86d1-a34b3a759d62','2025-05-07 14:47:24','2025-05-07 14:47:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'c4dd8ab8-a0c2-4677-b721-ab6bd26c0486','baad243e-d344-451d-8d5d-0cdf78ad5455','2025-05-07 14:48:12','2025-05-07 14:48:12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'5722b3fc-e44f-41ef-9d60-1d2b1e97f226','f887e0fa-5e01-4045-a790-f74572f355aa','2025-05-07 14:48:13','2025-05-07 14:48:13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'f289578b-ea48-4a92-a773-2f0762b007b7','df357721-581f-4c4b-87f3-42a4be86d051','2025-05-07 14:48:14','2025-05-07 14:48:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'16a35434-53e7-4b29-82b6-9be616b31f79','030e0ba9-1ca1-4375-8d03-713d81d763db','2025-05-07 14:48:51','2025-05-07 14:48:51',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'10a8aee6-aa95-4a47-a8e8-4b4fbce50061','74ab4369-09a3-4e16-ad99-0210e00c717f','2025-05-07 14:56:06','2025-05-07 14:56:06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'8b123e61-c3db-469b-9bd2-9f2418d00537','fce19b92-2790-42ef-a21d-a74693c6cfed','2025-05-07 14:58:11','2025-05-07 14:58:11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'1c2a68a2-86c6-4ee9-8ab5-9a2b624a6fbd','49d50243-9d6a-483b-a879-09a4558805fb','2025-05-07 15:01:27','2025-05-07 15:01:27',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'0f126450-f040-4591-a069-78aa51833cb6','f3413798-6db1-40b2-a6c3-3e38e9406c76','2025-05-07 15:15:31','2025-05-07 15:15:31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'7c45bf53-451f-483f-bb04-f81e7dacb5b8','d8b103a7-03a0-4d02-9947-40be630ecb5b','2025-05-07 15:16:23','2025-05-07 15:16:23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'d49def08-e28c-47f5-bc33-817b8430794b','85894135-d09a-4d8b-83d3-38294ac60e2a','2025-05-07 15:17:16','2025-05-07 15:17:16',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'871c4899-c551-4b9c-a5f5-7a6d900e6bb7','8e7000cc-8706-4abb-a320-9e1de929189f','2025-05-07 15:18:02','2025-05-07 15:18:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'1b836ccb-e596-4a5e-96e2-af319a7b9f5c','bd22dae3-36c9-46cf-ae69-ddb3ca339ed9','2025-05-07 15:18:08','2025-05-07 15:18:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'f8f8ea36-c097-4c7f-a155-8743062ba957','c0f59371-3287-45a8-ba5a-ee00fe185a21','2025-05-07 15:51:12','2025-05-07 15:51:12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'e49c6f62-64ba-4e17-ab8c-737e62fac527','b32885e1-d140-4bca-8572-47e3ff63c836','2025-05-07 19:23:37','2025-05-07 19:23:37',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,'25b0cc35-e861-4523-9884-028e909f451c','d9670aa5-c5f5-400a-9435-69d27bbf234e','2025-05-08 08:05:10','2025-05-08 08:05:10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'3eae108d-46ae-42e0-95ce-a4c84fdb3de2','ab0423ab-5d4d-4963-9f71-c25f43d30700','2025-05-08 16:56:39','2025-05-08 16:56:39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'fe21778e-9287-4bff-81c0-502062c15047','3b484f62-adef-4741-b7d7-5eba2325dda5','2025-05-08 16:56:55','2025-05-08 16:56:55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,'cb807fec-302e-463a-b4b0-bd55b6a446c6','67823cc0-bb0b-4289-bc2f-c23e8b1f8d33','2025-05-09 09:11:12','2025-05-09 09:11:12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,'5b537679-0800-418e-b68a-9b19f5393288','a8fddf20-4951-4ca8-9e13-9f930bcd259b','2025-05-09 12:54:32','2025-05-09 12:54:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,'d331e7e9-c430-48ff-9f04-20387563b37f','c7ab1892-ffb9-4e1c-88c8-e3344e764680','2025-05-09 16:12:11','2025-05-09 17:02:08',NULL,'Ferroviário','Cunha','2025-05-09','ad2f409c-91b6-40c8-bd89-66c02906bff9','test','Fundidos Industriais','origin','destiny','test','client','2028-04-08','DAT - DELIVERED AT TERMINAL (named terminal at port or place of destination) : ENTREGUE NO TERMINAL (terminal nomeado no porto ou local de destino)','Modal - Ferroviário','15',NULL,NULL);
/*!40000 ALTER TABLE `etapa_vendas_alinhamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapa_vendas_alinhamento_itens`
--

DROP TABLE IF EXISTS `etapa_vendas_alinhamento_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etapa_vendas_alinhamento_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `demanda_mes` decimal(10,2) NOT NULL,
  `demanda_total` decimal(10,2) NOT NULL,
  `anexo` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etapa_vendas_alinhamento_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processo_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapa_vendas_alinhamento_itens`
--

LOCK TABLES `etapa_vendas_alinhamento_itens` WRITE;
/*!40000 ALTER TABLE `etapa_vendas_alinhamento_itens` DISABLE KEYS */;
INSERT INTO `etapa_vendas_alinhamento_itens` VALUES (14,'78c19b73-c949-4cb1-8f25-2b76714a9d27','2025-05-09 17:10:23','2025-05-09 17:10:23',NULL,'','',0.00,0.00,'d5bd957a-885a-48b9-8ed5-78144a3b4bbd','d331e7e9-c430-48ff-9f04-20387563b37f','c7ab1892-ffb9-4e1c-88c8-e3344e764680'),(15,'5be4e4e3-9cc5-4d42-94ea-0894452c307e','2025-05-09 17:10:23','2025-05-09 17:10:23',NULL,'test','test',0.00,0.00,'a4707988-156a-4519-9ff5-fe878cd32862','d331e7e9-c430-48ff-9f04-20387563b37f','c7ab1892-ffb9-4e1c-88c8-e3344e764680');
/*!40000 ALTER TABLE `etapa_vendas_alinhamento_itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processo_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etapa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_chave` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (15,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','SFP Iniciada','2025-05-09 16:12:11','2025-05-09 16:12:11',NULL),(16,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:12:38','2025-05-09 16:12:38',NULL),(17,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:23:17','2025-05-09 16:23:17',NULL),(18,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:23:43','2025-05-09 16:23:43',NULL),(19,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:23:44','2025-05-09 16:23:44',NULL),(20,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:23:55','2025-05-09 16:23:55',NULL),(21,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:23:56','2025-05-09 16:23:56',NULL),(22,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:26:47','2025-05-09 16:26:47',NULL),(23,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:27:04','2025-05-09 16:27:04',NULL),(24,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:27:06','2025-05-09 16:27:06',NULL),(25,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:28:01','2025-05-09 16:28:01',NULL),(26,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:28:32','2025-05-09 16:28:32',NULL),(27,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:28:47','2025-05-09 16:28:47',NULL),(28,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:28:54','2025-05-09 16:28:54',NULL),(29,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:29:09','2025-05-09 16:29:09',NULL),(30,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:29:38','2025-05-09 16:29:38',NULL),(31,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:29:53','2025-05-09 16:29:53',NULL),(32,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:30:14','2025-05-09 16:30:14',NULL),(33,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:30:47','2025-05-09 16:30:47',NULL),(34,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:31:06','2025-05-09 16:31:06',NULL),(35,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:31:16','2025-05-09 16:31:16',NULL),(36,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:31:24','2025-05-09 16:31:24',NULL),(37,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:31:42','2025-05-09 16:31:42',NULL),(38,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:32:32','2025-05-09 16:32:32',NULL),(39,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:32:56','2025-05-09 16:32:56',NULL),(40,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:38:01','2025-05-09 16:38:01',NULL),(41,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:39:27','2025-05-09 16:39:27',NULL),(42,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:42:12','2025-05-09 16:42:12',NULL),(43,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:43:35','2025-05-09 16:43:35',NULL),(44,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 16:44:02','2025-05-09 16:44:02',NULL),(45,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:00:34','2025-05-09 17:00:34',NULL),(46,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:01:07','2025-05-09 17:01:07',NULL),(47,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:01:39','2025-05-09 17:01:39',NULL),(48,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:01:56','2025-05-09 17:01:56',NULL),(49,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:02:08','2025-05-09 17:02:08',NULL),(50,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:02:20','2025-05-09 17:02:20',NULL),(51,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:10:07','2025-05-09 17:10:07',NULL),(52,'','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Salvando dados do processo','2025-05-09 17:10:23','2025-05-09 17:10:23',NULL);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `observacoes`
--

DROP TABLE IF EXISTS `observacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `observacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processo_uuid` char(36) NOT NULL,
  `etapa` varchar(255) NOT NULL,
  `usuario_chave` varchar(255) NOT NULL,
  `usuario_nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `observacoes_processo_FK` (`processo_uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observacoes`
--

LOCK TABLES `observacoes` WRITE;
/*!40000 ALTER TABLE `observacoes` DISABLE KEYS */;
INSERT INTO `observacoes` VALUES (1,'67823cc0-bb0b-4289-bc2f-c23e8b1f8d33','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCAL','Essa observação foi adicionada apenas para teste','2025-05-09 11:43:13','2025-05-09 11:43:13',NULL,''),(8,'c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','566674','JOSE AUGUSTO LIMA GONCALVES DE','Essa é apenas meu teste','2025-05-09 17:02:20','2025-05-09 17:02:20',NULL,'a27933e4-ebf5-4311-9184-8e4692c81ee3');
/*!40000 ALTER TABLE `observacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processo`
--

DROP TABLE IF EXISTS `processo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  `iniciador_chave` varchar(255) NOT NULL,
  `iniciador_nome` varchar(255) NOT NULL,
  `etapa_atual` varchar(255) NOT NULL,
  `etapa_anterior` varchar(255) DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `ultimo_aprovador_chave` varchar(255) DEFAULT NULL,
  `ultimo_aprovador_nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processo`
--

LOCK TABLES `processo` WRITE;
/*!40000 ALTER TABLE `processo` DISABLE KEYS */;
INSERT INTO `processo` VALUES (25,'8e7000cc-8706-4abb-a320-9e1de929189f','2025-05-07 15:18:02','2025-05-07 15:18:02',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(26,'bd22dae3-36c9-46cf-ae69-ddb3ca339ed9','2025-05-07 15:18:08','2025-05-07 15:18:08',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(27,'c0f59371-3287-45a8-ba5a-ee00fe185a21','2025-05-07 15:51:12','2025-05-07 15:51:12',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(28,'b32885e1-d140-4bca-8572-47e3ff63c836','2025-05-07 19:23:37','2025-05-07 19:23:37',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(29,'d9670aa5-c5f5-400a-9435-69d27bbf234e','2025-05-08 08:05:10','2025-05-08 08:05:10',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(30,'ab0423ab-5d4d-4963-9f71-c25f43d30700','2025-05-08 16:56:39','2025-05-08 16:56:39',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(31,'3b484f62-adef-4741-b7d7-5eba2325dda5','2025-05-08 16:56:55','2025-05-08 16:56:55',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(32,'67823cc0-bb0b-4289-bc2f-c23e8b1f8d33','2025-05-09 09:11:12','2025-05-09 09:11:12',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(33,'a8fddf20-4951-4ca8-9e13-9f930bcd259b','2025-05-09 12:54:32','2025-05-09 12:54:32',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Aberto',NULL,NULL),(34,'c7ab1892-ffb9-4e1c-88c8-e3344e764680','2025-05-09 16:12:11','2025-05-09 16:28:47',NULL,'566674','JOSE AUGUSTO LIMA GONCALVES DE','Vendas Alinhamento',NULL,'Em Andamento',NULL,NULL);
/*!40000 ALTER TABLE `processo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `processo_uuid` char(36) NOT NULL,
  `origem` varchar(255) NOT NULL,
  `origem_campo` varchar(255) DEFAULT NULL,
  `usuario_chave` varchar(255) NOT NULL,
  `usuario_nome` varchar(255) NOT NULL,
  `arquivo_descricao` varchar(255) DEFAULT NULL,
  `arquivo_nome` varchar(255) NOT NULL,
  `arquivo_nome_original` varchar(255) NOT NULL,
  `arquivo_tipo` varchar(50) NOT NULL,
  `arquivo_tamanho` int(11) NOT NULL,
  `arquivo_caminho` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uploads_unique` (`uuid`),
  KEY `uploads_processo_FK` (`processo_uuid`),
  CONSTRAINT `uploads_processo_FK` FOREIGN KEY (`processo_uuid`) REFERENCES `processo` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
INSERT INTO `uploads` VALUES (120,'28419de8-c3f6-4f46-97c5-019d1add0978','d9670aa5-c5f5-400a-9435-69d27bbf234e','Vendas Alinhamento','documentacao_suplementar','566674','JOSE AUGUSTO LIMA GONCALVES DE','Documentação Suplementar','681d041b0478f681d041b04790.docx','teste tela central de metalilcos.docx','docx',72561,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681d041b0478f681d041b04790.docx','2025-05-08 16:20:59','2025-05-08 16:20:59',NULL),(126,'f7020be7-b629-4ec7-8f75-2aa08816ffb3','d9670aa5-c5f5-400a-9435-69d27bbf234e','Vendas Alinhamento','anexo_1','566674','JOSE AUGUSTO LIMA GONCALVES DE','anexo_1','681d0bd0975a4681d0bd0975a6.pdf','30e7d367bfacfd737cd4f9a0fd42ebbe.pdf','pdf',661323,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681d0bd0975a4681d0bd0975a6.pdf','2025-05-08 16:53:52','2025-05-08 16:53:52',NULL),(127,'e6dae5b1-ef56-41e2-981d-22f9afe6f462','d9670aa5-c5f5-400a-9435-69d27bbf234e','Vendas Alinhamento','anexo_2','566674','JOSE AUGUSTO LIMA GONCALVES DE','anexo_2','681d0bd7a0f5d681d0bd7a0f5f.png','ammx.png','png',10574,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681d0bd7a0f5d681d0bd7a0f5f.png','2025-05-08 16:53:59','2025-05-08 16:53:59',NULL),(128,'8b8ff24f-c624-4331-ab2e-c2f6026470d4','67823cc0-bb0b-4289-bc2f-c23e8b1f8d33','Vendas Alinhamento','documentacao_suplementar','566674','JOSE AUGUSTO LIMA GONCALVES DE','Documentação Suplementar','681df11c04bf7681df11c04bf8.png','gbmx.png','png',49119,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681df11c04bf7681df11c04bf8.png','2025-05-09 09:12:12','2025-05-09 09:12:12',NULL),(129,'bb02b6d2-9b07-457c-b092-6ea22c60a629','67823cc0-bb0b-4289-bc2f-c23e8b1f8d33','Vendas Alinhamento','anexo_1','566674','JOSE AUGUSTO LIMA GONCALVES DE','anexo_1','681df124165ab681df124165ac.png','gbmx.png','png',49119,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681df124165ab681df124165ac.png','2025-05-09 09:12:20','2025-05-09 09:12:20',NULL),(141,'ad2f409c-91b6-40c8-bd89-66c02906bff9','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','documentacao_suplementar','566674','JOSE AUGUSTO LIMA GONCALVES DE','Documentação Suplementar','681e5efa16f98681e5efa16f99.docx','231990 ROI Atualizado.docx','docx',967805,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681e5efa16f98681e5efa16f99.docx','2025-05-09 17:00:58','2025-05-09 17:00:58',NULL),(142,'d5bd957a-885a-48b9-8ed5-78144a3b4bbd','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','anexo_1','566674','JOSE AUGUSTO LIMA GONCALVES DE','anexo_1','681e611ccafb2681e611ccafb3.xlsx','Suplementação WF acesso Juliana.xlsx','xlsx',167128,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681e611ccafb2681e611ccafb3.xlsx','2025-05-09 17:10:04','2025-05-09 17:10:04',NULL),(143,'a4707988-156a-4519-9ff5-fe878cd32862','c7ab1892-ffb9-4e1c-88c8-e3344e764680','Vendas Alinhamento','anexo_2','566674','JOSE AUGUSTO LIMA GONCALVES DE','anexo_2','681e6129afbda681e6129afbdb.pdf','2 - Escopo - GB (1).pdf','pdf',273128,'/var/www/htdocs/amsted/apps/sfp-ammx-storage/681e6129afbda681e6129afbdb.pdf','2025-05-09 17:10:17','2025-05-09 17:10:17',NULL);
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sfp_ammx'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-10 19:17:07
