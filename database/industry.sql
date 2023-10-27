-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2022 at 07:44 AM
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
-- Table structure for table `industry`
--

CREATE TABLE `industry` (
  `industry_id` int(11) NOT NULL,
  `industry_user_id` int(11) NOT NULL,
  `industry_role_id` int(11) NOT NULL,
  `industry_name` text NOT NULL,
  `industry_email` varchar(255) NOT NULL,
  `industry_website` varchar(100) NOT NULL,
  `industry_contact_no` varchar(100) NOT NULL,
  `industry_address1` text DEFAULT NULL,
  `industry_address2` text DEFAULT NULL,
  `industry_city_id` varchar(255) DEFAULT NULL,
  `industry_state_id` int(11) DEFAULT NULL,
  `industry_country_id` varchar(255) DEFAULT NULL,
  `industry_ssm` varchar(255) DEFAULT NULL,
  `industry_industry_field_id` int(11) NOT NULL,
  `industry_created_by` int(11) DEFAULT NULL,
  `industry_created_date` datetime DEFAULT NULL,
  `industry_updated_date` datetime DEFAULT NULL,
  `industry_deleted_date` datetime DEFAULT NULL,
  `industry_status` enum('Active','Inactive') NOT NULL,
  `industry_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`industry_id`),
  ADD KEY `FK_industry_user` (`industry_user_id`),
  ADD KEY `FK_industry_field` (`industry_industry_field_id`),
  ADD KEY `FK_industry_admin` (`industry_created_by`),
  ADD KEY `FK_industry_state` (`industry_state_id`),
  ADD KEY `FK_industry_role` (`industry_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `industry`
--
ALTER TABLE `industry`
  ADD CONSTRAINT `FK_industry_admin` FOREIGN KEY (`industry_created_by`) REFERENCES `admin_management` (`am_id`),
  ADD CONSTRAINT `FK_industry_field` FOREIGN KEY (`industry_industry_field_id`) REFERENCES `industry_field` (`industry_field_id`),
  ADD CONSTRAINT `FK_industry_role` FOREIGN KEY (`industry_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_industry_state` FOREIGN KEY (`industry_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_industry_user` FOREIGN KEY (`industry_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
