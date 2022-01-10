-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 12:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `100weeks`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(135) NOT NULL,
  `tel_number` varchar(20) NOT NULL,
  `date_joined` datetime NOT NULL,
  `id_passport_number` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `fname`, `lname`, `email`, `tel_number`, `date_joined`, `id_passport_number`, `status`) VALUES
(1, 'CYUZUZO', 'Jean Remy', 'remycyuzuzo@gmail.com', '+250783910300', '2021-12-04 21:53:35', '1199980031709500', '');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `beneficiary_id_card` varchar(16) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `VSLA_id` int(11) NOT NULL,
  `tel_number` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `date_joined` date NOT NULL,
  `date_registered` datetime NOT NULL,
  `profile_picture` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_family_members`
--

CREATE TABLE `beneficiary_family_members` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `relationship_type` varchar(50) NOT NULL,
  `beneficiary_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `tel_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_time_joined` datetime NOT NULL,
  `gender` varchar(1) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `user_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_time_zone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`user_type`, `user_id`, `password`, `user_time_zone`) VALUES
('admin', 1, 'remy12345', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsla_groups`
--

CREATE TABLE `vsla_groups` (
  `VSLA_id` int(11) NOT NULL,
  `VSLA_name` varchar(200) NOT NULL,
  `datetime_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `datetime_updated` datetime NOT NULL,
  `date_created` date NOT NULL,
  `date_joined_the_organization` date NOT NULL,
  `meetings_frequency` int(11) NOT NULL,
  `amount_per_share` double NOT NULL,
  `social_funds_amount` double NOT NULL,
  `maximum_loan_amount` double NOT NULL,
  `default_loan_interest_rate` float NOT NULL,
  `default_loan_fine` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vsla_group_assets`
--

CREATE TABLE `vsla_group_assets` (
  `asset_id` int(11) NOT NULL,
  `VSLA_id` int(11) NOT NULL,
  `asset_type_nature` varchar(250) NOT NULL,
  `asset_description` text NOT NULL,
  `asset_estimated_value` double NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`beneficiary_id_card`);

--
-- Indexes for table `beneficiary_family_members`
--
ALTER TABLE `beneficiary_family_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `vsla_groups`
--
ALTER TABLE `vsla_groups`
  ADD PRIMARY KEY (`VSLA_id`);

--
-- Indexes for table `vsla_group_assets`
--
ALTER TABLE `vsla_group_assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiary_family_members`
--
ALTER TABLE `beneficiary_family_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vsla_groups`
--
ALTER TABLE `vsla_groups`
  MODIFY `VSLA_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vsla_group_assets`
--
ALTER TABLE `vsla_group_assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
