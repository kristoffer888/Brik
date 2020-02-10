<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'brik';
$tabel_name = 'login';

$connect = mysqli_connect($servername, $username, $password, $databasename);
if (!$connect) {
    die("Connectiuon failed because" . mysqli_connect_error());
}