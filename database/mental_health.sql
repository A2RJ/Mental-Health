-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jul 2022 pada 18.56
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mental_health`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `wa` varchar(25) NOT NULL,
  `wa_subject` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_subject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id`, `ig`, `wa`, `wa_subject`, `email`, `email_subject`) VALUES
(1, '', '', '', 'sdsdsd@gmail.com', '');

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
(1, 'RSUP Manambai Sumbawa Besar', 'Coba aja kesini', 'RSUP Manambai Sumbawa Besar', 'Coba aja kesini', 'RSUP Manambai Sumbawa Besar', 'Coba aja kesini', 'contoh-rs.com', 19, '2022-06-27 17:44:00', '2022-06-27 17:44:00'),
(2, 'RSUP Manambai Sumbawa Besar', 'Coba ajasi', 'RSUP Manambai Sumbawa Besar', 'kdmfksdmfksd', 'RSUP Manambai Sumbawa Besar', 'msdfm,sd d sfsdmf,msdf', 'contoh-rs.com', 19, '2022-06-29 03:39:49', '2022-06-29 03:39:49');

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
(16, '2014_10_12_000000_create_users_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(20, '2021_11_09_122221_create_permission_tables', 1),
(21, '2022_01_16_082218_create_jobs_table', 1),
(22, '2022_04_24_055340_create_table_location_rs', 1),
(23, '2022_04_26_152721_add_table_country', 1),
(24, '2022_04_26_153758_add_table_pasiens', 1),
(25, '2022_05_28_090836_create_provinces_table', 1),
(26, '2022_05_28_164219_create_question_category_table', 1),
(27, '2022_05_28_164219_create_question_translation_table', 1),
(28, '2022_05_28_164219_create_questions_table', 1),
(29, '2022_05_28_164220_add_foreign_keys_to_question_translation_table', 1),
(30, '2022_05_28_164220_add_foreign_keys_to_questions_table', 1),
(31, '2022_07_16_152743_create_countries_table', 0),
(32, '2022_07_16_152743_create_failed_jobs_table', 0),
(33, '2022_07_16_152743_create_jobs_table', 0),
(34, '2022_07_16_152743_create_location_rs_table', 0),
(35, '2022_07_16_152743_create_model_has_permissions_table', 0),
(36, '2022_07_16_152743_create_model_has_roles_table', 0),
(37, '2022_07_16_152743_create_pasiens_table', 0),
(38, '2022_07_16_152743_create_password_resets_table', 0),
(39, '2022_07_16_152743_create_permissions_table', 0),
(40, '2022_07_16_152743_create_personal_access_tokens_table', 0),
(41, '2022_07_16_152743_create_provinces_table', 0),
(42, '2022_07_16_152743_create_question_category_table', 0),
(43, '2022_07_16_152743_create_question_translation_table', 0),
(44, '2022_07_16_152743_create_questions_table', 0),
(45, '2022_07_16_152743_create_role_has_permissions_table', 0),
(46, '2022_07_16_152743_create_roles_table', 0),
(47, '2022_07_16_152743_create_users_table', 0),
(48, '2022_07_16_152744_add_foreign_keys_to_model_has_permissions_table', 0),
(49, '2022_07_16_152744_add_foreign_keys_to_model_has_roles_table', 0),
(50, '2022_07_16_152744_add_foreign_keys_to_question_translation_table', 0),
(51, '2022_07_16_152744_add_foreign_keys_to_questions_table', 0),
(52, '2022_07_16_152744_add_foreign_keys_to_role_has_permissions_table', 0),
(53, '2022_07_17_143856_create_countries_table', 0),
(54, '2022_07_17_143856_create_failed_jobs_table', 0),
(55, '2022_07_17_143856_create_jobs_table', 0),
(56, '2022_07_17_143856_create_location_rs_table', 0),
(57, '2022_07_17_143856_create_model_has_permissions_table', 0),
(58, '2022_07_17_143856_create_model_has_roles_table', 0),
(59, '2022_07_17_143856_create_pasiens_table', 0),
(60, '2022_07_17_143856_create_password_resets_table', 0),
(61, '2022_07_17_143856_create_permissions_table', 0),
(62, '2022_07_17_143856_create_personal_access_tokens_table', 0),
(63, '2022_07_17_143856_create_provinces_table', 0),
(64, '2022_07_17_143856_create_question_category_table', 0),
(65, '2022_07_17_143856_create_question_translation_table', 0),
(66, '2022_07_17_143856_create_questions_table', 0),
(67, '2022_07_17_143856_create_role_has_permissions_table', 0),
(68, '2022_07_17_143856_create_roles_table', 0),
(69, '2022_07_17_143856_create_suggestion_table', 0),
(70, '2022_07_17_143856_create_users_table', 0),
(71, '2022_07_17_143857_add_foreign_keys_to_model_has_permissions_table', 0),
(72, '2022_07_17_143857_add_foreign_keys_to_model_has_roles_table', 0),
(73, '2022_07_17_143857_add_foreign_keys_to_question_translation_table', 0),
(74, '2022_07_17_143857_add_foreign_keys_to_questions_table', 0),
(75, '2022_07_17_143857_add_foreign_keys_to_role_has_permissions_table', 0);

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
(1, 'App\\Models\\User', 1);

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
(33, 'asdasdsdf', '', '', '', '', '', NULL, '', '', NULL, NULL);

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
(1, 'index location', 'web', '2022-06-27 17:40:45', '2022-06-27 17:40:45'),
(2, 'get location', 'web', '2022-06-27 17:40:45', '2022-06-27 17:40:45'),
(3, 'create location', 'web', '2022-06-27 17:40:45', '2022-06-27 17:40:45'),
(4, 'edit location', 'web', '2022-06-27 17:40:45', '2022-06-27 17:40:45'),
(5, 'delete location', 'web', '2022-06-27 17:40:45', '2022-06-27 17:40:45');

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
  `prov_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `provinces`
--

INSERT INTO `provinces` (`prov_id`, `prov_name`, `country_id`) VALUES
(1, 'Jawa Timur', 1),
(2, 'ACEH', 1),
(3, 'SUMATERA UTARA', 1),
(4, 'SUMATERA BARAT', 1),
(5, 'RIAU', 1),
(6, 'JAMBI', 1),
(7, 'SUMATERA SELATAN', 1),
(8, 'BENGKULU', 1),
(9, 'LAMPUNG', 1),
(10, 'KEPULAUAN BANGKA BELITUNG', 1),
(11, 'KEPULAUAN RIAU', 1),
(12, 'DKI JAKARTA', 1),
(13, 'JAWA BARAT', 1),
(14, 'JAWA TENGAH', 1),
(15, 'DI YOGYAKARTA', 1),
(16, 'JAWA TIMUR', 1),
(17, 'BANTEN', 1),
(18, 'BALI', 1),
(19, 'NUSA TENGGARA BARAT', 1),
(20, 'NUSA TENGGARA TIMUR', 1),
(21, 'KALIMANTAN BARAT', 1),
(22, 'KALIMANTAN TENGAH', 1),
(23, 'KALIMANTAN SELATAN', 1),
(24, 'KALIMANTAN TIMUR', 1),
(25, 'KALIMANTAN UTARA', 1),
(26, 'SULAWESI UTARA', 1),
(27, 'SULAWESI TENGAH', 1),
(28, 'SULAWESI SELATAN', 1),
(29, 'SULAWESI TENGGARA', 1),
(30, 'GORONTALO', 1),
(31, 'SULAWESI BARAT', 1),
(32, 'MALUKU', 1),
(33, 'MALUKU UTARA', 1),
(34, 'PAPUA', 1),
(35, 'PAPUA BARAT', 1),
(36, 'WUHAN', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `category_id`) VALUES
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(89, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_category`
--

CREATE TABLE `question_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `question_category`
--

INSERT INTO `question_category` (`id`, `name`) VALUES
(1, 'stress'),
(2, 'depression'),
(3, 'anxiety');

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_translation`
--

CREATE TABLE `question_translation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_options` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `question_translation`
--

INSERT INTO `question_translation` (`id`, `question_id`, `code`, `locale`, `question`, `answer_options`) VALUES
(6, 6, 'en', 'en', 'I couldn\'t seem to experience any positive feeling at all', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(7, 7, 'en', 'en', 'I just couldn\'t seem to get going', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(8, 8, 'en', 'en', 'I felt that I had nothing to look forward to', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(9, 9, 'en', 'en', 'I felt sad and depressed', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(10, 10, 'en', 'en', 'I felt that I had lost interest in just about everything', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(11, 11, 'en', 'en', 'I felt I wasn\'t worth much as a person', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(12, 12, 'en', 'en', 'I felt that life wasn\'t worthwhile', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(13, 13, 'en', 'en', 'I couldn\'t seem to get any enjoyment out of the things I did', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(14, 14, 'en', 'en', 'I felt down-hearted and blue', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(15, 15, 'en', 'en', 'I was unable to become enthusiastic about anything', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(16, 16, 'en', 'en', 'I felt I was pretty worthless', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(17, 17, 'en', 'en', 'I could see nothing in the future to be hopeful about', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(18, 18, 'en', 'en', 'I felt that life was meaningless', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(19, 19, 'en', 'en', 'I found it difficult to work up the initiative to do things', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(20, 20, 'cn', 'cn', '我似乎完全不能积极乐观起来', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(21, 21, 'cn', 'cn', '我似乎没法提起劲来做事情', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(22, 22, 'cn', 'cn', '我感到我没什么可期待的', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(23, 23, 'cn', 'cn', '我感到伤心和郁闷', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(24, 24, 'cn', 'cn', '我一度感到我对几乎任何事情都失去了兴趣', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(25, 25, 'cn', 'cn', '我感到自己曾不具备作为人而存在的价值', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(26, 26, 'cn', 'cn', '我感到生命没有价值', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(27, 27, 'cn', 'cn', '我似乎没法从我做过的事情中找到乐趣', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(28, 28, 'cn', 'cn', '我感到消沉和沮丧', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(29, 29, 'cn', 'cn', '我对任何事情都没法充满热情', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(30, 30, 'cn', 'cn', '我一度感到我很没价值', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(31, 31, 'cn', 'cn', '对于未来我看不到任何希望', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(32, 32, 'cn', 'cn', '我曾感到生活没有意义', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(33, 33, 'cn', 'cn', '我发现很难发挥主动性去做事情', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(34, 34, 'id', 'id', 'Saya sulit mengalami perasaan yang positif', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(35, 35, 'id', 'id', 'Kelihatannya saya tidak bersantai', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(36, 36, 'id', 'id', 'Saya tidak punya harapan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(37, 37, 'id', 'id', 'Saya merasa sedih dan tertekan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(38, 38, 'id', 'id', 'saya merasa kehilangan minat atas apapun', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(39, 39, 'id', 'id', 'Saya merasa tidak berarti sebagai seorang manusia', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(40, 40, 'id', 'id', 'Saya merasa hidup saya sudah tidak berarti lagi', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(41, 41, 'id', 'id', 'Saya merasa tidak menikmati apa yang telah saya kerjakan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(42, 42, 'id', 'id', 'Saya merasa sakit hati', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(43, 43, 'id', 'id', 'Saya tidak dapat bersikap antusias tentang apapun', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(44, 44, 'id', 'id', 'Saya merasa benar -benar tidak berharga', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(45, 45, 'id', 'id', 'Saya tiak melihat harapan apapun di masa mendatang', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(46, 46, 'id', 'id', 'Saya merasa hidup tidak berarti', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(47, 47, 'id', 'id', 'Saya sulit untuk melakukan pekerjaan atas inisiatif sendiri', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(48, 48, 'id', 'id', 'Saya menyadari mulut saya kering', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(49, 49, 'id', 'id', 'Saya mengalami kesulitan bernafas', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(50, 50, 'id', 'id', 'Saya sering merasa lemas', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(51, 51, 'id', 'id', 'Saya merasa sangat lega ketika situasi yang mencemaskan saya berakhir', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(52, 52, 'id', 'id', 'Saya merasa ingin pingsan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(53, 53, 'id', 'id', 'Mudah sekali saya berkeringat saat tidak ada panas dan latihan fisik', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(54, 54, 'id', 'id', 'Saya sering mersa ketakutan tanpa alasan yang jelas', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(55, 55, 'id', 'id', 'Saya merasa kesulitan untuk menelan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(56, 56, 'id', 'id', 'Saya menyadari keadaan jantung saya saat tidak lagi melakukan aktifitas fisik', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(57, 57, 'id', 'id', 'Saya mudah panik', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(58, 58, 'id', 'id', 'Saya takut diberikan tugas yang sederhana yang tidak bisa saya lakukan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(59, 59, 'id', 'id', 'Saya merasa takut', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(60, 60, 'id', 'id', 'Saya khawatir berada dalam situasi yang membuat panik dan bertindak bodoh', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(61, 61, 'id', 'id', 'Saya mengalami bergetar tanpa sadar', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(62, 62, 'en', 'en', 'I was aware of dryness of my mouth', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(63, 63, 'en', 'en', 'I experienced breathing difficulty (eg, excessively rapid breathing,\nbreathlessness in the absence of physical exertion)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(64, 64, 'en', 'en', 'I had a feeling of shakiness (eg, legs going to give way)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(65, 65, 'en', 'en', 'I found myself in situations that made me so anxious I was most\nrelieved when they ended', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(66, 66, 'en', 'en', 'I had a feeling of faintness', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(67, 67, 'en', 'en', 'I perspired noticeably (eg, hands sweaty) in the absence of high\ntemperatures or physical exertion', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(68, 68, 'en', 'en', 'I felt scared without any good reason', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(69, 69, 'en', 'en', 'I had difficulty in swallowing', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(70, 70, 'en', 'en', 'I was aware of the action of my heart in the absence of physical\nexertion (eg, sense of heart rate increase, heart missing a beat)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(71, 71, 'en', 'en', 'I felt I was close to panic', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(72, 72, 'en', 'en', 'I feared that I would be \"thrown\" by some trivial but\nunfamiliar task', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(73, 73, 'en', 'en', 'I felt terrified', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(74, 74, 'en', 'en', 'I was worried about situations in which I might panic and make\na fool of myself', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(75, 75, 'en', 'en', 'I experienced trembling (eg, in the hands)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(76, 76, 'cn', 'cn', '我感到嘴巴很干', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(77, 77, 'cn', 'cn', '我感到过呼吸困难(例如: 在没有体力透支的情况下而感到呼吸急促, 喘不\n过气来)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(78, 78, 'cn', 'cn', '我曾有发抖的感觉(例如:腿都站不稳)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(79, 79, 'cn', 'cn', '我发现我曾处于非常焦虑的情况下,极想立刻离开这种环境松一口气', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(80, 80, 'cn', 'cn', '我曾有眩晕的感觉', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(81, 81, 'cn', 'cn', '在不是高温或体力透支的情况下,我明显容易出汗(例如:汗手)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(82, 82, 'cn', 'cn', '没有什么特殊原因的情况下,我感到害怕', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(83, 83, 'cn', 'cn', '我曾有过吞咽困难的感觉', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(84, 84, 'cn', 'cn', '在没有体力透支的情况下我也能感觉到自己的心跳或心律不正常(例如:感\n到心跳过快或心律不齐)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(85, 85, 'cn', 'cn', '我感到我曾接近恐慌', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(86, 86, 'cn', 'cn', '我担心我会因为某些琐碎和不熟悉的工作而感到筋疲力竭', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(87, 87, 'cn', 'cn', '我曾感到恐惧', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(88, 88, 'cn', 'cn', '我担心自己可能因为惊慌而干蠢事出洋相', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(89, 89, 'cn', 'cn', '我曾感到发抖(例如:手打哆嗦)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(90, 90, 'cn', 'cn', '我发现我自己被一些琐碎的事情弄得很不开心', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(91, 91, 'cn', 'cn', '我对于所处的环境(情况)易于反应过度', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(92, 92, 'cn', 'cn', '我发现很难放松下来', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(93, 93, 'cn', 'cn', '我发现我极其容易不开心', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(94, 94, 'cn', 'cn', '我感到时常神经紧张', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(95, 95, 'cn', 'cn', '我发现当我因为某种原因而耽误时间的时候,我变得没有耐性(例如:等电\n梯,在十字路口等红绿灯或其他处于等待的状态)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(96, 96, 'cn', 'cn', '我感到我曾极容易因为小事而生气', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(97, 97, 'cn', 'cn', '我发现很难让自己安静下来休息', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(98, 98, 'cn', 'cn', '我发现我容易烦躁', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(99, 99, 'cn', 'cn', '我发现当某件事情使我不开心之后,我很难平静下来', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(100, 100, 'cn', 'cn', '我发现我很难忍受我做事的时候受到任何干扰', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(101, 101, 'cn', 'cn', '我曾处于神经紧张的状态', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(102, 102, 'cn', 'cn', '我曾对阻碍我正在进行的工作的事情感到无法容忍', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(103, 103, 'cn', 'cn', '我发现自己变得焦虑不安', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(104, 104, 'en', 'en', 'I found myself getting upset by quite trivial things', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(105, 105, 'en', 'en', 'I tended to over-react to situations', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(106, 106, 'en', 'en', 'I found it difficult to relax', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(107, 107, 'en', 'en', 'I found myself getting upset rather easily', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(108, 108, 'en', 'en', 'I felt that I was using a lot of nervous energy', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(109, 109, 'en', 'en', 'I found myself getting impatient when I was delayed in any way\n(eg, elevators, traffic lights, being kept waiting)', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(110, 110, 'en', 'en', 'I felt that I was rather touchy', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(111, 111, 'en', 'en', 'I found it hard to wind down', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(112, 112, 'en', 'en', 'I found that I was very irritable', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(113, 113, 'en', 'en', 'I found it hard to calm down after something upset me', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(114, 114, 'en', 'en', 'I found it difficult to tolerate interruptions to what I was doing', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(115, 115, 'en', 'en', 'I was in a state of nervous tension', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(116, 116, 'en', 'en', 'I was intolerant of anything that kept me from getting on with\nwhat I was doing', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(117, 117, 'en', 'en', 'I found myself getting agitated', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(118, 118, 'id', 'id', 'Saya merasa kesal karena hal-hal yang sepele', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(119, 119, 'id', 'id', 'Saya cenderung bereaksi berlebihan terhadap situasi', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(120, 120, 'id', 'id', 'Tidak mudah bagi saya untuk bersantai', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(121, 121, 'id', 'id', 'Saya mudah merasa kecewa', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(122, 122, 'id', 'id', 'Saya mudah merasa gelisah', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(123, 123, 'id', 'id', 'Saya tidak sabar ketika rencana saya harus tertunda', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(124, 124, 'id', 'id', 'Saya adalah orang yang mudah terharu', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(125, 125, 'id', 'id', 'Saya sulit meredam aktifitas', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(126, 126, 'id', 'id', 'Saya mudah tersinggung', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(127, 127, 'id', 'id', 'Saya sulit menenangkan diri setelah sesuatu membuat saya kecewa', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(128, 128, 'id', 'id', 'Saya sulit menerima interupsi ketika saya sedang melakukan suatu hal', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(129, 129, 'id', 'id', 'Saya sedang dalam keadaan mudah gugup', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(130, 130, 'id', 'id', 'Saya tidak memberikan toleransi kepada semua yang menghambat apa yang saya ingin lakukan', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}'),
(131, 131, 'id', 'id', 'Saya merasa sedang dihasut', '{\"a\":0,\"b\":1,\"c\":2,\"d\":3}');

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
(1, 'Super Admin', 'web', '2022-06-27 17:40:45', '2022-06-27 17:40:45');

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
-- Struktur dari tabel `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suggestion`
--

INSERT INTO `suggestion` (`id`, `locale`, `title`, `description`) VALUES
(1, 'id', 'Hargai dirimu sendiri', '<p>Perlakukan diri Anda dengan kebaikan dan rasa hormat, dan hindari mengkritik diri sendiri. Luangkan waktu untuk hobi dan proyek favorit Anda, atau perluas wawasan Anda. Lakukan teka-teki silang setiap hari, menanami taman, mengikuti pelajaran menari, belajar memainkan alat musik, atau menjadi fasih dalam bahasa lain.</p>'),
(2, 'id', 'Jaga tubuhmu', '<p>Merawat diri sendiri secara fisik dapat meningkatkan kesehatan mental Anda. Pastikan untuk:</p>\n                <ul>\n                <li>Makan makanan bergizi</li>\n                <li>Hindari merokok dan vaping--&nbsp;lihat&nbsp;<a href=\"https://uhs.umich.edu/tobacco\">Cessation Help</a></li>\n                <li>Minum banyak air</li>\n                <li><a href=\"https://uhs.umich.edu/exercise\">Latihan</a>, yang membantu mengurangi depresi dan kecemasan dan meningkatkan suasana hati</li>\n                <li>Dapatkan cukup&nbsp;<a href=\"https://uhs.umich.edu/sleep\">tidur</a>. Para peneliti percaya bahwa kurang tidur berkontribusi pada tingginya tingkat depresi pada mahasiswa.</li>\n                </ul>'),
(3, 'id', 'Kelilingi dirimu dengan orang-orang baik', '<p>Orang dengan keluarga atau koneksi sosial yang kuat umumnya lebih sehat daripada mereka yang tidak memiliki jaringan pendukung. Buat rencana dengan anggota keluarga dan teman yang mendukung, atau cari aktivitas di mana Anda dapat bertemu orang baru, seperti klub, kelas, atau kelompok pendukung.</p>'),
(4, 'id', 'Berikan dirimu', '<p>Relawankan waktu dan energi Anda untuk membantu orang lain. Anda akan merasa senang melakukan sesuatu yang nyata untuk membantu seseorang yang membutuhkan — dan ini adalah cara yang bagus untuk bertemu orang baru. Lihat Hal Menyenangkan dan Murah untuk dilakukan di Ann Arbor untuk mendapatkan ide.</p>'),
(5, 'id', 'Pelajari cara mengatasi stres', '<p>Suka atau tidak, stres adalah bagian dari kehidupan. Latih keterampilan mengatasi yang baik: Cobalah Strategi Stres Satu Menit, lakukan Tai Chi, berolahraga, berjalan-jalan di alam, bermain dengan hewan peliharaan Anda atau mencoba menulis jurnal sebagai pengurang stres. Juga, ingatlah untuk tersenyum dan melihat humor dalam hidup. Penelitian menunjukkan bahwa tertawa dapat meningkatkan sistem kekebalan tubuh, mengurangi rasa sakit, merilekskan tubuh, dan mengurangi stres.</p>'),
(6, 'id', 'Tenangkan pikiranmu', '<p>Cobalah bermeditasi, Perhatian penuh dan/atau berdoa. Latihan relaksasi dan doa dapat meningkatkan keadaan pikiran dan pandangan hidup Anda. Faktanya, penelitian menunjukkan bahwa meditasi dapat membantu Anda merasa tenang dan meningkatkan efek terapi. Untuk terhubung, lihat sumber spiritual di Personal Well-being for Students.</p>'),
(7, 'id', 'Tetapkan tujuan yang realistis', '<p>Putuskan apa yang ingin Anda capai secara akademis, profesional dan pribadi, dan tuliskan langkah-langkah yang Anda butuhkan untuk mewujudkan tujuan Anda. Bertujuan tinggi, tetapi bersikaplah realistis dan jangan terlalu menjadwalkan. Anda akan menikmati rasa pencapaian dan harga diri yang luar biasa saat Anda maju menuju tujuan Anda. Pelatihan Kesehatan, gratis untuk mahasiswa UM, dapat membantu Anda mengembangkan tujuan dan tetap berada di jalur yang benar.</p>'),
(8, 'id', 'Jangan monoton', '<p>Meskipun rutinitas membuat kita lebih efisien dan meningkatkan perasaan aman dan aman, sedikit perubahan kecepatan dapat membuat jadwal yang membosankan. Ubah rute jogging Anda, rencanakan perjalanan, berjalan-jalan di taman yang berbeda, gantung beberapa foto baru, atau coba restoran baru. Lihat <a href=\"https://uhs.umich.edu/rejuvenation\">Peremajaan 101</a> untuk lebih banyak ide.</p>'),
(9, 'id', 'Hindari alkohol dan obat-obatan lainnya', '<p>Pertahankan penggunaan alkohol seminimal mungkin dan hindari obat-obatan lain. Kadang-kadang orang menggunakan alkohol dan obat-obatan lain untuk \"mengobati diri sendiri\" tetapi pada kenyataannya, alkohol dan obat-obatan lain hanya memperburuk masalah. Untuk informasi lebih lanjut, lihat Alkohol dan Narkoba Lainnya.</p>'),
(10, 'id', 'Dapatkan bantuan saat Anda membutuhkannya', '<p>Mencari bantuan adalah tanda kekuatan — bukan kelemahan. Dan penting untuk diingat bahwa pengobatan itu efektif. Orang yang mendapatkan perawatan yang tepat dapat pulih dari penyakit mental dan kecanduan dan menjalani kehidupan yang penuh dan bermanfaat. Lihat Sumber Daya untuk Stres dan Kesehatan Mental untuk sumber daya kampus dan komunitas.</p>'),
(11, 'en', 'Value yourself', '<p>Treat yourself with kindness and respect, and avoid self-criticism. Make time for your hobbies and favorite projects, or broaden your horizons. Do a daily crossword puzzle, plant a garden, take dance lessons, learn to play an instrument or become fluent in another language.</p>'),
(12, 'en', 'Take care of your body', '<p>Taking care of yourself physically can improve your mental health. Be sure to:</p>\n                <ul>\n                <li>Eat nutritious meals吃有营养的食物</li>\n                <li>Avoid smoking and vaping--&nbsp;see&nbsp;<a href=\"https://uhs.umich.edu/tobacco\">Cessation Help</a>避免吸烟和抽烟--参见&nbsp;<a href=\"https://uhs.umich.edu/tobacco\">Cessation Help</a></li>\n                <li>Drink plenty of water喝大量的水</li>\n                <li><a href=\"https://uhs.umich.edu/exercise\">Exercise</a>, which helps decrease depression and anxiety and improve moods锻炼，这有助于减少抑郁和焦虑，改善情绪</li>\n                <li>Get enough&nbsp;<a href=\"https://uhs.umich.edu/sleep\">sleep</a>. Researchers believe that lack of sleep contributes to a high rate of depression in college students.&nbsp;&ndash; 具有足够的睡眠。研究人员认为，缺乏睡眠会导致大学生抑郁症高发的原因</li>\n                </ul>'),
(13, 'en', 'Surround yourself with good people', '<p>People with strong family or social connections are generally healthier than those who lack a support network. Make plans with supportive family members and friends, or seek out activities where you can meet new people, such as a club, class or support group.</p>'),
(14, 'en', 'Give yourself', '<p>Volunteer your time and energy to help someone else. You`ll feel good about doing something tangible to help someone in need — and it`s a great way to meet new people. See Fun and Cheap Things to do in Ann Arbor for ideas.</p>'),
(15, 'en', 'Learn how to deal with stress', '<p>Like it or not, stress is a part of life. Practice good coping skills: Try One-Minute Stress Strategies, do Tai Chi, exercise, take a nature walk, play with your pet or try journal writing as a stress reducer. Also, remember to smile and see the humor in life. Research shows that laughter can boost your immune system, ease pain, relax your body and reduce stress.</p>'),
(16, 'en', 'Quiet your mind', '<p>Try meditating, Mindfulness and/or prayer. Relaxation exercises and prayer can improve your state of mind and outlook on life. In fact, research shows that meditation may help you feel calm and enhance the effects of therapy. To get connected, see spiritual resources on Personal Well-being for Students</p>'),
(17, 'en', 'Set realistic goals', '<p>Decide what you want to achieve academically, professionally and personally, and write down the steps you need to realize your goals. Aim high, but be realistic and don`t over-schedule. You`ll enjoy a tremendous sense of accomplishment and self-worth as you progress toward your goal. Wellness Coaching, free to U-M students, can help you develop goals and stay on track. </p>'),
(18, 'en', 'Break up the monotony', '<p>Although our routines make us more efficient and enhance our feelings of security and safety, a little change of pace can perk up a tedious schedule. Alter your jogging route, plan a road-trip, take a walk in a different park, hang some new pictures or try a new restaurant. See <a href=\"https://uhs.umich.edu/rejuvenation\">Rejuvenation 101</a> for more ideas.</p>'),
(19, 'en', 'Avoid alcohol and other drugs', '<p>Keep alcohol use to a minimum and avoid other drugs. Sometimes people use alcohol and other drugs to \"self-medicate\" but in reality, alcohol and other drugs only aggravate problems. For more information, see Alcohol and Other Drugs.</p>'),
(20, 'en', 'Get help when you need it', '<p>Seeking help is a sign of strength — not a weakness. And it is important to remember that treatment is effective. People who get appropriate care can recover from mental illness and addiction and lead full, rewarding lives. See Resources for Stress and Mental Health for campus and community resources.</p>'),
(21, 'cn', '重视自己。', '<p>通过进行一些活动保持你的心理健康 ，善待而尊重自己，避免自我批评。为你的爱好和喜欢的项目腾出时间，或拓宽你的视野。每天做一道填字游戏，种植，上舞蹈课，学习乐器或能够说一口流量外语。</p>'),
(22, 'cn', '照顾好身体', '<p>照顾好自己的身体可以改善你的心理健康。如下是大家一定要做到的事情。</p>\n                <ul>\n                <li>吃有营养的食物</li>\n                <li>避免吸烟和抽烟--参见&nbsp;<a href=\"https://uhs.umich.edu/tobacco\">Cessation Help</a></li>\n                <li>喝大量的水</li>\n                <li><a href=\"https://uhs.umich.edu/exercise\">Exercise</a>, 锻炼，这有助于减少抑郁和焦虑，改善情绪</li>\n                <li>具有足够的睡眠。研究人员认为，缺乏睡眠会导致大学生抑郁症高发的原因</li>\n                </ul>'),
(23, 'cn', '让自己与正能量的人在一起。', '<p>拥有强大的家庭或社会关系的人通常比那些无人脉的人更健康。尽量与支持我们的家人和朋友制定计划，或寻找一些可以让我们认识新朋友的活动，如俱乐部或相关的俱乐部。</p>'),
(24, 'cn', '奉献自己。', '<p>把自己的时间和精力去帮助别人。做一些实实在在的事情来帮助需要帮助的人，从此你会让我们感到已经成为了更好的自己--这也是认识新朋友的一个好方法。可以参考Fun and Cheap Things to do in Ann Arbor。</p>'),
(25, 'cn', ' 学会如何处理压力。', '<p>不管喜不喜欢，压力是我们生活的一部分。要具备应对技巧。可以尝试 \"  One-Minute Stress Strategies, \"，打太极拳，锻炼身体，在大自然中散步，与宠物玩耍，或尝试写日记也可以作为减低压力的方式。此外，记得要微笑，寻找生活中的幽默感。研究表明，笑声可以提高免疫系统，缓解疼痛，放松身体和减少压力。</p>'),
(26, 'cn', '让头脑安静下来。', '<p>冥想、正念和/或祈祷。松弛和祈祷可以改善精神状态和人生观。事实上，研究表明，冥想可以帮助我们感到平静，并增强治疗的效果。可以访问 Personal Well-being for Students。</p>'),
(27, 'cn', '设定现实的目标。', '<p>决定下来在学术上、专业上和个人想达到的目标，并写下你实现目标所需的步骤。目标要稍微高一点，但要现实，不要过度安排时间。当我们朝着目标前进时，就会享受到巨大的成就感和自我价值。 Wellness Coaching, 健康辅导，是免费给U-M学生使用的，可以帮助制定目标并坚持下去。</p>'),
(28, 'cn', '打破生活的单调感。', '<p>虽然我们的生活规律使我们更有效率，并会增强我们的安全感，但一点节奏的变化可以使乏味的日程表变得更有活力。改变慢跑路线，计划一次公路旅行，在不同的公园散步，挂一些新的照片或也可以尝试新的餐厅。更多想法请见 <a href=\"https://uhs.umich.edu/rejuvenation\">Rejuvenation 101</a>《恢复活力101》。</p>'),
(29, 'cn', '避免啤酒和其他药物。', '<p>将酒精的使用保持在最低限度，并避免使用药物。有时人们使用酒精和药物当做 \"自我治疗\"，但实际上，酒精和其他药物只会使问题恶化。了解更多信息，请参 Alcohol and Other Drugs.。</p>'),
(30, 'cn', '在你需要的时候寻求帮助。', '<p>寻求帮助是一种力量的象征--而不是一种弱点。而且我们要记住的事，治疗应该有效的。得到适当护理的人可以从精神疾病和成瘾中恢复过来，过上充实而有意义的生活。关于校园和社区资源，请参阅 Resources for Stress and Mental Health 压力和心理健康的资源。</p>');

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
(1, 'Admin Mental Health', 'admin@admin.id', '2022-06-27 17:40:45', '$2y$10$5cRMiE9wc9gZP3DzXJdt.OdhsPWUeTxSaVKwRfKGsqZXWZZV5pkVC', NULL, '2022-06-27 17:40:45', '2022-06-27 17:40:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`prov_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `question_category`
--
ALTER TABLE `question_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `question_translation`
--
ALTER TABLE `question_translation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_translation_question_id_foreign` (`question_id`),
  ADD KEY `question_translation_locale_index` (`locale`);

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
-- Indeks untuk tabel `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `rs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `pasien_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `question_category`
--
ALTER TABLE `question_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `question_translation`
--
ALTER TABLE `question_translation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Ketidakleluasaan untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_id` FOREIGN KEY (`category_id`) REFERENCES `question_category` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question_translation`
--
ALTER TABLE `question_translation`
  ADD CONSTRAINT `question_translation_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

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
