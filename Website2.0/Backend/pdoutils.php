<?php

/* Connect to a MySQL database using driver invocation */
function connect(){
    $dbh = null;
    $dsn = 'mysql:dbname=db19980626;host=utbweb.its.ltu.se';
    $user = '19980626';
    $password = '19980626';
    // Autocommit false enables queries? Turn off to enable rollback.
    $options = array(PDO::ATTR_AUTOCOMMIT=>FALSE);
    
    $dbh = new PDO($dsn, $user, $password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


function returnArray($stmt , $db){
    $sth = $db->prepare($stmt);
    $sth->execute();
    $tempqueryarray = $sth->fetch(PDO::FETCH_BOTH);
    return $tempqueryarray;
}







/*
try {
    $dbh->beginTransaction();
    // Execute query
    $sth = $dbh->prepare("SELECT * FROM users");
    $sth->execute();

    // Fetch the array
    $result = $sth->fetch(PDO::FETCH_BOTH);
    print_r($result);
    $dbh = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}*/


/* Fetch all of the remaining rows in the result set */
//$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
//print_r($result);






?>
