<?php      
    include "pdoutils.php";


    $db = connect();

    $cartarray = returnAllArray($stmt ="SELECT * FROM cart WHERE cart_userID = '12'" , $db);
    
    $count = 0;
    while($cartarray){
        print_r($cartarray[$count]);
        unset($cartarray[$count]);
        $count = $count + 1;
    }

    print("Fin");
    print_r($cartarray);

    $db = null;

?> 