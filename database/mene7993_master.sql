-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Bulan Mei 2022 pada 08.30
-- Versi server: 10.2.43-MariaDB-cll-lve
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mene7993_master`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `countries`
--

CREATE TABLE `countries` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(1, 'INDONESIA'),
(2, 'MALAYSIA'),
(3, 'CHINA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `location_rs`
--

CREATE TABLE `location_rs` (
  `rs_id` bigint(20) UNSIGNED NOT NULL,
  `rumah_sakit_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumah_sakit_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumah_sakit_cn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_cn` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `location_rs`
--

INSERT INTO `location_rs` (`rs_id`, `rumah_sakit_id`, `description_id`, `rumah_sakit_en`, `description_en`, `rumah_sakit_cn`, `description_cn`, `website`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'RS ID', 'RS ID', 'RS EN', 'RS EN', 'RS CN', 'RS CN', 'https://www.meq.us', 7, '2022-04-26 09:30:51', '2022-04-26 09:38:14'),
(3, 'Quam et maxime animi quia suscipit sequi', 'Omnis dolorem ea a e', 'Dolorem et sint rerum praesentium culpa quibusdam delectus aut ab eos sit', 'Aliquid laborum sapi', 'Officiis quos aperiam voluptates est dolor quia voluptatem natus culpa', 'Excepteur soluta exp', 'https://www.gyqumyfab.biz', 35, '2022-04-26 10:52:42', '2022-04-26 10:52:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2021_11_09_122221_create_permission_tables', 2),
(6, '2022_01_16_082218_create_jobs_table', 2),
(9, '2022_04_24_055340_create_table_location_rs', 3),
(10, '2022_04_26_152721_add_table_country', 3),
(11, '2022_04_26_153758_add_table_pasiens', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasiens`
--

CREATE TABLE `pasiens` (
  `pasien_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasiens`
--

INSERT INTO `pasiens` (`pasien_id`, `name`, `age`, `occupation`, `country`, `location`, `category`, `test`, `score`, `result`, `created_at`, `updated_at`) VALUES
(1, 'John Gomez', '94', 'Natus in dignissimos', 'NUSA TENGGARA TIMUR', 'NUSA TENGGARA TIMUR', 'stress', 'a:14:{i:0;a:2:{s:4:\"soal\";s:64:\"Saya merasa bahwa diri saya menjadi marah karena hal-hal sepele.\";s:5:\"value\";s:1:\"2\";}i:1;a:2:{s:4:\"soal\";s:58:\"Saya cenderung bereaksi berlebihan terhadap suatu situasi.\";s:5:\"value\";s:1:\"3\";}i:2;a:2:{s:4:\"soal\";s:34:\"Saya merasa sulit untuk bersantai.\";s:5:\"value\";s:1:\"0\";}i:3;a:2:{s:4:\"soal\";s:44:\"Saya menemukan diri saya mudah merasa kesal.\";s:5:\"value\";s:1:\"3\";}i:4;a:2:{s:4:\"soal\";s:64:\"Saya merasa telah menghabiskan banyak energi untuk merasa cemas.\";s:5:\"value\";s:1:\"0\";}i:5;a:2:{s:4:\"soal\";s:124:\"Saya menemukan diri saya menjadi tidak sabar ketika mengalami penundaan (misalnya: kemacetan lalu lintas, menunggu sesuatu).\";s:5:\"value\";s:1:\"1\";}i:6;a:2:{s:4:\"soal\";s:41:\"Saya merasa bahwa saya mudah tersinggung.\";s:5:\"value\";s:1:\"1\";}i:7;a:2:{s:4:\"soal\";s:37:\"Saya merasa sulit untuk beristirahat.\";s:5:\"value\";s:1:\"0\";}i:8;a:2:{s:4:\"soal\";s:42:\"Saya merasa bahwa saya sangat mudah marah.\";s:5:\"value\";s:1:\"1\";}i:9;a:2:{s:4:\"soal\";s:66:\"Saya merasa sulit untuk tenang setelah sesuatu membuat saya kesal.\";s:5:\"value\";s:1:\"1\";}i:10;a:2:{s:4:\"soal\";s:87:\"Saya sulit untuk sabar dalam menghadapi gangguan terhadap hal yang sedang saya lakukan.\";s:5:\"value\";s:1:\"0\";}i:11;a:2:{s:4:\"soal\";s:27:\"Saya sedang merasa gelisah.\";s:5:\"value\";s:1:\"0\";}i:12;a:2:{s:4:\"soal\";s:109:\"Saya tidak dapat memaklumi hal apapun yang menghalangi saya untuk menyelesaikan hal yang sedang saya lakukan.\";s:5:\"value\";s:1:\"1\";}i:13;a:2:{s:4:\"soal\";s:39:\"Saya menemukan diri saya mudah gelisah.\";s:5:\"value\";s:1:\"2\";}}', '15', 'Berat', NULL, NULL),
(2, 'John Gomez', '94', 'Natus in dignissimos', '-', 'NUSA TENGGARA TIMUR', 'stress', 'a:14:{i:0;a:2:{s:4:\"soal\";s:64:\"Saya merasa bahwa diri saya menjadi marah karena hal-hal sepele.\";s:5:\"value\";s:1:\"2\";}i:1;a:2:{s:4:\"soal\";s:58:\"Saya cenderung bereaksi berlebihan terhadap suatu situasi.\";s:5:\"value\";s:1:\"3\";}i:2;a:2:{s:4:\"soal\";s:34:\"Saya merasa sulit untuk bersantai.\";s:5:\"value\";s:1:\"0\";}i:3;a:2:{s:4:\"soal\";s:44:\"Saya menemukan diri saya mudah merasa kesal.\";s:5:\"value\";s:1:\"3\";}i:4;a:2:{s:4:\"soal\";s:64:\"Saya merasa telah menghabiskan banyak energi untuk merasa cemas.\";s:5:\"value\";s:1:\"0\";}i:5;a:2:{s:4:\"soal\";s:124:\"Saya menemukan diri saya menjadi tidak sabar ketika mengalami penundaan (misalnya: kemacetan lalu lintas, menunggu sesuatu).\";s:5:\"value\";s:1:\"1\";}i:6;a:2:{s:4:\"soal\";s:41:\"Saya merasa bahwa saya mudah tersinggung.\";s:5:\"value\";s:1:\"1\";}i:7;a:2:{s:4:\"soal\";s:37:\"Saya merasa sulit untuk beristirahat.\";s:5:\"value\";s:1:\"0\";}i:8;a:2:{s:4:\"soal\";s:42:\"Saya merasa bahwa saya sangat mudah marah.\";s:5:\"value\";s:1:\"1\";}i:9;a:2:{s:4:\"soal\";s:66:\"Saya merasa sulit untuk tenang setelah sesuatu membuat saya kesal.\";s:5:\"value\";s:1:\"1\";}i:10;a:2:{s:4:\"soal\";s:87:\"Saya sulit untuk sabar dalam menghadapi gangguan terhadap hal yang sedang saya lakukan.\";s:5:\"value\";s:1:\"0\";}i:11;a:2:{s:4:\"soal\";s:27:\"Saya sedang merasa gelisah.\";s:5:\"value\";s:1:\"0\";}i:12;a:2:{s:4:\"soal\";s:109:\"Saya tidak dapat memaklumi hal apapun yang menghalangi saya untuk menyelesaikan hal yang sedang saya lakukan.\";s:5:\"value\";s:1:\"1\";}i:13;a:2:{s:4:\"soal\";s:39:\"Saya menemukan diri saya mudah gelisah.\";s:5:\"value\";s:1:\"2\";}}', '15', 'Berat', NULL, NULL),
(3, 'Nichole Carlson', '81', 'Quia non illo aliqua', '62683835d1440', 'ACEH', 'anxiety', 'a:14:{i:0;a:2:{s:4:\"soal\";s:37:\"Saya merasa bibir saya sering kering.\";s:5:\"value\";s:1:\"0\";}i:1;a:2:{s:4:\"soal\";s:149:\"Saya mengalami kesulitan bernafas (misalnya: seringkali terengah-engah atau tidak dapat bernafas padahal tidak melakukan aktivitas fisik sebelumnya).\";s:5:\"value\";s:1:\"0\";}i:2;a:2:{s:4:\"soal\";s:58:\"Saya merasa goyah (misalnya, kaki terasa mau ’copot’).\";s:5:\"value\";s:1:\"1\";}i:3;a:2:{s:4:\"soal\";s:141:\"Saya menemukan diri saya berada dalam situasi yang membuat saya merasa sangat cemas dan saya akan merasa sangat lega jika semua ini berakhir.\";s:5:\"value\";s:1:\"0\";}i:4;a:2:{s:4:\"soal\";s:38:\"Saya merasa lemas seperti mau pingsan.\";s:5:\"value\";s:1:\"1\";}i:5;a:2:{s:4:\"soal\";s:146:\"Saya berkeringat secara berlebihan (misalnya: tangan berkeringat), padahal temperatur tidak panas atau tidak melakukan aktivitas fisik sebelumnya.\";s:5:\"value\";s:1:\"0\";}i:6;a:2:{s:4:\"soal\";s:42:\"Saya merasa takut tanpa alasan yang jelas.\";s:5:\"value\";s:1:\"0\";}i:7;a:2:{s:4:\"soal\";s:39:\"Saya mengalami kesulitan dalam menelan.\";s:5:\"value\";s:1:\"3\";}i:8;a:2:{s:4:\"soal\";s:143:\"Saya menyadari kegiatan jantung, walaupun saya tidak sehabis melakukan aktivitas fisik (misalnya: merasa detak jantung meningkat atau melemah).\";s:5:\"value\";s:1:\"3\";}i:9;a:2:{s:4:\"soal\";s:30:\"Saya merasa saya hampir panik.\";s:5:\"value\";s:1:\"2\";}i:10;a:2:{s:4:\"soal\";s:98:\"Saya takut bahwa saya akan ‘terhambat’ oleh tugas- tugas sepele yang tidak biasa saya lakukan.\";s:5:\"value\";s:1:\"1\";}i:11;a:2:{s:4:\"soal\";s:29:\"Saya merasa sangat ketakutan.\";s:5:\"value\";s:1:\"3\";}i:12;a:2:{s:4:\"soal\";s:101:\"Saya merasa khawatir dengan situasi dimana saya mungkin menjadi panik dan mempermalukan diri sendiri.\";s:5:\"value\";s:1:\"0\";}i:13;a:2:{s:4:\"soal\";s:44:\"Saya merasa gemetar (misalnya: pada tangan).\";s:5:\"value\";s:1:\"0\";}}', '14', 'Normal', NULL, NULL),
(4, 'Kitra Wilson', '35', 'PNS', '626dec2c84325', 'JAMBI', 'depression', 'a:14:{i:0;a:2:{s:4:\"soal\";s:56:\"Saya sama sekali tidak dapat merasakan perasaan positif.\";s:5:\"value\";s:1:\"2\";}i:1;a:2:{s:4:\"soal\";s:63:\"Saya sepertinya tidak kuat lagi untuk melakukan suatu kegiatan.\";s:5:\"value\";s:1:\"1\";}i:2;a:2:{s:4:\"soal\";s:62:\"Saya merasa tidak ada hal yang dapat diharapkan di masa depan.\";s:5:\"value\";s:1:\"2\";}i:3;a:2:{s:4:\"soal\";s:31:\"Saya merasa sedih dan tertekan.\";s:5:\"value\";s:1:\"2\";}i:4;a:2:{s:4:\"soal\";s:50:\"Saya merasa saya kehilangan minat akan segala hal.\";s:5:\"value\";s:1:\"0\";}i:5;a:2:{s:4:\"soal\";s:62:\"Saya merasa bahwa saya tidak berharga sebagai seorang manusia.\";s:5:\"value\";s:1:\"0\";}i:6;a:2:{s:4:\"soal\";s:41:\"Saya merasa bahwa hidup tidak bermanfaat.\";s:5:\"value\";s:1:\"0\";}i:7;a:2:{s:4:\"soal\";s:74:\"Saya tidak dapat merasakan kenikmatan dari berbagai hal yang saya lakukan.\";s:5:\"value\";s:1:\"2\";}i:8;a:2:{s:4:\"soal\";s:32:\"Saya merasa putus asa dan sedih.\";s:5:\"value\";s:1:\"1\";}i:9;a:2:{s:4:\"soal\";s:44:\"Saya tidak merasa antusias dalam hal apapun.\";s:5:\"value\";s:1:\"1\";}i:10;a:2:{s:4:\"soal\";s:38:\"Saya merasa bahwa saya tidak berharga.\";s:5:\"value\";s:1:\"0\";}i:11;a:2:{s:4:\"soal\";s:48:\"Saya melihat tidak ada harapan untuk masa depan.\";s:5:\"value\";s:1:\"1\";}i:12;a:2:{s:4:\"soal\";s:38:\"Saya merasa bahwa hidup tidak berarti.\";s:5:\"value\";s:1:\"0\";}i:13;a:2:{s:4:\"soal\";s:71:\"Saya merasa sulit untuk meningkatkan inisiatif dalam melakukan sesuatu.\";s:5:\"value\";s:1:\"2\";}}', '14', 'Sedang', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'index location', 'web', '2022-04-23 22:14:12', '2022-04-23 22:14:12'),
(2, 'get location', 'web', '2022-04-23 22:14:12', '2022-04-23 22:14:12'),
(3, 'create location', 'web', '2022-04-23 22:14:12', '2022-04-23 22:14:12'),
(4, 'edit location', 'web', '2022-04-23 22:14:12', '2022-04-23 22:14:12'),
(5, 'delete location', 'web', '2022-04-23 22:14:12', '2022-04-23 22:14:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinces`
--

CREATE TABLE `provinces` (
  `prov_id` int(11) NOT NULL,
  `prov_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `provinces`
--

INSERT INTO `provinces` (`prov_id`, `prov_name`, `country_id`) VALUES
(1, 'ACEH', 1),
(2, 'SUMATERA UTARA', 1),
(3, 'SUMATERA BARAT', 1),
(4, 'RIAU', 1),
(5, 'JAMBI', 1),
(6, 'SUMATERA SELATAN', 1),
(7, 'BENGKULU', 1),
(8, 'LAMPUNG', 1),
(9, 'KEPULAUAN BANGKA BELITUNG', 1),
(10, 'KEPULAUAN RIAU', 1),
(11, 'DKI JAKARTA', 1),
(12, 'JAWA BARAT', 1),
(13, 'JAWA TENGAH', 1),
(14, 'DI YOGYAKARTA', 1),
(15, 'JAWA TIMUR', 1),
(16, 'BANTEN', 1),
(17, 'BALI', 1),
(18, 'NUSA TENGGARA BARAT', 1),
(19, 'NUSA TENGGARA TIMUR', 1),
(20, 'KALIMANTAN BARAT', 1),
(21, 'KALIMANTAN TENGAH', 1),
(22, 'KALIMANTAN SELATAN', 1),
(23, 'KALIMANTAN TIMUR', 1),
(24, 'KALIMANTAN UTARA', 1),
(25, 'SULAWESI UTARA', 1),
(26, 'SULAWESI TENGAH', 1),
(27, 'SULAWESI SELATAN', 1),
(28, 'SULAWESI TENGGARA', 1),
(29, 'GORONTALO', 1),
(30, 'SULAWESI BARAT', 1),
(31, 'MALUKU', 1),
(32, 'MALUKU UTARA', 1),
(33, 'PAPUA', 1),
(34, 'PAPUA BARAT', 1),
(35, 'WUHAN', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-04-23 22:14:12', '2022-04-23 22:14:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin Mental Health', 'admin@admin.id', '2022-04-23 22:14:27', '$2y$10$TSez/Q/Z418Df108kT4ap.L0QCHvo8KsUcUr7RsQPlcU1rZ4uZpiG', NULL, '2022-04-23 22:14:27', '2022-04-23 22:14:27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `location_rs`
--
ALTER TABLE `location_rs`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`pasien_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`prov_id`) USING BTREE;

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `location_rs`
--
ALTER TABLE `location_rs`
  MODIFY `rs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `pasien_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `provinces`
--
ALTER TABLE `provinces`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
