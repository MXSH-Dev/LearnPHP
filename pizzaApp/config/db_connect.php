<?php

$conn = mysqli_connect('localhost', 'admin', 'password', 'mxsh_pizza');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
