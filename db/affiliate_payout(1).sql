-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 08:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affiliate_payout`
--

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `item_id` int(11) NOT NULL,
  `commission_paid` tinyint(4) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `amount`, `item_id`, `commission_paid`, `created_datetime`) VALUES
(1, 6, 250.00, 1, 0, '2024-08-23 16:33:45'),
(2, 1, 250.00, 1, 0, '2024-08-23 16:36:13'),
(3, 6, 250.00, 1, 0, '2024-08-23 16:36:53'),
(4, 6, 250.00, 1, 0, '2024-08-23 16:37:50'),
(5, 6, 250.00, 1, 0, '2024-08-23 16:39:05'),
(6, 6, 250.00, 1, 0, '2024-08-23 16:39:17'),
(7, 6, 250.00, 1, 0, '2024-08-23 16:49:50'),
(8, 6, 250.00, 1, 0, '2024-08-23 16:50:12'),
(9, 6, 250.00, 1, 0, '2024-08-23 16:54:13'),
(10, 6, 250.00, 1, 0, '2024-08-23 16:55:08'),
(11, 6, 250.00, 1, 0, '2024-08-23 16:55:24'),
(12, 6, 250.00, 1, 0, '2024-08-23 16:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referrer_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT 1,
  `created_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `referrer_id`, `level`, `created_datetime`) VALUES
(1, 'Preethi', 'test@test.com', '$2y$10$FZN7O5q0eJ8qY09b1t7xW.2ngIGwU3288wYysKRtia5SWlWmtpv76', 0, 1, '2024-08-23 15:35:48'),
(2, 'Test1', 'test1@test.com', '$2y$10$TE8xGq2UefxolwH8IA448OYkOgK7/l4ZFS1hYd9fXdD9UzZHUxNym', 1, 2, '2024-08-23 15:40:30'),
(3, 'Test2', 'test2@test.com', '$2y$10$cokwdvysD4fLtQcZ125MIeVcGYf2SiSJePO548w2V1tInE1AuOry.', 2, 3, '2024-08-23 17:53:57'),
(4, 'Test3', 'test3@test.com', '$2y$10$rnhnfaarCPDag7Yb3DEWa.76Tp6dbcC4MZRLu4DZziorCEIjD2CKy', 3, 4, '2024-08-23 17:55:07'),
(5, 'Test4', 'test4@test.com', '$2y$10$VPcEe.Spazfg0HWk4QNF1O7zz.XIaednqHVvL82ZDVjVmQ40GTOZa', 4, 5, '2024-08-23 17:56:46'),
(6, 'Test6', 'test6@test.com', '$2y$10$llbtR6TDmS/QZydXxCZbIeFdLPb6iPGb4gbLgOgtGDg2pO7TGRQoe', 5, 6, '2024-08-23 17:57:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrer_id` (`referrer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
