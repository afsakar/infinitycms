-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 12 Ara 2020, 21:44:57
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `codeigniter`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `eventDate` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `eventTime` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses_images`
--

DROP TABLE IF EXISTS `courses_images`;
CREATE TABLE IF NOT EXISTS `courses_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courses_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_settings`
--

DROP TABLE IF EXISTS `email_settings`;
CREATE TABLE IF NOT EXISTS `email_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `host` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `port` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `from` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `to` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `user_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `email_settings`
--

INSERT INTO `email_settings` (`id`, `protocol`, `host`, `port`, `user`, `password`, `from`, `to`, `isActive`, `user_name`) VALUES
(1, 'smtp', 'ssl://smtp.gmail.com', '465', 'afsakarr@gmail.com', 'xhpooilmytqzfony', 'afsakarr@gmail.com', 'afsakarr@gmail.com', 1, 'Infinity CMS');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gallery_type` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `folder_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT '0',
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `galleries`
--

INSERT INTO `galleries` (`id`, `url`, `title`, `gallery_type`, `folder_name`, `rank`, `seo`, `isActive`, `createdAt`) VALUES
(3, 'videolar', 'Videolar', 'video', 'videolar', 2, '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-09 22:06:09'),
(1, 'dosyalar', 'Dosyalar', 'file', 'dosyalar', 0, '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-09 22:05:54'),
(2, 'resimler', 'Resimler', 'image', 'resimler', 1, '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 0, '2020-12-10 17:20:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galleries_files`
--

DROP TABLE IF EXISTS `galleries_files`;
CREATE TABLE IF NOT EXISTS `galleries_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `gallery_type` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `news_type` enum('image','video') COLLATE utf8_turkish_ci NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news_images`
--

DROP TABLE IF EXISTS `news_images`;
CREATE TABLE IF NOT EXISTS `news_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `popups`
--

DROP TABLE IF EXISTS `popups`;
CREATE TABLE IF NOT EXISTS `popups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projects_category`
--

DROP TABLE IF EXISTS `projects_category`;
CREATE TABLE IF NOT EXISTS `projects_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `projects_category`
--

INSERT INTO `projects_category` (`id`, `category_name`, `isActive`, `createdAt`) VALUES
(1, 'Grafik Tasarım', 1, '2020-12-12 22:41:03'),
(2, 'Web Tasarım', 1, '2020-12-12 22:48:40'),
(3, 'Web Programlama', 1, '2020-12-12 23:04:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `project_images`
--

DROP TABLE IF EXISTS `project_images`;
CREATE TABLE IF NOT EXISTS `project_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isCover` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `references`
--

DROP TABLE IF EXISTS `references`;
CREATE TABLE IF NOT EXISTS `references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `references_images`
--

DROP TABLE IF EXISTS `references_images`;
CREATE TABLE IF NOT EXISTS `references_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `references_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`) VALUES
(1, '72066settings_view.png', '15361settings_view.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `allowButton` tinyint(4) NOT NULL,
  `buttonUrl` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `buttonText` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(4) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `user_name`, `img_url`, `full_name`, `user_type`, `email`, `password`, `isActive`, `createdAt`) VALUES
(1, 'afsakar', 'user_1.png', 'Azad Furkan ŞAKAR', 'superadmin', 'afsakarr@gmail.com', 'b5c60e2480c6a1646eeaa06388f50b10', 1, '2020-12-10 19:28:56'),
(2, 'admin', '25013users_view.png', 'Admin', 'admin', 'rank-wc@hotmail.com', 'b5c60e2480c6a1646eeaa06388f50b10', 1, '2020-12-10 22:59:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
