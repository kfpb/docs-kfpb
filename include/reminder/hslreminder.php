<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Kelola Reminder Dokumen</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/reminder/aksi_reminder.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Reminder Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="reminder">Kode reminder</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="nomor_reminder" required="required"></div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="reminder">Kode reminder </label>
        <div class="controls"><input class="input-large focused" id="reminder" type="text" name="reminder_" required="required"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="reminder">Nama Reminder</label>
        <div class="controls"><input class="input-xxlarge focused" id="reminder" type="text" name="nama_reminder" required="required"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM reminder WHERE id_reminder='$_GET[id]'"));
?>

<form method="post" action="include/reminder/aksi_reminder.php?act=edit&id=<?=$e[id_reminder];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Jenis Memo/Surat</legend>
	<div class="control-group">
		<label class="control-label" for="reminder">Kode reminder</label>
        <div class="controls"><input class="input-large focused" id="kodems" type="text" name="nomor_reminder" value="<?=$e[nomor_reminder];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="reminder">Kode reminder </label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="reminder_" value="<?=$e[reminder_];?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="reminder">Nama reminder</label>
        <div class="controls"><input class="input-large focused" id="namams" type="text" name="nama_reminder" value="<?=$e[nama_reminder];?>" required="required"></div>
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

    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>Kode</th>
			<th>Nama </th>
			<th>Producer</th>
			<th>Country</th>
			<th>Supplier</th>
			<th>Tanggal Expire</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
    $thn = $_POST[kata1];
    $bln = $_POST[kata];
	$kata2 = trim ($thn.$bln) ;
	
  $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM reminder WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "valid_end LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$j = mysql_num_rows($hasil);
	   	
echo "<b>Ditemukan $j dokumen yang expire pada bulan $bln dan tahun $thn </b><p>";

		while($s = mysql_fetch_array($hasil)) {
		echo "<tr>
				<td>$s[internal_code]</td>
				<td>$s[material_name]</td>
				<td>$s[producer]</td>
				<td>$s[country]</td>
				<td>$s[supplier]</td>
			    <td>$s[valid_end]</td>
			    </tr>";
			    /*
				<td align='center'>";
                echo "<a href='include/reminder/aksi_reminder.php?act=hapus&id=$s[id_reminder]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=reminder&act=edit&id=$s[id_reminder]'><i class='icon-edit'></i>";
				echo "
				</td>
				</tr>";
				*/
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