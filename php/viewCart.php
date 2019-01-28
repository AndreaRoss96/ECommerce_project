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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">

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

    @media only screen and (max-width: 600px) {
      .container * {
        font-size: 70%;
      }
      .form-control { /*Comando relativo alla quantità*/
        font-size: 10px;
      }
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

            $selectedrestaurant = array();

            foreach($cartItems as $item){
        ?>
        <tr>
            <td class="product-name"><?php echo $item["name"]; ?></td>
            <td><?php echo $item["price"].' €'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo $item["subtotal"].' €'; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro di volerlo cancellare?')"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        <?php
              array_push($selectedrestaurant, $item["p_iva"]);
            }
      }else{ ?>
        <tr><td colspan="5"><p>Non hai ancora selezionato niente!</p></td></tr>
<?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td><a onclick="history.back()" class="btn btn-warning"><i class="fas fa-chevron-left"></i> Prendi qualcos'altro</a></td>
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
                <?php
                $query = 'SELECT * FROM luogoconsegna';
                $result = $conn->query($query);
                while($row = $result->fetch_assoc()) {
                ?>
                  <option value="<?php echo $row["id"];?>"><?php echo $row["luogo"];?></option>
                <?php
                }
                ?>
              </select>
              <select name="time" id="time" class="custom-select sources">
              <?php
              /*
              Vengono selezionati l'orario di apertura più in ritardo di ogni ristorante
              e l'orario di chiusura più basso tra i ristoranti selezionati
              */
                $maxApertura = "00:00";
                $minChiusura = "23:59";
                foreach ($selectedrestaurant as $rest_p_iva) {
                  $query = 'SELECT orarioApertura, orarioChiusura FROM fornitori WHERE P_IVA=' . $rest_p_iva;
                  $result = $conn->query($query);
                  $row = $result->fetch_assoc();
                  $tmpApertura = $row["orarioApertura"];
                  $tmpChiusura = $row["orarioChiusura"];
                  if($tmpApertura > $maxApertura) {
                    $maxApertura = $tmpApertura;
                  }
                  if($tmpChiusura < $minChiusura) {
                    $minChiusura = $tmpChiusura;
                  }
                }
                $orarioTmp = $maxApertura;
                while ($orarioTmp != $minChiusura) {
                  $toPrint = "<option value='" . $orarioTmp;
                  $text = "'>" . $orarioTmp . " - ";
                  $minutesTmp = (int) $orarioTmp[3] + 1; //aumento il valore dei minuti es. 12:10 -> 12:20
                  $hourTmp = (int) substr($orarioTmp, 0, 2);
                  if ($minutesTmp == 6) {
                    $minutesTmp = 0;
                    $hourTmp = $hourTmp + 1;
                  }
                  $orarioTmp[3] = $minutesTmp;
                  if($hourTmp < 10) {
                    $orarioTmp[1] = $hourTmp;
                    $orarioTmp[0] = "0";
                  } else {
                    $orarioTmp[0] = substr($hourTmp, 0, 1);
                    $orarioTmp[1] = substr($hourTmp, 1, 1);
                  }
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

          <?php } ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="../html/jquery/getNav.js"></script>
</body>
</html>
