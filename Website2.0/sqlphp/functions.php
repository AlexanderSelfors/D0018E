<?php

function emptyInputSignup($email, $uid, $password, $passwordRepeat) {
    if (empty($uid) || empty($email) || empty($password) || empty($passwordRepeat)) {
        return true;
    }
    else {
        return false;
    }
}

function invalidEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

function passwordMatch($password, $passwordRepeat) {
    if ($password !== $passwordRepeat) {
        return true;
    }
    else {
        return false;
    }
}

function usernameExists($connection, $username) {
    $sql = "SELECT * FROM users WHERE UID = ?;";
    $prepStatement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($prepStatement, $sql)) {
        header("location: ../register.php?error=sqlstatmentfailed");
        exit();
    }

    mysqli_stmt_bind_param($prepStatement, "s", $username);
    mysqli_stmt_execute($prepStatement);

    $resultData = mysqli_stmt_get_result($prepStatement);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        return false;
    }

    mysqli_stmt_close($prepStatement);
}
