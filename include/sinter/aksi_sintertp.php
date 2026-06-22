<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

                    $timestamp = date("Y-m-d");
                    $qrcode = $_POST[qrcode];
                    
                    $sql=mysql_query("SELECT * FROM aktiva WHERE aknomor='$_POST[qrcode]'");
                    $d=mysql_fetch_array($sql);
                    
                    $simpan = mysql_query("INSERT INTO riwayat (id_jenis,tgl_riwayat,username,nama,aknomor,aklokasi,uraian,keterangan) 
					VALUES ('$_POST[jenis]','$_POST[tgl]','$_SESSION[namauser]','$_SESSION[namalengkap]','$qrcode','$d[aklokasi]','$_POST[uraian]','$_POST[keterangan]')");


 if ($simpan){
	 
 echo "<script>window.alert('Riwayat Data Tersimpan!');window.close()</script>";
 
 }
 else {
    echo "<script>window.alert('Riwayat Data Gagal Tersimpan!');window.close()</script>"; 
 }
 
?>
