<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input users
if ($act=='tambah'){
  $pass = md5($_POST['pass']);
  
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $foto = $acak.$nama_file; 
  
  if (!empty($lokasi_file)){
	UploadFoto($foto);
	$q=mysql_query("INSERT INTO users(cUser,
									cNama,
									cJabatan,
									cIdjab,
									cAtasan,
									cAccatasan,
									cAudit
									cTelp, 
									cEmail,
									cEmail2,
									cFoto,
									cPass,
									idj,
									bagian) 
							VALUES('$_POST[user]',
									'$_POST[nama]',
									'$_POST[nama_jabatan]',
									'$_POST[id_jabatan]',
									'$_POST[atasan]',
									'$_POST[acc_atasan]',
									'$_POST[audit]',
									'$_POST[telp]',
									'$_POST[email]',
									'$_POST[email2]',
									'$foto',
									'$pass',
									'$_POST[jabatan]',
									'$_POST[singkatan_bagian]')");
  }else{
	$q=mysql_query("INSERT INTO users(cUser,
									cNama,
									cJabatan,
									cIdjab,
									cAtasan,
									cAccatasan,
									cAudit,
									cTelp, 
									cEmail,
									cEmail2,
									cPass,
									idj,
									bagian) 
							VALUES('$_POST[user]',
									'$_POST[nama]',
									'$_POST[nama_jabatan]',
									'$_POST[id_jabatan]',
									'$_POST[atasan]',
									'$_POST[acc_atasan]',
									'$_POST[audit]',
									'$_POST[telp]',
									'$_POST[email]',
									'$_POST[email2]',
									'$pass',
									'$_POST[jabatan]',
									'$_POST[singkatan_bagian]'
									)");
	}
  if ($q){
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=users')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
}
// hapus users
elseif ($act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT cFoto FROM users WHERE cId='$_GET[id]'"));
  if ($data['cFoto']!=''){
    //hapus file foto
	 unlink("../../foto/$data[cFoto]"); 
  }
  mysql_query("DELETE FROM users WHERE cId='$_GET[id]'");
  echo "<script>window.location=('../../home.php?pages=users')</script>"; 
}
// edit users
elseif ($act=='edit'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $foto = $acak.$nama_file; 

if ($_SESSION[levelcv]==0){
  //jika data diupdate ubahfoto=0 dan ubahpassword=0
  if ((empty($lokasi_file)) && ($_POST['pass']=="")){
	$q=mysql_query("UPDATE users SET cUser    = '$_POST[user]',
                                   cNama     = '$_POST[nama]',
                                   cJabatan	 = '$_POST[nama_jabatan]',  
                                   cIdjab	 = '$_POST[idjab]',  
                                   cAtasan	 = '$_POST[atasan]',  
                                   cAccatasan= '$_POST[accatasan]',  
                                   cAudit= '$_POST[audit]',  
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   idj		 = '$_POST[jabatan]'
								   WHERE cId = '$_GET[id]'");
	
  }
  //jika data diupdate ubahfoto=1 dan ubahpassword=0
  elseif((!empty($lokasi_file)) && ($_POST['pass']=="")){
	$data=mysql_fetch_array(mysql_query("SELECT cFoto FROM users WHERE cId='$_GET[id]'"));
	if ($data['cFoto']!=''){
		//hapus foto
		unlink("../../foto/$data[cFoto]"); 
	}
	UploadFoto($foto);
	$q=mysql_query("UPDATE users SET cUser    = '$_POST[user]',
                                   cNama     = '$_POST[nama]',
                                   cJabatan	 = '$_POST[nama_jabatan]',
                                   cIdjab	 = '$_POST[idjab]',  
                                   cAtasan	 = '$_POST[atasan]',  
                                   cAccatasan= '$_POST[accatasan]',  
                                   cAudit= '$_POST[audit]',  
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   cFoto	 = '$foto',
								   idj		 = '$_POST[jabatan]'
								   WHERE cId = '$_GET[id]'");
  }
  //jika data diupdate ubahfoto=0 dan ubahpassword=1
  elseif((empty($lokasi_file)) && ($_POST['pass']!="")){
	$pass = md5($_POST['pass']);
	$q=mysql_query("UPDATE users SET cUser    = '$_POST[user]',
                                   cNama     = '$_POST[nama]',
                                   cJabatan	 = '$_POST[nama_jabatan]',
                                   cIdjab	 = '$_POST[idjab]',  
                                   cAtasan	 = '$_POST[atasan]',    
                                   cAccatasan= '$_POST[accatasan]',
                                   cAudit= '$_POST[audit]',  
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   cPass	 = '$pass',
								   idj		 = '$_POST[jabatan]'
								   WHERE cId = '$_GET[id]'");
  }
  //jika data diupdate ubahfoto=1 dan ubahpassword=1
  else{
	$pass = md5($_POST['pass']);
	$data=mysql_fetch_array(mysql_query("SELECT cFoto FROM users WHERE cId='$_GET[id]'"));
	if ($data['cFoto']!=''){
		//hapus foto
		unlink("../../foto/$data[cFoto]"); 
	}
	UploadFoto($foto);
	$q=mysql_query("UPDATE users SET cUser    = '$_POST[user]',
                                   cNama     = '$_POST[nama]',
                                   cJabatan	 = '$_POST[nama_jabatan]',
                                   cIdjab	 = '$_POST[idjab]',  
                                   cAtasan	 = '$_POST[atasan]',  
                                   cAccatasan= '$_POST[accatasan]', 
                                   cAudit= '$_POST[audit]',  
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   cPass	 = '$pass',
								   cFoto	 = '$foto',
								   idj		 = '$_POST[jabatan]'
								   WHERE cId = '$_GET[id]'");  
  }
}
else {
  //jika data diupdate ubahfoto=0 dan ubahpassword=0
  if ((empty($lokasi_file)) && ($_POST['pass']=="")){
	$q=mysql_query("UPDATE users SET cNama     = '$_POST[nama]',
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]'
								   WHERE cId = '$_GET[id]'");
	
  }
  //jika data diupdate ubahfoto=1 dan ubahpassword=0
  elseif((!empty($lokasi_file)) && ($_POST['pass']=="")){
	$data=mysql_fetch_array(mysql_query("SELECT cFoto FROM users WHERE cId='$_GET[id]'"));
	if ($data['cFoto']!=''){
		//hapus foto
		unlink("../../foto/$data[cFoto]"); 
	}
	UploadFoto($foto);
	$q=mysql_query("UPDATE users SET cUser    = '$_POST[user]',
                                   cNama     = '$_POST[nama]',
                                   cJabatan	 = '$_POST[nama_jabatan]',
                                   cIdjab	 = '$_POST[idjab]',  
                                   cAtasan	 = '$_POST[atasan]',  
                                   cAccatasan= '$_POST[accatasan]',
                                   cAudit= '$_POST[audit]',  
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   cFoto	 = '$foto',
								   idj		 = '$_POST[jabatan]'
								   WHERE cId = '$_GET[id]'");  
  }
  //jika data diupdate ubahfoto=0 dan ubahpassword=1
  elseif((empty($lokasi_file)) && ($_POST['pass']!="")){
	$pass = md5($_POST['pass']);
	$q=mysql_query("UPDATE users SET cNama     = '$_POST[nama]',					   
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   cPass	 = '$pass'
								   WHERE cId = '$_GET[id]'");
  }
  //jika data diupdate ubahfoto=1 dan ubahpassword=1
  else{
	$pass = md5($_POST['pass']);
	$data=mysql_fetch_array(mysql_query("SELECT cFoto FROM users WHERE cId='$_GET[id]'"));
	if ($data['cFoto']!=''){
		//hapus foto
		unlink("../../foto/$data[cFoto]"); 
	}
	UploadFoto($foto);
	$q=mysql_query("UPDATE users SET cNama     = '$_POST[nama]',
                                   cTelp	 = '$_POST[telp]', 
                                   cEmail	 = '$_POST[email]',
								   cEmail2	 = '$_POST[email2]',
								   cPass	 = '$pass',
								   cFoto	 = '$foto'
								   WHERE cId = '$_GET[id]'");  
  }
}
  
  if ($q){
	if($_SESSION[levelcv]!=0){
	   echo "<script>window.alert('Data Terupdate');window.location=('../../home.php?pages=home')</script>";
	}else{
	   echo "<script>window.alert('Data Terupdate');window.location=('../../home.php?pages=users')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}
?>
