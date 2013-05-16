-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 11 May 2013, 01:09
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
  `data` date NOT NULL,
  `Sciezka` varchar(100) NOT NULL,
  `Cena` float NOT NULL,
  `LiczbaPobran` int(11) DEFAULT NULL,
  `idWlasciciel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArtykul`,`idWydanie`),
  KEY `fk_Artykul_Wydanie1` (`idWydanie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Zrzut danych tabeli `artykul`
--

INSERT INTO `artykul` (`idWydanie`, `idArtykul`, `Tytul`, `data`, `Sciezka`, `Cena`, `LiczbaPobran`, `idWlasciciel`) VALUES
(1, 1, 'gniazda', '2013-04-01', '/xampplite/htdocs/ppz-gazeta/documents/wydanie1/Opcje_gniazd.pdf', 0.1, 2, NULL),
(1, 3, 'serwer', '2013-05-15', '/xampplite/htdocs/ppz-gazeta/documents/wydanie1/Serwer-algorytmy.pdf', 3.5, 1, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`idKoszyk`, `idArtykul`, `idUzytkownik`) VALUES
(93, 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `ogloszenie`
--

CREATE TABLE IF NOT EXISTS `ogloszenie` (
  `idOgloszenie` int(11) NOT NULL AUTO_INCREMENT,
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
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
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
  `idRola` int(11) NOT NULL AUTO_INCREMENT,
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
  `idZamowienie` int(11) NOT NULL AUTO_INCREMENT,
  `Cena` float DEFAULT NULL,
  PRIMARY KEY (`idArtykul`,`idZamowienie`),
  KEY `fk_Szczegoly_zam_Artykul1` (`idArtykul`),
  KEY `fk_Szczegoly_zam_Zamowienie1` (`idZamowienie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `szczegoly_zam`
--

INSERT INTO `szczegoly_zam` (`idArtykul`, `idZamowienie`, `Cena`) VALUES
(1, 6, 0.1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
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
  `usuniety` int(11) DEFAULT 0,
  PRIMARY KEY (`idUzytkownik`),
  KEY `fk_Uzytkownik_Rola1` (`idRola`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`idUzytkownik`, `Login`, `Haslo`, `Imie`, `Nazwisko`, `Email`, `idRola`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Adam', 'Kowalski', 'akowalski@poczta.pl', 3),
(2, 'redaktor', 'fc732c7f3293285356b13570bf6a87fd', 'Jan', 'Nowak', 'jnowak@poczta.pl', 2),
(3, 'czytelnik', 'cd81536c245e62f9db678b240e1b0085', 'Jerzy', 'Potocki', 'dominikkosciesza@gmail.com', 1),
(4, 'litewska', 'bea51bc8d38b9a608b35e515fa63a0bf', 'Maria', 'Litewska', 'mlitewska@poczta.pl', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `wydanie`
--

CREATE TABLE IF NOT EXISTS `wydanie` (
  `idWydanie` int(11) NOT NULL AUTO_INCREMENT,
  `Tytul` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `Cena` float NOT NULL,
  `SciezkaZdjecia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idWydanie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `wydanie`
--

INSERT INTO `wydanie` (`idWydanie`, `Tytul`, `data`, `Cena`, `SciezkaZdjecia`) VALUES
(1, 'Wydanie 1', '2013-04-01', 13.5, '/ppz-gazeta/images/mini/item0.jpg'),
(2, 'Wydanie 2', '2013-04-09', 56, '/ppz-gazeta/images/mini/item1.jpg'),
(3, 'Wydanie 3', '2013-04-16', 45.45, '/ppz-gazeta/images/mini/item0.jpg'),
(4, 'Wydanie 4', '2013-04-02', 67, '/ppz-gazeta/images/mini/item1.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `zamowienie`
--

CREATE TABLE IF NOT EXISTS `zamowienie` (
  `idZamowienie` int(11) NOT NULL AUTO_INCREMENT,
  `Cena` float DEFAULT NULL,
  `idUzytkownik` int(11) NOT NULL,
  PRIMARY KEY (`idZamowienie`),
  KEY `fk_Zamowienie_Uzytkownik1` (`idUzytkownik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `zamowienie`
--

INSERT INTO `zamowienie` (`idZamowienie`, `Cena`, `idUzytkownik`) VALUES
(3, 3.6, 3),
(6, 0.1, 3);

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
