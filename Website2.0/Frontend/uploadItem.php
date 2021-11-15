<?php
    include_once 'header.php';
?>

<div>
<div class="box">
            <form class="upload-input" action= "../Backend/uploadfunc.php" method="post">>
                <input type="text" class="input-field" placeholder ="Item Name" name ="itemName">
                <input type="text" class="input-field" placeholder ="Price" name ="price">
                <input type="text" class="input-field" placeholder ="Description" name ="Description">
                <button type="submit" name="submit" class="submit-login">Upload</button>

            </form>
</div>