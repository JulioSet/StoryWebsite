-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 05:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tgs_fai_m7_0539`
--
CREATE DATABASE IF NOT EXISTS `tgs_fai_m7_0539` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tgs_fai_m7_0539`;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_feed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `id_user`, `id_feed`) VALUES
(7, 8, 14),
(8, 7, 17),
(9, 8, 15),
(10, 11, 17),
(11, 11, 18);

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

DROP TABLE IF EXISTS `feed`;
CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `title` text NOT NULL,
  `writer` text NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `photo`, `title`, `writer`, `date`, `likes`, `duration`, `description`, `content`) VALUES
(14, '1700024946.jpg', 'The Church', 'a', '14 Nov 2023', 2, 30, 'The Church', 'The Church'),
(15, '1699986748.jpg', 'Forest Night', 'user1', '14 Nov 2023', 3, 5, 'Forest Night', 'Forest Night'),
(16, '1699987163.jpg', 'White Tiger', 'user1', '14 Nov 2023', 3, 5, 'White Tiger', 'White Tiger'),
(17, '1699987344.jpg', 'Illusory Moon', 'user2', '14 Nov 2023', 1, 60, 'Illusory Moon', 'Illusory Moon'),
(18, '1699987521.jpg', 'Goblin Campfire', 'test', '14 Nov 2023', 1, 45, 'Goblin Campfire', 'Goblin Campfire');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `id_user_1` int(11) NOT NULL,
  `id_user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `id_user_1`, `id_user_2`) VALUES
(5, 8, 5),
(6, 5, 8),
(7, 8, 7),
(8, 7, 8),
(9, 11, 8),
(10, 8, 11),
(11, 11, 9),
(12, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_feed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_user`, `id_feed`) VALUES
(6, 8, 14),
(7, 9, 16),
(8, 11, 15),
(9, 11, 14),
(10, 11, 17),
(11, 11, 18);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id_user` int(11) NOT NULL,
  `total` int(11) DEFAULT 5000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_user`, `total`, `created_at`, `updated_at`) VALUES
(8, 5000, '2023-11-14 10:21:00', '2023-11-14 10:21:00'),
(9, 5000, '2023-11-14 10:36:04', '2023-11-14 10:36:04'),
(10, 5000, '2023-11-14 10:36:21', '2023-11-14 10:36:21'),
(11, 5000, '2023-11-14 10:36:41', '2023-11-14 10:36:41'),
(12, 5000, '2023-11-14 10:36:53', '2023-11-14 10:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `gender` char(1) NOT NULL COMMENT 'f = female | m = male',
  `bod` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `membership` int(11) NOT NULL DEFAULT 0 COMMENT '0 = false | 1 = true',
  `pict` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0: Inactive | 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `gender`, `bod`, `title`, `description`, `saldo`, `membership`, `pict`, `status`) VALUES
(5, 'issue', 'test@gmail.com', 'issue', 'm', '2023-11-14', 'Issue', 'Issue', 5000, 0, NULL, 0),
(6, 'admin', 'admin', 'admin', 'a', 'admin', 'admin', 'admin', 0, 0, NULL, 1),
(7, 'test', 'test@gmail.com', 'test', 'm', '2023-11-17', 'test', 'test', 0, 0, NULL, 1),
(8, 'a', 'a@gmail.com', 'a', 'm', '2023-11-09', 'a', 'a', 10000, 1, '1699981798.jpg', 1),
(9, 'user1', 'test@gmail.com', 'user1', 'f', '2023-11-15', 'user1', 'user1', 0, 1, '1700024877.jpg', 1),
(10, 'user2', 'test@gmail.com', 'user2', 'f', '2023-11-15', 'user2', 'user2', 0, 1, NULL, 1),
(11, 'user3', 'test@gmail.com', 'user3', 'm', '2023-11-15', 'user3', 'user3', 0, 1, NULL, 1),
(12, 'user4', 'test@gmail.com', 'user4', 'f', '2023-11-24', 'user4', 'user4', 0, 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
