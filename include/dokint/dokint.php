<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Dokumen Internal</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/dokint/aksi_dokint.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Kode Dokumen</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim">
            	<option>Pilih User</option>
            	<?php
					$cv = mysql_query("SELECT cId, cNama FROM users");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				?>
           	</select>
        </div> 
    </div>
    
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Keterangan</label>
        <div class="controls">
        	<textarea name="ket" id="ket" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload">
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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dokint WHERE siid='$_GET[id]'"));
?>
<form method="post" action="include/dokint/aksi_dokint.php?act=edit&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Dokumen</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e[sinmr];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[sitgl];?>" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim">
            <?php
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($e[sipengirim]==$cv[cId]){
						echo "<option value=$dcv[cId] selected>$dcv[cNama]</option>";
					}else{
						echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
					}
				}
			?>
           	</select>
        </div> 
    </div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[siperihal];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Keterangan</label>
        <div class="controls">
        	<textarea name="ket" id="ket" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[siket];?></textarea>
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
}elseif($_GET[act]=="lp"){
?>
<form method="post" action="include/dokint/aksi_dokint.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>List Penerima Dokumen Internal</legend>
	<div class="control-group">
    	<label class="control-label" for="pdoki">Penerima Dokumen Internal</label>
        <div class="controls">
        	<select multiple="multiple" id="pdoki" name="pdoki[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId IN(SELECT cId FROM pdoki WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId NOT IN(SELECT cId FROM pdoki WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
				?>                             
            </select>
        </div> 
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
    <br><br><br><br><br><br>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dokint a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<strong>
<legend>Detail Dokumen Internal</legend>
<table width="100%">
	<tr><td width="24%">Nomor Dokumen</td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal Dokumen</td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$e[cNama];?></strong></td></tr>
    <tr><td>Ket</td><td>: <?=$e[siket];?></td></tr>
</table>
</strong>
<br />
<legend>Kepada :</legend>
<table class="table table-bordered table-striped">
<thead>
	<td width="30%">User</td>
    <td>Nama</td>
	<td>Tanggal Dibaca</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cFoto,b.tgl_baca FROM users a
						LEFT JOIN pdoki b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM pdoki WHERE siid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		echo "<tr>
				<td>$t[cJabatan]</td>
				<td>
					<img src='$foto' style='width: 30px; height: 30px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama]
				</td>
				
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 </tr>";
	}
?>
</table>
<br />
<big>Jumlah Penerima : <?=$j;?> Orang</big>
<?php	
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<2){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=dokint&act=tambah'">Tambah Dokumen</button><br /><br />
	<?php
	}
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Kode Dok.</th>
			<th>Judul Dokumen</th>
			<th>R0</th>
			<th>R1</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$dokint = mysql_query("SELECT * FROM dokumen");
		while($s = mysql_fetch_array($dokint)) {
		echo "<tr>
				<td><a href='../master_pdf/$s[kode_dok].pdf' target='_blank'>$s[kode_dok]</a></td>
				<td>$s[judul_dok]</a></td>
                <td>";echo tgl_indo($s[tgl_rev0]);echo"</td>
                <td>";echo tgl_indo($s[tgl_rev1]);echo"</td>
				";
				echo "
				<td class='center'><a href='include/dokint/aksi_dokint.php?act=hapus&id=$s[kode_dok]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=dokint&act=edit&id=$s[kode_dok]'><i class='icon-edit'></i>
				<a href='?pages=dokint&act=detail&id=$s[kode_dok]'><i class='icon-list-alt'></i>
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