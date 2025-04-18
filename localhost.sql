-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2025 at 10:18 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jejakkebaikan`
--
CREATE DATABASE IF NOT EXISTS `jejakkebaikan` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jejakkebaikan`;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Kemanusiaan', 'kemanusiaan', 'icons/DBCC1s10ChibT0H74qdr2nuMWUj7FB6XHRZ2H2kO.jpg', NULL, '2025-04-11 06:52:20', '2025-04-17 00:20:12'),
(2, 'Donasi Pakaian', 'donasi-pakaian', 'icons/AYZNr42EK5Yp8cAQFDoIq4yCHroD72m4v7CXFjXF.png', '2025-04-11 07:17:36', '2025-04-11 06:53:02', '2025-04-11 07:17:36'),
(3, 'Bencana Alam', 'bencana-alam', 'icons/AmJNMHcMUgzaqpA0U94h2KFiYb3pd97mtUaM68A8.png', NULL, '2025-04-11 07:01:06', '2025-04-17 00:15:23'),
(4, 'Balita & Anak Sakit', 'balita-anak-sakit', 'icons/0nnH6YrprTrzRL5qAIRKrXAb19baN49tQ10hL8Kz.jpg', NULL, '2025-04-14 20:43:46', '2025-04-17 00:22:06'),
(5, 'Bantuan Sosial', 'bantuan-sosial', 'icons/Q9w7HlQ634vNKWy7vAHBypyGhacZOr5DSyLlKXbZ.jpg', NULL, '2025-04-17 00:44:49', '2025-04-17 00:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `donaturs`
--

CREATE TABLE `donaturs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fundraising_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` bigint(20) UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donaturs`
--

INSERT INTO `donaturs` (`id`, `name`, `phone_number`, `fundraising_id`, `total_amount`, `notes`, `proof`, `is_paid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Abdul', '08242536378', 2, 250000, 'jangan menyerah yaa', 'proofs/buktitrfxx.png', 1, NULL, '2025-04-13 09:14:56', '2025-04-13 10:12:42'),
(2, 'Jarjit', '08242536378', 2, 380000, 'jangan menyerah yaa', 'proofs/buktitrfxx.png', 1, NULL, '2025-04-13 09:16:43', '2025-04-13 10:10:18'),
(3, 'sultan', '082313718869', 2, 100000000, 'semangattttt', 'proofs/buktitrfxxx.png', 1, NULL, '2025-04-13 23:58:01', '2025-04-13 23:58:34'),
(4, 'EKO', '081281902642', 3, 50000, 'MEREKA SENANG', 'proofs/Zz3q4yFnQzM7C2we0WHmQKSKQk5rtpOLwp1drLyt.jpg', 1, NULL, '2025-04-15 20:30:48', '2025-04-15 20:32:39'),
(5, 'Jaka', '081281902642', 4, 50000, 'Semangat', 'proofs/eJ9wiUhby0VlPnguEn9Im8MP0q4xVjSCK9tlp7lO.jpg', 1, NULL, '2025-04-16 18:48:33', '2025-04-16 18:52:50'),
(6, 'Ipin', '82313718856', 5, 200000, 'Semoga bermanfaat', 'proofs/LEzdl3VtSig8L7aLaVqL85kEuZTGSlFg4jKERKHJ.jpg', 1, NULL, '2025-04-17 00:46:18', '2025-04-17 00:46:46');

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
-- Table structure for table `fundraisers`
--

CREATE TABLE `fundraisers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fundraisers`
--

INSERT INTO `fundraisers` (`id`, `user_id`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, '2025-04-11 22:54:38', '2025-04-11 23:25:34'),
(2, 2, 1, NULL, '2025-04-11 23:27:14', '2025-04-11 23:28:30'),
(3, 4, 1, NULL, '2025-04-17 00:39:53', '2025-04-17 00:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `fundraisings`
--

CREATE TABLE `fundraisings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_amount` bigint(20) UNSIGNED NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `has_finished` tinyint(1) NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fundraiser_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fundraisings`
--

INSERT INTO `fundraisings` (`id`, `name`, `slug`, `target_amount`, `about`, `is_active`, `has_finished`, `thumbnail`, `fundraiser_id`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ayo Bantu Korban Palestina', NULL, 800000000, 'lorem ipsum', 0, 0, 'thumbnails/qlWMz0ABAHgQP4WwIhjbnCBOnLv9Xwzu9hEbDqCw.png', 1, 3, '2025-04-13 06:36:31', '2025-04-12 02:08:41', '2025-04-13 06:36:31'),
(2, 'Gunung Meletus', 'gunung-meletus', 100000000, 'tolong', 1, 1, 'thumbnails/aoTMFTKAuwKSJoW9jWaZUWvvKBLrZcTIQDnflw1z.jpg', 1, 3, NULL, '2025-04-13 06:37:59', '2025-04-16 18:21:24'),
(3, 'Bantu Korban Palestina', 'bantu-korban-palestina', 50000, 'Lorem', 1, 1, 'thumbnails/FK3asIpwep2vfmLuY35eGegEk484D1o22ghLaxC2.png', 2, 1, NULL, '2025-04-15 07:30:21', '2025-04-15 20:57:10'),
(4, 'Bantu Korban Banjir Jakarta', 'bantu-korban-banjir-jakarta', 39999998, 'bantu korban banjir jakarta', 1, 0, 'thumbnails/7QMBvbTcTvZzVPVvdbgsigobTL3Ynyb9zV5PAaDU.jpg', 1, 3, NULL, '2025-04-16 18:28:38', '2025-04-16 18:29:12'),
(5, 'Bantuan Sembako Untuk Tukang Parkir', 'bantuan-sembako-untuk-tukang-parkir', 200000, 'Lorem Ipsum', 1, 1, 'thumbnails/eiBsGeSA2ZJEhE4jlp6wQrkGp3vNmkFFvtjm67Ql.jpg', 3, 5, NULL, '2025-04-17 00:41:47', '2025-04-17 00:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `fundraising_phases`
--

CREATE TABLE `fundraising_phases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fundraising_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fundraising_phases`
--

INSERT INTO `fundraising_phases` (`id`, `name`, `notes`, `photo`, `fundraising_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'haha', 'ok', 'photos/OEhqWNLEHUAXF0N3nGVWIqnJEChYnR9TYCE6nhV1.jpg', 2, NULL, '2025-04-14 08:51:04', '2025-04-14 08:51:04'),
(2, 'Indonesia Bisa', 'mereka senang', 'photos/gvf1NBF3PWgyBMypTlkQqUj3bY4RDbhwVn9GYLLd.jpg', 3, NULL, '2025-04-15 20:57:10', '2025-04-15 20:57:10'),
(3, 'Budi', 'mereka senang', 'photos/5L7TcAGUyj0UBnhN9WgdTxpgJU79pKsqjiY8pFl7.png', 5, NULL, '2025-04-17 00:50:52', '2025-04-17 00:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `fundraising_withdrawals`
--

CREATE TABLE `fundraising_withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_requested` bigint(20) UNSIGNED NOT NULL,
  `amount_received` bigint(20) UNSIGNED NOT NULL,
  `has_received` tinyint(1) NOT NULL,
  `has_sent` tinyint(1) NOT NULL,
  `fundraiser_id` bigint(20) UNSIGNED NOT NULL,
  `fundraising_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fundraising_withdrawals`
--

INSERT INTO `fundraising_withdrawals` (`id`, `proof`, `bank_name`, `bank_account_number`, `bank_account_name`, `amount_requested`, `amount_received`, `has_received`, `has_sent`, `fundraiser_id`, `fundraising_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'proofs/SU2t9mxGXbGOp4ocNQmXs3l2IdVHJdxPvsfG8AAR.jpg', 'sendiri bank', '096456827', 'jamaludin', 100630000, 0, 1, 1, 1, 2, NULL, '2025-04-14 00:50:54', '2025-04-14 08:51:04'),
(2, 'proofs/ucqGBnpbZx22IHQgctLO2xRPjFt4jxddQKLDQaUp.jpg', 'Sendiri Bank', '121321323', 'IndonesiaBisa', 50000, 0, 1, 1, 2, 3, NULL, '2025-04-15 20:54:49', '2025-04-15 20:57:10'),
(3, 'proofs/02ZSp7oFmJzReOCNwehvC66HMXIuHzZQVXGygjk6.jpg', 'Sendiri Bank', '231343243243', 'Budi Sentosa', 200000, 0, 1, 1, 3, 5, NULL, '2025-04-17 00:49:09', '2025-04-17 00:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_09_130810_create_permission_tables', 1),
(5, '2025_04_09_134239_create_categories_table', 1),
(6, '2025_04_09_134953_create_fundraisers_table', 1),
(7, '2025_04_09_134954_create_fundraisings_table', 1),
(8, '2025_04_09_135106_create_fundraising_withdrawals_table', 1),
(9, '2025_04_09_135151_create_fundraising_phases_table', 1),
(10, '2025_04_09_135211_create_donaturs_table', 1),
(11, '2025_04_12_085232_rename_anout_to_about_in_fundraisings', 2),
(12, '2025_04_12_085718_rename_anout_to_about_in_fundraisings', 3),
(13, '2025_04_12_090637_modify_slug_column_in_fundraisings', 4);

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

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2025-04-10 08:24:06', '2025-04-10 08:24:06'),
(2, 'fundraiser', 'web', '2025-04-10 08:24:06', '2025-04-10 08:24:06');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('r2KB4gNOL95bwTLfKHQN2uhqAdYC70LDHrC6fRTN', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVFEODRacTRHeVV3eWM0ejVaTDNZWHY0VmNNblBKTFpGdmZVYzJYRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1744876304);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Reza Diva', 'images/default-avatar.png', 'reza@owner.com', NULL, '$2y$12$i9G1lxBglchtXM5OPWwXvOPMaLSosnEdBMEt/WC99r5e5hJPaJjDW', NULL, '2025-04-10 08:24:06', '2025-04-10 08:24:06'),
(2, 'Indonesia Bisa', 'avatars/o2Sm7x5zYnsBTEqexCUekJC62QJTNWBrU2sDTQsc.png', 'indonesia@bisa.com', NULL, '$2y$12$GlCoCEBjl1UVegn.XPJGWepHPjQqA.oyq5eS36iB2FPBE1whufne2', NULL, '2025-04-11 21:00:40', '2025-04-11 21:00:40'),
(3, 'Jamal', 'avatars/4zLbJ450D0WmNPFywKbKLhxqVA03fQqV7PLqCnJ4.jpg', 'jamal@gmail.com', NULL, '$2y$12$YCYLJOca8nYVapa9vyueZu0OnR6yPoggoL4xkzGA7FstFkk6bDyD2', NULL, '2025-04-11 21:15:32', '2025-04-11 21:15:32'),
(4, 'Budi', 'avatars/tXg0WEWqfPzDEGI4ggDCddW7VK5lJ0zD2Zj7Ie4l.jpg', 'budi@gmail.com', NULL, '$2y$12$tna1pmpVxm/uuil/QGOtX.Rpzu8HqAdjALE//OVI/9N17ZCe4UcRa', NULL, '2025-04-17 00:38:38', '2025-04-17 00:38:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donaturs`
--
ALTER TABLE `donaturs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donaturs_fundraising_id_foreign` (`fundraising_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fundraisings`
--
ALTER TABLE `fundraisings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fundraisings_fundraiser_id_foreign` (`fundraiser_id`),
  ADD KEY `fundraisings_category_id_foreign` (`category_id`);

--
-- Indexes for table `fundraising_phases`
--
ALTER TABLE `fundraising_phases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fundraising_phases_fundraising_id_foreign` (`fundraising_id`);

--
-- Indexes for table `fundraising_withdrawals`
--
ALTER TABLE `fundraising_withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fundraising_withdrawals_fundraiser_id_foreign` (`fundraiser_id`),
  ADD KEY `fundraising_withdrawals_fundraising_id_foreign` (`fundraising_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donaturs`
--
ALTER TABLE `donaturs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fundraisers`
--
ALTER TABLE `fundraisers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fundraisings`
--
ALTER TABLE `fundraisings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fundraising_phases`
--
ALTER TABLE `fundraising_phases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fundraising_withdrawals`
--
ALTER TABLE `fundraising_withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donaturs`
--
ALTER TABLE `donaturs`
  ADD CONSTRAINT `donaturs_fundraising_id_foreign` FOREIGN KEY (`fundraising_id`) REFERENCES `fundraisings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fundraisings`
--
ALTER TABLE `fundraisings`
  ADD CONSTRAINT `fundraisings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fundraisings_fundraiser_id_foreign` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraisers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fundraising_phases`
--
ALTER TABLE `fundraising_phases`
  ADD CONSTRAINT `fundraising_phases_fundraising_id_foreign` FOREIGN KEY (`fundraising_id`) REFERENCES `fundraisings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fundraising_withdrawals`
--
ALTER TABLE `fundraising_withdrawals`
  ADD CONSTRAINT `fundraising_withdrawals_fundraiser_id_foreign` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraisers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fundraising_withdrawals_fundraising_id_foreign` FOREIGN KEY (`fundraising_id`) REFERENCES `fundraisings` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
