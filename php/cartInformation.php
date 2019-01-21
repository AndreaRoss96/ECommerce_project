<?php
include 'dbConfig.php';
include 'Cart.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cart = new Cart;

if($cart->total_items() > 0) { //ottiene il numero di elementi nel carrello all'interno della sessione
  echo json_encode($cart->contents()); //ottengo tutti gli elementi contenuti nel carrello
} else {
  echo json_encode(array('Message' => "Non hai ancora selezionato nessun prodotto."));
}
?>
