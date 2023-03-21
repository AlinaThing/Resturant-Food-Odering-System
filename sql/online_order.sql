-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 01:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(1, 'alina', 'alinaDear', 'alina@gmail.com', '', '2021-05-18 10:42:11'),
(2, 'sabhyeta', 'sabhyeta@1', 'sabhyeta@gmail.com', 'SAB5HZ', '2021-05-19 13:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `d_id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `total_quantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  `c_category` varchar(50) DEFAULT NULL,
  `total_quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `title`, `slogan`, `price`, `img`, `c_category`, `total_quantity`) VALUES
(1, 'veg steam momo', 'Yummy!', '80.00', 'veg_steam_momo.jpg', 'momo', 13),
(2, 'buff steam momo', 'Yummy', '90.00', 'buff_steam_momo.jpg', 'momo', 6),
(3, 'veg c momo', 'Yummy', '120.00', 'veg_c_momo.jpg', 'momo', 10),
(4, 'Chicken Burger', 'New taste!', '200.00', 'chickenBurger.jpg', 'burger', 11),
(5, 'chicken chowmein', 'Best service from our restaurant!', '130.00', 'chicken_chowmein.jpg', 'chowmein', 9),
(6, 'chicken c momo', 'Yummy', '150.00', 'chicken_c_momo.jpg', 'momo', 13),
(7, 'chicken fried momo', 'Yummy', '140.00', 'chicken_fried_momo.jpg', 'momo', 10),
(8, 'buff fried momo', 'try something different!', '120.00', 'buff_fried_momo.jpg', 'momo', 9),
(24, 'veg chowmein', 'chowmein with reasonable price and high quality!', '70.00', 'vegChowmein.jpg', 'chowmein', 12),
(25, 'veg burger', 'different taste!', '100.00', 'vegBurger.jpg', 'burger', 12),
(26, 'veg pizza', 'sweet pizza', '100.00', 'vegPizza.jpg', 'pizza', 10),
(28, 'chicken steam momo', 'momo of different taste!!', '130.00', 'chicken_steam_momo.jpg', 'momo', 13),
(29, 'buff c momo', 'cheapest momo!', '120.00', 'buff_c_momo.jpg', 'momo', 13),
(30, 'chicken pizza', 'yummy pizza!', '200.00', 'chickenPizza.jpg', 'pizza', 8),
(35, 'veg fried momo', 'fried veg momo at cheapest price!', '100.00', '60da96536c3c3.jpg', 'momo', 13);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `username` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`username`, `message`) VALUES
('sabhyeta', 'this is test'),
('sabhyeta', 'this is test'),
('sabhyeta', 'said'),
('sabhyeta', 'said'),
('sabhyeta', 'this is second test'),
('sabhyeta', 'this is second test'),
('sabhyeta', 'your order is ready');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`username`) VALUES
('sabhyeta');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(62, 32, 'in process', 'hi', '2021-04-18 11:50:52'),
(63, 32, 'closed', 'cc', '2021-04-18 11:51:46'),
(64, 32, 'in process', 'fff', '2021-04-18 12:16:37'),
(65, 32, 'closed', 'its delv', '2021-04-18 12:23:55'),
(66, 34, 'in process', 'on a way', '2021-04-18 13:11:32'),
(67, 35, 'closed', 'ok', '2021-04-18 13:14:08'),
(68, 37, 'in process', 'on the way!', '2021-04-18 14:05:06'),
(69, 37, 'rejected', 'if admin cancel for any reason this box is for remark only for buter perposes', '2021-04-18 14:06:19'),
(70, 37, 'closed', 'delivered success', '2021-04-18 14:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(6, 'momo', '2021-04-23 06:18:56'),
(7, 'pasta', '2021-04-14 13:00:13'),
(9, 'fish', '2021-04-14 12:59:33'),
(11, 'pizza', '2021-04-23 06:19:22'),
(12, 'chowmein', '2021-04-23 06:19:49'),
(15, 'burger', '2021-04-27 09:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(1, 'rina99', 'rina', 'thing', 'rina99@gmail.com', '984 1240385', '8c2bf66336c3d1c838b7bdff40fa94fc', 'tokha kathmandu', 1, '2021-04-18 04:20:03'),
(2, 'sarishma99', 'sarishma', 'acharya', 'sarishma99@gmail.com', '977 986 1202018', 'sarishma99', 'kupandol kathmandu', 1, '2021-05-18 10:52:53'),
(33, 'AlinaThing', 'alina', 'thing', 'alina.thing@gmail.com', '9863192828', '053b0150d525bac64429942b6528e514', 'Dhulikhel', 1, '2021-04-27 09:47:50'),
(36, 'sabhyeta', 'sabhyeta', 'acharya', 'a@gmail.com', '9874646464', 'sabhyeta@1', '', 1, '2021-06-22 15:35:16'),
(38, 'rajshree', 'raj', 'acharya', 'raj@gmail.com', '9863190261', 'rajshree', '', 1, '2021-05-19 14:04:01'),
(39, 'Alina', 'Alina', 'Thing', 'alina@gmail.com', '9863190261', 'alinaDear', '', 1, '2021-05-27 09:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(1, 1, 'pizza', 5, '150.00', 'closed', '2021-04-22 01:56:28'),
(57, 2, 'buff steam momo', 1, '90.00', NULL, '2021-06-26 10:29:11'),
(58, 2, 'buff steam momo', 1, '90.00', NULL, '2021-06-26 10:31:33'),
(59, 2, 'buff steam momo', 1, '90.00', NULL, '2021-06-26 10:31:58'),
(60, 2, 'buff steam momo', 1, '90.00', NULL, '2021-06-26 10:33:43'),
(66, 36, 'buff fried momo', 3, '120.00', NULL, '2021-06-26 10:40:46'),
(67, 36, 'chicken pizza', 3, '200.00', NULL, '2021-06-26 10:40:46'),
(70, 36, 'Chicken Burger', 1, '200.00', NULL, '2021-06-27 03:34:13'),
(72, 36, 'chicken chowmein', 2, '130.00', NULL, '2021-06-27 03:34:13'),
(73, 36, 'Chicken Burger', 1, '200.00', NULL, '2021-06-27 03:36:47'),
(76, 36, 'Chicken Burger', 1, '200.00', NULL, '2021-06-27 03:37:05'),
(77, 36, 'veg c momo', 1, '120.00', NULL, '2021-06-27 03:37:05'),
(78, 36, 'chicken chowmein', 2, '130.00', NULL, '2021-06-27 03:37:05'),
(79, 36, 'Chicken Burger', 1, '200.00', NULL, '2021-06-27 03:39:29'),
(80, 36, 'veg c momo', 1, '120.00', NULL, '2021-06-27 03:39:30'),
(81, 36, 'chicken chowmein', 2, '130.00', NULL, '2021-06-27 03:39:30'),
(91, 36, 'buff fried momo', 1, '120.00', NULL, '2021-06-27 03:55:03'),
(92, 36, 'buff fried momo', 1, '120.00', NULL, '2021-06-27 03:56:52'),
(93, 36, 'buff fried momo', 1, '120.00', NULL, '2021-06-27 03:58:48'),
(94, 36, 'buff fried momo', 1, '120.00', NULL, '2021-06-27 03:59:20'),
(95, 36, 'buff fried momo', 1, '120.00', NULL, '2021-06-27 04:03:03'),
(96, 36, 'buff steam momo', 1, '90.00', NULL, '2021-06-27 06:24:46'),
(97, 36, 'chicken fried momo', 2, '140.00', NULL, '2021-06-27 06:24:46'),
(99, 36, 'chicken pizza', 3, '200.00', NULL, '2021-06-27 15:19:44'),
(100, 36, 'chicken fried momo', 1, '140.00', NULL, '2021-06-27 15:19:44'),
(101, 36, 'chicken chowmein', 2, '130.00', NULL, '2021-06-28 01:47:22'),
(102, 36, 'chicken pizza', 1, '200.00', NULL, '2021-06-28 01:47:22'),
(103, 36, 'buff steam momo', 3, '90.00', NULL, '2021-06-28 01:47:22'),
(104, 1, 'veg c momo', 1, '120.00', NULL, '2021-06-28 09:22:11'),
(105, 1, 'Chicken Burger', 1, '200.00', NULL, '2021-06-28 09:22:11'),
(106, 36, 'chicken chowmein', 2, '130.00', NULL, '2021-06-28 10:10:20'),
(107, 36, 'chicken pizza', 1, '200.00', NULL, '2021-06-28 10:10:20'),
(108, 36, 'buff steam momo', 3, '90.00', NULL, '2021-06-28 10:10:20'),
(109, 36, 'Chicken Burger', 1, '200.00', NULL, '2021-06-28 10:10:20'),
(110, 36, 'veg c momo', 1, '120.00', NULL, '2021-06-29 06:22:36'),
(111, 36, 'veg burger', 1, '100.00', NULL, '2021-06-29 06:22:36'),
(112, 36, 'veg pizza', 1, '100.00', NULL, '2021-06-29 06:22:36'),
(113, 36, 'veg c momo', 1, '120.00', NULL, '2021-06-29 06:30:52'),
(114, 36, 'veg pizza', 2, '100.00', NULL, '2021-06-29 06:30:52'),
(115, 36, 'veg chowmein', 1, '70.00', NULL, '2021-06-29 06:30:52'),
(116, 36, 'buff fried momo', 3, '120.00', NULL, '2021-06-29 06:30:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `dishes` (`d_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
