-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 29 Ara 2020, 18:05:27
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `brands`
--

INSERT INTO `brands` (`id`, `title`, `createdAt`, `img_url`, `isActive`, `rank`) VALUES
(1, 'Marka-1', '2020-12-23 22:59:41', '99864brands_view.png', 1, 0),
(2, 'Marka-2', '2020-12-23 22:59:48', '36314brands_view.png', 1, 1),
(3, 'Marka-3', '2020-12-23 22:59:54', '76533brands_view.png', 1, 2),
(4, 'Marka-4', '2020-12-23 23:00:01', '27744brands_view.png', 1, 3),
(5, 'Marka-5', '2020-12-23 23:00:09', '97106brands_view.png', 1, 4),
(6, 'Marka-6', '2020-12-23 23:00:16', '74944brands_view.png', 1, 5),
(7, 'Marka-7', '2020-12-23 23:00:38', '63371brands_view.png', 1, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `content` longtext COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `name`, `email`, `content`, `isActive`, `createdAt`, `news_id`) VALUES
(1, 1, 'Azad Furkan ŞAKAR', 'afsakarr@gmail.com', 'Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec.', 1, '2020-12-24 20:11:18', 1),
(2, 0, 'Fletcher Burger', 'rank-wc@hotmail.com', 'Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec.', 1, '2020-12-22 20:11:18', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `message` longtext COLLATE utf8_turkish_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isRead` tinyint(4) NOT NULL DEFAULT '0',
  `readDate` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `readUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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
  `link` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`id`, `url`, `title`, `description`, `img_url`, `eventDate`, `eventTime`, `link`, `location`, `seo`, `isActive`, `createdAt`, `rank`) VALUES
(1, 'etkinlik-1', 'Etkinlik 1', '&lt;h3 style=&quot;margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;The standard Lorem Ipsum passage, used since the 1500s&lt;/h3&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/p&gt;', '51508courses_view.jpg', '31/12/2020', '18:25', 'http://www.google.com', 'Ankara/Türkiye', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-16 14:54:27', 1),
(2, 'etkinlik-2', 'Etkinlik 2', '&lt;h3 style=&quot;margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;The standard Lorem Ipsum passage, used since the 1500s&lt;/h3&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/p&gt;', '97763courses_view.jpg', '29/12/2020', '16:43', '', 'İstanbul/Türkiye', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-16 14:55:07', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `courses_images`
--

INSERT INTO `courses_images` (`id`, `courses_id`, `image_url`, `isActive`, `createdAt`, `rank`) VALUES
(1, 1, '58132courses_view.jpg', 1, '2020-12-16 14:54:37', 1),
(2, 1, '23428courses_view.jpg', 1, '2020-12-16 14:54:38', 0),
(3, 2, '24717courses_view.jpg', 1, '2020-12-16 15:33:06', 0),
(4, 2, '57425courses_view.jpg', 1, '2020-12-16 15:33:06', 0);

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
(2, 'resimler', 'Resimler', 'image', 'resimler', 1, '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-10 17:20:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galleries_files`
--

DROP TABLE IF EXISTS `galleries_files`;
CREATE TABLE IF NOT EXISTS `galleries_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `video_cover` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `gallery_type` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `content` longtext COLLATE utf8_turkish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isSubmenu` tinyint(4) NOT NULL DEFAULT '0',
  `isMain` tinyint(4) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isFooter` tinyint(4) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `menu`
--

INSERT INTO `menu` (`id`, `title`, `content`, `url`, `seo`, `img_url`, `isSubmenu`, `isMain`, `isActive`, `isFooter`, `rank`) VALUES
(7, 'İletişim', '', 'contact', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 0, 1, 1, 1, 9),
(2, 'Projeler', '', 'projects', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '74336menu_view.jpg', 0, 1, 1, 0, 1),
(3, 'Haberler', '', 'news', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 0, 1, 1, 0, 2),
(5, 'Referanslar', '', 'references', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 0, 1, 1, 0, 3),
(6, 'Galeriler', '', 'galleries', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 12, 0, 1, 0, 5),
(11, 'Etkinlikler', '', 'courses', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 0, 1, 1, 0, 7),
(12, 'Sayfalar', '', 'pages', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 0, 1, 1, 0, 8),
(13, 'Çerez Politikası', '&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Çerez Politikamız, Gizlilik Politikamızın bir parçasını oluşturur.&amp;nbsp;&lt;em style=&quot;margin: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;(Gizlilik Politikamız yazan yere kendi gizlilik politikanızın linkini vermelisiniz.)&lt;/em&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Çerez (Cookie) Nedir?&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Günümüzde neredeyse her web sitesi çerez kullanmaktadır. Size daha iyi, hızlı ve güvenli bir deneyim sağlamak için, çoğu internet sitesi gibi biz de çerezler kullanıyoruz. Çerez, bir web sitesini ziyaret ettiğinizde cihazınıza (örneğin; bilgisayar veya cep telefonu) depolanan küçük bir metin dosyasıdır. Çerezler, bir web sitesini ilk ziyaretiniz sırasında tarayıcınız aracılığıyla cihazınıza depolanabilirler. Aynı siteyi aynı cihazla tekrar ziyaret ettiğinizde tarayıcınız cihazınızda site adına kayıtlı bir çerez olup olmadığını kontrol eder. Eğer kayıt var ise, kaydın içindeki veriyi ziyaret etmekte olduğunuz web sitesine iletir. Bu sayede web sitesi, sizin siteyi daha önce ziyaret ettiğinizi anlar ve size iletilecek içeriği de ona göre tayin eder.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Çerezler Neden Kullanılır?&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Bazı çerezler, daha önceki ziyaretlerinizde kullandığınız tercihlerin web sitesi tarafından hatırlanmasını sağlayarak, sonraki ziyaretlerinizin çok daha kullanıcı dostu ve kişiselleştirilmiş bir deneyim sunmasını sağlar.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Ayrıca, web sitesinde bulunan üçüncü taraflara ait linkler, bu üçüncü taraflara ait gizlilik politikalarına tabi olmakla birlikte, gizlilik uygulamalarına ait sorumluluk ornekalanadi.com’a ait olmamaktadır ve bu bağlamda ilgili link kapsamındaki site ziyaret edildiğinde siteye ait gizlilik politikasının okunması önerilmektedir.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Çerez Türleri&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Ana kullanım amacı kullanıcılara kolaylık sağlamak olan çerezler, temel olarak 4 ana grupta toplanmaktadır:&lt;/p&gt;&lt;ul style=&quot;margin-bottom: 24px; margin-left: 25px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style: inside disc; position: relative; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px 0px 8px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Oturum Çerezleri:&lt;/span&gt;&amp;nbsp;Internet sayfaları arasında bilgi taşınması ve kullanıcı tarafından girilen bilgilerin sistemsel olarak hatırlanması gibi çeşitli özelliklerden faydalanmaya olanak sağlayan çerezlerdir ve internet sitesine ait fonksiyonların düzgün bir şekilde işleyebilmesi için gereklidir.&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px 0px 8px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Performans Çerezleri:&lt;/span&gt;&amp;nbsp;Sayfaların ziyaret edilme frekansı, olası hata iletileri, kullanıcıların ilgili sayfada harcadıkları toplam zaman ile birlikte siteyi kullanım desenleri konularında bilgi toplayan çerezlerdir ve internet sitesinin performansını arttırma amacıyla kullanılmaktadır.&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px 0px 8px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Fonksiyonel Çerezler:&lt;/span&gt;&amp;nbsp;Kullanıcıya kolaylık sağlanması amacıyla önceden seçili olan seçeneklerin hatırlatılmasını sağlayan çerezlerdir ve internet sitesi kapsamında kullanıcılara gelişmiş Internet özellikleri sağlanmasını hedeflemektedir.&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Reklam Ve Üçüncü Taraf Çerezleri:&lt;/span&gt;&amp;nbsp;Üçüncü parti tedarikçilere ait çerezlerdir ve internet sitesindeki bazı fonksiyonların kullanımına ve reklam takibinin yapılmasına olanak sağlamaktadır.&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Çerezlerin Kullanım Amaçları&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;ornekalanadi.com tarafından kullanılmakta olan çerezlere ait kullanım amaçları aşağıdaki gibidir:&lt;/p&gt;&lt;ul style=&quot;margin-bottom: 24px; margin-left: 25px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style: inside disc; position: relative; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px 0px 8px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Güvenlik amaçlı kullanımlar:&lt;/span&gt;&amp;nbsp; ornekalanadi.com, sistemlerinin idaresi ve güvenliğinin sağlanması amacıyla, bu sitedeki fonksiyonlardan yararlanmayı sağlayan veyahut düzensiz davranışları tespit eden çerezler kullanabilmektedir.&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px 0px 8px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;İşlevselliğe yönelik kullanımlar:&lt;/span&gt;&amp;nbsp; ornekalanadi.com, sistemlerinin kullanımını kolaylaştırmak ve kullanıcı özelinde kullanım özellikleri sağlamak amacıyla, kullanıcıların bilgilerini ve geçmiş seçimlerini hatırlatan çerezler kullanabilmektedir.&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px 0px 8px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Performansa yönelik kullanımlar:&lt;/span&gt;&amp;nbsp; ornekalanadi.com, sistemlerinin performansının artırılması ve ölçülmesi amacıyla, gönderilen iletilerle olan etkileşimi ve kullanıcı davranışlarını değerlendiren ve analiz eden çerezler kullanabilmektedir.&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; list-style-type: disc; list-style-position: inside; position: relative;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Reklam amaçlı kullanımlar:&lt;/span&gt;&amp;nbsp; ornekalanadi.com, kendine veya üçüncü taraflara ait sistemlerin üzerinden kullanıcıların ilgi alanları kapsamında reklam ve benzeri içeriklerin iletilmesi amacıyla, bu reklamların etkinliğini ölçen veya tıklanma durumunu analiz eden çerezler kullanabilmektedir.&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Reklam Amaçlı Çerez Kullanımımız&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;ornekalanadi.com, Google Adsense reklam sistemi kullanmaktadır. Bu sistem Google tarafından İçerik için AdSense reklamlarının görüntülendiği yayıncı web sitelerinde sunulan reklamlarda kullanalan&amp;nbsp;&lt;a rel=&quot;noreferrer noopener&quot; href=&quot;http://www.doubleclick.com/privacy/faq.aspx&quot; target=&quot;_blank&quot; style=&quot;margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; outline-style: initial; outline-width: 0px; cursor: pointer; color: rgb(102, 53, 53); transition: all 300ms ease 0s; word-break: break-word;&quot;&gt;DoubleClick DART&lt;/a&gt;&amp;nbsp;çerezi içerir.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Üçüncü taraf satıcı olarak Google, sitemizde reklam yayınlamak için çerezlerden yararlanır. Bu çerezlerini kullanarak kullanıcılarınıza, sitenize ve İnternet’teki diğer sitelere yaptıkları ziyaretlere dayalı reklamlar sunar.&amp;nbsp;&lt;a rel=&quot;noreferrer noopener&quot; href=&quot;http://www.google.com/privacy_ads.html&quot; target=&quot;_blank&quot; style=&quot;margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; outline-style: initial; outline-width: 0px; cursor: pointer; color: rgb(102, 53, 53); transition: all 300ms ease 0s; word-break: break-word;&quot;&gt;Google reklam ve içerik ağı gizlilik politikasını&lt;/a&gt;&amp;nbsp;ziyaret ederek DART çerezinin kullanılmasını engelleyebilirsiniz.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Google Web sitemizi ziyaret ettiği zamanlarda reklam hizmeti vermek için üçüncü taraf reklam şirketlerini kullanmaktadır. Söz konusu şirketler, bu sitelere ve diğer web sitelerine yaptığınız ziyaretlerden elde ettikleri (adınız, adresiniz, e-posta adresiniz veya telefon numaranız dışındaki) bilgileri ilginizi çekecek ürün ve hizmetlerin reklamını size göstermek için kullanabilir. Bu uygulama hakkında bilgi edinmek için ve söz konusu bilgilerin bu şirketler tarafından kullanılmasını engellemek üzere seçeneklerinizin neler olduğunu öğrenmek ve daha fazla bilgi için&amp;nbsp;&lt;a rel=&quot;noreferrer noopener&quot; href=&quot;http://www.networkadvertising.org/sites/default/files/imce/principles.pdf&quot; target=&quot;_blank&quot; style=&quot;margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; outline-style: initial; outline-width: 0px; cursor: pointer; color: rgb(102, 53, 53); transition: all 300ms ease 0s; word-break: break-word;&quot;&gt;NAI Self-Regulatory principles for publishers (PDF)&lt;/a&gt;&amp;nbsp;belgesinin A Eki’nden yararlanabilirsiniz.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;&lt;span style=&quot;margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;&quot;&gt;Çerezleri Kontrol Etme ve Silme&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Çerezlerin kullanımına ilişkin tercihlerinizi değiştirmek ya da çerezleri engellemek veya silmek için tarayıcınızın ayarlarını değiştirmeniz yeterlidir. Birçok tarayıcı çerezleri kontrol edebilmeniz için size çerezleri kabul etme veya reddetme, yalnızca belirli türdeki çerezleri kabul etme ya da bir web sitesi cihazınıza çerez depolamayı talep ettiğinde tarayıcı tarafından uyarılma seçeneği sunar. Aynı zamanda daha önce tarayıcınıza kaydedilmiş çerezlerin silinmesi de mümkündür. Çerezleri kontrol edilmesine veya silinmesine ilişkin işlemler kullandığınız tarayıcıya göre değişebilmektedir. Bazı popüler tarayıcıların çerezlere izin verme ya da çerezleri engelleme veya silme talimatlarına aşağıdaki linklerden ulaşılması mümkündür.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Çerez kullanım seçiminin değiştirilmesine ait yöntem, tarayıcı tipine bağlı olarak değişmekte olup, ilgili hizmet sağlayıcıdan dilendiği zaman öğrenilebilmektedir.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 24px; padding: 8px 0px 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 17px; line-height: inherit; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; text-size-adjust: 100%; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(73, 73, 73); letter-spacing: 0.3px;&quot;&gt;Bu politikanın en son güncellendiği tarih: ../../….&lt;/p&gt;', 'cookie-policy', '{\"title\":\"Çerez Politikası\",\"description\":\"Çerez Politikamız\",\"keywords\":\"çerez,politikası\"}', '', 12, 0, 1, 1, 0),
(15, 'Anasayfa', '', 'index', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', '', 0, 1, 1, 0, 0),
(16, 'Hakkımızda', '', 'about', '{\"title\":\"Hakkımızda\",\"description\":\"Hakkımızda\",\"keywords\":\"about,hakkımızda\"}', '37598menu_view.jpg', 12, 0, 1, 1, 0);

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
  `isComment` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '0',
  `viewCount` varchar(255) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `news`
--

INSERT INTO `news` (`id`, `url`, `title`, `description`, `img_url`, `video_url`, `news_type`, `seo`, `isActive`, `isComment`, `createdAt`, `updatedAt`, `rank`, `viewCount`, `user_id`) VALUES
(1, 'haber-1', 'Haber-1', '&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px; padding: 0px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit augue eu sagittis maximus. Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec. Vivamus sapien erat, molestie eget nulla quis, fringilla commodo eros. Aliquam posuere mi a metus auctor, sed imperdiet mauris rhoncus. Praesent vel placerat eros.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Fusce elementum enim non purus condimentum, sit amet convallis ligula tempus. Curabitur vitae tincidunt neque, sed ultrices sapien. Donec placerat congue commodo. Pellentesque aliquam pharetra convallis. Suspendisse egestas quam vel ex scelerisque, interdum venenatis sapien posuere. In hac habitasse platea dictumst. Duis ultrices nibh ex, et tempor orci scelerisque sit amet. Ut id odio non sapien lobortis sagittis quis vulputate ex. Proin mattis auctor nisi, in rutrum ligula accumsan at.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px;&quot;&gt;Sed a ante malesuada, gravida odio et, accumsan odio. Nullam aliquam enim sed convallis consequat. Ut eget aliquam est. Vivamus sagittis vulputate pretium. Nunc efficitur neque ac lectus aliquet efficitur. Vestibulum scelerisque eleifend erat. Etiam placerat convallis sapien eget mollis. Mauris scelerisque dui purus, sit amet fringilla dui imperdiet et. Aliquam quis leo id nunc mollis vehicula nec quis ipsum. Nullam aliquam nulla nec quam luctus tempor. Donec sollicitudin purus id sem tincidunt hendrerit.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px; padding: 0px;&quot;&gt;Mauris dapibus tellus sollicitudin dolor rutrum, et ultrices orci ornare. Fusce sollicitudin condimentum ante, et pellentesque nisl finibus et. Maecenas vel varius felis. Donec volutpat fringilla vehicula. Vestibulum nec luctus nisl. Maecenas odio mauris, malesuada et mauris non, ultrices iaculis ipsum. Vestibulum lobortis gravida arcu eu congue. Sed accumsan aliquam tellus, in gravida mi iaculis a. Morbi ut dictum elit. Integer pulvinar ac orci maximus imperdiet. Morbi dolor est, malesuada a luctus dapibus, pretium ut justo. Maecenas maximus eu purus et varius. Pellentesque eget suscipit neque, ut ullamcorper nisi. Curabitur hendrerit leo libero, nec pretium nisl fermentum sit amet. Cras lacinia finibus tincidunt.&lt;/p&gt;', '31516news_view.jpg', NULL, 'image', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, 1, '2020-12-23 23:17:52', '2020-12-23 23:17:52', 0, '3', 1),
(2, 'haber-2', 'Haber-2', '&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px; padding: 0px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit augue eu sagittis maximus. Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec. Vivamus sapien erat, molestie eget nulla quis, fringilla commodo eros. Aliquam posuere mi a metus auctor, sed imperdiet mauris rhoncus. Praesent vel placerat eros.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px; padding: 0px;&quot;&gt;Fusce elementum enim non purus condimentum, sit amet convallis ligula tempus. Curabitur vitae tincidunt neque, sed ultrices sapien. Donec placerat congue commodo. Pellentesque aliquam pharetra convallis. Suspendisse egestas quam vel ex scelerisque, interdum venenatis sapien posuere. In hac habitasse platea dictumst. Duis ultrices nibh ex, et tempor orci scelerisque sit amet. Ut id odio non sapien lobortis sagittis quis vulputate ex. Proin mattis auctor nisi, in rutrum ligula accumsan at.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px; padding: 0px;&quot;&gt;Sed a ante malesuada, gravida odio et, accumsan odio. Nullam aliquam enim sed convallis consequat. Ut eget aliquam est. Vivamus sagittis vulputate pretium. Nunc efficitur neque ac lectus aliquet efficitur. Vestibulum scelerisque eleifend erat. Etiam placerat convallis sapien eget mollis. Mauris scelerisque dui purus, sit amet fringilla dui imperdiet et. Aliquam quis leo id nunc mollis vehicula nec quis ipsum. Nullam aliquam nulla nec quam luctus tempor. Donec sollicitudin purus id sem tincidunt hendrerit.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; color: rgb(119, 119, 119); font-family: Roboto, sans-serif; font-size: 16px; padding: 0px;&quot;&gt;Mauris dapibus tellus sollicitudin dolor rutrum, et ultrices orci ornare. Fusce sollicitudin condimentum ante, et pellentesque nisl finibus et. Maecenas vel varius felis. Donec volutpat fringilla vehicula. Vestibulum nec luctus nisl. Maecenas odio mauris, malesuada et mauris non, ultrices iaculis ipsum. Vestibulum lobortis gravida arcu eu congue. Sed accumsan aliquam tellus, in gravida mi iaculis a. Morbi ut dictum elit. Integer pulvinar ac orci maximus imperdiet. Morbi dolor est, malesuada a luctus dapibus, pretium ut justo. Maecenas maximus eu purus et varius. Pellentesque eget suscipit neque, ut ullamcorper nisi. Curabitur hendrerit leo libero, nec pretium nisl fermentum sit amet. Cras lacinia finibus tincidunt.&lt;/p&gt;', '', 'https://www.youtube.com/embed/KBRPh1z5LH0', 'video', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, 1, '2020-12-23 23:18:34', '2020-12-23 23:18:34', 1, '4', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `news_images`
--

INSERT INTO `news_images` (`id`, `news_id`, `image_url`, `isActive`, `createdAt`, `rank`) VALUES
(1, 1, '46181news_view.jpg', 1, '2020-12-23 23:28:29', 0),
(2, 1, '63888news_view.jpg', 1, '2020-12-23 23:28:29', 0),
(3, 1, '78277news_view.jpg', 1, '2020-12-23 23:28:29', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `popups`
--

DROP TABLE IF EXISTS `popups`;
CREATE TABLE IF NOT EXISTS `popups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `popup_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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
  `projectDate` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `projects`
--

INSERT INTO `projects` (`id`, `url`, `title`, `description`, `category_id`, `projectDate`, `seo`, `isActive`, `createdAt`, `rank`) VALUES
(2, 'proje-2', 'Proje-2', '&lt;div id=&quot;lipsum&quot; style=&quot;margin: 0px; padding: 0px; text-align: justify; font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit augue eu sagittis maximus. Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec. Vivamus sapien erat, molestie eget nulla quis, fringilla commodo eros. Aliquam posuere mi a metus auctor, sed imperdiet mauris rhoncus. Praesent vel placerat eros.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;&lt;b&gt;Fusce elementum enim non purus condimentum, sit amet convallis ligula tempus. Curabitur vitae tincidunt neque, sed ultrices sapien. Donec placerat congue commodo.&lt;/b&gt; Pellentesque aliquam pharetra convallis. Suspendisse egestas quam vel ex scelerisque, interdum venenatis sapien posuere. In hac habitasse platea dictumst. Duis ultrices nibh ex, et tempor orci scelerisque sit amet. Ut id odio non sapien lobortis sagittis quis vulputate ex. Proin mattis auctor nisi, in rutrum ligula accumsan at.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Sed a ante malesuada, gravida odio et, accumsan odio. Nullam aliquam enim sed convallis consequat. Ut eget aliquam est. Vivamus sagittis vulputate pretium. Nunc efficitur neque ac lectus aliquet efficitur. Vestibulum scelerisque eleifend erat. Etiam placerat convallis sapien eget mollis. Mauris scelerisque dui purus, sit amet fringilla dui imperdiet et. Aliquam quis leo id nunc mollis vehicula nec quis ipsum. Nullam aliquam nulla nec quam luctus tempor. Donec sollicitudin purus id sem tincidunt hendrerit.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Mauris dapibus tellus sollicitudin dolor rutrum, et ultrices orci ornare. Fusce sollicitudin condimentum ante, et pellentesque nisl finibus et. Maecenas vel varius felis. Donec volutpat fringilla vehicula. Vestibulum nec luctus nisl. Maecenas odio mauris, malesuada et mauris non, ultrices iaculis ipsum. Vestibulum lobortis gravida arcu eu congue. Sed accumsan aliquam tellus, in gravida mi iaculis a. Morbi ut dictum elit. Integer pulvinar ac orci maximus imperdiet. Morbi dolor est, malesuada a luctus dapibus, pretium ut justo. Maecenas maximus eu purus et varius. Pellentesque eget suscipit neque, ut ullamcorper nisi. Curabitur hendrerit leo libero, nec pretium nisl fermentum sit amet. Cras lacinia finibus tincidunt.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Vivamus mattis porttitor lacus feugiat fringilla. Sed in sem et arcu tristique euismod sit amet ac eros. Donec accumsan nec quam gravida vestibulum. Nulla vel consectetur dolor, at pellentesque ipsum. Duis eget iaculis velit, eu imperdiet libero. Aliquam nec porttitor diam, sed vehicula metus. Suspendisse varius laoreet diam, ut porta tortor imperdiet at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur rhoncus fermentum quam, in malesuada enim suscipit maximus. Duis in nulla vel mi tempus molestie. Aenean eu enim sit amet neque eleifend facilisis. Sed et velit venenatis, placerat enim in, maximus quam. Duis non ex at sapien malesuada sodales. Pellentesque porta nunc a viverra volutpat. Nam in egestas magna. Integer aliquet ante ut imperdiet rhoncus.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;/div&gt;', 1, '28/05/2020', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-14 16:31:31', 1),
(5, 'proje-3', 'Proje-3', '&lt;div id=&quot;lipsum&quot; style=&quot;margin: 0px; padding: 0px; text-align: justify; font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit augue eu sagittis maximus. Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec. Vivamus sapien erat, molestie eget nulla quis, fringilla commodo eros. Aliquam posuere mi a metus auctor, sed imperdiet mauris rhoncus. Praesent vel placerat eros.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Fusce elementum enim non purus condimentum, sit amet convallis ligula tempus. Curabitur vitae tincidunt neque, sed ultrices sapien. Donec placerat congue commodo. Pellentesque aliquam pharetra convallis. Suspendisse egestas quam vel ex scelerisque, interdum venenatis sapien posuere. In hac habitasse platea dictumst. Duis ultrices nibh ex, et tempor orci scelerisque sit amet. Ut id odio non sapien lobortis sagittis quis vulputate ex. Proin mattis auctor nisi, in rutrum ligula accumsan at.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Sed a ante malesuada, gravida odio et, accumsan odio. Nullam aliquam enim sed convallis consequat. Ut eget aliquam est. Vivamus sagittis vulputate pretium. Nunc efficitur neque ac lectus aliquet efficitur. Vestibulum scelerisque eleifend erat. Etiam placerat convallis sapien eget mollis. Mauris scelerisque dui purus, sit amet fringilla dui imperdiet et. Aliquam quis leo id nunc mollis vehicula nec quis ipsum. Nullam aliquam nulla nec quam luctus tempor. Donec sollicitudin purus id sem tincidunt hendrerit.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Mauris dapibus tellus sollicitudin dolor rutrum, et ultrices orci ornare. Fusce sollicitudin condimentum ante, et pellentesque nisl finibus et. Maecenas vel varius felis. Donec volutpat fringilla vehicula. Vestibulum nec luctus nisl. Maecenas odio mauris, malesuada et mauris non, ultrices iaculis ipsum. Vestibulum lobortis gravida arcu eu congue. Sed accumsan aliquam tellus, in gravida mi iaculis a. Morbi ut dictum elit. Integer pulvinar ac orci maximus imperdiet. Morbi dolor est, malesuada a luctus dapibus, pretium ut justo. Maecenas maximus eu purus et varius. Pellentesque eget suscipit neque, ut ullamcorper nisi. Curabitur hendrerit leo libero, nec pretium nisl fermentum sit amet. Cras lacinia finibus tincidunt.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Vivamus mattis porttitor lacus feugiat fringilla. Sed in sem et arcu tristique euismod sit amet ac eros. Donec accumsan nec quam gravida vestibulum. Nulla vel consectetur dolor, at pellentesque ipsum. Duis eget iaculis velit, eu imperdiet libero. Aliquam nec porttitor diam, sed vehicula metus. Suspendisse varius laoreet diam, ut porta tortor imperdiet at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur rhoncus fermentum quam, in malesuada enim suscipit maximus. Duis in nulla vel mi tempus molestie. Aenean eu enim sit amet neque eleifend facilisis. Sed et velit venenatis, placerat enim in, maximus quam. Duis non ex at sapien malesuada sodales. Pellentesque porta nunc a viverra volutpat. Nam in egestas magna. Integer aliquet ante ut imperdiet rhoncus.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;/div&gt;', 2, '18/08/2020', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-14 21:41:15', 2),
(7, 'proje-1', 'Proje-1', '&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit augue eu sagittis maximus. Donec vitae cursus ex. Quisque fringilla nibh ut dolor interdum varius. Maecenas elit enim, imperdiet quis luctus sit amet, cursus eget sem. In ultrices convallis sem, quis placerat purus posuere quis. Proin bibendum purus ut vestibulum iaculis. Praesent sit amet tempus dolor. Morbi bibendum mattis lacus, et pellentesque est congue nec. Vivamus sapien erat, molestie eget nulla quis, fringilla commodo eros. Aliquam posuere mi a metus auctor, sed imperdiet mauris rhoncus. Praesent vel placerat eros.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Fusce elementum enim non purus condimentum, sit amet convallis ligula tempus. Curabitur vitae tincidunt neque, sed ultrices sapien. Donec placerat congue commodo. Pellentesque aliquam pharetra convallis. Suspendisse egestas quam vel ex scelerisque, interdum venenatis sapien posuere. In hac habitasse platea dictumst. Duis ultrices nibh ex, et tempor orci scelerisque sit amet. Ut id odio non sapien lobortis sagittis quis vulputate ex. Proin mattis auctor nisi, in rutrum ligula accumsan at.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Sed a ante malesuada, gravida odio et, accumsan odio. Nullam aliquam enim sed convallis consequat. Ut eget aliquam est. Vivamus sagittis vulputate pretium. Nunc efficitur neque ac lectus aliquet efficitur. Vestibulum scelerisque eleifend erat. Etiam placerat convallis sapien eget mollis. Mauris scelerisque dui purus, sit amet fringilla dui imperdiet et. Aliquam quis leo id nunc mollis vehicula nec quis ipsum. Nullam aliquam nulla nec quam luctus tempor. Donec sollicitudin purus id sem tincidunt hendrerit.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Mauris dapibus tellus sollicitudin dolor rutrum, et ultrices orci ornare. Fusce sollicitudin condimentum ante, et pellentesque nisl finibus et. Maecenas vel varius felis. Donec volutpat fringilla vehicula. Vestibulum nec luctus nisl. Maecenas odio mauris, malesuada et mauris non, ultrices iaculis ipsum. Vestibulum lobortis gravida arcu eu congue. Sed accumsan aliquam tellus, in gravida mi iaculis a. Morbi ut dictum elit. Integer pulvinar ac orci maximus imperdiet. Morbi dolor est, malesuada a luctus dapibus, pretium ut justo. Maecenas maximus eu purus et varius. Pellentesque eget suscipit neque, ut ullamcorper nisi. Curabitur hendrerit leo libero, nec pretium nisl fermentum sit amet. Cras lacinia finibus tincidunt.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Vivamus mattis porttitor lacus feugiat fringilla. Sed in sem et arcu tristique euismod sit amet ac eros. Donec accumsan nec quam gravida vestibulum. Nulla vel consectetur dolor, at pellentesque ipsum. Duis eget iaculis velit, eu imperdiet libero. Aliquam nec porttitor diam, sed vehicula metus. Suspendisse varius laoreet diam, ut porta tortor imperdiet at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur rhoncus fermentum quam, in malesuada enim suscipit maximus. Duis in nulla vel mi tempus molestie. Aenean eu enim sit amet neque eleifend facilisis. Sed et velit venenatis, placerat enim in, maximus quam. Duis non ex at sapien malesuada sodales. Pellentesque porta nunc a viverra volutpat. Nam in egestas magna. Integer aliquet ante ut imperdiet rhoncus.&lt;/p&gt;&lt;div&gt;&lt;br style=&quot;color: rgb(119, 119, 119); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 16px; text-align: justify;&quot;&gt;&lt;/div&gt;', 3, '28/04/2020', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-22 17:17:26', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `image_url`, `isActive`, `isCover`, `createdAt`, `rank`) VALUES
(9, 2, '62199projects_view.jpg', 1, 0, '2020-12-14 21:36:31', 0),
(19, 7, '56162projects_view.jpg', 1, 0, '2020-12-22 17:17:56', 0),
(18, 7, '81500projects_view.jpg', 1, 1, '2020-12-22 17:17:56', 0),
(17, 7, '19799projects_view.jpg', 1, 0, '2020-12-22 17:17:56', 0),
(10, 2, '9233projects_view.jpg', 1, 1, '2020-12-14 21:36:31', 0),
(11, 2, '69132projects_view.jpg', 1, 0, '2020-12-14 21:36:31', 0),
(12, 5, '62438projects_view.jpg', 1, 1, '2020-12-14 21:41:26', 0),
(13, 5, '12296projects_view.jpg', 1, 0, '2020-12-14 21:41:26', 0),
(14, 5, '61908projects_view.jpg', 1, 0, '2020-12-14 21:41:26', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `references`
--

INSERT INTO `references` (`id`, `url`, `title`, `description`, `img_url`, `seo`, `isActive`, `createdAt`, `updatedAt`, `rank`) VALUES
(3, 'referans-1', 'Referans-1', '&lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sunt ipsum iusto, ut dolor iste itaque fuga corporis. Sint occaecat cup non proident, sunt in culpa qui.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia voluptate asperiores nobis, aut consequatur esse sapiente. Sint occaecat cup non proident, sunt in culpa qui.&lt;/p&gt;', '69578references_view.jpg', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-27 16:13:35', '2020-12-27 16:13:35', 0),
(4, 'referans-2', 'Referans-2', '&lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sunt ipsum iusto, ut dolor iste itaque fuga corporis. Sint occaecat cup non proident, sunt in culpa qui.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia voluptate asperiores nobis, aut consequatur esse sapiente. Sint occaecat cup non proident, sunt in culpa qui.&lt;/p&gt;', '34309references_view.jpg', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-27 16:13:46', '2020-12-27 16:13:46', 1),
(5, 'referans-3', 'Referans-3', '&lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sunt ipsum iusto, ut dolor iste itaque fuga corporis. Sint occaecat cup non proident, sunt in culpa qui.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia voluptate asperiores nobis, aut consequatur esse sapiente. Sint occaecat cup non proident, sunt in culpa qui.&lt;/p&gt;', '12789references_view.jpg', '{\"title\":\"\",\"description\":\"\",\"keywords\":\"\"}', 1, '2020-12-27 16:13:55', '2020-12-27 16:13:55', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `references_images`
--

INSERT INTO `references_images` (`id`, `references_id`, `image_url`, `isActive`, `createdAt`, `rank`) VALUES
(17, 5, '83286references_view.jpg', 1, '2020-12-27 16:24:01', 2),
(16, 5, '20006references_view.jpg', 1, '2020-12-27 16:24:01', 1),
(15, 5, '70773references_view.jpg', 1, '2020-12-27 16:24:01', 0),
(13, 4, '19759references_view.jpg', 1, '2020-12-27 16:23:31', 2),
(12, 4, '44795references_view.jpg', 1, '2020-12-27 16:23:31', 1),
(10, 3, '2506references_view.jpg', 1, '2020-12-27 16:23:14', 2),
(11, 3, '87660references_view.jpg', 1, '2020-12-27 16:23:14', 1),
(14, 4, '78100references_view.jpg', 1, '2020-12-27 16:23:31', 0),
(9, 3, '13573references_view.jpg', 1, '2020-12-27 16:23:07', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `about_img` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `cover`, `about_img`) VALUES
(1, '32368settings_view.png', '32368settings_view1.png', '39234settings_view.jpg', '63628settings_view.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `allowButton` tinyint(4) NOT NULL,
  `buttonUrl` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `buttonText` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `img_url`, `allowButton`, `buttonUrl`, `buttonText`, `createdAt`, `isActive`, `rank`) VALUES
(1, 'Infinity CMS', 'Tamamen yönetilebilir içerikli website scripti', '27012sliders_view.jpg', 0, '', '', '2020-12-23 01:01:14', 1, 0),
(2, 'Slider-2', 'Slider-2 Açıklaması', '5551sliders_view.jpg', 1, 'contact', 'Bize ulaşın!', '2020-12-23 01:01:59', 1, 1),
(3, 'Slider-3', 'Slider-3 Açıklaması', '78001sliders_view.jpg', 0, '', '', '2020-12-23 01:02:15', 1, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `testimonials`
--

INSERT INTO `testimonials` (`id`, `title`, `description`, `img_url`, `company_name`, `isActive`, `createdAt`, `rank`) VALUES
(4, 'Müşteri-2', 'There are many variations of passages Lorem Ipsum available,the majority have suffered alteration passages of Lorem Ipsum available, but it’s only the main majority.', '15202testimonials_view.png', 'Firma-2', 1, '2020-12-23 20:11:37', 1),
(3, 'Müşteri-1', 'There are many variations of passages Lorem Ipsum available,the majority have suffered alteration passages of Lorem Ipsum available, but it’s only the main majority.', '52465testimonials_view.png', 'Firma-1', 1, '2020-12-23 20:11:22', 0),
(5, 'Müşteri-3', 'There are many variations of passages Lorem Ipsum available,the majority have suffered alteration passages of Lorem Ipsum available, but it’s only the main majority.', '58139testimonials_view.png', 'Firma-3', 1, '2020-12-23 20:11:48', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `todo`
--

INSERT INTO `todo` (`id`, `title`, `isActive`, `user_id`, `createdAt`, `checkedAt`) VALUES
(8, 'Ön temaya SEO title, description, keywords entegresi yapılacak.', 1, 1, '2020-12-28 01:04:08', '2020-12-28 16:30:20'),
(9, 'Bülten\'e kayıt olan hesaplara toplu mail gönderimi yapılacak.', 1, 1, '2020-12-28 01:04:47', '2020-12-28 15:41:11'),
(11, 'Çoklu dil eklentisi eklenecek.', 0, 1, '2020-12-29 00:32:16', NULL),
(12, 'Ayarlar iletişim yazısı textarea yapılacak, diğer düzenlenebilir içerikler de aynı şekilde.', 1, 1, '2020-12-29 02:08:43', '2020-12-29 16:27:22');

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
  `permissions` text COLLATE utf8_turkish_ci,
  `isActive` tinyint(4) NOT NULL,
  `isOnline` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `user_name`, `img_url`, `full_name`, `user_type`, `email`, `password`, `permissions`, `isActive`, `isOnline`, `createdAt`) VALUES
(1, 'afsakar', '35456users_view.png', 'Azad Furkan ŞAKAR', 'superadmin', 'afsakarr@gmail.com', 'b5c60e2480c6a1646eeaa06388f50b10', '{\"\\/\":{\"show\":\"on\"},\"settings\":{\"show\":\"on\",\"edit\":\"on\"},\"email_settings\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"users\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"contact\":{\"show\":\"on\",\"edit\":\"on\",\"send\":\"on\",\"delete\":\"on\"},\"menu\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"galleries\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"sliders\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"projects\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"projects_category\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"news\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"comments\":{\"show\":\"on\",\"edit\":\"on\",\"delete\":\"on\"},\"courses\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"references\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"popups\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"brands\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"testimonials\":{\"show\":\"on\",\"edit\":\"on\",\"add\":\"on\",\"delete\":\"on\"},\"members\":{\"show\":\"on\",\"send\":\"on\",\"delete\":\"on\"}}', 1, 1, '2020-12-10 19:28:56'),
(2, 'admin', '25013users_view.png', 'Admin', 'admin', 'rank-wc@hotmail.com', 'b5c60e2480c6a1646eeaa06388f50b10', '{\"\\/\":{\"show\":\"on\"},\"settings\":{\"show\":\"on\"},\"email_settings\":{\"show\":\"on\"},\"users\":{\"show\":\"on\"},\"contact\":{\"show\":\"on\"},\"menu\":{\"show\":\"on\"},\"galleries\":{\"show\":\"on\"},\"sliders\":{\"show\":\"on\"},\"projects\":{\"show\":\"on\"},\"projects_category\":{\"show\":\"on\"},\"news\":{\"show\":\"on\"},\"comments\":{\"show\":\"on\"},\"courses\":{\"show\":\"on\"},\"references\":{\"show\":\"on\"},\"popups\":{\"show\":\"on\"},\"brands\":{\"show\":\"on\"},\"testimonials\":{\"show\":\"on\"},\"members\":{\"show\":\"on\"}}', 1, 0, '2020-12-10 22:59:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
