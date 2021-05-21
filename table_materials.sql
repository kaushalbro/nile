-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2021 at 04:22 AM
-- Server version: 5.5.45
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_nile`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_materials`
--

DROP TABLE IF EXISTS `table_materials`;
CREATE TABLE IF NOT EXISTS `table_materials` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(254) NOT NULL,
  `module_code` varchar(254) NOT NULL,
  `module_name` varchar(254) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_materials`
--

INSERT INTO `table_materials` (`material_id`, `teacher_name`, `module_code`, `module_name`, `year`) VALUES
(1, 'teacher1', 'CSY2028', 'MORDERN NETWORK', 2),
(2, 'SHYAM', 'CSY2030', 'WEB APPLICATION', 3),
(3, 'HARI', 'CSY2001', 'COMPUTER NETWORK', 2),
(4, 'teacher1', 'CSY3040', 'DATABASE 3', 3),
(8, 'KUMAR', 'CSY1001', 'PSP', 1),
(9, 'teacher1', 'CSY1002', 'COMPUTER NETWORK', 1),
(10, 'SURESH', 'CSY1003', 'DATABASE 1', 1),
(11, 'DEEPAK', 'CSY1004', 'COMPUTER SYSTEM', 1),
(12, 'HARILAL', 'CSY1020', 'CCNA 1', 1),
(15, 'SURESH', 'CSY2003', 'DATABASE 2', 2),
(16, 'teacher1', 'CSY2004', 'OPERATING SYSTEM', 2),
(17, 'HARILAL', 'CSY2020', 'CCNA 2', 2),
(18, 'teacher1', 'CSY3001', 'WIRELESS TECHNOLOGY', 3),
(19, 'ANKIT', 'CSY3002', 'COMPUTER DESERTAION', 3),
(20, 'SURESH', 'CSY3003', 'ATIFICAL INTELLIGENCE', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
