<?php
    function db_connect(){
        $connection = mysqli_connect('utbweb.its.ltu.se', '19931112', '19931112', 'db19931112');
        if(mysqli_connect_errno()){
            echo "Connection to database failed";
        }else{
        }
        return $connection;   
    }

    db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css%22%3E">
    <title>ThrashStudents</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='Menu'>
        <div class='right-menu'>
            <a href="index.html" class="menu-item">Home</a>
        </div>
        <div class="left-menu">
            <a href='#' class="menu-item">Login</a>
            <a href='#'class="menu-item">Register</a>
            <a href='#' ><i class="fa fa-shopping-cart" id='cart'></i></a>
        </div>
    </div>
</body>
</html>