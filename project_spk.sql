-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 07, 2023 at 01:00 PM
-- Server version: 8.0.28
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A01', 'Luh Putu Manik Yuningsih', '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(2, 'A02', 'Ni Wayan Yunik Wilandari', '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(3, 'A03', 'Ni Wayan Sariani', '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(4, 'A04', 'I Made Raihan', '2023-11-07 12:54:00', '2023-11-07 12:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `auto_numbers`
--

CREATE TABLE `auto_numbers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auto_numbers`
--

INSERT INTO `auto_numbers` (`id`, `name`, `number`, `created_at`, `updated_at`) VALUES
(1, 'db40d31e7d500dce376fac61ad0e436b', 4, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(2, '817c3fb16a9263ab58d6ebbc542dcbea', 4, '2023-11-07 12:54:00', '2023-11-07 12:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `phone`, `address`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Kid\'z Cafe Sanur', '080238423080', 'Jalan Teuku Umar', 'http://localhost:8000/image/logo.jpeg', '2023-11-07 12:53:59', '2023-11-07 12:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('benefit','cost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `optimum` enum('min','max') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `name`, `type`, `optimum`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C01', 'Disiplin', 'benefit', 'max', '2023-11-07 12:54:00', '2023-11-07 12:54:00', NULL),
(2, 'C02', 'Hasil Kerja', 'benefit', 'max', '2023-11-07 12:54:00', '2023-11-07 12:54:00', NULL),
(3, 'C03', 'Tanggung Jawab', 'benefit', 'max', '2023-11-07 12:54:00', '2023-11-07 12:54:00', NULL),
(4, 'C04', 'Kerja Sama Tim', 'benefit', 'max', '2023-11-07 12:54:00', '2023-11-07 12:54:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_03_055212_create_auto_numbers', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_10_19_151350_create_kriterias_table', 1),
(7, '2023_10_24_133820_create_alternatif_table', 1),
(8, '2023_10_24_134107_create_penilaian_table', 1),
(9, '2023_10_26_133152_create_rankings_table', 1),
(10, '2023_10_26_134313_drop_nilai_bobot_column_table', 1),
(11, '2023_11_04_122136_create_companies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` bigint UNSIGNED NOT NULL,
  `alternatif_id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `nilai` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `alternatif_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(2, 1, 2, 5.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(3, 1, 3, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(4, 1, 4, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(5, 2, 1, 5.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(6, 2, 2, 3.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(7, 2, 3, 5.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(8, 2, 4, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(9, 3, 1, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(10, 3, 2, 5.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(11, 3, 3, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(12, 3, 4, 5.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(13, 4, 1, 5.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(14, 4, 2, 4.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(15, 4, 3, 3.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00'),
(16, 4, 4, 3.00, '2023-11-07 12:54:00', '2023-11-07 12:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rankings`
--

CREATE TABLE `rankings` (
  `id` bigint UNSIGNED NOT NULL,
  `alternatif_id` bigint UNSIGNED NOT NULL,
  `total_nilai` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$bYr8L953ogzrfFr8/kcWBOVfDZQJBncTKL9dMcZPzLKNBCruI152G', NULL, '2023-11-07 12:53:59', '2023-11-07 12:53:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_numbers`
--
ALTER TABLE `auto_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_alternatif_id_foreign` (`alternatif_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rankings`
--
ALTER TABLE `rankings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auto_numbers`
--
ALTER TABLE `auto_numbers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rankings`
--
ALTER TABLE `rankings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
