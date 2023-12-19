-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 08, 2023 at 05:36 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `armenia3`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
CREATE TABLE IF NOT EXISTS `abouts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `name`, `description`, `description2`, `img`, `created_at`, `updated_at`) VALUES
(1, 'About', '<p><strong>This si the about us pageee Short Detauissss</strong></p><p><strong>tyuyty utt&nbsp;</strong></p><h2>jjh jjhjh jh</h2><ul><li>kjkjk</li><li>kjhkjkjk</li><li>kjk</li><li>kjhjkjk</li></ul><figure class=\"table\"><table><tbody><tr><td>jkjhkjjk</td><td>kjkjjhh</td></tr><tr><td>kjk</td><td>kjkh</td></tr><tr><td>kjkjh</td><td>kjkj</td></tr><tr><td>kjk</td><td>kjjjkjk</td></tr></tbody></table></figure>', '<h2>This is the long detaaailsss</h2><ul><li><strong>hghgfhh</strong></li><li><strong>g</strong></li><li><strong>hgf</strong></li><li><strong>hg</strong></li><li><strong>fh</strong></li><li><strong>fghfhfhfhg</strong></li></ul>', '1565704818.jpeg', '2019-08-12 00:25:10', '2019-08-16 10:19:28'),
(2, 'Services', NULL, NULL, NULL, '2019-08-12 00:25:10', '2019-08-12 00:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `blogcats`
--

DROP TABLE IF EXISTS `blogcats`;
CREATE TABLE IF NOT EXISTS `blogcats` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogcats_name_unique` (`name`),
  KEY `blogcats_catid_foreign` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogcats`
--

INSERT INTO `blogcats` (`id`, `catid`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Top Cat1', '2019-07-07 08:22:18', '2019-07-07 08:22:18'),
(2, NULL, 'Top Cat2 BB', '2019-07-07 08:22:31', '2019-07-21 06:34:37'),
(3, 1, 'SubCat1 A', '2019-07-07 08:22:40', '2019-07-07 08:22:40'),
(4, NULL, 'Top Cat33', '2019-07-07 08:23:26', '2019-07-07 08:23:26'),
(5, 2, 'SubCat2 A', '2019-07-07 08:28:08', '2019-07-07 08:28:08'),
(6, 2, 'Subcat2 B', '2019-07-07 08:28:43', '2019-07-07 08:28:43'),
(7, 4, 'SubCAT3 1', '2019-07-07 08:32:07', '2019-07-07 08:32:07'),
(8, 2, 'Sub 3 B2 TO ONEEEE', '2019-07-07 09:43:14', '2019-07-07 09:56:58'),
(9, 1, 'To Threee NOW TOP', '2019-07-07 09:58:42', '2019-07-07 10:16:51'),
(10, 2, 'jhjuiuuiuy', '2019-07-07 10:27:47', '2019-07-07 10:27:47'),
(11, 4, 'bgggg', '2019-07-14 08:50:12', '2019-07-14 08:50:12'),
(12, 2, 'opipopiop', '2019-07-14 08:50:19', '2019-07-14 08:50:19'),
(13, 1, 'oipopipooo', '2019-07-14 08:50:25', '2019-07-14 08:50:25'),
(17, NULL, 'I Become Top', '2019-07-21 06:26:01', '2019-07-21 06:34:54'),
(18, 4, 'oliuoiuo', '2019-07-21 06:26:14', '2019-07-21 06:26:14'),
(19, 17, 'Suib fgggg', '2019-08-04 05:36:09', '2019-08-04 05:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `subid` int(10) UNSIGNED DEFAULT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_catid_foreign` (`catid`),
  KEY `blogs_subid_foreign` (`subid`),
  KEY `blogs_userid_foreign` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `catid`, `subid`, `userid`, `description`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'OnlyTop1', 1, NULL, 1, 'yttrt', '1563629437.jpeg', '2019-07-20 09:30:38', '2019-07-20 09:30:38'),
(2, 'hjhjjjhWith Both', 4, NULL, 1, 'jhjhjjhg', '1563629464.jpeg', '2019-07-20 09:31:04', '2019-07-20 09:31:04'),
(3, 'FOR OIP', 1, NULL, 1, 'hghfg', '1563698493.jpeg', '2019-07-21 04:41:33', '2019-07-21 04:41:33'),
(4, 'OIP2', 2, NULL, 1, 'jhjhhj', '1563698541.jpeg', '2019-07-21 04:42:22', '2019-07-21 04:42:22'),
(5, 'Subcat2 B 6 6 new 1', 2, 6, 1, 'kjkh', '1563698650.jpeg', '2019-07-21 04:44:10', '2019-07-21 04:44:10'),
(6, 'kkio', 4, 7, 1, 'oiiouuoiuoi', '1563698743.jpeg', '2019-07-21 04:45:43', '2019-07-21 04:45:43'),
(7, 'ytyrt', 1, 13, 1, 'tytyr', '', '2019-07-21 04:51:38', '2019-07-21 04:51:38'),
(8, 'uuyiuyi', 4, 7, 1, NULL, '', '2019-07-21 04:51:56', '2019-07-21 04:51:56'),
(9, 'uiiuiui', 4, 7, 1, 'uiuiui', '', '2019-07-21 04:52:09', '2019-07-21 04:52:09'),
(10, 'uiiouiuo 12', 2, 12, 1, NULL, '', '2019-07-21 04:53:53', '2019-07-21 04:53:53'),
(11, 'uiuyiui', 1, 9, 1, NULL, '', '2019-07-21 04:54:41', '2019-07-21 04:54:41'),
(12, 'uyyut', 1, 3, 1, 'uyyt', '1563699306.jpeg', '2019-07-21 04:55:07', '2019-07-21 04:55:07'),
(13, 'tytr', 4, 11, 1, 'yttytyr', '1563699329.jpeg', '2019-07-21 04:55:29', '2019-07-21 04:55:29'),
(14, 'uuyt', 2, 10, 1, 'uyuu', '1563699374.jpeg', '2019-07-21 04:56:15', '2019-07-21 04:56:15'),
(15, 'huyuuy', 2, 8, 1, 'uyuyt', '1563699400.jpeg', '2019-07-21 04:56:40', '2019-07-21 04:56:40'),
(16, 'tyttytyr', 2, 5, 1, NULL, '1563699437.jpeg', '2019-07-21 04:57:18', '2019-07-21 04:57:18'),
(23, 'Update255', 4, 7, 1, 'iui', '1563706161.jpeg', '2019-07-21 05:12:08', '2019-07-21 06:55:48'),
(24, 'ONLY TOP 1', 1, NULL, 1, 'hgfg', '1563703954.jpeg', '2019-07-21 06:12:35', '2019-07-21 06:12:35'),
(25, 'With Sub Nowwww', 4, 11, 1, 'iuuiui', '1563708802.jpeg', '2019-07-21 06:35:26', '2019-07-21 07:34:32'),
(26, 'Editor Blog1', 2, 8, 1, '<h3>hhhhhhhhghg</h3><p>mmmfdff</p><p>fdsfsddsffd</p><p><a href=\"\"><strong>uyutuuu</strong></a></p><p>fdfdsdfsdfdf</p>', '1565795336.jpeg', '2019-08-14 11:08:56', '2019-08-14 11:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Yerevan', '2019-06-16 09:39:25', '2019-06-22 07:47:28'),
(2, 'Echmiadzin', '2019-06-16 10:39:02', '2019-06-16 10:39:02'),
(3, 'City3', '2019-06-16 10:40:40', '2019-06-16 10:40:40'),
(4, 'City4', '2019-06-16 10:40:45', '2019-06-16 10:40:45'),
(5, 'City5', '2019-06-16 10:40:50', '2019-06-16 10:40:50'),
(6, 'City6 upd', '2019-06-16 10:40:58', '2019-06-16 10:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `galleryports`
--

DROP TABLE IF EXISTS `galleryports`;
CREATE TABLE IF NOT EXISTS `galleryports` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portid` int(10) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleryports_portid_foreign` (`portid`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleryports`
--

INSERT INTO `galleryports` (`id`, `name`, `portid`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'new oneee', 10, '1552656776.jpeg', '2019-03-15 09:32:56', '2019-03-15 09:32:56'),
(2, 'uuuttuy', 8, '1552755301.jpeg', '2019-03-15 09:48:44', '2019-03-16 12:55:01'),
(3, 'uuyuut', 11, '1552660319.jpeg', '2019-03-15 10:31:59', '2019-03-15 10:31:59'),
(4, 'UUUYUY NO 233333 -ytyty', 5, '1552661970.jpeg', '2019-03-15 10:59:30', '2019-03-15 12:32:15'),
(7, 'uyuuu upddd', 12, '1552663323.jpeg', '2019-03-15 11:22:03', '2019-03-15 12:31:43'),
(8, 'New 13', 13, '1552663330.jpeg', '2019-03-15 11:22:10', '2019-03-15 12:33:05'),
(9, 'uuiuyuiuy upppppp', 4, '1552668540.jpeg', '2019-03-15 12:35:04', '2019-03-15 12:49:00'),
(10, 'tytyt', 13, '1565795768.jpeg', '2019-03-15 12:50:28', '2019-08-14 11:16:08'),
(11, 'hgghghfh', 13, '1565795758.jpeg', '2019-03-15 12:50:58', '2019-08-14 11:15:59'),
(12, 'hgfgh', 13, '1565795752.jpeg', '2019-03-15 12:51:06', '2019-08-14 11:15:52'),
(13, 'gfhghfg', 12, '1552668676.jpeg', '2019-03-15 12:51:16', '2019-03-15 12:51:16'),
(15, 'uyuyuuuy', 12, '1552668694.gif', '2019-03-15 12:51:34', '2019-03-15 12:51:34'),
(17, 'uyuuty', 12, '1552668728.jpeg', '2019-03-15 12:52:08', '2019-03-15 12:52:08'),
(18, 'ytryytr', 4, '1552668899.png', '2019-03-15 12:54:59', '2019-03-15 12:54:59'),
(22, 'hjhjgh', 1, '1552729033.jpeg', '2019-03-16 05:37:13', '2019-03-16 06:04:14'),
(23, 'hghghg', 11, '1552729089.jpeg', '2019-03-16 05:38:09', '2019-03-16 05:38:09'),
(24, 'New  fdfsd', 10, '1552729150.jpeg', '2019-03-16 05:39:10', '2019-03-16 05:39:10'),
(25, 'uyuutu', 10, '1552729194.jpeg', '2019-03-16 05:39:54', '2019-03-16 05:39:54'),
(26, 'uuuyuyt', 10, '1552729307.jpeg', '2019-03-16 05:41:47', '2019-03-16 05:41:47'),
(27, 'uyuyyut', 10, '1552729576.jpeg', '2019-03-16 05:46:16', '2019-03-16 05:46:16'),
(28, 'yttytty', 12, '1552729701.jpeg', '2019-03-16 05:48:21', '2019-03-16 05:48:21'),
(29, 'uyuyutu', 12, '1552729781.jpeg', '2019-03-16 05:49:41', '2019-03-16 05:49:41'),
(30, 'iuiuiy', 12, '1552730003.jpeg', '2019-03-16 05:53:23', '2019-03-16 05:53:23'),
(31, 'oippio', 12, '1552730048.jpeg', '2019-03-16 05:54:08', '2019-03-16 05:54:08'),
(32, 'iuiuit', 12, '1565795795.jpeg', '2019-03-16 05:54:59', '2019-08-14 11:16:36'),
(33, 'tyytr', 12, '1565795784.jpeg', '2019-03-16 05:56:11', '2019-08-14 11:16:25'),
(34, 'iuiuiuiy', 8, '1552755294.jpeg', '2019-03-16 05:56:31', '2019-03-16 12:54:54'),
(35, 'iuoioui hghg', 23, '1552755501.jpeg', '2019-03-16 12:43:27', '2019-03-16 12:58:21'),
(36, 'iuiuiuyui', 26, '1553260834.jpeg', '2019-03-22 09:20:34', '2019-03-22 09:20:34'),
(37, 'uyttty', 24, '1553263446.jpeg', '2019-03-22 10:04:06', '2019-03-22 10:04:06'),
(38, 'ytrtr', 24, '1553263516.jpeg', '2019-03-22 10:05:01', '2019-03-22 10:05:16'),
(39, 'hujuuytuy', 26, '1553268436.jpeg', '2019-03-22 11:27:16', '2019-03-22 11:27:16'),
(40, 'jutyuty', 26, '1553268537.jpeg', '2019-03-22 11:28:57', '2019-03-22 11:28:57'),
(41, 'uytuyt', 30, '1553948652.jpeg', '2019-03-30 08:24:12', '2019-03-30 08:24:12'),
(42, 'fuyuyttu', 28, '1560007071.jpeg', '2019-06-08 11:17:51', '2019-06-08 11:17:51'),
(43, 'huyuyt 3333', 17, '1560007526.jpeg', '2019-06-08 11:23:25', '2019-06-08 11:25:26'),
(44, 'gffd', 13, '1565795732.jpeg', '2019-08-14 11:15:32', '2019-08-14 11:15:32'),
(45, 'gfgfd', 13, '1565795741.jpeg', '2019-08-14 11:15:41', '2019-08-14 11:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `galleryshops`
--

DROP TABLE IF EXISTS `galleryshops`;
CREATE TABLE IF NOT EXISTS `galleryshops` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopid` int(10) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `galleryshops_name_shopid_unique` (`name`,`shopid`),
  KEY `galleryshops_shopid_foreign` (`shopid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_13_071857_add_membertype_to_users', 2),
(9, '2019_02_23_115504_create_portcats_table', 3),
(10, '2019_02_28_162718_create_portfolios_table', 3),
(11, '2019_03_09_081055_add_contrantto_portfolios', 3),
(12, '2019_03_11_151337_create_galleryports_table', 4),
(13, '2019_03_23_084218_add_customer_portfolio', 5),
(14, '2019_03_30_070620_create_services_table', 6),
(15, '2019_03_30_103628_create_servicesubs_table', 7),
(21, '2019_06_16_123454_create_cities_table', 10),
(23, '2019_06_22_090234_create_tags_table', 11),
(26, '2019_06_23_141820_create_portfoliotags_table', 12),
(27, '2019_04_06_055649_create_blogcats_table', 13),
(28, '2019_04_06_075725_create_blogs_table', 13),
(29, '2019_08_12_130910_create_abouts_table', 14),
(30, '2019_08_16_135419_add_description2_abouts', 15),
(31, '2023_11_25_155845_create_search_histories_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portcats`
--

DROP TABLE IF EXISTS `portcats`;
CREATE TABLE IF NOT EXISTS `portcats` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portcats_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portcats`
--

INSERT INTO `portcats` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nightlife', '2019-03-09 06:26:44', '2019-06-16 09:39:03'),
(2, 'Churches', '2019-03-09 06:26:51', '2019-06-16 09:38:51'),
(5, 'Sports', '2019-03-09 06:31:46', '2019-06-16 09:38:35'),
(7, 'Restaurants', '2019-06-16 09:39:15', '2019-06-16 11:46:28'),
(8, 'Catttt1', '2019-06-16 10:41:25', '2019-06-16 10:41:25'),
(9, 'Cat2ertt', '2019-06-16 10:41:31', '2019-07-07 09:48:01'),
(10, 'hhjhj', '2019-08-16 07:06:37', '2019-08-16 07:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `cityid` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolios_name_unique` (`name`,`catid`) USING BTREE,
  KEY `portfolios_catid_foreign` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `catid`, `cityid`, `description`, `logo`, `url`, `customer`, `created_at`, `updated_at`) VALUES
(1, 'yty', 2, 3, '<p>ytyty</p>', '1567178824.jpeg', NULL, NULL, '2019-03-09 06:27:44', '2019-08-30 11:27:05'),
(4, 'utuuyu', 2, 1, '<p>uyuut</p>', '1567178796.jpeg', NULL, NULL, '2019-03-09 06:28:13', '2019-08-30 11:26:37'),
(5, 'ytyty', 1, 2, '<p><strong>yttyt yttytytt ytyttyt yttyt yttytytt ytyttyt t yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttyt</strong></p><p>&nbsp;</p><p><strong>t yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttytt yttyt yttytytt ytyttyt</strong></p>', '1567178778.jpeg', NULL, NULL, '2019-03-09 06:30:44', '2019-08-30 11:26:19'),
(8, 'ytyty', 5, 5, '<p>ytyt</p>', '1567178722.jpeg', NULL, NULL, '2019-03-09 06:31:57', '2019-08-30 11:25:23'),
(10, 'ytryr', 5, 4, '<p>ytytr</p>', '1567178701.jpeg', 'http://www.web.net', NULL, '2019-03-09 06:32:24', '2019-08-30 11:25:02'),
(11, 'hghfg', 5, 2, '<p>hgffg</p>', '1567178674.jpeg', NULL, NULL, '2019-03-14 07:21:28', '2019-08-30 11:24:35'),
(12, 'kjkjhk', 5, 2, '<p>kjk</p>', '1560006879.jpeg', NULL, NULL, '2019-03-15 10:40:53', '2019-08-30 11:24:11'),
(13, 'Newwww', 2, 5, NULL, '1567178525.jpeg', NULL, NULL, '2019-03-15 10:42:53', '2019-08-30 11:22:06'),
(16, 'Cat 3 portfoilioo', 5, 1, '<p>hghfgh</p>', '1567178500.jpeg', 'http://www.online.com', NULL, '2019-03-16 08:47:19', '2019-08-30 11:21:41'),
(17, 'To cat 333', 5, 2, '<p>trrter</p>', '1567178470.jpeg', NULL, NULL, '2019-03-16 08:53:16', '2019-08-30 11:21:10'),
(18, 'Fountain in Yerevan', 2, 1, '<p>Fountain in Yerevan Republic Square</p>', '1566640056.jpeg', 'https://www.youtube.com/embed/eOMW4A13kdM', NULL, '2019-03-16 08:53:32', '2019-08-24 05:47:37'),
(19, 'uyuyt', 1, 2, '<p>uyuuy</p>', '1552755418.jpeg', NULL, NULL, '2019-03-16 08:53:41', '2019-08-30 11:23:55'),
(20, 'Lake Garab Yerevan', 5, 1, '<p>Lake Grab in Yerevan</p>', '1552755410.jpeg', 'https://www.youtube.com/embed/nCrD6X1UavU', NULL, '2019-03-16 08:53:50', '2019-08-24 05:44:32'),
(21, 'jkjk', 1, 1, NULL, '1552755241.jpeg', NULL, NULL, '2019-03-16 12:34:05', '2019-08-30 11:23:38'),
(22, 'The republic square - Yerevan - Armenia - fountains', 1, 1, '<p>The republic square - Yerevan - Armenia - fountains&nbsp;</p><p>ساحة الجمهورية - يريفان - أرمينيا - نوافير&nbsp;</p><p>Հանրապետության հրապարակ - Երևան - Հայաստան - շատրվաններ</p>', '1552754342.jpeg', 'https://www.youtube.com/embed/xHbCYp3pppw', NULL, '2019-03-16 12:36:50', '2019-08-24 07:31:16'),
(23, 'uytuyuy', 1, 2, '<p>uuuutut</p>', '1552755400.jpeg', NULL, NULL, '2019-03-16 12:37:56', '2019-08-30 11:23:23'),
(24, 'iuiuy', 1, 2, '<p>iui</p>', '1552756789.jpeg', 'https://www.youtube.com/embed/niMNh0hSnuI', NULL, '2019-03-16 13:19:49', '2019-08-24 05:39:55'),
(25, 'uyuyt', 2, 2, '<p>uyuytu</p>', '1552756815.jpeg', NULL, NULL, '2019-03-16 13:20:16', '2019-08-30 11:22:59'),
(26, 'Echmaidzin Agump 1', 5, 2, '<p>lkkjh kjhj</p>', '1566646148.jpeg', 'https://www.youtube.com/embed/lWkp9CRu69Q', NULL, '2019-03-20 12:50:17', '2019-08-24 07:29:08'),
(27, 'jhjhjhhjjg', 5, 2, '<p>jhjghj</p>', '1566646301.jpeg', 'https://www.youtube.com/embed/DTTouCtwAA0', NULL, '2019-03-22 11:19:27', '2019-08-24 07:31:42'),
(28, 'uuyyuu', 2, 2, '<p>uyuyuy</p>', '1553332588.jpeg', 'https://www.youtube.com/embed/DTTouCtwAA0', 'Cust1 upoddd', '2019-03-23 05:16:28', '2019-08-24 05:26:56'),
(29, 'yuuyy no cust', 2, 2, '<p>uyuyu</p>', '1553332622.jpeg', NULL, 'hgghgfg hhhgf', '2019-03-23 05:17:02', '2019-08-30 11:22:34'),
(30, 'uytuty', 5, 4, '<p>uyuy</p>', '1553940392.jpeg', NULL, NULL, '2019-03-30 05:16:00', '2019-08-16 07:07:38'),
(31, 'Yerevan Square 1', 5, 2, '<p>jhjhhj</p>', '1560006585.jpeg', 'https://www.youtube.com/embed/PQ5f4uRly_E', NULL, '2019-06-08 11:09:45', '2019-08-24 05:25:09'),
(32, 'CITY 6 Sorts', 5, 6, 'iuiuu', '1560007053.jpeg', NULL, NULL, '2019-06-08 11:12:03', '2019-06-16 15:26:06'),
(33, 'oiuo', 2, 2, '<p>oiuouiu</p>', '1560007327.jpeg', 'https://www.youtube.com/embed/j3cadbzOBE0', NULL, '2019-06-08 11:22:07', '2019-08-24 05:26:10'),
(34, 'iuiui', 7, 5, 'uiiuui', '1560709120.jpeg', NULL, NULL, '2019-06-16 14:18:40', '2019-06-16 14:18:40'),
(35, 'Water Front 1 yerevan', 7, 4, '<p>uyuyt</p>', '1560709143.jpeg', 'https://www.youtube.com/embed/5hGUN13Knyc', NULL, '2019-06-16 14:19:03', '2019-08-24 07:27:11'),
(36, 'Bannnneeerrrr', 7, 5, 'jkk', '1560709954.png', NULL, NULL, '2019-06-16 14:32:34', '2019-06-16 14:32:34'),
(37, 'Church-Echmadzin111', 2, 2, '<p>uyuyuyt</p>', '1560711678.jpeg', 'https://www.youtube.com/embed/HgMj3mDrs10', NULL, '2019-06-16 15:01:18', '2019-08-24 05:25:40'),
(38, 'Cascade 1', 8, 4, '<p>Cascade</p>', '1566640266.jpeg', 'https://www.youtube.com/embed/6yvHqFXBdwg', NULL, '2019-06-16 15:02:59', '2019-08-24 05:51:06'),
(39, 'iuiui', 2, 4, 'iuiuui', '1560712860.jpeg', NULL, NULL, '2019-06-16 15:21:00', '2019-06-16 15:21:00'),
(40, 'City 5555', 8, 1, '<p>hghg</p>', '1560713054.png', 'https://www.youtube.com/embed/PQ5f4uRly_E', NULL, '2019-06-16 15:24:14', '2019-08-24 05:24:53'),
(41, 'Newwone', 7, 4, 'gffg', '1561273427.jpeg', NULL, NULL, '2019-06-23 03:03:48', '2019-06-23 03:03:48'),
(42, 'Republic square Singing Fountain', 8, 6, NULL, '1561283302.jpeg', 'https://www.youtube.com/embed/eOMW4A13kdM', NULL, '2019-06-23 03:28:01', '2019-08-24 05:49:38'),
(43, 'New3UPDYESoIMG', 8, 5, NULL, '1566038254.jpeg', 'https://www.youtube.com/embed/BH7AJCswhOk', NULL, '2019-06-23 03:28:37', '2019-08-24 05:24:15'),
(44, 'NUM 1updYESimg', 9, 5, NULL, '1566038242.jpeg', NULL, NULL, '2019-06-23 05:51:56', '2019-08-17 06:37:23'),
(45, 'NUM3', 7, 5, NULL, '1566038232.jpeg', NULL, NULL, '2019-06-23 05:54:33', '2019-08-17 06:37:12'),
(54, 'Sports 111', 8, 5, '<p>hghfh</p>', '1566038046.jpeg', 'https://www.youtube.com/embed/dIVSnx6tpvU', NULL, '2019-06-23 10:06:25', '2019-08-24 05:23:40'),
(55, 'Sports 1111', 8, 5, '<p>ttee</p>', '1566038035.jpeg', NULL, NULL, '2019-06-23 10:23:30', '2019-08-17 06:33:56'),
(56, 'NJatureee', 8, 6, NULL, '1566038022.jpeg', NULL, NULL, '2019-06-23 12:20:52', '2019-08-17 06:33:42'),
(57, 'Music333', 8, 5, '<p>ttte</p>', '1566038010.jpeg', 'https://www.youtube.com/embed/kDdOVLEnS3Q', NULL, '2019-06-29 07:54:56', '2019-08-24 05:22:06'),
(58, 'Sportssss333', 8, 4, '<p>hhghhfg</p>', '1566037987.jpeg', NULL, NULL, '2019-06-29 08:21:27', '2019-08-17 06:33:08'),
(60, '4444', 8, 5, '<p>uyuyuy</p>', '1566037893.jpeg', 'https://www.youtube.com/embed/xHbCYp3pppw', NULL, '2019-06-29 09:01:14', '2019-08-24 05:20:00'),
(61, 'NO TAGSS', 8, 5, NULL, '1566037881.jpeg', 'https://www.youtube.com/embed/KJVh0bGbvCU', NULL, '2019-06-29 11:43:04', '2019-08-24 05:19:09'),
(62, 'newdddtaggg', 8, 4, NULL, '1566037873.jpeg', NULL, NULL, '2019-06-29 13:27:49', '2019-08-17 06:31:13'),
(63, 'iu', 7, 4, '<p>uiuiuy</p>', '1566037864.jpeg', 'https://www.youtube.com/embed/wCfJsPp3Nzo', NULL, '2019-06-30 06:15:03', '2019-08-24 05:21:02'),
(64, 'hjjg', 8, 3, NULL, '1566037855.jpeg', NULL, NULL, '2019-06-30 06:17:19', '2019-08-17 06:30:55'),
(65, 'ghhfg', 8, 4, NULL, '1566037841.jpeg', 'https://www.youtube.com/embed/n_gGoFQsbv0', NULL, '2019-06-30 12:05:18', '2019-08-24 05:10:49'),
(66, 'Wiuth tag', 8, 4, '<p>jhgjhh</p>', '1566037828.jpeg', 'https://www.youtube.com/embed/K9Tw8baMPpM', NULL, '2019-07-07 07:59:26', '2021-01-18 03:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `portfoliotags`
--

DROP TABLE IF EXISTS `portfoliotags`;
CREATE TABLE IF NOT EXISTS `portfoliotags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `portfolioid` int(10) UNSIGNED NOT NULL,
  `tagid` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfoliotags`
--

INSERT INTO `portfoliotags` (`id`, `portfolioid`, `tagid`, `created_at`, `updated_at`) VALUES
(28, 59, 23, '2019-06-29 08:32:06', '2019-06-29 08:32:06'),
(29, 59, 21, '2019-06-29 08:32:06', '2019-06-29 08:32:06'),
(30, 59, 19, '2019-06-29 08:32:06', '2019-06-29 08:32:06'),
(159, 67, 25, '2019-08-14 10:16:50', '2019-08-14 10:16:50'),
(160, 67, 20, '2019-08-14 10:16:50', '2019-08-14 10:16:50'),
(161, 67, 17, '2019-08-14 10:16:50', '2019-08-14 10:16:50'),
(169, 64, 26, '2019-08-17 06:30:55', '2019-08-17 06:30:55'),
(170, 64, 6, '2019-08-17 06:30:55', '2019-08-17 06:30:55'),
(171, 64, 15, '2019-08-17 06:30:55', '2019-08-17 06:30:55'),
(172, 64, 19, '2019-08-17 06:30:55', '2019-08-17 06:30:55'),
(173, 62, 1, '2019-08-17 06:31:13', '2019-08-17 06:31:13'),
(174, 62, 25, '2019-08-17 06:31:13', '2019-08-17 06:31:13'),
(175, 62, 21, '2019-08-17 06:31:13', '2019-08-17 06:31:13'),
(179, 58, 17, '2019-08-17 06:33:08', '2019-08-17 06:33:08'),
(180, 58, 11, '2019-08-17 06:33:08', '2019-08-17 06:33:08'),
(181, 58, 8, '2019-08-17 06:33:08', '2019-08-17 06:33:08'),
(187, 56, 25, '2019-08-17 06:33:42', '2019-08-17 06:33:42'),
(188, 56, 21, '2019-08-17 06:33:42', '2019-08-17 06:33:42'),
(189, 56, 20, '2019-08-17 06:33:42', '2019-08-17 06:33:42'),
(190, 56, 8, '2019-08-17 06:33:42', '2019-08-17 06:33:42'),
(191, 55, 26, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(192, 55, 24, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(193, 55, 19, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(194, 55, 18, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(195, 55, 17, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(196, 55, 16, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(197, 55, 14, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(198, 55, 11, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(199, 55, 9, '2019-08-17 06:33:56', '2019-08-17 06:33:56'),
(201, 65, 1, '2019-08-24 05:10:49', '2019-08-24 05:10:49'),
(202, 65, 19, '2019-08-24 05:10:49', '2019-08-24 05:10:49'),
(203, 65, 25, '2019-08-24 05:10:49', '2019-08-24 05:10:49'),
(204, 65, 16, '2019-08-24 05:10:49', '2019-08-24 05:10:49'),
(205, 60, 17, '2019-08-24 05:20:00', '2019-08-24 05:20:00'),
(206, 60, 26, '2019-08-24 05:20:00', '2019-08-24 05:20:00'),
(207, 60, 25, '2019-08-24 05:20:00', '2019-08-24 05:20:00'),
(208, 57, 25, '2019-08-24 05:22:06', '2019-08-24 05:22:06'),
(209, 57, 21, '2019-08-24 05:22:06', '2019-08-24 05:22:06'),
(210, 57, 20, '2019-08-24 05:22:06', '2019-08-24 05:22:06'),
(211, 57, 6, '2019-08-24 05:22:06', '2019-08-24 05:22:06'),
(212, 57, 5, '2019-08-24 05:22:06', '2019-08-24 05:22:06'),
(219, 20, 27, '2019-08-24 05:45:48', '2019-08-24 05:45:48'),
(220, 20, 10, '2019-08-24 05:45:48', '2019-08-24 05:45:48'),
(221, 20, 12, '2019-08-24 05:45:48', '2019-08-24 05:45:48'),
(222, 42, 28, '2019-08-24 05:49:38', '2019-08-24 05:49:38'),
(223, 42, 25, '2019-08-24 05:49:38', '2019-08-24 05:49:38'),
(224, 42, 21, '2019-08-24 05:49:38', '2019-08-24 05:49:38'),
(225, 42, 29, '2019-08-24 05:49:38', '2019-08-24 05:49:38'),
(226, 38, 32, '2019-08-24 05:51:46', '2019-08-24 05:51:46'),
(227, 35, 34, '2019-08-24 07:27:34', '2019-08-24 07:27:34'),
(228, 35, 33, '2019-08-24 07:27:34', '2019-08-24 07:27:34'),
(229, 26, 31, '2019-08-24 07:29:08', '2019-08-24 07:29:08'),
(230, 26, 28, '2019-08-24 07:29:08', '2019-08-24 07:29:08'),
(231, 22, 28, '2019-08-24 07:31:16', '2019-08-24 07:31:16'),
(232, 22, 29, '2019-08-24 07:31:16', '2019-08-24 07:31:16'),
(233, 29, 18, '2019-08-30 11:22:34', '2019-08-30 11:22:34'),
(234, 29, 32, '2019-08-30 11:22:34', '2019-08-30 11:22:34'),
(235, 29, 1, '2019-08-30 11:22:34', '2019-08-30 11:22:34'),
(236, 29, 28, '2019-08-30 11:22:34', '2019-08-30 11:22:34'),
(237, 19, 32, '2019-08-30 11:23:55', '2019-08-30 11:23:55'),
(238, 19, 31, '2019-08-30 11:23:55', '2019-08-30 11:23:55'),
(239, 19, 28, '2019-08-30 11:23:55', '2019-08-30 11:23:55'),
(240, 19, 16, '2019-08-30 11:23:55', '2019-08-30 11:23:55'),
(241, 11, 28, '2019-08-30 11:24:35', '2019-08-30 11:24:35'),
(242, 10, 31, '2019-08-30 11:25:02', '2019-08-30 11:25:02'),
(243, 10, 28, '2019-08-30 11:25:02', '2019-08-30 11:25:02'),
(244, 10, 26, '2019-08-30 11:25:02', '2019-08-30 11:25:02'),
(245, 5, 31, '2019-08-30 11:26:19', '2019-08-30 11:26:19'),
(246, 5, 28, '2019-08-30 11:26:19', '2019-08-30 11:26:19'),
(247, 1, 18, '2019-08-30 11:27:05', '2019-08-30 11:27:05'),
(248, 1, 17, '2019-08-30 11:27:05', '2019-08-30 11:27:05'),
(249, 1, 11, '2019-08-30 11:27:05', '2019-08-30 11:27:05'),
(271, 66, 6, '2021-02-03 06:12:34', '2021-02-03 06:12:34'),
(272, 66, 32, '2021-02-03 06:12:34', '2021-02-03 06:12:34'),
(273, 66, 31, '2021-02-03 06:12:34', '2021-02-03 06:12:34'),
(274, 66, 28, '2021-02-03 06:12:34', '2021-02-03 06:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

DROP TABLE IF EXISTS `search_history`;
CREATE TABLE IF NOT EXISTS `search_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `difficulty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_history`
--

INSERT INTO `search_history` (`id`, `name`, `email`, `amount`, `difficulty`, `type`, `created_at`, `updated_at`) VALUES
(1, 'namer fullname22r', 'rete@wer.ll', 5.00, 'easy', 'multiple', '2023-11-25 12:33:44', '2023-11-25 12:33:44'),
(2, 'namer fullname22r', 'rete@wer.ll', 5.00, 'easy', 'multiple', '2023-11-25 12:35:02', '2023-11-25 12:35:02'),
(3, 'namer fullname22r', 'rete@wer.ll', 5.00, 'easy', 'multiple', '2023-11-25 12:37:53', '2023-11-25 12:37:53'),
(4, 'namer fullname22r', 'rete@wer.ll', 5.00, 'easy', 'multiple', '2023-11-25 12:39:09', '2023-11-25 12:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `des`, `des1`, `des2`, `img`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'service1', 'des1', NULL, 'des2', '1553937609.jpeg', '', '2019-03-30 05:20:09', '2019-03-30 05:20:09'),
(2, 'service3', 'des1', 'des2', 'des3', '1553937926.jpeg', '1553937926.jpeg', '2019-03-30 05:25:26', '2019-03-30 05:25:26'),
(3, 'Only icon', 'yuu', 'uyuy', NULL, '1565877122.jpeg', '1553937959.jpeg', '2019-03-30 05:25:59', '2019-08-15 09:52:02'),
(4, 'onluyy imgg', 'hgfhfg', NULL, NULL, '1553941619.jpeg', '1553941628.jpeg', '2019-03-30 05:27:12', '2019-03-30 06:27:08'),
(5, 'FULL UPDATE', 'jjhjhjh', 'jhjh', 'jhjhjh', '1553938062.jpeg', '1553941607.jpeg', '2019-03-30 05:27:42', '2019-03-30 06:26:47'),
(7, 'Service 5fiveeee', 'uuyt', 'uuty', 'uyuty', '1553941600.jpeg', '1553941600.jpeg', '2019-03-30 05:41:00', '2019-03-30 07:31:07'),
(8, 'Serviceeee4444', 'uiuyiu', NULL, NULL, '1565713997.jpeg', '1565714008.jpeg', '2019-03-30 05:41:17', '2019-08-13 12:33:29'),
(9, 'ServiceeeAAA', 'iuiui', 'iuiu', NULL, '1553941567.jpeg', '1553941559.jpeg', '2019-03-30 05:41:24', '2019-03-30 07:30:44'),
(10, '878768', 'uiui', 'iuiuyi', 'iuiyi', '1553959111.jpeg', '1553959111.jpeg', '2019-03-30 11:18:31', '2019-03-30 11:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `servicesubs`
--

DROP TABLE IF EXISTS `servicesubs`;
CREATE TABLE IF NOT EXISTS `servicesubs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servid` int(10) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `servicesubs_name_servid_unique` (`name`,`servid`),
  KEY `servicesubs_servid_foreign` (`servid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servicesubs`
--

INSERT INTO `servicesubs` (`id`, `name`, `servid`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'sub sect111', 7, '1553945482.jpeg', '2019-03-30 07:31:22', '2019-03-30 07:31:22'),
(2, 'tytytr', 8, '1553946519.jpeg', '2019-03-30 07:48:39', '2019-03-30 07:48:39'),
(3, 'uyyuytu', 7, '1553946542.jpeg', '2019-03-30 07:49:02', '2019-03-30 07:49:02'),
(4, 'uytutuyt', 9, '1553948291.jpeg', '2019-03-30 08:18:11', '2019-03-30 08:18:11'),
(5, 'uiuiyuuuuuuuu_999', 5, '1553959062.jpeg', '2019-03-30 08:18:32', '2019-03-30 11:17:42'),
(6, 'uytutyuy', 8, '1553948341.jpeg', '2019-03-30 08:19:01', '2019-03-30 08:19:01'),
(7, 'uytutyu', 7, '1553948352.jpeg', '2019-03-30 08:19:12', '2019-03-30 08:19:12'),
(8, 'uytuuytu', 4, '1553948365.jpeg', '2019-03-30 08:19:25', '2019-03-30 08:19:25'),
(9, 'uiuiuyi', 4, '1553948671.jpeg', '2019-03-30 08:24:31', '2019-03-30 08:24:31'),
(10, 'yttrr', 3, '1553949744.jpeg', '2019-03-30 08:42:24', '2019-03-30 08:42:24'),
(11, 'uuuyuut', 8, '1553959083.jpeg', '2019-03-30 11:18:03', '2019-03-30 11:18:03'),
(12, 'uuyut', 8, '1553959089.jpeg', '2019-03-30 11:18:09', '2019-03-30 11:18:09'),
(13, 'uytuu', 8, '1553959097.jpeg', '2019-03-30 11:18:17', '2019-03-30 11:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `shopcats`
--

DROP TABLE IF EXISTS `shopcats`;
CREATE TABLE IF NOT EXISTS `shopcats` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shopcats_name_unique` (`name`),
  KEY `shopcats_catid_foreign` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopcats`
--

INSERT INTO `shopcats` (`id`, `catid`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'TopCat1', '2019-09-21 06:15:52', '2019-09-21 06:15:52'),
(2, 1, 'Sub Cat1', '2019-09-21 06:24:19', '2019-09-21 06:24:19'),
(3, 1, 'Sub Vcat 2', '2019-09-21 06:24:41', '2019-09-21 06:24:41'),
(4, NULL, 'Sup Cat2222', '2019-09-21 06:24:49', '2019-09-21 06:24:49'),
(5, 4, 'SUB For B Cat 1', '2019-09-21 06:25:12', '2019-09-21 06:25:12'),
(6, 4, '1111', '2019-09-21 06:26:44', '2019-09-21 06:26:44'),
(7, NULL, 'num 3upd', '2019-09-21 06:27:17', '2019-09-21 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `shopers`
--

DROP TABLE IF EXISTS `shopers`;
CREATE TABLE IF NOT EXISTS `shopers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `subid` int(10) UNSIGNED DEFAULT NULL,
  `prix` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shopers_catid_foreign` (`catid`),
  KEY `shopers_subid_foreign` (`subid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopers`
--

INSERT INTO `shopers` (`id`, `name`, `catid`, `subid`, `prix`, `description`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'utyut', 4, 6, 78, '<p>iuiuiiu</p>', '1569066085.jpeg', '2019-09-21 07:41:26', '2019-09-21 07:41:26'),
(2, 'oiiouuio', 4, 6, 666666, '<p>uyutuy</p>', '1569152669.jpeg', '2019-09-22 07:44:30', '2019-09-22 07:44:30'),
(3, 'num3', 4, 6, 7, '<p>utyuuyt</p>', '1569152777.jpeg', '2019-09-22 07:46:18', '2019-09-22 07:46:18'),
(4, 'num4', 7, NULL, 9, '<p>iiuiyyi</p>', '', '2019-09-22 07:46:37', '2019-09-22 07:46:37'),
(6, 'Item 888 upddd', 4, 5, 11, '<p>hghf kjkh</p>', '1569154548.jpeg', '2019-09-22 07:56:57', '2019-09-22 10:20:23'),
(7, 'Updated 1', 4, 5, 45, '<p>uiiuiu hgfhhi</p>', '1569154585.jpeg', '2019-09-22 08:01:55', '2019-09-22 08:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Churches', '2019-06-22 07:43:32', '2019-06-23 02:28:01'),
(3, 'Yerevan Republic Square', '2019-06-22 07:48:05', '2019-06-22 07:48:05'),
(4, 'Sea', '2019-06-23 03:19:52', '2019-06-23 06:25:22'),
(5, 'Nightlife', '2019-06-23 06:24:22', '2019-06-23 06:25:07'),
(6, 'Pubs', '2019-06-23 06:24:31', '2019-06-23 06:24:31'),
(7, 'Restaurants', '2019-06-23 06:24:39', '2019-06-23 06:24:39'),
(8, 'Nature', '2019-06-23 06:24:45', '2019-06-23 06:24:45'),
(9, 'SporTs', '2019-06-23 06:31:20', '2019-06-29 10:15:03'),
(10, 'lakes', '2019-06-23 06:31:29', '2019-08-24 05:42:54'),
(11, 'Football', '2019-06-23 06:31:36', '2019-06-23 06:31:36'),
(12, 'River', '2019-06-23 06:31:42', '2019-06-23 06:31:42'),
(13, 'Swim', '2019-06-23 06:31:49', '2019-06-23 06:31:49'),
(14, 'Soccer', '2019-06-23 06:31:54', '2019-06-23 06:31:54'),
(15, 'Play', '2019-06-23 06:32:01', '2019-06-23 06:32:01'),
(16, 'Game', '2019-06-23 06:32:06', '2019-06-23 06:32:06'),
(17, 'Basket----', '2019-06-23 06:32:12', '2019-06-29 10:15:23'),
(18, 'Basket - Ball', '2019-06-23 06:32:18', '2019-06-29 10:15:12'),
(19, 'Hockey', '2019-06-23 06:32:27', '2019-06-23 06:32:27'),
(20, 'Songs', '2019-06-23 06:32:32', '2019-06-23 06:32:32'),
(21, 'Music', '2019-06-23 06:32:37', '2019-06-23 06:32:37'),
(23, 'Squash', '2019-06-23 06:34:07', '2019-06-23 06:34:07'),
(24, 'Volleyball', '2019-06-23 06:34:15', '2019-06-23 06:34:15'),
(25, 'melody', '2019-06-23 06:34:23', '2019-06-23 06:34:23'),
(26, 'Handball', '2019-06-23 06:34:33', '2019-06-23 06:34:33'),
(27, 'Lake', '2019-08-24 05:43:15', '2019-08-24 05:43:15'),
(28, 'Fountain', '2019-08-24 05:47:55', '2019-08-24 05:47:55'),
(29, 'Republic Square Yerevan', '2019-08-24 05:48:10', '2019-08-24 05:48:10'),
(30, 'Square', '2019-08-24 05:48:17', '2019-08-24 05:48:17'),
(31, 'Echmiadzin Square', '2019-08-24 05:48:28', '2019-08-24 05:48:28'),
(32, 'Cascade', '2019-08-24 05:51:24', '2019-08-24 05:51:24'),
(33, 'Water Front', '2019-08-24 07:26:40', '2019-08-24 07:26:40'),
(34, 'Water', '2019-08-24 07:26:50', '2019-08-24 07:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membertype` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `membertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$B.xi98amIjsPdyxMeEyM5uHAaSABr2y/9kM28x2Hao3iLWun23ADS', 'admin', NULL, '2019-02-20 10:06:27', '2019-03-24 09:44:32'),
(2, 'userte lavelooo123', 'user@user.com', NULL, '$2y$10$.bJazbEptMKATYuP24PQDOfzWqgPAN5flBhqQgma.U18U7dSQ3/b.', 'user', NULL, '2019-02-20 10:08:04', '2019-03-24 09:52:58'),
(4, 'touserrr', 'uyuy@www.com', NULL, '$2y$10$GwhYm7jkObMplcyguEaCDeGiTWwM.7am6/jqowyXQng5HQtRxvH.O', 'user', NULL, '2019-02-20 15:36:29', '2019-03-24 09:52:25'),
(8, 'admin2', 'admin2@admin.com', NULL, '$2y$10$O7CcR.xHB1lKPlUAUhwxEeSfVU4DJMTSi0BLnKb3YdRm9eLzOp6/m', 'admin', NULL, '2019-02-23 11:34:57', '2019-02-23 11:34:57'),
(10, 'admin3', 'admin3@admin.com', NULL, '$2y$10$CXJBxHqGPcSoqX6CSpk6BucBK.bszDtx2iWjjiLFnkV1u1gtjLuSu', 'admin', NULL, '2019-03-24 06:21:25', '2019-03-24 06:21:25'),
(11, 'iuiuiuy', 'uiuii@wer.ll', NULL, '$2y$10$11AcFY/.SpFTN3/ryO0Rf.WNflssrIMgq89JZPpciMDN09AFmwO7.', 'admin', NULL, '2019-03-24 09:54:17', '2019-03-24 09:54:17'),
(13, 'admin4', 'admin4@admin.com', NULL, '$2y$10$XOl4gC5QgxIHioW4A5A9.u/XRRQSgQ8nN5iMeMRlCClHfIVXLnCEW', 'admin', NULL, '2019-03-30 03:19:41', '2019-03-30 03:19:41');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogcats`
--
ALTER TABLE `blogcats`
  ADD CONSTRAINT `blogcats_catid_foreign` FOREIGN KEY (`catid`) REFERENCES `blogcats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_catid_foreign` FOREIGN KEY (`catid`) REFERENCES `blogcats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_subid_foreign` FOREIGN KEY (`subid`) REFERENCES `blogcats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleryports`
--
ALTER TABLE `galleryports`
  ADD CONSTRAINT `galleryports_portid_foreign` FOREIGN KEY (`portid`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleryshops`
--
ALTER TABLE `galleryshops`
  ADD CONSTRAINT `galleryshops_shopid_foreign` FOREIGN KEY (`shopid`) REFERENCES `shopers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_catid_foreign` FOREIGN KEY (`catid`) REFERENCES `portcats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `servicesubs`
--
ALTER TABLE `servicesubs`
  ADD CONSTRAINT `servicesubs_servid_foreign` FOREIGN KEY (`servid`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shopcats`
--
ALTER TABLE `shopcats`
  ADD CONSTRAINT `shopcats_catid_foreign` FOREIGN KEY (`catid`) REFERENCES `shopcats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shopers`
--
ALTER TABLE `shopers`
  ADD CONSTRAINT `shopers_catid_foreign` FOREIGN KEY (`catid`) REFERENCES `shopcats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopers_subid_foreign` FOREIGN KEY (`subid`) REFERENCES `shopcats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
