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
    $sql = "SELECT username FROM USERS WHERE username=$username;";
    
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        return true;
    }
    else {
        return false;
    }
}

function createUser($connection, $username, $email, $password, $fName, $lName, $address, $pNumber) {
    $sql = "INSERT INTO USERS (username, PWD, Email, userFname, userLname, userPnum, userAddress) VALUES ($username, $password, $email, $fName, $lName, $address, $pNumber);";

    $result = $connection->query($sql);
}


/*
function usernameExists($connection, $username) {
    $sql = "SELECT * FROM USERS WHERE userUID = ?;";
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

function createUser($connection, $username, $email, $password, $fName, $lName, $address, $pNumber) {
    $sql = "INSERT INTO USERS (userUID, username, PWD, Email, userFname, userLname, userPnum, userAddress) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $prepStatement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($prepStatement, $sql)) {
        header("location: ../register.php?error=sqlstatmentfailed");
        exit();
    }

    mysqli_stmt_bind_param($prepStatement, "sssssss", $username, $email, $password, $fName, $lName, $address, $pNumber);
    mysqli_stmt_execute($prepStatement);
    mysqli_stmt_close($prepStatement);
    header("location: ../index.php");
}
*/