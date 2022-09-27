-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 12:58 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `print`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(225) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `description`, `cost`, `end_date`, `created_by_id`, `created_by_name`, `created_at`, `updated_at`) VALUES
(5, 'احمد', 'هذا المنتج غالي', 500, '2021/09/24', 1, 'Admin', '2021-09-11 13:16:04', '2021-09-11 13:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `attending_leavins`
--

CREATE TABLE `attending_leavins` (
  `id` int(11) NOT NULL,
  `staffs_id` int(11) NOT NULL,
  `staffs_name` varchar(225) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(225) NOT NULL,
  `attend_time` varchar(50) NOT NULL,
  `leave_time` varchar(50) DEFAULT NULL,
  `day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attending_leavins`
--

INSERT INTO `attending_leavins` (`id`, `staffs_id`, `staffs_name`, `created_by_id`, `created_by_name`, `attend_time`, `leave_time`, `day`, `created_at`, `updated_at`) VALUES
(5, 4, 'asdasd', 1, 'Admin', '09:00', '06:30', '2021-09-13', '2021-09-13 10:10:58', '2021-09-13 11:23:44'),
(6, 1, 'ahmed', 1, 'Admin', '16:07', '16:01', '2021-09-30', '2021-09-13 10:37:20', '2021-09-13 12:07:36'),
(7, 1, 'ahmed', 1, 'Admin', '15:45', '18:00', '2021-09-13', '2021-09-13 10:46:37', '2021-09-13 11:45:50'),
(8, 1, 'ahmed', 1, 'Admin', '10:00', '06:00', '2021-09-22', '2021-09-13 11:27:12', '2021-09-13 11:41:57'),
(9, 1, 'ahmed', 1, 'Admin', '16:03', '15:15', '2021-09-13', '2021-09-13 12:03:24', '2021-09-13 12:04:05'),
(10, 1, 'ahmed', 1, 'Admin', '16:07', '06:31', '2021-09-13', '2021-09-13 12:07:53', '2021-09-13 12:10:30'),
(11, 1, 'ahmed', 1, 'Admin', '09:00', '16:10', '2021-09-13', '2021-09-13 12:09:46', '2021-09-13 12:10:20'),
(12, 1, 'ahmed', 1, 'Admin', '16:09', '16:10', '2021-09-13', '2021-09-13 12:09:55', '2021-09-13 12:10:11'),
(13, 1, 'ahmed', 1, 'Admin', '16:10', '16:14', '2021-09-13', '2021-09-13 12:10:39', '2021-09-13 12:14:44'),
(14, 1, 'ahmed', 1, 'Admin', '16:14', '16:15', '2021-09-13', '2021-09-13 12:14:53', '2021-09-13 12:15:02'),
(15, 1, 'ahmed', 1, 'Admin', '22:29', '00:00', '2021-10-04', '2021-10-04 18:29:30', '2021-10-04 18:29:57'),
(16, 1, 'ahmed', 1, 'Admin', '00:00', '02:35', '2021-10-30', '2021-10-29 22:35:20', '2021-10-29 22:35:28'),
(17, 4, 'asdasd', 1, 'Admin', '00:57', NULL, '2021-11-11', '2021-11-10 20:57:32', '2021-11-10 20:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `bill_num` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `branchs_id` int(11) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `trader_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `payed` int(11) NOT NULL DEFAULT 0,
  `reast` int(11) NOT NULL DEFAULT 0,
  `nots` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'عقيدة', NULL, NULL),
(2, 'حديث', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_commmintes`
--

CREATE TABLE `blog_commmintes` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `blog_writers_id` int(11) NOT NULL,
  `blog_posts_id` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `title` varchar(225) NOT NULL,
  `body` longtext NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `views` int(11) DEFAULT 0,
  `writer_name` varchar(200) NOT NULL,
  `writer_type` varchar(50) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `blog_categories_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seo_title` varchar(250) NOT NULL,
  `seo_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(150) NOT NULL,
  `name_en` varchar(150) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `name_ar`, `name_en`, `url`, `location`, `created_at`, `updated_at`) VALUES
(16, 'الفرع الرئيسي', 'yalla2prin master', 'null', 'البيني فيصل', '2021-12-25 15:59:30', '2021-12-25 15:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `branchs_products`
--

CREATE TABLE `branchs_products` (
  `id` int(11) NOT NULL,
  `branchs_id` bigint(20) NOT NULL,
  `products_id` bigint(20) NOT NULL,
  `stoke` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branchs_products`
--

INSERT INTO `branchs_products` (`id`, `branchs_id`, `products_id`, `stoke`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `img` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brand_products`
--

CREATE TABLE `brand_products` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(220) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name_ar`, `name_en`, `parent_id`, `slug`, `img`, `created_at`, `updated_at`) VALUES
(10, 'T-Shirt', 'T-Shirt', NULL, 't-shirt', 'category/BNeob5WyNzIIDGkGjWptskwJooCzcsy5UUXr0rpR.jpg', '2021-10-23 13:34:40', '2022-01-10 13:35:06'),
(28, 'تشيرت رجالي', 'Men\'s T-Shirts', 10, 'tshyrt-rgaly', 'category/tPATnUP3fZI2oW5Gu9xC8bjAtpYUnbTKmQDXGgmI.jpg', '2021-12-21 11:35:01', '2022-01-10 13:35:06'),
(29, 'تشيرت حريمي', 'Women\'s T-Shirts', 10, 'tshyrt-hrymy', 'category/UfraaiNnxqbBDQr8oSXRvogjXokIcj1QjyIROLpq.jpg', '2021-12-21 11:35:53', '2022-01-10 13:35:06'),
(32, 'تيشرت يوم ممتع', 'fun day t-shirt', 10, 'tyshrt-yom-mmtaa', 'defalt.png', '2021-12-30 16:48:25', '2021-12-30 16:48:25'),
(33, 'سويت شيرت هودي', 'Sweatshirts hoodie', NULL, 'sweatshirts-hoodie', 'category/WuOMK9H5VaT0k9uLRTKY3gf5QWPwNIFLCMqgMMm6.jpg', '2022-01-10 14:18:13', '2022-01-10 14:24:20'),
(34, 'هودي رجالي', 'Men\'s hoodie', 33, 'hody-rgaly', 'category/SNAsswdxRNllejtYW1rP16UpGH6wk5M0Cqh1WJRC.jpg', '2022-01-10 14:21:45', '2022-01-10 14:24:20'),
(35, 'هودي حريمي', 'Women\'s hoodie', 33, 'hody-hrymy', 'category/e4EkHeO7OwwNEF68TegVlle4BTmg2hycCGdwq8UG.jpg', '2022-01-10 14:22:37', '2022-01-10 14:24:20'),
(36, 'سويتشيرت بي رقبة دائريه', 'Sweatshirts round', NULL, 'soytshyrt-by-rkb-dayryh', 'category/aPERV0TEDQwuHjDbWEb0kiV4DOCCg49ayHJyA9VX.jpg', '2022-01-10 14:27:31', '2022-01-10 14:27:31'),
(37, 'سويتشرت رجالي', 'Men\'s Sweatshirts', 36, 'soytshrt-rgaly', 'category/4Mir3kb7iWRemBvL9LGeFC37NBEZYaO56FMBfsay.jpg', '2022-01-10 14:28:18', '2022-01-10 14:28:18'),
(39, 'سويتشيرت حريمي', 'Women\'s Sweatshirts', 36, 'soytshyrt-hrymy', 'category/BGWtYUEu8KfTChC0cZwd25s2nkgHD08nugttbMD4.jpg', '2022-01-10 14:29:46', '2022-01-10 14:29:46'),
(40, 'مج أبيض', 'white mug', NULL, 'mg-abyd', 'category/VsHLEOxvGCtpbVb3bOdszDDrNN17Sv9ZpNZjmBq2.jpg', '2022-01-24 15:02:08', '2022-01-24 15:02:08'),
(41, 'نوت بوك A4', 'notebook A4', NULL, 'not-bok-a4', 'category/F81s5vRVgH7W1bJaZK4RJmGlcyrux4naC34zKYo1.jpg', '2022-01-30 18:32:51', '2022-01-30 18:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `cat_products`
--

CREATE TABLE `cat_products` (
  `id` int(11) NOT NULL,
  `products_id` bigint(20) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_products`
--

INSERT INTO `cat_products` (`id`, `products_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(1, 1, 36, NULL, NULL),
(2, 1, 37, NULL, NULL),
(3, 1, 39, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `governorate` varchar(225) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `purchases_num` int(11) NOT NULL DEFAULT 0,
  `code` int(11) DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `password`, `phone`, `country`, `city`, `governorate`, `address`, `post_code`, `purchases_num`, `code`, `active`, `created_at`, `updated_at`) VALUES
(52, 'Mohamed', 'Simple.sign@hotmail.com', '$2y$10$FfEA7QwNphWyR1oXA6SsoeXgI1s58ZoBzvcN9Z6En4MK5RpTBqlde', '01004063202', 'Egypt', 'Giza', 'Giza', '7 Moustafa Badawy Street', '1125', 0, 9274, 0, '2021-11-13 18:13:32', '2021-11-13 18:16:39'),
(59, 'saleh ibrahim', 'ei1420781@gmail.com', '$2y$10$FnhK0y5Ey72QY8Pu6gXcD.aGOC3F4JdbxSterqoiX3mBUlSxb9P0W', '01553911328', NULL, NULL, NULL, NULL, NULL, 0, 4930, 0, '2021-12-07 14:55:55', '2021-12-07 14:55:55'),
(60, 'Mazen Ahmed', 'gabal19112020@gmail.com', '$2y$10$e2sp0rB7.MAvN5.WrwAiM.736aUTm396RnXzPW5.vCHI/ig2pki7e', '01090030023', 'Egypt', 'Maadi', 'Cairo', '١٥٨ ش مصر حلوان الزراعي المعادي', '11742', 0, 8218, 0, '2021-12-09 08:43:29', '2021-12-09 09:01:16'),
(61, 'Abdelmonim', 'aabdelmonem794@gmail.com', '$2y$10$/gjOx0F/7eaLoqVCoj4Lg.ZrW0ZWrKaj2520FJM/DZ9vuLxlDyeku', '01111336015', NULL, NULL, NULL, NULL, NULL, 0, 4084, 0, '2021-12-14 22:56:41', '2021-12-14 22:56:41'),
(62, 'Mohamed samy', 'm_sami55@yahoo.com', '$2y$10$A6aLhEZ8ntCLD9qTl1PYp.ZptyC6HBJEOU.NtAKgYp/oNoiSY5TJ2', '01110014993', NULL, NULL, NULL, NULL, NULL, 0, 2410, 0, '2021-12-18 20:58:40', '2021-12-18 20:58:40'),
(63, 'Ahmed Abd Salam', 'abdelsalama222@gmail.com', '$2y$10$bugllw0kNIcbgdFLNVbHvOsrlHE7NS79ip63GJJ/eqnt0B7uZ8yc2', '01146084849', 'Chile', 'Giza', 'Egypt', 'El Haram', '2202', 0, 6596, 0, '2021-12-19 08:59:43', '2021-12-19 09:44:18'),
(64, 'Mostafa Abdo', 'mostafaabdokhattab4@gmail.com', '$2y$10$CvT4H/XNt89h4mQUDqCK9uxYoqeNWDP/Hh3UYky.QONYgUAXM4wYe', '011111156654456', NULL, NULL, NULL, NULL, NULL, 0, 1178, 0, '2021-12-19 10:02:58', '2021-12-19 10:02:58'),
(65, 'Ahmed Abd Salam', 'abdelsalama222@gmail.com', '$2y$10$kk4fHio.FIN28eEDZwlIaOGaB/kgiuG/EGIFdg84sku/4iBlTnMFG', '01146084849', 'Egypt', 'Giza', 'asd', 'El Haram, giza', '2202', 0, 9132, 0, '2022-01-06 19:52:00', '2022-01-06 19:52:44'),
(66, 'Ahmed Fouad', 'afoda11r@gmail.com', '$2y$10$cEM80uKapd/pdeFxRsY56OxqN5i3/eUCMqbe2kqohZRdsnJ3vjppu', '01064100110', 'Egypt', '6th of October', 'Giza', 'October gardens-Degla gardens-114-34', '00202', 0, 5215, 0, '2022-01-11 18:59:04', '2022-01-11 19:01:09'),
(67, 'Haidy', 'Haitoto.hs@gmail.com', '$2y$10$7iNpGwg.IbyclzurjqUhVuWT5GSvAYqAsTL9vQ6bqLcEaTOvos97O', '01000674316', NULL, NULL, NULL, NULL, NULL, 0, 5910, 0, '2022-01-21 17:42:07', '2022-01-21 17:42:07'),
(68, 'hossam ali', 'hossam.ios95@gmail.com', '$2y$10$Wixo/71CVo.LydJasavOz.UyYaOh6BvILhpzrCc1aZD2hTegdBve2', '+201098719059', 'Egypt', 'giza', '11666', '2 set abnkhldon', '11666', 0, 5894, 0, '2022-01-31 14:29:14', '2022-01-31 14:30:17'),
(69, 'Hadeer', 'hadeerdessouki@gmail.com', '$2y$10$ghe6q/0yIR4f8wGFKyOf9eUR3ohPM/7gQ3C8edRumN/z/RFg6M/Ua', '01141267728', NULL, NULL, NULL, NULL, NULL, 0, 9469, 0, '2022-02-12 08:36:32', '2022-02-12 08:36:32'),
(70, 'QuartzDragon', 'dragonquartz728@gmail.com', '$2y$10$lhkuIGGlkp5pOij.uqHJue3ACLsAaczAE8X/D66KDXXHCUYxedLa6', '01010586998', NULL, NULL, NULL, NULL, NULL, 0, 5103, 0, '2022-02-19 11:15:39', '2022-02-19 11:15:39'),
(71, 'Adham Adel', 'adeladham290@gmail.com', '$2y$10$MwGSW2m6QBUazIuA1cWa6uo316rKElfjqsBaO0Uq0jfLwzsmsfhFq', '01012610571', NULL, NULL, NULL, NULL, NULL, 0, 9502, 0, '2022-02-20 01:55:27', '2022-02-20 01:55:27'),
(72, 'Ahmed Mostafa SHAABAN AHMED', '2hmedm0st2f2@Gmail.com', '$2y$10$tqoKxMxG2RWQqDl71iB0T.kzi2CB3TL/wQdCTQLzd2zH2mypQohmO', '01159821664', NULL, NULL, NULL, NULL, NULL, 0, 1767, 0, '2022-03-13 16:09:54', '2022-03-13 16:09:54'),
(73, 'Amira Mohamed', 'amira.m.mohamed2001@gmail.com', '$2y$10$N5sAE6MQDUOJceaRP0vd1eoZLBkTFMb5ebzFrHj1UZS4WFmrJPLau', '01154317083', NULL, NULL, NULL, NULL, NULL, 0, 2540, 0, '2022-03-15 22:06:28', '2022-03-15 22:06:28'),
(74, 'ahmed', 'ah@m.com', '$2y$10$zQA.X5C.zo1MOwUUpezeSeXOeMzFG0sx0G4FTxgHHuwwjiDGF3A9G', '01112548568', 'jkbjkb', 'jkbjkbjkb', 'jkbjkb', 'jkbjkjkbjkbjkbjkbjkb', 'jkbkj', 0, 1843, 0, '2022-03-18 00:59:05', '2022-03-18 00:59:52'),
(75, 'sdklfn', 'm@m.com', '$2y$10$jd0HwTLpFlZpLwGTIbC9f.CZbQrdEqzhWeS4WG5IJA8I/os5ZJL2q', '54654564564', 'nklnkln', 'nklnkln', 'nklnkln', 'klklnklnkln', 'kln', 0, 1663, 0, '2022-03-18 14:43:03', '2022-03-18 14:43:47'),
(76, 'Ahmed Mohamed', 'Ekoelpop55@gmail.com', '$2y$10$DUGdiQsW1p5wJQzMSchv5eoagPvNt4oBJAQX0ThL.i3213ygICPrq', '01010771381', NULL, NULL, NULL, NULL, NULL, 0, 6643, 0, '2022-03-31 21:19:03', '2022-03-31 21:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `image` varchar(225) DEFAULT '0',
  `slug` varchar(150) NOT NULL,
  `is_home` tinyint(4) DEFAULT 0,
  `is_ads` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name_ar`, `name_en`, `image`, `slug`, `is_home`, `is_ads`, `created_at`, `updated_at`) VALUES
(5, 'ِسيشسي شسيشسي', 'collections-1', 'collections/yaP3RYAM7yqFtuww4qfKdl6UVmQG715bl8NQrrPr.jpg', 'syshsy-shsyshsy', 0, 0, '2021-10-23 14:42:12', '2022-05-09 08:48:11'),
(6, 'collections-2', 'collections-2', 'collections/6uw3x7PTolVLza5wJJ8BHLvo9XhENCoENxlubfd2.jpg', 'collections-2', 0, 0, '2021-10-23 14:42:12', '2021-10-27 12:39:12'),
(7, 'collections-3', 'collections-3', 'collections/AqL9yJCUtf79R0wFRVVBA4WGGwdi2MUzCDHkw7zf.jpg', 'collections-3', 0, 0, '2021-10-23 14:42:54', '2021-10-27 12:39:23'),
(8, 'aqsd', 'asd', 'collections/VPIveujlI7ZXXZANzcYJoqCukWMFIVARVUUWNbnO.jpg', 'aqsd', 0, 0, '2021-10-23 15:00:09', '2021-10-23 15:00:09'),
(10, 'Home', 'Home', 'collections/SIAAh1aOZ2tdspmVodHVLeMgiUB0R8gSbfDsFQ48.jpg', 'home', 1, 0, '2021-10-27 09:31:29', '2021-10-27 11:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `collections_products`
--

CREATE TABLE `collections_products` (
  `id` int(11) NOT NULL,
  `collections_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `copone_offers`
--

CREATE TABLE `copone_offers` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `cost` int(11) DEFAULT 0,
  `type` varchar(50) NOT NULL,
  `capacity` int(11) DEFAULT 0,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `credit_and_debit_notes`
--

CREATE TABLE `credit_and_debit_notes` (
  `id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `trader_name` varchar(225) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(200) NOT NULL,
  `title` varchar(225) NOT NULL,
  `body` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daily_restrictions`
--

CREATE TABLE `daily_restrictions` (
  `id` int(11) NOT NULL,
  `bills_id` int(11) NOT NULL DEFAULT 0,
  `trader_id` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `put_to` int(11) DEFAULT NULL,
  `take_from` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_restrictions`
--

INSERT INTO `daily_restrictions` (`id`, `bills_id`, `trader_id`, `type`, `description`, `put_to`, `take_from`, `total`, `created_at`, `updated_at`) VALUES
(24, 14, NULL, 'بيع', 'بيع منتجات لعميل', 0, 0, 0, '2022-01-30 18:39:15', '2022-01-30 18:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `count` int(11) DEFAULT 0,
  `created_by_id` int(11) DEFAULT NULL,
  `created_by_name` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `count`, `created_by_id`, `created_by_name`, `created_at`, `updated_at`) VALUES
(25, 'العمال', 0, 1, 'Admin', '2021-09-07 12:17:35', '2021-09-19 15:15:38'),
(27, 'المخازن', 0, 1, 'Admin', '2021-09-07 12:22:27', '2021-09-19 15:15:25'),
(28, 'المشتريات', 0, 1, 'Admin', '2021-09-07 12:33:35', '2021-09-19 15:15:11'),
(29, 'الماليات', 0, 1, 'Admin', '2021-09-07 12:36:31', '2021-09-19 15:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `staffs_id` int(11) NOT NULL,
  `staffs_name` varchar(225) DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(225) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount`, `staffs_id`, `staffs_name`, `created_by_id`, `created_by_name`, `notes`, `created_at`, `updated_at`) VALUES
(10, 50, 1, 'ahmed', 1, 'Admin', 'نالعتبرعتلارت', '2021-09-20 17:06:49', '2021-09-20 17:06:49'),
(11, 80, 1, 'ahmed', 1, 'Admin', 'نتارتلرت', '2021-09-20 17:07:02', '2021-09-20 17:07:02'),
(12, 50, 4, 'asdasd', 1, 'Admin', 'خعاخعاخ', '2021-09-20 17:07:26', '2021-09-20 17:07:26'),
(13, 50, 1, 'ahmed', 1, 'Admin', 'hgdjfhgfx', '2021-10-04 18:31:26', '2021-10-04 18:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `external_orders`
--

CREATE TABLE `external_orders` (
  `id` int(11) NOT NULL,
  `client_name` varchar(225) NOT NULL,
  `address` text DEFAULT NULL,
  `channel` varchar(225) DEFAULT NULL,
  `phone_1` varchar(225) NOT NULL,
  `phone_2` varchar(225) DEFAULT NULL,
  `order_num` int(11) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `status` char(50) DEFAULT NULL,
  `nots` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `shipping_cost` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_traders`
--

CREATE TABLE `history_traders` (
  `id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `transfer_from` varchar(225) DEFAULT NULL,
  `transfer_to` varchar(225) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `transformType` varchar(225) DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(225) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `holiday` date NOT NULL,
  `discount` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `staffs_id` int(11) NOT NULL,
  `staffs_name` varchar(225) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(225) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday`, `discount`, `description`, `staffs_id`, `staffs_name`, `created_by_id`, `created_by_name`, `created_at`, `updated_at`) VALUES
(3, '2021-09-15', 0, 'اجازة عيد اضحي', 1, 'ahmed', 1, 'Admin', '2021-09-15 08:20:55', '2021-09-15 08:31:01'),
(4, '2021-10-04', 100, 'jytfjgfjgfjgfhdgsfdx jgjygcjytf', 1, 'ahmed', 1, 'Admin', '2021-10-04 18:30:52', '2021-10-04 18:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2021_09_21_143405_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0253e07a-929c-47e6-b3b6-3c5da8afe521', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-14 12:35:13', '2021-11-14 12:35:13'),
('077396e7-6279-4a4b-9b3e-7501302b9f65', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-23 20:43:43', '2021-11-23 20:43:43'),
('1c8120ce-2b41-45fd-868c-79433c96f496', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 02:53:28', '2021-10-31 02:53:28'),
('1e76cb77-6f95-405b-a5b7-5f53419d0cd9', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:39:29', '2021-10-30 23:39:29'),
('1e7da0cf-88d9-47e3-b544-d274914cf98d', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-12-14 17:35:31', '2021-12-14 17:35:31'),
('28a75a05-5e80-4412-86cc-8b2f16e3b563', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-03-18 23:50:21', '2022-03-18 23:50:21'),
('2cb761e1-5b62-4428-88c3-87f140408082', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-03-22 14:31:24', '2022-03-22 14:31:24'),
('35d69143-9206-4416-bbdc-132a23f280b6', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-03-18 01:00:06', '2022-03-18 01:00:06'),
('3cd8ebcf-510e-4519-ab4d-6d692825d0b5', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-13 18:21:57', '2021-11-13 18:21:57'),
('4bb0906d-2901-4709-86cc-1564d7a4bdc3', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-01-31 14:30:27', '2022-01-31 14:30:27'),
('51215d1d-cf37-4685-8da6-3c1e6917b417', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-23 18:16:00', '2021-11-23 18:16:00'),
('55ed220a-8583-4c52-b6fd-f5c7decc2d6c', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-16 13:36:13', '2021-11-16 13:36:13'),
('5eb2a6be-4be3-481f-a7ed-2cf6338a11cc', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:40:10', '2021-10-30 23:40:10'),
('74b36b87-95c2-4e17-afe7-d6f07f7ce470', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-10 20:48:55', '2021-11-10 20:48:55'),
('757ec31f-dfed-411d-8ffb-c97c5408fce7', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-16 19:52:09', '2021-11-16 19:52:09'),
('7b8b0598-dac2-444a-9fad-a5f7643d5210', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-23 18:35:14', '2021-11-23 18:35:14'),
('7dc7698b-9ede-43ef-bba1-177c2c71c852', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 02:27:36', '2021-10-31 02:27:36'),
('87cce1a2-3417-492d-90ec-61274601aefc', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 03:41:20', '2021-10-31 03:41:20'),
('98597d4b-2b98-4565-9270-025ff2f953fc', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-12-04 13:45:53', '2021-12-04 13:45:53'),
('9e63b8de-d537-4a1e-9356-36332447cddf', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:45:16', '2021-10-30 23:45:16'),
('b0b5bcb3-a1dc-4109-8f8f-5fd65220f264', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-04 00:05:12', '2021-11-04 00:05:12'),
('b194a77d-75ac-4e49-aee1-974eaf09939d', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:24:53', '2021-10-30 23:24:53'),
('b7fa7332-0556-4c0f-94a5-740e0d0eb851', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-01-06 19:47:17', '2022-01-06 19:47:17'),
('b9539f37-f730-4834-b9ed-7f195c96d712', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-20 01:55:12', '2021-11-20 01:55:12'),
('bab7d99b-be39-48d6-9af4-39ed4d776374', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-18 19:24:31', '2021-11-18 19:24:31'),
('c0eedceb-979e-4f61-8d5d-b8156cb7e975', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 01:28:34', '2021-10-31 01:28:34'),
('c1924997-42ea-447c-97ee-822346dc3624', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 02:51:37', '2021-10-31 02:51:37'),
('c353d385-4859-4bbc-a4da-9fd13ffc735b', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:27:25', '2021-10-30 23:27:25'),
('c9b9f578-e6d2-43bd-b5c7-504e9f546884', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-04-12 17:39:08', '2022-04-12 17:39:08'),
('c9d2d9a2-50a0-43e2-a73f-2fcfc137a189', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-10 10:46:57', '2021-11-10 10:46:57'),
('d504c3cc-81d5-4cf8-a591-8e7895f3a538', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 01:26:29', '2021-10-31 01:26:29'),
('dd6513ab-b6d4-4f58-b382-7f2bc5e3733e', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-03-05 12:26:50', '2022-03-05 12:26:50'),
('deb2875f-0874-49f3-9f03-8f0471210657', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:27:14', '2021-10-30 23:27:14'),
('e1e2ca5b-1aea-4874-912d-4ecf68119349', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-31 01:30:30', '2021-10-31 01:30:30'),
('ed7e4222-9658-4a3b-bcf4-ecfe3edfbbdf', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-10-30 23:19:37', '2021-10-30 23:19:37'),
('f7b7ba2c-3dfb-43e6-87ea-3974fe670d7f', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2022-01-06 19:52:46', '2022-01-06 19:52:46'),
('f9d13a7d-bfdb-4cf4-9cc4-cb407796192c', 'App\\Notifications\\OrderNotification', 'App\\Models\\User', 1, '{\"order_num\":null}', NULL, '2021-11-20 01:14:39', '2021-11-20 01:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `type_name` varchar(225) NOT NULL,
  `type_value` varchar(225) NOT NULL,
  `value` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_num` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `post_code` varchar(50) DEFAULT NULL,
  `products` longtext NOT NULL,
  `status` varchar(100) NOT NULL,
  `sup_total` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `shipping_cost` int(11) DEFAULT NULL,
  `currency` char(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'حذف', 'staffs', '2021-09-21 12:36:02', '2021-10-04 18:34:23'),
(3, 'بيع', 'staffs', NULL, '2021-10-04 18:34:15'),
(4, 'تعديل', 'staffs', NULL, '2021-10-04 18:34:08'),
(5, 'asdasdsad', 'staffs', '2021-12-30 10:53:02', '2021-12-30 10:53:02'),
(6, 'asdasd', 'staffs', '2021-12-30 10:53:05', '2021-12-30 10:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presnters`
--

CREATE TABLE `presnters` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `desc_ar` longtext DEFAULT NULL,
  `desc_en` longtext DEFAULT NULL,
  `small_desc_en` text DEFAULT NULL,
  `small_desc_ar` text DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `imgs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `vido` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_2` int(11) DEFAULT NULL,
  `copone_offers` int(11) DEFAULT NULL,
  `purchasing_price` int(11) DEFAULT NULL,
  `item_code` varchar(200) DEFAULT NULL,
  `rat` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `weight` longtext DEFAULT NULL,
  `volume` longtext DEFAULT NULL,
  `lsbn` varchar(225) NOT NULL,
  `gain_ratio` int(11) DEFAULT NULL,
  `seo_title` varchar(225) NOT NULL,
  `seo_desc` text NOT NULL,
  `keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`keywords`)),
  `sizes` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_ar`, `name_en`, `desc_ar`, `desc_en`, `small_desc_en`, `small_desc_ar`, `img`, `imgs`, `vido`, `price`, `price_2`, `copone_offers`, `purchasing_price`, `item_code`, `rat`, `created_at`, `updated_at`, `colors`, `weight`, `volume`, `lsbn`, `gain_ratio`, `seo_title`, `seo_desc`, `keywords`, `sizes`) VALUES
(1, 'asdasd', 'asdsadsad', 'asdasd', 'asdasdasd', 'asd', 'asd', 'product/DZgHbgsNNOXtfSmkZBntJrs23dHNaJTuPMNACq6f.jpg', '[\"product\\/hT1H2xeDzftjdHJyFcWQOWqr9JZuCPFe6a2v4yTz.jpg\",\"product\\/PXaRuIoOxkZhpkKN3CiDRQRJ4JSyaAwA4cy2cf9W.jpg\",\"product\\/3potbTMZA6UVmDHLEDLLv97wzfFQQuiIH81Zv8eg.jpg\"]', 'null', 2332, 3333, NULL, 210, NULL, 0, '2022-05-18 05:10:53', '2022-05-18 05:10:53', '[{\"color\":\"#ff0000\",\"img\":\"\",\"name\":\"Red\"}]', '{\"number\":null,\"type\":\"\\u062c\\u0631\\u0627\\u0645\"}', '{\"length\":{\"number\":null,\"type\":\"\\u0633\\u0646\\u062a\\u064a\\u0645\\u062a\\u0631\"},\"width\":{\"number\":null,\"type\":\"\\u0633\\u0646\\u062a\\u064a\\u0645\\u062a\\u0631\"},\"height\":{\"number\":null,\"type\":\"\\u0633\\u0646\\u062a\\u064a\\u0645\\u062a\\u0631\"}}', 'asd', NULL, '0', '0', '0', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `products_commintes`
--

CREATE TABLE `products_commintes` (
  `id` int(11) NOT NULL,
  `reviewBody` longtext NOT NULL,
  `product_id` int(11) NOT NULL,
  `reviewTitle` varchar(225) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_trakers`
--

CREATE TABLE `products_trakers` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `qut` int(11) NOT NULL DEFAULT 0,
  `price` int(11) DEFAULT NULL,
  `bills_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(225) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `products_id` bigint(20) NOT NULL,
  `comment` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `reward` int(11) NOT NULL DEFAULT 0,
  `staffs_id` int(11) NOT NULL,
  `staffs_name` varchar(225) DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_by_name` varchar(225) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `reward`, `staffs_id`, `staffs_name`, `created_by_id`, `created_by_name`, `notes`, `created_at`, `updated_at`) VALUES
(4, 300, 1, 'ahmed', 1, 'Admin', 'asdasdasdasd', '2021-09-11 09:16:06', '2021-09-20 07:10:56'),
(5, 1000, 4, 'asdasd', 1, 'Admin', 'asdasdasdasd', '2021-09-13 10:36:13', '2021-09-20 07:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(5, 'test sdafsdfsdf', 'staffs', NULL, NULL),
(6, 'مندوب', 'staffs', '2021-10-04 18:33:56', '2021-10-04 18:33:56'),
(7, 'asdasdasdasdsad', 'staffs', '2021-12-30 10:52:53', '2021-12-30 10:52:53');

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
(1, 5),
(1, 6),
(3, 5),
(3, 6),
(4, 6),
(5, 6),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `about` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`about`)),
  `img_large` varchar(225) DEFAULT NULL,
  `img_small` varchar(225) DEFAULT NULL,
  `info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `sliders` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price` varchar(150) NOT NULL,
  `books` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `banner` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `about`, `img_large`, `img_small`, `info`, `seo`, `sliders`, `price`, `books`, `banner`, `created_at`, `updated_at`) VALUES
(29, 'http://sweet.build/storage/logo/kGNEn1bV6Z1w7yvvIpoaM06uHEhlCkZy4EHkEm6y.jpg', '{\"text\":\"Design your life\",\"desc\":\"<div style=\\\"text-align: center;\\\"><span style=\\\"background-color: rgb(255, 255, 255); color: rgb(5, 5, 5); font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif;\\\"><b style=\\\"\\\"><font size=\\\"6\\\">Yalla2print<\\/font><\\/b><\\/span><\\/div><div><div style=\\\"text-align: center;\\\"><b style=\\\"color: rgb(5, 5, 5); font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif;\\\"><font size=\\\"4\\\">\\u0623\\u0648\\u0644 \\u0645\\u0648\\u0642\\u0639 \\u0645\\u0635\\u0631\\u064a \\u0645\\u062a\\u062e\\u0635\\u0635 \\u0628\\u064a\\u0642\\u062f\\u0645\\u0644\\u0643 \\u062e\\u062f\\u0645\\u0629 \\u0627\\u0644\\u0637\\u0628\\u0627\\u0639\\u0629 \\u0639\\u0644\\u064a \\u0627\\u0644\\u0645\\u0644\\u0627\\u0628\\u0633 \\u0648 \\u0627\\u0644\\u0647\\u062f\\u0627\\u064a\\u0627 \\u0648 \\u064a\\u0648\\u0635\\u0644\\u0643 \\u062e\\u0644\\u0627\\u0644 3 \\u0627\\u064a\\u0627\\u0645 \\u0639\\u0645\\u0644&nbsp;<\\/font><\\/b><\\/div><div><div style=\\\"text-align: center;\\\"><span style=\\\"color: rgb(5, 5, 5); font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; background-color: rgb(255, 255, 255);\\\"><b style=\\\"\\\"><font size=\\\"4\\\">&nbsp;\\u0647\\u062a\\u0642\\u062f\\u0631 \\u062a\\u0635\\u0646\\u0639 \\u0627\\u0644\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u064a\\u0643 \\u0628\\u0646\\u0641\\u0633\\u0643 \\u0648\\u0641\\u0649 \\u062e\\u0644\\u0627\\u0644 \\u062b\\u0648\\u0627\\u0646\\u0649 \\u0648\\u062f\\u0647 \\u0645\\u0634 \\u0645\\u062c\\u0631\\u062f \\u0643\\u0644\\u0627\\u0645&nbsp;<\\/font><\\/b><\\/span><\\/div><\\/div><\\/div>\",\"btnLabel1\":\"SHOP\",\"btnUrl1\":\"\\/shop\",\"btnLabel2\":\"Custom Design\",\"btnUrl2\":\"\"}', 'https://api.yalla2print.com/storage/img_large/6S07jJDLK04ziux56HVLZhIWU0rVIwMhfLT1jqSb.jpg', 'https://api.yalla2print.com/storage/img_small/sYzw4BKZdSmlNpdyPkYvbfrLI5ZYbNlPbw0wSQLb.jpg', '{\"faceBook\":\"https:\\/\\/www.facebook.com\\/yalla2print\",\"twitter\":\"https:\\/\\/www.instagram.com\\/yalla2print\",\"mail\":\"info@yalla2prin.com\",\"phone\":\"01225555271\",\"address1\":\"\",\"address2\":\"\",\"about\":\"\"}', NULL, '[{\"text\":\"asdasd\",\"img\":\"http:\\/\\/print-shop.build\\/storage\\/slider\\/DuYeFu8fCLQbNtAhUEP7Smj4iP9rbwhEuaXU5gIp.jpg\",\"btnLabel1\":\"SHOP\",\"btnLabel2\":\"Custom Design\",\"btnUrl1\":\"\\/shop\",\"btnUrl2\":\"\",\"img_small\":\"https:\\/\\/api.yalla2print.com\\/storage\\/slider\\/a8H2u4k7BJtZmvZnukKDSi1DCkaJm3llc015IkNG.jpg\",\"img_large\":\"https:\\/\\/api.yalla2print.com\\/storage\\/slider\\/xUNKWRRbh4VrKwQT27BtQ768AiBEpZBdsYAQmBKz.jpg\",\"title\":\"\",\"body\":\"Design your life\"}]', 'price', '[null,null,null]', NULL, '2021-11-16 14:03:06', '2022-05-18 04:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  `job_title` varchar(225) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `salary` int(11) NOT NULL DEFAULT 0,
  `branchs_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `departments_id`, `user_id`, `job_title`, `name`, `email`, `password`, `img`, `phone`, `active`, `permission`, `salary`, `branchs_id`, `created_at`, `updated_at`) VALUES
(1, 25, '3334234234234', 'asdasdasd', 'ahmed', 's@s.com', '$2y$10$T75HNj45Y/YtQQRrOwFeg.OjYtAx5unAlEsKPyzsX8YVOZKhtYXi.', 'seller/JJBIRG6iFo2umW4m80IRopNfkaXIiAf6JXaVRGSP.jpg', '011456', 0, '\"{\\\"Dashboard\\\":{\\\"label\\\":\\\"\\u0644\\u0648\\u062d\\u0647 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\\\",\\\"value\\\":false},\\\"Managers\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u062f\\u064a\\u0631\\u064a\\u0646\\\",\\\"value\\\":false},\\\"Staff\\\":{\\\"label\\\":\\\"\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0639\\u0645\\u0644\\\",\\\"value\\\":false},\\\"Blog\\\":{\\\"label\\\":\\\"Blog\\\",\\\"value\\\":false},\\\"orders\\\":{\\\"label\\\":\\\"\\u0637\\u0627\\u0644\\u0628\\u0627\\u062a\\\",\\\"value\\\":false},\\\"traders_table\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\\",\\\"value\\\":false},\\\"clients_table\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621\\\",\\\"value\\\":false},\\\"Sell_and_Bay\\\":{\\\"label\\\":\\\"\\u0628\\u064a\\u0639 \\u0648\\u0634\\u0631\\u0627\\u0621\\\",\\\"value\\\":true},\\\"Bills\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0641\\u0648\\u0627\\u062a\\u064a\\u0631\\\",\\\"value\\\":false},\\\"dailyRestrictions\\\":{\\\"label\\\":\\\"\\u062d\\u0631\\u0643\\u0629 \\u0627\\u0644\\u062e\\u0632\\u0646\\u0629\\\",\\\"value\\\":false},\\\"Categories\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645\\\",\\\"value\\\":false},\\\"Collections\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u062c\\u0645\\u0648\\u0639\\u0627\\u062a\\\",\\\"value\\\":false},\\\"Products\\\":{\\\"label\\\":\\\"\\u0643\\u062a\\u0628\\\",\\\"value\\\":false},\\\"branchs\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0641\\u0631\\u0648\\u0639\\\",\\\"value\\\":false},\\\"presnters\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u0642\\u062f\\u0645\\u064a\\u0646\\\",\\\"value\\\":false},\\\"publishers\\\":{\\\"label\\\":\\\"\\u062f\\u0648\\u0631 \\u0627\\u0644\\u0646\\u0634\\u0631\\\",\\\"value\\\":false},\\\"translators\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u062d\\u0642\\u0642\\u064a\\u0646\\\",\\\"value\\\":false},\\\"writers\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u0624\\u0644\\u0641\\\",\\\"value\\\":false},\\\"Capital\\\":{\\\"label\\\":\\\"\\u0631\\u0623\\u0633 \\u0627\\u0644\\u0645\\u0627\\u0644\\\",\\\"value\\\":false},\\\"setting\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0623\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a\\\",\\\"value\\\":false},\\\"Notifications\\\":{\\\"label\\\":\\\"\\u0627\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a \\u062f\\u0627\\u0626\\u0646 \\u0648 \\u0645\\u062f\\u064a\\u0646\\\",\\\"value\\\":false},\\\"Assets\\\":{\\\"label\\\":\\\"\\u0623\\u0644\\u0627\\u0635\\u0648\\u0644\\\",\\\"value\\\":false}}\"', 5000, 8, '2021-05-11 12:15:54', '2021-10-09 13:56:16'),
(4, 27, NULL, NULL, 'asdasd', 'as@asd.asd', '$2y$10$A5la1UuBf64XVHZWrXpEZOZSgnoFeaCGWy6lqJpjqiCu1yp/5PoCO', NULL, '234', 0, '\"{\\\"Dashboard\\\":{\\\"label\\\":\\\"\\u0644\\u0648\\u062d\\u0647 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\\\",\\\"value\\\":false},\\\"Managers\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u062f\\u064a\\u0631\\u064a\\u0646\\\",\\\"value\\\":false},\\\"Staff\\\":{\\\"label\\\":\\\"\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0639\\u0645\\u0644\\\",\\\"value\\\":false},\\\"Blog\\\":{\\\"label\\\":\\\"Blog\\\",\\\"value\\\":false},\\\"orders\\\":{\\\"label\\\":\\\"\\u0637\\u0627\\u0644\\u0628\\u0627\\u062a\\\",\\\"value\\\":false},\\\"traders_table\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\\",\\\"value\\\":false},\\\"clients_table\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621\\\",\\\"value\\\":false},\\\"Sell_and_Bay\\\":{\\\"label\\\":\\\"\\u0628\\u064a\\u0639 \\u0648\\u0634\\u0631\\u0627\\u0621\\\",\\\"value\\\":false},\\\"Bills\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0641\\u0648\\u0627\\u062a\\u064a\\u0631\\\",\\\"value\\\":false},\\\"dailyRestrictions\\\":{\\\"label\\\":\\\"\\u062d\\u0631\\u0643\\u0629 \\u0627\\u0644\\u062e\\u0632\\u0646\\u0629\\\",\\\"value\\\":false},\\\"Categories\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645\\\",\\\"value\\\":false},\\\"Collections\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u062c\\u0645\\u0648\\u0639\\u0627\\u062a\\\",\\\"value\\\":false},\\\"Products\\\":{\\\"label\\\":\\\"\\u0643\\u062a\\u0628\\\",\\\"value\\\":false},\\\"branchs\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0641\\u0631\\u0648\\u0639\\\",\\\"value\\\":false},\\\"presnters\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u0642\\u062f\\u0645\\u064a\\u0646\\\",\\\"value\\\":false},\\\"publishers\\\":{\\\"label\\\":\\\"\\u062f\\u0648\\u0631 \\u0627\\u0644\\u0646\\u0634\\u0631\\\",\\\"value\\\":false},\\\"translators\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u062d\\u0642\\u0642\\u064a\\u0646\\\",\\\"value\\\":false},\\\"writers\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u0624\\u0644\\u0641\\\",\\\"value\\\":false},\\\"Capital\\\":{\\\"label\\\":\\\"\\u0631\\u0623\\u0633 \\u0627\\u0644\\u0645\\u0627\\u0644\\\",\\\"value\\\":false},\\\"setting\\\":{\\\"label\\\":\\\"\\u0627\\u0644\\u0623\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a\\\",\\\"value\\\":false}}\"', 4000, 0, '2021-09-07 13:32:53', '2021-09-19 12:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `traders`
--

CREATE TABLE `traders` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(225) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `debit` int(11) NOT NULL DEFAULT 0,
  `creditor` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `translators`
--

CREATE TABLE `translators` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(150) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(225) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `active`, `last_login`, `remember_token`, `email_verified_at`, `token`, `created_at`, `updated_at`) VALUES
(3, 'ahmed', 'a@a.com', '$2y$10$sELulsNiZQ6s3HLDMpicyeeNVvYOsJcwj.qZ13ia0KQcVaL/eoJ6W', 'img/UcTApdZ4zbQXxW1qoTlN8GTCHNf3eokNsTU7qSlj.png', 1, '2022-05-19 08:57:30', NULL, NULL, NULL, '2021-12-18 22:18:50', '2022-05-19 08:57:30'),
(5, 'شسيشسي', 'a@a.comasd', '$2y$10$WPbQpv.rui770h0XIbvJtu.kfLoPwFQ8K6He2rSZppH2SX59L4iAO', NULL, 1, NULL, NULL, NULL, NULL, '2022-05-18 04:28:17', '2022-05-18 04:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `name_en` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attending_leavins`
--
ALTER TABLE `attending_leavins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_commmintes`
--
ALTER TABLE `blog_commmintes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchs_products`
--
ALTER TABLE `branchs_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_products`
--
ALTER TABLE `brand_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_products`
--
ALTER TABLE `cat_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections_products`
--
ALTER TABLE `collections_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copone_offers`
--
ALTER TABLE `copone_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_and_debit_notes`
--
ALTER TABLE `credit_and_debit_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_restrictions`
--
ALTER TABLE `daily_restrictions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `external_orders`
--
ALTER TABLE `external_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_traders`
--
ALTER TABLE `history_traders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presnters`
--
ALTER TABLE `presnters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_commintes`
--
ALTER TABLE `products_commintes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_trakers`
--
ALTER TABLE `products_trakers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traders`
--
ALTER TABLE `traders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translators`
--
ALTER TABLE `translators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attending_leavins`
--
ALTER TABLE `attending_leavins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_commmintes`
--
ALTER TABLE `blog_commmintes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `branchs`
--
ALTER TABLE `branchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `branchs_products`
--
ALTER TABLE `branchs_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_products`
--
ALTER TABLE `brand_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `cat_products`
--
ALTER TABLE `cat_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `collections_products`
--
ALTER TABLE `collections_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copone_offers`
--
ALTER TABLE `copone_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `credit_and_debit_notes`
--
ALTER TABLE `credit_and_debit_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_restrictions`
--
ALTER TABLE `daily_restrictions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `external_orders`
--
ALTER TABLE `external_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_traders`
--
ALTER TABLE `history_traders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presnters`
--
ALTER TABLE `presnters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products_commintes`
--
ALTER TABLE `products_commintes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_trakers`
--
ALTER TABLE `products_trakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `traders`
--
ALTER TABLE `traders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `translators`
--
ALTER TABLE `translators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
