-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 09:22 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commerce1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dstatus` varchar(10) NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `dstatus`, `odate`, `ddate`) VALUES
(31, 24, 10, 1, 'tehran', '09123456789', 'Yes', '2021-12-24', '2021-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--
INSERT INTO `products` (`id`, `pName`, `price`, `description`, `available`, `category`, `type`, `item`, `pCode`, `picture`) VALUES
(3, 'Cpu', 35000, 'CPU parts (modified)', 1, 'women', 'CPU', 'computers', 'SR002', 'download.jpg'),
(4, 'Keyboard', 1200, 'Keyboard (modified)', 1, 'women', 'Keyboard', 'computers', 'SR002', 'C'),
(5, 'Mouse', 1200, 'mouse (modified)', 1, 'women', 'mouse', 'computers', 'SR002', 'download (2).jpg'),
(6, 'Olfu fatima CSS Id', 2000, 'OLFU FATIMA ID (Modified)', 1, 'women', 'Olfu Fatima ID', 'IdLace', 'SR002', '310040171_10226580154722409_1569060704006703377_n.jpg'),
(7, 'asus zenfone9', 2000, 'asus zenfone9 (modified)', 1, 'women', 'asus zenfone9', 'Mobile Phones', 'SR002', 'asus zenfone9.jpg'),
(10, 'galazy z flip 3', 1300, 'galaxy z flip 3', 1, 'women', 'galaxy z flip 3', 'Mobile Phones', 'SR001', 'galaxy z flip 3.jpg'),
(11, 'Iphone13', 1200, 'Iphone13 (modified)', 1, 'women', 'yes', 'Mobile Phones', 'SR002', 'Iphone13.jpg'),
(26, 'vivo y33', 1300, 'vivo y33 (modified)', 1, 'women', 'No', 'Mobile Phones', 'W234', 'vivo Y33s.jpg'),
(27, 'PCs', 7000, 'PCs (modified)', 1, 'women', 'yes', 'pc', 'W234', 'download (1).jpg'),
(28, 'Pcs gaming', 39990, 'Pcs gaming (modified)', 1, 'women', 'no', 'pc', 'W345', 'download.jpg'),
(29, 'Pcs', 10000, 'Pcs (modified)', 1, 'women', 'yes', 'pc', 'W345', 'images.jpg'),
(30, 'ipad pro 11inch', 20000, 'ipad pro 11inch (modified)', 1, 'women', 'ok', 'Tablets', 'O234', 'ipad pro 11inch.jpg'),
(31, 'samsung galaxy tabA7 2021', 12000, 'samsung galaxy tabA7 2021 (modified)', 1, 'women', 'ok', 'Tablets', 'O254', 'samsung galaxy tabA7 2021.jpg'),


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  `activation` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `confirmCode`, `activation`) VALUES
(24, 'Arash', 'Irany', 'arash@website.com', '09123456789', 'tehran', '25f9e794323b453885f5181f1b624d0b', '0', 'yes'),
(25, 'Kourosh', 'Irany', 'kourosh@website.com', '09123456789', 'tehran', '6ebe76c9fb411be97b3b0d48b791a7c9', '0', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
