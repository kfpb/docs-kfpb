<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black></font></div>
</div>

<!--<b>Keterangan = untuk menghapus kata "br" & "strong" di kolom keluhan, hilangkan masal dengan fungsi Replace setelah Export.</b><br><br>-->
<div>
<div class="span12">
    <?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Dokument.xls");



    ?>
	<table width="100%" border="1px">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Kode Dok</th>
			<th>Rev</th>
			<th>Judul Dok</th>
			<th>Tanggal Terima MR</th>
			<th>Tanggal Pembahasan</th>
			<th>Dibahas Oleh</th>
			<th>Tanggal Selesai</th>
			<th>Pengusul</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
		    
// 	$udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");
	
	    if ($_POST[blnn1]!=null){
        	$udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' && udtgl>'$_POST[blnn1]' && udtgl<'$_POST[blnn2]' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");
        	
        }else{
            $udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");
            
        }
		while($s = mysql_fetch_array($udmasuk)) {
		if ($s[udstatus]!=2 ){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td>";echo tgl_indo1($s[udtgl]);echo"</td>";
			$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$s[udpengusul2]'"));
			echo "<td>$s[ukodok]</td>
				<td>$s[udrev]</td>
                <td>$s[ujudok]</td>
                <td>"?><?php echo tgl_indo1($s[udtgl_terima]); ?>
                <td><?=tgl_indo($s[udtgl_selesai]);?></td>
                <td><?=tgl_indo($s[udtgl_bahas]);?></td>
                <td><?=tgl_indo($s[ud_bahas_oleh]);?></td>
                <?php echo"</td>
				<td>$user[cJabatan]</td>";
				if ($s[udstatus]==1 AND $s[udtgl_terima]=='0000-00-00'){echo"
				<td>Blm diterima";}
				elseif ($s[udstatus]==1 AND $s[udtgl_terima]!='0000-00-00'){echo"
				<td>Diterima";}
				elseif ($s[udstatus]==2){echo"
				<td>Selesai/Net";}
				elseif ($s[udstatus]==3){echo"
				<td>Pending";}
				elseif ($s[udstatus]==4){echo"
				<td>Tdk Jadi";}
				else{echo"
				<td></td>";}
				echo "
				</tr>";	
		
	}
	?>
	</tbody>
</table>
	
	<br><br>
</div>
</div>

</div><!--/span12-->
</div><!--/block-content-->