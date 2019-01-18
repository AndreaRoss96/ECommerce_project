<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    } 
    secure_session_start();
	if(login_check($conn) and ($_SESSION['type']==ADMIN)){
        if(isset($_POST["getSuppliers"])){
            if($result = $conn->query('SELECT P_IVA,nomeRistorante,descrizione,
                                    indirizzoMaps,orarioApertura,
                                    orarioChiusura,email,nomeReferente,cognomeReferente,
                                    telefono,approvazioneAmministratore FROM fornitori'))
            {
                if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $suppliers[] = $row;
                    }
                }
            }
            else{
                echo "error";
            }
            echo json_encode($suppliers);
        }
        else if(isset($_POST["supplierToRemove"])){
            $piva = $_POST["supplierToRemove"];
            if($stmt=$conn->prepare('SELECT email FROM fornitori where P_IVA=?')){
                $stmt->bind_param("s",$piva);
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    $row = mysqli_fetch_assoc($result);
                    $destinatario = $row["email"];
                }
                $header = "Notifica eliminazione account";
                $txt = "L'account associato alla e-mail:".$destinatario." e' stato eliminato dall' amministratore";
                sendMail($destinatario,$header,$txt);
            }

            if($stmt=$conn->prepare('DELETE from fornitori where P_IVA=?')){
                $stmt->bind_param("s",$piva);
                $stmt->execute();  
            }else{
                 die("Error: ". $conn->error);
            }
        }
        else if(isset($_POST["supplierToChange"])){
            $piva = $_POST["supplierToChange"];
            $stmt=$conn->prepare('SELECT approvazioneAmministratore,email FROM fornitori where P_IVA=?');
            $stmt->bind_param("s",$piva);
            if($stmt->execute()){
                $result = $stmt->get_result();
                $row = mysqli_fetch_assoc($result);
                $destinatario = $row["email"];
                if($row["approvazioneAmministratore"] == 0){
                    $header = "Approvazione account fornitore";
                    $approvazione = 1;
                    $txt = "L' account registrato con la seguente e-mail:".$destinatario." e' stato approvato.\r\n"
                            ."Ora puoi effettuare il login";
                }
                else{
                    $approvazione = 0;
                    $header = "Sospensione account fornitore";
                    $txt = "L' account registrato con la seguente e-mail:".$destinatario." e' stato temporaneamente disabilitato\r\n"
                            ."Riceverà ulteriori informazioni al più presto.";
                }
                $stmt=$conn->prepare('UPDATE fornitori SET approvazioneAmministratore=? where P_IVA=?');
                $stmt->bind_param("is",$approvazione,$piva);
                $stmt->execute();
                sendMail($destinatario,$header,$txt);
            }
        }
       
    }
    else{
       echo ("FAIL");
    }

    
	

?>