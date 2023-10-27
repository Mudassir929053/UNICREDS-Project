-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 02:25 AM
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
-- Table structure for table `enrolled_course_studuni`
--

CREATE TABLE `enrolled_course_studuni` (
  `ecsu_id` int(11) NOT NULL,
  `ecsu_student_university_id` int(11) NOT NULL,
  `ecsu_course_id` int(11) NOT NULL,
  `ecsu_enrollment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ecsu_certificate_id` int(11) DEFAULT NULL,
  `ecsu_status` enum('Not started','In progress','Completed') NOT NULL,
  `ecsu_status_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_mc_studuni`
--

CREATE TABLE `enrolled_mc_studuni` (
  `emcsu_id` int(11) NOT NULL,
  `emcsu_student_university_id` int(11) NOT NULL,
  `emcsu_mc_id` int(11) NOT NULL,
  `emcsu_enrollment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `emcsu_certificate_id` int(11) DEFAULT NULL,
  `emcsu_status` enum('Not started','In progress','Completed') NOT NULL,
  `emcsu_status_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  ADD PRIMARY KEY (`ecsu_id`),
  ADD KEY `FK_ecsu_student` (`ecsu_student_university_id`),
  ADD KEY `FK_ecsu_course` (`ecsu_course_id`),
  ADD KEY `FK_ecsu_certificate` (`ecsu_certificate_id`);

--
-- Indexes for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  ADD PRIMARY KEY (`emcsu_id`),
  ADD KEY `FK_emcsu_certificate` (`emcsu_certificate_id`),
  ADD KEY `FK_emcsu_mc` (`emcsu_mc_id`),
  ADD KEY `FK_emcsu_studuni` (`emcsu_student_university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  MODIFY `ecsu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  MODIFY `emcsu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  ADD CONSTRAINT `FK_ecsu_certificate` FOREIGN KEY (`ecsu_certificate_id`) REFERENCES `certificate` (`certificate_id`),
  ADD CONSTRAINT `FK_ecsu_course` FOREIGN KEY (`ecsu_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_ecsu_student` FOREIGN KEY (`ecsu_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  ADD CONSTRAINT `FK_emcsu_certificate` FOREIGN KEY (`emcsu_certificate_id`) REFERENCES `certificate` (`certificate_id`),
  ADD CONSTRAINT `FK_emcsu_mc` FOREIGN KEY (`emcsu_mc_id`) REFERENCES `microcredential` (`mc_id`),
  ADD CONSTRAINT `FK_emcsu_studuni` FOREIGN KEY (`emcsu_student_university_id`) REFERENCES `student_university` (`su_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
