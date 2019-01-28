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
if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id']) && !empty($_REQUEST['p_iva']) /*&& !empty($_REQUEST['location']) && !empty($_REQUEST['time'])*/ ){
        $productID = $_REQUEST['id'];
        $resturantPIVA = $_REQUEST['p_iva'];
        $query = $db->query("SELECT * FROM portata WHERE id = " . $productID . " AND ristP_IVA = " .$resturantPIVA); /** aggiungere anche l'id del ristorante */
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['id'],
            'name' => $row['nome'],
            'price' => $row['prezzo'],
            'qty' => 1,
            'p_iva' => $resturantPIVA
        );

        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'viewCart.php':'#'; //Quando un elemento viene correttamente inserito nel carrello si viene reinderizzati alla pagina del carrello
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
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['badgeNumber']) && !empty($_REQUEST['deliveryTime']) && !empty($_REQUEST['location'])){
        $insertOrder = $db->query("INSERT INTO ordine (matricola, costoConsegna, importoTotale, orarioConsegna, idluogoconsegna) VALUES ('".$_SESSION['badgeNumber']."', 0.50, '".$cart->total()."', '".$_REQUEST['deliveryTime']."', '".$_REQUEST['location']."')");
        if($insertOrder){
            $orderID = $db->insert_id; //insert_id = ritorna l'id autogenerato dell'utlima query
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO dettaglioordine (idOrdine, idPortata, quantita) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);

            if($insertOrderItems){
                $cart->destroy();
                header("Location: ../html/orderSuccess.html");
            }else{
                header("Location: ../html/homepage.html");
            }
        }else{
            header("Location: ../html/homepage.html");
        }
    }else{
        header("Location: ../html/homepage.html");
    }
}else{
    header("Location: ../html/homepage.html");
}
