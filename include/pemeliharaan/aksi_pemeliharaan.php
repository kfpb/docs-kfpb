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
   mysql_query("INSERT INTO pemeliharaan (id_jenis,tgl_pemeliharaan,aknomor,aknama,uraian_pemeliharaan) 
				VALUES ('$_POST[jenis]','$_POST[tgl]','$_POST[aknomor]','$d[aknama]-$d[akmerk]','$_POST[uraian_pemeliharaan]')");
  echo "<script>window.alert('Data Tersimpan');
        window.location=('../../home.php?pages=pemeliharaan')</script>"; 
  
}

// Hapus 
elseif ($act=='hapus'){
     mysql_query("DELETE FROM pemeliharaan WHERE id_pemeliharaan='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=pemeliharaan')</script>"; 
  
  // Edit
}elseif ($act=='edit'){
   mysql_query("UPDATE pemeliharaan SET 
   tgl_pemeliharaan ='$_POST[tgl]',
   tgl_pemeliharaan_slesai ='$_POST[tgl_slesai]',
   aknomor ='$_POST[aknomor]', 
   aknama ='$_POST[aknama]', 
   id_jenis ='$_POST[jenis]', 
   uraian_pemeliharaan ='$_POST[uraian]', 
   ploleh ='$_POST[ploleh]', 
   keterangan_hasil ='$_POST[keterangan]' 
   WHERE id_pemeliharaan = '$_GET[id]'");
   
  echo "<script>window.alert('Data Terupdate');
        window.location=('../../home.php?pages=pemeliharaan')</script>";
}
?>
