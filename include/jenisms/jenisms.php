<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Jenis Memo/Surat</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/jenisms/aksi_jenisms.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Jenis Memo/Surat</legend>
	<div class="control-group">
		<label class="control-label" for="jenisms">Kode Jenis Memo/Surat</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="kode_jms" required="required"></div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="jenisms">Nama Jenis Memo/Surat</label>
        <div class="controls"><input class="input-large focused" id="jenisms" type="text" name="nama_jms" required="required"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM jenisms WHERE id_jms='$_GET[id]'"));
?>

<form method="post" action="include/jenisms/aksi_jenisms.php?act=edit&id=<?=$e[id_jms];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Jenis Memo/Surat</legend>
	<div class="control-group">
		<label class="control-label" for="jenisms">Kode Jenis Memo/Surat</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="kode_jms" value="<?=$e[kode_jms];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="jenisms">Nama Jenis Memo/Surat</label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="nama_jms" value="<?=$e[nama_jms];?>" required="required"></div>
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
	<button class="btn-info btn-large" onclick="window.location.href='?pages=jenisms&act=tambah'">Tambah Jenis Memo/Surat</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		<th>Kode Jenis Memo/Surat</th>
			<th>Nama Jenis Memo/Surat</th>
            <th align='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$jenisms = mysql_query("SELECT * FROM jenisms");
		while($s = mysql_fetch_array($jenisms)) {
		echo "<tr>
				<td>$s[kode_jms]</td>
				<td>$s[nama_jms]</td>
				<td align='center'>";
                echo "<a href='include/jenisms/aksi_jenisms.php?act=hapus&id=$s[id_jms]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=jenisms&act=edit&id=$s[id_jms]'><i class='icon-edit'></i>";
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