<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];
$usr=$_GET[usr];
// error_reporting(-1);
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($act=='tambahspptek'){
if ($_POST[ket]==""){
	echo "<script>window.alert('Isi Memo/Undangan kosong, silahkan kembali!');self.history.back();</script>";	 
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
 
  UploadSinter($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  
if ($_POST[pengirim1]=="tidak" AND $_POST[pengirim2]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Data Tersimpan! Silahkan isi list penerima dan tembusan!');window.location=('../../home.php?pages=sinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }
} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }

} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]!="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }
}
else{
	if ($_POST[pengirim1]=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO spptek(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
			}
			else {
							 $q=mysql_query("INSERT INTO spptek(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
				
			}
	}
	else {
		if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
		}
		else {
			 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
		}
	}
							
		
  if ($q){
/*
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));

$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$ef[cNama]',
                                '$ef[cEmail2]',
								'Ada Konsep Memo/Undangan Internal Perlu KOREKSI/ACC di ekfpb.com!',
'Yth. $ef[cNama], <br>Ada konsep Memo/Undangan Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep memo/undangan dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi memo/undangan yaitu edit memo/undangan (klik gambar pena), edit list penerima, memo dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Memo/Undangan Perihal : $_POST[perihal]<br>
Isi Memo/Undangan :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinter')</script>";


/*
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));

include "classes/class.phpmailer.php";
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
$mail->Subject = "Ada Memo/Undangan Internal Perlu KOREKSI/ACC di ekfpb.com!"; //subyek email
$mail->AddAddress("$ef[cEmail2]","$ef[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $ef[cNama], <br>Ada konsep Memo/Undangan Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep memo/undangan dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi memo/undangan yaitu edit memo/undangan (klik gambar pena), edit list penerima, memo dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Memo/Undangan Perihal : $_POST[perihal]<br>
Isi Memo/Undangan :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Memo/Undangan berhasil tersimpan dan email terkirim ke atasan langsung, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Memo/Undangan berhasil tersimpan tetapi email ke atasan langsung gagal terkirim, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
}
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
}
}//endsppetek
// Input
if ($act=='tambah'){
if ($_POST[ket]==""){
	echo "<script>window.alert('Isi Memo/Undangan kosong, silahkan kembali!');self.history.back();</script>";	 
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
 
  UploadSinter($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  
if ($_POST[pengirim1]=="tidak" AND $_POST[pengirim2]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Data Tersimpan! Silahkan isi list penerima dan tembusan!');window.location=('../../home.php?pages=sinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }
} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }

} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]!="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }
}
else{
	if ($_POST[pengirim1]=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO sinter(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
			}
			else {
							 $q=mysql_query("INSERT INTO sinter(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
				
			}
	}
	else {
		if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N')");
		}
		else {
			 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen
								   jenisms,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
		}
	}
							
		
  if ($q){
/*
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));

$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$ef[cNama]',
                                '$ef[cEmail2]',
								'Ada Konsep Memo/Undangan Internal Perlu KOREKSI/ACC di ekfpb.com!',
'Yth. $ef[cNama], <br>Ada konsep Memo/Undangan Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep memo/undangan dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi memo/undangan yaitu edit memo/undangan (klik gambar pena), edit list penerima, memo dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Memo/Undangan Perihal : $_POST[perihal]<br>
Isi Memo/Undangan :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinter')</script>";


/*
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));

include "classes/class.phpmailer.php";
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
$mail->Subject = "Ada Memo/Undangan Internal Perlu KOREKSI/ACC di ekfpb.com!"; //subyek email
$mail->AddAddress("$ef[cEmail2]","$ef[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $ef[cNama], <br>Ada konsep Memo/Undangan Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep memo/undangan dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi memo/undangan yaitu edit memo/undangan (klik gambar pena), edit list penerima, memo dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Memo/Undangan Perihal : $_POST[perihal]<br>
Isi Memo/Undangan :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Memo/Undangan berhasil tersimpan dan email terkirim ke atasan langsung, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Memo/Undangan berhasil tersimpan tetapi email ke atasan langsung gagal terkirim, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
}
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
}
}

// Input spptek
elseif ($act=='tambah2'){
/*
if ($_POST[jenispptek]=="" OR $_POST[jenispptek]=="Teknik"){
	echo "<script>window.alert('Jenis SPPTek belum dipilih, silahkan kembali!');self.history.back();</script>";	 
}
else {
*/
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
  $teknik = "<hr><center><b><u>Di isi Bagian Teknik (Manual)</u></b></center>
<table border=1 width=100%><tr><td>Tanggal Selesai Pengecekan :  ----> Hasil Pengecekan & Barang/jasa yang diperlukan (bisa ditulis ditabel atas) <br>......<br><br>Oleh : .....</td></tr>
<tr><td><br>
No. Notif/ Order/ PR (SAP) : ...................................       Tgl. Buat : ..........         Tgl. Barang Datang : .........</td></tr>
<tr><td><br>Tgl Mulai Pengerjaan : ...........        Tgl Selesai Pengerjaan : ...........      Tgl Rework (jika ada) : ..........     </td></tr>
<tr><td>Keterangan (Oleh Teknik) : ...<br></td></tr>
<tr><td>Keterangan (Oleh User) : ...<br></td></tr>
</table>";

if ($_POST['lokasi']=="-") {
    
$lokasi = $_POST['lokasi2'];    
}
else
{
$lokasi = $_POST['lokasi'];      
}

if ($_POST['aktiva']=="-") {
    
$aktiva = $_POST['aktiva2'];    
}
else
{
$aktiva = $_POST['aktiva'];      
}


  UploadSinter($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
if($_SESSION['bagian2']=='PTK'){

    
    $e = mysql_fetch_array(mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'"));		
    $tgl_sekarang = date("Y-m-d");
    $tgl1			 = date("Y-m-d");
    $thn			 = date("Y");
    $bln			 = date("m/Y");
    $query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%/$_SESSION[jabatan]/$thn%'";
    //$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%TeknikPL/$thn%'";
    $hasil = mysql_query($query);
    $hitung = mysql_num_rows($hasil);
    $data  = mysql_fetch_array($hasil); 
    $idMax = $data['max_no'];
    $noUrut = (int) substr($idMax, 0, 3);
    $noUrut++;

	$nospptek = sprintf("%03s/$_SESSION[jabatan]/$thn", $noUrut);
	
	
 	if ($_POST['pengirim1']=="ya"){
 	    
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO spptek(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   sitgl_cek,
                                   sitgl_mulai,
                                   sitgl_selesai,
                                   sitgl_selesai2,
                                   penyebab,
                                   siket_teknik,
                                   siket,
								   sstatus) 
	                     VALUES('$nospptek',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Selesai',
								'$_SESSION[jabatan]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$_POST[penyebab]',
								'$_SESSION[namacv]',
								'$_POST[ket] $teknik',
								'Y')")or die(mysql_error());
			} else {
					    $q=mysql_query("INSERT INTO spptek(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   sitgl_cek,
                                   sitgl_mulai,
                                   sitgl_selesai,
                                   sitgl_selesai2,
                                   penyebab,
                                   siket_teknik,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$nospptek',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Selesai',
								'$_SESSION[jabatan]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$_POST[penyebab]',
								'$_SESSION[namacv]',
								'$_POST[ket] $teknik',
								'Y',
								'$nama_file_unik')")or die(mysql_error());
				
			}
	} else {
		if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO spptek(sinmr,
		                           sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   sitgl_cek,
                                   sitgl_mulai,
                                   sitgl_selesai,
                                   sitgl_selesai2,
                                   penyebab,
                                   siket_teknik,
                                   siket,
								   sstatus) 
	                     VALUES('$nospptek',
	                            '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Selesai',
								'$_SESSION[jabatan]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$_POST[penyebab]',
								'$_SESSION[namacv]',
								'$_POST[ket] $teknik',
								'Y')")or die(mysql_error());
		}else {
			 $q=mysql_query("INSERT INTO spptek(sinmr,
			                       sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   sitgl_selesai,
                                   sitgl_selesai2,
                                   sitgl_cek,
                                   sitgl_mulai,
                                   penyebab,
                                   siket_teknik,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$nospptek',
	                            '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Selesai',
								'$_SESSION[jabatan]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$tgl1',
								'$_POST[penyebab]',
								'$_SESSION[namacv]',
								'$_POST[ket] $teknik',
								'Y',
								'$nama_file_unik')")or die(mysql_error());
		}
	}
							
		
  if ($q){
    echo "<script>window.alert('Data SPPTEK tersimpan');window.location=('../../home.php?pages=sintertp')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

 
 
 // END PTK
 
    
}elseif($_POST['pengirim1']=="tidak" AND $_POST['pengirim2']=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'N')")or die(mysql_error());
							
        //     $ide = mysql_insert_id();

        //     $kode = $_POST['kode'];
        //     $nama = $_POST['nama'];
        //     $satuan =  $_POST['satuan'];
        //     $jumlah =  $_POST['jumlah'];
        //     $keterangan = $_POST['keterangan'];
            
        
        //     $count = count($kode);
            
        
        // for($i = 0; $i < $count; $i++){
        // $cek = mysql_query("INSERT INTO barang_teknik(idspptek, kode, nama, satuan, jumlah, keterangan) VALUES('$ide','$kode[$i]', '$nama[$i]', '$satuan[$i]', '$jumlah[$i]', '$keterangan[$i]')");
        // }
	}
	else {
	 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
      if ($q){
    // 	 thread_create_teknik();
     echo "<script>window.alert('Data Tersimpan! Silahkan langsung klik ACC/Kirim (tidak perlu pilih penerima');window.location=('../../home.php?pages=sintertp')</script>";
    /*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
    </h4></center>";
    
    
    echo"
    <script>
            var timer = setTimeout(function() {
                window.location='../../home.php?pages=sinter'
            }, 3000);
    </script>";
    */
      }
} elseif ($_POST['pengirim1']!="tidak" AND $_POST['pengirim2']=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
								   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
          if ($q){
            echo "<script>window.alert('Data tersimpan, menunggu koreksi/acc atasan');window.location=('../../home.php?pages=spptek')</script>";
          }else{
            echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
          }

} elseif ($_POST['pengirim1']!="tidak" AND $_POST['pengirim2']!="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
// 	 thread_create_teknik();
 echo "<script>window.alert('Data tersimpan, menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sintertp')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }
}
else{
	if ($_POST['pengirim1']=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO spptek(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N')");
			}
			else {
							 $q=mysql_query("INSERT INTO spptek(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[peneybab]',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");
				
			}
	}
	else {
		if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N')");
		}
		else {
			 $q=mysql_query("INSERT INTO spptek(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   penyebab,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[penyebab]',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");
		}
	}
							
		
  if ($q){
/*
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));

$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$ef[cNama]',
                                '$ef[cEmail2]',
								'Ada Konsep Memo/Undangan Internal Perlu KOREKSI/ACC di ekfpb.com!',
'Yth. $ef[cNama], <br>Ada konsep Memo/Undangan Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep memo/undangan dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi memo/undangan yaitu edit memo/undangan (klik gambar pena), edit list penerima, memo dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Memo/Undangan Perihal : $_POST[perihal]<br>
Isi Memo/Undangan :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
// thread_create_teknik();
echo "<script>window.alert('Data tersimpan, menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sintertp')</script>";


/*
$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));

include "classes/class.phpmailer.php";
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
$mail->Subject = "Ada Memo/Undangan Internal Perlu KOREKSI/ACC di ekfpb.com!"; //subyek email
$mail->AddAddress("$ef[cEmail2]","$ef[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $ef[cNama], <br>Ada konsep Memo/Undangan Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep memo/undangan dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi memo/undangan yaitu edit memo/undangan (klik gambar pena), edit list penerima, memo dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Memo/Undangan Perihal : $_POST[perihal]<br>
Isi Memo/Undangan :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Memo/Undangan berhasil tersimpan dan email terkirim ke atasan langsung, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Memo/Undangan berhasil tersimpan tetapi email ke atasan langsung gagal terkirim, <br><a href=../../home.php?pages=sinter>KLIK DISINI</a> untuk kembali!
</h4></center>";

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sinter'
        }, 3000);
</script>";
*/
	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
}
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
/*   
}
*/
}

// Input Data Barang Gudang
elseif ($act=='tambahbarang'){
    
	$tanggal_sekarang =  date("Y-m-d");
    $sg	=	mysql_query("INSERT INTO barang_teknik(kode,
                                               nama,
            								   satuan,
            								   jumlah,
											   tanggal,
											   harga,
											   lokasi,
                                               keterangan) 
            	                     VALUES('$_POST[kode_barang]',
                                            '$_POST[nama]',
            								'$_POST[satuan]',
            								'$_POST[jumlah]',
											'$tanggal_sekarang',
            								'$_POST[harga]',
            								'$_POST[lokasi]',
            								'$_POST[keterangan]'
    )");
    $tr	=	mysql_query("INSERT INTO transaksi_stok_teknik(kode_barang,
								nama,
								satuan,
								stok_masuk,
								tanggal,
								keterangan)
								VALUES('$_POST[kode_barang]',
								'$_POST[nama]',
								'$_POST[satuan]',
								'$_POST[jumlah]',
								'$tanggal_sekarang',
								'$_POST[keterangan]'
    )");
    
	if ($sg){
		echo "<script>
			window.alert('Data Barang Tersimpan');
			window.location = ('../../home.php?pages=barangtek')
		</script>";
		}else{
		echo "<script>
			window.alert('Data Gagal Tersimpan');
			self.history.back();
		</script>";
		}
}
elseif ($act=='tambahtransaksi'){
    $tgl_sekarang 	= date("Y-m-d");
	
            if($_POST['jenis'] == 'masuk'){
            	  $tr=mysql_query("INSERT INTO transaksi_stok_teknik(kode_barang,
                                               nama,
                                               sinmr,
            								   satuan,
            								   stok_masuk,
											   tanggal,
                                               keterangan) 
            	                     VALUES('$_POST[kode_barang]',
                                            '$_POST[nama]',
                                            '$_POST[sinmr]',
            								'$_POST[satuan]',
            								'$_POST[stok]',
											'$tgl_sekarang',
            								'$_POST[keterangan]'
            								)");
            					   
				    $bt		= mysql_fetch_array(mysql_query("SELECT kode, jumlah FROM barang_teknik WHERE kode='$_POST[kode_barang]'"));	
                    $juml 	= $bt['jumlah'];
                    $hasil 	= $juml + $_POST['stok'];
                    if($bt['kode'] != $_POST['kode_barang']){
                            $cek = mysql_query("INSERT INTO barang_teknik(kode,
                                                       nama,
                    								   satuan,
                    								   jumlah,
													   status,
                                                       keterangan) 
                    	                     VALUES('$_POST[kode_barang]',
                                                    '$_POST[nama]',
                    								'$_POST[satuan]',
                    								'$hasil',
													'Approve',
                    								'$_POST[keterangan]'
                    								)");
                    }else{
                        $cek = mysql_query("UPDATE barang_teknik SET nama='$_POST[nama]', satuan='$_POST[satuan]', jumlah='$hasil', status='Barang Datang', keterangan='$_POST[keterangan]' WHERE kode='$_POST[kode_barang]'");
                        // $approve = mysql_query("UPDATE barang_teknik SET status = 'Approve' WHERE kode = '$_POST[kode_barang]'");
                    }
            
            }elseif ($_POST['jenis'] == 'keluar'){

                $tr=mysql_query("INSERT INTO transaksi_stok_teknik(kode_barang,
                                               nama,
                                               sinmr,
            								   satuan,
            								   stok_keluar,
											   tanggal,
                                               keterangan) 
            	                     VALUES('$_POST[kode_barang]',
                                            '$_POST[nama]',
                                            '$_POST[sinmr]',
            								'$_POST[satuan]',
            								'$_POST[stok]',
											'$tgl_sekarang',
            								'$_POST[keterangan]'
            								)");
            								
            				$bt 	= mysql_fetch_array(mysql_query("SELECT kode, jumlah FROM barang_teknik WHERE kode='$_POST[kode_barang]'"));	
                            $juml 	= $bt['jumlah'];
                            $hasil 	= $juml - $_POST['stok'];
                            
                            if($bt['kode'] != $_POST['kode_barang']){
                                    $cek = mysql_query("INSERT INTO barang_teknik(kode,
                                                               nama,
                            								   satuan,
                            								   jumlah,
															   tanggal,
															   status,
                                                               keterangan) 
                            	                     VALUES('$_POST[kode_barang]',
                                                            '$_POST[nama]',
                            								'$_POST[satuan]',
                            								'$hasil',
															'$tgl_sekarang',
															'Approve',
                            								'$_POST[keterangan]'
                            								)");
                            }else{
                                    
									$cek = mysql_query("UPDATE barang_teknik SET nama='$_POST[nama]', satuan='$_POST[satuan]', jumlah='$hasil', status='Approve',keterangan='$_POST[keterangan]' WHERE kode='$_POST[kode_barang]'");
                                    // $approve = mysql_query("UPDATE barang_teknik SET status='Approve' WHERE kode='$_POST[kode_barang]'");
                        	}
                                
            }
            		
            
	if ($cek){
// 	thread_create_teknik();
	echo "<script>
		window.alert('Transaksi Tersimpan');
		window.location = ('../../home.php?pages=barangtek&act=detailbarang&kode=$_POST[kode_barang]')
	</script>";

	}else{

	echo "<script>
		window.alert('Transaksi Gagal Tersimpan');
		self.history.back();
	</script>";

	}

}elseif ($act=='approvestok'){

			$bt 		= mysql_fetch_array(mysql_query("SELECT kode, jumlah FROM barang_teknik WHERE kode='$_POST[kode_barang]'"));	
            $juml 		= $bt['jumlah'];
            $hasil 		= $juml + $_POST['jumlah'];
            $tgl_sekarang = date ("Y-m-d");
            
            // var_dump($bt);die();
            if($bt['kode'] != $_POST['kode_barang']){

                    $cek = mysql_query("INSERT INTO barang_teknik(kode,
						nama,
						satuan,
						jumlah,
						status,
						keterangan)
						VALUES('$_POST[kode_barang]',
						'$_POST[nama]',
						'$_POST[satuan]',
						'$_POST[jumlah]',
						'Barang Datang',
						'$_POST[keterangan]'
                    )");

					$tglbarangdatang = mysql_query("UPDATE spptek SET sitgl_brgdtg='$tgl_sekarang', sikomen2='Belum-Barang' WHERE siid='$_POST[idspptek]'");

            		$tr = mysql_query("INSERT INTO transaksi_stok_teknik(kode_barang,
						nama,
						satuan,
						stok_masuk,
						tanggal,
						status,
						keterangan)
						VALUES('$_POST[kode_barang]',
						'$_POST[nama]',
						'$_POST[satuan]',
						'$_POST[jumlah]',
						'$tgl_sekarang',
						'Barang Datang',
						'$_POST[keterangan]'
            		)");

					$pesanan = mysql_query("UPDATE pesanan_barangtek SET status='Barang Datang' WHERE id_pesanantek='$_POST[idpesanantek]'");
					
            }else{
                $nama       = $_POST['nama'];
                $satuan     = $_POST['satuan'];
                $jumlah     = $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                
				$cek 		= mysql_query("UPDATE barang_teknik SET nama='$_POST[nama]', satuan='$_POST[satuan]', jumlah='$hasil', status='Barang Datang', keterangan='$_POST[keterangan]' WHERE kode='$_POST[kode_barang]'");
                $tglbarangdatang = mysql_query("UPDATE spptek SET sitgl_brgdtg='$tgl_sekarang', sikomen2='Belum-Barang' WHERE siid='$_POST[idspptek]'");
				
                $tr 		= mysql_query("INSERT INTO transaksi_stok_teknik(kode_barang,
                                              nama,
            								  satuan,
            								  stok_masuk,
            								  tanggal,
											  status,
                                              keterangan) 
            	                     VALUES('$_POST[kode_barang]',
                                            '$_POST[nama]',
            								'$_POST[satuan]',
            								'$_POST[jumlah]',
            								'$tgl_sekarang',
											'Barang Datang',
            								'$_POST[keterangan]'
            								)");
				
				$pesanan = mysql_query("UPDATE pesanan_barangtek SET status='Barang Datang' WHERE id_pesanantek='$_POST[idpesanantek]'");
            }
			if ($tr){
				echo "<script>
					window.alert('Barang Telah Datang');
					window.location = ('../../home.php?pages=pesananbarangtek')
				</script>";
			}else{
				echo "<script>
					window.alert('Data Gagal Tersimpan');
					self.history.back();
				</script>";
			}
}
//ACC PERMINTAAN BARANG
elseif ($act=='approvebarang'){
		$approve = mysql_query("UPDATE spptek SET accpesanbarang='Y', sikomen2='Menunggu Barang' WHERE siid='$_POST[siid]'");
	    $get = mysql_query("SELECT * FROM pesanan_barangtek WHERE id_spptek='$_POST[siid]'");
		// $app = mysql_query("UPDATE transaksi_stok_teknik SET status='Approve' WHERE id_spptek='$_POST[siid]'");
		$kode = $_POST['siid'];
                $ap = 'Approve';
                
                $count = count($get);
				// var_dump($get);die();
				if($count > 0){
					$cek = mysql_query("UPDATE pesanan_barangtek SET status='Approve' WHERE id_spptek='$kode'");
				}else{
					for($i = 0; $i < $count; $i++){
						$cek = mysql_query("UPDATE pesanan_barangtek SET status='$ap[$i]' WHERE id_spptek='$kode'");
					}
				}
                

	if ($cek){

	echo "<script>
		window.alert('Data Berhasil Di Approve');
		window.location = ('../../home.php?pages=approvebarangtek')
	</script>";

	}else{

	echo "<script>
		window.alert('Data Gagal Di Approve');
		self.history.back();
	</script>";

	}
}elseif ($act=='tambahajax'){
   
    mysql_query("UPDATE spptek SET status = 'CEKKKK' WHERE siid = '$_POST[siid]'");
  echo json_encode(['status' => 'sukses']);
}elseif ($act=='coba'){
	$arr = array();
	$hasil = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[id]'"));
	// while($row = mysql_fetch_assoc($hasil)){
	// 	$arr[] = $row[nama];
	// }
	$data[nama] = $hasil[nama];
	$data[satuan] = $hasil[satuan];
	
	echo json_encode($data);
	// var_dump(json_encode($arr));die();
}
// Input Permintaan IT
elseif ($act=='tambah4'){

if ($_POST[jenispptek]==""){
	echo "<script>window.alert('Jenis permintaan belum dipilih, silahkan kembali!');self.history.back();</script>";	 
}
else {

if ($_POST[jenispptek]=="lainnya"){
    $id = 75;
}
else
{
    $id = 3;
}

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  


  UploadSinter($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  
if ($_POST[pengirim1]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$id',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Diterima',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[ket] $teknik',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$id',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum diterima',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Data Tersimpan! Silahkan langsung klik ACC/Kirim (tidak perlu pilih penerima');window.location=('../../home.php?pages=sinterit')</script>";

  }
} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]!="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'3',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Diterima',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[ket] $teknik',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'3',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Diterima',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Data tersimpan, menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinterit')</script>";

  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 

  }
}
else{}
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
 
}

}

// Input 
if ($act=='tambah3'){
if ($_POST[ket]==""){
	echo "<script>window.alert('Isi Memo kosong, silahkan kembali!');self.history.back();</script>";	 
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
  
  UploadSinter($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
  
if ($_POST[pengirim1]=="tidak" AND $_POST[pengirim2]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'23',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Data Tersimpan! Menunggu ACC');window.location=('../../home.php?pages=sinterm')</script>";

  }
} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinterm')</script>";

  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 

  }

} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]!="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N')");
	}
	else {
	 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinterm')</script>";

  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 

  }
}
else{
	if ($_POST[pengirim1]=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO sinter(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N')");
			}
			else {
							 $q=mysql_query("INSERT INTO sinter(sinmr,
                                   sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
				
			}
	}
	else {
		if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N')");
		}
		else {
			 $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
								   jenispptek,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[jenispptek]',
								'$_POST[ket]',
								'N',
								'$nama_file_unik')");
		}
	}
							
		
  if ($q){

echo "<script>window.alert('Memo/Undangan tersimpan, pilih penerima dan menunggu koreksi/acc atasan');window.location=('../../home.php?pages=sinterm')</script>";

	  
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
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
    
     $q=mysql_query("UPDATE sinter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
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
  UploadSinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM sinter WHERE siid='$_GET[id]'"));
unlink("../../sinternal/$data[sifile]"); 

  $q=mysql_query("UPDATE sinter SET sinmr   = '$_POST[nomor]',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
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
    //   thread_sync_participant(intval($_GET['id']));
	  echo "<script>window.alert('Memo/Undangan berhasil Terupdate');window.location=('../../home.php?pages=sinter')</script>";
  }else{
       echo "<script>window.alert('Memo/Undangan Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}
// edit spptek
elseif($act=='edit2'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
  
  $input_pr = isset($_POST['pr']) ? $_POST['pr'] : "";
  $input_jenispptek = isset($_POST['jenispptek']) ? $_POST['jenispptek'] : "";
  $input_siketteknik = isset($_POST['siket_teknik']) ? $_POST['siket_teknik'] : "";
  $input_nomor = isset($_POST['nomor']) ? $_POST['nomor'] : "";
  $input_perihal = isset($_POST['perihal']) ? $_POST['perihal'] : "";
  $input_sikomen = isset($_POST['sikomen']) ? $_POST['sikomen'] : "";
  $input_sikomen2 = isset($_POST['sikomen2']) ? $_POST['sikomen2'] : '0000-00-00';
  $input_tglorder = isset($_POST['tgl_order']) ? $_POST['tgl_order'] : '0000-00-00';
  $input_tglbrgdtg = isset($_POST['tgl_brgdtg']) ? $_POST['tgl_brgdtg'] : '0000-00-00';
  $input_tglpending = isset($_POST['tgl_pending']) ? $_POST['tgl_pending'] : '0000-00-00';
  $input_tglrework = isset($_POST['tgl_rework']) ? $_POST['tgl_rework'] : '0000-00-00';
  $input_tglcek = isset($_POST['tgl_cek']) ? $_POST['tgl_cek'] : '0000-00-00';
  $input_tglmulai = isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : '0000-00-00';
  $input_tglselesai = isset($_POST['tgl_selesai']) ? $_POST['tgl_selesai'] : '0000-00-00';
  $input_ket = isset($_POST['ket']) ? $_POST['ket'] : "";
  $input_tindakperbaikan = isset($_POST['tindakan_perbaikan']) ? $_POST['tindakan_perbaikan'] : "";
  $input_tindakpencegahan = isset($_POST['tindakan_pencegahan']) ? $_POST['tindakan_pencegahan'] : "";
  $input_siketuser = isset($_POST['siket_user']) ? $_POST['siket_user'] : "";
  $input_wp = isset($_POST['wp']) ? $_POST['wp'] : 'N';
  $input_rfq = isset($_POST['rfq']) ? $_POST['rfq'] : "";
  $input_po = isset($_POST['po']) ? $_POST['po'] : "";
  $input_pihak3 = isset($_POST['pihak3']) ? $_POST['pihak3'] : 'N';
  $input_kode = isset($_POST['kode']) ? $_POST['kode'] : "";
  $input_tgl = isset($_POST['tgl']) ? $_POST['tgl'] : "";
  $input_jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : "";
  $input_jenisms = isset($_POST['jenisms']) ? $_POST['jenisms'] : "";

if ($_POST['lokasi']=="-" OR $_POST['lokasi']=="") {
    
$lokasi = $_POST['lokasi2'];    
}
else
{
$lokasi = $_POST['lokasi'];      
}

if ($_POST['aktiva']=="-" OR $_POST['aktiva']=="") {
    
$aktiva = $_POST['aktiva2'];    
}
else
{
$aktiva = $_POST['aktiva'];      
}


$e = mysql_fetch_array(mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'"));		
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%/$input_jenispptek/$thn%'";
//$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%TeknikPL/$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 0, 3);
$noUrut++;
$orangtek = implode(",", (array)$input_siketteknik);

    if($input_jenispptek == ""){
		$newID = '';
	}else{
		if($_POST['jenispptek'] != $e['jenispptek']){
			$newID = sprintf("%03s/$input_jenispptek/$thn", $noUrut);
		}else{
			$newID = $e['sinmr'];
		}
	}

if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
$e = mysql_fetch_array(mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'"));	
    if ($e['sinmr']!='' AND $_POST['nomor']!='' AND $e['wp']=='N' AND $_POST['wp']=='Y'){
    
     $r=mysql_query("INSERT INTO pstek(cId,siid) VALUES (62,'$_GET[id]')");
     
     $q=mysql_query("UPDATE spptek SET sinmr   = '$newID',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$input_jenispptek',								   
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_pending ='$_POST[tgl_pending]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   tindakan_pencegahan	 = '$_POST[tindakan_pencegahan]',
								   tindakan_perbaikan	 = '$_POST[tindakan_perbaikan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$orangtek',
								   wp = '$_POST[wp]',
								   pr = '$_POST[pr]',
								   rfq = '$_POST[rfq]',
								   po = '$_POST[po]',
								   kode_do = '$_POST[kode_do]',
								   gr_entrysheet = '$_POST[gr_entrysheet]',
								   pihak3 = '$_POST[pihak3]'
								   WHERE siid = '$_GET[id]'") or die(mysql_error());
				
			$ide = mysql_insert_id();
			$bt = mysql_fetch_array(mysql_query("SELECT kode, id_brg_teknik, jumlah FROM barang_teknik WHERE idspptek='$_GET[id]'"));	
 			
 			if($_POST[jenispptek] != ''){
				    mysql_query("UPDATE pstek SET sistatus='Y' WHERE spptek_id='$_GET[id]'");
			}
			
            foreach ($_POST['kode'] as $key => $value) {
                $value;
            }
            foreach ($_POST['jumlah'] as $key => $jml) {
                $jml;
            }
            $juml = $bt[jumlah];
            $hasil = $juml + $jml;
            if($bt[kode] != $value){
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                
                for($i = 0; $i < $count; $i++){
                    // $cek = mysql_query("INSERT INTO barang_teknik(idspptek, kode, nama, satuan, jumlah, keterangan) VALUES('$_GET[id]','$kode[$i]', '$nama[$i]', '$satuan[$i]', '$jumlah[$i]', '$keterangan[$i]')");
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
            }else{
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                for($i = 0; $i < $count; $i++){
                    // $cek = mysql_query("UPDATE barang_teknik SET nama = '$nama[$i]', satuan = '$satuan[$i]', jumlah = '$hasil', keterangan = '$keterangan[$i]' WHERE kode = '$value'");
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
                
            }
                            
    }elseif ($e['sinmr']=='' AND $input_nomor=='' AND $input_jenispptek!=''){
    
     $q = mysql_query("UPDATE spptek SET sinmr  = '$newID',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$_POST[jenispptek]',								   
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_pending ='$_POST[tgl_pending]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   tindakan_pencegahan	 = '$_POST[tindakan_pencegahan]',
								   tindakan_perbaikan	 = '$_POST[tindakan_perbaikan]',
								   personil	 = '$_POST[personil]',				   
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$orangtek',
								   wp = '$_POST[wp]',
								   pr = '$_POST[pr]',
								   rfq = '$_POST[rfq]',
								   po = '$_POST[po]',
								   kode_do = '$_POST[kode_do]',
								   gr_entrysheet = '$_POST[gr_entrysheet]',
								   pihak3 = '$_POST[pihak3]'
								   WHERE siid = '$_GET[id]'");
			
	    	$ide = mysql_insert_id();
			$bt = mysql_fetch_array(mysql_query("SELECT kode, id_brg_teknik, jumlah FROM barang_teknik WHERE idspptek='$_GET[id]'"));	
 			
 			
 			if($_POST[jenispptek] != ''){
				    mysql_query("UPDATE pstek SET sistatus='Y' WHERE spptek_id='$_GET[id]'");
			}
			
            foreach ($_POST['kode'] as $key => $value) {
                $value;
            }
            foreach ($_POST['jumlah'] as $key => $jml) {
                $jml;
            }
            $juml = $bt['jumlah'];
            $hasil = $juml + $jml;
            if($bt['kode'] != $value){
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                
                for($i = 0; $i < $count; $i++){
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
                }
            }else{
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                for($i = 0; $i < $count; $i++){
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
                
            }
								   
    }
    else
       {
           if($input_nomor!=null){
                $q=mysql_query("UPDATE spptek SET sinmr   = '$newID',
                                   sitgl 	  = '$input_tgl',
								   jenisms	 = '$input_jenisms',
								   jenispptek	 = '$input_jenispptek',								   
                                   siperihal = '$input_perihal',
								   sikomen = '$input_sikomen',
								   sikomen2 = '$input_sikomen2',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$input_tglbrgdtg',
								   sitgl_cek ='$input_tglcek',
								   sitgl_mulai ='$input_tglmulai',
								   sitgl_selesai ='$input_tglselesai',
								   sitgl_pending ='$input_tglpending',
								   sitgl_rework ='$input_tglrework',
								   siket	 = '$input_ket',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   tindakan_perbaikan	 = '$input_tindakperbaikan',
								   tindakan_pencegahan	 = '$input_tindakpencegahan',
								   personil	 = '$_POST[personil]',
								   siket_user = '$input_siketuser',
								   siket_teknik = '$orangtek',
								   wp = '$input_wp',
								   pr = '$input_pr',
								   rfq = '$input_rfq',
								   po = '$input_po',
								   pihak3 = '$input_pihak3'
								   WHERE siid = '$_GET[id]'");
           }else{
                $q=mysql_query("UPDATE spptek SET sinmr   = '$newID',
                                   sitgl 	  = '$input_tgl',
								   jenisms	 = '$input_jenisms',
								   jenispptek	 = '$input_jenispptek',								   
                                   siperihal = '$input_perihal',
								   sikomen = '$input_sikomen',
								   sikomen2 = '$input_sikomen2',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sstatus ='$_POST[status]',
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$input_tglbrgdtg',
								   sitgl_cek ='$input_tglcek',
								   sitgl_mulai ='$input_tglmulai',
								   sitgl_selesai ='$input_tglselesai',
								   sitgl_pending ='$input_tglpending',
								   sitgl_rework ='$input_tglrework',
								   siket	 = '$input_ket',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   tindakan_perbaikan	 = '$input_tindakperbaikan',
								   tindakan_pencegahan	 = '$input_tindakpencegahan',
								   personil	 = '$_POST[personil]',
								   siket_user = '$input_siketuser',
								   siket_teknik = '$orangtek',
								   wp = '$input_wp',
								   pr = '$input_pr',
								   rfq = '$input_rfq',
								   po = '$input_po',
								   pihak3 = '$input_pihak3'
								   WHERE siid = '$_GET[id]'")or die(mysql_error());
           }
			//running
			$ide = mysql_insert_id();
			$bt = mysql_fetch_array(mysql_query("SELECT kode_barang, jumlah FROM pesanan_barangtek WHERE id_spptek='$_GET[id]'"));	
	        
	        if($input_jenispptek != ''){
				    mysql_query("UPDATE pstek SET sistatus='Y' WHERE spptek_id='$_GET[id]'");
			}
			if(is_array($input_kode) || is_object($input_kode)){
                foreach ($input_kode as $key => $value) {
                    $value;
                }
			}
            if(is_array($input_jumlah) || is_object($input_jumlah)){
                foreach ($input_jumlah as $key => $jml) {
                    $jml;
                }
            }
            $juml = $bt['jumlah'];
            $hasil = $juml + isset($jml) ? $jml : '';
            if(!empty($_POST['kode'])){
                if($bt['kode'] != $value){
                    $kode = $_POST['kode'];
                    $nama = $_POST['nama'];
                    $satuan =  $_POST['satuan'];
                    $jumlah =  $_POST['jumlah'];
                    $keterangan = $_POST['keterangan'];
                    $user = $_SESSION['cv'];
                    
                    $count = count($kode);
                    if($kode != null){
                        for($i = 0; $i < $count; $i++){
                            $cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
                        }
                    }
                }else{
                    $kode = $_POST['kode'];
                    $nama = $_POST['nama'];
                    $satuan =  $_POST['satuan'];
                    $jumlah =  $_POST['jumlah'];
                    $keterangan = $_POST['keterangan'];
    				$user = $_SESSION['cv'];
                    
                    $count = count($kode);
                    if($kode != null){
                        for($i = 0; $i < $count; $i++){
                            // $cek = mysql_query("UPDATE transaksi_stok_teknik SET nama='$nama[$i]', satuan='$satuan[$i]', jumlah='$hasil', keterangan='$keterangan[$i]' WHERE kode_barang='$value'");
        					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
                        
                        }
                    }
                    
                }
            }
    }
}else {
UploadSinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM sinter WHERE siid='$_GET[id]'"));
unlink("../../sinternal/$data[sifile]");

$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));
   if ($_POST[jenispptek]=='' && $e[sstatus]=='N'){
    
     $q=mysql_query("UPDATE spptek SET sinmr   = '$newID',
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
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_pending ='$_POST[tgl_pending]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   tindakan_perbaikan	 = '$_POST[tindakan_perbaikan]',
								   tindakan_pencegahan	 = '$_POST[tindakan_pencegahan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$orangtek',
								   wp = '$_POST[wp]',
								   pr = '$_POST[pr]',
								   rfq = '$_POST[rfq]',
								   po = '$_POST[po]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");
								   
		    $ide = mysql_insert_id();
			$bt = mysql_fetch_array(mysql_query("SELECT kode, id_brg_teknik FROM barang_teknik WHERE idspptek='$_GET[id]'"));	

            if($_POST[jenispptek] != ''){
				    mysql_query("UPDATE pstek SET sistatus='Y' WHERE spptek_id='$_GET[id]'");
			}

            $idbarang = $bt[id_brg_teknik];
            // var_dump($idbarang);
            if(!empty($_POST['kode'])){
                if($bt[kode] != $_POST['kode']){
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan = $_POST['satuan'];
                $jumlah = $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $satuan = $_POST['satuan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                
                for($i = 0; $i < $count; $i++){
    				$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
    			}
                }else{
                     $q=mysql_query("UPDATE barang_teknik SET kode   = '$_POST[kode]',
                                       satuan 	  = '$_POST[satuan]',
    								   nama	 = '$_POST[nama]',
    								   jumlah = '$_POST[jumlah]',
    								   keterangan    = '$_POST[keterangan]'
    								   WHERE id_brg_teknik = '$idbarang'");
                }
            }
                            
    }
    elseif ($_POST['jenispptek']!='' AND $e['sstatus']=='N' || $_POST['jenispptek']!='' AND $e['sstatus']=='Y'){
    
     $q=mysql_query("UPDATE spptek SET sinmr  = '$newID',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	  = '$_POST[jenisms]',
								   jenispptek = '$_POST[jenispptek]',								   
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_pending ='$_POST[tgl_pending]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   personil	 = '$_POST[personil]',
								   tindakan_pencegahan	 = '$_POST[tindakan_pencegahan]',
								   tindakan_perbaikan	 = '$_POST[tindakan_perbaikan]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$orangtek',
								   sstatus = 'Y',
								   wp = '$_POST[wp]',
								   pr = '$_POST[pr]',
								   rfq = '$_POST[rfq]',
								   po = '$_POST[po]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");
			$ide = mysql_insert_id();
			$bt = mysql_fetch_array(mysql_query("SELECT kode, id_brg_teknik, jumlah FROM barang_teknik WHERE idspptek='$_GET[id]'"));	

            if($_POST[jenispptek] != ''){
				    mysql_query("UPDATE pstek SET sistatus='Y' WHERE spptek_id='$_GET[id]'");
			}
			
            foreach ($_POST['kode'] as $key => $value) {
                $value;
            }
            foreach ($_POST['jumlah'] as $key => $jml) {
                $jml;
            }
            $juml = $bt[jumlah];
            $hasil = $juml + $jml;
            if(!empty($_POST['kode'])){
            if($bt[kode] != $value){
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $satuan = $_POST['satuan'];
                $count = count($kode);
                
                for($i = 0; $i < $count; $i++){
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
            }else{
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                for($i = 0; $i < $count; $i++){
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
                
            }
            }
    }else{

     $q=mysql_query("UPDATE spptek SET sinmr   = '$newID',
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
								   sitgl_order ='$input_tglorder',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_pending ='$_POST[tgl_pending]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   penyebab	 = '$_POST[penyebab]',
								   personil	 = '$_POST[personil]',
								   tindakan_pencegahan	 = '$_POST[tindakan_pencegahan]',
								   tindakan_perbaikan	 = '$_POST[tindakan_perbaikan]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$orangtek',
								   wp = '$_POST[wp]',
								   pr = '$_POST[pr]',
								   rfq = '$_POST[rfq]',
								   po = '$_POST[po]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");
			$ide = mysql_insert_id();
			$bt = mysql_fetch_array(mysql_query("SELECT kode, id_brg_teknik, jumlah FROM barang_teknik WHERE idspptek='$_GET[id]'"));	

            if($_POST[jenispptek] != ''){
				    mysql_query("UPDATE pstek SET sistatus='Y' WHERE spptek_id='$_GET[id]'");
			}
			
            foreach ($_POST['kode'] as $key => $value) {
                $value;
            }
            foreach ($_POST['jumlah'] as $key => $jml) {
                $jml;
            }
            $juml = $bt[jumlah];
            $hasil = $juml + $jml;
            if(!empty($_POST['kode'])){
            if($bt[kode] != $value){
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $satuan = $_POST['satuan'];
                $keterangan = $_POST['keterangan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                
                for($i = 0; $i < $count; $i++){
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
            }else{
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $satuan =  $_POST['satuan'];
                $jumlah =  $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $satuan = $_POST['satuan'];
                $user = $_SESSION[cv];
                $count = count($kode);
                for($i = 0; $i < $count; $i++){
					$cek = mysql_query("INSERT INTO pesanan_barangtek(id_spptek, id_user, kode_barang, nama, jumlah, satuan, keterangan) VALUES('$_GET[id]', '$user','$kode[$i]', '$nama[$i]', '$jumlah[$i]', '$satuan[$i]','$keterangan[$i]')");
				}
                
            }
            }
    }

}
								   
								   
  if ($q){
//   thread_sync_participant(intval($_GET['id']));
if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
	if($usr=='usr'){
	    echo "<script>window.alert('SPPTek berhasil di update');window.location=('../../home.php?pages=sintertp')</script>";    
	}elseif($usr=='admin'){
	    echo "<script>window.alert('SPPTek berhasil di update');window.location=('../../home.php?pages=usrtp')</script>";
	}
	
}
else {
    if($usr=='usr'){
	    echo "<script>window.alert('SPPTek berhasil di update');window.location=('../../home.php?pages=sintertp')</script>";    
	}elseif($usr=='admin'){
	    echo "<script>window.alert('SPPTek berhasil di update');window.location=('../../home.php?pages=usrtp')</script>";
	}
}
  }else{
    //   echo "<script>window.alert('Gagal Update');self.history.back();</script>";
       echo "<script>window.alert('Gagal Update');</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}elseif($act=='closespptek'){
	$tanggal = $_POST['sitgl_selesai'];
	$cek = mysql_query("UPDATE spptek SET sikomen2='Close Teknik', sitgl_selesai='$_POST[sitgl_selesai]' WHERE
	siid='$_GET[id]'");

	if ($cek){
		
	echo "<script>window.alert('Data Barang telah Selesai (Teknik)');window.location=('../../home.php?pages=usrtp');</script>";
	}else {
	echo "<script>
		window.alert('Data Barang Gagal di update');
		self.history.back();
	</script>";
	}
}elseif($act=='jenisspptek'){
	$jenispptek = $_POST['jenispptek'];
    
    $tgl_sekarang = date("Y-m-d");
    $thn			 = date("Y");
    $bln			 = date("m/Y");
    $query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%/$jenispptek/$thn%'";
    //$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%TeknikPL/$thn%'";
    $hasil = mysql_query($query);
    $hitung = mysql_num_rows($hasil);
    $data  = mysql_fetch_array($hasil); 
    $idMax = $data['max_no'];

	$noUrut = (int) substr($idMax, 0, 3);
    $noUrut++;
	if($jenispptek == ""){
		$newID = '';
	}else{
		if($_POST['jenispptek'] != $e['jenispptek']){
			$newID = sprintf("%03s/$jenispptek/$thn", $noUrut);
		}else{
			$newID = $e['sinmr'];
		}
	}
	
	$cek = mysql_query("UPDATE spptek SET sinmr  = '$newID', jenispptek='$jenispptek' WHERE
	siid='$_GET[id]'");

	if ($cek){
		
	echo "<script>window.alert('Jenis SPPTek Telah Dipilih...');window.location=('../../home.php?pages=usrtp');</script>";
	}else {
	echo "<script>
		window.alert('Data Barang Gagal di update');
		self.history.back();
	</script>";
	}
}
    
// edit barangtek
elseif($act=='editbarangtek'){

        $q=mysql_query("UPDATE pesanan_barangtek SET kode_barang='$_POST[kode]',satuan='$_POST[satuan]', nama='$_POST[nama]', jumlah='$_POST[jumlah]',keterangan='$_POST[keterangan]' WHERE id_pesanantek='$_GET[id]'");
		
		if ($q){
   			echo "<script>window.alert('Data Barang berhasil di update');window.location=('../../home.php?pages=sintertp')</script>";
        }
        else {
            echo "<script>window.alert('Data Barang Gagal di update');window.location=('../../home.php?pages=sintertp')</script>"; 
        }
}

// edit barangtek
elseif($act=='editbaranggudang'){
  
        $q=mysql_query("UPDATE barang_teknik SET satuan='$_POST[satuan]',nama='$_POST[nama]',jumlah='$_POST[jumlah]',keterangan='$_POST[keterangan]',harga='$_POST[harga]',lokasi='$_POST[lokasi]' WHERE kode='$_POST[kode_barang]'
		");
        
		if ($q){
			echo "<script>
				window.alert('Data Barang berhasil di update');
				window.location = ('../../home.php?pages=barangtek')
			</script>";
        }else {
			echo "<script>
				window.alert('Data Barang Gagal di update!');
				window.location = ('../../home.php?pages=barangtek')
			</script>";
        }
}

// edit pesanan barangtek
elseif($act=='editpesanbarang'){
  
        $q=mysql_query("UPDATE pesanan_barangtek SET satuan='$_POST[satuan]',nama='$_POST[nama]',jumlah='$_POST[jumlah]',keterangan='$_POST[keterangan]' WHERE id_pesanantek='$_GET[id]'
		");
        
		if ($q){
			echo "<script>
				window.alert('Data Pesanan berhasil di update');
				window.location = ('../../home.php?pages=pesananbarangtek')
			</script>";
        }else {
			echo "<script>
				window.alert('Data Barang Gagal di update!');
				window.location = ('../../home.php?pages=pesananbarangtek')
			</script>";
        }
}

// edit transaksi barangtek
elseif($act=='edittransaksibarang'){
  
        
        
        $q=mysql_query("UPDATE transaksi_stok_teknik SET kode_barang   = '$_POST[kode_barang]',
                                   satuan 	  = '$_POST[satuan]',
								   nama	 = '$_POST[nama]',
								   stok_masuk = '$_POST[masuk]',
								   stok_keluar = '$_POST[keluar]',
								   keterangan    = '$_POST[keterangan]'
								   WHERE id_transaksi = '$_GET[id]'");
		if ($q){
   
        	echo "<script>window.alert('Data Barang berhasil di update');window.location=('../../home.php?pages=barangtek')</script>";
        }
        else {
            echo "<script>window.alert('Data Barang Gagal di update');window.location=('../../home.php?pages=barangtek')</script>"; 
        }
}

elseif($act=='edit3'){
 
     $q=mysql_query("UPDATE sinter SET sikomen2 = '$_POST[sikomen2]' WHERE siid = '$_GET[id]'");
     
  if ($q){
	  echo "<script>window.alert('Komentar berhasil Terupdate');window.location=('../../home3.php?pages=sinterm')</script>";
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
    
     $q=mysql_query("UPDATE sinter SET sinmr   = '$_POST[nomor]',
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
  UploadSinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM sinter WHERE siid='$_GET[id]'"));
unlink("../../sinternal/$data[sifile]"); 

  $q=mysql_query("UPDATE sinter SET sinmr   = '$_POST[nomor]',
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
	  echo "<script>window.alert('Memo berhasil Terupdate');window.location=('../../home.php?pages=sinterm')</script>";
  }else{
       echo "<script>window.alert('Memo Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }

  
}

elseif($act=='edit5'){
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
    
     $q=mysql_query("UPDATE sinter SET sinmr   = '$_POST[nomor]',
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
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   pihak3 = '$_POST[pihak3]'
								   WHERE siid = '$_GET[id]'");
}

else {
  UploadSinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM sinter WHERE siid='$_GET[id]'"));
unlink("../../sinternal/$data[sifile]"); 

  $q=mysql_query("UPDATE sinter SET sinmr   = '$_POST[nomor]',
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
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   siket_teknik = '$_POST[siket_teknik]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");

}
								   
								   
  if ($q){
if($_SESSION[levelcv]<1 OR $_SESSION[cv]=='75'){
	  echo "<script>window.alert('Permintaan Sistem IT berhasil di Update');window.location=('../../home.php?pages=usrti')</script>";
}
else {
    echo "<script>window.alert('Permintaan Sistem IT berhasil diedit');window.location=('../../home.php?pages=sinterit')</script>"; 
}
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}
// acc memo internal
elseif ($act=='acc'){
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$bln%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("M-%04s/$_SESSION[nppcv]/$bln", $noUrut);
	
$q=mysql_query("UPDATE spptek SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	  /*
$tgl_sekarang = date ("Y-m-d");
$result = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN pstek b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
						
$result1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN pstek b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'"));


$results = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN tstek b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
						
$results1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN tstek b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'"));
						
$r = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab,b.* FROM users a
						LEFT JOIN sinter b ON b.sipengirim1=a.cId
						WHERE b.siid='$_GET[id]'"));
						
while($e=mysql_fetch_array($result)){
mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Memo/Undangan Internal untuk $e[cNama]!',
								'Yth. $e[cNama], <br>Ada Memo/Undangan Internal di aplikasi http://ekfpb.com untuk anda<br>
Memo/Undangan dari : $r[cNama],<br>
Perihal : $r[siperihal],<br><br>
Untuk baca Memo/Undangan (Detail) silahkan segera login ke http://ekfpb.com<br>
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
								'Yth. $ef[cNama], <br>Ada Tembusan Memo/Undangan Internal di aplikasi http://ekfpb.com untuk anda<br>
Memo/Undangan dari : $r[cNama],<br>
Perihal : $r[siperihal],<br>
Untuk baca Memo/Undangan (Detail) silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/ 
	  echo "<script>window.alert('Memo/Undangan berhasil Terkirim');window.location=('../../home.php?pages=sinter')</script>";


		
  }else{
	  echo "<script>window.alert('Memo/Undangan Gagal Terkirim!');self.history.back();</script>";
  }
}


// acc  pengirim1 ke pengirim2
elseif ($act=='acc2'){
	
$q=mysql_query("UPDATE spptek SET accsipengirim1   = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim ke atasan untuk ACC');window.location=('../../home.php')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim ke atasan untuk ACC!');self.history.back();</script>";
  }
}

// acc spptek
elseif ($act=='acc3'){
$e = mysql_fetch_array(mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'"));		
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$e[jenispptek]/$thn%'";
//$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%TeknikPL/$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 3);
$noUrut++;


//$newID = sprintf("S-%03s/TeknikPL/$thn", $noUrut);
//sinmr 		 = '$newID';
$q=mysql_query("UPDATE spptek SET  sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");
								   
$r=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (80,'$_GET[id]')");


  if ($r){

	  echo "<script>window.alert('SPPTek berhasil Terkirim');window.location=('../../home.php?pages=sintertp')</script>";


		
  }else{
	  echo "<script>window.alert('Gagal Terkirim!');self.history.back();</script>";
  }
}


// acc memo pr
elseif ($act=='acc4'){
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("M-%04s/$_SESSION[nppcv]/$bln", $noUrut);
	
$q=mysql_query("UPDATE spptek SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");

$prmasuk = mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'");
$pr = mysql_fetch_array($prmasuk);	

if ($pr[sipengirim2]=='2'){
$z=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (71,'$_GET[id]')");
$z=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (72,'$_GET[id]')");
//$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (78,'$_GET[id]')");

}
elseif ($pr[sipengirim2]=='3'){
$z=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (87,'$_GET[id]')");
}
elseif ($pr[sipengirim2]=='26'){
$z=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (27,'$_GET[id]')");
}
elseif ($pr[sipengirim2]=='11'){
$z=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (71,'$_GET[id]')");
$z=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (72,'$_GET[id]')");
//$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (78,'$_GET[id]')");
//$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (80,'$_GET[id]')");
//$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (11,'$_GET[id]')");
}
else {
}


  if ($q){
	  
	  echo "<script>window.alert('Memo Order PR berhasil ACC');window.location=('../../home3.php?pages=sinterm')</script>";


		
  }else{
	  echo "<script>window.alert('Gagal Terkirim!');self.history.back();</script>";
  }
}


// acc permintaan IT
elseif ($act=='acc5'){
$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));		
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
//$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$e[jenispptek]/$thn%'";
$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%SIT/$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 3);
$noUrut++;


$newID = sprintf("S-%03s/SIT/$thn", $noUrut);
	
$q=mysql_query("UPDATE sinter SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");
								   
$r=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES (75,'$_GET[id]')");

  if ($q){

	  echo "<script>window.alert('Permintaan Sistem IT berhasil disetujui');window.location=('../../home.php?pages=sinterit')</script>";


		
  }else{
	  echo "<script>window.alert('Gagal tersimpan!');self.history.back();</script>";
  }
}

// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM spptek WHERE siid='$_GET[id]'"));
  if ($data['sifile']!=''){
     mysql_query("DELETE FROM spptek WHERE siid='$_GET[id]'");
	 mysql_query("DELETE FROM pstek WHERE spptek_id='$_GET[id]'");
	 unlink("../../sinternal/$data[sifile]"); 
  }
  else{
     mysql_query("DELETE FROM spptek WHERE siid='$_GET[id]'");
 	 mysql_query("DELETE FROM pstek WHERE spptek_id='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=sintertp')</script>"; 
}
// hapus Barantek
elseif ($act=='hapusbarangtek'){

	$del = mysql_query("DELETE FROM pesanan_barangtek WHERE id_pesanantek='$_GET[id]'");

	if($del){
		echo "<script>window.alert('Data Transaksi Barang Telah dihapus!');window.location=('../../home.php?pages=usrtp')</script>";
	}else{
		echo "<script>self.history.back();</script>";
	}
}
// hapus Transaksi Barang teknik
elseif ($act=='hapustransaksibarang'){

 	$del = mysql_query("DELETE FROM transaksi_stok_teknik WHERE id_transaksi='$_GET[id]'");

	if($del){
		echo "<script>window.alert('Data Transaksi Barang Telah dihapus!');window.location=('../../home.php?pages=barangtek&act=detailbarang&kode=$_GET[kode]')</script>";
	}else{
		echo "<script>self.history.back();</script>";
	}
}
//get data transaksi
elseif ($act=='getdatatrans'){
    $data = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[kode]'"));
    return json_encode($data);
}
// hapus Barantek gudang
elseif ($act=='hapusbarangtekgdng'){

 	$del = mysql_query("DELETE FROM barang_teknik WHERE kode='$_GET[kode]'");
 	$del = mysql_query("DELETE FROM transaksi_stok_teknik WHERE kode_barang='$_GET[kode]'");
	
	if($del){
		echo "<script>window.alert('Data Barang Telah dihapus!');window.location=('../../home.php?pages=barangtek')</script>";
  	}else{
		echo "<script>self.history.back();</script>";
	}
}
elseif ($act=='hapuspesanbrg'){

 	$del = mysql_query("DELETE FROM pesanan_barangtek WHERE id_pesanantek='$_GET[kode]'");
	
	if($del){
		echo "<script>window.alert('Data Barang Telah dihapus!');window.location=('../../home.php?pages=approvebarangtek')</script>";
  	}else{
		echo "<script>self.history.back();</script>";
	}
}
//tambah penerima dan tembusan
elseif ($act=='lp'){
 mysql_query("DELETE FROM pstek WHERE spptek_id='$_GET[id]'");
  $psin = $_POST["psin"];
  foreach ($psin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES ('$cid','$_GET[id]')");  
  }
  
 mysql_query("DELETE FROM tstek WHERE siid='$_GET[id]'");
  $tstek = $_POST["tstek"];
  foreach ($tstek as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tstek(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=sinter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

elseif ($act=='lpadmin'){
  $psin = $_POST["psin"];
  foreach ($psin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO pstek(cId,spptek_id) VALUES ('$cid','$_GET[id]')");  
  }
  
  $tstek = $_POST["tstek"];
  foreach ($tstek as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tstek(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=sinter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

//batas dari aksi_disposisi.php
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

 UploadDisp($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO disposisi(dNoagenda,
                                         dPendisposisi,
								         siid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[siid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO disposisi(dNoagenda,
                                         dPendisposisi,
								         siid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[siid]',
								'$nama_file_unik')");
  }
  
  $pdis = $_POST["pdis"];

  foreach ($pdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO pdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,siid,psACC,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[siid]','N','$_POST[jawab]')"); 
 }
 
if($_SESSION[levelcv]==0){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=sinter')</script>";
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
					FROM pdis a WHERE a.siid='$_GET[siid]' AND a.pId='$_POST[pendisposisi]' ORDER BY a.pdid DESC");

while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Memo/Undangan/Tembusan di aplikasi http://ekfpb.com untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Disposisi Gagal Terkirim');self.history.back();</script>";
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
  include "classes/class.phpmailer.php";

  foreach ($pdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO pdis(pNoagenda,ptgl,ptgls,pInstruksi,pSifat,pid,cId,siid,psACC,kode,jawab) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$cid','$_GET[siid]','N','$now','$_POST[jawab]')"); 
 }
 
if($_SESSION[levelcv]==0){
  if ($q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=sinter')</script>";
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
					FROM pdis a WHERE a.siid='$_GET[siid]' AND a.pId='$_POST[pendisposisi]' AND a.kode='$now' ORDER BY a.pdid DESC");
/*
while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Memo/Undangan/Tembusan di aplikasi http://ekfpb.com untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Disposisi terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Disposisi gagal terkirim');self.history.back();</script>";
  }
  
  }
  

}
if($act=='simpanpr'){
	$tglsekarang 	= date("Y-m-d");
	$pr 			= $_POST['pr'];
	if($_POST[pr] == 'Batal'){
		$cek	= mysql_query("UPDATE spptek SET pr='', sitgl_order='' WHERE siid='$_GET[id]'");

	}else{
		$cek	= mysql_query("UPDATE spptek SET pr='$_POST[pr]', sitgl_order='$tglsekarang' WHERE siid='$_GET[id]'");

	}
	
	if ($cek){
	echo "<script>
		window.alert('No PR berhasil di simpan');
		window.location = ('../../home.php?pages=pesananbarangtek')
	</script>";
	}
	else {
	echo "<script>
		window.alert('No PR Gagal di update');
		window.location = ('../../home.php?pages=pesananbarangtek')
	</script>";
	}
}if($act=='closespptekusr'){
        $tgl_sekarang 	= date("Y-m-d");
        $tanggal 		= $_POST['sitgl_selesai2'];
        $cek 			= mysql_query("UPDATE spptek SET sikomen2='Selesai User', siket_user='$_POST[siket_user]', komen_user='$_POST[komen_user]', sitgl_selesai2='$tgl_sekarang' WHERE siid='$_GET[id]'");

        if ($cek){
            // thread_set_status_teknik(intval($_GET['id']), 0);
        echo "<script>
        	window.alert('Kepuasan Berhasil Disimpan!!!');
        	window.location = ('../../home.php?pages=sintertp')
        </script>";
        }
        else {
        echo "<script>
        	window.alert('Data Gagal di Simpan');
        	window.location = ('../../home.php?pages=sintertp')
        </script>";
        }
}

//batas dari aksi_disposisi.php

?>
