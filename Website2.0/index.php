<?php
    function db_connect(){
        $connection = mysqli_connect('utbweb.its.ltu.se', '19931112', '19931112', 'db19931112');
        if(mysqli_connect_errno()){
            echo "Connection to database failed";
        }else{
        }
        return $connection;   
    }

    db_connect();

    include_once 'header.php';
?>


</body>
</html>