<?php
    include_once 'header.php'
?>

    <div class="box">
        <form action="../Backend/signup.php" method="post" class="register-input">
            <input type="text" name="email" class="input-field" placeholder ="Email">
            <input type="text" name="username" class="input-field" placeholder ="Username">
            <input type="password" name="password" class="input-field" placeholder ="Password">
            <input type="password" name="passwordrepeat" class="input-field" placeholder ="Repeat password">
            <button type="submit" name="submit" class="submit-register">Register</button>
        </form>
    </div>
</body>
</html>