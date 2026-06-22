<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Pemeliharaan Alat/Mesin/Aktiva</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/pemeliharaan/aksi_pemeliharaan.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Pemeliharaan</legend>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Rencana Pemeliharaan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="Pemeliharaan">Jenis Pemeliharaan</label>
        <div class="controls">
            <select name="jenis" />
			    <option value='Alat-Lab-Prod'>Alat Produksi & Lab</option>   
                <option value='Mesin-Prod'>Mesin Produksi</option>  
                <option value='Listrik-Kuat'>Listrik Arus Kuat</option>
                <option value='Listrik-Lemah'>Listrik Arus Lemah</option>
                <option value='GdTek-Kompres'>Gudang Teknik & Kompressor</option>
                <option value='Sipil'>Sipil Bangunan</option>
                <option value='Boiler-Steam'>Boiler & Steam</option>
                <option value='HVAC-Dust'>HVAC & Dust Collector</option>
                <option value='SPA'>Pengolahan Air</option>
            <option value=0 selected>Pilih - Lainnya</option>
            </select>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="aknomor">Nomor Aktiva</label>
        <div class="controls"><input class="input-large focused" id="Pemeliharaan" type="text" name="aknomor" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="uraian">Uraian Pemeliharaan</label>
        <div class="controls"><input class="input-xxlarge focused" id="Pemeliharaan" type="text" name="uraian_pemeliharaan" required="required"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM pemeliharaan WHERE id_pemeliharaan='$_GET[id]'"));
?>

<form method="post" action="include/pemeliharaan/aksi_pemeliharaan.php?act=edit&id=<?=$e[id_pemeliharaan];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Pemeliharaan</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required" value="<?=$e[tgl_pemeliharaan];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="Pemeliharaan">Jenis Pemeliharaan</label>
        <div class="controls">
            <select name="jenis" />
               <option value='<?=$e[id_jenis];?>'><?=$e[id_jenis];?></option>  
			    <option value='Alat-Lab-Prod'>Alat Produksi & Lab</option>   
                <option value='Mesin-Prod'>Mesin Produksi</option>  
                <option value='Listrik-Kuat'>Listrik Arus Kuat</option>
                <option value='Listrik-Lemah'>Listrik Arus Lemah</option>
                <option value='GdTek-Kompres'>Gudang Teknik & Kompressor</option>
                <option value='Sipil'>Sipil Bangunan</option>
                <option value='Boiler-Steam'>Boiler & Steam</option>
                <option value='HVAC-Dust'>HVAC & Dust Collector</option>
                <option value='SPA'>Pengolahan Air</option>
            </select>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="aknomor">Nomor Aktiva</label>
        <div class="controls"><input class="input-large focused" id="Pemeliharaan" type="text" name="aknomor" value="<?=$e[aknomor];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="aknomor">Nama Alat/Mesin</label>
        <div class="controls"><input class="input-large focused" id="Pemeliharaan" type="text" name="aknama" required="required" value="<?=$e[aknama];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="uraian">Uraian Pemeliharaan</label>
        <div class="controls"><input class="input-xxlarge focused" id="Pemeliharaan" type="text" name="uraian" value="<?=$e[uraian_pemeliharaan];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="uraian">Pemeliharaan Oleh</label>
        <div class="controls"><input class="input-xxlarge focused" type="text" name="ploleh" value="<?=$e[ploleh];?>"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl_slesai" required="required" value="<?=$e[tgl_pemeliharaan_slesai];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="ket">Keterangan Hasil Pemeliharaan</label>
        <div class="controls"><input class="input-xxlarge focused" id="Pemeliharaan" type="text" name="keterangan" required="required" value="<?=$e[keterangan_hasil];?>"></div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

<br><center><b>ISI RIWAYAT ALAT/MESIN :</b>
                   	<form method="post" action='include/sinter/aksi_sintertp.php' target=_blank>
                   	<b>Thn-Bln-Tgl</b> :<input type=text name=tgl value=0000-00-00><br>PEMAKAIAN (utk Jam kerja alat), uraian : tulis angka/jumlah jam saja<br>PERBAIKAN : uraian isi perbaiki apa dan spare part apa diketerangan, kalau perlu no spptek<br>PEMELIHARAAN : uraian : pemeliharaan sesuai form ceklist, di Ket : Tulis jika ada tidak sesuai<br><br>
                   	<b>Nomor Aktiva </b> : <input type="text" name="qrcode" value="<?=$e[aknomor];?>"><br><br>
                   	<b>Pilih Jenis Riwayat</b> :</b><br><select name="jenis" /><option value=3>Mutasi/Pindah</option><option value=4>Pinjam/Kembali</option><option value=5>Rusak/5R/Pemusnahan</option><option value=6>Pemakaian/Pembersihan</option><option value=7>Kalibrasi/Adjust</option><option value=1>Perbaikan</option><option value=2 selected>Pemeliharaan</option><option value=0>Lainnya</option></select><br><br>
				    <b>Uraian Riwayat</b> :</b><br><input type="text" name="uraian" /><br><br>
				    <b>Keterangan</b> :</b><br><input type="text" name="keterangan" /><br><br>
				    <input class="btn btn-primary" type="submit" value="Isi Riwayat" />
				    </center>
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<button class="btn-info btn-large" onclick="window.location.href='?pages=pemeliharaan&act=tambah'">Tambah Pemeliharaan</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>No</th>
						<th>Tanggal</th>
						<th>Tanggal Slesai</th>
						<th>No.Aktiva</th>
						<th>Nama Aktiva</th>
						<th>Jenis</th>
						<th>Uraian</th>
            <th align='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$Pemeliharaan = mysql_query("SELECT * FROM pemeliharaan ORDER BY tgl_pemeliharaan_slesai ASC");
		$no=1;
		while($f = mysql_fetch_array($Pemeliharaan)) {
		    
					$tgl=tgl_indo($f[tgl_pemeliharaan]);
					$tgl1=tgl_indo($f[tgl_pemeliharaan_slesai]);
					if ($f[tgl_pemeliharaan_slesai]=='' OR $f[tgl_pemeliharaan_slesai]=='0000-00-00'){
			echo "<tr class=success>";} else {
						echo "<tr>"; }
						echo "<td align='center'>$no</td>
							<td>$tgl</td>
							<td>$tgl1</td>
							<td>$f[aknomor]</td>
							<td>$f[aknama]</td>
							<td>$f[id_jenis]</td>
							<td>$f[uraian_pemeliharaan]</td>
				<td align='center'>";
                echo "<a href='include/pemeliharaan/aksi_pemeliharaan.php?act=hapus&id=$f[id_pemeliharaan]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=pemeliharaan&act=edit&id=$f[id_pemeliharaan]'><i class='icon-edit'></i>";
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