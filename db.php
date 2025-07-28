<?php
//connecting to mysql db
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'school_php';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
?>