<?php
session_start();

if (isset($_SESSION["uid"])) {

    if(isset($_POST["submit"])){
        include_once __DIR__ . "/Functions/uploadfunc.php";
        require_once 'dbconn.php'; 
    
        $itemName = $_POST["itemName"];
        $price = $_POST['price'];
        $quantity = $_POST['Quan'];
        $cat = $_POST['cat'];
        $pic = $_POST['pic'];
        
        $sql = "SELECT * FROM category WHERE catName = '$cat';";
        $result = mysqli_query($connection, $sql);
        $category = mysqli_fetch_row($result);
        $catID = $category[0];
        echo $catID;

        if(emptyInputUpload($itemName, $price, $quantity, $catID, $pic)){
           // header("location: ../Frontend/index.php?error=inputmissing");
           // exit();
        }else{
            createSaleItem($connection, $itemName, $price, $quantity, $catID, $pic);
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
