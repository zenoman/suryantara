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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~3 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`, `level`) VALUES
	(6, 'Admin-000001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari', 'programer'),
	(7, 'Admin-000002', 'harianti', '74b213f68f648006a318f52713450f27', 'harianto', '085604556712', 'harianto@gmail.com', 'magersari gurah depan pga', 'admin'),
	(9, 'Admin-000003', 'abiihsan', '74b213f68f648006a318f52713450f27', 'abi ihsan fadli', '098765546', 'abi@gmail.com', 'gurah', 'programer');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table kargo.gaji_karyawan
DROP TABLE IF EXISTS `gaji_karyawan`;
CREATE TABLE IF NOT EXISTS `gaji_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` varchar(20) DEFAULT NULL,
  `nama_karyawan` varchar(40) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `gaji_pokok` int(11) DEFAULT NULL,
  `uang_makan` int(11) DEFAULT NULL,
  `gaji_tambahan` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.gaji_karyawan: ~0 rows (approximately)
DELETE FROM `gaji_karyawan`;
/*!40000 ALTER TABLE `gaji_karyawan` DISABLE KEYS */;
/*!40000 ALTER TABLE `gaji_karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.jabatan
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(40) NOT NULL,
  `gaji_pokok` varchar(20) NOT NULL,
  `uang_makan` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.jabatan: ~4 rows (approximately)
DELETE FROM `jabatan`;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `jabatan`, `gaji_pokok`, `uang_makan`) VALUES
	(1, 'Base Managger', '400000', '30000'),
	(24, 'Staff', '400000', '30000'),
	(25, 'Staff Keuangan Pusat', '500000', '30000'),
	(26, 'Staff Keuangan Cabang', '400000', '30000');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;

-- Dumping structure for table kargo.karyawan
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.karyawan: ~7 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`) VALUES
	(1, 'Karyawan-000001', 'abi ihsan', '085755957230', 'kediri', 1),
	(2, 'Karyawan-000002', 'abi ihsan singo', '5654', 'kediri bajulan', 26),
	(3, 'Karyawan-000003', 'fadli', '57656', 'kediri', 25),
	(4, 'Karyawan-000004', 'singo', '65677', 'kediri', 26),
	(5, 'Karyawan-000005', 'hari anto', '0239482903890', 'gurah magersari', 24),
	(6, 'Karyawan-000006', 'herman', '2390482390', 'gurah', 24),
	(7, 'Karyawan-000007', 'dina', '2390482390', 'gurah', 24);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.kategori_barang
DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spesial_cargo` varchar(40) NOT NULL,
  `charge` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.kategori_barang: ~3 rows (approximately)
DELETE FROM `kategori_barang`;
/*!40000 ALTER TABLE `kategori_barang` DISABLE KEYS */;
INSERT INTO `kategori_barang` (`id`, `spesial_cargo`, `charge`) VALUES
	(1, 'Hewan Hidup', '100'),
	(2, 'Tanaman Hidup', '50'),
	(3, 'Meat / Frozen Food', '50');
/*!40000 ALTER TABLE `kategori_barang` ENABLE KEYS */;

-- Dumping structure for table kargo.omset
DROP TABLE IF EXISTS `omset`;
CREATE TABLE IF NOT EXISTS `omset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(5) DEFAULT NULL,
  `tahun` int(5) DEFAULT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `pengeluaran_lainya` int(11) DEFAULT NULL,
  `gaji_karyawan` int(11) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `laba` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.omset: ~0 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- Dumping structure for table kargo.pajak
DROP TABLE IF EXISTS `pajak`;
CREATE TABLE IF NOT EXISTS `pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(4) DEFAULT NULL,
  `tahun` int(9) DEFAULT NULL,
  `nama_pajak` varchar(150) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('bulanan','tahunan') DEFAULT 'bulanan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak: ~0 rows (approximately)
DELETE FROM `pajak`;
/*!40000 ALTER TABLE `pajak` DISABLE KEYS */;
/*!40000 ALTER TABLE `pajak` ENABLE KEYS */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pengeluaran_lain: ~0 rows (approximately)
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
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
  `berat` varchar(30) DEFAULT NULL,
  `dimensi` varchar(30) DEFAULT NULL,
  `ukuran_volume` varchar(30) DEFAULT NULL,
  `nama_pengirim` varchar(70) DEFAULT NULL,
  `nama_penerima` varchar(70) DEFAULT NULL,
  `telp_pengirim` varchar(20) DEFAULT NULL,
  `telp_penerima` varchar(20) DEFAULT NULL,
  `alamat_pengirim` text,
  `alamat_penerima` text,
  `biaya_kirim` int(11) DEFAULT '0',
  `biaya_packing` int(11) DEFAULT '0',
  `biaya_asuransi` int(11) DEFAULT '0',
  `biaya_ppn` int(11) DEFAULT '0',
  `biaya_smu` int(11) DEFAULT '0',
  `biaya_karantina` int(11) DEFAULT '0',
  `biaya_charge` int(11) DEFAULT '0',
  `total_biaya` int(11) DEFAULT '0',
  `biaya_suratjalan` int(11) DEFAULT '0',
  `keterangan` text,
  `status` enum('Y','N','US','RS') DEFAULT 'N',
  `satuan` varchar(10) DEFAULT NULL,
  `metode_bayar` enum('cash','bt') DEFAULT 'cash',
  `metode_input` enum('manual','otomatis') DEFAULT 'otomatis',
  `pemegang` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~11 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `total_biaya`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`) VALUES
	(1, '12345-001', NULL, 'SJ250219-06-000001', 'devasatrio', 'rokok surya', 'darat', 'kediri', 'malang', '2019-02-25', 1, '3', '20 x 30 x 20', '3.0', 'hari anto', 'dini suhardini', '0852389478237489', '085238947823472', 'akdlfsjaskldf asdjkfklasjdf asdjfklasjdf asdfjkasdf askdfksa sadkfjklasdf kasldfjklasdf', 'asdkljfkljsa sakdfjklasdf asdfjkklasdfj sadkfjklasdfjkl asdfkjklasdf klasjdfklasd fkljasdfkl asdklfj', 60000, 2000, 3000, 600, 0, 0, 0, 65600, 5000, 'kasldfjkasdf asdfj', 'N', 'kg', 'cash', 'manual', '5'),
	(2, '12345-002', NULL, NULL, 'devasatrio', 'sepatu kuda', 'darat', 'kediri', 'pare', '2019-02-25', 1, '16', '40 x 40 x 40', '16.0', 'hari', 'mani', '90890423890', '03489082390', 'kalsdjfklasd fklsadjf asdfj sdafkljaskldf', 'klasjdfklasd fjasdfkljasdklf kaslfjklasdfj askldfjklasdf', 400000, 2000, 5000, 4000, 0, 0, 0, 411000, 0, 'df', 'N', 'kg', 'cash', 'manual', '5'),
	(3, '12345-003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '5'),
	(4, '12345-004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '5'),
	(6, '12345-006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '3'),
	(8, '12345-009', NULL, 'SJ260219-06-000001', 'devasatrio', 'askdfjaskldf sadklfjklasdf asdjfklasjdfkl', 'udara', 'kediri', 'bali', '2019-02-25', 1, '4.0', '20 x 30 x 30', '3.0', 'aksldjfklasd', 'askdlfjksladf asdjfklasf', '0283490238490', '90233849028390', 'kjklafjkl asdjfklasjdf askdjfklasdf kasjfklas', 'jklasdfjklasdf asdfjklsadfjl adfsjklasdfjkl', 80000, 0, 0, 800, 5000, 2000, 0, 87800, 2000, 'skdf', 'N', 'kg', 'cash', 'manual', '3'),
	(9, '12345-010', '2938489234', 'SJ250219-06-000001', 'devasatrio', 'halaskldfjasdf', 'udara', 'kediri', 'bandung betet', '2019-02-25', 3, '33.5', '-', '-', 'harikasjf', 'asjdfklasdfj askdjfklasf', '9234820982390', '90238490238', 'jklasdfjkl asdfjklasdfj kasldjfklasdfj kasljdfklasf', 'jklsadfjkl asakjfklas dfklj', 670000, 0, 0, 6700, 5000, 2000, 0, 683700, 30000, 'kd', 'N', 'kg', 'cash', 'manual', '3'),
	(10, 'KDR250219-06-000001', NULL, 'SJ260219-06-000002', 'devasatrio', 'air mineral', 'darat', 'kediri', 'pare', '2019-02-25', 1, '4.5', '20 x 30 x 30', '4.5', 'hari', 'dendi', '029384903289032', '0923489238492384', 'klsjdfkjsakdf sdafjkasdjf asdfjsadjkl asdfjklasdfjksad fasjdfkljasdklfsa dfasjdkfasjdfkl adsfjlkadsfjkl', 'jksdlajksadf asjfjasfldjweiru sadjfkasdjf djsakfljksadlf ajsdfkljasfdk sadfjksadfjk dsafjkasdfjklasf asjdklfaklsf', 112500, 2000, 3000, 1125, 0, 0, 0, 118625, 5000, 'dk', 'N', 'kg', 'bt', 'otomatis', NULL),
	(11, 'KDR250219-06-000002', NULL, 'SJ260219-06-000001', 'devasatrio', 'oler 6 cop', 'laut', 'kediri', 'manado', '2019-02-25', 1, '16', '40 x 40 x 40', '16.0', 'hanun', 'hari', '092384902839402', '023489238902390', 'kasdjfklasdj asdjfksajf asdjfkladsf sdadjfkljsdkf asdfjksajfd safdjk asfjsakldf sajdfs afjsakdfjkasf sfjasdfkjsdaklf sadfjklasdf safjklasdf', 'klsadfjk asdfjkasjf asdjfklasjdf sdjfkasjdf asdjfksdfjksdf sdfjksdf sdfjksfajklasjf sajf', 640000, 3000, 4000, 6400, 0, 0, 0, 653400, 50000, 'dk', 'N', 'kg', 'cash', 'otomatis', NULL),
	(12, 'KDR250219-06-000003', '9032849238', 'SJ260219-06-000002', 'devasatrio', 'kursi hidrolik', 'udara', 'kediri', 'lampung', '2019-02-25', 2, '28.8', '-', '-', 'hari ono', 'dini andri', '02384902384902', '9248923048902390', 'klsfdjklsdaf sadjfksdajfkl sdafjklasdfjklsdadf sajdfkljsakldf sajdfkljsakldf asjfkjsadklfjaskdfl', 'ksldjfkasdfjkl asdfjkasdfjkl asddfjaskdlfjk asdfdjklsajfdk dfjkasjdf sdfjklsdfjklsjadfk sdajfksadjfklsa df', 576000, 0, 0, 5760, 2000, 4000, 576000, 1163760, 6000, 'd', 'N', 'kg', 'cash', 'otomatis', NULL),
	(13, 'KDR250219-06-000004', '2039892398', 'SJ260219-06-000002', 'devasatrio', 'rokok la', 'udara', 'kediri', 'bandung betet', '2019-02-25', 2, '10.0', '-', '-', 'aksldfjkas asjdfkjasdkfl', 'sakdfjksadf dsfjkjsadf', '2239048239090', '23094892389', 'ksdlaj sdfjksajdf ssjafdkljsaf sajfdklsjadfkl sadfjklsjadfkl sadfjklsdjfk sdfjskadfjkl sdfjklasdjf sadfjksadfj sadfjewiruiwre weruiw', 'aksldfjasdf asjdfkladsjfkksadf sadfjklsadjfklsadf sdafjksldfksdfkf sjdfkjsdfk sadfjksldfjkl adfkjklsadf sdjfksdajfjkl', 200000, 0, 0, 2000, 5000, 2000, 0, 209000, 9000, 'dj', 'N', 'kg', 'cash', 'otomatis', NULL);
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
  `desk_udara` text,
  `desk_laut` text,
  `desk_darat` text,
  `bulan_sekarang` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.setting: ~1 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `desk_udara`, `desk_laut`, `desk_darat`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', 2);
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
  `totalkg` varchar(50) DEFAULT NULL,
  `totalkoli` int(11) DEFAULT NULL,
  `totalcash` int(11) DEFAULT NULL,
  `totalbt` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `alamat_tujuan` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~3 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`) VALUES
	(1, 'devasatrio', 'SJ250219-06-000001', 'PT Iwak Enak-083223336313', '2019-02-25', 'P', '334', 4, 749300, 0, 35000, 'mungkung loceret nganjuk'),
	(3, 'devasatrio', 'SJ260219-06-000001', 'PT Iwak Enak-083223336313', '2019-02-26', 'P', '20', 2, 741200, 0, 52000, 'mungkung loceret nganjuk'),
	(4, 'devasatrio', 'SJ260219-06-000002', 'PT Moro Dadi-082122272212', '2019-02-26', 'P', '43.3', 5, 1372760, 118625, 20000, 'Jln badut ulang tahun no 3 magelang');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~2 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(1, 'mlg', 'malang', 20000, 10, '2'),
	(2, 'PR', 'pare', 25000, 20, '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_laut: ~51 rows (approximately)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(6, 'laut004', 'manado', 40000, 1, '2'),
	(7, 'laut0009', 'laut01', 34000, 34, '2'),
	(8, 'laut0010', 'laut02', 34000, 34, '2'),
	(9, 'laut0011', 'laut03', 34000, 34, '2'),
	(10, 'laut0012', 'laut04', 34000, 34, '2'),
	(11, 'laut0013', 'laut05', 34000, 34, '2'),
	(12, 'laut0014', 'laut06', 34000, 34, '2'),
	(13, 'wer', 'qwer', 2334, 23, '23'),
	(14, 'laut0001', 'laut01', 10000, 34, '2'),
	(15, 'laut0002', 'laut02', 34000, 20, '2'),
	(16, 'laut0003', 'laut03', 34000, 34, '2'),
	(17, 'laut0004', 'laut04', 40000, 10, '2'),
	(18, 'laut0005', 'laut05', 34000, 34, '2'),
	(19, 'laut0006', 'laut06', 12000, 11, '2'),
	(27, 'laut0020', 'laut20', 12014, 25, '2'),
	(28, 'laut0021', 'laut21', 12015, 26, '2'),
	(29, 'laut0022', 'laut22', 12016, 27, '2'),
	(30, 'laut0023', 'laut23', 12017, 28, '2'),
	(31, 'laut0024', 'laut24', 12018, 29, '2'),
	(32, 'laut0025', 'laut25', 12019, 30, '2'),
	(33, 'laut0026', 'laut26', 12020, 31, '2'),
	(34, 'laut0027', 'laut27', 12021, 32, '2'),
	(35, 'laut0028', 'laut28', 12022, 33, '2'),
	(36, 'laut0029', 'laut29', 12023, 34, '2'),
	(37, 'laut0030', 'laut30', 12024, 35, '2'),
	(38, 'laut0031', 'laut31', 12025, 36, '2'),
	(39, 'laut0032', 'laut32', 12026, 37, '2'),
	(40, 'laut0033', 'laut33', 12027, 38, '2'),
	(41, 'laut0034', 'laut34', 12028, 39, '2'),
	(42, 'laut0035', 'laut35', 12029, 40, '2'),
	(43, 'laut0036', 'laut36', 12030, 41, '2'),
	(44, 'laut0037', 'laut37', 12031, 42, '2'),
	(45, 'laut0038', 'laut38', 12032, 43, '2'),
	(46, 'laut0039', 'laut39', 12033, 44, '2'),
	(47, 'laut0040', 'laut40', 12034, 45, '2'),
	(48, 'laut0041', 'laut41', 12035, 46, '2'),
	(49, 'laut0042', 'laut42', 12036, 47, '2'),
	(50, 'laut0043', 'laut43', 12037, 48, '2'),
	(51, 'laut0044', 'laut44', 12038, 49, '2'),
	(52, 'laut0045', 'laut45', 12039, 50, '2'),
	(53, 'laut0046', 'laut46', 12040, 51, '2'),
	(54, 'laut0047', 'laut47', 12041, 52, '2'),
	(55, 'laut0048', 'laut48', 12042, 53, '2'),
	(56, 'laut0049', 'laut49', 12043, 54, '2'),
	(57, 'laut0050', 'laut50', 12044, 55, '2'),
	(58, 'laut0051', 'laut51', 12045, 56, '2'),
	(59, 'laut0052', 'laut52', 12046, 57, '2'),
	(60, 'laut0053', 'laut53', 12047, 58, '2'),
	(61, 'laut0054', 'laut54', 12048, 59, '2'),
	(62, 'laut0055', 'laut55', 12049, 60, '2'),
	(63, 'laut0056', 'laut56', 12050, 61, '2');
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
  `berat_minimal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_udara: ~15 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `perkg`, `minimal_heavy`, `biaya_dokumen`, `berat_minimal`) VALUES
	(6, 'udara0001', 'bandung betet', 'LION', 20000, 55, 5000, 15),
	(7, 'udara0002', 'banten', 'LION', 20000, 55, 5000, 15),
	(8, 'udara0003', 'bali', 'LION', 20000, 55, 5000, 11),
	(9, 'udara0004', 'bandung betet', 'garuda', 20000, 55, 5000, 11),
	(10, 'udara0005', 'bali', 'garuda', 30000, 55, 5000, 11),
	(11, 'udara0006', 'lampung', 'citilink', 20000, 55, 5000, 12),
	(12, 'udara0007', 'kalimantan', 'garuda', 20000, 55, 5000, 10),
	(13, 'udara0008', 'lampung', 'Lion NR', 30000, 55, 5000, 15),
	(14, 'udara0009', 'udara0009', 'LION', 20000, 55, 5000, 10),
	(15, 'udara0010', 'udara0010', 'LION', 20000, 55, 5000, 12),
	(17, 'udara011', 'papua', 'garuda', 500000, 50, 25000, 11),
	(18, 'udara0012', 'lombok', 'LION', 40000, 50, 25000, 11),
	(19, 'udara0013', 'cikarang', 'LION', 45000, 40, 25000, 11),
	(20, 'udara0014', 'situbondo', 'garuda', 50000, 30, 25000, 11),
	(21, 'udara0015', 'ngadiboyo', 'garuda', 30000, 50, 25000, 11);
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

-- Dumping structure for trigger kargo.editkaryawan
DROP TRIGGER IF EXISTS `editkaryawan`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `editkaryawan` BEFORE UPDATE ON `karyawan` FOR EACH ROW BEGIN
update gaji_karyawan set nama_karyawan=new.nama where nama_karyawan=old.nama;
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
