-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2018 at 05:59 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `id_detail` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `jumlah_kirim` int(10) NOT NULL,
  `surat_jalan` varchar(20) NOT NULL,
  `tanggal_kirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`id_detail`, `id_order`, `jumlah_kirim`, `surat_jalan`, `tanggal_kirim`) VALUES
(1, 1, 200, 'B/asd', '2018-11-29'),
(2, 2, 300, 'B/ajs1/s', '2018-11-25'),
(3, 2, 488, 'BJJA/21A/1', '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_order_rev`
--

CREATE TABLE `tb_detail_order_rev` (
  `id_detail_order` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_order_rev`
--

INSERT INTO `tb_detail_order_rev` (`id_detail_order`, `id_order`, `id_barang`, `jumlah`) VALUES
(1, 181220004, '021585R01', 3),
(2, 181220004, '022792R01', 5),
(3, 181220005, '021585R01', 3),
(4, 181220005, '2536', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pembayaran`
--

CREATE TABLE `tb_detail_pembayaran` (
  `id_detail_pembayaran` int(11) NOT NULL,
  `id_pembayaran` int(5) NOT NULL,
  `dibayar` int(15) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_pembayaran`
--

INSERT INTO `tb_detail_pembayaran` (`id_detail_pembayaran`, `id_pembayaran`, `dibayar`, `tanggal`) VALUES
(1, 1, 2000000, '2018-11-29'),
(2, 2, 3000000, '2018-11-25'),
(9, 15, 450000, '2018-12-07'),
(10, 16, 150000, '2018-12-07'),
(11, 17, 340000, '2018-12-07'),
(12, 23, 35000, '2018-12-08'),
(13, 24, 150000, '2018-12-08'),
(14, 26, 150000, '2018-12-08'),
(15, 27, 15000, '2018-12-08'),
(16, 29, 155000, '2018-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_barang`
--

CREATE TABLE `tb_kategori_barang` (
  `id_kategori` int(5) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_barang`
--

INSERT INTO `tb_kategori_barang` (`id_kategori`, `jenis_barang`, `satuan`) VALUES
(1, 'kardus', 'pcs'),
(2, 'stiker', 'lbr');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master`
--

CREATE TABLE `tb_master` (
  `id` int(11) NOT NULL,
  `barang` varchar(20) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_barang`
--

CREATE TABLE `tb_master_barang` (
  `no` int(10) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `ukuran` varchar(30) NOT NULL,
  `gramatur` varchar(30) NOT NULL,
  `foto_barang` text NOT NULL,
  `harga_beli` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `id_kategori` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_barang`
--

INSERT INTO `tb_master_barang` (`no`, `id_barang`, `nama_barang`, `ukuran`, `gramatur`, `foto_barang`, `harga_beli`, `harga_jual`, `id_kategori`) VALUES
(1, '022792R01', 'MANGGA ONLINE KLONAL 21(MANGGA ONLINE KL', '345 X 260 X 134', 'W150/M125/M125/M125/B125', 'http://localhost/penagihan/assets/upload/mango1.jpg', 4500, 6000, 0),
(3, '021585R01', 'GFR KOSONGAN SW COKLAT(GFR KOSONGAN SW C', '392 X 302 X 124', 'B150/M125/B150', 'http://localhost/penagihan/assets/upload/barang/.jpg', 2000, 7000, 0),
(4, '2536', 'Plastik', '2', '2', 'http://localhost/penagihan/assets/upload/barang/2536.png', 1000, 1500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(10) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `jumlah_order` int(10) NOT NULL,
  `tanggal_order` date NOT NULL,
  `total_kirim` int(10) NOT NULL,
  `status_order` enum('Selesai Pengiriman','Proses Pengiriman','','') NOT NULL,
  `log_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_pelanggan`, `id_barang`, `jumlah_order`, `tanggal_order`, `total_kirim`, `status_order`, `log_time`) VALUES
(37, 2, '022792R01', 560, '2018-12-07', 0, 'Proses Pengiriman', '11:57:10'),
(38, 1, '022792R01', 860, '2018-12-07', 0, 'Proses Pengiriman', '11:58:21'),
(39, 1, '022792R01', 80, '2018-12-08', 0, 'Proses Pengiriman', '05:32:24'),
(44, 1, '022792R01', 150, '2018-12-08', 0, 'Proses Pengiriman', '06:26:07'),
(45, 1, '022792R01', 220, '2018-12-08', 0, 'Proses Pengiriman', '06:27:49'),
(46, 1, '021585R01', 440, '2018-12-08', 0, 'Proses Pengiriman', '06:28:23'),
(47, 2, '022792R01', 220, '2018-12-08', 0, 'Proses Pengiriman', '06:29:46'),
(48, 2, '022792R01', 22, '2018-12-08', 0, 'Proses Pengiriman', '06:32:01'),
(49, 1, '022792R01', 111, '2018-12-08', 0, 'Proses Pengiriman', '06:38:23'),
(50, 1, '022792R01', 221, '2018-12-08', 0, 'Proses Pengiriman', '06:38:52'),
(51, 0, '022792R01', 100, '2018-12-18', 0, 'Proses Pengiriman', '10:19:35'),
(52, 0, '2536', 90, '2018-12-18', 0, 'Proses Pengiriman', '10:20:15'),
(53, 0, '2536', 22, '2018-12-18', 0, 'Proses Pengiriman', '10:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_rev`
--

CREATE TABLE `tb_order_rev` (
  `id_order` int(10) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `tanggal_order` date NOT NULL,
  `status_order` varchar(50) NOT NULL,
  `log_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_rev`
--

INSERT INTO `tb_order_rev` (`id_order`, `id_pelanggan`, `tanggal_order`, `status_order`, `log_time`) VALUES
(181218001, 1, '2018-12-19', 'Proses Pengiriman', '16:08:33'),
(181218002, 2, '2018-12-19', 'Proses Pengiriman', '16:27:59'),
(181219001, 2, '2018-12-19', 'Proses Pengiriman', '17:01:04'),
(181219002, 1, '2018-12-19', 'Proses Pengiriman', '17:04:32'),
(181219003, 1, '2018-12-19', 'Proses Pengiriman', '17:11:27'),
(181219004, 2, '2018-12-19', 'Proses Pengiriman', '17:11:35'),
(181220001, 1, '2018-12-20', 'Proses Pengiriman', '07:06:44'),
(181220002, 1, '2018-12-20', 'Proses Pengiriman', '07:07:53'),
(181220003, 2, '2018-12-20', 'Proses Pengiriman', '07:08:11'),
(181220004, 1, '2018-12-20', 'Proses Pengiriman', '07:09:45'),
(181220005, 2, '2018-12-20', 'Proses Pengiriman', '07:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(10) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `harga_pelanggan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `nomor_telepon`, `email`, `harga_pelanggan`) VALUES
(1, 'CV. Fabi Nur', 'Jl.Dr.Soetomo', '089696334084', 'fabinurcahyo@gmail.com', 700),
(2, 'Cv. Sugeng Sumpil', 'Jl.Sumpil', '0896963340', 'ssumpil@gmail.com', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `total_bayar` int(15) NOT NULL,
  `status_pembayaran` enum('Lunas','Belum Lunas','Belum Bayar','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_order`, `total_bayar`, `status_pembayaran`) VALUES
(16, 37, 3920000, 'Belum Lunas'),
(17, 38, 5762000, 'Belum Lunas'),
(18, 39, 536000, 'Belum Lunas'),
(23, 44, 1005000, 'Belum Lunas'),
(24, 45, 1474000, 'Belum Lunas'),
(25, 46, 3388000, 'Belum Lunas'),
(26, 47, 1540000, 'Belum Lunas'),
(27, 48, 154000, 'Belum Lunas'),
(28, 49, 743700, 'Belum Lunas'),
(29, 50, 1480700, 'Belum Lunas'),
(30, 51, 600000, 'Belum Lunas'),
(31, 52, 135000, 'Belum Lunas'),
(32, 53, 33000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `foto`, `role`) VALUES
(35, 'user', 'user', 'user', 'http://localhost/penagihan/assets/upload/user.jpg', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_detail_order_rev`
--
ALTER TABLE `tb_detail_order_rev`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indexes for table `tb_detail_pembayaran`
--
ALTER TABLE `tb_detail_pembayaran`
  ADD PRIMARY KEY (`id_detail_pembayaran`);

--
-- Indexes for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_master`
--
ALTER TABLE `tb_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_master_barang`
--
ALTER TABLE `tb_master_barang`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_order_rev`
--
ALTER TABLE `tb_order_rev`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `id_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_detail_order_rev`
--
ALTER TABLE `tb_detail_order_rev`
  MODIFY `id_detail_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_detail_pembayaran`
--
ALTER TABLE `tb_detail_pembayaran`
  MODIFY `id_detail_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master`
--
ALTER TABLE `tb_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_master_barang`
--
ALTER TABLE `tb_master_barang`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tb_order_rev`
--
ALTER TABLE `tb_order_rev`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1812190011;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
