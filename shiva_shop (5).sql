-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2018 at 03:29 AM
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
-- Table structure for table `alertemails`
--

CREATE TABLE `alertemails` (
  `id` int(11) NOT NULL,
  `emails` text NOT NULL,
  `action` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `timestap` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `branchorder` int(11) NOT NULL,
  `mainbranch` int(1) NOT NULL,
  `embaindmap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `phone`, `email`, `image_url`, `status`, `ctimestamp`, `branchorder`, `mainbranch`, `embaindmap`) VALUES
(1, 'branch1', '<p>3-24, Aryavatam, Gollapalem Post,<br></p><p>Kakinada - 533468.</p>', '9441244484', 'shannu135@gmail.com', 'uploads/source/-1518713314.jpg', 1, '2018-02-15 16:51:00', 0, 0, ''),
(2, 'branch2', '<p>branch 2&nbsp; &nbsp;</p>', '9874563213', 'shannu135@gmail.com', 'uploads/source/-1518931530.jpg', 1, '2018-02-18 05:25:30', 5, 0, ''),
(3, 'branch1', '<p>3-24, Aryavatam, Gollapalem Post,<br></p><p>Kakinada - 533468.</p>', '9441244484', 'shannu135@gmail.com', 'uploads/source/-1518713314.jpg', 1, '2018-02-15 16:51:00', 0, 0, ''),
(4, 'branch2', '<p>branch 2&nbsp; &nbsp;</p>', '9874563213', 'shannu135@gmail.com', 'uploads/source/-1518931530.jpg', 1, '2018-02-18 05:25:30', 5, 0, ''),
(9, 'main branch', '<p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p>main branch</p><p><br></p><p><br></p>', '9874563212', 'shannu135@gmail.com', 'uploads/source/-1518942447.jpg', 1, '2018-02-18 08:51:36', 0, 0, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1907.8207055351927!2d82.23948335555892!3d16.992179969767932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a3828491f391e05%3A0xc0f99a04298ef067!2sCartrade!5e0!3m2!1sen!2sin!4v1518941893071'),
(10, 'main barnch2', '<p style=\"color: rgb(51, 51, 51); background-color: rgb(245, 245, 245);\">3-24, Aryavatam, Gollapalem Post,<br></p><p style=\"color: rgb(51, 51, 51); background-color: rgb(245, 245, 245);\">Kakinada - 533468.</p>', '9874563214', 'shannu135@gmail.com', 'uploads/source/-1518942633.jpg', 0, '2018-02-18 09:01:42', 0, 1, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1907.8207055351927!2d82.23948335555892!3d16.992179969767932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a3828491f391e05%3A0xc0f99a04298ef067!2sCartrade!5e0!3m2!1sen!2sin!4v1518941893071');

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
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `readstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `name`, `email`, `phone`, `message`, `ctimestamp`, `status`, `readstatus`) VALUES
(1, '0', 'shannu135@gmail.com', '9874563212', 'tett', '2018-02-18 15:38:55', 0, 0),
(2, 'sairam', 'shannu135@gmail.com', '9874563212', 'tett', '2018-02-18 15:40:01', 1, 0),
(4, 'sairam', 'shannu135@gmail.com', '6013456668', 'stetes', '2018-02-18 17:25:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `prod_desc` text NOT NULL,
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

INSERT INTO `products` (`id`, `name`, `prod_desc`, `seo_name`, `seo_keywords`, `seo_description`, `cat_type`, `price`, `offerprice`, `stockcount`, `thmbnail_url`, `thumbnil_id`, `status`, `ctimestamp`) VALUES
(1, 'p1', '', 'p1', 'p1', 'p1', 3, 520, 500, 9, '', 9, 1, '2018-02-14 18:25:25'),
(2, 'p2', '<p><br></p><p>test</p><p><br></p><table class=\"table table-bordered\"><tbody><tr><td>1</td><td>2</td><td>3</td></tr><tr><td>4</td><td>5</td><td>6</td></tr><tr><td>7</td><td>8</td><td>9</td></tr></tbody></table><p style=\"text-align: center; \"><img src=\"data:image/jpeg;base64,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\" style=\"width: 50%; float: none;\" data-filename=\"Koala.jpg\"></p><p style=\"text-align: center; \">================== ================ ====== ========= ====== ============ ======= ======== ======== ========</p><p style=\"text-align: center; \"><br></p>', 'p2', 'p2', 'p2', 3, 650, 600, 4, 'p2-1517943489.jpg', 2, 1, '2018-02-18 13:04:34'),
(3, 'test2-p1', '', 'test2-p1', '', '', 4, 120000, 1200, 22, '', 0, 1, '2018-02-10 13:25:46'),
(4, 'test2-p2', '', 'test2-p2', '', '', 4, 1500, 1500, 15, '', 0, 1, '2018-02-10 16:53:09'),
(5, 'test4-p1', '', '', '', '', 5, 1200, 1200, 12, '', 0, 1, '2018-02-10 13:28:50');

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
(10, 0, 1, 'service1-1518632693.jpg', 1, '2018-02-14 18:24:53'),
(14, 2, 0, 'p2-1518959529.jpg', 1, '2018-02-18 13:12:11'),
(15, 2, 0, 'p2-1518959541.jpg', 1, '2018-02-18 13:12:22'),
(18, 2, 0, 'p2-1518959837.jpg', 1, '2018-02-18 13:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_enq`
--

CREATE TABLE `product_enq` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `quantity` int(4) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `readstatus` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_enq`
--

INSERT INTO `product_enq` (`id`, `name`, `email`, `phone`, `quantity`, `product_id`, `status`, `readstatus`, `timestamp`) VALUES
(1, '9874563210', '', '', 0, 0, 1, 0, '2018-02-18 16:02:02'),
(2, 'test2', 'shannu135@gmail.com', '9874563212', 0, 2, 1, 0, '2018-02-18 16:04:26'),
(3, 'sairam', 'k@sh.com', '124577899', 0, 2, 1, 0, '2018-02-18 17:22:01');

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
-- Indexes for table `alertemails`
--
ALTER TABLE `alertemails`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
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
-- Indexes for table `product_enq`
--
ALTER TABLE `product_enq`
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
-- AUTO_INCREMENT for table `alertemails`
--
ALTER TABLE `alertemails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product_enq`
--
ALTER TABLE `product_enq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
