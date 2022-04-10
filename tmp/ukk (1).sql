-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2022 at 03:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` varchar(50) NOT NULL,
  `id_pesanan` varchar(50) NOT NULL,
  `id_masakan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `keterangan_pesanan` text NOT NULL,
  `status_detail_masakan` enum('sedang dimasak','sudah siap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_masakan`, `qty`, `sub_total`, `keterangan_pesanan`, `status_detail_masakan`) VALUES
('DTL002', 'PSN002', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL003', 'PSN011', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL004', 'PSN014', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL005', 'PSN014', 'MKN007', 2, 199998, '', 'sedang dimasak'),
('DTL006', 'PSN016', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL009', 'PSN019', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL010', 'PSN019', 'MKN004', 3, 7500, '', 'sedang dimasak'),
('DTL011', 'PSN020', 'MKN002', 4, 8000, '', 'sedang dimasak'),
('DTL012', 'PSN020', 'MKN007', 2, 199998, '', 'sedang dimasak'),
('DTL013', 'PSN022', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL014', 'PSN023', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL015', 'PSN024', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL016', 'PSN024', 'MKN002', 4, 8000, 'Agak Pedes', 'sedang dimasak'),
('DTL017', 'PSN025', 'MKN001', 68, 2040000, 'pedes', 'sedang dimasak'),
('DTL018', 'PSN025', 'MKN003', 35, 560000, 'pake kacang', 'sedang dimasak'),
('DTL019', 'PSN026', 'MKN001', 68, 2040000, 'PEDESSSSSSSSSSSSSSSSSSSSSSS', 'sedang dimasak'),
('DTL020', 'PSN027', 'MKN001', 68, 2040000, 'asdasd', 'sedang dimasak'),
('DTL021', 'PSN027', 'MKN004', 2, 5000, 'asdasd', 'sedang dimasak'),
('DTL022', 'PSN028', 'MKN001', 68, 2040000, 'aaaaaaaaaaaaaaaaaaaaa', 'sedang dimasak'),
('DTL023', 'PSN028', 'MKN004', 2, 5000, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'sedang dimasak'),
('DTL024', 'PSN029', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL025', 'PSN029', 'MKN004', 2, 5000, '', 'sedang dimasak'),
('DTL026', 'PSN030', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL027', 'PSN030', 'MKN002', 4, 8000, '', 'sedang dimasak'),
('DTL028', 'PSN031', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL029', 'PSN032', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL030', 'PSN032', 'MKN001', 68, 2040000, '', 'sedang dimasak'),
('DTL031', 'PSN032', 'MKN004', 2, 5000, '', 'sedang dimasak'),
('DTL032', 'PSN032', 'MKN004', 2, 5000, '', 'sedang dimasak');

-- --------------------------------------------------------

--
-- Table structure for table `masakan`
--

CREATE TABLE `masakan` (
  `id_masakan` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `nama_masakan` varchar(50) NOT NULL,
  `type` enum('makanan','minuman') NOT NULL,
  `status_masakan` enum('tersedia','habis') NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masakan`
--

INSERT INTO `masakan` (`id_masakan`, `gambar`, `nama_masakan`, `type`, `status_masakan`, `harga`) VALUES
('MKN001', '', 'Rendang', 'makanan', 'tersedia', 30000),
('MKN002', '', 'Lontong', 'makanan', 'tersedia', 2000),
('MKN003', '', 'Roti Bakar', 'makanan', 'tersedia', 16000),
('MKN004', 'null.jpg', 'Es Teh', 'minuman', 'tersedia', 2500),
('MKN005', 'bull.jpg', 'Es Jeruk', 'minuman', 'tersedia', 2500),
('MKN006', 'null.jpg', 'Es Degan', 'minuman', 'tersedia', 7000),
('MKN007', 'bull.jpg', 'Essemuu', 'minuman', 'tersedia', 99999);

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `status_meja` enum('kosong','penuh','bungkus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `no_meja`, `status_meja`) VALUES
(1, 0, 'bungkus'),
(2, 1, 'penuh'),
(3, 2, 'kosong'),
(4, 3, 'kosong'),
(5, 4, 'kosong'),
(6, 5, 'penuh'),
(7, 6, 'kosong');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(50) NOT NULL,
  `tgl_pesanan` date NOT NULL DEFAULT current_timestamp(),
  `id_user` varchar(50) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_pesanan` enum('dibawa pulang','dimakan ditempat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `tgl_pesanan`, `id_user`, `id_meja`, `total_harga`, `status_pesanan`) VALUES
('PSN002', '2022-03-13', 'USR005', 6, 2040000, 'dimakan ditempat'),
('PSN011', '2022-03-13', 'USR005', 4, 60000, 'dimakan ditempat'),
('PSN014', '2022-03-13', 'USR005', 2, 259998, 'dimakan ditempat'),
('PSN016', '2022-03-13', 'USR005', 1, 360000, 'dibawa pulang'),
('PSN019', '2022-03-14', 'USR006', 1, 67500, 'dibawa pulang'),
('PSN020', '2022-03-16', 'USR005', 2, 201998, 'dimakan ditempat'),
('PSN022', '2022-03-16', 'USR002', 2, 60000, 'dimakan ditempat'),
('PSN023', '2022-03-16', 'USR002', 3, 60000, 'dimakan ditempat'),
('PSN024', '2022-03-16', 'USR002', 5, 64000, 'dimakan ditempat'),
('PSN025', '2022-03-19', 'USR005', 4, 62000, 'dimakan ditempat'),
('PSN026', '2022-03-19', 'USR005', 3, 60000, 'dimakan ditempat'),
('PSN027', '2022-03-19', 'USR005', 3, 65000, 'dimakan ditempat'),
('PSN028', '2022-03-19', 'USR005', 3, 65000, 'dimakan ditempat'),
('PSN029', '2022-03-20', 'USR005', 3, 65000, 'dimakan ditempat'),
('PSN030', '2022-04-06', 'USR001', 4, 1200000, 'dimakan ditempat'),
('PSN031', '2022-04-06', 'USR001', 5, 60000, 'dimakan ditempat'),
('PSN032', '2022-04-07', 'USR005', 1, 4090000, 'dibawa pulang');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Kasir','Waiter','Owner','Pembeli') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
('USR001', 'Afifh Abimanyu', 'rynxo', '1234', 'Owner'),
('USR002', 'Jonathan Liandi', 'admin', '1234', 'Admin'),
('USR003', 'Susilo Bambam', 'kasir', 'kasir', 'Kasir'),
('USR004', 'Justin Paul', 'waiter', 'waiter', 'Waiter'),
('USR005', 'Diaz Djanuarta', 'dija', '1234', 'Pembeli'),
('USR006', 'Lanang Purwanto', 'lng', '1234', 'Pembeli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_masakan` (`id_masakan`);

--
-- Indexes for table `masakan`
--
ALTER TABLE `masakan`
  ADD PRIMARY KEY (`id_masakan`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_meja` (`id_meja`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_masakan`) REFERENCES `masakan` (`id_masakan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
