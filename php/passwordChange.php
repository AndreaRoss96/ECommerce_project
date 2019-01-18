<?php
include('../script/dbConnect.php');
include('../script/functions.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['email'],$_POST['p1'],$_POST['p2'])){
  secure_session_start();
  $email = $_POST['email'];
  $nuovaPassword = $_POST['p1'];
  $confermaNuovaPassword = $_POST['p2'];
  if(login_check($conn)){
     if($nuovaPassword == $confermaNuovaPassword){
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $nuovaPassword = hash('sha512', $nuovaPassword.$random_salt);
        if($_SESSION['type'] == SUPPLIER){
            $stmt = $conn->prepare("UPDATE fornitori SET password=?,salt=? WHERE email=?");
        }
        else if($_SESSION['type'] == CLIENT){
            $stmt = $conn->prepare("UPDATE clienti SET password=?,salt=? WHERE email=?");
        }
        else if($_SESSION['type'] == ADMIN){
          $stmt = $conn->prepare("UPDATE amministratori SET password=?,salt=? WHERE email=?");
        }
        $stmt->bind_param("sss",$nuovaPassword,$random_salt,$email);
        $stmt->execute(); // esegue la query appena creata.
        $_SESSION['passwordChanged'] = true;
        sendMail($email,"Notifica cambio password","La password associata all' account ".$email." e' stata modificata con successo");
     }
     header('Location: ../html/userSupplierLogin.html');
  }
  else{
      header('Location: ../html/homepage2.html');
    exit;
  }
}
?>