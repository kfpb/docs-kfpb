<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input Smasuk
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
  UploadSMasuk($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  $q=mysql_query("INSERT INTO isurat(inmr,
                                   itgl,
                                   ipengirim,
                                   ikepada, 
                                   ikepada2,
                                   iperihal,
								   jenisms,
                                   iket,
								   ifile,
								   istatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
                                '$_POST[kepada]',
                                '$_POST[kepada2]',
								'$_POST[perihal]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'$nama_file_unik',
								'N')");
  if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=suin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrte')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }

}
//update smasuk
elseif($act=='edit'){

 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 10 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
	
  $q=mysql_query("UPDATE isurat SET inmr     	= '$_POST[nomor]',
									itgl	 	= '$_POST[tgl]',
									ipengirim 	= '$_POST[pengirim]',
                                   ikepada	 = '$_POST[kepada]',
                                   ikepada2	 = '$_POST[kepada2]',
                                   iperihal	 = '$_POST[perihal]',
								   jenisms	 = '$_POST[jenisms]',
								   iket		 = '$_POST[ket]',
								   itgl_balas  = '$_POST[tgl_bls]',
								   inmr_bls  = '$_POST[nomor_bls]'
								   WHERE iid = '$_GET[id]'");
}

else {
	  UploadSMasuk($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT ifile,iid FROM isurat WHERE iid='$_GET[id]'"));
	 unlink("../../smasuk/$data[ifile]"); 
	 
 $q=mysql_query("UPDATE isurat SET inmr     	= '$_POST[nomor]',
									itgl	 	= '$_POST[tgl]',
									ipengirim 	= '$_POST[pengirim]',
                                   ikepada	 = '$_POST[kepada]',
                                   ikepada2	 = '$_POST[kepada2]',
                                   iperihal	 = '$_POST[perihal]',
								   jenisms	 = '$_POST[jenisms]',
								   iket		 = '$_POST[ket]',
								   itgl_balas  = '$_POST[tgl_bls]',
								   inmr_bls  = '$_POST[nomor_bls]',
								   ifile	=	'$nama_file_unik'
								   WHERE iid = '$_GET[id]'");
}								   
								   
								   
 if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=suin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrte')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

   }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
  
}
// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT ifile,iid FROM isurat WHERE iid='$_GET[id]'"));
  if ($data['ifile']!=''){
    //hapus juga data dari tabel lain yg berhubungan dengan surat masuk
	 unlink("../../smasuk/$data[ifile]"); 
  }
  
  mysql_query("DELETE FROM isurat WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM disposisi WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM pdis WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM isurat WHERE iid='$_GET[id]'");
  
  if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=suin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrte')</script>";
	}
 
}

//tambah disp
elseif ($act=='tambahdisp'){
  	
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  $now = date("H:i");		
  
 UploadDisp($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
   
  $q1=mysql_query("INSERT INTO disposisi(dNoagenda,
                                         dPendisposisi,
								         iid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[iid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO disposisi(dNoagenda,
                                         dPendisposisi,
								         iid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[iid]',
								'$nama_file_unik')");
  }
	  
  
  $pdis = $_POST["pdis"];
  foreach ($pdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO pdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pId,cId,iid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[iid]','N','$_POST[jawab]')"); 

 }
  
  if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=suin')</script>";
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
					FROM pdis a WHERE a.iid='$_GET[iid]' AND a.pId='$_POST[pendisposisi]' ORDER BY a.pdid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Surat Masuk di aplikasi http://ekfpb.com untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php?pages=usrte')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  
//tambah disp
}
elseif($act=='editdisp'){
  $now = date("H:i");							
  $pdis = $_POST["pdis"];
  foreach ($pdis as $x=>$cid)
  {
	$q1=mysql_query("INSERT INTO pdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pId,cId,iid,psACC,jawab,kode) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[iid]','N','$_POST[jawab]','$now')"); 

	}
  if($_SESSION[levelcv]==0){
  if ($q1){
	  	    
	  echo "<script>window.alert('Disposisi terkirim');window.location=('../../home.php?pages=suin')</script>";
  }else{
	  echo "<script>window.alert('Disposisi Gagal Terkirim');self.history.back();</script>";
  }
  }
  else {
   if ($q1){
       /*
	 	  $tgl_sekarang = date ("Y-m-d");
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM pdis a WHERE a.iid='$_GET[iid]' AND a.pId='$_POST[pendisposisi]' AND a.kode='$now' ORDER BY a.pdid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Surat Masuk di aplikasi http://ekfpb.com untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php?pages=usrte')</script>";
	 
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
//batas dari aksi_disposisi.php

?>