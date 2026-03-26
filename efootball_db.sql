-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2026 at 06:16 PM
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
-- Database: `efootball_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2026-03-26-020618', 'App\\Database\\Migrations\\User', 'default', 'App', 1774509034, 1),
(5, '2026-03-26-020645', 'App\\Database\\Migrations\\Tournaments', 'default', 'App', 1774509034, 1),
(6, '2026-03-26-020700', 'App\\Database\\Migrations\\Teams', 'default', 'App', 1774509034, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `tournament_id` int(11) UNSIGNED NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `tournament_id`, `team_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'Barca FC', 'approved', '2026-03-26 13:50:45', '2026-03-26 15:06:52'),
(2, 5, 2, 'Barca ', 'approved', '2026-03-26 13:51:03', '2026-03-26 15:06:53'),
(3, 5, 2, 'Madrid', 'approved', '2026-03-26 13:54:07', '2026-03-26 15:06:54'),
(4, 5, 2, 'Kudeta FC', 'approved', '2026-03-26 14:08:45', '2026-03-26 15:06:55'),
(5, 5, 3, 'Kudeta FC', 'rejected', '2026-03-26 15:46:00', '2026-03-26 17:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('open','ongoing','completed') NOT NULL DEFAULT 'open',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Barz Tournamen Cup', 'TES TES', 'completed', '2026-03-26 07:11:14', '2026-03-26 17:05:19'),
(3, 'POTW Cup Tournament', 'TES 12', 'ongoing', '2026-03-26 12:41:00', '2026-03-26 17:00:27'),
(4, 'Akbar Tour', 'A\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA\r\nA', 'completed', '2026-03-26 14:12:36', '2026-03-26 17:00:33'),
(5, 'Akbar', 'AJDIOajidjAIPODJAIODJawiojdWA\r\n\r\nAJdiojapdjAIDaopudapMDfapojAI opaiopafpouaspf\r\n\r\nopujdapUpAU\r\naoiudfioafjipaw', 'open', '2026-03-26 14:13:04', '2026-03-26 14:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','player') NOT NULL DEFAULT 'player',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(5, 'Akbar', 'akbar@gmail.com', '1', 'player', '2026-03-26 13:08:34', '2026-03-26 13:08:34'),
(6, 'Akbar', 'admin@gmail.com', '1', 'admin', '2026-03-26 13:08:48', '2026-03-26 13:08:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
