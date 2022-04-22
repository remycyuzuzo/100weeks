-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 03:50 AM
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
  `gender` varchar(5) NOT NULL,
  `email` varchar(135) NOT NULL,
  `tel_number` varchar(20) NOT NULL,
  `date_joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_passport_number` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `fname`, `lname`, `gender`, `email`, `tel_number`, `date_joined`, `id_passport_number`, `status`) VALUES
(1, 'Cyuzuzo', 'Jean Remy', 'M', 'remycyuzuzo@gmail.com', '250783910300', '2022-04-20 17:42:35', '1199920047362625', 'active');

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
('256263728292927', 'Mariya', 'Kankwanzi', 15, 2, '240255256162', 'f', '2022-03-09', '2022-03-09 00:00:00', 'kankwanzi-mariya622916689970d645942068.jpeg', 'active'),
('2736277182839', 'Janine', 'Niyomwiza', 14, 1, '27763627721', 'f', '2022-01-25', '2022-01-25 00:00:00', 'niyomwiza-janine61f0389356ed1513205509', 'active'),
('3525526161262126', '', '', 3, 2, '250783910300', 'M', '2022-02-24', '2022-02-24 16:27:11', '', 'exited'),
('6325362821928329', 'Sperasia', 'Mukagitego', 15, 1, '25078824342', 'f', '2022-01-25', '2022-01-25 00:00:00', 'mukagitego-sperasia61f0214a93e8d611239152', 'active'),
('7327237282', 'Mariya', 'Yohanna', 15, 1, '25078827372', 'f', '2022-01-23', '2022-01-23 00:00:00', 'yohanna-mariya61edbc534a1c2108794676', 'active'),
('736262737472173', 'Vladmir', 'Putin', 14, 0, '250383737362', 'f', '2022-03-11', '2022-03-11 00:00:00', '622b2f711d2d15.45196809_loqfnhepimkgj.jpeg', 'active'),
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
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `tel_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_time_joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` varchar(1) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `id_card_number` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_id`, `fname`, `lname`, `tel_number`, `email`, `date_time_joined`, `gender`, `profile_image`, `address`, `id_card_number`, `status`) VALUES
(1, 'Mukamusoni', 'Anastasie', '250788504545', 'ndayejclaude@gmail.com', '2022-04-20 13:12:18', 'F', '', 'Musanze', '1197654434553211', 'active');

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
(1, 10000, 'Kwikemuza', '2022-03-01', 'true', '2022-02-08 22:30:04', '2022-04-21 21:27:46', '125355262636277', 1, 5, 4800, 'active'),
(2, 13000, 'Personal problems', '2022-04-09', 'true', '2022-02-09 15:46:52', '2022-03-07 21:27:00', '7327237282', 1, 5, 16000, 'active'),
(3, 12000, 'kwifashisha mu bucuruzi bwe', '2022-02-13', '', '2022-02-13 00:00:00', '2022-02-13 15:21:13', '7327237282', 1, 5, 12600, 'active'),
(4, 16997, 'kwirira', '2022-03-13', '', '2022-02-13 00:00:00', '2022-03-07 20:36:38', '7327237282', 1, 5, 17846.8, 'active'),
(5, 20000, '', '2022-03-13', '', '2022-02-13 00:00:00', '2022-02-13 15:44:27', '7327237282', 1, 5, 21000, 'active'),
(6, 3000, '', '2022-03-06', '', '2022-02-13 00:00:00', '2022-02-13 15:45:43', '7327237282', 1, 5, 3150, 'active'),
(7, 7000, '', '2022-03-16', '', '2022-02-13 00:00:00', '2022-02-13 21:23:21', '8787665655944', 1, 5, 7350, 'active'),
(8, 13000, 'hhhh', '2022-02-24', '', '2022-02-24 00:00:00', '2022-03-09 22:43:46', '3525526161262126', 1, 5, 13450, 'active');

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

--
-- Dumping data for table `loan_payments`
--

INSERT INTO `loan_payments` (`loan_payment_id`, `amount`, `datetime_registered`, `loan_id`, `beneficiary_id`, `user_id`) VALUES
(1, 100, '2022-03-07 17:51:33', 7, '8787665655944', 1),
(2, 100, '2022-03-07 18:00:42', 8, '3525526161262126', 1),
(3, 100, '2022-03-07 21:23:03', 8, '3525526161262126', 1),
(4, 100, '2022-03-07 21:25:06', 1, '125355262636277', 1),
(5, 1000, '2022-03-07 21:27:00', 2, '7327237282', 1),
(6, 100, '2022-03-09 22:43:46', 8, '3525526161262126', 1),
(7, 10000, '2022-03-10 18:42:41', 1, '125355262636277', 1),
(8, 10000, '2022-03-10 18:46:42', 1, '125355262636277', 1),
(9, 10000, '2022-03-10 19:43:42', 1, '125355262636277', 1),
(10, 10000, '2022-03-10 19:43:55', 1, '125355262636277', 1),
(11, 7000, '2022-03-11 08:53:23', 1, '125355262636277', 1),
(12, 500, '2022-03-11 09:22:15', 1, '125355262636277', 1),
(13, 400, '2022-04-21 21:06:26', 1, '125355262636277', 1),
(14, 200, '2022-04-21 21:27:46', 1, '125355262636277', 1);

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
(5, '7327237282', '2022-W05', '2022-02-01 23:02:43', 0, 1200),
(6, '125355262636277', '2022-W08', '2022-02-24 21:41:07', 0, 1000),
(7, '125355262636277', '2022-W07', '2022-02-25 08:10:06', 0, 1200),
(8, '125355262636277', '2022-W10', '2022-03-11 09:32:30', 0, 1000),
(9, '3525526161262126', '2022-W10', '2022-03-11 09:34:05', 0, 2000),
(10, '125355262636277', '2022-W16', '2022-04-21 21:06:53', 0, 1000);

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
(1, '3525526161262126', '2022-W05', '2022-02-24 21:25:57', 0, 100),
(2, '3525526161262126216', '2019-W09', '2022-02-25 18:08:53', 0, 100),
(3, '3525526161262126216', '2019-W09', '2022-02-25 18:08:43', 1, 100),
(4, '8787665655944', '2022-W08', '2022-02-24 21:27:29', 0, 120),
(5, '125355262636277', '2022-W08', '2022-02-24 21:41:34', 0, 100),
(6, '125355262636277', '2022-W08', '2022-02-25 20:22:07', 0, 70),
(7, '8787665655944', '', '2022-03-07 21:47:16', 0, 100),
(8, '125355262636277', '2022-W10', '2022-03-11 08:53:57', 0, 100),
(9, '125355262636277', '2022-W10', '2022-03-11 08:54:18', 0, 100),
(10, '3525526161262126', '2022-W10', '2022-03-11 09:32:16', 0, 100),
(11, '125355262636277', '2022-W16', '2022-04-21 21:06:39', 0, 100);

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
('admin', 1, 'a590ad16d9b5b17abd86d4b786c35549', 'Cairo +2'),
('coach', 1, '81dc9bdb52d04dc20036dbd8313ed055', '+2 Cailo');

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vsla_groups`
--

CREATE TABLE `vsla_groups` (
  `VSLA_id` int(11) NOT NULL,
  `VSLA_name` varchar(200) NOT NULL,
  `datetime_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_created` date NOT NULL,
  `date_joined_the_organization` date NOT NULL,
  `vsla_zone_id` int(11) NOT NULL,
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

INSERT INTO `vsla_groups` (`VSLA_id`, `VSLA_name`, `datetime_registered`, `datetime_updated`, `date_created`, `date_joined_the_organization`, `vsla_zone_id`, `meetings_frequency`, `amount_per_share`, `social_funds_amount`, `maximum_loan_amount`, `default_loan_interest_rate`, `default_overdue_loan_fine`, `status`) VALUES
(1, 'testing name', '2022-02-17 08:23:25', '2022-01-15 08:24:04', '2020-04-12', '2020-04-12', 1, 4, 1000, 100, 15000, 0, 7, 'active'),
(2, 'testing name', '2022-02-17 08:23:35', '2022-01-15 08:42:02', '2020-04-12', '2020-04-12', 2, 4, 1000, 100, 15000, 15, 7, 'active'),
(3, 'testing name', '2022-02-24 14:24:23', '2022-01-15 08:48:53', '2020-04-12', '2020-04-12', 4, 4, 1000, 100, 15000, 15, 7, 'active'),
(4, 'testing name', '2022-02-17 08:23:47', '2022-01-15 08:49:56', '2020-04-12', '2020-04-12', 1, 4, 1000, 100, 15000, 15, 7, 'active'),
(5, 'testing name', '2022-02-17 08:23:53', '2022-01-15 08:53:36', '2020-04-12', '2020-04-12', 2, 4, 1000, 100, 15000, 15, 7, 'active'),
(6, 'testing name', '2022-02-17 08:23:58', '2022-01-15 08:53:39', '2020-04-12', '2020-04-12', 3, 4, 1000, 100, 15000, 15, 7, 'active'),
(7, 'testing name', '2022-02-17 08:24:05', '2022-01-15 08:55:44', '2020-04-12', '2020-04-12', 1, 4, 1000, 100, 15000, 15, 7, 'active'),
(8, 'testing name', '2022-02-17 08:24:11', '2022-01-15 08:56:06', '2020-04-12', '2020-04-12', 2, 4, 1000, 100, 15000, 15, 7, 'active'),
(9, 'testing name', '2022-02-17 08:24:17', '2022-01-15 09:01:55', '2020-04-12', '2020-04-12', 3, 4, 1000, 100, 15000, 15, 7, 'active'),
(10, 'testing name', '2022-02-17 08:24:27', '2022-01-15 09:01:57', '2020-04-12', '2020-04-12', 1, 4, 1000, 100, 15000, 15, 7, 'active'),
(11, 'testing name', '2022-02-17 08:24:34', '2022-01-15 09:02:53', '2020-04-12', '2020-04-12', 2, 4, 1000, 100, 15000, 15, 7, 'active'),
(12, 'testing name', '2022-02-17 08:24:39', '2022-01-15 09:02:55', '2020-04-12', '2020-04-12', 3, 4, 1000, 100, 15000, 15, 7, 'active'),
(13, '', '2022-02-17 08:24:46', '2022-01-15 09:43:03', '0000-00-00', '0000-00-00', 1, 4, 1000, 100, 15000, 0, 10, 'active'),
(14, 'Urugwiro Group', '2022-02-17 08:24:53', '2022-01-15 13:28:31', '2021-12-28', '2022-01-01', 2, 4, 1000, 100, 15000, 0, 10, 'active'),
(15, 'Ubumwe Rwaza', '2022-02-17 08:25:01', '2022-01-15 13:52:15', '2022-01-06', '2022-01-06', 3, 4, 1000, 100, 15000, 0, 10, 'active'),
(16, '', '2022-02-17 08:25:08', '2022-02-13 16:10:12', '0000-00-00', '0000-00-00', 1, 4, 1000, 100, 15000, 0, 10, ''),
(17, '', '2022-04-20 13:19:40', '2022-04-20 13:19:40', '0000-00-00', '0000-00-00', 0, 4, 1000, 100, 15000, 0, 10, ''),
(18, '', '2022-04-20 13:26:36', '2022-04-20 13:26:36', '0000-00-00', '0000-00-00', 0, 4, 1000, 100, 15000, 0, 10, ''),
(19, '', '2022-04-20 13:26:54', '2022-04-20 13:26:54', '0000-00-00', '0000-00-00', 0, 4, 1000, 100, 15000, 0, 10, '');

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
-- Dumping data for table `vsla_group_assets`
--

INSERT INTO `vsla_group_assets` (`asset_id`, `VSLA_id`, `asset_type_nature`, `asset_description`, `asset_estimated_value`, `registration_date`) VALUES
(1, 2, 'Agriculture', '', 120000, '2022-02-19 21:45:40'),
(2, 5, 'Farming', '', 50000, '2022-02-19 21:51:28');

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
(2, 'Rwaza', 'parish', '{\"District\":\"Musanze\", \"Sector\":\"Muhoza\", \"Province\":\"North\"}'),
(3, 'Rugeshi', 'parish', '{\"District\":\"Musanze\", \"Sector\":\"Muhoza\", \"Province\":\"North\"}'),
(4, 'Nemba', 'parish', '{\"District\":\"Gakenke\", \"Sector\":\"Nemba\", \"Province\":\"North\"}'),
(5, 'Busogo', 'parish', '{\"District\":\"Nyabihu\", \"Sector\":\"Busogo\", \"Province\":\"West\"}');

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
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`log_id`);

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
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_information`
--
ALTER TABLE `loan_information`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `loan_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `saving_records`
--
ALTER TABLE `saving_records`
  MODIFY `saving_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `social_funds_records`
--
ALTER TABLE `social_funds_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vsla_groups`
--
ALTER TABLE `vsla_groups`
  MODIFY `VSLA_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vsla_group_assets`
--
ALTER TABLE `vsla_group_assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vsla_zones`
--
ALTER TABLE `vsla_zones`
  MODIFY `vsla_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
