-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 02:59 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirdimdimmusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id_barang` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `kategori` int(3) UNSIGNED ZEROFILL NOT NULL,
  `merek` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) UNSIGNED NOT NULL,
  `harga` double NOT NULL,
  `harga_jual` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `kode_barang`, `kategori`, `merek`, `nama_barang`, `stok`, `harga`, `harga_jual`) VALUES
(001, 'BR001', 001, 001, 'Ukulele Yamaha XY200', 58, 160000, 278000),
(030, 'BR011', 003, 002, 'Gitar Gibson 200', 50, 150000, 180000),
(031, 'BR002', 025, 002, 'Ketipung Gibson Y200', 60, 170000, 210000),
(033, 'BR003', 003, 001, 'Gitar Yamaha XY20', 45, 215000, 250000),
(035, 'BR004', 012, 003, 'Biola Shelby 2500', 52, 210000, 255000),
(036, 'BR005', 026, 002, 'Suling Kecil Gibson 200', 35, 170000, 195000);

-- --------------------------------------------------------

--
-- Table structure for table `master_barang_supplier`
--

CREATE TABLE `master_barang_supplier` (
  `id_barang_supplier` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kode_barang_supplier` varchar(10) NOT NULL,
  `supplier` varchar(10) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'master_satuan=>id_satuan',
  `harga` double UNSIGNED NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori`
--

CREATE TABLE `master_kategori` (
  `id_kategori` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_kategori` varchar(25) NOT NULL,
  `ket_kategori` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_kategori`
--

INSERT INTO `master_kategori` (`id_kategori`, `nama_kategori`, `ket_kategori`) VALUES
(001, 'Ukulele', ''),
(003, 'Gitar', ''),
(012, 'Biola', ''),
(025, 'Ketipung', ''),
(026, 'Suling Kecil', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_merek`
--

CREATE TABLE `master_merek` (
  `id_merek` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_merek` varchar(25) NOT NULL,
  `ket_merek` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_merek`
--

INSERT INTO `master_merek` (`id_merek`, `nama_merek`, `ket_merek`) VALUES
(001, 'Yamaha', ''),
(002, 'Gibson', NULL),
(003, 'Shelby', NULL),
(007, 'Suzuki', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_pembelian`
--

CREATE TABLE `master_pembelian` (
  `id_pembelian` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kode_pembelian` varchar(10) NOT NULL,
  `barang` varchar(10) NOT NULL COMMENT 'master_barang_supplier=>kode_barang',
  `jumlah` int(11) UNSIGNED NOT NULL,
  `satuan` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'master_satuan=>id_satuan',
  `supplier` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'master_supplier=>kode_supplier',
  `harga` double UNSIGNED NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`id_pembelian`, `kode_pembelian`, `barang`, `jumlah`, `satuan`, `supplier`, `harga`, `tanggal`) VALUES
(030, 'PB002', '035', 50, 001, 005, 170000, '2023-01-08 06:25:12'),
(031, 'PB003', '030', 46, 001, 008, 150000, '2023-01-08 06:25:54'),
(032, 'PB004', '031', 28, 001, 006, 165000, '2023-01-08 06:27:13'),
(033, 'PB005', '033', 38, 001, 005, 155000, '2023-01-08 06:27:34'),
(034, 'PB006', '031', 50, 001, 010, 135000, '2023-01-08 06:44:14'),
(035, 'PB007', '001', 15, 001, 005, 160000, '2023-01-08 06:44:56'),
(036, 'PB001', '036 ', 55, 001, 008, 170000, '2023-01-09 03:07:38'),
(037, 'PB008', '031', 2, 001, 005, 165000, '2023-01-19 01:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `master_penjualan`
--

CREATE TABLE `master_penjualan` (
  `id_penjualan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kode_penjualan` varchar(10) NOT NULL,
  `barang` varchar(10) NOT NULL COMMENT 'master_barang=>kode_barang',
  `jumlah` int(11) UNSIGNED NOT NULL,
  `satuan` varchar(25) NOT NULL COMMENT 'master_satuan=>id_satuan',
  `harga` double UNSIGNED NOT NULL,
  `user` varchar(25) NOT NULL COMMENT 'master_user=>username',
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`id_penjualan`, `kode_penjualan`, `barang`, `jumlah`, `satuan`, `harga`, `user`, `tanggal`) VALUES
(030, 'PJ001', '031', 6, '001', 260000, '023', '2023-01-04 14:25:09'),
(031, 'PJ002', '031', 19, '001', 240000, '022', '2023-01-05 02:40:22'),
(035, 'PJ003', '031', 25, '001', 210000, '021', '2023-01-09 03:13:26'),
(036, 'PJ004', '036', 22, '001', 195000, '022', '2023-01-09 03:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `master_satuan`
--

CREATE TABLE `master_satuan` (
  `id_satuan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_satuan` varchar(25) NOT NULL,
  `ket_satuan` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_satuan`
--

INSERT INTO `master_satuan` (`id_satuan`, `nama_satuan`, `ket_satuan`) VALUES
(001, 'Unit', NULL),
(006, 'Kg', ''),
(007, 'NARTO', 'cm merupakan , cek gogel aja sendiri, bohomg ding');

-- --------------------------------------------------------

--
-- Table structure for table `master_supplier`
--

CREATE TABLE `master_supplier` (
  `id_supplier` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `kab_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_supplier`
--

INSERT INTO `master_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `kab_kota`) VALUES
(001, 'SP001', 'Kath', 'Sukoharjo'),
(004, 'SP003', 'Tatang', 'Sukoharjo'),
(005, 'SP002', 'Josh', 'Solo'),
(006, 'SP004', 'Manda', 'Boyolali'),
(008, 'SP007', 'Kanna', 'Nganjuk'),
(010, 'SP006', 'Josep Staling', 'Gulag Manis');

-- --------------------------------------------------------

--
-- Table structure for table `master_transaksi`
--

CREATE TABLE `master_transaksi` (
  `id_transaksi` int(3) UNSIGNED ZEROFILL NOT NULL,
  `kode_transaksi` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `barang` varchar(10) NOT NULL COMMENT 'master_barang=>kode_barang',
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) UNSIGNED NOT NULL,
  `user` varchar(25) NOT NULL COMMENT 'master_user=>username',
  `nama_user` varchar(255) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `jenis_transaksi` enum('Pembelian','Penjualan') NOT NULL DEFAULT 'Pembelian',
  `harga` double UNSIGNED NOT NULL,
  `satuan` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'master_satuan=>id_satuan',
  `supplier` varchar(10) NOT NULL COMMENT 'master_supplier=>kode_supplier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id_user` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(25) NOT NULL,
  `pw` varchar(15) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id_user`, `username`, `pw`, `full_name`, `level`) VALUES
(017, 'admin', '1', 'ageng', 'admin'),
(021, 'user', '1', 'tejo', 'user'),
(022, 'jihyo', '2', 'Jihyo', 'user'),
(023, 'sakura', '3', 'Sakura', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `kategori` (`kategori`),
  ADD KEY `merek` (`merek`);

--
-- Indexes for table `master_barang_supplier`
--
ALTER TABLE `master_barang_supplier`
  ADD PRIMARY KEY (`id_barang_supplier`),
  ADD UNIQUE KEY `kode_barang_supplier` (`kode_barang_supplier`) USING BTREE,
  ADD KEY `satuan` (`satuan`),
  ADD KEY `supplier` (`supplier`) USING BTREE;

--
-- Indexes for table `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `master_merek`
--
ALTER TABLE `master_merek`
  ADD PRIMARY KEY (`id_merek`),
  ADD UNIQUE KEY `nama_merek` (`nama_merek`);

--
-- Indexes for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD UNIQUE KEY `kode_pembelian` (`kode_pembelian`),
  ADD KEY `satuan` (`satuan`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `barang` (`barang`);

--
-- Indexes for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD UNIQUE KEY `kode_penjualan` (`kode_penjualan`),
  ADD KEY `barang` (`barang`),
  ADD KEY `satuan` (`satuan`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `master_satuan`
--
ALTER TABLE `master_satuan`
  ADD PRIMARY KEY (`id_satuan`),
  ADD UNIQUE KEY `nama_satuan` (`nama_satuan`);

--
-- Indexes for table `master_supplier`
--
ALTER TABLE `master_supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `kode_supplier` (`kode_supplier`);

--
-- Indexes for table `master_transaksi`
--
ALTER TABLE `master_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `barang` (`barang`),
  ADD KEY `user` (`user`),
  ADD KEY `satuan` (`satuan`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id_barang` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `master_barang_supplier`
--
ALTER TABLE `master_barang_supplier`
  MODIFY `id_barang_supplier` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id_kategori` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `master_merek`
--
ALTER TABLE `master_merek`
  MODIFY `id_merek` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  MODIFY `id_pembelian` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id_penjualan` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `master_satuan`
--
ALTER TABLE `master_satuan`
  MODIFY `id_satuan` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_supplier`
--
ALTER TABLE `master_supplier`
  MODIFY `id_supplier` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_transaksi`
--
ALTER TABLE `master_transaksi`
  MODIFY `id_transaksi` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id_user` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD CONSTRAINT `master_barang_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `master_kategori` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `master_barang_ibfk_2` FOREIGN KEY (`merek`) REFERENCES `master_merek` (`id_merek`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
