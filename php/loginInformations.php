<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    secure_session_start();
    if(login_check($conn)){
        if($_SESSION['type'] == SUPPLIER){
            echo json_encode(array(
                "Tipo" => $_SESSION['type'],
                "Email" => $_SESSION['email'],
                "Nome" => $_SESSION['referenceName'],
                "Cognome" => $_SESSION['referenceSurname'],
                "Ristorante" => $_SESSION['restaurantName'],
                "Partita IVA" => $_SESSION['P_IVA']
            ));
        }
        elseif($_SESSION['type'] == CLIENT){
            echo json_encode(array(
                "Tipo" => $_SESSION['type'],
                "Email" => $_SESSION['email'],
                "Nome" => $_SESSION['name'],
                "Cognome" => $_SESSION['surname'],
                "Matricola" => $_SESSION['badgeNumber']
            ));
        }
        else{
            echo json_encode(array(
                "Tipo" => $_SESSION['type'],
                "Email" => $_SESSION['email'],
                "Nome" => $_SESSION['name'],
                "Cognome" => $_SESSION['surname']
            )); 
        }
        
    }
    
    


?>