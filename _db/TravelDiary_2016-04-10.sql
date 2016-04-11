# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.13-MariaDB)
# Database: TravelDiary
# Generation Time: 2016-04-10 21:54:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table api_token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_token`;

CREATE TABLE `api_token` (
  `id_token` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_device` int(10) unsigned NOT NULL,
  `tok_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tok_lastUsed` timestamp NULL DEFAULT NULL,
  `tok_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tok_updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_token`),
  UNIQUE KEY `UNIQUE_tok_value` (`tok_value`),
  KEY `FK_api_token_device` (`id_device`),
  CONSTRAINT `FK_api_token_device` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `api_token` WRITE;
/*!40000 ALTER TABLE `api_token` DISABLE KEYS */;

INSERT INTO `api_token` (`id_token`, `id_device`, `tok_value`, `tok_lastUsed`, `tok_createdAt`, `tok_updatedAt`)
VALUES
	(1,1,'5d6186fc-a852-456b-b2ed-bbf7668b60a5','2016-04-04 18:08:17','2016-03-28 21:03:11','2016-04-04 18:08:17');

/*!40000 ALTER TABLE `api_token` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table device
# ------------------------------------------------------------

DROP TABLE IF EXISTS `device`;

CREATE TABLE `device` (
  `id_device` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `dev_uuid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `dev_version` text COLLATE utf8_unicode_ci,
  `dev_os` text COLLATE utf8_unicode_ci,
  `dev_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dev_updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_device`),
  UNIQUE KEY `UNIQUE_dev_uuid` (`dev_uuid`),
  KEY `FK__user` (`id_user`),
  CONSTRAINT `FK__user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;

INSERT INTO `device` (`id_device`, `id_user`, `dev_uuid`, `dev_version`, `dev_os`, `dev_createdAt`, `dev_updatedAt`)
VALUES
	(1,1,'669ea7a7-b600-4ed9-b85e-13aabd222775',NULL,NULL,'2016-03-18 01:12:25','2016-03-18 01:12:25');

/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table photo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id_photo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_record` int(10) unsigned NOT NULL,
  `pht_uuid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `pht_filename` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `pht_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_photo`),
  UNIQUE KEY `UNIQUE_pht_filename` (`pht_filename`),
  UNIQUE KEY `UNIQUE_pht_uuid` (`pht_uuid`),
  KEY `FK_photo_record` (`id_record`),
  CONSTRAINT `FK_photo_record` FOREIGN KEY (`id_record`) REFERENCES `record` (`id_record`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table privacy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `privacy`;

CREATE TABLE `privacy` (
  `id_privacy` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prv_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prv_description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_privacy`),
  UNIQUE KEY `UNIQUE_prv_code` (`prv_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `privacy` WRITE;
/*!40000 ALTER TABLE `privacy` DISABLE KEYS */;

INSERT INTO `privacy` (`id_privacy`, `prv_code`, `prv_description`)
VALUES
	(1,'PUBLIC','Public'),
	(2,'PRIVATE','Private'),
	(3,'MEMBERS','Members');

/*!40000 ALTER TABLE `privacy` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table record
# ------------------------------------------------------------

DROP TABLE IF EXISTS `record`;

CREATE TABLE `record` (
  `id_record` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_trip` int(10) unsigned NOT NULL,
  `id_recordType` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL DEFAULT '0',
  `rec_uuid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `rec_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rec_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `rec_location` point DEFAULT NULL,
  `rec_altitude` float DEFAULT NULL,
  `rec_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rec_updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `UNIQUE_rec_uuid` (`rec_uuid`),
  KEY `FK_record_recordType` (`id_recordType`),
  KEY `FK_record_trip` (`id_trip`),
  KEY `INDEX_rec_day` (`rec_day`),
  KEY `FK_record_user` (`id_user`),
  CONSTRAINT `FK_record_recordType` FOREIGN KEY (`id_recordType`) REFERENCES `recordType` (`id_recordType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_record_trip` FOREIGN KEY (`id_trip`) REFERENCES `trip` (`id_trip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_record_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `record` WRITE;
/*!40000 ALTER TABLE `record` DISABLE KEYS */;

INSERT INTO `record` (`id_record`, `id_trip`, `id_recordType`, `id_user`, `rec_uuid`, `rec_day`, `rec_description`, `rec_location`, `rec_altitude`, `rec_createdAt`, `rec_updatedAt`)
VALUES
	(3,8,1,1,'5b973fb3-5267-4e30-9d01-f96e3fde439a','2015-07-11 00:00:00','Goteborg',X'0000000001010000006C4084B872FE27400A68226C78DA4C40',NULL,'2016-04-04 00:47:46','2016-04-04 00:47:46'),
	(4,8,1,1,'bf8730b8-5423-48dc-a57c-23ea7bdb809a','2015-07-12 00:00:00','Park v Osle',X'0000000001010000009B046F48A37A2540CD751A69A9F64D40',NULL,'2016-04-04 00:50:37','2016-04-04 00:50:37'),
	(17,8,1,1,'0c0357ec-57d3-4773-93df-84d7ebb51706','2015-07-13 00:00:00','Cistinka pri jazere',X'0000000001010000007172BF4351801A4079E9263108344D40',NULL,'2016-04-04 17:43:30','2016-04-04 17:43:30'),
	(18,8,1,1,'ddebae80-dc1a-4145-b031-45af4949fc18','2015-07-14 00:00:00','Chatka pri autobusovej stanici',X'00000000010100000046425BCEA53818403480B74082724D40',NULL,'2016-04-04 17:45:02','2016-04-04 17:45:02'),
	(19,8,1,1,'6022c0b1-71b6-41ef-80e6-c76052d73dac','2015-07-16 00:00:00','Troltunga',X'000000000101000000A228D027F2041B405B7C0A80F1104E40',NULL,'2016-04-04 17:46:57','2016-04-04 17:46:57'),
	(20,8,1,1,'ea485473-a7be-40f9-b2d1-24752a13e829','2015-07-17 00:00:00','Vyhrievana miestnost pri zastavke trajektu',X'000000000101000000FF5BC98E8D601640185B0872501A4E40',NULL,'2016-04-04 17:48:05','2016-04-04 17:48:05'),
	(21,8,1,1,'7cdb4e4b-ca42-4904-88fd-ad37cc225e4d','2015-07-18 00:00:00','Autobusova stanica v meste Knarvik',X'000000000101000000D4D4B2B5BE281540A0A696ADF5454E40',NULL,'2016-04-04 17:49:55','2016-04-04 17:49:55'),
	(22,8,1,1,'3726fada-c732-4613-8e6f-fcd541db2e01','2015-07-19 00:00:00','Pristresok v mestecku Loen',X'0000000001010000006E6E4C4F58621B405053CBD6FAEE4E40',NULL,'2016-04-04 17:52:46','2016-04-04 17:52:46'),
	(23,8,1,1,'c18d141e-9ce3-4a1d-a2ec-461c07ebd607','2015-07-20 00:00:00','Jazero Strynevatnet',X'0000000001010000005DF92CCF839B1B40252367614FF74E40',NULL,'2016-04-04 17:54:02','2016-04-04 17:54:02'),
	(24,8,1,1,'060e99d9-f36b-4d6d-b4c4-0ac387c36fa0','2015-07-21 00:00:00','Chatova oblast v mestecku Ringebu',X'000000000101000000BEC1172653452440F3C81F0C3CC34E40',NULL,'2016-04-04 17:55:25','2016-04-04 17:55:25'),
	(26,8,1,1,'e76a8d9f-03eb-4375-9d85-9f42508528eb','2015-07-22 00:00:00','Odpocivadlo pri cesticke do Elga pri jazere Femund',X'00000000010100000039B4C876BEFF27403C8386FE09FE4E40',NULL,'2016-04-04 17:57:03','2016-04-04 17:57:03'),
	(27,8,1,1,'b9462cab-52e9-48a5-8737-aba35e538b8e','2015-07-24 00:00:00','Sportove a rekreacne stredisko pri meste Falun',X'0000000001010000007B4E7ADFF84A2F4055F65D11FC4F4E40',NULL,'2016-04-04 17:58:31','2016-04-04 17:58:31'),
	(28,8,1,1,'6e02f27d-50b9-4537-8e4e-f2ac32d721da','2015-07-25 00:00:00','Animal park Stockholm',X'000000000101000000A1F831E6AE1D3240183E22A644AA4D40',NULL,'2016-04-04 18:00:25','2016-04-04 18:00:25'),
	(29,8,1,1,'5b312beb-9c2c-4dcf-ac43-a3698ee75354','2015-07-26 00:00:00','Chatka informacneho centra',X'000000000101000000738577B988373140ACC5A70018F74E40',NULL,'2016-04-04 18:02:09','2016-04-04 18:02:09'),
	(30,8,1,1,'c1ef9e68-a8de-4576-8b53-cea988759e89','2015-07-27 00:00:00','Studentske mesto Umea',X'000000000101000000C5E6E3DA504934402670EB6E9EEA4F40',NULL,'2016-04-04 18:03:12','2016-04-04 18:03:12'),
	(31,8,1,1,'9097cf11-667c-4b1f-b88a-b694da2952f2','2015-07-28 00:00:00','Odpocivadlo pri meste Trnio',X'000000000101000000F0164850FC68384038328FFCC1745040',NULL,'2016-04-04 18:04:47','2016-04-04 18:04:47'),
	(32,8,1,1,'af3f060b-d20e-444a-bd0b-907c8818d7d5','2015-07-29 00:00:00','Byt u nejakeho Fina',X'0000000001010000005D6DC5FEB2CB38408A592F8672164E40',NULL,'2016-04-04 18:05:57','2016-04-04 18:05:57'),
	(33,8,1,1,'c8f18f44-cf75-4ef6-9ab0-ba326cd07cb5','2015-07-31 00:00:00','Uprostred niecoho. co vyzera ako stary priemyselny park',X'000000000101000000B0FECF61BEC4384046B1DCD26AB84D40',NULL,'2016-04-04 18:07:13','2016-04-04 18:07:13'),
	(34,8,1,1,'bfaf10bc-d8cb-48cb-811a-68e02033fbc2','2015-08-02 00:00:00','Litovksa dodavka',X'000000000101000000BF9A0304739C3640EFC9C342AD154940',NULL,'2016-04-04 18:08:17','2016-04-04 18:08:17');

/*!40000 ALTER TABLE `record` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table recordType
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recordType`;

CREATE TABLE `recordType` (
  `id_recordType` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ret_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ret_description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_recordType`),
  UNIQUE KEY `UNIQUE_ret_name` (`ret_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `recordType` WRITE;
/*!40000 ALTER TABLE `recordType` DISABLE KEYS */;

INSERT INTO `recordType` (`id_recordType`, `ret_code`, `ret_description`)
VALUES
	(1,'CAMPING','Camping'),
	(2,'HITCHHIKING_START',NULL);

/*!40000 ALTER TABLE `recordType` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id_role` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `UNIQUE_rol_name` (`rol_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;

INSERT INTO `role` (`id_role`, `rol_name`)
VALUES
	(1,'ADMINISTRATOR_ROLE'),
	(4,'BANNED_ROLE'),
	(3,'INACTIVE_ROLE'),
	(2,'USER_ROLE');

/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sta_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `sta_description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_status`),
  UNIQUE KEY `UNIQUE_sta_name` (`sta_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id_status`, `sta_code`, `sta_description`)
VALUES
	(1,'PLANNED','Planned trip'),
	(2,'FINISHED','FInished trip'),
	(3,'CANCELLED','Canceled'),
	(5,'IN_PROGRESS','Trip in progress');

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table trip
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trip`;

CREATE TABLE `trip` (
  `id_trip` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_status` int(10) unsigned NOT NULL,
  `id_privacy` int(10) unsigned NOT NULL,
  `trp_uuid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `trp_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trp_destination` text COLLATE utf8_unicode_ci NOT NULL,
  `trp_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `trp_startDate` date NOT NULL,
  `trp_estimatedArrival` date NOT NULL,
  `trp_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trp_updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_trip`),
  UNIQUE KEY `UNIQUE_trp_uuid` (`trp_uuid`),
  KEY `FK_trip_status` (`id_status`),
  KEY `FK_trip_privacy` (`id_privacy`),
  CONSTRAINT `FK_trip_privacy` FOREIGN KEY (`id_privacy`) REFERENCES `privacy` (`id_privacy`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_trip_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `trip` WRITE;
/*!40000 ALTER TABLE `trip` DISABLE KEYS */;

INSERT INTO `trip` (`id_trip`, `id_status`, `id_privacy`, `trp_uuid`, `trp_name`, `trp_destination`, `trp_description`, `trp_startDate`, `trp_estimatedArrival`, `trp_createdAt`, `trp_updatedAt`)
VALUES
	(8,1,1,'b429b294-ac24-423f-bb5a-a90998dd7612','Norway 2015','Trolltunga, Odda, Norway','A low-cost hitchhiking trip through the Scandinavia and the Baltic states.','2015-07-12','2015-08-04','2016-03-29 21:54:03','2016-03-29 22:06:40');

/*!40000 ALTER TABLE `trip` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(10) unsigned NOT NULL,
  `usr_firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usr_lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usr_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usr_lastSeen` timestamp NULL DEFAULT NULL,
  `usr_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UNIQUE_usr_email` (`usr_email`),
  KEY `FK_user_role` (`id_role`),
  CONSTRAINT `FK_user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id_user`, `id_role`, `usr_firstName`, `usr_lastName`, `usr_email`, `usr_password`, `usr_lastSeen`, `usr_createdAt`, `usr_updatedAt`)
VALUES
	(1,1,'Jakub','Dubec','jakub.dubec@gmail.com','$2y$13$jugbchb1Jxk3/tk92ui.2OioNoicE4XxH4KO.LxcVDXl3kJ55DUUC',NULL,'2016-03-18 01:12:03','2016-03-18 01:12:08');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_have_trip
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_have_trip`;

CREATE TABLE `user_have_trip` (
  `id_user` int(10) unsigned NOT NULL,
  `id_trip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_user`,`id_trip`),
  KEY `FK_user_have_trip_trip` (`id_trip`),
  CONSTRAINT `FK_user_have_trip_trip` FOREIGN KEY (`id_trip`) REFERENCES `trip` (`id_trip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_have_trip_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user_have_trip` WRITE;
/*!40000 ALTER TABLE `user_have_trip` DISABLE KEYS */;

INSERT INTO `user_have_trip` (`id_user`, `id_trip`)
VALUES
	(1,8);

/*!40000 ALTER TABLE `user_have_trip` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
