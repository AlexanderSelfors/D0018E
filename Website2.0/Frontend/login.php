<?php
    include_once 'header.php'
?>
        
        <div class="box">
            <form class="login-input" action= "../Backend/logincheck.php" method="post">>
                <input type="text" class="input-field" placeholder ="Username" name ="uid">
                <input type="password" class="input-field" placeholder ="Password" name ="pwd">
                <input type="checkbox" class="checkbox"><span>Keep me logged in</span>>
                <button type="submit" name="submit" class="submit-login">Log in</button>

            </form>
            <?php
            if (isset($_GET["wrongcredentials"])) {
                echo("<p>Incorrect login</p>");
            }

            else if (isset($_GET["accountcreated"])) {
                echo("<p>Account created!</p>");
            }
            ?>
        </div>
    </body>
</html>