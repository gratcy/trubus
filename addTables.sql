CREATE DATABASE  IF NOT EXISTS `niaga_swadaya_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `niaga_swadaya_db`;

ALTER TABLE  `coa_tab` DROP  `csaldo` ,
DROP  `cdebet` ,
DROP  `ccredit` ;

CREATE TABLE `coa_detail_tab` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cbid` int(10) NOT NULL,
  `cidid` int(11) NOT NULL,
  `csaldo` int(10) NOT NULL,
  `cdebet` int(10) NOT NULL,
  `ccredit` int(10) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('57', 'UsersView', 'Users View', 'users', '0');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('58', 'UsersAdd', 'Users Add', 'users/users_add', '57');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('59', 'UsersUpdate', 'Users Update', 'users/users_update', '57');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('60', 'UsersDelete', 'Users Delete', 'users/users_delete', '57');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('62', 'UsersGroupAdd', 'Users Group Add', 'users/users_group_add', '61');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('63', 'UsersGroupUpdate', 'Users Group Update', 'users/users_group_update', '61');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('64', 'UsersGroupDelete', 'Users Group Delete', 'users/users_group_delete', '61');
INSERT INTO `niaga_swadaya_db`.`permission_tab` (`pid`, `pname`, `pdesc`, `purl`, `pparent`) VALUES ('61', 'UsersGroupView', 'Users Group View', 'users/users_group', '0');

INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('113', '1', '57', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('114', '1', '58', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('115', '1', '59', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '1', '60', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '1', '61', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`agid`, `apid`, `aaccess`) VALUES ('1', '62', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '1', '63', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '1', '64', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '57', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '58', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '59', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '60', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '61', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '62', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '63', '1');
INSERT INTO `niaga_swadaya_db`.`access_tab` (`aid`, `agid`, `apid`, `aaccess`) VALUES ('', '2', '64', '1');
