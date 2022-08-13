-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 31, 2022 lúc 05:46 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dbdatn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Đầm', 1, '2022-04-22', '2022-07-12'),
(2, 'Váy', 1, '2022-04-22', '2022-07-12'),
(6, 'Áo phông', 1, '2022-05-13', '2022-05-13'),
(10, 'Áo thun', 1, '2022-07-27', '2022-07-27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rep_id` int(11) NOT NULL DEFAULT 0,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `product_id`, `customer_id`, `rep_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 15, 0, '123123qweq', 0, '2022-07-05 00:56:06', '2022-07-05 00:56:06'),
(2, 8, 15, 0, 'Có cái gì k', 0, '2022-07-05 01:12:16', '2022-07-05 01:12:16'),
(3, 8, 15, 0, '123123', 0, '2022-07-05 01:14:41', '2022-07-05 01:14:41'),
(4, 8, 15, 0, 'qưeqwe', 0, '2022-07-05 01:15:51', '2022-07-05 01:15:51'),
(5, 8, 15, 0, 'qưeqwe', 0, '2022-07-05 01:18:21', '2022-07-05 01:18:21'),
(6, 8, 15, 0, 'qqqq', 0, '2022-07-05 01:18:32', '2022-07-05 01:18:32'),
(7, 8, 15, 0, '123456789', 0, '2022-07-05 01:18:44', '2022-07-05 01:18:44'),
(8, 8, 15, 0, 'qưeqwe', 0, '2022-07-05 01:20:15', '2022-07-05 01:20:15'),
(9, 8, 15, 0, 'Test bình luận', 0, '2022-07-05 01:26:00', '2022-07-05 01:26:00'),
(10, 8, 15, 9, 'Test bình luận', 0, '2022-07-05 02:06:10', '2022-07-05 02:06:10'),
(11, 8, 15, 9, '1234546', 0, '2022-07-05 02:15:17', '2022-07-05 02:15:17'),
(12, 8, 15, 0, '123123', 0, '2022-07-11 20:26:10', '2022-07-11 20:26:10'),
(13, 8, 15, 0, 'test bình luận', 0, '2022-07-11 20:32:01', '2022-07-11 20:32:01'),
(14, 8, 15, 13, 'test bình luận con', 0, '2022-07-11 20:32:10', '2022-07-11 20:32:10'),
(15, 10, 16, 0, '3124', 0, '2022-07-17 02:00:49', '2022-07-17 02:00:49'),
(16, 6, 15, 0, 'qưeqwe', 0, '2022-07-27 01:08:58', '2022-07-27 01:08:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tich_diem` int(11) DEFAULT 0,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`, `tich_diem`, `address`, `password`, `status`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Hoàng Văn Ngọc', 'demo@gmail.com', '0147852369', 0, 'Hà Nội', '$2y$10$uGtw8fd5kLkJ7CTEd5R1MuI78s9zWbV81M8hNTz72eJExmwi5ct9.', 0, NULL, 'oLQFGbICI45bfPkcfzNA40X8fWVfE7aTeIqVZRXF3vWXqF8JBlQiR3Zptwpo', '2022-05-24 00:42:43', '2022-05-29'),
(14, 'Hoàng Văn Ngọc', 'demotest@gmail.com', '0989135216', 0, 'Hà Nội', '$2y$10$Ydc7Td6y7wGxbgwBwdGWduPzuRAE44W3ypfzotLkRSEpbb.b6NrAO', 1, NULL, NULL, '2022-05-29 08:40:32', '2022-05-30'),
(15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 0, 'Hà Nội', '$2y$10$d0qoMYwiCoLyZuAhVYHbLuzzMuIfzT8p3TT1WzFMpHiFxMdIZKv.6', 1, '8PFFEN2V4RC3AFLLAEMM', NULL, '2022-05-29 21:56:00', '2022-05-30'),
(16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '', 2700000, '', '$2y$10$1yLaZz5MfbcPtWF0WETmuOir1A9h7tKx4Ed/re9GKMiDBjUAYR0/6', 1, NULL, NULL, '2022-07-15 15:23:29', '2022-07-30'),
(17, 'Nguyễn nhiều', 'nhieunxps16310@fpt.edu.vn', '088803208', 0, '21984', '$2y$10$n3l/WTEz8vqUq0ztQzKKVe4Y4vmAp5T3nmDE64DgcjA3psIenLpWe', 1, 'FHB8UH5B8WXZPWGLFMAO', NULL, '2022-07-27 18:29:27', '2022-07-28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `order_note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `token` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_id`, `name`, `email`, `phone`, `total_price`, `address`, `created_at`, `updated_at`, `order_note`, `status`, `token`) VALUES
(1, 2, 'Hoàng Văn Ngọc', 'demo@gmail.com', '0147852369', 200000, 'Hà Nội', '2022-07-13 04:31:44', '2022-05-24 16:10:29', 'Chuyển hàng luôn', 2, NULL),
(2, 2, 'Hoàng Văn Ngọc', 'demo@gmail.com', '0147852369', 210000, 'Hà Nội', '2022-07-12 02:17:25', '2022-07-25 03:51:12', 'CHuyển hàng lun', 0, NULL),
(3, 2, 'Hoàng Văn Ngọc', 'demo@gmail.com', '0147852369', 350000, 'Hà Nội', '2022-07-11 02:21:05', '2022-05-29 09:22:11', 'mai hãy giao hàng', 3, NULL),
(4, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 210000, 'Hà Nội', '2022-07-09 04:03:42', '2022-07-15 07:36:43', 'Order luôn', 2, NULL),
(5, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 500000, 'Hà Nội', '2022-07-05 04:04:17', '2022-07-15 13:01:31', 'Order luôn', 2, NULL),
(6, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 450000, 'Hà Nội', '2022-07-09 04:09:43', '2022-07-14 05:32:04', 'Test', 2, NULL),
(7, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 150000, 'Hà Nội', '2022-05-29 04:19:09', '2022-05-29 11:19:09', 'ádsadads', 0, NULL),
(8, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 120000, 'Hà Nội', '2022-05-29 04:32:11', '2022-05-29 11:32:11', 'ádasd', 0, 'TTQTRZK8WFST6DE9BZVY'),
(9, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 0, 'Hà Nội', '2022-05-29 04:32:34', '2022-07-22 14:02:15', 'ádasd', 3, 'HZ09BBUC2BM2WWRM7UFA'),
(10, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 100000, 'Hà Nội', '2022-05-29 04:47:00', '2022-05-29 11:47:00', 'ádasd', 0, 'Ok4oQWCeRhvBUw3zDL7D'),
(11, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 0, 'Hà Nội', '2022-05-29 04:48:03', '2022-07-22 13:29:46', 'ádas', 0, 'fnEKOBNkdGNbZF802mVV'),
(12, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 400000, 'Hà Nội', '2022-05-29 05:00:53', '2022-07-14 07:54:25', '214234', 2, 'OOdSS43wgAraa5Ud19Uz'),
(13, 2, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0147852369', 750000, 'Hà Nội', '2022-07-08 05:09:48', '2022-07-14 07:51:16', 'ádas', 2, 'R0dlx0xw00WMevQJmZ0f'),
(14, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 250000, 'Hà Nội', '2022-05-30 00:48:53', '2022-07-14 07:50:21', 'ádasda', 2, '4Jyxuy0jkytMbbECKNMt'),
(15, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 350000, 'Hà Nội', '2022-05-30 01:00:21', '2022-07-05 13:30:01', 'adadd', 2, 'ISFi0DMn2Vgh71EUyl9q'),
(16, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 300000, 'Hà Nội', '2022-06-22 18:48:32', '2022-07-14 07:49:47', 'qưeqw', 2, 'VAm7oFyHovd2aUrhb3F2'),
(17, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 200000, 'Hà Nội', '2022-06-22 18:52:09', '2022-07-14 04:38:21', 'qưeqw', 2, '7fgkotMuc5ECEeklR4zK'),
(26, 16, '214125', 'nguyennhieu@gmail.com', '12312899', 1350000, '21n398', '2022-07-15 08:49:17', '2022-07-15 16:02:32', NULL, 3, 'gweWB2D2On8COPgCgDs0'),
(27, 16, '24154315', '534534@gmail.com', '12312', 1450000, '523465324', '2022-07-15 20:58:08', '2022-07-16 04:00:47', '5436', 2, 'y5pZ69TmX1sw0ChRUqT9'),
(28, 16, 'Nguyễn Nhiều', 'nhieu@gmail.com', '12345', 1200000, '12355', '2022-07-15 20:59:05', '2022-07-16 03:59:17', 'ó', 3, 'LU2YIFIvu1AxSZWkJh6Q'),
(29, 16, '312541', '31242@gmail.com', '21938219', 200000, '239481', '2022-07-15 21:01:22', '2022-07-16 04:03:00', '2391h2j4o', 2, '0ovV9LRaPkUhkfB2R6Lo'),
(30, 16, '2415326', '234124@gmail.com', '2139821', 1200000, '4128', '2022-07-15 21:01:45', '2022-07-16 04:02:00', 'e821734h', 3, '31rFO2mPXTxojCmWOgxe'),
(31, 16, '41236246', '463464525@gmail.com', '325236', 1000000, '653', '2022-07-15 21:03:36', '2022-07-16 04:04:36', '634634', 3, 'EzH1sXtyaYZoePGXCdgf'),
(32, 16, '12651136', '32412@gmail.com', '213981', 200000, '2983h19', '2022-07-15 21:04:03', '2022-07-16 04:04:23', '9821h', 3, 'LCaOoQpFoAReZmikFbWA'),
(33, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '2314125', 450000, '4235423', '2022-07-17 01:16:00', '2022-07-17 08:17:14', '23125', 3, 'MwzNAOuSr7CwHNbAZNo2'),
(34, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '432145', 1000000, '532523', '2022-07-17 01:16:34', '2022-07-17 08:16:55', '423', 3, 'ZeiEgip2LUn4OYR0Tc2p'),
(35, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 800000, 'Hà Nội', '2022-07-19 05:50:08', '2022-07-22 13:13:59', '123123', 2, 'eK2HO9IJZ0le1hYUL8fX'),
(36, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 800000, 'Hà Nội', '2022-07-19 07:31:48', '2022-07-19 14:32:57', NULL, 2, 'FwYoiMfSdmmQB6UiR8mG'),
(37, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 850000, 'Hà Nội', '2022-07-19 08:07:56', '2022-07-22 13:46:01', 'ádasda', 0, 'f7BJ1Q46BX6gF8Y6vXOa'),
(38, 15, 'Hoàng Văn Ngọc', 'hoangvanngoc1999@gmail.com', '0696987528', 1250000, 'Hà Nội', '2022-07-22 02:35:26', '2022-07-22 09:35:38', NULL, 1, 'BggnG6Z1JjGFC2WemQT8'),
(39, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '123', 1500000, '1412', '2022-07-27 17:35:38', '2022-07-28 01:01:43', '43', 3, 'kePJxc8unOiuCNXkJy6C'),
(40, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '43242', 1000000, '5235', '2022-07-27 18:00:55', '2022-07-28 01:10:18', '3412', 5, 'zc8JZguz44FixDGiRXlP'),
(41, 17, 'Nguyễn nhiều', 'nhieunxps16310@fpt.edu.vn', '088803208', 950000, '21984', '2022-07-27 18:30:08', '2022-07-28 02:12:31', '123', 2, 'ssCqMnK9vle2qAxKpqmV'),
(42, 17, 'Nguyễn nhiều', 'nhieunxps16310@fpt.edu.vn', '088803208', 1000000, '21984', '2022-07-28 02:05:46', '2022-07-28 09:05:46', 'ok', 0, 'XcKTGiLwgbll84EJMi6q'),
(43, 17, 'Nguyễn nhiều', 'nhieunxps16310@fpt.edu.vn', '088803208', 750000, '21984', '2022-07-28 02:08:01', '2022-07-28 09:09:58', '123', 1, 'XaU5XO1cgMkmlnsiFQOk'),
(44, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '12424', 970000, '124124', '2022-07-30 16:30:15', '2022-07-30 23:47:50', '1234', 2, 'xFfzhiMUj8G4gjJsWwaC'),
(45, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '31242512512', 170000, '4215125', '2022-07-30 16:34:06', '2022-07-30 23:49:37', '4124', 2, 'BtcBWWlwjK8PlNdKcvpr'),
(46, 16, 'nguyennhieu1507', 'nguyennhieu@gmail.com', '0829384432', 892400, '41241', '2022-07-30 19:03:05', '2022-07-31 02:08:23', '213', 4, 'PfXRso7PWMUkTPkwV6gW');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `entry_price` int(11) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `quantity`, `price`, `entry_price`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 150000, 0, '2022-05-24', '2022-05-24'),
(1, 6, 2, 200000, 0, '2022-05-24', '2022-05-24'),
(2, 6, 3, 200000, 0, '2022-05-29', '2022-05-29'),
(2, 8, 2, 450000, 0, '2022-05-29', '2022-05-29'),
(3, 4, 1, 150000, 0, '2022-05-29', '2022-05-29'),
(4, 6, 1, 200000, 0, '2022-05-29', '2022-05-29'),
(4, 8, 1, 450000, 0, '2022-05-29', '2022-05-29'),
(5, 6, 1, 200000, 0, '2022-05-29', '2022-05-29'),
(5, 8, 1, 450000, 0, '2022-05-29', '2022-05-29'),
(6, 4, 2, 150000, 0, '2022-05-29', '2022-05-29'),
(7, 4, 1, 150000, 0, '2022-05-29', '2022-05-29'),
(8, 6, 2, 200000, 0, '2022-05-29', '2022-05-29'),
(9, 6, 2, 200000, 0, '2022-05-29', '2022-05-29'),
(10, 4, 1, 150000, 0, '2022-05-29', '2022-05-29'),
(11, 6, 1, 200000, 0, '2022-05-29', '2022-05-29'),
(12, 6, 1, 200000, 0, '2022-05-29', '2022-05-29'),
(13, 8, 1, 450000, 0, '2022-05-29', '2022-05-29'),
(14, 8, 3, 450000, 0, '2022-05-30', '2022-05-30'),
(15, 6, 3, 200000, 0, '2022-05-30', '2022-05-30'),
(16, 8, 1, 450000, 0, '2022-06-23', '2022-06-23'),
(17, 8, 1, 450000, 0, '2022-06-23', '2022-06-23'),
(26, 8, 3, 450000, 0, '2022-07-15', '2022-07-15'),
(27, 6, 5, 200000, 0, '2022-07-16', '2022-07-16'),
(27, 8, 1, 450000, 0, '2022-07-16', '2022-07-16'),
(28, 6, 6, 200000, 0, '2022-07-16', '2022-07-16'),
(29, 6, 1, 200000, 0, '2022-07-16', '2022-07-16'),
(30, 6, 6, 200000, 0, '2022-07-16', '2022-07-16'),
(31, 6, 5, 200000, 0, '2022-07-16', '2022-07-16'),
(32, 6, 1, 200000, 0, '2022-07-16', '2022-07-16'),
(33, 6, 1, 200000, 0, '2022-07-17', '2022-07-17'),
(33, 10, 5, 50000, 0, '2022-07-17', '2022-07-17'),
(34, 6, 5, 200000, 0, '2022-07-17', '2022-07-17'),
(35, 6, 4, 200000, 0, '2022-07-19', '2022-07-19'),
(36, 9, 2, 350000, 0, '2022-07-19', '2022-07-19'),
(36, 10, 2, 50000, 0, '2022-07-19', '2022-07-19'),
(37, 9, 2, 350000, 0, '2022-07-19', '2022-07-19'),
(37, 10, 3, 50000, 0, '2022-07-19', '2022-07-19'),
(38, 9, 3, 350000, 0, '2022-07-22', '2022-07-22'),
(38, 10, 4, 50000, 0, '2022-07-22', '2022-07-22'),
(39, 20, 3, 500000, 0, '2022-07-28', '2022-07-28'),
(40, 21, 5, 200000, 0, '2022-07-28', '2022-07-28'),
(41, 8, 1, 450000, 0, '2022-07-28', '2022-07-28'),
(41, 20, 1, 500000, 0, '2022-07-28', '2022-07-28'),
(43, 6, 3, 250000, 0, '2022-07-28', '2022-07-28'),
(44, 6, 4, 250000, 0, '2022-07-30', '2022-07-30'),
(45, 21, 1, 200000, 0, '2022-07-30', '2022-07-30'),
(46, 8, 1, 450000, 0, '2022-07-31', '2022-07-31'),
(46, 20, 1, 500000, 0, '2022-07-31', '2022-07-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float NOT NULL,
  `sale_price` float DEFAULT 0,
  `entry_price` int(11) DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `qty` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `image`, `price`, `sale_price`, `entry_price`, `category_id`, `status`, `qty`, `created_at`, `updated_at`) VALUES
(4, 'Áo phông nam có cổ', 'ao-phong-nam-co-co', '1652405183.jpg', 200000, 150000, 0, 10, 1, '0', '2022-04-22', '2022-07-27'),
(6, 'Váy đầm', 'vay-dam', '1652407273.jpg', 250000, 0, 0, 1, 1, '28', '2022-05-13', '2022-07-30'),
(8, 'Váy đẹp', 'vay-dep', '1653815099.jpg', 500000, 450000, 0, 1, 1, '40', '2022-05-29', '2022-07-31'),
(9, 'Áo polo', 'ao-polo', '1657635772.jpg', 450000, 400000, 0, 6, 1, '54', '2022-07-12', '2022-07-27'),
(10, 'Váy thời trang', 'vay-thoi-trang', '1657635821.jpg', 550000, 50000, 0, 2, 1, '56', '2022-07-12', '2022-07-22'),
(18, 'Đầm trung niên cho mẹ sang trọng', 'dam-trung-nien-cho-me-sang-trong', '1658551908.jpg', 400000, 350000, 0, 1, 1, '50', '2022-07-23', '2022-07-23'),
(20, 'Váy đầm body', 'vay-dam-body', '1658552150.jpg', 550000, 500000, 0, 2, 1, '45', '2022-07-23', '2022-07-31'),
(21, 'Áo phông nữ', 'ao-phong-nu', '1658552215.jpg', 240000, 200000, 0, 6, 1, '43', '2022-07-23', '2022-07-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `time_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time_end` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `create_by` int(11) NOT NULL,
  `type` enum('%','$') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `detail` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `time_start`, `time_end`, `create_by`, `type`, `status`, `detail`, `created_at`, `updated_at`) VALUES
(3, 'Mã km này ok', '2022-07-31 00:14:12', '2022-08-02 01:29:55', 9, '$', 0, 30000, '2022-07-30 16:23:45', '2022-07-30 16:23:45'),
(4, 'Khuyến mại hè', '2022-07-30 19:59:00', '2022-07-31 04:53:00', 9, '%', 0, 10, '2022-07-30 18:49:57', '2022-07-30 18:49:57'),
(5, 'Nguyễn Nhiều', '2022-07-30 03:25:00', '2022-08-03 03:25:00', 9, '%', 0, 12, '2022-07-30 20:28:37', '2022-07-30 20:28:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `rating_start` float DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`rating_start`, `product_id`, `customer_id`) VALUES
(2.6, 4, 15),
(4.5, 4, 17),
(4.7, 6, 16),
(4.5, 8, 14),
(3.5, 8, 15),
(4.6, 8, 16),
(2.5, 9, 15),
(4.8, 21, 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$CbCce7MZXYKr3MAQtMVYfu1C65T8A9sNCq3EJLMY6xOv75zNwDIgi', '', '', '0', NULL, '2022-05-25'),
(2, 'Demoadmin', 'demoadmin@gmail.com', '$2y$10$CbCce7MZXYKr3MAQtMVYfu1C65T8A9sNCq3EJLMY6xOv75zNwDIgi', '', '', '1', NULL, '2022-05-25'),
(3, 'nguyennhieu', 'nguyennhieu@gmail.com', '$2y$10$1yLaZz5MfbcPtWF0WETmuOir1A9h7tKx4Ed/re9GKMiDBjUAYR0/6', '', '', '0', NULL, NULL),
(4, 'nguyennhieu', 'bossnhieu@gmail.com', '$2y$10$1yLaZz5MfbcPtWF0WETmuOir1A9h7tKx4Ed/re9GKMiDBjUAYR0/6', '', '', '1', NULL, NULL),
(9, 'Nguyễn Xuân Nhiều', 'nhieunxps16310@fpt.edu.vmm', '$2y$10$1yLaZz5MfbcPtWF0WETmuOir1A9h7tKx4Ed/re9GKMiDBjUAYR0/6', '0888800032', '3928', '0', '2022-07-28', '2022-07-28'),
(10, '1243', '41242g@gmail.com', '$2y$10$1yLaZz5MfbcPtWF0WETmuOir1A9h7tKx4Ed/re9GKMiDBjUAYR0/6', '4124', '412', '1', '2022-07-28', '2022-07-28'),
(11, 'Test', 'baotest@gmail.com', '$2y$10$bTp/ZEZNZeS8Da8P1KlVgOI/3wFJzdPZQpSfrtauP1cp.Fgz4MT9W', '12345', '123', '1', '2022-07-28', '2022-07-28');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`product_id`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
