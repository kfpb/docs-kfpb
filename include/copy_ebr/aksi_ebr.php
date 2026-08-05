<?php
session_start();
include "../../config/koneksi.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';

// ===============================================
// 1. TAMBAH PERMOHONAN COPY EBR (act=tambah)
// ===============================================
if ($act == 'tambah') {
    $tgl       = isset($_POST['tgl']) ? mysql_real_escape_string($_POST['tgl']) : date('Y-m-d');
    $pengirim  = isset($_POST['pengirim']) ? mysql_real_escape_string($_POST['pengirim']) : '';
    $ket       = isset($_POST['ket']) ? mysql_real_escape_string($_POST['ket']) : '';
    
    // Penanganan Upload File
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
    $nama_file      = $_FILES['fupload']['name'];
    $maxsize        = 1024 * 15000; // Maksimal 15 MB
    $nama_file_unik = '';

    if (!empty($lokasi_file)) {
        if ($_FILES['fupload']['size'] <= $maxsize) {
            $acak           = rand(1, 99);
            $bln_sekarang   = date("ym");
            $nama_file_unik = $bln_sekarang . $acak . mysql_real_escape_string($nama_file);
            
            // Upload ke folder scopy
            move_uploaded_file($lokasi_file, "../../scopy/" . $nama_file_unik);
        } else {
            echo "Maaf... Ukuran file lampiran terlalu besar, maksimal 15 MB!";
            exit;
        }
    }

    // Insert Data Utama ke tabel copydok_ebr
    $query_utama = "INSERT INTO copydok_ebr (otgl, opengirim, oket, ofile) 
                    VALUES ('$tgl', '$pengirim', '$ket', '$nama_file_unik')";
    $q_main = mysql_query($query_utama);

    if ($q_main) {
        // Ambil ID utama yang baru saja terbuat
        $id_utama = mysql_insert_id();

        // Insert Detail Item Dokumen ke tabel copydok_ebr_lampiran
        if (isset($_POST['dinmr']) && is_array($_POST['dinmr'])) {
            $count = count($_POST['dinmr']);
            for ($i = 0; $i < $count; $i++) {
                $dinmr    = isset($_POST['dinmr'][$i]) ? mysql_real_escape_string($_POST['dinmr'][$i]) : '';
                $dijudok  = isset($_POST['dijudok'][$i]) ? mysql_real_escape_string($_POST['dijudok'][$i]) : '';
                $direv    = isset($_POST['direv'][$i]) ? mysql_real_escape_string($_POST['direv'][$i]) : '';
                $dijumlah = isset($_POST['dijumlah'][$i]) ? mysql_real_escape_string($_POST['dijumlah'][$i]) : '1';
                $dilokasi = isset($_POST['dilokasi'][$i]) ? mysql_real_escape_string($_POST['dilokasi'][$i]) : '';
                $diketdok = isset($_POST['diketdok'][$i]) ? mysql_real_escape_string($_POST['diketdok'][$i]) : '';

                if (!empty($dinmr)) {
                    mysql_query("INSERT INTO copydok_ebr_lampiran (copydok_id, dinmr, dijudok, direv, dijumlah, dilokasi, diketdok) 
                                 VALUES ('$id_utama', '$dinmr', '$dijudok', '$direv', '$dijumlah', '$dilokasi', '$diketdok')");
                }
            }
        }
        echo "Data Permohonan Copy EBR Berhasil Disimpan!";
    } else {
        echo "Gagal menyimpan data permohonan EBR: " . mysql_error();
    }
    exit;
}

// ===============================================
// 2. EDIT / UPDATE PERMOHONAN COPY EBR (act=edit)
// ===============================================
elseif ($act == 'edit') {
    if (!isset($_GET['id'])) {
        echo "ID tidak ditemukan!";
        exit;
    }

    $id_utama = mysql_real_escape_string($_GET['id']);
    $tgl      = isset($_POST['tgl']) ? mysql_real_escape_string($_POST['tgl']) : '';
    $pengirim = isset($_POST['pengirim']) ? mysql_real_escape_string($_POST['pengirim']) : '';
    $ket      = isset($_POST['ket']) ? mysql_real_escape_string($_POST['ket']) : '';

    $update_main = "UPDATE copydok_ebr SET otgl='$tgl', opengirim='$pengirim', oket='$ket'";

    // Penanganan Upload File jika ada file baru
    if (isset($_FILES['fupload']) && $_FILES['fupload']['error'] == UPLOAD_ERR_OK && !empty($_FILES['fupload']['tmp_name'])) {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $nama_file   = $_FILES['fupload']['name'];
        $maxsize     = 1024 * 15000;

        if ($_FILES['fupload']['size'] <= $maxsize) {
            $acak           = rand(1, 99);
            $bln_sekarang   = date("ym");
            $nama_file_unik = $bln_sekarang . $acak . mysql_real_escape_string($nama_file);

            // Hapus file lama jika ada
            $q_file_lama = mysql_query("SELECT ofile FROM copydok_ebr WHERE oid='$id_utama'");
            $r_file_lama = mysql_fetch_array($q_file_lama);
            if ($r_file_lama && !empty($r_file_lama['ofile'])) {
                @unlink("../../scopy/" . $r_file_lama['ofile']);
            }

            // Upload file baru
            move_uploaded_file($lokasi_file, "../../scopy/" . $nama_file_unik);
            $update_main .= ", ofile='$nama_file_unik'";
        } else {
            echo "Maaf... Ukuran file lampiran terlalu besar, maksimal 15 MB!";
            exit;
        }
    }

    $update_main .= " WHERE oid='$id_utama'";
    $q_update = mysql_query($update_main);

    if ($q_update) {
        // Hapus item detail yang ditandai dihapus dari form
        if (isset($_POST['deleted_detail_ids']) && is_array($_POST['deleted_detail_ids'])) {
            foreach ($_POST['deleted_detail_ids'] as $id_del) {
                $id_del_clean = mysql_real_escape_string($id_del);
                mysql_query("DELETE FROM copydok_ebr_lampiran WHERE clid='$id_del_clean' AND copydok_id='$id_utama'");
            }
        }

        // Update/Insert item detail
        if (isset($_POST['iddetail']) && is_array($_POST['iddetail'])) {
            $count = count($_POST['iddetail']);
            for ($i = 0; $i < $count; $i++) {
                $iddetail = isset($_POST['iddetail'][$i]) ? mysql_real_escape_string($_POST['iddetail'][$i]) : '';
                $dinmr    = isset($_POST['dinmr'][$i]) ? mysql_real_escape_string($_POST['dinmr'][$i]) : '';
                $dijudok  = isset($_POST['dijudok'][$i]) ? mysql_real_escape_string($_POST['dijudok'][$i]) : '';
                $direv    = isset($_POST['direv'][$i]) ? mysql_real_escape_string($_POST['direv'][$i]) : '';
                $dijumlah = isset($_POST['dijumlah'][$i]) ? mysql_real_escape_string($_POST['dijumlah'][$i]) : '1';
                $dilokasi = isset($_POST['dilokasi'][$i]) ? mysql_real_escape_string($_POST['dilokasi'][$i]) : '';
                $diketdok = isset($_POST['diketdok'][$i]) ? mysql_real_escape_string($_POST['diketdok'][$i]) : '';

                if (!empty($dinmr)) {
                    if (!empty($iddetail)) {
                        // Update item lama
                        mysql_query("UPDATE copydok_ebr_lampiran SET 
                                     dinmr='$dinmr', dijudok='$dijudok', direv='$direv', 
                                     dijumlah='$dijumlah', dilokasi='$dilokasi', diketdok='$diketdok' 
                                     WHERE clid='$iddetail' AND copydok_id='$id_utama'");
                    } else {
                        // Insert item baru
                        mysql_query("INSERT INTO copydok_ebr_lampiran (copydok_id, dinmr, dijudok, direv, dijumlah, dilokasi, diketdok) 
                                     VALUES ('$id_utama', '$dinmr', '$dijudok', '$direv', '$dijumlah', '$dilokasi', '$diketdok')");
                    }
                }
            }
        }
        echo "Data Permohonan Copy EBR Berhasil Diperbarui!";
    } else {
        echo "Gagal memperbarui data: " . mysql_error();
    }
    exit;
}

// ===============================================
// 3. HAPUS PERMOHONAN COPY EBR (act=hapus)
// ===============================================
elseif ($act == 'hapus') {
    if (isset($_GET['id'])) {
        $id_utama = mysql_real_escape_string($_GET['id']);

        // Hapus file fisik lampiran
        $q_file = mysql_query("SELECT ofile FROM copydok_ebr WHERE oid='$id_utama'");
        $r_file = mysql_fetch_array($q_file);
        if ($r_file && !empty($r_file['ofile'])) {
            @unlink("../../scopy/" . $r_file['ofile']);
        }

        // Hapus data detail & utama
        mysql_query("DELETE FROM copydok_ebr_lampiran WHERE copydok_id='$id_utama'");
        $q_del = mysql_query("DELETE FROM copydok_ebr WHERE oid='$id_utama'");

        if ($q_del) {
            echo "<script>alert('Data berhasil dihapus');window.location='../../home.php?pages=copy_ebr';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');window.location='../../home.php?pages=copy_ebr';</script>";
        }
    }
    exit;
}
// ===============================================
// 4. KIRIM PERMOHONAN COPY EBR (act=kirim_permohonan)
// ===============================================
elseif ($act == 'kirim_permohonan') {
    if (isset($_GET['id'])) {
        $id = mysql_real_escape_string($_GET['id']);
        $tgl_kirim = date('Y-m-d');
        $q = mysql_query("UPDATE copydok_ebr SET kirim_status='Y', tgl_kirimajuan='$tgl_kirim' WHERE oid='$id'");
        
        if ($q) {
            echo "<script>alert('Permohonan berhasil dikirim ke Admin!');window.location='../../home.php?pages=copy_ebr';</script>";
        } else {
            echo "<script>alert('Gagal mengirim permohonan');window.location='../../home.php?pages=copy_ebr';</script>";
        }
    }
    exit;
}

// ===============================================
// 5. ACC / SELESAI PERMOHONAN COPY EBR (act=acc)
// ===============================================
elseif ($act == 'acc') {
    if (isset($_GET['id'])) {
        $id = mysql_real_escape_string($_GET['id']);
        $tgl_selesai = date('Y-m-d');
        $q = mysql_query("UPDATE copydok_ebr SET sstatus='N', otgl_slesai='$tgl_selesai' WHERE oid='$id'");
        
        if ($q) {
            echo "<script>alert('Permohonan berhasil diselesaikan!');window.location='../../home.php?pages=copy_ebr';</script>";
        } else {
            echo "<script>alert('Gagal menyelesaikan permohonan');window.location='../../home.php?pages=copy_ebr';</script>";
        }
    }
    exit;
}
?>