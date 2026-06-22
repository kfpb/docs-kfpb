<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/fungsi_thumb_luar.php";
include "../../config/library.php";

$halamane=$_GET[halamane];
$act=$_GET[act];
// Hapus user
if ($halamane=='member' AND $act=='hapus'){
mysql_query("DELETE FROM member WHERE username=$_GET[id]");
header('location:../../index.php?halamane='.$halamane);
}

// Input user
elseif ($halamane=='member' AND $act=='input'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $password=md5($_POST[password]);
// Apabila ada foto yang diupload
if (!empty($lokasi_file)){
    UploadMember($nama_file_unik);
   mysql_query("INSERT INTO member(password,nama_lengkap,hp,email,foto,tanggal) 
	                       VALUES('$password','$_POST[nama_lengkap]','$_POST[hp]','$_POST[email]','$nama_file_unik','$tgl_sekarang')");
 }
 else{
  mysql_query("INSERT INTO member(password,nama_lengkap,hp,email,tanggal) 
                         VALUES('$password','$_POST[nama_lengkap]','$_POST[hp]','$_POST[email]','$tgl_sekarang')");
 }

  header('location:../../index.php?halamane='.$halamane);
 
}




// Update Member
elseif ($halamane=='member' AND $act=='update') {
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila foto tidak diganti
  if($_POST[password]!=''){
  $pass=md5($_POST[password]);
  if (empty($lokasi_file)){
   mysql_query("UPDATE member set  password       ='$pass',
                                   nama_lengkap   ='$_POST[nama_lengkap]',
                                   hp             ='$_POST[hp]',
                                   email          ='$_POST[email]'
                                   WHERE username='$_POST[id]'");

header('location:../../index.php?halamane='.$halamane);
  }
  
  
  
  // Apabila password diubah
  else{
  $data_foto = mysql_query("SELECT foto FROM member WHERE username='$_POST[id]'");
  $r      = mysql_fetch_array($data_foto);
  @unlink('../../foto_user/'.$r['foto']);
  @unlink('../../foto_user/'.'small_'.$r['foto']);
    UploadMemberDiAdmin($nama_file_unik ,'foto_user/');
    mysql_query("UPDATE member set password       ='$pass',
                                   nama_lengkap   ='$_POST[nama_lengkap]',
                                   email          ='$_POST[email]',
                                   foto           ='$nama_file_unik'
                                   WHERE username='$_POST[id]'");
  }
  } else {
  if (empty($lokasi_file)){
  mysql_query("UPDATE member set   nama_lengkap   ='$_POST[nama_lengkap]',
                                   hp             ='$_POST[hp]',
                                   email          ='$_POST[email]'
                                   WHERE username='$_POST[id]'");
  
header('location:../../index.php?halamane='.$halamane);
  }
  // Apabila password diubah
  else{
  $data_foto = mysql_query("SELECT foto FROM member WHERE username='$_POST[id]'");
  $r      = mysql_fetch_array($data_foto);
  @unlink('../../foto_user/'.$r['foto']);
  @unlink('../../foto_user/'.'small_'.$r['foto']);
    UploadMemberDiAdmin($nama_file_unik ,'foto_user/');
    mysql_query("UPDATE member set nama_lengkap   ='$_POST[nama_lengkap]',
                                   hp             ='$_POST[hp]',
                                   email          ='$_POST[email]',
                                   foto           ='$nama_file_unik'
                                   WHERE username='$_POST[id]'");
  }
  }
  header('location:../../index.php?halamane='.$halamane);
  
}
}
?>
