-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.3:3306
-- Erstellungszeit: 31. Mrz 2020 um 16:05
-- Server-Version: 5.6.19-67.0-log
-- PHP-Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `adress`, `area`, `description`) VALUES
(1, 'Nagelsweg 10', 'BüMe, Hauswirtschaft, andere', 'Hauptgebäude. Anmeldung etc ...'),
(2, 'Nagelsweg 14', 'Buchhaltung, IT', 'Blabla');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `persons`
--

INSERT INTO `persons` (`id`, `name`, `first_name`, `function`, `room_id`) VALUES
(4, 'Siewert', 'Gudrun', 'PSF', 7),
(5, 'Kronhagen', 'Friedrich', 'Berufliche Weiterbildung', 8),
(6, 'Adenauer', 'Konrad', 'Fachbereich-Leitung BüMe', 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `number_string` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `rooms`
--

INSERT INTO `rooms` (`id`, `location_id`, `floor`, `number`, `number_string`, `function`) VALUES
(1, 1, 2, 203, 'R-203', 'Büro'),
(2, 2, -1, 0, 'Neuhafen', 'IT'),
(3, 1, 3, 310, 'R-310', 'Vario TN Raum'),
(4, 1, 0, 0, 'Haupteingangsbereich', 'Eingang'),
(5, 1, 1, 101, 'R-101', 'Anmeldung'),
(6, 1, 1, 102, 'R-102', 'Büro'),
(7, 1, 1, 103, 'R-103', 'Abstellkammer'),
(8, 1, 1, 104, 'R-104', 'Büro'),
(9, 1, 1, 105, 'R-105', 'Büro'),
(10, 1, 1, 106, 'R-106', 'Konferenzraum'),
(11, 1, 1, 107, 'R-107', 'Büro'),
(12, 1, 1, 108, 'R-108', 'Büro'),
(13, 1, 1, 109, 'R-109', 'Kopierraum'),
(14, 1, 1, 110, 'R-110 \"Frau Özdemir\"', 'Büro'),
(15, 1, 1, 111, 'R-111', 'Büro');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indizes für die Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints der Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
