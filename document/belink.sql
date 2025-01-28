-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jan 28, 2025 at 09:50 AM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
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
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_file`
--

INSERT INTO `estimate_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '0b1732ba2835b590d7fc0adc44bd3794.pdf', 1, NULL, '2025-01-19 19:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_item`
--

CREATE TABLE `estimate_item` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `estimate` decimal(20,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_item`
--

INSERT INTO `estimate_item` (`id`, `request_id`, `expense_id`, `estimate`, `status`, `updated`, `created`) VALUES
(1, 1, 5, 40000.00, 1, '2025-01-19 19:39:09', '2025-01-19 18:47:25'),
(2, 1, 3, 300000.00, 1, '2025-01-19 19:39:09', '2025-01-19 18:47:25'),
(3, 1, 8, 12000.00, 1, '2025-01-19 19:39:09', '2025-01-19 18:47:25'),
(4, 1, 9, 250000.00, 1, '2025-01-19 19:39:09', '2025-01-19 18:47:25'),
(5, 1, 16, 120000.00, 1, '2025-01-19 19:39:09', '2025-01-19 19:30:31'),
(6, 1, 6, 50000.00, 1, NULL, '2025-01-19 19:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_remark`
--

CREATE TABLE `estimate_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_remark`
--

INSERT INTO `estimate_remark` (`id`, `request_id`, `login_id`, `text`, `status`, `created`) VALUES
(1, 1, 1, '', 2, '2025-01-19 20:05:05'),
(2, 1, 1, '', 3, '2025-01-19 20:05:11'),
(3, 1, 1, '', 4, '2025-01-19 20:05:17');

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
  `action` int(1) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estimate_request`
--

INSERT INTO `estimate_request` (`id`, `uuid`, `last`, `login_id`, `customer_id`, `order_number`, `product_name`, `title_name`, `sales_name`, `budget`, `type`, `remark`, `action`, `status`, `updated`, `created`) VALUES
(1, '2916f3d7-d65b-11ef-8f0b-0242ac120005', 1, 1, 1, 'SO07010001', 'Breeze', 'Unilever-Breeze Esan', 'Esan Caravan', 1000000.00, 1, 'TESTTEST\r\nTESTTEST', 1, 4, '2025-01-19 20:05:17', '2025-01-19 18:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` int(1) NOT NULL,
  `reference` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
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
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(1) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `uuid`, `email`, `password`, `level`, `status`, `updated`, `created`) VALUES
(1, '8578263a-d0ae-11ef-91c3-0242ac120002', 'admin@test.com', '$2y$10$W08w.crPDLXzroZDNFirJObaHK91H.0D7ZszaRR6iQQi9W32.tnci', 9, 1, '2025-01-12 13:39:05', '2023-11-23 09:42:54'),
(2, '857827b5-d0ae-11ef-91c3-0242ac120002', 'user@test.com', '$2y$10$jwAmc2BoS2EwrzfL2LkYOel9FZHc9LSbRn4sge.SvmPiOyjoSgLVq', 1, 1, '2025-01-03 09:10:45', '2025-01-03 08:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `payment_file`
--

CREATE TABLE `payment_file` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_file`
--

INSERT INTO `payment_file` (`id`, `request_id`, `name`, `status`, `updated`, `created`) VALUES
(1, 1, '53ecc23d211e27d14537146092d4cfef.pdf', 1, NULL, '2025-01-27 21:17:04'),
(2, 1, '7983e8df7de803df81cb2f7718e9375f.webp', 1, NULL, '2025-01-27 21:17:04'),
(3, 2, '89f1094f12883e924557cfeb6e6be3a3.pdf', 1, NULL, '2025-01-27 21:20:43'),
(4, 2, '747c9079c2c49d29150c3711938b362d.pdf', 1, NULL, '2025-01-27 21:20:43');

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
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_item`
--

INSERT INTO `payment_item` (`id`, `request_id`, `expense_id`, `text`, `text2`, `amount`, `vat`, `wt`, `status`, `updated`, `created`) VALUES
(1, 1, 5, 'aa', '11', 2000.00, 140.00, 0.00, 1, NULL, '2025-01-27 21:17:04'),
(2, 1, 3, 'aa', '11', 4000.00, 280.00, 0.00, 1, NULL, '2025-01-27 21:17:04'),
(3, 1, 6, 'aa', '11', 2000.00, 0.00, 60.00, 1, NULL, '2025-01-27 21:17:04'),
(4, 1, 8, 'bb', '22', 4000.00, 0.00, 120.00, 1, NULL, '2025-01-27 21:17:04'),
(5, 1, 9, 'bb', '22', 2000.00, 140.00, 60.00, 1, NULL, '2025-01-27 21:17:04'),
(6, 1, 16, 'bb', '22', 4000.00, 280.00, 120.00, 1, NULL, '2025-01-27 21:17:04'),
(7, 2, 3, 'aaa', '111', 3000.00, 210.00, 6.00, 1, NULL, '2025-01-27 21:20:43'),
(8, 2, 4, 'aaa', '111', 2000.00, 140.00, 0.00, 1, NULL, '2025-01-27 21:20:43'),
(9, 2, 8, 'bbb', '222', 3000.00, 0.00, 0.00, 1, NULL, '2025-01-27 21:20:43'),
(10, 2, 14, 'bbb', '222', 2000.00, 0.00, 0.00, 1, NULL, '2025-01-27 21:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment_remark`
--

CREATE TABLE `payment_remark` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `type` int(1) NOT NULL,
  `cheque_bank` varchar(100) DEFAULT NULL,
  `cheque_branch` varchar(100) DEFAULT NULL,
  `cheque_number` varchar(100) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `action` int(1) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `uuid`, `last`, `login_id`, `order_number`, `receiver`, `type`, `cheque_bank`, `cheque_branch`, `cheque_number`, `cheque_date`, `action`, `status`, `updated`, `created`) VALUES
(1, '64b637e7-dcb9-11ef-8d5e-0242ac120004', 1, 1, 'SO07010001', 'BBB', 1, '', '', '', '0000-00-00', 1, 1, NULL, '2025-01-27 21:17:04'),
(2, 'e7af6974-dcb9-11ef-8d5e-0242ac120004', 2, 1, '', 'AAA', 2, 'AAA', 'BBB', 'AAA', '2025-01-27', 1, 1, NULL, '2025-01-27 21:20:43');

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
(1, 1, 'Admin', 'System', NULL, ''),
(2, 2, 'User', 'System', 1, '');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_file`
--
ALTER TABLE `payment_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_item`
--
ALTER TABLE `payment_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_remark`
--
ALTER TABLE `payment_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
