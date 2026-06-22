<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
 UploadDointer($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO dointer(ditgl,
                                   dipengirim,
                                   dikodok,
								   direv,
								   dijudok,
								   jenisdok,
								   ditgl_brlk,
                                   diket,
								   distatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[dikodok]',
								'$_POST[revisi]',
								'$_POST[dijudok]',
								'$_POST[jenisdok]',
								'$_POST[tgl_brlk]',
								'$_POST[ket]',
								'N')");
		}
		else {
			 $q=mysql_query("INSERT INTO dointer(ditgl,
                                   dipengirim,
                                   dikodok,
								   direv,
								   dijudok,
								   jenisdok,
								   ditgl_brlk,
                                   diket,
								   distatus,
								   difile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[dikodok]',
								'$_POST[revisi]',
								'$_POST[dijudok]',
								'$_POST[jenisdok]',
								'$_POST[tgl_brlk]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
		}
	
							
		
  if ($q){

echo "<script>window.alert('Sosialisasi Dokumen tersimpan dan tinggal ACC');window.location=('../../home.php?pages=dointer')</script>";

	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";

  
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   


}elseif($act=='edit'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;    

if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
    
     $q=mysql_query("UPDATE dointer SET ditgl 	  = '$_POST[tgl]',
								   ditgl_slesai	  = '$_POST[tgl_slesai]',
								   jenisdok	 = '$_POST[jenisdok]',
                                   dikodok = '$_POST[dikodok]',
								   direv = '$_POST[revisi]',
                                   dikodok1 = '$_POST[dikodok1]',
								   direv1 = '$_POST[revisi1]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   diket	 = '$_POST[ket]'
								   WHERE suid = '$_GET[id]'");
}

else {
  UploadDointer($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT difile,suid FROM dointer WHERE suid='$_GET[id]'"));
unlink("../../sosialisasidok/$data[difile]"); 

  $q=mysql_query("UPDATE dointer SET ditgl 	  = '$_POST[tgl]',
								   ditgl_slesai 	  = '$_POST[tgl_slesai]',
								   jenisdok	 = '$_POST[jenisdok]',
                                   dikodok = '$_POST[dikodok]',
								   direv = '$_POST[revisi]',
                                   dikodok1 = '$_POST[dikodok1]',
								   direv1 = '$_POST[revisi1]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   diket	 = '$_POST[ket]',
								   difile    = '$nama_file_unik'
								   WHERE suid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('Sosialisasi Dokumen Berhasil di Edit');window.location=('../../home.php?pages=dointer')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}

// kirim sosialisasi dokumen
elseif ($act=='acc'){
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(dinmr) as max_no FROM dointer WHERE dinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("SD-%04s/$bln", $noUrut);
	
$q=mysql_query("UPDATE dointer SET  dinmr 		 = '$newID',
								   distatus   	 = 'Y'
								   WHERE suid = '$_GET[id]'");
  if ($q){
	  /*
$tgl_sekarang = date ("Y-m-d");
$result = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN dosin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]'");
						
$result1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN dosin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]'"));


$results = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN tsin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]'");
						
$results1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN tsin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]'"));
						
$r = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab,b.* FROM users a
						LEFT JOIN dointer b ON b.dipengirim1=a.cId
						WHERE b.suid='$_GET[id]'"));
						
while($e=mysql_fetch_array($result)){
mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Memo/Undangan Internal untuk $e[cNama]!',
								'Yth. $e[cNama], <br>Ada Memo/Undangan Internal di aplikasi http://e-kfpb.co.id untuk anda<br>
Memo/Undangan dari : $r[cNama],<br>
Perihal : $r[siperihal],<br><br>
Untuk baca Memo/Undangan (Detail) silahkan segera login ke http://e-kfpb.co.id<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Abjad terakhir huruf besar, jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
/*while($ef=mysql_fetch_array($results)){
mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$ef[cNama]',
                                '$ef[cEmail2]',
								'Ada Tembusan Memo/Undangan Internal untuk $ef[cNama]!',
								'Yth. $ef[cNama], <br>Ada Tembusan Memo/Undangan Internal di aplikasi http://e-kfpb.co.id untuk anda<br>
Memo/Undangan dari : $r[cNama],<br>
Perihal : $r[siperihal],<br>
Untuk baca Memo/Undangan (Detail) silahkan segera login ke http://e-kfpb.co.id<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/ 
	  echo "<script>window.alert('sosialisasi Dokumen Terkirim');window.location=('../../home.php?pages=dointer')</script>";


		
  }else{
	  echo "<script>window.alert(sosialisasi Dokumen Gagal Terkirim!');self.history.back();</script>";
  }
}

// baca sosialisasi dokumen
elseif ($act=='baca'){
date_default_timezone_set('Asia/Jakarta');
$tgl_sekarang = date("Y-m-d H:i:s");

if ($_POST[cek]==''){
echo "<center><h2>Anda belum ceklist telah membaca <br><a href=../../home.php?pages=ussd&act=detail&id=$_GET[id]>KLIK DISINI</a> untuk kembali!</h2>";
}
else {

$q=mysql_query("UPDATE dosin SET tgl_baca='$tgl_sekarang', distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");

  if ($q){
	  echo "<script>window.alert('Sosialisasi Dokumen Telah Selesai Dibaca');window.location=('../../home.php?pages=ussd')</script>";

  }else{
	  echo "<script>window.alert(Sosialisasi Dokumen Gagal Tersimpan!');self.history.back();</script>";
  }
}
// hapus smasuk
}elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT difile,suid FROM dointer WHERE suid='$_GET[id]'"));
  if ($data['difile']!=''){
     mysql_query("DELETE FROM dointer WHERE suid='$_GET[id]'");
	 mysql_query("DELETE FROM dosin WHERE suid='$_GET[id]'");
	 unlink("../../sosialisasidok/$data[difile]"); 
  }
  else{
     mysql_query("DELETE FROM dointer WHERE suid='$_GET[id]'");
 	 mysql_query("DELETE FROM dosin WHERE suid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=dointer')</script>"; 
}

//tambah penerima dan tembusan
elseif ($act=='lp'){
 mysql_query("DELETE FROM dosin WHERE suid='$_GET[id]'");
  $dosin = $_POST["dosin"];
  foreach ($dosin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO dosin(cId,suid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  
  if ($q){
	  
	echo "<script>window.location=('../../home.php?pages=dointer')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

elseif ($act=='lp1'){
  mysql_query("DELETE FROM dosin WHERE suid='$_GET[id]'");	
  
  if ($q){
	  
	echo "<script>window.alert('Penerima Salinan dihapus, ulangi lagi input penerima salinan');window.location=('../../home.php?pages=dointer')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

//batas 
//buat disp dok atau info dok
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

 UploadDispdok($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO disposisidok(dNoagenda,
                                         dPendisposisi,
								         suid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[suid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO disposisidok(dNoagenda,
                                         dPendisposisi,
								         suid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[suid]',
								'$nama_file_unik')");
  }
  
  $ddis = $_POST["ddis"];

  foreach ($ddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO ddis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,suid,psACC,jawab,disfiles) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[suid]','N','$_POST[jawab]','$nama_file_unik')"); 
 }
 
if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=dointer')</script>";
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
					FROM ddis a WHERE a.suid='$_GET[suid]' AND a.pId='$_POST[pendisposisi]' ORDER BY a.pdid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Memo/Undangan/Tembusan di aplikasi http://e-kfpb.co.id untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://e-kfpb.co.id<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Info Dokumen terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal Terkirim');self.history.back();</script>";
  } 
  
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  
//tambah disp
}
elseif($act=='editdisp'){
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
  $ddis = $_POST["ddis"];
  include "classes/class.phpmailer.php";  

 UploadDispdok($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
   foreach ($ddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO ddis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,suid,psACC,kode,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[suid]','N','$now','$_POST[jawab]')"); 
 }
  }
  else {
	    foreach ($ddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO ddis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,suid,psACC,kode,jawab,disfiles) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[suid]','N','$now','$_POST[jawab]','$nama_file_unik')"); 
 }
  }
 }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  


 
if($_SESSION[levelcv]==0){
  if ($q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=dointer')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
  if ($q2){
	  $tgl_sekarang = date ("Y-m-d");
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM ddis a WHERE a.suid='$_GET[suid]' AND a.pId='$_POST[pendisposisi]' AND a.kode='$now' ORDER BY a.pdid DESC");
/*
while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Memo/Undangan/Tembusan di aplikasi http://e-kfpb.co.id untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://e-kfpb.co.id<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Info Dokumen terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal terkirim');self.history.back();</script>";
  }
  
  }
  
}
//batas 

?>
