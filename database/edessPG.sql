-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Payment Gateway DB v0.4.1*/
/*Authored by Adib Bazli*/

-- Dumping database structure for unicreds
CREATE DATABASE IF NOT EXISTS `unicreds` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `unicreds`;

-- Dumping structure for table unicreds.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `sessionId` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `itemDiscount` int(11) NOT NULL DEFAULT '0',
  `tax` int(11) NOT NULL DEFAULT '0',
  `subTotal` float NOT NULL DEFAULT '0',
  `grandTotal` float NOT NULL DEFAULT '0',
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `type` enum('c','mc','cr') NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_cart_student` (`userId`) USING BTREE,
  KEY `token` (`token`),
  CONSTRAINT `FK_cart_user` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.cart_course
CREATE TABLE IF NOT EXISTS `cart_course` (
  `cart_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`,`course_id`) USING BTREE,
  KEY `FK_cart_item_cart` (`cart_id`) USING BTREE,
  KEY `productId` (`course_id`) USING BTREE,
  CONSTRAINT `FK_cart_course_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_course_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.cart_mc
CREATE TABLE IF NOT EXISTS `cart_mc` (
  `cart_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`,`sub_id`) USING BTREE,
  KEY `FK_cart_item_cart` (`cart_id`),
  KEY `productId` (`sub_id`) USING BTREE,
  CONSTRAINT `FK_cart_item_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cart_item_microcredential` FOREIGN KEY (`sub_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.cart_order
CREATE TABLE IF NOT EXISTS `cart_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `reference_id` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `payment_method` enum('fpx','card') DEFAULT NULL,
  `pan_number` smallint(6) DEFAULT NULL COMMENT 'last 4 digit if applicable',
  `paid_value` int(11) NOT NULL,
  `amount_value` int(11) NOT NULL,
  `discount_value` int(11) DEFAULT NULL,
  `tax_value` int(11) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_type` enum('c','mc','cr') DEFAULT NULL COMMENT 'course, micro-cred, credit',
  PRIMARY KEY (`order_id`),
  KEY `FK_cart_order_user` (`user_id`),
  CONSTRAINT `FK_cart_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1 COMMENT='Receipt for successful payment for record purpose';

-- Data exporting was unselected.

-- Dumping structure for table unicreds.cart_order_course
CREATE TABLE IF NOT EXISTS `cart_order_course` (
  `order_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`course_id`) USING BTREE,
  KEY `FK_cart_item_cart` (`order_id`) USING BTREE,
  KEY `productId` (`course_id`) USING BTREE,
  CONSTRAINT `FK_cart_order_course_cart_order` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`order_id`),
  CONSTRAINT `FK_cart_order_course_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.cart_order_mc
CREATE TABLE IF NOT EXISTS `cart_order_mc` (
  `order_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`sub_id`) USING BTREE,
  KEY `productId` (`sub_id`) USING BTREE,
  KEY `FK_cart_item_cart` (`order_id`) USING BTREE,
  CONSTRAINT `FK_cart_order_mc_cart_order` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`order_id`),
  CONSTRAINT `FK_cart_order_mc_microcredential` FOREIGN KEY (`sub_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.commission
CREATE TABLE IF NOT EXISTS `commission` (
  `cm_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL COMMENT 'rate (as per payment) for instituition',
  `receivable_amount` mediumint(9) DEFAULT NULL COMMENT 'total payment received after PG fee',
  `payable_amount` mediumint(9) DEFAULT NULL COMMENT 'amount to be paid to instituition',
  `profitable_amount` mediumint(9) DEFAULT NULL COMMENT 'amount owned by unicreds',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cm_id`,`order_id`) USING BTREE,
  KEY `FK_cart_order` (`order_id`),
  KEY `FK_commission_user` (`user_id`),
  CONSTRAINT `FK_commission_cart_order` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`order_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_commission_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.commission_course
CREATE TABLE IF NOT EXISTS `commission_course` (
  `cm_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  KEY `FK_commission_course_course` (`course_id`),
  KEY `FK_commission_course_commission` (`cm_id`),
  CONSTRAINT `FK_commission_course_commission` FOREIGN KEY (`cm_id`) REFERENCES `commission` (`cm_id`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_commission_course_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.commission_mc
CREATE TABLE IF NOT EXISTS `commission_mc` (
  `cm_id` int(11) DEFAULT NULL,
  `mc_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  KEY `FK_commission_mc_commission` (`cm_id`),
  KEY `FK_commission_mc_microcredential` (`mc_id`),
  CONSTRAINT `FK_commission_mc_commission` FOREIGN KEY (`cm_id`) REFERENCES `commission` (`cm_id`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_commission_mc_microcredential` FOREIGN KEY (`mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table unicreds.commission_rate
CREATE TABLE IF NOT EXISTS `commission_rate` (
  `user_id` int(11) NOT NULL,
  `rate` tinyint(4) DEFAULT NULL COMMENT 'rate boleh berubah',
  `sales_id` int(11) DEFAULT NULL COMMENT 'PIC for the rate',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE,
  CONSTRAINT `FK_commission_rate_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
