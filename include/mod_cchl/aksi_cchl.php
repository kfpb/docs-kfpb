<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config1/fungsi_thumb.php";
$act=$_GET[act];
$module=$_GET[module];


// Hapus cchl
if ($module=='cchl' AND $act=='hapus'){
echo "<p align=center><b>Apakah anda akan menghapus Penerima Dokumen ini ? <br></b>
<center><a href=$aksi?module=cchl&act=hapus2&id=$_GET[id]>Ya !</a> - <a href=../../home.php?pages=cchl>Tidak Jadi</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"
;
}
// Hapus cchl
if ($module=='cchl' AND $act=='hapus2'){
  mysql_query("DELETE FROM cchl WHERE id_cchl='$_GET[id]'");
  header('location:../../home.php?pages=cchl');
}

// Input cchl
elseif ($module=='cchl' AND $act=='input'){
  mysql_query("INSERT INTO cchl(nama_cchl,cchl) VALUES('$_POST[nama_cchl]','$_POST[cchl]')");
  header('location:../../home.php?pages=cchl');
}

// Update cchl
elseif ($module=='cchl' AND $act=='update'){
  mysql_query("UPDATE cchl SET nama_cchl= '$_POST[nama_cchl]', cchl='$_POST[cchl]' WHERE id_cchl = '$_POST[id]'");
  header('location:../../home.php?pages=cchl');
}
?>
