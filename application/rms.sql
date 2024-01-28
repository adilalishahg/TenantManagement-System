-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 09:04 PM
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
  `expense` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_rent`
--

INSERT INTO `monthly_rent` (`id`, `tenant_id`, `flat_id`, `amount`, `expense`) VALUES
(1, 0, 1, 123, 0),
(2, 0, 1, 123, 0);

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
(14, 'test', 'user', '', 'adilali1@gmail.com', '$2y$10$0f8CRtKqslpV8TDWUtPlEeRf5kA7BX/fk4a1eie5Foc3SdWiCUf1y', '', '1', '2023-12-05 21:25:13', 'adil1234', ''),
(15, 'test', 'test', '', '1adilali1@gmail.com', '$2y$10$SAelUeQZD9yAmzZTQY7Fg.KTnO7JZc.7Fmon4kfb5kFo/m85byf5y', '11111111111', '3', '2023-12-05 21:48:36', 'adil1234', ''),
(16, 'adil', 'ali', '', '2adilali1@gmail.com', '$2y$10$dlLQnS3/M9Id5IhLIiD6cel1Kp/hPYRPgygrQf4hYGkEnJEWpm7ru', '', '2', '2023-12-05 21:50:04', '123456789', ''),
(17, 'test', 'user', '', '5adilali1@gmail.com', '$2y$10$508FNT9EdJLJVIssc5p5decKwnnqB7efDlFDLHFIrLVtikXBddDQS', '', '2', '2023-12-05 21:51:31', '123456789', ''),
(18, 'adil', 'ail', '', 'ds5adilali1@gmail.com', '$2y$10$ojrPnFso89QfXiIhdhny7.V.bAglGA87gkLDoZsSq6qoU42Da79M6', '', '1', '2023-12-05 21:52:51', '123456789', ''),
(19, 'adil', 'Ali', '', 'a5adilali1@gmail.com', '$2y$10$EFW/zND42lglFmaL73GEgep/A6FDduhy8o5L16HM8XdJ7IF6WTPpW', '', '2', '2023-12-05 21:54:13', 'Al123456', 'assets/uploads/WhatsApp_Image_2023-10-08_at_08_11_428.jpeg'),
(20, 'test', 'test', '', 'a5adilali1z@gmail.com', '$2y$10$qQU6rGLyQUlKXC5m9YyCeu2VRTpJexnvW96Ap9aWC0joL6oWkQd36', '', '2', '2023-12-07 03:30:38', 'Al123456', 'assets/uploads/WhatsApp_Image_2023-10-08_at_08_11_423.jpeg'),
(21, 'Mr', 'User', '', 'adil@gmail.com', '$2y$10$1SqC35hKkCVuJ18cM99qY.HrPFlzwHO38D6a8jJ0d3nQQzn8sGO1K', '0321882774', '1', '2023-12-31 01:59:46', '16Arid1314', 'assets/uploads/'),
(22, 'adil', 'ali', '', 'adilal1ai1@gmail.com', '$2y$10$XOu8QW8wdbyQQnJhalzGperMqOU/zZrxnitZsXRLIy0iJ6HN9yXSi', '0321882774', '2', '2024-01-11 02:10:47', '16Arid1314', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
