<?php
    include_once 'header.php';
    include "../Backend/dbconn.php";
    

    if (isset($_SESSION["uid"])){
        echo "logged in as user: "; echo $_SESSION["uid"];
      }

      if (isset($_SESSION["addChair"])){
        $_SESSION["currentproduct"] = "2";
      }

?>


</body>
    
    <form method="post" action= "../Backend/Functions/addproducts.php" >
    
      <input type="submit" name="addChair" value="Add chair to cart"/>
    
    </form>

    <div class="cart"> </div>  




</html>

