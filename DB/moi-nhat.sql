/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.1.21-MariaDB : Database - hdtqlks
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hdtqlks` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `hdtqlks`;

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `booking` */

insert  into `booking`(`booking_id`,`customer_id`,`quantity`,`start_date`,`end_date`,`state`,`create_date`) values (1,2,1,'2012-03-12','2012-03-12',1,'2017-05-12 11:55:28'),(2,3,3,'2022-02-22','2022-02-22',1,'2017-05-30 09:54:56'),(3,4,3,'2012-12-23','2012-12-23',1,'2017-05-31 00:08:02'),(4,5,3,'2017-05-31','2017-05-31',1,'2017-05-31 09:26:27'),(5,6,1,'2031-11-12','2031-11-12',0,'2017-05-31 09:31:11');

/*Table structure for table `bookingroom` */

DROP TABLE IF EXISTS `bookingroom`;

CREATE TABLE `bookingroom` (
  `bookingroom_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`bookingroom_id`),
  KEY `booking_id` (`booking_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `bookingroom_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookingroom_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `bookingroom` */

insert  into `bookingroom`(`bookingroom_id`,`booking_id`,`room_id`,`state`,`amount`) values (1,1,3,NULL,NULL),(2,1,5,NULL,NULL),(3,1,1,NULL,NULL),(4,2,1,NULL,NULL),(5,2,2,NULL,NULL),(6,2,3,NULL,NULL),(7,3,2,NULL,NULL),(8,3,4,NULL,NULL),(9,3,5,NULL,NULL),(10,4,1,NULL,NULL),(11,4,2,NULL,NULL),(12,4,5,NULL,NULL),(13,5,1,NULL,NULL);

/*Table structure for table `bookingservice` */

DROP TABLE IF EXISTS `bookingservice`;

CREATE TABLE `bookingservice` (
  `bookingservice_id` int(11) NOT NULL AUTO_INCREMENT,
  `bookingroom_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bookingservice_id`),
  KEY `bookingroom_id` (`bookingroom_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `bookingservice_ibfk_1` FOREIGN KEY (`bookingroom_id`) REFERENCES `bookingroom` (`bookingroom_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookingservice_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `bookingservice` */

insert  into `bookingservice`(`bookingservice_id`,`bookingroom_id`,`service_id`,`create_date`) values (3,4,1,'2017-05-30 12:12:08'),(4,7,1,'2017-05-31 00:12:13'),(5,7,3,'2017-05-31 00:13:46'),(6,13,1,'2017-05-31 09:31:41'),(7,13,3,'2017-05-31 09:31:41');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` bit(1) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`customer_id`,`fname`,`lname`,`id`,`dob`,`gender`,`phone`,`address`) values (1,'wer','134234','123','1970-01-01','','123123','1231244'),(2,'Hoang','Loc','1','2031-12-13','','0123456789','Hai Phong'),(3,'Hoang','Loc','277357285800457','2022-02-22','','0123456789','Hai Phong'),(4,'Hoang','Loc','666624680067334','1996-02-27','','0123456789','Hai Phong'),(5,'Hoang','Loc','277357285800457','1996-07-26','','0123456789','Hai Phong'),(6,'Hoang','Loc','277357285800457','2012-03-31','','0123456789','Hai Phong');

/*Table structure for table `guest` */

DROP TABLE IF EXISTS `guest`;

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` bit(1) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`guest_id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `guest_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `guest` */

insert  into `guest`(`guest_id`,`fname`,`lname`,`dob`,`phone`,`gender`,`address`,`id`,`booking_id`) values (1,'Hoang','Lộc','1970-01-01','0123','','Hà Nội','544826632319605',3);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `real_end_date` datetime DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookingroom` (`bookingroom_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `payment` */

insert  into `payment`(`payment_id`,`booking_id`,`real_end_date`,`amount`,`create_date`) values (1,1,'2017-05-30 00:00:00',600000,'2017-05-30 01:04:33'),(2,2,'2017-05-31 00:00:00',400000,'2017-05-31 00:07:01'),(3,3,'2017-05-31 00:00:00',630000,'2017-05-31 00:26:29'),(4,4,'2017-05-31 00:00:00',500000,'2017-05-31 09:27:53');

/*Table structure for table `rank` */

DROP TABLE IF EXISTS `rank`;

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `rank` */

insert  into `rank`(`rank_id`,`rank`) values (1,'Standard'),(2,'Superior'),(3,'Deluxe'),(4,'Suite');

/*Table structure for table `room` */

DROP TABLE IF EXISTS `room`;

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rank_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `state` bit(1) DEFAULT NULL,
  PRIMARY KEY (`room_id`),
  KEY `rank_id` (`rank_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`rank_id`) REFERENCES `rank` (`rank_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `room_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `room` */

insert  into `room`(`room_id`,`room`,`tel`,`rank_id`,`type_id`,`price`,`state`) values (1,'101','101',1,1,100000,''),(2,'102','102',2,2,100000,'\0'),(3,'201','201',3,1,200000,'\0'),(4,'202','202',1,3,200000,'\0'),(5,'301','301',3,1,300000,'\0'),(6,'302','302',4,3,350000,'\0'),(7,'401','401',1,1,300000,'\0');

/*Table structure for table `roomutility` */

DROP TABLE IF EXISTS `roomutility`;

CREATE TABLE `roomutility` (
  `roomutility_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `utility_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`roomutility_id`),
  KEY `room_id` (`room_id`),
  KEY `utility_id` (`utility_id`),
  CONSTRAINT `roomutility_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roomutility_ibfk_2` FOREIGN KEY (`utility_id`) REFERENCES `utility` (`utility_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `roomutility` */

insert  into `roomutility`(`roomutility_id`,`room_id`,`utility_id`) values (1,1,1),(2,2,1),(3,7,1);

/*Table structure for table `service` */

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `service` */

insert  into `service`(`service_id`,`service`,`price`) values (1,'Ăn sáng',10000),(2,'Ăn trưa',15000),(3,'Ăn tối',20000);

/*Table structure for table `type` */

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `type` */

insert  into `type`(`type_id`,`type`) values (1,'Single room'),(2,'Twin room'),(3,'Double room'),(4,'Triple room');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

/*Table structure for table `utility` */

DROP TABLE IF EXISTS `utility`;

CREATE TABLE `utility` (
  `utility_id` int(11) NOT NULL AUTO_INCREMENT,
  `utility` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`utility_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `utility` */

insert  into `utility`(`utility_id`,`utility`) values (1,'Wifi miễn phí');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
