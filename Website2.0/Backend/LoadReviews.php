<?php

require_once "../Backend/dbconn.php";

$product = $_GET["product"];

$sql = "SELECT * FROM review WHERE review_productID = $product";
$result = mysqli_query($connection, $sql);

while($review = $result->fetch_array()){
    echo("<p>$review[2]</p>");
    echo("<p>$review[3]</p>");
}