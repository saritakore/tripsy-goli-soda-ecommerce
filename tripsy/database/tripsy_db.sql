-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2026 at 12:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripsy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`id`, `user_id`, `full_name`, `mobile`, `address`, `city`, `pincode`, `created_at`, `order_id`) VALUES
(1, 3, 'Sarita Sidram Kore', '09637407322', 'Flat no-9, Bhakati Co-operative society,near Vimal Vihar Society, New Nurses Town Co Operative Society, Bibwewadi', 'pune', '411037', '2025-12-31 10:59:34', NULL),
(2, 3, 'Sarita Sidram Kore', '09637407322', 'Flat no-9, Bhakati Co-operative society,near Vimal Vihar Society, New Nurses Town Co Operative Society, Bibwewadi', 'pune', '411037', '2025-12-31 11:11:08', NULL),
(3, 3, 'Sarita Sidram Kore', '09637407322', 'Flat no-9, Bhakati Co-operative society,near Vimal Vihar Society, New Nurses Town Co Operative Society, Bibwewadi', 'pune', '411037', '2025-12-31 12:20:29', NULL),
(4, 4, 'abc', '1234567891', 'abc', 'abc', '111222', '2026-01-02 09:47:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(11) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `brand_name` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_name`, `brand_name`, `address`, `contact`, `email`, `logo`) VALUES
(1, 'Andodagi & Son’s', 'Tripsy Goli Soda', 'At Post Kumbhari, South Solapur, Maharashtra – 413006', '9999999999', 'info@tripsy.com', 'A&Son_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` varchar(30) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_date`, `status`) VALUES
(1, 3, 1370, '2025-12-31 16:29:34', 'Pending'),
(2, 3, 20, '2025-12-31 16:41:08', 'Pending'),
(3, 3, 20, '2025-12-31 17:50:29', 'Pending'),
(4, 4, 240, '2026-01-02 15:17:21', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 7, 20),
(2, 1, 2, 3, 20),
(3, 1, 13, 3, 350),
(4, 1, 5, 6, 20),
(5, 2, 1, 1, 20),
(6, 3, 2, 1, 20),
(7, 4, 4, 1, 20),
(8, 4, 1, 1, 20),
(9, 4, 10, 1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `flavor` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `flavor`, `price`, `stock`, `image`, `status`) VALUES
(1, 'Tripsy Goli Soda', 'Lemon', 20, 100, 'lemon_goli_soda.png', 'Active'),
(2, 'Tripsy Goli Soda', 'Orange', 20, 100, 'orange_goli_soda.png', 'Active'),
(3, 'Tripsy Goli Soda', 'Pineapple', 20, 100, 'pineapple_goli_soda.png', 'Active'),
(4, 'Tripsy Goli Soda', 'Raspberry', 20, 100, 'raspberry_goli_soda.png', 'Active'),
(5, 'Tripsy Goli Soda', 'Blueberry', 20, 100, 'blueberry_goli_soda.png', 'Active'),
(6, 'Tripsy Goli Soda', 'Green Apple', 20, 100, 'green_apple_goli_soda.png', 'Active'),
(7, 'Tripsy Goli Soda', 'Kala Khatta', 20, 100, 'kala_khatta_goli_soda.png', 'Active'),
(8, 'Tripsy Goli Soda', 'Jeera', 20, 100, 'jeera_goli_soda.png', 'Active'),
(9, 'Tripsy Combo Pack', 'Starter Pack', 120, 50, 'starter_pack.png', 'Active'),
(10, 'Tripsy Combo Pack', 'Classic Pack', 200, 40, 'classic_pack.png', 'Active'),
(11, 'Tripsy Combo Pack', 'Fruit Blast Pack', 250, 30, 'fruit_blast_pack.png', 'Active'),
(12, 'Tripsy Combo Pack', 'Masala Pack', 220, 30, 'masala_pack.png', 'Active'),
(13, 'Tripsy Combo Pack', 'Family Pack', 350, 20, 'family_pack.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `created_at`) VALUES
(1, 'Test User', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '2026-01-02 15:09:24'),
(3, 'T U', 'tu@gmail.com', '7bf500c1250fa28dff02b2c217f357fa', NULL, '2026-01-02 15:09:24'),
(4, 'abc', 'abc@gmail.com', 'e99a18c428cb38d5f260853678922e03', '1234567891', '2026-01-02 15:14:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
