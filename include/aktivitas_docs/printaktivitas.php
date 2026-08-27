<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Riwayat_Audit_Dokumen_" . date('Ymd_His') . ".xls");

// Parameter filter dari GET atau POST
$tgl_awal  = isset($_REQUEST['tgl_awal']) ? trim($_REQUEST['tgl_awal']) : (isset($_REQUEST['blnn1']) ? trim($_REQUEST['blnn1']) : '');
$tgl_akhir = isset($_REQUEST['tgl_akhir']) ? trim($_REQUEST['tgl_akhir']) : (isset($_REQUEST['blnn2']) ? trim($_REQUEST['blnn2']) : '');
$f_action  = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : '';
$f_user    = isset($_REQUEST['user']) ? trim($_REQUEST['user']) : '';
$f_keyword = isset($_REQUEST['keyword']) ? trim($_REQUEST['keyword']) : '';
$f_akt     = isset($_REQUEST['aktivitas']) ? trim($_REQUEST['aktivitas']) : '';

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
if (!empty($f_akt) && $f_akt != 'Pilih Dokumen') {
    $safe_akt = mysql_real_escape_string($f_akt);
    $where_clauses[] = "kode_aktivitas = '$safe_akt'";
}

$where_sql = implode(" AND ", $where_clauses);
$aktivitas = mysql_query("SELECT * FROM aktivitas_dokumen WHERE $where_sql ORDER BY created_at DESC") or die(mysql_error());
?>
<table width="100%" border="1">
	<thead>
		<tr style="background-color: #f2f2f2; font-weight: bold;">
		    <th>No</th>
			<th>Dokumen</th>
			<th>Kode Dokumen</th>
			<th>User</th>
			<th>Jabatan</th>
			<th>Action</th>
			<th>Deskripsi</th>
			<th>IP Address</th>
			<th>User Agent</th>
			<th>Tanggal & Waktu</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
    while($s = mysql_fetch_array($aktivitas)) {
		// Resolve user ID to name if numeric
		$user_raw = trim($s['user']);
		if (is_numeric($user_raw) && isset($user_map[$user_raw])) {
			$tampil_user = $user_map[$user_raw];
		} elseif (!empty($user_raw) && $user_raw != '-') {
			$tampil_user = $user_raw;
		} else {
			$tampil_user = '-';
		}
	?>
		<tr>
		    <td><?php echo $i; ?></td>
		    <td><?php echo htmlspecialchars($s['dokumen']); ?></td>
		    <td><?php echo htmlspecialchars($s['kode_dokumen']); ?></td>
		    <td><?php echo htmlspecialchars($tampil_user); ?></td>
		    <td><?php echo htmlspecialchars($s['jabatan']); ?></td>
		    <td><?php echo htmlspecialchars($s['action']); ?></td>
		    <td><?php echo htmlspecialchars($s['deskripsi']); ?></td>
		    <td><?php echo htmlspecialchars($s['ip_address']); ?></td>
		    <td><?php echo htmlspecialchars($s['user_agent']); ?></td>
		    <td><?php echo tgl_indojam($s['created_at']); ?></td>
		</tr> 
	<?php
		$i++;
	}
	?>
	</tbody>
</table>