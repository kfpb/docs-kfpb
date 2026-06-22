<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "ekfpb_bnj";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
