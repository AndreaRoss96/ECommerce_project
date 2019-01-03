<?php

include('../script/dbConnect.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

// initializing variables
$errors = array();


if(isset($_POST['register_user'])) { //register_user è il nome del bottone
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $badgenumber = mysqli_real_escape_string($conn, $_POST['badgenumber']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['p1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['p2']);

  //mi assicuro che le due password inserite non siano differenti (il controllo sulla completezza degli altri campi è gestito da bootstrap)
  if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
  }

  //controllo il database per assicurarmi che tale utente non vi sai già registrato
  $stmt = $conn->prepare("SELECT email FROM clienti WHERE matricola=? OR email=? LIMIT 1");
  $stmt->bind_param("ss",$matricola,$email);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0) {
      array_push($errors, "A user with the same badgne number or same mail already exists");
  }

  //se non si sono presentati errori durante lo svolgimento si procede con la query di inserimento
  if(count($errors) == 0) {
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $password_1.$random_salt);
    if($insert_stmt = $conn->prepare("INSERT INTO clienti (nome, cognome, email, password,salt, matricola, telefono) VALUES(?,?,?,?,?,?,?)")){   
      $insert_stmt->bind_param("sssssss", $firstname,$lastname,$email,$password,$random_salt,$badgenumber,$telephone);
      // Esegui la query ottenuta.
      $insert_stmt->execute();
    }   
  } else {
    foreach ($errors as $error) {
      echo $error;
    }
  }
}
?>
