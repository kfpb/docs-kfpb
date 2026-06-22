<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
if ($_POST[ket]==""){
	echo "<script>window.alert('Isi permohonan kosong, silahkan kembali!');self.history.back();</script>";	 
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

UploadLinter($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
  
  $q=mysql_query("INSERT INTO linter(sitgl,
                                   sijam,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
								   sipengirim3,
                                   siperihal,
								   sikomen,
								   sbnjrn,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
	                            '$jam',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[pengirim3]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[sbnjrn]',
								'$_POST[ket]',
								'N')");
}
else {

  $q=mysql_query("INSERT INTO linter(sitgl,
                                   sijam,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
								   sipengirim3,
                                   siperihal,
								   sikomen,
								   sbnjrn,
                                   siket,
                                   sifile,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
	                            '$jam',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[pengirim3]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[sbnjrn]',
								'$_POST[ket]',
								'$nama_file_unik',
								'N')");
								
}
																					
  if ($q){
	 
 echo "<script>window.alert('Permohonan ATK tersimpan, Menunggu koreksi/acc atasan');window.location=('../../home.php?pages=linter')</script>";

  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
}

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
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
    
     $q=mysql_query("UPDATE linter SET sinmr   = '$_POST[nomor]',
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
  UploadLinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM linter WHERE siid='$_GET[id]'"));
unlink("../../linternal/$data[sifile]"); 

  $q=mysql_query("UPDATE linter SET sinmr   = '$_POST[nomor]',
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
	  echo "<script>window.alert('Permohonan ATK berhasil Terupdate');window.location=('../../home.php?pages=linter')</script>";
  }else{
       echo "<script>window.alert('Permohonan ATK Gagal Update');self.history.back();</script>";
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
    
     $q=mysql_query("UPDATE linter SET sinmr   = '$_POST[nomor]',
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
  Uploadlinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM linter WHERE siid='$_GET[id]'"));
unlink("../../linternal/$data[sifile]"); 

  $q=mysql_query("UPDATE linter SET sinmr   = '$_POST[nomor]',
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
	  echo "<script>window.alert('SPPTek berhasil diedit');window.location=('../../home.php?pages=lintertp')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}


elseif($act=='edit3'){
 
     $q=mysql_query("UPDATE linter SET sikomen2 = '$_POST[sikomen2]' WHERE siid = '$_GET[id]'");
     
  if ($q){
	  echo "<script>window.alert('Komentar berhasil Terupdate');window.location=('../../home.php?pages=linterm')</script>";
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
    
     $q=mysql_query("UPDATE linter SET sinmr   = '$_POST[nomor]',
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
  Uploadlinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM linter WHERE siid='$_GET[id]'"));
unlink("../../linternal/$data[sifile]"); 

  $q=mysql_query("UPDATE linter SET sinmr   = '$_POST[nomor]',
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
	  echo "<script>window.alert('Berhasil Terupdate');window.location=('../../home.php?pages=linterm')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }

  
}

// acc 
elseif ($act=='acc'){
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM linter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 4, 4);
$noUrut++;
$newID = sprintf("ATK-%04s/$bln", $noUrut);
	
$q=mysql_query("UPDATE linter SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   accsipengirim2   = 'Y',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");
								    
$t=mysql_query("INSERT INTO lsin(cId,siid) VALUES ('66','$_GET[id]')");


  if ($q){

	  echo "<script>window.alert('Permohonan ATK Berhasil Di ACC');window.location=('../../home.php?pages=linter')</script>";

  }else{
	  echo "<script>window.alert('Gagal!');self.history.back();</script>";
  }
}


// acc  pengirim1 ke pengirim2
elseif ($act=='acc2'){
	
$q=mysql_query("UPDATE linter SET accsipengirim1   = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim ke atasan untuk ACC');window.location=('../../home.php?pages=linter')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim ke atasan untuk ACC!');self.history.back();</script>";
  }
}

// acc  pengirim1 ke pengirim2
elseif ($act=='acc23'){
	
$q=mysql_query("UPDATE linter SET accsipengirim2   = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim ke Pengesahan Berikutnya');window.location=('../../home.php?pages=linter')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim !');self.history.back();</script>";
  }
}

// return
elseif ($act=='acc33'){
	
$q=mysql_query("UPDATE linter SET accsipengirim1='N', accsipengirim2='N' WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim ke Pengesahan Berikutnya');window.location=('../../home.php?pages=linter')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim !');self.history.back();</script>";
  }
}


// hapus Permohonan ATK
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM linter WHERE siid='$_GET[id]'"));
  if ($data['sifile']!=''){
     mysql_query("DELETE FROM linter WHERE siid='$_GET[id]'");
	 mysql_query("DELETE FROM lsin WHERE siid='$_GET[id]'");
	 unlink("../../linternal/$data[sifile]"); 
  }
  else{
     mysql_query("DELETE FROM linter WHERE siid='$_GET[id]'");
 	 mysql_query("DELETE FROM lsin WHERE siid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=linter')</script>"; 
}
//tambah penerima 
elseif ($act=='lp'){
 mysql_query("DELETE FROM lsin WHERE siid='$_GET[id]'");
  $lsin = $_POST["lsin"];
  foreach ($lsin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO lsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
 mysql_query("DELETE FROM tsin WHERE siid='$_GET[id]'");
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=linter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

elseif ($act=='lpadmin'){
  $lsin = $_POST["lsin"];
  foreach ($lsin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO lsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=linter')</script>";
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
  $e = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$_GET[siid]'"));		
  
  $isi0 ="<table border=0>
    <tr>
        <td width=65% valign=top>$e[siket]</td>
        <td width=35% valign=top>
        <p>Jika tidak jadi mengajukan permohonan atk beri keterangan.</p>
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
  $q1=mysql_query("INSERT INTO lisposisi(dNoagenda,
                                         dPendisposisi,
								         siid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[siid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO lisposisi(dNoagenda,
                                         dPendisposisi,
								         siid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[siid]',
								'$nama_file_unik')");
  }

/*
	$q2=mysql_query("INSERT INTO ldis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','26','$_GET[siid]','N','N')"); 
*/	
	$q22=mysql_query("INSERT INTO ldis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','127','$_GET[siid]','N','N')"); 

	$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));
	
	$q3=mysql_query("INSERT INTO ldis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psTglbaca,psTglselesai,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','$e[cId]','$_GET[siid]','$_POST[tglm]','$_POST[tglm]','Y','N')"); 
	
    $q4=mysql_query("UPDATE linter SET ssdisp   = 'Y'
								   WHERE siid = '$_GET[siid]'"); 
								   
	if ($_POST[sbnjrn]==Y) {
	  $q5=mysql_query("INSERT INTO ldis(pNoagenda,ptgl,pInstruksi,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[pendisposisi]','71','$_GET[siid]','N','N')");   
	}					   

   if ($q1){

  
  echo "<script>window.alert('Disposisi terkirim! $_GET[id]');window.location=('../../home.php?pages=usrl')</script>";
  
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
  $ldis = $_POST["ldis"];
  include "classes/class.phpmailer.php";

  foreach ($ldis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO ldis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,siid,psACC,kode,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[siid]','N','$now','$_POST[jawab]')"); 
 }
 
if($_SESSION[levelcv]==0){
  if ($q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=linter')</script>";
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
					FROM ldis a WHERE a.siid='$_GET[siid]' AND a.pId='$_POST[pendisposisi]' AND a.kode='$now' ORDER BY a.pdid DESC");

  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Disposisi gagal terkirim');self.history.back();</script>";
  }
  
  }
  
}
//batas dari aksi_disposisi.php

?>
