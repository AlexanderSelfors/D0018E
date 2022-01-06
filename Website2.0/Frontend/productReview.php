<?php
    include_once 'header.php';
    require_once "../Backend/dbconn.php";

$product = $_GET['product'];
echo("<form action='../Backend/reviewCheck.php?product=$product' method='post'>");
?>
    <input type="number" name="rating" placeholder="Enter a value between 1 and 5" min=1 max =5>
    <input type="text" name="review" placeholder="Write your review">
    <input type="submit" value="Send Review" name="reviewSubmit">
</form>

<?php
    require_once "../Backend/LoadReviews.php";
