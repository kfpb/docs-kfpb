<?php
error_reporting(E_ERROR);
$server = "localhost";
$username = "sql_kfpb_kimiafa";
$password = "PeGPLkNzBaMz32kH";
$database = "sql_kfpb_kimiafa";

// Koneksi dan memilih database di server
$database2 = mysql_connect($server,$username,$password) or die("Koneksi gagal");
$koneksi2 = mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
