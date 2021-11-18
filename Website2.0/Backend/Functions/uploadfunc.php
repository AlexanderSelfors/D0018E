<?php

function emptyInputUpload($itemName, $price, $description, $pic) {
    if (empty($itemName) || empty($price) || empty($description) || empty($pic)) {
        return true;
    }
    else {
        return false;
    }
}

function createSaleItem($itemName, $price, $quantity, $pic){
    $sql = "INSERT INTO products (productID, productCatID, productUID, productName, productPrice, productStock, productUrl) VALUES ('', '', $_SESSION{'uid'}, $itemName, $price, $quantity, $pic)";

    if ($connection->query($sql) === TRUE)
    {
        header("location: ../Frontend/index.php");    
    }
    else {
        header("location: ../Frontend/uploadItem.php?error=sqlfailed");    

    }
}