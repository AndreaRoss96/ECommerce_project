<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    secure_session_start();
    if(login_check($conn)){
        if(isset($_SESSION["approvazioneAmministratore"])){
            echo json_encode(array(
                "Email" => $_SESSION['email'],
                "Nome ristorante" => $_SESSION['restaurantName'],
                "Nome referente" => $_SESSION['referenceName'],
                "Cognome referente" => $_SESSION['referenceSurname']
            ));
        }
        else{
            echo json_encode(array(
                "Email" => $_SESSION['email'],
                "Nome utente" => $_SESSION['name'],
                "Cognome utente" => $_SESSION['surname']
            ));
        }
        
    }
    


?>