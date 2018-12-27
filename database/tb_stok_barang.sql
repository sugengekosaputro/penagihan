-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Des 2018 pada 16.47
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
-- Struktur dari tabel `tb_stok_barang`
--

CREATE TABLE `tb_stok_barang` (
  `id_stok_gudang` int(5) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `harga_jual` int(15) NOT NULL,
  `stok` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_stok_barang`
--

INSERT INTO `tb_stok_barang` (`id_stok_gudang`, `id_barang`, `harga_jual`, `stok`) VALUES
(1, '022792R01', 11500, 2500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_stok_barang`
--
ALTER TABLE `tb_stok_barang`
  ADD PRIMARY KEY (`id_stok_gudang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_stok_barang`
--
ALTER TABLE `tb_stok_barang`
  MODIFY `id_stok_gudang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
