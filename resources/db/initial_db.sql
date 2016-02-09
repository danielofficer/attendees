# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: coding-test
# Generation Time: 2015-12-01 11:33:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attendees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendees`;

CREATE TABLE `attendees` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `attendees` WRITE;
/*!40000 ALTER TABLE `attendees` DISABLE KEYS */;

INSERT INTO `attendees` (`id`, `id_company`, `firstname`, `lastname`, `email`)
VALUES
	(1,2,'MacKenzie','Ferrell','imperdiet@euodio.ca'),
	(2,7,'Lana','Boone','nibh.Donec@Fusce.com'),
	(3,1,'Nelle','Fulton','eu.metus.In@natoquepenatibus.ca'),
	(4,3,'Rajah','Day','amet@penatibus.ca'),
	(5,5,'Destiny','Cline','Duis@acorciUt.co.uk'),
	(6,2,'Evan','Orr','feugiat@convallis.org'),
	(7,6,'Oscar','Richards','lectus.pede.ultrices@Nullam.co.uk'),
	(8,4,'Audrey','Kirby','auctor.odio.a@iaculisodioNam.co.uk'),
	(9,5,'Quyn','Reid','Nam@diamat.org'),
	(10,1,'Bruce','Potter','mi.Duis.risus@arcuSedeu.net'),
	(11,1,'Mannix','Cohen','gravida@fermentum.com'),
	(12,3,'Kitra','Walsh','Aenean.euismod.mauris@pretiumetrutrum.org'),
	(13,4,'Wilma','Patterson','ut.molestie.in@duilectusrutrum.org'),
	(14,2,'Lillian','Mooney','sit@a.com'),
	(15,7,'Yeo','Waller','rutrum.magna.Cras@lorem.org');

/*!40000 ALTER TABLE `attendees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`)
VALUES
	(1,'Aliquam Eros Turpis Corp.'),
	(2,'At Inc.'),
	(3,'Class Aptent Industries'),
	(4,'Consequat LLP'),
	(6,'In Dolor Fusce Ltd'),
	(7,'Nec Urna Et Foundation'),
	(8,'Tincidunt Incorporated');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
