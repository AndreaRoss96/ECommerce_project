<?php

include('../script/dbConnect.php');
include('../script/functions.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

// initializing variables
$errors = 0;
if(isset($_POST['firstname'],
         $_POST['lastname'],
         $_POST['badgenumber'],
         $_POST['telephone'],
         $_POST['email'],
         $_POST['p1'],
         $_POST['p2'])) { //register_user è il nome del bottone
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $badgenumber = mysqli_real_escape_string($conn, $_POST['badgenumber']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['p1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['p2']);
    secure_session_start();
  //mi assicuro che le due password inserite non siano differenti (il controllo sulla completezza degli altri campi è gestito da bootstrap)
  if ($password_1 != $password_2) {
    $_SESSION['passwordsDontMatch'] = true;
    $errors++;
      //array_push($errors, "The two passwords do not match");
  }

  //controllo il database per assicurarmi che tale utente non vi sai già registrato
  $stmt = $conn->prepare("SELECT matricola FROM clienti WHERE matricola=?");
  $stmt->bind_param("s",$badgenumber);
  $stmt->execute();
  if($stmt->get_result()->num_rows > 0) {
      $_SESSION['badgeAlreadyUsed'] = true;
      $errors++;
      //array_push($errors, "A user with the same badgne number or same mail already exists");
  }

  $stmt = $conn->prepare('SELECT email FROM fornitori where email=?');
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result1 = $stmt->get_result();

  $stmt = $conn->prepare('SELECT email FROM clienti where email=?');
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result2 = $stmt->get_result();

  if($result1->num_rows > 0 || $result2->num_rows > 0) {
    $_SESSION['emailAlreadyUsed'] = true;
    $errors++;
  }
  $stmt->close();
  if($errors === 0) {
      $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      $password = hash('sha512', $password_1.$random_salt);
      if($insert_stmt = $conn->prepare("INSERT INTO clienti (nome, cognome, email, password,salt, matricola, telefono) VALUES(?,?,?,?,?,?,?)")){   
        $insert_stmt->bind_param("sssssss", $firstname,$lastname,$email,$password,$random_salt,$badgenumber,$telephone);
        $insert_stmt->execute();
        $insert_stmt->close();
        header('Location: ../html/successfulUserRegistration.html');
        exit;
    }   
  }
}
header('Location: ../html/userRegistrationForm.html');

?>
