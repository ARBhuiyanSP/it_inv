-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2022 at 07:46 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saif_rlp`
--

-- --------------------------------------------------------

--
-- Table structure for table `recruite_requests`
--

CREATE TABLE `recruite_requests` (
  `id` int(11) NOT NULL,
  `rrr_date` datetime NOT NULL,
  `rrr_no` varchar(30) NOT NULL,
  `req_by` varchar(30) NOT NULL,
  `req_by_division` varchar(30) NOT NULL,
  `req_by_department` varchar(30) NOT NULL,
  `req_by_designation` varchar(30) NOT NULL,
  `req_for` varchar(30) NOT NULL,
  `emp_type` varchar(30) NOT NULL,
  `urgency` varchar(30) NOT NULL,
  `justification_for_rec` longtext NOT NULL,
  `rem_spe_rec` longtext NOT NULL,
  `req_division` varchar(30) NOT NULL,
  `req_department` varchar(30) NOT NULL,
  `req_designation` varchar(30) NOT NULL,
  `req_number` varchar(30) NOT NULL,
  `req_location_project` varchar(30) NOT NULL,
  `req_reporting_man` varchar(30) NOT NULL,
  `req_salary` varchar(30) NOT NULL,
  `req_responsibilities` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(30) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recruite_requests`
--
ALTER TABLE `recruite_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recruite_requests`
--
ALTER TABLE `recruite_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
