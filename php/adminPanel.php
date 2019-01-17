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
            echo $piva;
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
                if($row["approvazioneAmministratore"] == 0){
                    $approvazione = 1;
                    $to = $row["email"];
                    $subject = "admin@sito.it";
                    $txt = "L' account registrato con la seguente e-mail:".$to."e' stato approvato."
                            ."Ora puoi effettuare il login";
                    $headers = "Approvazione account fornitore";
                }
                else{
                    $approvazione = 0;
                    $to = $row["email"];
                    $subject = "admin@sito.it";
                    $txt = "L' account registrato con la seguente e-mail:".$to."e' stato temporaneamente disabilitato"
                            ."Riceverà ulteriori informazioni al più presto.";
                    $headers = "Sospensione account fornitore";
                }
                $stmt=$conn->prepare('UPDATE fornitori SET approvazioneAmministratore=? where P_IVA=?');
                $stmt->bind_param("is",$approvazione,$piva);
                $stmt->execute();
                mail($to,$subject,$txt,$headers);
            }
        }
       
    }
    else{
       echo ("FAIL");
    }

    
	

?>