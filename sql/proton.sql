CREATE DATABASE  IF NOT EXISTS `proton` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proton`;
-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: proton
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Message` (
  `MessageID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  `Time` int(10) unsigned NOT NULL,
  `SpamScore` float unsigned DEFAULT NULL,
  `Header` text COLLATE utf8mb4_unicode_ci,
  `Body` text COLLATE utf8mb4_unicode_ci,
  `isSpam` tinyint(4) DEFAULT NULL,
  `AuthType` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `Message` DISABLE KEYS */;
INSERT INTO `Message` VALUES (3,1,1502929401,0,'Return-Path: <2017062818244549a62a320d354447818b28158020p0na-C19WUOQGH538F3@bounces.amazon.com>\nX-Original-To: dcl@protonmail.com\nReceived: from a15-197.smtp-out.amazonses.com (a15-197.smtp-out.amazonses.com\n [54.240.15.197]) (using TLSv1 with cipher ECDHE-RSA-AES128-SHA (128/128 bits)) (No\n client certificate requested) by mail5i.protonmail.ch (Postfix) with ESMTPS id 834E81611\n for <dcl@protonmail.com>; Wed, 28 Jun 2017 14:24:48 -0400 (EDT)\nAuthentication-Results: mail5i.protonmail.ch; dmarc=pass (p=quarantine dis=none)\n header.from=amazon.com\nAuthentication-Results: mail5i.protonmail.ch; spf=pass\n smtp.mailfrom=2017062818244549a62a320d354447818b28158020p0na-C19WUOQGH538F3@bounces.amazon.com\nAuthentication-Results: mail5i.protonmail.ch; dkim=pass (1024-bit key)\n header.d=amazon.com header.i=@amazon.com header.b=\"eVI5Ulpc\"; dkim=pass (1024-bit key)\n header.d=amazonses.com header.i=@amazonses.com header.b=\"AAODPVgR\"\nDkim-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/simple;\n s=taugkdi5ljtmsua4uibbmo5mda3r2q3v; d=amazon.com; t=1498674286;\n h=Date:From:To:Message-ID:Subject:MIME-Version:Content-Type;\n bh=3GnViQUd73cZhAoSSdugJgXQZojDPthyXDyQqTUCMOU=;\n b=eVI5UlpcntK2RhULkojt5fODJtqc0HWpzvLvK91DLyfuOyHDNprbM1jbGETlt7ED\n GIruPF5THtAtvMJ68csCgUcB26Sh6A0KKR/csvQhW1YjJhhRyrwJuG8YlDF9o+EAwGV\n WheEHd0VnYPnWNUK4XMDp9/LqsCGqKADIuheh4bE=\nDkim-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/simple;\n s=224i4yxa5dv7c2xz3womw6peuasteono; d=amazonses.com; t=1498674286;\n h=Date:From:To:Message-ID:Subject:MIME-Version:Content-Type:Feedback-ID;\n bh=3GnViQUd73cZhAoSSdugJgXQZojDPthyXDyQqTUCMOU=;\n b=AAODPVgRFuoTdHoTOUsFixIw4f/+73NUYvfrj86XXQzb1CeB899ZNvuXG9wCTJNM\n nSNlSUvkgSiUFQERDCG8RjOOiC3YbpVl803AIyLbOM5BnoumfNhEnEjuIcylKfCwH7/\n euYSeJ0hopgouuC8G56vYMKsh2QpQl6rkYSRHeCg=\nDate: Wed, 28 Jun 2017 18:24:45 +0000\nFrom: \"Amazon.com\" <store-news@amazon.com>\nTo: \"dcl@protonmail.com\" <dcl@protonmail.com>\nMessage-Id: <0100015ceff2cc13-c842b0b2-084f-4aba-988d-8b5452261d69-000000@email.amazonses.com>\nSubject: Last chance to save on $5 magazines\nMime-Version: 1.0\nContent-Type: text/html\nX-Amazon-Rte-Version: 2.0\nX-Amazon-Metadata: CA=C19WUOQGH538F3-CU=A116WV4PRGDUG2-RI=A3NH5XN3W1IV5P\nBounces-To: 2017062818244549a62a320d354447818b28158020p0na-C19WUOQGH538F3@bounces.amazon.com\nX-Amazon-Mail-Relay-Type: merchandizing\nX-Original-Messageid: <urn.correios.msg.2017062818244549a62a320d354447818b28158020p0na@1498674285517.mms-na-m4e-f1e553e2.us-east-1.amazon.com>\nX-Ses-Outgoing: 2017.06.28-54.240.15.197\nFeedback-Id: 1.us-east-1.+gzE1S+MWTFXXYmwxo7wkk651GMxMPAUFYiyN/09X40=:AmazonSES\nX-Spam-Status: No, score=-7.6 required=4.0 tests=DKIM_SIGNED,DKIM_VALID,\n DKIM_VALID_AU,HTML_MESSAGE,RCVD_IN_DNSWL_NONE,SPF_PASS,USER_IN_DEF_SPF_WL autolearn=ham\n autolearn_force=no version=3.4.1\n','0',1,'spf','bounces.amazon.com');
/*!40000 ALTER TABLE `Message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reputation`
--

DROP TABLE IF EXISTS `Reputation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reputation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) DEFAULT NULL,
  `auth_type` varchar(45) DEFAULT NULL,
  `count_autospam` int(11) DEFAULT NULL,
  `count_autononspam` int(11) DEFAULT NULL,
  `count_manual_spam` int(11) DEFAULT NULL,
  `count_manual_nonspam` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reputation`
--

LOCK TABLES `Reputation` WRITE;
/*!40000 ALTER TABLE `Reputation` DISABLE KEYS */;
INSERT INTO `Reputation` VALUES (1,'google.com','spf',2,10,0,1,12,90),(2,'amazon.com','dkim',2,10,0,1,12,90),(3,'bounces.amazon.com','spf',4,22,3,4,26,92);
/*!40000 ALTER TABLE `Reputation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spam_threshold` int(11) DEFAULT NULL,
  `last_spam_update` datetime DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'dcl@protonmail.com',50,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_Spam_Action`
--

DROP TABLE IF EXISTS `User_Spam_Action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User_Spam_Action` (
  `user_id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `is_spam` tinyint(4) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_Spam_Action`
--

LOCK TABLES `User_Spam_Action` WRITE;
/*!40000 ALTER TABLE `User_Spam_Action` DISABLE KEYS */;
INSERT INTO `User_Spam_Action` VALUES (1,3,1,'2017-08-17 00:56:43');
/*!40000 ALTER TABLE `User_Spam_Action` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-17  1:49:58
