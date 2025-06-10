
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
-- Table structure for table `wozk_medals_user`
--

DROP TABLE IF EXISTS `wozk_medals_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wozk_medals_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `user_id` int NOT NULL,
  `medal_id` int NOT NULL,
  `conquered_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `upload_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `medal_id` (`medal_id`),
  CONSTRAINT `wozk_medals_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `wozk_medals_user_ibfk_2` FOREIGN KEY (`medal_id`) REFERENCES `medals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wozk_medals_user`
--

LOCK TABLES `wozk_medals_user` WRITE;
/*!40000 ALTER TABLE `wozk_medals_user` DISABLE KEYS */;
INSERT INTO `wozk_medals_user` VALUES (1,'91195351-4907-46c8-b9b8-32260a1dd88c',42,1,'2025-06-08 19:19:33','2025-06-08 19:19:33','2025-06-08 19:19:33',NULL),(2,'8c00a821-c067-4e4d-9137-51745a45783f',42,2,'2025-06-08 19:19:33','2025-06-08 19:19:33','2025-06-08 19:19:33',NULL),(3,'a234c5fc-54e6-4e76-ad1f-7e51447b462a',43,1,'2025-06-08 19:19:33','2025-06-08 19:19:33','2025-06-08 19:19:33',NULL),(4,'dbb0df0f-8c09-434b-81ab-5f85cc1096a8',43,2,'2025-06-08 19:19:33','2025-06-08 19:19:33','2025-06-08 19:19:33',NULL);
/*!40000 ALTER TABLE `wozk_medals_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-08 21:53:37
