<?php      
    
    include "../dbconn.php";
    session_start();

    $userUID = $_SESSION["uid"];
    // Quick check if user exists
    $sql = "select * FROM users WHERE username = '$userUID'";  
    $result = mysqli_query($connection, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $count = mysqli_num_rows($result);

    if($count == 1){  
        echo " Found user "; echo $_SESSION["uid"];
        $sql2 = "INSERT INTO `orders`(`orderUID`) VALUES ('$userUID')";
        if(mysqli_query($connection, $sql2)){
            echo "Order created for user"; echo $_SESSION["uid"];
        }
    }  
    else{
        echo"Could not find user in db";
    }

?>  




<html>
<body>


    <div class='left-menu'>
    <a href="../../Frontend/cart.php" class="menu-item">Cart</a>
    </div>

</body>



</html>