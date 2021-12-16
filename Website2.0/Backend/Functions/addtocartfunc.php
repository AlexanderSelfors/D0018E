<?php
require_once "../Backend/dbconn.php";

if (isset($_POST["addProduct"])) {
    $prodID = $_POST["addProduct"];
    $sqlProd = "SELECT * FROM products WHERE productID = $prodID;";
    $resultProd = mysqli_query($connection, $sqlProd);
    $ProdDetails = mysqli_fetch_row($resultProd);

    $uid = $_SESSION['uid'];
    $sqlOrder = "SELECT * FROM orders WHERE order_UID = $uid;";
    $resultOrder = mysqli_query($connection, $sqlOrder);
    $OrderDetails = mysqli_fetch_row($resultOrder);

    $detail_orderID = $OrderDetails['orderID'];
    $detail_productID = $prodID;
    $detailName = $ProdDetails[3];
    $detailPrice = $ProdDetails[4];

    $addSql = "INSERT INTO orderdetails (detail_orderID, detail_productID, detailName,
    detailPrice) VALUES ('$detail_orderID', '$detail_productID', '$detailName', '$detailPrice')";
    $result = mysqli_query($connection, $addSql);  
    
}
