-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 22 Kwi 2013, 21:38
-- Wersja serwera: 5.5.16
-- Wersja PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `gazeta`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `artykul`
--

CREATE TABLE IF NOT EXISTS `artykul` (
  `idWydanie` int(11) NOT NULL,
  `idArtykul` int(11) NOT NULL AUTO_INCREMENT,
  `Tytul` varchar(200) NOT NULL,
  `Sciezka` varchar(100) NOT NULL,
  `Cena` int(11) NOT NULL,
  `LiczbaPobran` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArtykul`,`idWydanie`),
  KEY `fk_Artykul_Wydanie1` (`idWydanie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `koszyk`
--

CREATE TABLE IF NOT EXISTS `koszyk` (
  `idKoszyk` int(11) NOT NULL AUTO_INCREMENT,
  `idArtykul` int(11) NOT NULL,
  `idUzytkownik` int(11) NOT NULL,
  PRIMARY KEY (`idKoszyk`),
  KEY `fk_Koszyk_Artykul1` (`idArtykul`),
  KEY `fk_Koszyk_Uzytkownik1` (`idUzytkownik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `ogloszenie`
--

CREATE TABLE IF NOT EXISTS `ogloszenie` (
  `idOgloszenie` int(11) NOT NULL,
  `idUzytkownik` int(11) NOT NULL,
  `Sciezka` varchar(100) NOT NULL,
  PRIMARY KEY (`idOgloszenie`),
  KEY `fk_Ogloszenie_Uzytkownik1` (`idUzytkownik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `otagowanie`
--

CREATE TABLE IF NOT EXISTS `otagowanie` (
  `idTag` int(11) NOT NULL,
  `idArtykul` int(11) NOT NULL,
  PRIMARY KEY (`idTag`,`idArtykul`),
  KEY `fk_Otagowanie_Tag1` (`idTag`),
  KEY `fk_Otagowanie_Artykul1` (`idArtykul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `rola`
--

CREATE TABLE IF NOT EXISTS `rola` (
  `idRola` int(11) NOT NULL,
  `Nazwa` varchar(45) NOT NULL,
  PRIMARY KEY (`idRola`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `rola`
--

INSERT INTO `rola` (`idRola`, `Nazwa`) VALUES
(1, 'Czytelnik'),
(2, 'Redaktor'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `szczegoly_zam`
--

CREATE TABLE IF NOT EXISTS `szczegoly_zam` (
  `idArtykul` int(11) NOT NULL,
  `idZamowienie` int(11) NOT NULL,
  `Cena` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArtykul`,`idZamowienie`),
  KEY `fk_Szczegoly_zam_Artykul1` (`idArtykul`),
  KEY `fk_Szczegoly_zam_Zamowienie1` (`idZamowienie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `idTag` int(11) NOT NULL,
  `Nazwa` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `uzytkownik`
--

CREATE TABLE IF NOT EXISTS `uzytkownik` (
  `idUzytkownik` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(45) NOT NULL,
  `Haslo` char(50) NOT NULL,
  `Imie` varchar(45) DEFAULT NULL,
  `Nazwisko` varchar(45) DEFAULT NULL,
  `Email` varchar(45) NOT NULL,
  `idRola` int(11) NOT NULL,
  PRIMARY KEY (`idUzytkownik`),
  KEY `fk_Uzytkownik_Rola1` (`idRola`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`idUzytkownik`, `Login`, `Haslo`, `Imie`, `Nazwisko`, `Email`, `idRola`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Adam', 'Kowalski', 'akowalski@poczta.pl', 3),
(2, 'redaktor', 'fc732c7f3293285356b13570bf6a87fd', 'Jan', 'Nowak', 'jnowak@poczta.pl', 2),
(3, 'czytelnik', 'cd81536c245e62f9db678b240e1b0085', 'Jerzy', 'Potocki', 'jpotocki@poczta.pl', 1),
(4, 'litewska', 'bea51bc8d38b9a608b35e515fa63a0bf', 'Maria', 'Litewska', 'mlitewska@poczta.pl', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `wydanie`
--

CREATE TABLE IF NOT EXISTS `wydanie` (
  `idWydanie` int(11) NOT NULL,
  `Cena` int(11) NOT NULL,
  `SciezkaZdjecia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idWydanie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `zamowienie`
--

CREATE TABLE IF NOT EXISTS `zamowienie` (
  `idZamowienie` int(11) NOT NULL AUTO_INCREMENT,
  `Cena` int(11) DEFAULT NULL,
  `idUzytkownik` int(11) NOT NULL,
  PRIMARY KEY (`idZamowienie`),
  KEY `fk_Zamowienie_Uzytkownik1` (`idUzytkownik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `artykul`
--
ALTER TABLE `artykul`
  ADD CONSTRAINT `fk_Artykul_Wydanie1` FOREIGN KEY (`idWydanie`) REFERENCES `wydanie` (`idWydanie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `fk_Koszyk_Artykul1` FOREIGN KEY (`idArtykul`) REFERENCES `artykul` (`idArtykul`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Koszyk_Uzytkownik1` FOREIGN KEY (`idUzytkownik`) REFERENCES `uzytkownik` (`idUzytkownik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `ogloszenie`
--
ALTER TABLE `ogloszenie`
  ADD CONSTRAINT `fk_Ogloszenie_Uzytkownik1` FOREIGN KEY (`idUzytkownik`) REFERENCES `uzytkownik` (`idUzytkownik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `otagowanie`
--
ALTER TABLE `otagowanie`
  ADD CONSTRAINT `fk_Otagowanie_Artykul1` FOREIGN KEY (`idArtykul`) REFERENCES `artykul` (`idArtykul`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Otagowanie_Tag1` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `szczegoly_zam`
--
ALTER TABLE `szczegoly_zam`
  ADD CONSTRAINT `fk_Szczegoly_zam_Artykul1` FOREIGN KEY (`idArtykul`) REFERENCES `artykul` (`idArtykul`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Szczegoly_zam_Zamowienie1` FOREIGN KEY (`idZamowienie`) REFERENCES `zamowienie` (`idZamowienie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `fk_Uzytkownik_Rola1` FOREIGN KEY (`idRola`) REFERENCES `rola` (`idRola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `fk_Zamowienie_Uzytkownik1` FOREIGN KEY (`idUzytkownik`) REFERENCES `uzytkownik` (`idUzytkownik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
