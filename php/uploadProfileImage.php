<?php
    include('../script/dbConnect.php');
    include('../script/functions.php');
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    secure_session_start();
    if(login_check($conn)){
        if($_SESSION['type'] == SUPPLIER){
            $email = $_SESSION['email'];
            if ( $_FILES['file']['error'] > 0 ){
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            }
            else {
                if(move_uploaded_file($_FILES['file']['tmp_name'], '../profileImages/'.$email.".jpg"))
                {
                    echo "Immagine aggiornata correttamente";
                }
            }
           /* $query = "UPDATE fornitori SET immagineProfilo=? WHERE email=?";
          // $query="SELECT * from fornitori where email=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("bs",$content,$email);
            if($stmt->execute()){
                $stmt->store_result();
                echo json_encode("righe coinvolte=".$stmt->num_rows."mail =".$email."Immagine aggiornata correttamente,content=".$content."<br/>");
            }
            else{
                echo json_encode("Errore");
            }*/
            
        }
        else{
            echo "niente";
            echo $_SESSION['email'];
        }
    }
?>