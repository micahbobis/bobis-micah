-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 22, 2025 at 01:30 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mockdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'User',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `email`, `Role`, `deleted_at`) VALUES
(1, 'Cruz', 'Juan', 'juan.cruz@example.com', 'Admin', NULL),
(2, 'Reyes', 'Maria', 'maria.reyes@example.com', 'User', NULL),
(3, 'Dela Vega', 'Jose', 'jose.delavega@example.com', 'User', NULL),
(4, 'Santos', 'Ana', 'ana.santos@example.com', 'Moderator', NULL),
(5, 'Lopez', 'Pedro', 'pedro.lopez@example.com', 'User', '2025-09-15 08:30:00'),
(6, 'Gomez', 'Luisa', 'luisa.gomez@example.com', 'User', NULL),
(7, 'Martinez', 'Rico', 'rico.martinez@example.com', 'Admin', NULL),
(8, 'Torres', 'Ella', 'ella.torres@example.com', 'User', NULL),
(9, 'Ramirez', 'Diego', 'diego.ramirez@example.com', 'User', NULL),
(10, 'Valdez', 'Paula', 'paula.valdez@example.com', 'User', '2025-09-10 12:15:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
