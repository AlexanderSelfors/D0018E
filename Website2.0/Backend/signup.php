<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];

    require_once 'dbconn.php'; 
    require_once __DIR__ . '/Functions/signupCheck.php';


    if (emptyInputSignup($email, $username, $password, $passwordRepeat) !== false) {
        header("location: ../Frontend/register.php?error=missinginput");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../Frontend/register.php?error=invalidemail");
        exit();
    }
    
    if (passwordMatch($password, $passwordRepeat) !== false) {
        header("location: ../Frontend/register.php?error=passwordnotmatch");
        exit();
    }

    if (usernameExists($connection, $username) !== false) {
        header("location: ../Frontend/register.php?error=usernametaken");
        exit();
    }

    
    createUser($connection, $username, $email, $password);
    exit();
    

}
else {
    header("location: ../Frontend/register.php");
    exit();
}