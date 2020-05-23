-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2020 at 03:20 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hadnett_glich`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `status`, `total`) VALUES
(17, 4, '2019-12-08 20:31:28', '1', 0),
(18, 4, '2019-12-08 20:39:24', '1', 0),
(19, 4, '2019-12-08 20:48:10', '1', 0),
(20, 4, '2019-12-08 21:21:26', '1', 0),
(21, 4, '2019-12-08 21:28:17', '1', 0),
(22, 4, '2019-12-08 21:33:43', '1', 0),
(23, 4, '2019-12-08 22:21:44', '1', 0),
(24, 4, '2019-12-08 22:46:24', '1', 0),
(25, 3, '2019-12-08 23:09:24', '1', 0),
(26, 3, '2019-12-08 23:09:59', '0', 0),
(27, 4, '2019-12-09 09:09:15', '1', 0),
(28, 4, '2019-12-09 09:13:12', '1', 0),
(29, 4, '2019-12-09 09:23:44', '1', 0),
(30, 4, '2019-12-09 09:37:42', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_from_suppliers`
--

CREATE TABLE `orders_from_suppliers` (
  `id_order_from_supplier` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_from_suppliers`
--

INSERT INTO `orders_from_suppliers` (`id_order_from_supplier`, `date`, `total`, `supplier_id`) VALUES
(1, '2020-04-29 21:09:42', 1865650, 1),
(2, '2020-04-29 21:09:42', 5782.55, 1),
(3, '2020-04-29 21:09:42', 8894760, 2),
(4, '2020-04-29 21:09:42', 565.05, 3),
(5, '2020-04-29 21:09:42', 7162, 4),
(6, '2020-04-29 21:09:42', 1862.5, 5),
(7, '2020-04-29 21:09:43', 9875220, 5),
(8, '2020-05-06 23:35:25', 300, 1),
(9, '2020-05-07 02:02:42', 6000.05, 7),
(10, '2020-05-07 02:06:59', 633.21, 4),
(11, '2020-05-07 02:07:21', 1555.53, 6),
(12, '2020-05-07 02:08:48', 198, 9),
(13, '2020-05-07 02:09:41', 198.88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

CREATE TABLE `order_lines` (
  `order_lines_id` int(6) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`order_lines_id`, `order_id`, `product_id`, `quantity`) VALUES
(69, 17, 7, 1),
(70, 18, 11, 1),
(71, 18, 7, 1),
(72, 19, 6, 2),
(73, 19, 11, 1),
(74, 20, 6, 2),
(75, 20, 9, 1),
(76, 21, 9, 1),
(77, 22, 7, 1),
(78, 23, 6, 1),
(80, 25, 8, 1),
(82, 24, 17, 1),
(83, 27, 12, 1),
(84, 27, 17, 1),
(85, 28, 17, 1),
(86, 29, 12, 1),
(87, 30, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

CREATE TABLE `pending_users` (
  `token` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accessLevel` int(6) NOT NULL,
  `expiry_time_stamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_users`
--

INSERT INTO `pending_users` (`token`, `email`, `name`, `password`, `accessLevel`, `expiry_time_stamp`) VALUES
('7ff6c1fe604a9efe06fe32160c0dca3c151bed08', 'd00217017@student.dkit.ie', 'moey', '$2y$10$4RoM8aJRc/gmLrShaqbr/u4d3y5iV5jeGc2tIGGg9WDrJ.z0J/nQS', 1, 1588815943);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(6) UNSIGNED NOT NULL,
  `product_name` varchar(55) NOT NULL,
  `category` varchar(55) NOT NULL,
  `brand` varchar(55) DEFAULT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `availability` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category`, `brand`, `product_image`, `price`, `description`, `availability`) VALUES
(6, 'Iphone 8', 'Phone', 'Iphone', 'images/product_iphone8.jpg', 543.99, 'Retina HD display 4.7-inch diagonal widescreen LCD Multi-Touch display with IPS technology 1334x750-pixel resolution at 326 ppi.', 10),
(7, 'Iphone 8PLus', 'Phone', 'Iphone', 'images/product_iphone8Plus.jpg', 669.99, 'Retina HD display 5.5-inch diagonal widescreen LCD Multi-Touch display with IPS technology 1920x1080-pixel resolution at 401 ppi 1300:1 contrast ratio typical.', 4),
(8, 'Iphone 11', 'Phone', 'Iphone', 'images/product_iphone11.jpg', 829.99, 'The new Wide sensor has 100 per cent Focus Pixels for up to three times faster autofocus in low light. Capturing four times more scene, it is great for landscapes, travel, groups, large interiors and action shots.', 32),
(9, 'Huawei p20', 'Phone', 'Huawei', 'images/product_p20.png', 549.99, 'Experience the power of AI with the Kirin 970 Neural Network Processing Unit. With outstanding battery life and superior speed, it is a leap forward for the P series.', 27),
(10, 'Huawei p20Pro', 'Phone', 'Huawei', 'images/product_p20Pro.png', 749.99, 'The Huawei P20 Pro\'s 5X Hybrid Zoom means that if you want to capture more detail from a distance, now you can. Bring your subject closer, without compromising image quality.', 33),
(11, 'Huawei p20Lite', 'Phone', 'Huawei', 'images/product_p20Lite.png', 280.99, 'Images that amaze.16MP Dual Camera, incredible all-glass design and vibrant FHD+ display.', 24),
(12, 'P30', 'Phone', 'Huawei', 'images/product_p30.jpg', 599.99, 'Featuring a revolutionary Leica camera system powered by Artificial Intelligence. Incredible photographs even in super low light conditions.', 9),
(13, 'Huawei P30Pro', 'Phone', 'Huawei', 'images/product_p30.jpg', 749.99, '6.47-inch curved OLED screen, Leica Quad Camera System 40MP + 20MP + 8MP + TOF sensor, 32MP selfie camera, Kirin 980 octa-core processor, 8GB RAM, 128GB internal storage, In-screen fingerprint reader', 33),
(14, 'SAMSUNG GALAXY S10', 'Phone', 'Samsung', 'images/product_s10.jpg', 880.99, ' Featuring an Infinity-O display, Wireless Power Sharing and Samsung\'s TrueVision camera system. The Galaxy S10 also features an in-screen ultrasonic fingerprint scanner to keep your phone secure.', 35),
(15, 'SAMSUNG GALAXY S10e', 'Phone', 'Samsung', 'images/product_s10.jpg', 699.99, 'Featuring an Infinity-O display, Wireless Power Sharing and Samsung\'s TrueVision camera system. The Galaxy S10e packs all the latest technology into a compact design to fit perfectly into your life.', 35),
(16, 'SAMSUNG GALAXY S10+', 'Phone', 'Samsung', 'images/product_s10.jpg', 999.99, ' Featuring an Infinity-O display, Wireless Power Sharing and Samsung\'s TrueVision camera system. The Galaxy S10+ also features an in-screen ultrasonic fingerprint scanner to keep your phone secure.', 35),
(17, 'AirPodsPro', 'Accessory', 'Apple', 'images/product_airpodsPro.png', 279.99, 'Up to 5 hours of listening time on one charge 4, More than 24 hours of listening time with Charging Case 5 Standard Charging Case, Free personalised engraving', 31),
(18, 'Huawei SuperCharge Wireless Car Charges ', 'Accessory', 'Huawei', 'images/product_carCharge.png', 229.00, 'The 27W (Max) Wireless HUAWEI SuperCharge makes it possible to refuel the battery at the groundbreaking speed. Free you from the tangle of wires and low battery anxiety.', 35),
(19, 'Huawei Watch GT 2', 'Accessory', 'Huawei', 'images/product_huaweiWatchGt.jpg', 200.00, '【HUAWEI Kirin A1 Self-developed Chip】This new smart watch comes with HUAWEI\'s self-developed wearable chip Kirin A1, and intelligent power saving technology to provide up to 2 WEEKS of Battery Life.', 35),
(20, 'Samsung Galaxy Bud', 'Accessory', 'Samsung', 'images/product_galaxyBug.jpg', 119.00, 'Just pop open and pair. Galaxy Buds work right out of the box, connecting with your Galaxy devices in an instant via Bluetooth to get you up to the beat and well on your way.', 35);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `company_name` varchar(55) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `company_name`, `phone_number`, `email`, `location`) VALUES
(1, 'Apple', '0833736549', 'apple@mail.com', 'USA'),
(2, 'Samsung', '0836678549', 'samsung@mail.com', 'KOREA'),
(3, 'Huawei', '083312349', 'huawei@mail.com', 'CHINA'),
(4, 'Sony', '083316549', 'sony@mail.com', 'UK'),
(5, 'HTC', '0833736549', 'htc@mail.com', 'CHINA'),
(6, 'Google', '07896532548', 'google@gmail.com', 'Dublin'),
(7, '32r2', 'r32', 'd00217017@student.dkit.ie', 'USA'),
(8, '4r24', 'r2r2', 'jingsheng1017@hotmail.com', '24ior'),
(9, 'One Plus', '265116616', 'admin@gmail.com', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `access_level` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `access_level`) VALUES
(3, 'James Oliver', 'james@oliver.com', '1a3ca6f5673fbdfd3643b0de7669ef942e98d3c5b41292f78e559a0510d744dd2babcfc555266c3c22516293c24ecfd3a4c74ac7e605aa46b04150cd4b0e1832', 2),
(4, 'William Hadnett', 'william@gmail.com', '$2y$10$kqi03UuuTpi9c/PJhMNSqeXa/CO392gpJojePm0ruTONaTrJKnAja', 1),
(12, 'Aaron', 'aaron@gmail.com', '$2y$10$YNZLg1Cl5.uPAbZyi//kduX5ITAGHzSNAa4/QCvDE2H28kZ6.KJze', 2),
(14, 'Zoe Clarke', 'zoe@gmail.com', '$2y$10$epFysyNod5NUXzWWg7Y0fuoekXQWPSlRuBzKOCNOrjleS4GuNJkvS', 2),
(15, 'Peter Jones', 'peter@jones.com', '$2y$10$j11BV/XppuQytkunR68dRu0yKMR4L8OVUwMFMHAQwlvl4fuHL535S', 2),
(16, 'Jack Black', 'black@white.com', '$2y$10$r9yTC0UYKnbR7VB8ODhsWOmuvSqOs20ndIDHXQF2a.7mmHNtE.QRm', 1),
(22, 'William', 'williamsrhadnett@outlook.com', '$2y$10$xBPjM2kqY0tWt9pK9ZJhge0uZFRK.POrQ5y9.hbQI/2gjPis2NUhy', 1),
(23, 'Jack Jack', 'hadnett@hotmail.co.uk', '$2y$10$aMrnEzkhVaiUYaFnnGagjuRuXaDLUgFH9Cb66OjWDODZXTKTmJBt2', 1),
(24, 'moey', 'jingsheng1017@hotmail.com', '$2y$10$QqIOj.qa4wZ4/QftHPNDwOxg/QOrIALkkPwfSmC8kpdA6DnQjzYya', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_from_suppliers`
--
ALTER TABLE `orders_from_suppliers`
  ADD PRIMARY KEY (`id_order_from_supplier`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`order_lines_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders_from_suppliers`
--
ALTER TABLE `orders_from_suppliers`
  MODIFY `id_order_from_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `order_lines_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_from_suppliers`
--
ALTER TABLE `orders_from_suppliers`
  ADD CONSTRAINT `orders_from_suppliers_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD CONSTRAINT `order_lines_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_lines_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
