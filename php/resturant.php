<?php
$con = mysqli_connect('localhost', 'root', '', 'progettotweb');
$stmt = $con->prepare('SELECT nomeRistorante, descrizione, telefono, indirizzoMaps, email, orarioApertura, orarioChiusura FROM fornitori WHERE P_IVA=?');
$stmt->bind_param("s", $_GET["p_iva"]);
$stmt->execute();
$stmt->bind_result($nomeRistorante, $descrizione, $telefono, $indirizzoMaps, $email, $orarioApertura, $orarioChiusura);
$row = $stmt->fetch();
echo $nomeRistorante . " <- nome del ristorante <br>";
$stmt->close();
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
      <option value="time">12:00 - 12:10</option>
      <option value="time">12:10 - 12:20</option>
      <option value="time">12:20 - 12:30</option>
      <option value="time">12:30 - 12:40</option>
      <option value="time">12:40 - 12:50</option>
      <option value="time">12:50 - 13:00</option>
      <option value="time">13:00 - 13:10</option>
      <option value="time">13:10 - 13:20</option>
      <option value="time">13:20 - 13:30</option>
      <option value="time">13:30 - 13:40</option>
      <option value="time">13:50 - 14:00</option>
    </select>
  </div>
  <div class="menu">
    <div class="row">
    <div class="col-4">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-starter-list" data-toggle="list" href="#list-starter" role="tab" aria-controls="starter">Antipasti</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-first" role="tab" aria-controls="first">Primi</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-meat" role="tab" aria-controls="meat">Carne</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-fish" role="tab" aria-controls="fish">Pesce</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-sweet" role="tab" aria-controls="sweet">Dolci</a>
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-starter" role="tabpanel" aria-labelledby="list-starter-list">
          <ul class="list-group list-group-flush">
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
