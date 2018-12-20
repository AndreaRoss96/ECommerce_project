<?php
echo "Iniziato";
session_start();

$db = mysqli_connect('localhost', 'root', '', 'progettotweb');

$usermail = $_POST['usermail'];
$password = $_POST['password'];

$password = md5($password);
$query = "SELECT * FROM clienti WHERE email='$usermail' AND password='$password'";
$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) == 1) {
  $_SESSION['email'] = $usermail;
  $_SESSION['success'] = "You are now logged in";
  echo "logged in!!";
}else {
  echo "wrong username/password combination";
}
echo "Finito";
?>
