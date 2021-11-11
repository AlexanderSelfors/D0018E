<?php

$dbServer = 'https://utbweb.its.ltu.se/phpMyAdmin1';
$dbUsername = '19931112';
$dbPassword = '19931112';
$dbName = 'db19931112';

$connection = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);

if(!$connection){
    die('Connection Failed' . mysqli_connect_error());
}
echo "Connected";