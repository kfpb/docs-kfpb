<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Dokumen (Change Note)</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");
$tgl			 = date("d-m-y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah/Buat Usulan Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="ncc">Nomor Change Control</label>
        <div class="controls"><input type="hidden" name="nomorcc" value='<?=$_GET[id2];?>'> <?=$_GET[id2];?></div>
    </div>
<?php
	if($_SESSION[levelcv]==0 or $_SESSION[cv]==1){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul (pilih Asman)</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul2">
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
        <input type=hidden name=kepada value=49><input type=hidden name=pdid value=<? echo"$_GET[pdid]"; ?>><b>Pengendalian Dokumen</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=49><input type=hidden name=pdid value=$_GET[pdid]>";
	?>
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"> <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul2" class="chzn-select" name="pengusul2">
            	<?
				$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));	
				echo "
				<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
				<option value='$e[cId]' >$e[cNama]</option>";
			
			
			
		
         ?> 
           	</select>
        </div> 
    </div>
	
	<? } 
	
	echo"<input type=hidden name=pengusul value=$_SESSION[cv]>";
	?>	
	
	<div class="control-group">
    	<label class="control-label" for="Jenisud"><font color=red>Jenis Usulan</font></label>
        <div class="controls">
          	 <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
            	<option value=2>Pilih Jenis Usulan (Wajib)</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
				<option value=3>Usulan Penghapusan Dokumen</option>
           	</select>
        </div> 
	</div>
  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input type="hidden" name="ukodok" value='<?=$_GET[id];?>'> <?=$_GET[id];?> (Kosong jika Usulan Dok Baru)</div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input type="hidden" name="revisi" value='<?=$_GET[id3];?>'><?=$_GET[id3];?> (Kosong jika Usulan Dok Baru)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
		<? $data = mysql_fetch_array(mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'"));
		?>
        <div class="controls"><input type="text" name="ujudok" value="<?=$data[judul_dok];?>" class="input-xxlarge focused"></div>
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
<br>
<p>Penerima Distribusi Dokumen : (Jika Usulan Baru Wajib diisi, jika Usulan Perubahan apabila berubah)</p>
1.<br>
2.<br>
<br>
<p>Dokumen yang terkait : </p>
1.<br>
2.<br>	
		
				
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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=edit&id=<?=$e[uid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Usulan Dokumen</legend>
<?php
	if($_SESSION[levelcv]<1 OR $_SESSION[cv]==1){
	?>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Change Control</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomorcc" value="<?=$e[uccnmr];?>"></div>
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
		<label class="control-label" for="tgl_terima">Tanggal Terima SPD</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_terima" value="<?=$e[udtgl_terima];?>"></div>
    </div>
    	<div class="control-group">
		<label class="control-label" for="tgl_terima">Tanggal Pembahasan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_bahas" value="<?=$e[udtgl_bahas];?>"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="udbhs">Dibahas oleh</label>
        <div class="controls"><input class="input-xlarge focused" id="ud_bahas_oleh" type="text" name="udbhs"  value="<?=$e[ud_bahas_oleh];?>" > Ketik Nama (jabatan) pisahkan dengan koma (,) </div>
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
	
	
		<?php
	if($_SESSION[cv]==81 OR $_SESSION[cv]==1 ){
	?>
	<div class="control-group">
    	<label class="control-label" for="udkepada">Usulan Untuk</label>
        <div class="controls">
          	  <select id="udkepada" class="chzn-select span5" name="udkepada">
			  <? if ($e[udkepada]==49){
				  echo"
				<option value=49 selected>Pengendalian Dokumen</option>
				<option value=60>Petugas Change Control</option>
				<option value=23>Manager Pemastian Mutu</option>";
			  }
			  elseif ($e[udkepada]==23){
				  echo"
				<option value=49>Pengendalian Dokumen</option>
				<option value=60>Petugas Change Control</option>
				<option value=23 selected>Manager Pemastian Mutu</option>
				";
			  }
			  elseif ($e[udkepada]==60){
				  echo"
				<option value=49>Pengendalian Dokumen</option>
				<option value=60 selected>Petugas Change Control</option>
				<option value=23>Manager Pemastian Mutu</option>";
			  }
				?>
           	</select>
        </div> 
	</div>
	
	<? } else { echo"<input type=hidden name=udkepada value=49"; } ?> 
	
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
}elseif($_GET[act]=="tambah2"){
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
	if($_SESSION[levelcv]==0 or $_SESSION[cv]==1){
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
        <input type=hidden name=kepada value=49><b>SPD-MR</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=49>";
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
<br>
<p>Penerima Distribusi Dokumen : (Jika Usulan Baru Wajib diisi, jika Usulan Perubahan apabila berubah)</p>
1.<br>
2.<br>				
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
}elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));
/*
if ($e[udtgl_terima]==0000-00-00 AND $_SESSION[cv]=='1'){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE udokumen SET udtgl_terima='$tgl_sekarang', udstatus1='Y'  WHERE uid='$_GET[id]'");

}

if ($e[udstatus1]=='N' AND $_SESSION[levelcv]<1 or $_SESSION[cv]=='1'){

mysql_query("UPDATE udokumen SET udstatus1='Y' WHERE uid='$_GET[id]'");

}
*/

?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor CC</td><td>: <b><?=$e[uccnmr];?> (Jika ada)</b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cIdjab];?>)</b><br>
    : <b><?=$ef[cNama];?> (<?=$ef[cIdjab];?>)</b></td></tr>
    <tr><td>Tgl Terima SPD-MR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b>  
    
    	<? if ($e[udtgl_terima]==0000-00-00 AND $_SESSION[cv]=='1'){
echo"<a href='include/duin/aksi_duin.php?act=acc3&id=$_GET[id]' onClick=\"return confirm('Yakin akan terima usulan dokumen ini??')\" class='btn btn-info'>Terima</a>";
 } ?>
 
    </td></tr>
    <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
    <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[ukodok];?></td></tr>
    <tr><td>Revisi</td><td>: <?=$e[udrev];?></td></tr>
    <tr><td>Judul Dokumen</td><td>: <?=$e[ujudok];?></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Konsep Usulan Awal</td><td>: 	<a href="http://ekfpb.com/bdg/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a> / 
	<a title="Lampiran" href="https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bdg/udmasuk/<?=$e[udfile];?>" target=_blank>Buka Online (Jika Ada)</a></td></tr>
<? $cc = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'")); ?>	
	<tr><td>Link Usulan CC</td><td>: 	<a href="https://ekfpb.com/bdg/home.php?pages=ccinter&act=detail&id=<?=$cc[ccid];?>" target=_blank>Klik Usulan CC </a></td></tr>
	
	</table>
	<br>
<table width="100%">
    <tr><td>Alasan/ Ringkasan/ Isi Usulan :</td><tr>
	<tr><td><?=$e[udket];?></td></tr>
</table></b></strong>

<?php	
if ($_SESSION[cv]=='3'){ 
if ($e[udtgl_acc]==0000-00-00) {

    echo"<form method='post' action='include/duin/aksi_duin.php?act=acc2&id=$e[uid]'>
	<div class='control-group'>
			<label class='control-label' for='info'><b>Pilih ACC atau TIDAK ACC dan komentar (jika ada) :</b></label>
        <div class='controls'>
        <select name='comment0'>
            	<option value='ACC' selected>ACC</option>
				<option value='TIDAK ACC'>TIDAK ACC</option>
           	</select><br>Komentar :<br>
		<textarea name='comment'></textarea>
    </div>";?>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>ACC/Komentar</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>
<br>
<br>
";

}
}
?>



<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN duin d ON a.uid=d.uid
									WHERE b.cId='49' AND pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dPengirim='$_SESSION[cv]' AND uid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi alurusulan-->
<legend>Alur Usulan Dokumen (Kirim-Kembali Usulan) :</legend>
<b><u>File Usulan untuk dikoreksi/acc dari SPD-MR : <a href="http://ekfpb.com/bdg/konsep_kirim/<? echo"$edf[disfile]";?>" target=_blank>Download</a> / <a href='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bdg/konsep_kirim/<? echo"$edf[disfile]";?>' target=_blank>Buka Online (jika ada)</a></b></u>
<table class="table table-bordered" border=1 width=100% >
<thead>
	<td ><b>Tgl</b></td>
    <td ><b>Kepada</b></td>
	<td width=35%><b>Info Kirim</b></td>
	<td width=25%><b>Info Kembali</b></td>
	<td>Status</b></td>
      
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
				if($_SESSION[levelcv]<1 OR $_SESSION[cv]==1){
				echo"<a href='?pages=usulandok&act=kembali&id=$t[pudid]' class='btn btn-info'>Kembali ke SPD</i>";
				}
				echo"
				</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]<p><b>File koreksi :</b> <a href='http://ekfpb.com/bdg/jwb_usulandok/$t[filedis]' target=_blank>Download</a> / <a href='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bdg/jwb_usulandok/$t[filedis]' target=_blank>Buka Online (jika ada)</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
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
}elseif($_GET[act]=="selesai"){
$tgl			 = date("Y-m-d");
$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=selesai2&id=<?=$e[uid];?>" class="form-horizontal">
<fieldset>
<legend>Usulan Dokumen Net Selesai</legend>
	
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_selesai" value="<?=$tgl;?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="kode_dok"  value="<?=$e[ukodok];?>"><?=$e[ujudok];?><br><?=$e[ukodok];?> Rev : <?=$e[udrev];?></div>
    </div>
	
	<div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Selesai</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
 
<?
if ($e[jenisud]==2 OR $e[jenisud]==3 ){
	echo"<a href='home.php?pages=dokint&act=editdokumen&id=$e[ukodok]' target=_blank><b>SEBELUM KLIK SELESAI, KLIK DISINI UNTUK EDIT DOKUMEN !</b></a>";
}
else {
	echo"<a href='home.php?pages=dokint&act=tambahdokumen' target=_blank><b>SEBELUM KLIK SIMPAN, KLIK DISINI UNTUK TAMBAH DOKUMEN !</b></a>";
	
}
?>
 	  
				  			  

<?php
//batas dari alurusulan.php
}elseif($_GET[act]=="tambahalur"){
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
	if($_SESSION[levelcv]==0){
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
		
		if($_SESSION[levelcv]==0){
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
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
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
}elseif($_GET[act]=="editalur"){
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
<form method="post" action="include/duin/aksi_duin.php?act=editalur&uid=<?=$uid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Alur Usulan Kirim Kembali</legend>
	<div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noalur" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[levelcv]==0){
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
		
		if($_SESSION[levelcv]==0){
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
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
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
<!-- batas dari alurusulan.php -->
<?php
}else{
?>

<div class="span12">
	<?php
	if($_SESSION[cv]=='1'){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=usulandok&act=tambah'">Tambah Usulan Dokumen</button>
    <br /><br />
	<?php
	}
	if($_SESSION[cv]==23){
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th></th>
			<th>Tanggal</th>
			<th>No.CC</th>
			<th>Kode Dok</th>
			<th>Rev</th>
			<th>Judul Dok</th>
			<th>Status</th>
            <th width=18%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		
			$udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udtgl DESC");	    
	
		while($s = mysql_fetch_array($udmasuk)) {
		if ($s[udtgl_acc]==0000-00-00 ){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td>$s[udstatus1]</td><td>";echo tgl_indo1($s[udtgl]);echo"</td>";
			echo "<td>$s[uccnmr]</td>
				<td>$s[ukodok]</td>
				<td>$s[udrev]</td>
                <td>$s[ujudok]</td>";
				
				if ($s[udstatus]==1){echo"
				<td>Belum Selesai";}
				elseif ($s[udstatus]==2){echo"
				<td>Selesai/Net";}
				elseif ($s[udstatus]==3){echo"
				<td>Pending";}
				elseif ($s[udstatus]==4){echo"
				<td>Tdk Jadi";}
				else{echo"
				<td></td>";}
				if ($_SESSION[cv]=='81'){
				if ($s[udkepada]==60){
				    echo "<br>(PCC)</td>";
				}
				elseif ($s[udkepada]==23) {
				      echo "<br>(MPM)</td>";
				}
				else {
								    echo "<br>(PPD)</td>";
				}		
				}
				if ($s[udtgl_acc]==0000-00-00) {
				echo "
				<td class='center'>";
				echo"<a href='home.php?pages=usulandok&act=detail&id=$s[uid]' title='Detail Baca & Terima Usulan, Klik disini' class='btn btn-info'> Baca & ACC </a>
				</td>
				</tr>";	
				}
				else
				{
				   echo "
				<td class='center'>";
				echo"<a href='home.php?pages=usulandok&act=detail&id=$s[uid]' title='Detail Baca Usulan, Klik disini' class='btn btn-info'> Detail </a>
				</td>
				</tr>";	 
				}
		}
	}
	else { ?>
	
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th></th>
			<th>Tanggal</th>
			<th>Alur Usulan</th>
			<th>No.CC</th>
			<th>Kode Dok</th>
			<th>Rev</th>
			<th>Judul Dok</th>
			<th>Status</th>
            <th width=18%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	//	$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM udokumen a, users b WHERE a.udkepada=b.cId AND a.udkepada='$_SESSION[cv]' "));
		if($_SESSION[cv]=='1'){
		$udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND udkepada='49' ORDER by udtgl DESC");	
		}
		else {
			$udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udtgl DESC");	    
		}
				
		while($s = mysql_fetch_array($udmasuk)) {
		if ($s[udtgl_terima]==0000-00-00){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td>$s[udstatus]</td><td>";echo tgl_indo1($s[udtgl]);echo"</td><td class='center'>";
				$ds = mysql_query("SELECT * FROM alurusulan WHERE uid='$s[uid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=usulandok&act=tambahalur&id=$s[uid]' class='btn btn-info'>Buat</a>";
					}else{
						echo "<a href='?pages=usulandok&act=editalur&id=$s[uid]' class='btn btn-info'>Tmbh</i>";
					}
				
			echo "</td>";
			echo "<td>$s[uccnmr]</td>
				<td>$s[ukodok]</td>
				<td>$s[udrev]</td>
                <td>$s[ujudok]</td>";
					if ($s[udstatus]==1){echo"
				<td>Belum Selesai";}
				elseif ($s[udstatus]==2){echo"
				<td>Selesai/Net";}
				elseif ($s[udstatus]==3){echo"
				<td>Pending";}
				elseif ($s[udstatus]==4){echo"
				<td>Tdk Jadi";}
				else{echo"
				<td></td>";}
			
				echo "
				<td class='center'>";
				echo"
				<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> ";
				echo" <a href='?pages=usulandok&act=edit&id=$s[uid]' title='Edit atau Update Usulan' class='btn btn-info'> E</a>-<a href='home.php?pages=usulandok&act=detail&id=$s[uid]' title='Detail Baca & Terima Usulan, Klik disini' class='btn btn-info'> D </a>-<a href='home.php?pages=usulandok&act=selesai&id=$s[uid]' title='Usulan Dok. Selesai - Klik Disini' class='btn btn-info'> S </a>
				</td>
				</tr>";	
		}
	}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>USULAN BELUM DITERIMA MR</strong><br>
	Masuk ke Detail (D) untuk Konfirmasi Terima Usulan dan Cek Alur Usulan Kirim-Kembali<br>
	Jika usulan selesai klik (S).</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->