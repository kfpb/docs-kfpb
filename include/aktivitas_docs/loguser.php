<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Log Activity User</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
$user_map = array();
$q_users_all = mysql_query("SELECT cId, cNama FROM users WHERE cNama != ''");
if ($q_users_all) {
    while ($ur = mysql_fetch_array($q_users_all)) {
        $user_map[$ur['cId']] = $ur['cNama'];
        $user_map[(string)$ur['cId']] = $ur['cNama'];
    }
}
?>

	<hr>
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th style="display: none;"></th>
		    <th>No</th>
			<th>User</th>
			<th>Jabatan</th>
			<th>Alamat IP</th>
			<th>Browser Yang dipakai</th>
			<th>Action</th>
			<th>Tanggal & Waktu</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
    $udmasuk = mysql_query("SELECT * FROM log_activity ORDER by created_at DESC");	 
        while($s = mysql_fetch_array($udmasuk)) {
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
		    <td style='display: none;'></td>
		    <td><?php echo $i; ?></td>
		    <td><?php echo htmlspecialchars($tampil_user); ?></td>
		    <td><?php echo htmlspecialchars($s['jabatan']); ?></td>
		    <td><?php echo htmlspecialchars($s['ip_address']); ?></td>
		    <td><?php echo htmlspecialchars($s['user_agent']); ?></td>
		    <td><?php echo htmlspecialchars($s['action']); ?></td>
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
