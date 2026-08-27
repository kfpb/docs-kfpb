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

// Parameter Pagination
$page   = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit  = isset($_GET['limit']) ? max(10, min(500, (int)$_GET['limit'])) : 50; // default 50 baris per halaman
$offset = ($page - 1) * $limit;

// Pre-fetch mapping user ID (cId) ke Nama User (cNama) untuk lookup instan
$user_map = array();
$user_name_to_id = array();
$q_users_all = mysql_query("SELECT cId, cNama FROM users WHERE cNama != ''");
if ($q_users_all) {
    while ($ur = mysql_fetch_array($q_users_all)) {
        $user_map[$ur['cId']] = $ur['cNama'];
        $user_map[(string)$ur['cId']] = $ur['cNama'];
        $user_name_to_id[$ur['cNama']] = $ur['cId'];
    }
}

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
    if (isset($user_name_to_id[$f_user])) {
        $user_cid = (int)$user_name_to_id[$f_user];
        $where_clauses[] = "(user = '$safe_user' OR user = '$user_cid')";
    } else {
        $where_clauses[] = "user = '$safe_user'";
    }
}
if (!empty($f_keyword)) {
    $safe_keyword = mysql_real_escape_string($f_keyword);
    $where_clauses[] = "(dokumen LIKE '%$safe_keyword%' OR kode_dokumen LIKE '%$safe_keyword%' OR deskripsi LIKE '%$safe_keyword%' OR jabatan LIKE '%$safe_keyword%')";
}

$where_sql = implode(" AND ", $where_clauses);

// 1. Hitung total data untuk pagination (Cepat)
$count_query = mysql_query("SELECT COUNT(*) as total FROM aktivitas_dokumen WHERE $where_sql");
$count_row   = mysql_fetch_array($count_query);
$total_rows  = (int)$count_row['total'];
$total_pages = max(1, ceil($total_rows / $limit));

// Pastikan halaman tidak melebihi total halaman
if ($page > $total_pages) {
    $page = $total_pages;
    $offset = ($page - 1) * $limit;
}

// 2. Query data dengan LIMIT dan OFFSET (Hanya ambil kolom yang ditampilkan agar sangat ringan)
$query_sql = "SELECT dokumen, kode_dokumen, user, jabatan, action, deskripsi, created_at FROM aktivitas_dokumen WHERE $where_sql ORDER BY created_at DESC LIMIT $offset, $limit";
$udmasuk   = mysql_query($query_sql);

// Query user dari tabel users untuk filter dropdown
$q_users = mysql_query("SELECT DISTINCT cNama FROM users WHERE cNama != '' ORDER BY cNama ASC");

// Helper untuk generate URL pagination dengan tetap mempertahankan filter
function build_page_url($p, $lim, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) {
    $params = array(
        'pages'     => 'aktivitas_dokumen',
        'page'      => $p,
        'limit'     => $lim,
        'tgl_awal'  => $tgl_awal,
        'tgl_akhir' => $tgl_akhir,
        'action'    => $f_action,
        'user'      => $f_user,
        'keyword'   => $f_keyword
    );
    return 'home.php?' . http_build_query($params);
}
?>

	<!-- Form Filter Data Audit Trail -->
	<div class="well well-small" style="background-color: #fcfcfc; border: 1px solid #e3e3e3; padding: 15px; margin-bottom: 15px;">
		<form method="GET" action="home.php" class="form-inline" style="margin-bottom: 0;">
			<input type="hidden" name="pages" value="aktivitas_dokumen">
			<input type="hidden" name="limit" value="<?php echo $limit; ?>">
			
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
							$selected = ($f_user == $u['cNama']) ? 'selected' : '';
							echo "<option value='".htmlspecialchars($u['cNama'])."' $selected>".htmlspecialchars($u['cNama'])."</option>";
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

	<!-- Baris Info & Limit Paging -->
	<div class="row-fluid" style="margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
		<div class="span6">
			<?php
			$start_record = ($total_rows > 0) ? ($offset + 1) : 0;
			$end_record   = min($offset + $limit, $total_rows);
			?>
			<span style="font-size: 13px; color: #555;">
				Menampilkan data ke-<strong><?php echo number_format($start_record); ?></strong> s/d <strong><?php echo number_format($end_record); ?></strong> dari <strong><?php echo number_format($total_rows); ?></strong> total data
				<?php if ($total_pages > 1) echo "(Halaman $page dari $total_pages)"; ?>
			</span>
		</div>
		<div class="span6 text-right" style="text-align: right;">
			<form method="GET" action="home.php" style="margin: 0; display: inline-block;">
				<input type="hidden" name="pages" value="aktivitas_dokumen">
				<input type="hidden" name="page" value="1">
				<input type="hidden" name="tgl_awal" value="<?php echo htmlspecialchars($tgl_awal); ?>">
				<input type="hidden" name="tgl_akhir" value="<?php echo htmlspecialchars($tgl_akhir); ?>">
				<input type="hidden" name="action" value="<?php echo htmlspecialchars($f_action); ?>">
				<input type="hidden" name="user" value="<?php echo htmlspecialchars($f_user); ?>">
				<input type="hidden" name="keyword" value="<?php echo htmlspecialchars($f_keyword); ?>">
				<label style="display: inline-block; font-size: 12px; margin-right: 5px;">Tampilkan per halaman:</label>
				<select name="limit" onchange="this.form.submit()" style="width: 80px; margin-bottom: 0;">
					<option value="25" <?php if($limit==25) echo 'selected'; ?>>25</option>
					<option value="50" <?php if($limit==50) echo 'selected'; ?>>50</option>
					<option value="100" <?php if($limit==100) echo 'selected'; ?>>100</option>
					<option value="250" <?php if($limit==250) echo 'selected'; ?>>250</option>
				</select>
			</form>
		</div>
	</div>

	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="100%">
	<thead>
		<tr style="background-color: #f7f7f7;">
			<th width="4%">No</th>
			<th width="18%">Dokumen</th>
			<th width="12%">Kode Dokumen</th>
			<th width="13%">User</th>
			<th width="12%">Jabatan</th>
			<th width="8%">Action</th>
			<th width="20%">Deskripsi</th>
			<th width="13%">Tanggal & Waktu</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($total_rows == 0) {
		echo "<tr><td colspan='8' class='text-center' style='text-align: center; padding: 30px; color: #888;'>Tidak ada data aktivitas dokumen yang ditemukan.</td></tr>";
	} else {
		$i = $offset + 1;
		while($s = mysql_fetch_array($udmasuk)) {
			// 1. Format label badge action
			$badge_class = "label";
			if($s['action'] == 'create') $badge_class = "label label-success";
			elseif($s['action'] == 'update') $badge_class = "label label-info";
			elseif($s['action'] == 'delete' || $s['action'] == 'delete all') $badge_class = "label label-important";
			elseif($s['action'] == 'approve') $badge_class = "label label-primary";
			elseif($s['action'] == 'reject') $badge_class = "label label-warning";
			elseif($s['action'] == 'print') $badge_class = "label label-inverse";

			// 2. Fallback jika user atau jabatan kosong (jika user berupa ID, resolve ke Nama Pengguna)
			$user_raw = trim($s['user']);
			if (is_numeric($user_raw) && isset($user_map[$user_raw])) {
				$nama_user_tampil = $user_map[$user_raw];
			} elseif (!empty($user_raw) && $user_raw != '-') {
				$nama_user_tampil = $user_raw;
			} else {
				$nama_user_tampil = '';
			}
			$tampil_user = !empty($nama_user_tampil) ? htmlspecialchars($nama_user_tampil) : "<span class='muted' style='color:#999;'><i>(Tidak tercatat)</i></span>";
			$tampil_jabatan = !empty($s['jabatan']) && $s['jabatan'] != '-' ? htmlspecialchars($s['jabatan']) : "<span class='muted' style='color:#999;'>-</span>";

			// 3. Fallback jika nama dokumen kosong atau hanya bertuliskan 'Dokumen '
			$dok_raw = trim($s['dokumen']);
			if (empty($dok_raw) || $dok_raw == 'Dokumen' || $dok_raw == '-') {
				if (!empty($s['kode_dokumen']) && $s['kode_dokumen'] != '-') {
					$tampil_dokumen = "<strong>" . htmlspecialchars($s['kode_dokumen']) . "</strong>";
				} else {
					$tampil_dokumen = "<span class='muted' style='color:#999;'><i>(Tanpa Judul)</i></span>";
				}
			} else {
				$tampil_dokumen = "<strong>" . htmlspecialchars($dok_raw) . "</strong>";
			}

			// 4. Fallback kode dokumen
			$tampil_kodedok = !empty($s['kode_dokumen']) && $s['kode_dokumen'] != '-' ? htmlspecialchars($s['kode_dokumen']) : "<span class='muted' style='color:#999;'>-</span>";
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $tampil_dokumen; ?></td>
				<td><?php echo $tampil_kodedok; ?></td>
				<td><?php echo $tampil_user; ?></td>
				<td><?php echo $tampil_jabatan; ?></td>
				<td><span class="<?php echo $badge_class; ?>"><?php echo htmlspecialchars($s['action']); ?></span></td>
				<td><?php echo htmlspecialchars($s['deskripsi']); ?></td>
				<td><?php echo tgl_indojam($s['created_at']); ?></td>
			</tr> 
		<?php
			$i++;
		}
	}
	?>
	</tbody>
	</table>

	<!-- Navigasi Pagination -->
	<?php if ($total_pages > 1): ?>
	<div class="pagination pagination-centered" style="margin-top: 15px;">
		<ul>
			<?php
			// Tombol First & Prev
			if ($page > 1) {
				echo "<li><a href='" . build_page_url(1, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "' title='Halaman Pertama'>&laquo; Pertama</a></li>";
				echo "<li><a href='" . build_page_url($page - 1, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "' title='Halaman Sebelumnya'>&lsaquo; Prev</a></li>";
			} else {
				echo "<li class='disabled'><a href='javascript:void(0)'>&laquo; Pertama</a></li>";
				echo "<li class='disabled'><a href='javascript:void(0)'>&lsaquo; Prev</a></li>";
			}

			// Rentang nomor halaman (sliding window +/- 3)
			$start_page = max(1, $page - 3);
			$end_page   = min($total_pages, $page + 3);

			if ($start_page > 1) {
				echo "<li><a href='" . build_page_url(1, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "'>1</a></li>";
				if ($start_page > 2) echo "<li class='disabled'><a href='javascript:void(0)'>...</a></li>";
			}

			for ($p = $start_page; $p <= $end_page; $p++) {
				if ($p == $page) {
					echo "<li class='active'><a href='javascript:void(0)'><strong>$p</strong></a></li>";
				} else {
					echo "<li><a href='" . build_page_url($p, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "'>$p</a></li>";
				}
			}

			if ($end_page < $total_pages) {
				if ($end_page < $total_pages - 1) echo "<li class='disabled'><a href='javascript:void(0)'>...</a></li>";
				echo "<li><a href='" . build_page_url($total_pages, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "'>$total_pages</a></li>";
			}

			// Tombol Next & Last
			if ($page < $total_pages) {
				echo "<li><a href='" . build_page_url($page + 1, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "' title='Halaman Berikutnya'>Next &rsaquo;</a></li>";
				echo "<li><a href='" . build_page_url($total_pages, $limit, $tgl_awal, $tgl_akhir, $f_action, $f_user, $f_keyword) . "' title='Halaman Terakhir'>Terakhir &raquo;</a></li>";
			} else {
				echo "<li class='disabled'><a href='javascript:void(0)'>Next &rsaquo;</a></li>";
				echo "<li class='disabled'><a href='javascript:void(0)'>Terakhir &raquo;</a></li>";
			}
			?>
		</ul>
	</div>
	<?php endif; ?>

</div>
</div>

</div><!--/span12-->

</div><!--/block-content-->
