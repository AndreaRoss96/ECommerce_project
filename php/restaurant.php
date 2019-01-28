<?php
$con = mysqli_connect('localhost', 'root', '', 'progettotweb');
$p_iva = $_GET["p_iva"];
$stmt = $con->prepare('SELECT nomeRistorante, descrizione, telefono, indirizzoMaps, email, orarioApertura, orarioChiusura FROM fornitori WHERE P_IVA=?');
$stmt->bind_param("s", $p_iva);
$stmt->execute();
$stmt->bind_result($nomeRistorante, $descrizione, $telefono, $indirizzoMaps, $email, $orarioApertura, $orarioChiusura);
$row = $stmt->fetch();
if(empty($row)) {
  header("Location: ../html/homepage.html");
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="../html/jquery/getNav.js"></script>
  <script src="../html/jquery/getFooter.js"></script>
  <link rel="stylesheet" href="../css/restaurant.css">
  <title>Ristorante</title>
</head>
<body>
  <div id="nav"> </div>
  <div class="card mb-3">
    <img class="card-img-top" src="../profileImages/<?php echo $email; ?>.jpg" alt="Progifle image">
    <div class="card-body">
      <h5 class="card-title"><?php echo $nomeRistorante; ?></h5>
      <p class="card-text"><?php echo $descrizione; ?></p>
      <div class="links">
        <?php
        $tmpAddress = str_replace(' ', '+', $indirizzoMaps);
        ?>
        <a href="https://www.google.com/maps/place/<?php echo $tmpAddress?>+Cesena" target="_blank"><address>
           <i class="fas fa-map-marker-alt"></i><?php echo " " . $indirizzoMaps; ?>
        </address></a>
           <i class="fas fa-phone"></i><?php echo " " . $telefono; ?>
           <br><br>
           <i class="far fa-clock"></i><?php echo " " . $orarioApertura . " - " . $orarioChiusura; ?>
      </div>
    </div>
  </div>
    <h2>Cosa offriamo</h2>
  <div class="menu">
    <div class="row">
    <div class="col-4">
      <div class="list-group" id="list-tab" role="tablist">
        <?php
          $conn = new mysqli('localhost', 'root', '', 'progettotweb');
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $tagArray = array();

          $query = "SELECT * FROM tag, tagportata WHERE tagportata.ristP_IVA = $p_iva AND tag.id = tagportata.idtag";
          $result = $conn->query($query);
          $isActive = 1;
          $alreadyAdded = array();
          while ($row = $result->fetch_assoc()) {

            $tagArray[] = $row;
            if(!in_array($row["nomeTag"], $alreadyAdded)) {
              $alreadyAdded[] = $row["nomeTag"];
              $toPrint = "<a class=\"list-group-item list-group-item-action";
              if($isActive) {
                $toPrint .= " active";
                $isActive = 0;
              }
              $toPrint .= "\" id=\"list-" . $row["nomeTag"] . "-list\" data-toggle=\"list\" href=\"#list-" . $row["nomeTag"] . "\" role=\"tab\">" . $row["nomeTag"] . "</a>";
              echo $toPrint;
            }
          }
          $conn->close();
        ?>
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">

        <?php
          $isActive = 1;
          for ($j = 0; $j < count($tagArray); $j++) {
            $toPrint = "<div class=\"tab-pane fade";
            if($isActive) {
              $toPrint .= " show active";
              $isActive = 0;
            }
            $toPrint .= "\" id=\"list-" . $tagArray[$j]["nomeTag"] . "\" role=\"tabpanel\" aria-labelledby=\"list-" . $tagArray[$j]["nomeTag"] . "-list\">";
            echo $toPrint;
            ?>
              <ul class="list-group list-group-flush">
                <?php
                  $conn = new mysqli('localhost', 'root', '', 'progettotweb');
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }
                  $query = "SELECT id, nome, portata.descrizione, prezzo FROM portata, tagportata WHERE portata.ristP_IVA =  $p_iva AND portata.id = tagportata.idPortata AND tagportata.idtag = " .  $tagArray[$j]["id"];
                  $result = $conn->query($query);
                  while ($row = $result->fetch_assoc()) { //con questo ciclo while mostro tutti i prodotti offerti da un fornitore in base ai tag a loro assegnati
                ?>
                  <li class="list-group-item">
                      <a class="product-link" href="cartAction.php?action=addToCart&id=<?php echo $row["id"];?>&p_iva=<?php echo $p_iva; ?>">
                        <div class="product-container">

                            <div class="product-info-container">
                            <div class = "product-name-container">
                              <?php echo $row["nome"];  ?>
                            </div>
                            <div class = "product-description-container">
                              <?php echo $row["descrizione"];  ?>
                            </div>
                            </div>

                          <div class="product-price-container">
                            <?php echo $row["prezzo"] . "€";   ?>
                          </div>
                        </div>
                      </a>
                  </li>

                <?php
                }
                  $conn->close();
                ?>
            <?php
                echo "</div>";
              }
        ?>
        </ul>
      </div> <!-- div che chiude la tavola contenente unicamente gli alimenti -->
      </div>
    </div>
  </div>
  <a onclick="location.href = 'restaurantList.php';" class="btn btn-warning"><i class="fas fa-chevron-left"></i> Prendi qualcos'altro</a>
  <div id="footer"></div>
</body>
</html>
