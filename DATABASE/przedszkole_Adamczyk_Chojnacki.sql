-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2023, 22:49
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `przedszkole_adamczyk_chojnacki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `Account_types_id` int(10) UNSIGNED NOT NULL,
  `Groups_id` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(45) NOT NULL,
  `passphrase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`id`, `Account_types_id`, `Groups_id`, `login`, `passphrase`) VALUES
(4, 1, NULL, 'Admin', 'e3afed0047b08059d0fada10f400c1e5'),
(5, 2, 1, 'J.Nowak', 'ef95a18332efaf28581f31b66d5557d3'),
(6, 2, 2, 'S.Ogórek', '2f586d8879de9cfee669b0decac10eee'),
(7, 2, 3, 'H.Zając', '4ca9f73077a9b89283a56dcfff0037bf');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `account_types`
--

CREATE TABLE `account_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `account_types`
--

INSERT INTO `account_types` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'teacher'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `children`
--

CREATE TABLE `children` (
  `id` int(10) UNSIGNED NOT NULL,
  `Groups_id` int(10) UNSIGNED NOT NULL,
  `Parents_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `PESEL` varchar(11) NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `children`
--

INSERT INTO `children` (`id`, `Groups_id`, `Parents_id`, `first_name`, `last_name`, `PESEL`, `gender`) VALUES
(1, 1, 1, 'Karol', 'Szczepanik', '20292943399', 'm'),
(3, 1, 3, 'Katarzyna', 'Szustak', '75011228723', 'f'),
(4, 1, 3, 'Maria', 'Szustak', '32092710833', 'f'),
(5, 1, 3, 'Andrzej', 'Szustak', '27022433144', 'm'),
(6, 1, 4, 'Wiktoria', 'Kalinowska', '32051012802', 'f'),
(7, 1, 4, 'Michał', 'Kalinowski', '26100925588', 'm'),
(8, 1, 5, 'Michalina', 'Krawczyk', '00302715813', 'f'),
(9, 1, 6, 'Konrad', 'Wolański', '49101556816', 'm'),
(10, 1, 7, 'Konrad', 'Bohdanowicz', '62041111552', 'm'),
(11, 1, 8, 'Weronika', 'Bogdańska', '01260482225', 'f'),
(12, 2, 9, 'Dorota', 'Małek', '08301455422', 'f'),
(13, 2, 10, 'Mirosław', 'Kowal', '80042211385', 'm'),
(14, 2, 11, 'Mirosław', 'Więtek', '70031548550', 'm'),
(15, 2, 11, 'Michał', 'Więtek', '68100202672', 'm'),
(16, 2, 12, 'Karolina', 'Wrońska', '88110288008', 'f'),
(17, 2, 12, 'Katarzyna', 'Wrońska', '97040368834', 'f'),
(18, 2, 13, 'Krzysztof', 'Malinowski', '86041767810', 'm'),
(19, 2, 13, 'Marek', 'Malinowski', '41080503078', 'm'),
(20, 2, 14, 'Mariola', 'Małecka', '80012131510', 'f'),
(21, 3, 15, 'Wioletta', 'Matusiak', '42101136318', 'f'),
(22, 3, 15, 'Michalina', 'Matusiak', '35081350401', 'f'),
(23, 3, 16, 'Mariusz', 'Banaszkiewicz', '85102181673', 'm'),
(24, 3, 16, 'Karol', 'Banaszkiewicz', '09282011085', 'm'),
(25, 3, 17, 'Wiktor', 'Banaś', '47050306335', 'm'),
(26, 3, 17, 'Dorian', 'Banaś', '51080284712', 'm'),
(27, 3, 18, 'Wojciech', 'Karasiński', '23251270530', 'm'),
(28, 3, 18, 'Daria', 'Karasińska', '06240914583', 'f'),
(29, 3, 19, 'Patryk', 'Więckowski', '53080731843', 'm'),
(30, 3, 19, 'Marta', 'Więckowska', '80021441486', 'f'),
(31, 3, 20, 'Lidia', 'Adamczyk', '91012653762', 'f'),
(32, 3, 20, 'Hanna', 'Adamczyk', '02281823811', 'f'),
(33, 3, 20, 'Michał', 'Adamczyk', '13240844132', 'm'),
(34, 3, 5, 'Andrzej', 'Krawczyk', '47062312531', 'm'),
(35, 3, 5, 'Makary', 'Krawczyk', '73062650876', 'm'),
(36, 3, 8, 'Karol', 'Bogdański', '13242206305', 'm'),
(37, 3, 8, 'Karol', 'Bogdański', '52030553104', 'm'),
(38, 2, 21, 'Kamil', 'Gieragus', '17322312531', 'm');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `name`, `details`) VALUES
(1, 'Ladybugs', NULL),
(2, 'Daisies', NULL),
(3, 'Strawberries', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parents`
--

CREATE TABLE `parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `gender` char(1) NOT NULL,
  `zip_code` varchar(6) NOT NULL,
  `city` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `parents`
--

INSERT INTO `parents` (`id`, `first_name`, `last_name`, `phone_number`, `gender`, `zip_code`, `city`, `street`) VALUES
(1, 'Jan', 'Szczepanik', '894039246', 'm', '78-102', 'Kołobrzeg', 'ul. Tarnopolska 3'),
(3, 'Karol', 'Szustak', '517981800', 'm', '78-101', 'Kołobrzeg', 'ul. Przyrodnicza 15'),
(4, 'Dorota', 'Kalinowska', '211337944', 'f', '78-100', 'Kołobrzeg', 'ul. Warszawska 12'),
(5, 'Adam', 'Krawczyk', '212484974', 'm', '78-103', 'Kołobrzeg', 'ul. Armii Krajowej 42'),
(6, 'Anastazja', 'Wolańska', '455873083', 'f', '78-104', 'Kołobrzeg', 'ul. Zachodnia 93'),
(7, 'Marcelina', 'Bohdanowicz', '519843626', 'f', '78-105', 'Kołobrzeg', 'ul. Kwiatowa 110'),
(8, 'Mariola', 'Bogdańska', '503551888', 'f', '78-106', 'Kołobrzeg', 'ul. Jodłowa 11'),
(9, 'Karolina', 'Małek', '458906015', 'f', '78-107', 'Kołobrzeg', 'ul. Stalowa 83'),
(10, 'Mariusz', 'Kowal', '212301918', 'm', '78-108', 'Kołobrzeg', 'ul. Liliowa 99'),
(11, 'Jarosław', 'Więtek', '212273549', 'm', '78-110', 'Kołobrzeg', 'ul. Kaszubska 5'),
(12, 'Weronika', 'Wrońska', '516340621', 'f', '78-111', 'Kołobrzeg', 'ul. Kulowa 5'),
(13, 'Klaudia', 'Malinowska', '458656141', 'f', '78-112', 'Kołobrzeg', 'ul. Polna 73'),
(14, 'Dariusz', 'Małecki', '211519892', 'm', '78-114', 'Kołobrzeg', 'ul. Kłodzka 55'),
(15, 'Konrad', 'Matusiak', '532429882', 'm', '78-115', 'Kołobrzeg', 'ul. Maślana 52'),
(16, 'Michał', 'Banaszkiewicz', '531115791', 'm', '78-116', 'Kołobrzeg', 'ul. Koślawa 42'),
(17, 'Marcin', 'Banaś', '602557991', 'm', '78-118', 'Kołobrzeg', 'ul. Karlińskiego 44'),
(18, 'Antoni', 'Karasiński', '212479964', 'm', '78-119', 'Kołobrzeg', 'ul. Piotrkowska 81'),
(19, 'Wiktor', 'Więckowski', '452877201', 'm', '78-122', 'Kołobrzeg', 'ul. Akacjowa 150'),
(20, 'Wojciech', 'Adamczyk', '212403328', 'm', '78-123', 'Kołobrzeg', 'ul. Kilińskiego 11'),
(21, 'Paweł', 'Gieragus', '345235123', 'm', '78-092', 'Kołobrzeg', 'ul. Zielona 38');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `Groups_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `teachers`
--

INSERT INTO `teachers` (`id`, `Groups_id`, `first_name`, `last_name`, `phone_number`, `gender`) VALUES
(1, 1, 'Joanna', 'Nowak', '560932562', 'k'),
(2, 2, 'Stanisław', 'Ogórek', '734090340', 'm'),
(3, 3, 'Helena', 'Zając', '645053451', 'k');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`,`Account_types_id`),
  ADD KEY `Accounts_FKIndex1` (`Account_types_id`),
  ADD KEY `Accounts_FKIndex2` (`Groups_id`);

--
-- Indeksy dla tabeli `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`,`Groups_id`,`Parents_id`),
  ADD KEY `Children_FKIndex1` (`Parents_id`),
  ADD KEY `Children_FKIndex2` (`Groups_id`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`,`Groups_id`),
  ADD KEY `Teachers_FKIndex1` (`Groups_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `children`
--
ALTER TABLE `children`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
