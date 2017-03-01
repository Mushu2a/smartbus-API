-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 02 Novembre 2016 à 06:33
-- Version du serveur: 5.5.53-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `smartbus`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `path_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_path_id_foreign` (`path_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_10_31_134302_create_table_users', 1),
('2016_11_01_032241_create_table_paths', 1),
('2016_11_01_033305_create_table_bookings', 1);

-- --------------------------------------------------------

--
-- Structure de la table `paths`
--

CREATE TABLE IF NOT EXISTS `paths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bookingSeats` int(11) NOT NULL,
  `remainingSeats` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Type de trajet ? 0 => aller-retour | 1 => aller | 2 => retour',
  `startPlace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startCity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startZip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlePlace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middleCity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middleZip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `finnishPlace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `finnishCity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `finnishZip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `startTime` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paths_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `birthday` datetime NOT NULL,
  `address1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => Homme | 1 => Femme',
  `brandBus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Marque du Bus',
  `comfort` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Confort du Bus',
  `number` int(11) DEFAULT NULL COMMENT 'Nombre de place dans le Bus',
  `owner` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Possède t''il un bus ? 0 => Non | 1 => Oui',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_path_id_foreign` FOREIGN KEY (`path_id`) REFERENCES `paths` (`id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `paths`
--
ALTER TABLE `paths`
  ADD CONSTRAINT `paths_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
