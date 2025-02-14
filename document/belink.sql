-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Feb 14, 2025 at 09:50 AM
-- Server version: 11.6.2-MariaDB-ubu2404
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
(1, 1, '55b3e12ba8fc2598f43aea3f69a25b66.pdf', 1, NULL, '2025-02-02 20:44:00');

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
  `vat` decimal(20,2) NOT NULL,
  `wt` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_item`
--

INSERT INTO `advance_item` (`id`, `request_id`, `expense_id`, `text`, `amount`, `vat`, `wt`, `status`, `updated`, `created`) VALUES
(1, 1, 7, 'xxxx', 9000.00, 630.00, 0.00, 1, NULL, '2025-02-02 20:44:00');

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
(1, 1, 1, '', 2, '2025-02-02 20:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `advance_request`
--

CREATE TABLE `advance_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `objective` text NOT NULL,
  `action` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_request`
--

INSERT INTO `advance_request` (`id`, `uuid`, `last`, `login_id`, `order_number`, `amount`, `objective`, `action`, `status`, `updated`, `created`) VALUES
(1, 'c5f0d78a-e16b-11ef-8d4c-0242ac120003', 1, 1, 'SO07010001', 10000.00, 'XXXXXX\r\nXXXXXX', 1, 2, '2025-02-02 20:45:00', '2025-02-02 20:44:00');

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
(125, '6b0ed8e3-e91b-11ef-8583-2ad6c30b0fff', 'ddd', 'ddd', 3, 1, 1, 0, 0, '', '', 'ddd', 2, '2025-02-14 14:09:19', '2025-02-12 08:29:04');

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
  `type` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `borrow_authorize`
--

INSERT INTO `borrow_authorize` (`id`, `login_id`, `type`, `status`, `updated`, `created`) VALUES
(1, 1, 1, 0, '2025-02-14 15:41:51', '2025-02-14 14:55:16'),
(2, 2, 2, 1, '2025-02-14 15:19:02', '2025-02-14 14:55:20'),
(3, 5, 1, 1, NULL, '2025-02-14 15:41:20');

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
(1, 1, '5a67671e7599b1e07574ae347ccc1662.webp', 1, NULL, '2025-02-09 14:11:07'),
(2, 1, 'f4b31e44db967880248c8423094b2fcd.pdf', 1, NULL, '2025-02-09 14:11:07'),
(3, 1, 'cb4afb0c1ffbfb97ab62611b18d84f1a.webp', 0, '2025-02-09 15:10:24', '2025-02-09 15:06:24'),
(4, 3, 'e4ffc2b3ae8df2b61f76f48fe0f603f0.webp', 1, NULL, '2025-02-11 10:12:11'),
(5, 5, 'f58926196f6127ee55fc06119770d15c.pdf', 0, '2025-02-12 13:50:50', '2025-02-12 13:46:20'),
(6, 5, 'b2565f0ee55da5c096205e481fcde6bb.webp', 0, '2025-02-12 13:52:05', '2025-02-12 13:50:54'),
(7, 5, 'f6acb7b3cb53c065ce776baf86faaa78.webp', 1, NULL, '2025-02-12 13:52:14'),
(8, 5, 'e03ddcd888948b051279ccb0b48dc39d.pdf', 1, NULL, '2025-02-12 13:52:14'),
(9, 8, '9a9ecbd1775f36bf76c2847cb2bce933.webp', 1, NULL, '2025-02-13 06:45:36');

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
(1, 1, 83, 'xxx', 1, '2025-02-09 15:06:50', '2025-02-09 14:11:07'),
(2, 1, 121, 'yyy', 1, '2025-02-09 15:06:50', '2025-02-09 14:11:07'),
(3, 1, 91, 'zzz', 0, '2025-02-09 15:10:30', '2025-02-09 15:06:24'),
(4, 2, 63, 'EVENT SO 3344343', 1, NULL, '2025-02-10 05:01:09'),
(5, 2, 56, '23', 1, NULL, '2025-02-10 05:01:09'),
(6, 3, 19, 'EVENT SO 3344343', 1, NULL, '2025-02-11 10:12:11'),
(7, 3, 2, 'EVENT SO 3344343', 1, NULL, '2025-02-11 10:12:11'),
(8, 4, 2, 'EVENT SO 3344343', 1, NULL, '2025-02-12 05:02:44'),
(9, 5, 114, 'aaa', 1, '2025-02-12 13:52:14', '2025-02-12 13:46:20'),
(10, 5, 90, 'bbb', 1, '2025-02-12 13:52:14', '2025-02-12 13:46:20'),
(11, 6, 63, 'EVENT SO บริษัท TEEE', 1, NULL, '2025-02-13 02:49:35'),
(12, 7, 38, 'EVENT SO บริษัท 5555', 1, NULL, '2025-02-13 04:18:20'),
(13, 7, 39, 'EVENT SO บริษัท 5555', 1, NULL, '2025-02-13 04:18:20'),
(14, 8, 38, 'EVENT SO บริษัท 8888', 1, NULL, '2025-02-13 06:45:36'),
(15, 8, 39, 'EVENT SO บริษัท 8888', 1, NULL, '2025-02-13 06:45:36'),
(16, 9, 38, 'ตู้กาชาปองที่แร็ปงานเดอร์มาติก', 1, NULL, '2025-02-13 08:17:29'),
(17, 10, 90, 'xxxx', 1, NULL, '2025-02-14 14:02:17');

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
(1, 1, 1, '2025-02-03', 'TESTETST', 2, '2025-02-09 15:32:23'),
(2, 1, 1, '2025-02-28', 'XXXX', 3, '2025-02-09 15:38:07'),
(3, 2, 5, '2025-02-12', 'รับ', 2, '2025-02-11 10:14:32'),
(4, 2, 5, '2025-04-01', 'รับคืนเรียบร้อย', 3, '2025-02-11 10:16:10'),
(5, 3, 5, '2025-02-11', 'กดก', 2, '2025-02-11 10:16:27'),
(6, 3, 1, '2025-04-01', 'gdfg', 3, '2025-02-11 10:17:48'),
(7, 4, 5, '2025-02-14', 'check already', 2, '2025-02-12 05:05:03'),
(8, 4, 5, '2025-04-01', 'ขอครบ ไม่มีเสียหาย', 3, '2025-02-12 05:06:54'),
(9, 5, 1, '2025-02-24', 'ตรวจสอบเรียบร้อย', 2, '2025-02-12 13:46:57'),
(10, 5, 1, '2025-02-28', 'อุปกรณ์ปกติเรียบร้อยดี', 3, '2025-02-12 13:52:43'),
(11, 6, 5, '2025-02-14', 'ส่งมอบที่ บริษัท TTTTTTT', 2, '2025-02-13 02:50:41'),
(12, 6, 5, '2025-03-03', 'รับคืน ตรวจเช็คของปกติ ไม่เสียหาย', 3, '2025-02-13 02:51:26'),
(13, 7, 5, '2025-02-17', 'ส่งมอบให้ที่ บริษัท 5555 หน้างาน', 2, '2025-02-13 04:19:39'),
(14, 7, 5, '2025-03-03', 'ตรวจเช็คของ ไม่เสียหาย', 3, '2025-02-13 04:21:14'),
(15, 8, 5, '2025-02-17', 'ส่งมอบที่งาน ของงาน บริษัท 8888', 2, '2025-02-13 06:47:13'),
(16, 8, 2, '2025-03-03', 'คลังตรวจสอบของเรียบร้อย ไม่เสียหาย', 3, '2025-02-13 06:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_request`
--

CREATE TABLE `borrow_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `objective` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_request`
--

INSERT INTO `borrow_request` (`id`, `uuid`, `last`, `login_id`, `start`, `end`, `objective`, `status`, `updated`, `created`) VALUES
(1, '08c7f165-e6b5-11ef-8e45-0242ac120003', 1, 1, '2025-02-03', '2025-02-28', 'aaaabbb\r\naaaabbb', 3, '2025-02-09 15:38:07', '2025-02-09 14:11:07'),
(2, '0ad0e25f-e76c-11ef-8583-2ad6c30b0fff', 2, 1, '2025-02-10', '2025-02-28', 'EVENT SO 3344343', 3, '2025-02-11 10:16:10', '2025-02-10 05:01:09'),
(3, 'a8a77862-e860-11ef-8583-2ad6c30b0fff', 3, 2, '2025-02-13', '2025-03-31', 'ไปจัดงาน Event SO232323232', 3, '2025-02-11 10:17:48', '2025-02-11 10:12:11'),
(4, '98636cde-e8fe-11ef-8583-2ad6c30b0fff', 4, 2, '2025-03-01', '2025-03-31', 'sdsaaassda', 3, '2025-02-12 05:06:54', '2025-02-12 05:02:44'),
(5, 'bd6b2590-e947-11ef-8583-2ad6c30b0fff', 5, 1, '2025-02-24', '2025-02-28', 'ทดสอบระบบ\r\nทดสอบระบบ', 3, '2025-02-12 13:52:43', '2025-02-12 13:46:20'),
(6, '28aa3839-e9b5-11ef-8583-2ad6c30b0fff', 6, 2, '2025-02-17', '2025-02-28', 'ออกงานบริษัท xxxxx', 3, '2025-02-13 02:51:26', '2025-02-13 02:49:35'),
(7, '8e7d07af-e9c1-11ef-8583-2ad6c30b0fff', 7, 2, '2025-02-17', '2025-02-28', 'เอาไปจัดกิจกรรม บริษัท 55555', 3, '2025-02-13 04:21:14', '2025-02-13 04:18:20'),
(8, '2174e87d-e9d6-11ef-8583-2ad6c30b0fff', 8, 2, '2025-02-17', '2025-02-28', 'ไปออกงาน Event บริษัท 8888', 3, '2025-02-13 06:49:06', '2025-02-13 06:45:36'),
(9, 'f7481c78-e9e2-11ef-8583-2ad6c30b0fff', 9, 7, '2025-02-16', '2025-02-17', 'ใช้ออกบูธงานเดอร์มาติก วันที่ 16 - 17 ก.พ. 68', 1, NULL, '2025-02-13 08:17:29'),
(10, 'a0631a1c-eaa1-11ef-a265-0242ac120005', 10, 1, '2025-02-03', '2025-02-28', 'DDDD', 1, NULL, '2025-02-14 14:02:17');

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

INSERT INTO `estimate_request` (`id`, `uuid`, `last`, `login_id`, `customer_id`, `order_number`, `product_name`, `title_name`, `sales_name`, `budget`, `type`, `remark`, `action`, `status`, `updated`, `created`) VALUES
(1, 'e6e5ddd2-e169-11ef-8d4c-0242ac120003', 1, 1, 1, 'SO07010001', 'Breeze', 'Unilever - Breeze Esan', 'Esan Caravan', 700000.00, 1, '', 1, 4, '2025-02-02 20:31:28', '2025-02-02 20:30:37');

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
  `type` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `issue_authorize`
--

INSERT INTO `issue_authorize` (`id`, `login_id`, `type`, `status`, `updated`, `created`) VALUES
(1, 1, 1, 0, '2025-02-14 15:44:02', '2025-02-14 14:55:16'),
(2, 2, 2, 1, '2025-02-14 15:19:02', '2025-02-14 14:55:20'),
(3, 5, 1, 1, NULL, '2025-02-14 15:44:15');

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
(1, 1, '2cd9d23c82d8d1087c226553b3b7ddd4.pdf', 1, NULL, '2025-02-09 19:26:12'),
(2, 3, '724e21d0f279cdcb57442fad054880ff.pdf', 1, NULL, '2025-02-09 21:47:10'),
(3, 18, 'c06bedcc04f0d885b86508902ddf98b7.webp', 1, NULL, '2025-02-12 13:53:29'),
(4, 19, '8ef6a0fe2bfdd8a4d9213a2e4026eb6a.pdf', 0, '2025-02-12 14:10:06', '2025-02-12 13:54:47');

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
(1, 1, 4, 1, 1, 150.00, 150.00, 1, '2025-02-09 21:18:35', '2025-02-09 19:26:12'),
(2, 1, 2, 1, 1, 100.00, 100.00, 1, '2025-02-09 21:18:35', '2025-02-09 19:26:12'),
(3, 1, 3, 1, 1, 120.00, 120.00, 1, '2025-02-09 21:18:35', '2025-02-09 19:26:12'),
(4, 2, 4, 2, 1, 120.00, 120.00, 1, '2025-02-09 21:22:42', '2025-02-09 20:49:06'),
(5, 2, 4, 1, 1, 120.00, 120.00, 1, '2025-02-09 21:22:42', '2025-02-09 20:49:06'),
(6, 1, 4, 2, 1, 100.00, 100.00, 1, '2025-02-09 21:18:35', '2025-02-09 20:59:09'),
(7, 3, 4, 2, 2, 100.00, 100.00, 1, '2025-02-09 21:47:23', '2025-02-09 21:46:59'),
(8, 3, 4, 1, 2, 100.00, 100.00, 1, '2025-02-09 21:47:23', '2025-02-09 21:46:59'),
(9, 4, 8, 1, 2, 400.00, 400.00, 1, '2025-02-13 02:55:54', '2025-02-10 04:48:20'),
(10, 5, 17, 2, 1, 10.00, 10.00, 1, '2025-02-13 02:55:52', '2025-02-10 04:49:28'),
(11, 6, 19, 2, 2, 200.00, 200.00, 1, '2025-02-10 04:52:17', '2025-02-10 04:52:00'),
(12, 7, 8, 2, 2, 300.00, 300.00, 1, '2025-02-13 02:55:50', '2025-02-10 04:56:27'),
(13, 7, 5, 2, 2, 300.00, 300.00, 1, '2025-02-13 02:55:50', '2025-02-10 04:56:27'),
(14, 8, 35, 2, 2, 300.00, 300.00, 1, '2025-02-13 02:55:48', '2025-02-10 04:59:50'),
(15, 8, 15, 2, 2, 200.00, 200.00, 1, '2025-02-13 02:55:48', '2025-02-10 04:59:50'),
(16, 9, 39, 2, 1, 200.00, 200.00, 1, '2025-02-10 05:12:45', '2025-02-10 05:03:23'),
(17, 10, 30, 2, 2, 200.00, 200.00, 1, '2025-02-13 02:55:45', '2025-02-10 05:05:05'),
(18, 10, 4, 2, 2, 120.00, 120.00, 1, '2025-02-13 02:55:45', '2025-02-10 05:05:05'),
(19, 11, 39, 2, 2, 50.00, 50.00, 1, '2025-02-10 05:14:35', '2025-02-10 05:13:53'),
(20, 12, 8, 2, 1, 100.00, 100.00, 1, '2025-02-11 00:33:16', '2025-02-10 05:40:14'),
(21, 12, 8, 1, 1, 100.00, 100.00, 1, '2025-02-11 00:33:16', '2025-02-10 05:40:14'),
(22, 13, 5, 2, 1, 100.00, 100.00, 1, '2025-02-11 00:33:11', '2025-02-10 05:44:14'),
(23, 13, 5, 1, 1, 100.00, 100.00, 1, '2025-02-11 00:33:11', '2025-02-10 05:44:14'),
(24, 14, 4, 2, 2, 20.00, 20.00, 1, '2025-02-11 00:26:44', '2025-02-11 00:26:19'),
(25, 14, 39, 2, 2, 50.00, 50.00, 1, '2025-02-11 00:26:44', '2025-02-11 00:26:19'),
(26, 15, 3, 2, 1, 150.00, 150.00, 1, '2025-02-13 02:55:41', '2025-02-11 00:35:42'),
(27, 16, 4, 2, 2, 50.00, 50.00, 1, '2025-02-11 10:24:28', '2025-02-11 10:23:50'),
(28, 16, 3, 1, 2, 50.00, 50.00, 1, '2025-02-11 10:24:28', '2025-02-11 10:23:50'),
(29, 17, 8, 2, 2, 50.00, 50.00, 1, '2025-02-11 10:26:45', '2025-02-11 10:25:59'),
(30, 17, 5, 2, 2, 50.00, 50.00, 1, '2025-02-11 10:26:45', '2025-02-11 10:25:59'),
(31, 18, 4, 1, 1, 100.00, 100.00, 1, '2025-02-12 13:53:44', '2025-02-12 13:53:29'),
(32, 18, 2, 1, 1, 100.00, 100.00, 1, '2025-02-12 13:53:44', '2025-02-12 13:53:29'),
(33, 19, 4, 1, 2, 50.00, 50.00, 1, '2025-02-12 14:10:11', '2025-02-12 13:54:47'),
(34, 19, 2, 1, 2, 50.00, 0.00, 0, '2025-02-12 14:10:03', '2025-02-12 13:54:47'),
(35, 20, 4, 1, 2, 20.00, 20.00, 1, '2025-02-13 02:55:29', '2025-02-13 02:52:56'),
(36, 20, 2, 1, 2, 20.00, 20.00, 1, '2025-02-13 02:55:29', '2025-02-13 02:52:56'),
(37, 21, 3, 1, 2, 50.00, 50.00, 1, '2025-02-13 04:24:19', '2025-02-13 04:23:27'),
(38, 21, 4, 1, 2, 50.00, 50.00, 1, '2025-02-13 04:24:19', '2025-02-13 04:23:27'),
(39, 22, 4, 1, 1, 10.00, 10.00, 1, '2025-02-13 04:26:09', '2025-02-13 04:25:51'),
(40, 23, 4, 1, 1, 10.00, 10.00, 1, '2025-02-13 04:31:43', '2025-02-13 04:30:46'),
(41, 24, 4, 1, 2, 50.00, 50.00, 1, '2025-02-13 06:53:21', '2025-02-13 06:51:55'),
(42, 24, 3, 1, 2, 20.00, 20.00, 1, '2025-02-13 06:53:21', '2025-02-13 06:51:55'),
(43, 25, 4, 1, 1, 7.00, 7.00, 1, '2025-02-13 06:55:33', '2025-02-13 06:55:04'),
(44, 26, 4, 1, 1, 20.00, 20.00, 1, '2025-02-14 14:34:52', '2025-02-14 14:16:35'),
(45, 26, 2, 1, 1, 20.00, 20.00, 1, '2025-02-14 14:34:52', '2025-02-14 14:33:23'),
(46, 27, 4, 1, 2, 20.00, 20.00, 1, '2025-02-14 14:38:44', '2025-02-14 14:38:31'),
(47, 27, 2, 1, 2, 20.00, 20.00, 1, '2025-02-14 14:38:44', '2025-02-14 14:38:31');

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
(1, 1, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-09 21:18:35'),
(2, 2, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-09 21:22:42'),
(3, 3, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-09 21:47:23'),
(4, 6, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-10 04:52:17'),
(5, 9, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-10 05:12:45'),
(6, 11, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-10 05:14:35'),
(7, 14, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-11 00:26:44'),
(8, 13, 4, 'ผ่านการตรวจสอบ', 2, '2025-02-11 00:33:11'),
(9, 12, 4, 'ผ่านการตรวจสอบ', 2, '2025-02-11 00:33:16'),
(10, 16, 2, 'ผ่านการตรวจสอบ', 2, '2025-02-11 10:24:28'),
(11, 17, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-11 10:26:45'),
(12, 18, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-12 13:53:44'),
(13, 19, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-12 14:10:11'),
(14, 20, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:29'),
(15, 15, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:41'),
(16, 10, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:45'),
(17, 8, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:48'),
(18, 7, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:50'),
(19, 5, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:52'),
(20, 4, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 02:55:54'),
(21, 21, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 04:24:19'),
(22, 22, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 04:26:09'),
(23, 23, 5, 'ผ่านการตรวจสอบ', 2, '2025-02-13 04:31:43'),
(24, 24, 2, 'ผ่านการตรวจสอบ', 2, '2025-02-13 06:53:21'),
(25, 25, 2, 'ผ่านการตรวจสอบ', 2, '2025-02-13 06:55:33'),
(26, 26, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-14 14:34:52'),
(27, 27, 1, 'ผ่านการตรวจสอบ', 2, '2025-02-14 14:38:44');

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
  `outcome` int(11) DEFAULT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_request`
--

INSERT INTO `issue_request` (`id`, `uuid`, `last`, `login_id`, `type`, `date`, `outcome`, `text`, `status`, `updated`, `created`) VALUES
(1, '0d4e7225-e6e1-11ef-8e45-0242ac120003', 1, 1, 1, '2025-02-09', NULL, 'ยอดยกมา\r\nยอดยกมา', 2, '2025-02-09 21:18:35', '2025-02-09 19:26:12'),
(2, 'a216c3de-e6ec-11ef-8e45-0242ac120003', 2, 1, 1, '2025-02-09', NULL, 'ยอดยกมา', 2, '2025-02-09 21:22:42', '2025-02-09 20:49:06'),
(3, 'b871a565-e6f4-11ef-8e45-0242ac120003', 3, 1, 2, '2025-02-09', NULL, 'กิจกรรม\r\nกิจกรรม', 2, '2025-02-09 21:47:23', '2025-02-09 21:46:59'),
(4, '403a2779-e76a-11ef-8583-2ad6c30b0fff', 4, 1, 2, '2025-02-10', NULL, 'งาน Event วันหยุด', 2, '2025-02-13 02:55:54', '2025-02-10 04:48:20'),
(5, '6935145b-e76a-11ef-8583-2ad6c30b0fff', 5, 1, 1, '2025-02-10', NULL, 'test', 2, '2025-02-13 02:55:52', '2025-02-10 04:49:28'),
(6, 'c3460b2c-e76a-11ef-8583-2ad6c30b0fff', 6, 1, 2, '2025-02-10', NULL, 'Event งานวันเกิด', 2, '2025-02-10 04:52:17', '2025-02-10 04:52:00'),
(7, '62ca9076-e76b-11ef-8583-2ad6c30b0fff', 7, 1, 2, '2025-02-10', NULL, 'Event งานทำบุญ บริษัท', 2, '2025-02-13 02:55:50', '2025-02-10 04:56:27'),
(8, 'dba9b79d-e76b-11ef-8583-2ad6c30b0fff', 8, 1, 2, '2025-02-10', NULL, 'งานทำบุญบริษัท ช้าช้างช้าง จำกัด', 2, '2025-02-13 02:55:48', '2025-02-10 04:59:50'),
(9, '5a5d4ed1-e76c-11ef-8583-2ad6c30b0fff', 9, 1, 1, '2025-02-10', NULL, 'แอคโนไฟท์', 2, '2025-02-10 05:12:45', '2025-02-10 05:03:23'),
(10, '974328c3-e76c-11ef-8583-2ad6c30b0fff', 10, 1, 2, '2025-02-10', NULL, 'Event SO 3332222', 2, '2025-02-13 02:55:45', '2025-02-10 05:05:05'),
(11, 'd21d9048-e76d-11ef-8583-2ad6c30b0fff', 11, 1, 2, '2025-02-10', NULL, 'Event SO332323', 2, '2025-02-10 05:14:35', '2025-02-10 05:13:53'),
(12, '803b0831-e771-11ef-8583-2ad6c30b0fff', 12, 1, 1, '2025-02-10', NULL, 'TEST\r\nTEST', 2, '2025-02-11 00:33:16', '2025-02-10 05:40:14'),
(13, '0f511843-e772-11ef-8583-2ad6c30b0fff', 13, 1, 1, '2025-02-10', NULL, 'DDDD', 2, '2025-02-11 00:33:11', '2025-02-10 05:44:14'),
(14, 'd09befcb-e80e-11ef-8583-2ad6c30b0fff', 14, 1, 2, '2025-02-11', NULL, 'งาน Event SO 447747700', 2, '2025-02-11 00:26:44', '2025-02-11 00:26:19'),
(15, '1fcbf5f7-e810-11ef-8583-2ad6c30b0fff', 15, 2, 1, '2025-02-11', NULL, 'งานทดสอบ', 2, '2025-02-13 02:55:41', '2025-02-11 00:35:42'),
(16, '48f4add3-e862-11ef-8583-2ad6c30b0fff', 16, 2, 2, '2025-02-11', NULL, 'Event ทำบุญบริษัท zzzzz', 2, '2025-02-11 10:24:28', '2025-02-11 10:23:50'),
(17, '9667d864-e862-11ef-8583-2ad6c30b0fff', 17, 2, 2, '2025-02-11', NULL, 'Event วันเกิด SO --545454545', 2, '2025-02-11 10:26:45', '2025-02-11 10:25:59'),
(18, 'bd178bdd-e948-11ef-8583-2ad6c30b0fff', 18, 1, 1, '2025-02-12', NULL, 'AAAA', 2, '2025-02-12 13:53:44', '2025-02-12 13:53:29'),
(19, 'ebb61397-e948-11ef-8583-2ad6c30b0fff', 19, 1, 2, '2025-02-12', NULL, 'DDDD', 2, '2025-02-12 14:10:11', '2025-02-12 13:54:47'),
(20, 'a0aa1b6b-e9b5-11ef-8583-2ad6c30b0fff', 20, 2, 2, '2025-02-13', NULL, 'งานบริษัท TTTTTTT ชุดงานแจกสินค้า', 2, '2025-02-13 02:55:29', '2025-02-13 02:52:56'),
(21, '4609d2b5-e9c2-11ef-8583-2ad6c30b0fff', 21, 2, 2, '2025-02-13', NULL, 'กิจกรรม งานบริษัท 5555', 2, '2025-02-13 04:24:19', '2025-02-13 04:23:27'),
(22, '9b49344c-e9c2-11ef-8583-2ad6c30b0fff', 22, 5, 1, '2025-02-13', NULL, 'IS20250021 เหลือจากรายการ', 2, '2025-02-13 04:26:09', '2025-02-13 04:25:50'),
(23, '4b50f262-e9c3-11ef-8583-2ad6c30b0fff', 23, 2, 1, '2025-02-13', NULL, 'IS20250021 เหลือ', 2, '2025-02-13 04:31:43', '2025-02-13 04:30:46'),
(24, '0385479d-e9d7-11ef-8583-2ad6c30b0fff', 24, 2, 2, '2025-02-13', NULL, 'ไปออกงาน Event บริษัท 8888', 2, '2025-02-13 06:53:21', '2025-02-13 06:51:55'),
(25, '73d4757b-e9d7-11ef-8583-2ad6c30b0fff', 25, 2, 1, '2025-02-13', NULL, 'IS20250024 เหลือจากงาน บริษัท 8888', 2, '2025-02-13 06:55:33', '2025-02-13 06:55:04'),
(26, 'a042a733-eaa3-11ef-a265-0242ac120005', 26, 1, 1, '2025-02-14', 20, 'dddddd', 2, '2025-02-14 14:34:52', '2025-02-14 14:16:35'),
(27, 'b0959648-eaa6-11ef-a265-0242ac120005', 27, 1, 2, '2025-02-14', 0, 'ddddd', 2, '2025-02-14 14:38:44', '2025-02-14 14:38:31');

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
(5, '7313af95-e810-11ef-8583-2ad6c30b0fff', '', 'store@test.com', '$2y$10$AFRyl5Hh9/sGPXMbyuA/Bum78re.OqMxnWPS2J8Rn.ca4R9ppm4da', 9, 1, '2025-02-11 00:39:42', '2025-02-11 00:38:01'),
(6, '7bc14cfa-e868-11ef-8583-2ad6c30b0fff', '', 'jutamas.pu@test.com', '$2y$10$RlzJAiuhr0uZmr3XEC/unuuP5bKENxpuqeOfZ408S3qey60si.e72', 1, 1, '2025-02-13 07:41:29', '2025-02-11 11:08:12'),
(7, '967c4eaf-e868-11ef-8583-2ad6c30b0fff', '', 'supanida.ja@test.com', '$2y$10$pkvurqhgZowu8eCRfcURE.XDkj4nkWXezT8cqxCQ66WwYbDyzo5t.', 1, 1, '2025-02-13 07:48:55', '2025-02-11 11:08:57'),
(8, 'a6193884-e868-11ef-8583-2ad6c30b0fff', '', 'kamonwan.su@test.com', '$2y$10$1aGNo1ks0dU5m2l03oPzouqrVcAbfUx4XNbUkYxb/aY2D37QAgXEi', 1, 1, '2025-02-13 07:42:01', '2025-02-11 11:09:23'),
(9, 'b3949d98-e868-11ef-8583-2ad6c30b0fff', '', 'thaipat.me@test.com', '$2y$10$1aGlCnD4SlcGCwzU2TmGHuYbKmLWPlaQCEcvtRjFNrl.nWXOd1JFW', 1, 1, '2025-02-13 07:50:16', '2025-02-11 11:09:45'),
(10, 'c1ce63be-e868-11ef-8583-2ad6c30b0fff', '', 'emika.ar@test.com', '$2y$10$Llt0pQir12QrHQpltgF2ku8MXTUesrf22NHHMBTLKxLZ2JU7iRe6K', 1, 1, '2025-02-13 07:49:56', '2025-02-11 11:10:09'),
(11, 'ce2f3f16-e868-11ef-8583-2ad6c30b0fff', '', 'phichayapha.bu@test.com', '$2y$10$1LqOGFQM9pq30NKOLEGrkeM./Fs3bXwIIkMakjY74n2HurC60ioCy', 1, 1, '2025-02-13 07:48:20', '2025-02-11 11:10:30'),
(12, 'db468f94-e868-11ef-8583-2ad6c30b0fff', '', 'charuwan.bo@test.com', '$2y$10$NC8VzY9CASqGXiARh0Mi8Ounm94eo4hZQlhwzoqqCSg5Mh3rbgvai', 1, 1, '2025-02-13 07:42:53', '2025-02-11 11:10:52'),
(13, 'e83837b7-e868-11ef-8583-2ad6c30b0fff', '', 'boonyakorn.be@test.com', '$2y$10$79bMKkJjjIH8R6Gg7VzlT.q1jhCyJz0lnFOnwUPK6sHc7F1TUR6jK', 1, 1, '2025-02-13 07:43:29', '2025-02-11 11:11:14'),
(14, 'fd5dd5d9-e868-11ef-8583-2ad6c30b0fff', '', 'jakawan.ch@test.com', '$2y$10$DHf9sF7RA/mOuhl5Ec.aD.LBO45SPb7bB0K3A7A.Ro6Cvpxw5gXja', 1, 1, '2025-02-13 07:42:30', '2025-02-11 11:11:49'),
(15, 'd06a19f1-e869-11ef-8583-2ad6c30b0fff', '', 'arthid.na@test.com', '$2y$10$3NX/iG6sF.FzCSo1112X0O0klBPtfhsqe4bqKWt7aAe9gVkZ3Tbsi', 1, 1, '2025-02-13 07:49:33', '2025-02-11 11:17:43'),
(16, 'ef7d1fc6-e869-11ef-8583-2ad6c30b0fff', '', 'phadung.bo@test.com', '$2y$10$3e22V5VHB0yjDFO8pF8Rgusw3R/OSsuv3dzR1ZE2jCCGvztpeyIKK', 1, 1, '2025-02-13 07:47:45', '2025-02-11 11:18:35'),
(17, '887b64c0-e9df-11ef-8583-2ad6c30b0fff', '', 'onuma.th@test.com', '$2y$10$0RmoAdHcPzlbjWnnDfD.i.r4oRq/QmTI.htMyOcVCyuPM5QnBwXU2', 9, 1, '2025-02-13 08:16:43', '2025-02-13 07:52:54');

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
(8, 2, 13, 'yyy', 'yy', 20000.00, 1400.00, 600.00, 1, NULL, '2025-02-02 20:37:26');

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
(4, 2, 1, '', 3, '2025-02-02 20:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `last` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
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

INSERT INTO `payment_request` (`id`, `uuid`, `last`, `login_id`, `order_number`, `receiver`, `type`, `cheque_bank`, `cheque_branch`, `cheque_number`, `cheque_date`, `action`, `status`, `updated`, `created`) VALUES
(1, '3380d4e2-e16a-11ef-8d4c-0242ac120003', 1, 1, 'SO07010001', 'AAAAA', 1, '', '', '', '1970-01-01', 1, 3, '2025-02-02 20:35:18', '2025-02-02 20:32:46'),
(2, 'dad734e2-e16a-11ef-8d4c-0242ac120003', 2, 1, 'SO07010001', 'AAAA', 2, 'BBB', 'BBB', 'BBBB', '2025-02-03', 1, 3, '2025-02-02 20:37:43', '2025-02-02 20:37:26');

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
(2, 'e69e6c49-e69d-11ef-8e45-0242ac120003', 'Mansome คอลาเจน', '', 0, 1, 0, 2, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(3, 'e69ead77-e69d-11ef-8e45-0242ac120003', 'Mansome ฮันนี่เลมอน', '', 0, 1, 0, 2, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(4, 'e69ee937-e69d-11ef-8e45-0242ac120003', 'Mansome กูลตาไธโอน', '', 1, 1, 0, 2, 0, '', 1, '2025-02-09 12:47:33', '2025-02-09 11:25:32'),
(5, 'e69f297c-e69d-11ef-8e45-0242ac120003', 'Puriku มิกเบอร์รี่', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(6, 'e69f6780-e69d-11ef-8e45-0242ac120003', 'Puriku องุ่นเคียวโฮ', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(7, 'e69fa52f-e69d-11ef-8e45-0242ac120003', 'Puriku เก๊กฮวย', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(8, 'e69fe840-e69d-11ef-8e45-0242ac120003', 'Puriku น้ำผึ้งเลม่อน', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(9, 'e6a0550b-e69d-11ef-8e45-0242ac120003', 'Puriku สตอเบอรี่', '', 0, 1, 0, 3, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(10, 'e6a091a4-e69d-11ef-8e45-0242ac120003', 'Dermatix', '', 0, 1, 0, 5, 0, '', 1, NULL, '2025-02-09 11:25:32'),
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
(26, 'e6a46c60-e69d-11ef-8e45-0242ac120003', 'ครีมแต้มสิว', '', 0, 0, 0, 5, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(27, 'e6a49a84-e69d-11ef-8e45-0242ac120003', 'ถ้วย', '', 0, 0, 0, 5, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(28, 'e6a4caa2-e69d-11ef-8e45-0242ac120003', 'กระเป๋า สีกรม', '', 0, 0, 0, 5, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(29, 'e6a4f9de-e69d-11ef-8e45-0242ac120003', 'กระเป๋า สีขาว', '', 0, 0, 0, 5, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(30, 'e6a52849-e69d-11ef-8e45-0242ac120003', 'คลอโรฟิล', '', 0, 0, 0, 2, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(31, 'e6a55b2d-e69d-11ef-8e45-0242ac120003', 'White WGH 15g', '', 0, 0, 0, 6, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(32, 'e6a5d441-e69d-11ef-8e45-0242ac120003', 'Whip Collagen In a WGH 15g', '', 0, 0, 0, 6, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(33, 'e6a607af-e69d-11ef-8e45-0242ac120003', 'Whip VITC Poreless Glow', '', 0, 0, 0, 6, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(34, 'e6a63bee-e69d-11ef-8e45-0242ac120003', 'พรี่เมี่ยม โลชั่น 30มล.', '', 0, 0, 0, 8, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(35, 'e6a66d3f-e69d-11ef-8e45-0242ac120003', 'พรี่เมี่ยม โลชั่น 170มล.', '', 0, 0, 0, 8, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(36, 'e6a69ba0-e69d-11ef-8e45-0242ac120003', 'พรี่เมี่ยม โลชั่น ไฮเดรทติ้ง ครีม 50กรัม', '', 0, 0, 0, 8, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(37, 'e6a6ca40-e69d-11ef-8e45-0242ac120003', 'แพ็ค 3 แอคโนไฟท์ โฟม 50มล.', '', 0, 0, 0, 7, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(38, 'e6a6f893-e69d-11ef-8e45-0242ac120003', 'บอม 6 เมน แอคโนไฟท์ โฟมสครับ 15มล', '', 0, 0, 0, 7, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(39, 'e6a73d9e-e69d-11ef-8e45-0242ac120003', 'แอคโนไฟท์ ซูเปอร์ เซรั่ม 7มล.', '', 0, 0, 0, 7, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(40, 'e6a781a3-e69d-11ef-8e45-0242ac120003', 'แอคโนไฟท์ โฟมสครับ 100มล.', '', 0, 0, 0, 7, 0, '', 1, NULL, '2025-02-09 11:25:32'),
(41, '273a242b-e77f-11ef-8583-2ad6c30b0fff', 'Mansome คอลาเจน', '8888888888', 1, 1, 1, 2, 1, '', 2, '2025-02-10 07:24:53', '2025-02-10 07:17:57'),
(42, '53c66a45-e91b-11ef-8583-2ad6c30b0fff', 'aa', 'aa', 2, 1, 1, 5, 1, '', 1, '2025-02-14 14:09:27', '2025-02-12 08:28:25');

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
(8, 'Hada Labo', 1, NULL, '2025-02-09 10:53:34');

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
(1, 41, '82e96bf322dbcf7be63b2cc47c5c9a08.webp', 1, NULL, '2025-02-10 07:17:57');

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
(3, 'ผลิตภัณฑ์ดูแลผม', 1, '2025-02-08 23:00:11', '2025-02-08 22:58:56');

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
(1, 'ขวด', 1, '2025-02-08 23:10:38', '2025-02-08 23:09:47');

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

INSERT INTO `purchase_request` (`id`, `uuid`, `last`, `login_id`, `department`, `date`, `order_number`, `objective`, `action`, `status`, `updated`, `created`) VALUES
(1, '1a7ecf4a-e16c-11ef-8d4c-0242ac120003', 1, 1, 'YYYY', '2025-02-10', '', 'YYYYY\r\nYYYYY', 1, 2, '2025-02-02 20:46:58', '2025-02-02 20:46:22');

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
(1, 'cf1bf169-e929-11ef-9523-0242ac120005', 1, 'Estimate Budget', '/estimate', 1, '2025-02-12 17:42:03', '2025-02-12 20:37:08'),
(2, 'cf1c7170-e929-11ef-9523-0242ac120005', 2, 'Purchase Request', '/purchase', 1, '2025-02-12 17:42:03', '2025-02-12 20:37:08'),
(3, 'cf1cfac9-e929-11ef-9523-0242ac120005', 3, 'Payment Order', '/payment', 1, '2025-02-12 17:42:03', '2025-02-12 20:37:08'),
(4, 'cf1d4709-e929-11ef-9523-0242ac120005', 4, 'Advance Clearing', '/advance', 1, '2025-02-12 17:42:03', '2025-02-12 20:37:08'),
(5, 'cf1d9368-e929-11ef-9523-0242ac120005', 5, 'ระบบยืมทรัพย์สิน', '/borrow', 1, '2025-02-12 17:42:03', '2025-02-12 20:37:08'),
(6, 'cf1ddb6a-e929-11ef-9523-0242ac120005', 6, 'ระบบนำเข้า-เบิกออก', '/issue', 1, '2025-02-12 17:42:03', '2025-02-12 20:37:08');

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
(1, 1, '1,1,1,1,1,1', '2025-02-13 02:41:14', '2025-02-12 18:37:02'),
(2, 2, '1,1,1,1,1,1', '2025-02-13 02:42:33', '2025-02-12 18:53:10'),
(3, 5, '0,0,0,0,1,1', '2025-02-13 02:42:36', '2025-02-12 14:11:37'),
(4, 3, '1,1,1,1,1,1', '2025-02-13 02:42:34', '2025-02-13 02:41:47'),
(5, 4, '1,1,1,1,0,0', '2025-02-13 02:42:54', '2025-02-13 02:42:35'),
(6, 6, '0,0,0,0,1,1', '2025-02-13 02:43:01', '2025-02-13 02:42:37'),
(7, 7, '0,0,0,0,1,1', '2025-02-13 02:43:06', '2025-02-13 02:42:38'),
(8, 8, '0,0,0,0,1,1', '2025-02-13 02:43:09', '2025-02-13 02:42:42'),
(9, 9, '0,0,0,0,1,1', '2025-02-13 02:43:13', '2025-02-13 02:42:43'),
(10, 10, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:17'),
(11, 11, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:21'),
(12, 12, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:25'),
(13, 13, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:29'),
(14, 14, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:32'),
(15, 15, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:38'),
(16, 16, '0,0,0,0,1,1', NULL, '2025-02-13 02:43:43'),
(17, 17, '0,0,0,0,1,1', '2025-02-13 08:19:43', '2025-02-13 08:19:38');

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
(17, 17, 'อรอุมา', 'ทองช้อย', 5, '');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `advance_file`
--
ALTER TABLE `advance_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_item`
--
ALTER TABLE `advance_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_remark`
--
ALTER TABLE `advance_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_request`
--
ALTER TABLE `advance_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `borrow_file`
--
ALTER TABLE `borrow_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `borrow_item`
--
ALTER TABLE `borrow_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `borrow_remark`
--
ALTER TABLE `borrow_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `borrow_request`
--
ALTER TABLE `borrow_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_file`
--
ALTER TABLE `issue_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue_item`
--
ALTER TABLE `issue_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `issue_remark`
--
ALTER TABLE `issue_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `issue_request`
--
ALTER TABLE `issue_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_remark`
--
ALTER TABLE `payment_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_file`
--
ALTER TABLE `product_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_location`
--
ALTER TABLE `product_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
