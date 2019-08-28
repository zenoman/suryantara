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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.cabang: ~3 rows (approximately)
DELETE FROM `cabang`;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`id`, `nama`, `alamat`, `kota`, `kop`, `koderesi`) VALUES
	(1, 'KLC Cabang Kediri', 'magersari gurah kediri halo halo', 'KEDIRI', NULL, 'KDR'),
	(2, 'KLC cabang suryabaya', 'aklsdfjkl', 'SURABAYA', 'kantor cabang : jln iwak enak no 2+2 konoha surabaya', 'SBY'),
	(4, 'KLC Cabang Tulungagung', 'jasdklf asdklfjklasf', 'TULUNGAGUNG', 'asjdklf:askldfjklasdfjkl', 'TNG');
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
  `duplikat` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~12 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `kode_envoice`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `nama_penerima_barang`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_antar`, `id_cabang`, `katakun`, `status_pengiriman`, `status_company`, `duplikat`) VALUES
	(1, 'resimanual001', NULL, 'SJSBY250819-06-000002', NULL, NULL, 'devasatrio', 'mainan', 'city kurier', 'SURABAYA', 'kec. ngancar', '2019-08-25', NULL, '2019-08-25', 1, '5', '30 x 40 x 20', '6', 'kasldfjkl', 'jaskldfjkl', NULL, '92034898', '23904890', 'jklsad asd fklasdjklasd', 'klasdfjkl asdf asdlfjaskldf', 12000, 2000, 0, 0, 0, 0, 0, 0, 14000, 0, NULL, 'Y', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(2, 'resimanual002', 'h019238', 'SJSBY250819-06-000002', NULL, NULL, 'devasatrio', 'burung kaka', 'udara', 'SURABAYA', 'cikarang', '2019-08-25', NULL, '2019-08-25', 1, '3', '20 x 40 x 20', '3', 'askldfj', 'askdfljskl', NULL, '920134890', '28349890', 'sakldfjk asdklfj asdasdkfj', 'asjdfkl asdfj lsakfjklsaf', 135000, 0, 0, 0, 25000, 2000, 0, 0, 162000, 0, NULL, 'Y', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(3, 'resimanual003', NULL, NULL, 'SASBY250819-06-000002', NULL, 'devasatrio', 'nasi kotak', 'laut', 'SURABAYA', 'laut02', '2019-08-25', NULL, '2019-08-25', 1, '2', '40 x 30 x 10', '3', 'asdfkj', 'skldfj12398490', NULL, '90238490', '90234890', 'jklsdja asdfjasdklf l', 'sadklfjkl sadj lasdfjkl', 102000, 2000, 0, 0, 0, 0, 0, 0, 104000, 0, NULL, 'Y', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(4, 'resimanual004', NULL, 'SJSBY270819-06-000001', NULL, NULL, 'devasatrio', 'sam fuck', 'darat', 'SURABAYA', 'magersari', '2019-08-25', NULL, '2019-08-25', 1, '1', '30 x 30 x 20', '5', 'hari', 'desi', NULL, '9203890', '92038490', 'jkasld asdjk lkasdjklas', 'kasldfjkl', 150000, 2000, 1000, 0, 0, 0, 0, 0, 153000, 0, NULL, 'Y', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(5, 'SBY250819-06-000001', NULL, 'SJSBY250819-06-000001', NULL, NULL, 'devasatrio', 'sepatu kuda', 'darat', 'SURABAYA', 'magersari', '2019-08-25', NULL, '2019-08-25', 1, '3', '30 x 20 x 10', '2', 'kalsdfj', 'askldfj1', NULL, '1238490', '92304890', 'jklasdf asdkfjklasdfjklasf', 'adsklas sakdf asdfksd', 90000, 2000, 0, 0, 0, 0, 0, 0, 92000, 0, NULL, 'Y', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(6, 'SBY250819-06-000002', NULL, 'SJSBY250819-06-000001', NULL, NULL, 'devasatrio', 'halo halo', 'laut', 'SURABAYA', 'laut02', '2019-08-25', NULL, '2019-08-25', 1, '2', '30 x 20 x 10', '2', 'kasdjfkl', 'skladfjkl', NULL, '90238490', '29034890', 'jaskldf asd flkasdjfklas', 'sjadfkl asdlfkl;a', 68000, 200, 1000, 0, 0, 0, 0, 0, 69200, 0, NULL, 'Y', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(7, 'SBY250819-06-000003', 'h-2394890', 'SJSBY270819-06-000001', NULL, NULL, 'devasatrio', 'burung kasut ari', 'udara', 'SURABAYA', 'cikarang', '2019-08-25', NULL, '2019-08-25', 1, '1', '30 x 20 x 10', '1', 'aksldfj', 'kasldfjklasd', NULL, '902314890', '93124890', 'jsakld asdkfj askldfj', 'jskladf lkasd flsadfjasl', 45000, 0, 0, 0, 25000, 2000, 0, 0, 72000, 0, NULL, 'Y', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(8, 'SBY250819-06-000004', NULL, NULL, 'SASBY250819-06-000001', NULL, 'devasatrio', 'halo halo', 'city kurier', 'SURABAYA', 'kec. ngancar', '2019-08-25', NULL, '2019-08-25', 1, '2', '30 x 20 x 10', '2', 'jsakldfj', 'klasdjfkl', 'mbak komari', '02934890', '2394890', 'jksadfjkl fasdf askldfjaskl', 'jsdklf sajasklf  sklaf', 4000, 2000, 100, 0, 0, 0, 0, 0, 6100, 0, NULL, 'Y', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N'),
	(9, 'citycompany001', NULL, NULL, 'SASBY250819-06-000002', NULL, 'devasatrio', 'kaos kaki', 'city kurier', 'SURABAYA', 'kec. pagu', '2019-08-25', NULL, '2019-08-25', 1, '3', '20 x 30 x 20', '3', 'askldfjkl', 'ksladfjkl', 'sumiarti', '92304890', '2398490', 'skaldfjkl asdlkfjklasd f', 'jskldf asdfkj askldfj', 3000, 2000, 1000, 0, 0, 0, 0, 0, 6000, 0, 'Alamat salah atau tidak lengkap', 'Y', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 2, 1, 'paket telah diterima', 'Y', 'N'),
	(10, 'SBY250819-06-000001', NULL, NULL, 'SAKDR250819-15-000001', NULL, 'devasatrio', 'sepatu kuda', 'darat', 'SURABAYA', 'magersari', '2019-08-25', NULL, '2019-08-25', 1, '3', '30 x 20 x 10', '2', 'kalsdfj', 'askldfj1', 'askldfj1', '1238490', '92304890', 'jklasdf asdkfjklasdfjklasf', 'adsklas sakdf asdfksd', 90000, 0, 0, 0, 0, 0, 0, 0, 92000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 1, 1, 'paket telah diterima', 'N', 'Y'),
	(11, 'SBY250819-06-000002', NULL, 'SJKDR250819-15-000001', NULL, NULL, 'devasatrio', 'halo halo', 'laut', 'SURABAYA', 'laut02', '2019-08-25', NULL, '2019-08-25', 1, '2', '30 x 20 x 10', '2', 'kasdjfkl', 'skladfjkl', NULL, '90238490', '29034890', 'jaskldf asd flkasdjfklas', 'sjadfkl asdlfkl;a', 68000, 0, 0, 0, 0, 0, 0, 0, 69200, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'handle by vendor', 'N', 'Y'),
	(12, 'resimanual004', NULL, 'SJKDR270819-15-000001', NULL, NULL, 'devasatrio', 'sam fuck', 'darat', 'SURABAYA', 'magersari', '2019-08-25', NULL, '2019-08-25', 1, '1', '30 x 30 x 20', '5', 'hari', 'desi', NULL, '9203890', '92038490', 'jkasld asdjk lkasdjklas', 'kasldfjkl', 150000, 0, 0, 0, 0, 0, 0, 0, 153000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'handle by vendor', 'N', 'Y'),
	(13, 'SBY250819-06-000003', 'h-2394890', 'SJKDR270819-15-000001', NULL, NULL, 'devasatrio', 'burung kasut ari', 'udara', 'SURABAYA', 'cikarang', '2019-08-25', NULL, '2019-08-25', 1, '1', '30 x 20 x 10', '1', 'aksldfj', 'kasldfjklasd', NULL, '902314890', '93124890', 'jsakld asdkfj askldfj', 'jskladf lkasd flsadfjasl', 45000, 0, 0, 0, 25000, 2000, 0, 0, 72000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'handle by vendor', 'N', 'Y');
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.status_pengiriman: ~40 rows (approximately)
DELETE FROM `status_pengiriman`;
/*!40000 ALTER TABLE `status_pengiriman` DISABLE KEYS */;
INSERT INTO `status_pengiriman` (`id`, `kode`, `status`, `keterangan`, `tgl`, `jam`, `lokasi`) VALUES
	(1, 'resimanual004', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '19:01:18', 'SURABAYA'),
	(2, 'resimanual003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '19:49:13', 'SURABAYA'),
	(3, 'resimanual002', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-08-25', '19:52:36', 'SURABAYA'),
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
	(17, 'resimanual002', 'handle by vendor', NULL, '2019-08-25', '20:52:34', 'SURABAYA'),
	(18, 'SBY250819-06-000004', 'paket telah diterima', 'mbak komari', '2019-08-25', '20:54:56', 'SURABAYA'),
	(19, 'citycompany001', 'pengantaran gagal', 'Alamat salah atau tidak lengkap', '2019-08-25', '20:55:18', 'SURABAYA'),
	(20, 'citycompany001', 'prosess pengantaran paket ulang', NULL, '2019-08-25', '20:57:56', 'SURABAYA'),
	(21, 'resimanual003', 'prosess pengantaran paket', NULL, '2019-08-25', '20:58:11', 'SURABAYA'),
	(22, 'citycompany001', 'paket telah diterima', 'sumiarti', '2019-08-25', '21:00:49', 'SURABAYA'),
	(23, 'resimanual003', 'dikembalikan ke pengirim', NULL, '2019-08-25', '21:04:07', 'SURABAYA'),
	(24, 'resimanual003', 'paket telah diterima', NULL, '2019-08-25', '21:06:30', 'SURABAYA'),
	(26, 'resimanual002', 'paket telah diterima', NULL, '2019-08-25', '21:15:16', 'SURABAYA'),
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
	(39, 'resimanual004', 'menuju kota tujuan', NULL, '2019-08-27', '19:48:06', 'SURABAYA'),
	(40, 'SBY250819-06-000003', 'menuju kota tujuan', NULL, '2019-08-27', '19:48:17', 'SURABAYA'),
	(41, 'resimanual004', 'barang sampai di KLC Cabang KEDIRI', NULL, '2019-08-27', '19:48:59', 'KEDIRI'),
	(42, 'SBY250819-06-000003', 'barang sampai di KLC Cabang KEDIRI', NULL, '2019-08-27', '19:48:59', 'KEDIRI'),
	(43, 'SBY250819-06-000003', 'handle by vendor', NULL, '2019-08-27', '19:50:17', 'KEDIRI'),
	(44, 'resimanual004', 'handle by vendor', NULL, '2019-08-27', '19:50:57', 'KEDIRI'),
	(45, 'resimanual004', 'paket telah diterima', NULL, '2019-08-27', '19:55:08', 'SURABAYA'),
	(46, 'SBY250819-06-000003', 'paket telah diterima', NULL, '2019-08-27', '19:55:38', 'SURABAYA');
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
	(1, '2', 'SASBY250819-06-000001', '2019-08-25', 'maryanto', '032489023', 'S', 2),
	(2, '2', 'SASBY250819-06-000002', '2019-08-25', 'maryanto', '032489023', 'S', 2),
	(3, '1', 'SAKDR250819-15-000001', '2019-08-25', 'hari', '2349023890482', 'S', 1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_envoice: ~0 rows (approximately)
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
  `status_pengiriman` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~5 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`, `cabang`, `katakun`, `id_cabang`, `id_cabang_tujuan`, `id_cabang_transit`, `status_transit`, `status_pengiriman`) VALUES
	(1, 'devasatrio', 'SJSBY250819-06-000001', 'KLC Cabang Kediri', '2019-08-25', 'P', 5, 2, 161200, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, 1, NULL, 'N', 'Y'),
	(2, 'devasatrio', 'SJSBY250819-06-000002', 'PT SBY sejahtera-08234723984279', '2019-08-25', 'Y', 8, 2, 176000, 0, NULL, 'jln mahoni subur 001 rt 01 cempaka surabaya', 'N', 14, 2, NULL, NULL, 'N', 'N'),
	(3, 'damara', 'SJKDR250819-15-000001', 'PT Cahya gurah-2930849023', '2019-08-25', 'Y', 2, 1, 69200, 0, NULL, 'bringin bulurejo 001 kec.gurah kediri', 'N', 14, 1, NULL, NULL, 'N', 'N'),
	(4, 'devasatrio', 'SJSBY270819-06-000001', 'KLC Cabang Kediri', '2019-08-27', 'P', 2, 2, 225000, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, 1, NULL, 'N', 'Y'),
	(5, 'damara', 'SJKDR270819-15-000001', 'PT Cahya gurah-2930849023', '2019-08-27', 'Y', 2, 2, 225000, 0, NULL, 'bringin bulurejo 001 kec.gurah kediri', 'N', 14, 1, NULL, NULL, 'N', 'N');
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
