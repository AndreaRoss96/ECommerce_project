-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 25, 2019 alle 19:46
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.3.0

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
-- Struttura della tabella `amministratori`
--

CREATE TABLE `amministratori` (
  `email` varchar(50) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `amministratori`
--

INSERT INTO `amministratori` (`email`, `nome`, `cognome`, `password`, `salt`) VALUES
('amministratoreprogettotweb@gmail.com', 'Luca', 'Rossi', '1f4c984d8af03472ce9fb962741a10ed205666362c9a58f4c2ae517a26ad7301f7b195f2c0f8649327eba923354b2536f586daf7ec99123fd5a546dc228ffc3a', '86981319228b0c694dc878f950993e5c61724c9cde3733c7da4c46252d5c5c083d727bcfa6434daca10a18b4b31d8340a09b94a79a684a1b816690d5a8f91464');

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `nome` varchar(20) COLLATE utf8_bin NOT NULL,
  `cognome` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  `salt` varchar(128) COLLATE utf8_bin NOT NULL,
  `matricola` varchar(10) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(13) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`nome`, `cognome`, `email`, `password`, `salt`, `matricola`, `telefono`) VALUES
('Mario', 'Rossi', 'mario@rossi.it', '88b38e629087df690eb39266742e3b4449f840b8a5672a512389407375d280d373cfe4728337b8ff0166967e2670b1e20bd52642c973a4c2701c869aaae36e58', '12cce5d357f7cc16c688d658e9ed8919580952ecd907c08a7abcc8aef389bf6af2c9a1d4efd13f231e42a6488c003bdc5363759fc13743638df22c3d5269fb5f', '792482', '333');

-- --------------------------------------------------------

--
-- Struttura della tabella `dettaglioordine`
--

CREATE TABLE `dettaglioordine` (
  `idPortata` int(11) NOT NULL,
  `ristP_IVA` varchar(11) COLLATE utf8_bin NOT NULL,
  `idOrdine` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `inConsegna` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `dettaglioordine`
--

INSERT INTO `dettaglioordine` (`idPortata`, `ristP_IVA`, `idOrdine`, `quantita`, `inConsegna`) VALUES
(1, '12321232123', 1, 3, 1),
(1, '12321232123', 2, 4, 1),
(2, '12321232123', 1, 2, 1),
(2, '12321232123', 2, 1, 1);

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
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  `salt` varchar(128) COLLATE utf8_bin NOT NULL,
  `orarioApertura` varchar(5) COLLATE utf8_bin NOT NULL,
  `orarioChiusura` varchar(5) COLLATE utf8_bin NOT NULL,
  `approvazioneAmministratore` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `fornitori`
--

INSERT INTO `fornitori` (`P_IVA`, `nomeRistorante`, `nomeReferente`, `cognomeReferente`, `descrizione`, `telefono`, `indirizzoMaps`, `email`, `password`, `salt`, `orarioApertura`, `orarioChiusura`, `approvazioneAmministratore`) VALUES
('12321232123', 'Da Jacopo', 'Jacopo', 'Corina', 'ciao', '34343', 'Via Via 1', 'jacopocorina@live.it', '22a82edd6a62910c48dec286e853d30ac2d37eb49dbd98ba2d35a64797190a80e9c18c98d6f5d921a7aa44a2d48e1a47b78aacf46fd33ad8e0ac446fb3a922d8', '185be0fdd84925a962d25b274fd85ed45911979b9631e014fe35fbf2f871c632ae03f28a77f13271b415709c141c7d876e3b840baaa25d7872443ea27059c083', '10:00', '12:00', 1),
('12341234123', 'prova', 'j', 'j', 'jj', '9', 'j', 'j@live.it', 'b9ab43eda2b7b0253f248adee4e693eaf7b9da7ba82bdc3bf8277cea89d1fb122a2ba555e209257a42a9b75a26b3453ce88c410fb7d647a16bd6d575f180e616', '3e7c0561cc15bff3c9cf9c7cafea0f8b47d8623bcbf9e1c7bd00bcc1d2b5d7ed6598be25b03cdc88183b64f156f1803735e04b45fd5f4e5e2c2e07546fb0b6cc', '09:09', '09:09', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `luogoconsegna`
--

CREATE TABLE `luogoconsegna` (
  `id` int(11) NOT NULL,
  `luogo` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `luogoconsegna`
--

INSERT INTO `luogoconsegna` (`id`, `luogo`) VALUES
(1, 'Ingresso piano terra'),
(2, 'Ingresso primo piano');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id` int(11) NOT NULL,
  `importoTotale` int(11) NOT NULL,
  `costoConsegna` int(11) NOT NULL,
  `matricola` varchar(10) COLLATE utf8_bin NOT NULL,
  `orarioConsegna` varchar(5) COLLATE utf8_bin NOT NULL,
  `idLuogoConsegna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`id`, `importoTotale`, `costoConsegna`, `matricola`, `orarioConsegna`, `idLuogoConsegna`) VALUES
(1, 30, 2, '12', '14:20', 1),
(2, 12, 2, '12', '12:30', 2),
(3, 25, 2, '12', '12:00', 1),
(4, 10, 2, '14', '13:00', 1),
(5, 7, 2, '14', '18:00', 2);

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
(1, '12321232123', 'pasta al sugo', 'pasta, sugo di carne bovina', 10),
(2, '12321232123', 'sella \'al rosto\'', 'na sella de cavallo \'al rosto\'', 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--

CREATE TABLE `tag` (
  `nomeTag` varchar(20) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`matricola`);

--
-- Indici per le tabelle `dettaglioordine`
--
ALTER TABLE `dettaglioordine`
  ADD PRIMARY KEY (`idPortata`,`ristP_IVA`,`idOrdine`);

--
-- Indici per le tabelle `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`P_IVA`);

--
-- Indici per le tabelle `luogoconsegna`
--
ALTER TABLE `luogoconsegna`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`id`,`matricola`);

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
-- AUTO_INCREMENT per la tabella `luogoconsegna`
--
ALTER TABLE `luogoconsegna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `portata`
--
ALTER TABLE `portata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
