-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2026 at 04:23 PM
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
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fountain Pens', 'Luxury writing instruments.', '2026-02-23 04:40:58', '2026-02-23 04:40:58'),
(2, 'Inks', 'Bottled fountain pen inks.', '2026-02-23 04:40:58', '2026-02-23 04:40:58'),
(3, 'Paper', 'Fountain pen friendly notebooks.', '2026-02-23 04:40:58', '2026-02-23 04:40:58');

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
(5, '2026_02_23_112959_create_trasaction_tables', 1);

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
(1, 2, 'completed', 1200.00, '2026-03-07 14:21:20', '2026-03-07 06:21:20', '2026-03-07 06:22:01'),
(2, 2, 'completed', 16500.00, '2026-03-07 14:28:54', '2026-03-07 06:28:54', '2026-03-07 06:29:48');

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
(1, 1, 29, 1, 1200.00, '2026-03-07 06:21:20', '2026-03-07 06:21:20'),
(2, 2, 23, 1, 16500.00, '2026-03-07 06:28:54', '2026-03-07 06:28:54');

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
(1, 2, 'Irish Green', 'Montblanc', 'A vibrant, elegant green ink that brings the lush landscapes of Ireland to your pages. Known for its exceptional flow, crisp lines, and striking shading capabilities, this premium ink behaves flawlessly in both vintage and modern fountain pens. It comes housed in Montblanc\'\'s iconic, heavy glass \"shoe\" bottle, featuring a distinct front compartment for easy filling even when the ink level runs low.', 1850.00, 15, 'products/CuJO0dJAyUada4my2bvbXqnxIa4EZAWRBLQqRKi6.png', NULL, '2026-02-23 04:52:30', '2026-03-06 21:56:51'),
(2, 1, 'Homo Sapiens Bronze Age', 'Visconti', 'Crafted from the basaltic lava of Mount Etna in Italy, this remarkable writing instrument is virtually unbreakable, slightly hygroscopic (absorbs hand moisture), and velvety to the touch. It features solid bronze trims that develop a beautiful, unique patina over time. Equipped with Visconti\'\'s revolutionary 18k gold in-house nib and a high-capacity vacuum power filler system, this pen is a true masterpiece of Italian engineering.', 45500.00, 3, 'products/thuzn9BiMkPCxixRjmXeWHRX2cjRnKWoP2mpnBCv.png', NULL, '2026-02-23 18:25:54', '2026-03-06 21:39:15'),
(4, 1, 'Test Pen B', 'Pilot', 'N/A', 2000.00, 15, NULL, '2026-02-26 02:40:20', '2026-02-26 02:03:46', '2026-02-26 02:40:20'),
(6, 1, 'Test Pen B', 'Pilot', 'N/A', 2000.00, 15, NULL, '2026-02-26 16:33:49', '2026-02-26 02:37:25', '2026-02-26 16:33:49'),
(7, 2, 'Blue Ink', 'Diamine', 'Deep blue color.', 500.00, 50, NULL, '2026-02-26 16:33:53', '2026-02-26 02:37:25', '2026-02-26 16:33:53'),
(8, 3, 'Notebook X', 'Rhodia', 'High quality paper.', 350.00, 100, NULL, '2026-02-26 16:33:42', '2026-02-26 02:37:25', '2026-02-26 16:33:42'),
(9, 1, 'Test', 'Test', 'N/A', 234.00, 234, 'products/mIJfN4jyozWpmW4FsdiIkVKSF1NWWEC9Xcxu4nf2.jpg', '2026-02-26 02:50:06', '2026-02-26 02:48:52', '2026-02-26 02:50:06'),
(10, 1, 'Test', 'Test', 'sd', 234.00, 234, 'products/Jfkfg8MIZM1gm48EYKAs3kD5b2XG3POXpIDJeD8V.png', '2026-02-26 02:50:11', '2026-02-26 02:49:56', '2026-02-26 02:50:11'),
(12, 1, 'Test Pen B', 'Pilot', 'N/A', 2000.00, 15, NULL, '2026-02-26 16:23:10', '2026-02-26 03:22:15', '2026-02-26 16:23:10'),
(13, 2, 'Blue Ink', 'Diamine', 'Deep blue color.', 500.00, 50, NULL, '2026-02-26 16:23:03', '2026-02-26 03:22:15', '2026-02-26 16:23:03'),
(14, 3, 'Notebook X', 'Rhodia', 'High quality paper.', 350.00, 100, NULL, '2026-02-26 16:22:58', '2026-02-26 03:22:15', '2026-02-26 16:22:58'),
(16, 1, 'Test Pen B', 'Pilot', 'N/A', 2000.00, 15, NULL, '2026-02-26 03:26:26', '2026-02-26 03:22:26', '2026-02-26 03:26:26'),
(17, 2, 'Blue Ink', 'Diamine', 'Deep blue color.', 500.00, 50, NULL, '2026-02-26 03:26:18', '2026-02-26 03:22:26', '2026-02-26 03:26:18'),
(18, 3, 'Notebook X', 'Rhodia', 'High quality paper.', 350.00, 100, NULL, '2026-02-26 16:37:10', '2026-02-26 03:22:26', '2026-02-26 16:37:10'),
(20, 1, 'Test Pen B', 'Pilot', 'N/A', 2000.00, 15, NULL, '2026-02-26 16:35:32', '2026-02-26 16:35:05', '2026-02-26 16:35:32'),
(21, 2, 'Blue Ink', 'Diamine', 'Deep blue color.', 500.00, 50, NULL, '2026-02-26 16:35:26', '2026-02-26 16:35:05', '2026-02-26 16:35:26'),
(22, 3, 'Notebook X', 'Rhodia', 'High quality paper.', 350.00, 100, NULL, '2026-02-26 16:43:20', '2026-02-26 16:35:05', '2026-02-26 16:43:20'),
(23, 1, 'Custom 823 Fountain Pen - Amber', 'Pilot', 'A demonstrator barrel featuring a high-capacity vacuum filling system and a smooth 14k gold nib. A true workhorse pen for serious writers.', 16500.00, 13, 'products/dOQOg9IWbhRWo4Yi2ljVEtSmsLvtf9Olu7ZByziC.png', NULL, '2026-02-27 00:52:49', '2026-03-07 06:29:48'),
(24, 1, 'Lamy 2000 Fountain Pen - Black Makrolon', 'Lamy', 'A timeless Bauhaus design from 1966. Features a fiberglass and brushed stainless steel body, piston filling system, and a platinum-coated 14k gold nib.', 12500.00, 8, 'products/diTJ6IEnX39E4nSUmQ1OTxDNRrFS2kgfBrkUgjvc.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:00:52'),
(25, 1, 'Souverän M800 Fountain Pen - Green/Black', 'Pelikan', 'The classic German flagship pen. Features a brass-mechanism piston filler, a striped cellulose acetate barrel, and an incredibly smooth 18k bi-color gold nib.', 28000.00, 5, 'products/o87yJlGEq6YkIpW91bX1ZTWjkIbra1ueBxUoaQLP.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:03:47'),
(26, 1, 'Procyon Fountain Pen - Deep Sea', 'Platinum', 'An excellent everyday carry pen featuring Platinum\'s \"Slip and Seal\" mechanism that prevents ink from drying out for up to a year.', 3200.00, 25, 'products/0oJ9VXdOFLlqMRAhYG3tWiqxeUaJ3FYYJgPuQ0If.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:07:07'),
(27, 1, 'Eco Fountain Pen - Clear', 'TWSBI', 'An affordable, high-capacity piston filler demonstrator. Perfect for beginners and experts alike who want to see their ink slosh around inside the barrel.', 1800.00, 40, 'products/SX0gtYQwwWQqs12QIjNu1m0tagIc5iR0YwX1DiQ6.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:10:20'),
(28, 1, '1911 Large Fountain Pen - Black/Gold', 'Sailor', 'A classic cigar-shaped pen known worldwide for having some of the most precise and feedback-rich 21k gold nibs ever manufactured.', 14500.00, 10, 'products/92eE2B2Z0SYPjx65XdMSW5OdXRmMwmNMCRYsVkYd.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:12:43'),
(29, 2, 'Iroshizuku Kon-peki (Deep Blue)', 'Pilot', 'A vibrant, shading cerulean blue ink inspired by the color of a deep, clear summer sky. Exceptionally well-behaved and easy to clean.', 1200.00, 48, 'products/JmyDVBoo1z21tLNRGI0yGEvXuFw58dXPdaGXzvjH.png', NULL, '2026-02-27 00:52:49', '2026-03-07 06:22:01'),
(30, 2, 'Iroshizuku Yama-budo (Crimson Glory Vine)', 'Pilot', 'A rich, sophisticated magenta-purple ink that shades beautifully and occasionally sheens gold on high-quality paper.', 1200.00, 35, 'products/Zjh4dt4Banhm3woooaL5q6GLSvEvDqBkx80aA5qu.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:19:14'),
(31, 2, 'Oxblood', 'Diamine', 'A deep, dark red ink that heavily resembles dried blood. One of the most popular and distinct shading inks in the fountain pen community.', 550.00, 60, 'products/33Y9VoBBGgJ9uzsESKmAaI8cS0ekjy5FfgtyIaHT.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:23:08'),
(32, 2, 'Aurora Borealis', 'Diamine', 'A stunning teal ink that exhibits massive amounts of red sheen when pooled on Tomoe River paper.', 550.00, 45, 'products/wZwxXsMWY9JCqAtSh0rP6M5ZMzq8be1DRQnE4PaA.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:26:34'),
(33, 2, 'Perle Noire (Black)', 'Aurora', 'Widely considered one of the deepest, darkest, and best-flowing black inks available on the market. Safe for vintage and modern pens.', 1100.00, 30, 'products/Gl0edU9NTydKgzreR9xVzbRoIfh2u6KOfRQPhShv.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:30:53'),
(34, 2, 'Emerald of Chivor (1670 Anniversary)', 'J. Herbin', 'A legendary teal ink containing gold shimmer particles and massive red sheen. Shake well before filling your pen.', 1650.00, 12, 'products/1OlO0s4SdeadQFl7lcBli3ihvgxJoEvlvYRYZwJ4.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:33:13'),
(35, 3, 'Tomoe River 52gsm Notebook - A5 Dot Grid', 'Hobonichi', 'The gold standard for fountain pen paper. Incredibly thin 52gsm paper that shows off maximum ink sheen and shading with absolutely zero bleed-through.', 1400.00, 20, 'products/njHmuCYmWImnODheIc2yhO9qFwtPJ8OKC2Cjjb7U.png', NULL, '2026-02-27 00:52:49', '2026-03-06 22:35:22'),
(36, 3, 'Rhodia Webnotebook - A5 Lined (Black)', 'Rhodia', 'Features 90gsm Clairefontaine ivory vellum paper. Incredibly smooth surface that prevents feathering. The perfect daily journal.', 1250.00, 30, 'products/0FT7iE9i0gFgvui6Pt4cOSaQFGmdfcOCC69vj9Va.png', NULL, '2026-02-27 00:52:49', '2026-03-07 01:39:15'),
(37, 3, 'Mnemosyne Notebook - A5 Blank', 'Maruman', 'Premium Japanese paper designed specifically for smooth writing. Features micro-perforated pages and a durable plastic cover.', 950.00, 25, 'products/fprq10o3X9hQfbVtf0dHS2MPpMcz2rkKYNmjKvFQ.png', NULL, '2026-02-27 00:52:49', '2026-03-07 01:42:01'),
(38, 3, 'Midori MD Notebook - A5 Grid', 'Midori', 'Minimalist design featuring cream-colored paper that provides excellent feedback for fountain pens without feathering.', 850.00, 40, 'products/tcwlRrASvjbvyTNnPIUTaNRNuRGWHprZQPGPRLRM.png', NULL, '2026-02-27 00:52:49', '2026-03-06 21:34:14');

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
(6, 9, 'products/gallery/0R4qmaTz0qMGTSv6U82qJUqwSSbBqnIk2j5Y6uwo.png', '2026-02-26 02:48:52', '2026-02-26 02:48:52'),
(7, 10, 'products/gallery/vscADKZvCaQsU7dvFFd6oB12x5mb33Xeu5xh2QnI.png', '2026-02-26 02:49:56', '2026-02-26 02:49:56'),
(10, 23, 'products/gallery/bwfYX9z51gZ9l2Y28n00k1z4mT9nunrYdYNcgxug.png', '2026-03-02 16:34:18', '2026-03-02 16:34:18'),
(11, 23, 'products/gallery/oG3SQthSuWScCE7xtnK2lVgzYzGYCeJbdJab6lKA.png', '2026-03-02 16:34:18', '2026-03-02 16:34:18'),
(12, 38, 'products/gallery/RRqn4iblV0J0YCj7E9R2RQ0sqwtgwpjJEf76wJSo.png', '2026-03-06 21:34:14', '2026-03-06 21:34:14'),
(13, 38, 'products/gallery/Ul1bUdlA1cZtyF8s2dCmCIOIf8JuJ6P7c2b5Ge83.png', '2026-03-06 21:34:14', '2026-03-06 21:34:14'),
(14, 2, 'products/gallery/pIU7gKclaq1UxwTG3tFNVv5WJW03sOlP0oYtceG8.png', '2026-03-06 21:39:15', '2026-03-06 21:39:15'),
(15, 2, 'products/gallery/tjfwd5ojyyP6J6OXX1IBb0ibEYQ0SK464898kRJS.png', '2026-03-06 21:39:15', '2026-03-06 21:39:15'),
(17, 1, 'products/gallery/hFIOQOAPT1utnJe9GWq3wg3ekCQKa5VcYKjIHkDL.png', '2026-03-06 21:56:51', '2026-03-06 21:56:51'),
(18, 1, 'products/gallery/ATdid0pcfPJ6yO2f6shOtW156xAg5gm1XIdokSLN.png', '2026-03-06 21:56:51', '2026-03-06 21:56:51'),
(19, 24, 'products/gallery/sW7AxhEcfq6NQOLC92w5LcSJM9sYD0p3bkM3Ju3o.png', '2026-03-06 22:02:02', '2026-03-06 22:02:02'),
(20, 24, 'products/gallery/OLv3Vw6O5Enjdyj8AApYEsijxSkgicHEElk4btG5.png', '2026-03-06 22:02:02', '2026-03-06 22:02:02'),
(21, 25, 'products/gallery/iDqjnlppF6N85VCwjQTqHYQZKGGjVWlKvrYQJjDe.png', '2026-03-06 22:03:47', '2026-03-06 22:03:47'),
(22, 25, 'products/gallery/bQRyY6JGuDjQ8mAgJ5pSR0KS5gO2Gu8bWVZL6us2.png', '2026-03-06 22:03:47', '2026-03-06 22:03:47'),
(23, 26, 'products/gallery/iDTtcAxAsBDlof319MV0ulBPM8qGEGjwVyCMi2Dg.png', '2026-03-06 22:07:07', '2026-03-06 22:07:07'),
(24, 26, 'products/gallery/dMQrTUqzhCCP96Goddj8ObRioDon67VL2E5h4eKN.png', '2026-03-06 22:07:07', '2026-03-06 22:07:07'),
(25, 27, 'products/gallery/jBZDwxWWKmQSb2rRRGgcGSHB0IZwE3Jhoja0kqG8.png', '2026-03-06 22:10:20', '2026-03-06 22:10:20'),
(26, 27, 'products/gallery/mWBb3chpE6ripx7ZtjOT5rRyKIpdVIjfBmir4MsA.png', '2026-03-06 22:10:20', '2026-03-06 22:10:20'),
(27, 28, 'products/gallery/UPQkNwejUaFyDkoUrhEXPC2q9uGmqvNXoNwtZNGe.png', '2026-03-06 22:12:43', '2026-03-06 22:12:43'),
(28, 28, 'products/gallery/poAR1aRaDcHOtraO8Z5Hr3fZWtWfWph1ya7eZ7qu.png', '2026-03-06 22:12:43', '2026-03-06 22:12:43'),
(29, 29, 'products/gallery/NJXEpbKPNGQkLFOEq6Mq8I0ffQ63FxHYznBBYzRJ.png', '2026-03-06 22:16:06', '2026-03-06 22:16:06'),
(30, 29, 'products/gallery/H4g4QFxv4pJiE3pEripNCP4XDIHJoHOU32Egor7P.png', '2026-03-06 22:16:06', '2026-03-06 22:16:06'),
(31, 30, 'products/gallery/Ydzwg9MsrgJ4ijw6bs81wwh1Lp2G8qjj95ufocLo.png', '2026-03-06 22:19:14', '2026-03-06 22:19:14'),
(32, 30, 'products/gallery/bm4y7xFcdZYtPj5I7dmPxcLHjrxrUZGcM5Wg2iln.png', '2026-03-06 22:19:14', '2026-03-06 22:19:14'),
(33, 31, 'products/gallery/OHfMvgYeGJvflV9lwbnbSURul6LzjWd9GTZVTzH1.png', '2026-03-06 22:23:08', '2026-03-06 22:23:08'),
(34, 31, 'products/gallery/yabPcIWnOzExOYjrs2EAlTYuCTl87nCVk6r5oRq3.png', '2026-03-06 22:23:08', '2026-03-06 22:23:08'),
(35, 32, 'products/gallery/wc2nqMIXz6HuUwXbsVyNW8mhFeupLyQNMciU0MJq.png', '2026-03-06 22:26:34', '2026-03-06 22:26:34'),
(36, 32, 'products/gallery/klYrWZ8cNZjConz3FxMEHoDPhSH9z6C0P9KiMq6H.png', '2026-03-06 22:26:34', '2026-03-06 22:26:34'),
(37, 33, 'products/gallery/z0hggGK5d5cj1FF3ISd2eXVKIhjMnQmy2bJVYvjx.png', '2026-03-06 22:30:53', '2026-03-06 22:30:53'),
(38, 33, 'products/gallery/I3LxebMhGsUoVs9UDZYMuNGFb2Ke8SGJpl4GeiFK.png', '2026-03-06 22:30:53', '2026-03-06 22:30:53'),
(39, 34, 'products/gallery/FXWIOCzvKFPo2BqFnPuS26GraOo8Go3PhhQJ8kwH.png', '2026-03-06 22:33:13', '2026-03-06 22:33:13'),
(40, 34, 'products/gallery/J3x0Xsf1J0zce3Igp7RAD6yFVancRMH2A601U7qu.png', '2026-03-06 22:33:13', '2026-03-06 22:33:13'),
(41, 35, 'products/gallery/ikQovH6g8mXH82BXuaB5DcxyYEGW1QrcvAvKq2hC.png', '2026-03-06 22:35:22', '2026-03-06 22:35:22'),
(42, 35, 'products/gallery/ZPJ3klqy4ULuwMGP10WwKcCF7ehIJk3nyAXaBedl.png', '2026-03-06 22:35:22', '2026-03-06 22:35:22'),
(43, 36, 'products/gallery/0lyK7GKlxzCNkmgH0Kk73xibQBVSveQquIfWxpDG.png', '2026-03-07 01:39:15', '2026-03-07 01:39:15'),
(44, 36, 'products/gallery/nskHWcqAHk1uULf0WcadHa2irBXBvCdeBuR6WlyZ.jpg', '2026-03-07 01:39:15', '2026-03-07 01:39:15'),
(45, 37, 'products/gallery/quFFahRnLRyL6ChdmCExdenEeXe2pCfNhsawfBK4.png', '2026-03-07 01:42:01', '2026-03-07 01:42:01'),
(46, 37, 'products/gallery/yuzIGShPHyCbtfgyYcuFjHLnbLPy5cnN1LXQiAgM.png', '2026-03-07 01:42:01', '2026-03-07 01:42:01');

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
(1, 2, 1, 2, '**** **** testt', NULL, '2026-02-23 16:37:17', '2026-02-23 18:29:10'),
(2, 3, 1, 1, '**** **** test2', NULL, '2026-02-23 17:46:55', '2026-02-23 17:46:55'),
(3, 3, 2, 5, '.', NULL, '2026-02-23 18:41:49', '2026-02-23 18:41:49');

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
(1, 'Admin User', 'admin@test.com', '2026-02-23 04:40:58', '$2y$12$VFSD9RqAA379xZNQqBTVTefGO0quLA170UXmrB5kG1FK5UTAjeBAC', 'admin', 1, 'profile_photos/mQFUpC1sN6BogkfF76mzoNhBEVzZwFMLwdcBLy8G.jpg', NULL, NULL, '2026-02-23 04:40:58', '2026-02-23 19:01:59'),
(2, 'Firefly', 'customer@test.com', '2026-02-23 04:40:58', '$2y$12$2y94WleyhqYp3Egq7pAnBO0NgIchsCT9RwC3CbpsYGg./DJBND70u', 'customer', 1, 'profile_photos/qD5pAoEeeM9hCKmJ97ZwoOnoyfepadNxrQBOXRQ1.gif', NULL, NULL, '2026-02-23 04:40:58', '2026-02-23 17:47:33'),
(3, 'Dean Joefrey Cabarles', 'deanjoefrey@gmail.com', NULL, '$2y$12$kpiCi4XVZXfQYBb8pt9GIu7j9StaYXlvkb3O4h5xzdvsXBCJMdudq', 'customer', 1, 'profile_photos/Ax1GO4PfQ4SVvtXJIXQM3KKd9Ck2ytOrj5PPVxWX.png', NULL, NULL, '2026-02-23 14:57:06', '2026-02-23 17:46:15'),
(4, 'Dean Joefrey Cabarles', 'deanjoefreyii@gmail.com', NULL, '$2y$12$S.603Xb9MsIGhGxfHGZByO9r5Sp.OVqFzW8odOKsIOJCRYGKJICqy', 'admin', 1, 'profile_photos/frD6xJQ1CYYMPaaAdQBZ3kCihwg1AxGnBLRZl3c4.png', NULL, NULL, '2026-02-23 15:00:24', '2026-02-23 17:42:57'),
(7, 'Dean Joefrey Cabarles', 'deanjoefrey2@gmail.com', '2026-02-26 01:19:13', '$2y$12$DmwSaRxidz7RaOXZSU8H4etlM8KAZsVOPX9qhp763y1ePe74GAXiO', 'customer', 1, 'profile_photos/vmF2iOBk9Tc4QRlDNRdIjnFgl6j5dVZWOufuIkSx.jpg', NULL, NULL, '2026-02-26 01:09:05', '2026-02-26 01:19:13'),
(8, 'Dean Joefrey Cabarles', 'deanjoefreyiii@gmail.com', '2026-02-26 01:20:35', '$2y$12$TQvKwY3LvqlStdaudxAwPeoOxO1tWx1q3gykt.2eWeJTpMfPeX8Sy', 'customer', 1, 'profile_photos/yaFv8G7foeNhYt525EMdIoEj2v4brDc3iXiA7HLI.png', NULL, NULL, '2026-02-26 01:20:05', '2026-02-26 01:20:35');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
