<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Permohonan Copy Dokumen EBR</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if(isset($_GET['act']) && $_GET['act']=="tambah"){
    // Ini mengarah ke tambahcopy_ebr.php jika di-route demikian,
    // tapi karena di home.php sudah ada tambahpermintaanebr, 
    // kita cukup beri tombol link ke sana
} else {
?>
<div>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=tambahpermintaanebr'">Buat Permohonan Copy EBR Baru</button>
    <br><br><b>Informasi</b> : Fasilitas ini berfungsi sebagai permohonan copy dokumen EBR (Electronic Batch Record).
    <br /><br />
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width=100%>
	<thead>
		<tr>
            <th width="5%">No</th>
            <th width="15%">Tanggal</th>
			<th width="20%">Pemohon</th>
			<th width="40%">Keterangan</th>
            <th class='center' width="20%">Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
        // Query disesuaikan dengan level akses. Jika admin (beberapa ID khusus), lihat semua. Jika user biasa, lihat miliknya sendiri.
        $user_id = $_SESSION['cv'];
        
	    if ($user_id == 0 OR $user_id == 1 OR $user_id == 53 OR $user_id == 1051 OR $user_id == 1054 OR $user_id == 1055 OR $user_id == 1056 OR $user_id == 1057 OR $user_id == 1058 OR $user_id == 1000) {
	        $query = mysql_query("SELECT a.*, b.cNama FROM copydok_ebr a LEFT JOIN users b ON a.opengirim = b.cId ORDER BY a.otgl DESC, a.oid DESC");
	    } else {
		    $query = mysql_query("SELECT a.*, b.cNama FROM copydok_ebr a LEFT JOIN users b ON a.opengirim = b.cId WHERE a.opengirim='$user_id' ORDER BY a.otgl DESC, a.oid DESC");
	    }
		
        $no = 1;
		while($s = mysql_fetch_array($query)) {
            $tgl_indo = tgl_indo($s['otgl']);
			
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>$tgl_indo</td>";
            echo "<td>{$s['cNama']}</td>";
            
            // Potong teks keterangan jika terlalu panjang
            $ket = strip_tags($s['oket']);
            if (strlen($ket) > 100) {
                $ket = substr($ket, 0, 100) . "...";
            }
            echo "<td>$ket</td>";
            
            echo "<td class='center'>";
            echo "<a href='?pages=detailpermintaanebr&id={$s['oid']}' class='btn btn-info btn-mini'><i class='icon-list'></i> Detail</a> ";
            // Tombol edit/hapus bisa ditambahkan jika ada fiturnya (saat ini diarahkan ke fungsi hapus di aksi_ebr.php)
            echo "<a href='include/copy_ebr/aksi_ebr.php?act=hapus&id={$s['oid']}' class='btn btn-danger btn-mini' onClick=\"return confirm('Yakin ingin menghapus permohonan ini?')\"><i class='icon-trash'></i> Hapus</a>";
            echo "</td>";
            echo "</tr>";
            $no++;
		}
	?>
	</tbody>
	</table>
</div>
<?php } ?>
</div>
</div>
