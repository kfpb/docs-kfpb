<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
$tgl_sekarang = date ("Y-m-d");
	
$query = "SELECT max(onmr) as max_no FROM copydok WHERE onmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("C-%04s/$_SESSION[nppcv]/$bln", $noUrut);		
	
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
              if($_POST['dinmr']){
                            $dinmr      = $_POST['dinmr'];
                            $dijudok    = $_POST['dijudok'];
                            $dijumlah   = $_POST['dijumlah'];
                            $diketdok   = $_POST['diketdok'];
                            $dilokasi   = $_POST['dilokasi'];
                            
                            $onmr       = $newID;
                            $tgl        = $_POST['tgl'];
                            $pengirim   = $_POST['pengirim'];
                            $kepada     = $_POST['kepada'];
                            $jenisms    = $_POST['jenisms'];
                            $direv    = $_POST['direv'];
                            $ket        = isset($_POST['ket']) ? $_POST['ket'] : "";
                            $status        = 'N';
                            
                            
                            $q=mysql_query("INSERT INTO copydok(onmr,
								   otgl,						   
								   opengirim,
                                   okepada, 
								   jenisms,
                                   oket,
								   sstatus,
								   kirim_status) 
	                     VALUES('$newID',
								'$_POST[tgl]',
                                '$_POST[pengirim]',
                                '$_POST[kepada]',
								'$_POST[jenisms]',
								'$_POST[ket]',
								'N',
								'N')");
								
								$ide = mysql_insert_id();
                            
                            $count = count($dinmr);
                            for($i = 0; $i < $count; $i++){
            					
            					$q=mysql_query("INSERT INTO copydok_lampiran(copydok_id,
            					                dinmr,
                                                dijudok,
                                                direv,
                                                dijumlah,
                                                diketdok,
                                                dilokasi) 
            	                     VALUES('$ide',
            	                            '$dinmr[$i]',
                                            '$dijudok[$i]',
                                            '$direv[$i]',
            								'$dijumlah[$i]',
            								'$diketdok[$i]',
            								'$dilokasi[$i]')")or die(mysql_fatal_error());
            				}
            				// var_dump("1");die();
                        }else{
                             UploadSCopy($nama_file_unik);
                             
                                $dinmr      = $_POST['dinmr'];
                                $dijudok    = $_POST['dijudok'];
                                $dijumlah   = $_POST['dijumlah'];
                                $diketdok   = $_POST['diketdok'];
                                $dilokasi   = $_POST['dilokasi'];
                                $direv   = $_POST['direv'];
                                
                    		  $q=mysql_query("INSERT INTO copydok(onmr,
                    								   otgl,						   
                    								   opengirim,
                                                       okepada, 
                    								   jenisms,
                                                       oket,
                    								   sstatus,
                    								   kirim_status,
                    								   ofile) 
                    	                     VALUES('$newID',
                    								'$_POST[tgl]',
                                                    '$_POST[pengirim]',
                                                    '$_POST[kepada]',
                    								'$_POST[jenisms]',
                    								'$_POST[ket]',
                    								'N',
                    								'N',
                    								'$nama_file_unik')");
                    								
								    $ide = mysql_insert_id();
								
                                    $count = count($dinmr);
                                    for($i = 0; $i < $count; $i++){
                    					
                    					$q=mysql_query("INSERT INTO copydok_lampiran(copydok_id,
                    					                dinmr,
                                                        dijudok,
                                                        direv,
                                                        dijumlah,
                                                        diketdok,
                                                        dilokasi) 
                    	                     VALUES('$ide',
                    	                            '$dinmr[$i]',
                                                    '$dijudok[$i]',
                                                    '$direv[$i]',
                    								'$dijumlah[$i]',
                    								'$diketdok[$i]',
                    								'$dilokasi[$i]')")or die(mysql_fatal_error());
                    				}
                        
	}
  	}

 $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
						
        $count = count($dinmr);
        for ($i = 0; $i < $count; $i++) {
            $current_dinmr = $dinmr[$i];
            $current_dijudok = $dijudok[$i];
        
            $q_activity = mysql_query("INSERT INTO aktivitas_dokumen(
                                           user,
                                           jabatan,
                                           ip_address,
                                           user_agent, 
                                           kode_dokumen,
                                           dokumen,
                                           action,
                                           deskripsi
                                       ) 
                                       VALUES(
                                           '$user[cNama]',
                                           '$user[cJabatan]',
                                           '-',
                                           '-',
                                           '$current_dinmr',
                                           '$current_dijudok',
                                           'create',
                                           'Menambahkan Permintaan Copy Dokumen dengan judul $current_dijudok'
                                       )");
        
            if (!$q_activity) {
                echo "<script>window.alert('Log aktivitas gagal disimpan');self.history.back();</script>";
                exit;
            }
        }
if ($q){
	 echo "<script>window.alert('Permohonan Copy Terkirim ke SPD-MR');window.location=('../../home.php?pages=copy')</script>";
	} else {
		
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }


  }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }
  
}
//update 
elseif($act=='edit'){
    
    
     $oid_utama = '';
    if (isset($_GET['id'])) {
        $oid_utama = mysql_real_escape_string($_GET['id']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'ID permohonan tidak ditemukan.'));
        exit;
    }

    // ===========================================
    // 1. UPDATE DATA UTAMA (tabel copydok) - TANPA LAMPIRAN
    // ===========================================
    $otgl = isset($_POST['tgl']) ? mysql_real_escape_string($_POST['tgl']) : '';
    $opengirim = isset($_POST['pengirim']) ? mysql_real_escape_string($_POST['pengirim']) : '';
    $okepada = isset($_POST['kepada']) ? mysql_real_escape_string($_POST['kepada']) : '';
    $jenisms = isset($_POST['jenisms']) ? mysql_real_escape_string($_POST['jenisms']) : '';
    $oket = isset($_POST['ket']) ? mysql_real_escape_string($_POST['ket']) : '';

    $update_query_main = "UPDATE copydok SET otgl='" . $otgl . "',
                                            opengirim='" . $opengirim . "',
                                            okepada='" . $okepada . "',
                                            jenisms='" . $jenisms . "',
                                            oket='" . $oket . "'";
    // Tidak ada logika upload/hapus file lampiran
    
    $update_query_main .= " WHERE oid='" . $oid_utama . "'";

    $q_main = mysql_query($update_query_main);

    if (!$q_main) {
        error_log("Gagal update data utama copydok: " . mysql_error());
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Gagal memperbarui data utama permohonan. ' . mysql_error()));
        exit;
    }

    // ===========================================
    // 2. DELETE DETAIL LAMA (tabel copydok_lampiran)
    // ===========================================
    if (isset($_POST['deleted_detail_ids']) && is_array($_POST['deleted_detail_ids'])) {
        foreach ($_POST['deleted_detail_ids'] as $id_to_delete) {
            $id_to_delete_escaped = mysql_real_escape_string($id_to_delete);
            $delete_q = mysql_query("DELETE FROM copydok_lampiran WHERE clid='" . $id_to_delete_escaped . "' AND copydok_id='" . $oid_utama . "'");
            if (!$delete_q) {
                error_log("Gagal menghapus detail dokumen dengan ID " . $id_to_delete_escaped . ": " . mysql_error());
            }
        }
    }

    // ===========================================
    // 3. UPDATE/INSERT DATA DETAIL (tabel copydok_lampiran) - Disesuaikan dengan Kolom Anda
    // ===========================================
    if (isset($_POST['iddetail']) && is_array($_POST['iddetail'])) {
        $count = count($_POST['iddetail']);
        for ($k = 0; $k < $count; $k++) {
            $iddetail = isset($_POST['iddetail'][$k]) ? mysql_real_escape_string($_POST['iddetail'][$k]) : '';
            // Gunakan NAMA KOLOM yang benar dari `copydok_lampiran`
            $dinmr = isset($_POST['dinmr'][$k]) ? mysql_real_escape_string($_POST['dinmr'][$k]) : '';
            $dijudok = isset($_POST['dijudok'][$k]) ? mysql_real_escape_string($_POST['dijudok'][$k]) : '';
            $direv = isset($_POST['direv'][$k]) ? mysql_real_escape_string($_POST['direv'][$k]) : '';
            $dijumlah = isset($_POST['dijumlah'][$k]) ? mysql_real_escape_string($_POST['dijumlah'][$k]) : '';
            $dilokasi = isset($_POST['dilokasi'][$k]) ? mysql_real_escape_string($_POST['dilokasi'][$k]) : '';
            $diketdok = isset($_POST['diketdok'][$k]) ? mysql_real_escape_string($_POST['diketdok'][$k]) : '';

            if (!empty($dinmr)) { // Periksa 'dinmr' karena itu adalah kode dokumen
                if (!empty($iddetail)) {
                    // Data lama: Lakukan UPDATE
                    $q_detail = mysql_query("UPDATE copydok_lampiran SET
                                            dinmr='" . $dinmr . "',
                                            dijudok='" . $dijudok . "',
                                            direv='" . $direv . "',
                                            dijumlah='" . $dijumlah . "',
                                            dilokasi='" . $dilokasi . "',
                                            diketdok='" . $diketdok . "'
                                            WHERE clid='" . $iddetail . "' AND copydok_id='" . $oid_utama . "'");
                } else {
                    // Data baru: Lakukan INSERT
                    $q_detail = mysql_query("INSERT INTO copydok_lampiran (copydok_id, dinmr, dijudok, direv, dijumlah, diketdok, dilokasi) VALUES (
                                            '" . $oid_utama . "',
                                            '" . $dinmr . "',
                                            '" . $dijudok . "',
                                            '" . $direv . "',
                                            '" . $dijumlah . "',
                                            '" . $diketdok . "',
                                            '" . $dilokasi . "'
                                            )");
                }

                if (!$q_detail) {
                    error_log("Error pada update/insert detail dokumen: " . mysql_error());
                }
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode(array('success' => 'Data permohonan dan detail berhasil diperbarui.'));
    exit;
}


// acc surat
elseif ($act=='kirim_permohonan'){	
$tgl_sekarang = date ("Y-m-d");	

 $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
 $copydok = mysql_fetch_array(mysql_query("SELECT * FROM copydok WHERE oid='$_GET[id]'"));
$q=mysql_query("UPDATE copydok SET tgl_kirimajuan	 = '$tgl_sekarang',
								  kirim_status   	 = 'Y'
								  WHERE oid = '$_GET[id]'");
	
        
            $q_activity = mysql_query("INSERT INTO aktivitas_dokumen(
                                           user,
                                           jabatan,
                                           ip_address,
                                           user_agent, 
                                           kode_dokumen,
                                           dokumen,
                                           action,
                                           deskripsi
                                       ) 
                                       VALUES(
                                           '$user[cNama]',
                                           '$user[cJabatan]',
                                           '-',
                                           '-',
                                           'Kode ajuan $copydok[onmr]',
                                           '$copydok[onmr]',
                                           'create',
                                           'Mengirimkan permintaan Copy Dokumen dengan kode $copydok[onmr]'
                                       )");						  
							
  if ($q){
	  echo "<script>window.alert('Permohonan Copy Telah Dikirimkan Ke MR');window.location=('../../home.php?pages=copy')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}
// acc surat
elseif ($act=='acc'){	
$tgl_sekarang = date ("Y-m-d");	
$q=mysql_query("UPDATE copydok SET otgl_slesai	 = '$tgl_sekarang',
								  sstatus   	 = 'Y'
								  WHERE oid = '$_GET[id]'");
  if ($q){
	  echo "<script>window.alert('Permohonan Copy Telah Selesai');window.location=('../../home.php?pages=copy')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}elseif ($act=='coba'){
 // Pastikan parameter 'id' ada di URL
    if (isset($_GET['id'])) {
        $id = mysql_real_escape_string($_GET['id']); // Penting untuk mencegah SQL Injection

        // Gunakan mysql_query dan mysql_fetch_array seperti yang Anda lakukan
        $query = mysql_query("SELECT * FROM dinter WHERE dikodok LIKE '%" . $id . "%'");
        $hasil = mysql_fetch_array($query);

        $data = array(); // Inisialisasi array kosong
        if ($hasil) { // Pastikan ada hasil yang ditemukan
            $data['dikodok'] = $hasil['dikodok'];
            $data['dijudok'] = $hasil['dijudok'];
            $data['direv'] = $hasil['direv'];
        } else {
            // Jika tidak ada hasil, kembalikan array kosong atau pesan error
            // agar JavaScript bisa menanganinya
            $data['dikodok'] = '';
            $data['dijudok'] = 'Data tidak ditemukan';
            $data['direv'] = '';
        }

        header('Content-Type: application/json'); // Penting: memberitahu browser bahwa ini JSON
        echo json_encode($data);
        // Hapus var_dump dan die() dari sini, karena hanya untuk debugging
        // dan akan merusak response JSON Anda.
        exit; // Hentikan eksekusi script setelah mengirim JSON
    } else {
        // Jika parameter 'id' tidak ada, kirim response JSON kosong atau error
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Parameter ID tidak ditemukan.'));
        exit;
    }
}

// hapus smasuk
elseif ($act=='hapus'){
 $id = $_POST['id']; // Get the ID from the POST data
    $alasan = $_POST['alasan']; // Get the reason from the POST data

    $data = mysql_fetch_array(mysql_query("SELECT dikodok, dijudok, ofile, oid FROM copydok WHERE oid='$id'"));

    if ($data['ofile'] != '') {
        mysql_query("DELETE FROM copydok WHERE oid='$id'");
        unlink("../../skeluar/" . $data['ofile']);
    } else {
        mysql_query("DELETE FROM copydok WHERE oid='$id'");
    }

    // Assuming $e is already defined from your user session/login data
    // You need to make sure $e is populated with current user's data (cNama, cJabatan, cAudit)
    // For demonstration, let's assume you fetch it from a session or database
    // Example:
    // session_start();
    // $e['cNama'] = $_SESSION['user_name'];
    // $e['cJabatan'] = $_SESSION['user_jabatan'];
    // $e['cAudit'] = 'N'; // Or 'Y' based on your logic

 $e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
    if (isset($e['cAudit']) && $e['cAudit'] == 'Y') {
        // Do nothing if cAudit is 'Y'
    } else {
        $audit = mysql_query("INSERT INTO aktivitas_dokumen(user,
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
                                        '$data[onmr]',
                                        'Kode usulan : $data[onmr]',
                                        'delete',
                                        'Menghapus usulan permintaan copy dokumen $data[onmr] dengan alasan: $alasan'
                                )");
    }

    echo "<script>window.location=('../../home.php?pages=copy')</script>";
}
?>
