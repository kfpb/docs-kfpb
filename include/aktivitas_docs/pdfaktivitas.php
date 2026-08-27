<?php
if (!isset($_SESSION)) {
    session_start();
}

// Support pemanggilan langsung maupun via include home1.php
if (!function_exists('tgl_indojam')) {
    if (file_exists("../../config/koneksi.php")) {
        include_once "../../config/koneksi.php";
        include_once "../../config/fungsi_indotgl.php";
    } elseif (file_exists("config/koneksi.php")) {
        include_once "config/koneksi.php";
        include_once "config/fungsi_indotgl.php";
    }
}

// Tangkap parameter filter
$tgl_awal  = isset($_REQUEST['tgl_awal']) ? trim($_REQUEST['tgl_awal']) : '';
$tgl_akhir = isset($_REQUEST['tgl_akhir']) ? trim($_REQUEST['tgl_akhir']) : '';
$f_action  = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : '';
$f_user    = isset($_REQUEST['user']) ? trim($_REQUEST['user']) : '';
$f_keyword = isset($_REQUEST['keyword']) ? trim($_REQUEST['keyword']) : '';
$f_akt     = isset($_REQUEST['aktivitas']) ? trim($_REQUEST['aktivitas']) : '';

// Lookup data pengguna untuk mapping ID -> Nama
$user_map = array();
$user_name_to_id = array();
$q_users_all = mysql_query("SELECT cId, cNama FROM users WHERE cNama != ''");
if ($q_users_all) {
    while ($ur = mysql_fetch_array($q_users_all)) {
        $user_map[$ur['cId']] = $ur['cNama'];
        $user_map[(string)$ur['cId']] = $ur['cNama'];
        $user_name_to_id[$ur['cNama']] = $ur['cId'];
    }
}

// Bangun query WHERE
$where_clauses = array("hide_data = 0");

if (!empty($tgl_awal)) {
    $safe_tgl_awal = mysql_real_escape_string($tgl_awal);
    $where_clauses[] = "created_at >= '$safe_tgl_awal 00:00:00'";
}
if (!empty($tgl_akhir)) {
    $safe_tgl_akhir = mysql_real_escape_string($tgl_akhir);
    $where_clauses[] = "created_at <= '$safe_tgl_akhir 23:59:59'";
}
if (!empty($f_action)) {
    $safe_action = mysql_real_escape_string($f_action);
    $where_clauses[] = "action = '$safe_action'";
}
if (!empty($f_user)) {
    $safe_user = mysql_real_escape_string($f_user);
    if (isset($user_name_to_id[$f_user])) {
        $user_cid = (int)$user_name_to_id[$f_user];
        $where_clauses[] = "(user = '$safe_user' OR user = '$user_cid')";
    } else {
        $where_clauses[] = "user = '$safe_user'";
    }
}
if (!empty($f_keyword)) {
    $safe_keyword = mysql_real_escape_string($f_keyword);
    $where_clauses[] = "(dokumen LIKE '%$safe_keyword%' OR kode_dokumen LIKE '%$safe_keyword%' OR deskripsi LIKE '%$safe_keyword%' OR jabatan LIKE '%$safe_keyword%')";
}
if (!empty($f_akt) && $f_akt != 'Pilih Dokumen') {
    $safe_akt = mysql_real_escape_string($f_akt);
    $where_clauses[] = "kode_aktivitas = '$safe_akt'";
}

$where_sql = implode(" AND ", $where_clauses);
$query_audit = mysql_query("SELECT * FROM aktivitas_dokumen WHERE $where_sql ORDER BY created_at DESC");
$total_data  = $query_audit ? mysql_num_rows($query_audit) : 0;

// Informasi pencetak saat ini
$nama_pencetak = isset($_SESSION['namalengkap']) ? $_SESSION['namalengkap'] : (isset($_SESSION['namauser']) ? $_SESSION['namauser'] : 'Pengguna Sistem');
if (isset($_SESSION['cv']) && !empty($_SESSION['cv'])) {
    $q_cur_u = mysql_query("SELECT cNama, cJabatan FROM users WHERE cId = '" . mysql_real_escape_string($_SESSION['cv']) . "'");
    if ($q_cur_u && $cur_u = mysql_fetch_array($q_cur_u)) {
        $nama_pencetak = $cur_u['cNama'] . (!empty($cur_u['cJabatan']) ? ' (' . $cur_u['cJabatan'] . ')' : '');
    }
}

// Format keterangan rentang tanggal filter
if (!empty($tgl_awal) && !empty($tgl_akhir)) {
    $periode_teks = tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir);
} elseif (!empty($tgl_awal)) {
    $periode_teks = "Mulai " . tgl_indo($tgl_awal);
} elseif (!empty($tgl_akhir)) {
    $periode_teks = "Sampai dengan " . tgl_indo($tgl_akhir);
} else {
    $periode_teks = "Semua Riwayat (Tanpa Batasan Tanggal)";
}

$waktu_cetak = date('d-m-Y H:i:s') . ' WIB';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan_Audit_Trail_Dokumen_<?php echo date('Ymd_His'); ?></title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm 8mm 12mm 8mm;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #222;
            background: #fff;
            margin: 0;
            padding: 10px;
        }
        .no-print-bar {
            background: #f4f6f9;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            padding: 10px 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-print {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 7px 16px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-print:hover {
            background-color: #0056b3;
        }
        .btn-close {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 7px 14px;
            font-size: 12px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            margin-left: 6px;
        }
        .btn-close:hover {
            background-color: #5a6268;
        }
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 2px solid #000;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }
        .kop-table td {
            vertical-align: middle;
        }
        .kop-logo {
            width: 120px;
            text-align: left;
        }
        .kop-logo img {
            max-height: 50px;
            max-width: 120px;
        }
        .kop-title {
            text-align: center;
        }
        .kop-title h2 {
            margin: 0;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kop-title h3 {
            margin: 2px 0 0 0;
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }
        .kop-title p {
            margin: 2px 0 0 0;
            font-size: 10px;
            color: #555;
        }
        .meta-box {
            background-color: #fafafa;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 8px 12px;
            margin-bottom: 12px;
            font-size: 11px;
        }
        .meta-table {
            width: 100%;
            border-collapse: collapse;
        }
        .meta-table td {
            padding: 2px 4px;
            vertical-align: top;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 15px;
        }
        .report-table th {
            background-color: #f1f3f5;
            color: #111;
            border: 1px solid #666;
            padding: 6px 4px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9.5px;
        }
        .report-table td {
            border: 1px solid #777;
            padding: 5px 4px;
            vertical-align: top;
        }
        .report-table tr:nth-child(even) {
            background-color: #fafbfc;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge {
            display: inline-block;
            padding: 2px 5px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 2px;
            text-transform: uppercase;
        }
        .badge-create { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .badge-update { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        .badge-delete { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .badge-approve { background-color: #cce5ff; color: #004085; border: 1px solid #b8daff; }
        .badge-reject { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .badge-other { background-color: #e2e3e5; color: #383d41; border: 1px solid #d6d8db; }
        .footer-note {
            font-size: 9px;
            color: #666;
            border-top: 1px dashed #ccc;
            padding-top: 5px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        @media print {
            .no-print-bar {
                display: none !important;
            }
            body {
                padding: 0;
                color: #000;
            }
            .report-table th {
                background-color: #eaeaea !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .report-table tr:nth-child(even) {
                background-color: #f7f7f7 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .badge-create { background-color: #d4edda !important; color: #155724 !important; -webkit-print-color-adjust: exact; }
            .badge-update { background-color: #d1ecf1 !important; color: #0c5460 !important; -webkit-print-color-adjust: exact; }
            .badge-delete { background-color: #f8d7da !important; color: #721c24 !important; -webkit-print-color-adjust: exact; }
            .badge-approve { background-color: #cce5ff !important; color: #004085 !important; -webkit-print-color-adjust: exact; }
            .badge-reject { background-color: #fff3cd !important; color: #856404 !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <!-- Bar Aksi (Hanya tampil di layar browser, tersembunyi saat cetak / simpan PDF) -->
    <div class="no-print-bar">
        <div>
            <strong>Preview Cetak PDF — Riwayat Audit Dokumen</strong>
            <div style="font-size: 11px; color: #666; margin-top: 2px;">
                Klik tombol <strong>Cetak / Simpan PDF</strong> di samping atau tekan <strong>Ctrl + P</strong>, lalu pilih printer tujuan <em>"Save as PDF"</em>.
            </div>
        </div>
        <div>
            <button type="button" class="btn-print" onclick="window.print();">🖨️ Cetak / Simpan PDF</button>
            <a href="javascript:window.close();" class="btn-close">Tutup</a>
        </div>
    </div>

    <!-- Kop Laporan Resmi -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo" style="width: 15%;">
                <img src="../../images/logo.png" onerror="this.src='images/logo.png'; this.onerror=null;" alt="Logo Kimia Farma">
            </td>
            <td class="kop-title" style="width: 70%;">
                <h2>PT KIMIA FARMA TBK. PLANT BANJARAN</h2>
                <h3>LAPORAN RIWAYAT AUDIT DOKUMEN (AUDIT TRAIL LOG)</h3>
                <p>Jl. Raya Banjaran KM 29,5 Bandung 40377 - Jawa Barat | Sistem E-KFPB Documentation System</p>
            </td>
            <td style="width: 15%; text-align: right; font-size: 9px; color: #555;">
                <strong>FORM AUDIT TRAIL</strong><br>
                Format Cetak Resmi
            </td>
        </tr>
    </table>

    <!-- Kotak Metadata / Filter -->
    <div class="meta-box">
        <table class="meta-table">
            <tr>
                <td style="width: 16%;"><strong>Periode Data</strong></td>
                <td style="width: 34%;">: <strong style="color: #0056b3;"><?php echo $periode_teks; ?></strong></td>
                <td style="width: 16%;"><strong>Waktu Cetak</strong></td>
                <td style="width: 34%;">: <?php echo $waktu_cetak; ?></td>
            </tr>
            <tr>
                <td><strong>Filter Action</strong></td>
                <td>: <?php echo !empty($f_action) ? htmlspecialchars($f_action) : 'Semua Action'; ?></td>
                <td><strong>Dicetak Oleh</strong></td>
                <td>: <?php echo htmlspecialchars($nama_pencetak); ?></td>
            </tr>
            <tr>
                <td><strong>Filter Pengguna</strong></td>
                <td>: <?php echo !empty($f_user) ? htmlspecialchars($f_user) : 'Semua Pengguna'; ?></td>
                <td><strong>Total Data Ditemukan</strong></td>
                <td>: <strong><?php echo number_format($total_data); ?></strong> rekaman aktivitas</td>
            </tr>
            <?php if (!empty($f_keyword)): ?>
            <tr>
                <td><strong>Kata Kunci Pencarian</strong></td>
                <td colspan="3">: "<em><?php echo htmlspecialchars($f_keyword); ?></em>"</td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <!-- Tabel Data Audit Trail -->
    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 20%;">Dokumen</th>
                <th style="width: 12%;">Kode Dokumen</th>
                <th style="width: 14%;">User / Pengguna</th>
                <th style="width: 13%;">Jabatan</th>
                <th style="width: 7%;">Action</th>
                <th style="width: 17%;">Deskripsi Aktivitas</th>
                <th style="width: 14%;">Waktu Aktivitas</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($total_data == 0) {
            echo "<tr><td colspan='8' class='text-center' style='padding: 25px; color: #888;'>Tidak ada data aktivitas dokumen yang sesuai dengan filter yang dipilih.</td></tr>";
        } else {
            $no = 1;
            while ($row = mysql_fetch_array($query_audit)) {
                // Resolusi User ID ke Nama Pengguna
                $user_raw = trim($row['user']);
                if (is_numeric($user_raw) && isset($user_map[$user_raw])) {
                    $user_tampil = $user_map[$user_raw];
                } elseif (!empty($user_raw) && $user_raw != '-') {
                    $user_tampil = $user_raw;
                } else {
                    $user_tampil = '(Tidak tercatat)';
                }

                $jabatan_tampil = (!empty($row['jabatan']) && $row['jabatan'] != '-') ? $row['jabatan'] : '-';

                // Resolusi Dokumen
                $dok_raw = trim($row['dokumen']);
                if (empty($dok_raw) || $dok_raw == 'Dokumen' || $dok_raw == '-') {
                    if (!empty($row['kode_dokumen']) && $row['kode_dokumen'] != '-') {
                        $dok_tampil = $row['kode_dokumen'];
                    } else {
                        $dok_tampil = '(Tanpa Judul)';
                    }
                } else {
                    $dok_tampil = $dok_raw;
                }

                $kodedok_tampil = (!empty($row['kode_dokumen']) && $row['kode_dokumen'] != '-') ? $row['kode_dokumen'] : '-';

                // Badge Action
                $action_raw = strtolower(trim($row['action']));
                $badge_class = 'badge-other';
                if ($action_raw == 'create') $badge_class = 'badge-create';
                elseif ($action_raw == 'update') $badge_class = 'badge-update';
                elseif ($action_raw == 'delete' || $action_raw == 'delete all') $badge_class = 'badge-delete';
                elseif ($action_raw == 'approve') $badge_class = 'badge-approve';
                elseif ($action_raw == 'reject') $badge_class = 'badge-reject';
                ?>
                <tr>
                    <td class="text-center"><?php echo $no; ?></td>
                    <td><strong><?php echo htmlspecialchars($dok_tampil); ?></strong></td>
                    <td class="text-center"><?php echo htmlspecialchars($kodedok_tampil); ?></td>
                    <td><?php echo htmlspecialchars($user_tampil); ?></td>
                    <td><?php echo htmlspecialchars($jabatan_tampil); ?></td>
                    <td class="text-center"><span class="badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['action']); ?></span></td>
                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                    <td class="text-center"><?php echo tgl_indojam($row['created_at']); ?></td>
                </tr>
                <?php
                $no++;
            }
        }
        ?>
        </tbody>
    </table>

    <!-- Catatan Kaki Laporan -->
    <div class="footer-note">
        <div>
            <em>Dokumen ini dicetak secara sah dan otomatis dari Sistem Manajemen Dokumen E-KFPB.</em>
        </div>
        <div>
            Halaman dicetak pada: <?php echo $waktu_cetak; ?>
        </div>
    </div>

</body>
</html>
