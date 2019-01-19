<?php
include('../script/dbConnect.php');
include('functions.php');
// Check connection
 $array=array();
 if ($conn->connect_error) {
    $array[]="Errore connessione DB";
 }else{
    secure_session_start();
    if(login_check($conn)){
       $array[]="L'utente ".$_SESSION['email']." e' loggato<br/>";
    }
    elseif(isset($_SESSION['passwordChanged'])){
       unset($_SESSION['passwordChanged']);
       $array[] = "La password e' stata modificata con successo<br/>";
    }
 }

 echo json_encode($array);
?>