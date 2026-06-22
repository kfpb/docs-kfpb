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
  $maxsize 		  = 1024 * 150000; 
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,999);
  $acak2          = rand(9999,99999);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $acak.$nama_file;   
  $dikodok = $_POST['jenisdok'];
//   var_dump($lokasi_file);die();
 $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$dikodok'"));

function UploadDinter2($fupload_name){
  //direktori file
  $dikodok = $_POST['jenisdok'];
  
 $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$dikodok'"));
 $jenisdok = $data['jenisdok'];
  $vdir_upload = "../../dok/$dikodok/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  $cek = move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
//   var_dump($vfile_upload);die();
}
								
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));

 
         if($_POST['jenisud'] == 1){
             $kalimat = "Usulan Pembuatan Dokumen Baru";
         }elseif($_POST['jenisud'] == 2){
             $kalimat = "Usulan Perubahan Dokumen";
         }elseif($_POST['jenisud'] == 3){
             
             $kalimat = "Usulan Penghapusan Dokumen";
         }
         
    $get_kodeaktivitas = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE ukodok='$_POST[dikodok]'"));

UploadDinter2($nama_file_unik);
if($_FILES['fupload']['size']<=$maxsize){
if (empty($lokasi_file)){
    $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$_POST[dikodok]'"));
    
    
                $t=mysql_query("UPDATE dinter SET direv        = '$_POST[revisi]', 
                                   ditgl_brlk   = '$_POST[tgl_brlk]', 
                                   ditgl_review  = '$_POST[tgl_review]'
								   WHERE suid = '$data[suid]'");
    
		 $q=mysql_query("INSERT INTO dister(suid_dinter,
		                           ditgl,
                                  dipengirim,
                                  dikodok,
								   direv,
								   dikodok1,
								   direv1,
								   dijudok,
								   jenisdok,
								   ditgl_brlk,
								   ditgl_review,
                                  diket,
								   distatus) 
	                     VALUES('$data[suid]',
	                            '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[dikodok]',
								'$_POST[revisi]',
								'$_POST[dikodok1]',
								'$_POST[revisi1]',
								'$_POST[dijudok]',
								'$_POST[jenisdok]',
								'$_POST[tgl_brlk]',
								'$_POST[tgl_review]',
								'$_POST[ket]',
								'N')");
				// $idusulan = mysql_insert_id();
    //             $dsin = $_POST["disin"];
    //             $idudokumen = $_POST["id_udokumen"];
            
    //             $updateDisin =mysql_query("UPDATE disin SET suid='$idusulan' WHERE suid='$data[suid]' ");			
  
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
	                     VALUES('$get_kodeaktivitas[kode_aktivitas]',
	                            '$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$_POST[dikodok]',
	                            '$get_kodeaktivitas[ujudok]',
	                            'create',
	                            'Menambahkan distribusi dokumen dengan judul $_POST[dijudok]'
	                     )");
	                     
				}
		}
		else {
		UploadDinter2($nama_file_unik);
        $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$_POST[dikodok]'"));
            $t=mysql_query("UPDATE dinter SET pass = '$acak2',
                                   direv        = '$_POST[revisi]', 
                                   ditgl_brlk   = '$_POST[tgl_brlk]', 
                                   ditgl_review  = '$_POST[tgl_review]', 
                                   difile1    = '$data[difile]',
								   difile    =  '$nama_file_unik'
								   WHERE suid = '$data[suid]'");
        
			 $q=mysql_query("INSERT INTO dister(suid_dinter,
			                       ditgl,
                                  dipengirim,
                                  dikodok,
								   direv,
								   dikodok1,
								   direv1,
								   dijudok,
								   jenisdok,
								   ditgl_brlk,
								   ditgl_review,
                                  diket,
								   distatus) 
	                     VALUES('$data[suid]',
	                            '$_POST[tgl]',
                                '$_POST[pengirim]',
								'$_POST[dikodok]',
								'$_POST[revisi]',
								'$_POST[dikodok1]',
								'$_POST[revisi1]',
								'$_POST[dijudok]',
								'$_POST[jenisdok]',
								'$_POST[tgl_brlk]',
								'$_POST[tgl_review]',
								'$_POST[ket]',
								'N')");
				// $idusulan = mysql_insert_id();
    //             $dsin = $_POST["disin"];
    //             $idudokumen = $_POST["id_udokumen"];
            
    //             $updateDisin =mysql_query("UPDATE disin SET suid='$idusulan' WHERE suid='$data[suid]' ");	
		
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
	                     VALUES('$get_kodeaktivitas[kode_aktivitas]',
	                            '$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$_POST[dikodok]',
	                            '$get_kodeaktivitas[ujudok]',
	                            'create',
	                            'Menambahkan distribusi dokumen dengan judul $_POST[dijudok]'
	                     )");
				}
		}
	
							
		
  if ($q){
    echo "<script>window.alert('Distribusi Dokumen tersimpan, Pilih Penerima dan klik Kirim');window.location=('../../home.php?pages=dister')</script>";
     if($cek) {
      echo "Successfully uploaded";         
    } else {
      echo "Not uploaded because of error #".$_FILES["file"]["error"];
    }
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan!');self.history.back();</script>";
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
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $acak.$nama_file; 
  
 $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
function UploadDinter2($fupload_name){
  //direktori file
//   $data=mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$_POST[dikodok]'"));
  $data=mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE dikodok='$_POST[dikodok]'"));
  $vdir_upload = "../../dok/$data[jenisdok]/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

if($_FILES['fupload']['size']<=$maxsize){

if (empty($lokasi_file)){
    
     $q=mysql_query("UPDATE dister SET ditgl 	  = '$_POST[tgl]',
								   ditgl_slesai	  = '$_POST[tgl_slesai]',
								   jenisdok	 = '$_POST[jenisdok]',
                                   dikodok = '$_POST[dikodok]',
								   direv = '$_POST[revisi]',
                                   dikodok1 = '$_POST[dikodok1]',
								   direv1 = '$_POST[revisi1]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   ditgl_selesaipenarikan = '$_POST[ditgl_selesaipenarikan]',
								   diket	 = '$_POST[ket]'
								   WHERE suid = '$_GET[id]'");
								   
					
				if($e['cAudit']=='Y'){
				    
				}else{			   
	                $audit=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                            user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$data[kode_aktivitas]',
	                            '$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$data[dikodok]',
	                            '$data[dijudok]',
	                            'create',
	                            'Menambahkan distribusi dokumen dengan judul $data[dijudok]'
	                     )");
				}
    
}else {
 UploadDinter2($nama_file_unik);
 $data=mysql_fetch_array(mysql_query("SELECT difile,suid,jenisdok FROM dinter WHERE dikodok='$_POST[dikodok]'"));
 unlink("../../dok/$data[jenisdok]/$data[difile]"); 

  $t=mysql_query("UPDATE dinter SET pass = '$acak2',
								   difile    = '$nama_file_unik'
								   WHERE suid = '$data[suid]'");


  $q=mysql_query("UPDATE dister SET ditgl 	  = '$_POST[tgl]',
								   ditgl_slesai 	  = '$_POST[tgl_slesai]',
								   jenisdok	 = '$_POST[jenisdok]',
                                   dikodok = '$_POST[dikodok]',
                                   difile = '$nama_file_unik',
								   direv = '$_POST[revisi]',
                                   dikodok1 = '$_POST[dikodok1]',
								   direv1 = '$_POST[revisi1]',
								   dijudok = '$_POST[dijudok]',
								   ditgl_brlk = '$_POST[tgl_brlk]',
								   ditgl_review = '$_POST[tgl_review]',
								   ditgl_selesaipenarikan = '$_POST[ditgl_selesaipenarikan]',
								   diket	 = '$_POST[ket]'
								   WHERE suid = '$_GET[id]'");
					
				if($e['cAudit']=='Y'){
				    
				}else{
                        $audit=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                            user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
                				   kode_dokumen,
                				   dokumen,
                				   action,
                				   deskripsi) 
	                     VALUES('$data[kode_aktivitas]',
	                            '$e[cNama]',
	                            '$e[cJabatan]',
	                            '-',
	                            '-',
	                            '$data[dikodok]',
	                            '$data[dijudok]',
	                            'create',
	                            'Menambahkan distribusi dokumen dengan judul $data[dijudok]'
	                     )");
				}
}
								   
								   
  if ($q){
	  echo "<script>window.alert('Distribusi Dokumen Terupdate');window.location=('../../home.php?pages=dister')</script>";
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
    
    
    // id di sini adalah suid di tabel dister
    $suid = isset($_GET['id']) ? $_GET['id'] : '';

    if ($suid == '') {
        echo "<script>
                alert('ID distribusi tidak valid.');
                window.location='../../home.php?pages=dister';
              </script>";
        exit;
    }

    $tgl_sekarang = date("Y-m-d");
    $thn          = date("Y");
    $bln          = date("m/Y");

    // cek data distribusi
    $q_dister = mysql_query("SELECT * FROM dister WHERE suid = '$suid'");
    $dister   = mysql_fetch_array($q_dister);

    if (!$dister) {
        echo "<script>
                alert('Data distribusi tidak ditemukan.');
                window.location='../../home.php?pages=dister';
              </script>";
        exit;
    }

    // kalau sudah pernah di-ACC, jangan diproses lagi
    if ($dister['distatus'] == 'Y') {
        echo "<script>
                alert('Distribusi dokumen ini sudah pernah dikirim / ACC sebelumnya.');
                window.location='../../home.php?pages=dister';
              </script>";
        exit;
    }

    // ambil max nomor tahun berjalan
    $q_max   = mysql_query("SELECT MAX(dinmr) AS max_no FROM dister WHERE dinmr LIKE '%$thn%'");
    $dataMax = mysql_fetch_array($q_max);
    $idMax   = $dataMax['max_no'];

    if ($idMax != '' && strlen($idMax) >= 7) {
        // contoh dinmr: DD-0005/11/2025
        // ambil 4 digit nomor urut
        $noUrut = (int) substr($idMax, 3, 4);
    } else {
        $noUrut = 0;
    }

    // generate nomor baru
    $noUrut++;
    $newID = sprintf("DD-%04s/%s", $noUrut, $bln);

    // update dister (isi nomor & status)
    $q_update = mysql_query("
        UPDATE dister 
        SET dinmr = '$newID',
            distatus = 'Y'
        WHERE suid = '$suid'
    ");

    if (!$q_update) {
        error_log("Gagal update dister suid=$suid : " . mysql_error());
        echo "<script>
                alert('Gagal mengupdate distribusi dokumen.');
                window.location='../../home.php?pages=dister';
              </script>";
        exit;
    }

    // --- catat aktivitas dokumen ---

    // ambil dokumen internal berdasarkan suid
    $get_dokumeninternal = mysql_fetch_array(
        mysql_query("SELECT * FROM dinter WHERE suid = '$suid'")
    );

    if ($get_dokumeninternal) {

        // ambil kode aktivitas berdasarkan kode dokumen
        $get_kodeaktivitas = mysql_fetch_array(
            mysql_query("SELECT * FROM udokumen WHERE ukodok = '$get_dokumeninternal[dikodok]'")
        );

        // kalau bukan mode audit, catat ke aktivitas_dokumen
        if ($e['cAudit'] != 'Y') {
            $kode_aktivitas = isset($get_kodeaktivitas['kode_aktivitas']) ? $get_kodeaktivitas['kode_aktivitas'] : '';

            $q_aktivitas = mysql_query("
                INSERT INTO aktivitas_dokumen
                    (kode_aktivitas, user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi)
                VALUES
                    (
                        '$kode_aktivitas',
                        '$e[cNama]',
                        '$e[cJabatan]',
                        '-',
                        '-',
                        '$get_dokumeninternal[dikodok]',
                        '$get_dokumeninternal[dijudok]',
                        'create',
                        'Melakukan ACC distribusi dokumen dengan judul $get_dokumeninternal[dijudok]'
                    )
            ");

            if (!$q_aktivitas) {
                error_log("Gagal insert aktivitas dokumen suid=$suid : " . mysql_error());
            }
        }

    } else {
        error_log("Data dinter tidak ditemukan untuk suid=$suid");
    }

    echo "<script>
            alert('Distribusi dokumen berhasil dikirim / ACC.');
            window.location='../../home.php?pages=dister';
          </script>";
    exit;
}
elseif ($act=='acc_all'){
    
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: text/plain; charset=utf-8'); // biar output plain text
    echo "=== MULAI PROSES ACC MASSAL DISTER ===\n\n";

    date_default_timezone_set('Asia/Jakarta');

    // ambil user
    $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
    if (!$e) {
        echo "ERROR: data user tidak ditemukan untuk cId=".$_SESSION['cv']."\n";
        exit;
    }

    echo "User login : ".$e['cNama']." (".$e['cJabatan'].")\n";
    echo "Mode audit : ".$e['cAudit']."\n\n";

    $thn = date("Y");
    $bln = date("m/Y");

    // ambil max dinmr tahun ini
    $q_max = mysql_query("SELECT MAX(dinmr) AS max_no FROM dister WHERE dinmr LIKE '%$thn%'");
    if (!$q_max) {
        echo "ERROR SELECT MAX(dinmr): ".mysql_error()."\n";
        exit;
    }
    $dataMax = mysql_fetch_array($q_max);
    $idMax   = $dataMax['max_no'];

    if ($idMax != '' && strlen($idMax) >= 7) {
        $noUrut = (int) substr($idMax, 3, 4);
    } else {
        $noUrut = 0;
    }

    echo "Last dinmr tahun $thn : ".$idMax."  (no urut awal = ".$noUrut.")\n\n";

    // ambil semua yang distatus = 'N'
    $q_list = mysql_query("
        SELECT * FROM dister
        WHERE distatus = 'N'
        ORDER BY ditgl ASC, suid ASC
    ");

    if (!$q_list) {
        echo "ERROR SELECT list dister: ".mysql_error()."\n";
        exit;
    }

    $jumlah_pending = mysql_num_rows($q_list);
    echo "Jumlah data pending (distatus='N') : ".$jumlah_pending."\n\n";

    if ($jumlah_pending == 0) {
        echo "Tidak ada data yang perlu diproses.\n";
        exit;
    }

    $ok   = 0;
    $fail = 0;

    while ($row = mysql_fetch_array($q_list)) {

        $suid = $row['suid'];

        $noUrut++;
        $newID = sprintf("DD-%04s/%s", $noUrut, $bln);

        echo "Proses suid=$suid  => dinmr baru = $newID ... ";

        // UPDATE dister
        $q_update = mysql_query("
            UPDATE dister
            SET dinmr = '$newID',
                distatus = 'Y'
            WHERE suid = '$suid'
        ");

        if (!$q_update) {
            $fail++;
            echo "GAGAL UPDATE: ".mysql_error()."\n";
            continue;
        }

        // ambil dinter
        $get_dokumeninternal = mysql_fetch_array(
            mysql_query("SELECT * FROM dinter WHERE suid = '$suid'")
        );
        if (!$get_dokumeninternal) {
            echo "OK (UPDATE saja, dinter tidak ditemukan)\n";
            $ok++;
            continue;
        }

        // ambil kode aktivitas
        $get_kodeaktivitas = mysql_fetch_array(
            mysql_query("SELECT * FROM udokumen WHERE ukodok = '$get_dokumeninternal[dikodok]'")
        );

        if ($e['cAudit'] != 'Y') {
            $kode_aktivitas = isset($get_kodeaktivitas['kode_aktivitas']) ? $get_kodeaktivitas['kode_aktivitas'] : '';

            $q_aktivitas = mysql_query("
                INSERT INTO aktivitas_dokumen
                    (kode_aktivitas, user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi)
                VALUES
                    (
                        '$kode_aktivitas',
                        '$e[cNama]',
                        '$e[cJabatan]',
                        '-',
                        '-',
                        '$get_dokumeninternal[dikodok]',
                        '$get_dokumeninternal[dijudok]',
                        'create',
                        'Melakukan ACC distribusi dokumen dengan judul $get_dokumeninternal[dijudok]'
                    )
            ");

            if (!$q_aktivitas) {
                echo "OK (UPDATE, aktivitas GAGAL: ".mysql_error().")\n";
                $ok++;
                continue;
            }
        }

        echo "OK\n";
        $ok++;
    }

    echo "\n=== SELESAI ===\n";
    echo "Berhasil update : $ok baris\n";
    echo "Gagal update    : $fail baris\n\n";
    echo "Silakan cek lagi di phpMyAdmin:\n";
    echo "SELECT suid, dinmr, distatus FROM dister WHERE distatus='N' ORDER BY ditgl DESC LIMIT 20;\n";

    exit;
}

// hapus smasuk
elseif ($act=='hapus'){
 $data=mysql_fetch_array(mysql_query("SELECT difile,suid FROM dister WHERE suid='$_GET[id]'"));
  if ($data['difile']!=''){
     mysql_query("DELETE FROM dister WHERE suid='$_GET[id]'");
	 mysql_query("DELETE FROM disin WHERE suid='$_GET[id]'");

  }
  else{
     mysql_query("DELETE FROM dister WHERE suid='$_GET[id]'");
 	 mysql_query("DELETE FROM disin WHERE suid='$_GET[id]'");
  }
  echo "<script>window.location=('../../home.php?pages=dister')</script>"; 
}

//tambah penerima distribusi dokumen
    elseif ($act=='lp'){
    
    $act = $_GET['act'];
    $id = $_GET['id'];
    
    // Pastikan id tidak kosong
    if (!$id) {
        die("<script>alert('ID tidak ditemukan!'); history.back();</script>");
    }
    
    // Ambil data `dister`
    $getdister = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$id'"));
    
    // Pastikan data `dister` ditemukan
    if (!$getdister) {
        die("<script>alert('Data tidak ditemukan!'); history.back();</script>");
    }
            $copyke = $_POST['copyke'];
            $cId = $_POST['cId'];
    // Cek apakah form sudah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cId'])) {
    
        // Looping data yang dikirim
        for ($i = 0; $i < count($_POST['copyke']); $i++) {
            
            $jml_copy = $_POST['jml_copy'][$i];
    
            // Pastikan nilai tidak kosong
            if (empty($copyke) || empty($cId) || empty($jml_copy)) {
                continue; // Lewati iterasi jika data tidak lengkap
            }
    
            // Periksa apakah sudah ada data dengan suid dan copyke yang sama
            $cv1 = mysql_query("SELECT * FROM disin WHERE cId='$cId' AND suid='$getdister[suid_dinter]'");
            $dcv1 = mysql_num_rows($cv1);
            
            if ($dcv1 > 0) {
                // Jika data sudah ada, lakukan UPDATE
                $q = mysql_query("UPDATE disin SET cId='$cId', jml_copy='$jml_copy' WHERE suid='$getdister[suid_dinter]' AND copyke='$copyke'");
                $action = "update";
                $description = "Mengubah penerima salinan ke-$copyke menjadi $cId dengan jumlah salinan $jml_copy";  
            } else {
                // Jika belum ada, lakukan INSERT
                $q = mysql_query("INSERT INTO disin (copyke, cId, suid, jml_copy) VALUES ('$copyke','$cId','$getdister[suid_dinter]','$jml_copy')");
                $action = "insert";
                $description = "Menambahkan penerima salinan ke-$copyke yaitu $cId dengan jumlah salinan $jml_copy";  
            }
    
            // Jika query gagal, tampilkan pesan error
            if (!$q) {
                die("<script>alert('Gagal menyimpan data! Error: " . mysql_error() . "'); history.back();</script>");
            }
        }
    
        // Logging aktivitas dokumen
        $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='{$_SESSION['cId']}'"));
        if ($e['cAudit'] != 'Y') {
            mysql_query("INSERT INTO aktivitas_dokumen (user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi) 
                         VALUES ('$e[cNama]', '$e[cJabatan]', '-', '-', '$id', '$cId', '$action', '$description')");
        }
    
        // Jika sukses, beri notifikasi dan kembali
        echo "<script>alert('Data berhasil disimpan!'); window.location.href=document.referrer;</script>";
    } else {
        echo "<script>alert('Gagal menyimpan! Pastikan data sudah diisi dengan benar.'); history.back();</script>";
    }
    
}
elseif($act=='hapuslp') {
            $copyke_hapus = $_GET['copyke'];
        
        // var_dump($_GET[suid_dinter], $_GET[cId]);die();
            // $stmt = $pdo->prepare("DELETE FROM disin WHERE suid=? AND copyke=?");
            
                $q = mysql_query("DELETE FROM disin WHERE suid='$_GET[suid_dinter]' AND cId='$_GET[cId]'");
            // $stmt->execute([$getdister['suid_dinter'], $copyke_hapus]);
        
            if ($q) {
                $action = "delete";
                $description = "Menghapus penerima salinan ke-$copyke_hapus";
              
                  echo "<script>window.alert('Data Berhasil DI hapus');self.history.back();</script>";
            } else {
                  echo "<script>window.alert('Gagal Dihapus');self.history.back();</script>";
            }
            exit;
        }
//hapus penerima distribusi dokumen
elseif ($act=='lp1'){
    
    mysql_query("DELETE FROM disin WHERE suid='$id'");
    
    // Logging aktivitas dokumen (hapus semua penerima)
    $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cId]'"));
    if($e['cAudit']=='Y'){
      
    }else{
      $audit=mysql_query("INSERT INTO aktivitas_dokumen(user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi) 
                          VALUES('$e[cNama]', '$e[cJabatan]', '-', '-', '$id', '-', 'delete all', 'Menghapus semua penerima salinan')");
    }

    header('location:../../dister.php?id='.$id.'');
}

//buat penerima distribusi dokumen dan penerima dokumen internal
elseif ($act=='lp2'){
         
            
            $cc = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
            
            // Cek apakah $cc ada isinya
            if (!$cc) {
                echo "<script>window.alert('Data dister tidak ditemukan.'); self.history.back();</script>";
                exit;
            }
            
            $cd = mysql_num_rows(mysql_query("SELECT * FROM dsin WHERE suid='$cc[suid_dinter]'"));
            
            if ($cd!=0) {
                $disin = $_POST['disin'];
                $dsin = $_POST["disin"];
                $delete_result = mysql_query("DELETE FROM dsin WHERE suid='$cc[suid_dinter]'");
                if (!$delete_result) {
                    echo "<script>window.alert('Error deleting from dsin: ". mysql_error(). "'); self.history.back();</script>";
                    exit;
                }
                foreach ($dsin as $y=>$cid) {
                    $t=mysql_query("INSERT INTO dsin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");
                    if (!$t) { // Ganti $result dengan $t
                        echo "<script>window.alert('Error inserting into dsin (first loop): ". mysql_error(). "'); self.history.back();</script>";
                        exit;
                    }	
                }   
                $disin = $_POST["disin"];
                $no=1;
                foreach ($disin as $x=>$cid1) {
                    $q=mysql_query("INSERT INTO disin(copyke,cId,suid) VALUES ('$no','$cid1','$cc[suid_dinter]')");	
                    if (!$q) { // Ganti $result dengan $q
                        echo "<script>window.alert('Error inserting into disin (second loop): ". mysql_error(). "'); self.history.back();</script>";
                        exit;
                    }
                    $no++;
                }
            } else {
                $disin = $_POST['disin'];
                $dsin = $_POST["disin"];
                $no=1;
                foreach ($disin as $x=>$cid1) {
                    $q=mysql_query("INSERT INTO disin(copyke,cId,suid) VALUES ('$no','$cid1','$cc[suid_dinter]')");
                    if (!$q) { // Ganti $result dengan $q
                        echo "<script>window.alert('Error inserting into disin (third loop): ". mysql_error(). "'); self.history.back();</script>";
                        exit;
                    }
                    $no++;
                }
                foreach ($dsin as $y=>$cid) {
                    $t=mysql_query("INSERT INTO dsin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");
                    if (!$t) { // Ganti $result dengan $t
                        echo "<script>window.alert('Error inserting into dsin (fourth loop): ". mysql_error(). "'); self.history.back();</script>";
                        exit;
                    }
                }
            }
            
            // Gunakan var_dump($q) atau var_dump($t) untuk debugging
            // var_dump($q, $t); 
            
            if ($q && $t){
                echo "<script>window.alert('Penerima Dokumen telah dibuat/diupdate');window.location=('../../home.php?pages=dister')</script>";
            } else {
                echo "<script>window.alert('Error');self.history.back();</script>"; 
            }
          
    $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'")); // Ambil data user
            if ($insert_dsin && $insert_dsin) {  // Pastikan query $r berhasil sebelum mencatat aktivitas
                if($user['cAudit']!='Y'){ // Cek apakah audit tidak aktif
                $q_aktivitas = mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas, user, jabatan, ip_address, user_agent, kode_dokumen, dokumen, action, deskripsi)
                    VALUES('$_POST[kode_aktivitas]','{$user['cNama']}','{$user['cJabatan']}','-','-','$cc[dikodok]','$cc[dijudok]','update','Membuat List Penerima Distribusi Dokumen untuk $cc[dijudok]')");
                  if(!$q_aktivitas) {
                    error_log("Gagal insert aktivitas dokumen jenis 2: " . mysql_error());
                  }
              }
            }
            
           
// $cc = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
// $cd = mysql_num_rows(mysql_query("SELECT * FROM dsin WHERE suid='$cc[suid_dinter]'"));
  
// var_dump($cc['suid_dinter']);die();
  
//   if ($cd!=0) {
//   $dsin = $_POST["disin"];
//   mysql_query("DELETE FROM dsin WHERE suid='$cc[suid_dinter]'");
//   foreach ($dsin as $y=>$cid)
//   {
// 	$t=mysql_query("INSERT INTO dsin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");  
//   }   
//   $disin = $_POST["disin"];
//   $no=1;
//   foreach ($disin as $x=>$cid1)
//   {
// 	$q=mysql_query("INSERT INTO disin(copyke,cId,suid) VALUES ('$no','$cid1','$_GET[id]')");
// 	$no++;
//   }
  
//   }else {
//   $disin = $_POST["disin"];
//   $no=1;
  
//   foreach ($disin as $x=>$cid1)
//   {
// 	$q=mysql_query("INSERT INTO disin(copyke,cId,suid) VALUES ('$no','$cid1','$_GET[id]')");  
// 	$no++;
//   }
//   foreach ($dsin as $y=>$cid)
//   {
// 	$t=mysql_query("INSERT INTO dsin(cId,suid,distatus) VALUES ('$cid','$cc[suid_dinter]','Y')");  
//   }
  
//   }
  
//   if ($q){
	  
// 	echo "<script>window.alert('Penerima Dokumen telah dibuat/diupdate');window.location=('../../home.php?pages=dister')</script>";
//   }else{
// 	  echo "<script>self.history.back();</script>";
//   }
}

//batas 
//buat disposisi info dokumen
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

 UploadDist($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
  if (empty($lokasi_file)){
  $q1=mysql_query("INSERT INTO distribusidok(dNoagenda,
                                         dPendisposisi,
								         suid) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[suid]')");
  }
  else {
	  $q1=mysql_query("INSERT INTO distribusidok(dNoagenda,
                                         dPendisposisi,
								         suid,
										 disfile) 
	                     VALUES('$_POST[noagenda]',
								'$_POST[pendisposisi]',
								'$_GET[suid]',
								'$nama_file_unik')");
  }
  
    $ddist = $_POST["ddist"];
	$q2=mysql_query("INSERT INTO ddist(pNoagenda,ptgl,pInstruksi,pSifat,pid,cId,suid,psACC,jawab,disfiles) 
	VALUES ('$_POST[noagenda]','$_POST[tglm]','$_POST[isi]','$_POST[sifat]','$_POST[pendisposisi]','$ddist','$_GET[suid]','N','$_POST[jawab]','$nama_file_unik')"); 
 
 
if($_SESSION[levelcv]==0 OR $_SESSION[levelcv]==1){
  if ($q1&&$q2){
	  	    
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=dister')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
  }
  else {
      
   if ($q1&&$q2){

  echo "<script>window.alert('Info Dokumen terkirim!');window.location=('../../home.php?pages=usrd')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal Terkirim');self.history.back();</script>";
  } 
  
  }
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 25 MB..!');self.history.back();</script>";
  }  
//tambah disp

}elseif($act=='simpansemuapenerima'){
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['penerima'])) {
        $dataPenerima = json_decode($_POST['penerima'], true);
        
        if (empty($dataPenerima)) {
            echo json_encode(["success" => false, "message" => "Data kosong"]);
            exit;
        }
    
        $errors = [];
        foreach ($dataPenerima as $penerima) {
            $cId = mysql_real_escape_string($penerima['cId']);
            $jml_copy = mysql_real_escape_string($penerima['jml_copy']);
            $suid_dinter = isset($penerima['suid_dinter']) ? mysql_real_escape_string($penerima['suid_dinter']) : '';
            $copyke = mysql_real_escape_string($penerima['copyke']);
            $suid = isset($penerima['suid']) ? mysql_real_escape_string($penerima['suid']) : '';
          
            // Jika suid_dinter undefined, cari dari tabel dister.suid
            if (!empty($suid)) {
                $querySuid = "SELECT suid_dinter FROM dister WHERE suid = '$suid' LIMIT 1";
                
                $resultSuid = mysql_query($querySuid);
                if ($row = mysql_fetch_assoc($resultSuid)) {
                    $suid_dinter = $row['suid_dinter'];
                }
                
            }
    
            // Cek apakah data sudah ada di database
            $cekQuery = "SELECT * FROM disin WHERE cId = '$cId' AND suid = '$suid_dinter'";
            $cekResult = mysql_query($cekQuery);
    // var_dump($suid);die();
            if (mysql_num_rows($cekResult) > 0) {
                $query = "UPDATE disin SET jml_copy = '$jml_copy', copyke = '$copyke' WHERE cId = '$cId' AND suid = '$suid_dinter'";
            } else {
                $query = "INSERT INTO disin (cId, jml_copy, suid, copyke) VALUES ('$cId', '$jml_copy', '$suid_dinter', '$copyke')";
            }
    
            $result = mysql_query($query);
            if (!$result) {
                $errors[] = "SQL Error: " . mysql_error();
            }
        }
    
        if (!empty($errors)) {
            echo json_encode(["success" => false, "message" => "Beberapa data gagal disimpan", "errors" => $errors]);
        } else {
            echo json_encode(["success" => true, "message" => "Semua data berhasil disimpan"]);
        }
        exit;
    }

}elseif($act=='hapussemualist'){

     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suid_dinter'])) {
        $suid_dinter = mysql_real_escape_string($_POST['suid_dinter']);

        // 🔥 Hapus semua penerima berdasarkan suid_dinter
        $query = "DELETE FROM disin WHERE suid = '$suid_dinter'";
        $result = mysql_query($query);

        if ($result) {
            echo json_encode(["success" => true, "message" => "Semua penerima berhasil dihapus"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menghapus penerima", "errors" => mysql_error()]);
        }
        exit;
    }
}elseif($act=='hapus_penerima'){
    
    $cId = $_POST['cId'];
    $suid_dinter = $_POST['suid_dinter'];

    if (!$cId || !$suid_dinter) {
        echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
        exit;
    }

    $query = "DELETE FROM disin WHERE cId='$cId' AND suid='$suid_dinter'";
    $result = mysql_query($query);

    if ($result) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => mysql_error()]);
    }

}else {
  if ($q2){
	  $tgl_sekarang = date ("Y-m-d");
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cEmail2 FROM users b WHERE b.cId=a.cId) As email 
					FROM ddist a WHERE a.suid='$_GET[suid]' AND a.pId='$_POST[pendisposisi]' AND a.kode='$now' ORDER BY a.pdid DESC");
/*
while($e=mysql_fetch_array($pds)){
$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[kepada]',
                                '$e[email]',
								'Ada Disposisi untuk $e[kepada]!',
								'Yth. $e[kepada], <br>Ada Disposisi untuk anda dari Memo/Undangan/Tembusan di aplikasi http://e-kfpb.co.id untuk anda<br>
Disposisi dari : $e[oleh],<br>
Untuk baca Disposisi dan menjawab disposisi silahkan segera login ke http://e-kfpb.co.id<br>
Username : Singkatan Jabatan Masing-masing!<br>
Password : NPP (Jika belum dirubah, segera ubah.)<br><br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
}
*/
  echo "<script>window.alert('Info Dokumen terkirim!');window.location=('../../home.php')</script>";
  
  }else{
	  echo "<script>window.alert('Gagal terkirim');self.history.back();</script>";
  }
  
  }
  

//batas 

?>
