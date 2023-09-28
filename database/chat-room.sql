-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 03:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat-room`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(800) NOT NULL,
  `send_on_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `send_on_date`) VALUES
(1, 2, 1, 'hii', '2023-09-18 18:42:07'),
(2, 1, 2, 'ok', '2023-09-18 18:42:26'),
(3, 1, 2, 'how are you', '2023-09-18 18:56:55'),
(4, 1, 2, '?', '2023-09-18 18:57:04'),
(5, 2, 1, 'ok', '2023-09-23 12:17:57'),
(6, 1, 2, 'how are you', '2023-09-23 12:18:11'),
(7, 2, 1, 'hii', '2023-09-28 12:07:52'),
(8, 1, 2, 'ha bol', '2023-09-28 12:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` bigint(13) NOT NULL,
  `password` varchar(256) NOT NULL,
  `profile_url` varchar(200) NOT NULL,
  `last_time` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_online` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `password`, `profile_url`, `last_time`, `created_at`, `is_online`) VALUES
(1, 'mahedi', 9725805798, '698d51a19d8a121ce581499d7b701668', '84260-IMG_20230520_200727.jpg', '2023-09-28 09:33:33', '2023-08-17 09:43:58', 0),
(2, 'Varis', 9998842406, '698d51a19d8a121ce581499d7b701668', '', '2023-09-18 15:12:30', '2023-09-18 18:32:30', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
