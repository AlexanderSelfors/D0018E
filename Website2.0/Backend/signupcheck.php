<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];
    $fName = $_POST["fname"];
    $lName = $_POST["lname"];
    $pNumber = $_POST["pnumber"];
    $address = $_POST['address'];

    require_once 'dbconn.php'; 
    session_start();
    require_once __DIR__ . '/Functions/signupfunc.php';


    if (emptyInputSignup($email, $username, $password, $passwordRepeat) !== false) {
        header("location: ../Frontend/register.php?error=missinginput");
        exit();
    }

    else if (usernameExists($connection, $username) !== false) {
        header("location: ../Frontend/register.php?error=usernametaken");
        exit();
    }

    else if (invalidEmail($email) !== false) {
        header("location: ../Frontend/register.php?error=invalidemail");
        exit();
    }
    
    else if (passwordMatch($password, $passwordRepeat) !== false) {
        header("location: ../Frontend/register.php?error=passwordnotmatch");
        exit();
    }
    

    else {
        createUser($connection, $username, $email, $password, $fName, $lName, $address, $pNumber);
        exit();
    }
    
}
else {
    header("location: ../Frontend/register.php");
    exit();
}