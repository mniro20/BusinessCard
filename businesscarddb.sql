-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 05:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `businesscarddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `customer_info_id` int(11) NOT NULL,
  `business_info_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

CREATE TABLE `business_info` (
  `business_info_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `address_line` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `business_name` varchar(45) NOT NULL,
  `occupation` varchar(45) NOT NULL,
  `hourly_rate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_info`
--

INSERT INTO `business_info` (`business_info_id`, `first_name`, `last_name`, `email`, `pass`, `address_line`, `city`, `state`, `zip_code`, `phone_number`, `business_name`, `occupation`, `hourly_rate`) VALUES
(1, 'John', 'Niro', 'jmniro59@gmail.com', 'password', '60 Trafford St', 'Shrewsbury', 'New Jersey', '07702', '7326106816', 'John M. Niro & Son Plumbing & Heating', 'Plumber', '100'),
(2, 'Bill', 'Rowan', 'rowan@gmail.com', 'password', '60 Trafford St.', 'Shrewsbury', 'NJ', '07702', '7325338847', 'Rowans HVAC', 'Electrician', '100'),
(8, 'Jimmy', 'Christman', 'jc@gmail.com', 'password', '56 Trafford St', 'Shrewsbury', 'NJ', '07702', '1234567890', 'Christmans', 'Handy Man', '6');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `customer_info_id` int(11) NOT NULL,
  `first_name_c` varchar(45) NOT NULL,
  `last_name_c` varchar(45) NOT NULL,
  `email_c` varchar(45) NOT NULL,
  `pass_c` varchar(45) NOT NULL,
  `address_line_c` varchar(45) NOT NULL,
  `city_c` varchar(45) NOT NULL,
  `state_c` varchar(45) NOT NULL,
  `zip_code_c` varchar(10) NOT NULL,
  `phone_number_c` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`customer_info_id`, `first_name_c`, `last_name_c`, `email_c`, `pass_c`, `address_line_c`, `city_c`, `state_c`, `zip_code_c`, `phone_number_c`) VALUES
(1, 'Mike', 'Niro', 'mniro1205@gmail.com', 'password', '60 Trafford St.', 'Shrewsbury', 'NJ', '07702', '7325338847'),
(4, 'John', 'Niro', '123@gmail.com', 'password', '60 Trafford St', 'Shrewsbury', 'New Jersey', '07702', '7326106816'),
(5, 'Nancy', 'Niro', 'nniro23@gmail.com', 'password', '60 Trafford St., , false', 'Shrewsbury', 'New Jersey', '07702', '7326106815');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `business_info`
--
ALTER TABLE `business_info`
  ADD PRIMARY KEY (`business_info_id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`customer_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `business_info`
--
ALTER TABLE `business_info`
  MODIFY `business_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `customer_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
