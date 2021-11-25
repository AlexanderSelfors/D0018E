<?php

  $dbServername = "utbweb.its.ltu.se";
  $dbUsername = "19980626";
  $dbPassword = "19980626";
  $dbName = "db19980626";

// Create connection
  $connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }
