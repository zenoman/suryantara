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

-- Dumping data for table kargo.absensi: ~5 rows (approximately)
DELETE FROM `absensi`;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` (`id`, `id_karyawan`, `id_jabatan`, `tanggal`, `masuk`, `tidak_masuk`, `izin`, `keterangan_izin`, `uang_makan`, `id_cabang`) VALUES
	(1, 1, 2, '2019-09-22', 1, 0, 0, '-', '10000', 2),
	(2, 5, 8, '2019-09-22', 1, 0, 0, '-', '10000', 2),
	(3, 6, 8, '2019-09-22', 0, 0, 1, 'sakit', '0', 2),
	(4, 2, 1, '2019-09-26', 1, 0, 0, '-', '10000', 1),
	(5, 3, 7, '2019-09-26', 1, 0, 0, '-', '10000', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.armada: ~2 rows (approximately)
DELETE FROM `armada`;
/*!40000 ALTER TABLE `armada` DISABLE KEYS */;
INSERT INTO `armada` (`id`, `nama`, `nopol`, `nomor_rangka`, `nomor_mesin`, `warna`, `id_cabang`) VALUES
	(1, 'Supra fit merah', '0293490', '9024902', '90489320', 'putih', 1),
	(2, 'Gran Max', '23082', '90284902', '39048920', 'putih', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.cabang: ~3 rows (approximately)
DELETE FROM `cabang`;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`id`, `nama`, `alamat`, `kota`, `kop`, `koderesi`, `norek`) VALUES
	(1, 'KLC Cabang Kediri', 'magersari gurah kediri halo halo', 'KEDIRI', NULL, 'KDR', NULL),
	(2, 'KLC cabang surabaya', 'aklsdfjkl', 'SURABAYA', 'kantor cabang : jln iwak enak no 2+2 konoha surabaya', 'SBY', 'Bank Mandiri 082098320 AN KLC SUB'),
	(6, 'KLC Cabang Tulungagung', 'tulung agung', 'TULUNGAGUNG', 'ajsdklfj', 'TLG', '23309iwi');
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
  `bon` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.gaji_karyawan: ~8 rows (approximately)
DELETE FROM `gaji_karyawan`;
/*!40000 ALTER TABLE `gaji_karyawan` DISABLE KEYS */;
INSERT INTO `gaji_karyawan` (`id`, `kode_karyawan`, `nama_karyawan`, `id_jabatan`, `gaji_pokok`, `uang_makan`, `gaji_tambahan`, `total`, `bulan`, `tahun`, `id_cabang`, `bon`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2019, 1, 0),
	(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2019, 6, 0),
	(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2019, 2, 0),
	(4, 'kar-0002', 'mega ari', 1, 2000000, 10000, NULL, 2010000, 9, 2019, 1, 0),
	(5, ' kar-0003', 'haris', 7, 1200000, 10000, NULL, 1210000, 9, 2019, 1, 0),
	(6, 'kar-0001', 'hargian', 2, 2500000, 10000, NULL, 2510000, 9, 2019, 2, 0),
	(7, ' kar-0005', 'jaenal', 8, 1800000, 10000, NULL, 1810000, 9, 2019, 2, 0),
	(8, ' kar-0006', 'zakaria', 8, 1800000, 0, NULL, 1810000, 9, 2019, 2, 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.jabatan: ~8 rows (approximately)
DELETE FROM `jabatan`;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `jabatan`, `gaji_pokok`, `uang_makan`, `status`, `id_cabang`) VALUES
	(1, 'admin KDR', '2000000', '10000', '0', 1),
	(2, 'admin SBY', '2500000', '10000', '0', 2),
	(3, 'Branch Manager KDR', '3000000', '20000', '1', 1),
	(4, 'Branch Manager SBY', '4000000', '25000', '1', 2),
	(5, 'cs KDR', '1500000', '5000', '0', 1),
	(6, 'cs SBY', '1800000', '7000', '0', 2),
	(7, 'kurir KDR', '1200000', '10000', '0', 1),
	(8, 'kurir SBY', '1800000', '10000', '0', 2);
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
  `batas_bon` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.karyawan: ~6 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`, `id_cabang`, `batas_bon`) VALUES
	(1, 'kar-0001', 'hargian', '23094829038', 'magersari surabaya', 2, 2, 0),
	(2, 'kar-0002', 'mega ari', '234829038490', 'gurah kediri', 1, 1, 0),
	(3, ' kar-0003', 'haris', '29048902', 'gurah kediri', 7, 1, 0),
	(5, ' kar-0005', 'jaenal', '23423', 'magersari surabaya', 8, 2, 0),
	(6, ' kar-0006', 'zakaria', '2345342', 'magersari surabaya', 8, 2, 0);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- Dumping structure for table kargo.kategori_barang
DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spesial_cargo` varchar(40) DEFAULT NULL,
  `charge` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.kategori_barang: ~2 rows (approximately)
DELETE FROM `kategori_barang`;
/*!40000 ALTER TABLE `kategori_barang` DISABLE KEYS */;
INSERT INTO `kategori_barang` (`id`, `spesial_cargo`, `charge`) VALUES
	(1, 'tanaman beracun', '50'),
	(2, 'senjata', '100');
/*!40000 ALTER TABLE `kategori_barang` ENABLE KEYS */;

-- Dumping structure for table kargo.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kargo.migrations: ~2 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.mitra: ~2 rows (approximately)
DELETE FROM `mitra`;
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
INSERT INTO `mitra` (`id`, `nama`, `alamat`, `notelp`, `id_cabang`) VALUES
	(1, 'PT gurah menyala', 'gurah kediri', '20384920', 1),
	(2, 'PT iwak enak', 'magersari surabaya', '20348290329', 2);
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;

-- Dumping structure for table kargo.neraca
DROP TABLE IF EXISTS `neraca`;
CREATE TABLE IF NOT EXISTS `neraca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `debit` int(11) DEFAULT 0,
  `kredit` int(11) DEFAULT 0,
  `admin` varchar(50) DEFAULT NULL,
  `id_cabang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.neraca: ~18 rows (approximately)
DELETE FROM `neraca`;
/*!40000 ALTER TABLE `neraca` DISABLE KEYS */;
INSERT INTO `neraca` (`id`, `bulan`, `tahun`, `keterangan`, `debit`, `kredit`, `admin`, `id_cabang`) VALUES
	(1, '8', '2019', 'Pajak Pemasukan Resi', 0, 0, 'damara', '2'),
	(2, '8', '2019', 'Pemasukan resi lunas', NULL, 0, 'damara', '2'),
	(3, '8', '2019', 'Pemasukan resi belum lunas', NULL, 0, 'damara', '2'),
	(4, '8', '2019', 'Pemasukan Piutang resi ', 0, 0, 'damara', '2'),
	(5, '8', '2019', 'Pengeluaran Harian', 0, 0, 'damara', '2'),
	(6, '8', '2019', 'Gaji Karyawan', 0, NULL, 'damara', '2'),
	(7, '8', '2019', 'Pajak Pemasukan Resi', 0, 0, 'damara', '1'),
	(8, '8', '2019', 'Pemasukan resi lunas', NULL, 0, 'damara', '1'),
	(9, '8', '2019', 'Pemasukan resi belum lunas', NULL, 0, 'damara', '1'),
	(10, '8', '2019', 'Pemasukan Piutang resi ', 0, 0, 'damara', '1'),
	(11, '8', '2019', 'Pengeluaran Harian', 0, 0, 'damara', '1'),
	(12, '8', '2019', 'Gaji Karyawan', 0, NULL, 'damara', '1'),
	(13, '8', '2019', 'Pajak Pemasukan Resi', 0, 0, 'admin tulungagung', '6'),
	(14, '8', '2019', 'Pemasukan resi lunas', NULL, 0, 'admin tulungagung', '6'),
	(15, '8', '2019', 'Pemasukan resi belum lunas', NULL, 0, 'admin tulungagung', '6'),
	(16, '8', '2019', 'Pemasukan Piutang resi ', 0, 0, 'admin tulungagung', '6'),
	(17, '8', '2019', 'Pengeluaran Harian', 0, 0, 'admin tulungagung', '6'),
	(18, '8', '2019', 'Gaji Karyawan', 0, NULL, 'admin tulungagung', '6');
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
  `tahun` varchar(50) DEFAULT NULL,
  `nama_pajak` varchar(150) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_cabang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak: ~2 rows (approximately)
DELETE FROM `pajak`;
/*!40000 ALTER TABLE `pajak` DISABLE KEYS */;
INSERT INTO `pajak` (`id`, `bulan`, `tahun`, `nama_pajak`, `total`, `id_cabang`) VALUES
	(1, 8, '2019', 'Pajak Pendapatan', 0, '2'),
	(2, 8, '2019', 'Pajak Pendapatan', 0, '1'),
	(3, 8, '2019', 'Pajak Pendapatan', 0, '6');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak_armada: ~4 rows (approximately)
DELETE FROM `pajak_armada`;
/*!40000 ALTER TABLE `pajak_armada` DISABLE KEYS */;
INSERT INTO `pajak_armada` (`id`, `id_armada`, `nama_pajak`, `tgl_bayar`, `tgl_kadaluarsa`, `tgl_peringatan`) VALUES
	(1, 1, 'pajak tahunan', NULL, NULL, NULL),
	(2, 1, 'kir', NULL, NULL, NULL),
	(3, 2, 'pajak tahunan', NULL, NULL, NULL),
	(4, 3, 'kir', NULL, NULL, NULL),
	(5, 4, 'pajak 5 tahun', NULL, NULL, NULL);
/*!40000 ALTER TABLE `pajak_armada` ENABLE KEYS */;

-- Dumping structure for table kargo.pajak_kendaraan
DROP TABLE IF EXISTS `pajak_kendaraan`;
CREATE TABLE IF NOT EXISTS `pajak_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idarmada` varchar(50) NOT NULL DEFAULT '0',
  `tgl` varchar(50) NOT NULL DEFAULT '0',
  `bulan` varchar(50) NOT NULL DEFAULT '0',
  `tahun` varchar(50) NOT NULL DEFAULT '0',
  `nominal` int(11) NOT NULL DEFAULT 0,
  `bukti` text NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL DEFAULT '0',
  `admin` varchar(50) NOT NULL DEFAULT '0',
  `id_cabang` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pajak_kendaraan: ~0 rows (approximately)
DELETE FROM `pajak_kendaraan`;
/*!40000 ALTER TABLE `pajak_kendaraan` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.pengeluaran_lain: ~0 rows (approximately)
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

-- Dumping structure for table kargo.resi_mentah
DROP TABLE IF EXISTS `resi_mentah`;
CREATE TABLE IF NOT EXISTS `resi_mentah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_resi` varchar(100) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  `pembuat` varchar(50) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_mentah: ~10 rows (approximately)
DELETE FROM `resi_mentah`;
/*!40000 ALTER TABLE `resi_mentah` DISABLE KEYS */;
INSERT INTO `resi_mentah` (`id`, `no_resi`, `id_cabang`, `pembuat`, `status`) VALUES
	(6, 'resimanual006', 1, 'devasatrio', 'Y'),
	(7, 'resimanual007', 1, 'devasatrio', 'Y'),
	(8, 'resimanual008', 1, 'devasatrio', 'Y'),
	(9, 'resimanual009', 1, 'devasatrio', 'Y'),
	(10, 'resimanual010', 1, 'devasatrio', 'Y'),
	(11, 'resimanual011', 2, 'devasatrio', 'Y'),
	(12, 'resimanual012', 2, 'devasatrio', 'Y'),
	(13, 'resimanual013', 2, 'devasatrio', 'Y'),
	(14, 'resimanual014', 2, 'devasatrio', 'Y'),
	(15, 'resimanual015', 2, 'devasatrio', 'Y');
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
  `dimensi` varchar(100) DEFAULT NULL,
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
  `transfer` enum('Y','N') DEFAULT 'N',
  `total_berat_udara` int(11) DEFAULT NULL,
  `maskapai_udara` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~6 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `kode_envoice`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `nama_penerima_barang`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `total_bayar`, `kekurangan`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_antar`, `id_cabang`, `katakun`, `status_pengiriman`, `status_company`, `duplikat`, `transfer`, `total_berat_udara`, `maskapai_udara`) VALUES
	(1, 'resimanual001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '3', 'N', 'N', 1, 1, NULL, 'N', 'N', 'N', NULL, NULL),
	(2, 'resimanual002', NULL, NULL, NULL, NULL, 'devasatrio', 'askldf asdfkj saf', 'city kurier', 'KEDIRI', 'banyuanyar', '2019-09-26', NULL, '2019-09-26', 1, '1', '30 x 20 x 30', '1', 'sadf asdf', 'asdf asdf', NULL, '454534', '45234324', 'asdf asdf asdf asdf', 'asdf asdf asdf asfd', 10000, 2000, 3000, 0, 0, 0, 0, 0, 15000, 15000, 0, 0, NULL, 'N', 'kg', 'cash', 'manual', '3', 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'N', 'N', NULL, NULL),
	(3, 'resimanual003', 'asd-239472', NULL, NULL, NULL, 'devasatrio', 'lampu tidur', 'udara', 'KEDIRI', 'manado', '2019-09-26', NULL, NULL, 3, '1,1,1,', '30 x 20 x 10,30 x 20 x 10,30 x 20 x 10,', '1,1,1,', 'askldjf', 'askldf', NULL, '02934890', '9023490', 'asjdkfl asdfjlksad asdklf sadflasdf', 'jlksad asdlfksa', 150000, 0, 0, 0, 15000, 2000, 0, 0, 167000, 100000, 67000, 0, NULL, 'N', 'kg', 'cash', 'manual', '3', 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'N', 'N', 3, 'Lion'),
	(4, 'resimanual004', NULL, NULL, NULL, NULL, 'devasatrio', 'sempak', 'laut', 'KEDIRI', 'ambon', '2019-09-26', NULL, NULL, 1, '3', '20 x 30 x 20', '3', 'jasdflkj', 'klsdfj', NULL, '2384908', '39045890', 'askd asdfjl', 'jskldf asdfjklasd sdklfjkl', 75000, 2000, 3000, 0, 0, 0, 0, 0, 80000, 40000, 40000, 0, NULL, 'N', 'kg', 'cash', 'manual', '3', 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'N', 'N', NULL, NULL),
	(5, 'resimanual005', NULL, NULL, NULL, NULL, 'devasatrio', 'spiker', 'darat', 'KEDIRI', 'tulungagung', '2019-09-26', NULL, NULL, 1, '5', '30 x 20 x 30', '5', 'asdasdf', 'kjasldfk', NULL, '234902390', '02934890', 'asdk sadfkljsaklf', 'skladf asdkfjklsadf', 75000, 2000, 3000, 0, 0, 0, 0, 0, 80000, 40000, 40000, 0, NULL, 'N', 'kg', 'cash', 'manual', '3', 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'N', 'N', NULL, NULL),
	(6, 'KDR260919-20-000001', NULL, NULL, NULL, NULL, 'devasatrio', 'asd', 'darat', 'KEDIRI', 'blitar', '2019-09-26', NULL, NULL, 1, '5', '30 x 20 x 30', '5', 'asdf', 'sjadklf', NULL, '23423423', '290489', 'asdf asdfasdf asdf sa', 'askldf sadfjklasdf asdfjklasdf', 100000, 2000, 3000, 0, 0, 0, 0, 0, 105000, 60000, 45000, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'N', 'N', NULL, NULL),
	(7, 'KDR260919-20-000002', NULL, NULL, NULL, NULL, 'devasatrio', 'laskdf asdfkl saf', 'laut', 'KEDIRI', 'ambon', '2019-09-26', NULL, NULL, 1, '5', '30 x 20 x 30', '5', 'asdf', 'sadf', NULL, '234', '243', 'sadf asd as', 'sadf asdf', 125000, 20000, 5000, 0, 0, 0, 0, 0, 150000, 80000, 70000, 0, NULL, 'N', 'kg', 'cash', 'otomatis', NULL, 'N', 'N', 1, 1, 'barang diterima KLC Cabang KEDIRI', 'N', 'N', 'N', NULL, NULL);
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
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<p>Dear client untuk saat ini data Cabang surabaya dapat di isi tapi untuk transaksi dsb harap sabar :-*</p>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', NULL, 'Y', 9);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.status_pengiriman: ~6 rows (approximately)
DELETE FROM `status_pengiriman`;
/*!40000 ALTER TABLE `status_pengiriman` DISABLE KEYS */;
INSERT INTO `status_pengiriman` (`id`, `kode`, `status`, `keterangan`, `tgl`, `jam`, `lokasi`) VALUES
	(1, 'resimanual005', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-09-26', '21:52:53', 'KEDIRI'),
	(2, 'resimanual004', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-09-26', '22:01:20', 'KEDIRI'),
	(3, 'resimanual003', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-09-26', '22:11:40', 'KEDIRI'),
	(4, 'resimanual002', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-09-26', '22:31:25', 'KEDIRI'),
	(5, 'KDR260919-20-000001', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-09-26', '22:40:17', 'KEDIRI'),
	(6, 'KDR260919-20-000002', 'barang diterima KLC Cabang KEDIRI', NULL, '2019-09-26', '22:42:23', 'KEDIRI');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_antar: ~0 rows (approximately)
DELETE FROM `surat_antar`;
/*!40000 ALTER TABLE `surat_antar` DISABLE KEYS */;
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
  `id_cabang` int(11) DEFAULT 1,
  `tarif_city` enum('Y','N') DEFAULT 'N',
  `company` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~7 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`, `tarif_city`, `company`) VALUES
	(2, 'PR', 'pare', 15000, 5, '1', 1, 'N', 'N'),
	(3, 'TLG', 'tulungagung', 15000, 5, '1', 1, 'N', 'N'),
	(4, 'BLT', 'blitar', 20000, 5, '1', 1, 'N', 'N'),
	(6, 'BLT', 'blitar', 20000, 5, '1', 2, 'N', 'N'),
	(7, 'cty001', 'ngancar', 10000, 10, '1', 1, 'Y', 'N'),
	(9, 'cty003', 'banyuanyar', 10000, 2, '1', 1, 'Y', 'N'),
	(13, 'ctycmp004', 'gayam', 5000, 2, '1', 1, 'Y', 'Y'),
	(14, 'ctycmp005', 'gayam', 5000, 2, '1', 2, 'Y', 'Y');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_laut: ~3 rows (approximately)
DELETE FROM `tarif_laut`;
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`, `id_cabang`) VALUES
	(1, 'MLK', 'maluku', 25000, 2, '1', 1),
	(2, 'AMB', 'ambon', 25000, 2, '1', 1),
	(7, 'MND', 'manado', 30000, 2, '1', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_udara: ~5 rows (approximately)
DELETE FROM `tarif_udara`;
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `perkg`, `minimal_heavy`, `biaya_dokumen`, `berat_minimal`, `id_cabang`) VALUES
	(3, 'MND', 'manado', 'Lion', 50000, 20, 15000, 10, 1),
	(4, 'MND', 'manado', 'batik air', 50000, 20, 15000, 10, 1),
	(9, 'MND', 'manado', 'batik air', 50000, 20, 15000, 10, 2),
	(10, 'KLM', 'kalimantan', 'Lion', 50000, 20, 15000, 10, 2),
	(11, 'KLM', 'kalimantan', 'garuda', 50000, 20, 15000, 10, 2);
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
	(5, '005', 'BBM', 'pengeluaran', 'Y'),
	(6, '006', 'Service', 'pengeluaran', 'Y'),
	(7, '007', 'Parkir', 'pengeluaran', 'Y'),
	(8, '008', 'Tol', 'pengeluaran', 'Y'),
	(9, '009', 'ATK', 'pengeluaran', 'Y'),
	(10, '010', 'Listrik', 'pengeluaran', 'Y'),
	(11, '011', 'Internet', 'pengeluaran', 'Y'),
	(12, '012', 'Modal', 'pendapatan', 'N'),
	(14, '260', 'Surat Jalan', 'pengeluaran', 'Y');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.tb_neraca: ~0 rows (approximately)
DELETE FROM `tb_neraca`;
/*!40000 ALTER TABLE `tb_neraca` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_neraca` ENABLE KEYS */;

-- Dumping structure for table kargo.transfer
DROP TABLE IF EXISTS `transfer`;
CREATE TABLE IF NOT EXISTS `transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(50) NOT NULL DEFAULT '0',
  `tahun` varchar(50) NOT NULL DEFAULT '0',
  `id_cabang` varchar(10) NOT NULL DEFAULT '0',
  `cabang_tujuan` varchar(10) NOT NULL DEFAULT '0',
  `nominal` int(11) NOT NULL DEFAULT 0,
  `bukti` text NOT NULL DEFAULT '0',
  `admin` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.transfer: ~0 rows (approximately)
DELETE FROM `transfer`;
/*!40000 ALTER TABLE `transfer` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.users: ~13 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `remember_token`, `email`, `alamat`, `level`, `id_cabang`) VALUES
	(19, 'Admin-000013', 'oprasionalkdr', '$2y$10$VoXBjFs17gnvwTlDmRPYDuWYLRRhmf43hEm/MqNba0XbacElVpEgO', 'oprasional cabang kdr', '29038902', '', 'satriosuklun@gmail.com', 'gurah kediri', '8', 1),
	(20, 'Admin-000002', 'devasatrio', '$2y$10$hohuZPOG9mAmD9vcEC/3rupKt.3bsHWG0t.iKaHlNO7G1nRCqXWbW', 'deva satrio damara', '081220380607', 'DGzMdkqzqSnDNjb4dZ9gmK96oeAZKSkRBig8OvdvsupFypSTNU', 'damarasatrio@gmail.com', 'magersair gurah kediri', '1', 1),
	(21, 'Admin-000003', 'owner', '$2y$10$FpEDAdK56kLoU12R1.CnfuGYo7x2K1ZK6cM5ETHYp1GcFOefKwo4K', 'owner', '20498290', 't9AcQsvijoyNgA8v0zNVcewVaProLjJ5bEnNRMCV0uUrBlvowg', 'satriosuklun@gmail.com', 'gurah kediri', '3', 1),
	(22, 'Admin-000004', 'adminpusat', '$2y$10$QiRkVMZSjInbzvLk1p/QxOzGSn6iXYRWN0m982c.pCHA07OVlTrwm', 'admin pusat', '092384902890', '', 'satriosuklun@gmail.com', 'gurah', '2', 1),
	(23, 'Admin-000005', 'hrdpusat', '$2y$10$qKClj6gSbbhy6c5ClHISreaTNmF7is2kHOZEWAeK8oToyEKls3Nme', 'hrd pusat', '029384902890', 'FujXiwvViimSgBe3AFwjOjr2mIO0H6NPijfYbWoNxT6o7LBiSc', 'satriosuklun@gmail.com', 'gurah', '5', 1),
	(24, 'Admin-000006', 'bmkdr', '$2y$10$ujThfDj1dsSQto7r4sNayO51eZYu.O9T9MWslWinCHd4mxxwsT6Qu', 'branch manager kdr', '29038490238490', '', 'satriosuklun@gmail.com', 'gurah kediri', '6', 1),
	(25, 'Admin-000007', 'bmsby', '$2y$10$FzLs/ga3wjZk.JQjcKtyKeO/5nqaF8D3z8ej5PiFj9PmcYus3P1Zy', 'branch manager sby', '001001', 'YzZoJYzs8J5PfeVzcbF07AgoLMPM8rSSOEZCUSbAZp76cnoDc9', 'satriosuklun@gmail.com', 'bringin bulurejo 001 kec.gurah kediri', '6', 2),
	(26, 'Admin-000008', 'adminkdr', '$2y$10$g/Mi7k9.0K/CWN3PnM5iB.lrbVygko2QOuslkLiuNiW3MuZeYi656', 'admin cabang kdr', '02938490', 'K5nyTZEfoEH0GhEzJ9b55vSZ6tzySKic53eOM5dCPOaj64RvWj', 'satriosuklun@gmail.com', 'gurah kediri', '9', 1),
	(27, 'Admin-000009', 'adminsby', '$2y$10$lnLkC/Kmdv8OsxPNEKahxOT5w02gS2WWPNQV.4TVPkdUGAzez2Gp.', 'admin cabang sby', '203489032', 'qGQ9q5Hom1bKywimaHAkab2AEYyR0b2lOQ9tkzNjRUp9xR78ad', 'satriosuklun@gmail.com', 'magersari surabaya', '9', 2),
	(28, 'Admin-000010', 'cskdr', '$2y$10$a2RlVyGmFTEweyhFDeymkOH3UFP8v/RFyDmk6NQZn/FOHSM3sGg7O', 'cs kediri', '203984902', '', 'satriosuklun@gmail.com', 'gurah kediri', '4', 1),
	(29, 'Admin-000011', 'cssby', '$2y$10$XqdzKCjITu9ueIhNwt9G6eCOBwkWdW2ro/ze3G0u00Iw1gbG8nINe', 'cs surabaya mantab', '2093489320', 'H1jqIVrU6alUPU2WhJsTg9Eer1zsVfOLRFF579gWVGMFhQHZt9', 'satriosuklun@gmail.com', 'magersari surabaya', '4', 2),
	(30, 'Admin-000012', 'oprasionalpusat', '$2y$10$yt3mxWzFfmYAwHjgnJ92Je7eEr2TOWPZZHCZtkCeFpYRsFC.TcRT6', 'oprasional pusat', '20938490', 'oB4ZWUs0gRHSJyfqaml7QJwR6Nu2jDDO8jhRga2SIfemZAVO8D', 'satriosuklun@gmail.com', 'gurah kediri', '7', 1),
	(32, 'Admin-000014', 'oprasionalsby', '$2y$10$yTY9/GWXHIfYXFDo5tHBceVdwdsVlpSrfHOyjLi6LT076FUJzjrF6', 'oprasional cabang sby', '20938490', 'bF2tsrXjAW6TVQs8WTMpsiPnPkRnYhaKPjQspasmUmhfA7eG08', 'satriosuklun@gmail.com', 'magersari surabaya', '8', 2),
	(33, 'Admin-000015', 'admintlg', '$2y$10$plr.dGxfhmAxQcO1R9XDReJmVVf6yVo9ozv/.kzmMtf8lpU2Qz222', 'admin tulungagung', '92038490', 'NRxGBo0FRyDlEsx5kDl0GeuwBYsGPWYE6X2UsAQmudhRdbaXbL', 'satriosuklun@gmail.com', 'sukomoro tulungagung', '9', 6);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~5 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`, `id_cabang`) VALUES
	(1, 'vndkdr001', 'pt gurah sejahtera', '239483290', 'gurah kediri', 'N', 1),
	(2, 'vndkdr002', 'PT bringin maju', '9203843290', 'gurah kediri', 'N', 1),
	(3, 'vndsby001', 'CV baya gila', '23423', 'magersari surabaya', 'N', 2),
	(4, 'vndsby002', 'PT emoh rugi', '234234', 'magersari surabaya', 'N', 2),
	(5, 'vndsby003', 'PT cahaya surabaya', '23423', 'magersari surabaya', 'N', 2);
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

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
