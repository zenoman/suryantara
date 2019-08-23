-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.absensi: ~0 rows (approximately)
DELETE FROM `absensi`;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~8 rows (approximately)
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
	(14, 'Admin-000008', 'askdfjasdkf', '827ccb0eea8a706c4c34a16891f84e7b', 'mariana', '2390482390', 'admin@gmail.com', 'ksdfjk', 'operasional_cabang', 1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table kargo.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.admins: ~3 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `password`, `nama`, `telp`, `email`, `level`) VALUES
	(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '085604556715', 'satriosuklun@gmail.com', 'admin'),
	(3, 'superadmin', '827ccb0eea8a706c4c34a16891f84e7b', 'super admin', '085682374023', 'satriosuklun@gmail.com', 'super_admin'),
	(4, 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556714', 'satriosuklun@gmail.com', 'programer');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

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

-- Dumping data for table kargo.armada: ~2 rows (approximately)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.cabang: ~3 rows (approximately)
DELETE FROM `cabang`;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`id`, `nama`, `alamat`, `kota`, `kop`, `koderesi`) VALUES
	(1, 'KLC Cabang Kediri', 'magersari gurah kediri halo halo', 'KEDIRI', NULL, 'KDR'),
	(2, 'KLC cabang suryabaya', 'aklsdfjkl', 'SURABAYA', 'kantor cabang : jln iwak enak no 2+2 konoha surabaya', 'SBY');
/*!40000 ALTER TABLE `cabang` ENABLE KEYS */;

-- Dumping structure for table kargo.detail_cancel
DROP TABLE IF EXISTS `detail_cancel`;
CREATE TABLE IF NOT EXISTS `detail_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idwarna` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `kode` text DEFAULT NULL,
  `tgl` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.detail_cancel: ~3 rows (approximately)
DELETE FROM `detail_cancel`;
/*!40000 ALTER TABLE `detail_cancel` DISABLE KEYS */;
INSERT INTO `detail_cancel` (`id`, `idwarna`, `iduser`, `kode`, `tgl`, `jumlah`, `harga`, `barang`, `total`, `diskon`) VALUES
	(5, 38, 15, 'Cancel00001', '04-12-2018', 3, 12000, 'jilbab malang 3', 36000, 0),
	(6, 32, 15, 'Cancel00001', '04-12-2018', 2, 20000, 'jilbab kediri 2', 36000, 10),
	(7, 32, 15, 'Cancel00001', '04-12-2018', 4, 20000, 'jilbab kediri 2', 72000, 10);
/*!40000 ALTER TABLE `detail_cancel` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.gaji_karyawan: ~12 rows (approximately)
DELETE FROM `gaji_karyawan`;
/*!40000 ALTER TABLE `gaji_karyawan` DISABLE KEYS */;
INSERT INTO `gaji_karyawan` (`id`, `kode_karyawan`, `nama_karyawan`, `id_jabatan`, `gaji_pokok`, `uang_makan`, `gaji_tambahan`, `total`, `bulan`, `tahun`) VALUES
	(1, 'kk001', 'deni', 1, 400000, 0, 58844, 458844, 6, 2019),
	(2, '001', 'hari', 26, 400000, 0, NULL, 430000, 6, 2019),
	(3, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 6, 2019),
	(4, 'kk001', 'deni', 1, 400000, 0, 58844, 458844, 6, 2019),
	(5, '001', 'hari', 26, 400000, 0, NULL, 430000, 6, 2019),
	(6, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 6, 2019),
	(7, 'kk001', 'deni', 1, 400000, 0, 58844, 458844, 6, 2019),
	(8, '001', 'hari', 26, 400000, 0, NULL, 430000, 6, 2019),
	(9, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 6, 2019),
	(10, 'kk001', 'deni', 1, 400000, 0, 48110, 448110, 6, 2019),
	(11, '001', 'hari', 26, 400000, 0, NULL, 430000, 6, 2019),
	(12, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 6, 2019);
/*!40000 ALTER TABLE `gaji_karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.gambar
DROP TABLE IF EXISTS `gambar`;
CREATE TABLE IF NOT EXISTS `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.gambar: ~8 rows (approximately)
DELETE FROM `gambar`;
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
INSERT INTO `gambar` (`id`, `kode_barang`, `nama`) VALUES
	(10, 'BRG00004', '1541847113-download.jpg'),
	(11, 'BRG00004', '1541847113-high-quality-muslim-hijab-scarf-cotton-jersey-hijabs-turban-muslim-hijab-infiity-scarf-muslim-head-coverings-92.jpg'),
	(12, 'BRG00005', '1541847133-images-(2).jpg'),
	(13, 'BRG00005', '1541847133-instant-wear-arabic-head-dress-rayon-hijab.jpg_350x350.jpg'),
	(14, 'BRG00006', '1541850464-21220959_b_v1.jpg'),
	(15, 'BRG00007', '1541850483-high-quality-muslim-hijab-scarf-cotton-jersey-hijabs-turban-muslim-hijab-infiity-scarf-muslim-head-coverings-92.jpg'),
	(16, 'BRG00008', '1542109148-images-(1).jpg'),
	(17, 'BRG00008', '1542109149-instant-wear-arabic-head-dress-rayon-hijab.jpg_350x350.jpg');
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;

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

-- Dumping data for table kargo.jabatan: ~4 rows (approximately)
DELETE FROM `jabatan`;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `jabatan`, `gaji_pokok`, `uang_makan`, `status`, `id_cabang`) VALUES
	(1, 'Base Managger', '400000', '30000', '1', 1),
	(24, 'Staff', '400000', '30000', '0', 1),
	(25, 'Staff Keuangan Pusat', '500000', '30000', '0', 1),
	(26, 'Staff Keuangan Cabang', '400000', '30000', '0', 1),
	(27, 'manager cabang', '20000', '3000', '1', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.karyawan: ~3 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`, `id_cabang`) VALUES
	(1, '001', 'hari', '2349023890482', 'gurah', 26, 1),
	(2, '002', 'maryanto', '032489023', 'gurah', 26, 2),
	(4, 'kk001', 'deni', '234789', 'gurah', 1, 1);
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

-- Dumping structure for table kargo.log_cancel
DROP TABLE IF EXISTS `log_cancel`;
CREATE TABLE IF NOT EXISTS `log_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(300) DEFAULT NULL,
  `total_akhir` int(11) DEFAULT NULL,
  `tgl` varchar(25) DEFAULT NULL,
  `bulan` int(5) DEFAULT NULL,
  `status` enum('dicancel','ditolak') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.log_cancel: ~0 rows (approximately)
DELETE FROM `log_cancel`;
/*!40000 ALTER TABLE `log_cancel` DISABLE KEYS */;
INSERT INTO `log_cancel` (`id`, `faktur`, `total_akhir`, `tgl`, `bulan`, `status`, `id_user`, `id_admin`, `keterangan`) VALUES
	(3, 'Cancel00001', 144000, '04-12-2018', 12, 'ditolak', 15, 4, 'GHJHHJK');
/*!40000 ALTER TABLE `log_cancel` ENABLE KEYS */;

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
  `katakun` int(3) DEFAULT 15,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak: ~6 rows (approximately)
DELETE FROM `pajak`;
/*!40000 ALTER TABLE `pajak` DISABLE KEYS */;
INSERT INTO `pajak` (`id`, `bulan`, `tahun`, `nama_pajak`, `total`, `katakun`) VALUES
	(1, 1, '2019', 'pajak', 2638, 15),
	(3, 2, '2019', 'pajak', 22425, 15),
	(4, 3, '2019', 'pajak', 0, 15),
	(5, 4, '2019', 'pajak', 8705, 15),
	(6, 5, '2019', 'pajak', 30058, 15),
	(7, 7, '2019', 'pajak', 29422, 15),
	(8, 7, '2019', 'pajak', 24055, 15);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak_armada: ~7 rows (approximately)
DELETE FROM `pajak_armada`;
/*!40000 ALTER TABLE `pajak_armada` DISABLE KEYS */;
INSERT INTO `pajak_armada` (`id`, `id_armada`, `nama_pajak`, `tgl_bayar`, `tgl_kadaluarsa`, `tgl_peringatan`) VALUES
	(1, 4, 'pajak tahunan', '2019-05-09', '2019-11-20', '2019-11-13'),
	(10, 4, 'pajak 5 tahun', '2019-05-09', '2019-11-22', '2019-11-15'),
	(11, 4, 'pajak KIR', NULL, NULL, NULL),
	(12, 1, 'pajak tahunan', '2019-05-08', '2019-06-08', '2019-06-01'),
	(13, 1, 'pajak KIR', NULL, NULL, NULL),
	(14, 5, 'kir', NULL, NULL, NULL),
	(15, 14, 'd', NULL, NULL, NULL),
	(16, 15, 'h', NULL, NULL, NULL);
/*!40000 ALTER TABLE `pajak_armada` ENABLE KEYS */;

-- Dumping structure for table kargo.pemesanans
DROP TABLE IF EXISTS `pemesanans`;
CREATE TABLE IF NOT EXISTS `pemesanans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kodePesan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iduser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choiches` enum('belum','sudah','proses') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kargo.pemesanans: ~0 rows (approximately)
DELETE FROM `pemesanans`;
/*!40000 ALTER TABLE `pemesanans` DISABLE KEYS */;
/*!40000 ALTER TABLE `pemesanans` ENABLE KEYS */;

-- Dumping structure for table kargo.pengeluaran_lain
DROP TABLE IF EXISTS `pengeluaran_lain`;
CREATE TABLE IF NOT EXISTS `pengeluaran_lain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(200) DEFAULT NULL,
  `kategori` varchar(40) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pengeluaran_lain: ~20 rows (approximately)
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
INSERT INTO `pengeluaran_lain` (`id`, `admin`, `kategori`, `keterangan`, `jumlah`, `tgl`, `gambar`) VALUES
	(3, 'abiihsan', '005', '123we', 21, '2019-07-28', NULL),
	(8, 'devasatrio', '005', 'beli bensin', 30000, '2019-07-19', '1546440740-logo.jpg'),
	(9, 'devasatrio', '007', 'parkir mobil', 20000, '2019-07-19', '1546477524-logo.jpg'),
	(10, 'devasatrio', '008', 'bayar tol surabaya', 3000, '2019-07-19', '1546482244-img-20181126-wa0003.jpg'),
	(11, 'devasatrio', '007', 'parkir jet', 40000, '2019-07-19', '1546484974-img-20181023-wa0023.jpg'),
	(12, 'devasatrio', '007', 'parkir mobil putih', 2000, '2019-07-19', '1546576232-favicon.png'),
	(13, 'devasatrio', '009', 'untuk beli alat tulis', 20000, '2019-07-19', '1550231029-500_f_212165279_5nn4hrmazulxpsbbcyutb7kn7f667gu2.jpg'),
	(14, 'devasatrio', '005', 'halo halo', 20000, '2019-07-07', '1554960625-kaos3.jpg'),
	(15, 'devasatrio', '005', 'alskjfklasfdj', 30000, '2019-07-27', '1554960686-client.png'),
	(16, 'devasatrio', '004', 'asdfasdfasfasfsf', 20000, '2019-07-12', '1555062448-1548762928-kemeja5.jpg'),
	(17, 'devasatrio', '004', 'aasfasdf', 40000, '2019-07-12', '1555063100-admin.png'),
	(18, 'devasatrio', '004', 'aadasdklfj aajsdfkljasdfk', 40000, '2019-07-12', '1555072139-client.png'),
	(19, 'devasatrio', '004', 'sdafk', 30000, '2019-07-12', '1555072654-kaos4.jpg'),
	(20, 'devasatrio', '004', 'asdf', 20000, '2019-07-12', '1555072691-kaos1.jpeg'),
	(21, 'abiihsan', '012', 'modal usaha', 100000, '2019-07-19', NULL),
	(22, 'abiihsan', '001', 'modal usaha', 100000, '2019-07-19', NULL),
	(24, 'abiihsan', '013', '45443', 40, '2019-07-29', '1559121450-9.jpg'),
	(25, 'devasatrio', '004', 'asdf', 20000, '2019-07-09', ''),
	(26, 'Auto Insert', '15', 'Pajak', 29422, '2019-08-08', NULL),
	(27, 'Auto Insert', '14', 'Gaji Karyawan', NULL, '2019-08-08', NULL),
	(28, 'Auto Insert', '211', 'Pajak', 24055, '2019-08-14', NULL),
	(29, 'Auto Insert', '244', 'Gaji Karyawan', NULL, '2019-08-14', NULL);
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

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
  `biaya_suratjalan` int(11) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `status` enum('Y','N','US','RS') DEFAULT 'N',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~16 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `kode_envoice`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `nama_penerima_barang`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_antar`, `id_cabang`, `katakun`, `status_pengiriman`, `status_company`) VALUES
	(1, 'SBY190819-06-000001', 'g122900', 'SJSBY210819-06-000001', NULL, NULL, 'devasatrio', 'tisu', 'darat', 'SURABAYA', 'magersari', '2019-08-19', '2019-08-21', '2019-08-19', 1, '1', '20 x 10 x 10', '1', 'hari', 'deni', NULL, '0923849', '90238490', 'gurah', 'magersari', 30000, 2000, 1000, 0, 0, 0, 0, 0, 33000, 200000, NULL, 'Y', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(2, 'SBY190819-06-000002', NULL, NULL, 'SASBY200819-06-000003', NULL, 'devasatrio', 'ikan asin', 'laut', 'SURABAYA', 'laut02', '2019-08-19', NULL, '2019-08-19', 2, '6', '30 x 20 x 40', '6', 'hari', 'dini', 'dini', '90283490290', '90234890', 'magersari', 'kjasdklf', 204000, 20000, 1000, 0, 0, 0, 0, 0, 225000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(3, 'SBY190819-06-000003', '923849', NULL, 'SASBY200819-06-000001', NULL, 'devasatrio', 'merpati', 'udara', 'SURABAYA', 'kab.kediri', '2019-08-19', NULL, '2019-08-19', 3, '65', '-', '-', 'hari', 'klsadjf', 'deva satrio', '9238490', '90238490', 'jklsadfj', 'saklfjkl', 300000, 0, 0, 0, 1000, 10000, 300000, 0, 611000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(4, 'SBY190819-06-000004', NULL, NULL, 'SASBY200819-06-000001', NULL, 'devasatrio', 'sepatu bola', 'city kurier', 'SURABAYA', 'kec. ngancar', '2019-08-19', NULL, '2019-08-19', 1, '3', '30 x 20 x 10', '2', 'hari', 'klasdjkl', 'klasdjkl', '29034890', '293490', 'askldfjklasd', 'klasdjfkl', 6000, 2000, 1000, 0, 0, 0, 0, 0, 9000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(5, 'citycompany001', NULL, NULL, 'SASBY200819-06-000006', NULL, 'devasatrio', 'sepatu gajah', 'city kurier', 'SURABAYA', 'kec. pagu', '2019-08-19', NULL, '2019-08-19', 1, '2', '30 x 40 x 10', '3', 'haris', 'marta', 'marta', '9238904', '29304290', 'gurah', 'ngasem', 3000, 2000, 1000, 0, 0, 0, 0, 0, 6000, 0, 'Tempat penerima tutup', 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'Y'),
	(6, 'resimanual001', '290489', NULL, 'SASBY200819-06-000006', NULL, 'devasatrio', 'burung kakak adik', 'udara', 'SURABAYA', 'kab.kediri', '2019-08-20', NULL, '2019-08-20', 2, '2', '-', '-', 'haris', 'milea', 'milea', '92038490', '20394890', 'banjaran', 'asklfj sadjfklasfd', 14000, 0, 0, 0, 25000, 2000, 14000, 0, 55000, 0, 'Alamat salah atau tidak lengkap', 'US', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(7, 'resimanual002', NULL, NULL, 'SASBY200819-06-000004', NULL, 'devasatrio', 'laut', 'laut', 'SURABAYA', 'laut25', '2019-08-20', NULL, NULL, 1, '2', '20 x 30 x 10', '2', 'hari', 'sskladf', 'sskladf', '20348290', '239034890', 'jklsadjf', 'sskaldfjkl', 24038, 2000, 1000, 0, 0, 0, 0, 0, 27038, 0, 'maaf motor rusak', 'N', 'kg', 'bt', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(8, 'resimanual003', NULL, NULL, 'SASBY200819-06-000005', NULL, 'devasatrio', 'sepatu kuda', 'darat', 'SURABAYA', 'magersari', '2019-08-20', NULL, '2019-08-20', 1, '20', '30 x 20 x 10', '2', 'halo', 'klasdfjkl', 'klasdfjkl', '29038490', '23094890', 'jskladjfkl', 'jklsadjfkl', 600000, 2000, 1000, 0, 0, 0, 0, 0, 603000, 0, 'maaf motor rusak', 'US', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(10, 'resimanual005', NULL, NULL, 'SASBY200819-06-000002', NULL, 'devasatrio', 'semvak', 'city kurier', 'SURABAYA', 'kec. ngancar', '2019-08-20', NULL, NULL, 1, '2', '30 x 20 x 10', '2', 'halo halo', 'aksldfj', 'aksldfj', '20938490', '90143890', 'skladfjkl', 'klsajdfkl', 4000, 2000, 1000, 0, 0, 0, 0, 0, 7000, 0, NULL, 'N', 'kg', 'bt', 'manual', '4', 'N', 'Y', 2, 1, 'paket telah diterima', 'N'),
	(11, 'SBY210819-06-000001', NULL, 'SJSBY210819-06-000002', NULL, NULL, 'devasatrio', 'liquit', 'darat', 'SURABAYA', 'magersari', '2019-08-21', NULL, '2019-08-21', 1, '5', '30 x 20 x 40', '6', 'hariono', 'dewi', NULL, '209348920', '9284920', 'gurah', 'jakarta', 180000, 2000, 1000, 0, 0, 0, 0, 0, 183000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N'),
	(12, 'SBY210819-06-000002', NULL, 'SJSBY210819-06-000002', NULL, NULL, 'devasatrio', 'garam asin', 'laut', 'SURABAYA', 'laut02', '2019-08-21', NULL, '2019-08-21', 1, '3', '30 x 40 x 10', '3', 'halo', 'klasdfj', NULL, '23384902', '9023849', 'ksladjfkl skadjkl', 'jkasldfj', 102000, 2000, 1000, 0, 0, 0, 0, 0, 105000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N'),
	(13, 'SBY210819-06-000003', NULL, 'SJSBY210819-06-000003', NULL, NULL, 'devasatrio', 'jas hujan', 'darat', 'SURABAYA', 'magersari', '2019-08-21', NULL, '2019-08-21', 1, '4', '40 x 30 x 20', '6', 'haris', 'dendi', NULL, '902384902', '9302490', 'gurah', 'magersari', 180000, 2000, 1000, 0, 0, 0, 0, 0, 183000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N'),
	(18, 'SBY220819-06-000001', NULL, 'SJSBY220819-06-000001', NULL, NULL, 'devasatrio', 'rujak', 'darat', 'SURABAYA', 'magersari', '2019-08-22', NULL, '2019-08-22', 1, '2', '30 x 20 x 10', '2', 'haro', 'sakldfj', NULL, '29834902', '928490', 'gurah', 'askldjkl', 60000, 2000, 1000, 0, 0, 0, 0, 0, 63000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N'),
	(19, 'SBY220819-06-000002', NULL, 'SJSBY220819-06-000002', NULL, NULL, 'devasatrio', 'halo', 'laut', 'SURABAYA', 'laut02', '2019-08-22', NULL, '2019-08-22', 1, '2', '20 x 10 x 20', '1', 'halo', '0239890', NULL, '2489028', '023940', 'gurah', 'jkasldfj', 68000, 2000, 1000, 0, 0, 0, 0, 0, 71000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'menuju kota tujuan', 'N'),
	(20, 'SBY220819-06-000003', NULL, 'SJSBY220819-06-000003', NULL, NULL, 'devasatrio', 'ikan asinn', 'laut', 'SURABAYA', 'laut02', '2019-08-22', NULL, '2019-08-22', 1, '2', '30 x 40 x 40', '12', 'halo', 'hai', NULL, '8274892', '92038490', 'gurah', 'magersari', 408000, 2000, 1000, 0, 0, 0, 0, 0, 411000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N'),
	(21, 'SBY220819-06-000004', NULL, 'SJSBY220819-06-000003', NULL, NULL, 'devasatrio', 'teh gelas', 'laut', 'SURABAYA', 'laut02', '2019-08-22', NULL, '2019-08-22', 1, '1', '40 x 40 x 30', '12', 'hasdlfjkl', 'ksdafdjkl', NULL, '29038490', '20938490', 'jklsadjfkl asdfjaskl', 'jaksdjf', 408000, 2000, 1000, 0, 0, 0, 0, 0, 411000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N');
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
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `desk_udara`, `desk_laut`, `desk_darat`, `status`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', 'Y', 8);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table kargo.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `idsettings` int(11) NOT NULL AUTO_INCREMENT,
  `webName` varchar(100) DEFAULT NULL,
  `kontak1` varchar(45) DEFAULT NULL,
  `kontak2` varchar(45) DEFAULT NULL,
  `kontak3` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `ico` varchar(45) DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `keterangan` int(11) DEFAULT NULL,
  `alamat` int(11) DEFAULT NULL,
  `nama_toko` int(11) DEFAULT NULL,
  `max_tgl` int(5) DEFAULT NULL,
  PRIMARY KEY (`idsettings`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.settings: ~0 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`idsettings`, `webName`, `kontak1`, `kontak2`, `kontak3`, `email`, `ico`, `meta`, `logo`, `keterangan`, `alamat`, `nama_toko`, `max_tgl`) VALUES
	(1, 'Devina', '085604556777', '089456817354', '085601473652', 'satriosuklun@gmail.com', '1542366882-190835.png', 'toko hijab murah meriah', '1543717647-logo-dvina.png', NULL, NULL, NULL, 2);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table kargo.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.sliders: ~0 rows (approximately)
DELETE FROM `sliders`;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `judul`, `foto`) VALUES
	(2, 'ini slide 2 baru gambarnya', '1541552859-20180227_054709.jpg');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.status_pengiriman: ~54 rows (approximately)
DELETE FROM `status_pengiriman`;
/*!40000 ALTER TABLE `status_pengiriman` DISABLE KEYS */;
INSERT INTO `status_pengiriman` (`id`, `kode`, `status`, `keterangan`, `tgl`, `jam`, `lokasi`) VALUES
	(1, 'SBY190819-06-000001', 'barang diterima cabang SURABAYA', NULL, '2019-08-19', '18:29:23', 'SURABAYA'),
	(2, 'SBY190819-06-000002', 'barang diterima cabang SURABAYA', NULL, '2019-08-19', '18:31:25', 'SURABAYA'),
	(3, 'SBY190819-06-000003', 'barang diterima cabang SURABAYA', NULL, '2019-08-19', '18:37:29', 'SURABAYA'),
	(4, 'SBY190819-06-000004', 'barang diterima cabang SURABAYA', NULL, '2019-08-19', '18:41:13', 'SURABAYA'),
	(5, 'citycompany001', 'barang diterima cabang SURABAYA', NULL, '2019-08-19', '18:44:10', 'SURABAYA'),
	(6, 'resimanual003', 'barang diterima cabang SURABAYA', NULL, '2019-08-20', '09:25:34', 'SURABAYA'),
	(7, 'resimanual002', 'barang diterima cabang SURABAYA', NULL, '2019-08-20', '09:27:47', 'SURABAYA'),
	(8, 'resimanual001', 'barang diterima cabang SURABAYA', NULL, '2019-08-20', '09:29:56', 'SURABAYA'),
	(9, 'resimanual005', 'barang diterima cabang SURABAYA', NULL, '2019-08-20', '09:32:31', 'SURABAYA'),
	(10, 'SBY190819-06-000004', 'prosess pengantaran paket', NULL, '2019-08-20', '09:40:05', 'SURABAYA'),
	(12, 'SBY190819-06-000003', 'prosess pengantaran paket', NULL, '2019-08-20', '09:44:23', 'SURABAYA'),
	(13, 'SBY190819-06-000003', 'paket telah diterima', 'deva satrio', '2019-08-20', '10:06:17', 'SURABAYA'),
	(14, 'SBY190819-06-000004', 'paket telah diterima', 'klasdjkl', '2019-08-20', '10:06:45', 'SURABAYA'),
	(15, 'citycompany001', 'prosess pengantaran paket', NULL, '2019-08-20', '10:12:13', 'SURABAYA'),
	(16, 'resimanual003', 'prosess pengantaran paket', NULL, '2019-08-20', '10:12:46', 'SURABAYA'),
	(17, 'resimanual005', 'prosess pengantaran paket', NULL, '2019-08-20', '10:12:57', 'SURABAYA'),
	(18, 'citycompany001', 'pengantaran gagal', 'Alamat salah atau tidak lengkap', '2019-08-20', '10:18:37', 'SURABAYA'),
	(19, 'resimanual003', 'pengantaran gagal', 'Tempat penerima tutup', '2019-08-20', '10:21:39', 'SURABAYA'),
	(20, 'resimanual005', 'paket telah diterima', 'aksldfj', '2019-08-20', '10:21:49', 'SURABAYA'),
	(21, 'SBY190819-06-000002', 'prosess pengantaran paket', NULL, '2019-08-20', '11:16:01', 'SURABAYA'),
	(22, 'resimanual002', 'prosess pengantaran paket', NULL, '2019-08-20', '11:16:19', 'SURABAYA'),
	(23, 'citycompany001', 'prosess pengantaran paket ulang', NULL, '2019-08-20', '11:16:48', 'SURABAYA'),
	(24, 'citycompany001', 'pengantaran gagal', 'Kurir salah mengambil rute', '2019-08-20', '11:18:22', 'SURABAYA'),
	(25, 'SBY190819-06-000002', 'paket telah diterima', 'dini', '2019-08-20', '11:18:39', 'SURABAYA'),
	(26, 'resimanual002', 'pengantaran gagal', 'maaf motor rusak', '2019-08-20', '11:19:13', 'SURABAYA'),
	(27, 'resimanual003', 'prosess pengantaran paket ulang', NULL, '2019-08-20', '11:25:47', 'SURABAYA'),
	(28, 'resimanual002', 'prosess pengantaran paket ulang', NULL, '2019-08-20', '11:29:22', 'SURABAYA'),
	(29, 'resimanual002', 'paket telah diterima', 'sskladf', '2019-08-20', '11:38:30', 'SURABAYA'),
	(30, 'resimanual003', 'pengantaran gagal', 'maaf motor rusak', '2019-08-20', '11:39:01', 'SURABAYA'),
	(35, 'resimanual001', 'prosess pengantaran paket', NULL, '2019-08-20', '12:21:56', 'SURABAYA'),
	(36, 'citycompany001', 'prosess pengantaran paket', NULL, '2019-08-20', '12:22:13', 'SURABAYA'),
	(37, 'resimanual003', 'prosess pengantaran paket ulang', NULL, '2019-08-20', '12:22:35', 'SURABAYA'),
	(38, 'resimanual003', 'paket telah diterima', 'klasdfjkl', '2019-08-20', '14:20:39', 'SURABAYA'),
	(39, 'resimanual001', 'pengantaran gagal', 'Alamat salah atau tidak lengkap', '2019-08-20', '14:20:49', 'SURABAYA'),
	(40, 'citycompany001', 'pengantaran gagal', 'Tempat penerima tutup', '2019-08-20', '14:21:07', 'SURABAYA'),
	(43, 'citycompany001', 'prosess pengantaran paket ulang', NULL, '2019-08-20', '14:24:31', 'SURABAYA'),
	(44, 'resimanual001', 'prosess pengantaran paket ulang', NULL, '2019-08-20', '14:25:54', 'SURABAYA'),
	(45, 'citycompany001', 'paket telah diterima', 'marta', '2019-08-20', '14:27:49', 'SURABAYA'),
	(46, 'resimanual001', 'paket telah diterima', 'milea', '2019-08-20', '14:28:00', 'SURABAYA'),
	(47, 'SBY190819-06-000001', 'handle by vendor', NULL, '2019-08-21', '10:21:20', 'SURABAYA'),
	(48, 'SBY190819-06-000001', 'paket telah diterima', NULL, '2019-08-21', '10:55:08', 'SURABAYA'),
	(49, 'SBY210819-06-000001', 'barang diterima cabang SURABAYA', NULL, '2019-08-21', '11:33:58', 'SURABAYA'),
	(50, 'SBY210819-06-000002', 'barang diterima cabang SURABAYA', NULL, '2019-08-21', '11:36:34', 'SURABAYA'),
	(51, 'SBY210819-06-000001', 'handle by vendor', NULL, '2019-08-21', '11:37:35', 'SURABAYA'),
	(52, 'SBY210819-06-000002', 'handle by vendor', NULL, '2019-08-21', '11:38:48', 'SURABAYA'),
	(53, 'SBY210819-06-000003', 'barang diterima cabang SURABAYA', NULL, '2019-08-21', '16:54:05', 'SURABAYA'),
	(56, 'SBY210819-06-000003', 'handle by vendor', NULL, '2019-08-21', '17:02:20', 'SURABAYA'),
	(63, 'SBY220819-06-000001', 'barang diterima cabang SURABAYA', NULL, '2019-08-22', '10:19:44', 'SURABAYA'),
	(64, 'SBY220819-06-000002', 'barang diterima cabang SURABAYA', NULL, '2019-08-22', '10:21:22', 'SURABAYA'),
	(65, 'SBY220819-06-000001', 'handle by vendor', NULL, '2019-08-22', '10:22:49', 'SURABAYA'),
	(66, 'SBY220819-06-000002', 'menuju kota tujuan', NULL, '2019-08-22', '10:27:07', 'SURABAYA'),
	(67, 'SBY220819-06-000003', 'barang diterima cabang SURABAYA', NULL, '2019-08-22', '10:35:29', 'SURABAYA'),
	(68, 'SBY220819-06-000004', 'barang diterima cabang SURABAYA', NULL, '2019-08-22', '11:11:02', 'SURABAYA'),
	(72, 'SBY220819-06-000003', 'handle by vendor', NULL, '2019-08-22', '11:24:09', 'SURABAYA'),
	(73, 'SBY220819-06-000004', 'handle by vendor', NULL, '2019-08-22', '11:24:23', 'SURABAYA');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_antar: ~6 rows (approximately)
DELETE FROM `surat_antar`;
/*!40000 ALTER TABLE `surat_antar` DISABLE KEYS */;
INSERT INTO `surat_antar` (`id`, `id_karyawan`, `kode`, `tgl`, `pemegang`, `telp`, `status`, `id_cabang`) VALUES
	(1, '2', 'SASBY200819-06-000001', '2019-08-20', 'maryanto', '032489023', 'S', 2),
	(2, '2', 'SASBY200819-06-000002', '2019-08-20', 'maryanto', '032489023', 'S', 2),
	(3, '2', 'SASBY200819-06-000003', '2019-08-20', 'maryanto', '032489023', 'S', 2),
	(4, '2', 'SASBY200819-06-000004', '2019-08-20', 'maryanto', '032489023', 'S', 2),
	(5, '2', 'SASBY200819-06-000005', '2019-08-20', 'maryanto', '032489023', 'S', 2),
	(6, '2', 'SASBY200819-06-000006', '2019-08-20', 'maryanto', '032489023', 'S', 2);
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

-- Dumping data for table kargo.surat_envoice: ~1 rows (approximately)
DELETE FROM `surat_envoice`;
/*!40000 ALTER TABLE `surat_envoice` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~6 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`, `cabang`, `katakun`, `id_cabang`, `id_cabang_tujuan`, `id_cabang_transit`, `status_transit`) VALUES
	(1, 'devasatrio', 'SJSBY210819-06-000001', 'ph ksdjf-293849', '2019-08-21', 'P', 1, 1, 33000, 0, 200000, 'loceret', 'N', 14, 2, NULL, NULL, 'N'),
	(2, 'devasatrio', 'SJSBY210819-06-000002', 'KLC Cabang Kediri-undefined', '2019-08-21', 'P', 8, 2, 288000, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, NULL, NULL, 'N'),
	(3, NULL, 'SJSBY210819-06-000003', NULL, '2019-08-21', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 'N', 14, 2, NULL, NULL, 'N'),
	(6, 'devasatrio', 'SJSBY220819-06-000001', 'ph ksdjf-293849', '2019-08-22', 'Y', 2, 1, 63000, 0, NULL, 'loceret', 'N', 14, 2, NULL, NULL, 'N'),
	(7, 'devasatrio', 'SJSBY220819-06-000002', 'KLC Cabang Kediri', '2019-08-22', 'P', 2, 1, 71000, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, 1, NULL, 'N'),
	(8, 'devasatrio', 'SJSBY220819-06-000003', 'pt salkdfj-20389', '2019-08-22', 'Y', 3, 2, 822000, 0, NULL, 'nganjuk', 'N', 14, 2, NULL, NULL, 'N');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~5 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`, `tarif_city`, `company`) VALUES
	(20, 'darat001', 'gurah', 20000, 2, '2', 1, 'N', 'N'),
	(21, 'darat002', 'magersari', 30000, 2, '2', 2, 'N', 'N'),
	(22, 'citykdr001', 'kec. gabru', 30000, 1, '1', 1, 'Y', 'Y'),
	(23, 'citycmpkdr002', 'kec. ngasem', 2000, 1, '1', 1, 'Y', 'N'),
	(24, 'ctysby001', 'kec. ngancar', 2000, 1, '2', 2, 'Y', 'N'),
	(25, 'ctycmpsby001', 'kec. pagu', 1000, 1, '1', 2, 'Y', 'Y');
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_laut: ~32 rows (approximately)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`) VALUES
	(6, 'laut004', 'manado', 40000, 1, '2', 1),
	(7, 'laut0009', 'laut01', 34000, 34, '2', 1),
	(8, 'laut0010', 'laut02', 34000, 34, '2', 1),
	(9, 'laut0011', 'laut03', 34000, 34, '2', 1),
	(10, 'laut0012', 'laut04', 34000, 34, '2', 1),
	(11, 'laut0013', 'laut05', 34000, 34, '2', 1),
	(12, 'laut0014', 'laut06', 34000, 34, '2', 1),
	(13, 'wer', 'qwer', 2334, 23, '23', 1),
	(14, 'laut0001', 'laut01', 10000, 34, '2', 1),
	(15, 'laut0002', 'laut02', 34000, 20, '2', 2),
	(16, 'laut0003', 'laut03', 34000, 34, '2', 1),
	(17, 'laut0004', 'laut04', 40000, 10, '2', 1),
	(18, 'laut0005', 'laut05', 34000, 34, '2', 1),
	(19, 'laut0006', 'laut06', 12000, 11, '2', 1),
	(27, 'laut0020', 'laut20', 12014, 25, '2', 1),
	(28, 'laut0021', 'laut21', 12015, 26, '2', 1),
	(29, 'laut0022', 'laut22', 12016, 27, '2', 1),
	(30, 'laut0023', 'laut23', 12017, 28, '2', 1),
	(31, 'laut0024', 'laut24', 12018, 29, '2', 1),
	(32, 'laut0025', 'laut25', 12019, 30, '2', 2),
	(33, 'laut0026', 'laut26', 12020, 31, '2', 1),
	(34, 'laut0027', 'laut27', 12021, 32, '2', 1),
	(35, 'laut0028', 'laut28', 12022, 33, '2', 1),
	(36, 'laut0029', 'laut29', 12023, 34, '2', 1),
	(37, 'laut0030', 'laut30', 12024, 35, '2', 1),
	(38, 'laut0031', 'laut31', 12025, 36, '2', 1),
	(39, 'laut0032', 'laut32', 12026, 37, '2', 1),
	(40, 'laut0033', 'laut33', 12027, 38, '2', 1),
	(41, 'laut0034', 'laut34', 12028, 39, '2', 1),
	(42, 'laut0035', 'laut35', 12029, 40, '2', 1),
	(43, 'laut0036', 'laut36', 12030, 41, '2', 1),
	(44, 'laut0037', 'laut37', 12031, 42, '2', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_udara: ~25 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `perkg`, `minimal_heavy`, `biaya_dokumen`, `berat_minimal`, `id_cabang`) VALUES
	(6, 'udara0001', 'bandung betet', 'LION', 20000, 55, 5000, 15, 1),
	(7, 'udara0002', 'banten', 'LION', 20000, 55, 5000, 15, 1),
	(8, 'udara0003', 'bali', 'LION', 20000, 55, 5000, 11, 1),
	(9, 'udara0004', 'bandung betet', 'garuda', 20000, 55, 5000, 11, 1),
	(10, 'udara0005', 'bali', 'garuda', 30000, 55, 5000, 11, 1),
	(11, 'udara0006', 'lampung', 'citilink', 20000, 55, 5000, 12, 1),
	(12, 'udara0007', 'kalimantan', 'garuda', 20000, 55, 5000, 10, 1),
	(13, 'udara0008', 'lampung', 'Lion NR', 30000, 55, 5000, 15, 1),
	(14, 'udara0009', 'udara0009', 'LION', 20000, 55, 5000, 10, 1),
	(15, 'udara0010', 'udara0010', 'LION', 20000, 55, 5000, 12, 1),
	(17, 'udara011', 'papua', 'garuda', 500000, 50, 25000, 11, 1),
	(18, 'udara0012', 'lombok', 'LION', 40000, 50, 25000, 11, 1),
	(19, 'udara0013', 'cikarang', 'LION', 45000, 405, 25000, 11, 2),
	(20, 'udara0014', 'situbondo', 'garuda', 50000, 30, 25000, 11, 2),
	(21, 'udara0015', 'ngadiboyo', 'garuda', 30000, 50, 25000, 11, 1),
	(22, 'eriweir', 'gurah', 'sdklfj', 30000, 50, 4000, 2, 2),
	(23, 'newu001', 'magersari', 'lion', 4000, 20, 20000, 5, 1),
	(24, 'newu002', 'gurah', 'garuda', 5000, 10, 30000, 5, 2),
	(25, 'newu003', 'kab.kediri', 'citylink', 7000, 10, 25000, 5, 2),
	(26, 'newu001', 'magersari', 'lion', 4000, 20, 20000, 5, 1),
	(27, 'newu002', 'gurah', 'garuda', 5000, 10, 30000, 5, 2),
	(28, 'newu003', 'kab.kediri', 'citylink', 7000, 10, 25000, 5, 2),
	(29, 'newu001', 'magersari', 'lion', 4000, 20, 20000, 5, 1),
	(30, 'newu002', 'gurah', 'garuda', 5000, 10, 30000, 5, 2),
	(31, 'newu003', 'kab.kediri', 'citylink', 7000, 10, 25000, 5, 2);
/*!40000 ALTER TABLE `tarif_udara` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_bank
DROP TABLE IF EXISTS `tb_bank`;
CREATE TABLE IF NOT EXISTS `tb_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(40) DEFAULT NULL,
  `rekening` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_bank: ~5 rows (approximately)
DELETE FROM `tb_bank`;
/*!40000 ALTER TABLE `tb_bank` DISABLE KEYS */;
INSERT INTO `tb_bank` (`id`, `nama_bank`, `rekening`) VALUES
	(1, 'bayar ditoko\r\n', '-'),
	(2, 'bri', '009887878'),
	(3, 'bni', '0111'),
	(4, 'bank jatim', '0222'),
	(5, 'mandiri Syariah', '0333');
/*!40000 ALTER TABLE `tb_bank` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_barangouts
DROP TABLE IF EXISTS `tb_barangouts`;
CREATE TABLE IF NOT EXISTS `tb_barangouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_barangouts: ~0 rows (approximately)
DELETE FROM `tb_barangouts`;
/*!40000 ALTER TABLE `tb_barangouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_barangouts` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_barangs
DROP TABLE IF EXISTS `tb_barangs`;
CREATE TABLE IF NOT EXISTS `tb_barangs` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `warna` varchar(45) DEFAULT NULL,
  `barang_jenis` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_barangs: ~10 rows (approximately)
DELETE FROM `tb_barangs`;
/*!40000 ALTER TABLE `tb_barangs` DISABLE KEYS */;
INSERT INTO `tb_barangs` (`idbarang`, `kode`, `stok`, `warna`, `barang_jenis`) VALUES
	(32, 'BRG00004', 10, 'merah', 'jilbab kediri 2 merah'),
	(33, 'BRG00004', 10, 'biru', 'jilbab kediri 2 biru'),
	(34, 'BRG00005', 10, 'putih', 'jilbab malang 2 putih'),
	(35, 'BRG00005', 2, 'putih merah', 'jilbab malang 2 putih merah'),
	(36, 'BRG00006', 10, 'merah', 'jilbab kediri 3 merah'),
	(37, 'BRG00006', 12, 'biru', 'jilbab kediri 3 biru'),
	(38, 'BRG00007', 10, 'putih', 'jilbab malang 3 putih'),
	(39, 'BRG00007', 2, 'putih merah', 'jilbab malang 3 putih merah'),
	(40, 'BRG00008', 20, 'hitam', 'jilbab keren hitam'),
	(41, 'BRG00008', 10, 'biru', 'jilbab keren biru');
/*!40000 ALTER TABLE `tb_barangs` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_details
DROP TABLE IF EXISTS `tb_details`;
CREATE TABLE IF NOT EXISTS `tb_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idwarna` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `tgl` varchar(30) DEFAULT NULL,
  `tgl_kadaluarsa` varchar(30) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_a` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `admin` varchar(100) DEFAULT NULL,
  `metode` enum('langsung','pesan') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_details: ~2 rows (approximately)
DELETE FROM `tb_details`;
/*!40000 ALTER TABLE `tb_details` DISABLE KEYS */;
INSERT INTO `tb_details` (`id`, `idwarna`, `iduser`, `faktur`, `tgl`, `tgl_kadaluarsa`, `kode_barang`, `barang`, `harga`, `jumlah`, `total_a`, `diskon`, `total`, `admin`, `metode`) VALUES
	(6, 34, 15, 'DVINA00003', '04-12-2018', '6-12-2018', 'BRG00005', 'jilbab malang 2', 12000, 2, 24000, 0, 24000, NULL, 'pesan'),
	(9, 33, 3213, NULL, NULL, NULL, 'br001', 'mm', 9000, 2, 0, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tb_details` ENABLE KEYS */;

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

-- Dumping structure for table kargo.tb_kategoris
DROP TABLE IF EXISTS `tb_kategoris`;
CREATE TABLE IF NOT EXISTS `tb_kategoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_kategoris: ~4 rows (approximately)
DELETE FROM `tb_kategoris`;
/*!40000 ALTER TABLE `tb_kategoris` DISABLE KEYS */;
INSERT INTO `tb_kategoris` (`id`, `kategori`, `gambar`) VALUES
	(4, 'kerudung wanita', '1541756913-0056a08d4b2c91f.jpg'),
	(5, 'kerudung top', '1541851060-34-android-flat.png'),
	(6, 'kerudung mantul', '1541851081-190835.png'),
	(7, 'kerudung sip', '1541851116-1.jpg');
/*!40000 ALTER TABLE `tb_kategoris` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_kodes
DROP TABLE IF EXISTS `tb_kodes`;
CREATE TABLE IF NOT EXISTS `tb_kodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(150) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `diskon` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_kodes: ~5 rows (approximately)
DELETE FROM `tb_kodes`;
/*!40000 ALTER TABLE `tb_kodes` DISABLE KEYS */;
INSERT INTO `tb_kodes` (`id`, `id_kategori`, `kode_barang`, `barang`, `harga_barang`, `deskripsi`, `diskon`) VALUES
	(19, 4, 'BRG00004', 'jilbab kediri 2', 20000, 'ini deskripsi jilbab kediri', 10),
	(20, 4, 'BRG00005', 'jilbab malang 2', 12000, 'ini deskripsi jilbab malang', 0),
	(21, 4, 'BRG00006', 'jilbab kediri 3', 20000, 'ini deskripsi jilbab kediri 3', 5),
	(22, 4, 'BRG00007', 'jilbab malang 3', 12000, 'ini deskripsi jilbab malang 3', 0),
	(23, 6, 'BRG00008', 'jilbab keren', 25000, 'kerudung mantab untuk sehari hari', 15);
/*!40000 ALTER TABLE `tb_kodes` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_neraca: ~5 rows (approximately)
DELETE FROM `tb_neraca`;
/*!40000 ALTER TABLE `tb_neraca` DISABLE KEYS */;
INSERT INTO `tb_neraca` (`id`, `tahun`, `bulan`, `kategori`, `status`, `total`) VALUES
	(195, '2018', 7, 'modal', 'K', 100000),
	(196, '2018', 7, 'Kas', 'D', 10),
	(197, '2018', 7, 'Laba', 'K', 10),
	(198, '2019', 7, 'Modal', 'K', 100000),
	(199, '2019', 7, 'Kas', 'D', 4602979),
	(200, '2019', 7, 'Laba', 'K', -335021);
/*!40000 ALTER TABLE `tb_neraca` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_stokawals
DROP TABLE IF EXISTS `tb_stokawals`;
CREATE TABLE IF NOT EXISTS `tb_stokawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) DEFAULT NULL,
  `idwarna` int(11) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_stokawals: ~174 rows (approximately)
DELETE FROM `tb_stokawals`;
/*!40000 ALTER TABLE `tb_stokawals` DISABLE KEYS */;
INSERT INTO `tb_stokawals` (`id`, `idbarang`, `idwarna`, `kode_barang`, `barang`, `jumlah`, `tgl`) VALUES
	(39, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '10-11-2018'),
	(40, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '10-11-2018'),
	(41, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '10-11-2018'),
	(42, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '10-11-2018'),
	(43, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '10-11-2018'),
	(44, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '10-11-2018'),
	(45, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '10-11-2018'),
	(46, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '10-11-2018'),
	(47, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '11-11-2018'),
	(48, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '11-11-2018'),
	(49, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '11-11-2018'),
	(50, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '11-11-2018'),
	(51, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '11-11-2018'),
	(52, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '11-11-2018'),
	(53, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '11-11-2018'),
	(54, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '11-11-2018'),
	(55, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '12-11-2018'),
	(56, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '12-11-2018'),
	(57, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '12-11-2018'),
	(58, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '12-11-2018'),
	(59, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '12-11-2018'),
	(60, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '12-11-2018'),
	(61, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '12-11-2018'),
	(62, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '12-11-2018'),
	(63, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '13-11-2018'),
	(64, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '13-11-2018'),
	(65, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '13-11-2018'),
	(66, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '13-11-2018'),
	(67, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '13-11-2018'),
	(68, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '13-11-2018'),
	(69, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '13-11-2018'),
	(70, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '13-11-2018'),
	(71, 23, 40, 'BRG00008', 'jilbab keren', 20, '13-11-2018'),
	(72, 23, 41, 'BRG00008', 'jilbab keren', 10, '13-11-2018'),
	(73, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '15-11-2018'),
	(74, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '15-11-2018'),
	(75, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '15-11-2018'),
	(76, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '15-11-2018'),
	(77, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '15-11-2018'),
	(78, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '15-11-2018'),
	(79, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '15-11-2018'),
	(80, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '15-11-2018'),
	(81, 23, 40, 'BRG00008', 'jilbab keren', 20, '15-11-2018'),
	(82, 23, 41, 'BRG00008', 'jilbab keren', 10, '15-11-2018'),
	(83, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '16-11-2018'),
	(84, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '16-11-2018'),
	(85, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '16-11-2018'),
	(86, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '16-11-2018'),
	(87, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '16-11-2018'),
	(88, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '16-11-2018'),
	(89, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '16-11-2018'),
	(90, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '16-11-2018'),
	(91, 23, 40, 'BRG00008', 'jilbab keren', 20, '16-11-2018'),
	(92, 23, 41, 'BRG00008', 'jilbab keren', 10, '16-11-2018'),
	(93, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '19-11-2018'),
	(94, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '19-11-2018'),
	(95, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '19-11-2018'),
	(96, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '19-11-2018'),
	(97, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '19-11-2018'),
	(98, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '19-11-2018'),
	(99, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '19-11-2018'),
	(100, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '19-11-2018'),
	(101, 23, 40, 'BRG00008', 'jilbab keren', 20, '19-11-2018'),
	(102, 23, 41, 'BRG00008', 'jilbab keren', 10, '19-11-2018'),
	(103, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '24-11-2018'),
	(104, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '24-11-2018'),
	(105, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '24-11-2018'),
	(106, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '24-11-2018'),
	(107, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '24-11-2018'),
	(108, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '24-11-2018'),
	(109, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '24-11-2018'),
	(110, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '24-11-2018'),
	(111, 23, 40, 'BRG00008', 'jilbab keren', 20, '24-11-2018'),
	(112, 23, 41, 'BRG00008', 'jilbab keren', 10, '24-11-2018'),
	(113, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '25-11-2018'),
	(114, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '25-11-2018'),
	(115, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '25-11-2018'),
	(116, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '25-11-2018'),
	(117, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '25-11-2018'),
	(118, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '25-11-2018'),
	(119, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '25-11-2018'),
	(120, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '25-11-2018'),
	(121, 23, 40, 'BRG00008', 'jilbab keren', 20, '25-11-2018'),
	(122, 23, 41, 'BRG00008', 'jilbab keren', 10, '25-11-2018'),
	(123, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '26-11-2018'),
	(124, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '26-11-2018'),
	(125, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '26-11-2018'),
	(126, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '26-11-2018'),
	(127, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '26-11-2018'),
	(128, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '26-11-2018'),
	(129, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '26-11-2018'),
	(130, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '26-11-2018'),
	(131, 23, 40, 'BRG00008', 'jilbab keren', 20, '26-11-2018'),
	(132, 23, 41, 'BRG00008', 'jilbab keren', 10, '26-11-2018'),
	(133, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '28-11-2018'),
	(134, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '28-11-2018'),
	(135, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '28-11-2018'),
	(136, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '28-11-2018'),
	(137, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '28-11-2018'),
	(138, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '28-11-2018'),
	(139, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '28-11-2018'),
	(140, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '28-11-2018'),
	(141, 23, 40, 'BRG00008', 'jilbab keren', 20, '28-11-2018'),
	(142, 23, 41, 'BRG00008', 'jilbab keren', 10, '28-11-2018'),
	(143, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '29-11-2018'),
	(144, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '29-11-2018'),
	(145, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '29-11-2018'),
	(146, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '29-11-2018'),
	(147, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '29-11-2018'),
	(148, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '29-11-2018'),
	(149, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '29-11-2018'),
	(150, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '29-11-2018'),
	(151, 23, 40, 'BRG00008', 'jilbab keren', 20, '29-11-2018'),
	(152, 23, 41, 'BRG00008', 'jilbab keren', 10, '29-11-2018'),
	(153, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '30-11-2018'),
	(154, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '30-11-2018'),
	(155, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '30-11-2018'),
	(156, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '30-11-2018'),
	(157, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '30-11-2018'),
	(158, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '30-11-2018'),
	(159, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '30-11-2018'),
	(160, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '30-11-2018'),
	(161, 23, 40, 'BRG00008', 'jilbab keren', 20, '30-11-2018'),
	(162, 23, 41, 'BRG00008', 'jilbab keren', 10, '30-11-2018'),
	(163, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '02-12-2018'),
	(164, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '02-12-2018'),
	(165, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '02-12-2018'),
	(166, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '02-12-2018'),
	(167, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '02-12-2018'),
	(168, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '02-12-2018'),
	(169, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '02-12-2018'),
	(170, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '02-12-2018'),
	(171, 23, 40, 'BRG00008', 'jilbab keren', 20, '02-12-2018'),
	(172, 23, 41, 'BRG00008', 'jilbab keren', 10, '02-12-2018'),
	(173, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '03-12-2018'),
	(174, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '03-12-2018'),
	(175, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '03-12-2018'),
	(176, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '03-12-2018'),
	(177, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '03-12-2018'),
	(178, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '03-12-2018'),
	(179, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '03-12-2018'),
	(180, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '03-12-2018'),
	(181, 23, 40, 'BRG00008', 'jilbab keren', 20, '03-12-2018'),
	(182, 23, 41, 'BRG00008', 'jilbab keren', 10, '03-12-2018'),
	(183, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '04-12-2018'),
	(184, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '04-12-2018'),
	(185, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '04-12-2018'),
	(186, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '04-12-2018'),
	(187, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '04-12-2018'),
	(188, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '04-12-2018'),
	(189, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '04-12-2018'),
	(190, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '04-12-2018'),
	(191, 23, 40, 'BRG00008', 'jilbab keren', 20, '04-12-2018'),
	(192, 23, 41, 'BRG00008', 'jilbab keren', 10, '04-12-2018'),
	(193, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '08-12-2018'),
	(194, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '08-12-2018'),
	(195, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '08-12-2018'),
	(196, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '08-12-2018'),
	(197, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '08-12-2018'),
	(198, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '08-12-2018'),
	(199, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '08-12-2018'),
	(200, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '08-12-2018'),
	(201, 23, 40, 'BRG00008', 'jilbab keren', 20, '08-12-2018'),
	(202, 23, 41, 'BRG00008', 'jilbab keren', 10, '08-12-2018'),
	(203, 19, 32, 'BRG00004', 'jilbab kediri 2', 10, '09-12-2018'),
	(204, 19, 33, 'BRG00004', 'jilbab kediri 2', 12, '09-12-2018'),
	(205, 20, 34, 'BRG00005', 'jilbab malang 2', 10, '09-12-2018'),
	(206, 20, 35, 'BRG00005', 'jilbab malang 2', 2, '09-12-2018'),
	(207, 21, 36, 'BRG00006', 'jilbab kediri 3', 10, '09-12-2018'),
	(208, 21, 37, 'BRG00006', 'jilbab kediri 3', 12, '09-12-2018'),
	(209, 22, 38, 'BRG00007', 'jilbab malang 3', 10, '09-12-2018'),
	(210, 22, 39, 'BRG00007', 'jilbab malang 3', 2, '09-12-2018'),
	(211, 23, 40, 'BRG00008', 'jilbab keren', 20, '09-12-2018'),
	(212, 23, 41, 'BRG00008', 'jilbab keren', 10, '09-12-2018');
/*!40000 ALTER TABLE `tb_stokawals` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_tambahstoks
DROP TABLE IF EXISTS `tb_tambahstoks`;
CREATE TABLE IF NOT EXISTS `tb_tambahstoks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idwarna` int(11) DEFAULT NULL,
  `idadmin` int(11) DEFAULT NULL,
  `kode_barang` varchar(150) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `aksi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_tambahstoks: ~0 rows (approximately)
DELETE FROM `tb_tambahstoks`;
/*!40000 ALTER TABLE `tb_tambahstoks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_tambahstoks` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_transaksis
DROP TABLE IF EXISTS `tb_transaksis`;
CREATE TABLE IF NOT EXISTS `tb_transaksis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `faktur` varchar(300) DEFAULT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('terkirim','dibaca','diterima','ditolak','sukses','batal') DEFAULT NULL,
  `alamat_tujuan` text DEFAULT NULL,
  `admin` varchar(100) DEFAULT NULL,
  `ongkir` int(11) DEFAULT 0,
  `total_akhir` int(11) DEFAULT NULL,
  `pembayaran` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_transaksis: ~0 rows (approximately)
DELETE FROM `tb_transaksis`;
/*!40000 ALTER TABLE `tb_transaksis` DISABLE KEYS */;
INSERT INTO `tb_transaksis` (`id`, `iduser`, `faktur`, `tgl`, `total`, `status`, `alamat_tujuan`, `admin`, `ongkir`, `total_akhir`, `pembayaran`, `keterangan`) VALUES
	(3, 15, 'DVINA00003', '04-12-2018', 24000, 'diterima', 'magersari gurah jln pga no 1', NULL, 6000, 30000, '1', 'opopo');
/*!40000 ALTER TABLE `tb_transaksis` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_users
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kodepos` varchar(45) DEFAULT NULL,
  `ktp_gmb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_users: ~2 rows (approximately)
DELETE FROM `tb_users`;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`id`, `username`, `password`, `email`, `telp`, `nama`, `alamat`, `kota`, `provinsi`, `kodepos`, `ktp_gmb`) VALUES
	(15, 'damara', '74b213f68f648006a318f52713450f27', 'satriosuklun@gmail.com', '085604556714', 'damara satrio', 'magersari gurah jln pga no 1', 'kediri', 'jawa timur', '14045', '1542359347-21220959_b_v1.jpg'),
	(16, 'jianfitri', '121288a5d8785d1ef9aedb82bce753e9', 'jian@gmail.com', '02934820384', 'jian fitri', 'ngancar, kediri', 'kediri', 'aceh', '0002', '1543496839-whatsapp-image-2018-11-29-at-08.34.05.jpeg');
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

-- Dumping structure for table kargo.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kargo.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~7 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`, `id_cabang`) VALUES
	(3, 'vendor001', 'PT tani mundur jaya', '085552344556', 'Jln saguling no 1 malang', 'N', 1),
	(4, 'vendor002', 'PT Iwak Enak', '083223336313', 'mungkung loceret nganjuk', 'N', 1),
	(5, 'vendor003', 'PT Moro Dadi', '082122272212', 'Jln badut ulang tahun no 3 magelang', 'N', 1),
	(6, 'vendor0013', 'pt pubg', '2303849023890', 'gurah kediri', 'N', 1),
	(8, 'vdrh001', 'pt iwak pitek', '203482390', 'gurah', 'N', 1),
	(9, 'vdrh002', 'ph ksdjf', '293849', 'loceret', 'N', 2),
	(10, 'vrdrh003', 'pt salkdfj', '20389', 'nganjuk', 'N', 2);
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

-- Dumping structure for trigger kargo.add_stok
DROP TRIGGER IF EXISTS `add_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `add_stok` AFTER INSERT ON `tb_tambahstoks` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

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

-- Dumping structure for trigger kargo.in_stok
DROP TRIGGER IF EXISTS `in_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `in_stok` AFTER INSERT ON `detail_cancel` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger kargo.min_stok
DROP TRIGGER IF EXISTS `min_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `min_stok` AFTER INSERT ON `tb_details` FOR EACH ROW update tb_barangs set stok=stok-new.jumlah where idbarang=new.idwarna//
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
