-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2021 at 10:47 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `extra_holiday`
--

CREATE TABLE `extra_holiday` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_key` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_flag` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_holiday`
--

INSERT INTO `extra_holiday` (`id`, `date_key`, `date_flag`, `comment`, `schedule_comment`, `schedule_time`, `created_at`, `updated_at`) VALUES
(2, '20201124', 2, '休む', NULL, '00:00:00', '2020-11-14 21:18:18', '2020-11-14 21:18:26'),
(4, '20201223', 1, 'クリスマスだから', NULL, '00:00:00', '2020-11-14 21:41:23', '2020-11-14 21:41:49'),
(5, '20201230', 2, 'めっちゃ酒飲む', NULL, '00:00:00', '2020-11-14 21:41:23', '2020-11-14 21:41:49'),
(8, '20201222', 2, '休む', NULL, '00:00:00', '2020-11-28 23:49:20', '2020-11-28 23:49:20'),
(9, '20201221', 2, NULL, NULL, '00:00:00', '2020-11-28 23:56:35', '2020-11-28 23:56:35'),
(11, '20201106', 1, 'やる', NULL, '00:00:00', '2020-11-29 00:28:19', '2020-11-29 00:28:30'),
(13, '20201210', 2, '休む', NULL, '00:00:00', '2020-12-29 20:42:43', '2020-12-29 20:42:51'),
(14, '20210101', 0, NULL, 'あああ', '10:10:00', '2021-01-23 21:27:39', '2021-01-23 21:27:39'),
(23, '20201227', 0, NULL, 'qqq', '10:11:00', '2021-01-23 23:11:05', '2021-01-23 23:11:05'),
(26, '20201226', 0, NULL, 'eee', '10:11:00', '2021-01-23 23:14:00', '2021-01-23 23:14:00'),
(28, '20201226', 0, NULL, 'rrr', '10:11:00', '2021-01-23 23:23:23', '2021-01-23 23:23:23'),
(29, '20201226', 0, NULL, 'ttt', '11:10:00', '2021-01-23 23:57:18', '2021-01-23 23:57:18'),
(30, '20201226', 0, NULL, '出勤', '10:30:00', '2021-01-24 00:06:52', '2021-01-24 00:06:52'),
(31, '20201226', 0, NULL, '起床', '09:10:00', '2021-01-24 00:09:23', '2021-01-24 00:09:23'),
(32, '20201228', 0, NULL, '会議', '10:10:00', '2021-01-24 00:28:10', '2021-01-24 00:28:10'),
(33, '20201228', 0, NULL, '帰宅', '20:00:00', '2021-01-24 00:28:20', '2021-01-24 00:28:20'),
(34, '20201228', 0, NULL, '昼食', '12:30:00', '2021-01-24 00:28:38', '2021-01-24 00:28:38'),
(35, '20210103', 0, NULL, '長文の予定を入れるとどうなるのか実験長文の予定を入れるとどうなるのか実験長文の予定を入れるとどうなるのか実験長文の予定を入れるとどうなるのか実験', '09:00:00', '2021-01-24 00:30:34', '2021-01-24 00:30:34'),
(36, '20210117', 0, NULL, '彼女に会う', '18:30:00', '2021-01-24 00:40:48', '2021-01-24 00:40:48'),
(41, '20210124', 0, NULL, '起床', '09:00:00', '2021-01-27 20:54:40', '2021-01-27 20:54:40'),
(42, '20210124', 0, NULL, '昼食', '12:00:00', '2021-01-27 20:54:52', '2021-01-27 20:54:52'),
(43, '20210124', 0, NULL, '休憩', '15:30:00', '2021-01-27 20:55:06', '2021-01-27 20:55:06'),
(44, '20210124', 0, NULL, '退勤', '18:30:00', '2021-01-27 20:55:21', '2021-01-27 20:55:21');

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
-- Table structure for table `holiday_setting`
--

CREATE TABLE `holiday_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flag_mon` int(11) NOT NULL,
  `flag_tue` int(11) NOT NULL,
  `flag_wed` int(11) NOT NULL,
  `flag_thur` int(11) NOT NULL,
  `flag_fri` int(11) NOT NULL,
  `flag_sat` int(11) NOT NULL,
  `flag_sun` int(11) NOT NULL,
  `flag_holiday` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holiday_setting`
--

INSERT INTO `holiday_setting` (`id`, `flag_mon`, `flag_tue`, `flag_wed`, `flag_thur`, `flag_fri`, `flag_sat`, `flag_sun`, `flag_holiday`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 1, 1, 1, 2, 2, 2, '2020-11-10 03:34:44', '2021-01-24 01:02:42');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_08_070307_create_holiday_setting_table', 2),
(5, '2020_11_10_124731_create_extra_holiday_table', 3),
(6, '2021_01_15_013529_add_user_schedule_to_extra_holiday_table', 4);

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
-- Table structure for table `users`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `extra_holiday`
--
ALTER TABLE `extra_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holiday_setting`
--
ALTER TABLE `holiday_setting`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extra_holiday`
--
ALTER TABLE `extra_holiday`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday_setting`
--
ALTER TABLE `holiday_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
