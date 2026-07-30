<?php
// File: include/duin/duin_belumcc.php
// Menampilkan semua usulan dokumen yang belum dikirim ke CC (ccstatus='N')
// Hanya untuk admin bagian Sistem Dokumentasi
?>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Semua Usulan Dokumen Masuk</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
$udmasuk = mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan 
                         FROM udokumen a 
                         LEFT JOIN users b ON a.udpengusul2 = b.cId 
                         ORDER BY a.udtgl DESC");
$jml = mysql_num_rows($udmasuk);
?>

<legend>Semua Usulan Dokumen (<?php echo $jml; ?> data)</legend>

<table class="table table-striped table-bordered table-condensed" id="example_belumcc">
<thead>
<tr>
	<th>No</th>
	<th>Tanggal</th>
	<th>Pengusul</th>
	<th>Jabatan</th>
	<th>Jenis Usulan</th>
	<th>Kode Dok</th>
	<th>Judul Dok</th>
	<th>Nomor CC</th>
	<th>Status</th>
</tr>
</thead>
<tbody>
<?php
$no = 1;
while ($r = mysql_fetch_array($udmasuk)){
	if($r['jenisud'] == 1){
		$jenisud = "Usulan Pembuatan Dok Baru";
	} elseif($r['jenisud'] == 2){
		$jenisud = "Usulan Perubahan Dok";
	} elseif($r['jenisud'] == 3){
		$jenisud = "Usulan Penghapusan Dok";
	} else {
		$jenisud = "-";
	}
	echo "<tr>
		<td>$no</td>
		<td>$r[udtgl]</td>
		<td>$r[cNama]</td>
		<td>$r[cJabatan]</td>
		<td>$jenisud</td>
		<td>$r[ukodok]</td>
		<td>$r[ujudok]</td>
		<td>$r[uccnmr]</td>
		<td><span class='label label-warning'>Belum Kirim CC</span></td>
	</tr>";
	$no++;
}
?>
</tbody>
</table>

<script>
$(document).ready(function(){
	$('#example_belumcc').dataTable({
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bAutoWidth": true
	});
});
</script>

</div>
</div>
