<?php
  include "header.php";
  
  if (isset($_SESSION["uid"])){
    echo "logged in as user: "; echo $_SESSION["uid"];
  }

  if(isset($_POST['printCartButton'])) {
    include_once "../Backend/Functions/cartprintfunc.php";
  }

?>

</body>

<form method="post"action= "../Backend/Functions/cartprintfunc.php" >
      <input type="submit" name="printCartButton" 
        value="print my items"/>
   </form>
  <div class="cart">
</div>


<form method="post" action= "../Backend/Functions/createorderfunc.php" >
      <input type="submit" name="createorderbutton"
        value="create order"/>
  <div class="cart">
</div>


</html>

