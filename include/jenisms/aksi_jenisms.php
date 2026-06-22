<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input 
if ($act=='tambah'){
   mysql_query("INSERT INTO jenisms
   (kode_jms, nama_jms)VALUES('$_POST[kode_jms]','$_POST[nama_jms]')");
  echo "<script>window.alert('Data Tersimpan');
        window.location=('../../home.php?pages=jenisms')</script>"; 
  
}

// Hapus 
elseif ($act=='hapus'){
     mysql_query("DELETE FROM jenisms WHERE id_jms='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=jenisms')</script>"; 
  
  // Edit
}elseif ($act=='edit'){
   mysql_query("UPDATE jenisms SET nama_jms ='$_POST[nama_jms]', kode_jms ='$_POST[kode_jms]' WHERE id_jms = '$_GET[id]'");
  echo "<script>window.alert('Data Terupdate');
        window.location=('../../home.php?pages=jenisms')</script>";
}
?>
