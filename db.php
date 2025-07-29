<?php
//connecting to mysql db
$host = "db";
$user = "root";
$password = "root";
$dbname = "school_php";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
?>