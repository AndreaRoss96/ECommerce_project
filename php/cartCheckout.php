<?php
include('../script/dbConnect.php');
// initializ shopping cart class
include 'Cart.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: ../html/index.html");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 1;

$query = 'SELECT * FROM luogoconsegna WHERE id = ' . $_POST['location'];
$result = $conn->query($query);
$row = $result->fetch_assoc();
$location = $row["luogo"];
$idLocation = $row["id"];
$time = $_POST['time'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Conferma carrello</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/cartCheckout.css">
</head>
<body>
<div id="nav"></div>
<div class="container">
    <h1>Ecco cosa stai ordinando</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Prodotto</th>
            <th>Prezzo</th>
            <th>Quantità</th>
            <th>Totale prodotto</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["price"].' €'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo $item["subtotal"].' €'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>Il carrello è vuoto :()</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td> Presso:<br><?php echo $location?></td>
            <td> Alle:<br><?php echo $time?></td>
            <?php if($cart->total_items() > 0){ ?>
              <td class="text-center"><strong>Totale <?php echo $cart->total().' €'; ?></strong> <br> <p class:"spedizione">+ costo spedizione (0,50€)</p></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Dettagli cliente</h4>
        <p><?php echo $_SESSION['name'] . " " . $_SESSION['surname']; ?></p>
        <p><?php echo $_SESSION['email']; ?></p>
        <p><?php echo $_SESSION['badgeNumber']; ?></p>
    </div>
    <div class="footBtn">
        <button type="button" class="btn btn-danger" onclick="history.back()">Annulla</button>
        <a class="link-action" href="cartAction.php?action=placeOrder&deliveryTime=<?php echo $time; ?>&location=<?php echo $idLocation; ?>" rel="nofollow noopener"><button type="button" class="button_cont btn btn-success" align="center">Prosegui</button></a>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../html/jquery/getNav.js"></script>
</body>
</html>
