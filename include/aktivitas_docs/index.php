<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Riwayat Audit Dokumen</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_SESSION[cv]==1000){
$select = mysql_query("SELECT * FROM dinter WHERE distatus='Y' order by suid DESC LIMIT 250");
?>
    <div>
         <form method="post" action='home1.php?pages=printaktivitas' target=_blank>
            
            <div class="control-group">
        		<label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
                <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
            </div>
            <div class="control-group">
               <div class="control-group">
                   <div class="control-label">Kode Dokumen</div><div class="controls"><b>
                       
                       <select id="pengirim" class="chzn-select span6" name="aktivitas" required="required">
                        	<option>Pilih Dokumen</option>
                        <?php
            				while ($dcv=mysql_fetch_array($select)){
            	    	     	echo "<option value='$dcv[kode_aktivitas]'>$dcv[dikodok]- $dcv[direv] - $dcv[dijudok]</option>";
            				}
            			?>
                       	</select>
                       </b> 
                   </div>
                </div>
            </div>
            
            <input class="btn btn-primary" type="submit" value="Export" />
        </form>
    </div>
<?php
}
?>
	<hr>
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
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
			<!--<th>Link</th>-->
			<th>Tanggal & Waktu</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
    // $udmasuk = mysql_query("SELECT * FROM aktivitas_dokumen ORDER by created_at DESC");	 
    $udmasuk = mysql_query("SELECT * FROM aktivitas_dokumen WHERE hide_data = 0 ORDER BY created_at DESC");

        while($s = mysql_fetch_array($udmasuk)) {
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
		    <!--<td><?php //echo $s[ip_address];?></td>-->
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
