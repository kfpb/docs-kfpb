<?php

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Dokumen_Terkendali.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil filter dari URL (jika ada)
$filter_pj = isset($_GET['filter_pj']) ? $_GET['filter_pj'] : '';

// Tambahkan filter ke query hanya jika ada filter yang dipilih
$where_clause = "";
if (!empty($filter_pj)) {
    $where_clause = "WHERE dipjdok = '$filter_pj'";
}

$dist = mysql_query("SELECT * FROM dinter $where_clause ORDER BY dikodok ASC");
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Dok</th>
            <th>No Revisi</th>
            <th>Judul Dokumen</th>
            <th>Tanggal Efektif</th>
            <th>Penanggung Jawab Dok</th>
            <th>Bagian</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($s = mysql_fetch_array($dist)) {
            $ditgl_brlk = tgl_indo($s['ditgl_brlk']);

            // Ambil data penanggung jawab
            $user_query = mysql_query("SELECT cNama, cJabatan, bagian FROM users WHERE cId = '{$s['dipjdok']}'");
            $user = mysql_fetch_array($user_query);
            $penanggung_jawab = $user ? $user['cNama'] : "Tidak Ditemukan";
            $jabatan = $user ? $user['cJabatan'] : "Tidak Ditemukan";
            $bagian = $user ? $user['bagian'] : "Tidak Ditemukan";

            echo "<tr>
                <td>{$no}</td>
                <td>{$s['dikodok']}</td>
                <td>{$s['direv']}</td>
                <td>{$s['dijudok']}</td>
                <td>{$ditgl_brlk}</td>
                <td>{$penanggung_jawab}</td>
                <td>{$jabatan} - {$bagian}</td>
            </tr>";

            $no++;
        }
        ?>
    </tbody>
</table>
