-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2023 at 12:24 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Sunday', 'Micheal', 'thecreatorinbox@gmail.com', '$2y$10$HqrlBIGTW3q18xdB4XGAnODvofcEMhH6DHUTd3pTlCnGCA/JUIyiS', '2023-06-09 11:58:05', '2023-06-09 11:58:05'),
(2, 'Sunday', 'Micheal', 'sundaymicheal2002@gmail.com', '$2y$10$F.ATJnRUjTfnQOY0cqgAhuTcLe8Tu6S7i0299JEFx/kVhECnDzUjS', '2023-06-13 10:41:56', '2023-06-13 10:41:56'),
(3, 'Sunday', 'Micheal', 'harry@den.com', '$2y$10$MtOuF13C44dx5ndj0Rk7iO5Q7118ic1GSeMN.PP1xQ4mpewoiFNwC', '2023-06-13 10:43:23', '2023-06-13 10:43:23'),
(4, 'Sunday', 'Micheal', 'sundaymicheal0202@gmail.com', '$2y$10$14mUZYKzj290ywljFo0fEufcHPbjSC1a5zeEDSm0cq13d5OAosv4O', '2023-06-13 10:44:11', '2023-06-13 10:44:11'),
(5, 'Sunday', 'Micheal', 'sunday2345@gmail.com', '$2y$10$0Frkq3yayu1Rr.CfOtZfPeejbWfg4ofiiEX4NLdgxe7P.0OUePl.q', '2023-06-13 10:47:20', '2023-06-13 10:47:20'),
(6, 'Sunday', 'Micheal', 'admin@admin.com', '$2y$10$BAxVgbdjTEsRR32kf/Zaw.Dvf3sg67V4rCkO7Fzq3KHCyU2Mrg4I.', '2023-06-20 10:44:11', '2023-06-20 10:44:11'),
(7, 'James', 'Bond', 'jamesbond@gmail.com', '$2y$10$/Rj96LPptMSFxtDUxqndA.RH6IgsaRbLZa2jgmZEeSeoMGwleWbTK', '2023-06-22 10:49:04', '2023-06-22 10:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_slug` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_slug`, `category_name`) VALUES
(1, 'polities', 'polities'),
(2, 'entertainment', 'entertainment'),
(4, 'technology', 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `comment`, `created_on`) VALUES
(1, 3, 'sunday', 'owix usxhqailush haushcausca scashciauhcuho', '2023-07-13 12:43:03'),
(2, 3, 'micheal', 'ydgqui qgwyiqg aywid gqwdg qwuildgQ GUDYIQ', '2023-07-13 12:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post_details` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_category` int NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_subtitle`, `post_details`, `post_image`, `post_category`, `views`, `created_on`, `update_on`) VALUES
(1, 'Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women', 'Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women', '<p style=\"text-align: center;\">&nbsp;<img src=\"data:image/jpeg;base64,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\" alt=\"\" width=\"265\" height=\"154\"></p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>', '391.jpg', 2, 0, '2023-07-11 12:35:37', '2023-07-13 10:48:22'),
(2, 'Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women', 'Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women', '<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>', '4894.jpg', 2, 0, '2023-07-11 12:39:43', '2023-07-13 10:14:13'),
(3, 'Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women', 'Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women', '<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other womenFootballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other womenFootballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other womenFootballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>\r\n<p>Footballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other womenFootballer Neymar admits he made a mistake in public apology to his pregnant girlfriend Bruna Biancardi after she gave him permission to cheat on her with other women</p>', '3882.jpg', 2, 0, '2023-07-11 12:43:47', '2023-07-11 12:43:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
