-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.36-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk kargo
DROP DATABASE IF EXISTS `kargo`;
CREATE DATABASE IF NOT EXISTS `kargo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kargo`;

-- membuang struktur untuk table kargo.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.admin: ~3 rows (lebih kurang)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`) VALUES
	(2, 'kkllkl', 'abiihsan', '096c24c72876f8aa7bfc04a10b83ded2', 'abi ihsan fadli', '0822342324434', 'ridho.rezky.07@gmail.com', 'gurah kediri'),
	(3, 'DD154', 'admin123', '123456789', 'kotak kotak', '0822342324434', 'abiihsa4n@gmail.com', 'kediri jjak'),
	(4, NULL, 'abiihsan', '121212', '', '', '', NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- membuang struktur untuk table kargo.detail_kirim
DROP TABLE IF EXISTS `detail_kirim`;
CREATE TABLE IF NOT EXISTS `detail_kirim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` enum('sampai','belum') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.detail_kirim: ~0 rows (lebih kurang)
DELETE FROM `detail_kirim`;
/*!40000 ALTER TABLE `detail_kirim` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_kirim` ENABLE KEYS */;

-- membuang struktur untuk table kargo.pendapatan
DROP TABLE IF EXISTS `pendapatan`;
CREATE TABLE IF NOT EXISTS `pendapatan` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `tgl` varchar(100) DEFAULT NULL,
  `pendapatan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.pendapatan: ~0 rows (lebih kurang)
DELETE FROM `pendapatan`;
/*!40000 ALTER TABLE `pendapatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendapatan` ENABLE KEYS */;

-- membuang struktur untuk table kargo.setting
DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaweb` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `kontak` varchar(45) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kargo.setting: ~0 rows (lebih kurang)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`) VALUES
	(1, 'kargo live', 'abihsan@gmail.com', '082261110369', '1540293331-nk.png', '1540293331-92734-images.png');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- membuang struktur untuk table kargo.tarif_darat
DROP TABLE IF EXISTS `tarif_darat`;
CREATE TABLE IF NOT EXISTS `tarif_darat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.tarif_darat: ~0 rows (lebih kurang)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(1, 'DD154', 'kediri  lagi', 3123, 1231, 'sadasd');
/*!40000 ALTER TABLE `tarif_darat` ENABLE KEYS */;

-- membuang struktur untuk table kargo.tarif_laut
DROP TABLE IF EXISTS `tarif_laut`;
CREATE TABLE IF NOT EXISTS `tarif_laut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.tarif_laut: ~2 rows (lebih kurang)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(2, 'DD154', 'kedirss', 31232, 1231, 'sadasd');
/*!40000 ALTER TABLE `tarif_laut` ENABLE KEYS */;

-- membuang struktur untuk table kargo.tarif_udara
DROP TABLE IF EXISTS `tarif_udara`;
CREATE TABLE IF NOT EXISTS `tarif_udara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `airlans` varchar(100) DEFAULT NULL,
  `gencoKG` double DEFAULT NULL,
  `minimal` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.tarif_udara: ~0 rows (lebih kurang)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `gencoKG`, `minimal`) VALUES
	(1, 'DD154', 'kediri lah', 'singo', 129, 12321342);
/*!40000 ALTER TABLE `tarif_udara` ENABLE KEYS */;

-- membuang struktur untuk table kargo.udara_kargo
DROP TABLE IF EXISTS `udara_kargo`;
CREATE TABLE IF NOT EXISTS `udara_kargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_udara` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.udara_kargo: ~4 rows (lebih kurang)
DELETE FROM `udara_kargo`;
/*!40000 ALTER TABLE `udara_kargo` DISABLE KEYS */;
INSERT INTO `udara_kargo` (`id`, `kode_udara`, `tarif`, `persentase`) VALUES
	(2, '4', 98, 3434),
	(3, '1', 213, 3434),
	(4, '1', 222312, 12312323);
/*!40000 ALTER TABLE `udara_kargo` ENABLE KEYS */;

-- membuang struktur untuk table kargo.vendor
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvendor` varchar(100) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.vendor: ~1 rows (lebih kurang)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`) VALUES
	(2, 'd7676543', 'abi ihsan fadli', '0822342324434', 'gurah kediri');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
