
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: wozk
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `wozk_habits`
--

DROP TABLE IF EXISTS `wozk_habits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wozk_habits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `resume` text,
  `frequency` varchar(20) DEFAULT NULL,
  `days_of_week` varchar(20) DEFAULT NULL,
  `hour_day` time DEFAULT NULL,
  `week_goal` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `upload_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `wozk_habits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wozk_habits`
--

LOCK TABLES `wozk_habits` WRITE;
/*!40000 ALTER TABLE `wozk_habits` DISABLE KEYS */;
INSERT INTO `wozk_habits` VALUES (1,'1ea01ec1-d2c5-4667-ab7f-88b306643191',42,'Acordar cedo','idiomas','Descrição do hábito Acordar cedo','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(2,'093dc454-10d2-47e2-9cd8-e0676522a764',42,'Jogar xadrez','bem-estar','Descrição do hábito Jogar xadrez','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(3,'76a1e308-69db-44e5-9d1f-139cdf4b27d6',42,'Evitar celular de manhã','exercicio','Descrição do hábito Evitar celular de manhã','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(4,'bf4d280c-2e20-468a-9253-97bfac533787',42,'Escrever no journal','idiomas','Descrição do hábito Escrever no journal','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(5,'82bac20a-0450-405e-a17e-c60bcbbbeb43',42,'Tomar vitaminas','reflexao','Descrição do hábito Tomar vitaminas','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(6,'48b61128-2e08-4ab2-99e9-61fecae119fe',43,'Ler 10 páginas','rotina','Descrição do hábito Ler 10 páginas','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(7,'c4fda7f0-1c22-4f00-91f0-f6cf762151ad',43,'Beber 2L de água','leitura','Descrição do hábito Beber 2L de água','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(8,'024aa27b-41b8-49de-9ec5-50b25088a080',43,'Caminhar 30 minutos','exercicio','Descrição do hábito Caminhar 30 minutos','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(9,'040c5414-8c6b-4721-a746-824564d9e607',43,'Meditar 10 minutos','alimentacao','Descrição do hábito Meditar 10 minutos','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(10,'038da2f1-36a1-4ddf-9a45-9500a6a46d73',43,'Estudar inglês','produtividade','Descrição do hábito Estudar inglês','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(11,'280cb0eb-70a1-46d7-b498-dac9816801c8',43,'Planejar o dia','alimentacao','Descrição do hábito Planejar o dia','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(12,'2f1573d7-817e-4dbb-a800-9776c42250d8',43,'Fazer diário da gratidão','leitura','Descrição do hábito Fazer diário da gratidão','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(13,'27560648-dfe0-4db1-91d3-cbfc299038c3',43,'Alongar','leitura','Descrição do hábito Alongar','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(14,'7c7bf321-a3d1-4ce7-bf98-4faa98379a5c',43,'Evitar açúcar','planejamento','Descrição do hábito Evitar açúcar','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL),(15,'6874a82e-a4fb-4d4e-964f-71dd2de2cf0d',43,'Revisar metas semanais','idiomas','Descrição do hábito Revisar metas semanais','diária','Mon,Tue,Wed,Thu,Fri','07:00:00',5,1,'2025-06-08 19:17:55','2025-06-08 19:17:55',NULL);
/*!40000 ALTER TABLE `wozk_habits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-08 21:53:38
