<?php
	include('../script/functions.php');
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "progettotweb";
	secure_session_start();
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
			$tags = explode(';',$_POST["tags"]);
			$prezzo = $_POST["prezzo"];
			echo $nomePietanza . "<br/>";
			echo $P_IVA . "<br/>";
			echo $_POST["ingredienti"] . "<br/>";
			array_pop($tags);
			print_r($tags);
			echo "<br/>";
			echo $_POST["prezzo"] . "<br/>";
			if (isset($_POST["aggiungi"])) {
				echo "aggiungi";
				$stmt = $conn->prepare('INSERT INTO portata(ristP_IVA, nome, descrizione, prezzo) VALUES(?,?,?,?)');
				$stmt->bind_param("sssd", $P_IVA, $nomePietanza,$ingredienti,$prezzo);
				$stmt->execute();
				$stmt->close();
				$stmt = $conn->prepare('SELECT id from portata WHERE nome=? AND ristP_IVA=?');
				$stmt->bind_param("ss", $nomePietanza, $P_IVA);
				$stmt->execute();
				$idPortata = $stmt->get_result()->fetch_assoc()["id"];
				echo  "<br/>" . "portata prima di stmt close :" . $idPortata . "<br/>";
				$stmt->close();
				$stmt = $conn->prepare('INSERT INTO tagportata(idPortata, ristP_IVA, idTag) VALUES(?,?,?)');
				foreach ($tags as $val) {
					echo "TAG: " . $val . "<br/>";
					echo "PORTATA: " . $idPortata . "<br/>";
					echo "P_IVA: " . $P_IVA . "<br/>";
					$stmt->bind_param("isi", $idPortata, $P_IVA, $val);
					$stmt->execute();
				}
				$_SESSION['testoAlert'] = "Inserimento effettuato correttamente";
				$stmt->close();
			} elseif (isset($_POST["modifica"])) {
				if (!isset($_POST["nomePietanzaVecchio"])) {
					echo "error";
				} else {	
					echo "edit";
					$nomePietanzaVecchio = $_POST["nomePietanzaVecchio"];
					$stmt = $conn->prepare('SELECT id FROM portata WHERE ristP_IVA = ? AND nome = ?');
					$stmt->bind_param("ss", $P_IVA, $nomePietanzaVecchio);
					$stmt->execute();
					$idPortata = $stmt->get_result()->fetch_assoc()["id"];
					echo "<br/>" . "L'ID DELLA PORTATA IN MODALITà EDIT: " . $idPortata . "<br/>";
					$stmt->close();
					$stmt = $conn->prepare('UPDATE portata SET nome=?, descrizione=?, prezzo=? WHERE ristP_IVA = ? AND id = ?');
					$stmt->bind_param("ssdsi", $nomePietanza, $ingredienti,$prezzo, $P_IVA, $idPortata);
					$stmt->execute();
					$stmt->close();
					$stmt = $conn->prepare('DELETE FROM tagportata WHERE ristP_IVA = ? AND idPortata = ?');
					$stmt->bind_param("ss", $P_IVA, $idPortata);
					$stmt->execute();
					$stmt->close();
					$stmt = $conn->prepare('INSERT INTO tagportata(idPortata, ristP_IVA, idTag) VALUES(?,?,?)');
					foreach ($tags as $val) {
						echo "TAG: " . $val . "<br/>";
						echo "PORTATA: " . $idPortata . "<br/>";
						echo "P_IVA: " . $P_IVA . "<br/>";
						$stmt->bind_param("isi", $idPortata, $P_IVA, $val);
						$stmt->execute();
					}
					$_SESSION['testoAlert'] = "Aggiornamento effettuato correttamente";
					$stmt->close();
				}
			} elseif (isset($_POST["elimina"])) {
				echo "delete";
				$nomePietanza = $_POST["nomePietanza"];
				$stmt = $conn->prepare('SELECT id FROM portata WHERE ristP_IVA = ? AND nome = ?');
				$stmt->bind_param("ss", $P_IVA, $nomePietanza);
				$stmt->execute();
				$idPortata = $stmt->get_result()->fetch_assoc()["id"];
				$stmt->close();
				$stmt = $conn->prepare('DELETE FROM portata WHERE id=? AND ristP_IVA = ?');
				$stmt->bind_param("is", $idPortata, $P_IVA);
				$stmt->execute();
				$stmt->close();
				$stmt = $conn->prepare('DELETE FROM portata WHERE id=? AND ristP_IVA = ?');
				$stmt->bind_param("is", $idPortata, $P_IVA);
				$stmt->execute();
				$stmt->close();
				$stmt = $conn->prepare('DELETE FROM tagportata WHERE idPortata=? AND ristP_IVA = ?');
				$stmt->bind_param("is", $idPortata, $P_IVA);
				$stmt->execute();
				$_SESSION['testoAlert'] = "Eliminazione effettuata correttamente";
				$stmt->close();
			}
			header('Location: ../php/foodInsertForm.php');
			exit;
	} else {
		echo "campi non tutti compilati" . "<br/>";
		echo $_POST["nomePietanza"] . "<br/>";
		echo $_POST["P_IVA"] . "<br/>";
		echo $_POST["ingredienti"] . "<br/>";
		echo $_POST["tags"] . "<br/>";
		echo $_POST["prezzo"] . "<br/>";
	}
?>