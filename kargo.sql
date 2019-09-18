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
  `id_cabang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.absensi: ~4 rows (approximately)
DELETE FROM `absensi`;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` (`id`, `id_karyawan`, `id_jabatan`, `tanggal`, `masuk`, `tidak_masuk`, `izin`, `keterangan_izin`, `uang_makan`, `id_cabang`) VALUES
	(1, 1, 26, '2019-09-06', 0, 1, 0, '-', '0', 1),
	(2, 4, 1, '2019-09-06', 0, 1, 0, '-', '0', 1),
	(3, 2, 26, '2019-09-07', 1, 0, 0, '-', '30000', 2),
	(4, 5, 27, '2019-09-07', 1, 0, 0, '-', '3000', 2),
	(5, 6, 24, '2019-09-07', 0, 1, 0, '-', '0', 2);
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;

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
	(1, '004', 'sonya', 24, 400000, 0, NULL, 430000, 7, 2019, 1),
	(2, '002', 'maryanto', 26, 400000, 0, NULL, 430000, 7, 2019, 1),
	(3, '003', 'handoko', 27, 20000, 0, 5820, 25820, 7, 2019, 1),
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

-- Dumping data for table kargo.jabatan: ~4 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak: ~17 rows (approximately)
DELETE FROM `pajak`;
/*!40000 ALTER TABLE `pajak` DISABLE KEYS */;
INSERT INTO `pajak` (`id`, `bulan`, `tahun`, `nama_pajak`, `total`, `katakun`) VALUES
	(1, 1, '2019', 'pajak', 2638, 15),
	(3, 2, '2019', 'pajak', 22425, 15),
	(4, 3, '2019', 'pajak', 0, 15),
	(5, 4, '2019', 'pajak', 8705, 15),
	(6, 5, '2019', 'pajak', 30058, 15),
	(7, 7, '2019', 'pajak', 29422, 15),
	(8, 7, '2019', 'pajak', 24055, 15),
	(9, 8, '2019', 'pajak', 2430, 15),
	(10, 8, '2019', 'pajak', 2430, 15),
	(11, 8, '2019', 'pajak', 2430, 15),
	(12, 8, '2019', 'pajak', 2430, 15),
	(13, 8, '2019', 'pajak', 2430, 15),
	(14, 8, '2019', 'pajak', 2430, 15),
	(15, 8, '2019', 'pajak', 2430, 15),
	(16, 8, '2019', 'pajak', 2430, 15),
	(17, 8, '2019', 'pajak', 2430, 15),
	(18, 8, '2019', 'pajak', 2430, 15),
	(19, 8, '2019', 'pajak', 2430, 15);
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
  `id_cabang` int(11) DEFAULT 1,
  `tgl` date DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pengeluaran_lain: ~22 rows (approximately)
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
INSERT INTO `pengeluaran_lain` (`id`, `admin`, `kategori`, `keterangan`, `jumlah`, `id_cabang`, `tgl`, `gambar`) VALUES
	(3, 'abiihsan', '005', '123we', 21, 1, '2019-07-28', NULL),
	(8, 'devasatrio', '005', 'beli bensin', 30000, 1, '2019-07-19', '1546440740-logo.jpg'),
	(9, 'devasatrio', '007', 'parkir mobil', 20000, 1, '2019-07-19', '1546477524-logo.jpg'),
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

-- Dumping data for table kargo.resi_mentah: ~9 rows (approximately)
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
  `dimensi` varchar(50) DEFAULT NULL,
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
  `kekurangan` int(11) DEFAULT 0,
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
  `total_berat_udara` int(11) DEFAULT NULL,
  `maskapai_udara` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~19 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `kode_envoice`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `nama_penerima_barang`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `total_bayar`, `kekurangan`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_antar`, `id_cabang`, `katakun`, `status_pengiriman`, `status_company`, `duplikat`, `total_berat_udara`, `maskapai_udara`) VALUES
	(1, 'SBY130919-29-000001', NULL, NULL, NULL, NULL, 'cssby', 'sepatu', 'darat', 'SURABAYA', 'gurah', '2019-09-13', NULL, NULL, 1, '6', '30 x 40 x 20', '6', 'haris', 'aksldfj', NULL, '294', '2034890', 'gurah', 'sakldfj asldk;fj;asldf', 180000, 2000, 2000, 0, 0, 0, 0, 0, 184000, 1000, 0, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(2, 'SBY130919-29-000002', NULL, NULL, NULL, NULL, 'cssby', 'tas kresek', 'laut', 'SURABAYA', 'kalimantan', '2019-09-13', NULL, NULL, 1, '2', '30 x 20 x 20', '3', 'laksdfj', 'askldfj', NULL, '90234890', '091234890', 'laskdfj', 'jklasjdf asldkjfklas;df', 120000, 2000, 2000, 0, 0, 0, 0, 0, 124000, 3000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(3, 'SBY130919-29-000003', NULL, 'SJSBY150919-32-000001', NULL, NULL, 'cssby', 'tanaman', 'udara', 'SURABAYA', 'papua', '2019-09-13', NULL, '2019-09-13', 3, '2,8,3,', '20 x 30 x 40,40 x 40 x 30,30 x 30 x 20,', '4,5,3,', 'adsfkl', 'skladf', NULL, '290134890', '23904890', 'l;asjkl asdfkjaskldfj', 'kasl;dfjl;', 510000, 0, 0, 0, 0, 0, 0, 0, 517000, 517000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N', 'N', 15, 'Lion Air'),
	(4, 'SBY130919-29-000004', NULL, 'SJSBY150919-32-000001', NULL, NULL, 'cssby', 'speaker', 'city kurier', 'SURABAYA', 'kec. wates', '2019-09-13', NULL, '2019-09-13', 1, '6', '30 x 40 x 20', '6', 'askldjfklasd', 'lkasdjf klsjdfkl lskajlfsda', NULL, '09238490', '9238490', 'kljaskld asldkfjaskldf asdklfjasdkl', 'kaslfj asdkfjklasdf lakdfjklasdf', 120000, 2000, 3000, 0, 0, 0, 0, 0, 125000, 125000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'handle by vendor', 'N', 'N', NULL, NULL),
	(5, 'resicity0001', NULL, NULL, 'SASBY150919-32-000001', 'INSBY160919-32-000001', 'cssby', 'guling', 'city kurier', 'SURABAYA', 'desa pujon', '2019-09-13', NULL, '2019-09-13', 4, '5', '30 x 20 x 30', '5', 'askldfj', '290348', NULL, '09238490', '209348', 'jklas', 'jklasdj askldfjklsadf', 20000, 2000, 3000, 0, 0, 0, 0, 0, 25000, 25000, 0, 0, 'alamat salah', 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'KL', 2, 1, 'pengantaran gagal', 'Y', 'N', NULL, NULL),
	(6, 'SBY130919-29-000005', NULL, 'SJSBY150919-32-000002', NULL, NULL, 'cssby', 'semvak', 'udara', 'SURABAYA', 'papua', '2019-09-13', NULL, '2019-09-13', 3, '1,3,1,', '30 x 20 x 40,30 x 20 x 30,20 x 20 x 20,', '4,3,1,', 'askldf', 'askldfj', NULL, '23938490', '293890', 'jsakldf lkasdjfklasdjfkl sadklj', 'klsadj askldjfklasfjklas', 272000, 0, 0, 0, 5000, 3000, 0, 0, 280000, 280000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'menuju kota tujuan', 'N', 'N', 8, 'Lion Air'),
	(7, 'SBY130919-29-000006', NULL, 'SJSBY150919-32-000002', NULL, NULL, 'cssby', 'aklsdfjklasdf', 'udara', 'SURABAYA', 'papua', '2019-09-13', NULL, '2019-09-13', 1, '2,', '30 x 20 x 30,', '3,', 'asdf', 'klsf', NULL, '902334890', '123904890', 'klasdfjkl', 'askldfj', 102000, 0, 0, 0, 5000, 3000, 0, 0, 110000, 110000, 0, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 2, 1, 'menuju kota tujuan', 'N', 'N', 3, 'Lion Air'),
	(8, 'mnlsby001', NULL, NULL, NULL, NULL, 'cssby', 'sepatu bola takro', 'darat', 'SURABAYA', 'gurah', '2019-09-14', NULL, '2019-09-14', 2, '6', '30 x 20 x 30', '5', 'hari', 'asjdklf', NULL, '02938490', '2093849', 'ksladj sdadlfkjlaskdf', 'gurah kediri magersari', 180000, 2000, 2000, 0, 0, 0, 0, 0, 184000, 184000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '5', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(9, 'mnlsby002', NULL, NULL, NULL, NULL, 'cssby', 'ikan asin', 'laut', 'SURABAYA', 'kalimantan', '2019-09-14', NULL, '2019-09-14', 1, '5', '40 x 30 x 20', '6', 'asdfas', 'ksaldf', NULL, '09283490', '0924890', 'klasdf sadklfjasklfd', 'klasdf asddjfskladf asfjsklaf', 240000, 2000, 1000, 0, 0, 0, 0, 0, 243000, 243000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '5', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(10, 'mnlsby003', '91032-1239', NULL, NULL, NULL, 'cssby', 'burung gagak', 'udara', 'SURABAYA', 'maluku', '2019-09-14', NULL, NULL, 3, '5,6,0,', '5,6,0,', '5,6,0,', 'askdlf', 'jskladf', NULL, '20934890', '3039248', 'klsadf sklflaskdf sdfksd', 'jlksadf saksaldfj', 250000, 0, 0, 0, 5000, 2000, 0, 0, 257000, 0, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '5', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(11, 'mnlsby004', '1092-128', NULL, NULL, NULL, 'admincabangsby', 'sempak', 'udara', 'SURABAYA', 'papua', '2019-09-14', NULL, '2019-09-14', 3, '2,2,1,', '30 x 30 x 20,30 x 20 x 31,20 x 20 x 20,', '3,3,1,', 'asd', 'jskadf', NULL, '290380', '23938490', 'jsdf sfjlask', 'jaskldfa sfdjklsaf asdfkj', 238000, 0, 0, 0, 5000, 2000, 0, 245000, 73500, 245000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '2', 'Y', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 7, 'Lion Air'),
	(12, 'mnlsby005', '23-1231', NULL, 'SASBY150919-32-000001', NULL, 'cssby', 'asdfsadfa', 'udara', 'SURABAYA', 'papua', '2019-09-14', NULL, '2019-09-14', 3, '5,6,0,', '30 x 30 x 30,30 x 20 x 30,0 x 0 x 0,', '5,3,0,', 'akldsjf', 'aklfdj', 'harianto', '920490', '239038490', 'jklasdfj askdjfkladsf adsfkj', 'jklsadf asdjfklasdf', 374000, 0, 0, 0, 2000, 2000, 0, 0, 378000, 378000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '2', 'N', 'Y', 2, 1, 'paket telah diterima', 'N', 'N', 11, NULL),
	(13, 'mnlsby006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '5', 'N', 'N', 2, 1, NULL, 'N', 'N', NULL, NULL),
	(14, 'mnlsby007', NULL, NULL, NULL, NULL, 'devasatrio', 'kasld asdfjklsadf', 'laut', 'SURABAYA', 'kalimantan', '2019-09-16', NULL, '2019-09-16', 1, '5', '30 x 20 x 30', '5', 'asdf', 'klsadfjkl', NULL, '29034890', '29034890', 'jklsadjf jsakldf kadsfjklsf', 'jklsadf sajdfklsadf asdfjklsdf', 200000, 2000, 3000, 0, 0, 0, 0, 0, 205000, 205000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '5', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(15, 'mnlsby008', NULL, NULL, NULL, NULL, 'devasatrio', 'halo halo', 'darat', 'SURABAYA', 'gurah', '2019-09-16', NULL, '2019-09-16', 1, '2', '30 x 20 x 20', '3', 'hari', 'asdfk', NULL, '29308490', '92038490', 'klsajfk dsafjklsadf asddjflsdf', 'kladfj snfklsa dfksdfj', 90000, 2000, 1000, 0, 0, 0, 0, 0, 93000, 93000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '5', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', NULL, NULL),
	(16, 'mnlsby009', '234', NULL, NULL, NULL, 'admincabangsby', 'bawang', 'udara', 'SURABAYA', 'maluku', '2019-09-14', NULL, '2019-09-14', 2, '1,2,', '30 x 20 x 30,30 x 40 x 20,', '3,4,', 'hari', 'klasjfkl', NULL, '029384', '923038490', 'jksladf asdjfklasdf', 'jklasdfjl', 175000, 0, 0, 0, 5000, 2000, 87500, 269500, 80850, 269500, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '2', 'Y', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 7, 'garuda'),
	(17, 'mnlsby010', NULL, NULL, NULL, NULL, 'admincabangsby', 'halu', 'udara', 'SURABAYA', 'papua', '2019-09-14', NULL, '2019-09-14', 3, '1,2,3,', '10 x 10 x 10,20 x 20 x 20,30 x 30 x 30,', '1,2,3,', 'asdfj', 'sakldfj', NULL, '90238490', '092890', 'klsadj', 'askldfjkl', 204000, 0, 0, 0, 5000, 2000, 0, 0, 211000, 211000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '2', 'N', 'N', 2, 1, 'barang diterima KLC Cabang SURABAYA', 'N', 'N', 6, NULL);
/*!40000 ALTER TABLE `resi_pengiriman` ENABLE KEYS */;

-- Dumping structure for table kargo.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.roles: ~9 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `level`) VALUES
	(1, 'programmer'),
	(2, 'admin'),
	(3, 'super admin'),
	(4, 'cs'),
	(5, 'hrd'),
	(6, 'branch manager'),
	(7, 'oprasional'),
	(8, 'oprasional cabang'),
	(9, 'admin cabang');
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
  `desk_city_kurir` text DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `bulan_sekarang` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.setting: ~1 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `pengumuman`, `desk_udara`, `desk_laut`, `desk_darat`, `desk_city_kurir`, `status`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<p>Dear client untuk saat ini data Cabang surabaya dapat di isi tapi untuk transaksi dsb harap sabar :-*</p>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', '<p>ini deskripsi city kurir</p>', 'Y', 9);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.status_pengiriman: ~21 rows (approximately)
DELETE FROM `status_pengiriman`;
/*!40000 ALTER TABLE `status_pengiriman` DISABLE KEYS */;
INSERT INTO `status_pengiriman` (`id`, `kode`, `status`, `keterangan`, `tgl`, `jam`, `lokasi`) VALUES
	(1, 'SBY130919-29-000001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '19:36:24', 'SURABAYA'),
	(2, 'SBY130919-29-000002', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '19:45:17', 'SURABAYA'),
	(3, 'SBY130919-29-000003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '19:48:12', 'SURABAYA'),
	(4, 'SBY130919-29-000004', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '19:59:14', 'SURABAYA'),
	(5, 'resicity0001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '20:00:43', 'SURABAYA'),
	(6, 'SBY130919-29-000005', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '20:15:57', 'SURABAYA'),
	(7, 'SBY130919-29-000005', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '20:20:07', 'SURABAYA'),
	(8, 'SBY130919-29-000005', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '20:22:15', 'SURABAYA'),
	(9, 'SBY130919-29-000006', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-13', '20:23:50', 'SURABAYA'),
	(10, 'mnlsby001', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '11:50:18', 'SURABAYA'),
	(11, 'mnlsby002', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '11:51:59', 'SURABAYA'),
	(12, 'mnlsby003', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '11:54:30', 'SURABAYA'),
	(13, 'mnlsby004', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '13:10:51', 'SURABAYA'),
	(14, 'mnlsby005', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '13:14:30', 'SURABAYA'),
	(15, 'mnlsby010', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '13:18:49', 'SURABAYA'),
	(16, 'mnlsby009', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-14', '13:44:01', 'SURABAYA'),
	(17, 'SBY130919-29-000004', 'handle by vendor', NULL, '2019-09-15', '10:35:17', 'SURABAYA'),
	(19, 'SBY130919-29-000003', 'handle by vendor', NULL, '2019-09-15', '10:49:30', 'SURABAYA'),
	(20, 'SBY130919-29-000006', 'menuju kota tujuan', NULL, '2019-09-15', '11:20:59', 'SURABAYA'),
	(21, 'SBY130919-29-000005', 'menuju kota tujuan', NULL, '2019-09-15', '11:21:25', 'SURABAYA'),
	(22, 'mnlsby005', 'prosess pengantaran paket', NULL, '2019-09-15', '11:41:52', 'SURABAYA'),
	(23, 'resicity0001', 'prosess pengantaran paket', NULL, '2019-09-15', '11:42:15', 'SURABAYA'),
	(24, 'mnlsby005', 'paket telah diterima', 'harianto', '2019-09-15', '12:16:51', 'SURABAYA'),
	(25, 'resicity0001', 'pengantaran gagal', 'alamat salah', '2019-09-15', '12:17:26', 'SURABAYA'),
	(26, 'mnlsby008', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-16', '17:09:57', 'SURABAYA'),
	(27, 'mnlsby007', 'barang diterima KLC Cabang SURABAYA', NULL, '2019-09-16', '17:13:47', 'SURABAYA');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_antar: ~0 rows (approximately)
DELETE FROM `surat_antar`;
/*!40000 ALTER TABLE `surat_antar` DISABLE KEYS */;
INSERT INTO `surat_antar` (`id`, `id_karyawan`, `kode`, `tgl`, `pemegang`, `telp`, `status`, `id_cabang`) VALUES
	(1, '2', 'SASBY150919-32-000001', '2019-09-15', 'maryanto', '032489023', 'S', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_envoice: ~0 rows (approximately)
DELETE FROM `surat_envoice`;
/*!40000 ALTER TABLE `surat_envoice` DISABLE KEYS */;
INSERT INTO `surat_envoice` (`id`, `kode`, `tujuan`, `alamat`, `tgl`, `pembuat`, `totalkg`, `totalkoli`, `totalcash`, `biaya`, `totalbt`, `id_cabang`, `status`) VALUES
	(1, 'INSBY160919-32-000001', 'pt iwak enak-14045', 'gurah', '2019-09-16', 'admincabangsby', 5, 4, 25000, 0, NULL, 2, 'Y');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~2 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`, `cabang`, `katakun`, `id_cabang`, `id_cabang_tujuan`, `id_cabang_transit`, `status_transit`, `status_pengiriman`) VALUES
	(1, 'admincabangsby', 'SJSBY150919-32-000001', 'PT SBY sejahtera-08234723984279', '2019-09-15', 'Y', 21, 4, 642000, 0, NULL, 'jln mahoni subur 001 rt 01 cempaka surabaya', 'N', 14, 2, NULL, NULL, 'N', 'N'),
	(2, 'admincabangsby', 'SJSBY150919-32-000002', 'KLC Cabang Kediri', '2019-09-15', 'P', 11, 4, 390000, 0, NULL, 'magersari gurah kediri halo halo', 'Y', 14, 2, 1, NULL, 'N', 'N');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

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
	(10, 'citycmp004', 'desa pujon', 4000, 2, '1', 2, 'Y', 'Y'),
	(11, 'darat002', 'magersari', 4000, 10, '2', 1, 'N', 'N');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_laut: ~0 rows (approximately)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`) VALUES
	(1, 'laut001', 'kalimantan', 40000, 2, '5', 2),
	(2, 'laut002', 'borneo', 25000, 10, '2', 1);
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

-- Dumping data for table kargo.tb_neraca: ~8 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.users: ~11 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `remember_token`, `email`, `alamat`, `level`, `id_cabang`) VALUES
	(20, 'Admin-000002', 'devasatrio', '$2y$10$pEOVBaxYpBS.yRNueIxZi.JWYo0L1tYiEVfsv0T.f20JsxNTv2atC', 'damara', '928901', 'XJWz68x81JKDFjfZVA8IcKQXg476e9bg8cnCj98xooTA9CScNF', 'ridho.rezky.07@gmail.com', 'gurah', '1', 2),
	(21, 'Admin-000003', 'adminkdr', '$2y$10$3v1J8eUywCp4hPTgM50j7eK7u95.H5J4bWbgxiPrjB1Iftx1oIl3O', 'admin kediri', '091389', 'UoLKWHU43E18fmuqcfVxsQVzwxDiPmKZOmJZwKGo4D3ASbbiPW', 'satriosuklun@gmail.com', 'gurah', '2', 1),
	(22, 'Admin-000004', 'owner', '$2y$10$nNblnTMxasvFKvd8jMLRl.YuA2PCMfp4cNWz4w7QywzWG2jwi6mDW', 'owner', '29048902', '9v0GzCNGKoRvVBobs6gAl4wfrwpGrC03XxVT2tdWm1cfALvkH1', 'satriosuklun@gmail.com', 'gurah', '3', 1),
	(23, 'Admin-000005', 'cskdr', '$2y$10$ZEn0Iqmv0g9qm9AxBjuhHu0Y8y9wJCqt45J8jEjWNBBibFyivgGte', 'cskdr', '2903489', 'bJJFju6y7TVAdGXuiIdx7tzHI2bdIfIt6BedfeMx8P8IPZf6Dt', 'satriosuklun@gmail.com', 'gurah', '4', 1),
	(24, 'Admin-000006', 'bmkediri', '$2y$10$dcZ46DX6L2tEg7pxPHl4xuNMJZynyOkuDRfTbQ9G/StqnI1wYyokW', 'bm kediri', '2903489', 'bkxpyVa6vHtFGyV59VSOOXUKe3uCqlR2dkAJToej64mlPFbR6m', 'satriosuklun@gmail.com', 'gurah', '6', 1),
	(25, 'Admin-000007', 'hrdkediri', '$2y$10$69v49QsOdqXwzhWatWrlwuVr1yrfl7.6ABJBkmJ.oXFGF3.O7cEaa', 'hrd kediri', '90248920', 'uP7WW2Q6V8YUUXCw8jXiLOmQrLHklYpHh0vCVzsfDk0zohgbgI', 'satriosuklun@gmail.com', 'gurah', '5', 1),
	(26, 'Admin-000008', 'oprasionalkediri', '$2y$10$GxTx2zudYWiv8Wu69BZlUuNNk9nDaspx6DBnnsAhS5vEPK0Ad9btG', 'oprasional kediri', '1229348', 'i70GnrZyykAcdCOM443EMabUqMiVlxm39eTdkrLY1rArbEX6Fm', 'satriosuklun@gmail.com', 'gurah', '7', 1),
	(27, 'Admin-000009', 'oprasionalcabangkdr', '$2y$10$atkva0V/CbUJlEslW3Zkbu8VoMoGNQDyL2z1J/n5v3OnxVJxy776O', 'oprasional cabang kdr', '9023489', 'TJvZ0DKcF6oFtxBpD2w3Kuh7G1yfzSPu3KdEJJMVfr9obxfIo1', 'satriosuklun@gmail.com', 'gurah', '8', 1),
	(28, 'Admin-000010', 'admincabangkdr', '$2y$10$21RgELpTPd4fUlhTDgNQTOjdFbL7xrbEy2W6B.SATRGQp6hDk1KC.', 'admin cabang kdr', '2903489', 'MQlaNrtf0tbTVwVNwmUFhEpPPpNydql2IwsdEoVhl1W6XGcrZ0', 'satriosuklun@gmail.com', 'gurah', '9', 1),
	(29, 'Admin-000011', 'cssby', '$2y$10$sanPVF2TmxD.I3zM5CBPPuFhZN1pbS4nNoRjuZHYQBjqb7oyC4Lxq', 'cssby', '2349', 'UxXEoCM8ALZLtFz7ePK0tNKzSSZSFb5bJbQ0egq7hvoRBIVo8o', 'satriosuklun@gmail.com', 'gira', '4', 2),
	(30, 'Admin-000012', 'bmsby', '$2y$10$73uE7nwPW8rg0Ol56r7SAOHQJf2OmWGCysERhefjGNH5lTQ1iFOuS', 'bm sby', '298490', '', 'lennie.medhurst@example.net', 'gurah', '6', 2),
	(31, 'Admin-000013', 'oprasionalcabangsby', '$2y$10$aJEzM.HxUdYAjGE0ncx0NOyLGM2j6JSlJU2McTiuBca6oCpHFexFK', 'oprasional cabang sby', '234098', '', 'satriosuklun@gmail.com', 'gurah', '8', 2),
	(32, 'Admin-000014', 'admincabangsby', '$2y$10$/8dRmJagcIaq.ylbz6a6TuKV7N3A3rfsuMYNBLvyEJnlDwJ906j4.', 'admin cabang sby', '209348', 'Lb5TtrE3Gp56KQFc81Jg34FNwh7JTssXUSzQHntpdVFTkQm6rK', 'satriosuklun@gmail.com', 'gurah', '9', 2);
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
CREATE TRIGGER `editadmin` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
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
