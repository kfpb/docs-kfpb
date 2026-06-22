<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
if ($_POST[ket]==""){
	echo "<script>window.alert('Isi SPK kosong, silahkan kembali!');self.history.back();</script>";	 
}
else {
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;
  date_default_timezone_set("Asia/Jakarta");
  $jam            = date ("H:i");
  
 
  
  $q=mysql_query("INSERT INTO minter(sitgl,
                                   sijam,
                                   sitgl_mulai,
                                   sitgl_selesai,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
                                   siket,
                                   sub,
                                   bagian,
                                   p1,
                                   p2,
                                   p3,
                                   p4,
                                   p5,
                                   p6,
                                   p7,
                                   p8,
                                   p9,
                                   p10,
                                   p11,
                                   p12,
                                   p13,
                                   p14,
                                   p15,
                                   p16,
                                   p17,
                                   p18,
                                   p19,
                                   p20,
                                   p21,
                                   p22,
                                   p23,
                                   p24,
                                   p25,
                                   p26,
                                   p27,
                                   p28,
                                   p29,
                                   p30,
                                   sstatus2,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
	                            '$jam',
	                            '$_POST[sitgl_mulai]',
	                            '$_POST[sitgl_selesai]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[ket]',
								'$_POST[sub]',
								'$_POST[bagian]',
								'$_POST[p1]',
								'$_POST[p2]',
								'$_POST[p3]',
								'$_POST[p4]',
								'$_POST[p5]',
								'$_POST[p6]',
								'$_POST[p7]',
								'$_POST[p8]',
								'$_POST[p9]',
								'$_POST[p10]',
								'$_POST[p11]',
								'$_POST[p12]',
								'$_POST[p13]',
								'$_POST[p14]',
								'$_POST[p15]',
								'$_POST[p16]',
								'$_POST[p17]',
								'$_POST[p18]',
								'$_POST[p19]',
								'$_POST[p20]',
								'$_POST[p21]',
								'$_POST[p22]',
								'$_POST[p23]',
								'$_POST[p24]',
								'$_POST[p25]',
								'$_POST[p26]',
								'$_POST[p27]',
								'$_POST[p28]',
								'$_POST[p29]',
								'$_POST[p30]',
								'1',
								'N')");

																					
  if ($q){
	 
 echo "<script>window.alert('Permohonan Mutasi sementara telah dibuat, Menunggu koreksi/acc atasan');window.location=('../../home.php?pages=minter')</script>";

  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 

  }


   
}
}


elseif($act=='edit'){
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
    
     $q=mysql_query("UPDATE minter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sipengirim3 ='$_POST[pengirim4]',
								   sstatus ='$_POST[status]',
								   siket	 = '$_POST[ket]'
								   WHERE siid = '$_GET[id]'");
}

else {
  Uploadminter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM minter WHERE siid='$_GET[id]'"));
unlink("../../minternal/$data[sifile]"); 

  $q=mysql_query("UPDATE minter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sipengirim3 ='$_POST[pengirim4]',
								   sstatus ='$_POST[status]',
								   siket	 = '$_POST[ket]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('Mutasi sementara berhasil Terupdate');window.location=('../../home.php?pages=minter')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}

elseif($act=='edit2'){
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
    
     $q=mysql_query("UPDATE minter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$_POST[jenispptek]',								   
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   sitgl_order ='$_POST[tgl_order]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   siket	 = '$_POST[ket]'
								   WHERE siid = '$_GET[id]'");
}

else {
  Uploadminter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM minter WHERE siid='$_GET[id]'"));
unlink("../../minternal/$data[sifile]"); 

  $q=mysql_query("UPDATE minter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$_POST[jenispptek]',
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   sitgl_order ='$_POST[tgl_order]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   siket	 = '$_POST[ket]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('SPPTek berhasil diedit');window.location=('../../home.php?pages=mintertp')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}


elseif($act=='edit3'){
 
     $q=mysql_query("UPDATE minter SET sikomen2 = '$_POST[sikomen2]' WHERE siid = '$_GET[id]'");
     
  if ($q){
	  echo "<script>window.alert('Komentar berhasil Terupdate');window.location=('../../home.php?pages=minterm')</script>";
  }else{
       echo "<script>window.alert('Komentar Gagal Update');self.history.back();</script>";
  }

}
elseif($act=='edit4'){
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
    
     $q=mysql_query("UPDATE minter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$_POST[jenispptek]',
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   siket	 = '$_POST[ket]'
								   WHERE siid = '$_GET[id]'");
}

else {
  Uploadminter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM minter WHERE siid='$_GET[id]'"));
unlink("../../minternal/$data[sifile]"); 

  $q=mysql_query("UPDATE minter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$_POST[jenispptek]',
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   siket	 = '$_POST[ket]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('Berhasil Terupdate');window.location=('../../home.php?pages=minterm')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }

  
}

// acc mutasi
elseif ($act=='acc'){
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM minter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("P-%04s/$bln", $noUrut);
	
$q=mysql_query("UPDATE minter SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");


$e=mysql_fetch_array(mysql_query("SELECT * FROM minter WHERE siid='$_GET[id]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p1]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p2]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p3]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p4]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p5]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p6]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p7]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p8]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p9]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p10]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p11]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p12]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p13]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p14]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p15]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p16]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p17]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p18]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p19]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p20]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p21]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p22]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p23]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p24]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p25]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p26]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p27]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p28]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p29]'");
mysql_query("UPDATE pegawai SET cBagian3 = '$e[bagian]', cSub2 = '$e[sub]' WHERE cId = '$e[p30]'");

								   
$r=mysql_query("INSERT INTO msin(cId,siid) VALUES ('$_GET[p1]','$_GET[id]')");
$t=mysql_query("INSERT INTO msin(cId,siid) VALUES ('71','$_GET[id]')");
$t=mysql_query("INSERT INTO msin(cId,siid) VALUES ('65','$_GET[id]')");
$t=mysql_query("INSERT INTO msin(cId,siid) VALUES ('127x','$_GET[id]')");


  if ($q){

	  echo "<script>window.alert('Mutasi Berhasil Di ACC');window.location=('../../home.php?pages=minter')</script>";

  }else{
	  echo "<script>window.alert('Gagal!');self.history.back();</script>";
  }
}


// acc  pengirim1 ke pengirim2
elseif ($act=='acc2'){
	
$q=mysql_query("UPDATE minter SET accsipengirim1   = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim untuk ACC');window.location=('../../home.php?pages=minter')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim untuk ACC!');self.history.back();</script>";
  }
}

// acc  pengirim1 ke pengirim2
elseif ($act=='acc23'){
	
$q=mysql_query("UPDATE minter SET accsipengirim2   = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim ke Pengesahan Berikutnya');window.location=('../../home.php?pages=minter')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim !');self.history.back();</script>";
  }
}

// return
elseif ($act=='acck'){

$e=mysql_fetch_array(mysql_query("SELECT * FROM minter WHERE siid='$_GET[id]'"));
$e1=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p1]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e1[cBagian2]', cSub2 = '$e1[cBagian]' WHERE cId = '$e[p1]'");
$e2=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p2]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e2[cBagian2]', cSub2 = '$e2[cBagian]' WHERE cId = '$e[p2]'");
$e3=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p3]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e3[cBagian2]', cSub2 = '$e3[cBagian]' WHERE cId = '$e[p3]'");
$e4=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p4]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e4[cBagian2]', cSub2 = '$e4[cBagian]' WHERE cId = '$e[p4]'");
$e5=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p5]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e5[cBagian2]', cSub2 = '$e5[cBagian]' WHERE cId = '$e[p5]'");
$e6=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p6]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e6[cBagian2]', cSub2 = '$e6[cBagian]' WHERE cId = '$e[p6]'");
$e7=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p7]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e7[cBagian2]', cSub2 = '$e7[cBagian]' WHERE cId = '$e[p7]'");
$e8=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p8]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e8[cBagian2]', cSub2 = '$e8[cBagian]' WHERE cId = '$e[p8]'");
$e9=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p9]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e9[cBagian2]', cSub2 = '$e9[cBagian]' WHERE cId = '$e[p9]'");
$e10=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p10]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e10[cBagian2]', cSub2 = '$e10[cBagian]' WHERE cId = '$e[p10]'");
$e11=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p11]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e11[cBagian2]', cSub2 = '$e11[cBagian]' WHERE cId = '$e[p11]'");
$e12=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p12]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e12[cBagian2]', cSub2 = '$e12[cBagian]' WHERE cId = '$e[p12]'");
$e13=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p13]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e13[cBagian2]', cSub2 = '$e13[cBagian]' WHERE cId = '$e[p13]'");
$e14=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p14]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e14[cBagian2]', cSub2 = '$e14[cBagian]' WHERE cId = '$e[p14]'");
$e15=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p15]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e15[cBagian2]', cSub2 = '$e15[cBagian]' WHERE cId = '$e[p15]'");
$e16=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p16]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e16[cBagian2]', cSub2 = '$e16[cBagian]' WHERE cId = '$e[p16]'");
$e17=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p17]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e17[cBagian2]', cSub2 = '$e17[cBagian]' WHERE cId = '$e[p17]'");
$e18=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p18]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e18[cBagian2]', cSub2 = '$e18[cBagian]' WHERE cId = '$e[p18]'");
$e19=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p19]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e19[cBagian2]', cSub2 = '$e19[cBagian]' WHERE cId = '$e[p19]'");
$e20=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p20]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e20[cBagian2]', cSub2 = '$e20[cBagian]' WHERE cId = '$e[p20]'");
$e21=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p21]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e21[cBagian2]', cSub2 = '$e21[cBagian]' WHERE cId = '$e[p21]'");
$e22=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p22]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e22[cBagian2]', cSub2 = '$e22[cBagian]' WHERE cId = '$e[p22]'");
$e23=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p23]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e23[cBagian2]', cSub2 = '$e23[cBagian]' WHERE cId = '$e[p23]'");
$e24=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p24]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e24[cBagian2]', cSub2 = '$e24[cBagian]' WHERE cId = '$e[p24]'");
$e25=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p25]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e25[cBagian2]', cSub2 = '$e25[cBagian]' WHERE cId = '$e[p25]'");
$e26=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p26]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e26[cBagian2]', cSub2 = '$e26[cBagian]' WHERE cId = '$e[p26]'");
$e27=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p27]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e27[cBagian2]', cSub2 = '$e27[cBagian]' WHERE cId = '$e[p27]'");
$e28=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p28]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e28[cBagian2]', cSub2 = '$e28[cBagian]' WHERE cId = '$e[p28]'");
$e29=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p29]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e29[cBagian2]', cSub2 = '$e29[cBagian]' WHERE cId = '$e[p29]'");
$e30=mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$e[p30]'"));
mysql_query("UPDATE pegawai SET cBagian3 = '$e30[cBagian2]', cSub2 = '$e30[cBagian]' WHERE cId = '$e[p30]'");
	
$q=mysql_query("UPDATE minter SET sstatus2='' WHERE siid = '$_GET[id]'");

  if ($q){
	   echo "<script>window.alert('Pegawai sudah kembali ke posisi semula');window.location=('../../home.php?pages=usrm')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim !');self.history.back();</script>";
  }
}


// hapus 
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM minter WHERE siid='$_GET[id]'"));
  if ($data['sifile']!=''){
     mysql_query("DELETE FROM minter WHERE siid='$_GET[id]'");
	 mysql_query("DELETE FROM msin WHERE siid='$_GET[id]'");
	 unlink("../../minternal/$data[sifile]"); 
  }
  else{
     mysql_query("DELETE FROM minter WHERE siid='$_GET[id]'");
 	 mysql_query("DELETE FROM msin WHERE siid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=minter')</script>"; 
}
//tambah penerima 
elseif ($act=='lp'){
 mysql_query("DELETE FROM msin WHERE siid='$_GET[id]'");
  $msin = $_POST["msin"];
  foreach ($msin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO msin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
 mysql_query("DELETE FROM tsin WHERE siid='$_GET[id]'");
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=minter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

elseif ($act=='lpadmin'){
  $msin = $_POST["msin"];
  foreach ($msin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO msin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=minter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

//buat disp
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
  $e = mysql_fetch_array(mysql_query("SELECT * FROM minter WHERE siid='$_GET[siid]'"));		
  
  $isi0 ="<table border=0>
    <tr>
        <td width=65% valign=top>$e[siket]</td>
        <td width=35% valign=top>
       
        <table border=1>
            <tr>
                <td><b>No.</b></td>
                <td><b><center>Selesai Pukul</center></b></td>
                <td><b><center>Hasil yang dikerjakan</center></b></td>
            </tr>";
            
            	if ($_POST[j1]=='')
		{
		    $isi1 ="";
		} else {
       $isi1 ="<tr>
                <td>$_POST[n1]<br></td>
                <td>$_POST[j1]<br></td>
                <td>$_POST[t1]<br></td>
            </tr>";
		}
			if ($_POST[j2]=='')
		{
		    $isi2 ="";
		} else {
        $isi2 ="<tr>
                <td>$_POST[n2]<br></td>
                 <td>$_POST[j2]<br></td>
                <td>$_POST[t2]<br></td>
            </tr>";
		}
			if ($_POST[j3]=='')
		{
		    $isi3 ="";
		} else {
        $isi3 ="<tr>
                <td>$_POST[n3]<br></td>
                 <td>$_POST[j3]<br></td>
                <td>$_POST[t3]<br></td>
            </tr>";
		}
			if ($_POST[j4]=='')
		{
		    $isi4 ="";
		} else {
        $isi4 ="<tr>
                <<td>$_POST[n4]<br></td>
                 <td>$_POST[j4]<br></td>
                <td>$_POST[t4]<br></td>
            </tr>";
		}
			if ($_POST[j5]=='')
		{
		    $isi5 ="";
		} else {
        $isi5 ="<tr>
                <td>$_POST[n5]<br></td>
                <td>$_POST[j5]<br></td>
                <td>$_POST[t5]<br></td>
            </tr>";
		}
			if ($_POST[j6]=='')
		{
		    $isi6 ="";
		} else {
        $isi6 ="<tr>
                <td>$_POST[n6]<br></td>
                <td>$_POST[j6]<br></td>
                <td>$_POST[t6]<br></td>
            </tr>";
		}
			if ($_POST[j7]=='')
		{
		    $isi7 ="";
		} else {
        $isi7 ="<tr>
                <td>$_POST[n7]<br></td>
                <td>$_POST[j7]<br></td>
                <td>$_POST[t7]<br></td>
            </tr>
              <tr>";
		}
			if ($_POST[j8]=='')
		{
		    $isi8 ="";
		} else {
        $isi8 ="<tr>
                <td>$_POST[n8]<br></td>
               <td>$_POST[j8]<br></td>
                <td>$_POST[t8]<br></td>
            </tr>";
		}
			if ($_POST[j9]=='')
		{
		    $isi9 ="";
		} else {
        $isi9 ="<tr>
                <td>$_POST[n9]<br></td>
               <td>$_POST[j9]<br></td>
                <td>$_POST[t9]<br></td>
            </tr>";
		}
			if ($_POST[j10]=='')
		{
		    $isi10 ="";
		} else {
        $isi10 ="<tr>
                <td>$_POST[n10]<br></td>
               <td>$_POST[j10]<br></td>
                <td>$_POST[t10]<br></td>
            </tr>";
		}
            
        if ($_POST[j11]=='')
		{
		    $isi11 ="";
		} else {
       $isi11 ="<tr>
                <td>$_POST[n11]<br></td>
                <td>$_POST[j11]<br></td>
                <td>$_POST[t11]<br></td>
            </tr>";
		}
			if ($_POST[j12]=='')
		{
		    $isi12 ="";
		} else {
        $isi12 ="<tr>
                <td>$_POST[n12]<br></td>
                 <td>$_POST[j12]<br></td>
                <td>$_POST[t12]<br></td>
            </tr>";
		}
			if ($_POST[j13]=='')
		{
		    $isi13 ="";
		} else {
        $isi13 ="<tr>
                <td>$_POST[n13]<br></td>
                 <td>$_POST[j13]<br></td>
                <td>$_POST[t13]<br></td>
            </tr>";
		}
			if ($_POST[j14]=='')
		{
		    $isi14 ="";
		} else {
        $isi14 ="<tr>
                <td>$_POST[n14]<br></td>
                 <td>$_POST[j14]<br></td>
                <td>$_POST[t14]<br></td>
            </tr>";
		}
			if ($_POST[j15]=='')
		{
		    $isi15 ="";
		} else {
        $isi15 ="<tr>
                <td>$_POST[n15]<br></td>
                <td>$_POST[j15]<br></td>
                <td>$_POST[t15]<br></td>
            </tr>";
		}
			if ($_POST[j16]=='')
		{
		    $isi16 ="";
		} else {
        $isi16 ="<tr>
                <td>$_POST[n16]<br></td>
                <td>$_POST[j16]<br></td>
                <td>$_POST[t16]<br></td>
            </tr>";
		}
			if ($_POST[j17]=='')
		{
		    $isi17 ="";
		} else {
        $isi17 ="<tr>
                <td>$_POST[n17]<br></td>
                <td>$_POST[j17]<br></td>
                <td>$_POST[t17]<br></td>
            </tr>
              <tr>";
		}
			if ($_POST[j18]=='')
		{
		    $isi18 ="";
		} else {
        $isi18 ="<tr>
                <td>$_POST[n18]<br></td>
               <td>$_POST[j18]<br></td>
                <td>$_POST[t18]<br></td>
            </tr>";
		}
			if ($_POST[j19]=='')
		{
		    $isi19 ="";
		} else {
        $isi19 ="<tr>
                <td>$_POST[n19]<br></td>
               <td>$_POST[j19]<br></td>
                <td>$_POST[t19]<br></td>
            </tr>";
		}
			if ($_POST[j20]=='')
		{
		    $isi20 ="";
		} else {
        $isi20 ="<tr>
                <td>$_POST[n20]<br></td>
               <td>$_POST[j20]<br></td>
                <td>$_POST[t20]<br></td>
            </tr>";
		}
            
        if ($_POST[j21]=='')
		{
		    $isi21 ="";
		} else {
       $isi21 ="<tr>
                <td>$_POST[n21]<br></td>
                <td>$_POST[j21]<br></td>
                <td>$_POST[t21]<br></td>
            </tr>";
		}
			if ($_POST[j22]=='')
		{
		    $isi22 ="";
		} else {
        $isi22 ="<tr>
                <td>$_POST[n22]<br></td>
                 <td>$_POST[j22]<br></td>
                <td>$_POST[t22]<br></td>
            </tr>";
		}
			if ($_POST[j23]=='')
		{
		    $isi23 ="";
		} else {
        $isi23 ="<tr>
                <td>$_POST[n23]<br></td>
                 <td>$_POST[j23]<br></td>
                <td>$_POST[t23]<br></td>
            </tr>";
		}
			if ($_POST[j24]=='')
		{
		    $isi24 ="";
		} else {
        $isi24 ="<tr>
                <td>$_POST[n24]<br></td>
                 <td>$_POST[j24]<br></td>
                <td>$_POST[t24]<br></td>
            </tr>";
		}
			if ($_POST[j25]=='')
		{
		    $isi25 ="";
		} else {
        $isi25 ="<tr>
                <<td>$_POST[n25]<br></td>
                <td>$_POST[j25]<br></td>
                <td>$_POST[t25]<br></td>
            </tr>";
		}
			if ($_POST[j26]=='')
		{
		    $isi26 ="";
		} else {
        $isi26 ="<tr>
                <td>$_POST[n26]<br></td>
                <td>$_POST[j26]<br></td>
                <td>$_POST[t26]<br></td>
            </tr>";
		}
			if ($_POST[j27]=='')
		{
		    $isi27 ="";
		} else {
        $isi27 ="<tr>
                <td>$_POST[n27]<br></td>
                <td>$_POST[j27]<br></td>
                <td>$_POST[t27]<br></td>
            </tr>
              <tr>";
		}
			if ($_POST[j28]=='')
		{
		    $isi28 ="";
		} else {
        $isi28 ="<tr>
               <td>$_POST[n28]<br></td>
               <td>$_POST[j28]<br></td>
                <td>$_POST[t28]<br></td>
            </tr>";
		}
			if ($_POST[j29]=='')
		{
		    $isi29 ="";
		} else {
        $isi29 ="<tr>
               <td>$_POST[n29]<br></td>
               <td>$_POST[j29]<br></td>
                <td>$_POST[t29]<br></td>
            </tr>";
		}
			if ($_POST[j30]=='')
		{
		    $isi30 ="";
		} else {
        $isi30 ="<tr>
                <td>$_POST[n30]<br></td>
               <td>$_POST[j30]<br></td>
                <td>$_POST[t30]<br></td>
            </tr>";
		}
            
$isi31="</tr>
        </table>
       
        </td>
    </tr>
    </table>
    <b>Keterangan Tambahan Lainnya : $_POST[isi]</b>";
    
$isi=$isi0.$isi1.$isi2.$isi3.$isi4.$isi5.$isi6.$isi7.$isi8.$isi9.$isi10.$isi11.$isi12.$isi13.$isi14.$isi15.$isi16.$isi17.$isi18.$isi19.$isi20.$isi21.$isi22.$isi23.$isi24.$isi25.$isi26.$isi27.$isi28.$isi29.$isi30.$isi31;
	

 UploadDisp($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO misposisi(dNoagenda,
                                         dPendisposisi,
								         siid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[siid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO misposisi(dNoagenda,
                                         dPendisposisi,
								         siid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[siid]',
								'$nama_file_unik')");
  }

/*
	$q2=mysql_query("INSERT INTO mdis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','26','$_GET[siid]','N','N')"); 
*/	
	$q22=mysql_query("INSERT INTO mdis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','127','$_GET[siid]','N','N')"); 

	$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));
	
	$q3=mysql_query("INSERT INTO mdis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','$e[cId]','$_GET[siid]','N','N')"); 
	
    $q4=mysql_query("UPDATE minter SET ssdisp   = 'Y'
								   WHERE siid = '$_GET[siid]'"); 
								   
	if ($_POST[sbnjrn]==Y) {
	  $q5=mysql_query("INSERT INTO mdis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','75','$_GET[siid]','N','N')");   
	}					   

   if ($q1){

  
  echo "<script>window.alert('Disposisi mutasi sementara terkirim! $_GET[id]');window.location=('../../home.php?pages=usrm')</script>";
  
  }else{
	  echo "<script>window.alert('Disposisi Gagal Terkirim');self.history.back();</script>";
  }
 
 }
  
 else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  
 

}
elseif($act=='editdisp'){

  $now = date("H:i");
  $mdis = $_POST["mdis"];
  include "classes/class.phpmailer.php";

  foreach ($mdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO mdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,siid,psACC,kode,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[siid]','N','$now','$_POST[jawab]')"); 
 }
 
if($_SESSION[levelcv]==0){
  if ($q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=minter')</script>";
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
					FROM mdis a WHERE a.siid='$_GET[siid]' AND a.pId='$_POST[pendisposisi]' AND a.kode='$now' ORDER BY a.pdid DESC");

  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Disposisi gagal terkirim');self.history.back();</script>";
  }
  
  }
  
}
//batas dari aksi_disposisi.php

?>
