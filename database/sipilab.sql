-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2026 at 03:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipilab`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_piket_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_absen` time DEFAULT NULL,
  `status` enum('Hadir','Terlambat','Tidak Hadir') DEFAULT NULL,
  `bukti_foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `jadwal_piket_id`, `tanggal`, `jam_absen`, `status`, `bukti_foto`, `created_at`, `updated_at`) VALUES
(1, 10, 6, '2026-07-06', '07:42:31', 'Hadir', '1783298551_logo-ti.png', '2026-07-06 00:42:31', '2026-07-06 00:42:31'),
(2, 11, 10, '2026-07-12', '10:40:18', 'Hadir', '1783827618_images.jpeg', '2026-07-12 03:40:18', '2026-07-12 03:40:18'),
(3, 12, 13, '2026-07-12', '11:17:29', 'Hadir', '1783829849_Biaya-Kuliah-Politeknik-Negeri-Cilacap-Terbaru-1024x660.jpg', '2026-07-12 04:17:29', '2026-07-12 04:17:29'),
(4, 12, 14, '2026-07-13', '08:15:12', 'Hadir', '1783930512_9bcdcf8223af17ec8b23.jpeg', '2026-07-13 01:15:12', '2026-07-13 01:15:12'),
(5, 12, 14, '2026-07-13', '10:27:26', 'Hadir', '1783938446_1657d9dfabc87a50012e.png', '2026-07-13 03:27:26', '2026-07-13 03:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_piket`
--

CREATE TABLE `jadwal_piket` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `laboratorium_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_piket`
--

INSERT INTO `jadwal_piket` (`id`, `user_id`, `laboratorium_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(4, 9, 1, '2026-07-10', '08:00:00', '09:00:00', 'Aktif'),
(5, NULL, 5, '2026-07-10', '10:00:00', '11:00:00', 'Aktif'),
(6, 10, 4, '2026-07-06', '10:00:00', '12:00:00', 'Selesai'),
(7, 10, 1, '2026-07-15', '08:00:00', '10:00:00', 'Aktif'),
(8, NULL, 2, '2026-07-18', '10:00:00', '12:00:00', 'Aktif'),
(9, NULL, 3, '2026-07-20', '13:00:00', '15:00:00', 'Aktif'),
(10, 11, 1, '2026-07-12', '10:00:00', '11:00:00', 'Selesai'),
(11, 11, 5, '2026-07-14', '08:30:00', '09:30:00', 'Aktif'),
(13, 12, 5, '2026-07-12', '10:30:00', '11:30:00', 'Selesai'),
(14, 12, 1, '2026-07-15', '13:30:00', '14:30:00', 'Aktif'),
(15, 13, 2, '2026-07-16', '08:00:00', '10:00:00', 'Aktif'),
(16, 14, 3, '2026-07-17', '13:00:00', '15:00:00', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id` int(11) NOT NULL,
  `nama_lab` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`id`, `nama_lab`, `lokasi`, `kapasitas`) VALUES
(1, 'Lab Komputer 1', 'GTIL Lt.4', 30),
(2, 'Lab Komputer 2', 'GTIL Lt.4', 30),
(3, 'Lab Komputer 3', 'GTIL Lt.5', 33),
(4, 'Lab Multimedia', 'GTIL Lt.4', 30),
(5, 'Lab Jaringan', 'GTIL Lt.5', 35);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EGW2vuXs40YOC1P9Q2E7ctGx9mDc5xkIPZIJtOcm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGkwWWxCUjlPaUE1Zk9BbG9QOWtiNVJqZktWcVFOWWx3R0RTSEZjWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1783868753),
('rI6R01oJdo1kOAV5SbNZHmBwBPdD9DDgcFW5VnaB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWFYYUJaZDVYcDdjdkl3THlVeEJGNzZzU2ZlZW04WVh2R1hwdkZFZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1783870400),
('soT9C0HdXb94uoqjeJNtY8fUx05VgL7yUofIN7qT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlBNdEFrMDNNYWNqclFGbUlxZ2x3Y3NJcTNKcEFXc2xHSm92Z2NoZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787122320);

-- --------------------------------------------------------

--
-- Table structure for table `tukar_jadwal`
--

CREATE TABLE `tukar_jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_awal_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_pengganti_id` bigint(20) UNSIGNED NOT NULL,
  `alasan` text NOT NULL,
  `status` enum('Pending','Disetujui','Ditolak') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tukar_jadwal`
--

INSERT INTO `tukar_jadwal` (`id`, `user_id`, `jadwal_awal_id`, `jadwal_pengganti_id`, `alasan`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 5, 7, 'Acara keluarga', 'Disetujui', '2026-07-09 02:37:53', '2026-07-09 03:38:47'),
(2, 11, 11, 8, 'Sakit', 'Pending', '2026-07-12 04:19:39', '2026-07-12 04:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','mahasiswa') DEFAULT 'mahasiswa',
  `nim` varchar(30) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `nim`, `prodi`, `semester`, `foto_profil`) VALUES
(3, 'Admin SIPILAB', 'admin@sipilab.com', NULL, '$2y$12$56QXFBjJr4xo2qt9xYUXwO1IUoSoOxZcxA/ZP/luF9aRiU/YCZeCy', NULL, '2026-06-23 18:00:36', '2026-06-23 18:00:36', 'admin', NULL, NULL, NULL, NULL),
(10, 'Lee Haechan', 'haechan@gmail.com', NULL, '$2y$12$a2Db4eB/BGRCKCLUjt9fjugaG7DRJib9NOOttl2yvHV1rOXYiFNE.', NULL, '2026-07-05 16:00:21', '2026-07-11 22:50:36', 'mahasiswa', '240102020', 'Rekayasa Keamanan Siber', '2', '1783763908_download.webp'),
(11, 'Jerome Polin Sijabat', 'jerome@gmail.com', NULL, '$2y$12$bLiJE25QmYutdFaBL7fDNeqKdMtWLa4In5.4a6PCcOJES8GsFi//.', NULL, '2026-07-12 01:51:22', '2026-07-12 01:51:22', 'mahasiswa', '240102001', 'Rekayasa Keamanan Siber', '6', NULL),
(12, 'Itsneinfah Nur Iffatun', 'itsneinfah21@gmail.com', NULL, '$2y$12$JQ3cuZ1hqb3rAhDPwmPfouaj5cHI47t0beCANoVkde2qyHuIIDUqu', NULL, '2026-07-12 04:10:44', '2026-07-12 15:27:24', 'mahasiswa', '240102018', 'Teknik Informatika', '4', '1783870044_IMG-20260222-WA0053.jpg.jpeg'),
(13, 'nur', 'nur@gmail.com', NULL, '$2y$10$.sFUGHJz5QesZI085KAcvOBdptmCIjEYyIwL/uk866xvWggzbalO.', NULL, NULL, NULL, 'mahasiswa', '240102099', 'Teknik Informatika', '4', NULL),
(14, 'Dokyeom', 'dk@gmail.com', NULL, '$2y$10$fnJQtbw/yv.LAG1eNlJRAezl3A3YhhyLhwnTyO.vAL1BarlBAmQaG', NULL, NULL, NULL, 'mahasiswa', '240102010', 'TE', '5', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_piket`
--
ALTER TABLE `jadwal_piket`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tukar_jadwal`
--
ALTER TABLE `tukar_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tukar_jadwal_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_piket`
--
ALTER TABLE `jadwal_piket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tukar_jadwal`
--
ALTER TABLE `tukar_jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tukar_jadwal`
--
ALTER TABLE `tukar_jadwal`
  ADD CONSTRAINT `tukar_jadwal_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
