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
  `level` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~3 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`, `level`) VALUES
	(6, 'admin001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari', 'programer'),
	(7, 'admin002', 'harianti', '25d55ad283aa400af464c76d713c07ad', 'harianto', '085604556712', 'harianto@gmail.com', 'magersari gurah depan pga', 'admin'),
	(8, 'darat003', 'superadmin', '74b213f68f648006a318f52713450f27', 'super admin', '0923490238490', 'damara123@gmal.com', 'gurah kediri', 'admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table kargo.omset
DROP TABLE IF EXISTS `omset`;
CREATE TABLE IF NOT EXISTS `omset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(5) DEFAULT NULL,
  `tahun` int(5) DEFAULT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `pengeluaran_lainya` int(11) DEFAULT NULL,
  `laba` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.omset: ~0 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
INSERT INTO `omset` (`id`, `bulan`, `tahun`, `pemasukan`, `pengeluaran`, `pengeluaran_lainya`, `laba`) VALUES
	(1, 1, 2018, 342500, 130000, 40000, 172500);
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- Dumping structure for table kargo.pengeluaran_lain
DROP TABLE IF EXISTS `pengeluaran_lain`;
CREATE TABLE IF NOT EXISTS `pengeluaran_lain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(200) DEFAULT NULL,
  `kategori` varchar(40) DEFAULT NULL,
  `keterangan` text,
  `jumlah` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `gambar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pengeluaran_lain: ~4 rows (approximately)
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
INSERT INTO `pengeluaran_lain` (`id`, `admin`, `kategori`, `keterangan`, `jumlah`, `tgl`, `gambar`) VALUES
	(8, 'devasatrio', 'bbm', 'beli bensin', 30000, '2019-01-02', '1546440740-logo.jpg'),
	(9, 'devasatrio', 'parkir', 'parkir mobil', 20000, '2019-01-03', '1546477524-logo.jpg'),
	(10, 'devasatrio', 'tol', 'bayar tol surabaya', 3000, '2019-02-03', '1546482244-img-20181126-wa0003.jpg'),
	(11, 'devasatrio', 'parkir', 'parkir jet', 40000, '2018-12-03', '1546484974-img-20181023-wa0023.jpg'),
	(12, 'devasatrio', 'parkir', 'parkir mobil putih', 2000, '2019-01-04', '1546576232-favicon.png');
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

-- Dumping structure for table kargo.resi_pengiriman
DROP TABLE IF EXISTS `resi_pengiriman`;
CREATE TABLE IF NOT EXISTS `resi_pengiriman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_resi` text,
  `no_smu` text,
  `kode_jalan` text,
  `admin` varchar(100) DEFAULT NULL,
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
  `biaya_kirim` int(11) DEFAULT '0',
  `biaya_packing` int(11) DEFAULT '0',
  `biaya_asuransi` int(11) DEFAULT '0',
  `biaya_ppn` int(11) DEFAULT '0',
  `biaya_smu` int(11) DEFAULT '0',
  `biaya_karantina` int(11) DEFAULT '0',
  `total_biaya` int(11) DEFAULT '0',
  `keterangan` text,
  `status` enum('Y','N','US','RS') DEFAULT 'N',
  `satuan` varchar(10) DEFAULT NULL,
  `metode_bayar` enum('cash','bt') DEFAULT 'cash',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~7 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `total_biaya`, `keterangan`, `status`, `satuan`, `metode_bayar`) VALUES
	(1, 'KDR291218-06-000001', NULL, 'SJ291218-06-000002', 'devasatrio', 'sepatu bola', 'darat', 'kediri', 'malang', '2018-12-29', 1, 8, '20 x 30 x 50', '7.5', 'deni', 'hadi', '0932749', '02934890', 24000, 2000, 60, 240, 0, 0, 26300, 'halo halo', 'N', 'kg', 'bt'),
	(2, 'KDR291218-06-000002', '4354345', 'SJ291218-06-000001', 'devasatrio', 'jkhjkhc', 'udara', 'hghghj', 'alor', '2018-12-29', 1, 3, '20 x 30 x 20', '3', 'ewre', 'werwer', '56456', '7687', 120000, 0, 0, 1200, 25000, 40000, 186200, 'dfsfd', 'Y', 'kg', 'bt'),
	(3, 'KDR291218-06-000003', NULL, 'SJ291218-06-000002', 'devasatrio', 'sepatu bola', 'laut', 'kediri', 'kalimantan', '2018-12-28', 1, 3, '30 x 10 x 30', '2.25', 'hari', 'dini', '027348628734678', '873248927389247', 120000, 8000, 800, 1200, 0, 0, 130000, 'halo halo', 'N', 'kg', 'cash'),
	(4, 'KDR020119-06-000001', NULL, 'SJ020119-06-000001', 'devasatrio', 'sepatu kuda', 'darat', 'kediri', 'malang', '2019-01-02', 1, 3, '20 x 30 x 20', '3', 'heri', 'marno', '02348920', '039485903', 9000, 1010, 900, 90, 0, 0, 11000, 'cepet ya', 'N', 'kg', 'bt'),
	(5, 'KDR020119-06-000002', NULL, 'SJ020119-06-000001', 'devasatrio', 'rokok surya', 'laut', 'kediri', 'sumatra', '2019-01-02', 1, 4, '30 x 50 x 10', '3.75', 'hasan', 'fulan', '093284902', '289048290', 120000, 800, 1000, 1200, 0, 0, 123000, 'cepet ya', 'N', 'kg', 'cash'),
	(6, 'KDR020119-06-000003', '256 - 8981290', 'SJ020119-06-000001', 'devasatrio', 'hanger baju', 'udara', 'kediri', 'balikpapan', '2019-01-02', 1, 3, '20 x 30 x 20', '3', 'indah', 'sari', '092384902', '0293480', 69000, 0, 0, 690, 25000, 4000, 98690, 'cepet ya gan', 'N', 'kg', 'bt'),
	(7, 'KDR020119-06-000004', NULL, 'SJ020119-06-000002', 'devasatrio', 'koper', 'darat', 'kediri', 'nganjuk', '2019-01-02', 1, 3, '20 x 30 x 20', '3', 'hendri', 'dini', '902384902', '029384902', 7500, 2500, 25, 75, 0, 0, 10100, 'asdf', 'N', 'kg', 'cash'),
	(8, 'KDR020119-06-000005', NULL, 'SJ020119-06-000002', 'devasatrio', 'casing hp', 'darat', 'kediri', 'malang', '2019-01-02', 1, 1, '30 x 20 x 10', '1.5', 'hina', 'hiwa', '0923489290', '093484590', 20000, 800, 0, 200, 0, 0, 21000, 'celkawj', 'N', 'koli', 'bt');
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
  `header` varchar(100) DEFAULT NULL,
  `landing` varchar(100) DEFAULT NULL,
  `sapaan` varchar(100) DEFAULT NULL,
  `desk` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `bulan_sekarang` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.setting: ~1 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', 1);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table kargo.surat_jalan
DROP TABLE IF EXISTS `surat_jalan`;
CREATE TABLE IF NOT EXISTS `surat_jalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(100) DEFAULT NULL,
  `kode` text,
  `tujuan` text,
  `tgl` date DEFAULT NULL,
  `status` enum('Y','N','P') DEFAULT 'N',
  `totalkg` int(11) DEFAULT NULL,
  `totalkoli` int(11) DEFAULT NULL,
  `totalcash` int(11) DEFAULT NULL,
  `totalbt` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `alamat_tujuan` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~4 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`) VALUES
	(1, 'devasatrio', 'SJ291218-06-000001', 'PT Iwak Enak-083223336313', '2018-12-29', 'P', 3, 1, 0, 186200, 50000, 'mungkung loceret nganjuk'),
	(2, 'devasatrio', 'SJ291218-06-000002', 'PT tani mundur jaya-085552344556', '2018-12-29', 'P', 11, 2, 130000, 26300, 80000, 'Jln saguling no 1 malang'),
	(3, 'devasatrio', 'SJ020119-06-000001', 'PT Moro Dadi-082122272212', '2019-01-02', 'P', 10, 3, 123000, 109690, 30000, 'Jln badut ulang tahun no 3 magelang'),
	(4, 'devasatrio', 'SJ020119-06-000002', 'PT tani mundur jaya-085552344556', '2019-01-02', 'P', 4, 2, 10100, 21000, 25000, 'Jln saguling no 1 malang');
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

-- Dumping data for table kargo.tarif_darat: ~5 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(1, 'DD154', 'kediri  lagi', 3123, 1231, 'sadasd'),
	(2, 'darat01', 'nganjuk', 2500, 1, '5'),
	(3, 'darat02', 'blitar', 3000, 1, '6'),
	(4, 'darat03', 'malang', 3000, 6, '2'),
	(5, 'darat04', 'magelang', 10000, 4, '3');
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

-- Dumping data for table kargo.tarif_laut: ~4 rows (approximately)
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
  `perkg` int(11) DEFAULT '0',
  `minimal_heavy` int(11) DEFAULT '0',
  `biaya_dokumen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_udara: ~4 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `perkg`, `minimal_heavy`, `biaya_dokumen`) VALUES
	(1, 'udara001', 'ambon', 'lion normal rate (JT 786)', 36500, 50, 25000),
	(2, 'udara002', 'alor', 'sriwijaya', 40000, 100, 25000),
	(3, 'udara003', 'balikpapan', 'Lion NR (selain 360,262)', 22000, 50, 25000),
	(4, 'udara004', 'balikpapan', 'citilink (QG-430)', 23000, 55, 25000),
	(5, 'udara005', 'bojonegoro', 'Lion NR (selain 360,262)', 40000, 100, 25000);
/*!40000 ALTER TABLE `tarif_udara` ENABLE KEYS */;

-- Dumping structure for table kargo.vendor
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvendor` varchar(100) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `cabang` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~3 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`) VALUES
	(3, 'vendor001', 'PT tani mundur jaya', '085552344556', 'Jln saguling no 1 malang', 'Y'),
	(4, 'vendor002', 'PT Iwak Enak', '083223336313', 'mungkung loceret nganjuk', 'N'),
	(5, 'vendor003', 'PT Moro Dadi', '082122272212', 'Jln badut ulang tahun no 3 magelang', 'N');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

-- Dumping structure for trigger kargo.editadmin
DROP TRIGGER IF EXISTS `editadmin`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `editadmin` BEFORE UPDATE ON `admin` FOR EACH ROW BEGIN
update resi_pengiriman set admin=new.username where admin=old.username;
update surat_jalan set admin=new.username where admin=old.username;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.editvendor
DROP TRIGGER IF EXISTS `editvendor`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `editvendor` BEFORE UPDATE ON `vendor` FOR EACH ROW BEGIN
update surat_jalan set tujuan=concat(new.vendor,'-',new.telp) where tujuan=concat(old.vendor,'-',old.telp);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.hapus_suratjalan
DROP TRIGGER IF EXISTS `hapus_suratjalan`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `hapus_suratjalan` BEFORE DELETE ON `surat_jalan` FOR EACH ROW BEGIN
delete from resi_pengiriman where resi_pengiriman.kode_jalan = old.kode;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
