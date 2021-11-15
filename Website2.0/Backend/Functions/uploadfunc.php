<?php

function emptyInputUpload($itemName, $price, $description) {
    if (empty($itemName) || empty($price) || empty($description)) {
        return true;
    }
    else {
        return false;
    }
}