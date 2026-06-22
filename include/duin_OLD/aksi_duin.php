<?php
require_once "../cek_sesi.php";
if(!isset($_SESSION))
    {
        session_start();
    }
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";
$act=$_GET['act'];

// Input Udmasuk
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
 
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("UD-%04s/$bln", $noUrut);
 
if (empty($lokasi_file)){
	 $q=mysql_query("INSERT INTO udokumen(udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
                                   ujudok,
								   udket,
								   uccnmr) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengusul]',
                                '$_POST[pengusul2]',
                                '$_POST[kepada]',
								'$_POST[jenisud]',
								'$_POST[ukodok]',
								'$_POST[revisi]',
								'$_POST[ujudok]',
								'$_POST[udket]',
								'$_POST[uccnmr]')");
								
		 if ($q){
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	 echo "<script>window.alert('Data Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Tersimpan untuk dikirim');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
} else {
  UploadUdmasuk($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
	
  $q=mysql_query("INSERT INTO udokumen(udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
                                   ujudok,
								   udket,
								   uccnmr,
								   udfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengusul]',
                                '$_POST[pengusul2]',
                                '$_POST[kepada]',
								'$_POST[jenisud]',
								'$_POST[ukodok]',
								'$_POST[revisi]',
								'$_POST[ujudok]',
								'$_POST[udket]',
								'$_POST[uccnmr]',
								'$nama_file_unik')");

  if ($q){
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	 echo "<script>window.alert('Data Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Tersimpan untuk dikirim');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
}
}
//update Udmasuk
elseif($act=='edit'){

 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 10 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
$udbhs = $_POST["udbhs"];
  
if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
	
  $q=mysql_query("UPDATE udokumen SET	udtgl	 	= '$_POST[tgl]',
										udtgl_selesai = '$_POST[tgl_selesai]',
										udtgl_terima = '$_POST[tgl_terima]',
										udtgl_bahas = '$_POST[tgl_bahas]',
										ud_bahas_oleh = '$_POST[udbhs]',
										udpengusul 	= '$_POST[pengusul]',
										udstatus	= '$_POST[statusud]',
										jenisud	 	= '$_POST[jenisud]',
										udkepada    = '$_POST[udkepada]',
										ukodok	 	= '$_POST[ukodok]',
										udrev	 	= '$_POST[revisi]',
										ujudok	 	= '$_POST[ujudok]',
										udnmr      = '$_POST[udnmr]',
										uccnmr      = '$_POST[uccnmr]',
										udket		= '$_POST[ket]'
										WHERE uid = '$_GET[id]'");
}

else {
    
UploadUdmasuk($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT udfile,uid FROM udokumen WHERE uid='$_GET[id]'"));
	 unlink("../../udmasuk/$data[udfile]"); 
	 
 $q=mysql_query("UPDATE udokumen SET    udtgl	 	= '$_POST[tgl]',
										udtgl_selesai = '$_POST[tgl_selesai]',
										udtgl_terima = '$_POST[tgl_terima]',
										udtgl_bahas = '$_POST[tgl_bahas]',	
										ud_bahas_oleh = '$_POST[udbhs]',
										udpengusul 	= '$_POST[pengusul]',
										udstatus	= '$_POST[statusud]',
										jenisud	 	= '$_POST[jenisud]',
										udkepada    = '$_POST[udkepada]',
										ukodok	 	= '$_POST[ukodok]',
										udrev	 	= '$_POST[revisi]',
										ujudok	 	= '$_POST[ujudok]',
										udnmr      = '$_POST[udnmr]',
										uccnmr      = '$_POST[uccnmr]',
										udket		= '$_POST[ket]',
										udfile	=	'$nama_file_unik'
										WHERE uid = '$_GET[id]'");
							   
}							   
 if ($q){
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	 echo "<script>window.alert('Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

   
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
  
}
// hapus Udmasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT udfile,uid FROM udokumen WHERE uid='$_GET[id]'"));
  if ($data['udfile']!=''){
    //hapus juga data dari tabel lain yg berhubungan dengan surat masuk
	 unlink("../../udmasuk/$data[udfile]"); 
  }
  
  mysql_query("DELETE FROM udokumen WHERE uid='$_GET[id]'");
  mysql_query("DELETE FROM alurusulan WHERE uid='$_GET[id]'");
  mysql_query("DELETE FROM uddis WHERE uid='$_GET[id]'");
  
  if($_SESSION[cv]==0){
	 echo "<script>window.alert('Usulan Dokumen Terhapus');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Dihapus');window.location=('../../home.php?pages=usrtd')</script>";
	}
 
}


// acc
elseif ($act=='acc'){

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$maxsize 		  = 1024 * 25000; // maksimal 25 MB
$size_file	  = $_FILES['fupload']['size']<=$maxsize;
$acak           = rand(1,99);
$bln_sekarang = date("y-m.");
$nama_file_unik = $bln_sekarang.$acak.$nama_file;  

if ($e[jenisud]=1){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%B$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("B$bln-$thn/$f[bagian]%03s", $noUrut);
}
elseif ($e[jenisud]=2){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%R$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("R$bln-$thn/$f[bagian]%03s", $noUrut);
}
elseif ($e[jenisud]=3){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%O$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("O$bln-$thn/$f[bagian]%03s", $noUrut);
}


if ($e[uccnmr]=='') {
    
    $q=mysql_query("UPDATE udokumen  SET udnmr 	 = '$newID',
								  udtgl	         = '$tgl_sekarang',
								  udstatus2      = 'Y'
								  WHERE uid      = '$_GET[id]'");
}	

else {
    
    $q=mysql_query("UPDATE udokumen  SET udnmr 	 = '$newID',
								  udtgl	         = '$tgl_sekarang',
								  ukepada        = '2',
								  udtgl_acc      = '$tgl_sekarang',
								  udstatus2      = 'Y'
								  WHERE uid      = '$_GET[id]'"); 
}

	

  if ($q){
	  echo "<script>window.alert('Usulan telah dikirim ke MR');window.location=('../../home.php?pages=usrtd')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}


// acc MR/MPM (tidak dipakai)
elseif ($act=='acc2'){
$tgl_sekarang = date("Y-m-d");
    $q=mysql_query("UPDATE udokumen SET udtgl_acc	 = '$tgl_sekarang',
                                  udkepada        = '2',
								  ud_comment     = '$_POST[comment0],$_POST[comment]'
								  WHERE uid      = '$_GET[id]'");

  if ($q){
	  echo "<script>window.alert('Sukses di kirim ke MR');window.location=('../../home.php')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Terkirim');self.history.back();</script>";
  }
}

elseif ($act=='selesai2'){
$tgl			 = date("Y-m-d");
$q=mysql_query("UPDATE udokumen SET udtgl_selesai = '$_POST[tgl_selesai]',
									udstatus	= '2'
									WHERE uid = '$_GET[id]'");

if ($_POST[jenisud]==1){

$r=mysql_query("INSERT INTO dinter(dipengirim,
                                   dikodok,
								   direv,
								   dijudok,
								   jenisdok,
								   jenis,
								   ditgl_brlk,
								   ditgl_review,
                                   dipjdok,
                                   ditgl_rev0,
								   distatus) 
	                     VALUES('2',
								'$_POST[kode_dok]',
								'$_POST[revisi]',
								'$_POST[judul_dok]',
								'$_POST[jenisdok]',
								'$_POST[jenis]',
								'$_POST[tgl_berlaku]',
								'$_POST[tgl_review]',
								'$_POST[pjdok]',
								'$_POST[tgl_berlaku]',
								'Y')");
}
elseif ($_POST[jenisud]==2){

$ditgl = "ditgl_rev";
$dipost = $_POST[revisi];
$di  = $ditgl.$dipost;

$r=mysql_query("UPDATE dinter SET  jenisdok	 = '$_POST[jenisdok]',
                                   dipjdok = '$_POST[pjdok]',
                                   jenis = '$_POST[jenis]',
                                   dikodok = '$_POST[kode_dok]',
								   direv = '$_POST[revisi]',
								   dijudok = '$_POST[judul_dok]',
								   ditgl_brlk = '$_POST[tgl_berlaku]',
								   ditgl_review = '$_POST[tgl_review]',
								   $di = '$_POST[tgl_berlaku]'
								   WHERE dikodok = '$_POST[kode_dok]'");

}

elseif ($_POST[jenisud]==3){

$r=mysql_query("UPDATE dinter SET  distatus	 = 'N',
								   dijudok = '$_POST[judul_dok] (OBSOLETE)'
								   WHERE dikodok = '$_POST[kode_dok]'");
}

							   
							   
 if ($q){
	 echo "<script>window.alert('Usulan Dokumen Selesai & Tersimpan, Silahkan Buat Distribusi Dokumen !');window.location=('../../home.php?pages=dister&act=tambah2&id=$_POST[kode_dok]')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

}
//tambah alur usulan
elseif ($act=='tambahalur'){
  	
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 UploadAlur($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
   
  $q1=mysql_query("INSERT INTO alurusulan (dNoalur,dPengirim,uid) 
	                     VALUES('$_POST[noalur]','$_POST[pengirim]','$_GET[uid]')");
  }
  else {
      
   $q1=mysql_query("INSERT INTO alurusulan (dNoalur,dPengirim,uid,disfile) 
	                     VALUES('$_POST[noalur]','$_POST[pengirim]','$_GET[uid]','$nama_file_unik')");
	
  }
	  
 
  $uddis = $_POST["uddis"];
  foreach ($uddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO uddis(pNoalur,ptgl,ptgls,pInstruksi,pSifat,pId,cId,uid,psACC,jawab) 
	VALUES ('$_POST[noalur]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pengirim]','$cid','$_GET[uid]','N','$_POST[jawab]')"); 

 }

  if($_SESSION[cv]==0){
  if ($q1){
	  	    
	  echo "<script>window.alert('Data Alur Usulan Terkirim');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1){
	
  echo "<script>window.alert('Alur Usulan terkirim!');window.location=('../../home.php?pages=usulandok')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  
//tambah alur usulan
}

elseif($act=='editalur'){
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 UploadAlur($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  }
  else {
$data=mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE uid='$_GET[uid]'")); 
 $q1=mysql_query("UPDATE alurusulan SET  disfile	=	'$nama_file_unik'
										WHERE uid = '$_GET[uid]'");
										

  }
	  
  
  $uddis = $_POST["uddis"];
  foreach ($uddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO uddis(pNoalur,ptgl,ptgls,pInstruksi,pSifat,pId,cId,uid,psACC,jawab) 
	VALUES ('$_POST[noalur]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pengirim]','$cid','$_GET[uid]','N','$_POST[jawab]')"); 

 }
  
  if($_SESSION[cv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Alur Usulan Terkirim');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1&&$q2){

  echo "<script>window.alert('Alur Usulan terkirim!');window.location=('../../home.php?pages=usulandok')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  
//tambah alur usulan
}
//batas dari aksi_alurusulan.php

?>