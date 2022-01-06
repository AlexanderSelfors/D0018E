<?php
    include_once 'header.php';
    require_once "../Backend/dbconn.php";

    $sql = "SELECT productID, productName FROM products";
    $result = mysqli_query($connection, $sql);

    while($name = $result->fetch_array()){
        echo("<a href='productReview.php?product=$name[0]'>$name[1]</a>");
    }
?>


