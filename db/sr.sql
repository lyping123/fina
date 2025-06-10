-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: student_registration
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `b_c`
--

DROP TABLE IF EXISTS `b_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` varchar(450) DEFAULT NULL,
  `cheque_no` varchar(450) DEFAULT NULL,
  `banker` varchar(450) DEFAULT NULL,
  `in_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_c`
--

LOCK TABLES `b_c` WRITE;
/*!40000 ALTER TABLE `b_c` DISABLE KEYS */;
INSERT INTO `b_c` VALUES (1,'2','BANKIN','Alliance Bank','2016-10-05 02:30:22'),(2,'3','0123456789','Affin Bank Berhad','2016-11-18 08:18:47');
/*!40000 ALTER TABLE `b_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_desc` varchar(450) DEFAULT NULL,
  `c_amount` varchar(450) DEFAULT NULL,
  `c_tuition_fee` varchar(450) DEFAULT NULL,
  `c_ptpk` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `l_username` varchar(450) DEFAULT NULL,
  `l_password` varchar(450) DEFAULT NULL,
  `level` varchar(450) DEFAULT NULL,
  `l_name` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'admin','admin','admin','Wei');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_no` varchar(450) DEFAULT NULL,
  `r_date` date DEFAULT NULL,
  `s_name` varchar(450) DEFAULT NULL,
  `s_ic` varchar(450) DEFAULT NULL,
  `pay_mtd` varchar(450) DEFAULT NULL,
  `tuition_fee` varchar(450) DEFAULT NULL,
  `ptpk` varchar(450) DEFAULT NULL,
  `r_status` varchar(450) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `createby` varchar(450) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt`
--

LOCK TABLES `receipt` WRITE;
/*!40000 ALTER TABLE `receipt` DISABLE KEYS */;
INSERT INTO `receipt` VALUES (1,'10001','2016-10-05','Ong Eng Wei','950724075323','-','YES','YES','ACTIVE','2016-10-05 10:29:40','1',NULL,NULL),(2,'10002','2016-10-05','Ong Eng Wei','950724075323','bankin','NO','NO','ACTIVE','2016-10-05 10:30:50','1',NULL,NULL),(3,'10003','2016-11-18','Ong Eng Wei','950724075323','cheque','YES','YES','ACTIVE','2016-11-18 08:18:49','1',NULL,NULL);
/*!40000 ALTER TABLE `receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_detail`
--

DROP TABLE IF EXISTS `receipt_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` varchar(450) DEFAULT NULL,
  `rp_desc` varchar(450) DEFAULT NULL,
  `rp_amount` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_detail`
--

LOCK TABLES `receipt_detail` WRITE;
/*!40000 ALTER TABLE `receipt_detail` DISABLE KEYS */;
INSERT INTO `receipt_detail` VALUES (1,'1','Tuition Fee (September)','750'),(2,'2','test','100'),(3,'1','test','300.99'),(4,'3','test','100'),(5,'3','test1','99'),(6,'3','test1','99'),(7,'3','test1','99'),(8,'3','test1','99'),(9,'3','test1','99'),(10,'3','test1','99'),(11,'3','test1','99'),(12,'3','test1','99'),(13,'3','test1','99'),(14,'3','test1','99'),(15,'3','test1','99'),(16,'3','test1','99'),(17,'3','test1','99'),(18,'3','test1','99'),(19,'3','test1','99'),(20,'3','test1','99'),(21,'3','test1','99'),(22,'3','test1','99'),(23,'3','test1','99'),(24,'3','test1','99');
/*!40000 ALTER TABLE `receipt_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(450) DEFAULT NULL,
  `s_name` varchar(450) DEFAULT NULL,
  `s_email` varchar(450) DEFAULT NULL,
  `ic` varchar(450) DEFAULT NULL,
  `nationality` varchar(450) DEFAULT NULL,
  `race` varchar(450) DEFAULT NULL,
  `r_address` varchar(450) DEFAULT NULL,
  `r_postcode` varchar(450) DEFAULT NULL,
  `r_state` varchar(450) DEFAULT NULL,
  `c_address` varchar(450) DEFAULT NULL,
  `c_postcode` varchar(450) DEFAULT NULL,
  `c_state` varchar(450) DEFAULT NULL,
  `chinese_name` varchar(450) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h_contact` varchar(450) DEFAULT NULL,
  `hp_contact` varchar(450) DEFAULT NULL,
  `guardian` varchar(450) DEFAULT NULL,
  `school` varchar(450) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` varchar(450) DEFAULT NULL,
  `gender` varchar(450) DEFAULT NULL,
  `m_status` varchar(450) DEFAULT NULL,
  `religion` varchar(450) DEFAULT NULL,
  `s_desc` varchar(450) DEFAULT NULL,
  `tuition_fee` varchar(450) DEFAULT NULL,
  `p_method` varchar(450) DEFAULT NULL,
  `cost_per_month` varchar(450) DEFAULT NULL,
  `p_month` varchar(450) DEFAULT NULL,
  `date_join` date DEFAULT NULL,
  `course` varchar(450) DEFAULT NULL,
  `photo` varchar(450) DEFAULT NULL,
  `s_status` varchar(450) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `createby` varchar(450) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'B.PRO 5323','Ong Eng Wei','test@gmail.com','950724075323','Malaysia1','Chinese','21 Lorong Jaya 2, Taman Impian Jaya','14000','Penang','-','-','-','王永伟','-','-','-','-','2016-10-11','21','Male','Single','Buddhism','NONE','22500','cash','750','30','2016-10-11','Programming','img/P20161011083642.jpg','ACTIVE',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-08  8:31:07
