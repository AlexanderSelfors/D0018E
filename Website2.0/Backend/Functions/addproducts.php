<?php
     include_once "../dbconn.php";  
     session_start();

     // Assign variables 
     $userUID = $_SESSION["uid"];
     $currentProductId = $_SESSION["currentproduct"];
     
     // Fetch productname , productprice and orderID using INNER JOIN on tables products and orders
     $sql = "select products.productName, products.productPrice , orders.orderID
     FROM products 
     INNER JOIN orders ON orders.orderUID = '$userUID' AND products.productID = '$currentProductId' ";
     $result = mysqli_query($connection, $sql);
     $row = $result->fetch_array();
     $productName = $row['productName'];
     $productPrice = $row['productPrice'];
     $orderID = $row['orderID'];

     // Insert into orderdetails. Binding chosen product to orderID
     $sql3 = " INSERT INTO `orderdetails`( `detailOrderID`, `detailProductID`, `detailName`, `detailPrice`, `detailStock`) VALUES ('$orderID','$currentProductId','$productName','$productPrice','1') ";
     mysqli_query($connection, $sql3);

     // Printout results from fetch
     /*while( $row = $result->fetch_array() )
     {
     echo $row['productName'] . " " . $row['productPrice'] . " " . $row['orderID'];
     echo "<br />";
     }*/


?>  