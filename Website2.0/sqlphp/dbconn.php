<?php
$serverName = "utbweb.its.ltu.se";
$dBUsername = "19931112";
$dBPassword = "19931112";
$dBname = "db19931112";

$connection = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
if(mysqli_connect_errno()){
    echo "Connection to database failed";
}else{
}
