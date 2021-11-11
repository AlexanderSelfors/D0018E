<?php      
    
    include "../dbconn.php";
    session_start();

    $userUID = $_POST['uid'];  
    $pwd = $_POST['pwd'];
   
    $sql = "select * from USERS where userUID = '$userUID' and PWD = '$pwd'";  
    $result = mysqli_query($connection, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $count = mysqli_num_rows($result);
          
    if($count == 1){  
        echo "<h1><center> Found user </center></h1>";
        $_SESSION["uid"] = $_POST['uid'];
        
           // Set session variables
        echo "Session variables uid = "; echo $_SESSION["uid"];
        echo "Session variables pwd = "; echo $_SESSION["pwd"];
    }  
    else{
        echo"Invalid credentials";
    }

?>  




<html>
<body>


    <div class='left-menu'>
    <a href="../../Frontend/cart.php" class="menu-item">Cart</a>
    </div>

</body>



</html>