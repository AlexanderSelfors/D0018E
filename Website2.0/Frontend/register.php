<?php
    include_once 'header.php'
?>

    <div class="box">
        <form action="../Backend/signupcheck.php" method="post" class="register-input">
        <input type="text" name="username" class="input-field" placeholder ="Username">
            <input type="password" name="password" class="input-field" placeholder ="Password">
            <input type="password" name="passwordrepeat" class="input-field" placeholder ="Repeat password">
            <input type="text" name="email" class="input-field" placeholder ="Email">
            <input type="text" name="fname" class="input-field" placeholder ="First Name">
            <input type="text" name="lname" class="input-field" placeholder ="Last Name">
            <input type="text" name="address" class="input-field" placeholder ="Address">
            <input type="text" name="pnumber" class="input-field" placeholder ="Phone number">
            <button type="submit" name="submit" class="submit-register">Register</button>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "missinginput") {
                echo("<p>Missing necessary fields</p>");
            }
            else if ($_GET["error"] == "invalidemail") {
                echo("<p>Invalid email</p>");
            }
            else if ($_GET["error"] == "passwordnotmatch") {
                echo("<p>Passwords did not match</p>");
            }
            else if ($_GET["error"] == "usernametaken") {
                echo("<p>Username already exists</p>");
            }
            else if ($_GET["error"] == "sqlfailed") {
                echo("<p>Something went wrong</p>");
            }
        }
        ?>
    </div>

</body>
</html>