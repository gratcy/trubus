CREATE DATABASE  IF NOT EXISTS `niaga_swadaya_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `niaga_swadaya_db`;

CREATE TABLE `distribution_book_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `ddrid` int(10) DEFAULT NULL,
  `dbid` int(10) DEFAULT NULL,
  `dqty` int(10) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `distribution_request_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `dbfrom` int(10) DEFAULT NULL,
  `dbto` int(10) DEFAULT NULL,
  `ddate` int(10) DEFAULT NULL,
  `dtitle` varchar(150) DEFAULT NULL,
  `ddesc` varchar(350) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `distribution_tab` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `ddrid` int(10) DEFAULT NULL,
  `ddocno` varchar(10) DEFAULT NULL,
  `ddate` int(10) DEFAULT NULL,
  `dtitle` varchar(150) DEFAULT NULL,
  `ddesc` varchar(350) DEFAULT NULL,
  `dstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `receiving_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rtype` tinyint(1) DEFAULT '1',
  `rdocno` varchar(10) DEFAULT NULL,
  `riid` int(10) DEFAULT NULL,
  `rdate` int(10) DEFAULT NULL,
  `rdesc` varchar(350) DEFAULT NULL,
  `rstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `receiving_books_tab` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rrid` int(10) DEFAULT NULL,
  `rbid` int(10) DEFAULT NULL,
  `rqty` int(10) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `letter_tab` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `ltype` tinyint(1) DEFAULT '1',
  `liid` int(10) DEFAULT NULL,
  `ldate` int(10) DEFAULT NULL,
  `ldesc` varchar(350) DEFAULT NULL,
  `lstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `niaga_swadaya_db`.`branch_tab` 
ADD COLUMN `bcode` VARCHAR(10) NULL AFTER `bid`;

ALTER TABLE `niaga_swadaya_db`.`customer_tab` 
ADD COLUMN `ccode` VARCHAR(10) NULL AFTER `cbid`;

ALTER TABLE `niaga_swadaya_db`.`inventory_tab` 
ADD COLUMN `istockretur` INT(10) NULL AFTER `istockreject`;

ALTER TABLE `niaga_swadaya_db`.`opname_tab` 
ADD COLUMN `ostockretur` INT(10) NULL AFTER `ostockreject`;

ALTER TABLE `niaga_swadaya_db`.`books_tab` 
ADD COLUMN `bauthor` VARCHAR(150) NULL AFTER `bcode`;

ALTER TABLE `niaga_swadaya_db`.`books_tab` 
ADD COLUMN `bhw` VARCHAR(10) NULL AFTER `bisbn`;

ALTER TABLE `niaga_swadaya_db`.`books_tab` 
ADD COLUMN `boplahprint` VARCHAR(50) NULL AFTER `bhw`;

ALTER TABLE `niaga_swadaya_db`.`books_tab` 
ADD COLUMN `bmonthyear` VARCHAR(10) NULL AFTER `boplahprint`;

ALTER TABLE `niaga_swadaya_db`.`books_tab` 
ADD COLUMN `btotalpages` INT(10) NULL AFTER `bmonthyear`;

CREATE TABLE `adjustment_tab` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `abid` int(10) DEFAULT NULL,
  `aidid` int(10) DEFAULT NULL,
  `atype` tinyint(1) DEFAULT '1',
  `adate` int(10) DEFAULT NULL,
  `astockbegining` int(10) DEFAULT NULL,
  `astockin` int(10) DEFAULT NULL,
  `astockout` int(10) DEFAULT NULL,
  `astockreject` int(10) DEFAULT NULL,
  `astockretur` int(10) DEFAULT NULL,
  `astock` int(10) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
