<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input Sumber CAPA
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
  UploadSCAPA($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  $q=mysql_query("INSERT INTO icapa(icnmr,
                                   ictgl,
                                   idari,
                                   ickepada, 
                                   icperihal,
								   jeniscapa,
                                   icket,
								   icfile,
								   icstatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[dari]',
                                '$_POST[kepada]',
								'$_POST[perihal]',
								'$_POST[jeniscapa]',
								'$_POST[ket]',
								'$nama_file_unik',
								'N')");
  if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=scapa')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrcapa')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }

}
//update scapa
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
	
  $q=mysql_query("UPDATE icapa SET icnmr     	= '$_POST[nomor]',
								   ictgl	 	= '$_POST[tgl]',
								   idari 	= '$_POST[dari]',
                                   ickepada	 = '$_POST[kepada]',
                                   icperihal	 = '$_POST[perihal]',
								   jeniscapa	 = '$_POST[jeniscapa]',
								   icket		 = '$_POST[ket]'
								   WHERE icid = '$_GET[id]'");
}

else {
	  UploadSCAPA($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT icfile,icid FROM icapa WHERE icid='$_GET[id]'"));
	 unlink("../../scapa/$data[icfile]"); 
	 
 $q=mysql_query("UPDATE icapa SET icnmr     	= '$_POST[nomor]',
									ictgl	 	= '$_POST[tgl]',
									idari 	= '$_POST[dari]',
                                   ickepada	 = '$_POST[kepada]',
                                   icperihal	 = '$_POST[perihal]',
								   jeniscapa	 = '$_POST[jeniscapa]',
								   icket		 = '$_POST[ket]',
								   icfile	=	'$nama_file_unik'
								   WHERE icid = '$_GET[id]'");
}								   
								   
								   
 if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=scapa')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrcapa')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

   }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
  
}
// hapus scapa
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT icfile,icid FROM icapa WHERE icid='$_GET[id]'"));
  if ($data['icfile']!=''){
    //hapus juga data dari tabel lain yg berhubungan dengan surat masuk
	 unlink("../../scapa/$data[icfile]"); 
  }
  
  mysql_query("DELETE FROM icapa WHERE icid='$_GET[id]'");
  mysql_query("DELETE FROM ucapa WHERE icid='$_GET[id]'");
  mysql_query("DELETE FROM pcapa WHERE icid='$_GET[id]'");
  mysql_query("DELETE FROM icapa WHERE icid='$_GET[id]'");
  
  if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=scapa')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrcapa')</script>";
	}
 
}
//tambah capa
elseif ($act=='tambahcapa'){
   $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  


 UploadCAPA($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO ucapa(dNo,
                                     dPembuat,
								     icid) 
						VALUES('$_POST[nocapa]',
							   '$_POST[dari]',
							   '$_GET[icid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO ucapa(dNo,
                                         dPembuat,
								         icid,
										 disfile) 
	                     VALUES('$_POST[nocapa]',
								'$_POST[dari]',
								'$_GET[icid]',
								'$nama_file_unik')");
  } 
	
  $pcapa = $_POST["pcapa"];
  foreach ($pcapa as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO pcapa(pNcapa,pctgl,pctgls,pTujuan,pSifat,pId,cId,icid,psACC) 
	VALUES ('$_POST[nocapa]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[dari]','$cid','$_GET[icid]','N')"); 

 }
  
  if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=scapa')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1&&$q2){
$tgl_sekarang = date ("Y-m-d");
	  $pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM pcapa a WHERE a.icid='$_GET[icid]' AND a.pId='$_POST[dari]' ORDER BY a.pdid DESC");

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

  echo "<script>window.alert('CAPA terkirim ke user!');window.location=('../../home.php')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal');self.history.back();</script>";
  } 
  }
  
//tambah capa
}
//tambah improve
elseif ($act=='tambahcapa2'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  


 UploadCAPA($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO ucapa(dNo,
                                         dPembuat,
								         icid) 
						VALUES('$_POST[nocapa]',
								'$_POST[dari]',
								'$_GET[icid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO ucapa(dNo,
                                         dPembuat,
								         icid,
										 disfile) 
	                     VALUES('$_POST[nocapa]',
								'$_POST[dari]',
								'$_GET[icid]',
								'$nama_file_unik')");
  } 
	
	$q2=mysql_query("INSERT INTO pcapa(pNcapa,pctgl,pctgls,pTujuan,pSifat,pId,cId,icid,psACC) 
	VALUES ('$_POST[nocapa]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[dari]','$_POST[dari]','$_GET[icid]','N')"); 


  
  
  if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=scapa')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1&&$q2){
$tgl_sekarang = date ("Y-m-d");
	  $pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM pcapa a WHERE a.icid='$_GET[icid]' AND a.pId='$_POST[dari]' ORDER BY a.pdid DESC");

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

  echo "<script>window.alert('CAPA terkirim ke user!');window.location=('../../home.php')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal');self.history.back();</script>";
  } 
  }
  
//tambah disp
}
elseif($act=='editcapa'){
  $now = date("H:i");							
  $pcapa = $_POST["pcapa"];
  foreach ($pcapa as $x=>$cid)
  {
	$q1=mysql_query("INSERT INTO pcapa(pnocapa,ptgl,ptgls,pInstruksi,pSifat,pid,cId,icid,psACC,kode) 
	VALUES ('$_POST[nocapa]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[dari]','$cid','$_GET[icid]','N','$now')"); 

	}
  if($_SESSION[levelcv]==0){
  if ($q1){
	  	    
	  echo "<script>window.alert('Disposisi terkirim');window.location=('../../home.php?pages=scapa')</script>";
  }else{
	  echo "<script>window.alert('Disposisi Gagal Terkirim');self.history.back();</script>";
  }
  }
  else {
   if ($q1){
	 	  $tgl_sekarang = date ("Y-m-d");
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM pcapa a WHERE a.icid='$_GET[icid]' AND a.pId='$_POST[dari]' AND a.kode='$now' ORDER BY a.pdid DESC");

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
  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php')</script>";
	 
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
//batas dari aksi_disposisi.php

?>