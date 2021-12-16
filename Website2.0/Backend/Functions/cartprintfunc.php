<?php
    include_once "../dbconn.php";  
    session_start();

     // Assign variables 
     $userUID = $_SESSION["uid"];

     // Fetch orderID for user
     $sql = "select orderID
     FROM orders
     WHERE order_UID = '$userUID' ";
     $result = mysqli_query($connection, $sql);
     $row = $result->fetch_array();
     $orderID = $row['orderID'];

     
     // Fetch detailName , detailPrice , detailStock , orderID from tables orders and orderdetails
     $fetchdetails = "select detailID, detail_productID, detailName, detailPrice , detailStock
     FROM orderdetails 
     WHERE detail_OrderID = '$orderID' ";
     $resultdetails = mysqli_query($connection, $fetchdetails);

    while( $arraydetails = $resultdetails->fetch_array() )
     {
         $imageID = $arraydetails['detail_productID'];
         $fetchImage = "SELECT productURL FROM products WHERE productID = '$imageID'";
         $imageResult = mysqli_query($connection, $fetchImage);
         $imageArr = mysqli_fetch_assoc($imageResult); 
         $image = $imageArr['productURL'];
         $name = $arraydetails['detailName'];
         $price = $arraydetails['detailPrice'];
         $stock = $arraydetails['detailStock'];
         echo "<div class=products>";
         echo "<table>";
         echo "<tr>";
         echo "<img src=$image>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>$name</td>";
         echo "<td>Price = $price</td>";
         echo "<td>Stock = $stock</td>";
         echo "</tr>";
         echo "</table>";
         echo "</div>";
     }


?>