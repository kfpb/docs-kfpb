<?php
// Ensure schema matches what's needed for the full workflow
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN kirim_status VARCHAR(10) DEFAULT 'N'");
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN sstatus VARCHAR(10) DEFAULT 'N'");
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN tgl_kirimajuan DATE DEFAULT NULL");
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN otgl_admin DATE DEFAULT '0000-00-00'");
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN otgl_slesai DATE DEFAULT '0000-00-00'");
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN okepada INT(11) DEFAULT 2");
@mysql_query("ALTER TABLE copydok_ebr ADD COLUMN onmr VARCHAR(50) DEFAULT NULL");
?>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Permohonan Copy Dokumen EBR</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if(isset($_GET['act']) && $_GET['act']=="tambah"){
} else {
?>
<div>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=tambahpermintaanebr'">Buat Permohonan Copy EBR Baru</button>
    <br><br><b>Informasi</b> : Fasilitas ini berfungsi sebagai permohonan copy dokumen EBR (Electronic Batch Record).
    <br /><br />
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width=100%>
	<thead>
		<tr>
            <th></th>
            <th>Tanggal</th>
		    <th>Tanggal Kirim Usulan</th>
			<th>Pemohon</th>
			<th>Jenis Copy</th>
			<th>Tgl Baca SPD</th>
			<th>Tgl Selesai SPD</th>
			<th>Status</th>
            <th class='center' width=14%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
        $user_id = $_SESSION['cv'];
        
	    if ($user_id == 0 OR $user_id == 1 OR $user_id == 53 OR $user_id == 1051 OR $user_id == 1054 OR $user_id == 1055 OR $user_id == 1056 OR $user_id == 1057 OR $user_id == 1058 OR $user_id == 1000) {
	        $query = mysql_query("SELECT a.*, b.cNama FROM copydok_ebr a LEFT JOIN users b ON a.opengirim = b.cId WHERE a.kirim_status='Y' OR a.kirim_status IS NULL ORDER BY a.otgl DESC");
	    } else {
		    $query = mysql_query("SELECT a.*, b.cNama FROM copydok_ebr a LEFT JOIN users b ON a.opengirim = b.cId WHERE a.opengirim='$user_id' OR a.okepada='$user_id' ORDER BY a.otgl DESC");
	    }
		
        if (!$query) {
            echo "<tr><td colspan='9'>Error Database: " . mysql_error() . " (Pastikan Anda sudah klik Buat Permohonan minimal sekali jika tabel belum ada)</td></tr>";
        } else {
            while($s = mysql_fetch_array($query)) {
                $jenis = "<span class='label label-important'>Batch Record</span>";
                
                if (isset($s['sstatus']) && $s['sstatus'] == 'N') {
                    echo "<tr class='success'>";
                } else {
                    echo "<tr>";
                }
                
                $status_simbol = isset($s['sstatus']) ? $s['sstatus'] : '';
                $tgl_kirim = isset($s['tgl_kirimajuan']) && $s['tgl_kirimajuan'] ? tgl_indo($s['tgl_kirimajuan']) : '-';
                $tgl_baca = isset($s['otgl_admin']) && $s['otgl_admin'] != '0000-00-00' ? tgl_indo1($s['otgl_admin']) : '-';
                $tgl_selesai = isset($s['otgl_slesai']) && $s['otgl_slesai'] != '0000-00-00' ? tgl_indo1($s['otgl_slesai']) : '-';
                $kirim_status = isset($s['kirim_status']) ? $s['kirim_status'] : 'N';
                
                echo "<td>$status_simbol</td>";
                echo "<td>" . tgl_indo($s['otgl']) . "</td>";
                echo "<td>$tgl_kirim</td>";
                echo "<td>{$s['cNama']}</td>";
                echo "<td>$jenis</td>";
                echo "<td>$tgl_baca</td>";
                echo "<td>$tgl_selesai</td>";
                
                if ($status_simbol == 'N' || $status_simbol == '') {
                    if (isset($s['okepada']) && $s['okepada'] == $user_id OR $user_id == 0 OR $user_id == 1 OR $user_id == 53 OR $user_id == 1051 OR $user_id == 1054 OR $user_id == 1055 OR $user_id == 1056 OR $user_id == 1057 OR $user_id == 1058 OR $user_id == 1000) {
                        echo "<td><a href='include/copy_ebr/aksi_ebr.php?act=acc&id={$s['oid']}' class='btn btn-info' onClick=\"return confirm('Yakin ACC/Selesai Permohonan Copy EBR?')\">Selesai</a></td>";
                    } elseif ($kirim_status == 'N') {
                        echo "<td><a href='include/copy_ebr/aksi_ebr.php?act=kirim_permohonan&id={$s['oid']}' class='btn btn-info' onClick=\"return confirm('Yakin Akan Mengirimkan Permohonan Copy EBR?')\">Kirim Permintaan</a></td>";
                    } else {
                        echo "<td><b>Belum Selesai</b></td>";
                    }
                } else {
                    echo "<td>Telah Selesai</td>";
                }
                
                if ($kirim_status == 'N' || $kirim_status == null) {
                    echo "<td class='center'>
                            <a href='include/copy_ebr/aksi_ebr.php?act=hapus&id={$s['oid']}' onClick=\"return confirm('Yakin hapus data ini?')\"><i class='icon-trash'></i></a>
                            <a href='?pages=detailpermintaanebr&id={$s['oid']}' class='btn btn-info'>Detail</a>
                          </td>";
                } else {
                    echo "<td><a href='?pages=detailpermintaanebr&id={$s['oid']}' class='btn btn-info'>Detail</a></td>";
                }
                
                echo "</tr>";
            }
        }
	?>
	</tbody>
	</table>
    <br><br>
	<span class="label label-info">
	<h5>Baris tabel Berwarna HIJAU = <strong>Permohonan Copy Dokumen EBR SELESAI</strong></h5>
	</span>
</div>
<?php } ?>
</div>
</div>
