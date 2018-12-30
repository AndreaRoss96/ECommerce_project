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
	
	if (isset($_POST["nomePietanza"]) and 
		isset($_POST["ingredienti"]) and 
		isset($_POST["tags"]) and
		isset($_POST["P_IVA"]) and
		isset($_POST["prezzo"])) {
			$nomePietanza = $_POST["nomePietanza"];
			$P_IVA = $_POST["P_IVA"];
			$ingredienti = $_POST["ingredienti"];
			$tags = $_POST["tags"];
			$prezzo = $_POST["prezzo"];
			
			if (isset($_POST["aggiungi"])) {
				$stmt = $conn->prepare('INSERT INTO portata(ristP_IVA, nome, descrizione, prezzo) VALUES(?,?,?,?)');
				$stmt->bind_param("sssf", $nome, $P_IVA,$ingredienti,$prezzo);
				$stmt->execute();
				$stmt->close();
			} elseif (isset($_POST["modifica"])) {
				$stmt = $conn->prepare('UPDATE portata SET nome=?, descrizione=?, prezzo=?) VALUES(?,?,?,?)');
				$stmt->bind_param("sssf", $nome, $P_IVA,$ingredienti,$prezzo);
				$stmt->execute();
				$stmt->close();
			}
		
		/*if($pwd == $confermaPwd) {
			
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
		*/
	} else {
		echo "campi non tutti compilati" . "<br/>";
		echo $_POST["nomePietanza"] . "<br/>";
		echo $_POST["P_IVA"] . "<br/>";
		echo $_POST["ingredienti"] . "<br/>";
		echo $_POST["tags"] . "<br/>";
		echo $_POST["prezzo"] . "<br/>";
	}
?>