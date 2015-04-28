-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2015 pada 13.16
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `niaga_swadaya_db`
--
CREATE DATABASE IF NOT EXISTS `niaga_swadaya_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `niaga_swadaya_db`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_tab`
--

CREATE TABLE IF NOT EXISTS `access_tab` (
  `aid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `agid` int(4) unsigned NOT NULL,
  `apid` int(10) DEFAULT NULL,
  `aaccess` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data untuk tabel `access_tab`
--

INSERT INTO `access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 1),
(18, 1, 18, 1),
(19, 1, 19, 1),
(20, 1, 20, 1),
(21, 1, 21, 1),
(22, 1, 22, 1),
(23, 1, 23, 1),
(24, 1, 24, 1),
(25, 1, 25, 1),
(26, 1, 26, 1),
(27, 1, 27, 1),
(28, 1, 28, 1),
(29, 1, 29, 1),
(30, 1, 30, 1),
(31, 1, 31, 1),
(32, 1, 32, 1),
(33, 1, 33, 1),
(34, 1, 34, 1),
(35, 1, 35, 1),
(36, 1, 36, 1),
(37, 1, 37, 1),
(38, 1, 38, 1),
(39, 1, 39, 1),
(40, 1, 40, 1),
(41, 1, 41, 1),
(42, 1, 42, 1),
(43, 1, 43, 1),
(44, 1, 44, 1),
(45, 1, 45, 1),
(46, 1, 46, 1),
(47, 1, 47, 1),
(48, 1, 48, 1),
(49, 1, 49, 1),
(50, 1, 50, 1),
(51, 1, 51, 1),
(52, 1, 52, 1),
(53, 1, 53, 1),
(54, 1, 54, 1),
(55, 1, 55, 1),
(56, 1, 56, 1),
(57, 2, 1, 1),
(58, 2, 2, 1),
(59, 2, 3, 1),
(60, 2, 4, 1),
(61, 2, 5, 1),
(62, 2, 6, 1),
(63, 2, 7, 1),
(64, 2, 8, 1),
(65, 2, 9, 1),
(66, 2, 10, 1),
(67, 2, 11, 1),
(68, 2, 12, 1),
(69, 2, 13, 1),
(70, 2, 14, 1),
(71, 2, 15, 1),
(72, 2, 16, 1),
(73, 2, 17, 1),
(74, 2, 18, 1),
(75, 2, 19, 1),
(76, 2, 20, 1),
(77, 2, 21, 1),
(78, 2, 22, 1),
(79, 2, 23, 1),
(80, 2, 24, 1),
(81, 2, 25, 1),
(82, 2, 26, 1),
(83, 2, 27, 1),
(84, 2, 28, 1),
(85, 2, 29, 1),
(86, 2, 30, 1),
(87, 2, 31, 1),
(88, 2, 32, 1),
(89, 2, 33, 1),
(90, 2, 34, 1),
(91, 2, 35, 1),
(92, 2, 36, 1),
(93, 2, 37, 1),
(94, 2, 38, 1),
(95, 2, 39, 1),
(96, 2, 40, 1),
(97, 2, 41, 1),
(98, 2, 42, 1),
(99, 2, 43, 1),
(100, 2, 44, 1),
(101, 2, 45, 1),
(102, 2, 46, 1),
(103, 2, 47, 1),
(104, 2, 48, 1),
(105, 2, 49, 1),
(106, 2, 50, 1),
(107, 2, 51, 1),
(108, 2, 52, 1),
(109, 2, 53, 1),
(110, 2, 54, 1),
(111, 2, 55, 1),
(112, 2, 56, 1),
(113, 1, 57, 1),
(114, 1, 58, 1),
(115, 1, 59, 1),
(116, 1, 60, 1),
(117, 1, 61, 1),
(118, 1, 62, 1),
(119, 1, 63, 1),
(120, 1, 64, 1),
(121, 2, 57, 1),
(122, 2, 58, 1),
(123, 2, 59, 1),
(124, 2, 60, 1),
(125, 2, 61, 1),
(126, 2, 62, 1),
(127, 2, 63, 1),
(128, 2, 64, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `adjustment_tab`
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
-- Dumping data untuk tabel `adjustment_tab`
--

INSERT INTO `adjustment_tab` (`aid`, `abcid`, `aidid`, `atype`, `aatype`, `adate`, `astockbegining`, `astockin`, `astockout`, `astockreject`, `astockretur`, `atotal`, `astock`) VALUES
(1, 1, 1, 1, 1, 1403381242, 0, 0, 0, 0, 0, 10, 10),
(2, 1, 2, 1, 1, 1403381242, 0, 0, 0, 0, 0, 2, 10),
(3, 1, 3, 1, 0, 1403381242, 0, 0, 0, 0, 0, 4, 0),
(4, 1, 4, 1, 1, 1403381242, 0, 0, 0, 0, 0, 5, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `area_tab`
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
-- Dumping data untuk tabel `area_tab`
--

INSERT INTO `area_tab` (`aid`, `acode`, `aname`, `adesc`, `astatus`) VALUES
(1, 'XSA232', 'palma', 'asasassas', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `books_group_tab`
--

CREATE TABLE IF NOT EXISTS `books_group_tab` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bcode` varchar(50) DEFAULT NULL,
  `bname` varchar(150) DEFAULT NULL,
  `bdesc` varchar(350) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT '0',
  `bparent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `books_group_tab`
--

INSERT INTO `books_group_tab` (`bid`, `bcode`, `bname`, `bdesc`, `bstatus`, `bparent`) VALUES
(1, 'XSA232', '2232', 'asas', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `books_tab`
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
-- Dumping data untuk tabel `books_tab`
--

INSERT INTO `books_tab` (`bid`, `bcode`, `bauthor`, `bpublisher`, `bgroup`, `btitle`, `btax`, `bprice`, `bpack`, `bdisc`, `bisbn`, `bhw`, `boplahprint`, `bmonthyear`, `btotalpages`, `bdesc`, `bstatus`) VALUES
(1, 'AXAAS', 'palma', 1, 1, 'wew', 1, 100000, 1, 10, '10101001', '121*12', 'wew', '06/2004', 1000, 'test', 1),
(2, 'A123', NULL, 2, 1, 'Buku satu', 0, 10000, 1, 10, '100', '1*1', NULL, NULL, NULL, '2002', 1),
(3, 'B0005', NULL, 3, 1, 'Buku Baru', 0, 789987, 1, 12, '78980809', '1*1', NULL, NULL, NULL, 'okkk', 1),
(4, 'AWA101', NULL, 2, 1, 'Awal', 0, 1500, 1, 20, 'AWAL', '1*1', NULL, NULL, NULL, 'Buku', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `branch_tab`
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
-- Dumping data untuk tabel `branch_tab`
--

INSERT INTO `branch_tab` (`bid`, `bcode`, `bname`, `bnpwp`, `baddr`, `bcity`, `bprovince`, `bphone`, `bstatus`) VALUES
(1, NULL, 'Pusat', '1121', 'Gunung Sahari', 1, 1, '121212*1213', 1),
(4, NULL, 'Perwakilan A', NULL, NULL, 1, 1, '43535*324324', 1),
(5, NULL, 'Perwakilan B', NULL, NULL, 1, 1, '43545*', 1),
(6, NULL, 'Perwakilan C', NULL, NULL, 1, 1, '435454*', 1),
(8, 'wewe', 'Perwakilan Daerah Bandung', '86788767', 'Bandung', 2, 2, '8798798979*8799898798', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `city_tab`
--

CREATE TABLE IF NOT EXISTS `city_tab` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(30) NOT NULL,
  `cstatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `city_tab`
--

INSERT INTO `city_tab` (`cid`, `cname`, `cstatus`) VALUES
(1, 'Jakarta', 0),
(2, 'Bandung', 0),
(3, 'Semarang', 0),
(4, 'Yogjakarta', 0),
(5, 'Medan', 0),
(6, 'Malang', 0),
(7, 'Surabaya', 0),
(8, 'Lampung', 0),
(9, 'Bogor', 0),
(10, 'Padang', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa_detail_tab`
--

CREATE TABLE IF NOT EXISTS `coa_detail_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cbid` int(10) NOT NULL,
  `cidid` int(11) NOT NULL,
  `csaldo` int(10) NOT NULL,
  `cdebet` int(10) NOT NULL,
  `ccredit` int(10) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa_tab`
--

CREATE TABLE IF NOT EXISTS `coa_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `catype` int(2) DEFAULT NULL,
  `ctype` tinyint(1) DEFAULT '0',
  `ccode` varchar(50) DEFAULT NULL,
  `cname` varchar(150) DEFAULT NULL,
  `cdesc` varchar(300) DEFAULT NULL,
  `cparent` int(10) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `coa_tab`
--

INSERT INTO `coa_tab` (`cid`, `catype`, `ctype`, `ccode`, `cname`, `cdesc`, `cparent`, `cstatus`) VALUES
(1, 2, 1, 'asas', 'Semarang', 'asasa', 0, 1),
(2, 1, 0, '1101', 'Bank', 'wewe', 0, 1),
(3, 1, 0, '1231', 'BCA', '232', 2, 1),
(4, 1, 0, '2323', 'Mandiri', 'wwwww', 2, 1),
(5, 1, 0, '11011', 'Finance', 'Finance', 4, 1),
(6, 1, 0, 'AD', 'Jakarta', 'Test', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_group_tab`
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
-- Dumping data untuk tabel `customer_group_tab`
--

INSERT INTO `customer_group_tab` (`cgid`, `cgcode`, `cgname`, `cgdesc`, `cgstatus`) VALUES
(1, 'CUS0001', 'Gramedia', 'Gramedia Group', 1),
(2, 'CUS002', 'Non Gramedia', 'Non Gramed', 1),
(3, 'CUS003', 'Perwakilan', 'Perwakilan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_tab`
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
-- Dumping data untuk tabel `customer_tab`
--

INSERT INTO `customer_tab` (`cid`, `cbid`, `ccode`, `cname`, `cnametax`, `caddrtax`, `caddr`, `ccity`, `cprovince`, `cphone`, `cemail`, `cnpwp`, `cnpwplong`, `cdisc`, `ctax`, `cgroup`, `carea`, `ccreditlimit`, `ccredittime`, `ctype`, `cstatus`) VALUES
(1, 1, 'P001', 'Palma', NULL, NULL, 'jakarta', 1, 1, '9130193039*232323', 'admin@adminc.om', '12i01380138', NULL, 10, 1, 1, 1, 1, NULL, 1, 1),
(2, 1, 'B001', 'Bareksa', NULL, NULL, 'jakart', 1, 1, '987890809*89809890', 'ss@ss.com', '900989-', NULL, 8, 0, 1, 1, 10000, NULL, 0, 1),
(3, 4, 'N001', 'NIAGA', NULL, NULL, 'Jakarta', 1, 2, '98090-9-888*676887', 'fff@gg.com', '879878', NULL, 10, 0, 1, 1, 15, NULL, 1, 1),
(4, 8, 'GR001', 'Gramedia Jakarta', NULL, NULL, 'Jakarta', 1, 1, '9808809*09808080', 'tes@tes.com', '080989089', NULL, 10, 1, 1, 1, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribution_book_tab`
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
-- Dumping data untuk tabel `distribution_book_tab`
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
-- Struktur dari tabel `distribution_request_tab`
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
-- Dumping data untuk tabel `distribution_request_tab`
--

INSERT INTO `distribution_request_tab` (`did`, `dbfrom`, `dbto`, `ddate`, `dtitle`, `ddesc`, `dstatus`) VALUES
(1, 5, 4, 1404722046, 'wews', 'wew', 1),
(2, 5, 6, 1404848643, 'wew', 'desc', 1),
(3, 5, 8, 1404833133, 'oio', 'wew', 3),
(4, 6, 1, 1405052181, 'Reques', 'req', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribution_tab`
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
-- Dumping data untuk tabel `distribution_tab`
--

INSERT INTO `distribution_tab` (`did`, `ddrid`, `ddocno`, `ddate`, `dtitle`, `ddesc`, `dstatus`) VALUES
(1, 2, 'AXPAL', 1404828981, 'keren abiss', 'eeeeeeeeeee', 3),
(2, 3, 'AXPAL', 1404832700, 'wew', 'wew', 3),
(3, 4, 'TR001', 1405052319, 'Request Cabang A', 'mote', 3),
(4, 4, 'www', 1407340800, 'Reques', 'wwwww', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups_tab`
--

CREATE TABLE IF NOT EXISTS `groups_tab` (
  `gid` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) NOT NULL,
  `gdesc` text NOT NULL,
  `gstatus` int(1) DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `groups_tab`
--

INSERT INTO `groups_tab` (`gid`, `gname`, `gdesc`, `gstatus`) VALUES
(1, 'Root', 'Root', 1),
(2, 'palma', 'rest', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang_tab`
--

CREATE TABLE IF NOT EXISTS `gudang_tab` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(25) NOT NULL,
  `gtype` enum('niaga','publisher','customer') NOT NULL,
  `gbcpid` int(11) DEFAULT NULL,
  `gbid` int(11) DEFAULT NULL,
  `gcid` int(11) DEFAULT NULL,
  `gpid` int(11) DEFAULT NULL,
  `gstatus` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10004 ;

--
-- Dumping data untuk tabel `gudang_tab`
--

INSERT INTO `gudang_tab` (`gid`, `gname`, `gtype`, `gbcpid`, `gbid`, `gcid`, `gpid`, `gstatus`) VALUES
(1, 'Gudang Pusat', 'niaga', 1, 1, NULL, NULL, 1),
(2, 'Gudang A', 'niaga', 1, 1, NULL, NULL, 1),
(3, 'Gudang C', 'niaga', 4, 4, NULL, NULL, 1),
(4, 'Gudang D', 'niaga', 5, 5, NULL, NULL, 1),
(5, 'Gd Gramed', 'customer', 4, NULL, 4, NULL, 1),
(6, 'Gd Penerbit 1', 'publisher', 3, NULL, NULL, 3, 1),
(7, 'Penerbit 2', 'publisher', 2, NULL, NULL, NULL, 1),
(8, 'Penerbit 3', 'publisher', 3, NULL, NULL, NULL, 1),
(10000, 'other', 'customer', 10000, NULL, NULL, NULL, 1),
(10001, 'Gd Bareksa', 'customer', 2, NULL, NULL, NULL, 1),
(10002, 'Gd Niaga', 'customer', 3, NULL, NULL, NULL, 1),
(10003, 'Gd Palma', 'customer', 1, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_penjualan_tab`
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
-- Dumping data untuk tabel `hasil_penjualan_tab`
--

INSERT INTO `hasil_penjualan_tab` (`hid`, `hnofaktur`, `hcid`, `htax`, `htanggal`, `hdefaultdisc`, `hqty`, `htotal`, `hongkos`, `hdisc`, `hgrandtotal`, `hinfo`, `hstatus`) VALUES
(1, 'HP987989', 1, '1', '2014-06-03', 5, 12, 1200000, 10000, 2, 120000, 'manteppp', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_tab`
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
-- Dumping data untuk tabel `inventory_tab`
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
-- Struktur dari tabel `letter_tab`
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
-- Dumping data untuk tabel `letter_tab`
--

INSERT INTO `letter_tab` (`lid`, `ltype`, `liid`, `ldate`, `ldesc`, `lstatus`) VALUES
(1, 1, 3, 1404856099, 'wwwwwwwwww', 3),
(2, 2, 8, 1404858133, 'wwwwwwww', 3),
(3, 1, 4, 1405052444, '', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `opname_tab`
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
-- Dumping data untuk tabel `opname_tab`
--

INSERT INTO `opname_tab` (`oid`, `obid`, `oidid`, `otype`, `odate`, `ostockbegining`, `ostockin`, `ostockout`, `ostockreject`, `ostockretur`, `ostock`) VALUES
(1, NULL, 2, 1, 1403381242, 10, 1, 1, 1, NULL, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_tab`
--

CREATE TABLE IF NOT EXISTS `permission_tab` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(45) DEFAULT NULL,
  `pdesc` varchar(150) DEFAULT NULL,
  `purl` varchar(45) DEFAULT NULL,
  `pparent` int(10) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data untuk tabel `permission_tab`
--

INSERT INTO `permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES
(1, 'BranchView', 'Branch View', 'branch', 0),
(2, 'BranchAdd', 'Branch Add', 'branch/branch_add', 1),
(3, 'BranchUpdate', 'Branch Update', 'branch/branch_update', 1),
(4, 'BranchDelete', 'Branch Delete', 'Branch Delete', 1),
(5, 'BooksView', 'Books View', 'books', 0),
(6, 'BooksAdd', 'Books Add', 'books/books_add', 5),
(7, 'BooksUpdate', 'Books Update', 'books/books_update', 5),
(8, 'BooksDelete', 'Books Delete', 'books/books_delete', 5),
(9, 'BooksGroupView', 'Books Group View', 'books_group', 0),
(10, 'BooksGroupAdd', 'Books Group Add', 'books_group/books_group_add', 9),
(11, 'BooksGroupUpdate', 'Books Group Update', 'books_group/books_group_update', 9),
(12, 'BooksGroupDelete', 'Books Group Delete', 'books_group/books_group_delete', 9),
(13, 'AreaView', 'Area View', 'area', 0),
(14, 'AreaAdd', 'Area Add', 'area/area_add', 13),
(15, 'AreaUpdate', 'Area Update', 'area/area_update', 13),
(16, 'AreaDelete', 'Area Delete', 'area/area_delete', 13),
(17, 'PublisherView', 'Publisher View', 'publisher', 0),
(18, 'PublisherAdd', 'Publisher Add', 'publisher/publisher_add', 17),
(19, 'PublisherUpdate', 'Publisher Update', 'publisher/publisher_update', 17),
(20, 'PublisherDelete', 'Publisher Delete', 'publisher/publisher_delete', 17),
(21, 'CustomerView', 'Customer View', 'customer', 0),
(22, 'CustomerAdd', 'Customer Add', 'customer/customer_add', 21),
(23, 'CustomerUpdate', 'Customer Update', 'customer/customer_update', 21),
(24, 'CustomerDelete', 'Customer Delete', 'customer/customer_delete', 21),
(25, 'BooksLocationView', 'Books Location View', 'locator', 0),
(26, 'BooksLocationAdd', 'Books Location Add', 'locator/locator_add', 25),
(27, 'BooksLocationUpdate', 'Books Location Update', 'locator/locator_update', 25),
(28, 'BooksLocationDelete', 'Books Location Delete', 'locator/locator_delete', 25),
(29, 'TaxesView', 'Taxes View', 'tax', 0),
(30, 'TaxesAdd', 'Taxes Add', 'tax/tax_add', 29),
(31, 'TaxesUpdate', 'Taxes Update', 'tax/tax_update', 29),
(32, 'TaxesDelete', 'Taxes Delete', 'tax/tax_delete', 29),
(33, 'CatalogView', 'Catalog View', 'catalog', 0),
(34, 'CatalogAdd', 'Catalog Add', 'catalog/catalog_add', 33),
(35, 'CatalogUpdate', 'Catalog Update', 'catalog/catalog_update', 33),
(36, 'CatalogDelete', 'Catalog Delete', 'catalog/catalog_delete', 33),
(37, 'CategoryArsipView', 'Category Arsip View', 'category_arsip', 0),
(38, 'CategoryArsipAdd', 'Category Arsip Add', 'category_arsip/category_arsip_add', 37),
(39, 'CategoryArsipUpdate', 'Category Arsip Update', 'category_arsip/category_arsip_update', 37),
(40, 'CategoryArsipDelete', 'Category Arsip Delete', 'category_arsip/category_arsip_delete', 37),
(41, 'ArsipView', 'Arsip View', 'arsip', 0),
(42, 'ArsipAdd', 'Arsip Add', 'arsip/arsip_add', 41),
(43, 'ArsipUpdate', 'Arsip Update', 'arsip/arsip_update', 41),
(44, 'ArsipDelete', 'Arsip Delete', 'arsip/arsip_delete', 41),
(45, 'PromotionView', 'Promotion View', 'promo', 0),
(46, 'PromotionAdd', 'Promotion Add', 'promo/promo_add', 45),
(47, 'PromotionUpdate', 'Promotion Update', 'promo/promo_update', 45),
(48, 'PromotionDelete', 'Promotion Delete', 'promo/promo_delete', 45),
(49, 'CityView', 'City View', 'city', 0),
(50, 'CityAdd', 'City Add', 'city/city_add', 49),
(51, 'CityUpdate', 'City Update', 'city/city_update', 49),
(52, 'CityDelete', 'City Delete', 'city/city_delete', 49),
(53, 'ProvinceView', 'Province View', 'province', 0),
(54, 'ProvinceAdd', 'Province Add', 'province/province_add', 53),
(55, 'ProvinceUpdate', 'Province Update', 'province/province_update', 53),
(56, 'ProvinceDelete', 'Province Delete', 'province/province_delete', 53),
(57, 'UsersView', 'Users View', 'users', 0),
(58, 'UsersAdd', 'Users Add', 'users/users_add', 57),
(59, 'UsersUpdate', 'Users Update', 'users/users_update', 57),
(60, 'UsersDelete', 'Users Delete', 'users/users_delete', 57),
(61, 'UsersGroupView', 'Users Group View', 'users/users_group', 0),
(62, 'UsersGroupAdd', 'Users Group Add', 'users/users_group_add', 61),
(63, 'UsersGroupUpdate', 'Users Group Update', 'users/users_group_update', 61),
(64, 'UsersGroupDelete', 'Users Group Delete', 'users/users_group_delete', 61);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pm_tab`
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
-- Dumping data untuk tabel `pm_tab`
--

INSERT INTO `pm_tab` (`pid`, `pdate`, `pfrom`, `pto`, `psubject`, `pmsg`, `pstatus`, `pfdelete`, `ptdelete`) VALUES
(5, 1403421766, 1, 1, 'qqqqqq', 'wewe', 1, 0, 0),
(6, 1403422601, 1, 1, 'tesss', 'aaaaaa\n\n-------\nqqqqqq\nwewe                        ', 1, 0, 0),
(7, 1405063183, 1, 1, 'Hallow', 'Req ID 100 tolong di Dis Approve', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `province_tab`
--

CREATE TABLE IF NOT EXISTS `province_tab` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(30) NOT NULL,
  `pstatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `province_tab`
--

INSERT INTO `province_tab` (`pid`, `pname`, `pstatus`) VALUES
(1, 'DI Aceh', 1),
(2, 'Sumatera Utara', 1),
(3, 'Sumatera Barat', 1),
(4, 'Sumatera Selatan', 1),
(5, 'DKI Jakarta', 1),
(6, 'Jawa Barat', 1),
(7, 'Jawa Tengah', 1),
(8, 'Jawa Timur', 1),
(9, 'Lampung', 1),
(10, 'Kalimantan Timur', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `publisher_tab`
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
  `pmcode` varchar(10) DEFAULT NULL,
  `pdesc` varchar(350) DEFAULT NULL,
  `pstatus` tinyint(1) DEFAULT '0',
  `pparent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `publisher_tab`
--

INSERT INTO `publisher_tab` (`pid`, `pcode`, `pname`, `paddr`, `pcity`, `pprov`, `pphone`, `pemail`, `pnpwp`, `pcreditlimit`, `pcreditday`, `pcp`, `pcategory`, `pmcode`, `pdesc`, `pstatus`, `pparent`) VALUES
(1, 'asas', 'Gramedia', 'aaaaaaaa', 1, 1, '091029012*121212*121212', 'admin@admin.com', '121212', 1, 1, 'Mamam', NULL, NULL, '10', 1, 0),
(2, 'XSA232', 'admins', NULL, 1, 2, '989898*1213*1212', 'palmagratcy@gmail.com', 'aaaa', 1, 1, 'wew', NULL, NULL, '12121', 1, 0),
(3, 'P0123', 'Penerbit PPPP', 'Jakarta', 1, 1, '8909809*908080*80908099809', 'ss@ss.com', '8708900687', 120000, 4, 'ss', 'External', NULL, 'ok', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `receiving_books_tab`
--

CREATE TABLE IF NOT EXISTS `receiving_books_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rrid` int(10) DEFAULT NULL,
  `rbcid` int(10) DEFAULT NULL,
  `rbid` int(10) DEFAULT NULL,
  `rqty` int(10) DEFAULT NULL,
  `rstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `receiving_books_tab`
--

INSERT INTO `receiving_books_tab` (`rid`, `rrid`, `rbcid`, `rbid`, `rqty`, `rstatus`) VALUES
(1, 2, 1, 2, 1311, 1),
(2, 2, 1, 1, 132, 1),
(3, 1, 1, 3, 0, 1),
(4, 3, 1, 3, 2, 1),
(5, 3, 1, 4, 1, 1),
(6, 4, 1, 1, 10, 1),
(7, 4, 1, 2, 20, 1),
(8, 4, 1, 3, 30, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `receiving_tab`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `receiving_tab`
--

INSERT INTO `receiving_tab` (`rid`, `rtype`, `rdocno`, `riid`, `rdate`, `rdesc`, `rstatus`) VALUES
(1, 2, 'www', 3, 1405063857, 'wwwwwwwwww', 3),
(2, 1, 'AXPAL', 3, 1404848462, 'wew', 1),
(3, 1, 'AXPAL', 3, 1405163547, 'wew', 3),
(4, 2, '12345', 2, 0, 'TESTING', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spo_tab`
--

CREATE TABLE IF NOT EXISTS `spo_tab` (
  `sid` int(11) NOT NULL,
  `sno_spo` varchar(30) NOT NULL,
  `spid` int(11) NOT NULL,
  `stgl_pesan` date NOT NULL,
  `sheader_detail` varchar(30) NOT NULL,
  `sbid` int(11) NOT NULL,
  `sqty` int(11) NOT NULL,
  `sstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_detail_tab`
--

CREATE TABLE IF NOT EXISTS `transaction_detail_tab` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `ttid` int(11) DEFAULT NULL,
  `tbid` int(11) DEFAULT NULL,
  `tqty` int(11) DEFAULT NULL,
  `tharga` double DEFAULT NULL,
  `tdisc` double DEFAULT NULL,
  `ttotal` double DEFAULT NULL,
  `gd_from` int(11) DEFAULT NULL,
  `gd_to` int(11) DEFAULT NULL,
  `tstatus` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `transaction_detail_tab`
--

INSERT INTO `transaction_detail_tab` (`tid`, `ttid`, `tbid`, `tqty`, `tharga`, `tdisc`, `ttotal`, `gd_from`, `gd_to`, `tstatus`) VALUES
(2, 1, 1, 5, NULL, NULL, 0, NULL, NULL, 1),
(3, 1, 1, 17, NULL, NULL, 0, NULL, NULL, 1),
(4, 2, 1, 4, NULL, NULL, 0, NULL, NULL, 1),
(6, 3, 2, 3, NULL, NULL, 0, NULL, NULL, 1),
(7, 3, 4, 4, NULL, NULL, 0, NULL, NULL, 1),
(8, 2, 1, 3, NULL, NULL, 0, NULL, NULL, 1),
(9, 2, 1, 11, NULL, NULL, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_tab`
--

CREATE TABLE IF NOT EXISTS `transaction_tab` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) DEFAULT NULL,
  `tnospo` varchar(25) NOT NULL,
  `tnofaktur` varchar(50) NOT NULL,
  `tcid` int(11) NOT NULL,
  `tpid` int(11) DEFAULT NULL,
  `ttax` varchar(50) NOT NULL,
  `ttgl_spo` date DEFAULT NULL,
  `ttanggal` date DEFAULT NULL,
  `ttype` tinyint(4) NOT NULL,
  `ttypetrans` tinyint(4) NOT NULL,
  `ttotalqty` int(11) NOT NULL,
  `ttotalharga` double NOT NULL,
  `ttotaldisc` double NOT NULL,
  `tongkos` double NOT NULL,
  `tgrandtotal` double NOT NULL,
  `tinfo` text NOT NULL,
  `gd_from` int(11) DEFAULT NULL,
  `gd_to` int(11) DEFAULT NULL,
  `tstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `transaction_tab`
--

INSERT INTO `transaction_tab` (`tid`, `tbid`, `tnospo`, `tnofaktur`, `tcid`, `tpid`, `ttax`, `ttgl_spo`, `ttanggal`, `ttype`, `ttypetrans`, `ttotalqty`, `ttotalharga`, `ttotaldisc`, `tongkos`, `tgrandtotal`, `tinfo`, `gd_from`, `gd_to`, `tstatus`) VALUES
(1, NULL, 'SPO1504180', '', 0, 1, '', '2015-04-28', NULL, 3, 1, 22, 0, 0, 0, 0, 'ok', NULL, NULL, 1),
(2, NULL, 'SPO1504480', '12345', 0, 1, '', '2015-04-28', NULL, 3, 1, 18, 0, 0, 0, 0, 'ok', NULL, NULL, 1),
(3, NULL, 'SPO1504410', 'P0123', 0, 2, '', '2015-04-28', NULL, 3, 2, 7, 0, 0, 0, 0, 'okk', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_all_tab`
--

CREATE TABLE IF NOT EXISTS `trans_all_tab` (
  `id_trans_all` int(11) NOT NULL AUTO_INCREMENT,
  `id_branch` int(11) DEFAULT NULL,
  `no_spo` varchar(25) DEFAULT NULL,
  `no_trans` int(11) DEFAULT NULL,
  `no_penerimaan` int(11) DEFAULT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `date_trans` date DEFAULT NULL,
  `type_trans` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `id_publisher` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `gudang_asal` varchar(25) DEFAULT NULL,
  `gudang_tujuan` varchar(25) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `approval` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  PRIMARY KEY (`id_trans_all`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_tab`
--

CREATE TABLE IF NOT EXISTS `trans_tab` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `ttid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `type_trans` int(11) NOT NULL,
  `type_pay` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty_cid` int(11) NOT NULL,
  `qty_from_pid` int(11) NOT NULL,
  `qty_to_cid` int(11) NOT NULL,
  `qty_from_cid` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `ket_selisih` varchar(35) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `trans_tab`
--

INSERT INTO `trans_tab` (`tid`, `ttid`, `cid`, `type_trans`, `type_pay`, `bid`, `pid`, `qty_cid`, `qty_from_pid`, `qty_to_cid`, `qty_from_cid`, `selisih`, `ket_selisih`, `status`) VALUES
(1, 0, 4, 2, 1, 1, 0, 77, 0, 0, 0, 0, '', 0),
(2, 20, 4, 2, 1, 2, 0, 15, 0, 0, 0, 0, '', 0),
(3, 19, 1, 2, 1, 2, 0, 12, 0, 0, 0, 0, '', 0),
(4, 19, 1, 2, 1, 2, 0, 3, 0, 0, 0, 0, '', 0),
(5, 20, 1, 2, 1, 1, 0, 13, 0, 0, 0, 0, '', 0),
(6, 21, 1, 2, 4, 2, 0, 10, 0, 0, 0, 0, '', 0),
(7, 22, 2, 2, 4, 1, 0, 7, 0, 0, 0, 0, '', 0),
(8, 2, 4, 2, 1, 4, 0, 7, 0, 0, 0, 0, '', 0),
(9, 2, 4, 2, 1, 1, 0, 9, 0, 0, 0, 0, '', 0),
(10, 5, 1, 2, 1, 1, 0, 15, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_tab`
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
-- Dumping data untuk tabel `users_tab`
--

INSERT INTO `users_tab` (`uid`, `ugid`, `ubid`, `uemail`, `upass`, `ulastlogin`, `ustatus`) VALUES
(1, 1, 1, 'admin@admin.com', 'e89591ee9b8e7018511649a2146ae279', '*1430219415', 1),
(2, 1, 2, 'palma@admin.com', 'e89591ee9b8e7018511649a2146ae279', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
