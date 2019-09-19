-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
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

-- Dumping structure for table kargo.absensi
DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT 0,
  `id_jabatan` int(11) DEFAULT 0,
  `tanggal` varchar(20) DEFAULT NULL,
  `masuk` int(2) DEFAULT NULL,
  `tidak_masuk` int(2) DEFAULT NULL,
  `izin` int(2) DEFAULT 0,
  `keterangan_izin` varchar(50) DEFAULT '0',
  `uang_makan` varchar(40) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.absensi: ~5 rows (approximately)
DELETE FROM `absensi`;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` (`id`, `id_karyawan`, `id_jabatan`, `tanggal`, `masuk`, `tidak_masuk`, `izin`, `keterangan_izin`, `uang_makan`, `id_cabang`) VALUES
	(1, 1, 26, '2019-09-06', 0, 1, 0, '-', '0', 1),
	(2, 4, 1, '2019-09-06', 0, 1, 0, '-', '0', 1),
	(3, 2, 26, '2019-09-07', 1, 0, 0, '-', '30000', 2),
	(4, 5, 27, '2019-09-07', 1, 0, 0, '-', '3000', 2),
	(5, 6, 24, '2019-09-07', 0, 1, 0, '-', '0', 2);
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;

-- Dumping structure for table kargo.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~11 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`, `level`, `id_cabang`) VALUES
	(6, 'Admin-000001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari', 'programer', 2),
	(7, 'Admin-000002', 'harianti', '74b213f68f648006a318f52713450f27', 'harianto', '085604556712', 'harianto@gmail.com', 'magersari gurah depan pga', 'admin', 1),
	(9, 'Admin-000003', 'abiihsan', '74b213f68f648006a318f52713450f27', 'abi ihsan fadli', '098765546', 'abi@gmail.com', 'gurah', 'programer', 1),
	(10, 'Admin-000004', 'dinisumi', '74b213f68f648006a318f52713450f27', 'cs dini', '09128390128', 'dian@gmail.com', 'gurah', 'cs', 1),
	(11, 'Admin-000005', 'atiqowner', '74b213f68f648006a318f52713450f27', 'pak atiq', '09328903289023', 'dianade@gmail.com', 'gurah', 'superadmin', 1),
	(12, 'Admin-000006', 'hardian', '74b213f68f648006a318f52713450f27', 'hardian', '2398782397892', 'harianto@gmail.com', 'gurah', 'operasional', 1),
	(13, 'Admin-000007', 'paijo', '827ccb0eea8a706c4c34a16891f84e7b', 'deni suherman', '0239482390', 'harianto@gmail.com', 'gurah kediri', 'admin_cabang', 1),
	(14, 'Admin-000008', 'askdfjasdkf', '827ccb0eea8a706c4c34a16891f84e7b', 'mariana', '2390482390', 'admin@gmail.com', 'ksdfjk', 'operasional_cabang', 1),
	(15, 'Admin-000009', 'damara', '74b213f68f648006a318f52713450f27', 'damara', '29304890', 'satriosuklun@gmail.com', 'gurah', 'programer', 1),
	(16, 'Admin-000010', 'jianfitri', '74b213f68f648006a318f52713450f27', 'jian fitri', '0293482390', 'satriosuklun@gmail.com', 'gurah', 'programer', 4),
	(17, 'Admin-000011', 'niamtamami', '74b213f68f648006a318f52713450f27', 'niam tamami', '02984902389', 'satriosuklun@gmail.com', 'gurah', 'HRD', 1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table kargo.armada
DROP TABLE IF EXISTS `armada`;
CREATE TABLE IF NOT EXISTS `armada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) DEFAULT NULL,
  `nopol` varchar(60) DEFAULT NULL,
  `nomor_rangka` varchar(60) DEFAULT NULL,
  `nomor_mesin` varchar(60) DEFAULT NULL,
  `warna` varchar(60) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.armada: ~3 rows (approximately)
DELETE FROM `armada`;
/*!40000 ALTER TABLE `armada` DISABLE KEYS */;
INSERT INTO `armada` (`id`, `nama`, `nopol`, `nomor_rangka`, `nomor_mesin`, `warna`, `id_cabang`) VALUES
	(1, 'gran max', '203482390', 'skdfjw8r', 'kljfdflkswe8r', 'merah', 1),
	(4, 'pajero', '028492', 'i34ui43o', '9034', 'hitam', 1),
	(5, 'motor supra', '20938490', '20934890', '9208490', 'hitam', 2);
/*!40000 ALTER TABLE `armada` ENABLE KEYS */;

-- Dumping structure for table kargo.cabang
DROP TABLE IF EXISTS `cabang`;
CREATE TABLE IF NOT EXISTS `cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kop` text DEFAULT NULL,
  `koderesi` varchar(50) DEFAULT NULL,
  `norek` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.cabang: ~3 rows (approximately)
DELETE FROM `cabang`;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`id`, `nama`, `alamat`, `kota`, `kop`, `koderesi`, `norek`) VALUES
	(1, 'KLC Cabang Kediri', 'magersari gurah kediri halo halo', 'KEDIRI', NULL, 'KDR', NULL),
	(2, 'KLC cabang suryabaya', 'aklsdfjkl', 'SURABAYA', 'kantor cabang : jln iwak enak no 2+2 konoha surabaya', 'SBY', 'Bank Mandiri 082098320 AN KLC SUB'),
	(4, 'KLC Cabang Tulungagung', 'jasdklf asdklfjklasf', 'TULUNGAGUNG', 'asjdklf:askldfjklasdfjkl', 'TNG', NULL);
/*!40000 ALTER TABLE `cabang` ENABLE KEYS */;

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
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.gaji_karyawan: ~6 rows (approximately)
DELETE FROM `gaji_karyawan`;
/*!40000 ALTER TABLE `gaji_karyawan` DISABLE KEYS */;
INSERT INTO `gaji_karyawan` (`id`, `kode_karyawan`, `nama_karyawan`, `id_jabatan`, `gaji_pokok`, `uang_makan`, `gaji_tambahan`, `total`, `bulan`, `tahun`, `id_cabang`) VALUES
	(1, '004', 'sonya', 24, 400000, 0, NULL, 430000, 8, 2019, 2),
	(2, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 8, 2019, 2),
	(3, '003', 'handoko', 27, 20000, 0, 5820, 25820, 8, 2019, 2),
	(4, '004', 'sonya', 24, 400000, 0, NULL, 430000, 8, 2019, 1),
	(5, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 8, 2019, 1),
	(6, '003', 'handoko', 27, 20000, 0, 5820, 25820, 8, 2019, 1);
/*!40000 ALTER TABLE `gaji_karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.jabatan
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(40) DEFAULT NULL,
  `gaji_pokok` varchar(20) DEFAULT NULL,
  `uang_makan` varchar(20) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.jabatan: ~5 rows (approximately)
DELETE FROM `jabatan`;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `jabatan`, `gaji_pokok`, `uang_makan`, `status`, `id_cabang`) VALUES
	(1, 'Branch Manager KDR', '400000', '30000', '1', 1),
	(24, 'Staff', '400000', '30000', '0', 1),
	(25, 'Staff Keuangan Pusat', '500000', '30000', '0', 1),
	(26, 'Staff Keuangan Cabang', '400000', '30000', '0', 1),
	(27, 'Branch Manager SUB', '20000', '3000', '1', 2);
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
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.karyawan: ~5 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`, `id_cabang`) VALUES
	(1, '001', 'hari', '2349023890482', 'gurah', 26, 1),
	(2, '002', 'maryanto', '032489023', 'gurah', 26, 2),
	(4, 'kk001', 'deni', '234789', 'gurah', 1, 1),
	(5, '003', 'handoko', '0923849028', 'gurah', 27, 2),
	(6, '004', 'sonya', '239084902', 'sakldjf', 24, 2);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.kategori_barang
DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(11) DEFAULT 1,
  `spesial_cargo` varchar(40) DEFAULT NULL,
  `charge` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.kategori_barang: ~3 rows (approximately)
DELETE FROM `kategori_barang`;
/*!40000 ALTER TABLE `kategori_barang` DISABLE KEYS */;
INSERT INTO `kategori_barang` (`id`, `id_cabang`, `spesial_cargo`, `charge`) VALUES
	(1, 1, 'Hewan Hidup', '100'),
	(2, 1, 'Tanaman Hidup', '50'),
	(3, 1, 'Meat / Frozen Food', '50');
/*!40000 ALTER TABLE `kategori_barang` ENABLE KEYS */;

-- Dumping structure for table kargo.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kargo.migrations: ~3 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(4, '2014_10_12_000000_create_users_table', 1),
	(5, '2014_10_12_100000_create_password_resets_table', 1),
	(6, '2018_10_11_054351_create_pemesanans_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table kargo.mitra
DROP TABLE IF EXISTS `mitra`;
CREATE TABLE IF NOT EXISTS `mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.mitra: ~2 rows (approximately)
DELETE FROM `mitra`;
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
INSERT INTO `mitra` (`id`, `nama`, `alamat`, `notelp`, `id_cabang`) VALUES
	(2, 'pt iwak enak', 'gurah', '14045', 2),
	(3, 'aaa', 'sdfqw', '23423', 1);
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;

-- Dumping structure for table kargo.neraca
DROP TABLE IF EXISTS `neraca`;
CREATE TABLE IF NOT EXISTS `neraca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `debit` int(11) DEFAULT 0,
  `kredit` int(11) DEFAULT 0,
  `admin` varchar(50) DEFAULT NULL,
  `id_cabang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.neraca: ~11 rows (approximately)
DELETE FROM `neraca`;
/*!40000 ALTER TABLE `neraca` DISABLE KEYS */;
INSERT INTO `neraca` (`id`, `bulan`, `tahun`, `keterangan`, `debit`, `kredit`, `admin`, `id_cabang`) VALUES
	(2, 8, 2019, 'Pajak Pemasukan Resi', 0, 63800, 'damara', '2'),
	(3, 8, 2019, 'Pemasukan resi lunas', 1051000, 0, 'damara', '2'),
	(4, 8, 2019, 'Pemasukan resi belum lunas', 16000, 0, 'damara', '2'),
	(5, 8, 2019, 'Pemasukan Piutang resi ', 328000, 0, 'damara', '2'),
	(6, 8, 2019, 'Pengeluaran Harian', 0, 0, 'damara', '2'),
	(7, 8, 2019, 'Gaji Karyawan', 0, 885820, 'damara', '2'),
	(13, 8, 2019, 'Transfer Ke Pusat', 0, 245380, 'devasatrio', '2'),
	(14, 9, 2019, 'Saldo Awal Bulan', 200000, 0, 'devasatrio', '2'),
	(15, 8, 2019, 'Piutang Saldo', 0, 200000, 'devasatrio', '2'),
	(16, 9, 2019, 'Pembayaran pajak 5 Tahunan', 0, 2000000, 'damara', '2'),
	(17, 9, 2019, 'Pajak tahunan', 0, 1000000, 'damara', '2');
/*!40000 ALTER TABLE `neraca` ENABLE KEYS */;

-- Dumping structure for table kargo.omset
DROP TABLE IF EXISTS `omset`;
CREATE TABLE IF NOT EXISTS `omset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(5) DEFAULT NULL,
  `tahun` int(5) DEFAULT NULL,
  `pemasukan` bigint(20) DEFAULT NULL,
  `pengeluaran` bigint(20) DEFAULT NULL,
  `pengeluaran_lainya` bigint(20) DEFAULT NULL,
  `gaji_karyawan` bigint(20) DEFAULT NULL,
  `pajak` bigint(20) DEFAULT NULL,
  `laba` bigint(20) DEFAULT NULL,
  `omset_awal` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.omset: ~0 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
INSERT INTO `omset` (`id`, `bulan`, `tahun`, `pemasukan`, `pengeluaran`, `pengeluaran_lainya`, `gaji_karyawan`, `pajak`, `laba`, `omset_awal`) VALUES
	(1, 6, 2019, 2000000, 1000000, 400000, 500000, 10000, 50000, 0);
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- Dumping structure for table kargo.pajak
DROP TABLE IF EXISTS `pajak`;
CREATE TABLE IF NOT EXISTS `pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(4) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `nama_pajak` varchar(150) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_cabang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak: ~8 rows (approximately)
DELETE FROM `pajak`;
/*!40000 ALTER TABLE `pajak` DISABLE KEYS */;
INSERT INTO `pajak` (`id`, `bulan`, `tahun`, `nama_pajak`, `total`, `id_cabang`) VALUES
	(1, 1, '2019', 'pajak', 2638, '2'),
	(3, 2, '2019', 'pajak', 22425, '2'),
	(4, 3, '2019', 'pajak', 0, '2'),
	(5, 4, '2019', 'pajak', 8705, '2'),
	(6, 5, '2019', 'pajak', 30058, '2'),
	(7, 7, '2019', 'pajak', 29422, '2'),
	(8, 7, '2019', 'pajak', 24055, '2'),
	(22, 8, '2019', 'Pajak Pendapatan', 63800, '2');
/*!40000 ALTER TABLE `pajak` ENABLE KEYS */;

-- Dumping structure for table kargo.pajak_armada
DROP TABLE IF EXISTS `pajak_armada`;
CREATE TABLE IF NOT EXISTS `pajak_armada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_armada` int(11) DEFAULT 0,
  `nama_pajak` varchar(50) DEFAULT '0',
  `tgl_bayar` date DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `tgl_peringatan` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak_armada: ~8 rows (approximately)
DELETE FROM `pajak_armada`;
/*!40000 ALTER TABLE `pajak_armada` DISABLE KEYS */;
INSERT INTO `pajak_armada` (`id`, `id_armada`, `nama_pajak`, `tgl_bayar`, `tgl_kadaluarsa`, `tgl_peringatan`) VALUES
	(1, 4, 'pajak tahunan', '2019-09-18', '2020-09-09', '2020-09-02'),
	(10, 4, 'pajak 5 tahun', '2019-05-09', '2019-11-22', '2019-11-15'),
	(11, 4, 'pajak KIR', NULL, NULL, NULL),
	(12, 1, 'pajak tahunan', '2019-05-08', '2019-06-08', '2019-06-01'),
	(13, 1, 'pajak KIR', NULL, NULL, NULL),
	(14, 5, 'kir', NULL, NULL, NULL),
	(15, 14, 'd', NULL, NULL, NULL),
	(16, 15, 'h', NULL, NULL, NULL),
	(17, 5, '5 Tahun', '2019-09-18', '2020-11-01', '2020-10-25');
/*!40000 ALTER TABLE `pajak_armada` ENABLE KEYS */;

-- Dumping structure for table kargo.pajak_kendaraan
DROP TABLE IF EXISTS `pajak_kendaraan`;
CREATE TABLE IF NOT EXISTS `pajak_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idarmada` varchar(50) NOT NULL DEFAULT '0',
  `tgl` varchar(50) NOT NULL DEFAULT '0',
  `bulan` int(11) NOT NULL DEFAULT 0,
  `tahun` int(11) NOT NULL DEFAULT 0,
  `nominal` int(11) NOT NULL DEFAULT 0,
  `bukti` text NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL DEFAULT '0',
  `admin` varchar(50) NOT NULL DEFAULT '0',
  `id_cabang` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak_kendaraan: ~2 rows (approximately)
DELETE FROM `pajak_kendaraan`;
/*!40000 ALTER TABLE `pajak_kendaraan` DISABLE KEYS */;
INSERT INTO `pajak_kendaraan` (`id`, `idarmada`, `tgl`, `bulan`, `tahun`, `nominal`, `bukti`, `keterangan`, `admin`, `id_cabang`) VALUES
	(1, '5', '2019-09-18', 9, 2019, 0, '1568819084-slide3.jpg', 'Pembayaran pajak 5 Tahunan', 'damara', '2'),
	(2, '4', '2019-09-18', 9, 2019, 1000000, '1568819842-slide1.jpg', 'Pajak tahunan', 'damara', '2');
/*!40000 ALTER TABLE `pajak_kendaraan` ENABLE KEYS */;

-- Dumping structure for table kargo.pengeluaran_lain
DROP TABLE IF EXISTS `pengeluaran_lain`;
CREATE TABLE IF NOT EXISTS `pengeluaran_lain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(200) DEFAULT NULL,
  `kategori` varchar(40) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT 0,
  `id_cabang` int(11) DEFAULT 1,
  `tgl` date DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pengeluaran_lain: ~22 rows (approximately)
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
INSERT INTO `pengeluaran_lain` (`id`, `admin`, `kategori`, `keterangan`, `jumlah`, `id_cabang`, `tgl`, `gambar`) VALUES
	(3, 'abiihsan', '005', '123we', 21, 2, '2019-07-28', NULL),
	(8, 'devasatrio', '005', 'beli bensin', 30000, 2, '2019-07-19', '1546440740-logo.jpg'),
	(9, 'devasatrio', '007', 'parkir mobil', 20000, 2, '2019-07-19', '1546477524-logo.jpg'),
	(10, 'devasatrio', '008', 'bayar tol surabaya', 3000, 1, '2019-07-19', '1546482244-img-20181126-wa0003.jpg'),
	(11, 'devasatrio', '007', 'parkir jet', 40000, 1, '2019-07-19', '1546484974-img-20181023-wa0023.jpg'),
	(12, 'devasatrio', '007', 'parkir mobil putih', 2000, 1, '2019-07-19', '1546576232-favicon.png'),
	(13, 'devasatrio', '009', 'untuk beli alat tulis', 20000, 1, '2019-07-19', '1550231029-500_f_212165279_5nn4hrmazulxpsbbcyutb7kn7f667gu2.jpg'),
	(14, 'devasatrio', '005', 'halo halo', 20000, 1, '2019-07-07', '1554960625-kaos3.jpg'),
	(15, 'devasatrio', '005', 'alskjfklasfdj', 30000, 1, '2019-07-27', '1554960686-client.png'),
	(16, 'devasatrio', '004', 'asdfasdfasfasfsf', 20000, 1, '2019-07-12', '1555062448-1548762928-kemeja5.jpg'),
	(17, 'devasatrio', '004', 'aasfasdf', 40000, 1, '2019-07-12', '1555063100-admin.png'),
	(18, 'devasatrio', '004', 'aadasdklfj aajsdfkljasdfk', 40000, 1, '2019-07-12', '1555072139-client.png'),
	(19, 'devasatrio', '004', 'sdafk', 30000, 1, '2019-07-12', '1555072654-kaos4.jpg'),
	(20, 'devasatrio', '004', 'asdf', 20000, 1, '2019-07-12', '1555072691-kaos1.jpeg'),
	(21, 'abiihsan', '012', 'modal usaha', 100000, 1, '2019-07-19', NULL),
	(22, 'abiihsan', '001', 'modal usaha', 100000, 1, '2019-07-19', NULL),
	(24, 'abiihsan', '013', '45443', 40, 1, '2019-07-29', '1559121450-9.jpg'),
	(25, 'devasatrio', '004', 'asdf', 20000, 1, '2019-07-09', ''),
	(26, 'Auto Insert', '15', 'Pajak', 29422, 1, '2019-08-08', NULL),
	(27, 'Auto Insert', '14', 'Gaji Karyawan', NULL, 1, '2019-08-08', NULL),
	(28, 'Auto Insert', '211', 'Pajak', 24055, 1, '2019-08-14', NULL),
	(29, 'Auto Insert', '244', 'Gaji Karyawan', NULL, 1, '2019-08-14', NULL);
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

-- Dumping structure for table kargo.resi_mentah
DROP TABLE IF EXISTS `resi_mentah`;
CREATE TABLE IF NOT EXISTS `resi_mentah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_resi` varchar(100) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  `pembuat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_mentah: ~8 rows (approximately)
DELETE FROM `resi_mentah`;
/*!40000 ALTER TABLE `resi_mentah` DISABLE KEYS */;
INSERT INTO `resi_mentah` (`id`, `no_resi`, `id_cabang`, `pembuat`) VALUES
	(2, 'resimanualkdr002', 1, 'devasatrio'),
	(3, 'resimanualkdr003', 1, 'devasatrio'),
	(4, 'resimanualkdr004', 1, 'devasatrio'),
	(5, 'resimanualkdr005', 1, 'devasatrio'),
	(6, 'resimanualsby001', 2, 'devasatrio'),
	(7, 'resimanualsby002', 2, 'devasatrio'),
	(8, 'resimanualsby003', 2, 'devasatrio'),
	(9, 'resimanualsby004', 2, 'devasatrio');
/*!40000 ALTER TABLE `resi_mentah` ENABLE KEYS */;

-- Dumping structure for table kargo.resi_pengiriman
DROP TABLE IF EXISTS `resi_pengiriman`;
CREATE TABLE IF NOT EXISTS `resi_pengiriman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_resi` text DEFAULT NULL,
  `no_smu` text DEFAULT NULL,
  `kode_jalan` text DEFAULT NULL,
  `kode_antar` text DEFAULT NULL,
  `kode_envoice` text DEFAULT NULL,
  `admin` varchar(100) DEFAULT NULL,
  `nama_barang` text DEFAULT NULL,
  `pengiriman_via` enum('darat','laut','udara','city kurier') DEFAULT NULL,
  `kota_asal` varchar(40) DEFAULT NULL,
  `kode_tujuan` text DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `berat` varchar(30) DEFAULT NULL,
  `dimensi` varchar(30) DEFAULT NULL,
  `ukuran_volume` varchar(30) DEFAULT NULL,
  `nama_pengirim` varchar(70) DEFAULT NULL,
  `nama_penerima` varchar(70) DEFAULT NULL,
  `nama_penerima_barang` varchar(70) DEFAULT NULL,
  `telp_pengirim` varchar(20) DEFAULT NULL,
  `telp_penerima` varchar(20) DEFAULT NULL,
  `alamat_pengirim` text DEFAULT NULL,
  `alamat_penerima` text DEFAULT NULL,
  `biaya_kirim` int(11) DEFAULT 0,
  `biaya_packing` int(11) DEFAULT 0,
  `biaya_asuransi` int(11) DEFAULT 0,
  `biaya_ppn` int(11) DEFAULT 0,
  `biaya_smu` int(11) DEFAULT 0,
  `biaya_karantina` int(11) DEFAULT 0,
  `biaya_charge` int(11) DEFAULT 0,
  `biaya_cancel` int(11) DEFAULT 0,
  `total_biaya` int(11) DEFAULT 0,
  `total_bayar` int(11) DEFAULT 0,
  `kurang` int(11) DEFAULT 0,
  `biaya_suratjalan` int(11) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `status` enum('Y','N','RS') DEFAULT 'N',
  `satuan` varchar(10) DEFAULT NULL,
  `metode_bayar` enum('cash','bt') DEFAULT 'cash',
  `metode_input` enum('manual','otomatis') DEFAULT 'otomatis',
  `pemegang` varchar(90) DEFAULT NULL,
  `batal` enum('Y','N') DEFAULT 'N',
  `status_antar` enum('N','Y','G','P','KL') DEFAULT 'N',
  `id_cabang` int(11) DEFAULT 1,
  `katakun` int(3) DEFAULT 1,
  `status_pengiriman` varchar(200) DEFAULT NULL,
  `status_company` enum('Y','N') DEFAULT 'N',
  `duplikat` enum('Y','N','S') DEFAULT 'N',
  `transfer` enum('Y','N') DEFAULT 'N',
  `total_berat_udara` int(11) DEFAULT NULL,
  `maskapai_udara` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~24 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `kode_envoice`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `nama_penerima_barang`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `total_bayar`, `kurang`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_antar`, `id_cabang`, `katakun`, `status_pengiriman`, `status_company`, `duplikat`, `transfer`, `total_berat_udara`, `maskapai_udara`) VALUES
	(2, 'SBY310819-06-000001', NULL, NULL, NULL, NULL, 'devasatrio', 'alksfj asfkjl asdfkl', 'darat', 'SURABAYA', 'gurah', '2019-08-31', NULL, '2019-08-31', 1, '5', '20 x 40 x 30', '6', 'a;lskdf', 'aklsfj', NULL, '02938490', '29038490', 'klsadjfk', 'klsadjfk', 180000, 2000, 1000, 0, 0, 0, 0, 0, 183000, 200000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(3, 'SBY310819-06-000002', NULL, NULL, NULL, NULL, 'devasatrio', 'sadsadf', 'laut', 'SURABAYA', 'kalimantan', '2019-08-31', NULL, '2019-08-31', 1, '2', '30 x 20 x 10', '2', 'asdklfjaskldf', 'klassdfjkl', NULL, '0928390', '1908490', 'jlkasdjf aslkfdjasklf', 'lkadsfj', 80000, 2000, 1000, 0, 0, 0, 0, 0, 83000, 85000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(4, 'SBY310819-06-000003', NULL, NULL, 'SASBY030919-06-000002', NULL, 'devasatrio', 'stiker jumbo', 'laut', 'SURABAYA', 'kalimantan', '2019-08-31', NULL, NULL, 1, '4', '29 x 29 x 20', '4', 'alskdfjkfsl', 'ksaldfjk', 'suhadi manuk', '0923890', '2904890', 'jksa', 'jklasdf sadfj', 160000, 2000, 1000, 0, 0, 0, 0, 0, 163000, 4000, 0, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N', 'N', NULL, NULL),
	(5, 'SBY310819-06-000004', NULL, NULL, 'SASBY030919-06-000003', NULL, 'devasatrio', 'laskfjk', 'laut', 'SURABAYA', 'kalimantan', '2019-08-31', NULL, NULL, 1, '2', '30 x 20 x 10', '2', 'klasdjfkls', 'jsaklfd', 'maryani', '9028903', '2390890', 'klsajfdkl askjdfkl', 'jklsdf klsajd', 80000, 2000, 1000, 0, 0, 0, 0, 0, 83000, 2000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N', 'N', NULL, NULL),
	(6, 'SBY310819-06-000005', NULL, NULL, 'SASBY030919-06-000001', NULL, 'devasatrio', 'pencil', 'udara', 'SURABAYA', 'papua', '2019-08-31', NULL, '2019-08-31', 2, '6', '-', '-', 'askldfj', 'aksldf', 'aksldf', '928490', '902338490', 'skladfj sakdlfjklsaf', 'askldfj askfjklasdf', 204000, NULL, NULL, 0, 0, 0, 0, 0, 211000, 300000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N', 'N', NULL, NULL),
	(7, 'SBY310819-06-000006', NULL, NULL, NULL, NULL, 'devasatrio', 'kasdf asdkflj asdf', 'city kurier', 'SURABAYA', 'kec. wates', '2019-08-31', NULL, '2019-09-02', 1, '5', '40 x 30 x 20', '6', 'asdf asdfjk', 'aklsdf', NULL, '912304890', '23094890', 'klsdf askldjfkl sadfjk', 'asdf asdfkl asdklfjkl alsdkfj', 120000, 2000, 1000, 0, 0, 0, 0, 0, 123000, 123000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(8, 'SBY310819-06-000007', NULL, 'SJSBY040919-06-000001', NULL, NULL, 'devasatrio', 'klas asdklfj asdkfjklsadf', 'city kurier', 'SURABAYA', 'kec. wates', '2019-08-31', NULL, NULL, 2, '3', '40 x 20 x 20', '4', 'askldfjkl', '29034890', NULL, '02938490', '90234890', 'klsafj', 'jklasdjf asldkfjl', 80000, 2000, 1000, 0, 0, 0, 0, 0, 83000, 0, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'menuju kota tujuan', 'N', 'S', 'N', NULL, NULL),
	(9, 'SBY310819-06-000008', NULL, NULL, NULL, NULL, 'devasatrio', 'halo', 'city kurier', 'SURABAYA', 'kec. wates', '2019-08-31', NULL, '2019-09-02', 1, '2', '40 x 40 x 40', '16', 'asdf', 'klsadfjkl', NULL, '9234890', '239304890', 'jklsadf aslkdfjaskldf', 'klsadfj lkasdfjaskldf', 320000, 2000, 1000, 0, 0, 0, 0, 0, 323000, 323000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(10, 'SBY310819-06-000009', NULL, NULL, NULL, NULL, 'devasatrio', 'adsfasdf', 'city kurier', 'SURABAYA', 'kec. gabru', '2019-08-31', NULL, '2019-08-31', 1, '2', '30 x 20 x 10', '2', 'asdf asdfkl', 'asldf; asdlf;', NULL, '24213', '23423', 'asdf asdf;lasdf', 'asf klasdfl', 6000, 2000, 1000, 0, 0, 0, 0, 0, 9000, 20000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(11, 'SBY310819-06-000010', NULL, 'SJSBY040919-06-000002', NULL, NULL, 'devasatrio', 'asdf lasdf', 'city kurier', 'SURABAYA', 'kec. wates', '2019-08-31', NULL, NULL, 1, '2', '40 x 30 x 20', '6', 'asdfasdf', 'asdklf', NULL, '230940', '23940', 'asdlfk asdklfsad f', 'asldf asdfklasdf', 12000, 2000, 1000, 0, 0, 0, 0, 0, 15000, 10000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'menuju kota tujuan', 'N', 'N', 'N', NULL, NULL),
	(12, 'halo0001', NULL, NULL, NULL, NULL, 'devasatrio', 'semvak', 'city kurier', 'SURABAYA', 'kec.gurah', '2019-09-01', NULL, NULL, 1, '6', '30 x 20 x 40', '6', 'asdf', 'jklasdf', NULL, '234', '934890', 'klsadjf asdklfj', 'klasfjla', 18000, 2000, 1000, 0, 0, 0, 0, 0, 21000, NULL, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(13, 'SBY010919-06-000001', NULL, NULL, NULL, NULL, 'devasatrio', 'halo', 'darat', 'SURABAYA', 'gurah', '2019-09-01', NULL, '2019-09-01', 1, '2', '30 x 20 x 10', '2', 'asdf', 'jaskldfj', NULL, '203498', '239014890', 'klasdf askldfjkl', 'jklsadf', 60000, 2000, 1000, 0, 0, 0, 0, 0, 63000, 63000, 0, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(14, 'resimanual002', NULL, 'SJSBY040919-06-000001', NULL, NULL, 'devasatrio', 'asdfasdf', 'laut', 'SURABAYA', 'kalimantan', '2019-09-03', NULL, NULL, 1, '4', '30 x 20 x 30', '5', 'asdfasdf', 'jaskldfj', NULL, '23039489', '9134890', 'kjlsadjf ksaldfjkl', 'klasfjdlk asfjkl', 200000, 3000, 2000, 0, 0, 0, 0, 0, 205000, 100000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '1', 'N', 'N', 2, 1, 'menuju kota tujuan', 'N', 'S', 'N', NULL, NULL),
	(15, 'resimanual001', NULL, NULL, 'SASBY030919-06-000003', NULL, 'devasatrio', 'sepatu gajah', 'darat', 'SURABAYA', 'gurah', '2019-09-03', NULL, NULL, 1, '2', '30 x 30 x 20', '5', 'asdf', 'jasddklfj', NULL, '233908490', '23904890', 'askldfj sadfksajdfkl', 'kjklsadjfkl', 150000, 2000, 1000, 0, 0, 0, 0, 0, 153000, 2000, 0, 0, 'alamat salah', 'Y', 'kg', 'cash', 'manual', '1', 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N', 'N', NULL, NULL),
	(16, 'SBY030919-06-000001', NULL, NULL, NULL, NULL, 'devasatrio', 'asdfsadf', 'darat', 'SURABAYA', 'gurah', '2019-09-03', NULL, '2019-09-03', 1, '6', '20 x 40 x 30', '6', 'alksdfjklas', 'sakldjkl', NULL, '0928490', '2903890', 'kljas sadlkjaskldf', 'klsadj sldakfjaskl', 180000, 2000, 1000, 0, 0, 0, 0, 0, 183000, 183000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(17, 'resimanual003', NULL, NULL, NULL, NULL, 'devasatrio', 'halkjasdfkl', 'city kurier', 'SURABAYA', 'kec. gabru', '2019-09-03', NULL, NULL, 1, '2', '20 x 30 x 20', '3', 'aklsdfjkl', 'skldfjkl', NULL, '90234890', '39024890', 'jklfjkl', 'jklsdfjkl', 9000, 2000, 1000, 0, 0, 0, 0, 0, 12000, 1000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '1', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(18, 'resimanual004', 'asdf', 'SJSBY040919-06-000002', NULL, NULL, 'devasatrio', 'ajskldf', 'udara', 'SURABAYA', 'maluku', '2019-09-03', NULL, '2019-09-03', 2, '5', '-', '-', 'saskdf', 'kasldfj', NULL, '09283490', '2903489', 'jklsadjf', 'ksladfjlk', 125000, 0, 0, 0, 5000, 3000, 0, 0, 133000, 133000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '1', 'N', 'N', 2, 1, 'menuju kota tujuan', 'N', 'S', 'N', NULL, NULL),
	(19, 'haha001', 'g-0001', NULL, NULL, NULL, 'devasatrio', 'asdfasdff', 'city kurier', 'SURABAYA', 'kec.gurah', '2019-09-03', NULL, '2019-09-03', 1, '2', '20 x 30 x 20', '3', 'askldfjaskldf', 'asklfjasdklf', NULL, '234908', '92308490', 'sadkljflk afkjasdklf asklfjskladf', 'asdklfjkl', 9000, 2000, 1000, 0, 0, 0, 0, 0, 12000, 12000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 'N', NULL, NULL),
	(23, 'SBY310819-06-000007', NULL, NULL, NULL, NULL, 'devasatrio', 'klas asdklfj asdkfjklsadf', 'city kurier', 'SURABAYA', 'kec. wates', '2019-08-31', NULL, NULL, 2, '3', '40 x 20 x 20', '4', 'askldfjkl', '29034890', NULL, '02938490', '90234890', 'klsafj', 'jklasdjf asldkfjl', 80000, 2000, 1000, 0, 0, 0, 0, 0, 83000, 0, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'Y', 'N', NULL, NULL),
	(24, 'resimanual002', NULL, 'SJKDR060919-15-000001', NULL, NULL, 'devasatrio', 'asdfasdf', 'laut', 'SURABAYA', 'kalimantan', '2019-09-03', NULL, NULL, 1, '4', '30 x 20 x 30', '5', 'asdfasdf', 'jaskldfj', NULL, '23039489', '9134890', 'kjlsadjf ksaldfjkl', 'klasfjdlk asfjkl', 200000, 3000, 2000, 0, 0, 0, 0, 0, 205000, 0, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'handle by vendor', 'N', 'Y', 'N', NULL, NULL),
	(25, 'resimanual004', 'asdf', 'SJKDR060919-15-000001', NULL, NULL, 'devasatrio', 'ajskldf', 'udara', 'SURABAYA', 'maluku', '2019-09-03', NULL, '2019-09-03', 2, '5', '-', '-', 'saskdf', 'kasldfj', NULL, '09283490', '2903489', 'jklsadjf', 'ksladfjlk', 125000, 0, 0, 0, 5000, 3000, 0, 0, 133000, 0, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'handle by vendor', 'N', 'Y', 'N', NULL, NULL),
	(26, 'resicmp', NULL, NULL, NULL, 'ENSBY060919-06-000001', 'devasatrio', 'mouse', 'city kurier', 'SURABAYA', 'kec.gurah', '2019-09-06', NULL, NULL, 1, '2', '20 x 10 x 20', '1', 'hari', 'kalsdfj', NULL, '90238490', '29038', 'klsadfjkls', 'kljadsfk', 6000, 2000, 2000, 0, 0, 0, 0, 0, 10000, 8000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'Y', 'N', 'N', NULL, NULL),
	(27, 'citycmp001', NULL, NULL, NULL, 'INSBY070919-06-000001', 'devasatrio', 'spiker', 'city kurier', 'SURABAYA', 'kec.gurah', '2019-09-07', NULL, '2019-09-07', 1, '2', '30 x 40 x 20', '6', 'asldkfjsadklf', 'ksladfj', NULL, '29038490', '920849', 'skldfjkl', 'klasjdfk', 18000, 2000, 1000, 0, 0, 0, 0, 0, 21000, 21000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'Y', 'N', 'N', NULL, NULL),
	(28, 'citycmp002', NULL, NULL, NULL, 'INSBY070919-06-000001', 'devasatrio', 'rubik', 'city kurier', 'SURABAYA', 'kec.gurah', '2019-09-07', NULL, '2019-09-07', 1, '2', '30 x 20 x 10', '2', 'ksaldfjkla', 'sklfj', NULL, '9028490', '9038490', 'jskladfj', 'jskladfj', 6000, 2000, 1000, 0, 0, 0, 0, 0, 9000, 9000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'Y', 'N', 'N', NULL, NULL);
/*!40000 ALTER TABLE `resi_pengiriman` ENABLE KEYS */;

-- Dumping structure for table kargo.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.roles: ~7 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `level`) VALUES
	(1, 'programmer'),
	(2, 'admin'),
	(3, 'super admin'),
	(4, 'cs'),
	(5, 'hrd'),
	(6, 'branch manager'),
	(7, 'oprasional');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

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
  `pengumuman` text DEFAULT NULL,
  `desk_udara` text DEFAULT NULL,
  `desk_laut` text DEFAULT NULL,
  `desk_darat` text DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `bulan_sekarang` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.setting: ~0 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `pengumuman`, `desk_udara`, `desk_laut`, `desk_darat`, `status`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<p>Dear client untuk saat ini data Cabang surabaya dapat di isi tapi untuk transaksi dsb harap sabar :-*</p>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', 'Y', 9);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table kargo.setting_pajak
DROP TABLE IF EXISTS `setting_pajak`;
CREATE TABLE IF NOT EXISTS `setting_pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pajak` varchar(50) NOT NULL,
  `besaran` int(11) NOT NULL,
  `tempo` enum('bulan','tahun','hari','minggu') NOT NULL DEFAULT 'tahun',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.setting_pajak: ~2 rows (approximately)
DELETE FROM `setting_pajak`;
/*!40000 ALTER TABLE `setting_pajak` DISABLE KEYS */;
INSERT INTO `setting_pajak` (`id`, `pajak`, `besaran`, `tempo`) VALUES
	(1, 'Pajak Omset', 10, 'tahun'),
	(5, 'Pajak Penghasilan', 5, 'bulan');
/*!40000 ALTER TABLE `setting_pajak` ENABLE KEYS */;

-- Dumping structure for table kargo.set_saldo
DROP TABLE IF EXISTS `set_saldo`;
CREATE TABLE IF NOT EXISTS `set_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` varchar(50) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.set_saldo: ~2 rows (approximately)
DELETE FROM `set_saldo`;
/*!40000 ALTER TABLE `set_saldo` DISABLE KEYS */;
INSERT INTO `set_saldo` (`id`, `id_cabang`, `saldo`) VALUES
	(2, '1', 1200000),
	(3, '2', 200000);
/*!40000 ALTER TABLE `set_saldo` ENABLE KEYS */;

-- Dumping structure for table kargo.status_pengiriman
DROP TABLE IF EXISTS `status_pengiriman`;
CREATE TABLE IF NOT EXISTS `status_pengiriman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.status_pengiriman: ~75 rows (approximately)
DELETE FROM `status_pengiriman`;
/*!40000 ALTER TABLE `status_pengiriman` DISABLE KEYS */;
INSERT INTO `status_pengiriman` (`id`, `kode`, `status`, `keterangan`, `tgl`, `jam`, `lokasi`) VALUES
	(2, 'resimanual003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '19:49:13', 'SURABAYA'),
	(4, 'resimanual001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '19:55:29', 'SURABAYA'),
	(5, 'SBY250819-06-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '20:24:36', 'SURABAYA'),
	(6, 'SBY250819-06-000002', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '20:27:53', 'SURABAYA'),
	(7, 'SBY250819-06-000003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '20:32:23', 'SURABAYA'),
	(8, 'SBY250819-06-000004', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '20:39:57', 'SURABAYA'),
	(9, 'citycompany001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '20:41:44', 'SURABAYA'),
	(10, 'SBY250819-06-000001', 'menuju kota tujuan', NULL, '2019-08-25', '20:44:13', 'SURABAYA'),
	(11, 'SBY250819-06-000002', 'menuju kota tujuan', NULL, '2019-08-25', '20:44:40', 'SURABAYA'),
	(12, 'SBY250819-06-000004', 'prosess pengantaran paket', NULL, '2019-08-25', '20:46:26', 'SURABAYA'),
	(13, 'citycompany001', 'prosess pengantaran paket', NULL, '2019-08-25', '20:46:41', 'SURABAYA'),
	(16, 'resimanual001', 'handle by vendor', NULL, '2019-08-25', '20:52:16', 'SURABAYA'),
	(18, 'SBY250819-06-000004', 'paket telah diterima', 'mbak komari', '2019-08-25', '20:54:56', 'SURABAYA'),
	(19, 'citycompany001', 'pengantaran gagal', 'Alamat salah atau tidak lengkap', '2019-08-25', '20:55:18', 'SURABAYA'),
	(20, 'citycompany001', 'prosess pengantaran paket ulang', NULL, '2019-08-25', '20:57:56', 'SURABAYA'),
	(21, 'resimanual003', 'prosess pengantaran paket', NULL, '2019-08-25', '20:58:11', 'SURABAYA'),
	(22, 'citycompany001', 'paket telah diterima', 'sumiarti', '2019-08-25', '21:00:49', 'SURABAYA'),
	(23, 'resimanual003', 'dikembalikan ke pengirim', NULL, '2019-08-25', '21:04:07', 'SURABAYA'),
	(24, 'resimanual003', 'paket telah diterima', NULL, '2019-08-25', '21:06:30', 'SURABAYA'),
	(27, 'resimanual001', 'paket telah diterima', NULL, '2019-08-25', '21:18:26', 'SURABAYA'),
	(28, 'SBY250819-06-000001', 'transit di KLC Cabang TULUNGAGUNG', NULL, '2019-08-25', '21:26:59', 'TULUNGAGUNG'),
	(29, 'SBY250819-06-000002', 'transit di KLC Cabang TULUNGAGUNG', NULL, '2019-08-25', '21:26:59', 'TULUNGAGUNG'),
	(30, 'SBY250819-06-000001', 'menuju kota tujuan', NULL, '2019-08-25', '21:28:15', 'TULUNGAGUNG'),
	(31, 'SBY250819-06-000002', 'menuju kota tujuan', NULL, '2019-08-25', '21:28:15', 'TULUNGAGUNG'),
	(32, 'SBY250819-06-000001', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-08-25', '21:30:21', 'KEDIRI'),
	(33, 'SBY250819-06-000002', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-08-25', '21:30:21', 'KEDIRI'),
	(34, 'SBY250819-06-000001', 'prosess pengantaran paket', NULL, '2019-08-25', '21:34:45', 'KEDIRI'),
	(35, 'SBY250819-06-000002', 'handle by vendor', NULL, '2019-08-25', '21:38:30', 'KEDIRI'),
	(36, 'SBY250819-06-000001', 'paket telah diterima', 'askldfj1', '2019-08-25', '21:42:11', 'KEDIRI'),
	(37, 'SBY250819-06-000002', 'paket telah diterima', NULL, '2019-08-25', '21:49:43', 'SURABAYA'),
	(38, 'SBY250819-06-000001', 'paket telah diterima', NULL, '2019-08-25', '21:50:10', 'SURABAYA'),
	(40, 'SBY250819-06-000003', 'menuju kota tujuan', NULL, '2019-08-27', '19:48:17', 'SURABAYA'),
	(42, 'SBY250819-06-000003', 'barang sampai di KLC Cabang KEDIRI', NULL, '2019-08-27', '19:48:59', 'KEDIRI'),
	(43, 'SBY250819-06-000003', 'handle by vendor', NULL, '2019-08-27', '19:50:17', 'KEDIRI'),
	(46, 'SBY250819-06-000003', 'paket telah diterima', NULL, '2019-08-27', '19:55:38', 'SURABAYA'),
	(47, 'SBY310819-06-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '10:38:49', 'SURABAYA'),
	(48, 'SBY310819-06-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '10:41:30', 'SURABAYA'),
	(49, 'SBY310819-06-000002', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '11:40:26', 'SURABAYA'),
	(50, 'SBY310819-06-000003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '11:42:08', 'SURABAYA'),
	(51, 'SBY310819-06-000004', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '11:44:14', 'SURABAYA'),
	(52, 'SBY310819-06-000005', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '12:51:15', 'SURABAYA'),
	(53, 'SBY310819-06-000006', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '20:40:43', 'SURABAYA'),
	(55, 'SBY310819-06-000008', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '20:53:05', 'SURABAYA'),
	(56, 'SBY310819-06-000009', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '21:27:38', 'SURABAYA'),
	(57, 'SBY310819-06-000010', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '21:29:04', 'SURABAYA'),
	(58, 'halo0001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-31', '22:23:30', 'SURABAYA'),
	(59, 'SBY010919-06-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-01', '17:00:22', 'SURABAYA'),
	(60, 'SBY030919-06-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-03', '08:02:52', 'SURABAYA'),
	(61, 'SBY030919-06-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-03', '08:03:05', 'SURABAYA'),
	(62, 'resimanual001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-03', '08:51:59', 'SURABAYA'),
	(65, 'resimanual003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-03', '18:45:16', 'SURABAYA'),
	(66, 'SBY310819-06-000005', 'prosess pengantaran paket', NULL, '2019-09-03', '19:15:03', 'SURABAYA'),
	(67, 'resimanual001', 'prosess pengantaran paket', NULL, '2019-09-03', '19:15:16', 'SURABAYA'),
	(68, 'haha001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-03', '19:25:06', 'SURABAYA'),
	(69, 'haha001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-03', '19:25:27', 'SURABAYA'),
	(70, 'SBY310819-06-000005', 'paket telah diterima', 'aksldf', '2019-09-03', '20:41:00', 'SURABAYA'),
	(71, 'resimanual001', 'pengantaran gagal', 'Alamat salah atau tidak lengkap', '2019-09-03', '20:41:11', 'SURABAYA'),
	(72, 'resimanual001', 'prosess pengantaran paket ulang', NULL, '2019-09-03', '20:46:12', 'SURABAYA'),
	(73, 'SBY310819-06-000003', 'prosess pengantaran paket', NULL, '2019-09-03', '20:46:21', 'SURABAYA'),
	(74, 'SBY310819-06-000003', 'paket telah diterima', 'suhadi manuk', '2019-09-03', '23:10:51', 'SURABAYA'),
	(75, 'resimanual001', 'pengantaran gagal', 'alamat salah', '2019-09-03', '23:12:12', 'SURABAYA'),
	(76, 'resimanual001', 'prosess pengantaran paket ulang', NULL, '2019-09-03', '23:13:09', 'SURABAYA'),
	(77, 'SBY310819-06-000004', 'prosess pengantaran paket', NULL, '2019-09-03', '23:13:19', 'SURABAYA'),
	(78, 'SBY310819-06-000004', 'paket telah diterima', 'maryani', '2019-09-03', '23:14:54', 'SURABAYA'),
	(79, 'resimanual001', 'dikembalikan ke pengirim', NULL, '2019-09-03', '23:15:17', 'SURABAYA'),
	(80, 'resimanual001', 'paket telah diterima', NULL, '2019-09-03', '23:16:05', 'SURABAYA'),
	(83, 'SBY310819-06-000010', 'menuju kota tujuan', NULL, '2019-09-04', '10:56:12', 'SURABAYA'),
	(88, 'SBY310819-06-000007', 'barang sampai di KLC Cabang KEDIRI', NULL, '2019-09-05', '10:32:36', 'KEDIRI'),
	(89, 'resimanual002', 'barang sampai di KLC Cabang KEDIRI', NULL, '2019-09-05', '10:33:45', 'KEDIRI'),
	(90, 'resimanual004', 'barang sampai di KLC Cabang KEDIRI', NULL, '2019-09-05', '10:34:18', 'KEDIRI'),
	(91, 'resimanual002', 'handle by vendor', NULL, '2019-09-06', '11:38:38', 'KEDIRI'),
	(92, 'resimanual004', 'handle by vendor', NULL, '2019-09-06', '11:38:46', 'KEDIRI'),
	(93, 'resicmp', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-06', '19:51:52', 'SURABAYA'),
	(94, 'citycmp001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-07', '10:35:24', 'SURABAYA'),
	(95, 'citycmp002', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-07', '10:36:04', 'SURABAYA');
/*!40000 ALTER TABLE `status_pengiriman` ENABLE KEYS */;

-- Dumping structure for table kargo.surat_antar
DROP TABLE IF EXISTS `surat_antar`;
CREATE TABLE IF NOT EXISTS `surat_antar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` varchar(50) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `pemegang` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `status` enum('Y','N','S') DEFAULT 'N',
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_antar: ~3 rows (approximately)
DELETE FROM `surat_antar`;
/*!40000 ALTER TABLE `surat_antar` DISABLE KEYS */;
INSERT INTO `surat_antar` (`id`, `id_karyawan`, `kode`, `tgl`, `pemegang`, `telp`, `status`, `id_cabang`) VALUES
	(1, '2', 'SASBY030919-06-000001', '2019-09-03', 'maryanto', '032489023', 'S', 2),
	(2, '2', 'SASBY030919-06-000002', '2019-09-03', 'maryanto', '032489023', 'S', 2),
	(3, '2', 'SASBY030919-06-000003', '2019-09-03', 'maryanto', '032489023', 'S', 2);
/*!40000 ALTER TABLE `surat_antar` ENABLE KEYS */;

-- Dumping structure for table kargo.surat_envoice
DROP TABLE IF EXISTS `surat_envoice`;
CREATE TABLE IF NOT EXISTS `surat_envoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `tujuan` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `pembuat` varchar(50) DEFAULT NULL,
  `totalkg` int(11) DEFAULT 0,
  `totalkoli` int(11) DEFAULT 0,
  `totalcash` int(11) DEFAULT 0,
  `biaya` int(11) DEFAULT 0,
  `totalbt` int(11) DEFAULT 0,
  `id_cabang` int(11) DEFAULT 1,
  `status` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_envoice: ~2 rows (approximately)
DELETE FROM `surat_envoice`;
/*!40000 ALTER TABLE `surat_envoice` DISABLE KEYS */;
INSERT INTO `surat_envoice` (`id`, `kode`, `tujuan`, `alamat`, `tgl`, `pembuat`, `totalkg`, `totalkoli`, `totalcash`, `biaya`, `totalbt`, `id_cabang`, `status`) VALUES
	(1, 'ENSBY060919-06-000001', 'pt iwak enak-14045', 'gurah', '2019-09-06', 'devasatrio', 2, 1, 10000, 0, 0, 2, 'Y'),
	(2, 'INSBY070919-06-000001', 'pt iwak enak-14045', 'gurah', '2019-09-07', 'devasatrio', 4, 2, 30000, 0, NULL, 2, 'Y');
/*!40000 ALTER TABLE `surat_envoice` ENABLE KEYS */;

-- Dumping structure for table kargo.surat_jalan
DROP TABLE IF EXISTS `surat_jalan`;
CREATE TABLE IF NOT EXISTS `surat_jalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(100) DEFAULT NULL,
  `kode` text DEFAULT NULL,
  `tujuan` text DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `status` enum('Y','N','P') DEFAULT 'N',
  `totalkg` int(11) DEFAULT NULL,
  `totalkoli` int(11) DEFAULT NULL,
  `totalcash` int(11) DEFAULT NULL,
  `totalbt` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `alamat_tujuan` varchar(70) DEFAULT NULL,
  `cabang` enum('Y','N') DEFAULT 'N',
  `katakun` int(3) DEFAULT 14,
  `id_cabang` int(11) DEFAULT 1,
  `id_cabang_tujuan` int(11) DEFAULT NULL,
  `id_cabang_transit` int(11) DEFAULT NULL,
  `status_transit` enum('Y','N') DEFAULT 'N',
  `status_pengiriman` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~3 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`, `cabang`, `katakun`, `id_cabang`, `id_cabang_tujuan`, `id_cabang_transit`, `status_transit`, `status_pengiriman`) VALUES
	(1, 'devasatrio', 'SJSBY040919-06-000001', 'KLC Cabang Kediri', '2019-09-04', 'P', 7, 3, 288000, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, 1, NULL, 'N', 'Y'),
	(2, 'devasatrio', 'SJSBY040919-06-000002', 'KLC Cabang Kediri', '2019-09-04', 'P', 7, 3, 148000, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, 1, NULL, 'N', 'Y'),
	(3, 'damara', 'SJKDR060919-15-000001', 'PT Cahya gurah-2930849023', '2019-09-06', 'Y', 4, 1, 205000, 0, NULL, 'bringin bulurejo 001 kec.gurah kediri', 'N', 14, 1, NULL, NULL, 'N', 'N');
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
  `id_cabang` int(11) DEFAULT 1,
  `tarif_city` enum('Y','N') DEFAULT 'N',
  `company` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~10 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`, `tarif_city`, `company`) VALUES
	(1, 'drt001', 'gurah', 30000, 2, '2', 2, 'N', 'N'),
	(2, 'cty001', 'kec. gabru', 3000, 10, '2', 2, 'Y', 'N'),
	(3, 'cty002', 'kec. wates', 20000, 10, '2', 2, 'Y', 'N'),
	(4, 'citycmp001', 'kec.gurah', 3000, 20, '2', 2, 'Y', 'Y'),
	(5, 'cty003', 'kec.bringin', 5000, 2, '1', 1, 'Y', 'N'),
	(6, 'cty004', 'kec.menang', 5000, 2, '1', 2, 'Y', 'N'),
	(7, 'cty005', 'kec.banyuanyar', 5000, 2, '1', 1, 'Y', 'N'),
	(8, 'citycmp002', 'desa bong', 3000, 2, '1', 2, 'Y', 'Y'),
	(9, 'citycmp003', 'desa magersari', 3000, 2, '1', 1, 'Y', 'Y'),
	(10, 'citycmp004', 'desa pujon', 4000, 2, '1', 2, 'Y', 'Y');
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
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_laut: ~0 rows (approximately)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`) VALUES
	(1, 'laut001', 'kalimantan', 40000, 2, '5', 2);
/*!40000 ALTER TABLE `tarif_laut` ENABLE KEYS */;

-- Dumping structure for table kargo.tarif_udara
DROP TABLE IF EXISTS `tarif_udara`;
CREATE TABLE IF NOT EXISTS `tarif_udara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `airlans` varchar(100) DEFAULT NULL,
  `perkg` int(11) DEFAULT 0,
  `minimal_heavy` int(11) DEFAULT 0,
  `biaya_dokumen` int(11) DEFAULT 0,
  `berat_minimal` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_udara: ~2 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `perkg`, `minimal_heavy`, `biaya_dokumen`, `berat_minimal`, `id_cabang`) VALUES
	(1, 'udara001', 'maluku', 'garuda', 25000, 5, 5000, 2, 2),
	(2, 'udara002', 'papua', 'Lion Air', 34000, 30, 5000, 2, 2);
/*!40000 ALTER TABLE `tarif_udara` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_kategoriakutansi
DROP TABLE IF EXISTS `tb_kategoriakutansi`;
CREATE TABLE IF NOT EXISTS `tb_kategoriakutansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` enum('pendapatan','pengeluaran') NOT NULL,
  `aksi` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_kategoriakutansi: ~14 rows (approximately)
DELETE FROM `tb_kategoriakutansi`;
/*!40000 ALTER TABLE `tb_kategoriakutansi` DISABLE KEYS */;
INSERT INTO `tb_kategoriakutansi` (`id`, `kode`, `nama`, `status`, `aksi`) VALUES
	(1, '001', 'Pemasukan Resi', 'pendapatan', 'N'),
	(2, '002', 'Pengeluaran Vendor', 'pengeluaran', 'N'),
	(3, '003', 'Hutang Usaha', 'pengeluaran', 'N'),
	(4, '004', 'Pajak Armada', 'pengeluaran', 'N'),
	(5, '005', 'BBM', 'pengeluaran', 'Y'),
	(6, '006', 'Service', 'pengeluaran', 'Y'),
	(7, '007', 'Parkir', 'pengeluaran', 'Y'),
	(8, '008', 'Tol', 'pengeluaran', 'Y'),
	(9, '009', 'ATK', 'pengeluaran', 'Y'),
	(10, '010', 'Listrik', 'pengeluaran', 'Y'),
	(11, '011', 'Internet', 'pengeluaran', 'Y'),
	(12, '012', 'Modal', 'pendapatan', 'N'),
	(14, '260', 'Surat Jalan', 'pengeluaran', 'Y'),
	(15, '343', 'Pajak', 'pengeluaran', 'N');
/*!40000 ALTER TABLE `tb_kategoriakutansi` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_neraca
DROP TABLE IF EXISTS `tb_neraca`;
CREATE TABLE IF NOT EXISTS `tb_neraca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(50) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `status` enum('D','K') NOT NULL,
  `total` bigint(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_neraca: ~9 rows (approximately)
DELETE FROM `tb_neraca`;
/*!40000 ALTER TABLE `tb_neraca` DISABLE KEYS */;
INSERT INTO `tb_neraca` (`id`, `tahun`, `bulan`, `kategori`, `status`, `total`) VALUES
	(195, '2018', 7, 'modal', 'K', 100000),
	(196, '2018', 7, 'Kas', 'D', 10),
	(197, '2018', 7, 'Laba', 'K', 10),
	(198, '2019', 7, 'Modal', 'K', 100000),
	(199, '2019', 7, 'Kas', 'D', 4602979),
	(200, '2019', 7, 'Laba', 'K', -335021),
	(201, '2019', 8, 'Modal', 'K', 0),
	(202, '2019', 8, 'Kas', 'D', 486000),
	(203, '2019', 8, 'Laba', 'K', 200000);
/*!40000 ALTER TABLE `tb_neraca` ENABLE KEYS */;

-- Dumping structure for table kargo.transfer
DROP TABLE IF EXISTS `transfer`;
CREATE TABLE IF NOT EXISTS `transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(11) NOT NULL DEFAULT 0,
  `tahun` int(11) NOT NULL DEFAULT 0,
  `id_cabang` varchar(10) NOT NULL DEFAULT '0',
  `cabang_tujuan` varchar(10) NOT NULL DEFAULT '0',
  `nominal` int(11) NOT NULL DEFAULT 0,
  `bukti` text NOT NULL DEFAULT '0',
  `admin` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.transfer: ~0 rows (approximately)
DELETE FROM `transfer`;
/*!40000 ALTER TABLE `transfer` DISABLE KEYS */;
INSERT INTO `transfer` (`id`, `bulan`, `tahun`, `id_cabang`, `cabang_tujuan`, `nominal`, `bukti`, `admin`) VALUES
	(1, 8, 2019, '2', '1', 245380, '2019-09-18-slide3.jpg', 'devasatrio');
/*!40000 ALTER TABLE `transfer` ENABLE KEYS */;

-- Dumping structure for table kargo.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(45) NOT NULL,
  `remember_token` varchar(50) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `remember_token`, `email`, `alamat`, `level`, `id_cabang`) VALUES
	(19, 'Admin-000001', 'satriosuklun', '$2y$10$Q.d6UaKmwOh4w.OEMPJlV.gVNK946edH55PicZFhysbu7154qWbVu', 'deifa satrio', '14045', 'GtVwaECzIqzejKCpZowysRxkbY6XrbnExKJsb10MYpoY2FPznR', 'satriosuklun@gmail.com', 'gurah kediri magersari', '2', 2),
	(20, 'Admin-000002', 'devasatrio', '$2y$10$pEOVBaxYpBS.yRNueIxZi.JWYo0L1tYiEVfsv0T.f20JsxNTv2atC', 'damara', '928901', 'gySYGPQnvii5K7RkcZaGj4JuPUY3N83KGVn9GFVD6WNZ6dfxOh', 'ridho.rezky.07@gmail.com', 'gurah', '1', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table kargo.vendor
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvendor` varchar(100) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `cabang` enum('Y','N') DEFAULT 'N',
  `id_cabang` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~4 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`, `id_cabang`) VALUES
	(11, 'VNDSBY001', 'UD SBY setia', '0283498204980', 'jln enak makan surabaya', 'N', 2),
	(12, 'VNDSBY002', 'PT SBY sejahtera', '08234723984279', 'jln mahoni subur 001 rt 01 cempaka surabaya', 'N', 2),
	(13, 'VNDSBY003', 'CV cahaya baya', '0239482390', 'desa konoha gakure surabaya', 'N', 2),
	(14, 'VNDKDR001', 'PT Cahya gurah', '2930849023', 'bringin bulurejo 001 kec.gurah kediri', 'N', 1);
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

-- Dumping structure for trigger kargo.editadmin
DROP TRIGGER IF EXISTS `editadmin`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
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
update surat_antar set pemegang=new.nama, telp=new.telp where id_karyawan=old.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.editvendor
DROP TRIGGER IF EXISTS `editvendor`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `editvendor` BEFORE UPDATE ON `vendor` FOR EACH ROW BEGIN
update surat_jalan set tujuan=concat(new.vendor,'-',new.telp) where tujuan=concat(old.vendor,'-',old.telp);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.hapus_envoice
DROP TRIGGER IF EXISTS `hapus_envoice`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `hapus_envoice` BEFORE DELETE ON `surat_envoice` FOR EACH ROW BEGIN
delete from resi_pengiriman where resi_pengiriman.kode_envoice = old.kode;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.hapus_suratantar
DROP TRIGGER IF EXISTS `hapus_suratantar`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `hapus_suratantar` BEFORE DELETE ON `surat_antar` FOR EACH ROW BEGIN
delete from resi_pengiriman where resi_pengiriman.kode_antar = old.kode;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.hapus_suratjalan
DROP TRIGGER IF EXISTS `hapus_suratjalan`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `hapus_suratjalan` BEFORE DELETE ON `surat_jalan` FOR EACH ROW BEGIN
delete from resi_pengiriman where resi_pengiriman.kode_jalan = old.kode;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.resi_pengiriman_before_delete
DROP TRIGGER IF EXISTS `resi_pengiriman_before_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `resi_pengiriman_before_delete` BEFORE DELETE ON `resi_pengiriman` FOR EACH ROW BEGIN
delete from status_pengiriman where status_pengiriman.kode = old.no_resi;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
