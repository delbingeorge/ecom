-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 03:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `craftsmendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(5) NOT NULL,
  `adminname` varchar(15) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `email`, `password`) VALUES
(142134, 'admin', 'dummy@gmail.com', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `blacklistedusers`
--

CREATE TABLE `blacklistedusers` (
  `Uid` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `p_id` varchar(15) DEFAULT NULL,
  `uid` varchar(15) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `p_id`, `uid`, `product_name`, `quantity`, `price`, `image`, `total`) VALUES
(129, '15', '25', 'Axe Pro Max', '1', 10, 'Screenshot 2023-04-06 174718.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `content` varchar(256) NOT NULL,
  `date` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `username`, `content`, `date`, `email`) VALUES
(13131, 'yedu', 'Thanks!', '2023-10-10', 'yedupj@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` varchar(15) NOT NULL,
  `u_id` varchar(15) DEFAULT NULL,
  `transaction_info` varchar(20) NOT NULL,
  `p_name` varchar(15) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(15) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `u_id`, `transaction_info`, `p_name`, `phoneNumber`, `email`, `address`, `payment_mode`, `created_at`) VALUES
('Order642ec759c6', '25', 'Total Price:10', 'Axe Pro Max', 896858943, 'olivia.thompson@gmai', ' 123 Main St, S', 'Cash on Delivery', '2023-04-06 18:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_Id` int(11) NOT NULL,
  `Amount` int(25) NOT NULL,
  `Date` date DEFAULT curdate(),
  `Payment_Status` varchar(10) NOT NULL,
  `Bill_Invoice` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_Id`, `Amount`, `Date`, `Payment_Status`, `Bill_Invoice`) VALUES
(1, 2834, '2023-04-03', '1', 'bla'),
(2, 2834, '2023-04-03', '1', 'bla'),
(3, 2834, '2023-04-03', '1', 'bla'),
(4, 2834, '2023-04-03', '1', 'bla'),
(5, 2834, '2023-04-03', '1', 'bla'),
(6, 2834, '2023-04-03', '1', 'bla'),
(7, 2834, '2023-04-03', '1', 'bla'),
(8, 2834, '2023-04-03', '1', 'bla'),
(9, 2834, '2023-04-03', '1', 'bla'),
(10, 2834, '2023-04-03', '1', 'bla'),
(11, 2834, '2023-04-03', '1', 'bla'),
(12, 2834, '2023-04-03', '1', 'bla'),
(13, 2834, '2023-04-03', '1', 'bla'),
(14, 2834, '2023-04-03', '1', 'bla');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(20) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `product_name`, `image`, `price`, `description`, `qty`) VALUES
(7, 'Python Hammer Home Kit 2G', 'hamm.png', 20, 'Made in India Ideal for DIY, Home Improvement, General Repa', 222),
(15, 'Axe Pro Max', 'Screenshot 2023-04-06 174718.png', 10, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Enim lobortis scelerisque fermentum dui faucibus in. Nisi porta lorem mollis aliquam ut porttitor. Nunc sed id semper risus in. Morbi tempus iaculis urna id. Turpis egestas integer eget aliquet nibh praesent. Vitae elementum curabitur vitae nunc sed velit dignissim sodales. ', 78);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(35) NOT NULL,
  `phoneNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `address`, `phoneNumber`) VALUES
(23, 'Liam Rodriguez', '12345678', 'liam.rodriguez@outlook.com', '789 Maple St, Portland, OR 97209', 243564645),
(25, 'Olivia Thompson', '12345678', 'olivia.thompson@gmail.com', ' 123 Main St, Springfield, IL 62704', 896858943),
(26, 'Emma Lee', 'asdfasdf', 'emma.lee@gmail.com', '222 Pine St, Seattle, WA 98101', 353454562);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklistedusers`
--
ALTER TABLE `blacklistedusers`
  ADD PRIMARY KEY (`Uid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklistedusers`
--
ALTER TABLE `blacklistedusers`
  MODIFY `Uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34553326;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
