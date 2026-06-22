<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  Uploaddokint($nama_file_unik);
  $q=mysql_query("INSERT INTO dokint(sinmr,
                                   sitgl,
                                   sipengirim,
                                   siperihal,
                                   siket,
								   sifile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[ket]',
								'$nama_file_unik')");
  if ($q){
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=dokint')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

}elseif($act=='edit'){
  $q=mysql_query("UPDATE dokint SET sinmr   	 = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
                                   sipengirim = '$_POST[pengirim]',
                                   siperihal = '$_POST[perihal]',
								   siket	 = '$_POST[ket]'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	  echo "<script>window.alert('Data Terupdate');window.location=('../../home.php?pages=dokint')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}
// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM dokint WHERE siid='$_GET[id]'"));
  if ($data['sifile']!=''){
     mysql_query("DELETE FROM dokint WHERE siid='$_GET[id]'");
	 mysql_query("DELETE FROM pdoki WHERE siid='$_GET[id]'");
	 unlink("../../dokintnal/$data[sifile]"); 
  }
  else{
     mysql_query("DELETE FROM dokint WHERE siid='$_GET[id]'");
 	 mysql_query("DELETE FROM pdoki WHERE siid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=dokint')</script>"; 
}
//tambah penerima
elseif ($act=='lp'){
  mysql_query("DELETE FROM pdoki WHERE siid='$_GET[id]'");	
  $pdoki = $_POST["pdoki"];
  foreach ($pdoki as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO pdoki(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  mysql_query("DELETE FROM tsin WHERE siid='$_GET[id]'");	
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q & $r){
	  echo "<script>window.location=('../../home.php?pages=dokint')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}
?>
