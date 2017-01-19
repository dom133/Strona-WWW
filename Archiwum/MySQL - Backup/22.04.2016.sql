-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Kwi 2016, 15:30
-- Wersja serwera: 10.1.9-MariaDB
-- Wersja PHP: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `skymin_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `authme`
--

CREATE TABLE `authme` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '127.0.0.1',
  `lastlogin` bigint(20) NOT NULL DEFAULT '1431956756981',
  `x` double NOT NULL DEFAULT '0',
  `y` double NOT NULL DEFAULT '0',
  `z` double NOT NULL DEFAULT '0',
  `world` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'world',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'your@email.com',
  `isLogged` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `authme`
--

INSERT INTO `authme` (`id`, `username`, `password`, `ip`, `lastlogin`, `x`, `y`, `z`, `world`, `email`, `isLogged`) VALUES
(1, 'dom133', '401cd4fbff221a095b6af1e43bfeeb11183ca0d9', '127.0.0.1', 1431956756981, 0, 0, 0, 'world', 'dom133_pl@wp.pl', 0),
(2, 'Pawel', '1b9d971f371551c7d12acf08e3759cdb99d85e71', '127.0.0.1', 1431956756981, 0, 0, 0, 'world', 'dominik-kruszeski@wp.pl', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `inqplayers`
--

CREATE TABLE `inqplayers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastJoin` timestamp NULL DEFAULT NULL,
  `mapped` longtext,
  `totalItemsPickedUp` int(11) DEFAULT '0',
  `totalDistanceTraveled` float DEFAULT '0',
  `lastKick` timestamp NULL DEFAULT NULL,
  `lavaBucketsEmptied` int(11) DEFAULT '0',
  `totalMobsKilled` int(11) DEFAULT '0',
  `lastKickMessage` varchar(255) DEFAULT NULL,
  `portalsCrossed` int(11) DEFAULT '0',
  `sessionTime` float DEFAULT '0',
  `level` int(11) DEFAULT '0',
  `mooshroomsMilked` int(11) DEFAULT '0',
  `potionEffects` longtext,
  `deaths` int(11) DEFAULT '0',
  `foodLevel` int(11) DEFAULT '0',
  `lastMobKill` timestamp NULL DEFAULT NULL,
  `groups` longtext,
  `chatMessages` int(11) DEFAULT '0',
  `joins` int(11) DEFAULT '0',
  `waterBucketsEmptied` int(11) DEFAULT '0',
  `totalBlocksPlaced` int(11) DEFAULT '0',
  `lastDeathMessage` varchar(255) DEFAULT NULL,
  `lastQuit` timestamp NULL DEFAULT NULL,
  `firstJoin` timestamp NULL DEFAULT NULL,
  `health` int(11) DEFAULT '0',
  `totalPlayersKilled` int(11) DEFAULT '0',
  `lastDeath` timestamp NULL DEFAULT NULL,
  `mooshroomsSheared` int(11) DEFAULT '0',
  `timesSlept` int(11) DEFAULT '0',
  `arrowsShot` int(11) DEFAULT '0',
  `exp` float DEFAULT '0',
  `itemsEnchanted` int(11) DEFAULT '0',
  `lifetimeExperience` int(11) DEFAULT '0',
  `uuid` varchar(36) DEFAULT NULL,
  `totalTime` float DEFAULT '0',
  `sheepDyed` int(11) DEFAULT '0',
  `totalExperience` int(11) DEFAULT '0',
  `remainingAir` int(11) DEFAULT '0',
  `exhaustion` float DEFAULT '0',
  `armor` longtext,
  `sheepSheared` int(11) DEFAULT '0',
  `online` tinyint(1) DEFAULT '0',
  `money` double DEFAULT '0',
  `lavaBucketsFilled` int(11) DEFAULT '0',
  `totalItemsCrafted` int(11) DEFAULT '0',
  `itemEnchantmentLevels` int(11) DEFAULT '0',
  `bedServer` varchar(50) DEFAULT NULL,
  `bedCoords` varchar(100) DEFAULT NULL,
  `quits` int(11) DEFAULT '0',
  `firesStarted` int(11) DEFAULT '0',
  `totalBlocksBroken` int(11) DEFAULT '0',
  `fishCaught` int(11) DEFAULT '0',
  `heldItemSlot` int(11) DEFAULT '0',
  `lastPlayerKilled` varchar(30) DEFAULT NULL,
  `fireTicks` int(11) DEFAULT '0',
  `lastPlayerKill` timestamp NULL DEFAULT NULL,
  `totalItemsDropped` int(11) DEFAULT '0',
  `gameMode` varchar(15) DEFAULT NULL,
  `cowsMilked` int(11) DEFAULT '0',
  `coords` varchar(100) DEFAULT NULL,
  `lastMobKilled` varchar(30) DEFAULT NULL,
  `saturation` float DEFAULT '0',
  `address` varchar(40) DEFAULT NULL,
  `inventory` longtext,
  `waterBucketsFilled` int(11) DEFAULT '0',
  `server` varchar(50) DEFAULT NULL,
  `displayName` varchar(255) DEFAULT NULL,
  `world` varchar(50) DEFAULT NULL,
  `ender` longtext,
  `bedWorld` varchar(50) DEFAULT NULL,
  `kicks` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logi`
--

CREATE TABLE `logi` (
  `id` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `godzina` varchar(255) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `gdzie` varchar(255) NOT NULL,
  `co` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `minertech`
--

CREATE TABLE `minertech` (
  `ID` int(11) NOT NULL,
  `UUID` varchar(255) DEFAULT NULL,
  `FIRST_NICK` varchar(255) DEFAULT NULL,
  `EXP` varchar(255) DEFAULT NULL,
  `LVL` varchar(255) DEFAULT NULL,
  `REWARDS` varchar(255) DEFAULT NULL,
  `ACHIEVEMENT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `minertech`
--

INSERT INTO `minertech` (`ID`, `UUID`, `FIRST_NICK`, `EXP`, `LVL`, `REWARDS`, `ACHIEVEMENT`) VALUES
(1, '9d36bf26-c814-39e8-9782-142f98ea6508', 'dom133', '580', '1', 'empty', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `nazwa_news` varchar(255) NOT NULL,
  `tresc_news` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `godzina` varchar(255) NOT NULL,
  `edytowany` varchar(255) NOT NULL,
  `data_edycji` varchar(255) DEFAULT NULL,
  `godzina_edycji` varchar(255) DEFAULT NULL,
  `kto_edytowal` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `Session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Poziom` int(11) NOT NULL,
  `Klucz_a` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Aktywne` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_account` int(11) DEFAULT NULL,
  `nick` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`Session_id`, `User`, `Poziom`, `Klucz_a`, `Aktywne`, `avatar`, `account_type`, `login`, `password`, `id_account`, `nick`) VALUES
('KdF4Dgg9tpg8zaMfKunepOcinaM01X', 'dom133', 2, 'PEOJAsi8C8oHsIjk2RMmOC2EMCJxpZ0NF0QS2nsyrdhamJHBNz', 'nie', NULL, NULL, NULL, NULL, 1, 'dom133'),
('2UjNmit14NkubDLdlw6FED9NGKh6x6', 'Pawel', 0, 'RNAp533AysIeAxIA5cDljQzLaP5y1chTC5MxnWFF0Gx4fSrUxp', 'nie', NULL, NULL, NULL, NULL, 2, 'dom133');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `authme`
--
ALTER TABLE `authme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `inqplayers`
--
ALTER TABLE `inqplayers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `logi`
--
ALTER TABLE `logi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minertech`
--
ALTER TABLE `minertech`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `authme`
--
ALTER TABLE `authme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `inqplayers`
--
ALTER TABLE `inqplayers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `logi`
--
ALTER TABLE `logi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `minertech`
--
ALTER TABLE `minertech`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
