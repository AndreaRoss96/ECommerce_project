<?php
$con = mysqli_connect('localhost', 'root', '', 'progettotweb');
$stmt = $con->prepare('SELECT nomeRistorante, descrizione, telefono, indirizzoMaps, email, orarioApertura, orarioChiusura FROM fornitori WHERE P_IVA=?');
$stmt->bind_param("s", $_GET["p_iva"]);
$stmt->execute();
$stmt->bind_result($nomeRistorante, $descrizione, $telefono, $indirizzoMaps, $email, $orarioApertura, $orarioChiusura);
$row = $stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
  width: 100%;
  text-align: right;
}
</style>
</head>
<body>
  <div class="card mb-3">
    <img class="card-img-top" src="../res/bacon-cheese-burger.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?php echo $nomeRistorante; ?></h5>
      <p class="card-text"><?php echo $descrizione; ?></p>
      <div class="links">
        <a href="https://www.google.com/maps/" target="_blank"><address>
           <i class="fas fa-map-marker-alt"></i><?php echo " " . $indirizzoMaps; ?>
        </address></a>
           <i class="fas fa-phone"></i><?php echo " " . $telefono; ?>
      </div>
    </div>
  </div>
  <div class="comboboxes">
    <h2>Informazioni sulla consegna</h2>
    <h3>Luogo</h3>
    <select name="sources" id="sources" class="custom-select sources" placeholder="Dove consegnamo?">
      <option value="primo-piano">Primo piano</option>
      <option value="piano-terra">Piano terra</option>
    </select>

    <h3>Orario</h3>
    <select name="sources" id="sources" class="custom-select sources" placeholder="A che ora?">
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
        <!--
        $conn = new mysqli('localhost', 'root', '', 'progettotweb');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $tagArray = array();

        $query = "SELECT * FROM tag";
        $result = $conn->query($query);
        $isActive = 1;
        while ($row = $result->fetch_assoc()) {
            $tagArray[] = $row;
            $toPrint = "<a class="list-group-item list-group-item-action";
            if(isActive) {
              $toPrint .= "active";
              $isActive = 0;
            }
            $toPrint .= "\" id=\"list-" . $row . "-list\" data-toggle=\"list\" href=\"#list-" . $row . "\" role=\"tab\" aria-controls=\"" . $row . "\">" . $row . "</a>;
            echo $toPrint;
        }
        $conn->close();
      -->
        <a class="list-group-item list-group-item-action active" id="list-starter-list" data-toggle="list" href="#list-starter" role="tab" aria-controls="starter">Antipasti</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-first" role="tab" aria-controls="first">Primi</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-meat" role="tab" aria-controls="meat">Carne</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-fish" role="tab" aria-controls="fish">Pesce</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-sweet" role="tab" aria-controls="sweet">Dolci</a>

        <!-- fino a qui fatto in php-->
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <!--
        $isActive = 1;
        for ($j = 0; $j < count($tagArray); $j++) {
          $toPrint = "<div class=\"tab-pane fade show";
          if(isActive) {
            $toPrint .= "active";
            $isActive = 0;
          }
          $toPrint .= "id=\"list-" . $tagArray[$j] . "\" role=\"tabpanel\" aria-labelledby=\"list-" . $tagArray[$j] . "-list\">";
          echo $toPrint;
          ?>
          codice html che hai fatto sotto
          < php
          echo "</div>";
          }
          ?>
      -->
        <div class="tab-pane fade show active" id="list-starter" role="tabpanel" aria-labelledby="list-starter-list">
          <ul class="list-group list-group-flush">
            <?php
              $conn = new mysqli('localhost', 'root', '', 'progettotweb');
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $query = "SELECT nome, portata.descrizione, prezzo FROM portata JOIN fornitori ON fornitori.P_IVA = portata.ristP_IVA";
              $result = $conn->query($query);

              while ($row = $result->fetch_assoc()) {
                echo "<li class=\"list-group-item\">
                          <div class=\"product-container\">
                            <div class=\"product-info-container\">
                            <div class = \"product-name-container\">".
                              $row["nome"] .
                            "</div>
                            <div class = \"product-description-container\"> " .
                              $row["descrizione"] .
                            "</div>
                            </div>
                            <div class=\"product-price-container\">".
                              $row["prezzo"] .
                            "</div>
                          </div>
                        </li>";
              }
              $conn->close();
            ?>
            <li class="list-group-item">
              <div class="product-container">
                <div class="product-info-container">
                  Antipasto1
                </div>
                <div class="product-price-container">
                  777€
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="product-container">
                <div class="product-info-container">
                  Antipasto2
                </div>
                <div class="product-price-container">
                  777€
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="product-container">
                <div class="product-info-container">
                  Antipasto3
                </div>
                <div class="product-price-container">
                  777€
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="product-container">
                <div class="product-info-container">
                  Antipasto4
                </div>
                <div class="product-price-container">
                  777€
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="product-container">
                <div class="product-info-container">
                  Antipasto5
                </div>
                <div class="product-price-container">
                  777€
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="tab-pane fade" id="list-first" role="tabpanel" aria-labelledby="list-first-list">...</div>
        <div class="tab-pane fade" id="list-meat" role="tabpanel" aria-labelledby="list-meat-list">...</div>
        <div class="tab-pane fade" id="list-fish" role="tabpanel" aria-labelledby="list-fish-list">...</div>
        <div class="tab-pane fade" id="list-fish" role="tabpanel" aria-labelledby="list-sweet-list">...</div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>
