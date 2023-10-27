-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2022 at 02:24 AM
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
-- Table structure for table `academic_programme`
--

CREATE TABLE `academic_programme` (
  `ap_id` int(11) NOT NULL,
  `ap_field_id` int(11) NOT NULL,
  `ap_name` text NOT NULL,
  `ap_description` longtext NOT NULL,
  `ap_type` enum('diploma','degree','master','phd') NOT NULL,
  `ap_duration` varchar(100) NOT NULL,
  `ap_fee` varchar(100) NOT NULL,
  `ap_total_credit` int(11) NOT NULL,
  `ap_certificate` varchar(255) DEFAULT NULL,
  `ap_created_by` int(11) DEFAULT NULL,
  `ap_created_date` datetime DEFAULT NULL,
  `ap_updated_date` datetime DEFAULT NULL,
  `ap_deleted_date` datetime DEFAULT NULL,
  `ap_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_programme`
--

INSERT INTO `academic_programme` (`ap_id`, `ap_field_id`, `ap_name`, `ap_description`, `ap_type`, `ap_duration`, `ap_fee`, `ap_total_credit`, `ap_certificate`, `ap_created_by`, `ap_created_date`, `ap_updated_date`, `ap_deleted_date`, `ap_image`) VALUES
(1, 1, 'test', 'TEST1112', 'diploma', '3 years', 'rm 1000', 60, NULL, NULL, '2021-08-19 09:57:06', NULL, NULL, NULL),
(2, 85, 'diploma computer science', 'computer science ', 'degree', '4 years', 'rm 21000', 60, NULL, NULL, '2021-08-19 10:06:38', NULL, NULL, NULL),
(12, 1, 'test 123', 'test 1234', 'diploma', '3 years', 'rm 1234', 60, NULL, NULL, '2021-08-22 11:47:52', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `academic_programme_session`
--

CREATE TABLE `academic_programme_session` (
  `aps_id` int(11) NOT NULL,
  `aps_academic_programme_id` int(11) NOT NULL,
  `aps_start_date` datetime NOT NULL,
  `aps_end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `academic_programme_student_uni_application`
--

CREATE TABLE `academic_programme_student_uni_application` (
  `apsua_id` int(11) NOT NULL,
  `apsua_academic_programme_id` int(11) NOT NULL,
  `apsua_request_student_university_id` int(11) NOT NULL,
  `apsua_status` enum('Accept','Reject') DEFAULT NULL,
  `apsua_accepted_by` int(11) DEFAULT NULL,
  `apsua_accepted_date` datetime DEFAULT NULL,
  `apsua_rejected_by` int(11) DEFAULT NULL,
  `apsua_rejected_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_role_id` int(11) NOT NULL,
  `admin_created_date` datetime DEFAULT NULL,
  `admin_updated_date` datetime DEFAULT NULL,
  `admin_deleted_date` datetime DEFAULT NULL,
  `admin_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user_id`, `admin_name`, `admin_email`, `admin_role_id`, `admin_created_date`, `admin_updated_date`, `admin_deleted_date`, `admin_logo`) VALUES
(1, 1, 'Thaqif Rajab', 'thaqif1@gmail.com', 1, '2021-08-22 10:22:29', '2021-08-22 14:47:16', NULL, NULL),
(2, 4, 'aliff faiz', 'aliff@gmail.com', 4, '2021-08-22 14:30:04', '2021-08-22 16:40:42', NULL, NULL),
(3, 5, 'hakim halim', 'hakim@yahoo.com', 2, '2021-08-22 14:30:29', NULL, NULL, NULL),
(4, 6, 'farhan ', 'farhan@gmail.com', 3, '2021-08-22 14:30:41', NULL, NULL, NULL),
(5, 29, 'Admin', 'admin@gmail.com', 1, '2021-10-06 02:59:20', '2021-10-06 02:59:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_management`
--

CREATE TABLE `admin_management` (
  `am_id` int(11) NOT NULL,
  `am_admin_id` int(11) NOT NULL,
  `am_department` text NOT NULL,
  `am_created_date` datetime DEFAULT NULL,
  `am_updated_date` datetime DEFAULT NULL,
  `am_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `badge_id` int(11) NOT NULL,
  `badge_type_id` int(11) NOT NULL,
  `badge_university_id` int(11) NOT NULL,
  `badge_title` varchar(255) NOT NULL,
  `badge_description` varchar(255) NOT NULL,
  `badge_created_by` int(11) NOT NULL,
  `badge_created_date` datetime NOT NULL,
  `badge_updated_date` datetime NOT NULL,
  `badge_deleted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `badge_type`
--

CREATE TABLE `badge_type` (
  `bt_id` int(11) NOT NULL,
  `bt_type` int(1) NOT NULL,
  `bt_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `sessionId` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `itemDiscount` int(11) NOT NULL DEFAULT 0,
  `tax` int(11) NOT NULL DEFAULT 0,
  `subTotal` float NOT NULL DEFAULT 0,
  `grandTotal` float NOT NULL DEFAULT 0,
  `paid` tinyint(4) NOT NULL DEFAULT 0,
  `type` enum('c','mc','cr') NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userId`, `userType`, `paymentMethod`, `sessionId`, `token`, `itemDiscount`, `tax`, `subTotal`, `grandTotal`, `paid`, `type`, `createdAt`, `updateAt`) VALUES
(4, 15, '', NULL, NULL, NULL, 0, 0, 0, 0, 1, 'c', '2021-12-28 11:18:22', '2021-12-28 11:18:22'),
(5, 15, '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 'mc', '2021-12-28 11:18:28', '2021-12-28 11:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `cart_course`
--

CREATE TABLE `cart_course` (
  `cart_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cart_course`
--

INSERT INTO `cart_course` (`cart_id`, `course_id`, `cost`, `discount`, `createdAt`, `updatedAt`) VALUES
(4, 1, NULL, NULL, '2021-12-28 11:18:22', '2021-12-28 11:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `cart_mc`
--

CREATE TABLE `cart_mc` (
  `cart_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_mc`
--

INSERT INTO `cart_mc` (`cart_id`, `sub_id`, `cost`, `discount`, `createdAt`, `updatedAt`) VALUES
(5, 1, NULL, NULL, '2021-12-28 13:06:27', '2021-12-28 13:06:27'),
(5, 3, NULL, NULL, '2021-12-28 13:06:31', '2021-12-28 13:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `cart_order`
--

CREATE TABLE `cart_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `reference_id` varchar(50) DEFAULT NULL,
  `payment_method` enum('fpx','card') DEFAULT NULL,
  `pan_number` smallint(6) DEFAULT NULL COMMENT 'last 4 digit if applicable',
  `paid_value` int(11) NOT NULL,
  `amount_value` int(11) NOT NULL,
  `discount_value` int(11) DEFAULT NULL,
  `tax_value` int(11) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_type` enum('c','mc','cr') DEFAULT NULL COMMENT 'course, micro-cred, credit'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Receipt for successful payment for record purpose';

-- --------------------------------------------------------

--
-- Table structure for table `cart_order_course`
--

CREATE TABLE `cart_order_course` (
  `order_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `cart_order_mc`
--

CREATE TABLE `cart_order_mc` (
  `order_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `certificate_id` int(11) NOT NULL,
  `certificate_type_id` int(11) NOT NULL,
  `certificate_university_id` int(11) NOT NULL,
  `certificate_title` varchar(255) NOT NULL,
  `certificate_description` varchar(255) NOT NULL,
  `certificate_created_by` int(11) NOT NULL,
  `certificate_created_date` datetime NOT NULL,
  `certificate_updated_date` datetime NOT NULL,
  `certificate_deleted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_type`
--

CREATE TABLE `certificate_type` (
  `ct_id` int(11) NOT NULL,
  `ct_type` int(1) NOT NULL,
  `ct_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_state_id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores city of each states of all countries. ';

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_state_id`, `city_name`) VALUES
(1, 1, 'Nusajaya'),
(2, 1, 'Johor Bahru'),
(3, 1, 'Kulai'),
(4, 1, 'Senai'),
(5, 1, 'Bandar Tenggara'),
(6, 1, 'Gugusan Taib Andak'),
(7, 1, 'Pekan Nenas'),
(8, 1, 'Sungai Mati'),
(9, 1, 'Gelang Patah'),
(10, 1, 'Pengerang'),
(11, 1, 'Pasir Gudang'),
(12, 1, 'Masai'),
(13, 1, 'Ulu Tiram'),
(14, 1, 'Layang-Layang'),
(15, 1, 'Kota Tinggi'),
(16, 1, 'Ayer Tawar 2'),
(17, 1, 'Ayer Tawar 3'),
(18, 1, 'Ayer Tawar 4'),
(19, 1, 'Ayer Tawar 5'),
(20, 1, 'Bandar Penawar'),
(21, 1, 'Pontian'),
(22, 1, 'Ayer Baloi'),
(23, 1, 'Benut'),
(24, 1, 'Kukup'),
(25, 1, 'Batu Pahat'),
(26, 1, 'Rengit'),
(27, 1, 'Senggarang'),
(28, 1, 'Seri Gading'),
(29, 1, 'Sri Gading'),
(30, 1, 'Seri Medan'),
(31, 1, 'Sri Medan'),
(32, 1, 'Parit Sulong'),
(33, 1, 'Semerah'),
(34, 1, 'Yong Peng'),
(35, 1, 'Muar'),
(36, 1, 'Parit Jawa'),
(37, 1, 'Bukit Pasir'),
(38, 1, 'Panchor'),
(39, 1, 'Pagoh'),
(40, 1, 'Gerisek'),
(41, 1, 'Bukit Gambir'),
(42, 1, 'Tangkak'),
(43, 1, 'Segamat'),
(44, 1, 'Batu Anam'),
(45, 1, 'Jementah'),
(46, 1, 'Labis'),
(47, 1, 'Chaah'),
(48, 1, 'Kluang'),
(49, 1, 'Ayer Hitam'),
(50, 1, 'Simpang Rengam'),
(51, 1, 'Rengam'),
(52, 1, 'Parit Raja'),
(53, 1, 'Bekok'),
(54, 1, 'Paloh'),
(55, 1, 'Kahang'),
(56, 1, 'Mersing'),
(57, 1, 'Endau'),
(58, 2, 'Alor Setar'),
(59, 2, 'Jitra'),
(60, 2, 'Changloon'),
(61, 2, 'Universiti Utara Malaysia'),
(62, 2, 'Bukit Kayu Hitam'),
(63, 2, 'Kodiang'),
(64, 2, 'Ayer Hitam'),
(65, 2, 'Kepala Batas'),
(66, 2, 'Kuala Nerang'),
(67, 2, 'Pokok Sena'),
(68, 2, 'Pendang'),
(69, 2, 'Langgar'),
(70, 2, 'Kuala Kedah'),
(71, 2, 'Simpang Empat'),
(72, 2, 'Kota Sarang Semut'),
(73, 2, 'Yan'),
(74, 2, 'Langkawi'),
(75, 2, 'Sungai Petani'),
(76, 2, 'Bedong'),
(77, 2, 'Sik'),
(78, 2, 'Gurun'),
(79, 2, 'Jeniang'),
(80, 2, 'Merbok'),
(81, 2, 'Kota Kuala Muda'),
(82, 2, 'Kulim'),
(83, 2, 'Baling'),
(84, 2, 'Kuala Pegang'),
(85, 2, 'Kupang'),
(86, 2, 'Kuala Ketil'),
(87, 2, 'Padang Serai'),
(88, 2, 'Lunas'),
(89, 2, 'Lunas '),
(90, 2, 'Karangan'),
(91, 2, 'Serdang');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `cm_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL COMMENT 'rate (as per payment) for instituition',
  `receivable_amount` mediumint(9) DEFAULT NULL COMMENT 'total payment received after PG fee',
  `payable_amount` mediumint(9) DEFAULT NULL COMMENT 'amount to be paid to instituition',
  `profitable_amount` mediumint(9) DEFAULT NULL COMMENT 'amount owned by unicreds',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_course`
--

CREATE TABLE `commission_course` (
  `cm_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_mc`
--

CREATE TABLE `commission_mc` (
  `cm_id` int(11) DEFAULT NULL,
  `mc_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `commission_rate`
--

CREATE TABLE `commission_rate` (
  `institution_id` int(11) NOT NULL,
  `rate` tinyint(4) DEFAULT NULL COMMENT 'rate boleh berubah',
  `sales_id` int(11) DEFAULT NULL COMMENT 'PIC for the rate',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `committee_id` int(11) NOT NULL,
  `committee_user_id` int(11) NOT NULL,
  `committee_role_id` int(11) NOT NULL,
  `committee_name` text NOT NULL,
  `committee_email` varchar(255) NOT NULL,
  `committee_contact_no` varchar(100) NOT NULL,
  `committee_address` varchar(255) NOT NULL,
  `committee_institution_id` int(11) NOT NULL,
  `committee_created_by` int(11) DEFAULT NULL,
  `committee_created_date` datetime DEFAULT NULL,
  `committee_updated_date` datetime DEFAULT NULL,
  `committee_deleted_date` datetime DEFAULT NULL,
  `committee_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores a list of all countries around the world. ';

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_code`, `country_name`) VALUES
(1, 'MY', 'Malaysia'),
(2, 'ID', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_title` text NOT NULL,
  `course_code` varchar(100) DEFAULT NULL,
  `course_description` longtext NOT NULL,
  `course_category` tinytext DEFAULT NULL,
  `course_level` varchar(255) DEFAULT NULL,
  `course_duration` varchar(100) NOT NULL,
  `course_fee` varchar(100) NOT NULL,
  `course_credit` varchar(10) NOT NULL,
  `course_total_enrolled` int(11) NOT NULL,
  `course_created_by` int(11) NOT NULL,
  `course_owner` int(11) NOT NULL,
  `course_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `course_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `course_deleted_date` datetime DEFAULT NULL,
  `course_image` text DEFAULT NULL,
  `course_status` varchar(100) NOT NULL,
  `course_enrollment_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_assignment`
--

CREATE TABLE `course_assignment` (
  `ca_id` int(11) NOT NULL,
  `ca_course_id` int(11) NOT NULL,
  `ca_title` text NOT NULL,
  `ca_description` longtext NOT NULL,
  `ca_attachment` varchar(255) NOT NULL,
  `ca_total_no_of_assignment` int(100) NOT NULL,
  `ca_created_date` datetime DEFAULT current_timestamp(),
  `ca_created_by` int(11) NOT NULL,
  `ca_updated_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ca_deleted_date` datetime DEFAULT NULL,
  `ca_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_assignment_duedate`
--

CREATE TABLE `course_assignment_duedate` (
  `cad_id` int(11) NOT NULL,
  `cad_course_assignment_id` int(11) NOT NULL,
  `cad_duedate_date` date NOT NULL,
  `cad_duedate_time` time NOT NULL,
  `cad_duedate_gmt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolment_session`
--

CREATE TABLE `course_enrolment_session` (
  `ces_id` int(11) NOT NULL,
  `ces_course_id` int(11) NOT NULL,
  `ces_start_date` date NOT NULL,
  `ces_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_instructor`
--

CREATE TABLE `course_instructor` (
  `ci_id` int(11) NOT NULL,
  `ci_course_id` int(11) NOT NULL,
  `ci_user_id` int(11) NOT NULL,
  `ci_type` enum('Lecturer','Expert') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_learning_details`
--

CREATE TABLE `course_learning_details` (
  `cld_id` int(11) NOT NULL,
  `cld_course_id` int(11) NOT NULL,
  `cld_learning_outcome` text NOT NULL,
  `cld_intended_learners` tinytext NOT NULL,
  `cld_prerequisites` tinytext NOT NULL,
  `cld_skills` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_notes`
--

CREATE TABLE `course_notes` (
  `cn_id` int(11) NOT NULL,
  `cn_course_id` int(11) NOT NULL,
  `cn_title` text NOT NULL,
  `cn_description` longtext NOT NULL,
  `cn_attachment` varchar(255) NOT NULL,
  `cn_total_no_of_notes` int(100) NOT NULL,
  `cn_created_date` datetime DEFAULT current_timestamp(),
  `cn_created_by` int(11) NOT NULL,
  `cn_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `cn_deleted_date` datetime DEFAULT NULL,
  `cn_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_project`
--

CREATE TABLE `course_project` (
  `cp_id` int(11) NOT NULL,
  `cp_course_id` int(11) NOT NULL,
  `cp_title` text NOT NULL,
  `cp_description` longtext NOT NULL,
  `cp_attachment` varchar(255) NOT NULL,
  `cp_total_no_of_project` int(100) NOT NULL,
  `cp_created_date` datetime DEFAULT current_timestamp(),
  `cp_created_by` int(11) NOT NULL,
  `cp_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `cp_deleted_date` datetime DEFAULT NULL,
  `cp_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_project_duedate`
--

CREATE TABLE `course_project_duedate` (
  `cpd_id` int(11) NOT NULL,
  `cpd_course_project_id` int(11) NOT NULL,
  `cpd_duedate_date` date NOT NULL,
  `cpd_duedate_time` time NOT NULL,
  `cpd_duedate_gmt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz`
--

CREATE TABLE `course_quiz` (
  `cq_id` int(11) NOT NULL,
  `cq_course_id` int(11) NOT NULL,
  `cq_title` text NOT NULL,
  `cq_instruction` longtext NOT NULL,
  `cq_duration` int(11) NOT NULL,
  `cq_score` float NOT NULL,
  `cq_created_date` datetime DEFAULT current_timestamp(),
  `cq_created_by` int(11) DEFAULT NULL,
  `cq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `cq_deleted_date` datetime DEFAULT NULL,
  `cq_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz_answer`
--

CREATE TABLE `course_quiz_answer` (
  `cqa_id` int(11) NOT NULL,
  `cqa_course_quiz_question_id` int(11) NOT NULL,
  `cqa_answer1` text NOT NULL,
  `cqa_answer2` text NOT NULL,
  `cqa_answer3` text NOT NULL,
  `cqa_answer4` text NOT NULL,
  `cqa_right_answer` text NOT NULL,
  `cqa_right_answerword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz_question`
--

CREATE TABLE `course_quiz_question` (
  `cqq_id` int(11) NOT NULL,
  `cqq_course_quiz_id` int(11) NOT NULL,
  `cqq_type` varchar(255) NOT NULL,
  `cqq_question` text NOT NULL,
  `cqq_score` float NOT NULL,
  `cqq_created_date` datetime DEFAULT current_timestamp(),
  `cqq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `cqq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_slide`
--

CREATE TABLE `course_slide` (
  `cs_id` int(11) NOT NULL,
  `cs_course_id` int(11) DEFAULT NULL,
  `cs_title` text NOT NULL,
  `cs_description` longtext NOT NULL,
  `cs_attachment` varchar(255) DEFAULT NULL,
  `cs_total_no_of_slide` int(100) DEFAULT NULL,
  `cs_created_date` datetime DEFAULT current_timestamp(),
  `cs_created_by` int(11) DEFAULT NULL,
  `cs_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `cs_deleted_date` datetime DEFAULT NULL,
  `cs_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_test`
--

CREATE TABLE `course_test` (
  `ct_id` int(11) NOT NULL,
  `ct_course_id` int(11) NOT NULL,
  `ct_title` text NOT NULL,
  `ct_instruction` longtext NOT NULL,
  `ct_duration` int(11) NOT NULL,
  `ct_score` float NOT NULL,
  `ct_created_date` datetime DEFAULT current_timestamp(),
  `ct_created_by` int(11) NOT NULL,
  `ct_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ct_deleted_date` datetime DEFAULT NULL,
  `ct_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_test_answer`
--

CREATE TABLE `course_test_answer` (
  `cta_id` int(11) NOT NULL,
  `cta_course_test_question_id` int(11) NOT NULL,
  `cta_answer1` text NOT NULL,
  `cta_answer2` text NOT NULL,
  `cta_answer3` text NOT NULL,
  `cta_answer4` text NOT NULL,
  `cta_right_answer` text NOT NULL,
  `cta_right_answerword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_test_question`
--

CREATE TABLE `course_test_question` (
  `ctq_id` int(11) NOT NULL,
  `ctq_course_test_id` int(11) NOT NULL,
  `ctq_type` varchar(255) NOT NULL,
  `ctq_question` text NOT NULL,
  `ctq_score` float NOT NULL,
  `ctq_created_date` datetime DEFAULT current_timestamp(),
  `ctq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ctq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_tutorial`
--

CREATE TABLE `course_tutorial` (
  `ctu_id` int(11) NOT NULL,
  `ctu_course_id` int(11) NOT NULL,
  `ctu_title` text NOT NULL,
  `ctu_description` longtext NOT NULL,
  `ctu_attachment` varchar(255) NOT NULL,
  `ctu_total_no_of_tutorial` int(100) NOT NULL,
  `ctu_created_date` datetime DEFAULT NULL,
  `ctu_created_by` int(11) NOT NULL,
  `ctu_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ctu_deleted_date` datetime DEFAULT NULL,
  `ctu_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_tutorial_duedate`
--

CREATE TABLE `course_tutorial_duedate` (
  `ctud_id` int(11) NOT NULL,
  `ctud_course_tutorial_id` int(11) NOT NULL,
  `ctud_duedate_date` date NOT NULL,
  `ctud_duedate_time` time NOT NULL,
  `ctud_duedate_gmt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_video`
--

CREATE TABLE `course_video` (
  `cv_id` int(11) NOT NULL,
  `cv_course_id` int(11) NOT NULL,
  `cv_title` text NOT NULL,
  `cv_description` longtext NOT NULL,
  `cv_attachment` varchar(255) DEFAULT NULL,
  `cv_duration` time DEFAULT NULL,
  `cv_created_date` datetime DEFAULT NULL,
  `cv_created_by` int(11) DEFAULT NULL,
  `cv_updated_date` datetime DEFAULT NULL,
  `cv_deleted_date` datetime DEFAULT NULL,
  `cv_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `degree_id` int(11) NOT NULL,
  `degree_name` text NOT NULL,
  `degree_major` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diploma`
--

CREATE TABLE `diploma` (
  `diploma_id` int(11) NOT NULL,
  `diploma_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ecsu_status` enum('In progress','Completed') NOT NULL,
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
  `emcsu_status` enum('In progress','Completed') NOT NULL,
  `emcsu_status_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolled_mc_studuni`
--

INSERT INTO `enrolled_mc_studuni` (`emcsu_id`, `emcsu_student_university_id`, `emcsu_mc_id`, `emcsu_enrollment_date`, `emcsu_certificate_id`, `emcsu_status`, `emcsu_status_date`) VALUES
(5, 1, 5, '2021-10-21 00:00:00', NULL, 'In progress', '2021-12-16 11:03:46'),
(6, 1, 6, '2021-10-27 00:00:00', NULL, 'In progress', '2021-12-16 11:03:46'),
(7, 9, 5, '2021-11-02 16:16:31', NULL, 'In progress', '2021-12-16 11:03:46'),
(8, 11, 5, '2021-12-01 08:06:20', NULL, 'In progress', '2021-12-16 11:03:46'),
(9, 11, 6, '2021-12-01 09:07:16', NULL, 'In progress', '2021-12-16 11:03:46'),
(10, 9, 3, '2021-12-08 11:43:47', NULL, 'In progress', '2021-12-16 11:03:46'),
(11, 1, 2, '2021-12-16 11:39:42', NULL, 'In progress', '2021-12-16 11:39:42'),
(12, 1, 4, '2021-12-20 10:59:36', NULL, 'In progress', '2021-12-20 10:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `expert_id` int(11) NOT NULL,
  `expert_user_id` int(11) NOT NULL,
  `expert_fname` text NOT NULL,
  `expert_lname` text NOT NULL,
  `expert_nationality` varchar(100) NOT NULL,
  `expert_no_ic` varchar(100) NOT NULL,
  `expert_passport_no` varchar(100) NOT NULL,
  `expert_email` varchar(255) NOT NULL,
  `expert_gender` int(1) NOT NULL,
  `expert_contact_no` varchar(50) NOT NULL,
  `expert_dob` date NOT NULL,
  `expert_address` varchar(255) NOT NULL,
  `expert_city_id` int(11) NOT NULL,
  `expert_state_id` int(11) NOT NULL,
  `expert_country_id` int(11) NOT NULL,
  `expert_status` enum('Active','Inactive') NOT NULL,
  `expert_created_by` int(11) NOT NULL,
  `expert_created_date` datetime DEFAULT NULL,
  `expert_updated_date` datetime DEFAULT NULL,
  `expert_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`expert_id`, `expert_user_id`, `expert_fname`, `expert_lname`, `expert_nationality`, `expert_no_ic`, `expert_passport_no`, `expert_email`, `expert_gender`, `expert_contact_no`, `expert_dob`, `expert_address`, `expert_city_id`, `expert_state_id`, `expert_country_id`, `expert_status`, `expert_created_by`, `expert_created_date`, `expert_updated_date`, `expert_deleted_date`) VALUES
(1, 19, 'Wan', 'Warren', 'Mat Salleh', '890112113477', '8901121234', 'wanwarren@gmail.com', 1, '0142349876', '1989-01-12', 'No 1, Lrg Satu, Taman Satu,', 11, 1, 1, 'Active', 0, '2021-09-08 08:34:35', '2021-09-08 08:34:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expert_education_degree`
--

CREATE TABLE `expert_education_degree` (
  `exedeg_id` int(11) NOT NULL,
  `exedeg_expert_id` int(11) NOT NULL,
  `exedeg_university_id` int(11) NOT NULL,
  `exedeg_degree_id` int(11) NOT NULL,
  `exedeg_field_id` int(11) NOT NULL,
  `exedeg_name` text NOT NULL,
  `exedeg_cgpa` varchar(10) NOT NULL,
  `exedeg_start_date` date NOT NULL,
  `exedeg_end_date` date NOT NULL,
  `exedeg_transcript` varchar(255) NOT NULL,
  `exedeg_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expert_education_diploma`
--

CREATE TABLE `expert_education_diploma` (
  `exedip_id` int(11) NOT NULL,
  `exedip_expert_id` int(11) NOT NULL,
  `exedip_university_id` int(11) NOT NULL,
  `exedip_diploma_id` int(11) NOT NULL,
  `exedip_field_id` int(11) NOT NULL,
  `exedip_name` text NOT NULL,
  `exedip_cgpa` varchar(10) NOT NULL,
  `exedip_start_date` date NOT NULL,
  `exedip_end_date` date NOT NULL,
  `exedip_transcript` varchar(255) NOT NULL,
  `exedip_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expert_education_master`
--

CREATE TABLE `expert_education_master` (
  `exem_id` int(11) NOT NULL,
  `exem_expert_id` int(11) NOT NULL,
  `exem_university_id` int(11) NOT NULL,
  `exem_master_id` int(11) NOT NULL,
  `exem_field_id` int(11) NOT NULL,
  `exem_name` text NOT NULL,
  `exem_cgpa` varchar(10) NOT NULL,
  `exem_start_date` date NOT NULL,
  `exem_end_date` date NOT NULL,
  `exem_transcript` varchar(255) NOT NULL,
  `exem_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expert_education_phd`
--

CREATE TABLE `expert_education_phd` (
  `exep_id` int(11) NOT NULL,
  `exep_expert_id` int(11) NOT NULL,
  `exep_university_id` int(11) NOT NULL,
  `exep_phd_id` int(11) NOT NULL,
  `exep_field_id` int(11) NOT NULL,
  `exep_name` text NOT NULL,
  `exep_start_date` date NOT NULL,
  `exep_end_date` date NOT NULL,
  `exep_transcript` varchar(255) NOT NULL,
  `exep_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expert_experience_details`
--

CREATE TABLE `expert_experience_details` (
  `exed_id` int(11) NOT NULL,
  `exed_expert_id` int(11) NOT NULL,
  `exed_job_location_city_id` int(11) NOT NULL,
  `exed_job_location_state_id` int(11) NOT NULL,
  `exed_job_location_country_id` int(11) NOT NULL,
  `exed_job_title` text NOT NULL,
  `exed_description` varchar(255) NOT NULL,
  `exed_company_name` text NOT NULL,
  `exed_start_date` date NOT NULL,
  `exed_end_date` date NOT NULL,
  `exed_job_status` enum('Current','Past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expert_skill_set`
--

CREATE TABLE `expert_skill_set` (
  `exss_id` int(11) NOT NULL,
  `exss_expert_id` int(11) NOT NULL,
  `exss_skill_type_id` int(11) NOT NULL,
  `exss_skill_level` enum('Beginner','Intermediate','Advance') NOT NULL,
  `exss_skill_certificate` varchar(255) NOT NULL,
  `exss_certificate_provider` text DEFAULT NULL,
  `exss_certificate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_user_id` int(11) NOT NULL,
  `faculty_name` text NOT NULL,
  `faculty_email` varchar(255) NOT NULL,
  `faculty_contact_no` varchar(100) NOT NULL,
  `faculty_address` varchar(255) NOT NULL,
  `faculty_institution_id` int(11) NOT NULL,
  `faculty_created_by` int(11) DEFAULT NULL,
  `faculty_created_date` datetime DEFAULT NULL,
  `faculty_updated_date` datetime DEFAULT NULL,
  `faculty_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores major field in study. ';

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`field_id`, `field_name`) VALUES
(1, 'GENERAL AGRICULTURE'),
(2, 'AGRICULTURE PRODUCTION AND MANAGEMENT'),
(3, 'AGRICULTURAL ECONOMICS'),
(4, 'ANIMAL SCIENCES'),
(5, 'FOOD SCIENCE'),
(6, 'PLANT SCIENCE AND AGRONOMY'),
(7, 'SOIL SCIENCE'),
(8, 'MISCELLANEOUS AGRICULTURE'),
(9, 'FORESTRY'),
(10, 'NATURAL RESOURCES MANAGEMENT'),
(11, 'FINE ARTS'),
(12, 'DRAMA AND THEATER ARTS'),
(13, 'MUSIC'),
(14, 'VISUAL AND PERFORMING ARTS'),
(15, 'COMMERCIAL ART AND GRAPHIC DESIGN'),
(16, 'FILM VIDEO AND PHOTOGRAPHIC ARTS'),
(17, 'STUDIO ARTS'),
(18, 'MISCELLANEOUS FINE ARTS'),
(19, 'ENVIRONMENTAL SCIENCE'),
(20, 'BIOLOGY'),
(21, 'BIOCHEMICAL SCIENCES'),
(22, 'BOTANY'),
(23, 'MOLECULAR BIOLOGY'),
(24, 'ECOLOGY'),
(25, 'GENETICS'),
(26, 'MICROBIOLOGY'),
(27, 'PHARMACOLOGY'),
(28, 'PHYSIOLOGY'),
(29, 'ZOOLOGY'),
(30, 'NEUROSCIENCE'),
(31, 'MISCELLANEOUS BIOLOGY'),
(32, 'COGNITIVE SCIENCE AND BIOPSYCHOLOGY'),
(33, 'GENERAL BUSINESS'),
(34, 'ACCOUNTING'),
(35, 'ACTUARIAL SCIENCE'),
(36, 'BUSINESS MANAGEMENT AND ADMINISTRATION'),
(37, 'OPERATIONS LOGISTICS AND E-COMMERCE'),
(38, 'BUSINESS ECONOMICS'),
(39, 'MARKETING AND MARKETING RESEARCH'),
(40, 'FINANCE'),
(41, 'HUMAN RESOURCES AND PERSONNEL MANAGEMENT'),
(42, 'INTERNATIONAL BUSINESS'),
(43, 'HOSPITALITY MANAGEMENT'),
(44, 'MANAGEMENT INFORMATION SYSTEMS AND STATISTICS'),
(45, 'MISCELLANEOUS BUSINESS & MEDICAL ADMINISTRATION'),
(46, 'COMMUNICATIONS'),
(47, 'JOURNALISM'),
(48, 'MASS MEDIA'),
(49, 'ADVERTISING AND PUBLIC RELATIONS'),
(50, 'COMMUNICATION TECHNOLOGIES'),
(51, 'COMPUTER AND INFORMATION SYSTEMS'),
(52, 'COMPUTER PROGRAMMING AND DATA PROCESSING'),
(53, 'COMPUTER SCIENCE'),
(54, 'INFORMATION SCIENCES'),
(55, 'COMPUTER ADMINISTRATION MANAGEMENT AND SECURITY'),
(56, 'COMPUTER NETWORKING AND TELECOMMUNICATIONS'),
(57, 'MATHEMATICS'),
(58, 'APPLIED MATHEMATICS'),
(59, 'STATISTICS AND DECISION SCIENCE'),
(60, 'MATHEMATICS AND COMPUTER SCIENCE'),
(61, 'GENERAL EDUCATION'),
(62, 'EDUCATIONAL ADMINISTRATION AND SUPERVISION'),
(63, 'SCHOOL STUDENT COUNSELING'),
(64, 'ELEMENTARY EDUCATION'),
(65, 'MATHEMATICS TEACHER EDUCATION'),
(66, 'PHYSICAL AND HEALTH EDUCATION TEACHING'),
(67, 'EARLY CHILDHOOD EDUCATION'),
(68, 'SCIENCE AND COMPUTER TEACHER EDUCATION'),
(69, 'SECONDARY TEACHER EDUCATION'),
(70, 'SPECIAL NEEDS EDUCATION'),
(71, 'SOCIAL SCIENCE OR HISTORY TEACHER EDUCATION'),
(72, 'TEACHER EDUCATION: MULTIPLE LEVELS'),
(73, 'LANGUAGE AND DRAMA EDUCATION'),
(74, 'ART AND MUSIC EDUCATION'),
(75, 'MISCELLANEOUS EDUCATION'),
(76, 'LIBRARY SCIENCE'),
(77, 'ARCHITECTURE'),
(78, 'GENERAL ENGINEERING'),
(79, 'AEROSPACE ENGINEERING'),
(80, 'BIOLOGICAL ENGINEERING'),
(81, 'ARCHITECTURAL ENGINEERING'),
(82, 'BIOMEDICAL ENGINEERING'),
(83, 'CHEMICAL ENGINEERING'),
(84, 'CIVIL ENGINEERING'),
(85, 'COMPUTER ENGINEERING'),
(86, 'ELECTRICAL ENGINEERING'),
(87, 'ENGINEERING MECHANICS PHYSICS AND SCIENCE'),
(88, 'ENVIRONMENTAL ENGINEERING'),
(89, 'GEOLOGICAL AND GEOPHYSICAL ENGINEERING'),
(90, 'INDUSTRIAL AND MANUFACTURING ENGINEERING'),
(91, 'MATERIALS ENGINEERING AND MATERIALS SCIENCE'),
(92, 'MECHANICAL ENGINEERING'),
(93, 'METALLURGICAL ENGINEERING'),
(94, 'MINING AND MINERAL ENGINEERING'),
(95, 'NAVAL ARCHITECTURE AND MARINE ENGINEERING'),
(96, 'NUCLEAR ENGINEERING'),
(97, 'PETROLEUM ENGINEERING'),
(98, 'MISCELLANEOUS ENGINEERING'),
(99, 'ENGINEERING TECHNOLOGIES'),
(100, 'ENGINEERING AND INDUSTRIAL MANAGEMENT'),
(101, 'ELECTRICAL ENGINEERING TECHNOLOGY'),
(102, 'INDUSTRIAL PRODUCTION TECHNOLOGIES'),
(103, 'MECHANICAL ENGINEERING RELATED TECHNOLOGIES'),
(104, 'MISCELLANEOUS ENGINEERING TECHNOLOGIES'),
(105, 'MATERIALS SCIENCE'),
(106, 'NUTRITION SCIENCES'),
(107, 'GENERAL MEDICAL AND HEALTH SERVICES'),
(108, 'COMMUNICATION DISORDERS SCIENCES AND SERVICES'),
(109, 'HEALTH AND MEDICAL ADMINISTRATIVE SERVICES'),
(110, 'MEDICAL ASSISTING SERVICES'),
(111, 'MEDICAL TECHNOLOGIES TECHNICIANS'),
(112, 'HEALTH AND MEDICAL PREPARATORY PROGRAMS'),
(113, 'NURSING'),
(114, 'PHARMACY PHARMACEUTICAL SCIENCES AND ADMINISTRATION'),
(115, 'TREATMENT THERAPY PROFESSIONS'),
(116, 'COMMUNITY AND PUBLIC HEALTH'),
(117, 'MISCELLANEOUS HEALTH MEDICAL PROFESSIONS'),
(118, 'AREA ETHNIC AND CIVILIZATION STUDIES'),
(119, 'LINGUISTICS AND COMPARATIVE LANGUAGE AND LITERATURE'),
(120, 'FRENCH GERMAN LATIN AND OTHER COMMON FOREIGN LANGUAGE STUDIES'),
(121, 'OTHER FOREIGN LANGUAGES'),
(122, 'ENGLISH LANGUAGE AND LITERATURE'),
(123, 'COMPOSITION AND RHETORIC'),
(124, 'LIBERAL ARTS'),
(125, 'HUMANITIES'),
(126, 'INTERCULTURAL AND INTERNATIONAL STUDIES'),
(127, 'PHILOSOPHY AND RELIGIOUS STUDIES'),
(128, 'THEOLOGY AND RELIGIOUS VOCATIONS'),
(129, 'ANTHROPOLOGY AND ARCHEOLOGY'),
(130, 'ART HISTORY AND CRITICISM'),
(131, 'HISTORY'),
(132, 'UNITED STATES HISTORY'),
(133, 'COSMETOLOGY SERVICES AND CULINARY ARTS'),
(134, 'FAMILY AND CONSUMER SCIENCES'),
(135, 'MILITARY TECHNOLOGIES'),
(136, 'PHYSICAL FITNESS PARKS RECREATION AND LEISURE'),
(137, 'CONSTRUCTION SERVICES'),
(138, 'ELECTRICAL, MECHANICAL, AND PRECISION TECHNOLOGIES AND PRODUCTION'),
(139, 'TRANSPORTATION SCIENCES AND TECHNOLOGIES'),
(140, 'MULTI/INTERDISCIPLINARY STUDIES'),
(141, 'COURT REPORTING'),
(142, 'PRE-LAW AND LEGAL STUDIES'),
(143, 'CRIMINAL JUSTICE AND FIRE PROTECTION'),
(144, 'PUBLIC ADMINISTRATION'),
(145, 'PUBLIC POLICY'),
(146, 'N/A (less than bachelor\'s degree)'),
(147, 'PHYSICAL SCIENCES'),
(148, 'ASTRONOMY AND ASTROPHYSICS'),
(149, 'ATMOSPHERIC SCIENCES AND METEOROLOGY'),
(150, 'CHEMISTRY'),
(151, 'GEOLOGY AND EARTH SCIENCE'),
(152, 'GEOSCIENCES'),
(153, 'OCEANOGRAPHY'),
(154, 'PHYSICS'),
(155, 'MULTI-DISCIPLINARY OR GENERAL SCIENCE'),
(156, 'NUCLEAR, INDUSTRIAL RADIOLOGY, AND BIOLOGICAL TECHNOLOGIES'),
(157, 'PSYCHOLOGY'),
(158, 'EDUCATIONAL PSYCHOLOGY'),
(159, 'CLINICAL PSYCHOLOGY'),
(160, 'COUNSELING PSYCHOLOGY'),
(161, 'INDUSTRIAL AND ORGANIZATIONAL PSYCHOLOGY'),
(162, 'SOCIAL PSYCHOLOGY'),
(163, 'MISCELLANEOUS PSYCHOLOGY'),
(164, 'HUMAN SERVICES AND COMMUNITY ORGANIZATION'),
(165, 'SOCIAL WORK'),
(166, 'INTERDISCIPLINARY SOCIAL SCIENCES'),
(167, 'GENERAL SOCIAL SCIENCES'),
(168, 'ECONOMICS'),
(169, 'CRIMINOLOGY'),
(170, 'GEOGRAPHY'),
(171, 'INTERNATIONAL RELATIONS'),
(172, 'POLITICAL SCIENCE AND GOVERNMENT'),
(173, 'SOCIOLOGY'),
(174, 'MISCELLANEOUS SOCIAL SCIENCES');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `fp_id` int(11) NOT NULL,
  `fp_user_id` int(11) NOT NULL,
  `fp_verification_code` varchar(100) NOT NULL,
  `fp_status` int(1) NOT NULL,
  `fp_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `industry_address1` varchar(255) DEFAULT NULL,
  `industry_address2` varchar(255) DEFAULT NULL,
  `industry_city_id` int(11) DEFAULT NULL,
  `industry_state_id` int(11) DEFAULT NULL,
  `industry_country_id` int(11) DEFAULT NULL,
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
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`industry_id`, `industry_user_id`, `industry_role_id`, `industry_name`, `industry_email`, `industry_website`, `industry_contact_no`, `industry_address1`, `industry_address2`, `industry_city_id`, `industry_state_id`, `industry_country_id`, `industry_ssm`, `industry_industry_field_id`, `industry_created_by`, `industry_created_date`, `industry_updated_date`, `industry_deleted_date`, `industry_status`, `industry_logo`) VALUES
(1, 14, 6, 'edess education', 'edess@yahoo.com', '', '012578966', 'level 201, utm technovation park', '', 2, 1, 1, NULL, 34, NULL, '2021-08-25 10:48:50', NULL, NULL, 'Active', NULL),
(2, 32, 6, 'Industry', 'industry@email.com', 'industry.com', '0745678321', NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, '2021-11-09 01:19:40', NULL, NULL, 'Active', NULL),
(3, 34, 6, 'Titan System Integration Sdn Bhd', 'sales@titansi.com.my', 'https://www.titansi.com.my/', '03-7890 2828', 'D-3A-02, Capital 4, Oasis Square', 'No.2, Jalan PJU 1A/7A', 9, 1, 1, NULL, 64, NULL, '2021-12-30 07:57:35', NULL, NULL, 'Active', 'titan.jpg'),
(4, 35, 6, 'Lemon Sky Animation Sdn Bhd', 'inquiries@lemonskystudios.com', 'https://www.lemonskystudios.com/', '03-5032 2899', 'Unit 3-13A-01, Tower 3, UOA Business Park', 'No. 1, Jalan Pengaturcara U1/51A, Seksyen U1', 58, 2, 1, NULL, 21, NULL, '2021-12-30 08:05:03', NULL, NULL, 'Active', 'lemon_sky.jpg'),
(5, 36, 6, 'AEON Credit Service (M) Bhd', 'customer.service@aeoncredit.com.my', 'https://www.aeoncredit.com.my/', '03-2719 9999', 'Lot G43, AEON Big MidValley Megamall', 'AT1 Mid Valley Megamall', 25, 1, 1, NULL, 29, NULL, '2021-12-30 08:09:40', NULL, NULL, 'Active', 'aeon.jpg'),
(6, 37, 6, 'Minds & Berry Sdn Bhd', 'office@mindsberry.com', 'https://mindsberry.wixsite.com/mysite', '03-8051 5557', '2-21, Jalan Puteri 4/6', 'Bandar Puteri', 83, 2, 1, NULL, 33, NULL, '2022-01-02 01:48:06', NULL, NULL, 'Active', 'mind_berry.jpg'),
(7, 38, 6, 'Zinnia Packaging (S) Pte Ltd', 'zinnia@zinnia.com.sg', 'https://zinnia.com.sg/', '+65 6566 1638', 'Block 2021 Bukit Batok Street 23', NULL, 2, 1, 1, NULL, 46, NULL, '2022-01-02 01:57:23', NULL, NULL, 'Active', 'zinnia.png');

-- --------------------------------------------------------

--
-- Table structure for table `industry_field`
--

CREATE TABLE `industry_field` (
  `industry_field_id` int(11) NOT NULL,
  `industry_field_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `industry_field`
--

INSERT INTO `industry_field` (`industry_field_id`, `industry_field_name`) VALUES
(1, 'Accounting '),
(2, 'Airlines/Aviation'),
(3, 'Alternative Dispute Resolution'),
(4, 'Alternative Medicine'),
(5, 'Animation'),
(6, 'Apparel/Fashion'),
(7, 'Architecture/Planning'),
(8, 'Arts/Crafts'),
(9, 'Automotive'),
(10, 'Aviation/Aerospace'),
(11, 'Banking/Mortgage'),
(12, 'Biotechnology/Greentech'),
(13, 'Broadcast Media'),
(14, 'Building Materials'),
(15, 'Business Supplies/Equipment'),
(16, 'Capital Markets/Hedge Fund/Private Equity'),
(17, 'Chemicals'),
(18, 'Civic/Social Organization'),
(19, 'Civil Engineering'),
(20, 'Commercial Real Estate'),
(21, 'Computer Games'),
(22, 'Computer Hardware'),
(23, 'Computer Networking'),
(24, 'Computer Software/Engineering'),
(25, 'Computer/Network Security'),
(26, 'Construction'),
(27, 'Consumer Electronics'),
(28, 'Consumer Goods'),
(29, 'Consumer Services'),
(30, 'Cosmetics'),
(31, 'Dairy'),
(32, 'Defense/Space'),
(33, 'Design'),
(34, 'E-Learning'),
(35, 'Education Management'),
(36, 'Electrical/Electronic Manufacturing'),
(37, 'Entertainment/Movie Production'),
(38, 'Environmental Services'),
(39, 'Events Services'),
(40, 'Executive Office'),
(41, 'Facilities Services'),
(42, 'Farming'),
(43, 'Financial Services'),
(44, 'Fine Art'),
(45, 'Fishery'),
(46, 'Food Production'),
(47, 'Food/Beverages'),
(48, 'Fundraising'),
(49, 'Furniture'),
(50, 'Gambling/Casinos'),
(51, 'Glass/Ceramics/Concrete'),
(52, 'Government Administration'),
(53, 'Government Relations'),
(54, 'Graphic Design/Web Design'),
(55, 'Health/Fitness'),
(56, 'Higher Education/Acadamia'),
(57, 'Hospital/Health Care'),
(58, 'Hospitality'),
(59, 'Human Resources/HR'),
(60, 'Import/Export'),
(61, 'Individual/Family Services'),
(62, 'Industrial Automation'),
(63, 'Information Services'),
(64, 'Information Technology/IT'),
(65, 'Insurance'),
(66, 'International Affairs'),
(67, 'International Trade/Development'),
(68, 'Internet'),
(69, 'Investment Banking/Venture'),
(70, 'Investment Management/Hedge Fund/Private Equity'),
(71, 'Judiciary'),
(72, 'Law Enforcement'),
(73, 'Law Practice/Law Firms'),
(74, 'Legal Services'),
(75, 'Legislative Office'),
(76, 'Leisure/Travel'),
(77, 'Library'),
(78, 'Logistics/Procurement'),
(79, 'Luxury Goods/Jewelry'),
(80, 'Machinery'),
(81, 'Management Consulting'),
(82, 'Maritime'),
(83, 'Market Research'),
(84, 'Marketing/Advertising/Sales'),
(85, 'Mechanical or Industrial Engineering'),
(86, 'Media Production'),
(87, 'Medical Equipment'),
(88, 'Medical Practice'),
(89, 'Mental Health Care'),
(90, 'Military Industry'),
(91, 'Mining/Metals'),
(92, 'Motion Pictures/Film'),
(93, 'Museums/Institutions'),
(94, 'Music'),
(95, 'Nanotechnology'),
(96, 'Newspapers/Journalism'),
(97, 'Non-Profit/Volunteering'),
(98, 'Oil/Energy/Solar/Greentech'),
(99, 'Online Publishing'),
(100, 'Other Industry'),
(101, 'Outsourcing/Offshoring'),
(102, 'Package/Freight Delivery'),
(103, 'Packaging/Containers'),
(104, 'Paper/Forest Products'),
(105, 'Performing Arts'),
(106, 'Pharmaceuticals'),
(107, 'Philanthropy'),
(108, 'Photography'),
(109, 'Plastics'),
(110, 'Political Organization'),
(111, 'Primary/Secondary Education'),
(112, 'Printing'),
(113, 'Professional Training'),
(114, 'Program Development'),
(115, 'Public Relations/PR'),
(116, 'Public Safety'),
(117, 'Publishing Industry'),
(118, 'Railroad Manufacture'),
(119, 'Ranching'),
(120, 'Real Estate/Mortgage'),
(121, 'Recreational Facilities/Services'),
(122, 'Religious Institutions'),
(123, 'Renewables/Environment'),
(124, 'Research Industry'),
(125, 'Restaurants'),
(126, 'Retail Industry'),
(127, 'Security/Investigations'),
(128, 'Semiconductors'),
(129, 'Shipbuilding'),
(130, 'Sporting Goods'),
(131, 'Sports'),
(132, 'Staffing/Recruiting'),
(133, 'Supermarkets'),
(134, 'Telecommunications'),
(135, 'Textiles'),
(136, 'Think Tanks'),
(137, 'Tobacco'),
(138, 'Translation/Localization'),
(139, 'Transportation'),
(140, 'Utilities'),
(141, 'Venture Capital/VC'),
(142, 'Veterinary'),
(143, 'Warehousing'),
(144, 'Wholesale'),
(145, 'Wine/Spirits'),
(146, 'Wireless'),
(147, 'Writing/Editing');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `institution_id` int(11) NOT NULL,
  `institution_user_id` int(11) NOT NULL,
  `institution_university_id` int(11) NOT NULL,
  `institution_role_id` int(11) NOT NULL,
  `institution_email` varchar(255) NOT NULL,
  `institution_contact_no` varchar(50) NOT NULL,
  `institution_address` varchar(255) NOT NULL,
  `institution_status` varchar(10) DEFAULT NULL,
  `institution_created_by` int(11) DEFAULT NULL,
  `institution_created_date` datetime DEFAULT NULL,
  `institution_updated_date` datetime DEFAULT NULL,
  `institution_deleted_date` datetime DEFAULT NULL,
  `institution_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`institution_id`, `institution_user_id`, `institution_university_id`, `institution_role_id`, `institution_email`, `institution_contact_no`, `institution_address`, `institution_status`, `institution_created_by`, `institution_created_date`, `institution_updated_date`, `institution_deleted_date`, `institution_logo`) VALUES
(1, 8, 133, 5, 'corporate@utm.my', '07-553 3333', 'Universiti Teknologi Malaysia,\r\n81310 Johor Bahru,\r\nJohor, Malaysia.', 'Active', NULL, '2021-08-24 14:46:41', '2021-08-24 14:47:07', NULL, 'UTM.png'),
(3, 16, 138, 5, 'pro@uthm.edu.my', '07-453 7000', 'Universiti Tun Hussein Onn Malaysia (UTHM), \r\n86400 Parit Raja, Batu Pahat  \r\nJohor, Malaysia', 'Active', NULL, '2021-09-07 03:31:47', '2021-09-07 03:31:47', NULL, NULL),
(4, 17, 140, 5, 'servicedesk@uum.edu.my', '04-928 3048', 'Universiti Utara Malaysia,\r\n06010 Sintok,\r\nKedah, Malaysia', 'Active', NULL, '2021-09-07 03:38:21', '2021-09-07 03:38:21', NULL, NULL),
(5, 33, 119, 5, 'institution@email.com', '0784569821', 'Institution 1, Jln Institution', NULL, NULL, '2021-11-09 01:20:50', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_code` varchar(10) NOT NULL,
  `job_title` text NOT NULL,
  `job_description` longtext NOT NULL,
  `job_date_posted` datetime NOT NULL,
  `job_no_of_vacancies` int(11) NOT NULL,
  `job_min_salary` int(11) DEFAULT NULL,
  `job_max_salary` int(11) DEFAULT NULL,
  `job_type` enum('Full-Time','Part-Time','Temporary','Contract','Internship') NOT NULL,
  `job_category_id` int(11) NOT NULL,
  `job_position_id` int(11) NOT NULL,
  `job_industry_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_code`, `job_title`, `job_description`, `job_date_posted`, `job_no_of_vacancies`, `job_min_salary`, `job_max_salary`, `job_type`, `job_category_id`, `job_position_id`, `job_industry_id`) VALUES
(1, 'T34-3-1', 'Team Lead Technical Engineer (Linux)', '<p><strong>Senior Technical Engineer (Cloud Services)</strong></p><p><strong>RESPONSIBILITIES</strong></p><p>- Design and monitoring private, hybrid and public cloud servers (Windows/Linux).</p><p>- H<span style=\"color:rgba(0, 0, 0, 0.87)\">ands-on experience with Linux environment, and experience in troubleshooting, setup servers, monitor everyday system and respond to alert of all server resources and perform all activities for Windows/Linux servers.</span></p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Review error logs and reported errors and seek out solutions (Nginx,PHP etc)</span></p><p>- Provide technical expertise to client by troubleshooting and fix technical issues via ticketing platform and telephone etc.</p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Maintain various networking components E.g.: VPN, Load Balancer, Firewall and Routing.</span></p><p>- Establish networking environment by designing system configuration, directing system installation, defining, documenting, and enforcing system standards.</p><p>- Maximize network performance by monitoring performance, troubleshooting network problems and outages, scheduling upgrades, collaborating with network engineer on network optimization.</p><p>- Secure system by establishing and enforcing policies, defining, monitoring access, server hardening.&nbsp;</p><p>- Accomplish information systems and organization mission by completing related results as needed.</p><p>- Ability to multitask across different projects.</p><p><strong>REQUIRED</strong></p><p>- Have a good understanding of operating systems, cloud computing and networking.</p><p>- Well versed in Linux programming.</p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Min 2 years of work experience in managing Cloud Service, Automation, Install and Configure Linux Systems is required for this position.</span></p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Experience in installing, configuring, and maintaining services such as MySQL, Nginx, Redis, MongoDB, etc,</span></p><p>- Independent and responsible.</p><p>- Willing to take up challenges for self-improvement.</p><p>- Good in trouble shooting and solving technical issues.</p><p>- Willing to work on rotating shifts for day shifts and night shifts.</p><p>- Familiarity with virtualisation software such as VMware, Hyper-V, Proxmox etc is an added advantage.</p><p>- Experienced in web hosting industry is an added advantage.</p><p>- Familiarity with public cloud such as AWS, Azure, GCP etc is an added advantage.</p><p><strong>QUALIFICATIONS</strong></p><p>- Bachelor’s Degree in IT or its equivalent and or/ possesses hands-on experience.</p><p>- Min 2-years relevant working experience. Linux/Windows Hosting experience candidates are encouraged to apply.</p><p>- Fluent in written and spoken English and Bahasa Malaysia.</p><p>- Fluent in Mandarin will be an added advantage.</p><p><strong>Senior Technical Engineer (On-Site Engineer)</strong></p><p><strong>RESPONSIBILITIES</strong></p><p>- Design and monitoring private, hybrid and public cloud servers (Windows/Linux).</p><p>- H<span style=\"color:rgba(0, 0, 0, 0.87)\">ands-on experience with Linux environment, and experience in troubleshooting, setup servers, monitor everyday system and respond to alert of all server resources and perform all activities for Windows/Linux servers.</span></p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Review error logs and reported errors and seek out solutions (Nginx,PHP etc)</span></p><p>- Provide technical expertise to client by troubleshooting and fix technical issues via ticketing platform and telephone etc.</p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Maintain various networking components E.g.: VPN, Load Balancer, Firewall and Routing.</span></p><p>- Establish networking environment by designing system configuration, directing system installation, defining, documenting, and enforcing system standards.</p><p>- Maximize network performance by monitoring performance, troubleshooting network problems and outages, scheduling upgrades, collaborating with network engineer on network optimization.</p><p>- Secure system by establishing and enforcing policies, defining, monitoring access, server hardening.&nbsp;</p><p>- Accomplish information systems and organization mission by completing related results as needed.</p><p>- Ability to multitask across different projects.</p><p><strong>REQUIRED</strong></p><p>- Have a basic understanding of operating systems, cloud computing and networking.</p><p>- Well versed in Linux programming.</p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Min 2 years of work experience in managing Cloud Service, Automation, Install and Configure Linux Systems is required for this position.</span></p><p>- <span style=\"color:rgba(0, 0, 0, 0.87)\">Experience in installing, configuring, and maintaining services such as MySQL, Nginx, Redis, MongoDB, etc,</span></p><p>- Independent and responsible.</p><p>- Willing to take up challenges for self-improvement.</p><p>- Good in trouble shooting and solving technical issues.</p><p>- Willing to work on rotating shifts for day shifts and night shifts.</p><p>- Familiarity with virtualisation software such as VMware, Hyper-V, Proxmox and etc is an added advantage.</p><p><strong>QUALIFICATIONS</strong></p><p>- Bachelor’s Degree in IT or its equivalent and or/ possesses hands-on experience.</p><p>- Min 2-years relevant working experience. Linux/Windows Hosting experience candidates are encouraged to apply.</p><p>- Fluent in written and spoken English and Bahasa Malaysia.</p><p>- Fluent in Mandarin will be an added advantage.</p>', '2021-12-30 08:23:46', 4, 4000, 7000, 'Contract', 8, 2, 3),
(2, 'L35-4-2', 'IT System Administrator', '<div style=\"text-align:justify\">An&nbsp;IT Executive&nbsp;is to oversee the information technology needs of an organization including supervising subordinates, coordinating network and security implementation and upgrades, determining IT budget and equipment needs, and ensuring systems security.</div><div><strong>Job Responsibilities:</strong></div><div><br>Administration</div><ul><li>To ensure all licensed software is properly managed and deployed in a timely manner.</li><li>To monitor and track the usage of all licensed software.</li><li>Assist with the creation of IT-related documents.</li><li>Managed Network, Security and AD within the office environment.</li></ul>&nbsp;Security<ul><li>To ensure the studio’s software is free from any unlicensed software, plugins or apps</li><li>To ensure all licensed software and credentials is secured</li><li>To keep all software and OS are up to date</li><li>To ensure security patches and updates is constantly deployed</li><li>To monitor the network and users to avoid attacks and vulnerability</li></ul>Business continuity<ul><li>Managing license server and ensuring continuity plans should a disaster happen</li><li>To constantly improve and speed up production processes.</li></ul>&nbsp;Research and Evaluation<ul><li>To keep LSA ahead in terms of technologies and processes</li><li>Evaluate and recommend technologies to improve productivity and security</li></ul><br><strong>Job Requirements:</strong><ul><li>Candidate must possess at least a Professional Certificate, Diploma/Advanced/Higher/Graduate Diploma/Bachelor’s degree/ Postgraduate diploma/ professional degree in computer science/information technology or equivalent</li><li>5 and above year(s) of working experience in the related field is required for this position</li><li>A senior executive specializes in IT/Computer Network/System/Database Admin or equivalent</li><li>Related experience and knowledge of networking and troubleshooting internet is preferred</li><li>Knowledge of LAN hardware and software management</li><li>Experience in PC troubleshooting, firewall, networking equipment, Active Directory and Animation software</li><li>Aggressive, self-motivated, able to work independently under minimal supervision</li><li>Candidate must be willing to travel to site offices for IT matters</li></ul>', '2021-12-30 08:33:48', 2, NULL, NULL, 'Full-Time', 8, 2, 4),
(3, 'A36-5-3', 'Manager - IT Infrastructure', '<li style=\"text-align:justify\">Supervise &amp; lead team members to achieve KPI in productivity.</li><li style=\"text-align:justify\">To motivate, coach and inspire team members to maintain and improve the system operations.</li><li style=\"text-align:justify\">To ensure all team members understand and adherence to company policies and procedures.</li><li style=\"text-align:justify\">To provide support on network administration, hardware/software installation, maintenance &amp; implementation of PCs, servers, SAN/NAS storage, LAN/WAN/VPN network infrastructure and upkeep of Data Centres.</li><li style=\"text-align:justify\">Responsible on providing resolution of network outages, incident management, customer consulting, vendor management, operational delivery, solution design, data centre and network capacity planning.</li><li style=\"text-align:justify\">Monitor PCs, Network, Data Centres and LAN/WAN/VPN securities, system resources (such as CPU, RAM, disk space, Telco lines, server racks, Data Centre humidity and temperature) and performance using Monitoring tools</li><li style=\"text-align:justify\">Support and train users on IS/IT tools.</li><li style=\"text-align:justify\">Ensure documentation, procedures and guidelines are up to-date.</li><li style=\"text-align:justify\">Attend and solve user problem (IR, HSR, UAR and etc).</li><li style=\"text-align:justify\">Involved in departmental project.</li><li style=\"text-align:justify\">Liaise with vendor on any PCs hardware/software, network LAN/WAN/VPN troubleshooting, Infrastructure support, availability of data centre facilities and problem solving.</li><li style=\"text-align:justify\">Second level support for all systems, LAN/WAN/VPN connectivity and SAN/NAS storage.</li><li style=\"text-align:justify\">Ensure all AEON’s information assets confidentiality, integrity and availability are protected</li><li style=\"text-align:justify\">Ensure periodic backup on PCs policies, Network and Infrastructure equipment configuration, verify backup and recovery procedures from time to time and ensuring cleanliness of data centre facilities.</li></ul><div style=\"text-align:justify\">Requirements:</div><ul><li style=\"text-align:justify\">Diploma/Advanced Diploma or Bachelor’s Degree in Computer Science/Information Technology or equivalent</li><li style=\"text-align:justify\">Preferable at least 8 years of working experience in the related field is required for this position.</li><li style=\"text-align:justify\">Knowledge in managing a team of resources is essential.</li><li style=\"text-align:justify\">Knowledge in Data Centre Operations</li><li style=\"text-align:justify\">Good knowledge in Microsoft Windows architecture &amp; environment-client/server</li><li style=\"text-align:justify\">Familiar with CISCO router, switches &amp; firewall configuration, knowledge in LAN/WAN/VPN setup in large organization.</li><li style=\"text-align:justify\">Good knowledge in TCP/IP application, system integration &amp; security such as DHCP, DNS, SMTP, Firewall and FTP etc</li><li style=\"text-align:justify\">Strong interpersonal skills and self-motivation</li><li style=\"text-align:justify\">Committed to work/assignment given</li><li style=\"text-align:justify\">Must display professionalism and confidence</li><li style=\"text-align:justify\">Excellent customer service skills</li><li style=\"text-align:justify\">Pro-activity to follow the incidents</li><li style=\"text-align:justify\">Strong organizational, multi-tasking and time-management skills</li><li style=\"text-align:justify\">Proven ability to work independently and as a team member</li><li style=\"text-align:justify\">Ability to be flexible and work analytically in a problem-solving environment</li><li style=\"text-align:justify\">Must be able to carry-out technical support and implementation work</li><li style=\"text-align:justify\">Computer literate in Microsoft latest products such as MsOffice, Windows Operating System</li><li style=\"text-align:justify\">Excellent communication (written and oral), presentation and interpersonal skills</li><li style=\"text-align:justify\">Strong knowledge on networking, operating system</li><li style=\"text-align:justify\">Good communication skill</li><li style=\"text-align:justify\">IT Business acumen</li>', '2021-12-30 08:36:45', 1, 5000, 8500, 'Full-Time', 8, 1, 5),
(4, 'M37-6-4', 'Internship For Marketing / Graphic Design', '<p>Requirements</p></div></div><br><div><p>Malaysian,PR/Work permit holder</p></div><br><div><div><br><ul><br><li>Degree/Diploma in Business Administration, Marketing, Mass Communications, Advertising, Media, Design and any related field.</li><br><li>Strong communication,&nbsp;result-oriented</li><br><li>Able to handle multi-task.</li><br></ul><br></div></div><br><div><div><p>Responsibilities</p></div></div><br><div><div><br><ul><br><li>Perform job duties assigned by immediate superior.</li><br><li>Got chance to work as permanent once completed practical training.</li><br><li>Can handle the job that been assigned</li><br></ul><br></div></div><br><div><div><p>Benefits</p></div></div><br><div><div><br><ul><br><li>Training Provided</li><br><li>Allowance Provided</li><br></ul><br><p>Additional Benefits</p><br><ul><br><li>5 Days Work</li><br><li>Training Provided</li><br><li>Allowance Provided</li><br><li>Near to Public Transport</li><br><li>Career Advancement</li>', '2022-01-02 01:54:35', 3, 800, 1200, 'Internship', 4, 4, 6),
(5, 'Z38-7-5', 'Field Service Technician', 'Candidates should be a&nbsp;<strong>team player</strong>&nbsp;with&nbsp;<strong>good analytical skills</strong>, with a deep understanding of&nbsp;<strong>Mechanical/Electrical&nbsp;</strong>processing technologies in the Food industry.</p><p>You will be working with our team:</p><ul><li><strong>Installing, servicing, and maintenance of food packaging and food processing machines</strong></li><li><strong>Troubleshooting machine errors when problems arise</strong></li><li>Work closely with logistics department on machine installation and parts delivery</li><li>Liaising with suppliers for parts-related logistics matters</li><li>Monitor and report Customer feedback</li><li>Design training plans for onboarding of new employees</li><li>Perform any other ad-hoc duties as assigned</li></ul><p>Requirements:</p><ul><li>Hands-on repair and food industry experience preferred</li><li>Driving License:&nbsp;<strong>Manual Car</strong></li><li>Preferred Skill: <strong>Programmable Logic Controller (PLC)</strong></li><li>Background in <strong>Mechanical</strong>, <strong>Electrical,</strong> or equivalent</li><li>Ideally at least 1 - 2 Year(s) of experience in <strong>Machinery Repair/Maintenance</strong></li><li>Must be willing to travel for overseas assignments</li><li>Food processing machines require handling of&nbsp;<strong>beef and pork</strong>', '2022-01-02 02:01:05', 1, NULL, NULL, 'Full-Time', 9, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `jc_id` int(11) NOT NULL,
  `jc_code` int(10) NOT NULL,
  `jc_name` text NOT NULL,
  `jc_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`jc_id`, `jc_code`, `jc_name`, `jc_description`) VALUES
(1, 1001, 'Accounting/Finance', '<p>Accounting/Finance involves the concepts of money, business and management, with an emphasis on professional careers in these areas. Accounting relates to information analysis for different aspects of a business, while finance solely concerns a business\' monetary funds.</p>'),
(2, 1002, 'Admin/Human Resources', '<p>Admin/Human Resources is responsible for a wide range of duties, including payroll and compensation, recruiting and staffing, performance and training, labor relations, administering employment benefits and organizational development.</p>'),
(3, 1003, 'Sales/Marketing', '<p>Sales/Marketing\'s responsibilities include generating unique sales plans, creating engaging advertisements, emails, and promotional literature, developing pricing strategies, and meeting marketing and sales human resource objectives.</p>'),
(4, 1004, 'Arts/Media/Communications', '<p>Arts/Media/Communications are related to humanities and performing, visual, literary, and media arts. These include architecture, graphics, interior and fashion design, writing, film, fine arts, journalism, languages, media, advertising, and public relations.</p>'),
(5, 1005, 'Services', '<p>This job includes:</p><ul><li>Serves customers by providing product and service information and resolving product and service problems.</li><li>Serves the goverment to help implement their policies and laws.</li><li>Provides counsel and represents businesses, individuals, and government agencies in legal matters and disputes<li></ul>'),
(6, 1006, 'Hotel/Restaurant', '<p>Taking customers\' food and drink orders. Collaborating with the kitchen and bar staff for prompt and correct delivery of orders. Memorizing the menu and recommend appetizers, meals and drinks from restaurant wine stock. Delivering a memorable dining experience by resolving all customer issues promptly.</p>'),
(7, 1007, 'Education/Training', '<p>Education and training workers guide and train people. As a teacher, you could influence young lives. You could also support the work of a classroom teacher as a counselor, librarian, or principal. You could coach sports activities or lead community classes.</p>'),
(8, 1008, 'Computer/Information Technology', '<p>Information technology (IT) professionals are responsible for helping organizations maintain their digital infrastructure and providing troubleshooting assistance to technology consumers. IT employees are in demand to help others keep up with technological advances and security procedures.</p>'),
(9, 1009, 'Engineering', '<p>To engineer literally means \'to make things happen\'. Most of what engineers do on a daily basis can fall into four categories: communicating, problem solving, analyzing, and planning. Depending on an engineer\'s industry and role, their day will typically consist of a various mix of these functions.</p>'),
(10, 1010, 'Manufacturing', '<p>A manufacturing job involves the creation of new products either from raw materials or by assembling different components through physical, chemical or mechanical means. It can also be a smaller operation for products like customer tailoring, wig making and other non-standard or custom items.</p>'),
(11, 1011, 'Building/Construction', '<p>Preparing construction sites, materials, and tools. Loading and unloading of materials, tools, and equipment. Removing debris, garbage, and dangerous materials from sites. Assembling and breaking down barricades, temporary structures, and scaffolding.</p>'),
(12, 1012, 'Sciences', '<p>Scientists are responsible for examining and exploring different aspects of the physical world. All their exploration processes are done following a set of rules know as the scientific method in order to confirm that new discoveries are factual and not just speculation.</p>'),
(13, 1013, 'Healthcare', '<p>Assist patients with basic hygiene activities. Administer medication to patients. Take vital signs and report findings to superiors. Work closely with other healthcare professionals such as nurses, physicians, and therapists in order to provide patients with exceptional care.</p>'),
(14, 1014, 'Others', '<p>Other jobs that\'s not categorized.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `job_position`
--

CREATE TABLE `job_position` (
  `jp_id` int(11) NOT NULL,
  `jp_code` varchar(10) NOT NULL,
  `jp_name` text NOT NULL,
  `jp_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_position`
--

INSERT INTO `job_position` (`jp_id`, `jp_code`, `jp_name`, `jp_description`) VALUES
(1, '1001', 'Manager', '<p>The manager is an employee who is responsible for planning, directing, and overseeing the operations and fiscal health of a business unit, division, department, or operating unit within an organization. The manager is responsible for overseeing and leading the work of a group of people in many instances.</p>'),
(2, '1002', 'Senior Executive', '<p>The position of a senior executive is often that of authority in a company. This person is in charge of making decisions and also implementing them. As a senior executive, you will support the CEO, CFO, and CTO, as well as other higher-ranking professionals, while providing strategic administrative support.</p>'),
(3, '1003', 'Junior Executive', '<p>Junior executives often assist executive officers, who spend much of their time focusing on business development. Duties may include developing and implementing marketing strategies, interacting with customers, and planning and organizing activities and projects within the company.</p>'),
(4, '1004', 'Intern', '<p>An intern is a trainee who has signed on with an organisation for a brief period. An intern\'s goal is to gain work experience, occasionally some university credit, and always an overall feel for the industry they\'re interning in. Internships may be paid, partially paid, or unpaid.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `job_skill_set`
--

CREATE TABLE `job_skill_set` (
  `jss_id` int(11) NOT NULL,
  `jss_name` text NOT NULL,
  `jss_skill_level` int(1) NOT NULL,
  `jss_job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_skill_set`
--

INSERT INTO `job_skill_set` (`jss_id`, `jss_name`, `jss_skill_level`, `jss_job_id`) VALUES
(1, 'Computer/Information Technology', 2, 3),
(2, 'IT-Network/Sys/DB Admin', 3, 3),
(3, 'Bachelor\'s Degree', 3, 1),
(4, 'Professional Degree', 2, 1),
(5, 'Advanced/Higher/Graduate Diploma', 3, 2),
(6, 'Post Graduate Diploma', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_student_university_application`
--

CREATE TABLE `job_student_university_application` (
  `jsua_id` int(11) NOT NULL,
  `jsua_job_id` int(11) NOT NULL,
  `jsua_student_university_id` int(11) NOT NULL,
  `jsua_application_date` datetime NOT NULL,
  `jsua_status` varchar(11) NOT NULL,
  `jsua_summary` longtext NOT NULL,
  `jsua_attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_student_university_application`
--

INSERT INTO `job_student_university_application` (`jsua_id`, `jsua_job_id`, `jsua_student_university_id`, `jsua_application_date`, `jsua_status`, `jsua_summary`, `jsua_attachment`) VALUES
(6, 5, 1, '2022-01-06 16:15:53', 'Pending', 'Hire me please!', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_id` int(11) NOT NULL,
  `lecturer_user_id` int(11) NOT NULL,
  `lecturer_role_id` int(11) NOT NULL,
  `lecturer_fname` text NOT NULL,
  `lecturer_lname` text NOT NULL,
  `lecturer_nationality` varchar(100) DEFAULT NULL,
  `lecturer_no_ic` varchar(100) DEFAULT NULL,
  `lecturer_passport_no` varchar(100) DEFAULT NULL,
  `lecturer_email` varchar(255) NOT NULL,
  `lecturer_gender` varchar(10) DEFAULT NULL,
  `lecturer_contact_no` varchar(50) DEFAULT NULL,
  `lecturer_dob` date DEFAULT NULL,
  `lecturer_address` varchar(255) DEFAULT NULL,
  `lecturer_profile_picture` varchar(255) DEFAULT NULL,
  `lecturer_city_id` int(11) DEFAULT NULL,
  `lecturer_state_id` int(11) DEFAULT NULL,
  `lecturer_country_id` int(11) DEFAULT NULL,
  `lecturer_institution_id` int(11) NOT NULL,
  `lecturer_status` enum('Active','Inactive') DEFAULT NULL,
  `lecturer_created_by` int(11) DEFAULT NULL,
  `lecturer_created_date` datetime DEFAULT NULL,
  `lecturer_updated_date` datetime DEFAULT NULL,
  `lecturer_deleted_date` datetime DEFAULT NULL,
  `lecturer_title` varchar(255) DEFAULT NULL,
  `lecturer_faculty` varchar(255) DEFAULT NULL,
  `lecturer_department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturer_id`, `lecturer_user_id`, `lecturer_role_id`, `lecturer_fname`, `lecturer_lname`, `lecturer_nationality`, `lecturer_no_ic`, `lecturer_passport_no`, `lecturer_email`, `lecturer_gender`, `lecturer_contact_no`, `lecturer_dob`, `lecturer_address`, `lecturer_profile_picture`, `lecturer_city_id`, `lecturer_state_id`, `lecturer_country_id`, `lecturer_institution_id`, `lecturer_status`, `lecturer_created_by`, `lecturer_created_date`, `lecturer_updated_date`, `lecturer_deleted_date`, `lecturer_title`, `lecturer_faculty`, `lecturer_department`) VALUES
(1, 18, 7, 'Alibaba', 'Jones', 'Malaysian', '860727026711', '', 'alibabajones@gmail.com', '1', '0173717777', '1986-07-27', 'No 1.0, Lrg Satu Point Kosong, Tmn 1.0, ', 'instructor-img-4.jpg', 2, 1, 1, 1, 'Active', 1, '2021-09-04 14:24:44', '2021-09-04 14:24:44', NULL, 'Associate Professor', 'Engineering', 'Computer Science'),
(2, 26, 7, 'Anita', 'Anette', NULL, NULL, NULL, 'anitaanette@gmail.com', '', '0127865094', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Active', NULL, '2021-09-27 10:40:29', '2021-09-27 10:40:29', NULL, 'Senior Lecturer', 'Engineering', 'Computer Science'),
(3, 31, 7, 'Instructor', 'One', 'Malaysia', '850101053699', NULL, 'instructor@email.com', 'Male', '01134567890', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Active', NULL, '2021-11-09 01:17:11', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_education_degree`
--

CREATE TABLE `lecturer_education_degree` (
  `lectdeg_id` int(11) NOT NULL,
  `lectdeg_lecturer_id` int(11) NOT NULL,
  `lectdeg_university_id` int(11) NOT NULL,
  `lectdeg_degree_id` int(11) NOT NULL,
  `lectdeg_field_id` int(11) NOT NULL,
  `lectdeg_name` text NOT NULL,
  `lectdeg_cgpa` varchar(10) NOT NULL,
  `lectdeg_start_date` date NOT NULL,
  `lectdeg_end_date` date NOT NULL,
  `lectdeg_transcript` varchar(255) NOT NULL,
  `lectdeg_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_education_diploma`
--

CREATE TABLE `lecturer_education_diploma` (
  `lectdip_id` int(11) NOT NULL,
  `lectdip_lecturer_id` int(11) NOT NULL,
  `lectdip_university_id` int(11) NOT NULL,
  `lectdip_diploma_id` int(11) NOT NULL,
  `lectdip_field_id` int(11) NOT NULL,
  `lectdip_name` text NOT NULL,
  `lectdip_cgpa` varchar(10) NOT NULL,
  `lectdip_start_date` date NOT NULL,
  `lectdip_end_date` date NOT NULL,
  `lectdip_transcript` varchar(255) NOT NULL,
  `lectdip_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_education_master`
--

CREATE TABLE `lecturer_education_master` (
  `lectm_id` int(11) NOT NULL,
  `lectm_lecturer_id` int(11) NOT NULL,
  `lectm_university_id` int(11) NOT NULL,
  `lectm_master_id` int(11) NOT NULL,
  `lectm_field_id` int(11) NOT NULL,
  `lectm_name` text NOT NULL,
  `lectm_cgpa` varchar(10) NOT NULL,
  `lectm_start_date` date NOT NULL,
  `lectm_end_date` date NOT NULL,
  `lectm_transcript` varchar(255) NOT NULL,
  `lectm_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_education_phd`
--

CREATE TABLE `lecturer_education_phd` (
  `lectp_id` int(11) NOT NULL,
  `lectp_lecturer_id` int(11) NOT NULL,
  `lectp_university_id` int(11) NOT NULL,
  `lectp_phd_id` int(11) NOT NULL,
  `lectp_field_id` int(11) NOT NULL,
  `lectp_name` text NOT NULL,
  `lectp_start_date` date NOT NULL,
  `lectp_end_date` date NOT NULL,
  `lectp_transcript` varchar(255) NOT NULL,
  `lectp_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_experience_details`
--

CREATE TABLE `lecturer_experience_details` (
  `led_id` int(11) NOT NULL,
  `led_lecturer_id` int(11) NOT NULL,
  `led_job_location_city_id` int(11) NOT NULL,
  `led_job_location_state_id` int(11) NOT NULL,
  `led_job_location_country_id` int(11) NOT NULL,
  `led_job_title` text NOT NULL,
  `led_description` longtext NOT NULL,
  `led_company_name` text NOT NULL,
  `led_start_date` date NOT NULL,
  `led_end_date` date NOT NULL,
  `led_job_status` enum('Current','Past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_skill_set`
--

CREATE TABLE `lecturer_skill_set` (
  `lss_id` int(11) NOT NULL,
  `lss_lecturer_id` int(11) NOT NULL,
  `lss_skill_type_id` int(11) NOT NULL,
  `lss_skill_level` enum('Beginner','Intermediate','Advance') NOT NULL,
  `lss_skill_certificate` varchar(255) NOT NULL,
  `lss_certificate_provider` text DEFAULT NULL,
  `lss_certificate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `master_id` int(11) NOT NULL,
  `master_type` enum('Research','Coursework','Mixed Mode') NOT NULL,
  `master_name` text NOT NULL,
  `master_major` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_assignment`
--

CREATE TABLE `mc_assignment` (
  `mca_id` int(11) NOT NULL,
  `mca_mc_id` int(11) NOT NULL,
  `mca_title` text NOT NULL,
  `mca_description` longtext NOT NULL,
  `mca_attachment` varchar(255) NOT NULL,
  `mca_total_no_of_assignment` int(100) NOT NULL,
  `mca_created_date` datetime DEFAULT current_timestamp(),
  `mca_created_by` int(11) NOT NULL,
  `mca_updated_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mca_deleted_date` datetime DEFAULT NULL,
  `mca_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_assignment`
--

INSERT INTO `mc_assignment` (`mca_id`, `mca_mc_id`, `mca_title`, `mca_description`, `mca_attachment`, `mca_total_no_of_assignment`, `mca_created_date`, `mca_created_by`, `mca_updated_date`, `mca_deleted_date`, `mca_status`) VALUES
(1, 5, 'Assignment 1', 'Do all.', 'Final Assessment.pdf', 1, '2021-10-21 15:56:34', 8, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_assignment_duedate`
--

CREATE TABLE `mc_assignment_duedate` (
  `mcad_id` int(11) NOT NULL,
  `mcad_mc_assignment_id` int(11) NOT NULL,
  `mcad_duedate_date` date NOT NULL,
  `mcad_duedate_time` time NOT NULL,
  `mcad_duedate_gmt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_assignment_duedate`
--

INSERT INTO `mc_assignment_duedate` (`mcad_id`, `mcad_mc_assignment_id`, `mcad_duedate_date`, `mcad_duedate_time`, `mcad_duedate_gmt`) VALUES
(1, 1, '2021-11-10', '23:59:00', '2021-10-21 09:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `mc_course_credit_transfer`
--

CREATE TABLE `mc_course_credit_transfer` (
  `mccct_id` int(11) NOT NULL,
  `mccct_mc_id` int(11) NOT NULL,
  `mccct_course_title` tinytext DEFAULT NULL,
  `mccct_course_code` varchar(100) DEFAULT NULL,
  `mccct_course_level` varchar(255) DEFAULT NULL,
  `mccct_course_credit` varchar(1) DEFAULT NULL,
  `mccct_created_by` int(11) DEFAULT NULL,
  `mccct_created_date` datetime DEFAULT current_timestamp(),
  `mccct_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mccct_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_enrolment_session`
--

CREATE TABLE `mc_enrolment_session` (
  `mces_id` int(11) NOT NULL,
  `mces_mc_id` int(11) NOT NULL,
  `mces_start_date` date NOT NULL,
  `mces_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_enrolment_session`
--

INSERT INTO `mc_enrolment_session` (`mces_id`, `mces_mc_id`, `mces_start_date`, `mces_end_date`) VALUES
(1, 3, '2021-12-27', '2022-01-12'),
(2, 2, '2021-12-15', '2021-12-25'),
(3, 1, '2021-12-29', '2021-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `mc_instructor`
--

CREATE TABLE `mc_instructor` (
  `mci_id` int(11) NOT NULL,
  `mci_mc_id` int(11) NOT NULL,
  `mci_user_id` int(11) NOT NULL,
  `mci_type` enum('Lecturer','Expert') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_instructor`
--

INSERT INTO `mc_instructor` (`mci_id`, `mci_mc_id`, `mci_user_id`, `mci_type`) VALUES
(11, 9, 18, 'Lecturer'),
(12, 10, 26, 'Lecturer'),
(13, 5, 19, 'Expert');

-- --------------------------------------------------------

--
-- Table structure for table `mc_learning_details`
--

CREATE TABLE `mc_learning_details` (
  `mcld_id` int(11) NOT NULL,
  `mcld_mc_id` int(11) NOT NULL,
  `mcld_learning_outcome` text NOT NULL,
  `mcld_intended_learners` tinytext NOT NULL,
  `mcld_prerequisites` tinytext NOT NULL,
  `mcld_skills` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_learning_details`
--

INSERT INTO `mc_learning_details` (`mcld_id`, `mcld_mc_id`, `mcld_learning_outcome`, `mcld_intended_learners`, `mcld_prerequisites`, `mcld_skills`) VALUES
(1, 3, 'This course will introduce the concepts of fundamental cryptography and its applications. The topics that will be covered are:\r\n<ul>\r\n<li>evolution of cryptography</li>\r\n<li>number theory</li>\r\n<li>information theory</li>\r\n<li>symmetric and asymmetric cryptography</li>\r\n<li>message authentication</li>\r\n</ul>\r\nSeveral cryptographic structures and the characteristics of the algorithms that provide the strength to the algorithms will also be discussed. At the end of the course, the student should be able to apply the knowledge in developing application with security features.', 'This course is suitable for anyone who would like to learn about the concepts of fundamental cryptography and its applications.', 'SCSR3443 - COMPUTER SECURITY', 'Learners will build the logic and the pseudo-code for the widely used cryptographic primitives and algorithms, which will enable them to implement the cryptographic primitives in any platforms/language they choose.');

-- --------------------------------------------------------

--
-- Table structure for table `mc_notes`
--

CREATE TABLE `mc_notes` (
  `mcn_id` int(11) NOT NULL,
  `mcn_mc_id` int(11) NOT NULL,
  `mcn_title` text NOT NULL,
  `mcn_description` longtext NOT NULL,
  `mcn_attachment` varchar(255) NOT NULL,
  `mcn_total_no_of_notes` int(100) DEFAULT NULL,
  `mcn_created_date` datetime DEFAULT current_timestamp(),
  `mcn_created_by` int(11) NOT NULL,
  `mcn_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcn_deleted_date` datetime DEFAULT NULL,
  `mcn_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_notes`
--

INSERT INTO `mc_notes` (`mcn_id`, `mcn_mc_id`, `mcn_title`, `mcn_description`, `mcn_attachment`, `mcn_total_no_of_notes`, `mcn_created_date`, `mcn_created_by`, `mcn_updated_date`, `mcn_deleted_date`, `mcn_status`) VALUES
(1, 5, 'MPI Communications', 'Message Passing Interface (MPI) is a communication protocol for parallel programming. MPI is specifically used to allow applications to run in parallel across a number of separate computers connected by a network.', '06-MPI-communications.pdf', 1, '2021-10-21 15:42:49', 8, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_project`
--

CREATE TABLE `mc_project` (
  `mcp_id` int(11) NOT NULL,
  `mcp_mc_id` int(11) NOT NULL,
  `mcp_title` text NOT NULL,
  `mcp_description` longtext NOT NULL,
  `mcp_attachment` varchar(255) NOT NULL,
  `mcp_total_no_of_project` int(100) NOT NULL,
  `mcp_created_date` datetime DEFAULT current_timestamp(),
  `mcp_created_by` int(11) NOT NULL,
  `mcp_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcp_deleted_date` datetime DEFAULT NULL,
  `mcp_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_project`
--

INSERT INTO `mc_project` (`mcp_id`, `mcp_mc_id`, `mcp_title`, `mcp_description`, `mcp_attachment`, `mcp_total_no_of_project`, `mcp_created_date`, `mcp_created_by`, `mcp_updated_date`, `mcp_deleted_date`, `mcp_status`) VALUES
(1, 5, 'Project 1', 'Do all.', 'Project Group.pdf', 1, '2021-10-21 15:58:10', 8, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_project_duedate`
--

CREATE TABLE `mc_project_duedate` (
  `mcpd_id` int(11) NOT NULL,
  `mcpd_mc_project_id` int(11) NOT NULL,
  `mcpd_duedate_date` date NOT NULL,
  `mcpd_duedate_time` time NOT NULL,
  `mcpd_duedate_gmt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_project_duedate`
--

INSERT INTO `mc_project_duedate` (`mcpd_id`, `mcpd_mc_project_id`, `mcpd_duedate_date`, `mcpd_duedate_time`, `mcpd_duedate_gmt`) VALUES
(1, 1, '2021-11-20', '23:59:00', '2021-10-21 09:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz`
--

CREATE TABLE `mc_quiz` (
  `mcq_id` int(11) NOT NULL,
  `mcq_mc_id` int(11) NOT NULL,
  `mcq_title` text NOT NULL,
  `mcq_instruction` longtext DEFAULT NULL,
  `mcq_duration` int(11) DEFAULT NULL,
  `mcq_score` float DEFAULT NULL,
  `mcq_created_date` datetime DEFAULT current_timestamp(),
  `mcq_created_by` int(11) DEFAULT NULL,
  `mcq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcq_deleted_date` datetime DEFAULT NULL,
  `mcq_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_quiz`
--

INSERT INTO `mc_quiz` (`mcq_id`, `mcq_mc_id`, `mcq_title`, `mcq_instruction`, `mcq_duration`, `mcq_score`, `mcq_created_date`, `mcq_created_by`, `mcq_updated_date`, `mcq_deleted_date`, `mcq_status`) VALUES
(1, 5, 'Quiz 1', 'Answer all questions.', 30, 0, '2021-10-21 15:54:51', NULL, '2021-12-09 10:48:02', NULL, 'Published'),
(2, 5, 'Quiz 2', 'Answer all questions.', 10, 0, '2021-12-08 13:02:03', NULL, '2021-12-09 10:48:02', NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz_answer`
--

CREATE TABLE `mc_quiz_answer` (
  `mcqa_id` int(11) NOT NULL,
  `mcqa_mc_quiz_question_id` int(11) NOT NULL,
  `mcqa_answer1` text NOT NULL,
  `mcqa_answer2` text NOT NULL,
  `mcqa_answer3` text NOT NULL,
  `mcqa_answer4` text NOT NULL,
  `mcqa_right_answer` text NOT NULL,
  `mcqa_right_answerword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_quiz_answer`
--

INSERT INTO `mc_quiz_answer` (`mcqa_id`, `mcqa_mc_quiz_question_id`, `mcqa_answer1`, `mcqa_answer2`, `mcqa_answer3`, `mcqa_answer4`, `mcqa_right_answer`, `mcqa_right_answerword`) VALUES
(1, 1, 'Address.', 'Contents.', 'Both A and B.', 'None.', '3', 'Both A and B.'),
(2, 2, 'Bus.', 'Peripheral connection wires.', 'Both A and B.', 'Internal wires.', '1', 'Bus.'),
(3, 3, 'Processor.', 'Memory System.', 'Data path.', 'All of the above.', '4', 'All of the above.'),
(4, 4, 'Compile time analysis.', 'Initial time analysis.', 'Final time analysis.', 'id time analysis.', '1', 'Compile time analysis.'),
(6, 6, 'longer than', 'shorter than', 'negligible than', 'same as', '1', 'longer than'),
(7, 7, 'High aggregate throughput', 'High aggregate network bandwidth', 'High processing and memory system performance', 'None of above', '1', 'High aggregate throughput'),
(8, 8, 'Latency', 'Bandwidth', 'Both A and B', 'None of above', '3', 'Both A and B'),
(9, 9, 'Super-scaling', 'Pipe-lining', 'Parallel Computation', 'None of above.', '2', 'Pipe-lining'),
(10, 10, 'ISA', 'ANSA', 'Super-scalar', 'All of the above', '3', 'Super-scalar'),
(11, 12, 'Jawapan A', 'Jawapan B', 'Jawapan C', 'Jawapan D', '1', 'Jawapan A'),
(12, 13, 'Jawapan A', 'Jawapan B', 'Jawapan C', 'Jawapan D', '2', 'Jawapan B');

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz_question`
--

CREATE TABLE `mc_quiz_question` (
  `mcqq_id` int(11) NOT NULL,
  `mcqq_mc_quiz_id` int(11) NOT NULL,
  `mcqq_type` varchar(255) NOT NULL,
  `mcqq_question` text NOT NULL,
  `mcqq_score` float DEFAULT NULL,
  `mcqq_created_date` datetime DEFAULT current_timestamp(),
  `mcqq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcqq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_quiz_question`
--

INSERT INTO `mc_quiz_question` (`mcqq_id`, `mcqq_mc_quiz_id`, `mcqq_type`, `mcqq_question`, `mcqq_score`, `mcqq_created_date`, `mcqq_updated_date`, `mcqq_deleted_date`) VALUES
(1, 1, 'Multiple Choice', 'Which is the type of Microcomputer Memory?', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:19', NULL),
(2, 1, 'Multiple Choice', 'A collection of lines that connect several devices is called', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:19', NULL),
(3, 1, 'Multiple Choice', 'Conventional architectures coarsely comprise of a', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:19', NULL),
(4, 1, 'Multiple Choice', 'VLIW processors rely on', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:19', NULL),
(6, 1, 'Multiple Choice', 'The access time of memory is ______ the time required for performing any single CPU operation.', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:19', NULL),
(7, 1, 'Multiple Choice', 'Data intensive applications utilize ______.', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:20', NULL),
(8, 1, 'Multiple Choice', 'Memory system performance is largely captured by ______.', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:20', NULL),
(9, 1, 'Multiple Choice', 'A processor performing fetch or decoding of different instruction during the execution of another instruction is called ______.', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:20', NULL),
(10, 1, 'Multiple Choice', 'For a given FINITE number of instructions to be executed, which architecture of the processor provides for a faster execution?', 1, '2021-12-01 11:36:45', '2021-12-23 14:22:20', NULL),
(12, 2, 'Multiple Choice', 'Soalan pertama yang akan ditanya tertera disini?', 1, '2021-12-08 13:03:57', '2021-12-23 14:22:20', NULL),
(13, 2, 'Multiple Choice', 'Soalan kedua yang akan ditanya tertera disini?', 1, '2021-12-08 13:03:57', '2021-12-23 14:22:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mc_slide`
--

CREATE TABLE `mc_slide` (
  `mcs_id` int(11) NOT NULL,
  `mcs_mc_id` int(11) DEFAULT NULL,
  `mcs_title` text NOT NULL,
  `mcs_description` longtext NOT NULL,
  `mcs_attachment` varchar(255) DEFAULT NULL,
  `mcs_total_no_of_slide` int(100) DEFAULT NULL,
  `mcs_created_date` datetime DEFAULT current_timestamp(),
  `mcs_created_by` int(11) DEFAULT NULL,
  `mcs_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcs_deleted_date` datetime DEFAULT NULL,
  `mcs_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_slide`
--

INSERT INTO `mc_slide` (`mcs_id`, `mcs_mc_id`, `mcs_title`, `mcs_description`, `mcs_attachment`, `mcs_total_no_of_slide`, `mcs_created_date`, `mcs_created_by`, `mcs_updated_date`, `mcs_deleted_date`, `mcs_status`) VALUES
(1, 5, 'Introduction to HPPC', 'High performance computing/parallel computing is widely used, nowadays, to execute complex systems and computations of complex problems that need to be solved with minimal time as possible. This course introduces the students to architectures of parallel computers, parallel algorithm design and parallel application programming using MPI and OpenMP packages in C/C++ programming language.', '01-introduction-to-hppc.pptx', 1, '2021-10-21 15:51:35', NULL, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_test`
--

CREATE TABLE `mc_test` (
  `mct_id` int(11) NOT NULL,
  `mct_mc_id` int(11) NOT NULL,
  `mct_title` text DEFAULT NULL,
  `mct_instruction` longtext DEFAULT NULL,
  `mct_duration` int(11) DEFAULT NULL,
  `mct_score` float DEFAULT NULL,
  `mct_created_date` datetime DEFAULT current_timestamp(),
  `mct_created_by` int(11) NOT NULL,
  `mct_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mct_deleted_date` datetime DEFAULT NULL,
  `mct_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_test`
--

INSERT INTO `mc_test` (`mct_id`, `mct_mc_id`, `mct_title`, `mct_instruction`, `mct_duration`, `mct_score`, `mct_created_date`, `mct_created_by`, `mct_updated_date`, `mct_deleted_date`, `mct_status`) VALUES
(1, 5, 'Test 1', 'Answers all questions.', 90, 0, '2021-10-21 15:59:47', 8, '2021-12-09 11:21:43', NULL, 'Published'),
(2, 5, 'Test 2', 'Answer all questions.', 15, 0, '2021-12-09 11:20:37', 8, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_test_answer`
--

CREATE TABLE `mc_test_answer` (
  `mcta_id` int(11) NOT NULL,
  `mcta_mc_test_question_id` int(11) NOT NULL,
  `mcta_answer1` text NOT NULL,
  `mcta_answer2` text NOT NULL,
  `mcta_answer3` text NOT NULL,
  `mcta_answer4` text NOT NULL,
  `mcta_right_answer` text NOT NULL,
  `mcta_right_answerword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_test_answer`
--

INSERT INTO `mc_test_answer` (`mcta_id`, `mcta_mc_test_question_id`, `mcta_answer1`, `mcta_answer2`, `mcta_answer3`, `mcta_answer4`, `mcta_right_answer`, `mcta_right_answerword`) VALUES
(1, 41, 'directed', 'undirected', 'directed acyclic', 'undirected acyclic', '3', 'directed acyclic'),
(2, 42, 'total work', 'critical path', 'task path', 'task length', '2', 'critical path'),
(3, 43, 'course grain', 'large grain', 'medium grain', 'fine grain', '2', 'large grain'),
(4, 44, 'matrix multiplication', 'merge sort', 'quick sort', '15 puzzal', '1', 'matrix multiplication'),
(5, 45, 'backtracking', 'greedy method', 'divide and conquer problem', 'branch an bound', '2', 'divide and conquer problem'),
(6, 46, 'recursive decomposition', 'data decomposition', 'exploratory decomposition', 'speculative decomposition', '1', 'recursive decomposition'),
(7, 47, 'queens problem', '15 puzzal problem', 'tic tac toe', 'quick sort', '4', 'quick sort'),
(8, 48, 'Undirected Cyclic Graphs', 'Directed Cyclic Graphs', 'Undirected Acyclic Graphs', 'Directed Acyclic Graphs', '4', 'Directed Acyclic Graphs'),
(9, 49, 'Maximum Degree', 'Minimum Degree', 'Any degree', 'Zero Degree', '4', 'Zero Degree'),
(10, 50, 'Finding prerequisite of a task', 'Finding Deadlock in an Operating System', 'Finding Cycle in a graph', 'Ordered Statistics', '4', 'Ordered Statistics'),
(11, 51, 'dynamic task', 'static task', 'regular task', 'one way task', '2', 'static task'),
(12, 52, 'Grouped Processing Unit', 'Graphics Processing Unit', 'Graphical Performance Utility', 'Graphical Portable Unit', '2', 'Graphics Processing Unit'),
(13, 53, 'block', 'cyclic', 'block cyclic', 'chunk', '4', 'chunk'),
(14, 54, 'hit miss', 'misses', 'hit rate', 'cache misses', '4', 'cache misses'),
(15, 55, 'CDA thread', 'PTA thread', 'CUDA thread', 'CUD thread', '3', 'CUDA thread'),
(16, 56, 'Task generation', 'Task sizes', 'Size of data associated with tasks', 'Both A and B', '4', 'Both A and B'),
(17, 57, 'Always unique', 'Always Not unique', 'Sometimes unique and sometimes not unique', 'Always unique if graph has even number of vertices', '3', 'Sometimes unique and sometimes not unique'),
(18, 58, 'thread block', '32 thread', '32 block', 'unit block', '1', 'thread block'),
(21, 61, 'When there exists a hamiltonian path in the graph', 'In the presence of multiple nodes with indegree 0', 'In the presence of single node with indegree 0', 'In the presence of single node with outdegree 0', '1', 'When there exists a hamiltonian path in the graph'),
(22, 62, 'knowledge of task sizes', 'the size of data associated with tasks', 'characteristics of inter-task interactions', 'task overhead', '4', 'task overhead'),
(24, 64, 'Vector parallelism – Floating point computations are executed in parallel on wide vector units', 'Thread level task parallelism – Different threads execute a different tasks', 'Block and grid level parallelism – Different blocks or grids execute different tasks', 'Data parallelism – Different threads and blocks process different parts of data in memory', '1', 'Vector parallelism – Floating point computations are executed in parallel on wide vector units'),
(25, 65, 'MISD – Multiple Instruction Single Data', 'SIMT – Single Instruction Multiple Thread', 'SISD – Single Instruction Single Data', 'MIMD', '2', 'SIMT – Single Instruction Multiple Thread'),
(27, 67, 'A kernel may contain a mix of host and GPU code', 'All thread blocks involved in the same computation use the same kernel', 'A kernel is part of the GPU’s internal micro-operating system, allowing it to act as in independent host', 'kernel may contain only host code', '2', 'All thread blocks involved in the same computation use the same kernel'),
(28, 68, '32 thread', 'unit block', '32 block', 'thread block', '4', 'thread block'),
(29, 69, 'data parallel model', 'task graph model', 'task model', 'work pool model', '3', 'task model'),
(30, 70, 'WAW hazards', 'Destination registers', 'WAR hazards', 'Registers', '3', 'WAR hazards'),
(31, 71, 'First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer', '1', 'First Answer'),
(32, 72, 'First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer', '2', 'Second Answer'),
(33, 73, 'First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer', '3', 'Third Answer'),
(34, 74, 'First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer', '4', 'Fourth Answer'),
(35, 75, 'First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer', '3', 'Third Answer');

-- --------------------------------------------------------

--
-- Table structure for table `mc_test_question`
--

CREATE TABLE `mc_test_question` (
  `mctq_id` int(11) NOT NULL,
  `mctq_mc_test_id` int(11) NOT NULL,
  `mctq_type` varchar(255) NOT NULL,
  `mctq_question` text NOT NULL,
  `mctq_score` float NOT NULL,
  `mctq_created_date` datetime DEFAULT current_timestamp(),
  `mctq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mctq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_test_question`
--

INSERT INTO `mc_test_question` (`mctq_id`, `mctq_mc_test_id`, `mctq_type`, `mctq_question`, `mctq_score`, `mctq_created_date`, `mctq_updated_date`, `mctq_deleted_date`) VALUES
(41, 1, 'Multiple Choice', 'Task dependency graph is ______.', 1, '2021-12-06 16:11:21', '2021-12-23 14:23:31', NULL),
(42, 1, 'Multiple Choice', 'In task dependency graph longest directed path between any pair of start and finish node is called as ______.', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(43, 1, 'Multiple Choice', 'Which of the following is not a granularity type?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(44, 1, 'Multiple Choice', 'Which of the following is a an example of data decomposition?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(45, 1, 'Multiple Choice', 'Which problems can be handled by recursive decomposition?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(46, 1, 'Multiple Choice', 'In this decomposition, problem decomposition goes hand in hand with its execution.', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(47, 1, 'Multiple Choice', 'Which of the following is not an example of explorative decomposition?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(48, 1, 'Multiple Choice', 'Topological sort can be applied to which of the following graphs?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(49, 1, 'Multiple Choice', 'In most of the cases, topological sort starts from a node which has ______.', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(50, 1, 'Multiple Choice', 'Which of the following is not an application of topological sorting?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(51, 1, 'Multiple Choice', 'In ______ task are defined before starting the execution of the algorithm.', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(52, 1, 'Multiple Choice', 'What is GPU?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(53, 1, 'Multiple Choice', 'Which of the following is not the array distribution method of data partitioning?', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(54, 1, 'Multiple Choice', 'Blocking optimization is used to improve temporal locality for reducing ______.', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(55, 1, 'Multiple Choice', 'CUDA thought that ‘unifying theme’ of every form of parallelism is ', 1, '2021-12-06 16:17:36', '2021-12-23 14:23:31', NULL),
(56, 1, 'Multiple Choice', 'Relevant task characteristics include ', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(57, 1, 'Multiple Choice', 'Topological sort of a Directed Acyclic graph is?', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(58, 1, 'Multiple Choice', 'Threads being block altogether  and being executed in the sets of 32 threads called a ', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(61, 1, 'Multiple Choice', 'When the topological sort of a graph is unique?', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(62, 1, 'Multiple Choice', 'A good mapping does not depends on which following factor ', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(64, 1, 'Multiple Choice', 'Which of the following is not a form of parallelism supported by CUDA?', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(65, 1, 'Multiple Choice', 'The style of parallelism supported on GPUs is best described as ', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(67, 1, 'Multiple Choice', 'Which of the following correctly describes a GPU kernel?', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(68, 1, 'Multiple Choice', 'A code known as grid which runs on GPU consisting of a set of ', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(69, 1, 'Multiple Choice', 'Which of the following is not an parallel algorithm model?', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(70, 1, 'Multiple Choice', 'Having load before the store in a running program order, then interchanging this order, results in a ', 1, '2021-12-06 16:24:31', '2021-12-23 14:23:31', NULL),
(71, 2, 'Multiple Choice', 'Question 1 that you need to answer will be displayed here. So read the question carefully before answering it. Understood?', 5, '2021-12-09 11:52:27', '2021-12-23 14:23:31', NULL),
(72, 2, 'Multiple Choice', 'Question 2 that you need to answer will be displayed here. So read the question carefully before answering it. Understood?', 5, '2021-12-09 11:52:27', '2021-12-23 14:23:31', NULL),
(73, 2, 'Multiple Choice', 'Question 3 that you need to answer will be displayed here. So read the question carefully before answering it. Understood?', 5, '2021-12-09 11:52:27', '2021-12-23 14:23:31', NULL),
(74, 2, 'Multiple Choice', 'Question 4 that you need to answer will be displayed here. So read the question carefully before answering it. Understood?', 5, '2021-12-09 11:52:27', '2021-12-23 14:23:31', NULL),
(75, 2, 'Multiple Choice', 'Question 5 that you need to answer will be displayed here. So read the question carefully before answering it. Understood?', 5, '2021-12-09 11:52:27', '2021-12-23 14:23:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mc_tutorial`
--

CREATE TABLE `mc_tutorial` (
  `mctu_id` int(11) NOT NULL,
  `mctu_mc_id` int(11) NOT NULL,
  `mctu_title` text NOT NULL,
  `mctu_description` longtext NOT NULL,
  `mctu_attachment` varchar(255) NOT NULL,
  `mctu_total_no_of_tutorial` int(100) NOT NULL,
  `mctu_created_date` datetime DEFAULT NULL,
  `mctu_created_by` int(11) NOT NULL,
  `mctu_updated_date` datetime DEFAULT NULL,
  `mctu_deleted_date` datetime DEFAULT NULL,
  `mctu_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_tutorial`
--

INSERT INTO `mc_tutorial` (`mctu_id`, `mctu_mc_id`, `mctu_title`, `mctu_description`, `mctu_attachment`, `mctu_total_no_of_tutorial`, `mctu_created_date`, `mctu_created_by`, `mctu_updated_date`, `mctu_deleted_date`, `mctu_status`) VALUES
(1, 5, 'Tutorial 1', 'Do all.', 'Lab4.pdf', 1, NULL, 8, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `mc_tutorial_duedate`
--

CREATE TABLE `mc_tutorial_duedate` (
  `mctud_id` int(11) NOT NULL,
  `mctud_mc_tutorial_id` int(11) NOT NULL,
  `mctud_duedate_date` date NOT NULL,
  `mctud_duedate_time` time NOT NULL,
  `mctud_duedate_gmt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_tutorial_duedate`
--

INSERT INTO `mc_tutorial_duedate` (`mctud_id`, `mctud_mc_tutorial_id`, `mctud_duedate_date`, `mctud_duedate_time`, `mctud_duedate_gmt`) VALUES
(1, 1, '2021-10-31', '23:59:00', '2021-10-21 15:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `mc_video`
--

CREATE TABLE `mc_video` (
  `mcv_id` int(11) NOT NULL,
  `mcv_mc_id` int(11) NOT NULL,
  `mcv_title` text NOT NULL,
  `mcv_description` longtext NOT NULL,
  `mcv_attachment` varchar(255) DEFAULT NULL,
  `mcv_duration` varchar(255) DEFAULT NULL,
  `mcv_created_date` datetime DEFAULT NULL,
  `mcv_created_by` int(11) DEFAULT NULL,
  `mcv_updated_date` datetime DEFAULT NULL,
  `mcv_deleted_date` datetime DEFAULT NULL,
  `mcv_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_video`
--

INSERT INTO `mc_video` (`mcv_id`, `mcv_mc_id`, `mcv_title`, `mcv_description`, `mcv_attachment`, `mcv_duration`, `mcv_created_date`, `mcv_created_by`, `mcv_updated_date`, `mcv_deleted_date`, `mcv_status`) VALUES
(3, 5, 'Video 2', 'This video is for testing purposes only. It\'s not related or represents to this micro-credential.', 'Sample-video.mp4', '00:00:31', '2021-11-17 04:00:19', NULL, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `microcredential`
--

CREATE TABLE `microcredential` (
  `mc_id` int(11) NOT NULL,
  `mc_title` text NOT NULL,
  `mc_code` varchar(100) DEFAULT NULL,
  `mc_description` longtext NOT NULL,
  `mc_category` tinytext DEFAULT NULL,
  `mc_level` varchar(255) DEFAULT NULL,
  `mc_duration` varchar(100) DEFAULT NULL,
  `mc_fee` varchar(100) DEFAULT NULL,
  `mc_credit_transfer` varchar(10) DEFAULT NULL,
  `mc_total_enrolled` int(11) DEFAULT NULL,
  `mc_created_by` int(11) DEFAULT NULL,
  `mc_owner` int(11) DEFAULT NULL,
  `mc_created_date` datetime DEFAULT current_timestamp(),
  `mc_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mc_deleted_date` datetime DEFAULT NULL,
  `mc_image` text NOT NULL,
  `mc_status` varchar(100) DEFAULT NULL,
  `mc_enrollment_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `microcredential`
--

INSERT INTO `microcredential` (`mc_id`, `mc_title`, `mc_code`, `mc_description`, `mc_category`, `mc_level`, `mc_duration`, `mc_fee`, `mc_credit_transfer`, `mc_total_enrolled`, `mc_created_by`, `mc_owner`, `mc_created_date`, `mc_updated_date`, `mc_deleted_date`, `mc_image`, `mc_status`, `mc_enrollment_date`) VALUES
(1, 'Machine Learning Techniques and Methods', NULL, 'Discover what Machine Learning is and how to formulate Machine Learning problems.', 'Career and Industry Specific Course', '1', '4 weeks', '35000', '2', NULL, NULL, 1, '2021-09-04 08:01:18', '2021-12-27 15:58:19', NULL, 'mc-default.jpg', 'Published', 'choosedate'),
(2, 'Introduction to Networks', NULL, 'You’ll learn the basics of networking, from network fundamentals and technologies to the principles and structure of IP addressing, Ethernet concepts, and network application communications.', 'Career and Industry Specific Course', '2', '10 weeks', '57900', '3', 1, NULL, 1, '2021-09-26 15:21:36', '2021-12-27 08:27:38', NULL, 'mc-default.jpg', 'Published', 'choosedate'),
(3, 'Cryptography', 'SCSR3443', 'Cryptography is an indispensable tool for protecting information in computer systems. In this course you will learn the inner workings of cryptographic systems and how to correctly use them in real-world applications.', 'Soft Skills and Professional Development Course', '1, 2', '12 weeks', '86950', '3', 1, NULL, 3, '2021-09-26 15:25:13', '2021-12-26 16:53:00', NULL, 'cryptography.jpg', 'Published', 'choosedate'),
(4, 'Cloud Computing Security (Microsoft Azure Security Engineer certification)', NULL, 'Cloud computing security or, more simply, cloud security refers to a broad set of policies, technologies, applications, and controls utilized to protect virtualized IP, data, applications, services, and the associated infrastructure of cloud computing.', 'Professional Certification Course', '2, 3', '6 weeks', '75000', '4', 1, NULL, 3, '2021-10-05 02:20:50', '2021-12-27 08:27:38', NULL, 'cloud_computing.jpg', 'Published', 'anytime'),
(5, 'High Performance & Parallel Computing', 'SCSR3223', 'High performance computing/parallel computing is widely used, nowadays, to execute complex\\r\\nsystems and computations of complex problems that need to be solved with minimal time as\\r\\npossible.', 'Career and Industry Specific Course', '2', '12 week', '95000', '3', 3, 19, 4, '2021-10-11 03:45:39', '2021-12-27 08:27:38', NULL, 'hppc.png', 'Published', NULL),
(6, 'CPR, AED, & First Aid', NULL, 'Knowing how to deliver Cardiopulmonary Resuscitation (CPR), AED & First Aid is critical in responding to common emergencies. This course will prepare you to perform CPR, First Aid, and use an automated external defibrillator (AED) in accordance with the l', 'Soft Skills and Professional Development Course', '3', '4 weeks', NULL, NULL, 2, NULL, NULL, '2021-10-04 06:34:09', '2021-12-28 08:39:01', NULL, 'mc-default.jpg', NULL, NULL),
(7, 'Al-Quran dan Ketamadunan', NULL, 'Kursus ini direkabentuk bagi membina kemahiran kesarjanaan, kemahiran berfikir bagi melahirkan warga global. Kesemua kemahiran dibina menerusi aktiviti pembelajaran yang ditetapkan.', 'Soft Skills and Professional Development Course', '1', '4 weeks', NULL, NULL, NULL, NULL, 1, '2021-10-05 02:26:28', '2021-12-28 08:39:01', NULL, 'mc-default.jpg', NULL, NULL),
(8, 'Undang-undang Keluarga', NULL, 'Kursus ini menerangkan asas,ciri dan skop undang-undang Keluarga Islam dan Sivil di Malaysia. Kursus ini juga menjelaskan konsep dalam undang-undang keluarga mengenai perkahwinan, penceraian, kesahtarafan, anak angkat, penjagaan anak, tanggungan nafkah se', 'Soft Skills and Professional Development Course', '1', '4 week', NULL, NULL, NULL, NULL, 4, '2021-10-11 03:50:18', '2021-12-28 08:39:01', NULL, 'mc-default.jpg', NULL, NULL),
(9, 'Programming Technique I', NULL, 'As a fundamental subject, this course equips the students with theory and practice on problem solving techniques by using the structured approach. Students are required to develop programs using C++ programming language, in order to solve simple to moderate problems. The course covers the following: pre-processor directives, constants and variables, data types, input and output statements, control structures: sequential, selection and loop, built-in and user-defined functions, single and two dimensional arrays, file operations, pointers, and structured data types.', 'Career and Industry Specific Course', '2', '4 weeks', '85000', '3', NULL, 18, 4, '2021-10-20 14:38:39', '2021-12-27 08:27:38', NULL, 'mc-default.jpg', NULL, NULL),
(10, 'Programming Technique II', NULL, 'This course presents the concept of object orientation and object-oriented programming (OOP) techniques using the C++ programming language. It equips the students with the theory and practice on problem solving techniques using the object-oriented approach. It emphasizes on the implementation of the OOP concepts including encapsulations, associations and inheritance. At the end of this course, students should be able to apply the OOP techniques to solve problems.', 'Career and Industry Specific Course', '1', '4 weeks', '85000', '3', NULL, NULL, 1, '2021-10-20 14:38:39', '2021-12-27 08:27:38', NULL, 'mc-default.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phd`
--

CREATE TABLE `phd` (
  `phd_id` int(11) NOT NULL,
  `phd_name` text NOT NULL,
  `phd_major` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postcode`
--

CREATE TABLE `postcode` (
  `postcode_id` int(11) NOT NULL,
  `postcode_city_id` int(11) DEFAULT NULL,
  `postcode_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postcode`
--

INSERT INTO `postcode` (`postcode_id`, `postcode_city_id`, `postcode_number`) VALUES
(8, 66, '06300'),
(10, 2, '81300'),
(13, 67, '06400'),
(14, 25, '12345'),
(15, 58, '32412'),
(16, 65, '41324'),
(17, 60, '43242'),
(18, 64, '41324'),
(19, 63, '06581'),
(20, 62, '08567');

-- --------------------------------------------------------

--
-- Table structure for table `review_microcredential`
--

CREATE TABLE `review_microcredential` (
  `rmc_id` int(11) NOT NULL,
  `rmc_mc_id` int(11) NOT NULL,
  `rmc_institution_id` int(11) NOT NULL,
  `rmc_user_request` int(11) NOT NULL,
  `rmc_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_account_dir` varchar(50) NOT NULL,
  `role_created_date` datetime DEFAULT NULL,
  `role_updated_date` datetime DEFAULT NULL,
  `role_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_account_dir`, `role_created_date`, `role_updated_date`, `role_deleted_date`) VALUES
(1, 'Administrator', 'admin', '2021-08-15 06:51:27', NULL, NULL),
(2, 'Upper Management', 'adminUM', '2021-08-15 06:51:27', NULL, NULL),
(3, 'Finance', 'adminF', '2021-08-15 06:54:25', NULL, NULL),
(4, 'Micro-Credential', 'adminMC', '2021-08-15 06:54:25', NULL, NULL),
(5, 'Institution', 'institution', '2021-08-15 06:56:00', NULL, NULL),
(6, 'Industry', 'industry', '2021-08-15 06:56:00', NULL, NULL),
(7, 'Lecturer', 'lecturer', '2021-08-15 06:57:22', NULL, NULL),
(8, 'Expert', 'expert', '2021-08-15 06:57:22', NULL, NULL),
(9, 'Student', 'student', '2021-08-15 06:58:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skill_type`
--

CREATE TABLE `skill_type` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_type`
--

INSERT INTO `skill_type` (`skill_id`, `skill_name`) VALUES
(1, 'Skill: Test 1'),
(2, 'Skill: Test 2'),
(3, 'Skill: Test 3'),
(4, 'Skill: Test 4'),
(5, 'Skill: Test 5');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_country_id` int(11) NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `state_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores state information, based on each countries. ';

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_country_id`, `state_name`, `state_code`) VALUES
(1, 1, 'Johor', 'JHR'),
(2, 1, 'Kedah', 'KDH'),
(3, 1, 'Kelantan', 'KTN'),
(4, 1, 'Kuala Lumpur', 'KUL'),
(5, 1, 'Labuan', 'LBN'),
(6, 1, 'Melaka', 'MLK'),
(7, 1, 'Negeri Sembilan', 'NSN'),
(8, 1, 'Pahang ', 'PHG'),
(9, 1, 'Penang', 'PNG'),
(10, 1, 'Perak', 'PRK'),
(11, 1, 'Perlis', 'PLS'),
(12, 1, 'Putrajaya', 'PJY'),
(13, 1, 'Sabah', 'SBH'),
(14, 1, 'Sarawak', 'SRW'),
(15, 1, 'Selangor', 'SGR'),
(16, 1, 'Terengganu', 'TRG');

-- --------------------------------------------------------

--
-- Table structure for table `student_university`
--

CREATE TABLE `student_university` (
  `su_id` int(11) NOT NULL,
  `su_user_id` int(11) NOT NULL,
  `su_role_id` int(11) NOT NULL,
  `su_city_id` int(11) DEFAULT NULL,
  `su_state_id` int(11) DEFAULT NULL,
  `su_country_id` int(11) DEFAULT NULL,
  `su_institution_id` int(11) NOT NULL,
  `su_fname` text NOT NULL,
  `su_lname` text NOT NULL,
  `su_no_ic` varchar(100) DEFAULT NULL,
  `su_passport_no` varchar(100) DEFAULT NULL,
  `su_matric_no` varchar(10) DEFAULT NULL,
  `su_email` varchar(255) NOT NULL,
  `su_gender` varchar(10) DEFAULT NULL,
  `su_contact_no` varchar(10) DEFAULT NULL,
  `su_dob` date DEFAULT NULL,
  `su_address` varchar(255) DEFAULT NULL,
  `su_nationality` text DEFAULT NULL,
  `su_registered_date` datetime NOT NULL,
  `su_status` varchar(10) NOT NULL,
  `su_cv` varchar(255) DEFAULT NULL,
  `su_profile_pic` text DEFAULT NULL,
  `su_created_date` datetime DEFAULT NULL,
  `su_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `su_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university`
--

INSERT INTO `student_university` (`su_id`, `su_user_id`, `su_role_id`, `su_city_id`, `su_state_id`, `su_country_id`, `su_institution_id`, `su_fname`, `su_lname`, `su_no_ic`, `su_passport_no`, `su_matric_no`, `su_email`, `su_gender`, `su_contact_no`, `su_dob`, `su_address`, `su_nationality`, `su_registered_date`, `su_status`, `su_cv`, `su_profile_pic`, `su_created_date`, `su_updated_date`, `su_deleted_date`) VALUES
(1, 15, 9, 66, 2, 1, 1, 'Naqib', 'Rafiqi', '991121024511', NULL, 'A18CS0116', 'aqibrafeeqy21@gmail.com', 'Male', '0112627868', '1999-11-21', 'No 4, Lrg Al-Ihsan 2, Kg Bkt Larek,', 'Malaysia', '2018-09-03 08:30:40', 'Active', NULL, NULL, '2021-08-29 00:00:00', '2022-01-06 14:24:45', NULL),
(9, 25, 9, 62, 2, 1, 1, 'Halimah', 'Shahadah', '951214021623', '', 'A18CS0116', 'halimah@gmail.com', 'Female', '0113456721', '1995-12-14', 'Rumah', 'Malaysia', '2021-09-27 12:26:40', 'Active', NULL, NULL, NULL, '2021-12-14 16:27:53', NULL),
(10, 27, 9, NULL, NULL, NULL, 1, 'Ahmad', 'Ali', NULL, NULL, NULL, 'ahmad@email.com', NULL, NULL, NULL, NULL, NULL, '2021-10-03 09:33:52', 'Active', NULL, NULL, NULL, '2021-12-14 15:27:58', NULL),
(11, 28, 9, 63, 2, 1, 3, 'First', 'Second', '211125001001', '', 'A21CS1001', 'first_second@gmail.com', 'Male', '0113456721', '2021-11-25', 'Rumah 1, Lorong 1', 'Malaysia', '2021-10-03 11:27:44', 'Active', NULL, NULL, NULL, '2021-12-14 15:27:58', NULL),
(12, 30, 9, NULL, NULL, NULL, 3, 'Hussin', 'Hush', NULL, NULL, NULL, 'hussinhush@gmail.com', NULL, NULL, NULL, NULL, NULL, '2021-10-08 16:20:03', 'Active', NULL, NULL, NULL, '2021-12-14 15:27:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_university_chat_message`
--

CREATE TABLE `student_university_chat_message` (
  `sucm_id` int(11) NOT NULL,
  `sucm_receiver_user_id` int(11) NOT NULL,
  `sucm_sender_user_id` int(11) NOT NULL,
  `sucm_chat_message` text NOT NULL,
  `sucm_timestamp` datetime NOT NULL,
  `sucm_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university_chat_message`
--

INSERT INTO `student_university_chat_message` (`sucm_id`, `sucm_receiver_user_id`, `sucm_sender_user_id`, `sucm_chat_message`, `sucm_timestamp`, `sucm_deleted_date`) VALUES
(120, 19, 15, 'Student: Test 1', '2021-11-10 11:31:18', NULL),
(121, 15, 19, 'Instructor: Test 1', '2021-11-10 11:36:19', NULL),
(122, 15, 19, 'Instructor: Test 2', '2021-11-10 11:36:46', NULL),
(123, 19, 15, 'Student: Test 2', '2021-11-10 11:40:46', NULL),
(124, 15, 19, 'Instructor: Test 3', '2021-11-10 11:40:52', NULL),
(125, 15, 19, 'Instructor: Test 4', '2021-11-10 11:42:19', NULL),
(126, 19, 15, 'Student: Test 3', '2021-11-10 11:43:00', NULL),
(127, 19, 15, 'Student: Test 4', '2021-11-10 11:43:09', NULL),
(128, 15, 19, 'Instructor: Test 5', '2021-11-10 11:43:18', NULL),
(129, 15, 19, 'Instructor: Test 6', '2021-11-10 11:55:52', NULL),
(130, 15, 19, 'Instructor: Test 7', '2021-11-10 12:00:47', NULL),
(131, 15, 19, 'Instructor: Test 8', '2021-11-10 12:04:59', NULL),
(132, 15, 19, 'Instructor: Test 9', '2021-11-10 12:12:00', NULL),
(133, 15, 19, 'Instructor: Test 10', '2021-11-10 12:13:03', NULL),
(134, 15, 19, 'Instructor: Test 11', '2021-11-10 12:17:17', NULL),
(135, 15, 19, 'Instructor: Test 12', '2021-11-10 12:18:19', NULL),
(136, 15, 19, 'Instructor: Test 13', '2021-11-10 12:19:32', NULL),
(137, 15, 19, 'Instructor: Test 14', '2021-11-10 12:20:29', NULL),
(138, 15, 19, 'Instructor: Test 15', '2021-11-10 12:21:12', NULL),
(139, 15, 19, 'Instructor: Test 16', '2021-11-10 12:22:04', NULL),
(140, 15, 19, 'Instructor: Test 17', '2021-11-10 12:23:37', NULL),
(141, 15, 19, 'Instructor: Test 18', '2021-11-10 12:24:37', NULL),
(142, 15, 19, 'Instructor: Test 19', '2021-11-10 14:52:56', NULL),
(143, 15, 18, 'Instructor: Test 1', '2021-11-14 08:17:57', NULL),
(144, 15, 18, 'Instructor: Test 2', '2021-11-14 08:21:04', NULL),
(145, 15, 19, 'Instructor: Test 20', '2021-11-14 08:22:50', NULL),
(146, 15, 18, 'Instructor: Test 3', '2021-11-14 08:24:21', NULL),
(147, 15, 18, 'Instructor: Test 4', '2021-11-14 08:25:31', NULL),
(148, 15, 18, 'Instructor: Test 5', '2021-11-14 08:25:48', NULL),
(149, 15, 26, 'Instructor: Test 1', '2021-11-14 08:28:37', NULL),
(150, 15, 26, 'Instructor: Test 2', '2021-11-14 08:29:06', NULL),
(151, 15, 26, 'Instructor: Test 3', '2021-11-14 09:04:08', NULL),
(152, 15, 18, 'Instructor: Test 6', '2021-11-14 09:05:27', NULL),
(153, 15, 18, 'Instructor: Test 7', '2021-11-14 09:11:13', NULL),
(154, 15, 18, 'Instructor: Test 8', '2021-11-14 09:55:35', NULL),
(155, 18, 15, 'Student: Test 1', '2021-11-14 10:00:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_university_education_degree`
--

CREATE TABLE `student_university_education_degree` (
  `suedeg_id` int(11) NOT NULL,
  `suedeg_student_university_id` int(11) NOT NULL,
  `suedeg_university_id` int(11) NOT NULL,
  `suedeg_degree_id` int(11) NOT NULL,
  `suedeg_field_id` int(11) NOT NULL,
  `suedeg_name` text NOT NULL,
  `suedeg_cgpa` varchar(10) NOT NULL,
  `suedeg_start_date` date NOT NULL,
  `suedeg_end_date` date DEFAULT NULL,
  `suedeg_transcript` varchar(255) NOT NULL,
  `suedeg_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_university_education_diploma`
--

CREATE TABLE `student_university_education_diploma` (
  `suedip_id` int(11) NOT NULL,
  `suedip_student_university_id` int(11) NOT NULL,
  `suedip_university_id` int(11) NOT NULL,
  `suedip_diploma_id` int(11) NOT NULL,
  `suedip_field_id` int(11) NOT NULL,
  `suedip_name` text NOT NULL,
  `suedip_cgpa` varchar(10) NOT NULL,
  `suedip_start_date` date NOT NULL,
  `suedip_end_date` date DEFAULT NULL,
  `suedip_transcript` varchar(255) NOT NULL,
  `suedip_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_university_education_master`
--

CREATE TABLE `student_university_education_master` (
  `suem_id` int(11) NOT NULL,
  `suem_student_university_id` int(11) NOT NULL,
  `suem_university_id` int(11) NOT NULL,
  `suem_master_id` int(11) NOT NULL,
  `suem_field_id` int(11) NOT NULL,
  `suem_name` text NOT NULL,
  `suem_cgpa` varchar(10) NOT NULL,
  `suem_start_date` date NOT NULL,
  `suem_end_date` date DEFAULT NULL,
  `suem_transcript` varchar(255) NOT NULL,
  `suem_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_university_education_phd`
--

CREATE TABLE `student_university_education_phd` (
  `suep_id` int(11) NOT NULL,
  `suep_student_university_id` int(11) NOT NULL,
  `suep_university_id` int(11) NOT NULL,
  `suep_phd_id` int(11) NOT NULL,
  `suep_field_id` int(11) NOT NULL,
  `suep_name` text NOT NULL,
  `suep_start_date` date NOT NULL,
  `suep_end_date` date NOT NULL,
  `suep_transcript` varchar(255) NOT NULL,
  `suep_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `sued_description` longtext NOT NULL,
  `sued_company_name` text NOT NULL,
  `sued_address` text NOT NULL,
  `sued_start_date` date NOT NULL,
  `sued_end_date` date DEFAULT NULL,
  `sued_job_status` enum('Current','Past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university_experience_details`
--

INSERT INTO `student_university_experience_details` (`sued_id`, `sued_student_university_id`, `sued_job_location_city_id`, `sued_job_location_state_id`, `sued_job_location_country_id`, `sued_job_title`, `sued_description`, `sued_company_name`, `sued_address`, `sued_start_date`, `sued_end_date`, `sued_job_status`) VALUES
(5, 1, 2, 1, 1, 'Programmer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mattis a ex eu luctus. Nulla sed enim vitae neque rutrum commodo. Suspendisse vel viverra dui. Suspendisse nec ex eros. Curabitur facilisis elit ex, id tristique enim tempor eu. Donec preti', 'EDESS Sdn Bhd', '201, Level 2, Industry Centre', '2021-08-16', NULL, 'Current'),
(11, 11, 2, 1, 1, 'Programmer', '<p>Currently developing UNICREDS system.</p>', 'EDESS Sdn Bhd', '201, Level 2, Industry Centre', '2021-08-18', NULL, 'Current');

-- --------------------------------------------------------

--
-- Table structure for table `student_university_skill_set`
--

CREATE TABLE `student_university_skill_set` (
  `sus_id` int(11) NOT NULL,
  `sus_student_university_id` int(11) NOT NULL,
  `sus_skill_type_id` int(11) NOT NULL,
  `sus_skill_level` enum('Beginner','Intermediate','Advance') NOT NULL,
  `sus_skill_certificate` varchar(255) DEFAULT NULL,
  `sus_certificate_provider` text DEFAULT NULL,
  `sus_certificate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university_skill_set`
--

INSERT INTO `student_university_skill_set` (`sus_id`, `sus_student_university_id`, `sus_skill_type_id`, `sus_skill_level`, `sus_skill_certificate`, `sus_certificate_provider`, `sus_certificate_date`) VALUES
(1, 1, 1, 'Beginner', 'skill_cert.pdf', 'Skill Provider 1', '2021-11-16'),
(3, 11, 2, 'Intermediate', 'salinanMatricCard.pdf', 'Skill Provider: 2', '2021-11-30'),
(8, 11, 3, 'Advance', NULL, NULL, NULL),
(9, 11, 4, 'Beginner', 'salinanIC.pdf', 'Skill Provider: 4', '2021-11-30'),
(10, 11, 5, 'Intermediate', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_assignment_submission`
--

CREATE TABLE `studuni_course_assignment_submission` (
  `sucas_id` int(11) NOT NULL,
  `sucas_student_university_id` int(11) NOT NULL,
  `sucas_course_assignment_id` int(11) NOT NULL,
  `sucas_attachment` varchar(255) NOT NULL,
  `sucas_grade` int(4) DEFAULT NULL,
  `sucas_submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `sucas_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_project_submission`
--

CREATE TABLE `studuni_course_project_submission` (
  `sucps_id` int(11) NOT NULL,
  `sucps_student_university_id` int(11) NOT NULL,
  `sucps_course_project_id` int(11) NOT NULL,
  `sucps_attachment` varchar(255) NOT NULL,
  `sucps_grade` int(4) DEFAULT NULL,
  `sucps_submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `sucps_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_quiz_result`
--

CREATE TABLE `studuni_course_quiz_result` (
  `sucqrs_id` int(11) NOT NULL,
  `sucqrs_student_university_id` int(11) NOT NULL,
  `sucqrs_course_quiz_id` int(11) NOT NULL,
  `sucqrs_time_taken` time NOT NULL,
  `sucqrs_grade` int(4) DEFAULT NULL,
  `sucqrs_total_question` int(4) NOT NULL,
  `sucqrs_total_answered_question` int(4) NOT NULL,
  `sucqrs_total_correct_answer` int(4) NOT NULL,
  `sucqrs_attempted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_quiz_review`
--

CREATE TABLE `studuni_course_quiz_review` (
  `sucqrv_id` int(11) NOT NULL,
  `sucqrv_student_university_id` int(11) NOT NULL,
  `sucqrv_course_quiz_id` int(11) NOT NULL,
  `sucqrv_course_quiz_question_id` int(11) NOT NULL,
  `sucqrv_answer` text DEFAULT NULL,
  `sucqrv_answer_status` enum('Correct','Incorrect') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store attempted quiz answered question''s answer';

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_test_result`
--

CREATE TABLE `studuni_course_test_result` (
  `suctrs_id` int(11) NOT NULL,
  `suctrs_student_university_id` int(11) NOT NULL,
  `suctrs_course_test_id` int(11) NOT NULL,
  `suctrs_time_taken` time NOT NULL,
  `suctrs_grade` int(4) DEFAULT NULL,
  `suctrs_total_question` int(4) NOT NULL,
  `suctrs_total_answered_question` int(4) NOT NULL,
  `suctrs_total_correct_answer` int(4) NOT NULL,
  `suctrs_attempted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_test_review`
--

CREATE TABLE `studuni_course_test_review` (
  `suctrv_id` int(11) NOT NULL,
  `suctrv_student_university_id` int(11) NOT NULL,
  `suctrv_course_test_id` int(11) NOT NULL,
  `suctrv_course_test_question_id` int(11) NOT NULL,
  `suctrv_answer` text DEFAULT NULL,
  `suctrv_answer_status` enum('Correct','Incorrect') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store attempted test answered question''s answer';

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_tutorial_submission`
--

CREATE TABLE `studuni_course_tutorial_submission` (
  `suctus_id` int(11) NOT NULL,
  `suctus_student_university_id` int(11) NOT NULL,
  `suctus_course_tutorial_id` int(11) NOT NULL,
  `suctus_attachment` varchar(255) NOT NULL,
  `suctus_grade` int(4) DEFAULT NULL,
  `suctus_submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `suctus_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studuni_course_watched_video`
--

CREATE TABLE `studuni_course_watched_video` (
  `sucvw_id` int(11) NOT NULL,
  `sucvw_student_university_id` int(11) NOT NULL,
  `sucvw_course_video_id` int(11) NOT NULL,
  `sucvw_watched_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store all the video(s) that watched by student university';

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_assignment_submission`
--

CREATE TABLE `studuni_mc_assignment_submission` (
  `sumcas_id` int(11) NOT NULL,
  `sumcas_student_university_id` int(11) NOT NULL,
  `sumcas_mc_assignment_id` int(11) NOT NULL,
  `sumcas_attachment` varchar(255) NOT NULL,
  `sumcas_grade` int(4) DEFAULT NULL,
  `sumcas_submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `sumcas_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studuni_mc_assignment_submission`
--

INSERT INTO `studuni_mc_assignment_submission` (`sumcas_id`, `sumcas_student_university_id`, `sumcas_mc_assignment_id`, `sumcas_attachment`, `sumcas_grade`, `sumcas_submitted_date`, `sumcas_deleted_date`) VALUES
(1, 1, 1, 'dasd.pdf', NULL, '2021-12-08 09:56:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_project_submission`
--

CREATE TABLE `studuni_mc_project_submission` (
  `sumcps_id` int(11) NOT NULL,
  `sumcps_student_university_id` int(11) NOT NULL,
  `sumcps_mc_project_id` int(11) NOT NULL,
  `sumcps_attachment` varchar(255) NOT NULL,
  `sumcps_grade` int(4) DEFAULT NULL,
  `sumcps_submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `sumcps_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studuni_mc_project_submission`
--

INSERT INTO `studuni_mc_project_submission` (`sumcps_id`, `sumcps_student_university_id`, `sumcps_mc_project_id`, `sumcps_attachment`, `sumcps_grade`, `sumcps_submitted_date`, `sumcps_deleted_date`) VALUES
(1, 1, 1, 'insurans motor.pdf', NULL, '2021-12-08 09:56:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_quiz_result`
--

CREATE TABLE `studuni_mc_quiz_result` (
  `sumcqrs_id` int(11) NOT NULL,
  `sumcqrs_student_university_id` int(11) NOT NULL,
  `sumcqrs_mc_quiz_id` int(11) NOT NULL,
  `sumcqrs_time_taken` time NOT NULL,
  `sumcqrs_grade` int(4) DEFAULT NULL,
  `sumcqrs_total_question` int(4) NOT NULL,
  `sumcqrs_total_answered_question` int(4) NOT NULL,
  `sumcqrs_total_correct_answer` int(4) NOT NULL,
  `sumcqrs_attempted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studuni_mc_quiz_result`
--

INSERT INTO `studuni_mc_quiz_result` (`sumcqrs_id`, `sumcqrs_student_university_id`, `sumcqrs_mc_quiz_id`, `sumcqrs_time_taken`, `sumcqrs_grade`, `sumcqrs_total_question`, `sumcqrs_total_answered_question`, `sumcqrs_total_correct_answer`, `sumcqrs_attempted_date`) VALUES
(13, 1, 2, '00:10:00', 2, 2, 2, 2, '2021-12-13 09:39:58'),
(14, 1, 1, '00:00:00', 0, 9, 0, 0, '2021-12-23 14:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_quiz_review`
--

CREATE TABLE `studuni_mc_quiz_review` (
  `sumcqrv_id` int(11) NOT NULL,
  `sumcqrv_student_university_id` int(11) NOT NULL,
  `sumcqrv_mc_quiz_id` int(11) NOT NULL,
  `sumcqrv_mc_quiz_question_id` int(11) NOT NULL,
  `sumcqrv_answer` text DEFAULT NULL,
  `sumcqrv_answer_status` enum('Correct','Incorrect') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store attempted quiz answered question''s answer';

--
-- Dumping data for table `studuni_mc_quiz_review`
--

INSERT INTO `studuni_mc_quiz_review` (`sumcqrv_id`, `sumcqrv_student_university_id`, `sumcqrv_mc_quiz_id`, `sumcqrv_mc_quiz_question_id`, `sumcqrv_answer`, `sumcqrv_answer_status`) VALUES
(49, 1, 2, 12, 'Jawapan A', 'Correct'),
(50, 1, 2, 13, 'Jawapan B', 'Correct'),
(51, 1, 1, 1, NULL, NULL),
(52, 1, 1, 2, NULL, NULL),
(53, 1, 1, 3, NULL, NULL),
(54, 1, 1, 4, NULL, NULL),
(55, 1, 1, 6, NULL, NULL),
(56, 1, 1, 7, NULL, NULL),
(57, 1, 1, 8, NULL, NULL),
(58, 1, 1, 9, NULL, NULL),
(59, 1, 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_test_result`
--

CREATE TABLE `studuni_mc_test_result` (
  `sumctrs_id` int(11) NOT NULL,
  `sumctrs_student_university_id` int(11) NOT NULL,
  `sumctrs_mc_test_id` int(11) NOT NULL,
  `sumctrs_time_taken` time NOT NULL,
  `sumctrs_grade` int(4) DEFAULT NULL,
  `sumctrs_total_question` int(4) NOT NULL,
  `sumctrs_total_answered_question` int(4) NOT NULL,
  `sumctrs_total_correct_answer` int(4) NOT NULL,
  `sumctrs_attempted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studuni_mc_test_result`
--

INSERT INTO `studuni_mc_test_result` (`sumctrs_id`, `sumctrs_student_university_id`, `sumctrs_mc_test_id`, `sumctrs_time_taken`, `sumctrs_grade`, `sumctrs_total_question`, `sumctrs_total_answered_question`, `sumctrs_total_correct_answer`, `sumctrs_attempted_date`) VALUES
(5, 1, 2, '00:15:00', 15, 5, 4, 3, '2021-12-13 08:21:59'),
(6, 1, 1, '00:00:19', 0, 26, 4, 0, '2021-12-23 14:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_test_review`
--

CREATE TABLE `studuni_mc_test_review` (
  `sumctrv_id` int(11) NOT NULL,
  `sumctrv_student_university_id` int(11) NOT NULL,
  `sumctrv_mc_test_id` int(11) NOT NULL,
  `sumctrv_mc_test_question_id` int(11) NOT NULL,
  `sumctrv_answer` text DEFAULT NULL,
  `sumctrv_answer_status` enum('Correct','Incorrect') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store attempted test answered question''s answer';

--
-- Dumping data for table `studuni_mc_test_review`
--

INSERT INTO `studuni_mc_test_review` (`sumctrv_id`, `sumctrv_student_university_id`, `sumctrv_mc_test_id`, `sumctrv_mc_test_question_id`, `sumctrv_answer`, `sumctrv_answer_status`) VALUES
(46, 1, 2, 71, 'First Answer', 'Correct'),
(47, 1, 2, 72, 'Third Answer', 'Incorrect'),
(48, 1, 2, 73, NULL, NULL),
(49, 1, 2, 74, 'Fourth Answer', 'Correct'),
(50, 1, 2, 75, 'Third Answer', 'Correct'),
(51, 1, 1, 41, NULL, NULL),
(52, 1, 1, 42, NULL, NULL),
(53, 1, 1, 43, NULL, NULL),
(54, 1, 1, 44, NULL, NULL),
(55, 1, 1, 45, NULL, NULL),
(56, 1, 1, 46, NULL, NULL),
(57, 1, 1, 47, NULL, NULL),
(58, 1, 1, 48, NULL, NULL),
(59, 1, 1, 49, NULL, NULL),
(60, 1, 1, 50, NULL, NULL),
(61, 1, 1, 51, NULL, NULL),
(62, 1, 1, 52, NULL, NULL),
(63, 1, 1, 53, NULL, NULL),
(64, 1, 1, 54, NULL, NULL),
(65, 1, 1, 55, NULL, NULL),
(66, 1, 1, 56, NULL, NULL),
(67, 1, 1, 57, 'Always Not unique', 'Incorrect'),
(68, 1, 1, 58, NULL, NULL),
(69, 1, 1, 61, NULL, NULL),
(70, 1, 1, 62, 'characteristics of inter-task interactions', 'Incorrect'),
(71, 1, 1, 64, NULL, NULL),
(72, 1, 1, 65, NULL, NULL),
(73, 1, 1, 67, 'kernel may contain only host code', 'Incorrect'),
(74, 1, 1, 68, NULL, NULL),
(75, 1, 1, 69, NULL, NULL),
(76, 1, 1, 70, 'Destination registers', 'Incorrect');

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_tutorial_submission`
--

CREATE TABLE `studuni_mc_tutorial_submission` (
  `sumctus_id` int(11) NOT NULL,
  `sumctus_student_university_id` int(11) NOT NULL,
  `sumctus_mc_tutorial_id` int(11) NOT NULL,
  `sumctus_attachment` varchar(255) NOT NULL,
  `sumctus_grade` int(4) DEFAULT NULL,
  `sumctus_submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `sumctus_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studuni_mc_tutorial_submission`
--

INSERT INTO `studuni_mc_tutorial_submission` (`sumctus_id`, `sumctus_student_university_id`, `sumctus_mc_tutorial_id`, `sumctus_attachment`, `sumctus_grade`, `sumctus_submitted_date`, `sumctus_deleted_date`) VALUES
(18, 1, 1, 'ic.pdf', NULL, '2021-12-08 09:55:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studuni_mc_watched_video`
--

CREATE TABLE `studuni_mc_watched_video` (
  `sumcvw_id` int(11) NOT NULL,
  `sumcvw_student_university_id` int(11) NOT NULL,
  `sumcvw_mc_video_id` int(11) NOT NULL,
  `sumcvw_watched_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store all the video(s) that watched by student university';

--
-- Dumping data for table `studuni_mc_watched_video`
--

INSERT INTO `studuni_mc_watched_video` (`sumcvw_id`, `sumcvw_student_university_id`, `sumcvw_mc_video_id`, `sumcvw_watched_date`) VALUES
(14, 1, 3, '2021-12-08 09:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `university_id` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `university_website` varchar(100) NOT NULL,
  `university_initial` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores list of universities all over the world. ';

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`university_id`, `university_name`, `university_website`, `university_initial`) VALUES
(1, 'Advance Tertiary College', 'http://www.atc2u.com/', NULL),
(2, 'Aimst University', 'http://www.aimst.edu.my/', NULL),
(3, 'Al-Bukhari International University', 'http://www.aiu.edu.my/', NULL),
(4, 'Allianze College of Medical Sciences (ACMS)', 'http://www.acms.edu.my/', NULL),
(5, 'Al Madinah International University', 'http://www.mediu.edu.my/', NULL),
(6, 'Asia E University', 'http://www.aeu.edu.my/', NULL),
(7, 'Asia Pacific Institute of Information Technology (APIIT)', 'http://www.apiit.edu.my/', NULL),
(8, 'Baitulmal Management Institute (IPB)', 'http://www.ipb.edu.my/', NULL),
(9, 'Binary University College of Managemant & Entrepreneurship', 'http://www.binary.edu.my/', NULL),
(10, 'Brickfields Asia College', 'http://www.bac.edu.my/', NULL),
(11, 'British Malaysian Institute', 'http://www.bmi.edu.my/', NULL),
(12, 'City University College of Science and Technology', 'http://www.city.edu.my/', NULL),
(13, 'Curtin University of Technology, Sarawak Campus', 'http://www.curtin.edu.my/', NULL),
(14, 'Cyberjaya University College of Medical Science', 'http://www.cybermed.edu.my/', NULL),
(15, 'Darul Hikmah Islamic College', 'http://www.hikmah.edu.my/', NULL),
(16, 'Darul Naim College of Technology', 'http://www.ktd.edu.my/', NULL),
(17, 'Darul Quran Islamic College University', 'http://kudqi.net.my/', NULL),
(18, 'Darul Takzim Institute of Technology', 'http://www.instedt.edu.my/', NULL),
(19, 'Darul Ulum Islamic College', 'http://kidu-darululum.blogspot.com/', NULL),
(20, 'FTMS Global Academy', 'http://www.ftmsglobal.com/', NULL),
(21, 'Help University College', 'http://www.help.edu.my/', NULL),
(22, 'Iact College', 'http://www.iact.edu.my/', NULL),
(23, 'Institute of Teachers Education, Batu Lintang', 'http://www.ipbl.edu.my/', NULL),
(24, 'Institute of Teachers Education, Darul Aman', 'http://www.ipda.edu.my/', NULL),
(25, 'Institute of Teachers Education, Dato\' Razali Ismail ', 'http://www.ipgmkdri.edu.my/', NULL),
(26, 'Institute of Teachers Education, Ilmu Khas', 'http://www.ipik.edu.my/', NULL),
(27, 'Institute of Teachers Education, Ipoh', 'http://www.ipip.edu.my/', NULL),
(28, 'Institute of Teachers Education, Islamic Education', 'http://www.ipislam.edu.my/', NULL),
(29, 'Institute of Teachers Education, Keningau', 'http://www.ipks.edu.my/', NULL),
(30, 'Institute of Teachers Education, Kent', 'http://www.ipkent.edu.my/', NULL),
(31, 'Institute of Teachers Education, Kota Bharu', 'http://www.ipgkkb.edu.my/', NULL),
(32, 'Institute of Teachers Education, Malay Language', 'http://www.ipbmm.edu.my/', NULL),
(33, 'Institute of Teachers Education, Melaka ', 'http://www.ippm.edu.my/', NULL),
(34, 'Institute of Teachers Education, Penang', 'http://www.i4p.edu.my/', NULL),
(35, 'Institute of Teachers Education, Perlis', 'http://www.ipgperlis.edu.my/', NULL),
(36, 'Institute of Teachers Education, Perlis', 'http://www.ipgperlis.edu.my/', NULL),
(37, 'Institute of Teachers Education, Raja Melewar', 'http://www.iprm.edu.my/', NULL),
(38, 'Institute of Teachers Education, Rajang', 'http://www.ipgkrajang.edu.my/', NULL),
(39, 'Institute of Teachers Education, Sarawak', 'http://www.ipsmiri.edu.my/', NULL),
(40, 'Institute of Teachers Education, Sultan Abdul Halim', 'http://www.ipsah.edu.my/', NULL),
(41, 'Institute of Teachers Education, Sultan Mizan', 'http://www.ipgmksm.edu.my/', NULL),
(42, 'Institute of Teachers Education, Tawau', 'http://www.ipgmtawau.edu.my/', NULL),
(43, 'Institute of Teachers Education, Technical Education ', 'http://www.ipteknik.edu.my/', NULL),
(44, 'Institute of Teachers Education, Temenggong Ibrahim', 'http://www.ipgkti.edu.my/', NULL),
(45, 'Institute of Teachers Education, Tengku Ampuan Afzan', 'http://www.iptaa.edu.my/', NULL),
(46, 'Institute of Teachers Education, Tuanku Bainun', 'http://www.iptb.edu.my/', NULL),
(47, 'Institute of Teachers Education, Tun Hussein Onn', 'http://www.iptho.edu.my/', NULL),
(48, 'Institut Prima Bestari - Pine Academy ', 'http://www.pine.edu.my/', NULL),
(49, 'International Islamic College', 'http://www.iic.edu.my/', NULL),
(50, 'International Islamic College of Penang', 'http://www.kitab.edu.my/', NULL),
(51, 'International Islamic University', 'http://www.iiu.edu.my/', NULL),
(52, 'International Medical University', 'http://www.imu.edu.my/', NULL),
(53, 'International University College of Nursing (IUCN)', 'http://www.iucn.edu.my/', NULL),
(54, 'International University College of Technology Twintech (IUCTT)', 'http://www.iuctt.edu.my/', NULL),
(55, 'Islamic College for Sciences and Technologies', 'http://www.kist.edu.my/', NULL),
(56, 'Johore Bharu Primeir Polytechnic', 'http://www.polijb.edu.my/', NULL),
(57, 'KBU International College', 'http://www.kbu.edu.my/', NULL),
(58, 'KDU College Sdn Bhd', 'http://www.kdu.edu.my/', NULL),
(59, 'Kolej Universiti Insaniah', 'http://www.kuin.edu.my/', NULL),
(60, 'Kota Bharu Polytechnic', 'http://www.pkb.edu.my/', NULL),
(61, 'Kota Kinabalu Polytechnic', 'http://www.pkksabah.edu.my/', NULL),
(62, 'Kuala Lumpur Infrastructure University College', 'http://www.kliuc.edu.my/', NULL),
(63, 'Kuala Lumpur Metropolitan University', 'http://www.klmu.edu.my/', NULL),
(64, 'Kuala Terengganu City Polytechnic', 'http://www.pkkt.edu.my/', NULL),
(65, 'Kuching Polytechnic', 'http://www.poliku.edu.my/', NULL),
(66, 'Limkokwing University College of Creative Technology', 'http://www.limkokwing.edu.my/', NULL),
(67, 'Linton University College', 'http://www.linton.edu.my/', NULL),
(68, 'Mahsa University College for Health and Medical Science', 'http://www.mahsa.edu.my/', NULL),
(69, 'Malaysia University of Science and Technology (MUST)', 'http://www.must.edu.my/', NULL),
(70, 'Management and Science University', 'http://www.msu.edu.my/', NULL),
(71, 'Mara Poly-Tech College', 'http://www.kptm.edu.my/', NULL),
(72, 'Melaka City Polytechnic', 'http://www.polimelaka.edu.my/', NULL),
(73, 'Melaka Islamic University College', 'http://www.kuim.edu.my/', NULL),
(74, 'Merlimau Polytechnic', 'http://www.pmm.edu.my/', NULL),
(75, 'Monash University, Malaysia Campus', 'http://www.monash.edu.my/', NULL),
(76, 'Muadzam Shah Polytechnic', 'http://www.polimuadzam.edu.my/', NULL),
(77, 'Multimedia University', 'http://www.mmu.edu.my/', NULL),
(78, 'Murni Nursing College', 'http://www.murni.edu.my/', NULL),
(79, 'Newcastle University, Medicine Malaysia ', 'http://numed.ncl.ac.uk/', NULL),
(80, 'Nilai University College', 'http://www.nilai.edu.my/', NULL),
(81, 'Olympia College', 'http://www.olympia.edu.my/', NULL),
(82, 'Open University Malaysia', 'http://www.oum.edu.my/', NULL),
(83, 'Penang International Dental College', 'http://www.pidc.edu.my/', NULL),
(84, 'Perak Islamic College', 'http://www.kiperak.edu.my/', NULL),
(85, 'Perdana University', 'http://www.perdanauniversity.edu.my/', NULL),
(86, 'Perlis Islamic Higher Learning Institute', 'http://www.iptips.edu.my/', NULL),
(87, 'Petronas Technology University', 'http://www.utp.edu.my/', NULL),
(88, 'Port Dickson Polytechnic', 'http://www.polipd.edu.my/', NULL),
(89, 'Primier International University Perak', 'http://www.piup.edu.my/', NULL),
(90, 'PTPL College', 'http://www.ptpl.edu.my/', NULL),
(91, 'PTPL College', 'http://www.ptpl.edu.my/', NULL),
(92, 'Raffles University', 'http://www.raffles-university.edu.my/', NULL),
(93, 'Saito College', 'http://www.saito.edu.my/', NULL),
(94, 'Seberang Perai Polytechnic', 'http://www.psp.edu.my/', NULL),
(95, 'Segi University College', 'http://www.segi.edu.my/', NULL),
(96, 'Selangor Islamic University College', 'http://www.kuis.edu.my/', NULL),
(97, 'Shahputra College', 'http://www.kolejshahputra.edu.my/', NULL),
(98, 'Sultan Abdul Halim Muadzam Shah Polytechnic', 'http://www.polimas.edu.my/', NULL),
(99, 'Sultanah Bahiyah Polytechnic', 'http://www.ptsb.edu.my/', NULL),
(100, 'Sultan Ahmad Shah Islamic College', 'http://www.kipsas.edu.my/', NULL),
(101, 'Sultan Azlan Shah Polytechnic ', 'http://www.psas.edu.my/', NULL),
(102, 'Sultan Haji Ahmad Shah Polytechnic', 'http://www.polisas.edu.my/', NULL),
(103, 'Sultan Idris Shah Polytechnic', 'http://www.psis.edu.my/', NULL),
(104, 'Sultan Ismail Petra International Islamic College', 'http://www.kias.edu.my/', NULL),
(105, 'Sultan Mizan Zainal Abidin Polytechnic', 'http://www.psmza.edu.my/', NULL),
(106, 'Sultan Salahuddin Abdul Aziz Shah Polytechnic', 'http://www.psa.edu.my/', NULL),
(107, 'Sunway University College', 'http://www.sunway.edu.my/', NULL),
(108, 'Swinburne University of Technology, Sarawak Campus', 'http://www.swinburne.edu.my/', NULL),
(109, 'Taj International College', 'http://www.taj.edu.my/', NULL),
(110, 'Taylor\'s University College', 'http://www.taylors.edu.my/', NULL),
(111, 'TPM College', 'http://www.tpmcollege.edu.my/', NULL),
(112, 'Tunku Abdul Rahman Chinese College', 'http://www.tarc.edu.my/', NULL),
(113, 'Tunku Abdul Rahman University (Chinese University)', 'http://www.utar.edu.my/', NULL),
(114, 'Tunku Syed Sirajuddin Polytechnic', 'http://www.ptss.edu.my/', NULL),
(115, 'UCSI University', 'http://www.ucsi.edu.my/', NULL),
(116, 'Ungku Omar Premier Polytechnic', 'http://www.puo.edu.my/', NULL),
(117, 'Universiti Darul Iman', 'http://www.udm.edu.my/', NULL),
(118, 'Universiti Industri Selangor', 'http://www.unisel.edu.my/', NULL),
(119, 'Universiti Kebangsaan Malaysia', 'http://www.ukm.my/', NULL),
(120, 'Universiti Kuala Lumpur', 'http://www.unikl.edu.my/', NULL),
(121, 'Universiti Kuala Lumpur Malaysian Institute of Information Technology (MIIT)', 'http://miit.unikl.edu.my/', NULL),
(122, 'Universiti Malaya', 'http://www.um.edu.my/', NULL),
(123, 'Universiti Malaysia Kelantan', 'http://www.umk.edu.my/', NULL),
(124, 'Universiti Malaysia Perlis', 'http://www.unimap.edu.my/', NULL),
(125, 'Universiti Malaysia Sabah', 'http://www.ums.edu.my/', NULL),
(126, 'Universiti Malaysia Sarawak', 'http://www.unimas.my/', NULL),
(127, 'Universiti Malaysia Terengganu', 'http://www.umt.edu.my/', NULL),
(128, 'Universiti Pendidikan Sultan Idris', 'http://www.upsi.edu.my/', NULL),
(129, 'Universiti Putra Malaysia', 'http://www.upm.edu.my/', NULL),
(130, 'Universiti Sains Malaysia', 'http://www.usm.my/', NULL),
(131, 'Universiti Sultan Zainal Abidin', 'http://www.unisza.edu.my/', NULL),
(132, 'Universiti Teknikal Malaysia Melaka', 'http://www.utem.edu.my/', NULL),
(133, 'Universiti Teknologi Malaysia', 'http://www.utm.my/', NULL),
(134, 'Universiti Teknologi Mara', 'http://www.uitm.edu.my/', NULL),
(135, 'Universiti Teknologi Petronas', 'http://www.utp.edu.my/', NULL),
(136, 'Universiti Tenaga Nasional', 'http://www.uniten.edu.my/', NULL),
(137, 'Universiti Tun Abdul Razak', 'http://www.unitar.edu.my/', NULL),
(138, 'Universiti Tun Hussein Onn Malaysia', 'http://www.uthm.edu.my/', NULL),
(139, 'Universiti Tunku Abdul Rahman', 'http://www.utar.edu.my/', NULL),
(140, 'Universiti Utara Malaysia', 'http://www.uum.edu.my/', NULL),
(141, 'University College of Technology & Innovation (UCTI)', 'http://www.ucti.edu.my/', NULL),
(142, 'University Malaysia Pahang', 'http://www.ump.edu.my/', NULL),
(143, 'University of Management and Technology ', 'http://www.umtech.edu.my/', NULL),
(144, 'University of Nottingham, Malaysia Campus', 'http://www.nottingham.edu.my/', NULL),
(145, 'University Tun Abdul Razak', 'http://www.unirazak.edu.my/', NULL),
(146, 'Wawasan Open University', 'http://www.wou.edu.my/', NULL),
(147, 'West Minster International College', 'http://www.westminster.edu.my/', NULL),
(148, 'YPC-iTWEB College', 'http://www.kolejypc.edu.my/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_created_date` datetime DEFAULT NULL,
  `user_updated_date` datetime DEFAULT NULL,
  `user_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_role_id`, `user_created_date`, `user_updated_date`, `user_deleted_date`) VALUES
(1, 'thaqif1@gmail.com', '$2y$10$C/RLwlA0RXeZfhok.QBZ5uYE6QNrEVzDdD5926T0DRyDwKBnkiLvG', 1, '2021-08-22 10:22:29', NULL, NULL),
(4, 'aliff@gmail.com', '$2y$10$QDJ.OMSYn52rLo2VFb.yDuWbnk.wjKDQsiLrE.spERh7HaaD4c6Dm', 4, '2021-08-22 14:30:04', '2021-08-22 16:40:42', NULL),
(5, 'hakim@yahoo.com', '$2y$10$bmD1cUVdlIvMujkR39ISW.ORk2xiA.B3xIUQueat9LWtYevQg4EjC', 2, '2021-08-22 14:30:29', NULL, NULL),
(6, 'farhan@gmail.com', '$2y$10$fqi4FPy3GYkhMzch28DteuyRjmkBcfxXqLEtzg1/n0hWnZM5Ty8CO', 3, '2021-08-22 14:30:41', NULL, NULL),
(8, 'corporate@utm.my', '$2y$10$lQsBw10R4Sm6cBuJbBWLh.cJR33ME1C2kqlkY4AZKumL0JM4rKqEa', 5, '2021-08-24 14:46:41', '2021-08-24 14:47:07', NULL),
(14, 'edess@yahoo.com', '$2y$10$qsIr9Ckhj2mXmhvcFEwC..6IiOZ8TZmKM1kDUSof71hZ7GR8e0M2O', 6, '2021-08-25 10:48:50', NULL, NULL),
(15, 'aqibrafeeqy21@gmail.com', '$2y$10$RTPLyhTi9PmMb7pMokcBCO7jxXwagT6qoidzTGRZqJdbm4Hs04tam', 9, '2021-09-04 15:21:01', NULL, NULL),
(16, 'pro@uthm.edu.my', 'uthm', 5, '2021-09-07 03:31:15', '2021-09-07 03:31:15', NULL),
(17, 'servicedesk@uum.edu.my', 'uum', 5, '2021-09-07 03:36:43', '2021-09-07 03:36:43', NULL),
(18, 'alibabajones@gmail.com', 'alibabajones', 7, '2021-09-08 08:33:05', '2021-09-08 08:33:05', NULL),
(19, 'wanwarren@gmail.com', 'wanwarren', 8, '2021-09-08 08:33:36', '2021-09-08 08:33:36', NULL),
(25, 'halimah@gmail.com', '$2y$10$SofriTQxN01dsUpnogN/Eebuqeqb6lyYuscndPF9kDuIYnkYSBuvy', 9, '2021-09-27 12:26:40', NULL, NULL),
(26, 'anitaanette@gmail.com', 'anita', 7, '2021-09-27 10:38:59', '2021-09-27 10:38:59', NULL),
(27, 'ahmad@email.com', '$2y$10$xUELIFFWi0OWxJ.vU4r/FONhjkOoQmH.2FFEKBJXpMwO6L9a9wQ1u', 9, '2021-10-03 09:33:52', NULL, NULL),
(28, 'first_second@gmail.com', '$2y$10$k/qWKYpp0g1bSKsalonkn.cor6HDLvtzQDKH59vCZuEKphML9voAe', 9, '2021-10-03 11:27:44', NULL, NULL),
(29, 'admin@gmail.com', '$2y$10$NgxjryeDgG0rfNgHRMzHsu.9sGmetRXsfZD5yfrRjfhXd71JhEb96', 1, '2021-10-06 02:57:51', '2021-10-06 02:57:51', NULL),
(30, 'hussinhush@gmail.com', '$2y$10$QhrxX1k3lOqbVnnrw5jdM.FS3crSTIV.djSGCBPK.Y7huBKmvmxty', 9, '2021-10-08 16:20:03', NULL, NULL),
(31, 'instructor@email.com', '$2y$10$R3ul/fFu4Kw2222mqZ1UUeqOZhyc0jRhOthOnKZoT7OseweIOrpPy', 7, '2021-11-09 01:11:11', NULL, NULL),
(32, 'industry@email.com', '$2y$10$05TPc8kZTWXteGeXcR832eAdp5epVjdD8uamQiVT3ZALEXVFArzl.', 6, '2021-11-09 01:15:28', NULL, NULL),
(33, 'institution@email.com', '$2y$10$9WrdamuEpReNgnQBWUi7Pe9dAg1qDxOBPi39ZXoMViGAMpokk0Sde', 5, '2021-11-09 01:16:18', NULL, NULL),
(34, 'titan', 'natit', 6, '2021-12-30 07:57:01', NULL, NULL),
(35, 'lemon_sky', 'yks_nomel', 6, '2021-12-30 08:04:29', NULL, NULL),
(36, 'aeon', 'noea', 6, '2021-12-30 08:09:18', NULL, NULL),
(37, 'mind_berry', 'yrreb_dnim', 6, '2022-01-02 01:44:54', NULL, NULL),
(38, 'zinnia', 'ainniz', 6, '2022-01-02 01:57:01', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_programme`
--
ALTER TABLE `academic_programme`
  ADD PRIMARY KEY (`ap_id`),
  ADD KEY `FK_ap_field` (`ap_field_id`),
  ADD KEY `FK_ap_created` (`ap_created_by`);

--
-- Indexes for table `academic_programme_session`
--
ALTER TABLE `academic_programme_session`
  ADD PRIMARY KEY (`aps_id`),
  ADD KEY `FK_aps_academic_programme` (`aps_academic_programme_id`);

--
-- Indexes for table `academic_programme_student_uni_application`
--
ALTER TABLE `academic_programme_student_uni_application`
  ADD PRIMARY KEY (`apsua_id`),
  ADD KEY `FK_apsua_ap` (`apsua_academic_programme_id`),
  ADD KEY `FK_apsua_student_university` (`apsua_request_student_university_id`),
  ADD KEY `FK_apsua_accepted` (`apsua_accepted_by`),
  ADD KEY `FK_apsua_rejected` (`apsua_rejected_by`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK_admin_user` (`admin_user_id`),
  ADD KEY `FK_admin_role` (`admin_role_id`);

--
-- Indexes for table `admin_management`
--
ALTER TABLE `admin_management`
  ADD PRIMARY KEY (`am_id`),
  ADD KEY `FK_am_admin` (`am_admin_id`);

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`badge_id`),
  ADD KEY `FK_badge_university` (`badge_university_id`),
  ADD KEY `FK_badge_type` (`badge_type_id`),
  ADD KEY `FK_badge_createdby_user` (`badge_created_by`);

--
-- Indexes for table `badge_type`
--
ALTER TABLE `badge_type`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_student` (`userId`) USING BTREE,
  ADD KEY `token` (`token`);

--
-- Indexes for table `cart_course`
--
ALTER TABLE `cart_course`
  ADD PRIMARY KEY (`cart_id`,`course_id`) USING BTREE,
  ADD KEY `FK_cart_item_cart` (`cart_id`) USING BTREE,
  ADD KEY `productId` (`course_id`) USING BTREE;

--
-- Indexes for table `cart_mc`
--
ALTER TABLE `cart_mc`
  ADD PRIMARY KEY (`cart_id`,`sub_id`) USING BTREE,
  ADD KEY `FK_cart_item_cart` (`cart_id`),
  ADD KEY `productId` (`sub_id`) USING BTREE;

--
-- Indexes for table `cart_order`
--
ALTER TABLE `cart_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_cart_order_user` (`user_id`);

--
-- Indexes for table `cart_order_course`
--
ALTER TABLE `cart_order_course`
  ADD PRIMARY KEY (`order_id`,`course_id`) USING BTREE,
  ADD KEY `FK_cart_item_cart` (`order_id`) USING BTREE,
  ADD KEY `productId` (`course_id`) USING BTREE;

--
-- Indexes for table `cart_order_mc`
--
ALTER TABLE `cart_order_mc`
  ADD PRIMARY KEY (`order_id`,`sub_id`) USING BTREE,
  ADD KEY `productId` (`sub_id`) USING BTREE,
  ADD KEY `FK_cart_item_cart` (`order_id`) USING BTREE;

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_id`),
  ADD KEY `FK_certificate_ct` (`certificate_type_id`),
  ADD KEY `FK_certificate_university` (`certificate_university_id`),
  ADD KEY `FK_certificate_createdby_user` (`certificate_created_by`);

--
-- Indexes for table `certificate_type`
--
ALTER TABLE `certificate_type`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `FK_city_state` (`city_state_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`cm_id`,`order_id`) USING BTREE,
  ADD KEY `FK_commission_institution` (`institution_id`),
  ADD KEY `FK_cart_order` (`order_id`);

--
-- Indexes for table `commission_course`
--
ALTER TABLE `commission_course`
  ADD KEY `FK_commission_course_course` (`course_id`),
  ADD KEY `FK_commission_course_commission` (`cm_id`);

--
-- Indexes for table `commission_mc`
--
ALTER TABLE `commission_mc`
  ADD KEY `FK_commission_mc_commission` (`cm_id`),
  ADD KEY `FK_commission_mc_microcredential` (`mc_id`);

--
-- Indexes for table `commission_rate`
--
ALTER TABLE `commission_rate`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`committee_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `FK_course_owner` (`course_owner`),
  ADD KEY `FK_course_user` (`course_created_by`);

--
-- Indexes for table `course_assignment`
--
ALTER TABLE `course_assignment`
  ADD PRIMARY KEY (`ca_id`),
  ADD KEY `FK_ca_course` (`ca_course_id`),
  ADD KEY `FK_ca_createdby` (`ca_created_by`);

--
-- Indexes for table `course_assignment_duedate`
--
ALTER TABLE `course_assignment_duedate`
  ADD PRIMARY KEY (`cad_id`),
  ADD KEY `FK_cad_ca` (`cad_course_assignment_id`);

--
-- Indexes for table `course_enrolment_session`
--
ALTER TABLE `course_enrolment_session`
  ADD PRIMARY KEY (`ces_id`),
  ADD KEY `FK_ces_course` (`ces_course_id`);

--
-- Indexes for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD PRIMARY KEY (`ci_id`),
  ADD KEY `FK_ci_course` (`ci_course_id`),
  ADD KEY `FK_ci_user` (`ci_user_id`);

--
-- Indexes for table `course_learning_details`
--
ALTER TABLE `course_learning_details`
  ADD PRIMARY KEY (`cld_id`),
  ADD KEY `FK_cld_course` (`cld_course_id`);

--
-- Indexes for table `course_notes`
--
ALTER TABLE `course_notes`
  ADD PRIMARY KEY (`cn_id`),
  ADD KEY `FK_cn_course` (`cn_course_id`),
  ADD KEY `FK_cn_user` (`cn_created_by`);

--
-- Indexes for table `course_project`
--
ALTER TABLE `course_project`
  ADD PRIMARY KEY (`cp_id`),
  ADD KEY `FK_cp_course` (`cp_course_id`),
  ADD KEY `FK_cp_createdby` (`cp_created_by`);

--
-- Indexes for table `course_project_duedate`
--
ALTER TABLE `course_project_duedate`
  ADD PRIMARY KEY (`cpd_id`),
  ADD KEY `FK_cpd_cp` (`cpd_course_project_id`);

--
-- Indexes for table `course_quiz`
--
ALTER TABLE `course_quiz`
  ADD PRIMARY KEY (`cq_id`),
  ADD KEY `FK_cq_createdby` (`cq_created_by`),
  ADD KEY `FK_cq_course` (`cq_course_id`);

--
-- Indexes for table `course_quiz_answer`
--
ALTER TABLE `course_quiz_answer`
  ADD PRIMARY KEY (`cqa_id`),
  ADD KEY `FK_cqa_cqq` (`cqa_course_quiz_question_id`);

--
-- Indexes for table `course_quiz_question`
--
ALTER TABLE `course_quiz_question`
  ADD PRIMARY KEY (`cqq_id`),
  ADD KEY `FK_cqq_cq` (`cqq_course_quiz_id`);

--
-- Indexes for table `course_slide`
--
ALTER TABLE `course_slide`
  ADD PRIMARY KEY (`cs_id`),
  ADD KEY `FK_cs_course` (`cs_course_id`),
  ADD KEY `FK_cs_createdby` (`cs_created_by`);

--
-- Indexes for table `course_test`
--
ALTER TABLE `course_test`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `FK_ct_createdby` (`ct_created_by`),
  ADD KEY `FK_ct_course` (`ct_course_id`);

--
-- Indexes for table `course_test_answer`
--
ALTER TABLE `course_test_answer`
  ADD PRIMARY KEY (`cta_id`),
  ADD KEY `FK_cta_ctq` (`cta_course_test_question_id`);

--
-- Indexes for table `course_test_question`
--
ALTER TABLE `course_test_question`
  ADD PRIMARY KEY (`ctq_id`),
  ADD KEY `FK_ctq_ct` (`ctq_course_test_id`);

--
-- Indexes for table `course_tutorial`
--
ALTER TABLE `course_tutorial`
  ADD PRIMARY KEY (`ctu_id`),
  ADD KEY `FK_ctu_createdby` (`ctu_created_by`),
  ADD KEY `FK_ctu_course` (`ctu_course_id`);

--
-- Indexes for table `course_tutorial_duedate`
--
ALTER TABLE `course_tutorial_duedate`
  ADD PRIMARY KEY (`ctud_id`),
  ADD KEY `FK_mctud_mctutorial` (`ctud_course_tutorial_id`);

--
-- Indexes for table `course_video`
--
ALTER TABLE `course_video`
  ADD PRIMARY KEY (`cv_id`),
  ADD KEY `FK_cv_course` (`cv_course_id`),
  ADD KEY `FK_cv_createdby` (`cv_created_by`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `diploma`
--
ALTER TABLE `diploma`
  ADD PRIMARY KEY (`diploma_id`);

--
-- Indexes for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  ADD PRIMARY KEY (`ecsu_id`),
  ADD KEY `FK_ecsu_student_university` (`ecsu_student_university_id`),
  ADD KEY `FK_ecsu_course` (`ecsu_course_id`),
  ADD KEY `FK_ecsu_certificate` (`ecsu_certificate_id`);

--
-- Indexes for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  ADD PRIMARY KEY (`emcsu_id`),
  ADD KEY `FK_emcsu_student_university` (`emcsu_student_university_id`),
  ADD KEY `FK_emcsu_mc` (`emcsu_mc_id`),
  ADD KEY `FK_emcsu_certificate` (`emcsu_certificate_id`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`expert_id`),
  ADD KEY `FK_expert_user` (`expert_user_id`),
  ADD KEY `FK_expert_city` (`expert_city_id`),
  ADD KEY `FK_expert_state` (`expert_state_id`),
  ADD KEY `FK_expert_country` (`expert_country_id`);

--
-- Indexes for table `expert_education_degree`
--
ALTER TABLE `expert_education_degree`
  ADD PRIMARY KEY (`exedeg_id`),
  ADD KEY `FK_exedeg_expert` (`exedeg_expert_id`),
  ADD KEY `FK_exedeg_university` (`exedeg_university_id`),
  ADD KEY `FK_exedeg_degree` (`exedeg_degree_id`),
  ADD KEY `FK_exedeg_field` (`exedeg_field_id`);

--
-- Indexes for table `expert_education_diploma`
--
ALTER TABLE `expert_education_diploma`
  ADD PRIMARY KEY (`exedip_id`),
  ADD KEY `FK_exedip_expert` (`exedip_expert_id`),
  ADD KEY `FK_exedip_university` (`exedip_university_id`),
  ADD KEY `FK_exedip_diploma` (`exedip_diploma_id`),
  ADD KEY `FK_exedip_field` (`exedip_field_id`);

--
-- Indexes for table `expert_education_master`
--
ALTER TABLE `expert_education_master`
  ADD PRIMARY KEY (`exem_id`),
  ADD KEY `FK_exem_expert` (`exem_expert_id`),
  ADD KEY `FK_exem_university` (`exem_university_id`),
  ADD KEY `FK_exem_master` (`exem_master_id`),
  ADD KEY `FK_exem_field` (`exem_field_id`);

--
-- Indexes for table `expert_education_phd`
--
ALTER TABLE `expert_education_phd`
  ADD PRIMARY KEY (`exep_id`),
  ADD KEY `FK_exep_expert` (`exep_expert_id`),
  ADD KEY `FK_exep_university` (`exep_university_id`),
  ADD KEY `FK_exep_phd` (`exep_phd_id`),
  ADD KEY `FK_exep_field` (`exep_field_id`);

--
-- Indexes for table `expert_experience_details`
--
ALTER TABLE `expert_experience_details`
  ADD PRIMARY KEY (`exed_id`),
  ADD KEY `FK_exed_expert` (`exed_expert_id`),
  ADD KEY `FK_exed_job_city` (`exed_job_location_city_id`),
  ADD KEY `FK_exed_job_state` (`exed_job_location_state_id`),
  ADD KEY `FK_exed_job_country` (`exed_job_location_country_id`);

--
-- Indexes for table `expert_skill_set`
--
ALTER TABLE `expert_skill_set`
  ADD PRIMARY KEY (`exss_id`),
  ADD KEY `FK_exss_expert` (`exss_expert_id`),
  ADD KEY `FK_exss_skill` (`exss_skill_type_id`) USING BTREE;

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`fp_id`),
  ADD KEY `FK_fp_user` (`fp_user_id`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`industry_id`),
  ADD KEY `FK_industry_user` (`industry_user_id`),
  ADD KEY `FK_industry_field` (`industry_industry_field_id`),
  ADD KEY `FK_industry_admin` (`industry_created_by`),
  ADD KEY `FK_industry_city` (`industry_city_id`),
  ADD KEY `FK_industry_state` (`industry_state_id`),
  ADD KEY `FK_industry_country` (`industry_country_id`),
  ADD KEY `FK_industry_role` (`industry_role_id`);

--
-- Indexes for table `industry_field`
--
ALTER TABLE `industry_field`
  ADD PRIMARY KEY (`industry_field_id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`institution_id`),
  ADD KEY `FK_institution_university` (`institution_university_id`),
  ADD KEY `FK_institution_user` (`institution_user_id`),
  ADD KEY `FK_institution_role` (`institution_role_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `FK_job_category` (`job_category_id`),
  ADD KEY `FK_job_position` (`job_position_id`),
  ADD KEY `FK_job_industry` (`job_industry_id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`jc_id`);

--
-- Indexes for table `job_position`
--
ALTER TABLE `job_position`
  ADD PRIMARY KEY (`jp_id`);

--
-- Indexes for table `job_skill_set`
--
ALTER TABLE `job_skill_set`
  ADD PRIMARY KEY (`jss_id`),
  ADD KEY `FK_jss_job` (`jss_job_id`);

--
-- Indexes for table `job_student_university_application`
--
ALTER TABLE `job_student_university_application`
  ADD PRIMARY KEY (`jsua_id`),
  ADD KEY `FK_jsua_student_university` (`jsua_student_university_id`),
  ADD KEY `FK_jsua_job` (`jsua_job_id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturer_id`),
  ADD KEY `FK_lecturer_user` (`lecturer_user_id`),
  ADD KEY `FK_lecturer_city` (`lecturer_city_id`),
  ADD KEY `FK_lecturer_state` (`lecturer_state_id`),
  ADD KEY `FK_lecturer_country` (`lecturer_country_id`),
  ADD KEY `FK_lecturer_university` (`lecturer_institution_id`),
  ADD KEY `FK_lecturer_created` (`lecturer_created_by`),
  ADD KEY `FK_lecturer_role` (`lecturer_role_id`);

--
-- Indexes for table `lecturer_education_degree`
--
ALTER TABLE `lecturer_education_degree`
  ADD PRIMARY KEY (`lectdeg_id`),
  ADD KEY `FK_lectdeg_lecturer` (`lectdeg_lecturer_id`),
  ADD KEY `FK_lectdeg_university` (`lectdeg_university_id`),
  ADD KEY `FK_lectdeg_degree` (`lectdeg_degree_id`),
  ADD KEY `FK_lectdeg_field` (`lectdeg_field_id`);

--
-- Indexes for table `lecturer_education_diploma`
--
ALTER TABLE `lecturer_education_diploma`
  ADD PRIMARY KEY (`lectdip_id`),
  ADD KEY `FK_lectdip_lecturer` (`lectdip_lecturer_id`),
  ADD KEY `FK_lectdip_university` (`lectdip_university_id`),
  ADD KEY `FK_lectdip_diploma` (`lectdip_diploma_id`),
  ADD KEY `FK_lectdip_field` (`lectdip_field_id`);

--
-- Indexes for table `lecturer_education_master`
--
ALTER TABLE `lecturer_education_master`
  ADD PRIMARY KEY (`lectm_id`),
  ADD KEY `FK_lectm_lecturer` (`lectm_lecturer_id`),
  ADD KEY `FK_lectm_university` (`lectm_university_id`),
  ADD KEY `FK_lectm_master` (`lectm_master_id`),
  ADD KEY `FK_lectm_field` (`lectm_field_id`);

--
-- Indexes for table `lecturer_education_phd`
--
ALTER TABLE `lecturer_education_phd`
  ADD PRIMARY KEY (`lectp_id`),
  ADD KEY `FK_lectp_lecturer` (`lectp_lecturer_id`),
  ADD KEY `FK_lectp_university` (`lectp_university_id`),
  ADD KEY `FK_lectp_phd` (`lectp_phd_id`),
  ADD KEY `FK_lectp_field` (`lectp_field_id`);

--
-- Indexes for table `lecturer_experience_details`
--
ALTER TABLE `lecturer_experience_details`
  ADD PRIMARY KEY (`led_id`),
  ADD KEY `FK_led_lecturer` (`led_lecturer_id`),
  ADD KEY `FK_led_job_city` (`led_job_location_city_id`),
  ADD KEY `FK_led_job_state` (`led_job_location_state_id`),
  ADD KEY `FK_led_job_country` (`led_job_location_country_id`);

--
-- Indexes for table `lecturer_skill_set`
--
ALTER TABLE `lecturer_skill_set`
  ADD PRIMARY KEY (`lss_id`),
  ADD KEY `FK_lss_lecturer` (`lss_lecturer_id`),
  ADD KEY `FK_lss_skill` (`lss_skill_type_id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`master_id`);

--
-- Indexes for table `mc_assignment`
--
ALTER TABLE `mc_assignment`
  ADD PRIMARY KEY (`mca_id`),
  ADD KEY `FK_mca_createdby` (`mca_created_by`),
  ADD KEY `FK_mca_mc` (`mca_mc_id`);

--
-- Indexes for table `mc_assignment_duedate`
--
ALTER TABLE `mc_assignment_duedate`
  ADD PRIMARY KEY (`mcad_id`),
  ADD KEY `FK_mcad_mca` (`mcad_mc_assignment_id`);

--
-- Indexes for table `mc_course_credit_transfer`
--
ALTER TABLE `mc_course_credit_transfer`
  ADD PRIMARY KEY (`mccct_id`),
  ADD KEY `FK_mccct_microcredential_id` (`mccct_mc_id`),
  ADD KEY `FK_mccct_createdby` (`mccct_created_by`);

--
-- Indexes for table `mc_enrolment_session`
--
ALTER TABLE `mc_enrolment_session`
  ADD PRIMARY KEY (`mces_id`),
  ADD KEY `FK_mcls_mc` (`mces_mc_id`);

--
-- Indexes for table `mc_learning_details`
--
ALTER TABLE `mc_learning_details`
  ADD PRIMARY KEY (`mcld_id`),
  ADD KEY `FK_mcld_microcredential_id` (`mcld_mc_id`);

--
-- Indexes for table `mc_notes`
--
ALTER TABLE `mc_notes`
  ADD PRIMARY KEY (`mcn_id`),
  ADD KEY `FK_mcn_createdby` (`mcn_created_by`),
  ADD KEY `FK_mcn_mc` (`mcn_mc_id`);

--
-- Indexes for table `mc_project`
--
ALTER TABLE `mc_project`
  ADD PRIMARY KEY (`mcp_id`),
  ADD KEY `FK_mcp_mc` (`mcp_mc_id`),
  ADD KEY `FK_mcp_createdby` (`mcp_created_by`);

--
-- Indexes for table `mc_project_duedate`
--
ALTER TABLE `mc_project_duedate`
  ADD PRIMARY KEY (`mcpd_id`),
  ADD KEY `FK_mcpd_mcproject` (`mcpd_mc_project_id`);

--
-- Indexes for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  ADD PRIMARY KEY (`mcq_id`),
  ADD KEY `FK_mcq_createdby` (`mcq_created_by`),
  ADD KEY `FK_mcq_mc` (`mcq_mc_id`);

--
-- Indexes for table `mc_quiz_answer`
--
ALTER TABLE `mc_quiz_answer`
  ADD PRIMARY KEY (`mcqa_id`),
  ADD KEY `FK_mcqa_mcquizquestion` (`mcqa_mc_quiz_question_id`);

--
-- Indexes for table `mc_quiz_question`
--
ALTER TABLE `mc_quiz_question`
  ADD PRIMARY KEY (`mcqq_id`),
  ADD KEY `FK_mcqq_mcquiz` (`mcqq_mc_quiz_id`);

--
-- Indexes for table `mc_slide`
--
ALTER TABLE `mc_slide`
  ADD PRIMARY KEY (`mcs_id`),
  ADD KEY `FK_mcs_createdby` (`mcs_created_by`),
  ADD KEY `FK_mcs_mc` (`mcs_mc_id`);

--
-- Indexes for table `mc_test`
--
ALTER TABLE `mc_test`
  ADD PRIMARY KEY (`mct_id`),
  ADD KEY `FK_mct_createdby` (`mct_created_by`),
  ADD KEY `FK_mct_mc` (`mct_mc_id`);

--
-- Indexes for table `mc_test_answer`
--
ALTER TABLE `mc_test_answer`
  ADD PRIMARY KEY (`mcta_id`),
  ADD KEY `FK_mcta_mctestquestion` (`mcta_mc_test_question_id`);

--
-- Indexes for table `mc_test_question`
--
ALTER TABLE `mc_test_question`
  ADD PRIMARY KEY (`mctq_id`),
  ADD KEY `FK_mctq_mctest` (`mctq_mc_test_id`);

--
-- Indexes for table `mc_tutorial`
--
ALTER TABLE `mc_tutorial`
  ADD PRIMARY KEY (`mctu_id`),
  ADD KEY `FK_mctu_createdby` (`mctu_created_by`),
  ADD KEY `FK_mctu_mc` (`mctu_mc_id`);

--
-- Indexes for table `mc_tutorial_duedate`
--
ALTER TABLE `mc_tutorial_duedate`
  ADD PRIMARY KEY (`mctud_id`),
  ADD KEY `FK_mctud_mctutorial` (`mctud_mc_tutorial_id`);

--
-- Indexes for table `mc_video`
--
ALTER TABLE `mc_video`
  ADD PRIMARY KEY (`mcv_id`),
  ADD KEY `FK_mcv_createdby` (`mcv_created_by`),
  ADD KEY `FK_mcv_mc` (`mcv_mc_id`);

--
-- Indexes for table `microcredential`
--
ALTER TABLE `microcredential`
  ADD PRIMARY KEY (`mc_id`),
  ADD KEY `FK_mc_createdby` (`mc_created_by`),
  ADD KEY `FK_mc_institution` (`mc_owner`);

--
-- Indexes for table `phd`
--
ALTER TABLE `phd`
  ADD PRIMARY KEY (`phd_id`);

--
-- Indexes for table `postcode`
--
ALTER TABLE `postcode`
  ADD PRIMARY KEY (`postcode_id`),
  ADD KEY `FK_postcode_city` (`postcode_city_id`);

--
-- Indexes for table `review_microcredential`
--
ALTER TABLE `review_microcredential`
  ADD PRIMARY KEY (`rmc_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `skill_type`
--
ALTER TABLE `skill_type`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `FK_state_country` (`state_country_id`);

--
-- Indexes for table `student_university`
--
ALTER TABLE `student_university`
  ADD PRIMARY KEY (`su_id`),
  ADD KEY `FK_su_user` (`su_user_id`),
  ADD KEY `FK_su_city` (`su_city_id`),
  ADD KEY `FK_su_state` (`su_state_id`),
  ADD KEY `FK_su_country` (`su_country_id`),
  ADD KEY `FK_su_university` (`su_institution_id`),
  ADD KEY `FK_su_role` (`su_role_id`);

--
-- Indexes for table `student_university_education_degree`
--
ALTER TABLE `student_university_education_degree`
  ADD PRIMARY KEY (`suedeg_id`),
  ADD KEY `FK_suedeg_student_university` (`suedeg_student_university_id`),
  ADD KEY `FK_suedeg_university` (`suedeg_university_id`),
  ADD KEY `FK_suedeg_degree` (`suedeg_degree_id`),
  ADD KEY `FK_suedeg_field` (`suedeg_field_id`);

--
-- Indexes for table `student_university_education_diploma`
--
ALTER TABLE `student_university_education_diploma`
  ADD PRIMARY KEY (`suedip_id`),
  ADD KEY `FK_suedip_diploma` (`suedip_diploma_id`),
  ADD KEY `FK_suedip_field` (`suedip_field_id`),
  ADD KEY `FK_suedip_student_university` (`suedip_student_university_id`),
  ADD KEY `FK_suedip_university` (`suedip_university_id`);

--
-- Indexes for table `student_university_education_master`
--
ALTER TABLE `student_university_education_master`
  ADD PRIMARY KEY (`suem_id`),
  ADD KEY `FK_suem_student_university` (`suem_student_university_id`),
  ADD KEY `FK_suem_university` (`suem_university_id`),
  ADD KEY `FK_suem_master` (`suem_master_id`),
  ADD KEY `FK_suem_field` (`suem_field_id`);

--
-- Indexes for table `student_university_education_phd`
--
ALTER TABLE `student_university_education_phd`
  ADD PRIMARY KEY (`suep_id`),
  ADD KEY `FK_suep_student_university` (`suep_student_university_id`),
  ADD KEY `FK_suep_university` (`suep_university_id`),
  ADD KEY `FK_suep_phd` (`suep_phd_id`),
  ADD KEY `FK_suep_field` (`suep_field_id`);

--
-- Indexes for table `student_university_experience_details`
--
ALTER TABLE `student_university_experience_details`
  ADD PRIMARY KEY (`sued_id`),
  ADD UNIQUE KEY `FK_sued_student_university_id` (`sued_id`) USING BTREE,
  ADD KEY `FK_sued_job_city` (`sued_job_location_city_id`),
  ADD KEY `FK_sued_job_state` (`sued_job_location_state_id`),
  ADD KEY `FK_sued_job_country` (`sued_job_location_country_id`),
  ADD KEY `FK_sued_student_university` (`sued_student_university_id`);

--
-- Indexes for table `student_university_skill_set`
--
ALTER TABLE `student_university_skill_set`
  ADD PRIMARY KEY (`sus_id`),
  ADD KEY `FK_sus_student_university` (`sus_student_university_id`),
  ADD KEY `FK_sus_skill_type` (`sus_skill_type_id`);

--
-- Indexes for table `studuni_course_assignment_submission`
--
ALTER TABLE `studuni_course_assignment_submission`
  ADD PRIMARY KEY (`sucas_id`),
  ADD KEY `FK_sucas_course_assignment` (`sucas_course_assignment_id`),
  ADD KEY `FK_sucas_student_university` (`sucas_student_university_id`);

--
-- Indexes for table `studuni_course_project_submission`
--
ALTER TABLE `studuni_course_project_submission`
  ADD PRIMARY KEY (`sucps_id`),
  ADD KEY `FK_sucps_course_project` (`sucps_course_project_id`),
  ADD KEY `FK_sucps_student_university` (`sucps_student_university_id`);

--
-- Indexes for table `studuni_course_quiz_result`
--
ALTER TABLE `studuni_course_quiz_result`
  ADD PRIMARY KEY (`sucqrs_id`),
  ADD KEY `FK_sucqs_course_quiz` (`sucqrs_course_quiz_id`),
  ADD KEY `FK_sucqs_student_university` (`sucqrs_student_university_id`);

--
-- Indexes for table `studuni_course_quiz_review`
--
ALTER TABLE `studuni_course_quiz_review`
  ADD PRIMARY KEY (`sucqrv_id`),
  ADD KEY `FK_sucqrv_course_quiz` (`sucqrv_course_quiz_id`),
  ADD KEY `FK_sucqrv_course_quiz_question` (`sucqrv_course_quiz_question_id`),
  ADD KEY `FK_sucqrv_student_university` (`sucqrv_student_university_id`);

--
-- Indexes for table `studuni_course_test_result`
--
ALTER TABLE `studuni_course_test_result`
  ADD PRIMARY KEY (`suctrs_id`),
  ADD KEY `FK_suctrs_course_test` (`suctrs_course_test_id`),
  ADD KEY `FK_suctrs_student_university` (`suctrs_student_university_id`);

--
-- Indexes for table `studuni_course_test_review`
--
ALTER TABLE `studuni_course_test_review`
  ADD PRIMARY KEY (`suctrv_id`),
  ADD KEY `FK_suctrv_student_university` (`suctrv_student_university_id`),
  ADD KEY `FK_suctrv_test` (`suctrv_course_test_id`),
  ADD KEY `FK_suctrv_test_question` (`suctrv_course_test_question_id`);

--
-- Indexes for table `studuni_course_tutorial_submission`
--
ALTER TABLE `studuni_course_tutorial_submission`
  ADD PRIMARY KEY (`suctus_id`),
  ADD KEY `FK_suctus_course_tutorial` (`suctus_course_tutorial_id`),
  ADD KEY `FK_suctus_student_university` (`suctus_student_university_id`);

--
-- Indexes for table `studuni_course_watched_video`
--
ALTER TABLE `studuni_course_watched_video`
  ADD PRIMARY KEY (`sucvw_id`),
  ADD KEY `FK_sucvw_course_video` (`sucvw_course_video_id`),
  ADD KEY `FK_sucvw_student_university` (`sucvw_student_university_id`);

--
-- Indexes for table `studuni_mc_assignment_submission`
--
ALTER TABLE `studuni_mc_assignment_submission`
  ADD PRIMARY KEY (`sumcas_id`),
  ADD KEY `FK_sumcas_mc_assignment` (`sumcas_mc_assignment_id`),
  ADD KEY `FK_sumcas_student_university` (`sumcas_student_university_id`);

--
-- Indexes for table `studuni_mc_project_submission`
--
ALTER TABLE `studuni_mc_project_submission`
  ADD PRIMARY KEY (`sumcps_id`),
  ADD KEY `FK_sumcps_mc_project` (`sumcps_mc_project_id`),
  ADD KEY `FK_sumcps_student_university` (`sumcps_student_university_id`);

--
-- Indexes for table `studuni_mc_quiz_result`
--
ALTER TABLE `studuni_mc_quiz_result`
  ADD PRIMARY KEY (`sumcqrs_id`),
  ADD KEY `FK_sumcqrs_mc_quiz` (`sumcqrs_mc_quiz_id`),
  ADD KEY `FK_sumcqrs_student_university` (`sumcqrs_student_university_id`);

--
-- Indexes for table `studuni_mc_quiz_review`
--
ALTER TABLE `studuni_mc_quiz_review`
  ADD PRIMARY KEY (`sumcqrv_id`),
  ADD KEY `FK_sumcqrv_mc_quiz` (`sumcqrv_mc_quiz_id`),
  ADD KEY `FK_sumcqrv_mc_quiz_question` (`sumcqrv_mc_quiz_question_id`),
  ADD KEY `FK_sumcqrv_student_university` (`sumcqrv_student_university_id`);

--
-- Indexes for table `studuni_mc_test_result`
--
ALTER TABLE `studuni_mc_test_result`
  ADD PRIMARY KEY (`sumctrs_id`),
  ADD KEY `FK_sumctrs_mc_test` (`sumctrs_mc_test_id`),
  ADD KEY `FK_sumctrs_student_university` (`sumctrs_student_university_id`);

--
-- Indexes for table `studuni_mc_test_review`
--
ALTER TABLE `studuni_mc_test_review`
  ADD PRIMARY KEY (`sumctrv_id`),
  ADD KEY `FK_sumctrv_student_university` (`sumctrv_student_university_id`),
  ADD KEY `FK_sumctrv_test` (`sumctrv_mc_test_id`),
  ADD KEY `FK_sumctrv_test_question` (`sumctrv_mc_test_question_id`);

--
-- Indexes for table `studuni_mc_tutorial_submission`
--
ALTER TABLE `studuni_mc_tutorial_submission`
  ADD PRIMARY KEY (`sumctus_id`),
  ADD KEY `FK_sumctus_mc_tutorial` (`sumctus_mc_tutorial_id`),
  ADD KEY `FK_sumctus_student_university` (`sumctus_student_university_id`);

--
-- Indexes for table `studuni_mc_watched_video`
--
ALTER TABLE `studuni_mc_watched_video`
  ADD PRIMARY KEY (`sumcvw_id`),
  ADD KEY `FK_sumcvw_mc_video` (`sumcvw_mc_video_id`),
  ADD KEY `FK_sumcvw_student_university` (`sumcvw_student_university_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`university_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_user_role` (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_programme`
--
ALTER TABLE `academic_programme`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `academic_programme_session`
--
ALTER TABLE `academic_programme_session`
  MODIFY `aps_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academic_programme_student_uni_application`
--
ALTER TABLE `academic_programme_student_uni_application`
  MODIFY `apsua_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_management`
--
ALTER TABLE `admin_management`
  MODIFY `am_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badge_type`
--
ALTER TABLE `badge_type`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_order`
--
ALTER TABLE `cart_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_type`
--
ALTER TABLE `certificate_type`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `committee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_assignment`
--
ALTER TABLE `course_assignment`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_assignment_duedate`
--
ALTER TABLE `course_assignment_duedate`
  MODIFY `cad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_enrolment_session`
--
ALTER TABLE `course_enrolment_session`
  MODIFY `ces_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_instructor`
--
ALTER TABLE `course_instructor`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_learning_details`
--
ALTER TABLE `course_learning_details`
  MODIFY `cld_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_notes`
--
ALTER TABLE `course_notes`
  MODIFY `cn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_project`
--
ALTER TABLE `course_project`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_project_duedate`
--
ALTER TABLE `course_project_duedate`
  MODIFY `cpd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_quiz`
--
ALTER TABLE `course_quiz`
  MODIFY `cq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_quiz_answer`
--
ALTER TABLE `course_quiz_answer`
  MODIFY `cqa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_quiz_question`
--
ALTER TABLE `course_quiz_question`
  MODIFY `cqq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_slide`
--
ALTER TABLE `course_slide`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_test`
--
ALTER TABLE `course_test`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_test_answer`
--
ALTER TABLE `course_test_answer`
  MODIFY `cta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_test_question`
--
ALTER TABLE `course_test_question`
  MODIFY `ctq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_tutorial`
--
ALTER TABLE `course_tutorial`
  MODIFY `ctu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_tutorial_duedate`
--
ALTER TABLE `course_tutorial_duedate`
  MODIFY `ctud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_video`
--
ALTER TABLE `course_video`
  MODIFY `cv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `degree_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diploma`
--
ALTER TABLE `diploma`
  MODIFY `diploma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  MODIFY `ecsu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  MODIFY `emcsu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `expert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expert_education_degree`
--
ALTER TABLE `expert_education_degree`
  MODIFY `exedeg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_education_diploma`
--
ALTER TABLE `expert_education_diploma`
  MODIFY `exedip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_education_master`
--
ALTER TABLE `expert_education_master`
  MODIFY `exem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_education_phd`
--
ALTER TABLE `expert_education_phd`
  MODIFY `exep_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_experience_details`
--
ALTER TABLE `expert_experience_details`
  MODIFY `exed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_skill_set`
--
ALTER TABLE `expert_skill_set`
  MODIFY `exss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `industry_field`
--
ALTER TABLE `industry_field`
  MODIFY `industry_field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `jc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_position`
--
ALTER TABLE `job_position`
  MODIFY `jp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_skill_set`
--
ALTER TABLE `job_skill_set`
  MODIFY `jss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_student_university_application`
--
ALTER TABLE `job_student_university_application`
  MODIFY `jsua_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecturer_education_degree`
--
ALTER TABLE `lecturer_education_degree`
  MODIFY `lectdeg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_education_diploma`
--
ALTER TABLE `lecturer_education_diploma`
  MODIFY `lectdip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_education_master`
--
ALTER TABLE `lecturer_education_master`
  MODIFY `lectm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_education_phd`
--
ALTER TABLE `lecturer_education_phd`
  MODIFY `lectp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_experience_details`
--
ALTER TABLE `lecturer_experience_details`
  MODIFY `led_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_skill_set`
--
ALTER TABLE `lecturer_skill_set`
  MODIFY `lss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_assignment`
--
ALTER TABLE `mc_assignment`
  MODIFY `mca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_assignment_duedate`
--
ALTER TABLE `mc_assignment_duedate`
  MODIFY `mcad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_course_credit_transfer`
--
ALTER TABLE `mc_course_credit_transfer`
  MODIFY `mccct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_enrolment_session`
--
ALTER TABLE `mc_enrolment_session`
  MODIFY `mces_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mc_learning_details`
--
ALTER TABLE `mc_learning_details`
  MODIFY `mcld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_notes`
--
ALTER TABLE `mc_notes`
  MODIFY `mcn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_project`
--
ALTER TABLE `mc_project`
  MODIFY `mcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_project_duedate`
--
ALTER TABLE `mc_project_duedate`
  MODIFY `mcpd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  MODIFY `mcq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mc_quiz_answer`
--
ALTER TABLE `mc_quiz_answer`
  MODIFY `mcqa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mc_quiz_question`
--
ALTER TABLE `mc_quiz_question`
  MODIFY `mcqq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mc_slide`
--
ALTER TABLE `mc_slide`
  MODIFY `mcs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_test`
--
ALTER TABLE `mc_test`
  MODIFY `mct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mc_test_answer`
--
ALTER TABLE `mc_test_answer`
  MODIFY `mcta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `mc_test_question`
--
ALTER TABLE `mc_test_question`
  MODIFY `mctq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `mc_tutorial`
--
ALTER TABLE `mc_tutorial`
  MODIFY `mctu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_tutorial_duedate`
--
ALTER TABLE `mc_tutorial_duedate`
  MODIFY `mctud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_video`
--
ALTER TABLE `mc_video`
  MODIFY `mcv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `microcredential`
--
ALTER TABLE `microcredential`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `phd`
--
ALTER TABLE `phd`
  MODIFY `phd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postcode`
--
ALTER TABLE `postcode`
  MODIFY `postcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `review_microcredential`
--
ALTER TABLE `review_microcredential`
  MODIFY `rmc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skill_type`
--
ALTER TABLE `skill_type`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_university`
--
ALTER TABLE `student_university`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_university_education_degree`
--
ALTER TABLE `student_university_education_degree`
  MODIFY `suedeg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_university_education_diploma`
--
ALTER TABLE `student_university_education_diploma`
  MODIFY `suedip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_university_education_master`
--
ALTER TABLE `student_university_education_master`
  MODIFY `suem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_university_education_phd`
--
ALTER TABLE `student_university_education_phd`
  MODIFY `suep_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_university_experience_details`
--
ALTER TABLE `student_university_experience_details`
  MODIFY `sued_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_university_skill_set`
--
ALTER TABLE `student_university_skill_set`
  MODIFY `sus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studuni_course_assignment_submission`
--
ALTER TABLE `studuni_course_assignment_submission`
  MODIFY `sucas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_project_submission`
--
ALTER TABLE `studuni_course_project_submission`
  MODIFY `sucps_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_quiz_result`
--
ALTER TABLE `studuni_course_quiz_result`
  MODIFY `sucqrs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_quiz_review`
--
ALTER TABLE `studuni_course_quiz_review`
  MODIFY `sucqrv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_test_result`
--
ALTER TABLE `studuni_course_test_result`
  MODIFY `suctrs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_test_review`
--
ALTER TABLE `studuni_course_test_review`
  MODIFY `suctrv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_tutorial_submission`
--
ALTER TABLE `studuni_course_tutorial_submission`
  MODIFY `suctus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_course_watched_video`
--
ALTER TABLE `studuni_course_watched_video`
  MODIFY `sucvw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_mc_assignment_submission`
--
ALTER TABLE `studuni_mc_assignment_submission`
  MODIFY `sumcas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studuni_mc_project_submission`
--
ALTER TABLE `studuni_mc_project_submission`
  MODIFY `sumcps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studuni_mc_quiz_result`
--
ALTER TABLE `studuni_mc_quiz_result`
  MODIFY `sumcqrs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `studuni_mc_quiz_review`
--
ALTER TABLE `studuni_mc_quiz_review`
  MODIFY `sumcqrv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `studuni_mc_test_result`
--
ALTER TABLE `studuni_mc_test_result`
  MODIFY `sumctrs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `studuni_mc_test_review`
--
ALTER TABLE `studuni_mc_test_review`
  MODIFY `sumctrv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `studuni_mc_tutorial_submission`
--
ALTER TABLE `studuni_mc_tutorial_submission`
  MODIFY `sumctus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `studuni_mc_watched_video`
--
ALTER TABLE `studuni_mc_watched_video`
  MODIFY `sumcvw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_programme`
--
ALTER TABLE `academic_programme`
  ADD CONSTRAINT `FK_ap_created` FOREIGN KEY (`ap_created_by`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_ap_field` FOREIGN KEY (`ap_field_id`) REFERENCES `field` (`field_id`);

--
-- Constraints for table `academic_programme_session`
--
ALTER TABLE `academic_programme_session`
  ADD CONSTRAINT `FK_aps_academic_programme` FOREIGN KEY (`aps_academic_programme_id`) REFERENCES `academic_programme` (`ap_id`);

--
-- Constraints for table `academic_programme_student_uni_application`
--
ALTER TABLE `academic_programme_student_uni_application`
  ADD CONSTRAINT `FK_apsua_accepted` FOREIGN KEY (`apsua_accepted_by`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_apsua_ap` FOREIGN KEY (`apsua_academic_programme_id`) REFERENCES `academic_programme` (`ap_id`),
  ADD CONSTRAINT `FK_apsua_rejected` FOREIGN KEY (`apsua_rejected_by`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_apsua_student_university` FOREIGN KEY (`apsua_request_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_role` FOREIGN KEY (`admin_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_admin_user` FOREIGN KEY (`admin_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `admin_management`
--
ALTER TABLE `admin_management`
  ADD CONSTRAINT `FK_am_admin` FOREIGN KEY (`am_admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `badge`
--
ALTER TABLE `badge`
  ADD CONSTRAINT `FK_badge_createdby_user` FOREIGN KEY (`badge_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_badge_type` FOREIGN KEY (`badge_type_id`) REFERENCES `badge_type` (`bt_id`),
  ADD CONSTRAINT `FK_badge_university` FOREIGN KEY (`badge_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart_user` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_course`
--
ALTER TABLE `cart_course`
  ADD CONSTRAINT `FK_cart_course_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_course_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_mc`
--
ALTER TABLE `cart_mc`
  ADD CONSTRAINT `FK_cart_item_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cart_item_microcredential` FOREIGN KEY (`sub_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_order`
--
ALTER TABLE `cart_order`
  ADD CONSTRAINT `FK_cart_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cart_order_course`
--
ALTER TABLE `cart_order_course`
  ADD CONSTRAINT `FK_cart_order_course_cart_order` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`order_id`),
  ADD CONSTRAINT `FK_cart_order_course_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cart_order_mc`
--
ALTER TABLE `cart_order_mc`
  ADD CONSTRAINT `FK_cart_order_mc_cart_order` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`order_id`),
  ADD CONSTRAINT `FK_cart_order_mc_microcredential` FOREIGN KEY (`sub_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `FK_certificate_createdby_user` FOREIGN KEY (`certificate_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_certificate_ct` FOREIGN KEY (`certificate_type_id`) REFERENCES `certificate_type` (`ct_id`),
  ADD CONSTRAINT `FK_certificate_university` FOREIGN KEY (`certificate_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `FK_city_state` FOREIGN KEY (`city_state_id`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `commission`
--
ALTER TABLE `commission`
  ADD CONSTRAINT `FK_commission_cart_order` FOREIGN KEY (`order_id`) REFERENCES `cart_order` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_commission_institution` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`institution_id`) ON UPDATE CASCADE;

--
-- Constraints for table `commission_course`
--
ALTER TABLE `commission_course`
  ADD CONSTRAINT `FK_commission_course_commission` FOREIGN KEY (`cm_id`) REFERENCES `commission` (`cm_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_commission_course_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commission_mc`
--
ALTER TABLE `commission_mc`
  ADD CONSTRAINT `FK_commission_mc_commission` FOREIGN KEY (`cm_id`) REFERENCES `commission` (`cm_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_commission_mc_microcredential` FOREIGN KEY (`mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commission_rate`
--
ALTER TABLE `commission_rate`
  ADD CONSTRAINT `FK_commission_rate_institution` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`institution_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_course_owner` FOREIGN KEY (`course_owner`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_course_user` FOREIGN KEY (`course_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_assignment`
--
ALTER TABLE `course_assignment`
  ADD CONSTRAINT `FK_ca_course` FOREIGN KEY (`ca_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_ca_createdby` FOREIGN KEY (`ca_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_assignment_duedate`
--
ALTER TABLE `course_assignment_duedate`
  ADD CONSTRAINT `FK_cad_ca` FOREIGN KEY (`cad_course_assignment_id`) REFERENCES `course_assignment` (`ca_id`);

--
-- Constraints for table `course_enrolment_session`
--
ALTER TABLE `course_enrolment_session`
  ADD CONSTRAINT `FK_ces_course` FOREIGN KEY (`ces_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD CONSTRAINT `FK_ci_course` FOREIGN KEY (`ci_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_ci_user` FOREIGN KEY (`ci_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_learning_details`
--
ALTER TABLE `course_learning_details`
  ADD CONSTRAINT `FK_cld_course` FOREIGN KEY (`cld_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_notes`
--
ALTER TABLE `course_notes`
  ADD CONSTRAINT `FK_cn_course` FOREIGN KEY (`cn_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_cn_user` FOREIGN KEY (`cn_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_project`
--
ALTER TABLE `course_project`
  ADD CONSTRAINT `FK_cp_course` FOREIGN KEY (`cp_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_cp_createdby` FOREIGN KEY (`cp_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_project_duedate`
--
ALTER TABLE `course_project_duedate`
  ADD CONSTRAINT `FK_cpd_cp` FOREIGN KEY (`cpd_course_project_id`) REFERENCES `course_project` (`cp_id`);

--
-- Constraints for table `course_quiz`
--
ALTER TABLE `course_quiz`
  ADD CONSTRAINT `FK_cq_course` FOREIGN KEY (`cq_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cq_createdby` FOREIGN KEY (`cq_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_quiz_answer`
--
ALTER TABLE `course_quiz_answer`
  ADD CONSTRAINT `FK_cqa_cqq` FOREIGN KEY (`cqa_course_quiz_question_id`) REFERENCES `course_quiz_question` (`cqq_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_quiz_question`
--
ALTER TABLE `course_quiz_question`
  ADD CONSTRAINT `FK_cqq_cq` FOREIGN KEY (`cqq_course_quiz_id`) REFERENCES `course_quiz` (`cq_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_slide`
--
ALTER TABLE `course_slide`
  ADD CONSTRAINT `FK_cs_course` FOREIGN KEY (`cs_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_cs_createdby` FOREIGN KEY (`cs_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_test`
--
ALTER TABLE `course_test`
  ADD CONSTRAINT `FK_ct_course` FOREIGN KEY (`ct_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ct_createdby` FOREIGN KEY (`ct_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_test_answer`
--
ALTER TABLE `course_test_answer`
  ADD CONSTRAINT `FK_cta_ctq` FOREIGN KEY (`cta_course_test_question_id`) REFERENCES `course_test_question` (`ctq_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_test_question`
--
ALTER TABLE `course_test_question`
  ADD CONSTRAINT `FK_ctq_ct` FOREIGN KEY (`ctq_course_test_id`) REFERENCES `course_test` (`ct_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_tutorial`
--
ALTER TABLE `course_tutorial`
  ADD CONSTRAINT `FK_ctu_course` FOREIGN KEY (`ctu_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ctu_createdby` FOREIGN KEY (`ctu_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_tutorial_duedate`
--
ALTER TABLE `course_tutorial_duedate`
  ADD CONSTRAINT `FK_ctud_ctu` FOREIGN KEY (`ctud_course_tutorial_id`) REFERENCES `course_tutorial` (`ctu_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_video`
--
ALTER TABLE `course_video`
  ADD CONSTRAINT `FK_cv_course` FOREIGN KEY (`cv_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_cv_createdby` FOREIGN KEY (`cv_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  ADD CONSTRAINT `FK_ecsu_certificate` FOREIGN KEY (`ecsu_certificate_id`) REFERENCES `certificate` (`certificate_id`),
  ADD CONSTRAINT `FK_ecsu_course` FOREIGN KEY (`ecsu_course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `FK_ecsu_student_university` FOREIGN KEY (`ecsu_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  ADD CONSTRAINT `FK_emcsu_certificate` FOREIGN KEY (`emcsu_certificate_id`) REFERENCES `certificate` (`certificate_id`),
  ADD CONSTRAINT `FK_emcsu_mc` FOREIGN KEY (`emcsu_mc_id`) REFERENCES `microcredential` (`mc_id`),
  ADD CONSTRAINT `FK_emcsu_student_university` FOREIGN KEY (`emcsu_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `expert`
--
ALTER TABLE `expert`
  ADD CONSTRAINT `FK_expert_city` FOREIGN KEY (`expert_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_expert_country` FOREIGN KEY (`expert_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_expert_state` FOREIGN KEY (`expert_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_expert_user` FOREIGN KEY (`expert_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `expert_education_degree`
--
ALTER TABLE `expert_education_degree`
  ADD CONSTRAINT `FK_exedeg_degree` FOREIGN KEY (`exedeg_degree_id`) REFERENCES `degree` (`degree_id`),
  ADD CONSTRAINT `FK_exedeg_expert` FOREIGN KEY (`exedeg_expert_id`) REFERENCES `expert` (`expert_id`),
  ADD CONSTRAINT `FK_exedeg_field` FOREIGN KEY (`exedeg_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_exedeg_university` FOREIGN KEY (`exedeg_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `expert_education_diploma`
--
ALTER TABLE `expert_education_diploma`
  ADD CONSTRAINT `FK_exedip_diploma` FOREIGN KEY (`exedip_diploma_id`) REFERENCES `diploma` (`diploma_id`),
  ADD CONSTRAINT `FK_exedip_expert` FOREIGN KEY (`exedip_expert_id`) REFERENCES `expert` (`expert_id`),
  ADD CONSTRAINT `FK_exedip_field` FOREIGN KEY (`exedip_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_exedip_university` FOREIGN KEY (`exedip_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `expert_education_master`
--
ALTER TABLE `expert_education_master`
  ADD CONSTRAINT `FK_exem_expert` FOREIGN KEY (`exem_expert_id`) REFERENCES `expert` (`expert_id`),
  ADD CONSTRAINT `FK_exem_field` FOREIGN KEY (`exem_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_exem_master` FOREIGN KEY (`exem_master_id`) REFERENCES `master` (`master_id`),
  ADD CONSTRAINT `FK_exem_university` FOREIGN KEY (`exem_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `expert_education_phd`
--
ALTER TABLE `expert_education_phd`
  ADD CONSTRAINT `FK_exep_expert` FOREIGN KEY (`exep_expert_id`) REFERENCES `expert` (`expert_id`),
  ADD CONSTRAINT `FK_exep_field` FOREIGN KEY (`exep_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_exep_phd` FOREIGN KEY (`exep_phd_id`) REFERENCES `phd` (`phd_id`),
  ADD CONSTRAINT `FK_exep_university` FOREIGN KEY (`exep_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `expert_experience_details`
--
ALTER TABLE `expert_experience_details`
  ADD CONSTRAINT `FK_exed_expert` FOREIGN KEY (`exed_expert_id`) REFERENCES `expert` (`expert_id`),
  ADD CONSTRAINT `FK_exed_job_city` FOREIGN KEY (`exed_job_location_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_exed_job_country` FOREIGN KEY (`exed_job_location_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_exed_job_state` FOREIGN KEY (`exed_job_location_state_id`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `expert_skill_set`
--
ALTER TABLE `expert_skill_set`
  ADD CONSTRAINT `FK_exss_expert` FOREIGN KEY (`exss_expert_id`) REFERENCES `expert` (`expert_id`),
  ADD CONSTRAINT `FK_exss_skill_type` FOREIGN KEY (`exss_skill_type_id`) REFERENCES `skill_type` (`skill_id`);

--
-- Constraints for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD CONSTRAINT `FK_fp_user` FOREIGN KEY (`fp_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `industry`
--
ALTER TABLE `industry`
  ADD CONSTRAINT `FK_industry_admin` FOREIGN KEY (`industry_created_by`) REFERENCES `admin_management` (`am_id`),
  ADD CONSTRAINT `FK_industry_city` FOREIGN KEY (`industry_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_industry_country` FOREIGN KEY (`industry_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_industry_field` FOREIGN KEY (`industry_industry_field_id`) REFERENCES `industry_field` (`industry_field_id`),
  ADD CONSTRAINT `FK_industry_role` FOREIGN KEY (`industry_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_industry_state` FOREIGN KEY (`industry_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_industry_user` FOREIGN KEY (`industry_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `institution`
--
ALTER TABLE `institution`
  ADD CONSTRAINT `FK_institution_role` FOREIGN KEY (`institution_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_institution_university` FOREIGN KEY (`institution_university_id`) REFERENCES `university` (`university_id`),
  ADD CONSTRAINT `FK_institution_user` FOREIGN KEY (`institution_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `FK_job_category` FOREIGN KEY (`job_category_id`) REFERENCES `job_category` (`jc_id`),
  ADD CONSTRAINT `FK_job_industry` FOREIGN KEY (`job_industry_id`) REFERENCES `industry` (`industry_id`),
  ADD CONSTRAINT `FK_job_position` FOREIGN KEY (`job_position_id`) REFERENCES `job_position` (`jp_id`);

--
-- Constraints for table `job_skill_set`
--
ALTER TABLE `job_skill_set`
  ADD CONSTRAINT `FK_jss_job` FOREIGN KEY (`jss_job_id`) REFERENCES `job` (`job_id`);

--
-- Constraints for table `job_student_university_application`
--
ALTER TABLE `job_student_university_application`
  ADD CONSTRAINT `FK_jsua_job` FOREIGN KEY (`jsua_job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `FK_jsua_student_university` FOREIGN KEY (`jsua_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `FK_lecturer_city` FOREIGN KEY (`lecturer_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_lecturer_country` FOREIGN KEY (`lecturer_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_lecturer_created` FOREIGN KEY (`lecturer_created_by`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_lecturer_institution` FOREIGN KEY (`lecturer_institution_id`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_lecturer_role` FOREIGN KEY (`lecturer_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_lecturer_state` FOREIGN KEY (`lecturer_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_lecturer_user` FOREIGN KEY (`lecturer_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `lecturer_education_degree`
--
ALTER TABLE `lecturer_education_degree`
  ADD CONSTRAINT `FK_lectdeg_degree` FOREIGN KEY (`lectdeg_degree_id`) REFERENCES `degree` (`degree_id`),
  ADD CONSTRAINT `FK_lectdeg_field` FOREIGN KEY (`lectdeg_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_lectdeg_lecturer` FOREIGN KEY (`lectdeg_lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
  ADD CONSTRAINT `FK_lectdeg_university` FOREIGN KEY (`lectdeg_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `lecturer_education_diploma`
--
ALTER TABLE `lecturer_education_diploma`
  ADD CONSTRAINT `FK_lectdip_diploma` FOREIGN KEY (`lectdip_diploma_id`) REFERENCES `diploma` (`diploma_id`),
  ADD CONSTRAINT `FK_lectdip_field` FOREIGN KEY (`lectdip_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_lectdip_lecturer` FOREIGN KEY (`lectdip_lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
  ADD CONSTRAINT `FK_lectdip_university` FOREIGN KEY (`lectdip_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `lecturer_education_master`
--
ALTER TABLE `lecturer_education_master`
  ADD CONSTRAINT `FK_lectm_field` FOREIGN KEY (`lectm_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_lectm_lecturer` FOREIGN KEY (`lectm_lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
  ADD CONSTRAINT `FK_lectm_master` FOREIGN KEY (`lectm_master_id`) REFERENCES `master` (`master_id`),
  ADD CONSTRAINT `FK_lectm_university` FOREIGN KEY (`lectm_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `lecturer_education_phd`
--
ALTER TABLE `lecturer_education_phd`
  ADD CONSTRAINT `FK_lectp_field` FOREIGN KEY (`lectp_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_lectp_lecturer` FOREIGN KEY (`lectp_lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
  ADD CONSTRAINT `FK_lectp_phd` FOREIGN KEY (`lectp_phd_id`) REFERENCES `phd` (`phd_id`),
  ADD CONSTRAINT `FK_lectp_university` FOREIGN KEY (`lectp_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `lecturer_experience_details`
--
ALTER TABLE `lecturer_experience_details`
  ADD CONSTRAINT `FK_led_job_city` FOREIGN KEY (`led_job_location_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_led_job_country` FOREIGN KEY (`led_job_location_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_led_job_state` FOREIGN KEY (`led_job_location_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_led_lecturer` FOREIGN KEY (`led_lecturer_id`) REFERENCES `lecturer` (`lecturer_id`);

--
-- Constraints for table `lecturer_skill_set`
--
ALTER TABLE `lecturer_skill_set`
  ADD CONSTRAINT `FK_lss_lecturer` FOREIGN KEY (`lss_lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
  ADD CONSTRAINT `FK_lss_skill` FOREIGN KEY (`lss_skill_type_id`) REFERENCES `skill_type` (`skill_id`);

--
-- Constraints for table `mc_assignment`
--
ALTER TABLE `mc_assignment`
  ADD CONSTRAINT `FK_mca_createdby` FOREIGN KEY (`mca_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mca_mc` FOREIGN KEY (`mca_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_course_credit_transfer`
--
ALTER TABLE `mc_course_credit_transfer`
  ADD CONSTRAINT `FK_mccct_createdby` FOREIGN KEY (`mccct_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mccct_microcredential_id` FOREIGN KEY (`mccct_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_enrolment_session`
--
ALTER TABLE `mc_enrolment_session`
  ADD CONSTRAINT `FK_mcls_mc` FOREIGN KEY (`mces_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_learning_details`
--
ALTER TABLE `mc_learning_details`
  ADD CONSTRAINT `FK_mcld_microcredential_id` FOREIGN KEY (`mcld_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_notes`
--
ALTER TABLE `mc_notes`
  ADD CONSTRAINT `FK_mcn_createdby` FOREIGN KEY (`mcn_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcn_mc` FOREIGN KEY (`mcn_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_project`
--
ALTER TABLE `mc_project`
  ADD CONSTRAINT `FK_mcp_createdby` FOREIGN KEY (`mcp_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcp_mc` FOREIGN KEY (`mcp_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_project_duedate`
--
ALTER TABLE `mc_project_duedate`
  ADD CONSTRAINT `FK_mcpd_mcproject` FOREIGN KEY (`mcpd_mc_project_id`) REFERENCES `mc_project` (`mcp_id`);

--
-- Constraints for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  ADD CONSTRAINT `FK_mcq_createdby` FOREIGN KEY (`mcq_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcq_mc` FOREIGN KEY (`mcq_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_quiz_answer`
--
ALTER TABLE `mc_quiz_answer`
  ADD CONSTRAINT `FK_mcqa_mcquizquestion` FOREIGN KEY (`mcqa_mc_quiz_question_id`) REFERENCES `mc_quiz_question` (`mcqq_id`);

--
-- Constraints for table `mc_quiz_question`
--
ALTER TABLE `mc_quiz_question`
  ADD CONSTRAINT `FK_mcqq_mcquiz` FOREIGN KEY (`mcqq_mc_quiz_id`) REFERENCES `mc_quiz` (`mcq_id`);

--
-- Constraints for table `mc_slide`
--
ALTER TABLE `mc_slide`
  ADD CONSTRAINT `FK_mcs_createdby` FOREIGN KEY (`mcs_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcs_mc` FOREIGN KEY (`mcs_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_test`
--
ALTER TABLE `mc_test`
  ADD CONSTRAINT `FK_mct_createdby` FOREIGN KEY (`mct_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mct_mc` FOREIGN KEY (`mct_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_test_answer`
--
ALTER TABLE `mc_test_answer`
  ADD CONSTRAINT `FK_mcta_mctestquestion` FOREIGN KEY (`mcta_mc_test_question_id`) REFERENCES `mc_test_question` (`mctq_id`);

--
-- Constraints for table `mc_test_question`
--
ALTER TABLE `mc_test_question`
  ADD CONSTRAINT `FK_mctq_mctest` FOREIGN KEY (`mctq_mc_test_id`) REFERENCES `mc_test` (`mct_id`);

--
-- Constraints for table `mc_tutorial`
--
ALTER TABLE `mc_tutorial`
  ADD CONSTRAINT `FK_mctu_createdby` FOREIGN KEY (`mctu_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mctu_mc` FOREIGN KEY (`mctu_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `mc_tutorial_duedate`
--
ALTER TABLE `mc_tutorial_duedate`
  ADD CONSTRAINT `FK_mctud_mctutorial` FOREIGN KEY (`mctud_mc_tutorial_id`) REFERENCES `mc_tutorial` (`mctu_id`);

--
-- Constraints for table `mc_video`
--
ALTER TABLE `mc_video`
  ADD CONSTRAINT `FK_mcv_createdby` FOREIGN KEY (`mcv_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcv_mc` FOREIGN KEY (`mcv_mc_id`) REFERENCES `microcredential` (`mc_id`);

--
-- Constraints for table `microcredential`
--
ALTER TABLE `microcredential`
  ADD CONSTRAINT `FK_mc_createdby` FOREIGN KEY (`mc_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mc_institution` FOREIGN KEY (`mc_owner`) REFERENCES `institution` (`institution_id`);

--
-- Constraints for table `postcode`
--
ALTER TABLE `postcode`
  ADD CONSTRAINT `FK_postcode_city` FOREIGN KEY (`postcode_city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `FK_state_country` FOREIGN KEY (`state_country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `student_university`
--
ALTER TABLE `student_university`
  ADD CONSTRAINT `FK_su_city` FOREIGN KEY (`su_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_su_country` FOREIGN KEY (`su_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_su_institution` FOREIGN KEY (`su_institution_id`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_su_role` FOREIGN KEY (`su_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_su_state` FOREIGN KEY (`su_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_su_user` FOREIGN KEY (`su_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `student_university_education_degree`
--
ALTER TABLE `student_university_education_degree`
  ADD CONSTRAINT `FK_suedeg_degree` FOREIGN KEY (`suedeg_degree_id`) REFERENCES `degree` (`degree_id`),
  ADD CONSTRAINT `FK_suedeg_field` FOREIGN KEY (`suedeg_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_suedeg_student_university` FOREIGN KEY (`suedeg_student_university_id`) REFERENCES `student_university` (`su_id`),
  ADD CONSTRAINT `FK_suedeg_university` FOREIGN KEY (`suedeg_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `student_university_education_diploma`
--
ALTER TABLE `student_university_education_diploma`
  ADD CONSTRAINT `FK_suedip_diploma` FOREIGN KEY (`suedip_diploma_id`) REFERENCES `diploma` (`diploma_id`),
  ADD CONSTRAINT `FK_suedip_field` FOREIGN KEY (`suedip_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_suedip_student_university` FOREIGN KEY (`suedip_student_university_id`) REFERENCES `student_university` (`su_id`),
  ADD CONSTRAINT `FK_suedip_university` FOREIGN KEY (`suedip_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `student_university_education_master`
--
ALTER TABLE `student_university_education_master`
  ADD CONSTRAINT `FK_suem_field` FOREIGN KEY (`suem_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_suem_master` FOREIGN KEY (`suem_master_id`) REFERENCES `master` (`master_id`),
  ADD CONSTRAINT `FK_suem_student_university` FOREIGN KEY (`suem_student_university_id`) REFERENCES `student_university` (`su_id`),
  ADD CONSTRAINT `FK_suem_university` FOREIGN KEY (`suem_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `student_university_education_phd`
--
ALTER TABLE `student_university_education_phd`
  ADD CONSTRAINT `FK_suep_field` FOREIGN KEY (`suep_field_id`) REFERENCES `field` (`field_id`),
  ADD CONSTRAINT `FK_suep_phd` FOREIGN KEY (`suep_phd_id`) REFERENCES `phd` (`phd_id`),
  ADD CONSTRAINT `FK_suep_student_university` FOREIGN KEY (`suep_student_university_id`) REFERENCES `student_university` (`su_id`),
  ADD CONSTRAINT `FK_suep_university` FOREIGN KEY (`suep_university_id`) REFERENCES `university` (`university_id`);

--
-- Constraints for table `student_university_experience_details`
--
ALTER TABLE `student_university_experience_details`
  ADD CONSTRAINT `FK_sued_job_city` FOREIGN KEY (`sued_job_location_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_sued_job_country` FOREIGN KEY (`sued_job_location_country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `FK_sued_job_state` FOREIGN KEY (`sued_job_location_state_id`) REFERENCES `state` (`state_id`),
  ADD CONSTRAINT `FK_sued_student_university` FOREIGN KEY (`sued_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `student_university_skill_set`
--
ALTER TABLE `student_university_skill_set`
  ADD CONSTRAINT `FK_sus_skill_type` FOREIGN KEY (`sus_skill_type_id`) REFERENCES `skill_type` (`skill_id`),
  ADD CONSTRAINT `FK_sus_student_university` FOREIGN KEY (`sus_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_assignment_submission`
--
ALTER TABLE `studuni_course_assignment_submission`
  ADD CONSTRAINT `FK_sucas_course_assignment` FOREIGN KEY (`sucas_course_assignment_id`) REFERENCES `course_assignment` (`ca_id`),
  ADD CONSTRAINT `FK_sucas_student_university` FOREIGN KEY (`sucas_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_project_submission`
--
ALTER TABLE `studuni_course_project_submission`
  ADD CONSTRAINT `FK_sucps_course_project` FOREIGN KEY (`sucps_course_project_id`) REFERENCES `course_project` (`cp_id`),
  ADD CONSTRAINT `FK_sucps_student_university` FOREIGN KEY (`sucps_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_quiz_result`
--
ALTER TABLE `studuni_course_quiz_result`
  ADD CONSTRAINT `FK_sucqs_course_quiz` FOREIGN KEY (`sucqrs_course_quiz_id`) REFERENCES `course_quiz` (`cq_id`),
  ADD CONSTRAINT `FK_sucqs_student_university` FOREIGN KEY (`sucqrs_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_quiz_review`
--
ALTER TABLE `studuni_course_quiz_review`
  ADD CONSTRAINT `FK_sucqrv_course_quiz` FOREIGN KEY (`sucqrv_course_quiz_id`) REFERENCES `course_quiz` (`cq_id`),
  ADD CONSTRAINT `FK_sucqrv_course_quiz_question` FOREIGN KEY (`sucqrv_course_quiz_question_id`) REFERENCES `course_quiz_question` (`cqq_id`),
  ADD CONSTRAINT `FK_sucqrv_student_university` FOREIGN KEY (`sucqrv_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_test_result`
--
ALTER TABLE `studuni_course_test_result`
  ADD CONSTRAINT `FK_suctrs_course_test` FOREIGN KEY (`suctrs_course_test_id`) REFERENCES `course_test` (`ct_id`),
  ADD CONSTRAINT `FK_suctrs_student_university` FOREIGN KEY (`suctrs_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_test_review`
--
ALTER TABLE `studuni_course_test_review`
  ADD CONSTRAINT `FK_suctrv_student_university` FOREIGN KEY (`suctrv_student_university_id`) REFERENCES `student_university` (`su_id`),
  ADD CONSTRAINT `FK_suctrv_test` FOREIGN KEY (`suctrv_course_test_id`) REFERENCES `course_test` (`ct_id`),
  ADD CONSTRAINT `FK_suctrv_test_question` FOREIGN KEY (`suctrv_course_test_question_id`) REFERENCES `course_test_question` (`ctq_id`);

--
-- Constraints for table `studuni_course_tutorial_submission`
--
ALTER TABLE `studuni_course_tutorial_submission`
  ADD CONSTRAINT `FK_suctus_course_tutorial` FOREIGN KEY (`suctus_course_tutorial_id`) REFERENCES `course_tutorial` (`ctu_id`),
  ADD CONSTRAINT `FK_suctus_student_university` FOREIGN KEY (`suctus_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_course_watched_video`
--
ALTER TABLE `studuni_course_watched_video`
  ADD CONSTRAINT `FK_sucvw_course_video` FOREIGN KEY (`sucvw_course_video_id`) REFERENCES `course_video` (`cv_id`),
  ADD CONSTRAINT `FK_sucvw_student_university` FOREIGN KEY (`sucvw_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_assignment_submission`
--
ALTER TABLE `studuni_mc_assignment_submission`
  ADD CONSTRAINT `FK_sumcas_mc_assignment` FOREIGN KEY (`sumcas_mc_assignment_id`) REFERENCES `mc_assignment` (`mca_id`),
  ADD CONSTRAINT `FK_sumcas_student_university` FOREIGN KEY (`sumcas_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_project_submission`
--
ALTER TABLE `studuni_mc_project_submission`
  ADD CONSTRAINT `FK_sumcps_mc_project` FOREIGN KEY (`sumcps_mc_project_id`) REFERENCES `mc_project` (`mcp_id`),
  ADD CONSTRAINT `FK_sumcps_student_university` FOREIGN KEY (`sumcps_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_quiz_result`
--
ALTER TABLE `studuni_mc_quiz_result`
  ADD CONSTRAINT `FK_sumcqrs_mc_quiz` FOREIGN KEY (`sumcqrs_mc_quiz_id`) REFERENCES `mc_quiz` (`mcq_id`),
  ADD CONSTRAINT `FK_sumcqrs_student_university` FOREIGN KEY (`sumcqrs_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_quiz_review`
--
ALTER TABLE `studuni_mc_quiz_review`
  ADD CONSTRAINT `FK_sumcqrv_mc_quiz` FOREIGN KEY (`sumcqrv_mc_quiz_id`) REFERENCES `mc_quiz` (`mcq_id`),
  ADD CONSTRAINT `FK_sumcqrv_mc_quiz_question` FOREIGN KEY (`sumcqrv_mc_quiz_question_id`) REFERENCES `mc_quiz_question` (`mcqq_id`),
  ADD CONSTRAINT `FK_sumcqrv_student_university` FOREIGN KEY (`sumcqrv_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_test_result`
--
ALTER TABLE `studuni_mc_test_result`
  ADD CONSTRAINT `FK_sumctrs_mc_test` FOREIGN KEY (`sumctrs_mc_test_id`) REFERENCES `mc_test` (`mct_id`),
  ADD CONSTRAINT `FK_sumctrs_student_university` FOREIGN KEY (`sumctrs_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_test_review`
--
ALTER TABLE `studuni_mc_test_review`
  ADD CONSTRAINT `FK_sumctrv_student_university` FOREIGN KEY (`sumctrv_student_university_id`) REFERENCES `student_university` (`su_id`),
  ADD CONSTRAINT `FK_sumctrv_test` FOREIGN KEY (`sumctrv_mc_test_id`) REFERENCES `mc_test` (`mct_id`),
  ADD CONSTRAINT `FK_sumctrv_test_question` FOREIGN KEY (`sumctrv_mc_test_question_id`) REFERENCES `mc_test_question` (`mctq_id`);

--
-- Constraints for table `studuni_mc_tutorial_submission`
--
ALTER TABLE `studuni_mc_tutorial_submission`
  ADD CONSTRAINT `FK_sumctus_mc_tutorial` FOREIGN KEY (`sumctus_mc_tutorial_id`) REFERENCES `mc_tutorial` (`mctu_id`),
  ADD CONSTRAINT `FK_sumctus_student_university` FOREIGN KEY (`sumctus_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `studuni_mc_watched_video`
--
ALTER TABLE `studuni_mc_watched_video`
  ADD CONSTRAINT `FK_sumcvw_mc_video` FOREIGN KEY (`sumcvw_mc_video_id`) REFERENCES `mc_video` (`mcv_id`),
  ADD CONSTRAINT `FK_sumcvw_student_university` FOREIGN KEY (`sumcvw_student_university_id`) REFERENCES `student_university` (`su_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
