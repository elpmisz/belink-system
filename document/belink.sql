-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Mar 05, 2025 at 09:50 AM
-- Server version: 11.7.2-MariaDB-ubu2404
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belink`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_file`
--

CREATE TABLE `advance_clear_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_clear_file`
--

INSERT INTO `advance_clear_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '88613f7d491e77911c1480385fcc870b.pdf', 1, NULL, '2025-02-17 22:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_item`
--

CREATE TABLE `advance_clear_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `wt` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_clear_item`
--

INSERT INTO `advance_clear_item` (`id`, `request_id`, `expense_id`, `text`, `amount`, `vat`, `wt`, `status`, `updated`, `created`) VALUES
(1, 1, 3, 'aaaaa', 18000.00, 1260.00, 0.00, 1, '2025-02-17 22:56:00', '2025-02-17 22:31:26'),
(2, 1, 6, 'bbbbb', 15000.00, 1050.00, 0.00, 1, '2025-02-17 22:56:00', '2025-02-17 22:31:26'),
(3, 1, 7, 'ccccc', 4000.00, 280.00, 120.00, 1, '2025-02-17 22:56:00', '2025-02-17 22:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_remark`
--

CREATE TABLE `advance_clear_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_clear_remark`
--

INSERT INTO `advance_clear_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-02-17 22:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_request`
--

CREATE TABLE `advance_clear_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `advance_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_clear_request`
--

INSERT INTO `advance_clear_request` (`id`, `uuid`, `last`, `login_id`, `doc_date`, `advance_id`, `amount`, `action`, `status`, `updated`, `created`) VALUES
(1, '418336bc-ed44-11ef-9de3-0242ac120005', 1, 1, '2025-02-02', 1, 42000.00, 1, 2, '2025-02-17 22:59:30', '2025-02-17 22:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `advance_file`
--

CREATE TABLE `advance_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_file`
--

INSERT INTO `advance_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '888b2b094af524d8720623d09929ff6a.pdf', 1, NULL, '2025-02-17 21:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `advance_item`
--

CREATE TABLE `advance_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_item`
--

INSERT INTO `advance_item` (`id`, `request_id`, `expense_id`, `text`, `amount`, `status`, `updated`, `created`) VALUES
(1, 1, 3, 'ค่าน้ำมัน', 1250.00, 1, '2025-02-23 14:11:58', '2025-02-17 21:07:07'),
(2, 1, 6, 'yyyyy', 17500.00, 1, '2025-02-17 21:35:27', '2025-02-17 21:07:07'),
(3, 1, 7, 'zzzzz', 4500.00, 1, '2025-02-17 21:35:27', '2025-02-17 21:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `advance_remark`
--

CREATE TABLE `advance_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_remark`
--

INSERT INTO `advance_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-02-17 21:40:12'),
(2, 1, 1, '', 2, '2025-02-17 22:58:15'),
(3, 1, 1, '', 2, '2025-02-17 22:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `advance_request`
--

CREATE TABLE `advance_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `finish` date NOT NULL,
  `objective` text NOT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_request`
--

INSERT INTO `advance_request` (`id`, `uuid`, `last`, `login_id`, `doc_date`, `finish`, `objective`, `action`, `status`, `updated`, `created`) VALUES
(1, '79e2c921-ed38-11ef-9de3-0242ac120005', 1, 1, '2025-02-17', '2025-02-24', 'xxxxx\r\nxxxxx', 1, 2, '2025-02-17 21:40:12', '2025-02-17 21:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `name` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `material` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id`, `uuid`, `name`, `code`, `type_id`, `warehouse_id`, `location_id`, `brand_id`, `unit_id`, `size`, `material`, `text`, `status`, `updated`, `created`) VALUES
(1, '91936033-e62f-11ef-92b2-0242ac120002', 'ตู้แช่น้ำ แนวตั้ง', '', 1, 1, 0, 1, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(2, '9193eb8d-e62f-11ef-92b2-0242ac120002', 'ตู้แช่นม', '', 1, 1, 0, 2, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(3, '91943dfc-e62f-11ef-92b2-0242ac120002', 'No.1 Kios Android  Touch screen 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(4, '91948c99-e62f-11ef-92b2-0242ac120002', 'No.2 Kios Android  Touch screen 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(5, '9194feb2-e62f-11ef-92b2-0242ac120002', 'No.3 Kios Android  Touch screen 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(6, '9195446e-e62f-11ef-92b2-0242ac120002', 'No.4 Kios Android  Touch screen 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(7, '919588fa-e62f-11ef-92b2-0242ac120002', 'No.1 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(8, '9195cd97-e62f-11ef-92b2-0242ac120002', 'No.2 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(9, '91961221-e62f-11ef-92b2-0242ac120002', 'No.3 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(10, '91966e00-e62f-11ef-92b2-0242ac120002', 'No.4 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(11, '9196bee9-e62f-11ef-92b2-0242ac120002', 'No.5 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(12, '91970ba4-e62f-11ef-92b2-0242ac120002', 'No.6 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(13, '919750ec-e62f-11ef-92b2-0242ac120002', 'No.7 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(14, '91979b38-e62f-11ef-92b2-0242ac120002', 'No.8 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(15, '9197e326-e62f-11ef-92b2-0242ac120002', 'No.9 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(16, '91982c83-e62f-11ef-92b2-0242ac120002', 'No.10 TV 43 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(17, '9198a278-e62f-11ef-92b2-0242ac120002', 'TV 32 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(18, '9198fbb1-e62f-11ef-92b2-0242ac120002', 'TV 50 นิ้ว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(19, '91995554-e62f-11ef-92b2-0242ac120002', 'No.1 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(20, '9199a48e-e62f-11ef-92b2-0242ac120002', 'No.2 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(21, '9199ef5b-e62f-11ef-92b2-0242ac120002', 'No.3 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(22, '919a3937-e62f-11ef-92b2-0242ac120002', 'No.4 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(23, '919a8161-e62f-11ef-92b2-0242ac120002', 'No.5 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(24, '919ac97e-e62f-11ef-92b2-0242ac120002', 'No.6 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(25, '919b14b9-e62f-11ef-92b2-0242ac120002', 'No.7 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(26, '919b63f5-e62f-11ef-92b2-0242ac120002', 'No.8 ลำโพง+ไมค์', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(27, '919bafe4-e62f-11ef-92b2-0242ac120002', 'No.9 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(28, '919bfe40-e62f-11ef-92b2-0242ac120002', 'No.10 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(29, '919c7329-e62f-11ef-92b2-0242ac120002', 'No.11 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(30, '919cb853-e62f-11ef-92b2-0242ac120002', 'No.12 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(31, '919cf9f2-e62f-11ef-92b2-0242ac120002', 'No.13 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(32, '919d3bd9-e62f-11ef-92b2-0242ac120002', 'No.14 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(33, '919d80b8-e62f-11ef-92b2-0242ac120002', 'No.15 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(34, '919dc427-e62f-11ef-92b2-0242ac120002', 'No.16 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(35, '919e0938-e62f-11ef-92b2-0242ac120002', 'No.17 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(36, '919e5a47-e62f-11ef-92b2-0242ac120002', 'No.18 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(37, '919ea9af-e62f-11ef-92b2-0242ac120002', 'No.19 ลำโพง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(38, '919ef487-e62f-11ef-92b2-0242ac120002', 'No.1 ตู้กาชาปอง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(39, '919f3d6f-e62f-11ef-92b2-0242ac120002', 'No.2 ตู้กาชาปอง', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(40, '919f873d-e62f-11ef-92b2-0242ac120002', 'ขาตั้งทีวี', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(41, '919ffc4a-e62f-11ef-92b2-0242ac120002', 'พัดลมแบบตั้งพื้น', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(42, '91a0558f-e62f-11ef-92b2-0242ac120002', 'Badicate (สายกันสีดำ)', '', 2, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(43, '91a0b564-e62f-11ef-92b2-0242ac120002', 'หม้อทอดเดียว', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(44, '91a109d0-e62f-11ef-92b2-0242ac120002', 'หม้อทอดคู่', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(45, '91a15d0d-e62f-11ef-92b2-0242ac120002', 'No.1 ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(46, '91a19f4d-e62f-11ef-92b2-0242ac120002', 'No.2  ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(47, '91a1e4f8-e62f-11ef-92b2-0242ac120002', 'No.3  ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(48, '91a2274d-e62f-11ef-92b2-0242ac120002', 'No.4  ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(49, '91a2729b-e62f-11ef-92b2-0242ac120002', 'No.5  ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(50, '91a2b67b-e62f-11ef-92b2-0242ac120002', 'No.6 ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(51, '91a2ff41-e62f-11ef-92b2-0242ac120002', 'No.7 ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(52, '91a37f24-e62f-11ef-92b2-0242ac120002', 'No.8  ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(53, '91a3cb26-e62f-11ef-92b2-0242ac120002', 'No.9 ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(54, '91a4134e-e62f-11ef-92b2-0242ac120002', 'No.10 ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(55, '91a4627d-e62f-11ef-92b2-0242ac120002', 'No.11 ขาเต็นท์', '', 2, 1, 0, 0, 1, '3 x 3 m', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(56, '91a4a6a6-e62f-11ef-92b2-0242ac120002', 'เสาเสริมเต็นท์ฟูจิ', '', 2, 1, 0, 0, 1, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(57, '91a4ec0a-e62f-11ef-92b2-0242ac120002', 'ขาเสริมเต็นท์', '', 2, 1, 0, 0, 1, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(58, '91a52fa9-e62f-11ef-92b2-0242ac120002', 'No.1 อุปกรณ์สายไฟสำหรับเดินระบบ', '', 1, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(59, '91a57841-e62f-11ef-92b2-0242ac120002', 'No.2 อุปกรณ์สายไฟสำหรับเดินระบบ', '', 1, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(60, '91a5be4b-e62f-11ef-92b2-0242ac120002', 'อุปกรณ์ปลั๊กพ่วง', '', 1, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(61, '91a615ed-e62f-11ef-92b2-0242ac120002', 'สปอตร์ไลท์', '', 1, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(62, '91a67a5d-e62f-11ef-92b2-0242ac120002', 'กระเป๋าใส', '', 0, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(63, '91a71ca6-e62f-11ef-92b2-0242ac120002', 'เครื่องปั่นไฟ', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(64, '91a77763-e62f-11ef-92b2-0242ac120002', 'ตู้เมนไฟ', '', 1, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(65, '91a7c5bc-e62f-11ef-92b2-0242ac120002', 'No.1 มาสคอต', '', 3, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(66, '91a816d4-e62f-11ef-92b2-0242ac120002', 'No.2 มาสคอต', '', 3, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(67, '91a8706d-e62f-11ef-92b2-0242ac120002', 'No.3 มาสคอต', '', 3, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(68, '91a8be31-e62f-11ef-92b2-0242ac120002', 'No.4 มาสคอต', '', 3, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(69, '91a90732-e62f-11ef-92b2-0242ac120002', 'NO.1 อุปกรณ์ทำชิม', '', 6, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(70, '91a94cea-e62f-11ef-92b2-0242ac120002', 'NO.2 อุปกรณ์ทำชิม', '', 6, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(71, '91a994b6-e62f-11ef-92b2-0242ac120002', 'NO.3 อุปกรณ์ทำชิม', '', 6, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(72, '91a9dd64-e62f-11ef-92b2-0242ac120002', 'NO.4 อุปกรณ์ทำชิม', '', 6, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(73, '91aa2430-e62f-11ef-92b2-0242ac120002', 'Hada Black Drop', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(74, '91aa832b-e62f-11ef-92b2-0242ac120002', 'Hada Shelf', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(75, '91ab07a4-e62f-11ef-92b2-0242ac120002', 'Hada Couter', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(76, '91ab4df5-e62f-11ef-92b2-0242ac120002', 'Mock Up Sunligh เขียว', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(77, '91ab940b-e62f-11ef-92b2-0242ac120002', 'Mock Up Sunligh ฟ้า', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(78, '91abdeee-e62f-11ef-92b2-0242ac120002', 'Mock Up ฟองน้ำ', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(79, '91ac24ca-e62f-11ef-92b2-0242ac120002', 'ฐาน Mock Up Sunligh', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(80, '91ac6f86-e62f-11ef-92b2-0242ac120002', 'Counter อ่างล้างหน้า', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(81, '91acb51e-e62f-11ef-92b2-0242ac120002', 'Logo light Box Sun light', '', 2, 1, 0, 0, 1, '', 'Zing', '', 1, NULL, '2025-02-08 22:15:44'),
(82, '91acfcc2-e62f-11ef-92b2-0242ac120002', 'Shelf Gariner', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(83, '91ad41a0-e62f-11ef-92b2-0242ac120002', 'Black Drop', '', 2, 1, 0, 0, 1, '1.70x2.00x0.30 m', 'HMR', '', 1, '2025-02-09 22:52:44', '2025-02-08 22:15:44'),
(84, '91ad8ea6-e62f-11ef-92b2-0242ac120002', 'No.1 Couter Cerave', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(85, '91adcb43-e62f-11ef-92b2-0242ac120002', 'No.2 Couter Cerave', '', 2, 1, 0, 0, 0, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(86, '91ae414f-e62f-11ef-92b2-0242ac120002', 'No.1 Black Drop Cerave', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(87, '91ae878d-e62f-11ef-92b2-0242ac120002', 'No.2 Black Drop Cerave', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(88, '91aec7f8-e62f-11ef-92b2-0242ac120002', 'Podium กลม', '', 2, 1, 0, 0, 1, 'H 50 cm', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(89, '91af0ce9-e62f-11ef-92b2-0242ac120002', 'Booth กระเป๋า', '', 2, 1, 0, 0, 3, '1.00 x 1.00 m', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(90, '91af4ec8-e62f-11ef-92b2-0242ac120002', 'Black Drop กระเป๋า (โครง)', '', 2, 1, 0, 0, 3, '2.3x2.3 , 3.0x2.0 m', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(91, '91af962d-e62f-11ef-92b2-0242ac120002', 'Couter 6 ช่อง', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(92, '91afd8cc-e62f-11ef-92b2-0242ac120002', 'ฐานธงญี่ปุ่น + โครงธง', '', 2, 1, 0, 0, 3, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(93, '91b0271f-e62f-11ef-92b2-0242ac120002', 'ฐานบลีชแฟค', '', 2, 1, 0, 0, 1, '', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(94, '91b07f00-e62f-11ef-92b2-0242ac120002', 'ฐานเจแฟค', '', 2, 1, 0, 0, 1, '', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(95, '91b0c682-e62f-11ef-92b2-0242ac120002', 'โครงเหล็ก Arch Way', '', 2, 1, 0, 0, 3, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(96, '91b10d47-e62f-11ef-92b2-0242ac120002', 'No.1 ร่มสนาม', '', 2, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(97, '91b1885c-e62f-11ef-92b2-0242ac120002', 'No.2 ร่มสนาม', '', 2, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(98, '91b1dfef-e62f-11ef-92b2-0242ac120002', 'ลังเก็บสลักธง', '', 2, 1, 0, 0, 2, '', '', '', 1, NULL, '2025-02-08 22:15:44'),
(99, '91b23595-e62f-11ef-92b2-0242ac120002', 'โต๊ะหน้าขาว', '', 2, 1, 0, 0, 1, '1.80 x 0.60 x 0.75 m', '', '', 1, NULL, '2025-02-08 22:15:44'),
(100, '91b29556-e62f-11ef-92b2-0242ac120002', 'โต๊ะหน้าขาว', '', 2, 1, 0, 0, 1, '1.50 x 0.60 x 0.75 m', '', '', 1, NULL, '2025-02-08 22:15:44'),
(101, '91b301de-e62f-11ef-92b2-0242ac120002', 'Hand Pops', '', 2, 1, 0, 0, 1, '', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(102, '91b36f7a-e62f-11ef-92b2-0242ac120002', 'ป้ายทรูปสะพายหลัง', '', 2, 1, 0, 0, 1, '', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(103, '91b3d17e-e62f-11ef-92b2-0242ac120002', 'เกมส์หยอดลูกปิงปอง', '', 4, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(104, '91b430ca-e62f-11ef-92b2-0242ac120002', 'เกมส์เปลี่ยนแผ่นป้าย', '', 4, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(105, '91b494a8-e62f-11ef-92b2-0242ac120002', 'เกมส์หมุนวงล้อ', '', 4, 1, 0, 0, 1, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(106, '91b4f042-e62f-11ef-92b2-0242ac120002', 'ชั้นวางสินค้า 4 ชั้น', '', 4, 1, 0, 0, 1, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(107, '91b540ce-e62f-11ef-92b2-0242ac120002', 'ชั้นวางสินค้า 3 ชั้น', '', 4, 1, 0, 0, 1, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(108, '91b5af33-e62f-11ef-92b2-0242ac120002', 'โต๊ะ ( ชั้นวาง)', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(109, '91b6022d-e62f-11ef-92b2-0242ac120002', 'Shlef ซุ้ม', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(110, '91b64c92-e62f-11ef-92b2-0242ac120002', 'Stand TV', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(111, '91b696c0-e62f-11ef-92b2-0242ac120002', 'ตู้ Slot', '', 2, 1, 0, 0, 1, '', 'MDF', '', 1, NULL, '2025-02-08 22:15:44'),
(112, '91b6e5fc-e62f-11ef-92b2-0242ac120002', 'สแตนดี้ PP BORAD', '', 2, 1, 0, 3, 3, '', 'PP BORAD', '', 1, NULL, '2025-02-08 22:15:44'),
(113, '91b72f53-e62f-11ef-92b2-0242ac120002', 'Booth กระเป๋า Scotch', '', 2, 1, 0, 3, 1, '', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(114, '91b7792a-e62f-11ef-92b2-0242ac120002', 'Black Drop กระเป๋า Scotch', '', 2, 1, 0, 3, 1, '', 'พลาสติก', '', 1, NULL, '2025-02-08 22:15:44'),
(115, '91b7ca09-e62f-11ef-92b2-0242ac120002', 'พรม GRAY A6', '', 5, 1, 0, 3, 1, '1.5 x 3 m', 'พรมอัด', '', 1, NULL, '2025-02-08 22:15:44'),
(116, '91b81457-e62f-11ef-92b2-0242ac120002', 'โครงเคาร์เตอร์เหล็ก', '', 2, 1, 0, 4, 3, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(117, '91b8f5f0-e62f-11ef-92b2-0242ac120002', 'สแตนดี้ Puriku X Mansome', '', 2, 1, 0, 4, 3, '', 'PP BORAD', '', 1, NULL, '2025-02-08 22:15:44'),
(118, '91b951e8-e62f-11ef-92b2-0242ac120002', 'ลังโฟม', '', 6, 1, 0, 4, 1, '', 'โฟม', '', 1, NULL, '2025-02-08 22:15:44'),
(119, '91b9a6d2-e62f-11ef-92b2-0242ac120002', 'Black Drop ไม้', '', 2, 1, 0, 5, 1, '1.00 x 2.00 x 0.40 m', 'HMR', '', 1, NULL, '2025-02-08 22:15:44'),
(120, '91b9f949-e62f-11ef-92b2-0242ac120002', 'Counter', '', 2, 1, 0, 5, 1, '90 x 60 x120 cm', 'HMR', '', 1, NULL, '2025-02-08 22:15:44'),
(121, '91ba4d01-e62f-11ef-92b2-0242ac120002', 'Game หมุนวงล้อ', '', 2, 1, 0, 5, 1, '', 'เหล็ก', '', 1, NULL, '2025-02-08 22:15:44'),
(122, '91ba9c1a-e62f-11ef-92b2-0242ac120002', 'Standee', '', 2, 1, 0, 5, 1, '0.40 x 1.70 m', 'PP BORAD', '', 1, NULL, '2025-02-08 22:15:44'),
(123, '91bae7d8-e62f-11ef-92b2-0242ac120002', 'พื้นไม้ติดสติกเกอร์', '', 2, 1, 0, 5, 1, '3.00 x 3.00 x 0.15 m', 'HMR', '', 1, NULL, '2025-02-08 22:15:44'),
(124, '91bb3160-e62f-11ef-92b2-0242ac120002', 'Standee', '', 2, 1, 0, 5, 1, '0.40 x 1.20 m', 'PP BORAD', '', 1, NULL, '2025-02-08 22:15:44'),
(126, '069cba0c-ee87-11ef-852d-2ad6c30b0fff', 'แท่นเกมส์ต่อยมวย Garnier Men', '', 4, 1, 0, 0, 0, '160x60', 'เหล็ก', '', 1, NULL, '2025-02-19 06:01:57'),
(127, '93ee8dce-ee87-11ef-852d-2ad6c30b0fff', 'เครื่องเล่นเกมส์ต่อยมวย', '', 4, 1, 0, 0, 0, '', '', '', 1, NULL, '2025-02-19 06:05:54'),
(128, 'd8e06fe3-ee87-11ef-852d-2ad6c30b0fff', 'พรม สี BLACK &amp; WHITE A12', '', 5, 1, 0, 0, 0, '3 เมตร', '', '', 1, NULL, '2025-02-19 06:07:49'),
(129, '692c4b6f-ee88-11ef-852d-2ad6c30b0fff', 'ผ้าใบหลังคาเต็นท์', '', 2, 1, 0, 0, 1, '3x3 เมตร', 'ผ้า', '', 1, NULL, '2025-02-19 06:11:51'),
(130, '084932f4-ee8c-11ef-852d-2ad6c30b0fff', 'นวมเกมส์ต่อยมวยสีดำ', '', 4, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-19 06:37:47'),
(131, '140e1658-ee8c-11ef-852d-2ad6c30b0fff', 'นวมเกมส์ต่อยมวยสีแดง', '', 4, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-19 06:38:07'),
(132, '285b74a0-ee8c-11ef-852d-2ad6c30b0fff', 'นาฬิกาจับเวลาสีดำ', '', 4, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-19 06:38:41'),
(133, '63909c29-ee8c-11ef-852d-2ad6c30b0fff', 'เกมส์โยนห่วง Garnier Men', '', 4, 1, 0, 0, 1, '120x80', '', '', 1, NULL, '2025-02-19 06:40:20'),
(134, '83bbdbd9-ee8c-11ef-852d-2ad6c30b0fff', 'ห่วงพลาสติกเกมส์โยนห่วง', '', 4, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-19 06:41:14'),
(145, '1acc6906-ee97-11ef-852d-2ad6c30b0fff', 'Black Drop', '1', 0, 0, 0, 0, 0, 'อันเก่า', '', '', 1, NULL, '2025-02-19 07:57:02'),
(146, '1accd870-ee97-11ef-852d-2ad6c30b0fff', 'Counter', '2', 0, 0, 0, 0, 0, 'อันเก่า', '', '', 1, NULL, '2025-02-19 07:57:02'),
(147, '1acd79a1-ee97-11ef-852d-2ad6c30b0fff', 'Shlef วางสินค้า', '3', 0, 0, 0, 0, 0, 'อันเก่า', '', '', 1, NULL, '2025-02-19 07:57:02'),
(148, '1ace1102-ee97-11ef-852d-2ad6c30b0fff', 'โหลใส่เจล+พร้อมฝา', '4', 0, 0, 0, 0, 0, 'ซื้อใหม่', '', '', 1, NULL, '2025-02-19 07:57:02'),
(149, '1ace9e70-ee97-11ef-852d-2ad6c30b0fff', 'ลูกโปร่งสีทอง', '5', 0, 0, 0, 0, 0, 'ซื้อใหม่', '', '', 1, NULL, '2025-02-19 07:57:02'),
(150, '1acf1d9b-ee97-11ef-852d-2ad6c30b0fff', 'ป้ายพาสวูดไดคัต', '6', 0, 0, 0, 0, 0, 'อันเก่า', '', '', 1, NULL, '2025-02-19 07:57:02'),
(291, '62f2343f-ee97-11ef-852d-2ad6c30b0fff', 'พรม สี BLACK & WHITE A12', '', 5, 1, 0, 0, 0, '3 เมตร', '', '', 1, NULL, '2025-02-19 07:59:03'),
(330, '33cfbee3-ef43-11ef-852d-2ad6c30b0fff', 'ฺBlack Drop กระเป๋า Garnier Men', '', 2, 1, 0, 0, 3, '3x2.3 เมตร', '', '', 1, NULL, '2025-02-20 04:28:58'),
(331, '90110978-ef43-11ef-852d-2ad6c30b0fff', 'สแตนดี้ หลอดโฟม Garnier Men', '', 2, 1, 0, 0, 1, '150x90 cm', 'PP Board', '', 1, NULL, '2025-02-20 04:31:33'),
(332, 'aeea6b4e-ef43-11ef-852d-2ad6c30b0fff', 'สแตนดี้ ตัวละคร Garnier Men', '', 2, 1, 0, 0, 0, '170x83 cm', 'PP Board', '', 1, NULL, '2025-02-20 04:32:24'),
(333, 'f776ce2f-ef43-11ef-852d-2ad6c30b0fff', 'สะพายหลัง Garnier Men', '', 2, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-02-20 04:34:26'),
(334, 'cd4455fb-ef45-11ef-852d-2ad6c30b0fff', 'สายชาร์จเครื่องเกมส์ต่อยมวย', '', 4, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-20 04:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `asset_brand`
--

CREATE TABLE `asset_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_brand`
--

INSERT INTO `asset_brand` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'Malee', 1, NULL, '2025-02-08 11:42:37'),
(2, 'Dna', 1, NULL, '2025-02-08 11:42:43'),
(3, 'Scotch', 1, NULL, '2025-02-08 11:42:55'),
(4, 'Puriku X Mansome', 1, NULL, '2025-02-08 11:43:01'),
(5, 'Yves Rocher', 1, '2025-02-08 11:43:48', '2025-02-08 11:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `asset_file`
--

CREATE TABLE `asset_file` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_location`
--

CREATE TABLE `asset_location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_location`
--

INSERT INTO `asset_location` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'AAA', 1, '2025-02-08 11:24:09', '2025-02-08 11:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `asset_type`
--

CREATE TABLE `asset_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_type`
--

INSERT INTO `asset_type` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'อุปกรณ์ไฟฟ้า', 1, NULL, '2025-02-08 11:24:33'),
(2, 'โครงสร้าง', 1, NULL, '2025-02-08 11:24:41'),
(3, 'มาสคอต', 1, NULL, '2025-02-08 11:24:49'),
(4, 'เกมส์', 1, NULL, '2025-02-08 11:24:57'),
(5, 'พื้น', 1, NULL, '2025-02-08 11:25:08'),
(6, 'อุปกรณ์ทำชิม', 1, NULL, '2025-02-08 11:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `asset_unit`
--

CREATE TABLE `asset_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_unit`
--

INSERT INTO `asset_unit` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'Unit', 1, NULL, '2025-02-08 11:32:00'),
(2, 'Box', 1, '2025-02-08 11:32:57', '2025-02-08 11:32:07'),
(3, 'Set', 1, NULL, '2025-02-08 11:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `asset_warehouse`
--

CREATE TABLE `asset_warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_warehouse`
--

INSERT INTO `asset_warehouse` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'สาทร', 1, '2025-02-07 16:47:35', '2025-02-07 16:39:34'),
(2, 'วงเวียนใหญ่', 1, NULL, '2025-02-08 22:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_authorize`
--

CREATE TABLE `borrow_authorize` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_authorize`
--

INSERT INTO `borrow_authorize` (`id`, `login_id`, `type`, `status`, `updated`, `created`) VALUES
(1, 1, 1, 0, '2025-02-14 15:41:51', '2025-02-14 14:55:16'),
(2, 2, 2, 0, '2025-02-20 05:59:59', '2025-02-14 14:55:20'),
(3, 5, 1, 0, '2025-02-20 09:47:30', '2025-02-14 15:41:20'),
(5, 17, 2, 1, NULL, '2025-02-20 05:59:49'),
(6, 14, 1, 1, NULL, '2025-02-20 08:50:38'),
(7, 16, 1, 1, NULL, '2025-02-20 08:50:44'),
(8, 15, 1, 1, NULL, '2025-02-20 08:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_file`
--

CREATE TABLE `borrow_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_file`
--

INSERT INTO `borrow_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '0b726c9f80e517a70bcfbf80f905095d.pdf', 1, NULL, '2025-02-17 08:07:04'),
(2, 2, '45911751f79c75fa3789c9aa765f0bc6.pdf', 1, NULL, '2025-02-17 08:48:05'),
(3, 6, '9524682d36d26952b85f909d8040bebd.pdf', 1, NULL, '2025-02-20 04:54:09'),
(4, 7, 'ed71219a0a517ba939f49cf753e630f9.pdf', 1, NULL, '2025-02-20 08:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_item`
--

CREATE TABLE `borrow_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_item`
--

INSERT INTO `borrow_item` (`id`, `request_id`, `asset_id`, `text`, `status`, `updated`, `created`) VALUES
(1, 1, 90, 'Gaenier Men 1 ชุด', 1, NULL, '2025-02-17 08:07:04'),
(2, 1, 112, 'ตัวละคร Gaenier Men 1 ตัว', 1, NULL, '2025-02-17 08:07:04'),
(3, 1, 112, 'หลอดโฟม Gaenier Men 1 ตัว', 1, NULL, '2025-02-17 08:07:04'),
(4, 1, 4, 'ติดสติ๊กเกอร์ Gaenier Men', 1, NULL, '2025-02-17 08:07:04'),
(5, 1, 102, 'Gaenier Men 3 อัน', 1, NULL, '2025-02-17 08:07:04'),
(6, 1, 60, 'ปลั๊กโรล และ ปลั๊กพ่วง', 1, NULL, '2025-02-17 08:07:04'),
(7, 1, 45, 'ผ้าใบเต็นท์สีขาว', 1, NULL, '2025-02-17 08:07:04'),
(8, 1, 62, 'ติดสติ๊กเกอร์ Gaenier Men 6 ใบ', 1, NULL, '2025-02-17 08:07:04'),
(9, 1, 19, '', 1, NULL, '2025-02-17 08:07:04'),
(10, 2, 38, 'ส่งของคืน ตู้กาชาปองที่แร็ปงานเดอร์มาติก', 1, NULL, '2025-02-17 08:48:05'),
(11, 2, 19, '', 1, NULL, '2025-02-17 08:48:05'),
(12, 3, 19, 'Test', 1, NULL, '2025-02-19 07:12:16'),
(13, 4, 249, '', 1, NULL, '2025-02-19 08:27:44'),
(14, 5, 249, '', 1, '2025-02-19 09:04:22', '2025-02-19 09:03:59'),
(15, 6, 330, '1 ชุด', 1, NULL, '2025-02-20 04:54:09'),
(16, 6, 333, '3 อัน', 1, NULL, '2025-02-20 04:54:09'),
(17, 6, 332, '1 ตัว', 1, NULL, '2025-02-20 04:54:09'),
(18, 6, 331, '1 ตัว', 1, NULL, '2025-02-20 04:54:09'),
(19, 6, 202, 'ติดสติ๊กเกอร์ Garnier Men', 1, NULL, '2025-02-20 04:54:09'),
(20, 6, 126, '', 1, NULL, '2025-02-20 04:54:09'),
(21, 6, 127, '2 เครื่อง', 1, NULL, '2025-02-20 04:54:09'),
(22, 6, 291, '4 ผืน', 1, NULL, '2025-02-20 04:54:09'),
(23, 6, 45, '3x3 เมตร', 1, NULL, '2025-02-20 04:54:09'),
(24, 6, 129, 'สีขาว 3x3 เมตร', 1, NULL, '2025-02-20 04:54:09'),
(25, 6, 60, '', 1, NULL, '2025-02-20 04:54:09'),
(26, 6, 62, 'ติดสติ๊กเกอร์ Garnier Men 6 ใบ', 1, NULL, '2025-02-20 04:54:09'),
(27, 6, 334, '', 1, NULL, '2025-02-20 04:54:09'),
(28, 6, 130, '', 1, NULL, '2025-02-20 04:54:09'),
(29, 6, 131, '', 1, NULL, '2025-02-20 04:54:09'),
(30, 6, 132, '', 1, NULL, '2025-02-20 04:54:09'),
(31, 6, 208, '', 1, NULL, '2025-02-20 04:54:09'),
(32, 7, 330, '1 ชุด', 1, NULL, '2025-02-20 08:14:08'),
(33, 7, 331, '1 ตัว', 1, NULL, '2025-02-20 08:14:08'),
(34, 7, 332, '1 ตัว', 1, NULL, '2025-02-20 08:14:08'),
(35, 7, 4, 'ติดสติ๊กเกอร์ Garnier Men', 1, NULL, '2025-02-20 08:14:08'),
(36, 7, 333, '3 อัน', 1, NULL, '2025-02-20 08:14:08'),
(37, 7, 306, '', 1, NULL, '2025-02-20 08:14:08'),
(38, 7, 134, '', 1, NULL, '2025-02-20 08:14:08'),
(39, 7, 60, '', 1, NULL, '2025-02-20 08:14:08'),
(40, 7, 291, '2 ผืน', 1, NULL, '2025-02-20 08:14:08'),
(41, 7, 224, '', 1, NULL, '2025-02-20 08:14:08'),
(42, 7, 129, 'สีขาว ขนาด 3X3 เมตร', 1, NULL, '2025-02-20 08:14:08'),
(43, 7, 271, '6 ใบ ติดสติ๊กเกอร์ Garnier Men', 1, NULL, '2025-02-20 08:14:08'),
(44, 7, 19, '', 1, NULL, '2025-02-20 08:14:08'),
(45, 8, 185, '1', 1, NULL, '2025-02-20 09:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_remark`
--

CREATE TABLE `borrow_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_remark`
--

INSERT INTO `borrow_remark` (`id`, `request_id`, `login_id`, `date`, `text`, `status`, `created`) VALUES
(1, 4, 5, '2025-02-19', 'test', 4, '2025-02-19 08:27:58'),
(2, 5, 5, '2025-02-19', 'dddddd', 2, '2025-02-19 09:05:21'),
(3, 2, 14, '2025-02-14', '-', 2, '2025-02-20 08:56:52'),
(4, 2, 14, '2025-02-17', '-', 3, '2025-02-20 08:58:47'),
(5, 1, 14, '2025-02-18', '-', 2, '2025-02-20 09:00:49'),
(6, 8, 17, '2025-02-20', 'test', 4, '2025-02-20 13:37:02'),
(7, 1, 14, '2025-02-21', '-', 3, '2025-02-21 10:33:30'),
(8, 6, 14, '2025-02-21', '+ ขึ้นอุปกรณ์ โรลสายไฟ 1 ชุด', 2, '2025-02-21 10:34:28'),
(9, 7, 14, '2025-02-21', '-', 2, '2025-02-21 10:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_request`
--

CREATE TABLE `borrow_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `event_date` varchar(50) NOT NULL,
  `event_start` date NOT NULL,
  `event_end` date NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `sale` varchar(50) NOT NULL,
  `location_start` varchar(50) NOT NULL,
  `location_end` varchar(50) NOT NULL,
  `objective` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_request`
--

INSERT INTO `borrow_request` (`id`, `uuid`, `last`, `login_id`, `date`, `event_date`, `event_start`, `event_end`, `event_name`, `sale`, `location_start`, `location_end`, `objective`, `status`, `updated`, `created`) VALUES
(1, '2c7beff7-ed06-11ef-8583-2ad6c30b0fff', 1, 8, '2025-02-18', '19/02/2025 - 21/02/2025', '2025-02-19', '2025-02-21', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนชลราษฎรอำรุง', 'รายการที่ไม่มีในระบบ\r\nแท่นเกมส์ต่อยมวย 1 ตัว\r\nเครื่องเกมส์ต่อยมวย 2 เครื่อง\r\nพรม Black &amp; White 4 ผืน\r\nสายชาร์จเครื่องเกมส์ต่อยมวย 2 ชุด\r\nนวมต่อยมวย 2 คู่\r\nนาฬิกาจับเวลา 1 เครื่อง\r\nรถเข็น 1 อัน\r\nบั', 3, '2025-02-21 10:33:30', '2025-02-17 08:07:04'),
(2, 'e777ed49-ed0b-11ef-8583-2ad6c30b0fff', 2, 7, '2025-02-14', '16/02/2025 - 17/02/2025', '2025-02-16', '2025-02-17', 'เดอร์มาติก', 'พี่ตาล', 'ม.ธรรมศาสตร์ รังสิต', 'โกดังสาทร', 'ส่งของคืนโกดัง งานเดอร์มาติก\r\nมีจัดงานเดอร์มาติกต่อเดือนมีนาคม และเมษายน\r\n\r\nของที่ไม่มีในตัวเลือก\r\n1. พรม atlantis A19 1 ม้วน\r\n2. แร็ปใส 1 ม้วน\r\n3. ผ้าคลุมถุงทราย สีขาว 4 ผืน\r\n4. ถุงทราย 4 กระสอบ\r\n5. ', 3, '2025-02-20 08:58:47', '2025-02-17 08:48:05'),
(3, 'd9a506a9-ee90-11ef-852d-2ad6c30b0fff', 3, 9, '2025-02-19', '19/02/2025 - 19/02/2025', '2025-02-19', '2025-02-19', 'Test', 'Test', 'Test', 'Test', 'Test', 1, NULL, '2025-02-19 07:12:16'),
(4, '644a08b0-ee9b-11ef-852d-2ad6c30b0fff', 4, 5, '2025-02-19', '19/02/2025 - 19/02/2025', '2025-02-19', '2025-02-19', 'test', 'test', 'test', 'test', 'test', 4, '2025-02-19 08:27:58', '2025-02-19 08:27:44'),
(5, '74c5312c-eea0-11ef-852d-2ad6c30b0fff', 5, 2, '2025-02-19', '19/02/2025 - 30/02/2025', '2025-02-19', '2025-03-02', 'test', 'test', 'tes', 'test', 'test', 2, '2025-02-19 09:05:21', '2025-02-19 09:03:59'),
(6, 'b8900de2-ef46-11ef-852d-2ad6c30b0fff', 6, 8, '2025-02-21', '24/02/2025 - 25/02/2025', '2025-02-24', '2025-02-25', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนศึกษานารีวิทยา - โรงเรียนมัธยมวัดสิงห์', 'ออกบูธ Garnier Men วันที่ 24/02/2568 - 25/02/2568', 2, '2025-02-21 10:34:28', '2025-02-20 04:54:09'),
(7, 'a891c57f-ef62-11ef-852d-2ad6c30b0fff', 7, 8, '2025-02-22', '24/02/2025 - 24/02/2025', '2025-02-24', '2025-02-24', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนวัดเขียนเขต', 'ออกบูธ Garnier Men กทม ทีม2', 2, '2025-02-21 10:34:47', '2025-02-20 08:14:08'),
(8, 'e71d17f4-ef6f-11ef-852d-2ad6c30b0fff', 8, 5, '2025-02-20', '20/02/2025 - 20/02/2025', '2025-02-20', '2025-02-20', 'test', 'test', 'test', 'test', 'test', 4, '2025-02-20 13:37:02', '2025-02-20 09:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `login_id` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `uuid`, `code`, `name`, `contact`, `status`, `login_id`, `updated`, `created`) VALUES
(1, '2d4d604b-d0ad-11ef-91c3-0242ac120002', 'C001', 'Unilever', '1212312312121', 1, 1, '2025-01-12 14:00:18', '2025-01-12 13:13:18'),
(2, '339f1829-d1a0-11ef-9c9d-0242ac120003', 'C002', 'Anonymous', '', 1, NULL, NULL, '2025-01-15 09:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_file`
--

CREATE TABLE `estimate_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_file`
--

INSERT INTO `estimate_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '6676cd510687ae07cb6a569ce0516f35.pdf', 1, NULL, '2025-02-02 20:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_item`
--

CREATE TABLE `estimate_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `estimate` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_item`
--

INSERT INTO `estimate_item` (`id`, `request_id`, `expense_id`, `estimate`, `status`, `updated`, `created`) VALUES
(1, 1, 3, 200000.00, 1, '2025-02-02 20:31:03', '2025-02-02 20:30:37'),
(2, 1, 5, 150000.00, 1, '2025-02-02 20:31:03', '2025-02-02 20:30:37'),
(3, 1, 8, 50000.00, 1, '2025-02-02 20:31:03', '2025-02-02 20:30:37'),
(4, 1, 13, 100000.00, 1, '2025-02-02 20:31:03', '2025-02-02 20:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_remark`
--

CREATE TABLE `estimate_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_remark`
--

INSERT INTO `estimate_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-02-02 20:31:19'),
(2, 1, 1, '', 3, '2025-02-02 20:31:24'),
(3, 1, 1, '', 4, '2025-02-02 20:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_request`
--

CREATE TABLE `estimate_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `title_name` varchar(100) NOT NULL,
  `sales_name` varchar(100) NOT NULL,
  `budget` decimal(20,2) NOT NULL,
  `type` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_request`
--

INSERT INTO `estimate_request` (`id`, `uuid`, `last`, `login_id`, `customer_id`, `doc_date`, `order_number`, `product_name`, `title_name`, `sales_name`, `budget`, `type`, `remark`, `action`, `status`, `updated`, `created`) VALUES
(1, 'e6e5ddd2-e169-11ef-8d4c-0242ac120003', 1, 1, 1, '2025-02-02', 'SO07010001', 'Breeze', 'Unilever - Breeze Esan', 'Esan Caravan', 700000.00, 1, '', 1, 4, '2025-02-02 20:31:28', '2025-02-02 20:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `reference` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `login_id` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `uuid`, `code`, `name`, `type`, `reference`, `status`, `login_id`, `updated`, `created`) VALUES
(1, '17d4fc50-d0ad-11ef-91c3-0242ac120002', 'A001', 'ประเภทค่าใช้จ่ายเกิดขึ้นตามจริงแต่ละครั้ง', 1, 0, 1, NULL, NULL, '2025-01-11 13:36:00'),
(2, '17d4fd92-d0ad-11ef-91c3-0242ac120002', 'B001', 'ประเภทค่าจ้างทีมงาน จ้างเหมาทั้งโครงการ', 1, 0, 1, NULL, NULL, '2025-01-11 13:36:23'),
(3, '17d4fddf-d0ad-11ef-91c3-0242ac120002', 'A002', 'ค่าสถานที่ (Roadshow)', 2, 1, 1, 1, '2025-01-15 15:02:39', '2025-01-11 14:13:02'),
(4, '17d4fe1e-d0ad-11ef-91c3-0242ac120002', 'A003', 'ค่าสถานที่ (Troop)', 2, 1, 1, 1, '2025-01-23 19:15:48', '2025-01-11 14:13:21'),
(5, '17d4fe54-d0ad-11ef-91c3-0242ac120002', 'A004', 'งานโครงสร้าง', 2, 1, 1, 1, '2025-01-23 19:15:35', '2025-01-11 14:13:37'),
(6, '17d4fe90-d0ad-11ef-91c3-0242ac120002', 'A005', 'ค่าเดินทาง', 2, 1, 1, 1, '2025-01-15 15:03:29', '2025-01-11 14:13:55'),
(7, '17d4feca-d0ad-11ef-91c3-0242ac120002', 'A006', 'ค่าเสื้อ', 2, 1, 1, 1, '2025-01-15 15:03:38', '2025-01-11 14:14:10'),
(8, '17d4ff04-d0ad-11ef-91c3-0242ac120002', 'B002', 'Project (เหมา)', 2, 2, 1, 1, '2025-01-15 15:05:25', '2025-01-11 14:14:35'),
(9, '17d4ff3a-d0ad-11ef-91c3-0242ac120002', 'B004', 'Staff', 2, 2, 1, 1, '2025-01-15 15:06:10', '2025-01-11 14:14:58'),
(10, '17d4ff71-d0ad-11ef-91c3-0242ac120002', 'B003', 'Supervisor (Roadshow)', 2, 2, 1, 1, '2025-01-15 15:05:50', '2025-01-11 14:29:42'),
(11, 'd3f1b1de-d1cd-11ef-9c9d-0242ac120003', 'A007', 'ค่าผลิตบรรจุภัณฑ์', 2, 1, 1, NULL, NULL, '2025-01-15 15:03:51'),
(12, 'd8dfa16b-d1cd-11ef-9c9d-0242ac120003', 'A008', 'อื่นๆ', 2, 1, 1, NULL, NULL, '2025-01-15 15:03:59'),
(13, '312f88f1-d1ce-11ef-9c9d-0242ac120003', 'B005', 'Supervisor + Staff', 2, 2, 1, NULL, NULL, '2025-01-15 15:06:28'),
(14, '4e9152e0-d1ce-11ef-9c9d-0242ac120003', 'B006', 'ค่าที่พัก', 2, 2, 1, NULL, NULL, '2025-01-15 15:07:17'),
(15, '57afa8f7-d1ce-11ef-9c9d-0242ac120003', 'B007', 'ค่าเสื้อ', 2, 2, 1, NULL, NULL, '2025-01-15 15:07:32'),
(16, '5e1f2c66-d1ce-11ef-9c9d-0242ac120003', 'B008', 'ค่าอาหาร', 2, 2, 1, NULL, NULL, '2025-01-15 15:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `issue_authorize`
--

CREATE TABLE `issue_authorize` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_authorize`
--

INSERT INTO `issue_authorize` (`id`, `login_id`, `type`, `status`, `updated`, `created`) VALUES
(1, 1, 1, 0, '2025-02-14 15:44:02', '2025-02-14 14:55:16'),
(2, 2, 2, 0, '2025-02-20 06:00:08', '2025-02-14 14:55:20'),
(3, 5, 1, 0, '2025-02-20 09:42:52', '2025-02-14 15:44:15'),
(4, 17, 2, 0, '2025-02-20 09:37:43', '2025-02-20 06:00:17'),
(5, 14, 1, 1, NULL, '2025-02-20 06:48:20'),
(6, 16, 1, 1, NULL, '2025-02-20 06:48:40'),
(7, 15, 1, 1, NULL, '2025-02-20 06:48:55'),
(8, 17, 1, 1, NULL, '2025-02-20 09:10:43'),
(9, 5, 2, 1, NULL, '2025-02-20 09:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `issue_file`
--

CREATE TABLE `issue_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_file`
--

INSERT INTO `issue_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 2, 'd73c05a103894327bd17924f87fa7e97.pdf', 1, NULL, '2025-02-18 04:03:18'),
(2, 3, '1893ce95c2d8bf6753a6444b880d9e3e.pdf', 1, NULL, '2025-02-18 04:14:50'),
(3, 8, '03cc67379dd9bf011e85a79736458bd2.pdf', 1, NULL, '2025-02-20 07:13:46'),
(4, 10, 'ea262b3f8f2b6b9e04cd48c8b332dc73.pdf', 1, NULL, '2025-02-20 08:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `issue_item`
--

CREATE TABLE `issue_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `confirm` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_item`
--

INSERT INTO `issue_item` (`id`, `request_id`, `product_id`, `warehouse_id`, `type`, `amount`, `confirm`, `status`, `updated`, `created`) VALUES
(1, 1, 2, 1, 1, 48.00, 48.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:17'),
(2, 1, 10, 1, 1, 648.00, 648.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(3, 1, 27, 1, 1, 340.00, 340.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(4, 1, 28, 1, 1, 300.00, 300.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(5, 1, 29, 1, 1, 300.00, 300.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(6, 1, 37, 1, 1, 66.00, 66.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(7, 1, 38, 1, 1, 2592.00, 2592.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(8, 1, 39, 1, 1, 1418.00, 1418.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(9, 1, 40, 1, 1, 56.00, 56.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(10, 1, 43, 1, 1, 502.00, 502.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(11, 1, 44, 1, 1, 161.00, 161.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(12, 1, 45, 1, 1, 1300.00, 1300.00, 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(13, 2, 38, 1, 2, 432.00, 432.00, 1, '2025-02-20 07:05:08', '2025-02-18 04:03:18'),
(14, 2, 39, 1, 2, 144.00, 144.00, 1, '2025-02-20 07:05:08', '2025-02-18 04:03:18'),
(15, 3, 38, 1, 2, 432.00, 432.00, 1, '2025-02-20 07:05:14', '2025-02-18 04:14:50'),
(16, 3, 39, 1, 2, 144.00, 144.00, 1, '2025-02-20 07:05:14', '2025-02-18 04:14:50'),
(17, 4, 46, 1, 1, 7.00, 7.00, 1, '2025-02-20 06:54:09', '2025-02-18 04:28:27'),
(18, 5, 47, 1, 1, 16.00, 15.00, 1, '2025-02-20 07:00:06', '2025-02-19 03:57:20'),
(19, 6, 48, 1, 1, 31.00, 32.00, 1, '2025-02-20 06:56:45', '2025-02-19 04:11:11'),
(20, 7, 52, 1, 1, 4000.00, 4000.00, 1, '2025-02-20 07:00:13', '2025-02-20 03:55:01'),
(21, 8, 38, 1, 2, 864.00, 864.00, 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(22, 8, 39, 1, 2, 288.00, 288.00, 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(23, 8, 46, 1, 2, 2.00, 2.00, 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(24, 8, 47, 1, 2, 8.00, 8.00, 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(25, 8, 48, 1, 2, 8.00, 8.00, 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(26, 9, 39, 1, 2, 216.00, 216.00, 1, '2025-02-20 07:22:17', '2025-02-20 07:20:46'),
(27, 9, 38, 1, 2, 432.00, 432.00, 1, '2025-02-20 07:22:17', '2025-02-20 07:20:46'),
(28, 10, 38, 1, 2, 432.00, 432.00, 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(29, 10, 39, 1, 2, 144.00, 144.00, 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(30, 10, 46, 1, 2, 5.00, 5.00, 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(31, 10, 48, 1, 2, 23.00, 24.00, 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(32, 10, 47, 1, 2, 8.00, 7.00, 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(33, 11, 58, 1, 1, 20.00, 20.00, 1, '2025-02-20 10:07:41', '2025-02-20 09:42:59'),
(34, 12, 56, 1, 1, 40.00, 40.00, 1, '2025-02-20 10:12:12', '2025-02-20 09:43:18'),
(35, 13, 57, 1, 1, 40.00, 40.00, 1, '2025-02-20 10:12:16', '2025-02-20 09:43:49'),
(36, 14, 55, 1, 1, 7.00, 7.00, 1, '2025-02-20 10:12:26', '2025-02-20 09:44:18'),
(37, 15, 54, 1, 1, 12.00, 12.00, 1, '2025-02-20 10:12:55', '2025-02-20 09:44:44'),
(38, 16, 53, 1, 1, 12.00, 12.00, 1, '2025-02-20 10:13:04', '2025-02-20 09:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `issue_remark`
--

CREATE TABLE `issue_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_remark`
--

INSERT INTO `issue_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-17 09:14:05'),
(2, 4, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 06:54:09'),
(3, 6, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 06:56:45'),
(4, 5, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 07:00:06'),
(5, 7, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 07:00:13'),
(6, 2, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 07:05:08'),
(7, 3, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 07:05:14'),
(8, 9, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 07:22:17'),
(9, 11, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 10:07:41'),
(10, 12, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 10:12:12'),
(11, 13, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 10:12:16'),
(12, 14, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 10:12:26'),
(13, 15, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 10:12:55'),
(14, 16, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-20 10:13:04'),
(15, 10, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-21 10:32:35'),
(16, 8, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-21 10:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `issue_request`
--

CREATE TABLE `issue_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` date NOT NULL,
  `event_date` varchar(50) DEFAULT NULL,
  `event_start` date DEFAULT NULL,
  `event_end` date DEFAULT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `sale` varchar(50) DEFAULT NULL,
  `location_start` varchar(50) DEFAULT NULL,
  `location_end` varchar(50) DEFAULT NULL,
  `outcome` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_request`
--

INSERT INTO `issue_request` (`id`, `uuid`, `last`, `login_id`, `type`, `date`, `event_date`, `event_start`, `event_end`, `event_name`, `sale`, `location_start`, `location_end`, `outcome`, `text`, `status`, `updated`, `created`) VALUES
(1, '01a8dd16-ed0f-11ef-8583-2ad6c30b0fff', 1, 1, 1, '2025-02-17', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ยอดยกมา', 2, '2025-02-17 09:14:05', '2025-02-17 09:10:17'),
(2, '491b67e1-edad-11ef-852d-2ad6c30b0fff', 2, 8, 2, '2025-02-19', '20/02/2025 - 20/02/2025', '2025-02-20', '2025-02-20', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนศรีอยุธยา', 0, 'งานออกบูธ Garnier Men \r\nสิ่งที่ยังไม่มีในรายการ\r\nแก้วน้ำ 1 ใบ\r\nเสื้อยืดสีดำ 4 ใบ\r\nผ้าคลุมหน้า 4 ผืน', 2, '2025-02-20 07:05:08', '2025-02-18 04:03:18'),
(3, 'e5931433-edae-11ef-852d-2ad6c30b0fff', 3, 8, 2, '2025-02-20', '21/02/2025 - 21/02/2025', '2025-02-21', '2025-02-21', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนสมุทรปราการ', 0, 'ออกบูธ Garnier Men\r\nสิ่งที่ยังไม่มีในรายการ\r\nแก้วน้ำ 1 ใบ\r\nเสื้อยืดสีดำ 4 ตัว\r\nผ้าคลุมหน้า 4 ผืน', 2, '2025-02-20 07:05:14', '2025-02-18 04:14:50'),
(4, 'ccbad961-edb0-11ef-852d-2ad6c30b0fff', 4, 8, 1, '2025-02-18', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'งาน Garnier Men', 2, '2025-02-20 06:54:09', '2025-02-18 04:28:27'),
(5, '9e090290-ee75-11ef-852d-2ad6c30b0fff', 5, 8, 1, '2025-02-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'งาน Garnier Men', 2, '2025-02-20 07:00:06', '2025-02-19 03:57:20'),
(6, '8d9784df-ee77-11ef-852d-2ad6c30b0fff', 6, 8, 1, '2025-02-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'Garnier Men', 2, '2025-02-20 06:56:45', '2025-02-19 04:11:11'),
(7, '759b507b-ef3e-11ef-852d-2ad6c30b0fff', 7, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'สินค้าสำหรับออกงาน Troop', 2, '2025-02-20 07:00:13', '2025-02-20 03:55:01'),
(8, '39845d95-ef5a-11ef-852d-2ad6c30b0fff', 8, 8, 2, '2025-02-21', '24/02/2025 - 25/02/2025', '2025-02-24', '2025-02-25', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนศึกษานารีวิทยา - โรงเรียนมัธยมวัดสิงห์', 0, 'ออกบูธ งาน Garnier Men สำหรับงาน 2 วัน', 2, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(9, '340f0d47-ef5b-11ef-852d-2ad6c30b0fff', 9, 8, 2, '2025-02-18', '19/02/2025 - 19/02/2025', '2025-02-19', '2025-02-19', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนชลราษฎรอำรุง', 0, 'ออกบูธ Garnier Men\r\nสิ่งที่ยังไม่มีในรายการ\r\nแก้วน้ำ 1 ใบ\r\nเสื้อยืดสีดำ 4 ตัว\r\nผ้าคลุมหน้า 4 ผืน', 2, '2025-02-20 07:22:17', '2025-02-20 07:20:46'),
(10, '596e07c2-ef63-11ef-852d-2ad6c30b0fff', 10, 8, 2, '2025-02-22', '24/02/2025 - 24/02/2025', '2025-02-24', '2025-02-24', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนวัดเขียนเขต', 0, 'ออกบูธ Garnier Men กทม ทีม 2', 2, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(11, '11f79bc2-ef6f-11ef-852d-2ad6c30b0fff', 11, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '20 ลัง', 2, '2025-02-20 10:07:41', '2025-02-20 09:42:59'),
(12, '1d7865de-ef6f-11ef-852d-2ad6c30b0fff', 12, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '40 ลัง', 2, '2025-02-20 10:12:12', '2025-02-20 09:43:18'),
(13, '2fe198f5-ef6f-11ef-852d-2ad6c30b0fff', 13, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้า 40 ลัง', 2, '2025-02-20 10:12:16', '2025-02-20 09:43:49'),
(14, '41538de6-ef6f-11ef-852d-2ad6c30b0fff', 14, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้า 7 ลัง', 2, '2025-02-20 10:12:26', '2025-02-20 09:44:18'),
(15, '50e5e9fd-ef6f-11ef-852d-2ad6c30b0fff', 15, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้า 12 ลัง', 2, '2025-02-20 10:12:55', '2025-02-20 09:44:44'),
(16, '6928fd6b-ef6f-11ef-852d-2ad6c30b0fff', 16, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '12 ลัง นำเข้า', 2, '2025-02-20 10:13:04', '2025-02-20 09:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `uuid`, `username`, `email`, `password`, `level`, `status`, `updated`, `created`) VALUES
(1, '8578263a-d0ae-11ef-91c3-0242ac120002', 'admin.test', 'admin@test.com', '$2y$10$W08w.crPDLXzroZDNFirJObaHK91H.0D7ZszaRR6iQQi9W32.tnci', 9, 1, '2025-02-14 14:46:19', '2023-11-23 09:42:54'),
(2, '857827b5-d0ae-11ef-91c3-0242ac120002', '', 'user@test.com', '$2y$10$jwAmc2BoS2EwrzfL2LkYOel9FZHc9LSbRn4sge.SvmPiOyjoSgLVq', 1, 1, '2025-02-11 00:38:49', '2025-01-03 08:42:52'),
(3, '088ace55-e80f-11ef-8583-2ad6c30b0fff', '', 'n0866881414@gmail.com', '$2y$10$wH1zRiGz7/.zwlccIxlKoOW2Ph2g061zMc5PBs9a.5zaYhOCH9XpO', 1, 1, '2025-02-11 00:39:00', '2025-02-11 00:27:53'),
(4, '333f7a89-e80f-11ef-8583-2ad6c30b0fff', '', 'acount@test.com', '$2y$10$PWvUBBWbA.X8Z6sK1.g9jOAesSlGUgIVUMGaJQwY3yYiBnGsUKRre', 1, 1, '2025-02-11 00:39:21', '2025-02-11 00:29:05'),
(5, '7313af95-e810-11ef-8583-2ad6c30b0fff', 'store', 'store@test.com', '$2y$10$AFRyl5Hh9/sGPXMbyuA/Bum78re.OqMxnWPS2J8Rn.ca4R9ppm4da', 1, 1, '2025-02-17 11:18:15', '2025-02-11 00:38:01'),
(6, '7bc14cfa-e868-11ef-8583-2ad6c30b0fff', '', 'jutamas.pu@test.com', '$2y$10$RlzJAiuhr0uZmr3XEC/unuuP5bKENxpuqeOfZ408S3qey60si.e72', 1, 1, '2025-02-13 07:41:29', '2025-02-11 11:08:12'),
(7, '967c4eaf-e868-11ef-8583-2ad6c30b0fff', '', 'supanida.ja@test.com', '$2y$10$pkvurqhgZowu8eCRfcURE.XDkj4nkWXezT8cqxCQ66WwYbDyzo5t.', 1, 1, '2025-02-13 07:48:55', '2025-02-11 11:08:57'),
(8, 'a6193884-e868-11ef-8583-2ad6c30b0fff', '', 'kamonwan.su@test.com', '$2y$10$1acy0dPFTfWspyBU.bOodeyxT9V0JHFl5WNkakH4CeCnnWAB4dWhS', 1, 1, '2025-02-13 07:42:01', '2025-02-11 11:09:23'),
(9, 'b3949d98-e868-11ef-8583-2ad6c30b0fff', '', 'thaipat.me@test.com', '$2y$10$1aGlCnD4SlcGCwzU2TmGHuYbKmLWPlaQCEcvtRjFNrl.nWXOd1JFW', 1, 1, '2025-02-13 07:50:16', '2025-02-11 11:09:45'),
(10, 'c1ce63be-e868-11ef-8583-2ad6c30b0fff', '', 'emika.ar@test.com', '$2y$10$ndlgSQz1231CGFXwRruPLORQjhtc5VheVBilXZ0T1tokkBCrsp4w2', 1, 1, '2025-02-13 07:49:56', '2025-02-11 11:10:09'),
(11, 'ce2f3f16-e868-11ef-8583-2ad6c30b0fff', '', 'phichayapha.bu@test.com', '$2y$10$1LqOGFQM9pq30NKOLEGrkeM./Fs3bXwIIkMakjY74n2HurC60ioCy', 1, 1, '2025-02-13 07:48:20', '2025-02-11 11:10:30'),
(12, 'db468f94-e868-11ef-8583-2ad6c30b0fff', '', 'charuwan.bo@test.com', '$2y$10$NC8VzY9CASqGXiARh0Mi8Ounm94eo4hZQlhwzoqqCSg5Mh3rbgvai', 1, 1, '2025-02-13 07:42:53', '2025-02-11 11:10:52'),
(13, 'e83837b7-e868-11ef-8583-2ad6c30b0fff', '', 'boonyakorn.be@test.com', '$2y$10$1R8E0nyEqq8YmiCf7ySkouECesAyEYQzqB7fKVC5/CuS.xhvKkHMq', 1, 1, '2025-02-13 07:43:29', '2025-02-11 11:11:14'),
(14, 'fd5dd5d9-e868-11ef-8583-2ad6c30b0fff', '', 'jakawan.ch@test.com', '$2y$10$DHf9sF7RA/mOuhl5Ec.aD.LBO45SPb7bB0K3A7A.Ro6Cvpxw5gXja', 1, 1, '2025-02-13 07:42:30', '2025-02-11 11:11:49'),
(15, 'd06a19f1-e869-11ef-8583-2ad6c30b0fff', '', 'arthid.na@test.com', '$2y$10$.7dOngLcasBWq5HU1h1MV.I9MKO6oDEz0cw/7nZAuuD9LGJQu.XAm', 1, 1, '2025-02-13 07:49:33', '2025-02-11 11:17:43'),
(16, 'ef7d1fc6-e869-11ef-8583-2ad6c30b0fff', '', 'phadung.bo@test.com', '$2y$10$85.aIJqQN.Ad/iT9wj60Nuxb3fvo.6rg4iGU0v6BDBmiIe6PfM7nC', 1, 1, '2025-02-13 07:47:45', '2025-02-11 11:18:35'),
(17, '887b64c0-e9df-11ef-8583-2ad6c30b0fff', 'onuma.th', 'onuma.th@test.com', '$2y$10$0jmZsM.7VX3Ro/B0KuLHT.PNZgvN.VFwt8muVDrAOwhXKW8WGXZAy', 9, 1, '2025-02-20 09:38:38', '2025-02-13 07:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_file`
--

CREATE TABLE `payment_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_file`
--

INSERT INTO `payment_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, 'f428581af5a4f0058dc5f29c168b4580.pdf', 1, NULL, '2025-02-02 20:32:46'),
(2, 2, '69d74dbfbb7a782d2d56945a0745d194.pdf', 1, NULL, '2025-02-02 20:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `payment_item`
--

CREATE TABLE `payment_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `text2` varchar(100) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `wt` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_item`
--

INSERT INTO `payment_item` (`id`, `request_id`, `expense_id`, `text`, `text2`, `amount`, `vat`, `wt`, `status`, `updated`, `created`) VALUES
(1, 1, 3, 'aaa', 'aa', 70000.00, 4900.00, 0.00, 1, '2025-02-02 20:33:42', '2025-02-02 20:32:46'),
(2, 1, 5, 'aaa', 'aa', 50000.00, 3500.00, 0.00, 1, '2025-02-02 20:33:42', '2025-02-02 20:32:46'),
(3, 1, 8, 'bbb', 'bb', 20000.00, 1400.00, 600.00, 1, '2025-02-02 20:33:42', '2025-02-02 20:32:46'),
(4, 1, 13, 'bbb', 'bb', 50000.00, 3500.00, 1500.00, 1, '2025-02-02 20:33:42', '2025-02-02 20:32:46'),
(5, 2, 3, 'xxx', 'xx', 50000.00, 3500.00, 0.00, 1, NULL, '2025-02-02 20:37:26'),
(6, 2, 5, 'xxx', 'xx', 30000.00, 2100.00, 0.00, 1, NULL, '2025-02-02 20:37:26'),
(7, 2, 8, 'yyy', 'yy', 20000.00, 1400.00, 600.00, 1, NULL, '2025-02-02 20:37:26'),
(8, 2, 13, 'yyy', 'yy', 20000.00, 1400.00, 600.00, 1, NULL, '2025-02-02 20:37:26'),
(9, 3, 12, 'ซื้อคอมพิวเตอร์', '10 เครื่อง', 200000.00, 14000.00, 0.00, 1, NULL, '2025-02-23 14:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `payment_remark`
--

CREATE TABLE `payment_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_remark`
--

INSERT INTO `payment_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-02-02 20:34:09'),
(2, 1, 1, '', 3, '2025-02-02 20:35:18'),
(3, 2, 1, '', 2, '2025-02-02 20:37:39'),
(4, 2, 1, '', 3, '2025-02-02 20:37:43'),
(5, 3, 1, '', 2, '2025-02-23 14:41:48'),
(6, 3, 1, '', 3, '2025-02-23 14:43:17'),
(7, 3, 1, '', 4, '2025-02-23 14:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `cheque_bank` varchar(100) DEFAULT NULL,
  `cheque_branch` varchar(100) DEFAULT NULL,
  `cheque_number` varchar(100) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `uuid`, `last`, `login_id`, `doc_date`, `order_number`, `receiver`, `type`, `cheque_bank`, `cheque_branch`, `cheque_number`, `cheque_date`, `action`, `status`, `updated`, `created`) VALUES
(1, '3380d4e2-e16a-11ef-8d4c-0242ac120003', 1, 1, '0000-00-00', 'SO07010001', 'AAAAA', 1, '', '', '', '1970-01-01', 1, 4, '2025-02-02 20:35:18', '2025-02-02 20:32:46'),
(2, 'dad734e2-e16a-11ef-8d4c-0242ac120003', 2, 1, '0000-00-00', 'SO07010001', 'AAAA', 2, 'BBB', 'BBB', 'BBBB', '2025-02-03', 1, 4, '2025-02-02 20:37:43', '2025-02-02 20:37:26'),
(3, '40ff5554-f0fc-11ef-9531-0242ac120005', 3, 1, '2025-02-02', '', 'AAA', 1, '', '', '', '0000-00-00', 1, 4, '2025-02-23 14:43:47', '2025-02-23 14:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `petty_file`
--

CREATE TABLE `petty_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petty_file`
--

INSERT INTO `petty_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '64949e1b2ddbca589049a21929af6f3e.pdf', 1, NULL, '2025-02-23 14:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `petty_item`
--

CREATE TABLE `petty_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petty_item`
--

INSERT INTO `petty_item` (`id`, `request_id`, `text`, `amount`, `status`, `updated`, `created`) VALUES
(1, 1, 'ค่าน้ำมัน', 1250.00, 1, '2025-02-23 19:13:17', '2025-02-23 14:09:44'),
(2, 1, 'ค่าทางด่วน', 100.00, 1, '2025-02-23 19:13:17', '2025-02-23 14:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `petty_remark`
--

CREATE TABLE `petty_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petty_remark`
--

INSERT INTO `petty_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-02-23 14:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `petty_request`
--

CREATE TABLE `petty_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `objective` text NOT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petty_request`
--

INSERT INTO `petty_request` (`id`, `uuid`, `last`, `login_id`, `doc_date`, `objective`, `action`, `status`, `updated`, `created`) VALUES
(1, 'c8e18863-f0f9-11ef-9531-0242ac120005', 1, 1, '2025-02-02', 'TEST PC\r\nTEST PC', 1, 2, '2025-02-23 19:13:17', '2025-02-23 14:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `name` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `uuid`, `name`, `code`, `type_id`, `warehouse_id`, `location_id`, `brand_id`, `unit_id`, `text`, `status`, `updated`, `created`) VALUES
(1, 'e69deff0-e69d-11ef-8e45-0242ac120003', 'Scotch', '', 0, 1, 0, 1, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(2, 'e69e6c49-e69d-11ef-8e45-0242ac120003', 'Mansome คอลาเจน', '', 1, 1, 0, 2, 0, '', 1, '2025-02-17 08:49:37', '2025-02-09 11:25:32'),
(3, 'e69ead77-e69d-11ef-8e45-0242ac120003', 'Mansome ฮันนี่เลมอน', '', 1, 1, 0, 2, 0, '', 1, '2025-02-17 08:49:44', '2025-02-09 11:25:32'),
(4, 'e69ee937-e69d-11ef-8e45-0242ac120003', 'Mansome กูลตาไธโอน', '', 1, 1, 0, 2, 0, '', 1, '2025-02-09 12:47:33', '2025-02-09 11:25:32'),
(5, 'e69f297c-e69d-11ef-8e45-0242ac120003', 'Puriku มิกเบอร์รี่', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(6, 'e69f6780-e69d-11ef-8e45-0242ac120003', 'Puriku องุ่นเคียวโฮ', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(7, 'e69fa52f-e69d-11ef-8e45-0242ac120003', 'Puriku เก๊กฮวย', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(8, 'e69fe840-e69d-11ef-8e45-0242ac120003', 'Puriku น้ำผึ้งเลม่อน', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(9, 'e6a0550b-e69d-11ef-8e45-0242ac120003', 'Puriku สตอเบอรี่', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(10, 'e6a091a4-e69d-11ef-8e45-0242ac120003', 'Dermatix เจล', '', 4, 1, 0, 5, 0, '', 1, '2025-02-17 08:59:30', '2025-02-09 11:25:32'),
(11, 'e6a0d086-e69d-11ef-8e45-0242ac120003', 'ANTI-HAIR LOSS INTENSIVE TREATMENT 16 DAY 60 ML.', '52095', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(12, 'e6a10da5-e69d-11ef-8e45-0242ac120003', 'ANTI-HAIR LOSS SCALP BOOSTER SERUM 75 ML.', '99156', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(13, 'e6a149a2-e69d-11ef-8e45-0242ac120003', 'ANTI-HAIR LOSS WITH WHITE LUPIN SHAMPOO 300 ML.', '98437', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(14, 'e6a182cd-e69d-11ef-8e45-0242ac120003', 'ANTI-HAIR LOSS WITH WHITE LUPIN CONDITIONER 200 ML.', '52694', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(15, 'e6a1babe-e69d-11ef-8e45-0242ac120003', 'กระเป๋าผ้า L\'Evidence 40x42 cm', 'APB156', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(16, 'e6a1f553-e69d-11ef-8e45-0242ac120003', 'ANTI-HAIR LOSS 50 ML.', '43722', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(17, 'e6a22cb2-e69d-11ef-8e45-0242ac120003', 'ANTI-HAIR LOSS DUPLEX', '55610', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(18, 'e6a264bc-e69d-11ef-8e45-0242ac120003', 'MINI AAG INTENSE - 7 ML.', '97930', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(19, 'e6a29c02-e69d-11ef-8e45-0242ac120003', 'MINI SUR LA DE EDP FL 5 ML.', '26780', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(20, 'e6a2d7e9-e69d-11ef-8e45-0242ac120003', 'BC MINI  BATANICAL BALM - FL -50 ML. (REPAIR)', '39322', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(21, 'e6a350d7-e69d-11ef-8e45-0242ac120003', 'BC MINI RV COLOR (SHINE) - FL - 50 ML. (COLOR)', '59182', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(22, 'e6a38f74-e69d-11ef-8e45-0242ac120003', 'MINI WILD ALGAE & SEA FENNEL ENERGIZING BATH & SHOWER GEL 50 ML.', '71653', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(23, 'e6a3c937-e69d-11ef-8e45-0242ac120003', 'MINI SC2 BODY MILK LAIT CARPS REPARATION -TU- 30 ML.', '58306', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(24, 'e6a4041d-e69d-11ef-8e45-0242ac120003', 'MINI ANTI - DANDUFF SHAMPOO 50 ML.', '38028', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(25, 'e6a43d36-e69d-11ef-8e45-0242ac120003', 'MINI HYDRA VEGETAL 100H NON-STOP INTENSE MOISTURIZING CARE 7 ML.', '94060', 0, 2, 0, 0, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(26, 'e6a46c60-e69d-11ef-8e45-0242ac120003', 'Dermatix ครีมแต้มสิว', '', 4, 1, 0, 5, 0, '', 1, '2025-02-17 08:59:11', '2025-02-09 11:25:32'),
(27, 'e6a49a84-e69d-11ef-8e45-0242ac120003', 'Dermatix ชาม', '', 2, 1, 4, 5, 2, 'Note D-8', 1, '2025-02-20 04:32:01', '2025-02-09 11:25:32'),
(28, 'e6a4caa2-e69d-11ef-8e45-0242ac120003', 'Dermatix กระเป๋าสีน้ำเงิน', '', 2, 1, 4, 5, 2, 'Note D-4', 1, '2025-02-20 04:14:55', '2025-02-09 11:25:32'),
(29, 'e6a4f9de-e69d-11ef-8e45-0242ac120003', 'Dermatix กระเป๋าสีขาว', '', 2, 1, 4, 5, 2, 'Note D-4', 1, '2025-02-20 04:30:29', '2025-02-09 11:25:32'),
(30, 'e6a52849-e69d-11ef-8e45-0242ac120003', 'Mansome คลอโรฟิล', '', 1, 1, 0, 2, 0, '', 1, '2025-02-17 08:58:43', '2025-02-09 11:25:32'),
(31, 'e6a55b2d-e69d-11ef-8e45-0242ac120003', 'White WGH 15g', '', 0, 0, 0, 6, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(32, 'e6a5d441-e69d-11ef-8e45-0242ac120003', 'Whip Collagen In a WGH 15g', '', 0, 0, 0, 6, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(33, 'e6a607af-e69d-11ef-8e45-0242ac120003', 'Whip VITC Poreless Glow', '', 0, 0, 0, 6, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(34, 'e6a63bee-e69d-11ef-8e45-0242ac120003', 'พรี่เมี่ยม โลชั่น 30มล.', '', 0, 0, 0, 8, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(35, 'e6a66d3f-e69d-11ef-8e45-0242ac120003', 'พรี่เมี่ยม โลชั่น 170มล.', '', 0, 0, 0, 8, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(36, 'e6a69ba0-e69d-11ef-8e45-0242ac120003', 'พรี่เมี่ยม โลชั่น ไฮเดรทติ้ง ครีม 50กรัม', '', 0, 0, 0, 8, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(37, 'e6a6ca40-e69d-11ef-8e45-0242ac120003', 'แอคโนไฟท์ โฟม 50มล.', '', 4, 1, 4, 7, 2, 'Note D-3', 1, '2025-02-20 04:20:38', '2025-02-09 11:25:32'),
(38, 'e6a6f893-e69d-11ef-8e45-0242ac120003', 'เมน แอคโนไฟท์ โฟมสครับ 15มล', '', 4, 1, 4, 7, 2, 'Note D-5', 1, '2025-02-20 04:19:38', '2025-02-09 11:25:32'),
(39, 'e6a73d9e-e69d-11ef-8e45-0242ac120003', 'แอคโนไฟท์ ซูเปอร์ เซรั่ม 7มล.', '', 4, 1, 4, 7, 2, 'Note D-3', 1, '2025-02-20 04:20:07', '2025-02-09 11:25:32'),
(40, 'e6a781a3-e69d-11ef-8e45-0242ac120003', 'แอคโนไฟท์ โฟมสครับ 100มล.', '', 4, 1, 4, 7, 2, 'Note D-3', 1, '2025-02-20 04:21:00', '2025-02-09 11:25:32'),
(43, '7f57911c-ed0c-11ef-8583-2ad6c30b0fff', 'ถุงผ้าสีชมพู', '', 2, 1, 3, 9, 2, 'Note C-8', 1, '2025-02-20 04:11:08', '2025-02-17 08:52:20'),
(44, '85fdd568-ed0c-11ef-8583-2ad6c30b0fff', 'ถุงผ้าสีขาว', '', 2, 1, 3, 9, 2, 'Note C-8', 1, '2025-02-20 04:08:50', '2025-02-17 08:52:31'),
(45, '8d521b44-ed0c-11ef-8583-2ad6c30b0fff', 'พัดพลาสติก', '', 2, 1, 3, 9, 2, 'Note C-8', 1, '2025-02-20 04:10:00', '2025-02-17 08:52:43'),
(46, '86827899-edb0-11ef-852d-2ad6c30b0fff', 'แก้วน้ำ Garnier Men', '', 5, 1, 0, 7, 2, '', 1, NULL, '2025-02-18 04:26:29'),
(47, '45ae361c-ee75-11ef-852d-2ad6c30b0fff', 'เสื้อยืดสีดำ Garnier Men', '', 5, 1, 0, 7, 2, '', 1, NULL, '2025-02-19 03:54:51'),
(48, '70afb7c7-ee77-11ef-852d-2ad6c30b0fff', 'ผ้าคลุมหน้า Garnier Men', '', 5, 1, 0, 7, 2, '', 1, NULL, '2025-02-19 04:10:23'),
(49, '95713a64-ee93-11ef-852d-2ad6c30b0fff', 'Test', 'Test', 3, 2, 2, 7, 2, 'Test', 1, NULL, '2025-02-19 07:31:50'),
(50, '7675ffb4-ee96-11ef-852d-2ad6c30b0fff', 'Test', 'Test', 3, 2, 0, 5, 2, '', 1, '2025-02-20 03:23:38', '2025-02-19 07:52:27'),
(51, '4edb7c1e-ee98-11ef-852d-2ad6c30b0fff', 'benice - test', '', 5, 1, 0, 0, 1, 'Test - ประเภทสินค้าเป็น ผลิตภัณฑ์ล้างจุดซ่อนเร้น', 2, '2025-02-19 08:07:24', '2025-02-19 08:05:39'),
(52, '5e82335c-ef3e-11ef-852d-2ad6c30b0fff', 'lotte xylitol Sampling', '', 5, 1, 0, 0, 2, '', 1, NULL, '2025-02-20 03:54:22'),
(53, '8e1632b4-ef6d-11ef-852d-2ad6c30b0fff', 'Dutcmill Blue Hawaii', '', 1, 1, 3, 0, 2, 'Note C-3 จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:20:06', '2025-02-20 09:32:08'),
(54, 'e794aa7f-ef6d-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 less sugar 40% Strawberry', '', 1, 1, 3, 0, 2, 'Note C-3  จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:22:32', '2025-02-20 09:34:38'),
(55, '7241fec8-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 less sugar 40% Mixed Fruit', '', 1, 1, 3, 0, 2, 'Note C-3  จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:22:42', '2025-02-20 09:38:31'),
(56, '97c66f49-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 Mixed Fruit', '', 1, 1, 3, 0, 2, 'Note C-7  จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:22:16', '2025-02-20 09:39:34'),
(57, 'c661f8a4-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 Orange', '', 1, 1, 3, 0, 2, 'Note C-7 จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:19:20', '2025-02-20 09:40:52'),
(58, 'ed01dafc-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill Goody fiber', '', 1, 1, 3, 0, 2, 'Note C-5 จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:19:00', '2025-02-20 09:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'Scotch', 1, '2025-02-08 23:04:32', '2025-02-08 23:03:06'),
(2, 'Mansome', 1, NULL, '2025-02-08 23:03:13'),
(3, 'Puriku', 1, NULL, '2025-02-08 23:03:19'),
(4, 'YVES_ROCHER', 1, NULL, '2025-02-08 23:03:33'),
(5, 'Dermatix', 1, NULL, '2025-02-08 23:03:39'),
(6, 'Senka Perfect', 1, NULL, '2025-02-09 10:53:02'),
(7, 'Ganier Men', 1, NULL, '2025-02-09 10:53:10'),
(8, 'Hada Labo', 1, NULL, '2025-02-09 10:53:34'),
(9, 'JobDB', 1, NULL, '2025-02-17 08:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_file`
--

CREATE TABLE `product_file` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_file`
--

INSERT INTO `product_file` (`id`, `product_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 41, '82e96bf322dbcf7be63b2cc47c5c9a08.webp', 1, NULL, '2025-02-10 07:17:57'),
(2, 47, '0ae295cf7b27615ae8a22c19409c0b80.webp', 1, NULL, '2025-02-19 03:54:52'),
(3, 51, 'cd5c6253aee06f0f2b979ed02d2d5be2.webp', 0, '2025-02-19 08:06:40', '2025-02-19 08:05:39'),
(4, 51, 'a30bc23a7749d952113a1900725b5e98.webp', 0, '2025-02-19 08:07:09', '2025-02-19 08:06:50'),
(5, 52, '776bdcef51344d2200c89d6238fc8a6e.webp', 1, NULL, '2025-02-20 03:54:22'),
(6, 53, 'd8126ca508ec65eb5ed4e8573fdd45fa.webp', 1, NULL, '2025-02-20 09:32:08'),
(7, 54, '4692efd0576c6e6eeccb4a875d6ff490.webp', 1, NULL, '2025-02-20 09:34:38'),
(8, 56, 'bf2c60d804711a2cb66bf14f700e9c4e.webp', 1, NULL, '2025-02-20 09:39:34'),
(9, 57, '6d3e2ecedef6a8b639323cf7c916e598.webp', 1, NULL, '2025-02-20 09:40:52'),
(10, 58, 'f262eb90b2f8a8346a6aa34924fbe804.webp', 1, NULL, '2025-02-20 09:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_location`
--

CREATE TABLE `product_location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_location`
--

INSERT INTO `product_location` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'A', 1, NULL, '2025-02-08 22:50:46'),
(2, 'B', 1, NULL, '2025-02-08 22:50:49'),
(3, 'C', 1, NULL, '2025-02-08 22:50:52'),
(4, 'D', 1, NULL, '2025-02-08 22:50:54'),
(5, 'E', 1, NULL, '2025-02-08 22:50:56'),
(6, 'F', 1, '2025-02-08 23:00:39', '2025-02-08 22:50:58'),
(7, 'G', 1, NULL, '2025-02-08 22:50:59'),
(8, 'H', 1, NULL, '2025-02-08 22:51:08'),
(9, 'I', 1, NULL, '2025-02-08 22:51:11'),
(10, 'J', 1, NULL, '2025-02-08 22:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'เครื่องดื่ม', 1, NULL, '2025-02-08 22:54:40'),
(2, 'กระเป๋า', 1, NULL, '2025-02-08 22:55:10'),
(3, 'ผลิตภัณฑ์ดูแลผม', 1, '2025-02-08 23:00:11', '2025-02-08 22:58:56'),
(4, 'ผลิตภัณฑ์ดูแลผิวหน้า', 1, NULL, '2025-02-17 08:48:15'),
(5, 'พรีเมี่ยม', 1, NULL, '2025-02-18 04:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'ขวด', 1, '2025-02-08 23:10:38', '2025-02-08 23:09:47'),
(2, 'ชิ้น', 1, NULL, '2025-02-18 04:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouse`
--

CREATE TABLE `product_warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_warehouse`
--

INSERT INTO `product_warehouse` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'สาทร', 1, '2025-02-07 16:47:35', '2025-02-07 16:39:34'),
(2, 'วงเวียนใหญ่', 1, NULL, '2025-02-08 22:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_file`
--

CREATE TABLE `purchase_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_file`
--

INSERT INTO `purchase_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '785cddbd632b48ccaa03e3144f0b6fde.pdf', 1, NULL, '2025-02-02 20:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `estimate` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `request_id`, `name`, `amount`, `unit`, `estimate`, `status`, `updated`, `created`) VALUES
(1, 1, 'XXXX', 10, 'xx', 20000.00, 1, NULL, '2025-02-02 20:46:22'),
(2, 1, 'YYYY', 20, 'yy', 20000.00, 1, NULL, '2025-02-02 20:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_remark`
--

CREATE TABLE `purchase_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_remark`
--

INSERT INTO `purchase_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-02-02 20:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `department` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `objective` text NOT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`id`, `uuid`, `last`, `login_id`, `doc_date`, `department`, `date`, `order_number`, `objective`, `action`, `status`, `updated`, `created`) VALUES
(1, '1a7ecf4a-e16c-11ef-8d4c-0242ac120003', 1, 1, '2025-02-02', 'YYYY', '2025-02-10', '', 'YYYYY\r\nYYYYY', 1, 2, '2025-02-02 20:46:58', '2025-02-02 20:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_file`
--

CREATE TABLE `quotation_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_file`
--

INSERT INTO `quotation_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '57c03df22534061c74a2b56e247ff5ce.pdf', 1, NULL, '2025-02-25 15:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_item`
--

CREATE TABLE `quotation_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_item`
--

INSERT INTO `quotation_item` (`id`, `request_id`, `product`, `price`, `discount`, `amount`, `status`, `updated`, `created`) VALUES
(1, 1, 'aaa', 1000.00, '10', 10, 1, NULL, '2025-02-25 15:43:11'),
(2, 1, 'bbb', 1000.00, '10%', 10, 1, NULL, '2025-02-25 15:43:11'),
(3, 2, 'xxx', 1000.00, '20', 10, 1, NULL, '2025-03-05 16:43:00'),
(4, 2, 'yyy', 1000.00, '20%', 10, 1, NULL, '2025-03-05 16:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_request`
--

CREATE TABLE `quotation_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `doc_date` date NOT NULL,
  `biller_id` int(11) NOT NULL,
  `customer_type` int(1) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` text NOT NULL,
  `text` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_request`
--

INSERT INTO `quotation_request` (`id`, `uuid`, `last`, `login_id`, `doc_date`, `biller_id`, `customer_type`, `customer_id`, `customer_name`, `customer_address`, `text`, `status`, `updated`, `created`) VALUES
(1, '51b21187-f352-11ef-a2a0-0242ac120002', 1, 1, '2025-02-25', 1, 2, NULL, 'new-customer', 'address-customer', 'TESTTEST\r\nTESTTEST', 1, NULL, '2025-02-25 15:43:11'),
(2, '3a6e2c3e-f9a6-11ef-9f5e-0242ac120003', 2, 1, '2025-03-05', 1, 1, 1, '', '', 'old-customer\r\nold-customer', 1, NULL, '2025-03-05 16:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `sequence` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `uuid`, `sequence`, `name`, `url`, `status`, `updated`, `created`) VALUES
(1, 'cf1bf169-e929-11ef-9523-0242ac120005', 1, 'Estimate Budget', '/estimate', 1, '2025-02-17 23:34:29', '2025-02-12 20:37:08'),
(2, 'cf1c7170-e929-11ef-9523-0242ac120005', 2, 'Purchase Request', '/purchase', 1, '2025-02-17 23:34:29', '2025-02-12 20:37:08'),
(3, 'cf1cfac9-e929-11ef-9523-0242ac120005', 3, 'Payment Order', '/payment', 1, '2025-02-17 23:34:29', '2025-02-12 20:37:08'),
(4, 'cf1d4709-e929-11ef-9523-0242ac120005', 5, 'Advance Clearing', '/advance-clear', 1, '2025-02-17 23:34:29', '2025-02-12 20:37:08'),
(5, 'cf1d9368-e929-11ef-9523-0242ac120005', 10, 'ระบบยืมทรัพย์สิน', '/borrow', 1, '2025-02-17 23:34:29', '2025-02-12 20:37:08'),
(6, 'cf1ddb6a-e929-11ef-9523-0242ac120005', 11, 'ระบบนำเข้า-เบิกออก', '/issue', 1, '2025-02-17 23:34:29', '2025-02-12 20:37:08'),
(7, '680848cb-ed18-11ef-852d-2ad6c30b0fff', 12, 'ข้อมูลทรัพย์สิน', '/asset', 1, '2025-02-17 23:34:29', '2025-02-17 10:17:35'),
(8, '6808cf6e-ed18-11ef-852d-2ad6c30b0fff', 13, 'ข้อมูลสินค้า', '/product', 1, '2025-02-17 23:34:29', '2025-02-17 10:17:35'),
(9, 'c83e08b2-ed19-11ef-852d-2ad6c30b0fff', 14, 'ข้อมูลรายจ่าย', '/expense', 1, '2025-02-17 23:34:29', '2025-02-17 10:27:26'),
(10, 'c83ebb45-ed19-11ef-852d-2ad6c30b0fff', 15, 'ข้อมูลลูกค้า', '/customer', 1, '2025-02-17 23:34:29', '2025-02-17 10:27:26'),
(11, '80a0d3c2-ed36-11ef-9de3-0242ac120005', 4, 'Advance Request', '/advance', 1, '2025-02-17 23:34:29', '2025-02-17 20:52:59'),
(12, '29716cc4-ed4a-11ef-9de3-0242ac120005', 6, 'Petty Cash', '/petty', 1, '2025-02-17 23:34:29', '2025-02-17 23:13:42'),
(13, '2971ed4f-ed4a-11ef-9de3-0242ac120005', 7, 'ระบบใบค้างจ่าย', '/accrued', 1, '2025-02-17 23:34:29', '2025-02-17 23:13:42'),
(14, 'd9a60cd4-ed4b-11ef-9de3-0242ac120005', 8, 'ระบบใบเสนอราคา', '/quotation', 1, '2025-02-17 23:34:29', '2025-02-17 23:25:48'),
(15, 'd9a65f95-ed4b-11ef-9de3-0242ac120005', 9, 'ระบบใบรับมอบงาน', '/job', 1, '2025-02-17 23:34:29', '2025-02-17 23:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_authorize`
--

CREATE TABLE `service_authorize` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `service` varchar(50) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_authorize`
--

INSERT INTO `service_authorize` (`id`, `login_id`, `service`, `updated`, `created`) VALUES
(1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-02-17 23:26:10', '2025-02-12 18:37:02'),
(2, 2, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-02-17 23:26:17', '2025-02-12 18:53:10'),
(3, 5, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-17 23:26:30', '2025-02-12 14:11:37'),
(4, 3, '1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-02-17 23:14:46', '2025-02-13 02:41:47'),
(5, 4, '1,1,1,1,1,1,1,0,0,1,1,1,1,0,1', '2025-02-18 03:41:34', '2025-02-13 02:42:35'),
(6, 6, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:03', '2025-02-13 02:42:37'),
(7, 7, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:09', '2025-02-13 02:42:38'),
(8, 8, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:16', '2025-02-13 02:42:42'),
(9, 9, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:22', '2025-02-13 02:42:43'),
(10, 10, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:28', '2025-02-13 02:43:17'),
(11, 11, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:33', '2025-02-13 02:43:21'),
(12, 12, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:37', '2025-02-13 02:43:25'),
(13, 13, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:44', '2025-02-13 02:43:29'),
(14, 14, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:48', '2025-02-13 02:43:32'),
(15, 15, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:53', '2025-02-13 02:43:38'),
(16, 16, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:57', '2025-02-13 02:43:43'),
(17, 17, '0,0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:41:01', '2025-02-13 08:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_email` varchar(200) NOT NULL,
  `password_default` varchar(50) NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `email`, `password_email`, `password_default`, `updated`) VALUES
(1, 'BELINK MEDIA', 'cpl.issue@gmail.com', 'wtubrchtfugusotb', 'testtest', '2025-01-11 14:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `firstname`, `lastname`, `manager_id`, `contact`) VALUES
(1, 1, 'Admin', 'System', 1, ''),
(2, 2, 'User', 'System', 5, ''),
(3, 3, 'ธีรพัฒน์', 'ทองสุโชติ', 5, 'Admin'),
(4, 4, 'บัญชี', 'บัญชี', 5, '044444'),
(5, 5, 'คลังสินค้า', 'คลังสินค้า', 1, 'คลังสินค้า'),
(6, 6, 'จุฑามาศ', 'พันธุ์สกุล', 2, ''),
(7, 7, 'สุภนิดา', 'จันทร์หอม', 2, ''),
(8, 8, 'กมลวรรณ', 'สุขสำราญ', 2, ''),
(9, 9, 'ไธพัตย์', 'เมฆจรัสวิทย์', 2, ''),
(10, 10, 'เอมิกา', 'อรุณสิคะพันธ์', 2, ''),
(11, 11, 'พิชญาภา', 'บุญมา', 2, ''),
(12, 12, 'จารุวรรณ', 'บุญยาน', 2, ''),
(13, 13, 'บุญญากร', 'เบ็ญสตาล', 2, ''),
(14, 14, 'จักรวาล', 'จันทร์นุช', 5, ''),
(15, 15, 'อาทิตย์', 'นาพรม', 5, ''),
(16, 16, 'ผดุง', 'บุญส่ง', 5, ''),
(17, 17, 'อรอุมา', 'ทองช้อย', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_clear_file`
--
ALTER TABLE `advance_clear_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_clear_item`
--
ALTER TABLE `advance_clear_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_clear_remark`
--
ALTER TABLE `advance_clear_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_clear_request`
--
ALTER TABLE `advance_clear_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_file`
--
ALTER TABLE `advance_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_item`
--
ALTER TABLE `advance_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_remark`
--
ALTER TABLE `advance_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_request`
--
ALTER TABLE `advance_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_brand`
--
ALTER TABLE `asset_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_file`
--
ALTER TABLE `asset_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_location`
--
ALTER TABLE `asset_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_type`
--
ALTER TABLE `asset_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_unit`
--
ALTER TABLE `asset_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_warehouse`
--
ALTER TABLE `asset_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_authorize`
--
ALTER TABLE `borrow_authorize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_file`
--
ALTER TABLE `borrow_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_item`
--
ALTER TABLE `borrow_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_remark`
--
ALTER TABLE `borrow_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_request`
--
ALTER TABLE `borrow_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimate_file`
--
ALTER TABLE `estimate_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimate_item`
--
ALTER TABLE `estimate_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimate_remark`
--
ALTER TABLE `estimate_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimate_request`
--
ALTER TABLE `estimate_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_authorize`
--
ALTER TABLE `issue_authorize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_file`
--
ALTER TABLE `issue_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_item`
--
ALTER TABLE `issue_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_remark`
--
ALTER TABLE `issue_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_request`
--
ALTER TABLE `issue_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `payment_file`
--
ALTER TABLE `payment_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_item`
--
ALTER TABLE `payment_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_remark`
--
ALTER TABLE `payment_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_file`
--
ALTER TABLE `petty_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_item`
--
ALTER TABLE `petty_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_remark`
--
ALTER TABLE `petty_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_request`
--
ALTER TABLE `petty_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_file`
--
ALTER TABLE `product_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_location`
--
ALTER TABLE `product_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_file`
--
ALTER TABLE `purchase_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_remark`
--
ALTER TABLE `purchase_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_file`
--
ALTER TABLE `quotation_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_item`
--
ALTER TABLE `quotation_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_request`
--
ALTER TABLE `quotation_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_authorize`
--
ALTER TABLE `service_authorize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_clear_file`
--
ALTER TABLE `advance_clear_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_clear_item`
--
ALTER TABLE `advance_clear_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advance_clear_remark`
--
ALTER TABLE `advance_clear_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_clear_request`
--
ALTER TABLE `advance_clear_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_file`
--
ALTER TABLE `advance_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_item`
--
ALTER TABLE `advance_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advance_remark`
--
ALTER TABLE `advance_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advance_request`
--
ALTER TABLE `advance_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `asset_brand`
--
ALTER TABLE `asset_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asset_file`
--
ALTER TABLE `asset_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_location`
--
ALTER TABLE `asset_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset_type`
--
ALTER TABLE `asset_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `asset_unit`
--
ALTER TABLE `asset_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `asset_warehouse`
--
ALTER TABLE `asset_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrow_authorize`
--
ALTER TABLE `borrow_authorize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrow_file`
--
ALTER TABLE `borrow_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `borrow_item`
--
ALTER TABLE `borrow_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `borrow_remark`
--
ALTER TABLE `borrow_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `borrow_request`
--
ALTER TABLE `borrow_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estimate_file`
--
ALTER TABLE `estimate_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estimate_item`
--
ALTER TABLE `estimate_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `estimate_remark`
--
ALTER TABLE `estimate_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estimate_request`
--
ALTER TABLE `estimate_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `issue_authorize`
--
ALTER TABLE `issue_authorize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `issue_file`
--
ALTER TABLE `issue_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue_item`
--
ALTER TABLE `issue_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `issue_remark`
--
ALTER TABLE `issue_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `issue_request`
--
ALTER TABLE `issue_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_file`
--
ALTER TABLE `payment_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_item`
--
ALTER TABLE `payment_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_remark`
--
ALTER TABLE `payment_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `petty_file`
--
ALTER TABLE `petty_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petty_item`
--
ALTER TABLE `petty_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `petty_remark`
--
ALTER TABLE `petty_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petty_request`
--
ALTER TABLE `petty_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_file`
--
ALTER TABLE `product_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_location`
--
ALTER TABLE `product_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_file`
--
ALTER TABLE `purchase_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_remark`
--
ALTER TABLE `purchase_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_file`
--
ALTER TABLE `quotation_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_item`
--
ALTER TABLE `quotation_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotation_request`
--
ALTER TABLE `quotation_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service_authorize`
--
ALTER TABLE `service_authorize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
