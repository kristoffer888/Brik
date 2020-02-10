<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
$_GET = array();

//Find antal personer i hver zone
//database ting
$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'brik';
$tabel_name = 'login';

$connect = mysqli_connect($servername, $username, $password, $databasename);
if (!$connect) {
    die("Connectiuon failed because" . mysqli_connect_error());
}


$sql = "SELECT * FROM login WHERE status = 1";
$result = mysqli_query($connect, $sql);
$_GET['zone5'] = mysqli_num_rows($result);

$sql = "SELECT * FROM login WHERE status = 2";
$result = mysqli_query($connect, $sql);
$_GET['zone6'] = mysqli_num_rows($result);

$sql = "SELECT * FROM login WHERE status = 3";
$result = mysqli_query($connect, $sql);
$_GET['programmoerer'] = mysqli_num_rows($result);

$sql = "SELECT * FROM login WHERE status = 4";
$result = mysqli_query($connect, $sql);
$_GET['serverrum'] = mysqli_num_rows($result);

$sql = "SELECT * FROM login WHERE status = 5";
$result = mysqli_query($connect, $sql);
$_GET['helpdesk'] = mysqli_num_rows($result);

$sql = "SELECT * FROM login WHERE status = 6";
$result = mysqli_query($connect, $sql);
$_GET['ekstern'] = mysqli_num_rows($result);

echo json_encode($_GET);
?>