<?php
session_start();

if (isset($_SESSION["uid"])) {

    if(isset($_POST["submit"])){
        include_once __DIR__ . "/Functions/uploadfunc.php";
        require_once 'dbconn.php'; 
    
        $itemName = $_POST["itemName"];
        $price = $_POST['price'];
        $quantity = $_POST['Quan'];
        $quantity = $_POST['Quan'];
        $pic = $_POST['pic'];
    
        if(emptyInputUpload($itemName, $price, $quantity, $pic)){
            header("location: ../Frontend/index.php?error=inputmissing");
            exit();
        }else{
            createSaleItem($connection, $itemName, $price, $quantity, $pic);
            exit();
        }
    }
    else  {
        header("location: ../Frontend/uploadItem.php?error");
        exit();
    }
}
else {
    header("location: ../Frontend/login.php?error=pleaselogin");
}
