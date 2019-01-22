<?php
include('../script/dbConnect.php');
include('../script/functions.php');
include ('Cart.php');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cart = new Cart;

if(login_check($conn)){
  header("Location: ../html/userSupplierLogin.html"); //Se il cliente non è connesso redirige alla pagina di login
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Carrello</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
    <script>
    function updateCartItem(obj,id){
      $.get("cartAction.php", {
        action:"updateCartItem", id:id, qty:obj.value
      }, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
      });
    }
</script>
</head>
<body>
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
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["price"].' €'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo $item["subtotal"].' €'; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro di volerlo cancellare?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Non hai ancora selezionato niente!</p></td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
          <td><a href="resturant.php?p_iva=<?php echo $_GET["p_iva"]?>" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Prendi qualcos'altro</a></td>
          <td colspan="2"></td>
          <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Totale <br> <?php echo $cart->total().' €'; ?></strong></td>
            <td><a href="checkout.php" class="btn btn-success btn-block">Ordina!<i class="glyphicon glyphicon-menu-right"></i></a></td>
          <?php } ?>
        </tr>
    </tfoot>
    </table>
    <!-- <div class="shipAddr">
        <h4>Dettagli di spedizione</h4>
        <p>< ? php echo ($_SESSION['name'] . $_SESSION['surname']); ?></p>
        <p>< ?php echo ($_SESSION['email']); ?></p>
        <p>< ?php echo $_SESSION['badgeNumber']; ?></p>
        <p>< ?php echo "culo";//$custRow['address']; ?></p>
    </div> -->
    <?php echo "PROVA\n" . $_POST["time"]?>
</div>
</body>
</html>
