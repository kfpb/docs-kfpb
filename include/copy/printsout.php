<?php
// ===============================================
// printsout.php  —  Export CopyDok to Excel (PHP 5.6)
// ===============================================
// Pastikan TIDAK ADA output sebelum header (spasi/BOM).
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// ----- Koneksi (opsional, sesuaikan) -----
// include 'koneksi.php'; // <-- sesuaikan bila perlu

// ----- Matikan notice agar tidak ganggu header -----
error_reporting(E_ALL & ~E_NOTICE);

// ----- Helper: tgl_indo1 fallback bila belum ada -----
if (!function_exists('tgl_indo1')) {
    function tgl_indo1($datetime)
    {
        if (!$datetime) return '';
        // Terima DATE atau DATETIME
        $ts = strtotime($datetime);
        if ($ts === false) return $datetime;
        $bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $d = (int)date('j', $ts);
        $m = (int)date('n', $ts);
        $y = date('Y', $ts);
        return $d.' '.$bulan[$m].' '.$y;
    }
}

// ----- Ambil & sanitasi input -----
$jenis = isset($_POST['jenispptek']) ? $_POST['jenispptek'] : 'ALL';
$bln1  = isset($_POST['blnn1']) ? $_POST['blnn1'] : '';
$bln2  = isset($_POST['blnn2']) ? $_POST['blnn2'] : '';

$jenis = mysql_real_escape_string($jenis);
$bln1  = mysql_real_escape_string($bln1);
$bln2  = mysql_real_escape_string($bln2);

// Normalisasi waktu supaya 1 hari penuh
$startDate = ($bln1 !== '') ? $bln1 . ' 00:00:00' : '';
$endDate   = ($bln2 !== '') ? $bln2 . ' 23:59:59' : '';

// ----- Build WHERE -----
$where = array();
$where[] = "(c.kirim_status='Y' OR c.kirim_status IS NULL)";

if ($startDate !== '' && $endDate !== '') {
    $where[] = "c.otgl BETWEEN '{$startDate}' AND '{$endDate}'";
} elseif ($startDate !== '') {
    $where[] = "c.otgl >= '{$startDate}'";
} elseif ($endDate !== '') {
    $where[] = "c.otgl <= '{$endDate}'";
}

if ($jenis !== '' && strtoupper($jenis) !== 'ALL') {
    // Cocokkan ke label 'jenis' dari tabel mapping sft
    $where[] = "sft.jenis = '{$jenis}'";
}

$whereSql = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// ----- SQL -----
$sql = "
SELECT 
    c.sstatus,
    c.otgl,
    u.cNama,
    sft.jenis,
    c.otgl_admin,
    c.otgl_slesai,
    c.okepada,
    c.kirim_status,
    l.dinmr,
    l.dijudok,
    l.direv,
    l.dijumlah,
    l.diketdok,
    l.dilokasi
FROM 
    copydok c
JOIN 
    users u ON c.opengirim = u.cId
LEFT JOIN 
    copydok_lampiran l ON c.oid = l.copydok_id
LEFT JOIN (
    SELECT 1 AS id, 'Controlled'   AS jenis 
    UNION SELECT 2 AS id, 'Uncontrolled' AS jenis 
    UNION SELECT 3 AS id, 'Batch Record' AS jenis 
    UNION SELECT 4 AS id, 'Email/File'   AS jenis 
) sft ON c.jenisms = sft.id
{$whereSql}
ORDER BY 
    c.otgl DESC
";

// ----- Eksekusi -----
$smasuk = mysql_query($sql);
if (!$smasuk) {
    // Jika terjadi error query, tetap tampilkan file XLS kosong agar tidak blank
    $err = mysql_error();
    $data = array();
} else {
    $data = array();
    $cv = isset($_SESSION['cv']) ? $_SESSION['cv'] : null;

    while ($s = mysql_fetch_array($smasuk)) {
        // Tentukan status akhir (ikuti logika asli, gunakan || untuk OR)
        $statusText = 'Telah Selesai';
        if ($s['sstatus'] == 'N') {
            if ($s['okepada'] == $cv || $cv == 0 || $cv == 1 || $cv == 53) {
                $statusText = 'Selesai';
            } else {
                $statusText = ($s['kirim_status'] == 'N') ? 'Kirim Permintaan' : 'Belum Selesai';
            }
        }

        $data[] = array(
            'sstatus'           => $s['sstatus'],
            'tanggal'           => tgl_indo1($s['otgl']),
            'Pemohon'           => $s['cNama'],
            'Jenis Copy'        => $s['jenis'],
            'Tanggal Baca MR'   => tgl_indo1($s['otgl_admin']),
            'Tanggal Selesai'   => tgl_indo1($s['otgl_slesai']),
            'Status'            => $statusText,
            'dinmr'             => $s['dinmr'],
            'dijudok'           => $s['dijudok'],
            'direv'             => $s['direv'],
            'dijumlah'          => $s['dijumlah'],
            'diketdok'          => $s['diketdok'],
            'dilokasi'          => $s['dilokasi'],
        );
    }
}

// ----- Export ke Excel -----
exportToExcel($data, 'data_copydok.xls');
exit;

// ============================
// FUNGSI EXPORT
// ============================
function exportToExcel($data, $filename = 'export.xls')
{
    // Header file Excel
    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment; filename=\"{$filename}\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Jika data kosong, tetap render header kolom standar
    if (empty($data)) {
        echo "<table border='1'><thead><tr>";
        $cols = array('sstatus','tanggal','Pemohon','Jenis Copy','Tanggal Baca MR','Tanggal Selesai','Status','dinmr','dijudok','direv','dijumlah','diketdok','dilokasi');
        foreach ($cols as $c) echo "<th>".htmlspecialchars($c)."</th>";
        echo "</tr></thead><tbody></tbody></table>";
        return;
    }

    echo "<table border='1'><thead><tr>";
    foreach (array_keys($data[0]) as $key) {
        echo "<th>" . htmlspecialchars($key) . "</th>";
    }
    echo "</tr></thead><tbody>";

    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $val) {
            // htmlspecialchars untuk aman
            echo "<td>" . htmlspecialchars($val) . "</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table>";
}
