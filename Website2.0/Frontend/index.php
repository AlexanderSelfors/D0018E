<?php
    include_once 'header.php';
    
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
                            $productID = $row['productID'];
    
    
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
                                }else{
                                    echo "<td><form action='index.php' method='POST'>
                                    <button type='submit' name='addProduct' value='$productID'>Add to cart</button>
                                </form></td>";
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
                            if (isset($_SESSION['uid'])) {
                                if($_SESSION['uid'] == 3) {
                                    echo "<td>Delete</td>";
                                }
                                else {
                                    echo "<td><form action='index.php' method='POST'>
                                    <button type='submit' name='addProduct' value='$productID'>Add to cart</button>
                                </form></td>";
                                }
                            }
                            echo "</tr>";
                            echo "</table>";
                            echo "<p></p>";
                        }
                    }

                    if (isset($_POST["addProduct"])) {
                        $prodID = $_POST["addProduct"];
                        $sqlProd = "SELECT * FROM products WHERE productID = $prodID;";
                        $resultProd = mysqli_query($connection, $sqlProd);
                        $ProdDetails = mysqli_fetch_row($resultProd);

                        $uid = $_SESSION['uid'];
                        $sqlOrder = "SELECT * FROM orders WHERE order_UID = $uid;";
                        $resultOrder = mysqli_query($connection, $sqlOrder);
                        $OrderDetails = mysqli_fetch_row($resultOrder);

                        $detail_orderID = $OrderDetails[0];
                        $detail_productID = $prodID;
                        $detailName = $ProdDetails[3];
                        $detailPrice = $ProdDetails[4];
                        $detailStock = $prodDetails[5];

                        echo $detail_orderID;

                        $addSql = "INSERT INTO orderdetails (detail_orderID, detail_productID, detailName,
                        detailPrice, detailStock) VALUES ('$detail_orderID', '$detail_productID', '$detailName', '$detailPrice', '$detailStock')";
                        $result = mysqli_query($connection, $addSql);  

                    }
            ?>
        </div>
    </body>

</html>