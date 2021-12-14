<?php
    include_once 'header.php';

?>

<div class="box">
        <form class="upload-input" action= "../Backend/uploadcheck.php" method="post">>
            <input type="text" class="input-field" placeholder ="Item Name" name ="itemName">
            <input type="number" class="input-field" placeholder ="Price" name ="price" min=0>
            <input type="number" class="input-field" placeholder ="Quantity" name ="Quan" min=0>
            <input type="text" class="input-field" placeholder ="URL to picture" name ="pic">
            <button type="submit" name="submit" class="submit-login">Upload</button>
        </form>
</div>