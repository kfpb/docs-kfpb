<html>
<body><table>
		<tr>
			<th>Tgl CC</th>
			<th>No. CC</th>
			<th>Pengusul</th>
			<th>Jenis CC</th>
			<th>Nama CC</th>
			<th>Usulan CC</th>
			<th>Status</th>
		</tr>

	<?php
	//koneksi ke database
	mysql_connect("localhost", "ekfpbcoi_cobaku", "qudwah120905");
	mysql_select_db("ekfpbcoi_coba");
	
	//query menampilkan data
	$sql = mysql_query("SELECT * FROM ccinter where accsipengirim1='Y' AND `show`='Y' ORDER BY cctgl DESC");
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
			
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ccpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jeniscc WHERE kode_jcc=$s[jeniscc]"));
		
		echo "  
		<tr><td>";echo tgl_indo($s[cctgl]);echo"</td>
		<td>$s[ccnmr1]</td>
		<td>$p[cIdjab]</td>
		<td>$j[nama_jcc]</td>
		<td>$s[ccperihal1]</td>
		<td>$s[ccket2]</td>
		<td>$s[ccstatus2]</td>
		</tr>";
	?>
</table>	
</body>
</html>