-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 01 Lis 2016, 22:27
-- Wersja serwera: 5.7.16-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `raporty`
--

CREATE TABLE `raporty` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `contents` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `enabled` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `authKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `raporty`
--

INSERT INTO `raporty` (`id`, `type`, `email`, `nick`, `title`, `contents`, `date`, `time`, `version`, `os`, `enabled`, `source`, `authKey`) VALUES
(2, 0, 'cubasa4@gmail.com', 'fizi', 'update', 'Aplikacja placze caly czas o update oraz update romu z appki, powoduje odwrocony ekran.', '14.08.2016', '14:41', '1.2.0', 'CM13', 'false', 'web', NULL),
(3, 1, 'allegrojacc@gmail.com', 'allegrojacc', 'SD', 'Przydatna byla by mozliwosc pobierania aktualizacji na karte SD. Pozdrawiam ??', '19.08.2016', '23:07', '1.2.3', 'CM13', 'false', 'app', NULL),
(4, 0, 'dawidkxd@gmail.com', 'mkcinek', 'Aktualizacja aplikacji', 'Niemozliwa jest aktualizacja aplikacji.', '04.09.2016', '21:47', '1.2.3', 'CM13', 'false', 'app', NULL),
(5, 0, 'maciej.dx@wp.pl ', 'null', 'cm13', ' pasek wyszukiwania google w google now luncher pokazuje sie w task menagerze zamiast na ekranie glownym ', '05.09.2016 ', '22:03', '1.2.8', 'CM13', 'false', 'app', NULL),
(6, 1, 'superek@amorki.pl', 'Superek', 'Krotkie info', 'Propozycja o dodanie krotkiej notki o najwazniejszych zmianach w danej aktualizacjii (Jesli to mozliwe i fajnie tez byloby jakby bylo po Polsku) Pozdrawiem cieplutko', '30.09.2016', '00:23', '1.2.14', 'CM13', 'false', 'web', NULL),
(7, 0, 'superek@amorki.pl', 'Superek', 'Problem z gifami', 'Witam, gdy probuje otworzyc jakiegos gifa w systemowej aplikacji (Galeria), to Ona wywala sie, a kiedys tak ladnie dzialalo...', '01.10.2016', '16:19', '1.2.14', 'CM13', 'false', 'web', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `raporty`
--
ALTER TABLE `raporty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `raporty`
--
ALTER TABLE `raporty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
