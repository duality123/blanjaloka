-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 17, 2023 at 02:29 AM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.3.29-1+focal

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blanjaloka`
--

-- --------------------------------------------------------

--
-- Table structure for table `bab`
--

CREATE TABLE `bab` (
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `link_video` text DEFAULT NULL,
  `elearning_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `bab` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bab`
--

INSERT INTO `bab` (`judul`, `deskripsi`, `link_video`, `elearning_id`, `id`, `bab`) VALUES
('Cara membuat makanan', 'Cara membuat makanan', 'https://www.youtube.com/embed/6WgvzCU3TI8', NULL, 6, 1),
('Cara mengolah tebu bagian 1', 'elearning ini berisi tata cara membuat makanan', 'https://www.youtube.com/embed/6WgvzCU3TI8', 10, 7, 1),
('Cara Membuat Makanan Mudah', 'Deskripsi VIDEOOOO', 'https://www.youtube.com/embed/jNQXAC9IVRw', 9, 9, 1),
('Bisnis Kuliner', '232323', 'ttps://www.youtube.com/embed/jNQXAC9IVRw', NULL, 10, 2),
('Bisnis Kuliner', 'Bisnis Kuliner', 'https://www.youtube.com/embed/jNQXAC9IVRw', NULL, 11, 2),
('Bisnis Kuliner', 'Bisnis Kuliner', 'https://www.youtube.com/embed/jNQXAC9IVRw', NULL, 12, 2),
('Bisnis Kuliner', 'Bisnis Kuliner', 'https://www.youtube.com/embed/jNQXAC9IVRw', NULL, 13, 2),
('tes', '2013', 'https://www.youtube.com/embed/jNQXAC9IVRw', NULL, 14, 2),
('tes', '2013', 'https://www.youtube.com/embed/jNQXAC9IVRw', NULL, 15, 2),
('Bisnis Kuliner 123', '2013', 'https://www.youtube.com/embed/jNQXAC9IVRw', 9, 16, 2),
('Tes bisnis', 'Tes bisnis', 'https://www.youtube.com/embed/jNQXAC9IVRw', 9, 17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis`
--

CREATE TABLE `bisnis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto_bisnis` text NOT NULL,
  `jumlah_investasi` bigint(20) NOT NULL DEFAULT 0,
  `target_investasi` bigint(20) NOT NULL DEFAULT 0,
  `jumlah_investor` mediumint(9) NOT NULL DEFAULT 0,
  `persentase_hasil_investasi` float DEFAULT 0,
  `waktu_balik_modal_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `waktu_balik_modal_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `minimum_investasi` int(11) NOT NULL DEFAULT 0,
  `kategori` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `total_penghasilan` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bisnis`
--

INSERT INTO `bisnis` (`id`, `name`, `foto_bisnis`, `jumlah_investasi`, `target_investasi`, `jumlah_investor`, `persentase_hasil_investasi`, `waktu_balik_modal_start`, `waktu_balik_modal_end`, `minimum_investasi`, `kategori`, `lokasi`, `status`, `total_penghasilan`) VALUES
(10, 'Bisnis f0ood', ',investor/foto_bisnis/8kpQA2x4U3w3b8IrrfQ3A6AGUecipM3nL3tKiifg.jpg,investor/foto_bisnis/zcGBhY9TxSzSV26SnrS503sDPYSj2ubfkmS70TVD.jpg', 20000, 40000, 500, 60, '2023-02-08 15:25:47', '2022-12-29 17:00:00', 60000, 'Bisnis f0ood', 'Bisnis f0ood', 1, 500000),
(11, 'deskripsi', ',investor/foto_bisnis/w5q0s40DaXds2OzYtFLUo5ddKO0Rj7EyT7og3Vfu.jpg', 2, 2, 2, NULL, '2022-12-12 17:00:00', '2023-01-12 17:00:00', 2, 'deskripsi', 'deskripsi', 0, NULL),
(12, 'deskripsi', ',investor/foto_bisnis/fA05gjBcARIJilbQz0JCsOM7oaRVffk6ZHZGjLwO.jpg', 2, 2, 2, 20, '2022-12-12 17:00:00', '2023-01-12 17:00:00', 300, 'deskripsi', 'deskripsi', 1, NULL),
(13, 'Bisnis tes1', ',investor/foto_bisnis/BYjkibbDSi0QVQ0h9AiUdvoUNogvefE0qo7xZjH5.jpg,investor/foto_bisnis/fihU7CwVoAE2kkn2gMaQrIjQq7m4YD86GybfV2iC.jpg', 178000, 20000, 350, 28.0899, '2023-02-06 15:02:00', '2022-12-27 17:00:00', 40000, 'Makanan', 'Jakarta Pusat', 1, 2000000),
(17, 'Bisnisku Terbaik', ',investasi/foto_bisnis/vRGuAPikHJTSPSj1uinH9HLWUtf4qtLw0na2AGZJ.png,investasi/foto_bisnis/4BDwSQdsGQnPlTHT0VKdlSlURqV0xz026f9ikcWF.png', 3000, 400, 20, 2000, '2023-02-17 01:04:43', '2023-02-07 17:00:00', 300000, 'Bisnis', 'Jakatrta', 1, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis_investor`
--

CREATE TABLE `bisnis_investor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `bisnis_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `investor_foreign` bigint(20) UNSIGNED DEFAULT NULL,
  `bisnis_foreign` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bisnis_investor`
--

INSERT INTO `bisnis_investor` (`id`, `status`, `bisnis_id`, `investor_id`, `investor_foreign`, `bisnis_foreign`) VALUES
(1, NULL, 4, 29, NULL, NULL),
(2, NULL, 5, 29, NULL, NULL),
(3, NULL, 6, 29, NULL, NULL),
(4, NULL, 7, 29, NULL, NULL),
(5, NULL, 8, 29, NULL, NULL),
(6, NULL, 9, 29, NULL, NULL),
(7, NULL, 10, 29, NULL, NULL),
(9, NULL, 12, 29, NULL, NULL),
(33, NULL, 13, 29, 29, 13),
(34, NULL, 17, 29, 29, 17);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis_peserta`
--

CREATE TABLE `bisnis_peserta` (
  `id` bigint(20) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED NOT NULL,
  `bisnis_id` bigint(20) UNSIGNED NOT NULL,
  `umkm_foreign` bigint(20) UNSIGNED DEFAULT NULL,
  `bisnis_foreign` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bisnis_peserta`
--

INSERT INTO `bisnis_peserta` (`id`, `umkm_id`, `bisnis_id`, `umkm_foreign`, `bisnis_foreign`) VALUES
(10, 5, 12, NULL, NULL),
(12, 5, 13, NULL, NULL),
(20, 5, 10, 5, 10),
(23, 23, 11, 23, 11);

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `update` timestamp NULL DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'WraYuKzcJaZOlprxhuEmG2sSc2whxxmKE9J6HKTPaW2Nbh2BnV3xgKumjS7jjr19egrpe6apppSJbWYWfrgas5BXOpAIEKMn2wrU'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_perusahaan`
--

CREATE TABLE `dokumen_perusahaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_akta_pendirian_perusahaan` char(100) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foto_npwp_perusahaan` text DEFAULT NULL,
  `no_npwp_perusahaan` char(100) DEFAULT NULL,
  `foto_ktp_pic` text DEFAULT NULL,
  `no_rekening` char(100) DEFAULT NULL,
  `foto_buku_tabungan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokumen_perusahaan`
--

INSERT INTO `dokumen_perusahaan` (`id`, `nomor_akta_pendirian_perusahaan`, `user_id`, `foto_npwp_perusahaan`, `no_npwp_perusahaan`, `foto_ktp_pic`, `no_rekening`, `foto_buku_tabungan`) VALUES
(2, '244', 29, 'umkm/keterangan_halal/WSbsHb3Dl7y85gXRf1S8AGINfEo1fvCbrrxAbhla.jpg', '234234', 'umkm/keterangan_halal/lohLk3xoi72FnucE3IzeFUcHdjn5VP6pmnytnBGl.jpg', '56656', 'umkm/keterangan_halal/rwse6GfFMsithkXdaGFxIvVckAc8c4mwX6tbvFCH.jpg'),
(3, '19291', 39, 'investor/foto_npwp_perusahaan/gBIrmNBhnDgv6zghmsfryCDIl9fVOCqSn4bzAW4W.jpg', '129128128', 'investor/foto_ktp_pic/O5EmDYA5Yepjk7qN2bc8y03qo5IBeepMpXor0rEj.png', '7732323', 'investor/foto_buku_tabungan/VBy65RbHb96RmpZpMHeLz5jOnbKBPZmp9PpEB4TF.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `elearning`
--

CREATE TABLE `elearning` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `hari_tanggal_waktu` timestamp NULL DEFAULT NULL,
  `judul` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `elearning`
--

INSERT INTO `elearning` (`id`, `kegiatan_id`, `hari_tanggal_waktu`, `judul`, `foto`, `deskripsi`) VALUES
(9, 22, '2023-01-07 17:00:00', 'Cara membuat makanan 123', 'elearning/gambar/1v17L4YKuW50569n30BcTqjl0FeNw0ywZ3UfmnsB.jpg', 'tesssssssssss1'),
(10, 22, '2023-01-02 17:00:00', 'Cara mengolah tebu', 'elearning/gambar/CQz9B8sCCmCnEB7PKSzfWhkrjEnVXjupjXcs0h0W.jpg', 'elearning ini berisi tata cara membuat makanan'),
(13, 20, '2023-01-07 17:00:00', 'Cara membuat makanan', 'elearning/gambar/diwcUMphPNfNGlhWUyla4auZkRsyeRHqb9D5OtAa.jpg', 'Cara membuat makanan');

-- --------------------------------------------------------

--
-- Table structure for table `eventual`
--

CREATE TABLE `eventual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perihal` text DEFAULT NULL,
  `status` bit(3) DEFAULT b'0',
  `nama_mentor` char(100) DEFAULT NULL,
  `link_meeting` text DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT current_timestamp(),
  `profil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `kegiatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventual`
--

INSERT INTO `eventual` (`id`, `perihal`, `status`, `nama_mentor`, `link_meeting`, `waktu`, `profil_id`, `kontak`, `kegiatan_id`, `jadwal`) VALUES
(29, 'buatlah video anda sedang memasak lalu upload youtube', b'000', 'Eko', NULL, '2023-01-05 11:58:26', 4, 'whatsapp 087722342464', 22, NULL),
(30, 'Laporan 1', b'000', 'Jakarta Timur', NULL, '2023-01-05 12:00:24', 4, 'whatsapp 087722342464', 22, NULL),
(32, 'Cara buat game', b'000', 'Arip', NULL, '2023-02-13 03:22:25', 4, 'what (0812721', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funding`
--

CREATE TABLE `funding` (
  `id` bigint(20) NOT NULL,
  `uang_masuk` bigint(20) DEFAULT NULL,
  `uang_keluar` bigint(20) DEFAULT NULL,
  `bisnis_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funding`
--

INSERT INTO `funding` (`id`, `uang_masuk`, `uang_keluar`, `bisnis_id`, `bukti`, `user_id`, `tanggal`) VALUES
(5, 10000, 0, 10, 'funding/bukti_funding_umkm/pF4E4fvzDVAWEKLpAzD22BQzKmUVr8KlWnFiax6I.pdf', 5, '2023-01-08 01:42:59'),
(6, 20000, 5600, 10, 'funding/bukti_funding_umkm/mfew2rBJ12PuOgn2rH1wwsYF6hrbIiIXRSvr3I3a.pdf', 23, '2023-01-08 03:25:50'),
(7, 30000, 0, 10, 'funding/bukti_funding_umkm/a541GkkPC7xqPibAbeq3x8pCrK08xsRaAsbzF5rh.pdf', 5, '2023-01-08 03:49:17'),
(8, 50000, 0, 13, 'funding/bukti_funding_umkm/bxXKAsQ7qd8kR2OrijvBxcCF7UbEbCNtXGYuLnWo.pdf', 5, '2023-01-09 04:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `info_admin`
--

CREATE TABLE `info_admin` (
  `isi` text DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `tandai` tinyint(1) NOT NULL DEFAULT 0,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_admin`
--

INSERT INTO `info_admin` (`isi`, `tanggal`, `tandai`, `id`) VALUES
('Besok sekolah', '2023-02-05 13:29:49', 1, 5),
('Minggu liburrr', '2023-02-17 00:31:26', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `investasi`
--

CREATE TABLE `investasi` (
  `id` int(11) NOT NULL,
  `investasi_masuk` bigint(20) DEFAULT NULL,
  `investasi_keluar` bigint(20) DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `bisnis_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investasi`
--

INSERT INTO `investasi` (`id`, `investasi_masuk`, `investasi_keluar`, `bukti`, `bisnis_id`, `user_id`, `tanggal`) VALUES
(7, 20000000, 24444, 'investasi/bukti_investasi_investor/k6EO5CY7qgdT8DIg8nhAACpIwb3rCPyvTHv6tabP.pdf', 10, 29, '2023-01-07 14:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `janji_temu`
--

CREATE TABLE `janji_temu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  `lokasi` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bit(3) DEFAULT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `temp_target` bigint(20) DEFAULT NULL,
  `berakhir` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `janji_temu`
--

INSERT INTO `janji_temu` (`id`, `investor_id`, `waktu`, `lokasi`, `status`, `umkm_id`, `temp_target`, `berakhir`) VALUES
(16, 29, '2023-02-12 03:47:00', 'Bekasi Utara', NULL, 5, NULL, '2023-02-15 03:47:00'),
(18, 29, '2023-02-12 03:47:00', 'Bekasi Utara', NULL, 23, NULL, '2023-02-15 03:47:00'),
(19, 29, '2023-02-12 03:47:00', 'Bekasi Utara', NULL, 23, NULL, '2023-02-15 03:47:00'),
(20, 29, '2023-02-21 03:47:00', 'Bekasi Utara Selatan', NULL, 5, NULL, '2023-02-15 03:47:00'),
(21, 29, '2023-02-12 03:47:00', 'Bekasi Utara 1234', NULL, 23, NULL, '2023-02-15 03:47:00'),
(22, 29, '2023-02-13 15:19:00', 'www.facebook.com', NULL, 5, NULL, '2023-02-23 15:20:00'),
(23, 29, '2023-02-13 15:19:00', 'www.facebook.com', NULL, 5, NULL, '2023-02-23 15:20:00'),
(24, 29, '2023-02-13 15:19:00', 'www.facebook.com', NULL, 5, NULL, '2023-02-23 15:20:00'),
(25, 39, '2023-02-14 18:45:00', 'Jakarta Serikat', NULL, 5, NULL, '2023-02-15 18:45:00'),
(26, 39, '2023-02-12 18:48:00', 'Jakarta Serikat', NULL, 5, NULL, '2023-02-17 18:48:00'),
(27, 39, '2023-02-13 19:00:00', 'Banten', NULL, 5, NULL, '2023-02-15 19:00:00'),
(28, 39, '2023-02-13 19:00:00', 'Banten', NULL, 5, NULL, '2023-02-15 19:00:00'),
(30, 29, '2023-02-19 20:00:00', 'Jaktim', NULL, 5, NULL, '2023-02-24 20:01:00'),
(31, 39, '2023-02-14 08:15:00', 'Jakarta Selatan', NULL, 5, NULL, '2023-02-24 08:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `kajian_finansial`
--

CREATE TABLE `kajian_finansial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `capex` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opex` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swot_faktor_internal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swot_faktor_eksternal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payback_period` smallint(4) DEFAULT NULL,
  `key_partners` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_activity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_propotions` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channels` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_structure` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revenue_streams` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kajian_finansial`
--

INSERT INTO `kajian_finansial` (`id`, `user_id`, `capex`, `opex`, `swot_faktor_internal`, `swot_faktor_eksternal`, `payback_period`, `key_partners`, `key_activity`, `value_propotions`, `customer_relationship`, `channels`, `cost_structure`, `revenue_streams`) VALUES
(4, 5, 'capex deh 123', 'opex deh', 'SWOT INTERNAL DEH', 'SWOT aja dah', 55, 'Gaada', 'Main game', 'Tak ada', 'Adalah teman saya', 'ada', '230000', 'Revenue Streams'),
(5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 23, 'capex', 'opex', 'swot', 'swot', 1234, 'key', 'key act', 'value', 'customer', 'channels', 'cost', 'stream');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_orang_diundang` smallint(6) NOT NULL DEFAULT 0,
  `masa_inkubasi` tinyint(4) NOT NULL,
  `kurikulum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_juri` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draft` tinyint(1) NOT NULL DEFAULT 0,
  `dibuat` timestamp NOT NULL DEFAULT '2022-11-08 21:53:23',
  `dimulai` timestamp NOT NULL DEFAULT '2022-11-08 21:53:23',
  `berakhir` timestamp NOT NULL DEFAULT '2022-11-08 21:53:23'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `tema`, `deskripsi`, `gambar`, `jumlah_orang_diundang`, `masa_inkubasi`, `kurikulum`, `nama_juri`, `pic`, `kontak`, `draft`, `dibuat`, `dimulai`, `berakhir`) VALUES
(20, 'Latihan kegiatan 1', 'jucudhsc', 'kegiatan/gambar/nusRwWlVfiKJRUJYmb4reGdJf9kCpo8QnKBfiatU.jpg', 3, 2, '2013', 'Eko', 'Eko', '8827327', 1, '2022-11-08 21:53:23', '2022-12-31 17:00:00', '2023-02-23 17:00:00'),
(22, 'tes 123', 'sdsfdsfsdf', 'kegiatan/gambar/TQTty9MHjcJm9ZuqruEa0HMubFknfSqEjqAS6xfZ.jpg', 20, 2, '2013', 'Eko', 'Eko', '2832323', 1, '2022-11-08 21:53:23', '2023-01-15 17:00:00', '2023-01-17 17:00:00'),
(34, 'Latihan Vue Js Easyy', 'Ini deskripsi', 'kegiatan/gambar/ifXg1HlstqmdcEDBoK4k85ZJYtSXotqPtVa2nhic.jpg', 33, 4, '2013', 'Ahmad', 'anton', '88787', 1, '2022-11-08 21:53:23', '2023-01-07 17:00:00', '2023-01-09 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_investor`
--

CREATE TABLE `kegiatan_investor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` int(10) UNSIGNED NOT NULL,
  `kegiatan_id` int(10) UNSIGNED NOT NULL,
  `investor_foreign` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan_foreign` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_investor`
--

INSERT INTO `kegiatan_investor` (`id`, `investor_id`, `kegiatan_id`, `investor_foreign`, `kegiatan_foreign`) VALUES
(2, 6, 3, NULL, NULL),
(3, 6, 7, NULL, NULL),
(4, 6, 6, NULL, NULL),
(5, 6, 7, NULL, NULL),
(6, 29, 8, NULL, NULL),
(7, 29, 3, NULL, NULL),
(8, 6, 9, NULL, NULL),
(9, 6, 10, NULL, NULL),
(10, 6, 11, NULL, NULL),
(11, 6, 12, NULL, NULL),
(12, 6, 13, NULL, NULL),
(13, 6, 14, NULL, NULL),
(14, 6, 15, NULL, NULL),
(15, 29, 18, NULL, NULL),
(16, 29, 19, NULL, NULL),
(18, 29, 21, NULL, NULL),
(20, 29, 23, NULL, NULL),
(21, 29, 24, NULL, NULL),
(22, 29, 25, NULL, NULL),
(32, 29, 22, 29, 22),
(41, 29, 20, 29, 20),
(43, 29, 34, 29, 34),
(44, 39, 20, 39, 20);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_umkm`
--

CREATE TABLE `kegiatan_umkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `umkm_id` bigint(10) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `lulus_funding` tinyint(1) DEFAULT 0,
  `umkm_foreign` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan_foreign` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_umkm`
--

INSERT INTO `kegiatan_umkm` (`id`, `umkm_id`, `kegiatan_id`, `lulus_funding`, `umkm_foreign`, `kegiatan_foreign`) VALUES
(12, 5, 5, NULL, NULL, NULL),
(15, 5, 6, NULL, NULL, NULL),
(16, 5, 6, NULL, NULL, NULL),
(17, 23, 6, NULL, NULL, NULL),
(19, 23, 3, NULL, NULL, NULL),
(20, 5, 3, 80, NULL, NULL),
(24, 5, 11, 0, NULL, NULL),
(25, 5, 12, 0, NULL, NULL),
(27, 5, 14, 0, NULL, NULL),
(28, 5, 15, 0, NULL, NULL),
(29, 38, 13, 0, NULL, NULL),
(30, 5, 18, 0, NULL, NULL),
(31, 5, 19, 0, NULL, NULL),
(33, 5, 21, 0, NULL, NULL),
(34, 5, 22, 1, NULL, NULL),
(35, 5, 23, 0, NULL, NULL),
(36, 5, 24, 0, NULL, NULL),
(37, 5, 25, 0, NULL, NULL),
(58, 5, 34, 0, 5, 34),
(69, 23, 20, 1, 23, 20);

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mentor_id` bigint(20) UNSIGNED NOT NULL,
  `perihal` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `pesan` text DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `id` bigint(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `tandai` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`pesan`, `tanggal`, `gambar`, `id`, `email`, `tandai`) VALUES
('bagaimana cara membuat game', NULL, '', 1, 'smaba@upi.edi', 0),
('bagaimana cara membuat game', NULL, '', 2, 'smaba@upi.edi', 0),
('cara buat game', NULL, '', 3, 'www.facebook.com', 0),
('tes', '2023-02-16 06:48:25', '', 4, 'tes@tes.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `hari_tanggal_bulan` timestamp NULL DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `status` bit(3) DEFAULT NULL,
  `bukti_kegiatan` text COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id`, `user_id`, `kegiatan_id`, `hari_tanggal_bulan`, `deskripsi`, `status`, `bukti_kegiatan`, `waktu`) VALUES
(146, 5, 22, NULL, 'Laporan 1234', b'010', 'umkm/logbook/PSjzYdPsxMSmslGhDnEkmE4bxvQnLnXLWZTy1VBK.jpg', '2023-01-04 12:52:43'),
(147, 5, 22, NULL, 'DKI Jakarta', b'001', 'umkm/logbook/cGoUWk4BDfnBg8GpM9h5WoA0NdEcLJsbdLgbB3zE.jpg', '2023-01-05 08:59:38'),
(148, 5, 22, NULL, 'DKI Jakarta', b'001', 'umkm/logbook/09L4aXLhcqhgQlPptG1UyoFaCTOiWRVcISETnQr5.jpg', '2023-01-05 09:00:49'),
(149, 5, 22, NULL, 'Laporan 1', b'001', 'umkm/logbook/JqfZdVmizKTyhF2hjowbh21dcN4KBLJy5nTiLOx2.png', '2023-01-05 18:07:58'),
(150, 5, 22, NULL, 'DKI Jakarta', b'000', 'umkm/logbook/Mv3BUo0r13PpTexJAS0sdDuxfGt2N2FJyqla5hm1.jpg', '2023-01-05 18:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_09_15_044737_create_permission_tables', 1),
(7, '2022_09_23_015957_chat_room', 1),
(8, '2022_09_23_020446_pesan', 1),
(9, '2022_09_25_150741_user_chat_room', 1),
(10, '2022_09_26_103302_kegiatan', 1),
(11, '2022_09_26_104228_pendataan_produk_dan_jasa_umkm', 1),
(12, '2022_09_27_115608_kegiatan_umkm', 1),
(13, '2022_09_27_115736_kegiatan_investor', 1),
(14, '2022_10_15_121006_profil', 1),
(15, '2022_10_31_100321_usaha', 1),
(16, '2022_10_31_174929_produk', 1),
(17, '2022_11_07_005204_janji_temu', 1),
(18, '2022_11_07_060449_notifikasi', 1),
(19, '2022_11_08_181446_elearning', 1),
(20, '2022_11_08_181902_logbook', 1),
(21, '2022_11_08_181945_konsultasi', 1),
(22, '2022_11_09_045038_kajian_finansial', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tandai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `nama`, `pesan`, `tanggal`, `status`, `redirect`, `tandai`) VALUES
(8, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-11-09 07:50:00', NULL, '/profil/1', 1),
(17, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda diterima !', '2022-11-22 19:21:03', NULL, NULL, 0),
(18, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya !', '2022-11-22 19:22:12', NULL, NULL, 0),
(23, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya !', '2022-11-27 22:21:48', NULL, NULL, 0),
(24, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan SEVLTE ANGULAR di waktu 2022-11-17 00:00:00 diterima!', '2022-11-27 22:39:25', NULL, NULL, 0),
(25, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan SEVLTE ANGULAR di waktu 2022-11-18 00:00:00', '2022-11-27 22:39:46', NULL, NULL, 0),
(27, 23, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-11-29 06:54:18', NULL, '/profil/1', 0),
(30, 23, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Vue di waktu 2022-11-17 00:00:00 diterima!', '2022-11-29 07:39:35', NULL, NULL, 0),
(31, 23, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan Vue di waktu 2022-11-17 00:00:00', '2022-11-29 07:43:34', NULL, NULL, 0),
(34, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Vue Js Mudah Sekali di waktu 2022-11-17 00:00:00 diterima!', '2022-12-08 20:05:12', NULL, NULL, 0),
(35, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan Vue Js Mudah Sekali di waktu 2022-11-17 00:00:00', '2022-12-08 20:05:28', NULL, NULL, 0),
(36, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan Vue Js Mudah Sekali di waktu 2022-11-17 00:00:00', '2022-12-08 20:09:34', NULL, NULL, 0),
(39, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-12-23 10:23:51', NULL, '/profil/1', 0),
(41, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:13:00', NULL, NULL, 0),
(42, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:13:14', NULL, NULL, 0),
(43, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:14:40', NULL, NULL, 0),
(44, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:18:05', NULL, NULL, 0),
(45, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Membuat Makanan di waktu 2022-12-26 17:12:11 diterima!', '2022-12-26 10:41:44', NULL, NULL, 0),
(46, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Membuat Makanan di waktu 2022-11-17 00:00:00 diterima!', '2022-12-26 10:52:30', NULL, NULL, 0),
(47, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Membuat Makanan di waktu 2022-11-17 00:00:00 diterima!', '2022-12-26 10:52:34', NULL, NULL, 0),
(51, 7, 'Pengajuan Eventual', 'Seorang user mengajukan untuk meeting', '2022-12-26 16:14:07', NULL, '38', 1),
(55, 7, 'Pengajuan Eventual', 'Seorang user mengajukan untuk meeting', '2022-12-31 09:20:51', NULL, '/admin/dashboard/kegiatan15eventual', 0),
(59, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatantes 123 di waktu 2023-01-04 19:52:43', '2023-01-05 09:13:14', NULL, NULL, 0),
(60, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatantes 123 di waktu 2023-01-04 19:52:43', '2023-01-05 09:13:17', NULL, NULL, 0),
(61, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-05 16:00:49 diterima!', '2023-01-05 09:13:21', NULL, NULL, 0),
(62, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatantes 123 di waktu 2023-01-05 15:59:38', '2023-01-05 09:13:29', NULL, NULL, 0),
(63, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-05 15:59:38 diterima!', '2023-01-05 09:13:32', NULL, NULL, 0),
(64, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatantes 123 di waktu 2023-01-04 19:52:43', '2023-01-05 09:27:25', NULL, NULL, 1),
(67, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaanserta no telepon1121212 meminta untuk janji temu bersama Tono dengan usaha ', '2023-01-06 13:34:22', NULL, 'admin/janjitemu?page=1', 0),
(68, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaanserta no telepon1121212 meminta untuk janji temu bersama Tono dengan usaha ', '2023-01-06 13:34:45', NULL, 'admin/janjitemu?page=1', 1),
(69, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaanserta no telepon1121212 meminta untuk janji temu bersama Tono dengan usaha ', '2023-01-06 13:35:08', NULL, 'admin/janjitemu?page=1', 0),
(70, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon0345355', '2023-01-06 13:39:22', NULL, 'admin/janjitemu?page=1', 0),
(81, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama rahmah dengan usaha perusahaan dan dengan nomor telepon 263623', '2023-01-08 21:01:18', NULL, '/admin/janjitemu?page=1', 1),
(82, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama rahmah dengan usaha perusahaan dan dengan nomor telepon 263623', '2023-01-08 21:02:04', NULL, '/admin/janjitemu?page=1', 1),
(83, 5, 'Eventual anda disetujui', 'Eventual anda disetujui pada kegiatan tes 123 dengan perihal DKI Jakartadi waktu 2023-01-17', '2023-01-09 03:39:18', NULL, NULL, 0),
(84, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan tes 123 tanggal 2023-01-17 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2023-01-09 03:40:07', NULL, NULL, 0),
(85, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-05 16:00:49 diterima!', '2023-01-09 03:40:38', NULL, NULL, 0),
(86, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-05 15:59:38 diterima!', '2023-01-09 03:40:42', NULL, NULL, 0),
(87, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-04 19:52:43 diterima!', '2023-01-09 03:40:48', NULL, NULL, 0),
(88, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-04 19:52:43 diterima!', '2023-01-09 03:42:15', NULL, NULL, 0),
(89, 29, 'Track record investasi ditambah', 'track record investasi anda ditambah di bisnis Bisnis tes1', '2023-01-09 04:27:02', NULL, '/umkm/dashboard/funding/fundingku/', 0),
(90, 5, 'Track Record Ditambah', 'track record funding anda ditambah di bisnis Bisnis tes1', '2023-01-09 04:30:30', NULL, '/investor/dashboard/bisnisku/investasi/', 1),
(91, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355', '2023-01-09 04:59:17', NULL, '/admin/janjitemu?page=1', 0),
(92, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan tes 123', '2023-01-13 14:44:29', NULL, NULL, 0),
(93, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan tes 123', '2023-01-13 14:47:30', NULL, '/investor/dashboard/kegiatan/22', 0),
(94, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-01-14 10:02:52', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(95, 23, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-01-14 10:10:54', NULL, NULL, 0),
(96, 23, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-01-14 10:12:57', NULL, NULL, 0),
(97, 23, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-01-14 10:13:15', NULL, NULL, 0),
(98, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-01-14 10:16:40', NULL, NULL, 0),
(99, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan Vue Js', '2023-01-14 11:51:53', NULL, '/investor/dashboard/kegiatan/34', 0),
(100, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan tes 123', '2023-01-14 22:50:35', NULL, NULL, 0),
(101, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan tes 123', '2023-01-14 22:50:55', NULL, '/investor/dashboard/kegiatan/22', 0),
(102, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan tes 123', '2023-01-15 00:19:49', NULL, NULL, 0),
(103, 29, 'dikeluarkan dari bisnis', 'Anda dikeluarkan dari bisnis Bisnis tes1', '2023-01-15 02:48:55', NULL, '/investor/dashboard/bisnisku/', 0),
(104, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-01-15 21:40:51', NULL, '/investor/dashboard/bisnisku/13', 0),
(105, 23, 'dikeluarkan dari funding', 'Anda dikeluarkan dari funding Bisnis f0ood', '2023-01-17 22:51:33', NULL, NULL, 0),
(106, 5, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis Bisnis f0ood', '2023-01-17 22:51:51', NULL, '/umkm/dashboard/funding/10', 0),
(107, 5, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis Bisnis f0ood', '2023-01-17 22:55:58', NULL, '/umkm/dashboard/funding/10', 0),
(108, 5, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis Bisnis f0ood', '2023-01-17 22:56:32', NULL, '/umkm/dashboard/funding/10', 0),
(109, 5, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis Bisnis f0ood', '2023-01-17 22:57:31', NULL, '/umkm/dashboard/funding/10', 0),
(110, 5, 'dikeluarkan dari funding', 'Anda dikeluarkan dari funding Bisnis f0ood', '2023-01-17 22:57:58', NULL, NULL, 0),
(111, 5, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis Bisnis f0ood', '2023-01-17 22:58:07', NULL, '/umkm/dashboard/funding/10', 0),
(112, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-01-17 23:05:02', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(113, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis tes1', '2023-01-29 08:26:12', NULL, '/investor/dashboard/bisnisku/13', 0),
(114, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis tes1', '2023-01-29 08:26:41', NULL, '/investor/dashboard/bisnisku/13', 0),
(115, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis tes1', '2023-01-29 08:29:27', NULL, '/investor/dashboard/bisnisku/13', 0),
(116, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis tes1', '2023-01-29 08:29:59', NULL, '/investor/dashboard/bisnisku/13', 0),
(117, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis tes1', '2023-01-29 08:31:45', NULL, '/investor/dashboard/bisnisku/13', 0),
(118, 29, 'dikeluarkan dari bisnis', 'Anda dikeluarkan dari bisnis Bisnis tes1', '2023-01-29 08:39:47', NULL, NULL, 0),
(119, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis tes1', '2023-01-29 08:40:05', NULL, '/investor/dashboard/bisnisku/13', 0),
(120, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-05 08:23:15', NULL, NULL, 0),
(121, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-05 08:23:27', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(122, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-05 20:45:05', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(123, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi jakut dimulai pada 2023-02-20T10:24 dan berakhir pada 2023-02-24T10:24', '2023-02-06 03:25:44', NULL, '/notifikasi/UMKM', 0),
(124, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi jakut dimulai pada 2023-02-20T10:24 dan berakhir pada 2023-02-24T10:24', '2023-02-06 03:25:44', NULL, '/notifikasi/UMKM', 0),
(125, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi JKARTA dimulai pada 2023-02-12T10:28 dan berakhir pada 2023-02-14T10:28', '2023-02-06 03:29:12', NULL, '/notifikasi/UMKM', 0),
(126, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi JKARTA dimulai pada 2023-02-12T10:28 dan berakhir pada 2023-02-14T10:28', '2023-02-06 03:29:12', NULL, '/notifikasi/UMKM', 0),
(127, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi sdsdsd dimulai pada 2023-02-12T10:29 dan berakhir pada 2023-02-24T10:29', '2023-02-06 03:29:43', NULL, '/notifikasi/UMKM', 1),
(128, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi sdsdsd dimulai pada 2023-02-12T10:29 dan berakhir pada 2023-02-24T10:29', '2023-02-06 03:29:43', NULL, '/notifikasi/UMKM', 0),
(129, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi dimulai pada 2023-02-12T10:47 dan berakhir pada 2023-02-15T10:47', '2023-02-06 03:47:14', NULL, '/notifikasi/UMKM', 0),
(130, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi dimulai pada 2023-02-12T10:47 dan berakhir pada 2023-02-15T10:47', '2023-02-06 03:47:14', NULL, '/notifikasi/UMKM', 0),
(131, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Jakarta Serikat dimulai pada 2023-02-05T10:48 dan berakhir pada 2023-02-23T10:48', '2023-02-06 03:48:12', NULL, '/notifikasi/UMKM', 0),
(132, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Jakarta Serikat dimulai pada 2023-02-05T10:48 dan berakhir pada 2023-02-23T10:48', '2023-02-06 03:48:12', NULL, '/notifikasi/UMKM', 0),
(133, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:22:36', NULL, '/notifikasi/UMKM', 0),
(134, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi Utara dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:22:36', NULL, '/notifikasi/UMKM', 0),
(135, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:22:40', NULL, '/notifikasi/UMKM', 0),
(136, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi Utara dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:22:40', NULL, '/notifikasi/UMKM', 0),
(137, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara Selatan dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:22:47', NULL, '/notifikasi/UMKM', 0),
(138, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi Utara Selatan dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:22:47', NULL, '/notifikasi/UMKM', 0),
(139, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara 123 dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:23:03', NULL, '/notifikasi/UMKM', 0),
(140, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi Utara 123 dimulai pada 2023-02-12 10:47:00 dan berakhir pada 2023-02-15 10:47:00', '2023-02-06 04:23:03', NULL, '/notifikasi/UMKM', 0),
(141, 7, 'Pengajuan Data Baru', 'Seorang user mengajukan data barunya', '2023-02-07 03:29:45', NULL, '/detai/profil/umkm5', 0),
(142, 7, 'Pengajuan Data Baru', 'Seorang user mengajukan data barunya', '2023-02-07 03:30:43', NULL, '/detai/profil/umkm5', 0),
(143, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 10:59:32', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(144, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 10:59:40', NULL, NULL, 0),
(145, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 10:59:49', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(146, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:04:51', NULL, NULL, 0),
(147, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 11:05:02', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(148, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:06:42', NULL, NULL, 0),
(149, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:06:49', NULL, NULL, 0),
(150, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 11:07:14', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(151, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:13:01', NULL, NULL, 0),
(152, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 11:14:47', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(153, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:15:45', NULL, NULL, 0),
(154, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 11:29:58', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(155, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:30:39', NULL, NULL, 0),
(156, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 11:47:43', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(157, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 11:48:37', NULL, NULL, 0),
(158, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 12:28:20', NULL, NULL, 0),
(159, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 12:28:30', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(160, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 12:31:55', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(161, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 12:31:58', NULL, NULL, 0),
(162, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 12:32:03', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(163, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 12:32:10', NULL, NULL, 0),
(164, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 12:46:43', NULL, NULL, 0),
(165, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 12:54:43', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(166, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 12:55:24', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(167, 5, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 12:55:39', NULL, NULL, 0),
(168, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 12:56:03', NULL, NULL, 0),
(169, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 13:00:41', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(170, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 13:00:59', NULL, NULL, 0),
(171, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 13:06:20', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(172, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 13:13:50', NULL, NULL, 0),
(173, 5, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 13:14:00', NULL, '/umkm/dashboard/kegiatanku/34', 0),
(174, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan Vue Js', '2023-02-07 13:22:46', NULL, NULL, 0),
(175, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 13:57:19', NULL, NULL, 0),
(176, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 13:57:32', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(177, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 13:57:39', NULL, NULL, 0),
(178, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:00:35', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(179, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:00:40', NULL, NULL, 0),
(180, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:01:55', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(181, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:02:04', NULL, NULL, 0),
(182, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:03:23', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(183, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:03:33', NULL, NULL, 0),
(184, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:07:52', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(185, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:07:57', NULL, NULL, 0),
(186, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:09:45', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(187, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:09:50', NULL, NULL, 0),
(188, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:11:27', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(189, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:11:43', NULL, NULL, 0),
(190, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:12:21', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(191, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:12:39', NULL, NULL, 0),
(192, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 14:13:02', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(193, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:13:49', NULL, NULL, 0),
(194, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 14:16:58', NULL, '/investor/dashboard/kegiatan/20', 0),
(195, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:17:04', NULL, NULL, 0),
(196, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 14:17:44', NULL, '/investor/dashboard/kegiatan/20', 0),
(197, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 14:19:36', NULL, NULL, 0),
(198, 23, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis deskripsi', '2023-02-07 15:08:59', NULL, '/umkm/dashboard/funding/11', 0),
(199, 5, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis deskripsi', '2023-02-07 15:09:03', NULL, '/umkm/dashboard/funding/11', 0),
(200, 23, 'dikeluarkan dari funding', 'Anda dikeluarkan dari funding deskripsi', '2023-02-07 15:09:10', NULL, NULL, 0),
(201, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 15:10:11', NULL, NULL, 0),
(202, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 15:10:15', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(203, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 15:10:23', NULL, NULL, 0),
(204, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-07 15:12:14', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(205, 5, 'dikeluarkan dari funding', 'Anda dikeluarkan dari funding deskripsi', '2023-02-07 15:12:35', NULL, NULL, 0),
(206, 29, 'dikeluarkan dari bisnis', 'Anda dikeluarkan dari bisnis deskripsi', '2023-02-07 15:17:40', NULL, NULL, 0),
(207, 23, 'diundang diundang ke funding bisnis', 'Anda diundang ke funding bisnis deskripsi', '2023-02-07 15:17:53', NULL, '/umkm/dashboard/funding/11', 0),
(208, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi www.facebook.com dimulai pada 2023-02-13T22:19 dan berakhir pada 2023-02-23T22:20', '2023-02-07 15:20:03', NULL, '/notifikasi/UMKM', 0),
(209, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi www.facebook.com dimulai pada 2023-02-13T22:19 dan berakhir pada 2023-02-23T22:20', '2023-02-07 15:23:35', NULL, '/notifikasi/UMKM', 0),
(210, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi www.facebook.com dimulai pada 2023-02-13T22:19 dan berakhir pada 2023-02-23T22:20', '2023-02-07 15:24:15', NULL, '/notifikasi/UMKM', 0),
(211, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi www.facebook.com dimulai pada 2023-02-13T22:19 dan berakhir pada 2023-02-23T22:20', '2023-02-07 15:24:15', NULL, '/notifikasi/UMKM', 0),
(212, 29, 'Anda diundang ke bisnis', 'Anda diundang ke bisnis Bisnis Tes 123', '2023-02-07 16:45:30', NULL, '/investor/dashboard/bisnisku/17', 0),
(213, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 16:52:34', NULL, '/investor/dashboard/kegiatan/20', 0),
(214, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 16:54:38', NULL, NULL, 0),
(215, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 16:54:43', NULL, '/investor/dashboard/kegiatan/20', 0),
(216, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 16:55:11', NULL, NULL, 0),
(217, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 16:55:14', NULL, '/investor/dashboard/kegiatan/20', 0),
(218, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 16:55:36', NULL, '/investor/dashboard/kegiatan/20', 0),
(219, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 17:00:22', NULL, NULL, 0),
(220, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 17:00:30', NULL, '/investor/dashboard/kegiatan/20', 0),
(221, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 17:00:33', NULL, '/investor/dashboard/kegiatan/20', 0),
(222, 29, 'dikeluarkan dari  kegiatan', 'Anda dikeluarkan dari kegiatan Latihan kegiatan 1', '2023-02-07 17:00:45', NULL, NULL, 0),
(223, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-07 17:00:54', NULL, '/investor/dashboard/kegiatan/20', 0),
(224, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355', '2023-02-07 14:47:09', NULL, '/admin/janjitemu?page=1', 0),
(225, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355', '2023-02-07 14:48:40', NULL, '/admin/janjitemu?page=1', 0),
(226, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355', '2023-02-07 14:48:49', NULL, '/admin/janjitemu?page=1', 0),
(227, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355', '2023-02-07 14:52:25', NULL, '/admin/janjitemu?page=1', 0),
(228, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355 dilokasi  pada waktu 2023-02-19T06:41', '2023-02-07 16:41:48', NULL, '/admin/janjitemu?page=1', 0),
(229, 7, 'Pengajuan Janji Temu', 'investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355 dilokasi  pada waktu 2023-02-19T06:41', '2023-02-07 16:41:51', NULL, '/admin/janjitemu?page=1', 0),
(231, 7, 'Pengajuan Janji Temu', 'Investor Arman dengan nama perusahaan Perushaaan serta no telepon 1121212 meminta untuk janji temu bersama Tono dengan usaha perusahaan makanan dan dengan nomor telepon 0345355 dilokasi Jakarta pada waktu 2023-02-06T10:19', '2023-02-13 03:19:08', NULL, '/admin/janjitemu?page=1', 0),
(232, 7, 'Pengajuan Eventual', 'UMKMTono mengajukan untuk meeting di kegiatan tes 123', '2023-02-13 03:22:25', NULL, '/admin/kegiatan?page=122/eventual', 0),
(233, 7, 'Pengajuan Data Investor Baru', 'Seorang investor mengajukan data barunya', '2023-02-14 11:46:59', NULL, 'detail/profil/investor/39', 0),
(234, 7, 'Pengajuan Data Investor Baru', 'Seorang investor mengajukan data barunya', '2023-02-14 12:07:56', NULL, 'detail/profil/investor/39', 0),
(237, 39, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-14 18:17:07', NULL, '/profil/1', 0),
(238, 39, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-14 18:18:27', NULL, '/profil/1', 0),
(239, 39, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-14 18:24:24', NULL, '/profil/1', 0),
(240, 39, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-14 18:27:46', NULL, '/profil/1', 0),
(241, 39, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-14 18:31:07', NULL, '/profil/1', 0),
(242, 39, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-14 18:34:08', NULL, '/profil/1', 0),
(243, 39, 'Revisi Profil', 'ktp kurang jelas', '2023-02-15 11:23:12', NULL, '/investor/profil/1', 0),
(244, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-15 23:56:06', NULL, '/umkm/dashboard/kegiatanku?page=1', 0),
(245, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-15 23:57:48', NULL, '/umkm/dashboard/kegiatanku?page=1', 0),
(246, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2023-02-16 00:03:32', NULL, '/umkm/dashboard/kegiatanku?page=1', 0),
(247, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatantes 123 di waktu 2023-01-04 12:52:43', '2023-02-16 08:57:11', NULL, NULL, 0),
(248, 39, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan Vue Js Bagian 2', '2023-02-16 10:30:30', NULL, '/investor/dashboard/kegiatan/35', 0),
(250, 29, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan Vue Js', '2023-02-16 11:06:44', NULL, '/investor/dashboard/kegiatan/34', 0),
(251, 39, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan Latihan kegiatan 1', '2023-02-16 11:18:41', NULL, '/investor/dashboard/kegiatan/20', 0),
(252, 23, 'Anda lulus inkubasi', 'Selamat anda lulus inkubasi kegiatan Latihan kegiatan 1', '2023-02-16 11:39:48', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(253, 23, 'Anda lulus inkubasi', 'Selamat anda lulus inkubasi kegiatan Latihan kegiatan 1', '2023-02-16 11:40:39', NULL, '/umkm/dashboard/kegiatanku/20', 0),
(254, 5, 'Anda lulus inkubasi', 'Selamat anda lulus inkubasi kegiatan tes 123', '2023-02-16 11:41:26', NULL, '/umkm/dashboard/kegiatanku/22', 0),
(255, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Samba dilokasi Jakarta Serikat dimulai pada 2023-02-14T18:45 dan berakhir pada 2023-02-15T18:45', '2023-02-16 11:45:57', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(256, 39, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Jakarta Serikat dimulai pada 2023-02-14T18:45 dan berakhir pada 2023-02-15T18:45', '2023-02-16 11:45:57', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(257, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Samba dilokasi Jakarta Serikat dimulai pada 2023-02-12T18:48 dan berakhir pada 2023-02-17T18:48', '2023-02-16 11:48:32', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(258, 39, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Jakarta Serikat dimulai pada 2023-02-12T18:48 dan berakhir pada 2023-02-17T18:48', '2023-02-16 11:48:33', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(259, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Samba dilokasi Banten dimulai pada 2023-02-13T19:00 dan berakhir pada 2023-02-15T19:00', '2023-02-16 12:01:09', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(260, 39, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Banten dimulai pada 2023-02-13T19:00 dan berakhir pada 2023-02-15T19:00', '2023-02-16 12:01:10', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(261, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Samba dilokasi Bandung dimulai pada 2023-02-12T19:07 dan berakhir pada 2023-02-15T19:07', '2023-02-16 12:07:15', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(262, 39, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bandung dimulai pada 2023-02-12T19:07 dan berakhir pada 2023-02-15T19:07', '2023-02-16 12:07:16', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(263, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:10:12', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(264, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:10:12', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(265, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:10:40', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(266, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:10:41', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(267, 23, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:11:38', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(268, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM rahmah dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:11:39', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(269, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:12:05', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(270, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:12:05', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(271, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:20:52', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(272, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:20:53', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(273, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:23:34', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(274, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:23:34', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(275, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:26:47', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(276, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 12:26:47', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(277, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Jaktim dimulai pada 2023-02-19T20:00 dan berakhir pada 2023-02-24T20:01', '2023-02-16 13:01:55', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(278, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Jaktim dimulai pada 2023-02-19T20:00 dan berakhir pada 2023-02-24T20:01', '2023-02-16 13:01:57', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(279, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 13:08:28', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(280, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 13:08:29', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(281, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 13:10:49', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(282, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 13:10:49', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(283, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 16:18:38', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(284, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 16:18:38', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(285, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Arman dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 16:21:25', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(286, 29, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Bekasi Utara dimulai pada 2023-02-12 03:47:00 dan berakhir pada 2023-02-15 03:47:00', '2023-02-16 16:21:25', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(287, 23, 'Anda diundang ke kegiatan', 'Anda diundang ke kegiatan ', '2023-02-17 00:20:35', NULL, '/umkm/dashboard/kegiatanku/22', 0),
(288, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Latihan Vue Js tanggal  sudah dihapus. Kontak admin bila terjadi kesalahan', '2023-02-17 00:29:11', NULL, NULL, 0),
(289, 5, 'undangan janji temu', 'Undangan anda untuk janji temu dengan investor Samba dilokasi Bandung dimulai pada  dan berakhir pada 2023-02-15 19:07:00 sudah selesai', '2023-02-17 01:05:27', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(290, 39, 'undangan janji temu', 'Undangan anda untuk janji temu dengan UMKM Tono dilokasi Bandung dimulai pada  dan berakhir pada 2023-02-15 19:07:00 sudah selesai', '2023-02-17 01:05:29', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(291, 5, 'undangan janji temu', 'Anda diundang untuk janji temu dengan investor Samba dilokasi Jakarta Selatan dimulai pada 2023-02-14T08:15 dan berakhir pada 2023-02-24T08:15', '2023-02-17 01:15:52', NULL, '/umkm/dashboard/janjitemu?page=1', 0),
(292, 39, 'undangan janji temu', 'Anda diundang untuk janji temu dengan UMKM Tono dilokasi Jakarta Selatan dimulai pada 2023-02-14T08:15 dan berakhir pada 2023-02-24T08:15', '2023-02-17 01:15:53', NULL, '/investor/dashboard/janjitemu?page=1', 0),
(293, 23, 'dikeluarkan dari kegiatan', 'Anda dikeluarkan dari kegiatan tes 123', '2023-02-17 02:00:56', NULL, NULL, 0),
(294, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan tes 123 di waktu 2023-01-05 18:07:58 diterima!', '2023-02-17 02:01:27', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('muhammad.samba@citiasiainc.id', '$2y$10$evYcyZ8MRzDdFjkbU7Jofu6899BwklKylD6NF4Jbb/ui6QSLWHSEa', '2022-12-04 13:08:38'),
('assassinscheep@gmail.com', '$2y$10$K3uxTSIUQYRqYYvQuN3/JeAAF0xJnkyxENhQS7K6Tas5Mu7Vnj5RW', '2022-12-12 22:50:54'),
('muhammad.samba@citiasiainc.id', '$2y$10$evYcyZ8MRzDdFjkbU7Jofu6899BwklKylD6NF4Jbb/ui6QSLWHSEa', '2022-12-04 13:08:38'),
('assassinscheep@gmail.com', '$2y$10$K3uxTSIUQYRqYYvQuN3/JeAAF0xJnkyxENhQS7K6Tas5Mu7Vnj5RW', '2022-12-12 22:50:54'),
('muhammad.samba@citiasiainc.id', '$2y$10$evYcyZ8MRzDdFjkbU7Jofu6899BwklKylD6NF4Jbb/ui6QSLWHSEa', '2022-12-04 13:08:38'),
('assassinscheep@gmail.com', '$2y$10$K3uxTSIUQYRqYYvQuN3/JeAAF0xJnkyxENhQS7K6Tas5Mu7Vnj5RW', '2022-12-12 22:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 5, 'auth_token', '20b0087246e5b8893f11d6a2c8df7cc972b11765b427fc60c8645aceef23360c', '[\"*\"]', '2022-12-30 18:01:56', NULL, '2022-12-30 17:59:00', '2022-12-30 18:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengirim` bigint(20) UNSIGNED NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `update` timestamp NULL DEFAULT NULL,
  `tanggal_kirim` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_laporan`
--

CREATE TABLE `pesan_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_produk` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_produk_yang_dijual` int(11) DEFAULT NULL,
  `bahan_produk` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_produk` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_produk` bigint(20) DEFAULT NULL,
  `keterangan_halal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat_fungsional` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat_nonfungsional` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `user_id`, `jenis_produk`, `jumlah_produk_yang_dijual`, `bahan_produk`, `kategori_produk`, `harga_produk`, `keterangan_halal`, `manfaat_fungsional`, `manfaat_nonfungsional`) VALUES
(4, 5, 'Makanan Ringan', 35, 'Makanan', 'Baik', 20000, 'umkm/keterangan_halal/afsH6d9242Oc0ZkDhYkAIPYo9kYZSltJuunWKGSo.doc', 'Harganya mahal', 'Produk ini mahal'),
(5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 23, 'produk', 2, 'bahan', 'kategori', 2000, 'umkm/keterangan_halal/eJ0cj5Ome3SbfMm3F5vj3pjSsglS9Zontx5GJpc3.pdf', 'manfaat', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foto_profil` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` timestamp NULL DEFAULT NULL,
  `pendidikan_terakhir` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_kelahiran` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_ktp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_dengan_ktp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` char(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kewarganegaraan` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengalaman_kerja` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `user_id`, `foto_profil`, `nama_lengkap`, `tanggal_lahir`, `pendidikan_terakhir`, `tempat_kelahiran`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `foto_ktp`, `foto_dengan_ktp`, `no_hp`, `status`, `kewarganegaraan`, `agama`, `pengalaman_kerja`) VALUES
(4, 5, 'umkm/foto_profil/GIbgDtdzh8WdbDg28Mf2rLnewNu5wTIDpIUPTS4F.png', 'Tono', '2022-11-12 17:00:00', 'SMA', 'Sleman', 'Rumah Sakit', 'Kalisari', 'PasarRebo', 'sadsadasd', 'Jawa Tengah', 'umkm/foto_ktp/54YXlCk4PvePVNgIwP1iyegrQ97UyFF10WuPC4e1.png', 'umkm/foto_selfie_ktp/hAaAY7pbEKHnkexLgbssZfzjMfPVLUcHIQGCqtGc.png', '0345355', 'Aktif', 'Indonesia', 'Islam', 'Mengikuti ISNA'),
(6, 7, 'umkm/foto_profil/u1LgaWon1X5BTJsrovo8oLWi2tkvohQXuCFhR7Rs.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 23, 'umkm/foto_profil/nlw24tR5SPjjmKTfaNvnVo18NhX6MvAEDhnjrhi6.png', 'rahmah', '2022-11-16 17:00:00', 'sma', 'manado', 'rumah', 'kel', 'kec', 'kab', 'banten', 'umkm/foto_ktp/lpFgXNeUseUUHGWBTPEdv3lpx1qs1QsLRKfCZeUM.png', 'umkm/foto_selfie_ktp/mjYxzdhBywmzAf2H3F7GU4Hex9PNf63OJa4zMvTU.png', '263623', 'stat', 'indo', 'islam', 'tidak'),
(20, 29, 'investor/foto_profil/1YjPaINvRx1zxwMA7NhfGtQke8ZByukBJLNmbilr.png', 'Arman', '2022-12-11 00:00:00', 'SMA', 'Sleman', 'JL Tempat TInggal', 'Kalisari', 'PAsar Rebo', 'gatau', 'Serang', 'investor/foto_ktp/WvlXPqRZM0SVjXNEKsLdhOHmorF7fyT3u6YIvOeP.png', 'investor/foto_selfie_ktp/tJTZJCNndhgi0tHa1OhIP1KwJ0428st1HgmBqsgj.png', '1121212', 'gTu', 'Indonesia', 'Islam', 'Pernah ikut mbkm'),
(30, 39, 'investor/foto_profil/nVXCfoel3rRxEaMoMcHxp1fitBXkqx63FtRAGPGb.png', 'Samba', '2023-02-12 00:00:00', 'Sma', 'Sleman', 'PEsona', 'Ps rebo', 'tes', 'Jakarta', 'Jakarta', 'investor/foto_ktp/RimdsBYKx3a4L0htzazOq9MJCpehSYO46YWicMRg.jpg', 'investor/foto_selfie_ktp/NLQwqAeIP1iS3CusYS6fblthTZRruUuUYtwE9kYT.jpg', '018212', 'Aktif', 'Indoonesia', 'Islam', 'Pernah ikut mbkm');

-- --------------------------------------------------------

--
-- Table structure for table `profil_perusahaan`
--

CREATE TABLE `profil_perusahaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `nama_pic` varchar(255) DEFAULT NULL,
  `tanggal_berdiri` timestamp NULL DEFAULT NULL,
  `nomor_telepon` char(20) DEFAULT NULL,
  `email_pic` varchar(255) DEFAULT NULL,
  `kategori_perusahaan` varchar(255) DEFAULT NULL,
  `deskripsi_perusahaan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_perusahaan`
--

INSERT INTO `profil_perusahaan` (`id`, `user_id`, `nama_perusahaan`, `alamat_perusahaan`, `nama_pic`, `tanggal_berdiri`, `nomor_telepon`, `email_pic`, `kategori_perusahaan`, `deskripsi_perusahaan`) VALUES
(3, 29, 'Perushaaan', 'Perushaaan', 'Perushaaan', '2022-12-19 17:00:00', '2334', 'Perushaaan', 'Kuliner', 'abcdefuck'),
(4, 39, 'Samba Al Faraby', 'Jln kuliner 1 no 59', 'Ahmad', '2023-02-13 00:00:00', '12344', 'ahmad@ahmad.com', 'Makanan', 'Perusahaan kuliner');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `number` tinyint(3) UNSIGNED DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `user_id`, `number`) VALUES
(2, NULL, NULL, NULL, NULL, 5, 2),
(4, NULL, NULL, NULL, NULL, 7, 1),
(13, NULL, NULL, NULL, NULL, 23, 2),
(29, NULL, NULL, NULL, NULL, 29, 3),
(31, NULL, NULL, NULL, NULL, 39, 3),
(32, NULL, NULL, NULL, NULL, 40, 1),
(33, NULL, NULL, NULL, NULL, 41, 1),
(34, NULL, NULL, NULL, NULL, 42, 1),
(35, NULL, NULL, NULL, NULL, 44, 1),
(36, NULL, NULL, NULL, NULL, 46, 1),
(40, NULL, NULL, NULL, NULL, 53, 2),
(41, NULL, NULL, NULL, NULL, 53, 1),
(43, NULL, NULL, NULL, NULL, 55, 2),
(44, NULL, NULL, NULL, NULL, 56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir_jawaban`
--

CREATE TABLE `tugas_akhir_jawaban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas_akhir_jawaban`
--

INSERT INTO `tugas_akhir_jawaban` (`id`, `jawaban`, `file`, `gambar`, `user_id`, `kegiatan_id`) VALUES
(1, 'blablabla', 'umkm/tugas_akhir/dokumen/aET8Zt5wPBwvYhNxGcZPsjthYT82OuCJc3UEMcKV.pdf', NULL, 23, 34),
(6, 'blablabla', 'umkm/tugas_akhir/dokumen/xKxasfZNGkGbtLCMrYjfe5yxKnNUeKuiULw6cTBP.pdf', NULL, NULL, 22),
(7, 'www.facebook.com', NULL, NULL, NULL, 22),
(8, '// In Chrome: // arguments is an own property with descriptor {value: Arguments(0), writable: false, enumerable: false, configurable: false}  // In Firefox: // f doesn\'t have an own property named arguments. Trying to get f.[[Prototype]].arguments // Arguments { … }', NULL, NULL, NULL, 22),
(9, '// In Chrome: // arguments is an own property with descriptor {value: Arguments(0), writable: false, enumerable: false, configurable: false}  // In Firefox: // f doesn\'t have an own property named arguments. Trying to get f.[[Prototype]].arguments // Arguments { … }', 'umkm/tugas_akhir/dokumen/q6OL8R9RaZuvDCXcAAYyF3xEEAetKAgYDZo1iAKW.pdf', 'umkm/tugas_akhir/gambar/cnbb5Wg8bVp1SqcO0pCRRPrXtwwRhx0li7clqYoy.png', 5, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir_kegiatan`
--

CREATE TABLE `tugas_akhir_kegiatan` (
  `soal` text DEFAULT NULL,
  `jawaban` longtext DEFAULT NULL,
  `nilai` tinyint(100) DEFAULT NULL,
  `dikumpulkan_pada` timestamp NULL DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `dibuat` timestamp NULL DEFAULT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir_soal`
--

CREATE TABLE `tugas_akhir_soal` (
  `kegiatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `soal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas_akhir_soal`
--

INSERT INTO `tugas_akhir_soal` (`kegiatan_id`, `id`, `soal`) VALUES
(22, 1, 'tes soal'),
(22, 5, 'buatlah video anda sedang memasak lalu upload youtube'),
(34, 6, 'Buatlah CRUD dari Vue JS dan Laravel , videokan !'),
(22, 7, 'Buat Crud di laravel');

-- --------------------------------------------------------

--
-- Table structure for table `usaha`
--

CREATE TABLE `usaha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_perusahaan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perusahaan` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legalitas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_amdal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informasi_pajak` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_usaha` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usaha`
--

INSERT INTO `usaha` (`id`, `user_id`, `nama_perusahaan`, `alamat_perusahaan`, `status_perusahaan`, `legalitas`, `dokumen_amdal`, `informasi_pajak`, `npwp`, `deskripsi_usaha`, `email_perusahaan`) VALUES
(4, 5, 'perusahaan makanan', 'Jalan Alamat 123', 'Aktif', 'umkm/dokumen_legalitas/clg0gDqRqypp5kDQeHQIyOXsVXazFh6rcL1DcVwR.pdf', 'umkm/dokumen_amdal/ljbj41b10NKM4yKJBOHb1c0n7Yk7aAYDEtwTIqp3.pdf', 'Pajak aktif', '66265', 'Usaha ini milik saya sendiri', 'samba@upi.edii'),
(5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 23, 'perusahaan', 'alamat', 'stat', 'umkm/dokumen_legalitas/Fg3lt1jqRzw7oqMFVAv2fzmGnriudIC1dU81OoP1.pdf', 'umkm/dokumen_amdal/xdhotX2dDb0cgkeZIvNpsu8BfAbOr7PnWx5jxwqF.pdf', 'pajak', 'npwp', 'usaha', 'perusahaan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `notifikasi` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_tertonton` smallint(6) DEFAULT NULL,
  `notif_pesan` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_telepon`, `email_verified_at`, `remember_token`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `provider_id`, `provider_token`, `role`, `accepted`, `notifikasi`, `created_at`, `updated_at`, `video_tertonton`, `notif_pesan`) VALUES
(5, 'MUHAMMAD SAMBA', 'samba@upi.edu', NULL, '2022-11-08 23:10:45', '8b20bL0CAmrvuIANmg8KnzRkIRoVQeQAOKFi9R9dMc5jnGYXyxJV6bOWigqa', '$2y$10$j7D5QSsiT13hn6GQeVAGXe1yP0.LtXU0od5tki67EV6S8a9V0Fxz2', NULL, NULL, NULL, '111968172218430437214', 'ya29.a0AeTM1id7YmPNzj46CHmoFFmZ7zBMq1GNCJdjZ3Sb-9aKxAz1J-XaJlINsZOT1gDl1WQi_I-Wnfhx_3CoxoJpBbdRtI_fhCFLWBT-GZyzmYS_yWpH09sEHDvaXhgRuqZ9P3NSVVMnoV-QI0sNY18h-h5ESNj0kwaCgYKAeASARESFQHWtWOmN3rblHCboaiWG2iXp0VxUg0165', NULL, 1, 4, '2022-11-08 23:10:45', '2023-02-17 02:04:39', NULL, 0),
(7, 'Kelompok 3 _ Muhammad Samba Al Faraby', 'assassinscheep@gmail.com', NULL, '2022-11-09 00:23:01', 'mUfjSH9nlUPIlTlfZ2MBV5Ypg959zo3T1C54XO5dlXNcQ6TjCONqwZNZvVCN', '$2y$10$F7zPkSwqQNMjZgaKAkOs7ekWU1hWP7ZGBHJwMSwt7Og0ELYNGhLMO', NULL, NULL, NULL, '108953706873143162955', 'ya29.a0AeTM1ifSXZnfuPBnfuVLO-0H-ctovQm18A0rPMnA54Bs2jli-de2sBqHf4EPzO-Yz4283cnstPE8j8gaAPguR_xlc8gW2YK_OSvbc4kFVF9D8QPOxEMIlWERO-9kV9LXUlEDVGDblfoF-HeBltL0xzxZSlaLaCgYKAVMSARASFQHWtWOmHYTwEwki2pMB_ZWqVZ7_2w0163', NULL, NULL, 0, '2022-11-09 00:23:01', '2023-02-17 01:16:59', NULL, 0),
(23, NULL, 'nrahmahtsania@gmail.com', '+6285778147853', '2022-11-28 22:58:15', NULL, '$2y$10$H1y2JFIxvUlJRzay6am6vOH7.njyvXiFkft3/p/YdnOGPMxkrGLnm', NULL, NULL, NULL, NULL, NULL, 3, 1, 6, '2022-11-28 22:57:39', '2023-02-17 02:00:55', NULL, 0),
(29, NULL, 'muhammad.samba@citiasiainc.id', '+6223234343', '2022-12-07 15:38:44', '7Lr7X8hBikeS7cd7n41GKzChXTuDmuINf6c6AdEy3Id3NE35uSqmxh0t73Xj', '$2y$10$337pfy.cfagLsRsR3NQgketdkh7TXWZA5wzyKWbvB4L6qOZPsa1oy', NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2022-12-07 14:38:31', '2023-02-16 23:14:49', NULL, 0),
(39, NULL, 'sambaalfarabi@yahoo.com', '+62343434', '2023-02-14 10:09:14', 'dRVx3py6uPBCCWNkdKoBrgraql8zRWbRwFHWBOSoQveodFzL5fOLnVqE5SLb', '$2y$10$CfbMZCgUf5aAI30YYM72buITWjJo0aCOOFEPyLVpIigfE1XY4UAyW', NULL, NULL, NULL, NULL, NULL, 3, 1, 6, '2023-02-14 09:51:06', '2023-02-17 01:15:51', NULL, 0),
(40, 'TestUser123', 'admin@admin.com', '+62928327388', '2023-02-17 00:32:14', NULL, '$2y$10$oT9wxifDyziaaX5TzOsu0.BaJS13epfpe7W0MbyUVKDYUIPlGz28y', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 00:32:14', '2023-02-17 02:25:38', NULL, 0),
(41, 'TestUser123', 'TestUser123@user.com', '+62234567891', '2023-02-17 00:34:00', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 00:34:00', '2023-02-17 00:34:00', NULL, 0),
(42, 'AdminBaru', '12345678', '+621234567889', '2023-02-17 00:35:38', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 00:35:38', '2023-02-17 00:35:38', NULL, 0),
(44, 'AdminBaru', '12345678912', '+6212345678896', '2023-02-17 00:37:41', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 00:37:41', '2023-02-17 00:37:41', NULL, 0),
(46, 'AdminBaru', '12345678912123', '+62987654321', '2023-02-17 00:38:36', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 00:38:36', '2023-02-17 00:38:36', NULL, 0),
(53, 'AdminBaru', 'admin123@admin.com', '+62123456789', '2023-02-17 02:11:03', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 02:11:03', '2023-02-17 02:11:03', NULL, 0),
(55, 'testestes', 'testetses', '+621234151423', '2023-02-17 02:15:31', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 02:15:31', '2023-02-17 02:15:31', NULL, 0),
(56, 'AdminBaru', 'TestUser123@test.com', '+62123456754', '2023-02-17 02:18:52', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 02:18:52', '2023-02-17 02:18:52', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_chat_room`
--

CREATE TABLE `user_chat_room` (
  `user_id` bigint(20) NOT NULL,
  `chat_room_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bab`
--
ALTER TABLE `bab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elearning_id` (`elearning_id`);

--
-- Indexes for table `bisnis`
--
ALTER TABLE `bisnis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bisnis_investor`
--
ALTER TABLE `bisnis_investor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investor_foreign` (`investor_foreign`),
  ADD KEY `bisnis_foreign` (`bisnis_foreign`);

--
-- Indexes for table `bisnis_peserta`
--
ALTER TABLE `bisnis_peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umkm_foreign` (`umkm_foreign`),
  ADD KEY `bisnis_foreign` (`bisnis_foreign`);

--
-- Indexes for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_perusahaan`
--
ALTER TABLE `dokumen_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `elearning`
--
ALTER TABLE `elearning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elearning_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indexes for table `eventual`
--
ALTER TABLE `eventual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`),
  ADD KEY `eventual_ibfk_2` (`profil_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `funding`
--
ALTER TABLE `funding`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bisnis_id` (`bisnis_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `info_admin`
--
ALTER TABLE `info_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investasi`
--
ALTER TABLE `investasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bisnis_id` (`bisnis_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `janji_temu`
--
ALTER TABLE `janji_temu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `janji_temu_user_id_foreign` (`investor_id`),
  ADD KEY `umkm_id` (`umkm_id`);

--
-- Indexes for table `kajian_finansial`
--
ALTER TABLE `kajian_finansial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kajian_finansial_user_id_foreign` (`user_id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_investor`
--
ALTER TABLE `kegiatan_investor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investor_owner` (`investor_foreign`),
  ADD KEY `kegiatan_foreign` (`kegiatan_foreign`);

--
-- Indexes for table `kegiatan_umkm`
--
ALTER TABLE `kegiatan_umkm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umkm_foreign` (`umkm_foreign`),
  ADD KEY `kegiatan_foreign` (`kegiatan_foreign`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultasi_user_id_foreign` (`user_id`),
  ADD KEY `konsultasi_mentor_id_foreign` (`mentor_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logbook`
--
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logbook_user_id_foreign` (`user_id`),
  ADD KEY `logbook_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesan_pengirim_foreign` (`pengirim`);

--
-- Indexes for table `pesan_laporan`
--
ALTER TABLE `pesan_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_user_id_foreign` (`user_id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_user_id_foreign` (`user_id`);

--
-- Indexes for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tugas_akhir_jawaban`
--
ALTER TABLE `tugas_akhir_jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_akhir_jawaban_ibfk_1` (`kegiatan_id`),
  ADD KEY `tugas_akhir_jawaban_ibfk_2` (`user_id`);

--
-- Indexes for table `tugas_akhir_kegiatan`
--
ALTER TABLE `tugas_akhir_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tugas_akhir_soal`
--
ALTER TABLE `tugas_akhir_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_akhir_soal_ibfk_1` (`kegiatan_id`);

--
-- Indexes for table `usaha`
--
ALTER TABLE `usaha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usaha_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_no_telepon_unique` (`no_telepon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bab`
--
ALTER TABLE `bab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bisnis`
--
ALTER TABLE `bisnis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bisnis_investor`
--
ALTER TABLE `bisnis_investor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `bisnis_peserta`
--
ALTER TABLE `bisnis_peserta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_perusahaan`
--
ALTER TABLE `dokumen_perusahaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `elearning`
--
ALTER TABLE `elearning`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `eventual`
--
ALTER TABLE `eventual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funding`
--
ALTER TABLE `funding`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `info_admin`
--
ALTER TABLE `info_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `investasi`
--
ALTER TABLE `investasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `janji_temu`
--
ALTER TABLE `janji_temu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kajian_finansial`
--
ALTER TABLE `kajian_finansial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kegiatan_investor`
--
ALTER TABLE `kegiatan_investor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kegiatan_umkm`
--
ALTER TABLE `kegiatan_umkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_laporan`
--
ALTER TABLE `pesan_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tugas_akhir_jawaban`
--
ALTER TABLE `tugas_akhir_jawaban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tugas_akhir_kegiatan`
--
ALTER TABLE `tugas_akhir_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas_akhir_soal`
--
ALTER TABLE `tugas_akhir_soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usaha`
--
ALTER TABLE `usaha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bab`
--
ALTER TABLE `bab`
  ADD CONSTRAINT `bab_ibfk_1` FOREIGN KEY (`elearning_id`) REFERENCES `elearning` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bisnis_investor`
--
ALTER TABLE `bisnis_investor`
  ADD CONSTRAINT `bisnis_investor_ibfk_1` FOREIGN KEY (`investor_foreign`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bisnis_investor_ibfk_2` FOREIGN KEY (`bisnis_foreign`) REFERENCES `bisnis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bisnis_peserta`
--
ALTER TABLE `bisnis_peserta`
  ADD CONSTRAINT `bisnis_peserta_ibfk_1` FOREIGN KEY (`umkm_foreign`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bisnis_peserta_ibfk_2` FOREIGN KEY (`bisnis_foreign`) REFERENCES `bisnis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen_perusahaan`
--
ALTER TABLE `dokumen_perusahaan`
  ADD CONSTRAINT `dokumen_perusahaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elearning`
--
ALTER TABLE `elearning`
  ADD CONSTRAINT `elearning_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eventual`
--
ALTER TABLE `eventual`
  ADD CONSTRAINT `eventual_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eventual_ibfk_2` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `funding`
--
ALTER TABLE `funding`
  ADD CONSTRAINT `funding_ibfk_1` FOREIGN KEY (`bisnis_id`) REFERENCES `bisnis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funding_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investasi`
--
ALTER TABLE `investasi`
  ADD CONSTRAINT `investasi_ibfk_1` FOREIGN KEY (`bisnis_id`) REFERENCES `bisnis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investasi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `janji_temu`
--
ALTER TABLE `janji_temu`
  ADD CONSTRAINT `janji_temu_ibfk_1` FOREIGN KEY (`umkm_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `janji_temu_user_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kajian_finansial`
--
ALTER TABLE `kajian_finansial`
  ADD CONSTRAINT `kajian_finansial_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kegiatan_investor`
--
ALTER TABLE `kegiatan_investor`
  ADD CONSTRAINT `kegiatan_investor_ibfk_1` FOREIGN KEY (`investor_foreign`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kegiatan_investor_ibfk_2` FOREIGN KEY (`kegiatan_foreign`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kegiatan_umkm`
--
ALTER TABLE `kegiatan_umkm`
  ADD CONSTRAINT `kegiatan_umkm_ibfk_1` FOREIGN KEY (`umkm_foreign`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kegiatan_umkm_ibfk_2` FOREIGN KEY (`kegiatan_foreign`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_mentor_id_foreign` FOREIGN KEY (`mentor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `konsultasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logbook`
--
ALTER TABLE `logbook`
  ADD CONSTRAINT `logbook_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logbook_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_pengirim_foreign` FOREIGN KEY (`pengirim`) REFERENCES `users` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  ADD CONSTRAINT `profil_perusahaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tugas_akhir_jawaban`
--
ALTER TABLE `tugas_akhir_jawaban`
  ADD CONSTRAINT `tugas_akhir_jawaban_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_akhir_jawaban_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tugas_akhir_kegiatan`
--
ALTER TABLE `tugas_akhir_kegiatan`
  ADD CONSTRAINT `tugas_akhir_kegiatan_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_akhir_kegiatan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tugas_akhir_soal`
--
ALTER TABLE `tugas_akhir_soal`
  ADD CONSTRAINT `tugas_akhir_soal_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usaha`
--
ALTER TABLE `usaha`
  ADD CONSTRAINT `usaha_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
