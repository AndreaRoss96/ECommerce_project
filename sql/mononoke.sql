INSERT INTO `portata` (`id`, `ristP_IVA`, `nome`, `descrizione`, `prezzo`) VALUES
(5, '12321232123', 'Spaghetti alla carbonara', 'Spaghetti, Guanciale, Tuorli, Pecorino romano, Sale e pepe nero.', 7),
(6, '12321232123', 'Spaghetti all\'Amatriciana', 'Spaghetti, Pomodori pelati, Guanciale, Pecorino romano, Sale, Olio extravergine d\'oliva, Peperoncino fresco, Vino bianco. ', 8),
(7, '12321232123', 'Cosce di pollo al forno', 'Cosce di pollo, Patate, Sale, Pepe, Olio extravergine d\'oliva, Rosmarino, Timo, Paprika piccante', 10),
(8, '12321232123', 'Salmone al forno', 'Tranci di salmone, Patate, Scorza di limone, Succo di limone, Vino bianco, Olio extravergine d\'oliva, Prezzemolo, Sale, Pepe.', 9),
(9, '12321232123', 'Castagnole', 'Burro, Farina 00, Uova, Zucchero, Scorza di limone, Liquore all\'anice, Sale, Lievito in polvere, Baccello di vaniglia', 6),
(10, '09876543212', 'Torta al cioccolato', 'latte di soia, olio di oliva, zucchero, cacao, farina, bicarbonato, vaniglia, uvetta, noci', 6),
(11, '09876543212', 'Burger di ceci e verdure', 'Ceci, Cipolla, Ravanelli, Sedano, Carota, Capperi, Senape, Prezzemolo, Olio extravergine di oliva', 6),
(12, '09876543212', 'Estasi verde', 'Piadina, bieta costa, cipolla bianca, olio extravergine di oliva, aglio, pepe nero, salvia, rosmarino, peperoncino in polvere.', 7);

INSERT INTO `tagportata` (`idPortata`, `ristP_IVA`, `idTag`) VALUES
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
(12, '09876543212', 10);