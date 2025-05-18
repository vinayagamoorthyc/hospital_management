-- MySQL dump 10.13  Distrib 8.0.41, for macos15 (arm64)
--
-- Host: localhost    Database: hospital
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointment` (
  `appointmentId` int NOT NULL AUTO_INCREMENT,
  `a_date` date NOT NULL,
  `a_time` time NOT NULL,
  `r_patientId` int NOT NULL,
  `r_doctorId` int NOT NULL,
  PRIMARY KEY (`appointmentId`),
  KEY `r_patientId` (`r_patientId`),
  KEY `r_doctorId` (`r_doctorId`),
  CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`r_patientId`) REFERENCES `patient` (`patientId`),
  CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`r_doctorId`) REFERENCES `doctor` (`doctorId`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (1,'2025-04-20','10:00:00',1,2),(2,'2025-04-21','11:30:00',2,5),(3,'2025-04-22','09:15:00',3,1),(4,'2025-04-23','14:00:00',4,3),(5,'2025-04-24','15:45:00',5,7),(6,'2025-04-25','13:00:00',6,4),(7,'2025-04-26','16:30:00',7,8),(8,'2025-04-27','08:45:00',8,6),(9,'2025-04-28','12:00:00',9,10),(10,'2025-04-29','10:30:00',10,9),(11,'2025-04-16','09:00:00',1,1),(12,'2025-04-16','09:30:00',2,2),(13,'2025-04-16','10:00:00',3,3),(14,'2025-04-16','10:30:00',4,4),(15,'2025-04-16','11:00:00',5,5),(16,'2025-04-16','11:30:00',6,6),(17,'2025-04-16','12:00:00',7,7),(18,'2025-04-16','12:30:00',8,8),(19,'2025-04-16','01:00:00',9,9),(20,'2025-04-16','01:30:00',10,10),(21,'2025-04-15','09:00:00',1,2),(22,'2025-04-15','09:30:00',2,4),(23,'2025-04-15','10:00:00',3,6),(24,'2025-04-15','10:30:00',4,8),(25,'2025-04-15','11:00:00',5,10),(26,'2025-04-15','11:30:00',6,1),(27,'2025-04-15','12:00:00',7,3),(28,'2025-04-15','12:30:00',8,5),(29,'2025-04-15','01:00:00',9,7),(31,'2025-04-17','09:01:00',1,3),(32,'2025-04-17','09:30:00',2,1),(33,'2025-04-17','10:00:00',3,5),(34,'2025-04-17','10:30:00',4,7),(35,'2025-04-17','11:00:00',5,9),(36,'2025-04-17','11:30:00',6,2),(37,'2025-04-17','12:00:00',7,4),(38,'2025-04-17','13:00:00',8,6),(39,'2025-04-17','13:30:00',9,8),(40,'2025-04-17','14:00:00',10,10);
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing` (
  `billId` int NOT NULL AUTO_INCREMENT,
  `r_patientId` int NOT NULL,
  `billDate` date NOT NULL,
  `totalAmount` double NOT NULL,
  `status` enum('paid','pending') NOT NULL,
  PRIMARY KEY (`billId`),
  KEY `r_patientId` (`r_patientId`),
  CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`r_patientId`) REFERENCES `patient` (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing`
--

LOCK TABLES `billing` WRITE;
/*!40000 ALTER TABLE `billing` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `doctorId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `specialization` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`doctorId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,'Dr. John Smith','Cardiology','1234567890','john.smith@hospital.com'),(2,'Dr. Emily Stone','Neurology','2345678901','emily.stone@hospital.com'),(3,'Dr. Michael Lee','Orthopedics','3456789012','michael.lee@hospital.com'),(4,'Dr. Sarah Kim','Dermatology','4567890123','sarah.kim@hospital.com'),(5,'Dr. David Brown','Pediatrics','5678901234','david.brown@hospital.com'),(6,'Dr. Anna Patel','Oncology','6789012345','anna.patel@hospital.com'),(7,'Dr. Brian Clark','ENT','7890123456','brian.clark@hospital.com'),(8,'Dr. Olivia Davis','Psychiatry','8901234567','olivia.davis@hospital.com'),(9,'Dr. Kevin Wilson','Urology','9012345678','kevin.wilson@hospital.com'),(10,'Dr. Laura Garcia','Gynecology','0123456789','laura.garcia@hospital.com');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_record`
--

DROP TABLE IF EXISTS `medical_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medical_record` (
  `recordId` int NOT NULL AUTO_INCREMENT,
  `diagnosis` varchar(50) NOT NULL,
  `r_doctorId` int NOT NULL,
  `r_patientId` int NOT NULL,
  `r_nurseId` int NOT NULL,
  PRIMARY KEY (`recordId`),
  KEY `r_doctorId` (`r_doctorId`),
  KEY `r_patientId` (`r_patientId`),
  KEY `r_nurseId` (`r_nurseId`),
  CONSTRAINT `medical_record_ibfk_1` FOREIGN KEY (`r_doctorId`) REFERENCES `doctor` (`doctorId`),
  CONSTRAINT `medical_record_ibfk_2` FOREIGN KEY (`r_patientId`) REFERENCES `patient` (`patientId`),
  CONSTRAINT `medical_record_ibfk_3` FOREIGN KEY (`r_nurseId`) REFERENCES `nurse` (`nurseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_record`
--

LOCK TABLES `medical_record` WRITE;
/*!40000 ALTER TABLE `medical_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `medical_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nurse` (
  `nurseId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  PRIMARY KEY (`nurseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nurse`
--

LOCK TABLES `nurse` WRITE;
/*!40000 ALTER TABLE `nurse` DISABLE KEYS */;
/*!40000 ALTER TABLE `nurse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient` (
  `patientId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `age` int NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`patientId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'John Doe',30,'male','1234567890'),(2,'Alice Smith',25,'female','9876543210'),(3,'Bob Johnson',40,'male','5551234567'),(4,'Emily Davis',35,'female','4449876543'),(5,'Michael Brown',28,'male','7778889999'),(6,'Sophia Wilson',22,'female','6667778888'),(7,'David Lee',45,'male','3332221111'),(8,'Olivia Garcia',31,'female','1112223333'),(9,'Daniel Martinez',29,'male','8889990000'),(10,'Emma Hernandez',27,'female','9990001111'),(11,'Maria Randip Leon',21,'male','1122334455'),(12,'Vinayaga Moorthy',21,'male','9360810429'),(13,'Venkatesan',20,'female','8745294087'),(14,'Sanjay',21,'male','9647384732'),(15,'Jaya Priya',23,'female','9345865715');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_report`
--

DROP TABLE IF EXISTS `patient_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient_report` (
  `reportId` int NOT NULL AUTO_INCREMENT,
  `sugar` enum('low','medium','high') NOT NULL,
  `bp` enum('low','medium','high') NOT NULL,
  `reportDate` date NOT NULL,
  `r_patientId` int NOT NULL,
  PRIMARY KEY (`reportId`),
  KEY `r_patientId` (`r_patientId`),
  CONSTRAINT `patient_report_ibfk_1` FOREIGN KEY (`r_patientId`) REFERENCES `patient` (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_report`
--

LOCK TABLES `patient_report` WRITE;
/*!40000 ALTER TABLE `patient_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receptionist`
--

DROP TABLE IF EXISTS `receptionist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receptionist` (
  `receptionistId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  PRIMARY KEY (`receptionistId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receptionist`
--

LOCK TABLES `receptionist` WRITE;
/*!40000 ALTER TABLE `receptionist` DISABLE KEYS */;
/*!40000 ALTER TABLE `receptionist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-17 16:44:31
