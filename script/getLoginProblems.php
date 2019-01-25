<?php
    include('../script/dbConnect.php');
    include('functions.php');
    // Check connection
     secure_session_start();
     $array=array();
     if ($conn->connect_error) {
        $array[]="Errore connessione DB";
     }else{
        if(isset($_SESSION['loginError'])){
            $array[] = "Dati inseriti non corretti";
            unset($_SESSION['loginError']);
        }
        if(isset($_SESSION['approvationError'])){
            $array[] = "Questo account è stato registrato ma non ancora approvato.Ci scusiamo per l'inconveniente";
            unset($_SESSION['approvationError']);
        }
        if(isset($_SESSION['alreadyLogged'])){
            $array[] = "Login già eseguito. Effettuare la disconnessione per procedere";
            unset($_SESSION['alreadyLogged']);

        }
    }
    echo json_encode($array);


?>