<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    } 
    secure_session_start();
	if(login_check($conn) and ($_SESSION['type']==SUPPLIER)){
        if(isset($_POST["getOrders"])){
            $pIva = $_SESSION['P_IVA'];
            $query ='SELECT o.id,p.nome,dop.quantita,lc.luogo,o.orarioConsegna,dop.inConsegna FROM ordine o, dettaglioordine dop, luogoconsegna lc, portata p WHERE o.id = dop.idOrdine AND lc.id = o.idLuogoConsegna AND p.id = dop.idPortata AND p.ristP_IVA = dop.ristP_IVA AND dop.ristP_IVA =' . $pIva;
            if($result = $conn->query($query))
            {
                if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $orders[] = $row;
                    }
                }
            }
            else{
                echo "error";
            }
            echo json_encode($orders);
        }
        else if(isset($_POST["sendOrder"])){
            $piva = $_SESSION["P_IVA"];
            /*if($stmt=$conn->prepare('SELECT email FROM fornitori where P_IVA=?')){
                $stmt->bind_param("s",$piva);
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    $row = mysqli_fetch_assoc($result);
                    $destinatario = $row["email"];
                }
                $header = "Notifica eliminazione account";
                $txt = "L'account associato alla e-mail:".$destinatario." e' stato eliminato dall' amministratore";
                sendMail($destinatario,$header,$txt);
            }*/

            if($stmt=$conn->prepare('UPDATE dettaglioordine SET inConsegna=1 where ristP_IVA = ? AND idOrdine = ?')){
                $stmt->bind_param("ss",$piva,$_POST['idOrder']);
                $stmt->execute();  
            }else{
                 die("Error: ". $conn->error);
            }
        }
       
       
    }
    else{
       echo ("FAIL");
    }

    
	

?>