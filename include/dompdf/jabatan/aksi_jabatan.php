<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input user
if ($act=='tambah'){
   mysql_query("INSERT INTO jabatan(jabatan)VALUES('$_POST[nama]')");
  echo "<script>window.alert('Data Tersimpan');
        window.location=('../../home.php?pages=jabatan')</script>"; 
  
}

// Update user
elseif ($act=='hapus'){
     mysql_query("DELETE FROM jabatan WHERE idj='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=jabatan')</script>"; 
  
  
}elseif ($act=='edit'){
   mysql_query("UPDATE jabatan SET jabatan ='$_POST[nama]' WHERE idj = '$_GET[id]'");
  echo "<script>window.alert('Data Terupdate');
        window.location=('../../home.php?pages=jabatan')</script>";
}
?>
