<?php
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus jendok
if ($module=='jendok' AND $act=='hapus'){
echo "<p align=center><b>Apakah anda akan menghapus Jenis Dokumen ini ? <br></b>
<center><a href=$aksi?module=jendok&act=hapus2&id=$_GET[id]>Ya !</a> - <a href=../../home.php?pages=jendok>Tidak Jadi</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"
;
}
// Hapus jendok
if ($module=='jendok' AND $act=='hapus2'){
  mysql_query("DELETE FROM jendok WHERE id_jendok='$_GET[id]'");
  header('location:../../home.php?pages=jendok');
}

// Input jendok
elseif ($module=='jendok' AND $act=='input'){
  mysql_query("INSERT INTO jendok(nama_jendok) VALUES('$_POST[nama_jendok]')");
  header('location:../../home.php?pages=jendok');
}

// Update jendok
elseif ($module=='jendok' AND $act=='update'){
  mysql_query("UPDATE jendok SET nama_jendok='$_POST[nama_jendok]', aktif='$_POST[aktif]' 
               WHERE id_jendok = '$_POST[id]'");
  header('location:../../home.php?pages=jendok');
}



?>
