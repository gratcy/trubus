CREATE DATABASE  IF NOT EXISTS `niaga_swadaya_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `niaga_swadaya_db`;
-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: niaga_swadaya_db
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.13.04.1

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
-- Table structure for table `access_tab`
--

DROP TABLE IF EXISTS `access_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_tab` (
  `aid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `agid` int(4) unsigned NOT NULL,
  `apid` int(10) DEFAULT NULL,
  `aaccess` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_tab`
--

LOCK TABLES `access_tab` WRITE;
/*!40000 ALTER TABLE `access_tab` DISABLE KEYS */;
INSERT INTO `access_tab` VALUES (1,2,1,0),(2,2,2,0),(3,2,3,1),(4,2,4,1),(5,2,5,0);
/*!40000 ALTER TABLE `access_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjustment_tab`
--

DROP TABLE IF EXISTS `adjustment_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjustment_tab` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `abcid` int(10) DEFAULT NULL,
  `aidid` int(10) DEFAULT NULL,
  `atype` tinyint(1) DEFAULT '1',
  `aatype` tinyint(1) DEFAULT NULL,
  `adate` int(10) DEFAULT NULL,
  `astockbegining` int(10) DEFAULT NULL,
  `astockin` int(10) DEFAULT NULL,
  `astockout` int(10) DEFAULT NULL,
  `astockreject` int(10) DEFAULT NULL,
  `astockretur` int(10) DEFAULT NULL,
  `atotal` int(10) DEFAULT NULL,
  `astock` int(10) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjustment_tab`
--

LOCK TABLES `adjustment_tab` WRITE;
/*!40000 ALTER TABLE `adjustment_tab` DISABLE KEYS */;
INSERT INTO `adjustment_tab` VALUES (1,1,1,1,1,1403381242,0,0,0,0,0,10,10),(2,1,2,1,1,1403381242,0,0,0,0,0,2,10),(3,1,3,1,0,1403381242,0,0,0,0,0,4,0),(4,1,4,1,1,1403381242,0,0,0,0,0,5,10);
/*!40000 ALTER TABLE `adjustment_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area_tab`
--

DROP TABLE IF EXISTS `area_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_tab` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `aname` varchar(150) DEFAULT NULL,
  `adesc` varchar(350) DEFAULT NULL,
  `astatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_tab`
--

LOCK TABLES `area_tab` WRITE;
/*!40000 ALTER TABLE `area_tab` DISABLE KEYS */;
INSERT INTO `area_tab` VALUES (1,'Gramedia','Area Gramedia',1),(2,'Gunung Agung','Area Gunung Agung',1),(3,'Outlet','Area Outlet',1),(4,'Tisera','Area Tisera',1),(5,'Tradisional','Area Tradisional',1);
/*!40000 ALTER TABLE `area_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arsip_tab`
--

DROP TABLE IF EXISTS `arsip_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arsip_tab` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `abid` int(10) DEFAULT NULL,
  `acid` int(10) DEFAULT NULL,
  `atitle` varchar(150) DEFAULT NULL,
  `adesc` varchar(350) DEFAULT NULL,
  `adate` int(10) DEFAULT NULL,
  `afile` varchar(300) DEFAULT NULL,
  `asize` int(10) DEFAULT NULL,
  `astatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arsip_tab`
--

LOCK TABLES `arsip_tab` WRITE;
/*!40000 ALTER TABLE `arsip_tab` DISABLE KEYS */;
INSERT INTO `arsip_tab` VALUES (1,6,1,'wewe','wew',1418100323,'1413433258543f47aa41b83rc4_2008.rar',5049,1),(2,5,1,'aaaaaaaa','eeeeeeeeee',1418100319,'1413443821543f70ed2c787GRATCYPA0201_1312307582.CSV',2490,1),(3,5,2,'aaaaaa','aaaaaa',1418102143,'1413443833543f70f976aderincian.xlsx',9070,1);
/*!40000 ALTER TABLE `arsip_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_group_tab`
--

DROP TABLE IF EXISTS `books_group_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_group_tab` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bcode` varchar(50) DEFAULT NULL,
  `bname` varchar(150) DEFAULT NULL,
  `bdesc` varchar(350) DEFAULT NULL,
  `bparent` int(10) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_group_tab`
--

LOCK TABLES `books_group_tab` WRITE;
/*!40000 ALTER TABLE `books_group_tab` DISABLE KEYS */;
INSERT INTO `books_group_tab` VALUES (1,'01','Perikanan','Perikanan',0,1),(2,'02','Pertanian','Pertanian',0,1),(3,'03','Umbi','Umbi',2,1),(4,'04','Sawah','Sawah',2,1);
/*!40000 ALTER TABLE `books_group_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_tab`
--

DROP TABLE IF EXISTS `books_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_tab` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bcode` varchar(30) DEFAULT NULL,
  `bauthor` varchar(150) DEFAULT NULL,
  `bpublisher` int(10) DEFAULT NULL,
  `bgroup` int(10) DEFAULT NULL,
  `btitle` varchar(300) DEFAULT NULL,
  `btax` tinyint(1) DEFAULT '0',
  `bprice` int(10) DEFAULT NULL,
  `bpack` tinyint(1) DEFAULT '0',
  `bdisc` int(3) DEFAULT '0',
  `bisbn` varchar(30) DEFAULT NULL,
  `bhw` varchar(10) DEFAULT NULL,
  `bmonthyear` varchar(10) DEFAULT NULL,
  `btotalpages` int(10) DEFAULT NULL,
  `bcover` varchar(300) DEFAULT NULL,
  `bdesc` varchar(350) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_tab`
--

LOCK TABLES `books_tab` WRITE;
/*!40000 ALTER TABLE `books_tab` DISABLE KEYS */;
INSERT INTO `books_tab` VALUES (1,'010201','palma',1,1,'wew',1,100000,1,10,'10101001','121*12','06/2004',1000,'141456964354509eabcb96bwe.jpg','test',1),(2,'020102','palma',2,1,'Buku satu',0,10000,1,10,'100','1*1','02/2014',1000,'1414666137545217995a4bbNikita.jpg','2002',1),(3,'B0005','palma',3,1,'Buku Baru',1,789987,1,12,'78980809','1*1','06/2014',1000,'1414666164545217b40e558aw.jpg','okkk',1),(4,'020104','palma',2,1,'Awal',0,1500,1,20,'AWAL','1*1','01/2014',1000,'1414666212545217e4e53212.500.000 Heles Senter.jpg','Buku',1),(5,'020105','palma',2,1,'Video.js Flash Example',1,1110,2,1,'10101001','121*12','08/2014',1000,'14145702095450a0e13132alove.jpg','wwwwwwww',1);
/*!40000 ALTER TABLE `books_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch_tab`
--

DROP TABLE IF EXISTS `branch_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch_tab` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bname` varchar(150) DEFAULT NULL,
  `bhname` varchar(150) DEFAULT NULL,
  `bnpwp` varchar(20) DEFAULT NULL,
  `baddr` text,
  `bcity` int(10) DEFAULT NULL,
  `bprovince` int(10) DEFAULT NULL,
  `bphone` varchar(50) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch_tab`
--

LOCK TABLES `branch_tab` WRITE;
/*!40000 ALTER TABLE `branch_tab` DISABLE KEYS */;
INSERT INTO `branch_tab` VALUES (1,'Pusat','Moch. Awaludin','31.456.567.2.003.000','Gunung Sahari',1,2,'121212*1213',1),(2,'Perwakilan Daerah Bandung','sssssss','31.587.460.2.003.000','Bandung',2,1,'8798798979*8799898798',1),(3,'Perwakilan Jogjakarta','Budi Atmojo','31.587.460.2.003.000','jogja',7,3,'000*000',1),(4,'Perwakilan Medan','Rofingi','31.587.460.2.003.000','MEDAN',3,4,'000*000',1),(5,'Perwakilan Palembang','taufik ','31.587.460.2.003.000','wew',5,5,'43535*324324',1),(6,'Perwakilan Surabaya','Budi Atmojo','31.587.460.2.003.000','Surabaya',6,7,'435454*111111111',1),(7,'Perwakilan Makasar','Deltha','31.587.460.2.003.000','Makasar',4,6,'43545*121212',1);
/*!40000 ALTER TABLE `branch_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalog_books_tab`
--

DROP TABLE IF EXISTS `catalog_books_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalog_books_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `ccid` int(10) DEFAULT NULL,
  `cbid` int(10) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalog_books_tab`
--

LOCK TABLES `catalog_books_tab` WRITE;
/*!40000 ALTER TABLE `catalog_books_tab` DISABLE KEYS */;
INSERT INTO `catalog_books_tab` VALUES (1,4,3,1),(2,4,4,2),(3,4,4,1),(4,2,4,1);
/*!40000 ALTER TABLE `catalog_books_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalog_tab`
--

DROP TABLE IF EXISTS `catalog_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalog_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cbid` int(10) DEFAULT NULL,
  `ctitle` varchar(150) DEFAULT NULL,
  `cdesc` varchar(350) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalog_tab`
--

LOCK TABLES `catalog_tab` WRITE;
/*!40000 ALTER TABLE `catalog_tab` DISABLE KEYS */;
INSERT INTO `catalog_tab` VALUES (1,1,'waw','wwwwwwww',1),(2,2,'wew','wwwwwwwwwwwwww',1),(3,5,'wow','wwwwwwwwwww',1),(4,5,'test catalog','test catalog',1);
/*!40000 ALTER TABLE `catalog_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_tab`
--

DROP TABLE IF EXISTS `categories_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) DEFAULT NULL,
  `cdesc` varchar(350) DEFAULT NULL,
  `ctype` tinyint(1) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  `cparent` int(10) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_tab`
--

LOCK TABLES `categories_tab` WRITE;
/*!40000 ALTER TABLE `categories_tab` DISABLE KEYS */;
INSERT INTO `categories_tab` VALUES (1,'palma','palmass',1,1,0),(2,'gratcy','palma',1,1,1),(3,'hutapea','wew',1,1,0),(4,'wew','wew',1,1,1);
/*!40000 ALTER TABLE `categories_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_tab`
--

DROP TABLE IF EXISTS `city_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(150) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_tab`
--

LOCK TABLES `city_tab` WRITE;
/*!40000 ALTER TABLE `city_tab` DISABLE KEYS */;
INSERT INTO `city_tab` VALUES (1,'Jakarta',1),(2,'Bandung',1),(3,'Medan',1),(4,'Makasar',1),(5,'Palembang',1),(6,'Surabaya',1),(7,'Jogjakarta',1);
/*!40000 ALTER TABLE `city_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coa_tab`
--

DROP TABLE IF EXISTS `coa_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coa_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `catype` int(2) DEFAULT NULL,
  `ctype` tinyint(1) DEFAULT '0',
  `ccode` varchar(50) DEFAULT NULL,
  `cname` varchar(150) DEFAULT NULL,
  `csaldo` int(10) DEFAULT NULL,
  `cdebet` int(10) DEFAULT NULL,
  `ccredit` int(10) DEFAULT NULL,
  `cdesc` varchar(300) DEFAULT NULL,
  `cparent` int(10) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coa_tab`
--

LOCK TABLES `coa_tab` WRITE;
/*!40000 ALTER TABLE `coa_tab` DISABLE KEYS */;
INSERT INTO `coa_tab` VALUES (1,2,1,'asas','Semarang',10111,NULL,NULL,'asasa',0,1),(2,1,0,'1101','Bank',0,NULL,NULL,'wewe',0,1),(3,1,0,'1231','BCA',0,NULL,NULL,'232',2,1),(4,1,0,'2323','Mandiri',0,NULL,NULL,'wwwww',2,1),(5,1,0,'11011','Finance',0,NULL,NULL,'Finance',4,1),(6,1,0,'AD','Jakarta',0,NULL,NULL,'Test',0,1);
/*!40000 ALTER TABLE `coa_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_group_tab`
--

DROP TABLE IF EXISTS `customer_group_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_group_tab` (
  `cgid` int(10) NOT NULL AUTO_INCREMENT,
  `cgcode` varchar(50) DEFAULT NULL,
  `cgname` varchar(150) DEFAULT NULL,
  `cgdesc` varchar(350) DEFAULT NULL,
  `cgstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cgid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_group_tab`
--

LOCK TABLES `customer_group_tab` WRITE;
/*!40000 ALTER TABLE `customer_group_tab` DISABLE KEYS */;
INSERT INTO `customer_group_tab` VALUES (1,'CUS0001','Gramedia','Gramedia Group',1),(2,'CUS002','Non Gramedia','Non Gramed',1),(3,'CUS003','Perwakilan','Perwakilan',1);
/*!40000 ALTER TABLE `customer_group_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_tab`
--

DROP TABLE IF EXISTS `customer_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cbid` int(10) DEFAULT NULL,
  `ccode` varchar(10) DEFAULT NULL,
  `cname` varchar(150) DEFAULT NULL,
  `cnametax` varchar(150) DEFAULT NULL,
  `caddrtax` text,
  `caddr` text,
  `ccity` int(10) DEFAULT NULL,
  `cprovince` int(10) DEFAULT NULL,
  `cphone` varchar(31) DEFAULT NULL,
  `cemail` varchar(30) DEFAULT NULL,
  `cnpwp` varchar(30) DEFAULT NULL,
  `cnpwplong` varchar(150) DEFAULT NULL,
  `cdisc` int(10) DEFAULT NULL,
  `ctax` tinyint(1) DEFAULT '0',
  `cgroup` int(10) DEFAULT NULL,
  `carea` int(10) DEFAULT NULL,
  `ccreditlimit` int(10) DEFAULT NULL,
  `ccredittime` int(11) DEFAULT NULL,
  `ctype` tinyint(1) DEFAULT NULL,
  `cdesc` varchar(350) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_tab`
--

LOCK TABLES `customer_tab` WRITE;
/*!40000 ALTER TABLE `customer_tab` DISABLE KEYS */;
INSERT INTO `customer_tab` VALUES (1,1,'0010101','palma',NULL,NULL,'jakarta',1,1,'9130193039*232323','admin@adminc.om','12i01380138',NULL,10,1,1,1,1,0,1,'',1),(2,1,'0010102','Toko Buku Gramedia',NULL,NULL,'Jl. Cipinang Cempedak 2 No. 45 A Jakarta Timur 13340',1,1,'987890809*89809890','ss@ss.com','900989-',NULL,8,0,1,1,10000,0,2,'',1),(3,4,'0040103','ABCDE',NULL,NULL,'Jakarta',1,0,'98090-9-888*676887','fff@gg.com','879878',NULL,10,0,1,1,15,0,1,'',1),(4,8,'0080104','Gramedia Jakarta',NULL,NULL,'Jl. Cipinang Cempedak 2 No. 45 A Jakarta Timur 13340',1,1,'9808809*09808080','tes@tes.com','080989089',NULL,10,1,1,1,0,0,2,'',1),(5,4,'0040105','admins',NULL,NULL,'jakaarta',1,1,'987898979*121212','palmagratcy@gmail.com','86876799898',NULL,11,1,NULL,1,10000000,0,0,'wewe',1);
/*!40000 ALTER TABLE `customer_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribution_book_tab`
--

DROP TABLE IF EXISTS `distribution_book_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribution_book_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `ddrid` int(10) DEFAULT NULL,
  `dbid` int(10) DEFAULT NULL,
  `dqty` int(10) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribution_book_tab`
--

LOCK TABLES `distribution_book_tab` WRITE;
/*!40000 ALTER TABLE `distribution_book_tab` DISABLE KEYS */;
INSERT INTO `distribution_book_tab` VALUES (1,1,1,1000,1),(2,1,2,1000,1),(3,1,3,10000,1),(4,2,2,1,2),(5,2,3,10,2),(7,2,1,12,2),(8,2,2,1,2),(9,2,2,122,1),(10,2,3,NULL,2),(11,2,1,122,1),(12,2,3,NULL,2),(13,3,2,900,1),(14,3,3,800,1),(15,4,1,1000,1),(16,4,2,1,1),(17,4,3,1,1);
/*!40000 ALTER TABLE `distribution_book_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribution_request_tab`
--

DROP TABLE IF EXISTS `distribution_request_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribution_request_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `dbfrom` int(10) DEFAULT NULL,
  `dbto` int(10) DEFAULT NULL,
  `ddate` int(10) DEFAULT NULL,
  `dtitle` varchar(150) DEFAULT NULL,
  `ddesc` varchar(350) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribution_request_tab`
--

LOCK TABLES `distribution_request_tab` WRITE;
/*!40000 ALTER TABLE `distribution_request_tab` DISABLE KEYS */;
INSERT INTO `distribution_request_tab` VALUES (1,5,4,1404722046,'wews','wew',1),(2,5,6,1404848643,'wew','desc',1),(3,5,8,1404833133,'oio','wew',3),(4,6,1,1405052181,'Reques','req',3);
/*!40000 ALTER TABLE `distribution_request_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribution_tab`
--

DROP TABLE IF EXISTS `distribution_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribution_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `ddrid` int(10) DEFAULT NULL,
  `ddocno` varchar(10) DEFAULT NULL,
  `ddate` int(10) DEFAULT NULL,
  `dtitle` varchar(150) DEFAULT NULL,
  `ddesc` varchar(350) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribution_tab`
--

LOCK TABLES `distribution_tab` WRITE;
/*!40000 ALTER TABLE `distribution_tab` DISABLE KEYS */;
INSERT INTO `distribution_tab` VALUES (1,2,'AXPAL',1404828981,'keren abiss','eeeeeeeeeee',3),(2,3,'AXPAL',1404832700,'wew','wew',3),(3,4,'TR001',1405052319,'Request Cabang A','mote',3),(4,4,'www',1407340800,'Reques','wwwww',1);
/*!40000 ALTER TABLE `distribution_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_tab`
--

DROP TABLE IF EXISTS `groups_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_tab` (
  `gid` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) NOT NULL,
  `gdesc` text NOT NULL,
  `gstatus` int(1) DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_tab`
--

LOCK TABLES `groups_tab` WRITE;
/*!40000 ALTER TABLE `groups_tab` DISABLE KEYS */;
INSERT INTO `groups_tab` VALUES (1,'Root','Root',1),(2,'palma','rest',1);
/*!40000 ALTER TABLE `groups_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hasil_penjualan_tab`
--

DROP TABLE IF EXISTS `hasil_penjualan_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hasil_penjualan_tab` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `hnofaktur` varchar(50) NOT NULL,
  `hcid` int(11) NOT NULL,
  `htax` varchar(50) NOT NULL,
  `htanggal` date NOT NULL,
  `hdefaultdisc` int(11) NOT NULL,
  `hqty` int(11) NOT NULL,
  `htotal` double NOT NULL,
  `hongkos` double NOT NULL,
  `hdisc` double NOT NULL,
  `hgrandtotal` double NOT NULL,
  `hinfo` text NOT NULL,
  `hstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`hid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil_penjualan_tab`
--

LOCK TABLES `hasil_penjualan_tab` WRITE;
/*!40000 ALTER TABLE `hasil_penjualan_tab` DISABLE KEYS */;
INSERT INTO `hasil_penjualan_tab` VALUES (1,'HP987989',1,'1','2014-06-03',5,12,1200000,10000,2,120000,'manteppp',0);
/*!40000 ALTER TABLE `hasil_penjualan_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_tab`
--

DROP TABLE IF EXISTS `inventory_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_tab` (
  `iid` int(10) NOT NULL AUTO_INCREMENT,
  `itype` tinyint(1) DEFAULT '1',
  `ibid` int(10) DEFAULT NULL,
  `ibcid` int(10) DEFAULT NULL,
  `istockbegining` int(10) DEFAULT NULL,
  `istockin` int(10) DEFAULT NULL,
  `istockout` int(10) DEFAULT NULL,
  `istockreject` int(10) DEFAULT NULL,
  `istockretur` int(10) DEFAULT NULL,
  `istock` int(10) DEFAULT NULL,
  `istatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_tab`
--

LOCK TABLES `inventory_tab` WRITE;
/*!40000 ALTER TABLE `inventory_tab` DISABLE KEYS */;
INSERT INTO `inventory_tab` VALUES (1,2,1,1,10,1,1,1,NULL,10,1),(2,1,1,1,10,1,1,1,NULL,11,1),(3,2,1,1,1,1,1,1,NULL,1,1),(4,1,1,4,100,20,80,0,0,100,0),(5,2,3,4,100,10,10,2,NULL,20,1),(6,1,4,1,100,100,0,0,0,100,1),(7,1,3,5,10,100,0,1,1,100,1),(8,1,2,1,100,10,10,1,1,100,1),(9,1,5,1,100,100,100,100,100,100,1);
/*!40000 ALTER TABLE `inventory_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `letter_tab`
--

DROP TABLE IF EXISTS `letter_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `letter_tab` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `ltype` tinyint(1) DEFAULT '1',
  `liid` int(10) DEFAULT NULL,
  `ldate` int(10) DEFAULT NULL,
  `ldesc` varchar(350) DEFAULT NULL,
  `lstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `letter_tab`
--

LOCK TABLES `letter_tab` WRITE;
/*!40000 ALTER TABLE `letter_tab` DISABLE KEYS */;
INSERT INTO `letter_tab` VALUES (1,1,3,1404856099,'wwwwwwwwww',3),(2,2,8,1404858133,'wwwwwwww',3),(3,1,4,1405052444,'',3);
/*!40000 ALTER TABLE `letter_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locator_books_tab`
--

DROP TABLE IF EXISTS `locator_books_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locator_books_tab` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `llid` int(10) DEFAULT NULL,
  `lbid` int(10) DEFAULT NULL,
  `lstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locator_books_tab`
--

LOCK TABLES `locator_books_tab` WRITE;
/*!40000 ALTER TABLE `locator_books_tab` DISABLE KEYS */;
INSERT INTO `locator_books_tab` VALUES (1,2,5,1),(2,2,2,1),(3,3,2,2),(4,3,3,2),(5,3,4,2),(6,3,2,1),(7,3,3,1),(8,4,1,2),(9,4,3,2),(10,4,4,2),(11,4,5,2),(12,4,1,2);
/*!40000 ALTER TABLE `locator_books_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locator_tab`
--

DROP TABLE IF EXISTS `locator_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locator_tab` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `lbid` int(10) DEFAULT NULL,
  `lplaced` varchar(100) DEFAULT NULL,
  `ldesc` varchar(350) DEFAULT NULL,
  `lstatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locator_tab`
--

LOCK TABLES `locator_tab` WRITE;
/*!40000 ALTER TABLE `locator_tab` DISABLE KEYS */;
INSERT INTO `locator_tab` VALUES (1,4,'erewew','ere',1),(2,8,'wew','wew',1),(3,5,'RAK II','RAK II',1),(4,5,'palma','wwwwwww',1);
/*!40000 ALTER TABLE `locator_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opname_tab`
--

DROP TABLE IF EXISTS `opname_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opname_tab` (
  `oid` int(10) NOT NULL AUTO_INCREMENT,
  `obid` int(10) DEFAULT NULL,
  `oidid` int(10) DEFAULT NULL,
  `otype` tinyint(1) DEFAULT '1',
  `odate` int(10) DEFAULT NULL,
  `ostockbegining` int(10) DEFAULT NULL,
  `ostockin` int(10) DEFAULT NULL,
  `ostockout` int(10) DEFAULT NULL,
  `ostockreject` int(10) DEFAULT NULL,
  `ostockretur` int(10) DEFAULT NULL,
  `ostock` int(10) DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opname_tab`
--

LOCK TABLES `opname_tab` WRITE;
/*!40000 ALTER TABLE `opname_tab` DISABLE KEYS */;
INSERT INTO `opname_tab` VALUES (1,NULL,2,1,1403381242,10,1,1,1,NULL,11);
/*!40000 ALTER TABLE `opname_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_tab`
--

DROP TABLE IF EXISTS `permission_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(45) DEFAULT NULL,
  `pdesc` varchar(150) DEFAULT NULL,
  `purl` varchar(45) DEFAULT NULL,
  `pparent` int(10) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_tab`
--

LOCK TABLES `permission_tab` WRITE;
/*!40000 ALTER TABLE `permission_tab` DISABLE KEYS */;
INSERT INTO `permission_tab` VALUES (1,'BranchView','Branch View','branch',0),(2,'BranchAdd','Branch Add','branch/branch_add',1),(3,'BranchUpdate','Branch Update','branch/branch_update',1),(4,'BranchDelete','Branch Delete','Branch Delete',1),(5,'BooksView','Books View','books',0),(6,'BooksAdd','Books Add','books/books_add',5),(7,'BooksUpdate','Books Update','books/books_update',5),(8,'BooksDelete','Books Delete','books/books_delete',5),(9,'BooksGroupView','Books Group View','books_group',0),(10,'BooksGroupAdd','Books Group Add','books_group/books_group_add',9),(11,'BooksGroupUpdate','Books Group Update','books_group/books_group_update',9),(12,'BooksGroupDelete','Books Group Delete','books_group/books_group_delete',9),(13,'AreaView','Area View','area',0),(14,'AreaAdd','Area Add','area/area_add',13),(15,'AreaUpdate','Area Update','area/area_update',13),(16,'AreaDelete','Area Delete','area/area_delete',13),(17,'PublisherView','Publisher View','publisher',0),(18,'PublisherAdd','Publisher Add','publisher/publisher_add',17),(19,'PublisherUpdate','Publisher Update','publisher/publisher_update',17),(20,'PublisherDelete','Publisher Delete','publisher/publisher_delete',17),(21,'CustomerView','Customer View','customer',0),(22,'CustomerAdd','Customer Add','customer/customer_add',21),(23,'CustomerUpdate','Customer Update','customer/customer_update',21),(24,'CustomerDelete','Customer Delete','customer/customer_delete',21);
/*!40000 ALTER TABLE `permission_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_tab`
--

DROP TABLE IF EXISTS `pm_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pdate` int(10) DEFAULT NULL,
  `pfrom` int(10) DEFAULT NULL,
  `pto` int(10) DEFAULT NULL,
  `psubject` varchar(150) DEFAULT NULL,
  `pmsg` text,
  `pstatus` tinyint(1) DEFAULT '0',
  `pfdelete` tinyint(1) DEFAULT '0',
  `ptdelete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_tab`
--

LOCK TABLES `pm_tab` WRITE;
/*!40000 ALTER TABLE `pm_tab` DISABLE KEYS */;
INSERT INTO `pm_tab` VALUES (5,1403421766,1,1,'qqqqqq','wewe',1,0,0),(6,1403422601,1,1,'tesss','aaaaaa\n\n-------\nqqqqqq\nwewe                        ',1,0,0),(7,1405063183,1,1,'Hallow','Req ID 100 tolong di Dis Approve',1,0,0);
/*!40000 ALTER TABLE `pm_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_tab`
--

DROP TABLE IF EXISTS `promo_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(150) DEFAULT NULL,
  `ptype` tinyint(1) DEFAULT NULL,
  `ppca` int(10) DEFAULT NULL,
  `pbid` int(10) DEFAULT NULL,
  `pdiscp` int(10) DEFAULT NULL,
  `pdiscc` int(10) DEFAULT NULL,
  `pfrom` int(10) DEFAULT NULL,
  `pto` int(10) DEFAULT NULL,
  `pdesc` varchar(350) DEFAULT NULL,
  `pstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_tab`
--

LOCK TABLES `promo_tab` WRITE;
/*!40000 ALTER TABLE `promo_tab` DISABLE KEYS */;
INSERT INTO `promo_tab` VALUES (1,'Tahun Baru',1,1,1,5,30,1403381242,1403381242,'Event Tahun Baru',1);
/*!40000 ALTER TABLE `promo_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province_tab`
--

DROP TABLE IF EXISTS `province_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(150) DEFAULT NULL,
  `pstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province_tab`
--

LOCK TABLES `province_tab` WRITE;
/*!40000 ALTER TABLE `province_tab` DISABLE KEYS */;
INSERT INTO `province_tab` VALUES (1,'JAWA BARAT',1),(2,'DKI JAKARTA',1),(3,'DAERAH ISTIMEWA YOGYAKARTA',1),(4,'SUMATERA UTARA',1),(5,'SUMATERA SELATAN',1),(6,'SULAWESI',1),(7,'JAWA TIMUR',1),(8,'JAWA TENGAH',1);
/*!40000 ALTER TABLE `province_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher_tab`
--

DROP TABLE IF EXISTS `publisher_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pcategory` tinyint(1) DEFAULT '0',
  `pcode` varchar(30) DEFAULT NULL,
  `pname` varchar(150) DEFAULT NULL,
  `paddr` text,
  `pcity` int(10) DEFAULT NULL,
  `pprov` int(10) DEFAULT NULL,
  `pphone` varchar(31) DEFAULT NULL,
  `pemail` varchar(30) DEFAULT NULL,
  `pnpwp` varchar(30) DEFAULT NULL,
  `pcreditlimit` int(10) DEFAULT NULL,
  `pcreditday` int(10) DEFAULT NULL,
  `pcp` varchar(150) DEFAULT NULL,
  `pdesc` varchar(350) DEFAULT NULL,
  `pdisc` int(10) DEFAULT NULL,
  `pparent` int(10) DEFAULT '1',
  `pstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher_tab`
--

LOCK TABLES `publisher_tab` WRITE;
/*!40000 ALTER TABLE `publisher_tab` DISABLE KEYS */;
INSERT INTO `publisher_tab` VALUES (1,2,'0102','Gramedia','aaaaaaaa',1,1,'091029012*121212*121212','admin@admin.com','121212',1,1,'Mamam','10',NULL,0,1),(2,3,'0201','admins','test',1,1,'989898*1213*1212','palmagratcy@gmail.com','aaaa',1,1,'wew','12121',NULL,0,1),(3,2,'0302','Penerbit PPPP','Jakarta',1,1,'8909809*908080*80908099809','ss@ss.com','8708900687',120000,4,'ss','ok',NULL,1,1);
/*!40000 ALTER TABLE `publisher_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving_books_tab`
--

DROP TABLE IF EXISTS `receiving_books_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving_books_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rrid` int(10) DEFAULT NULL,
  `rbcid` int(10) DEFAULT NULL,
  `rbid` int(10) DEFAULT NULL,
  `rqty` int(10) DEFAULT NULL,
  `rstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving_books_tab`
--

LOCK TABLES `receiving_books_tab` WRITE;
/*!40000 ALTER TABLE `receiving_books_tab` DISABLE KEYS */;
INSERT INTO `receiving_books_tab` VALUES (1,2,1,2,1311,1),(2,2,1,1,132,1),(3,1,1,3,0,1),(4,3,1,3,2,1),(5,3,1,4,1,1);
/*!40000 ALTER TABLE `receiving_books_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving_tab`
--

DROP TABLE IF EXISTS `receiving_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rtype` tinyint(1) DEFAULT '1',
  `rdocno` varchar(10) DEFAULT NULL,
  `riid` int(10) DEFAULT NULL,
  `rdate` int(10) DEFAULT NULL,
  `rdesc` varchar(350) DEFAULT NULL,
  `rstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving_tab`
--

LOCK TABLES `receiving_tab` WRITE;
/*!40000 ALTER TABLE `receiving_tab` DISABLE KEYS */;
INSERT INTO `receiving_tab` VALUES (1,2,'www',3,1405063857,'wwwwwwwwww',3),(2,1,'AXPAL',3,1410019200,'wew',3),(3,1,'AXPAL',3,1405163547,'wew',3);
/*!40000 ALTER TABLE `receiving_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_tab`
--

DROP TABLE IF EXISTS `tax_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_tab` (
  `tid` int(10) NOT NULL AUTO_INCREMENT,
  `tbcode` varchar(10) DEFAULT NULL,
  `ttax` varchar(50) DEFAULT NULL,
  `tdate` int(10) DEFAULT NULL,
  `tdesc` varchar(350) DEFAULT NULL,
  `tstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_tab`
--

LOCK TABLES `tax_tab` WRITE;
/*!40000 ALTER TABLE `tax_tab` DISABLE KEYS */;
INSERT INTO `tax_tab` VALUES (1,NULL,'xxx.001-11.00000001',1418632107,'wew',1),(2,NULL,'xxx.001-11.00000002',1418632108,'wew',1),(3,NULL,'xxx.001-11.00000003',1418632108,'wew',1),(4,NULL,'xxx.001-11.00000004',1418632108,'wew',1),(5,NULL,'xxx.001-11.00000005',1418632108,'wew',1),(6,NULL,'xxx.001-11.00000006',1418632108,'wew',1),(7,NULL,'xxx.001-11.00000007',1418632108,'wew',1),(8,NULL,'xxx.001-11.00000008',1418632108,'wew',1),(9,NULL,'xxx.001-11.00000009',1418632108,'wew',1),(10,NULL,'xxx.001-11.00000010',1418632108,'wew',1),(11,NULL,'xxx.001-11.00000011',1418632108,'wew',1),(12,NULL,'xxx.001-11.00000012',1418632108,'wew',1),(13,NULL,'xxx.001-11.00000013',1418632108,'wew',1),(14,NULL,'xxx.001-11.00000014',1418632108,'wew',1),(15,NULL,'xxx.001-11.00000015',1418632109,'wew',1),(16,NULL,'xxx.001-11.00000016',1418632109,'wew',1),(17,NULL,'xxx.001-11.00000017',1418632109,'wew',1),(18,NULL,'xxx.001-11.00000018',1418632109,'wew',1),(19,NULL,'xxx.001-11.00000019',1418632109,'wew',1),(20,NULL,'xxx.001-11.00000020',1418632109,'wew',1),(21,NULL,'xxx.001-11.00000021',1418632109,'wew',1),(22,NULL,'xxx.001-11.00000022',1418632109,'wew',1),(23,NULL,'xxx.001-11.00000023',1418632109,'wew',1),(24,NULL,'xxx.001-11.00000024',1418632109,'wew',1),(25,NULL,'xxx.001-11.00000025',1418632109,'wew',1),(26,NULL,'xxx.001-11.00000026',1418632110,'wew',1),(27,NULL,'xxx.001-11.00000027',1418632110,'wew',1),(28,NULL,'xxx.001-11.00000028',1418632110,'wew',1),(29,NULL,'xxx.001-11.00000029',1418632110,'wew',1),(30,NULL,'xxx.001-11.00000030',1418632110,'wew',1),(31,NULL,'xxx.001-11.00000031',1418632110,'wew',1),(32,NULL,'xxx.001-11.00000032',1418632111,'wew',1),(33,NULL,'xxx.001-11.00000033',1418632111,'wew',1),(34,NULL,'xxx.001-11.00000034',1418632111,'wew',1),(35,NULL,'xxx.001-11.00000035',1418632111,'wew',1),(36,NULL,'xxx.001-11.00000036',1418632111,'wew',1),(37,NULL,'xxx.001-11.00000037',1418632111,'wew',1),(38,NULL,'xxx.001-11.00000038',1418632111,'wew',1),(39,NULL,'xxx.001-11.00000039',1418632111,'wew',1),(40,NULL,'xxx.001-11.00000040',1418632111,'wew',1),(41,NULL,'xxx.001-11.00000041',1418632111,'wew',1),(42,NULL,'xxx.001-11.00000042',1418632111,'wew',1),(43,NULL,'xxx.001-11.00000043',1418632112,'wew',1),(44,NULL,'xxx.001-11.00000044',1418632112,'wew',1),(45,NULL,'xxx.001-11.00000045',1418632112,'wew',1),(46,NULL,'xxx.001-11.00000046',1418632112,'wew',1),(47,NULL,'xxx.001-11.00000047',1418632112,'wew',1),(48,NULL,'xxx.001-11.00000048',1418632112,'wew',1),(49,NULL,'xxx.001-11.00000049',1418632112,'wew',1),(50,NULL,'xxx.001-11.00000050',1418632112,'wew',1),(51,NULL,'xxx.001-11.00000051',1418632112,'wew',1),(52,NULL,'xxx.001-11.00000052',1418632112,'wew',1),(53,NULL,'xxx.001-11.00000053',1418632112,'wew',1),(54,NULL,'xxx.001-11.00000054',1418632112,'wew',1),(55,NULL,'xxx.001-11.00000055',1418632113,'wew',1),(56,NULL,'xxx.001-11.00000056',1418632113,'wew',1),(57,NULL,'xxx.001-11.00000057',1418632113,'wew',1),(58,NULL,'xxx.001-11.00000058',1418632113,'wew',1),(59,NULL,'xxx.001-11.00000059',1418632113,'wew',1),(60,NULL,'xxx.001-11.00000060',1418632113,'wew',1),(61,NULL,'xxx.001-11.00000061',1418632113,'wew',1),(62,NULL,'xxx.001-11.00000062',1418632113,'wew',1),(63,NULL,'xxx.001-11.00000063',1418632113,'wew',1),(64,NULL,'xxx.001-11.00000064',1418632113,'wew',1),(65,NULL,'xxx.001-11.00000065',1418632113,'wew',1),(66,NULL,'xxx.001-11.00000066',1418632113,'wew',1),(67,NULL,'xxx.001-11.00000067',1418632113,'wew',1),(68,NULL,'xxx.001-11.00000068',1418632114,'wew',1),(69,NULL,'xxx.001-11.00000069',1418632114,'wew',1),(70,NULL,'xxx.001-11.00000070',1418632114,'wew',1),(71,NULL,'xxx.001-11.00000071',1418632114,'wew',1),(72,NULL,'xxx.001-11.00000072',1418632114,'wew',1),(73,NULL,'xxx.001-11.00000073',1418632114,'wew',1),(74,NULL,'xxx.001-11.00000074',1418632114,'wew',1),(75,NULL,'xxx.001-11.00000075',1418632114,'wew',1),(76,NULL,'xxx.001-11.00000076',1418632114,'wew',1),(77,NULL,'xxx.001-11.00000077',1418632114,'wew',1),(78,NULL,'xxx.001-11.00000078',1418632114,'wew',1),(79,NULL,'xxx.001-11.00000079',1418632114,'wew',1),(80,NULL,'xxx.001-11.00000080',1418632115,'wew',1),(81,NULL,'xxx.001-11.00000081',1418632115,'wew',1),(82,NULL,'xxx.001-11.00000082',1418632115,'wew',1),(83,NULL,'xxx.001-11.00000083',1418632115,'wew',1),(84,NULL,'xxx.001-11.00000084',1418632115,'wew',1),(85,NULL,'xxx.001-11.00000085',1418632115,'wew',1),(86,NULL,'xxx.001-11.00000086',1418632115,'wew',1),(87,NULL,'xxx.001-11.00000087',1418632115,'wew',1),(88,NULL,'xxx.001-11.00000088',1418632115,'wew',1),(89,NULL,'xxx.001-11.00000089',1418632115,'wew',1),(90,NULL,'xxx.001-11.00000090',1418632115,'wew',1),(91,NULL,'xxx.001-11.00000091',1418632115,'wew',1),(92,NULL,'xxx.001-11.00000092',1418632115,'wew',1),(93,NULL,'xxx.001-11.00000093',1418632116,'wew',1),(94,NULL,'xxx.001-11.00000094',1418632116,'wew',1),(95,NULL,'xxx.001-11.00000095',1418632116,'wew',1),(96,NULL,'xxx.001-11.00000096',1418632116,'wew',1),(97,NULL,'xxx.001-11.00000097',1418632116,'wew',1),(98,NULL,'xxx.001-11.00000098',1418632116,'wew',1),(99,NULL,'xxx.001-11.00000099',1418632116,'wew',1),(100,NULL,'xxx.001-11.00000100',1418632116,'wew',1);
/*!40000 ALTER TABLE `tax_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_detail_tab`
--

DROP TABLE IF EXISTS `transaction_detail_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_detail_tab` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `ttid` int(11) DEFAULT NULL,
  `tbid` int(11) DEFAULT NULL,
  `tqty` int(11) DEFAULT NULL,
  `tharga` double DEFAULT NULL,
  `tdisc` double DEFAULT NULL,
  `ttotal` double DEFAULT NULL,
  `tstatus` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_detail_tab`
--

LOCK TABLES `transaction_detail_tab` WRITE;
/*!40000 ALTER TABLE `transaction_detail_tab` DISABLE KEYS */;
INSERT INTO `transaction_detail_tab` VALUES (1,1,1,10,12000,10,108000,1),(2,1,2,12,15000,10,145000,1),(31,7,1,2,100000,10,180000,1),(32,8,2,20,10000,10,180000,1),(33,7,1,3,100000,10,270000,1),(34,7,0,0,0,0,0,1),(35,7,1,2,100000,10,180000,1);
/*!40000 ALTER TABLE `transaction_detail_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_tab`
--

DROP TABLE IF EXISTS `transaction_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_tab` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) DEFAULT NULL,
  `tnofaktur` varchar(50) NOT NULL,
  `tcid` int(11) NOT NULL,
  `tpid` int(11) DEFAULT NULL,
  `ttax` varchar(50) NOT NULL,
  `ttanggal` date DEFAULT NULL,
  `ttype` tinyint(4) NOT NULL,
  `ttypetrans` tinyint(4) NOT NULL,
  `ttotalqty` int(11) NOT NULL,
  `ttotalharga` double NOT NULL,
  `ttotaldisc` double NOT NULL,
  `tongkos` double NOT NULL,
  `tgrandtotal` double NOT NULL,
  `tinfo` text NOT NULL,
  `tstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_tab`
--

LOCK TABLES `transaction_tab` WRITE;
/*!40000 ALTER TABLE `transaction_tab` DISABLE KEYS */;
INSERT INTO `transaction_tab` VALUES (1,1,'HP987989',1,NULL,'1','2014-06-03',1,1,12,1200000,5,10000,120000,'manteppp',0),(7,1,'HP010',1,NULL,'1','2014-03-17',1,1,7,300000,30,0,630000,'ss',0),(8,1,'HP009',0,0,'0','2014-03-05',1,1,20,10000,10,0,180000,'',1),(9,1,'43334',0,0,'0','0000-00-00',1,1,0,0,0,0,0,'',1);
/*!40000 ALTER TABLE `transaction_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_tab`
--

DROP TABLE IF EXISTS `users_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_tab` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `ugid` int(10) DEFAULT NULL,
  `ubid` int(10) DEFAULT NULL,
  `uemail` varchar(50) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `ulastlogin` varchar(21) DEFAULT NULL,
  `ustatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_tab`
--

LOCK TABLES `users_tab` WRITE;
/*!40000 ALTER TABLE `users_tab` DISABLE KEYS */;
INSERT INTO `users_tab` VALUES (1,1,1,'admin@admin.com','e89591ee9b8e7018511649a2146ae279','2130706433*1418632081',1),(2,1,2,'palma@admin.com','e89591ee9b8e7018511649a2146ae279',NULL,0);
/*!40000 ALTER TABLE `users_tab` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-15 18:37:10
