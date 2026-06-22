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
	echo "<script>window.alert('Isi lengkap Penyimpangan, silahkan kembali!');self.history.back();</script>";	 
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
  
  Uploadnc($nama_file_unik);
 
  
if($_FILES['fupload']['size']<=$maxsize){
  
if ($_POST[pengirim1]=="tidak") {
	if (empty($lokasi_file)){
  $q=mysql_query("INSERT INTO ncinter(nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
                                   jenisnc,
                                   ncket,
                                   ncket2,
                                   ncket3,
                                   ncket4) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]'
								)");
	}
	else {
	 $q=mysql_query("INSERT INTO ncinter(nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
                                   jenisnc,
                                   ncket,
                                   ncket2,
                                   ncket3,
                                   ncket4,
								   ncfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('ncp Tersimpan, Klik tombol KIRIM! ');window.location=('../../home.php?pages=ncinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=ncinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=ncinter'
        }, 3000);
</script>";
*/
  }
}  elseif ($_POST[pengirim1]!="tidak") {
	if (empty($lokasi_file)){
    $q=mysql_query("INSERT INTO ncinter(nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
                                   jenisnc,
                                   ncket,
                                   ncket2,
                                   ncket3,
                                   ncket4) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]'
								)");
	}
	else {
	 $q=mysql_query("INSERT INTO ncinter(nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
                                   jenisnc,
                                   ncket,
                                   ncket2,
                                   ncket3,
                                   ncket4,
								   ncfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
								'$_POST[ket]',
								'$_POST[ket2]',
                                '$_POST[ket3]',
                                '$_POST[ket4]',
								'$nama_file_unik')");	
		
	}
																					
  						
  if ($q){
	 
 echo "<script>window.alert('ncp tersimpan, menunggu koreksi/acc atasan Klik KIRIM');window.location=('../../home.php?pages=ncinter')</script>";
/*	  echo "<center><h4>Data Tersimpan! Silahkan isi list penerima dan tembusan !, <br><a href=../../home.php?pages=ncinter>KLIK DISINI</a> untuk kembali!
</h4></center>";


echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=ncinter'
        }, 3000);
</script>";
*/
  }else{
      
echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";	 
/*
	  echo "<center><h4>Data Gagal Tersimpan!, <br><a href=../../home.php?pages=ncinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
*/
  }
}
else{
	if ($_POST[pengirim1]=="ya"){
			if (empty($lokasi_file)){
			 $q=mysql_query("INSERT INTO ncinter(ncnmr,
                                   nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
								   jenisnc,
                                   ncket,
								   ncket2,
								   ncket3,
								   ncket4,
								   ncstatus,
								   ncstatus1) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
								'$_POST[ket]',
								'$_POST[ket2]',
								'$_POST[ket3]',
								'$_POST[ket4]',
								'N',
								'Open')");
			}
			else {
							 $q=mysql_query("INSERT INTO ncinter(ncnmr,
                                   nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
								   jenisnc,
                                   ncket,
								   ncket2,
								   ncket3,
								   ncket4,
								   ncstatus,
								   ncstatus1,
								   ncfile) 
	                     VALUES('$_POST[nomor]',
                                '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
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
		 $q=mysql_query("INSERT INTO ncinter(nctgl,
                                  ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
								   jenisnc,
                                   ncket,
								   ncket2,
								   ncket3,
								   ncket4,
								   ncstatus,
								   ncstatus1) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
								'$_POST[ket]',
								'$_POST[ket2]',
								'$_POST[ket3]',
								'$_POST[ket4]',
								'N',
								'Open')");
		}
		else {
			 $q=mysql_query("INSERT INTO ncinter(nctgl,
                                   ncpengirim,
								   ncpengirim1,
								   ncpengirim2,
                                   ncperihal,
                                   ncperihal1,
                                   nctingkat,
								   jenisnc,
                                   ncket,
								   ncket2,
								   ncket3,
								   ncket4,
								   ncstatus,
								   ncstatus1,
								   ncfile) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
								'$_POST[pengirim2]',
								'$_POST[perihal]',
								'$_POST[perihal1]',	
								'$_POST[tingkat]',
								'$_POST[jenisnc]',
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
								'Ada Konsep ncp Internal Perlu KOREKSI/acc di ekfpb.com!',
'Yth. $ef[cNama], <br>Ada konsep ncp Internal yang Perlu di KOREKSI & acc oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep ncp dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi ncp yaitu edit ncp (klik gambar pena), edit list penerima, ncp dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik acc/KIRIM<br><br>
ncp Perihal : $_POST[perihal]<br>
Isi ncp :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
echo "<script>window.alert('ncp tersimpan, menunggu koreksi/acc atasan klik KIRIM');window.location=('../../home.php?pages=ncinter')</script>";


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
$mail->Subject = "Ada ncp Internal Perlu KOREKSI/acc di ekfpb.com!"; //subyek email
$mail->AddAddress("$ef[cEmail2]","$ef[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $ef[cNama], <br>Ada konsep ncp Internal yang Perlu di KOREKSI & acc oleh $ef[cNama] di aplikasi http://ekfpb.com, <br>
konsep ncp dibuat oleh $e[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi ncp yaitu edit ncp (klik gambar pena), edit list penerima, ncp dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik acc/KIRIM<br><br>
ncp Perihal : $_POST[perihal]<br>
Isi ncp :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>ncp berhasil tersimpan dan email terkirim ke atasan langsung, <br><a href=../../home.php?pages=ncinter>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>ncp berhasil tersimpan tetapi email ke atasan langsung gagal terkirim, <br><a href=../../home.php?pages=ncinter>KLIK DISINI</a> untuk kembali!
</h4></center>";

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=ncinter'
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
    
     $q=mysql_query("UPDATE ncinter SET 
                                   ncnmr = '$_POST[nomor]',
                                   ncnmr1   = '$_POST[nomor1]',
                                   nctgl 	  = '$_POST[tgl]',
                                   nctgl_trm  = '$_POST[tgl_trm]',
								   jenisnc	 = '$_POST[jenisnc]',
								   nctingkat = '$_POST[nctingkat]',
                                   ncperihal = '$_POST[perihal]',
								   ncperihal1 = '$_POST[perihal1]',
								   ncket	 = '$_POST[ket]',
								   ncket2	 = '$_POST[ket2]',
								   ncket3	 = '$_POST[ket3]',
								   ncket4	 = '$_POST[ket4]',
								   ncstatus = '$_POST[status]',
								   ncstatus2 = '$_POST[status2]',
								   ceklist = '$_POST[ceklist]',
								   accpom = '$_POST[accpom]'
								   WHERE ncid = '$_GET[id]'");
}

else {
Uploadnc($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT ncfile,ncfile2, ncid FROM ncinter WHERE ncid='$_GET[id]'"));
unlink("../../ncp/$data[ncfile]"); 

  $q=mysql_query("UPDATE ncinter SET ncnmr   = '$_POST[nomor]',
                                   ncnmr1   = '$_POST[nomor1]',
                                   nctgl 	  = '$_POST[tgl]',
                                   nctgl_trm  = '$_POST[tgl_trm]',
								   jenisnc	 = '$_POST[jenisnc]',
								   nctingkat = '$_POST[nctingkat]',
                                   ncperihal = '$_POST[perihal]',
								   ncperihal1 = '$_POST[perihal1]',	  
								   ncket	 = '$_POST[ket]',
								   ncket2	 = '$_POST[ket2]',
								   ncket3	 = '$_POST[ket3]',
								   ncket4	 = '$_POST[ket4]',
								   ncstatus  = '$_POST[status]',
								   ncstatus2 = '$_POST[status2]',
								   ceklist = '$_POST[ceklist]',
								   accpom = '$_POST[accpom]',
								   ncfile    = '$nama_file_unik'
								   WHERE ncid = '$_GET[id]'");

}
								   
								   
  if ($q){
	  echo "<script>window.alert('ncp berhasil Terupdate');window.location=('../../home.php?pages=ncinter')</script>";
  }else{
       echo "<script>window.alert('ncp Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
   
  
}


elseif($act=='editceklist'){
     
     $q=mysql_query("UPDATE ncinter SET 
								   ceklist = '$_POST[ceklist]',
								   accpom = '$_POST[accpom]'
								   WHERE ncid = '$_GET[id]'");
  
  if ($q){
	  echo "<script>window.alert('ncp Berhasil Update');self.history.back();</script>";
  }else{
       echo "<script>window.alert('ncp Gagal Update');self.history.back();</script>";
  }
}






// acc ncp internal
elseif ($act=='acc'){

$e = mysql_fetch_array(mysql_query("SELECT * FROM ncinter WHERE ncid='$_GET[id]'"));
$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("mm");
$bln1            = tgl_indo7($tgl_sekarang);
$query = "SELECT max(ncnmr) as max_no FROM ncinter WHERE ncnmr LIKE '%$bln1$thn$e[jenisnc]%'";

$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 7, 3);
$noUrut++;
$newID = sprintf("nc$bln1$thn$e[jenisnc]%03s", $noUrut);
    
$q=mysql_query("UPDATE ncinter SET  ncnmr 		 = '$newID',
                                    ncnmr1 		 = '$newID',
                                    nctgl_trm    = '$tgl_sekarang',
                                    ncstatus   	 = 'Y'
								    WHERE ncid = '$_GET[id]'");
  if ($q){
	  /*
$tgl_sekarang = date ("Y-m-d");
$result = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'");
						
$result1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'"));


$results = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN ncsin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'");
						
$results1 = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cEmail, a.cEmail2,b.tgl_baca FROM users a
						LEFT JOIN ncsin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'"));
						
$r = mysql_fetch_array(mysql_query("SELECT a.cUser,a.cNama,a.cJabatan,b.* FROM users a
						LEFT JOIN ncinter b ON b.ncpengirim1=a.cId
						WHERE b.ncid='$_GET[id]'"));
						
while($e=mysql_fetch_array($result)){
mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada ncp Internal untuk $e[cNama]!',
								'Yth. $e[cNama], <br>Ada ncp Internal di aplikasi http://ekfpb.com untuk anda<br>
ncp dari : $r[cNama],<br>
Perihal : $r[ncperihal],<br><br>
Untuk baca ncp (Detail) silahkan segera login ke http://ekfpb.com<br>
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
								'Ada Tembusan ncp Internal untuk $ef[cNama]!',
								'Yth. $ef[cNama], <br>Ada Tembusan ncp Internal di aplikasi http://ekfpb.com untuk anda<br>
ncp dari : $r[cNama],<br>
Perihal : $r[ncperihal],<br>
Untuk baca ncp (Detail) silahkan segera login ke http://ekfpb.com<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/ 
	  echo "<script>window.alert('ncp berhasil di acc !');window.location=('../../home.php?pages=ncinter&act=lp&id=$_GET[id]')</script>";


		
  }else{
	  echo "<script>window.alert('ncp Gagal acc!');self.history.back();</script>";
  }
}


// acc  pengirim1 ke pengirim2
elseif ($act=='acc2'){
    

$tgl_sekarang = date("Y-m-d");
$q=mysql_query("UPDATE ncinter SET  accsipengirim1   = 'Y', 
                                    nctgl        = '$tgl_sekarang'
								    WHERE ncid = '$_GET[id]'");
  if ($q){
	   echo "<script>window.alert('ncp terkirim ke Petugas nc/ Dokumen');window.location=('../../home.php?pages=ncinter')</script>";
  }else{
	  echo "<script>window.alert('ncp Gagal terkirim');self.history.back();</script>";
  }
}

// hapus 
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT ncfile, ncfile2, ncid FROM ncinter WHERE ncid='$_GET[id]'"));
  if ($data['ncfile']!=''){
     mysql_query("DELETE FROM ncinter WHERE ncid='$_GET[id]'");
	 mysql_query("DELETE FROM csin WHERE ncid='$_GET[id]'");
	 unlink("../../ncp/$data[ncfile]"); 
  }
  else{
     mysql_query("DELETE FROM ncinter WHERE ncid='$_GET[id]'");
 	 mysql_query("DELETE FROM csin WHERE ncid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=ncinter')</script>"; 
}
elseif ($act=='hide'){
    
     mysql_query("UPDATE ncinter SET show='N' WHERE ncid='$_GET[id]'");

  echo "<script>window.location=('../../home.php?pages=ncinter0')</script>"; 
}
elseif ($act=='show'){
    
    mysql_query("UPDATE ncinter SET show='Y' WHERE ncid='$_GET[id]'");

  echo "<script>window.location=('../../home.php?pages=ncinter0')</script>"; 
}
//tambah penerima rencana tindakan
elseif ($act=='lp'){
  mysql_query("DELETE FROM csin WHERE ncid='$_GET[id]'");	
  $csin = $_POST["csin"];
  
  foreach ($csin as $x=>$cid)
  {
    $nama=mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId='$cid'"));
	$q=mysql_query("INSERT INTO csin(cId,nama,ncid,tgl_baca,sistatus) VALUES ('$cid','$nama[cNama]','$_GET[id]','$_POST[tgl]','Y')");  
  }
  
  mysql_query("DELETE FROM ncsin WHERE ncid='$_GET[id]'");	
  $ncsin = $_POST["ncsin"];
  foreach ($ncsin as $x=>$cid)
  {
    $nama=mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId='$cid'"));
	$r=mysql_query("INSERT INTO ncsin(cId,nama,ncid) VALUES ('$cid','$nama[cNama]','$_GET[id]')");  
  }
  
  
  if ($q OR $r){
	  
	echo "<script>window.location=('../../home.php?pages=ncinter')</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}


//buat ntnc
elseif ($act=='tambahntnc'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 Uploadntnc($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO ntnc(dNoagenda,
                                         dPendisposisi,
								         ncid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[ncid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO ntnc(dNoagenda,
                                         dPendisposisi,
								         ncid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[ncid]',
								'$nama_file_unik')");
  }
  
  $cdis = $_POST["cdis"];

  foreach ($cdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO cdis(pNoagenda,ptgl,ptgls,pInstruksi,kode_dok,revisi,pSifat,urut,pid,cId,ncid,psacc,kode,kode3,jawab,iid) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[kode_dok]','$_POST[revisi]','$_POST[sifat]','$_POST[urut]','$_POST[pendisposisi]','$cid','$_GET[ncid]','N','$_POST[kode]','$_POST[kode3]','$_POST[jawab]','$_POST[iid]')");

	if ($_POST[kode3]=='Y') {
	$nc = mysql_fetch_array(mysql_query("SELECT * FROM ncinter WHERE ncid='$_GET[ncid]'"));
	$data = mysql_fetch_array(mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_POST[kode_dok]'"));
	$q=mysql_query("INSERT INTO udokumen(uncnmr,
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
	                     VALUES('$nc[ncnmr1]',
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
								'Usulan dokumen ada di Penyimpangan')");
	}
	
 }
 
if($_SESSION[levelcv]<2){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Rencana Tindakan Tersimpan & Terkirim');window.location=('../../home.php?pages=usrnc&act=detail&id=$_GET[ncid]')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
      
   if ($q1&&$q2){

  echo "<script>window.alert('Rencana Tindaklanjut nc terkirim!');window.location=('../../home.php?pages=usrnc&act=detail&id=$_GET[ncid]')</script>";
  
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
elseif($act=='editntnc'){

  $now = date("H:i");

  $cdis = $_POST["cdis"];

if  ($_POST[acc]=='Y'){
 
   $q=mysql_query("UPDATE cdis SET urut = '$_POST[urut]',
                                   ptgl   = '$_POST[tglm]',
                                   ptgls  = '$_POST[tgls]',
                                   ptgls2 	  = '$_POST[tgls2]',
                                   ptgls3 	  = '$_POST[tgls3]',
                                   psTglbaca = '$_POST[tglbaca]',
                                   psTglselesai = '$_POST[tglselesai]',
                                   kode         = '$_POST[kode]',
                                   kode_dok         = '$_POST[kode_dok]',
                                   revisi         = '$_POST[revisi]',
								   pInstruksi	 = '$_POST[isi]',
								   info =   '$_POST[info]',
								   psacc	 = '$_POST[acc]'
								   WHERE pdid = '$_GET[id]'");
}
else {
     $q=mysql_query("UPDATE cdis SET urut = '$_POST[urut]',
                                   ptgl   = '$_POST[tglm]',
                                   ptgls  = '$_POST[tgls]',
                                   ptgls2 	  = '$_POST[tgls2]',
                                   ptgls3 	  = '$_POST[tgls3]',
                                   psTglbaca = '$_POST[tglbaca]',
                                   psTglselesai = '$_POST[tglselesai]',
                                   kode         = '$_POST[kode]',
                                   kode_dok         = '$_POST[kode_dok]',
                                   revisi         = '$_POST[revisi]',
								   pInstruksi	 = '$_POST[isi]',
								   info =   '$_POST[info]',
								   psacc	 = '$_POST[acc]',
								   psTglselesai = '0000-00-00'
								   WHERE pdid = '$_GET[id]'");
    
}

$nc = mysql_fetch_array(mysql_query("SELECT * FROM cdis WHERE pdid='$_GET[id]'"));
 
if($_SESSION[levelcv]<2){
  if ($q2){
	  	    
	  echo "<script>window.alert('Rencana Tindakan Sukses di Edit');window.location=('../../home.php?pages=usrnc&act=detail&id=$nc[ncid]')</script>";
  }else{
	 echo "<script>window.alert('Rencana Tindakan Sukses di Edit');window.location=('../../home.php?pages=usrnc&act=detail&id=$nc[ncid]')</script>";
  }
  
  
}
}


//batas

?>
