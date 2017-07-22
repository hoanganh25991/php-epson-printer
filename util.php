<?php
function hoiEcho($msg){
    $lineFeed = PHP_EOL;
    echo "$msg$lineFeed";
}

function isPost(){
    $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
    return $isPost;
}


function randomStr($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}