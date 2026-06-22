<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
if ($_POST[ket]=="" OR $_POST[ket2]=="" OR $_POST[ket3]==""){
	echo "<script>window.alert('Isi lengkap usulan change control, silahkan kembali!');self.history.back();</script>";	 
}
else {
 
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
  Uploadcc($nama_file_unik);
 
  
if($_FILES['fupload']['size']<=$maxsize){
  
if ($_POST[pengirim1]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO ccinter(cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
                                   jeniscc,
                                   ccket,
                                   ccket2,
                                   ccket3,
                                   ccket4) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]'
								)");
	}
	else {
	 $q=mysql_query("INSERT INTO ccinter(cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
                                   jeniscc,
                                   ccket,
                                   ccket2,
                                   ccket3,
                                   ccket4,
								   ccfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Usulan CC Tersimpan, Klik tombol KIRIM! ');window.location=('../../home.php?pages=ccinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=ccinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=ccinter'
        }, 3000);
</script>";
*/
  }
}  elseif ($_POST[pengirim1]!="tidak") {
	if (empty($lokasi_file)){
    $q=mysql_query("INSERT INTO ccinter(cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
                                   jeniscc,
                                   ccket,
                                   ccket2,
                                   ccket3,
                                   ccket4) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]'
								)");
	}
	else {
	 $q=mysql_query("INSERT INTO ccinter(cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
                                   jeniscc,
                                   ccket,
                                   ccket2,
                                   ccket3,
                                   ccket4,
								   ccfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('Usulan CC tersimpan, menunggu koreksi/acc atasan Klik KIRIM');window.location=('../../home.php?pages=ccinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=ccinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=ccinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=ccinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }
}
else{
	if ($_POST[pengirim1]=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO ccinter(ccnmr,
                                   cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
								   jeniscc,
                                   ccket,
								   ccket2,
								   ccket3,
								   ccket4,
								   ccstatus,
								   ccstatus1) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
								'$_POST[ket3]',
								'$_POST[ket4]',
								'N',
								'Open')");
			}
			else {
							 $q=mysql_query("INSERT INTO ccinter(ccnmr,
                                   cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
								   jeniscc,
                                   ccket,
								   ccket2,
								   ccket3,
								   ccket4,
								   ccstatus,
								   ccstatus1,
								   ccfile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
								'$_POST[ket3]',
								'$_POST[ket4]',
								'N',
								'Open'
								'$nama_file_unik')");
				
			}
	}
	else {
		if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO ccinter(cctgl,
                                  ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
								   jeniscc,
                                   ccket,
								   ccket2,
								   ccket3,
								   ccket4,
								   ccstatus,
								   ccstatus1) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
								'$_POST[ket3]',
								'$_POST[ket4]',
								'N',
								'Open')");
		}
		else {
			 $q=mysql_query("INSERT INTO ccinter(cctgl,
                                   ccpengirim,
								   ccpengirim1,
								   ccpengirim2,
                                   ccperihal,
                                   ccperihal1,
                                   cctingkat,
								   jeniscc,
                                   ccket,
								   ccket2,
								   ccket3,
								   ccket4,
								   ccstatus,
								   ccstatus1,
								   ccfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jeniscc]',
								'$_POST[ket]',
								'$_POST[ket2]',
								'$_POST[ket3]',
								'$_POST[ket4]',
								'N',
								'Open',
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
								'Ada Konsep Usulan CC Internal Perlu KOREKSI/ACC di ekfpb.com!',
'Yth. $ef[cNama], <br>Ada konsep Usulan CC Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep Usulan CC dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi Usulan CC yaitu edit Usulan CC (klik gambar pena), edit list penerima, Usulan CC dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Usulan CC Perihal : $_POST[perihal]<br>
Isi Usulan CC :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
echo "<script>window.alert('Usulan CC tersimpan, menunggu koreksi/acc atasan klik KIRIM');window.location=('../../home.php?pages=ccinter')</script>";


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
$mail->Subject = "Ada Usulan CC Internal Perlu KOREKSI/ACC di ekfpb.com!"; //subyek email
$mail->AddAddress("$ef[cEmail2]","$ef[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $ef[cNama], <br>Ada konsep Usulan CC Internal yang Perlu di KOREKSI & ACC oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep Usulan CC dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi Usulan CC yaitu edit Usulan CC (klik gambar pena), edit list penerima, Usulan CC dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Usulan CC Perihal : $_POST[perihal]<br>
Isi Usulan CC :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Usulan CC berhasil tersimpan dan email terkirim ke atasan langsung, <br><a href=../../home.php?pages=ccinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Usulan CC berhasil tersimpan tetapi email ke atasan langsung gagal terkirim, <br><a href=../../home.php?pages=ccinter>KLIK DISINI</a> untuk kembali!
</h4></center>";

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=ccinter'
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
    
     $q=mysql_query("UPDATE ccinter SET 
                                   ccnmr = '$_POST[nomor]',
                                   ccnmr1   = '$_POST[nomor1]',
                                   cctgl 	  = '$_POST[tgl]',
                                   cctgl_trm  = '$_POST[tgl_trm]',
								   jeniscc	 = '$_POST[jeniscc]',
								   cctingkat = '$_POST[cctingkat]',
                                   ccperihal = '$_POST[perihal]',
								   ccperihal1 = '$_POST[perihal1]',
								   ccket	 = '$_POST[ket]',
								   ccket2	 = '$_POST[ket2]',
								   ccket3	 = '$_POST[ket3]',
								   ccket4	 = '$_POST[ket4]',
								   ccstatus = '$_POST[status]',
								   ccstatus2 = '$_POST[status2]',
								   ceklist = '$_POST[ceklist]',
								   accpom = '$_POST[accpom]'
								   WHERE ccid = '$_GET[id]'");
}

else {
Uploadcc($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT ccfile,ccfile2, ccid FROM ccinter WHERE ccid='$_GET[id]'"));
unlink("../../usulancc/$data[ccfile]"); 

  $q=mysql_query("UPDATE ccinter SET ccnmr   = '$_POST[nomor]',
                                   ccnmr1   = '$_POST[nomor1]',
                                   cctgl 	  = '$_POST[tgl]',
                                   cctgl_trm  = '$_POST[tgl_trm]',
								   jeniscc	 = '$_POST[jeniscc]',
								   cctingkat = '$_POST[cctingkat]',
                                   ccperihal = '$_POST[perihal]',
								   ccperihal1 = '$_POST[perihal1]',	  
								   ccket	 = '$_POST[ket]',
								   ccket2	 = '$_POST[ket2]',
								   ccket3	 = '$_POST[ket3]',
								   ccket4	 = '$_POST[ket4]',
								   ccstatus  = '$_POST[status]',
								   ccstatus2 = '$_POST[status2]',
								   ceklist = '$_POST[ceklist]',
								   accpom = '$_POST[accpom]',
								   ccfile    = '$nama_file_unik'
								   WHERE ccid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('Usulan CC berhasil Terupdate');window.location=('../../home.php?pages=ccinter')</script>";
  }else{
       echo "<script>window.alert('Usulan CC Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}


elseif($act=='editceklist'){
     
     $q=mysql_query("UPDATE ccinter SET 
								   ceklist = '$_POST[ceklist]',
								   accpom = '$_POST[accpom]'
								   WHERE ccid = '$_GET[id]'");
  
  if ($q){
	  echo "<script>window.alert('Usulan CC Berhasil Update');self.history.back();</script>";
  }else{
       echo "<script>window.alert('Usulan CC Gagal Update');self.history.back();</script>";
  }
}






// acc Usulan CC internal
elseif ($act=='acc'){

$e = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$_GET[id]'"));
$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("mm");
$bln1            = tgl_indo7($tgl_sekarang);
$query = "SELECT max(ccnmr) as max_no FROM ccinter WHERE ccnmr LIKE '%$bln1$thn$e[jeniscc]%'";

$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 7, 3);
$noUrut++;
$newID = sprintf("CC$bln1$thn$e[jeniscc]%03s", $noUrut);
    
$q=mysql_query("UPDATE ccinter SET  ccnmr 		 = '$newID',
                                    ccnmr1 		 = '$newID',
                                    cctgl_trm    = '$tgl_sekarang',
                                    ccstatus   	 = 'Y'
								    WHERE ccid = '$_GET[id]'");
  if ($q){
	  /*
$tgl_sekarang = date ("Y-m-d");
$result = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ccid='$_GET[id]'");
						
$result1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ccid='$_GET[id]'"));


$results = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN ccsin b ON b.cId=a.cId
						WHERE b.ccid='$_GET[id]'");
						
$results1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN ccsin b ON b.cId=a.cId
						WHERE b.ccid='$_GET[id]'"));
						
$r = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cIdjab,b.* FROM users a
						LEFT JOIN ccinter b ON b.ccpengirim1=a.cId
						WHERE b.ccid='$_GET[id]'"));
						
while($e=mysql_fetch_array($result)){
mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Usulan CC Internal untuk $e[cNama]!',
								'Yth. $e[cNama], <br>Ada Usulan CC Internal di aplikasi http://ekfpb.com untuk anda<br>
Usulan CC dari : $r[cNama],<br>
Perihal : $r[ccperihal],<br><br>
Untuk baca Usulan CC (Detail) silahkan segera login ke http://ekfpb.com<br>
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
								'Ada Tembusan Usulan CC Internal untuk $ef[cNama]!',
								'Yth. $ef[cNama], <br>Ada Tembusan Usulan CC Internal di aplikasi http://ekfpb.com untuk anda<br>
Usulan CC dari : $r[cNama],<br>
Perihal : $r[ccperihal],<br>
Untuk baca Usulan CC (Detail) silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/ 
	  echo "<script>window.alert('Usulan CC berhasil di ACC !');window.location=('../../home.php?pages=ccinter&act=lp&id=$_GET[id]')</script>";


		
  }else{
	  echo "<script>window.alert('Usulan CC Gagal ACC!');self.history.back();</script>";
  }
}


// acc  pengirim1 ke pengirim2
elseif ($act=='acc2'){
    

$tgl_sekarang = date("Y-m-d");
$q=mysql_query("UPDATE ccinter SET  accsipengirim1   = 'Y', 
                                    cctgl        = '$tgl_sekarang'
								    WHERE ccid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('Usulan CC terkirim ke Petugas CC/ Dokumen');window.location=('../../home.php?pages=ccinter')</script>";
  }else{
	  echo "<script>window.alert('Usulan CC Gagal terkirim');self.history.back();</script>";
  }
}

// hapus 
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT ccfile, ccfile2, ccid FROM ccinter WHERE ccid='$_GET[id]'"));
  if ($data['ccfile']!=''){
     mysql_query("DELETE FROM ccinter WHERE ccid='$_GET[id]'");
	 mysql_query("DELETE FROM csin WHERE ccid='$_GET[id]'");
	 unlink("../../usulancc/$data[ccfile]"); 
  }
  else{
     mysql_query("DELETE FROM ccinter WHERE ccid='$_GET[id]'");
 	 mysql_query("DELETE FROM csin WHERE ccid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=ccinter')</script>"; 
}
elseif ($act=='hide'){
    
     mysql_query("UPDATE ccinter SET show='N' WHERE ccid='$_GET[id]'");

  echo "<script>window.location=('../../home.php?pages=ccinter0')</script>"; 
}
elseif ($act=='show'){
    
    mysql_query("UPDATE ccinter SET show='Y' WHERE ccid='$_GET[id]'");

  echo "<script>window.location=('../../home.php?pages=ccinter0')</script>"; 
}
//tambah penerima rencana tindakan
elseif ($act=='lp'){
  mysql_query("DELETE FROM csin WHERE ccid='$_GET[id]'");	
  $csin = $_POST["csin"];
  
  foreach ($csin as $x=>$cid)
  {
    $nama=mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId='$cid'"));
	$q=mysql_query("INSERT INTO csin(cId,nama,ccid,tgl_baca,sistatus) VALUES ('$cid','$nama[cNama]','$_GET[id]','$_POST[tgl]','Y')");  
  }
  
  mysql_query("DELETE FROM ccsin WHERE ccid='$_GET[id]'");	
  $ccsin = $_POST["ccsin"];
  foreach ($ccsin as $x=>$cid)
  {
    $nama=mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId='$cid'"));
	$r=mysql_query("INSERT INTO ccsin(cId,nama,ccid) VALUES ('$cid','$nama[cNama]','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=ccinter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}


//buat rtcc
elseif ($act=='tambahrtcc'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 Uploadrtcc($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO rtcc(dNoagenda,
                                         dPendisposisi,
								         ccid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[ccid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO rtcc(dNoagenda,
                                         dPendisposisi,
								         ccid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[ccid]',
								'$nama_file_unik')");
  }
  
  $cdis = $_POST["cdis"];

  foreach ($cdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO cdis(pNoagenda,ptgl,ptgls,pInstruksi,kode_dok,revisi,pSifat,urut,pid,cId,ccid,psACC,kode,kode3,jawab,iid) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[kode_dok]','$_POST[revisi]','$_POST[sifat]','$_POST[urut]','$_POST[pendisposisi]','$cid','$_GET[ccid]','N','$_POST[kode]','$_POST[kode3]','$_POST[jawab]','$_POST[iid]')");

	if ($_POST[kode3]=='Y') {
	$cc = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$_GET[ccid]'"));
	$data = mysql_fetch_array(mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_POST[kode_dok]'"));
	$q=mysql_query("INSERT INTO udokumen(uccnmr,
                                   udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
                                   ujudok,
                                   udstatus1,
                                   udstatus2,
								   udket) 
	                     VALUES('$cc[ccnmr1]',
                                '$_POST[tglm]',
                                '$cid',
                                '$cid',
                                '49',
								'2',
								'$_POST[kode_dok]',
								'$_POST[revisi]',
								'$data[judul_dok]',
								'Y',
								'Y',
								'Usulan dokumen ada di usulan change control')");
	}
	
 }
 
if($_SESSION[levelcv]<2){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Rencana Tindakan Tersimpan & Terkirim');window.location=('../../home.php?pages=usrcc&act=detail&id=$_GET[ccid]')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
      
   if ($q1&&$q2){

  echo "<script>window.alert('Rencana Tindaklanjut CC terkirim!');window.location=('../../home.php?pages=usrcc&act=detail&id=$_GET[ccid]')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal Terkirim');self.history.back();</script>";
  } 
  
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  
//edit
}
elseif($act=='editrtcc'){

  $now = date("H:i");

  $cdis = $_POST["cdis"];

if  ($_POST[acc]=='Y'){
 
   $q=mysql_query("UPDATE cdis SET urut = '$_POST[urut]',
                                   ptgl   = '$_POST[tglm]',
                                   ptgls  = '$_POST[tgls]',
                                   ptgls2 	  = '$_POST[tgls2]',
                                   ptgls3 	  = '$_POST[tgls3]',
                                   kode         = '$_POST[kode]',
                                   kode_dok         = '$_POST[kode_dok]',
                                   revisi         = '$_POST[revisi]',
								   pInstruksi	 = '$_POST[isi]',
								   info =   '$_POST[info]',
								   psACC	 = '$_POST[acc]'
								   WHERE pdid = '$_GET[id]'");
}
else {
     $q=mysql_query("UPDATE cdis SET urut = '$_POST[urut]',
                                   ptgl   = '$_POST[tglm]',
                                   ptgls  = '$_POST[tgls]',
                                   ptgls2 	  = '$_POST[tgls2]',
                                   ptgls3 	  = '$_POST[tgls3]',
                                   kode         = '$_POST[kode]',
                                   kode_dok         = '$_POST[kode_dok]',
                                   revisi         = '$_POST[revisi]',
								   pInstruksi	 = '$_POST[isi]',
								   info =   '$_POST[info]',
								   psACC	 = '$_POST[acc]',
								   psTglselesai = '0000-00-00'
								   WHERE pdid = '$_GET[id]'");
    
}

$cc = mysql_fetch_array(mysql_query("SELECT * FROM cdis WHERE pdid='$_GET[id]'"));
 
if($_SESSION[levelcv]<2){
  if ($q2){
	  	    
	  echo "<script>window.alert('Rencana Tindakan Sukses di Edit');window.location=('../../home.php?pages=usrcc&act=detail&id=$cc[ccid]')</script>";
  }else{
	 echo "<script>window.alert('Rencana Tindakan Sukses di Edit');window.location=('../../home.php?pages=usrcc&act=detail&id=$cc[ccid]')</script>";
  }
  
  
}
}


//batas

?>
