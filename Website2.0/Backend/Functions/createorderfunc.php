<?php      
    
    include "../dbconn.php";
    session_start();

    $userUID = $_SESSION["uid"];
   
    $sql = "select * from USERS where userUID = '$userUID'";  
    $result = mysqli_query($connection, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $count = mysqli_num_rows($result);
          
    if($count == 1){  
        echo " Found user "; echo $_SESSION["uid"];
        $sql = "INSERT INTO ORDERS (orderUID ) VALUES ('$userUID');";
        $result = mysqli_query($connection, $sql2);
        if($result2){
            echo "Order created for user"; echo $_SESSION["uid"];
        }
    }  
    else{
        echo"Could not find user";
    }

?>  




<html>
<body>


    <div class='left-menu'>
    <a href="../../Frontend/cart.php" class="menu-item">Cart</a>
    </div>

</body>



</html>