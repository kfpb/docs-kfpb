<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Riwayat Alat/Mesin/Aktiva</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/riwayat/aksi_riwayat.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Riwayat</legend>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="riwayat">Jenis Riwayat</label>
        <div class="controls">
            <select name="jenis" />
            <option value=3>Mutasi/Pindah</option>
            <option value=4>Pinjam/Kembali</option>
            <option value=5>Rusak/5R/Pemusnahan</option>
            <option value=6>Pemakaian/Pembersihan</option>
            <option value=7>Kalibrasi/Adjust</option>
            <option value=1>Perbaikan</option>
            <option value=2>Pemeliharaan</option>
            <option value=0 selected>Pilih - Lainnya</option>
            </select>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="aknomor">Nomor Aktiva</label>
        <div class="controls"><input class="input-large focused" id="riwayat" type="text" name="aknomor" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="uraian">Uraian Riwayat</label>
        <div class="controls"><input class="input-xxlarge focused" id="riwayat" type="text" name="uraian" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="ket">Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="riwayat" type="text" name="keterangan" required="required"></div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>
<br>
<br>
<br>
<?php
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM riwayat WHERE id_riwayat='$_GET[id]'"));
?>

<form method="post" action="include/riwayat/aksi_riwayat.php?act=edit&id=<?=$e[id_riwayat];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Riwayat</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required" value="<?=$e[tgl_riwayat];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="riwayat">Jenis Riwayat</label>
        <div class="controls">
            <select name="jenis" />
            <option value=<?=$e[id_jenis];?>>
            <? if ($_POST['jenis']==1) { echo "Perbaikan"; } 
                            elseif ($_POST['jenis']==2) { echo "Pemeliharaan"; }
                            elseif ($_POST['jenis']==3) { echo "Mutasi/Pindah"; }
                            elseif ($_POST['jenis']==4) { echo "Pinjam/Kembali"; }
                            elseif ($_POST['jenis']==5) { echo "Rusak/5R/Pemusnahan"; }
                            elseif ($_POST['jenis']==6) { echo "Pemakaian/Pembersihan"; }
                            elseif ($_POST['jenis']==7) { echo "Kalibrasi/Adjust"; }
                            else { echo "Lainnya"; } ?>
            </option>
            <option value=3>Mutasi/Pindah</option>
            <option value=4>Pinjam/Kembali</option>
            <option value=5>Rusak/5R/Pemusnahan</option>
            <option value=6>Pemakaian/Pembersihan</option>
            <option value=7>Kalibrasi/Adjust</option>
            <option value=1>Perbaikan</option>
            <option value=2>Pemeliharaan</option>
            <option value=0>Lainnya</option>
            </select>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="aknomor">Nomor Aktiva</label>
        <div class="controls"><input class="input-large focused" id="riwayat" type="text" name="aknomor" required="required" value="<?=$e[aknomor];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="aknomor">Nomor Lokasi</label>
        <div class="controls"><input class="input-large focused" id="riwayat" type="text" name="aknomor" required="required" value="<?=$e[aklokasi];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="aknomor">Oleh User</label>
        <div class="controls"><input class="input-large focused" id="riwayat" type="text" name="user" required="required" value="<?=$e[username];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="aknomor">Nama User</label>
        <div class="controls"><input class="input-large focused" id="riwayat" type="text" name="nama" required="required" value="<?=$e[nama];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="uraian">Uraian Riwayat</label>
        <div class="controls"><input class="input-xxlarge focused" id="riwayat" type="text" name="uraian" required="required" value="<?=$e[uraian];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="ket">Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="riwayat" type="text" name="keterangan" required="required" value="<?=$e[keterangan];?>"></div>
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
	<button class="btn-info btn-large" onclick="window.location.href='?pages=riwayat&act=tambah'">Tambah Riwayat</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>No</th>
						<th>Tanggal</th>
						<th>Aktiva</th>
						<th>Jenis</th>
						<th>Uraian</th>
						<th>Keterangan</th>
            <th align='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$riwayat = mysql_query("SELECT * FROM riwayat ORDER BY tgl_riwayat DESC");
		$no=1;
		while($f = mysql_fetch_array($riwayat)) {
	    if ($f['id_jenis']==1) { $jenis='Perbaikan'; } 
					elseif ($f['id_jenis']==2) { $jenis='Pemeliharaan'; } 
					elseif ($f['id_jenis']==3) { $jenis='Mutasi/Pindah'; } 
					elseif ($f['id_jenis']==4) { $jenis='Pinjam/Kembali'; }
					elseif ($f['id_jenis']==5) { $jenis='Rusak/5R/Pemusnahan'; }
					elseif ($f['id_jenis']==6) { $jenis='Pemakaian/Pembersihan'; }
					elseif ($f['id_jenis']==7) { $jenis='Kalibrasi/Adjust'; }
					else { $jenis='Lainnya'; }
					$tgl=tgl_indo($f[tgl_riwayat]);
						echo "<tr>
							<td align='center'>$no</td>
							<td>$tgl</td>
							<td>$f[aknomor]</td>
							<td>$jenis</td>
							<td>$f[uraian]</td>
						    <td>$f[keterangan] - Oleh : $f[username]</td>
				<td align='center'>";
                echo "<a href='include/riwayat/aksi_riwayat.php?act=hapus&id=$f[id_riwayat]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=riwayat&act=edit&id=$f[id_riwayat]'><i class='icon-edit'></i>";
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