-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 08:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

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
(1, 53, 'Bachelor of Computer Science (Software Engineering)', '<p><strong>INTRODUCTION</strong></p><p>Software Engineering uses an engineering approach in the development, operation and maintenance of large scale software. A software engineer needs to be able to employ systematic technical and management methods in the creation of high quality software. The Bachelor of Computer Science specializing in Software Engineering is designed to support the nation’s need for professional and capable software engineers to undertake the task of increasing the effectiveness and performance of both the public and private sectors. To further support this goal, the course is closely associated with the Malaysian Software Testing Board (MSTB) certifications and Hewlett-Packard (HP) Software Testing Program.</p>', 'degree', '4 Years', 'RM 24000', 128, NULL, 2, '2021-10-07 10:05:48', NULL, NULL, '20211007100548dept-software-engineering-header.png'),
(2, 84, 'Bachelor of Civil Engineering', '<p>Bachelor of Civil Engineering with Honours is a 4-year programme and aims to produce qualified civil engineers who are competent, creative, highly dedicated graduates and able to find solutions to diverse problems through innovative thinking. Modules include all disciplines in the civil engineering.</p>', 'degree', '4 Years', 'RM 2500', 128, NULL, 5, '2021-10-07 12:50:59', NULL, NULL, '20211007125059englast22.png');

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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user_id`, `admin_name`, `admin_email`, `admin_role_id`, `admin_institution`, `admin_created_date`, `admin_updated_date`, `admin_deleted_date`, `admin_logo`) VALUES
(1, 27, 'UNICREDS ADMIN', 'admin_unicreds@edess.asia', 1, 1, '2021-09-21 08:27:50', NULL, NULL, NULL),
(2, 28, 'ADMIN MANAGEMENT', 'unicreds2@edess.asia', 2, NULL, '2021-09-21 08:47:48', NULL, NULL, ''),
(3, 65, 'ADMIN FINANCE 1', 'unicredfinance1@yahoo.com', 2, NULL, '2022-01-27 12:23:14', '2022-01-27 12:23:27', '2022-01-27 12:23:32', NULL);

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

--
-- Dumping data for table `announcement_admin`
--

INSERT INTO `announcement_admin` (`announcement_id`, `announcement_title`, `announcement_receiver`, `announcement_message`, `announcement_attachment`, `announcement_created_by`, `announcement_created_date`, `announcement_updated_date`) VALUES
(2, 'Test', '2,3,4,5,7', '<p>test 123</p>', '2022011815412520210830154927Invoice - Bootstrap Themes.pdf', 1, '2022-01-18 15:41:25', '2022-01-23 10:17:49'),
(3, 'Pengumuman Cuba-cuba Sahaja', '4', '<p>Pengumuman ini adalah bertujuan untuk melakukan percubaan</p>', '20220119123843210304  JADUAL LATIHAN DALAM TALIAN BAGI PENGGUNAAN SISTEM ALBAYEN - JAINJ v2.pdf', 1, '2022-01-19 12:38:43', NULL),
(4, 'Percubaan Pengumuman Untuk Kali-3', '4', '<p>Percubaan untuk membuat pengumuman&nbsp;</p>', '', 1, '2022-01-19 12:40:11', NULL),
(5, 'Pengumuman Cuba Cuba Sahaja', '4', '<p>pengumuman untuk percubaan tipu tipu</p>', '', 1, '2022-01-19 12:42:07', NULL),
(6, 'Pengumuman ', '4', '<p>Assalamualaikum w.b.t,</p><p>Alhamdulillah, kami dengan sukacitanya ingin memaklumkan kepada asatizah bahawa kami telah menerbitkan e-Majalah Edisi Keempat MindLoops: Edisi Cuti Sekolah yang diterbitkan secara khusus bagi Sistem Sokongan Pembelajaran dan Pengajaran Albayen.</p><p>Antara isi kandungan yang diletakkan di dalam e-Majalah MindLoops: Edisi Cuti Sekolah ini adalah:</p><p>1. Informasi<br>- Bibliografi Tokoh Pendidikan<br>- Tokoh Islamik<br>- Fun Fact Tokoh Islamik<br>- Tempat Melancong Ketika Cuti Sekolah<br>- Best Holiday<br>- Aktiviti Menarik Ketika Cuti Sekolah</p><p>2. Komik<br>- Komik Cuti Sekolah</p><p>3. Aktiviti<br>- Arabic Activity<br>- Art &amp; Craft : Beg Denim Menarik<br>- Resepi : Roti Bakar Perancis Coklat<br>- Tempat Perlancongan<br>- English Activity: Best Holiday<br>- Teka Silang Kata<br>- Cari Perkataan</p><p>e-Majalah MindLoops: Edisi Cuti Sekolah ini boleh dimuat turun di bahagian <strong>Library &gt; Magazine</strong> di dalam Akaun Guru dan Akaun Murid.</p><p>Filter: Standard = All, Subject = All</p><p>&nbsp;</p><p>Terima Kasih.</p><p>&nbsp;</p><p>Team Albayen</p>', '', 1, '2022-01-19 12:57:02', NULL),
(8, 'Pengumuman Dari Admin', '2,4', '<p>lorem ipsum</p>', '20220127151828review mc by approval body.pdf', 1, '2022-01-27 15:18:28', NULL),
(9, 'Industry Announcement', '3', '<p>test</p>', '20220227103147UNICREDS Presentation with Dr.Biha.pptx', 1, '2022-02-27 10:31:16', '2022-02-27 10:31:47');

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

--
-- Dumping data for table `announcement_committee`
--

INSERT INTO `announcement_committee` (`announcement_id`, `announcement_title`, `announcement_receiver`, `announcement_message`, `announcement_attachment`, `announcement_created_by`, `announcement_created_date`, `announcement_updated_date`) VALUES
(2, 'Pengumuman-pengumuman', '5,7', '<p>lorem ipsum tipu tipu</p>', '20220120101441210725 - Albayen Premium New Function Improvement Implementation v1.pdf', 1, '2022-01-20 10:14:41', NULL),
(3, 'Announcement Test', '7', '<p>pengumuman untuk cuba-cuba</p>', '20220123093643200210  HR - Leave Application Form - Template.pdf', 1, '2022-01-23 09:36:43', NULL);

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

--
-- Dumping data for table `announcement_institution`
--

INSERT INTO `announcement_institution` (`announcement_id`, `announcement_title`, `announcement_receiver`, `announcement_message`, `announcement_attachment`, `announcement_created_by`, `announcement_created_date`, `announcement_updated_date`) VALUES
(1, 'Test', '4,5', '<p>dadadaddad</p>', '20220123163105220123 - unicreds_job.sql', 2, '2022-01-23 16:31:05', NULL);

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

--
-- Dumping data for table `announcement_lecturer`
--

INSERT INTO `announcement_lecturer` (`announcement_id`, `announcement_title`, `announcement_receiver`, `announcement_message`, `announcement_attachment`, `announcement_created_by`, `announcement_created_date`, `announcement_updated_date`) VALUES
(1, 'Test Announcement 1 3 4', '7', '<p>lorem ipsum 123</p>', '20220213092516weekly progress.txt', 4, '2022-02-13 09:21:57', '2022-02-13 09:25:16');

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
(1, 50, 'student', 'BP-FKR01', NULL, 'd1bzhcrt', 0, 0, 100000, 100000, 4, 'c', '2022-04-06 15:53:49', '2022-04-06 15:54:05'),
(2, 130, 'student', 'BP-FKR01', NULL, 'zdwc0anj', 0, 0, 100000, 100000, 4, 'c', '2022-04-13 12:48:50', '2022-04-13 12:49:34'),
(3, 50, 'student', 'BP-FKR01', NULL, 'ujepadil', 0, 0, 10000, 10000, 4, 'c', '2022-04-17 16:15:22', '2022-04-17 16:15:35'),
(4, 130, 'student', 'BP-FKR01', NULL, 'zip0765j', 0, 0, 20000, 20000, 4, 'mc', '2022-04-26 12:42:02', '2022-04-26 12:42:35'),
(7, 50, 'student', 'BP-FKR01', NULL, 'ktafhpww', 0, 0, 20000, 20000, 4, 'mc', '2022-04-26 14:02:14', '2022-04-26 14:02:24'),
(8, 78, 'student', 'BP-FKR01', NULL, NULL, 0, 0, 100000, 100000, 2, 'c', '2023-04-07 12:42:00', '2023-04-07 12:42:06');

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
(1, 1, 100000, NULL, '2022-04-06 15:53:49', '2022-04-06 15:53:51'),
(2, 1, 100000, NULL, '2022-04-13 12:48:50', '2022-04-13 12:48:53'),
(3, 3, 10000, NULL, '2022-04-17 16:15:22', '2022-04-17 16:15:24'),
(8, 1, 100000, NULL, '2023-04-07 12:42:00', '2023-04-07 12:42:06');

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
(4, 5, 20000, NULL, '2022-04-26 12:42:19', '2022-04-26 12:42:23'),
(7, 4, 20000, NULL, '2022-04-26 14:02:14', '2022-04-26 14:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `cart_order`
--

CREATE TABLE `cart_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `reference_id` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
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

--
-- Dumping data for table `cart_order`
--

INSERT INTO `cart_order` (`order_id`, `user_id`, `transaction_id`, `reference_id`, `token`, `payment_method`, `pan_number`, `paid_value`, `amount_value`, `discount_value`, `tax_value`, `ip_address`, `region`, `payment_date`, `order_type`) VALUES
(1, 50, 'FCDC238B75D9', NULL, 'd1bzhcrt', NULL, NULL, 100000, 100000, NULL, NULL, '::1', NULL, '2022-04-06 15:54:06', 'c'),
(2, 130, 'E25A7D864CC4', NULL, 'zdwc0anj', NULL, NULL, 100000, 100000, NULL, NULL, '::1', NULL, '2022-04-13 12:49:34', 'c'),
(3, 50, '11983DAA28A7', NULL, 'ujepadil', NULL, NULL, 10000, 10000, NULL, NULL, '::1', NULL, '2022-04-17 16:15:35', 'c'),
(4, 50, 'B9BFC2F3D555', NULL, 'd1bzhcrt', NULL, NULL, 100000, 100000, NULL, NULL, '::1', NULL, '2022-04-26 12:42:35', 'mc'),
(5, 50, 'B84706B9249A', NULL, 'd1bzhcrt', NULL, NULL, 100000, 100000, NULL, NULL, '::1', NULL, '2022-04-26 14:02:24', 'mc');

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

--
-- Dumping data for table `cart_order_course`
--

INSERT INTO `cart_order_course` (`order_id`, `course_id`, `cost`, `discount`, `createdAt`, `updatedAt`) VALUES
(1, 1, 100000, NULL, '2022-04-06 15:54:06', '2022-04-06 15:54:06'),
(2, 1, 100000, NULL, '2022-04-13 12:49:34', '2022-04-13 12:49:34'),
(3, 3, 10000, NULL, '2022-04-17 16:15:35', '2022-04-17 16:15:35');

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

--
-- Dumping data for table `cart_order_mc`
--

INSERT INTO `cart_order_mc` (`order_id`, `sub_id`, `cost`, `discount`, `createdAt`, `updatedAt`) VALUES
(4, 5, 20000, NULL, '2022-04-26 12:42:35', '2022-04-26 12:42:35'),
(5, 4, 20000, NULL, '2022-04-26 14:02:24', '2022-04-26 14:02:24');

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
  `user_id` int(11) DEFAULT NULL,
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
  `user_id` int(11) NOT NULL,
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

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`committee_id`, `committee_user_id`, `committee_role_id`, `committee_name`, `committee_email`, `committee_contact_no`, `committee_address`, `committee_status`, `committee_institution_id`, `committee_created_by`, `committee_created_date`, `committee_updated_date`, `committee_deleted_date`, `committee_logo`) VALUES
(1, 53, 10, 'UTM Academic Leadership', 'utmlead@utm.my', '07-5537866 1', 'UTM Academic Leadership\r\nBlock F541,\r\nUNIVERSITI TEKNOLOGI MALAYSIA\r\n81310 UTM Johor Bahru, JOHOR', 'Active', 2, NULL, '2021-11-16 10:52:01', '2022-02-14 15:25:29', NULL, '1646809359_1644814378_university_default.jpg'),
(2, 59, 10, 'CDAE USM', 'cdae@usm.my', '04-653 5980', 'Pusat Pembangunan Kecemerlangan Akademik (CDAE)\r\nBangunan H24, Kompleks Cahaya\r\nUniversiti Sains Malaysia\r\n11800 USM\r\nPulau Pinang', 'Active', 5, NULL, '2021-12-21 16:11:16', NULL, NULL, NULL),
(3, 68, 10, 'PutraMOOC', 'cadeinovasi@upm.edu.my', '03-9769 6049', 'PUSAT PEMBANGUNAN AKADEMIK\r\nTingkat 4\r\nBangunan Canselori Putra\r\nUniversiti Putra Malaysia\r\n43400 UPM Serdang\r\nSelangor Darul Ehsan\r\nMalaysia', 'Active', 3, NULL, '2022-02-03 14:20:02', NULL, NULL, NULL),
(4, 72, 10, 'UTM Lead 123', 'utmlead1123@utm.my', '077184501', 'utm skudai, johor', 'Inactive', 2, NULL, '2022-02-13 11:34:53', '2022-02-13 11:35:12', '2022-02-13 11:35:37', NULL),
(6, 131, 10, 'UKM committee', 'ukmcommittee@ukm.my', '0123544', 'qeqeq', 'Active', 4, NULL, '2022-05-08 11:45:27', NULL, NULL, NULL);

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
  `course_published_date` datetime DEFAULT NULL,
  `course_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `course_deleted_date` datetime DEFAULT NULL,
  `course_image` text DEFAULT NULL,
  `course_status` varchar(100) NOT NULL,
  `course_enrollment_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_title`, `course_code`, `course_description`, `course_category`, `course_level`, `course_duration`, `course_fee`, `course_credit`, `course_total_enrolled`, `course_created_by`, `course_owner`, `course_created_date`, `course_published_date`, `course_updated_date`, `course_deleted_date`, `course_image`, `course_status`, `course_enrollment_date`) VALUES
(1, 'Course 1', '', '<p>lorem ipsum</p>', 'Computer Science', '1', '12 Weeks', '100000', '', 3, 27, 27, '2022-03-20 10:12:44', NULL, '2022-04-13 12:49:34', NULL, '20220320101244application statistic.jpg', 'Published', 'anytime'),
(2, 'Course 2', '', '<p>lorem ipsum</p>', 'Engineering', '1', '20 Weeks', '20000', '', 0, 27, 27, '2022-03-28 08:52:37', NULL, '2023-04-11 09:25:22', NULL, '20220328085237renewable_energy.jpg', 'Draft', 'anytime'),
(3, 'Course UTM', '', '<p>lorem ipsum</p>', 'Engineering', '1', '10 Weeks', '10000', '', 1, 53, 53, '2022-04-17 15:59:21', NULL, '2022-04-17 16:15:35', NULL, '20220417155921usm course.jpg', 'Published', 'anytime'),
(4, 'Course From lecturer', '', '<p>lorem ipsum</p>', 'Engineering', '1', '10 Weeks', '11100', '', 0, 54, 54, '2022-04-19 12:47:16', NULL, '2022-04-19 12:48:01', NULL, '20220419124716application statistic.jpg', 'Published', 'anytime'),
(5, 'test', '', '<p>testinh</p>', 'ttest', '', '', '1200', '', 0, 27, 27, '2023-04-11 11:40:57', NULL, NULL, NULL, '20230411114057riddle 2.png', 'Draft', ''),
(6, 'test again', '', '<p>Test Again111</p>', 'Test Again1', '', '', '1100', '', 0, 27, 27, '2023-04-11 11:42:57', NULL, NULL, NULL, '20230411114257crossword_edit_category.png', 'Draft', ''),
(7, 'fgf', '54ft', '<p>fghfh hfgt</p>', 'hgh', '1, 2, 3', '22', '3300', '', 0, 27, 27, '2023-04-11 14:01:42', NULL, NULL, NULL, '20230411140142riddle 1.png', 'Draft', 'choosedate');

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

--
-- Dumping data for table `course_enrolment_session`
--

INSERT INTO `course_enrolment_session` (`ces_id`, `ces_course_id`, `ces_start_date`, `ces_end_date`) VALUES
(1, 7, '2023-04-19', '2027-04-29');

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

--
-- Dumping data for table `course_learning_details`
--

INSERT INTO `course_learning_details` (`cld_id`, `cld_course_id`, `cld_learning_outcome`, `cld_intended_learners`, `cld_prerequisites`, `cld_skills`) VALUES
(1, 1, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(2, 2, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(3, 3, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(4, 4, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(5, 5, '', '', '', '<p>testing again</p>'),
(6, 6, '', '', '', '<p>Test Again123</p>'),
(7, 7, '<p>gfhgfhgf</p>', '<p>gfhfghfgh</p>', '<p>hfghfghfgh</p>', '<p>hfghgfhhfgf</p>');

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

--
-- Dumping data for table `course_notes`
--

INSERT INTO `course_notes` (`cn_id`, `cn_course_id`, `cn_title`, `cn_description`, `cn_attachment`, `cn_total_no_of_notes`, `cn_created_date`, `cn_created_by`, `cn_updated_date`, `cn_deleted_date`, `cn_status`) VALUES
(2, 7, '656', '<p>6565</p>', '20230411140202employability_program.sql', 0, '2023-04-11 14:02:02', 27, NULL, NULL, 'Published');

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

--
-- Dumping data for table `course_quiz`
--

INSERT INTO `course_quiz` (`cq_id`, `cq_course_id`, `cq_title`, `cq_instruction`, `cq_duration`, `cq_score`, `cq_created_date`, `cq_created_by`, `cq_updated_date`, `cq_deleted_date`, `cq_status`) VALUES
(1, 1, 'quiz 1', '<p>test</p>', 10, 0, '2022-04-11 11:12:10', 27, NULL, NULL, 'Published'),
(2, 1, 'quiz 2', '<p>ddadad</p>', 100, 0, '2022-12-13 11:28:06', 27, NULL, NULL, 'Published');

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
  `cqq_figure` text DEFAULT NULL,
  `cqq_figure_caption` tinytext DEFAULT NULL,
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
  `ctq_figure` text DEFAULT NULL,
  `ctq_figure_caption` tinytext DEFAULT NULL,
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

--
-- Dumping data for table `course_video`
--

INSERT INTO `course_video` (`cv_id`, `cv_course_id`, `cv_title`, `cv_description`, `cv_attachment`, `cv_duration`, `cv_created_date`, `cv_created_by`, `cv_updated_date`, `cv_deleted_date`, `cv_status`) VALUES
(1, 9, 'This is a video', '<p>Cool video</p>', '20230411120013VID-20230327-WA0005.mp4', '2m 44s ', '2023-04-11 12:00:13', 27, NULL, NULL, 'Published'),
(2, 7, '454', '<p>4545</p>', '20230411140228VID-20230327-WA0005.mp4', '2m 44s ', '2023-04-11 14:02:28', 27, '2023-04-11 11:32:33', NULL, 'Save Only');

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
-- Table structure for table `employability_program`
--

CREATE TABLE `employability_program` (
  `ep_id` int(11) NOT NULL,
  `ep_title` varchar(150) NOT NULL,
  `ep_description` longtext NOT NULL,
  `ep_fee` int(10) DEFAULT NULL,
  `ep_fee_status` varchar(20) DEFAULT NULL,
  `ep_publish` varchar(20) DEFAULT NULL,
  `ep_total_enrolled` int(11) DEFAULT NULL,
  `ep_category` varchar(50) NOT NULL,
  `ep_cover_attachment` varchar(255) NOT NULL,
  `ep_introvideo` varchar(255) DEFAULT NULL,
  `ep_skills_achieve` longtext NOT NULL,
  `course_created_by` int(11) DEFAULT NULL,
  `ep_published_date` datetime DEFAULT NULL,
  `ep_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ep_updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `course_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employability_program`
--

INSERT INTO `employability_program` (`ep_id`, `ep_title`, `ep_description`, `ep_fee`, `ep_fee_status`, `ep_publish`, `ep_total_enrolled`, `ep_category`, `ep_cover_attachment`, `ep_introvideo`, `ep_skills_achieve`, `course_created_by`, `ep_published_date`, `ep_created_date`, `ep_updated_date`, `course_deleted_date`) VALUES
(2, 'COMPLETE Creative Writing - All Genres - THE FULL COURSE!', '<h2><strong>Requirements</strong></h2><p>Just a willingness to write!</p><h2><strong>Description</strong></h2><p><strong>Course Overview:</strong></p><p>This is a fun and practical creative writing course designed to get YOU excited about creating your own works of <strong>fiction, poetry, drama, and creative non-fiction</strong><i> - the four genres of creative writing.</i></p><p>Writing techniques, literary devices, and specialized skills will be covered to help you discover, perfect, and share your own writer\'s voice.</p><p>While review quizzes over major concepts are provided along the way, the true measure of progress will be in the authentic writing assignments that you will complete as you progress toward your goal of becoming a successful and confident writer!</p><p>&nbsp;</p><p><strong>The Course Includes:</strong></p><p>43 Video Lessons</p><p>Each lesson is broken down into multiple video lectures that include:</p><p>A quick writing assignment aligned with the day\'s goals</p><p>A lesson covering an area of course content</p><p>A practical application project</p><p>37 online review quizzes over major concepts</p><p>Quizzes are designed to <i>reinforce</i> major concepts discussed in the class</p><p>Graphics, notes, assignment sheets, or outside resources are provided for every lesson</p><p>Over <strong>12 hours</strong> of video lessons</p><p>&nbsp;</p><p><strong>Course Goals:</strong></p><p>Through taking this course, you will <i>develop</i> and <i>perfect</i> your personal writer\'s voice as you:</p><p>become familiar with the four genres of creative writing</p><p>apply writing techniques for success</p><p>examine a multitude of writing concepts to relate to your own writing</p><p>evaluate the strengths and weaknesses of writing projects</p><p>create scaffolded examples of a variety of writing styles</p><p>Additionally, you will discover multiple public outlets with which to share your writing with others as you experience success and develop confidence in your writing ability.</p><p>&nbsp;</p><p><strong>COMPLETE Creative Writing</strong> contains all of the content (and a little extra) from:</p><p>Poetry Primer - Survey of Poetic Writing Styles and Projects</p><p>Creative Non-Fiction Writing - You Can\'t Make This Stuff Up!</p><p>Fiction Crash Course - Writing Skills &amp; Methods for Success!</p><p>Beginning Playwriting - Write a Play and Get Produced!</p><h2><strong>Who this course is for:</strong></h2><ul><li>Anyone with a creative streak and a nagging desire to write</li></ul>', 15000, 'paid', 'Draft', 0, 'Personal Development', '20221212165406download (2).jpg', '20221212165406abc.mp4', '<p>1234</p>', 27, NULL, '2022-12-12 16:54:06', '2023-04-11 09:25:22', NULL),
(3, 'Disciplined Dreaming: Lead Breakthrough Creativity at Work', '<h2><strong>Description</strong></h2><p>In today\'s highly competitive world, leaders and organizations will only enjoy sustainable success if they build and harness a culture of innovation. Innovation is the most powerful force to fuel growth, develop competitive advantage, and build personal and professional growth. This interactive training workshop is designed to systematically unlock the creative potential of the student to solve complex problems, seize opportunities and realize profound economic success. This system is based on 5-time tech entrepreneur Josh Linkner’s <i>New York Times </i>bestseller, <i>Disciplined Dreaming</i>. Now translated into 13 languages and regarded as the best new approach to driving breakthrough creativity worldwide, <i>Disciplined Dreaming </i>illustrates a flexible system that can be deployed to solve any challenge, big or small.</p><p>This course will take you step by step through the process of unlocking your full creative potential. Fluid enough to enable transformational thinking, yet structured enough to offer a clear process for all levels and roles, this systematic approach will help leaders gain competitive advantage, drive efficiencies, create new products and services, and fuel employee engagement.</p><p>As you embark on understanding and leveraging Josh\'s method, you will:</p><p>Understand the 5-step Disciplined Dreaming process.</p><p>Reconnect with your creative abilities.</p><p>Embrace a systematic approach to conquer challenges and seize opportunities.</p><p>Identify and overcome myths and blockers of innovation.</p><p>Master unorthodox, yet surprisingly powerful and fun, brainstorming techniques.</p><p>Explore best practice approaches to idea selection and executing on innovation.</p><p>Internalize the core principles of building a sustainable culture of innovation.</p><p>This workshop is for individuals and teams energized to drive change, but struggling to get started.</p><p>What if you could:</p><p>Build a systematic approach to developing creative problem-solving</p><p>Learn critical skills to dramatically improve your innovation capacity</p><p>Tackle significant real-world opportunities and challenges with ease</p><p>Join Josh on this Disciplined Dreaming journey today and learn how!</p>', 0, 'free', 'Published', NULL, 'Personal Development', '20221213110326download123.jpg', '20221213113650123.mp4', '<p>test</p>', 27, NULL, '2022-12-13 11:03:26', '2023-02-23 08:21:35', NULL),
(4, '[2023] The Complete Management Skills Certification Course', '<p>date</p>', 1500, 'paid', 'Published', NULL, 'Personal Management', '20230110171739bootstrap-snippets-882.png', '', '<p>test</p>', 133, NULL, '2023-01-10 16:43:14', '2023-02-28 08:34:53', NULL),
(5, 'How to Run truly Productive Meetings – and add value', '<p>BALA</p>', 5000, 'paid', 'Published', NULL, 'Social and Emotional', '20230110185009bootstrap-snippets-882.png', '', '<p>FGFDGDF</p>', 133, '2023-02-14 17:51:23', '2023-01-10 18:50:09', '2023-02-28 08:35:15', NULL),
(7, 'Job Interview Skills Training Course', '<h2><strong>Description</strong></h2><p>Master your interviewing skills with this comprehensive course from TeachUcomp, Inc. Mastering Your Interview Made Easy features 33 video lessons. Watch, listen and learn as your expert instructor guides you<br>through each lesson step-by-step. During this media-rich learning experience, you will see each lesson just as if your instructor were there with you.&nbsp;You will learn what to do before your interview is scheduled, specific interviewing techniques such as mirroring and body language and you will have the opportunity<br>to practice the most common interview questions and much more. Whether you are&nbsp;completely new to the job market, re-entering the workforce or looking to advance your career, this course will empower you with the knowledge and skills necessary to dazzle during your next interview. We have incorporated years of<br>classroom training experience and teaching techniques to develop an easy-to-use course that you can customize to meet your personal learning needs.&nbsp;</p>', 5000, 'free', 'Published', NULL, 'Personal Development', '20230227183225download (1).jpg', '20230227183225vecteezy_video-countdown-counter-with-rounded-corners-for-10-to-1-on_5965601_897.mp4', '<ul><li>Video Lessons</li><li>Learn what to do before you have an interview scheduled</li><li>Learn how to answer the 15 most important interview questions</li><li>Learn how to follow-up after an interview</li><li>Dress to impress</li><li>Much More!</li></ul>', 133, '2023-02-27 18:41:29', '2023-02-27 18:32:25', '2023-03-01 11:08:22', NULL),
(8, 'Amir test', '<p>Amir Test</p>', 1100, NULL, 'Draft', NULL, 'Amir Test', '20230411114359riddle 2.png', '20230411114359VID-20230327-WA0005.mp4', '<p>Amir Test</p>', 0, NULL, '2023-04-11 11:43:59', '2023-04-11 09:13:59', NULL),
(9, 'sdsdf hfsdjfh', '<p>fsdfsdfsdjkfhsd</p>', 2200, NULL, 'Draft', NULL, 'fdssddskjfh', '20230411115144riddle 4.png', '20230411121211VID-20230327-WA0005.mp4', '<p>fdfdfgdfghgfsjdghf</p>', 27, NULL, '2023-04-11 11:51:44', '2023-04-11 09:42:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employability_program_enrolment_session`
--

CREATE TABLE `employability_program_enrolment_session` (
  `epes_id` int(11) NOT NULL,
  `epes_ep_id` int(11) NOT NULL,
  `epes_start_date` date NOT NULL,
  `epes_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employability_program_quiz`
--

CREATE TABLE `employability_program_quiz` (
  `epq_id` int(11) NOT NULL,
  `epq_ep_id` int(11) NOT NULL,
  `epq_title` varchar(255) NOT NULL,
  `epq_instruction` longtext NOT NULL,
  `epq_duration` int(11) NOT NULL,
  `epq_score` float NOT NULL,
  `epq_created_by` int(11) DEFAULT NULL,
  `epq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `epq_deleted_date` datetime DEFAULT NULL,
  `epq_status` enum('Published','Save Only') NOT NULL,
  `epq_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employability_program_quiz`
--

INSERT INTO `employability_program_quiz` (`epq_id`, `epq_ep_id`, `epq_title`, `epq_instruction`, `epq_duration`, `epq_score`, `epq_created_by`, `epq_updated_date`, `epq_deleted_date`, `epq_status`, `epq_created_date`) VALUES
(1, 2, 'Module 1 Quiz Test', '<ol><li>Rules to follow during all online proctored exams:\nYou must use a functioning webcam and microphone\nNo cell phones or other secondary devices in the room or test area\nYour desk/table must be clear or any materials except your test-taking device\nNo one else can be in the room with you\nNo talking \nThe testing room must be well-lit and you must be clearly visible\nNo dual screens/monitors\nDo not leave the camera \nNo use of additional applications or internet\n</li></ol>', 30, 0, 133, '2023-01-17 08:19:27', NULL, 'Published', '2022-12-09 16:05:10'),
(2, 2, 'AMCAT for MBAs', '<h3><strong>Rules to follow during all online proctored exams:</strong></h3><ul><li>You must use a functioning webcam and microphone</li><li>No cell phones or other secondary devices in the room or test area</li><li>Your desk/table must be clear or any materials except your test-taking device</li><li>No one else can be in the room with you</li><li>No talking&nbsp;</li><li>The testing room must be well-lit and you must be clearly visible</li><li>No dual screens/monitors</li><li>Do not leave the camera&nbsp;</li><li>No use of additional applications or internet</li></ul>', 10, 50, 27, '2023-01-19 10:21:48', NULL, 'Published', '2022-12-12 08:35:15'),
(3, 1, 'Quiz 1', '<p>Rules to follow during all online proctored exams:\nYou must use a functioning webcam and microphone\nNo cell phones or other secondary devices in the room or test area\nYour desk/table must be clear or any materials except your test-taking device\nNo one else can be in the room with you\nNo talking \nThe testing room must be well-lit and you must be clearly visible\nNo dual screens/monitors\nDo not leave the camera \nNo use of additional applications or internet\n</p>', 99, 0, 27, '2023-01-17 08:15:12', NULL, 'Save Only', '2022-12-12 14:24:36'),
(4, 1, 'qq', '<p>qq</p>', 50, 0, 27, NULL, NULL, 'Published', '2022-12-12 14:47:54'),
(5, 1, 'qq', '<p>qq</p>', 1, 0, 27, '2023-01-13 15:58:04', NULL, 'Save Only', '2022-12-12 14:48:30'),
(6, 2, 'Verbal Reasoning ', '<p>The quizzes consists of questions carefully designed to help you self-assess your comprehension of the information presented on the topics covered in the module. No data will be collected on the website regarding your responses or how many times you take the quiz.</p><p>Each question in the quiz is of multiple-choice or \"true or false\" format. Read each question carefully, and click on the button next to your response that is based on the information covered on the topic in the module. Each correct or incorrect response will result in appropriate feedback immediately at the bottom of the screen.</p><p>After responding to a question, click on the \"Next Question\" button at the bottom to go to the next questino. After responding to the 8th question, click on \"Close\" on the top of the window to exit the quiz.</p><p>If you select an incorrect response for a question, you can try again until you get the correct response. If you retake the quiz, the questions and their respective responses will be randomized.</p><p>The total score for the quiz is based on your responses to all questions. If you respond incorrectly to a question or retake a question again and get the correct response, your quiz score will reflect it appropriately. However, your quiz will not be graded, if you skip a question or exit before responding to all the questions.</p>', 10, 10, 27, '2023-01-19 12:10:38', NULL, 'Save Only', '2022-12-13 08:47:12'),
(7, 3, 'quiz', '<p>200</p>', 20, 0, 27, NULL, NULL, 'Save Only', '2022-12-13 08:57:08'),
(8, 3, 'quiz1', '<p>quiz1</p>', 12, 0, 27, '2023-01-13 15:58:16', NULL, 'Published', '2022-12-13 09:01:41'),
(9, 5, 'GHGF', '<p>GHFGH</p>', 50, 0, 133, NULL, NULL, 'Published', '2023-01-10 16:21:03'),
(10, 7, 'Interview Skills', '<p><strong>In the “Don’t do” examples below, you’ll see the importance of being clear about the rules and expectations to avoid any confusion.</strong></p><p><strong>Don’t do:</strong> Don’t speak with your friends or family during the exam.<br><strong>Do</strong>: No talking during all exams.</p><p><strong>In the “Don’t do” example, the student may think:</strong> “my peer from class isn’t my friend or family, so it’s okay to speak with them for help.”</p><p><strong>Don’t do: </strong>No other devices in view during this exam.<br><strong>Do:</strong> Remove all other electronic devices from the testing area/room during all exams.</p><p><strong>In the “Don’t do” example, the student may think:</strong> I can’t have other devices in view of the webcam, but I can use other devices if they’re out of sight of the webcam.”</p><p><strong>Don’t do:</strong> Do not copy and paste using your mouse.<br><strong>Do</strong>: Do not use any copy, cut, or paste function with your mouse, keyboard, voice command, or device.</p><p><strong>In the “Don’t do” example, the student may think:</strong> “I can’t copy and paste using my mouse, but I can use keyboard shortcuts.”</p><p>The “do” example in each scenario above provides clarity and removes room for subjective interpretation. Keep these in mind when you write test rules for<a href=\"https://honorlock.com/blog/comprehensive-guide-to-online-exams/\"><strong> online exams.</strong></a></p>', 50, 0, 133, NULL, NULL, 'Published', '2023-02-27 16:08:24'),
(0, 9, 'Quiz1', '<p>quizz11</p>', 20, 0, 27, NULL, NULL, 'Published', '2023-04-11 09:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `employability_program_quiz_answer`
--

CREATE TABLE `employability_program_quiz_answer` (
  `epqa_id` int(11) NOT NULL,
  `epqa_epq_id` int(11) NOT NULL,
  `epqa_answer1` text NOT NULL,
  `epqa_answer2` text NOT NULL,
  `epqa_answer3` text NOT NULL,
  `epqa_answer4` text NOT NULL,
  `epqa_right_answer` text NOT NULL,
  `epqa_right_answerword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employability_program_quiz_answer`
--

INSERT INTO `employability_program_quiz_answer` (`epqa_id`, `epqa_epq_id`, `epqa_answer1`, `epqa_answer2`, `epqa_answer3`, `epqa_answer4`, `epqa_right_answer`, `epqa_right_answerword`) VALUES
(3, 1, ' Commended, Motivate', 'Celebrated, Discourage', 'Condemned, Inspiration', ' Applauded, Motivation', '4', ' Applauded, Motivation'),
(5, 3, 'Tadpole', 'Frog', 'Swamp', 'Fly', '1', 'Tadpole'),
(6, 4, 'True', 'False', '', '', '5', 'YES'),
(7, 5, 'FGF', 'FG', 'FG', 'GFG', '1', 'FGF'),
(8, 6, 'FGFG', 'FGFG', '', '', '5', 'FGFG'),
(9, 7, 'FGF', 'NMN', '', '', '6', 'NMN'),
(10, 8, 'Cotton: Wool', 'Tree: Paper', 'Seed : Flower', 'Stove : Oven', '2', 'Tree: Paper'),
(11, 9, 'Beige', 'Territory', 'Flag', 'Noncommittal', '4', 'Noncommittal'),
(12, 10, 'Apprehensive', 'Deduction', 'Retrieve', 'Misspell', '3', 'Retrieve'),
(13, 11, 'False', 'True', '', '', '1', 'True'),
(14, 12, 'True', 'False', '', '', '6', 'False'),
(15, 13, 'Sign a contract stipulating his responsibilities', 'Prevent leakage of sensitive information', 'Refrain from sending personal E-mail', 'Accept punitive action when necessary ', '2', 'Prevent leakage of sensitive information'),
(16, 14, 'Agreeing', 'Specifying', 'Promising', 'Pledging ', '2', 'Specifying'),
(17, 15, 'True', 'False', '', '', '5', 'True'),
(18, 16, 'True', 'False', '', '', '6', 'False'),
(19, 17, ' Lydia calculated with ease the expected yearly revenue of her store', 'Marvin can easily summarize a complex text', 'Alan weighed his different options before choosing to study agricultre', 'Despite the fire alarm going off in the midst of taking her test, Maria got an A', '1', ' Lydia calculated with ease the expected yearly revenue of her store'),
(20, 18, 'Supervisors should monitor employees\' E-mails', 'Leakage of information may result in punishment', 'Employees are obligated to information confidentiality', 'All', '1', 'Supervisors should monitor employees\' E-mails'),
(21, 19, '5-10 questions', 'exactly 5 questions', '3-5 questions', '1-2 questions', '1', '5-10 questions'),
(22, 20, 'wearing cologne or perfume', 'engaged in the interview process (body language)', 'not overly eager for the position', 'more than qualified', '1', 'wearing cologne or perfume'),
(23, 21, 'give a soft handshake', ' ask each person a different question', 'tell a joke', 'make eye contact', '1', 'give a soft handshake'),
(0, 0, 'apple', 'boy', 'cat', 'dog', '3', 'cat');

-- --------------------------------------------------------

--
-- Table structure for table `employability_program_quiz_question`
--

CREATE TABLE `employability_program_quiz_question` (
  `epqq_id` int(11) NOT NULL,
  `epq_ep_id` int(11) NOT NULL,
  `epqq_type` varchar(255) NOT NULL,
  `epqq_question` longtext NOT NULL,
  `epqq_score` float NOT NULL,
  `epqq_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `epqq_updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `epqq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employability_program_quiz_question`
--

INSERT INTO `employability_program_quiz_question` (`epqq_id`, `epq_ep_id`, `epqq_type`, `epqq_question`, `epqq_score`, `epqq_created_date`, `epqq_updated_date`, `epqq_deleted_date`) VALUES
(1, 2, 'Multiple Choice', '<p>Work-life balance schemes in the workplace have been __________ by employees and increase morale and ________ at work.</p>', 0, '2023-01-09 12:02:41', '2023-01-09 09:32:41', NULL),
(3, 2, 'Multiple Choice', '<p>Butterfly → caterpillar : toad →________</p>', 0, '2023-01-10 18:32:22', '2023-01-10 16:02:22', NULL),
(4, 2, 'True/False', '<p>You like this course?</p>', 0, '2023-01-10 18:32:36', '2023-01-10 16:02:36', NULL),
(5, 1, 'Multiple Choice', '<p>FGFG</p>', 0, '2023-01-10 18:51:18', '2023-01-10 16:21:18', NULL),
(6, 1, 'True/False', '<p>FGFG</p>', 0, '2023-01-10 18:51:30', '2023-01-10 16:21:30', NULL),
(7, 1, 'True/False', '<p>FVFF</p>', 0, '2023-01-10 18:52:17', '2023-01-10 16:22:17', NULL),
(8, 2, 'Multiple Choice', '<p>Sand : Glass</p>', 0, '2023-01-19 10:57:30', '2023-01-19 08:27:30', NULL),
(9, 6, 'Multiple Choice', '<p>NEUTRAL means the same as…</p>', 0, '2023-01-19 14:01:29', '2023-01-19 11:31:29', NULL),
(10, 6, 'Multiple Choice', '<p>Select the word that is spelled incorrectly:</p>', 0, '2023-01-19 14:02:22', '2023-01-19 11:32:22', NULL),
(11, 6, 'True/False', '<p>The new health and safety regulations state that helmets should be worn and fastened and the head torch operating at all times whilst working within the mine. Other safety devices would be prioritised according to the previous depth regulations and following the mine\'s security engineer\'s daily instructions. On dates of detonations, maximal safety wear should be implemented inside and within a 500 meters external diameter outside the mine, with no exception.\n\nThe mine\'s security engineer is the only source of authority to decide which safety gear is worn by miners.</p>', 0, '2023-01-19 14:26:09', '2023-01-19 11:56:09', NULL),
(12, 6, 'True/False', '<p>The anti-smoking ad is funded by the Department of Health.</p>', 0, '2023-01-19 14:41:57', '2023-01-19 12:11:57', NULL),
(13, 6, 'Multiple Choice', '<p>Employees working within organizations have a legislative obligation to monitor the content of e-mails sent to external bodies and eliminate potentially sensitive internal information regardless of the perceived importance. Employers have prepared mandatory contracts stipulating this responsibility to guarantee that employees fulfill their legislative obligation and prevent the complete report\'s possible leak.\nAll employees signed these contracts, inserted a copyright section to every external e-mail, and emphasized the confidentiality of the information provided. Employees’ carelessness in handling information circulated via email may result in severe punitive action.\n\nWhich one of the following provides the best summary of the main point of the passage?</p>', 0, '2023-01-19 14:43:50', '2023-01-19 12:13:50', NULL),
(14, 6, 'Multiple Choice', '<p>&nbsp;Which one of the following would best replace ‘stipulating’ while maintaining the meaning of the passage?</p>', 0, '2023-01-19 14:44:27', '2023-01-19 12:14:27', NULL),
(15, 6, 'True/False', '<p>The research suggests that ‘executive function’ increases with the number of languages mastered</p>', 0, '2023-01-19 14:45:53', '2023-01-19 12:15:53', NULL),
(16, 6, 'True/False', '<p>People who drink two or three cups of coffee a day have a 6 per cent higher chance of living longer compared to people who drink one cup of coffee a day.</p>', 0, '2023-01-24 10:35:25', '2023-01-24 08:05:25', NULL),
(17, 6, 'Multiple Choice', '<p>&nbsp;What is not an example of an ‘executive function’?</p>', 0, '2023-01-24 10:36:22', '2023-01-24 08:06:22', NULL),
(18, 6, 'Multiple Choice', '<p>Which statement does not follow from the passage?</p>', 0, '2023-01-24 10:37:12', '2023-01-24 08:07:12', NULL),
(19, 10, 'Multiple Choice', '<p>When preparing for a college/job interview, the interviewer is not the only one who should ask questions. How many questions should you, the interviewee, have prepared?</p>', 0, '2023-02-27 18:39:20', '2023-02-27 16:09:20', NULL),
(20, 10, 'Multiple Choice', '<p>It is important to show the employer/interviewer that you are:</p>', 0, '2023-02-27 18:40:07', '2023-02-27 16:10:07', NULL),
(21, 10, 'Multiple Choice', '<p>During an interview, make sure you do this with each person in the room:</p>', 0, '2023-02-27 18:40:50', '2023-02-27 16:10:50', NULL),
(0, 0, 'Multiple Choice', '<p>Question1 12ggh gyjgy</p>', 0, '2023-04-11 12:01:56', '2023-04-11 09:31:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employabilty_program_note`
--

CREATE TABLE `employabilty_program_note` (
  `epn_id` int(11) NOT NULL,
  `epn_ep_id` int(11) NOT NULL,
  `cn_title` varchar(255) NOT NULL,
  `cn_discription` longtext NOT NULL,
  `epn_attachment` varchar(255) DEFAULT NULL,
  `epn_total_no_of_notes` int(11) DEFAULT NULL,
  `epn_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `epn_created_by` int(11) DEFAULT NULL,
  `epn_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `epn_deleted_date` datetime DEFAULT NULL,
  `epn_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employabilty_program_note`
--

INSERT INTO `employabilty_program_note` (`epn_id`, `epn_ep_id`, `cn_title`, `cn_discription`, `epn_attachment`, `epn_total_no_of_notes`, `epn_created_date`, `epn_created_by`, `epn_updated_date`, `epn_deleted_date`, `epn_status`) VALUES
(1, 2, 'Note 1', '<p>Note 1</p>', '20221209183234350_Book_01.pdf', NULL, '2022-12-09 18:32:34', 133, NULL, NULL, 'Save Only'),
(2, 2, 'sana requirement', '<p>requirement</p>', '20230109134015employability_platform_test (5).sql', NULL, '2023-01-09 13:40:15', 27, NULL, NULL, 'Published'),
(3, 4, 'test', '<p>test</p>', '20230110165049employability_platform.sql', NULL, '2023-01-10 16:50:49', 133, '2023-01-10 16:10:03', NULL, 'Published'),
(4, 5, 'GHFG', '<p>GHFGH</p>', '20230110185045employability_platform.sql', NULL, '2023-01-10 18:50:45', 133, NULL, NULL, 'Save Only'),
(5, 7, 'Interview Skills', '<p>A presentation at <i><strong>an</strong></i> interview is a great opportunity and your first question ... on Interview panels, run <i><strong>training courses</strong></i> on <i><strong>Interview skills for</strong></i> staff</p>', '20230227183424Interview-Skills.pdf', NULL, '2023-02-27 18:34:24', 133, '2023-03-01 08:23:24', NULL, 'Save Only'),
(6, 7, 'Practice interviews ', '<p>Practice <i><strong>interviews</strong></i> - Write down a list of possible questions that you think may be asked, then have a friend act as <i><strong>an interviewer</strong></i> and direct them to you <i><strong>in</strong></i> a&nbsp;...</p>', '20230227183450career-builder-e-book.pdf', NULL, '2023-02-27 18:34:50', 133, NULL, NULL, 'Published'),
(7, 7, 'The Hiring Managers Complete Interviewing Guide', '<p>Using This e-Book. There is nothing more important <i><strong>in</strong></i> the hiring process than the <i><strong>interview</strong></i>. At the very least, the <i><strong>interview</strong></i> process is a networking event&nbsp;...</p>', '20230227183543Template_InterviewGuide.pdf', NULL, '2023-02-27 18:35:43', 133, NULL, NULL, 'Published'),
(8, 7, 'Interview Guide - SHRM', '<p>The following guide is a sample document which includes the types of information and materials hiring managers would want to provide to interviewers when&nbsp;...</p>', '20230227183611Successful-Interview-Skills-How-to-Prepare-answer-tough-questions-and-get-your-ideal-job.pdf', NULL, '2023-02-27 18:36:11', 133, NULL, NULL, 'Published'),
(0, 7, '656', '<p>6565</p>', '20230411140202employability_program.sql', NULL, '2023-04-11 14:02:02', 27, NULL, NULL, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `employabilty_program_video`
--

CREATE TABLE `employabilty_program_video` (
  `epv_id` int(11) NOT NULL,
  `epv_ep_id` int(11) NOT NULL,
  `epv_title` varchar(255) NOT NULL,
  `epv_discription` longtext NOT NULL,
  `epv_attachment` varchar(255) NOT NULL,
  `epv_duration` int(11) DEFAULT NULL,
  `epv_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `epv_created_by` int(11) NOT NULL,
  `epv_status` enum('Published','Save Only') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employabilty_program_video`
--

INSERT INTO `employabilty_program_video` (`epv_id`, `epv_ep_id`, `epv_title`, `epv_discription`, `epv_attachment`, `epv_duration`, `epv_created_date`, `epv_created_by`, `epv_status`) VALUES
(1, 4, 'Video 1', '<p>Video 1</p>', '20221209183350abc.mp4', 24, '2022-12-09 18:33:50', 133, 'Save Only'),
(2, 4, 'video', '<p>vuideo</p>', '20230110165123helpdesk_db.png', 0, '2023-01-10 16:51:23', 133, 'Save Only'),
(3, 4, 'HGHFG', '<p>HFGHFGHF</p>', '20230110185029Screenshot_20221121_110036.png', 0, '2023-01-10 18:50:29', 133, 'Published'),
(4, 7, 'The Hiring Managers Complete Interviewing Guide', '<p>The following guide is a sample document which includes the types of information and materials hiring managers would want to provide to interviewers when&nbsp;...</p>', '20230228105100vecteezy_10-second-timer-countdown-text-in-black-background__837.mp4', 11, '2023-02-27 18:36:39', 133, 'Published'),
(5, 7, 'Interview Guide - SHRM', '<p>The following guide is a sample document which includes the types of information and materials hiring managers would want to provide to interviewers when&nbsp;...</p>', '20230227183657vecteezy_video-countdown-counter-with-rounded-corners-for-10-to-1-on_5965601_897.mp4', 11, '2023-02-27 18:36:57', 133, 'Published'),
(6, 7, 'Interview Tips', '<ul><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc1\">Test your technology</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc2\">Charge it up</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc3\">Dress for success</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc4\">Set the stage for a distraction-free video interview</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc5\">Be a well-prepared early bird</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc6\">Maintain good eye contact and body language</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc7\">Project and pause</a></li><li><a href=\"https://www.roberthalf.com/blog/job-interview-tips/screen-time-how-to-nail-your-next-video-interview#toc8\">End the video interview with appreciation</a></li></ul>', '20230228104628vecteezy_10-seconds-countdown-old-movie-film-leader-countdown-use_12154485_666.mp4', 11, '2023-02-28 10:46:28', 133, 'Published'),
(8, 7, '454', '<p>4545</p>', '20230411140228VID-20230327-WA0005.mp4', 2, '2023-04-11 14:02:28', 27, 'Published');

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

--
-- Dumping data for table `enrolled_course_studuni`
--

INSERT INTO `enrolled_course_studuni` (`ecsu_id`, `ecsu_student_university_id`, `ecsu_course_id`, `ecsu_enrollment_date`, `ecsu_certificate_id`, `ecsu_status`, `ecsu_status_date`) VALUES
(1, 9, 1, '2022-04-06 15:54:06', NULL, 'In progress', '2022-04-06 15:54:06'),
(2, 20, 1, '2022-04-13 12:49:34', NULL, 'In progress', '2022-04-13 12:49:34'),
(3, 9, 3, '2022-04-17 16:15:35', NULL, 'In progress', '2022-04-17 16:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_ep_studuni`
--

CREATE TABLE `enrolled_ep_studuni` (
  `eepsu_id` int(11) NOT NULL,
  `eepsu_order_id` int(11) DEFAULT NULL,
  `eepsu_student_university_id` int(11) NOT NULL,
  `eepsu_ep_id` int(11) NOT NULL,
  `eepsu_enrollment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `eepsu_certificate_id` int(11) DEFAULT NULL,
  `eepsu_status` enum('Not started','In progress','Completed') NOT NULL,
  `eepsu_status_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolled_ep_studuni`
--

INSERT INTO `enrolled_ep_studuni` (`eepsu_id`, `eepsu_order_id`, `eepsu_student_university_id`, `eepsu_ep_id`, `eepsu_enrollment_date`, `eepsu_certificate_id`, `eepsu_status`, `eepsu_status_date`) VALUES
(5, 3, 26, 2, '2023-02-23 08:31:53', NULL, 'Not started', '2023-02-23 08:31:53'),
(7, 4, 26, 5, '2023-02-24 15:20:08', NULL, 'Not started', '2023-02-24 15:20:08'),
(49, 4, 26, 7, '2023-02-24 15:20:08', NULL, 'Not started', '2023-02-24 15:20:08'),
(51, 8, 26, 4, '2023-03-01 15:08:13', NULL, 'Not started', '2023-03-01 15:08:13');

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
-- Dumping data for table `enrolled_mc_studuni`
--

INSERT INTO `enrolled_mc_studuni` (`emcsu_id`, `emcsu_student_university_id`, `emcsu_mc_id`, `emcsu_enrollment_date`, `emcsu_certificate_id`, `emcsu_status`, `emcsu_status_date`) VALUES
(1, 9, 5, '2022-04-26 12:42:35', NULL, 'In progress', '2022-04-26 12:42:35'),
(2, 20, 5, '2022-04-26 12:42:35', NULL, 'In progress', '2022-04-26 12:42:35'),
(5, 9, 4, '2022-04-26 14:02:24', NULL, 'In progress', '2022-04-26 14:02:24'),
(6, 20, 4, '2022-04-26 14:02:24', NULL, 'In progress', '2022-04-26 14:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `ep_rating`
--

CREATE TABLE `ep_rating` (
  `ep_rating_id` int(11) NOT NULL,
  `ep_student_id` int(11) NOT NULL,
  `ep_course_id` int(11) NOT NULL,
  `ep_review_rating` int(11) NOT NULL,
  `ep_review` varchar(255) NOT NULL,
  `ep_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ep_rating`
--

INSERT INTO `ep_rating` (`ep_rating_id`, `ep_student_id`, `ep_course_id`, `ep_review_rating`, `ep_review`, `ep_created_at`) VALUES
(1, 26, 2, 5, 'yuyuyt654654654', '2023-02-16 08:55:57'),
(2, 26, 3, 5, 'Knowledgeable!', '2023-02-16 08:57:49'),
(3, 27, 2, 4, 'Great Work!', '2023-02-16 09:04:08'),
(4, 27, 3, 3, 'Right!', '2023-02-16 09:05:46'),
(5, 26, 4, 5, 'Mudassir', '2023-02-23 06:12:48'),
(6, 26, 7, 5, 'hiiddd', '2023-02-28 03:52:42');

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

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_user_id`, `faculty_name`, `faculty_email`, `faculty_contact_no`, `faculty_address`, `faculty_institution_id`, `faculty_created_by`, `faculty_created_date`, `faculty_updated_date`, `faculty_deleted_date`) VALUES
(1, 10, 'Faculty of Computing', 'contact@fc.utm.my', '07-5538828', 'School of Computing\r\nFaculty of Engineering\r\nUniversiti Teknologi Malaysia\r\n81310 UTM Johor Bahru\r\nJohor, Malaysia', 2, 2, '2021-10-10 09:30:05', '2021-10-10 03:30:05', NULL);

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
-- Table structure for table `forum_post_course`
--

CREATE TABLE `forum_post_course` (
  `fpc_id` int(11) NOT NULL,
  `fpc_topic_id` int(11) NOT NULL,
  `fpc_message` text NOT NULL,
  `fpc_instructor` int(11) DEFAULT NULL,
  `fpc_student` int(11) DEFAULT NULL,
  `fpc_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_post_course`
--

INSERT INTO `forum_post_course` (`fpc_id`, `fpc_topic_id`, `fpc_message`, `fpc_instructor`, `fpc_student`, `fpc_created_date`) VALUES
(16, 2, 'Assalamualaikum from committee', 53, NULL, '2022-04-19 14:38:20'),
(18, 7, 'Please define what is data structure in your own word. Explain why organizing data is important in computer programming. Give real world example of the use of the data structure, such as stack, queue, tree and graph.\r\nPlease also differentiate between big data and data structure?', 27, NULL, '2022-04-24 08:52:04'),
(33, 7, '<p>testing</p>', NULL, 50, '2022-04-25 08:17:30'),
(34, 7, '<p>Data structure is bla bla bla</p>', NULL, 130, '2022-04-25 09:33:51'),
(35, 15, '<p>Assalamualaikum w.b.t 123</p>', 54, NULL, '2022-04-26 10:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `forum_post_mc`
--

CREATE TABLE `forum_post_mc` (
  `fpm_id` int(11) NOT NULL,
  `fpm_topic_id` int(11) NOT NULL,
  `fpm_message` text NOT NULL,
  `fpm_instructor` int(11) DEFAULT NULL,
  `fpm_student` int(11) DEFAULT NULL,
  `fpm_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_post_mc`
--

INSERT INTO `forum_post_mc` (`fpm_id`, `fpm_topic_id`, `fpm_message`, `fpm_instructor`, `fpm_student`, `fpm_created_date`) VALUES
(6, 3, 'Assalamualaikum w.b.t', 27, NULL, '2022-04-26 09:06:28'),
(7, 4, 'Assalamualaikum w.b.t', 53, NULL, '2022-04-26 10:29:26'),
(9, 6, 'Assalamualaikum w.b.t', 54, NULL, '2022-04-26 12:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic_course`
--

CREATE TABLE `forum_topic_course` (
  `ftc_id` int(11) NOT NULL,
  `ftc_topic_name` text NOT NULL,
  `ftc_course_id` int(11) NOT NULL,
  `ftc_created_by` int(11) NOT NULL,
  `ftc_date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_topic_course`
--

INSERT INTO `forum_topic_course` (`ftc_id`, `ftc_topic_name`, `ftc_course_id`, `ftc_created_by`, `ftc_date_created`) VALUES
(2, 'Topic 1.1 Course UTM', 3, 53, '2022-04-17 10:13:44'),
(7, 'Topic 1', 1, 27, '2022-04-18 15:54:19'),
(14, 'Topic 2 : Logic Gate', 1, 27, '2022-04-24 09:56:43'),
(15, 'Topic 1 Course Lecturer', 4, 54, '2022-04-26 10:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic_mc`
--

CREATE TABLE `forum_topic_mc` (
  `ftm_id` int(11) NOT NULL,
  `ftm_topic_name` text NOT NULL,
  `ftm_mc_id` int(11) NOT NULL,
  `ftm_created_by` int(11) NOT NULL,
  `ftm_date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_topic_mc`
--

INSERT INTO `forum_topic_mc` (`ftm_id`, `ftm_topic_name`, `ftm_mc_id`, `ftm_created_by`, `ftm_date_created`) VALUES
(3, 'Topic 1 MC', 1, 27, '2022-04-25 15:59:43'),
(4, 'Topic 1', 4, 53, '2022-04-26 10:28:52'),
(6, 'Topic 2 : AI', 5, 54, '2022-04-26 11:15:47');

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
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`industry_id`, `industry_user_id`, `industry_role_id`, `industry_name`, `industry_email`, `industry_website`, `industry_contact_no`, `industry_address1`, `industry_address2`, `industry_city_id`, `industry_state_id`, `industry_country_id`, `industry_ssm`, `industry_industry_field_id`, `industry_created_by`, `industry_created_date`, `industry_updated_date`, `industry_deleted_date`, `industry_status`, `industry_logo`) VALUES
(1, 64, 6, 'EDESS Education Development & Solution Specialist Sdn Bhd', 'edess@gmail.com', 'https://edess.asia/', '017-7168361', 'Skudai', NULL, 'Batu Pahat', 1, 'Malaysia', '20220123101503UTM.png', 34, NULL, '2022-01-23 10:15:03', NULL, NULL, 'Active', NULL),
(2, 67, 6, 'Unicred SDN BHD 1', 'unicreds67@yahoo.com', 'unicreds67.com', '01111111', NULL, NULL, NULL, NULL, NULL, '20220127122611210909 - EDESS Payment Gateway - Adibbazli.pdf', 1, NULL, '2022-01-27 12:26:11', '2022-01-27 12:26:45', '2022-01-27 12:26:55', 'Inactive', NULL),
(3, 76, 6, 'Unicred SDN BHD', 'unicreds@gmail.com', 'unicreds.org', '0125466652', 'Skudai', NULL, 'Johor Bahru', 1, 'Malaysia', '20220223092736QxY1iBdU51hqy2S-Like-A-Boss-PNG-Transparent-Image.png', 64, NULL, '2022-02-23 09:27:36', NULL, NULL, 'Active', NULL);

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
-- Table structure for table `industry_information`
--

CREATE TABLE `industry_information` (
  `ii_id` int(11) NOT NULL,
  `ii_industry_id` int(11) NOT NULL,
  `ii_overview` longtext NOT NULL,
  `ii_company_size` varchar(255) NOT NULL,
  `ii_start_operation_date` date NOT NULL,
  `ii_benefit` longtext DEFAULT NULL,
  `ii_dress_code` text DEFAULT NULL,
  `ii_spoken_language` text DEFAULT NULL,
  `ii_working_hours` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `industry_information`
--

INSERT INTO `industry_information` (`ii_id`, `ii_industry_id`, `ii_overview`, `ii_company_size`, `ii_start_operation_date`, `ii_benefit`, `ii_dress_code`, `ii_spoken_language`, `ii_working_hours`) VALUES
(4, 1, '<p>&nbsp;About EDESS Education Development and Solutions Specialist Sdn Bhd&nbsp;</p><p><br>EDESS Education Development and Solutions Specialist Sdn Bhd (EDESS) is an educational development specialist organisation with expertise in digital education, curriculum development, professional development, education management, and education research and development. EDESS expertise is addressed to cater to educational institution and stakeholders needs, with the goal of enhancing learning and teaching by providing the latest education trends, solutions, and educational technologies.<br><br>Our Mission<br>• To provide quality educational solutions<br>• To promote digital learning technology supporting schools and educational institutions<br>• To support students’ learning<br><br>Our Vision<br>• To be the hub of 21st century digital education solutions<br><br>Values<br>• We empower the advancement of technology and digital services in enhancing the quality of the education and academic research without compromising on the ethical values and humanizing the systems</p>', '50-250 employees', '2018-06-01', NULL, NULL, NULL, NULL),
(5, 3, '<ul><li>Computer programming, consultancy and related activities, Education</li><li>Up to 10 employees</li><li>Johor Bahru</li><li>A. About EDESS Education Development and Solutions Specialist Sdn Bhd<br>EDESS Education Development and Solutions Specialist Sdn Bhd (EDESS) is an educational development specialist organisation with expertise in digital education, curriculum development, professional development, education management, and education research and development. EDESS expertise is addressed to cater to educational institution and stakeholders needs, with the goal of enhancing learning and teaching by providing the latest education trends, solutions, and educational technologies.<br><br>B. Our Mission<br>•	To provide quality educational solutions<br>•	To promote digital learning technology supporting schools and educational institutions<br>•	To support students’ learning<br><br>C. Our Vision<br>•	To be the hub of 21st century digital education solutions<br><br>D. Values<br>•	We empower the advancement of technology and digital services in enhancing the quality of the education and academic research without compromising on the ethical values and humanizing the systems</li></ul>', '10-50 employees', '2018-02-01', NULL, NULL, NULL, NULL);

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
(1, 12, 149, 5, 'contact@edess.asia', '07-550 0077 ', '201, Industry Centre Building, ICC, UTM Technovation Park, Jalan Pontian Lama, 81300 Skudai, Johor', 'Active', NULL, '2021-09-14 15:45:57', '2021-10-05 08:40:53', NULL, NULL),
(2, 6, 133, 5, 'corporate@utm.my', '07-553 3333 1', 'Universiti Teknologi Malaysia,\r\n81310 Skudai, Johor Bahru,\r\nJohor, Malaysia. fef', 'Active', NULL, '2021-09-13 11:29:15', '2021-09-20 14:36:24', NULL, NULL),
(3, 7, 129, 5, 'pspk@upm.edu.my', '03-9769 1000', 'Universiti Putra Malaysia, 43400 UPM Serdang Selangor Darul Ehsan, Malaysia ', 'Inactive', NULL, '2021-09-13 11:35:52', NULL, NULL, '1644713570_university_default.jpg'),
(4, 8, 119, 5, 'pkk@ukm.edu.my', '03-8921 5555 ', 'Universiti Kebangsaan Malaysia, 43600 UKM, 43600 Bangi, Selangor', 'Active', NULL, '2021-09-13 11:40:09', '2021-10-05 08:40:46', NULL, NULL),
(5, 29, 130, 5, 'hello@usm.my', '04-653 3888', 'Level 1, Building E42, Chancellory II \r\nUniversiti Sains Malaysia \r\n11800 USM Penang, Malaysia ', 'Active', NULL, '2021-09-21 09:44:41', NULL, NULL, NULL),
(6, 44, 138, 5, 'pro@uthm.edu.my', '07-453 7000', 'Universiti Tun Hussein Onn Malaysia (UTHM)\r\n86400 Parit Raja\r\nBatu Pahat Johor', 'Active', NULL, '2021-10-05 08:40:29', '2021-10-05 08:40:38', NULL, NULL),
(7, 58, 134, 5, 'webmedia@uitm.edu.my', '03-5544 2000', 'Universiti Teknologi MARA (UiTM)40450 Shah Alam, Selangor Darul Ehsan, Malaysia', 'Active', NULL, '2021-12-07 16:31:37', NULL, NULL, '1638866157_uitm.png'),
(8, 66, 76, 5, 'perdana1@yahoo.com', '01234568123', 'batu pahat', 'Inactive', NULL, '2022-01-27 12:24:15', '2022-01-27 12:24:42', '2022-01-27 12:24:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_code` varchar(10) NOT NULL,
  `job_title` text NOT NULL,
  `job_description` longtext NOT NULL,
  `job_responsibility` longtext DEFAULT NULL,
  `job_requirement` longtext DEFAULT NULL,
  `job_date_created` datetime DEFAULT NULL,
  `job_date_posted` datetime DEFAULT NULL,
  `job_no_of_vacancies` int(11) NOT NULL,
  `job_salary_currency` varchar(10) DEFAULT NULL,
  `job_min_salary` int(11) NOT NULL,
  `job_max_salary` int(11) NOT NULL,
  `job_type` enum('Full-Time','Part-Time','Temporary','Contract','Internship') NOT NULL,
  `job_category_id` int(11) NOT NULL,
  `job_position_id` int(11) DEFAULT NULL,
  `job_industry_id` int(11) NOT NULL,
  `job_level` enum('Entry Level','Manager','Senior Manager','Junior Executive','Senior Executive','Non Executive') NOT NULL,
  `job_experience_year` varchar(100) NOT NULL,
  `job_qualification` tinytext NOT NULL,
  `job_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_code`, `job_title`, `job_description`, `job_responsibility`, `job_requirement`, `job_date_created`, `job_date_posted`, `job_no_of_vacancies`, `job_salary_currency`, `job_min_salary`, `job_max_salary`, `job_type`, `job_category_id`, `job_position_id`, `job_industry_id`, `job_level`, `job_experience_year`, `job_qualification`, `job_status`) VALUES
(7, '', 'PROGRAMMER', '<p>LOREM IPSUM</p>', NULL, NULL, '2022-02-21 12:39:52', '2022-02-22 10:44:02', 2, 'RM', 2000, 2500, 'Full-Time', 8, NULL, 1, 'Entry Level', '1 year', 'Bachelor Degree, Degree Master', 'Active'),
(8, 'WB11', 'Web Developer/Programmer', '<p>We are currently looking for a dynamic programmer who can assist, analyse, develop, test and deliver projects. We want someone to gain experience with us, assisting in providing solutions for simple to complex problems and competent using all variants of programming language, someone with an engaging attitude and a fun and can-do approach.<br><br>Requirement and Qualification<br>• Possess at least a Diploma or equivalent<br>• More than 3 years of experience in PHP coding.<br>• Strong knowledge of PHP web frameworks such as Laravel framework and MySql.<br>• Good experience using programming languages<br>• Attentive to details and current trends<br>• Enthusiastic and resourceful<br>• Self-motivated and team-oriented<br>• Understanding of MVC design patterns.<br>• Basic understanding of front-end technologies, such as JavaScript, HTML5 and CSS3.<br>• Ability to troubleshoot, test and maintain the core product software and databases to ensure strong optimization and functionality.<br>• Ability to follow industry best practices.<br>• Ability to develop and deploy new features to facilitate related procedures and tools if necessary.<br>• Contribution in all phases of the development lifecycle.<br>• At least basic familiarity with at least 1 of the large cloud hosting ecosystems (AWS, AZURE, CenturyLink, etc).<br>• Ability to create database schemas that represent and support business processes.<br>• Familiarity with SQL/NoSQL databases and their declarative query languages.<br>• Proficient understanding of code versioning tools, such as Git.<br>• Ability to multitask, prioritize and manage time efficiently.<br>• Accurate and precise attention to details.<br>• Strong written and verbal communication skills.<br>• Excellent analytical, quantitative, and organizational skills.<br>• Good interpersonal and communication skills with all levels of management.<br><br>Job Scope<br>• Designing and testing computer structures<br>• Troubleshooting system errors<br>• Writing computer instructions<br>• Managing database systems<br>• Maintaining operating systems<br>• Editing source-code<br>• Profiling and analyzing algorithms<br>• Implementing build systems<br>• Providing tech support</p>', NULL, NULL, '2022-02-27 10:34:43', '2022-02-27 10:35:01', 2, 'RM', 3000, 3500, 'Contract', 8, NULL, 1, 'Junior Executive', '3 Years', 'Bachelor degree, Master', 'Active'),
(9, '123', 'Fullstack Developer ', '<p><strong>Responsibilities:</strong></p><ul><li>Responsible for web system and mobile web app development</li><li>Deliver high-quality programming works in a timely manner</li><li>Implement web applications to fulfill customer expectations with good quality</li><li>Follow with the high standard of system development procedures and methodologies</li><li>Perform system testing, deployment and maintenance from time to time</li><li>Opportunities to work on clients’ projects of different businesses ranging from FMCG, public utility to financial sectors</li></ul><p><strong>Requirements:</strong></p><ul><li>Diploma or above in Computer Science /&nbsp;Computer Engineering /&nbsp;IT or related disciplines</li><li>Solid experience in Web development is preferred, and we also welcome fresh graduates</li><li>High level of proficiency in written and spoken Cantonese and English</li><li>Hands-on experience&nbsp;with PHP, HTML, CSS, JavaScript and MySQL</li><li>Familiar with&nbsp;HTML5 and&nbsp;CSS3 is definitely an advantage</li><li>Working knowledge of&nbsp;Social Network Platform API (Facebook, Instagram, Twitter, Sina,&nbsp;etc)&nbsp;is a plus</li><li>Self-motivated team player and able to display passion in web development</li><li>Strong problem-solving, quality-oriented, responsible and initiative</li><li>A fast learner and able to work independently</li><li>Immediately available is preferred</li></ul><p>We offer attractive compensation package to suitable candidates. Interested parties, please click \"<strong>Apply Now</strong>\" to submit your application including your present &amp; expected salary.</p>', NULL, NULL, '2023-02-21 11:58:23', '2023-02-21 11:58:27', 1, 'RM', 2500, 3500, 'Full-Time', 8, NULL, 1, 'Junior Executive', '2', 'Bachelor of Software Engineering', 'Active');

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

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`jc_id`, `jc_code`, `jc_name`, `jc_description`) VALUES
(1, NULL, 'Accounting/Finance', NULL),
(2, NULL, 'Admin/Human Resources', NULL),
(3, NULL, 'Sales/Marketing', NULL),
(4, NULL, 'Arts/Media/Communications', NULL),
(5, NULL, 'Services', NULL),
(6, NULL, 'Hotel/Restaurant', NULL),
(7, NULL, 'Education/Training', NULL),
(8, NULL, 'Computer/Information Technology', NULL),
(9, NULL, 'Engineering', NULL),
(10, NULL, 'Manufacturing', NULL),
(11, NULL, 'Building/Construction', NULL),
(12, NULL, 'Sciences', NULL),
(13, NULL, 'Healthcare', NULL),
(14, NULL, 'Others', NULL);

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
  `jsua_status` varchar(255) NOT NULL,
  `jsua_summary` longtext NOT NULL,
  `jsua_attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_student_university_application`
--

INSERT INTO `job_student_university_application` (`jsua_id`, `jsua_job_id`, `jsua_student_university_id`, `jsua_application_date`, `jsua_status`, `jsua_summary`, `jsua_attachment`) VALUES
(5, 8, 9, '2022-03-10 09:25:42', 'Pending', 'test', ''),
(6, 7, 9, '2022-03-20 10:55:14', 'Pending', 'adad', ''),
(7, 9, 9, '2023-02-21 12:00:08', 'Pending', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `language_test_answer`
--

CREATE TABLE `language_test_answer` (
  `lta_id` int(11) NOT NULL,
  `lta_id_ltq_id` int(11) DEFAULT NULL,
  `lta_answer1` text DEFAULT NULL,
  `lta_answer2` text DEFAULT NULL,
  `lta_answer3` text DEFAULT NULL,
  `lta_answer4` text DEFAULT NULL,
  `lta_right_answerword` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_test_answer`
--

INSERT INTO `language_test_answer` (`lta_id`, `lta_id_ltq_id`, `lta_answer1`, `lta_answer2`, `lta_answer3`, `lta_answer4`, `lta_right_answerword`) VALUES
(1, 1, '645', '6546', '654656', '54654', '6546'),
(2, 2, 'Yes, me too.', 'Yes, you did.', 'Yes, very much.', 'Yes, very much.', 'Yes, you did.'),
(3, 3, 'Yes, please! ', 'If you like!', 'So do I!', 'She likes playing table tennis.', 'She likes playing table tennis.'),
(4, 4, 'hhh', 'hhh', '', '', 'hhh'),
(5, 5, 'cosmics', 'land', NULL, NULL, ''),
(6, 6, 'entanglement', 'discussion', NULL, NULL, 'entanglement'),
(7, 7, 'north and south', 'crosswise', NULL, NULL, 'north and south'),
(8, 8, 'imaginary circle passing through the poles', NULL, NULL, NULL, 'imaginary circle passing through the poles');

-- --------------------------------------------------------

--
-- Table structure for table `language_test_comp_pasage`
--

CREATE TABLE `language_test_comp_pasage` (
  `ltcp_id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `ltcp_passage` text DEFAULT NULL,
  `ltcp_created_by` int(11) DEFAULT NULL,
  `ltcp_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ltcp_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ltcp_deleted_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_test_comp_pasage`
--

INSERT INTO `language_test_comp_pasage` (`ltcp_id`, `test_id`, `ltcp_passage`, `ltcp_created_by`, `ltcp_created_date`, `ltcp_updated_date`, `ltcp_deleted_date`) VALUES
(1, 1, '<p>65654</p>', 132, '2023-02-07 12:05:34', NULL, NULL),
(2, 2, '<p>In the 16th century, an age of great marine and terrestrial exploration, Ferdinand Magellan led the first expedition to sail around the world. As a young Portuguese noble, he served the king of Portugal, but he became involved in the quagmire of political intrigue at court and lost the king’s favor. After he was dismissed from service by the king of Portugal, he offered to serve the future Emperor Charles V of Spain.</p><p>A papal decree of 1493 had assigned all land in the New World west of 50 degrees W longitude to Spain and all the land east of that line to Portugal. Magellan offered to prove that the East Indies fell under Spanish authority. On September 20, 1519, Magellan set sail from Spain with five ships. More than a year later, one of these ships was exploring the topography of South America in search of a water route across the continent. This ship sank, but the remaining four ships searched along the southern peninsula of South America. Finally they found the passage they sought near 50 degrees S latitude. Magellan named this passage the Strait of All Saints, but today it is known as the Strait of Magellan.</p><p>One ship deserted while in this passage and returned to Spain, so fewer sailors were privileged to gaze at that first panorama of the Pacific Ocean. Those who remained crossed the meridian now known as the International Date Line in the early spring of 1521 after 98 days on the Pacific Ocean. During those long days at sea, many of Magellan’s men died of starvation and disease.</p><p>Later, Magellan became involved in an insular conflict in the Philippines and was killed in a tribal battle. Only one ship and 17 sailors under the command of the Basque navigator Elcano survived to complete the westward journey to Spain and thus prove once and for all that the world is round, with no precipice at the edge.</p>', 27, '2023-03-01 13:55:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_test_question`
--

CREATE TABLE `language_test_question` (
  `ltq_id` int(11) NOT NULL,
  `ltqq_id` int(11) DEFAULT NULL,
  `ltq_id_ltc_id` int(11) DEFAULT NULL,
  `ltq_question` text DEFAULT NULL,
  `ltq_question_type` varchar(255) DEFAULT NULL,
  `epqq_score` int(11) NOT NULL,
  `ltq_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ltq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ltq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_test_question`
--

INSERT INTO `language_test_question` (`ltq_id`, `ltqq_id`, `ltq_id_ltc_id`, `ltq_question`, `ltq_question_type`, `epqq_score`, `ltq_created_date`, `ltq_updated_date`, `ltq_deleted_date`) VALUES
(1, 1, 1, '654', 'Multiple Choice Question', 0, '2023-02-07 12:05:34', NULL, NULL),
(2, 2, NULL, '<p>Did you enjoy the party, Clare?</p>', 'Multiple Choice Question', 0, '2023-03-01 13:47:19', NULL, NULL),
(3, 2, NULL, '<p>I love this photo of your family, David!</p><p><br>&nbsp;</p>', 'Multiple Choice Question', 0, '2023-03-01 13:48:02', NULL, NULL),
(4, 2, NULL, '<p>hhh</p>', 'Fill In The Blank', 0, '2023-03-01 13:50:02', NULL, NULL),
(5, 2, 2, ' The 16th century was an age of great ______ exploration.', 'Fill In The Blank', 0, '2023-03-01 13:55:35', NULL, NULL),
(6, 2, 2, 'Magellan lost the favor of the king of Portugal when he became involved in a political ________.', 'Fill In The Blank', 0, '2023-03-01 13:55:35', NULL, NULL),
(7, 2, 2, 'The Pope divided New World lands between Spain and Portugal according to their location on one side or the other of an imaginary geographical line 50 degrees west of Greenwich that extends in a _________ direction.', 'Fill In The Blank', 0, '2023-03-01 13:55:35', NULL, NULL),
(8, 2, 2, 'In the spring of 1521, the ships crossed the _______ now called the International Date Line.', 'Short Answers', 0, '2023-03-01 13:55:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_test_quiz`
--

CREATE TABLE `language_test_quiz` (
  `ltq_id` int(11) NOT NULL,
  `ltq_title` varchar(255) NOT NULL,
  `ltq_instruction` longtext NOT NULL,
  `ltq_duration` int(11) NOT NULL,
  `ltq_score` float NOT NULL,
  `ltq_created_by` int(11) NOT NULL,
  `ltq_updated_date` datetime NOT NULL,
  `ltq_deleted_date` timestamp NULL DEFAULT NULL,
  `ltq_status` enum('Published','Save Only') NOT NULL,
  `ltq_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_test_quiz`
--

INSERT INTO `language_test_quiz` (`ltq_id`, `ltq_title`, `ltq_instruction`, `ltq_duration`, `ltq_score`, `ltq_created_by`, `ltq_updated_date`, `ltq_deleted_date`, `ltq_status`, `ltq_created_date`) VALUES
(1, 'ytr', '<p>yty</p>', 454, 0, 132, '0000-00-00 00:00:00', NULL, 'Published', '2023-02-07 09:35:19'),
(2, 'Young Learners Test your English', '<h2>Test your English</h2><p>&nbsp;</p>', 55, 0, 27, '2023-03-01 13:45:09', NULL, 'Save Only', '2023-03-01 11:14:39');

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
(1, 46, 7, 'Abdullah', 'Ahmad', '', '701101015321', '', 'abdullah@utm.my', 'Male', '0177168361', '0000-00-00', '', '', 0, 0, 0, 2, 'Active', 0, '2021-10-07 10:38:18', '2021-10-07 10:39:39', '0000-00-00 00:00:00', 'Professor Madya', 'Faculty of Computing', 'Computer Science'),
(2, 48, 7, 'Abu Bakar', 'Ahmad', '', '620501015889', '', 'abubakar@usm.my', 'Male', '0177168365', '0000-00-00', '', '', 0, 0, 0, 5, 'Active', 0, '2021-10-07 15:01:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Professor', 'Faculty of Civil Engineering', 'Civil Engineering'),
(3, 49, 7, 'Abdul', 'Rahman', '', '', '', 'abdulrahman@utm.my', 'Male', '0196510806', '0000-00-00', '', '', 0, 0, 0, 2, 'Active', 0, '0000-00-00 00:00:00', '2021-11-02 16:39:39', '0000-00-00 00:00:00', 'Professor Madya', '', ''),
(4, 54, 7, 'Thaqif', 'Rajab', '', '', '', 'thaqif@edess.asia', 'Male', '017-7168361', '0000-00-00', '-', '1646790747_avatardefault.png', 0, 0, 0, 2, 'Active', 0, '0000-00-00 00:00:00', '2022-02-14 09:26:47', NULL, '-', '-', '-'),
(6, 56, 7, 'Thaqif', 'Rajab', NULL, '', NULL, 'thaqifrajab@edess.asia', 'Male', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Active', NULL, NULL, '2022-01-30 10:00:14', NULL, '', '', ''),
(7, 57, 7, 'test', 'testing', NULL, NULL, NULL, 'test@edess.asia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 69, 7, 'Hussain', 'Hamid', NULL, '640601015889', NULL, 'hamid@upm.my', 'Male', '0177168361', NULL, NULL, NULL, NULL, NULL, NULL, 3, 'Active', NULL, '2022-02-13 08:42:21', NULL, NULL, 'Profesor Madya', 'Faculty of Engineering', 'Civil Engineering'),
(10, 71, 7, 'Adibah 1', 'Abd Latif', NULL, '790101015321', NULL, 'adibah1@edess.asia', 'Male', '017716836111', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Inactive', NULL, '2022-02-13 11:29:56', '2022-02-13 11:31:13', '2022-02-13 11:31:26', 'Profesor ', 'Faculty of Education', 'Education'),
(12, 75, 7, 'Faliq', 'Ahmad', NULL, '', NULL, 'faliq@edess.asia', 'Male', '0177168361', NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Active', NULL, '2022-02-14 12:37:26', '2022-02-14 12:38:31', NULL, 'Profesor ', 'Faculty of Computing', 'Bioinformatics'),
(14, 113, 7, 'Farhan', 'Azhar', NULL, NULL, NULL, 'farhanmohdazhar15@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Active', NULL, '2022-04-04 11:59:16', NULL, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `mc_course_credit_transfer`
--

INSERT INTO `mc_course_credit_transfer` (`mccct_id`, `mccct_mc_id`, `mccct_course_title`, `mccct_course_code`, `mccct_course_level`, `mccct_course_credit`, `mccct_created_by`, `mccct_created_date`, `mccct_updated_date`, `mccct_deleted_date`) VALUES
(1, 6, 'Artificial Intelligence', 'AI100', '0,1', NULL, 53, '2022-05-08 10:38:12', NULL, NULL);

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

--
-- Dumping data for table `mc_learning_details`
--

INSERT INTO `mc_learning_details` (`mcld_id`, `mcld_mc_id`, `mcld_learning_outcome`, `mcld_intended_learners`, `mcld_prerequisites`, `mcld_skills`) VALUES
(1, 1, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(2, 2, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(3, 3, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(4, 4, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(5, 5, '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>', '<p>lorem ipsum</p>'),
(6, 6, '<p>Test</p>', '<p>undergraduate</p>', '<p>no specific skill</p>', '<p>N/A</p>');

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

--
-- Dumping data for table `mc_mou`
--

INSERT INTO `mc_mou` (`mcm_id`, `mcm_mc_id`, `mcm_institution_id`, `mcm_user_request_id`, `mcm_collaboration`, `mcm_attachment`, `mcm_created_date`) VALUES
(1, 3, 2, 27, '<p>lorem ipsum</p>', '20220426091321microcredential-proposal.pdf', '2022-04-26 09:13:21'),
(2, 5, 4, 54, '<p>lorem ipsum</p>', '20220426110238Payment Gateway Comparison for EDESS UNICREDS Use Case.pdf', '2022-04-26 11:02:38');

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
(1, 6, 'Note Topic 1', '<p>test</p>', '20220508104612MQA and New Zealand Micro-Credential standard.pdf', NULL, '2022-05-08 10:46:12', 53, NULL, NULL, 'Published');

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

--
-- Dumping data for table `mc_quiz`
--

INSERT INTO `mc_quiz` (`mcq_id`, `mcq_mc_id`, `mcq_title`, `mcq_instruction`, `mcq_duration`, `mcq_score`, `mcq_created_date`, `mcq_created_by`, `mcq_updated_date`, `mcq_deleted_date`, `mcq_status`) VALUES
(1, 6, 'Quiz 1', '<p>please anwer all questions</p>', 60, NULL, '2022-05-08 11:08:19', 53, NULL, NULL, 'Published');

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

--
-- Dumping data for table `mc_quiz_answer`
--

INSERT INTO `mc_quiz_answer` (`mcqa_id`, `mcqa_mc_quiz_question_id`, `mcqa_answer1`, `mcqa_answer2`, `mcqa_answer3`, `mcqa_answer4`, `mcqa_right_answer`, `mcqa_right_answerword`) VALUES
(1, 1, 'A ', 'B', 'C', 'D', '1', 'A '),
(2, 2, '1', '2', '3', '4', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `mc_quiz_question`
--

CREATE TABLE `mc_quiz_question` (
  `mcqq_id` int(11) NOT NULL,
  `mcqq_mc_quiz_id` int(11) NOT NULL,
  `mcqq_type` varchar(125) DEFAULT NULL,
  `mcqq_figure` text DEFAULT NULL,
  `mcqq_figure_caption` tinytext DEFAULT NULL,
  `mcqq_question` text NOT NULL,
  `mcqq_score` float DEFAULT NULL,
  `mcqq_created_date` datetime DEFAULT current_timestamp(),
  `mcqq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `mcqq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_quiz_question`
--

INSERT INTO `mc_quiz_question` (`mcqq_id`, `mcqq_mc_quiz_id`, `mcqq_type`, `mcqq_figure`, `mcqq_figure_caption`, `mcqq_question`, `mcqq_score`, `mcqq_created_date`, `mcqq_updated_date`, `mcqq_deleted_date`) VALUES
(1, 1, 'Multiple Choice', NULL, NULL, '<p>What is neul</p>', NULL, '2022-05-08 11:09:40', NULL, NULL),
(2, 1, 'Multiple Choice', NULL, NULL, '<p>Test&nbsp;</p>', NULL, '2022-05-08 11:09:56', NULL, NULL);

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

--
-- Dumping data for table `mc_test`
--

INSERT INTO `mc_test` (`mct_id`, `mct_mc_id`, `mct_title`, `mct_instruction`, `mct_duration`, `mct_score`, `mct_created_date`, `mct_created_by`, `mct_updated_date`, `mct_deleted_date`, `mct_status`) VALUES
(1, 6, 'Test Topic 1', '<p>test</p>', 60, NULL, '2022-05-08 11:15:13', 53, NULL, NULL, 'Published');

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
  `mctq_figure` text DEFAULT NULL,
  `mctq_figure_caption` tinytext DEFAULT NULL,
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

--
-- Dumping data for table `mc_video`
--

INSERT INTO `mc_video` (`mcv_id`, `mcv_mc_id`, `mcv_title`, `mcv_description`, `mcv_attachment`, `mcv_duration`, `mcv_created_date`, `mcv_created_by`, `mcv_updated_date`, `mcv_deleted_date`, `mcv_status`) VALUES
(1, 6, 'Topic 1', '<p>test</p>', '20220508105550logic gate.mp4', '7m 13s ', '2022-05-08 10:54:56', 53, '2022-05-08 10:55:50', NULL, 'Published');

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

--
-- Dumping data for table `microcredential`
--

INSERT INTO `microcredential` (`mc_id`, `mc_title`, `mc_code`, `mc_description`, `mc_category`, `mc_level`, `mc_duration`, `mc_fee`, `mc_credit`, `mc_credit_transfer`, `mc_total_enrolled`, `mc_created_by`, `mc_owner`, `mc_created_date`, `mc_published_date`, `mc_updated_date`, `mc_deleted_date`, `mc_image`, `mc_status`, `mc_enrollment_date`) VALUES
(1, 'Digital Logic', '', '<p>lorem ipsum</p>', 'Computer Science', '1,3', '12 Weeks', '7000', '', NULL, 1, 27, 1, '2022-03-17 10:09:15', NULL, '2022-03-28 11:09:50', NULL, '20220317100915images.jfif', 'Published', 'anytime'),
(2, 'Discrete Structure', '', '<p>lorem ipsum</p>', 'Computer Science', '1,3', '12 Weeks', '10000', '', NULL, 1, 27, 1, '2022-03-28 08:51:05', NULL, '2022-03-28 11:09:50', NULL, '20220328085105application statistic.jpg', 'Published', 'anytime'),
(3, 'Logic Gate', '', '<p>lorem ipsum</p>', 'Computer Science', '1', '10 Weeks', '30000', '', 'No', 0, 27, 2, '2022-04-26 09:13:21', NULL, NULL, NULL, '20220426091321images.jfif', 'Draft', 'anytime'),
(4, 'Neural Network', '', '<p>lorem ipsum</p>', 'Computer Science', '1', '20 Weeks', '20000', '', 'No', 5, 53, 2, '2022-04-26 10:27:37', NULL, '2022-04-26 14:02:25', NULL, '20220426102737nn.png', 'Published', 'anytime'),
(5, 'Artificial Intelligence', '', '<p>lorem ipsum</p>', 'Big Data', '3', '20 Weeks', '20000', '', 'No', 4, 54, 4, '2022-04-26 11:02:38', NULL, '2022-05-08 11:44:05', NULL, '20220426110238pemikirankomputasional.jpg', 'Processing', 'anytime'),
(6, 'Neural Network', '', '<p>neural network</p>', 'Computer Science', '1', '40 Hours', '10000', '', 'Yes', 0, 53, 2, '2022-05-08 10:38:12', NULL, NULL, NULL, '20220508103812course research.jpg', 'Draft', 'anytime');

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
(1, 2, ''),
(2, 49, '');

-- --------------------------------------------------------

--
-- Table structure for table `psychometric_test`
--

CREATE TABLE `psychometric_test` (
  `pt_id` int(11) NOT NULL,
  `pt_title` varchar(255) NOT NULL,
  `pt_instruction` longtext NOT NULL,
  `pt_duration` int(11) NOT NULL,
  `pt_status` enum('Published','Save Only') NOT NULL,
  `pt_score` float NOT NULL,
  `pt_created_by` int(11) DEFAULT NULL,
  `pt_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `pt_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `pt_deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psychometric_test`
--

INSERT INTO `psychometric_test` (`pt_id`, `pt_title`, `pt_instruction`, `pt_duration`, `pt_status`, `pt_score`, `pt_created_by`, `pt_created_date`, `pt_updated_date`, `pt_deleted_date`) VALUES
(1, 'CAREER PERSONALITY TEST', '<h2><strong>Instructions</strong></h2><ul><li>This personality test contains 120 statements. There is no time limit. Most people take about 15 minutes - please allow yourself plenty of time.</li><li>Please respond to all of the statements and answer in sequence.</li><li>Double-check that you have made the right choice. If you need to change an answer, simply select the new response and the incorrect response will disappear.</li><li>Try not to use the \'Neutral\' option too often.</li><li>Describe yourself as you generally are now, not as you wish to be in the future.</li><li>Describe yourself, as you honestly see yourself, in relation to other people of the same sex and of roughly the same age. Your spontaneous answer is usually the most accurate.</li></ul>', 60, 'Published', 0, 27, '2022-12-27 12:05:28', '2023-04-11 09:49:48', NULL),
(2, 'Psychometric Test', '<h2><strong>Instructions</strong></h2><ul><li>This personality test contains 120 statements. There is no time limit. Most people take about 15 minutes - please allow yourself plenty of time.</li><li>Please respond to all of the statements and answer in sequence.</li><li>Double-check that you have made the right choice. If you need to change an answer, simply select the new response and the incorrect response will disappear.</li><li>Try not to use the \'Neutral\' option too often.</li><li>Describe yourself as you generally are now, not as you wish to be in the future.</li><li>Describe yourself, as you honestly see yourself, in relation to other people of the same sex and of roughly the same age. Your spontaneous answer is usually the most accurate.</li></ul>', 180, 'Save Only', 0, 27, '2023-01-02 10:37:09', '2023-01-04 08:49:04', NULL),
(12, 'Test', '<p>test</p>', 0, 'Save Only', 0, 132, '2023-03-01 12:12:32', NULL, NULL),
(13, '5656', '<p>5656</p>', 65, 'Save Only', 0, 27, '2023-04-11 09:53:30', '2023-04-11 09:53:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `psychometric_test_question`
--

CREATE TABLE `psychometric_test_question` (
  `ptq_id` int(11) NOT NULL,
  `ptq_pt_id` int(11) NOT NULL,
  `ptq_pts_id` int(255) DEFAULT NULL,
  `ptq_type` varchar(255) NOT NULL,
  `ptq_question` longtext NOT NULL,
  `ptq_score` float DEFAULT NULL,
  `question_img` varchar(150) DEFAULT NULL,
  `ptq_option1` varchar(255) DEFAULT NULL,
  `ptq_option2` varchar(255) DEFAULT NULL,
  `ptq_option3` varchar(255) DEFAULT NULL,
  `ptq_option4` varchar(255) DEFAULT NULL,
  `ptq_option5` varchar(255) DEFAULT NULL,
  `ptq_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ptq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ptq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psychometric_test_question`
--

INSERT INTO `psychometric_test_question` (`ptq_id`, `ptq_pt_id`, `ptq_pts_id`, `ptq_type`, `ptq_question`, `ptq_score`, `question_img`, `ptq_option1`, `ptq_option2`, `ptq_option3`, `ptq_option4`, `ptq_option5`, `ptq_created_date`, `ptq_updated_date`, `ptq_deleted_date`) VALUES
(12, 1, 1, 'Multiple Choice', '<p>When it first appeared in English, the word ‘personality’ referred to what?</p>', NULL, NULL, 'Irritation', 'Curiosity ', 'Extraversion', 'Carelessness', '', '2023-01-05 13:25:49', NULL, NULL),
(13, 1, 1, 'Multiple Choice', 'Which of the following characteristics is difficult to define as either intellectual or non-intellectual individual differences?', NULL, NULL, 'Irritation', 'Curiosity ', 'Extraversion', 'Carelessness', '', '2023-01-05 13:25:49', NULL, NULL),
(14, 1, 1, 'Multiple Choice', 'How could we conceptualize the relationship between a musical taste and a personality disposition?', NULL, NULL, 'Irritation', 'Curiosity ', 'Extraversion', 'Carelessness', '', '2023-01-05 13:25:49', NULL, NULL),
(15, 1, 1, 'Multiple Choice', ' Which of the following would probably not be considered a personality characteristic?', NULL, NULL, 'Irritation', 'Curiosity ', 'Extraversion', 'Carelessness', '', '2023-01-05 13:25:49', NULL, NULL),
(16, 1, 3, 'Disagree/Agree', '<p>I am easy going.&nbsp;</p>', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(17, 1, 3, 'Disagree/Agree', 'I have high standards. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(18, 1, 3, 'Disagree/Agree', 'I enjoy time alone. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(19, 1, 3, 'Disagree/Agree', 'I work well with others. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(20, 1, 3, 'Disagree/Agree', 'I dislike confrontation. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(21, 1, 3, 'Disagree/Agree', 'I prefer crowds over intimacy. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(22, 1, 3, 'Disagree/Agree', 'I feel like no one understands me. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(23, 1, 3, 'Disagree/Agree', 'I am not easily awakened by noise. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(24, 1, 3, 'Disagree/Agree', 'I do my best to get along with everyone. ', NULL, NULL, 'Strongly Disagree', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Strongly Agree', '2023-01-05 13:31:09', NULL, NULL),
(198, 1, 1, 'Disagree/Agree', '<p>jhjghjh</p>', NULL, 'h', 'Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Array', '2023-01-11 15:12:19', NULL, NULL),
(199, 1, 1, 'Disagree/Agree', 'uyuyuyt', NULL, 'c', 'Strongly Disagree1', 'Somewhat Disagree', 'No Opinion', 'Somewhat Agree', 'Array', '2023-01-11 15:12:19', NULL, NULL),
(200, 1, 34, 'Multiple Choice', '<p>jghj</p>', NULL, 's', 'kkkk', 'kkkk', 'uiuii', 'juuuu', '', '2023-01-11 15:13:11', NULL, NULL),
(201, 1, 34, 'Multiple Choice', 'iuiouo', NULL, '0', '45', '545', '435', '54', '', '2023-01-11 15:13:11', NULL, NULL),
(202, 1, 34, 'Multiple Choice', '<p>uyuyuy</p>', NULL, 'S', 'uy', 'u', 'u', 'u', '', '2023-01-11 15:15:37', NULL, NULL),
(203, 1, 1, 'Text', '<p>jjjj</p>', NULL, '2', '', '', '', '', '', '2023-01-11 17:43:28', NULL, NULL),
(204, 1, 1, 'Text', 'ghggh', NULL, '0', '', '', '', '', '', '2023-01-11 17:43:28', NULL, NULL),
(205, 1, 3, 'True/False', '<p>tdthdthhddt</p>', NULL, '2', 'True', 'False', '', '', '', '2023-01-11 17:44:03', NULL, NULL),
(206, 1, 3, 'True/False', 'fgfgcgccg', NULL, '0', 'True', 'False', '', '', '', '2023-01-11 17:44:03', NULL, NULL),
(207, 12, 1, 'Multiple Choice', '<p>5555</p>', NULL, '', '123', '1233', '1254', '1520', '', '2023-03-01 14:45:46', NULL, NULL),
(208, 12, 1, 'Multiple Choice', '1520', NULL, '', '1422', '2020', '1221', '2322', '', '2023-03-01 14:45:46', NULL, NULL),
(209, 0, 0, 'Multiple Choice', '<p>555</p>', NULL, '2', '2', '2', '2', '2', '', '2023-04-11 12:24:16', NULL, NULL),
(210, 0, 0, 'Multiple Choice', '221', NULL, '0', '11', '11', '11', '11', '', '2023-04-11 12:24:16', NULL, NULL),
(235, 0, 39, 'Multiple Choice', '<p>545</p>', NULL, '2', '55', '55', '55', '555', '', '2023-04-11 12:28:49', NULL, NULL),
(237, 0, 40, 'Text', '<p>545456</p>', NULL, '20230411122949crossword_update_clue.png', '', '', '', '', '', '2023-04-11 12:29:05', '2023-04-11 09:59:49', NULL),
(238, 0, 40, 'Text', '<p>545454</p>', NULL, '20230411122921riddle 4.png', '', '', '', '', '', '2023-04-11 12:29:05', '2023-04-11 09:59:21', NULL),
(239, 0, 39, 'Disagree/Agree', '<p>555</p>', NULL, '2', 'Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Array', '2023-04-11 12:30:01', NULL, NULL),
(241, 0, 40, 'True/False', '<p>5745645</p>', NULL, '2', 'True', 'False', '', '', '', '2023-04-11 12:32:19', NULL, NULL),
(242, 0, 40, 'True/False', '4545', NULL, '0', 'True', 'False', '', '', '', '2023-04-11 12:32:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `psychometric_test_section`
--

CREATE TABLE `psychometric_test_section` (
  `pts_id` int(11) NOT NULL,
  `pts_pt_id` int(11) DEFAULT NULL,
  `pts_name` varchar(255) NOT NULL,
  `pts_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `pts_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `pts_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psychometric_test_section`
--

INSERT INTO `psychometric_test_section` (`pts_id`, `pts_pt_id`, `pts_name`, `pts_created_date`, `pts_updated_date`, `pts_deleted_date`) VALUES
(1, 1, 'SECTION D', '2023-01-05 12:55:18', '2023-01-06 15:37:48', NULL),
(3, 1, 'SECTION B', '2023-01-04 12:09:51', '2023-03-01 12:13:54', NULL),
(33, 1, 'SECTION E', '2023-01-06 14:24:10', '2023-01-06 15:38:02', NULL),
(34, 1, 'SECTION F', '2023-01-06 18:03:22', '2023-01-06 15:38:14', NULL),
(35, 2, 'section a', '2023-01-10 19:12:24', NULL, NULL),
(36, 2, 'section b', '2023-01-10 19:12:35', NULL, NULL),
(37, 2, 'section c', '2023-01-10 19:12:45', NULL, NULL),
(38, NULL, '123', '2023-03-01 14:44:53', NULL, NULL),
(39, 0, '5533', '2023-04-11 12:23:51', '2023-04-11 10:03:51', NULL),
(40, 0, '22', '2023-04-11 12:25:20', NULL, NULL);

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
(9, 'Student', 'student', '2021-08-15 06:58:19', NULL, NULL),
(10, 'Committee', 'committee', '2021-11-07 14:54:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skill_assessment_test`
--

CREATE TABLE `skill_assessment_test` (
  `st_id` int(11) NOT NULL,
  `st_title` varchar(255) NOT NULL,
  `st_industry_field` int(255) NOT NULL,
  `st_instruction` longtext NOT NULL,
  `st_duration` int(11) NOT NULL,
  `st_status` enum('Published','Save Only') NOT NULL,
  `st_score` float NOT NULL,
  `st_created_by` int(11) DEFAULT NULL,
  `st_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `st_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `stq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_assessment_test`
--

INSERT INTO `skill_assessment_test` (`st_id`, `st_title`, `st_industry_field`, `st_instruction`, `st_duration`, `st_status`, `st_score`, `st_created_by`, `st_created_date`, `st_updated_date`, `stq_deleted_date`) VALUES
(1, 'PHP TEST', 110, '<p><strong>Rules to follow during all online proctored exams:</strong></p><ol><li>You must use a functioning webcam and microphone.</li><li>No cell phones or other secondary devices in the room or test area.</li><li>Your desk/table must be clear or any materials except your test-taking device.</li><li>No one else can be in the room with you.</li><li>No talking.</li></ol><p><br>&nbsp;</p>', 30, 'Published', 0, 27, '2023-01-27 12:18:52', '2023-01-30 14:37:11', NULL),
(2, 'File Upload', 23, '<p><strong>Rules to follow during all online proctored exams:</strong></p><ol><li>You must use a functioning webcam and microphone.</li><li>No cell phones or other secondary devices in the room or test area.</li><li>Your desk/table must be clear or any materials except your test-taking device.</li><li>No one else can be in the room with you.</li><li>No talking.</li></ol><p><br>&nbsp;</p>', 220, 'Published', 0, 27, '2023-01-27 12:34:54', '2023-01-31 09:27:29', NULL),
(5, '987987jhjhg', 16, '<p>89987jhjh</p>', 98, 'Published', 0, 132, '2023-01-31 15:26:27', '2023-02-09 10:32:27', NULL),
(6, 'hfgh', 2, '<p>hgfhgfh</p>', 65, 'Published', 0, 27, '2023-02-09 10:00:03', '2023-03-01 12:08:03', NULL),
(7, 'test', 23, '<p>testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>', 30, 'Published', 0, 132, '2023-02-09 10:52:57', NULL, NULL),
(8, '23', 13, '<p>65265</p>', 20, 'Published', 0, 27, '2023-04-11 10:55:14', '2023-04-11 10:55:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skill_assessment_test_answer`
--

CREATE TABLE `skill_assessment_test_answer` (
  `stqa_id` int(11) NOT NULL,
  `stqa_stq_id` int(11) NOT NULL,
  `stqa_answer1` text DEFAULT NULL,
  `stqa_answer2` text DEFAULT NULL,
  `stqa_answer3` text DEFAULT NULL,
  `stqa_answer4` text DEFAULT NULL,
  `stqa_right_answer` text DEFAULT NULL,
  `stqa_right_answer_word` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_assessment_test_answer`
--

INSERT INTO `skill_assessment_test_answer` (`stqa_id`, `stqa_stq_id`, `stqa_answer1`, `stqa_answer2`, `stqa_answer3`, `stqa_answer4`, `stqa_right_answer`, `stqa_right_answer_word`) VALUES
(1, 1, 'PHP is an open-source programming language', 'PHP is used to develop dynamic and interactive websites', 'PHP is a server-side scripting language', 'All of the mentioned', '4', 'All of the mentioned'),
(2, 2, 'PHP stands for Preprocessor Home Page', 'PHP stands for Pretext Hypertext Processor', 'PHP stands for Hypertext Preprocessor', 'PHP stands for Personal Hyper Processor', '3', 'PHP stands for Hypertext Preprocessor'),
(3, 3, '#', '//', ' /* */', 'All of the mentioned', '4', 'All of the mentioned'),
(4, 4, '10', '7', '8', '9', '3', '8'),
(5, 5, 'Apache and PHP', 'IIS', 'XAMPP', 'Any of the mentioned', '1', 'Apache and PHP'),
(10, 20, '1', '2', '3', '4', '3', '3'),
(11, 22, 'sunil test11', 'sunil test2', 'sunil test3', 'sunil test4', '2', 'sunil test2');

-- --------------------------------------------------------

--
-- Table structure for table `skill_assessment_test_question`
--

CREATE TABLE `skill_assessment_test_question` (
  `stq_id` int(11) NOT NULL,
  `stq_st_id` int(11) NOT NULL,
  `stq_type` varchar(255) NOT NULL,
  `stq_question` longtext DEFAULT NULL,
  `stq_fileupload` varchar(255) DEFAULT NULL,
  `stq_score` int(11) DEFAULT NULL,
  `stq_created_date` datetime DEFAULT current_timestamp(),
  `stq_updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `stq_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_assessment_test_question`
--

INSERT INTO `skill_assessment_test_question` (`stq_id`, `stq_st_id`, `stq_type`, `stq_question`, `stq_fileupload`, `stq_score`, `stq_created_date`, `stq_updated_date`, `stq_deleted_date`) VALUES
(1, 1, 'multiple choice', '<p>What is PHP?<br>&nbsp;</p>', NULL, NULL, '2023-01-27 14:50:14', NULL, NULL),
(2, 1, 'multiple choice', '<p>What does <strong>PHP</strong> stand for?</p>', NULL, NULL, '2023-01-27 14:52:24', NULL, NULL),
(3, 1, 'multiple choice', '<p>Which of the following is the correct way to add a comment in PHP code?</p>', NULL, NULL, '2023-01-27 14:53:01', NULL, NULL),
(4, 1, 'multiple choice', '<p>How many functions does PHP offer for searching and modifying strings using Perl-compatible regular expressions.</p>', NULL, NULL, '2023-01-27 14:53:35', NULL, NULL),
(5, 1, 'multiple choice', '<p>Which of the following web servers are required to run the PHP script?</p>', NULL, NULL, '2023-01-27 14:54:29', NULL, NULL),
(6, 2, 'fileupload', NULL, '20230127150513221005-Helpdesk Ticketing system.pdf', NULL, '2023-01-27 12:35:13', NULL, NULL),
(7, 2, 'fileupload', NULL, '20230130142702Weekly_Progress_Report (WEEK 7).pdf', NULL, '2023-01-30 09:53:30', '2023-01-30 11:57:02', NULL),
(8, 2, 'fileupload', NULL, '20230130122421Tutorial Using Git.pdf', NULL, '2023-01-30 09:54:21', NULL, NULL),
(9, 2, 'fileupload', NULL, '20230130122433Deccan New Chaitanya Junior college (Fresh and Renewal).pdf', NULL, '2023-01-30 09:54:33', NULL, NULL),
(12, 3, 'fileupload', NULL, '20230130142618Weekly_Progress_Report (WEEK_12).pdf', NULL, '2023-01-30 11:54:33', '2023-01-30 11:56:18', NULL),
(14, 4, 'multiple choice', '<p>hgjhgj</p>', NULL, NULL, '2023-01-31 17:49:32', NULL, NULL),
(18, 6, 'multiple choice', '<p>ghfh</p>', NULL, NULL, '2023-02-09 12:30:53', NULL, NULL),
(20, 5, 'multiple choice', '<p>ghgfh</p>', NULL, NULL, '2023-02-09 12:59:20', NULL, NULL),
(21, 5, 'fileupload', NULL, '20230209125927Invoice-EB0112E9-0001.pdf', NULL, '2023-02-09 10:29:27', NULL, NULL),
(22, 7, 'multiple choice', '<p>sunil test</p>', NULL, NULL, '2023-02-09 13:23:26', NULL, NULL),
(23, 7, 'multiple choice', '<p>fgjgh</p>', NULL, NULL, '2023-02-09 13:23:51', NULL, NULL),
(24, 7, 'fileupload', NULL, '20230209132417Invoice-EB0112E9-0001.pdf', NULL, '2023-02-09 10:54:04', '2023-02-09 10:54:17', NULL),
(26, 5, 'fileupload', NULL, '20230209141219Invoice-EB0112E9-0001.pdf', NULL, '2023-02-09 11:42:19', NULL, NULL);

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
(1, 'php'),
(2, 'html'),
(3, 'php'),
(5, 'html'),
(7, 'javascript'),
(8, 'jQuery'),
(9, 'AJAX'),
(10, 'PHP');

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
  `su_updated_date` datetime DEFAULT NULL,
  `su_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university`
--

INSERT INTO `student_university` (`su_id`, `su_user_id`, `su_role_id`, `su_city_id`, `su_state_id`, `su_country_id`, `su_institution_id`, `su_fname`, `su_lname`, `su_no_ic`, `su_passport_no`, `su_matric_no`, `su_email`, `su_gender`, `su_contact_no`, `su_dob`, `su_address`, `su_nationality`, `su_registered_date`, `su_status`, `su_cv`, `su_profile_pic`, `su_created_date`, `su_updated_date`, `su_deleted_date`) VALUES
(5, 30, 9, NULL, NULL, NULL, 2, 'test', 'testing', NULL, NULL, NULL, 'testing@gmail.com', NULL, NULL, NULL, NULL, NULL, '2021-09-22 09:35:43', 'Active', NULL, '', NULL, NULL, NULL),
(6, 34, 9, NULL, NULL, NULL, 4, 'Hakim', 'Halim', NULL, NULL, NULL, 'hakim@yahoo.com', NULL, NULL, NULL, NULL, NULL, '2021-09-27 11:06:39', 'Active', NULL, '', NULL, NULL, NULL),
(7, 39, 9, NULL, NULL, NULL, 2, 'Abdul ', 'Khaliq', NULL, NULL, NULL, 'abdulkhaliq@yahoo.com', NULL, NULL, NULL, NULL, NULL, '2021-10-03 15:58:28', 'Active', NULL, '', NULL, NULL, NULL),
(9, 50, 9, 49, 1, 1, 2, 'Khayra', 'Humaira', '0101010101', '-', 'A13CS0080', 'humaira@gmail.com', 'Female', '0177168361', '2021-11-18', 'NO.73, jalan ayer hitam', 'Malaysia', '2021-11-02 16:21:30', 'Active', 'pre production.pdf', NULL, NULL, '2021-12-01 09:55:12', NULL),
(10, 77, 9, 2, 1, 1, 1, 'Hadi', 'Ghazali', '930101015321', '', 'A13CS0070', 'hadi.ghazali@edess.asia', 'Male', '0177168361', '1993-01-27', 'NO.73, jalan ayer hitam', 'Malaysia', '2022-02-27 10:51:22', 'Active', NULL, 'hero-img.png', NULL, '2022-02-27 10:52:37', NULL),
(11, 78, 9, NULL, NULL, NULL, 1, 'farhan', 'mohamad', NULL, NULL, NULL, 'farhan@edess.asia', NULL, NULL, NULL, NULL, NULL, '2022-03-01 11:29:31', 'Active', NULL, NULL, NULL, NULL, NULL),
(20, 130, 9, 49, 1, 1, 1, 'thaqif', 'rajab', '990405015321', '', NULL, 'thaqif_rajab@yahoo.com', 'Male', '0177896541', '1994-06-01', 'skudai', 'Malaysia', '2022-04-07 14:54:38', 'Active', NULL, NULL, NULL, '2022-11-16 15:08:15', NULL);

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
(0, 38, 18, 'test', '2021-10-06 16:56:16', '2021-10-06 16:56:28'),
(0, 53, 50, 'test', '2022-02-27 09:31:59', NULL),
(0, 27, 50, 'assalamualaikum', '2022-04-07 16:02:29', NULL),
(0, 27, 50, 'waalaikumussalam', '2022-04-11 15:07:50', NULL);

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
-- Table structure for table `student_university_education_details`
--

CREATE TABLE `student_university_education_details` (
  `sued_id` int(11) NOT NULL,
  `sued_student_university_id` int(11) NOT NULL,
  `sued_course_title` text NOT NULL,
  `sued_course_description` longtext NOT NULL,
  `sued_college_name` text NOT NULL,
  `sued_linked in` varchar(200) NOT NULL,
  `sued_course_start_date` date NOT NULL,
  `sued_course_end_date` date DEFAULT NULL,
  `sued_course_status` enum('Current','Past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university_education_details`
--

INSERT INTO `student_university_education_details` (`sued_id`, `sued_student_university_id`, `sued_course_title`, `sued_course_description`, `sued_college_name`, `sued_linked in`, `sued_course_start_date`, `sued_course_end_date`, `sued_course_status`) VALUES
(103, 23, 'Mpcsvgbujhhnjoj', '<p>9.0/10</p>', 'Sree Sai degree College', '', '2022-12-01', '2022-12-31', 'Past');

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
(6, 24, 57, 1, 1, 'Full Stack Developer', '<p>fff</p>', 'Intelcode', 'jyjjj', '2022-11-06', '0000-00-00', 'Current'),
(7, 24, 82, 2, 1, 'Full Stack Developerk', '<p>sddd ddd dddd&nbsp;</p>', 'Intelcode', 'bodagudipadu', '2022-01-24', '0000-00-00', 'Current'),
(10, 9, 64, 2, 1, 'Programmer Senior ', '<p>SAYA BEKERJA DI KEDAH</p>', 'UNICREDS SDN BHD', 'level 201, utm technovation park UTM SPACE', '2021-01-01', '0000-00-00', 'Current'),
(12, 9, 12, 1, 1, 'Network Engineer', '<p>cuba cuba</p>', 'Novocraft Sdn Bhd', 'pasir gudang', '2019-01-24', '2020-12-31', 'Past'),
(14, 9, 25, 1, 1, 'Programmer', '<p>adadada</p>', 'edess', 'skudai', '2018-01-01', '2018-12-01', 'Past'),
(18, 25, 5, 1, 1, 'Full Stack Developer', '<p>Start your Search with BlendedSearch and Get the Latest Info Today. Get Results for Best Executive Education. Find Results from Multiple Sources. Discover Us Now! Multiple Sources Combined. All the Answers. Simple in Use. Fast and Trusted. Easy Access Information.</p><p><br>&nbsp;</p>', 'Intelcode', 'hyderabad', '2022-02-28', '0000-00-00', 'Current'),
(32, 27, 18, 1, 1, 'Programmer', '<p>llllllllll</p>', 'Intelcode', 'bodagudipadu', '2022-12-17', '0000-00-00', 'Current'),
(38, 23, 17, 1, 1, 'Java Full-Stack Developered1', '<p>A <i><strong>paragraph</strong></i> (from Ancient Greek παράγραφος (parágraphos) \'to write beside\') is a self-contained unit of discourse in writing dealing with a particular point&nbsp;...</p>', 'Intelcode', 'bodagudipadu', '2022-12-02', '0000-00-00', 'Current');

-- --------------------------------------------------------

--
-- Table structure for table `student_university_hobby_details`
--

CREATE TABLE `student_university_hobby_details` (
  `sued_id` int(11) NOT NULL,
  `sued_student_university_id` int(11) DEFAULT NULL,
  `sued_hobby_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university_hobby_details`
--

INSERT INTO `student_university_hobby_details` (`sued_id`, `sued_student_university_id`, `sued_hobby_name`) VALUES
(29, 24, '09i'),
(32, 23, 'Reading books');

-- --------------------------------------------------------

--
-- Table structure for table `student_university_language_details`
--

CREATE TABLE `student_university_language_details` (
  `sued_id` int(11) NOT NULL,
  `sued_student_university_id` int(11) NOT NULL,
  `sued_language_name` text NOT NULL,
  `sued_com_name` text NOT NULL,
  `sued_job_start_date` date DEFAULT NULL,
  `sued_job_end_date` date DEFAULT NULL,
  `sued_job_description` text NOT NULL,
  `sued_com_status` text NOT NULL
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
  `sus_skill_certificate` tinytext NOT NULL,
  `sus_certificate_provider` text DEFAULT NULL,
  `sus_certificate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_university_skill_set`
--

INSERT INTO `student_university_skill_set` (`sus_id`, `sus_student_university_id`, `sus_skill_type_id`, `sus_skill_level`, `sus_skill_certificate`, `sus_certificate_provider`, `sus_certificate_date`) VALUES
(5, 9, 5, 'Beginner', '', NULL, NULL),
(7, 9, 7, 'Beginner', '', NULL, NULL),
(8, 9, 8, 'Beginner', '', NULL, NULL),
(9, 9, 9, 'Beginner', 'Animation Gantt Chart.pdf', 'EDESS', '2022-02-01'),
(14, 20, 10, 'Beginner', '', NULL, NULL);

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
(148, 'YPC-iTWEB College', 'http://www.kolejypc.edu.my/', NULL),
(149, 'Unicreds', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_vcode` varchar(255) DEFAULT NULL,
  `user_status` varchar(255) DEFAULT NULL,
  `user_created_date` datetime DEFAULT NULL,
  `user_updated_date` datetime DEFAULT NULL,
  `user_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_role_id`, `user_vcode`, `user_status`, `user_created_date`, `user_updated_date`, `user_deleted_date`) VALUES
(6, 'corporate@utm.my', '$2y$10$xgITjfldSOSzZWa6WGDKguFMies7XkjwJEpQgdaeYIRG392F1B98m', 5, NULL, NULL, '2021-09-13 11:29:15', '2021-09-20 14:36:24', NULL),
(7, 'pspk@upm.edu.my', '$2y$10$vXA5fWk99Z09sSiB0Y0n.e0VwG6QEZUmul.T6ZM.w6IIH2y5.HJEG', 5, NULL, NULL, '2021-09-13 11:35:52', NULL, NULL),
(8, 'pkk@ukm.edu.my', '$2y$10$31Rp7F7m1OH8o5pjYir5CuBbuhkc2EXv6uE1Xygrmb6JcckZVwpwS', 5, NULL, NULL, '2021-09-13 11:40:09', '2021-10-05 08:40:46', NULL),
(12, 'contact@edess.asia', '$2y$10$6rQiT.mpa0KnKm1VvQOGxO.OSI0QsTqq4tP7vk0q6PsxFgKc6uRsK', 5, NULL, NULL, '2021-09-14 15:45:57', '2021-10-05 08:40:53', NULL),
(27, 'admin_unicreds@edess.asia', '$2y$10$Icz/y92yCyiwc5E8o8SeBeejWVBQnYuRByBOIarK39pXI2/HX6YNa', 1, NULL, NULL, '2021-09-21 08:27:50', NULL, NULL),
(28, 'unicreds2@edess.asia', '$2y$10$9wsK7jQqiq1QOKR2e/4Ay.YIGWW7bd8ZbTSU0SDrA0Ov9qhUeuRFm', 2, NULL, NULL, '2021-09-21 08:47:48', NULL, NULL),
(29, 'hello@usm.my', '$2y$10$916zu1O38ZuVPDdYG0OyCeSn86OTNm1fhKXpwsqZplAkcbV.r2eRu', 5, NULL, NULL, '2021-09-21 09:44:41', NULL, NULL),
(30, 'testing@gmail.com', '$2y$10$r.xBp3M8vBXKfNNsaOJ41ubZkITBj97uLtRj1wGG.7./pswTsc74S', 9, NULL, NULL, '2021-09-22 09:35:43', NULL, NULL),
(34, 'hakim@yahoo.com', '$2y$10$1tWee10XQmzlGEFyi2jKOOju2J7aq3XYn2sY3RpgOhhWbmAF768XC', 9, NULL, NULL, '2021-09-27 11:06:39', NULL, NULL),
(39, 'abdulkhaliq@yahoo.com', '$2y$10$XHnFQaqXuREQQYKp9PxPleXn.9M0dl6zMtvkAm/jKgYcYH7wVdEsm', 9, NULL, NULL, '2021-10-03 15:58:28', NULL, NULL),
(40, 'abdullah@gmail.com', '$2y$10$6ciyx1UkUHVsWqVZY5ZUiegieEdYFxi38Z31qN50ACEDDbK4hLsF6', 7, NULL, NULL, '2021-10-03 15:59:15', NULL, NULL),
(44, 'pro@uthm.edu.my', '$2y$10$uXlqCJTnWKCFEz/f.l56uO5kS/LA10hccTAc8XGGd0HC/cFsNxo5G', 5, NULL, NULL, '2021-10-05 08:40:29', '2021-10-05 08:40:38', NULL),
(46, 'abdullah@utm.my', '$2y$10$8LT3HdI4/kTDMka48hft5Ox28NZN6zmcnWbmzpAw5SmY3hnNWpHj2', 7, NULL, NULL, '2021-10-07 10:38:18', '2021-10-07 10:39:39', NULL),
(48, 'abubakar@usm.my', '$2y$10$SMJYgvtoVBgoikdOYenuee8gnp681S.5Nb9.9bJL1TePtpmQN2weK', 7, NULL, NULL, '2021-10-07 15:01:09', NULL, NULL),
(49, 'abdulrahman@utm.my', '$2y$10$uR4gcgwsPvu8vCnMPuwMGeoY8NNpH.oNBWnxyVOxojo5EXIx4PvFi', 7, NULL, NULL, '2021-11-02 16:17:08', '2021-11-02 16:39:39', NULL),
(50, 'humaira@gmail.com', '$2y$10$.dAm5IB3A9984gt452FGGOLnil.8Iwa1YdTnaI9iP0DVniR3FNn32', 9, NULL, NULL, '2021-11-02 16:21:30', NULL, NULL),
(53, 'utmlead@utm.my', '$2y$10$2UP4h7ldJ9N9K8U5/0qyJOwD71ZPzBH1UnRk7pgHARudvPpC.k4k2', 10, NULL, NULL, '2021-11-16 10:52:01', '2022-02-14 15:25:29', NULL),
(54, 'thaqif@edess.asia', '$2y$10$vuOXB14EWz7eX3gBK3YCPuaoWtP5NXgfZ8NEdgjFpgMmVc4QbJM7W', 7, NULL, NULL, '2021-11-17 14:44:35', NULL, NULL),
(56, 'thaqifrajab@edess.asia', '$2y$10$LzDzwW/RNy78c6Q.qymb1.OKqUBs.eC2dlfEY.T3D83OwUk2CZXiS', 7, NULL, NULL, '2021-12-01 10:28:48', '2022-01-30 10:00:14', NULL),
(57, 'test@edess.asia', '$2y$10$Ausjj7sH4XKYHcROWBnjc.a.VqIghCKBHqUKE76pa36LIRRgO/ZAC', 7, NULL, NULL, '2021-12-01 10:45:46', NULL, NULL),
(58, 'webmedia@uitm.edu.my', '$2y$10$ExWRJQ4NquUViE1LJGsiieFJ30o2wzkdzufIt8x4PNjcxzFXWIEt2', 5, NULL, NULL, '2021-12-07 16:31:37', NULL, NULL),
(59, 'cdae@usm.my', '$2y$10$ItA7mesGdr82oF6kYBDx/uHz4mIG30Q2Zmbt2xjND7XwoiOXajzF.', 10, NULL, NULL, '2021-12-21 16:11:16', NULL, NULL),
(64, 'edess@gmail.com', '$2y$10$bHwyy7kMuJW9LK71uxiVQuda0gDhJJKme.4wkSj5uj90rx2oPPe5a', 6, NULL, NULL, '2022-01-23 10:15:03', NULL, NULL),
(65, 'unicredfinance1@yahoo.com', '$2y$10$Sa/hreOsS8jdffR77oRmrupYIskm/b3MeN87t0zUqmkjeH9EDLd8G', 2, NULL, NULL, '2022-01-27 12:23:14', '2022-01-27 12:23:27', '2022-01-27 12:23:32'),
(66, 'perdana1@yahoo.com', '$2y$10$Ey6BvmiJ5MAWP8ZCc8GLj.yTa6nsOyIJotjubqXktPGRQIQXFHxYu', 5, NULL, NULL, '2022-01-27 12:24:15', '2022-01-27 12:24:42', '2022-01-27 12:24:56'),
(67, 'unicreds67@yahoo.com', '$2y$10$hWM3Zz3vDuDmGPi7nktYgucQaQQh2LGGmCRWL8H3EIc5Sw2dtJvuK', 6, NULL, NULL, '2022-01-27 12:26:11', '2022-01-27 12:26:45', '2022-01-27 12:26:55'),
(68, 'cadeinovasi@upm.edu.my', '$2y$10$Sba.hzqZWhvHkW0Zj9MTw.p1vCJeh9fjfkkz.nO1IhJct6YC6chVK', 10, NULL, NULL, '2022-02-03 14:20:02', NULL, NULL),
(69, 'hamid@upm.my', '$2y$10$3/Q9zB4d4blc4urK4OgQFecXznT6prfnizxqQVaZYV3jCzMJbjD8C', 7, NULL, NULL, '2022-02-13 08:42:21', NULL, NULL),
(71, 'adibah1@edess.asia', '$2y$10$xE6c.TfY/uSx7o4033phgOOIH7pZojS0pC9wznOw5DnoSsYiksSCG', 7, NULL, NULL, '2022-02-13 11:29:56', '2022-02-13 11:31:13', '2022-02-13 11:31:26'),
(72, 'utmlead1123@utm.my', '$2y$10$n/1NOgtB.i2iGEcCGVh9/eKnJa2HQvXOOd.O4s/UC.gTiIEz1mHam', 10, NULL, NULL, '2022-02-13 11:34:53', '2022-02-13 11:35:12', '2022-02-13 11:35:37'),
(73, 'cuba@gmail.com', '$2y$10$J40Uyfb18epnh7m62H78weYyffZfZkkqOZbatctzwugtM516PDcoe', 10, NULL, NULL, '2022-02-14 10:39:27', NULL, NULL),
(75, 'faliq@edess.asia', '$2y$10$xvMrbYDrwdLcRf9H9BKsFOg9YI0ZhuCqQfPl1wJsW/oszPDBYeFqO', 7, NULL, NULL, '2022-02-14 12:37:26', '2022-02-14 12:38:31', NULL),
(76, 'unicreds@gmail.com', '$2y$10$7ZgpvKAuuj5Xv9um0prcDuuwqKpK8wQEIyCclGaYTZtu3W.Gh3WT.', 6, NULL, NULL, '2022-02-23 09:27:36', NULL, NULL),
(77, 'hadi.ghazali@edess.asia', '$2y$10$1ztefxV28hc9abq5/QT4AOrrE.ZDcVe1ZgRPDKuEakOeCOXKLm2Ze', 9, NULL, NULL, '2022-02-27 10:51:22', NULL, NULL),
(78, 'farhan@edess.asia', '$2y$10$3m46TryFBWG8MuIz1ScpeeSUAu9vTCPrr3TZ8hfsHYht5/.1C5BU6', 9, NULL, NULL, '2022-03-01 11:29:31', NULL, NULL),
(113, 'farhanmohdazhar15@gmail.com', '$2y$10$uyxJ1X5nQs41rKGwfQlyp.whAbrrlG4QLCJlRC0a2g.uxS.nU7.sG', 7, '784241', 'Verified', '2022-04-04 11:44:10', '2022-04-04 11:59:16', NULL),
(130, 'thaqif_rajab@yahoo.com', '$2y$10$LnCXRWah33vdEQhEanXgz.a3E.RzIhNGag0gTYpqRz9ViYGHUS2AG', 9, '609534', 'Verified', '2022-04-07 14:50:06', '2022-04-07 14:54:38', NULL),
(131, 'ukmcommittee@ukm.my', '$2y$10$JwpmfAmXmEiKY2TK/Pymhu9hJKtPbxOeVSsEH0JG1UIk0lOZnDRZO', 10, NULL, NULL, '2022-05-08 11:45:27', NULL, NULL),
(133, 'mdnurthaqif@gmail.com', '$2y$10$5ttLaVjisBkm0mJuCGkA.O5HcMpWKcMAQ0BdKyjcoHFdthyNeOkQ6', 9, '758435', 'not verified', '2022-11-09 16:27:29', NULL, NULL),
(134, 'test123@gmail.com', '$2y$10$yg/Ko0ZmkqIAdKH2QF3QNehSEyOXT3yPFzuWd8pFBIK9Lu4B35NhK', 9, '139429', 'not verified', '2023-02-09 15:11:59', NULL, NULL),
(135, 'student@gmail.com', '$2y$10$GplY2bzQTheTImHincAuSOw2asf4s4yQwldf6tp/rt3mkH6tYZdJi', 9, '137631', 'not verified', '2023-04-06 15:44:23', NULL, NULL),
(136, 'easnamir@gmail.com', '$2y$10$lgcebDcWty97CZkZQD32X.De3nULIgyBN8kqIz1tBStE272cCPV8q', 9, '269133', 'not verified', '2023-04-07 15:18:32', NULL, NULL),
(137, 'easn.aliamir@gmail.com', '$2y$10$XfzfOUubdtJleKhfYLfaMeGI2W6CbtE6t1P6BMdY/cS2GpgfHvXIi', 9, '863586', 'not verified', '2023-04-07 15:19:57', NULL, NULL);

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
  ADD PRIMARY KEY (`order_id`) USING BTREE,
  ADD KEY `FK_cart_item_cart` (`order_id`) USING BTREE,
  ADD KEY `productId` (`course_id`) USING BTREE;

--
-- Indexes for table `cart_order_mc`
--
ALTER TABLE `cart_order_mc`
  ADD PRIMARY KEY (`order_id`) USING BTREE,
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
  ADD KEY `FK_cart_order` (`order_id`),
  ADD KEY `FK_commission_user` (`user_id`);

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
  ADD PRIMARY KEY (`user_id`) USING BTREE;

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
-- Indexes for table `employability_program`
--
ALTER TABLE `employability_program`
  ADD PRIMARY KEY (`ep_id`);

--
-- Indexes for table `employability_program_enrolment_session`
--
ALTER TABLE `employability_program_enrolment_session`
  ADD PRIMARY KEY (`epes_id`);

--
-- Indexes for table `employabilty_program_video`
--
ALTER TABLE `employabilty_program_video`
  ADD PRIMARY KEY (`epv_id`),
  ADD KEY `epv_created_by` (`epv_created_by`);

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
-- Indexes for table `forum_post_course`
--
ALTER TABLE `forum_post_course`
  ADD PRIMARY KEY (`fpc_id`),
  ADD KEY `FK_fpc_ftc` (`fpc_topic_id`),
  ADD KEY `FK_fpc_instructor` (`fpc_instructor`),
  ADD KEY `FK_fpc_student` (`fpc_student`);

--
-- Indexes for table `forum_post_mc`
--
ALTER TABLE `forum_post_mc`
  ADD PRIMARY KEY (`fpm_id`),
  ADD KEY `FK_fpm_ftm` (`fpm_topic_id`),
  ADD KEY `FK_fpm_instructor` (`fpm_instructor`),
  ADD KEY `FK_fpm_student` (`fpm_student`);

--
-- Indexes for table `forum_topic_course`
--
ALTER TABLE `forum_topic_course`
  ADD PRIMARY KEY (`ftc_id`),
  ADD KEY `FK_ft_course` (`ftc_course_id`),
  ADD KEY `FK_ft_createdby` (`ftc_created_by`);

--
-- Indexes for table `forum_topic_mc`
--
ALTER TABLE `forum_topic_mc`
  ADD PRIMARY KEY (`ftm_id`),
  ADD KEY `FK_ftm_mc` (`ftm_mc_id`),
  ADD KEY `FK_ftm_createdby` (`ftm_created_by`);

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
-- Indexes for table `industry_field`
--
ALTER TABLE `industry_field`
  ADD PRIMARY KEY (`industry_field_id`);

--
-- Indexes for table `industry_information`
--
ALTER TABLE `industry_information`
  ADD PRIMARY KEY (`ii_id`),
  ADD KEY `FK_ii_industry` (`ii_industry_id`);

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
  ADD KEY `FK_mcm_institution` (`mcm_institution_id`),
  ADD KEY `FK_mcm_user` (`mcm_user_request_id`),
  ADD KEY `FK_mcm_mc` (`mcm_mc_id`);

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
-- Indexes for table `psychometric_test`
--
ALTER TABLE `psychometric_test`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `psychometric_test_question`
--
ALTER TABLE `psychometric_test_question`
  ADD PRIMARY KEY (`ptq_id`);

--
-- Indexes for table `psychometric_test_section`
--
ALTER TABLE `psychometric_test_section`
  ADD PRIMARY KEY (`pts_id`);

--
-- Indexes for table `review_microcredential`
--
ALTER TABLE `review_microcredential`
  ADD PRIMARY KEY (`rmc_id`),
  ADD KEY `FK_rmc_institution` (`rmc_institution_id`),
  ADD KEY `FK_rmc_user_request` (`rmc_user_request`),
  ADD KEY `FK_rmc_user_review` (`rmc_user_review`),
  ADD KEY `FK_rmc_mc` (`rmc_mc_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `skill_assessment_test`
--
ALTER TABLE `skill_assessment_test`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `skill_assessment_test_answer`
--
ALTER TABLE `skill_assessment_test_answer`
  ADD PRIMARY KEY (`stqa_id`);

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
  ADD KEY `FK_sued_student_university` (`sued_student_university_id`),
  ADD KEY `FK_student_country` (`sued_job_location_country_id`),
  ADD KEY `FK_student_state` (`sued_job_location_state_id`),
  ADD KEY `FK_student_city` (`sued_job_location_city_id`);

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
-- Indexes for table `studuni_mc_test_result`
--
ALTER TABLE `studuni_mc_test_result`
  ADD PRIMARY KEY (`sumctrs_id`);

--
-- Indexes for table `studuni_mc_test_review`
--
ALTER TABLE `studuni_mc_test_review`
  ADD PRIMARY KEY (`sumctrv_id`);

--
-- Indexes for table `studuni_mc_tutorial_submission`
--
ALTER TABLE `studuni_mc_tutorial_submission`
  ADD PRIMARY KEY (`sumctus_id`);

--
-- Indexes for table `studuni_mc_watched_video`
--
ALTER TABLE `studuni_mc_watched_video`
  ADD PRIMARY KEY (`sumcvw_id`);

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
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_management`
--
ALTER TABLE `admin_management`
  MODIFY `am_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_admin`
--
ALTER TABLE `announcement_admin`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `announcement_committee`
--
ALTER TABLE `announcement_committee`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcement_industry`
--
ALTER TABLE `announcement_industry`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_institution`
--
ALTER TABLE `announcement_institution`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement_lecturer`
--
ALTER TABLE `announcement_lecturer`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart_order`
--
ALTER TABLE `cart_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `ces_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_instructor`
--
ALTER TABLE `course_instructor`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_learning_details`
--
ALTER TABLE `course_learning_details`
  MODIFY `cld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_notes`
--
ALTER TABLE `course_notes`
  MODIFY `cn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `cq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_quiz_answer`
--
ALTER TABLE `course_quiz_answer`
  MODIFY `cqa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_quiz_question`
--
ALTER TABLE `course_quiz_question`
  MODIFY `cqq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `cv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `employability_program`
--
ALTER TABLE `employability_program`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employability_program_enrolment_session`
--
ALTER TABLE `employability_program_enrolment_session`
  MODIFY `epes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employabilty_program_video`
--
ALTER TABLE `employabilty_program_video`
  MODIFY `epv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `enrolled_course_studuni`
--
ALTER TABLE `enrolled_course_studuni`
  MODIFY `ecsu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrolled_mc_studuni`
--
ALTER TABLE `enrolled_mc_studuni`
  MODIFY `emcsu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_post_course`
--
ALTER TABLE `forum_post_course`
  MODIFY `fpc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `forum_post_mc`
--
ALTER TABLE `forum_post_mc`
  MODIFY `fpm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forum_topic_course`
--
ALTER TABLE `forum_topic_course`
  MODIFY `ftc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forum_topic_mc`
--
ALTER TABLE `forum_topic_mc`
  MODIFY `ftm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `industry_field`
--
ALTER TABLE `industry_field`
  MODIFY `industry_field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `industry_information`
--
ALTER TABLE `industry_information`
  MODIFY `ii_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `jc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `jsua_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `mccct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `mcld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mc_mou`
--
ALTER TABLE `mc_mou`
  MODIFY `mcm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mc_notes`
--
ALTER TABLE `mc_notes`
  MODIFY `mcn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `mcq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mc_quiz_answer`
--
ALTER TABLE `mc_quiz_answer`
  MODIFY `mcqa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mc_quiz_question`
--
ALTER TABLE `mc_quiz_question`
  MODIFY `mcqq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mc_slide`
--
ALTER TABLE `mc_slide`
  MODIFY `mcs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_test`
--
ALTER TABLE `mc_test`
  MODIFY `mct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `mcv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `microcredential`
--
ALTER TABLE `microcredential`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phd`
--
ALTER TABLE `phd`
  MODIFY `phd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postcode`
--
ALTER TABLE `postcode`
  MODIFY `postcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `psychometric_test`
--
ALTER TABLE `psychometric_test`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `psychometric_test_question`
--
ALTER TABLE `psychometric_test_question`
  MODIFY `ptq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `psychometric_test_section`
--
ALTER TABLE `psychometric_test_section`
  MODIFY `pts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `review_microcredential`
--
ALTER TABLE `review_microcredential`
  MODIFY `rmc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill_assessment_test`
--
ALTER TABLE `skill_assessment_test`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skill_assessment_test_answer`
--
ALTER TABLE `skill_assessment_test_answer`
  MODIFY `stqa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `skill_type`
--
ALTER TABLE `skill_type`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_university`
--
ALTER TABLE `student_university`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `sued_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student_university_skill_set`
--
ALTER TABLE `student_university_skill_set`
  MODIFY `sus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `studuni_course_assignment_submission`
--
ALTER TABLE `studuni_course_assignment_submission`
  MODIFY `sucas_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `suctrs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `studuni_mc_quiz_result`
--
ALTER TABLE `studuni_mc_quiz_result`
  MODIFY `sumcqrs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_mc_quiz_review`
--
ALTER TABLE `studuni_mc_quiz_review`
  MODIFY `sumcqrv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_mc_test_result`
--
ALTER TABLE `studuni_mc_test_result`
  MODIFY `sumctrs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_mc_test_review`
--
ALTER TABLE `studuni_mc_test_review`
  MODIFY `sumctrv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_mc_tutorial_submission`
--
ALTER TABLE `studuni_mc_tutorial_submission`
  MODIFY `sumctus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studuni_mc_watched_video`
--
ALTER TABLE `studuni_mc_watched_video`
  MODIFY `sumcvw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

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
  ADD CONSTRAINT `FK_commission_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_commission_rate_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
