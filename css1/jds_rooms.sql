-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 01:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jds_rooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_generate_id`
--

CREATE TABLE `chat_generate_id` (
  `chat_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `generate_id` varchar(200) NOT NULL,
  `date_add` varchar(20) NOT NULL,
  `chat_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contract_id` int(3) NOT NULL,
  `tenant_id` int(3) NOT NULL,
  `room_id` int(3) NOT NULL,
  `duration_month` int(2) NOT NULL,
  `total_rent` varchar(100) NOT NULL,
  `terms` int(2) NOT NULL,
  `rent_per_term` varchar(100) NOT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `date_contract_sign` datetime NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contract_id`, `tenant_id`, `room_id`, `duration_month`, `total_rent`, `terms`, `rent_per_term`, `start_day`, `end_day`, `date_contract_sign`, `status`) VALUES
(8, 25, 6, 0, '', 0, '2000', '2024-01-03', '1970-01-31', '2024-01-03 09:00:03', 'Active'),
(11, 24, 8, 0, '', 0, '3000', '2024-01-02', '0000-00-00', '2024-01-03 10:35:28', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(3) NOT NULL,
  `tenant_id` int(7) NOT NULL,
  `ref_no` varchar(11) NOT NULL,
  `amount` int(7) NOT NULL,
  `pay_from` text NOT NULL,
  `pay_to` text NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(100) NOT NULL,
  `prev_reading` varchar(100) NOT NULL,
  `cur_reading` varchar(100) NOT NULL,
  `picture` varchar(500) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `reference_no` varchar(20) NOT NULL,
  `date_send` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `confirmed_date` varchar(20) NOT NULL,
  `consumption` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `tenant_id`, `ref_no`, `amount`, `pay_from`, `pay_to`, `date`, `description`, `prev_reading`, `cur_reading`, `picture`, `sender`, `reference_no`, `date_send`, `status`, `confirmed_date`, `consumption`) VALUES
(9, 24, '', 0, '', '', '2024-01-06 00:00:00', '', '', '', '', '', '', '2024-01-06', 'Pending', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rental_chat`
--

CREATE TABLE `rental_chat` (
  `rent_chat_id` int(11) NOT NULL,
  `rent_chat_user` varchar(100) NOT NULL,
  `rent_chat_message` varchar(500) NOT NULL,
  `rent_chat_date` varchar(20) NOT NULL,
  `rent_tenant_id` varchar(10) NOT NULL,
  `rent_chat_time` varchar(20) NOT NULL,
  `rent_user` varchar(100) NOT NULL,
  `rent_chat_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(3) NOT NULL,
  `room_name` varchar(100) DEFAULT NULL,
  `compartment` text NOT NULL,
  `rent_per_month` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `description` varchar(500) NOT NULL,
  `imagepath` varchar(100) NOT NULL,
  `dateadd` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `compartment`, `rent_per_month`, `status`, `description`, `imagepath`, `dateadd`) VALUES
(6, '103', '', '2000', 'Occupied', 'kjnjknklbrle', 'R103.jpg', ''),
(7, '201', '', '2500', 'Occupied', 'mmlk kle rl;', 'R201.jpg', ''),
(8, '203', '', '3000', 'Occupied', 'lkmle e;', 'R203.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(3) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `programme` varchar(30) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `occupation` text NOT NULL,
  `p_no` varchar(15) NOT NULL,
  `pno1` varchar(15) NOT NULL,
  `e_address` varchar(30) NOT NULL,
  `p_address` varchar(40) NOT NULL,
  `city` varchar(15) NOT NULL,
  `region` varchar(15) NOT NULL,
  `u_name` text NOT NULL,
  `p_word` text NOT NULL,
  `day_reg` date NOT NULL,
  `status` int(2) NOT NULL,
  `profile_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `fname`, `lname`, `programme`, `reg_no`, `occupation`, `p_no`, `pno1`, `e_address`, `p_address`, `city`, `region`, `u_name`, `p_word`, `day_reg`, `status`, `profile_image`) VALUES
(24, 'arnel', 'carcela', '', '', 'tambay', '', '12345678901', 'carcelaarnel@gmail.com', '6015', 'lapu-lapu city', 'region 7', 'arnel', '827ccb0eea8a706c4c34a16891f84e7b', '2024-01-03', 1, 'user.png'),
(25, 'jezra', 'sadas', '', '', 'student', '12345678901', '12345678901', 'jezra@gmail.com', '', '', '', 'jezra', 'e10adc3949ba59abbe56e057f20f883e', '2024-01-03', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_contacts`
--

CREATE TABLE `tenant_contacts` (
  `contact_id` int(3) NOT NULL,
  `tenant_id` int(3) NOT NULL,
  `fname1` text NOT NULL,
  `lname1` text NOT NULL,
  `occupation1` text NOT NULL,
  `nature1` text NOT NULL,
  `pno1` varchar(15) NOT NULL,
  `pno2` varchar(15) NOT NULL,
  `e_address1` varchar(30) NOT NULL,
  `p_address1` varchar(40) NOT NULL,
  `city1` varchar(15) NOT NULL,
  `region1` varchar(15) NOT NULL,
  `fname2` text NOT NULL,
  `lname2` text NOT NULL,
  `occupation2` text NOT NULL,
  `nature2` text NOT NULL,
  `pno3` varchar(15) NOT NULL,
  `pno4` varchar(15) NOT NULL,
  `e_address2` varchar(30) NOT NULL,
  `p_address2` varchar(40) NOT NULL,
  `city2` varchar(15) NOT NULL,
  `region2` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tenant_contacts`
--

INSERT INTO `tenant_contacts` (`contact_id`, `tenant_id`, `fname1`, `lname1`, `occupation1`, `nature1`, `pno1`, `pno2`, `e_address1`, `p_address1`, `city1`, `region1`, `fname2`, `lname2`, `occupation2`, `nature2`, `pno3`, `pno4`, `e_address2`, `p_address2`, `city2`, `region2`) VALUES
(28, 24, 'gdagda', 'gsdbsadaj', 'tambay', 'hasahjs', '12345678901', '', 'arnel@gmail.com', '6213', 'ahsmasba', 'hjasajs', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_in`
--

CREATE TABLE `tenant_in` (
  `in_id` int(3) NOT NULL,
  `contract_id` int(3) NOT NULL,
  `stat_keyholder` text NOT NULL,
  `stat_electricityRemote` text NOT NULL,
  `no_bulbs` int(2) NOT NULL,
  `stat_bulbs` text NOT NULL,
  `stat_paint` text NOT NULL,
  `stat_Windows` text NOT NULL,
  `stat_toiletSink` text NOT NULL,
  `stat_washingSink` text NOT NULL,
  `stat_doorLock` text NOT NULL,
  `stat_toiletDoorLock` text NOT NULL,
  `water_units` int(5) NOT NULL,
  `comments` text NOT NULL,
  `date_reg` date NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='"stat" represents the status/condition of an item';

-- --------------------------------------------------------

--
-- Table structure for table `tenant_out`
--

CREATE TABLE `tenant_out` (
  `out_id` int(3) NOT NULL,
  `contract_id` int(3) NOT NULL,
  `stat_keyholder` text NOT NULL,
  `stat_electricityRemote` text NOT NULL,
  `no_bulbs` int(2) NOT NULL,
  `stat_bulbs` text NOT NULL,
  `stat_paint` text NOT NULL,
  `stat_Windows` text NOT NULL,
  `stat_toiletSink` text NOT NULL,
  `stat_washingSink` text NOT NULL,
  `stat_doorLock` text NOT NULL,
  `stat_toiletDoorLock` text NOT NULL,
  `comments` text NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_reading_bill`
--

CREATE TABLE `tenant_reading_bill` (
  `read_id` int(11) NOT NULL,
  `tenant_id` varchar(20) NOT NULL,
  `consumption` varchar(20) NOT NULL,
  `prev_reading` varchar(100) NOT NULL,
  `cur_reading` varchar(100) NOT NULL,
  `water_bill` int(11) NOT NULL,
  `read_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tenant_reading_bill`
--

INSERT INTO `tenant_reading_bill` (`read_id`, `tenant_id`, `consumption`, `prev_reading`, `cur_reading`, `water_bill`, `read_date`) VALUES
(25, '24', ' kwh', '120', '130', 200, '2024-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(200) NOT NULL,
  `name` text NOT NULL,
  `role` text NOT NULL,
  `pno` varchar(15) NOT NULL,
  `u_name` varchar(10) NOT NULL,
  `pword` text NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `role`, `pno`, `u_name`, `pword`, `date_reg`) VALUES
(' ', 'yden', 'Caretaker', '09152663766', 'yden', '7135e006938fdd30f0de16ba68bf0a52', '2023-11-23'),
('7874', 'RHMS', 'Administrator', '255717812676', 'Admin', '50e1329c5c5ff62dfac89af41f544e63', '2019-07-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_generate_id`
--
ALTER TABLE `chat_generate_id`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `ref_no` (`ref_no`);

--
-- Indexes for table `rental_chat`
--
ALTER TABLE `rental_chat`
  ADD PRIMARY KEY (`rent_chat_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `house_name` (`room_name`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `tenant_contacts`
--
ALTER TABLE `tenant_contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `tenant_in`
--
ALTER TABLE `tenant_in`
  ADD PRIMARY KEY (`in_id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `tenant_out`
--
ALTER TABLE `tenant_out`
  ADD PRIMARY KEY (`out_id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `tenant_reading_bill`
--
ALTER TABLE `tenant_reading_bill`
  ADD PRIMARY KEY (`read_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_generate_id`
--
ALTER TABLE `chat_generate_id`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rental_chat`
--
ALTER TABLE `rental_chat`
  MODIFY `rent_chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tenant_contacts`
--
ALTER TABLE `tenant_contacts`
  MODIFY `contact_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tenant_in`
--
ALTER TABLE `tenant_in`
  MODIFY `in_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenant_out`
--
ALTER TABLE `tenant_out`
  MODIFY `out_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenant_reading_bill`
--
ALTER TABLE `tenant_reading_bill`
  MODIFY `read_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
