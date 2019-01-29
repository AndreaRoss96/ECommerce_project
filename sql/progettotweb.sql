-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 29, 2019 alle 22:14
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
('Mario', 'Rossi', 'mario@rossi.it', '30bd5e8f3b56b362dadc8c5c2443251b57f6fca70f241ffa00b3c07950ff9eb962e7df5ec1984fba8df412b121bd7c622cae834821113e77f5178deaa019dc9a', 'bdb1603d19d0479a3c86a6a91cf4c0026213029c58007c18f7135e51014639818553f6c92187188fc83bd146bf4b865d3d465d050a24cbdedee13f3ab73956ec', '792482', '333');

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
(1, '12321232123', 29, 2, 1),
(2, '12321232123', 31, 1, 1),
(3, '12321232123', 25, 20, 1),
(3, '12321232123', 29, 10, 1),
(4, '09876543212', 25, 10, 1),
(4, '09876543212', 26, 2, 1),
(4, '09876543212', 27, 1, 1),
(8, '12321232123', 31, 1, 1),
(9, '12321232123', 28, 1, 1),
(9, '12321232123', 32, 1, 1),
(13, '0417230404', 28, 1, 1),
(13, '0417230404', 30, 30, 1),
(14, '0417230404', 31, 1, 1),
(15, '0417230404', 28, 1, 1),
(15, '0417230404', 30, 2, 1),
(15, '0417230404', 32, 1, 0);

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
('0417230404', 'Lo sfizio', 'Mauro', 'Mastichelli', 'Una lievitazione con pasta madre, rende il nostro impasto leggero e digeribile!\r\nUsiamo farine bio a km 0 da semi antichi non modificabili OGM\r\nOgni 10 pizze acquistate 1 Ã¨ in OMAGGIO*!\r\n(*dal valore massimo di 4â‚¬)', '3477425440', 'Piazza dei Partigiani 4', 'pizzerialosfizio@mail.it', 'f5ab1f90be1c0cc62f8a3dcbe5b8b9477e2e0ed1c426a0dcbb1fd69d369a9efdbb923ce987f239a465f1fad25bf2c9c1b335d6b6bbd44015106aaed99e07d73e', '2d792f921bd8bd9cd6b274e00854731fa5be19792273bf22a85ce07a11d9af23fbbe3cb00c969d2a154e958eabb96cdee64081bb25583df0ea0eda71ad861be3', '07:00', '22:00', 1),
('09876543212', 'Vegan house', 'Giacomi', 'Bianchi', 'Deliziosi pasti', '3771553260', 'Via XXV Aprile 326', 'veganhouse@mail.it', '5447babbe53dfd8415db3e28c506da862d58b01f04791cfeaed6ea73369267dc4a0c352282942b7e12b00f25c608baa713e7954b42263c0a0b1f144751c6057d', '8f7977a4fc1d491b065d3cb9c853354265ce7cbe352fff95a465f94cf1661a8e5ed1829baf99feaf7fe633dcfb48d833c11ad9c34f57dc816ae29052604c3cf2', '09:00', '19:00', 1),
('12321232123', 'Da Jacopo', 'Jacopo', 'Corina', 'Solo prodotti locali', '34343', 'Via Verdi 1', 'jacopocorina@live.it', '2ee5204cd1dfd242267e07354828c689059a47a8451750eb4b48fcfa27d145b00eb87cb3aea20cce34af537c07edd9ad2bbc773f8e667dbe2efe473e75501424', '72955b3b98a442a78f989b9db9bd7ea012575f6be88a16972f2d31ce37a5f8c33876450614badb2a04708889de05444b5c5d9d97c6ea2f499fc37c062e17c2fc', '10:00', '12:00', 1),
('12345678901', 'Piadineria da Jonny', 'Jonny', 'Stecchino', 'piade', '3333333333', 'Via rossi 45', 'prova@prova.it', '45a12a3c836df32279ea08b23f6db15408067fbb55b717a96c5955d83dfe7cf343bcdd4c462672380451594527156942d430f65acbe9dc670a3459a02eb9b857', '68a5070ed6d43b83f4d3c2ef8172668a95f2b65c57dc27a9ce6bd4db769a9a3577d789aeb43bf1874fb9b10ccd1f1a1903146f691847b215d8508f8183c35d3a', '10:00', '12:00', 1);

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
(29, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Maio e\' pronto ed e\' in consegna', 1, '2019-01-28 21:31:20'),
(30, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 1, '2019-01-28 21:32:10'),
(31, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 1, '2019-01-28 21:32:13'),
(32, 'damaio@mail.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-28 22:06:28'),
(33, 'mario@rossi.it', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Maio e\' pronto ed e\' in consegna', 1, '2019-01-28 22:24:52'),
(34, 'mario@rossi.it', 'La password associata all\' account mario@rossi.it e\' stata modificata con successo', 1, '2019-01-29 07:43:36'),
(35, 'jacopocorina@live.it', 'La password associata all\' account jacopocorina@live.it e\' stata modificata con successo', 1, '2019-01-29 07:45:56'),
(36, 'veganhouse@mail.it', 'La password associata all\' account veganhouse@mail.it e\' stata modificata con successo', 1, '2019-01-29 09:09:46'),
(37, 'amministratoreprogettotweb@gmail.com', 'Un nuovo fornitore (info@pizzerialosfizio.it) si e\' registrato e dovra\' essere approvato', 0, '2019-01-29 09:22:45'),
(38, 'info@pizzerialosfizio.it', 'L\' account registrato con la seguente e-mail:info@pizzerialosfizio.it e\' stato approvato.\r\nOra puoi effettuare il login', 1, '2019-01-29 09:24:37'),
(39, 'jacopocorina@live.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 10:46:12'),
(40, 'info@pizzerialosfizio.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 10:46:16'),
(41, 'info@pizzerialosfizio.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 10:46:24'),
(42, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Lo sfizio e\' pronto ed e\' in consegna', 1, '2019-01-29 10:50:28'),
(43, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 1, '2019-01-29 10:51:02'),
(44, 'jacopocorina@live.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 10:52:44'),
(45, 'jacopocorina@live.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 10:52:50'),
(46, 'pizzerialosfizio@mail.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 10:57:56'),
(47, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Lo sfizio e\' pronto ed e\' in consegna', 1, '2019-01-29 10:58:45'),
(48, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 1, '2019-01-29 12:09:06'),
(49, 'pizzerialosfizio@mail.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 12:12:26'),
(50, 'jacopocorina@live.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 12:12:40'),
(51, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Lo sfizio e\' pronto ed e\' in consegna', 0, '2019-01-29 12:13:47'),
(52, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 0, '2019-01-29 12:19:48'),
(53, 'jacopocorina@live.it', 'Hai ricevuto un nuovo ordine', 1, '2019-01-29 13:53:40'),
(54, 'pizzerialosfizio@mail.it', 'Hai ricevuto un nuovo ordine', 0, '2019-01-29 13:53:44'),
(55, 'federicogal97@gmail.com', 'Gentile cliente, la avvisiamo che il suo ordine presso Da Jacopo e\' pronto ed e\' in consegna', 0, '2019-01-29 13:55:30'),
(56, 'jacopocorina@live.it', 'L\' account registrato con la seguente e-mail:jacopocorina@live.it e\' stato temporaneamente disabilitato\r\nRiceverÃ  ulteriori informazioni al piÃ¹ presto.', 0, '2019-01-29 13:59:20'),
(57, 'jacopocorina@live.it', 'L\' account registrato con la seguente e-mail:jacopocorina@live.it e\' stato approvato.\r\nOra puoi effettuare il login', 0, '2019-01-29 14:00:06');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id` int(11) NOT NULL,
  `importoTotale` int(11) NOT NULL,
  `costoConsegna` int(11) NOT NULL,
  `matricola` varchar(10) COLLATE utf8_bin NOT NULL,
  `orarioConsegna` varchar(20) COLLATE utf8_bin NOT NULL,
  `idLuogoConsegna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`id`, `importoTotale`, `costoConsegna`, `matricola`, `orarioConsegna`, `idLuogoConsegna`) VALUES
(25, 230, 1, '1234543', '10:00', 1),
(26, 64, 1, '1234543', '10:00', 1),
(27, 7, 1, '792482', '09:00', 1),
(28, 16, 1, '1234543', '11:10 - 11:20', 2),
(29, 100, 1, '1234543', '10:00 - 10:10', 1),
(30, 104, 1, '1234543', '07:00 - 07:10', 1),
(31, 35, 1, '1234543', '11:20 - 11:30', 1),
(32, 13, 1, '1234543', '11:10 - 11:20', 1);

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
(2, '12321232123', 'Arrostino', 'Arrostino di maiale', 20),
(3, '12321232123', 'bucatini', 'bucatini ,sugo', 8),
(4, '09876543212', 'Piada con salsiccia', 'piada, salsiccia', 7),
(5, '12321232123', 'Spaghetti alla carbonara', 'Spaghetti, Guanciale, Tuorli, Pecorino romano, Sale e pepe nero.', 7),
(6, '12321232123', 'Spaghetti all\'Amatriciana', 'Spaghetti, Pomodori pelati, Guanciale, Pecorino romano, Sale, Olio extravergine d\'oliva, Peperoncino fresco, Vino bianco. ', 8),
(7, '12321232123', 'Cosce di pollo al forno', 'Cosce di pollo, Patate, Sale, Pepe, Olio extravergine d\'oliva, Rosmarino, Timo, Paprika piccante', 10),
(8, '12321232123', 'Salmone al forno', 'Tranci di salmone, Patate, Scorza di limone, Succo di limone, Vino bianco, Olio extravergine d\'oliva, Prezzemolo, Sale, Pepe.', 9),
(9, '12321232123', 'Castagnole', 'Burro, Farina 00, Uova, Zucchero, Scorza di limone, Liquore all\'anice, Sale, Lievito in polvere, Baccello di vaniglia', 6),
(10, '09876543212', 'Torta al cioccolato', 'latte di soia, olio di oliva, zucchero, cacao, farina, bicarbonato, vaniglia, uvetta, noci', 6),
(11, '09876543212', 'Burger di ceci e verdure', 'Ceci, Cipolla, Ravanelli, Sedano, Carota, Capperi, Senape, Prezzemolo, Olio extravergine di oliva', 6),
(12, '09876543212', 'Estasi verde', 'Piadina, bieta costa, cipolla bianca, olio extravergine di oliva, aglio, pepe nero, salvia, rosmarino, peperoncino in polvere.', 7),
(13, '0417230404', 'Marinara', 'Pomodoro, aglio, olio, prezzemolo', 3),
(14, '0417230404', '4 stagioni', 'Pomodoro, mozzarella, funghi trifolati in casa', 6),
(15, '0417230404', 'Fantasia verdure (vegan)', 'pomodoro, radicchio, funghi freschi, pomodorini, rucola', 7);

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
('Vegano', 10),
('Pizza', 11);

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
(4, '09876543212', 8),
(5, '12321232123', 4),
(5, '12321232123', 8),
(6, '12321232123', 4),
(6, '12321232123', 8),
(7, '12321232123', 5),
(7, '12321232123', 8),
(8, '12321232123', 5),
(8, '12321232123', 9),
(9, '12321232123', 7),
(10, '09876543212', 7),
(10, '09876543212', 10),
(11, '09876543212', 5),
(11, '09876543212', 6),
(11, '09876543212', 10),
(12, '09876543212', 5),
(12, '09876543212', 10),
(13, '0417230404', 11),
(14, '0417230404', 11),
(15, '0417230404', 10),
(15, '0417230404', 11);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `portata`
--
ALTER TABLE `portata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
