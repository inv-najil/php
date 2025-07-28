<?php

$host = "localhost";
$user = "root";
$password = "12345678";
$dbname = "school_php";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}

echo "Connected to db";

?>