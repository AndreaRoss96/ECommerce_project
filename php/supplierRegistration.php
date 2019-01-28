<?php
	include('../script/dbConnect.php');
	include('../script/functions.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
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
		secure_session_start();
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
		
		if($pwd === $confermaPwd) {
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$pwd = hash('sha512', $pwd.$random_salt);

			$stmt = $conn->prepare('SELECT email FROM fornitori where email=?');
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result1 = $stmt->get_result();

			$stmt = $conn->prepare('SELECT email FROM clienti where email=?');
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result2 = $stmt->get_result();

			if ($result1->num_rows == 0 && $result2->num_rows == 0) {

				$stmt = $conn->prepare('SELECT P_IVA FROM fornitori where P_IVA=?');
				$stmt->bind_param("s", $P_IVA);
				$stmt->execute();
				$result3 = $stmt->get_result();
				if($result3->num_rows == 0){
					$stmt = $conn->prepare('INSERT INTO fornitori(nomeRistorante, P_IVA, nomeReferente, cognomeReferente, telefono, indirizzoMaps, orarioApertura, orarioChiusura, descrizione, email, password,salt) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
					$stmt->bind_param("ssssssssssss", $nomeAttivita, $P_IVA,$nomeReferente,$cognomeReferente,$telefono,$indirizzo,$orarioApertura,$orarioChiusura,$descrizione,$email,$pwd,$random_salt);
					$stmt->execute();
					$stmt->close();
					sendMail($email,"Creazione account fornitore","Grazie per esserti unito alla nostra community!\r\nPrima di poter usare i nostri servizi il tuo account dovra' essere approvato dall' amministratore di sistema");
					$adminMail = "amministratoreprogettotweb@gmail.com";
					$txt = "Un nuovo fornitore (".$email.") si e' registrato e dovra' essere approvato";
					sendMail($adminMail,"Nuovo fornitore",$txt);
					sendNotice($conn,$adminMail,$txt);
					header('Location: ../html/successfulSupplierRegistration.html');
					exit;
				}
				else{
					$_SESSION['P_IVAAlreadyUsed'] = true;
				}
				$stmt->close();

				//echo"Questo account è stato creato correttamente";
			} else {
				$_SESSION['emailAlreadyUsed'] = true;
				//echo "Attenzione: è già presente un account che usa questa e-mail";
			}
		} else {
			$_SESSION['passwordsDontMatch'] = true;
			//echo "Le due password non coincidono";
		}
	} else {
		$_SESSION['fieldsNotFilled'] = true;
		//echo "Non tutti i campi sono stati compilati"."<br/>";
	}
	header('Location: ../html/supplierRegistrationForm.html');
?>