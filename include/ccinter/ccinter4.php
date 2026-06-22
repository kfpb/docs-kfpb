<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Registrasi Rencana Tindakan Change Control ALL</div>
</div>
<?php echo"<a href='home2.php?pages=ccinter4' class='btn btn-success'>Export XLS</a>" ?>
<div class="block-content collapse in">

	<table cellpadding="2" cellspacing="2" border="2" id="Tb14">
	<thead>
		<tr><th width=1%>Urut</th>
			<th width=10%>No.CC</th>
			<th width=10%>Alasan CC</th>
			<th>Rencana Tindakan</th>
			<th width=8%>Batas Waktu</th>
			<th width=8%>Penanggung jawab</th>
			<th>Hasil Verifikasi</th>
			<th width=8%>Tgl Verif/ Selesai</th>
			<th width=8%>Batas Waktu (ke-2 & 3)</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php

					
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab FROM cdis a LEFT JOIN users b ON a.pid=b.cId  ORDER BY a.psACC DESC");
		
		while($s = mysql_fetch_array($dsp)) {
			$p = mysql_fetch_array (mysql_query("SELECT * FROM ccinter WHERE ccid='$s[ccid]'"));
			$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Super Cito");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]=="0000-00-00"){
				$tglS="-";
			}
			
			if ($s[psACC]=='N'){
				$st = "<strong>Blm Selesai</strong>";
			}else{
				$st = "Selesai";
			}
		
			if ($s[psTglselesai]=="0000-00-00"){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			$pds = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[cId]"));
			
			echo	"<td>$s[urut]</td>
					<td><font size=1><a target=_blank href=home.php?pages=ccinter&act=detail&id=$p[ccid]>$p[ccnmr1]</a></font></td>
					<td>$p[ccket3]</td>
					<td>$s[pInstruksi]</td>
					<td>";echo tgl_indo1($s[ptgls]);echo"</td>
					<td>$pds[cJabatan]</td>
					<td>$s[info]</td>
					<td>$s[info1]<br><br>$s[info2]<br><br>$s[info3]</td>
					<td>";echo tgl_indo($s[psTglselesai]);echo"</td>
					<td>BW2 = ";echo tgl_indo2($s[ptgls2]);echo"<br>
					BW3 = ";echo tgl_indo2 ($s[ptgls3]);echo"</td>
					<td>$st</td>";
					
					

	
		}
	?>
	</tbody>
	</table>
	<br><br>
	

</div>

