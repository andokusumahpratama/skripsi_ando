-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2023 at 05:50 AM
-- Server version: 5.7.33
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pt_abe`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `harga_beli`, `created_at`, `updated_at`) VALUES
(1, 'gas 3KG', 11000, '2023-03-18 20:25:33', '2023-04-28 09:35:17'),
(2, 'gas 5,5KG', 90000, '2023-03-18 20:31:03', '2023-04-28 03:50:42'),
(4, 'gas 12KG', 196500, '2023-03-26 08:02:11', '2023-04-28 03:50:34'),
(6, 'gas 50KG', 850000, '2023-03-26 20:51:56', '2023-05-02 05:44:29'),
(22, 'gas 100KG', 10000, '2023-05-04 23:53:04', NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hutang_pembelian` int(11) DEFAULT NULL,
  `hutang_tabung` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barangss_id` bigint(20) UNSIGNED NOT NULL,
  `pangkalan_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id`, `hutang_pembelian`, `hutang_tabung`, `created_at`, `updated_at`, `barangss_id`, `pangkalan_id`) VALUES
(15, 370000, 2, '2023-04-02 08:01:55', '2023-04-02 08:14:32', 6, 4),
(16, 101000, 5, '2023-04-02 08:06:51', '2023-04-02 08:12:28', 2, 3),
(17, 15000, 2, '2023-04-02 08:10:06', '2023-04-28 09:44:24', 2, 1),
(18, 0, 1, '2023-04-02 08:11:35', NULL, 1, 2),
(19, 282000, 4, '2023-04-02 08:16:47', '2023-04-02 08:20:20', 4, 5),
(46, 1753530, 7, '2023-04-02 23:19:31', '2023-04-02 23:19:31', 4, 6),
(53, 5133717, 6, '2023-04-02 23:28:55', '2023-04-02 23:28:55', 6, 7),
(56, 1355122, 10, '2023-04-03 00:35:42', '2023-04-03 00:35:43', 4, 8),
(60, 268509, 3, '2023-04-03 00:37:49', '2023-04-03 00:37:50', 2, 9),
(61, 559906, 4, '2023-04-03 00:38:42', '2023-04-03 00:38:43', 2, 10),
(68, 1005261, 9, '2023-04-03 00:42:17', '2023-04-03 00:42:18', 2, 11),
(69, 1365680, 6, '2023-04-03 00:42:40', '2023-04-03 00:42:40', 4, 12),
(70, 175147, 7, '2023-04-03 00:43:09', '2023-04-03 00:43:10', 1, 13),
(72, 4532051, 5, '2023-04-03 00:48:19', '2023-04-03 00:48:19', 6, 14),
(74, 842381, 8, '2023-04-03 00:53:02', '2023-04-03 00:53:02', 2, 15),
(77, 452180, 2, '2023-04-03 01:00:08', '2023-04-03 01:00:09', 2, 16),
(78, 126605, 0, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 4, 16),
(79, 13172, 1, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 1, 16),
(80, 574953, 10, '2023-04-03 05:05:18', '2023-04-03 05:08:32', 2, 17),
(81, 304292, 2, '2023-04-03 05:05:19', '2023-04-03 05:08:28', 4, 17),
(87, 3840, 0, '2023-04-03 07:09:40', '2023-04-03 07:09:40', 1, 18),
(88, 270944, 0, '2023-04-03 07:09:41', '2023-04-03 07:09:41', 2, 18),
(89, 73367, 1, '2023-04-03 07:09:41', '2023-04-03 07:09:41', 4, 18),
(90, 509929, 2, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 2, 19),
(91, 16468, 3, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 1, 19),
(92, 814013, 4, '2023-04-03 07:55:37', '2023-04-03 07:55:38', 4, 19),
(96, 24636, 4, '2023-04-03 07:59:41', '2023-04-03 07:59:41', 1, 20),
(97, 174984, 4, '2023-04-03 07:59:41', '2023-04-03 07:59:42', 2, 20),
(98, 202700, 2, '2023-04-03 07:59:41', '2023-04-03 07:59:41', 4, 20),
(99, 257693, 3, '2023-03-28 04:26:40', '2023-05-03 06:49:56', 2, 21),
(100, 396260, 1, '2023-03-14 07:58:17', '2023-04-03 21:32:07', 6, 21),
(101, 532012, 2, '2023-03-23 18:00:30', '2023-04-03 21:32:07', 4, 21),
(102, 879808, 6, '2023-03-20 15:32:29', '2023-04-03 21:40:33', 4, 22),
(103, 443965, 3, '2023-02-21 23:23:22', '2023-04-03 21:40:34', 2, 22),
(104, 114645, 2, '2023-03-12 16:16:46', '2023-04-05 23:51:52', 2, 23),
(105, 1370142, 5, '2023-02-25 12:22:47', '2023-04-05 23:51:52', 4, 23),
(110, 0, 0, '2023-05-05 00:31:26', '2023-05-05 02:22:29', 22, 34);

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Karyawan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jual_tabung`
--

CREATE TABLE `jual_tabung` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barangt_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jual_tabung`
--

INSERT INTO `jual_tabung` (`id`, `harga_jual`, `created_at`, `updated_at`, `barangt_id`) VALUES
(1, 95000, '2023-03-18 20:42:25', '2023-03-18 20:44:54', 2),
(2, 99000, '2023-03-18 20:42:52', NULL, 2),
(4, 106000, '2023-03-18 21:06:09', NULL, 2),
(5, 22000, '2023-03-18 21:12:17', NULL, 1),
(8, 208000, '2023-03-26 08:02:56', NULL, 4),
(9, 213000, '2023-03-26 08:03:13', NULL, 4),
(11, 880000, '2023-03-26 20:52:06', NULL, 6),
(29, 10001, '2023-05-04 23:53:09', NULL, 22);

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama_karyawan`, `jenis_kelamin`, `tanggal_lahir`, `pendidikan`, `profile_image`, `created_at`, `updated_at`, `jabatan_id`, `user_id`) VALUES
(1, 'Hj Susi', 'Perempuan', '1976-03-15', 'S1', NULL, NULL, '2023-03-18 04:08:09', 1, 10),
(2, 'Ando Kusumah', 'Pria', '2001-10-25', 'S1', 'upload/admin_image/1760691025461181.jpeg', '2023-03-18 00:50:10', '2023-03-20 17:57:04', 1, 11),
(3, 'Brenda Angelina', 'Perempuan', '2004-10-09', 'S1', NULL, '2023-03-18 01:54:04', '2023-03-18 02:05:29', 2, 12);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_14_004721_create_jabatans_table', 1),
(6, '2023_03_14_010808_add_id_jabatan_on_table_users', 2),
(7, '2023_03_14_042318_add_profile_image_on_users_table', 3),
(15, '2023_03_17_103051_create_karyawans_table', 4),
(16, '2023_03_17_103903_add_id_jabatan_to_karyawan_table', 4),
(17, '2023_03_18_101432_create_pangkalans_table', 5),
(19, '2023_03_18_125029_create_barangs_table', 6),
(20, '2023_03_19_003200_create_jual_tabung_table', 7),
(21, '2023_03_19_003412_add_id_barang_on_table_jual_tabung', 8),
(22, '2023_03_19_053904_create_stok_barang_table', 9),
(23, '2023_03_19_054541_add_id_barang_to_stok_barang_table', 9),
(24, '2023_03_22_022256_create_transaksi__dos_table', 10),
(25, '2023_03_22_022620_add_id_barang_to_pembelian_tabung_table', 10),
(26, '2023_03_22_022856_add_tanggal_transaksi_to_pembelian_tabung_table', 11),
(27, '2023_03_22_024606_add_id_barang_to_pembelian_tabung_table', 12),
(28, '2023_03_23_043944_add_id_barangs_to_pembelian_tabung_table', 13),
(35, '2023_03_28_025608_create_transaksis_table', 14),
(36, '2023_03_28_033323_add_pangakalan_id_and_barangss_id_to_table_transaksis', 14),
(37, '2023_03_28_091832_add_table__hutang', 14),
(38, '2023_03_28_092721_add_pangkalans_id_to__hutang_table', 14),
(39, '2023_05_03_165747_create_transaksi_hutang_table', 15),
(42, '2023_05_03_230528_add_pangkalanss_id_and_barangs__id_to_table_transaksi_hutang', 16);

-- --------------------------------------------------------

--
-- Table structure for table `pangkalans`
--

CREATE TABLE `pangkalans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pangkalan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pangkalans`
--

INSERT INTO `pangkalans` (`id`, `nama_pangkalan`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 'Hj. Udins', 'Bogor Raya Permai Blok FE 5 No 11', '081806995247', NULL, '2023-03-18 04:06:08'),
(2, 'Nurdin', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, '2023-03-18 04:11:11'),
(3, 'Hj Dede', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(4, 'Roni', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(5, 'Nunung & Rohandi', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(6, 'H Denis', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(7, 'Ade/Amih', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(8, 'Rajiv', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(9, 'H Jamaludin', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(10, 'Titi Aryani', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(11, 'Udeh', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(12, 'Hanapi', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(13, 'Lukman', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(14, 'Saimun', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(15, 'Roby & Een', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(16, 'Irwantoni', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(17, 'Supatra', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(18, 'H Ratib', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(19, 'Nurhasanah', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(20, 'Cicih Lidyawati', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(21, 'Komod', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(22, 'Sohibul', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(23, 'H Darsiwan', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(24, 'Carwiti', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(25, 'Henhen', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(26, 'Ajiz', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(27, 'Adri Febrian', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(28, 'Cecep Juhaeri', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(29, 'Suparman', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(30, 'Tarlim', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(31, 'Taryono S.IP', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(33, 'Cece', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL),
(34, 'Ajuh', 'Jl. Subang Pamanukan No.212, Pagaden Jawa Barat 41252', '081806995247', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_tabung`
--

CREATE TABLE `pembelian_tabung` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_masuk_isi` int(11) NOT NULL,
  `barang_keluar_kosong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_transaksi` date NOT NULL,
  `barangs_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian_tabung`
--

INSERT INTO `pembelian_tabung` (`id`, `barang_masuk_isi`, `barang_keluar_kosong`, `created_at`, `updated_at`, `tanggal_transaksi`, `barangs_id`) VALUES
(11, 100, 100, '2023-03-27 00:11:11', '2023-04-02 07:54:28', '2023-04-02', 1),
(12, 100, 100, '2023-03-27 06:45:52', NULL, '2022-10-25', 4),
(13, 100, 100, '2023-03-27 06:46:53', NULL, '2023-01-25', 2),
(14, 100, 100, '2023-03-27 06:48:00', NULL, '2023-01-25', 2),
(15, 100, 100, '2023-03-27 06:48:41', NULL, '2023-01-25', 2),
(16, 200, 200, '2023-04-03 23:26:11', NULL, '2023-04-04', 4),
(17, 10, 10, '2023-04-27 19:00:01', NULL, '2023-10-10', 2),
(18, 50, 0, '2023-04-27 19:24:01', NULL, '2023-04-25', 4),
(19, 250, 0, '2023-04-28 02:38:42', NULL, '2023-04-28', 1);

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_stok_isi` int(11) DEFAULT NULL,
  `jumlah_stok_kosong` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`id`, `jumlah_stok_isi`, `jumlah_stok_kosong`, `created_at`, `updated_at`, `barang_id`) VALUES
(3, 250, 0, '2023-03-27 00:00:20', '2023-04-27 19:24:01', 4),
(4, 250, 0, '2023-03-27 00:00:39', '2023-04-28 02:38:42', 1),
(21, 50, 50, '2023-05-05 00:29:28', '2023-05-05 02:22:29', 22);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penebusan_tabung` int(11) NOT NULL,
  `kembali_kabung` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jual_tabung_id` bigint(20) UNSIGNED NOT NULL,
  `pangkalan_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `penebusan_tabung`, `kembali_kabung`, `pembayaran`, `created_at`, `updated_at`, `jual_tabung_id`, `pangkalan_id`) VALUES
(13, 10, 10, 950000, '2023-04-02 07:56:28', NULL, 1, 1),
(14, 2, 2, 198000, '2023-04-02 07:57:43', NULL, 2, 1),
(15, 15, 15, 330000, '2023-04-02 07:58:24', NULL, 5, 2),
(16, 5, 5, 530000, '2023-04-02 07:58:59', NULL, 4, 3),
(17, 20, 20, 440000, '2023-04-02 07:59:47', NULL, 5, 2),
(18, 2, 2, 1760000, '2023-04-02 08:00:40', NULL, 11, 4),
(19, 4, 4, 424000, '2023-04-02 08:01:22', NULL, 4, 3),
(20, 2, 1, 1500000, '2023-04-02 08:01:55', NULL, 11, 4),
(21, 3, 3, 285000, '2023-04-02 08:03:16', NULL, 1, 1),
(22, 13, 13, 286000, '2023-04-02 08:03:40', NULL, 5, 2),
(23, 5, 5, 495000, '2023-04-02 08:04:09', NULL, 2, 3),
(24, 1, 1, 800000, '2023-04-02 08:05:11', NULL, 11, 4),
(25, 6, 6, 570000, '2023-04-02 08:06:00', NULL, 1, 1),
(26, 25, 25, 550000, '2023-04-02 08:06:25', NULL, 5, 2),
(27, 10, 5, 1050000, '2023-04-02 08:06:51', NULL, 4, 3),
(28, 1, 1, 880000, '2023-04-02 08:08:48', NULL, 11, 4),
(29, 7, 5, 650000, '2023-04-02 08:10:06', NULL, 1, 1),
(30, 8, 7, 176000, '2023-04-02 08:11:34', NULL, 5, 2),
(31, 9, 9, 800000, '2023-04-02 08:12:28', NULL, 2, 3),
(32, 1, 0, 850000, '2023-04-02 08:14:31', NULL, 11, 4),
(33, 6, 6, 1248000, '2023-04-02 08:16:20', NULL, 8, 5),
(34, 4, 3, 820000, '2023-04-02 08:16:47', NULL, 8, 5),
(35, 6, 6, 1000000, '2023-04-02 08:18:44', NULL, 8, 5),
(36, 4, 3, 810000, '2023-04-02 08:19:34', NULL, 8, 5),
(37, 3, 1, 624000, '2023-04-02 08:20:20', NULL, 8, 5),
(65, 1, 1, 179317, '2023-04-02 23:19:31', '2023-04-02 23:19:31', 9, 6),
(66, 14, 11, 2197827, '2023-04-02 23:19:31', '2023-04-02 23:19:31', 9, 6),
(67, 8, 8, 1277501, '2023-04-02 23:19:31', '2023-04-02 23:19:31', 9, 6),
(68, 12, 8, 2066316, '2023-04-02 23:19:31', '2023-04-02 23:19:31', 9, 6),
(69, 1, 1, 193509, '2023-04-02 23:19:31', '2023-04-02 23:19:31', 9, 6),
(77, 13, 12, 9419794, '2023-04-02 23:28:55', '2023-04-02 23:28:55', 11, 7),
(78, 12, 8, 9047752, '2023-04-02 23:28:55', '2023-04-02 23:28:55', 11, 7),
(79, 3, 3, 2489890, '2023-04-02 23:28:55', '2023-04-02 23:28:55', 11, 7),
(80, 4, 4, 2477775, '2023-04-02 23:28:55', '2023-04-02 23:28:55', 11, 7),
(81, 2, 1, 1351072, '2023-04-02 23:28:55', '2023-04-02 23:28:55', 11, 7),
(84, 14, 12, 2932940, '2023-04-03 00:35:42', '2023-04-03 00:35:42', 9, 8),
(85, 10, 9, 1553529, '2023-04-03 00:35:42', '2023-04-03 00:35:42', 9, 8),
(86, 3, 3, 625155, '2023-04-03 00:35:42', '2023-04-03 00:35:42', 9, 8),
(87, 12, 9, 2515375, '2023-04-03 00:35:43', '2023-04-03 00:35:43', 9, 8),
(88, 13, 9, 2093879, '2023-04-03 00:35:43', '2023-04-03 00:35:43', 9, 8),
(92, 8, 6, 571179, '2023-04-03 00:37:49', '2023-04-03 00:37:49', 2, 9),
(93, 6, 5, 593089, '2023-04-03 00:37:49', '2023-04-03 00:37:49', 2, 9),
(94, 1, 1, 88776, '2023-04-03 00:37:49', '2023-04-03 00:37:49', 2, 9),
(95, 2, 2, 187817, '2023-04-03 00:37:50', '2023-04-03 00:37:50', 2, 9),
(96, 1, 1, 72630, '2023-04-03 00:37:50', '2023-04-03 00:37:50', 2, 9),
(97, 6, 6, 510855, '2023-04-03 00:38:42', '2023-04-03 00:38:42', 2, 10),
(98, 2, 1, 152029, '2023-04-03 00:38:42', '2023-04-03 00:38:42', 2, 10),
(99, 4, 4, 309533, '2023-04-03 00:38:42', '2023-04-03 00:38:42', 2, 10),
(100, 15, 13, 1229601, '2023-04-03 00:38:42', '2023-04-03 00:38:42', 2, 10),
(101, 8, 7, 703076, '2023-04-03 00:38:43', '2023-04-03 00:38:43', 2, 10),
(109, 13, 10, 1049141, '2023-04-03 00:42:17', '2023-04-03 00:42:17', 2, 11),
(110, 9, 8, 698635, '2023-04-03 00:42:17', '2023-04-03 00:42:17', 2, 11),
(111, 13, 9, 1024828, '2023-04-03 00:42:17', '2023-04-03 00:42:17', 2, 11),
(112, 10, 9, 693803, '2023-04-03 00:42:17', '2023-04-03 00:42:17', 2, 11),
(113, 1, 1, 82332, '2023-04-03 00:42:17', '2023-04-03 00:42:17', 2, 11),
(114, 2, 1, 348743, '2023-04-03 00:42:40', '2023-04-03 00:42:40', 8, 12),
(115, 3, 3, 613820, '2023-04-03 00:42:40', '2023-04-03 00:42:40', 8, 12),
(116, 10, 9, 1705331, '2023-04-03 00:42:40', '2023-04-03 00:42:40', 8, 12),
(117, 10, 8, 1775261, '2023-04-03 00:42:40', '2023-04-03 00:42:40', 8, 12),
(118, 14, 12, 2303165, '2023-04-03 00:42:40', '2023-04-03 00:42:40', 8, 12),
(119, 15, 11, 295411, '2023-04-03 00:43:09', '2023-04-03 00:43:09', 5, 13),
(120, 8, 8, 127374, '2023-04-03 00:43:09', '2023-04-03 00:43:09', 5, 13),
(121, 2, 1, 41535, '2023-04-03 00:43:10', '2023-04-03 00:43:10', 5, 13),
(122, 16, 14, 264503, '2023-04-03 00:43:10', '2023-04-03 00:43:10', 5, 13),
(123, 5, 5, 108030, '2023-04-03 00:43:10', '2023-04-03 00:43:10', 5, 13),
(125, 4, 4, 2930680, '2023-04-03 00:48:18', '2023-04-03 00:48:18', 11, 14),
(126, 6, 5, 4718720, '2023-04-03 00:48:19', '2023-04-03 00:48:19', 11, 14),
(127, 16, 12, 11631300, '2023-04-03 00:48:19', '2023-04-03 00:48:19', 11, 14),
(128, 2, 2, 1409582, '2023-04-03 00:48:19', '2023-04-03 00:48:19', 11, 14),
(129, 13, 13, 10857667, '2023-04-03 00:48:19', '2023-04-03 00:48:19', 11, 14),
(135, 5, 3, 367855, '2023-04-03 00:53:02', '2023-04-03 00:53:02', 1, 15),
(136, 12, 11, 998407, '2023-04-03 00:53:02', '2023-04-03 00:53:02', 1, 15),
(137, 5, 3, 434993, '2023-04-03 00:53:02', '2023-04-03 00:53:02', 1, 15),
(138, 17, 14, 1290535, '2023-04-03 00:53:02', '2023-04-03 00:53:02', 1, 15),
(139, 13, 13, 1005829, '2023-04-03 00:53:02', '2023-04-03 00:53:02', 1, 15),
(142, 17, 16, 1471001, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 2, 16),
(143, 5, 5, 938395, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 9, 16),
(144, 10, 9, 751771, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 1, 16),
(145, 2, 1, 30828, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 5, 16),
(146, 20, 20, 1938048, '2023-04-03 01:00:08', '2023-04-03 01:00:08', 2, 16),
(147, 2, 2, 175843, '2023-04-03 05:05:18', '2023-04-03 05:05:18', 4, 17),
(148, 14, 9, 1167435, '2023-04-03 05:05:19', '2023-04-03 05:05:19', 1, 17),
(149, 6, 4, 459602, '2023-04-03 05:05:19', '2023-04-03 05:05:19', 4, 17),
(150, 9, 7, 1567708, '2023-04-03 05:05:19', '2023-04-03 05:05:19', 8, 17),
(151, 7, 4, 465167, '2023-04-03 05:05:19', '2023-04-03 05:05:19', 1, 17),
(162, 19, 19, 414160, '2023-04-03 07:09:40', '2023-04-03 07:09:40', 5, 18),
(163, 3, 3, 233078, '2023-04-03 07:09:41', '2023-04-03 07:09:41', 4, 18),
(164, 2, 1, 342633, '2023-04-03 07:09:41', '2023-04-03 07:09:41', 8, 18),
(165, 7, 7, 576121, '2023-04-03 07:09:41', '2023-04-03 07:09:41', 4, 18),
(166, 10, 10, 1039857, '2023-04-03 07:09:41', '2023-04-03 07:09:41', 4, 18),
(167, 19, 19, 1689123, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 2, 19),
(168, 9, 6, 181532, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 5, 19),
(169, 7, 5, 1134433, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 8, 19),
(170, 11, 9, 847948, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 4, 19),
(171, 18, 16, 3251554, '2023-04-03 07:55:37', '2023-04-03 07:55:37', 8, 19),
(177, 13, 9, 261364, '2023-04-03 07:59:41', '2023-04-03 07:59:41', 5, 20),
(178, 10, 10, 951691, '2023-04-03 07:59:41', '2023-04-03 07:59:41', 2, 20),
(179, 12, 10, 2353300, '2023-04-03 07:59:41', '2023-04-03 07:59:41', 9, 20),
(180, 5, 5, 467284, '2023-04-03 07:59:41', '2023-04-03 07:59:41', 2, 20),
(181, 17, 13, 1574041, '2023-04-03 07:59:42', '2023-04-03 07:59:42', 2, 20),
(182, 12, 9, 900973, '2023-03-28 04:26:40', '2023-04-03 21:32:07', 1, 21),
(183, 5, 4, 4003740, '2023-03-14 07:58:17', '2023-04-03 21:32:07', 11, 21),
(184, 10, 8, 1547988, '2023-03-23 18:00:30', '2023-04-03 21:32:07', 8, 21),
(185, 10, 8, 986977, '2023-04-01 08:08:08', '2023-04-03 21:32:07', 2, 21),
(186, 7, 6, 677357, '2023-02-01 09:39:13', '2023-04-03 21:32:07', 2, 21),
(187, 11, 10, 2068206, '2023-03-20 15:32:29', '2023-04-03 21:40:33', 8, 22),
(188, 5, 4, 745928, '2023-01-10 10:39:01', '2023-04-03 21:40:33', 9, 22),
(189, 14, 10, 2641058, '2023-02-21 01:39:02', '2023-04-03 21:40:33', 9, 22),
(190, 16, 15, 1410019, '2023-02-21 23:23:22', '2023-04-03 21:40:33', 2, 22),
(191, 14, 12, 1116016, '2023-03-26 10:06:47', '2023-04-03 21:40:33', 2, 22),
(192, 6, 6, 583194, '2023-03-12 16:16:46', '2023-04-05 23:51:51', 2, 23),
(193, 5, 5, 831740, '2023-02-25 12:22:47', '2023-04-05 23:51:51', 8, 23),
(194, 17, 13, 2542107, '2023-01-27 05:41:56', '2023-04-05 23:51:52', 8, 23),
(195, 6, 4, 532161, '2023-03-23 10:46:32', '2023-04-05 23:51:52', 4, 23),
(196, 7, 6, 1323011, '2023-01-04 04:10:42', '2023-04-05 23:51:52', 9, 23),
(216, 50, 45, 500050, '2023-05-05 00:31:26', NULL, 29, 34);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_hutang`
--

CREATE TABLE `transaksi_hutang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bayar_hutang_pembelian` int(11) DEFAULT NULL,
  `bayar_hutang_tabung` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barangs__id` bigint(20) UNSIGNED NOT NULL,
  `pangkalans__id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_hutang`
--

INSERT INTO `transaksi_hutang` (`id`, `bayar_hutang_pembelian`, `bayar_hutang_tabung`, `created_at`, `updated_at`, `barangs__id`, `pangkalans__id`) VALUES
(16, 0, 5, '2023-05-05 02:22:29', NULL, 22, 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'susi@gmail.com', NULL, '$2y$10$8P61pbZMcnJmYekSx2h0yuw0V6X0pryCd9DBaj6.AD82ORxoN9AZK', NULL, '2023-03-18 06:34:47', '2023-05-05 05:05:18'),
(11, 'ando.kusuma@gmail.com', NULL, '$2y$10$A7pXp19Uy7Y0BvuJJ1QB9u2ZqXvzsw7kM6EyBpjhbZWUUPlN3QbDy', NULL, '2023-03-18 00:50:10', '2023-03-18 01:44:44'),
(12, 'ando@gmail.com', NULL, '$2y$10$1vtslIVrr2a2i0UDoFi88OrefjG3hEf9ax8y4DzO.UH0bwb3fVVPy', 'BtmZ3SiG6WAPJwBF1YAUIZkHTi3dJyofCwnGloCZAQnnkn3HNP4ZWD0scU5P', '2023-03-18 01:54:04', '2023-03-18 02:05:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hutang_barangss_id_foreign` (`barangss_id`),
  ADD KEY `hutang_pangkalan_id_foreign` (`pangkalan_id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jual_tabung`
--
ALTER TABLE `jual_tabung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawans_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `karyawans_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pangkalans`
--
ALTER TABLE `pangkalans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembelian_tabung`
--
ALTER TABLE `pembelian_tabung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_tabung_barangs_id_foreign` (`barangs_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_barang_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_jual_tabung_id_foreign` (`jual_tabung_id`),
  ADD KEY `transaksis_pangkalan_id_foreign` (`pangkalan_id`);

--
-- Indexes for table `transaksi_hutang`
--
ALTER TABLE `transaksi_hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_hutang_barangs__id_foreign` (`barangs__id`),
  ADD KEY `transaksi_hutang_pangkalans__id_foreign` (`pangkalans__id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jual_tabung`
--
ALTER TABLE `jual_tabung`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pangkalans`
--
ALTER TABLE `pangkalans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pembelian_tabung`
--
ALTER TABLE `pembelian_tabung`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `transaksi_hutang`
--
ALTER TABLE `transaksi_hutang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `hutang_barangss_id_foreign` FOREIGN KEY (`barangss_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hutang_pangkalan_id_foreign` FOREIGN KEY (`pangkalan_id`) REFERENCES `pangkalans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `karyawans_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `karyawans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembelian_tabung`
--
ALTER TABLE `pembelian_tabung`
  ADD CONSTRAINT `pembelian_tabung_barangs_id_foreign` FOREIGN KEY (`barangs_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD CONSTRAINT `stok_barang_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_jual_tabung_id_foreign` FOREIGN KEY (`jual_tabung_id`) REFERENCES `jual_tabung` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_pangkalan_id_foreign` FOREIGN KEY (`pangkalan_id`) REFERENCES `pangkalans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_hutang`
--
ALTER TABLE `transaksi_hutang`
  ADD CONSTRAINT `transaksi_hutang_barangs__id_foreign` FOREIGN KEY (`barangs__id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_hutang_pangkalans__id_foreign` FOREIGN KEY (`pangkalans__id`) REFERENCES `pangkalans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
