<?php
include "../pdoutils.php";
// Create db object
$db = connect();

// Assign variables for session , used by script to alter tables
//$userUID = $_SESSION["uid"];
$sessionUserUID = '12';
$sessionProductID = '6';
$sessionAmount = '1';
$sessionOrderID;

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
    $tempStock = $productarray['productStock'] - $sessionAmount;
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



?>
