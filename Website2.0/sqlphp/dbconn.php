<?php
  include_once 'header.php';
  $servername = "utbweb.its.ltu.se";
  $username = "19931112";
  $password = "19931112";
  $dbname = "db19931112";

// Create connection
  $connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

  /*
  echo "Connected successfully";

  $sql = "SELECT userUID FROM USERS";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["userUID"];
    }
  }
  $sql = "INSERT INTO USERS (username, PWD, Email)
  VALUES ( 'Domilz2','asd' ,'Domilz@example.com')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  

$conn->close();*/

