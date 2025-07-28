<?php
session_start();

//hard coded login
$valid_username = "admin";
$valid_password = "admin";

//initialize session variables attemps and lockout
if (!isset($_SESSION["attempts"]))
    $_SESSION["attempts"] = 0;
if (!isset($_SESSION["lockout"]))
    $_SESSION["lockout"] = 0;

//blocking if lockout
if (time() < $_SESSION["lockout"]) {
    $wait = ceil(($_SESSION["lockout"] - time()) / 60);
    header("Location: login.html?error=Locked out try again in $wait minitues");
    exit;
}

//get user input
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

//check login 
if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['attempts'] = 0;
    $_SESSION['lockout'] = 0;
    header("Location: dash.html");
    exit;
} else {
    //increase attempts count
    $_SESSION["attempts"]++;
    //lock out if attempts > 3
    if ($_SESSION["attempts"] >= 3) {
        $_SESSION["lockout"] = time() + (5 * 60);
        header("Location: login.html?error=Too many failed attempts try again in 5 minitues");
    } else {
        $left = 3 - $_SESSION["attempts"];
        header("Location: login.html?error=invalid credentials you have $left attempts left");
    }
    exit;
}


