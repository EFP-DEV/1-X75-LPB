-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2025 at 06:22 PM
-- Server version: 10.6.18-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `chez_fernande`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price_min` decimal(10,2) DEFAULT NULL,
  `price_max` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `is_sale` tinyint(1) DEFAULT 0,
  `rating` tinyint(4) DEFAULT 0,
  `product_type` enum('standard','fancy','popular','special','sale') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price_min`, `price_max`, `price`, `sale_price`, `image`, `is_sale`, `rating`, `product_type`, `created_at`) VALUES
(1, 'Fancy Product', 40.00, 80.00, NULL, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 0, 'fancy', '2025-04-08 08:52:15'),
(2, 'Special Item', NULL, NULL, 20.00, 18.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 5, 'special', '2025-04-08 08:52:15'),
(3, 'Sale Item', NULL, NULL, 50.00, 25.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 0, 'sale', '2025-04-08 08:52:15'),
(4, 'Popular Item', NULL, NULL, 40.00, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 5, 'popular', '2025-04-08 08:52:15'),
(5, 'Sale Item', NULL, NULL, 50.00, 25.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 0, 'sale', '2025-04-08 08:52:15'),
(6, 'Fancy Product', 120.00, 280.00, NULL, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 0, 'fancy', '2025-04-08 08:52:15'),
(7, 'Special Item', NULL, NULL, 20.00, 18.00, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 1, 5, 'special', '2025-04-08 08:52:15'),
(8, 'Popular Item', NULL, NULL, 40.00, NULL, 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg', 0, 5, 'popular', '2025-04-08 08:52:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
