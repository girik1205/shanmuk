-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 03:32 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shiva_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branchorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `phone`, `email`, `image_url`, `status`, `ctimestamp`, `branchorder`) VALUES
(1, 'branch1', '<p>3-24, Aryavatam, Gollapalem Post,<br></p><p>Kakinada - 533468.</p>', '9441244484', 'shannu135@gmail.com', 'uploads/source/-1518713314.jpg', 1, '2018-02-15 16:51:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seo_name` varchar(100) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `cat_type` int(1) NOT NULL COMMENT '0=>products,1=>services',
  `image_url` varchar(100) NOT NULL,
  `keep_home_page` int(1) NOT NULL,
  `keep_home_page_slider` int(1) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 => active',
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `seo_name`, `seo_keywords`, `seo_description`, `cat_type`, `image_url`, `keep_home_page`, `keep_home_page_slider`, `status`, `ctimestamp`) VALUES
(3, 'test5', 'test5', 'test1', 'test1', 0, 'uploads/source/-1518248943.jpg', 1, 1, 1, '2018-02-10 14:01:12'),
(4, 'test2', 'test2', 'test', 'test', 0, 'uploads/source/-1518246336.jpg', 1, 1, 1, '2018-02-10 14:01:19'),
(5, 'test4', 'test4', 'test', 'test', 0, 'uploads/source/-1518246986.jpg', 1, 1, 1, '2018-02-10 13:59:27'),
(6, 'test6', 'test6', 'test6', 'test6', 0, 'uploads/source/-1518248593.jpg', 1, 1, 1, '2018-02-10 07:43:13'),
(7, 'services', 'services', '<p><br></p>', '', 1, 'uploads/source/-1518632009.jpg', 1, 1, 1, '2018-02-14 18:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seo_name` varchar(100) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `cat_type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `offerprice` int(11) NOT NULL,
  `stockcount` int(11) NOT NULL,
  `thmbnail_url` varchar(100) NOT NULL,
  `thumbnil_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `seo_name`, `seo_keywords`, `seo_description`, `cat_type`, `price`, `offerprice`, `stockcount`, `thmbnail_url`, `thumbnil_id`, `status`, `ctimestamp`) VALUES
(1, 'p1', 'p1', 'p1', 'p1', 3, 520, 500, 9, '', 9, 1, '2018-02-14 18:25:25'),
(2, 'p2', 'p2', 'p2', 'p2', 3, 650, 600, 4, 'p2-1517943489.jpg', 2, 1, '2018-02-07 17:47:28'),
(3, 'test2-p1', 'test2-p1', '', '', 4, 120000, 1200, 22, '', 0, 1, '2018-02-10 13:25:46'),
(4, 'test2-p2', 'test2-p2', '', '', 4, 1500, 1500, 15, '', 0, 1, '2018-02-10 16:53:09'),
(5, 'test4-p1', '', '', '', 5, 1200, 1200, 12, '', 0, 1, '2018-02-10 13:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `status` int(11) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `service_id`, `url`, `status`, `ctimestamp`) VALUES
(2, 2, 0, 'p2-1517943489.jpg', 1, '2018-02-06 18:58:10'),
(3, 1, 0, 'p1-1517946132.jpg', 1, '2018-02-06 19:42:13'),
(4, 2, 0, 'p2-1518283551.jpg', 1, '2018-02-10 17:25:52'),
(5, 2, 0, 'p2-1518283562.jpg', 1, '2018-02-10 17:26:02'),
(6, 2, 0, 'p2-1518283575.jpg', 1, '2018-02-10 17:26:15'),
(7, 2, 0, 'p2-1518283684.jpg', 1, '2018-02-10 17:28:04'),
(8, 2, 0, 'p2-1518283698.jpg', 1, '2018-02-10 17:28:18'),
(10, 0, 1, 'service1-1518632693.jpg', 1, '2018-02-14 18:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seo_name` varchar(100) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `cat_type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `offerprice` int(11) NOT NULL,
  `stockcount` int(11) NOT NULL,
  `thmbnail_url` varchar(100) NOT NULL,
  `thumbnil_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `seo_name`, `seo_keywords`, `seo_description`, `cat_type`, `price`, `offerprice`, `stockcount`, `thmbnail_url`, `thumbnil_id`, `status`, `ctimestamp`) VALUES
(1, 'service1', 'servecr-1', 'ss', 'ss', 7, 0, 0, 20, 'service1-1518632693.jpg', 10, 1, '2018-02-14 18:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `slider_content`
--

CREATE TABLE `slider_content` (
  `id` int(11) NOT NULL,
  `welcome_text` varchar(100) NOT NULL,
  `main_text` varchar(100) NOT NULL,
  `sub_text` varchar(100) NOT NULL,
  `view_more_link` varchar(100) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_content`
--

INSERT INTO `slider_content` (`id`, `welcome_text`, `main_text`, `sub_text`, `view_more_link`, `ctimestamp`, `status`) VALUES
(1, 'welcome text', 'main text', 'sub text2', 'google,com', '2018-02-09 18:23:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `ctimestamp`, `status`) VALUES
(1, 'admin', 'shannu135@gmail.com', '1efaa944eb94dd4516aced7ee40fc40a', '2018-02-15 16:53:08', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_content`
--
ALTER TABLE `slider_content`
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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slider_content`
--
ALTER TABLE `slider_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
