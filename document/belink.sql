-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2025 at 08:28 PM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 7.4.33

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
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_item`
--

CREATE TABLE `advance_clear_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `expense_id` int NOT NULL,
  `text` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `wt` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_remark`
--

CREATE TABLE `advance_clear_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_clear_request`
--

CREATE TABLE `advance_clear_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doc_date` date NOT NULL,
  `advance_id` int NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_file`
--

CREATE TABLE `advance_file` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_item`
--

CREATE TABLE `advance_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `expense_id` int NOT NULL,
  `text` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_remark`
--

CREATE TABLE `advance_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_request`
--

CREATE TABLE `advance_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doc_date` date NOT NULL,
  `finish` date NOT NULL,
  `objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type_id` int NOT NULL,
  `warehouse_id` int NOT NULL,
  `location_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `size` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `material` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(334, 'cd4455fb-ef45-11ef-852d-2ad6c30b0fff', 'สายชาร์จเครื่องเกมส์ต่อยมวย', '', 4, 1, 0, 0, 3, '', '', '', 1, NULL, '2025-02-20 04:47:34'),
(335, '18c2f584-f35f-11ef-af74-2ad6c30b0fff', 'Peptein', '', 2, 1, 0, 0, 1, 'Tentcard Peptein', 'PP Borad', '', 1, NULL, '2025-02-25 16:58:43'),
(336, '639f0d5e-f7dd-11ef-af74-2ad6c30b0fff', 'พรม A19', '', 5, 1, 0, 0, 0, '3x3 ม.', '', '', 1, NULL, '2025-03-03 10:12:50'),
(337, 'b5e3ca2b-f7dd-11ef-af74-2ad6c30b0fff', 'กล่องสินค้าเดอร์มาติก', '', 2, 1, 0, 0, 0, '', 'พีพีบอร์ด', '', 1, NULL, '2025-03-03 10:15:08'),
(338, 'f0538330-f7dd-11ef-af74-2ad6c30b0fff', 'สแตนดี้เดอร์มาติก 1', '', 2, 1, 0, 0, 0, '', 'พีพีบอร์ด', '', 1, NULL, '2025-03-03 10:16:46'),
(339, '000e219c-f7de-11ef-af74-2ad6c30b0fff', 'สแตนดี้เดอร์มาติก 2', '', 2, 1, 0, 0, 0, '', 'พีพีบอร์ด', '', 1, NULL, '2025-03-03 10:17:12'),
(340, '303f40a8-f7de-11ef-af74-2ad6c30b0fff', 'หลอดสินค้าเดอร์มาติก', '', 2, 1, 0, 0, 0, '', 'แผ่นไม้', '', 1, NULL, '2025-03-03 10:18:33'),
(341, '418f189e-f7de-11ef-af74-2ad6c30b0fff', 'กล่องไม้ เดอร์มาติก', '', 2, 1, 0, 0, 0, '', '', '', 1, NULL, '2025-03-03 10:19:02'),
(342, '5239bee8-f7de-11ef-af74-2ad6c30b0fff', 'ถังขยะเล็ก เดอร์มาติก', '', 2, 1, 0, 0, 0, '', 'พลาสติก', '', 1, NULL, '2025-03-03 10:19:30'),
(343, '604473f6-f7de-11ef-af74-2ad6c30b0fff', 'แบล็คดรอปเดอร์มาติก 1', '', 2, 1, 0, 0, 0, '', 'ไม้', '', 1, NULL, '2025-03-03 10:19:54'),
(344, '6cdfb7bb-f7de-11ef-af74-2ad6c30b0fff', 'แบล็คดรอปเดอร์มาติก 2', '', 2, 1, 0, 0, 0, '', 'ไม้', '', 1, NULL, '2025-03-03 10:20:15'),
(345, '7d77e49e-f8c1-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Hanging สีเขียว', '', 2, 1, 0, 0, 1, '50 x 60 cm', 'PP Borad', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:25:38'),
(346, 'caec36a1-f8c1-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Hanging สีฟ้า', '', 2, 1, 0, 0, 1, '54 x 60 cm', 'PP Borad', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:27:48'),
(347, '24ade06c-f8c2-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Hanging สีม่วง', '', 2, 1, 0, 0, 1, '54 x 60 cm', 'PP Borad', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:30:19'),
(348, '3d90a753-f8c2-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Hanging แดง', '', 2, 1, 0, 0, 1, '60 x 60 cm', 'PP Borad', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:31:01'),
(349, 'a812989a-f8c2-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol รถเข็น', '', 2, 1, 0, 0, 1, '32x32x85 cm', 'PP Borad', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:33:59'),
(350, 'bc520128-f8c3-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Mock Up No.1 (สีเขียว)', '', 2, 1, 0, 0, 1, 'r=20 , H=30 cm', 'พลาสติก+Inkjet', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:41:43'),
(351, 'cac8d85e-f8c3-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Mock Up No.2 (สีเขียว)', '', 2, 1, 0, 0, 1, 'r=20 , H=30 cm', 'พลาสติก+Inkjet', 'งาน Troop Event_Lotte Xylitol', 1, '2025-03-04 13:43:26', '2025-03-04 13:42:07'),
(352, 'd6216b1f-f8c3-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Mock Up No.3 (สีเขียว)', '', 2, 1, 0, 0, 1, 'r=20 , H=30 cm', 'พลาสติก+Inkjet', 'งาน Troop Event_Lotte Xylitol', 1, '2025-03-04 13:43:40', '2025-03-04 13:42:26'),
(353, 'de052b9c-f8c3-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Mock Up No.4 (สีเขียว)', '', 2, 1, 0, 0, 1, 'r=20 , H=30 cm', 'พลาสติก+Inkjet', 'งาน Troop Event_Lotte Xylitol', 1, '2025-03-04 13:43:51', '2025-03-04 13:42:39'),
(354, 'eb142d45-f8c3-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Mock Up No.5 (สีเขียว)', '', 2, 1, 0, 0, 1, 'r=20 , H=30 cm', 'พลาสติก+Inkjet', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:43:01'),
(355, '1e241de2-f8c4-11ef-af74-2ad6c30b0fff', 'Lotte Xylitol Mock Up No.6 (สีเขียว)', '', 2, 1, 0, 0, 1, 'r=20 , H=30 cm', 'พลาสติก+Inkjet', 'งาน Troop Event_Lotte Xylitol', 1, NULL, '2025-03-04 13:44:27'),
(356, 'cf9d6f23-f8e3-11ef-af74-2ad6c30b0fff', 'โครง Counter พับได้ สีดำ', '', 2, 1, 0, 0, 1, '', 'เหล็ก', '', 1, NULL, '2025-03-04 17:31:19'),
(357, '1cdfa614-f8e4-11ef-af74-2ad6c30b0fff', 'พรม A20 สี Turquoise', '', 5, 1, 0, 0, 1, '', '', '', 1, NULL, '2025-03-04 17:33:29'),
(358, 'f3ebfbf4-f9a3-11ef-af74-2ad6c30b0fff', 'สแตนดี้ Dutchmill x BUS', '', 2, 1, 0, 0, 1, '70x170', 'PP Board', '', 1, NULL, '2025-03-05 16:26:43'),
(359, '0c2c3ad2-f9a4-11ef-af74-2ad6c30b0fff', 'ถาดแจกชิมดัชมิลล์ 4 in 1  ลดน้ำตาลลง 40%', '', 6, 1, 0, 0, 1, '', 'PP Board', '', 1, NULL, '2025-03-05 16:27:24'),
(360, '2916d4fc-f9a4-11ef-af74-2ad6c30b0fff', 'โครงสร้างเหล็ก Phone Charging พร้อมระบบเต้าไฟ  สีน้ำเงิน', '', 2, 1, 0, 0, 1, '180 cm', 'เหล็ก', '', 1, NULL, '2025-03-05 16:28:13'),
(361, '738fa89a-fb05-11ef-af74-2ad6c30b0fff', 'ลังไม้พาเรท + ผลไม้ปลอม งานดัชมิลล์', '', 2, 1, 0, 0, 3, '', 'ไม้', '', 1, NULL, '2025-03-07 10:37:10'),
(362, '8b594c96-fe5e-11ef-af74-2ad6c30b0fff', 'โครงสร้างอะคริลิค การ์นิเย่ UV 50+', '', 2, 1, 0, 0, 1, '135 cm x 120 cm', 'อะคริลิค', '', 1, NULL, '2025-03-11 16:52:29'),
(363, 'cd60e033-ffb0-11ef-af74-2ad6c30b0fff', 'Standee Garnier ไบรท์ คอมพลีท 30 X วิตามินซี+ บูสเตอร์ เซรั่ม', '', 2, 1, 0, 0, 1, '', 'PP Borad', '', 1, NULL, '2025-03-13 09:13:49'),
(364, '023d24e5-ffb1-11ef-af74-2ad6c30b0fff', 'Standee Garnier Bright Complete 30x Vitamin C+ Booster Serum', '', 2, 1, 0, 0, 1, '', 'PP Borad', '', 1, NULL, '2025-03-13 09:15:18'),
(365, '28ec6716-0090-11f0-af74-2ad6c30b0fff', 'Backdrop jobsDB (3m.)', '', 2, 1, 0, 6, 3, '3x3 m', 'ผ้า+โครงเหล็ก', 'backdrop ขนาด 3x3m.  ของบีลิงค์ผลิตให้ลูกค้าจัดงาน', 1, '2025-03-19 21:17:15', '2025-03-14 11:52:41'),
(366, '48a0c325-0090-11f0-af74-2ad6c30b0fff', 'counter jobsDB (สำเร็จรูป พลาสติก)', '', 2, 1, 0, 6, 3, '', 'พลาสติก', 'counter สำเร็จรูป ของบีลิง๕ืผลิตให้ลูกค้า', 1, '2025-03-19 21:16:44', '2025-03-14 11:53:34'),
(367, '6b206873-0090-11f0-af74-2ad6c30b0fff', 'Standee jobsDB', '', 2, 1, 0, 6, 1, '', 'pp board', 'Standee 2 ชิ้น ของงาน jobsDB', 1, NULL, '2025-03-14 11:54:32'),
(368, '45e0b83a-02db-11f0-af74-2ad6c30b0fff', 'เคาร์เตอร์กานิเย่', '', 2, 1, 0, 0, 0, '', 'ไม้', 'การ์นิเย่', 1, NULL, '2025-03-17 09:55:24'),
(369, 'b9897bf3-02db-11f0-af74-2ad6c30b0fff', 'โครงไม้ขวดยูวีมิช', '', 2, 1, 0, 0, 0, '', 'ไม้', 'การ์นิเย่', 1, NULL, '2025-03-17 09:58:38'),
(370, '1a17951d-02dc-11f0-af74-2ad6c30b0fff', 'standee การ์นิเย่ยูวี', '', 2, 1, 0, 0, 0, '', '', 'การ์นิเย่', 1, NULL, '2025-03-17 10:01:20'),
(371, '91ae4aae-0399-11f0-af74-2ad6c30b0fff', 'แบล็คดรอปผ้าการ์นิเย่ยูวี', '', 2, 1, 0, 0, 3, '3×2.70', 'ผ้า', 'การ์นิเย่', 1, NULL, '2025-03-18 08:37:35'),
(372, '414f2832-04cc-11f0-a87c-2ad6c30b0fff', 'Backdrop jobsDB (1.5m.)', '', 2, 1, 0, 6, 3, '1.5x2.0 m.', 'ผ้า+โครงเหล็ก', 'backdrop jobsDB ของลูกค้า', 1, '2025-03-19 21:17:38', '2025-03-19 21:12:56'),
(373, '6cb99636-04cc-11f0-a87c-2ad6c30b0fff', 'counter jobsdb (เหล็ก)', '', 2, 1, 0, 6, 3, '', 'อุปกรณ์สำเร็จรูป ชนิดเหล็ก', 'counter สินค้าของลูกค้า', 1, NULL, '2025-03-19 21:14:09'),
(374, '995e9823-04cc-11f0-a87c-2ad6c30b0fff', 'Roll up jobsDB (QR code สายงาน)', '', 2, 1, 0, 6, 3, '', 'อะลูมิเนียม', 'สินค้าของลูกค้า', 1, NULL, '2025-03-19 21:15:24'),
(375, 'b12f6947-0545-11f0-a87c-2ad6c30b0fff', 'เกมส์โยนบอล Garnier UV', '', 4, 1, 0, 0, 0, '83x170', 'PP Board', '', 1, NULL, '2025-03-20 11:42:13'),
(376, 'feda3b9b-0545-11f0-a87c-2ad6c30b0fff', 'สแตนดี้ Garnier UV พร้อมชั้นวาง', '', 2, 1, 0, 0, 1, '120x170', 'PP Board', '', 1, NULL, '2025-03-20 11:44:23'),
(377, '211e82cf-0546-11f0-a87c-2ad6c30b0fff', 'สแตนดี้ซอง Garnier UV', '', 2, 1, 0, 0, 1, '90x170', 'PP Board', '', 1, NULL, '2025-03-20 11:45:20'),
(378, '4e467ad0-0546-11f0-a87c-2ad6c30b0fff', 'สแตนดี้ทรายปลาดาว Garnier UV', '', 2, 1, 0, 0, 1, '112x27.3', 'PP Board', '', 1, NULL, '2025-03-20 11:46:36'),
(379, '67926683-0546-11f0-a87c-2ad6c30b0fff', 'สแตนดี้ทรายลูกบอล Garnier UV', '', 2, 1, 0, 0, 1, '150x44.7', 'PP Board', '', 1, NULL, '2025-03-20 11:47:19'),
(380, 'a1aea971-0546-11f0-a87c-2ad6c30b0fff', 'Hanging Garnier UV', '', 2, 1, 0, 0, 1, '50x75', 'PP Board', '', 1, NULL, '2025-03-20 11:48:56'),
(381, 'e8036fe3-0546-11f0-a87c-2ad6c30b0fff', 'หมวกสีเหลือง ติดสติ๊กเกอร์ Garnier UV', '', 2, 1, 0, 0, 1, '', 'พลาสติก', '', 1, NULL, '2025-03-20 11:50:54'),
(382, '0f351d56-0547-11f0-a87c-2ad6c30b0fff', 'ลูกบอลพลาสติกสีเหลือง 50 ลูก พร้อมถังใส่ลูกบอล', '', 4, 1, 0, 0, 3, '7', 'พลาสติก', '', 1, NULL, '2025-03-20 11:52:00'),
(383, '40ac202d-0547-11f0-a87c-2ad6c30b0fff', 'ถุงทรายสีดำ', '', 2, 1, 0, 0, 1, '', 'ผ้า', '', 1, NULL, '2025-03-20 11:53:23'),
(384, '771c9bb6-0547-11f0-a87c-2ad6c30b0fff', 'พรม A9 สี Green', '', 2, 1, 0, 0, 1, '1.5x3', 'ผ้า', '', 1, NULL, '2025-03-20 11:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `asset_brand`
--

CREATE TABLE `asset_brand` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_brand`
--

INSERT INTO `asset_brand` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'Malee', 1, NULL, '2025-02-08 11:42:37'),
(2, 'Dna', 1, NULL, '2025-02-08 11:42:43'),
(3, 'Scotch', 1, NULL, '2025-02-08 11:42:55'),
(4, 'Puriku X Mansome', 1, NULL, '2025-02-08 11:43:01'),
(5, 'Yves Rocher', 1, '2025-02-08 11:43:48', '2025-02-08 11:43:07'),
(6, 'JobDB', 1, NULL, '2025-03-14 11:46:30'),
(7, 'lotte', 1, NULL, '2025-03-14 11:48:19'),
(8, 'CeraVe', 1, NULL, '2025-03-14 11:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `asset_file`
--

CREATE TABLE `asset_file` (
  `id` int NOT NULL,
  `asset_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_file`
--

INSERT INTO `asset_file` (`id`, `asset_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 335, '28c9efeadee0f7e6e8e04357fa29dc04.webp', 1, NULL, '2025-02-25 16:58:43'),
(2, 336, 'ecd52024477174630dcdb42c4380af49.webp', 1, NULL, '2025-03-03 10:12:50'),
(3, 337, 'b4aa6b064c585eb94ede92f2e84f8035.webp', 1, NULL, '2025-03-03 10:15:08'),
(4, 338, 'e31828d482f85010127d028c7863f471.webp', 1, NULL, '2025-03-03 10:16:46'),
(5, 339, 'e0d74b8015681a36adb4bca3f3864bd9.webp', 1, NULL, '2025-03-03 10:17:13'),
(6, 340, '44902dab2a1bc46f802adf3e9e7547e5.webp', 1, NULL, '2025-03-03 10:18:33'),
(7, 341, '8277677c700d7765f6d1e59b63d526d1.webp', 1, NULL, '2025-03-03 10:19:02'),
(8, 342, 'c7507d89512dc2a0e0e3cf8af334e3c7.webp', 1, NULL, '2025-03-03 10:19:30'),
(9, 343, '9853f9d1afec6337e331895fdc3cf80a.webp', 1, NULL, '2025-03-03 10:19:54'),
(10, 344, 'ca684d8bf2d20000b67bd311bad6ff1a.webp', 1, NULL, '2025-03-03 10:20:15'),
(11, 345, '55508be6bb78d0d69dc1b3230d1c7f9e.webp', 1, NULL, '2025-03-04 13:25:38'),
(12, 346, 'e24219ec97fdc936a49f7524a63b6178.webp', 1, NULL, '2025-03-04 13:27:48'),
(13, 347, '25192a94d6dc39d65d36a88a3123a817.webp', 1, NULL, '2025-03-04 13:30:19'),
(14, 348, '4ed83239d791e4614d3af462edbc7be0.webp', 1, NULL, '2025-03-04 13:31:01'),
(15, 349, '036d4ce030ac3834807dc2bcfea1111f.webp', 1, NULL, '2025-03-04 13:34:00'),
(16, 350, 'cb8568d977b63c8fd55aa1655d906622.webp', 1, NULL, '2025-03-04 13:41:43'),
(17, 354, '2dd837a1f3e9faf63b25a360fc1e9abd.webp', 1, NULL, '2025-03-04 13:43:02'),
(18, 351, 'a569afa8d2c70b6c90af201e97b9520a.webp', 1, NULL, '2025-03-04 13:43:15'),
(19, 352, 'aacacd730868b0e1823953903000f49a.webp', 1, NULL, '2025-03-04 13:43:40'),
(20, 353, 'c58718f60f5358c62e4c9b82a7266018.webp', 1, NULL, '2025-03-04 13:43:51'),
(21, 355, '63d28e4c235151a3265f7cbdd0d0374b.webp', 1, NULL, '2025-03-04 13:44:27'),
(22, 362, '5e2381be9953b560b8c9d52afd4e8c2f.webp', 1, NULL, '2025-03-11 16:52:29'),
(23, 363, 'dd6f0c678d617a79a93c5711c354dc54.webp', 1, NULL, '2025-03-13 09:13:49'),
(24, 364, 'a5b0e8ad8ee6b20954887c66baf03b83.webp', 1, NULL, '2025-03-13 09:15:18'),
(25, 372, '7ba9d50f408ae28972bc5ef1277b8780.webp', 1, NULL, '2025-03-19 21:12:56'),
(26, 373, '8decc174bf6766b621044952b0378541.webp', 1, NULL, '2025-03-19 21:14:09'),
(27, 374, 'ac3e17c2905725a0239d9dc4b9469022.webp', 1, NULL, '2025-03-19 21:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `asset_location`
--

CREATE TABLE `asset_location` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `login_id` int NOT NULL,
  `type` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_file`
--

INSERT INTO `borrow_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '0b726c9f80e517a70bcfbf80f905095d.pdf', 1, NULL, '2025-02-17 08:07:04'),
(2, 2, '45911751f79c75fa3789c9aa765f0bc6.pdf', 1, NULL, '2025-02-17 08:48:05'),
(3, 6, '9524682d36d26952b85f909d8040bebd.pdf', 1, NULL, '2025-02-20 04:54:09'),
(4, 7, 'ed71219a0a517ba939f49cf753e630f9.pdf', 1, NULL, '2025-02-20 08:14:08'),
(5, 9, '4cafe681010b84952b841061752d497c.pdf', 1, NULL, '2025-03-03 10:28:02'),
(6, 10, '651964341832514beea3cc0c4be0b2c6.pdf', 1, NULL, '2025-03-05 11:24:07'),
(7, 11, '5a10f9ad146a2971c8d12b3d42ef7a56.pdf', 1, NULL, '2025-03-05 11:26:33'),
(8, 12, '54834fece024861bee075e820e7d725f.pdf', 1, NULL, '2025-03-05 11:28:52'),
(9, 13, 'cbb7add81bcc4d1b2e529289459901a0.pdf', 1, NULL, '2025-03-05 11:31:44'),
(10, 14, 'a791ef1582f488fe28bb57888d75d9f2.pdf', 1, NULL, '2025-03-05 17:07:28'),
(11, 15, '7625fb5ce27628110a71c6c852be3efb.pdf', 1, NULL, '2025-03-06 09:55:13'),
(12, 17, '94ecf65398e66718bfda4bb132302a21.pdf', 1, NULL, '2025-03-07 17:59:25'),
(13, 18, '0b102d9209b908b49a9ce68d0665b472.pdf', 1, NULL, '2025-03-12 15:56:18'),
(14, 20, 'e764b30ede73a906615a9862a99df469.pdf', 1, NULL, '2025-03-13 10:48:34'),
(15, 23, 'e6c15cacd871aaf057612af5f2a98998.pdf', 1, NULL, '2025-03-17 15:22:51'),
(16, 25, '8cfc77cd0e78935d47cf7a89b8dcaad2.pdf', 1, NULL, '2025-03-18 18:09:15'),
(17, 27, 'f66f8581a72604cea83173cab7696a29.pdf', 1, NULL, '2025-03-19 21:15:05'),
(18, 32, '4b3034d9f284778bf1c8425b86b08db6.pdf', 1, NULL, '2025-03-20 15:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_item`
--

CREATE TABLE `borrow_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `asset_id` int NOT NULL,
  `text` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(12, 3, 19, 'Test', 0, '2025-02-24 11:35:24', '2025-02-19 07:12:16'),
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
(45, 8, 185, '1', 1, NULL, '2025-02-20 09:48:56'),
(46, 9, 38, 'ตู้กาชาปองที่แร็ปงานเดอร์มาติก', 1, NULL, '2025-03-03 10:28:02'),
(47, 9, 19, 'ฝากเทสลำโพง+ไมค์ค่า', 1, NULL, '2025-03-03 10:28:02'),
(48, 9, 336, 'ของเดอร์มาติก', 1, NULL, '2025-03-03 10:28:02'),
(49, 9, 60, 'ปลั๊กโรล', 1, NULL, '2025-03-03 10:28:02'),
(50, 9, 60, 'ปลั๊กสามตา', 1, NULL, '2025-03-03 10:28:02'),
(51, 9, 337, '', 1, NULL, '2025-03-03 10:28:02'),
(52, 9, 338, '', 1, NULL, '2025-03-03 10:28:02'),
(53, 9, 339, '', 1, NULL, '2025-03-03 10:28:02'),
(54, 9, 340, '', 1, NULL, '2025-03-03 10:28:02'),
(55, 9, 341, '', 1, NULL, '2025-03-03 10:28:02'),
(56, 9, 342, '', 1, NULL, '2025-03-03 10:28:02'),
(57, 9, 343, '', 1, NULL, '2025-03-03 10:28:02'),
(58, 9, 344, '', 1, NULL, '2025-03-03 10:28:02'),
(59, 9, 41, '2 ตัว', 1, NULL, '2025-03-03 10:28:02'),
(60, 10, 346, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(61, 10, 347, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(62, 10, 345, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(63, 10, 348, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(64, 10, 349, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(65, 10, 350, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(66, 10, 351, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(67, 10, 352, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(68, 10, 353, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(69, 10, 354, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(70, 10, 355, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(71, 10, 19, '', 1, '2025-03-05 11:32:14', '2025-03-05 11:24:07'),
(72, 11, 346, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(73, 11, 347, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(74, 11, 345, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(75, 11, 348, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(76, 11, 349, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(77, 11, 350, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(78, 11, 351, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(79, 11, 352, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(80, 11, 353, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(81, 11, 354, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(82, 11, 355, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(83, 11, 19, '', 1, '2025-03-05 11:32:51', '2025-03-05 11:26:33'),
(84, 12, 346, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(85, 12, 347, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(86, 12, 345, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(87, 12, 348, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(88, 12, 349, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(89, 12, 350, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(90, 12, 351, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:52'),
(91, 12, 352, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:52'),
(92, 12, 353, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:52'),
(93, 12, 354, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:52'),
(94, 12, 355, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:52'),
(95, 12, 19, '', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:52'),
(96, 13, 346, '', 1, NULL, '2025-03-05 11:31:44'),
(97, 13, 347, '', 1, NULL, '2025-03-05 11:31:44'),
(98, 13, 345, '', 1, NULL, '2025-03-05 11:31:44'),
(99, 13, 348, '', 1, NULL, '2025-03-05 11:31:44'),
(100, 13, 349, '', 1, NULL, '2025-03-05 11:31:44'),
(101, 13, 350, '', 1, NULL, '2025-03-05 11:31:44'),
(102, 13, 351, '', 1, NULL, '2025-03-05 11:31:44'),
(103, 13, 352, '', 1, NULL, '2025-03-05 11:31:44'),
(104, 13, 353, '', 1, NULL, '2025-03-05 11:31:44'),
(105, 13, 354, '', 1, NULL, '2025-03-05 11:31:44'),
(106, 13, 355, '', 1, NULL, '2025-03-05 11:31:44'),
(107, 13, 19, '', 1, NULL, '2025-03-05 11:31:44'),
(108, 14, 356, '', 1, NULL, '2025-03-05 17:07:27'),
(109, 14, 357, '', 1, NULL, '2025-03-05 17:07:27'),
(110, 14, 360, '', 1, NULL, '2025-03-05 17:07:27'),
(111, 14, 358, '', 1, NULL, '2025-03-05 17:07:28'),
(112, 14, 359, '', 1, NULL, '2025-03-05 17:07:28'),
(113, 14, 60, 'ปลั๊กโรล 2 อัน + ปลั๊กพ่วง 1 อัน', 1, NULL, '2025-03-05 17:07:28'),
(114, 14, 61, '2 อัน + สายไฟ', 1, NULL, '2025-03-05 17:07:28'),
(115, 14, 19, 'สายชาร์จ', 1, NULL, '2025-03-05 17:07:28'),
(116, 15, 41, '2 ตัว', 1, NULL, '2025-03-06 09:55:13'),
(117, 16, 21, 'ลำโพง 1 ตัว + ไมค์ 2 ตัว', 1, NULL, '2025-03-06 17:03:54'),
(118, 17, 38, 'ตู้กาชาปองที่แร็ปงานเดอร์มาติก', 1, NULL, '2025-03-07 17:59:25'),
(119, 17, 19, '', 1, NULL, '2025-03-07 17:59:25'),
(120, 17, 20, '', 1, NULL, '2025-03-07 17:59:25'),
(121, 17, 337, '', 1, NULL, '2025-03-07 17:59:25'),
(122, 17, 341, '', 1, NULL, '2025-03-07 17:59:25'),
(123, 17, 342, '', 1, NULL, '2025-03-07 17:59:25'),
(124, 17, 336, '', 1, NULL, '2025-03-07 17:59:25'),
(125, 17, 41, '2 ตัว', 1, NULL, '2025-03-07 17:59:25'),
(126, 17, 338, '', 1, NULL, '2025-03-07 17:59:25'),
(127, 17, 339, '', 1, NULL, '2025-03-07 17:59:25'),
(128, 17, 340, '', 1, NULL, '2025-03-07 17:59:25'),
(129, 17, 60, 'ปลั๊กโรล และปลั๊ก 3 ตา', 1, NULL, '2025-03-07 17:59:25'),
(130, 17, 343, '', 1, NULL, '2025-03-07 17:59:25'),
(131, 17, 344, '', 1, NULL, '2025-03-07 17:59:25'),
(132, 18, 360, '', 1, NULL, '2025-03-12 15:56:18'),
(133, 19, 362, '', 1, NULL, '2025-03-12 17:36:59'),
(134, 19, 19, '', 1, NULL, '2025-03-12 17:36:59'),
(135, 20, 38, 'ตู้กาชาปองที่แร็ปงานเดอร์มาติก', 1, NULL, '2025-03-13 10:48:34'),
(136, 20, 19, '', 1, NULL, '2025-03-13 10:48:34'),
(137, 20, 20, '', 1, NULL, '2025-03-13 10:48:34'),
(138, 20, 337, '', 1, NULL, '2025-03-13 10:48:34'),
(139, 20, 341, '', 1, NULL, '2025-03-13 10:48:34'),
(140, 20, 342, '', 1, NULL, '2025-03-13 10:48:34'),
(141, 20, 336, '', 1, NULL, '2025-03-13 10:48:34'),
(142, 20, 41, '', 1, NULL, '2025-03-13 10:48:34'),
(143, 20, 338, '', 1, NULL, '2025-03-13 10:48:34'),
(144, 20, 339, '', 1, NULL, '2025-03-13 10:48:34'),
(145, 20, 340, '', 1, NULL, '2025-03-13 10:48:34'),
(146, 20, 60, 'ปลั๊กสามตา และปลั๊กโรลนะคะ 2 อย่าง', 1, NULL, '2025-03-13 10:48:34'),
(147, 20, 343, '', 1, NULL, '2025-03-13 10:48:34'),
(148, 20, 344, '', 1, NULL, '2025-03-13 10:48:34'),
(149, 21, 62, 'จำนวน 6 ใบ', 1, NULL, '2025-03-13 14:31:31'),
(150, 22, 365, '', 1, NULL, '2025-03-14 11:58:54'),
(151, 22, 367, '', 1, NULL, '2025-03-14 11:58:54'),
(152, 22, 366, '', 1, NULL, '2025-03-14 11:58:54'),
(153, 22, 336, '', 1, NULL, '2025-03-14 11:58:54'),
(154, 22, 19, '', 1, NULL, '2025-03-14 11:58:54'),
(155, 22, 40, '', 1, NULL, '2025-03-14 11:58:54'),
(156, 22, 7, '', 1, NULL, '2025-03-14 11:58:54'),
(157, 22, 60, '', 1, NULL, '2025-03-14 11:58:54'),
(158, 23, 369, '', 1, NULL, '2025-03-17 15:22:51'),
(159, 24, 3, '', 1, '2025-03-18 13:34:08', '2025-03-18 13:30:44'),
(160, 24, 19, '', 1, '2025-03-18 13:34:08', '2025-03-18 13:30:44'),
(161, 24, 104, '', 1, '2025-03-18 13:34:08', '2025-03-18 13:30:44'),
(162, 24, 46, '', 1, '2025-03-18 13:34:08', '2025-03-18 13:30:44'),
(163, 25, 38, 'ตู้กาชาปองที่แร็ปงานเดอร์มาติก', 1, NULL, '2025-03-18 18:09:13'),
(164, 25, 19, '', 1, NULL, '2025-03-18 18:09:13'),
(165, 25, 20, '', 1, NULL, '2025-03-18 18:09:14'),
(166, 25, 337, '', 1, NULL, '2025-03-18 18:09:14'),
(167, 25, 341, '', 1, NULL, '2025-03-18 18:09:14'),
(168, 25, 342, '', 1, NULL, '2025-03-18 18:09:14'),
(169, 25, 336, '', 1, NULL, '2025-03-18 18:09:14'),
(170, 25, 41, '4 ตัว', 1, NULL, '2025-03-18 18:09:14'),
(171, 25, 338, '', 1, NULL, '2025-03-18 18:09:14'),
(172, 25, 339, '', 1, NULL, '2025-03-18 18:09:14'),
(173, 25, 340, '', 1, NULL, '2025-03-18 18:09:14'),
(174, 25, 60, '', 1, NULL, '2025-03-18 18:09:14'),
(175, 25, 343, '', 1, NULL, '2025-03-18 18:09:15'),
(176, 25, 344, '', 1, NULL, '2025-03-18 18:09:15'),
(177, 26, 62, 'จำนวน 4 ใบ', 1, NULL, '2025-03-19 15:25:21'),
(178, 27, 110, 'Stand TV แรปสติกเกอร์สีเขียว Garnier', 1, NULL, '2025-03-19 21:15:05'),
(179, 27, 63, '', 1, NULL, '2025-03-19 21:15:05'),
(180, 27, 58, 'ลัง Power Plug', 1, NULL, '2025-03-19 21:15:05'),
(181, 27, 19, 'ลำโพงล้อลากตัวใหญ่', 1, NULL, '2025-03-19 21:15:05'),
(182, 27, 41, '', 1, NULL, '2025-03-19 21:15:05'),
(183, 27, 61, '2 ดวง พร้อมสายไฟ', 1, NULL, '2025-03-19 21:15:05'),
(184, 28, 365, '', 1, NULL, '2025-03-19 21:20:32'),
(185, 28, 366, '', 1, NULL, '2025-03-19 21:20:32'),
(186, 28, 7, 'TV ของลูกค้าจ้อบดีบี', 1, NULL, '2025-03-19 21:20:32'),
(187, 28, 40, '', 1, NULL, '2025-03-19 21:20:32'),
(188, 28, 336, 'พรมดำ 2 ผืน', 1, NULL, '2025-03-19 21:20:32'),
(189, 28, 60, '', 1, NULL, '2025-03-19 21:20:32'),
(190, 28, 19, '', 1, NULL, '2025-03-19 21:20:32'),
(191, 29, 372, '', 1, NULL, '2025-03-19 21:22:09'),
(192, 29, 374, '', 1, NULL, '2025-03-19 21:22:09'),
(193, 29, 373, '', 1, NULL, '2025-03-19 21:22:09'),
(194, 29, 336, '1 ผืน', 1, NULL, '2025-03-19 21:22:09'),
(195, 29, 60, '', 1, NULL, '2025-03-19 21:22:09'),
(196, 30, 41, '2 ตัว', 1, NULL, '2025-03-20 14:47:52'),
(197, 30, 60, 'ปลั๊ก 3 ตา และปลั๊กโรล', 1, NULL, '2025-03-20 14:47:52'),
(198, 31, 41, '2 ตัว', 1, NULL, '2025-03-20 14:51:49'),
(199, 31, 60, 'ปลั๊ก 3 ตา / ปลั๊กโรล', 1, NULL, '2025-03-20 14:51:49'),
(200, 31, 19, '', 1, NULL, '2025-03-20 14:51:49'),
(201, 31, 20, '', 1, NULL, '2025-03-20 14:51:49'),
(202, 31, 336, 'ของงานการ์นิเย่เมน ที่ไปออกต่างจังหวัดค่ะ', 1, NULL, '2025-03-20 14:51:49'),
(203, 32, 375, '1 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(204, 32, 376, '1 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(205, 32, 377, '1 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(206, 32, 378, '1 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(207, 32, 379, '1 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(208, 32, 369, 'ของจะไปที่โกดังสาทรส่งวันศุกร์ที่ 21', 1, NULL, '2025-03-20 15:04:06'),
(209, 32, 371, '1 ชุด', 1, NULL, '2025-03-20 15:04:06'),
(210, 32, 380, '3 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(211, 32, 62, '6 ใบ ติดสติ๊กเกอร์หน้า-หลัง', 1, NULL, '2025-03-20 15:04:06'),
(212, 32, 381, '6 ใบ', 1, NULL, '2025-03-20 15:04:06'),
(213, 32, 382, '', 1, NULL, '2025-03-20 15:04:06'),
(214, 32, 383, '20 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(215, 32, 384, '2 ชิ้น', 1, NULL, '2025-03-20 15:04:06'),
(216, 32, 60, 'ปลั๊กโรล 1 อัน', 1, NULL, '2025-03-20 15:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_remark`
--

CREATE TABLE `borrow_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `date` date NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(9, 7, 14, '2025-02-21', '-', 2, '2025-02-21 10:34:47'),
(10, 7, 14, '2025-02-24', '-', 3, '2025-02-25 09:40:31'),
(11, 6, 14, '2025-02-28', '-', 3, '2025-02-28 11:11:31'),
(12, 6, 16, '2025-02-28', '-', 3, '2025-02-28 11:12:55'),
(13, 9, 14, '2025-03-05', '-', 2, '2025-03-05 11:38:24'),
(14, 16, 14, '2025-03-06', '1', 2, '2025-03-06 18:30:36'),
(15, 9, 14, '2025-03-06', '-', 3, '2025-03-06 18:31:31'),
(16, 14, 14, '2025-03-07', '-', 2, '2025-03-07 16:45:50'),
(17, 15, 14, '2025-03-07', '-', 2, '2025-03-07 16:45:59'),
(18, 16, 14, '2025-03-07', '-', 3, '2025-03-07 16:46:54'),
(19, 14, 14, '2025-03-11', '-', 3, '2025-03-11 10:37:45'),
(20, 15, 14, '2025-03-11', '-', 3, '2025-03-11 10:38:04'),
(21, 17, 14, '2025-03-11', '-', 2, '2025-03-11 10:38:18'),
(22, 17, 16, '2025-03-12', '-', 3, '2025-03-12 16:44:56'),
(23, 18, 14, '2025-03-12', '-', 2, '2025-03-12 18:03:42'),
(24, 19, 14, '2025-03-12', '-', 2, '2025-03-12 18:03:56'),
(25, 21, 14, '2025-03-13', '-Lalamove', 2, '2025-03-13 14:34:28'),
(26, 10, 16, '2025-03-14', '-', 2, '2025-03-14 11:27:55'),
(27, 22, 14, '2025-03-14', '-', 2, '2025-03-14 12:03:15'),
(28, 20, 14, '2025-03-17', '-', 2, '2025-03-17 13:35:39'),
(29, 19, 14, '2025-03-17', '-', 3, '2025-03-17 13:36:11'),
(30, 21, 14, '2025-03-17', '-', 3, '2025-03-17 13:36:27'),
(31, 22, 14, '2025-03-17', '-', 3, '2025-03-17 16:37:37'),
(32, 23, 14, '2025-03-17', 'ฒร 5691', 2, '2025-03-17 16:38:12'),
(33, 10, 16, '2025-03-18', '-', 3, '2025-03-18 10:40:01'),
(34, 11, 16, '2025-03-18', '-', 2, '2025-03-18 10:40:55'),
(35, 20, 14, '2025-03-18', '-', 3, '2025-03-18 18:28:55'),
(36, 26, 14, '2025-03-19', 'Lalamove', 2, '2025-03-19 17:49:51'),
(37, 27, 14, '2025-03-20', '-', 2, '2025-03-20 11:45:56'),
(38, 24, 14, '2025-03-20', '-', 2, '2025-03-20 12:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_request`
--

CREATE TABLE `borrow_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `date` date NOT NULL,
  `event_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `event_start` date NOT NULL,
  `event_end` date NOT NULL,
  `event_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sale` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location_start` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location_end` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(6, 'b8900de2-ef46-11ef-852d-2ad6c30b0fff', 6, 8, '2025-02-21', '24/02/2025 - 25/02/2025', '2025-02-24', '2025-02-25', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนศึกษานารีวิทยา - โรงเรียนมัธยมวัดสิงห์', 'ออกบูธ Garnier Men วันที่ 24/02/2568 - 25/02/2568', 3, '2025-02-28 11:12:55', '2025-02-20 04:54:09'),
(7, 'a891c57f-ef62-11ef-852d-2ad6c30b0fff', 7, 8, '2025-02-22', '24/02/2025 - 24/02/2025', '2025-02-24', '2025-02-24', 'Gaenier Men', 'เก๋', 'โกดังสาทร', 'โรงเรียนวัดเขียนเขต', 'ออกบูธ Garnier Men กทม ทีม2', 3, '2025-02-25 09:40:31', '2025-02-20 08:14:08'),
(8, 'e71d17f4-ef6f-11ef-852d-2ad6c30b0fff', 8, 5, '2025-02-20', '20/02/2025 - 20/02/2025', '2025-02-20', '2025-02-20', 'test', 'test', 'test', 'test', 'test', 4, '2025-02-20 13:37:02', '2025-02-20 09:48:56'),
(9, '832918ee-f7df-11ef-af74-2ad6c30b0fff', 9, 7, '2025-03-05', '06/03/2025 - 06/03/2025', '2025-03-06', '2025-03-06', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'ม.เกษตรศาสตร์บางเขน', 'เพื่อออกบูธงานเดอร์มาติก\r\n\r\n1. กล่องใส่อะคริลิก (ตามรูปในใบขึ้นของ)\r\n2. กล่องใส่ลูกกาชาปอง 1 (ตามรูปในใบขึ้นของ)\r\n3. กล่องใส่ลูกกาชาปอง 2 (ตามรูปในใบขึ้นของ)\r\n4. กล่องพลาสติกสีเทา  (ตามรูปในใบขึ้นของ)\r\n5. แฮนพร้อพ  (ตามรูปในใบขึ้นของ)\r\n6. ถุงดำใส่ลูกกาชาปอง  (ตามรูปในใบขึ้นของ)\r\n7. บับเบิ้ล 2 \r\n8. แร็ปใส 2 \r\n9. ผ้าคลุมถุงทราย\r\n10. ถุงทราย 4 กระสอบ\r\n11. ผ้าดำคลุมของ\r\n12. โต๊ะหน้าขาว\r\n13. ไม้กวาด', 3, '2025-03-06 18:31:31', '2025-03-03 10:28:02'),
(10, 'adf7e663-f979-11ef-af74-2ad6c30b0fff', 10, 9, '2025-03-14', '17/03/2025 - 17/03/2025', '2025-03-17', '2025-03-17', 'Troop Event_Lotte Xylitol Day 1', 'พี่เก๋', 'โกดังสาธร Belink', 'BTS ศาลาแดง', 'จัดงาน 7.00-19.00', 3, '2025-03-18 10:40:01', '2025-03-05 11:24:07'),
(11, '04948be5-f97a-11ef-af74-2ad6c30b0fff', 11, 9, '2025-03-18', '19/03/2025 - 19/03/2025', '2025-03-19', '2025-03-19', 'Troop Event_Lotte Xylitol Day 2', 'พี่เก๋', 'โกดังสาธร Belink', 'BTS ช่องนนทรี', 'จัดงาน 7.00-19.00', 2, '2025-03-18 10:40:55', '2025-03-05 11:26:32'),
(12, '5764a755-f97a-11ef-af74-2ad6c30b0fff', 12, 9, '2025-03-21', '22/03/2025 - 22/03/2025', '2025-03-22', '2025-03-22', 'Troop Event_Lotte Xylitol Day 3', 'พี่เก๋', 'โกดังสาธร Belink', 'BTS สยาม', 'จัดงาน 7.00-19.00', 1, '2025-03-05 11:32:37', '2025-03-05 11:28:51'),
(13, 'bdf7d287-f97a-11ef-af74-2ad6c30b0fff', 13, 9, '2025-03-24', '25/03/2025 - 25/03/2025', '2025-03-25', '2025-03-25', 'Troop Event_Lotte Xylitol Day 4', 'พี่เก๋', 'โกดังสาธร Belink', 'MRT เพชรบุรี', 'จัดงาน 7.00-19.00', 1, NULL, '2025-03-05 11:31:44'),
(14, 'a4b45e30-f9a9-11ef-af74-2ad6c30b0fff', 14, 8, '2025-03-07', '08/03/2025 - 08/03/2025', '2025-03-08', '2025-03-08', 'Dutchmill 4in1', 'เก๋', 'โกดังสาทร', 'สยามสแควร์ ซอย10', 'Booth Event_Dutchmill 4in1 สยามสแควร์ ซอย10\r\nรายการเพิ่มเติม\r\nรถเข็น 2 อัน\r\nบับเบิ้ล 1 อัน\r\nแรปพลาสติก 1 อัน\r\nเทปพรม 1 ม้วน\r\nคัดเตอร์ + กรรไกร 1 อัน', 3, '2025-03-11 10:37:45', '2025-03-05 17:07:27'),
(15, '6d153b96-fa36-11ef-af74-2ad6c30b0fff', 15, 8, '2025-03-07', '08/03/2025 - 08/03/2025', '2025-03-08', '2025-03-08', 'Dutchmill 4in1', 'เก๋', 'โกดังสาทร', 'สยามสแควร์ ซอย10', 'Booth Event_Dutchmill 4in1 สยามสแควร์ ซอย10', 3, '2025-03-11 10:38:04', '2025-03-06 09:55:13'),
(16, '4ff87032-fa72-11ef-af74-2ad6c30b0fff', 16, 8, '2025-03-06', '07/03/2025 - 07/03/2025', '2025-03-07', '2025-03-07', 'งานภายใน บริษัท บีลิงค์ มีเดีย จำกัด', '-', 'โกดังสาทร', 'บริษัท บีลิงค์ มีเดีย จำกัด', 'งานภายใน บริษัท บีลิงค์ มีเดีย จำกัด', 3, '2025-03-07 16:46:54', '2025-03-06 17:03:54'),
(17, '3bcf0eeb-fb43-11ef-af74-2ad6c30b0fff', 17, 7, '2025-03-11', '12/03/2025 - 12/03/2025', '2025-03-12', '2025-03-12', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'ม.ศรีนครินทราวิโรฒ', 'เพื่อออกบูธงานเดอร์มาติก\r\n\r\n1. กล่องใส่อะคริลิก (ตามรูปในใบขึ้นของ)\r\n2. กล่องใส่ลูกกาชาปอง 1 (ตามรูปในใบขึ้นของ)\r\n3. กล่องใส่ลูกกาชาปอง 2 (ตามรูปในใบขึ้นของ)\r\n4. กล่องพลาสติกสีเทา (ตามรูปในใบขึ้นของ)\r\n5. แฮนพร้อพ (ตามรูปในใบขึ้นของ)\r\n6. ถุงดำใส่ลูกกาชาปอง (ตามรูปในใบขึ้นของ)\r\n7. บับเบิ้ล 2\r\n8. แร็ปใส 2\r\n9. ผ้าคลุมถุงทราย\r\n10. ถุงทราย 4 กระสอบ\r\n11. ผ้าดำคลุมของ\r\n12. โต๊ะหน้าขาว\r\n13. ไม้กวาด', 3, '2025-03-12 16:44:56', '2025-03-07 17:59:25'),
(18, 'dcd6a724-ff1f-11ef-af74-2ad6c30b0fff', 18, 8, '2025-03-12', '14/03/2025 - 16/03/2025', '2025-03-14', '2025-03-16', 'Dutchmill 4in1', 'เก๋', 'โกดังสาทร', 'อิมแพ็ค อารีน่า', 'ลูกค้ายืมใช้งาน', 2, '2025-03-12 18:03:42', '2025-03-12 15:56:18'),
(19, 'ed52653e-ff2d-11ef-af74-2ad6c30b0fff', 19, 10, '2025-03-12', '12/03/2025 - 12/03/2025', '2025-03-12', '2025-03-12', 'Garnier UV', 'เก๋', 'โกดังสาธร', 'อิมแพ็ค เมืองทอง', 'จัดตั้งบูธการ์นิเย่', 3, '2025-03-17 13:36:11', '2025-03-12 17:36:59'),
(20, '09bf5153-ffbe-11ef-af74-2ad6c30b0fff', 20, 7, '2025-03-17', '18/03/2025 - 18/03/2025', '2025-03-18', '2025-03-18', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'ม.มหิดล ศาลายา', 'เพื่อออกบูธงานเดอร์มาติก\r\n\r\n1. กล่องใส่อะคริลิก (ตามรูปในใบขึ้นของ)\r\n2. กล่องใส่ลูกกาชาปอง 1 (ตามรูปในใบขึ้นของ)\r\n3. กล่องใส่ลูกกาชาปอง 2 (ตามรูปในใบขึ้นของ)\r\n4. กล่องพลาสติกสีเทา (ตามรูปในใบขึ้นของ)\r\n5. แฮนพร้อพ (ตามรูปในใบขึ้นของ)\r\n6. ถุงดำใส่ลูกกาชาปอง (ตามรูปในใบขึ้นของ)\r\n7. บับเบิ้ล 3\r\n8. แร็ปใส 3\r\n9. ผ้าคลุมถุงทราย\r\n10. ถุงทราย 4 กระสอบ\r\n11. ผ้าดำคลุมของ\r\n12. โต๊ะหน้าขาว\r\n13. ไม้กวาด\r\n14. รถเข็น 2 คัน', 3, '2025-03-18 18:24:22', '2025-03-13 10:48:34'),
(21, '2ee50238-ffdd-11ef-af74-2ad6c30b0fff', 21, 10, '2025-03-12', '14/03/2025 - 16/03/2025', '2025-03-14', '2025-03-16', 'Garnier UV', 'เก๋', 'โกดังสาธร', 'อิมแพ็ค เมืองทอง', 'จัดบูธกานิเย่ยูวี', 3, '2025-03-17 13:36:27', '2025-03-13 14:31:31'),
(22, '076a5be8-0091-11f0-af74-2ad6c30b0fff', 22, 12, '2025-03-14', '17/03/2025 - 17/03/2025', '2025-03-17', '2025-03-17', 'jobsDB', 'บุ๋น', 'โกดังสาทร', 'ม..ศรีนครินทร์วิโรฒ (อโศก)', 'เบิกของจัดงาน วันที่ 17/3/68', 3, '2025-03-17 16:37:37', '2025-03-14 11:58:54'),
(23, '049c3514-0309-11f0-af74-2ad6c30b0fff', 23, 8, '2025-03-17', '17/03/2025 - 17/03/2025', '2025-03-17', '2025-03-17', 'Garnier UV', 'เก๋', 'โกดังสาทร', 'บริษัท ฟร้อนท์ไนน์ จำกัด', 'ส่งซ่อมโครงสร้าง Garnier UV', 2, '2025-03-17 16:38:12', '2025-03-17 15:22:51'),
(24, '854c7e28-03c2-11f0-af74-2ad6c30b0fff', 24, 9, '1970-01-01', '25/03/2025 - 25/03/2025', '2025-03-25', '2025-03-25', 'Garnier UV - โรงงาน', 'พี่เก๋', 'โกดังสาธร Belink', 'Garnier UV - โรงงาน', 'ซ่อมสีเปลี่ยน AW ก่อนใช้งาน', 2, '2025-03-20 12:24:58', '2025-03-18 13:30:44'),
(25, '37d76214-03e9-11f0-af74-2ad6c30b0fff', 25, 7, '2025-03-21', '23/03/2025 - 23/03/2025', '2025-03-23', '2025-03-23', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'Center Point of Siam Square', 'เพื่อออกบูธงานเดอร์มาติก\r\n\r\n1. กล่องใส่อะคริลิก (ตามรูปในใบขึ้นของ)\r\n2. กล่องใส่ลูกกาชาปอง 1 (ตามรูปในใบขึ้นของ)\r\n3. กล่องใส่ลูกกาชาปอง 2 (ตามรูปในใบขึ้นของ)\r\n4. กล่องพลาสติกสีเทา (ตามรูปในใบขึ้นของ)\r\n5. แฮนพร้อพ (ตามรูปในใบขึ้นของ)\r\n6. ถุงดำใส่ลูกกาชาปอง (ตามรูปในใบขึ้นของ)\r\n7. บับเบิ้ล 3\r\n8. แร็ปใส 3\r\n9. ผ้าคลุมถุงทราย\r\n10. ถุงทราย 4 กระสอบ\r\n11. ผ้าดำคลุมของ\r\n12. โต๊ะหน้าขาว\r\n13. ไม้กวาด\r\n14. รถเข็น 2 คัน\r\n15. เต๊น ผ้าเต๊น+ขาเต๊น เอาอันเดิมที่เคยใช้งานเดอร์มาติก', 1, NULL, '2025-03-18 18:07:44'),
(26, 'b28ac9a4-049b-11f0-a87c-2ad6c30b0fff', 26, 10, '2025-03-19', '19/03/2025 - 19/03/2025', '2025-03-19', '2025-03-19', 'Garnier UV  BK', 'พี่เก๋', 'โกดังสาธร', 'ONE Bangkok', 'จัดงาน การ์นิเย่ยูวี ONE BK', 2, '2025-03-19 17:49:51', '2025-03-19 15:25:21'),
(27, '8e64a286-04cc-11f0-a87c-2ad6c30b0fff', 27, 11, '2025-03-19', '19/03/2025 - 05/05/2025', '2025-03-19', '2025-05-05', 'Garnier Salon Booth', 'พี่เก๋', 'โกดังสาธร', 'โกดังวงเวียนใหญ่', 'เบิกใช้งาน', 2, '2025-03-20 11:45:56', '2025-03-19 21:15:05'),
(28, '51553294-04cd-11f0-a87c-2ad6c30b0fff', 28, 12, '2025-03-21', '24/03/2025 - 24/03/2025', '2025-03-24', '2025-03-24', 'jobsDB', 'บุ๋น', 'โกดังสาทร', 'ม.หอการค้าไทย', 'เบิกของจัดกิจกรรม', 1, NULL, '2025-03-19 21:20:32'),
(29, '8b447359-04cd-11f0-a87c-2ad6c30b0fff', 29, 12, '2025-03-21', '24/03/2025 - 24/03/2025', '2025-03-24', '2025-03-24', 'jobsDB', 'บุ๋น', 'โกดังสาทร', 'ม.พระจอมเกล้าธนบุรี', 'เบิกของจัดงานสบูธเล็ก ของจ้อบดีบี', 1, NULL, '2025-03-19 21:22:09'),
(30, 'a0aa08dd-055f-11f0-a87c-2ad6c30b0fff', 30, 7, '2025-03-20', '21/03/2025 - 25/03/2025', '2025-03-21', '2025-03-25', 'MU Hail Night มหิดล', 'พี่เก๋', 'โกดังสาทร', 'ม.มหิดล ศาลายา', 'เพื่อออกบูธ\r\nส่วนของอื่นๆตามใบขึ้นของเลยนะคะ\r\nเพราะส่วนใหญ่เป็นของลูกค้าทั้งหมดค่ะ', 1, NULL, '2025-03-20 14:47:52'),
(31, '2e1faaf0-0560-11f0-a87c-2ad6c30b0fff', 31, 7, '2025-03-20', '20/03/2025 - 25/03/2025', '2025-03-20', '2025-03-25', 'CEO Festival', 'พี่เก๋', 'โกดังสาทร', 'Center Point of Siam Square', 'เพื่อออกบูธ', 1, NULL, '2025-03-20 14:51:49'),
(32, 'e57fba48-0561-11f0-a87c-2ad6c30b0fff', 32, 8, '2025-03-21', '24/03/2025 - 24/03/2025', '2025-03-24', '2025-03-24', 'Garnier UV Roadshow', 'เก๋', 'โกดังสาทร', 'มหาวิทยาลัยมหิดล', 'งาน Garnier UV Roadshow มหาวิทยาลัยมหิดล\r\nรายการของที่ไม่มีในระบบ\r\n1.แท่นอะคริลิก A5 2 ชิ้น\r\n2.ป้ายสแกนคิวอาร์โค้ด 5 ชิ้น\r\n3.บับเบิ้ล 1 อัน\r\n4.แรปพลาสติก 1 อัน\r\n5.คัดเตอร์  1 อัน\r\n6.กรรไกร 1 อัน\r\n7.รถเข็น 1 อัน', 1, NULL, '2025-03-20 15:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `login_id` int DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `uuid`, `code`, `name`, `contact`, `status`, `login_id`, `updated`, `created`) VALUES
(1, '1dc7d3c1-000d-11f0-9259-0242ac120005', 'C.I-0001', 'IT-Smile-reeycle', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(2, '1dc80e3d-000d-11f0-9259-0242ac120005', 'C.L-001', 'Linkworld International Limited', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(3, '1dc8888b-000d-11f0-9259-0242ac120005', 'C.U-001', 'Unilever Asia Private Limited', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(4, '1dc8c7cf-000d-11f0-9259-0242ac120005', 'K-อ-0002', 'อัครวัชร คงสิริกาญจน์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(5, '1dc909a0-000d-11f0-9259-0242ac120005', 'K-อ-0003', 'อังคณา เอื้ออมรรัตน์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(6, '1dc94aaa-000d-11f0-9259-0242ac120005', 'K.ธ-0001', 'ธนพัต รัตนศิริวิไล', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(7, '1dc98d5a-000d-11f0-9259-0242ac120005', 'K.ธ-0002', 'ธนชัย ถนอมทรัพย์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(8, '1dc9ce58-000d-11f0-9259-0242ac120005', 'K.พ-0001', 'พุฒิพัฒน์ นิชาปรีดีพัทธ์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(9, '1dca15b1-000d-11f0-9259-0242ac120005', 'K.ย-0001', 'ยุรนันท์ โสดากุล', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(10, '1dca5b6f-000d-11f0-9259-0242ac120005', 'K.ย-0002', 'วิภารัตน์  อู่ทรัพย์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(11, '1dcabe12-000d-11f0-9259-0242ac120005', 'K.ส-0001', 'สมพงษ์ กระมล', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(12, '1dcaf2df-000d-11f0-9259-0242ac120005', 'U.T-M001', 'Micro-Star International Co.,Ltd', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(13, '1dcb303f-000d-11f0-9259-0242ac120005', 'บ.ค-0005', 'คาราท (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(14, '1dcb6678-000d-11f0-9259-0242ac120005', 'บ.ค-0015', 'คอนเซ็ปต์ 101 จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(15, '1dcba1c7-000d-11f0-9259-0242ac120005', 'บ.ค-0016', 'คอมเซเว่น จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(16, '1dcbd601-000d-11f0-9259-0242ac120005', 'บ.ง-0001', 'งามดีคอตตอน จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(17, '1dcc117f-000d-11f0-9259-0242ac120005', 'บ.จ-0003', 'จัดหางาน จ๊อบส์ ดีบี (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(18, '1dcc4ac8-000d-11f0-9259-0242ac120005', 'บ.จ-0005', 'จาโกต้า บราเดอร์ส เทรดดิ้ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(19, '1dcc83c2-000d-11f0-9259-0242ac120005', 'บ.ช-0002', 'ชามเอก จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(20, '1dccc57d-000d-11f0-9259-0242ac120005', 'บ.ซ-0001', 'ซากุระโปรดัคส์ (ไทยแลนด์) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(21, '1dcd0995-000d-11f0-9259-0242ac120005', 'บ.ซ-0005', 'ซันโทรี่ เป๊ปซี่โค เบเวอเรจ (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(22, '1dcd645e-000d-11f0-9259-0242ac120005', 'บ.ซ-0006', 'ซัน รีชเชอร์ส จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(23, '1dcd9dc5-000d-11f0-9259-0242ac120005', 'บ.ซ-0008', 'ซันโทรี่ เบเวอเรจ แอนด์ ฟู้ด (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(24, '1dcdd753-000d-11f0-9259-0242ac120005', 'บ.ซ-0009', 'ไซมิส แอสเสท จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(25, '1dce11bd-000d-11f0-9259-0242ac120005', 'บ.ซ-0011', 'เซเว่นเดย์ ซัคเซส จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(26, '1dce5118-000d-11f0-9259-0242ac120005', 'บ.ซ-0012', 'ซี.พี.คอนซูเมอร์โพรดักส์  จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(27, '1dce8bd6-000d-11f0-9259-0242ac120005', 'บ.ซ-0013', 'แซนด์-เอ็ม โกลบอล จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(28, '1dcec88a-000d-11f0-9259-0242ac120005', 'บ.ด-0001', 'เดนท์สุ คอนซัลติ้ง กรุ๊ป (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(29, '1dceff4e-000d-11f0-9259-0242ac120005', 'บ.ด-0002', 'แดรี่ พลัส จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(30, '1dcf3aef-000d-11f0-9259-0242ac120005', 'บ.ด-0005', 'ดับบลิวพีพี (ประเทศไทย) จำกัด - มายด์แชร์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(31, '1dcf7a2e-000d-11f0-9259-0242ac120005', 'บ.ด-0006', 'ดับบลิวพีพี (ประเทศไทย) จำกัด - มีเดียคอม', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(32, '1dcfcbdb-000d-11f0-9259-0242ac120005', 'บ.ด-0007', 'ดีเอ็กซ์ พาเลท (ประเทศไทย)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(33, '1dd04029-000d-11f0-9259-0242ac120005', 'บ.ด-0008', 'ดีเอ็กซ์ คิวบิค (ประเทศไทย)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(34, '1dd07a4c-000d-11f0-9259-0242ac120005', 'บ.ด-0009', 'ดีเอ็กซ์ แมทริกซ์ (ประเทศไทย)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(35, '1dd0b9e5-000d-11f0-9259-0242ac120005', 'บ.ด-0011', 'ดาต้า เฟิร์ส จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(36, '1dd0f103-000d-11f0-9259-0242ac120005', 'บ.ด-0012', 'ดัชมิลล์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(37, '1dd1320a-000d-11f0-9259-0242ac120005', 'บ.ด-0014', 'ดับบลิวพีพี (ประเทศไทย) จำกัด - เวฟเมกเกอร์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(38, '1dd16cfd-000d-11f0-9259-0242ac120005', 'บ.ด-0015', 'ดริ๊งค์ เอนเตอร์ไพรส์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(39, '1dd1a700-000d-11f0-9259-0242ac120005', 'บ.ด-0016', 'เดนท์สุ โซลูชั่นส์ กรุ๊ป (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(40, '1dd1e88c-000d-11f0-9259-0242ac120005', 'บ.ด-0017', 'ดานอน สเปเชียลไลซ์ นิวทริชั่น (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(41, '1dd225f6-000d-11f0-9259-0242ac120005', 'บ.ด-0018', 'ดับบลิวพีพี (ประเทศไทย) จำกัด - เอสเซ้นซ์มีเดียคอม', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(42, '1dd2631e-000d-11f0-9259-0242ac120005', 'บ.ด-0020', 'เดนท์สุ เอ็กซ์', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(43, '1dd2bc44-000d-11f0-9259-0242ac120005', 'บ.ท-0002', 'ทศภาค จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(44, '1dd2ea0d-000d-11f0-9259-0242ac120005', 'บ.ท-0007', 'ทียู พร๊อพเพอร์ตี้ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(45, '1dd31926-000d-11f0-9259-0242ac120005', 'บ.ท-0011', 'ไทสัน โพลทรี่ (ไทยแลนด์) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(46, '1dd3489a-000d-11f0-9259-0242ac120005', 'บ.ท-0013', 'ไทสัน อินเตอร์เนชั่นแนล เอพีเอซี จำกัด (สำนักงานใหญ่)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(47, '1dd376d9-000d-11f0-9259-0242ac120005', 'บ.ท-0015', 'ทริปเปิล จี เฮ้าส์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(48, '1dd3a567-000d-11f0-9259-0242ac120005', 'บ.ท-0016', 'ไทสัน โพลทรี่ (ไทยแลนด์) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(49, '1dd3d702-000d-11f0-9259-0242ac120005', 'บ.ท-0017', 'ทิงค์เน็ต จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(50, '1dd40616-000d-11f0-9259-0242ac120005', 'บ.ธ-0001', 'ธฤดี จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(51, '1dd437e3-000d-11f0-9259-0242ac120005', 'บ.น-0003', 'นีโอ คอร์ปอเรท จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(52, '1dd4695d-000d-11f0-9259-0242ac120005', 'บ.น-0004', 'นิสสัน มอเตอร์ (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(53, '1dd49aaf-000d-11f0-9259-0242ac120005', 'บ.น-0005', 'เนคตาฟาร์มา จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(54, '1dd4e7bc-000d-11f0-9259-0242ac120005', 'บ.บ-0001', 'เบอร์ลี่ยุคเกอร์ จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(55, '1dd51baa-000d-11f0-9259-0242ac120005', 'บ.บ-0007', 'บอส พรีเมี่ยม จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(56, '1dd54f4a-000d-11f0-9259-0242ac120005', 'บ.บ-0011', 'บุญรอด เทรดดิ้ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(57, '1dd58f4e-000d-11f0-9259-0242ac120005', 'บ.บ-0013', 'บีลิงค์ พร็อพเพอร์ตี้ แอนด์ ดีเวลลอปเมนท์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(58, '1dd5c7f9-000d-11f0-9259-0242ac120005', 'บ.บ-0014', 'แบรนด์เนม มันนี่ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(59, '1dd6060d-000d-11f0-9259-0242ac120005', 'บ.บ-0015', 'บอช แอนด์ ลอมบ์ (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(60, '1dd6499a-000d-11f0-9259-0242ac120005', 'บ.ป-0001', 'ประกิต โฮลดิ้งส์ จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(61, '1dd67e8b-000d-11f0-9259-0242ac120005', 'บ.ป-0006', 'ปตท. น้ำมันและการค้าปลีก จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(62, '1dd6b0e7-000d-11f0-9259-0242ac120005', 'บ.ป-0007', 'เป๊ปซี่-โคล่า (ไทย) เทรดดิ้ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(63, '1dd6ea70-000d-11f0-9259-0242ac120005', 'บ.ป-0008', 'ปราดเปรียว จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(64, '1dd74d69-000d-11f0-9259-0242ac120005', 'บ.ป-0009', 'ประกิต แอดเวอร์ไทซิ่ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(65, '1dd78755-000d-11f0-9259-0242ac120005', 'บ.ป-0010', 'แปซิฟิก ชูการ์ คอร์ปอเรชั่น จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(66, '1dd7b811-000d-11f0-9259-0242ac120005', 'บ.ผ-0001', 'ผลิตภัณฑ์อาหารกว้างไพศาล จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(67, '1dd7f1c8-000d-11f0-9259-0242ac120005', 'บ.พ-0006', 'พรีเมียร์ มาร์เก็ตติ้ง จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(68, '1dd82101-000d-11f0-9259-0242ac120005', 'บ.ฟ-0004', 'ไฟน์ ทูเดย์ (ไทยแลนด์) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(69, '1dd85680-000d-11f0-9259-0242ac120005', 'บ.ฟ-0005', 'ฟาร์อีสท์ เฟมไลน์ ดีดีบี จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(70, '1dd88ddc-000d-11f0-9259-0242ac120005', 'บ.ม-0001', 'มีเดียอินเทลลิเจนซ์กรุ๊ป จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(71, '1dd8c5b2-000d-11f0-9259-0242ac120005', 'บ.ม-0001-1', 'มีเดียอินเทลลิเจนซ์กรุ๊ป จำกัด.', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(72, '1dd8f513-000d-11f0-9259-0242ac120005', 'บ.ม-0009', 'เมก้า เอ็ดดูเทค จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(73, '1dd928be-000d-11f0-9259-0242ac120005', 'บ.ย-0001', 'ยูนิลีเวอร์ ไทย เทรดดิ้ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(74, '1dd97c3f-000d-11f0-9259-0242ac120005', 'บ.ย-0002', 'ยัมมิกซ์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(75, '1dd9b58c-000d-11f0-9259-0242ac120005', 'บ.ร-0003', 'โรห์โต้-เมนโทลาทั่ม (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(76, '1dd9ed86-000d-11f0-9259-0242ac120005', 'บ.ล-0007', 'ลอตเตอรี่พลัส จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(77, '1dda2648-000d-11f0-9259-0242ac120005', 'บ.ล-0008', 'ลอรีอัล (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(78, '1dda610e-000d-11f0-9259-0242ac120005', 'บ.ว-0001', 'เวอริซายน์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(79, '1dda9e3d-000d-11f0-9259-0242ac120005', 'บ.ว-0005', 'วรรณสรณ์ เอ็ดดูเคชั่น จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(80, '1ddad713-000d-11f0-9259-0242ac120005', 'บ.ว-0006', 'ไวส์ เอสเตท 10 จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(81, '1ddb0dd3-000d-11f0-9259-0242ac120005', 'บ.ว-0009', 'ไวส์ เอสเตท 17 จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(82, '1ddb454c-000d-11f0-9259-0242ac120005', 'บ.ส-0012', 'สหพัฒนพิบูล จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(83, '1ddb7cc4-000d-11f0-9259-0242ac120005', 'บ.ส-0013', 'สมาร์ทแมทโปร จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(84, '1ddbb01b-000d-11f0-9259-0242ac120005', 'บ.ส-0014', 'สกิน ลาบอราทอรี่ จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(85, '1ddc0c72-000d-11f0-9259-0242ac120005', 'บ.ส-0015', 'สมายด์ เอ็ดดูเคชั่น จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(86, '1ddc3d58-000d-11f0-9259-0242ac120005', 'บ.ห-0002', 'ห้างเซ็นทรัล ดีพาทเมนท์สโตร์ จำกัด (สาขาสำนักงานใหญ่ ชิดลม)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(87, '1ddc6e38-000d-11f0-9259-0242ac120005', 'บ.อ-0001', 'ออคโทพุส แอดเวอร์ไทซิ่ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(88, '1ddc9c11-000d-11f0-9259-0242ac120005', 'บ.อ-0003', 'อิชิตัน กรุ๊ป จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(89, '1ddcc9f0-000d-11f0-9259-0242ac120005', 'บ.อ-0004', 'ไอพีจี แอดเวอไทซิ่ง(ประเทศไทย)จำกัด สาขาไอพีจี มีเดียแบรนด์ส', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(90, '1ddcf7ba-000d-11f0-9259-0242ac120005', 'บ.อ-0005', 'ออพติมัม มีเดีย ไดเรคชั่น (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(91, '1ddd2f29-000d-11f0-9259-0242ac120005', 'บ.อ-0006', 'เอ็ม พิคเจอร์ส จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(92, '1ddd66b8-000d-11f0-9259-0242ac120005', 'บ.อ-0007', 'เอสเตท คิว จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(93, '1ddd9ca1-000d-11f0-9259-0242ac120005', 'บ.อ-0015', 'อาร์ติแฟคท์ ดีไซน์ กรุ๊ป จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(94, '1dddd402-000d-11f0-9259-0242ac120005', 'บ.อ-0020', 'โอสถสภา จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(95, '1dde2878-000d-11f0-9259-0242ac120005', 'บ.อ-0021', 'ไอพรอสเพค (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(96, '1dde592d-000d-11f0-9259-0242ac120005', 'บ.อ-0026', 'เอสซี แอสเสท คอร์ปอเรชั่น จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(97, '1ddf09ca-000d-11f0-9259-0242ac120005', 'บ.อ-0027', 'อาร์ติแฟคท์ ดีไซน์ กรุ๊ป (เซรามิกส์) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(98, '1ddf3dc0-000d-11f0-9259-0242ac120005', 'บ.อ-0030', 'เอฟดีจีที จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(99, '1ddf73e8-000d-11f0-9259-0242ac120005', 'บ.อ-0031', 'โออิชิ เทรดดิ้ง จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(100, '1ddfc2d5-000d-11f0-9259-0242ac120005', 'บ.อ-0032', 'เอสซี ซีดี3 จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(101, '1ddff4e1-000d-11f0-9259-0242ac120005', 'บ.อ-0033', 'เอ็ม บี เค จำกัด (มหาชน)', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(102, '1de0257f-000d-11f0-9259-0242ac120005', 'บ.อ-0034', 'เอ็มเจวี4 จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(103, '1de056bc-000d-11f0-9259-0242ac120005', 'บ.อ-0035', 'อีฟ โรเช (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(104, '1de087a4-000d-11f0-9259-0242ac120005', 'บ.อ-0036', 'เอ็มอินเตอร์แอคชั่น จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(105, '1de0b82a-000d-11f0-9259-0242ac120005', 'บ.ฮ-0006', 'แฮนดี้เฮลท์ จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(106, '1de0ea6c-000d-11f0-9259-0242ac120005', 'บ.ฮ-0007', 'ฮายัท ไฮจีนิค โปรดักส์ (ประเทศไทย) จำกัด', '', 1, NULL, NULL, '2025-03-13 20:14:38'),
(107, '1de11f2f-000d-11f0-9259-0242ac120005', 'ร.ส-0001', 'รอระบุชื่อลูกค้า', '', 1, NULL, NULL, '2025-03-13 20:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'IT', 1, '2025-03-11 20:06:24', '2025-03-11 20:03:23'),
(2, 'Finance', 1, NULL, '2025-03-11 20:03:40'),
(3, 'Account', 1, NULL, '2025-03-11 20:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_file`
--

CREATE TABLE `estimate_file` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estimate_item`
--

CREATE TABLE `estimate_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `expense_id` int NOT NULL,
  `estimate` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_item`
--

INSERT INTO `estimate_item` (`id`, `request_id`, `expense_id`, `estimate`, `status`, `updated`, `created`) VALUES
(1, 1, 5, '100000.00', 1, NULL, '2025-03-20 10:17:38'),
(2, 1, 6, '5000.00', 1, NULL, '2025-03-20 10:17:38'),
(3, 1, 9, '10000.00', 1, NULL, '2025-03-20 10:17:38'),
(4, 1, 15, '10000.00', 1, NULL, '2025-03-20 10:17:38'),
(5, 1, 14, '5000.00', 1, NULL, '2025-03-20 10:17:38'),
(6, 1, 12, '100000.00', 1, NULL, '2025-03-20 10:17:38'),
(7, 2, 5, '5000.00', 1, NULL, '2025-03-20 11:23:03'),
(8, 2, 8, '7500.00', 1, NULL, '2025-03-20 11:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_remark`
--

CREATE TABLE `estimate_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_remark`
--

INSERT INTO `estimate_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-03-20 10:17:38'),
(2, 1, 1, 'ทดสอบ BudgetABudgetABudgetABudgetA', 3, '2025-03-20 10:31:03'),
(3, 1, 1, 'แสดงผลประเภทค่าใช้จ่ายเกิดขึ้นตามจริงแต่ละครั้ง\r\nแสดงผลประเภทค่าจ้างทีมงาน จ้างเหมาทั้งโครงการ', 4, '2025-03-20 10:34:35'),
(4, 2, 2, '', 2, '2025-03-20 11:23:03'),
(5, 2, 2, '', 3, '2025-03-20 11:24:40'),
(6, 2, 2, '', 4, '2025-03-20 11:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_request`
--

CREATE TABLE `estimate_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_id` int NOT NULL,
  `doc_date` date NOT NULL,
  `order_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sales_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `budget` decimal(20,2) NOT NULL,
  `type` int NOT NULL,
  `remark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_request`
--

INSERT INTO `estimate_request` (`id`, `uuid`, `last`, `login_id`, `department_number`, `customer_id`, `doc_date`, `order_number`, `product_name`, `title_name`, `sales_name`, `budget`, `type`, `remark`, `action`, `status`, `updated`, `created`) VALUES
(1, '117ce5c9-0539-11f0-a87c-2ad6c30b0fff', 1, 1, '123', 1, '2025-03-20', 'so 45566', 'Event การไฟฟ้า', 'Event การไฟฟ้า', 'Event การไฟฟ้า', '300000.00', 1, '', 1, 4, '2025-03-20 10:34:35', '2025-03-20 10:11:51'),
(2, '948276fa-0542-11f0-a87c-2ad6c30b0fff', 2, 2, 'SO68030017', 77, '2025-03-20', 'SO68030017', 'Cerave', 'Cerave La Roche Posay', 'Hen Night Mahidol University', '33824.00', 1, '', 1, 4, '2025-03-20 11:24:58', '2025-03-20 11:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL,
  `reference` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `login_id` int DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `login_id` int NOT NULL,
  `type` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_file`
--

INSERT INTO `issue_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 2, 'd73c05a103894327bd17924f87fa7e97.pdf', 1, NULL, '2025-02-18 04:03:18'),
(2, 3, '1893ce95c2d8bf6753a6444b880d9e3e.pdf', 1, NULL, '2025-02-18 04:14:50'),
(3, 8, '03cc67379dd9bf011e85a79736458bd2.pdf', 1, NULL, '2025-02-20 07:13:46'),
(4, 10, 'ea262b3f8f2b6b9e04cd48c8b332dc73.pdf', 1, NULL, '2025-02-20 08:19:05'),
(5, 17, 'e49052ce5fc7826071339c1e743822a2.webp', 1, NULL, '2025-02-24 11:37:04'),
(6, 24, '7758a4e64eeb7c33764d910bd074bbd0.webp', 1, NULL, '2025-02-25 10:40:22'),
(7, 25, 'a06b59e2bcf6f18f9038558f367dafba.webp', 1, NULL, '2025-02-25 10:42:18'),
(8, 28, '1f130cf89c180ca3ad590a0de62df98a.webp', 1, NULL, '2025-02-25 13:12:43'),
(9, 29, '45758101add11929b6e2e61d780575d6.webp', 1, NULL, '2025-02-25 13:44:08'),
(10, 33, 'a3ddb2a47c4213f1bfcc4a14330a5d42.webp', 1, NULL, '2025-02-25 20:30:54'),
(11, 34, '39be30e538604f2e23113623fa158ce0.webp', 1, NULL, '2025-02-25 20:34:47'),
(12, 35, '8ab68f1eed98332f0dbd4d1dfee2d13d.webp', 1, NULL, '2025-02-25 20:37:38'),
(13, 36, '79fc2281bb9f301afb090775ddf18faf.webp', 1, NULL, '2025-02-25 20:39:05'),
(14, 39, '3c46cb4423ddf4afe158f6405dc2580e.pdf', 1, NULL, '2025-03-03 10:31:04'),
(15, 40, 'bc3c5a0d08c99cd9bdcb0d8a44be220d.pdf', 1, NULL, '2025-03-04 17:21:03'),
(16, 41, '652c9a0e0f34b2fd8464ccceec2fa7dd.pdf', 1, NULL, '2025-03-04 17:24:58'),
(17, 42, 'db9e8b77301c0771650cf540abaf16b0.pdf', 1, NULL, '2025-03-04 17:26:16'),
(18, 43, 'fe72ebb7c5ae0312ab6f8ff55318d58e.pdf', 1, NULL, '2025-03-04 17:27:53'),
(19, 45, 'ae18bf2832c1df90cc425dceef153ddd.pdf', 1, NULL, '2025-03-05 17:16:57'),
(20, 46, '38752b92f28fc65c0fcf619771fa3360.pdf', 1, NULL, '2025-03-06 09:52:55'),
(21, 49, '49f7e68c5a4da78bd34477bd98a8f971.webp', 1, NULL, '2025-03-11 19:00:22'),
(22, 53, 'ab8b6f07248a8cfe6387fb8f8e57b29a.pdf', 1, NULL, '2025-03-13 10:50:17'),
(23, 54, '3d570d972e8d1947bcf2d33189d5828c.webp', 1, NULL, '2025-03-13 11:30:12'),
(24, 55, '8dc849e7488f0e153b0b8158460ef154.webp', 1, NULL, '2025-03-13 11:41:59'),
(25, 64, 'f5492385f51b995eac0c703c488f0162.webp', 1, NULL, '2025-03-17 14:06:18'),
(26, 65, '5b0ea19450f0aad20a3609b04dc6c1f5.pdf', 1, NULL, '2025-03-18 10:53:49'),
(27, 66, '7ac14eebacc5b78bad9a58395840902e.pdf', 1, NULL, '2025-03-18 18:13:48'),
(28, 67, 'a603720ce1c913a9a7a73533f75692b0.pdf', 1, NULL, '2025-03-19 10:55:05'),
(29, 72, '1fae1e2ed03a51ed186c6b3813e33fca.webp', 1, NULL, '2025-03-19 18:41:02'),
(30, 72, '7a67e11d5701dfb36ab968850ccf8528.webp', 1, NULL, '2025-03-19 18:44:28'),
(31, 73, '3ca22bc477cd0069a27f735b86c5ea24.webp', 1, NULL, '2025-03-19 18:48:41'),
(32, 73, '1aa50ac2ffd4a8f94e0d8f5916bccd58.webp', 1, NULL, '2025-03-19 18:48:41'),
(33, 73, '936d9737733ed67e85e786202ddcb45e.webp', 1, NULL, '2025-03-19 18:48:41'),
(34, 74, '8bc16662f84c0bd053f6a55f8a36e19a.webp', 1, NULL, '2025-03-19 19:05:42'),
(35, 86, 'edb73c227fe6b728d9a14b72ef69a113.pdf', 1, NULL, '2025-03-20 15:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `issue_item`
--

CREATE TABLE `issue_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `product_id` int NOT NULL,
  `warehouse_id` int NOT NULL,
  `type` int NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `confirm` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_item`
--

INSERT INTO `issue_item` (`id`, `request_id`, `product_id`, `warehouse_id`, `type`, `amount`, `confirm`, `status`, `updated`, `created`) VALUES
(1, 1, 2, 1, 1, '48.00', '48.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:17'),
(2, 1, 10, 1, 1, '648.00', '648.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(3, 1, 27, 1, 1, '340.00', '340.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(4, 1, 28, 1, 1, '300.00', '300.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(5, 1, 29, 1, 1, '300.00', '300.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(6, 1, 37, 1, 1, '66.00', '66.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(7, 1, 38, 1, 1, '2592.00', '2592.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(8, 1, 39, 1, 1, '1418.00', '1418.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(9, 1, 40, 1, 1, '56.00', '56.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(10, 1, 43, 1, 1, '502.00', '502.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(11, 1, 44, 1, 1, '161.00', '161.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(12, 1, 45, 1, 1, '1300.00', '1300.00', 1, '2025-02-17 09:14:05', '2025-02-17 09:10:18'),
(13, 2, 38, 1, 2, '432.00', '432.00', 1, '2025-02-20 07:05:08', '2025-02-18 04:03:18'),
(14, 2, 39, 1, 2, '144.00', '144.00', 1, '2025-02-20 07:05:08', '2025-02-18 04:03:18'),
(15, 3, 38, 1, 2, '432.00', '432.00', 1, '2025-02-20 07:05:14', '2025-02-18 04:14:50'),
(16, 3, 39, 1, 2, '144.00', '144.00', 1, '2025-02-20 07:05:14', '2025-02-18 04:14:50'),
(17, 4, 46, 1, 1, '7.00', '7.00', 1, '2025-02-20 06:54:09', '2025-02-18 04:28:27'),
(18, 5, 47, 1, 1, '16.00', '15.00', 1, '2025-02-20 07:00:06', '2025-02-19 03:57:20'),
(19, 6, 48, 1, 1, '31.00', '32.00', 1, '2025-02-20 06:56:45', '2025-02-19 04:11:11'),
(20, 7, 52, 1, 1, '4000.00', '4000.00', 1, '2025-02-20 07:00:13', '2025-02-20 03:55:01'),
(21, 8, 38, 1, 2, '864.00', '864.00', 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(22, 8, 39, 1, 2, '288.00', '288.00', 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(23, 8, 46, 1, 2, '2.00', '2.00', 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(24, 8, 47, 1, 2, '8.00', '8.00', 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(25, 8, 48, 1, 2, '8.00', '8.00', 1, '2025-02-21 10:32:49', '2025-02-20 07:13:46'),
(26, 9, 39, 1, 2, '216.00', '216.00', 1, '2025-02-20 07:22:17', '2025-02-20 07:20:46'),
(27, 9, 38, 1, 2, '432.00', '432.00', 1, '2025-02-20 07:22:17', '2025-02-20 07:20:46'),
(28, 10, 38, 1, 2, '432.00', '432.00', 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(29, 10, 39, 1, 2, '144.00', '144.00', 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(30, 10, 46, 1, 2, '5.00', '5.00', 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(31, 10, 48, 1, 2, '23.00', '24.00', 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(32, 10, 47, 1, 2, '8.00', '7.00', 1, '2025-02-21 10:32:34', '2025-02-20 08:19:05'),
(33, 11, 58, 1, 1, '20.00', '20.00', 1, '2025-02-20 10:07:41', '2025-02-20 09:42:59'),
(34, 12, 56, 1, 1, '40.00', '40.00', 1, '2025-02-20 10:12:12', '2025-02-20 09:43:18'),
(35, 13, 57, 1, 1, '40.00', '40.00', 1, '2025-02-20 10:12:16', '2025-02-20 09:43:49'),
(36, 14, 55, 1, 1, '7.00', '7.00', 1, '2025-02-20 10:12:26', '2025-02-20 09:44:18'),
(37, 15, 54, 1, 1, '12.00', '12.00', 1, '2025-02-20 10:12:55', '2025-02-20 09:44:44'),
(38, 16, 53, 1, 1, '12.00', '12.00', 1, '2025-02-20 10:13:04', '2025-02-20 09:45:25'),
(39, 17, 59, 1, 1, '8000.00', '8000.00', 1, '2025-02-24 14:05:43', '2025-02-24 11:37:03'),
(40, 18, 61, 1, 1, '14000.00', '14000.00', 1, '2025-02-24 17:32:20', '2025-02-24 17:29:52'),
(41, 19, 62, 1, 1, '1500.00', '0.00', 1, NULL, '2025-02-24 17:31:43'),
(42, 20, 64, 1, 1, '1850.00', '1850.00', 1, '2025-02-24 17:46:08', '2025-02-24 17:38:22'),
(43, 21, 63, 1, 1, '1900.00', '1900.00', 1, '2025-02-24 17:46:17', '2025-02-24 17:39:02'),
(44, 22, 62, 1, 1, '1573.00', '1573.00', 1, '2025-02-24 18:13:56', '2025-02-24 18:12:53'),
(45, 23, 65, 1, 1, '1400.00', '1400.00', 1, '2025-02-24 22:11:36', '2025-02-24 22:10:58'),
(46, 24, 66, 1, 1, '2400.00', '2400.00', 1, '2025-02-25 13:25:36', '2025-02-25 10:40:21'),
(47, 25, 67, 1, 1, '2400.00', '2400.00', 1, '2025-02-25 13:25:43', '2025-02-25 10:42:17'),
(48, 26, 65, 1, 2, '100.00', '100.00', 1, '2025-02-25 13:22:00', '2025-02-25 11:13:36'),
(49, 26, 62, 1, 2, '100.00', '100.00', 1, '2025-02-25 13:22:00', '2025-02-25 11:13:36'),
(50, 26, 63, 1, 2, '150.00', '150.00', 1, '2025-02-25 13:22:00', '2025-02-25 11:13:36'),
(51, 26, 64, 1, 2, '100.00', '100.00', 1, '2025-02-25 13:22:00', '2025-02-25 11:13:36'),
(52, 27, 61, 1, 2, '10.00', '0.00', 1, NULL, '2025-02-25 11:17:25'),
(53, 28, 68, 1, 1, '20016.00', '20016.00', 1, '2025-02-25 13:24:52', '2025-02-25 13:12:42'),
(54, 29, 67, 1, 2, '720.00', '720.00', 1, '2025-02-25 14:00:21', '2025-02-25 13:44:08'),
(55, 29, 66, 1, 2, '720.00', '720.00', 1, '2025-02-25 14:00:21', '2025-02-25 13:44:08'),
(56, 30, 69, 1, 1, '45.00', '45.00', 1, '2025-02-26 11:53:10', '2025-02-25 16:34:28'),
(57, 31, 70, 1, 1, '76.00', '76.00', 1, '2025-02-26 11:53:00', '2025-02-25 16:37:44'),
(58, 32, 43, 1, 1, '92.00', '47.00', 1, '2025-02-26 12:06:04', '2025-02-25 16:42:38'),
(59, 32, 63, 1, 1, '229.00', '228.00', 1, '2025-02-26 12:06:04', '2025-02-25 16:42:38'),
(60, 32, 64, 1, 1, '60.00', '60.00', 1, '2025-02-26 12:06:04', '2025-02-25 16:42:38'),
(61, 32, 65, 1, 1, '39.00', '39.00', 1, '2025-02-26 12:06:04', '2025-02-25 16:42:38'),
(62, 32, 45, 1, 1, '188.00', '190.00', 1, '2025-02-26 12:06:04', '2025-02-25 16:42:38'),
(63, 33, 68, 1, 2, '4920.00', '4920.00', 1, '2025-02-26 11:42:27', '2025-02-25 20:30:54'),
(64, 34, 68, 1, 2, '6888.00', '6888.00', 1, '2025-02-26 11:42:32', '2025-02-25 20:34:47'),
(65, 35, 68, 1, 2, '5904.00', '5904.00', 1, '2025-02-26 11:42:39', '2025-02-25 20:37:38'),
(66, 36, 68, 1, 2, '1968.00', '1968.00', 1, '2025-02-26 11:42:43', '2025-02-25 20:39:05'),
(67, 37, 67, 1, 2, '144.00', '144.00', 1, '2025-02-26 16:36:12', '2025-02-26 12:44:34'),
(68, 37, 66, 1, 2, '144.00', '144.00', 1, '2025-02-26 16:36:12', '2025-02-26 12:44:34'),
(69, 38, 67, 1, 2, '192.00', '192.00', 1, '2025-02-28 11:08:53', '2025-02-27 14:50:55'),
(70, 38, 66, 1, 2, '192.00', '192.00', 1, '2025-02-28 11:08:53', '2025-02-27 14:50:55'),
(71, 39, 10, 1, 2, '100.00', '100.00', 1, '2025-03-05 11:38:40', '2025-03-03 10:31:04'),
(72, 39, 29, 1, 2, '50.00', '50.00', 1, '2025-03-05 11:38:40', '2025-03-03 10:31:04'),
(73, 39, 28, 1, 2, '50.00', '50.00', 1, '2025-03-05 11:38:40', '2025-03-03 10:31:04'),
(74, 39, 27, 1, 2, '60.00', '60.00', 1, '2025-03-05 11:38:40', '2025-03-03 10:31:04'),
(75, 40, 52, 1, 2, '1000.00', '1000.00', 1, '2025-03-14 11:28:42', '2025-03-04 17:21:03'),
(76, 40, 59, 1, 2, '2000.00', '2000.00', 1, '2025-03-14 11:28:42', '2025-03-04 17:21:03'),
(77, 41, 52, 1, 2, '1000.00', '1000.00', 1, '2025-03-18 11:36:16', '2025-03-04 17:24:58'),
(78, 41, 59, 1, 2, '2000.00', '2000.00', 1, '2025-03-18 11:36:16', '2025-03-04 17:24:58'),
(79, 42, 52, 1, 2, '1000.00', '0.00', 1, NULL, '2025-03-04 17:26:16'),
(80, 42, 59, 1, 2, '2000.00', '0.00', 1, NULL, '2025-03-04 17:26:16'),
(81, 43, 52, 1, 2, '1000.00', '0.00', 1, NULL, '2025-03-04 17:27:53'),
(82, 43, 59, 1, 2, '2000.00', '0.00', 1, NULL, '2025-03-04 17:27:53'),
(83, 44, 43, 1, 2, '100.00', '100.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(84, 44, 44, 1, 2, '39.00', '39.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(85, 44, 65, 1, 2, '50.00', '50.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(86, 44, 64, 1, 2, '100.00', '100.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(87, 44, 63, 1, 2, '100.00', '100.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(88, 44, 45, 1, 2, '200.00', '200.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(89, 44, 70, 1, 2, '76.00', '76.00', 1, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(90, 45, 67, 1, 2, '15.00', '0.00', 1, NULL, '2025-03-05 17:16:57'),
(91, 45, 66, 1, 2, '15.00', '0.00', 1, NULL, '2025-03-05 17:16:57'),
(92, 46, 67, 1, 2, '720.00', '720.00', 1, '2025-03-07 16:46:27', '2025-03-06 09:52:55'),
(93, 46, 66, 1, 2, '720.00', '720.00', 1, '2025-03-07 16:46:27', '2025-03-06 09:52:55'),
(94, 47, 67, 1, 2, '624.00', '624.00', 1, '2025-03-10 09:39:36', '2025-03-08 12:59:11'),
(95, 47, 66, 1, 2, '624.00', '624.00', 1, '2025-03-10 09:39:36', '2025-03-08 12:59:11'),
(96, 48, 63, 1, 1, '16.00', '34.00', 1, '2025-03-11 10:52:57', '2025-03-10 15:09:30'),
(97, 48, 43, 1, 1, '28.00', '28.00', 1, '2025-03-11 10:52:57', '2025-03-10 15:09:30'),
(98, 48, 44, 1, 1, '5.00', '5.00', 1, '2025-03-11 10:52:57', '2025-03-10 15:09:30'),
(99, 48, 45, 1, 1, '159.00', '186.00', 1, '2025-03-11 10:52:57', '2025-03-10 15:09:30'),
(100, 49, 71, 1, 1, '85.00', '85.00', 1, '2025-03-12 16:46:10', '2025-03-11 19:00:22'),
(101, 50, 72, 1, 1, '50.00', '50.00', 1, '2025-03-12 17:45:22', '2025-03-12 16:47:54'),
(102, 50, 73, 1, 1, '70.00', '70.00', 1, '2025-03-12 17:45:22', '2025-03-12 16:47:54'),
(103, 51, 74, 1, 1, '17424.00', '17424.00', 1, '2025-03-12 18:02:10', '2025-03-12 16:57:55'),
(104, 52, 74, 1, 2, '17124.00', '17124.00', 1, '2025-03-12 20:23:08', '2025-03-12 18:05:54'),
(105, 53, 29, 1, 2, '50.00', '50.00', 1, '2025-03-17 14:14:10', '2025-03-13 10:50:17'),
(106, 53, 28, 1, 2, '50.00', '50.00', 1, '2025-03-17 14:14:10', '2025-03-13 10:50:17'),
(107, 53, 27, 1, 2, '60.00', '60.00', 1, '2025-03-17 14:14:10', '2025-03-13 10:50:17'),
(108, 53, 10, 1, 2, '100.00', '100.00', 1, '2025-03-17 14:14:10', '2025-03-13 10:50:17'),
(109, 54, 75, 1, 1, '16000.00', '16000.00', 1, '2025-03-13 14:36:31', '2025-03-13 11:30:12'),
(110, 55, 76, 1, 1, '22000.00', '22000.00', 1, '2025-03-13 14:37:05', '2025-03-13 11:41:58'),
(111, 56, 77, 1, 1, '4469.00', '4469.00', 1, '2025-03-13 14:35:44', '2025-03-13 11:44:45'),
(112, 57, 62, 1, 2, '12.00', '12.00', 1, '2025-03-13 14:33:45', '2025-03-13 12:33:08'),
(113, 58, 44, 1, 2, '39.00', '39.00', 1, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(114, 58, 43, 1, 2, '100.00', '100.00', 1, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(115, 58, 65, 1, 2, '50.00', '50.00', 1, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(116, 58, 45, 1, 2, '200.00', '200.00', 1, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(117, 58, 63, 1, 2, '100.00', '100.00', 1, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(118, 58, 64, 1, 2, '100.00', '100.00', 1, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(119, 59, 72, 1, 2, '30.00', '30.00', 1, '2025-03-13 19:17:57', '2025-03-13 17:20:04'),
(120, 60, 73, 1, 2, '30.00', '30.00', 1, '2025-03-13 19:17:59', '2025-03-13 17:20:57'),
(121, 61, 73, 1, 1, '30.00', '30.00', 1, '2025-03-17 11:40:55', '2025-03-17 08:30:45'),
(122, 62, 72, 1, 1, '30.00', '30.00', 1, '2025-03-17 11:40:58', '2025-03-17 08:33:34'),
(123, 63, 74, 1, 1, '13700.00', '13700.00', 1, '2025-03-17 11:41:05', '2025-03-17 08:36:32'),
(124, 64, 78, 1, 1, '13900.00', '13900.00', 1, '2025-03-17 15:58:49', '2025-03-17 14:06:18'),
(125, 65, 76, 1, 2, '10.00', '10.00', 1, '2025-03-18 11:35:59', '2025-03-18 10:53:49'),
(126, 65, 78, 1, 2, '10.00', '10.00', 1, '2025-03-18 11:35:59', '2025-03-18 10:53:49'),
(127, 65, 75, 1, 2, '10.00', '10.00', 1, '2025-03-18 11:35:59', '2025-03-18 10:53:49'),
(128, 66, 10, 1, 2, '200.00', '0.00', 1, NULL, '2025-03-18 18:13:47'),
(129, 66, 29, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-18 18:13:47'),
(130, 66, 28, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-18 18:13:48'),
(131, 66, 27, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-18 18:13:48'),
(132, 67, 78, 1, 2, '1000.00', '1000.00', 1, '2025-03-19 11:57:14', '2025-03-19 10:55:05'),
(133, 67, 76, 1, 2, '1000.00', '1000.00', 1, '2025-03-19 11:57:14', '2025-03-19 10:55:05'),
(134, 67, 75, 1, 2, '1000.00', '1000.00', 1, '2025-03-19 11:57:14', '2025-03-19 10:55:05'),
(135, 68, 70, 1, 1, '130.00', '130.00', 1, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(136, 68, 63, 1, 1, '96.00', '96.00', 1, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(137, 68, 64, 1, 1, '15.00', '15.00', 1, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(138, 68, 44, 1, 1, '7.00', '7.00', 1, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(139, 68, 43, 1, 1, '51.00', '51.00', 1, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(140, 68, 45, 1, 1, '184.00', '182.00', 1, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(141, 69, 74, 1, 2, '300.00', '300.00', 1, '2025-03-19 17:49:32', '2025-03-19 15:28:25'),
(142, 69, 73, 1, 2, '70.00', '70.00', 1, '2025-03-19 17:49:32', '2025-03-19 15:28:25'),
(143, 69, 72, 1, 2, '50.00', '50.00', 1, '2025-03-19 17:49:32', '2025-03-19 15:28:26'),
(144, 70, 79, 1, 1, '930.00', '0.00', 1, NULL, '2025-03-19 16:30:03'),
(145, 71, 80, 1, 1, '930.00', '0.00', 1, NULL, '2025-03-19 16:33:24'),
(146, 71, 81, 1, 1, '930.00', '0.00', 1, NULL, '2025-03-19 16:33:24'),
(147, 71, 82, 1, 1, '930.00', '0.00', 1, NULL, '2025-03-19 16:33:24'),
(148, 72, 66, 1, 1, '2400.00', '0.00', 0, '2025-03-19 18:43:53', '2025-03-19 18:41:01'),
(149, 72, 66, 1, 1, '2400.00', '2400.00', 1, '2025-03-19 19:00:50', '2025-03-19 18:44:28'),
(150, 72, 67, 1, 1, '2400.00', '2400.00', 1, '2025-03-19 19:00:50', '2025-03-19 18:44:28'),
(151, 73, 83, 1, 1, '81504.00', '81504.00', 1, '2025-03-19 19:03:46', '2025-03-19 18:48:41'),
(152, 73, 84, 1, 1, '95664.00', '95664.00', 1, '2025-03-19 19:03:46', '2025-03-19 18:48:41'),
(153, 74, 86, 1, 1, '120.00', '120.00', 1, '2025-03-19 19:21:15', '2025-03-19 19:05:42'),
(154, 74, 85, 1, 1, '40.00', '40.00', 1, '2025-03-19 19:21:15', '2025-03-19 19:05:42'),
(155, 75, 83, 1, 2, '11520.00', '11520.00', 1, '2025-03-20 12:42:35', '2025-03-19 19:10:29'),
(156, 75, 84, 1, 2, '11520.00', '11520.00', 1, '2025-03-20 12:42:35', '2025-03-19 19:10:29'),
(157, 76, 83, 1, 2, '240.00', '240.00', 1, '2025-03-20 11:05:21', '2025-03-19 19:12:12'),
(158, 76, 84, 1, 2, '240.00', '240.00', 1, '2025-03-20 11:05:21', '2025-03-19 19:12:12'),
(159, 77, 43, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(160, 77, 44, 1, 2, '39.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(161, 77, 64, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(162, 77, 63, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(163, 77, 45, 1, 2, '200.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(164, 77, 65, 1, 2, '50.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(165, 77, 70, 1, 2, '65.00', '0.00', 1, NULL, '2025-03-19 21:06:08'),
(166, 78, 43, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(167, 78, 44, 1, 2, '39.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(168, 78, 64, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(169, 78, 63, 1, 2, '100.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(170, 78, 45, 1, 2, '200.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(171, 78, 65, 1, 2, '50.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(172, 78, 70, 1, 2, '65.00', '0.00', 1, NULL, '2025-03-19 21:08:32'),
(173, 79, 78, 1, 1, '1100.00', '1100.00', 1, '2025-03-19 22:23:59', '2025-03-19 22:05:56'),
(174, 80, 91, 1, 1, '200.00', '200.00', 1, '2025-03-19 22:22:52', '2025-03-19 22:08:04'),
(175, 81, 92, 1, 1, '198.00', '198.00', 1, '2025-03-19 22:20:52', '2025-03-19 22:10:07'),
(176, 82, 93, 1, 1, '1210.00', '1210.00', 1, '2025-03-19 22:22:30', '2025-03-19 22:12:22'),
(177, 83, 94, 1, 1, '1.00', '1.00', 1, '2025-03-19 22:24:23', '2025-03-19 22:14:36'),
(178, 84, 95, 1, 1, '2000.00', '2000.00', 1, '2025-03-20 14:43:58', '2025-03-20 14:42:13'),
(179, 84, 96, 1, 1, '4000.00', '4000.00', 1, '2025-03-20 14:43:58', '2025-03-20 14:42:13'),
(180, 84, 97, 1, 1, '10000.00', '10000.00', 1, '2025-03-20 14:43:58', '2025-03-20 14:42:13'),
(181, 85, 95, 1, 2, '2000.00', '0.00', 1, NULL, '2025-03-20 14:49:08'),
(182, 85, 96, 1, 2, '4000.00', '0.00', 1, NULL, '2025-03-20 14:49:08'),
(183, 85, 97, 1, 2, '10000.00', '0.00', 1, NULL, '2025-03-20 14:49:08'),
(184, 86, 74, 1, 2, '1000.00', '0.00', 1, NULL, '2025-03-20 15:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `issue_remark`
--

CREATE TABLE `issue_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(16, 8, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-21 10:32:49'),
(17, 17, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-24 14:05:43'),
(18, 18, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-24 17:32:20'),
(19, 20, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-24 17:46:08'),
(20, 21, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-24 17:46:17'),
(21, 22, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-24 18:13:56'),
(22, 23, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-24 22:11:36'),
(23, 26, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-25 13:22:00'),
(24, 28, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-25 13:24:52'),
(25, 24, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-25 13:25:36'),
(26, 25, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-25 13:25:43'),
(27, 29, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-25 14:00:21'),
(28, 33, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 11:42:27'),
(29, 34, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 11:42:32'),
(30, 35, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 11:42:39'),
(31, 36, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 11:42:43'),
(32, 31, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 11:53:00'),
(33, 30, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 11:53:10'),
(34, 32, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 12:06:04'),
(35, 37, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-26 16:36:12'),
(36, 38, 14, 'ผ่านการตรวจสอบ', 2, '2025-02-28 11:08:53'),
(37, 39, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-05 11:38:40'),
(38, 44, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-05 12:49:06'),
(39, 46, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-07 16:46:27'),
(40, 47, 16, 'ผ่านการตรวจสอบ', 2, '2025-03-10 09:39:36'),
(41, 48, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-11 10:52:57'),
(42, 49, 16, 'ผ่านการตรวจสอบ', 2, '2025-03-12 16:46:10'),
(43, 50, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-12 17:45:22'),
(44, 51, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-12 18:02:10'),
(45, 52, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-12 20:23:08'),
(46, 57, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-13 14:33:45'),
(47, 56, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-13 14:35:44'),
(48, 54, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-13 14:36:31'),
(49, 55, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-13 14:37:05'),
(50, 59, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-13 19:17:57'),
(51, 60, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-13 19:17:59'),
(52, 40, 16, 'ผ่านการตรวจสอบ', 2, '2025-03-14 11:28:42'),
(53, 58, 16, 'ผ่านการตรวจสอบ', 2, '2025-03-14 11:34:13'),
(54, 61, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-17 11:40:55'),
(55, 62, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-17 11:40:58'),
(56, 63, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-17 11:41:05'),
(57, 53, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-17 14:14:10'),
(58, 64, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-17 15:58:49'),
(59, 65, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-18 11:35:59'),
(60, 41, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-18 11:36:16'),
(61, 67, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 11:57:14'),
(62, 68, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 15:54:39'),
(63, 69, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 17:49:32'),
(64, 72, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 19:00:50'),
(65, 73, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 19:03:46'),
(66, 74, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 19:21:15'),
(67, 81, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 22:20:52'),
(68, 82, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 22:22:30'),
(69, 80, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 22:22:52'),
(70, 79, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 22:23:59'),
(71, 83, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-19 22:24:23'),
(72, 76, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-20 11:05:21'),
(73, 75, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-20 12:42:35'),
(74, 84, 14, 'ผ่านการตรวจสอบ', 2, '2025-03-20 14:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `issue_request`
--

CREATE TABLE `issue_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `type` int NOT NULL,
  `date` date NOT NULL,
  `event_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `event_start` date DEFAULT NULL,
  `event_end` date DEFAULT NULL,
  `event_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sale` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location_start` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location_end` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outcome` int DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(16, '6928fd6b-ef6f-11ef-852d-2ad6c30b0fff', 16, 13, 1, '2025-02-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '12 ลัง นำเข้า', 2, '2025-02-20 10:13:04', '2025-02-20 09:45:25'),
(17, 'fed059e2-f268-11ef-af74-2ad6c30b0fff', 17, 13, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ชิ้น', 2, '2025-02-24 14:05:43', '2025-02-24 11:37:03'),
(18, '485a5a80-f29a-11ef-af74-2ad6c30b0fff', 18, 12, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ถุงผ้าสีขาว lot ใหม่ ของงาน JobsDB', 2, '2025-02-24 17:32:20', '2025-02-24 17:29:52'),
(19, '8a4a9b56-f29a-11ef-af74-2ad6c30b0fff', 19, 12, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ยาดม lot เดิม ของงาน jobsDB', 1, NULL, '2025-02-24 17:31:43'),
(20, '78946785-f29b-11ef-af74-2ad6c30b0fff', 20, 12, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'สมุดโน๊ต ใช้ในงาน jobsDB', 2, '2025-02-24 17:46:08', '2025-02-24 17:38:22'),
(21, '9025371f-f29b-11ef-af74-2ad6c30b0fff', 21, 12, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'Sticker (สติ๊กเกอร์) งาน JobsDB', 2, '2025-02-24 17:46:17', '2025-02-24 17:39:02'),
(22, '4adc0b65-f2a0-11ef-af74-2ad6c30b0fff', 22, 12, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ยาดม คีย์แก้ไขจำนวนยอดนำเข้า', 2, '2025-02-24 18:13:56', '2025-02-24 18:12:53'),
(23, '8d0bcd40-f2c1-11ef-af74-2ad6c30b0fff', 23, 12, 1, '2025-02-24', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ถุงผ้า It\'S Match แก้ไขจำนวนสินค้านำเข้า', 2, '2025-02-24 22:11:36', '2025-02-24 22:10:58'),
(24, '3d7cfb05-f32a-11ef-af74-2ad6c30b0fff', 24, 9, 1, '2025-02-25', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '48 ชิ้น / กล่อง รับมาทั้งหมด 50 กล่อง', 2, '2025-02-25 13:25:36', '2025-02-25 10:40:21'),
(25, '82a208a3-f32a-11ef-af74-2ad6c30b0fff', 25, 9, 1, '2025-02-25', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '48 ชิ้น / กล่อง\r\nรับมาทั้งหมด 50 กล่อง', 2, '2025-02-25 13:25:43', '2025-02-25 10:42:17'),
(26, 'e2ae163e-f32e-11ef-af74-2ad6c30b0fff', 26, 12, 2, '2025-02-24', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'jobsDB', 'บุ๋น', 'โกดังสาธร', 'ม.เกษตร วิทยาเขตศรีราชา', 0, 'ทำรายการเบิกออกย้อนหลัง เนื่องจากยังไม่มีข้อมูลสินค้าในระบบ', 2, '2025-02-25 13:22:00', '2025-02-25 11:13:36'),
(27, '6aad59ff-f32f-11ef-af74-2ad6c30b0fff', 27, 12, 2, '2025-02-25', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'jobsDB', 'บุ๋น', 'โกดังสาธร', 'ม.เกษตร วิทยาเขตศรีราชา', 0, 'Test เลือกสินค้าที่ถูกระงับจากคลัง แต่มีให้เลือกในการนำออก', 1, NULL, '2025-02-25 11:17:25'),
(28, '8604cf59-f33f-11ef-af74-2ad6c30b0fff', 28, 9, 1, '2025-02-25', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'สินค้าสำหรับงานฝั่งมิเดีย \r\n1x4x6 = 24 ขวด/ลัง', 2, '2025-02-25 13:24:52', '2025-02-25 13:12:42'),
(29, 'e9feabbc-f343-11ef-af74-2ad6c30b0fff', 29, 9, 2, '2025-02-25', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'กระจายสินค้านมดัชมิลด์ 4 in', 'พี่เก๋', 'โกดังสาธร Belink', 'Prakit holdings plc.', 0, 'Prakit holdings plc. มารับรสชาตลิล่ะ 15 ลัง รวม 30 ลัง', 2, '2025-02-25 14:00:21', '2025-02-25 13:44:08'),
(30, 'b55203cb-f35b-11ef-af74-2ad6c30b0fff', 30, 12, 1, '2025-02-25', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'แฟ้มผ้าสีเทา นำเข้า 3 ลัง ลังละ 15 ชิ้น', 2, '2025-02-26 11:53:10', '2025-02-25 16:34:28'),
(31, '2a7a7e36-f35c-11ef-af74-2ad6c30b0fff', 31, 12, 1, '2025-02-25', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'บัตร Rabbit card งาน JobsDB', 2, '2025-02-26 11:53:00', '2025-02-25 16:37:44'),
(32, 'd961c19a-f35c-11ef-af74-2ad6c30b0fff', 32, 12, 1, '2025-02-25', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้าสินค้า ของพรีเมี่ยมเหลือจากการนำไปจัดกิจกรรม ม.เกษตรศาสตร์ ศรีราชา', 2, '2025-02-26 12:06:04', '2025-02-25 16:42:38'),
(33, 'bcc81a11-f37c-11ef-af74-2ad6c30b0fff', 33, 9, 2, '2025-02-25', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'ส่งเปปทีนพลัส', 'พี่บุ๋น', 'โกดังสาทร 1ฒฬ8630 กทม.', 'ภาคกลาง', 0, '1.MBK 41 ลัง = 984 ขวด\r\n2.ปิ่นเกล้่า 41 ลัง = 984 ขวด\r\n3.วิสุทธานี 41 ลัง = 984 ขวด\r\n4.รังสิต 41 ลัง = 984 ขวด\r\n5.เพชรเกษม 41 ลัง = 984 ขวด\r\n\r\nรวม 4920 ขวด', 2, '2025-02-26 11:42:27', '2025-02-25 20:30:54'),
(34, '47bbe2de-f37d-11ef-af74-2ad6c30b0fff', 34, 9, 2, '2025-02-25', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'ส่งเปปทีนพลัส 2ฒภ 7883 กทม.', 'พี่บุ๋น', 'โกดังสาทร', 'ภาคกลาง', 0, '1.นครปฐม 41 ลัง = 984 ขวด\r\n2.ราชบุรี 41 ลัง = 984 ขวด\r\n3.เพชรบุรี 41 ลัง = 984 ขวด\r\n4.สุพรรณบุรี 41 ลัง = 984 ขวด\r\n5.ชลบุรี 41 ลัง = 984 ขวด\r\n6.ฉะเชิงเทรา 41 ลัง = 984 ขวด\r\n7.ระยอง 41 ลัง = 984 ขวด\r\n\r\nรวม 6888 ขวด', 2, '2025-02-26 11:42:32', '2025-02-25 20:34:47'),
(35, 'add18eda-f37d-11ef-af74-2ad6c30b0fff', 35, 9, 2, '2025-02-25', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'ส่งเปปทีนพลัส ยก525 นครราชสีมา', 'พี่บุ๋น', 'โกดังสาทร', 'ภาคอีสาน', 0, '1.อยุธยา 41 ลัง = 984 ขวด\r\n2.ลพบุรี 41 ลัง = 984 ขวด\r\n3.สระบุรี 41 ลัง = 984 ขวด\r\n4.นครราชสีมา 41 ลัง = 984 ขวด\r\n5.ขอนแก่น 41 ลัง = 984 ขวด\r\n6.บุรีรัมย์ 41 ลัง = 984 ขวด\r\n\r\nรวม 5904 ขวด', 2, '2025-02-26 11:42:39', '2025-02-25 20:37:38'),
(36, 'e182994f-f37d-11ef-af74-2ad6c30b0fff', 36, 9, 2, '2025-02-25', '25/02/2025 - 25/02/2025', '2025-02-25', '2025-02-25', 'ส่งเปปทีนพลัส 1ฒส2886 กทม.', 'พี่บุ๋น', 'โกดังสาทร', 'ภาคเหนือ', 0, '1.พิษณุโลก 41 ลัง = 984 ขวด\r\n2.เชียงใหม่ 41 ลัง = 984 ขวด\r\n\r\nรวม 1968 ขวด', 2, '2025-02-26 11:42:43', '2025-02-25 20:39:05'),
(37, 'c1e3bf50-f404-11ef-af74-2ad6c30b0fff', 37, 9, 2, '2025-02-26', '26/02/2025 - 26/02/2025', '2025-02-26', '2025-02-26', 'ส่งนมให้ลูกค้าดัชมิลด์ด่วน', 'พี่เก๋', 'โกดังสาทร', 'กลุ่มบริษัท ดัชมิลล์ จำกัด', 0, 'รสชาติล่ะ 3 ลัง \r\nรวมทั้งหมด 6 ลัง\r\nขนส่ง Lalamove', 2, '2025-02-26 16:36:12', '2025-02-26 12:44:34'),
(38, '932cbe92-f4df-11ef-af74-2ad6c30b0fff', 38, 9, 2, '2025-02-27', '27/02/2025 - 27/02/2025', '2025-02-27', '2025-02-27', 'ส่งนมดัชมิลด์ NOX', 'พี่เก๋', 'โกดังสาธร Belink', 'NOX', 0, '-รสชาติล่ะ 4 ลัง \r\nรวมทั้งหมด 8 ลัง', 2, '2025-02-28 11:08:53', '2025-02-27 14:50:55'),
(39, 'efb2bf0e-f7df-11ef-af74-2ad6c30b0fff', 39, 7, 2, '2025-03-05', '06/03/2025 - 06/03/2025', '2025-03-06', '2025-03-06', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'ม.เกษตรศาสตร์บางเขน', 0, 'เพื่อออกบูธงานเดอร์มาติก', 2, '2025-03-05 11:38:40', '2025-03-03 10:31:04'),
(40, '601b703a-f8e2-11ef-af74-2ad6c30b0fff', 40, 9, 2, '2025-03-14', '17/03/2025 - 17/03/2025', '2025-03-17', '2025-03-17', 'Troop Event_Lotte Xylitol Day 1', 'พี่เก๋', 'โกดังสาธร Belink', 'BTS ศาลาแดง', 0, 'งานจบ 19.00 คืนของหลังจบงาน', 2, '2025-03-14 11:28:42', '2025-03-04 17:21:03'),
(41, 'ec4ee00d-f8e2-11ef-af74-2ad6c30b0fff', 41, 9, 2, '2025-03-18', '19/03/2025 - 19/03/2025', '2025-03-19', '2025-03-19', 'Troop Event_Lotte Xylitol Day 2', 'พี่เก๋', 'โกดังสาธร Belink', 'BTS ช่องนนทรี', 0, 'จบงาน 19.00 คืนของหลังจบงาน', 2, '2025-03-18 11:36:16', '2025-03-04 17:24:58'),
(42, '1b003d26-f8e3-11ef-af74-2ad6c30b0fff', 42, 9, 2, '2025-03-21', '22/03/2025 - 22/03/2025', '2025-03-22', '2025-03-22', 'Troop Event_Lotte Xylitol Day 3', 'พี่เก๋', 'โกดังสาธร Belink', 'BTS สยาม', 0, 'งานจบ 19.00 คืนของหลังจบงาน', 1, NULL, '2025-03-04 17:26:16'),
(43, '54f8530c-f8e3-11ef-af74-2ad6c30b0fff', 43, 9, 2, '2025-03-24', '25/03/2025 - 25/03/2025', '2025-03-25', '2025-03-25', 'Troop Event_Lotte Xylitol Day 4', 'พี่เก๋', 'โกดังสาธร Belink', 'MRT เพชรบุรี', 0, 'งานจบ 19.00 คืนของหลังจบงาน', 1, NULL, '2025-03-04 17:27:53'),
(44, '36caf623-f984-11ef-af74-2ad6c30b0fff', 44, 12, 2, '2025-03-05', '06/03/2025 - 06/03/2025', '2025-03-06', '2025-03-06', 'jobsDB', 'บุ๋น', 'โกดังสาธร', 'ม.ศิลปากร วิทยาเขตท่าพระจันทร์', 0, 'นำสินค้าของแจก ไปจัดงาน', 2, '2025-03-05 12:49:06', '2025-03-05 12:39:32'),
(45, 'f814845d-f9aa-11ef-af74-2ad6c30b0fff', 45, 8, 2, '2025-03-07', '08/03/2025 - 08/03/2025', '2025-03-08', '2025-03-08', 'Dutchmill 4in1', 'เก๋', 'โกดังสาทร', 'สยามสแควร์ ซอย10', 0, 'Booth Event_Dutchmill 4in1 สยามสแควร์ ซอย10', 1, NULL, '2025-03-05 17:16:57'),
(46, '1abcd340-fa36-11ef-af74-2ad6c30b0fff', 46, 8, 2, '2025-03-07', '08/03/2025 - 08/03/2025', '2025-03-08', '2025-03-08', 'Dutchmill 4in1', 'เก๋', 'โกดังสาทร', 'สยามสแควร์ ซอย10', 0, 'Booth Event_Dutchmill 4in1 สยามสแควร์ ซอย10\r\nนมดัชมิลล์ 4 in 1 รสสตอเบอรี่ ลดน้ำตาลลง 40% 15 ลัง\r\nนมดัชมิลล์ 4 in 1 รสผลไม้รวม ลดน้ำตาลลง 40% 15 ลัง', 2, '2025-03-07 16:46:27', '2025-03-06 09:52:55'),
(47, '74d544c8-fbe2-11ef-af74-2ad6c30b0fff', 47, 8, 2, '2025-03-08', '08/03/2025 - 08/03/2025', '2025-03-08', '2025-03-08', 'Dutchmill 4in1', 'เก๋', 'โกดังสาทร', 'สยามสแควร์ ซอย10', 0, 'Booth Event_ 4in1  สยามสแควร์ ซอย10', 2, '2025-03-10 09:39:36', '2025-03-08 12:59:11'),
(48, 'fe0358a0-fd86-11ef-af74-2ad6c30b0fff', 48, 12, 1, '2025-03-07', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้าสินค้าหลังจากเอาไปจัดกิจกรรมวันของวันที่ 6 มีนาคม 68', 2, '2025-03-11 10:52:57', '2025-03-10 15:09:30'),
(49, '68e1e900-fe70-11ef-af74-2ad6c30b0fff', 49, 10, 1, '2025-03-11', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'photocard Bus UV set', 2, '2025-03-12 16:46:10', '2025-03-11 19:00:22'),
(50, '121146b9-ff27-11ef-af74-2ad6c30b0fff', 50, 10, 1, '2025-03-12', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'การ์นิเย่ ยูวี', 2, '2025-03-12 17:45:22', '2025-03-12 16:47:54'),
(51, '784a942b-ff28-11ef-af74-2ad6c30b0fff', 51, 10, 1, '2025-03-12', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'การ์นิเย่ ยูวี สินค้าทดลอง', 2, '2025-03-12 18:02:10', '2025-03-12 16:57:55'),
(52, 'f77750bb-ff31-11ef-af74-2ad6c30b0fff', 52, 10, 2, '2025-03-12', '12/03/2025 - 12/03/2025', '2025-03-12', '2025-03-12', 'Garnier UV', 'เก๋', 'โกดังสาธร', 'อิมแพ็ค เมืองทอง', 0, 'จัดบูธการ์นิเย่', 2, '2025-03-12 20:23:08', '2025-03-12 18:05:54'),
(53, '4759e9bc-ffbe-11ef-af74-2ad6c30b0fff', 53, 7, 2, '2025-03-17', '18/03/2025 - 18/03/2025', '2025-03-18', '2025-03-18', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'ม.มหิดล ศาลายา', 0, 'เพื่อออกบูธ', 2, '2025-03-17 14:14:10', '2025-03-13 10:50:17'),
(54, 'dab98f14-ffc3-11ef-af74-2ad6c30b0fff', 54, 7, 1, '2025-03-13', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'สินค้าของ Vichy Dercos แชมพู', 2, '2025-03-13 14:36:31', '2025-03-13 11:30:12'),
(55, '7fbd43e6-ffc5-11ef-af74-2ad6c30b0fff', 55, 7, 1, '2025-03-13', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'สินค้าชื่อเต็ม : LA ROCHE POSAY เอฟฟาคลาร์ ดูโอ(2)', 2, '2025-03-13 14:37:05', '2025-03-13 11:41:58'),
(56, 'e33ceb18-ffc5-11ef-af74-2ad6c30b0fff', 56, 7, 1, '2025-03-13', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'สินค้าชื่อเต็ม : LA ROCHE POSAY แอนเทลิโอส ยูวีมูน ดรายทัช', 2, '2025-03-13 14:35:44', '2025-03-13 11:44:45'),
(57, 'a54defbe-ffcc-11ef-af74-2ad6c30b0fff', 57, 12, 2, '2025-03-13', '13/03/2025 - 13/03/2025', '2025-03-13', '2025-03-13', 'jobsDB', 'บุ๋น', 'โกดังสาธร', 'gaysorn tower', 0, 'เอายาดมไปให้ลํูกค้าเทสกลิ่น', 2, '2025-03-13 14:33:45', '2025-03-13 12:33:08'),
(58, '30d1515e-ffd0-11ef-af74-2ad6c30b0fff', 58, 12, 2, '2025-03-14', '17/03/2025 - 17/03/2025', '2025-03-17', '2025-03-17', 'jobsDB', 'บุ๋น', 'โกดังสาทร', 'ม..ศรีนครินทร์วิโรฒ (อโศก)', 0, 'เบิกของจัดกิจกรรมงาน jobsdb งานวันที่ 17/03/68', 2, '2025-03-14 11:34:13', '2025-03-13 12:58:30'),
(59, 'bb23bafb-fff4-11ef-af74-2ad6c30b0fff', 59, 10, 2, '2025-03-13', '13/03/2025 - 13/03/2025', '2025-03-13', '2025-03-13', 'Garnier UV', 'เก๋', 'โกดังสาธร', 'อิมแพ็ค เมืองทอง', 0, 'จัดบูธ การ์นิเย่', 2, '2025-03-13 19:17:57', '2025-03-13 17:20:04'),
(60, 'da4dc602-fff4-11ef-af74-2ad6c30b0fff', 60, 10, 2, '2025-03-13', '13/03/2025 - 13/03/2025', '2025-03-13', '2025-03-13', 'Garnier UV', 'เก๋', 'โกดังสาธร', 'อิมแพ็ค เมืองทอง', 0, 'จัดบูธการ์นิเย่', 2, '2025-03-13 19:17:59', '2025-03-13 17:20:57'),
(61, '727a9ccf-02cf-11f0-af74-2ad6c30b0fff', 61, 10, 1, '2025-03-17', '', '0000-00-00', '0000-00-00', '', '', '', '', 60, 'คืนของหลังจบงานจัดบูธการ์นิเย่', 2, '2025-03-17 11:40:55', '2025-03-17 08:30:45'),
(62, 'd78d22c4-02cf-11f0-af74-2ad6c30b0fff', 62, 10, 1, '2025-03-17', '', '0000-00-00', '0000-00-00', '', '', '', '', 59, 'คืนสินค้าหลังจบงานจัดบูธการ์นิเย่', 2, '2025-03-17 11:40:58', '2025-03-17 08:33:34'),
(63, '4188a503-02d0-11f0-af74-2ad6c30b0fff', 63, 10, 1, '2025-03-17', '', '0000-00-00', '0000-00-00', '', '', '', '', 52, 'คืนสินค้าแจกหลังจบงานจัดบูธการ์นิเย่', 2, '2025-03-17 11:41:05', '2025-03-17 08:36:32'),
(64, '531a2454-02fe-11f0-af74-2ad6c30b0fff', 64, 7, 1, '2025-03-17', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ชื่อเต็ม Simple Card Cerave', 2, '2025-03-17 15:58:49', '2025-03-17 14:06:18'),
(65, '99bae9d6-03ac-11f0-af74-2ad6c30b0fff', 65, 7, 2, '2025-03-18', '18/03/2025 - 18/03/2025', '2025-03-18', '2025-03-18', 'CEO Festival', 'พี่เก๋', 'โกดังสาทร', 'บริษัทบีลิงค์ มีเดีย', 0, 'เบิกด่วน เพื่อเอามาลองจัดใส่ซอง', 2, '2025-03-18 11:35:59', '2025-03-18 10:53:49'),
(66, 'e5f79910-03e9-11f0-af74-2ad6c30b0fff', 66, 7, 2, '2025-03-21', '23/03/2025 - 23/03/2025', '2025-03-23', '2025-03-23', 'เดอร์มาติก', 'พี่ตาล', 'โกดังสาทร', 'Center Point of Siam Square', 0, 'เพื่อออกบูธ', 1, NULL, '2025-03-18 18:12:36'),
(67, 'f16cad23-0475-11f0-a87c-2ad6c30b0fff', 67, 7, 2, '2025-03-19', '19/03/2025 - 19/03/2025', '2025-03-19', '2025-03-19', 'CEO Festival', 'พี่เก๋', 'โกดังสาทร', 'บริษัทบีลิงค์ มีเดีย', 0, 'เบิกด่วนเพื่อนำมาจัดใส่ซอง', 2, '2025-03-19 11:57:14', '2025-03-19 10:55:05'),
(68, '432bdeea-0498-11f0-a87c-2ad6c30b0fff', 68, 12, 1, '2025-03-17', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้าสินค้าย้อนหลัง จากไปจัดงานจ้อบดีบี 17.3.68', 2, '2025-03-19 15:54:39', '2025-03-19 15:00:45'),
(69, '20c8d328-049c-11f0-a87c-2ad6c30b0fff', 69, 10, 2, '2025-03-19', '19/03/2025 - 19/03/2025', '2025-03-19', '2025-03-19', 'Garnier UV  BK', 'เก๋', 'โกดังสาธร', 'ONE Bangkok', 0, 'จัดงานการ์นิเย่ ยูวี ONE bangkok', 2, '2025-03-19 17:49:32', '2025-03-19 15:28:25'),
(70, 'bce0a881-04a4-11f0-a87c-2ad6c30b0fff', 70, 11, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้าสินค้าล็อต 1', 1, NULL, '2025-03-19 16:30:03'),
(71, '342f3023-04a5-11f0-a87c-2ad6c30b0fff', 71, 11, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นำเข้าสินค้า ล็อต 1', 1, NULL, '2025-03-19 16:33:24'),
(72, '08a3e066-04b7-11f0-a87c-2ad6c30b0fff', 72, 9, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นมลูกค้าฝาก 48 ชิ้น / กล่อง', 2, '2025-03-19 19:00:50', '2025-03-19 18:41:01'),
(73, '1a6fe08a-04b8-11f0-a87c-2ad6c30b0fff', 73, 9, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'นมลูกค้าฝาก 48 ชิ้น / กล่อง\r\n-สตอเบอรี่ 1698 กล่อง\r\n-ผลไม้รวม 100+93+1800=  1993 กล่อง', 2, '2025-03-19 19:03:46', '2025-03-19 18:48:41'),
(74, '7b15f97d-04ba-11f0-a87c-2ad6c30b0fff', 74, 9, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '-6 ซอง/กล่อง มาทั้งหมด 20 กล่อง\r\n-40 ขวด', 2, '2025-03-19 19:21:15', '2025-03-19 19:05:42'),
(75, '2611f192-04bb-11f0-a87c-2ad6c30b0fff', 75, 9, 2, '2025-03-20', '20/03/2025 - 20/03/2025', '2025-03-20', '2025-03-20', 'ส่งนมดัชมิลล์ บริษัท วีแคนโชว์ จำกัด', 'พี่เก๋', 'โกดังสาทร', 'บริษัท วีแคนโชว์ จำกัด', 0, 'ขนส่ง LaLamove จำนวน 240 ลัง', 2, '2025-03-20 12:42:35', '2025-03-19 19:10:29'),
(76, '63604486-04bb-11f0-a87c-2ad6c30b0fff', 76, 9, 2, '2025-03-19', '19/03/2025 - 19/03/2025', '2025-03-19', '2025-03-19', 'ส่งนมดัชมิลล์ กลุ่มบริษัทดัชมิลล์ ตลิ่งชัน', 'พี่เก๋', 'โกดังสาทร', 'กลุ่มบริษัทดัชมิลล์ ตลิ่งชัน', 0, 'รสชาติล่ะ 5 ลัง รวม 10 ลัง', 2, '2025-03-20 11:05:21', '2025-03-19 19:12:12'),
(77, '4e1e7fbd-04cb-11f0-a87c-2ad6c30b0fff', 77, 12, 2, '2025-03-21', '24/03/2025 - 24/03/2025', '2025-03-24', '2025-03-24', 'jobsDB', 'บุ๋น', 'โกดังสาทร', 'ม.หอการค้าไทย', 0, 'เบิกของจัดกิจกรรม งานจ้อบดีบี ม.หอการค้าไทย', 1, NULL, '2025-03-19 21:06:08'),
(78, 'a42f5365-04cb-11f0-a87c-2ad6c30b0fff', 78, 12, 2, '2025-03-21', '24/03/2025 - 24/03/2025', '2025-03-24', '2025-03-24', 'jobsDB', 'บุ๋น', 'โกดังสาทร', 'ม.พระจอมเกล้าธนบุรี', 0, 'เบิกของจัดกิจกรรม ม.พระจอมเกล้าธนบุรี', 1, NULL, '2025-03-19 21:08:32'),
(79, 'a8b330d4-04d3-11f0-a87c-2ad6c30b0fff', 79, 7, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'เป็นของที่มาส่งเพิ่มวันที่ 13/03/2568', 2, '2025-03-19 22:23:59', '2025-03-19 22:05:56'),
(80, 'f5522810-04d3-11f0-a87c-2ad6c30b0fff', 80, 7, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ของที่มาส่งเพิ่ทวันที่ 13/03/2568', 2, '2025-03-19 22:22:52', '2025-03-19 22:08:04'),
(81, '3e57f32d-04d4-11f0-a87c-2ad6c30b0fff', 81, 7, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ของที่รับมาเพิ่มวันที่ 13/03/2568', 2, '2025-03-19 22:20:52', '2025-03-19 22:10:07'),
(82, '8ebad3b5-04d4-11f0-a87c-2ad6c30b0fff', 82, 7, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ของที่มาส่งเพิ่มวันที่ 13/03/2568', 2, '2025-03-19 22:22:30', '2025-03-19 22:12:22'),
(83, 'def622f2-04d4-11f0-a87c-2ad6c30b0fff', 83, 7, 1, '2025-03-19', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ของที่มาส่งเพิ่มวันที่13/03/2568', 2, '2025-03-19 22:24:23', '2025-03-19 22:14:36'),
(84, 'd6a9b821-055e-11f0-a87c-2ad6c30b0fff', 84, 7, 1, '2025-03-20', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, 'ของที่ลูกค้ามาส่งวันนี้ค่ะ', 2, '2025-03-20 14:43:58', '2025-03-20 14:42:13'),
(85, 'cdef8519-055f-11f0-a87c-2ad6c30b0fff', 85, 7, 2, '2025-03-20', '21/03/2025 - 25/03/2025', '2025-03-21', '2025-03-25', 'MU Hail Night มหิดล', 'พี่เก๋', 'โกดังสาทร', 'ม.มหิดล ศาลายา', 0, 'เพื่อออกบูธ', 1, NULL, '2025-03-20 14:49:08'),
(86, '39fb6a1d-0562-11f0-a87c-2ad6c30b0fff', 86, 8, 2, '2025-03-21', '24/03/2025 - 24/03/2025', '2025-03-24', '2025-03-24', 'Garnier UV Roadshow', 'เก๋', 'โกดังสาทร', 'มหาวิทยาลัยมหิดล', 0, 'งาน Garnier UV Roadshow มหาวิทยาลัยมหิดล', 1, NULL, '2025-03-20 15:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `uuid`, `username`, `email`, `password`, `level`, `status`, `updated`, `created`) VALUES
(1, '8578263a-d0ae-11ef-91c3-0242ac120002', 'admin.test', 'admin@test.com', '$2y$10$W08w.crPDLXzroZDNFirJObaHK91H.0D7ZszaRR6iQQi9W32.tnci', 9, 1, '2025-03-11 20:15:32', '2023-11-23 09:42:54'),
(2, '857827b5-d0ae-11ef-91c3-0242ac120002', '', 'user@test.com', '$2y$10$jwAmc2BoS2EwrzfL2LkYOel9FZHc9LSbRn4sge.SvmPiOyjoSgLVq', 1, 1, '2025-02-11 00:38:49', '2025-01-03 08:42:52'),
(3, '088ace55-e80f-11ef-8583-2ad6c30b0fff', '', 'n0866881414@gmail.com', '$2y$10$wH1zRiGz7/.zwlccIxlKoOW2Ph2g061zMc5PBs9a.5zaYhOCH9XpO', 1, 1, '2025-02-11 00:39:00', '2025-02-11 00:27:53'),
(4, '333f7a89-e80f-11ef-8583-2ad6c30b0fff', '', 'acount@test.com', '$2y$10$PWvUBBWbA.X8Z6sK1.g9jOAesSlGUgIVUMGaJQwY3yYiBnGsUKRre', 1, 1, '2025-02-11 00:39:21', '2025-02-11 00:29:05'),
(5, '7313af95-e810-11ef-8583-2ad6c30b0fff', 'store', 'store@test.com', '$2y$10$AFRyl5Hh9/sGPXMbyuA/Bum78re.OqMxnWPS2J8Rn.ca4R9ppm4da', 1, 1, '2025-02-17 11:18:15', '2025-02-11 00:38:01'),
(6, '7bc14cfa-e868-11ef-8583-2ad6c30b0fff', '', 'jutamas.pu@test.com', '$2y$10$RlzJAiuhr0uZmr3XEC/unuuP5bKENxpuqeOfZ408S3qey60si.e72', 1, 1, '2025-02-13 07:41:29', '2025-02-11 11:08:12'),
(7, '967c4eaf-e868-11ef-8583-2ad6c30b0fff', '', 'supanida.ja@test.com', '$2y$10$pkvurqhgZowu8eCRfcURE.XDkj4nkWXezT8cqxCQ66WwYbDyzo5t.', 1, 1, '2025-02-13 07:48:55', '2025-02-11 11:08:57'),
(8, 'a6193884-e868-11ef-8583-2ad6c30b0fff', '', 'kamonwan.su@test.com', '$2y$10$1acy0dPFTfWspyBU.bOodeyxT9V0JHFl5WNkakH4CeCnnWAB4dWhS', 1, 1, '2025-03-20 18:55:15', '2025-02-11 11:09:23'),
(9, 'b3949d98-e868-11ef-8583-2ad6c30b0fff', '', 'thaipat.me@test.com', '$2y$10$1aGlCnD4SlcGCwzU2TmGHuYbKmLWPlaQCEcvtRjFNrl.nWXOd1JFW', 1, 1, '2025-02-13 07:50:16', '2025-02-11 11:09:45'),
(10, 'c1ce63be-e868-11ef-8583-2ad6c30b0fff', '', 'emika.ar@test.com', '$2y$10$ndlgSQz1231CGFXwRruPLORQjhtc5VheVBilXZ0T1tokkBCrsp4w2', 1, 1, '2025-02-13 07:49:56', '2025-02-11 11:10:09'),
(11, 'ce2f3f16-e868-11ef-8583-2ad6c30b0fff', '', 'phichayapha.bu@test.com', '$2y$10$1LqOGFQM9pq30NKOLEGrkeM./Fs3bXwIIkMakjY74n2HurC60ioCy', 1, 1, '2025-02-13 07:48:20', '2025-02-11 11:10:30'),
(12, 'db468f94-e868-11ef-8583-2ad6c30b0fff', '', 'charuwan.bo@test.com', '$2y$10$vidiV3dSnSaCUUqQls5.9O7aX66eOwV5u6x1/3guMuqNcjd/lIRDa', 1, 1, '2025-02-13 07:42:53', '2025-02-11 11:10:52'),
(13, 'e83837b7-e868-11ef-8583-2ad6c30b0fff', '', 'boonyakorn.be@test.com', '$2y$10$1R8E0nyEqq8YmiCf7ySkouECesAyEYQzqB7fKVC5/CuS.xhvKkHMq', 1, 1, '2025-02-13 07:43:29', '2025-02-11 11:11:14'),
(14, 'fd5dd5d9-e868-11ef-8583-2ad6c30b0fff', '', 'jakawan.ch@test.com', '$2y$10$DHf9sF7RA/mOuhl5Ec.aD.LBO45SPb7bB0K3A7A.Ro6Cvpxw5gXja', 1, 1, '2025-02-13 07:42:30', '2025-02-11 11:11:49'),
(15, 'd06a19f1-e869-11ef-8583-2ad6c30b0fff', '', 'arthid.na@test.com', '$2y$10$.7dOngLcasBWq5HU1h1MV.I9MKO6oDEz0cw/7nZAuuD9LGJQu.XAm', 1, 1, '2025-02-13 07:49:33', '2025-02-11 11:17:43'),
(16, 'ef7d1fc6-e869-11ef-8583-2ad6c30b0fff', '', 'phadung.bo@test.com', '$2y$10$85.aIJqQN.Ad/iT9wj60Nuxb3fvo.6rg4iGU0v6BDBmiIe6PfM7nC', 1, 1, '2025-02-13 07:47:45', '2025-02-11 11:18:35'),
(17, '887b64c0-e9df-11ef-8583-2ad6c30b0fff', 'onuma.th', 'onuma.th@test.com', '$2y$10$0jmZsM.7VX3Ro/B0KuLHT.PNZgvN.VFwt8muVDrAOwhXKW8WGXZAy', 9, 1, '2025-02-20 09:38:38', '2025-02-13 07:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `outstanding_file`
--

CREATE TABLE `outstanding_file` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outstanding_file`
--

INSERT INTO `outstanding_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(3, 1, '8d3ca723dec771d73d19696ffbd18431.pdf', 1, NULL, '2025-03-20 19:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `outstanding_item`
--

CREATE TABLE `outstanding_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estimate` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outstanding_item`
--

INSERT INTO `outstanding_item` (`id`, `request_id`, `name`, `amount`, `unit`, `estimate`, `status`, `updated`, `created`) VALUES
(1, 1, '[ค่าเดินทาง] aaaa aaa', 1, '', '3000.00', 1, '2025-03-20 19:46:03', '2025-03-19 20:22:54'),
(2, 1, '[ค่าที่พัก] bbbb bbb', 1, '', '4000.00', 1, '2025-03-20 19:46:03', '2025-03-19 20:22:54'),
(3, 1, '[ค่าอาหาร] cccc ccc', 1, '', '2000.00', 1, '2025-03-20 19:46:03', '2025-03-19 20:22:54'),
(8, 1, 'Notebook', 2, 'เครื่อง', '20000.00', 0, '2025-03-20 19:43:02', '2025-03-20 19:41:54'),
(9, 1, 'Notebook', 2, 'เครื่อง', '20000.00', 1, '2025-03-20 19:46:03', '2025-03-20 19:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `outstanding_remark`
--

CREATE TABLE `outstanding_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outstanding_remark`
--

INSERT INTO `outstanding_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-03-20 20:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `outstanding_request`
--

CREATE TABLE `outstanding_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `doc_date` date NOT NULL,
  `order_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outstanding_request`
--

INSERT INTO `outstanding_request` (`id`, `uuid`, `last`, `login_id`, `department_number`, `doc_date`, `order_number`, `text`, `action`, `status`, `updated`, `created`) VALUES
(1, '445fc415-04c5-11f0-91e9-0242ac120003', 1, 1, 'IT-680004', '2025-03-20', 'SO-680001', 'testtest\ntesttest', 1, 2, '2025-03-20 20:00:53', '2025-03-19 20:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_file`
--

CREATE TABLE `payment_file` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_file`
--

INSERT INTO `payment_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 2, '815c143ae5911cbd7e9369bbe3ffa1f4.webp', 1, NULL, '2025-03-20 16:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_item`
--

CREATE TABLE `payment_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `expense_id` int NOT NULL,
  `text` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `wt` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_item`
--

INSERT INTO `payment_item` (`id`, `request_id`, `expense_id`, `text`, `text2`, `amount`, `vat`, `wt`, `status`, `updated`, `created`) VALUES
(1, 1, 5, 'บูธ ป้าย', 'บูธ 50000 ป้าย 20000', '70000.00', '0.00', '0.00', 1, NULL, '2025-03-20 12:13:23'),
(2, 1, 6, 'ขาไป', 'รถตู้ 2 คัน 1500', '3000.00', '0.00', '0.00', 1, NULL, '2025-03-20 12:13:23'),
(3, 1, 15, 'เสื้อ 200', 'เสื้อตัวละ 200', '4000.00', '0.00', '0.00', 1, NULL, '2025-03-20 12:13:23'),
(4, 2, 5, 'งานโครงสร้าง', 'ขนาด 1 x 1', '100.00', '7.00', '0.00', 1, NULL, '2025-03-20 16:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `payment_remark`
--

CREATE TABLE `payment_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_remark`
--

INSERT INTO `payment_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-03-20 12:16:15'),
(2, 1, 1, '', 3, '2025-03-20 12:16:28'),
(3, 1, 1, '', 4, '2025-03-20 12:16:37'),
(4, 2, 2, 'ไม่ได้แนบเอกสาร', 1, '2025-03-20 16:56:04'),
(5, 2, 2, '', 2, '2025-03-20 16:57:13'),
(6, 2, 2, '', 3, '2025-03-20 16:57:41'),
(7, 2, 2, 'อนุมัติ', 4, '2025-03-20 16:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doc_date` date NOT NULL,
  `order_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `receiver` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL,
  `cheque_bank` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cheque_branch` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cheque_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `uuid`, `last`, `login_id`, `department_number`, `doc_date`, `order_number`, `receiver`, `type`, `cheque_bank`, `cheque_branch`, `cheque_number`, `cheque_date`, `action`, `status`, `updated`, `created`) VALUES
(1, '0c1c3544-054a-11f0-a87c-2ad6c30b0fff', 1, 1, 'MKt22222', '2025-03-20', 'so 45566', 'teerapat', 1, '', '', '', '1970-01-01', 1, 4, '2025-03-20 12:16:37', '2025-03-20 12:13:23'),
(2, 'cc26505c-0570-11f0-a87c-2ad6c30b0fff', 2, 2, 'PV-6800XX', '2025-03-20', 'SO68030017', 'นาย A', 1, '', '', '', '1970-01-01', 1, 4, '2025-03-20 16:57:59', '2025-03-20 16:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `petty_file`
--

CREATE TABLE `petty_file` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petty_item`
--

CREATE TABLE `petty_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `text` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petty_remark`
--

CREATE TABLE `petty_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petty_request`
--

CREATE TABLE `petty_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doc_date` date NOT NULL,
  `objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `name_th` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name_en` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount_min` int NOT NULL,
  `amount_max` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name_th`, `name_en`, `amount_min`, `amount_max`, `status`, `updated`, `created`) VALUES
(1, 'ผู้จัดการฝ่าย/หัวหน้าแผนก', 'Manager', 1, 50000, 1, '2025-03-14 10:10:31', '2025-03-14 10:09:17'),
(2, 'ผู้อำนวยการฝ่าย', 'Director', 50001, 100000, 1, NULL, '2025-03-14 10:09:53'),
(3, 'ประธานเจ้าหน้าที่', 'Chief', 100001, 500000, 1, NULL, '2025-03-14 10:12:51'),
(4, 'ประธานเจ้าหน้าที่บริหาร', 'CEO', 500001, 5000000, 1, NULL, '2025-03-14 10:14:55'),
(5, 'คณะกรรมการบริหาร', 'Excom', 5000001, 10000000, 1, NULL, '2025-03-14 10:15:27'),
(6, 'คณะกรรมการบริษัท', 'Board', 10000000, 100000000, 1, NULL, '2025-03-14 10:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type_id` int NOT NULL,
  `warehouse_id` int NOT NULL,
  `location_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `uuid`, `name`, `code`, `type_id`, `warehouse_id`, `location_id`, `brand_id`, `unit_id`, `text`, `status`, `updated`, `created`) VALUES
(1, 'e69deff0-e69d-11ef-8e45-0242ac120003', 'Scotch', '', 1, 1, 2, 1, 2, 'Note B-1', 1, '2025-02-24 15:16:02', '2025-02-09 11:25:32'),
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
(52, '5e82335c-ef3e-11ef-852d-2ad6c30b0fff', 'lotte xylitol Sampling', '', 5, 1, 5, 0, 2, 'Note E-3', 1, '2025-02-24 14:11:34', '2025-02-20 03:54:22'),
(53, '8e1632b4-ef6d-11ef-852d-2ad6c30b0fff', 'Dutcmill Blue Hawaii', '', 1, 1, 3, 0, 2, 'Note C-3 จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:20:06', '2025-02-20 09:32:08'),
(54, 'e794aa7f-ef6d-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 less sugar 40% Strawberry', '', 1, 1, 3, 0, 2, 'Note C-3  จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:22:32', '2025-02-20 09:34:38'),
(55, '7241fec8-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 less sugar 40% Mixed Fruit', '', 1, 1, 3, 0, 2, 'Note C-3  จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:22:42', '2025-02-20 09:38:31'),
(56, '97c66f49-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 Mixed Fruit', '', 1, 1, 3, 0, 2, 'Note C-7  จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:22:16', '2025-02-20 09:39:34'),
(57, 'c661f8a4-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill 4 in 1 Orange', '', 1, 1, 3, 0, 2, 'Note C-7 จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:19:20', '2025-02-20 09:40:52'),
(58, 'ed01dafc-ef6e-11ef-852d-2ad6c30b0fff', 'Dutchmill Goody fiber', '', 1, 1, 3, 0, 2, 'Note C-5 จำนวนสินค้าเป็น ลัง', 1, '2025-02-20 10:19:00', '2025-02-20 09:41:57'),
(59, 'e2f47b85-f268-11ef-af74-2ad6c30b0fff', 'Tissue Lotte Xylitol', '', 5, 1, 5, 0, 2, 'Note E-5', 1, '2025-02-24 14:11:57', '2025-02-24 11:36:16'),
(60, '3efaaf8e-f299-11ef-af74-2ad6c30b0fff', 'test no1', '', 5, 1, 0, 9, 2, '', 1, NULL, '2025-02-24 17:22:27'),
(61, '2a21da8e-f29a-11ef-af74-2ad6c30b0fff', 'ถุงผ้า It\'s Match', '', 2, 1, 0, 9, 2, 'รายการนำเข้า 1,400  แก้ไขตัวเลขใหม่', 2, '2025-02-24 22:05:02', '2025-02-24 17:29:01'),
(62, '56e878df-f29a-11ef-af74-2ad6c30b0fff', 'ยาดม', '', 5, 1, 0, 9, 2, '', 1, NULL, '2025-02-24 17:30:16'),
(63, 'ccb716e4-f29a-11ef-af74-2ad6c30b0fff', 'sticker', '', 5, 1, 0, 9, 2, '', 1, NULL, '2025-02-24 17:33:34'),
(64, 'dd7e6b8e-f29a-11ef-af74-2ad6c30b0fff', 'Note book (สมุดโน๊ต)', '', 5, 1, 0, 9, 2, '', 1, NULL, '2025-02-24 17:34:02'),
(65, '736aae96-f2c1-11ef-af74-2ad6c30b0fff', 'ถุงผ้า It\'s Match', '', 2, 1, 0, 9, 2, '', 1, NULL, '2025-02-24 22:10:15'),
(66, '0b83d1e6-f32a-11ef-af74-2ad6c30b0fff', 'ดัชมิลล์ 4 in 1 น้ำตาลน้อย 165 มล. รถสตอเบอรี่', '7DY1651LSO', 1, 1, 0, 0, 2, 'สินค้าสำหรับกระจายส่ง', 1, NULL, '2025-02-25 10:38:57'),
(67, '674aa098-f32a-11ef-af74-2ad6c30b0fff', 'ดัชมิลล์ 4 in 1 น้ำตาลน้อย 165 มล. รถผลไม้รวม', '7DY1651LMO', 1, 1, 0, 0, 2, 'สินค้าสำหรับกระจาย', 1, NULL, '2025-02-25 10:41:31'),
(68, '3f53422e-f33f-11ef-af74-2ad6c30b0fff', 'เปปทีน พลัส  100ml 1x4x6 SHRINK NPL 10000459', '10000924', 1, 1, 0, 10, 1, 'ของมาทั้งหมด 834 ลัง \r\nของสำหรับส่งงานฝั่งมิเดีย', 1, '2025-02-25 14:03:35', '2025-02-25 13:10:44'),
(69, '6a6bfb3e-f35b-11ef-af74-2ad6c30b0fff', 'แฟ้มผ้าใส่เอกสาร (สีเทา)', '', 5, 1, 0, 9, 2, 'แฟ้มผ้างาน jobsDB สีเทา', 1, NULL, '2025-02-25 16:32:22'),
(70, '146f4069-f35c-11ef-af74-2ad6c30b0fff', 'Rabbit Card', '', 5, 1, 0, 9, 2, 'บัตร Rabbit งาน JobsDB', 1, NULL, '2025-02-25 16:37:07'),
(71, '13e1cb62-fe61-11ef-af74-2ad6c30b0fff', 'photocard Bus UV set', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-11 17:10:37'),
(72, 'a7f9ad7d-ff26-11ef-af74-2ad6c30b0fff', 'ซูเปอร์ ยูวี อินวิซิเบิ้ล มิซ 75 มล', '', 4, 1, 0, 0, 1, '', 1, NULL, '2025-03-12 16:44:56'),
(73, 'dbf10019-ff26-11ef-af74-2ad6c30b0fff', 'กันแดด ยูวี อินวิซิเบิ้ล 30 มล.', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-12 16:46:23'),
(74, '2b9fedf0-ff28-11ef-af74-2ad6c30b0fff', 'ยูวี เซรั่ม สินค้าทดลอง', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-12 16:55:46'),
(75, '9863fe32-ffc3-11ef-af74-2ad6c30b0fff', 'Vichy Dercos แชมพูซองเขียวขาว', '', 3, 1, 0, 0, 2, '', 1, NULL, '2025-03-13 11:28:21'),
(76, '44c9587e-ffc5-11ef-af74-2ad6c30b0fff', 'LRP ดูโอ้(+) ซองสีขาวฟ้า', '', 4, 1, 0, 0, 2, 'สินค้าชื่อเต็ม : LA ROCHE-POSAY เอฟฟาคลาร์ ดูโอ้(+)', 1, NULL, '2025-03-13 11:40:19'),
(77, 'd405443e-ffc5-11ef-af74-2ad6c30b0fff', 'LRP ยูวีมูน', '', 4, 1, 0, 0, 2, 'สินค้าชื่อเต็ม : LA ROCHE POSAY แอนเทลิโอส ยูวีมูน ดรายทัช', 1, NULL, '2025-03-13 11:44:20'),
(78, '3b95c4c0-02fe-11f0-af74-2ad6c30b0fff', 'Simple Card CRV', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-17 14:05:39'),
(79, '88b5f19f-04a4-11f0-a87c-2ad6c30b0fff', 'Garnier Natural 1.0 (สีดำธรรมชาติ)', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 16:28:36'),
(80, 'e397ce26-04a4-11f0-a87c-2ad6c30b0fff', 'Garnier Natural 3.0 (สีน้ำตาลเข้ม)', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 16:31:08'),
(81, 'fa288874-04a4-11f0-a87c-2ad6c30b0fff', 'Garnier Natural 4.0 (สีน้ำตาล)', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 16:31:46'),
(82, '127473e9-04a5-11f0-a87c-2ad6c30b0fff', 'Garnier Natural 5.32 (สีน้ำตาลคาราเมล)', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 16:32:27'),
(83, '43a51490-04b6-11f0-a87c-2ad6c30b0fff', 'ดัชมิลล์ 4 in 1 น้ำตาลน้อย 90มล. สตอเบอรี่', '7KI0901LSS', 1, 1, 0, 0, 2, '48 ชิ้น / กล่อง', 1, NULL, '2025-03-19 18:35:31'),
(84, '6255b328-04b6-11f0-a87c-2ad6c30b0fff', 'ดัชมิลล์ 4 in 1 น้ำตาลน้อย 90มล. ผลไม้รวม', '7KI0901LMS', 1, 1, 0, 0, 2, '48 ชิ้น / กล่อง', 1, NULL, '2025-03-19 18:36:22'),
(85, 'f2f15c3c-04b9-11f0-a87c-2ad6c30b0fff', 'ฺBRIGHT COMPLETE BOOTER SERUM 30x VITAMINC+', '', 4, 1, 0, 11, 1, '', 1, NULL, '2025-03-19 19:01:53'),
(86, '2896b746-04ba-11f0-a87c-2ad6c30b0fff', 'ไบรท์ คอมพลีท 30x วิตามีซี+ บูสเตอร์ เซรั่ม', '', 4, 1, 0, 11, 2, '6 ซอง/กล่อง', 1, NULL, '2025-03-19 19:03:23'),
(87, '0516040e-04ca-11f0-a87c-2ad6c30b0fff', 'Garnier Natural 7.3 (สีน้ำตาลประกายทอง)', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 20:56:56'),
(88, '20b67128-04ca-11f0-a87c-2ad6c30b0fff', 'Garnier Natural 7.65 (สีแดงราสเบอร์รี่)', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 20:57:42'),
(89, '2d7d968e-04ca-11f0-a87c-2ad6c30b0fff', 'Garnier Natural ชมพูพาสเทล', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 20:58:04'),
(90, '38308cb9-04ca-11f0-a87c-2ad6c30b0fff', 'Garnier Natural คูลแอช', '', 6, 1, 0, 11, 2, '', 1, NULL, '2025-03-19 20:58:22'),
(91, 'e0ea1480-04d3-11f0-a87c-2ad6c30b0fff', 'Blemish Cleanser CRV', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-19 22:07:30'),
(92, '1cd91166-04d4-11f0-a87c-2ad6c30b0fff', 'Facial Mois Lotion CRV', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-19 22:09:11'),
(93, '6a53ee19-04d4-11f0-a87c-2ad6c30b0fff', 'Intensive Mois Lotion CRV', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-19 22:11:21'),
(94, 'b5662eee-04d4-11f0-a87c-2ad6c30b0fff', 'CRV ตัวทดลองขนาดจริง', '', 4, 1, 0, 0, 1, 'แพ็คใส่กล่องเดียวกันเท่านั้น ห้ามแยก เพราะมันคือชุดเดียวกันค่ะ', 1, NULL, '2025-03-19 22:13:27'),
(95, '9a9e66e4-055e-11f0-a87c-2ad6c30b0fff', 'CRV Sample cards Mois Cream Lotion', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-20 14:40:32'),
(96, 'a5274b4d-055e-11f0-a87c-2ad6c30b0fff', 'CRV ACNE CLEANSER SA 0.05OZ', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-20 14:40:50'),
(97, 'ad0cbc30-055e-11f0-a87c-2ad6c30b0fff', 'LRP EFF DUO+M CR SA 2ML INTER', '', 4, 1, 0, 0, 2, '', 1, NULL, '2025-03-20 14:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(9, 'JobDB', 1, NULL, '2025-02-17 08:51:46'),
(10, 'Peptein', 1, NULL, '2025-02-25 14:03:11'),
(11, 'Garnier', 1, NULL, '2025-03-19 16:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_file`
--

CREATE TABLE `product_file` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(10, 58, 'f262eb90b2f8a8346a6aa34924fbe804.webp', 1, NULL, '2025-02-20 09:41:57'),
(11, 59, '699ab187bb05d373579763cf637a538a.webp', 1, NULL, '2025-02-24 11:36:17'),
(12, 66, '63a969d5f2ce068ffa79092039bb9998.webp', 1, NULL, '2025-02-25 10:38:58'),
(13, 67, '2189ebd6b17f71e4531872eafcfb8fb1.webp', 1, NULL, '2025-02-25 10:41:32'),
(14, 68, '4bf1cc8830deb49fa7a750deb18ef85f.webp', 1, NULL, '2025-02-25 13:10:44'),
(15, 71, '08aec761e3426142e4ba6b39c0539aca.webp', 1, NULL, '2025-03-11 17:10:37'),
(16, 75, '3f3d8d60c3e8782ee1de53b7c3abda87.webp', 1, NULL, '2025-03-13 11:28:21'),
(17, 76, '9cb9c8165de61cc8d663ca4e3501e3d1.webp', 1, NULL, '2025-03-13 11:40:20'),
(18, 77, '61e574f3d2f9ea671930173e93a3a61a.webp', 1, NULL, '2025-03-13 11:44:20'),
(19, 78, '594c78ba788ce5953feb46aa61e5c465.webp', 1, NULL, '2025-03-17 14:05:39'),
(20, 79, '5ff379a2d23a09912906e34316aa2dec.webp', 1, NULL, '2025-03-19 16:28:36'),
(21, 80, '83b318ab810b1a95106b01a56eec88aa.webp', 1, NULL, '2025-03-19 16:31:08'),
(22, 81, '600c4321b645bf227a5a3ea3b8777aba.webp', 1, NULL, '2025-03-19 16:31:46'),
(23, 82, '87be0a44b0af6d108ca8e04f4752e64e.webp', 1, NULL, '2025-03-19 16:32:27'),
(24, 83, '6a6fb52f513f270222cb2934d4bac952.webp', 1, NULL, '2025-03-19 18:35:31'),
(25, 84, '8bfb802421f4fbdd0561fd6e9566dfe6.webp', 1, NULL, '2025-03-19 18:36:23'),
(26, 85, '28c57b5c714b52fb2290593f4a83cca8.webp', 1, NULL, '2025-03-19 19:01:54'),
(27, 86, '4f56295230d3e30d34bd0e9be550646e.webp', 1, NULL, '2025-03-19 19:03:24'),
(28, 87, 'c67686258cdfbf4eb3cd271c7849a7dc.webp', 1, NULL, '2025-03-19 20:56:56'),
(29, 88, '7e709b0e7dba4d5e5eb2b72ef286d155.webp', 1, NULL, '2025-03-19 20:57:42'),
(30, 89, '5ee966a1a31c022c890e3ae8f40b2f9e.webp', 1, NULL, '2025-03-19 20:58:04'),
(31, 90, '13203efe299ed2f7e804617b59297104.webp', 1, NULL, '2025-03-19 20:58:22'),
(32, 91, '1b5dbcacf722a5d635f9cd0f5adfe5f9.webp', 1, NULL, '2025-03-19 22:07:30'),
(33, 92, '6044a72de8ddb2ec6759b09e55896b89.webp', 1, NULL, '2025-03-19 22:09:11'),
(34, 93, 'a0a12a8af6e6835355fe23e9c9431e39.webp', 1, NULL, '2025-03-19 22:11:21'),
(35, 94, '299f041cd7e28052dce520ef9077168b.webp', 1, NULL, '2025-03-19 22:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_location`
--

CREATE TABLE `product_location` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `status`, `updated`, `created`) VALUES
(1, 'เครื่องดื่ม', 1, NULL, '2025-02-08 22:54:40'),
(2, 'กระเป๋า', 1, NULL, '2025-02-08 22:55:10'),
(3, 'ผลิตภัณฑ์ดูแลผม', 1, '2025-02-08 23:00:11', '2025-02-08 22:58:56'),
(4, 'ผลิตภัณฑ์ดูแลผิวหน้า', 1, NULL, '2025-02-17 08:48:15'),
(5, 'พรีเมี่ยม', 1, NULL, '2025-02-18 04:09:56'),
(6, 'ผลิตภัณฑ์ครีมเปลี่ยนสีผม', 1, NULL, '2025-03-19 16:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estimate` decimal(20,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `request_id`, `name`, `amount`, `unit`, `estimate`, `status`, `updated`, `created`) VALUES
(1, 1, 'เก้าอี้สำนักงาน', 5, 'ชิ้น', '4500.00', 1, '2025-03-20 11:19:56', '2025-03-20 10:52:36'),
(2, 1, 'Monitor', 3, 'ชิ้น', '10000.00', 1, '2025-03-20 11:19:56', '2025-03-20 10:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_remark`
--

CREATE TABLE `purchase_remark` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `login_id` int NOT NULL,
  `text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_remark`
--

INSERT INTO `purchase_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-03-20 11:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `department_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doc_date` date NOT NULL,
  `department` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `order_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`id`, `uuid`, `last`, `login_id`, `department_number`, `doc_date`, `department`, `date`, `order_number`, `objective`, `action`, `status`, `updated`, `created`) VALUES
(1, 'c2a1b7b5-053e-11f0-a87c-2ad6c30b0fff', 1, 1, 'IT6677', '2025-03-20', 'ตลาด', '2025-03-24', '', 'ดำเนินการตาม รายการ ที่จะใช้งานจริง', 1, 2, '2025-03-20 11:51:56', '2025-03-20 10:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_file`
--

CREATE TABLE `quotation_file` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_item`
--

CREATE TABLE `quotation_item` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `product` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `discount` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_request`
--

CREATE TABLE `quotation_request` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last` int NOT NULL,
  `login_id` int NOT NULL,
  `doc_date` date NOT NULL,
  `biller_id` int NOT NULL,
  `customer_type` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sequence` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `uuid`, `sequence`, `name`, `url`, `status`, `updated`, `created`) VALUES
(1, 'cf1bf169-e929-11ef-9523-0242ac120005', 1, 'ระบบใบ Estimate Budget', '/estimate', 1, '2025-03-20 20:22:06', '2025-02-12 20:37:08'),
(2, 'cf1c7170-e929-11ef-9523-0242ac120005', 2, 'ระบบใบขอซื้อ', '/purchase', 1, '2025-03-20 20:22:06', '2025-02-12 20:37:08'),
(3, 'cf1cfac9-e929-11ef-9523-0242ac120005', 3, 'ระบบใบอนุมัติสั่งจ่าย', '/payment', 1, '2025-03-20 20:22:06', '2025-02-12 20:37:08'),
(4, 'cf1d4709-e929-11ef-9523-0242ac120005', 5, 'ระบบใบขอเคลียร์', '/advance-clear', 1, '2025-03-20 20:22:06', '2025-02-12 20:37:08'),
(5, 'cf1d9368-e929-11ef-9523-0242ac120005', 9, 'ระบบยืมทรัพย์สิน', '/borrow', 1, '2025-03-20 20:22:06', '2025-02-12 20:37:08'),
(6, 'cf1ddb6a-e929-11ef-9523-0242ac120005', 10, 'ระบบนำเข้า-เบิกออก', '/issue', 1, '2025-03-20 20:22:06', '2025-02-12 20:37:08'),
(7, '680848cb-ed18-11ef-852d-2ad6c30b0fff', 11, 'ข้อมูลทรัพย์สิน', '/asset', 1, '2025-03-20 20:22:06', '2025-02-17 10:17:35'),
(8, '6808cf6e-ed18-11ef-852d-2ad6c30b0fff', 12, 'ข้อมูลสินค้า', '/product', 1, '2025-03-20 20:22:06', '2025-02-17 10:17:35'),
(9, 'c83e08b2-ed19-11ef-852d-2ad6c30b0fff', 13, 'ข้อมูลรายจ่าย', '/expense', 1, '2025-03-20 20:22:06', '2025-02-17 10:27:26'),
(10, 'c83ebb45-ed19-11ef-852d-2ad6c30b0fff', 14, 'ข้อมูลลูกค้า', '/customer', 1, '2025-03-20 20:22:06', '2025-02-17 10:27:26'),
(11, '80a0d3c2-ed36-11ef-9de3-0242ac120005', 4, 'ระบบใบขอเบิก', '/advance', 1, '2025-03-20 20:22:06', '2025-02-17 20:52:59'),
(12, '29716cc4-ed4a-11ef-9de3-0242ac120005', 6, 'ระบบใบเบิกเงินสดย่อย', '/petty', 1, '2025-03-20 20:22:06', '2025-02-17 23:13:42'),
(13, '2971ed4f-ed4a-11ef-9de3-0242ac120005', 7, 'ระบบใบค้างจ่าย', '/outstanding', 1, '2025-03-20 20:22:06', '2025-02-17 23:13:42'),
(14, 'd9a60cd4-ed4b-11ef-9de3-0242ac120005', 8, 'ระบบใบเสนอราคา', '/quotation', 1, '2025-03-20 20:22:06', '2025-02-17 23:25:48'),
(15, 'd9a65f95-ed4b-11ef-9de3-0242ac120005', 9, 'ระบบใบรับมอบงาน', '/job', 2, '2025-03-20 20:19:54', '2025-02-17 23:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_authorize`
--

CREATE TABLE `service_authorize` (
  `id` int NOT NULL,
  `login_id` int NOT NULL,
  `service` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_authorize`
--

INSERT INTO `service_authorize` (`id`, `login_id`, `service`, `updated`, `created`) VALUES
(1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-03-20 20:25:53', '2025-02-12 18:37:02'),
(2, 2, '1,1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-03-20 20:26:03', '2025-02-12 18:53:10'),
(3, 5, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-03-20 20:24:09', '2025-02-12 14:11:37'),
(4, 3, '1,1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-03-20 20:26:15', '2025-02-13 02:41:47'),
(5, 4, '1,1,1,1,1,1,1,1,1,1,1,1,1,1', '2025-03-20 20:26:35', '2025-02-13 02:42:35'),
(6, 6, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:03', '2025-02-13 02:42:37'),
(7, 7, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:09', '2025-02-13 02:42:38'),
(8, 8, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:16', '2025-02-13 02:42:42'),
(9, 9, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:22', '2025-02-13 02:42:43'),
(10, 10, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:28', '2025-02-13 02:43:17'),
(11, 11, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:33', '2025-02-13 02:43:21'),
(12, 12, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:37', '2025-02-13 02:43:25'),
(13, 13, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:44', '2025-02-13 02:43:29'),
(14, 14, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:48', '2025-02-13 02:43:32'),
(15, 15, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:53', '2025-02-13 02:43:38'),
(16, 16, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:40:57', '2025-02-13 02:43:43'),
(17, 17, '0,0,0,0,0,0,0,0,1,1,1,1,0,0', '2025-02-18 03:41:01', '2025-02-13 08:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_default` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
  `id` int NOT NULL,
  `login` int NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` int NOT NULL,
  `position_id` int NOT NULL,
  `manager_id` int DEFAULT NULL,
  `manager_id2` int DEFAULT NULL,
  `contact` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `firstname`, `lastname`, `department_id`, `position_id`, `manager_id`, `manager_id2`, `contact`) VALUES
(1, 1, 'Admin', 'System', 1, 0, 1, 2, ''),
(2, 2, 'User', 'System', 0, 0, 5, 0, ''),
(3, 3, 'ธีรพัฒน์', 'ทองสุโชติ', 0, 0, 5, 0, 'Admin'),
(4, 4, 'บัญชี', 'บัญชี', 0, 0, 5, 0, '044444'),
(5, 5, 'คลังสินค้า', 'คลังสินค้า', 0, 0, 1, 0, 'คลังสินค้า'),
(6, 6, 'จุฑามาศ', 'พันธุ์สกุล', 0, 0, 2, 0, ''),
(7, 7, 'สุภนิดา', 'จันทร์หอม', 0, 0, 2, 0, ''),
(8, 8, 'กมลวรรณ', 'สุขสำราญ', 0, 0, 2, 0, ''),
(9, 9, 'ไธพัตย์', 'เมฆจรัสวิทย์', 0, 0, 2, 0, ''),
(10, 10, 'เอมิกา', 'อรุณสิคะพันธ์', 0, 0, 2, 0, ''),
(11, 11, 'พิชญาภา', 'บุญมา', 0, 0, 2, 0, ''),
(12, 12, 'จารุวรรณ', 'บุญยาน', 0, 0, 2, 0, ''),
(13, 13, 'บุญญากร', 'เบ็ญสตาล', 0, 0, 2, 0, ''),
(14, 14, 'จักรวาล', 'จันทร์นุช', 0, 0, 5, 0, ''),
(15, 15, 'อาทิตย์', 'นาพรม', 0, 0, 5, 0, ''),
(16, 16, 'ผดุง', 'บุญส่ง', 0, 0, 5, 0, ''),
(17, 17, 'อรอุมา', 'ทองช้อย', 0, 0, 1, 0, '');

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
-- Indexes for table `department`
--
ALTER TABLE `department`
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
-- Indexes for table `outstanding_file`
--
ALTER TABLE `outstanding_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outstanding_item`
--
ALTER TABLE `outstanding_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outstanding_remark`
--
ALTER TABLE `outstanding_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outstanding_request`
--
ALTER TABLE `outstanding_request`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `position`
--
ALTER TABLE `position`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_clear_item`
--
ALTER TABLE `advance_clear_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_clear_remark`
--
ALTER TABLE `advance_clear_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_clear_request`
--
ALTER TABLE `advance_clear_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_file`
--
ALTER TABLE `advance_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_item`
--
ALTER TABLE `advance_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_remark`
--
ALTER TABLE `advance_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_request`
--
ALTER TABLE `advance_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `asset_brand`
--
ALTER TABLE `asset_brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `asset_file`
--
ALTER TABLE `asset_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `asset_location`
--
ALTER TABLE `asset_location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset_type`
--
ALTER TABLE `asset_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `asset_unit`
--
ALTER TABLE `asset_unit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `asset_warehouse`
--
ALTER TABLE `asset_warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrow_authorize`
--
ALTER TABLE `borrow_authorize`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrow_file`
--
ALTER TABLE `borrow_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `borrow_item`
--
ALTER TABLE `borrow_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `borrow_remark`
--
ALTER TABLE `borrow_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `borrow_request`
--
ALTER TABLE `borrow_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estimate_file`
--
ALTER TABLE `estimate_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimate_item`
--
ALTER TABLE `estimate_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `estimate_remark`
--
ALTER TABLE `estimate_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `estimate_request`
--
ALTER TABLE `estimate_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `issue_authorize`
--
ALTER TABLE `issue_authorize`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `issue_file`
--
ALTER TABLE `issue_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `issue_item`
--
ALTER TABLE `issue_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `issue_remark`
--
ALTER TABLE `issue_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `issue_request`
--
ALTER TABLE `issue_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `outstanding_file`
--
ALTER TABLE `outstanding_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outstanding_item`
--
ALTER TABLE `outstanding_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `outstanding_remark`
--
ALTER TABLE `outstanding_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `outstanding_request`
--
ALTER TABLE `outstanding_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_file`
--
ALTER TABLE `payment_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_item`
--
ALTER TABLE `payment_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_remark`
--
ALTER TABLE `payment_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `petty_file`
--
ALTER TABLE `petty_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petty_item`
--
ALTER TABLE `petty_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petty_remark`
--
ALTER TABLE `petty_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petty_request`
--
ALTER TABLE `petty_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_file`
--
ALTER TABLE `product_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_location`
--
ALTER TABLE `product_location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_file`
--
ALTER TABLE `purchase_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_remark`
--
ALTER TABLE `purchase_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_file`
--
ALTER TABLE `quotation_file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_item`
--
ALTER TABLE `quotation_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_request`
--
ALTER TABLE `quotation_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service_authorize`
--
ALTER TABLE `service_authorize`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
