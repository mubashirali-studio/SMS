-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2026 at 01:57 PM
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
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@school.com', '$2y$10$tS5dJOxu/wVvxsRiDK7dOeTmFP0louTA02LvlCkcNdW5xWYtSUWVC');

-- --------------------------------------------------------

--
-- Table structure for table `admission_requests`
--

CREATE TABLE `admission_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `b_form_no` varchar(20) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `classno` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `admission_date` date NOT NULL,
  `previous_school` varchar(150) DEFAULT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `guardian_cnic` varchar(20) DEFAULT NULL,
  `guardian_occupation` varchar(100) DEFAULT NULL,
  `contact` varchar(20) NOT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_requests`
--

INSERT INTO `admission_requests` (`id`, `name`, `dob`, `gender`, `blood_group`, `b_form_no`, `religion`, `photo`, `classno`, `academic_year`, `admission_date`, `previous_school`, `father_name`, `mother_name`, `guardian_cnic`, `guardian_occupation`, `contact`, `emergency_contact`, `address`, `email`, `password`, `status`, `created_at`) VALUES
(3, 'HAMZA', '2028-07-05', 'male', 'A+', '1010101010101', 'Islam', '1790775017_stud.jfif', 0, '2026-2027', '2022-11-10', 'no school', 'Bashir sab', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03128492444', '03139027392', 'erfwrvwgreeeeeeeeeeeeeeeegvwrf2qef', 'hamza2@gmail.com', '$2y$10$2cASTovI17H53x0pR485seQEBgsNRWYIgOA.shtaXqYiUZnLtPGKa', 'pending', '2026-09-30 18:30:17'),
(5, 'HAMZA', '2028-07-05', 'male', 'A+', '1010101010101', 'Islam', '1790775098_stud.jfif', 0, '2026-2027', '2022-11-10', 'no school', 'Bashir sab', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03128492444', '03139027392', 'erfwrvwgreeeeeeeeeeeeeeeegvwrf2qef', 'hamza4@gmail.com', '$2y$10$Uv2dp4S6cUB0UlJ.iYPY7.bBxZV/hi9hsy60E5Ou234Hl/AgIkMeW', 'pending', '2026-09-30 18:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `classno` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `att_date` date NOT NULL,
  `status` enum('present','absent','leave') NOT NULL,
  `marked_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `classno`, `section_id`, `att_date`, `status`, `marked_by`) VALUES
(1, 19, 8, 15, '2026-09-25', 'absent', 5),
(2, 22, 8, 15, '2026-09-25', 'present', 5),
(3, 19, 8, 15, '2026-09-26', 'present', 5),
(4, 22, 8, 15, '2026-09-26', 'present', 5);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_assignment`
--

CREATE TABLE `attendance_assignment` (
  `id` int(11) NOT NULL,
  `classno` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_assignment`
--

INSERT INTO `attendance_assignment` (`id`, `classno`, `section_id`, `teacher_id`) VALUES
(1, 8, 15, 5),
(2, 1, 1, 5),
(3, 1, 2, 3),
(4, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fee_amount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `fee_amount`) VALUES
(1, 'one', 3000),
(2, 'two', 3000),
(3, 'three', 3000),
(4, 'four', 3500),
(5, 'five', 3500),
(6, 'six', 3500),
(7, 'seven', 4000),
(8, 'eight', 4000),
(9, 'nine', 5000),
(10, 'ten', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `fee_type` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `amount_due` int(100) NOT NULL,
  `amount_paid` int(100) NOT NULL DEFAULT 0,
  `due_date` datetime(6) NOT NULL,
  `paid_date` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `fee_type`, `month`, `amount_due`, `amount_paid`, `due_date`, `paid_date`) VALUES
(2, 1, 'Tuition', 'September 2026', 5000, 0, '2026-09-21 00:00:00.000000', NULL),
(3, 5, 'Tuition', 'September 2026', 3000, 0, '2026-09-21 00:00:00.000000', NULL),
(4, 6, 'Tuition', 'September 2026', 3000, 0, '2026-09-21 00:00:00.000000', NULL),
(5, 7, 'Tuition', 'September 2026', 3000, 0, '2026-09-21 00:00:00.000000', NULL),
(6, 9, 'Tuition', 'September 2026', 3000, 0, '2026-09-21 00:00:00.000000', NULL),
(7, 11, 'Tuition', 'September 2026', 3500, 0, '2026-09-21 00:00:00.000000', NULL),
(8, 12, 'Tuition', 'September 2026', 3500, 0, '2026-09-21 00:00:00.000000', NULL),
(9, 15, 'Tuition', 'September 2026', 3500, 0, '2026-09-21 00:00:00.000000', NULL),
(10, 17, 'Tuition', 'September 2026', 3500, 0, '2026-09-21 00:00:00.000000', NULL),
(11, 19, 'Tuition', 'September 2026', 4000, 0, '2026-09-21 00:00:00.000000', NULL),
(12, 20, 'Tuition', 'September 2026', 4000, 0, '2026-09-21 00:00:00.000000', NULL),
(13, 21, 'Tuition', 'September 2026', 4000, 0, '2026-09-21 00:00:00.000000', NULL),
(14, 22, 'Tuition', 'September 2026', 4000, 0, '2026-09-21 00:00:00.000000', NULL),
(15, 23, 'Tuition', 'September 2026', 5000, 0, '2026-09-21 00:00:00.000000', NULL),
(16, 24, 'Tuition', 'September 2026', 5000, 0, '2026-09-21 00:00:00.000000', NULL),
(17, 25, 'Tuition', 'September 2026', 3000, 0, '2026-09-21 00:00:00.000000', NULL),
(18, 26, 'Admission', 'September 2026', 5000, 0, '2026-09-21 00:00:00.000000', NULL),
(19, 26, 'Exam Fee', 'September', 300, 0, '2026-09-30 00:00:00.000000', NULL),
(20, 19, 'Annual Fund', 'September', 500, 0, '2026-09-30 00:00:00.000000', NULL),
(21, 20, 'Annual Fund', 'September', 500, 0, '2026-09-30 00:00:00.000000', NULL),
(22, 21, 'Annual Fund', 'September', 500, 250, '2026-09-30 00:00:00.000000', '2026-09-21 00:00:00.000000'),
(23, 22, 'Annual Fund', 'September', 500, 0, '2026-09-30 00:00:00.000000', NULL),
(24, 34, 'Admission', 'October 2026', 5000, 0, '2026-10-03 00:00:00.000000', NULL),
(25, 35, 'Admission', 'October 2026', 5000, 0, '2026-10-06 00:00:00.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(30) NOT NULL,
  `classno` int(30) NOT NULL,
  `section_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `classno`, `section_name`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 2, 'A'),
(4, 2, 'B'),
(5, 3, 'A'),
(6, 3, 'B'),
(7, 4, 'A'),
(8, 4, 'B'),
(9, 5, 'A'),
(10, 5, 'B'),
(11, 6, 'A'),
(12, 6, 'B'),
(13, 7, 'A'),
(14, 7, 'B'),
(15, 8, 'A'),
(16, 8, 'B'),
(17, 9, 'A'),
(18, 9, 'B'),
(19, 10, 'A'),
(20, 10, 'B'),
(21, 9, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `name` varchar(300) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(150) NOT NULL,
  `bloodgrp` varchar(100) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `pic` varchar(300) NOT NULL,
  `classno` varchar(50) NOT NULL,
  `acad-year` char(9) NOT NULL,
  `add-date` date NOT NULL,
  `pre-scl` varchar(150) NOT NULL,
  `father-name` varchar(150) NOT NULL,
  `mother-name` varchar(150) NOT NULL,
  `gurd-cnic` varchar(13) NOT NULL,
  `gurd-ocp` varchar(300) NOT NULL,
  `prim-no` varchar(11) NOT NULL,
  `emg-no` varchar(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `dob`, `gender`, `bloodgrp`, `cnic`, `religion`, `pic`, `classno`, `acad-year`, `add-date`, `pre-scl`, `father-name`, `mother-name`, `gurd-cnic`, `gurd-ocp`, `prim-no`, `emg-no`, `address`, `section_id`, `email`, `password`) VALUES
(1, 'M. Mubashir Ali', '2026-08-14', 'male', 'B+', '2147483647', 'Islam', 'image.jfif', '9', '2026-2027', '2026-08-04', 'no school', 'Ejaz hussain', 'Mrs. Ejaz', '2147483647', 'doctor', '2147483647', '1000000000', 'oh my yes lets go ', 21, NULL, NULL),
(5, 'M. Mubashir Ali', '2026-07-31', 'male', 'B-', '2147483647', 'Islam', 'image.jfif', '3', '2026-2027', '2026-07-29', 'no school', 'Ejaz hussain', 'Mrs. Ejaz', '2147483647', 'doctor', '2147483647', '2147483647', 'mndiqemqdnfkjebwcnwloienc', 6, NULL, NULL),
(6, 'M. Mubashir Ali', '2026-07-31', 'male', 'B-', '2147483647', 'Islam', 'image.jfif', '3', '2026-2027', '2026-07-29', 'no school', 'Ejaz hussain', 'Mrs. Ejaz', '2147483647', 'doctor', '2147483647', '2147483647', 'mndiqemqdnfkjebwcnwloienc', 5, NULL, NULL),
(7, 'M. Mubashir Ali', '2026-07-31', 'male', 'B-', '2147483647', 'Islam', 'image.jfif', '3', '2026-2027', '2026-07-29', 'no school', 'Ejaz hussain', 'Mrs. Ejaz', '2147483647', 'doctor', '2147483647', '2147483647', 'mndiqemqdnfkjebwcnwloienc', 6, NULL, NULL),
(9, 'M. Mubashir Ali', '2026-07-30', 'male', 'B-', '1010101010101', 'Islam', 'image.jfif', '3', '2026-2027', '2026-08-10', 'no school', 'Ejaz hussain', 'Mrs. Ejaz', '2147483647', 'doctor', '2147483647', '2147483647', 'jbgfyhb', 5, NULL, NULL),
(11, 'ali bashir', '2018-07-05', 'male', 'O-', '1350902378122', 'Islam', 'ba987ed3-d61e-46d9-b9e2-0eb4afa92f97.jfif', '4', '2026-2027', '2026-09-04', 'no school', 'Bashir sab', 'Bashir sab di begum', '1332879983753', 'bashir sab wabta wale', '0313728457', '03147896561', 'bashir sab da pata kis ko ni pata sarian ko ha paata', 7, NULL, NULL),
(12, 'ali bashir', '2018-07-05', 'male', 'O-', '1350902378122', 'Islam', 'ba987ed3-d61e-46d9-b9e2-0eb4afa92f97.jfif', '6', '2026-2027', '2026-09-04', 'no school', 'Bashir sab', 'Bashir sab di begum', '1332879983753', 'bashir sab wabta wale', '0313728457', '03147896561', 'bashir sab da pata kis ko ni pata sarian ko ha paata', 11, NULL, NULL),
(15, 'M. Mubashir Ali', '2026-09-05', 'male', 'B-', '1010101010101', 'Islam', 'Screenshot 2026-08-27 021745.png', '4', '2026-2027', '2026-09-22', 'no school', 'ANWAR SAB', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03987988901', '03139027392', 'u3h2ru2ibrf98h', 8, NULL, NULL),
(17, 'M. Mubashir Ali', '2026-09-05', 'male', 'B-', '1010101010101', 'Islam', 'Screenshot 2026-08-27 021745.png', '4', '2026-2027', '2026-09-22', 'no school', 'ANWAR SAB', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03987988901', '03139027392', 'u3h2ru2ibrf98h', 7, NULL, NULL),
(19, 'HAMZA', '2026-09-11', 'male', 'B-', '1010101010101', 'Islam', 'Screenshot 2026-08-27 021745.png', '8', '2026-2027', '2026-09-30', 'L PUBLIC SCHOOL', 'Ejaz hussain', 'Bashir sab di begum', '2147483647', 'bashir sab wabta wale', '0313728457', '1000000000', 'BHJB', 15, NULL, NULL),
(20, 'HAMZA', '2026-09-11', 'male', 'B-', '1010101010101', 'Islam', 'Screenshot 2026-08-27 021745.png', '8', '2026-2027', '2026-09-30', 'L PUBLIC SCHOOL', 'Ejaz hussain', 'Bashir sab di begum', '2147483647', 'bashir sab wabta wale', '0313728457', '1000000000', 'BHJB', 16, NULL, NULL),
(21, 'HAMZA', '2026-09-11', 'male', 'B-', '1010101010101', 'Islam', 'Screenshot 2026-08-27 021745.png', '8', '2026-2027', '2026-09-30', 'L PUBLIC SCHOOL', 'Ejaz hussain', 'Bashir sab di begum', '2147483647', 'bashir sab wabta wale', '0313728457', '1000000000', 'BHJB', 16, NULL, NULL),
(22, 'HAMZA', '2026-09-11', 'male', 'B-', '1010101010101', 'Islam', 'Screenshot 2026-08-27 021745.png', '8', '2026-2027', '2026-09-30', 'L PUBLIC SCHOOL', 'Ejaz hussain', 'Bashir sab di begum', '2147483647', 'bashir sab wabta wale', '0313728457', '1000000000', 'BHJB', 15, NULL, NULL),
(23, 'M. Mubashir Ali', '2026-09-03', 'male', 'B+', '1010101010101', 'Islam', '1789209962_std.jfif', '9', '2026-2027', '2026-10-08', 'no school', 'Bashir sab', 'DONT KNOW', '1010101010101', 'DOCTOR OF SHARARTI BACHAY', '03000000000', '1000000000', 'sdc', 18, NULL, NULL),
(24, 'M. Mubashir Ali', '2026-09-03', 'male', 'B+', '1010101010101', 'Islam', '1789204742_imag.jfif', '9', '2026-2027', '2026-10-08', 'no school', 'Bashir sab', 'DONT KNOW', '1010101010101', 'DOCTOR OF SHARARTI BACHAY', '03000000000', '1000000000', 'sdc', NULL, NULL, NULL),
(25, 'hamza', '2026-09-17', 'male', 'B+', '1010101010101', 'Islam', '', '2', '2026-2027', '2026-09-12', 'no school', 'Bashir sab', 'DONT KNOW', '1010101010101', 'bashir sab wabta wale', '2147483647', '1000000000', 'ecqcndouqhwejbkjqnediqjeinv', NULL, NULL, NULL),
(26, 'Ali Azam', '2015-03-29', 'male', 'A+', '1010101010101', 'Islam', '1789979430_stud.jfif', '1', '2026-2027', '2026-09-21', 'no school', 'Bashir sab', 'Asifa', '1010101010101', 'doctor', '03000000000', '03000000000', 'ewfcwf', NULL, NULL, NULL),
(27, 'HAMZA', '2028-07-05', 'male', 'A+', '1010101010101', 'Islam', '1790775128_stud.jfif', '0', '2026-2027', '2022-11-10', 'no school', 'Bashir sab', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03128492444', '03139027392', 'erfwrvwgreeeeeeeeeeeeeeeegvwrf2qef', NULL, 'hamza5@gmail.com', '$2y$10$6SEqEO9Iu03j/3L5K2h4guz1jzY6RZSpwqA.ibXAEsDbY5ju8Ze6u'),
(28, 'HAMZA', '2028-07-05', 'male', 'A+', '1010101010101', 'Islam', '1790774888_stud.jfif', '0', '2026-2027', '2022-11-10', 'no school', 'Bashir sab', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03128492444', '03139027392', 'erfwrvwgreeeeeeeeeeeeeeeegvwrf2qef', NULL, 'hamza@gmail.com', '$2y$10$eahedxS986P3ptkAYpqLju5fHgo6f6Ku8f1QYX5Lg3/yfO4qXeGwq'),
(29, 'HAMZA', '2028-07-05', 'male', 'A+', '1010101010101', 'Islam', '1790775063_stud.jfif', '0', '2026-2027', '2022-11-10', 'no school', 'Bashir sab', 'Bashir sab di begum', '1010101010101', 'bashir sab wabta wale', '03128492444', '03139027392', 'erfwrvwgreeeeeeeeeeeeeeeegvwrf2qef', NULL, 'hamza3@gmail.com', '$2y$10$llBMSR9ylttfSvpQTLN1h.zBXbTDXXEZlOGitdww6Qvl.OyDW9qtK'),
(30, 'Ali Mughal', '2026-10-21', 'male', 'B+', '2147483647', 'Islam', '1791032391_images.jfif', '0', '2026-2027', '2026-10-20', 'PUBLIC SCHOOL', 'ANWAR SAB', 'DONT KNOW', '1010101010101', 'DOCTOR OF SHARARTI BACHAY', '0313728457', '03147896561', 'biukfewrenfujwekbdhqwjkdnqwlkmn', NULL, 'ali012@gmail.com', '$2y$10$6wgrMzdzNBJzzOjlpM6vjeU6uAZ79SUeed/ERwHTphJ6I/OtuXMdi'),
(31, 'Usman ', '2026-10-22', 'male', 'O+', '1010101010101', 'Islam', '1791033006_images.jfif', '5', '2026-2027', '2026-09-30', 'PUBLIC SCHOOL', 'Ali Mugal', 'Asifa', '1010101010101', 'Pilot', '0313728457', '03147896561', 'nili tanki wala ghar', NULL, 'usman@gmail.com', '$2y$10$ct/VbfxgQ0CV/5RTDY7wZu0AddqoFClKMiV8ChpJwt5ZRiUTSqW2y'),
(32, 'Sheraz', '2026-10-22', 'male', 'B+', '1358477281937', 'Islam', '1791033713_download (1).jfif', '0', '2026-2027', '2026-09-30', 'PUBLIC SCHOOL', 'Ali Mugal', 'DONT KNOW', '1010101010101', 'doctor', '0313728457', '03147896561', 'wbhdjqwbdjknqkldnqekjc ', NULL, 'sheraz@gmail.com', '$2y$10$WREjHQ4CEbHKlRRk9z4.GemHIs4L.KAK7tjd1Q/ZWYOTfcGLcbsWK'),
(33, 'Gulfam', '2026-10-30', 'male', 'O+', '1358477281937', 'Islam', '1791035077_images.jfif', '5', '2026-2027', '2026-11-04', 'PUBLIC SCHOOL', 'ANWAR SAB', 'Ayesha', '1010101010101', 'Police', '0313728457', '03139027392', 'Dednjkwefnbbffffffffffffffffffff', 10, 'gulfam@gmail.com', '$2y$10$4MTURAIkQ0PbuobeB2x6feREUrYTu07lzxYSThGBMRpmQ.20t/Eb.'),
(34, 'Waqar ', '2026-10-22', 'male', 'AB+', '1010101010101', 'Islam', '1791033552_images (1).jfif', '0', '2026-2027', '2026-10-13', 'PUBLIC SCHOOL', 'Ali Mugal', 'Asifa', '1010101010101', 'Officer', '03128492444', '03147896561', 'buuqhwdioqiednjwuqnedd', NULL, 'waqar@gmail.com', '$2y$10$j60E3EZJvGqLj0Cd7E8zee7QxqsWalHB07WhrZvywYldCWx9e2NqO'),
(35, 'M. Mubashir Ali', '2026-10-10', 'male', 'B+', '1358477281937', 'Islam', '1791297687_images (1).jfif', '6', '2026-2027', '2026-10-06', 'PUBLIC SCHOOL', 'Ejaz hussain', 'Mrs. Ejaz', '1010101010101', 'doctor', '03128492444', '03139027392', 'Mubashir ka Ghar', NULL, 'mubashir@gmail.com', '$2y$10$vNxoH2rwjccAD/6TO.gu2O9G3JmFtkCxd5fQoOuvpk.CjfUetRXa.');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'English'),
(2, 'Arabic'),
(3, 'Biology'),
(4, 'Chemistry'),
(5, 'Computer Science'),
(6, 'Drawing / Fine Arts'),
(7, 'General Knowledge'),
(8, 'Mathematics'),
(9, 'General Science'),
(10, 'History'),
(11, 'Islamiat'),
(12, 'Pakistan Studies'),
(13, 'Physics'),
(14, 'Social Studies'),
(15, 'Tarjuma-tul-Quran'),
(16, 'Urdu');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `qualification` varchar(300) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `experience_years` varchar(3) NOT NULL,
  `joining_date` date NOT NULL,
  `salary` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `emergency_contact` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `dob`, `gender`, `cnic`, `photo`, `qualification`, `specialization`, `experience_years`, `joining_date`, `salary`, `contact`, `emergency_contact`, `email`, `address`, `password`) VALUES
(1, 'M. Mubashir Ali', '2026-09-17', 'male', '123457891234', '1789216618_unnamed.png', 'BS SE', 'Computer', '3', '2026-09-09', '1243124', '03000000000', '03000000000', 'm.mubash@gmail.com', 'qjwdnoiqndjqnbejflwnfown', '$2y$10$IKX9s9UorM49VSO4lpyI4e8FQeXht.ZVpW8RQT1IFAiWt7uXVEY36'),
(3, 'bashir sab', '2026-09-05', 'male', '123457891234', '', 'BS SE', 'Computer', '18', '2026-09-11', '214235', '03128492444', '32139880919', 'm.muba2@gmail.com', 'jeiqhfiefbwhfbbbbwhfb', '$2y$10$IKX9s9UorM49VSO4lpyI4e8FQeXht.ZVpW8RQT1IFAiWt7uXVEY36'),
(5, 'ali', '2026-09-11', 'male', '123457891234', '', 'BS SE', 'Computer', '10', '2026-09-09', '21565432', '03128492444', '03147896561', 'ali012@gmail.com', 'j3iu2rh3r09888888', '$2y$10$IKX9s9UorM49VSO4lpyI4e8FQeXht.ZVpW8RQT1IFAiWt7uXVEY36'),
(7, 'Waqar Tanoli', '2026-10-15', 'male', '123457891234', '1791294013_images.jfif', 'BS CS', 'Computer', '6', '2026-10-06', '50000', '03987988901', '03139027392', 'waqartanoli@gmail.com', 'Waqar ka ghar', '$2y$10$FiknAB69BfoAH2XnGAlSSuw.NNrFaiTmDh4Sl3j7AchB9MI44deKC');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `classno` int(11) NOT NULL,
  `day_no` tinyint(4) NOT NULL,
  `period_no` tinyint(4) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `classno`, `day_no`, `period_no`, `subject_id`, `teacher_id`) VALUES
(2, 1, 1, 2, 6, 3),
(3, 1, 1, 3, 5, 5),
(4, 1, 1, 4, 3, 3),
(5, 1, 1, 5, 10, 3),
(6, 1, 1, 6, 6, 1),
(7, 1, 1, 7, 12, 3),
(8, 1, 1, 8, 6, 3),
(9, 1, 1, 1, 4, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admission_requests`
--
ALTER TABLE `admission_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_day` (`student_id`,`att_date`);

--
-- Indexes for table `attendance_assignment`
--
ALTER TABLE `attendance_assignment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_assignment` (`classno`,`section_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_slot` (`classno`,`day_no`,`period_no`),
  ADD KEY `idx_teacher_slot` (`teacher_id`,`day_no`,`period_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admission_requests`
--
ALTER TABLE `admission_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance_assignment`
--
ALTER TABLE `attendance_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
