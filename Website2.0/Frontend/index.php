<?php
    include_once 'header.php';
    
    if (isset($_GET["logout"])) {
        echo("You have logged out");
    }

?>



        <div class=products>
            <?php
                require_once "../Backend/dbconn.php";
                $sql = "SELECT * FROM products;";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
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