<?php
/**
 * Migration Runner for PKPA Features & Audit Trail
 * Sistem DOCS KFPB
 */
error_reporting(E_ERROR);
if (php_sapi_name() !== 'cli') {
    header('Content-Type: text/plain; charset=utf-8');
}

echo "--- Starting PKPA & Audit Trail Migration ---\n";

$server   = "localhost";
$username = "sql_docs_kfpb_ki";
$password = "4Bsri2BHcfjhNSPp";
$database = "sql_docs_kfpb_ki";

$conn = null;
$conn_error = '';
if (extension_loaded('mysqli')) {
    mysqli_report(MYSQLI_REPORT_OFF);
    try {
        $conn = @mysqli_connect($server, $username, $password, $database);
        if ($conn) {
            echo "[OK] Terhubung ke MySQL database '$database' via mysqli.\n";
        } else {
            $conn_error = mysqli_connect_error();
        }
    } catch (Exception $e) {
        $conn_error = $e->getMessage();
        $conn = null;
    }
}

if (!$conn && function_exists('mysql_connect')) {
    $link = @mysql_connect($server, $username, $password);
    if ($link && @mysql_select_db($database)) {
        echo "[OK] Terhubung ke MySQL database '$database' via mysql legacy.\n";
        $conn = $link;
    } else {
        $conn_error = mysql_error();
    }
}

function run_query($sql, $conn) {
    if (is_object($conn)) {
        return mysqli_query($conn, $sql);
    } elseif (function_exists('mysql_query')) {
        return mysql_query($sql);
    }
    return false;
}

function get_error($conn) {
    if (is_object($conn)) {
        return mysqli_error($conn);
    } elseif (function_exists('mysql_error')) {
        return mysql_error();
    }
    return 'Koneksi database tidak tersedia';
}

if (!$conn) {
    die("[ERROR] Gagal terhubung ke database '$database' pada '$server'.\nDetail Error: " . ($conn_error ?: 'Koneksi ditolak / database tidak ditemukan') . "\n");
}

// 1. Cek & Tambah kolom pada tabel users
$res = run_query("SHOW COLUMNS FROM users", $conn);
if ($res) {
    $cols = array();
    while ($r = ($conn ? mysqli_fetch_assoc($res) : mysql_fetch_assoc($res))) {
        $cols[] = $r['Field'];
    }

    $alters = array();
    if (!in_array('is_pkpa', $cols)) {
        $alters[] = "ADD COLUMN `is_pkpa` ENUM('N','Y') NOT NULL DEFAULT 'N' AFTER `cPass`";
    }
    if (!in_array('tgl_mulai', $cols)) {
        $alters[] = "ADD COLUMN `tgl_mulai` DATE NULL AFTER `is_pkpa`";
    }
    if (!in_array('tgl_expired', $cols)) {
        $alters[] = "ADD COLUMN `tgl_expired` DATE NULL AFTER `tgl_mulai`";
    }
    if (!in_array('status_akun', $cols)) {
        $alters[] = "ADD COLUMN `status_akun` ENUM('aktif','expired','dibekukan') NOT NULL DEFAULT 'aktif' AFTER `tgl_expired`";
    }

    if (count($alters) > 0) {
        $sql_alter = "ALTER TABLE `users` " . implode(", ", $alters);
        if (run_query($sql_alter, $conn)) {
            echo "[OK] Kolom PKPA berhasil ditambahkan ke tabel users.\n";
        } else {
            echo "[ERROR] Gagal alter tabel users: " . get_error($conn) . "\n";
        }
    } else {
        echo "[INFO] Kolom PKPA pada tabel users sudah tersedia.\n";
    }
} else {
    echo "[WARN] Tidak dapat membaca kolom tabel users: " . get_error($conn) . "\n";
}

// 2. Buat tabel user_registered_devices
$sql_dev = "CREATE TABLE IF NOT EXISTS `user_registered_devices` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL DEFAULT 0,
  `username` VARCHAR(50) NOT NULL,
  `device_token` VARCHAR(64) NOT NULL,
  `device_sequence` INT(11) NOT NULL DEFAULT 1,
  `ip_address` VARCHAR(100) NULL,
  `user_agent` TEXT NULL,
  `first_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_count` INT(11) NOT NULL DEFAULT 1,
  `status` ENUM('aktif','diblokir') NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_device` (`username`, `device_token`),
  KEY `idx_token` (`device_token`),
  KEY `idx_user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

if (run_query($sql_dev, $conn)) {
    echo "[OK] Tabel user_registered_devices siap.\n";
} else {
    echo "[ERROR] Gagal membuat tabel user_registered_devices: " . get_error($conn) . "\n";
}

// 3. Buat tabel log_audit_trail
$sql_audit = "CREATE TABLE IF NOT EXISTS `log_audit_trail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `nama_user` VARCHAR(150) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL,
  `detail_kegiatan` TEXT NULL,
  `kode_dokumen` VARCHAR(100) NULL,
  `judul_dokumen` VARCHAR(255) NULL,
  `ip_address` VARCHAR(100) NULL,
  `device_token` VARCHAR(64) NULL,
  `device_sequence` INT(11) NULL,
  `status_anomali` ENUM('NORMAL','PERINGATAN','BAHAYA') NOT NULL DEFAULT 'NORMAL',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_time` (`username`, `created_at`),
  KEY `idx_kategori` (`kategori`),
  KEY `idx_dok` (`kode_dokumen`),
  KEY `idx_anomali` (`status_anomali`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

if (run_query($sql_audit, $conn)) {
    echo "[OK] Tabel log_audit_trail siap.\n";
} else {
    echo "[ERROR] Gagal membuat tabel log_audit_trail: " . get_error($conn) . "\n";
}

// 4. Siapkan Akun Contoh PKPA (pkpa_demo)
$sql_user = "INSERT INTO `users` (
    `cIdjab`, `cUser`, `cNama`, `cJabatan`, `cAtasan`, `cAudit`, `cAccatasan`, `cTelp`, `cEmail`, `cEmail2`, `cFoto`, `cPass`,
    `is_pkpa`, `tgl_mulai`, `tgl_expired`, `status_akun`, `cSession`, `idj`, `bagian`, `bagian2`, `level`, `delegasi`
) VALUES (
    'PKPA', 'pkpa_demo', 'Mahasiswa PKPA Farmasi (Demo)', 'Mahasiswa PKPA - Pemastian Mutu', '1', 'N', 'T', '08123456789', 'pkpa.demo@kimiafarma.co.id', '', '', MD5('pkpa12345'),
    'Y', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'aktif', '', 9, 'QA', '', '', '0'
) ON DUPLICATE KEY UPDATE
    `cNama`       = VALUES(`cNama`),
    `cJabatan`    = VALUES(`cJabatan`),
    `cPass`       = VALUES(`cPass`),
    `is_pkpa`     = VALUES(`is_pkpa`),
    `tgl_mulai`   = VALUES(`tgl_mulai`),
    `tgl_expired` = VALUES(`tgl_expired`),
    `status_akun` = VALUES(`status_akun`)";

if (run_query($sql_user, $conn)) {
    echo "[OK] Akun demo PKPA ('pkpa_demo' / password: 'pkpa12345') siap digunakan.\n";
} else {
    echo "[WARN] Gagal insert akun demo: " . get_error($conn) . "\n";
}

echo "--- Migration Finished Successfully ---\n";
