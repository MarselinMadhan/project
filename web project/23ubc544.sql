-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 04:51 PM
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
-- Database: `23ubc544`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `name` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`name`, `password`, `role`) VALUES
('admin', 'admin44', 'admin'),
('23ubc544', '123', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `found`
--

CREATE TABLE `found` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `mobile` int(10) NOT NULL,
  `item` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `posted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `found`
--

INSERT INTO `found` (`id`, `names`, `mobile`, `item`, `place`, `posted_by`) VALUES
(3, 'marselin', 2147483647, 'project note', 'ecc lab', 'user'),
(5, 'marselin', 2147483647, 'wallet', 'student notice board', '23ubc544'),
(6, 'viswa', 2147483647, 'file', 'inigo block parking', '23ubc544');

-- --------------------------------------------------------

--
-- Table structure for table `lost`
--

CREATE TABLE `lost` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `names` varchar(100) NOT NULL,
  `mobile` int(10) NOT NULL,
  `item` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `posted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost`
--

INSERT INTO `lost` (`id`, `time`, `names`, `mobile`, `item`, `place`, `posted_by`) VALUES
(4, '26/2/2026 12:12:31 a', 'andrews', 2147483647, 'project note', 'ecc lab', 'qwerty'),
(7, '5/3/2026 7:54:00 pm', 'adithya', 2147483647, 'adhaar  card', 'dont know', '23ubc544');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `posted_by`, `review_text`, `created_at`) VALUES
(2, 'user', 'this website found my note thank you ', '2026-02-26 12:52:28'),
(3, 'qwerty', 'hi the site is useful but it more complicate it understand', '2026-03-03 02:50:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `found`
--
ALTER TABLE `found`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost`
--
ALTER TABLE `lost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `found`
--
ALTER TABLE `found`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lost`
--
ALTER TABLE `lost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
