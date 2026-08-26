<?php
header('Content-Type: application/json');
include "../../config/koneksi.php";

$kodedokumen = isset($_GET['kodedokumen']) ? mysql_real_escape_string($_GET['kodedokumen']) : '';

if (empty($kodedokumen)) {
    echo json_encode([]);
    exit;
}

$query = mysql_query("SELECT jenisdok, difile, dijudok, dikodok FROM dinter WHERE dikodok='$kodedokumen'");

$files = [];

if ($query) {
    while ($row = mysql_fetch_assoc($query)) {
        if (!empty($row['difile'])) {
            $filePath = "dok/" . $row['jenisdok'] . "/" . $row['difile'];
            
            // Cek jika file tersimpan di direktori alternatif seperti fdok/
            if (!file_exists("../../" . $filePath) && file_exists("../../fdok/" . $row['difile'])) {
                $filePath = "fdok/" . $row['difile'];
            }
            
            $files[] = [
                'name'     => !empty($row['dijudok']) ? $row['dijudok'] . " (" . $row['difile'] . ")" : $row['difile'],
                'path'     => $filePath,
                'jenisdok' => $row['jenisdok'],
                'dikodok'  => $row['dikodok'],
                'filename' => $row['difile']
            ];
        }
    }
}

echo json_encode($files);
exit;
