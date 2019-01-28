<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    secure_session_start();
    if(login_check($conn)){
        $query = "SELECT COUNT(*) as numeroMessaggiNonLetti FROM notifiche WHERE email=? AND letto=0";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$_SESSION['email']);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row = mysqli_fetch_assoc($result);
            $response=array("numeroMessaggiNonLetti" => $row['numeroMessaggiNonLetti']);
            
        }
        echo json_encode($response);
        
    }
    
    


?>