-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 05:33 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(64) DEFAULT NULL,
  `customer_address` varchar(256) DEFAULT NULL,
  `customer_phone_no` bigint(20) DEFAULT NULL,
  `customer_email` varchar(256) DEFAULT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `membership_id` int(11) NOT NULL DEFAULT 4,
  `wallet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone_no`, `customer_email`, `username`, `password`, `membership_id`, `wallet`) VALUES
(21, 'Alvyn', '', 8668221206, 'alvynabranches@gmail.com', 'alvyn', '$2y$10$DIFU7kr40/dGvr5b7BFIY.LipxMAws7VtGpANelFa7vAZu2vl5FqS', 4, 1000),
(22, 'random', 'random', 123456, 'random@r.co.in', 'random', '$2y$10$aYW2qmNZMAjkeu4KLq5.Q.JgN52UZYoJZdkaXCF82junravApWeta', 4, 1000),
(28, 'prathmesh naik', 'porvorim', 8668221206, 'random123@a.co.in', 'prathmesh', '$2y$10$4oPddCcHJ8sP.uydnGrtWORYL7EHwHyANi8MFq1bcwtvpDEmAmRfC', 4, 0),
(29, 'Demo', 'demo', 8899889988, 'demo@gmail.com', 'demo', '$2y$10$x2F0j7CcFYu/V6JvNitv0u1GpZo6ypdDOBFSxwi9/HdovLTfK2VEO', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_services`
--

CREATE TABLE `customer_services` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_services`
--

INSERT INTO `customer_services` (`id`, `cid`, `sid`, `expiry_date`) VALUES
(1, 21, 10, '2021-04-01'),
(2, 21, 6, '2021-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `membership_type` varchar(128) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `membership_type`, `price`) VALUES
(1, 'GOLD', 100),
(2, 'Diamond', 500),
(3, 'Platinium', 1000),
(4, 'Free', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `Pro_id` int(11) NOT NULL,
  `Pro_name` varchar(128) DEFAULT NULL,
  `Pro_tran` varchar(128) DEFAULT NULL,
  `Pro_cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(256) NOT NULL,
  `service_price` float NOT NULL,
  `trainer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_price`, `trainer_id`) VALUES
(6, 'Gym', 5999, 1),
(7, 'Yoga', 1999, 2),
(8, 'Table Tennis', 2999, 1),
(9, 'Basket Ball', 4999, 2),
(10, 'Badminton', 3999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id` int(11) NOT NULL,
  `trainer_name` varchar(128) NOT NULL,
  `trainer_email` varchar(128) DEFAULT NULL,
  `trainer_phone` bigint(20) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `trainer_name`, `trainer_email`, `trainer_phone`, `username`, `password`) VALUES
(1, 'Prathmesh Naik', 'pn@gmail.com', 9988776655, 'pnaik2021', '$2y$10$uPDLLvaioSnBafyNfAZ7FOU3MjHrjuTA8vceoQczk6WI74Vm.kjkm'),
(2, 'Alvyn Abranches', 'aa@gmail.com', 9876543210, 'alvyn2021', '$2y$10$d7zWiMB5JAxKFqnx8PzISuMb.mFQ77h.hFBuMflq0.OzHAgnEYUY.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `membership_id` (`membership_id`);

--
-- Indexes for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `membership_type` (`membership_type`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`Pro_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customer_services`
--
ALTER TABLE `customer_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `membership` (`id`);

--
-- Constraints for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD CONSTRAINT `customer_services_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `customer_services_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `services` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
