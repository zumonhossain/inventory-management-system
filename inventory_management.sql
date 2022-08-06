-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 07:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `category_slug`, `category_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'LED TV', 'category-1562ed4c25e986e', 1, 1, NULL, '2022-08-05 10:58:14', NULL),
(2, 'Cement', 'category-1562ed4c30d4c91', 1, 1, NULL, '2022-08-05 10:58:24', NULL),
(3, 'Smart Phone', 'category-1562ed4c3f9ba8c', 1, 1, NULL, '2022-08-05 10:58:39', NULL),
(4, 'Steel', 'category-1562ed4c4de7dda', 1, 1, NULL, '2022-08-05 10:58:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `customer_image`, `mobile_no`, `email`, `address`, `customer_slug`, `customer_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Zumon Hossain', 'upload/customer-image/809017.jpg', '01644954478', 'zumonhossain10@gmail.com', 'Chandpur, Bangladesh', 'customer-1562ed4b4e92753', 1, 1, NULL, '2022-08-05 10:54:38', NULL),
(2, 'Samiul Siddique Shakil', 'upload/customer-image/174916.jpg', '01638357554', 'samiulshakil@gmail.com', 'Comilla, Bangladesh', 'customer-1562ed4b7662359', 1, 1, NULL, '2022-08-05 10:55:18', NULL),
(3, 'MD Sajeeb', 'upload/customer-image/489305.jpg', '01790817447', 'sajeeb@gmail.com', 'Dhaka, Bangladesh', 'customer-1562ed4b979bb7b', 1, 1, NULL, '2022-08-05 10:55:51', NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `selling_qty` double DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `invoice_detail_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_28_015506_create_suppliers_table', 1),
(6, '2022_07_28_094416_create_customers_table', 1),
(7, '2022_07_29_022038_create_units_table', 1),
(8, '2022_07_29_032604_create_categories_table', 1),
(9, '2022_07_29_104340_create_products_table', 1),
(10, '2022_07_30_013145_create_purchases_table', 1),
(11, '2022_08_01_102309_create_invoices_table', 1),
(12, '2022_08_01_102453_create_invoice_details_table', 1),
(13, '2022_08_01_102546_create_payments_table', 1),
(14, '2022_08_01_102618_create_payment_details_table', 1);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_detail_status` tinyint(4) NOT NULL DEFAULT 1,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `unit_id`, `category_id`, `name`, `quantity`, `product_slug`, `product_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Bosundora Cement', 20, 'product-1562ed4ca6300c7', 1, 1, NULL, '2022-08-05 11:00:22', NULL),
(2, 1, 2, 4, 'Bosundora Steel', 0, 'product-1562ed4cc6496f4', 1, 1, NULL, '2022-08-05 11:00:54', NULL),
(3, 2, 2, 4, 'KSRM Steel', 0, 'product-1562ed4cdfd17c2', 1, 1, NULL, '2022-08-05 11:01:19', NULL),
(4, 3, 3, 3, 'Walton Mobile w52', 0, 'product-1562ed4cf5d8b23', 1, 1, NULL, '2022-08-05 11:01:41', NULL),
(5, 3, 3, 3, 'Walton Mobile w55', 0, 'product-1562ed4d0ad10fe', 1, 1, NULL, '2022-08-05 11:02:02', NULL),
(6, 4, 2, 2, 'Shah Cement', 0, 'product-1562ed4d23c9f89', 1, 1, NULL, '2022-08-05 11:02:27', NULL),
(7, 5, 2, 2, 'Madina Cement', 0, 'product-1562ed4d3c88d3d', 1, 1, NULL, '2022-08-05 11:02:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `purchase_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `product_id`, `purchase_no`, `date`, `description`, `buying_qty`, `unit_price`, `buying_price`, `purchase_slug`, `purchase_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'ea-52452', '2022-08-05', 'Good Product', 20, 2500, 50000, NULL, 1, 1, NULL, '2022-08-05 11:06:47', '2022-08-05 11:15:09'),
(2, 1, 4, 3, 'ea-15353', '2022-08-04', 'Good Product', 30, 5000, 150000, NULL, 1, 1, NULL, '2022-08-05 11:07:59', '2022-08-05 11:15:17'),
(3, 2, 4, 2, 'ea-5325', '2022-08-03', 'Good', 40, 1500, 60000, NULL, 0, 1, NULL, '2022-08-05 11:08:40', '2022-08-05 11:08:40'),
(4, 2, 4, 3, 'ea-36223', '2022-08-02', 'Well', 50, 4500, 225000, NULL, 0, 1, NULL, '2022-08-05 11:09:59', '2022-08-05 11:09:59'),
(5, 3, 3, 4, 'ea-89362', '2022-08-01', 'Good Phone', 60, 1200, 72000, NULL, 1, 1, NULL, '2022-08-05 11:10:40', '2022-08-05 11:15:29'),
(6, 3, 3, 5, 'ea-0284', '2022-08-06', 'Nice Phone', 70, 1500, 105000, NULL, 1, 1, NULL, '2022-08-05 11:11:25', '2022-08-05 11:15:43'),
(7, 4, 2, 1, 'ea-28463', '2022-08-07', 'well', 80, 500, 40000, NULL, 0, 1, NULL, '2022-08-05 11:12:19', '2022-08-05 11:12:19'),
(9, 4, 2, 7, 'ea-3578', '2022-08-09', 'Good Product', 100, 4500, 450000, NULL, 1, 1, NULL, '2022-08-05 11:13:45', '2022-08-05 11:14:58'),
(10, 5, 2, 7, 'ea-4729', '2022-08-11', 'Good Cement', 110, 3500, 385000, NULL, 1, 1, NULL, '2022-08-05 11:14:27', '2022-08-05 11:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile_no`, `email`, `address`, `supplier_slug`, `supplier_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Bosundora', '01852669486', 'bosundora@gmail.com', 'Purana Platon', 'supplier-1562ed4a9e77dea', 1, 1, NULL, '2022-08-05 10:51:42', NULL),
(2, 'KSRM', '01644954478', 'ksrm@gmail.com', 'New Bazar Dhaka', 'supplier-1562ed4abba6cd9', 1, 1, NULL, '2022-08-05 10:52:11', NULL),
(3, 'Walton', '01790817447', 'walton@gmail.com', 'Gulshan Link Road', 'supplier-1562ed4ad72a6b8', 1, 1, NULL, '2022-08-05 10:52:39', NULL),
(4, 'Shah', '017465357906', 'shah@gmail.com', 'Dhank, Bangladesh', 'supplier-1562ed4af463d75', 1, 1, NULL, '2022-08-05 10:53:08', NULL),
(5, 'Madina', '01638357554', 'madina@gmail.com', 'Dhank, Bangladesh', 'supplier-1562ed4b106bb7a', 1, 1, NULL, '2022-08-05 10:53:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `unit_slug`, `unit_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'GM', 'unit-1562ed4bbad2ce0', 1, 1, NULL, '2022-08-05 10:56:26', NULL),
(2, 'KG', 'unit-1562ed4bc573f53', 1, 1, NULL, '2022-08-05 10:56:37', NULL),
(3, 'PCG', 'unit-1562ed4bd18b51d', 1, 1, NULL, '2022-08-05 10:56:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Zumon Hossain', 'zumon', 'zumonhossain100@gmail.com', NULL, NULL, '$2y$10$RDzJz8s42BvVO/Kl8DMfX..0sYVEadJJpm3RpUiCjjHRUveHG8nwO', NULL, '2022-08-05 10:49:14', '2022-08-05 10:49:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
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
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
