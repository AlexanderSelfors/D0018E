<?php
include_once __DIR__ . "/Functions/uploadfunc.php";

if (!isset($_SESSION{"uid"})) {
    header("location: ../Frontend/index.php");  
}

if(isset($_POST["submit"])){

    $itemName = $_POST["itemName"];
    $price = $_POST['itemName'];
    $quantity = $_POST['Quan']
    $pic = $_POST['pic'];

    if(emptyInputUpload($itemName, $price, $quantity, $pic)){
        header("location: ../Frontend/uploadItem.php");   
    }else{
        createSaleItem($itemName, $price, $quantity, $pic);
        exit();
    }
}