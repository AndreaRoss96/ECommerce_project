<?php
echo "Ho iniziato";
session_start();

// initializing variables
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'progettoTWeb');

// Register user
if(isset($_POST['register_user'])) { //register_user è il nome del bottone
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    echo $firstname;
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    echo $lastname;
    $badgenumber = mysqli_real_escape_string($db, $_POST['badgenumber']);
    echo $badgenumber;
    $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
    echo $telephone;
    $email = mysqli_real_escape_string($db, $_POST['email']);
    echo $email;
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    echo $password_1;
    $passwrod_2 = mysqli_real_escape_string($db, $_POST['password_2']);
}

//mi assicuro che le due password inserite non siano differenti (il controllo sulla completezza degli altri campi è gestito da bootstrap)
if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
}

//controllo il database per assicurarmi che tale utente non vi sai già registrato
$user_check = "SELECT * FROM Clienti WHERE matricola='$badgenumber' LIMIT 1";
$result = mysqli_query($db, $user_check);
$badgenumber_user = mysqli_fetch_assoc($result);

if($badgenumber_user) {
    if($badgenumber_user['matricola'] === $badgenumber) {
        array_push($errors, "A user with the same badgne number already exists");
    }
}

//se non si sono presentati errori durante lo svolgimento si procede con la query di inserimento
if(count($errors) == 0) {
    $password = md5($password_1); //crittograzione della password ;-)

    $query = "INSERT INTO Clienti (nome, cognome, e-mail, password, matricola, telefono) VALUES('$firstname', '$lastname', '$email', '$password', '$badgenumber', '$telephone')"
    mysqli_ query($db, $query);
    $_SESSION['matricola'] = $badgenumber;
    $_SESSION['success'] = "You are now logged in";
    //header(); 
} else {
  echo $error;
}
echo "ho finito";
?>
