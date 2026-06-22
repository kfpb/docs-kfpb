-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 17, 2025 at 09:14 AM
-- Server version: 5.7.37-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_docs_kfpb_ki`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_status_permintaan_bets`
--

CREATE TABLE `notifikasi_status_permintaan_bets` (
  `id_notifikasi` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sudah_dilihat` enum('Y','N') DEFAULT 'N',
  `waktu_dilihat` timestamp NULL DEFAULT NULL,
  `sudah_dilihat_cetak` varchar(15) DEFAULT NULL,
  `waktu_dilihat_cetak` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifikasi_status_permintaan_bets`
--

INSERT INTO `notifikasi_status_permintaan_bets` (`id_notifikasi`, `id_permintaan`, `user_id`, `sudah_dilihat`, `waktu_dilihat`, `sudah_dilihat_cetak`, `waktu_dilihat_cetak`) VALUES
(1, 1, 92, 'N', NULL, NULL, NULL),
(2, 1, 90, 'N', NULL, NULL, NULL),
(3, 1, 74, 'N', NULL, NULL, NULL),
(4, 1, 71, 'N', NULL, NULL, NULL),
(5, 1, 35, 'N', NULL, NULL, NULL),
(6, 1, 27, 'N', NULL, NULL, NULL),
(7, 1, 26, 'N', NULL, NULL, NULL),
(8, 2, 92, 'N', NULL, NULL, NULL),
(9, 2, 90, 'N', NULL, NULL, NULL),
(10, 2, 74, 'N', NULL, NULL, NULL),
(11, 2, 71, 'N', NULL, NULL, NULL),
(12, 2, 35, 'N', NULL, NULL, NULL),
(13, 2, 27, 'N', NULL, NULL, NULL),
(14, 2, 26, 'N', NULL, NULL, NULL),
(15, 3, 92, 'N', NULL, NULL, NULL),
(16, 3, 90, 'N', NULL, NULL, NULL),
(17, 3, 74, 'N', NULL, NULL, NULL),
(18, 3, 71, 'N', NULL, NULL, NULL),
(19, 3, 35, 'N', NULL, NULL, NULL),
(20, 3, 27, 'N', NULL, NULL, NULL),
(21, 3, 26, 'N', NULL, NULL, NULL),
(22, 4, 92, 'N', NULL, NULL, NULL),
(23, 4, 90, 'N', NULL, NULL, NULL),
(24, 4, 74, 'N', NULL, NULL, NULL),
(25, 4, 71, 'N', NULL, NULL, NULL),
(26, 4, 35, 'N', NULL, NULL, NULL),
(27, 4, 27, 'N', NULL, NULL, NULL),
(28, 4, 26, 'N', NULL, NULL, NULL),
(29, 5, 92, 'N', NULL, NULL, NULL),
(30, 5, 90, 'N', NULL, NULL, NULL),
(31, 5, 74, 'N', NULL, NULL, NULL),
(32, 5, 71, 'N', NULL, NULL, NULL),
(33, 5, 35, 'N', NULL, NULL, NULL),
(34, 5, 27, 'N', NULL, NULL, NULL),
(35, 5, 26, 'N', NULL, NULL, NULL),
(36, 6, 92, 'N', NULL, NULL, NULL),
(37, 6, 90, 'N', NULL, NULL, NULL),
(38, 6, 74, 'N', NULL, NULL, NULL),
(39, 6, 71, 'N', NULL, NULL, NULL),
(40, 6, 35, 'N', NULL, NULL, NULL),
(41, 6, 27, 'N', NULL, NULL, NULL),
(42, 6, 26, 'N', NULL, NULL, NULL),
(43, 7, 92, 'N', NULL, NULL, NULL),
(44, 7, 90, 'N', NULL, NULL, NULL),
(45, 7, 74, 'N', NULL, NULL, NULL),
(46, 7, 71, 'N', NULL, NULL, NULL),
(47, 7, 35, 'N', NULL, NULL, NULL),
(48, 7, 27, 'N', NULL, NULL, NULL),
(49, 7, 26, 'N', NULL, NULL, NULL),
(50, 8, 92, 'N', NULL, NULL, NULL),
(51, 8, 90, 'Y', '2025-02-13 03:52:40', NULL, NULL),
(52, 8, 74, 'N', NULL, NULL, NULL),
(53, 8, 71, 'N', NULL, NULL, NULL),
(54, 8, 35, 'N', NULL, NULL, NULL),
(55, 8, 27, 'N', NULL, NULL, NULL),
(56, 8, 26, 'Y', '2025-02-11 01:32:30', NULL, NULL),
(57, 9, 92, 'N', NULL, NULL, NULL),
(58, 9, 90, 'N', NULL, NULL, NULL),
(59, 9, 74, 'N', NULL, NULL, NULL),
(60, 9, 71, 'N', NULL, NULL, NULL),
(61, 9, 35, 'N', NULL, NULL, NULL),
(62, 9, 27, 'N', NULL, NULL, NULL),
(63, 9, 26, 'N', NULL, NULL, NULL),
(64, 9, 38, 'N', NULL, NULL, NULL),
(65, 9, 39, 'N', NULL, NULL, NULL),
(66, 9, 40, 'N', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifikasi_status_permintaan_bets`
--
ALTER TABLE `notifikasi_status_permintaan_bets`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifikasi_status_permintaan_bets`
--
ALTER TABLE `notifikasi_status_permintaan_bets`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
