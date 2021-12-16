<?php

function emptyInputUpload($itemName, $price, $quantity, $cat, $pic) {
    if (empty($itemName) || empty($price) || empty($quantity)|| empty($cat) || empty($pic)) {
        return true;
    }
    else {
        return false;
    }
}

function createSaleItem($connection, $itemName, $price, $quantity, $cat, $pic){
    $uid = $_SESSION['uid'];
    $sql = "INSERT INTO products (product_catID, product_userID, productName, productPrice, productStock, productUrl) VALUES ('$cat', '$uid', '$itemName', '$price', '$quantity', '$pic');";
    $result = mysqli_query($connection, $sql);  
    if ($result === true)
    {
        header("location: ../Frontend/index.php");
        exit(); 
    }
    else {
        header("location: ../Frontend/uploadItem.php?error=sqlfailed");
        exit();
    }
}