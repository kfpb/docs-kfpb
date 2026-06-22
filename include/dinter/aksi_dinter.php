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
  $acak           = rand(1,999);
  $acak2           = rand(9999,99999);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $acak.$nama_file;  

function UploadDinter2($fupload_name){
  //direktori file
  $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$_POST[dikodok]'"));
  $vdir_upload = "../../dok/$data[jenisdok]/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

UploadDinter2($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
if (empty($lokasi_file)){
		 $q=mysql_query("INSERT INTO dinter(
                                   dipengirim,
                                   dikodok,
								   direv,
								   dijudok,
								   jenisdok,
								   jenis,
								   ditgl_brlk,
								   ditgl_review,
                                   dipjdok,
								   distatus) 
	                     VALUES('2',
								'$_POST[dikodok]',
								'$_POST[revisi]',
								'$_POST[dijudok]',
								'$_POST[jenisdok]',
								'$_POST[jenis]',
								'$_POST[tgl_brlk]',
								'$_POST[tgl_review]',
								'$_POST[pjdok]',
								'Y')");
		}
		else {
			 $q=mysql_query("INSERT INTO dinter(dipengirim,
                                   dikodok,
								   direv,
								   dijudok,
								   jenisdok,
								   jenis,
								   ditgl_brlk,
								   ditgl_review,
                                   dipjdok,
                                   pass,
                                   distatus,
								   difile) 
	                     VALUES('2',
                                '$_POST[dikodok]',
								'$_POST[revisi]',
								'$_POST[dijudok]',
								'$_POST[jenisdok]',
								'$_POST[jenis]',
								'$_POST[tgl_brlk]',
								'$_POST[tgl_review]',
								'$_POST[pjdok]',
								'$acak2',
								'Y',
								'$nama_file_unik')");
		}
	
							
		
if ($q) {

echo "<script>window.alert('Dokumen Tersimpan');window.location=('../../home.php?pages=dinter')</script>

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

     $q=mysql_query("UPDATE dinter SET jenisdok	 = '$_POST[jenisdok]',
                                   dipjdok = '$_POST[pjdok]',
                                   jenis = '$_POST[jenis]',
                                   pass = '$_POST[pass]',
                                   dok_terkait1 = '$_POST[dokait1]',
                                   dok_terkait2 = '$_POST[dokait2]',
                                   dok_terkait3 = '$_POST[dokait3]',
                                   dikodok = '$_POST[dikodok]',
								   direv = '$_POST[revisi]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   ditgl_rev0 = '$_POST[tgl_rev0]',
								   distatus	 = '$_POST[status]'
								   WHERE suid = '$_GET[id]'");
}


else {
function UploadDinter2($fupload_name){
  //direktori file
  $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$_POST[dikodok]'"));
  $vdir_upload = "../../dok/$data[jenisdok]/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

  
UploadDinter2($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]'"));
if ($data['difile1']==''){ }
else {
unlink("../../fdok/$data[difile1]");
}
if ($_POST['pass']==''){
    $q=mysql_query("UPDATE dinter SET 
                                   jenisdok	 = '$_POST[jenisdok]',
                                   dipjdok = '$_POST[pjdok]',
                                   jenis = '$_POST[jenis]',
                                   pass = '$acak2',
                                   dok_terkait1 = '$_POST[dokait1]',
                                   dok_terkait2 = '$_POST[dokait2]',
                                   dok_terkait3 = '$_POST[dokait3]',
                                   dikodok = '$_POST[dikodok]',
								   direv = '$_POST[revisi]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   ditgl_rev0 = '$_POST[tgl_rev0]',
								   distatus	 = '$_POST[status]',
                                   difile1   = '$_POST[difile1]',
                                   difile    = '$nama_file_unik' WHERE suid = '$_GET[id]'");
    
}
else
{
    $q=mysql_query("UPDATE dinter SET 
                                   jenisdok	 = '$_POST[jenisdok]',
                                   dipjdok = '$_POST[pjdok]',
                                   jenis = '$_POST[jenis]',
                                   pass = '$_POST[pass]',
                                   dok_terkait1 = '$_POST[dokait1]',
                                   dok_terkait2 = '$_POST[dokait2]',
                                   dok_terkait3 = '$_POST[dokait3]',
                                   dikodok = '$_POST[dikodok]',
								   direv = '$_POST[revisi]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   ditgl_rev0 = '$_POST[tgl_rev0]',
								   distatus	 = '$_POST[status]',
                                   difile1   = '$_POST[difile1]',
                                   difile    = '$nama_file_unik' WHERE suid = '$_GET[id]'");   
}

}
								   
								   
  if ($q){
	  echo "<script>window.alert('Dokumen Berhasil Diupdate');window.location=('../../home.php?pages=dinter')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
   
  
}
elseif($act=='edit2'){
$data='ditgl_rev'.$_POST['rev'];
// var_dump($_GET['id']);die();
if ($_POST[tgl_rev]=='0000-00-00'){
    $q=mysql_query("UPDATE dinter SET 
								   $data = NULL 
								   WHERE suid = '$_GET[id]'");   
}
else {
    $q=mysql_query("UPDATE dinter SET 
								   $data = '$_POST[tgl_rev]'
								   WHERE suid = '$_GET[id]'");  
}
  if ($q){
	  echo "<script>window.alert('Dokumen Berhasil Diupdate');window.location=('../../home.php?pages=dinter')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  
}
elseif($act=='edit3'){
$data='ditgl_review'.$_POST['rev'];
if ($_POST['tgl_review']=='0000-00-00'){
    $q=mysql_query("UPDATE dinter SET 
								   $data = NULL 
								   WHERE suid = '$_GET[id]'");   
}
else {
    $q=mysql_query("UPDATE dinter SET 
								   $data = '$_POST[tgl_review]'
								   WHERE suid = '$_GET[id]'");   
  
}
  if ($q){
	  echo "<script>window.alert('Dokumen Berhasil Diupdate');window.location=('../../home.php?pages=dinter')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }

  
}
// hapus smasuk
elseif ($act=='hapus'){
 $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
 $data=mysql_fetch_array(mysql_query("SELECT difile,suid FROM dinter WHERE suid='$_GET[id]'"));
  if ($data['difile']!=''){
     mysql_query("DELETE FROM dinter WHERE suid='$_GET[id]'");
	 mysql_query("DELETE FROM dsin WHERE suid='$_GET[id]'");
	 unlink("../../fdok/$data[difile]"); 
	 
     $alasan = isset($_GET['alasan']) ? mysql_real_escape_string($_GET['alasan']) : 'Tanpa alasan';
     
				if($e['cAudit']=='Y'){
				    
				}else{
	                    $audit=mysql_query("INSERT INTO aktivitas_dokumen(user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
								   kode_dokumen,
								   dokumen,
								   action,
								   deskripsi) 
	                     VALUES('$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$data[dikodok]',
	                            '$data[dijudok]',
	                            'delete',
	                            'Menghapus usulan dokumen $data[dijudok] dengan alasan: $alasan'
	                     )");
				}
  
  }
  else{
     mysql_query("DELETE FROM dinter WHERE suid='$_GET[id]'");
 	 mysql_query("DELETE FROM dsin WHERE suid='$_GET[id]'");
 	   $alasan = isset($_GET['alasan']) ? mysql_real_escape_string($_GET['alasan']) : 'Tanpa alasan';
 	   
				if($e['cAudit']=='Y'){
				    
				}else{
	        $audit=mysql_query("INSERT INTO aktivitas_dokumen(user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
								   kode_dokumen,
								   dokumen,
								   action,
								   deskripsi) 
	                       VALUES('$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$data[dikodok]',
	                            '$data[dijudok]',
	                            'delete',
	                            'Menghapus usulan dokumen $data[dijudok] dengan alasan: $alasan'
	                     )");
				}
  }
	 echo "<script>window.alert('Dokumen Terhapus');window.location=('../../home.php?pages=dinter')</script>";

}

//tambah penerima dan tembusan
elseif ($act=='lp'){
  mysql_query("DELETE FROM dsin WHERE suid='$_GET[id]'");
  $dsin = $_POST["dsin"];
  foreach ($dsin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO dsin(cId,suid,distatus) VALUES ($cid','$_GET[id]','Y')");  
  }
  
  
  if ($q){
	  
	echo "<script>self.history.back();</script>";
  }else{
	  echo "<script>self.history.back();</script>";
  }
}

elseif ($act=='lp1'){
$tgl_sekarang = date ("Y-m-d");

 mysql_query("DELETE FROM dsin WHERE suid='$_GET[id]'");
  $dsin = $_POST["dsin"];
  foreach ($dsin as $x=>$cid)
  {
	$q=mysql_query("INSERT INTO dsin(cId,suid,distatus) VALUES ('$cid','$_GET[id]','Y')");  
  }
  
    if ($q){
	    echo "<script>window.alert('Penerima Salinan disimpan');window.location=('../../home.php?pages=dinter')</script>";
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


	$q2=mysql_query("INSERT INTO ddis(pNoagenda,ptgl,pInstruksi,pSifat,pid,cId,suid,psACC,jawab,disfiles,perubahan) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$ddis','$_GET[suid]','N','$_POST[jawab]','$nama_file_unik','$_POST[perubahan]')"); 
	

        $getkode = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[suid]'"));
        $geddatausulan = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE ukodok LIKE '%$getkode[dikodok]%'"));
        
        
        $revisi = $geddatausulan["udrev"] + 1;
        
        // var_dump($geddatausulan);die();
        if($_POST["perubahan"] == "perubahan"){
             $q=mysql_query("INSERT INTO udokumen(udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
								   ccstatus,
								   udstatus2,
                                   ujudok,
								   udket,
								   uccnmr,
								   udfile) 
	                     VALUES('$tgl_sekarang',
                                '$geddatausulan[udpengusul]',
                                '$geddatausulan[udpengusul2]',
                                '$geddatausulan[udkepada]',
								'2',
								'$geddatausulan[ukodok]',
								'$revisi',
								'N',
								'Y',
								'$geddatausulan[ujudok]',
								'$geddatausulan[udket]',
								'$geddatausulan[uccnmr]',
								'$nama_file_unik')");
								
				
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));

				if($user['cAudit']=='Y'){
				    
				}else{
		                $aktivitas=mysql_query("INSERT INTO aktivitas_dokumen(user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$geddatausulan[ukodok]',
	                            '$geddatausulan[ujudok]',
	                            'create',
	                            'Menambahkan usulan perubahan melalui review dokumen dengan judul $geddatausulan[ujudok]'
	                     )");
				}
        }elseif($_POST["perubahan"] == "penghapusan"){
            
             $q=mysql_query("INSERT INTO udokumen(udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
								   ccstatus,
								   udstatus2,
                                   ujudok,
								   udket,
								   uccnmr,
								   udfile) 
	                     VALUES('$tgl_sekarang',
                                '$geddatausulan[udpengusul]',
                                '$geddatausulan[udpengusul2]',
                                '$geddatausulan[udkepada]',
								'3',
								'$geddatausulan[ukodok]',
								'$revisi',
								'N',
								'Y',
								'$geddatausulan[ujudok]',
								'$geddatausulan[udket]',
								'$geddatausulan[uccnmr]',
								'$nama_file_unik')");
								
				
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
 
				if($user['cAudit']=='Y'){
				    
				}else{
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$geddatausulan[ukodok]',
	                            '$geddatausulan[ujudok]',
	                            'create',
	                            'Menambahkan usulan Penghapusan melalui review dokumen dengan judul $geddatausulan[ujudok]'
	                     )");
				}
        
        }elseif($_POST["perubahan"] == "tidakberubah"){
            
             $q=mysql_query("INSERT INTO udokumen(udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
								   ccstatus,
								   udstatus2,
                                   ujudok,
								   udket,
								   uccnmr,
								   udfile) 
	                     VALUES('$tgl_sekarang',
                                '$geddatausulan[udpengusul]',
                                '$geddatausulan[udpengusul2]',
                                '$geddatausulan[udkepada]',
								'2',
								'$geddatausulan[ukodok]',
								'$revisi',
								'Y',
								'Y',
								'$geddatausulan[ujudok]',
								'$geddatausulan[udket]',
								'$geddatausulan[uccnmr]',
								'$nama_file_unik')");
								
				
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
  
				if($user['cAudit']=='Y'){
				    
				}else{
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$geddatausulan[ukodok]',
	                            '$geddatausulan[ujudok]',
	                            'create',
	                            'Menambahkan usulan Tidak Ada Perubahan melalui review dokumen dengan judul $geddatausulan[ujudok]'
	                     )");
				}
        
        }
	






 $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE ukodok LIKE '%$getkode[dikodok]%'"));

 
 
				if($user['cAudit']=='Y'){
				    
				}else{			
                		$q=mysql_query("INSERT INTO aktivitas_dokumen(user,
                                                   jabatan,
                                                   ip_address,
                                                   user_agent, 
                                				   kode_dokumen,
                                				   dokumen,
                                				   action,
                                				   deskripsi) 
                	                     VALUES('$user[cNama]',
                	                            '$user[cJabatan]',
                	                            '-',
                	                            '-',
                	                            '$geddatausulan[ukodok]',
                	                            '$geddatausulan[ujudok]',
                	                            'create',
                	                            'Melakukan Review Dokumen dengan judul $geddatausulan[ujudok]'
                	                     )");
                }
/*
$tgl			 = date("Y-m-d");
$tglthn          = date("Y")+3;
$tglbln			 = date("-m-d");
$tgl1 = $tglthn.$tglbln;

 $ef = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[suid]'"));
 if ($ef['ditgl_review1']='IS NULL' AND $ef['ditgl_review2']='IS NULL' AND $ef['ditgl_review2']='IS NULL') {
    $q3=mysql_query("UPDATE dinter SET ditgl_review = '$tgl1', 
								   ditgl_review1 = '$_POST[tglm]'
								   WHERE suid = '$_GET[suid]'");   
 }
 elseif ($ef['ditgl_review1']='IS NOT NULL' AND $ef['ditgl_review2']='IS NULL' AND $ef['ditgl_review3']='IS NULL') {
    $q3=mysql_query("UPDATE dinter SET ditgl_review = '$tgl1',  
								   ditgl_review2 = '$_POST[tglm]'
								   WHERE suid = '$_GET[suid]'");   
 }
 elseif ($ef['ditgl_review1']='IS NOT NULL' AND $ef['ditgl_review2']='IS NOT NULL' AND $ef['ditgl_review3']='IS NULL' ) {
     $q3=mysql_query("UPDATE dinter SET ditgl_review = '$tgl1', 
								   ditgl_review3 = '$_POST[tglm]'
								   WHERE suid = '$_GET[suid]'");   
 }
 */
if($_SESSION['levelcv']<2){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Review Tersimpan');window.location=('../../home.php?pages=dinter')</script>";
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


 
if($_SESSION['levelcv']==0){
  if ($q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=dinter')</script>";
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
