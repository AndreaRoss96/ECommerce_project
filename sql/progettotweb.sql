-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 28, 2019 alle 22:37
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
('Federico', 'Galdenzi', 'federicogal97@gmail.com', '23eb3badac1bd9d345091e14a5268367cf148f01f87de7df6f1ab0536d1fd3e30f94c9899152a1bad7cad53d4a8a148c96e35caf8e9c3ad35a1a56e9f160e5fe', 'b183df2ee1f51d35c800fa43b4635fe740552522b321ea3457af2d92356ae75ce35b11dc5117e80bca418c084062c1da2b92cabf997964c0600cb2bdb2e91f3e', '1234543', '3459872354'),
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
(1, '12321232123', 26, 5, 1),
(3, '12321232123', 25, 20, 1),
(4, '09876543212', 25, 10, 1),
(4, '09876543212', 26, 2, 1);

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
('09876543212', 'Da Maio', 'Maio', 'Dario', 'Deliziosi pasti', '3771553260', 'Via XXV Aprile 326', 'damaio@mail.it', '3c24e918b9c2e1ff304627a48ea68b4b1e2a22ed940bb76e03f11f1eaf2c5261c503af1e257aab34be7ccdbfb81f3a1db572e55d92c88669ddd934b315097fb7', '61e9bd414d6936510d86eca016b65effeea6b5c3775357dc5837ba4ac2946f94d70c351102b6edadabe8e04624fc2557aa5abb586f8fd44569d9ff490d2d8a6e', '09:00', '19:00', 1),
('12321232123', 'Da Jacopo', 'Jacopo', 'Corina', 'ciao', '34343', 'Via Via 1', 'jacopocorina@live.it', '22a82edd6a62910c48dec286e853d30ac2d37eb49dbd98ba2d35a64797190a80e9c18c98d6f5d921a7aa44a2d48e1a47b78aacf46fd33ad8e0ac446fb3a922d8', '185be0fdd84925a962d25b274fd85ed45911979b9631e014fe35fbf2f871c632ae03f28a77f13271b415709c141c7d876e3b840baaa25d7872443ea27059c083', '10:00', '12:00', 1),
('12341234123', 'prova', 'j', 'j', 'jj', '9', 'j', 'j@live.it', 'b9ab43eda2b7b0253f248adee4e693eaf7b9da7ba82bdc3bf8277cea89d1fb122a2ba555e209257a42a9b75a26b3453ce88c410fb7d647a16bd6d575f180e616', '3e7c0561cc15bff3c9cf9c7cafea0f8b47d8623bcbf9e1c7bd00bcc1d2b5d7ed6598be25b03cdc88183b64f156f1803735e04b45fd5f4e5e2c2e07546fb0b6cc', '09:09', '09:09', 1),
('12345678901', 'Piadineria da Jonny', 'Jonny', 'Stecchino', 'piade', '3333333333', 'Via rossi 45', 'prova@prova.it', '45a12a3c836df32279ea08b23f6db15408067fbb55b717a96c5955d83dfe7cf343bcdd4c462672380451594527156942d430f65acbe9dc670a3459a02eb9b857', '68a5070ed6d43b83f4d3c2ef8172668a95f2b65c57dc27a9ce6bd4db769a9a3577d789aeb43bf1874fb9b10ccd1f1a1903146f691847b215d8508f8183c35d3a', '10:00', '12:00', 1),
('9', '9', '9', '9', '9', '9', '9', 'jajaaj@gmail.com', 'c1d57e848c0bacf645aa96a1fe4a8a2b7c723761396a86c1aa5c03f4b02ebb3ffd79af80fd22ef0f0c14425aba1a2a2094411cf189542ecfc0cf0257f6b0f288', '2c5c551f6d868bd4b169b0168dde7091a016948bb815560422a574120add7296232c94d4fc2407bc9cc98dff6b0fdb23f88e23a58259387907169d8862e298e9', '09:09', '09:09', 0);

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
-- Struttura della tabella `notifiche`
--

CREATE TABLE `notifiche` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `testo` varchar(200) NOT NULL,
  `letto` tinyint(4) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `notifiche`
--

INSERT INTO `notifiche` (`id`, `email`, `testo`, `letto`, `timestamp`) VALUES
(1, 'jacopocorina@live.it', 'prova', 1, '2019-01-28 11:29:38'),
(2, 'jacopocorina@live.it', 'prova2', 1, '2019-01-28 13:24:45'),
(3, 'ajajjaaj', 'aaaa', 0, '2019-01-28 14:17:51'),
(4, '1', 'Gentile cliente, la avvisiamo che il suo ordine presso e\' pronto ed e\' in consegnaL\'account associato alla e-mail:1 e\' stato eliminato dall\' amministratore', 0, '2019-01-28 14:25:30'),
(9, 'mario@rossi.it', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 1, '2019-01-28 15:10:41'),
(10, 'amministratoreprogettotweb@gmail.com', 'Un nuovo fornitore (prova@prova.it) si e\' registrato e dovra\' essere approvato', 1, '2019-01-28 15:22:58'),
(11, 'prova@prova.it', 'L\' account registrato con la seguente e-mail:prova@prova.it e\' stato approvato.\r\nOra puoi effettuare il login', 1, '2019-01-28 15:25:48'),
(12, 'prova@prova.it', 'L\' account registrato con la seguente e-mail:prova@prova.it e\' stato temporaneamente disabilitato\r\nRiceverÃ  ulteriori informazioni al piÃ¹ presto.', 1, '2019-01-28 15:26:07'),
(13, 'prova@prova.it', 'L\' account registrato con la seguente e-mail:prova@prova.it e\' stato approvato.\r\nOra puoi effettuare il login', 1, '2019-01-28 15:26:19'),
(14, 'prova@prova.it', 'L\' account registrato con la seguente e-mail:prova@prova.it e\' stato temporaneamente disabilitato\r\nRiceverÃ  ulteriori informazioni al piÃ¹ presto.', 1, '2019-01-28 15:26:38'),
(15, 'prova@prova.it', 'L\' account registrato con la seguente e-mail:prova@prova.it e\' stato approvato.\r\nOra puoi effettuare il login', 1, '2019-01-28 15:26:53'),
(16, 'amministratoreprogettotweb@gmail.com', 'Un nuovo fornitore (jajaaj@gmail.com) si e\' registrato e dovra\' essere approvato', 1, '2019-01-28 16:35:54'),
(17, 'amministratoreprogettotweb@gmail.com', 'Un nuovo fornitore (damaio@mail.it) si e\' registrato e dovra\' essere approvato', 1, '2019-01-28 20:40:53'),
(18, 'damaio@mail.it', 'L\' account registrato con la seguente e-mail:damaio@mail.it e\' stato approvato.\r\nOra puoi effettuare il login', 1, '2019-01-28 20:42:06'),
(19, 'damaio@mail.it', 'L\' account registrato con la seguente e-mail:damaio@mail.it e\' stato temporaneamente disabilitato\r\nRiceverÃ  ulteriori informazioni al piÃ¹ presto.', 1, '2019-01-28 20:43:26'),
(20, 'damaio@mail.it', 'L\' account registrato con la seguente e-mail:damaio@mail.it e\' stato approvato.\r\nOra puoi effettuare il login', 1, '2019-01-28 20:43:33'),
(21, 'Array', 'Hai ricevuto un nuovo ordine', 0, '2019-01-28 21:07:20'),
(22, 'Array', 'Hai ricevuto un nuovo ordine', 0, '2019-01-28 21:07:20'),
(23, 'Array', 'Hai ricevuto un nuovo ordine', 0, '2019-01-28 21:12:30'),
(24, 'Array', 'Hai ricevuto un nuovo ordine', 0, '2019-01-28 21:12:30'),
(25, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Maio e\' pronto ed e\' in consegna', 1, '2019-01-28 21:17:03'),
(26, 'federicogal97@gmail.com', 'La password associata all\' account federicogal97@gmail.com e\' stata modificata con successo', 1, '2019-01-28 21:27:29'),
(27, 'jacopocorina@live.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-28 21:29:19'),
(28, 'damaio@mail.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-28 21:29:25'),
(29, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Maio e\' pronto ed e\' in consegna', 0, '2019-01-28 21:31:20'),
(30, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 0, '2019-01-28 21:32:10'),
(31, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 0, '2019-01-28 21:32:13');

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
(25, 230, 1, '1234543', '10:00', 1),
(26, 64, 1, '1234543', '10:00', 1);

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
(2, '12321232123', 'sella \'al rosto\'', 'na sella de cavallo \'al rosto\'', 20),
(3, '12321232123', 'bucatini', 'bucatini ,sugo', 8),
(4, '09876543212', 'Piada con salsiccia', 'piada, salsiccia', 7);

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
(1, '12321232123', 3),
(2, '12321232123', 3),
(2, '12321232123', 6),
(3, '12321232123', 3),
(4, '09876543212', 5),
(4, '09876543212', 6),
(4, '09876543212', 8);

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
-- Indici per le tabelle `notifiche`
--
ALTER TABLE `notifiche`
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
-- AUTO_INCREMENT per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `portata`
--
ALTER TABLE `portata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
