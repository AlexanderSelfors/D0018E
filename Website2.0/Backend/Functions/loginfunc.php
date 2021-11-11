<?php      

    function userLogin($connection, $username, $pwd) {
        $sql = "select * FROM users WHERE username = '$username' AND PWD = '$pwd'";  
        $result = mysqli_query($connection, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
        $count = mysqli_num_rows($result);
              
        if($count == 1){
            $_SESSION["uid"] = $_POST['uid'];
            header("location: ../Frontend/index.php");
        }  
        else{
            header("location: ../Frontend/login.php?wrongcredentials");
        }  
    }
