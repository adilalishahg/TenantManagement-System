-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 12:50 AM
-- Server version: 10.1.37-MariaDB
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
(6, 1, 'A', 'asd', '', '1', '1'),
(7, 1, 'A', '123', '', '13', '1'),
(8, 1, 'A', '123', '', '13', '1'),
(9, 2, 'A', '2222', '', '13', '1'),
(10, 2, 'A', '2222', '', '13', '1'),
(11, 1, 'A', '22', '', '15', '1'),
(12, 1, 'A', '22', '', '15', '1'),
(13, 1, 'A', '22', '', '15', '1'),
(14, 1, 'A', '22', '', '15', '1');

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
(2, 'asd', 14, 0),
(3, 'asd', 16, 0),
(4, 'asd', 16, 0),
(5, 'asd', 16, 0),
(6, 'asd', 16, 0),
(7, 'asd', 16, 0),
(8, 'asd', 16, 0),
(9, 'asd', 16, 0),
(10, 'asd', 16, 0);

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
  `type` enum('1','2','3','4','5') NOT NULL COMMENT '1-Adim,2-Manager,3-Cusomer,4-Manager,5-Employee',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plainPassword` varchar(50) NOT NULL,
  `profile_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `contact_no`, `type`, `created_at`, `plainPassword`, `profile_img`) VALUES
(13, 'adil', 'ali', '', '1adilali@gmail.com', '$2y$10$SAelUeQZD9yAmzZTQY7Fg.KTnO7JZc.7Fmon4kfb5kFo/m85byf5y', '', '1', '2023-12-05 21:22:58', 'adil1234', ''),
(15, 'test', 'test', '', '2adilali@gmail.com', '$2y$10$SAelUeQZD9yAmzZTQY7Fg.KTnO7JZc.7Fmon4kfb5kFo/m85byf5y', '11111111111', '2', '2023-12-05 21:48:36', 'adil1234', ''),
(26, 'asdad', 'asdad', 'asdadasdad', '3adilali@gmail.com', '$2y$10$c.J8GEXiMppmojNkSeALm.G70Y/bQkXVE.n7bJN2IRJZxTae5qxDC', 'asd', '3', '2024-02-06 23:40:41', 'adil1234', ''),
(27, 'asdad', 'asdad', 'asdadasdad', '4adilali@gmail.com', '$2y$10$mHagYXKY0URLKAp9kNYo.OuimjvILy2C/eBDz8Q53dpLtfVjVWJJe', 'asd', '4', '2024-02-06 23:40:44', 'adil1234', ''),
(28, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$/79eIP7dOoZLaNyVX90Ar.yiYqLSq.9zk4i7w33Vqi3TPKZUTBOvC', 'asd', '5', '2024-02-06 23:40:47', 'adil1234', ''),
(29, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$67I0hYAZt0PnjxFIVcgcbugE1zvA3cNfyDieH2kFhjZvv3tJqacXK', 'asd', '5', '2024-02-06 23:40:49', 'adil1234', ''),
(30, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$05adn33V.xSFATV8wkOI/enulmUHCFFbzYtSPOxEQOnF4VhiKs/5u', 'asd', '5', '2024-02-06 23:40:51', 'adil1234', ''),
(31, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$MYJq73V22ayRIggNVueSU.D43.mD72nMKvsgt4kOkFVEgPzuqrBzC', 'asd', '5', '2024-02-06 23:40:52', 'adil1234', ''),
(32, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$r6p6Sgvg47.djNOkxbEgwuakPTJuoJHmG/P3QyJD7H3syF44Qvdza', 'asd', '5', '2024-02-06 23:40:54', 'adil1234', ''),
(36, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$THIAac/BgnWbuBX84Cly4uRglog1n0Vvp3ca7UHj6HfcnqplOAgAi', 'asd', '5', '2024-02-06 23:41:01', 'adil1234', ''),
(37, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$yE9sHHL3tAKJlHWHT0yaK.iUn7H5gwN4EViC/gjLcps1.XtgOdoCy', 'asd', '5', '2024-02-06 23:41:03', 'adil1234', ''),
(38, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$rx0higwRjNxgwTjrlExAXeiUyoGRbAbg/Syr6sedtcmQJtQwmYNVS', 'asd', '5', '2024-02-06 23:41:04', 'adil1234', ''),
(39, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$jgM1jU2SZw9QfghkJUcc0.Eoh5/K1ao7DbKc5MsEH72JQejBlLFE6', 'asd', '5', '2024-02-06 23:41:06', 'adil1234', ''),
(40, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$4a7IZWdJDjwoBvTIlSsyhueSmiHmXJjBm5kBkn2NAnMGnEVMILjda', 'asd', '5', '2024-02-06 23:41:07', 'adil1234', ''),
(41, 'asdad', 'asdad', 'asdadasdad', 'adilali@gmail.com', '$2y$10$xAzCwCsR3aYasYXp4pVPl..pEDTX.qhidu7RP9D5GHMkzC25qECNW', 'asd', '5', '2024-02-06 23:41:09', 'adil1234', '');

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
  MODIFY `flat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_tower`
--
ALTER TABLE `tbl_tower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
