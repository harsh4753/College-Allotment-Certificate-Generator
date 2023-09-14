-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 04:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admission_2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `college_applications`
--

CREATE TABLE `college_applications` (
  `institute_general_merit_no` varchar(20) DEFAULT NULL,
  `candidate_typewise_merit_number` varchar(50) DEFAULT NULL,
  `application_number` varchar(20) DEFAULT NULL,
  `candidate_name` varchar(50) DEFAULT NULL,
  `candidature_type` varchar(20) DEFAULT NULL,
  `eligibility_percent` decimal(4,2) DEFAULT NULL,
  `merit_marks` decimal(4,2) DEFAULT NULL,
  `hsc_math_percent` decimal(5,2) DEFAULT NULL,
  `hsc_physics_percent` decimal(4,2) DEFAULT NULL,
  `merit_hsc_pcm_percent` decimal(4,2) DEFAULT NULL,
  `hsc_chemistry_percent` int(3) DEFAULT NULL,
  `name_as_per_hsc` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `institute_name` varchar(50) DEFAULT NULL,
  `category_for_admission` varchar(50) DEFAULT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `seat_type` varchar(50) DEFAULT NULL,
  `date_of_admission` varchar(20) DEFAULT NULL,
  `receipt_no` varchar(12) DEFAULT NULL,
  `payment_mode` varchar(10) DEFAULT NULL,
  `seat_acceptance_fees_amount` varchar(20) DEFAULT NULL,
  `seat_acceptance_dd_transaction_number` varchar(20) DEFAULT NULL,
  `seat_acceptance_payment_date` date DEFAULT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `bank_and_branch_name` varchar(50) DEFAULT NULL,
  `college_fees_amount` varchar(10) DEFAULT NULL,
  `college_fees_dd_transaction_number` varchar(20) DEFAULT NULL,
  `college_payment_date` varchar(20) DEFAULT NULL,
  `college_bank_and_branch_name` varchar(50) DEFAULT NULL,
  `payment_date1` varchar(20) DEFAULT NULL,
  `bank_and_branch_name1` varchar(50) DEFAULT NULL,
  `college_fees_amount1` varchar(50) DEFAULT NULL,
  `college_fees_dd_transaction_number1` varchar(50) DEFAULT NULL,
  `payment_date_dol` varchar(50) DEFAULT NULL,
  `payment_date_dol1` varchar(50) DEFAULT NULL,
  `bank_and_branch_name_dol` varchar(50) DEFAULT NULL,
  `bank_and_branch_name_dol1` varchar(50) DEFAULT NULL,
  `college_fees_amount_dol` varchar(50) DEFAULT NULL,
  `college_fees_amount_dol1` varchar(50) DEFAULT NULL,
  `college_fees_dd_transaction_number_dol` varchar(50) DEFAULT NULL,
  `college_fees_dd_transaction_number_dol1` varchar(50) DEFAULT NULL,
  `seat_acceptance_bank_and_branch_name` varchar(50) DEFAULT NULL,
  `date_and_time` varchar(100) DEFAULT NULL,
  `round_number` varchar(50) DEFAULT NULL,
  `stage_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
