-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 02:48 AM
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
-- Table structure for table `student_university_experience_details`
--

CREATE TABLE `student_university_experience_details` (
  `sued_id` int(11) NOT NULL,
  `sued_student_university_id` int(11) NOT NULL,
  `sued_job_location_city_id` int(11) NOT NULL,
  `sued_job_location_state_id` int(11) NOT NULL,
  `sued_job_location_country_id` int(11) NOT NULL,
  `sued_job_title` text NOT NULL,
  `sued_description` varchar(255) NOT NULL,
  `sued_company_name` text NOT NULL,
  `sued_start_date` date NOT NULL,
  `sued_end_date` date NOT NULL,
  `sued_job_status` enum('Current','Past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_university_experience_details`
--
ALTER TABLE `student_university_experience_details`
  ADD PRIMARY KEY (`sued_id`),
  ADD UNIQUE KEY `FK_sued_student_university_id` (`sued_student_university_id`),
  ADD KEY `FK_sued_job_state` (`sued_job_location_state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_university_experience_details`
--
ALTER TABLE `student_university_experience_details`
  MODIFY `sued_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_university_experience_details`
--
ALTER TABLE `student_university_experience_details`
  ADD CONSTRAINT `FK_sued_job_state` FOREIGN KEY (`sued_job_location_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_sued_student_university` FOREIGN KEY (`sued_student_university_id`) REFERENCES `student_university` (`su_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
