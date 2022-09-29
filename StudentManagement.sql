-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: StudentManagement
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Assignments`
--

DROP TABLE IF EXISTS `Assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Assignments` (
  `AssignmentID` int NOT NULL AUTO_INCREMENT,
  `Description` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `FilePath` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `DueTo` datetime NOT NULL,
  `FileName` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`AssignmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assignments`
--

LOCK TABLES `Assignments` WRITE;
/*!40000 ALTER TABLE `Assignments` DISABLE KEYS */;
INSERT INTO `Assignments` VALUES (17,'Bài tập toán lớp 12 chương 1','/admin/assignments/5f6ebeadacfcf_www.thuvienhoclieu.com-Trac-nghiem-ON-TAP-CHUONG-1-GIAI-TICH-12-co-dap-an.doc.docx','2020-09-30 18:00:00','www.thuvienhoclieu.com-Trac-nghiem-ON-TAP-CHUONG-1-GIAI-TICH-12-co-dap-an.doc.docx'),(19,'Đề ngữ văn kì 2 lớp 7','/admin/assignments/5f6ecc8cc9abc_www.thuvienhoclieu.com-14-de-thi-hk-2-van-7-co-dap-an.docx','2020-10-02 15:00:00','www.thuvienhoclieu.com-14-de-thi-hk-2-van-7-co-dap-an.docx');
/*!40000 ALTER TABLE `Assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Challenges`
--

DROP TABLE IF EXISTS `Challenges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Challenges` (
  `ChallengeID` int NOT NULL AUTO_INCREMENT,
  `ChallengeName` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Hint` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Folder` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`ChallengeID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Challenges`
--

LOCK TABLES `Challenges` WRITE;
/*!40000 ALTER TABLE `Challenges` DISABLE KEYS */;
INSERT INTO `Challenges` VALUES (21,'Một bài thơ ...','bài thơ nổi tiếng của Xuân Quỳnh','5f6e3380b32a5'),(23,'Đoán tên một bài hát','Là một bài hát của nam ca sĩ kiêm sáng tác nhạc Sơn Tùng M-TP được trích từ album phòng thu đầu tiên của anh, m-tp M-TP (2017). Nó được phát hành với vai trò là đĩa đơn mở đường trong album. Bài hát được sáng tác và thể hiện bởi chính Sơn Tùng với sự đồng hỗ trợ của nhà sản xuất Triple D. Ca khúc được phát hành lần đầu tiên trên hệ thống YouTube vào lúc 0:00 (GMT+7) ngày 1 tháng 1 năm 2017[1] và được phát hành trên hệ thống cửa hàng iTunes bởi công ty M-TP Entertainment và bởi Nhac.vn. Đây là ca khúc đầu tiên của Sơn Tùng M-TP trong năm 2017 cũng như ca khúc đầu tiên của Sơn Tùng sau khi rời khỏi WePro Entertainment và người quản lý cũ Nguyễn Quang Huy.','5f6ebd9910461'),(24,'Đoán tên một bài thơ','Là bài thơ của tác giả Phạm Tiến Duật. Bài thơ này được tặng giải Nhất cuộc thi thơ của báo Văn nghệ năm 1969 và được đưa vào tập thơ Vầng trăng quầng lửa của tác giả.[1]','5f6ecd061446a');
/*!40000 ALTER TABLE `Challenges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Histories`
--

DROP TABLE IF EXISTS `Histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Histories` (
  `HistoryID` int NOT NULL AUTO_INCREMENT,
  `StudentID` int NOT NULL,
  `Result` tinyint(1) NOT NULL,
  `SubmitDate` datetime NOT NULL,
  `ChallengeID` int NOT NULL,
  PRIMARY KEY (`HistoryID`),
  KEY `STUDENT_FK` (`StudentID`),
  KEY `CHAL_FK` (`ChallengeID`),
  CONSTRAINT `CHAL_FK` FOREIGN KEY (`ChallengeID`) REFERENCES `Challenges` (`ChallengeID`) ON DELETE CASCADE,
  CONSTRAINT `STUDENT_FK` FOREIGN KEY (`StudentID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Histories`
--

LOCK TABLES `Histories` WRITE;
/*!40000 ALTER TABLE `Histories` DISABLE KEYS */;
INSERT INTO `Histories` VALUES (48,18,0,'2020-09-25 18:14:00',21),(49,18,1,'2020-09-25 18:14:47',21),(50,12,1,'2020-09-26 04:01:26',21),(51,12,1,'2020-09-26 04:04:00',23),(52,12,0,'2020-09-26 05:14:00',21),(53,12,1,'2020-09-26 05:15:06',21),(54,12,0,'2020-09-26 05:15:00',24),(55,12,1,'2020-09-26 05:15:35',24),(56,12,1,'2020-09-26 07:40:50',24);
/*!40000 ALTER TABLE `Histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Messages`
--

DROP TABLE IF EXISTS `Messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Messages` (
  `MessageID` int NOT NULL AUTO_INCREMENT,
  `Content` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  `SendID` int NOT NULL,
  `ReceiveID` int NOT NULL,
  `Seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `SendID` (`SendID`),
  KEY `ReceiveID` (`ReceiveID`),
  CONSTRAINT `RECEIVEID_FK` FOREIGN KEY (`ReceiveID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  CONSTRAINT `SENDID_FK` FOREIGN KEY (`SendID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messages`
--

LOCK TABLES `Messages` WRITE;
/*!40000 ALTER TABLE `Messages` DISABLE KEYS */;
INSERT INTO `Messages` VALUES (25,'Hi hoang nd','2020-09-26 03:16:57',14,12,0),(26,'How old are you ?','2020-09-26 03:51:37',12,14,0),(27,'Nice question bruhh :))','2020-09-26 03:53:03',20,12,0),(28,'You have a new message from Kobe !','2020-09-26 03:53:51',23,12,0),(29,'Hi Nguyen Thi Viet Ha','2020-09-26 04:56:26',12,14,0);
/*!40000 ALTER TABLE `Messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reports`
--

DROP TABLE IF EXISTS `Reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Reports` (
  `ReportID` int NOT NULL AUTO_INCREMENT,
  `StudentID` int NOT NULL,
  `FilePath` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  `AssignmentID` int NOT NULL,
  `FileName` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`ReportID`),
  KEY `ASSIGNMENTID_FK` (`AssignmentID`),
  KEY `STUDENTID_FK` (`StudentID`),
  CONSTRAINT `ASSIGNMENTID_FK` FOREIGN KEY (`AssignmentID`) REFERENCES `Assignments` (`AssignmentID`) ON DELETE CASCADE,
  CONSTRAINT `STUDENTID_FK` FOREIGN KEY (`StudentID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reports`
--

LOCK TABLES `Reports` WRITE;
/*!40000 ALTER TABLE `Reports` DISABLE KEYS */;
INSERT INTO `Reports` VALUES (7,12,'/admin/assignments/5f6ece9e29b6c_baocaothuchanh1.docx','2020-09-26 05:13:54',17,'baocaothuchanh1.docx');
/*!40000 ALTER TABLE `Reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Roles` (
  `RoleID` int NOT NULL AUTO_INCREMENT,
  `Description` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (1,'Student'),(2,'Teacher');
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserName` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Password` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `FullName` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `PhoneNumber` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Email` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Role` int NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `Role` (`Role`),
  KEY `Role_2` (`Role`),
  CONSTRAINT `ROLE_FK` FOREIGN KEY (`Role`) REFERENCES `Roles` (`RoleID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (12,'student','$2y$10$bsBWc4V4HKFj3jtkjmRFzOgTLZ71pasc9d1DeZhyuJHIy3sUiKxVC','Student VCS','0946164298','student@viettel.com.vn',1),(14,'hale123','$2y$10$uinVa.k9Hl/ceEU32djnle4Gt7YFqVr7T3bh.nW7kKlo9rwDtTSuy','Nguyễn Thị Việt Hà','08123491234','hanguyen0543@gmail.com',2),(18,'quangle','$2y$10$pfjkVfQVuvmU2rek/eOqm.zaY/B/SGfO1e5GqUeZJ1Jklz56u1lqW','Quang Lê','0891231242','quangle@facebook.com',1),(20,'teacher','$2y$10$xVopAR/FX5qxJHjGFS0PAea7snTdf9lM8BloDvMKpROlA02Zh5BFa','Teacher VCS','0841223123','teacher@viettel.com.vn',2),(22,'brook123','$2y$10$S76nXJl6TgsqLSngB7hQWOh/3Q7YPwY9k/urZEecyV.skh/QiSPOq','Russel Westbrook','0123424756','russ00@gmail.com',1),(23,'kingjames','$2y$10$RYJLc4e47JR4PFhuFPUZPuYJ0OjBJu.5g7s1Qpp/cTzAkXIoHj6gO','Lebron James','0834365920','kingjames@cc.xx',1),(24,'blackmamba','$2y$10$brb2E5gwJ3eQfM8n2Ybn5ObT6r84bU66WE4N3nUtfLbuXvt0P94dm','Kobe Bryant','0949961195','mamba@gmail.com',1),(25,'stephencurry','$2y$10$Fop3B/a3tAKCrVI4fAb5aOzMcWgg3jGlyn/3gXMam1b4lMHDP7jCO','Stephen Curry','0671124395','currychicken@gmail.com',1),(26,'elpulga','$2y$10$O.NDSyKVgsth.lwCl/8f2OOnJPpJlvFUb1wiHYpu0t4w9buoJY5dS','Lionel Messi','01672875434','elpulga@gmail.com',1),(29,'nuipq','$2y$10$LxtnJi55SmMuuk3mmKSY2eklfHks1AddcAen0Kx.lIGGhAwMpVuvi','Phạm Quang Núi','0123495890','nuipq@gmail.com',2);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-26  8:02:39
