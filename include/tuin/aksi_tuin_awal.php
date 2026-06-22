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
  $maxsize 		  = 1024 * 20000; // maksimal 20 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
  UploadSMasuk($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  $q=mysql_query("INSERT INTO tsurat(inmr,
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
								 12,
								'$_POST[ket]',
								'$nama_file_unik',
								'N')");
  if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=tuin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrtl')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 20 MB..!');self.history.back();</script>";
  }

}
//update smasuk
elseif($act=='edit'){

 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 20000; // maksimal 20 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  

if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
  $q=mysql_query("UPDATE tsurat SET inmr     	= '$_POST[nomor]',
									itgl	 	= '$_POST[tgl]',
									ipengirim 	= '$_POST[pengirim]',
                                   ikepada	 = '$_POST[kepada]',
                                   iperihal	 = '$_POST[perihal]',
								   jenisms	 = '12',
								   istatus2  = '$_POST[statusku]',
								   iket		 = '$_POST[ket]'
								   WHERE iid = '$_GET[id]'");
}
								   
else {
   UploadSMasuk($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT ifile,iid FROM tsurat WHERE iid='$_GET[id]'"));
unlink("../../smasuk/$data[ifile]"); 
						
						$q=mysql_query("UPDATE tsurat SET inmr     	= '$_POST[nomor]',
									itgl	 	= '$_POST[tgl]',
									ipengirim 	= '$_POST[pengirim]',
                                   ikepada	 = '$_POST[kepada]',
                                   iperihal	 = '$_POST[perihal]',
								   jenisms	 = '12',
								   istatus2  = '$_POST[statusku]',								   
								   iket		 = '$_POST[ket]',
								   ifile    = '$nama_file_unik'
								   WHERE iid = '$_GET[id]'");		   
}						   
								   
  if ($q){
	if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=tuin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrtl')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 20 MB..!');self.history.back();</script>";
  }
  
 
}
// hapus telaahan
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT ifile,iid FROM tsurat WHERE iid='$_GET[id]'"));
  if ($data['ifile']!=''){
    //hapus juga data dari tabel lain yg berhubungan dengan telaahan
	 unlink("../../smasuk/$data[ifile]"); 
  }
  
  mysql_query("DELETE FROM tsurat WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM tisposisi WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM tdis WHERE iid='$_GET[id]'");
  mysql_query("DELETE FROM tsurat WHERE iid='$_GET[id]'");
  
  if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=tuin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrtl')</script>";
	}
 
}

// selesai telaahan
elseif ($act=='selesai'){
 
  mysql_query("UPDATE tsurat SET istatus2='Y' WHERE iid = '$_GET[id]'");		   
  
  if($_SESSION[levelcv]==0){
	 echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=tuin')</script>";
	} else {
		echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=usrtls')</script>";
	}
 
}


//tambah disp
elseif ($act=='tambahdisp'){
  $q1=mysql_query("INSERT INTO tisposisi(dNoagenda,
                                         dPentisposisi,
								         iid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pentisposisi]',
								'$_GET[iid]')");


  $tdis = $_POST["tdis"];
    include "classes/class.phpmailer.php";
    
  foreach ($tdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO tdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,iid,psACC,tampil,urut) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pentisposisi]','$cid','$_GET[iid]','N','Y','$_POST[urut]')"); 
  }
  
if ($q2){
/*
$tgl_sekarang = date ("Y-m-d");	    
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM tdis a WHERE a.iid='$_GET[iid]' AND a.pId='$_POST[pentisposisi]' ORDER BY a.pdid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Telaahan Produk/Jasa di ekfpb.com!',
								'Yth. $e[kepada], <br>Ada Telaahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Telaahan perihal : $_POST[isi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Disposisi telaahan terkirim!');window.location=('../../home.php?pages=usrtl')</script>";
/*  
 
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "ekfpb.com"; //host masing2 provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@ekfpb.com"; //user email
$mail->Password = "isokfpb9001"; //password email 
$mail->SetFrom("admin@ekfpb.com","ekfpb.com"); //set email pengirim
$mail->Subject = "Ada Tela'ahan Produk/Jasa di ekfpb.com!"; //subyek email
$mail->AddAddress("$e[email]","$e[kepada]");  //tujuan email
$mail->MsgHTML("Yth. $e[kepada], <br>Ada Tela'ahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Tela'ahan perihal : $_POST[isi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Disposisi berhasil/sukses terkirim !, <br><a href=../../home.php?pages=usrtl>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Disposisi tela'ahan berhasil terkirim !, <br><a href=../../home.php?pages=usrtl>KLIK DISINI</a> untuk kembali!
</h4></center>";	
}

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=usrtl'
        }, 3000);
</script>";
*/	  
	  
  } else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  

  
  
//tambah disp
}
elseif($act=='editdisp'){
								
  $tdis = $_POST["tdis"];
  foreach ($tdis as $x=>$cid)
  {
	$q1=mysql_query("INSERT INTO tdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,iid,psACC,tampil,urut) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pentisposisi]','$cid','$_GET[iid]','N','N','$_POST[urut]')"); 
	}
  if($_SESSION[levelcv]==0){
  if ($q1){
	  	    
	  echo "<script>window.alert('Data Disposisi Tersimpan');window.location=('../../home.php?pages=tuin')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
   if ($q1){
	  	    
	  echo "<script>window.alert('Data Disposisi Tersimpan');window.location=('../../home.php?pages=usrtl')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  } 
  }
}
//batas dari aksi_tisposisi.php

?>