<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Dokumen Return Kembali Masuk ke MR (Hasil Koreksi/ACC)</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET['act']=="tambah"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");
$tgl			 = date("d-m-y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Usulan Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="ncc">Nomor Change Control</label>
        <div class="controls"><input class="input-medium focused" id="ncc" type="text" name="nomorcc" required="required"> Wajib Ada</div>
    </div>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<option>Pilih Pengusul</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama, cIdjab FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cIdjab])</option>";
				}
			?>
           	</select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        <input type=hidden name=kepada value=2><b>MR</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=2>";
	?>
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"> <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
           	</select>
        </div> 
    </div>
	
	<? } ?>	
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan</label>
        <div class="controls">
          	 <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
            	<option value=0 selected>Pilih Jenis Usulan (Wajib)</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
				<option value=3>Usulan Penghapusan Dokumen</option>
           	</select>
        </div> 
	</div>
  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok" required="required"> Tulis Strip (-) Jika Usulan Dok Baru</div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi" required="required">  Tulis Strip (-) Jika Usulan Dok Baru</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok" required="required"></div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>
        <div class="controls">
				<textarea name="udket" id="editor">
				<p>Bisa pakai tabel dibawah ini jika usulan perubahan dokumen atau dihapus jika tidak dipakai :</p>
<table border="1" cellpadding="1" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td>No</td>
			<td>Halaman</td>
			<td>Sebelum</td>
			<td>Sesudah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
				
				</textarea>
        </div>
    </div>
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Konsep Usulan</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET['act']=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=edit&id=<?=$e[uid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Usulan Dokumen</legend>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	?>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Change Control</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomorcc" value="<?=$e[uccnmr];?>" required="required"></div>
    </div>
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[udtgl];?>" required="required"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            <?php
				echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
				echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Status Usulan Dokumen</label>
        <div class="controls">
          	  <select id="statusud" class="chzn-select span5" name="statusud" required="required">
			  <? if ($e[udstatus]==1){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3>Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  elseif ($e[udstatus]==2){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1>Dalam Proses</option>
				<option value=2 selected>Selesai/ NET</option>
			    <option value=3 >Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  elseif ($e[udstatus]==3){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3 selected>Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  else {
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3>Pending</option>
			    <option value=4 selected>Tidak Jadi</option>";}
				?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
		<label class="control-label" for="tgl_terima">Tanggal Terima MR</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_terima" value="<?=$e[udtgl_terima];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_selesai" value="<?=$e[udtgl_selesai];?>"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
          	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
			  <? if ($e[jenisud]==1){
				  echo"
            	<option value=0>Pilih/Cari Jenis Usulan</option>
				<option value=1 selected>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
			  <option value=3>Usulan Penghapusan Dokumen</option>";}
			  elseif ($e[jenisud]==2){
				  echo"
            	<option value=0>Pilih/Cari Jenis Usulan</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2 selected>Usulan Perubahan Dokumen</option>
			  <option value=3>Usulan Penghapusan Dokumen</option>";}
			  else {
				  echo"
            	<option value=0>Pilih/Cari Jenis Usulan</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
			  <option value=3 selected>Usulan Penghapusan Dokumen</option>";
			  }
				?>
           	</select>
        </div> 
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>" required="required"></div>
    </div>
	
	<? } 
	else {
		echo"<input type=hidden name=statusud value=$e[udstatus]>
		<input type=hidden name=tgl_selesai value=$e[udtgl_selesai]>
		<input type=hidden name=tgl_terima value=$e[udtgl_terima]>
		
		";
	 ?>
	 	<div class="control-group">
		<label class="control-label" for="ns">Nomor Change Control</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="hidden" name="nomorcc" value="<?=$e[uccnmr];?>" required="required"><?=$e[uccnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>"><? echo tgl_indo($e[udtgl]); ?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Pengusul">Pengusul</label>
        <div class="controls">
            <select id="Pengusul" class="chzn-select" name="pengusul" required="required">
            <?php
				echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				
			?>
           	</select>
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
          	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
			  <? if ($e[jenisud]==1){
				  echo"
				<option value=1 selected>Usulan Pembuatan Dokumen Baru</option>";}
			  elseif ($e[jenisud]==2){
				  echo"
				<option value=2 selected>Usulan Perubahan Dokumen</option>";}
			  else {
				  echo"<option value=3 selected>Usulan Penghapusan Dokumen</option>";
			   }
				?>
           	</select>
        </div> 
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="ukodok"  value="<?=$e[ukodok];?>"><?=$e[ukodok];?></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="hidden" name="revisi"  value="<?=$e[udrev];?>"><?=$e[udrev];?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="hidden" name="ujudok"  value="<?=$e[ujudok];?>"><?=$e[ujudok];?></div>
    </div>
	
<? } ?>
	
	
    <div class="control-group">
    	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		<textarea name="ket" id="editor"><?=$e[udket];?></textarea>
    </div>
	</div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Konsep Usulan</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB <br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
}elseif($_GET['act']=="tambah2"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Usulan Dokumen</legend>
<div class="control-group">
		<label class="control-label" for="ncc">Nomor Change Control</label>
        <div class="controls"><input class="input-medium focused" id="ncc" type="text" name="nomorcc" required="required"> Wajib Ada</div>
    </div>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<option>Pilih Pengusul</option>
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
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        <input type=hidden name=kepada value=2><b>MR</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=2>";
	?>
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"> <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
           	</select>
        </div> 
    </div>
	
	<? } ?>	
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan</label>
        <div class="controls">
          	 <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
            	<option value=0 selected>Pilih Jenis Usulan (Wajib)</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
				<option value=3>Usulan Penghapusan Dokumen</option>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[kode_dok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[judul_dok];?>" required="required"></div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>
        <div class="controls">
				<textarea name="udket" id="editor">
				<p>Bisa pakai tabel dibawah ini jika usulan perubahan dokumen atau dihapus jika tidak dipakai :</p>
<table border="1" cellpadding="1" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td>No</td>
			<td>Halaman</td>
			<td>Sebelum</td>
			<td>Sesudah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
				
				</textarea>
        </div>
    </div>
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Konsep Usulan</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>




<?php
}elseif($_GET['act']=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));

if ($e[udtgl_terima]==0000-00-00 AND $_SESSION[cv]==0 or $e[udtgl_terima]==0000-00-00 AND $_SESSION[cv]=='1'){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE udokumen SET udtgl_terima='$tgl_sekarang', udstatus1='Y'  WHERE uid='$_GET[id]'");
}
if ($e[udstatus1]=='N' AND $_SESSION[cv]==0 or $e[udstatus1]=='N' AND $_SESSION[cv]==1){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE udokumen SET udstatus1='Y'  WHERE uid='$_GET[id]'");


}



?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor CC</td><td>: <b><?=$e[uccnmr];?></b></td></tr>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cIdjab];?>)</b></td></tr>
    <tr><td>Tgl Terima MR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Dalam Proses</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Konsep Usulan Awal</td><td>:
	<a title="Lampiran" href="/bnj/udmasuk/<?=$e[udfile];?>" target=_blank>Klik Disini (Jika Ada)</td></tr>
	</table>
	<br>
<table width="100%">
    <tr><td>Alasan/ Ringkasan/ Isi Usulan :</td><tr>
	<tr><td><?=$e[udket];?></td></tr>
</table></b></strong>
<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN duin d ON a.uid=d.uid
									WHERE pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dPengirim='$_SESSION[cv]' AND uid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi alurusulan-->
<legend>Alur Usulan Dokumen (Kirim-Kembali Usulan) :</legend>
<b><u>File Usulan untuk dikoreksi/acc dari Dokumentasi : <a href='/konsep_kirim/<? echo"$edf[disfile]";?>' target=_blank>klik disini (jika ada)</a></b></u>
<table class="table table-bordered" border=1 width=100% >
<thead>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Info Kirim</b></td>
	<td><b>Info Kembali</b></td>
	<td width=12%>Status</b></td>
	<td width=12%>Aksi</b></td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM uddis a WHERE a.uid='$_GET[id]' ORDER BY a.pudid DESC");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]";
				if($_SESSION[cv]==0 OR $_SESSION[cv]==1){
				echo"<a href='?pages=usulandok&act=kembali&id=$t[pudid]' class='btn btn-info'>Kembali ke MR</i>";
				}
				echo"
				</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
				<td><a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank><i class='icon-edit'></i> Edit</a></td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]<br>File Kembali : <a href='https://view.officeapps.live.com/op/view.aspx?src=https://kfpb.kimiafarma.co.id/bnj/jwb_usulandok/$t[filedis]' target=_blank>klik disini (jika ada)</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
				<td><a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank><i class='icon-edit'></i> Edit</a></td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi alurusulan-->
<?php	
}
?>

<?
}elseif($_GET['act']=="selesai"){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE udokumen SET udtgl_selesai = '$tgl',
										udstatus	= '2'
										WHERE uid = '$_GET[id]'");
							   
							   
 if ($q){
	 echo "<script>window.alert('Usulan Dokumen Selesai, Silahkan Edit RDT Dokumen dan Buat Distribusi !');window.location=('../home.php?pages=dinter')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
?>
<?
}elseif($_GET['act']=="kembali"){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE uddis SET psTglbaca = '$tgl',
							     psTglselesai = '$tgl',
								 psACC 	= 'Y'
								WHERE pudid = '$_GET[id]'");
							   
							   
 if ($q){
	 echo "<script>window.alert('Usulan Dokumen Kembali ke MR');window.location=('../bnj/home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
?>
<?php
//batas dari alurusulan.php
}elseif($_GET['act']=="tambahalur"){
$uid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoalur) as max_no FROM alurusulan WHERE dNoalur LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("AU-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/duin/aksi_duin.php?act=tambahalur&uid=<?=$uid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Alur Usulan Kirim Kembali</legend>
	<div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noalur" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[cv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
	<? } else {	 ?>
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
	<? } ?>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
     
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
		<?php
		
		if($_SESSION[cv]==0){
		            echo "<select id='pengirim' class='chzn-select' name='pengirim'>";
            
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
					}else{
						echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				}
			
		}
		else {

			echo "<input type=hidden name=pengirim value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
            	<option value="A">Rutin</option>
                <option value="B">Cito</option>
                <option value="C">Super CITO</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima Alur Usulan harus jawab</option>
                <option value="N">Tidak, penerima Alur Usulan tidak perlu jawab</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="uddis" name="uddis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select>*Bisa Pilih Grup 
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
        <div class="controls">
			<textarea name="isi" id="editor"></textarea>
        </div>
	</div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran Usulan (Jika ada)</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET['act']=="editalur"){
$uid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoalur) as max_no FROM alurusulan WHERE dNoalur LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("AU-%04s/$_SESSION[nppcv]/$bln", $noUrut);
$select = mysql_fetch_array(mysql_query("SELECT * FROM uddis WHERE pudid='$_GET[id]'"));
$select2 = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dNoalur='$select[pNoalur]'"));

?>
<form method="post" action="include/duin/aksi_duin.php?act=editalur2&uid=<?=$select['uid'];?>&xmlxx=<?=$select['pudid'];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Alur Usulan Kirim Kembali</legend>
    <?php if($select['pNoalur']!=null){?>
	<div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noalur" value="<? echo $select['pNoalur'] ?>" required="required"></div>
    </div>
    <?php }else{?>
    <div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noalur" value="<?php echo $newID ?>" required="required"><?php echo $newID ?></div>
    </div>
    <?php }?>
    
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" value="<?php echo $select['ptgl']; ?>" required="required"></div>
    </div>
    
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" value="<?php echo $select['ptgls']?>"name="tgls"> *Jika Perlu</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="psTglbaca">Tanggal Baca</label>
        <div class="controls"><input class="input-small datepicker" id="psTglbaca" type="text" name="psTglbaca"> *Jika Perlu</div>
    </div>
     <div class="control-group">
		<label class="control-label" for="psTglselesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="psTglselesai" type="text" name="psTglselesai"> *Jika Perlu</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">";
            
		<?php
		    
				$cv = mysql_query("SELECT cId, cNama FROM users");
				$cvq = mysql_fetch_array(mysql_query("SELECT cId, cNama FROM users where cId='$select[pId]'"));?>
					<option value="<?php echo $select['pId']; ?>" selected><?php echo $cvq["cNama"]; ?></option>
				<?php while ($dcv=mysql_fetch_array($cv)){
					?>
						<option value="<?php echo $dcv['cId']; ?>"><?php echo $dcv["cNama"]; ?></option>
				<?php
				}

		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
 
                <?php if($select['pSifat']=='A'){ ?>
                    	<option value="A" selected>Rutin</option>
                        <option value="B">Cito</option>
                        <option value="C">Super CITO</option>
                <?php }elseif($select['pSifat']=='B'){?>
                    	<option value="A">Rutin</option>
                        <option value="B" selected>Cito</option>
                        <option value="C">Super CITO</option>
                <?php }else{ ?>
                    	<option value="A">Rutin</option>
                        <option value="B">Cito</option>
                        <option value="C" selected>Super CITO</option>
                <?php } ?>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
                <?php if($select['jawab']=='Y'){ ?>
                    <option value="Y" selected>Ya, penerima Alur Usulan harus jawab</option>
                    <option value="N">Tidak, penerima Alur Usulan tidak perlu jawab</option>
                <?php }else{?>
                    <option value="Y">Ya, penerima Alur Usulan harus jawab</option>
                    <option value="N" selected>Tidak, penerima Alur Usulan tidak perlu jawab</option>
                <?php } ?>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select id="uddis" name="uddis" class="chzn-select span4">
          		<?php 
			    	$nam = mysql_fetch_array(mysql_query("SELECT * FROM users where cId='$select[cId]'"));
				?>
				     <option value='<?php echo $nam['cId'] ?>' selected><?php echo $nam['bagian']?> - <?php echo $nam['cNama'] ?></option>
			
                  <?php
                	$cv = mysql_query("SELECT cId, cNama, bagian FROM users");
    				while ($dcv=mysql_fetch_array($cv)){
    	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
    				}
				?>
				
            </select>
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
        <div class="controls">
			<textarea name="isi" id="editor"><?php echo $select['pInstruksi']; ?></textarea>
        </div>
	</div>
	
	
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran Usulan (Jika ada)</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div><br>
        <?php if($select2[disfile]!= null){?>
            Lampiran Usulan (Jika ada) : <a href='/konsep_kirim/<? echo"$select2[disfile]";?>' target=_blank>klik disini (jika ada)</a>
        <?php }?>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<!-- batas dari alurusulan.php -->
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">

	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th></th>
			<th>Kembali ke MR</th>
			<th>Alur Usulan</th>
			<th>Kode Dok</th>
			<th>Judul Dok</th>
			<th>Rev</th>
            <th width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
		$jinbox = mysql_num_rows(mysql_query("SELECT * FROM udokumen WHERE udstatus1=='N'"));
		
		$udmasuk = mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a, users b WHERE a.udpengusul=b.cId AND a.ccstatus='Y' AND a.udtgl_terima!='0000-00-00' AND a.udstatus1='N' ORDER BY a.udtgl_kembali DESC");
// 		$udmasuk = mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a, users b WHERE a.udpengusul=b.cId AND a.udstatus1='N' AND a.ccstatus='Y' ORDER BY a.udtgl_kembali DESC");	
				
		while($s = mysql_fetch_array($udmasuk)) {
		if ($s[udtgl_kembali]!='0000-00-00' AND $s[udstatus1]='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td>$i</td><td>";echo tgl_indo1($s[udtgl_kembali]);echo"</td><td class='center'>";
				$ds = mysql_query("SELECT * FROM alurusulan WHERE uid='$s[uid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=usulandok&act=tambahalur&id=$s[uid]' class='btn btn-info'>Tambah Alur</a>";
					}else{
						echo "<a href='?pages=usulandok&act=editalur&id=$s[uid]' class='btn btn-info'>Tambah Alur</i>";
					}
				
			echo "</td>";
			$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$s[udpengusul2]'"));
			echo "
				<td>$s[ukodok]</td>	
                <td>$s[ujudok]</td>
				<td>$s[udrev]</td>";
				
				echo "
				<td class='center'>";
				echo"
				<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a>";
				echo"<a href='?pages=usulandok&act=edit&id=$s[uid]'> <i class='icon-edit'></i> <a href='home.php?pages=usulandok2&act=detail&id=$s[uid]' title=Detail' class='btn btn-info'> Baca/Detail </a>
				</td>
				</tr>";	
				
				
				 $i++;
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>USULAN KEMBALI BELUM DIBACA</strong><br>
	Masuk ke Detail (D) untuk Konfirmasi Telah Baca/Terima Usulan dan Cek Alur Usulan Kirim-Kembali</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->