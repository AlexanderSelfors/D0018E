<?php
    include_once 'header.php';

?>

<div class="box">
        <form class="upload-input" action= "../Backend/uploadcheck.php" method="post">>
            <input type="text" class="input-field" placeholder ="Item Name" name ="itemName">
            <div class = "dropdown">
                <input type="text" class="input-field" placeholder ="Category" name="category">
                <div class="dropdown-content">
                    <option value="text1">text1</option>
                    <option value="text2">text2</option>
                    <option value="text3">text3</option>
                    <option value="text4">text4</option>
                </div>
            <input type="number" class="input-field" placeholder ="Price" name ="price" min=0>
            <input type="number" class="input-field" placeholder ="Quantity" name ="Quan" min=0>
            <input type="text" class="input-field" placeholder ="URL to picture" name ="pic">
            <button type="submit" name="submit" class="submit-login">Upload</button>
        </form>
</div>