-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 17, 2025 at 09:13 AM
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
-- Table structure for table `permintaan_dokumen_batch`
--

CREATE TABLE `permintaan_dokumen_batch` (
  `id_permintaan` int(11) NOT NULL,
  `dikodok` varchar(255) NOT NULL,
  `nomor_batch` varchar(255) NOT NULL,
  `lokasi_dokumen` varchar(500) NOT NULL,
  `status` enum('diminta','dicetak') DEFAULT 'diminta',
  `peminta` varchar(255) NOT NULL,
  `pencetak` varchar(255) DEFAULT NULL,
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dicetak_pada` timestamp NULL DEFAULT NULL,
  `diperbarui_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_lampiran` varchar(500) DEFAULT NULL,
  `catatan` text,
  `besaran_bets` varchar(250) DEFAULT NULL,
  `jenis_dokumen` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permintaan_dokumen_batch`
--

INSERT INTO `permintaan_dokumen_batch` (`id_permintaan`, `dikodok`, `nomor_batch`, `lokasi_dokumen`, `status`, `peminta`, `pencetak`, `dibuat_pada`, `dicetak_pada`, `diperbarui_pada`, `file_lampiran`, `catatan`, `besaran_bets`, `jenis_dokumen`, `nama_produk`) VALUES
(1, '', 'A50111N', '', 'diminta', '72', NULL, '2025-02-07 01:21:04', NULL, '2025-02-07 01:21:04', '106100025847 TTD A50111N.pdf', '<p>Menggunakan Mesin Siebler</p>\r\n', '777.777 TAB', 'PGI', 'TABLET TAMBAH DARAH (TSG)(DUS100TAB)-BJN'),
(2, 'PC-03-0023', 'A50187N', '', 'dicetak', '72', '1054', '2025-02-07 01:25:58', '2025-02-07 01:43:54', '2025-02-07 01:43:54', '-', '<p>na</p>\r\n', '823.529 TAB', 'PGI', 'FDC 2 OAT KAT I HARIAN (24 X 14 TAB)'),
(3, 'PC-03-0018', 'B50237N', '', 'dicetak', '72', '1054', '2025-02-07 01:30:29', '2025-02-07 01:35:29', '2025-02-07 01:35:29', '106100026131 Nitrokaf Retard B50237N.pdf', '<p>NA</p>\r\n', '549.569 KPS', 'PGI', 'NITROKAF RETARD (DUS 100 KAPS)-BJN'),
(4, '', 'B50269N', '', 'diminta', '72', NULL, '2025-02-07 01:42:53', NULL, '2025-02-07 01:42:53', '106100026152 Nitrokaf Ruahan B50269N.pdf', '', '127,500 KG', 'PPI', 'NITROKAF RETARD KAPSUL (100)  RUAHAN-BJN'),
(5, 'PR-02-2022', 'B50217N', '', 'dicetak', '72', '1054', '2025-02-07 01:44:12', '2025-02-07 01:47:42', '2025-02-07 01:47:42', '106100026071 106100026072 FDC Produk Ruahan B5217N B50218N.pdf', '', '280 KG', 'PPI', 'FDC 2 OAT KAT I HARIAN - RUAHAN'),
(6, '', 'B50218N', '', 'diminta', '72', NULL, '2025-02-07 01:45:03', NULL, '2025-02-07 01:45:03', '106100026071 106100026072 FDC Produk Ruahan B5217N B50218N.pdf', '<p>NA</p>\r\n', '280 KG', 'PPI', 'FDC 2 OAT KAT I HARIAN - RUAHAN '),
(7, '', 'B50243N', '', 'diminta', '72', NULL, '2025-02-07 01:47:16', NULL, '2025-02-07 01:47:16', '106100026091 Amlodipine 10mg B50243N.pdf', '<p>NA</p>\r\n', '140 KG', 'PPI', 'AMLODIPINE 10 MG RUAHAN-BJN'),
(8, 'PC-01-0001', 'K42548N', '', 'dicetak', '72', '1054', '2025-02-07 01:53:51', '2025-02-07 02:00:37', '2025-02-07 02:00:37', '106100025023 INH 300MG K42548N.pdf', '<p>NA</p>\r\n', '175.000 TAB', 'PGI', 'ISONIAZID 300 MG (DUS 100 TAB)-BJN'),
(9, '', 'A50111N', '', 'diminta', '72', NULL, '2025-02-14 06:39:47', NULL, '2025-02-14 06:39:47', '002_LG 200_14_II_2025.pdf', '<p>Besar Batch di perkecil menjadi 0,5 batch</p>\r\n', '140 kg / 7777 Dus', 'PPI', 'TABLET TAMBAH DARAH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permintaan_dokumen_batch`
--
ALTER TABLE `permintaan_dokumen_batch`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permintaan_dokumen_batch`
--
ALTER TABLE `permintaan_dokumen_batch`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
