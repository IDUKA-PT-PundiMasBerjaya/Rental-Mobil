-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 03:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalmobi`
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
(1, 'Rivetchan', 'Drags421');

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
(1, 'Alief Try Helfian', 'Batam', 'alieftry@gmail.com', '0885264562334');

-- --------------------------------------------------------

--
-- Table structure for table `garasi`
--

CREATE TABLE `garasi` (
  `idgarasi` int(11) NOT NULL,
  `tersedia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garasi`
--

INSERT INTO `garasi` (`idgarasi`, `tersedia`) VALUES
(1, 5 );

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `idharga` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`idharga`, `harga`) VALUES
(1, 5 );

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `idmobil` int(11) NOT NULL,
  `nama_mobil` varchar(100) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `gambar_mobil` varchar(500) DEFAULT NULL,
  `garasi_idgarasi` int(11) DEFAULT NULL,
  `harga_idharga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`idmobil`, `nama_mobil`, `merek`, `tahun`, `gambar_mobil`, `garasi_idgarasi`, `harga_idharga`) VALUES
(1, 'Ayla', 'Toyota', 2019, 'gambar kelas 1.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_mobil`
--

CREATE TABLE `pengembalian_mobil` (
  `id_pengembalian` int(11) NOT NULL,
  `jumlah_mobil` int(11) DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `garasi_idgarasi` int(11) NOT NULL,
  `penyewaan_id_penyewaan` int(11) NOT NULL,
  `kendaraan_idmobil` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian_mobil`
--

INSERT INTO `pengembalian_mobil` (`id_pengembalian`, `jumlah_mobil`, `tanggal_pengembalian`, `garasi_idgarasi`, `penyewaan_id_penyewaan`, `kendaraan_idmobil`, `denda`) VALUES
(1, 5, '2024-03-20', 1, 1, 1, 0);

--
-- Triggers `pengembalian_mobil`
--
DELIMITER $$
CREATE TRIGGER `pengembalian` AFTER INSERT ON `pengembalian_mobil` FOR EACH ROW BEGIN
	UPDATE garasi SET tersedia = tersedia + NEW.jumlah_mobil
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
(1, '2024-03-01', '2024-03-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_mobil`
--

CREATE TABLE `penyewaan_mobil` (
  `id_penyewaan` int(11) NOT NULL,
  `kendaraan_idmobil` int(11) DEFAULT NULL,
  `jumlah_mobil` int(11) DEFAULT NULL,
  `garasi_idgarasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan_mobil`
--

INSERT INTO `penyewaan_mobil` (`id_penyewaan`, `kendaraan_idmobil`, `jumlah_mobil`, `garasi_idgarasi`) VALUES
(1, 1, 1, 1);

--
-- Triggers `penyewaan_mobil`
--

DELIMITER $$
CREATE TRIGGER `penyewaan` AFTER INSERT ON `penyewaan_mobil` FOR EACH ROW BEGIN
	UPDATE garasi SET tersedia = tersedia - NEW.jumlah_mobil
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
  ADD PRIMARY KEY (`idgarasi`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`idharga`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`idmobil`),
  ADD KEY `garasi_idgarasi` (`garasi_idgarasi`),
  ADD KEY `harga_idharga` (`harga_idharga`);

--
-- Indexes for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  ADD KEY `fk_pengembalian_mobil_kendaraan1_idx` (`kendaraan_idmobil`),
  ADD KEY `fk_pengembalian_mobil_penyewaan1_idx` (`penyewaan_id_penyewaan`),
  ADD KEY `idx_id_pengembalian` (`id_pengembalian`);

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
  ADD KEY `kendaraan_idmobil` (`kendaraan_idmobil`),
  ADD KEY `garasi_idgarasi` (`garasi_idgarasi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`garasi_idgarasi`) REFERENCES `garasi` (`idgarasi`),
  ADD CONSTRAINT `kendaraan_ibfk_2` FOREIGN KEY (`harga_idharga`) REFERENCES `harga` (`idharga`);

--
-- Constraints for table `pengembalian_mobil`
--
ALTER TABLE `pengembalian_mobil`
  ADD CONSTRAINT `fk_pengembalian_mobil_kendaraan1` FOREIGN KEY (`kendaraan_idmobil`) REFERENCES `kendaraan` (`idmobil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pengembalian_mobil_penyewaan1` FOREIGN KEY (`penyewaan_id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penyewaan`
--

ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`customer_idcustomer`) REFERENCES `customer` (`idcustomer`);

--
-- Constraints for table `penyewaan_mobil`
--
ALTER TABLE `penyewaan_mobil`
  ADD CONSTRAINT `penyewaan_mobil_ibfk_1` FOREIGN KEY (`kendaraan_idmobil`) REFERENCES `kendaraan` (`idmobil`),
  ADD CONSTRAINT `penyewaan_mobil_ibfk_2` FOREIGN KEY (`garasi_idgarasi`) REFERENCES `garasi` (`idgarasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
