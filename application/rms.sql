-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 02:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `contact_info` varchar(20) NOT NULL,
  `tower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_rent`
--

CREATE TABLE `monthly_rent` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `flat_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expense` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_rent`
--

INSERT INTO `monthly_rent` (`id`, `tenant_id`, `flat_id`, `amount`, `expense`, `created_at`, `updated_at`) VALUES
(5, 15, 1, 123, 0, '2024-01-28 21:04:47', '2024-01-28 21:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flats`
--

CREATE TABLE `tbl_flats` (
  `flat_id` int(11) NOT NULL,
  `tower_id` int(50) NOT NULL,
  `type` enum('A','B','','') NOT NULL COMMENT 'A-5Starr , B-Simple',
  `rent` varchar(100) NOT NULL,
  `expense` varchar(500) NOT NULL,
  `owner_id` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_flats`
--

INSERT INTO `tbl_flats` (`flat_id`, `tower_id`, `type`, `rent`, `expense`, `owner_id`, `status`) VALUES
(1, 1, 'A', '123', '123', '123', 'tes'),
(2, 1, 'A', '123', '123', '123', 'tes'),
(3, 1, 'A', '123', '123', '123', 'tes'),
(4, 1, 'A', '123', '123', '123', 'tes'),
(5, 1, 'A', 'asd', '', '1', '1'),
(6, 1, 'A', 'asd', '', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tower`
--

CREATE TABLE `tbl_tower` (
  `id` int(11) NOT NULL,
  `tower_name` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tower`
--

INSERT INTO `tbl_tower` (`id`, `tower_name`, `owner_id`, `employee_id`) VALUES
(1, 'asd', 21, 0),
(2, 'asd', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `type` enum('1','2','3','4') NOT NULL COMMENT '1-Adim,2-Manager,3-Cusomer,4-Manager,5-Employee',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plainPassword` varchar(50) NOT NULL,
  `profile_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `contact_no`, `type`, `created_at`, `plainPassword`, `profile_img`) VALUES
(13, 'adil', 'ali', '', 'adilali@gmail.com', '$2y$10$id820P60qkm.EXE/VSXT9OX2pDLIz0NOLVVcBy.afc1Cb9AUFJtSK', '', '1', '2023-12-05 21:22:58', '', ''),
(15, 'test', 'test', '', '1adilali1@gmail.com', '$2y$10$SAelUeQZD9yAmzZTQY7Fg.KTnO7JZc.7Fmon4kfb5kFo/m85byf5y', '11111111111', '3', '2023-12-05 21:48:36', 'adil1234', ''),
(16, 'adil', 'ali', '', '2adilali1@gmail.com', '$2y$10$dlLQnS3/M9Id5IhLIiD6cel1Kp/hPYRPgygrQf4hYGkEnJEWpm7ru', '', '2', '2023-12-05 21:50:04', '123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `tenant_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flat_id` varchar(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_rent`
--
ALTER TABLE `monthly_rent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_flats`
--
ALTER TABLE `tbl_flats`
  ADD PRIMARY KEY (`flat_id`);

--
-- Indexes for table `tbl_tower`
--
ALTER TABLE `tbl_tower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monthly_rent`
--
ALTER TABLE `monthly_rent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_flats`
--
ALTER TABLE `tbl_flats`
  MODIFY `flat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_tower`
--
ALTER TABLE `tbl_tower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
