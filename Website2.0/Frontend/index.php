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
    
    
                            echo "<table>";
                            echo "<tr>";
                            echo "<img src=$productUrl>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>$productName</td>";
                            echo "<td>Price = $productPrice</td>";
                            echo "<td>Stock = $productStock</td>";
                            if (isset($_SESSION['uid'])) {
                                if($_SESSION['uid'] == 3) {
                                    echo "<td>Delete</td>";
                                }
                            }
                            echo "</tr>";
                            echo "</table>";
                            echo "<p></p>";
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
    
    
                            echo "<table>";
                            echo "<tr>";
                            echo "<img src=$productUrl>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>$productName</td>";
                            echo "<td>Price = $productPrice</td>";
                            echo "<td>Stock = $productStock</td>";
                            echo "<form action='index.php' method='POST'>
                                <button type='submit' name='addProduct' value='$productID'>Buy</button>
                            </form>";
                            if (isset($_SESSION['uid'])) {
                                if($_SESSION['uid'] == 3) {
                                    echo "<td>Delete</td>";
                                }
                            }
                            echo "</tr>";
                            echo "</table>";
                            echo "<p></p>";
                        }
                    }

                    if (isset($_POST["addProduct"])) {
                        $_SESSION['pdoprodid'] = $_POST["addProduct"];
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