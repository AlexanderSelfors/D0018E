<?php
    include_once 'header.php';
    require_once "../Backend/dbconn.php";

$product = $_GET['product'];
echo("<form action='../Backend/reviewCheck.php?product=$product' method='post' class='reviewForm'>");
echo("<h1>Reviews</h1>");
?>
    <input type="number" name="rating" placeholder="Enter a value between 1 and 5" min=1 max =5 id='ratingField'>
</br>
    <textarea name="review" placeholder="Write your review" id='commentField'></textarea>
</br>
    <input type="submit" value="Send Review" name="reviewSubmit" id='reviewSubmit'>
</form>

<?php
    require_once "../Backend/LoadReviews.php";
