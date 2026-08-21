<?php

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=permintaan_ebr.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cv = $_SESSION['cv'];

// Ambil filter tanggal dan jenis dokumen dari GET
$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : '';
$jenis_dokumen = isset($_GET['jenis_dokumen']) ? $_GET['jenis_dokumen'] : '';

// Validasi filter tanggal
if (!$dari || !$sampai) {
    die("Silakan pilih rentang tanggal terlebih dahulu.");
}

// Format tanggal untuk WHERE clause
$where_tanggal = "AND DATE(pdb.dibuat_pada) BETWEEN '$dari' AND '$sampai'";

// Format jenis dokumen untuk WHERE clause (jika dipilih)
$where_jenis = "";
if ($jenis_dokumen != '') {
    $where_jenis = " AND pdb.jenis_dokumen = '$jenis_dokumen'";
}

// Fungsi format tanggal
function formatTanggalIndonesia($tanggal) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $pecah = explode('-', date('Y-m-d', strtotime($tanggal)));
    return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}

// Cek role akses penuh
$akses_penuh = in_array($cv, [
    0, 1, 51, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057,
    71, 78, 76, 72, 22, 3, 50, 1003, 1061, 1062, 1063,
    92, 90, 74, 35, 27, 26, 38, 39, 40, 30, 36,
    46, 49, 48, 47, 59, 2
]);

$data = [];

if ($akses_penuh) {
    $query_pembuat = "SELECT pdb.*, NULL as sudah_dilihat, NULL as user_id FROM permintaan_dokumen_batch pdb WHERE 1=1 $where_tanggal $where_jenis ORDER BY pdb.dibuat_pada DESC";
    $result_pembuat = mysql_query($query_pembuat);
} else {
    $query_pembuat = "SELECT pdb.*, NULL as sudah_dilihat, NULL as user_id FROM permintaan_dokumen_batch pdb WHERE pdb.peminta = '$cv' $where_tanggal $where_jenis ORDER BY pdb.dibuat_pada DESC";
    $result_pembuat = mysql_query($query_pembuat);

    $query_notif = "SELECT DISTINCT pdb.*, ns.sudah_dilihat, ns.user_id FROM permintaan_dokumen_batch pdb INNER JOIN notifikasi_status_permintaan_bets ns ON pdb.id_permintaan = ns.id_permintaan WHERE ns.user_id = '$cv' $where_tanggal $where_jenis ORDER BY pdb.dibuat_pada DESC";
    $result_notif = mysql_query($query_notif);
}

// Gabungkan hasil pembuat
if (isset($result_pembuat)) {
    while ($row = mysql_fetch_assoc($result_pembuat)) {
        $data[$row['id_permintaan']] = $row;
    }
}

// Gabungkan hasil notifikasi
if (isset($result_notif)) {
    while ($row = mysql_fetch_assoc($result_notif)) {
        $data[$row['id_permintaan']] = $row;
    }
}

$data = array_values($data);

// Output ke Excel
echo "<table border='1'>
<tr>
    <th>Tgl. SPK Turun</th>
    <th>Nama Produk</th>
    <th>No Batch</th>
    <th>Besar Batch</th>
    <th>Jenis Dokumen</th>
    <th>Catatan</th>
</tr>";

foreach ($data as $row) {
    $tgl_spk_turun = formatTanggalIndonesia($row['dibuat_pada']);
    $nama_produk   = $row['nama_produk'];
    $no_batch      = $row['nomor_batch'];
    $besar_batch   = $row['besaran_bets'];
    $jenis_dokumen = $row['jenis_dokumen'];
    $catatan       = $row['catatan'];

    echo "<tr>
        <td>$tgl_spk_turun</td>
        <td>$nama_produk</td>
        <td>$no_batch</td>
        <td>$besar_batch</td>
        <td>$jenis_dokumen</td>
        <td>$catatan</td>
    </tr>";
}

echo "</table>";
?>