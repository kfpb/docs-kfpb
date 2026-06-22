<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input 
if ($act=='tambah'){
   mysql_query("INSERT INTO area
   (nomor_area, area_utama, nama_area)VALUES('$_POST[nomor_area]','$_POST[area_utama]','$_POST[nama_area]')");
  echo "<script>window.alert('Data Tersimpan');
        window.location=('../../home.php?pages=area')</script>"; 
  
}

// Hapus 
elseif ($act=='hapus'){
     mysql_query("DELETE FROM area WHERE id_area='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=area')</script>"; 
  
  // Edit
}elseif ($act=='edit'){
   mysql_query("UPDATE area SET nama_area ='$_POST[nama_area]', nomor_area ='$_POST[nomor_area]', area_utama ='$_POST[area_utama]' WHERE id_area = '$_GET[id]'");
  echo "<script>window.alert('Data Terupdate');
        window.location=('../../home.php?pages=area')</script>";
}
?>
