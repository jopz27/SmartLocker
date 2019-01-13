-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 50.62.209.7:3306
-- Generation Time: Aug 06, 2018 at 09:24 AM
-- Server version: 5.5.43-37.2-log
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_locker`
--
CREATE DATABASE IF NOT EXISTS `smart_locker` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `smart_locker`;

-- --------------------------------------------------------

--
-- Table structure for table `UIDS`
--

CREATE TABLE `UIDS` (
  `Num` int(11) NOT NULL,
  `UID` varchar(11) NOT NULL,
  `Type` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UIDS`
--

INSERT INTO `UIDS` (`Num`, `UID`, `Type`) VALUES
(1, '625E77E7AC', 'Normal'),
(2, '4E8F305BAA', 'Normal'),
(3, '8D3D305BDB', 'Normal'),
(4, '00709F7C93', 'Normal'),
(5, '10E2A27C2C', 'Normal'),
(6, '93B4A479FA', 'Admin4'),
(7, 'A097C38074', 'Admin1'),
(8, '963880DCF2', 'Admin2'),
(9, '8089C3804A', 'Admin3');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_number` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_number`, `name`, `username`, `password`) VALUES
(1990024799, 'Daniel Bruce Umpad', 'blackhoundz', '12345'),
(2000024799, 'Harold Paul Tidoso', '2percent', '12345'),
(2009024799, 'Lloyd Mark Jopia', 'jopz', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `lockers`
--

CREATE TABLE `lockers` (
  `locker_id` int(1) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `id_number` varchar(16) DEFAULT NULL,
  `reserved_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lockers`
--

INSERT INTO `lockers` (`locker_id`, `status`, `id_number`, `reserved_timestamp`) VALUES
(1, 'available', '0', 0),
(2, 'available', '0', 0),
(3, 'available', '0', 0),
(4, 'available', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timers`
--

CREATE TABLE `timers` (
  `user` int(11) NOT NULL,
  `remaining` varchar(11) NOT NULL,
  `reserved` int(11) NOT NULL,
  `logout` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timers`
--

INSERT INTO `timers` (`user`, `remaining`, `reserved`, `logout`) VALUES
(1, '00:00', 0, 0),
(2, '00:00', 0, 0),
(3, '00:00', 0, 0),
(4, '00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `UID` varchar(16) NOT NULL,
  `id_number` varchar(21) NOT NULL,
  `name` varchar(21) NOT NULL,
  `locker_id` int(1) NOT NULL,
  `reserved_date` date DEFAULT NULL,
  `reserved_time` time DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `status` varchar(21) NOT NULL,
  `occurence` int(2) DEFAULT NULL,
  `penalty_count` int(11) DEFAULT NULL,
  `sms_warning` int(2) DEFAULT NULL,
  `way` varchar(11) NOT NULL,
  `day` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `UID`, `id_number`, `name`, `locker_id`, `reserved_date`, `reserved_time`, `date_in`, `time_in`, `date_out`, `time_out`, `status`, `occurence`, `penalty_count`, `sms_warning`, `way`, `day`) VALUES
(1578, '4145C225E3', '2014003024', 'Heinz Funtanar', 1, '2018-07-06', '11:29:38', '2018-07-06', '11:31:08', '2018-07-06', '15:12:06', 'finished', 2, NULL, NULL, 'mobile', 'wd'),
(1579, '95C8985491', '2014029631', 'Shiela Cabahug', 2, '2018-07-06', '11:32:11', '2018-07-06', '11:33:01', '2018-07-07', '10:55:20', 'finished', 2, 0, 0, 'onsite', 'wd'),
(1580, '22DDB1236D', '2012016450', 'Jovit Aliganga', 3, '2018-07-06', '11:33:30', '2018-07-06', '11:34:15', '2018-07-06', '13:17:06', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1581, 'FBB6DEA437', '2014030110', 'Paul Villaceran', 4, '2018-07-06', '11:37:45', '2018-07-06', '11:39:19', '2018-07-06', '13:15:53', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1582, '57BF7D62F7', '2015032443', 'Edwin Estoce', 3, '2018-07-06', '13:17:22', '2018-07-06', '13:18:39', '2018-07-07', '10:52:40', 'finished', 2, 0, 0, 'mobile', 'wd'),
(1583, 'F5175A2890', '2010031832', 'Carl Via', 4, '2018-07-06', '13:20:26', '2018-07-06', '13:21:11', '2018-07-06', '15:10:44', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1599, '2170C425B0', '2015033982', 'Judison Bacalso', 1, '2018-07-07', '10:57:03', '2018-07-07', '10:59:47', '2018-07-07', '13:10:09', 'finished', 2, 0, 0, 'mobile', 'we'),
(1610, '4145C225E3', '2014003024', 'Heinz Funtanar', 1, '2018-07-09', '15:09:48', '2018-07-09', '15:10:06', '2018-07-09', '18:36:18', 'finished', 2, NULL, NULL, 'mobile', 'wd'),
(1611, '95C8985491', '2014029631', 'Shiela Cabahug', 2, '2018-07-09', '15:56:01', '2018-07-09', '15:56:11', '2018-07-09', '18:51:01', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1612, '22DDB1236D', '2012016450', 'Jovit Aliganga', 3, '2018-07-09', '16:18:30', '2018-07-09', '16:18:38', '2018-07-09', '17:02:18', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1613, 'FBB6DEA437', '2014030110', 'Paul Villaceran', 4, '2018-07-09', '16:36:10', '2018-07-09', '16:36:20', '2018-07-09', '16:37:14', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1614, 'FBB6DEA437', '2014030110', 'Paul Villaceran', 4, '2018-07-09', '16:37:55', '2018-07-09', '16:38:46', '2018-07-09', '17:32:17', 'finished', 2, NULL, NULL, 'mobile', 'wd'),
(1615, '57BF7D62F7', '2015032443', 'Edwin Estoce', 3, '2018-07-09', '17:52:26', '2018-07-09', '17:53:25', '2018-07-09', '18:56:12', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1616, 'F5175A2890', '2010031832', 'Carl Via', 4, '2018-07-09', '18:01:05', '2018-07-09', '18:01:13', '2018-07-09', '18:43:49', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1619, '2170C425B0', '2015033982', 'Judison Bacalso', 1, '2018-07-09', '19:18:01', '2018-07-09', '19:18:24', '2018-07-11', '16:39:16', 'finished', 2, 1531141200, 0, 'onsite', 'wd'),
(1628, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-18', '14:09:57', '2018-07-18', '14:10:59', '2018-07-18', '14:12:03', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1629, '811FC32578', '2009024799', 'Lloyd Jopia', 1, '2018-07-18', '14:12:34', '2018-07-18', '14:13:28', '2018-07-18', '14:14:17', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1630, '811FC32578', '2009024799', 'Lloyd Jopia', 1, '2018-07-18', '14:14:29', '2018-07-18', '14:14:55', '2018-07-18', '14:15:55', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1631, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-18', '14:27:46', '2018-07-18', '14:28:03', '2018-07-18', '14:29:02', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1633, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-18', '15:19:13', '2018-07-18', '15:20:27', '2018-07-18', '15:24:13', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1636, 'B3A057C783', '2011022822', 'Harold Tidoso', 1, '2018-07-18', '15:31:05', '2018-07-18', '15:32:20', '2018-07-18', '15:35:19', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1640, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-18', '15:49:23', '2018-07-18', '15:50:25', '2018-07-18', '17:30:39', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1644, 'B3A057C783', '2011022822', 'Harold Tidoso', 2, '2018-07-18', '16:06:19', '2018-07-18', '16:07:37', '2018-07-18', '17:17:45', 'finished', 2, 0, NULL, 'mobile', 'wd'),
(1649, '811FC32578', '2009024799', 'Lloyd Jopia', 3, '2018-07-18', '16:44:29', '2018-07-18', '16:45:21', '2018-07-18', '17:28:27', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1651, '625E77E7AC', '2010031832', 'Carl Via', 4, '2018-07-18', '16:53:17', '2018-07-18', '16:54:20', '2018-07-18', '17:25:23', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1656, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-18', '18:08:03', '2018-07-18', '18:09:04', '2018-07-18', '18:28:30', 'finished', 2, 0, 0, 'mobile', 'wd'),
(1657, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-20', '15:42:50', '2018-07-20', '15:43:25', '2018-07-20', '15:45:42', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1658, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-20', '15:47:03', NULL, NULL, NULL, NULL, 'cancelled', 0, NULL, NULL, 'onsite', ''),
(1659, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-20', '15:49:13', '2018-07-20', '15:49:26', '2018-07-20', '15:53:25', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1660, '922FBC2322', '2007001466', 'Bruce Umpad', 1, '2018-07-20', '15:55:03', '2018-07-20', '15:55:13', '2018-07-20', '19:40:01', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1661, 'B3A057C783', '2011022822', 'Harold Tidoso', 2, '2018-07-20', '16:24:34', '2018-07-20', '16:25:03', '2018-07-20', '18:01:30', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1662, '811FC32578', '2009024799', 'Lloyd Jopia', 3, '2018-07-20', '16:56:02', NULL, NULL, NULL, NULL, 'cancelled', 0, NULL, NULL, 'onsite', ''),
(1663, '811FC32578', '2009024799', 'Lloyd Jopia', 3, '2018-07-20', '16:57:31', '2018-07-20', '16:58:08', '2018-07-20', '19:24:13', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1664, '625E77E7AC', '2010031832', 'Carl Via', 4, '2018-07-20', '17:23:44', '2018-07-20', '17:25:01', '2018-07-20', '19:04:44', 'finished', 2, 0, NULL, 'onsite', 'wd'),
(1665, '625E77E7AC', '2010031832', 'Carl Via', 2, '2018-07-20', '19:05:09', NULL, NULL, NULL, NULL, 'cancelled', 0, NULL, NULL, 'onsite', ''),
(1666, '625E77E7AC', '2010031832', 'Carl Via', 4, '2018-07-20', '19:06:51', '2018-07-20', '19:06:58', '2018-07-20', '19:08:03', 'finished', 2, NULL, NULL, 'onsite', 'wd'),
(1667, 'B3A057C783', '2011022822', 'Harold Tidoso', 1, '2018-08-02', '20:52:24', NULL, NULL, NULL, NULL, 'canceled', 0, NULL, NULL, 'mobile', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` varchar(11) NOT NULL,
  `id_number` varchar(16) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `password` varchar(16) NOT NULL,
  `active` varchar(5) NOT NULL,
  `locker_id` int(1) NOT NULL,
  `penalty` varchar(21) DEFAULT NULL,
  `passcode` int(5) NOT NULL,
  `start_penalty` int(11) NOT NULL,
  `run_penalty` int(11) NOT NULL,
  `fin_penalty` int(11) NOT NULL,
  `calculatedPenalty_seconds` int(20) NOT NULL,
  `final` varchar(11) NOT NULL,
  `clear_penalty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `id_number`, `name`, `mobile_number`, `password`, `active`, `locker_id`, `penalty`, `passcode`, `start_penalty`, `run_penalty`, `fin_penalty`, `calculatedPenalty_seconds`, `final`, `clear_penalty`) VALUES
('922FBC2322', '2007001466', 'Bruce Umpad', '9157393192', '123', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('811FC32578', '2009024799', 'Lloyd Jopia', '9157393192', '123', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('625E77E7AC', '2010031832', 'Carl Via', '9154087564', '123', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('B3A057C783', '2011022822', 'Harold Tidoso', '9157393192', '123', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('4E8F305BAA', '2012016450', 'Jovit Aliganga', '9062722245', '123', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('00709F7C93', '2012468496', 'Going Mary', '9391321257', '123', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('4145C225E3', '2014003024', 'Heinz Funtanar', '9774293417', '12345', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('95C8985491', '2014029631', 'Shiela Cabahug', '9302694206', '12345', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '00:00:00:00', 0),
('FBB6DEA437', '2014030110', 'Paul Villaceran', '9557267553', '12345', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '0', 0),
('AAAAAAAAAA', '2015032443', 'Edwin Estoce', '9233894902', '12345', 'no', 0, '00:00:00:00', 0, 0, 0, 0, 0, '00:00:00:00', 0),
('2170C425B0', '2015033982', 'Judison Bacalso', '9275858549', '12345', 'no', 0, '28:20:31:39', 0, 1531141200, 1531298356, 157156, 3771744, '1:19:39:16', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `UIDS`
--
ALTER TABLE `UIDS`
  ADD PRIMARY KEY (`Num`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `lockers`
--
ALTER TABLE `lockers`
  ADD PRIMARY KEY (`locker_id`);

--
-- Indexes for table `timers`
--
ALTER TABLE `timers`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD UNIQUE KEY `1` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `UIDS`
--
ALTER TABLE `UIDS`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1668;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
