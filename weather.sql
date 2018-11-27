-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2018 at 06:28 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weather`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `remote_addr` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temp` float DEFAULT NULL,
  `humidity` float DEFAULT NULL,
  `pm1` int(11) DEFAULT NULL,
  `pm2` int(11) DEFAULT NULL,
  `pm10` int(11) DEFAULT NULL,
  `mq135` int(11) DEFAULT NULL,
  `mq7` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `remote_addr`, `timestamp`, `temp`, `humidity`, `pm1`, `pm2`, `pm10`, `mq135`, `mq7`) VALUES
(2, '::1', '2018-11-27 15:37:07', 27, 40, 0, 0, 0, 0, 0),
(3, '::1', '2018-11-27 15:38:45', 27, 40, 0, 0, 0, 0, 0),
(4, '::1', '2018-11-27 15:41:22', 27, 40, 0, 0, 0, 0, 0),
(5, '::1', '2018-11-27 15:42:03', 27, 40, 0, 0, 0, 0, 0),
(6, '::1', '2018-11-27 15:42:32', 27, 40, 0, 0, 0, 0, 0),
(7, '::1', '2018-11-27 15:43:21', 27, 40, 0, 0, 0, 0, 0),
(8, '::1', '2018-11-27 15:43:42', 27, 40, 0, 30, 0, 0, 0),
(9, '::1', '2018-11-27 15:44:08', 27, 40, 0, 30, 0, 2, 0),
(10, '::1', '2018-11-27 15:45:11', 27, 40, 0, 30, 0, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
