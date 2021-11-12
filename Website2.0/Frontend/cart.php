<?php
  include "header.php";
  
  if (isset($_SESSION["uid"])){
    echo "logged in as user: "; echo $_SESSION["uid"];
  }

  if(isset($_POST['button2'])) {
    echo "This is Button2 that is selected";
  }

?>

</body>


<form method="post" action= "../Backend/Functions/createorderfunc.php" >
      <input type="submit" name="createorderbutton"
        value="create order"/>
          
      <input type="submit" name="button2"
        value="Button2"/>
  </form>

  <div class="cart">
</div>


</html>

