<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
	    
  $q=mysql_query("INSERT INTO osurat(
                                   otgl,
                                   itgl,							   
								   opengirim,
								   opengirim1,
                                   okepada, 
                                   operihal,
								   jenisms,
                                   oket,
								   iid,
								   inmr,
								   sstatus) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[tgl_msk]',
                                '$_POST[pengirim]',
								'$_POST[pengirim1]',
                                '$_POST[kepada]',
								'$_POST[perihal]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'$_POST[iid]',
								'$_POST[inmr]',
								'N')");
								
$qr=mysql_query("UPDATE isurat SET  itgl_balas  = '$_POST[tgl]',
								   inmr_bls  = '$_POST[nomor]'
								   WHERE iid = '$_POST[iid]'");		
								
  if ($q){

$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_POST[pengirim1]'"));
/*
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Surat untuk Eksternal Perlu KOREKSI/ACC di ekfpb.com!',
								'Yth. $e[cNama], <br>Ada surat untuk eksternal yang Perlu di KOREKSI & ACC oleh $e[cNama] di aplikasi http://ekfpb.com, <br>
konsep surat dibuat oleh $ef[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi surat klik gambar pena, surat dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Surat Perihal : $_POST[perihal]<br>
Isi Surat :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
 echo "<script>window.alert('Surat Keluar Tersimpan dan menunggu ACC Atasan!');window.location=('../../home.php?pages=sout')</script>";

/*
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
$mail->Subject = "Ada Surat untuk Eksternal Perlu KOREKSI/ACC di ekfpb.com!"; //subyek email
$mail->AddAddress("$e[cEmail2]","$e[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $e[cNama], <br>Ada surat untuk eksternal yang Perlu di KOREKSI & ACC oleh $e[cNama] di aplikasi http://ekfpb.com, <br>
konsep surat dibuat oleh $ef[cNama]<br>
Detail silahkan segera login ke http://ekfpb.com<br>
Untuk mengoreksi surat klik gambar pena, surat dapat dibatalkan/dihapus (klik gambar tong sampah),<br>
setelah selesai koreksi, klik ACC/KIRIM<br><br>
Surat Perihal : $_POST[perihal]<br>
Isi Surat :<br>
$_POST[ket]<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Surat berhasil tersimpan dan email terkirim ke atasan langsung, <br><a href=../../home.php?pages=sout>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Surat berhasil tersimpan tetapi email ke atasan langsung gagal terkirim, <br><a href=../../home.php?pages=sout>KLIK DISINI</a> untuk kembali!
</h4></center>";			

echo"
<script>
        var timer = setTimeout(function() {
            window.location='../../home.php?pages=sout'
        }, 3000);
</script>";	
*/
	
  }
  /*
  elseif ($_POST[pengirim]=='$_SESSION[cv]'){
	  
  	  echo "<script>window.alert('Data Tersimpan dan Klik ACC!');window.location=('../../home.php?pages=sout')</script>";
  }
  
  else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
  */
}
//update smasuk
elseif($act=='edit'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 	
  
if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){	

  $q=mysql_query("UPDATE osurat SET otgl	     = '$_POST[tgl]',
                                   itgl	     = '$_POST[tgl_msk]',
                                   opengirim = '$_POST[pengirim]',
								   opengirim1 = '$_POST[pengirim1]',
                                   okepada	 = '$_POST[kepada]', 
                                   operihal	 = '$_POST[perihal]',
								   jenisms	 =  '$_POST[jenisms]',
                                   iid	 	 = '$_POST[iid]',
								   inmr  	 = '$_POST[inmr]',
								   itgl	 	 = '$_POST[tgl_msk]',
								   oket		 = '$_POST[ket]'
								   WHERE oid = '$_GET[id]'");
								   
$qr=mysql_query("UPDATE isurat SET  itgl_balas  = '$_POST[tgl]',
								   inmr_bls  = '$_POST[nomor]'
								   WHERE iid = '$_POST[iid]'");	

}
else {
	
  UploadSKeluar($nama_file_unik);
	$data=mysql_fetch_array(mysql_query("SELECT ofile,oid FROM osurat WHERE oid='$_GET[id]'"));
		 unlink("../../skeluar/$data[ofile]"); 
		 
  $q=mysql_query("UPDATE osurat SET otgl	     = '$_POST[tgl]',
                                   itgl	     = '$_POST[tgl_msk]',
                                   opengirim = '$_POST[pengirim]',
								   opengirim1 = '$_POST[pengirim1]',
                                   okepada	 = '$_POST[kepada]', 
                                   operihal	 = '$_POST[perihal]',
								   jenisms	 =  '$_POST[jenisms]',
                                   iid	 	 = '$_POST[iid]',
								   inmr  	 = '$_POST[inmr]',
								   itgl	 	 = '$_POST[tgl_msk]',
								   oket		 = '$_POST[ket]',
								   ofile	 = '$nama_file_unik'
								   WHERE oid = '$_GET[id]'");
								   
$qr=mysql_query("UPDATE isurat SET  itgl_balas  = '$_POST[tgl]',
								   inmr_bls  = '$_POST[nomor]'
								   WHERE iid = '$_POST[iid]'");	

  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }		 
		 	 
									   
  if ($q){
	  echo "<script>window.alert('Data Terupdate');window.location=('../../home.php?pages=sout')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}


// acc surat
elseif ($act=='acc'){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
$tgl_sekarang = date ("Y-m-d");

$query = "SELECT max(onmr) as max_no FROM osurat WHERE onmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("S-%04s/$_SESSION[nppcv]/$bln", $noUrut);
	
	
$q=mysql_query("UPDATE osurat SET onmr 			 = '$newID',
								  otgl			 = '$tgl_sekarang',
								  sstatus   	 = 'Y'
								  WHERE oid = '$_GET[id]'");
  if ($q){
	  echo "<script>window.alert('Data Terupdate/ Surat telah ACC');window.location=('../../home.php?pages=sout')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}

// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT ofile,oid FROM osurat WHERE oid='$_GET[id]'"));
  if ($data['ofile']!=''){
     mysql_query("DELETE FROM osurat WHERE oid='$_GET[id]'");
	 unlink("../../skeluar/$data[ofile]"); 
  }
  else{
     mysql_query("DELETE FROM osurat WHERE oid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=sout')</script>"; 
}
?>
