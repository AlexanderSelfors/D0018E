<?php
    include_once 'header.php';
    
    if (isset($_GET["logout"])) {
        echo("You have logged out");
    }

    if (isset($_SESSION["uid"])){
        echo "logged in as user: "; echo $_SESSION["uid"];
      }
?>


</body>

    <div class='left-menu'>
    <a href="./Electronics.php" class="menu-item">Electronics</a>
    </div>

    <div class='left-menu'>
    <a href="./Furniture.php" class="menu-item">Furniture</a>
    </div>


</html>