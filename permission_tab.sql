CREATE DATABASE  IF NOT EXISTS `niaga_swadaya_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `niaga_swadaya_db`;
-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: niaga_swadaya_db
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_tab`
--

LOCK TABLES `permission_tab` WRITE;
/*!40000 ALTER TABLE `permission_tab` DISABLE KEYS */;
INSERT INTO `permission_tab` VALUES (1,'BranchView','Branch View','branch',0),(2,'BranchExecute','Branch Execute','branch/*',1),(3,'BooksView','Books View','books',0),(4,'BooksExecute','Books Execute','books/*',5),(5,'AreaView','Area View','area',0),(6,'AreaExecute','Area Execute','area/*',13),(7,'PublisherView','Publisher View','publisher',0),(8,'PublisherExecute','Publisher Execute','publisher/*',17),(9,'CustomerView','Customer View','customer',0),(10,'CustomerExecute','Customer Execute','customer/*',21),(11,'BooksLocationView','Books Location View','locator',0),(12,'BooksLocationExecute','Books Location Execute','locator/*',25),(13,'TaxesView','Taxes View','tax',0),(14,'TaxesExecute','Taxes Execute','tax/*',29),(15,'CatalogView','Catalog View','catalog',0),(16,'CatalogExecute','Catalog Execute','catalog/*',33),(17,'CategoryArsipView','Category Arsip View','category_arsip',0),(18,'CategoryArsipExecute','Category Arsip Execute','category_arsip/*',37),(19,'ArsipView','Arsip View','arsip',0),(20,'ArsipExecute','Arsip Execute','arsip/*',41),(21,'PromotionView','Promotion View','promo',0),(22,'PromotionExecute','Promotion Execute','promo/*',45),(23,'CityView','City View','city',0),(24,'CityExecute','City Execute','city/*',49),(25,'ProvinceView','Province View','province',0),(26,'ProvinceExecute','Province Execute','province/*',53),(27,'UsersView','Users View','users',0),(28,'UsersExecute','Users Execute','users/*',57),(29,'UsersGroupView','Users Group View','users/users_group',0),(30,'UsersGroupExecute','Users Group Execute','users/*',61),(31,'DistributionRequestView','Distribution Request View','request',0),(32,'DistributionRequestExecute','Distribution Request Execute','request/*',0),(33,'DistributionRequestApprove','Distribution Request Approve','request/request_update',62),(34,'DistributionTransferView','Distribution Transfer View','transfer',0),(35,'DistributionTransferExecute','Distribution Transfer Execute','transfer/*',0),(36,'DistributionTransferApprove','Distribution Transfer Approve','transfer/transfer_update',64),(37,'ItemReceivingView','Item Receiving View','receiving',0),(38,'ItemReceivingExecute','Item Receiving Execute','receiving/*',0),(39,'ItemReceivingApprove','Item Receiving Approve','receiving/receiving_update',0),(40,'StockView','Stock View','inventory',0),(41,'StockExecute','Stock Execute','inventory/*',0),(42,'StockShadowView','Stock Shadow View','inventory_shadow',0),(43,'StockShadowExecute','Stock Shadow Execute','inventory_shadow/*',0),(44,'StockCustomerView','Stock Customer View','inventory_customer',0),(45,'StockCustomerExecute','Stock Customer Execute','inventory_customer/*',0),(46,'OpnameStockView','Opname Stock View','opname',0),(47,'OpnameStockExecute','Opname Stock Execute','opname/*',0),(48,'OpnameStockCustomerView','Opname Stock Customer View','opnamecustomer',0),(49,'OpnameStockCustomerExecute','Opname Stock Customer Execute','opnamecustomer/*',0),(50,'HasilPenjualanView','Hasil Penjualan View','hasil_penjualan',0),(51,'HasilPenjualanExecute','Hasil Penjualan Execute','hasil_penjualan/*',0),(52,'HasilPenjualanApproval','Hasil Penjualan Approval','hasil_penjualan_detail/hasil_penjualan_detail',0),(53,'HasilPenjualanApproval2','Hasil Penjualan Approval II','hasil_penjualan_detail/hasil_penjualan_detail',0),(54,'PenjualanKreditView','Penjualan Kredit View','penjualan_kredit',0),(55,'PenjualanKreditExecute','Penjualan Kredit Execute','penjualan_kredit/*',0),(56,'PenjualanKreditApproval','Penjualan Kredit Approval','penjualan_kredit_detail/penjualan_kredit_deta',0),(57,'PenjualanKreditApproval2','Penjualan Kredit Approval II','penjualan_kredit_detail/penjualan_kredit_deta',0),(58,'PenjualanKonsinyasiView','Penjualan Konsinyasi View','penjualan_konsinyasi',0),(59,'PenjualanKonsinyasiExecute','Penjualan Konsinyasi Execute','penjualan_konsinyasi/*',0),(60,'PenjualanKonsinyasiApproval','Penjualan Konsinyasi Approval','penjualan_konsinyasi_detail/penjualan_konsiny',0),(61,'PenjualanKonsinyasiApproval2','Penjualan Konsinyasi Approval II','penjualan_konsinyasi_detail/penjualan_konsiny',0),(62,'PembelianView','Pembelian View','pembelian_spo',0),(63,'PembelianExecute','Pembelian Execute','pembelian_spo/*',0),(64,'PembelianApproval','Pembelian Approval','pembelian_spo_detail/pembelian_spo_detail_upd',0),(65,'ReturHasilPenjualanView','Retur Hasil Penjualan View','retur_hp',0),(66,'ReturHasilPenjualanExecute','Retur Hasil Penjualan Execute','retur_hp/*',0),(67,'ReturHasilPenjualanApproval','Retur Hasil Penjualan Approval','retur_hp_detail/retur_hp_detail_approval1',0),(68,'ReturHasilPenjualanApproval2','Retur Hasil Penjualan Approval II','retur_hp_detail/retur_hp_detail_approval2',0),(69,'ReturPenjualanKreditView','Retur Penjualan Kredit View','retur_jc',0),(70,'ReturPenjualanKreditExecute','Retur Penjualan Kredit Execute','retur_jc/*',0),(71,'ReturPenjualanKreditApproval','Retur Penjualan Kredit Approval','retur_jc_detail/retur_jc_detail_approval1',0),(72,'ReturPenjualanKreditApproval2','Retur Penjualan Kredit Approval II','retur_jc_detail/retur_jc_detail_approval2',0),(73,'ReturPenjualanKonsinyasiView','Retur Penjualan Konsinyasi View','retur_jk',0),(74,'ReturPenjualanKonsinyasiExecute','Retur Penjualan Konsinyasi Execute','retur_jk/*',0),(75,'ReturPenjualanKonsinyasiApproval','Retur Penjualan Konsinyasi Approval','retur_jk_detail/retur_jk_detail_approval1',0),(76,'ReturPenjualanKonsinyasiApproval2','Retur Penjualan Konsinyasi Approval II','retur_jk_detail/retur_jk_detail_approval2',0),(77,'ReturPembelianView','Retur Pembelian View','retur_bk',0),(78,'ReturPembelianExecute','Retur Pembelian Execute','retur_bk/*',0),(79,'ReturPembelianApproval','Retur Pembelian Approval','retur_bk_detail/retur_bk_detail_update',0),(80,'ReportStock','Report Stock','reportstock',0),(81,'ReportStockCustomer','Report Stock Customer','reportstockcustomer',0),(82,'ReportOpnameStock','Report Opname Stock','reportopname',0),(83,'ReportOpnameStockCustomer','Report Opname Stock Customer','reportopnamecustomer',0);
/*!40000 ALTER TABLE `permission_tab` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_tab`
--

LOCK TABLES `access_tab` WRITE;
/*!40000 ALTER TABLE `access_tab` DISABLE KEYS */;
INSERT INTO `access_tab` VALUES (1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1),(5,1,5,1),(6,1,6,1),(7,1,7,1),(8,1,8,1),(9,1,9,1),(10,1,10,1),(11,1,11,1),(12,1,12,1),(13,1,13,1),(14,1,14,1),(15,1,15,1),(16,1,16,1),(17,1,17,1),(18,1,18,1),(19,1,19,1),(20,1,20,1),(21,1,21,1),(22,1,22,1),(23,1,23,1),(24,1,24,1),(25,1,25,1),(26,1,26,1),(27,1,27,1),(28,1,28,1),(29,1,29,1),(30,1,30,1),(31,1,31,1),(32,1,32,1),(33,1,33,1),(34,1,34,1),(35,1,35,1),(36,1,36,1),(37,1,37,1),(38,1,38,1),(39,1,39,1),(40,1,40,1),(41,1,41,1),(42,1,42,1),(43,1,43,1),(44,1,44,1),(45,1,45,1),(46,1,46,1),(47,1,47,1),(48,1,48,1),(49,1,49,1),(50,1,50,1),(51,1,51,1),(52,1,52,1),(53,1,53,1),(54,1,54,1),(55,1,55,1),(56,1,56,1),(57,1,57,1),(58,1,58,1),(59,1,59,1),(60,1,60,1),(61,1,61,1),(62,1,62,1),(63,1,63,1),(64,1,64,1),(65,1,65,1),(66,1,66,1),(67,1,67,1),(68,1,68,1),(69,1,69,1),(70,1,70,1),(71,1,71,1),(72,1,72,1),(73,1,73,1),(74,1,74,1),(75,1,75,1),(76,1,76,1),(77,1,77,1),(78,1,78,1),(79,1,79,1),(80,1,80,1),(81,1,81,1),(82,1,82,1),(83,1,83,1);
/*!40000 ALTER TABLE `access_tab` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-15 14:39:44
