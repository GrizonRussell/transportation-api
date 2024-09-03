-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 12:50 PM
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
-- Database: `sacay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldestination`
--

CREATE TABLE `tbldestination` (
  `dest_id` int(11) NOT NULL,
  `dest_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldestination`
--

INSERT INTO `tbldestination` (`dest_id`, `dest_name`) VALUES
(1, 'MANOLO FORTICH'),
(2, 'DAMILAG'),
(3, 'SUMILAO'),
(4, 'IMPASUG-ONG'),
(5, 'MALAYBALAY'),
(6, 'VALENCIA');

-- --------------------------------------------------------

--
-- Table structure for table `tblgender`
--

CREATE TABLE `tblgender` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgender`
--

INSERT INTO `tblgender` (`gender_id`, `gender_name`) VALUES
(1, 'MALE'),
(2, 'FEMALE'),
(3, 'LGBTQI++'),
(4, 'UNKNOWN');

-- --------------------------------------------------------

--
-- Table structure for table `tblpassengers`
--

CREATE TABLE `tblpassengers` (
  `pas_id` int(11) NOT NULL,
  `pas_name` varchar(100) NOT NULL,
  `pas_destinationId` int(11) NOT NULL,
  `pas_genderId` int(11) NOT NULL,
  `pas_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpassengers`
--

INSERT INTO `tblpassengers` (`pas_id`, `pas_name`, `pas_destinationId`, `pas_genderId`, `pas_price`) VALUES
(2, 'Kitty Ignalig', 6, 3, 300),
(3, 'Dabid Josh', 3, 2, 250);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldestination`
--
ALTER TABLE `tbldestination`
  ADD PRIMARY KEY (`dest_id`);

--
-- Indexes for table `tblgender`
--
ALTER TABLE `tblgender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `tblpassengers`
--
ALTER TABLE `tblpassengers`
  ADD PRIMARY KEY (`pas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldestination`
--
ALTER TABLE `tbldestination`
  MODIFY `dest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblgender`
--
ALTER TABLE `tblgender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpassengers`
--
ALTER TABLE `tblpassengers`
  MODIFY `pas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
