<?php

session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "brik";
$tabel_name = "login";

$connect = mysqli_connect($hostname, $username, $password, $database_name);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$user = $_POST ['username'];
$pass = $_POST ['password'];

$sqldatabase = "SELECT `ID`, `username`, `password` FROM `login` WHERE username = '$user' && password = '$pass'";

$outputresult = mysqli_query($connect, $sqldatabase);

$count = mysqli_num_rows($outputresult);

if ($count == 1) {

    $_SESSION ['login'] = 1;
    $_SESSION ['username'] = $user;
    $_SESSION ['password'] = $pass;

    header("location:dashboard.php");
} else {

    header("location:index.php");
}

mysqli_close($connect);
