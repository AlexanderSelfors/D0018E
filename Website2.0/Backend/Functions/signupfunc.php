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
    $sql = "SELECT username from users WHERE username='{$username}';";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) >0) {
        return true;
    }
    else {
        return false;
    }
}

function createUser($connection, $username, $email, $password, $fName, $lName, $address, $pNumber) {
    $sql = "INSERT INTO users (username, userPWD, userEmail, userFname, userLname, userPnum, userAddress) VALUES ('$username', '$password', '$email', '$fName', '$lName', '$pNumber', '$address');";

    if ($connection->query($sql) === true)
    {
        header("location: ../Frontend/login.php?accountcreated");    
    }
    else {
        header("location: ../Frontend/register.php?error=sqlfailed");    

    }
}
