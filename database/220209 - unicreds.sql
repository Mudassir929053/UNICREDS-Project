-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2022 at 02:33 AM
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
  `admin_institution` int(11) DEFAULT NULL,
  `admin_created_date` datetime DEFAULT NULL,
  `admin_updated_date` datetime DEFAULT NULL,
  `admin_deleted_date` datetime DEFAULT NULL,
  `admin_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `announcement_admin`
--

CREATE TABLE `announcement_admin` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` tinytext NOT NULL,
  `announcement_receiver` varchar(125) NOT NULL,
  `announcement_message` text DEFAULT NULL,
  `announcement_attachment` tinytext DEFAULT NULL,
  `announcement_created_by` int(11) NOT NULL,
  `announcement_created_date` datetime NOT NULL,
  `announcement_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_committee`
--

CREATE TABLE `announcement_committee` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` tinytext NOT NULL,
  `announcement_receiver` varchar(125) NOT NULL,
  `announcement_message` text DEFAULT NULL,
  `announcement_attachment` tinytext DEFAULT NULL,
  `announcement_created_by` int(11) NOT NULL,
  `announcement_created_date` datetime NOT NULL,
  `announcement_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_industry`
--

CREATE TABLE `announcement_industry` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` tinytext NOT NULL,
  `announcement_receiver` varchar(125) NOT NULL,
  `announcement_message` text DEFAULT NULL,
  `announcement_attachment` tinytext DEFAULT NULL,
  `announcement_created_by` int(11) NOT NULL,
  `announcement_created_date` datetime NOT NULL,
  `announcement_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_institution`
--

CREATE TABLE `announcement_institution` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` tinytext NOT NULL,
  `announcement_receiver` varchar(125) NOT NULL,
  `announcement_message` text DEFAULT NULL,
  `announcement_attachment` tinytext DEFAULT NULL,
  `announcement_created_by` int(11) NOT NULL,
  `announcement_created_date` datetime NOT NULL,
  `announcement_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_lecturer`
--

CREATE TABLE `announcement_lecturer` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` tinytext NOT NULL,
  `announcement_receiver` varchar(125) NOT NULL,
  `announcement_message` text DEFAULT NULL,
  `announcement_attachment` tinytext DEFAULT NULL,
  `announcement_created_by` int(11) NOT NULL,
  `announcement_created_date` datetime NOT NULL,
  `announcement_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
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
  `committee_status` varchar(10) DEFAULT NULL,
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
  `course_published_date` datetime DEFAULT NULL,
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
  `cv_duration` varchar(255) DEFAULT NULL,
  `cv_created_date` datetime DEFAULT NULL,
  `cv_created_by` int(11) DEFAULT NULL,
  `cv_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
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

-- --------------------------------------------------------

--
-- Table structure for table `industry_field`
--

CREATE TABLE `industry_field` (
  `industry_field_id` int(11) NOT NULL,
  `industry_field_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_code` varchar(10) NOT NULL,
  `job_title` text NOT NULL,
  `job_description` longtext NOT NULL,
  `job_responsibility` longtext NOT NULL,
  `job_requirement` longtext NOT NULL,
  `job_date_posted` datetime NOT NULL,
  `job_no_of_vacancies` int(11) NOT NULL,
  `job_salary_currency` varchar(10) DEFAULT NULL,
  `job_min_salary` int(11) NOT NULL,
  `job_max_salary` int(11) NOT NULL,
  `job_type` enum('Full-Time','Part-Time','Temporary','Contract','Internship') NOT NULL,
  `job_category_id` int(11) NOT NULL,
  `job_position_id` int(11) DEFAULT NULL,
  `job_industry_id` int(11) NOT NULL,
  `job_level` enum('Entry Level','Manager','Senior Manager','Junior Executive','Senior Executive','Non Executive') NOT NULL,
  `job_experience_year` int(2) NOT NULL,
  `job_qualification` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `jc_id` int(11) NOT NULL,
  `jc_code` int(10) DEFAULT NULL,
  `jc_name` text NOT NULL,
  `jc_description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `job_student_university_application`
--

CREATE TABLE `job_student_university_application` (
  `jsua_id` int(11) NOT NULL,
  `jsua_job_id` int(11) NOT NULL,
  `jsua_student_university_id` int(11) NOT NULL,
  `jsua_application_date` datetime NOT NULL,
  `jsua_status` int(1) NOT NULL,
  `jsua_summary` longtext NOT NULL,
  `jsua_attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `mc_learning_details`
--

CREATE TABLE `mc_learning_details` (
  `mcld_id` int(11) NOT NULL,
  `mcld_mc_id` int(11) NOT NULL,
  `mcld_learning_outcome` longtext NOT NULL,
  `mcld_intended_learners` tinytext NOT NULL,
  `mcld_prerequisites` tinytext NOT NULL,
  `mcld_skills` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_mou`
--

CREATE TABLE `mc_mou` (
  `mcm_id` int(11) NOT NULL,
  `mcm_mc_id` int(11) NOT NULL,
  `mcm_institution_id` int(11) NOT NULL,
  `mcm_user_request_id` int(11) NOT NULL,
  `mcm_collaboration` longtext DEFAULT NULL,
  `mcm_attachment` varchar(255) NOT NULL,
  `mcm_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz_answer`
--

CREATE TABLE `mc_quiz_answer` (
  `mcqa_id` int(11) NOT NULL,
  `mcqa_mc_quiz_question_id` int(11) NOT NULL,
  `mcqa_answer1` text DEFAULT NULL,
  `mcqa_answer2` text DEFAULT NULL,
  `mcqa_answer3` text DEFAULT NULL,
  `mcqa_answer4` text DEFAULT NULL,
  `mcqa_right_answer` text NOT NULL,
  `mcqa_right_answerword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz_question`
--

CREATE TABLE `mc_quiz_question` (
  `mcqq_id` int(11) NOT NULL,
  `mcqq_mc_quiz_id` int(11) NOT NULL,
  `mcqq_type` varchar(125) DEFAULT NULL,
  `mcqq_question` text NOT NULL,
  `mcqq_score` float DEFAULT NULL,
  `mcqq_created_date` datetime DEFAULT current_timestamp(),
  `mcqq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcqq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `mc_test_question`
--

CREATE TABLE `mc_test_question` (
  `mctq_id` int(11) NOT NULL,
  `mctq_mc_test_id` int(11) NOT NULL,
  `mctq_type` varchar(125) NOT NULL,
  `mctq_question` text NOT NULL,
  `mctq_score` float NOT NULL,
  `mctq_created_date` datetime DEFAULT current_timestamp(),
  `mctq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mctq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `mctu_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mctu_deleted_date` datetime DEFAULT NULL,
  `mctu_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_tutorial_duedate`
--

CREATE TABLE `mc_tutorial_duedate` (
  `mctud_id` int(11) NOT NULL,
  `mctud_mc_tutorial_id` int(11) NOT NULL,
  `mctud_duedate_date` date NOT NULL,
  `mctud_duedate_time` time NOT NULL,
  `mctud_duedate_gmt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `mc_credit` varchar(10) NOT NULL,
  `mc_credit_transfer` varchar(10) DEFAULT NULL,
  `mc_total_enrolled` int(11) NOT NULL,
  `mc_created_by` int(11) DEFAULT NULL,
  `mc_owner` int(11) DEFAULT NULL,
  `mc_created_date` datetime DEFAULT current_timestamp(),
  `mc_published_date` datetime DEFAULT NULL,
  `mc_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mc_deleted_date` datetime DEFAULT NULL,
  `mc_image` text NOT NULL,
  `mc_status` varchar(100) DEFAULT NULL,
  `mc_enrollment_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `review_microcredential`
--

CREATE TABLE `review_microcredential` (
  `rmc_id` int(11) NOT NULL,
  `rmc_mc_id` int(11) NOT NULL,
  `rmc_institution_id` int(11) NOT NULL,
  `rmc_user_request` int(11) NOT NULL,
  `rmc_user_review` int(11) DEFAULT NULL,
  `rmc_status` varchar(100) NOT NULL,
  `rmc_comment` longtext DEFAULT NULL,
  `rmc_date_request` datetime DEFAULT NULL,
  `rmc_date_review` datetime DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `skill_type`
--

CREATE TABLE `skill_type` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `su_updated_date` datetime DEFAULT NULL,
  `su_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `sued_description` varchar(255) NOT NULL,
  `sued_company_name` text NOT NULL,
  `sued_start_date` date NOT NULL,
  `sued_end_date` date NOT NULL,
  `sued_job_status` enum('Current','Past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_university_skill_set`
--

CREATE TABLE `student_university_skill_set` (
  `sus_id` int(11) NOT NULL,
  `sus_student_university_id` int(11) NOT NULL,
  `sus_skill_type_id` int(11) NOT NULL,
  `sus_skill_level` enum('Beginner','Intermediate','Advance') NOT NULL,
  `sus_skill_certificate` varchar(255) NOT NULL,
  `sus_certificate_provider` text DEFAULT NULL,
  `sus_certificate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `FK_admin_role` (`admin_role_id`),
  ADD KEY `FK_admin_institution` (`admin_institution`);

--
-- Indexes for table `admin_management`
--
ALTER TABLE `admin_management`
  ADD PRIMARY KEY (`am_id`),
  ADD KEY `FK_am_admin` (`am_admin_id`);

--
-- Indexes for table `announcement_admin`
--
ALTER TABLE `announcement_admin`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `FK_announcement_admin` (`announcement_created_by`);

--
-- Indexes for table `announcement_committee`
--
ALTER TABLE `announcement_committee`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `FK_ac_committee` (`announcement_created_by`);

--
-- Indexes for table `announcement_industry`
--
ALTER TABLE `announcement_industry`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `announcement_institution`
--
ALTER TABLE `announcement_institution`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `announcement_lecturer`
--
ALTER TABLE `announcement_lecturer`
  ADD PRIMARY KEY (`announcement_id`);

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
  ADD KEY `FK_course_user` (`course_created_by`),
  ADD KEY `FK_course_owner` (`course_owner`);

--
-- Indexes for table `course_assignment`
--
ALTER TABLE `course_assignment`
  ADD PRIMARY KEY (`ca_id`),
  ADD KEY `FK_ca_createdby` (`ca_created_by`),
  ADD KEY `FK_ca_course` (`ca_course_id`);

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
  ADD KEY `FK_ci_instructor` (`ci_user_id`),
  ADD KEY `FK_ci_course` (`ci_course_id`);

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
  ADD KEY `FK_cn_course` (`cn_course_id`);

--
-- Indexes for table `course_project`
--
ALTER TABLE `course_project`
  ADD PRIMARY KEY (`cp_id`),
  ADD KEY `FK_cp_createdby` (`cp_created_by`),
  ADD KEY `FK_cp_course` (`cp_course_id`);

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
  ADD KEY `FK_cs_createdby` (`cs_created_by`),
  ADD KEY `FK_cs_course` (`cs_course_id`);

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
  ADD KEY `FK_cv_createdby` (`cv_created_by`),
  ADD KEY `FK_cv_course` (`cv_course_id`);

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
  ADD PRIMARY KEY (`ecsu_id`);

--
-- Indexes for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  ADD PRIMARY KEY (`emcsu_id`),
  ADD KEY `FK_emcsu_studuni` (`emcsu_student_university_id`),
  ADD KEY `FK_emcsu_mc` (`emcsu_mc_id`);

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
  ADD KEY `FK_mccct_createdby` (`mccct_created_by`),
  ADD KEY `FK_mccct_microcredential_id` (`mccct_mc_id`);

--
-- Indexes for table `mc_enrolment_session`
--
ALTER TABLE `mc_enrolment_session`
  ADD PRIMARY KEY (`mces_id`),
  ADD KEY `FK_mces_mc` (`mces_mc_id`);

--
-- Indexes for table `mc_instructor`
--
ALTER TABLE `mc_instructor`
  ADD PRIMARY KEY (`mci_id`);

--
-- Indexes for table `mc_learning_details`
--
ALTER TABLE `mc_learning_details`
  ADD PRIMARY KEY (`mcld_id`),
  ADD KEY `FK_mcld_microcredential_id` (`mcld_mc_id`);

--
-- Indexes for table `mc_mou`
--
ALTER TABLE `mc_mou`
  ADD PRIMARY KEY (`mcm_id`),
  ADD KEY `FK_mcm_mc` (`mcm_mc_id`),
  ADD KEY `FK_mcm_institution` (`mcm_institution_id`),
  ADD KEY `FK_mcm_user` (`mcm_user_request_id`);

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
  ADD KEY `FK_mcp_createdby` (`mcp_created_by`),
  ADD KEY `FK_mcp_mc` (`mcp_mc_id`);

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
  ADD PRIMARY KEY (`rmc_id`),
  ADD KEY `FK_rmc_mc` (`rmc_mc_id`),
  ADD KEY `FK_rmc_institution` (`rmc_institution_id`),
  ADD KEY `FK_rmc_user_request` (`rmc_user_request`),
  ADD KEY `FK_rmc_user_review` (`rmc_user_review`);

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
  ADD KEY `FK_sued_job_country` (`sued_job_location_country_id`);

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
  ADD KEY `FK_sucas_student_university` (`sucas_student_university_id`),
  ADD KEY `FK_sucas_course_assignment` (`sucas_course_assignment_id`);

--
-- Indexes for table `studuni_course_project_submission`
--
ALTER TABLE `studuni_course_project_submission`
  ADD PRIMARY KEY (`sucps_id`),
  ADD KEY `FK_sucps_student_university` (`sucps_student_university_id`),
  ADD KEY `FK_sucps_course_project` (`sucps_course_project_id`);

--
-- Indexes for table `studuni_course_quiz_result`
--
ALTER TABLE `studuni_course_quiz_result`
  ADD PRIMARY KEY (`sucqrs_id`),
  ADD KEY `FK_sucqs_student_university` (`sucqrs_student_university_id`),
  ADD KEY `FK_sucqs_course_quiz` (`sucqrs_course_quiz_id`);

--
-- Indexes for table `studuni_course_quiz_review`
--
ALTER TABLE `studuni_course_quiz_review`
  ADD PRIMARY KEY (`sucqrv_id`),
  ADD KEY `FK_sucqr_student_university` (`sucqrv_student_university_id`),
  ADD KEY `FK_sucqr_course_quiz_question` (`sucqrv_course_quiz_question_id`),
  ADD KEY `FK_sucqr_course_quiz` (`sucqrv_course_quiz_id`);

--
-- Indexes for table `studuni_course_test_result`
--
ALTER TABLE `studuni_course_test_result`
  ADD PRIMARY KEY (`suctrs_id`),
  ADD KEY `FK_sucts_student_university` (`suctrs_student_university_id`),
  ADD KEY `FK_sucts_course_test` (`suctrs_course_test_id`);

--
-- Indexes for table `studuni_course_test_review`
--
ALTER TABLE `studuni_course_test_review`
  ADD PRIMARY KEY (`suctrv_id`),
  ADD KEY `FK_suctr_student_university` (`suctrv_student_university_id`),
  ADD KEY `FK_suctr_course_test_question` (`suctrv_course_test_question_id`),
  ADD KEY `FK_suctr_course_test` (`suctrv_course_test_id`);

--
-- Indexes for table `studuni_course_tutorial_submission`
--
ALTER TABLE `studuni_course_tutorial_submission`
  ADD PRIMARY KEY (`suctus_id`),
  ADD KEY `FK_suctus_student_university` (`suctus_student_university_id`),
  ADD KEY `FK_suctus_course_tutorial` (`suctus_course_tutorial_id`);

--
-- Indexes for table `studuni_course_watched_video`
--
ALTER TABLE `studuni_course_watched_video`
  ADD PRIMARY KEY (`sucvw_id`),
  ADD KEY `FK_sucvw_student_university` (`sucvw_student_university_id`),
  ADD KEY `FK_sucvw_course_video` (`sucvw_course_video_id`);

--
-- Indexes for table `studuni_mc_assignment_submission`
--
ALTER TABLE `studuni_mc_assignment_submission`
  ADD PRIMARY KEY (`sumcas_id`),
  ADD KEY `FK_sumcas_student_university` (`sumcas_student_university_id`),
  ADD KEY `FK_sumcas_mc_assignment` (`sumcas_mc_assignment_id`);

--
-- Indexes for table `studuni_mc_project_submission`
--
ALTER TABLE `studuni_mc_project_submission`
  ADD PRIMARY KEY (`sumcps_id`),
  ADD KEY `FK_sumcps_student_university` (`sumcps_student_university_id`),
  ADD KEY `FK_sumcps_mc_project` (`sumcps_mc_project_id`);

--
-- Indexes for table `studuni_mc_quiz_result`
--
ALTER TABLE `studuni_mc_quiz_result`
  ADD PRIMARY KEY (`sumcqrs_id`),
  ADD KEY `FK_sumcqs_student_university` (`sumcqrs_student_university_id`),
  ADD KEY `FK_sumcqs_mc_quiz` (`sumcqrs_mc_quiz_id`);

--
-- Indexes for table `studuni_mc_quiz_review`
--
ALTER TABLE `studuni_mc_quiz_review`
  ADD PRIMARY KEY (`sumcqrv_id`),
  ADD KEY `FK_sumcqr_student_university` (`sumcqrv_student_university_id`),
  ADD KEY `FK_sumcqr_mc_quiz_question` (`sumcqrv_mc_quiz_question_id`),
  ADD KEY `FK_sumcqr_mc_quiz` (`sumcqrv_mc_quiz_id`);

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
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_management`
--
ALTER TABLE `admin_management`
  MODIFY `am_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_admin`
--
ALTER TABLE `announcement_admin`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_committee`
--
ALTER TABLE `announcement_committee`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_industry`
--
ALTER TABLE `announcement_industry`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_institution`
--
ALTER TABLE `announcement_institution`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_lecturer`
--
ALTER TABLE `announcement_lecturer`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `emcsu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `expert_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industry_field`
--
ALTER TABLE `industry_field`
  MODIFY `industry_field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `jc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_position`
--
ALTER TABLE `job_position`
  MODIFY `jp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_skill_set`
--
ALTER TABLE `job_skill_set`
  MODIFY `jss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_student_university_application`
--
ALTER TABLE `job_student_university_application`
  MODIFY `jsua_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `mca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_assignment_duedate`
--
ALTER TABLE `mc_assignment_duedate`
  MODIFY `mcad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_course_credit_transfer`
--
ALTER TABLE `mc_course_credit_transfer`
  MODIFY `mccct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_enrolment_session`
--
ALTER TABLE `mc_enrolment_session`
  MODIFY `mces_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_instructor`
--
ALTER TABLE `mc_instructor`
  MODIFY `mci_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_learning_details`
--
ALTER TABLE `mc_learning_details`
  MODIFY `mcld_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_mou`
--
ALTER TABLE `mc_mou`
  MODIFY `mcm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_notes`
--
ALTER TABLE `mc_notes`
  MODIFY `mcn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_project`
--
ALTER TABLE `mc_project`
  MODIFY `mcp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_project_duedate`
--
ALTER TABLE `mc_project_duedate`
  MODIFY `mcpd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  MODIFY `mcq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_quiz_answer`
--
ALTER TABLE `mc_quiz_answer`
  MODIFY `mcqa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_quiz_question`
--
ALTER TABLE `mc_quiz_question`
  MODIFY `mcqq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_slide`
--
ALTER TABLE `mc_slide`
  MODIFY `mcs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_test`
--
ALTER TABLE `mc_test`
  MODIFY `mct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_test_answer`
--
ALTER TABLE `mc_test_answer`
  MODIFY `mcta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_test_question`
--
ALTER TABLE `mc_test_question`
  MODIFY `mctq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_tutorial`
--
ALTER TABLE `mc_tutorial`
  MODIFY `mctu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_tutorial_duedate`
--
ALTER TABLE `mc_tutorial_duedate`
  MODIFY `mctud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_video`
--
ALTER TABLE `mc_video`
  MODIFY `mcv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `microcredential`
--
ALTER TABLE `microcredential`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phd`
--
ALTER TABLE `phd`
  MODIFY `phd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postcode`
--
ALTER TABLE `postcode`
  MODIFY `postcode_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_microcredential`
--
ALTER TABLE `review_microcredential`
  MODIFY `rmc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skill_type`
--
ALTER TABLE `skill_type`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_university`
--
ALTER TABLE `student_university`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `sued_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_university_skill_set`
--
ALTER TABLE `student_university_skill_set`
  MODIFY `sus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_admin_institution` FOREIGN KEY (`admin_institution`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_admin_role` FOREIGN KEY (`admin_role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `FK_admin_user` FOREIGN KEY (`admin_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `admin_management`
--
ALTER TABLE `admin_management`
  ADD CONSTRAINT `FK_am_admin` FOREIGN KEY (`am_admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `announcement_admin`
--
ALTER TABLE `announcement_admin`
  ADD CONSTRAINT `FK_announcement_admin` FOREIGN KEY (`announcement_created_by`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `announcement_committee`
--
ALTER TABLE `announcement_committee`
  ADD CONSTRAINT `FK_ac_committee` FOREIGN KEY (`announcement_created_by`) REFERENCES `committee` (`committee_id`);

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
  ADD CONSTRAINT `FK_ca_course` FOREIGN KEY (`ca_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ca_createdby` FOREIGN KEY (`ca_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_assignment_duedate`
--
ALTER TABLE `course_assignment_duedate`
  ADD CONSTRAINT `FK_cad_ca` FOREIGN KEY (`cad_course_assignment_id`) REFERENCES `course_assignment` (`ca_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `FK_ci_instructor` FOREIGN KEY (`ci_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_learning_details`
--
ALTER TABLE `course_learning_details`
  ADD CONSTRAINT `FK_cld_course` FOREIGN KEY (`cld_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_notes`
--
ALTER TABLE `course_notes`
  ADD CONSTRAINT `FK_cn_course` FOREIGN KEY (`cn_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_project`
--
ALTER TABLE `course_project`
  ADD CONSTRAINT `FK_cp_course` FOREIGN KEY (`cp_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cp_createdby` FOREIGN KEY (`cp_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `course_project_duedate`
--
ALTER TABLE `course_project_duedate`
  ADD CONSTRAINT `FK_cpd_cp` FOREIGN KEY (`cpd_course_project_id`) REFERENCES `course_project` (`cp_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `FK_cs_course` FOREIGN KEY (`cs_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `FK_cv_course` FOREIGN KEY (`cv_course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cv_createdby` FOREIGN KEY (`cv_created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  ADD CONSTRAINT `FK_emcsu_mc` FOREIGN KEY (`emcsu_mc_id`) REFERENCES `microcredential` (`mc_id`),
  ADD CONSTRAINT `FK_emcsu_studuni` FOREIGN KEY (`emcsu_student_university_id`) REFERENCES `student_university` (`su_id`);

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
  ADD CONSTRAINT `FK_mca_mc` FOREIGN KEY (`mca_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_assignment_duedate`
--
ALTER TABLE `mc_assignment_duedate`
  ADD CONSTRAINT `FK_mcad_mca` FOREIGN KEY (`mcad_mc_assignment_id`) REFERENCES `mc_assignment` (`mca_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_course_credit_transfer`
--
ALTER TABLE `mc_course_credit_transfer`
  ADD CONSTRAINT `FK_mccct_createdby` FOREIGN KEY (`mccct_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mccct_microcredential_id` FOREIGN KEY (`mccct_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_enrolment_session`
--
ALTER TABLE `mc_enrolment_session`
  ADD CONSTRAINT `FK_mces_mc` FOREIGN KEY (`mces_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_learning_details`
--
ALTER TABLE `mc_learning_details`
  ADD CONSTRAINT `FK_mcld_microcredential_id` FOREIGN KEY (`mcld_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_mou`
--
ALTER TABLE `mc_mou`
  ADD CONSTRAINT `FK_mcm_institution` FOREIGN KEY (`mcm_institution_id`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_mcm_mc` FOREIGN KEY (`mcm_mc_id`) REFERENCES `microcredential` (`mc_id`),
  ADD CONSTRAINT `FK_mcm_user` FOREIGN KEY (`mcm_user_request_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `mc_notes`
--
ALTER TABLE `mc_notes`
  ADD CONSTRAINT `FK_mcn_createdby` FOREIGN KEY (`mcn_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcn_mc` FOREIGN KEY (`mcn_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_project`
--
ALTER TABLE `mc_project`
  ADD CONSTRAINT `FK_mcp_createdby` FOREIGN KEY (`mcp_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcp_mc` FOREIGN KEY (`mcp_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_project_duedate`
--
ALTER TABLE `mc_project_duedate`
  ADD CONSTRAINT `FK_mcpd_mcproject` FOREIGN KEY (`mcpd_mc_project_id`) REFERENCES `mc_project` (`mcp_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_quiz`
--
ALTER TABLE `mc_quiz`
  ADD CONSTRAINT `FK_mcq_createdby` FOREIGN KEY (`mcq_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcq_mc` FOREIGN KEY (`mcq_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_quiz_answer`
--
ALTER TABLE `mc_quiz_answer`
  ADD CONSTRAINT `FK_mcqa_mcquizquestion` FOREIGN KEY (`mcqa_mc_quiz_question_id`) REFERENCES `mc_quiz_question` (`mcqq_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_quiz_question`
--
ALTER TABLE `mc_quiz_question`
  ADD CONSTRAINT `FK_mcqq_mcquiz` FOREIGN KEY (`mcqq_mc_quiz_id`) REFERENCES `mc_quiz` (`mcq_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_slide`
--
ALTER TABLE `mc_slide`
  ADD CONSTRAINT `FK_mcs_createdby` FOREIGN KEY (`mcs_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcs_mc` FOREIGN KEY (`mcs_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_test`
--
ALTER TABLE `mc_test`
  ADD CONSTRAINT `FK_mct_createdby` FOREIGN KEY (`mct_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mct_mc` FOREIGN KEY (`mct_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_test_answer`
--
ALTER TABLE `mc_test_answer`
  ADD CONSTRAINT `FK_mcta_mctestquestion` FOREIGN KEY (`mcta_mc_test_question_id`) REFERENCES `mc_test_question` (`mctq_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_test_question`
--
ALTER TABLE `mc_test_question`
  ADD CONSTRAINT `FK_mctq_mctest` FOREIGN KEY (`mctq_mc_test_id`) REFERENCES `mc_test` (`mct_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_tutorial`
--
ALTER TABLE `mc_tutorial`
  ADD CONSTRAINT `FK_mctu_createdby` FOREIGN KEY (`mctu_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mctu_mc` FOREIGN KEY (`mctu_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_tutorial_duedate`
--
ALTER TABLE `mc_tutorial_duedate`
  ADD CONSTRAINT `FK_mctud_mctutorial` FOREIGN KEY (`mctud_mc_tutorial_id`) REFERENCES `mc_tutorial` (`mctu_id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_video`
--
ALTER TABLE `mc_video`
  ADD CONSTRAINT `FK_mcv_createdby` FOREIGN KEY (`mcv_created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_mcv_mc` FOREIGN KEY (`mcv_mc_id`) REFERENCES `microcredential` (`mc_id`) ON DELETE CASCADE;

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
-- Constraints for table `review_microcredential`
--
ALTER TABLE `review_microcredential`
  ADD CONSTRAINT `FK_rmc_institution` FOREIGN KEY (`rmc_institution_id`) REFERENCES `institution` (`institution_id`),
  ADD CONSTRAINT `FK_rmc_mc` FOREIGN KEY (`rmc_mc_id`) REFERENCES `microcredential` (`mc_id`),
  ADD CONSTRAINT `FK_rmc_user_request` FOREIGN KEY (`rmc_user_request`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_rmc_user_review` FOREIGN KEY (`rmc_user_review`) REFERENCES `user` (`user_id`);

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
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
