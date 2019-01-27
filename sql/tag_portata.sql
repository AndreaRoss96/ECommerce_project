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


-- --------------------------------------------------------

--
-- Struttura della tabella `portata`
--



--
-- Dump dei dati per la tabella `portata`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--



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


--
-- Dump dei dati per la tabella `tagportata`
--



