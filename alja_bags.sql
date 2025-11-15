-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: alja_bags
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `quantity` int(100) DEFAULT NULL,
  `added_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (3,1,1,3,'2025-10-31 11:47:21'),(5,1,1,3,'2025-10-31 19:09:36'),(6,1,1,3,'2025-10-31 19:11:08'),(7,1,1,3,'2025-10-31 20:03:14'),(8,1,1,3,'2025-10-31 20:17:02'),(9,1,1,3,'2025-10-31 20:46:34'),(10,1,1,2,'2025-11-12 09:57:46'),(11,1,1,2,'2025-11-12 14:19:31'),(12,2,1,3,'2025-11-14 14:36:32');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `order_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `quantityOrderd` int(100) DEFAULT NULL,
  `unit_price` decimal(60,0) DEFAULT NULL,
  `total_price` decimal(60,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (2,1,1,2,50,NULL),(4,1,1,2,50,NULL),(5,1,1,2,50,NULL),(6,1,1,2,50,NULL),(7,1,1,2,50,NULL),(8,1,1,2,25,50),(9,1,1,2,25,50),(10,1,1,2,25,50),(12,1,1,3,NULL,30);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` enum('Shipping','Pending','Arrived') DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL,
  `tracking_number` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,NULL,NULL,'Aleja Lipa 61',NULL),(3,1,NULL,'Pending',NULL,10),(5,1,NULL,'Pending',NULL,10),(6,1,NULL,'Pending',NULL,10),(7,1,'2025-11-12 10:45:01','Pending','123 Test Street, Test City',222),(8,1,'2025-11-12 10:50:02','Pending','123 Test Street, Test City',222),(9,1,'2025-11-12 10:51:12','Pending','123 Test Street, Test City',222),(10,1,'2025-11-12 10:51:32','Pending','123 Test Street, Test City',222),(11,1,'2025-11-12 10:52:29','Pending','123 Test Street, Test City',222),(12,1,'2025-11-12 10:53:16','Pending','123 Test Street, Test City',222),(13,1,'2025-11-12 10:54:28','Pending','123 Test Street, Test City',222),(14,1,'2025-11-12 10:55:31','Pending','123 Test Street, Test City',222),(15,1,'2025-11-12 10:56:19','Pending','123 Test Street, Test City',222),(16,1,'2025-11-12 15:20:09','Pending','123 Test Street, Test City',222),(17,1,'2025-11-12 15:21:25','Pending','123 Test Street, Test City',222),(18,1,'2025-11-12 15:22:16','Pending','123 Test Street, Test City',222),(19,1,'2025-11-12 15:22:21','Pending','123 Test Street, Test City',222),(20,1,'2025-11-12 15:22:48','Pending','123 Test Street, Test City',222),(21,3,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `amount` decimal(60,0) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (3,1,100,'credit_card'),(4,1,100,'credit_card'),(5,1,100,'credit_card'),(6,1,50,'paypal'),(7,1,100,'credit_card'),(8,1,100,'credit_card'),(9,1,100,'credit_card'),(10,1,100,'credit_card'),(11,1,100,'credit_card'),(12,1,100,'credit_card'),(13,1,100,'credit_card'),(14,1,100,'credit_card'),(15,3,50,'credit_card');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(60,0) NOT NULL,
  `stock_quantity` int(30) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'ananan','good looking',50,3,NULL),(2,'','Add timeless elegance to your look with this stunning gold clutch. Its sleek, structured design and shimmering finish make it the perfect accessory for formal events, parties, or evenings out. ',50,NULL,NULL),(3,'Black Bag',NULL,50,NULL,NULL),(5,'Test Product',NULL,20,NULL,NULL),(6,'Test Product',NULL,20,NULL,NULL),(7,'Test Product',NULL,20,NULL,NULL),(8,'Test Product',NULL,20,NULL,NULL),(9,'Test Product',NULL,20,NULL,NULL),(10,'Test Product',NULL,20,NULL,NULL),(11,'Test Product',NULL,20,NULL,NULL),(12,'',NULL,50,NULL,NULL),(13,'Test Product',NULL,20,NULL,NULL),(14,'Test Product',NULL,20,NULL,NULL),(15,'Test Product',NULL,20,NULL,NULL),(16,'Test Product',NULL,20,NULL,NULL),(17,'Test Bag',NULL,99,NULL,NULL),(18,'Test Bag',NULL,99,NULL,NULL),(19,'Black Bag',NULL,50,NULL,NULL),(20,'Black Bag',NULL,50,NULL,NULL),(21,'Test Bag 19:49:50','Test product',50,10,''),(22,'Test Bag 20:09:55',NULL,50,NULL,NULL),(23,'Test Bag 20:11:12',NULL,50,NULL,NULL),(24,'Test Bag 10:29:21',NULL,50,NULL,NULL),(25,'Test Bag 10:30:28',NULL,50,NULL,NULL),(26,'Test Bag 10:32:10',NULL,50,NULL,NULL),(27,'Test Bag 15:23:23',NULL,50,NULL,NULL),(28,'Black Bag','good looking',50,3,NULL),(29,'ananan',NULL,50,NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'aljak','user@example.com','pass123','Alja','Kratovac','user','2025-10-30 19:49:18','Some street'),(2,'ananan','nnn@mmm.com','$2y$10$d29yDQMO/PlpzYR0ipbVaudQLCI28ubGcMz4NgCVnnJH0Rm/NHA6y',NULL,NULL,'user','2025-10-30 19:57:19',NULL),(3,'','','','Emma','Emily','user','2025-10-30 21:06:17',NULL),(4,'Test User','test@example.com','$2y$10$gJb0N7xTqfw1L8l0CDIggeJY6r7llrTSGeF2GpwIAuY7/phB38UpO',NULL,NULL,'user','2025-10-30 21:19:18',NULL),(6,'Test User','test@example.com','$2y$10$rIzGCu/zcm2lo0kJbzVBu.KJDwmNdUMnGizz.k0dkmK7JnIbHutva',NULL,NULL,'user','2025-10-31 13:36:22',NULL),(7,'Test User','test@example.com','$2y$10$VCRULZHWSjBfnFJF8twJzucxW0OWCWrU1pyxCkHwH3Nox4IwF1fby',NULL,NULL,'user','2025-10-31 20:17:22',NULL),(8,'Test User','test@example.com','$2y$10$4yPrA2hExxAnl5wTVJSOkONB87wZGzGwvuH7WSz8DB4BY01lm7L0.',NULL,NULL,'user','2025-10-31 20:18:46',NULL),(9,'Test User','test@example.com','$2y$10$uMmmhhzh0ILzLF64n0ZbH.4pvuTkXwQSPsm8nEVULtsjb/omhVgQS',NULL,NULL,'user','2025-10-31 20:19:04',NULL),(11,'AdminUser','admin@example.com','$2y$10$MRWBvj1FRQcbWJd3hR9yquoRoF8ZR6E2qqSifDlI2J8ho5CwVlBe2',NULL,NULL,'admin','2025-10-31 20:22:40',NULL),(12,'AdminUser','admin@example.com','$2y$10$6htRYxQlIOZ2FGZGvholFuBR7L.l1VYusRaa5TFPIsBoXJBLxGUpK',NULL,NULL,'admin','2025-10-31 20:32:35',NULL),(13,'AdminUser','admin@example.com','$2y$10$XxynxBXWrVVpQAd957tcoe75XJvjtzH4YNNyHVjlx6CA5ZuNy.2se',NULL,NULL,'admin','2025-11-01 11:31:53',NULL),(14,'AdminUser','admin@example.com','$2y$10$SadWjXAvdeWjbS5NKQqmFejqnKzYWTxVZPBYAqxHDHEyOr.51hnzy',NULL,NULL,'admin','2025-11-11 18:05:57',NULL),(15,'newuser','newuser@example.com','hashed_password_here','John','Doe','user','2025-11-12 09:19:30','123 Main Street'),(16,'newuser','newuser@example.com','hashed_password_here','John','Doe','user','2025-11-12 09:24:54','123 Main Street'),(17,'newuser','newuser@example.com','hashed_password_here','John','Doe','user','2025-11-12 09:28:21','123 Main Street'),(18,'newuser','newuser@example.com','hashed_password_here','John','Doe','user','2025-11-12 14:23:38','123 Main Street'),(19,'newuser','newuser@example.com','hashed_password_here','John','Doe','user','2025-11-12 17:43:44','123 Main Street'),(20,'aljak','user@example.com','pass123','Alja','Kratovac','user','2025-11-14 13:24:10','Some street');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'alja_bags'
--
