-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2020 at 09:23 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tracking_details`
--

CREATE TABLE `tracking_details` (
  `id` int(255) NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0',
  `hash` varchar(255) NOT NULL,
  `read_time` text,
  `created_at` text,
  `viewing_hash` varchar(255) NOT NULL,
  `receipt_email` varchar(255) NOT NULL,
  `messgae` longtext,
  `subject` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking_details`
--

INSERT INTO `tracking_details` (`id`, `views`, `hash`, `read_time`, `created_at`, `viewing_hash`, `receipt_email`, `messgae`, `subject`) VALUES
(15, 0, '28be8cb91eb371eb2e85e03ff8774be6e1651ec8', NULL, '2020/03/15 13:07:05', '28c27dc588af794dcf15d7d83ba6c3f651f77487', 'dsaha1656@gMAIL.COM', 'FONFLAKEFAE\r\nFA\r\nEF\r\nA\r\nEF\r\nAEEF\r\nA\r\nF\r\nA\r\nF\r\nAF', 'OADDADA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracking_details`
--
ALTER TABLE `tracking_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash` (`hash`),
  ADD UNIQUE KEY `viewing_hash` (`viewing_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracking_details`
--
ALTER TABLE `tracking_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
