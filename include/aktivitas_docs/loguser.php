<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Log Activity User</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
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
		    ?>
		<tr>
		    <td style='display: none;'></td>
		    <td><?php echo $i; ?></td>
		    <td><?php echo $s[user];?></td>
		    <td><?php echo $s[jabatan];?></td>
		    <td><?php echo $s[ip_address];?></td>
		    <td><?php echo $s[user_agent];?></td>
		    <td><?php echo $s[action];?></td>
		    <td><?php echo tgl_indojam($s[created_at]);?></td>
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
