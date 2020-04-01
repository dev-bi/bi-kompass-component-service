-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 31. Mrz 2020 um 16:15
-- Server-Version: 10.1.35-MariaDB
-- PHP-Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db398536_7`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `test_faqs`
--

CREATE TABLE `test_faqs` (
  `id` int(11) NOT NULL,
  `question_short` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_long` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `test_faqs`
--

INSERT INTO `test_faqs` (`id`, `question_short`, `question_long`, `answer`, `link`, `posted`) VALUES
(1, 'Wo finde ich meine PSF?', NULL, 'Siehe unter Navigation PSF', '', '2020-03-31 13:00:00'),
(2, 'Wo finde ich Frau Amina', NULL, 'Frau Amina: Raum 323, NW 10, 3. Stock', 'link/zu/amina', '2020-03-30 11:00:00'),
(3, 'Ich bin zu spät. Was soll ich tun?', NULL, 'Beim Empfang anrufen und Bescheid sagen. Die Telefonnummer: 040/339988', 'link/zu/empfang', '2020-03-30 11:00:00'),
(4, 'Wo ist die Tischlerei?', NULL, 'Rosenallee 21', 'link/zu/Rosenallee/21', '2020-01-02 17:20:00'),
(5, 'Ich schaffe meine Arbeitspakete nicht. Was kann ich tun? An wen kann ich mich wenden?', NULL, 'Antwort, Antwort, Antwort', 'link/zu/antwort-230', '2020-01-02 17:00:00'),
(6, 'Wie melde ich mich bei Kursen an?', NULL, 'Antwort für IaK Kurse', 'link/zu/iak/kurse', '2020-03-30 11:00:00'),
(7, 'Ich habe in zwei Wochen Therapie? Kann ich da einfach fehlen?', NULL, 'Man muss so ein Zettel ausfüllen', 'link/zu/vorlage/Zettel', '2020-03-17 06:00:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `test_faqs`
--
ALTER TABLE `test_faqs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `test_faqs`
--
ALTER TABLE `test_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
