
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
-- Temporary view structure for view `vw_user_daily_progress`
--

DROP TABLE IF EXISTS `vw_user_daily_progress`;
/*!50001 DROP VIEW IF EXISTS `vw_user_daily_progress`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_daily_progress` AS SELECT 
 1 AS `user_id`,
 1 AS `username`,
 1 AS `info_date`,
 1 AS `total_habits_checked`,
 1 AS `total_completed`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_habit_performance`
--

DROP TABLE IF EXISTS `vw_habit_performance`;
/*!50001 DROP VIEW IF EXISTS `vw_habit_performance`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_habit_performance` AS SELECT 
 1 AS `habit_id`,
 1 AS `title`,
 1 AS `user_id`,
 1 AS `username`,
 1 AS `total_checkins`,
 1 AS `total_completed`,
 1 AS `completion_rate`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_habits_summary`
--

DROP TABLE IF EXISTS `vw_user_habits_summary`;
/*!50001 DROP VIEW IF EXISTS `vw_user_habits_summary`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_habits_summary` AS SELECT 
 1 AS `user_id`,
 1 AS `username`,
 1 AS `total_habits`,
 1 AS `habits_done_last_7_days`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_medals`
--

DROP TABLE IF EXISTS `vw_user_medals`;
/*!50001 DROP VIEW IF EXISTS `vw_user_medals`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_medals` AS SELECT 
 1 AS `user_id`,
 1 AS `username`,
 1 AS `medal_title`,
 1 AS `type`,
 1 AS `conquered_at`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_user_daily_progress`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_daily_progress`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_daily_progress` AS select `u`.`id` AS `user_id`,`u`.`username` AS `username`,`hd`.`info_date` AS `info_date`,count(`hd`.`id`) AS `total_habits_checked`,sum(`hd`.`is_done`) AS `total_completed` from ((`users` `u` join `habits` `h` on(((`h`.`user_id` = `u`.`id`) and (`h`.`deleted_at` is null)))) join `habits_done` `hd` on(((`hd`.`habit_id` = `h`.`id`) and (`hd`.`deleted_at` is null)))) group by `u`.`id`,`hd`.`info_date` order by `u`.`id`,`hd`.`info_date` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_habit_performance`
--

/*!50001 DROP VIEW IF EXISTS `vw_habit_performance`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_habit_performance` AS select `h`.`id` AS `habit_id`,`h`.`title` AS `title`,`h`.`user_id` AS `user_id`,`u`.`username` AS `username`,count(`hd`.`id`) AS `total_checkins`,sum(`hd`.`is_done`) AS `total_completed`,round(((sum(`hd`.`is_done`) / count(`hd`.`id`)) * 100),2) AS `completion_rate` from ((`habits` `h` join `users` `u` on((`u`.`id` = `h`.`user_id`))) left join `habits_done` `hd` on(((`hd`.`habit_id` = `h`.`id`) and (`hd`.`deleted_at` is null)))) where (`h`.`deleted_at` is null) group by `h`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_habits_summary`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_habits_summary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_habits_summary` AS select `u`.`id` AS `user_id`,`u`.`username` AS `username`,count(distinct `h`.`id`) AS `total_habits`,count(distinct (case when ((`hd`.`info_date` >= (curdate() - interval 7 day)) and (`hd`.`is_done` = 1)) then `hd`.`habit_id` else NULL end)) AS `habits_done_last_7_days` from ((`users` `u` left join `habits` `h` on(((`h`.`user_id` = `u`.`id`) and (`h`.`deleted_at` is null) and (`h`.`is_active` = 1)))) left join `habits_done` `hd` on(((`hd`.`habit_id` = `h`.`id`) and (`hd`.`deleted_at` is null)))) group by `u`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_medals`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_medals`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_medals` AS select `u`.`id` AS `user_id`,`u`.`username` AS `username`,`m`.`title` AS `medal_title`,`m`.`type` AS `type`,`mu`.`conquered_at` AS `conquered_at` from ((`medals_user` `mu` join `users` `u` on((`u`.`id` = `mu`.`user_id`))) join `medals` `m` on((`m`.`id` = `mu`.`medal_id`))) where (`mu`.`deleted_at` is null) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-08 21:53:38
