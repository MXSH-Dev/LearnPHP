<?php

// echo 'hello world!!!!';

$name = "Yoshi";

// define constant
define("NAME", "Yoshi2");

$stringOne = 'my email is';

$stringTwo = 'johnDoe@gami.com';

$str3 = $stringOne . $stringTwo;

echo $str3;

echo "\n";

echo "my email is $stringTwo";

echo "\n";

echo str_replace('gami', 'gmail', $stringTwo);

// index array

$people1 = [
    'john', 'crystal'
];

print_r($people1);

array_push($people1, "thrid");

echo count($people1);

// associative arrays

$myArr = [
    "key" => "value",
    "hello" => "world",
];

print_r($myArr["key"]);
