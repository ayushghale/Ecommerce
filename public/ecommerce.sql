-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 11:49 AM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '2024-03-25 20:58:37', '2024-03-25 20:58:37'),
(2, 'Clothing', '2024-03-25 20:58:45', '2024-03-25 20:58:45'),
(3, 'Books', '2024-03-25 20:59:00', '2024-03-25 20:59:00'),
(4, 'Home & Kitchen', '2024-03-25 20:59:04', '2024-03-25 20:59:04'),
(6, 'new', '2024-04-15 20:42:57', '2024-04-15 20:45:18');

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
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_22_134441_create_categories_table', 1),
(6, '2024_03_22_134448_create_products_table', 1),
(7, '2024_03_22_134501_create_orders_table', 1),
(8, '2024_03_22_134508_create_order_details_table', 1),
(9, '2024_03_22_134513_create_carts_table', 1),
(10, '2024_03_22_134520_create_payments_table', 1),
(11, '2024_03_22_134525_create_reviews_table', 1),
(12, '2024_03_31_022457_create_favorites_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` double NOT NULL,
  `uCode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `uCode`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1879.94, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'completed', '2024-03-25 23:12:00', '2024-04-16 04:01:17'),
(2, 2, 1879.94, 'ANX4lk6RMGH5DmLaZVf3CaLEpu2n8hCb', 'pending', '2024-04-15 22:55:59', '2024-04-15 22:55:59'),
(3, 2, 1879.94, 'e15WKdimVXKuV7rzW9En5velmZsoG3HU', 'completed', '2024-04-15 22:56:31', '2024-04-16 03:57:42'),
(4, 2, 1879.94, 'iwGClwyEn2dFZjT8RvupSZnYpR31gUjs', 'completed', '2024-04-15 23:01:44', '2024-04-16 03:49:27'),
(5, 2, 1879.94, 'zCk7Ls18mylSGrkM3zqTc1vzhBJ8ixv4', 'pending', '2024-04-16 05:33:45', '2024-04-16 05:33:45'),
(6, 2, 1879.94, 'qhmS0JZgi6iXxRk1XZVSi8xqz8u1TqD3', 'pending', '2024-04-16 05:33:47', '2024-04-16 05:33:47'),
(7, 2, 1879.94, 'upzisyZjFldsLhjOJBlB5cQtOJoNcUua', 'pending', '2024-04-16 05:33:48', '2024-04-16 05:33:48'),
(8, 2, 1879.94, 'lvhYc6JqQBOrXN34KCPsxBuMo5Q6Sd3v', 'pending', '2024-04-16 05:33:53', '2024-04-16 05:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL,
  `uCode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `total`, `uCode`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1797, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-25 23:12:00', '2024-03-25 23:12:00'),
(2, 1, 3, 1, 19, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-25 23:12:00', '2024-03-25 23:12:00'),
(3, 1, 5, 2, 58, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-25 23:12:00', '2024-03-25 23:12:00'),
(4, 2, 1, 3, 1797, 'ANX4lk6RMGH5DmLaZVf3CaLEpu2n8hCb', 'pending', '2024-04-15 22:55:59', '2024-04-15 22:55:59'),
(5, 2, 3, 1, 19, 'ANX4lk6RMGH5DmLaZVf3CaLEpu2n8hCb', 'pending', '2024-04-15 22:55:59', '2024-04-15 22:55:59'),
(6, 2, 5, 2, 58, 'ANX4lk6RMGH5DmLaZVf3CaLEpu2n8hCb', 'pending', '2024-04-15 22:55:59', '2024-04-15 22:55:59'),
(7, 3, 1, 3, 1797, 'e15WKdimVXKuV7rzW9En5velmZsoG3HU', 'pending', '2024-04-15 22:56:31', '2024-04-15 22:56:31'),
(8, 3, 3, 1, 19, 'e15WKdimVXKuV7rzW9En5velmZsoG3HU', 'pending', '2024-04-15 22:56:31', '2024-04-15 22:56:31'),
(9, 3, 5, 2, 58, 'e15WKdimVXKuV7rzW9En5velmZsoG3HU', 'pending', '2024-04-15 22:56:31', '2024-04-15 22:56:31'),
(10, 4, 1, 3, 1797, 'iwGClwyEn2dFZjT8RvupSZnYpR31gUjs', 'pending', '2024-04-15 23:01:44', '2024-04-15 23:01:44'),
(11, 4, 3, 1, 19, 'iwGClwyEn2dFZjT8RvupSZnYpR31gUjs', 'pending', '2024-04-15 23:01:44', '2024-04-15 23:01:44'),
(12, 4, 5, 2, 58, 'iwGClwyEn2dFZjT8RvupSZnYpR31gUjs', 'pending', '2024-04-15 23:01:44', '2024-04-15 23:01:44'),
(13, 5, 1, 3, 1797, 'zCk7Ls18mylSGrkM3zqTc1vzhBJ8ixv4', 'pending', '2024-04-16 05:33:45', '2024-04-16 05:33:45'),
(14, 5, 3, 1, 19, 'zCk7Ls18mylSGrkM3zqTc1vzhBJ8ixv4', 'pending', '2024-04-16 05:33:45', '2024-04-16 05:33:45'),
(15, 5, 5, 2, 58, 'zCk7Ls18mylSGrkM3zqTc1vzhBJ8ixv4', 'pending', '2024-04-16 05:33:45', '2024-04-16 05:33:45'),
(16, 6, 1, 3, 1797, 'qhmS0JZgi6iXxRk1XZVSi8xqz8u1TqD3', 'pending', '2024-04-16 05:33:47', '2024-04-16 05:33:47'),
(17, 6, 3, 1, 19, 'qhmS0JZgi6iXxRk1XZVSi8xqz8u1TqD3', 'pending', '2024-04-16 05:33:47', '2024-04-16 05:33:47'),
(18, 6, 5, 2, 58, 'qhmS0JZgi6iXxRk1XZVSi8xqz8u1TqD3', 'pending', '2024-04-16 05:33:47', '2024-04-16 05:33:47'),
(19, 7, 1, 3, 1797, 'upzisyZjFldsLhjOJBlB5cQtOJoNcUua', 'pending', '2024-04-16 05:33:48', '2024-04-16 05:33:48'),
(20, 7, 3, 1, 19, 'upzisyZjFldsLhjOJBlB5cQtOJoNcUua', 'pending', '2024-04-16 05:33:48', '2024-04-16 05:33:48'),
(21, 7, 5, 2, 58, 'upzisyZjFldsLhjOJBlB5cQtOJoNcUua', 'pending', '2024-04-16 05:33:48', '2024-04-16 05:33:48'),
(22, 8, 1, 3, 1797, 'lvhYc6JqQBOrXN34KCPsxBuMo5Q6Sd3v', 'pending', '2024-04-16 05:33:53', '2024-04-16 05:33:53'),
(23, 8, 3, 1, 19, 'lvhYc6JqQBOrXN34KCPsxBuMo5Q6Sd3v', 'pending', '2024-04-16 05:33:53', '2024-04-16 05:33:53'),
(24, 8, 5, 2, 58, 'lvhYc6JqQBOrXN34KCPsxBuMo5Q6Sd3v', 'pending', '2024-04-16 05:33:53', '2024-04-16 05:33:53');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_amount` double NOT NULL,
  `transactionCode` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `payment_method`, `payment_amount`, `transactionCode`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'cash in hand', 1879.94, NULL, 'completed', '2024-03-25 23:12:00', '2024-04-16 04:00:57'),
(2, 2, 2, 'cash in hand', 1879.94, NULL, 'pending', '2024-04-15 22:55:59', '2024-04-15 22:55:59'),
(3, 3, 2, 'cash in hand', 1879.94, NULL, 'completed', '2024-04-15 22:56:31', '2024-04-16 03:57:21'),
(4, 4, 2, 'esewa', 1879.94, NULL, 'completed', '2024-04-15 23:01:44', '2024-04-16 03:49:27'),
(5, 5, 2, 'cash in hand', 1879.94, NULL, 'pending', '2024-04-16 05:33:45', '2024-04-16 05:33:45'),
(6, 6, 2, 'cash in hand', 1879.94, NULL, 'pending', '2024-04-16 05:33:47', '2024-04-16 05:33:47'),
(7, 7, 2, 'cash in hand', 1879.94, NULL, 'pending', '2024-04-16 05:33:48', '2024-04-16 05:33:48'),
(8, 8, 2, 'cash in hand', 1879.94, NULL, 'pending', '2024-04-16 05:33:53', '2024-04-16 05:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Smartphone', '/site/uploads/product/1794576851319942.jpg', 'A powerful smartphone with the latest features.', '599.99', 1, '2024-03-25 21:00:51', '2024-03-25 21:00:51'),
(2, 'Laptop', '/site/uploads/product/1794576926455491.jpg', 'High-performance laptop for work and entertainment.', '999.99', 1, '2024-03-25 21:02:03', '2024-03-25 21:02:03'),
(3, 'T-shirt', '/site/uploads/product/1794576951555076.jpg', 'Comfortable cotton t-shirt for everyday wear.', '19.99', 2, '2024-03-25 21:02:27', '2024-03-25 21:02:27'),
(4, 'Jeans', '/site/uploads/product/1794576968785973.jpg', 'Classic denim jeans for a timeless look.', '39.99', 2, '2024-03-25 21:02:44', '2024-03-25 21:02:44'),
(5, 'Python Programming for Beginners', '/site/uploads/product/1794576986090706.jpg', 'A beginner-friendly guide to Python programming language.', '29.99', 3, '2024-03-25 21:03:00', '2024-03-25 21:03:00'),
(6, 'Cooking Utensil Set', '/site/uploads/product/1794577005007313.jpg', 'Complete set of cooking utensils for your kitchen.', '49.99', 4, '2024-03-25 21:03:18', '2024-03-25 21:03:18'),
(7, 'Bluetooth Speaker', '/site/uploads/product/1794577028407871.jpg', 'Portable bluetooth speaker for music on the go.', '79.99', 1, '2024-03-25 21:03:40', '2024-03-25 21:03:40'),
(8, 'Hoodie', '/site/uploads/product/1794577045527597.jpg', 'Warm and stylish hoodie for chilly days.', '29.99', 2, '2024-03-25 21:03:57', '2024-03-25 21:03:57'),
(9, 'Novel: The Great Gatsby', '/site/uploads/product/1794577067069159.jpg', 'Classic novel by F. Scott Fitzgerald.', '12.99', 3, '2024-03-25 21:04:17', '2024-03-25 21:04:17'),
(10, 'Coffee Maker', '/site/uploads/product/1794577103730722.jpg', 'Automatic coffee maker for brewing your favorite coffee.', '69.99', 4, '2024-03-25 21:04:52', '2024-03-25 21:04:52'),
(12, 'new', '/site/uploads/product/1796482320676717.png', 'asd', '199999', 2, '2024-04-15 21:40:13', '2024-04-15 21:47:29'),
(13, 'test', '/site/uploads/product/1796546765391788.png', 'sfrgesrg', '32453', 2, '2024-04-16 14:51:48', '2024-04-16 14:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `location`, `contact_number`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', 'admin@gmail.com', 'pkr', '9999999999', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 1, NULL, '2024-03-25 14:07:46', '2024-03-25 14:07:46'),
(2, 'John Doe', 'john.jpg', 'john@example.com', 'New York', '1234567890', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(3, 'Jane Smith', 'jane.jpg', 'jane@example.com', 'Los Angeles', '9876543210', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(4, 'Michael Johnson', 'michael.jpg', 'michael@example.com', 'Chicago', '4567891230', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(5, 'Emily Davis', 'emily.jpg', 'emily@example.com', 'San Francisco', '7891234560', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(6, 'Chris Wilson', 'chris.jpg', 'chris@example.com', 'Seattle', '6543217890', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(7, 'Sarah Brown', 'sarah.jpg', 'sarah@example.com', 'Miami', '3216549870', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(8, 'Ayush', '', 'user1@gmail.com', 'Nepal, Pokhara', '9819160357', NULL, '$2y$12$AAXVCJzMZKCoM8yTiumGjOWsw6T4IZeGQ1V0rAtZWRoOJXT64Hlbm', 0, NULL, '2024-04-15 20:16:38', '2024-04-15 20:25:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

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
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

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
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_number_unique` (`contact_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
