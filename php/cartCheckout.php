<?php
include('../script/dbConnect.php');
include('../script/functions.php');

// initializ shopping cart class
include 'Cart.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
secure_session_start();

$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: ../html/homepage.html");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 1;

// get customer details by session customer ID
// $query = $db->query("SELECT * FROM clienti WHERE id = ".$_SESSION['sessCustomerID']);
// $custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
</head>
<body>
<div class="container">
    <h1>Order Preview</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
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
            <td><?php echo '$'.$item["price"].' USD'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>Il carrello è vuoto :()</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo $cart->total().' €'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Shipping Details</h4>
        <p><?php echo $_SESSION['name'] . " " . $_SESSION['surname']; ?></p>
        <p><?php echo $_SESSION['email']; ?></p>
        <p><?php echo $_SESSION['badgeNumber']; ?></p>
    </div>
    <div class="footBtn">
      <form>
        <button type="button" class="btn btn-danger" onclick="history.back()">Annulla</button>
      </form>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>
</body>
</html>
