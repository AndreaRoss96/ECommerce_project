-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 19, 2019 alle 14:37
-- Versione del server: 10.3.8-MariaDB
-- Versione PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progettotweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitori`
--

CREATE TABLE `fornitori` (
  `P_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `nomeRistorante` varchar(25) COLLATE utf8_bin NOT NULL,
  `nomeReferente` varchar(20) COLLATE utf8_bin NOT NULL,
  `cognomeReferente` varchar(20) COLLATE utf8_bin NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(20) COLLATE utf8_bin NOT NULL,
  `indirizzoMaps` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` varchar(35) COLLATE utf8_bin NOT NULL,
  `orarioApertura` varchar(5) COLLATE utf8_bin NOT NULL,
  `orarioChiusura` varchar(5) COLLATE utf8_bin NOT NULL,
  `approvazioneAmministratore` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `fornitori`
--

INSERT INTO `fornitori` (`P_IVA`, `nomeRistorante`, `nomeReferente`, `cognomeReferente`, `descrizione`, `telefono`, `indirizzoMaps`, `email`, `password`, `orarioApertura`, `orarioChiusura`, `approvazioneAmministratore`) VALUES
('1234567890', 'Da Chiccho', '', '', 'sopra la panca la capra canta', '', 'Via Cecchi Paone 54, Cesena, Italia', 'federico.rossi@chicco.it', 'ciao', '08:00', '24:00', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `portata`
--

CREATE TABLE `portata` (
  `id` int(11) NOT NULL,
  `ristP_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `nome` varchar(25) COLLATE utf8_bin NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_bin NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `portata`
--

INSERT INTO `portata` (`id`, `ristP_IVA`, `nome`, `descrizione`, `prezzo`) VALUES
(8, '1234567890', 'sashimi', 'CALLEGATI.', 1),
(9, '1234567890', 'coro', 'uomo', 12),
(10, '1234567890', 'cazzi', 'asuihfasf\r\nasijfsajif\r\naisjfia\r\nsfjifasf', 12),
(11, '1234567890', 'Carbonara', 'pasta, guanciale, tuorli, pecorino romano, sale fino, pepe nero.', 7),
(12, '1234567890', 'cazzi', 'asuihfasf\r\nasijfsajif\r\naisjfia\r\nsfjifasf', 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--

CREATE TABLE `tag` (
  `nomeTag` varchar(20) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `tag`
--

INSERT INTO `tag` (`nomeTag`, `id`) VALUES
('Antipasto', 3),
('Primo', 4),
('Secondo', 5),
('Contorno', 6),
('Dessert', 7),
('Carne', 8),
('Pesce', 9),
('Vegano', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `tagportata`
--

CREATE TABLE `tagportata` (
  `idPortata` int(11) NOT NULL,
  `ristP_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `tagportata`
--

INSERT INTO `tagportata` (`idPortata`, `ristP_IVA`, `idTag`) VALUES
(7, '1234567890', 3),
(7, '1234567890', 5),
(7, '1234567890', 9),
(8, '1234567890', 3),
(8, '1234567890', 5),
(9, '1234567890', 3),
(9, '1234567890', 6),
(9, '1234567890', 7),
(10, '1234567890', 3),
(10, '1234567890', 4),
(10, '1234567890', 5),
(10, '1234567890', 7);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`P_IVA`);

--
-- Indici per le tabelle `portata`
--
ALTER TABLE `portata`
  ADD PRIMARY KEY (`id`,`ristP_IVA`);

--
-- Indici per le tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tagportata`
--
ALTER TABLE `tagportata`
  ADD PRIMARY KEY (`idPortata`,`ristP_IVA`,`idTag`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `portata`
--
ALTER TABLE `portata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
