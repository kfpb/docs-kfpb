<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Pengelolaan Aktiva/Inventaris</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

?>
<form method="post" action="include/aktiva/aksi_aktiva.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Aktiva/Inventaris</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Aktiva Datang</label>
        <div class="controls"><input class="input-small datepicker" id="aktgl" type="text" name="aktgl" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor Aktiva</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="aknomor">Kosongkan jika akan generate otomatis</div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor SAP</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="aknomor2"></div>
    </div> 
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Lokasi</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span9" name="aklokasi" required="required">
            	<option>Pilih/Cari Lokasi</option>
            <?php
				$vc = mysql_query("SELECT * FROM area ORDER BY nomor_area ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[nomor_area]'>$dvc[nomor_area] - $dvc[nama_area]</option>";
				}
			?>
           	</select>
        </div> 
	</div>    
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Aktiva</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span4" name="akkelompok" required="required">
            	<option>Pilih/Cari Jenis Aktiva</option>
	    	    <option value='1'>Bangunan</option>
	    	    <option value='2'>Kendaraan</option>
	    	    <option value='3'>Mesin & Alat Bantu Produksi/Lab</option>
	    	    <option value='4'>Furniture</option>
	    	    <option value='5'>Alat Kantor</option>
	    	    <option value='6'>Perlengkapan Rumah Tangga</option>
	    	    <option value='7'>Utility</option>
	    	    <option value='8'>Perlengkapan K3</option>
           	</select>
        </div> 
	</div>

    <div class="control-group">
		<label class="control-label" for="juduldok">Nama Aktiva</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="aknama" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Merk/ Type</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="akmerk" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Jumlah</label>
        <div class="controls"><input class="input-small focused" id="kodedok" type="text" name="jumlah"></div>
    </div>  
	<div class="control-group">
		<label class="control-label" for="kodedok">Tahun Perolehan</label>
        <div class="controls"><input class="input-small focused" id="kodedok" type="text" name="aktahun"></div>
    </div>   
    <div class="control-group">
		<label class="control-label" for="juduldok">Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="akket" required="required"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE suid='$_GET[id]'"));
?>
<form method="post" action="include/aktiva/aksi_aktiva.php?act=edit&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Aktiva/Inventaris</legend>
 
  <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Aktiva Datang</label>
        <div class="controls"><input class="input-small datepicker" id="aktgl" type="text" name="aktgl" required="required" value="<?=$e[aktgl];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor Aktiva</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="aknomor" value="<?=$e[aknomor];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor SAP</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="aknomor2" value="<?=$e[aknomor2];?>"></div>
    </div> 
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Lokasi</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span9" name="aklokasi" required="required">
            <?php
            echo "<option value='$e[aklokasi]'>$e[aklokasi] - $e[aklokasi2]</option>";
				$vc = mysql_query("SELECT * FROM area ORDER BY nomor_area ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[nomor_area]'>$dvc[nomor_area] - $dvc[nama_area]</option>";
				}
			?>
           	</select>
        </div> 
	</div>    
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Aktiva</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span4" name="akkelompok" required="required">
            	<option value='<? echo"$e[akkelompok]";?>' selected><? echo"$e[akkelompok2]";?></option>
	    	    <option value='1'>Bangunan</option>
	    	    <option value='2'>Kendaraan</option>
	    	    <option value='3'>Mesin & Alat Bantu Produksi/Lab</option>
	    	    <option value='4'>Furniture</option>
	    	    <option value='5'>Alat Kantor</option>
	    	    <option value='6'>Perlengkapan Rumah Tangga</option>
	    	    <option value='7'>Utility</option>
	    	    <option value='8'>Perlengkapan K3</option>
           	</select>
        </div> 
	</div>

    <div class="control-group">
		<label class="control-label" for="juduldok">Nama Aktiva</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="aknama" required="required" value="<?=$e[aknama];?>" ></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Merk/ Type</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="akmerk" required="required" value="<?=$e[akmerk];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Jumlah</label>
        <div class="controls"><input class="input-small focused" id="kodedok" type="text" name="jumlah" value="<?=$e[jumlah];?>"></div>
    </div>  
	<div class="control-group">
		<label class="control-label" for="kodedok">Tahun Perolehan</label>
        <div class="controls"><input class="input-small focused" id="kodedok" type="text" name="aktahun" value="<?=$e[aktahun];?>"></div>
    </div>   
    <div class="control-group">
		<label class="control-label" for="juduldok">Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="akket" required="required" value="<?=$e[akket];?>"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Aktif</label>
        <div class="controls">
        <? if ($e[distatus]=='Y') { ?>
          	 <select id="jenisdok" class="chzn-select span3" name="status" required="required">
	    	    <option value='Y'selected>Aktif</option>
	    	    <option value='N'>Tidak Aktif</option>
           	</select>
        <? } else { ?>
          	 <select id="jenisdok" class="chzn-select span3" name="status" required="required">
	    	    <option value='Y'>Aktif</option>
	    	    <option value='N' selected>Tidak Aktif</option>
           	</select>     
        <? } ?>
        </div> 
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
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE suid='$_GET[id]'"));
	?>
<strong>
<legend>Detail Aktiva/ Inventaris </legend>
<table width="100%" border=1>
    <tr><td>Tanggal Entry </td><td>: <?=tgl_indo($e[aktgl]);?></td></tr>
	<tr><td width="24%">Nomor Aktiva </td><td>: <?=$e[aknomor];?></td></tr>
	<tr><td width="24%">Nomor SAP </td><td>: <?=$e[aknomor2];?></td></tr>
    <tr><td>Jenis Aktiva</td><td>: <?=$e[akkelompok2];?></td></tr>
    <tr><td>Lokasi</td><td>: <?=$e[aklokasi2];?> - 
    
<?    $sql2=mysql_query("SELECT * FROM area WHERE nomor_area='$e[aklokasi]'");
                            $d2=mysql_fetch_array($sql2);
                            $sql3=mysql_query("SELECT * FROM area WHERE nomor_area='$d2[area_utama]'");
                            $d3=mysql_fetch_array($sql3);
                            echo $d3['nama_area']; ?>
    
    </td></tr>
	<tr><td>Nama Aktiva</td><td>: <?=$e[aknama];?></td></tr>
	<tr><td>Merk/ Type</td><td>: <?=$e[akmerk];?></td></tr>
	<tr><td>Tahun Perolehan</td><td>: <?=$e[aktahun];?></td></tr>
	<tr><td>Jumlah di ruangan</td><td>: <?=$e[jumlah];?></td></tr>
	<tr><td>Keterangan</td><td>: <?=$e[akket];?></td></tr>
	<tr><td>Status</td><td>: <strong>
<?
if ($e[distatus]=='N')
{
	echo"Tidak aktif";
}
else
{
	echo"Aktif";
}
?>
	</strong></td></tr>
	<tr><td>QR Code</td><td>  <img src="https://kfpb.kimiafarma.co.id/bnj/qrcode_aktiva.php?id=<?=$e[aknomor];?>"></td></tr>
	</table>
<?
}else{
?>

<div class="span12">

	<button class="btn-info btn-large" onclick="window.location.href='?pages=aktiva&act=tambah'">Tambah Aktiva</button><br /><br />

	<?php
		$dist = mysql_query("SELECT * FROM aktiva ORDER BY aknomor ASC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th>No</th>
			<th>No.Aktiva</th>
			<th>No.SAP</th>
			<th>Nama Aktiva</th>
            <th>Merk/Type</th>
            <th>Lokasi</th>
            <th class='center' width=17%>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		$no=1;
		while($s = mysql_fetch_array($dist)) {
		echo"<tr>
				<td>$no</td>
                <td>$s[aknomor]</td>
				<td>$s[aknomor2]</td>
				<td>$s[aknama]</td>
				<td>$s[akmerk]</td>
				<td>$s[aklokasi]</td>
				<td class='center'><a href='include/aktiva/aksi_aktiva.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=aktiva&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=aktiva&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'>Info</a>
				<a href='include/aktiva/aktiva2.php?act=print&id=$s[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i></a>
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