<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php

require_once "../cek_sesi.php";
if(!isset($_SESSION))
    {
        session_start();
    }
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php"; // [ADD] untuk fungsi catat_audit()
$act=$_GET['act'];


if($act=='storebatch'){
    
      // Ambil data dari form
            $kode_dokumen = $_POST['kode_dokumen'];
            $nomor_batch = $_POST['nomor_batch'];
            $nama_produk = $_POST['nama_produk'];
            $besaran_bets = $_POST['besaran_bets'];
            $jenis_dokumen = $_POST['jenis_dokumen'];
            $catatan = $_POST['catatan'];
            $tanggal_sekarang = date('Y-m-d H:i:s'); // Waktu saat ini
            
            // Ambil informasi pengguna dari session
            $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
            
            // Proses upload lampiran
            $lampiran_dir = "../../include/copy_ebr/lampiran_copyebr/";
            $file_lampiran = $_FILES['fupload']['name'];
            $lampiran_path = $lampiran_dir . basename($file_lampiran);
            $lampiran_ok = 1;
            
            // Validasi ukuran file (maks 15MB)
            if ($_FILES['fupload']['size'] > 15728640) { // 15 MB dalam byte
                echo "<script>alert('Ukuran file terlalu besar. Maksimal 15 MB.');self.history.back();</script>";
                //perbaiki ketika data besar, harus minta input ulang
                $lampiran_ok = 0;
            }
            
            // Proses simpan data jika lampiran valid
            if ($lampiran_ok == 1) {
                if (move_uploaded_file($_FILES['fupload']['tmp_name'], $lampiran_path)) {
                    $file_lampiran_saved = $file_lampiran;
                } else {
                    $file_lampiran_saved = '-';
                }
            } else {
                $file_lampiran_saved = '-';
            }
            
            // Simpan data ke tabel `permintaan_dokumen_batch`
            $query_permintaan = mysql_query("
                INSERT INTO permintaan_dokumen_batch (
                    dikodok,
                    nomor_batch,
                    status,
                    peminta,
                    dibuat_pada,
                    file_lampiran,
                    catatan,
                    besaran_bets,
                    jenis_dokumen,
                    nama_produk
                ) VALUES (
                    '$kode_dokumen',
                    '$nomor_batch',
                    'diminta',
                    '$user[cId]',
                    '$tanggal_sekarang',
                    '$file_lampiran_saved',
                    '$catatan',
                    '$besaran_bets',
                    '$jenis_dokumen',
                    '$nama_produk'
                )
            ") or die(mysql_error());
            
            // Periksa apakah data berhasil disimpan
            if ($query_permintaan) {
                // Ambil ID permintaan terakhir
                $id_permintaan = mysql_insert_id();
            
                // Tambahkan notifikasi untuk user tertentu
                $users = [92, 90, 74, 71, 35, 27, 26, 38, 40, 30, 36, 58, 57, 49, 48, 47, 46, 45, 44, 39, 33, 32, 28, 7, 37, 34, 29, 31]; // Daftar user yang akan menerima notifikasi
                foreach ($users as $userId) {
                    $query_notifikasi = mysql_query("
                        INSERT INTO notifikasi_status_permintaan_bets (
                            id_permintaan,
                            user_id,
                            sudah_dilihat
                        ) VALUES (
                            '$id_permintaan',
                            '$userId',
                            'N'
                        )
                    ") or die(mysql_error());
                }
            
                // Format label jenis dokumen untuk keterangan yang lebih informatif
                $jenis_dok_label = ($jenis_dokumen == 'PPI') ? 'PPI (Prosedur Pengolahan Induk)' 
                                 : (($jenis_dokumen == 'PGI') ? 'PGI (Prosedur Pengemasan Induk)' : (!empty($jenis_dokumen) ? $jenis_dokumen : '-'));

                $kode_dok_audit = !empty($kode_dokumen) ? $kode_dokumen : (!empty($jenis_dokumen) ? $jenis_dokumen : '-');
                $judul_dokumen  = !empty($jenis_dokumen) ? '[' . $jenis_dokumen . '] ' . $nama_produk : (!empty($nama_produk) ? $nama_produk : 'Permintaan Batch Record ' . $nomor_batch);

                $deskripsi_audit = 'Membuat permintaan copy Batch Record - Jenis Dokumen: ' . $jenis_dok_label 
                                 . ', Nama Produk: ' . $nama_produk 
                                 . ', No. Bets: ' . $nomor_batch 
                                 . (!empty($besaran_bets) ? ', Besar Bets: ' . $besaran_bets : '')
                                 . (!empty($catatan) ? ', Catatan: ' . strip_tags($catatan) : '');

                catat_audit(
                    'EBR-' . $id_permintaan,
                    $user['cNama'],
                    $user['cJabatan'],
                    $kode_dok_audit,
                    $judul_dokumen,
                    'create',
                    $deskripsi_audit,
                    $user['cAudit']
                );
            
                // Jika aktivitas berhasil dicatat
                echo "<script>
                    alert('Permintaan dokumen berhasil disimpan, dan terkirim.');
                    window.location=('../../home.php?pages=dinterebr');
                </script>";
            } else {
                echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
            }

}elseif($act=='selesaipermintaanEbr'){
        // Ambil data dari form atau parameter
        $id_permintaan = $_POST['idPermintaan']; // ID permintaan yang akan diupdate
        $pencetak = $_SESSION['cv']; // User yang mencetak dokumen
        $tanggal_sekarang = date('Y-m-d H:i:s'); // Waktu saat ini
        
        // Pastikan koneksi database ada
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$pencetak'"));
        
        // Query untuk mengupdate data
        $query_update = mysql_query("
            UPDATE permintaan_dokumen_batch
            SET 
                dikodok = '$_POST[dikodok]',
                pencetak = '$user[cId]', 
                dicetak_pada = '$tanggal_sekarang', 
                status = 'dicetak'
            WHERE 
                id_permintaan = '$id_permintaan'
        ") or die(mysql_error());
        
        // Periksa apakah data berhasil diupdate
        if ($query_update) {
            
             $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
 
				if($user['cAudit']=='Y'){
				    
				}else{
                        // [FIX] user diubah dari cId (angka) → cNama (nama user)
                        // [FIX] Mengambil judul dokumen/nama produk yang spesifik
                        $perm_row = mysql_fetch_array(mysql_query("SELECT dikodok, nama_produk, nomor_batch FROM permintaan_dokumen_batch WHERE id_permintaan = '$id_permintaan'"));
                        $kode_dok_ebr = ($perm_row && !empty($perm_row['dikodok'])) ? $perm_row['dikodok'] : '-';
                        $nama_prod_ebr = ($perm_row && !empty($perm_row['nama_produk'])) ? $perm_row['nama_produk'] : (($perm_row && !empty($perm_row['dikodok'])) ? 'Dokumen ' . $perm_row['dikodok'] : 'Batch Record ' . $id_permintaan);
                        catat_audit(
                            '',
                            $user['cNama'],
                            $user['cJabatan'],
                            $kode_dok_ebr,
                            $nama_prod_ebr,
                            'update',
                            'Dokumen ' . $nama_prod_ebr . ' (ID: ' . $id_permintaan . ') telah selesai dicetak oleh ' . $user['cNama'],
                            $user['cAudit']
                        );
				}
        
            // Periksa apakah aktivitas berhasil dicatat
            if ($query_update) {
                echo "<script>
                    alert('Permintaan Copy Batch Record telah Diselesaikan!.');
                    window.location=('../../home.php?pages=dinterebr');
                </script>";
            } else {
                echo "<script>
                    alert('Permintaan Copy Batch Record telah Diselesaikan!');
                    window.location=('../../home.php?pages=dinterebr');
                </script>";
            }
        } else {
            echo "<script>window.alert('Gagal menyelesaikan permintaan copy ebr');self.history.back();</script>";
        }
}


?>