-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 06:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `judul` text DEFAULT NULL,
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
('Part 1 Instalasi React Native 12345', 'Video ini berisi tutorial', 'https://www.youtube.com/embed/YR_Or-D8sJI', 1, 1, 1),
('Part 2 Control Flow123', 'Control Flow pada vue', 'https://www.youtube.com/embed/YR_Or-D8sJI', 1, 2, 2),
('Tes123', 'Tes', 'https://www.youtube.com/embed/QmRMfVyWh3Y', 1, 3, 3),
('Cara membuat makanan', 'bab ini berisi tata cara membuat makanan', 'https://www.youtube.com/embed/pdPErbz328k', 4, 4, 1),
('Cara mengolah tebu', 'Video ini berisi cara mengolah tebu', 'https://www.youtube.com/embed/lRxqRRat1DQ', 6, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis`
--

CREATE TABLE `bisnis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto_bisnis` text NOT NULL,
  `jumlah_investasi` bigint(20) NOT NULL DEFAULT 0,
  `target_investasi` bigint(20) NOT NULL,
  `jumlah_investor` mediumint(9) NOT NULL DEFAULT 0,
  `persentase_hasil_investasi` smallint(6) DEFAULT NULL,
  `waktu_balik_modal_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `waktu_balik_modal_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `minimum_investasi` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bisnis`
--

INSERT INTO `bisnis` (`id`, `name`, `foto_bisnis`, `jumlah_investasi`, `target_investasi`, `jumlah_investor`, `persentase_hasil_investasi`, `waktu_balik_modal_start`, `waktu_balik_modal_end`, `minimum_investasi`, `kategori`, `lokasi`, `status`) VALUES
(10, 'Bisnis f0ood', ',investor/foto_bisnis/8kpQA2x4U3w3b8IrrfQ3A6AGUecipM3nL3tKiifg.jpg,investor/foto_bisnis/zcGBhY9TxSzSV26SnrS503sDPYSj2ubfkmS70TVD.jpg', 20000, 40000, 500, NULL, '2022-12-11 17:00:00', '2022-12-29 17:00:00', 60000, 'Bisnis f0ood', 'Bisnis f0ood', 0),
(11, 'deskripsi', ',investor/foto_bisnis/w5q0s40DaXds2OzYtFLUo5ddKO0Rj7EyT7og3Vfu.jpg', 2, 2, 2, NULL, '2022-12-12 17:00:00', '2023-01-12 17:00:00', 2, 'deskripsi', 'deskripsi', 0),
(12, 'deskripsi', ',investor/foto_bisnis/fA05gjBcARIJilbQz0JCsOM7oaRVffk6ZHZGjLwO.jpg', 2, 2, 2, NULL, '2022-12-12 17:00:00', '2023-01-12 17:00:00', 2, 'deskripsi', 'deskripsi', 0),
(13, 'Bisnis Narkoba', ',investor/foto_bisnis/2EPsAI0YL4bB30mL6CPfiWZHP8PgCJ4kbuDINpl9.jpg,investor/foto_bisnis/YfPjVs0gftBZn6Y2AwvXm0ydu1SaEgREcwhSQOzu.jpg', 30000, 20000, 350, NULL, '2022-12-11 17:00:00', '2022-12-27 17:00:00', 40000, 'Makanan', 'Jakarta Pusat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis_investor`
--

CREATE TABLE `bisnis_investor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `bisnis_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bisnis_investor`
--

INSERT INTO `bisnis_investor` (`id`, `status`, `bisnis_id`, `investor_id`) VALUES
(1, NULL, 4, 29),
(2, NULL, 5, 29),
(3, NULL, 6, 29),
(4, NULL, 7, 29),
(5, NULL, 8, 29),
(6, NULL, 9, 29),
(7, NULL, 10, 29),
(8, NULL, 11, 29),
(9, NULL, 12, 29),
(10, NULL, 13, 29);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis_peserta`
--

CREATE TABLE `bisnis_peserta` (
  `id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) UNSIGNED NOT NULL,
  `peserta_type` varchar(10) NOT NULL,
  `bisnis_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, '244', 29, 'umkm/keterangan_halal/WSbsHb3Dl7y85gXRf1S8AGINfEo1fvCbrrxAbhla.jpg', '234234', 'umkm/keterangan_halal/lohLk3xoi72FnucE3IzeFUcHdjn5VP6pmnytnBGl.jpg', '56656', 'umkm/keterangan_halal/rwse6GfFMsithkXdaGFxIvVckAc8c4mwX6tbvFCH.jpg');

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
(1, 3, '2022-11-29 17:00:00', 'Vue Js Coding from scratch', 'elearning/gambar/roJHhJLygk2ToJV57Zcisn5GctI5Kct67loZ7U08.jpg', 'elearning ini berisi tata cara membuat makanan'),
(4, 11, '2022-12-21 17:00:00', 'Cara membuat makanan', 'elearning/gambar/FHW1CQfZfmRPAAcf1sWfatfrVgvHdK3Q0vIknvpA.jpg', 'elearning ini berisi tata cara membuat makanan'),
(5, 12, '2022-12-24 17:00:00', 'Cara Membuat Kue', 'elearning/gambar/IDPQtu97AXYOL7T9aDjwWE15s2gClXOPC2wkIJQc.jpg', 'Elearning ini berisi pembelajaran membuat kue'),
(6, 13, '2022-12-24 17:00:00', 'Cara mengolah tebu bagian 1', 'elearning/gambar/90V3k1QqY1NG1tEpJKrbasGEL41ms5AsN6J2XyDO.jpg', 'Adalah cara mengolah tebu');

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
  `kontak` char(20) DEFAULT NULL,
  `kegiatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventual`
--

INSERT INTO `eventual` (`id`, `perihal`, `status`, `nama_mentor`, `link_meeting`, `waktu`, `profil_id`, `kontak`, `kegiatan_id`, `jadwal`) VALUES
(1, 'ingin latihan laravel', b'000', 'Pak Rahman', 'https://www.youtube.com/watch?v=TNIbWyPNirU', '2022-11-30 08:06:11', 4, 'whatsapp', 3, '2022-11-30 13:24:33'),
(2, 'Belajar PHP', b'001', 'Rahman', 'facebook.com', '2022-11-12 06:08:36', 4, 'email', 3, '2022-11-14 17:00:00'),
(16, 'Perihal cara membuat game', b'001', 'Rahman', NULL, '2022-11-12 15:56:04', 4, 'facebook.com', 3, NULL),
(17, 'Tes123', b'000', 'Gatau', NULL, '2022-11-12 21:14:26', 4, 'Email', 3, NULL),
(18, 'Ingin belajar laravel', b'000', 'Ahmad', NULL, '2022-11-24 14:45:44', 4, 'WA (911)', 3, NULL),
(19, 'belajar laravel', b'000', 'Ahmad', NULL, '2022-11-24 14:46:07', 4, 'WA (911)', 3, NULL),
(24, 'Cara mengolah tebu yang benar', b'001', 'Anton', 'www.facebook.com', '2022-12-26 09:14:07', 29, 'whatsapp 08596276', 13, '2022-12-18 17:00:00');

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
-- Table structure for table `janji_temu`
--

CREATE TABLE `janji_temu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  `lokasi` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bit(3) DEFAULT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `temp_target` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `janji_temu`
--

INSERT INTO `janji_temu` (`id`, `investor_id`, `waktu`, `lokasi`, `status`, `umkm_id`, `temp_target`) VALUES
(2, 29, '2022-12-18 17:00:00', 'Jawa barat Kalisari', b'001', 5, 5),
(3, 29, '2022-12-14 17:00:00', 'jakarta', b'000', 23, NULL);

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
(4, 5, 'capex deh', 'opex deh', 'SWOT INTERNAL DEH', 'SWOT aja dah', 55, 'Gaada', 'Main game', 'Tak ada', 'Adalah teman saya', 'tak ada', '230000', 'Revenue Streams'),
(5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 23, 'capex', 'opex', 'swot', 'swot', 1234, 'key', 'key act', 'value', 'customer', 'channels', 'cost', 'stream'),
(27, 38, 'capex', 'opex', 'Swot faktor internal', 'Swot faktor eksternal', 30, 'Key partners', 'key activity', 'value', 'customer', 'channels', 'structure', 'revenue');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tema` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_orang_diundang` smallint(6) NOT NULL DEFAULT 0,
  `masa_inkubasi` tinyint(4) NOT NULL,
  `kurikulum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_juri` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draft` tinyint(1) NOT NULL DEFAULT 0,
  `dibuat` timestamp NOT NULL DEFAULT '2022-11-08 21:53:23',
  `dimulai` timestamp NOT NULL DEFAULT '2022-11-08 21:53:23',
  `berakhir` timestamp NOT NULL DEFAULT '2022-11-08 21:53:23'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `tema`, `deskripsi`, `gambar`, `link`, `jumlah_orang_diundang`, `masa_inkubasi`, `kurikulum`, `nama_juri`, `pic`, `kontak`, `draft`, `dibuat`, `dimulai`, `berakhir`) VALUES
(3, 'Latihan Membuat Makanan', 'tess', 'umkm/logbook/qsNVsulf159XuFlUbGsbPx75D1uEh0mHPMwKEuKV.jpg', 'gVJgqQPOWUotB3Aq1jn7JqRgBw05U38uOXNcj1EySo2FH7OKEhoT4ybOlPvmO3TSWFQ2150GfDQWdIga03FboiroqJHT7v4vcVEd', 34, 10, '2013', 'Rahman,andi,dll', 'ddwdcwcd', '18218', 1, '2022-11-08 21:53:23', '2022-11-16 17:00:00', '2022-11-29 17:00:00'),
(10, 'Latihan Membuat Makanan', 'Adalah latihan memasak', 'kegiatan/gambar/EFVLmtVpkG8aWuB4CyxiX4h7XrcnfYK9KpomQwzM.jpg', 'XXmmigpEJnx53ESv5f4FGUMlXavNddkwCQDlSHD61PIZVKakJ2OUQ5T73sc6Hp36b95tVkGsrxzma6NjJC55t44BLEWdxRoD1boZ', 30, 3, '2013', 'Eko', 'Eko', '6565', 1, '2022-11-08 21:53:23', '2022-12-21 17:00:00', '2022-12-30 17:00:00'),
(11, 'Latihan kegiatan 1', 'Ini adalah latihan kegiatan', 'kegiatan/gambar/gXOCMmzXMDrQTtNpohnTYbI9pt6flujL49ybHN4f.jpg', 'RxndRoEe2QdrttZrkhW2IwB4Tq6yxstKohrfiKb0qiQ8G0xlQRpxcousC1Ow1RgYAlmdJO1Iv7tS1r93sfHxLLbVoPFz9YDwjuIf', 20, 3, '2013', 'Iqbal', 'Robert', '12345678', 1, '2022-11-08 21:53:23', '2022-12-17 17:00:00', '2022-12-18 17:00:00'),
(12, 'Tes Kegiatan Tester Baru', 'tes 123', 'kegiatan/gambar/4j7kcz1BcZVN6IEucrldIvM2GN06rvPmwAfuOKzc.jpg', '0nvQJdi1JjfNkuiZgWsr5aMKzWe7arciRUbfxMoVVZQCWi192jvH3nH93lCadHeriDApHlSMtuSQHxmmk9Y3kTDKvoUET8gQjF53', 10, 10, '2013', 'Anton', 'Anton', '123456', 1, '2022-11-08 21:53:23', '2022-12-21 17:00:00', '2022-12-15 17:00:00'),
(13, 'Pengolahan Tebu', 'Kegiatan ini adalah kegiatan pengolahan tebu', 'kegiatan/gambar/pduldjK3K29VfCKehliNgzehCzL16m0ckHfPawQV.jpg', 'dycCNzNLhIqwft8YnSagjJc5xCiB4Cim1h1TGRijx5yaF9PFKd05EArpSyZPp5np0aZJjC8Qdou7wRQLWfRpibzRsKRs6k3qMLLP', 10, 3, '2013', 'Rahman,Anto', 'Anto', '23523522', 1, '2022-11-08 21:53:23', '2022-12-25 17:00:00', '2022-12-27 17:00:00'),
(15, 'Kegiaan Pengolahan tebu', 'Kegiatan ini belajar tentang mengolah tebu', 'kegiatan/gambar/vKHI2ym1mPqgGAXr7Js6F2H1tIUey6cNG7rrnewy.jpg', 'y6ZYfakRVxvjlZbRgSnnI7fU8zpTNNt9eSBCwwgCtF1Cr9CW4H6O9qwWJvm9eScX5jrhCcFEVQhR5zunjLYFQeVwo8YDsFTx0JiX', 30, 3, '2013', 'Anton,Wibowo', 'budi', '4235262', 1, '2022-11-08 21:53:23', '2022-12-24 17:00:00', '2022-12-27 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_investor`
--

CREATE TABLE `kegiatan_investor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` int(10) UNSIGNED NOT NULL,
  `kegiatan_id` int(10) UNSIGNED NOT NULL,
  `investor_owner` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_investor`
--

INSERT INTO `kegiatan_investor` (`id`, `investor_id`, `kegiatan_id`, `investor_owner`) VALUES
(2, 6, 3, NULL),
(3, 6, 7, NULL),
(4, 6, 6, NULL),
(5, 6, 7, NULL),
(6, 29, 8, NULL),
(7, 29, 3, NULL),
(8, 6, 9, NULL),
(9, 6, 10, NULL),
(10, 6, 11, NULL),
(11, 6, 12, NULL),
(12, 6, 13, NULL),
(13, 6, 14, NULL),
(14, 6, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_umkm`
--

CREATE TABLE `kegiatan_umkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `umkm_id` bigint(10) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` tinyint(100) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_umkm`
--

INSERT INTO `kegiatan_umkm` (`id`, `umkm_id`, `kegiatan_id`, `nilai`) VALUES
(12, 5, 5, NULL),
(15, 5, 6, NULL),
(16, 5, 6, NULL),
(17, 23, 6, NULL),
(19, 23, 3, NULL),
(20, 5, 3, 80),
(24, 5, 11, 0),
(25, 5, 12, 0),
(27, 5, 14, 0),
(28, 5, 15, 0),
(29, 38, 13, 0);

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
(48, 5, 3, NULL, 'vue js mudah', b'001', 'umkm/logbook/dR8HYLfi7Xn6Ob8IUl8QfKtVassFunymYj2j8PjY.jpg', '2022-11-16 17:00:00'),
(116, 23, 3, NULL, 'laporan', b'000', 'umkm/logbook/34gETHAuxjlgpXVQnqwi5NGtxz1n2zZqRoRKjXO9.jpg', '2022-11-16 17:00:00'),
(117, 23, 3, NULL, 'laporan', b'000', 'umkm/logbook/Q7g0TXICDBxKV71OoTJoogAsLT84CmntHYdTfFM0.jpg', '2022-11-17 17:00:00'),
(129, 5, 3, NULL, 'Tes', b'001', 'umkm/logbook/qVKN04GuPIA4RFvc1DNEUxnJzhGoZD0rN732c1lf.jpg', '2022-11-16 17:00:00'),
(144, 5, 3, NULL, 'Laporan 1', b'001', 'umkm/logbook/RWyWOZfXqYS2tAzlD6KKjXDaRx6xfxMRX1ISlGUX.jpg', '2022-12-26 10:12:11'),
(145, 38, 13, NULL, 'Hari ini belajar cara mengolah tebu', b'001', 'umkm/logbook/Ki2AppwHqL2YZUpIVui6x3us2tc5mlqvpFLvzSEv.jpg', '2022-12-26 16:15:05');

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
  `nama` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `nama`, `pesan`, `tanggal`, `status`, `redirect`) VALUES
(8, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-11-09 07:50:00', NULL, '/profil/1'),
(17, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda diterima !', '2022-11-22 19:21:03', NULL, NULL),
(18, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya !', '2022-11-22 19:22:12', NULL, NULL),
(23, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya !', '2022-11-27 22:21:48', NULL, NULL),
(24, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan SEVLTE ANGULAR di waktu 2022-11-17 00:00:00 diterima!', '2022-11-27 22:39:25', NULL, NULL),
(25, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan SEVLTE ANGULAR di waktu 2022-11-18 00:00:00', '2022-11-27 22:39:46', NULL, NULL),
(27, 23, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-11-29 06:54:18', NULL, '/profil/1'),
(30, 23, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Vue di waktu 2022-11-17 00:00:00 diterima!', '2022-11-29 07:39:35', NULL, NULL),
(31, 23, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan Vue di waktu 2022-11-17 00:00:00', '2022-11-29 07:43:34', NULL, NULL),
(33, 7, 'Pengajuan Data Baru', 'Seorang investor mengajukan data barunya', '2022-12-08 18:05:59', NULL, '29'),
(34, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Vue Js Mudah Sekali di waktu 2022-11-17 00:00:00 diterima!', '2022-12-08 20:05:12', NULL, NULL),
(35, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan Vue Js Mudah Sekali di waktu 2022-11-17 00:00:00', '2022-12-08 20:05:28', NULL, NULL),
(36, 5, 'Laporan anda ditolak', 'Mohon perbaiki lagi laporannya pada kegiatanLatihan Vue Js Mudah Sekali di waktu 2022-11-17 00:00:00', '2022-12-08 20:09:34', NULL, NULL),
(39, 5, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-12-23 10:23:51', NULL, '/profil/1'),
(41, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:13:00', NULL, NULL),
(42, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:13:14', NULL, NULL),
(43, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:14:40', NULL, NULL),
(44, 5, 'Eventual Dibatalkan', 'Eventual yang anda minta pada kegiatan Tes Kegiatan Tester Baru tanggal 2022-12-23 00:00:00 sudah dihapus. Kontak admin bila terjadi kesalahan', '2022-12-24 10:18:05', NULL, NULL),
(45, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Membuat Makanan di waktu 2022-12-26 17:12:11 diterima!', '2022-12-26 10:41:44', NULL, NULL),
(46, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Membuat Makanan di waktu 2022-11-17 00:00:00 diterima!', '2022-12-26 10:52:30', NULL, NULL),
(47, 5, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Latihan Membuat Makanan di waktu 2022-11-17 00:00:00 diterima!', '2022-12-26 10:52:34', NULL, NULL),
(48, 7, 'Pengajuan Data Baru', 'Seorang user mengajukan data barunya', '2022-12-26 14:27:24', NULL, '37'),
(50, 38, 'Aktivasi sukes', 'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka', '2022-12-26 15:20:58', NULL, '/profil/1'),
(51, 7, 'Pengajuan Eventual', 'Seorang user mengajukan untuk meeting', '2022-12-26 16:14:07', NULL, '38'),
(52, 38, 'Laporan anda ditrima', 'Selamat!,laporan anda pada kegiatan Pengolahan Tebu di waktu 2022-12-26 23:15:05 diterima!', '2022-12-26 16:17:49', NULL, NULL);

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
(14, 23, 'produk', 2, 'bahan', 'kategori', 2000, 'umkm/keterangan_halal/eJ0cj5Ome3SbfMm3F5vj3pjSsglS9Zontx5GJpc3.pdf', 'manfaat', 'non'),
(27, 38, 'Makanan', 20000, 'Makanan', 'Makanan', 30000, 'umkm/keterangan_halal/27gqU3hnG3JSoHtkmXtYiwJSIErTUXaXxmhNoc4c.pdf', 'Bisa untuk dimakan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foto_profil` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` timestamp NULL DEFAULT NULL,
  `pendidikan_terakhir` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_kelahiran` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(4, 5, 'umkm/foto_profil/ypD4GVHEt7hXbo8xUpclizf4ywyAui8IFBem0uMh.jpg', 'Tono', '2022-11-12 17:00:00', 'SMA', 'Sleman', 'Rumah Sakit', 'Kalisari', 'PasarRebo', 'sadsadasd', 'Jawa Tengah', 'umkm/foto_ktp/2YY1gJmBK4PjN7icPb47qvHGYZUtIrnHyKQl3Yav.jpg', 'umkm/foto_selfie_ktp/qHIIzUcKbOR4RRzCh0QIygkDGzUS0Rf0ElyKnu8d.jpg', '0345355', 'Aktif', 'Indonesia', 'Islam', 'Mengikuti ISNA'),
(5, 6, NULL, 'Ahmad Rahman', '2022-11-15 06:44:16', 'SMA', 'Sleman', 'Jalan Sleman 1', 'Kalisari', 'Pasar Rebo', 'Jakartajakarta', NULL, NULL, NULL, '234324', 'aktif', 'indonesia', 'islam', 'gaada\r\n'),
(6, 7, 'umkm/foto_profil/u1LgaWon1X5BTJsrovo8oLWi2tkvohQXuCFhR7Rs.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 23, 'umkm/foto_profil/nlw24tR5SPjjmKTfaNvnVo18NhX6MvAEDhnjrhi6.png', 'rahmah', '2022-11-16 17:00:00', 'sma', 'manado', 'rumah', 'kel', 'kec', 'kab', 'banten', 'umkm/foto_ktp/lpFgXNeUseUUHGWBTPEdv3lpx1qs1QsLRKfCZeUM.png', 'umkm/foto_selfie_ktp/mjYxzdhBywmzAf2H3F7GU4Hex9PNf63OJa4zMvTU.png', '263623', 'stat', 'indo', 'islam', 'tidak'),
(20, 29, 'umkm/foto_profil/Sei62vVsHcnpq78cHQq6yZzVsERe1AAnygxNxfcG.jpg', 'Arman', '2022-12-11 17:00:00', 'SMA', 'Sleman', 'JL Tempat TInggal', 'Kalisari', 'PAsar Rebo', 'gatau', 'Serang', 'umkm/foto_ktp/a95FvNbYnbDi4fSVgxDx1JPVf6JLlWggjbDFK6IB.jpg', 'umkm/foto_selfie_ktp/sQxA8pxkTVMgWIPrIkzst1p0C5fTSF0e9JKdNgD5.jpg', '1121212', 'gTu', 'Indonesia', 'Islam', 'Pernah ikut mbkm'),
(29, 38, 'umkm/foto_profil/rm8jQmA3nYbRH9lPqmGcGUXjPeRyOif2t5UUwRaG.jpg', 'Budi', '2022-12-17 17:00:00', 'SMA', 'Jakarta', 'Jalan Pesona Indah', 'Kalisari', 'Pasar Rebo', '-', 'DKI Jakarta', 'umkm/foto_ktp/yXpJ6kyJEXQlYJ4FQ67IJGd0kfQujm4PlFsATPbo.jpg', 'umkm/foto_selfie_ktp/8oNmnJR9arDeE32igYobOzz1ZQkxsyMPo9CrL98Z.jpg', '0827323232', 'Belum Kawin', 'Indonesia', 'Islam', 'Kerja sukarela');

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
  `email_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_perusahaan`
--

INSERT INTO `profil_perusahaan` (`id`, `user_id`, `nama_perusahaan`, `alamat_perusahaan`, `nama_pic`, `tanggal_berdiri`, `nomor_telepon`, `email_pic`) VALUES
(3, 29, 'Perushaaan', 'Perushaaan', 'Perushaaan', '2022-12-19 17:00:00', '2334', 'Perushaaan');

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
(3, 'tes', 'oudhausd', '2022-11-30 06:42:26', '2022-11-30 06:42:26', 6, 3),
(4, NULL, NULL, NULL, NULL, 7, 1),
(13, NULL, NULL, NULL, NULL, 23, 2),
(17, NULL, NULL, NULL, NULL, 29, 3),
(26, NULL, NULL, NULL, NULL, 38, 2);

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
-- Table structure for table `usaha`
--

CREATE TABLE `usaha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_perusahaan` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perusahaan` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legalitas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_amdal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informasi_pajak` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_usaha` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usaha`
--

INSERT INTO `usaha` (`id`, `user_id`, `nama_perusahaan`, `alamat_perusahaan`, `status_perusahaan`, `legalitas`, `dokumen_amdal`, `informasi_pajak`, `npwp`, `deskripsi_usaha`, `email_perusahaan`) VALUES
(4, 5, 'perusahaan makanan', 'Jalan Alamat 123', 'Aktif', 'umkm/dokumen_legalitas/clg0gDqRqypp5kDQeHQIyOXsVXazFh6rcL1DcVwR.pdf', 'umkm/dokumen_amdal/ljbj41b10NKM4yKJBOHb1c0n7Yk7aAYDEtwTIqp3.pdf', 'Pajak aktif', '66265', 'Usaha ini milik saya sendiri', 'samba@upi.edii'),
(5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 23, 'perusahaan', 'alamat', 'stat', 'umkm/dokumen_legalitas/Fg3lt1jqRzw7oqMFVAv2fzmGnriudIC1dU81OoP1.pdf', 'umkm/dokumen_amdal/xdhotX2dDb0cgkeZIvNpsu8BfAbOr7PnWx5jxwqF.pdf', 'pajak', 'npwp', 'usaha', 'perusahaan'),
(27, 38, 'Perusahaan makanan', 'Jalan pesona indah 1', 'Aktif', 'umkm/dokumen_legalitas/AMIE4CrnBsxSzrQRQZA4fakTc5XAeLsRt3rJdPVE.pdf', 'umkm/dokumen_amdal/RGa0VbI3L6abnhINnxLYZ9QyrSpdyEqLE9cgZYvT.pdf', 'Pajak aktif', '4142515', 'Usaha ini milik Probadi', 'usaha@usaha.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `video_tertonton` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_telepon`, `email_verified_at`, `remember_token`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `provider_id`, `provider_token`, `role`, `accepted`, `notifikasi`, `created_at`, `updated_at`, `video_tertonton`) VALUES
(5, 'MUHAMMAD SAMBA', 'samba@upi.edu', NULL, '2022-11-08 23:10:45', 'w2sAkbaZ9qg4wEivvOckyGubdYux2unZtNeM9LduEJMIFe3Tqim2GwByCjKN', '$2y$10$poDrUbeJQN/IanvKiEnaTekRZQoylmeld/JJipHRmrqq.KJShWh1a', NULL, NULL, NULL, '111968172218430437214', 'ya29.a0AeTM1id7YmPNzj46CHmoFFmZ7zBMq1GNCJdjZ3Sb-9aKxAz1J-XaJlINsZOT1gDl1WQi_I-Wnfhx_3CoxoJpBbdRtI_fhCFLWBT-GZyzmYS_yWpH09sEHDvaXhgRuqZ9P3NSVVMnoV-QI0sNY18h-h5ESNj0kwaCgYKAeASARESFQHWtWOmN3rblHCboaiWG2iXp0VxUg0165', NULL, 1, 0, '2022-11-08 23:10:45', '2022-12-24 03:19:52', NULL),
(6, 'rahman', 'rahman@rahman.com', '945454864', '2022-11-30 06:32:19', NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(7, 'Kelompok 3 _ Muhammad Samba Al Faraby', 'assassinscheep@gmail.com', NULL, '2022-11-09 00:23:01', 'apA9O7NTFTFdisjfpibbBzMBp7NophgCsTltFOBL8rN1HgY3ysUmZ2HuhmR2', '$2y$10$F7zPkSwqQNMjZgaKAkOs7ekWU1hWP7ZGBHJwMSwt7Og0ELYNGhLMO', NULL, NULL, NULL, '108953706873143162955', 'ya29.a0AeTM1ifSXZnfuPBnfuVLO-0H-ctovQm18A0rPMnA54Bs2jli-de2sBqHf4EPzO-Yz4283cnstPE8j8gaAPguR_xlc8gW2YK_OSvbc4kFVF9D8QPOxEMIlWERO-9kV9LXUlEDVGDblfoF-HeBltL0xzxZSlaLaCgYKAVMSARASFQHWtWOmHYTwEwki2pMB_ZWqVZ7_2w0163', NULL, NULL, 0, '2022-11-09 00:23:01', '2022-12-26 09:15:49', NULL),
(23, NULL, 'nrahmahtsania@gmail.com', '+6285778147853', '2022-11-28 22:58:15', NULL, '$2y$10$H1y2JFIxvUlJRzay6am6vOH7.njyvXiFkft3/p/YdnOGPMxkrGLnm', NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2022-11-28 22:57:39', '2022-11-29 00:07:02', NULL),
(29, NULL, 'muhammad.samba@citiasiainc.id', '+6223234343', '2022-12-07 15:38:44', 'oIenm7dUVNWtfaPW5p2Haq0F5UTyH6icKCFkKEydIwjB72lr0KIaPaLwIkUM', '$2y$10$337pfy.cfagLsRsR3NQgketdkh7TXWZA5wzyKWbvB4L6qOZPsa1oy', NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2022-12-07 14:38:31', '2022-12-07 15:38:44', NULL),
(38, NULL, 'sambaalfarabi@yahoo.com', '+62827327382', '2022-12-26 08:11:25', 'AIUnKDn9xXPPj07se6efITvjrYPNhTaciOVK1kYKf8RC4gqT6aBvvSmYfSu5', '$2y$10$HTxXUUInY7eGWxLoSOV1geZUI2f0RS06baLDnjX1qu.gTpHkabb.i', NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2022-12-26 08:10:46', '2022-12-26 08:22:11', NULL);

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `investor_owner` (`investor_owner`);

--
-- Indexes for table `kegiatan_umkm`
--
ALTER TABLE `kegiatan_umkm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultasi_user_id_foreign` (`user_id`),
  ADD KEY `konsultasi_mentor_id_foreign` (`mentor_id`);

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
-- Indexes for table `tugas_akhir_kegiatan`
--
ALTER TABLE `tugas_akhir_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bisnis`
--
ALTER TABLE `bisnis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bisnis_investor`
--
ALTER TABLE `bisnis_investor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_perusahaan`
--
ALTER TABLE `dokumen_perusahaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `elearning`
--
ALTER TABLE `elearning`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eventual`
--
ALTER TABLE `eventual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `janji_temu`
--
ALTER TABLE `janji_temu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kajian_finansial`
--
ALTER TABLE `kajian_finansial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kegiatan_investor`
--
ALTER TABLE `kegiatan_investor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kegiatan_umkm`
--
ALTER TABLE `kegiatan_umkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tugas_akhir_kegiatan`
--
ALTER TABLE `tugas_akhir_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usaha`
--
ALTER TABLE `usaha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bab`
--
ALTER TABLE `bab`
  ADD CONSTRAINT `bab_ibfk_1` FOREIGN KEY (`elearning_id`) REFERENCES `elearning` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `kegiatan_investor_ibfk_1` FOREIGN KEY (`investor_owner`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `tugas_akhir_kegiatan`
--
ALTER TABLE `tugas_akhir_kegiatan`
  ADD CONSTRAINT `tugas_akhir_kegiatan_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_akhir_kegiatan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `usaha`
--
ALTER TABLE `usaha`
  ADD CONSTRAINT `usaha_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
