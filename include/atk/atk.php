<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Kelola Data ATK</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/atk/aksi_atk.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Data ATK</legend>
	<div class="control-group">
		<label class="control-label" for="atk">Kategori</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="kategori" required="required"></div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="atk">Unit</label>
        <div class="controls"><input class="input-large focused" id="atk" type="text" name="unit" required="required"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="atk">Nama ATK</label>
        <div class="controls"><input class="input-xxlarge focused" id="atk" type="text" name="nama_atk" required="required"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM atk WHERE id_atk='$_GET[id]'"));
?>

<form method="post" action="include/atk/aksi_atk.php?act=edit&id=<?=$e[id_atk];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Jenis Memo/Surat</legend>
	<div class="control-group">
		<label class="control-label" for="atk">Kategori</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="kategori" value="<?=$e[kategori];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="atk">Unit</label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="unit" value="<?=$e[unit];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="atk">Nama ATK</label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="nama_atk" value="<?=$e[nama_atk];?>" required="required"></div>
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
	<button class="btn-info btn-large" onclick="window.location.href='?pages=atk&act=tambah'">Tambah Data ATK</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>No</th>
            <th>Kategori</th>
			<th>Nama ATK</th>
			<th>Unit</th>
            <th align='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$atk = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");
		$no=1;
		while($s = mysql_fetch_array($atk)) {
		echo "<tr>
		        <td>$no</td>
				<td>$s[kategori]</td>
				<td>$s[nama_atk]</td>
				<td>$s[unit]</td>
				<td align='center'>";
                echo "<a href='include/atk/aksi_atk.php?act=hapus&id=$s[id_atk]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=atk&act=edit&id=$s[id_atk]'><i class='icon-edit'></i>";
				echo "
				</td>
				</tr>";	
				$no++;
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