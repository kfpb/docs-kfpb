<?php

include "../../config/koneksi.php";
$suid = $_POST['suid'] ?? '';

if (!$suid) {
    echo json_encode(["success" => false, "message" => "ID tidak ditemukan"]);
    exit;
}

// Ambil `suid_dinter` dari tabel `dister`
$query = mysql_query("SELECT suid_dinter FROM dister WHERE suid='$suid'");
$data = mysql_fetch_assoc($query);

// if ($data) {
    echo json_encode($data);
    ?>