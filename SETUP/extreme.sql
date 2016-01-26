-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2016 at 02:07 AM
-- Server version: 5.6.26
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freeter1_extreme`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account_id`
--

CREATE TABLE IF NOT EXISTS `Account_id` (
  `account_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `last_login` datetime NOT NULL,
  `cashpoint` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account_id`
--

INSERT INTO `Account_id` (`account_id`, `username`, `password`, `last_login`, `cashpoint`) VALUES
(1, 'admin', 'admin', '2016-01-27 02:05:14', 0),
(2, 'test', 'test', '2016-01-27 01:59:53', 0),
(100001, 'startuser', '1234', '2016-01-26 00:47:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dummy_item_inventory`
--

CREATE TABLE IF NOT EXISTS `dummy_item_inventory` (
  `inv_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_amount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `ev_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `pont_all` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_chance`
--

CREATE TABLE IF NOT EXISTS `item_chance` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` text NOT NULL,
  `item_pic` text NOT NULL,
  `item_chance` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_chance`
--

INSERT INTO `item_chance` (`item_id`, `item_name`, `item_desc`, `item_pic`, `item_chance`) VALUES
(1, 'Zombie Claw Cap', 'Cap that have a Zombie claw logo on it .', 'dummy.jpg', 30),
(2, 'Infest_1st SIG SAUER', 'Infest_1st SIG SAUER', 'dummy.jpg', 200),
(3, 'Nvidia Ultra Bomb!', 'Booooom!', 'dummy.jpg', 400),
(4, 'Flashbang', 'Flashbang', 'dummy.jpg', 500),
(5, 'Tt eSPORTS Medicine', 'Tt eSPORTS Medicine', 'dummy.jpg', 500),
(6, 'Medkit', 'Medicine Kit', 'dummy.jpg', 700),
(7, 'Antibiotic', 'Antibiotic', 'dummy.jpg', 770),
(8, 'G 36 - Cmag', 'G 36 - Cmag', 'dummy.jpg', 800),
(9, '5.45 AK Drum', '5.45 AK Drum', 'dummy.jpg', 800),
(10, 'STANAG 30', 'STANAG', 'dummy.jpg', 800);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `logs_id` int(11) NOT NULL,
  `account_id` varchar(30) NOT NULL,
  `logs_type` varchar(30) NOT NULL,
  `logs_desc` text NOT NULL,
  `logs_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Topup`
--

CREATE TABLE IF NOT EXISTS `Topup` (
  `topup_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `cardnumber` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `dateupdate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account_id`
--
ALTER TABLE `Account_id`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `dummy_item_inventory`
--
ALTER TABLE `dummy_item_inventory`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `item_chance`
--
ALTER TABLE `item_chance`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `Topup`
--
ALTER TABLE `Topup`
  ADD PRIMARY KEY (`topup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account_id`
--
ALTER TABLE `Account_id`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100002;
--
-- AUTO_INCREMENT for table `dummy_item_inventory`
--
ALTER TABLE `dummy_item_inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_chance`
--
ALTER TABLE `item_chance`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Topup`
--
ALTER TABLE `Topup`
  MODIFY `topup_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
