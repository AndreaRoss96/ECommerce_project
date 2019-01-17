<?php
include('types.php');

function secure_session_start() {
        $session_name = 'sec_session_id'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}
function supplierLogin($email,$password,$conn){//da sistemare
    $stmt = $conn->prepare("SELECT P_IVA,nomeRistorante,nomeReferente,cognomeReferente,approvazioneAmministratore,password,salt FROM fornitori WHERE email=? LIMIT 1");
    $stmt->bind_param("s",$email);
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
    $stmt->bind_result($P_IVA, $nomeRistorante,$nomeReferente,$cognomeReferente,$approvazioneAmministratore, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
    $stmt->fetch();
    $password = hash('sha512', $password.$salt);
    if ($stmt->num_rows== 1 && $password == $db_password) {
      if($approvazioneAmministratore == 1){
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        $_SESSION['email'] = $email;

        $_SESSION['restaurantName'] = $nomeRistorante;

        $_SESSION['referenceName'] = $nomeReferente;

        $_SESSION['referenceSurname'] = $cognomeReferente;

        $_SESSION['adminApprovation'] = $approvazioneAmministratore;

        $_SESSION['type'] = SUPPLIER;

        $_SESSION['login_string'] = hash('sha512', $password.$user_browser);

      }
      else{
        $_SESSION['approvationError'] = true;
       // echo "still not approved";
      }
    }else {
      $_SESSION['loginError'] = true;
      //echo "wrong username/password combination2";
    } 
    header('Location: ../html/userSupplierLogin.html');
    exit;
}
function clientLogin($email,$password,$conn){
    $stmt = $conn->prepare("SELECT nome,cognome, password, salt FROM clienti WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
    $stmt->bind_result($nome, $cognome, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
    $stmt->fetch();
    $password = hash('sha512', $password.$salt);
    if ($stmt->num_rows == 1 && $password == $db_password) {
      $user_browser = $_SERVER['HTTP_USER_AGENT'];

      $_SESSION['email'] = $email;

      $_SESSION['name'] = $nome;

      $_SESSION['surname'] = $cognome;

      $_SESSION['type'] = CLIENT;

      $_SESSION['login_string'] = hash('sha512', $password.$user_browser);

    }else {
      //echo "wrong username/password combination";
      $_SESSION['loginError'] = true;
    }
    header('Location: ../html/userSupplierLogin.html');
    exit; 
}
function adminLogin($username,$password,$conn){
  $stmt = $conn->prepare("SELECT nome, cognome, password, salt FROM amministratori WHERE username = ? LIMIT 1");
  $stmt->bind_param('s', $username); // esegue il bind del parametro '$email'.
  $stmt->execute(); // esegue la query appena creata.
  $stmt->store_result();
  $stmt->bind_result($nome, $cognome, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
  $stmt->fetch();
  $password = hash('sha512', $password.$salt);
  if ($stmt->num_rows == 1 && $password == $db_password) {
    $user_browser = $_SERVER['HTTP_USER_AGENT'];

    $_SESSION['email'] = $username;

    $_SESSION['name'] = $nome;

    $_SESSION['surname'] = $cognome;

    $_SESSION['type'] = ADMIN;

    $_SESSION['login_string'] = hash('sha512', $password.$user_browser);

    header('Location: ../html/adminPanel.html');
    exit;
  }else {
    $_SESSION['loginError'] = true;
    header('Location: ../html/adminLogin.html');
    exit;
    //echo "wrong username/password combination";
  } 
}

function login_check($conn) {
  // Verifica che tutte le variabili di sessione siano impostate correttamente
  if(isset($_SESSION['email'],$_SESSION['type'],  $_SESSION['login_string'])) {
    $email = $_SESSION['email'];
    $login_string = $_SESSION['login_string'];    
    $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
    if($_SESSION['type'] == SUPPLIER){
      $query="SELECT password FROM fornitori WHERE email = ? LIMIT 1";
    }
    elseif($_SESSION['type'] == CLIENT){
      $query="SELECT password FROM clienti WHERE email = ? LIMIT 1";
    }
    else{
      $query="SELECT password FROM amministratori WHERE username = ? LIMIT 1";
    }
    if ($stmt = $conn->prepare($query)) { 
       $stmt->bind_param('s', $email); // esegue il bind del parametro '$user_id'.
       $stmt->execute(); // Esegue la query creata.
       $stmt->store_result();

       if($stmt->num_rows == 1) { // se l'utente esiste
          $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
          $stmt->fetch();
          $login_check = hash('sha512', $password.$user_browser);
          if($login_check == $login_string) {
             // Login eseguito!!!!
             return true;
          } else {
             //  Login non eseguito
             return false;
          }
       } else {
           // Login non eseguito
           return false;
       }
    } else {
       // Login non eseguito
       return false;
    }
  } else {
    // Login non eseguito
    return false;
  }
}


?>