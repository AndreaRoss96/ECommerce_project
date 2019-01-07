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
  if(!login_check($conn)){
      if(isset($_POST["iAmSupplier"])){
        supplierLogin($email,$password,$conn);
      }
      elseif(isset($_POST['iAmAdmin'])){
        adminLogin($email,$password,$conn);
      }
      else{
        clientLogin($email,$password,$conn);
      }
  }
  else{
    $_SESSION['alreadyLogged'] = true;
    if(isset($_POST["iAmAdmin"])){
      header('Location: ../html/adminLogin.html');
    }
    else{
      header('Location: ../html/userSupplierLogin.html');
    }
    exit;
  }
}
?>