<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Rekap Surat Internal</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="view"){
$tglm = $_POST[tglm];
$tgls = $_POST[tgls];
$q = "SELECT a.*, b.cNama FROM isurat a
	  LEFT JOIN users b ON a.ikepada=b.cId
	  WHERE a.itgl>='$tglm' AND a.itgl<='$tgls'"
?>
<div class="block-content collapse in">
<div class="span12">
	<form method="post" action="include/rsuin/lrsuin2.php">
	<input type="hidden" name="qry" value="<?=$q;?>">
	<legend>Laporan Surat Masuk<br>
			Periode <?=tgl_indo($tglm);?> s/d <?=tgl_indo($tgls);?>
			<button class="btn btn-info pull-right"><i class="icon-print"></i> Cetak</button>
	</legend>
	</form>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>Dari</th>
			<th>Perihal</th>
			<th>Kepada</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query($q);
		
		while($s = mysql_fetch_array($smasuk)) {
		echo "<tr>
				<td>$s[inmr]</td>
                <td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[ipengirim]</td>
                <td>$s[iperihal]</td>
				<td>$s[cNama]</td>
                <td>$s[iket]</td>
			</tr>";	
		}
	?>
	</tbody>
</table>
<br><br>
</div>
</div>
<?php
}else{
?>
<form method="post" action="include/rsi/lrsi.php" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Filter Surat Internal</legend>
    <div class="control-group">
		<label class="control-label" for="tglm">Dari Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgls">Sampai Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" required="required"></div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Cetak</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->