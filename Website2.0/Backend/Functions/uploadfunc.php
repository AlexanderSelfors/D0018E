<?php

function emptyInputUpload($itemName, $price, $description, $pic) {
    if (empty($itemName) || empty($price) || empty($description) || empty($pic)) {
        return true;
    }
    else {
        return false;
    }
}

function createSaleItem($connection, $itemName, $price, $quantity, $pic){
    $uid = $_SESSION['uid'];
    $sql = "INSERT INTO products (product_userID, productName, productPrice, productStock, productUrl) VALUES ('$uid', '$itemName', '$price', '$quantity', '$pic');";
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