-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.36-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk kargo
DROP DATABASE IF EXISTS `kargo`;
CREATE DATABASE IF NOT EXISTS `kargo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kargo`;

-- membuang struktur untuk table kargo.admin
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

-- Membuang data untuk tabel kargo.admin: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT IGNORE INTO `admin` (`id`, `kode`, `username`, `password`, `nama`, `telp`, `email`, `alamat`, `level`) VALUES
	(6, 'Admin-000001', 'devasatrio', '74b213f68f648006a318f52713450f27', 'deva satrio', '085604556712', 'satriosuklun@gmail.com', 'gurah magersari', 'programer'),
	(7, 'Admin-000002', 'harianti', '74b213f68f648006a318f52713450f27', 'harianto', '085604556712', 'harianto@gmail.com', 'magersari gurah depan pga', 'admin'),
	(9, 'Admin-000003', 'abiihsan', '74b213f68f648006a318f52713450f27', 'abi ihsan fadli', '098765546', 'abi@gmail.com', 'gurah', 'programer');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- membuang struktur untuk table kargo.jabatan
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` int(11) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kargo.jabatan: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT IGNORE INTO `jabatan` (`id`, `kategori`, `jabatan`) VALUES
	(21, 0, 'Staff'),
	(22, 0, 'Staff Keuangan');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;

-- membuang struktur untuk table kargo.karyawan
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kargo.karyawan: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT IGNORE INTO `karyawan` (`id`, `kode`, `nama`, `telp`, `alamat`, `id_jabatan`) VALUES
	(1, 'Karyawan-000001', 'abi ihsan', '085755957230', 'kediri', 22);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- membuang struktur untuk table kargo.kategori_barang
DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spesial_cargo` varchar(40) NOT NULL,
  `charge` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kargo.kategori_barang: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `kategori_barang` DISABLE KEYS */;
INSERT IGNORE INTO `kategori_barang` (`id`, `spesial_cargo`, `charge`) VALUES
	(1, 'Hewan Hidup', '100'),
	(2, 'Tanaman Hidup', '50'),
	(3, 'Meat / Frozen Food', '50');
/*!40000 ALTER TABLE `kategori_barang` ENABLE KEYS */;

-- membuang struktur untuk table kargo.kode_resimanual
DROP TABLE IF EXISTS `kode_resimanual`;
CREATE TABLE IF NOT EXISTS `kode_resimanual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5669 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kargo.kode_resimanual: ~14 rows (lebih kurang)
/*!40000 ALTER TABLE `kode_resimanual` DISABLE KEYS */;
INSERT IGNORE INTO `kode_resimanual` (`id`, `faktur`) VALUES
	(1, '56565'),
	(2, '676767'),
	(5657, '456'),
	(5658, '170098'),
	(5659, '170099'),
	(5660, '170100'),
	(5661, '170101'),
	(5662, '170102'),
	(5663, '170103'),
	(5664, '170104'),
	(5665, '170105'),
	(5666, '170106'),
	(5667, '170107'),
	(5668, '170108');
/*!40000 ALTER TABLE `kode_resimanual` ENABLE KEYS */;

-- membuang struktur untuk table kargo.omset
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

-- Membuang data untuk tabel kargo.omset: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
INSERT IGNORE INTO `omset` (`id`, `bulan`, `tahun`, `pemasukan`, `pengeluaran`, `pengeluaran_lainya`, `laba`) VALUES
	(1, 1, 2018, 342500, 130000, 40000, 172500);
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- membuang struktur untuk table kargo.pengeluaran_lain
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

-- Membuang data untuk tabel kargo.pengeluaran_lain: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `pengeluaran_lain` DISABLE KEYS */;
INSERT IGNORE INTO `pengeluaran_lain` (`id`, `admin`, `kategori`, `keterangan`, `jumlah`, `tgl`, `gambar`) VALUES
	(8, 'devasatrio', 'bbm', 'beli bensin', 30000, '2019-01-02', '1546440740-logo.jpg'),
	(9, 'devasatrio', 'parkir', 'parkir mobil', 20000, '2019-01-03', '1546477524-logo.jpg'),
	(10, 'devasatrio', 'tol', 'bayar tol surabaya', 3000, '2019-02-03', '1546482244-img-20181126-wa0003.jpg'),
	(11, 'devasatrio', 'parkir', 'parkir jet', 40000, '2018-12-03', '1546484974-img-20181023-wa0023.jpg'),
	(12, 'devasatrio', 'parkir', 'parkir mobil putih', 2000, '2019-01-04', '1546576232-favicon.png');
/*!40000 ALTER TABLE `pengeluaran_lain` ENABLE KEYS */;

-- membuang struktur untuk table kargo.resi_pengiriman
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

-- Membuang data untuk tabel kargo.resi_pengiriman: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `resi_pengiriman` DISABLE KEYS */;
INSERT IGNORE INTO `resi_pengiriman` (`id`, `no_resi`, `no_smu`, `kode_jalan`, `admin`, `nama_barang`, `pengiriman_via`, `kota_asal`, `kode_tujuan`, `tgl`, `jumlah`, `berat`, `dimensi`, `ukuran_volume`, `nama_pengirim`, `nama_penerima`, `telp_pengirim`, `telp_penerima`, `biaya_kirim`, `biaya_packing`, `biaya_asuransi`, `biaya_ppn`, `biaya_smu`, `biaya_karantina`, `total_biaya`, `keterangan`, `status`, `satuan`, `metode_bayar`) VALUES
	(1, 'KDR291218-06-000001', NULL, 'SJ291218-06-000002', 'devasatrio', 'sepatu bola', 'darat', 'kediri', 'malang', '2018-12-29', 1, 8, '20 x 30 x 50', '7.5', 'deni', 'hadi', '0932749', '02934890', 24000, 2000, 60, 240, 0, 0, 26300, 'halo halo', 'N', 'kg', 'bt'),
	(2, 'KDR291218-06-000002', '4354345', 'SJ291218-06-000001', 'devasatrio', 'jkhjkhc', 'udara', 'hghghj', 'alor', '2018-12-29', 1, 3, '20 x 30 x 20', '3', 'ewre', 'werwer', '56456', '7687', 120000, 0, 0, 1200, 25000, 40000, 186200, 'dfsfd', 'Y', 'kg', 'bt'),
	(3, 'KDR291218-06-000003', NULL, 'SJ291218-06-000002', 'devasatrio', 'sepatu bola', 'laut', 'kediri', 'kalimantan', '2018-12-28', 1, 3, '30 x 10 x 30', '2.25', 'hari', 'dini', '027348628734678', '873248927389247', 120000, 8000, 800, 1200, 0, 0, 130000, 'halo halo', 'N', 'kg', 'cash'),
	(4, 'KDR020119-06-000001', NULL, 'SJ020119-06-000001', 'devasatrio', 'sepatu kuda', 'darat', 'kediri', 'malang', '2019-01-02', 1, 3, '20 x 30 x 20', '3', 'heri', 'marno', '02348920', '039485903', 9000, 1010, 900, 90, 0, 0, 11000, 'cepet ya', 'N', 'kg', 'bt'),
	(5, 'KDR020119-06-000002', NULL, 'SJ020119-06-000001', 'devasatrio', 'rokok surya', 'laut', 'kediri', 'sumatra', '2019-01-02', 1, 4, '30 x 50 x 10', '3.75', 'hasan', 'fulan', '093284902', '289048290', 120000, 800, 1000, 1200, 0, 0, 123000, 'cepet ya', 'N', 'kg', 'cash'),
	(6, 'KDR020119-06-000003', '256 - 8981290', 'SJ020119-06-000001', 'devasatrio', 'hanger baju', 'udara', 'kediri', 'balikpapan', '2019-01-02', 1, 3, '20 x 30 x 20', '3', 'indah', 'sari', '092384902', '0293480', 69000, 0, 0, 690, 25000, 4000, 98690, 'cepet ya gan', 'N', 'kg', 'bt'),
	(7, 'KDR020119-06-000004', NULL, 'SJ020119-06-000002', 'devasatrio', 'koper', 'darat', 'kediri', 'nganjuk', '2019-01-02', 1, 3, '20 x 30 x 20', '3', 'hendri', 'dini', '902384902', '029384902', 7500, 2500, 25, 75, 0, 0, 10100, 'asdf', 'N', 'kg', 'cash'),
	(8, 'KDR020119-06-000005', NULL, 'SJ020119-06-000002', 'devasatrio', 'casing hp', 'darat', 'kediri', 'malang', '2019-01-02', 1, 1, '30 x 20 x 10', '1.5', 'hina', 'hiwa', '0923489290', '093484590', 20000, 800, 0, 200, 0, 0, 21000, 'celkawj', 'N', 'koli', 'bt');
/*!40000 ALTER TABLE `resi_pengiriman` ENABLE KEYS */;

-- membuang struktur untuk table kargo.setting
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

-- Membuang data untuk tabel kargo.setting: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT IGNORE INTO `setting` (`id`, `namaweb`, `email`, `kontak`, `icon`, `logo`, `header`, `landing`, `sapaan`, `desk`, `alamat`, `bulan_sekarang`) VALUES
	(1, 'Suryantara', 'abihsan@gmail.com', '082261110369', '1546485899-favicon.png', '1546486783-favicon.png', 'PT SURYANTARA CARGO', '1546074136-delivery.png', 'SELAMAT DATANG DI WEBSITE RESMI KAMI', 'PT SURYANTARA CARGO adalah jasa pengiriman barang yang telah terbukti kwalitas dan pelayanan nya', 'Jln PGA No.1 RW 01 RT 01 magersari gurah kediri', 1);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- membuang struktur untuk table kargo.surat_jalan
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

-- Membuang data untuk tabel kargo.surat_jalan: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT IGNORE INTO `surat_jalan` (`id`, `admin`, `kode`, `tujuan`, `tgl`, `status`, `totalkg`, `totalkoli`, `totalcash`, `totalbt`, `biaya`, `alamat_tujuan`) VALUES
	(1, 'devasatrio', 'SJ291218-06-000001', 'PT Iwak Enak-083223336313', '2018-12-29', 'P', 3, 1, 0, 186200, 50000, 'mungkung loceret nganjuk'),
	(2, 'devasatrio', 'SJ291218-06-000002', 'PT tani mundur jaya-085552344556', '2018-12-29', 'P', 11, 2, 130000, 26300, 80000, 'Jln saguling no 1 malang'),
	(3, 'devasatrio', 'SJ020119-06-000001', 'PT Moro Dadi-082122272212', '2019-01-02', 'P', 10, 3, 123000, 109690, 30000, 'Jln badut ulang tahun no 3 magelang'),
	(4, 'devasatrio', 'SJ020119-06-000002', 'PT tani mundur jaya-085552344556', '2019-01-02', 'P', 4, 2, 10100, 21000, 25000, 'Jln saguling no 1 malang');
/*!40000 ALTER TABLE `surat_jalan` ENABLE KEYS */;

-- membuang struktur untuk table kargo.tarif_darat
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

-- Membuang data untuk tabel kargo.tarif_darat: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tarif_darat` DISABLE KEYS */;
INSERT IGNORE INTO `tarif_darat` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
	(13, 'darat00001', 'malang kidul', 34000, 3, '2'),
	(14, 'darat00002', 'kediri lor', 34000, 3, '2'),
	(16, 'darat00004', 'etan', 40000, 3, '2');
/*!40000 ALTER TABLE `tarif_darat` ENABLE KEYS */;

-- membuang struktur untuk table kargo.tarif_laut
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

-- Membuang data untuk tabel kargo.tarif_laut: ~51 rows (lebih kurang)
/*!40000 ALTER TABLE `tarif_laut` DISABLE KEYS */;
INSERT IGNORE INTO `tarif_laut` (`id`, `kode`, `tujuan`, `tarif`, `berat_min`, `estimasi`) VALUES
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

-- membuang struktur untuk table kargo.tarif_udara
DROP TABLE IF EXISTS `tarif_udara`;
CREATE TABLE IF NOT EXISTS `tarif_udara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `airlans` varchar(100) DEFAULT NULL,
  `id_kategori_barang` int(11) NOT NULL,
  `perkg` int(11) DEFAULT '0',
  `minimal_heavy` int(11) DEFAULT '0',
  `biaya_dokumen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel kargo.tarif_udara: ~11 rows (lebih kurang)
/*!40000 ALTER TABLE `tarif_udara` DISABLE KEYS */;
INSERT IGNORE INTO `tarif_udara` (`id`, `kode`, `tujuan`, `airlans`, `id_kategori_barang`, `perkg`, `minimal_heavy`, `biaya_dokumen`) VALUES
	(6, 'udara0001', 'udara0001', 'LION', 0, 20000, 55, 5000),
	(7, 'udara0002', 'udara0002', 'LION', 0, 20000, 55, 5000),
	(8, 'udara0003', 'udara0003', 'LION', 0, 20000, 55, 5000),
	(9, 'udara0004', 'udara0004', 'AIRLINE', 0, 20000, 55, 5000),
	(10, 'udara0005', 'udara0005', 'AIRLINE', 0, 30000, 55, 5000),
	(11, 'udara0006', 'udara0006', 'AIRLINE', 0, 20000, 55, 5000),
	(12, 'udara0007', 'udara0007', 'AIRLINE', 0, 20000, 55, 5000),
	(13, 'udara0008', 'udara0008', 'LION', 0, 30000, 55, 5000),
	(14, 'udara0009', 'udara0009', 'LION', 0, 20000, 55, 5000),
	(15, 'udara0010', 'udara0010', 'LION', 0, 20000, 55, 5000),
	(16, 'udara00009999', 'kediri', 'asdaas', 3, 23000, 12, 2000);
/*!40000 ALTER TABLE `tarif_udara` ENABLE KEYS */;

-- membuang struktur untuk table kargo.vendor
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

-- Membuang data untuk tabel kargo.vendor: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT IGNORE INTO `vendor` (`id`, `idvendor`, `vendor`, `telp`, `alamat`, `cabang`) VALUES
	(3, 'vendor001', 'PT tani mundur jaya', '085552344556', 'Jln saguling no 1 malang', 'Y'),
	(4, 'vendor002', 'PT Iwak Enak', '083223336313', 'mungkung loceret nganjuk', 'N'),
	(5, 'vendor003', 'PT Moro Dadi', '082122272212', 'Jln badut ulang tahun no 3 magelang', 'N');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

-- membuang struktur untuk trigger kargo.editadmin
DROP TRIGGER IF EXISTS `editadmin`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `editadmin` BEFORE UPDATE ON `admin` FOR EACH ROW BEGIN
update resi_pengiriman set admin=new.username where admin=old.username;
update surat_jalan set admin=new.username where admin=old.username;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger kargo.editvendor
DROP TRIGGER IF EXISTS `editvendor`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `editvendor` BEFORE UPDATE ON `vendor` FOR EACH ROW BEGIN
update surat_jalan set tujuan=concat(new.vendor,'-',new.telp) where tujuan=concat(old.vendor,'-',old.telp);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger kargo.hapus_suratjalan
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
