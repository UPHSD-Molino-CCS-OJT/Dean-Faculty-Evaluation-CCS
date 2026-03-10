-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2026 at 01:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty_evaluation`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','faculty') DEFAULT 'admin',
  `faculty_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `faculty_id`, `full_name`) VALUES
(1, 'admin', '$2y$10$8.0R.Y/1XU.L4U3fQO8fOe.hYk2C1X8x0fJ3J1r7Z5Z.X8f6W5e2q', 'admin', NULL, NULL),
(2, 'AdminCCSDeptEval', '$2y$10$b.doadelqn5.g1CmyG4h/OlogEMVVDVKS28rNw027RWflvKKoE9Aq', 'admin', NULL, NULL),
(3, 'val.fabregas', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 3, 'Val Patrick Fabregas'),
(4, 'roberto.malitao', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 4, 'Roberto Malitao'),
(5, 'homer.favenir', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 5, 'Homer Favenir'),
(6, 'fe.antonio', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 6, 'Fe Antonio'),
(7, 'marco.subion', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 7, 'Marco Antonio Subion'),
(8, 'luvim.eusebio', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 8, 'Luvim Eusebio'),
(9, 'rolando.quirong', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 9, 'Rolando Quirong'),
(10, 'arnold.galve', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 10, 'Arnold Galve'),
(11, 'edward.cruz', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 11, 'Edward Cruz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_faculty` (`faculty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
