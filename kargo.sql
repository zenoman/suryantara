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
	(8, 'darat003', 'superadmin', '74b213f68f648006a318f52713450f27', 'super admin', '0923490238490', 'damara@gmal.com', 'gurah kediri', 'admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table kargo.omset
DROP TABLE IF EXISTS `omset`;
CREATE TABLE IF NOT EXISTS `omset` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) DEFAULT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text,
  `status` enum('pendapatan','pengeluaran') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.omset: ~0 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~29 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `total_biaya`, `keterangan`, `status`, `satuan`, `metode_bayar`) VALUES
	(3, 'KDR181218-06-000003', NULL, 'SJ201218-06-000001', 'devasatrio', 'lampu manten', 'darat', 'kediri', 'malang', '2018-12-18', 3, 3, '20 x 30 x 20', '3', 'hari', 'mega', '023984902', '9203489028', 9000, 10000, 0, 90, 0, 0, 19090, 'asdfasd', 'Y', 'kg', 'bt'),
	(4, 'KDR191218-06-000004', NULL, 'SJ201218-06-000001', 'devasatrio', 'motor supra', 'laut', 'kediri', 'kalimantan', '2018-12-19', 3, 8, '30 x 20 x 50', '7.5', 'handri', 'jeki', '029384290', '290384290', 320000, 1300, 0, 3200, 0, 0, 321300, 'askldjklsf', 'Y', 'kg', 'bt'),
	(5, 'KDR191218-06-000005', NULL, 'SJ211218-06-000002', 'devasatrio', 'perabot masak', 'laut', 'kediri', 'kalimantan', '2018-12-19', 3, 5, '30 x 20 x 30', '4.5', 'dini', 'suko', '90284902', '902348902', 200000, 3000, 10000, 2000, 0, 0, 213000, 'askldfjsdklf', 'Y', 'kg', 'cash'),
	(6, 'KDR211218-06-000006', NULL, 'SJ211218-06-000003', 'devasatrio', 'celana cewek', 'darat', 'kediri', 'magelang', '2018-12-21', 4, 5, '30 x 20 x 30', '4.5', 'hadi', 'dendi', '092834902890', '0938492', 50000, 200, 1000, 500, 0, 0, 51700, 'aklsdjskldf', 'Y', 'kg', 'cash'),
	(9, 'KDR221218-06-000009', NULL, 'SJ221218-06-000005', 'devasatrio', 'aklfjdakl', 'darat', 'ksdjafkl', 'malang', '2018-12-22', 2, 5, '30 x 20 x 30', '4.5', 'ksadjf', 'skljfdk', '9028902', '890890', 3000, 2000, 1000, 30, 0, 0, 6030, 'asfs', 'Y', 'koli', 'cash'),
	(11, 'KDR241218-06-000010', '0001', 'SJ251218-06-000006', 'devasatrio', 'kljklj', 'udara', 'kediri', 'alor', '2018-12-24', 1, 2, '10 x 20 x 40', '2', 'ga', 'ha', '98789', '878989', 80000, 0, 0, 800, 25000, 1200, 107000, 'kljkl', 'Y', 'kg', 'cash'),
	(12, 'KDR241218-06-000011', '0002', NULL, 'devasatrio', 'halo2', 'udara', 'kediri', 'balikpapan', '2018-12-24', 5, 4, '20 x 20 x 40', '4', 'gaa', 'haa', '012', '012', 44000, 0, 0, 440, 25000, 1060, 70500, 'ini comen', 'Y', 'koli', 'bt'),
	(15, 'KDR251218-06-000014', '123 - 456789025', NULL, 'devasatrio', 'mesin mobil ferguso', 'udara', 'kediri', 'ambon', '2018-12-25', 1, 3, '20 x 30 x 20', '3', 'hari', 'deni', '902348290', '029384902', 109500, 0, 0, 1095, 25000, 1005, 136600, 'eri', 'N', 'kg', 'cash'),
	(16, 'KDR251218-06-000015', NULL, NULL, 'devasatrio', 'deini', 'udara', 'kediri', 'ambon', '2018-12-25', 2, 12, '20 x 30 x 20', '3', 'saf', 'ksjadklf', '023948', '90843', 438000, 0, 0, 4380, 25000, 1080, 468460, 'cepet ya cuy', 'N', 'kg', 'cash'),
	(17, 'KDR251218-06-000016', '121212', 'SJ251218-06-000006', 'devasatrio', 'jilbab pubg mobile', 'udara', 'kediri', 'alor', '2018-11-25', 1, 3, '20 x 30 x 20', '3', 'deni', 'hari', '02394890', '09823490', 120000, 0, 0, 1200, 25000, 800, 147000, 'cepet ya', 'N', 'kg', 'cash'),
	(18, 'KDR271218-07-000001', NULL, 'SJ271218-06-000008', 'harianti', 'sepatu nike', 'darat', 'kediri', 'magelang', '2018-12-27', 2, 3, '20 x 30 x 20', '3', 'hari', 'dinda', '019212348761', '092791648267', 30000, 2000, 500, 300, 0, 0, 32800, 'cepet ya', 'N', 'kg', 'cash'),
	(20, 'KDR271218-07-000003', NULL, 'SJ271218-06-000008', 'harianti', 'meja lipat', 'laut', 'kediri', 'kalimantan', '2018-12-27', 3, 5, '30 x 20 x 30', '4.5', 'heru', 'indah sari', '984719471209', '034819272937', 200000, 18000, 1000, 2000, 0, 0, 221000, 'cepet ya', 'N', 'koli', 'cash'),
	(22, 'KDR271218-07-000005', NULL, NULL, 'harianti', 'laptop asus', 'laut', 'kediri', 'kalimantan', '2018-12-27', 1, 3, '30 x 20 x 20', '3', 'dani', 'ina', '093919381984', '092837481938', 20000, 800, 2000, 200, 0, 0, 23000, 'halo', 'N', 'koli', 'bt'),
	(23, 'KDR271218-07-000006', NULL, NULL, 'harianti', 'lego star wars', 'laut', 'kediri', 'manadi', '2018-12-27', 1, 2, '30 x 20 x 10', '1.5', 'harianto', 'nana', '0934802834909', '9023482039809', 50000, 2500, 500, 500, 0, 0, 53500, 'halo halo', 'N', 'kg', 'cash'),
	(24, 'KDR271218-07-000007', NULL, 'SJ271218-06-000008', 'harianti', 'ban mobil', 'udara', 'kediri', 'balikpapan', '2018-12-27', 1, 2, '30 x 20 x 10', '1.5', 'hadii', 'heri', '03948290298247', '03948091283490', 150000, 0, 0, 1500, 25000, 20000, 196500, 'klasdfjlskadf', 'N', 'koli', 'bt'),
	(26, 'KDR271218-07-000009', '123 - 0983948', 'SJ271218-06-000008', 'harianti', 'bella square', 'udara', 'kediri', 'balikpapan', '2018-12-27', 1, 2, '30 x 20 x 10', '1.5', 'hari', 'didi', '029348290', '2409200', 200000, 0, 0, 2000, 25000, 3000, 230000, 'halo', 'Y', 'koli', 'cash'),
	(27, 'KDR281218-07-000001', NULL, NULL, 'harianti', 'speker', 'darat', 'kediri', 'malang', '2018-12-28', 2, 3, '20 x 30 x 20', '3', 'haris', 'palevi', '092384902', '023890290', 9000, 1000, 10, 90, 0, 0, 10100, 'lakdsfjkl', 'N', 'kg', 'cash'),
	(28, 'KDR281218-07-000002', NULL, NULL, 'harianti', 'sabuk sekolah', 'darat', 'kediri', 'blitar', '2018-12-28', 1, 2, '30 x 20 x 10', '1.5', 'ina', 'harni', '902834902390', '029384902900', 6000, 2000, 140, 60, 0, 0, 8200, 'akldfj', 'N', 'kg', 'bt'),
	(29, 'KDR281218-07-000003', NULL, NULL, 'harianti', 'mobil bayi', 'laut', 'kediri', 'kalimantan', '2018-12-28', 1, 12, '20 x 40 x 60', '12', 'dendi', 'oki', '09123482900', '02938492089', 200000, 18000, 0, 2000, 0, 0, 220000, 'askldfjal', 'N', 'koli', 'bt'),
	(30, 'KDR281218-07-000004', NULL, NULL, 'harianti', 'bola bowling', 'laut', 'kediri', 'manado', '2018-12-28', 1, 3, '20 x 30 x 15', '2.25', 'dini', 'harko', '02913842900', '2394829000', 120000, 800, 2000, 1200, 0, 0, 124000, 'cepet ya', 'N', 'kg', 'cash'),
	(31, 'KDR281218-07-000005', NULL, NULL, 'harianti', 'lampu taman', 'udara', 'kediri', 'balikpapan', '2018-12-28', 5, 5, '30 x 20 x 30', '4.5', 'hari', 'dina', '029384290', '293482900', 110000, 0, 0, 1100, 25000, 900, 137000, 'cepte', 'N', 'kg', 'cash'),
	(32, 'KDR281218-07-000006', NULL, NULL, 'harianti', 'jam tangan', 'udara', 'kediri', 'alor', '2018-12-28', 5, 2, '30 x 20 x 10', '1.5', 'sindi', 'nanda', '93480294809', '0239489028490', 400000, 0, 0, 4000, 25000, 1000, 430000, 'halo', 'N', 'koli', 'bt');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~10 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`) VALUES
	(1, 'devasatrio', 'SJ201218-06-000001', 'PT tani mundur jaya-0923820938', '2018-12-21', 'P', 11, 6, 0, 340390, 25000, 'Jln saguling no 1 malang'),
	(4, 'devasatrio', 'SJ211218-06-000002', 'PT Moro Dadi-098329', '2018-12-21', 'P', 5, 3, 213000, 0, 20000, 'Jln badut ulang tahun no 3 magelang'),
	(5, 'devasatrio', 'SJ211218-06-000003', 'PT tani mundur jaya-0923820938', '2018-12-21', 'P', 5, 4, 51700, 0, 3000, 'Jln saguling no 1 malang'),
	(7, 'devasatrio', 'SJ221218-06-000005', 'PT tani mundur jaya-0923820938', '2018-12-25', 'P', 5, 2, 6030, 0, 70000, 'Jln saguling no 1 malang'),
	(8, 'devasatrio', 'SJ251218-06-000006', 'PT tani mundur jaya-0923820938', '2018-12-25', 'P', 5, 2, 254000, 0, 67000, 'Jln saguling no 1 malang'),
	(10, 'devasatrio', 'SJ271218-06-000008', 'PT Moro Dadi-098329', '2018-12-27', 'P', 12, 7, 483800, 196500, 60000, 'Jln badut ulang tahun no 3 magelang');
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
  `perkg` int(11) DEFAULT '0',
  `minimal_heavy` int(11) DEFAULT '0',
  `biaya_dokumen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_udara: ~4 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `perkg`, `minimal_heavy`, `biaya_dokumen`) VALUES
	(1, 'udara001', 'ambon', 'lion normal rate (JT 786)', 36500, 50, 25000),
	(2, 'udara002', 'alor', 'sriwijaya', 40000, 100, 25000),
	(3, 'udara003', 'balikpapan', 'Lion NR (selain 360,262)', 22000, 50, 25000),
	(4, 'udara004', 'balikpapan', 'citilink (QG-430)', 23000, 55, 25000);
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
	(3, 'vendor001', 'PT tani mundur jaya', '0923820938', 'Jln saguling no 1 malang', 'Y'),
	(4, 'vendor002', 'PT Iwak Enak', '0938409', 'mungkung loceret nganjuk', 'N'),
	(5, 'vendor003', 'PT Moro Dadi', '098329', 'Jln badut ulang tahun no 3 magelang', 'N');
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
