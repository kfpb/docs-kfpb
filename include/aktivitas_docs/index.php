<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Riwayat Audit Dokumen</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
// Tangkap parameter filter dari Request (GET / POST)
$tgl_awal  = isset($_REQUEST['tgl_awal']) ? trim($_REQUEST['tgl_awal']) : '';
$tgl_akhir = isset($_REQUEST['tgl_akhir']) ? trim($_REQUEST['tgl_akhir']) : '';
$f_action  = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : '';
$f_user    = isset($_REQUEST['user']) ? trim($_REQUEST['user']) : '';
$f_keyword = isset($_REQUEST['keyword']) ? trim($_REQUEST['keyword']) : '';

// Bangun query WHERE dinamis
$where_clauses = array("hide_data = 0");

if (!empty($tgl_awal)) {
    $safe_tgl_awal = mysql_real_escape_string($tgl_awal);
    $where_clauses[] = "created_at >= '$safe_tgl_awal 00:00:00'";
}
if (!empty($tgl_akhir)) {
    $safe_tgl_akhir = mysql_real_escape_string($tgl_akhir);
    $where_clauses[] = "created_at <= '$safe_tgl_akhir 23:59:59'";
}
if (!empty($f_action)) {
    $safe_action = mysql_real_escape_string($f_action);
    $where_clauses[] = "action = '$safe_action'";
}
if (!empty($f_user)) {
    $safe_user = mysql_real_escape_string($f_user);
    $where_clauses[] = "user = '$safe_user'";
}
if (!empty($f_keyword)) {
    $safe_keyword = mysql_real_escape_string($f_keyword);
    $where_clauses[] = "(dokumen LIKE '%$safe_keyword%' OR kode_dokumen LIKE '%$safe_keyword%' OR deskripsi LIKE '%$safe_keyword%' OR jabatan LIKE '%$safe_keyword%')";
}

$where_sql = implode(" AND ", $where_clauses);
$query_sql = "SELECT * FROM aktivitas_dokumen WHERE $where_sql ORDER BY created_at DESC";
$udmasuk = mysql_query($query_sql);

// Query distinct user untuk filter dropdown
$q_users = mysql_query("SELECT DISTINCT user FROM aktivitas_dokumen WHERE user != '' AND user != '-' ORDER BY user ASC");
?>

	<!-- Form Filter Data Audit Trail -->
	<div class="well well-small" style="background-color: #fcfcfc; border: 1px solid #e3e3e3; padding: 15px; margin-bottom: 20px;">
		<form method="GET" action="home.php" class="form-inline" style="margin-bottom: 0;">
			<input type="hidden" name="pages" value="aktivitas_dokumen">
			
			<div class="row-fluid" style="margin-bottom: 10px;">
				<div class="span3">
					<label style="font-weight: bold; display: block;">Tanggal Mulai:</label>
					<input type="date" name="tgl_awal" class="input-block-level" value="<?php echo htmlspecialchars($tgl_awal); ?>">
				</div>
				<div class="span3">
					<label style="font-weight: bold; display: block;">Tanggal Akhir:</label>
					<input type="date" name="tgl_akhir" class="input-block-level" value="<?php echo htmlspecialchars($tgl_akhir); ?>">
				</div>
				<div class="span3">
					<label style="font-weight: bold; display: block;">Jenis Action:</label>
					<select name="action" class="input-block-level">
						<option value="">-- Semua Action --</option>
						<option value="create" <?php if($f_action=='create') echo 'selected'; ?>>create (Tambah/Buat)</option>
						<option value="update" <?php if($f_action=='update') echo 'selected'; ?>>update (Ubah/Edit)</option>
						<option value="delete" <?php if($f_action=='delete') echo 'selected'; ?>>delete (Hapus)</option>
						<option value="approve" <?php if($f_action=='approve') echo 'selected'; ?>>approve (Setujui/Terima)</option>
						<option value="reject" <?php if($f_action=='reject') echo 'selected'; ?>>reject (Kembalikan/Tolak)</option>
						<option value="read" <?php if($f_action=='read') echo 'selected'; ?>>read (Membaca/Lihat)</option>
						<option value="print" <?php if($f_action=='print') echo 'selected'; ?>>print (Cetak)</option>
					</select>
				</div>
				<div class="span3">
					<label style="font-weight: bold; display: block;">User / Pengguna:</label>
					<select name="user" class="input-block-level">
						<option value="">-- Semua User --</option>
						<?php
						while($u = mysql_fetch_array($q_users)){
							$selected = ($f_user == $u['user']) ? 'selected' : '';
							echo "<option value='".htmlspecialchars($u['user'])."' $selected>".htmlspecialchars($u['user'])."</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<label style="font-weight: bold; display: block;">Pencarian Kata Kunci / Dokumen:</label>
					<input type="text" name="keyword" class="input-block-level" placeholder="Cari judul dokumen, kode dokumen, jabatan, deskripsi..." value="<?php echo htmlspecialchars($f_keyword); ?>">
				</div>
				<div class="span6" style="padding-top: 24px;">
					<button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Filter Data</button>
					<a href="home.php?pages=aktivitas_dokumen" class="btn"><i class="icon-refresh"></i> Reset</a>
					
					<!-- Tombol Export Excel membawa parameter filter saat ini -->
					<?php
					$export_url = "home1.php?pages=printaktivitas&tgl_awal=".urlencode($tgl_awal)."&tgl_akhir=".urlencode($tgl_akhir)."&action=".urlencode($f_action)."&user=".urlencode($f_user)."&keyword=".urlencode($f_keyword);
					?>
					<a href="<?php echo $export_url; ?>" target="_blank" class="btn btn-success pull-right"><i class="icon-download-alt icon-white"></i> Export Excel</a>
				</div>
			</div>
		</form>
	</div>

	<?php
	// Indikator filter aktif
	$filter_active = (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($f_action) || !empty($f_user) || !empty($f_keyword));
	if ($filter_active) {
		$count_rows = mysql_num_rows($udmasuk);
		echo "<div class='alert alert-info' style='margin-bottom: 15px;'>
				<i class='icon-filter'></i> <strong>Filter Aktif:</strong> Menampilkan <strong>$count_rows</strong> data sesuai kriteria pencarian.
			  </div>";
	}
	?>

	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th style="display: none;"></th>
			<th width="4%">No</th>
			<th width="18%">Dokumen</th>
			<th width="12%">Kode Dokumen</th>
			<th width="12%">User</th>
			<th width="12%">Jabatan</th>
			<th width="8%">Action</th>
			<th width="20%">Deskripsi</th>
			<th width="14%">Tanggal & Waktu</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	while($s = mysql_fetch_array($udmasuk)) {
		// Warna label badge action
		$badge_class = "label";
		if($s['action'] == 'create') $badge_class = "label label-success";
		elseif($s['action'] == 'update') $badge_class = "label label-info";
		elseif($s['action'] == 'delete' || $s['action'] == 'delete all') $badge_class = "label label-important";
		elseif($s['action'] == 'approve') $badge_class = "label label-primary";
		elseif($s['action'] == 'reject') $badge_class = "label label-warning";
		elseif($s['action'] == 'print') $badge_class = "label label-inverse";
		?>
		<tr>
			<td style='display: none;'></td>
			<td><?php echo $i; ?></td>
			<td><strong><?php echo htmlspecialchars($s['dokumen']); ?></strong></td>
			<td><?php echo htmlspecialchars($s['kode_dokumen']); ?></td>
			<td><?php echo htmlspecialchars($s['user']); ?></td>
			<td><?php echo htmlspecialchars($s['jabatan']); ?></td>
			<td><span class="<?php echo $badge_class; ?>"><?php echo htmlspecialchars($s['action']); ?></span></td>
			<td><?php echo htmlspecialchars($s['deskripsi']); ?></td>
			<td><?php echo tgl_indojam($s['created_at']); ?></td>
		</tr> 
	<?php
		$i++;
	}
	?>
	</tbody>
	</table>

</div>
</div>

</div><!--/span12-->

</div><!--/block-content-->
