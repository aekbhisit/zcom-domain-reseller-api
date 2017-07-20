# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17)
# Database: onamae
# Generation Time: 2017-07-20 10:57:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table onamae_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `onamae_log`;

CREATE TABLE `onamae_log` (
  `main_log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_type` varchar(255) DEFAULT NULL,
  `token` text,
  `host` text,
  `url` text,
  `request_path` text,
  `ip_address` varchar(100) DEFAULT NULL,
  `referrer` text,
  `useragent` text,
  `contentlength` text,
  `response` text,
  `cdate` datetime DEFAULT NULL,
  PRIMARY KEY (`main_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table onamae_log_query
# ------------------------------------------------------------

DROP TABLE IF EXISTS `onamae_log_query`;

CREATE TABLE `onamae_log_query` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `main_log_id` int(11) DEFAULT NULL,
  `action_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_text` varchar(700) DEFAULT NULL,
  `response` mediumtext,
  `cdate` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table onamae_premission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `onamae_premission`;

CREATE TABLE `onamae_premission` (
  `premission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`premission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `onamae_premission` WRITE;
/*!40000 ALTER TABLE `onamae_premission` DISABLE KEYS */;

INSERT INTO `onamae_premission` (`premission_id`, `name`)
VALUES
	(1,'owner'),
	(2,'admin'),
	(3,'user');

/*!40000 ALTER TABLE `onamae_premission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table onamae_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `onamae_user`;

CREATE TABLE `onamae_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(700) DEFAULT NULL,
  `password` varchar(700) DEFAULT NULL,
  `salt_key` varchar(700) DEFAULT NULL,
  `token` text,
  `premission_id` int(11) DEFAULT NULL,
  `expire_token` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `ip_allow` text,
  `ip_remote_add` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
