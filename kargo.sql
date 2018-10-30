-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2018 at 03:06 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kargo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_kirim`
--

CREATE TABLE `detail_kirim` (
  `id` int(11) NOT NULL,
  `resi` text,
  `kode_jalan` text,
  `id_vendor` varchar(100) DEFAULT NULL,
  `tgl_berangkat` varchar(100) DEFAULT NULL,
  `barang` text,
  `pengirim` text,
  `penerima` text,
  `tujuan` text,
  `berat` text,
  `isi paket` text,
  `cash` int(11) DEFAULT NULL,
  `BT` int(11) DEFAULT NULL,
  `BL` int(11) DEFAULT NULL,
  `asuransi` int(11) DEFAULT NULL,
  `packing` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `Keterangan` text,
  `tgl_sampai` varchar(100) DEFAULT NULL,
  `foto_sj` varchar(100) DEFAULT NULL,
  `status` enum('sampai','belum') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  `pendapatan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tarif_darat`
--

CREATE TABLE `tarif_darat` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tarif_laut`
--

CREATE TABLE `tarif_laut` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tarif_udara`
--

CREATE TABLE `tarif_udara` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `airlans` varchar(100) DEFAULT NULL,
  `gencoKG` double DEFAULT NULL,
  `minimal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `udara_kargo`
--

CREATE TABLE `udara_kargo` (
  `id` int(11) NOT NULL,
  `kode_udara` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `idvendor` varchar(100) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_kirim`
--
ALTER TABLE `detail_kirim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif_darat`
--
ALTER TABLE `tarif_darat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif_laut`
--
ALTER TABLE `tarif_laut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif_udara`
--
ALTER TABLE `tarif_udara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `udara_kargo`
--
ALTER TABLE `udara_kargo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_kirim`
--
ALTER TABLE `detail_kirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarif_darat`
--
ALTER TABLE `tarif_darat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarif_laut`
--
ALTER TABLE `tarif_laut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarif_udara`
--
ALTER TABLE `tarif_udara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `udara_kargo`
--
ALTER TABLE `udara_kargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
