<?php
define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
define("USER", "secure_user"); // E' l'utente con cui ti collegherai al DB.
define("PASSWORD", "prova"); // Password di accesso al DB.
define("DATABASE", "progettotweb"); // Nome del database.
$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Se ti stai connettendo usando il protocollo TCP/IP, invece di usare un socket UNIX, ricordati di aggiungere il parametro corrispondente al numero di porta.
?>
