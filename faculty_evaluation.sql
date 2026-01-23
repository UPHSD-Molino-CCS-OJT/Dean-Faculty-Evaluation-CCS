-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 10:15 AM
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
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `school_year` varchar(20) DEFAULT NULL,
  `total_units` int(11) DEFAULT NULL,
  `subject_handled` varchar(255) DEFAULT NULL,
  `sec1_avg` decimal(5,3) DEFAULT NULL,
  `sec2_avg` decimal(5,3) DEFAULT NULL,
  `sec3_avg` decimal(5,3) DEFAULT NULL,
  `sec4_avg` decimal(5,3) DEFAULT NULL,
  `sec5_avg` decimal(5,3) DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `overall_rating` decimal(5,2) DEFAULT NULL,
  `additional_comments` text DEFAULT NULL,
  `official_complaint` varchar(10) DEFAULT NULL,
  `exceptional_performance` varchar(10) DEFAULT NULL,
  `date_submitted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `faculty_name`, `semester`, `school_year`, `total_units`, `subject_handled`, `sec1_avg`, `sec2_avg`, `sec3_avg`, `sec4_avg`, `sec5_avg`, `total_points`, `overall_rating`, `additional_comments`, `official_complaint`, `exceptional_performance`, `date_submitted`) VALUES
(1, 'Val Patrick Fabregas', '1ST', '2025-2026', 20, 'Sample Subject, Sample Subject, Sample Subject', 5.000, 4.818, 4.800, 4.750, 5.000, 121, 4.85, 'Sample Comment', 'no', 'yes', '2026-01-20 18:38:52'),
(2, 'Marco Antonio Subion', '1ST', '2025-2026', 0, '', 5.000, 5.000, 5.000, 5.000, 5.000, 125, 5.00, 'Sample Comment', 'no', 'yes', '2026-01-20 18:56:12'),
(3, 'Arnold Galve', '1ST', '2025-2026', 20, 'Sample Subject, Sample Subject, Sample Subject', 4.667, 4.818, 5.000, 5.000, 5.000, 122, 4.86, 'Sample Comment', 'no', 'yes', '2026-01-21 08:27:16'),
(4, 'Luvim Eusebio', '2ND', '2025-2026', 20, 'Sample Subject, Sample Subject, Sample Subject', 5.000, 5.000, 5.000, 5.000, 5.000, 125, 5.00, 'SAmple Comment', 'no', 'yes', '2026-01-21 08:34:06'),
(5, 'Roberto Malitao', '1ST', '2025-2026', 0, 'Sample Subject, Sample Subject, Sample Subject', 4.667, 4.818, 4.800, 4.500, 5.000, 119, 4.79, 'Sample Comment', 'no', 'yes', '2026-01-21 16:38:56'),
(6, 'Rolando Quirong', 'SUMMER', '2025-2026', 20, 'Sample Subject, Sample Subject, Sample Subject', 4.667, 4.909, 5.000, 4.750, 5.000, 122, 4.89, 'Sample Comment', 'no', 'yes', '2026-01-21 16:51:19'),
(7, 'Edward Cruz', '1ST', '2024-2025', 30, 'Sample Subject, Sample Subject, Sample Subject', 4.667, 4.818, 4.400, 5.000, 5.000, 119, 4.80, 'Sample Comment', 'no', 'yes', '2026-01-21 17:42:51'),
(8, 'Rolando Quirong', '1ST', '2024-2025', 20, 'Sample Subject, Sample Subject, Sample Subject', 5.000, 5.000, 5.000, 4.750, 5.000, 124, 4.98, 'Sample Comment', 'no', 'yes', '2026-01-21 17:59:52'),
(9, 'Val Patrick Fabregas', 'SUMMER', '2024-2025', 20, '', 4.667, 4.818, 4.600, 4.500, 5.000, 118, 4.77, 'Sample Comment', 'no', 'yes', '2026-01-23 11:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_details`
--

CREATE TABLE `evaluation_details` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `question_code` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_details`
--

INSERT INTO `evaluation_details` (`id`, `evaluation_id`, `question_code`, `rating`) VALUES
(1, 5, 'sec1_q1', 5),
(2, 5, 'sec1_q2', 4),
(3, 5, 'sec1_q3', 5),
(4, 5, 'sec2_q1', 5),
(5, 5, 'sec2_q2', 5),
(6, 5, 'sec2_q3', 4),
(7, 5, 'sec2_q4', 5),
(8, 5, 'sec2_q5', 5),
(9, 5, 'sec2_q6', 5),
(10, 5, 'sec2_q7', 5),
(11, 5, 'sec2_q8', 5),
(12, 5, 'sec2_q9', 5),
(13, 5, 'sec2_q10', 5),
(14, 5, 'sec2_q11', 4),
(15, 5, 'sec3_q1', 5),
(16, 5, 'sec3_q2', 5),
(17, 5, 'sec3_q3', 4),
(18, 5, 'sec3_q4', 5),
(19, 5, 'sec3_q5', 5),
(20, 5, 'sec4_q1', 4),
(21, 5, 'sec4_q2', 5),
(22, 5, 'sec4_q3', 4),
(23, 5, 'sec4_q4', 5),
(24, 5, 'sec5_q1', 5),
(25, 5, 'sec5_q2', 5),
(26, 6, 'sec1_q1', 5),
(27, 6, 'sec1_q2', 5),
(28, 6, 'sec1_q3', 4),
(29, 6, 'sec2_q1', 5),
(30, 6, 'sec2_q2', 5),
(31, 6, 'sec2_q3', 5),
(32, 6, 'sec2_q4', 5),
(33, 6, 'sec2_q5', 5),
(34, 6, 'sec2_q6', 5),
(35, 6, 'sec2_q7', 4),
(36, 6, 'sec2_q8', 5),
(37, 6, 'sec2_q9', 5),
(38, 6, 'sec2_q10', 5),
(39, 6, 'sec2_q11', 5),
(40, 6, 'sec3_q1', 5),
(41, 6, 'sec3_q2', 5),
(42, 6, 'sec3_q3', 5),
(43, 6, 'sec3_q4', 5),
(44, 6, 'sec3_q5', 5),
(45, 6, 'sec4_q1', 5),
(46, 6, 'sec4_q2', 5),
(47, 6, 'sec4_q3', 4),
(48, 6, 'sec4_q4', 5),
(49, 6, 'sec5_q1', 5),
(50, 6, 'sec5_q2', 5),
(51, 7, 'sec1_q1', 5),
(52, 7, 'sec1_q2', 5),
(53, 7, 'sec1_q3', 4),
(54, 7, 'sec2_q1', 5),
(55, 7, 'sec2_q2', 4),
(56, 7, 'sec2_q3', 5),
(57, 7, 'sec2_q4', 4),
(58, 7, 'sec2_q5', 5),
(59, 7, 'sec2_q6', 5),
(60, 7, 'sec2_q7', 5),
(61, 7, 'sec2_q8', 5),
(62, 7, 'sec2_q9', 5),
(63, 7, 'sec2_q10', 5),
(64, 7, 'sec2_q11', 5),
(65, 7, 'sec3_q1', 5),
(66, 7, 'sec3_q2', 4),
(67, 7, 'sec3_q3', 4),
(68, 7, 'sec3_q4', 4),
(69, 7, 'sec3_q5', 5),
(70, 7, 'sec4_q1', 5),
(71, 7, 'sec4_q2', 5),
(72, 7, 'sec4_q3', 5),
(73, 7, 'sec4_q4', 5),
(74, 7, 'sec5_q1', 5),
(75, 7, 'sec5_q2', 5),
(76, 8, 'sec1_q1', 5),
(77, 8, 'sec1_q2', 5),
(78, 8, 'sec1_q3', 5),
(79, 8, 'sec2_q1', 5),
(80, 8, 'sec2_q2', 5),
(81, 8, 'sec2_q3', 5),
(82, 8, 'sec2_q4', 5),
(83, 8, 'sec2_q5', 5),
(84, 8, 'sec2_q6', 5),
(85, 8, 'sec2_q7', 5),
(86, 8, 'sec2_q8', 5),
(87, 8, 'sec2_q9', 5),
(88, 8, 'sec2_q10', 5),
(89, 8, 'sec2_q11', 5),
(90, 8, 'sec3_q1', 5),
(91, 8, 'sec3_q2', 5),
(92, 8, 'sec3_q3', 5),
(93, 8, 'sec3_q4', 5),
(94, 8, 'sec3_q5', 5),
(95, 8, 'sec4_q1', 5),
(96, 8, 'sec4_q2', 5),
(97, 8, 'sec4_q3', 4),
(98, 8, 'sec4_q4', 5),
(99, 8, 'sec5_q1', 5),
(100, 8, 'sec5_q2', 5),
(101, 9, 'sec1_q1', 5),
(102, 9, 'sec1_q2', 4),
(103, 9, 'sec1_q3', 5),
(104, 9, 'sec2_q1', 5),
(105, 9, 'sec2_q2', 5),
(106, 9, 'sec2_q3', 5),
(107, 9, 'sec2_q4', 4),
(108, 9, 'sec2_q5', 5),
(109, 9, 'sec2_q6', 5),
(110, 9, 'sec2_q7', 5),
(111, 9, 'sec2_q8', 5),
(112, 9, 'sec2_q9', 5),
(113, 9, 'sec2_q10', 4),
(114, 9, 'sec2_q11', 5),
(115, 9, 'sec3_q1', 4),
(116, 9, 'sec3_q2', 5),
(117, 9, 'sec3_q3', 4),
(118, 9, 'sec3_q4', 5),
(119, 9, 'sec3_q5', 5),
(120, 9, 'sec4_q1', 5),
(121, 9, 'sec4_q2', 4),
(122, 9, 'sec4_q3', 4),
(123, 9, 'sec4_q4', 5),
(124, 9, 'sec5_q1', 5),
(125, 9, 'sec5_q2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT 'College of Computer Studies',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `department`, `status`, `created_at`) VALUES
(3, 'Val Patrick Fabregas', 'College of Computer Studies', 'active', '2026-01-20 10:27:30'),
(4, 'Roberto Malitao', 'College of Computer Studies', 'active', '2026-01-20 10:27:38'),
(5, 'Homer Favenir', 'College of Computer Studies', 'active', '2026-01-20 10:27:45'),
(6, 'Fe Antonio', 'College of Computer Studies', 'active', '2026-01-20 10:27:52'),
(7, 'Marco Antonio Subion', 'College of Computer Studies', 'active', '2026-01-20 10:28:05'),
(8, 'Luvim Eusebio', 'College of Computer Studies', 'active', '2026-01-20 10:28:14'),
(9, 'Rolando Quirong', 'College of Computer Studies', 'active', '2026-01-20 10:28:28'),
(10, 'Arnold Galve', 'College of Computer Studies', 'active', '2026-01-20 10:28:35'),
(11, 'Edward Cruz', 'College of Computer Studies', 'active', '2026-01-20 10:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$8.0R.Y/1XU.L4U3fQO8fOe.hYk2C1X8x0fJ3J1r7Z5Z.X8f6W5e2q'),
(2, 'AdminCCSDeptEval', '$2y$10$b.doadelqn5.g1CmyG4h/OlogEMVVDVKS28rNw027RWflvKKoE9Aq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_details`
--
ALTER TABLE `evaluation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_id` (`evaluation_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `evaluation_details`
--
ALTER TABLE `evaluation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluation_details`
--
ALTER TABLE `evaluation_details`
  ADD CONSTRAINT `evaluation_details_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
