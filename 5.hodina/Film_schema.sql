-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 24. úno 2023, 15:59
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `filmskola`
--
CREATE DATABASE filmskola;

USE filmskola;
-- --------------------------------------------------------

--
-- Struktura tabulky `film`
--



CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) DEFAULT NULL,
  `popis` text DEFAULT NULL,
  `delka` int(11) DEFAULT NULL,
  `datum_vydani` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `film_herec`
--

CREATE TABLE `film_herec` (
  `film_id` int(11) NOT NULL,
  `herec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `film_kategorie`
--

CREATE TABLE `film_kategorie` (
  `film_id` int(11) NOT NULL,
  `kategorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `film_oceneni`
--

CREATE TABLE `film_oceneni` (
  `film_id` int(11) NOT NULL,
  `oceneni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `herec`
--

CREATE TABLE `herec` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(255) DEFAULT NULL,
  `prijmeni` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) DEFAULT NULL,
  `popis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `oceneni`
--

CREATE TABLE `oceneni` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) DEFAULT NULL,
  `popis` text DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `misto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `film_herec`
--
ALTER TABLE `film_herec`
  ADD PRIMARY KEY (`film_id`,`herec_id`),
  ADD KEY `herec_id` (`herec_id`);

--
-- Indexy pro tabulku `film_kategorie`
--
ALTER TABLE `film_kategorie`
  ADD PRIMARY KEY (`film_id`,`kategorie_id`),
  ADD KEY `kategorie_id` (`kategorie_id`);

--
-- Indexy pro tabulku `film_oceneni`
--
ALTER TABLE `film_oceneni`
  ADD PRIMARY KEY (`film_id`,`oceneni_id`),
  ADD KEY `oceneni_id` (`oceneni_id`);

--
-- Indexy pro tabulku `herec`
--
ALTER TABLE `herec`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `oceneni`
--
ALTER TABLE `oceneni`
  ADD PRIMARY KEY (`id`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `film_herec`
--
ALTER TABLE `film_herec`
  ADD CONSTRAINT `film_herec_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `film_herec_ibfk_2` FOREIGN KEY (`herec_id`) REFERENCES `herec` (`id`);

--
-- Omezení pro tabulku `film_kategorie`
--
ALTER TABLE `film_kategorie`
  ADD CONSTRAINT `film_kategorie_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `film_kategorie_ibfk_2` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`);

--
-- Omezení pro tabulku `film_oceneni`
--
ALTER TABLE `film_oceneni`
  ADD CONSTRAINT `film_oceneni_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `film_oceneni_ibfk_2` FOREIGN KEY (`oceneni_id`) REFERENCES `oceneni` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
