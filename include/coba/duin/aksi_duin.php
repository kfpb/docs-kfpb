<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";
$act=$_GET[act];

// Input Udmasuk
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
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
	 $q=mysql_query("INSERT INTO udokumen(uccnmr,
                                   udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
                                   ujudok,
                                   udstatus1,
                                   udstatus2,
								   udket) 
	                     VALUES('$_POST[nomorcc]',
                                '$_POST[tgl]',
                                '$_POST[pengusul]',
                                '$_POST[pengusul2]',
                                '$_POST[kepada]',
								'$_POST[jenisud]',
								'$_POST[ukodok]',
								'$_POST[revisi]',
								'$_POST[ujudok]',
								'Y',
								'Y',
								'$_POST[udket]')");
								
   $r=mysql_query("UPDATE cdis SET kode3 = 'Y' WHERE pdid = '$_POST[pdid]'");
								
		 if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Terkirim ke SPD-MR');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
} else {
  UploadUdmasuk($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
	
  $q=mysql_query("INSERT INTO udokumen(uccnmr,
                                   udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
                                   ujudok,
								   udket,
								   udstatus1,
								   udstatus2,
								   udfile) 
	                     VALUES('$_POST[nomorcc]',
                                '$_POST[tgl]',
                                '$_POST[pengusul]',
                                '$_POST[pengusul2]',
                                '$_POST[kepada]',
								'$_POST[jenisud]',
								'$_POST[ukodok]',
								'$_POST[revisi]',
								'$_POST[ujudok]',
								'$_POST[udket]',
								'Y',
								'Y',
								'$nama_file_unik')");

  if ($q){
	if($_SESSION[levelcv]==0 OR $_SESSION[cv]==1){
	 echo "<script>window.alert('Data Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Terkirim ke SPD-MR');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
}
}
//update Udmasuk
elseif($act=='edit'){

 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 10 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
$udbhs = $_POST["udbhs"];
  
if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
	
  $q=mysql_query("UPDATE udokumen SET	uccnmr     	= '$_POST[nomorcc]',
										udtgl	 	= '$_POST[tgl]',
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
										udket		= '$_POST[ket]'
										WHERE uid = '$_GET[id]'");
}

else {
	  UploadUdmasuk($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT udfile,uid FROM udokumen WHERE uid='$_GET[id]'"));
	 unlink("../../udmasuk/$data[udfile]"); 
	 
 $q=mysql_query("UPDATE udokumen SET uccnmr     	= '$_POST[nomorcc]',
										udtgl	 	= '$_POST[tgl]',
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
										udket		= '$_POST[ket]',
										udfile	=	'$nama_file_unik'
										WHERE uid = '$_GET[id]'");
							   
}							   
 if ($q){
	if($_SESSION[cv]==81 OR $_SESSION[cv]==1){
	 echo "<script>window.alert('Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

   
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
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
  
  if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Usulan Dokumen Terhapus');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Dihapus');window.location=('../../home.php?pages=usrtd')</script>";
	}
 
}


// acc
elseif ($act=='acc'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$maxsize 		  = 1024 * 15000; // maksimal 15 MB
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

/*
$tgl_sekarang1 = date("Y-m-d");
$thnn			 = date("y");
$blnn			 = date("mm");
$blnn1           = tgl_indo7($tgl_sekarang1);
$jeniscc         = '11';
$query1 = "SELECT max(ccnmr) as max_nom FROM ccinter WHERE ccnmr LIKE '%$blnn1$thnn$jeniscc%'";
$hasil1 = mysql_query($query1);
$hitung1 = mysql_num_rows($hasil1);
$data1  = mysql_fetch_array($hasil1); 
$idMax1 = $data1['max_nom'];
$noUrut1 = (int) substr($idMax1, 7, 3);
$noUrut1++;
$newID1 = sprintf("CC$blnn1$thnn$jeniscc%03s", $noUrut1);
*/

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));

    
$q=mysql_query("UPDATE udokumen  SET udnmr 	 = '$newID', 
                                     udtgl   = '$tgl_sekarang',
                                     udtgl_acc = '$tgl_sekarang',
                                     udkepada = '49',
                                     udstatus2 = 'Y'
								  WHERE uid      = '$_GET[id]'"); 


  if ($q){
	  echo "<script>window.alert('Usulan telah dikirim ke SPD-MR');window.location=('../../home.php?pages=usrtd')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}


// acc MR/MPM
elseif ($act=='acc2'){
$tgl_sekarang = date("Y-m-d");
    $q=mysql_query("UPDATE udokumen SET udtgl_acc	 = '$tgl_sekarang',
                                  udkepada        = '49',
								  ud_comment     = '$_POST[comment0],$_POST[comment]'
								  WHERE uid      = '$_GET[id]'");

  if ($q){
	  echo "<script>window.alert('Sukses di kirim ke SPD');window.location=('../../home.php')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Terkirim');self.history.back();</script>";
  }
}

// Terima usulan MR
elseif ($act=='acc3'){
$tgl_sekarang = date("Y-m-d");
$q=mysql_query("UPDATE udokumen SET udtgl_terima='$tgl_sekarang', udstatus1='Y'  WHERE uid='$_GET[id]'");

  if ($q){
	  echo "<script>window.alert('Sukses diterima SPD-MR');window.location=('../../home.php?pages=usulandok&act=detail&id=$_GET[id]')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Terkirim');self.history.back();</script>";
  }
}

elseif ($act=='selesai2'){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE udokumen SET udtgl_selesai = '$_POST[tgl_selesai]',
										udstatus	= '2'
										WHERE uid = '$_GET[id]'");
							   
							   
 if ($q){
	 echo "<script>window.alert('Usulan Dokumen Selesai, Silahkan Buat Distribusi Dokumen !');window.location=('../../home.php?pages=dinter&act=tambah2&id=$_POST[kode_dok]')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

}
//tambah alur usulan
elseif ($act=='tambahalur'){
  	
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 UploadAlur($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
   
  $q1=mysql_query("INSERT INTO alurusulan(dNoalur,
                                         dPengirim,
								         uid) 
	                     VALUES('$_POST[noalur]',
								'$_POST[Pengirim]',
								'$_GET[uid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO alurusulan(dNoalur,
                                              dPengirim,
								              uid,
										      disfile) 
	                     VALUES('$_POST[noalur]',
								'$_POST[pengirim]',
								'$_GET[uid]',
								'$nama_file_unik')");
  }
	  
  
  $uddis = $_POST["uddis"];
  foreach ($uddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO uddis(pNoalur,ptgl,ptgls,pInstruksi,pSifat,pId,cId,uid,psACC,jawab) 
	VALUES ('$_POST[noalur]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pengirim]','$cid','$_GET[uid]','N','$_POST[jawab]')"); 

 }
  
  if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Alur Usulan Terkirim');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1&&$q2){
	   /*
$tgl_sekarang = date ("Y-m-d");
	  $pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM uddis a WHERE a.uid='$_GET[uid]' AND a.pId='$_POST[Pengirim]' ORDER BY a.pudid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada alurusulan untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada alurusulan untuk anda dari Surat Masuk di aplikasi http://ekfpb.com untuk anda<br>
alurusulan dari : $e[oleh],<br>
Untuk baca alurusulan dan menjawab alurusulan silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Alur Usulan terkirim!');window.location=('../../home.php?pages=usulandok')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  
//tambah alur usulan
}

elseif($act=='editalur'){
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
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
  
  if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Alur Usulan Terkirim');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1&&$q2){
	   /*
$tgl_sekarang = date ("Y-m-d");
	  $pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM uddis a WHERE a.uid='$_GET[uid]' AND a.pId='$_POST[Pengirim]' ORDER BY a.pudid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada alurusulan untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada alurusulan untuk anda dari Surat Masuk di aplikasi http://ekfpb.com untuk anda<br>
alurusulan dari : $e[oleh],<br>
Untuk baca alurusulan dan menjawab alurusulan silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Alur Usulan terkirim!');window.location=('../../home.php?pages=usulandok')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  
//tambah alur usulan
}
//batas dari aksi_alurusulan.php

?>