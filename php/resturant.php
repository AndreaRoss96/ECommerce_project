<?php
$con = mysqli_connect('localhost', 'root', '', 'progettotweb');
$p_iva = $_GET["p_iva"];
$stmt = $con->prepare('SELECT nomeRistorante, descrizione, telefono, indirizzoMaps, email, orarioApertura, orarioChiusura FROM fornitori WHERE P_IVA=?');
$stmt->bind_param("s", $p_iva);
$stmt->execute();
$stmt->bind_result($nomeRistorante, $descrizione, $telefono, $indirizzoMaps, $email, $orarioApertura, $orarioChiusura);
$row = $stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="../html/jquery/getNav.js"></script>
  <script src="../html/jquery/getFooter.js"></script>
<style>
.mb-3 {
  padding: 0px 0px 15px;
  border-left: none;
  border-right: none;
}

.card-title { /*Nome ristorante*/
  font-family: bree serif;
  font-size: 250%;
}

.card-text { /*descrizione ristorante*/
  font-family: roboto;
  font-size: 120%;
}

.links {
  display: block;
  float: right;
}

.comboboxes {
  padding: 15px;
}

h2, h3 {
  font-family: roboto;
  font-size: 150%;
}

.menu {
  padding: 15px 15px 10%;
}

.product-container { /*container menu*/
  display: flex;
  cursor: pointer;
}

.product-name-container {
  font-family: bree serif;
  font-size: 120%;
}

.product-description-container {
  font-size: 80%;
  font-family: roboto;
}

.product-price-container { /*lista dei cibi a seconda della categoria */
  text-align: right;
  position: absolute;
  right: 10px;
}

.product-link {
  color: black;
}

.product-link:hover {
  text-decoration: none;
  color: #808080;
}
</style>
</head>
<body>
  <div id="nav"> </div>
  <div class="card mb-3">
    <img class="card-img-top" src="../res/bacon-cheese-burger.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?php echo $nomeRistorante; ?></h5>
      <p class="card-text"><?php echo $descrizione; ?></p>
      <div class="links">
        <?php
        $tmpAddress = str_replace(' ', '+', $indirizzoMaps);
        ?>
        <a href="https://www.google.com/maps/place/<?php echo $tmpAddress?>" target="_blank"><address>
           <i class="fas fa-map-marker-alt"></i><?php echo " " . $indirizzoMaps; ?>
        </address></a>
           <i class="fas fa-phone"></i><?php echo " " . $telefono; ?>
      </div>
    </div>
  </div>
  <form class="" action="" method="post">
  <div class="comboboxes">
    <h2>Cosa offriamo</h2>

    <!-- <h3>Luogo</h3>
    <form class="" action="" method="post">
      <select name="location" id="location" class="custom-select sources" placeholder="Dove consegnamo?">
        <option value="primo-piano">Primo piano</option>
        <option value="piano-terra">Piano terra</option>
      </select>
    </form> -->

    <h3>Orario</h3>
    <select name="time" id="time" class="custom-select sources" placeholder="A che ora?">
      <?php
        $orarioTmp = $orarioApertura;
        while ($orarioTmp != $orarioChiusura) {
          $toPrint = "<option value=\"time\">" . $orarioTmp . " - ";
          $minutesTmp = (int) $orarioTmp[3] + 1; //aumento il valore dei minuti es. 12:10 -> 12:20
          $hourTmp = (int) substr($orarioTmp, 0, 2);
          if ($minutesTmp == 6) {
            $minutesTmp = 0;
            $hourTmp = $hourTmp + 1;
          }
          $orarioTmp[3] = $minutesTmp;
          $orarioTmp[0] = substr($hourTmp, 0, 1);
          $orarioTmp[1] = substr($hourTmp, 1, 1);
          $toPrint .= $orarioTmp . "</option>";
          echo $toPrint;
        }
      ?>
  </select>
  </div>
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
          while ($row = $result->fetch_assoc()) {
              $tagArray[] = $row;
              $toPrint = "<a class=\"list-group-item list-group-item-action";
              if($isActive) {
                $toPrint .= " active";
                $isActive = 0;
              }
              $toPrint .= "\" id=\"list-" . $row["nomeTag"] . "-list\" data-toggle=\"list\" href=\"#list-" . $row["nomeTag"] . "\" role=\"tab\" aria-controls=\"" . $row["nomeTag"] . "\">" . $row["nomeTag"] . "</a>";
              echo $toPrint;
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
      </div> <!-- div che chiude la tavola contenente unicamente gli alimenti -->
      </div>
    </div>
  </div>
  </form>
  <script type="text/javascript">
    $(document).ready(function(){
      $('li.list-group-item').on('click', function(e){
          $('form').submit();
      });
    });
  </script>
  <div id="footer"></div>
</body>
</html>
