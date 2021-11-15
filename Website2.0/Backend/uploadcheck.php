<?php
include_once "uploadfunc.php";

if(isset($_POST["submit"])){

    $itemName = $_POST["itemName"];
    $price = $_POST['itemName'];
    $description = $_POST['Description'];

    if(emptyInputUpload($itemName, $price, $description)){

    }

    
}