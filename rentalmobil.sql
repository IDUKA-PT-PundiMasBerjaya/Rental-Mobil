-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 03:48 AM
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
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Rivetchan', 'Drags421'),
(2, 'Admin1', 'Drags421');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idcustomer` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idcustomer`, `nama`, `alamat`, `email`, `no_hp`) VALUES
(1, 'Alief Try Helfian', 'Batam Kota', 'alieftry@gmail.com', '085264562334'),
(2, 'Enno Nurwansyah Rasyidi', 'Griya Kpn', 'kanekitouru2@gmail.com', '082388310607'),
(3, 'Rivet', 'Griya Kpn', 'tevirchan@gmail.com', '082388310607');

-- --------------------------------------------------------

--
-- Table structure for table `garasi`
--

CREATE TABLE `garasi` (
  `idgarasi` int(11) NOT NULL,
  `kendaraan_idmobil` int(11) DEFAULT NULL,
  `stok` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garasi`
--

INSERT INTO `garasi` (`idgarasi`, `kendaraan_idmobil`, `stok`) VALUES
(1, 1, 10),
(2, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `idmobil` int(11) NOT NULL,
  `nama_mobil` varchar(100) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `warna` varchar(500) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `gambar_mobil` varchar(500) DEFAULT NULL,
  `harga_perhari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`idmobil`, `nama_mobil`, `merek`, `warna`, `tahun`, `gambar_mobil`, `harga_perhari`) VALUES
(1, 'Ayla', 'Daihatsu', 'Merah', 2019, 'ayla.png', 100000),
(2, 'WR-V Reson', 'Honda', 'Merah', 2023, 'Honda Reson.jpg', 50000),
(3, 'Rocky', 'Daihatsu', 'Merah', 2020, 'Daihatsu Rocky.jpg', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_mobil`
--

CREATE TABLE `pengembalian_mobil` (
  `id_pengembalian` int(11) NOT NULL,
  `stok_mobil` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `garasi_idgarasi` int(11) NOT NULL,
  `penyewaan_id_penyewaan` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian_mobil`
--

INSERT INTO `pengembalian_mobil` (`id_pengembalian`, `stok_mobil`, `tanggal_pengembalian`, `garasi_idgarasi`, `penyewaan_id_penyewaan`, `denda`) VALUES
(1, 5, '2024-04-18', 1, 1, 800000),
(2, 5, '2024-04-25', 2, 2, 350000);

--
-- Triggers `pengembalian_mobil`
--
DELIMITER $$
CREATE TRIGGER `pengembalian` AFTER INSERT ON `pengembalian_mobil` FOR EACH ROW BEGIN 
	UPDATE garasi SET stok = stok + NEW.stok_mobil
    WHERE idgarasi = NEW.garasi_idgarasi;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `tanggal_sewa` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `customer_idcustomer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `tanggal_sewa`, `tanggal_kembali`, `customer_idcustomer`) VALUES
(1, '2024-04-01', '2024-04-02', 1),
(2, '2024-04-01', '2024-04-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_mobil`
--

CREATE TABLE `penyewaan_mobil` (
  `id_penyewaan` int(11) NOT NULL,
  `garasi_idgarasi` int(11) NOT NULL,
  `stok_mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan_mobil`
--

INSERT INTO `penyewaan_mobil` (`id_penyewaan`, `garasi_idgarasi`, `stok_mobil`) VALUES
(1, 1, 5),
(2, 2, 5),
(2, 1, 5);

--
-- Triggers `penyewaan_mobil`
--
DELIMITER $$
CREATE TRIGGER `penyewaan` AFTER INSERT ON `penyewaan_mobil` FOR EACH ROW BEGIN
	UPDATE garasi SET stok = stok - NEW.stok_mobil
    WHERE idgarasi = NEW.garasi_idgarasi;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indexes for table `garasi`
--
ALTER TABLE `garasi`
  ADD PRIMARY KEY (`idgarasi`),
  ADD KEY `kendaraan_idmobil` (`kendaraan_idmobil`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`idmobil`);

--
-- Indexes for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `garasi_idgarasi` (`garasi_idgarasi`,`penyewaan_id_penyewaan`),
  ADD KEY `penyewaan_id_penyewaan` (`penyewaan_id_penyewaan`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `customer_idcustomer` (`customer_idcustomer`);

--
-- Indexes for table `penyewaan_mobil`
--
ALTER TABLE `penyewaan_mobil`
  ADD KEY `id_penyewaan` (`id_penyewaan`),
  ADD KEY `garasi_idgarasi` (`garasi_idgarasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `garasi`
--
ALTER TABLE `garasi`
  ADD CONSTRAINT `garasi_ibfk_1` FOREIGN KEY (`kendaraan_idmobil`) REFERENCES `kendaraan` (`idmobil`);

--
-- Constraints for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  ADD CONSTRAINT `pengembalian_mobil_ibfk_1` FOREIGN KEY (`penyewaan_id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`),
  ADD CONSTRAINT `pengembalian_mobil_ibfk_2` FOREIGN KEY (`garasi_idgarasi`) REFERENCES `garasi` (`idgarasi`);

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`customer_idcustomer`) REFERENCES `customer` (`idcustomer`);

--
-- Constraints for table `penyewaan_mobil`
--
ALTER TABLE `penyewaan_mobil`
  ADD CONSTRAINT `penyewaan_mobil_ibfk_1` FOREIGN KEY (`garasi_idgarasi`) REFERENCES `garasi` (`idgarasi`),
  ADD CONSTRAINT `penyewaan_mobil_ibfk_2` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
