<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TrashStudents</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='header'>
        <div class ='inner-header'>
            <div class="logo">
                <a href="index.php"><h1>Trash<span>Students</span></h1></a>
            </div>
            <div class="right-menu">
                <a href="uploadItem.php" class='upload-item'> <li>Upload item</li><a>
                <a href='cart.php' ><li><i class="fa fa-shopping-cart" id='cart'></li></i></a>
                <?php
                    if (isset($_SESSION{"uid"})) {
                        echo("<a href='profile.php'class='menu-item'><li>Profile</li></a>");
                        echo("<a href='../Backend/Functions/logoutfunc.php' class='menu-item'><li>Logout</li></a>");
                    }
                    else {
                        echo("<a href='register.php'class='menu-item'><li>Register</li></a>");
                        echo("<a href='login.php' class='menu-item'><li>Login</li></a>");
                    }
                ?>
            </div>
        </div>
    </div>