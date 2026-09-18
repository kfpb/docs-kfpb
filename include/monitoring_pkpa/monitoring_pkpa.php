<?php
/**
 * Modul Monitoring Akun PKPA, Perangkat PC & Audit Trail
 * Khusus Supervisor Sistem Dokumentasi / Administrator
 * Sistem: DOCS KFPB
 */
if (session_status() == PHP_SESSION_NONE) { session_start(); }

// Pastikan hanya user yang berhak (Admin / Supervisor) yang bisa mengakses
$user_level = isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : '';
$jabatan = isset($_SESSION['jabatan']) ? $_SESSION['jabatan'] : '';

// Handle aksi Supervisor: Perpanjang, Reset PC, Bekukan/Aktifkan
if (isset($_GET['action'])) {
    $act = $_GET['action'];
    $uid = intval($_GET['uid']);

    if ($act == 'perpanjang' && $uid > 0) {
        // Tambah 30 hari dari hari ini atau dari tanggal expired sebelumnya jika masih aktif
        $u_row = mysql_fetch_assoc(mysql_query("SELECT tgl_expired FROM users WHERE cId='$uid'"));
        $exp_base = ($u_row && $u_row['tgl_expired'] > date('Y-m-d')) ? $u_row['tgl_expired'] : date('Y-m-d');
        $new_exp = date('Y-m-d', strtotime("$exp_base + 30 days"));
        mysql_query("UPDATE users SET tgl_expired='$new_exp', status_akun='aktif' WHERE cId='$uid'");
        echo "<script>alert('Masa aktif akun PKPA berhasil diperpanjang 30 hari hingga $new_exp'); window.location='home.php?pages=monitoring_pkpa';</script>";
        exit;
    } elseif ($act == 'reset_pc' && $uid > 0) {
        $u_row = mysql_fetch_assoc(mysql_query("SELECT cUser FROM users WHERE cId='$uid'"));
        if ($u_row) {
            mysql_query("DELETE FROM user_registered_devices WHERE username='$u_row[cUser]'");
            // Catat log reset device
            mysql_query("INSERT INTO log_audit_trail (username, nama_user, kategori, detail_kegiatan, status_anomali)
                         VALUES ('$_SESSION[nppcv]', '$_SESSION[namacv]', 'ANOMALI_DEVICE', 'Supervisor me-reset riwayat PC untuk user: $u_row[cUser]', 'NORMAL')");
            echo "<script>alert('Riwayat perangkat PC untuk akun $u_row[cUser] berhasil di-reset.'); window.location='home.php?pages=monitoring_pkpa';</script>";
            exit;
        }
    } elseif ($act == 'toggle_status' && $uid > 0) {
        $curr = $_GET['curr'];
        $new_status = ($curr == 'aktif') ? 'dibekukan' : 'aktif';
        mysql_query("UPDATE users SET status_akun='$new_status' WHERE cId='$uid'");
        echo "<script>alert('Status akun berhasil diubah menjadi: $new_status'); window.location='home.php?pages=monitoring_pkpa';</script>";
        exit;
    }
}

// Ambil Statistik
$q_stat_total = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as total FROM users WHERE is_pkpa='Y'"));
$q_stat_aktif = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as total FROM users WHERE is_pkpa='Y' AND status_akun='aktif' AND tgl_expired >= CURDATE()"));
$q_stat_expired = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as total FROM users WHERE is_pkpa='Y' AND (status_akun='expired' OR tgl_expired < CURDATE())"));

// Hitung berapa user PKPA yang login di > 1 PC
$q_stat_multipc = mysql_fetch_assoc(mysql_query("
    SELECT COUNT(*) as total FROM (
        SELECT username FROM user_registered_devices 
        WHERE username IN (SELECT cUser FROM users WHERE is_pkpa='Y')
        GROUP BY username HAVING COUNT(DISTINCT device_token) > 1
    ) AS multipc_users
"));
?>

<div class="navbar navbar-inner block-header">
    <div class="muted pull-left">
        <strong><i class="icon-eye-open"></i> Monitoring Akun PKPA, Perangkat Akses & Audit Trail</strong>
    </div>
    <div class="pull-right">
        <span class="label label-info">Supervisor Sistem Dokumentasi</span>
    </div>
</div>

<div class="block-content collapse in" style="padding: 15px;">
    <!-- KARTU STATISTIK KILAT -->
    <div class="row-fluid" style="margin-bottom: 20px;">
        <div class="span3">
            <div class="well" style="text-align: center; background-color: #f5f5f5; border-left: 5px solid #0088cc; margin-bottom: 0;">
                <h3 style="margin: 0; color: #0088cc;"><?php echo intval($q_stat_total['total']); ?></h3>
                <small>Total Akun PKPA</small>
            </div>
        </div>
        <div class="span3">
            <div class="well" style="text-align: center; background-color: #f5f5f5; border-left: 5px solid #51a351; margin-bottom: 0;">
                <h3 style="margin: 0; color: #51a351;"><?php echo intval($q_stat_aktif['total']); ?></h3>
                <small>Akun Masih Aktif</small>
            </div>
        </div>
        <div class="span3">
            <div class="well" style="text-align: center; background-color: #f5f5f5; border-left: 5px solid #f89406; margin-bottom: 0;">
                <h3 style="margin: 0; color: #f89406;"><?php echo intval($q_stat_multipc['total']); ?></h3>
                <small>Akun Terdeteksi Multi-PC (>1 PC)</small>
            </div>
        </div>
        <div class="span3">
            <div class="well" style="text-align: center; background-color: #f5f5f5; border-left: 5px solid #bd362f; margin-bottom: 0;">
                <h3 style="margin: 0; color: #bd362f;"><?php echo intval($q_stat_expired['total']); ?></h3>
                <small>Akun Kadaluarsa (Expired)</small>
            </div>
        </div>
    </div>

    <!-- NAVIGASI TAB -->
    <ul class="nav nav-tabs" id="tabMonitoring">
        <li class="active"><a href="#tab-daftar-pkpa" data-toggle="tab"><i class="icon-user"></i> Daftar Akun PKPA & Status PC</a></li>
        <li><a href="#tab-audit-trail" data-toggle="tab"><i class="icon-list-alt"></i> Log Audit Trail Akses & Dokumen</a></li>
        <li><a href="#tab-perangkat" data-toggle="tab"><i class="icon-hdd"></i> Riwayat Perangkat Terdaftar</a></li>
    </ul>

    <div class="tab-content">
        <!-- TAB 1: DAFTAR AKUN PKPA -->
        <div class="tab-pane active" id="tab-daftar-pkpa">
            <div class="alert alert-info" style="margin-bottom: 15px;">
                <i class="icon-info-sign"></i> <strong>Aturan Sistem:</strong> Akun PKPA otomatis kadaluarsa setelah 30 hari. Akses dari PC berbeda diizinkan (tidak dikunci mati) tetapi diberi tanda peringatan dan tercatat dalam riwayat perangkat.
            </div>

            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr style="background-color: #f9f9f9;">
                        <th style="width: 30px; text-align: center;">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Username</th>
                        <th>Bagian</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Expired</th>
                        <th style="text-align: center;">Sisa Hari</th>
                        <th style="text-align: center;">Perangkat (PC)</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center; width: 190px;">Aksi Supervisor</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $q_pkpa = mysql_query("
                    SELECT u.*, 
                    (SELECT COUNT(DISTINCT device_token) FROM user_registered_devices WHERE username=u.cUser) as jml_device
                    FROM users u
                    WHERE u.is_pkpa='Y'
                    ORDER BY u.cId DESC
                ");

                if ($q_pkpa && mysql_num_rows($q_pkpa) > 0) {
                    while ($r = mysql_fetch_assoc($q_pkpa)) {
                        $today = new DateTime();
                        $exp = new DateTime($r['tgl_expired']);
                        $diff = $today->diff($exp);
                        $is_past = ($today > $exp);
                        $days_left = $is_past ? 0 : $diff->days;

                        // Tentukan label status & sisa hari
                        if ($r['status_akun'] == 'dibekukan') {
                            $badge_status = "<span class='label label-inverse'>DIBEKUKAN</span>";
                            $badge_sisa = "<span class='label'>Nonaktif</span>";
                        } elseif ($is_past || $r['status_akun'] == 'expired') {
                            $badge_status = "<span class='label label-important'>EXPIRED</span>";
                            $badge_sisa = "<span class='label label-important'>0 Hari (Habis)</span>";
                        } elseif ($days_left <= 5) {
                            $badge_status = "<span class='label label-warning'>Mendekati Habis</span>";
                            $badge_sisa = "<span class='label label-warning'>$days_left Hari</span>";
                        } else {
                            $badge_status = "<span class='label label-success'>AKTIF</span>";
                            $badge_sisa = "<span class='label label-success'>$days_left Hari</span>";
                        }

                        // Tentukan status perangkat
                        $jml_dev = intval($r['jml_device']);
                        if ($jml_dev == 0) {
                            $badge_dev = "<span class='label'>Belum Login</span>";
                        } elseif ($jml_dev == 1) {
                            $badge_dev = "<span class='label label-info'><i class='icon-ok-sign icon-white'></i> 1 PC</span>";
                        } else {
                            $badge_dev = "<span class='label label-warning' title='Terdeteksi dibuka di $jml_dev PC berbeda'><i class='icon-warning-sign icon-white'></i> $jml_dev PC Berbeda</span>";
                        }

                        echo "<tr>
                            <td style='text-align: center;'>$no</td>
                            <td><strong>$r[cNama]</strong></td>
                            <td><code>$r[cUser]</code></td>
                            <td>$r[bagian]</td>
                            <td>" . (!empty($r['tgl_mulai']) ? date('d/m/Y', strtotime($r['tgl_mulai'])) : '-') . "</td>
                            <td>" . (!empty($r['tgl_expired']) ? date('d/m/Y', strtotime($r['tgl_expired'])) : '-') . "</td>
                            <td style='text-align: center;'>$badge_sisa</td>
                            <td style='text-align: center;'>$badge_dev</td>
                            <td style='text-align: center;'>$badge_status</td>
                            <td style='text-align: center;'>
                                <div class='btn-group'>
                                    <a class='btn btn-mini btn-primary' href='home.php?pages=monitoring_pkpa&action=perpanjang&uid=$r[cId]' onclick=\"return confirm('Perpanjang masa aktif akun $r[cNama] 30 hari ke depan?');\" title='Perpanjang 30 Hari'><i class='icon-time icon-white'></i> +30 Hari</a>
                                    <a class='btn btn-mini btn-warning' href='home.php?pages=monitoring_pkpa&action=reset_pc&uid=$r[cId]' onclick=\"return confirm('Reset riwayat PC untuk $r[cNama]? Akun akan kembali dihitung dari PC #1');\" title='Reset Riwayat Perangkat'><i class='icon-refresh icon-white'></i> Reset PC</a>
                                    <a class='btn btn-mini " . ($r['status_akun'] == 'aktif' ? "btn-danger" : "btn-success") . "' href='home.php?pages=monitoring_pkpa&action=toggle_status&uid=$r[cId]&curr=$r[status_akun]' onclick=\"return confirm('Ubah status akun $r[cNama]?');\" title='Bekukan / Aktifkan'>
                                        <i class='" . ($r['status_akun'] == 'aktif' ? "icon-ban-circle" : "icon-ok") . " icon-white'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='10' style='text-align: center; color: #888;'>Belum ada data akun PKPA yang terdaftar.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <!-- TAB 2: AUDIT TRAIL LOG -->
        <div class="tab-pane" id="tab-audit-trail">
            <h4><i class="icon-list-alt"></i> Catatan Audit Trail Aktivitas (GxP / Data Integrity)</h4>
            <p style="color: #666; font-size: 13px;">
                Mencatat kronologi lengkap setiap kali akun PKPA melakukan login antar-PC, percobaan login setelah kadaluarsa, serta dokumen SOP/IK yang dibuka.
            </p>

            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr style="background-color: #f9f9f9;">
                        <th style="width: 130px;">Waktu</th>
                        <th>Mahasiswa / User</th>
                        <th>Kategori</th>
                        <th>Detail Aktivitas</th>
                        <th>Dokumen Diakses</th>
                        <th>IP Address</th>
                        <th>Perangkat</th>
                        <th>Status Anomali</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q_audit = mysql_query("
                    SELECT a.* FROM log_audit_trail a
                    WHERE a.username IN (SELECT cUser FROM users WHERE is_pkpa='Y')
                       OR a.kategori = 'ANOMALI_DEVICE'
                       OR a.kategori = 'EXPIRED_ATTEMPT'
                    ORDER BY a.id DESC LIMIT 100
                ");

                if ($q_audit && mysql_num_rows($q_audit) > 0) {
                    while ($row = mysql_fetch_assoc($q_audit)) {
                        $badge_kat = "<span class='label label-info'>$row[kategori]</span>";
                        if ($row['kategori'] == 'ANOMALI_DEVICE') {
                            $badge_kat = "<span class='label label-warning'>ANOMALI PC</span>";
                        } elseif ($row['kategori'] == 'EXPIRED_ATTEMPT') {
                            $badge_kat = "<span class='label label-important'>EXPIRED ATTEMPT</span>";
                        } elseif ($row['kategori'] == 'VIEW_DOKUMEN') {
                            $badge_kat = "<span class='label label-success'>VIEW DOKUMEN</span>";
                        }

                        $badge_ano = "<span class='badge badge-success'>Normal</span>";
                        if ($row['status_anomali'] == 'PERINGATAN') {
                            $badge_ano = "<span class='badge badge-warning'>Peringatan</span>";
                        } elseif ($row['status_anomali'] == 'BAHAYA') {
                            $badge_ano = "<span class='badge badge-important'>Bahaya</span>";
                        }

                        $dok_info = !empty($row['kode_dokumen']) ? "<strong>$row[kode_dokumen]</strong><br><small>$row[judul_dokumen]</small>" : "-";
                        $dev_info = !empty($row['device_sequence']) ? "PC ke-$row[device_sequence]" : "-";

                        echo "<tr>
                            <td><small>" . date('d/m/Y H:i:s', strtotime($row['created_at'])) . "</small></td>
                            <td><strong>$row[nama_user]</strong><br><small><code>$row[username]</code></small></td>
                            <td>$badge_kat</td>
                            <td>$row[detail_kegiatan]</td>
                            <td>$dok_info</td>
                            <td><code>$row[ip_address]</code></td>
                            <td>$dev_info</td>
                            <td style='text-align: center;'>$badge_ano</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align: center; color: #888;'>Belum ada rekaman audit trail aktivitas.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <!-- TAB 3: RIWAYAT PERANGKAT TERDAFTAR -->
        <div class="tab-pane" id="tab-perangkat">
            <h4><i class="icon-hdd"></i> Daftar Perangkat (PC) yang Pernah Digunakan</h4>
            <p style="color: #666; font-size: 13px;">
                Melihat daftar browser dan komputer yang pernah digunakan oleh tiap mahasiswa PKPA beserta frekuensi loginnya.
            </p>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color: #f9f9f9;">
                        <th>Username</th>
                        <th>Urutan PC</th>
                        <th>IP Address Terakhir</th>
                        <th>Browser & Sistem Operasi</th>
                        <th>Pertama Login</th>
                        <th>Terakhir Login</th>
                        <th style="text-align: center;">Jml Akses</th>
                        <th style="text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q_dev = mysql_query("
                    SELECT d.*, u.cNama FROM user_registered_devices d
                    LEFT JOIN users u ON d.username = u.cUser
                    ORDER BY d.username ASC, d.device_sequence ASC
                ");

                if ($q_dev && mysql_num_rows($q_dev) > 0) {
                    while ($drow = mysql_fetch_assoc($q_dev)) {
                        $seq_label = ($drow['device_sequence'] == 1) 
                            ? "<span class='badge badge-info'>PC #1 (Utama)</span>" 
                            : "<span class='badge badge-warning'>PC #$drow[device_sequence] (Tambahan)</span>";

                        echo "<tr>
                            <td><strong>$drow[cNama]</strong><br><small><code>$drow[username]</code></small></td>
                            <td>$seq_label</td>
                            <td><code>$drow[ip_address]</code></td>
                            <td><small>" . htmlspecialchars(substr($drow['user_agent'], 0, 100)) . "...</small></td>
                            <td><small>" . date('d/m/Y H:i', strtotime($drow['first_login'])) . "</small></td>
                            <td><small>" . date('d/m/Y H:i', strtotime($drow['last_login'])) . "</small></td>
                            <td style='text-align: center;'>$drow[login_count]x</td>
                            <td style='text-align: center;'><span class='label label-success'>$drow[status]</span></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align: center; color: #888;'>Belum ada perangkat yang tercatat login.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
