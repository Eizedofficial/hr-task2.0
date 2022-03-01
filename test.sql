-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2022 at 07:36 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `routers`
--

CREATE TABLE `routers` (
  `code` int NOT NULL,
  `type_code` int NOT NULL,
  `serial` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `routers`
--

INSERT INTO `routers` (`code`, `type_code`, `serial`) VALUES
(7, 1, 'a4ASDAS5A'),
(9, 3, '2A5SDA@5we'),
(10, 4, '132AA1-GDR'),
(11, 4, '132AA1-GDF');

-- --------------------------------------------------------

--
-- Table structure for table `router_types`
--

CREATE TABLE `router_types` (
  `code` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `mask` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `router_types`
--

INSERT INTO `router_types` (`code`, `name`, `mask`) VALUES
(1, 'TP-Link TL-WR74', 'XXAAAAAXA'),
(3, 'D-Link DIR 300', 'NXXAAXZXaa'),
(4, 'D-Link DIR-300 S', 'NXXAAXZXXX');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `routers`
--
ALTER TABLE `routers`
  ADD PRIMARY KEY (`code`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `router_types`
--
ALTER TABLE `router_types`
  ADD PRIMARY KEY (`code`),
  ADD KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `routers`
--
ALTER TABLE `routers`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `router_types`
--
ALTER TABLE `router_types`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
