<?php      

if (isset($_POST["submit"])) {
    require_once __DIR__ . '/Functions/loginfunc.php';
    require_once 'dbconn.php';
    session_start();

    $username = $_POST['uid'];  
    $pwd = $_POST['pwd'];

    userLogin($connection, $username, $pwd);
}
else {
    header("location: ../Frontend/login.php?login");
    exit();
}

    