<?php
    session_start();
    require_once "../Backend/dbconn.php";
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
                <a href="reviews.php" class='menu-item'><li>Reviews</li></a>
                <div class='dropdown-div'>
                    <a href="#" class='menu-item-dropdown'><li>Categories</li></a>
                    <ul class='dropdown'>
                        <?php
                            $sql = "SELECT * FROM category;";
                            $result = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $categoryName = $row['catName'];
                                    echo("<li class='dropdown-element'><a href='index.php?category=$categoryName' class='dropdown-element-a'>$categoryName</a></li>");
                                }
                            }
                        ?>
                    </ul>
                </div>
                <?php
                    if (isset($_SESSION["uid"])) {
                        $userID = $_SESSION["uid"];
                        $userSql = "SELECT * FROM users WHERE userID = '$userID';";
                        $userResult = mysqli_query($connection, $userSql);
                        $userRow = mysqli_fetch_assoc($userResult); 

                        $username = $userRow['username'];
                        echo("<a href='uploadItem.php' class='upload-item'><li>Upload item</li><a>");
                        echo("<a href='profile.php'class='menu-item'><li>$username</li></a>");
                        echo("<a href='../Backend/Functions/logoutfunc.php' class='menu-item'><li>Logout</li></a>");
                    }
                    else {
                        echo("<a href='register.php'class='menu-item'><li>Register</li></a>");
                        echo("<a href='login.php' class='menu-item'><li>Login</li></a>");
                    }
                ?>
                <a href='cart.php'><li><i class="fa fa-shopping-cart" id='cart'></li></i></a>
            </div>
        </div>
    </div>