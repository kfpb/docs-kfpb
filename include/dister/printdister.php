<?php
// Fungsi untuk mengekspor data tabel ke Excel
function exportToExcel($filename = 'data_distribusi.xls', $data) {
    // Header untuk file Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Tulis header tabel
    echo "<table><thead><tr>";
    foreach ($data[0] as $key => $value) {
        echo "<th>$key</th>";
    }
    echo "</tr></thead><tbody>";

    // Tulis data tabel
    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>"; // Escape HTML characters
        }
        echo "</tr>";
    }

    // Tutup tabel
    echo "</tbody></table>";
}

// Ambil data dari database
if (isset($_POST['blnn1']) && isset($_POST['blnn2'])) {
    $blnn1 = $_POST['blnn1'];
    $blnn2 = $_POST['blnn2'];

    $dist = mysql_query("SELECT 
        d.*, 
        u.cNama AS Pengirim, 
        u.cIdjab AS JabatanPengirim,
        j.nama_jendok AS JenisDokumen
    FROM 
        dister d
    JOIN 
        users u ON d.dipengirim = u.cId
    LEFT JOIN 
        jendok j ON d.jenisdok = j.id_jendok
    WHERE d.ditgl BETWEEN '$blnn1' AND '$blnn2'
    ORDER BY 
        d.ditgl DESC");
} else {
    $dist = mysql_query("SELECT 
        d.*, 
        u.cNama AS Pengirim, 
        u.cIdjab AS JabatanPengirim,
        j.nama_jendok AS JenisDokumen
    FROM 
        dister d
    JOIN 
        users u ON d.dipengirim = u.cId
    LEFT JOIN 
        jendok j ON d.jenisdok = j.id_jendok
    ORDER BY 
        d.ditgl DESC");
}

$data = [];

$i = 1;
while ($s = mysql_fetch_array($dist)) {
    $cv = mysql_num_rows(mysql_query("SELECT * FROM disin WHERE suid='$s[suid]'"));
    $status = $s['distatus'] == 'N' ? 'Belum ACC/Kirim' : 'Terkirim';

    $row = [
        'No' => $i,
        'Tgl Dist' => tgl_indo1($s['ditgl']),
        'Kode' => $s['dikodok'],
        'Revisi' => $s['direv'],
        'Judul' => $s['dijudok'],
        'Pengirim' => $s['Pengirim'],
        'JabatanPengirim' => $s['JabatanPengirim'],
        'JenisDokumen' => $s['JenisDokumen'],
        'Status' => $status
    ];

    $data[] = $row;
    $i++;
}

// Panggil fungsi exportToExcel
exportToExcel('data_distribusi.xls', $data);
?>

<form method="post" action='home1.php?pages=printdister' target=_blank>
        
        <div class="control-group">
            <label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
            <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Export" />
    </form>