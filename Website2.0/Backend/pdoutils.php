<?php

/* Connect to a MySQL database using driver invocation */
function connect(){
    $dbh = null;
    $dsn = 'mysql:dbname=db19980626;host=utbweb.its.ltu.se';
    $user = '19980626';
    $password = '19980626';
    // Autocommit false enables queries? Turn off to enable rollback.
    $options = array(PDO::ATTR_AUTOCOMMIT=>FALSE);
    
    $dbh = new PDO($dsn, $user, $password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


function returnArray($stmt , $db){
    $sth = $db->prepare($stmt);
    $sth->execute();
    $tempqueryarray = $sth->fetch(PDO::FETCH_BOTH);
    return $tempqueryarray;
}


function addtocart(){
    // Create db object
    $db = connect();

    // Assign variables for session , used by script to alter tables
    $sessionUserUID = $_SESSION["uid"];
    $sessionProductID =$_SESSION["pdoprodid"];
    $sessionAmount = $_SESSION['quantity'];

    // Fetch Name , Price , Stock for chosen product.
    $productarray = returnArray($stmt ="SELECT productName , productPrice , productStock FROM products WHERE productID = '$sessionProductID'" , $db);

    try {
        $db->beginTransaction();
        $sth = $db->prepare($stmt =  "LOCK TABLES products WRITE , cart WRITE");
        $sth->execute();
    
    /* Write subtraction to products table */
        if ($productarray['productStock'] - $sessionAmount > 0)
        {
            $tempStock = $productarray['productStock'] - $sessionAmount;
        }
        else {
            $tempStock = 0;
            $sessionAmount = $productarray['productStock'];
        }
        $sth = $db->prepare($stmt = ("UPDATE `products` SET `productStock` = '$tempStock' WHERE `products`.`productID` = '$sessionProductID'"));
        $sth->execute();

    /* Insert subtracted item from products table to cart */
        $tempcartName = $productarray['productName'];
        $tempcartPrice = $productarray['productPrice'];
        $tempcartStock = $productarray['productStock'];
        if ($detailarray = returnArray("SELECT cart_transactionID, productStock FROM cart WHERE cart_userID = '$sessionUserUID' AND cart_productID = '$sessionProductID'", $db)) {
            $stock = $detailarray['productStock'] + $sessionAmount;
            $cartId = $detailarray['cart_transactionID'];
            $sth = $db->prepare($stmt = ("UPDATE cart SET productStock = '$stock' WHERE cart_transactionID = '$cartId'"));
        }
        else {
            $sth = $db->prepare($stmt = ("INSERT INTO `cart`(`cart_userID`, `cart_productID`, `productName`, `productPrice`, `productStock`) VALUES ('$sessionUserUID','$sessionProductID','$tempcartName','$tempcartPrice','$sessionAmount')"));
        }
        $sth->execute();

        // Release lock , commit changes , terminate connection
        $sth = $db->prepare($stmt = "UNLOCK TABLES");
        $sth->execute();
        $db->commit();
        $db = null;

    } catch (PDOException $e) {
        $sth = $db->prepare($stmt = "UNLOCK TABLES");
        $sth->execute();
        print "Error!: " . $e->getMessage() . "<br/>";
        $db->rollBack();
        die();
    }
    header("Location: index.php?addedItem");
    }


function checkout(){
    // Create db object
    $db = connect();
    
    // Assign variables for session , used by script to alter tables
    $sessionUserUID = $_SESSION["uid"];

    
    try{
        $db->beginTransaction();
        $sth = $db->prepare($stmt =  "LOCK TABLES cart WRITE , orderdetails WRITE , orders WRITE");
        $sth->execute();
        
        // 1. Fetch array , each row in cart that belongs to sessionuserid

        $cartarray = returnArray($stmt ="SELECT * FROM cart WHERE cart_userID = '$sessionProductID'" , $db);
        
        // 2. Insert new order into order table , use sessionuserid


        $sth = $db->prepare($stmt =  "INSERT INTO `orders`(`order_UID`) VALUES ('$sessionUserUID')");
        $sth->execute();
        sleep(0.2);
        $tempnewOrderID = returnArray($stmt=("SELECT MAX(orderID) FROM orderdetails"),$db)['orderID'];

        // 4. for each row in 1. , insert into orderdetails 

        foreach ($cartarray as $row ){
            $tempCartProdId = $cartarray['cart_productID'];
            $tempCartName = $cartarray['productName'];
            $tempCartPrice = $cartarray['productPrice'];
            $tempCartStock = $cartarray['productStock'];
            $sth = $db->prepare($stmt = "INSERT INTO `orderdetails`(`detail_orderID`, `detail_productID`, `detailName`, `detailPrice`, `detailStock`) VALUES ('$tempnewOrderID','$tempCartProdId','$tempCartName','$tempCartPrice','$tempCartPrice')");
            $sth->execute();
        }

        // 5. remove from cart.
        $sth = $db->prepare($stmt = " DELETE  FROM `cart` WHERE cart_userID = '$sessionUserUID' ");
        $sth->execute();

        // Release lock , commit changes , terminate connection
        $sth = $db->prepare($stmt = "UNLOCK TABLES");
        $sth->execute();
        $db->commit();
        $db = null;

    } catch (PDOException $e) {
        $sth = $db->prepare($stmt = "UNLOCK TABLES");
        $sth->execute();
        print "Error!: " . $e->getMessage() . "<br/>";
        $db->rollBack();
        die();
    }
    header("Location: index.php?addedItem");

}

    



?>
