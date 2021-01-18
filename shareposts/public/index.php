<!-- 
    htaccess redirect: 
    
    https://stackoverflow.com/questions/18406156/redirect-all-to-index-php-using-htaccess 
-->

<?php

require_once '../app/bootstrap.php';

// Init Core Library

$init = new Core();


// check website live example

// function checkOnline($domain) {
//     $curlInit = curl_init($domain);
//     curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
//     curl_setopt($curlInit,CURLOPT_HEADER,true);
//     curl_setopt($curlInit,CURLOPT_NOBODY,true);
//     curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

//     //get answer
//     $response = curl_exec($curlInit);

//     curl_close($curlInit);

//     echo $response;

//     if ($response) return true;
//     return false;
// }

// if(checkOnline('http://angular.io')) { echo "yes"; }

// $header_check = get_headers("http://www.google.com");
// $response_code = $header_check[0];

// echo "\n".$response_code;

// print_r($header_check);

?>