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

$halamane=$_GET[halamane];
$act=$_GET[act];
// Hapus user
if ($halamane=='kategori' AND $act=='hapus'){
mysql_query("DELETE FROM kategori WHERE id_kategori=$_GET[id]");
header('location:../../index.php?halamane='.$halamane);
}

// Input user
elseif ($halamane=='kategori' AND $act=='input'){
  //buat kategori otomatis
	$query = "select max(id_kategori) as maksi from kategori";
    $hasil = mysql_query($query);
    $data_oto     = mysql_fetch_array($hasil);
	  
	$data_potong = substr($data_oto['maksi'],0,5);
	$data_potong++;
	$kode="";
	for ($i=strlen($data_potong); $i<=1; $i++)
	$kode = $kode."0";
	$kategori_id = "$kode$data_potong";
	
  mysql_query("INSERT INTO kategori(id_kategori,
                                 nama_kategori)
	                       VALUES('$kategori_id',
                                '$_POST[nama_kategori]')");

  header('location:../../index.php?halamane='.$halamane);
 
}


// Update Member
elseif ($halamane=='kategori' AND $act=='update') {
  
    mysql_query("UPDATE kategori SET nama_kategori  = '$_POST[nama_kategori]', blokir='$_POST[blokir]'
								  WHERE id_kategori = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  


}
?>
