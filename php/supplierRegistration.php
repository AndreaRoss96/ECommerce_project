<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "progettotweb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	if (isset($_POST["nomeAttivita"]) and 
		isset($_POST["P_IVA"]) and 
		isset($_POST["nomeReferente"]) and
		isset($_POST["cognomeReferente"]) and
		isset($_POST["telefono"]) and
		isset($_POST["indirizzo"]) and
		isset($_POST["orarioApertura"]) and
		isset($_POST["orarioChiusura"]) and
		isset($_POST["descrizioneAttivita"]) and
		isset($_POST["email"]) and
		isset($_POST["password"]) and
		isset($_POST["confermaPassword"]))
	{
		$nomeAttivita = $_POST["nomeAttivita"];
		$P_IVA = $_POST["P_IVA"];
		$nomeReferente = $_POST["nomeReferente"];
		$cognomeReferente = $_POST["cognomeReferente"];
		$telefono = $_POST["telefono"];
		$indirizzo = $_POST["indirizzo"];
		$orarioApertura = $_POST["orarioApertura"];
		$orarioChiusura = $_POST["orarioChiusura"];
		$descrizione = $_POST["descrizioneAttivita"];
		$email = $_POST["email"];
		$pwd = $_POST["password"];
		$confermaPwd = $_POST["confermaPassword"];
		
		if($pwd == $confermaPwd) {
			
			$stmt = $conn->prepare('SELECT email FROM fornitori where email=? OR nomeRistorante=?');
			$stmt->bind_param("ss", $email, $nameBusiness);
			$stmt->execute();
			$result = $stmt->get_result();
			if (mysqli_num_rows($result) <= 0) {
				$stmt = $conn->prepare('INSERT INTO fornitori(nomeRistorante, P_IVA, nomeReferente, cognomeReferente, telefono, indirizzoMaps, orarioApertura, orarioChiusura, descrizione, email, password) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
				$stmt->bind_param("sssssssssss", $nomeAttivita, $P_IVA,$nomeReferente,$cognomeReferente,$telefono,$indirizzo,$orarioApertura,$orarioChiusura,$descrizione,$email,$password);
				$stmt->execute();
				$stmt->close();
				echo "Record inserito correttamente";
			} else {
				echo "Fornitore già esistente";
			}
		} else {
			echo "password errata";
		}
	} else {
		echo "campi non tutti compilati" . "<br/>";
		echo $_POST["nomeAttivita"] . "<br/>";
		echo $_POST["P_IVA"] . "<br/>";
		echo $_POST["nomeReferente"] . "<br/>";
		echo $_POST["cognomeReferente"] . "<br/>";
		echo $_POST["email"] . "<br/>";
		echo $_POST["password"] . "<br/>";
		echo $_POST["confermaPassword"] . "<br/>";
	}
?>