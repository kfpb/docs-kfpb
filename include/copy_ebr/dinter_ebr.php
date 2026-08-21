<div class="navbar navbar-inner block-header">
    <div class="muted pull-left">Daftar Permintaan Copy Batch Record</div>
</div>
<div class="block-content collapse in">
    <div class="span12">
        <?php
        $acak = rand(1, 99);
        $acak2 = rand(1, 99);
        $bln = date("m/Y");
        $thn = date("Y");
        $tgl = date("d-M-Y");
        $tgl1 = date("Y-m-d");

        $query = "SELECT max(dinmr) as max_no FROM dinter WHERE dinmr LIKE '%$thn%'";
        $hasil = mysql_query($query);
        $hitung = mysql_num_rows($hasil);
        $data = mysql_fetch_array($hasil);
        $idMax = $data['max_no'];
        $noUrut = (int) substr($idMax, 3, 4);
        $noUrut++;
        $newID = sprintf("DD-%04s/$bln", $noUrut);

        // Fungsi untuk format tanggal Indonesia
        function formatTanggalIndonesia($tanggal) {
            $bulan = [
                1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
        ?>

        <div class="span12">
          <?php  if(in_array($_SESSION['cv'], [0, 1, 51, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057, 71, 78, 76, 72])){ ?>
            <button class="btn-info btn-large" onclick="window.location.href='?pages=tambahpermintaanebr'">Tambah Permintaan</button><br /><br />
            <?php } ?>
    <?php
    if (
        $_SESSION['cv'] == '1' || $_SESSION['cv'] == '53' || $_SESSION['cv'] == '1051' ||
        $_SESSION['cv'] == '1054' || $_SESSION['cv'] == '1055' || $_SESSION['cv'] == '1056' ||
        $_SESSION['cv'] == '1057' || $_SESSION['cv'] == '1058' || $_SESSION['cv'] == '1000' || 
        $_SESSION['cv'] == '22' || $_SESSION['cv'] == '3' || $_SESSION['cv'] == '50' ||
        
        // Tambahan untuk Sisdok
        $_SESSION['cv'] == '1052' || $_SESSION['cv'] == '1059' ||
    
        // Tambahan untuk Pengdok
        $_SESSION['cv'] == '1003' || $_SESSION['cv'] == '1061' || $_SESSION['cv'] == '1062' || $_SESSION['cv'] == '1063' ||
    
        // Tambahan untuk Produksi
        $_SESSION['cv'] == '92' || $_SESSION['cv'] == '90' || $_SESSION['cv'] == '74' || $_SESSION['cv'] == '71' || 
        $_SESSION['cv'] == '35' || $_SESSION['cv'] == '27' || $_SESSION['cv'] == '26' || $_SESSION['cv'] == '38' || 
        $_SESSION['cv'] == '39' || $_SESSION['cv'] == '40' || $_SESSION['cv'] == '30' || $_SESSION['cv'] == '36' || 
    
        // Tambahan untuk Pendukung Teknis
        $_SESSION['cv'] == '46' || $_SESSION['cv'] == '49' || $_SESSION['cv'] == '48' || 
        $_SESSION['cv'] == '47' || $_SESSION['cv'] == '59' ||
    
        // Tambahan untuk PPC
        $_SESSION['cv'] == '72' || $_SESSION['cv'] == '78' || $_SESSION['cv'] == '76' ||
    
        // Tambahan untuk Manager
        $_SESSION['cv'] == '2' 
    ) {
        // Jika user memiliki hak akses khusus, tampilkan semua data
        $query_pembuat = "
            SELECT pdb.*, NULL as sudah_dilihat, NULL as user_id
            FROM permintaan_dokumen_batch pdb
            ORDER BY pdb.dibuat_pada DESC, pdb.id_permintaan ASC
        ";
        $result_pembuat = mysql_query($query_pembuat) or die(mysql_error());
    } else {
        // Query untuk user pembuat
        $query_pembuat = "
            SELECT pdb.*, NULL as sudah_dilihat, NULL as user_id
            FROM permintaan_dokumen_batch pdb
            WHERE pdb.peminta = '$_SESSION[cv]'
            ORDER BY pdb.dibuat_pada DESC, pdb.id_permintaan ASC
        ";
        $result_pembuat = mysql_query($query_pembuat) or die(mysql_error());

        // Query untuk user penerima notifikasi
        $query_notif = "
            SELECT DISTINCT pdb.*, ns.sudah_dilihat, ns.user_id
            FROM permintaan_dokumen_batch pdb
            INNER JOIN notifikasi_status_permintaan_bets ns 
            ON pdb.id_permintaan = ns.id_permintaan
            WHERE ns.user_id = '$_SESSION[cv]'
            ORDER BY pdb.dibuat_pada DESC, pdb.id_permintaan ASC
        ";
        $result_notif = mysql_query($query_notif) or die(mysql_error());
    }

    // Gabungkan hasil query
    $data = [];

    // Tambahkan data dari user pembuat
    if (isset($result_pembuat)) {
        while ($row = mysql_fetch_assoc($result_pembuat)) {
            $data[$row['id_permintaan']] = $row;
        }
    }

    // Tambahkan data dari user penerima notifikasi
    if (isset($result_notif)) {
        while ($row = mysql_fetch_assoc($result_notif)) {
            $data[$row['id_permintaan']] = $row;
        }
    }

    // Ubah ke array numerik untuk iterasi
    $data = array_values($data);
    ?>
    
<form method="get" action="home1.php" class="form-inline" target="_blank">
    <input type="hidden" name="pages" value="export_permintaan_ebr">
    <label>Dari Tanggal:</label>
    <input type="date" name="dari" required>
    
    <label>Sampai Tanggal:</label>
    <input type="date" name="sampai" required>
    
    <label>Jenis Dokumen:</label>
    <select name="jenis_dokumen">
        <option value="">Semua</option>
        <?php
        // Mengambil data jenis_dokumen yang unik dari database agar dinamis
        $query_jenis = mysql_query("SELECT DISTINCT jenis_dokumen FROM permintaan_dokumen_batch WHERE jenis_dokumen IS NOT NULL AND jenis_dokumen != '' ORDER BY jenis_dokumen ASC");
        while ($row_jenis = mysql_fetch_array($query_jenis)) {
            echo "<option value='" . $row_jenis['jenis_dokumen'] . "'>" . $row_jenis['jenis_dokumen'] . "</option>";
        }
        ?>
    </select>

    <button type="submit" class="btn btn-success">
        <i class="icon-download-alt"></i> Export Excel
    </button>
</form>

<br>

    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
        <thead>
            <tr>
                <th>No</th>
                <th>No Batch</th>
                <th>Nama Produk</th>
                <th>Besar Bets</th>
                <th>Jenis Dokumen</th>
                <th>Tanggal Permintaan</th>
                <th>Catatan</th>
                <th>Status</th>
                <th class='center' width=25%>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            $no = 1;

            foreach ($data as $s) {
                // Tentukan gaya baris berdasarkan status notifikasi
                $row_style = '';
            
                // Format tanggal permintaan
                $tanggal_permintaan = formatTanggalIndonesia($s['dibuat_pada']);

                // Tentukan label status
                $status_label = ($s['status'] == 'diminta') 
                    ? "<span class='label label-warning'>Diminta</span>" 
                    : "<span class='label label-success'>Dicetak</span>";

                // Tampilkan baris tabel
                // echo "<tr $row_style>";
                if ($s['sudah_dilihat'] === 'N' && $s['user_id'] == $_SESSION['cv']) {
                    echo "<tr class='success'>";
                } else {
                    echo "<tr>";
                }

                echo "
                    <td>$no</td>
                    <td>{$s['nomor_batch']}</td>
                    <td>{$s['nama_produk']}</td>
                    <td>{$s['besaran_bets']}</td>
                    <td>{$s['jenis_dokumen']}</td>
                    <td>$tanggal_permintaan</td>
                    <td>{$s['catatan']}</td>
                    <td>$status_label</td>
                    <td class='center'>
                        <a href='?pages=detailpermintaanebr&kodedokumen={$s['dikodok']}&permintaanId={$s['id_permintaan']}' class='btn-small btn-info'>
                            <i class='icon-edit'></i> Detail
                        </a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>


        </div>
    </div>
</div></div>