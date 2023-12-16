-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2023 at 04:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keewa_shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Men'),
(7, 'Women'),
(8, 'Unisex'),
(10, 'Kategori baru');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('ready_stok','sold_out','pre_order') DEFAULT 'ready_stok'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(17, 1, 'Camel Cadmium Green', 'uploads/images/products/1700917081_BELLA - CAMEL - CADMIUM GREEN.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'sold_out'),
(18, 1, 'Camel', 'uploads/images/products/1700917096_BELLA - CAMEL.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(19, 1, 'Classic Blue', 'uploads/images/products/1700917118_BELLA - CLASSIC BLUE.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(20, 8, 'Fairy Blue', 'uploads/images/products/1700925461_BELLA - FAIRY BLUE.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'pre_order'),
(21, 1, 'Gold', 'uploads/images/products/1700917184_BELLA - GOLD.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(22, 7, 'Havana', 'uploads/images/products/1700925549_BELLA - HAVANA.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(23, 1, 'Khaki', 'uploads/images/products/1700917218_BELLA - KHAKI.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(24, 1, 'Lemon Curry', 'uploads/images/products/1700917241_BELLA - LEMON CURRY.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(25, 1, 'Navy', 'uploads/images/products/1700917278_BELLA - NAVY.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(26, 1, 'Olive', 'uploads/images/products/1700917327_BELLA - OLIVE.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(27, 1, 'Pink', 'uploads/images/products/1700917349_BELLA - PINK.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(28, 1, 'Raisin', 'uploads/images/products/1700917550_BELLA - RAISIN.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(29, 1, 'Tole', 'uploads/images/products/1700917572_BELLA - TOLE.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(30, 1, 'Very Pery', 'uploads/images/products/1700917624_BELLA - VERY PERY.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(31, 1, 'Rumba Red', 'uploads/images/products/1700917652_BELLA RUMBA RED.JPG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto distinctio quam veritatis quis tempora velit ipsum porro nobis excepturi cupiditate!', 'ready_stok'),
(32, 10, 'test', 'uploads/images/products/1700926665_BELLA RUMBA RED.JPG', 'test', 'pre_order');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'keewa_shoes', '$2y$10$HLVLyrSwy1AMpO/jFg22JOOJWDglw3TOuOTq5GJLCMtsT6kmst/TG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
