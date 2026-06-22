<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input 
if ($act=='tambah'){
   mysql_query("INSERT INTO atk
   (kategori, unit, nama_atk)VALUES('$_POST[kategori]','$_POST[unit]','$_POST[nama_atk]')");
  echo "<script>window.alert('Data Tersimpan');
        window.location=('../../home.php?pages=atk')</script>"; 
  
}

// Hapus 
elseif ($act=='hapus'){
     mysql_query("DELETE FROM atk WHERE id_atk='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=atk')</script>"; 
  
  // Edit
}elseif ($act=='edit'){
   mysql_query("UPDATE atk SET kategori ='$_POST[kategori]', unit ='$_POST[unit]', nama_atk ='$_POST[nama_atk]' WHERE id_atk = '$_GET[id]'");
  echo "<script>window.alert('Data Terupdate');
        window.location=('../../home.php?pages=atk')</script>";
}
?>
