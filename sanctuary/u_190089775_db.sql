-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2021 at 01:32 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_190089775_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `animalid` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','denied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`id`, `userid`, `animalid`, `status`, `created_at`, `updated_at`) VALUES
(12, 2, 15, 'accepted', '2021-05-03 12:33:21', '2021-05-03 12:35:13'),
(13, 2, 2, 'denied', '2021-05-03 12:33:29', '2021-05-03 12:36:00'),
(14, 2, 16, 'accepted', '2021-05-03 12:33:32', '2021-05-03 12:35:50'),
(16, 3, 15, 'denied', '2021-05-03 12:34:24', '2021-05-03 12:35:13'),
(17, 3, 1, 'accepted', '2021-05-03 12:34:29', '2021-05-03 12:35:57'),
(18, 3, 7, 'pending', '2021-05-03 12:34:32', '2021-05-03 12:34:32'),
(19, 3, 3, 'pending', '2021-05-03 12:34:34', '2021-05-03 12:34:34'),
(22, 2, 3, 'pending', '2021-05-03 12:58:57', '2021-05-03 12:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` enum('Available','Unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `secondimage` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `date_of_birth`, `description`, `image`, `availability`, `created_at`, `updated_at`, `secondimage`) VALUES
(1, 'Keith', '21/10/21', 'Keith is shy.', 'noimage.jpg', 'Unavailable', '2021-04-20 14:37:46', '2021-05-03 12:35:57', 'noimage.jpg'),
(2, 'Garfield', '01/01/20', 'Garfield is a ginger cat, loves lasagne.', 'noimage.jpg', 'Available', '2021-04-23 16:09:30', '2021-05-03 18:08:47', 'noimage.jpg'),
(3, 'Frank', '08/03/21', '6\'7 NBA all-star.', 'noimage.jpg', 'Available', '2021-04-23 16:11:39', '2021-05-03 12:59:44', 'noimage.jpg'),
(7, 'James', '08/09/21', 'James is an alien.', 'monke_1620048997.JPG', 'Available', '2021-04-25 15:41:43', '2021-05-03 12:36:37', 'monke_1620048997.JPG'),
(15, 'Monke', '2/8/2001', 'CUTE MONKEY', 'noimage.jpg', 'Unavailable', '2021-04-27 23:17:37', '2021-05-03 12:35:13', 'noimage.jpg'),
(16, 'mm', '10/10/10', 'description', 'monke_1620084644.JPG', 'Unavailable', '2021-05-02 18:12:18', '2021-05-03 22:30:44', 'monke_1620084644.JPG'),
(18, 'Samantha', '10/10/10', 'samantha samantha', 'monke_1620130411.JPG', 'Available', '2021-05-04 11:13:31', '2021-05-04 11:13:31', 'monke_1620130411.JPG'),
(19, 'gareth', '10/10/10', 'gareth is tall', 'monke_1620130450.JPG', 'Available', '2021-05-04 11:14:10', '2021-05-04 11:14:10', 'monke_1620130450.JPG'),
(20, 'mike', '10/10/10', 'micheal is new to the sanctuary', 'monke_1620130477.JPG', 'Available', '2021-05-04 11:14:37', '2021-05-04 11:14:37', 'monke_1620130477.JPG'),
(21, 'jim', '10/10/10', 'jimmy', 'monke_1620130501.JPG', 'Available', '2021-05-04 11:15:01', '2021-05-04 11:15:01', 'monke_1620130501.JPG');

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
(4, '2021_04_03_173345_create_animals_table', 1),
(5, '2021_04_27_155526_create_adoptions_table', 2),
(6, '2021_05_02_184331_add_secondimage_to_animals_table', 3);

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
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rasib', 'rasib@email.com', NULL, 1, '$2y$10$mZBDlsmR1Emdjr2c.9gIn.ek1r2HfvhMwnM4q0seViMPLQW0IhQYi', 'JwSXkB9CSNeDeOV50rb6g9cCWSMPYSy8SS7VFXorkXzQqVmRWrKwoMRrcv9M', '2021-04-20 14:35:26', '2021-04-20 14:35:26'),
(2, 'Bob', 'bob@email.com', NULL, 0, '$2y$10$EKCz/ndAsP3VaO7T4fP4I.nH5mJ3OSuFRYc.JKbwradURAdbLuD6G', 'qPntYQpXDO5jUMqp1LV50XgtsA1Pv9BLC0AnVjSvomuSed1gkqDv54IOXOr6', '2021-04-20 14:36:53', '2021-04-20 14:36:53'),
(3, 'Dave', 'd@email.com', NULL, 0, '$2y$10$qNzJoDlmUYN3x0Qg1tG5JO4A.JtrcnxcoOB2DGpKWC/aeEMZF.y3S', NULL, '2021-04-30 11:40:15', '2021-04-30 11:40:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adoptions_userid_foreign` (`userid`),
  ADD KEY `adoptions_animalid_foreign` (`animalid`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_animalid_foreign` FOREIGN KEY (`animalid`) REFERENCES `animals` (`id`),
  ADD CONSTRAINT `adoptions_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
