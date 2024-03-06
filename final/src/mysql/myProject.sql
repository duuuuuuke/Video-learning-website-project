-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 19, 2022 at 12:07 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloud_computing`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_comments`
--

CREATE TABLE `all_comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `comments` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `all_comments`
--

INSERT INTO `all_comments` (`id`, `product_id`, `username`, `comments`, `date`) VALUES
(10, 60, 'dudeyes', '123', '2022-10-17 12:25:47'),
(11, 62, 'test1', '432423', '2022-10-17 13:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int NOT NULL,
  `filename` text NOT NULL,
  `type` text NOT NULL,
  `path` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `userid` int NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `type`, `path`, `username`, `userid`, `title`, `description`) VALUES
(60, 'Supply_and_Demand_Explained_in_One_Minute.mp4', 'video/mp4', '/var/www/html/myapp/uploads/18/123/Supply_and_Demand_Explained_in_One_Minute.mp4', 'dudeyes', 18, '123', '432432'),
(61, '1_Minute_Timer.mp4', 'video/mp4', '/var/www/html/myapp/uploads/19/title123/1_Minute_Timer.mp4', 'test1', 19, 'title123', 'fdsareasreasrdfsa'),
(62, 'Blockchain_Explained_In_Under_One_Minute.mp4', 'video/mp4', '/var/www/html/myapp/uploads/19/title123/Blockchain_Explained_In_Under_One_Minute.mp4', 'test1', 19, 'title123', 'fdsareasreasrdfsa'),
(63, 'Fundamentals_of_Eth_staking_explained_under_1_minute__Superphiz_-_WholesomeCrypto_Miniclip.mp4', 'video/mp4', '/var/www/html/myapp/uploads/19/test222222222/Fundamentals_of_Eth_staking_explained_under_1_minute__Superphiz_-_WholesomeCrypto_Miniclip.mp4', 'test1', 19, 'test222222222', 'fdsareareafdsa'),
(64, 'How_work_memorys____1min_Explanation_13.mp4', 'video/mp4', '/var/www/html/myapp/uploads/19/test222222222/How_work_memorys____1min_Explanation_13.mp4', 'test1', 19, 'test222222222', 'fdsareareafdsa'),
(65, 'What_is_Blockchain-_Blockchain_Explained_in_1_Minute.mp4', 'video/mp4', '/var/www/html/myapp/uploads/19/test222222222/What_is_Blockchain-_Blockchain_Explained_in_1_Minute.mp4', 'test1', 19, 'test222222222', 'fdsareareafdsa');

-- --------------------------------------------------------

--
-- Table structure for table `product_like`
--

CREATE TABLE `product_like` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchased`
--

CREATE TABLE `purchased` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`id`, `username`, `title`) VALUES
(12, 'test1', '123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `verified` int NOT NULL DEFAULT '0',
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expire` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `verified`, `reset_token`, `token_expire`) VALUES
(18, 'dukebai8383@gmail.com', 'dudeyes', '$2y$10$QY6MMnRP5w7SEOF/4Nui4ejP8hG7Sg1PHx2Yocou1dALuYx4Oz9sC', 0, NULL, NULL),
(19, 'dukebai@gmail.com', 'test1', '$2y$10$a2JdatmK5PJyNS3d3tA6MuFYLHs9iiW690PL5Vgp1gUwuC1bcOqEm', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_comments`
--
ALTER TABLE `all_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USERNAME_COMMENT` (`username`),
  ADD KEY `FK_PRODUCT_COMMENT` (`product_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_upload` (`username`);

--
-- Indexes for table `product_like`
--
ALTER TABLE `product_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USERNAME_LIKE` (`username`),
  ADD KEY `FK_PRODUCT_LIKE` (`product_id`);

--
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USERNAME_PURCHASED` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USERNAME_WISHLIST` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_comments`
--
ALTER TABLE `all_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `product_like`
--
ALTER TABLE `product_like`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_comments`
--
ALTER TABLE `all_comments`
  ADD CONSTRAINT `FK_PRODUCT_COMMENT` FOREIGN KEY (`product_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USERNAME_COMMENT` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `FK_user_upload` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_like`
--
ALTER TABLE `product_like`
  ADD CONSTRAINT `FK_PRODUCT_LIKE` FOREIGN KEY (`product_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USERNAME_LIKE` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchased`
--
ALTER TABLE `purchased`
  ADD CONSTRAINT `FK_USERNAME_PURCHASED` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK_USERNAME_WISHLIST` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
