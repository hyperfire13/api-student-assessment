-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2022 at 12:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `factors_intervention`
--

CREATE TABLE `factors_intervention` (
  `id` int(11) NOT NULL,
  `factor` varchar(255) DEFAULT NULL,
  `intervention` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `factors_intervention`
--

INSERT INTO `factors_intervention` (`id`, `factor`, `intervention`, `created_at`, `deleted_at`) VALUES
(4, 'haha', '[{\"name\":\"hahahass\"}]', '2022-09-30 04:52:47', NULL),
(5, 'popo', '[{\"name\":\"aa\"},{\"name\":\"bb\"},{\"name\":\"sshheesshhh\"}]', '2022-09-30 04:54:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `factors` varchar(255) NOT NULL,
  `base_file` text DEFAULT NULL,
  `result_file` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `year_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `year_name`, `created_at`, `deleted_at`) VALUES
(1, '2019-2020', '2022-09-29 17:32:32', NULL),
(2, '2020-2021', '2022-09-29 17:32:32', NULL),
(3, '2021-2022', '2022-09-29 17:32:50', NULL),
(4, '2023-2024', '2022-09-29 17:32:50', NULL),
(5, '2025-2026', '2022-09-29 17:33:10', NULL),
(6, '2027-2028', '2022-09-29 17:33:10', NULL),
(7, '2022-2023', '2022-09-29 17:33:37', NULL),
(8, '2024-2025', '2022-09-29 17:33:52', NULL),
(9, '2026-2027', '2022-09-29 17:34:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `created_at`, `deleted_at`) VALUES
(1, 'BSIT-1Aaa', '2022-09-29', NULL),
(2, 'BSIT-1B', '2022-09-29', NULL),
(3, 'BSIT-1C', '2022-09-29', NULL),
(4, 'BSIT-1D', '2022-09-29', NULL),
(5, 'aaa', '2022-09-29', NULL),
(6, 'haegegege', '2022-09-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `token` text DEFAULT NULL,
  `user_level` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `token`, `user_level`, `created_at`, `deleted_at`) VALUES
(35, 'kenneth', 'pogi', 'popo', '$2y$10$naJt8CKWTMpKeGf48OjPkexEGVgSZbQ9rZep1qgOJusNAC.S.xmmu', NULL, 1, '2022-09-29 07:13:32', NULL),
(36, 'a', 's', 'd', '$2y$10$t33uFUkFpR3mVJZxPhhQaupOZrOlFKTw0P3Cugvz3G.Vy7/eR1YVW', NULL, 0, '2022-09-29 07:21:27', NULL),
(37, 'kenneth', 'ybanez', 'pogi', '$2y$10$T1f811SCeSW56q8UJHiVNuVMkz7.jVbXV9NZGhiPLEz/37cJn6oem', '$2y$10$TQeiqFKtjaZ56mqWTDlDb.Rz7MavZMskw19ASjPMwa/CNcNpyaFYK', 0, '2022-09-29 07:53:13', NULL),
(38, 'gg', 'gg', 'gg', '$2y$10$JSAM2qpXcsgZ9GvGjAazLeXWEc9A33rnlmBvwWkXtNqzo48LHU.hW', NULL, 1, '2022-09-29 09:28:11', NULL),
(39, 'a', 'a', 'a', '$2y$10$SLK0ezEd1aotDCaLhvJOV.B7xd8v4DeD6HePVX5mNXM9IS6XnOdiu', NULL, 1, '2022-09-29 09:34:36', NULL),
(40, 'r', 'r', 'r', '$2y$10$J0A4vUYT47D7Tx60sVOMkuaSyA57OdcQ/Dm/O4n5Qc1yKC/ehIcBu', NULL, 1, '2022-09-29 09:36:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factors_intervention`
--
ALTER TABLE `factors_intervention`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factors_intervention`
--
ALTER TABLE `factors_intervention`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
