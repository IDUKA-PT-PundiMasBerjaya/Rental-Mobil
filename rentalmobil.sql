-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 10:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Admin 1', 'Drags421');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `alamat`, `email`, `no_hp`) VALUES
(1, 'Alief Try Helfian', 'Cikitsu', 'alieftry@gmail.com', '+62 852 6456 2334'),
(2, 'Enno Nurwansyah Rasyidi', 'Griya Kpn', 'tevirchan@gmail.com', '+62 823 8831 0607');

-- --------------------------------------------------------

--
-- Table structure for table `garasi`
--

CREATE TABLE `garasi` (
  `id_garasi` int(11) NOT NULL,
  `tersedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garasi`
--

INSERT INTO `garasi` (`id_garasi`, `tersedia`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `harga_per_hari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `harga_per_hari`) VALUES
(1, 55000),
(2, 60000),
(3, 75000),
(4, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_mobil` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `merek` varchar(500) NOT NULL,
  `tahun` int(11) NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `garasi_id_garasi` int(11) NOT NULL,
  `harga_id_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_mobil`, `nama`, `merek`, `tahun`, `gambar`, `garasi_id_garasi`, `harga_id_harga`) VALUES
(1, 'Ayla', 'Daihatsu', 2019, 'ayla.png', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_mobil`
--

CREATE TABLE `pengembalian_mobil` (
  `id_pengembalian` int(11) NOT NULL,
  `jumlah_mobil` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `mobil_id_mobil` int(11) NOT NULL,
  `sewa_id_sewa` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_mobil`
--

CREATE TABLE `penyewaan_mobil` (
  `id_sewa` int(11) NOT NULL,
  `jumlah_mobil` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `mobil_id_mobil` int(11) NOT NULL,
  `customer_id_customer` int(11) NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `garasi`
--
ALTER TABLE `garasi`
  ADD PRIMARY KEY (`id_garasi`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `garasi_id_garasi` (`garasi_id_garasi`),
  ADD KEY `harga_id_harga` (`harga_id_harga`);

--
-- Indexes for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `garasi_id_mobil` (`sewa_id_sewa`),
  ADD KEY `mobil_id_mobil` (`mobil_id_mobil`);

--
-- Indexes for table `penyewaan_mobil`
--
ALTER TABLE `penyewaan_mobil`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `mobil_id_mobil` (`mobil_id_mobil`),
  ADD KEY `customer_id_customer` (`customer_id_customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `garasi`
--
ALTER TABLE `garasi`
  MODIFY `id_garasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_ibfk_2` FOREIGN KEY (`garasi_id_garasi`) REFERENCES `garasi` (`id_garasi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `kendaraan_ibfk_3` FOREIGN KEY (`harga_id_harga`) REFERENCES `harga` (`id_harga`);

--
-- Constraints for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  ADD CONSTRAINT `pengembalian_mobil_ibfk_1` FOREIGN KEY (`mobil_id_mobil`) REFERENCES `kendaraan` (`id_mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengembalian_mobil_ibfk_2` FOREIGN KEY (`sewa_id_sewa`) REFERENCES `penyewaan_mobil` (`id_sewa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penyewaan_mobil`
--
ALTER TABLE `penyewaan_mobil`
  ADD CONSTRAINT `penyewaan_mobil_ibfk_3` FOREIGN KEY (`mobil_id_mobil`) REFERENCES `kendaraan` (`id_mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penyewaan_mobil_ibfk_4` FOREIGN KEY (`customer_id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
