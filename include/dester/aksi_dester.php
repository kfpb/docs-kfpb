<?php
require_once "../cek_sesi.php";
if(!isset($_SESSION))
    {
        session_start();
    }
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET['act'];

// Input
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $acak.$nama_file;  

$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

UploadDester($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO dester(ditgl_input,
                                   dipengirim,
								   dijudok,
								   penerbit,
								   tahun,
								   jenis,
                                   lokasi,
                                   keterangan,
								   distatus) 
	                     VALUES('$tgl_sekarang',
	                            '2',
								'$_POST[dijudok]',
								'$_POST[penerbit]',
								'$_POST[tahun]',
								'$_POST[jenis]',
								'$_POST[lokasi]',
								'$_POST[keterangan]',
								'N')");
		}
		else {
			 $q=mysql_query("INSERT INTO dester(ditgl_input,
                                   dipengirim,
                                   dikodok,
								   dijudok,
								   penerbit,
								   tahun,
								   jenis,
                                   lokasi,
                                   keterangan,
                                   distatus,
								   difile) 
	                     VALUES('$tgl_sekarang',
	                            '2',
								'$newID',
								'$_POST[dijudok]',
								'$_POST[penerbit]',
								'$_POST[tahun]',
								'$_POST[jenis]',
								'$_POST[lokasi]',
								'$_POST[keterangan]',
								'N',
								'$nama_file_unik')");
		}
	
							
		
  if ($q){

echo "<script>window.alert('Dokumen Eksternal Tersimpan');window.location=('../../home.php?pages=dester')</script>

";
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";

  
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
   


}elseif($act=='edit'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,999);
  $acak2          = rand(9999,99999);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $acak.$nama_file;    

if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
    
     $q=mysql_query("UPDATE dester SET jenis	 = '$_POST[jenis]',
                                   lokasi = '$_POST[lokasi]',
                                   dikodok = '$_POST[dikodok]',
								   dijudok = '$_POST[dijudok]',
								   penerbit = '$_POST[penerbit]',
								   tahun = '$_POST[tahun]',
								   keterangan = '$_POST[keterangan]',
								   distatus	 = '$_POST[status]'
								   WHERE suid = '$_GET[id]'");
}
else {
UploadDester($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT difile,suid FROM dester WHERE suid='$_GET[id]'"));
unlink("../../fdokest/$data[difile]"); 


  $q=mysql_query("UPDATE dester SET jenis = '$_POST[jenis]',
                                  lokasi = '$_POST[lokasi]',
                                   dikodok = '$_POST[dikodok]',
								   dijudok = '$_POST[dijudok]',
								   penerbit = '$_POST[penerbit]',
								   tahun = '$_POST[tahun]',
								   keterangan = '$_POST[keterangan]',
								   distatus	 = '$_POST[status]',
								   difile    = '$nama_file_unik'
								   WHERE suid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('Dokumen eksternal Berhasil Diupdate');window.location=('../../home.php?pages=dester')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
   
  
}

// kirim distribusi dokumen
elseif ($act=='acc'){
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(dinmr) as max_no FROM dester WHERE dikodok LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("DE-%04s/$bln", $noUrut);
	
$q=mysql_query("UPDATE dester SET  dikodok 		 = '$newID',
								   distatus   	 = 'Y'
								   WHERE suid = '$_GET[id]'");
								   
  if ($q){

	  echo "<script>window.alert('Distribusi Dokumen Eksternal Terkirim');window.location=('../../home.php?pages=dester')</script>";
		
  }else{
	  echo "<script>window.alert(Distribusi Dokumen Eksternal Gagal Terkirim!');self.history.back();</script>";
  }
}

// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT difile,suid FROM dester WHERE suid='$_GET[id]'"));
  if ($data['difile']!=''){
     mysql_query("DELETE FROM dester WHERE suid='$_GET[id]'");
	 mysql_query("DELETE FROM desin WHERE suid='$_GET[id]'");
	 unlink("../../fdokest/$data[difile]"); 
  }
  else{
     mysql_query("DELETE FROM dester WHERE suid='$_GET[id]'");
 	 mysql_query("DELETE FROM desin WHERE suid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=dester')</script>"; 
}


elseif ($act=='lp1'){
$tgl_sekarang = date ("Y-m-d");

 mysql_query("DELETE FROM desin WHERE suid='$_GET[id]'");
  $desin = $_POST["desin"];
  foreach ($desin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO desin(cId,suid,distatus) VALUES ('$cid','$_GET[id]','N')");  
  }
  
    if ($q){
	  
	echo "<script>window.alert('Penerima Salinan disimpan');window.location=('../../home.php?pages=dester')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

//batas 
//buat review dok
elseif ($act=='tambahdisp'){
	
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
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


	$q2=mysql_query("INSERT INTO ddis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,suid,psACC,jawab,disfiles) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$ddis','$_GET[suid]','N','$_POST[jawab]','$nama_file_unik')"); 
 
if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Review Tersimpan');window.location=('../../home.php?pages=dester')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
      
   if ($q1&&$q2){

  echo "<script>window.alert('Hasil Review telah terkirim ke MR');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal Terkirim');self.history.back();</script>";
  } 
  
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  
//tambah disp
}
elseif($act=='editdisp'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
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
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  


 
if($_SESSION[levelcv]==0){
  if ($q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=dester')</script>";
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

  echo "<script>window.alert('Info Dokumen terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal terkirim');self.history.back();</script>";
  }
  
  }
  
}
//batas 

?>
