<?php
    include "../Backend/pdoutils.php";

     // Assign variables 
     $userUID = $_SESSION["uid"];
     
     $fetchdetails = "select cart_transactionID, cart_productID, productName, productPrice , productStock
     FROM cart 
     WHERE cart_userID = '$userUID' ";
     $resultdetails = mysqli_query($connection, $fetchdetails);
     $totalPrice = 0;

    while($arraydetails = $resultdetails->fetch_array() )
     {
         $transactionID = $arraydetails['cart_transactionID'];
         $productID = $arraydetails['cart_productID'];
         $fetchImage = "SELECT productURL FROM products WHERE productID = '$productID'";
         $imageResult = mysqli_query($connection, $fetchImage);
         $imageArr = mysqli_fetch_assoc($imageResult); 
         $image = $imageArr['productURL'];
         $name = $arraydetails['productName'];
         $stock = $arraydetails['productStock'];
         $price = $arraydetails['productPrice'] * $stock;
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
                <button type='submit' name='removeProduct' value='$transactionID'>Remove from cart</button>
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
        $removeCartID = $_SESSION['cartRemoveProd'];
        if (isset($_POST["quantity"])) {
            $_SESSION['cartRemoveQuantity'] = $_POST["quantity"];
        }
        $sql = "SELECT cart_productID, productStock FROM cart WHERE cart_transactionID = '$removeCartID'";
        $result = mysqli_query($connection, $sql);
        $resultArr = mysqli_fetch_assoc($result);
        $productID = $resultArr['cart_productID'];
        $stock = $resultArr['productStock'] - $_SESSION['cartRemoveQuantity'];
        if ($stock > 0)
        {
            $sql = "UPDATE cart SET productStock='$stock' WHERE cart_transactionID = '$removeCartID'"; 
            $result = mysqli_query($connection, $sql);  

            $sql = "SELECT productStock FROM products WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $productStock = $row['productStock'] + $_SESSION['cartRemoveQuantity'];
            $sql = "UPDATE products SET productStock = '$productStock' WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
        }
        else {
            $sql = "DELETE FROM cart WHERE cart_transactionID = '$removeCartID'";
            $result = mysqli_query($connection, $sql);
            
            $sql = "SELECT productStock FROM products WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $productStock = $row['productStock'] + $resultArr['productStock'];
            $sql = "UPDATE products SET productStock = '$productStock' WHERE productID = '$productID'";
            $result = mysqli_query($connection, $sql);
        }
        header("Location: ./cart.php?removedItem");
    }
    else if (isset($_POST['checkout'])) {
        pdocheckout();
       
        //$sql = "DELETE FROM cart WHERE cart_userID = '$userUID'";
        //$result = mysqli_query($connection, $sql);
    }

?>