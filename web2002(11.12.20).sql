-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 07:04 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web2002`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `total_views` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Coconut Oil', '2020-12-09 16:24:30', NULL),
(2, 'Honey', '2020-12-09 16:24:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `generet_cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `generet_cart_id`, `product_id`, `color_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(32, 'Joj8FFj150', 26, 1, 1, '1', '2020-11-27 05:26:28', '2020-11-27 05:26:28'),
(33, 'Joj8FFj150', 26, 3, 1, '1', '2020-11-27 05:27:00', '2020-11-27 05:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Beauty', 'beauty', NULL, '2020-09-17 11:57:31', NULL),
(2, 'Food & Bevarege', 'food-&-bevarege', '2020-08-31 05:52:27', '2020-09-17 07:59:33', NULL),
(8, 'Fashion', 'fashion', '2020-08-31 07:06:55', '2020-09-08 02:50:33', NULL),
(9, 'Electronics', 'electronics', '2020-09-08 02:57:07', NULL, NULL),
(14, 'Test', 'test', '2020-12-02 16:10:13', '2020-12-03 16:58:27', '2020-12-03 16:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'red', '#FF0000', '2020-09-17 15:56:54', NULL),
(2, 'Blue', '#0000FF', '2020-09-17 15:56:54', NULL),
(3, 'green', '#228B22', '2020-09-21 14:44:01', NULL),
(4, 'Yellow', '#FFFF00', '2020-09-21 14:44:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_name`, `coupon_code`, `discount`, `validity`, `created_at`, `updated_at`) VALUES
(1, 'New Year', 'newyear25', '25', '2020-10-29 04:00:43', '2020-10-26 04:02:16', NULL),
(2, 'Corona', 'corona35', '35', '2020-10-23 04:09:27', '2020-10-22 04:09:27', NULL),
(3, 'varger', 'verger30', '50', '2020-10-28 05:06:26', '2020-10-26 05:06:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(4, '2020_08_22_042726_create_categories_table', 2),
(5, '2020_09_02_233521_add_delete_to_categories_table', 3),
(6, '2020_09_07_100013_create_sub_categories_table', 4),
(8, '2020_09_15_000838_create_products_table', 5),
(9, '2020_09_17_210748_create_colors_table', 6),
(11, '2020_09_20_215628_create_sizes_table', 7),
(12, '2020_09_17_211325_create_product_attributes_table', 8),
(13, '2020_09_27_222044_create_product_images_table', 9),
(16, '2020_10_06_170317_create_carts_table', 10),
(19, '2020_10_22_093302_create_coupons_table', 11),
(20, '2020_10_22_094751_create_product_coupons_table', 11),
(21, '2020_11_03_085445_create_shippings_table', 12),
(22, '2020_11_03_091428_create_orders_table', 12),
(24, '2020_11_26_220123_create_permission_tables', 13),
(25, '2020_12_09_222023_create_blog_categories_table', 14),
(26, '2020_12_09_222915_create_blogs_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 3),
(2, 'App\\User', 1),
(2, 'App\\User', 3),
(3, 'App\\User', 1),
(3, 'App\\User', 3),
(6, 'App\\User', 3),
(6, 'App\\User', 7),
(7, 'App\\User', 3),
(7, 'App\\User', 7);

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
(1, 'App\\User', 3),
(2, 'App\\User', 3),
(3, 'App\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_unit_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `shipping_id`, `product_id`, `quantity`, `product_unit_price`, `created_at`, `updated_at`) VALUES
(81, 42, 20, '1', '500', '2020-11-24 18:15:10', '2020-11-24 18:15:10'),
(82, 42, 6, '1', '100', '2020-11-24 18:15:10', '2020-11-24 18:15:10'),
(83, 43, 27, '3', '1500', '2020-11-26 03:34:12', '2020-11-26 03:34:12'),
(84, 43, 27, '1', '1500', '2020-11-26 03:34:12', '2020-11-26 03:34:12'),
(85, 51, 20, '1', '500', '2020-11-26 04:56:33', '2020-11-26 04:56:33'),
(86, 53, 20, '1', '500', '2020-11-26 05:07:19', '2020-11-26 05:07:19'),
(87, 55, 20, '1', '500', '2020-11-26 05:08:45', '2020-11-26 05:08:45'),
(88, 56, 20, '1', '500', '2020-11-26 05:10:01', '2020-11-26 05:10:01'),
(89, 57, 20, '1', '500', '2020-11-26 05:12:34', '2020-11-26 05:12:34'),
(90, 57, 5, '1', '150', '2020-11-26 05:12:34', '2020-11-26 05:12:34'),
(91, 57, 26, '1', '5000', '2020-11-26 05:12:34', '2020-11-26 05:12:34'),
(92, 58, 6, '1', '100', '2020-11-26 05:16:22', '2020-11-26 05:16:22');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Category Add', 'web', '2020-11-26 16:44:12', '2020-11-26 16:44:12'),
(2, 'Category Edit', 'web', '2020-11-26 16:44:34', '2020-11-26 16:44:34'),
(3, 'Category Delete', 'web', '2020-11-26 16:44:55', '2020-11-26 16:44:55'),
(4, 'Product Add', 'web', '2020-11-26 17:01:09', '2020-11-26 17:01:09'),
(5, 'Product Edit', 'web', '2020-11-26 17:01:21', '2020-11-26 17:01:21'),
(6, 'Product Delete', 'web', '2020-11-26 17:01:33', '2020-11-26 17:01:33'),
(7, 'Product List', 'web', '2020-11-26 17:01:47', '2020-11-26 17:01:47'),
(10, 'Category List', 'web', '2020-12-02 15:08:02', '2020-12-02 15:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image.png',
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `title`, `slug`, `summary`, `description`, `price`, `thumbnail`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 8, 3, 'ATM Lungi', 'atm-lungi', 'The lungi is a type of sarong that originated in the Indian subcontinent, it is a traditional skirt-like lower garment wrapped around the waist, usually below the ..', 'The lungi is a type of sarong that originated in the Indian subcontinent, it is a traditional skirt-like lower garment wrapped around the waist, usually below the ..', '150', 'my-fasion.jpg', '21', '2020-09-17 16:22:46', NULL, NULL),
(6, 1, 7, 'Best Fachwash', 'best-facewash', 'Washing your face may be the most basic of skincare steps,', 'Washing your face may be the most basic of skincare steps, but dermatologists and skincare experts know that using the right cleanser for your ...\r\nWashing your face may be the most basic of skincare steps, but dermatologists and skincare experts know that using the right cleanser for your ...\r\nWashing your face may be the most basic of skincare steps, but dermatologists and skincare experts know that using the right cleanser for your ...\r\nWashing your face may be the most basic of skincare steps, but dermatologists and skincare experts know that using the right cleanser for your ...', '100', 'best-facewash.jpg', '32', '2020-09-19 14:25:33', '2020-10-03 04:04:09', NULL),
(20, 9, 13, 'Mobile', 'mobile', 'The Nokia E71 is a smartphone introduced in May 2008 from the Eseries range with a ... Optimized mobile email and messaging experience with full QWERTY UPDATE', 'The Nokia E71 is a smartphone introduced in May 2008 from the Eseries range with a ... Optimized mobile email and messaging experience with full QWERTY.The Nokia E71 is a smartphone introduced in May 2008 from the Eseries range with a ... Optimized mobile email and messaging experience with full QWERTY.The Nokia E71 is a smartphone introduced in May 2008 from the Eseries range with a ... Optimized mobile email and messaging experience with full QWERTY', '500', 'mobile.jpg', NULL, NULL, '2020-10-03 05:40:57', NULL),
(26, 1, 2, 'Best cream', 'best-cream-D7', 'Take care of the skin god gave you with the best moisturisers and face creams to combat fine lines and wrinkles both day and night.', 'Take care of the skin god gave you with the best moisturisers and face creams to combat fine lines and wrinkles both day and night.\r\nTake care of the skin god gave you with the best moisturisers and face creams to combat fine lines and wrinkles both day and night.\r\nTake care of the skin god gave you with the best moisturisers and face creams to combat fine lines and wrinkles both day and night.\r\nTake care of the skin god gave you with the best moisturisers and face creams to combat fine lines and wrinkles both day and night.', '5000', 'best-cream.jpg', NULL, '2020-10-05 16:43:07', NULL, NULL),
(27, 2, 10, 'Kids Food', 'kids-food', 'What is HorliX? HorliX is a DICOM viewer based on Horos and OsiriX. The origin of HorliX is HorosJ which is a japanese version of Horos published.', 'What is HorliX? HorliX is a DICOM viewer based on Horos and OsiriX. The origin of HorliX is HorosJ which is a japanese version of Horos published\r\nWhat is HorliX? HorliX is a DICOM viewer based on Horos and OsiriX. The origin of HorliX is HorosJ which is a japanese version of Horos published\r\nWhat is HorliX? HorliX is a DICOM viewer based on Horos and OsiriX. The origin of HorliX is HorosJ which is a japanese version of Horos published', '1500', 'kids-food.jpg', NULL, '2020-10-11 15:39:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `color_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 5, 2, 4, '0', NULL, NULL),
(4, 6, 3, 1, '212', NULL, '2020-10-03 04:04:09'),
(13, 20, 3, 1, '343', NULL, '2020-10-03 05:40:57'),
(14, 20, 2, 4, '656', NULL, '2020-10-03 04:25:32'),
(15, 26, 1, 1, '20', NULL, NULL),
(16, 26, 1, 2, '30', NULL, NULL),
(17, 26, 3, 1, '10', NULL, NULL),
(18, 27, 1, 3, '5', NULL, NULL),
(19, 27, 1, 1, '2', NULL, NULL),
(20, 27, 4, 4, '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_coupons`
--

CREATE TABLE `product_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_coupons`
--

INSERT INTO `product_coupons` (`id`, `coupon_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2020-10-22 04:12:25', NULL),
(2, 2, 6, '2020-10-22 04:12:25', NULL),
(3, 1, 20, '2020-10-22 04:12:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`, `created_at`, `updated_at`) VALUES
(2, 20, 'PMqIl.jpg', '2020-09-29 05:02:43', NULL),
(4, 20, 'Hmp86.jpg', '2020-09-29 05:02:43', NULL),
(5, 20, 'uFhtX.jpg', '2020-09-29 05:02:43', NULL),
(12, 6, 'waldu.jpg', '2020-10-03 04:04:09', NULL),
(15, 26, '7lzxO.jpg', '2020-10-05 16:43:08', NULL),
(16, 26, 'S4DCC.jpg', '2020-10-05 16:43:08', NULL),
(17, 26, 'oWsM2.jpg', '2020-10-05 16:43:08', NULL),
(18, 26, 'qJHFN.jpg', '2020-10-05 16:43:08', NULL),
(19, 26, '2CBS2.jpg', '2020-10-05 16:43:08', NULL),
(20, 26, 'ZK1kt.jpg', '2020-10-05 16:43:09', NULL),
(21, 27, 'Waiav.jpg', '2020-10-11 15:39:12', NULL),
(22, 27, 'No0nO.jpg', '2020-10-11 15:39:12', NULL),
(23, 27, 'Qneor.jpg', '2020-10-11 15:39:12', NULL),
(24, 27, 'gaOYD.jpg', '2020-10-11 15:39:12', NULL);

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
(1, 'Admin', 'web', '2020-11-26 16:59:12', '2020-11-26 16:59:12'),
(2, 'Editor', 'web', '2020-11-26 16:59:30', '2020-11-26 16:59:30'),
(3, 'Modaretor', 'web', '2020-11-26 16:59:45', '2020-11-26 16:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(5, 2),
(7, 3),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=pending 2=shipping 3=deliver',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=unpaid 2=paid',
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `user_id`, `first_name`, `last_name`, `company_name`, `email`, `phone`, `country_id`, `city_id`, `zipcode`, `address`, `product_status`, `payment_status`, `total_amount`, `coupon_code`, `coupon_discount`, `note`, `created_at`, `updated_at`) VALUES
(1, 3, 'MONIR HOSEN', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '1', '1600', NULL, NULL, 'thi s is a khan group of indestries', '2020-11-04 03:47:42', '2020-11-04 03:47:42'),
(2, 3, 'hosen', 'kazi', 'hosen group', 'hosen@gmail.com', '01837171967', '3', '5', '1321', 'dhaka', '1', '1', '1600', NULL, NULL, 'this is very good product', '2020-11-04 12:48:43', '2020-11-04 12:48:43'),
(3, 3, 'MONIR', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '2', '1600', NULL, NULL, NULL, '2020-11-04 16:42:20', '2020-11-04 16:42:21'),
(4, 3, 'MONIR', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '2', '1600', NULL, NULL, 'fdgdfdsfdsfdsf', '2020-11-05 03:42:55', '2020-11-05 03:43:08'),
(5, 3, 'MONIR', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '1', '1600', NULL, NULL, 'fdgdfdsfdsfdsf', '2020-11-05 04:03:06', '2020-11-05 04:03:06'),
(6, 3, 'MONIR', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '2', '1600', NULL, NULL, 'fdgdfdsfdsfdsf', '2020-11-05 04:09:04', '2020-11-05 04:09:06'),
(7, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '2', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:32:40', '2020-11-05 04:32:44'),
(8, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '1', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:39:39', '2020-11-05 04:39:39'),
(9, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '2', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:40:23', '2020-11-05 04:40:32'),
(10, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '1', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:41:56', '2020-11-05 04:41:56'),
(11, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '2', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:42:20', '2020-11-05 04:42:25'),
(12, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '1', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:54:41', '2020-11-05 04:54:41'),
(13, 3, 'dsfdfdfdsfds', 'dfgfdggfgfg', 'dfdsfdsfds', 'kazimonir67@gmail.com', '01938383837', '2', '4', '6765', 'dfdfddfgfdgfgffg', '1', '2', '1600', NULL, NULL, 'tdfgfdgfdgfgfdgfg', '2020-11-05 04:55:08', '2020-11-05 04:55:09'),
(14, 3, 'mahrin', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '2', '1600', NULL, NULL, 'how are out', '2020-11-05 05:09:50', '2020-11-05 05:09:53'),
(15, 3, 'mahrin', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '1', '1600', NULL, NULL, 'how are out', '2020-11-05 05:17:43', '2020-11-05 05:17:43'),
(16, 3, 'mahrin', 'Hosen', 'Khan Group', 'kazimonir67@gmail.com', '01938383837', '2', '4', '1215', 'A/C/2,Mirbag,Mogbazar,Dhaka', '1', '2', '1600', NULL, NULL, 'how are out', '2020-11-05 05:19:56', '2020-11-05 05:20:00'),
(17, 3, 'Robin', 'Hosen', 'monir group', 'kazimonir@gmail.com', '01938383837', '2', '4', '1215', 'Dhaka', '1', '2', '1600', NULL, NULL, 'how are out', '2020-11-05 05:25:51', '2020-11-05 05:25:54'),
(18, 3, 'Mim', 'Hosen', 'monir group', 'kazimonir@gmail.com', '01938383837', '2', '4', '1215', 'Dhaka', '1', '2', '1600', NULL, NULL, 'how are out', '2020-11-05 06:17:26', '2020-11-05 06:17:34'),
(19, 3, 'Mim', 'Hosen', 'monir group', 'kazimonir@gmail.com', '01938383837', '2', '4', '1215', 'Dhaka', '1', '1', '1600', NULL, NULL, 'how are out', '2020-11-05 06:21:17', '2020-11-05 06:21:17'),
(20, 3, 'Mim', 'Hosen', 'monir group', 'kazimonir@gmail.com', '01938383837', '2', '4', '1215', 'Dhaka', '1', '1', '1600', NULL, NULL, 'how are out', '2020-11-05 06:22:17', '2020-11-05 06:22:17'),
(21, 3, 'Monir', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:38:34', '2020-11-24 16:38:36'),
(22, 3, 'Monir', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:41:52', '2020-11-24 16:41:52'),
(23, 3, 'Monir3', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:42:23', '2020-11-24 16:42:25'),
(24, 3, 'Monir3', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:46:46', '2020-11-24 16:46:46'),
(25, 3, 'Monir3', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:47:10', '2020-11-24 16:47:11'),
(26, 3, 'Monir3', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:51:37', '2020-11-24 16:51:37'),
(27, 3, 'Monir32', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, 'this is mail pdf', '2020-11-24 16:52:04', '2020-11-24 16:52:05'),
(28, 7, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:05:42', '2020-11-24 17:05:44'),
(29, 7, 'Monir0', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:16:11', '2020-11-24 17:16:12'),
(30, 7, 'Monir0', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:17:36', '2020-11-24 17:17:38'),
(31, 7, 'Monir0', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:21:51', '2020-11-24 17:21:52'),
(32, 7, 'Monir36', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:31:40', '2020-11-24 17:31:41'),
(33, 7, 'Monir36', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhakal', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:36:26', '2020-11-24 17:36:27'),
(34, 7, 'Monir', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:43:43', '2020-11-24 17:43:45'),
(35, 7, 'Monir27', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:48:08', '2020-11-24 17:48:09'),
(36, 7, 'Monir27', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:49:12', '2020-11-24 17:49:14'),
(37, 7, 'Monir27', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:51:06', '2020-11-24 17:51:07'),
(38, 7, 'Monir325', 'Khan4', 'Khan group8', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 17:58:11', '2020-11-24 17:58:12'),
(39, 7, 'Monir325', 'Khan4', 'Khan group8', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '600', NULL, NULL, NULL, '2020-11-24 18:00:47', '2020-11-24 18:00:47'),
(40, 7, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 18:01:36', '2020-11-24 18:01:37'),
(41, 7, 'Monir325', 'Khan4', 'Khan group8', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, NULL, '2020-11-24 18:03:39', '2020-11-24 18:03:41'),
(42, 7, 'Monir', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '600', NULL, NULL, 'fdggfdgfgdfg', '2020-11-24 18:15:10', '2020-11-24 18:15:15'),
(43, 3, 'Monir', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '6000', NULL, NULL, NULL, '2020-11-26 03:34:12', '2020-11-26 03:34:23'),
(44, 7, 'Monir', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, 'asdssddsdsd', '2020-11-26 04:24:58', '2020-11-26 04:24:58'),
(45, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, 'dffdsfsdf', '2020-11-26 04:30:00', '2020-11-26 04:30:00'),
(46, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, 'dffdsfsdf', '2020-11-26 04:32:50', '2020-11-26 04:32:50'),
(47, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, 'dffdsfsdf', '2020-11-26 04:35:58', '2020-11-26 04:35:58'),
(48, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, 'dffdsfsdf', '2020-11-26 04:41:47', '2020-11-26 04:41:47'),
(49, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, NULL, '2020-11-26 04:42:38', '2020-11-26 04:42:38'),
(50, 3, 'Monir22', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, NULL, '2020-11-26 04:46:26', '2020-11-26 04:46:26'),
(51, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '500', NULL, NULL, NULL, '2020-11-26 04:56:33', '2020-11-26 04:56:38'),
(52, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, NULL, '2020-11-26 04:57:38', '2020-11-26 04:57:38'),
(53, 3, 'Monir22', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '500', NULL, NULL, NULL, '2020-11-26 05:07:19', '2020-11-26 05:07:21'),
(54, 3, 'Monir22', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '1', '0', NULL, NULL, NULL, '2020-11-26 05:08:03', '2020-11-26 05:08:03'),
(55, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '500', NULL, NULL, NULL, '2020-11-26 05:08:45', '2020-11-26 05:08:47'),
(56, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '500', NULL, NULL, NULL, '2020-11-26 05:10:01', '2020-11-26 05:10:03'),
(57, 3, 'Monir2', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '5650', NULL, NULL, NULL, '2020-11-26 05:12:34', '2020-11-26 05:12:36'),
(58, 3, 'Monir22', 'Khan', 'Khan group', 'kazimonir67@gmail.com', '01837171967', '2', '7', '1215', 'Dhaka', '1', '2', '100', NULL, NULL, NULL, '2020-11-26 05:16:22', '2020-11-26 05:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'M', '2020-09-19 16:00:51', NULL),
(2, 'L', '2020-09-19 16:00:51', NULL),
(3, 'XL', '2020-09-19 16:00:51', NULL),
(4, 'S', '2020-09-19 16:00:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `subcategory_name`, `category_id`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'T Shirt', 8, 't-shirt', '2020-09-08 03:43:56', NULL, NULL),
(2, 'Fair & Lovely', 1, 'fair-&-lovely', '2020-09-08 03:46:45', '2020-09-17 11:57:04', NULL),
(3, 'Lungi', 8, 'lungi', '2020-09-08 04:04:57', NULL, NULL),
(4, 'Gengi', 8, 'gengi', '2020-09-08 04:05:15', NULL, NULL),
(5, 'Loation', 1, 'loation', '2020-09-08 04:06:53', '2020-09-17 11:57:04', NULL),
(6, 'Mens Fair & Lovely', 1, 'mens-fair-lovely', '2020-09-08 04:07:17', '2020-09-17 11:57:04', NULL),
(7, 'Face Wash', 1, 'face-wash', '2020-09-08 07:05:45', '2020-09-17 11:57:04', NULL),
(8, 'Fan', 9, 'fan', '2020-09-22 05:28:28', NULL, NULL),
(9, 'Switch', 9, 'switch', '2020-09-22 05:29:16', NULL, NULL),
(10, 'Drinks', 2, 'drinks', '2020-09-23 15:47:44', NULL, NULL),
(11, 'Fruits', 2, 'fruits', '2020-09-23 15:50:54', NULL, NULL),
(12, 'Laptop', 9, 'laptop', '2020-09-23 15:59:37', NULL, NULL),
(13, 'Mobile', 9, 'mobile', '2020-09-29 03:44:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `provider_id`, `provider`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2020-08-30 22:17:52', '$2y$10$R8pw75dbgziWALvYmHW8ROfqLPqvbwrQn6e9g9syVuyNC5pYRWtSa', '01938383837', NULL, NULL, NULL, '2020-08-21 21:40:33', '2020-08-30 22:17:52'),
(3, 'Monir Hosen', 'kazimonir67@gmail.com', '2020-08-30 22:22:32', '$2y$10$ApP9sK9eWFn14D4DafhxpO64iZG9FY8bGfKG4v85nLb1jdYUGvSWy', '01837171967', NULL, NULL, NULL, '2020-08-30 22:22:12', '2020-08-30 22:22:32'),
(7, 'Khan', 'laraveltest30@gmail.com', '2020-12-03 15:39:45', '$2y$10$yv9nMrGQHi8o8b89XRdto.xmSdblERy/9cna60vNKmyvO5vsLlDda', NULL, NULL, NULL, NULL, '2020-12-02 17:03:05', '2020-11-24 17:03:05'),
(11, 'Chawdury', 'tariquehasan.cit.bd@gmail.com', '2020-12-03 15:39:32', '$2y$10$B/g8CohnKkJJWA.evLcoaOpxTSFsixKsLz4lUDk5J8nsWyRDu1XIW', NULL, NULL, NULL, NULL, '2020-12-03 05:41:12', '2020-11-27 05:41:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_coupons`
--
ALTER TABLE `product_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_coupons`
--
ALTER TABLE `product_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

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
