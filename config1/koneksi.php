<?php

$server = "localhost";
// $username = "sql_bnj_coba2";
// $password = "PPZFfXJkWezZLy2R";
// $database = "sql_bnj_coba2";
$username = "sql_bnj_180423";
$password = "BnjTAjiSMLJ4BMH5";
$database = "sql_bnj_180423";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
