<?php
/*
Il seguente file gestisce tutte le azioni richieste dall'interfaccia grafica dell'utente
*/
// include database configuration file
include 'dbConfig.php';
// inizializzazione della calsse "Carrello"
include 'Cart.php';
$cart = new Cart;

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id']) && !empty($_REQUEST['p_iva'])){
        $productID = $_REQUEST['id'];
        $resturantPIVA = $_REQUEST['p_iva'];
        // get product details
        $query = $db->query("SELECT * FROM portata WHERE id = " . $productID . " AND ristP_IVA = " .$resturantPIVA); /** aggiungere anche l'id del ristorante */
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['idPortata'],
            'name' => $row['nome'],
            'price' => $row['prezzo'],
            'qty' => 1
        );

        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'viewCart.php':'index.php'; //questo ti reinderizza al carrello, anche se index.php non esiste
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
                          //la query sarà "INSERT INTO ordine (matricola, costoConsegna, importoTotale) VALUES ('".$_SESSION['sessCustomerID'].", '"1"', '".$cart->total()"')"
        if($insertOrder){
            $orderID = $db->insert_id; //insert_id = ritorna l'id autogenerato dell'utlima query
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO dettaglioordine (idOrdine, idPortata, quantita) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }           //INSERT INTO dettaglioordine (idOrdine, idPortata, quantita) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);

            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
