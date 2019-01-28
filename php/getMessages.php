<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    secure_session_start();
    if(login_check($conn)){
        if(isset($_POST['getMessages'])){
            $query = "SELECT testo,timestamp,letto,id FROM notifiche WHERE email=? order by timestamp desc";
            $stmt=$conn->prepare($query);
            $stmt->bind_param("s",$_SESSION['email']);
            if($stmt->execute()){
                $result = $stmt->get_result();
                while($row = mysqli_fetch_assoc($result)){
                    $response[] = $row;
                }            
            }
            echo json_encode($response);
        }
        else if(isset($_POST['confirmMessage'])){
            $idMessaggio = $_POST['idMessaggio'];
            $stmt=$conn->prepare('UPDATE notifiche SET letto=1 where id=?');
            $stmt->bind_param("i",$idMessaggio);
            $stmt->execute();
        }
        
    }
    
    


?>