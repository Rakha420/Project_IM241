-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: db_office_smart
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `m_karyawan`
--

DROP TABLE IF EXISTS `m_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_karyawan` (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) DEFAULT NULL,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_karyawan`
--

LOCK TABLES `m_karyawan` WRITE;
/*!40000 ALTER TABLE `m_karyawan` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_ruangan`
--

DROP TABLE IF EXISTS `m_ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_ruangan` (
  `id_ruangan` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `fasilitas` text,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_ruangan`
--

LOCK TABLES `m_ruangan` WRITE;
/*!40000 ALTER TABLE `m_ruangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_ruangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_booking`
--

DROP TABLE IF EXISTS `t_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_booking` (
  `id_booking` int NOT NULL AUTO_INCREMENT,
  `id_karyawan` int DEFAULT NULL,
  `id_ruang` int DEFAULT NULL,
  `tanggal_rapat` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `agenda` varchar(255) DEFAULT NULL,
  `status` text,
  PRIMARY KEY (`id_booking`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_ruang` (`id_ruang`),
  CONSTRAINT `t_booking_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `m_karyawan` (`id_karyawan`),
  CONSTRAINT `t_booking_ibfk_2` FOREIGN KEY (`id_ruang`) REFERENCES `m_ruangan` (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_booking`
--

LOCK TABLES `t_booking` WRITE;
/*!40000 ALTER TABLE `t_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_log_aktivitas`
--

DROP TABLE IF EXISTS `t_log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_log_aktivitas` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `keterangan` text,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_log_aktivitas`
--

LOCK TABLES `t_log_aktivitas` WRITE;
/*!40000 ALTER TABLE `t_log_aktivitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-10 21:50:36
