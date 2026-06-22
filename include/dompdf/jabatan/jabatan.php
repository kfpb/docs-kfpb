<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Jabatan</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/jabatan/aksi_jabatan.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Jabatan</legend>
	<div class="control-group">
		<label class="control-label" for="jabatan">Nama Jabatan</label>
        <div class="controls"><input class="input-large focused" id="jabatan" type="text" name="nama" required="required"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM jabatan WHERE idj='$_GET[id]'"));
?>

<form method="post" action="include/jabatan/aksi_jabatan.php?act=edit&id=<?=$e[idj];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Jabatan</legend>
	<div class="control-group">
		<label class="control-label" for="jabatan">Nama Jabatan</label>
        <div class="controls"><input class="input-large focused" id="jabatan" type="text" name="nama" value="<?=$e[jabatan];?>" required="required"></div>
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
	<button class="btn-info btn-large" onclick="window.location.href='?pages=jabatan&act=tambah'">Tambah Jabatan</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Nama Jabatan</th>
            <th align='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$jabatan = mysql_query("SELECT * FROM jabatan");
		while($s = mysql_fetch_array($jabatan)) {
		echo "<tr>
				<td>$s[jabatan]</td>
				<td align='center'>";
                echo "<a href='include/jabatan/aksi_jabatan.php?act=hapus&id=$s[idj]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=jabatan&act=edit&id=$s[idj]'><i class='icon-edit'></i>";
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