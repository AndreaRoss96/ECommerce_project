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
            $email = $_SESSION['email'];
            echo base64_encode(file_get_contents("../profileImages/".$email.".jpg"));            
        }
    }
?>