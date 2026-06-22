<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET['act'];

// Input
if ($act=='tambah'){
if ($_POST['ket']==""){
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
  
if ($_POST['pengirim1']=="tidak" AND $_POST['pengirim2']=="tidak") {
	if (empty($lokasi_file)){
	   // try {
	            $q=mysql_query("INSERT INTO sinter(sitgl,
                                   sipengirim,
                                   sinmr,
                                   jenispptek,
                                   sikomen2,
                                   sifile,
                                   sitgl_order,
								   sipengirim1,
								   sipengirim2,
                                   siperihal,
								   sikomen,
								   jenisms,
                                   siket,
                                   sitgl_brgdtg,
                                   sitgl_cek,
                                   sitgl_mulai,
                                   sitgl_selesai,
                                   sitgl_rework,
                                   siket_teknik,
                                   siket_user,
                                   lokasi,
                                   aktiva,
                                   no_aktiva,
                                   keluhan,
                                   personil,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
                                '',
                                '',
                                '',
                                '',
                                0000-00-00,
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'0000-00-00',
								'0000-00-00',
								'0000-00-00',
								'0000-00-00',
								'0000-00-00',
								'',
								'',
								'',
								'',
								'',
								'',
								'',
								'N')");
	   //     return 'something';
	   // } catch (Exception $e) {
	   //     var_dump($e);die();
	   // }
 
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

if ($_POST[lokasi]=="-") {
    
$lokasi = $_POST[lokasi2];    
}
else
{
$lokasi = $_POST[lokasi];      
}

if ($_POST[aktiva]=="-") {
    
$aktiva = $_POST[aktiva2];    
}
else
{
$aktiva = $_POST[aktiva];      
}


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
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
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
                                   personil,
                                   keluhan,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
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
} elseif ($_POST[pengirim1]!="tidak" AND $_POST[pengirim2]=="tidak") {
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
                                   personil,
                                   keluhan,
                                   siket,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
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
								   personil,
                                   keluhan,
                                   siket,
								   sstatus,
								   sifile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim1]',
								'$_POST[perihal]',
								'$_POST[sikomen]',
								'Belum Cek',
								'$_POST[jenispptek]',
								'$_POST[jenisms]',
								'$lokasi',
								'$aktiva',
								'$_POST[personil]',
								'$_POST[keluhan]',
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
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
                                   personil,
                                   keluhan,
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
                                   personil,
                                   keluhan,
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
								'$_POST[ket] $teknik',
								'N',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
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
	if ($_POST[pengirim1]=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO sinter(sinmr,
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
								'$_POST[ket] $teknik',
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
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
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
								'$_POST[ket] $teknik',
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
								   sikomen2,
								   jenispptek,
								   jenisms,
								   lokasi,
								   aktiva,
                                   personil,
                                   keluhan,
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
                                   personil,
                                   keluhan,
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


// Input Permintaan IT
elseif ($act=='tambah4'){

if ($_POST[jenispptek]==""){
	echo "<script>window.alert('Jenis permintaan belum dipilih, silahkan kembali!');self.history.back();</script>";	 
}
else {

if ($_POST[jenispptek]=="non"){
    $id = 2;
}
else
{
    if ($_POST[pengirim1]=="tidak") {
    $id = $_POST[pengirim];
    }
    else
    {
    $id = $_POST[pengirim1];
    }
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
								'$_POST[pengirim1]',
								'$id',
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

if ($_POST[lokasi]=="-" OR $_POST[lokasi]=="") {
    
$lokasi = $_POST[lokasi2];    
}
else
{
$lokasi = $_POST[lokasi];      
}

if ($_POST[aktiva]=="-" OR $_POST[aktiva]=="") {
    
$aktiva = $_POST[aktiva2];    
}
else
{
$aktiva = $_POST[aktiva];      
}


$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));		
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%/$_POST[jenispptek]/$thn%'";
//$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%TeknikPL/$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 0, 3);
$noUrut++;


$newID = sprintf("%03s/$_POST[jenispptek]/$thn", $noUrut);
//sinmr 		 = '$newID';

if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));	
    if ($e[sinmr]!='' AND $_POST[nomor]!='' AND $e[wp]=='N' AND $_POST[wp]=='Y'){
    
     $r=mysql_query("INSERT INTO psin(cId,siid) VALUES (62,'$_GET[id]')");
     
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
								   keluhan	 = '$_POST[keluhan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   wp = '$_POST[wp]',
								   pihak3 = '$_POST[pihak3]'
								   WHERE siid = '$_GET[id]'");
                            
    }
    elseif ($e[sinmr]=='' AND $_POST[nomor]=='' AND $_POST[jenispptek]!=''){
    
     $q=mysql_query("UPDATE sinter SET sinmr  = '$newID',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	 = '$_POST[jenisms]',
								   jenispptek	 = '$_POST[jenispptek]',								   
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sitgl_order ='$_POST[tgl_order]',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   personil	 = '$_POST[personil]',				   
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   wp = '$_POST[wp]',
								   pihak3 = '$_POST[pihak3]'
								   WHERE siid = '$_GET[id]'");
    }
    else
       {
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
								   keluhan	 = '$_POST[keluhan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   wp = '$_POST[wp]',
								   pihak3 = '$_POST[pihak3]'
								   WHERE siid = '$_GET[id]'");
    }
}

else {
  UploadSinter($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM sinter WHERE siid='$_GET[id]'"));
unlink("../../sinternal/$data[sifile]"); 

$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));	
   if ($_POST[jenispptek]=='' && $e[sstatus]=='N'){
    
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
								   keluhan	 = '$_POST[keluhan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   wp = '$_POST[wp]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");
                            
    }
    elseif ($_POST[jenispptek]!='' AND $e[sstatus]=='N' || $_POST[jenispptek]!='' AND $e[sstatus]=='Y'){
    
     $q=mysql_query("UPDATE sinter SET sinmr  = '$newID',
                                   sitgl 	  = '$_POST[tgl]',
								   jenisms	  = '$_POST[jenisms]',
								   jenispptek = '$_POST[jenispptek]',								   
                                   siperihal = '$_POST[perihal]',
								   sikomen = '$_POST[sikomen]',
								   sikomen2 = '$_POST[sikomen2]',
								   sipengirim ='$_POST[pengirim]',
								   sipengirim1 ='$_POST[pengirim2]',
								   sipengirim2 ='$_POST[pengirim3]',
								   sitgl_order ='$_POST[tgl_order]',
								   sitgl_brgdtg ='$_POST[tgl_brgdtg]',
								   sitgl_cek ='$_POST[tgl_cek]',
								   sitgl_mulai ='$_POST[tgl_mulai]',
								   sitgl_selesai ='$_POST[tgl_selesai]',
								   sitgl_rework ='$_POST[tgl_rework]',
								   siket	 = '$_POST[ket]',
								   lokasi	 = '$lokasi',
								   aktiva	 = '$aktiva',
								   keluhan	 = '$_POST[keluhan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   sstatus = 'Y',
								   wp = '$_POST[wp]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");
    }
    else
       {
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
								   keluhan	 = '$_POST[keluhan]',
								   personil	 = '$_POST[personil]',
								   siket_user = '$_POST[siket_user]',
								   siket_teknik = '$_POST[siket_teknik]',
								   wp = '$_POST[wp]',
								   pihak3 = '$_POST[pihak3]',
								   sifile    = '$nama_file_unik'
								   WHERE siid = '$_GET[id]'");
    }

}
								   
								   
  if ($q){
   
if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
	
	echo "<script>window.alert('SPPTek berhasil di update');window.location=('../../home.php?pages=usrtp')</script>";
}
else {
    echo "<script>window.alert('SPPTek berhasil di update');window.location=('../../home.php?pages=sintertp')</script>"; 
}
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
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
$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$bln%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("M-%04s/$_SESSION[nppcv]/$bln", $noUrut);
	
$q=mysql_query("UPDATE sinter SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	  /*
$tgl_sekarang = date ("Y-m-d");
$result = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN psin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
						
$result1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN psin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'"));


$results = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN tsin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
						
$results1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN tsin b ON b.cId=a.cId
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
	
$q=mysql_query("UPDATE sinter SET accsipengirim1   = 'Y'
								   WHERE siid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Terkirim ke atasan untuk ACC');window.location=('../../home.php')</script>";
  }else{
	  echo "<script>window.alert('Gagal Terkirim ke atasan untuk ACC!');self.history.back();</script>";
  }
}

// acc spptek
elseif ($act=='acc3'){
$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));		
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$e[jenispptek]/$thn%'";
//$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%TeknikPL/$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 3);
$noUrut++;


//$newID = sprintf("S-%03s/TeknikPL/$thn", $noUrut);
//sinmr 		 = '$newID';
$q=mysql_query("UPDATE sinter SET  sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");
								   
$r=mysql_query("INSERT INTO psin(cId,siid) VALUES (80,'$_GET[id]')");


  if ($q){

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
	
$q=mysql_query("UPDATE sinter SET  sinmr 		 = '$newID',
								   sitgl       	 = '$tgl_sekarang',
								   sstatus   	 = 'Y'
								   WHERE siid = '$_GET[id]'");

$prmasuk = mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'");
$pr = mysql_fetch_array($prmasuk);	

if ($pr[sipengirim2]=='2'){
$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (71,'$_GET[id]')");
$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (72,'$_GET[id]')");
//$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (78,'$_GET[id]')");

}
elseif ($pr[sipengirim2]=='3'){
$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (3,'$_GET[id]')");
}
elseif ($pr[sipengirim2]=='26'){
$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (27,'$_GET[id]')");
}
elseif ($pr[sipengirim2]=='11'){
$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (71,'$_GET[id]')");
$z=mysql_query("INSERT INTO psin(cId,siid) VALUES (72,'$_GET[id]')");
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
								   
$r=mysql_query("INSERT INTO psin(cId,siid) VALUES (75,'$_GET[id]')");

  if ($q){

	  echo "<script>window.alert('Permintaan Sistem IT berhasil disetujui');window.location=('../../home.php?pages=sinterit')</script>";


		
  }else{
	  echo "<script>window.alert('Gagal tersimpan!');self.history.back();</script>";
  }
}

// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT sifile,siid FROM sinter WHERE siid='$_GET[id]'"));
  if ($data['sifile']!=''){
     mysql_query("DELETE FROM sinter WHERE siid='$_GET[id]'");
	 mysql_query("DELETE FROM psin WHERE siid='$_GET[id]'");
	 unlink("../../sinternal/$data[sifile]"); 
  }
  else{
     mysql_query("DELETE FROM sinter WHERE siid='$_GET[id]'");
 	 mysql_query("DELETE FROM psin WHERE siid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=sinter')</script>"; 
}
//tambah penerima dan tembusan
elseif ($act=='lp'){
 mysql_query("DELETE FROM psin WHERE siid='$_GET[id]'");
  $psin = $_POST["psin"];
  foreach ($psin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO psin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
 mysql_query("DELETE FROM tsin WHERE siid='$_GET[id]'");
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
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
	$q=mysql_query("INSERT INTO psin(cId,siid) VALUES ('$cid','$_GET[id]')");  
  }
  
  $tsin = $_POST["tsin"];
  foreach ($tsin as $x=>$cid)
  {
	$r=mysql_query("INSERT INTO tsin(cId,siid) VALUES ('$cid','$_GET[id]')");  
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
//batas dari aksi_disposisi.php

?>
