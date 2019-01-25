<?php
include('../script/dbConnect.php');
include('functions.php');
// Check connection
 secure_session_start();
 $array=array();
 if ($conn->connect_error) {
    $array[]="Errore connessione DB";
 }else{
    if(login_check($conn) && !isset($_SESSION['loggedShown'])){
       $array[]="L'utente ".$_SESSION['email']." e' loggato";
       $_SESSION['loggedShown'] = true;
    }
    elseif(isset($_SESSION['passwordChanged'])){
       unset($_SESSION['passwordChanged']);
       $array[] = "La password e' stata modificata con successo";
    }
 }

 echo json_encode($array);
?>