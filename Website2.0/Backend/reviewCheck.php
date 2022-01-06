<?php
require_once "../Backend/dbconn.php";

if(isset($_POST["reviewSubmit"])){
    if(isset($_POST["rating"]) && isset($_POST["review"])){
        $rating = $_POST["rating"];
        $review = $_POST["review"];
        $product = $_GET["product"];
        $sql = "INSERT INTO review (review_productID, reviewGrade, reviewComment) VALUES ('$product', '$rating', '$review')";
        $result = $connection->query($sql);
        
        header("location: ../Frontend/productReview.php?product=$product");
    }
}