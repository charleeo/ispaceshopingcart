-- CREATE DATABASE IF NOT EXISTS `ispacedb`;
-- USE `moodle`;
CREATE TABLE IF NOT EXISTS `courses_information`
(
  `id` int(11) unsigned not null auto_increment primary key,
  `course_id` int(11) unsigned not null,
  `fullname` varchar(64) COLLATE utf8mb4_unicode_ci not null,
  `shortname` varchar(64) COLLATE utf8mb4_unicode_ci not null,
  `amount` varchar(64) COLLATE utf8mb4_unicode_ci not null,
  `course_image` varchar(64) COLLATE utf8mb4_unicode_ci not null,
  `summary` text COLLATE utf8mb4_unicode_ci not null
)Engine = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cart`
(
  `cart_id` int(11) unsigned not null auto_increment primary key,
  `items_in_cart` varchar(64) COLLATE utf8mb4_unicode_ci not null,
  `expiring_date` datetime COLLATE utf8mb4_unicode_ci not null,
  `paid` TINYINT(4) NOT NULL COLLATE utf8mb4_unicode_ci not null
)Engine = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) unsigned not null auto_increment primary key,
  `transaction_id` int(11) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `email` varchar(175) NOT NULL,
  `currency` varchar(225) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `courses` text NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `transactions`  ADD `plan` VARCHAR(20) NOT NULL  AFTER `courses`,  ADD `due_date` varchar(20) NOT NULL  AFTER `plan`;
ALTER TABLE `transactions`  ADD `children` INT NOT NULL  AFTER `due_date`;

-- ALTER TABLE `courses_information` CHANGE `couse_image` `course_image` VARCHAR(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;


CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL auto_increment PRIMARY KEY,
  `admin_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


