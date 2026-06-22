<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black></font></div>
</div>

<!--<b>Keterangan = untuk menghapus kata "br" & "strong" di kolom keluhan, hilangkan masal dengan fungsi Replace setelah Export.</b><br><br>-->
<div>
<div class="span12">
    <?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Aktivitas.xls");


//echo cutText($text, 50, 1) . '...'; // Contoh script yang digunakan untuk memotong 50 hur...
//echo cutText($text, 50) . '...'; // Contoh script yang digunakan untuk memotong 50...
//echo cutText($text, 50, 3) . '...'; // Contoh script yang digunakan untuk memotong 50 huruf...


    ?>
	<table width="100%" border="1px">
		<thead>
		<tr>
		<th style="display: none;"></th>
		    <th>No</th>
			<th>Dokumen</th>
			<th>Kode Dokumen</th>
			<th>User</th>
			<th>Jabatan</th>
			<th>Action</th>
			<th>Deskripsi</th>
			<th>Tanggal & Waktu</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
     if ($_POST[blnn1]!=null){
        	$aktivitas = mysql_query("SELECT * FROM aktivitas_dokumen WHERE kode_aktivitas='$_POST[aktivitas]' && created_at>'$_POST[blnn1]' && created_at<'$_POST[blnn2]' ORDER by created_at DESC")or die(mysql_error());
        	
        }elseif($_POST[blnn1==null]){
            $aktivitas = mysql_query("SELECT * FROM aktivitas_dokumen WHERE WHERE kode_aktivitas='$_POST[aktivitas]' ORDER BY created_at DESC")or die(mysql_error());
            
        }else{
            $aktivitas = mysql_query("SELECT * FROM aktivitas_dokumen ORDER by created_at DESC")or die(mysql_error());	 
        }
        // var_dump($aktivitas);die();
        while($s = mysql_fetch_array($aktivitas)) {
		    ?>
		<tr>
		     <td style='display: none;'></td>
		    <td><?php echo $i; ?></td>
		    <td><?php echo $s[dokumen];?></td>
		    <td><?php echo $s[kode_dokumen];?></td>
		    <td><?php echo $s[user];?></td>
		    <td><?php echo $s[jabatan];?></td>
		    <td><?php echo $s[action];?></td>
		    <td><?php echo $s[deskripsi];?></td>
		    <td><?php echo tgl_indojam($s[created_at]);?></td>
		</tr> 
		    
	<?php
	$i++;
		}
	?>
	</tbody>
</table>
	
	<br><br>
</div>
</div>

</div><!--/span12-->
</div><!--/block-content-->