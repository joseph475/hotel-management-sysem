-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2019 at 03:20 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `addedextras`
--

CREATE TABLE `addedextras` (
  `id` int(11) NOT NULL,
  `checkinId` int(11) NOT NULL,
  `extrasId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addedfoods`
--

CREATE TABLE `addedfoods` (
  `id` int(11) NOT NULL,
  `checkinId` int(11) NOT NULL,
  `foodsId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `ORNumber` int(11) NOT NULL,
  `checkInId` int(11) NOT NULL,
  `collection` float NOT NULL,
  `date_collected` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` int(11) NOT NULL,
  `room_id` varchar(50) NOT NULL,
  `guestId` int(11) NOT NULL,
  `checkInDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkOutDate` datetime DEFAULT NULL,
  `adultsCount` int(11) NOT NULL DEFAULT '0',
  `childrenCount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `room_id`, `guestId`, `checkInDate`, `checkOutDate`, `adultsCount`, `childrenCount`) VALUES
(1, '5', 1, '2019-04-24 09:44:41', '2019-04-27 17:44:41', 2, 2),
(2, '14', 2, '2019-04-24 09:45:41', '2019-04-24 23:45:41', 2, 2),
(3, '17', 3, '2019-04-24 12:15:47', '2019-04-29 20:15:47', 1, 1),
(4, '3', 4, '2019-04-24 12:24:24', '2019-04-24 21:24:24', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkin_table_room_billing`
--

CREATE TABLE `checkin_table_room_billing` (
  `id` int(11) NOT NULL,
  `checkin_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `days` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkin_table_room_billing`
--

INSERT INTO `checkin_table_room_billing` (`id`, `checkin_id`, `rate_id`, `days`, `created_at`) VALUES
(1, 1, 1, 3, '2019-04-24 09:44:41'),
(2, 2, 13, 0, '2019-04-24 09:45:41'),
(3, 3, 8, 5, '2019-04-24 12:15:47'),
(4, 4, 11, 0, '2019-04-24 12:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `room_id` varchar(50) NOT NULL,
  `guestId` int(11) NOT NULL,
  `checkIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkOutDate` datetime NOT NULL,
  `adultsCount` int(11) NOT NULL,
  `childrenCount` int(11) NOT NULL,
  `noOfDays` int(11) NOT NULL,
  `penaltyHours` int(11) NOT NULL,
  `raterefno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ispublished` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `description`, `cost`, `createdDate`, `ispublished`) VALUES
(1, 'ToothBrush', 50, '2018-12-23 16:32:59', 1),
(2, 'Pillow', 200, '2018-12-23 16:32:30', 0),
(3, 'Bed', 500, '2018-12-10 20:39:26', 1),
(4, 'Blanket', 100, '2018-12-10 20:39:26', 1),
(5, 'Pillow Case', 20, '2018-12-10 20:39:26', 1),
(6, 'Table', 500, '2018-12-10 20:39:26', 1),
(7, 'Spoon', 50, '2018-12-23 16:32:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `menuName` varchar(250) NOT NULL,
  `servings` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `cost` double NOT NULL,
  `sellingPrice` double NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ispublished` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `menuName`, `servings`, `remaining`, `cost`, `sellingPrice`, `createdDate`, `ispublished`) VALUES
(1, 'Adobo', 20, 20, 1000, 150, '2018-10-23 00:25:15', 1),
(2, 'Sinigang', 25, 25, 2500, 150, '2018-10-23 00:25:15', 1),
(3, 'Ice Tea', 500, 500, 25, 50, '2018-10-23 00:25:15', 0),
(4, 'Nilaga', 25, 25, 2200, 140, '2018-10-23 00:25:15', 0),
(5, 'Hotdog', 100, 100, 25, 30, '2018-10-23 00:25:15', 0),
(6, 'Delata', 15, 15, 50, 60, '2018-10-23 01:35:41', 0),
(7, 'Sardines', 7, 5, 45, 50, '2018-10-23 01:40:01', 1),
(8, 'Cornbeef', 25, 25, 70, 80, '2018-10-23 01:40:45', 1),
(9, 'Puto', 100, 100, 30, 40, '2018-10-23 01:44:08', 1),
(10, 'Banana', 50, 50, 25, 10, '2018-10-23 01:44:58', 0),
(11, 'Mango', 60, 58, 25, 10, '2018-10-23 01:45:50', 1),
(12, 'Sampalok', 20, 20, 50, 60, '2018-10-23 01:47:13', 1),
(13, 'Tinapay', 500, 497, 50, 50, '2019-02-13 15:36:48', 1),
(14, 'Tapa', 100, 100, 150, 170, '2019-04-24 19:39:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `companyAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `contact`, `email`, `companyName`, `companyAddress`) VALUES
(1, 'Mark Joseph Castelo', '9975785665', 'markjoseph475@gmail.com', NULL, NULL),
(2, 'Abigail Mariano', '9975785665', 'markjoseph475@gmail.com', NULL, NULL),
(4, 'Natsu Dragneel', '9975785665', 'markjoseph475@gmail.com', 'Fairy Tail', 'Magnoli');

-- --------------------------------------------------------

--
-- Table structure for table `loginnames`
--

CREATE TABLE `loginnames` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `accountType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginnames`
--

INSERT INTO `loginnames` (`id`, `username`, `password`, `accountType`) VALUES
(1, 'abi', 'admin', 'user'),
(2, 'Joseph', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `personal_id` varchar(255) NOT NULL,
  `personal_id_type` varchar(255) NOT NULL,
  `roomtype` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `compName` varchar(255) DEFAULT '',
  `compAddress` varchar(255) DEFAULT '',
  `checkInDate` date NOT NULL,
  `adultsCount` int(11) NOT NULL DEFAULT '0',
  `childrensCount` int(11) NOT NULL DEFAULT '0',
  `reservationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `room_id` int(11) DEFAULT NULL,
  `rate_id` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `personal_id`, `personal_id_type`, `roomtype`, `name`, `mobile`, `email`, `compName`, `compAddress`, `checkInDate`, `adultsCount`, `childrensCount`, `reservationDate`, `status`, `room_id`, `rate_id`, `days`) VALUES
(1, '332323', 'SSS', 3, 'Mark Joseph Castelo', '9975785665', 'markjoseph475@gmail.com', NULL, NULL, '2019-04-26', 2, 2, '2019-04-23 16:09:21', 'Checked_In', 5, 1, 3),
(2, '56789767', 'Pag Ibig', 4, 'Abigail Mariano', '9975785665', 'markjoseph475@gmail.com', NULL, NULL, '2019-04-29', 2, 2, '2019-04-23 16:25:15', 'Checked_In', 14, 13, 0),
(3, '2221113333', 'Pag Ibig', 1, 'Jerick Lumabas', '9975785665', 'markjoseph475@gmail.com', 'Unilab', 'Uniliver', '2019-04-27', 1, 1, '2019-04-24 09:48:13', 'Cancelled', 17, 8, 5),
(4, '66755675', 'Phil Health', 4, 'MOnkey D Luffy', '9975785665', 'markjoseph475@gmail.com', NULL, NULL, '2019-04-25', 1, 1, '2019-04-24 09:52:16', 'Cancelled', NULL, 12, 0),
(5, '7765675', 'Pag Ibig', 3, 'Natsu Dragneel', '9975785665', 'markjoseph475@gmail.com', 'Fairy Tail', 'Magnoli', '2019-04-30', 1, 1, '2019-04-24 11:41:18', 'Checked_In', 3, 11, 0),
(6, '131231', 'SSS', 1, 'Natsu Dragneel', '9975785665', 'markjoseph475@gmail.com', NULL, NULL, '2019-04-27', 1, 0, '2019-04-24 11:46:58', 'Cancelled', NULL, 6, 0),
(7, '332132313', 'Phil Health', 2, 'Mirana MoonFang', '123113', 'markjoseph475@gmail.com', NULL, NULL, '2019-04-26', 1, 0, '2019-04-24 12:25:05', 'Cancelled', 2, 4, 2),
(8, '332323', 'Voters ID', 1, 'Josh Matthew', '9975785665', 'markjoseph475@gmail.com', NULL, NULL, '2019-04-25', 1, 0, '2019-04-24 13:09:04', 'Cancelled', 10, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roominventory`
--

CREATE TABLE `roominventory` (
  `id` int(11) NOT NULL,
  `room_id` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roominventory`
--

INSERT INTO `roominventory` (`id`, `room_id`, `description`, `quantity`) VALUES
(1, '1', 'Aircon', 3),
(2, '6', 'Television', 1),
(3, '6', 'Beds', 3),
(4, '10', 'Remote Control', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `roomType` int(11) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Vacant',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ispublished` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomNo`, `roomType`, `floor`, `status`, `created_at`, `ispublished`) VALUES
(1, 1, 1, '1', 'Maintenance', '2019-02-14 08:44:21', 1),
(2, 2, 2, '2', 'Vacant', '2019-02-14 08:44:37', 1),
(3, 3, 3, '3', 'Occupied', '2019-02-14 08:44:48', 1),
(4, 4, 3, '3', 'Vacant', '2019-04-07 13:29:02', 1),
(5, 5, 3, '8', 'Occupied', '2019-04-10 15:37:27', 1),
(6, 6, 2, '8', 'Maintenance', '2019-04-10 15:37:37', 1),
(7, 7, 2, '3', 'Vacant', '2019-04-10 15:41:02', 1),
(8, 8, 2, '2', 'Vacant', '2019-04-10 15:42:07', 1),
(9, 9, 2, '3', 'Vacant', '2019-04-10 15:42:55', 1),
(10, 10, 1, '3', 'Vacant', '2019-04-10 15:47:27', 1),
(11, 11, 1, '13', 'Vacant', '2019-04-10 15:47:41', 1),
(12, 12, 3, '12', 'Vacant', '2019-04-10 15:49:37', 1),
(13, 13, 1, '1', 'Vacant', '2019-04-10 15:50:34', 1),
(14, 14, 4, '8', 'Occupied', '2019-04-12 02:11:40', 1),
(15, 15, 1, '4', 'Vacant', '2019-04-12 08:13:20', 1),
(16, 16, 1, '7', 'Vacant', '2019-04-12 08:13:31', 1),
(17, 17, 1, '9', 'Vacant', '2019-04-12 08:13:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text,
  `maxAdult` int(11) NOT NULL DEFAULT '0',
  `maxChildren` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rateperhour` double DEFAULT NULL,
  `ispublished` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`id`, `type`, `description`, `maxAdult`, `maxChildren`, `created_at`, `rateperhour`, `ispublished`) VALUES
(1, 'Economy', 'Economy Room', 2, 2, '2019-02-15 01:12:00', 100, 1),
(2, 'Deluxe', 'Deluxe Room', 5, 5, '2019-02-15 01:11:48', 100, 1),
(3, 'Super Deluxe', 'Super Deluxe', 8, 8, '2019-02-15 01:09:57', 300, 1),
(4, 'Family', '<p>Family Testingg</p>', 2, 3, '2019-04-10 16:01:53', 200, 1),
(5, 'Event Room', 'Event Room', 30, 30, '2019-04-24 11:34:30', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype_additional_rates`
--

CREATE TABLE `roomtype_additional_rates` (
  `id` int(11) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype_additional_rates`
--

INSERT INTO `roomtype_additional_rates` (`id`, `roomtype_id`, `hours`, `rate`, `created_at`) VALUES
(1, 3, 24, 3000, '2019-02-14 08:46:15'),
(2, 3, 4, 500, '2019-02-14 08:46:26'),
(3, 3, 8, 2000, '2019-02-14 08:46:41'),
(4, 2, 24, 2000, '2019-02-14 08:46:54'),
(5, 2, 8, 1000, '2019-02-14 08:47:04'),
(6, 1, 3, 500, '2019-02-14 08:47:14'),
(7, 1, 6, 1000, '2019-02-14 08:47:22'),
(8, 1, 24, 2000, '2019-02-14 08:47:35'),
(9, 3, 6, 800, '2019-02-15 01:10:38'),
(10, 2, 4, 500, '2019-02-15 03:23:13'),
(11, 3, 1, 100, '2019-02-15 12:15:24'),
(12, 4, 3, 600, '2019-04-10 16:01:11'),
(13, 4, 6, 900, '2019-04-10 16:01:27'),
(14, 5, 24, 20000, '2019-04-24 11:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_variables`
--

CREATE TABLE `system_variables` (
  `id` int(11) NOT NULL,
  `key_name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_variables`
--

INSERT INTO `system_variables` (`id`, `key_name`, `value`) VALUES
(1, 'Hotel', 'MJRC'),
(2, 'Address', '#182 brgy. Burgos, Sta. Rosa, Nueva Ecija'),
(3, 'Floor', '14'),
(4, 'Email', 'markjoseph475@gmail.com'),
(5, 'Contact1', '09153960030'),
(6, 'Contact2', '09452675595');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_dashboard_room_list`
-- (See below for the actual view)
--
CREATE TABLE `vw_dashboard_room_list` (
`room_id` int(11)
,`roomNo` int(11)
,`floor` varchar(50)
,`status` varchar(50)
,`ispublished` tinyint(4)
,`roomtype_id` int(11)
,`type` varchar(100)
,`rateperhour` double
,`maxAdult` int(11)
,`maxChildren` int(11)
,`checkin_id` int(11)
,`checkInDate` timestamp
,`checkOutDate` datetime
,`adultsCount` int(11)
,`childrenCount` int(11)
,`guest_id` int(11)
,`name` varchar(100)
,`contact` varchar(50)
,`companyName` varchar(255)
,`companyAddress` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_dashboard_room_list`
--
DROP TABLE IF EXISTS `vw_dashboard_room_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dashboard_room_list`  AS  select `a`.`id` AS `room_id`,`a`.`roomNo` AS `roomNo`,`a`.`floor` AS `floor`,`a`.`status` AS `status`,`a`.`ispublished` AS `ispublished`,`b`.`id` AS `roomtype_id`,`b`.`type` AS `type`,`b`.`rateperhour` AS `rateperhour`,`b`.`maxAdult` AS `maxAdult`,`b`.`maxChildren` AS `maxChildren`,`c`.`id` AS `checkin_id`,`c`.`checkInDate` AS `checkInDate`,`c`.`checkOutDate` AS `checkOutDate`,`c`.`adultsCount` AS `adultsCount`,`c`.`childrenCount` AS `childrenCount`,`d`.`id` AS `guest_id`,`d`.`name` AS `name`,`d`.`contact` AS `contact`,`d`.`companyName` AS `companyName`,`d`.`companyAddress` AS `companyAddress` from (((`rooms` `a` left join `roomtypes` `b` on((`a`.`roomType` = `b`.`id`))) left join `checkin` `c` on((`a`.`id` = `c`.`room_id`))) left join `guests` `d` on((`c`.`guestId` = `d`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addedextras`
--
ALTER TABLE `addedextras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addedfoods`
--
ALTER TABLE `addedfoods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkin_table_room_billing`
--
ALTER TABLE `checkin_table_room_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginnames`
--
ALTER TABLE `loginnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roominventory`
--
ALTER TABLE `roominventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtype_additional_rates`
--
ALTER TABLE `roomtype_additional_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_variables`
--
ALTER TABLE `system_variables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addedextras`
--
ALTER TABLE `addedextras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addedfoods`
--
ALTER TABLE `addedfoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checkin_table_room_billing`
--
ALTER TABLE `checkin_table_room_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loginnames`
--
ALTER TABLE `loginnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roominventory`
--
ALTER TABLE `roominventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomtype_additional_rates`
--
ALTER TABLE `roomtype_additional_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_variables`
--
ALTER TABLE `system_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
