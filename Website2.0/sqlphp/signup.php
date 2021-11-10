<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];
    $fName = $_POST["fname"];
    $lName = $_POST["lname"];
    $adress = $_POST["adress"];
    $pNumber = $_POST["pnumber"];

    require_once 'dbconn.php';
    require_once 'functions.php';

    if (emptyInputSignup($email, $username, $password, $passwordRepeat) !== false) {
        header("location: ../register.php?error=missinginput");
        exit();
    }

    else if (invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    else if (passwordMatch($password, $passwordRepeat) !== false) {
        header("location: ../register.php?error=passwordnotmatch");
        exit();
    }

    else if (usernameExists($connection, $username) !== false) {
        header("location: ../register.php?error=usernametaken");
        exit();
    }

    else {
        createUser($connection, $username, $email, $password, $fName, $lName, $adress, $pNumber);
        exit();
    }

}
else {
    header("location: ../register.php");
    exit();
}