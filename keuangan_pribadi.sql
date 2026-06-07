-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2026 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan_pribadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jt` int(11) NOT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jt`, `nama_jenis`) VALUES
(1, 'pemasukan'),
(2, 'Pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_jt` int(11) DEFAULT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_jt`, `nama_kategori`) VALUES
(1, 1, 'Gaji'),
(2, 2, 'Makan'),
(3, 2, 'Transportasi'),
(4, 2, 'Kesehatan'),
(5, 2, 'Grocery'),
(6, 2, 'Darurat');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_kategori`, `tanggal`, `nominal`, `keterangan`) VALUES
(1, 4, 1, '2026-06-06', 10000000.00, 'Gaji Bulanan'),
(2, 4, 5, '2026-06-06', 2000000.00, 'Belanja Bulanan'),
(3, 1, 1, '2026-06-06', 5000000.00, 'Gaji Bulanan'),
(4, 1, 2, '2026-06-06', 100000.00, 'Makan di luar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `nama`, `username`, `password`) VALUES
(1, 1, 'Shilvya Putri Irlinda', 'shilvya', '$2y$10$0HkuBBJzMApheH/o9kLgzOuWHKBIhv80YEE9sK3bYga.qwUi6Tbdy'),
(2, 1, 'Imro\'atus Sa\'adah', 'imroatus', '$2y$10$NOGt3gT4wn/0DhknD6bYhO1wPYImCC9jufbMfWF4W6J8ojFuvuZuC'),
(3, 1, 'Annisa Eva Riyanti', 'annisa', '$2y$10$JmvAi5vVjggD91K/EBvCsuzIhP5MtoT2q7EY0GALGFF0o8TLs9jpG'),
(4, 2, 'Elvara Nayla Kirana', 'elvara', '$2y$10$dYEOG3tKeVB1GO50TYJNpuSjYEMm2KyBfJgsusgo1yjaKG2uciNTC'),
(5, 2, 'Arvenza Raka Pradipta', 'arvenza', '$2y$10$MrSqC8HdguN9tlsdQnKgN.DI4vJg/l0MMPLd6NeuHkusQGsp6BQ1a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jt`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `fk_kategori_jenis` (`id_jt`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_user` (`id_user`),
  ADD KEY `fk_transaksi_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `fk_kategori_jenis` FOREIGN KEY (`id_jt`) REFERENCES `jenis_transaksi` (`id_jt`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
