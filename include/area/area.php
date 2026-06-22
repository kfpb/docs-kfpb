<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Kelola Area/ Ruangan</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/area/aksi_area.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Area/Ruangan</legend>
	<div class="control-group">
		<label class="control-label" for="area">Kode Area/Ruangan</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="nomor_area" required="required"></div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="area">Kode Area Utama</label>
        <div class="controls"><input class="input-large focused" id="area" type="text" name="area_utama" required="required"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="area">Nama Area/ Ruangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="area" type="text" name="nama_area" required="required"></div>
    </div>
    
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE id_area='$_GET[id]'"));
?>

<form method="post" action="include/area/aksi_area.php?act=edit&id=<?=$e[id_area];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Jenis Memo/Surat</legend>
	<div class="control-group">
		<label class="control-label" for="area">Kode Area/Ruangan</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="nomor_area" value="<?=$e[nomor_area];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="area">Kode Area Utama</label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="area_utama" value="<?=$e[area_utama];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="area">Nama Area/Ruangan</label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="nama_area" value="<?=$e[nama_area];?>" required="required"></div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<button class="btn-info btn-large" onclick="window.location.href='?pages=area&act=tambah'">Tambah Area/Ruang</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>Kode Area/Ruangan</th>
			<th>Kode Area Utama</th>
			<th>Nama Area/Ruangan</th>
            <th align='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$area = mysql_query("SELECT * FROM area ORDER BY nomor_area ASC");
		while($s = mysql_fetch_array($area)) {
		echo "<tr>
				<td>$s[nomor_area]</td>
				<td>$s[area_utama]</td>
				<td>$s[nama_area]</td>	
				<td align='center'>";
                echo "<a href='include/area/aksi_area.php?act=hapus&id=$s[id_area]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=area&act=edit&id=$s[id_area]'><i class='icon-edit'></i>";
				echo "
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->