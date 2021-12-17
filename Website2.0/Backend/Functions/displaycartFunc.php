<?php

     // Assign variables 
     $userUID = $_SESSION["uid"];

     // Fetch orderID for user
     $sql = "select orderID
     FROM orders
     WHERE order_UID = '$userUID' ";
     $result = mysqli_query($connection, $sql);
     $row = $result->fetch_array();
     $orderID = $row['orderID'];

     
     // Fetch detailName , detailPrice , detailStock , orderID from tables orders and orderdetails
     $fetchdetails = "select detailID, detail_productID, detailName, detailPrice , detailStock
     FROM orderdetails 
     WHERE detail_orderID = '$orderID' ";
     $resultdetails = mysqli_query($connection, $fetchdetails);
     $totalPrice = 0;

    while( $arraydetails = $resultdetails->fetch_array() )
     {
         $detailID = $arraydetails['detailID'];
         $productID = $arraydetails['detail_productID'];
         $fetchImage = "SELECT productURL FROM products WHERE productID = '$productID'";
         $imageResult = mysqli_query($connection, $fetchImage);
         $imageArr = mysqli_fetch_assoc($imageResult); 
         $image = $imageArr['productURL'];
         $name = $arraydetails['detailName'];
         $stock = $arraydetails['detailStock'];
         $price = $arraydetails['detailPrice'] * $stock;
         $totalPrice += $price;

         ?>
        <div class="products">
            <form action='cart.php' method='POST'>
            <div class="product-image"><?php echo "<img src=$image>"; ?></div>
            <div class="product-tile-footer">
            <div class="product-title"><?php echo $name; ?></div>
            <div class="product-price"><?php echo "Price = $price"; ?></div>
            <div class="product-price"><?php echo "Amount = $stock"; ?></div>
            </div>

        <?php
        if (isset($_SESSION['uid'])) {
            echo "<div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' />
                <button type='submit' name='removeProduct' value='$detailID'>Remove from cart</button>
            </form>";
        }
     }
     ?>
     <form action='cart.php' method='POST'>
     <?php
     echo "<p>Total price = $totalPrice </p>";
     ?>
     <button type='submit' name='checkout'>Checkout</button>
     </form>
     </div>
     <?php
     if (isset($_POST["removeProduct"])) {
        $_SESSION['cartRemoveProd'] = $_POST["removeProduct"];
        $cartRemoveDetailID = $_SESSION['cartRemoveProd'];
        if (isset($_POST["quantity"])) {
            $_SESSION['cartRemoveQuantity'] = $_POST["quantity"];
        }
        $sql = "SELECT detail_productID, detailStock FROM orderdetails WHERE detailID = '$cartRemoveDetailID'";
        $result = mysqli_query($connection, $sql);
        $resultArr = mysqli_fetch_assoc($result);
        $productID = $resultArr['detail_productID'];
        $stock = $resultArr['detailStock'] - $_SESSION['cartRemoveQuantity'];
        if ($stock > 0)
        {
            $sql = "UPDATE orderdetails SET detailStock='$stock' WHERE detail_orderID = '$orderID' AND detailID = '$cartRemoveDetailID'"; 
            $result = mysqli_query($connection, $sql);  

            $sql = "SELECT productStock FROM products WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $productStock = $row['productStock'] + $_SESSION['cartRemoveQuantity'];
            $sql = "UPDATE products SET productStock = '$productStock' WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
        }
        else {
            $sql = "DELETE FROM orderdetails WHERE detail_orderID = '$orderID' AND detailID = '$cartRemoveDetailID'";
            $result = mysqli_query($connection, $sql);
            
            $sql = "SELECT productStock FROM products WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $productStock = $row['productStock'] + $resultArr['detailStock'];
            $sql = "UPDATE products SET productStock = '$productStock' WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
        }
        header("Location: ./cart.php?removedItem");
    }
    else if (isset($_POST['checkout'])) {
        $sql = "DELETE FROM orderdetails WHERE detail_orderID = '$orderID'";
        $result = mysqli_query($connection, $sql);
    }

?>