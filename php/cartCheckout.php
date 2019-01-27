<?php
include('../script/dbConnect.php');
// initializ shopping cart class
include 'Cart.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//secure_session_start();

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
    <title>Conferma carrello</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Roboto" rel="stylesheet">
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%; padding: auto;}
    .orderBtn {float: right;}
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
    .example_c {
color: #494949 !important;
text-transform: uppercase;
background: #ffffff;
padding: 20px;
border: 4px solid #494949 !important;
border-radius: 6px;
display: inline-block;
}

.example_c:hover {
color: #ffffff !important;
background: #f6b93b;
border-color: #f6b93b !important;
transition: all 0.4s ease 0s;
}

.btn-danger {
color: #fff !important;
text-transform: uppercase;
background: #ed3330;
padding: 20px;
border-radius: 5px;
display: inline-block;
border: none;
}

.btn-danger:hover {
background: #434343;
letter-spacing: 1px;
-webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
-moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
transition: all 0.4s ease 0s;
}
    </style>
    <link rel="stylesheet" href="../css/navbar.css">
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
            <td> Presso:<br><?php echo $_POST['location']?></td>
            <td> Alle:<br><?php echo $_POST['time']?></td>
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
        <!-- <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Prosegui <i class="glyphicon glyphicon-menu-right"></i></a> -->
        <div class="button_cont" align="center"><a class="example_c" href="cartAction.php?action=placeOrder" rel="nofollow noopener">Prosegui</a></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../html/jquery/getNav.js"></script>
</body>
</html>
