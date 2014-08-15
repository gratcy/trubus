-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2014 at 11:11 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `niaga_swadaya_db`
--
CREATE DATABASE IF NOT EXISTS `niaga_swadaya_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `niaga_swadaya_db`;

-- --------------------------------------------------------

--
-- Table structure for table `access_tab`
--

CREATE TABLE IF NOT EXISTS `access_tab` (
  `aid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `agid` int(4) unsigned NOT NULL,
  `apid` int(10) DEFAULT NULL,
  `aaccess` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `access_tab`
--

INSERT INTO `access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES
(1, 2, 1, 0),
(2, 2, 2, 0),
(3, 2, 3, 1),
(4, 2, 4, 1),
(5, 2, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `adjustment_tab`
--

CREATE TABLE IF NOT EXISTS `adjustment_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `adjustment_tab`
--

INSERT INTO `adjustment_tab` (`aid`, `abcid`, `aidid`, `atype`, `aatype`, `adate`, `astockbegining`, `astockin`, `astockout`, `astockreject`, `astockretur`, `atotal`, `astock`) VALUES
(1, 1, 1, 1, 1, 1403381242, 0, 0, 0, 0, 0, 10, 10),
(2, 1, 2, 1, 1, 1403381242, 0, 0, 0, 0, 0, 2, 10),
(3, 1, 3, 1, 0, 1403381242, 0, 0, 0, 0, 0, 4, 0),
(4, 1, 4, 1, 1, 1403381242, 0, 0, 0, 0, 0, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `area_tab`
--

CREATE TABLE IF NOT EXISTS `area_tab` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `acode` varchar(30) DEFAULT NULL,
  `aname` varchar(150) DEFAULT NULL,
  `adesc` varchar(350) DEFAULT NULL,
  `astatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `area_tab`
--

INSERT INTO `area_tab` (`aid`, `acode`, `aname`, `adesc`, `astatus`) VALUES
(1, 'XSA232', 'palma', 'asasassas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books_group_tab`
--

CREATE TABLE IF NOT EXISTS `books_group_tab` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bcode` varchar(50) DEFAULT NULL,
  `bname` varchar(150) DEFAULT NULL,
  `bdesc` varchar(350) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `books_group_tab`
--

INSERT INTO `books_group_tab` (`bid`, `bcode`, `bname`, `bdesc`, `bstatus`) VALUES
(1, 'XSA232', '2232', 'asas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books_tab`
--

CREATE TABLE IF NOT EXISTS `books_tab` (
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
  `boplahprint` varchar(50) DEFAULT NULL,
  `bmonthyear` varchar(10) DEFAULT NULL,
  `btotalpages` int(10) DEFAULT NULL,
  `bdesc` varchar(350) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `books_tab`
--

INSERT INTO `books_tab` (`bid`, `bcode`, `bauthor`, `bpublisher`, `bgroup`, `btitle`, `btax`, `bprice`, `bpack`, `bdisc`, `bisbn`, `bhw`, `boplahprint`, `bmonthyear`, `btotalpages`, `bdesc`, `bstatus`) VALUES
(1, 'AXAAS', 'palma', 1, 1, 'wew', 1, 100000, 1, 10, '10101001', '121*12', 'wew', '06/2004', 1000, 'test', 1),
(2, 'A123', NULL, 2, 1, 'Buku satu', 0, 10000, 1, 10, '100', '1*1', NULL, NULL, NULL, '2002', 1),
(3, 'B0005', NULL, 3, 1, 'Buku Baru', 0, 789987, 1, 12, '78980809', '1*1', NULL, NULL, NULL, 'okkk', 1),
(4, 'AWA101', NULL, 2, 1, 'Awal', 0, 1500, 1, 20, 'AWAL', '1*1', NULL, NULL, NULL, 'Buku', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch_tab`
--

CREATE TABLE IF NOT EXISTS `branch_tab` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bcode` varchar(10) DEFAULT NULL,
  `bname` varchar(150) DEFAULT NULL,
  `bnpwp` varchar(20) DEFAULT NULL,
  `baddr` text,
  `bcity` int(10) DEFAULT NULL,
  `bprovince` int(10) DEFAULT NULL,
  `bphone` varchar(50) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `branch_tab`
--

INSERT INTO `branch_tab` (`bid`, `bcode`, `bname`, `bnpwp`, `baddr`, `bcity`, `bprovince`, `bphone`, `bstatus`) VALUES
(1, NULL, 'Pusat', '1121', 'Gunung Sahari', 1, 1, '121212*1213', 1),
(4, NULL, 'Perwakilan A', NULL, NULL, 1, 1, '43535*324324', 1),
(5, NULL, 'Perwakilan B', NULL, NULL, 1, 1, '43545*', 1),
(6, NULL, 'Perwakilan C', NULL, NULL, 1, 1, '435454*', 1),
(8, 'wewe', 'Perwakilan Daerah Bandung', '86788767', 'Bandung', 2, 2, '8798798979*8799898798', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coa_tab`
--

CREATE TABLE IF NOT EXISTS `coa_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `coa_tab`
--

INSERT INTO `coa_tab` (`cid`, `catype`, `ctype`, `ccode`, `cname`, `csaldo`, `cdebet`, `ccredit`, `cdesc`, `cparent`, `cstatus`) VALUES
(1, 2, 1, 'asas', 'Semarang', 10111, NULL, NULL, 'asasa', 0, 1),
(2, 1, 0, '1101', 'Bank', 0, NULL, NULL, 'wewe', 0, 1),
(3, 1, 0, '1231', 'BCA', 0, NULL, NULL, '232', 2, 1),
(4, 1, 0, '2323', 'Mandiri', 0, NULL, NULL, 'wwwww', 2, 1),
(5, 1, 0, '11011', 'Finance', 0, NULL, NULL, 'Finance', 4, 1),
(6, 1, 0, 'AD', 'Jakarta', 0, NULL, NULL, 'Test', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_group_tab`
--

CREATE TABLE IF NOT EXISTS `customer_group_tab` (
  `cgid` int(10) NOT NULL AUTO_INCREMENT,
  `cgcode` varchar(50) DEFAULT NULL,
  `cgname` varchar(150) DEFAULT NULL,
  `cgdesc` varchar(350) DEFAULT NULL,
  `cgstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer_group_tab`
--

INSERT INTO `customer_group_tab` (`cgid`, `cgcode`, `cgname`, `cgdesc`, `cgstatus`) VALUES
(1, 'CUS0001', 'Gramedia', 'Gramedia Group', 1),
(2, 'CUS002', 'Non Gramedia', 'Non Gramed', 1),
(3, 'CUS003', 'Perwakilan', 'Perwakilan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_tab`
--

CREATE TABLE IF NOT EXISTS `customer_tab` (
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
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer_tab`
--

INSERT INTO `customer_tab` (`cid`, `cbid`, `ccode`, `cname`, `cnametax`, `caddrtax`, `caddr`, `ccity`, `cprovince`, `cphone`, `cemail`, `cnpwp`, `cnpwplong`, `cdisc`, `ctax`, `cgroup`, `carea`, `ccreditlimit`, `ccredittime`, `ctype`, `cstatus`) VALUES
(1, 1, NULL, 'palma', NULL, NULL, 'jakarta', 1, 1, '9130193039*232323', 'admin@adminc.om', '12i01380138', NULL, 10, 1, 1, 1, 1, NULL, 1, 1),
(2, 1, NULL, 'snnnn', NULL, NULL, 'jakart', 1, 1, '987890809*89809890', 'ss@ss.com', '900989-', NULL, 8, 0, 1, 1, 10000, NULL, 0, 1),
(3, 4, NULL, 'ABCDE', NULL, NULL, 'Jakarta', 1, 2, '98090-9-888*676887', 'fff@gg.com', '879878', NULL, 10, 0, 1, 1, 15, NULL, 1, 1),
(4, 8, 'aaaaaaa', 'Gramedia Jakarta', NULL, NULL, 'Jakarta', 1, 1, '9808809*09808080', 'tes@tes.com', '080989089', NULL, 10, 1, 1, 1, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `distribution_book_tab`
--

CREATE TABLE IF NOT EXISTS `distribution_book_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `ddrid` int(10) DEFAULT NULL,
  `dbid` int(10) DEFAULT NULL,
  `dqty` int(10) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `distribution_book_tab`
--

INSERT INTO `distribution_book_tab` (`did`, `ddrid`, `dbid`, `dqty`, `dstatus`) VALUES
(1, 1, 1, 1000, 1),
(2, 1, 2, 1000, 1),
(3, 1, 3, 10000, 1),
(4, 2, 2, 1, 2),
(5, 2, 3, 10, 2),
(7, 2, 1, 12, 2),
(8, 2, 2, 1, 2),
(9, 2, 2, 122, 1),
(10, 2, 3, NULL, 2),
(11, 2, 1, 122, 1),
(12, 2, 3, NULL, 2),
(13, 3, 2, 900, 1),
(14, 3, 3, 800, 1),
(15, 4, 1, 1000, 1),
(16, 4, 2, 1, 1),
(17, 4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `distribution_request_tab`
--

CREATE TABLE IF NOT EXISTS `distribution_request_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `dbfrom` int(10) DEFAULT NULL,
  `dbto` int(10) DEFAULT NULL,
  `ddate` int(10) DEFAULT NULL,
  `dtitle` varchar(150) DEFAULT NULL,
  `ddesc` varchar(350) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `distribution_request_tab`
--

INSERT INTO `distribution_request_tab` (`did`, `dbfrom`, `dbto`, `ddate`, `dtitle`, `ddesc`, `dstatus`) VALUES
(1, 5, 4, 1404722046, 'wews', 'wew', 1),
(2, 5, 6, 1404848643, 'wew', 'desc', 1),
(3, 5, 8, 1404833133, 'oio', 'wew', 3),
(4, 6, 1, 1405052181, 'Reques', 'req', 3);

-- --------------------------------------------------------

--
-- Table structure for table `distribution_tab`
--

CREATE TABLE IF NOT EXISTS `distribution_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `ddrid` int(10) DEFAULT NULL,
  `ddocno` varchar(10) DEFAULT NULL,
  `ddate` int(10) DEFAULT NULL,
  `dtitle` varchar(150) DEFAULT NULL,
  `ddesc` varchar(350) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `distribution_tab`
--

INSERT INTO `distribution_tab` (`did`, `ddrid`, `ddocno`, `ddate`, `dtitle`, `ddesc`, `dstatus`) VALUES
(1, 2, 'AXPAL', 1404828981, 'keren abiss', 'eeeeeeeeeee', 3),
(2, 3, 'AXPAL', 1404832700, 'wew', 'wew', 3),
(3, 4, 'TR001', 1405052319, 'Request Cabang A', 'mote', 3),
(4, 4, 'www', 1407340800, 'Reques', 'wwwww', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups_tab`
--

CREATE TABLE IF NOT EXISTS `groups_tab` (
  `gid` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) NOT NULL,
  `gdesc` text NOT NULL,
  `gstatus` int(1) DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups_tab`
--

INSERT INTO `groups_tab` (`gid`, `gname`, `gdesc`, `gstatus`) VALUES
(1, 'Root', 'Root', 1),
(2, 'palma', 'rest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penjualan_tab`
--

CREATE TABLE IF NOT EXISTS `hasil_penjualan_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hasil_penjualan_tab`
--

INSERT INTO `hasil_penjualan_tab` (`hid`, `hnofaktur`, `hcid`, `htax`, `htanggal`, `hdefaultdisc`, `hqty`, `htotal`, `hongkos`, `hdisc`, `hgrandtotal`, `hinfo`, `hstatus`) VALUES
(1, 'HP987989', 1, '1', '2014-06-03', 5, 12, 1200000, 10000, 2, 120000, 'manteppp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tab`
--

CREATE TABLE IF NOT EXISTS `inventory_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `inventory_tab`
--

INSERT INTO `inventory_tab` (`iid`, `itype`, `ibid`, `ibcid`, `istockbegining`, `istockin`, `istockout`, `istockreject`, `istockretur`, `istock`, `istatus`) VALUES
(1, 2, 1, 1, 10, 1, 1, 1, NULL, 10, 1),
(2, 1, 1, 1, 10, 1, 1, 1, NULL, 11, 1),
(3, 2, 3, 1, 1, 1, 1, 1, NULL, 1, 1),
(4, 1, 1, 4, 100, 20, 80, 0, 0, 100, 0),
(5, 2, 3, 4, 100, 10, 10, 2, NULL, 20, 1),
(6, 1, 4, 1, 100, 100, 0, 0, 0, 100, 1),
(7, 1, 3, 5, 10, 100, 0, 1, 1, 100, 1),
(8, 1, 2, 1, 100, 10, 10, 1, 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `letter_tab`
--

CREATE TABLE IF NOT EXISTS `letter_tab` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `ltype` tinyint(1) DEFAULT '1',
  `liid` int(10) DEFAULT NULL,
  `ldate` int(10) DEFAULT NULL,
  `ldesc` varchar(350) DEFAULT NULL,
  `lstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `letter_tab`
--

INSERT INTO `letter_tab` (`lid`, `ltype`, `liid`, `ldate`, `ldesc`, `lstatus`) VALUES
(1, 1, 3, 1404856099, 'wwwwwwwwww', 3),
(2, 2, 8, 1404858133, 'wwwwwwww', 3),
(3, 1, 4, 1405052444, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `opname_tab`
--

CREATE TABLE IF NOT EXISTS `opname_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `opname_tab`
--

INSERT INTO `opname_tab` (`oid`, `obid`, `oidid`, `otype`, `odate`, `ostockbegining`, `ostockin`, `ostockout`, `ostockreject`, `ostockretur`, `ostock`) VALUES
(1, NULL, 2, 1, 1403381242, 10, 1, 1, 1, NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `permission_tab`
--

CREATE TABLE IF NOT EXISTS `permission_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(45) DEFAULT NULL,
  `pdesc` varchar(150) DEFAULT NULL,
  `purl` varchar(45) DEFAULT NULL,
  `pparent` int(10) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `permission_tab`
--

INSERT INTO `permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES
(1, 'wew', 'wew', 'wew', 0),
(2, 'wew1', 'wew1', 'wew', 1),
(3, 'wew2', 'wew2', 'wew', 1),
(4, 'aww', 'aww', 'aww', 0),
(5, 'aww', 'aww', 'aww', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pm_tab`
--

CREATE TABLE IF NOT EXISTS `pm_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pm_tab`
--

INSERT INTO `pm_tab` (`pid`, `pdate`, `pfrom`, `pto`, `psubject`, `pmsg`, `pstatus`, `pfdelete`, `ptdelete`) VALUES
(5, 1403421766, 1, 1, 'qqqqqq', 'wewe', 1, 0, 0),
(6, 1403422601, 1, 1, 'tesss', 'aaaaaa\n\n-------\nqqqqqq\nwewe                        ', 1, 0, 0),
(7, 1405063183, 1, 1, 'Hallow', 'Req ID 100 tolong di Dis Approve', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `publisher_tab`
--

CREATE TABLE IF NOT EXISTS `publisher_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
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
  `pcategory` enum('External','Internal','Majalah') DEFAULT NULL,
  `pdesc` varchar(350) DEFAULT NULL,
  `pstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `publisher_tab`
--

INSERT INTO `publisher_tab` (`pid`, `pcode`, `pname`, `paddr`, `pcity`, `pprov`, `pphone`, `pemail`, `pnpwp`, `pcreditlimit`, `pcreditday`, `pcp`, `pcategory`, `pdesc`, `pstatus`) VALUES
(1, 'asas', 'Gramedia', 'aaaaaaaa', 1, 1, '091029012*121212*121212', 'admin@admin.com', '121212', 1, 1, 'Mamam', NULL, '10', 1),
(2, 'XSA232', 'admins', NULL, 1, 2, '989898*1213*1212', 'palmagratcy@gmail.com', 'aaaa', 1, 1, 'wew', NULL, '12121', 1),
(3, 'P0123', 'Penerbit PPPP', 'Jakarta', 1, 1, '8909809*908080*80908099809', 'ss@ss.com', '8708900687', 120000, 4, 'ss', 'External', 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_books_tab`
--

CREATE TABLE IF NOT EXISTS `receiving_books_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rrid` int(10) DEFAULT NULL,
  `rbcid` int(10) DEFAULT NULL,
  `rbid` int(10) DEFAULT NULL,
  `rqty` int(10) DEFAULT NULL,
  `rstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `receiving_books_tab`
--

INSERT INTO `receiving_books_tab` (`rid`, `rrid`, `rbcid`, `rbid`, `rqty`, `rstatus`) VALUES
(1, 2, 1, 2, 1311, 1),
(2, 2, 1, 1, 132, 1),
(3, 1, 1, 3, 0, 1),
(4, 3, 1, 3, 2, 1),
(5, 3, 1, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_tab`
--

CREATE TABLE IF NOT EXISTS `receiving_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rtype` tinyint(1) DEFAULT '1',
  `rdocno` varchar(10) DEFAULT NULL,
  `riid` int(10) DEFAULT NULL,
  `rdate` int(10) DEFAULT NULL,
  `rdesc` varchar(350) DEFAULT NULL,
  `rstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `receiving_tab`
--

INSERT INTO `receiving_tab` (`rid`, `rtype`, `rdocno`, `riid`, `rdate`, `rdesc`, `rstatus`) VALUES
(1, 2, 'www', 3, 1405063857, 'wwwwwwwwww', 3),
(2, 1, 'AXPAL', 3, 1404848462, 'wew', 1),
(3, 1, 'AXPAL', 3, 1405163547, 'wew', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail_tab`
--

CREATE TABLE IF NOT EXISTS `transaction_detail_tab` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `ttid` int(11) DEFAULT NULL,
  `tbid` int(11) DEFAULT NULL,
  `tqty` int(11) DEFAULT NULL,
  `tharga` double DEFAULT NULL,
  `tdisc` double DEFAULT NULL,
  `ttotal` double DEFAULT NULL,
  `tstatus` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `transaction_detail_tab`
--

INSERT INTO `transaction_detail_tab` (`tid`, `ttid`, `tbid`, `tqty`, `tharga`, `tdisc`, `ttotal`, `tstatus`) VALUES
(1, 1, 1, 10, 12000, 10, 108000, 1),
(2, 1, 2, 12, 15000, 10, 145000, 1),
(31, 7, 1, 2, 100000, 10, 180000, 1),
(32, 8, 2, 20, 10000, 10, 180000, 1),
(33, 7, 1, 3, 100000, 10, 270000, 1),
(34, 7, 0, 0, 0, 0, 0, 1),
(35, 7, 1, 2, 100000, 10, 180000, 1),
(36, 10, 2, 15, 10000, 10, 135000, 1),
(37, 10, 3, 20, 789987, 0, 15799740, 1),
(38, 11, 1, 4, 100000, 10, 360000, 1),
(39, 11, 2, 2, 10000, 10, 18000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tab`
--

CREATE TABLE IF NOT EXISTS `transaction_tab` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `transaction_tab`
--

INSERT INTO `transaction_tab` (`tid`, `tbid`, `tnofaktur`, `tcid`, `tpid`, `ttax`, `ttanggal`, `ttype`, `ttypetrans`, `ttotalqty`, `ttotalharga`, `ttotaldisc`, `tongkos`, `tgrandtotal`, `tinfo`, `tstatus`) VALUES
(1, 1, 'HP987989', 1, NULL, '1', '2014-06-03', 1, 1, 12, 1200000, 5, 10000, 120000, 'manteppp', 0),
(7, 1, 'HP010', 1, NULL, '1', '2014-03-17', 1, 1, 7, 300000, 30, 0, 630000, 'ss', 0),
(8, 1, 'HP009', 0, 0, '0', '2014-03-05', 1, 1, 20, 10000, 10, 0, 180000, '', 1),
(9, 1, 'BK001', 0, 0, '0', '0000-00-00', 3, 2, 0, 0, 0, 0, 0, '', 1),
(10, NULL, 'JK14Oct1', 4, 0, '0', '2014-10-03', 2, 1, 35, 15934740, 0, 0, 15934740, '', 1),
(11, NULL, 'JC14Oct2', 4, 0, '0', '2014-10-03', 2, 2, 6, 378000, 0, 0, 378000, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_tab`
--

CREATE TABLE IF NOT EXISTS `users_tab` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `ugid` int(10) DEFAULT NULL,
  `ubid` int(10) DEFAULT NULL,
  `uemail` varchar(50) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `ulastlogin` varchar(21) DEFAULT NULL,
  `ustatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_tab`
--

INSERT INTO `users_tab` (`uid`, `ugid`, `ubid`, `uemail`, `upass`, `ulastlogin`, `ustatus`) VALUES
(1, 1, 1, 'admin@admin.com', 'e89591ee9b8e7018511649a2146ae279', '*1408093276', 1),
(2, 1, 2, 'palma@admin.com', 'e89591ee9b8e7018511649a2146ae279', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
