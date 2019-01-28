

INSERT INTO `amministratori` (`email`, `nome`, `cognome`, `password`, `salt`) VALUES
('amministratoreprogettotweb@gmail.com', 'Luca', 'Rossi', '1f4c984d8af03472ce9fb962741a10ed205666362c9a58f4c2ae517a26ad7301f7b195f2c0f8649327eba923354b2536f586daf7ec99123fd5a546dc228ffc3a', '86981319228b0c694dc878f950993e5c61724c9cde3733c7da4c46252d5c5c083d727bcfa6434daca10a18b4b31d8340a09b94a79a684a1b816690d5a8f91464');


INSERT INTO `portata` (`id`, `ristP_IVA`, `nome`, `descrizione`, `prezzo`) VALUES
(1, '0987654321', 'Caramelle', 'Ci metto dentro la merda', 666),
(2, '0987654321', 'Dolci antipasti', 'Ci metto la merda anche qua', 33),
(3, '1234567890', 'sacher', 'che è bbona', 12),
(4, '1234567890', 'sarsiccia', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
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

INSERT INTO `tagportata` (`idPortata`, `ristP_IVA`, `idTag`) VALUES
(1, '0987654321', 2),
(2, '0987654321', 4),
(3, '1234567890', 1),
(4, '1234567890', 3);
