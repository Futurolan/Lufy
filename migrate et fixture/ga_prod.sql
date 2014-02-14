-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 14 Février 2014 à 16:54
-- Version du serveur: 5.5.35
-- Version de PHP: 5.4.4-14+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ga_prod`
--

-- --------------------------------------------------------

--
-- Structure de la table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id_block` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_block`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE IF NOT EXISTS `entree` (
  `id_entree` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `is_enter` int(11) DEFAULT '0',
  `is_prepayed` int(11) DEFAULT '0',
  `payement_amount` int(11) DEFAULT NULL,
  `payement_type` int(11) DEFAULT NULL,
  `parental_consent` int(11) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_entree`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `weezevent_id` varchar(50) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `start_registration_at` datetime DEFAULT NULL,
  `end_registration_at` datetime DEFAULT NULL,
  `address` text,
  `map_url` text,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `event_sluggable_idx` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` bigint(20) NOT NULL AUTO_INCREMENT,
  `request` text NOT NULL,
  `answer` text NOT NULL,
  `status` smallint(6) NOT NULL,
  `position` bigint(20) NOT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id_file` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `description` text,
  `file_type_id` bigint(20) DEFAULT NULL,
  `file_category_id` bigint(20) DEFAULT NULL,
  `position` bigint(20) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_file`),
  UNIQUE KEY `file_sluggable_idx` (`slug`),
  KEY `file_type_id_idx` (`file_type_id`),
  KEY `file_category_id_idx` (`file_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `file_category`
--

CREATE TABLE IF NOT EXISTS `file_category` (
  `id_file_category` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_file_category`),
  UNIQUE KEY `file_category_sluggable_idx` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `file_type`
--

CREATE TABLE IF NOT EXISTS `file_type` (
  `id_file_type` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_file_type`),
  UNIQUE KEY `file_type_sluggable_idx` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `id_friend` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `friend_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id_friend`),
  KEY `friend_id_idx` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `album_id` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '99',
  `status` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_gallery`),
  UNIQUE KEY `gallery_sluggable_idx` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id_game` int(11) NOT NULL AUTO_INCREMENT,
  `game_type_id` int(11) NOT NULL,
  `plateform_id` int(11) DEFAULT NULL,
  `label` varchar(45) NOT NULL,
  `editor` varchar(100) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `logourl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_game`),
  KEY `game_type_id_idx` (`game_type_id`),
  KEY `plateform_id_idx` (`plateform_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `game_type`
--

CREATE TABLE IF NOT EXISTS `game_type` (
  `id_game_type` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id_game_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `invite`
--

CREATE TABLE IF NOT EXISTS `invite` (
  `id_invite` bigint(20) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `is_accepted` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_invite`),
  KEY `team_id_idx` (`team_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id_mail` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `summary` text,
  `content` text,
  `status` varchar(45) NOT NULL,
  `publish_on` datetime NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `news_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_news`),
  UNIQUE KEY `news_sluggable_idx` (`slug`),
  KEY `news_type_id_idx` (`news_type_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_newsletter` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `news_type`
--

CREATE TABLE IF NOT EXISTS `news_type` (
  `id_news_type` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `description` text,
  `logourl` varchar(250) DEFAULT NULL,
  `is_special` int(11) NOT NULL,
  PRIMARY KEY (`id_news_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `content` text,
  `status` int(11) DEFAULT '0',
  `publish_on` datetime NOT NULL,
  `page_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_page`),
  UNIQUE KEY `page_sluggable_idx` (`slug`),
  KEY `page_type_id_idx` (`page_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `page_type`
--

CREATE TABLE IF NOT EXISTS `page_type` (
  `id_page_type` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_page_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id_partner` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  `logourl` varchar(250) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `partner_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id_partner`),
  KEY `partner_type_id_idx` (`partner_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `partner_type`
--

CREATE TABLE IF NOT EXISTS `partner_type` (
  `id_partner_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` varchar(45) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partner_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plateform`
--

CREATE TABLE IF NOT EXISTS `plateform` (
  `id_plateform` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `tag` varchar(10) DEFAULT NULL,
  `constructor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_plateform`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_forgot_password`
--

CREATE TABLE IF NOT EXISTS `sf_guard_forgot_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `unique_key` varchar(255) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_group`
--

CREATE TABLE IF NOT EXISTS `sf_guard_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_group_permission`
--

CREATE TABLE IF NOT EXISTS `sf_guard_group_permission` (
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `permission_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`),
  KEY `sf_guard_group_permission_permission_id_sf_guard_permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_permission`
--

CREATE TABLE IF NOT EXISTS `sf_guard_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_remember_key`
--

CREATE TABLE IF NOT EXISTS `sf_guard_remember_key` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `remember_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_super_admin` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  UNIQUE KEY `username` (`username`),
  KEY `is_active_idx_idx` (`is_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_address`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `complement` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `is_billing` tinyint(1) DEFAULT '0',
  `is_delivery` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_group`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_group` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `sf_guard_user_group_group_id_sf_guard_group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_licence_masters`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_licence_masters` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `type` varchar(15) DEFAULT NULL,
  `serial` varchar(40) NOT NULL,
  `season` varchar(9) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_permission`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_permission` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `permission_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `sf_guard_user_permission_permission_id_sf_guard_permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_profile`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_profile` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `ean13` varchar(13) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT 'unknow',
  `website` varchar(250) DEFAULT NULL,
  `logourl` varchar(250) DEFAULT NULL,
  `carrer` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_tshirt`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_tshirt` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `size` varchar(255) DEFAULT 'M',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sf_guard_user_weezevent`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_weezevent` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `event_id` varchar(50) DEFAULT NULL,
  `tournament_id` varchar(50) DEFAULT NULL,
  `barcode` varchar(50) NOT NULL,
  `is_valid` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id_team` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `tag` varchar(10) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `description` text,
  `website` varchar(250) DEFAULT NULL,
  `logourl` varchar(250) DEFAULT NULL,
  `is_locked` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_team`),
  UNIQUE KEY `team_sluggable_idx` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `team_player`
--

CREATE TABLE IF NOT EXISTS `team_player` (
  `team_id` int(11) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `is_captain` tinyint(1) DEFAULT '0',
  `is_player` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`team_id`,`user_id`),
  KEY `team_player_user_id_sf_guard_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `assigned_at` bigint(20) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `content` text,
  `parent_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `assigned_at_idx` (`assigned_at`),
  KEY `parent_id_idx` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ticket_flag`
--

CREATE TABLE IF NOT EXISTS `ticket_flag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `color` varchar(6) NOT NULL DEFAULT '000000',
  `is_closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ticket_flag_ticket`
--

CREATE TABLE IF NOT EXISTS `ticket_flag_ticket` (
  `ticket_flag_id` bigint(20) NOT NULL DEFAULT '0',
  `ticket_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ticket_flag_id`,`ticket_id`),
  KEY `ticket_flag_ticket_ticket_id_ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
  `id_tournament` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `weezevent_id` varchar(50) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `number_team` int(11) NOT NULL DEFAULT '1',
  `player_per_team` int(11) NOT NULL DEFAULT '1',
  `cost_per_player` decimal(10,2) NOT NULL DEFAULT '0.00',
  `reserved_slot` int(11) NOT NULL DEFAULT '0',
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `logourl` varchar(250) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tournament`),
  UNIQUE KEY `tournament_sluggable_idx` (`slug`),
  KEY `event_id_idx` (`event_id`),
  KEY `game_id_idx` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `tournament_admin`
--

CREATE TABLE IF NOT EXISTS `tournament_admin` (
  `id_tournament_admin` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `tournament_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tournament_admin`),
  KEY `tournament_id_idx` (`tournament_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tournament_slot`
--

CREATE TABLE IF NOT EXISTS `tournament_slot` (
  `id_tournament_slot` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `is_valid` tinyint(1) DEFAULT '0',
  `is_locked` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_tournament_slot`),
  KEY `team_id_idx` (`team_id`),
  KEY `tournament_id_idx` (`tournament_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `var_config`
--

CREATE TABLE IF NOT EXISTS `var_config` (
  `id_var` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_var`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_file_category_id_file_category_id_file_category` FOREIGN KEY (`file_category_id`) REFERENCES `file_category` (`id_file_category`),
  ADD CONSTRAINT `file_file_type_id_file_type_id_file_type` FOREIGN KEY (`file_type_id`) REFERENCES `file_type` (`id_file_type`);

--
-- Contraintes pour la table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_friend_id_sf_guard_user_id` FOREIGN KEY (`friend_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_game_type_id_game_type_id_game_type` FOREIGN KEY (`game_type_id`) REFERENCES `game_type` (`id_game_type`),
  ADD CONSTRAINT `game_plateform_id_plateform_id_plateform` FOREIGN KEY (`plateform_id`) REFERENCES `plateform` (`id_plateform`);

--
-- Contraintes pour la table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `invite_team_id_team_id_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id_team`),
  ADD CONSTRAINT `invite_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_news_type_id_news_type_id_news_type` FOREIGN KEY (`news_type_id`) REFERENCES `news_type` (`id_news_type`),
  ADD CONSTRAINT `news_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_page_type_id_page_type_id_page_type` FOREIGN KEY (`page_type_id`) REFERENCES `page_type` (`id_page_type`);

--
-- Contraintes pour la table `partner`
--
ALTER TABLE `partner`
  ADD CONSTRAINT `partner_partner_type_id_partner_type_id_partner_type` FOREIGN KEY (`partner_type_id`) REFERENCES `partner_type` (`id_partner_type`);

--
-- Contraintes pour la table `sf_guard_forgot_password`
--
ALTER TABLE `sf_guard_forgot_password`
  ADD CONSTRAINT `sf_guard_forgot_password_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sf_guard_group_permission`
--
ALTER TABLE `sf_guard_group_permission`
  ADD CONSTRAINT `sf_guard_group_permission_group_id_sf_guard_group_id` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_group_permission_permission_id_sf_guard_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sf_guard_remember_key`
--
ALTER TABLE `sf_guard_remember_key`
  ADD CONSTRAINT `sf_guard_remember_key_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sf_guard_user_address`
--
ALTER TABLE `sf_guard_user_address`
  ADD CONSTRAINT `sf_guard_user_address_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `sf_guard_user_group`
--
ALTER TABLE `sf_guard_user_group`
  ADD CONSTRAINT `sf_guard_user_group_group_id_sf_guard_group_id` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_user_group_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sf_guard_user_permission`
--
ALTER TABLE `sf_guard_user_permission`
  ADD CONSTRAINT `sf_guard_user_permission_permission_id_sf_guard_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_user_permission_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `team_player`
--
ALTER TABLE `team_player`
  ADD CONSTRAINT `team_player_team_id_team_id_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id_team`),
  ADD CONSTRAINT `team_player_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_assigned_at_sf_guard_user_id` FOREIGN KEY (`assigned_at`) REFERENCES `sf_guard_user` (`id`),
  ADD CONSTRAINT `ticket_parent_id_ticket_id` FOREIGN KEY (`parent_id`) REFERENCES `ticket` (`id`),
  ADD CONSTRAINT `ticket_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `ticket_flag_ticket`
--
ALTER TABLE `ticket_flag_ticket`
  ADD CONSTRAINT `ticket_flag_ticket_ticket_flag_id_ticket_flag_id` FOREIGN KEY (`ticket_flag_id`) REFERENCES `ticket_flag` (`id`),
  ADD CONSTRAINT `ticket_flag_ticket_ticket_id_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`);

--
-- Contraintes pour la table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_event_id_event_id_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`),
  ADD CONSTRAINT `tournament_game_id_game_id_game` FOREIGN KEY (`game_id`) REFERENCES `game` (`id_game`);

--
-- Contraintes pour la table `tournament_admin`
--
ALTER TABLE `tournament_admin`
  ADD CONSTRAINT `tournament_admin_tournament_id_tournament_id_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id_tournament`),
  ADD CONSTRAINT `tournament_admin_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Contraintes pour la table `tournament_slot`
--
ALTER TABLE `tournament_slot`
  ADD CONSTRAINT `tournament_slot_team_id_team_id_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id_team`),
  ADD CONSTRAINT `tournament_slot_tournament_id_tournament_id_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id_tournament`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
