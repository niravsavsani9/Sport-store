-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database_2110222
CREATE DATABASE IF NOT EXISTS `database_2110222` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database_2110222`;

-- Dumping structure for procedure database_2110222.customer_delete
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.customer_insert
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.customer_select_all
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.customer_select_one
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.customer_update
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.login
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.order_delete
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.order_insert
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.order_load
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.order_select_all
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.order_select_one
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.order_update
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.product_delete
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.product_insert
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.product_select_all
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.product_select_one
DELIMITER //
//
DELIMITER ;

-- Dumping structure for procedure database_2110222.product_update
DELIMITER //
//
DELIMITER ;

-- Dumping structure for view database_2110222.showorders_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `showorders_view` (
	`customer_id` CHAR(36) NULL COLLATE 'utf8mb4_general_ci',
	`firstname` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci',
	`lastname` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci',
	`address` VARCHAR(25) NULL COLLATE 'utf8mb4_general_ci',
	`city` VARCHAR(25) NULL COLLATE 'utf8mb4_general_ci',
	`postal_code` VARCHAR(7) NULL COLLATE 'utf8mb4_general_ci',
	`product_id` CHAR(36) NULL COLLATE 'utf8mb4_general_ci',
	`product_code` CHAR(12) NULL COLLATE 'utf8mb4_general_ci',
	`product_description` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`quantity` SMALLINT(3) NOT NULL,
	`price` DECIMAL(7,2) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view database_2110222.showorders_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `showorders_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `showorders_view` AS select `customers`.`customer_id` AS `customer_id`,`customers`.`firstname` AS `firstname`,`customers`.`lastname` AS `lastname`,`customers`.`address` AS `address`,`customers`.`city` AS `city`,`customers`.`postal_code` AS `postal_code`,`products`.`product_id` AS `product_id`,`products`.`product_code` AS `product_code`,`products`.`product_description` AS `product_description`,`orders`.`quantity` AS `quantity`,`orders`.`price` AS `price` from ((`orders` left join `products` on(`orders`.`product_id` = `products`.`product_id`)) left join `customers` on(`orders`.`customer_id` = `customers`.`customer_id`)) order by `orders`.`create_at`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
