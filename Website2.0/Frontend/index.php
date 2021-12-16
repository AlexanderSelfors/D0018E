<?php
    include_once 'header.php';
    include '../Backend/pdoutils.php';
    
    if (isset($_GET["logout"])) {
        echo("You have logged out");
    }


?>



        <div class=products>
            <?php
                require_once "../Backend/dbconn.php";
                    if(isset($_GET["category"])){
                        $catName = $_GET["category"];
                        $catSql = "SELECT * FROM category WHERE catName = '$catName';";
                        $catResult = mysqli_query($connection, $catSql);
                        $cat = mysqli_fetch_assoc($catResult);
                        $catID = $cat['catID'];
                        
                        $sql = "SELECT * FROM products WHERE product_catID = '$catID';";
                        $result = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            if ($row['productStock'] > 0){
                                $productStock = $row['productStock'];
                            }
                            else {
                                $productStock = "Sold out";
                            }
                            $userID = $row['product_userID'];
                            $userSql = "SELECT * FROM users WHERE userID = '$userID';";
                            $userResult = mysqli_query($connection, $userSql);
                            $userRow = mysqli_fetch_assoc($userResult); 
    
                            $username = $userRow['username'];
                            $productName = $row['productName'];
                            $productPrice = $row['productPrice'];
                            $productUrl = $row['productUrl'];
                            ?>
                            <div class="product-item">
                                <form action='index.php' method='POST'>
                                <div class="product-image"><?php echo "<img src=$productUrl>"; ?></div>
                                <div class="product-tile-footer">
                                <div class="product-title"><?php echo $productName; ?></div>
                                <div class="product-price"><?php echo $productPrice; ?></div>
                                <div class="product-price"><?php echo $productStock; ?></div>
                                </div>
                            </div>

                            <?php
                            if (isset($_SESSION['uid'])) {
                                if($_SESSION['uid'] == 3) {
                                    echo "<td>Delete</td>";
                                }
                                else {
                                    echo "<div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' />
                                        <button type='submit' name='addProduct' value='$productID'>Add to cart</button>
                                    </form>";

                                }
                            }
                        }
                    }else{
                        $sql = "SELECT * FROM products;";
                        $result = mysqli_query($connection, $sql);
                
                        while($row = mysqli_fetch_assoc($result)) {
                            if ($row['productStock'] > 0) {
                                $productStock = $row['productStock'];
                            }
                            else {
                                $productStock = "Sold out";
                            }
                            $userID = $row['product_userID'];
                            $userSql = "SELECT * FROM users WHERE userID = '$userID';";
                            $userResult = mysqli_query($connection, $userSql);
                            $userRow = mysqli_fetch_assoc($userResult); 
    
                            $username = $userRow['username'];
                            $productName = $row['productName'];
                            $productPrice = $row['productPrice'];
                            $productUrl = $row['productUrl'];
                            $productID = $row['productID'];
                            ?>
                            <div class="product-item">
                                <form action='index.php' method='POST'>
                                <div class="product-image"><?php echo "<img src=$productUrl>"; ?></div>
                                <div class="product-tile-footer">
                                <div class="product-title"><?php echo $productName; ?></div>
                                <div class="product-price"><?php echo $productPrice; ?></div>
                                <div class="product-price"><?php echo $productStock; ?></div>
                                </div>
                            </div>

                            <?php
                            if (isset($_SESSION['uid'])) {
                                if($_SESSION['uid'] == 3) {
                                    echo "<td>Delete</td>";
                                }
                                else {
                                    echo "<div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' />
                                        <button type='submit' name='addProduct' value='$productID'>Add to cart</button>
                                    </form>";

                                }
                            }
                        }
                    }

                    if (isset($_POST["addProduct"])) {
                        $_SESSION['pdoprodid'] = $_POST["addProduct"];
                        if (isset($_POST["quantity"])) {
                            $_SESSION['quantity'] = $_POST["quantity"];
                        }
                        addtocart();
                    }
                    
            ?>
        </div>
    </body>

    <!-- <div class='left-menu'>
    <a href="./Electronics.php" class="menu-item">Electronics</a>
    </div>

    <div class='left-menu'>
    <a href="./Furniture.php" class="menu-item">Furniture</a>
    </div> -->


</html>