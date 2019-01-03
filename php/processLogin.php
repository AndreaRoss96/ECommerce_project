<?php
include('../script/dbConnect.php');
include('../script/functions.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['usermail'],$_POST['password'])){
  secure_session_start();
  $email = $_POST['usermail'];
  $password = $_POST['p1'];
  if(!isset($_SESSION["login_string"])){
      if(isset($_POST["iAmSupplier"])){
        supplierLogin($email,$password,$conn);
      }
      else{
        clientLogin($email,$password,$conn);
      }
  }
  else{
    if(login_check($conn)){
      echo "Login già effettuato dall' utente ".$_SESSION["email"];
    }
  }
}
?>