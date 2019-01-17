<?php
    require('../script/functions.php');
    secure_session_start();
    $array = array();
    if(isset($_SESSION['emailAlreadyUsed'])){
        $array[] = "Esiste gia' un account che usa questa e-mail\n";
        unset($_SESSION['emailAlreadyUsed']);
    }
    if(isset($_SESSION['P_IVAAlreadyUsed'])){
        $array[] = "Esiste gia' un account che usa questa partita IVA\n";
        unset($_SESSION['P_IVAAlreadyUsed']);
    }
    if(isset($_SESSION['passwordsDontMatch'])){
        $array[] = "Le password non coincidono\n";
        unset($_SESSION['passwordsDontMatch']);
    }
    if(isset($_SESSION['fieldsNotFilled'])){
        $array[] = "Non sono stati compilati tutti i campi necessari\n";
        unset($_SESSION['fieldsNotFilled']);

    }
    if(isset($_SESSION['badgeAlreadyUsed'])){
        $array[] = "Esiste gia' un account che usa questo numero di matricola\n";
        unset($_SESSION['badgeAlreadyUsed']);

    }
    echo json_encode($array);


?>