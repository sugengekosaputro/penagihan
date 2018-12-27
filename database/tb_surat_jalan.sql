-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Des 2018 pada 16.10
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billybox`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_jalan`
--

CREATE TABLE `tb_surat_jalan` (
  `id_surat_jalan` int(10) NOT NULL,
  `id_order` int(12) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `no_surat_jalan` int(30) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal_surat_jalan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_surat_jalan`
--
ALTER TABLE `tb_surat_jalan`
  ADD PRIMARY KEY (`id_surat_jalan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_surat_jalan`
--
ALTER TABLE `tb_surat_jalan`
  MODIFY `id_surat_jalan` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
