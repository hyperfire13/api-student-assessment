-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 04:08 PM
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
(6, 'Mathematics in the Modern World', '[{\"name\":\"Teacher student coaching\"}]', '2022-10-04 18:44:33', NULL),
(7, 'Introduction to Computing', '[{\"name\":\"Teacher student coaching\"}]', '2022-10-04 18:44:43', NULL),
(8, 'Fundamentals of Programming (C++)', '[]', '2022-10-04 21:44:45', '2022-10-04 15:44:57'),
(9, 'Fundamentals of Programming (C++)', '[{\"name\":\"Teacher student coaching\"}]', '2022-10-04 21:45:22', NULL),
(10, 'Purposive Communication', '[{\"name\":\"Teacher student coaching\"}]', '2022-10-04 21:45:34', NULL),
(11, 'Intermediate Programming(Java)', '[{\"name\":\"Teacher student coaching\"}]', '2022-10-04 21:45:46', NULL),
(12, 'Discrete Mathematics', '[{\"name\":\"Teacher student coaching\"}]', '2022-10-04 21:45:59', NULL);

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

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `year_id`, `factors`, `base_file`, `result_file`, `created_at`, `deleted_at`) VALUES
(115, 8, '[{\"id\":6}]', '20733-8-20221004150137-basefile.csv', 'final-20733-8-20221004150137-basefile.csv', '2022-10-04 21:01:37', NULL),
(116, 9, '[{\"id\":6}]', '28620-9-20221004150212-basefile.csv', 'final-28620-9-20221004150212-basefile.csv', '2022-10-04 21:02:12', NULL),
(118, 2, '[{\"id\":11},{\"id\":10},{\"id\":6}]', '71657-2-20221004154915-basefile.csv', 'final-71657-2-20221004154915-basefile.csv', '2022-10-04 21:49:15', NULL);

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
(1, 'BSIT-1A', '2022-09-29', NULL),
(2, 'BSIT-1B', '2022-09-29', NULL),
(3, 'BSIT-1C', '2022-09-29', NULL),
(4, 'BSIT-1D', '2022-09-29', NULL);

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
(37, 'kenneth', 'ybanez', 'pogi', '$2y$10$T1f811SCeSW56q8UJHiVNuVMkz7.jVbXV9NZGhiPLEz/37cJn6oem', '$2y$10$.kbwePSl14gcVsC5dThp1uf.FCSqRPHuXtOGcAUaeTbI4uy8yyFvy', 0, '2022-09-29 07:53:13', NULL),
(42, 'Son', 'Goku', 'goku', '$2y$10$VsEWuQyHPoJKw5.KBqsBY.pn5prXSmqmlrXK4XOsv/LGcbh/RV0LS', '$2y$10$Ew1fbU2/jcX3iuvcnB0uROpE9PK4moRAmrFHOEdnhGFmabJG2vL.m', 1, '2022-10-04 15:50:31', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
