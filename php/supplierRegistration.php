<?php
	include('../script/dbConnect.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	echo $_POST["p1"];
	if (isset($_POST["nomeAttivita"], 
			  $_POST["P_IVA"],
			  $_POST["nomeReferente"],
		      $_POST["cognomeReferente"],
			  $_POST["telefono"],
			  $_POST["indirizzo"],
			  $_POST["orarioApertura"],
			  $_POST["orarioChiusura"],
			  $_POST["descrizioneAttivita"],
			  $_POST["email"],
			  $_POST["p1"],
			  $_POST["p2"]))
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
		$pwd = $_POST["p1"];
		$confermaPwd = $_POST["p2"];
		
		if($pwd == $confermaPwd) {
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$pwd = hash('sha512', $pwd.$random_salt);

			$stmt = $conn->prepare('SELECT email FROM fornitori where email=?');
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if (mysqli_num_rows($result) <= 0) {
				$stmt = $conn->prepare('INSERT INTO fornitori(nomeRistorante, P_IVA, nomeReferente, cognomeReferente, telefono, indirizzoMaps, orarioApertura, orarioChiusura, descrizione, email, password,salt) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
				$stmt->bind_param("ssssssssssss", $nomeAttivita, $P_IVA,$nomeReferente,$cognomeReferente,$telefono,$indirizzo,$orarioApertura,$orarioChiusura,$descrizione,$email,$pwd,$random_salt);
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