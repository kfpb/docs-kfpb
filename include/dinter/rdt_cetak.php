<?php
// =============================================================================
// ==      SCRIPT EKSPOR DATA REGISTRASI DOKUMEN TERKENDALI KE EXCEL         ==
// =============================================================================

// 1. PENGATURAN HEADER HTTP
// Baris-baris ini harus dieksekusi sebelum ada output lain (HTML, spasi, dll.)
// -----------------------------------------------------------------------------

// Menentukan nama file yang akan diunduh, dengan tambahan tanggal
$filename = "Registrasi_Dokumen_Terkendali_" . date('d-m-Y') . ".xls";

// Mengirim header ke browser untuk memberitahu bahwa ini adalah file Excel
header("Content-Type: application/vnd.ms-excel");

// Mengirim header untuk memicu dialog "Save As" dengan nama file yang sudah ditentukan
header("Content-Disposition: attachment; filename=\"$filename\"");


// 2. KONEKSI DATABASE
// Ganti nilai di bawah ini dengan kredensial database Anda.
// -----------------------------------------------------------------------------
$host = "localhost";    // Biasanya "localhost"
$user = "sql_docs_kfpb_ki";         // Username database Anda
$pass = "4Bsri2BHcfjhNSPp";             // Password database Anda
$db   = "sql_docs_kfpb_ki"; // Nama database Anda

$koneksi = mysql_connect($host, $user, $pass);
if (!$koneksi) {
    die("Tidak bisa terhubung ke server database.");
}

$pilih_db = mysql_select_db($db, $koneksi);
if (!$pilih_db) {
    die("Database '" . $db . "' tidak ditemukan.");
}

// =============================================================================
// == PERINGATAN PENTING: PENGGUNAAN FUNGSI `mysql_*`                           ==
// == Ekstensi `mysql_*` sudah usang (DEPRECATED) sejak PHP 5.5 dan telah      ==
// == dihapus total di PHP 7.0 ke atas. Kode ini tidak aman dari SQL          ==
// == Injection. Sangat disarankan untuk beralih menggunakan `MySQLi` atau `PDO`. ==
// =============================================================================


// 3. FUNGSI BANTUAN (HELPER FUNCTION)
// Fungsi untuk mengubah format tanggal dari YYYY-MM-DD menjadi DD-MM-YYYY
// -----------------------------------------------------------------------------
function tgl_indo2($tanggal_mysql) {
    // Periksa jika tanggal valid (tidak null, kosong, atau '0000-00-00')
    if ($tanggal_mysql && $tanggal_mysql != '0000-00-00' && $tanggal_mysql != '0000-00-00 00:00:00') {
        // Ubah string tanggal menjadi timestamp, lalu format ulang
        return date('d-m-Y', strtotime($tanggal_mysql));
    } else {
        // Jika tidak valid, kembalikan strip agar rapi di tabel
        return '-';
    }
}


// 4. PROSES PENGAMBILAN DATA
// Query sama persis dengan yang ada di halaman utama Anda.
// -----------------------------------------------------------------------------
$query = "SELECT * FROM dinter ORDER BY dikodok ASC";
$dist = mysql_query($query, $koneksi);

if (!$dist) {
    die("Query gagal dijalankan: " . mysql_error());
}

?>
<style>
    /* Style sederhana untuk judul */
    .judul {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }
    /* Style untuk table header */
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    /* Style untuk border tabel */
    table, th, td {
        border: 1px solid #000;
        border-collapse: collapse;
        padding: 5px;
    }
</style>

<div class="judul">
    REGISTRASI DOKUMEN TERKENDALI
</div>
<br>

<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Kode_Dok</th>
			<th>Judul_Dokumen</th>
			<th>Tgl_R0</th>
			<th>Tgl_R1</th>
			<th>Tgl_R2</th>
			<th>Tgl_R3</th>
			<th>Tgl_R4</th>
			<th>Tgl_R5</th>
			<th>Tgl_R6</th>
			<th>Tgl_R7</th>
			<th>Tgl_R8</th>
			<th>Tgl_R9</th>
			<th>Tgl_R10</th>
			<th>Tgl_R11</th>
			<th>Tgl_R12</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		// Loop untuk menampilkan setiap baris data
		while($s = mysql_fetch_array($dist)) {
            // Memanggil fungsi `tgl_indo2` untuk setiap kolom tanggal
            $tgl_rev0  = tgl_indo2($s['ditgl_rev0']);
            $tgl_rev1  = tgl_indo2($s['ditgl_rev1']);
            $tgl_rev2  = tgl_indo2($s['ditgl_rev2']);
            $tgl_rev3  = tgl_indo2($s['ditgl_rev3']);      
            $tgl_rev4  = tgl_indo2($s['ditgl_rev4']);      
            $tgl_rev5  = tgl_indo2($s['ditgl_rev5']);
            $tgl_rev6  = tgl_indo2($s['ditgl_rev6']);  
            $tgl_rev7  = tgl_indo2($s['ditgl_rev7']);   
            $tgl_rev8  = tgl_indo2($s['ditgl_rev8']);     
            $tgl_rev9  = tgl_indo2($s['ditgl_rev9']);  
            $tgl_rev10 = tgl_indo2($s['ditgl_rev10']);
            $tgl_rev11 = tgl_indo2($s['ditgl_rev11']);  
            $tgl_rev12 = tgl_indo2($s['ditgl_rev12']);  

            // Menulis baris tabel (<tr>) untuk setiap record
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            // `mysql_real_escape_string` digunakan untuk keamanan dasar, meski tidak seaman prepared statements
            // Dalam konteks ekspor ini, mungkin tidak krusial, tapi ini kebiasaan yang baik.
            // Namun, karena hanya menampilkan, kita bisa langsung echo.
            echo "<td>" . $s['dikodok'] . "</td>";
            echo "<td>" . $s['dijudok'] . "</td>";
            echo "<td>" . $tgl_rev0 . "</td>";
            echo "<td>" . $tgl_rev1 . "</td>";
            echo "<td>" . $tgl_rev2 . "</td>";
            echo "<td>" . $tgl_rev3 . "</td>";				
            echo "<td>" . $tgl_rev4 . "</td>";				
            echo "<td>" . $tgl_rev5 . "</td>";				
            echo "<td>" . $tgl_rev6 . "</td>";				
            echo "<td>" . $tgl_rev7 . "</td>";
            echo "<td>" . $tgl_rev8 . "</td>";
            echo "<td>" . $tgl_rev9 . "</td>";
            echo "<td>" . $tgl_rev10 . "</td>";
            echo "<td>" . $tgl_rev11 . "</td>";
            echo "<td>" . $tgl_rev12 . "</td>";
            echo "</tr>";

            $no++;
		}
		?>
	</tbody>
</table>

<br><br>
<p>
    <strong>Keterangan :</strong><br>
    Dokumen Level 1 : Manual Mutu<br>
    Dokumen Level 2 : Prosedur<br>
    Dokumen Level 3 : Instruksi Kerja<br>
    Dokumen Level 4 : Catatan/Dokumen Mutu<br>
</p>

<?php
// Menutup koneksi database setelah selesai
mysql_close($koneksi);
?>