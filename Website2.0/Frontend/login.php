<?php
    include_once 'header.php';
    session_start();
    if (isset($_SESSION["uid"])){
        echo "logged in as user: "; echo $_SESSION["uid"];
    }
    else{
        echo "Not logged in";
    }

?>

    <div class="box">
        <form class="login-input" action= "../Backend/Functions/loginfunc.php" method="post">>
            <input type="text" class="input-field" placeholder ="Username" name ="uid">
            <input type="password" class="input-field" placeholder ="Password" name ="pwd">
            <input type="checkbox" class="checkbox"><span>Keep me logged in</span>>
            <button type="submit" class="submit-login">Log in</button>

        </form>
    </div>
</body>
</html>