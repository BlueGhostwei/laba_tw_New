-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-02-18 08:46:12
-- 服务器版本： 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laba_tw`
--

-- --------------------------------------------------------

--
-- 表的结构 `acl_resource`
--

DROP TABLE IF EXISTS `acl_resource`;
CREATE TABLE IF NOT EXISTS `acl_resource` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `acl_role`
--

DROP TABLE IF EXISTS `acl_role`;
CREATE TABLE IF NOT EXISTS `acl_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` tinyint(4) NOT NULL,
  `resource` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `acl_role`
--

INSERT INTO `acl_role` (`id`, `role`, `resource`) VALUES
(1, 0, '*');

-- --------------------------------------------------------

--
-- 表的结构 `acl_user`
--

DROP TABLE IF EXISTS `acl_user`;
CREATE TABLE IF NOT EXISTS `acl_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `acl_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `acl_user`
--

INSERT INTO `acl_user` (`id`, `acl_name`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `result_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `action` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_03_08_171953_create_acl_resource_table', 1),
(2, '2016_03_08_172017_create_acl_role_table', 1),
(3, '2016_03_08_172040_create_acl_user_table', 1),
(4, '2016_03_08_185447_create_action_table', 1),
(5, '2016_03_09_005619_create_user_history_table', 1),
(9, '2016_03_09_010752_create_user_table', 2);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_Eail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email_validate` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `user_avatar` char(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公司名称',
  `nickname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `user_phone` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_QQ` int(11) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `lock` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `remarks` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username_unique` (`username`),
  UNIQUE KEY `user_phone` (`user_phone`),
  KEY `user_user_phone_index` (`user_phone`),
  KEY `user_role_index` (`role`),
  KEY `user_lock_index` (`lock`),
  KEY `user_confirm_index` (`confirm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `user_Eail`, `password`, `email_validate`, `user_avatar`, `company_name`, `nickname`, `contact_person`, `gender`, `user_phone`, `user_QQ`, `role`, `lock`, `remember_token`, `confirm`, `created_by`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '13226431320', '1987105819@qq.com', '$2y$10$weu86k2Emcew/OQ7g/IqrORa4uBk3UobIkeBCJZcA2.hRgXJeL2cG', 0, '0b0df715cf558acaae930d223e2b84f5002', '安腾    ', 'Ghost_wei', ' 黄威 ', 1, '13226431320', 1987105819, 3, 0, '4ZytFkcWf4Meid9uTwnHG09C8fwxlrJ209dUL46kYGoOMeSocJrlU4jxqKvJ', 1, 0, NULL, '2017-02-17 20:22:22', '2017-02-17 23:50:07', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_history`
--

DROP TABLE IF EXISTS `user_history`;
CREATE TABLE IF NOT EXISTS `user_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip` int(10) UNSIGNED NOT NULL,
  `user_agent` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
