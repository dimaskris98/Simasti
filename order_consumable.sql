-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 10:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsimasti`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_consumable`
--

CREATE TABLE `order_consumable` (
  `id_order` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `tgl_order` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_consum` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok_temp` int(11) NOT NULL,
  `admin` int(10) UNSIGNED NOT NULL,
  `id_sup` int(11) NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_consumable`
--

INSERT INTO `order_consumable` (`id_order`, `id_po`, `tgl_order`, `id_consum`, `jumlah`, `harga`, `stok_temp`, `admin`, `id_sup`, `catatan`) VALUES
(1, 12345, '2021-03-17 02:30:52', 4, 2, NULL, 33, 1, 3, NULL),
(2, 12345, '2021-03-17 04:51:34', 3, 5, NULL, 10, 1, 3, 'TEST'),
(3, 123, '2021-02-17 06:19:50', 4, 6, 50000, 35, 22, 6, '12345qwerty'),
(4, 0, '2021-01-17 06:19:50', 4, 5, 50000, 40, 20, 10, 'asddfgdgfd'),
(5, 123, '2021-03-17 06:35:16', 4, 2, 50000, 42, 24, 8, 'dgtdgdrgdrg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_consumable`
--
ALTER TABLE `order_consumable`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_consum` (`id_consum`),
  ADD KEY `fk_sup` (`id_sup`),
  ADD KEY `fk_admin` (`admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_consumable`
--
ALTER TABLE `order_consumable`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_consumable`
--
ALTER TABLE `order_consumable`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`admin`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consum` FOREIGN KEY (`id_consum`) REFERENCES `consumable` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sup` FOREIGN KEY (`id_sup`) REFERENCES `data_pemasok` (`id_sup`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
