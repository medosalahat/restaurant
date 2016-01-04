-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2015 at 08:29 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_in` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `id_user`, `name`, `status`, `date_in`) VALUES
(1, 1, 'رسم', 1, '2015-12-20 07:31:05'),
(2, 1, 'مقال', 1, '2015-12-20 07:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `short_name` text NOT NULL,
  `description` text NOT NULL,
  `date_in` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `id_user`, `name`, `short_name`, `description`, `date_in`, `status`) VALUES
(1, 1, 'الآردن -1', 'الآردن  - 2', 'الآردن - 3', '2015-12-16 08:06:32', 1),
(3, 1, 'ايطاليا', 'ايطاليا', 'اكلات ايطاليه ', '2015-12-19 04:29:03', 1),
(4, 1, 'لبنان', 'لبنان', 'اكلات لبنانيه', '2015-12-19 04:36:06', 1),
(5, 1, 'ghjkl;', 'ghjkl;', 'fghjkl;', '2015-12-22 17:37:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `full_address` text NOT NULL,
  `path_image` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `id_user`, `f_name`, `l_name`, `email`, `username`, `password`, `phone`, `mobile`, `address`, `full_address`, `path_image`, `date_in`, `ip`, `status`) VALUES
(2, 1, 'محمد', 'القريوتي ', 'm.q.q@yahoo.com', 'محمد', 'b3c5416a2d60758d9d717ba18c723bb2', '0798981496', '0798981496', 'amman - jordan ', 'tabrbour - amman - jordan - tareq', 'include/img/customer/_621e756df8342cd0a4e3a52f26c1f510.jpg', '2015-12-19 12:21:30', '', 1),
(3, 1, 'محمود', 'سعاد', 'm1221@hotmail.com', 'محمود', '962af86c0a314aa407f50e9e271e6eed', '0797770505', '0777854566', 'amman', 'jordan.amman', 'include/img/customer/_8b5040a8a5baf3e0e67386c2e3a9b903.jpg', '2015-12-19 03:23:55', '', 0),
(11, 1, 'محمد ', 'صلاحات', 'msalahat88@gmail.com', 'msalahat88', 'ebc53f09050bf52fa515a5035ccc551e', '0798981496', '0798981496', 'الأردن - عمان ', 'جبل اللويبدة - شارع الباعونية', 'include/img/customer/user_default.png', '2015-12-21 20:44:13', '', 1),
(12, 1, 'fghjkl;', 'swdfghjkl;', 'msalahhjklat88@gmail.com', 'msalahat87', '6f6cf958f5eede54ecf1b0e6e73efa38', '234567890', '567890-', 'wertyuiop', 'sdfghjkl;', 'include/img/customer/user_default.png', '2015-12-23 01:30:15', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `id` int(11) NOT NULL,
  `id_section_food` int(11) NOT NULL,
  `name` text NOT NULL,
  `short_name` text NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `home_page` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `id_section_food`, `name`, `short_name`, `price`, `description`, `date_in`, `id_user`, `status`, `home_page`) VALUES
(2, 1, 'وجبة لحم خاروف', 'وجبة لحم خاروف مع رز', '2.5', 'وجبة لحم خاروف مع رز مع زيت الزيتون ', '2015-12-23 01:34:40', 1, 0, 1),
(3, 3, 'بيتزا بيروني ', 'بيروني ', ' 5.90', 'بيتزا مع قطع البيروني', '2015-12-19 12:40:58', 1, 1, 0),
(4, 4, 'كبه لبنيه', 'كبه لبنيه ', '6.00', 'كبه لبنيه	', '2015-12-19 12:40:59', 1, 1, 0),
(5, 4, 'كبه لبنيه', 'كبه لبنيه ', '6.00', 'كبه لبنيه	', '2015-12-23 01:34:38', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_food`
--

CREATE TABLE IF NOT EXISTS `image_food` (
  `id` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `path_image` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_food`
--

INSERT INTO `image_food` (`id`, `id_food`, `id_user`, `path_image`, `title`, `description`, `date_in`, `status`) VALUES
(1, 2, 1, 'include/img/image_food/_417d83fb3c862e79c67e1e20fa6fe9d3.jpg', '1', '2', '2015-12-19 03:35:23', 1),
(3, 3, 1, 'include/img/image_food/_377faedea2514f3c2cf371e141005d3c.jpg', 'بيروني ', 'بيروني ', '2015-12-19 12:34:19', 0),
(4, 4, 1, 'include/img/image_food/_dd458505749b2941217ddd59394240e8.jpg', 'كبه لبنيه', 'كبه لبنيه ', '2015-12-19 12:38:35', 0),
(5, 2, 1, 'include/img/image_food/_417d83fb3c862e79c67e1e20fa6fe9d3.jpg', '1', '2', '2015-12-19 03:35:23', 1),
(6, 3, 1, 'include/img/image_food/_377faedea2514f3c2cf371e141005d3c.jpg', 'بيروني ', 'بيروني ', '2015-12-19 12:34:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_customer`
--

CREATE TABLE IF NOT EXISTS `order_customer` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date_delivery` date NOT NULL,
  `time_delivery` time NOT NULL,
  `id_status_oder` int(11) NOT NULL,
  `id_shipping` int(11) NOT NULL,
  `date_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `new_order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_customer`
--

INSERT INTO `order_customer` (`id`, `id_customer`, `date_delivery`, `time_delivery`, `id_status_oder`, `id_shipping`, `date_in`, `id_user`, `new_order`) VALUES
(8, 11, '2015-12-26', '11:11:00', 5, 1, '2015-12-22 17:39:00', 1, 0),
(9, 11, '2015-12-01', '12:59:00', 2, 2, '2015-12-22 08:46:36', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `id_user`, `id_order`, `id_food`, `qty`, `date_in`) VALUES
(7, 1, 8, 5, 5, '2015-12-22 17:39:26'),
(8, 1, 8, 2, 13, '2015-12-22 00:09:24'),
(9, 1, 9, 4, 6, '2015-12-22 17:46:24'),
(10, 1, 9, 5, 2, '2015-12-22 17:46:24'),
(11, 1, 9, 3, 3, '2015-12-22 17:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `image_path` text NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `id_user`, `image_path`, `name`, `url`, `date_in`, `status`) VALUES
(1, 1, 'include/img/partners/20.jpg', '1231231231231231231', 'http://wwww.google.com', '2015-12-20 06:57:51', 1),
(2, 1, 'include/img/partners/19.jpg', '1231231231231231231', 'http://wwww.google.com', '2015-12-20 06:57:51', 1),
(3, 1, 'include/img/partners/19.jpg', '1231231231231231231', 'http://wwww.google.com', '2015-12-20 06:57:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image_path` text NOT NULL,
  `status` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `icon` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `id_category`, `id_user`, `title`, `description`, `image_path`, `status`, `service`, `icon`, `date_in`) VALUES
(1, 1, 1, 'Sucess Story', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'include/img/post/_ee50567c32d7c2e693df4a6206c71b00.jpg', 0, 1, 'include/site/images/icon1.png', '2015-12-23 01:41:00'),
(2, 1, 1, 'Sucess Story2', 'Lorem ipsum dolor sit amet, consectetur 2adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'include/site/images/8.jpg', 0, 0, 'include/site/images/icon2.png', '2015-12-23 00:35:57'),
(3, 1, 1, 'Sucess Story2', 'Lorem ipsum dolor sit amet, consectetur 2adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'include/site/images/8.jpg', 0, 1, 'include/site/images/icon3.png', '2015-12-23 00:35:37'),
(4, 1, 1, '123123123', 'Lorem ipsum dolor sit amet, consectetur 2adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'include/site/images/8.jpg', 1, 0, 'include/site/images/icon3.png', '2015-12-21 21:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `section_food`
--

CREATE TABLE IF NOT EXISTS `section_food` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `path_image` text NOT NULL,
  `date_in` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section_food`
--

INSERT INTO `section_food` (`id`, `id_user`, `id_country`, `name`, `short_name`, `description`, `path_image`, `date_in`, `status`) VALUES
(1, 1, 1, 'لحم', 'لحم مقدد', 'لحم مقدد', 'include/img/section_food/_b38cefb6fea247c75f5e6b9e0060a178.jpg', '2015-12-16 08:04:19', 1),
(3, 1, 3, 'بيتزا ', 'بيتزا ', 'بيتزا', '', '2015-12-19 04:40:49', 1),
(4, 1, 4, 'كبه', 'كبه', 'كبه', '', '2015-12-19 04:40:53', 1),
(5, 1, 1, 'bnk/', 'vhjkl;''', 'fghjkl;''', '', '2015-12-22 17:36:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_type`
--

CREATE TABLE IF NOT EXISTS `shipping_type` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` varchar(100) NOT NULL,
  `date_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_type`
--

INSERT INTO `shipping_type` (`id`, `id_user`, `name`, `price`, `date_in`, `status`) VALUES
(1, 1, 'توصيل  - داخل عمان', '3.00', '2015-12-16 19:25:04', 1),
(2, 1, 'توصيل - خارج عمان ', '5.00', '2015-12-16 19:24:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image_path` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `image_path`, `date_in`, `status`, `id_user`) VALUES
(2, '1', '3', 'include/img/slider/_54f8dc01623f2db3e3bf5603ab87535a.jpg', '2015-12-23 01:43:49', 0, 1),
(3, '1', '3', 'include/img/slider/_54f8dc01623f2db3e3bf5603ab87535a.jpg', '2015-12-18 12:36:35', 1, 1),
(4, '2', '2', 'include/img/slider/_f691ead601631590e70a47def3ad8f3a.jpg', '2015-12-20 15:27:22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status_order`
--

CREATE TABLE IF NOT EXISTS `status_order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_order`
--

INSERT INTO `status_order` (`id`, `id_user`, `name`, `date_in`, `status`) VALUES
(1, 1, 'تم التجهيز', '2015-12-16 18:45:24', 1),
(2, 1, 'في الأنتظار', '2015-12-16 18:45:12', 1),
(3, 1, 'تحت الموافقة', '2015-12-16 18:45:05', 1),
(4, 1, 'قيد الأنتظار', '2015-12-16 18:45:42', 1),
(5, 1, 'جاري التسليم', '2015-12-16 18:45:51', 1),
(6, 1, 'تم الرفض', '2015-12-16 18:46:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_site`
--

CREATE TABLE IF NOT EXISTS `user_site` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `path_image` text NOT NULL,
  `date_in` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_site`
--

INSERT INTO `user_site` (`id`, `username`, `name`, `password`, `path_image`, `date_in`, `status`) VALUES
(1, 'admin', 'سامي أحمد ', 'fa5d0f40a8de21d50334298e900bbff4', 'include/img/user_site/_6060d12ec4413d29a17e7584783c23be.jpg', '2015-12-16 22:59:44', 1),
(3, 'moh', 'محمد ابو جبل ', 'fa5d0f40a8de21d50334298e900bbff4', '', '2015-12-19 04:26:12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_section_food` (`id_section_food`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_section_food_2` (`id_section_food`);

--
-- Indexes for table `image_food`
--
ALTER TABLE `image_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_food` (`id_food`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_status_oder` (`id_status_oder`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_shipping` (`id_shipping`),
  ADD KEY `id_status_oder_2` (`id_status_oder`),
  ADD KEY `id_customer_2` (`id_customer`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_food` (`id_food`),
  ADD KEY `id_order_2` (`id_order`),
  ADD KEY `id_food_2` (`id_food`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `section_food`
--
ALTER TABLE `section_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_country` (`id_country`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_country_2` (`id_country`),
  ADD KEY `id_user_2` (`id_user`),
  ADD KEY `id_country_3` (`id_country`);

--
-- Indexes for table `shipping_type`
--
ALTER TABLE `shipping_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `status_order`
--
ALTER TABLE `status_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_site`
--
ALTER TABLE `user_site`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `image_food`
--
ALTER TABLE `image_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_customer`
--
ALTER TABLE `order_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `section_food`
--
ALTER TABLE `section_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shipping_type`
--
ALTER TABLE `shipping_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status_order`
--
ALTER TABLE `status_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_site`
--
ALTER TABLE `user_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `country_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`),
  ADD CONSTRAINT `food_ibfk_2` FOREIGN KEY (`id_section_food`) REFERENCES `section_food` (`id`);

--
-- Constraints for table `image_food`
--
ALTER TABLE `image_food`
  ADD CONSTRAINT `image_food_ibfk_1` FOREIGN KEY (`id_food`) REFERENCES `food` (`id`),
  ADD CONSTRAINT `image_food_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `order_customer`
--
ALTER TABLE `order_customer`
  ADD CONSTRAINT `order_customer_ibfk_2` FOREIGN KEY (`id_status_oder`) REFERENCES `status_order` (`id`),
  ADD CONSTRAINT `order_customer_ibfk_3` FOREIGN KEY (`id_shipping`) REFERENCES `shipping_type` (`id`),
  ADD CONSTRAINT `order_customer_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order_customer` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`id_food`) REFERENCES `food` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `partners_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `section_food`
--
ALTER TABLE `section_food`
  ADD CONSTRAINT `section_food_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `section_food_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `shipping_type`
--
ALTER TABLE `shipping_type`
  ADD CONSTRAINT `shipping_type_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

--
-- Constraints for table `status_order`
--
ALTER TABLE `status_order`
  ADD CONSTRAINT `status_order_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_site` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
