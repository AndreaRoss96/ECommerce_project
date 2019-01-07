<?php
    require('../script/functions.php');
    secure_session_start();
    $array = array();
    if(isset($_SESSION['loginError'])){
        $array[] = "Dati inseriti non corretti\n";
        unset($_SESSION['loginError']);
    }
    if(isset($_SESSION['approvationError'])){
        $array[] = "Questo account è stato registrato ma non ancora approvato.Ci scusiamo per l'inconveniente\n";
        unset($_SESSION['approvationError']);
    }
    if(isset($_SESSION['alreadyLogged'])){
        $array[] = "Login già eseguito. Effettuare la disconnessione per procedere\n";
        unset($_SESSION['alreadyLogged']);

    }
    echo json_encode($array);


?>