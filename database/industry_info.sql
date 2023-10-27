-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2022 at 05:34 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unicreds`
--

-- --------------------------------------------------------

--
-- Table structure for table `industry_information`
--

CREATE TABLE `industry_information` (
  `ii_id` int(11) NOT NULL,
  `ii_industry_id` int(11) NOT NULL,
  `ii_overview` longtext NOT NULL,
  `ii_company_size` varchar(255) NOT NULL,
  `ii_start_operation_date` datetime NOT NULL,
  `ii_benefit` longtext NOT NULL,
  `ii_dress_code` text NOT NULL,
  `ii_spoken_language` text NOT NULL,
  `ii_working_hours` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `industry_information`
--
ALTER TABLE `industry_information`
  ADD PRIMARY KEY (`ii_id`),
  ADD KEY `FK_ii_industry` (`ii_industry_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `industry_information`
--
ALTER TABLE `industry_information`
  MODIFY `ii_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `industry_information`
--
ALTER TABLE `industry_information`
  ADD CONSTRAINT `FK_ii_industry` FOREIGN KEY (`ii_industry_id`) REFERENCES `industry` (`industry_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
