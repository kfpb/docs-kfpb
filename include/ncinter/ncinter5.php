<?
	$data = mysql_query("SELECT * FROM ncinter  ORDER BY nctgl DESC");
	$no = 1;
     ?>

<table border=1>
	<thead>
		<tr>
			<th>No</th>
			<th>Tgl nc</th>
			<th>Tgl Trm nc</th>
			<th>Pengusul</th>
			<th>Jenis nc</th>
			<th>Nama nc</th>
			<th>ncp</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($data)) 
		{
		
		echo "<tr>";
	
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ncpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jenisnc WHERE kode_jnc=$s[jenisnc]"));
		
		echo "  <td>$no</td>
				<td>";echo tgl_indo($s[nctgl]);echo"</td
				<td>";echo tgl_indo($s[nctgl_trm]);echo"</td>
				<td>$p[cJabatan]</td>
			    <td>$j[nama_jnc]</td>
				<td>$s[ncperihal1]</td>
				<td>$s[ncket2]</td>
				<td>$s[ncstatus2]</td>
				";
				 $no++;
		}
				?>
	</tbody>
</table>

