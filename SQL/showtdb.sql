-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 09:57 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `showtdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'HP'),
(2, 'Apple'),
(3, 'ASUS'),
(4, 'Acer'),
(5, 'Compaq'),
(7, 'Google'),
(8, 'Lenovo'),
(9, 'IBM'),
(10, 'Alienware'),
(11, 'Sony'),
(12, 'Toshiba'),
(13, 'Microsoft'),
(14, 'Intel'),
(15, 'LG'),
(16, 'MSI'),
(17, 'Razer'),
(18, 'DELL'),
(19, 'Samsung'),
(20, 'Cisco'),
(21, 'Amazon'),
(22, 'Oracle');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expiration_date`, `paid`) VALUES
(2, '[{"id":"15","size":"21.5-inch","quantity":"2"},{"id":"9","size":"4.7 inch","quantity":"1"}]', '2017-04-15 18:28:12', 0),
(3, '[{"id":"18","size":"5 inch","quantity":4},{"id":"9","size":"4.7 inch","quantity":"1"}]', '2017-04-19 15:42:20', 0),
(4, '[{"id":"19","size":"14 inch","quantity":"34"}]', '2017-08-17 22:25:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Computer and Office', 0),
(2, 'Phones and Accessories', 0),
(3, 'Tablets', 1),
(4, 'Laptops', 1),
(5, 'PC', 1),
(6, 'Office Electronics', 1),
(7, 'Tablet and Laptop Accessories', 1),
(8, 'Mobile Phones', 2),
(9, 'Phone Bags and Cases', 2),
(10, 'Mobile Phone Accessories', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`, `user`, `views`) VALUES
(8, 'NX.MN3SP.001', '300.00', '350.00', 4, '4', '/showtech/images/products/840d9aab6d478434f68a7f25f866ff3a.jpg', 'OS Windows 8 Single Language.\r\nCPU Intel&reg; Core&trade; i5-4210U processor 1.70 GHz.\r\nDisplay 35.6 cm (14&quot;) HD (1366 x 768) 16:9 CineCrystal.\r\nGraphic Nvidia&reg; GeForce&reg; 820M with 2 GB Dedicated Memory.\r\nRAM 4 GB, DDR3L SDRAM.\r\nDisk 1 TB HDD.', 1, '15.6inch:8', 0, 2, 2),
(9, 'iPhone 7', '600.00', '650.00', 2, '8', '/showtech/images/products/f460afc096a5a3895abe73dfa7b7aa61.jpg', 'iOS 10.0.1, up to iOS 10.2\r\n32/128/256GB storage, no card slot\r\n4.7&quot; 750x1334 pixels\r\n12MP 2160p\r\n2GB RAM Apple A10 Fusion\r\n1960mAh Li-Ion', 1, '4.7 inch:8', 0, 2, 2),
(10, 'Galaxy S7', '500.00', '550.00', 19, '8', '/showtech/images/products/53e8e42bf1114818fe4a39272bbc3529.jpg', 'Android OS, v6.0, up to v7.0\r\n32/64GB storage, microSD card slot\r\n5.1&quot; 1440x2560 pixels\r\n12MP 2160p\r\n4GB RAM Exynos 8890 Octa\r\n3000mAh Li-Ion', 0, '5.1inch:5', 0, 2, 2),
(12, 'NP900X3A', '400.00', '450.00', 19, '4', '/showtech/images/products/f876227add495282eee4f1d57239312e.jpg', '128 GB Solid State Drive. Accessible capacity varies; MB = 1 million bytes, GB = 1 billion bytes, TB = 1 trillion bytes. ...\r\n3 W Stereo Speaker (1.5 W x 2) with HD Audio. ...\r\n1.3 MP HD Webcam. ...\r\n802.11 b/g/n WiFi. ...\r\n2 USB Ports (1 Chargeable)', 0, '15.6 inch:2', 1, 2, 3),
(14, '14-d008au', '200.00', '240.00', 1, '4', '/showtech/images/products/73030c5304481a616be68500aefa81d0.jpg', 'Product Name	HP 14-d008au Notebook PC\r\nMicroprocessor	1 GHz AMD Dual-Core E1-2100 APU with Radeon HD 8210 Graphics\r\nMicroprocessor Cache	1 MB cache\r\nMemory	2 GB 1600 MHz DDR3L SDRAM (1 x 2 GB)\r\nVideo Graphics	AMD Radeon HD 8210 Graphics', 0, '15.6inch:5', 1, 3, 4),
(15, 'iMac', '1200.00', '1300.00', 2, '5', '/showtech/images/products/6ec177c9aa37fa0874b3801979ead004.jpg', 'Processor: Dual-core 1.6GHz Intel Core i5-5250U,\r\n RAM: 8GB, Front USB ports : None,\r\n Rear USB ports: 4x USB3,\r\n Total storage: 1TB hard disk,\r\n Graphics card: Intel HD Graphics 6000,\r\n Display: 21.5in built-in glossy,\r\n Operating system: Apple OS X El Capitan', 1, '21.5-inch:5', 0, 3, 5),
(16, 'MacBook Pro 2016', '1000.00', '1200.00', 2, '4', '/showtech/images/products/7e93becb92dabe7f47cc488502b51bc7.jpg', 'Category 13-inch MacBook Pro\r\nProcessor 2.0GHz dual-core Intel Core i5\r\nStorage 256GB SSD\r\nMemory 8GB\r\nGraphics Intel Graphics 540\r\n', 1, '13inch:5', 0, 3, 10),
(17, 'ZenFone 3 Max', '120.00', '300.00', 3, '8', '/showtech/images/products/ad5c05d58fa73db2f727a56cf8065a3d.jpg', 'Display: 5.00-inch\r\nProcessor: 1.3GHz quad-core\r\nFront Camera: 2-megapixel\r\nResolution: 720x1280 pixels\r\nRAM: 2GB\r\nOS: Android 5.1\r\nStorage: 16GB\r\nRear Camera: 8-megapixel\r\nBattery Capacity: 2070mAh', 1, '5 inch:4', 1, 3, 7),
(18, 'ZenFone 3 Max', '250.00', '300.00', 3, '8', '/showtech/images/products/c065a04733626afa5750114ab8f9dedb.jpg', 'Display: 5.00-inch\r\nProcessor: 1.3GHz quad-core\r\nFront Camera: 2-megapixel\r\nResolution: 720x1280 pixels\r\nRAM: 2GB\r\nOS: Android 5.1\r\nStorage: 16GB\r\nRear Camera: 8-megapixel\r\nBattery Capacity: 2070mAh', 1, '5 inch:4', 0, 3, 10),
(19, 'ZenBook 3 Deluxe', '400.00', '480.00', 3, '4', '/showtech/images/products/c2fe3f20196e315ef004cf6233b12045.jpg', 'CPU 7th. generation Intel&reg; Core&trade; i5-7200/i7-7500\r\nAudio 4 high quality stereo speakers Harman/Kardon audio system\r\nBattery	46 Wh lithium polymer battery (up to 10 hours)\r\nDimensions 329.6 x 214 x 12.9 mm\r\nWeight 1.1 kg', 0, '14 inch:5', 0, 3, 10),
(20, 'vdsds', '215.00', '3243.00', 10, '6', '/showtech/images/products/077bc4f9c8e41210e8d80ed870a3dea4.jpg', 'dvcsvsd\r\nds\r\ncvdsv\r\n\r\nsd\r\ncs\r\n', 0, 'ffdfd:1', 1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `date`, `last_login`, `permissions`) VALUES
(1, 'Administrator', 'admin@root.com', '$2y$10$ehJjLevZF4S9DHRcDHzTU.ktJo/dXmpXyShObNnamkTwx0UfWfNKK', '2017-03-03 13:13:37', '2017-07-18 21:54:38', 'admin,editor'),
(2, 'User', 'user@usr.com', '$2y$10$5mnROqmoYsq35v62vU1zieOvCyu0Evt9PRCaw2PxjEe0KawGu0L0e', '2017-03-06 18:26:35', '2017-03-08 16:56:54', 'editor,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`) COMMENT 'id_b', ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`) COMMENT 'cart_id', ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) COMMENT 'id_c', ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) COMMENT 'id_p', ADD KEY `id` (`id`), ADD KEY `brand` (`brand`), ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) COMMENT 'id_u', ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
