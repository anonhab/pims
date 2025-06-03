/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: pimss
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `Notifications`
--

DROP TABLE IF EXISTS `Notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) DEFAULT NULL,
  `recipient_role` enum('admin','doctor','officer','lawyer','prisoner','visitor','inspector','commissioner','security','system_admin','training_officer','discipline_officer') NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `related_table` varchar(50) DEFAULT NULL,
  `related_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_notifications_prison_id` (`prison_id`),
  CONSTRAINT `fk_notifications_prison_id` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notifications`
--

LOCK TABLES `Notifications` WRITE;
/*!40000 ALTER TABLE `Notifications` DISABLE KEYS */;
INSERT INTO `Notifications` VALUES
(140,41,'lawyer',11,6,'requests',NULL,'Request Submitted','A human_rights_violation request has been submitted for prisoner Habtamu Gashu.',1,'2025-05-26 05:21:56','2025-05-27 02:12:09'),
(141,356,'prisoner',NULL,6,'police_prisoner_assignments',NULL,'Police Officer Assigned','A prisoner has been assigned to you: Rodolfo Lowe.',1,'2025-05-26 05:23:21','2025-05-26 23:28:19'),
(142,356,'prisoner',NULL,6,'police_prisoner_assignments',NULL,'Police Officer Assigned','A prisoner has been assigned to you: Rodolfo Lowe.',1,'2025-05-26 05:24:15','2025-05-26 23:28:19'),
(143,NULL,'officer',11,6,'requests',NULL,'Request Submitted','a prison_transfer request for prisoner Rodolfo Lowe.',1,'2025-05-26 05:24:47','2025-05-27 02:12:09'),
(144,340,'prisoner',NULL,6,'police_prisoner_assignments',NULL,'Police Officer Assigned','A prisoner has been assigned to you: worabe Gashu.',1,'2025-05-26 22:00:12','2025-05-26 23:28:19'),
(145,340,'prisoner',NULL,6,'lawyer_prisoner_assignments',NULL,'Lawyer Assigned','A prisoner has been assigned to you: worabe Gashu.',1,'2025-05-26 22:01:10','2025-05-26 23:28:19'),
(146,3,'prisoner',NULL,22,'medical_appointments',NULL,'New Medical Appointment','You have a medical appointment scheduled for 2025-05-26T20:03.',0,'2025-05-26 22:03:58','2025-05-26 22:03:58'),
(147,82,'doctor',9,22,'medical_appointments',NULL,'New Appointment Assigned','You have been assigned a medical appointment with prisoner Habtamu Gashu on 2025-05-26T20:03.',1,'2025-05-26 22:03:58','2025-05-26 22:04:17'),
(148,341,'prisoner',NULL,6,'police_prisoner_assignment',NULL,'Police Officer Assigned','A prisoner has been assigned to you: prisoner1 prisoner12.',1,'2025-05-26 22:38:56','2025-05-26 23:28:19'),
(149,1,'prisoner',NULL,6,'lawyer_prisoner_assignment',NULL,'Lawyer Assigned','A prisoner has been assigned to you: prisHabtamu Gashu.',1,'2025-05-26 22:39:49','2025-05-26 23:28:19'),
(150,1,'prisoner',NULL,6,'police_prisoner_assignment',NULL,'Police Officer Assigned','A prisoner has been assigned to you: prisHabtamu Gashu.',1,'2025-05-26 22:40:10','2025-05-26 23:28:19'),
(151,341,'prisoner',NULL,6,'police_prisoner_assignment',NULL,'Police Officer Assigned','A prisoner has been assigned to you: prisoner1 prisoner12.',1,'2025-05-26 22:43:04','2025-05-26 23:28:19'),
(152,1,'prisoner',NULL,6,'police_prisoner_assignment',NULL,'Police Officer Assigned','A prisoner has been assigned to you: prisHabtamu Gashu.',1,'2025-05-26 23:03:33','2025-05-26 23:28:19'),
(153,338,'prisoner',NULL,6,'lawyer_prisoner_assignment',NULL,'Lawyer Assigned','A prisoner has been assigned to you: Habtamu Gashu.',1,'2025-05-26 23:05:56','2025-05-26 23:28:19'),
(154,356,'prisoner',NULL,6,'lawyer_prisoner_assignment',NULL,'Lawyer Assigned','A prisoner has been assigned to you: Rodolfo Lowe.',1,'2025-05-26 23:06:41','2025-05-26 23:28:19'),
(155,356,'prisoner',NULL,6,'police_prisoner_assignment',NULL,'Police Officer Assigned','A prisoner has been assigned to you: Rodolfo Lowe.',1,'2025-05-26 23:06:54','2025-05-26 23:28:19'),
(156,1,'prisoner',NULL,6,'job_assignments',140,'Job Updated','prisoner prisHabtamu Gashu  job assignment (Gardener) has been updated.',1,'2025-05-26 23:23:44','2025-05-26 23:28:19'),
(157,81,'officer',6,6,'job_assignments',140,'Job Updated','You updated the job Gardener for prisHabtamu Bitew Gashu.',0,'2025-05-26 23:23:44','2025-05-26 23:23:44'),
(158,338,'prisoner',0,6,'requests',2186,'Request Transferred','prisoner  Habtamu Gashu  request has been transferred. Evaluation: sdasdklasdfalsdk',0,'2025-05-27 00:02:29','2025-05-27 00:02:29'),
(159,86,'officer',11,6,'requests',2186,'Request Transferred','You transferred a request for Habtamu Bitew Gashu. Evaluation: sdasdklasdfalsdk',1,'2025-05-27 00:02:29','2025-05-27 02:12:09'),
(160,356,'prisoner',0,6,'requests',2187,'Request Transferred','prisoner  Rodolfo Lowe  request has been transferred. Evaluation: wdasldk',0,'2025-05-27 00:02:34','2025-05-27 00:02:34'),
(161,86,'officer',11,6,'requests',2187,'Request Transferred','You transferred a request for Rodolfo Madelynn Lowe Lowe. Evaluation: wdasldk',1,'2025-05-27 00:02:34','2025-05-27 02:12:09'),
(162,338,'prisoner',0,6,'requests',2186,'Request Approved','prisoner  Habtamu Gashu request has been approved. Evaluation: xcx',0,'2025-05-27 00:03:28','2025-05-27 00:03:28'),
(163,80,'officer',5,6,'requests',2186,'Request Approved','You approved a request for Habtamu Bitew Gashu. Evaluation: xcx',1,'2025-05-27 00:03:28','2025-05-27 00:04:10'),
(164,356,'prisoner',0,6,'requests',2187,'Request Approved','prisoner  Rodolfo Lowe request has been approved. Evaluation: sdsadkasd',0,'2025-05-27 00:03:45','2025-05-27 00:03:45'),
(165,80,'officer',5,6,'requests',2187,'Request Approved','You approved a request for Rodolfo Madelynn Lowe Lowe. Evaluation: sdsadkasd',1,'2025-05-27 00:03:45','2025-05-27 00:04:10'),
(166,41,'lawyer',11,6,'lawyer_appointments',NULL,'New Appointment Assigned','a request for legal appointment with prisoner worabe Gashu on 2025-06-05.',1,'2025-05-27 01:04:25','2025-05-27 02:12:09'),
(167,41,'lawyer',11,6,'lawyer_appointments',NULL,'New Appointment Assigned','a request for legal appointment with prisoner Rodolfo Lowe on 2025-05-31.',1,'2025-05-27 01:07:12','2025-05-27 02:12:09');
/*!40000 ALTER TABLE `Notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `user_image` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `fk_accounts_prison` (`prison_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `fk_accounts_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prison_id` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES
(12,'bossSDA@gmail.com','$2y$12$IHpvu1veh.d1a9xf2hLuf.PHqniVySJmKWv9Oq4qn4tWjfxOlFMxS',3,'Habtamu','Gashu','central@gmail.com','user_images/9CIWNZ3mDQ9Ayfof2HOi8bUPHtQ8tYB8lgPYps9X.png','09433923328000000','2025-02-26','male','Dire Dawa','2025-03-09 19:26:03','2025-05-09 01:44:39',4),
(14,'bobnss@gmail.com','$2y$12$5CftZfA5GaNTU1JeSI/AN.ZNVqIK41wdcN72MP1BozrnE2N4SEZoy',2,'Habtamu','Gashu','Habtsha2p021@gmail.com','user_images/dd3GW1Dvdwd14JKJfqzMrOOApNHOkkMNuFakujcj.png','0909029295','2025-03-05','male','Bahir Dar, Amhara-Mirab Gojam','2025-03-10 01:24:14','2025-04-01 01:29:51',20),
(16,'boss@gmail.com','$2y$12$tI7pMs.wgJn0hlrQxaZXeuMosS0OkkbRXMMIxE0d3gskOcXpu1by2',2,'Habtamu','Gashu','boss@gmail.com','user_images/3zpDUXsETUxSecgTbxGG1vVi4Qm1XMBVz4YZmgpD.png','0909029295','2025-03-05','male','Bahir dar\r\nBahir dar,Ethiopia','2025-03-11 01:56:42','2025-03-23 02:46:10',10),
(20,'test@gmail.com','$2y$12$F7wJwT5zz5DVq2xKeDmyiuHewOjR5fH4ykZoVdcdNRKiXQJT3Wks2',1,'Habtamu','Gashu','Habtshatest2021@gmail.com','user_images/1xUI9yx11PaXdWJkZZPg9LDU2zBiAl9EohKkQR01.png','0909029295','2025-03-19','male','Bahir Dar, Amhara-Mirab Gojam','2025-03-14 02:13:46','2025-03-14 02:13:46',5),
(22,'lol@gmail.com','$2y$12$cgkTSCEIVLgLN4LJutex4u37LroOW8kjLrV3N3tNPPAHzUKfqQtxG',2,'Habtamu','Gashu','lol@gmail.com','user_images/E5sREAK4A6DUQmnS8X6jWoi7GNcbFHa6I0Q7TsXP.png','0909029295','2025-03-05','male','Bahir Dar, Amhara-Mirab Gojam','2025-03-14 03:12:58','2025-03-22 06:55:17',10),
(23,'lol1@gmail.com','$2y$12$f8sjKj//5g7r/SIaWX3Bsu0psAMdSJUpDO1bqxU7.rgeTWZdjmNGm',1,'Habtamu','Gashu','lols1@gmail.com','user_images/nQEcl5KF8xBSBncImpqeWNYiAkNTDop1Mbo7mCcC.png','0909029295','2025-03-29','male','Addis Ababa, Bole','2025-03-14 03:37:02','2025-04-01 01:30:32',3),
(25,'boss1@gmail.com','$2y$12$gPw9CfXxmS031K2gbu0yn.gx1FjlKrhWc2fyD/AUWSOSlz1VLNsk6',2,'Habtamu','Gashu','boss1@gmail.com','user_images/z8xWEKZcpvbhohi5CRutEn72LVXiAZhJxYybwt5o.jpg','0909029295','2025-03-18','male','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','2025-03-17 03:32:04','2025-03-30 21:41:15',7),
(35,'centraddl@gmail.com','$2y$12$8y9BWQ39rUYSw4zpoKTGSuz/AVN8chouFKjl0TMaCu2s90j.1HtYW',1,'Habtamu','Gashu','systemmm@gmail.com','user_images/FhofqLufhMNCb2WHkmI7iH1EgvgvDBpAfxhrYrq1.jpg','0909029295','2025-03-19','male','Bahir Dar, Amhara-Mirab Gojam','2025-03-18 05:35:53','2025-03-30 21:49:08',5),
(37,'centsdsdsd@gmail.com','$2y$12$by/8H4.bFyBxe07qXraCf.Ehk1Qtubm2goGyVdMjvHh7TQeQ978La',1,'demlew','Gashu','kembatain@gmail.com','user_images/W3iMw3ZwhhFRUz0GvGAVxtXgOhtGIxh1oOCWlbi8.jpg','0909029295','2025-03-13','male','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','2025-03-18 05:46:40','2025-03-31 14:19:35',5),
(38,'worabe@gmail.com','$2y$12$vo82.5Z5Ko9coM.6i2pcp.YcGqgNR3hqT17mowHao3Yo4kuWdyN/q',1,'Habtamu','Gashu','worabe@gmail.com','user_images/UZ3Pf5OBDrvz6THLEwzpEPmmCvpyN2LrItDNSyck.jpg','0909029295','2025-03-05','male','Gonder','2025-03-18 14:22:19','2025-03-18 14:22:19',6),
(40,'worabe@gm.com','$2y$12$YoFLSazec8QGcZksLGycMunEjqPl41qYKpFoA8xQLG0ureWn1LT7.',NULL,'Habtamu','Gashu','worabeins@gmail.com','user_images/dBaIkBS3uXEDauEI7rjzhO3aCDgS76br3p6xiSt5.jpg','0909029295','2025-03-05','male','Bahir dar\r\nBahir dar,Ethiopia','2025-03-18 14:24:20','2025-03-22 06:38:26',11),
(41,'Habtdddd','$2y$12$Fg2IsCfazxIyjMN0k5S1KeA05QKXg94oJ45u2jCmvwO1xo2fI7oES',1,'Habtamu','Gashu','sy@gmail.com','user_images/16njaoR8OQyoNIvMwKosu3grBn6SR0KofLNhbqcW.png','0909029295','2025-03-19','male','Addis Ababa, Bole','2025-03-18 15:18:55','2025-03-18 15:18:55',3),
(42,'siltein@gmail.com','$2y$12$4KuzwvCnAAANCIXSUZAgjez29WsJc7UN9BCbJN1V7Eyn3c8GiNNWS',8,'Habtamu','Gashu','policesilteI@gmail.com','user_images/qRZuTOOjhpKmbkum0w6nK0iZzI55jxO0q9pSjVJT.png','0909029295','2025-03-26','male','Bahir dar\r\nBahir dar,Ethiopia','2025-03-18 17:46:57','2025-03-18 17:46:57',11),
(43,'worabepolice@gmail.com','$2y$12$cv/J4YJ5NPgiHUzKYrNAmeBbz1vYrpwypCAPL3EEWeDK53D0Pcr5S',NULL,'ato belete','Gashu','worabepolice@gmail.com','user_images/DCJg9bnaNxm9zEqNp1jj9X28aTwqBub8ur9ptM89.jpg','0909029295','2025-03-19','male','Bahir dar\r\nBahir dar,Ethiopia','2025-03-18 18:55:00','2025-03-22 06:37:27',6),
(50,'systemmm@gmail.com','$2y$12$b38ZswU8ANFAEgH4p7NTZuKb1O4sMkBhbT8cSH2Rt/wuhw.4euL1C',3,'Habtamu','Gashu','Habtshaxx@gmail.com','user_images/msesHXoWgm9h3XgEFffALI48GaGWij6uZyROx1GO.jpg','0909029295','2025-03-06','male','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','2025-03-30 21:48:23','2025-03-30 22:23:08',5),
(51,'central@gmail.com','$2y$12$cOF4CjekXagW.ukYjXb.6urD3zD6efSt/9bugfgUHsWOoP.4rWdQC',1,'Habtamu','Gashu','Habtsha2021zz@gmail.com','user_images/8C2VnRFEJWwNVtKYQQs9I7IS4wH0Ko1oPCpbdJs9.png','0909029295','2025-03-15','male','Addis Ababa, Bole','2025-03-30 22:57:39','2025-03-30 22:57:39',18),
(52,'centrabhal@gmail.com','$2y$12$l6rwiwi4UJEwtG5bPk71EegG7N.ipfYpDmtW9XX04e5hmFbg/Y1cu',1,'Habtamu','Gashu','Habtshssa2021@gmail.com','user_images/iHrWORaaetu94Y2gHTLSdaocGANmAphEms2OHqsh.png','0909029295','2025-03-10','male','Dire Dawa','2025-03-30 23:06:33','2025-03-30 23:06:33',22),
(53,'centralllll@gmail.com','$2y$12$7eaTiOOxYRxa7EhMYkLSLeU/XsIUQpTM97ShRxrZlTbgtCwvcQ8iG',1,'Habtamu','Gashu','Habtsssha2021@gmail.com','user_images/GhmFDfAwxNCh64vJT7NLd4T9qoBPCdBW4NLbvEVm.png','0909029295','2025-03-14','male','Addis Ababa, Bole','2025-03-30 23:10:04','2025-03-30 23:10:04',6),
(61,'cefgfhgfhfntral@gmail.com','$2y$12$Oh5ERTxgnO7un5JxGFwEruYR0IApOVHuTzQEVFwJP0rr4eEOhcbt.',1,'Habtamu','Gashu','syssss@gmail.com','user_images/cVeVFyE4oeBhJFgeDr4GisUMXsrU1eHovtrH4WqZ.jpg','0909029295','2025-03-29','male','Addis Ababa, Bole','2025-03-31 20:20:02','2025-03-31 20:20:38',20),
(62,'sdfasdf@gmail.com','$2y$12$3Z6GcfOJgWqAQToIRjl4KOCgCNBp866NZyomroR6.bslK10OAhOG2',1,'Habtamu','Gashu','Habtsha2021@gmail.com','user_images/OqCXL7njmU8GhkeswczPZ9icKYAhT8xlqZpJW146.png','0909029295','2025-03-11','male','Addis Ababa, Bole','2025-03-31 20:23:20','2025-03-31 20:23:20',19),
(63,'worabdde@gmail.com','$2y$12$lW7IkICb.pvKUbYs4kpnPOZIjYu9NlQENV/3PfOEyy5dBdFmq9z9.',2,'Habtamu','Gashudasd','worabeinspector@gmail.com','user_images/vghnBWAQcp5z2hDXfbpDSBg4FL1F4p9qfyY2FVs3.jpg','0909029295','2025-03-26','male','Bahir dar\nBahir dar,Ethiopia','2025-03-31 20:29:59','2025-05-26 02:19:17',6),
(64,'kembatains@gmail.com','$2y$12$HbJWX5DrY3mEVlLL/NjtXeJTaNnVVqMDZ4HcWBj3X1lueVxnJH9z.',2,'Habtamu','Gashu','kembatains@gmail.com','user_images/o26CcNIDVbkwNLCF1jC3qu0IIzXsMwrQvuAGykug.jpg','0909029295','2025-03-12','male','Bahir dar\r\nBahir dar,Ethiopia','2025-04-01 01:40:07','2025-04-01 01:40:07',5),
(65,'wolkite@gmail.com','$2y$12$8meOqFzPEz1.iRSaDZOzH.f0vV0954QldaKx1H5ADuegh4MvkCHAm',1,'wolkite','Gashu','wolkite@gmail.com','user_images/vRFvzL5ZTUn5iOvYVlAAx9G4gmHqsMJzTlgBFDby.jpg','0909029295','2025-04-17','male','Addis Ababa, Bole','2025-04-01 15:47:43','2025-04-01 15:47:43',1),
(68,'policeoficer@gmail.com','$2y$12$gN4X.Va8WxLAIIzyUNrhqOg0mhvW9WxLGO9MjnXlJEfQ.UNX.03za',8,'abushi','Gashu','abush@gmail.com','user_images/lsm4LbsBMBE7zmU0yzhPmlomUtTvcFGZgSFudO7O.jpg','0909029295','2025-04-17','male','Bahir dar\r\nBahir dar,Ethiopia','2025-04-03 22:03:38','2025-04-03 22:03:38',5),
(70,'sysgurage@gmail.com','$2y$12$P0tJW48W4Yvrj8dy2CR2Ze88dOcYEP6jZ5q.VTIdZw6QMe7CSvHG2',1,'Randy','Bartoletti','your.email+fakedata93660@gmail.com','user_images/zgfjKAUquBa7aMapDzTSyzmVuwgP7J2GyIbeK6E1.jpg','766-369-0337','2025-04-11','female','Bahir Dar, Amhara-Mirab Gojam','2025-04-04 20:27:29','2025-04-04 20:27:52',2),
(71,'displine@gmail.com','$2y$12$6UqFp.iaxbHdwZyjSuntOOY10t6u1BJKpN3Jt8d0p9A2Z436jzErO',11,'Chadrick','Hodkiewicz','your.email+fakedata54427@gmail.com','user_images/jyAVWE5oTXquKodoFsl1JqWEsuGoyjBn0xZSAC23.png','490-310-8342','2024-10-18','female','589 Janae Ferry','2025-04-04 20:48:13','2025-04-04 20:48:13',5),
(72,'securityyoff@gmail.com','$2y$12$CuDI9EsNHQ6oE.Kl2PTY0e2a6vgmUBlHRkv48aoipi7t.2mFqw2au',10,'Carter','Smith','kafogawa@mailinator.com','user_images/MPJjz3OfiUgbJMH5LY6oqOyfY7BGmCWX9989V8b3.png','+1 (566) 758-1614','2005-03-19','female','Numquam duis nostrud','2025-04-04 21:04:53','2025-04-04 21:04:53',5),
(73,'medicalforkem@gmail.com','$2y$12$kaK9e2fReQ51DAqqiCbmuuZeBXx9gTdwkI2U7/D/PmgLvRvhdlQyi',9,'Yuri','Logan','nafebybi@mailinator.com','user_images/rjJiUtfjBP1fLG9wJX0cpW6xtUg4Rt5d5Zd3GIbf.jpg','+1 (461) 548-2899','2000-04-30','male','Voluptatem aspernat','2025-04-04 21:16:54','2025-04-04 21:16:54',5),
(74,'tr@gmail.com','$2y$12$miJ68fPKhS7LLZP2ZKthSuxb3ip8TQi1.Hmljq.PDiJ0DM9gju64W',6,'Ronan','Briggs','meguk@mailinator.com','user_images/pV4F6LAXd1ppXrvQ6icYSynlMtL6kjsca6YiNuDI.jpg','+1 (128) 264-6554','1986-11-06','male','Dolor et eum est re','2025-04-04 21:20:34','2025-04-04 21:31:15',5),
(75,'Angelita Corwin','$2y$12$hjkbh3HLpjK0fWEnigiO1.ifF5WbkCTR7SW237AEjpjHk.ygR04QK',8,'Rogelio','Hansen','your.email+fakedata33587@gmail.com','user_images/naR0KGnKVHjHvqtPSKmJjPDHNmxckbZw6aPud60H.jpg','995-867-0637','2025-09-28','male','888 Rubye Ramp','2025-04-06 20:00:23','2025-04-06 20:00:23',5),
(78,'systemadminworabe@gmail.com','$2y$12$6QUy.LOHqum/Fb/xbYkmX.gIHD.ylPAYNxoutW8ypcoiJfrjm60B6',1,'ato bewlset','chane','systemadminworabe@gmail.com','user_images/CbDfHUKIiZ4YD1D4vtFL9v9bOIMfhs9VWteO5Aop.jpg','0943392332','2025-04-25','male','Dire Dawa','2025-04-26 14:00:17','2025-04-26 14:00:17',6),
(79,'secorabe@gmail.com','$2y$12$nctLD1ThzYgCmiYG/nR0A.z2vo2U62miOUH.JzWZ.H/6qW16JJGrq',10,'tameru','belw','securityworabe@gmail.com','user_images/9SvIqPv8nNXZUw74LWgdkJ8IvxomxzbiVvl7ncRf.jpg','0909029295','2025-04-26','male','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','2025-04-26 14:02:50','2025-05-17 01:42:55',6),
(80,'commissiner','$2y$12$jq3u7RDG9UJAvzwsKok6Q.KlXZBhDbxiKEOpSxsEsarGwspaFpP.u',5,'Christophe','Colesdkadklfasdklfa','commisiner+fakedata84879@gmail.com','user_images/Tq7wKUIyxQwVjWLwo3wM969FfUsgNvVNhHSZcb0W.jpg','232-783-8428','2024-12-20','male','64984 Romaguera Circles','2025-05-02 00:28:22','2025-05-17 01:43:10',6),
(81,'worabetraining@gmail.com','$2y$12$t8Ln4Ijp2PjLIdjpXhW..uxzMLk0twiTlYAngYtVWd1nN6RdI7.pa',6,'Eleanore','Walkersdas','worabetraining@gmail.com','user_images/WB0r0toyoB5GU5aM3Jl18QXT0XH8Wf4gRHdCqmiR.jpg','214-897-9582','2026-01-11','male','492 Lebsack Mewscc','2025-05-10 02:17:35','2025-05-17 01:42:44',6),
(82,'medicalorabe@gmail.com','$2y$12$mKt.//RGFQFjddR7KHAQouwNgSvBURt6IaCgRXv9F.tVSs1RfJPt2',9,'Immanuel','Keeling','medicalorabe@gmail.com','user_images/708XEIg77Y6wYxJ7a1qpoZ4BwURcY1XAYaM3jCYH.jpg','739-988-3976','2025-02-28','male','4964 Shea Fall','2025-05-12 02:27:18','2025-05-17 01:39:47',22),
(85,'policeworabe','$2y$12$jeQM99PuVNVkE3Inkwa9cOt6tWmWitc6eDzGFdFNozlir0PaFQURu',8,'Demond','Nienow','policeworabe@gmail.com','user_images/BUJb8kSr74MuN4EcstkF9PUSh55aSEGCsBDOwc0Z.jpg','811-200-3204','2025-07-15','female','54968 Woodrow Harbor','2025-05-21 16:10:27','2025-05-21 16:10:27',6),
(86,'displineworabe@gmail.com','$2y$12$RORuxi8KpzQti5CDhJNRveWY0/41BM9EKelluOOTl6ihm./Ywkgva',11,'Jacques','Fritsch','displineworabe@gmail.com','user_images/uuSZUPtsZw964rBl4lhQ6mXTduQBThbzpCZVYHOh.jpg','365-497-7473','2025-12-16','female','2744 Flatley Burgs','2025-05-21 16:24:41','2025-05-21 16:24:41',6),
(87,'sys@gmail.com','$2y$12$0/65t6Qf.Fk7wG3/hVxFDOMC8I1diu4cPtghyYakrLGM70CvekaH.',1,'Leonor','Schiller','your.email+fakedata83577@gmail.com','user_images/k0EdF6pWzY99n28EMP5rYnryDJR9OGd9mW93aoXp.jpg','488-505-6262','2025-07-13','female','Bahir Dar, Amhara-Mirab Gojam','2025-05-22 05:08:46','2025-05-22 05:08:46',6);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_type` varchar(100) NOT NULL COMMENT 'Type of activity (e.g., create_backup, assign_job, schedule_appointment)',
  `table_name` varchar(50) NOT NULL COMMENT 'Name of the table affected (e.g., backups, job_assignments)',
  `record_id` int(11) NOT NULL COMMENT 'ID of the affected record in the respective table',
  `user_id` int(11) DEFAULT NULL COMMENT 'User who performed the action',
  `prisoner_id` int(11) DEFAULT NULL COMMENT 'Prisoner associated with the action, if applicable',
  `lawyer_id` int(11) DEFAULT NULL COMMENT 'Lawyer associated with the action, if applicable',
  `prison_id` int(11) DEFAULT NULL COMMENT 'Prison associated with the action',
  `activity_details` text DEFAULT NULL COMMENT 'Additional details about the activity',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `prisoner_id` (`prisoner_id`),
  KEY `lawyer_id` (`lawyer_id`),
  KEY `prison_id` (`prison_id`),
  CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `activity_log_ibfk_2` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `activity_log_ibfk_3` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`lawyer_id`),
  CONSTRAINT `activity_log_ibfk_4` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `auditable_type` varchar(255) NOT NULL,
  `old_values` text DEFAULT NULL,
  `new_values` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(1023) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auditable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
INSERT INTO `audits` VALUES
(1,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"id\":232,\"name\":\"ss\",\"description\":\"sss\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/232','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:41:55','2025-05-10 03:41:55',NULL),
(2,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"id\":233,\"name\":\"ss\",\"description\":\"ss\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/233','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:43:00','2025-05-10 03:43:00',NULL),
(3,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"id\":231,\"name\":\"ss\",\"description\":\"sss\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/231','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:43:03','2025-05-10 03:43:03',NULL),
(4,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"id\":230,\"name\":\"ss\",\"description\":\"sss\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/230','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:43:05','2025-05-10 03:43:05',NULL),
(5,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"name\":\"Habtamu Gashu\",\"description\":\"zz\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/235','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:50:11','2025-05-10 03:50:11',NULL),
(6,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"name\":\"ss\",\"description\":\"ss\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/237','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:50:24','2025-05-10 03:50:24',NULL),
(7,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"name\":\"ss\",\"description\":\"ss\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/236','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:50:32','2025-05-10 03:50:32',NULL),
(8,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"id\":234,\"name\":\"jj\",\"description\":\"jj\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/234','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:50:47','2025-05-10 03:50:47',NULL),
(9,NULL,NULL,'deleted','App\\Models\\TrainingProgram','{\"id\":229,\"name\":\"vocal test\",\"description\":\"sakdfaskdfaskdfaskd\",\"created_by\":81,\"prison_id\":6}','[]','http://127.0.0.1:8000/training_officer/229','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 03:51:14','2025-05-10 03:51:14',NULL),
(10,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 18:42:12','2025-05-10 18:42:12',NULL),
(11,NULL,NULL,'deleted','App\\Models\\JobAssignment','{\"id\":134,\"prisoner_id\":337,\"assigned_by\":81,\"job_title\":\"Gardener\",\"job_description\":\"asas\",\"assigned_date\":\"2025-05-09\",\"end_date\":\"0000-00-00\",\"status\":\"active\"}','[]','http://127.0.0.1:8000/jobs/134','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 19:04:47','2025-05-10 19:04:47',134),
(12,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"342\",\"assigned_by\":81,\"job_title\":\"Cook\",\"assigned_date\":\"2025-05-10 00:00:00\",\"end_date\":\"2025-05-10 00:00:00\",\"status\":\"active\",\"job_description\":\"ss\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 19:08:25','2025-05-10 19:08:25',NULL),
(13,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"339\",\"assigned_by\":81,\"job_title\":\"Cleaner\",\"assigned_date\":\"2025-05-10 00:00:00\",\"end_date\":\"2025-05-17 00:00:00\",\"status\":\"active\",\"job_description\":\",,,\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 19:11:31','2025-05-10 19:11:31',NULL),
(14,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":78,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 20:11:42','2025-05-10 20:11:42',NULL),
(15,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-10 20:11:42','2025-05-10 20:11:42',NULL),
(16,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"prison_id\":4,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 00:55:23','2025-05-11 00:55:23',NULL),
(17,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 00:55:23','2025-05-11 00:55:23',NULL),
(18,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"prison_id\":4,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 00:55:34','2025-05-11 00:55:34',NULL),
(19,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 00:55:35','2025-05-11 00:55:35',NULL),
(20,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 00:59:09','2025-05-11 00:59:09',NULL),
(21,NULL,NULL,'deleted','App\\Models\\JobAssignment','{\"id\":135,\"prisoner_id\":342,\"assigned_by\":81,\"job_title\":\"Cook\",\"job_description\":\"ss\",\"assigned_date\":\"2025-05-10\",\"end_date\":\"2025-05-10\",\"status\":\"active\"}','[]','http://127.0.0.1:8000/jobs/135','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 03:34:42','2025-05-11 03:34:42',135),
(22,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"344\",\"assigned_by\":74,\"job_title\":\"Gardener\",\"assigned_date\":\"2025-05-12 00:00:00\",\"end_date\":\"2025-05-20 00:00:00\",\"status\":\"completed\",\"job_description\":\"fsfsdfg\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 18:39:13','2025-05-11 18:39:13',NULL),
(23,NULL,NULL,'deleted','App\\Models\\JobAssignment','{\"id\":138,\"prisoner_id\":344,\"assigned_by\":74,\"job_title\":\"Gardener\",\"job_description\":\"fsfsdfg\",\"assigned_date\":\"2025-05-12\",\"end_date\":\"2025-05-20\",\"status\":\"completed\"}','[]','http://127.0.0.1:8000/jobs/138','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 18:40:50','2025-05-11 18:40:50',138),
(24,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"1\",\"assigned_by\":74,\"job_title\":\"Cleaner\",\"assigned_date\":\"2025-05-14 00:00:00\",\"end_date\":\"2025-05-29 00:00:00\",\"status\":\"completed\",\"job_description\":\"rr\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 18:52:28','2025-05-11 18:52:28',NULL),
(25,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 18:56:54','2025-05-11 18:56:54',NULL),
(26,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 19:50:10','2025-05-11 19:50:10',NULL),
(27,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-10\",\"status\":\"completed\"}','{\"assigned_date\":\"2025-05-09 00:00:00\",\"status\":\"active\"}','http://127.0.0.1:8000/jobs/136','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 20:36:32','2025-05-11 20:36:32',136),
(28,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"job_description\":\"DFGDG\",\"assigned_date\":\"2025-05-08\"}','{\"job_description\":\"rrrr\",\"assigned_date\":\"2025-05-12 00:00:00\"}','http://127.0.0.1:8000/jobs/137','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 20:37:12','2025-05-11 20:37:12',137),
(29,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"status\":\"completed\"}','{\"status\":\"terminated\"}','http://127.0.0.1:8000/jobs/137','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 20:38:14','2025-05-11 20:38:14',137),
(30,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-12\",\"status\":\"terminated\"}','{\"assigned_date\":\"2025-04-12 00:00:00\",\"status\":\"active\"}','http://127.0.0.1:8000/jobs/137','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-11 22:05:28','2025-05-11 22:05:28',137),
(31,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-14\",\"status\":\"active\"}','{\"assigned_date\":\"2025-05-05 00:00:00\",\"status\":\"completed\"}','http://127.0.0.1:8000/jobs/139','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-12 00:53:49','2025-05-12 00:53:49',139),
(32,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-12 01:01:17','2025-05-12 01:01:17',NULL),
(33,NULL,NULL,'created','App\\Models\\Account','[]','{\"username\":\"medicalorabe@gmail.com\",\"password\":\"$2y$12$mKt.\\/\\/RGFQFjddR7KHAQouwNgSvBURt6IaCgRXv9F.tVSs1RfJPt2\",\"role_id\":\"9\",\"prison_id\":\"6\",\"first_name\":\"Immanuel\",\"last_name\":\"Keeling\",\"email\":\"medicalorabe@gmail.com\",\"phone_number\":\"739-988-3976\",\"dob\":\"2025-02-28 00:00:00\",\"gender\":\"Female\",\"address\":\"4964 Shea Fall\",\"user_image\":\"user_images\\/708XEIg77Y6wYxJ7a1qpoZ4BwURcY1XAYaM3jCYH.jpg\"}','http://127.0.0.1:8000/accounts','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-12 02:27:18','2025-05-12 02:27:18',NULL),
(34,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-09\"}','{\"assigned_date\":\"2025-05-12 00:00:00\"}','http://127.0.0.1:8000/jobs/136','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-12 04:59:37','2025-05-12 04:59:37',136),
(35,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 00:58:59','2025-05-16 00:58:59',NULL),
(36,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":78,\"prison_id\":6,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:01:56','2025-05-16 01:01:56',NULL),
(37,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:01:56','2025-05-16 01:01:56',NULL),
(38,NULL,NULL,'created','App\\Models\\Lawyer','[]','{\"first_name\":\"Shanie\",\"last_name\":\"Runolfsdottir\",\"date_of_birth\":\"2024-07-26\",\"contact_info\":\"556\",\"email\":\"your.email+fakedata14685@gmail.com\",\"password\":\"$2y$12$O1ZlS8mqNcETO4BlOE60Tuy3P0F.hoxCcxLFWwPM.heeDjZPT9k8q\",\"law_firm\":\"Georgianna\",\"license_number\":\"456\",\"cases_handled\":\"66\",\"prison\":\"6\",\"profile_image\":\"lawyer_profiles\\/xiqCihHgRj1J3QTpwnlOvQ6ZkD4GxF1IaI2b0SO7.jpg\",\"lawyer_id\":48}','http://127.0.0.1:8000/lawyerstore','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:04:34','2025-05-16 01:04:34',48),
(39,NULL,NULL,'updated','App\\Models\\Lawyer','{\"last_name\":\"Runolfsdottir\"}','{\"last_name\":\"Runx\"}','http://127.0.0.1:8000/lawyers/48','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:04:54','2025-05-16 01:04:54',48),
(40,NULL,NULL,'deleted','App\\Models\\Lawyer','{\"lawyer_id\":48,\"first_name\":\"Shanie\",\"last_name\":\"Runx\",\"date_of_birth\":\"2024-07-26\",\"contact_info\":\"556\",\"email\":\"your.email+fakedata14685@gmail.com\",\"password\":\"$2y$12$O1ZlS8mqNcETO4BlOE60Tuy3P0F.hoxCcxLFWwPM.heeDjZPT9k8q\",\"law_firm\":\"Georgianna\",\"license_number\":\"456\",\"cases_handled\":66,\"prison\":6,\"profile_image\":\"lawyer_profiles\\/xiqCihHgRj1J3QTpwnlOvQ6ZkD4GxF1IaI2b0SO7.jpg\"}','[]','http://127.0.0.1:8000/lawyers/48','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:05:15','2025-05-16 01:05:15',48),
(41,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-05\"}','{\"assigned_date\":\"2025-05-15 00:00:00\"}','http://127.0.0.1:8000/jobs/139','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:51:57','2025-05-16 01:51:57',139),
(42,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-15\",\"status\":\"completed\"}','{\"assigned_date\":\"2025-05-17 00:00:00\",\"status\":\"active\"}','http://127.0.0.1:8000/jobs/139','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:52:07','2025-05-16 01:52:07',139),
(43,NULL,NULL,'deleted','App\\Models\\JobAssignment','{\"id\":139,\"prisoner_id\":1,\"assigned_by\":74,\"job_title\":\"Cleaner\",\"job_description\":\"rr\",\"assigned_date\":\"2025-05-17\",\"end_date\":\"2025-05-29\",\"status\":\"active\"}','[]','http://127.0.0.1:8000/jobs/139','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-16 01:52:11','2025-05-16 01:52:11',139),
(44,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"male\"}','{\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/76','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:28:27','2025-05-17 01:28:27',76),
(45,NULL,NULL,'updated','App\\Models\\Account','{\"last_name\":\"Oneill\",\"gender\":\"male\"}','{\"last_name\":\"sasOneill\",\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/76','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:28:42','2025-05-17 01:28:42',76),
(46,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"male\",\"address\":\"Bahir dar\\r\\nBahir dar,Ethiopia\"}','{\"gender\":\"Male\",\"address\":\"Bahir dar\\nBahir dar,Ethiopia\"}','http://127.0.0.1:8000/saccount/63','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:29:28','2025-05-17 01:29:28',63),
(47,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"male\"}','{\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/63','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:34:43','2025-05-17 01:34:43',63),
(48,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"male\"}','{\"gender\":\"Female\"}','http://127.0.0.1:8000/saccount/63','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:39:10','2025-05-17 01:39:10',63),
(49,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"female\",\"prison_id\":6}','{\"gender\":\"Male\",\"prison_id\":\"22\"}','http://127.0.0.1:8000/saccount/82','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:39:47','2025-05-17 01:39:47',82),
(50,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"female\",\"address\":\"492 Lebsack Mews\"}','{\"gender\":\"Female\",\"address\":\"492 Lebsack Mewscc\"}','http://127.0.0.1:8000/saccount/81','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:42:25','2025-05-17 01:42:25',81),
(51,NULL,NULL,'updated','App\\Models\\Account','{\"last_name\":\"Walker\",\"gender\":\"female\"}','{\"last_name\":\"Walkersdas\",\"gender\":\"Female\"}','http://127.0.0.1:8000/saccount/81','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:42:35','2025-05-17 01:42:35',81),
(52,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"female\"}','{\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/81','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:42:44','2025-05-17 01:42:44',81),
(53,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"male\"}','{\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/79','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:42:55','2025-05-17 01:42:55',79),
(54,NULL,NULL,'updated','App\\Models\\Account','{\"last_name\":\"Cole\",\"gender\":\"male\"}','{\"last_name\":\"Colesdkadklfasdklfa\",\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/80','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:43:10','2025-05-17 01:43:10',80),
(55,NULL,NULL,'deleted','App\\Models\\Account','{\"user_id\":76,\"username\":\"facirewyn\",\"password\":\"$2y$12$akCSTUVe.uk9rXqhqgSgGuubzeeVYaRFo8ZxRc.7AGMl8RQMbzklW\",\"role_id\":8,\"first_name\":\"Elaine\",\"last_name\":\"sasOneill\",\"email\":\"giwarexy@mailinator.com\",\"user_image\":\"user_images\\/kklHWy7DCtgLMLmI6O5dLuzzVBgcwyCexfNWcw2C.jpg\",\"phone_number\":\"+1 (775) 637-2108\",\"dob\":\"1993-12-20\",\"gender\":\"male\",\"address\":\"Dignissimos dolor do\",\"prison_id\":6}','[]','http://127.0.0.1:8000/saccount/76','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:43:17','2025-05-17 01:43:17',76),
(56,NULL,NULL,'updated','App\\Models\\Account','{\"last_name\":\"Gashu\",\"gender\":\"female\"}','{\"last_name\":\"Gashudasd\",\"gender\":\"Female\"}','http://127.0.0.1:8000/saccount/63','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:44:10','2025-05-17 01:44:10',63),
(57,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":78,\"prison_id\":6,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:44:51','2025-05-17 01:44:51',NULL),
(58,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 01:44:51','2025-05-17 01:44:51',NULL),
(59,NULL,NULL,'deleted','App\\Models\\Lawyer','{\"lawyer_id\":47,\"first_name\":\"worabelaww\",\"last_name\":\"Gashu\",\"date_of_birth\":\"2025-04-23\",\"contact_info\":\"0909029295\",\"email\":\"lawworabe@gmail.com\",\"password\":\"$2y$12$QudpI9RBp4BKf97Nyphfa.QOC.dO7VOs9FcEg6Uy2DZhlq30GcHdW\",\"law_firm\":\"12342277044s\",\"license_number\":\"s0s12127700000\",\"cases_handled\":12,\"prison\":6,\"profile_image\":\"lawyer_profiles\\/U36OKZmNlnoIO5ovm2RYURbUB9OJSKyUKKPXKBO3.jpg\"}','[]','http://127.0.0.1:8000/lawyers/47','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-17 03:31:59','2025-05-17 03:31:59',47),
(60,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"female\"}','{\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/63','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-20 05:58:42','2025-05-20 05:58:42',63),
(61,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"1\",\"assigned_by\":81,\"job_title\":\"Gardener\",\"assigned_date\":\"2025-05-20 00:00:00\",\"end_date\":\"2025-05-29 00:00:00\",\"status\":\"active\",\"job_description\":\"klk\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-21 04:55:02','2025-05-21 04:55:02',NULL),
(62,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"337\",\"assigned_by\":81,\"job_title\":\"Gardener\",\"assigned_date\":\"2025-05-22 00:00:00\",\"end_date\":\"2025-05-30 00:00:00\",\"status\":\"active\",\"job_description\":\"ccc\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-21 16:03:45','2025-05-21 16:03:45',NULL),
(63,NULL,NULL,'created','App\\Models\\Account','[]','{\"username\":\"policeworabe\",\"password\":\"$2y$12$jeQM99PuVNVkE3Inkwa9cOt6tWmWitc6eDzGFdFNozlir0PaFQURu\",\"role_id\":\"8\",\"prison_id\":\"6\",\"first_name\":\"Demond\",\"last_name\":\"Nienow\",\"email\":\"policeworabe@gmail.com\",\"phone_number\":\"811-200-3204\",\"dob\":\"2025-07-15 00:00:00\",\"gender\":\"Female\",\"address\":\"54968 Woodrow Harbor\",\"user_image\":\"user_images\\/BUJb8kSr74MuN4EcstkF9PUSh55aSEGCsBDOwc0Z.jpg\"}','http://127.0.0.1:8000/accounts','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-21 16:10:27','2025-05-21 16:10:27',NULL),
(64,NULL,NULL,'created','App\\Models\\Account','[]','{\"username\":\"displineworabe@gmail.com\",\"password\":\"$2y$12$RORuxi8KpzQti5CDhJNRveWY0\\/41BM9EKelluOOTl6ihm.\\/Ywkgva\",\"role_id\":\"11\",\"prison_id\":\"6\",\"first_name\":\"Jacques\",\"last_name\":\"Fritsch\",\"email\":\"displineworabe@gmail.com\",\"phone_number\":\"365-497-7473\",\"dob\":\"2025-12-16 00:00:00\",\"gender\":\"Female\",\"address\":\"2744 Flatley Burgs\",\"user_image\":\"user_images\\/uuSZUPtsZw964rBl4lhQ6mXTduQBThbzpCZVYHOh.jpg\"}','http://127.0.0.1:8000/accounts','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-21 16:24:41','2025-05-21 16:24:41',NULL),
(65,NULL,NULL,'created','App\\Models\\Account','[]','{\"username\":\"sys@gmail.com\",\"password\":\"$2y$12$0\\/65t6Qf.Fk7wG3\\/hVxFDOMC8I1diu4cPtghyYakrLGM70CvekaH.\",\"role_id\":\"1\",\"prison_id\":\"6\",\"first_name\":\"Leonor\",\"last_name\":\"Schiller\",\"email\":\"your.email+fakedata83577@gmail.com\",\"phone_number\":\"488-505-6262\",\"dob\":\"2025-07-13 00:00:00\",\"gender\":\"Female\",\"address\":\"Bahir Dar, Amhara-Mirab Gojam\",\"user_image\":\"user_images\\/k0EdF6pWzY99n28EMP5rYnryDJR9OGd9mW93aoXp.jpg\"}','http://127.0.0.1:8000/accounts','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-22 05:08:46','2025-05-22 05:08:46',NULL),
(66,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2024-12-23 08:17:44','2024-12-23 08:17:44',NULL),
(67,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"338\",\"assigned_by\":81,\"job_title\":\"Gardener\",\"assigned_date\":\"2025-05-11 00:00:00\",\"end_date\":\"2025-05-23 00:00:00\",\"status\":\"active\",\"job_description\":\"q\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-25 12:14:58','2025-05-25 12:14:58',NULL),
(68,NULL,NULL,'created','App\\Models\\JobAssignment','[]','{\"prisoner_id\":\"340\",\"assigned_by\":81,\"job_title\":\"Cook\",\"assigned_date\":\"2025-05-22 00:00:00\",\"end_date\":\"2025-05-31 00:00:00\",\"status\":\"active\",\"job_description\":\"afkasd\"}','http://127.0.0.1:8000/assignJob','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-25 20:06:42','2025-05-25 20:06:42',NULL),
(69,NULL,NULL,'updated','App\\Models\\Account','{\"gender\":\"male\"}','{\"gender\":\"Male\"}','http://127.0.0.1:8000/saccount/63','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 02:19:17','2025-05-26 02:19:17',63),
(70,NULL,NULL,'updated','App\\Models\\Lawyer','{\"first_name\":\"Habtamu\",\"last_name\":\"Gashu\"}','{\"first_name\":\"biruk\",\"last_name\":\"mereta\"}','http://127.0.0.1:8000/lawyers/43','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 02:29:33','2025-05-26 02:29:33',43),
(71,NULL,NULL,'created','App\\Models\\Account','[]','{\"username\":\"sys\",\"password\":\"$2y$12$0mwXMotQOhqLpVIZRluy5up1DMKWmq7HIsHoz2unzjl1HL2Tuh1\\/a\",\"role_id\":\"1\",\"prison_id\":\"20\",\"first_name\":\"Payton\",\"last_name\":\"Erdman\",\"email\":\"your.email+fakedata74469@gmail.com\",\"phone_number\":\"843-256-2905\",\"dob\":\"2026-04-12 00:00:00\",\"gender\":\"Female\",\"address\":\"Gonder\",\"user_image\":\"user_images\\/SJ13gqodF2sGmjpTa9wLelOUNEYKti8SXOawZ6QB.jpg\"}','http://127.0.0.1:8000/accounts','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 19:51:25','2025-05-26 19:51:25',NULL),
(72,NULL,NULL,'deleted','App\\Models\\Account','{\"user_id\":88,\"username\":\"sys\",\"password\":\"$2y$12$0mwXMotQOhqLpVIZRluy5up1DMKWmq7HIsHoz2unzjl1HL2Tuh1\\/a\",\"role_id\":1,\"first_name\":\"Payton\",\"last_name\":\"Erdman\",\"email\":\"your.email+fakedata74469@gmail.com\",\"user_image\":\"user_images\\/SJ13gqodF2sGmjpTa9wLelOUNEYKti8SXOawZ6QB.jpg\",\"phone_number\":\"843-256-2905\",\"dob\":\"2026-04-12\",\"gender\":\"female\",\"address\":\"Gonder\",\"prison_id\":20}','[]','http://127.0.0.1:8000/caccount/88','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 19:59:24','2025-05-26 19:59:24',88),
(73,NULL,NULL,'deleted','App\\Models\\Account','{\"user_id\":77,\"username\":\"lol\",\"password\":\"$2y$12$vo82.5Z5Ko9coM.6i2pcp.YcGqgNR3hqT17mowHao3Yo4kuWdyN\\/q\",\"role_id\":4,\"first_name\":\"SOME ONE\",\"last_name\":\"SOME\",\"email\":\"hab@gmail.com\",\"user_image\":null,\"phone_number\":\"121221212\",\"dob\":\"2025-04-03\",\"gender\":\"male\",\"address\":\"dasdsfasdf\",\"prison_id\":20}','[]','http://127.0.0.1:8000/caccount/77','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 20:01:47','2025-05-26 20:01:47',77),
(74,NULL,NULL,'deleted','App\\Models\\Account','{\"user_id\":69,\"username\":\"systemSSSSmm@gmail.com\",\"password\":\"$2y$12$dei8dFyl2yDkQ\\/OnIS\\/bwO6Z\\/aA1pkndabg4YtX4uIP0qmV6QmD1a\",\"role_id\":5,\"first_name\":\"Habtamu\",\"last_name\":\"Gashu\",\"email\":\"Habtsha202SSSS1@gmail.com\",\"user_image\":\"user_images\\/YSxTn75RTo0KsWmLJz12bfyI8olpopPbvDONx8a2.jpg\",\"phone_number\":\"0909029295\",\"dob\":\"2025-04-09\",\"gender\":\"female\",\"address\":\"Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam\",\"prison_id\":5}','[]','http://127.0.0.1:8000/caccount/69','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 20:02:15','2025-05-26 20:02:15',69),
(75,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":12,\"backup_status\":\"completed\"}','http://127.0.0.1:8000/initiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 20:49:31','2025-05-26 20:49:31',NULL),
(76,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":78,\"prison_id\":6,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 21:36:29','2025-05-26 21:36:29',NULL),
(77,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 21:36:29','2025-05-26 21:36:29',NULL),
(78,NULL,NULL,'updated','App\\Models\\JobAssignment','{\"assigned_date\":\"2025-05-20\"}','{\"assigned_date\":\"2025-05-21 00:00:00\"}','http://127.0.0.1:8000/jobs/140','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-26 23:23:44','2025-05-26 23:23:44',140),
(79,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":78,\"prison_id\":6,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-27 03:26:26','2025-05-27 03:26:26',NULL),
(80,NULL,NULL,'updated','App\\Models\\Backup','{\"backup_status\":\"in_progress\"}','{\"backup_status\":\"completed\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-27 03:26:26','2025-05-27 03:26:26',NULL),
(81,NULL,NULL,'created','App\\Models\\Backup','[]','{\"initiated_by\":78,\"prison_id\":6,\"backup_status\":\"in_progress\"}','http://127.0.0.1:8000/sinitiate_backup','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',NULL,'2025-05-27 03:26:59','2025-05-27 03:26:59',NULL);
/*!40000 ALTER TABLE `audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initiated_by` int(11) DEFAULT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `backup_status` enum('in_progress','completed','failed') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_backups_user` (`initiated_by`),
  KEY `fk_rbackups_prison_id` (`prison_id`),
  CONSTRAINT `backups_ibfk_1` FOREIGN KEY (`initiated_by`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `fk_backups_user` FOREIGN KEY (`initiated_by`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rbackups_prison_id` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
INSERT INTO `backups` VALUES
(1,14,'2025-05-10 20:36:05','completed','0000-00-00 00:00:00','0000-00-00 00:00:00',6),
(2,12,'2025-05-09 00:01:06','in_progress','2025-05-09 04:01:06','2025-05-09 04:01:06',NULL),
(3,12,'2025-05-09 00:02:02','completed','2025-05-09 04:02:02','2025-05-09 04:02:02',NULL),
(4,12,'2025-05-09 15:24:52','completed','2025-05-09 19:24:52','2025-05-09 19:24:52',NULL),
(5,12,'2025-05-09 15:52:12','completed','2025-05-09 19:52:12','2025-05-09 19:52:12',NULL),
(6,12,'2025-05-09 15:57:41','completed','2025-05-09 19:57:41','2025-05-09 19:57:41',NULL),
(7,12,'2025-05-09 15:58:00','completed','2025-05-09 19:58:00','2025-05-09 19:58:00',NULL),
(8,12,'2025-05-09 15:58:06','completed','2025-05-09 19:58:06','2025-05-09 19:58:06',NULL),
(9,12,'2025-05-09 15:58:28','completed','2025-05-09 19:58:28','2025-05-09 19:58:28',NULL),
(10,12,'2025-05-09 16:00:54','completed','2025-05-09 20:00:54','2025-05-09 20:00:54',NULL),
(11,12,'2025-05-09 16:09:09','completed','2025-05-09 20:09:09','2025-05-09 20:09:09',NULL),
(12,12,'2025-05-10 14:23:22','completed','2025-05-10 18:23:22','2025-05-10 18:23:22',NULL),
(13,12,'2025-05-10 14:38:45','completed','2025-05-10 18:38:45','2025-05-10 18:38:45',NULL),
(14,12,'2025-05-10 14:38:48','completed','2025-05-10 18:38:48','2025-05-10 18:38:48',NULL),
(15,12,'2025-05-10 14:39:53','completed','2025-05-10 18:39:53','2025-05-10 18:39:53',NULL),
(16,12,'2025-05-10 14:41:35','completed','2025-05-10 18:41:35','2025-05-10 18:41:35',NULL),
(17,12,'2025-05-10 14:42:12','completed','2025-05-10 18:42:12','2025-05-10 18:42:12',NULL),
(18,78,'2025-05-10 16:11:42','in_progress','2025-05-10 20:11:42','2025-05-10 20:11:42',NULL),
(19,12,'2025-05-10 20:55:23','in_progress','2025-05-11 00:55:23','2025-05-11 00:55:23',4),
(20,12,'2025-05-10 20:55:34','in_progress','2025-05-11 00:55:34','2025-05-11 00:55:34',4),
(21,12,'2025-05-10 20:59:09','completed','2025-05-11 00:59:09','2025-05-11 00:59:09',NULL),
(22,12,'2025-05-11 14:56:54','completed','2025-05-11 18:56:54','2025-05-11 18:56:54',NULL),
(23,12,'2025-05-11 15:50:10','completed','2025-05-11 19:50:10','2025-05-11 19:50:10',NULL),
(24,12,'2025-05-11 21:01:17','completed','2025-05-12 01:01:17','2025-05-12 01:01:17',NULL),
(25,12,'2025-05-15 20:58:59','completed','2025-05-16 00:58:59','2025-05-16 00:58:59',NULL),
(26,78,'2025-05-15 21:01:56','in_progress','2025-05-16 01:01:56','2025-05-16 01:01:56',6),
(27,78,'2025-05-16 21:44:51','in_progress','2025-05-17 01:44:51','2025-05-17 01:44:51',6),
(28,12,'2024-12-23 03:17:44','completed','2024-12-23 08:17:44','2024-12-23 08:17:44',NULL),
(29,12,'2025-05-26 16:49:31','completed','2025-05-26 20:49:31','2025-05-26 20:49:31',NULL),
(30,78,'2025-05-26 17:36:29','in_progress','2025-05-26 21:36:29','2025-05-26 21:36:29',6),
(31,78,'2025-05-26 23:26:26','in_progress','2025-05-27 03:26:26','2025-05-27 03:26:26',6),
(32,78,'2025-05-26 23:26:59','in_progress','2025-05-27 03:26:59','2025-05-27 03:26:59',6);
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
-- Table structure for table `certification_records`
--

DROP TABLE IF EXISTS `certification_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `certification_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) DEFAULT NULL,
  `issued_by` int(11) DEFAULT NULL,
  `certification_type` enum('job_completion','training_program_completion') DEFAULT NULL,
  `certification_details` text DEFAULT NULL,
  `issued_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('issued','revoked') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_certification_records_prisoner` (`prisoner_id`),
  KEY `fk_certification_records_issued_by` (`issued_by`),
  CONSTRAINT `certification_records_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `certification_records_ibfk_2` FOREIGN KEY (`issued_by`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `fk_certification_records_issued_by` FOREIGN KEY (`issued_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_certification_records_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certification_records`
--

LOCK TABLES `certification_records` WRITE;
/*!40000 ALTER TABLE `certification_records` DISABLE KEYS */;
INSERT INTO `certification_records` VALUES
(1,339,81,'training_program_completion','www','2025-05-10 04:00:00','issued','2025-05-11 02:15:31','2025-05-11 02:15:31'),
(2,342,81,'job_completion','sdsd','2025-05-13 04:00:00','issued','2025-05-11 02:23:58','2025-05-11 02:23:58'),
(3,342,81,'job_completion','sdsd','2025-05-13 04:00:00','issued','2025-05-11 02:27:47','2025-05-11 02:27:47'),
(4,342,81,'training_program_completion','aaa','2025-05-10 04:00:00','issued','2025-05-11 02:28:33','2025-05-11 02:28:33'),
(5,342,81,'training_program_completion','aaa','2025-05-10 04:00:00','issued','2025-05-11 02:31:14','2025-05-11 02:31:14'),
(6,339,81,'job_completion','sss','2025-05-29 04:00:00','issued','2025-05-11 02:37:00','2025-05-11 02:37:00'),
(7,342,81,'job_completion','tfrtrt','2025-05-07 04:00:00','issued','2025-05-11 02:41:48','2025-05-11 02:41:48'),
(8,342,81,'job_completion','tfrtrt','2025-05-07 04:00:00','issued','2025-05-11 02:42:35','2025-05-11 02:42:35'),
(9,339,81,'job_completion','thsi certefication','2025-05-07 04:00:00','issued','2025-05-11 02:43:42','2025-05-11 02:43:42'),
(10,339,81,'job_completion','afsdfasdfasdfasdf','2025-05-10 04:00:00','issued','2025-05-11 02:47:46','2025-05-11 02:47:46'),
(11,339,81,'job_completion','afsdfasdfasdfasdf','2025-05-10 04:00:00','issued','2025-05-11 02:49:42','2025-05-11 02:49:42'),
(12,339,81,'training_program_completion','FSDFSAD','2025-05-16 04:00:00','issued','2025-05-11 03:18:06','2025-05-11 03:18:06'),
(13,339,81,'job_completion','HGH','2025-05-10 04:00:00','issued','2025-05-11 03:27:12','2025-05-11 03:27:12'),
(14,342,81,'job_completion','asas','2025-05-10 04:00:00','issued','2025-05-11 03:40:50','2025-05-11 03:40:50'),
(15,344,74,'job_completion','sds','2025-05-12 04:00:00','issued','2025-05-11 18:38:10','2025-05-11 18:38:10'),
(16,344,74,'training_program_completion','dfsdfdf','2025-05-14 04:00:00','issued','2025-05-11 18:39:40','2025-05-11 18:39:40'),
(17,1,74,'training_program_completion','xdadsdgafdgdsfg','2025-05-14 04:00:00','issued','2025-05-11 18:51:20','2025-05-11 18:51:20'),
(18,1,74,'job_completion','xdadsdgafdgdsfg','2025-05-14 04:00:00','issued','2025-05-11 18:51:43','2025-05-11 18:51:43'),
(19,1,74,'job_completion','ddsfa','2025-05-16 04:00:00','issued','2025-05-11 18:52:52','2025-05-11 18:52:52'),
(20,1,74,'job_completion','ddsfa','2025-05-16 04:00:00','issued','2025-05-11 18:53:55','2025-05-11 18:53:55'),
(21,1,74,'training_program_completion','dfshghjsfghsfghsfghsfg','2025-05-11 04:00:00','issued','2025-05-11 19:47:21','2025-05-11 19:47:21'),
(22,1,74,'job_completion','dfshghjsfghsfghsfghsfg','2025-05-11 04:00:00','issued','2025-05-11 19:48:05','2025-05-11 19:48:05'),
(23,1,74,'job_completion','test test','2025-05-31 04:00:00','issued','2025-05-11 21:58:34','2025-05-11 21:58:34'),
(24,1,74,'job_completion','testeeeeee','2025-05-28 04:00:00','issued','2025-05-11 21:59:25','2025-05-11 21:59:25'),
(25,1,74,'job_completion','frhjgkiuiu','2025-05-12 04:00:00','issued','2025-05-12 00:54:31','2025-05-12 00:54:31'),
(26,1,74,'job_completion','dsfgdfg','2025-05-12 04:00:00','issued','2025-05-12 03:25:01','2025-05-12 03:25:01'),
(27,1,74,'job_completion','dsfgdfg','2025-05-12 04:00:00','issued','2025-05-12 03:26:14','2025-05-12 03:26:14'),
(28,1,74,'training_program_completion','dfgdfdsf','2025-05-17 04:00:00','issued','2025-05-16 01:52:33','2025-05-16 01:52:33'),
(29,1,81,'job_completion','kk','2025-05-24 04:00:00','issued','2025-05-21 04:56:01','2025-05-21 04:56:01'),
(30,342,81,'training_program_completion','dsd','2025-05-22 04:00:00','issued','2025-05-21 16:03:00','2025-05-21 16:03:00'),
(31,340,81,'job_completion','qq','2025-05-30 04:00:00','issued','2025-05-25 12:15:27','2025-05-25 12:15:27'),
(32,340,81,'job_completion','qq','2025-05-30 04:00:00','issued','2025-05-25 12:16:12','2025-05-25 12:16:12');
/*!40000 ALTER TABLE `certification_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `job_assignments`
--

DROP TABLE IF EXISTS `job_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `assigned_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','completed','terminated') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_job_assignments_prisoner` (`prisoner_id`),
  KEY `fk_job_assignments_assigned_by` (`assigned_by`),
  CONSTRAINT `fk_job_assignments_assigned_by` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_job_assignments_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_assignments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `job_assignments_ibfk_2` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_assignments`
--

LOCK TABLES `job_assignments` WRITE;
/*!40000 ALTER TABLE `job_assignments` DISABLE KEYS */;
INSERT INTO `job_assignments` VALUES
(136,339,81,'Cleaner',',,,','2025-05-12','2025-05-17','active','2025-05-10 19:11:31','2025-05-12 04:59:37'),
(137,355,14,'GDFF','rrrr','2025-04-12','2025-05-23','active','2025-05-10 23:00:46','2025-05-11 22:05:28'),
(140,1,81,'Gardener','klk','2025-05-21','2025-05-29','active','2025-05-21 04:55:02','2025-05-26 23:23:44'),
(141,337,81,'Gardener','ccc','2025-05-22','2025-05-30','active','2025-05-21 16:03:45','2025-05-21 16:03:45'),
(142,338,81,'Gardener','q','2025-05-11','2025-05-23','active','2025-05-25 12:14:58','2025-05-25 12:14:58'),
(143,340,81,'Cook','afkasd','2025-05-22','2025-05-31','active','2025-05-25 20:06:42','2025-05-25 20:06:42');
/*!40000 ALTER TABLE `job_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
-- Table structure for table `lawyer_appointments`
--

DROP TABLE IF EXISTS `lawyer_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lawyer_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('scheduled','completed','cancelled') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lawyer_appointments_prisoner` (`prisoner_id`),
  KEY `fk_lawyer_appointments_lawyer` (`lawyer_id`),
  CONSTRAINT `fk_lawyer_appointments_lawyer` FOREIGN KEY (`lawyer_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lawyer_appointments_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lawyer_appointments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `lawyer_appointments_ibfk_2` FOREIGN KEY (`lawyer_id`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lawyer_appointments`
--

LOCK TABLES `lawyer_appointments` WRITE;
/*!40000 ALTER TABLE `lawyer_appointments` DISABLE KEYS */;
INSERT INTO `lawyer_appointments` VALUES
(215,4,12,'2025-03-11 04:00:00','scheduled','asdfasd','2025-03-15 20:17:38','2025-03-15 20:17:38',NULL),
(216,4,12,'2025-03-26 04:00:00','scheduled','this neads to be handeled t','2025-03-15 20:22:24','2025-03-15 20:22:24',NULL),
(217,335,12,'2025-03-12 04:00:00','scheduled','for test','2025-03-15 20:30:15','2025-03-15 20:30:15',NULL),
(218,335,12,'2025-02-26 05:00:00','scheduled','dd','2025-03-15 20:38:35','2025-03-15 20:38:35',NULL),
(219,340,22,'2025-05-26 21:03:47','scheduled','uhhfoasdf','2025-04-05 02:08:50','2025-04-05 02:08:50',6),
(220,342,22,'2025-05-26 21:03:50','scheduled','uisdiausdasd','2025-04-05 02:09:22','2025-04-05 02:09:22',6),
(221,336,12,'2025-05-24 04:00:00','scheduled','sdsds','2025-05-23 06:04:02','2025-05-23 06:04:02',NULL),
(222,338,41,'2025-05-24 04:00:00','scheduled','sds','2025-05-23 06:07:45','2025-05-23 06:07:45',NULL),
(223,338,41,'2025-05-24 04:00:00','scheduled','sds','2025-05-23 06:08:23','2025-05-23 06:08:23',NULL),
(224,336,12,'2025-05-24 04:00:00','scheduled','sdsdsdsdsdsrrrrrrrrrrrrrrrrrrr','2025-05-23 06:33:35','2025-05-23 06:33:35',NULL),
(225,336,12,'2025-05-24 04:00:00','scheduled','assssssssssssssss','2025-05-23 06:34:43','2025-05-23 06:34:43',NULL),
(226,338,41,'2025-05-24 04:00:00','scheduled','asdksdkasdkladkadk','2025-05-23 06:35:48','2025-05-23 06:35:48',NULL),
(227,338,41,'2025-05-27 04:00:00','scheduled','kkkk','2025-05-25 14:14:31','2025-05-25 14:14:31',NULL),
(228,342,43,'2025-05-26 04:00:00','scheduled','sdsd','2025-05-26 03:35:03','2025-05-26 03:35:03',NULL),
(229,340,41,'2025-06-05 04:00:00','scheduled','sdsd','2025-05-27 01:04:25','2025-05-27 01:04:25',NULL),
(230,356,41,'2025-05-31 04:00:00','scheduled','sdskdjaklsdjsldk','2025-05-27 01:07:12','2025-05-27 01:07:12',NULL);
/*!40000 ALTER TABLE `lawyer_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lawyer_prisoner_assignment`
--

DROP TABLE IF EXISTS `lawyer_prisoner_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lawyer_prisoner_assignment` (
  `assignment_id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) NOT NULL,
  `assignment_date` date NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `lawyer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`assignment_id`),
  KEY `prisoner_id` (`prisoner_id`),
  KEY `assigned_by` (`assigned_by`),
  KEY `fk_lawyer_prisoner` (`lawyer_id`),
  KEY `fk_lawyer_assignment` (`prison_id`),
  CONSTRAINT `fk_lawyer_assignment` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lawyer_prisoner` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`lawyer_id`) ON DELETE CASCADE,
  CONSTRAINT `lawyer_prisoner_assignment_ibfk_2` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `lawyer_prisoner_assignment_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lawyer_prisoner_assignment`
--

LOCK TABLES `lawyer_prisoner_assignment` WRITE;
/*!40000 ALTER TABLE `lawyer_prisoner_assignment` DISABLE KEYS */;
INSERT INTO `lawyer_prisoner_assignment` VALUES
(22,341,'2025-03-13',63,25,'2025-03-15 01:10:04','2025-05-17 04:12:05',6),
(33,4,'2025-03-12',16,14,'2025-03-15 01:31:54','2025-03-15 21:37:56',NULL),
(37,336,'2025-03-12',37,12,'2025-03-22 23:43:25','2025-03-22 23:43:25',5),
(38,336,'2025-03-29',37,12,'2025-03-22 23:43:53','2025-03-22 23:43:53',5),
(41,1,'2025-03-06',22,39,'2025-03-31 14:03:58','2025-03-31 14:03:58',10),
(42,1,'2025-03-06',22,39,'2025-03-31 19:29:53','2025-03-31 19:29:53',10),
(43,344,'2025-02-14',64,12,'2025-04-01 01:41:44','2025-04-01 01:41:44',5),
(46,1,'2025-05-06',64,46,'2025-05-07 00:32:49','2025-05-07 00:32:49',5),
(47,344,'2025-05-07',64,43,'2025-05-07 01:11:26','2025-05-07 01:11:26',5),
(57,340,'2025-05-27',63,41,'2025-05-26 22:01:10','2025-05-26 22:01:10',6),
(58,1,'2025-05-15',63,43,'2025-05-26 22:39:49','2025-05-26 22:39:49',6),
(59,338,'2025-05-20',63,41,'2025-05-26 23:05:56','2025-05-26 23:05:56',6),
(60,356,'2025-05-20',63,41,'2025-05-26 23:06:41','2025-05-26 23:06:41',6);
/*!40000 ALTER TABLE `lawyer_prisoner_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lawyers`
--

DROP TABLE IF EXISTS `lawyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lawyers` (
  `lawyer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `law_firm` varchar(255) NOT NULL,
  `license_number` varchar(100) NOT NULL,
  `cases_handled` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prison` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lawyer_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `license_number` (`license_number`),
  KEY `fk_lawyer_prisons` (`prison`),
  CONSTRAINT `fk_lawyer_prisons` FOREIGN KEY (`prison`) REFERENCES `prisons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lawyers`
--

LOCK TABLES `lawyers` WRITE;
/*!40000 ALTER TABLE `lawyers` DISABLE KEYS */;
INSERT INTO `lawyers` VALUES
(11,'tebka','new','2025-03-06','hab@gma.co','hab@gma.co','aa','aa','aa',1,'2025-03-15 01:07:50','2025-03-18 10:25:57',1,NULL),
(12,'tebk','Gashu','2025-03-15','sscsc','law@gmail.com','$2y$12$tjcGCUY3TbozEkVyfsVfB.rTf2cQdN/N/2iQN761WX.E2HMFjRGvG','scsc','1212',33,'2025-03-15 05:59:22','2025-03-29 02:10:16',5,NULL),
(14,'profesor','ss','2025-03-05','fasfasdf','law2@gmail.com','$2y$12$tkA5hr8nip0yP5m0238oNuVhlf4BR0nEw7GgGVJ1c6bvjloa8RMaW','1234','213',2,'2025-03-15 19:41:12','2025-03-18 14:53:10',11,NULL),
(17,'profesor','ss','2025-03-05','fasfasdf','law3@gmail.com','$2y$12$v5z/lWGApEqqA8pQx8K2O.Vm0Xp/NLZXppjlOVKdM5uflY4QOQMoO','123455','55213',2,'2025-03-15 19:42:06','2025-03-18 14:53:15',2,NULL),
(20,'Habtamu','Gashu','2025-03-20','222q22','bosss1@gmail.com','$2y$12$7fmr/vuCS4/iWAgpLjNnk.R2OgRzhceE3VkOZeXkOVYMXftDU4k2O','scsc','1212as',22,'2025-03-18 06:14:22','2025-03-18 14:53:27',3,NULL),
(25,'Habtamu','Gashu','2025-03-08','2341234','worabelaw@gmail.com','$2y$12$U0gwbeCDDYhOZtnYkWL3Neiyv9j/ufsoEFCA.J5Ji.XhCQQxf8YJG','2323','323',2,'2025-03-18 19:37:55','2025-03-31 16:38:51',6,NULL),
(26,'Habtamu','Gashu','2025-03-15','fasfasdf','worabelaw2@gmail.com','$2y$12$Li3x0G7/L5c9sQjlZs9n3OO62BK61BBGEcyNczYXE3hkt.L.WIfl.','scsc','5555213',3,'2025-03-19 23:49:37','2025-03-19 23:49:37',NULL,NULL),
(28,'Habtamu','rGashu','2025-03-13','fasfasdf','kembatalawrr@gmail.com','$2y$12$qbDMsVgFIyFT1B4LFshEW.jPHHr3ZehfMTX/AWLUo86bSuIS4xagm','scscff','121244',12344,'2025-03-22 23:47:32','2025-03-22 23:47:32',NULL,NULL),
(29,'Habtamu','Gashu','2025-03-05','fasfasdf','kembatainlll@gmail.com','$2y$12$.R5AQJ2InypQrE5pk5e7kewRB6PDxFkhgrdGkTAafWaUrht4puHea','scsc33','12123',22,'2025-03-22 23:48:18','2025-03-22 23:48:18',NULL,NULL),
(30,'Habtamu','Gashu','2025-03-05','fasfasdf','kembatain33lll@gmail.com','$2y$12$0aCeP3wznBAVKzzBflLJS.vlIJwhe1BEctNdyL17tP8wDi2/IlfaO','scsc333','121233',322,'2025-03-22 23:48:30','2025-03-22 23:48:30',NULL,NULL),
(32,'Habtamu','Gashu','2025-03-13','fasfasdf','bosssss@gmail.com','$2y$12$xqhsxcwccFDMhmodHdVQzeMVEiXhrFcVcQ307aLfyQtMS3heVR3kS','123422ss','1212ssss',2,'2025-03-23 03:36:16','2025-03-23 03:36:16',NULL,NULL),
(39,'Habtamu','Gashu','2025-03-13','ss','bosjjks@gmail.com','$2y$12$TGqfxkPiJrdmD7DnsQ3U.eQey56FFM6k7h2VMn0IoAB44iIBvHjWW','jh','u98;',77300,'2025-03-30 22:13:03','2025-03-31 19:29:35',10,NULL),
(41,'Habtamu','Gashu','2025-03-21','llllmqowpodasd','law222@gmail.com','$2y$12$qu5o1IGcffqkpWeQiK5Lzez1ln4maMliXOtpxMipXgKnY.bQjg7kW','12342277044s12121','1212121212',21,'2025-04-01 02:58:14','2025-04-01 03:00:03',6,NULL),
(43,'biruk','mereta','2025-03-14','llllm32ss','sdlksdss@gmail.com','$2y$12$.QdZusxc.ydfnwHdIchBReu7uAn.UFGUlYiMP/Bv4uYl3/LsEBSTG','123422772','0s0s121277000002',232,'2025-04-01 03:06:30','2025-05-26 02:29:33',6,NULL),
(46,'adisu yebelu','Gashu','2025-04-12','0909029295','kembatlaw@gmail.com','$2y$12$G1RzDTJMPuiMrzDYLdUPqODO9Y3BC1L8jPBUN6/jxLl3Rj27ePCsm','23','3223',32,'2025-04-04 17:16:35','2025-04-04 17:16:35',5,'lawyer_profiles/yggg0FqMNOnwNntgsXWC3rqMoqohz2mkLoXQM9Yk.jpg');
/*!40000 ALTER TABLE `lawyers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_appointments`
--

DROP TABLE IF EXISTS `medical_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `medical_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medical_appointments_prisoner` (`prisoner_id`),
  KEY `fk_medical_appointments_doctor` (`doctor_id`),
  KEY `fk_medical_appointments_created_by` (`created_by`),
  KEY `fk_prisonformedical` (`prison_id`),
  CONSTRAINT `fk_medical_appointments_created_by` FOREIGN KEY (`created_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_medical_appointments_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_medical_appointments_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prisonformedical` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medical_appointments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `medical_appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `medical_appointments_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_appointments`
--

LOCK TABLES `medical_appointments` WRITE;
/*!40000 ALTER TABLE `medical_appointments` DISABLE KEYS */;
INSERT INTO `medical_appointments` VALUES
(212,1,14,'2025-03-14 23:13:50','asdfsdfasdf','asdfasd','scheduled',14,'2025-03-19 23:13:50','2025-03-19 23:13:50',NULL),
(213,4,73,'2025-04-06 14:42:05','Doloremque quam quas impedit non esse ea iusto necessitatibus.','Veritatis deleniti tempore quia in adipisci architecto beatae totam.','scheduled',73,'2025-04-06 14:42:05','2025-04-06 14:42:05',NULL),
(214,3,73,'2025-04-11 15:11:00','xxx','xx','completed',73,'2025-04-06 19:09:55','2025-04-06 19:09:55',NULL),
(215,2,73,'2025-04-19 11:13:00','aa','aa','completed',73,'2025-04-06 19:18:21','2025-04-19 15:13:00',NULL),
(216,336,73,'2025-04-07 16:25:57','aaa','aaaa','completed',73,'2025-04-06 19:20:49','2025-04-07 20:25:57',5),
(217,348,68,'2025-11-13 16:50:00','Corrupti quibusdam','Quis et aut voluptat','completed',68,'2025-04-06 21:34:46','2025-04-06 21:34:46',NULL),
(218,354,73,'2025-04-07 15:54:57','sss','ss','completed',73,'2025-04-07 19:53:29','2025-04-07 19:54:57',5),
(219,353,73,'2025-04-07 15:58:53','sss','ss','completed',73,'2025-04-07 19:57:29','2025-04-07 19:58:53',5),
(220,344,73,'2025-05-17 00:44:58','sss','ss','scheduled',73,'2025-04-07 19:58:21','2025-05-17 04:44:58',5),
(221,341,82,'2025-05-15 21:33:40','fkgjadfsd','dfsd','completed',82,'2025-05-16 01:32:59','2025-05-16 01:33:40',6),
(222,3,82,'2025-05-22 00:44:25',NULL,NULL,'completed',82,'2025-05-20 07:04:35','2025-05-22 04:44:25',22),
(223,3,82,'2025-05-26 18:03:41',NULL,NULL,'completed',82,'2025-05-25 20:19:42','2025-05-26 22:03:41',22),
(224,3,82,'2025-05-25 16:22:22','kkkjk','nmn','completed',82,'2025-05-25 20:21:38','2025-05-25 20:22:22',22),
(225,3,82,'2025-05-27 20:26:00','lkfas','sdkfjsd','scheduled',82,'2025-05-25 20:26:47','2025-05-25 20:26:47',22),
(226,3,82,'2025-05-26 16:28:00','kjhskj','mnkj','scheduled',82,'2025-05-25 20:28:51','2025-05-25 20:28:51',22),
(227,3,82,'2025-05-26 19:31:00','lkjlk','mkjh','scheduled',82,'2025-05-25 20:31:43','2025-05-25 20:31:43',22),
(228,3,82,'2025-05-27 00:03:00',NULL,NULL,'scheduled',82,'2025-05-26 22:03:58','2025-05-26 22:03:58',22);
/*!40000 ALTER TABLE `medical_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_reports`
--

DROP TABLE IF EXISTS `medical_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `medical_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `appointment_id` int(11) DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `notes` text NOT NULL,
  `follow_up` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medical_reports_prisoner` (`prisoner_id`),
  KEY `fk_medical_reports_doctor` (`doctor_id`),
  KEY `fk_appointment` (`appointment_id`),
  CONSTRAINT `fk_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `medical_appointments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_medical_reports_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_medical_reports_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medical_reports_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `medical_reports_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_reports`
--

LOCK TABLES `medical_reports` WRITE;
/*!40000 ALTER TABLE `medical_reports` DISABLE KEYS */;
INSERT INTO `medical_reports` VALUES
(1,336,73,'aaa','aaaa','aa','2025-04-07 04:00:00','2025-04-07 19:03:50','2025-04-07 19:03:50',216,0,NULL,'aa','0'),
(2,336,73,'aaa','aaaa','aa','2025-04-07 04:00:00','2025-04-07 19:04:54','2025-04-07 19:04:54',216,0,NULL,'aa','0'),
(3,344,73,'ee','ee','ee','2025-04-07 04:00:00','2025-04-07 19:06:55','2025-04-07 19:06:55',NULL,0,NULL,'ee','0'),
(4,344,73,'ee','ee','ee','2025-04-07 04:00:00','2025-04-07 19:07:46','2025-04-07 19:07:46',NULL,0,NULL,'ee','0'),
(5,344,73,'Fugit quo esse.','232 Margarita Crest','Illo ea necessitatibus.','2024-06-01 04:00:00','2025-04-07 19:08:34','2025-04-07 19:08:34',NULL,0,'2026-03-19','337','1'),
(6,353,73,'Iste quos non eos.','868 Sigurd Squares','Nulla magnam delectus occaecati adipisci aliquid pariatur.','2024-07-13 04:00:00','2025-04-07 19:14:20','2025-04-07 19:14:20',NULL,0,NULL,'323','0'),
(7,336,73,'aaa','aaaa','Voluptatem dolorem a','2025-04-07 04:00:00','2025-04-07 19:15:16','2025-04-07 19:15:16',216,0,'2025-04-26','Do delectus error m','1'),
(8,344,73,'kk','kk','kk','2025-04-25 04:00:00','2025-04-07 19:15:31','2025-04-07 19:15:31',NULL,0,NULL,'kk','0'),
(9,354,73,'sss','ssaas','as','2025-04-07 04:00:00','2025-04-07 19:54:57','2025-04-07 19:54:57',218,0,NULL,'as','0'),
(10,353,73,'sss','ss','sd','2025-04-17 04:00:00','2025-04-07 19:58:53','2025-04-07 19:58:53',219,0,'2025-04-18','sd','1'),
(11,336,73,'aaa','aaaa','yyy','2025-04-07 04:00:00','2025-04-07 20:25:57','2025-04-07 20:25:57',216,0,NULL,'yyy','0'),
(12,344,73,'sss.d','sscccccc','ccc','2025-04-10 04:00:00','2025-04-08 14:23:43','2025-04-08 14:23:43',220,0,NULL,'cc','0'),
(13,2,NULL,'aa','aa','ass','2025-04-09 04:00:00','2025-04-19 15:13:00','2025-04-19 15:13:00',215,0,NULL,'sac','0'),
(14,341,82,'fkgjadfsd','dfsd','kfasdf','2025-05-16 04:00:00','2025-05-16 01:33:40','2025-05-16 01:33:40',221,0,NULL,'sdfanmsd','0'),
(15,3,82,'kjk','kmjkl','kjk','2025-05-25 04:00:00','2025-05-25 20:22:54','2025-05-25 20:22:54',NULL,0,NULL,'kj','0');
/*!40000 ALTER TABLE `medical_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_05_09_233824_create_audits_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `new_visiting_requests`
--

DROP TABLE IF EXISTS `new_visiting_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_visiting_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_id` int(11) DEFAULT NULL,
  `requested_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prisoner_firstname` varchar(255) DEFAULT NULL,
  `prisoner_middlename` varchar(255) DEFAULT NULL,
  `prisoner_lastname` varchar(255) DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `requested_time` time NOT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prison_id` (`prison_id`),
  KEY `fk_approved_by` (`approved_by`),
  KEY `fk_visitor_id` (`visitor_id`),
  CONSTRAINT `fk_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_prison_idd` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_visitor_id` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_visiting_requests`
--

LOCK TABLES `new_visiting_requests` WRITE;
/*!40000 ALTER TABLE `new_visiting_requests` DISABLE KEYS */;
INSERT INTO `new_visiting_requests` VALUES
(1,16,'2025-04-23','approved',NULL,'2025-04-10 16:33:13','2025-04-10 20:48:39','Habtamu','Bitew','Gashu',1,'08:33:00',NULL),
(2,16,'2025-04-23','pending',NULL,'2025-04-10 16:34:28','2025-04-26 13:36:57','Habtamu','Bitew','Gashu',5,'08:33:00',NULL),
(3,16,'2025-04-18','approved',NULL,'2025-04-10 16:34:42','2025-04-18 01:41:16','Habtamu','Bitew','Gashu',19,'11:34:00','this prisoner is not found '),
(4,16,'2025-04-18','approved',NULL,'2025-04-10 16:39:22','2025-04-16 15:14:16','Habtamu','Bitew','Gashu',11,'20:41:00',NULL),
(5,16,'2025-04-11','approved',NULL,'2025-04-10 16:39:49','2025-04-16 15:14:27','Habtamu','Bitew','Gashu',1,'08:41:00',NULL),
(6,16,'2025-04-17','approved',NULL,'2025-04-10 18:29:05','2025-05-25 21:24:37','ato','belete','Gashu',6,'10:31:00',NULL),
(7,16,'2025-04-11','approved',NULL,'2025-04-10 19:06:04','2025-04-10 20:48:32','Habtamu','Bitew','Gashu',20,'11:09:00',NULL),
(8,16,'2025-04-24','pending',NULL,'2025-04-10 19:08:18','2025-04-10 19:08:18','Habtamu','Bitew','Gashu',17,'03:08:00',NULL),
(9,16,'2025-04-10','approved',NULL,'2025-04-10 19:08:39','2025-05-25 12:40:55','Habtamu','Bitew','Gashu',6,'11:08:00','c'),
(10,17,'2025-04-25','approved',NULL,'2025-04-10 19:34:53','2025-05-25 12:40:16','Habtamu','Bitew','Gashu',6,'00:34:00',NULL),
(11,17,'2025-04-10','approved',NULL,'2025-04-10 19:41:40','2025-04-10 16:34:30','Habtamu','Bitew','Gashu',6,'11:18:00',NULL),
(12,17,'2025-04-10','pending',NULL,'2025-04-10 19:42:10','2025-04-10 19:42:10','Habtamu','Bitew','Gashu',22,'11:42:00',NULL),
(13,16,'2025-04-18','pending',NULL,'2025-04-11 13:07:11','2025-04-19 20:41:53','Habtamu','Bitew','Gashu',5,'05:07:00','mmm'),
(14,19,'2025-04-19','pending',NULL,'2025-04-11 18:59:44','2025-04-11 18:59:44','Habtamu','Bitew','Gashu',20,'11:58:00',NULL),
(15,16,'2025-04-18','approved',NULL,'2025-04-18 15:41:50','2025-05-16 02:02:04','ato','Bitew','Gashu',5,'07:44:00','fffff'),
(16,16,'2025-04-03','pending',NULL,'2025-04-18 23:45:31','2025-04-18 23:45:31','Habtamu','Bitew','Gashu',1,'15:48:00',NULL),
(17,19,'2025-04-26','approved',NULL,'2025-04-26 13:54:53','2025-05-08 01:02:01','prisoner1','prisoner1','prisoner12',6,'10:54:00',NULL),
(18,19,'2003-02-23','pending',NULL,'2025-05-16 02:17:19','2025-05-16 02:17:19','Dillon','Sasha Ingram','Moss',13,'22:46:00',NULL),
(19,19,'2025-05-19','pending',NULL,'2025-05-25 12:29:54','2025-05-25 12:29:54','Habtamu','Bitew','Gashu',3,'07:29:00',NULL),
(20,19,'2025-05-15','pending',NULL,'2025-05-25 12:30:37','2025-05-25 12:30:37','asasa','asa','asa',19,'04:33:00',NULL);
/*!40000 ALTER TABLE `new_visiting_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `police_prisoner_assignment`
--

DROP TABLE IF EXISTS `police_prisoner_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `police_prisoner_assignment` (
  `assignment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `officer_id` int(11) NOT NULL,
  `prisoner_id` int(11) NOT NULL,
  `prison_id` int(11) NOT NULL,
  `assignment_date` date NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`assignment_id`),
  KEY `officer_id` (`officer_id`),
  KEY `prisoner_id` (`prisoner_id`),
  KEY `assigned_by` (`assigned_by`),
  KEY `prison_id` (`prison_id`),
  CONSTRAINT `police_prisoner_assignment_ibfk_1` FOREIGN KEY (`officer_id`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `police_prisoner_assignment_ibfk_2` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `police_prisoner_assignment_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `police_prisoner_assignment_ibfk_4` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `police_prisoner_assignment`
--

LOCK TABLES `police_prisoner_assignment` WRITE;
/*!40000 ALTER TABLE `police_prisoner_assignment` DISABLE KEYS */;
INSERT INTO `police_prisoner_assignment` VALUES
(1,42,1,5,'2025-05-06',64,'2025-05-07 01:31:31','2025-05-07 01:31:31'),
(2,80,344,5,'2025-05-01',64,'2025-05-07 02:25:53','2025-05-07 02:25:53'),
(3,51,339,6,'2025-05-15',63,'2025-05-16 01:06:19','2025-05-16 01:06:19'),
(5,50,338,6,'2025-05-16',63,'2025-05-17 04:30:00','2025-05-17 04:30:00'),
(6,35,337,6,'2025-05-14',63,'2025-05-20 06:56:05','2025-05-20 06:56:05'),
(10,51,340,6,'2025-05-15',63,'2025-05-26 22:00:12','2025-05-26 22:00:12'),
(11,43,341,6,'2025-05-26',63,'2025-05-26 22:38:56','2025-05-26 22:38:56'),
(12,78,1,6,'2025-05-26',63,'2025-05-26 22:40:10','2025-05-26 22:40:10'),
(13,43,341,6,'2025-05-27',63,'2025-05-26 22:43:04','2025-05-26 22:43:04'),
(14,85,1,6,'2025-05-22',63,'2025-05-26 23:03:33','2025-05-26 23:03:33'),
(15,85,356,6,'2025-05-20',63,'2025-05-26 23:06:54','2025-05-26 23:06:54');
/*!40000 ALTER TABLE `police_prisoner_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prisoners`
--

DROP TABLE IF EXISTS `prisoners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `prisoners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed') DEFAULT NULL,
  `crime_committed` text DEFAULT NULL,
  `status` enum('active','released','transferred') DEFAULT NULL,
  `time_serve_start` date DEFAULT NULL,
  `time_serve_end` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(50) DEFAULT NULL,
  `emergency_contact_number` varchar(20) DEFAULT NULL,
  `inmate_image` text DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `room_id` int(11) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_room` (`room_id`),
  KEY `fk_prisoners_prison` (`prison_id`),
  CONSTRAINT `fk_prisoners_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prisoners_ibfk_1` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=366 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prisoners`
--

LOCK TABLES `prisoners` WRITE;
/*!40000 ALTER TABLE `prisoners` DISABLE KEYS */;
INSERT INTO `prisoners` VALUES
(1,'prisHabtamu','Bitew','Gashu','2025-03-13','male','single','Assault','released','2025-03-12','2025-03-11','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','dsdc','0909029295','inmate_images/I744sa3Cr2eZCl51ywSxSWeWkjuZislU3Eqipp5I.png',6,'2025-03-09 05:50:04','2025-05-22 04:41:05',NULL,'2025-05-22'),
(2,'Habtamu','Bitew','Gashu','2025-03-06',NULL,'single','Drug Possession','active','2025-03-13','2025-03-12','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Bitew Gashu','dddd','0909029295','inmate_images/i1svZGblysxVKfHU6KFA7yML642kt5kka576h4ak.png',20,'2025-03-10 03:30:51','2025-03-15 17:41:31',6,'0000-00-00'),
(3,'Habtamu','Bitew','Gashu','2025-03-13','male','single','Drug Possession','active','2025-03-13','2025-03-13','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','dddd','0909029295','inmate_images/ZL874YNeFXAN3iiKQj1E05jWbnSJA8B78HFLx61R.png',22,'2025-03-10 03:34:50','2025-03-15 17:41:36',5,'0000-00-00'),
(4,'TOLOSA','DEMLEW','SISAY','2025-03-21','male','single','Drug Possession','active','2025-04-01','2025-03-13','Ethiopia','Habtamu Gashu','FRIND','0909029295','inmate_images/d6NmXTwitPV3ffvPBLeaq19RsPS2nGldOzVBRWLv.jpg',11,'2025-03-10 03:37:04','2025-03-18 20:26:05',14,'0000-00-00'),
(335,'first','lol','Gashu','2025-03-14','male','single','Drug Possession','active','2025-03-06','2025-03-05','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Bitew Gashu','sdfsd','0909029295','inmate_images/LTQcy22ZL5xqWAufonNxNwsgSL5WMDOuKoE5rkeE.jpg',3,'2025-03-11 14:53:12','2025-03-14 19:31:06',2,'0000-00-00'),
(336,'Habtamu','Bitew','Gashu','2025-03-20','male','married','Assault','active','2025-03-19','2025-03-13','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','Habtamu Gashu','sdsd','0909029295','inmate_images/DseDmiqD739djW4X6jy88N3quEgII8B3HMpoljXJ.jpg',10,'2025-03-18 05:55:31','2025-03-22 06:54:40',15,'0000-00-00'),
(337,'Habtamu','Bitew','Gashu','2025-02-28','male','single','Drug Possession','released','2025-03-18','2025-03-19','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Bitew Gashu','hfluy','0909029295','inmate_images/6kWetb8zbvRikVpn7eGqO3jVs5dZJkf28ey0j6vy.jpg',6,'2025-03-18 14:51:21','2025-05-04 18:59:02',4,'0000-00-00'),
(338,'Habtamu','Bitew','Gashu','2025-03-13','male','single','Fraud','released','2025-03-10','2025-03-20','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Bitew Gashu','asdfa','0909029295','inmate_images/Pck9Hjb5LhjRohLRCAYdUAQi7eZj99m2P71pB3fR.jpg',6,'2025-03-18 18:13:43','2025-05-25 13:18:02',NULL,'0000-00-00'),
(339,'Habtamu','Bitew','Gashu','2025-03-19','male','single','Theft','active','2025-03-11','2025-03-28','hoseana','Habtamu Bitew Gashu','dddd','0909029295','inmate_images/CD3NG2tyREfbm6K4Ip9e3yINZr2XZDeXsXLltrkb.jpg',6,'2025-03-18 19:24:17','2025-03-18 19:24:57',3,'0000-00-00'),
(340,'worabe','Bitew','Gashu','2025-03-28','male','single','Drug Possession','released','2025-03-06','2025-03-13','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Bitew Gashu','de','0909029295','inmate_images/AmkW0Iss62gxXORsGirghL6ntvJfPuBRGGXU5n3S.jpg',6,'2025-03-18 20:13:44','2025-05-04 19:08:54',14,'0000-00-00'),
(341,'prisoner1','prisoner1','prisoner12','2001-04-01','male','single','Assault','released','2025-03-21','2024-03-20','hose','family 1','family 1','family 1','inmate_images/xXVilbQOcwh1YDMGWRmOGPGL3waxzf9IY1iVoQYl.png',6,'2025-03-19 17:48:45','2025-05-09 00:04:36',12,'2025-05-08'),
(342,'prisoner1worabe','prisoner1worabe','prisoner1worabe','2025-03-28','male','single','Theft','released','2025-03-11','2025-03-11','worabe','Habtamu Bitew Gashu','family','0909029295','inmate_images/CYhtNK2Uq3693irJZKwgJ1KAdhthz7IllaQ8n5mQ.png',6,'2025-03-19 18:38:12','2025-05-22 04:41:39',13,'2025-05-22'),
(343,'Habtamu','Bitew','Gashu','2025-03-14','male','single','Fraud','released','2025-03-20','2025-03-22','worabe','Habtamu Gashu','faam','0909029295','inmate_images/3jXJXsl7pfrMmZ1moQqaubYeEWMIKrtWWm2NWmrQ.jpg',6,'2025-03-19 23:52:02','2025-05-04 19:19:53',15,'0000-00-00'),
(344,'wow','Bitew','Gashu','2025-03-22','male','single','Drug Possession','released','2025-03-07','2025-03-06','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Bitew Gashu','rrr','0909029295','inmate_images/PAHlqV6Zsd3SAIehlnRotnxNyFgoOqMhYNnBjNtU.png',5,'2025-03-22 23:45:14','2025-05-12 04:43:39',19,'2025-05-12'),
(345,'Habtamu','kl','Gashu','2025-03-20','male','single','Theft','active','2025-03-20','2025-03-13','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','Habtamu Gashu','dddd','0909029295','inmate_images/hSsEMKOiAojJLpJ2qdNJAyrEgIKZc299uEXGsL1F.jpg',10,'2025-03-30 21:05:28','2025-03-30 21:05:28',NULL,'0000-00-00'),
(346,'Habtamu','Bitew','Gashu','2025-04-17','male','single','Theft','active','2025-04-04','2025-04-19','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','sdsd','0943392332','inmate_images/KqRq8s4MCkQh0zGP8Qvjpzd2ZfMudr9PGa9g6r9l.jpg',10,'2025-04-03 21:59:42','2025-04-03 21:59:42',NULL,'0000-00-00'),
(347,'Habtamu','Bitew','Gashu','2025-04-30','male','single','Assault','active','2025-04-18','life','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','Habtamu Gashu','dddd','0943392332','inmate_images/0IJS5ee1Jbdm9vtrbD25t8u5sMxzCMDaLym0v5BW.jpg',10,'2025-04-04 01:48:08','2025-04-04 01:48:08',NULL,'0000-00-00'),
(348,'Habtamu','Bitew','Gashu','2025-04-18','male','single','Theft','active','2024-04-17','death','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','Habtamu Gashu','sdsd','0909029295','inmate_images/gsTJopq1N5oeA0pxkYVsffOp6pm3uWCTVQ9kA8Xy.jpg',10,'2025-04-04 01:53:28','2025-04-04 01:53:28',NULL,'0000-00-00'),
(349,'Habtamu','Bitew','Gashu','2025-04-26','male','single','Drug Possession','active','2025-04-03','Death Sentence','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','sdfsd','0943392332','inmate_images/8DmqyXEGh6N3WNaSH88EGDMRld8QNNc9wkrWdKZl.jpg',10,'2025-04-04 03:16:50','2025-04-04 03:16:50',NULL,'0000-00-00'),
(350,'Habtamu','Bitew','Gashu','2025-04-11','male','single','Assault','active','2025-04-03','Life Sentence','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','dddd','0909029295','inmate_images/nzBHzzT9O0A1ITji4dvOkHJEjqu9SSq1gfdg49Kr.jpg',10,'2025-04-04 03:19:21','2025-04-04 03:19:21',NULL,'0000-00-00'),
(351,'Habtamu','Bitew','Gashu','2025-04-05','male','single','Other','active','2025-04-04','2048-04-04','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','dddd','0909029295','inmate_images/UtL30vt2S6lmINALl2KJOBjcDq1faq9PRDexUtqV.jpg',26,'2025-04-04 03:57:00','2025-04-06 20:01:57',15,'0000-00-00'),
(352,'Habtamu','Bitew','Gashu','2025-04-15','male','single','Hate Crimes','active','2025-04-04','2035-04-04','Bahir dar\r\nBahir dar,Ethiopia','Habtamu Gashu','sdfsd','0943392332','inmate_images/knYRdfmwIQTnu9yEeYnsotAFBOCki6h5iCmbYiao.jpg',11,'2025-04-04 15:27:56','2025-04-04 15:29:20',11,'0000-00-00'),
(353,'Albertha','Reanna Cremin','Hickle','2026-03-11','female','widowed','Fraud','active','2025-09-12','2053-09-12','57556 Maggio Highway','Evie Hansen','Montserrat','463-395-3425','inmate_images/cUs3EqldkZJjoaqhRNxwCPzySO6RpNWMY5wTqonJ.jpg',2,'2025-04-06 20:06:21','2025-04-06 20:07:20',17,'0000-00-00'),
(354,'Philip','Ila Cartwright','Kautzer','2026-01-26','female','married','Robbery','active','2025-11-21','Death Sentence','81435 Quigley Views','Mozell Hegmann','Eswatini','416-008-7372','inmate_images/5wyDLEuEl5QsSC2f5DjbjjZIbvdMQS8Pc5NcJA5o.jpg',2,'2025-04-06 21:27:26','2025-04-06 21:29:34',22,'0000-00-00'),
(355,'Habtamu','Bitew','Gashu','2025-04-15','male','single','Corruption','active','2025-04-23','2043-04-23','Bahir dar\r\nBahir dar,Ethiopia','habtamu','hjh','0909029295','inmate_images/dlCunJam13OkpuqzNwT0fLBDBsNf1cHIvBB0oAei.jpg',10,'2025-04-19 20:48:36','2025-04-19 20:48:36',NULL,'0000-00-00'),
(356,'Rodolfo','Madelynn Lowe','Lowe','2026-04-13','female','married','Rape','active','2025-11-04','Life Sentence','48359 Sigrid Ville','Savanna Bartoletti','Nigeria','725-590-8358','inmate_images/U2QsJk5dpG6YynuJywk0U4fpsMaGHGw1U2k9NYrT.jpg',6,'2025-05-16 01:03:44','2025-05-21 16:11:20',16,NULL),
(357,'Douglas','Alverta Steuber','Fahey','2025-02-27','female','divorced','Vandalism','active','2024-09-14','2036-09-14','782 Roberto Way','Ardith Stiedemann','New Zealand','502-486-6360','inmate_images/erpSXTkNCur3f1Q3DTgSE8zyOHer3HeXgO1Wn5jB.jpg',6,'2025-05-17 02:56:14','2025-05-17 02:56:14',NULL,NULL),
(358,'Douglas','Alverta Steuber','Fahey','2025-02-27','female','divorced','Vandalism','active','2024-09-14',NULL,'782 Roberto Way','Ardith Stiedemann','New Zealand','502-486-6360','inmate_images/jZk47h06MXUiOMGqogie4aKvMIO69i8hcqAp0gfe.jpg',6,'2025-05-17 02:58:17','2025-05-21 16:17:43',14,NULL),
(359,'Douglas','Alverta Steuber','Fahey','2025-02-27','female','divorced','Vandalism','active','2024-09-10','2036-09-10','782 Roberto Way','Ardith Stiedemann','New Zealand','502-486-6360','inmate_images/5FtLXvfWZSLL4TXC5nB6mrWKqNcMa4lNwcCTXFdp.jpg',6,'2025-05-17 02:59:08','2025-05-21 16:17:49',16,NULL),
(360,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,'2025-05-17 04:12:25','2025-05-17 04:12:25',NULL,NULL),
(361,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,'2025-05-17 04:29:15','2025-05-22 04:43:27',14,NULL),
(362,'Leif','Sadye Renner','Pacocha','2025-06-13','female','widowed','Rape','active','2025-11-30','2045-11-30','9045 Woodrow Burgs','Krista Schuppe','Ukraine','021-690-1767','inmate_images/lW0hspyQJUrbCJbv4l9nX0lOu5eMVGMD02LNhfDR.jpg',6,'2025-05-21 00:52:13','2025-05-22 04:43:20',14,NULL),
(363,'Jayme','Albin Marvin','Ernser','2026-01-18','female','married','Assault','active','2026-04-13','2048-04-13','418 Treva Meadows','Santino Bradtke','Grenada','220-824-0130','inmate_images/Vs1DRVAT7Wkyq29EluM81N8MWekx785AYBKjSgeZ.jpg',6,'2025-05-21 16:08:09','2025-05-21 16:08:09',NULL,NULL),
(364,'Sabina','Amani Rempel','Crona','2025-02-02','female','widowed','Rape','active','2025-05-27','2037-05-27','84505 Nolan Rest','Pietro Mann','Svalbard & Jan Mayen Islands','579-085-2372','inmate_images/M3WsdbCZRm1ztsFRSzykvOhffHZeKpxDjzWfral3.jpg',6,'2025-05-21 16:09:09','2025-05-21 16:09:09',NULL,NULL),
(365,'Buster','Ottilie Sanford','Leffler','2026-05-08','female','married','Tax Evasion','active','2025-02-05','2037-02-05','363 Marlene Loaf','Eric Buckridge','Slovakia','187-051-9012','inmate_images/O9pvjQob0jr2sbUQWRCQ9xFQKsPCuKS7FgWVMVmK.jpg',6,'2025-05-26 22:02:01','2025-05-26 22:02:01',NULL,NULL);
/*!40000 ALTER TABLE `prisoners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prisons`
--

DROP TABLE IF EXISTS `prisons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `prisons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prisons`
--

LOCK TABLES `prisons` WRITE;
/*!40000 ALTER TABLE `prisons` DISABLE KEYS */;
INSERT INTO `prisons` VALUES
(1,'wolkite prison','Bahir Dar',2121212,'2025-03-09 04:41:27','2025-05-17 02:06:37'),
(2,'gurage prison','gurage',2312312,'2025-03-09 04:51:07','2025-03-09 04:51:07'),
(3,'hadya','Addis Ababa',302222,'2025-03-09 04:55:05','2025-05-26 20:23:56'),
(4,'central ethiopia','hoseana',232323,'2025-03-09 04:55:43','2025-03-09 04:55:43'),
(5,'kembata prison','kembata',2121212,'2025-03-09 05:37:41','2025-03-09 05:37:41'),
(6,'worabe prison','worabe',2323,'2025-03-09 05:40:06','2025-03-09 05:40:06'),
(7,'East Gurage Zone Priosn','Hawassa',121212,'2025-03-09 05:43:21','2025-03-09 05:43:21'),
(8,'ddd','test',222222,'2025-03-09 17:44:13','2025-03-09 17:44:13'),
(10,'Halaba Zone Prison','test',300000,'2025-03-09 17:47:23','2025-03-09 17:47:23'),
(11,'Siltʼe Zone Prison','test',333333,'2025-03-09 19:03:00','2025-03-09 19:03:00'),
(13,'DD2323','test',32323,'2025-03-09 19:14:32','2025-03-09 19:14:32'),
(14,'asdfasdf','test',2121,'2025-03-09 19:14:40','2025-03-09 19:14:40'),
(15,'hhhh','test',2323,'2025-03-09 19:14:49','2025-03-09 19:14:49'),
(16,'232323234','test',234234,'2025-03-09 19:14:57','2025-03-09 19:14:57'),
(17,'asdasd','test',232323,'2025-03-09 19:15:05','2025-03-09 19:15:05'),
(18,'weqwer','test',2323,'2025-03-09 19:15:10','2025-03-09 19:15:10'),
(19,'Yem Zone Prison','test',222,'2025-03-09 19:37:35','2025-03-09 19:37:35'),
(20,'abecho gode','test',21212,'2025-03-09 19:41:16','2025-03-09 19:41:16'),
(22,'kemba','Addis Ababa',222,'2025-03-18 19:32:14','2025-03-18 19:32:14'),
(25,'DDoo','Addis Ababa',1212,'2025-04-01 02:31:08','2025-04-01 02:31:08'),
(26,'hosseana prison','gurage',12121212,'2025-04-03 16:42:37','2025-04-03 16:42:37'),
(32,'siteeee','Worabe',3123232,'2025-05-16 00:57:15','2025-05-16 00:57:15');
/*!40000 ALTER TABLE `prisons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generated_by` int(11) DEFAULT NULL,
  `report_type` enum('daily','monthly','annual','incident') DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reports_generated_by` (`generated_by`),
  KEY `fk_reports_prison_id` (`prison_id`),
  CONSTRAINT `fk_reports_generated_by` FOREIGN KEY (`generated_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_reports_prison_id` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`generated_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES
(29,12,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 8, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"337\",\"Habtamu Bitew Gashu\",\"worabe prison\",\"\\\"0 years, 0 months\\\"\",\"released\"],[\"338\",\"Habtamu Bitew Gashu\",\"worabe prison\",\"\\\"0 years, 0 months\\\"\",\"released\"],[\"339\",\"Habtamu Bitew Gashu\",\"worabe prison\",\"\\\"0 years, 0 months\\\"\",\"active\"],[\"340\",\"worabe Bitew Gashu\",\"worabe prison\",\"\\\"0 years, 0 months\\\"\",\"released\"],[\"341\",\"prisoner1 prisoner1 prisoner12\",\"worabe prison\",\"\\\"1 years, 0 months\\\"\",\"released\"],[\"342\",\"prisoner1worabe prisoner1worabe prisoner1worabe\",\"worabe prison\",\"\\\"0 years, 0 months\\\"\",\"released\"],[\"343\",\"Habtamu Bitew Gashu\",\"worabe prison\",\"\\\"0 years, 0 months\\\"\",\"released\"]]}','2025-05-09 02:36:00','2025-05-09 02:36:00',6),
(30,12,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"kembata prison\",\"generated_date\":\"May 8, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"1\",\"prisHabtamu Bitew Gashu\",\"kembata prison\",\"0 years, 0 months\",\"released\"],[\"344\",\"wow Bitew Gashu\",\"kembata prison\",\"0 years, 0 months\",\"released\"]]}','2025-05-09 02:36:23','2025-05-09 02:36:23',NULL),
(31,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"hadya\",\"generated_date\":\"May 9, 2025\"},\"data\":{\"staff\":[{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"hadya\"},{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"hadya\"}],\"prisoners\":[{\"id\":335,\"name\":null,\"sentence\":\"Unknown\",\"status\":\"active\",\"prison\":\"hadya\"}]}}','2025-05-09 19:31:28','2025-05-09 19:31:28',NULL),
(32,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"kembata prison\",\"generated_date\":\"May 9, 2025\"},\"data\":{\"staff\":[{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"demlew Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"Central Administrator\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"Inspector\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"abushi Gashu\",\"role\":\"Police Officer\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"Commissioner\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Chadrick Hodkiewicz\",\"role\":\"Discipline Officer\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Carter Smith\",\"role\":\"Security Officer\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Yuri Logan\",\"role\":\"Medical Officer\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Ronan Briggs\",\"role\":\"Training Officer\",\"status\":\"Active\",\"prison\":\"kembata prison\"},{\"id\":null,\"name\":\"Rogelio Hansen\",\"role\":\"Police Officer\",\"status\":\"Active\",\"prison\":\"kembata prison\"}],\"prisoners\":[{\"id\":1,\"name\":null,\"sentence\":\"Unknown\",\"status\":\"released\",\"prison\":\"kembata prison\"},{\"id\":344,\"name\":null,\"sentence\":\"Unknown\",\"status\":\"released\",\"prison\":\"kembata prison\"}]}}','2025-05-09 19:33:13','2025-05-09 19:33:13',NULL),
(33,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"hadya\",\"generated_date\":\"May 9, 2025\"},\"data\":{\"staff\":[{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"hadya\"},{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"System Administrator\",\"status\":\"Active\",\"prison\":\"hadya\"}],\"prisoners\":[{\"id\":335,\"name\":null,\"sentence\":\"Unknown\",\"status\":\"active\",\"prison\":\"hadya\"}]}}','2025-05-09 19:43:34','2025-05-09 19:43:34',NULL),
(34,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"central ethiopia\",\"generated_date\":\"May 9, 2025\"},\"data\":{\"staff\":[{\"id\":null,\"name\":\"Habtamu Gashu\",\"role\":\"Central Administrator\",\"status\":\"Active\",\"prison\":\"central ethiopia\"}],\"prisoners\":[]}}','2025-05-09 19:43:48','2025-05-09 19:43:48',NULL),
(35,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"central ethiopia\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"central ethiopia\",\"Active\"]]}','2025-05-09 19:46:58','2025-05-09 19:46:58',NULL),
(36,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"central ethiopia\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"central ethiopia\",\"Active\"]]}','2025-05-09 19:47:24','2025-05-09 19:47:24',NULL),
(37,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"central ethiopia\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"central ethiopia\",\"Active\"]]}','2025-05-09 19:47:45','2025-05-09 19:47:45',NULL),
(38,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"wolkite prison\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"]]}','2025-05-09 19:57:47','2025-05-09 19:57:47',NULL),
(39,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"central ethiopia\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"central ethiopia\",\"Active\"]]}','2025-05-09 20:00:50','2025-05-09 20:00:50',NULL),
(40,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Unknown\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"337\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"338\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"339\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"340\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"341\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"342\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"343\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"]]}','2025-05-09 20:02:27','2025-05-09 20:02:27',NULL),
(41,12,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"kembata prison\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"1\",\"prisHabtamu Bitew Gashu\",\"kembata prison\",\"0 years, 0 months\",\"released\"],[\"344\",\"wow Bitew Gashu\",\"kembata prison\",\"0 years, 0 months\",\"released\"]]}','2025-05-09 20:07:55','2025-05-09 20:07:55',NULL),
(42,12,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"kembata prison\",\"generated_date\":\"May 9, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"1\",\"prisHabtamu Bitew Gashu\",\"kembata prison\",\"\\\"0 years, 0 months\\\"\",\"released\"],[\"344\",\"wow Bitew Gashu\",\"kembata prison\",\"\\\"0 years, 0 months\\\"\",\"released\"]]}','2025-05-09 20:08:02','2025-05-09 20:08:02',NULL),
(43,12,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"hadya\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"335\",\"first lol Gashu\",\"hadya\",\"0 years, 0 months\",\"active\"]]}','2025-05-10 18:25:07','2025-05-10 18:25:07',NULL),
(44,78,'monthly','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Staff\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"Staff ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"demlew Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"kembata prison\",\"Active\"],[\"null\",\"abushi Gashu\",\"Police Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Commissioner\",\"kembata prison\",\"Active\"],[\"null\",\"Chadrick Hodkiewicz\",\"Discipline Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Carter Smith\",\"Security Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Yuri Logan\",\"Medical Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Ronan Briggs\",\"Training Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Rogelio Hansen\",\"Police Officer\",\"kembata prison\",\"Active\"]]}','2025-05-10 19:34:23','2025-05-10 19:34:23',NULL),
(45,78,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Staff\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walker\",\"Training Officer\",\"worabe prison\",\"Active\"],[\"337\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"338\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"339\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"340\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"341\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"342\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"343\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"]]}','2025-05-10 20:12:28','2025-05-10 20:12:28',NULL),
(46,78,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"337\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"338\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"339\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"340\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"341\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"342\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"343\",\"null\",\"worabe prison\",\"Unknown\",\"released\"]]}','2025-05-10 20:12:57','2025-05-10 20:12:57',NULL),
(47,78,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Staff\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walker\",\"Training Officer\",\"worabe prison\",\"Active\"],[\"337\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"338\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"339\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"340\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"341\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"342\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"343\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"]]}','2025-05-10 20:17:22','2025-05-10 20:17:22',NULL),
(48,78,'monthly','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Staff\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"Staff ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Staff\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walker\",\"Training Officer\",\"worabe prison\",\"Active\"]]}','2025-05-10 20:27:15','2025-05-10 20:27:15',NULL),
(49,78,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"]]}','2025-05-10 20:31:30','2025-05-10 20:31:30',NULL),
(50,78,'monthly','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Staff\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"Staff ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Staff\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walker\",\"Training Officer\",\"worabe prison\",\"Active\"]]}','2025-05-10 20:31:37','2025-05-10 20:31:37',NULL),
(51,78,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 10, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Staff\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walker\",\"Training Officer\",\"worabe prison\",\"Active\"],[\"337\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"338\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"339\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"340\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"341\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"342\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"343\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"]]}','2025-05-10 20:41:52','2025-05-10 20:41:52',6),
(52,12,'incident','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Prisons\",\"selected_prisons\":\"All Prisons\",\"generated_date\":\"May 11, 2025\"},\"table\":[[],[\"Prison ID\",\"Name\",\"Location\",\"Capacity\",\"Status\"],[\"1\",\"wolkite prison\",\"wolkite\",\"2121212\",\"Operational\"],[\"2\",\"gurage prison\",\"gurage\",\"2312312\",\"Operational\"],[\"3\",\"hadya\",\"hadia\",\"302222\",\"Operational\"],[\"4\",\"central ethiopia\",\"hoseana\",\"232323\",\"Operational\"],[\"5\",\"kembata prison\",\"kembata\",\"2121212\",\"Operational\"],[\"6\",\"worabe prison\",\"worabe\",\"2323\",\"Operational\"],[\"7\",\"East Gurage Zone Priosn\",\"Hawassa\",\"121212\",\"Operational\"],[\"8\",\"ddd\",\"test\",\"222222\",\"Operational\"],[\"10\",\"Halaba Zone Prison\",\"test\",\"300000\",\"Operational\"],[\"11\",\"Siltʼe Zone Prison\",\"test\",\"333333\",\"Operational\"],[\"13\",\"DD2323\",\"test\",\"32323\",\"Operational\"],[\"14\",\"asdfasdf\",\"test\",\"2121\",\"Operational\"],[\"15\",\"hhhh\",\"test\",\"2323\",\"Operational\"],[\"16\",\"232323234\",\"test\",\"234234\",\"Operational\"],[\"17\",\"asdasd\",\"test\",\"232323\",\"Operational\"],[\"18\",\"weqwer\",\"test\",\"2323\",\"Operational\"],[\"19\",\"Yem Zone Prison\",\"test\",\"222\",\"Operational\"],[\"20\",\"abecho gode\",\"test\",\"21212\",\"Operational\"],[\"22\",\"kemba\",\"Addis Ababa\",\"222\",\"Operational\"],[\"23\",\"admin\",\"Bahir Dar\",\"22\",\"Operational\"],[\"24\",\"tt\",\"Bahir Dar\",\"3223\",\"Operational\"],[\"25\",\"DDoo\",\"Addis Ababa\",\"1212\",\"Operational\"],[\"26\",\"hosseana prison\",\"gurage\",\"12121212\",\"Operational\"],[\"27\",\"hos\",\"Addis Ababa\",\"21212\",\"Operational\"],[\"28\",\"kjjhkj\",\"Addis Ababa\",\"7676876\",\"Operational\"],[\"29\",\"vocal\",\"silte\",\"121212\",\"Operational\"],[\"31\",\"21212asdasd\",\"kembat\",\"12121\",\"Operational\"]]}','2025-05-11 18:56:00','2025-05-11 18:56:00',NULL),
(53,12,'incident','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Prisons\",\"selected_prisons\":\"All Prisons\",\"generated_date\":\"May 11, 2025\"},\"table\":[[],[\"Prison ID\",\"Name\",\"Location\",\"Capacity\",\"Status\"],[\"1\",\"wolkite prison\",\"wolkite\",\"2121212\",\"Operational\"],[\"2\",\"gurage prison\",\"gurage\",\"2312312\",\"Operational\"],[\"3\",\"hadya\",\"hadia\",\"302222\",\"Operational\"],[\"4\",\"central ethiopia\",\"hoseana\",\"232323\",\"Operational\"],[\"5\",\"kembata prison\",\"kembata\",\"2121212\",\"Operational\"],[\"6\",\"worabe prison\",\"worabe\",\"2323\",\"Operational\"],[\"7\",\"East Gurage Zone Priosn\",\"Hawassa\",\"121212\",\"Operational\"],[\"8\",\"ddd\",\"test\",\"222222\",\"Operational\"],[\"10\",\"Halaba Zone Prison\",\"test\",\"300000\",\"Operational\"],[\"11\",\"Siltʼe Zone Prison\",\"test\",\"333333\",\"Operational\"],[\"13\",\"DD2323\",\"test\",\"32323\",\"Operational\"],[\"14\",\"asdfasdf\",\"test\",\"2121\",\"Operational\"],[\"15\",\"hhhh\",\"test\",\"2323\",\"Operational\"],[\"16\",\"232323234\",\"test\",\"234234\",\"Operational\"],[\"17\",\"asdasd\",\"test\",\"232323\",\"Operational\"],[\"18\",\"weqwer\",\"test\",\"2323\",\"Operational\"],[\"19\",\"Yem Zone Prison\",\"test\",\"222\",\"Operational\"],[\"20\",\"abecho gode\",\"test\",\"21212\",\"Operational\"],[\"22\",\"kemba\",\"Addis Ababa\",\"222\",\"Operational\"],[\"23\",\"admin\",\"Bahir Dar\",\"22\",\"Operational\"],[\"24\",\"tt\",\"Bahir Dar\",\"3223\",\"Operational\"],[\"25\",\"DDoo\",\"Addis Ababa\",\"1212\",\"Operational\"],[\"26\",\"hosseana prison\",\"gurage\",\"12121212\",\"Operational\"],[\"27\",\"hos\",\"Addis Ababa\",\"21212\",\"Operational\"],[\"28\",\"kjjhkj\",\"Addis Ababa\",\"7676876\",\"Operational\"],[\"29\",\"vocal\",\"silte\",\"121212\",\"Operational\"],[\"31\",\"21212asdasd\",\"kembat\",\"12121\",\"Operational\"]]}','2025-05-11 19:49:08','2025-05-11 19:49:08',NULL),
(54,12,'incident','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Prisons\",\"selected_prisons\":\"All Prisons\",\"generated_date\":\"May 11, 2025\"},\"table\":[[],[\"Prison ID\",\"Name\",\"Location\",\"Capacity\",\"Status\"],[\"1\",\"wolkite prison\",\"wolkite\",\"2121212\",\"Operational\"],[\"2\",\"gurage prison\",\"gurage\",\"2312312\",\"Operational\"],[\"3\",\"hadya\",\"hadia\",\"302222\",\"Operational\"],[\"4\",\"central ethiopia\",\"hoseana\",\"232323\",\"Operational\"],[\"5\",\"kembata prison\",\"kembata\",\"2121212\",\"Operational\"],[\"6\",\"worabe prison\",\"worabe\",\"2323\",\"Operational\"],[\"7\",\"East Gurage Zone Priosn\",\"Hawassa\",\"121212\",\"Operational\"],[\"8\",\"ddd\",\"test\",\"222222\",\"Operational\"],[\"10\",\"Halaba Zone Prison\",\"test\",\"300000\",\"Operational\"],[\"11\",\"Siltʼe Zone Prison\",\"test\",\"333333\",\"Operational\"],[\"13\",\"DD2323\",\"test\",\"32323\",\"Operational\"],[\"14\",\"asdfasdf\",\"test\",\"2121\",\"Operational\"],[\"15\",\"hhhh\",\"test\",\"2323\",\"Operational\"],[\"16\",\"232323234\",\"test\",\"234234\",\"Operational\"],[\"17\",\"asdasd\",\"test\",\"232323\",\"Operational\"],[\"18\",\"weqwer\",\"test\",\"2323\",\"Operational\"],[\"19\",\"Yem Zone Prison\",\"test\",\"222\",\"Operational\"],[\"20\",\"abecho gode\",\"test\",\"21212\",\"Operational\"],[\"22\",\"kemba\",\"Addis Ababa\",\"222\",\"Operational\"],[\"23\",\"admin\",\"Bahir Dar\",\"22\",\"Operational\"],[\"24\",\"tt\",\"Bahir Dar\",\"3223\",\"Operational\"],[\"25\",\"DDoo\",\"Addis Ababa\",\"1212\",\"Operational\"],[\"26\",\"hosseana prison\",\"gurage\",\"12121212\",\"Operational\"],[\"27\",\"hos\",\"Addis Ababa\",\"21212\",\"Operational\"],[\"28\",\"kjjhkj\",\"Addis Ababa\",\"7676876\",\"Operational\"],[\"29\",\"vocal\",\"silte\",\"121212\",\"Operational\"],[\"31\",\"21212asdasd\",\"kembat\",\"12121\",\"Operational\"]]}','2025-05-12 00:58:47','2025-05-12 00:58:47',NULL),
(55,12,'monthly','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Staff\",\"selected_prisons\":\"kembata prison\",\"generated_date\":\"May 11, 2025\"},\"table\":[[\"Staff ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"demlew Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"kembata prison\",\"Active\"],[\"null\",\"abushi Gashu\",\"Police Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Commissioner\",\"kembata prison\",\"Active\"],[\"null\",\"Chadrick Hodkiewicz\",\"Discipline Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Carter Smith\",\"Security Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Yuri Logan\",\"Medical Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Ronan Briggs\",\"Training Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Rogelio Hansen\",\"Police Officer\",\"kembata prison\",\"Active\"]]}','2025-05-12 00:59:25','2025-05-12 00:59:25',NULL),
(56,12,'monthly','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Staff\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 11, 2025\"},\"table\":[[\"Staff ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Unknown\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Elaine Oneill\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Cole\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walker\",\"Training Officer\",\"worabe prison\",\"Active\"]]}','2025-05-12 01:00:17','2025-05-12 01:00:17',NULL),
(57,12,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"kembata prison\",\"generated_date\":\"December 22, 2024\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"344\",\"wow Bitew Gashu\",\"kembata prison\",\"0 years, 0 months\",\"released\"]]}','2024-12-23 08:17:08','2024-12-23 08:17:08',NULL),
(58,12,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"All Prisons\",\"generated_date\":\"May 26, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"central ethiopia\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"abecho gode\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"Halaba Zone Prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"Halaba Zone Prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"hadya\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"East Gurage Zone Priosn\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"demlew Gashu\",\"System Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Unknown\",\"Siltʼe Zone Prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"hadya\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Police Officer\",\"Siltʼe Zone Prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Unknown\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Central Administrator\",\"kembata prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"weqwer\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"kemba\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"abecho gode\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"Yem Zone Prison\",\"Active\"],[\"null\",\"Habtamu Gashudasd\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"Inspector\",\"kembata prison\",\"Active\"],[\"null\",\"wolkite Gashu\",\"System Administrator\",\"wolkite prison\",\"Active\"],[\"null\",\"abushi Gashu\",\"Police Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Randy Bartoletti\",\"System Administrator\",\"gurage prison\",\"Active\"],[\"null\",\"Chadrick Hodkiewicz\",\"Discipline Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Carter Smith\",\"Security Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Yuri Logan\",\"Medical Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Ronan Briggs\",\"Training Officer\",\"kembata prison\",\"Active\"],[\"null\",\"Rogelio Hansen\",\"Police Officer\",\"kembata prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Colesdkadklfasdklfa\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walkersdas\",\"Training Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Immanuel Keeling\",\"Medical Officer\",\"kemba\",\"Active\"],[\"null\",\"Demond Nienow\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Jacques Fritsch\",\"Discipline Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Leonor Schiller\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"1\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"2\",\"null\",\"Prisoner\",\"abecho gode\",\"active\"],[\"3\",\"null\",\"Prisoner\",\"kemba\",\"active\"],[\"4\",\"null\",\"Prisoner\",\"Siltʼe Zone Prison\",\"active\"],[\"335\",\"null\",\"Prisoner\",\"hadya\",\"active\"],[\"336\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"337\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"338\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"339\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"340\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"341\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"342\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"343\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"344\",\"null\",\"Prisoner\",\"kembata prison\",\"released\"],[\"345\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"346\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"347\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"348\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"349\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"350\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"351\",\"null\",\"Prisoner\",\"hosseana prison\",\"active\"],[\"352\",\"null\",\"Prisoner\",\"Siltʼe Zone Prison\",\"active\"],[\"353\",\"null\",\"Prisoner\",\"gurage prison\",\"active\"],[\"354\",\"null\",\"Prisoner\",\"gurage prison\",\"active\"],[\"355\",\"null\",\"Prisoner\",\"Halaba Zone Prison\",\"active\"],[\"356\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"357\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"358\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"359\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"360\",\"null\",\"Prisoner\",\"worabe prison\",\"Incarcerated\"],[\"361\",\"null\",\"Prisoner\",\"worabe prison\",\"Incarcerated\"],[\"362\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"363\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"364\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"]]}','2025-05-26 20:47:01','2025-05-26 20:47:01',NULL),
(59,78,'annual','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"Prisoners\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 26, 2025\"},\"table\":[[\"Prisoner ID\",\"Name\",\"Prison\",\"Sentence\",\"Status\"],[\"1\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"337\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"338\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"339\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"340\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"341\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"342\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"343\",\"null\",\"worabe prison\",\"Unknown\",\"released\"],[\"356\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"357\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"358\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"359\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"360\",\"null\",\"worabe prison\",\"Unknown\",\"Incarcerated\"],[\"361\",\"null\",\"worabe prison\",\"Unknown\",\"Incarcerated\"],[\"362\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"363\",\"null\",\"worabe prison\",\"Unknown\",\"active\"],[\"364\",\"null\",\"worabe prison\",\"Unknown\",\"active\"]]}','2025-05-26 21:35:30','2025-05-26 21:35:30',NULL),
(60,78,'daily','{\"intro\":{\"title\":\"Prison Management System Report\",\"report_type\":\"All Accounts\",\"selected_prisons\":\"worabe prison\",\"generated_date\":\"May 26, 2025\"},\"table\":[[\"ID\",\"Name\",\"Role\",\"Prison\",\"Status\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"ato belete Gashu\",\"Staff\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashu\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"Habtamu Gashudasd\",\"Inspector\",\"worabe prison\",\"Active\"],[\"null\",\"ato bewlset chane\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"null\",\"tameru belw\",\"Security Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Christophe Colesdkadklfasdklfa\",\"Commissioner\",\"worabe prison\",\"Active\"],[\"null\",\"Eleanore Walkersdas\",\"Training Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Demond Nienow\",\"Police Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Jacques Fritsch\",\"Discipline Officer\",\"worabe prison\",\"Active\"],[\"null\",\"Leonor Schiller\",\"System Administrator\",\"worabe prison\",\"Active\"],[\"1\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"337\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"338\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"339\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"340\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"341\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"342\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"343\",\"null\",\"Prisoner\",\"worabe prison\",\"released\"],[\"356\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"357\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"358\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"359\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"360\",\"null\",\"Prisoner\",\"worabe prison\",\"Incarcerated\"],[\"361\",\"null\",\"Prisoner\",\"worabe prison\",\"Incarcerated\"],[\"362\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"363\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"],[\"364\",\"null\",\"Prisoner\",\"worabe prison\",\"active\"]]}','2025-05-26 21:37:28','2025-05-26 21:37:28',NULL);
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','transferred') DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `request_details` text DEFAULT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lawyer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `evaluation` text DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_prisoner_id` (`prisoner_id`),
  KEY `fk_requests_approved_by` (`approved_by`),
  KEY `fk_requests_lawyer` (`lawyer_id`),
  KEY `fk_requests_user` (`user_id`),
  KEY `fk_prison_id_for_request` (`prison_id`),
  CONSTRAINT `fk_prison_id_for_request` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prisoner_id` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_requests_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_requests_lawyer` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`lawyer_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_requests_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_requests_user` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES
(2182,'medical_assistance','pending',NULL,'kllklllk',342,'2025-05-26 03:42:47','2025-05-26 03:42:47',43,NULL,NULL,NULL),
(2183,'medical_assistance','approved',86,'mm',342,'2025-05-26 03:44:28','2025-05-26 03:46:59',43,NULL,'sdskdjs',6),
(2184,'appeal_filing','rejected',NULL,'mmsdkajskldjals',344,'2025-05-26 03:45:46','2025-05-26 03:47:06',43,NULL,'sdskdjsjd',6),
(2185,'prisoner_transfer','approved',80,'sss',338,'2025-05-26 04:50:58','2025-05-26 05:01:41',41,NULL,'jjj',6),
(2186,'human_rights_violation','approved',80,'adsdnasd',338,'2025-05-26 05:21:56','2025-05-27 00:03:28',41,NULL,'xcx',6),
(2187,'prison_transfer','approved',80,'dsdnsdms',356,'2025-05-26 05:24:47','2025-05-27 00:03:45',NULL,85,'sdsadkasd',6);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'System Administrator','gugui','2025-03-09 04:04:02','2025-03-09 04:04:02'),
(2,'Inspector','hhh','2025-03-09 04:07:59','2025-03-09 04:07:59'),
(3,'Central Administrator','this central admin controles overal syste','2025-03-09 04:15:29','2025-03-09 04:15:29'),
(4,'Visitor','lol am i vitor','2025-03-09 04:25:39','2025-03-09 04:25:39'),
(5,'Commissioner','zz','2025-03-09 04:28:38','2025-03-09 04:28:38'),
(6,'Training Officer','sfasf','2025-03-09 04:49:33','2025-03-09 04:49:33'),
(8,'Police Officer','Police officer role','2025-03-18 17:38:19','2025-03-18 17:38:19'),
(9,'Medical Officer','Medical officer for prisons','2025-04-04 16:10:47','2025-04-04 16:10:47'),
(10,'Security Officer','security for prisons','2025-04-04 16:12:39','2025-04-04 16:12:39'),
(11,'Discipline Officer',NULL,'2025-04-04 16:14:10','2025-04-04 16:14:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(20) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `type` enum('cell','medical','security','training','visitor','isolation') DEFAULT NULL,
  `status` enum('available','occupied','under_maintenance') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prison_rooms` (`prison_id`),
  CONSTRAINT `fk_prison_rooms` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES
(1,'11',2,'training','available','2025-03-10 20:55:40','2025-03-10 20:55:40',20),
(2,'12',21,'training','occupied','2025-03-10 20:57:21','2025-03-10 20:57:21',20),
(3,'13',2,'security','under_maintenance','2025-03-10 21:07:49','2025-03-10 21:07:49',6),
(4,'32',122,'medical','occupied','2025-03-10 21:08:23','2025-03-10 21:08:23',NULL),
(5,'122',1221,'medical','occupied','2025-03-10 21:08:43','2025-03-10 21:08:43',NULL),
(6,'1212',122,'security','available','2025-03-10 21:08:51','2025-03-10 21:08:51',NULL),
(7,'121',1212,'medical','occupied','2025-03-10 21:09:04','2025-03-10 21:09:04',NULL),
(8,'1221',122,'medical','occupied','2025-03-10 21:09:20','2025-03-10 21:09:20',NULL),
(9,'123',212,'medical','available','2025-03-10 21:09:38','2025-03-10 21:09:38',NULL),
(10,'33',1,'security','occupied','2025-03-10 21:09:51','2025-03-10 21:09:51',NULL),
(11,'333',3,'cell','available','2025-03-18 04:55:21','2025-03-18 04:55:21',10),
(12,'222',222,'cell','available','2025-03-18 04:58:33','2025-03-18 04:58:33',10),
(13,'3123',22,'cell','available','2025-03-18 18:40:09','2025-03-18 18:40:09',11),
(14,'234523',33,'cell','occupied','2025-03-18 20:11:54','2025-03-18 20:11:54',6),
(15,'2345',4,'medical','available','2025-03-18 20:12:40','2025-03-18 20:12:40',6),
(16,'777',7,'cell','available','2025-03-18 20:25:11','2025-03-18 20:25:11',6),
(17,'1',178,'cell','available','2025-03-22 06:54:31','2025-04-19 14:46:56',5),
(18,'44444',4,'cell','available','2025-03-23 17:42:52','2025-03-23 17:42:52',11),
(19,'2999',2,'cell','available','2025-03-31 03:07:31','2025-04-19 20:51:50',11),
(22,'2',96,'cell','available','2025-04-06 21:28:58','2025-04-19 14:46:48',5),
(26,'3',232232,'cell','available','2025-05-16 01:39:53','2025-05-16 01:39:53',11);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES
('fab9eUkxUU0bOkP0Jsg9HL3rAtNxG0qyJLHuBbZa',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToxNzp7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zeXNhZG1pbi9nZW5lcmF0ZV9yZXBvcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoidVN0QU5COGhhNDBIM29WRFloUzhrNTd5YUhMUmoycFhaZ0EzWm1sMSI7czo4OiJ1c2VybmFtZSI7czoyNzoic3lzdGVtYWRtaW53b3JhYmVAZ21haWwuY29tIjtzOjc6InVzZXJfaWQiO2k6Nzg7czo2OiJwcmlzb24iO3M6MTM6IndvcmFiZSBwcmlzb24iO3M6NToiZW1haWwiO3M6Mjc6InN5c3RlbWFkbWlud29yYWJlQGdtYWlsLmNvbSI7czo2OiJnZW5kZXIiO3M6NDoibWFsZSI7czo3OiJhZGRyZXNzIjtzOjk6IkRpcmUgRGF3YSI7czo1OiJwaG9uZSI7czoxMDoiMDk0MzM5MjMzMiI7czoxMDoiZmlyc3RfbmFtZSI7czoxMToiYXRvIGJld2xzZXQiO3M6OToibGFzdF9uYW1lIjtzOjU6ImNoYW5lIjtzOjEwOiJ1c2VyX2ltYWdlIjtzOjU2OiJ1c2VyX2ltYWdlcy9DYkRmSFVLSWlaNFlEMUQ0dnRGTDl2OWJPSU1maHM5Vld0ZU81QW9wLmpwZyI7czo5OiJwcmlzb25faWQiO2k6NjtzOjc6InJvbGVfaWQiO2k6MTtzOjg6InJvbGVuYW1lIjtzOjIwOiJTeXN0ZW0gQWRtaW5pc3RyYXRvciI7czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJDZRVXkuTE9IcXVtL0ZiL3hiWWttWC5nSUhELnlsUEFZTnhvdXRXOHlwY29pSmZyam02MEI2Ijt9',1748302018);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_logs`
--

DROP TABLE IF EXISTS `system_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `entity` enum('account','prison','prisoner','report','backup','request','medical_report','certification_record') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `system_logs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_logs`
--

LOCK TABLES `system_logs` WRITE;
/*!40000 ALTER TABLE `system_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_assignments`
--

DROP TABLE IF EXISTS `training_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prisoner_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('in_progress','completed') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `prisoner_id` (`prisoner_id`),
  KEY `training_id` (`training_id`),
  KEY `assigned_by` (`assigned_by`),
  CONSTRAINT `training_assignments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  CONSTRAINT `training_assignments_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `training_programs` (`id`),
  CONSTRAINT `training_assignments_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_assignments`
--

LOCK TABLES `training_assignments` WRITE;
/*!40000 ALTER TABLE `training_assignments` DISABLE KEYS */;
INSERT INTO `training_assignments` VALUES
(1,NULL,NULL,74,'2025-04-11','0000-00-00',NULL,'2025-04-05 02:25:43','2025-04-05 02:52:30'),
(2,NULL,NULL,74,'2025-04-17','0000-00-00',NULL,'2025-04-05 02:34:01','2025-04-05 02:52:35'),
(3,NULL,NULL,74,'2025-04-04','0000-00-00',NULL,'2025-04-05 02:55:57','2025-04-05 03:05:05'),
(4,NULL,NULL,74,'2025-04-17','0000-00-00',NULL,'2025-04-05 03:05:16','2025-04-05 20:36:15'),
(5,NULL,NULL,74,'2025-04-17','0000-00-00',NULL,'2025-04-05 03:05:23','2025-04-10 19:25:44'),
(6,NULL,NULL,74,'2025-04-24','0000-00-00',NULL,'2025-04-05 03:05:33','2025-04-06 01:49:44'),
(7,NULL,NULL,74,'2025-04-18','0000-00-00',NULL,'2025-04-06 01:49:33','2025-04-10 19:25:55'),
(8,354,222,68,'2025-04-11','0000-00-00','in_progress','2025-04-06 21:31:08','2025-04-06 21:31:08'),
(9,NULL,NULL,NULL,'2025-04-17','0000-00-00',NULL,'2025-04-07 16:35:39','2025-04-07 16:36:07'),
(10,3,219,NULL,'2025-05-01','0000-00-00','in_progress','2025-04-07 16:35:51','2025-04-07 16:35:51'),
(11,NULL,NULL,74,'2025-04-17','0000-00-00',NULL,'2025-04-10 19:24:58','2025-04-10 19:25:57'),
(12,NULL,NULL,74,'2025-04-16','0000-00-00',NULL,'2025-04-10 19:25:19','2025-04-10 19:25:54'),
(13,336,225,74,'2025-04-18','0000-00-00','in_progress','2025-04-10 19:26:42','2025-04-10 19:26:42'),
(14,NULL,NULL,74,'2025-04-24','0000-00-00',NULL,'2025-04-16 14:48:00','2025-04-16 14:48:05'),
(15,NULL,NULL,81,'2025-05-09','0000-00-00',NULL,'2025-05-10 02:21:26','2025-05-10 03:27:26'),
(16,NULL,NULL,81,'2025-05-14','2025-05-10',NULL,'2025-05-10 18:50:20','2025-05-10 18:53:30'),
(17,342,240,81,'2025-05-10','2025-05-10','completed','2025-05-10 18:50:47','2025-05-10 18:50:47'),
(18,339,238,81,'2025-05-08','2025-05-10','completed','2025-05-10 18:54:04','2025-05-10 18:54:04'),
(19,340,241,81,'2025-05-08','2025-05-22','completed','2025-05-11 03:23:13','2025-05-21 05:15:07'),
(20,NULL,NULL,74,'2025-05-16','2025-05-30',NULL,'2025-05-11 18:37:51','2025-05-11 18:41:08'),
(21,NULL,NULL,74,'2025-05-13','2025-05-21',NULL,'2025-05-11 18:50:38','2025-05-11 18:54:27'),
(22,NULL,NULL,74,'2025-05-12','2025-05-14',NULL,'2025-05-11 19:44:57','2025-05-11 21:09:02'),
(23,1,225,74,'2025-05-11','2025-05-13','completed','2025-05-11 21:09:24','2025-05-12 00:52:59'),
(24,NULL,NULL,74,'2025-05-16','2025-05-17',NULL,'2025-05-16 01:51:30','2025-05-16 01:51:39'),
(25,NULL,NULL,81,'2025-05-22','2025-05-23',NULL,'2025-05-21 16:05:06','2025-05-25 21:22:56'),
(26,NULL,NULL,81,'2025-05-10','2025-05-29',NULL,'2025-05-25 12:13:07','2025-05-25 12:13:53'),
(27,NULL,NULL,81,'2025-05-18','2025-05-28',NULL,'2025-05-25 20:07:21','2025-05-25 20:07:34'),
(28,359,240,81,'2025-05-26','2025-05-31','in_progress','2025-05-25 21:23:29','2025-05-25 21:23:29');
/*!40000 ALTER TABLE `training_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_programs`
--

DROP TABLE IF EXISTS `training_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `fk_training_programs_prison` (`prison_id`),
  CONSTRAINT `fk_training_programs_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `training_programs_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_programs`
--

LOCK TABLES `training_programs` WRITE;
/*!40000 ALTER TABLE `training_programs` DISABLE KEYS */;
INSERT INTO `training_programs` VALUES
(219,'vocal','this is the first vocal',74,'2025-04-05 00:58:37','2025-04-05 01:20:00',NULL),
(222,'DDnn','ajkdfaskdf',NULL,'2025-04-05 02:00:42','2025-04-05 02:00:42',5),
(223,'jjjj','jjj',NULL,'2025-04-06 21:30:53','2025-04-06 21:30:53',5),
(224,'we','ew',NULL,'2025-04-10 19:23:32','2025-04-10 19:23:32',NULL),
(225,'commuinity','this the new',NULL,'2025-04-10 19:26:28','2025-04-10 19:26:28',5),
(238,'DD','gg',81,'2025-05-10 03:51:38','2025-05-10 03:51:38',6),
(239,'DD','gg',81,'2025-05-10 03:55:05','2025-05-10 03:55:05',6),
(240,'vocaleee','ee',81,'2025-05-10 18:45:21','2025-05-10 18:45:21',6),
(241,'fghfghc','zcvhv',81,'2025-05-11 03:22:05','2025-05-11 03:22:05',6);
/*!40000 ALTER TABLE `training_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visiting_requests`
--

DROP TABLE IF EXISTS `visiting_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `visiting_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_id` int(11) DEFAULT NULL,
  `requested_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prisoner_firstname` varchar(255) DEFAULT NULL,
  `prisoner_middlename` varchar(255) DEFAULT NULL,
  `prisoner_lastname` varchar(255) DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approved_by` (`approved_by`),
  KEY `idx_prison_id` (`prison_id`),
  CONSTRAINT `visiting_requests_ibfk_2` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`),
  CONSTRAINT `visiting_requests_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visiting_requests`
--

LOCK TABLES `visiting_requests` WRITE;
/*!40000 ALTER TABLE `visiting_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `visiting_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `identification_number` varchar(100) DEFAULT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `identification_number` (`identification_number`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitors`
--

LOCK TABLES `visitors` WRITE;
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
INSERT INTO `visitors` VALUES
(2,'Habtamu','Gashu','0909029295','eee','Bahir dar','2323','habyesuuuuuuuuuuuuuuuuuuuuuu@gmail.com','$2y$12$8y9BWQ39rUYSw4zpoKTGSuz/AVN8chouFKjl0TMaCu2s90j.1HtYW','2025-04-03 21:50:21','2025-04-03 21:50:21'),
(3,'TaShya','Walsh','+1 (252) 961-6605','Dolores quia aut odi','Modi consequatur Pl','15','losikazofu','$2y$12$NSF9paRS6bo57/0kBYdAIOtYn.knVGASc5rYbo1ds6HYkg5ogIMV6','2025-04-07 04:09:04','2025-04-07 04:09:04'),
(5,'Jaylen','King','407-014-9588','Deserunt','20502 Minnie Turnpikescv','459','Bernadette_Davis@gmail.com','$2y$12$5R/nIYgBTsv2SGvhEFHWZerZmZOjC5Ev9ae2M2SlrzBPFVlauQj5G','2025-04-07 04:33:52','2025-05-17 03:19:40'),
(6,'Geo','Orn','155-638-4077','Harum','8569 Cade Neck','206','Lula.Batz','$2y$12$emSLXoXw5HGdLscblExqTuiu2A4brQjlxfWwx07BBhWgVraI4Gu0K','2025-04-07 04:37:01','2025-04-07 04:37:01'),
(7,'Trystan','Dibbert','761-160-3700','Sint tempore','574 Schinner Mall','392','your.email+fakedata60508@gmail.com','$2y$12$pGMGy3qK6fiRvEqwk4/xI.a6a3bVvZaJSHEB.uD02gb8YR6gYV3Xe','2025-04-07 04:52:03','2025-04-07 04:52:03'),
(8,'Kaci','Thiel','614-495-0695','Possimus id blanditiis.','8342 Batz Ways','589','sssssss@gmail.com','$2y$12$kKp8MYXSww4lsfeCxsFKsu5uBm.qc81ruyTK9tzT3sPf3JVClWXh2','2025-04-07 04:53:30','2025-04-07 04:53:30'),
(9,'Habtamu','Gashu','0909029295','ss','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','worabeinss@gmail.com','Habtshss@gmail.com','$2y$12$59E/lggzmD.1k/7.u5Aineh71rv7bOIsKshq3HSkga2kqLrspGnGm','2025-04-10 14:38:49','2025-04-10 14:38:49'),
(10,'Habtamu','Gashu','0909029295','eee','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','1212121212','1asas@gmail.com','$2y$12$VC9jRnufr54NlgTat4vSz.CuFJDO8Z7hL3oIRNBFM/vfnJqILo/wW','2025-04-10 14:40:15','2025-04-10 14:40:15'),
(11,'gemchis','zerfu','0909029295','family','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','23123123123','gemchisz@gmail.com','$2y$12$NQ9wMR3lW/YEkyPc4tk.SOWF9eTJbl.3y3.r/lZx.uSyNCoNPKxcW','2025-04-10 14:41:42','2025-04-10 14:41:42'),
(12,'gemchis','Gashu','0909029295','Dolores quia aut odi','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','sdasd@gmail.com','asdas@gmail.com','$2y$12$U0zFo4JFjGfa7bQ2eJPS4.Q7ugNYlihikX/OmPZH4LJfIvZpj8Spm','2025-04-10 14:44:12','2025-04-10 14:44:12'),
(13,'Habtamu','Gashu','0909029295','Dolores quia aut odi','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','2234525','Habtsha2022351@gmail.com','$2y$12$QAJgVk4mB2fSf9tQTDllwOXlLgFYsGhkEnkIkbv9V15mMf9oPQuoS','2025-04-10 14:47:20','2025-04-10 14:47:20'),
(14,'ddd','Gashu','0909029295','rr','Bahir dar','ssector@gmail.com','ss021@gmail.com','$2y$12$rwRpd6a4IrsowDeDm/e6O.p0LI4Z4f4Jp0P7TyRmqxy5PGXr05.gW','2025-04-10 14:48:21','2025-04-10 14:48:21'),
(15,'Habtamu','Gashu','0909029295','eee','Bahir dar','12123123123','visitor@gmail.com','$2y$12$044UttdVKDbnFZbvMLYVc.tpyLpF1iKx5Jpipwvmopcn1tQAelgoW','2025-04-10 14:49:15','2025-04-10 14:49:15'),
(16,'Habtamu','Gashu','0909029295','eee','Bahir dar','21233124123412342','vi@gmail.com','$2y$12$F2lpP5PYnm6n6wg.uRFqIOmYK8864JWrkfAndvqmgPhKqgoAfdgwq','2025-04-10 14:49:41','2025-04-10 14:49:41'),
(17,'Habtamu','Gashu','0909029295','eee','Bahir dar','121212','amare@gmail.com','$2y$12$cKIhEgIkjreJQruMI8CpQ.NS7SrCGjJOx99kIpOAPVkI0zOIpVVX6','2025-04-10 19:33:49','2025-04-10 19:33:49'),
(18,'Habtamu','Gashu','0909029295','ss','Bahir dar','12212122','Habtsha2021@gmail.com','$2y$12$qdQuaJnEPYkLk7/5/4JG3OzFioNwghfDlNcSC7ELy.H2BuPhoUeUe','2025-04-10 19:43:38','2025-04-10 19:43:38'),
(19,'Habtamu','Gashu','0909029295','Family','Bahir dar\r\nBahir dar,Ethiopia','21212','vis@gmail.com','$2y$12$/KLtEaFupC3XwZpYme4lX.ZeRBn63.m4MduD6i5aNBK9lgYdiS3Zy','2025-04-11 18:57:26','2025-04-11 18:57:26'),
(20,'Habtamu','Gashu','0909029295','Family','Bahir dar,Ethiopia','65456465','kafogawa@mailinator.com','$2y$12$g7qBw5GfnYi0.GeP7tP2Iu5id8b9valNFbBGEWa5bGTWS/H/gjxhi','2025-04-18 15:28:37','2025-04-18 15:28:37'),
(21,'Habtamu','Gashu','0909029295','asas','Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam','asd2','asdasdHabtsha2021@gmail.com','$2y$12$bVJbmEnMvKbyfa0z52joI.49yi51UDRFegxcLVPDZ7mROU4mOxgH.','2025-04-29 14:50:13','2025-04-29 14:50:13');
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-26 19:26:59
