-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 04:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipt2-project.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `product_name`, `category`, `price`, `stock_quantity`) VALUES
(5, 'Dove', 'Hygiene', 167, 15),
(7, 'Vaseline', 'Hygiene', 123, 2),
(12, 'Energen', 'food', 84, 123),
(13, 'Milo', 'Food', 100, 120),
(14, 'Lamp', 'Electronics', 233, 12),
(15, 'Mug', 'Home', 123, 12),
(16, 'Sponge', 'Home', 150, 156),
(17, 'Rebisco', 'Food', 123, 12),
(18, 'Battery', 'Electronics', 178, 3),
(20, 'Colgate', 'Hygiene', 120, 52),
(21, 'Electric Fan', 'Electronics', 790, 6),
(26, 'Hana', 'Hygiene', 123, 12),
(27, 'Silka', 'Hygiene', 130, 12),
(29, 'Sunsilk', 'Hygiene', 84, 12),
(31, 'Green Cross', 'Hygiene', 123, 14),
(33, 'Pond\'s', 'Hygiene', 45, 55),
(34, 'Cup Noodles', 'Food', 26, 44),
(35, 'Charger', 'Electronics', 245, 33),
(36, 'Calculator', 'Electronics', 250, 12),
(37, 'Toothbrush', 'Hygiene', 46, 44),
(38, 'Umbrella ', 'Home', 246, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
