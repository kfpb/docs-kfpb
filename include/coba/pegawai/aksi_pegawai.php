<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input pegawai
if ($act=='tambah'){
  $pass = md5($_POST['pass']);
  
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $foto = $acak.$nama_file; 
  
  if (!empty($lokasi_file)){
	UploadFoto($foto);
	$q=mysql_query("INSERT INTO pegawai(cNPP,
									cNama,
									cStatus,
									cBagian,
									cBagian2,
									cSub2,
									cBagian3,
									cFoto) 
							VALUES('$_POST[npp]',
									'$_POST[nama]',
									'$_POST[status]',
									'$_POST[bagian]',
									'$_POST[bagian2]',
									'$_POST[bagian]',
									'$_POST[bagian2]',
									'$foto')");
  }else{
	$q=mysql_query("INSERT INTO pegawai(cNPP,
									cNama,
									cStatus,
									cBagian,
									cBagian2,
									cSub2,
									cBagian3) 
							VALUES('$_POST[npp]',
									'$_POST[nama]',
									'$_POST[status]',
									'$_POST[bagian]',
									'$_POST[bagian2]',
									'$_POST[bagian]',
									'$_POST[bagian2]')");
	}
  if ($q){
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=pegawai')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
}
// hapus pegawai
elseif ($act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT cFoto FROM pegawai WHERE cId='$_GET[id]'"));
  if ($data['cFoto']!=''){
    //hapus file foto
	 unlink("../../fotopegawai/$data[cFoto]"); 
  }
  mysql_query("DELETE FROM pegawai WHERE cId='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=pegawai')</script>"; 
}
// edit pegawai
elseif ($act=='edit'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $foto = $acak.$nama_file; 

  //jika data diupdate ubahfoto=0 
  if (empty($lokasi_file)){
	$q=mysql_query("UPDATE pegawai SET cNPP    = '$_POST[npp]',
                                   cNama     = '$_POST[nama]', 
                                   cStatus	 = '$_POST[status]',  
                                   cBagian	 = '$_POST[bagian]',
                                   cBagian2	 = '$_POST[bagian2]',
                                   cSub2	 = '$_POST[sub2]',
                                   cBagian3	 = '$_POST[bagian3]'
								   WHERE cId = '$_GET[id]'");
	
  }
  //jika data diupdate ubahfoto=1 
  else {
	$data=mysql_fetch_array(mysql_query("SELECT cFoto FROM pegawai WHERE cId='$_GET[id]'"));
	if ($data['cFoto']!=''){
		//hapus foto
		unlink("../../fotopegawai/$data[cFoto]"); 
	}
	UploadFoto($foto);
	$q=mysql_query("UPDATE pegawai SET cNPP    = '$_POST[npp]',
                                   cNama     = '$_POST[nama]',  
                                   cStatus	 = '$_POST[status]',  
                                   cBagian	 = '$_POST[bagian]',
                                   cBagian	 = '$_POST[bagian]',
                                   cBagian2	 = '$_POST[bagian2]',
                                   cSub2	 = '$_POST[sub2]',
                                   cBagian3	 = '$_POST[bagian3]',
								   cFoto	 = '$foto'
								   WHERE cId = '$_GET[id]'");
  }
  
  if ($q){
	   echo "<script>window.alert('Data Terupdate');window.location=('../../home.php?pages=pegawai')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}
?>
