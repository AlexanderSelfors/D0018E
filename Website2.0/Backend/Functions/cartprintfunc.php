<?php
    include_once "../dbconn.php";  
    session_start();

     // Assign variables 
     $userUID = $_SESSION["uid"];

     // Fetch orderID for user
     $sql = "select orderID
     FROM orders
     WHERE orderUID = '$userUID' ";
     $result = mysqli_query($connection, $sql);
     $row = $result->fetch_array();
     $orderID = $row['orderID'];

     
     // Fetch detailName , detailPrice , detailStock , orderID from tables orders and orderdetails
     $fetchdetails = "select detailID , detailName, detailPrice , detailStock
     FROM orderdetails 
     WHERE detailOrderID = '$orderID' ";
     $resultdetails = mysqli_query($connection, $fetchdetails);
     $arraydetails = $resultdetails->fetch_array();

    while( $arraydetails = $resultdetails->fetch_array() )
     {   
     echo $arraydetails['detailID'];
     echo $arraydetails['detailName'] . " " . $arraydetails['detailPrice'] . " " . $arraydetails['detailStock'];
     echo "<br />";
     }


?>