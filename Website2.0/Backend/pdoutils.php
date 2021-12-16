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
    $sessionProductID = $_SESSION["pdoprodid"];
    $sessionAmount = $_SESSION['quantity'];


    // Fetch which orderID belongs to session userID
    $orderarray = returnArray($stmt = "SELECT orderID FROM orders WHERE order_UID = '$sessionUserUID'" , $db);
    $sessionOrderID = $orderarray['orderID'];

    // Fetch Name , Price , Stock for chosen product.
    $productarray = returnArray($stmt ="SELECT productName , productPrice , productStock FROM products WHERE productID = '$sessionProductID'" , $db);

    try {
        $db->beginTransaction();
        $sth = $db->prepare($stmt =  "LOCK TABLES products WRITE , orderdetails WRITE");
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
    /* Errorcheck that subtraction has gone through */
        sleep(1);
        if (returnArray($stmt ="SELECT productName , productPrice , productStock FROM products WHERE productID = '$sessionProductID'" , $db)['productStock'] != $tempStock){
            $db->rollBack();
        }

    /* Insert subtracted item from products table to orderdetails */
        $tempDetailName = $productarray['productName'];
        $tempDetailPrice = $productarray['productPrice'];
        $tempDetailStock = $productarray['productStock'];
        $tempDetailIdBefore = returnArray(("SELECT MAX(detailID) FROM orderdetails"),$db);
        $sth = $db->prepare($stmt = ("INSERT INTO orderdetails (detail_orderID, detail_productID, detailName,
        detailPrice, detailStock) VALUES ('$sessionOrderID', '$sessionProductID', '$tempDetailName', '$tempDetailPrice' ,'$sessionAmount')"));
        $sth->execute();
    
    /* Errorcheck that order insert went through */
        sleep(1);
        $tempDetailIdAfter = returnArray(("SELECT MAX(detailID) FROM orderdetails"),$db);
        if($tempDetailIdBefore['MAX(detailID)'] == $tempDetailIdAfter['MAX(detailID)']){
            $db->rollBack();
        }
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
    header("Refresh:0; url=http://localhost:3000/Frontend/index.php");
}

?>
