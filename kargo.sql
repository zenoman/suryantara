-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for kargo
DROP DATABASE IF EXISTS `kargo`;
CREATE DATABASE IF NOT EXISTS `kargo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kargo`;

-- Dumping structure for table kargo.admin
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~2 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`) VALUES
	(6, 'admin001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari'),
	(7, 'admin002', 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', '085604556712', 'ridho.rezky.07@gmail.com', 'magersari gurah');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table kargo.detail_sj
DROP TABLE IF EXISTS `detail_sj`;
CREATE TABLE IF NOT EXISTS `detail_sj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` text,
  `no_resi` text,
  `penerima` varchar(40) DEFAULT NULL,
  `alamat` varchar(70) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `isi` text,
  `berat` int(11) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.detail_sj: ~4 rows (approximately)
DELETE FROM `detail_sj`;
/*!40000 ALTER TABLE `detail_sj` DISABLE KEYS */;
INSERT INTO `detail_sj` (`id`, `kode`, `no_resi`, `penerima`, `alamat`, `jumlah`, `isi`, `berat`, `satuan`) VALUES
	(1, 'SJ121218-06-000001', '101218-06-000001', 'hari', 'kediri', 2, 'sepatu bola + jersey', 16, NULL),
	(2, 'SJ121218-06-000001', '111218-06-000007', 'hadi', 'sdkfj', 10, 'mouse gaming', 8, NULL),
	(3, 'SJ121218-06-000001', '111218-06-000006', 'hendro', 'malang', 3, 'keyboard', 8, NULL),
	(4, 'SJ121218-06-000001', '101218-06-000003', 'dedi', 'gurah', 3, 'kerudung mantul', 2, NULL);
/*!40000 ALTER TABLE `detail_sj` ENABLE KEYS */;

-- Dumping structure for table kargo.pendapatan
DROP TABLE IF EXISTS `pendapatan`;
CREATE TABLE IF NOT EXISTS `pendapatan` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `tgl` varchar(100) DEFAULT NULL,
  `pendapatan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.pendapatan: ~0 rows (approximately)
DELETE FROM `pendapatan`;
/*!40000 ALTER TABLE `pendapatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendapatan` ENABLE KEYS */;

-- Dumping structure for table kargo.resi_pengiriman
DROP TABLE IF EXISTS `resi_pengiriman`;
CREATE TABLE IF NOT EXISTS `resi_pengiriman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_resi` text,
  `kode_jalan` text,
  `id_admin` int(11) DEFAULT NULL,
  `nama_barang` text,
  `pengiriman_via` enum('darat','laut','udara') DEFAULT NULL,
  `kota_asal` varchar(40) DEFAULT NULL,
  `kode_tujuan` text,
  `tgl` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `dimensi` varchar(30) DEFAULT NULL,
  `ukuran_volume` varchar(30) DEFAULT NULL,
  `nama_pengirim` varchar(70) DEFAULT NULL,
  `nama_penerima` varchar(70) DEFAULT NULL,
  `telp_pengirim` varchar(20) DEFAULT NULL,
  `telp_penerima` varchar(20) DEFAULT NULL,
  `biaya_kirim` varchar(20) DEFAULT NULL,
  `biaya_packing` varchar(20) DEFAULT NULL,
  `biaya_asuransi` varchar(20) DEFAULT NULL,
  `total_biaya` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `status` enum('Y','N') DEFAULT 'N',
  `satuan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~9 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `kode_jalan`, `id_admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `total_biaya`, `keterangan`, `status`, `satuan`) VALUES
	(1, '101218-06-000001', NULL, 6, 'sepatu bola + jersey', 'darat', 'kediri', 'malang', '2018-12-10', 2, 16, '30 x 40 x 50', '15', 'harko', 'udin', '0293482930490', '023489239', '2000', '3000', '4000', '9000', 'halo halo', 'N', 'koli'),
	(2, '101218-06-000002', NULL, 6, 'ram laptop', 'darat', 'kediri', 'blitar', '2018-12-10', 2, 1, '8 x 10 x 5', '0.1', 'hedro', 'dini', '09384209893', '03928493', '3000', '2000', '1000', '6000', 'halo ini coba', 'N', 'kg'),
	(3, '101218-06-000003', NULL, 6, 'kerudung mantul', 'laut', 'bekasi', 'kalimantan', '2018-12-10', 3, 2, '7 x 3 x 10', '0.0525', 'deni', 'hari', '09328493208', '09328949', '20000', '3000', '5000', '28000', 'laskdjklsjf', 'N', 'koli'),
	(4, '101218-06-000004', NULL, 6, 'alat masak', 'laut', 'kediri', 'maluku', '2018-12-10', 3, 4, '20 x 30 x 10', '1.5', 'heri', 'heru', '029849238', '90238490289', '100000', '2000', '500', '102500', 'slkjkasldfj', 'N', 'kg'),
	(5, '111218-06-000005', NULL, 6, 'lampu mobil', 'laut', 'kediri', 'sumatra', '2018-12-11', 5, 10, '20 x 30 x 20', '3', 'handi', 'harko', '029389', '02989032', '300000', '10000', '5000', '315000', 'halo halo', 'N', 'kg'),
	(6, '111218-06-000006', NULL, 6, 'keyboard', 'darat', 'kediri', 'malang', '2018-12-11', 3, 8, '20 x 30 x 10', '1.5', 'dendi', 'hadi', '09824390823490', '0923489023489', '24000', '0', '0', '24000', 'halo halo', 'N', 'kg'),
	(7, '111218-06-000007', NULL, 6, 'mouse gaming', 'darat', 'kediri', 'nganjuk', '2018-12-11', 10, 8, '20 x 10 x 30', '1.5', 'hari', 'dian', '093289', '983490', '10000', '0', '2000', '12000', 'halo', 'N', 'koli'),
	(8, '121218-06-000008', NULL, 6, 'sepatu kuda', 'darat', 'kediri', 'magelang', '2018-12-12', 5, 20, '20 x 30 x 40', '6', 'deni', 'hadi', '02394829034829', '2029384923', '10000', '3000', '0', '13000', 'halo halo', 'N', 'koli'),
	(9, '121218-06-000009', NULL, 6, 'rak sampah', 'darat', 'lampung', 'magelang', '2018-12-12', 1, 20, '20 x 30 x 50', '7.5', 'hendri', 'abi', '02938492', '0934892', '200000', '0', '10000', '210000', 'cepet ya', 'N', 'kg'),
	(10, '121218-06-000010', NULL, 6, 'sepatu', 'laut', 'kediri', 'manadi', '2018-12-12', 3, 2, '0 x 0 x 0', '0', 'hari anto', 'subandi', '0398429', '0389203', '50000', '0', '0', '50000', NULL, 'N', 'kg'),
	(11, '121218-06-000011', NULL, 6, 'jilbab cewek', 'darat', 'kediri', 'nganjuk', '2018-12-12', 3, 2, '20 x 10 x 20', '1', 'hartini', 'dandi', '0923849023', '03284932', '10000', '1000', '500', '11500', 'halo halo', 'N', 'koli');
/*!40000 ALTER TABLE `resi_pengiriman` ENABLE KEYS */;

-- Dumping structure for table kargo.setting
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

-- Dumping data for table kargo.setting: ~0 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1544326812-favicon.png', '1544326812-logo].png');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table kargo.surat_jalan
DROP TABLE IF EXISTS `surat_jalan`;
CREATE TABLE IF NOT EXISTS `surat_jalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` text,
  `tujuan` text,
  `tgl` varchar(15) DEFAULT NULL,
  `subtotal` varchar(15) DEFAULT NULL,
  `grand_total` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~0 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_jalan` ENABLE KEYS */;

-- Dumping structure for table kargo.tarif_darat
DROP TABLE IF EXISTS `tarif_darat`;
CREATE TABLE IF NOT EXISTS `tarif_darat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~4 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(1, 'DD154', 'kediri  lagi', 3123, 1231, 'sadasd'),
	(2, 'darat01', 'nganjuk', 2500, 1, '5'),
	(3, 'darat02', 'blitar', 3000, 1, '6'),
	(4, 'darat03', 'malang', 3000, 6, '2'),
	(5, 'darat04', 'magelang', 10000, 1, '3');
/*!40000 ALTER TABLE `tarif_darat` ENABLE KEYS */;

-- Dumping structure for table kargo.tarif_laut
DROP TABLE IF EXISTS `tarif_laut`;
CREATE TABLE IF NOT EXISTS `tarif_laut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_laut: ~3 rows (approximately)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(3, 'laut001', 'manadi', 25000, 5, '5'),
	(4, 'laut002', 'sumatra', 30000, 5, '3'),
	(5, 'laut003', 'kalimantan', 40000, 3, '3'),
	(6, 'laut004', 'manado', 40000, 1, '2');
/*!40000 ALTER TABLE `tarif_laut` ENABLE KEYS */;

-- Dumping structure for table kargo.tarif_udara
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

-- Dumping data for table kargo.tarif_udara: ~0 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `gencoKG`, `minimal`) VALUES
	(1, 'DD154', 'kediri lah', 'singo', 129, 12321342);
/*!40000 ALTER TABLE `tarif_udara` ENABLE KEYS */;

-- Dumping structure for table kargo.udara_kargo
DROP TABLE IF EXISTS `udara_kargo`;
CREATE TABLE IF NOT EXISTS `udara_kargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_udara` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.udara_kargo: ~3 rows (approximately)
DELETE FROM `udara_kargo`;
/*!40000 ALTER TABLE `udara_kargo` DISABLE KEYS */;
INSERT INTO `udara_kargo` (`id`, `kode_udara`, `tarif`, `persentase`) VALUES
	(2, '4', 98, 3434),
	(3, '1', 213, 3434),
	(4, '1', 222312, 12312323);
/*!40000 ALTER TABLE `udara_kargo` ENABLE KEYS */;

-- Dumping structure for table kargo.vendor
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvendor` varchar(100) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~0 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`) VALUES
	(2, 'd7676543', 'abi ihsan fadli', '0822342324434', 'gurah kediri');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
