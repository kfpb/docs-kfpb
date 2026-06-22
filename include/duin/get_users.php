<?php
include "../../config/koneksi.php";
header("Content-Type: application/json"); // Pastikan response dikembalikan sebagai JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jabatan = $_POST['jabatan'];

    if (empty($jabatan)) {
        echo json_encode([]); // Jika tidak ada filter, kirim array kosong
        exit;
    }

    // Debugging: Cek input yang diterima dari AJAX
    error_log("Jabatan Filter: " . $jabatan);

    // Menggunakan LIKE untuk mencocokkan jabatan
    if ($jabatan === "manager+super") {
        $query = "SELECT cId, cNama, cJabatan FROM users WHERE cJabatan LIKE '%manager%' OR cJabatan LIKE '%super%'";
    } else {
        $query = "SELECT cId, cNama, cJabatan FROM users WHERE cJabatan LIKE '%$jabatan%'";
    }

    // Debugging: Cek Query yang Dijalankan
    error_log("Query SQL: " . $query);

    $result = mysql_query($query);

    if (!$result) {
        error_log("SQL Error: " . mysql_error());
        echo json_encode(["error" => mysql_error()]);
        exit;
    }

    $users = [];
    while ($row = mysql_fetch_assoc($result)) {
        $users[] = [
            'cId' => $row['cId'],
            'cNama' => $row['cNama'],
            'cJabatan' => $row['cJabatan']
        ];
    }

    // Debugging: Cek Hasil Query
    error_log("Users Found: " . print_r($users, true));

    echo json_encode($users);
    exit;
}
?>
