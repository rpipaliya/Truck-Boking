-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 04:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truckbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(2, 'amishabenramani@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_payment`
--

CREATE TABLE `admin_payment` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `transporter_id` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_payment`
--

INSERT INTO `admin_payment` (`id`, `payment_id`, `transporter_id`, `payment_amount`, `date`) VALUES
(8, 70, 12, 1029, '2021-06-24'),
(9, 71, 12, 2709, '2021-05-24'),
(10, 72, 12, 2591, '2022-09-24'),
(11, 73, 12, 886, '2022-08-24'),
(12, 74, 12, 1254, '2022-07-24'),
(13, 75, 12, 2128, '2023-10-24'),
(14, 76, 12, 2598, '2023-10-24'),
(15, 77, 12, 3120, '2023-10-24'),
(16, 78, 12, 2670, '2023-10-24'),
(17, 79, 12, 3669, '2023-10-24'),
(18, 80, 12, 2124, '2023-10-24'),
(19, 81, 12, 3455, '2023-10-24'),
(20, 82, 12, 2123, '2023-09-24'),
(21, 83, 12, 1685, '2021-04-24'),
(22, 84, 12, 1713, '2021-03-24'),
(23, 85, 12, 3778, '2022-06-24'),
(24, 86, 12, 3784, '2023-08-24'),
(25, 87, 12, 3301, '2022-05-24'),
(26, 88, 12, 1345, '2022-04-24'),
(27, 89, 12, 3656, '2023-07-24'),
(28, 90, 12, 855, '2023-10-24'),
(29, 91, 12, 1719, '2023-06-24'),
(30, 92, 12, 2469, '2023-05-24'),
(31, 93, 12, 948, '2021-01-24'),
(32, 94, 12, 1645, '2021-02-24'),
(33, 95, 12, 1322, '2022-03-24'),
(34, 96, 12, 2122, '2022-02-24'),
(35, 97, 12, 2454, '2022-01-24'),
(36, 98, 12, 860, '2023-04-24'),
(37, 99, 12, 2597, '2023-03-24'),
(38, 100, 12, 1345, '2023-02-24'),
(39, 101, 12, 3134, '2023-01-24'),
(40, 102, 12, 7279, '2023-10-27'),
(41, 103, 12, 3623, '2023-10-28'),
(42, 104, 12, 24886, '2023-10-28'),
(43, 105, 12, 1223, '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `assign_driver`
--

CREATE TABLE `assign_driver` (
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `order_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_driver`
--

INSERT INTO `assign_driver` (`order_id`, `driver_id`, `booking_id`, `order_status`) VALUES
(121, 2, 203, '1'),
(122, 2, 208, '0'),
(123, 2, 205, '0'),
(124, 2, 204, '0');

--
-- Triggers `assign_driver`
--
DELIMITER $$
CREATE TRIGGER `assign_driver_trigger` AFTER INSERT ON `assign_driver` FOR EACH ROW BEGIN
    UPDATE truck_booking
    SET assign_driver_status = '1'
    WHERE booking_id = NEW.booking_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phoneno` char(10) DEFAULT NULL,
  `contact_subject` varchar(100) DEFAULT NULL,
  `contact_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_locations`
--

CREATE TABLE `driver_locations` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_locations`
--

INSERT INTO `driver_locations` (`id`, `driver_id`, `latitude`, `longitude`) VALUES
(28, 1, '21.218804', '72.862522'),
(29, 2, '21.069235', '72.862543'),
(33, 4, '21.264095', '72.934789'),
(36, 7, '21.069184', '73.133843');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_service` char(9) NOT NULL,
  `rating_performance` char(9) NOT NULL,
  `feedback_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `rating_service`, `rating_performance`, `feedback_description`) VALUES
(32, 12, '0', '1', NULL),
(33, 12, '1', '1', NULL),
(34, 12, '0', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL,
  `goods_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`goods_id`, `goods_type`) VALUES
(7, ''),
(10, 'Animal'),
(5, 'Electrical Wires / Cables'),
(3, 'Industrial Machinery'),
(6, 'Livestock'),
(1, 'metal'),
(4, 'Solar / Battery / Inverter Products'),
(8, 'water');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `payment_amount` float NOT NULL,
  `payment_date` datetime NOT NULL,
  `transaction_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `payment_amount`, `payment_date`, `transaction_id`) VALUES
(70, 203, 5145.4, '2021-10-24 07:49:11', 'pay_MrsPSR5AWUezPD'),
(71, 204, 13545.3, '2021-10-24 07:51:42', 'pay_MrsS7LkRDdGIew'),
(72, 205, 12954, '2022-10-24 07:52:47', 'pay_MrsTGiUpou9uOq'),
(73, 206, 4429.13, '2022-10-24 07:53:59', 'pay_MrsUWnv0DCFsgZ'),
(74, 207, 6270.14, '2022-10-24 07:55:30', 'pay_MrsW59kYR1K6r7'),
(75, 208, 10641.5, '2023-10-24 07:57:05', 'pay_MrsXnc4HMTLeEk'),
(76, 209, 12990.3, '2023-10-24 07:58:08', 'pay_MrsYuiEXEbrVva'),
(77, 210, 15599.3, '2023-10-24 07:59:24', 'pay_MrsaFZd9caOGVw'),
(78, 211, 13352.3, '2023-10-24 08:01:28', 'pay_MrscNPquXya14d'),
(79, 212, 18345.1, '2023-10-24 08:07:18', 'pay_MrsibR4ZdOmEr1'),
(80, 213, 10618.2, '2023-10-24 08:23:54', 'pay_Mrt097vMdVRUa3'),
(81, 214, 17275.2, '2023-10-24 08:25:06', 'pay_Mrt1O3GVfAycke'),
(82, 215, 10616.5, '2023-10-24 08:26:15', 'pay_Mrt2cshjJ3DS8o'),
(83, 216, 8424.86, '2021-10-24 08:27:40', 'pay_Mrt4758LQOLrKO'),
(84, 217, 8564.72, '2021-10-24 08:28:48', 'pay_Mrt5Id8RShvyeM'),
(85, 218, 18890.1, '2022-10-24 08:29:58', 'pay_Mrt6Y4wSuwkrrs'),
(86, 219, 18921.9, '2023-10-24 08:30:51', 'pay_Mrt7TlUQ4XM802'),
(87, 220, 16504, '2022-10-24 08:31:46', 'pay_Mrt8RNW8DRd9kJ'),
(88, 221, 6724.78, '2022-10-24 08:32:38', 'pay_Mrt9Ms49SOV1GQ'),
(89, 222, 18278.8, '2023-10-24 08:33:25', 'pay_MrtAAbnFBYjOrH'),
(90, 223, 4273.92, '2023-10-24 08:55:44', 'pay_MrtXlGh9kN10zM'),
(91, 224, 8596.24, '2023-10-24 08:57:26', 'pay_MrtZYycVepYtYm'),
(92, 225, 12347, '2023-10-24 08:59:06', 'pay_MrtbJeA2iYhEeb'),
(93, 226, 4741.81, '2021-10-24 09:00:59', 'pay_MrtdIeTB8GwUfN'),
(94, 227, 8222.86, '2021-10-24 09:04:06', 'pay_MrtgbqvEvDvgWs'),
(95, 228, 6608.05, '2022-10-24 09:05:50', 'pay_MrtiOTXWuzJrls'),
(96, 229, 10611.2, '2022-10-24 09:07:26', 'pay_Mrtk7Qwtm0Vvqu'),
(97, 230, 12271.8, '2022-10-24 09:09:38', 'pay_MrtmRRXdpTHegk'),
(98, 231, 4301.28, '2023-10-24 09:11:13', 'pay_Mrto6zDwfsXN1P'),
(99, 232, 12985.1, '2023-10-24 09:13:04', 'pay_Mrtq4fVxXalwA0'),
(100, 233, 6724.78, '2023-10-24 09:14:37', 'pay_MrtriDK7JMcExF'),
(101, 234, 15667.8, '2023-10-24 09:15:51', 'pay_Mrtt0Vq9h5uM2k'),
(102, 235, 36393.7, '2023-10-27 13:43:40', 'pay_MtA3Dvwrtyu0oL'),
(103, 236, 18113.7, '2023-10-28 08:41:19', 'pay_MtTQygoEFxfiS4'),
(104, 237, 124429, '2023-10-28 13:31:52', 'pay_MtYNbzP9phsZ0Y'),
(105, 238, 6113.68, '2024-04-10 14:30:31', 'pay_NwrWivJIMgQX0W');

-- --------------------------------------------------------

--
-- Table structure for table `reject_booking`
--

CREATE TABLE `reject_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `pickup_date` datetime NOT NULL,
  `drop_date` datetime NOT NULL,
  `pickup_address` varchar(95) NOT NULL,
  `drop_address` varchar(95) NOT NULL,
  `goods_weight` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tranceporter_payment`
--

CREATE TABLE `tranceporter_payment` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `transporter_id` int(11) NOT NULL,
  `payment_amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tranceporter_payment`
--

INSERT INTO `tranceporter_payment` (`id`, `payment_id`, `truck_id`, `booking_id`, `transporter_id`, `payment_amount`, `date`) VALUES
(6, 70, 10, 203, 12, 4116.32, '2021-01-24'),
(7, 71, 10, 204, 12, 10836.2, '2021-02-24'),
(8, 72, 11, 205, 12, 10363.2, '2022-01-24'),
(9, 73, 12, 206, 12, 3543.3, '2022-03-24'),
(10, 74, 13, 207, 12, 5016.11, '2022-04-24'),
(11, 75, 10, 208, 12, 8513.19, '2023-05-24'),
(12, 76, 11, 209, 12, 10392.2, '2023-06-24'),
(13, 77, 10, 210, 12, 12479.4, '2023-07-24'),
(14, 78, 11, 211, 12, 10681.9, '2023-08-24'),
(15, 79, 11, 212, 12, 14676.1, '2023-09-24'),
(16, 80, 10, 213, 12, 8494.54, '2021-10-24'),
(17, 81, 11, 214, 12, 13820.2, '2023-01-24'),
(18, 82, 10, 215, 12, 8493.18, '2023-02-24'),
(19, 83, 12, 216, 12, 6739.89, '2021-05-24'),
(20, 84, 12, 217, 12, 6851.78, '2021-06-24'),
(21, 85, 11, 218, 12, 15112.1, '2022-02-24'),
(22, 86, 11, 219, 12, 15137.5, '2023-03-24'),
(23, 87, 12, 220, 12, 13203.2, '2022-06-24'),
(24, 88, 13, 221, 12, 5379.82, '2022-10-24'),
(25, 89, 10, 222, 12, 14623, '2023-04-24'),
(26, 90, 9, 223, 12, 3419.14, '2023-11-24'),
(27, 91, 12, 224, 12, 6876.99, '2023-12-24'),
(28, 92, 14, 225, 12, 9877.57, '2021-09-24'),
(29, 93, 9, 226, 12, 3793.45, '2021-03-24'),
(30, 94, 12, 227, 12, 6578.29, '2021-04-24'),
(31, 95, 13, 228, 12, 5286.44, '2022-07-24'),
(32, 96, 10, 229, 12, 8488.98, '2022-08-24'),
(33, 97, 11, 230, 12, 9817.46, '2022-09-24'),
(34, 98, 9, 231, 12, 3441.02, '2023-10-24'),
(35, 99, 11, 232, 12, 10388.1, '2021-08-24'),
(36, 100, 13, 233, 12, 5379.82, '2021-07-24'),
(37, 101, 14, 234, 12, 12534.2, '2022-05-24'),
(38, 102, 13, 235, 12, 29114.9, '2023-10-27'),
(39, 103, 11, 236, 12, 14490.9, '2023-10-28'),
(40, 104, 12, 237, 12, 99543.3, '2023-10-28'),
(41, 105, 11, 238, 12, 4890.94, '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `truck_booking`
--

CREATE TABLE `truck_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `pickup_date` datetime NOT NULL,
  `drop_date` datetime NOT NULL,
  `pickup_address` varchar(95) NOT NULL,
  `drop_address` varchar(95) NOT NULL,
  `goods_weight` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `assign_driver_status` char(1) NOT NULL,
  `accept_order_status` char(1) DEFAULT NULL,
  `read_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truck_booking`
--

INSERT INTO `truck_booking` (`booking_id`, `booking_date`, `pickup_date`, `drop_date`, `pickup_address`, `drop_address`, `goods_weight`, `user_id`, `truck_id`, `goods_id`, `assign_driver_status`, `accept_order_status`, `read_status`) VALUES
(203, '2021-01-01 07:49:11', '2021-01-02 07:47:00', '2021-01-03 07:47:00', 'gondal', 'amreli', 565, 12, 10, 3, '1', '0', 0),
(204, '2021-02-05 07:51:42', '2021-02-14 07:49:00', '2021-02-16 07:49:00', 'vayara', 'amreli', 989, 12, 10, 3, '1', '0', 0),
(205, '2022-03-10 07:52:47', '2022-03-14 07:51:00', '2022-03-16 07:51:00', 'bardoli', 'rajkot', 900, 12, 11, 3, '1', '0', 0),
(206, '2022-04-20 07:53:59', '2022-04-27 07:52:00', '2022-04-28 07:53:00', 'Surat', 'amreli', 989, 12, 12, 3, '0', '0', 1),
(207, '2022-05-12 07:55:30', '2022-05-16 07:54:00', '2023-05-18 07:54:00', 'anand', 'kalol', 900, 12, 13, 10, '0', '0', 1),
(208, '2023-06-05 07:57:05', '2023-06-14 07:56:00', '2023-06-16 07:56:00', 'gondal', 'bardoli', 155, 12, 10, 5, '1', '0', 0),
(209, '2023-06-24 07:58:08', '2023-07-24 07:57:00', '2023-07-26 07:57:00', 'jamnagar', 'Gandhinagar', 900, 12, 11, 3, '0', '0', 1),
(210, '2023-07-05 07:59:24', '2023-08-15 07:58:00', '2023-08-18 07:58:00', 'kheda', 'valsad', 900, 12, 10, 3, '0', '0', 1),
(211, '2023-09-12 08:01:28', '2023-09-21 07:59:00', '2023-09-23 07:59:00', 'Jetpur', 'dahod', 155, 12, 11, 6, '0', '0', 1),
(212, '2023-10-24 08:07:18', '2023-10-16 08:06:00', '2023-10-19 08:06:00', 'gondal', 'jamnagar', 989, 12, 11, 5, '0', '0', 1),
(213, '2023-01-10 08:23:54', '2023-01-17 08:16:00', '2023-01-19 08:22:00', 'gondal', 'navsari', 989, 15, 10, 3, '0', '0', 1),
(214, '2023-02-10 08:25:06', '2023-02-13 08:24:00', '2023-02-15 08:24:00', 'vayara', 'rajkot', 565, 15, 11, 1, '0', '0', 1),
(215, '2023-03-10 08:26:15', '2023-03-15 08:25:00', '2023-03-17 08:25:00', 'Jetpur', 'kalol', 900, 15, 10, 3, '0', '0', 1),
(216, '2021-04-21 08:27:40', '2021-04-24 08:26:00', '2021-04-26 08:26:00', 'Gandhinagar', 'dahod', 155, 15, 12, 5, '0', '0', 1),
(217, '2021-05-24 08:28:48', '2021-05-14 08:27:00', '2021-05-16 08:27:00', 'Amreli', 'kalol', 565, 15, 12, 1, '0', '0', 1),
(218, '2022-10-24 08:29:58', '2022-06-20 08:28:00', '2022-06-23 08:29:00', 'Bharuch', 'morbi', 155, 15, 11, 1, '0', '0', 1),
(219, '2023-10-24 08:30:51', '2023-07-19 08:30:00', '2023-07-22 08:30:00', 'junagadh', 'navsari', 989, 15, 11, 1, '0', '0', 1),
(220, '2022-10-24 08:31:46', '2022-08-14 08:30:00', '2022-08-18 08:31:00', 'kheda', 'navsari', 155, 15, 12, 1, '0', '0', 1),
(221, '2022-10-24 08:32:38', '2022-09-20 08:31:00', '2022-09-22 08:31:00', 'Rajkot', 'surat', 900, 15, 13, 8, '0', '0', 1),
(222, '2023-10-24 08:33:25', '2023-10-18 08:32:00', '2023-10-21 08:32:00', 'vayara', 'surat', 565, 15, 10, 3, '0', '0', 1),
(223, '2023-01-01 08:55:44', '2023-01-01 08:54:00', '2023-01-03 08:54:00', 'vapi', 'surat', 9000, 14, 9, 1, '0', '0', 1),
(224, '2023-02-06 08:57:26', '2023-02-08 08:56:00', '2023-02-10 08:56:00', 'gandhinagar', 'bardoli', 888, 14, 12, 1, '0', '0', 1),
(225, '2023-03-10 08:59:06', '2023-03-14 08:57:00', '2023-03-16 08:57:00', 'veraval', 'amreli', 7000, 14, 14, 1, '0', '0', 1),
(226, '2021-04-05 09:00:59', '2023-04-11 08:59:00', '2023-04-13 08:59:00', 'gondal', 'navsari', 6000, 14, 9, 5, '0', '0', 1),
(227, '2021-05-05 09:04:06', '2023-05-16 09:02:00', '2023-05-18 09:02:00', 'Amreli', 'rajkot', 2000, 14, 12, 3, '0', '0', 1),
(228, '2022-06-20 09:05:50', '2023-06-24 09:04:00', '2023-06-26 09:04:00', 'Rajkot', 'kalol', 898, 14, 13, 3, '0', '0', 1),
(229, '2022-07-20 09:07:26', '2023-07-25 09:06:00', '2023-07-27 09:06:00', 'kalol', 'bardoli', 9000, 14, 10, 1, '0', '0', 1),
(230, '2022-08-15 09:09:38', '2023-08-23 09:07:00', '2023-08-25 09:07:00', 'amreli', 'junagadh', 9000, 14, 11, 3, '0', '0', 1),
(231, '2023-09-18 09:11:13', '2023-09-24 09:09:00', '2023-09-26 09:10:00', 'porbandae', 'jamnagar', 7000, 14, 9, 4, '0', '0', 1),
(232, '2023-10-15 09:13:04', '2023-10-25 09:12:00', '2023-10-27 09:12:00', 'gondal', 'vapi', 9000, 14, 11, 4, '0', '0', 1),
(233, '2023-10-24 09:14:37', '2023-11-14 09:13:00', '2023-11-16 09:13:00', 'rajkot', 'surat', 900, 14, 13, 3, '0', '0', 1),
(234, '2023-10-24 09:15:51', '2023-12-20 09:14:00', '2023-12-22 09:14:00', 'vayara', 'vapi', 7000, 14, 14, 4, '0', '0', 1),
(235, '2023-10-27 13:43:40', '2023-10-18 13:42:00', '2023-10-30 13:42:00', 'Surat', 'baroda', 900, 14, 13, 3, '0', '0', 1),
(236, '2023-10-28 08:41:19', '2023-10-30 08:39:00', '2023-11-02 08:39:00', 'SURAT', 'bardoli', 155, 12, 11, 3, '0', '0', 1),
(237, '2023-10-28 13:31:52', '2023-11-01 13:25:00', '2023-12-02 13:25:00', 'SURAT', 'amreli', 9000, 12, 12, 3, '0', '0', 1),
(238, '2024-04-10 14:30:31', '2024-04-10 14:28:00', '2024-04-11 14:28:00', 'surat', 'bardoli', 500, 12, 11, 3, '0', '0', 1);

--
-- Triggers `truck_booking`
--
DELIMITER $$
CREATE TRIGGER `book_reject` AFTER DELETE ON `truck_booking` FOR EACH ROW BEGIN INSERT INTO reject_booking VALUES ( old.booking_id, old.booking_date, old.pickup_date, old.drop_date, old.pickup_address, old.drop_address, old.goods_weight, old.user_id, old.truck_id, old.goods_id ); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `truck_company`
--

CREATE TABLE `truck_company` (
  `truck_company_id` int(11) NOT NULL,
  `truck_company_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truck_company`
--

INSERT INTO `truck_company` (`truck_company_id`, `truck_company_name`) VALUES
(2, 'Mahindra'),
(1, 'Tata');

-- --------------------------------------------------------

--
-- Table structure for table `truck_detials`
--

CREATE TABLE `truck_detials` (
  `truck_id` int(11) NOT NULL,
  `truck_register_number` varchar(10) NOT NULL,
  `truck_image1` varchar(259) NOT NULL,
  `truck_image2` varchar(259) NOT NULL,
  `truck_image3` varchar(259) NOT NULL,
  `truck_name` varchar(30) NOT NULL,
  `truck_size` varchar(14) NOT NULL,
  `truck_model` varchar(10) NOT NULL,
  `truck_capacity` float NOT NULL,
  `truck_company_id` int(11) NOT NULL,
  `truck_fule` char(6) NOT NULL,
  `hour_rate` float NOT NULL,
  `day_rate` float NOT NULL,
  `fule_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truck_detials`
--

INSERT INTO `truck_detials` (`truck_id`, `truck_register_number`, `truck_image1`, `truck_image2`, `truck_image3`, `truck_name`, `truck_size`, `truck_model`, `truck_capacity`, `truck_company_id`, `truck_fule`, `hour_rate`, `day_rate`, `fule_rate`) VALUES
(9, 'GJ05js5890', 'truck_images/eicher_14_feet.png', 'truck_images/eicher_14_feet2.jpeg', 'truck_images/eicher_14_feet3.jpg', 'EICHER 14 FEET', '21 L X 7.2 W X', 'Q23T', 1000, 1, 'Diesel', 500, 2000, 3),
(10, 'GJ05MH5698', 'truck_images/eicher_17_feet.jpeg', 'truck_images/eicher_17_feet2.jpg', 'truck_images/eicher_17_feet3.jpg', 'EICHER 17 FEET', '24 L X 7.3 W X', 'We54', 580, 2, 'Diesel', 300, 5000, 2.5),
(11, 'GJ26RJ5689', 'truck_images/eicher_tipper2.jpg', 'truck_images/eicher_tipper2.webp', 'truck_images/eicher_tipper3.jpg', 'EICHER TIPPER', '24 L X 7.3 W X', 'Q56', 850, 2, 'Diesel', 600, 6000, 3.5),
(12, 'GJ89RJ0056', 'truck_images/mahindra_bolero_pickup.jpg', 'truck_images/mahindra_bolero_pickup2.png', 'truck_images/mahindra_bolero_pickup3.jpg', 'MAHINDRA BOLERO ', '7 L X 4.8 W X ', 'Q56', 950, 2, 'Petrol', 500, 4000, 2.5),
(13, 'GJ21NJ9645', 'truck_images/tata_ace.jpg', 'truck_images/tata_ace2.jpg', 'truck_images/tata_ace3.jpg', 'TATA ACE', '7 L X 4.8 W X ', 'Q23L', 1200, 1, 'Diesel', 600, 3000, 3),
(14, 'GJ09RJ0890', 'truck_images/tata1.jpg', 'truck_images/tata2.jpg', 'truck_images/tata3.jpg', 'TAURUS 16 T ', '7 L X 4.8 W X ', 'Q89', 850, 1, 'Diesel', 600, 6000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `truck_driver`
--

CREATE TABLE `truck_driver` (
  `driver_id` int(11) NOT NULL,
  `driver_fullname` varchar(50) NOT NULL,
  `driver_email` varchar(255) NOT NULL,
  `driver_contactno_primary` char(10) NOT NULL,
  `driver_contactno_secoundary` char(10) DEFAULT NULL,
  `driver_address` varchar(95) NOT NULL,
  `driver_city` varchar(16) NOT NULL,
  `driver_pincode` char(6) NOT NULL,
  `driver_license` char(16) NOT NULL,
  `driver_password` varchar(32) NOT NULL DEFAULT '5f4dcc3b5aa765d61d8327deb882cf99',
  `driver_active_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truck_driver`
--

INSERT INTO `truck_driver` (`driver_id`, `driver_fullname`, `driver_email`, `driver_contactno_primary`, `driver_contactno_secoundary`, `driver_address`, `driver_city`, `driver_pincode`, `driver_license`, `driver_password`, `driver_active_status`) VALUES
(1, 'Rushil Pipaliya', 'pipaliyarushil888@gmail.com', '9510106511', NULL, 'Surat', 'surat', '394190', 'GJ15RJ1002', '656c1d6cd9c3f1b423c27964981069d2', '0'),
(2, 'Amisha Ramani', 'amishabenramani@gmail.com', '9033018682', NULL, 'surat', 'bardoli', '395006', '89187813871', '202cb962ac59075b964b07152d234b70', '0'),
(4, 'Renish Amipara', 'ramipara2004@gmail.com ', '9033018682', NULL, 'surat', 'surat', '395006', 'Gh05256565', '1a1dc91c907325c69271ddf0c944bc72', '0'),
(7, 'Raj Patel', 'rem66657@gmail.com', '9510106511', '', 'KAMREJ', 'SURAT', '394180', 'GJ19 4567825', '202cb962ac59075b964b07152d234b70', '0');

-- --------------------------------------------------------

--
-- Table structure for table `truck_rating`
--

CREATE TABLE `truck_rating` (
  `feedback_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `truck_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truck_rating`
--

INSERT INTO `truck_rating` (`feedback_id`, `truck_id`, `truck_rating`) VALUES
(3, 11, 4),
(4, 11, 4),
(5, 11, 5),
(6, 12, 2),
(7, 13, 1),
(8, 12, 1),
(9, 12, 2),
(3, 11, 4),
(4, 11, 4),
(5, 11, 5),
(6, 12, 2),
(7, 13, 1),
(8, 12, 1),
(9, 12, 2),
(3, 11, 4),
(4, 11, 4),
(5, 11, 5),
(6, 12, 2),
(7, 13, 1),
(8, 12, 1),
(9, 12, 2),
(0, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_contactno_primary` char(10) NOT NULL,
  `user_contactno_secoundary` char(10) DEFAULT NULL,
  `user_gender` char(1) NOT NULL,
  `user_address` varchar(95) NOT NULL,
  `user_city` varchar(13) NOT NULL,
  `user_pincode` char(6) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_type`, `user_email`, `user_fullname`, `user_contactno_primary`, `user_contactno_secoundary`, `user_gender`, `user_address`, `user_city`, `user_pincode`, `user_password`, `user_register_date`) VALUES
(12, 0, 'amishabenramani@gmail.com', 'Amisha Ramani', '9033018682', '', 'f', 'saanvi heights', 'SURAT', '395006', '979468d8173d5bc29b3096a40345b6a9', '0000-00-00 00:00:00'),
(14, 0, 'pipaliyarushil111@gmail.com', 'Rushil Pipaliy', '9725005862', '', 'm', 'surat', 'surat', '395006', '1bf3cff815429355092e6fb2cc0a9aec', '0000-00-00 00:00:00'),
(15, 0, 'ramipara2004@gmail.com', 'Renish Amipara', '9033018682', '', 'm', 'surat', 'surat', '395006', '1859a36fe541af1c9c728fb3a8880ef2', '0000-00-00 00:00:00'),
(17, 1, 'pipaliyarushil888@gmail.com', 'Pipaliya Rushil', '9725005862', '', 'm', 'Santlal society hariom app 302 hirabag surat', 'Surat', '396009', '979468d8173d5bc29b3096a40345b6a9', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `admin_payment`
--
ALTER TABLE `admin_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key` (`payment_id`),
  ADD KEY `ttt` (`transporter_id`);

--
-- Indexes for table `assign_driver`
--
ALTER TABLE `assign_driver`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driverid` (`driver_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`),
  ADD UNIQUE KEY `goods_type` (`goods_type`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `foreign_key_name` (`booking_id`);

--
-- Indexes for table `reject_booking`
--
ALTER TABLE `reject_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tranceporter_payment`
--
ALTER TABLE `tranceporter_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pfk` (`payment_id`),
  ADD KEY `ttfk` (`truck_id`),
  ADD KEY `FK_BOOKINGID` (`booking_id`),
  ADD KEY `txtx` (`transporter_id`);

--
-- Indexes for table `truck_booking`
--
ALTER TABLE `truck_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `FK` (`user_id`),
  ADD KEY `FoK` (`truck_id`),
  ADD KEY `Fo` (`goods_id`);

--
-- Indexes for table `truck_company`
--
ALTER TABLE `truck_company`
  ADD PRIMARY KEY (`truck_company_id`),
  ADD UNIQUE KEY `truck_company_name` (`truck_company_name`);

--
-- Indexes for table `truck_detials`
--
ALTER TABLE `truck_detials`
  ADD PRIMARY KEY (`truck_id`),
  ADD UNIQUE KEY `truck_register_number` (`truck_register_number`),
  ADD KEY `foreign key` (`truck_company_id`);

--
-- Indexes for table `truck_driver`
--
ALTER TABLE `truck_driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `truck_rating`
--
ALTER TABLE `truck_rating`
  ADD KEY `truck_rating_ibfk_1` (`truck_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_payment`
--
ALTER TABLE `admin_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `assign_driver`
--
ALTER TABLE `assign_driver`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver_locations`
--
ALTER TABLE `driver_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tranceporter_payment`
--
ALTER TABLE `tranceporter_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `truck_booking`
--
ALTER TABLE `truck_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `truck_company`
--
ALTER TABLE `truck_company`
  MODIFY `truck_company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `truck_detials`
--
ALTER TABLE `truck_detials`
  MODIFY `truck_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `truck_driver`
--
ALTER TABLE `truck_driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_payment`
--
ALTER TABLE `admin_payment`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `ttt` FOREIGN KEY (`transporter_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `assign_driver`
--
ALTER TABLE `assign_driver`
  ADD CONSTRAINT `assign_driver_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `truck_booking` (`booking_id`),
  ADD CONSTRAINT `driver_id` FOREIGN KEY (`driver_id`) REFERENCES `truck_driver` (`driver_id`);

--
-- Constraints for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD CONSTRAINT `driverid` FOREIGN KEY (`driver_id`) REFERENCES `truck_driver` (`driver_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `truck_booking` (`booking_id`);

--
-- Constraints for table `tranceporter_payment`
--
ALTER TABLE `tranceporter_payment`
  ADD CONSTRAINT `FK_BOOKINGID` FOREIGN KEY (`booking_id`) REFERENCES `truck_booking` (`booking_id`),
  ADD CONSTRAINT `pfk` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `ttfk` FOREIGN KEY (`truck_id`) REFERENCES `truck_detials` (`truck_id`),
  ADD CONSTRAINT `txtx` FOREIGN KEY (`transporter_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `truck_booking`
--
ALTER TABLE `truck_booking`
  ADD CONSTRAINT `FK` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`),
  ADD CONSTRAINT `Fo` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`),
  ADD CONSTRAINT `FoK` FOREIGN KEY (`truck_id`) REFERENCES `truck_detials` (`truck_id`);

--
-- Constraints for table `truck_detials`
--
ALTER TABLE `truck_detials`
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`truck_company_id`) REFERENCES `truck_company` (`truck_company_id`);

--
-- Constraints for table `truck_rating`
--
ALTER TABLE `truck_rating`
  ADD CONSTRAINT `truck_rating_ibfk_1` FOREIGN KEY (`truck_id`) REFERENCES `truck_detials` (`truck_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
