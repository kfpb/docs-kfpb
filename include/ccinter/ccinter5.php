<?
	$data = mysql_query("SELECT * FROM ccinter  ORDER BY cctgl DESC");
	$no = 1;
     ?>

<table border=1>
	<thead>
		<tr>
			<th>No</th>
			<th>Tgl CC</th>
			<th>Tgl Trm CC</th>
			<th>No. CC</th>
			<th>Pengusul</th>
			<th>Jenis CC</th>
			<th>Nama CC</th>
			<th>Usulan CC</th>
			<th>Alasan CC</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($data)) 
		{
		
		echo "<tr>";
	
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ccpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jeniscc WHERE kode_jcc=$s[jeniscc]"));
		
		echo "  <td>$no</td>
				<td>";echo tgl_indo($s[cctgl]);echo"</td
				<td>";echo tgl_indo($s[cctgl_trm]);echo"</td>
				<td>$s[ccnmr1]</td>
				<td>$p[cIdjab]</td>
			    <td>$j[nama_jcc]</td>
				<td>$s[ccperihal1]</td>
				<td>$s[ccket2]</td>
				<td>$s[ccket3]</td>
				<td>$s[ccstatus2]</td>
				";
				 $no++;
		}
				?>
	</tbody>
</table>

