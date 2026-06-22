<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Rekapitulasi</div>
</div>
<div class="block-content collapse in">
<div class="span12">

	<form method="post" action="include/rall/lrall.php">
	<legend>Rekapitulasi Surat Masuk
			<button class="btn btn-info pull-right"><i class="icon-print"></i> Cetak</button><br>
	</legend>
	</form>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th rowspan="2">USER</th>
			<th rowspan="2">NAMA</th>
			<th colspan="3">SURAT YANG DIKELUARKAN</th>
			<th colspan="3">SURAT YANG DITERIMA</th>
		</tr>
		<tr>
			<th>SURAT KELUAR</th>
			<th>MEMO INTERNAL</th>
			<th>DISPOSISI</th>
			<th>SURAT MASUK</th>
			<th>MEMO INTERNAL</th>
			<th>DISPOSISI</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$q = "SELECT a.cUser,a.cNama,
			  (SELECT COUNT(b.iid) FROM isurat b WHERE b.ikepada=a.cId) AS jsi,
			  (SELECT COUNT(c.oid) FROM osurat c WHERE c.opengirim=a.cId) AS jso,     
			  (SELECT COUNT(d.siid) FROM sinter d JOIN psin e ON d.siid=e.siid WHERE e.cId=a.cId) AS jtsinter,
			  (SELECT COUNT(f.iid) FROM isurat f JOIN pdis g ON f.iid=g.iid WHERE g.cId=a.cId) AS jtdis,
			  (SELECT COUNT(h.siid) FROM sinter h WHERE h.sipengirim=a.cId) AS jmsinter,
			  (SELECT COUNT(i.dId) FROM disposisi i WHERE i.dPendisposisi=a.cId) AS jmdis
			  FROM users a";
			  
		$rkp = mysql_query($q);
		
		while($s = mysql_fetch_array($rkp)) {
		echo "<tr>
				<td>$s[cUser]</td>
                <td>$s[cNama]</td>
                <td>$s[jso]</td>
                <td>$s[jmsinter]</td>
				<td>$s[jmdis]</td>
                <td>$s[jsi]</td>
                <td>$s[jtsinter]</td>
				<td>$s[jtdis]</td>
			</tr>";	
		}
	?>
	</tbody>
	</table>
	<br><br>

</div><!--/span12-->
</div><!--/block-content-->