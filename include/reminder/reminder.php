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
    
<?php   
    	  echo "<font size=2><br>Tampilkan dalam browser <b>Dokumen yang harus di reminder </b> pada bulan:</b></font>
<form method=POST action='$aksi?pages=reminder' target=_blank>      
 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2017- >2017</option>
			<option value=2018- >2018</option
			<option value=2019- >2019</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>	
			<option value=2021- >2021</option>	
			<option value=2022- >2022</option>
			</select>
		  
        >><input type=submit value=Tampil />
      </form>";

//	<button class="btn-info btn-large" onclick="window.location.href='?pages=reminder&act=tambah'">Tambah Reminder Dokumen</button>	  
?>
    

    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>Kode</th>
			<th>Nama Material</th>
			<th>Producer</th>
			<th>Country</th>
			<th>Supplier</th>
			<th>Tanggal Expire</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$reminder = mysql_query("SELECT * FROM reminder ORDER BY material_name ASC");
		while($s = mysql_fetch_array($reminder)) {
		echo "<tr>
		        <td>$s[internal_code]</td>				
				<td>$s[material_name]</td>
				<td>$s[producer]</td>
				<td>$s[country]</td>
				<td>$s[supplier]</td>
			    <td>$s[valid_end]</td>
			    
			    </tr>";
/* <td align='center'>";
                echo "<a href='include/reminder/aksi_reminder.php?act=hapus&id=$s[id_reminder]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=reminder&act=edit&id=$s[id_reminder]'><i class='icon-edit'></i>";
				echo "
				</td>
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