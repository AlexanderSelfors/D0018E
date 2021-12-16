<?php
    include_once "../dbconn.php";  
    session_start();

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
     WHERE detail_OrderID = '$orderID' ";
     $resultdetails = mysqli_query($connection, $fetchdetails);

    while( $arraydetails = $resultdetails->fetch_array() )
     {
         $imageID = $arraydetails['detail_productID'];
         $fetchImage = "SELECT productURL FROM products WHERE productID = '$imageID'";
         $imageResult = mysqli_query($connection, $fetchImage);
         $imageArr = mysqli_fetch_assoc($imageResult); 
         $image = $imageArr['productURL'];
         $name = $arraydetails['detailName'];
         $stock = $arraydetails['detailStock'];
         $price = $arraydetails['detailPrice'] * $stock;

         ?>
        <div class="products">
            <form action='index.php' method='POST'>
            <div class="product-image"><?php echo "<img src=$image>"; ?></div>
            <div class="product-tile-footer">
            <div class="product-title"><?php echo $name; ?></div>
            <div class="product-price"><?php echo "Price = $price"; ?></div>
            <div class="product-price"><?php echo "Amount = $stock"; ?></div>
            </div>

        <?php
        if (isset($_SESSION['uid'])) {
            echo "<div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' />
                <button type='submit' name='addProduct' value='$productID'>Remove from cart</button>
            </form>";
        }
        ?>
        </div>
        <?php
     }


?>