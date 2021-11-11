<?php
  include "header.php";
  session_start(); 
  
  if (isset($_SESSION["uid"])){
    echo "logged in as user: "; echo $_SESSION["uid"];
  }

  if(isset($_POST['button1'])) {
    echo "This is Button1 that is selected";
  }
  if(isset($_POST['button2'])) {
    echo "This is Button2 that is selected";
  }

?>

</body>

<form action= "../Backend/cartfunc.php" method="post">
  uid: <input type="text" name="uid"><br>
  pwd: <input type="text" name="pwd"><br>
  <input type="submit">
</form>

<form method="post">
      <input type="submit" name="button1"
        value="Button1"/>
          
      <input type="submit" name="button2"
        value="Button2"/>
  </form>

  <div class="cart">
</div>


</html>

