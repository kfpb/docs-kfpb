<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input 
if ($act=='tambah'){
   $sql=mysql_query("SELECT * FROM aktiva WHERE aknomor='$_POST[aknomor]'");
                    $d=mysql_fetch_array($sql);
   mysql_query("INSERT INTO riwayat (id_jenis,tgl_riwayat,username,nama,aknomor,aklokasi,uraian,keterangan) 
				VALUES ('$_POST[jenis]','$_POST[tgl]','$_SESSION[namauser]','$_SESSION[namalengkap]','$_POST[aknomor]','$d[aklokasi]','$_POST[uraian]','$_POST[keterangan]')");
  echo "<script>window.alert('Data Tersimpan');
        window.location=('../../home.php?pages=riwayat')</script>"; 
  
}

// Hapus 
elseif ($act=='hapus'){
     mysql_query("DELETE FROM riwayat WHERE id_riwayat='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=riwayat')</script>"; 
  
  // Edit
}elseif ($act=='edit'){
   mysql_query("UPDATE riwayat SET tgl_riwayat ='$_POST[tgl]', aknomor ='$_POST[aknomor]', aklokasi ='$_POST[aklokasi]', id_jenis ='$_POST[jenis]', username ='$_POST[user]', nama ='$_POST[nama]', uraian ='$_POST[uraian]', keterangan ='$_POST[keterangan]' WHERE id_riwayat = '$_GET[id]'");
  echo "<script>window.alert('Data Terupdate');
        window.location=('../../home.php?pages=riwayat')</script>";
}
?>
