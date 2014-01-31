-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 31 jan 2014 om 17:21
-- Serverversie: 5.5.34-cll
-- PHP-versie: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `razzed_ziektekaart`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_desease` int(11) unsigned NOT NULL,
  `comment_text` text NOT NULL,
  `comment_created` datetime NOT NULL,
  `comment_creator` int(11) unsigned NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Gegevens worden uitgevoerd voor tabel `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_desease`, `comment_text`, `comment_created`, `comment_creator`) VALUES
(67, 50, 'Oh my god, you''re going to dieeee!', '2014-01-06 09:54:30', 6),
(66, 51, 'how sad', '2014-01-05 19:54:58', 13),
(64, 47, 'Ow wat zielig', '2014-01-04 18:51:55', 6),
(63, 45, 'Vervelend', '2014-01-04 17:20:13', 6),
(72, 52, 'Tis geweldig', '2014-01-12 16:11:25', 6),
(71, 88, 'omg', '2014-01-06 11:37:17', 17),
(70, 52, 'take a aspirine', '2014-01-06 10:02:26', 16),
(69, 86, 'Omg, that''s a pity.', '2014-01-06 10:01:46', 16),
(54, 3, '', '2014-01-04 16:41:25', 0),
(55, 3, 'adfasdf', '2014-01-04 16:41:27', 0),
(56, 3, 'adsfasdf', '2014-01-04 16:43:08', 0),
(57, 3, 'afasdsf', '2014-01-04 16:43:31', 0),
(58, 3, '', '2014-01-04 16:43:32', 0),
(59, 3, '', '2014-01-04 16:43:32', 0),
(60, 3, 'ju-p', '2014-01-04 16:44:11', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `deasestags`
--

CREATE TABLE IF NOT EXISTS `deasestags` (
  `deasestag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deasestag_desease` int(11) unsigned NOT NULL,
  `deasestag_tag` int(11) unsigned NOT NULL,
  PRIMARY KEY (`deasestag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `deasestags`
--

INSERT INTO `deasestags` (`deasestag_id`, `deasestag_desease`, `deasestag_tag`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `deseases`
--

CREATE TABLE IF NOT EXISTS `deseases` (
  `desease_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `desease_text` text NOT NULL,
  `desease_lat` varchar(32) NOT NULL,
  `desease_lng` varchar(32) NOT NULL,
  `desease_start` datetime NOT NULL,
  `desease_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `desease_created` datetime NOT NULL,
  `desease_creator` int(11) unsigned NOT NULL,
  PRIMARY KEY (`desease_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Gegevens worden uitgevoerd voor tabel `deseases`
--

INSERT INTO `deseases` (`desease_id`, `desease_text`, `desease_lat`, `desease_lng`, `desease_start`, `desease_end`, `desease_created`, `desease_creator`) VALUES
(55, 'HIV/AIDS', '0.43250104', '16.6342132', '2014-01-05 19:37:57', '0000-00-00 00:00:00', '2014-01-05 19:39:05', 8),
(54, 'Influenza', '46.5540827', '4.68108817', '2014-01-05 19:35:16', '0000-00-00 00:00:00', '2014-01-05 19:35:49', 7),
(53, 'Influenza', '48.2200437', '-3.7564118', '2014-01-05 19:35:16', '0000-00-00 00:00:00', '2014-01-05 19:35:42', 7),
(52, 'Influenza', '47.8674832', '1.25335380', '2014-01-05 19:35:16', '0000-00-00 00:00:00', '2014-01-05 19:35:35', 7),
(51, 'Influenza', '47.7494266', '6.52679130', '2014-01-05 19:35:16', '0000-00-00 00:00:00', '2014-01-05 19:35:29', 7),
(50, 'Influenza', '53.2741985', '-1.6030915', '2014-01-05 19:34:25', '0000-00-00 00:00:00', '2014-01-05 19:35:13', 7),
(49, 'Influenza', '48.8601440', '2.30804130', '2014-01-05 19:34:25', '0000-00-00 00:00:00', '2014-01-05 19:35:01', 7),
(45, 'Ziek zwak en misselijk.', '53.2606426', '13.4769250', '2014-01-04 17:19:52', '0000-00-00 00:00:00', '2014-01-04 17:20:02', 6),
(47, 'Ik ben zo zieeek', '53.1487199', '8.20898512', '2014-01-04 18:51:17', '0000-00-00 00:00:00', '2014-01-04 18:51:38', 6),
(87, 'influenza', '47.8349319', '1.63924799', '2014-01-06 10:02:58', '0000-00-00 00:00:00', '2014-01-06 10:03:45', 6),
(88, 'insomnia', '59.9275293', '10.7501746', '2014-01-06 11:36:31', '0000-00-00 00:00:00', '2014-01-06 11:36:59', 17),
(56, 'HIV/AIDS', '5.60907115', '23.4017913', '2014-01-05 19:37:57', '0000-00-00 00:00:00', '2014-01-05 19:39:14', 8),
(57, 'HIV/AIDS', '16.9660955', '10.3939788', '2014-01-05 19:37:57', '0000-00-00 00:00:00', '2014-01-05 19:39:23', 8),
(58, 'HIV/AIDS', '-4.5723994', '20.9408538', '2014-01-05 19:37:57', '0000-00-00 00:00:00', '2014-01-05 19:39:31', 8),
(59, 'HIV/AIDS', '-16.305719', '25.1596038', '2014-01-05 19:37:57', '0000-00-00 00:00:00', '2014-01-05 19:39:38', 8),
(60, 'HIV/AIDS', '-1.0615747', '27.9721038', '2014-01-05 19:37:57', '0000-00-00 00:00:00', '2014-01-05 19:39:45', 8),
(86, 'My head hurts, something to do with databases.', '56.0165309', '9.28570437', '2014-01-06 10:01:01', '0000-00-00 00:00:00', '2014-01-06 10:01:29', 16),
(63, 'HIV/AIDS', '-29.694054', '21.1166172', '2014-01-05 19:41:25', '0000-00-00 00:00:00', '2014-01-05 19:42:12', 9),
(64, 'HIV/AIDS', '-23.247694', '26.9173984', '2014-01-05 19:41:25', '0000-00-00 00:00:00', '2014-01-05 19:42:20', 9),
(65, 'HIV/AIDS', '-7.7178379', '25.8627109', '2014-01-05 19:41:25', '0000-00-00 00:00:00', '2014-01-05 19:42:28', 9),
(66, 'HIV/AIDS', '-1.4130155', '38.8705234', '2014-01-05 19:41:25', '0000-00-00 00:00:00', '2014-01-05 19:42:35', 9),
(67, 'Chlamydia', '', '', '2014-01-05 19:44:43', '0000-00-00 00:00:00', '2014-01-05 19:45:17', 11),
(68, 'HIV/AIDS', '-7.7178621', '-74.332574', '2014-01-05 19:44:39', '0000-00-00 00:00:00', '2014-01-05 19:45:19', 10),
(69, 'HIV/AIDS', '-19.649117', '-52.887261', '2014-01-05 19:44:39', '0000-00-00 00:00:00', '2014-01-05 19:45:25', 10),
(70, 'HIV/AIDS', '-6.3221896', '-71.871636', '2014-01-05 19:44:39', '0000-00-00 00:00:00', '2014-01-05 19:45:33', 10),
(71, 'HIV/AIDS', '-7.7178621', '-69.762261', '2014-01-05 19:44:39', '0000-00-00 00:00:00', '2014-01-05 19:45:42', 10),
(72, 'HIV/AIDS', '-18.985582', '-57.457574', '2014-01-05 19:44:39', '0000-00-00 00:00:00', '2014-01-05 19:45:50', 10),
(73, 'hiv', '', '', '2014-01-05 19:47:57', '0000-00-00 00:00:00', '2014-01-05 19:48:32', 11),
(74, 'Malaria', '0.69615453', '100.393982', '2014-01-05 19:50:48', '0000-00-00 00:00:00', '2014-01-05 19:51:17', 12),
(75, 'Malaria', '-5.6229057', '27.6205445', '2014-01-05 19:50:48', '0000-00-00 00:00:00', '2014-01-05 19:51:26', 12),
(76, 'Malaria', '-31.058890', '-66.246642', '2014-01-05 19:50:48', '0000-00-00 00:00:00', '2014-01-05 19:51:33', 12),
(77, 'Malaria', '-0.0069533', '114.104919', '2014-01-05 19:50:48', '0000-00-00 00:00:00', '2014-01-05 19:51:42', 12),
(78, 'Malaria', '35.7408686', '101.448669', '2014-01-05 19:50:48', '0000-00-00 00:00:00', '2014-01-05 19:51:47', 12),
(79, 'Malaria', '24.5208124', '90.5502563', '2014-01-05 19:50:48', '0000-00-00 00:00:00', '2014-01-05 19:51:57', 12),
(80, 'Tuberculosis', '60.0613717', '44.8470972', '2014-01-05 19:58:24', '0000-00-00 00:00:00', '2014-01-05 19:58:48', 14),
(81, 'Tuberculosis', '56.9411824', '48.0111577', '2014-01-05 19:58:24', '0000-00-00 00:00:00', '2014-01-05 19:58:55', 14),
(82, 'Tuberculosis', '56.7489115', '53.6361577', '2014-01-05 19:58:24', '0000-00-00 00:00:00', '2014-01-05 19:59:02', 14),
(83, 'Radiation sickness', '51.2988026', '30.2298106', '2014-01-05 19:58:24', '0000-00-00 00:00:00', '2014-01-05 20:02:00', 14),
(84, 'Radiation sickness', '51.3399953', '30.3451486', '2014-01-05 19:58:24', '0000-00-00 00:00:00', '2014-01-05 20:02:10', 14),
(85, 'Radiation sickness', '51.3948675', '30.5209299', '2014-01-05 19:58:24', '0000-00-00 00:00:00', '2014-01-05 20:02:18', 14);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(32) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'Hoofdpijn'),
(2, 'Buikpijn');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(64) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_firstname` varchar(64) NOT NULL,
  `user_lastname` varchar(64) NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` enum('m','f') NOT NULL,
  `user_created` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_firstname`, `user_lastname`, `user_dob`, `user_gender`, `user_created`) VALUES
(1, 'jgdoornbos@gmail.com', '1c1bfd630b099826a75ac30c8784a671c034f4d1', 'Jantine', 'Doornbos', '1992-02-19', 'f', '2014-01-03 11:38:29'),
(2, 'rogiervancann@gmail.com', '096c080806a2ffd4b91b3902f26096af2755d2d2', 'Rogier', 'van Cann', '1989-02-01', 'm', '2014-01-03 11:38:29'),
(3, 'paula@gmail.com', '6a9133896cef6f8609d155b78511607673229e02', 'Paula', 'Zeldenrust', '1986-02-02', 'f', '2014-01-04 17:01:57'),
(4, 'jgdoornbos@gmail.com', '1c1bfd630b099826a75ac30c8784a671c034f4d1', '', '', '0000-00-00', '', '2014-01-04 17:11:36'),
(5, 'janwillem117@gmail.com', '98f54143ab4e86b28c3afee0f50f2f51cfb2ed38', 'JW', 'Sterkenburg', '0000-00-00', 'm', '2014-01-04 17:16:24'),
(6, 'jgdoornbos@hotmail.com', '1c1bfd630b099826a75ac30c8784a671c034f4d1', 'Jantine', 'Doornbos', '1986-02-02', 'f', '2014-01-04 17:18:47'),
(7, 'bullshit@gmail.com', '7971ba9b9d4a9d20e2a323546018ba2833546053', 'Dick', 'Advocaat', '0000-00-00', 'm', '2014-01-05 19:34:13'),
(8, 'bullshit1@gmail.com', 'bc5351ffae3efe8067951f5deba4b294bf863f86', 'Jack', 'Ryan', '0000-00-00', 'm', '2014-01-05 19:37:44'),
(9, 'bullshit2@gmail.com', '247aea86e8a2f0213eca71f26917ed8d0fc282fc', 'Abdu', 'Mohammed', '0000-00-00', 'm', '2014-01-05 19:40:50'),
(10, 'bullshit3@gmail.com', 'aa4a9f786afbc7c3ce73e9e9c77f4a477397adad', 'Antonio', 'Caceres', '0000-00-00', 'm', '2014-01-05 19:44:31'),
(11, 'jemoeder@lul.com', '328cc988b604d8f67b9e8cd2abbc1d443cff1203', 'je', 'moeder', '2012-12-12', 'm', '2014-01-05 19:44:32'),
(12, 'bullshit4@gmail.com', '4beb46d36a8d0d77bfa696083bfeab4b6ee156d4', 'Lee', 'Chan', '0000-00-00', 'm', '2014-01-05 19:50:42'),
(13, 'stevenseagal@clownpenis.fart', '9ce5770b3bb4b2a1d59be2d97e34379cd192299f', 'steven', 'seagal', '2013-11-04', 'm', '2014-01-05 19:52:23'),
(14, 'bullshit5@gmail.com', '16a20b3d6e4f0b9fd1ddd52c24fa7f0c609aa9bb', 'Vladimir', 'Obama', '0000-00-00', 'm', '2014-01-05 19:58:15'),
(16, 'john@gmail.com', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', 'John', 'Doe', '1992-03-01', 'm', '2014-01-06 10:00:50'),
(17, 'john@hotmail.com', '4eea15d8143dab6e4d8b27bfeda7cb6a9129a020', 'John', 'Smith', '1990-02-03', 'f', '2014-01-06 11:36:21'),
(18, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '0000-00-00', '', '2014-01-06 14:12:31'),
(19, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '0000-00-00', '', '2014-01-06 14:15:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
