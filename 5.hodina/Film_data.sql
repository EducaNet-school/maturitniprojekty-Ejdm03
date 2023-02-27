-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 24. úno 2023, 16:00
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

--
-- Vypisuji data pro tabulku `film`
--

INSERT INTO `film` (`id`, `nazev`, `popis`, `delka`, `datum_vydani`) VALUES
(1, 'Mission: Impossible - Fallout', 'Ethan Hunt and his IMF team race against time to recover stolen plutonium', 147, '2018-07-12'),
(2, 'The Devil Wears Prada', 'A young woman lands a job as an assistant to a powerful fashion magazine editor', 109, '2006-06-30'),
(3, 'The Godfather', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son', 175, '1972-03-24'),
(4, 'Inception', 'A thief who steals corporate secrets through the use of dream-sharing technology', 148, '2010-07-16'),
(5, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival', 169, '2014-11-07'),
(6, 'Jumanji: Welcome to the Jungle', 'Four teenagers are sucked into a magical video game, and the only way they can escape is to work together', 119, '2017-12-20');


--
-- Vypisuji data pro tabulku `herec`
--

INSERT INTO `herec` (`id`, `jmeno`, `prijmeni`) VALUES
(1, 'Tom', 'Cruise'),
(2, 'Meryl', 'Streep'),
(3, 'Robert', 'De Niro'),
(4, 'Leonardo', 'DiCaprio'),
(5, 'Angelina', 'Jolie'),
(6, 'Dwayne', 'Johnson'),
(7, 'Gal', 'Gadot'),
(8, 'Jennifer', 'Lawrence');

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazev`, `popis`) VALUES
(1, 'Action', 'Movies with high intensity action scenes'),
(2, 'Comedy', 'Movies that are meant to be funny'),
(3, 'Drama', 'Movies with serious or intense themes'),
(4, 'Sci-Fi', 'Movies with futuristic or scientific themes');

--
-- Vypisuji data pro tabulku `oceneni`
--

INSERT INTO `oceneni` (`id`, `nazev`, `popis`, `datum`, `misto`) VALUES
(1, 'Oscar for Best Picture', 'Award for Best Picture at the Academy Awards', '2022-03-27', 'Los Angeles'),
(2, 'Golden Globe for Best Actress', 'Award for Best Actress at the Golden Globe Awards', '2022-01-09', 'Beverly Hills'),
(3, 'Cannes Film Festival Palme d\'Or', 'Award for Best Picture at the Cannes Film Festival', '2022-05-22', 'Cannes');






--
-- Vypisuji data pro tabulku `film_herec`
--

INSERT INTO `film_herec` (`film_id`, `herec_id`) VALUES
(1, 1),
(1, 5),
(2, 2),
(2, 8),
(3, 2),
(3, 3),
(4, 2),
(4, 3),
(4, 4),
(4, 8),
(5, 2),
(5, 4),
(6, 6),
(6, 7),
(6, 8);

--
-- Vypisuji data pro tabulku `film_kategorie`
--

INSERT INTO `film_kategorie` (`film_id`, `kategorie_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 3),
(3, 4),
(4, 1),
(4, 4),
(5, 4),
(6, 1),
(6, 2),
(6, 4);

--
-- Vypisuji data pro tabulku `film_oceneni`
--

INSERT INTO `film_oceneni` (`film_id`, `oceneni_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1),
(5, 1),
(5, 3),
(6, 2);



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
