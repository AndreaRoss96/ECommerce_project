<?php
include('../script/dbConnect.php');
include ('Cart.php');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cart = new Cart;

if(!login_check($conn)){
  header("Location: ../html/userSupplierLogin.html"); //Se il cliente non è connesso redirige alla pagina di login
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Carrello</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <style>
    h1{
      font-family: bree serif;
    }
    .container{width: 100%;padding: 50px 0px;}
    .table{float: left;}
    .table thead {
      font-size: 17px;
      font-family: bree serif;
    }
    .table tbody {
      font-size: 15px;
      font-family: roboto;
    }
    .table tfoot{
      font-size: 17px;
      font-family: bree serif;
    }
    p {
      font-family: Arial;
      font-size: 13px;
    }
    .form-control { /*Comando relativo alla quantità*/
      font-size: 15px;
    }
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    .form-control {
      width: 50%;
    }
    .info-delivery{
      font-family: roboto;
      display: block;
      margin: 0px auto;
      padding: 10% 30%;
      font-size: 15px;
      height: 100%;
    }
    .info-delivery * {
      margin: 5px;
      height: auto;
    }
    .btn {
      font-size: 17px;
    }
    .btn-success span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }

    .btn-success span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }

    .btn-success:hover span:after {
      opacity: 1;
      right: 0;
    }

    .btn-success:hover span {
      padding-right: 25px;
    }
   .btn-warning {
      opacity: 1;
      transition: 0.3s;
    }
    .btn-warning:hover {
      opacity: 0.6;
    }
    </style>
    <script>
    function updateCartItem(obj,id){
      $.get("cartAction.php", {
        action:"updateCartItem", id:id, qty:obj.value
      }, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Impossibile aggiornare il carrello, perfavore riprova più tardi');
        }
      });
    }
</script>
</head>
<body>
<div id="nav"></div>
<div class="container">
    <h1>Ecco cos'hai ordinato</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Prodotto</th>
            <th>Prezzo</th>
            <th>Quantità</th>
            <th>Totale prodotto</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //prende gli elementi del carrello della sessione
            $cartItems = $cart->contents();

            $selectedResturant = array();

            foreach($cartItems as $item){
        ?>
        <tr>
            <td class="product-name"><?php echo $item["name"]; ?> <!--<br> < ?php echo $item["p_iva"]; ?> --></td>
            <td><?php echo $item["price"].' €'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo $item["subtotal"].' €'; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro di volerlo cancellare?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php
              array_push($selectedResturant, $item["p_iva"]);
            }
      }else{ ?>
        <tr><td colspan="5"><p>Non hai ancora selezionato niente!</p></td></tr>
<?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td><a onclick="history.back()" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Prendi qualcos'altro</a></td>
        <td colspan="2"></td>
        <td class="text-center"><strong>Totale <br> <?php echo $cart->total().' €'; ?></strong> <br> <p> + costo spedizione (0,50€)</p></td>
      </tr>
    </tfoot>
    </table>
          <?php if($cart->total_items() > 0){ ?>
        <div class="info-delivery">
        <form action="cartCheckout.php" method="post">
              <h3>Dove te lo portiamo?</h3>
              <select name="location" id="location" class="custom-select sources">
                <option value="primo-piano">Primo piano</option>
                <option value="piano-terra">Piano terra</option>
              </select>
              <select name="time" id="time" class="custom-select sources">
              <?php
              /*
              Vengono selezionati l'orario di apertura più in ritardo di ogni ristorante
              e l'orario di chiusura più basso tra i ristoranti selezionati
              */
                $maxApertura = "00:00";
                $minChiusura = "23:59";
                foreach ($selectedResturant as $rest_p_iva) {
                  $stmt = $conn->prepare('SELECT orarioApertura, orarioChiusura FROM fornitori WHERE P_IVA=' . $rest_p_iva);
                  $stmt->execute();
                  $stmt->bind_result($tmpApertura, $tmpChiusura);
                  $row = $stmt->fetch();
                  if($tmpApertura > $maxApertura) {
                    $maxApertura = $tmpApertura;
                  }
                  if($tmpChiusura < $minChiusura) {
                    $minChiusura = $tmpChiusura;
                  }
                }
                $orarioTmp = $maxApertura;
                while ($orarioTmp != $minChiusura) {
                  $toPrint = "<option value=\"" . $orarioTmp;
                  $text = "\">" . $orarioTmp . " - ";
                  $minutesTmp = (int) $orarioTmp[3] + 1; //aumento il valore dei minuti es. 12:10 -> 12:20
                  $hourTmp = (int) substr($orarioTmp, 0, 2);
                  if ($minutesTmp == 6) {
                    $minutesTmp = 0;
                    $hourTmp = $hourTmp + 1;
                  }
                  $orarioTmp[3] = $minutesTmp;
                  $orarioTmp[0] = substr($hourTmp, 0, 1);
                  $orarioTmp[1] = substr($hourTmp, 1, 1);
                  $toPrint .= " - " . $orarioTmp;
                  $text .= $orarioTmp . "</option>";
                  $toPrint .= $text;
                  echo $toPrint;
                }

              ?>
              </select>
              <button type="submit" class="btn btn-success btn-block"><span>Ordina!</span></button>
            </form>
            </div>

            <!-- <td><a href="cartCheckout.php" class="btn btn-success btn-block">Ordina!<i class="glyphicon glyphicon-menu-right"></i></a></td> -->
          <?php } ?>

    <!-- <div class="shipAddr">
        <h4>Dettagli di spedizione</h4>
        <p>< ? php echo ($_SESSION['name'] . $_SESSION['surname']); ?></p>
        <p>< ?php echo ($_SESSION['email']); ?></p>
        <p>< ?php echo $_SESSION['badgeNumber']; ?></p>
        <p>< ?php echo "culo";//$custRow['address']; ?></p>
    </div> -->
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../html/jquery/getNav.js"></script>
</body>
</html>
