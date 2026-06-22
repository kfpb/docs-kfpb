<?php
if (isset($_GET['pdf']) && isset($_GET['preventPrint'])) {
    // Periksa izin pengguna untuk mencetak
    if (!userHasPermissionToPrint()) {
        header('Content-Type: text/html');
        echo 'Anda tidak memiliki izin untuk mencetak dokumen ini.';
        exit;
    }

    // Jika memiliki izin, tampilkan PDF seperti biasa
    header('Content-Type: application/pdf');
    readfile($_GET['pdf']);
    exit;
} else {
    // Jika tidak ada parameter atau izin tidak mencukupi, tampilkan halaman kosong
    echo 'Halaman kosong';
}