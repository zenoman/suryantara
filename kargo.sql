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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.admin: ~5 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`, `level`) VALUES
	(6, 'Admin-000001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari', 'programer'),
	(7, 'Admin-000002', 'harianti', '74b213f68f648006a318f52713450f27', 'harianto', '085604556712', 'harianto@gmail.com', 'magersari gurah depan pga', 'admin'),
	(9, 'Admin-000003', 'abiihsan', '74b213f68f648006a318f52713450f27', 'abi ihsan fadli', '098765546', 'abi@gmail.com', 'gurah', 'programer'),
	(10, 'Admin-000004', 'dinisumi', '74b213f68f648006a318f52713450f27', 'cs dini', '09128390128', 'dian@gmail.com', 'gurah', 'cs'),
	(11, 'Admin-000005', 'atiqowner', '74b213f68f648006a318f52713450f27', 'pak atiq', '09328903289023', 'dianade@gmail.com', 'gurah', 'superadmin'),
	(12, 'Admin-000006', 'hardian', '74b213f68f648006a318f52713450f27', 'hardian', '2398782397892', 'harianto@gmail.com', 'gurah', 'operasional');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

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

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.karyawan: ~2 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`) VALUES
	(1, '001', 'hari', '2349023890482', 'gurah', 26),
	(2, '002', 'maryanto', '032489023', 'gurah', 26);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;


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

DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

-- Dumping structure for table kargo.resi_pengiriman
DROP TABLE IF EXISTS `resi_pengiriman`;
DELETE FROM `pengeluaran_lain`;
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
INSERT INTO `pengeluaran_lain` (`id`, `admin`, `kategori`, `keterangan`, `jumlah`, `tgl`, `gambar`) VALUES
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
	(24, 'abiihsan', '013', '45443', 40, '2019-07-29', '1559121450-9.jpg'),
	(25, 'devasatrio', '004', 'asdf', 20000, '2019-07-09', '');
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

-- membuang struktur untuk table kargo.penyusutan
CREATE TABLE IF NOT EXISTS `penyusutan` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `residu` bigint(100) DEFAULT NULL,
  `umurbln` int(11) DEFAULT NULL,
  `umurthn` int(11) DEFAULT NULL,
  `penyusutan` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kargo.penyusutan: ~2 rows (lebih kurang)
DELETE FROM `penyusutan`;
/*!40000 ALTER TABLE `penyusutan` DISABLE KEYS */;
INSERT INTO `penyusutan` (`id`, `nama`, `harga`, `residu`, `umurbln`, `umurthn`, `penyusutan`) VALUES
	(1, 'Bangunan', '1200000000', NULL, 240, NULL, 5000000),
	(2, 'Mobil Daihatsu Gran Max', '147000000', NULL, 60, NULL, 2450000);
/*!40000 ALTER TABLE `penyusutan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `resi_pengiriman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_resi` text,
  `no_smu` text,
  `kode_jalan` text,
  `kode_antar` text,
  `admin` varchar(100) DEFAULT NULL,
  `nama_barang` text,
  `pengiriman_via` enum('darat','laut','udara') DEFAULT NULL,
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
  `status_pengiriman` enum('siap dikirim','handle by vendor','menuju alamat tujuan','pengantaran ulang','paket telah sampai','dikembalikan ke pengirim','sudah dikembalikan') DEFAULT 'siap dikirim',
  `status_antar` enum('N','Y','G','P','KL') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.resi_pengiriman: ~9 rows (approximately)
DELETE FROM `resi_pengiriman`;
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `kode_antar`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `tgl_bayar`, `tgl_lunas`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `alamat_pengirim`, `alamat_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `biaya_charge`, `biaya_cancel`, `total_biaya`, `biaya_suratjalan`, `keterangan`, `status`, `satuan`, `metode_bayar`, `metode_input`, `pemegang`, `batal`, `status_pengiriman`, `status_antar`) VALUES
	(1, 'KDR080719-06-000001', NULL, NULL, 'SA140719-12-000001', 'devasatrio', 'burung', 'darat', 'kediri', 'malang kidul', '2019-07-08', NULL, NULL, 1, '5', '20 x 30 x 20', '3', 'hari', 'hendri', '2039482903', '9023890238', 'magersari gurah', 'kasdlfjklasdfj', 170000, 2000, 3000, 0, 0, 0, 0, 0, 175000, 0, 'males ae ngeter ne', 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'paket telah sampai', 'Y'),
	(2, 'KDR080719-06-000002', NULL, NULL, 'SA090719-12-000002', 'devasatrio', 'jilbab pubg mobile', 'darat', 'kediri', 'etan', '2019-07-08', NULL, '2019-07-08', 1, '5', '30 x 40 x 50', '15', 'haris', 'bamo', '9023849230890', '239023', 'bringin gurah', 'giraj als;dfkl;sadf', 200000, 40000, 60000, 0, 0, 0, 0, 0, 300000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'paket telah sampai', 'Y'),
	(3, 'KDR080719-06-000003', '123 - 0983948', NULL, 'SA090719-12-000001', 'devasatrio', 'roda motor', 'laut', 'kediri', 'laut02', '2019-07-08', NULL, NULL, 1, '5', '40 x 30 x 20', '6', 'marni', 'deni', '923489023890', '9023489023', 'gurah', 'babatan', 170000, 5000, 10000, 0, 0, 0, 0, 0, 185000, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'paket telah sampai', 'Y'),
	(4, 'KDR080719-06-000004', NULL, NULL, 'SA090719-12-000002', 'devasatrio', 'sepatu futsal', 'udara', 'kediri', 'cikarang', '2019-07-08', NULL, NULL, 2, '4', '-', '-', 'heri', 'denaaa', '93289023', '930282390890', 'gurah', 'lampung', 180000, 0, 0, 0, 25000, 2000, 0, 0, 207000, 0, 'Tempat penerima tutup', 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'pengantaran ulang', 'KL'),
	(5, '12345-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '2', 'N', 'siap dikirim', 'N'),
	(6, '12345-002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'N', NULL, 'cash', 'manual', '2', 'N', 'siap dikirim', 'N'),
	(7, 'KDR110719-10-000001', NULL, 'SJ110719-12-000001', NULL, 'dinisumi', 'krupuk', 'darat', 'kediri', 'malang kidul', '2019-07-11', NULL, '2019-07-11', 1, '2', '20 x 10 x 20', '1', 'hario', 'skadlfjkadslf', '23908423908', '220348239', 'sadklfjaskldf sakdfjklasdfj', 'ksljdfkl', 68000, 2000, 3000, 0, 0, 0, 0, 0, 73000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'siap dikirim', 'N'),
	(8, 'KDR140719-10-000001', NULL, NULL, 'SA140719-12-000001', 'dinisumi', 'sepatu kuda', 'darat', 'kediri', 'malang kidul', '2019-07-14', NULL, NULL, 1, '1', '20 x 10 x 50', '3', 'heru', 'deni', '024893208', '932084290', 'gurah', 'dskafjkl', 102000, 1000, 2000, 0, 0, 0, 0, 0, 105000, 0, NULL, 'N', 'kg', 'bt', 'otomatis', NULL, 'N', 'menuju alamat tujuan', 'P'),
	(9, 'KDR140719-10-000002', NULL, 'SJ140719-12-000001', NULL, 'dinisumi', 'sepatu sapi', 'laut', 'kediri', 'laut03', '2019-07-14', NULL, '2019-07-14', 1, '30', '20 x 30 x 10', '2', 'kasldfjkl', 'skadjfkl', '9238932', '2039230', 'ksadjkl', 'jslkadfjlksdaf', 1020000, 1000, 2000, 0, 0, 0, 0, 0, 1023000, 0, NULL, 'US', 'kg', 'cash', 'otomatis', NULL, 'N', 'siap dikirim', 'N');
/*!40000 ALTER TABLE `resi_pengiriman` ENABLE KEYS */;


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


DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `desk_udara`, `desk_laut`, `desk_darat`, `status`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya udara</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya laut</li></ul>', '<ul><li><strong>Estimasi</strong> biaya akan kosong apa bila berat tidak memenuhi berat minimal pengiriman</li><li><strong>Estimasi</strong> biaya belum termasuk biaya tambahan</li><li>Biaya tambahan meliputi : ppn, biaya surat muatan udara(SMU), biaya Surcharge, biaya karantina.</li><li><strong>Surcharge</strong> adalah kategori barang tertentu yang mendapat tambahan biaya darat</li></ul>', 'Y', 7);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kargo.surat_antar: ~2 rows (approximately)
DELETE FROM `surat_antar`;
/*!40000 ALTER TABLE `surat_antar` DISABLE KEYS */;
INSERT INTO `surat_antar` (`id`, `id_karyawan`, `kode`, `tgl`, `pemegang`, `telp`, `status`) VALUES
	(1, '2', 'SA090719-12-000001', '2019-07-09', 'maryanto', '032489023', 'S'),
	(2, '1', 'SA090719-12-000002', '2019-07-09', 'hari', '2349023890482', 'S'),
	(3, '1', 'SA110719-12-000001', '2019-07-11', 'hari', '2349023890482', 'S'),
	(4, '1', 'SA140719-12-000001', '2019-07-14', 'hari', '2349023890482', 'Y');
/*!40000 ALTER TABLE `surat_antar` ENABLE KEYS */;


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

DROP TABLE IF EXISTS `tarif_darat`;
CREATE TABLE IF NOT EXISTS `tarif_darat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `berat_min` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.tarif_darat: ~3 rows (approximately)
DELETE FROM `tarif_darat`;
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(13, 'darat00001', 'malang kidul', 34000, 3, '2'),
	(14, 'darat00002', 'kediri lor', 34000, 3, '2'),
	(16, 'darat00004', 'etan', 40000, 3, '2');
/*!40000 ALTER TABLE `tarif_darat` ENABLE KEYS */;

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


DROP TABLE IF EXISTS `tb_neraca`;
CREATE TABLE IF NOT EXISTS `tb_neraca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `status` enum('D','K') NOT NULL,
  `total` bigint(40) DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table kargo.vendor: ~4 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`) VALUES
	(3, 'vendor001', 'PT tani mundur jaya', '085552344556', 'Jln saguling no 1 malang', 'Y'),
	(4, 'vendor002', 'PT Iwak Enak', '083223336313', 'mungkung loceret nganjuk', 'N'),
	(5, 'vendor003', 'PT Moro Dadi', '082122272212', 'Jln badut ulang tahun no 3 magelang', 'N'),
	(6, 'vendor0013', 'pt pubg', '2303849023890', 'gurah kediri', 'Y');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;


DROP TRIGGER IF EXISTS `editadmin`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `editadmin` BEFORE UPDATE ON `admin` FOR EACH ROW BEGIN
update resi_pengiriman set admin=new.username where admin=old.username;
update surat_jalan set admin=new.username where admin=old.username;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


DROP TRIGGER IF EXISTS `editkaryawan`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `editkaryawan` BEFORE UPDATE ON `karyawan` FOR EACH ROW BEGIN
update gaji_karyawan set nama_karyawan=new.nama where nama_karyawan=old.nama;
update surat_antar set pemegang=new.nama, telp=new.telp where id_karyawan=old.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


DROP TRIGGER IF EXISTS `editvendor`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `editvendor` BEFORE UPDATE ON `vendor` FOR EACH ROW BEGIN
update surat_jalan set tujuan=concat(new.vendor,'-',new.telp) where tujuan=concat(old.vendor,'-',old.telp);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


DROP TRIGGER IF EXISTS `hapus_suratantar`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `hapus_suratantar` BEFORE DELETE ON `surat_antar` FOR EACH ROW BEGIN
delete from resi_pengiriman where resi_pengiriman.kode_antar = old.kode;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


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
