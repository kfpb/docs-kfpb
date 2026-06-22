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
  $q=mysql_query("INSERT INTO remind(inmr,
                                   itgl,
                                   ipengirim,
                                   ikepada, 
                                   iperihal,
								   jenisms,
                                   iket,
								   ifile,
								   istatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
                                '$_POST[kepada]',
								'$_POST[perihal]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'$nama_file_unik',
								'N')");
  if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=ruin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrrm')</script>";
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
	
  $q=mysql_query("UPDATE remind SET inmr     	= '$_POST[nomor]',
									itgl	 	= '$_POST[tgl]',
									ipengirim 	= '$_POST[pengirim]',
                                   ikepada	 = '$_POST[kepada]',
                                   iperihal	 = '$_POST[perihal]',
								   jenisms	 = '$_POST[jenisms]',
								   iket		 = '$_POST[ket]',
								   itgl_balas  = '$_POST[tgl_bls]',
								   inmr_bls  = '$_POST[nomor_bls]'
								   WHERE iid = '$_GET[id]'");
}

else {
	  UploadSMasuk($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT ifile,iid FROM remind WHERE iid='$_GET[id]'"));
	 unlink("../../smasuk/$data[ifile]"); 
	 
 $q=mysql_query("UPDATE remind SET inmr     	= '$_POST[nomor]',
									itgl	 	= '$_POST[tgl]',
									ipengirim 	= '$_POST[pengirim]',
                                   ikepada	 = '$_POST[kepada]',
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
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=ruin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrrm')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

   }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
  
}
//update reminder
elseif($act=='editt'){

$q=mysql_query("UPDATE premind SET ptgl   = '$_POST[ptgl]',
                                   ptglm   = '$_POST[ptglm]',
                                   ptgls   = '$_POST[ptgls]',
                                   psTglbaca  = '$_POST[tglbaca]',
                                   psTglselesai = '$_POST[tglslesai]',
                                   psACC         = '$_POST[acc]',
                                   pJudul        = '$_POST[judul]',
                                   pInstruksi  = '$_POST[instruksi]',
								   info =   '$_POST[info]'
                         
								   WHERE pdid = '$_GET[id]'");
								   
 $cc = mysql_fetch_array(mysql_query("SELECT * FROM premind WHERE pdid='$_GET[id]'"));
 
  if ($q2){
	  	    
	  echo "<script>window.alert('Reminder Sukses di Edit');window.location=('../../home.php?pages=ruin&act=detail&id=$cc[iid]')</script>";
  }else{
	 echo "<script>window.alert('Reminder di edit');window.location=('../../home.php?pages=ruin&act=detail&id=$cc[iid]')</script>";
  }
  
 
}
// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT ifile,iid FROM remind WHERE iid='$_GET[id]'"));
  if ($data['ifile']!=''){
    //hapus juga data dari tabel lain yg berhubungan dengan surat masuk
	 unlink("../../smasuk/$data[ifile]"); 
  }
  
  mysql_query("DELETE FROM remind WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM reminder2 WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM premind WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM remind WHERE iid='$_GET[id]'");
  
  if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=ruin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrrm')</script>";
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

 UploadDisp($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
   
  $q1=mysql_query("INSERT INTO reminder2(dNoagenda,
                                         dPendisposisi,
								         iid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[iid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO reminder2(dNoagenda,
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
      $tgl_mulai= new DateTime("$_POST[tglm]");
      $tgl_selesai = new DateTime("$_POST[tgls]");
      $d = $tgl_selesai->diff($tgl_mulai)->days + 1;
      
if ($d>365){
$tgl1 = $_POST[tgls];// pendefinisian tanggal awal
$tgl2 = date('Y-m-d', strtotime('-6 month', strtotime($tgl1))); 
$subjek=6;
}
else {
$tgl1 = $_POST[tgls];// pendefinisian tanggal awal
$tgl2 = date('Y-m-d', strtotime('-2 month', strtotime($tgl1)));   
$subjek=2;
}

$pds = mysql_query("SELECT * FROM users WHERE cId='$cid'");
$e=mysql_fetch_array($pds);
$z=mysql_query("INSERT INTO whatsapp (tgl,kepada,nomor,subjek,isi_whatsapp,status)
	                     VALUES('$tgl2',
                                '$e[cNama]',
                                '$e[cTelp]',
								'$subjek',
								'Bismillah. Yth. $e[cNama], Ada Reminder untuk anda terkait masa berlaku akan habis tanggal $_POST[tgls], yaitu : $_POST[judul]. (Pesan Otomatis dari Admin e-KFPB)',
								'$subjek')");
       
	$q2=mysql_query("INSERT INTO premind(pNoagenda,ptgl,ptglm,ptgls,pJudul,pInstruksi,pSifat,pId,cId,iid,psACC,jawab,kode) 
	VALUES ('$_POST[noagenda]','$_POST[tgl]','$_POST[tglm]','$_POST[tgls]','$_POST[judul]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[iid]','N','$_POST[jawab]','$d')"); 

 }
  
  if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=ruin')</script>";
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
  echo "<script>window.alert('Reminder tersimpan!');window.location=('../../home.php?pages=usrrm')</script>";	  	
	  
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
/*
	$q1=mysql_query("INSERT INTO premind(pNoagenda) 
	VALUES ('$_POST[noagenda]')"); 
*/

  $now = date("H:i");							
  $pdis = $_POST["pdis"];
  foreach ($pdis as $x=>$cid)
  {
$q1=mysql_query("INSERT INTO premind(pNoagenda,ptgl,ptglm,ptgls,pJudul,pInstruksi,pSifat,pId,cId,iid,psACC,kode,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tgl]','$_POST[tglm]','$_POST[tgls]','$_POST[judul]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[iid]','N','$now','$_POST[jawab]')"); 
	}


  if ($q1){
	  	    
	  echo "<script>window.alert('Reminder tersimpan');window.location=('../../home.php?pages=usrrm')</script>";
  }else{
	  echo "<script>window.alert('Reminder gagal tersimpan');self.history.back();</script>";
  }

}
//batas dari aksi_disposisi.php

?>