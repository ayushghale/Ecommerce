-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 11:54 AM
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
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '3', '2024-03-26 02:52:06', '2024-03-26 02:52:06'),
(2, '2', '3', '1', '2024-03-26 02:52:15', '2024-03-26 02:52:15'),
(3, '2', '5', '2', '2024-03-26 02:53:36', '2024-03-26 02:53:36');

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
(1, 'Electronics', '2024-03-26 02:43:37', '2024-03-26 02:43:37'),
(2, 'Clothing', '2024-03-26 02:43:45', '2024-03-26 02:43:45'),
(3, 'Books', '2024-03-26 02:44:00', '2024-03-26 02:44:00'),
(4, 'Home & Kitchen', '2024-03-26 02:44:04', '2024-03-26 02:44:04');

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
(9, '2024_03_22_134513_create_carts_table', 1),
(11, '2024_03_22_134525_create_reviews_table', 1),
(15, '2024_03_22_134501_create_orders_table', 2),
(16, '2024_03_22_134508_create_order_details_table', 2),
(18, '2024_03_22_134520_create_payments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
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
(1, '2', 1879.94, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-26 04:57:00', '2024-03-26 04:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
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
(1, '1', '1', 3, 1797, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-26 04:57:00', '2024-03-26 04:57:00'),
(2, '1', '3', 1, 19, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-26 04:57:00', '2024-03-26 04:57:00'),
(3, '1', '5', 2, 58, 'zkZcley5ZY8bMuhmiQRGhmT73ZtOiX80', 'pending', '2024-03-26 04:57:00', '2024-03-26 04:57:00');

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
  `order_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
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
(1, '1', '2', 'cash in hand', 1879.94, NULL, 'pending', '2024-03-26 04:57:00', '2024-03-26 04:57:00');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'authToken', '87b654a233068b6389c0529a4df2f9c35efce593dcf79e14e98c1dae0eb0a6e7', '[\"*\"]', NULL, NULL, '2024-03-25 20:35:55', '2024-03-25 20:45:33'),
(3, 'App\\Models\\User', 3, 'authToken', '93e5e618874bb512d68e44d86cab9559ce524918688ba859f1ae69ba182f6d8e', '[\"*\"]', NULL, NULL, '2024-03-26 05:00:25', '2024-03-26 05:00:25');

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
  `category_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Smartphone', '/site/uploads/product/1794576851319942.jpg', 'A powerful smartphone with the latest features.', '599.99', '1', '2024-03-26 02:45:51', '2024-03-26 02:45:51'),
(2, 'Laptop', '/site/uploads/product/1794576926455491.jpg', 'High-performance laptop for work and entertainment.', '999.99', '1', '2024-03-26 02:47:03', '2024-03-26 02:47:03'),
(3, 'T-shirt', '/site/uploads/product/1794576951555076.jpg', 'Comfortable cotton t-shirt for everyday wear.', '19.99', '2', '2024-03-26 02:47:27', '2024-03-26 02:47:27'),
(4, 'Jeans', '/site/uploads/product/1794576968785973.jpg', 'Classic denim jeans for a timeless look.', '39.99', '2', '2024-03-26 02:47:44', '2024-03-26 02:47:44'),
(5, 'Python Programming for Beginners', '/site/uploads/product/1794576986090706.jpg', 'A beginner-friendly guide to Python programming language.', '29.99', '3', '2024-03-26 02:48:00', '2024-03-26 02:48:00'),
(6, 'Cooking Utensil Set', '/site/uploads/product/1794577005007313.jpg', 'Complete set of cooking utensils for your kitchen.', '49.99', '4', '2024-03-26 02:48:18', '2024-03-26 02:48:18'),
(7, 'Bluetooth Speaker', '/site/uploads/product/1794577028407871.jpg', 'Portable bluetooth speaker for music on the go.', '79.99', '1', '2024-03-26 02:48:40', '2024-03-26 02:48:40'),
(8, 'Hoodie', '/site/uploads/product/1794577045527597.jpg', 'Warm and stylish hoodie for chilly days.', '29.99', '2', '2024-03-26 02:48:57', '2024-03-26 02:48:57'),
(9, 'Novel: The Great Gatsby', '/site/uploads/product/1794577067069159.jpg', 'Classic novel by F. Scott Fitzgerald.', '12.99', '3', '2024-03-26 02:49:17', '2024-03-26 02:49:17'),
(10, 'Coffee Maker', '/site/uploads/product/1794577103730722.jpg', 'Automatic coffee maker for brewing your favorite coffee.', '69.99', '4', '2024-03-26 02:49:52', '2024-03-26 02:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
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
  `image` varchar(255) DEFAULT NULL,
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
(1, 'admin', NULL, 'admin@gmail.com', 'pkr', '9999999999', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 1, NULL, '2024-03-25 19:52:46', '2024-03-25 19:52:46'),
(2, 'John Doe', 'john.jpg', 'john@example.com', 'New York', '1234567890', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(3, 'Jane Smith', 'jane.jpg', 'jane@example.com', 'Los Angeles', '9876543210', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(4, 'Michael Johnson', 'michael.jpg', 'michael@example.com', 'Chicago', '4567891230', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(5, 'Emily Davis', 'emily.jpg', 'emily@example.com', 'San Francisco', '7891234560', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(6, 'Chris Wilson', 'chris.jpg', 'chris@example.com', 'Seattle', '6543217890', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL),
(7, 'Sarah Brown', 'sarah.jpg', 'sarah@example.com', 'Miami', '3216549870', NULL, '$2y$12$FUzqQyBgt8r6MoyBm49wDeHeY6jvsZhzn/XdO5Q4doAW4JS.JrKJG', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
