-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2019 at 10:13 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_prediksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ahp`
--

CREATE TABLE `ahp` (
  `id` int(11) NOT NULL,
  `nama_ahp` varchar(20) NOT NULL,
  `kriteria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ahp`
--

INSERT INTO `ahp` (`id`, `nama_ahp`, `kriteria`) VALUES
(9, 'FAKTOR', '[\"Bahan Baku\",\"Teknologi\",\"Pasar\",\"Modal\",\"Sarana Prasarana\",\"SDM\"]');

-- --------------------------------------------------------

--
-- Table structure for table `ahp_respon`
--

CREATE TABLE `ahp_respon` (
  `id` int(11) NOT NULL,
  `ahp_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `respon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ahp_respon`
--

INSERT INTO `ahp_respon` (`id`, `ahp_id`, `nama`, `respon`) VALUES
(29, 9, 'Ir. Sapoan, M.Si', '[[\"1\",\"0.125\",\"0.14285714285714\",\"0.125\",\"0.16666666666667\",\"0.14285714285714\"],[\"8\",\"1\",\"5\",\"6\",\"5\",\"7\"],[\"7\",\"0.2\",\"1\",\"5\",\"0.2\",\"7\"],[\"8\",\"0.16666666666666666\",\"0.2\",\"1\",\"6\",\"7\"],[\"6\",\"0.2\",\"5\",\"0.16666666666666666\",\"1\",\"3\"],[\"7\",\"0.14285714285714285\",\"0.14285714285714285\",\"0.14285714285714285\",\"0.3333333333333333\",\"1\"]]'),
(30, 9, 'Ir. Muhammad Ali, M.Si', '[[\"1\",\"0.14285714285714\",\"0.2\",\"0.14285714285714\",\"0.2\",\"0.2\"],[\"7\",\"1\",\"8\",\"7\",\"9\",\"7\"],[\"5\",\"0.125\",\"1\",\"0.14285714285714\",\"0.33333333333333\",\"0.33333333333333\"],[\"7\",\"0.14285714285714285\",\"7\",\"1\",\"0.14285714285714\",\"0.33333333333333\"],[\"5\",\"0.1111111111111111\",\"3\",\"7\",\"1\",\"0.2\"],[\"5\",\"0.14285714285714285\",\"3\",\"3\",\"5\",\"1\"]]'),
(31, 9, 'Asdar, S.Pi', '[[\"1\",\"7\",\"9\",\"5\",\"7\",\"9\"],[\"0.14285714285714285\",\"1\",\"5\",\"5\",\"3\",\"7\"],[\"0.1111111111111111\",\"0.2\",\"1\",\"0.33333333333333\",\"0.33333333333333\",\"5\"],[\"0.2\",\"0.2\",\"3\",\"1\",\"3\",\"3\"],[\"0.14285714285714285\",\"0.3333333333333333\",\"3\",\"0.3333333333333333\",\"1\",\"3\"],[\"0.1111111111111111\",\"0.14285714285714285\",\"0.2\",\"0.3333333333333333\",\"0.3333333333333333\",\"1\"]]'),
(32, 9, 'Guntur', '[[\"1\",\"9\",\"9\",\"9\",\"9\",\"9\"],[\"0.1111111111111111\",\"1\",\"1\",\"0.11111111111111\",\"0.33333333333333\",\"5\"],[\"0.1111111111111111\",\"1\",\"1\",\"0.11111111111111\",\"0.2\",\"3\"],[\"0.1111111111111111\",\"9\",\"9\",\"1\",\"5\",\"5\"],[\"0.1111111111111111\",\"3\",\"5\",\"0.2\",\"1\",\"7\"],[\"0.1111111111111111\",\"0.2\",\"0.3333333333333333\",\"0.2\",\"0.14285714285714285\",\"1\"]]'),
(33, 9, 'Dr. Ine Fausayana', '[[\"1\",\"7\",\"7\",\"7\",\"7\",\"9\"],[\"0.14285714285714285\",\"1\",\"7\",\"7\",\"5\",\"9\"],[\"0.14285714285714285\",\"0.14285714285714285\",\"1\",\"0.33333333333333\",\"3\",\"5\"],[\"0.14285714285714285\",\"0.14285714285714285\",\"3\",\"1\",\"5\",\"5\"],[\"0.14285714285714285\",\"0.2\",\"0.3333333333333333\",\"0.2\",\"1\",\"5\"],[\"0.1111111111111111\",\"0.1111111111111111\",\"0.2\",\"0.2\",\"0.2\",\"1\"]]'),
(34, 9, 'Eddy Hamka, S.Pi.,M.Si', '[[\"1\",\"5\",\"0.14285714285714\",\"3\",\"5\",\"0.33333333333333\"],[\"0.2\",\"1\",\"0.2\",\"2\",\"2\",\"1\"],[\"7\",\"5\",\"1\",\"5\",\"5\",\"5\"],[\"0.3333333333333333\",\"0.5\",\"0.2\",\"1\",\"0.33333333333333\",\"0.33333333333333\"],[\"0.2\",\"0.5\",\"0.2\",\"3\",\"1\",\"0.33333333333333\"],[\"3\",\"1\",\"0.2\",\"3\",\"3\",\"1\"]]'),
(35, 9, 'Parhan, S.Pi.,M.Si', '[[\"1\",\"9\",\"9\",\"9\",\"5\",\"7\"],[\"0.1111111111111111\",\"1\",\"0.14285714285714\",\"9\",\"0.14285714285714\",\"0.2\"],[\"0.1111111111111111\",\"7\",\"1\",\"9\",\"9\",\"9\"],[\"0.1111111111111111\",\"0.1111111111111111\",\"0.1111111111111111\",\"1\",\"9\",\"9\"],[\"0.2\",\"7\",\"0.1111111111111111\",\"0.1111111111111111\",\"1\",\"9\"],[\"0.14285714285714285\",\"5\",\"0.1111111111111111\",\"0.1111111111111111\",\"0.1111111111111111\",\"1\"]]'),
(36, 9, 'Nasrawati, S.Pi.,M.Si', '[[\"1\",\"1\",\"9\",\"3\",\"3\",\"9\"],[\"1\",\"1\",\"3\",\"1\",\"3\",\"9\"],[\"0.1111111111111111\",\"0.3333333333333333\",\"1\",\"9\",\"9\",\"3\"],[\"0.3333333333333333\",\"1\",\"0.1111111111111111\",\"1\",\"7\",\"3\"],[\"0.3333333333333333\",\"0.3333333333333333\",\"0.1111111111111111\",\"0.14285714285714285\",\"1\",\"9\"],[\"0.1111111111111111\",\"0.1111111111111111\",\"0.3333333333333333\",\"0.3333333333333333\",\"0.1111111111111111\",\"1\"]]'),
(37, 9, 'Andi Arif', '[[\"1\",\"1\",\"7\",\"9\",\"1\",\"3\"],[\"1\",\"1\",\"3\",\"3\",\"5\",\"7\"],[\"0.14285714285714285\",\"0.3333333333333333\",\"1\",\"9\",\"1\",\"3\"],[\"0.1111111111111111\",\"0.3333333333333333\",\"0.1111111111111111\",\"1\",\"9\",\"9\"],[\"1\",\"0.2\",\"1\",\"0.1111111111111111\",\"1\",\"9\"],[\"0.3333333333333333\",\"0.14285714285714285\",\"0.3333333333333333\",\"0.1111111111111111\",\"0.1111111111111111\",\"1\"]]'),
(38, 9, 'Dr. Aziz Muthalib', '[[\"1\",\"7\",\"9\",\"5\",\"7\",\"9\"],[\"0.14285714285714285\",\"1\",\"5\",\"5\",\"3\",\"7\"],[\"0.1111111111111111\",\"0.2\",\"1\",\"0.33333333333333\",\"0.33333333333333\",\"5\"],[\"0.2\",\"0.2\",\"3\",\"1\",\"3\",\"3\"],[\"0.14285714285714285\",\"0.3333333333333333\",\"3\",\"0.3333333333333333\",\"1\",\"3\"],[\"0.1111111111111111\",\"0.14285714285714285\",\"0.2\",\"0.3333333333333333\",\"0.3333333333333333\",\"1\"]]');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_penyedia`
--

CREATE TABLE `bahan_penyedia` (
  `bahan_penyedia_id` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `bahan_penyedia_nama` varchar(50) NOT NULL,
  `bahan_penyedia_produksi` double NOT NULL COMMENT 'harian',
  `bahan_penyedia_produksi_keinginan` double NOT NULL COMMENT 'harian',
  `bahan_penyedia_randemen` double NOT NULL COMMENT '%',
  `bahan_penyedia_konversi` double NOT NULL COMMENT 'kg basah /1 kg kering',
  `bahan_penyedia_produktifitas` double NOT NULL,
  `bahan_penyedia_panen` double NOT NULL COMMENT 'per Tahun'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_penyedia`
--

INSERT INTO `bahan_penyedia` (`bahan_penyedia_id`, `jenis`, `bahan_penyedia_nama`, `bahan_penyedia_produksi`, `bahan_penyedia_produksi_keinginan`, `bahan_penyedia_randemen`, `bahan_penyedia_konversi`, `bahan_penyedia_produktifitas`, `bahan_penyedia_panen`) VALUES
(1, 0, 'Bahan Baku Rumput Laut', 2000, 500, 31, 8, 8720, 4),
(2, 0, 'tes', 200, 500, 25, 8, 18000, 4),
(3, 0, 'rumput laut kering', 100, 100, 31, 8, 8000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ekonomi`
--

CREATE TABLE `ekonomi` (
  `ekonomi_id` int(11) NOT NULL,
  `ekonomi_aspek` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekonomi`
--

INSERT INTO `ekonomi` (`ekonomi_id`, `ekonomi_aspek`) VALUES
(1, 'Manfaat langsung (direct benefit)'),
(2, 'Manfaat tidak langsung (indirect benefit)');

-- --------------------------------------------------------

--
-- Table structure for table `ekonomi_kriteria`
--

CREATE TABLE `ekonomi_kriteria` (
  `ekonomi_kriteria_id` int(11) NOT NULL,
  `ekonomi_id` int(11) NOT NULL,
  `ekonomi_kriteria_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekonomi_kriteria`
--

INSERT INTO `ekonomi_kriteria` (`ekonomi_kriteria_id`, `ekonomi_id`, `ekonomi_kriteria_nama`) VALUES
(1, 1, 'Kenaikan nilai hasil produksi rumput laut'),
(2, 1, 'Meningkatnya mutu produksi rumput laut'),
(3, 1, 'Berkurangnya biaya pemasaran rumput laut'),
(4, 1, 'Meningkatnya kapasitas produksi budidaya'),
(5, 1, 'Terjadinya penyerapan tenaga kerja lokal'),
(6, 1, 'Meningkatnya Pendapatan/keuntungan agroindustri'),
(7, 1, 'Meningkatnya pendapatan pelaku agroindustri'),
(8, 2, 'Tumbuhnya industri-industri lain'),
(9, 2, 'Bertambahnya nilai produksi industri-industri lain'),
(10, 2, 'Meningkatnya nilai  guna lahan di kawasan \r\n'),
(11, 2, 'Meningkatnya pemanfaatan produk ikutan'),
(12, 2, 'Meningkatnya motivasi berwirausaha'),
(13, 2, 'Meningkatnya inovasi teknologi'),
(14, 2, 'Menjadi tempat studi dan rujukan pengembangan agroindustri');

-- --------------------------------------------------------

--
-- Table structure for table `ekonomi_kriteria_respon`
--

CREATE TABLE `ekonomi_kriteria_respon` (
  `ekonomi_kriteria_respon_id` int(11) NOT NULL,
  `ekonomi_kriteria_id` int(11) NOT NULL,
  `ekonomi_respon_id` int(11) NOT NULL,
  `ekonomi_kriteria_respon_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekonomi_kriteria_respon`
--

INSERT INTO `ekonomi_kriteria_respon` (`ekonomi_kriteria_respon_id`, `ekonomi_kriteria_id`, `ekonomi_respon_id`, `ekonomi_kriteria_respon_nilai`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 3),
(3, 3, 1, 1),
(4, 4, 1, 5),
(5, 5, 1, 2),
(7, 1, 2, 1),
(8, 2, 2, 3),
(9, 3, 2, 2),
(10, 4, 2, 5),
(11, 5, 2, 5),
(12, 1, 3, 1),
(13, 2, 3, 3),
(14, 3, 3, 2),
(15, 4, 3, 5),
(16, 5, 3, 5),
(17, 1, 4, 1),
(18, 2, 4, 3),
(19, 3, 4, 2),
(20, 4, 4, 5),
(21, 5, 4, 5),
(22, 1, 5, 1),
(23, 2, 5, 3),
(24, 3, 5, 2),
(25, 4, 5, 5),
(26, 5, 5, 5),
(27, 1, 6, 1),
(28, 2, 6, 3),
(29, 3, 6, 2),
(30, 4, 6, 5),
(31, 5, 6, 5),
(32, 1, 7, 1),
(33, 2, 7, 3),
(34, 3, 7, 2),
(35, 4, 7, 5),
(36, 5, 7, 5),
(37, 1, 8, 1),
(38, 2, 8, 3),
(39, 3, 8, 2),
(40, 4, 8, 5),
(41, 5, 8, 5),
(42, 1, 9, 1),
(43, 2, 9, 3),
(44, 3, 9, 2),
(45, 4, 9, 5),
(46, 5, 9, 5),
(47, 1, 10, 1),
(48, 2, 10, 3),
(49, 3, 10, 2),
(50, 4, 10, 5),
(51, 5, 10, 5),
(52, 6, 1, 4),
(53, 7, 1, 1),
(54, 6, 2, 4),
(55, 7, 2, 1),
(56, 6, 3, 4),
(57, 7, 3, 1),
(58, 6, 4, 4),
(59, 7, 4, 1),
(60, 6, 5, 4),
(61, 7, 5, 1),
(62, 6, 6, 4),
(63, 7, 6, 1),
(64, 6, 7, 4),
(65, 7, 7, 1),
(66, 6, 8, 4),
(67, 7, 8, 1),
(68, 6, 9, 4),
(69, 7, 9, 1),
(70, 6, 10, 4),
(71, 7, 10, 1),
(72, 8, 11, 3),
(73, 8, 12, 3),
(74, 9, 11, 2),
(75, 9, 12, 4),
(80, 10, 11, 2),
(81, 10, 12, 4),
(82, 11, 11, 4),
(83, 11, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ekonomi_respon`
--

CREATE TABLE `ekonomi_respon` (
  `ekonomi_respon_id` int(11) NOT NULL,
  `ekonomi_id` int(11) NOT NULL,
  `ekonomi_respon_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekonomi_respon`
--

INSERT INTO `ekonomi_respon` (`ekonomi_respon_id`, `ekonomi_id`, `ekonomi_respon_nama`) VALUES
(1, 1, 'respon 1'),
(2, 1, 'respon 2'),
(3, 1, 'respon 3'),
(4, 1, 'respon 4'),
(5, 1, 'respon 5'),
(6, 1, 'respon 6'),
(7, 1, 'respon 7'),
(8, 1, 'respon 8'),
(9, 1, 'respon 9'),
(10, 1, 'respon 10'),
(11, 2, 'respon 1'),
(12, 2, 'respon 2');

-- --------------------------------------------------------

--
-- Table structure for table `finansial`
--

CREATE TABLE `finansial` (
  `finansial_id` int(11) NOT NULL,
  `finansial_nama` varchar(50) NOT NULL,
  `finansial_waktu` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finansial`
--

INSERT INTO `finansial` (`finansial_id`, `finansial_nama`, `finansial_waktu`) VALUES
(1, 'finansial 1', 10),
(5, 'agroindustri rl', 10);

-- --------------------------------------------------------

--
-- Table structure for table `finansial_bahan`
--

CREATE TABLE `finansial_bahan` (
  `finansial_bahan_id` int(11) NOT NULL,
  `finansial_kategori_id` int(11) NOT NULL,
  `finansial_bahan_nama` varchar(100) NOT NULL,
  `finansial_bahan_harga` double NOT NULL,
  `finansial_bahan_umur` double NOT NULL COMMENT 'tahunan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `finansial_barang`
--

CREATE TABLE `finansial_barang` (
  `finansial_barang_id` int(11) NOT NULL,
  `finansial_id` int(11) NOT NULL,
  `finansial_kategori_id` int(11) NOT NULL,
  `finansial_barang_nama` varchar(100) NOT NULL,
  `finansial_barang_harga` double NOT NULL,
  `finansial_barang_umur` double NOT NULL,
  `finansial_barang_volume` double NOT NULL,
  `satuan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finansial_barang`
--

INSERT INTO `finansial_barang` (`finansial_barang_id`, `finansial_id`, `finansial_kategori_id`, `finansial_barang_nama`, `finansial_barang_harga`, `finansial_barang_umur`, `finansial_barang_volume`, `satuan_id`) VALUES
(5, 1, 1, 'Pembuatan Rumah', 5000000000, 15, 3, 1),
(6, 1, 2, 'Pembangunan Jalan', 2323, 22, 22, 8),
(7, 1, 3, 'Pembangunan Jalan', 2323, 22, 22, 9),
(8, 1, 4, 'Rumput Laut', 2323, 0, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `finansial_kategori`
--

CREATE TABLE `finansial_kategori` (
  `finansial_kategori_id` int(11) NOT NULL,
  `finansial_kategori_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finansial_kategori`
--

INSERT INTO `finansial_kategori` (`finansial_kategori_id`, `finansial_kategori_nama`) VALUES
(1, 'Biaya Investasi'),
(2, 'Biaya Operasional (Biaya Tetap)'),
(3, 'Biaya Operasional (Biaya Variabel)'),
(4, 'Biaya Operasional (Biaya Variabel) Bahan Baku');

-- --------------------------------------------------------

--
-- Table structure for table `finansial_penerimaan`
--

CREATE TABLE `finansial_penerimaan` (
  `finansial_penerimaan_id` int(11) NOT NULL,
  `finansial_id` int(11) NOT NULL,
  `finansial_penerimaan_produk` double NOT NULL COMMENT 'harian',
  `finansial_penerimaan_harga` double NOT NULL COMMENT 'harian'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finansial_penerimaan`
--

INSERT INTO `finansial_penerimaan` (`finansial_penerimaan_id`, `finansial_id`, `finansial_penerimaan_produk`, `finansial_penerimaan_harga`) VALUES
(1, 1, 600, 110000),
(5, 5, 600, 110000);

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_air`
--

CREATE TABLE `kebutuhan_air` (
  `kebutuhan_air_id` int(11) NOT NULL,
  `finansial_id` int(11) NOT NULL,
  `kebutuhan_air_jp` double NOT NULL COMMENT 'Jumlah proses per hari (proses)',
  `kebutuhan_air_jdu` double NOT NULL COMMENT 'Jumlah daur ulang air (kali)',
  `kebutuhan_air_jdhu` double NOT NULL COMMENT 'Jumlah hari ulang (hari)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kebutuhan_air`
--

INSERT INTO `kebutuhan_air` (`kebutuhan_air_id`, `finansial_id`, `kebutuhan_air_jp`, `kebutuhan_air_jdu`, `kebutuhan_air_jdhu`) VALUES
(1, 1, 2, 6, 3),
(2, 5, 2, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mpe`
--

CREATE TABLE `mpe` (
  `mpe_id` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah_respon` int(11) NOT NULL,
  `kriteria_respon_json` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpe`
--

INSERT INTO `mpe` (`mpe_id`, `menu`, `nama`, `jumlah_respon`, `kriteria_respon_json`, `waktu`) VALUES
(1, 0, 'coba', 10, '', '2019-05-04 20:22:41'),
(3, 0, 'USAHA', 0, '', '2019-05-06 02:21:10'),
(7, 0, 'USAHA', 0, '', '2019-05-06 13:08:47'),
(8, 0, 'tes', 0, '', '2019-05-29 13:51:09'),
(9, 1, 'Pembangunan Jalan', 0, '', '2019-06-03 13:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `mpe_kriteria`
--

CREATE TABLE `mpe_kriteria` (
  `mpe_kriteria_id` int(11) NOT NULL,
  `mpe_id` int(11) NOT NULL,
  `kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpe_kriteria`
--

INSERT INTO `mpe_kriteria` (`mpe_kriteria_id`, `mpe_id`, `kriteria`) VALUES
(1, 1, 'kriteria1'),
(2, 1, 'kriteria2'),
(3, 1, 'kriteria3'),
(6, 3, 'Ketersediaan Bahan Baku (KBB)'),
(7, 3, 'Potensi Pasar (PP)'),
(8, 3, 'Ketersediaan Tenaga Kerja (KTK)'),
(9, 3, 'Ketersediaan Infrastruktur (KI) (Jalan, Listrik, Pelabuhan dll)'),
(10, 3, 'Ketersediaan Air Tawar'),
(11, 3, 'Dukungan Masyarakat Setempat (DMS)'),
(12, 3, 'Aksesibilitas ke Pusat Pertumbuhan Ekonomi (APPE)'),
(13, 3, 'Ketersediaan Lahan (KL)'),
(14, 3, 'Jarak ke Pelabuhan  (JP)'),
(20, 7, 'kriteria 1'),
(21, 7, 'kriteria 2'),
(22, 7, 'kriteria 3'),
(23, 8, 'kriteria 1'),
(24, 8, 'kriteria 2'),
(25, 9, 'kriteria 1'),
(26, 9, 'kriteria 2');

-- --------------------------------------------------------

--
-- Table structure for table `mpe_respon`
--

CREATE TABLE `mpe_respon` (
  `mpe_respon_id` int(11) NOT NULL,
  `mpe_id` int(11) NOT NULL,
  `respon_nama` varchar(50) NOT NULL,
  `wilayah_kriteria_json` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpe_respon`
--

INSERT INTO `mpe_respon` (`mpe_respon_id`, `mpe_id`, `respon_nama`, `wilayah_kriteria_json`) VALUES
(1, 1, 'respon1', ''),
(2, 1, 'respon2', ''),
(3, 1, 'respon3', ''),
(4, 1, 'respon4', ''),
(5, 1, 'respon5', ''),
(6, 1, 'respon6', ''),
(7, 1, 'respon7', ''),
(8, 1, 'respon8', ''),
(9, 1, 'respon9', ''),
(10, 1, 'respon10', ''),
(13, 1, 'Respon11', ''),
(14, 1, 'respon12', ''),
(17, 3, 'Ir. Sapoan, M.Si', ''),
(25, 7, 'respon 1', ''),
(26, 7, 'respon 2', ''),
(27, 9, 'Pembangunan Jalan', '');

-- --------------------------------------------------------

--
-- Table structure for table `mpe_respon_kriteria`
--

CREATE TABLE `mpe_respon_kriteria` (
  `mpe_respon_kriteria_id` int(11) NOT NULL,
  `mpe_respon_id` int(11) NOT NULL,
  `mpe_kriteria_id` int(11) NOT NULL,
  `mpe_respon_kriteria_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpe_respon_kriteria`
--

INSERT INTO `mpe_respon_kriteria` (`mpe_respon_kriteria_id`, `mpe_respon_id`, `mpe_kriteria_id`, `mpe_respon_kriteria_nilai`) VALUES
(1, 1, 1, 3),
(2, 2, 1, 3),
(3, 3, 1, 2),
(4, 4, 1, 3),
(5, 5, 1, 3),
(6, 6, 1, 3),
(7, 7, 1, 3),
(8, 8, 1, 3),
(9, 9, 1, 3),
(10, 10, 1, 3),
(11, 1, 2, 3),
(12, 2, 2, 3),
(13, 3, 2, 3),
(14, 4, 2, 3),
(15, 5, 2, 3),
(16, 6, 2, 3),
(17, 7, 2, 2),
(18, 8, 2, 3),
(19, 9, 2, 1),
(21, 1, 3, 3),
(22, 2, 3, 3),
(23, 3, 3, 1),
(24, 4, 3, 3),
(25, 5, 3, 3),
(26, 6, 3, 3),
(27, 7, 3, 3),
(28, 8, 3, 3),
(29, 9, 3, 3),
(30, 10, 3, 3),
(34, 13, 1, 2),
(35, 13, 2, 1),
(36, 13, 3, 2),
(37, 14, 1, 1),
(38, 14, 2, 2),
(39, 14, 3, 3),
(44, 17, 6, 2),
(45, 17, 7, 8),
(46, 17, 8, 7),
(47, 17, 9, 3),
(48, 17, 10, 1),
(49, 17, 11, 6),
(50, 17, 12, 9),
(51, 17, 13, 4),
(52, 17, 14, 5),
(65, 25, 20, 1),
(66, 25, 21, 2),
(67, 25, 22, 2),
(68, 26, 20, 2),
(69, 26, 21, 1),
(70, 26, 22, 3),
(71, 27, 25, 2),
(72, 27, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mpe_wilayah`
--

CREATE TABLE `mpe_wilayah` (
  `mpe_wilayah_id` int(11) NOT NULL,
  `mpe_id` int(11) NOT NULL,
  `wilayah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpe_wilayah`
--

INSERT INTO `mpe_wilayah` (`mpe_wilayah_id`, `mpe_id`, `wilayah`) VALUES
(1, 1, 'wilayah1'),
(3, 1, 'wilayah2'),
(4, 1, 'wilayah3'),
(5, 1, 'wilayah4'),
(9, 3, 'Kota Kendari'),
(10, 3, 'Kota Bau-Bau'),
(11, 3, 'Kab. Kolaka'),
(12, 3, 'Kab. Konawe'),
(13, 3, 'Kab. Konsel'),
(14, 3, 'Kab. Muna'),
(15, 3, 'Kab. Kolaka Utara'),
(16, 3, 'Kab. Buton'),
(17, 3, 'Kab. Konawe Utara'),
(18, 3, 'Kab. Konawe Kep.'),
(19, 3, 'Kab. Bombana'),
(20, 3, 'Kab. Kolaka Timur'),
(21, 3, 'Kab. Muna Barat'),
(22, 3, 'Kab. Buton Tengah'),
(23, 3, 'Kab. Buton Selatan'),
(24, 3, 'Kab. Buton Utara'),
(25, 3, 'Kab. Kakatobi'),
(31, 7, 'wilayah 1'),
(32, 7, 'wilayah 2'),
(33, 7, 'wilayah 3'),
(34, 7, 'wilayah 4'),
(35, 8, 'alternatif 1'),
(36, 8, 'alternatif 2'),
(37, 9, 'alternatif 1'),
(38, 9, 'alternatif 2');

-- --------------------------------------------------------

--
-- Table structure for table `mpe_wilayah_kriteria`
--

CREATE TABLE `mpe_wilayah_kriteria` (
  `mpe_wilayah_kriteria_id` int(11) NOT NULL,
  `mpe_respon_id` int(11) NOT NULL,
  `mpe_wilayah_id` int(11) NOT NULL,
  `mpe_kriteria_id` int(11) NOT NULL,
  `mpe_wilayah_kriteria_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpe_wilayah_kriteria`
--

INSERT INTO `mpe_wilayah_kriteria` (`mpe_wilayah_kriteria_id`, `mpe_respon_id`, `mpe_wilayah_id`, `mpe_kriteria_id`, `mpe_wilayah_kriteria_nilai`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 1, 2, 1),
(3, 1, 1, 3, 2),
(4, 1, 3, 1, 2),
(5, 1, 3, 2, 5),
(6, 1, 3, 3, 4),
(7, 1, 4, 1, 5),
(8, 1, 4, 2, 5),
(9, 1, 4, 3, 4),
(10, 1, 5, 1, 3),
(11, 1, 5, 2, 2),
(12, 1, 5, 3, 2),
(13, 2, 1, 1, 4),
(14, 2, 1, 2, 2),
(15, 2, 1, 3, 3),
(16, 2, 3, 1, 4),
(17, 2, 3, 2, 3),
(18, 2, 3, 3, 5),
(19, 2, 4, 1, 3),
(20, 2, 4, 2, 2),
(21, 2, 4, 3, 1),
(22, 2, 5, 1, 5),
(23, 2, 5, 2, 5),
(24, 2, 5, 3, 3),
(25, 3, 1, 1, 5),
(26, 3, 1, 2, 4),
(27, 3, 1, 3, 1),
(28, 3, 3, 1, 4),
(29, 3, 3, 2, 5),
(30, 3, 3, 3, 4),
(31, 3, 4, 1, 5),
(32, 3, 4, 2, 4),
(33, 3, 4, 3, 3),
(34, 3, 5, 1, 1),
(35, 3, 5, 2, 2),
(36, 3, 5, 3, 5),
(37, 4, 1, 1, 4),
(38, 4, 1, 2, 2),
(39, 4, 1, 3, 1),
(40, 4, 3, 1, 5),
(41, 4, 3, 2, 1),
(42, 4, 3, 3, 3),
(43, 4, 4, 1, 3),
(44, 4, 4, 2, 4),
(45, 4, 4, 3, 3),
(46, 4, 5, 1, 2),
(47, 4, 5, 2, 2),
(48, 4, 5, 3, 2),
(49, 5, 1, 1, 3),
(50, 5, 1, 2, 5),
(51, 5, 1, 3, 4),
(52, 5, 3, 1, 4),
(53, 5, 3, 2, 5),
(54, 5, 3, 3, 4),
(55, 5, 4, 1, 3),
(56, 5, 4, 2, 2),
(57, 5, 4, 3, 2),
(58, 5, 5, 1, 5),
(59, 5, 5, 2, 4),
(60, 5, 5, 3, 5),
(61, 6, 1, 1, 4),
(62, 6, 1, 2, 5),
(63, 6, 1, 3, 1),
(64, 6, 3, 1, 4),
(65, 6, 3, 2, 2),
(66, 6, 3, 3, 2),
(67, 6, 4, 1, 1),
(68, 6, 4, 2, 5),
(69, 6, 4, 3, 3),
(70, 6, 5, 1, 1),
(71, 6, 5, 2, 1),
(72, 6, 5, 3, 3),
(73, 7, 1, 1, 3),
(74, 7, 1, 2, 4),
(75, 7, 1, 3, 3),
(76, 7, 3, 1, 3),
(77, 7, 3, 2, 1),
(78, 7, 3, 3, 4),
(79, 7, 4, 1, 1),
(80, 7, 4, 2, 1),
(81, 7, 4, 3, 2),
(82, 7, 5, 1, 2),
(83, 7, 5, 2, 1),
(84, 7, 5, 3, 2),
(85, 8, 1, 1, 3),
(86, 8, 1, 2, 4),
(87, 8, 1, 3, 5),
(88, 8, 3, 1, 3),
(89, 8, 3, 2, 3),
(90, 8, 3, 3, 2),
(91, 8, 4, 1, 1),
(92, 8, 4, 2, 2),
(93, 8, 4, 3, 2),
(94, 8, 5, 1, 4),
(95, 8, 5, 2, 2),
(96, 8, 5, 3, 2),
(97, 9, 1, 1, 1),
(98, 9, 1, 2, 5),
(99, 9, 1, 3, 4),
(100, 9, 3, 1, 1),
(101, 9, 3, 2, 1),
(102, 9, 3, 3, 2),
(103, 9, 4, 1, 1),
(104, 9, 4, 2, 2),
(105, 9, 4, 3, 4),
(106, 9, 5, 1, 3),
(107, 9, 5, 2, 3),
(108, 9, 5, 3, 4),
(109, 10, 1, 1, 4),
(110, 10, 1, 2, 4),
(111, 10, 1, 3, 4),
(112, 10, 3, 1, 2),
(113, 10, 3, 2, 5),
(114, 10, 3, 3, 1),
(115, 10, 4, 1, 1),
(116, 10, 4, 2, 2),
(117, 10, 4, 3, 1),
(118, 10, 5, 1, 1),
(119, 10, 5, 2, 2),
(120, 10, 5, 3, 1),
(121, 13, 1, 1, 3),
(122, 13, 1, 2, 5),
(123, 13, 1, 3, 3),
(124, 13, 3, 1, 2),
(125, 13, 3, 2, 3),
(126, 13, 3, 3, 4),
(127, 13, 4, 1, 3),
(128, 13, 4, 2, 3),
(129, 13, 4, 3, 1),
(130, 13, 5, 1, 4),
(131, 13, 5, 2, 4),
(132, 13, 5, 3, 2),
(133, 14, 1, 1, 1),
(134, 14, 1, 2, 2),
(135, 14, 1, 3, 3),
(136, 14, 3, 1, 4),
(137, 14, 3, 2, 5),
(138, 14, 3, 3, 1),
(139, 14, 4, 1, 2),
(140, 14, 4, 2, 3),
(141, 14, 4, 3, 4),
(142, 14, 5, 1, 5),
(143, 14, 5, 2, 1),
(144, 14, 5, 3, 2),
(157, 17, 9, 6, 1),
(158, 17, 9, 7, 5),
(159, 17, 9, 8, 4),
(160, 17, 9, 9, 5),
(161, 17, 9, 10, 4),
(162, 17, 9, 11, 4),
(163, 17, 9, 12, 5),
(164, 17, 9, 13, 3),
(165, 17, 9, 14, 4),
(166, 17, 10, 6, 3),
(167, 17, 10, 7, 5),
(168, 17, 10, 8, 4),
(169, 17, 10, 9, 5),
(170, 17, 10, 10, 4),
(171, 17, 10, 11, 4),
(172, 17, 10, 12, 5),
(173, 17, 10, 13, 4),
(174, 17, 10, 14, 4),
(175, 17, 11, 6, 3),
(176, 17, 11, 7, 5),
(177, 17, 11, 8, 4),
(178, 17, 11, 9, 5),
(179, 17, 11, 10, 4),
(180, 17, 11, 11, 4),
(181, 17, 11, 12, 5),
(182, 17, 11, 13, 4),
(183, 17, 11, 14, 4),
(184, 17, 12, 6, 1),
(185, 17, 12, 7, 5),
(186, 17, 12, 8, 4),
(187, 17, 12, 9, 1),
(188, 17, 12, 10, 5),
(189, 17, 12, 11, 4),
(190, 17, 12, 12, 4),
(191, 17, 12, 13, 4),
(192, 17, 12, 14, 1),
(193, 17, 13, 6, 4),
(194, 17, 13, 7, 5),
(195, 17, 13, 8, 4),
(196, 17, 13, 9, 4),
(197, 17, 13, 10, 5),
(198, 17, 13, 11, 4),
(199, 17, 13, 12, 4),
(200, 17, 13, 13, 4),
(201, 17, 13, 14, 4),
(202, 17, 14, 6, 5),
(203, 17, 14, 7, 5),
(204, 17, 14, 8, 4),
(205, 17, 14, 9, 3),
(206, 17, 14, 10, 1),
(207, 17, 14, 11, 4),
(208, 17, 14, 12, 4),
(209, 17, 14, 13, 4),
(210, 17, 14, 14, 4),
(211, 17, 15, 6, 3),
(212, 17, 15, 7, 5),
(213, 17, 15, 8, 4),
(214, 17, 15, 9, 4),
(215, 17, 15, 10, 1),
(216, 17, 15, 11, 4),
(217, 17, 15, 12, 4),
(218, 17, 15, 13, 4),
(219, 17, 15, 14, 4),
(220, 17, 16, 6, 4),
(221, 17, 16, 7, 5),
(222, 17, 16, 8, 4),
(223, 17, 16, 9, 4),
(224, 17, 16, 10, 5),
(225, 17, 16, 11, 4),
(226, 17, 16, 12, 4),
(227, 17, 16, 13, 4),
(228, 17, 16, 14, 4),
(229, 17, 17, 6, 3),
(230, 17, 17, 7, 5),
(231, 17, 17, 8, 4),
(232, 17, 17, 9, 2),
(233, 17, 17, 10, 5),
(234, 17, 17, 11, 4),
(235, 17, 17, 12, 3),
(236, 17, 17, 13, 4),
(237, 17, 17, 14, 4),
(238, 17, 18, 6, 1),
(239, 17, 18, 7, 5),
(240, 17, 18, 8, 4),
(241, 17, 18, 9, 2),
(242, 17, 18, 10, 2),
(243, 17, 18, 11, 4),
(244, 17, 18, 12, 3),
(245, 17, 18, 13, 4),
(246, 17, 18, 14, 4),
(247, 17, 19, 6, 4),
(248, 17, 19, 7, 5),
(249, 17, 19, 8, 4),
(250, 17, 19, 9, 4),
(251, 17, 19, 10, 5),
(252, 17, 19, 11, 4),
(253, 17, 19, 12, 4),
(254, 17, 19, 13, 4),
(255, 17, 19, 14, 4),
(256, 17, 20, 6, 1),
(257, 17, 20, 7, 5),
(258, 17, 20, 8, 4),
(259, 17, 20, 9, 3),
(260, 17, 20, 10, 5),
(261, 17, 20, 11, 4),
(262, 17, 20, 12, 4),
(263, 17, 20, 13, 4),
(264, 17, 20, 14, 1),
(265, 17, 21, 6, 2),
(266, 17, 21, 7, 5),
(267, 17, 21, 8, 4),
(268, 17, 21, 9, 2),
(269, 17, 21, 10, 2),
(270, 17, 21, 11, 4),
(271, 17, 21, 12, 3),
(272, 17, 21, 13, 4),
(273, 17, 21, 14, 4),
(274, 17, 22, 6, 2),
(275, 17, 22, 7, 5),
(276, 17, 22, 8, 4),
(277, 17, 22, 9, 4),
(278, 17, 22, 10, 2),
(279, 17, 22, 11, 4),
(280, 17, 22, 12, 3),
(281, 17, 22, 13, 4),
(282, 17, 22, 14, 4),
(283, 17, 23, 6, 2),
(284, 17, 23, 7, 5),
(285, 17, 23, 8, 4),
(286, 17, 23, 9, 3),
(287, 17, 23, 10, 2),
(288, 17, 23, 11, 4),
(289, 17, 23, 12, 3),
(290, 17, 23, 13, 4),
(291, 17, 23, 14, 4),
(292, 17, 24, 6, 2),
(293, 17, 24, 7, 5),
(294, 17, 24, 8, 4),
(295, 17, 24, 9, 3),
(296, 17, 24, 10, 2),
(297, 17, 24, 11, 4),
(298, 17, 24, 12, 3),
(299, 17, 24, 13, 4),
(300, 17, 24, 14, 4),
(301, 17, 25, 6, 4),
(302, 17, 25, 7, 5),
(303, 17, 25, 8, 4),
(304, 17, 25, 9, 3),
(305, 17, 25, 10, 1),
(306, 17, 25, 11, 4),
(307, 17, 25, 12, 3),
(308, 17, 25, 13, 4),
(309, 17, 25, 14, 4),
(329, 25, 31, 20, 2),
(330, 25, 31, 21, 4),
(331, 25, 31, 22, 3),
(332, 25, 32, 20, 4),
(333, 25, 32, 21, 3),
(334, 25, 32, 22, 3),
(335, 25, 33, 20, 5),
(336, 25, 33, 21, 1),
(337, 25, 33, 22, 3),
(338, 25, 34, 20, 2),
(339, 25, 34, 21, 4),
(340, 25, 34, 22, 3),
(341, 26, 31, 20, 4),
(342, 26, 31, 21, 3),
(343, 26, 31, 22, 2),
(344, 26, 32, 20, 4),
(345, 26, 32, 21, 5),
(346, 26, 32, 22, 1),
(347, 26, 33, 20, 2),
(348, 26, 33, 21, 4),
(349, 26, 33, 22, 3),
(350, 26, 34, 20, 4),
(351, 26, 34, 21, 3),
(352, 26, 34, 22, 1),
(353, 27, 37, 25, 3),
(354, 27, 37, 26, 3),
(355, 27, 38, 25, 4),
(356, 27, 38, 26, 5);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`satuan_id`, `satuan_nama`) VALUES
(1, 'Unit'),
(2, 'Paket'),
(3, 'M2'),
(4, 'M3'),
(5, 'ltr/hari'),
(6, 'LS'),
(7, 'buah'),
(8, 'roll'),
(9, 'Orang'),
(10, 'Kg/Hari');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(3, 'admin', '$2y$10$ilS5xxKgkJ1BnSg8RVNiaOEljgMDKFAlBGHTkfJ4vMhAiFvbQ1wkO', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahp`
--
ALTER TABLE `ahp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ahp_respon`
--
ALTER TABLE `ahp_respon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ahp_id` (`ahp_id`);

--
-- Indexes for table `bahan_penyedia`
--
ALTER TABLE `bahan_penyedia`
  ADD PRIMARY KEY (`bahan_penyedia_id`);

--
-- Indexes for table `ekonomi`
--
ALTER TABLE `ekonomi`
  ADD PRIMARY KEY (`ekonomi_id`);

--
-- Indexes for table `ekonomi_kriteria`
--
ALTER TABLE `ekonomi_kriteria`
  ADD PRIMARY KEY (`ekonomi_kriteria_id`),
  ADD KEY `ekonomi_id` (`ekonomi_id`);

--
-- Indexes for table `ekonomi_kriteria_respon`
--
ALTER TABLE `ekonomi_kriteria_respon`
  ADD PRIMARY KEY (`ekonomi_kriteria_respon_id`),
  ADD UNIQUE KEY `ekonomi_kriteria_id` (`ekonomi_kriteria_id`,`ekonomi_respon_id`),
  ADD KEY `ekonomi_respon_id` (`ekonomi_respon_id`);

--
-- Indexes for table `ekonomi_respon`
--
ALTER TABLE `ekonomi_respon`
  ADD PRIMARY KEY (`ekonomi_respon_id`),
  ADD KEY `ekonomi_id` (`ekonomi_id`);

--
-- Indexes for table `finansial`
--
ALTER TABLE `finansial`
  ADD PRIMARY KEY (`finansial_id`);

--
-- Indexes for table `finansial_bahan`
--
ALTER TABLE `finansial_bahan`
  ADD PRIMARY KEY (`finansial_bahan_id`),
  ADD KEY `finansial_kategori_id_key2` (`finansial_kategori_id`);

--
-- Indexes for table `finansial_barang`
--
ALTER TABLE `finansial_barang`
  ADD PRIMARY KEY (`finansial_barang_id`),
  ADD KEY `finansial_id_key2` (`finansial_id`),
  ADD KEY `satuan_id_fkey` (`satuan_id`),
  ADD KEY `finansial_kategori_id` (`finansial_kategori_id`);

--
-- Indexes for table `finansial_kategori`
--
ALTER TABLE `finansial_kategori`
  ADD PRIMARY KEY (`finansial_kategori_id`);

--
-- Indexes for table `finansial_penerimaan`
--
ALTER TABLE `finansial_penerimaan`
  ADD PRIMARY KEY (`finansial_penerimaan_id`),
  ADD UNIQUE KEY `finansial_id` (`finansial_id`);

--
-- Indexes for table `kebutuhan_air`
--
ALTER TABLE `kebutuhan_air`
  ADD PRIMARY KEY (`kebutuhan_air_id`),
  ADD KEY `finansial_id` (`finansial_id`);

--
-- Indexes for table `mpe`
--
ALTER TABLE `mpe`
  ADD PRIMARY KEY (`mpe_id`);

--
-- Indexes for table `mpe_kriteria`
--
ALTER TABLE `mpe_kriteria`
  ADD PRIMARY KEY (`mpe_kriteria_id`),
  ADD KEY `mpe_id` (`mpe_id`);

--
-- Indexes for table `mpe_respon`
--
ALTER TABLE `mpe_respon`
  ADD PRIMARY KEY (`mpe_respon_id`),
  ADD KEY `mpe_id` (`mpe_id`);

--
-- Indexes for table `mpe_respon_kriteria`
--
ALTER TABLE `mpe_respon_kriteria`
  ADD PRIMARY KEY (`mpe_respon_kriteria_id`),
  ADD UNIQUE KEY `respon_kriteria` (`mpe_respon_id`,`mpe_kriteria_id`),
  ADD KEY `mpe_kriteria_id` (`mpe_kriteria_id`);

--
-- Indexes for table `mpe_wilayah`
--
ALTER TABLE `mpe_wilayah`
  ADD PRIMARY KEY (`mpe_wilayah_id`),
  ADD KEY `mpe_id` (`mpe_id`);

--
-- Indexes for table `mpe_wilayah_kriteria`
--
ALTER TABLE `mpe_wilayah_kriteria`
  ADD PRIMARY KEY (`mpe_wilayah_kriteria_id`),
  ADD UNIQUE KEY `mpe_respon_id` (`mpe_respon_id`,`mpe_wilayah_id`,`mpe_kriteria_id`),
  ADD KEY `mpe_wilayah_id` (`mpe_wilayah_id`),
  ADD KEY `mpe_kriteria_id` (`mpe_kriteria_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ahp`
--
ALTER TABLE `ahp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ahp_respon`
--
ALTER TABLE `ahp_respon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `bahan_penyedia`
--
ALTER TABLE `bahan_penyedia`
  MODIFY `bahan_penyedia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ekonomi`
--
ALTER TABLE `ekonomi`
  MODIFY `ekonomi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ekonomi_kriteria`
--
ALTER TABLE `ekonomi_kriteria`
  MODIFY `ekonomi_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ekonomi_kriteria_respon`
--
ALTER TABLE `ekonomi_kriteria_respon`
  MODIFY `ekonomi_kriteria_respon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `ekonomi_respon`
--
ALTER TABLE `ekonomi_respon`
  MODIFY `ekonomi_respon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `finansial`
--
ALTER TABLE `finansial`
  MODIFY `finansial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finansial_bahan`
--
ALTER TABLE `finansial_bahan`
  MODIFY `finansial_bahan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finansial_barang`
--
ALTER TABLE `finansial_barang`
  MODIFY `finansial_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `finansial_kategori`
--
ALTER TABLE `finansial_kategori`
  MODIFY `finansial_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finansial_penerimaan`
--
ALTER TABLE `finansial_penerimaan`
  MODIFY `finansial_penerimaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kebutuhan_air`
--
ALTER TABLE `kebutuhan_air`
  MODIFY `kebutuhan_air_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mpe`
--
ALTER TABLE `mpe`
  MODIFY `mpe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mpe_kriteria`
--
ALTER TABLE `mpe_kriteria`
  MODIFY `mpe_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mpe_respon`
--
ALTER TABLE `mpe_respon`
  MODIFY `mpe_respon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mpe_respon_kriteria`
--
ALTER TABLE `mpe_respon_kriteria`
  MODIFY `mpe_respon_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `mpe_wilayah`
--
ALTER TABLE `mpe_wilayah`
  MODIFY `mpe_wilayah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `mpe_wilayah_kriteria`
--
ALTER TABLE `mpe_wilayah_kriteria`
  MODIFY `mpe_wilayah_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ahp_respon`
--
ALTER TABLE `ahp_respon`
  ADD CONSTRAINT `ahp_respon` FOREIGN KEY (`ahp_id`) REFERENCES `ahp` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ekonomi_kriteria`
--
ALTER TABLE `ekonomi_kriteria`
  ADD CONSTRAINT `ekonomi_kriteria_ibfk_1` FOREIGN KEY (`ekonomi_id`) REFERENCES `ekonomi` (`ekonomi_id`) ON DELETE CASCADE;

--
-- Constraints for table `ekonomi_kriteria_respon`
--
ALTER TABLE `ekonomi_kriteria_respon`
  ADD CONSTRAINT `ekonomi_kriteria_respon_ibfk_1` FOREIGN KEY (`ekonomi_kriteria_id`) REFERENCES `ekonomi_kriteria` (`ekonomi_kriteria_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ekonomi_kriteria_respon_ibfk_2` FOREIGN KEY (`ekonomi_respon_id`) REFERENCES `ekonomi_respon` (`ekonomi_respon_id`) ON DELETE CASCADE;

--
-- Constraints for table `ekonomi_respon`
--
ALTER TABLE `ekonomi_respon`
  ADD CONSTRAINT `ekonomi_respon_ibfk_1` FOREIGN KEY (`ekonomi_id`) REFERENCES `ekonomi` (`ekonomi_id`) ON DELETE CASCADE;

--
-- Constraints for table `finansial_bahan`
--
ALTER TABLE `finansial_bahan`
  ADD CONSTRAINT `finansial_kategori_id_key` FOREIGN KEY (`finansial_kategori_id`) REFERENCES `finansial_kategori` (`finansial_kategori_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finansial_kategori_id_key2` FOREIGN KEY (`finansial_kategori_id`) REFERENCES `finansial_kategori` (`finansial_kategori_id`) ON DELETE CASCADE;

--
-- Constraints for table `finansial_barang`
--
ALTER TABLE `finansial_barang`
  ADD CONSTRAINT `finansial_barang_ibfk_1` FOREIGN KEY (`finansial_kategori_id`) REFERENCES `finansial_kategori` (`finansial_kategori_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finansial_id_key2` FOREIGN KEY (`finansial_id`) REFERENCES `finansial` (`finansial_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `satuan_id_fkey` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`satuan_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `satuan_id_key` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`satuan_id`);

--
-- Constraints for table `finansial_penerimaan`
--
ALTER TABLE `finansial_penerimaan`
  ADD CONSTRAINT `finansial_penerimaan_id_key` FOREIGN KEY (`finansial_id`) REFERENCES `finansial` (`finansial_id`) ON DELETE CASCADE;

--
-- Constraints for table `kebutuhan_air`
--
ALTER TABLE `kebutuhan_air`
  ADD CONSTRAINT `kebutuhan_air_ibfk_1` FOREIGN KEY (`finansial_id`) REFERENCES `finansial` (`finansial_id`) ON DELETE CASCADE;

--
-- Constraints for table `mpe_kriteria`
--
ALTER TABLE `mpe_kriteria`
  ADD CONSTRAINT `mpe_kriteria_ibfk_1` FOREIGN KEY (`mpe_id`) REFERENCES `mpe` (`mpe_id`) ON DELETE CASCADE;

--
-- Constraints for table `mpe_respon`
--
ALTER TABLE `mpe_respon`
  ADD CONSTRAINT `mpe_respon_ibfk_1` FOREIGN KEY (`mpe_id`) REFERENCES `mpe` (`mpe_id`) ON DELETE CASCADE;

--
-- Constraints for table `mpe_respon_kriteria`
--
ALTER TABLE `mpe_respon_kriteria`
  ADD CONSTRAINT `mpe_respon_kriteria_ibfk_1` FOREIGN KEY (`mpe_kriteria_id`) REFERENCES `mpe_kriteria` (`mpe_kriteria_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mpe_respon_kriteria_ibfk_2` FOREIGN KEY (`mpe_respon_id`) REFERENCES `mpe_respon` (`mpe_respon_id`) ON DELETE CASCADE;

--
-- Constraints for table `mpe_wilayah`
--
ALTER TABLE `mpe_wilayah`
  ADD CONSTRAINT `mpe_wilayah_ibfk_1` FOREIGN KEY (`mpe_id`) REFERENCES `mpe` (`mpe_id`) ON DELETE CASCADE;

--
-- Constraints for table `mpe_wilayah_kriteria`
--
ALTER TABLE `mpe_wilayah_kriteria`
  ADD CONSTRAINT `mpe_wilayah_kriteria_ibfk_1` FOREIGN KEY (`mpe_respon_id`) REFERENCES `mpe_respon` (`mpe_respon_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mpe_wilayah_kriteria_ibfk_2` FOREIGN KEY (`mpe_wilayah_id`) REFERENCES `mpe_wilayah` (`mpe_wilayah_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mpe_wilayah_kriteria_ibfk_3` FOREIGN KEY (`mpe_kriteria_id`) REFERENCES `mpe_kriteria` (`mpe_kriteria_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
