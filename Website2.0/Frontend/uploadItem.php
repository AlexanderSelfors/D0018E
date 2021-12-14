<?php
    include_once 'header.php';
    include_once '../Backend/dbconn.php'
?>

<div class="box">
        <form class="upload-input" action= "../Backend/uploadcheck.php" method="post">>
            <input type="text" class="input-field" placeholder ="Item Name" name ="itemName">
            <input type="number" class="input-field" placeholder ="Price" name ="price" min=0>
            <input type="number" class="input-field" placeholder ="Quantity" name ="Quan" min=0>
            <input type="text" class="input-field" placeholder ="URL to picture" name ="pic">
            <label for='cat'>Choose a category</label>
            <select name="cat" id="cat">
            <?php
                $sql = "SELECT * FROM category";
                $result = mysqli_query($connection, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $catName = $row['catName'];
                    echo"<option value='$catName'>$catName</option>";
                }
            ?>
            </select>
            <button type="submit" name="submit" class="submit-login">Upload</button>
        </form>
</div>