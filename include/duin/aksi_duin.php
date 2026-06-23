<?php
require_once "../cek_sesi.php";
if(!isset($_SESSION))
    {
        session_start();
    }
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";
$act=$_GET['act'];

// Input Udmasuk
if ($act=='tambah'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 150000; // maksimal 150 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
 
$tgl_sekarang = date("Y-m-d");
$thn			 = date("Y");
$bln			 = date("m/Y");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("UD-%04s/$bln", $noUrut);

 $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
//   var_dump($e);die();
 
 if($_POST['jenisud'] == 1){
     $kalimat = "Usulan Pembuatan Dokumen Baru";
 }elseif($_POST['jenisud'] == 2){
     $kalimat = "Usulan Perubahan Dokumen";
 }elseif($_POST['jenisud'] == 3){
     
     $kalimat = "Usulan Penghapusan Dokumen";
 }
 
 $rand = mt_rand(100000,999999);
//  var_dump($rand);die();
if (empty($lokasi_file)){
	 $q=mysql_query("INSERT INTO udokumen(udtgl,
                                  udpengusul,
                                  udpengusul2,
                                  udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
								   ccstatus,
                                  ujudok,
								   udket,
								   uccnmr,
								   kode_aktivitas) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengusul]',
                                '$_POST[pengusul2]',
                                '$_POST[kepada]',
								'$_POST[jenisud]',
								'$_POST[ukodok]',
								'$_POST[revisi]',
								'N',
								'$_POST[ujudok]',
								'$_POST[udket]',
								'$_POST[uccnmr]',
								'DOK-$rand')");
				$idusulan = mysql_insert_id();
				
				
		$cc = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
        $cd = mysql_num_rows(mysql_query("SELECT * FROM dsin WHERE suid='$cc[suid_dinter]'"));
          
        
              
              $disin = $_POST["disin"];
              $no=1;
        //  var_dump($disin);die();
              foreach ($disin as $x=>$cid1)
              {
            	$q=mysql_query("INSERT INTO disin(copyke,cId,suid) VALUES ('$no','$cid1','$idusulan')");  
            	$no++;
              }
          
         
  
				if($e['cAudit']=='Y'){
				    
				}else{
				    $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                            user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
								   kode_dokumen,
								   dokumen,
								   action,
								   deskripsi) 
	                     VALUES('DOK-$rand',
	                            '$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$_POST[ukodok]',
	                            '$_POST[ujudok]',
	                            'create',
	                            'Manambahkan $kalimat dengan judul $_POST[ujudok]'
	                     )");
				}				
		
								
		 if ($q){
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	 echo "<script>window.alert('Data Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Tersimpan, Klik Kirim Usulan Untuk mengirimkan Usulan');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
} else {
  UploadUdmasuk($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
	
  $q=mysql_query("INSERT INTO udokumen(udtgl,
                                   udpengusul,
                                   udpengusul2,
                                   udkepada, 
								   jenisud,
								   ukodok,
								   udrev,
								   ccstatus,
                                   ujudok,
								   udket,
								   uccnmr,
								   udfile,
								   kode_aktivitas) 
	                     VALUES('$_POST[tgl]',
                                '$_POST[pengusul]',
                                '$_POST[pengusul2]',
                                '$_POST[kepada]',
								'$_POST[jenisud]',
								'$_POST[ukodok]',
								'$_POST[revisi]',
								'N',
								'$_POST[ujudok]',
								'$_POST[udket]',
								'$_POST[uccnmr]',
								'$nama_file_unik',
								'DOK-$rand')");
				$idusulan = mysql_insert_id();
					$cc = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
                    $cd = mysql_num_rows(mysql_query("SELECT * FROM dsin WHERE suid='$cc[suid_dinter]'"));
                      
                    
            
                          
                          $disin = $_POST["disin"];
                          $no=1;
                     
                          foreach ($disin as $x=>$cid1)
                          {
                        	$q=mysql_query("INSERT INTO disin(copyke,cId,suid) VALUES ('$no','$cid1','$idusulan')");  
                        	$no++;
                          }
                      
                 
				if($e['cAudit']=='Y'){
				    
				}else{  
					
					$q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
					                user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
								   kode_dokumen,
								   dokumen,
								   action,
								   deskripsi) 
	                     VALUES('DOK-$rand',
	                            '$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$_POST[ukodok]',
	                            '$_POST[ujudok]',
	                            'create',
	                            'Manambahkan $kalimat dengan judul $_POST[ujudok]'
	                     )");
				}

  if ($q){
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	 echo "<script>window.alert('Data Usulan Dokumen Tersimpan');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Tersimpan, Klik Kirim Usulan Untuk mengirimkan Usulan');window.location=('../../home.php?pages=usrtd')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  
  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
}
}
//update Udmasuk
elseif($act=='edit'){

 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 10 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  
  
 $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
$udbhs = $_POST["udbhs"];
  
if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
	
  $q=mysql_query("UPDATE udokumen SET	udtgl	 	= '$_POST[tgl]',
										udtgl_selesai = '$_POST[tgl_selesai]',
										udtgl_terima = '$_POST[tgl_terima]',
										udtgl_bahas = '$_POST[tgl_bahas]',
										ud_bahas_oleh = '$_POST[udbhs]',
										udpengusul 	= '$_POST[pengusul]',
										udstatus	= '$_POST[statusud]',
										jenisud	 	= '$_POST[jenisud]',
										udkepada    = '$_POST[udkepada]',
										ukodok	 	= '$_POST[ukodok]',
										udrev	 	= '$_POST[revisi]',
										ujudok	 	= '$_POST[ujudok]',
										udnmr      = '$_POST[udnmr]',
										uccnmr      = '$_POST[uccnmr]',
										udket		= '$_POST[ket]'
										WHERE uid = '$_GET[id]'");
										
				
				if($e['cAudit']=='Y'){
				    
				}else{					
										
						$q=mysql_query("INSERT INTO aktivitas_dokumen(user,
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
	                            '$_POST[ukodok]',
	                            '$_POST[ujudok]',
	                            'update',
	                            'Mengubah usulan dokumen dengan judul $_POST[ujudok]'
	                     )");
				}
}

else {
    
UploadUdmasuk($nama_file_unik);
$data=mysql_fetch_array(mysql_query("SELECT udfile,uid FROM udokumen WHERE uid='$_GET[id]'"));
	 unlink("../../udmasuk/$data[udfile]"); 
	 
 $q=mysql_query("UPDATE udokumen SET    udtgl	 	= '$_POST[tgl]',
										udtgl_selesai = '$_POST[tgl_selesai]',
										udtgl_terima = '$_POST[tgl_terima]',
										udtgl_bahas = '$_POST[tgl_bahas]',	
										ud_bahas_oleh = '$_POST[udbhs]',
										udpengusul 	= '$_POST[pengusul]',
										udstatus	= '$_POST[statusud]',
										jenisud	 	= '$_POST[jenisud]',
										udkepada    = '$_POST[udkepada]',
										ukodok	 	= '$_POST[ukodok]',
										udrev	 	= '$_POST[revisi]',
										ujudok	 	= '$_POST[ujudok]',
										udnmr      = '$_POST[udnmr]',
										uccnmr      = '$_POST[uccnmr]',
										udket		= '$_POST[ket]',
										udfile	=	'$nama_file_unik'
										WHERE uid = '$_GET[id]'");

				if($e['cAudit']=='Y'){
				    
				}else{		
										
						$q=mysql_query("INSERT INTO aktivitas_dokumen(user,
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
	                            '$_POST[ukodok]',
	                            '$_POST[ujudok]',
	                            'update',
	                            'Mengubah usulan dokumen dengan judul $_POST[ujudok]'
	                     )");
				}
							   
}							   
 if ($q){
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	    echo "<script>window.alert('Usulan Dokumen Terkirim');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Berhasil Diedit');window.location=('../../home.php?pages=usulandok')</script>";
	}
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

   
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }
  
}
// hapus Udmasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT udfile,uid,ujudok,ukodok FROM udokumen WHERE uid='$_GET[id]'"));
 
 $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
  if ($data['udfile']!=''){
      
	 unlink("../../udmasuk/$data[udfile]"); 
  }
  $alasan = isset($_GET['alasan']) ? mysql_real_escape_string($_GET['alasan']) : 'Tanpa alasan';
  mysql_query("DELETE FROM udokumen WHERE uid='$_GET[id]'");
  mysql_query("DELETE FROM alurusulan WHERE uid='$_GET[id]'");
  mysql_query("DELETE FROM uddis WHERE uid='$_GET[id]'");
  
				if($e['cAudit']=='Y'){
				    
				}else{
						$q=mysql_query("INSERT INTO aktivitas_dokumen(user,
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
	                            '$data[ukodok]',
	                            '$data[ujudok]',
	                            'delete',
	                            'Menghapus usulan dokumen $data[ujudok] dengan alasan: $alasan'
	                     )");
	                     
				}
  
  if($_SESSION[cv]==0){
	 echo "<script>window.alert('Usulan Dokumen Terhapus');window.location=('../../home.php?pages=usulandok')</script>";
	} else {
		echo "<script>window.alert('Usulan Dokumen Dihapus');window.location=('../../home.php?pages=usulandok')</script>";
	}
 
}

// acc Changecontrol
elseif ($act=='accchangecontrol'){

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));

$bln_sekarang = date("y-m.");


$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%B$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("B$bln-$thn/$f[bagian]%03s", $noUrut);

    
    $q=mysql_query("UPDATE udokumen  SET uccnmr 	 = '$_POST[nocc]',
								    cctgl_status    = '$tgl_sekarang',
								    ccstatus        = 'Y'
								  WHERE uid      = '$_GET[id]'")or die(mysql_error());


	

        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
        
         
         if($e['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($e['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($e['jenisud'] == 3){
             
             $kalimat = "Usulan Penghapusan Dokumen";
         }
         
  
				if($user['cAudit']=='Y'){
				    
				}else{
							
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]','$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'approve',
	                            'Menyetujui $kalimat dengan judul Dokumen $e[ujudok]. dan nomor CC $_POST[nocc] Untuk Di terima MR'
	                     )");
	                     
				}

  if ($q){
	  echo "<script>window.alert('Usulan telah diterima');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}

// Return cc
elseif ($act=='returncc'){

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));

$bln_sekarang = date("y-m.");


$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%B$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("B$bln-$thn/$f[bagian]%03s", $noUrut);

    
    $q=mysql_query("UPDATE udokumen  SET cctgl_status   = '$tgl_sekarang',
								    ccstatus      = 'N',
								    udstatus2       = 'N',
								    udstatus3       = 'Y',
								    ccstatus_ket = '$_POST[keterangan]'
								  WHERE uid      = '$_GET[id]'")or die(mysql_error());



         $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
        
         
         if($e['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($e['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($e['jenisud'] == 3){
             $kalimat = "Usulan Penghapusan Dokumen";
         }
         
         $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
  
				if($e['cAudit']=='Y'){
				    
				}else{
							
		            $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'reject',
	                            'Mengembalikan $kalimat dengan judul $e[ujudok] ke user terkait, Alasan : $_POST[keterangan]'
	                     )");
	                     
				}
	

  if ($q){
	  echo "<script>window.alert('Usulan telah dikembalikan ke User');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}
// acc
elseif ($act=='acc'){

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$maxsize 		  = 1024 * 25000; // maksimal 25 MB
$size_file	  = $_FILES['fupload']['size']<=$maxsize;
$acak           = rand(1,99);
$bln_sekarang = date("y-m.");
$nama_file_unik = $bln_sekarang.$acak.$nama_file;  

if ($e[jenisud]=1){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%B$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("B$bln-$thn/$f[bagian]%03s", $noUrut);
}
elseif ($e[jenisud]=2){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%R$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("R$bln-$thn/$f[bagian]%03s", $noUrut);
}
elseif ($e[jenisud]=3){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%O$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("O$bln-$thn/$f[bagian]%03s", $noUrut);
}


if ($e[uccnmr]=='') {
    
    $q=mysql_query("UPDATE udokumen  SET udnmr 	 = '$newID',
								  udtgl	         = '$tgl_sekarang',
								  udstatus2      = 'Y'
								  WHERE uid      = '$_GET[id]'");
								  
								  
}	

else {
    
    $q=mysql_query("UPDATE udokumen  SET udnmr 	 = '$newID',
								  udtgl	         = '$tgl_sekarang',
								  ukepada        = '2',
								  udtgl_acc      = '$tgl_sekarang',
								  udstatus2      = 'Y'
								  WHERE uid      = '$_GET[id]'"); 
}

	

  if ($q){
	  echo "<script>window.alert('Usulan telah dikirim);window.location=('../../home.php?pages=usrtd')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}


// acc MR/MPM (tidak dipakai)
elseif ($act=='acc2'){
$tgl_sekarang = date("Y-m-d");
    $q=mysql_query("UPDATE udokumen SET udtgl_acc	 = '$tgl_sekarang',
                                  udkepada        = '2',
								  ud_comment     = '$_POST[comment0],$_POST[comment]'
								  WHERE uid      = '$_GET[id]'");

  if ($q){
	  echo "<script>window.alert('Sukses di kirim');window.location=('../../home.php')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Terkirim');self.history.back();</script>";
  }
}

elseif ($act=='selesai2'){
    
    $tgl = date("Y-m-d");
    $q = mysql_query("UPDATE udokumen SET ukodok='$_POST[kode_dok]', udtgl_selesai = '$_POST[tgl_selesai]', udstatus = '2' WHERE uid = '$_GET[id]'");
    
    $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'")); // Ambil data user
    
    if ($_POST['jenisud'] == 1) {
        //jenis Usulan Dokumen Baru
        $r = mysql_query("INSERT INTO dinter(dipengirim, dikodok, direv, dijudok, jenisdok, jenis, ditgl_brlk, ditgl_review, dipjdok, ditgl_rev0, distatus)
            VALUES('2','$_POST[kode_dok]','$_POST[revisi]','$_POST[judul_dok]','$_POST[jenisdok]','$_POST[jenis]','$_POST[tgl_berlaku]','$_POST[tgl_review]','$_POST[pjdok]','$_POST[tgl_berlaku]','Y')");
      	
      $idusulan = mysql_insert_id();
      $dsin = $_POST["disin"];
      $idudokumen = $_POST["id_udokumen"];
        //   mysql_query("DELETE FROM dsin WHERE suid='$cc[suid_dinter]'");
        //   foreach ($dsin as $y=>$cid)
        //   {
              
            $updateDisin =mysql_query("UPDATE disin SET suid='$idusulan' WHERE suid='$idudokumen' ");
        // 	$t=mysql_query("INSERT INTO disin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");  
        //   } 
          
        // Tambahkan aktivitas dokumen untuk jenisud == 1
        if ($r) { // Pastikan query $r berhasil sebelum mencatat aktivitas
          if($user['cAudit']!='Y'){ // Cek apakah audit tidak aktif
            $q_aktivitas = mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas, user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi)
                VALUES('$_POST[kode_aktivitas]','{$user['cNama']}','{$user['cJabatan']}','-','-','$_POST[kode_dok]','$_POST[judul_dok]','create','Menambahkan Usulan Pembuatan Dokumen Baru')");
              if(!$q_aktivitas) {
                error_log("Gagal insert aktivitas dokumen jenis 1: " . mysql_error());
              }
          }
        }
    
    
    } elseif ($_POST['jenisud'] == 2) {
        //jenis Usulan Perubahan
        $ditgl = "ditgl_rev";
        $dipost = $_POST['revisi'];
        $di = $ditgl.$dipost;
        // var_dump($di);die();
    
        $r = mysql_query("UPDATE dinter SET jenisdok = '$_POST[jenisdok]', dipjdok = '$_POST[pjdok]', jenis = '$_POST[jenis]', dikodok = '$_POST[kode_dok]', direv = '$_POST[revisi]', dijudok = '$_POST[judul_dok]', ditgl_brlk = '$_POST[tgl_berlaku]', ditgl_review = '$_POST[tgl_review]', $di = '$_POST[tgl_berlaku]' WHERE dikodok = '$_POST[kode_dok]'")or die(mysql_error());	
        
        
        $idusulan = mysql_fetch_array(mysql_query("SELECT suid FROM dinter WHERE dikodok = '$_POST[kode_dok]'"));

        //   $idusulan = mysql_insert_id();
      $dsin = $_POST["disin"];
      $idudokumen = $_POST["id_udokumen"];
      
        //   foreach ($dsin as $y=>$cid)
        //   {
              
            $updateDisin =mysql_query("UPDATE disin SET suid='$idusulan' WHERE suid='$idudokumen' ");
        // 	$t=mysql_query("INSERT INTO disin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");  
        //   } 
          
        // Tambahkan aktivitas dokumen untuk jenisud == 2
          if ($r) {  // Pastikan query $r berhasil sebelum mencatat aktivitas
            if($user['cAudit']!='Y'){ // Cek apakah audit tidak aktif
            $q_aktivitas = mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas, user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi)
                VALUES('$_POST[kode_aktivitas]','{$user['cNama']}','{$user['cJabatan']}','pages=usulandok&act=selesai&id=$_POST[id_udokumen]','-','$_POST[kode_dok]','$_POST[judul_dok]','update','Memperbarui Usulan Perubahan Dokumen NET/Selesai $_POST[judul_dok]')");
               if(!$q_aktivitas) {
                error_log("Gagal insert aktivitas dokumen jenis 2: " . mysql_error());
              }
          }
        }
    
    } elseif ($_POST['jenisud'] == 3) {
        $r = mysql_query("UPDATE dinter SET distatus = 'N', dijudok = '$_POST[judul_dok] (OBSOLETE)' WHERE dikodok = '$_POST[kode_dok]'");
    //       $idusulan = mysql_insert_id();
    //   $dsin = $_POST["disin"];
    //   $idudokumen = $_POST["id_udokumen"];
      
        //   mysql_query("DELETE FROM dsin WHERE suid='$cc[suid_dinter]'");
        //   foreach ($dsin as $y=>$cid)
        //   {
              
            // $updateDisin =mysql_query("UPDATE disin SET suid='$idusulan' WHERE suid='$idudokumen' ");
        // 	$t=mysql_query("INSERT INTO disin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");  
        //   } 
          
          
        // Tambahkan aktivitas dokumen untuk jenisud == 3
         if ($r) { // Pastikan query $r berhasil sebelum mencatat aktivitas
          if($user['cAudit']!='Y'){ // Cek apakah audit tidak aktif
            $q_aktivitas = mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas, user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi)
                VALUES('$_POST[kode_aktivitas]','{$user['cNama']}','{$user['cJabatan']}','-','-','$_POST[kode_dok]','$_POST[judul_dok]','delete','Menambahkan Usulan Penghapusan Dokumen')");
              if(!$q_aktivitas) {
                error_log("Gagal insert aktivitas dokumen jenis 3: " . mysql_error());
              }
          }
        }
    }
    
    if ($r) {
        echo "<script>window.alert('Usulan Dokumen Selesai & Tersimpan, Silahkan Buat Distribusi Dokumen !');window.location=('../../home.php?pages=dister&act=tambah2&id=$_POST[kode_dok]')</script>";
    } else {
        echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
    }
}
//tambah alur usulan
elseif ($act=='tambahalur'){
  	
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 UploadAlur($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
   
        $q1=mysql_query("INSERT INTO alurusulan (dNoalur,dPengirim,uid) VALUES('$_POST[noalur]','$_POST[pengirim]','$_GET[uid]')");
	                     
	    $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[uid]'"));
        
         
         if($e['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($e['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($e['jenisud'] == 3){
             $kalimat = "Usulan Penghapusan Dokumen";
         }
							
					
				if($user['cAudit']=='Y'){
				    
				}else{
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'reject',
	                            'Membuat Alur usulan kirim kembali $kalimat dengan judul $e[ujudok] ke user terkait'
	                     )");
				}
  }else {
      
   $q1=mysql_query("INSERT INTO alurusulan (dNoalur,dPengirim,uid,disfile) VALUES('$_POST[noalur]','$_POST[pengirim]','$_GET[uid]','$nama_file_unik')");
	                     
	    $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[uid]'"));
        
         
         if($e['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($e['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($e['jenisud'] == 3){
             $kalimat = "Usulan Penghapusan Dokumen";
         }
						
						
						
				if($user['cAudit']=='Y'){
				    
				}else{	
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'reject',
	                            'Membuat Alur usulan kirim kembali $kalimat dengan judul $e[ujudok] ke user terkait'
	                     )");
				}
  }
	  
 
  $uddis = $_POST["uddis"];
  foreach ($uddis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO uddis(pNoalur,ptgl,ptgls,pInstruksi,pSifat,pId,cId,uid,psACC,jawab) 
	VALUES ('$_POST[noalur]','$_POST[tglm]','$_POST[tgls]','$_POST[isi]','$_POST[sifat]','$_POST[pengirim]','$cid','$_GET[uid]','N','$_POST[jawab]')"); 

 }
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[uid]'"));
        
         
         if($e['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($e['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($e['jenisud'] == 3){
             $kalimat = "Usulan Penghapusan Dokumen";
         }
					
				if($user['cAudit']=='Y'){
				    
				}else{		
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'reject',
	                            'Membuat Alur usulan kirim kembali $kalimat dengan judul $e[ujudok] ke user terkait'
	                     )");
				}


  if($_SESSION[cv]==0){
      if ($q1){
    	  echo "<script>window.alert('Data Alur Usulan Terkirim');window.location=('../../home.php?pages=usulandok2')</script>";
      }else{
    	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
      }
  }else {
       if ($q1 && $q2){
            echo "<script>window.alert('Alur Usulan terkirim!');window.location=('../../home.php?pages=usulandok2')</script>";	  	
      }else{
    	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
      } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  
//tambah alur usulan
}

elseif($act=='editalur'){
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

 
        $data=mysql_fetch_array(mysql_query("SELECT * FROM uddis WHERE pudid='$_GET[uid]'")); 
        
        $q1= mysql_query("UPDATE uddis SET ptgl	= '$_POST[ptgl]', psTglbaca = '$_POST[psTglBaca]', psTglselesai = '$_POST[psTglselesai]' WHERE pudid = '$_GET[uid]'")or die(mysql_error());	
		
		$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$data[uid]'"));
        
				if($user['cAudit']=='Y'){
				    
				}else{
							
		            $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('-',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            'No Alur $data[pNoalur] | $e[ujudok]',
	                            '$e[uccnmr]',
	                            'update',
	                            'Mengedit Alur usulan kirim kembali dengan no alur $data[pNoalur] ke user terkait'
	                     )");	
				}
	                     
	  if ($q1){
            echo "<script>window.alert('Alur Usulan Berhasil Diedit!');window.location=('../../home.php?pages=usulandok&act=detail&id=$_POST[usulanid]')</script>";	  	
      }else{
    	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
      } 

  }
	  

elseif($act=='hapusalur'){
    
    $q1=mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dId = '$_GET[id]'"));
    $hapusalur = mysql_query("DELETE FROM alurusulan WHERE dId='$_GET[id]'");
    $hapuspudid = mysql_query("DELETE FROM uddis WHERE pudid='$_GET[idpudid]'");
		$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$q1[uid]'"));
        
				if($e['cAudit']=='Y'){
				    
				}else{
	                $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'delete',
	                            'Menghapus Alur usulan $q1[dNoalur]'
	                     )");
	                     
				}

     if ($hapusalur){
    	  echo "<script>window.alert('Data Alur Usulan Terhapus');window.location=('../../home.php?pages=usulandok&act=detail&id=$q1[uid]')</script>";
      }else{
    	  echo "<script>window.alert('Data Gagal Terhapus');self.history.back();</script>";
      }
}
//batas dari aksi_alurusulan.php

elseif($act=='editalur2'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 25000; // maksimal 25 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;  

$data=mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE uid='$_GET[uid]'")); 
 UploadAlur($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
    if (empty($lokasi_file)){
   
// 	$data=mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE uid='$_GET[uid]'")); 

	$datax = mysql_fetch_array(mysql_query("SELECT * FROM uddis WHERE pudid='$_GET[xmlxx]'")); 

    $file =	$data['disfile'];
    $q1=mysql_query("UPDATE alurusulan SET disfile	= '$file',
                                            dPengirim = '$_POST[pengirim]'
										WHERE dNoalur = '$datax[pNoalur]'");
  }
  else {
	$datax = mysql_fetch_array(mysql_query("SELECT * FROM uddis WHERE pudid='$_GET[xmlxx]'")); 
      
    $q1=mysql_query("UPDATE alurusulan SET  disfile	= '$nama_file_unik',
                                            dPengirim = '$_POST[pengirim]'
										WHERE dNoalur='$datax[pNoalur]' ");
  }
	  
    $uddis = $_POST["uddis"];
	$q1=mysql_query("UPDATE uddis SET pNoalur = '$_POST[noalur]',
	                                   ptgl = '$_POST[tglm]',
	                                   ptgls = '$_POST[tgls]',
	                                   pInstruksi = '$_POST[isi]',
	                                   pSifat = '$_POST[sifat]',
	                                   pId = '$_POST[pengirim]',
	                                   cId = '$_POST[uddis]',
	                                   psTglbaca = '$_POST[psTglbaca]',
	                                   psTglselesai = '$_POST[psTglselesai]',
	                                   jawab = '$_POST[jawab]'
	                                   WHERE pudid = '$_GET[xmlxx]' "); 

//  }
  
  if($_SESSION[cv]==0){
  if ($q1){
	  	    
	  echo "<script>window.alert('Data Alur Usulan Terupdate');window.location=('../../home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Terupdate');self.history.back();</script>";
  }
  }
  else {
   if ($q1){

  echo "<script>window.alert('Alur Usulan Terupdate!');window.location=('../../home.php?pages=usulandok')</script>";	  	
	  
  }else{
	  echo "<script>window.alert('Data Gagal Terupdate');self.history.back();</script>";
  } 
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  
//tambah alur usulan
}elseif($act=='kirimusulan'){
    
$tgl_sekarang = date("Y-m-d");

     $q=mysql_query("UPDATE udokumen  SET udtgl_kirimusulan	         = '$tgl_sekarang',
								  udstatus2      = 'Y',
								  udstatus3      = 'N'
								  WHERE uid      = '$_GET[id]'");
								  
	
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
        $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
        
         
         if($e['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($e['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($e['jenisud'] == 3){
             
             $kalimat = "Usulan Penghapusan Dokumen";
         }
					
				if($user['cAudit']=='Y'){
				    
				}else{	
		                $q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                           user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$e[kode_aktivitas]',
	                            '$user[cNama]',
	                            '$user[cJabatan]',
	                            '-',
	                            '-',
	                            '$e[ukodok]',
	                            '$e[ujudok]',
	                            'create',
	                            'Mengirimkan $kalimat dengan judul $e[ujudok]'
	                     )");
				}
								  
	if ($q){
          echo "<script>window.alert('Usulan Dokumen Terkirim');window.location=('../../home.php?pages=usrtd')</script>";
    }else{
    	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
    }
}
?>