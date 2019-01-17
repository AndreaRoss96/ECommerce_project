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
       $array[]="L'utente ".$_SESSION['email']." e' loggato";
    }
    else{
       $array[]="Accesso non eseguito";
    }
 }

 echo json_encode($array);
?>