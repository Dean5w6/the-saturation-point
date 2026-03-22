-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2026 at 03:41 PM
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
-- Database: `saturation_point`
--

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `img_path`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fountain Pens', 'categories/S00JkanlrlgaapcJZjoqK866dbWZ6YvCyxdjH9iB.png', 'Luxury writing instruments.', '2026-03-21 23:45:01', '2026-03-22 05:38:18'),
(2, 'Inks', 'categories/JU4LFfdSgyriNAlqSrKs4OdWJ80T1Qhnb77BeXVz.png', 'Bottled fountain pen inks.', '2026-03-21 23:45:01', '2026-03-22 00:05:47'),
(3, 'Paper', 'categories/vFa3pB6hyTx6tcC4uQWzgSozZbKrlNb6TCw6iq1H.png', 'Fountain pen friendly notebooks.', '2026-03-21 23:45:01', '2026-03-22 05:45:21');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_23_112802_create_products_tables', 1),
(5, '2026_02_23_112959_create_trasaction_tables', 1),
(6, '2026_03_22_072152_add_image_to_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_price`, `transaction_date`, `created_at`, `updated_at`) VALUES
(1, 6, 'completed', 5600.00, '2026-03-22 07:45:01', '2025-01-13 23:45:01', '2026-03-21 23:45:01'),
(2, 10, 'shipped', 1900.00, '2026-03-22 07:45:01', '2025-03-14 23:45:01', '2026-03-21 23:45:01'),
(3, 5, 'cancelled', 18100.00, '2026-03-22 07:45:01', '2025-07-23 23:45:01', '2026-03-21 23:45:01'),
(4, 3, 'completed', 18300.00, '2026-03-22 07:45:01', '2025-09-13 23:45:01', '2026-03-21 23:45:01'),
(5, 10, 'completed', 33000.00, '2026-03-22 07:45:01', '2024-10-07 23:45:01', '2026-03-21 23:45:01'),
(6, 6, 'completed', 4100.00, '2026-03-22 07:45:01', '2025-04-13 23:45:01', '2026-03-21 23:45:01'),
(7, 3, 'completed', 34700.00, '2026-03-22 07:45:01', '2025-02-26 23:45:01', '2026-03-21 23:45:01'),
(8, 2, 'pending', 57650.00, '2026-03-22 07:45:01', '2024-04-26 23:45:01', '2026-03-21 23:45:01'),
(9, 8, 'cancelled', 3650.00, '2026-03-22 07:45:01', '2025-10-22 23:45:01', '2026-03-21 23:45:01'),
(10, 9, 'pending', 1650.00, '2026-03-22 07:45:01', '2025-04-08 23:45:01', '2026-03-21 23:45:01'),
(11, 10, 'completed', 16900.00, '2026-03-22 07:45:01', '2024-05-31 23:45:01', '2026-03-21 23:45:01'),
(12, 3, 'completed', 1800.00, '2026-03-22 07:45:01', '2024-09-02 23:45:01', '2026-03-21 23:45:01'),
(13, 4, 'shipped', 5300.00, '2026-03-22 07:45:01', '2025-04-07 23:45:01', '2026-03-21 23:45:01'),
(14, 6, 'completed', 4800.00, '2026-03-22 07:45:01', '2025-04-06 23:45:01', '2026-03-21 23:45:01'),
(15, 6, 'completed', 145000.00, '2026-03-22 07:45:01', '2024-04-08 23:45:01', '2026-03-21 23:45:01'),
(16, 3, 'completed', 33800.00, '2026-03-22 07:45:01', '2025-03-12 23:45:01', '2026-03-21 23:45:01'),
(17, 3, 'completed', 5200.00, '2026-03-22 07:45:01', '2024-05-31 23:45:01', '2026-03-21 23:45:01'),
(18, 3, 'pending', 4350.00, '2026-03-22 07:45:01', '2026-01-10 23:45:01', '2026-03-21 23:45:01'),
(19, 4, 'pending', 850.00, '2026-03-22 07:45:01', '2025-05-03 23:45:01', '2026-03-21 23:45:01'),
(20, 10, 'completed', 58500.00, '2026-03-22 07:45:01', '2024-09-18 23:45:01', '2026-03-21 23:45:01'),
(21, 2, 'shipped', 120000.00, '2026-03-22 07:45:01', '2025-03-24 23:45:01', '2026-03-21 23:45:01'),
(22, 6, 'pending', 8250.00, '2026-03-22 07:45:01', '2025-09-27 23:45:01', '2026-03-21 23:45:01'),
(23, 9, 'pending', 1200.00, '2026-03-22 07:45:01', '2024-08-28 23:45:01', '2026-03-21 23:45:01'),
(24, 9, 'pending', 7050.00, '2026-03-22 07:45:01', '2025-04-19 23:45:01', '2026-03-21 23:45:01'),
(25, 8, 'pending', 62950.00, '2026-03-22 07:45:01', '2024-09-20 23:45:01', '2026-03-21 23:45:01'),
(26, 2, 'completed', 32750.00, '2026-03-22 07:45:01', '2025-06-27 23:45:01', '2026-03-21 23:45:01'),
(27, 4, 'completed', 3000.00, '2026-03-22 07:45:01', '2024-06-05 23:45:01', '2026-03-21 23:45:01'),
(28, 2, 'completed', 2400.00, '2026-03-22 07:45:01', '2024-11-29 23:45:01', '2026-03-21 23:45:01'),
(29, 9, 'pending', 1100.00, '2026-03-22 07:45:01', '2024-11-18 23:45:01', '2026-03-21 23:45:01'),
(30, 6, 'completed', 56550.00, '2026-03-22 07:45:01', '2025-02-10 23:45:01', '2026-03-21 23:45:01'),
(31, 4, 'pending', 7500.00, '2026-03-22 07:45:01', '2024-07-23 23:45:01', '2026-03-21 23:45:02'),
(32, 8, 'pending', 31000.00, '2026-03-22 07:45:02', '2025-10-09 23:45:02', '2026-03-21 23:45:02'),
(33, 6, 'completed', 36300.00, '2026-03-22 07:45:02', '2024-06-05 23:45:02', '2026-03-21 23:45:02'),
(34, 9, 'completed', 6150.00, '2026-03-22 07:45:02', '2024-10-17 23:45:02', '2026-03-21 23:45:02'),
(35, 5, 'completed', 31050.00, '2026-03-22 07:45:02', '2025-09-17 23:45:02', '2026-03-21 23:45:02'),
(36, 10, 'cancelled', 1400.00, '2026-03-22 07:45:02', '2024-07-16 23:45:02', '2026-03-21 23:45:02'),
(37, 5, 'completed', 91000.00, '2026-03-22 07:45:02', '2025-08-04 23:45:02', '2026-03-21 23:45:02'),
(38, 3, 'completed', 13700.00, '2026-03-22 07:45:02', '2024-11-17 23:45:02', '2026-03-21 23:45:02'),
(39, 4, 'completed', 2400.00, '2026-03-22 07:45:02', '2025-09-30 23:45:02', '2026-03-21 23:45:02'),
(40, 8, 'completed', 59200.00, '2026-03-22 07:45:02', '2025-09-08 23:45:02', '2026-03-21 23:45:02'),
(41, 7, 'completed', 15850.00, '2026-03-22 07:45:02', '2025-01-15 23:45:02', '2026-03-21 23:45:02'),
(42, 2, 'cancelled', 6400.00, '2026-03-22 07:45:02', '2025-12-13 23:45:02', '2026-03-21 23:45:02'),
(43, 10, 'cancelled', 24100.00, '2026-03-22 07:45:02', '2025-11-11 23:45:02', '2026-03-21 23:45:02'),
(44, 10, 'completed', 95800.00, '2026-03-22 07:45:02', '2026-03-19 23:45:02', '2026-03-21 23:45:02'),
(45, 2, 'completed', 5750.00, '2026-03-22 07:45:02', '2026-02-17 23:45:02', '2026-03-22 06:00:57'),
(46, 8, 'pending', 18350.00, '2026-03-22 07:45:02', '2024-07-21 23:45:02', '2026-03-21 23:45:02'),
(47, 9, 'pending', 2400.00, '2026-03-22 07:45:02', '2024-10-20 23:45:02', '2026-03-21 23:45:02'),
(48, 9, 'shipped', 13450.00, '2026-03-22 07:45:02', '2024-04-03 23:45:02', '2026-03-21 23:45:02'),
(49, 3, 'shipped', 3300.00, '2026-03-22 07:45:02', '2024-09-28 23:45:02', '2026-03-21 23:45:02'),
(50, 3, 'completed', 28000.00, '2026-03-22 07:45:02', '2024-07-01 23:45:02', '2026-03-21 23:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 2, 1200.00, '2025-01-13 23:45:01', '2025-01-13 23:45:01'),
(2, 1, 4, 1, 3200.00, '2025-01-13 23:45:01', '2025-01-13 23:45:01'),
(3, 2, 17, 2, 950.00, '2025-03-14 23:45:01', '2025-03-14 23:45:01'),
(4, 3, 5, 2, 1800.00, '2025-07-23 23:45:01', '2025-07-23 23:45:01'),
(5, 3, 7, 1, 14500.00, '2025-07-23 23:45:01', '2025-07-23 23:45:01'),
(6, 4, 5, 1, 1800.00, '2025-09-13 23:45:01', '2025-09-13 23:45:01'),
(7, 4, 1, 1, 16500.00, '2025-09-13 23:45:01', '2025-09-13 23:45:01'),
(8, 5, 1, 2, 16500.00, '2024-10-07 23:45:01', '2024-10-07 23:45:01'),
(9, 6, 14, 1, 1850.00, '2025-04-13 23:45:01', '2025-04-13 23:45:01'),
(10, 6, 11, 1, 550.00, '2025-04-13 23:45:01', '2025-04-13 23:45:01'),
(11, 6, 18, 2, 850.00, '2025-04-13 23:45:01', '2025-04-13 23:45:01'),
(12, 7, 1, 2, 16500.00, '2025-02-26 23:45:01', '2025-02-26 23:45:01'),
(13, 7, 18, 2, 850.00, '2025-02-26 23:45:01', '2025-02-26 23:45:01'),
(14, 8, 3, 2, 28000.00, '2024-04-26 23:45:01', '2024-04-26 23:45:01'),
(15, 8, 13, 1, 1650.00, '2024-04-26 23:45:01', '2024-04-26 23:45:01'),
(16, 9, 14, 1, 1850.00, '2025-10-22 23:45:01', '2025-10-22 23:45:01'),
(17, 9, 5, 1, 1800.00, '2025-10-22 23:45:01', '2025-10-22 23:45:01'),
(18, 10, 11, 1, 550.00, '2025-04-08 23:45:01', '2025-04-08 23:45:01'),
(19, 10, 11, 2, 550.00, '2025-04-08 23:45:01', '2025-04-08 23:45:01'),
(20, 11, 9, 1, 1200.00, '2024-05-31 23:45:01', '2024-05-31 23:45:01'),
(21, 11, 8, 1, 1200.00, '2024-05-31 23:45:01', '2024-05-31 23:45:01'),
(22, 11, 7, 1, 14500.00, '2024-05-31 23:45:01', '2024-05-31 23:45:01'),
(23, 12, 5, 1, 1800.00, '2024-09-02 23:45:01', '2024-09-02 23:45:01'),
(24, 13, 16, 2, 1250.00, '2025-04-07 23:45:01', '2025-04-07 23:45:01'),
(25, 13, 15, 2, 1400.00, '2025-04-07 23:45:01', '2025-04-07 23:45:01'),
(26, 14, 11, 2, 550.00, '2025-04-06 23:45:01', '2025-04-06 23:45:01'),
(27, 14, 14, 2, 1850.00, '2025-04-06 23:45:01', '2025-04-06 23:45:01'),
(28, 15, 7, 2, 14500.00, '2024-04-08 23:45:01', '2024-04-08 23:45:01'),
(29, 15, 6, 2, 45500.00, '2024-04-08 23:45:01', '2024-04-08 23:45:01'),
(30, 15, 2, 2, 12500.00, '2024-04-08 23:45:01', '2024-04-08 23:45:01'),
(31, 16, 8, 2, 1200.00, '2025-03-12 23:45:01', '2025-03-12 23:45:01'),
(32, 16, 8, 2, 1200.00, '2025-03-12 23:45:01', '2025-03-12 23:45:01'),
(33, 16, 7, 2, 14500.00, '2025-03-12 23:45:01', '2025-03-12 23:45:01'),
(34, 17, 15, 2, 1400.00, '2024-05-31 23:45:01', '2024-05-31 23:45:01'),
(35, 17, 9, 2, 1200.00, '2024-05-31 23:45:01', '2024-05-31 23:45:01'),
(36, 18, 10, 1, 550.00, '2026-01-10 23:45:01', '2026-01-10 23:45:01'),
(37, 18, 15, 1, 1400.00, '2026-01-10 23:45:01', '2026-01-10 23:45:01'),
(38, 18, 8, 2, 1200.00, '2026-01-10 23:45:01', '2026-01-10 23:45:01'),
(39, 19, 18, 1, 850.00, '2025-05-03 23:45:01', '2025-05-03 23:45:01'),
(40, 20, 15, 1, 1400.00, '2024-09-18 23:45:01', '2024-09-18 23:45:01'),
(41, 20, 10, 2, 550.00, '2024-09-18 23:45:01', '2024-09-18 23:45:01'),
(42, 20, 3, 2, 28000.00, '2024-09-18 23:45:01', '2024-09-18 23:45:01'),
(43, 21, 6, 2, 45500.00, '2025-03-24 23:45:01', '2025-03-24 23:45:01'),
(44, 21, 7, 2, 14500.00, '2025-03-24 23:45:01', '2025-03-24 23:45:01'),
(45, 22, 17, 1, 950.00, '2025-09-27 23:45:01', '2025-09-27 23:45:01'),
(46, 22, 5, 2, 1800.00, '2025-09-27 23:45:01', '2025-09-27 23:45:01'),
(47, 22, 14, 2, 1850.00, '2025-09-27 23:45:01', '2025-09-27 23:45:01'),
(48, 23, 9, 1, 1200.00, '2024-08-28 23:45:01', '2024-08-28 23:45:01'),
(49, 24, 15, 2, 1400.00, '2025-04-19 23:45:01', '2025-04-19 23:45:01'),
(50, 24, 11, 1, 550.00, '2025-04-19 23:45:01', '2025-04-19 23:45:01'),
(51, 24, 14, 2, 1850.00, '2025-04-19 23:45:01', '2025-04-19 23:45:01'),
(52, 25, 4, 2, 3200.00, '2024-09-20 23:45:01', '2024-09-20 23:45:01'),
(53, 25, 3, 2, 28000.00, '2024-09-20 23:45:01', '2024-09-20 23:45:01'),
(54, 25, 11, 1, 550.00, '2024-09-20 23:45:01', '2024-09-20 23:45:01'),
(55, 26, 17, 2, 950.00, '2025-06-27 23:45:01', '2025-06-27 23:45:01'),
(56, 26, 14, 1, 1850.00, '2025-06-27 23:45:01', '2025-06-27 23:45:01'),
(57, 26, 7, 2, 14500.00, '2025-06-27 23:45:01', '2025-06-27 23:45:01'),
(58, 27, 10, 2, 550.00, '2024-06-05 23:45:01', '2024-06-05 23:45:01'),
(59, 27, 17, 2, 950.00, '2024-06-05 23:45:01', '2024-06-05 23:45:01'),
(60, 28, 9, 2, 1200.00, '2024-11-29 23:45:01', '2024-11-29 23:45:01'),
(61, 29, 12, 1, 1100.00, '2024-11-18 23:45:01', '2024-11-18 23:45:01'),
(62, 30, 3, 2, 28000.00, '2025-02-10 23:45:01', '2025-02-10 23:45:01'),
(63, 30, 10, 1, 550.00, '2025-02-10 23:45:01', '2025-02-10 23:45:01'),
(64, 31, 16, 2, 1250.00, '2024-07-23 23:45:01', '2024-07-23 23:45:01'),
(65, 31, 16, 2, 1250.00, '2024-07-23 23:45:01', '2024-07-23 23:45:01'),
(66, 31, 16, 2, 1250.00, '2024-07-23 23:45:01', '2024-07-23 23:45:01'),
(67, 32, 7, 1, 14500.00, '2025-10-09 23:45:02', '2025-10-09 23:45:02'),
(68, 32, 1, 1, 16500.00, '2025-10-09 23:45:02', '2025-10-09 23:45:02'),
(69, 33, 13, 2, 1650.00, '2024-06-05 23:45:02', '2024-06-05 23:45:02'),
(70, 33, 1, 2, 16500.00, '2024-06-05 23:45:02', '2024-06-05 23:45:02'),
(71, 34, 13, 1, 1650.00, '2024-10-17 23:45:02', '2024-10-17 23:45:02'),
(72, 34, 8, 1, 1200.00, '2024-10-17 23:45:02', '2024-10-17 23:45:02'),
(73, 34, 13, 2, 1650.00, '2024-10-17 23:45:02', '2024-10-17 23:45:02'),
(74, 35, 9, 1, 1200.00, '2025-09-17 23:45:02', '2025-09-17 23:45:02'),
(75, 35, 3, 1, 28000.00, '2025-09-17 23:45:02', '2025-09-17 23:45:02'),
(76, 35, 14, 1, 1850.00, '2025-09-17 23:45:02', '2025-09-17 23:45:02'),
(77, 36, 15, 1, 1400.00, '2024-07-16 23:45:02', '2024-07-16 23:45:02'),
(78, 37, 7, 2, 14500.00, '2025-08-04 23:45:02', '2025-08-04 23:45:02'),
(79, 37, 6, 1, 45500.00, '2025-08-04 23:45:02', '2025-08-04 23:45:02'),
(80, 37, 1, 1, 16500.00, '2025-08-04 23:45:02', '2025-08-04 23:45:02'),
(81, 38, 2, 1, 12500.00, '2024-11-17 23:45:02', '2024-11-17 23:45:02'),
(82, 38, 8, 1, 1200.00, '2024-11-17 23:45:02', '2024-11-17 23:45:02'),
(83, 39, 8, 2, 1200.00, '2025-09-30 23:45:02', '2025-09-30 23:45:02'),
(84, 40, 15, 1, 1400.00, '2025-09-08 23:45:02', '2025-09-08 23:45:02'),
(85, 40, 5, 1, 1800.00, '2025-09-08 23:45:02', '2025-09-08 23:45:02'),
(86, 40, 3, 2, 28000.00, '2025-09-08 23:45:02', '2025-09-08 23:45:02'),
(87, 41, 2, 1, 12500.00, '2025-01-15 23:45:02', '2025-01-15 23:45:02'),
(88, 41, 10, 1, 550.00, '2025-01-15 23:45:02', '2025-01-15 23:45:02'),
(89, 41, 15, 2, 1400.00, '2025-01-15 23:45:02', '2025-01-15 23:45:02'),
(90, 42, 4, 2, 3200.00, '2025-12-13 23:45:02', '2025-12-13 23:45:02'),
(91, 43, 4, 2, 3200.00, '2025-11-11 23:45:02', '2025-11-11 23:45:02'),
(92, 43, 9, 1, 1200.00, '2025-11-11 23:45:02', '2025-11-11 23:45:02'),
(93, 43, 1, 1, 16500.00, '2025-11-11 23:45:02', '2025-11-11 23:45:02'),
(94, 44, 5, 2, 1800.00, '2026-03-19 23:45:02', '2026-03-19 23:45:02'),
(95, 44, 6, 2, 45500.00, '2026-03-19 23:45:02', '2026-03-19 23:45:02'),
(96, 44, 8, 1, 1200.00, '2026-03-19 23:45:02', '2026-03-19 23:45:02'),
(97, 45, 16, 2, 1250.00, '2026-02-17 23:45:02', '2026-02-17 23:45:02'),
(98, 45, 18, 1, 850.00, '2026-02-17 23:45:02', '2026-02-17 23:45:02'),
(99, 45, 9, 2, 1200.00, '2026-02-17 23:45:02', '2026-02-17 23:45:02'),
(100, 46, 1, 1, 16500.00, '2024-07-21 23:45:02', '2024-07-21 23:45:02'),
(101, 46, 14, 1, 1850.00, '2024-07-21 23:45:02', '2024-07-21 23:45:02'),
(102, 47, 9, 2, 1200.00, '2024-10-20 23:45:02', '2024-10-20 23:45:02'),
(103, 48, 2, 1, 12500.00, '2024-04-03 23:45:02', '2024-04-03 23:45:02'),
(104, 48, 17, 1, 950.00, '2024-04-03 23:45:02', '2024-04-03 23:45:02'),
(105, 49, 13, 2, 1650.00, '2024-09-28 23:45:02', '2024-09-28 23:45:02'),
(106, 50, 3, 1, 28000.00, '2024-07-01 23:45:02', '2024-07-01 23:45:02');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `brand`, `description`, `price`, `stock`, `img_path`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Custom 823 Fountain Pen - Amber', 'Pilot', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 16500.00, 15, 'products/gallery/823_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(2, 1, 'Lamy 2000 Fountain Pen', 'Lamy', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 12500.00, 8, 'products/gallery/lamy2000_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(3, 1, 'Souverän M800 - Green/Black', 'Pelikan', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 28000.00, 5, 'products/gallery/m800_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(4, 1, 'Procyon - Deep Sea', 'Platinum', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 3200.00, 25, 'products/gallery/deepSea_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(5, 1, 'Eco - Clear Demonstrator', 'TWSBI', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1800.00, 40, 'products/gallery/ECOclear_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(6, 1, 'Homo Sapiens Bronze Age', 'Visconti', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 45500.00, 3, 'products/gallery/sapiens_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(7, 1, '1911 Large Fountain Pen', 'Sailor', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 14500.00, 10, 'products/gallery/1911_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(8, 2, 'Iroshizuku Kon-peki', 'Pilot', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1200.00, 50, 'products/gallery/iroshizuku_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(9, 2, 'Iroshizuku Yama-budo', 'Pilot', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1200.00, 33, 'products/gallery/yama-budo_1.png', NULL, '2026-03-21 23:45:01', '2026-03-22 06:00:57'),
(10, 2, 'Oxblood (80ml)', 'Diamine', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 550.00, 60, 'products/gallery/oxblood_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(11, 2, 'Aurora Borealis', 'Diamine', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 550.00, 45, 'products/gallery/aurora_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(12, 2, 'Perle Noire (Black)', 'Aurora', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1100.00, 30, 'products/gallery/perleNoire_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(13, 2, 'Emerald of Chivor', 'J. Herbin', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1650.00, 12, 'products/gallery/1670_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(14, 2, 'Irish Green', 'Montblanc', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1850.00, 15, 'products/gallery/igreen_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(15, 3, 'Tomoe River 52gsm A5', 'Hobonichi', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1400.00, 20, 'products/gallery/tomoeRiver_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(16, 3, 'Webnotebook A5', 'Rhodia', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 1250.00, 28, 'products/R6Lm4QsHklMRXkAQFMBPZzGcrmWidZIjRprGlDwK.png', NULL, '2026-03-21 23:45:01', '2026-03-22 06:33:43'),
(17, 3, 'Mnemosyne Notebook A5', 'Maruman', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 950.00, 25, 'products/gallery/mnemosyne_1.png', NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(18, 3, 'Midori MD Notebook - A5', 'Midori', 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.', 850.00, 39, 'products/gallery/midori_1.png', NULL, '2026-03-21 23:45:01', '2026-03-22 06:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_path`, `created_at`, `updated_at`) VALUES
(16, 8, 'products/gallery/iroshizuku_3.png', '2026-03-22 14:21:26', '2026-03-22 14:21:26'),
(32, 17, 'products/gallery/mnemosyne_2.png', '2026-03-22 14:21:26', '2026-03-22 14:21:26'),
(47, 8, 'products/gallery/iroshizuku_2.png', '2026-03-22 14:23:49', '2026-03-22 14:23:49'),
(50, 9, 'products/gallery/yama-budo_3.png', '2026-03-22 14:23:49', '2026-03-22 14:23:49'),
(53, 11, 'products/gallery/aurora_3.png', '2026-03-22 14:23:49', '2026-03-22 14:23:49'),
(57, 13, 'products/gallery/1670_3.png', '2026-03-22 14:23:49', '2026-03-22 14:23:49'),
(65, 1, 'products/gallery/823_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(66, 1, 'products/gallery/823_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(67, 2, 'products/gallery/lamy2000_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(68, 2, 'products/gallery/lamy2000_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(69, 3, 'products/gallery/m800_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(70, 3, 'products/gallery/m800_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(71, 4, 'products/gallery/deepSea_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(72, 4, 'products/gallery/deepSea_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(73, 5, 'products/gallery/ECOclear_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(74, 5, 'products/gallery/ECOclear_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(75, 6, 'products/gallery/sapiens_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(76, 6, 'products/gallery/sapiens_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(77, 7, 'products/gallery/1911_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(78, 7, 'products/gallery/1911_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(81, 9, 'products/gallery/yama-budo_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(83, 10, 'products/gallery/oxblood_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(84, 10, 'products/gallery/oxblood_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(85, 11, 'products/gallery/aurora_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(87, 12, 'products/gallery/perleNoire_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(88, 12, 'products/gallery/perleNoire_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(89, 13, 'products/gallery/1670_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(91, 14, 'products/gallery/igreen_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(93, 15, 'products/gallery/tomoeRiver_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(94, 15, 'products/gallery/tomoeRiver_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(98, 17, 'products/gallery/mnemosyne_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(99, 18, 'products/gallery/midori_2.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(100, 18, 'products/gallery/midori_3.png', '2026-03-22 14:24:50', '2026-03-22 14:24:50'),
(101, 16, 'products/gallery/yiZdEr5OYAE7ZMbt8iJEdp39zWWv7ndY55pH898y.png', '2026-03-22 06:34:55', '2026-03-22 06:34:55'),
(102, 16, 'products/gallery/FIb5FpDoGyxgzBIa9MuOOUj9fhQi8HSHGVXh79mK.jpg', '2026-03-22 06:34:55', '2026-03-22 06:34:55'),
(103, 14, 'products/gallery/95pCxwu6a0b2AmeENiZ4ExfKUotMY1KVuLUiZ2GV.png', '2026-03-22 06:35:54', '2026-03-22 06:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 17, 3, 'Fast shipping, great packaging, flawless item.', NULL, '2026-03-01 23:45:02', '2026-02-22 23:45:02'),
(2, 3, 14, 3, 'Fast shipping, great packaging, flawless item.', NULL, '2026-03-09 23:45:02', '2026-02-22 23:45:02'),
(3, 10, 10, 3, 'The color is perfect, exactly what I was looking for.', NULL, '2026-03-14 23:45:02', '2026-03-18 23:45:02'),
(4, 4, 9, 4, 'Fast shipping, great packaging, flawless item.', NULL, '2026-03-18 23:45:02', '2026-02-19 23:45:02'),
(5, 8, 10, 5, 'Absolutely fantastic! Exceeded my expectations.', NULL, '2026-02-25 23:45:02', '2026-03-03 23:45:02'),
(6, 5, 11, 5, 'Fast shipping, great packaging, flawless item.', NULL, '2026-03-19 23:45:02', '2026-02-28 23:45:02'),
(7, 5, 13, 5, 'Writes like a dream. Highly recommend.', NULL, '2026-03-08 23:45:02', '2026-03-05 23:45:02'),
(8, 10, 17, 5, 'The color is perfect, exactly what I was looking for.', NULL, '2026-02-21 23:45:02', '2026-02-23 23:45:02'),
(9, 3, 16, 4, 'Absolutely fantastic! Exceeded my expectations.', NULL, '2026-03-12 23:45:02', '2026-03-01 23:45:02');

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
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `img_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `img_path`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@test.com', '2026-03-21 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'admin', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(2, 'Regular Customer', 'customer@test.com', '2026-03-21 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, NULL, NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(3, 'Arthur Pendragon', 'customer2@test.com', '2026-03-01 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(4, 'Diana Prince', 'customer3@test.com', '2026-03-11 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(5, 'Bruce Wayne', 'customer4@test.com', '2026-03-09 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(6, 'Clark Kent', 'customer5@test.com', '2026-03-15 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(7, 'Tony Stark', 'customer6@test.com', '2026-02-22 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(8, 'Peter Parker', 'customer7@test.com', '2026-02-24 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(9, 'Natasha Romanoff', 'customer8@test.com', '2026-03-06 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01'),
(10, 'Steve Rogers', 'customer9@test.com', '2026-02-26 23:45:01', '$2y$12$x9v9I2r3ZivQ/Pu6HL.GZeVcy/RcLvCAFVKy4a2F1SDc49RiBRsEe', 'customer', 1, 'profile_photos/default_user.png', NULL, NULL, '2026-03-21 23:45:01', '2026-03-21 23:45:01');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
