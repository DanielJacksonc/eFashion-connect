-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 03:28 PM
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
-- Database: `fashion_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(10) NOT NULL,
  `buyer` enum('0','1') NOT NULL,
  `seller` enum('0','1') NOT NULL,
  `s_type` varchar(50) NOT NULL,
  `net_bal` float NOT NULL,
  `personal_bal` float NOT NULL,
  `earnings` float NOT NULL,
  `expense` float NOT NULL,
  `profile_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `buyer`, `seller`, `s_type`, `net_bal`, `personal_bal`, `earnings`, `expense`, `profile_id`, `created_at`) VALUES
(1, '0', '0', '', 0, 0, 0, 0, 1, '2022-04-25 07:33:53'),
(2, '1', '0', '', 100, 50, 0, 50, 2, '2022-04-25 07:37:44'),
(3, '0', '1', '', 50, 15, 50, 0, 3, '2022-04-25 07:39:00'),
(4, '0', '1', '', 0, 0, 0, 0, 4, '2022-04-26 12:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `delivaries`
--

CREATE TABLE `delivaries` (
  `delivary_id` varchar(15) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `buyer_id` varchar(15) NOT NULL,
  `seller_id` varchar(15) NOT NULL,
  `des` varchar(1500) NOT NULL,
  `file` varchar(20) NOT NULL,
  `file_name` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivaries`
--

INSERT INTO `delivaries` (`delivary_id`, `order_id`, `buyer_id`, `seller_id`, `des`, `file`, `file_name`, `created_at`) VALUES
('dd36af201', 'e92e8273', 'customer11', 'designer33', 'This is first delivary', '7654ca43.jpg', 'hmgoepprod.jpg', '2022-04-25 07:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `gig`
--

CREATE TABLE `gig` (
  `gig_id` varchar(20) NOT NULL,
  `catagory` varchar(40) NOT NULL,
  `title` varchar(90) NOT NULL,
  `des` varchar(1100) NOT NULL,
  `img` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `d_date` int(5) NOT NULL,
  `order_count` int(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `owner_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gig`
--

INSERT INTO `gig` (`gig_id`, `catagory`, `title`, `des`, `img`, `price`, `d_date`, `order_count`, `created_at`, `owner_id`) VALUES
('a6dcc9f3', 'T-shirt', 'I will do shirt design', 'This is shirt design description', '445eac5e.jpg', 30, 4, 0, '2022-04-26 12:58:04', 4),
('b682b8ac', 'Tank top', 'I will do shirt design', 'This is shirt design description', 'fb8452e7.jpg', 60, 4, 0, '2022-04-25 07:52:56', 3);

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `job_id` varchar(10) NOT NULL,
  `category` varchar(40) NOT NULL,
  `des` varchar(5000) NOT NULL,
  `file` varchar(200) NOT NULL,
  `price` int(10) NOT NULL,
  `d_date` int(5) NOT NULL,
  `offered` int(10) NOT NULL,
  `hired` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `author_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`job_id`, `category`, `des`, `file`, `price`, `d_date`, `offered`, `hired`, `created_at`, `author_id`) VALUES
('f4ee80be', 'T-shirt', 'I am looking for someone who can design a  shirt. ', '', 30, 5, 2, '0', '2022-04-25 07:48:40', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(15) NOT NULL,
  `time` datetime NOT NULL,
  `sender_name` varchar(20) NOT NULL,
  `receiver_name` varchar(20) NOT NULL,
  `file` varchar(20) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `seen` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `time`, `sender_name`, `receiver_name`, `file`, `file_name`, `message`, `seen`) VALUES
(1, '2022-04-25 07:55:13', 'customer11', 'designer33', '', '', 'Hi,\r\n', '0');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` varchar(15) NOT NULL,
  `buyer_id` varchar(10) NOT NULL,
  `seller_id` varchar(10) NOT NULL,
  `gig_id` varchar(10) NOT NULL,
  `des` varchar(500) NOT NULL,
  `amount` int(8) NOT NULL,
  `d_date` int(8) NOT NULL,
  `status` enum('a','w','c') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `buyer_id`, `seller_id`, `gig_id`, `des`, `amount`, `d_date`, `status`, `created_at`) VALUES
('e92e8273', 'customer11', 'designer33', 'b682b8ac', 'I will design your shirt', 50, 3, 'c', '2022-04-25 07:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(10) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `des` varchar(1500) NOT NULL,
  `dob` datetime NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `avtar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `f_name`, `l_name`, `des`, `dob`, `address`, `city`, `country`, `avtar`) VALUES
(1, 'admin', ' ', '', '0000-00-00 00:00:00', '', '', '', ''),
(2, 'Customer', ' ', 'Hi,\r\nI am a customer.', '2022-03-29 00:00:00', 'Nekmard, Ranisankail, Thakurgaon 5121', 'Thakurgaon', 'Bangladesh', 'a975c6e5.jpg'),
(3, 'Designer', ' ', 'Hi,\r\nI am a designer', '2022-04-08 00:00:00', 'Nekmard, Ranisankail, Thakurgaon 5121', 'Thakurgaon', 'Bangladesh', '91fcc0f4.jpg'),
(4, 'designer44', ' ', '', '0000-00-00 00:00:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `send_offers`
--

CREATE TABLE `send_offers` (
  `offer_id` varchar(15) NOT NULL,
  `owner_id` varchar(10) NOT NULL,
  `job_id` varchar(10) NOT NULL,
  `gig_id` varchar(10) NOT NULL,
  `seller_uname` varchar(10) NOT NULL,
  `des` varchar(5000) NOT NULL,
  `price` int(10) NOT NULL,
  `d_date` int(5) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `send_offers`
--

INSERT INTO `send_offers` (`offer_id`, `owner_id`, `job_id`, `gig_id`, `seller_uname`, `des`, `price`, `d_date`, `created_at`) VALUES
('19092acc45', '2', 'f4ee80be', 'b682b8ac', 'designer33', 'Hi,\r\nI am really interested about your shirt design', 50, 4, '2022-04-25 07:53:48'),
('4c95f226c4', '2', 'f4ee80be', 'a6dcc9f3', 'designer44', 'I am interested about your shirt design', 40, 5, '2022-04-26 12:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `temp_order`
--

CREATE TABLE `temp_order` (
  `order_id` varchar(15) NOT NULL,
  `buyer_id` varchar(10) NOT NULL,
  `seller_id` varchar(10) NOT NULL,
  `gig_id` varchar(10) NOT NULL,
  `des` varchar(500) NOT NULL,
  `amount` int(8) NOT NULL,
  `d_date` int(8) NOT NULL,
  `status` enum('running','accepted','rejected') NOT NULL DEFAULT 'running',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_order`
--

INSERT INTO `temp_order` (`order_id`, `buyer_id`, `seller_id`, `gig_id`, `des`, `amount`, `d_date`, `status`, `created_at`) VALUES
('06fa60b29', 'customer11', 'designer33', 'b682b8ac', 'I will design your shirt', 50, 3, 'accepted', '2022-04-25 07:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) NOT NULL,
  `tran_id` varchar(20) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `status` enum('Completed','Pending','Failed') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tran_id`, `sender`, `receiver`, `amount`, `status`, `created_at`) VALUES
(1, '20406869GY3270229', 'customer11', 'e-fashion', 100, 'Completed', '2022-04-25 07:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `avtar` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` enum('1','2') NOT NULL,
  `priority` enum('none','buyer','seller') NOT NULL DEFAULT 'none',
  `user_status` enum('0','1') NOT NULL,
  `last_logout` varchar(30) NOT NULL,
  `account_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `avtar`, `email`, `user_pass`, `user_type`, `priority`, `user_status`, `last_logout`, `account_id`) VALUES
(1, 'admin', '', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1', 'none', '1', '', 1),
(2, 'customer11', 'a975c6e5.jpg', 'customer11@gmail.com', '3b712de48137572f3849aabd5666a4e3', '2', 'buyer', '1', '', 2),
(3, 'designer33', '91fcc0f4.jpg', 'designer33@gmail.com', '3b712de48137572f3849aabd5666a4e3', '2', 'seller', '1', '', 3),
(4, 'designer44', '', 'designer44@gmail.com', '3b712de48137572f3849aabd5666a4e3', '2', 'seller', '1', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `method` varchar(10) NOT NULL,
  `paypal` varchar(100) NOT NULL,
  `swift` varchar(20) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_no` int(20) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `status` enum('Pending','Completed','Rejected') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_name`, `amount`, `method`, `paypal`, `swift`, `account_name`, `account_no`, `msg`, `status`, `created_at`) VALUES
(1, 'designer33', 50, 'paypal', 'designer33@gmail.com', '', '', 0, 'Email Error', 'Rejected', '2022-04-25 07:59:24'),
(2, 'designer33', 10, 'paypal', 'sadfj@gmail.com', '', '', 0, 'Accepted', 'Completed', '2022-04-26 12:05:15'),
(3, 'designer33', 12, 'paypal', 'asdf@gmail.com', '', '', 0, 'Rejected', 'Rejected', '2022-04-26 12:05:38'),
(4, 'designer33', 13, 'paypal', 'df@gmail.com', '', '', 0, '', 'Pending', '2022-04-26 12:13:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `profile_id` (`profile_id`);

--
-- Indexes for table `delivaries`
--
ALTER TABLE `delivaries`
  ADD PRIMARY KEY (`delivary_id`);

--
-- Indexes for table `gig`
--
ALTER TABLE `gig`
  ADD PRIMARY KEY (`gig_id`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `send_offers`
--
ALTER TABLE `send_offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tran_id` (`tran_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `account_id` (`account_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
