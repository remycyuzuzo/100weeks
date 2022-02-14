-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2022 at 06:15 PM
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
  `number_of_shares` int(4) NOT NULL,
  `tel_number` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `date_joined` date NOT NULL,
  `date_registered` datetime NOT NULL,
  `profile_picture` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`beneficiary_id_card`, `fname`, `lname`, `VSLA_id`, `number_of_shares`, `tel_number`, `gender`, `date_joined`, `date_registered`, `profile_picture`, `status`) VALUES
('125355262636277', 'Mukantuza', 'Neza', 7, 1, '23663627277', 'f', '2022-01-17', '2022-01-17 00:00:00', '61e5ab3cb70747.50369823_eqoimhpnjfkgl', 'active'),
('2736277182839', 'Janine', 'Niyomwiza', 14, 1, '27763627721', 'f', '2022-01-25', '2022-01-25 00:00:00', 'niyomwiza-janine61f0389356ed1513205509', 'active'),
('6325362821928329', 'Sperasia', 'Mukagitego', 15, 1, '25078824342', 'f', '2022-01-25', '2022-01-25 00:00:00', 'mukagitego-sperasia61f0214a93e8d611239152', 'active'),
('7327237282', 'Mariya', 'Yohanna', 15, 1, '25078827372', 'f', '2022-01-23', '2022-01-23 00:00:00', 'yohanna-mariya61edbc534a1c2108794676', 'active'),
('8787665655944', 'Jane', 'Mukantabana', 2, 1, '', 'f', '2022-01-17', '2022-01-17 00:00:00', '61e59e7b616969.53020043_igmefqonhkjlp', 'active');

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
-- Table structure for table `loan_information`
--

CREATE TABLE `loan_information` (
  `loan_id` int(11) NOT NULL,
  `loan_amount` float NOT NULL,
  `loan_description` text NOT NULL,
  `loan_due_date` date NOT NULL,
  `loan_approved` varchar(10) NOT NULL,
  `approval_date` datetime NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `beneficiary_id` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `interest_rate` float NOT NULL,
  `debt_left` float NOT NULL,
  `loan_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_information`
--

INSERT INTO `loan_information` (`loan_id`, `loan_amount`, `loan_description`, `loan_due_date`, `loan_approved`, `approval_date`, `date_registered`, `beneficiary_id`, `user_id`, `interest_rate`, `debt_left`, `loan_status`) VALUES
(1, 10000, 'Kwikemuza', '2022-03-01', 'true', '2022-02-08 22:30:04', '2022-02-08 20:30:04', '125355262636277', 1, 5, 6000, 'active'),
(2, 13000, 'Personal problems', '2022-04-09', 'true', '2022-02-09 15:46:52', '2022-02-09 13:46:52', '7327237282', 1, 5, 17000, 'active'),
(3, 12000, 'kwifashisha mu bucuruzi bwe', '2022-02-13', '', '2022-02-13 00:00:00', '2022-02-13 15:21:13', '7327237282', 1, 5, 12600, 'active'),
(4, 16997, '', '2022-03-13', '', '2022-02-13 00:00:00', '2022-02-13 15:43:18', '7327237282', 1, 5, 17846.8, 'active'),
(5, 20000, '', '2022-03-13', '', '2022-02-13 00:00:00', '2022-02-13 15:44:27', '7327237282', 1, 5, 21000, 'active'),
(6, 3000, '', '2022-03-06', '', '2022-02-13 00:00:00', '2022-02-13 15:45:43', '7327237282', 1, 5, 3150, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `loan_payment_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `datetime_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `loan_id` int(11) NOT NULL,
  `beneficiary_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `saving_records`
--

CREATE TABLE `saving_records` (
  `saving_record_id` int(11) NOT NULL,
  `beneficiary_id` varchar(20) NOT NULL,
  `week` varchar(20) NOT NULL,
  `datetime_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saving_records`
--

INSERT INTO `saving_records` (`saving_record_id`, `beneficiary_id`, `week`, `datetime_registered`, `user_id`, `amount`) VALUES
(1, '8787665655944', '2022-W05', '2022-02-01 22:12:41', 0, 1000),
(2, '8787665655944', '2022-W05', '2022-02-01 22:12:41', 0, 1000),
(3, '8787665655944', '2022-W05', '2022-02-01 22:21:26', 0, 1000),
(4, '6325362821928329', '2022-W05', '2022-02-01 22:59:34', 0, 1600),
(5, '7327237282', '2022-W05', '2022-02-01 23:02:43', 0, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `social_funds_records`
--

CREATE TABLE `social_funds_records` (
  `record_id` int(11) NOT NULL,
  `beneficiary_id` varchar(20) NOT NULL,
  `week` varchar(20) NOT NULL,
  `datetime_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_funds_records`
--

INSERT INTO `social_funds_records` (`record_id`, `beneficiary_id`, `week`, `datetime_registered`, `user_id`, `amount`) VALUES
(1, '8787665655944', '2022-W05', '2022-02-01 23:14:23', 0, 100);

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
  `datetime_registered` datetime NOT NULL,
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_created` date NOT NULL,
  `date_joined_the_organization` date NOT NULL,
  `meetings_frequency` int(11) NOT NULL,
  `amount_per_share` double NOT NULL,
  `social_funds_amount` double NOT NULL,
  `maximum_loan_amount` double NOT NULL,
  `default_loan_interest_rate` float NOT NULL,
  `default_overdue_loan_fine` float NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vsla_groups`
--

INSERT INTO `vsla_groups` (`VSLA_id`, `VSLA_name`, `datetime_registered`, `datetime_updated`, `date_created`, `date_joined_the_organization`, `meetings_frequency`, `amount_per_share`, `social_funds_amount`, `maximum_loan_amount`, `default_loan_interest_rate`, `default_overdue_loan_fine`, `status`) VALUES
(1, 'testing name', '2022-01-15 01:04:24', '2022-01-15 08:24:04', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 0, 7, 'active'),
(2, 'testing name', '2022-01-15 01:02:42', '2022-01-15 08:42:02', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(3, 'testing name', '2022-01-15 01:53:48', '2022-01-15 08:48:53', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(4, 'testing name', '2022-01-15 01:56:49', '2022-01-15 08:49:56', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(5, 'testing name', '2022-01-15 01:36:53', '2022-01-15 08:53:36', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(6, 'testing name', '2022-01-15 01:39:53', '2022-01-15 08:53:39', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(7, 'testing name', '2022-01-15 01:44:55', '2022-01-15 08:55:44', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(8, 'testing name', '2022-01-15 01:06:56', '2022-01-15 08:56:06', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(9, 'testing name', '2022-01-15 01:55:01', '2022-01-15 09:01:55', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(10, 'testing name', '2022-01-15 01:57:01', '2022-01-15 09:01:57', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(11, 'testing name', '2022-01-15 01:53:02', '2022-01-15 09:02:53', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(12, 'testing name', '2022-01-15 01:55:02', '2022-01-15 09:02:55', '2020-04-12', '2020-04-12', 4, 1000, 100, 15000, 15, 7, 'active'),
(13, '', '2022-01-15 01:03:43', '2022-01-15 09:43:03', '0000-00-00', '0000-00-00', 4, 1000, 100, 15000, 0, 10, 'active'),
(14, 'Urugwiro Group', '2022-01-15 01:31:28', '2022-01-15 13:28:31', '2021-12-28', '2022-01-01', 4, 1000, 100, 15000, 0, 10, 'active'),
(15, 'Ubumwe Rwaza', '2022-01-15 01:15:52', '2022-01-15 13:52:15', '2022-01-06', '2022-01-06', 4, 1000, 100, 15000, 0, 10, 'active'),
(16, '', '2022-02-13 02:12:10', '2022-02-13 16:10:12', '0000-00-00', '0000-00-00', 4, 1000, 100, 15000, 0, 10, '');

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

-- --------------------------------------------------------

--
-- Table structure for table `vsla_zones`
--

CREATE TABLE `vsla_zones` (
  `vsla_zone_id` int(11) NOT NULL,
  `vsla_zone_name` varchar(200) NOT NULL,
  `vsla_zone_type` varchar(20) NOT NULL,
  `vsla_zone_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`vsla_zone_address`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vsla_zones`
--

INSERT INTO `vsla_zones` (`vsla_zone_id`, `vsla_zone_name`, `vsla_zone_type`, `vsla_zone_address`) VALUES
(1, 'Ruhengeri', 'parish', '{\"District\":\"Musanze\", \"Sector\":\"Muhoza\", \"Province\":\"North\"}'),
(2, 'Ruhengeri', 'parish', '{\"District\":\"Musanze\", \"Sector\":\"Muhoza\", \"Province\":\"North\"}'),
(3, 'Ruhengeri', 'parish', '{\"District\":\"Musanze\", \"Sector\":\"Muhoza\", \"Province\":\"North\"}');

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
-- Indexes for table `loan_information`
--
ALTER TABLE `loan_information`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`loan_payment_id`);

--
-- Indexes for table `saving_records`
--
ALTER TABLE `saving_records`
  ADD PRIMARY KEY (`saving_record_id`);

--
-- Indexes for table `social_funds_records`
--
ALTER TABLE `social_funds_records`
  ADD PRIMARY KEY (`record_id`);

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
-- Indexes for table `vsla_zones`
--
ALTER TABLE `vsla_zones`
  ADD PRIMARY KEY (`vsla_zone_id`);

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
-- AUTO_INCREMENT for table `loan_information`
--
ALTER TABLE `loan_information`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `loan_payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saving_records`
--
ALTER TABLE `saving_records`
  MODIFY `saving_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_funds_records`
--
ALTER TABLE `social_funds_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vsla_groups`
--
ALTER TABLE `vsla_groups`
  MODIFY `VSLA_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vsla_group_assets`
--
ALTER TABLE `vsla_group_assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vsla_zones`
--
ALTER TABLE `vsla_zones`
  MODIFY `vsla_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
