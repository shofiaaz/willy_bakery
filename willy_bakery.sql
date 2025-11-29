-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: breadlink
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customer_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'abdul',NULL,'0812345263','Jalan testing 1','2025-11-26 18:54:11','2025-11-26 18:54:11'),(2,'Customer 1','customer1@example.com','08121105779','Jl. Pelanggan No. 1','2025-11-12 20:03:43','2025-11-22 20:03:43'),(3,'Customer 2','customer2@example.com','08122173063','Jl. Pelanggan No. 2','2025-10-28 20:03:43','2025-11-26 20:03:43'),(4,'Customer 3','customer3@example.com','08124832575','Jl. Pelanggan No. 3','2025-11-18 20:03:43','2025-11-22 20:03:43'),(5,'Customer 4','customer4@example.com','08126565597','Jl. Pelanggan No. 4','2025-11-05 20:03:43','2025-11-26 20:03:43'),(6,'Customer 5','customer5@example.com','08126869528','Jl. Pelanggan No. 5','2025-11-21 20:03:43','2025-11-25 20:03:43'),(7,'Customer 6','customer6@example.com','08126243421','Jl. Pelanggan No. 6','2025-11-22 20:03:43','2025-11-24 20:03:43'),(8,'Customer 7','customer7@example.com','08126105569','Jl. Pelanggan No. 7','2025-11-23 20:03:43','2025-11-25 20:03:43'),(9,'Customer 8','customer8@example.com','08125153342','Jl. Pelanggan No. 8','2025-11-10 20:03:43','2025-11-24 20:03:43'),(10,'Customer 9','customer9@example.com','08128470665','Jl. Pelanggan No. 9','2025-11-21 20:03:43','2025-11-24 20:03:43'),(11,'Customer 10','customer10@example.com','08122692716','Jl. Pelanggan No. 10','2025-11-26 20:03:43','2025-11-22 20:03:43');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_productions`
--

DROP TABLE IF EXISTS `daily_productions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daily_productions` (
  `production_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `production_date` date NOT NULL,
  `quantity_produced` int NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`production_id`),
  KEY `daily_productions_product_id_foreign` (`product_id`),
  CONSTRAINT `daily_productions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_productions`
--

LOCK TABLES `daily_productions` WRITE;
/*!40000 ALTER TABLE `daily_productions` DISABLE KEYS */;
INSERT INTO `daily_productions` VALUES (7,1,'2025-11-17',5,'completed','2025-11-16 21:42:06','2025-11-16 21:42:06'),(8,2,'2025-11-17',8,'completed','2025-11-26 18:56:12','2025-11-26 18:56:12'),(9,1,'2025-11-27',10,'completed','2025-11-26 19:24:29','2025-11-26 19:24:29'),(10,11,'2025-11-17',5,'completed','2025-11-16 20:03:43','2025-11-16 20:03:43'),(11,8,'2025-11-15',64,'completed','2025-11-14 20:03:43','2025-11-14 20:03:43'),(12,2,'2025-11-19',38,'completed','2025-11-18 20:03:43','2025-11-18 20:03:43'),(13,2,'2025-11-14',54,'completed','2025-11-13 20:03:43','2025-11-13 20:03:43'),(14,11,'2025-11-15',49,'completed','2025-11-14 20:03:43','2025-11-14 20:03:43'),(15,4,'2025-11-16',120,'completed','2025-11-15 20:03:43','2025-11-15 20:03:43'),(16,3,'2025-11-15',69,'completed','2025-11-14 20:03:43','2025-11-14 20:03:43'),(17,5,'2025-11-17',106,'completed','2025-11-16 20:03:43','2025-11-16 20:03:43'),(18,3,'2025-11-17',68,'completed','2025-11-16 20:03:43','2025-11-16 20:03:43'),(19,5,'2025-11-20',72,'completed','2025-11-19 20:03:43','2025-11-19 20:03:43'),(20,6,'2025-11-21',84,'completed','2025-11-20 20:03:43','2025-11-20 20:03:43'),(21,1,'2025-11-23',31,'completed','2025-11-22 20:03:43','2025-11-22 20:03:43'),(22,9,'2025-11-27',53,'completed','2025-11-26 20:03:43','2025-11-26 20:03:43'),(23,9,'2025-11-23',101,'completed','2025-11-22 20:03:43','2025-11-22 20:03:43'),(24,7,'2025-11-25',92,'completed','2025-11-24 20:03:43','2025-11-24 20:03:43'),(25,4,'2025-11-23',18,'completed','2025-11-22 20:03:43','2025-11-22 20:03:43'),(26,10,'2025-11-21',16,'completed','2025-11-20 20:03:43','2025-11-20 20:03:43'),(27,3,'2025-11-23',80,'completed','2025-11-22 20:03:43','2025-11-22 20:03:43'),(28,4,'2025-11-22',78,'completed','2025-11-21 20:03:43','2025-11-21 20:03:43'),(29,6,'2025-11-22',83,'completed','2025-11-21 20:03:43','2025-11-21 20:03:43');
/*!40000 ALTER TABLE `daily_productions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecast_results`
--

DROP TABLE IF EXISTS `forecast_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forecast_results` (
  `forecast_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `forecast_date` date NOT NULL,
  `predicted_demand` int NOT NULL,
  `model_used` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`forecast_id`),
  KEY `forecast_results_product_id_foreign` (`product_id`),
  CONSTRAINT `forecast_results_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecast_results`
--

LOCK TABLES `forecast_results` WRITE;
/*!40000 ALTER TABLE `forecast_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `forecast_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_logs`
--

DROP TABLE IF EXISTS `inventory_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory_logs` (
  `log_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `material_id` bigint unsigned DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `inventory_logs_product_id_foreign` (`product_id`),
  KEY `inventory_logs_material_id_foreign` (`material_id`),
  CONSTRAINT `inventory_logs_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `raw_materials` (`material_id`) ON DELETE SET NULL,
  CONSTRAINT `inventory_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_logs`
--

LOCK TABLES `inventory_logs` WRITE;
/*!40000 ALTER TABLE `inventory_logs` DISABLE KEYS */;
INSERT INTO `inventory_logs` VALUES (1,NULL,1,'stock_removed',1,'2025-11-17 03:25:04'),(2,1,1,'consumption',8,'2025-11-17 03:41:19'),(3,1,1,'consumption',4,'2025-11-17 04:09:38'),(4,1,1,'consumption',4,'2025-11-17 04:12:50'),(5,1,NULL,'product_return',-2,'2025-11-17 04:19:39'),(6,1,1,'consumption',4,'2025-11-17 04:19:48'),(7,1,NULL,'product_return',-2,'2025-11-17 04:19:54'),(8,1,1,'consumption',4,'2025-11-17 04:20:10'),(9,1,NULL,'product_return',-2,'2025-11-17 04:20:29'),(10,1,1,'consumption',4,'2025-11-17 04:21:00'),(11,1,NULL,'product_return',-8,'2025-11-17 04:37:31'),(12,1,1,'consumption',10,'2025-11-17 04:42:06'),(13,1,NULL,'product_created',5,'2025-11-17 04:42:06'),(14,1,NULL,'OUT',2,'2025-11-26 18:54:11'),(15,NULL,2,'initial_stock',100,'2025-11-27 01:54:58'),(16,2,1,'consumption',16,'2025-11-27 01:56:12'),(17,2,2,'consumption',24,'2025-11-27 01:56:12'),(18,2,NULL,'product_created',8,'2025-11-27 01:56:12'),(19,1,1,'consumption',20,'2025-11-27 02:24:29'),(20,1,NULL,'product_created',10,'2025-11-27 02:24:29'),(21,12,17,'product_created',5,'2025-11-26 20:03:43'),(22,12,NULL,'initial_stock',47,'2025-11-14 20:03:43'),(23,10,NULL,'OUT',35,'2025-11-20 20:03:43'),(24,2,7,'consumption',3,'2025-11-16 20:03:43'),(25,NULL,NULL,'OUT',-13,'2025-11-23 20:03:43'),(26,10,7,'OUT',-38,'2025-11-24 20:03:43'),(27,NULL,NULL,'consumption',40,'2025-11-19 20:03:43'),(28,6,2,'product_created',15,'2025-11-19 20:03:43'),(29,8,NULL,'consumption',27,'2025-11-18 20:03:43'),(30,12,NULL,'consumption',14,'2025-11-19 20:03:43'),(31,NULL,11,'product_created',-25,'2025-11-23 20:03:43'),(32,NULL,12,'OUT',-46,'2025-11-26 20:03:43'),(33,NULL,1,'OUT',31,'2025-11-15 20:03:43'),(34,10,NULL,'product_created',-23,'2025-11-15 20:03:43'),(35,1,15,'OUT',40,'2025-11-23 20:03:43');
/*!40000 ALTER TABLE `inventory_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_11_09_171012_create_user_profiles_table',1),(5,'2025_11_09_171028_create_user_activity_logs_table',1),(6,'2025_11_09_171207_create_suppliers_table',1),(7,'2025_11_09_171217_create_supplier_profiles_table',1),(8,'2025_11_09_171225_create_purchaser_orders_table',1),(9,'2025_11_09_171629_create_products_table',1),(10,'2025_11_09_171633_create_purchaser_order_items_table',1),(11,'2025_11_09_171637_create_raw_materials_table',1),(12,'2025_11_09_171644_create_product_usages_table',1),(13,'2025_11_09_171653_create_product_recipes_table',1),(14,'2025_11_09_171706_create_inventory_logs_table',1),(15,'2025_11_09_173502_create_daily_productions_table',1),(16,'2025_11_09_173510_create_forecast_results_table',1),(17,'2025_11_09_173518_create_customers_table',1),(18,'2025_11_09_173526_create_sales_table',1),(19,'2025_11_09_173533_create_notifications_table',1),(20,'2025_11_09_173540_create_reports_table',1),(21,'2025_11_09_175127_create_sessions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `notification_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notification_id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_recipes`
--

DROP TABLE IF EXISTS `product_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_recipes` (
  `recipe_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `material_id` bigint unsigned NOT NULL,
  `quantity_needed` int NOT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `product_recipes_product_id_foreign` (`product_id`),
  KEY `product_recipes_material_id_foreign` (`material_id`),
  CONSTRAINT `product_recipes_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `raw_materials` (`material_id`) ON DELETE CASCADE,
  CONSTRAINT `product_recipes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_recipes`
--

LOCK TABLES `product_recipes` WRITE;
/*!40000 ALTER TABLE `product_recipes` DISABLE KEYS */;
INSERT INTO `product_recipes` VALUES (2,1,1,2),(3,2,1,2),(4,2,2,3),(5,1,1,10),(6,1,2,2),(7,1,3,4),(8,1,4,8),(9,2,2,6),(10,2,3,2),(11,2,4,1),(12,2,5,4),(13,3,3,7),(14,3,4,2),(15,3,5,4),(16,3,6,5),(17,4,4,7),(18,4,5,4),(19,4,6,5),(20,4,7,6),(21,5,5,9),(22,5,6,3),(23,5,7,4),(24,5,8,5),(25,6,6,7),(26,6,7,4),(27,6,8,1),(28,6,9,5),(29,7,7,5),(30,7,8,4),(31,7,9,7),(32,7,10,9),(33,8,8,10),(34,8,9,9),(35,8,10,2),(36,8,11,1),(37,9,9,4),(38,9,10,6),(39,9,11,5),(40,9,12,9),(41,10,10,1),(42,10,11,3),(43,10,12,8),(44,10,13,8),(45,11,1,2),(46,11,16,1),(47,11,14,2),(48,12,1,2),(49,12,17,2),(50,12,11,2);
/*!40000 ALTER TABLE `product_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_usages`
--

DROP TABLE IF EXISTS `product_usages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_usages` (
  `usage_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `material_id` bigint unsigned NOT NULL,
  `quantity_used` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usage_id`),
  KEY `product_usages_product_id_foreign` (`product_id`),
  KEY `product_usages_material_id_foreign` (`material_id`),
  CONSTRAINT `product_usages_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `raw_materials` (`material_id`) ON DELETE CASCADE,
  CONSTRAINT `product_usages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_usages`
--

LOCK TABLES `product_usages` WRITE;
/*!40000 ALTER TABLE `product_usages` DISABLE KEYS */;
INSERT INTO `product_usages` VALUES (1,1,1,10,'2025-11-16 21:42:06','2025-11-16 21:42:06'),(2,2,1,16,'2025-11-26 18:56:12','2025-11-26 18:56:12'),(3,2,2,24,'2025-11-26 18:56:12','2025-11-26 18:56:12'),(4,1,1,20,'2025-11-26 19:24:29','2025-11-26 19:24:29'),(5,3,16,36,'2025-11-20 20:03:43','2025-11-13 20:03:43'),(6,4,4,15,'2025-11-18 20:03:43','2025-11-26 20:03:43'),(7,10,16,41,'2025-11-14 20:03:43','2025-11-21 20:03:43'),(8,6,6,19,'2025-11-15 20:03:43','2025-11-22 20:03:43'),(9,8,4,8,'2025-11-14 20:03:43','2025-11-21 20:03:43'),(10,9,14,41,'2025-11-13 20:03:43','2025-11-20 20:03:43'),(11,12,7,6,'2025-11-14 20:03:43','2025-11-22 20:03:43'),(12,2,7,40,'2025-11-14 20:03:43','2025-11-14 20:03:43'),(13,5,1,15,'2025-11-24 20:03:43','2025-11-22 20:03:43'),(14,8,16,4,'2025-11-18 20:03:43','2025-11-16 20:03:43');
/*!40000 ALTER TABLE `product_usages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `stock` int NOT NULL DEFAULT '0',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Roti Cinnamon','Roti kayumanis yang enak dan wangi',13,17000.00,'2025-11-16 19:22:16','2025-11-26 19:24:29'),(2,'roti goreng','testing',8,10000.00,'2025-11-26 18:55:17','2025-11-26 18:56:12'),(3,'Chocolate Filled Bun','Soft bun filled with rich chocolate',80,12000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(4,'Cinnamon Roll','Sweet cinnamon roll with glaze',60,17000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(5,'Cream Cheese Danish','Flaky pastry with cream cheese',40,22000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(6,'Garlic Bread','Savory garlic butter bread',100,10000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(7,'Chocolate Croissant','Buttery croissant with chocolate',50,18000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(8,'Almond Bread','Bread topped with sliced almonds',30,20000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(9,'Raisin Roll','Soft roll with raisins',70,15000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(10,'Sourdough Loaf','Classic sourdough bread loaf',25,25000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(11,'Milk Bun','Sweet milk-flavored bun',90,13000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(12,'Chocolate Chip Muffin','Muffin loaded with chocolate chips',60,14000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaser_order_items`
--

DROP TABLE IF EXISTS `purchaser_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchaser_order_items` (
  `item_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `purchaser_order_items_order_id_foreign` (`order_id`),
  KEY `purchaser_order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `purchaser_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `purchaser_orders` (`order_id`) ON DELETE CASCADE,
  CONSTRAINT `purchaser_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaser_order_items`
--

LOCK TABLES `purchaser_order_items` WRITE;
/*!40000 ALTER TABLE `purchaser_order_items` DISABLE KEYS */;
INSERT INTO `purchaser_order_items` VALUES (1,1,1,100,17000.00,1700000.00),(2,2,1,100,17000.00,1700000.00),(3,3,4,121,3500.00,423500.00);
/*!40000 ALTER TABLE `purchaser_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaser_orders`
--

DROP TABLE IF EXISTS `purchaser_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchaser_orders` (
  `order_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `purchaser_orders_supplier_id_foreign` (`supplier_id`),
  KEY `purchaser_orders_user_id_foreign` (`user_id`),
  CONSTRAINT `purchaser_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE,
  CONSTRAINT `purchaser_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaser_orders`
--

LOCK TABLES `purchaser_orders` WRITE;
/*!40000 ALTER TABLE `purchaser_orders` DISABLE KEYS */;
INSERT INTO `purchaser_orders` VALUES (1,1,1,'2025-11-24','Completed',1700000.00,'2025-11-23 17:20:05','2025-11-23 17:35:34'),(2,1,1,'2025-11-27','Completed',1700000.00,'2025-11-22 20:03:43','2025-11-23 20:03:43'),(3,5,1,'2025-11-27','Pending',423500.00,'2025-11-26 20:07:44','2025-11-26 20:07:44');
/*!40000 ALTER TABLE `purchaser_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raw_materials`
--

DROP TABLE IF EXISTS `raw_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `raw_materials` (
  `material_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `material_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_per_unit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raw_materials`
--

LOCK TABLES `raw_materials` WRITE;
/*!40000 ALTER TABLE `raw_materials` DISABLE KEYS */;
INSERT INTO `raw_materials` VALUES (1,'Tepung',25,'Kg',12000.00,'2025-11-16 18:45:34','2025-11-26 19:24:29'),(2,'ragi',76,'gram',3500.00,'2025-11-26 18:54:58','2025-11-26 18:56:12'),(3,'Tepung Terigu',200,'Kg',12000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(4,'Ragi',100,'Kg',3500.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(5,'Gula',150,'Kg',10000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(6,'Susu Bubuk',80,'Kg',20000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(7,'Butter',60,'Kg',60000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(8,'Coklat Filling',80,'Kg',45000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(9,'Telur',500,'Pcs',1500.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(10,'Garam',50,'Kg',8000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(11,'Air',10000,'L',0.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(12,'Keju',40,'Kg',70000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(13,'Kismis',30,'Kg',50000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(14,'Susu Cair',120,'L',12000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(15,'Minyak',60,'L',15000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(16,'Vanila',20,'Kg',150000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43'),(17,'Cocoa Powder',50,'Kg',65000.00,'2025-11-26 20:03:43','2025-11-26 20:03:43');
/*!40000 ALTER TABLE `raw_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `report_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `report_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `generated_date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  KEY `reports_user_id_foreign` (`user_id`),
  CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `sale_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_product_id_foreign` (`product_id`),
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,1,1,2,17000.00,34000.00,'2025-11-27','2025-11-26 18:54:11','2025-11-26 18:54:11'),(2,6,4,5,17000.00,85000.00,'2025-11-20','2025-11-19 20:03:43','2025-11-19 20:03:43'),(3,4,9,4,15000.00,60000.00,'2025-11-16','2025-11-15 20:03:43','2025-11-15 20:03:43'),(4,8,1,4,17000.00,68000.00,'2025-11-20','2025-11-19 20:03:43','2025-11-19 20:03:43'),(5,8,3,3,12000.00,36000.00,'2025-11-15','2025-11-14 20:03:43','2025-11-14 20:03:43'),(6,9,9,1,15000.00,15000.00,'2025-11-15','2025-11-14 20:03:43','2025-11-14 20:03:43'),(7,10,2,2,10000.00,20000.00,'2025-11-15','2025-11-14 20:03:43','2025-11-14 20:03:43'),(8,9,3,1,12000.00,12000.00,'2025-11-14','2025-11-13 20:03:43','2025-11-13 20:03:43'),(9,8,1,6,17000.00,102000.00,'2025-11-19','2025-11-18 20:03:43','2025-11-18 20:03:43'),(10,10,10,4,25000.00,100000.00,'2025-11-18','2025-11-17 20:03:43','2025-11-17 20:03:43'),(11,9,7,6,18000.00,108000.00,'2025-11-16','2025-11-15 20:03:43','2025-11-15 20:03:43'),(12,4,2,3,10000.00,30000.00,'2025-11-27','2025-11-26 20:03:43','2025-11-26 20:03:43'),(13,3,11,4,13000.00,52000.00,'2025-11-26','2025-11-25 20:03:43','2025-11-25 20:03:43'),(14,5,3,6,12000.00,72000.00,'2025-11-25','2025-11-24 20:03:43','2025-11-24 20:03:43'),(15,6,9,1,15000.00,15000.00,'2025-11-22','2025-11-21 20:03:43','2025-11-21 20:03:43'),(16,11,4,3,17000.00,51000.00,'2025-11-23','2025-11-22 20:03:43','2025-11-22 20:03:43'),(17,7,2,5,10000.00,50000.00,'2025-11-21','2025-11-20 20:03:43','2025-11-20 20:03:43'),(18,4,2,4,10000.00,40000.00,'2025-11-26','2025-11-25 20:03:43','2025-11-25 20:03:43'),(19,5,2,4,10000.00,40000.00,'2025-11-22','2025-11-21 20:03:43','2025-11-21 20:03:43'),(20,5,11,5,13000.00,65000.00,'2025-11-24','2025-11-23 20:03:43','2025-11-23 20:03:43'),(21,4,7,6,18000.00,108000.00,'2025-11-22','2025-11-21 20:03:43','2025-11-21 20:03:43');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0TmzY1OQBorXRsK9eS7mMAbvgvKBcrCy82X60O6N',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0xSQTYxYUpLWWx2bVVINHJwcW04bFN3RVlWUHg1aVIwY3c1Z2tiOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9yZXBvcnRzIjtzOjU6InJvdXRlIjtzOjE5OiJvd25lci5yZXBvcnRzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1764314430),('s43DJ5QQzoA1el696noqw2eJsN27H327iY8IMRdE',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWpMOURGTUw3MTd2aGFSMThnZzJrdFFOU2xDd2hFcVMydXIzSXd1byI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9yZXBvcnRzL2ZvcmVjYXN0IjtzOjU6InJvdXRlIjtzOjIyOiJvd25lci5yZXBvcnRzLmZvcmVjYXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1764333848),('vAuS1y5AUJgIkP8dg90Ti7Dw02JtivGBh3eovNw6',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmtQcm9wOTVscHJLNVFhQnUxWFBzQ2M1dFZjdjloTkpkVm1NSVRoZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6Im93bmVyLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1764384206),('XZy8wy1mGIAyOcChndG7rbgtXamWKVIWQ6aZwmZX',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN2JibmhnS2lKNGtwU3JUT3JaV2oweXpyeEI3cUVlTHlTQWNhZTdZRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9yZXBvcnRzL2ZvcmVjYXN0IjtzOjU6InJvdXRlIjtzOjIyOiJvd25lci5yZXBvcnRzLmZvcmVjYXN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1764387966);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_profiles`
--

DROP TABLE IF EXISTS `supplier_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier_profiles` (
  `profile_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `contact_person` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`profile_id`),
  KEY `supplier_profiles_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `supplier_profiles_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_profiles`
--

LOCK TABLES `supplier_profiles` WRITE;
/*!40000 ALTER TABLE `supplier_profiles` DISABLE KEYS */;
INSERT INTO `supplier_profiles` VALUES (1,1,'Supriadi','CV','datang seminggu 2 kali'),(2,1,'Bogasari Contact','CV','Delivery twice a week'),(3,2,'Bogasari Contact','CV','Delivery twice a week'),(4,3,'BakerSupply Co Contact','CV','Delivery twice a week'),(5,4,'FlourMart Contact','CV','Delivery twice a week'),(6,5,'YeastWorld Contact','CV','Delivery twice a week'),(7,6,'DairyFresh Contact','CV','Delivery twice a week');
/*!40000 ALTER TABLE `supplier_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `supplier_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Bogasari','bogasari@gmail.com','08123458678','jl jalan sam sama','2025-11-14 06:08:13','2025-11-14 06:08:13'),(2,'Bogasari','bogasari@gmail.com','08123458678','Jl. Tepung No.1','2025-11-26 20:03:43','2025-11-26 20:03:43'),(3,'BakerSupply Co','contact@bakersupply.co','081100000001','Jl. Roti No.1','2025-11-26 20:03:43','2025-11-26 20:03:43'),(4,'FlourMart','sales@flourmart.com','081100000002','Jl. Tepung 2','2025-11-26 20:03:43','2025-11-26 20:03:43'),(5,'YeastWorld','hello@yeastworld.id','081100000003','Jl. Ragi 3','2025-11-26 20:03:43','2025-11-26 20:03:43'),(6,'DairyFresh','info@dairyfresh.id','081100000005','Jl. Susu 5','2025-11-26 20:03:43','2025-11-26 20:03:43');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activity_logs`
--

DROP TABLE IF EXISTS `user_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_activity_logs` (
  `log_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `user_activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `user_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activity_logs`
--

LOCK TABLES `user_activity_logs` WRITE;
/*!40000 ALTER TABLE `user_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profiles` (
  `profile_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'owner01','$2y$12$PEpCwPdrmeI9JMeVhkckwefEyTOTEMY4yBpMkZMkh2pP5EpQmBEDi','owner','owner@example.com','081234567890','2025-11-14 04:51:51'),(2,'admin01','$2y$12$1yqyI3ydjm9FxB9CLbaAw.q/A6m.FVpmghXj2OWiXiiyd2WEBHhAa','admin','admin@example.com','081111111111','2025-11-14 04:51:51'),(3,'staff01','$2y$12$XQKtEmYuFRzgYy/2IF45yuaxZ5YdJd1au6Pldy3/BGOi1/azo6c6S','staff','staff@example.com','082222222222','2025-11-14 04:51:52');
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

-- Dump completed on 2025-11-29 11:05:27
