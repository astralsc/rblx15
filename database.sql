-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2026 at 09:51 AM
-- Server version: 5.7.11
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rblx15`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_tokens`
--
CREATE TABLE `active_tokens` (
`cookie` char(128),
`userid` int(10) unsigned,
`username` varchar(100),
`expiresOn` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `cookie` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `expiresOn` int(10) UNSIGNED NOT NULL,
  `createdAt` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`cookie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gameName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gameDesc` text COLLATE utf8mb4_unicode_ci,
  `gameIp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `owner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ownerid` int(10) UNSIGNED DEFAULT NULL,
  `client` smallint(6) DEFAULT NULL,
  `createdAt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`gameId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `robux` int(11) NOT NULL DEFAULT '0',
  `hasBC` tinyint(1) NOT NULL DEFAULT '0',
  `has2FA` tinyint(1) NOT NULL DEFAULT '0',
  `createdAt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastLogin` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `active_tokens`
--
DROP TABLE IF EXISTS `active_tokens`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_tokens` AS
select
  `c`.`cookie` AS `cookie`,
  `c`.`userid` AS `userid`,
  `u`.`username` AS `username`,
  `c`.`expiresOn` AS `expiresOn`
from (`cookies` `c`
left join `users` `u`
on((`u`.`userid` = `c`.`userid`)))
where (`c`.`expiresOn` > unix_timestamp());

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD KEY `idx_cookies_userid` (`userid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD KEY `idx_games_ownerid` (`ownerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `uq_users_username` (`username`),
  ADD KEY `idx_users_createdAt` (`createdAt`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cookies`
--
ALTER TABLE `cookies`
  ADD CONSTRAINT `fk_cookies_user`
  FOREIGN KEY (`userid`)
  REFERENCES `users` (`userid`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_owner`
  FOREIGN KEY (`ownerid`)
  REFERENCES `users` (`userid`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
