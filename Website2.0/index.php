<?php
    function db_connect(){
        $connection = mysqli_connect('utbweb.its.ltu.se', '19990308', 'bestDBever12', 'db19990308');
        if(mysqli_connect_errno()){
            echo "Fuck";
        }else{
            echo "Finally!";
        }
        return $connection;
    }

    db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Trash</title>
</head>
<body>
    <h1>It finally fucking works!</h1>
</body>
</html>