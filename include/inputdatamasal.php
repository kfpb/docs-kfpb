<?php
include 'koneksi.php'; // pastikan ini menghubungkan ke database Anda

$tgl_sekarang = date("Y-m-d");
$thn = date("Y");
$bln = date("m/Y");

// Ambil semua data dengan distatus = 'N'
$result = mysql_query("SELECT suid FROM dister WHERE distatus = 'N' ORDER BY suid ASC");

// Ambil nomor terakhir yang sudah terpakai
$query = "SELECT max(dinmr) as max_no FROM dister WHERE dinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$idMax = $data['max_no'];

// Hitung nomor urut terakhir
$noUrut = 0;
if ($idMax) {
    $noUrut = (int) substr($idMax, 3, 4);
}
// Proses update massal
while ($row = mysql_fetch_array($result)) {
    $noUrut++;
    $newID = sprintf("DD-%04s/$bln", $noUrut);
    $suid = $row['suid'];

// var_dump($newID);die();
    mysql_query("UPDATE dister SET dinmr = '$newID', distatus = 'Y' WHERE suid = '$suid'");
}

echo "Update selesai!";
?>
