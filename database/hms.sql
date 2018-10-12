-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 05:58 PM
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
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addedextras`
--

INSERT INTO `addedextras` (`id`, `checkinId`, `extrasId`, `quantity`) VALUES
(1, 1, 4, 2),
(2, 2, 1, 2),
(3, 2, 2, 2),
(4, 4, 4, 2),
(5, 7, 2, 1),
(6, 9, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `addedfoods`
--

CREATE TABLE `addedfoods` (
  `id` int(11) NOT NULL,
  `checkinId` int(11) NOT NULL,
  `foodsId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addedfoods`
--

INSERT INTO `addedfoods` (`id`, `checkinId`, `foodsId`, `quantity`) VALUES
(1, 1, 7, 4),
(2, 1, 12, 2),
(3, 2, 8, 4),
(4, 2, 1, 2),
(5, 3, 7, 2),
(6, 9, 1, 4),
(7, 9, 9, 2);

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

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`ORNumber`, `checkInId`, `collection`, `date_collected`) VALUES
(1, 1, 0, '0000-00-00 00:00:00'),
(2, 2, 0, '0000-00-00 00:00:00'),
(3, 3, 0, '0000-00-00 00:00:00'),
(4, 4, 0, '0000-00-00 00:00:00'),
(5, 5, 0, '0000-00-00 00:00:00'),
(6, 6, 0, '0000-00-00 00:00:00'),
(7, 7, 0, '0000-00-00 00:00:00'),
(8, 8, 1000, '2018-08-09 15:39:07'),
(9, 9, 6384, '2018-08-09 15:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` int(11) NOT NULL,
  `room_id` varchar(50) NOT NULL,
  `guestId` int(11) NOT NULL,
  `checkInDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkOutDate` datetime NOT NULL,
  `adultsCount` int(11) NOT NULL,
  `childrenCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `room_id`, `guestId`, `checkInDate`, `checkOutDate`, `adultsCount`, `childrenCount`) VALUES
(1, '2', 1, '2018-10-12 04:07:18', '2018-10-24 00:00:00', 5, 5),
(2, '3', 2, '2018-10-12 04:07:18', '2018-10-24 00:00:00', 5, 5),
(3, '4', 3, '2018-10-12 04:07:18', '2018-10-24 00:00:00', 5, 5),
(4, '5', 4, '2018-10-12 04:07:18', '2018-10-24 00:00:00', 5, 5),
(6, '65', 27, '2018-10-12 15:52:52', '2018-10-25 00:00:00', 3, 4);

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

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `room_id`, `guestId`, `checkIn`, `checkOutDate`, `adultsCount`, `childrenCount`, `noOfDays`, `penaltyHours`, `raterefno`) VALUES
(1, '1', 1, '2018-07-31 02:21:52', '2018-08-08 11:26:33', 2, 3, 0, 0, 1),
(2, '6', 2, '2018-07-31 02:24:27', '2018-08-09 15:11:36', 2, 4, 0, 0, 11),
(3, '5', 3, '2018-08-08 03:22:30', '2018-08-08 11:43:56', 2, 2, 0, 0, 2),
(4, '10', 4, '2018-08-08 03:24:43', '2018-08-08 11:28:41', 2, 1, 0, 0, 12),
(5, '4', 5, '2018-08-09 07:17:33', '2018-08-09 15:17:40', 2, 1, 1, 0, 1),
(6, '3', 6, '2018-08-09 07:19:26', '2018-08-09 15:19:34', 2, 2, 0, 0, 1),
(7, '1', 7, '2018-08-09 07:21:15', '2018-08-09 15:21:25', 2, 2, 1, 0, 1),
(8, '3', 8, '2018-08-09 07:31:09', '2018-08-09 15:39:07', 2, 2, 1, 0, 1),
(9, '8', 9, '2018-08-09 07:40:12', '2018-08-09 15:42:18', 2, 3, 1, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `description`, `cost`) VALUES
(1, 'ToothBrush', 50),
(2, 'Pillow', 200),
(3, 'Bed', 500),
(4, 'Blanket', 100),
(5, 'Pillow Case', 20);

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
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `menuName`, `servings`, `remaining`, `cost`, `sellingPrice`, `status`) VALUES
(1, 'Adobo', 20, 14, 1000, 150, 'Available'),
(7, 'Sinigang', 25, 19, 2500, 150, 'Available'),
(8, 'Ice Tea', 500, 496, 25, 50, 'Available'),
(9, 'Nilaga', 25, 23, 2200, 140, 'Available'),
(12, 'Hotdog', 100, 98, 25, 30, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `companyAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `contact`, `companyName`, `companyAddress`) VALUES
(1, 'Mark Joseph Castelo', '0192301924', '', ''),
(2, 'Abigail Mariano', '31231', '', ''),
(3, 'Josh Matthew Castelo', '0987766644', '', ''),
(4, 'Julia Margarette Castelo', '88764123', '', ''),
(10, 'Doris Castelo', '098764213', 'Puregold', 'Cabanatuan City, Nueva Ecija'),
(11, 'Joel Castelo', '0945412341', 'Self Employed', 'Bahay'),
(27, 'Natsu Dragneel', '10231904', 'Fairy Tail', 'Magnolia');

-- --------------------------------------------------------

--
-- Table structure for table `loginnames`
--

CREATE TABLE `loginnames` (
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `accountType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginnames`
--

INSERT INTO `loginnames` (`username`, `password`, `accountType`) VALUES
('abi', 'admin', 'user'),
('Joseph', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rate_history`
--

CREATE TABLE `rate_history` (
  `refno` int(11) NOT NULL,
  `rate` double DEFAULT NULL,
  `rateperhour` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate_history`
--

INSERT INTO `rate_history` (`refno`, `rate`, `rateperhour`) VALUES
(1, 1000, 100),
(2, 2000, 200),
(3, 3000, 300),
(4, 4000, 400),
(5, 5000, 500),
(6, 5005, 505),
(7, 5555, 505),
(8, 4004, 400),
(9, 4004, 400),
(10, 5553, 505),
(11, 5550, 505),
(12, 2002, 200),
(13, 12345, 332);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationId` int(11) NOT NULL,
  `personal_id` varchar(255) NOT NULL,
  `personal_id_type` varchar(255) NOT NULL,
  `room_id` int(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `compName` varchar(255) NOT NULL,
  `compAddress` varchar(255) NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `adultsCount` int(11) NOT NULL,
  `childrensCount` int(11) NOT NULL,
  `reservationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationId`, `personal_id`, `personal_id_type`, `room_id`, `name`, `mobile`, `compName`, `compAddress`, `checkInDate`, `checkOutDate`, `adultsCount`, `childrensCount`, `reservationDate`, `status`) VALUES
(1, '1231444', 'Drivers_License', 4, 'bbcnovaliches.org', '131231', 'bbcnovaliches.org', 'bbcnovaliches.org', '2018-08-03', '2018-08-15', 3, 2, '2018-07-31 02:26:13', 'Pending'),
(2, '312313', 'Philhealt', 7, 'admin', '0192301924', '', '', '2018-08-01', '2018-08-09', 2, 1, '2018-07-31 02:26:40', 'Pending');

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
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ispublished` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomNo`, `roomType`, `floor`, `status`, `createdDate`, `ispublished`) VALUES
(2, 2, 2, '2', 'Occupied', '2018-09-26 15:41:13', 1),
(3, 3, 3, '1', 'Occupied', '2018-09-26 15:41:25', 1),
(4, 4, 4, '4', 'Occupied', '2018-09-26 15:41:36', 1),
(5, 5, 5, '1', 'Occupied', '2018-09-26 15:50:26', 1),
(6, 6, 6, '3', 'Vacant', '2018-09-26 15:51:01', 1),
(8, 8, 2, '1', 'Vacant', '2018-09-26 15:51:27', 1),
(9, 9, 3, '1', 'Maintenance', '2018-09-26 15:55:37', 1),
(10, 10, 5, '1', 'Vacant', '2018-09-26 15:56:04', 1),
(11, 11, 6, '2', 'Cleaning', '2018-09-26 15:56:14', 1),
(46, 12, 4, '2', 'Cleaning', '2018-10-07 08:58:24', 1),
(47, 13, 4, '2', 'Vacant', '2018-10-07 08:59:57', 1),
(60, 14, 3, '2', 'Vacant', '2018-10-07 09:17:28', 1),
(61, 15, 3, '2', 'Penalty', '2018-10-07 09:18:26', 1),
(62, 16, 5, '10', 'Vacant', '2018-10-09 16:22:57', 1),
(63, 17, 3, '9', 'Vacant', '2018-10-09 16:23:12', 1),
(64, 67, 9, '3', 'Vacant', '2018-10-12 03:08:03', 1),
(65, 18, 18, '1', 'Vacant', '2018-10-12 09:19:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `maxAdult` int(11) NOT NULL DEFAULT '0',
  `maxChildren` int(11) NOT NULL DEFAULT '0',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rate` double NOT NULL,
  `rateperhour` double DEFAULT NULL,
  `raterefno` int(11) DEFAULT NULL,
  `ispublished` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`id`, `type`, `maxAdult`, `maxChildren`, `createdDate`, `rate`, `rateperhour`, `raterefno`, `ispublished`) VALUES
(2, 'Double', 2, 2, '2018-08-08 03:24:16', 2002, 200, 12, 1),
(3, 'Triple', 3, 3, '2018-08-07 04:56:39', 3000, 300, 3, 1),
(4, 'Double Deluxe', 4, 4, '2018-08-08 02:47:36', 4004, 400, 9, 1),
(5, 'Family', 5, 5, '2018-08-08 02:52:19', 5550, 505, 11, 1),
(6, 'Super', 2, 4, '2018-09-22 22:26:33', 12345, 332, 13, 1),
(7, 'Super Double', 5, 5, '2018-09-27 13:59:42', 4242, 200, NULL, 1),
(8, 'Super Single', 1, 0, '2018-09-27 14:30:03', 1111, 1, NULL, 1),
(9, 'Super Family', 6, 6, '2018-09-27 14:30:50', 6666, 600, NULL, 1),
(11, 'Single', 1, 1, '2018-08-08 03:24:16', 1111, 111, 0, 1),
(16, 'Deluxe', 5, 5, '2018-10-09 16:34:37', 5555, 555, NULL, 1),
(17, 'Super Deluxe', 66, 66, '2018-10-09 16:34:56', 66666, 666, NULL, 1),
(18, 'Super Super', 5, 5, '2018-10-12 09:25:57', 33232, 313, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_variables`
--

CREATE TABLE `system_variables` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_variables`
--

INSERT INTO `system_variables` (`id`, `name`, `value`) VALUES
(1, 'Floor', '11');

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
,`roomtype_id` int(11)
,`type` varchar(100)
,`rate` double
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dashboard_room_list`  AS  select `a`.`id` AS `room_id`,`a`.`roomNo` AS `roomNo`,`a`.`floor` AS `floor`,`a`.`status` AS `status`,`b`.`id` AS `roomtype_id`,`b`.`type` AS `type`,`b`.`rate` AS `rate`,`b`.`rateperhour` AS `rateperhour`,`b`.`maxAdult` AS `maxAdult`,`b`.`maxChildren` AS `maxChildren`,`c`.`id` AS `checkin_id`,`c`.`checkInDate` AS `checkInDate`,`c`.`checkOutDate` AS `checkOutDate`,`c`.`adultsCount` AS `adultsCount`,`c`.`childrenCount` AS `childrenCount`,`d`.`id` AS `guest_id`,`d`.`name` AS `name`,`d`.`contact` AS `contact`,`d`.`companyName` AS `companyName`,`d`.`companyAddress` AS `companyAddress` from (((`rooms` `a` left join `roomtypes` `b` on((`a`.`roomType` = `b`.`id`))) left join `checkin` `c` on((`a`.`id` = `c`.`room_id`))) left join `guests` `d` on((`c`.`guestId` = `d`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
