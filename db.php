<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "register";

$con = mysqli_connect($servername, $username, $password, $database);


if (!$con) {
    die("Databaseverbinding mislukt: " . mysqli_connect_error());
}

