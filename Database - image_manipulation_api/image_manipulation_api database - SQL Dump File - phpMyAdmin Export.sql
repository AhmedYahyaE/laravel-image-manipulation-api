-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2023 at 01:33 AM
-- Server version: 8.0.28
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image_manipulation_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Linux [updated]', '2022-12-21 22:45:19', '2022-12-21 23:24:10', 1),
(2, 'Cats', '2022-12-21 22:51:35', '2022-12-21 22:51:35', 1),
(3, 'Dogs', '2022-12-21 22:52:32', '2022-12-21 22:52:32', NULL),
(4, 'Cars', '2022-12-21 22:55:13', '2022-12-21 22:55:13', NULL),
(5, 'Vehicles', '2023-02-04 10:36:14', '2023-02-04 10:36:14', NULL),
(6, 'Roses', '2023-02-22 09:22:46', '2023-02-22 09:22:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_manipulations`
--

CREATE TABLE `image_manipulations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `output_path` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `album_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_manipulations`
--

INSERT INTO `image_manipulations` (`id`, `name`, `path`, `type`, `data`, `output_path`, `created_at`, `user_id`, `album_id`) VALUES
(1, 'img_lights.jpg', 'images/nRMiP0kMCKcxmVjJ/img_lights.jpg', 'resize', '{\"w\":\"100\"}', 'images/nRMiP0kMCKcxmVjJ/img_lights-resized.jpg', '2023-02-13 18:09:25', 1, NULL),
(2, 'img_lights.jpg', 'images/J5f0v6SafGfsGdv6/img_lights.jpg', 'resize', '{\"w\":\"100\"}', 'images/J5f0v6SafGfsGdv6/img_lights-resized.jpg', NULL, 1, NULL),
(3, 'img_lights.jpg', 'images/CYWySSiiMVgNfpbc/img_lights.jpg', 'resize', '{\"w\":\"100\"}', 'images/CYWySSiiMVgNfpbc/img_lights-resized.jpg', '2023-02-13 20:11:47', NULL, NULL),
(4, 'img_lights.jpg', 'images/NN7AIVolUxrima6C/img_lights.jpg', 'resize', '{\"w\":\"100\"}', 'images/NN7AIVolUxrima6C/img_lights-resized.jpg', '2023-02-13 20:16:56', NULL, NULL),
(5, 'img_lights.jpg', 'images/RvOkc0jke89cpj2m/img_lights.jpg', 'resize', '{\"w\":\"100\"}', 'images/RvOkc0jke89cpj2m/img_lights-resized.jpg', '2023-02-13 22:51:17', NULL, NULL),
(6, 'img_lights.jpg', 'images/s31s1UnuGBqkltTI/img_lights.jpg', 'resize', '{\"album_id\":3,\"w\":\"100\"}', 'images/s31s1UnuGBqkltTI/img_lights-resized.jpg', '2023-02-13 22:53:55', NULL, 3),
(7, 'img_lights.jpg', 'images/fBUz7JlU1lHy4AHx/img_lights.jpg', 'resize', '{\"album_id\":3,\"w\":\"100\"}', 'images/fBUz7JlU1lHy4AHx/img_lights-resized.jpg', '2023-02-13 22:54:25', NULL, 3),
(8, 'img_lights.jpg', 'images/DfTPZ2FwRi87mgkG/img_lights.jpg', 'resize', '{\"album_id\":3,\"w\":\"100\"}', 'images/DfTPZ2FwRi87mgkG/img_lights-resized.jpg', '2023-02-13 22:55:37', NULL, 3),
(10, 'img_lights.jpg', 'images/pUmAx50BXUSdvfdQ/img_lights.jpg', 'resize', '{\"album_id\":3,\"w\":\"100\"}', 'images/pUmAx50BXUSdvfdQ/img_lights-resized.jpg', '2023-02-16 21:56:05', NULL, 3),
(11, 'img_lights.jpg', 'images/Q2do4WsZBb2iNW0N/img_lights.jpg', 'resize', '{\"album_id\":2,\"w\":\"100\"}', 'images/Q2do4WsZBb2iNW0N/img_lights-resized.jpg', '2023-02-22 11:13:13', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2022_12_07_023123_create_albums_table', 1),
(12, '2022_12_07_031053_create_image_manipulations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Main', '15aaafd4fbb102d9661ef7c3ac335ad32b955fbba957b49cb58650c22f356383', '[\"*\"]', NULL, NULL, '2023-02-21 16:13:29', '2023-02-21 16:13:29'),
(2, 'App\\Models\\User', 1, 'Main', '72c6341f77c1f5b6184577296ebef14ff5464634ffbc88125d926f34f15eb218', '[\"*\"]', NULL, NULL, '2023-02-21 16:16:32', '2023-02-21 16:16:32'),
(3, 'App\\Models\\User', 1, 'Main', '55a5e715dc4d1e4fd2d2acf4bdc99d075252c1adeb2cddc96c9ab9132b9c1b31', '[\"*\"]', NULL, NULL, '2023-02-21 16:17:09', '2023-02-21 16:17:09'),
(7, 'App\\Models\\User', 1, 'My Postman Token', 'c2e54ce6626e4cb1484fcdfaf97a3115fec7c1e3fbac90995258ccf051511261', '[\"*\"]', '2023-08-01 22:32:46', NULL, '2023-08-01 22:31:25', '2023-08-01 22:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Yahya', 'ahmed.yahya@example.com', NULL, '$2y$10$FIKmadZ8AyHYPJJE4gHSY.ob7Gr5aFrU7XksML3GMik0WpvjGYc.y', NULL, '2023-02-17 20:23:27', '2023-02-17 20:23:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `image_manipulations`
--
ALTER TABLE `image_manipulations`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_manipulations`
--
ALTER TABLE `image_manipulations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
