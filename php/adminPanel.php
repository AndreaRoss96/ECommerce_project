<?php
	include('../script/dbConnect.php');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	if(isset($_POST["getSuppliers"])){
        if($result = $conn->query('SELECT P_IVA,nomeRistorante,descrizione,
                                indirizzoMaps,orarioApertura,
                                orarioChiusura,email,nomeReferente,cognomeReferente,
                                telefono,approvazioneAmministratore FROM fornitori'))
        {
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $suppliers[] = $row;/*array($row["P_IVA"],$row["nomeRistorante"],
                                        $row["descrizione"],$row["indirizzoMaps"],
                                        $row["orarioApertura"],$row["orarioChiusura"],
                                        $row["email"],$row["nomeReferente"],
                                        $row["cognomeReferente"],$row["telefono"],
                                        $row["approvazioneAmministratore"]);*/
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
        $stmt=$conn->prepare('DELETE from fornitori where P_IVA=?');
        $stmt->bind_param("s",$piva);
        $stmt->execute();
        
    }
    else if(isset($_POST["supplierToChange"])){
        $piva = $_POST["supplierToChange"];
        $stmt=$conn->prepare('SELECT approvazioneAmministratore FROM fornitori where P_IVA=?');
        $stmt->bind_param("s",$piva);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row = mysqli_fetch_assoc($result);
            if($row["approvazioneAmministratore"] == 0){
                $approvazione = 1;
            }
            else{
                $approvazione = 0;
            }
            $stmt=$conn->prepare('UPDATE fornitori SET approvazioneAmministratore=? where P_IVA=?');
            $stmt->bind_param("is",$approvazione,$piva);
            $stmt->execute();
        }
    }

    
	

?>