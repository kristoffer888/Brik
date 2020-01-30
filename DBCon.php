<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'brik';
$tabel_name = 'brikliste';

$connect = mysqli_connect($servername, $username, $password, $databasename);
if (!$connect) {
    die("Connectiuon failed because" . mysqli_connect_error());
}

class DB {

    private $m_database;

    function __construct($servername, $username, $password, $databasename) {
        $this->m_database = mysqli_connect($servername, $username, $password, $databasename);
    }

    function __destruct() {
        $this->m_database->close();
    }

    function Connection() {
        return $this->m_database;
    }

}
