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

-- Dumping structure for table kargo.absensi
DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT '0',
  `id_jabatan` int(11) DEFAULT '0',
  `tanggal` varchar(20) DEFAULT NULL,
  `masuk` int(2) DEFAULT NULL,
  `tidak_masuk` int(2) DEFAULT NULL,
  `izin` int(2) DEFAULT '0',
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
  `password` text,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~8 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`, `level`, `id_cabang`) VALUES
	(6, 'Admin-000001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari', 'programer', 1),
	(7, 'Admin-000002', 'harianti', '74b213f68f648006a318f52713450f27', 'harianto', '085604556712', 'harianto@gmail.com', 'magersari gurah depan pga', 'admin', 1),
	(9, 'Admin-000003', 'abiihsan', '74b213f68f648006a318f52713450f27', 'abi ihsan fadli', '098765546', 'abi@gmail.com', 'gurah', 'programer', 1),
	(10, 'Admin-000004', 'dinisumi', '74b213f68f648006a318f52713450f27', 'cs dini', '09128390128', 'dian@gmail.com', 'gurah', 'cs', 1),
	(11, 'Admin-000005', 'atiqowner', '74b213f68f648006a318f52713450f27', 'pak atiq', '09328903289023', 'dianade@gmail.com', 'gurah', 'superadmin', 1),
	(12, 'Admin-000006', 'hardian', '74b213f68f648006a318f52713450f27', 'hardian', '2398782397892', 'harianto@gmail.com', 'gurah', 'operasional', 1),
	(13, 'Admin-000007', 'paijo', '827ccb0eea8a706c4c34a16891f84e7b', 'deni suherman', '0239482390', 'harianto@gmail.com', 'gurah kediri', 'admin_cabang', 1),
	(14, 'Admin-000008', 'askdfjasdkf', '827ccb0eea8a706c4c34a16891f84e7b', 'mariana', '2390482390', 'admin@gmail.com', 'ksdfjk', 'operasional_cabang', 1);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.armada: ~2 rows (approximately)
DELETE FROM `armada`;
/*!40000 ALTER TABLE `armada` DISABLE KEYS */;
INSERT INTO `armada` (`id`, `nama`, `nopol`, `nomor_rangka`, `nomor_mesin`, `warna`) VALUES
	(1, 'gran max', '203482390', 'skdfjw8r', 'kljfdflkswe8r', 'merah'),
	(4, 'pajero', '028492', 'i34ui43o', '9034', 'hitam');
/*!40000 ALTER TABLE `armada` ENABLE KEYS */;

-- Dumping structure for table kargo.cabang
DROP TABLE IF EXISTS `cabang`;
CREATE TABLE IF NOT EXISTS `cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(50) DEFAULT NULL,
  `kop` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.cabang: ~3 rows (approximately)
DELETE FROM `cabang`;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`id`, `nama`, `alamat`, `kota`, `kop`) VALUES
	(1, 'KLC Cabang Kediri', 'magersari gurah kediri halo halo', 'KEDIRI', NULL),
	(2, 'KLC cabang suryabaya', 'aklsdfjkl', 'SURABAYA', NULL),
	(3, 'ksdlfj', 'skdjksld', 'kjf', 'Kantor Cabang : Jln. Raya Dadapan - sumberejo Kab. Kediri (081133378240)');
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
  `status` enum('1','0') DEFAULT '0',
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.jabatan: ~4 rows (approximately)
DELETE FROM `jabatan`;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `jabatan`, `gaji_pokok`, `uang_makan`, `status`, `id_cabang`) VALUES
	(1, 'Base Managger', '400000', '30000', '0', 1),
	(24, 'anak psg', '400000', '30000', '1', 2),
	(25, 'Staff Keuangan Pusat', '500000', '30000', '0', 1),
	(26, 'Staff Keuangan Cabang', '400000', '30000', '0', 1),
	(27, 'halo', '200000', '3000', '1', 2);
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
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.karyawan: ~4 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`, `id_cabang`) VALUES
	(1, '001', 'hari', '2349023890482', 'gurah', 26, 1),
	(2, '002', 'maryanto', '032489023', 'gurah', 26, 1),
	(4, 'kk001', 'deni', '234789', 'gurah', 1, 1);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.kategori_barang
DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spesial_cargo` varchar(40) NOT NULL,
  `charge` varchar(5) NOT NULL,
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.kategori_barang: ~3 rows (approximately)
DELETE FROM `kategori_barang`;
/*!40000 ALTER TABLE `kategori_barang` DISABLE KEYS */;
INSERT INTO `kategori_barang` (`id`, `spesial_cargo`, `charge`, `id_cabang`) VALUES
	(1, 'Hewan Hidup', '100', 1),
	(2, 'Tanaman Hidup', '50', 1),
	(3, 'Meat / Frozen Food', '50', 1),
	(4, 'burger king121', '19', 1);
/*!40000 ALTER TABLE `kategori_barang` ENABLE KEYS */;

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
  `tahun` int(9) DEFAULT NULL,
  `nama_pajak` varchar(150) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('bulanan','tahunan') DEFAULT 'bulanan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak: ~6 rows (approximately)
DELETE FROM `pajak`;
/*!40000 ALTER TABLE `pajak` DISABLE KEYS */;
INSERT INTO `pajak` (`id`, `bulan`, `tahun`, `nama_pajak`, `total`, `status`) VALUES
	(1, 1, 2019, 'pajak', 2638, 'bulanan'),
	(2, NULL, 2018, 'total_pajak', 5000, 'tahunan'),
	(3, 2, 2019, 'pajak', 22425, 'bulanan'),
	(4, 3, 2019, 'pajak', 0, 'bulanan'),
	(5, 4, 2019, 'pajak', 8705, 'bulanan'),
	(6, 5, 2019, 'pajak', 30058, 'bulanan');
/*!40000 ALTER TABLE `pajak` ENABLE KEYS */;

-- Dumping structure for table kargo.pajak_armada
DROP TABLE IF EXISTS `pajak_armada`;
CREATE TABLE IF NOT EXISTS `pajak_armada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_armada` int(11) DEFAULT '0',
  `nama_pajak` varchar(50) DEFAULT '0',
  `tgl_bayar` date DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `tgl_peringatan` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak_armada: ~5 rows (approximately)
DELETE FROM `pajak_armada`;
/*!40000 ALTER TABLE `pajak_armada` DISABLE KEYS */;
INSERT INTO `pajak_armada` (`id`, `id_armada`, `nama_pajak`, `tgl_bayar`, `tgl_kadaluarsa`, `tgl_peringatan`) VALUES
	(1, 4, 'pajak tahunan', '2019-05-09', '2019-11-20', '2019-11-13'),
	(10, 4, 'pajak 5 tahun', '2019-05-09', '2019-11-22', '2019-11-15'),
	(11, 4, 'pajak KIR', NULL, NULL, NULL),
	(12, 1, 'pajak tahunan', '2019-05-08', '2019-06-08', '2019-06-01'),
	(13, 1, 'pajak KIR', NULL, NULL, NULL);
/*!40000 ALTER TABLE `pajak_armada` ENABLE KEYS */;

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
  `kode_antar` text,
  `admin` varchar(100) DEFAULT NULL,
  `nama_barang` text,
  `pengiriman_via` enum('darat','laut','udara','city kurier') DEFAULT NULL,
  `kota_asal` varchar(40) DEFAULT NULL,
  `kode_tujuan` text,
  `tgl` date DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
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
  `biaya_cancel` int(11) DEFAULT '0',
  `total_biaya` int(11) DEFAULT '0',
  `biaya_suratjalan` int(11) DEFAULT '0',
  `keterangan` text,
  `status` enum('Y','N','US','RS') DEFAULT 'N',
  `satuan` varchar(10) DEFAULT NULL,
  `metode_bayar` enum('cash','bt') DEFAULT 'cash',
  `metode_input` enum('manual','otomatis') DEFAULT 'otomatis',
  `pemegang` varchar(90) DEFAULT NULL,
  `batal` enum('Y','N') DEFAULT 'N',
  `status_antar` enum('N','Y','G','P','KL') DEFAULT 'N',
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~38 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_antar`, `id_cabang`) VALUES
	(1, 'KDR080719-06-000001', NULL, NULL, 'SA140719-12-000001', 'devasatrio', 'burung', 'darat', 'kediri', 'malang kidul', '2019-07-08', NULL, NULL, 1, '5', '20 x 30 x 20', '3', 'hari', 'hendri', '2039482903', '9023890238', 'magersari gurah', 'kasdlfjklasdfj', 170000, 2000, 3000, 0, 0, 0, 0, 0, 175000, 0, 'males ae ngeter ne', 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'Y', 1),
	(2, 'KDR080719-06-000002', NULL, NULL, 'SA090719-12-000002', 'devasatrio', 'jilbab pubg mobile', 'darat', 'kediri', 'etan', '2019-07-08', NULL, '2019-07-08', 1, '5', '30 x 40 x 50', '15', 'haris', 'bamo', '9023849230890', '239023', 'bringin gurah', 'giraj als;dfkl;sadf', 200000, 40000, 60000, 0, 0, 0, 0, 0, 300000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'Y', 1),
	(3, 'KDR080719-06-000003', '123 - 0983948', NULL, 'SA090719-12-000001', 'devasatrio', 'roda motor', 'laut', 'kediri', 'laut02', '2019-07-08', NULL, NULL, 1, '5', '40 x 30 x 20', '6', 'marni', 'deni', '923489023890', '9023489023', 'gurah', 'babatan', 170000, 5000, 10000, 0, 0, 0, 0, 0, 185000, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'Y', 1),
	(4, 'KDR080719-06-000004', NULL, NULL, 'SA150719-06-000001', 'devasatrio', 'sepatu futsal', 'udara', 'kediri', 'cikarang', '2019-07-08', NULL, NULL, 2, '4', '-', '-', 'heri', 'denaaa', '93289023', '930282390890', 'gurah', 'lampung', 180000, 0, 0, 0, 25000, 2000, 0, 0, 207000, 0, 'Tempat penerima tutup', 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'P', 1),
	(5, '12345-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '2', 'N', 'N', 1),
	(6, '12345-002', NULL, NULL, 'SA150719-06-000004', 'devasatrio', 'kue coklat', 'laut', 'kediri', 'manado', '2019-07-15', NULL, '2019-07-15', 1, '1', '20 x 30 x 30', '5', 'harioadf', 'sjdfks', '29034920', '9023890', 'gurah', 'askldfjaskld', 200000, 2000, 3000, 0, 0, 0, 0, 0, 205000, 0, NULL, 'US', 'kg', 'cash', 'manual', '2', 'N', 'P', 1),
	(7, 'KDR110719-10-000001', NULL, 'SJ110719-12-000001', NULL, 'dinisumi', 'krupuk', 'darat', 'kediri', 'malang kidul', '2019-07-11', NULL, '2019-07-11', 1, '2', '20 x 10 x 20', '1', 'hario', 'skadlfjkadslf', '23908423908', '220348239', 'sadklfjaskldf sakdfjklasdfj', 'ksljdfkl', 68000, 2000, 3000, 0, 0, 0, 0, 0, 73000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(8, 'KDR140719-10-000001', NULL, NULL, 'SA140719-12-000001', 'dinisumi', 'sepatu kuda', 'darat', 'kediri', 'malang kidul', '2019-07-14', NULL, NULL, 1, '1', '20 x 10 x 50', '3', 'heru', 'deni', '024893208', '932084290', 'gurah', 'dskafjkl', 102000, 1000, 2000, 0, 0, 0, 0, 0, 105000, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'P', 1),
	(9, 'KDR140719-10-000002', NULL, 'SJ140719-12-000001', NULL, 'dinisumi', 'sepatu sapi', 'laut', 'kediri', 'laut03', '2019-07-14', NULL, '2019-07-14', 1, '30', '20 x 30 x 10', '2', 'kasldfjkl', 'skadjfkl', '9238932', '2039230', 'ksadjkl', 'jslkadfjlksdaf', 1020000, 1000, 2000, 0, 0, 0, 0, 0, 1023000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(10, 'KDR160719-06-000001', NULL, NULL, NULL, 'devasatrio', 'asdfjlkasdfj', 'udara', 'kediri', 'kalimantan', '2019-07-16', NULL, '2019-07-16', 2, '3', '-', '-', 'haroi', 'jaskldfjaskl', '092384902', '023849028', 'klsadjfklasdfjkl', 'sakldfjaskldf', 60000, 0, 0, 0, 5000, 2000, 60000, 0, 127000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(11, 'KDR160719-06-000002', '23-2938472893', NULL, NULL, 'devasatrio', 'pohon kelapa', 'udara', 'kediri', 'bali', '2019-07-16', NULL, '2019-07-16', 3, '12', '-', '-', 'asdfklasdfj', 'hari ani subandi', '9023849028', '0293842390', 'aasdfkasjdfkl', 'magersari gurah kediri', 360000, 0, 0, 0, 5000, 1000, 180000, 0, 546000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(12, 'KDR160719-06-000003', '290348920', NULL, NULL, 'devasatrio', 'spiker aktiv', 'udara', 'kediri', 'banten', '2019-07-16', NULL, '2019-07-16', 3, '20', '-', '-', 'hari', 'dendi sumarno', '9203849023', '9238490', 'klasjdfklasd kasdjfkla', 'bringin jalan walabi 32 sidnew', 400000, 0, 0, 0, 5000, 2000, 0, 0, 407000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(13, 'KDR160719-06-000004', 'ha-o0239409', NULL, NULL, 'devasatrio', 'susu', 'udara', 'kediri', 'bandung betet', '2019-07-16', NULL, '2019-07-16', 3, '9', '-', '-', 'hakld', 'bani umayah', '2093489023', '920384902390', 'jklsadfjkl asdkfjasdklf', 'sempu ngancar', 180000, 0, 0, 0, 5000, 2000, 0, 0, 187000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(14, 'KDR160719-06-000005', '2342342342', NULL, NULL, 'devasatrio', 'asdkfjaskdf', 'udara', 'kediri', 'bali', '2019-07-16', NULL, '2019-07-16', 2, '9', '-', '-', 'askdlfj', 'subandi binarti', '92310849023', '023492893428', 'subandiw89owa', 'magersari gurah kediri', 270000, 0, 0, 0, 5000, 0, 0, 0, 275000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(15, 'KDR160719-06-000006', '239048290', NULL, NULL, 'devasatrio', 'sepatu kuda liar', 'udara', 'kediri', 'bandung betet', '2019-07-16', NULL, '2019-07-16', 2, '5', '-', '-', 'hariono', 'sunarti mariana', '2903489023', '239849203820', 'gurah kediri', 'gurah kediri jln penuh liku', 100000, 0, 0, 0, 5000, 0, 0, 0, 105000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(16, 'KDR160719-06-000007', '39-3748923789', NULL, NULL, 'devasatrio', 'spiker', 'udara', 'KEDIRI', 'bali', '2019-07-16', NULL, '2019-07-16', 1, '4', '20 x 30 x 40', '4', 'hari ono', 'mariono suhari', '29034290390', '290348290390', 'mag', 'magersari gurah kediri', 80000, 0, 0, 0, 5000, 0, 0, 0, 85000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(17, 'KDR160719-06-000008', '39-234789', NULL, NULL, 'devasatrio', 'susu kerbau liar', 'udara', 'KEDIRI', 'kalimantan', '2019-07-16', NULL, '2019-07-16', 1, '11', '40 x 40 x 40', '11', 'kasdfjkl', 'diniani natalia', '2394829038', '2308239048290', 'kalsdjf asdkjfaskdf asdjfklasf', 'gurah kediri jln penuh liku', 220000, 0, 0, 0, 5000, 0, 0, 0, 225000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(18, 'KDR160719-06-000009', '2390482390', NULL, NULL, 'devasatrio', 'tas ransel', 'udara', 'KEDIRI', 'lombok', '2019-07-16', NULL, '2019-07-16', 1, '2', '30 x 40 x 10', '2', 'aklsdfjkl', 'heari', '923489023', '290348290', 'kalsdjf afkasjf lkasfklasf', 'klasdjf asdklfjaskl klasdf asldaslkf', 80000, 0, 0, 0, 25000, 0, 0, 0, 105000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(19, 'KDR160719-06-000010', NULL, NULL, NULL, 'devasatrio', 'asdfasdf', 'udara', 'KEDIRI', 'bali', '2019-07-16', NULL, '2019-07-16', 1, '5', '30 x 30 x 30', '5', 'asdfjkasldf', 'askdfj askdfj klasdf klasdf', '239842930', '290348902389', 'askdjskla asjdklf asdkfjakl sdfklsa', 'ksaldj asdfj asljfasklf askfal', 150000, 0, 0, 0, 5000, 0, 0, 0, 155000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(20, 'KDR160719-06-000011', '9234020348', NULL, NULL, 'devasatrio', 'sdf asdfasdfasdf', 'udara', 'KEDIRI', 'lombok', '2019-07-16', NULL, '2019-07-16', 2, '3', '-', '-', 'asdklfja', 'kasdjklas asklfasklf', '2349023', '290384902', 'kjsklad fasdkjf askldjaklsdfkawd', 'kasjf askldf lask fkla fkl;as', 120000, 0, 0, 0, 25000, 0, 0, 0, 145000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(21, 'KDR160719-06-000012', '4982-23947', NULL, NULL, 'devasatrio', 'klasdfjaskldfj', 'udara', 'KEDIRI', 'udara0009', '2019-07-16', NULL, '2019-07-16', 2, '12', '-', '-', 'aklsj asd klasdfj', 'skladjf askdf aklsfjklas', '2398490', '923894023', 'askdjfklasd fklasd fklasdfjklasf', 'kas dk asdfasklf klasjfkl', 240000, 0, 0, 0, 5000, 0, 0, 0, 245000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(22, 'KDR180719-06-000001', '098-7867678', NULL, NULL, 'devasatrio', 'halo halo', 'udara', 'KEDIRI', 'banten', '2019-07-18', NULL, '2019-07-18', 1, '5', '20 x 30 x 10', '1', 'kljk asdkfjaskl', 'kasljfk asf asklfjaskl', '23239048', '309284902', 'skladjfklasd asdjfkasldf', 'aksjklas sakdjaksl', 100000, 0, 0, 0, 5000, 1000, 100000, 0, 206000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(23, 'KDR180719-06-000002', '290348902', NULL, NULL, 'devasatrio', 'asdfasjdlk', 'udara', 'KEDIRI', 'kalimantan', '2019-07-18', NULL, '2019-07-18', 1, '1', '20 x 10 x 20', '1', 'kasldj', 'sakldjfklas', '3242930', '902384923', 'ksladjfkl', 'aklsdjaskdl', 20000, 0, 0, 0, 5000, 200, 0, 0, 25200, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(24, 'KDR180719-06-000003', NULL, NULL, NULL, 'devasatrio', 'askdljaskld', 'udara', 'KEDIRI', 'bali', '2019-07-18', NULL, '2019-07-18', 1, '1', '30 x 20 x 10', '1', 'sdkf', 'jaskljkl', '332098', '2339084920', 'kasjdklf asjsakl', 'sajfklas', 20000, 0, 0, 0, 5000, 0, 0, 0, 25000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(25, 'KDR180719-06-000004', '293840-239', NULL, NULL, 'devasatrio', 'klasfj', 'udara', 'KEDIRI', 'kalimantan', '2019-07-18', NULL, '2019-07-18', 1, '1', '20 x 20 x 20', '1', 'aslkjf', 'ajskld asfj sakljfsakl', '902389023', '932084902', 'kslajf asjfsaklf asjklfasjkfl', 'asldkfj aslkkdjsakldjfsdkl fskj', 20000, 0, 0, 0, 5000, 2000, 0, 0, 27000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(26, 'KDR180719-06-000005', 'askdl', NULL, NULL, 'devasatrio', 'askdjaksld', 'udara', 'KEDIRI', 'bali', '2019-07-18', NULL, '2019-07-18', 1, '5', '20 x 30 x 40', '4', 'sakld', 'klasjfk sjasklj', '2903890', '29308902', 'kslaj asdjfdsklfjkas as', 'ksaj sklasafjkls fsj f', 100000, 0, 0, 0, 5000, 100, 0, 0, 105100, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(27, 'KDR180719-06-000006', '90293089', NULL, NULL, 'devasatrio', 'sadkljaks', 'udara', 'KEDIRI', 'kalimantan', '2019-07-18', NULL, '2019-07-18', 1, '1', '20 x 20 x 20', '1', 'kasdfj', 'jksdajkla sajf', '0923890', '093290', 'klasfj', 'klasjklsa askjkl', 20000, 0, 0, 0, 5000, 0, 0, 0, 25000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(28, 'KDR180719-06-000007', '29038490-2478', NULL, NULL, 'devasatrio', 'sadfkalsdj', 'udara', 'KEDIRI', 'kalimantan', '2019-07-18', NULL, '2019-07-18', 1, '5', '30 x 30 x 30', '5', 'sakljfkl', 'sakdj', '04290', '23904890', 'jklasdj asdfjsakldj asjakl', 'sajfklas asklasjfkla', 100000, 0, 0, 0, 5000, 1000, 0, 0, 106000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(29, 'KDR180719-06-000008', NULL, NULL, NULL, 'devasatrio', NULL, 'udara', 'KEDIRI', NULL, '2019-07-18', NULL, '2019-07-18', 1, '0', '0 x 0 x 0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(30, 'KDR180719-06-000009', NULL, NULL, NULL, 'devasatrio', NULL, 'udara', 'KEDIRI', NULL, '2019-07-18', NULL, '2019-07-18', 1, '0', '0 x 0 x 0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(31, 'KDR180719-06-000010', NULL, NULL, NULL, 'devasatrio', NULL, 'udara', 'KEDIRI', NULL, '2019-07-18', NULL, '2019-07-18', 1, '0', '0 x 0 x 0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(32, 'KDR180719-06-000011', NULL, NULL, NULL, 'devasatrio', NULL, 'udara', 'KEDIRI', NULL, '2019-07-18', NULL, '2019-07-18', 1, '0', '0 x 0 x 0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(33, 'KDR180719-06-000012', NULL, NULL, NULL, 'devasatrio', NULL, 'udara', 'KEDIRI', NULL, '2019-07-18', NULL, '2019-07-18', 1, '0', '0 x 0 x 0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(34, 'KDR180719-06-000013', 'asdfasdf', NULL, NULL, 'devasatrio', 'kontlo', 'udara', 'KEDIRI', 'banten', '2019-07-19', NULL, '2019-07-18', 1, '6', '40 x 20 x 40', '5', 'skladfj', 'jaskldjf', '303928490', '09238490', 'jksaldfj', 'aksldjklas', 380000, 0, 0, 0, 5000, 2000, 0, 0, 387000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(35, 'KDR180719-06-000014', NULL, NULL, NULL, 'devasatrio', 'kljskljd sajfklsadf', 'city kurier', 'kediri', 'malang kidul', '2019-07-19', NULL, '2019-07-19', 1, '2', '20 x 30 x 10', '2', 'kasldjf', 'ksaldj', '902890', '92038490', 'jsakl sadjfklj sadklfjkl', 'sjakdlfksl', 68000, 2000, 2000, 0, 0, 0, 0, 0, 72000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(36, 'KDR180719-06-000015', NULL, NULL, 'SA190719-06-000001', 'devasatrio', 'coba city kurir', 'city kurier', 'kediri', 'kediri lor', '2019-07-18', NULL, '2019-07-18', 2, '3', '40 x 20 x 30', '6', 'hari andri', 'deni sumarni', '082592837489237', '203849023', 'askl asdfkjsklf sdf', 'hakd sdkjfskld sdjksjdkl', 250000, 4000, 1000, 0, 0, 0, 0, 0, 255000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'P', 1),
	(38, 'KDR190719-06-000001', NULL, NULL, NULL, 'devasatrio', 'halo halo', 'city kurier', 'KEDIRI', 'kediri lor', '2019-07-19', NULL, '2019-07-19', 1, '1', '10 x 10 x 30', '1', 'askdlfj', 'ksladjkl', '2849023', '90238490', 'asklfdj asdjfkl sadfjklasd', 'skalf sadkjlk', 34000, 2000, 1000, 0, 0, 0, 0, 37000, 11100, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'Y', 'N', 1),
	(39, 'KDR230719-06-000001', '23904890', NULL, NULL, 'devasatrio', 'sabu sabu', 'udara', 'KEDIRI', 'kalimantan', '2019-07-23', NULL, '2019-07-23', 1, '4', '40 x 30 x 20', '4', 'hariono', '20938490', '203890', '3849023', 'gurah kediri', 'aksldfjkl', 80000, 0, 0, 0, 5000, 1000, 0, 0, 86000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(40, 'KDR290719-06-000001', NULL, NULL, NULL, 'devasatrio', 'saf', 'darat', 'kediri', 'malang kidul', '2019-07-29', NULL, '2019-07-29', 1, '3', '20 x 20 x 20', '2', 'asdf', 'ksadlf', '242', '230984', 'skadf asdjfkaslf', 'skaldfj sadkjfklsdf', 102000, 2000, 1000, 0, 0, 0, 0, 0, 105000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1),
	(41, 'KDR290719-06-000002', NULL, NULL, NULL, 'devasatrio', 'halo hai', 'darat', 'KEDIRI', 'malang kidul', '2019-07-29', NULL, '2019-07-29', 1, '5', '30 x 30 x 30', '7', 'sadf', 'skdfj sf', '2423', '3298492', 'sadjf sdj sdklf', 'sdkjs dklsd', 238000, 2000, 1000, 0, 0, 0, 0, 0, 241000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1);
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
  `status` enum('Y','N') DEFAULT NULL,
  `bulan_sekarang` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.setting: ~0 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `desk_udara`, `desk_laut`, `desk_darat`, `status`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', 'Y', 7);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_antar: ~8 rows (approximately)
DELETE FROM `surat_antar`;
/*!40000 ALTER TABLE `surat_antar` DISABLE KEYS */;
INSERT INTO `surat_antar` (`id`, `id_karyawan`, `kode`, `tgl`, `pemegang`, `telp`, `status`) VALUES
	(1, '2', 'SA090719-12-000001', '2019-07-09', 'maryanto', '032489023', 'S'),
	(2, '1', 'SA090719-12-000002', '2019-07-09', 'hari', '2349023890482', 'S'),
	(3, '1', 'SA110719-12-000001', '2019-07-11', 'hari', '2349023890482', 'S'),
	(4, '1', 'SA140719-12-000001', '2019-07-14', 'hari', '2349023890482', 'Y'),
	(5, '2', 'SA150719-06-000001', '2019-07-15', 'maryanto', '032489023', 'Y'),
	(6, '2', 'SA150719-06-000002', '2019-07-15', 'maryanto', '032489023', 'Y'),
	(7, '2', 'SA150719-06-000003', '2019-07-15', 'maryanto', '032489023', 'Y'),
	(8, '2', 'SA150719-06-000004', '2019-07-15', 'maryanto', '032489023', 'Y'),
	(9, '1', 'SA190719-06-000001', '2019-07-19', 'hari', '2349023890482', 'Y');
/*!40000 ALTER TABLE `surat_antar` ENABLE KEYS */;

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
  `cabang` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_jalan: ~0 rows (approximately)
DELETE FROM `surat_jalan`;
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`, `cabang`) VALUES
	(1, 'hardian', 'SJ110719-12-000001', 'PT Iwak Enak-083223336313', '2019-07-11', 'Y', 2, 1, 73000, 0, NULL, 'mungkung loceret nganjuk', 'N'),
	(2, NULL, 'SJ140719-12-000001', NULL, '2019-07-14', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 'N');
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
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~2 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`) VALUES
	(13, 'darat00001', 'malang kidul', 34000, 3, '2', 1),
	(14, 'darat00002', 'kediri lor', 34000, 3, '2', 1);
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
  `id_cabang` int(11) DEFAULT '1',
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
	(15, 'laut0002', 'laut02', 34000, 20, '2', 1),
	(16, 'laut0003', 'laut03', 34000, 34, '2', 1),
	(17, 'laut0004', 'laut04', 40000, 10, '2', 1),
	(18, 'laut0005', 'laut05', 34000, 34, '2', 1),
	(19, 'laut0006', 'laut06', 12000, 11, '2', 1),
	(27, 'laut0020', 'laut20', 12014, 25, '2', 1),
	(28, 'laut0021', 'laut21', 12015, 26, '2', 1),
	(29, 'laut0022', 'laut22', 12016, 27, '2', 1),
	(30, 'laut0023', 'laut23', 12017, 28, '2', 1),
	(31, 'laut0024', 'laut24', 12018, 29, '2', 1),
	(32, 'laut0025', 'laut25', 12019, 30, '2', 1),
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
  `perkg` int(11) DEFAULT '0',
  `minimal_heavy` int(11) DEFAULT '0',
  `biaya_dokumen` int(11) DEFAULT '0',
  `berat_minimal` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT '1',
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
	(20, 'udara0014', 'situbondo', 'garuda', 50000, 30, 25000, 11, 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_kategoriakutansi: ~13 rows (approximately)
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
	(13, '013', 'Pajak Perusahaan', 'pengeluaran', 'N');
/*!40000 ALTER TABLE `tb_kategoriakutansi` ENABLE KEYS */;

-- Dumping structure for table kargo.tb_neraca
DROP TABLE IF EXISTS `tb_neraca`;
CREATE TABLE IF NOT EXISTS `tb_neraca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `kas` bigint(40) DEFAULT NULL,
  `modal` bigint(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_neraca: ~0 rows (approximately)
DELETE FROM `tb_neraca`;
/*!40000 ALTER TABLE `tb_neraca` DISABLE KEYS */;
INSERT INTO `tb_neraca` (`id`, `tahun`, `bulan`, `kas`, `modal`) VALUES
	(1, 2019, 6, 9960, NULL);
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
  `id_cabang` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~7 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`, `id_cabang`) VALUES
	(3, 'vendor001', 'PT tani mundur jaya', '085552344556', 'Jln saguling no 1 malang', 'Y', 1),
	(4, 'vendor002', 'PT Iwak Enak', '083223336313', 'mungkung loceret nganjuk', 'N', 1),
	(5, 'vendor003', 'PT Moro Dadi', '082122272212', 'Jln badut ulang tahun no 3 magelang', 'N', 1),
	(6, 'vendor0013', 'pt pubg', '2303849023890', 'gurah kediri', 'Y', 1),
	(8, 'vdrh001', 'pt iwak pitek', '203482390', 'gurah', 'N', 1),
	(9, 'vdrh002', 'ph ksdjf', '293849', 'loceret', 'Y', 2),
	(10, 'vrdrh003', 'pt salkdfj', '20389', 'nganjuk', 'N', 2);
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
