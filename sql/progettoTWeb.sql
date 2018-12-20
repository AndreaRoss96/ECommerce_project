-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 20, 2018 alle 12:33
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progettoTWeb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Clienti`
--

CREATE TABLE `Clienti` (
  `nome` varchar(20) COLLATE utf8_bin NOT NULL,
  `cognome` varchar(20) COLLATE utf8_bin NOT NULL,
  `e-mail` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(15) COLLATE utf8_bin NOT NULL,
  `matricola` varchar(10) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(13) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `DettaglioOrdine`
--

CREATE TABLE `DettaglioOrdine` (
  `nomePortata` varchar(20) COLLATE utf8_bin NOT NULL,
  `RistP_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `idOrdine` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `Fornitori`
--

CREATE TABLE `Fornitori` (
  `P_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `NomeRistorante` varchar(25) COLLATE utf8_bin NOT NULL,
  `Descrizione` varchar(255) COLLATE utf8_bin NOT NULL,
  `IndirizzoMaps` varchar(100) COLLATE utf8_bin NOT NULL,
  `E-mail` varchar(25) COLLATE utf8_bin NOT NULL,
  `Password` varchar(15) COLLATE utf8_bin NOT NULL,
  `orarioApertura` varchar(5) COLLATE utf8_bin NOT NULL,
  `orarioChiusura` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `LuogoConsegna`
--

CREATE TABLE `LuogoConsegna` (
  `id` int(11) NOT NULL,
  `luogo` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordine`
--

CREATE TABLE `Ordine` (
  `id` int(11) NOT NULL,
  `importoTotale` int(11) NOT NULL,
  `costoConsegna` int(11) NOT NULL,
  `matricola` varchar(10) COLLATE utf8_bin NOT NULL,
  `orarioConsegna` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `Portata`
--

CREATE TABLE `Portata` (
  `id` int(11) NOT NULL,
  `Rist_P_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `nome` varchar(25) COLLATE utf8_bin NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_bin NOT NULL,
  `pezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `Tag`
--

CREATE TABLE `Tag` (
  `nomeTag` varchar(20) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `TagPortata`
--

CREATE TABLE `TagPortata` (
  `id_Portata` int(11) NOT NULL,
  `Rist_P_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `id_Tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Clienti`
--
ALTER TABLE `Clienti`
  ADD PRIMARY KEY (`matricola`);

--
-- Indici per le tabelle `Fornitori`
--
ALTER TABLE `Fornitori`
  ADD PRIMARY KEY (`P_IVA`);

--
-- Indici per le tabelle `LuogoConsegna`
--
ALTER TABLE `LuogoConsegna`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Ordine`
--
ALTER TABLE `Ordine`
  ADD PRIMARY KEY (`id`,`matricola`);

--
-- Indici per le tabelle `Portata`
--
ALTER TABLE `Portata`
  ADD PRIMARY KEY (`id`,`Rist_P_IVA`);

--
-- Indici per le tabelle `Tag`
--
ALTER TABLE `Tag`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `TagPortata`
--
ALTER TABLE `TagPortata`
  ADD PRIMARY KEY (`id_Portata`,`Rist_P_IVA`,`id_Tag`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `LuogoConsegna`
--
ALTER TABLE `LuogoConsegna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Ordine`
--
ALTER TABLE `Ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Portata`
--
ALTER TABLE `Portata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Tag`
--
ALTER TABLE `Tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
