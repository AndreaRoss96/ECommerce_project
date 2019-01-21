-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 22, 2019 alle 00:14
-- Versione del server: 10.1.37-MariaDB
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
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
('0987654321', 'Io centro', 'con i ', 'missili', 'Sulla pista d\'atterraggio C\'era steso un uomo biondo Salutava e non lo vidi mai più Poi nel cielo un\'esplosione Di un motore a compressione Dedicai l\'intera vita Per raggiungere l\'uscita', '11111111111111', 'volo su un boeing', 'io.sono@unmissi.le', '0000', '', '8:00', '14:30', 0),
('12321232123', 'Da Jacopo', 'Jacopo', 'Corina', 'ciao', '34343', 'Via Via 1', 'jacopocorina@live.it', '22a82edd6a62910c48dec286e853d30ac2d37eb49dbd98ba2d35a64797190a80e9c18c98d6f5d921a7aa44a2d48e1a47b78aacf46fd33ad8e0ac446fb3a922d8', '185be0fdd84925a962d25b274fd85ed45911979b9631e014fe35fbf2f871c632ae03f28a77f13271b415709c141c7d876e3b840baaa25d7872443ea27059c083', '10:00', '12:00', 0),
('1234567890', 'frociDelleNike', 'Pop_x', 'Popper', 'Ho visto stamattina Un uomo camminare Gli ho detto \"amico mio Se vuoi mi puoi pigliare Vieni qua, con me\" Stasera', '3331573965', 'via dei gheish', 'froci.con@chi.vuoi', '0000', '', '10:00', '11:00', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `luogoconsegna`
--

CREATE TABLE `luogoconsegna` (
  `id` int(11) NOT NULL,
  `luogo` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id` int(11) NOT NULL,
  `importoTotale` int(11) NOT NULL,
  `costoConsegna` int(11) NOT NULL,
  `matricola` varchar(10) COLLATE utf8_bin NOT NULL,
  `orarioConsegna` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(1, '0987654321', 'Caramelle', 'Ci metto dentro la merda', 666),
(2, '0987654321', 'Dolci antipasti', 'Ci metto la merda anche qua', 33),
(3, '1234567890', 'sacher', 'che è bbona', 12),
(4, '1234567890', 'sarsiccia', '', 0);

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
('Antipasto', 1),
('primo', 2),
('terzo', 3),
('dolce', 4),
('stocazzo', 5);

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
(1, '0987654321', 2),
(2, '0987654321', 4),
(3, '1234567890', 1),
(4, '1234567890', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `portata`
--
ALTER TABLE `portata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
