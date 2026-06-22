<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Dokumen</div>
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
$tgl3			 = date("d-M-Y");
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Usulan Dokumen</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker span6" id="tgl" type="hidden" name="tgl" value="<?php echo $tgl1 ?>" required="required" ><?php  echo $tgl3; ?></div>
    </div>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	?>
    
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select span6" name="pengusul2">
            	<option>Pilih Pengusul</option>
   	
            <?php
				$cv = mysql_query("SELECT cId, cNama, cIdjab, cJabatan FROM users ORDER BY cNama");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}

			
			?>
           	</select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        <input type=hidden name=kepada value=1><b>Dokumentasi</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=2>";
	?>
	 <!--<div class="control-group">-->
		<!--<label class="control-label" for="tgl">Tanggal Usulan</label>-->
  <!--      <div class="controls"> <?  //echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>-->
  <!--  </div>-->
    <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul2" class="chzn-select span6" name="pengusul2">
            	<?
				$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));	
				echo "
				<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>";
         ?> 
           	</select>
        </div> 
    </div>
	<? } 
	echo"<input type=hidden name=pengusul value=$_SESSION[cv]>";
	?>	
	<?php $tambahduin = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]' OR dikodok='$_GET[id]'")); ?>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan <span style="color:red">*</span></label>
        <div class="controls">
          	 <select id="jenisud" class="chzn-select span6" name="jenisud" required>
            	<option value=''><strong>Pilih Jenis Usulan (Wajib pilih !)</strong></option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
				<option value=3>Usulan Penghapusan Dokumen</option>
           	</select>
        </div> 
	</div>
  <div class="control-group">
		<label class="control-label" for="cc">Nomor CC</label>
        <div class="controls"><input type="text" name="uccnmr" value='<? echo"$_GET[id2]"; ?>' minlength="14" class="input-large span6"> 
        <br><small>(Masukkan 14 Karakter. Contoh : CC-12-22-11019)</small></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="udket">Judul Usulan Perubahan CC</label>
        <div class="controls"><input type="text" name="udket" value='<? echo"$_GET[udket]"; ?>' class="input-large span6"> 
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input type="text" name="ukodok" value='<?=$tambahduin[dikodok];?>' class="input-large span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input type="text" name="revisi" value='<?=$tambahduin[direv];?>' class="input-small span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input type="text" name="ujudok" value='<?=$tambahduin[dijudok];?>' class="input-xxlarge span6" required="required"></div>
    </div>
	
    <!--<div class="control-group">-->
    <!--	<label class="control-label" for="ket">Alasan/ Ringkasan/<br>Isi Usulan<br> (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>-->
    <!--    <div class="controls">-->
				<!--<textarea name="udket" id="editor">-->
				    
<!--				No. CC = <? //echo"$_GET[id2]"; ?>-->
<!--				<p><b>Uraian Usulan :</b><br>-->
<!--				1. Bisa pakai konsep file lampiran (attachment)<br>-->
<!--				2. Bisa pakai tabel dibawah ini jika usulan perubahan dokumen<br>-->
<!--				3. Atau hapus tabel dan menggunakan tulisan bebas, copy paste dll</p>-->
<!--<table border="1" cellpadding="1" cellspacing="1" width="100%">-->
<!--	<tbody>-->
<!--		<tr>-->
<!--			<td><b>No</b></td>-->
<!--			<td><b>Halaman</b></td>-->
<!--			<td><b>Sebelum</b></td>-->
<!--			<td><b>Revisi</b></td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--		</tr>-->
<!--	</tbody>-->
<!--</table>-->
<!--<br>-->
<!--<p><b>Penerima Distribusi Dokumen :</b> (Jika Usulan Baru Wajib diisi, jika Usulan Perubahan apabila berubah)</p>-->
<!--1.<br>-->
<!--2.<br>-->

<!--<p><b>Dokumen yang terkait :</b> </p>-->
<!--1.<br>-->
<!--2.<br>	-->
		
				
				<!--</textarea>-->
    <!--    </div>-->
    <!--</div>-->
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen Pendukung <span style="color: red;">*</span></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" > Max. 150 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
        </div>
    </div>
    
    
<fieldset>

            <!--<form method="post" action="include/dister/aksi_dister.php?act=lp2&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">-->
			 <label class="control-label" for="dsin">Penerima Dokumen:</label>
			  <div class="controls">
			<select multiple="multiple" id="disin" name="disin[]" class="chzn-select span8">
            	<?php
            	$data=mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$data[suid_dinter]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$data[suid_dinter]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
     </div> 
  
    
</fieldset>
<!--</form>-->

	
	
<br>

    <div class="control-group">
        
        <div class="control-label">
            <small>Tanda <span style="color:red">*</span> Wajib Diisi</small>
        </div><br>
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
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
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>" required="required"><?=$e[udtgl];?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <input class="input-small" id="pengusul" type="text" name="pengusul" value="<?= $e[udpengusul]; ?>" required="required">
            <!--<select id="pengusul" class="chzn-select span6" name="pengusul">-->
            <?php
				// echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				// $cv = mysql_query("SELECT cId, cNama FROM users");
				// while ($dcv=mysql_fetch_array($cv)){
				// echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				// }
			?>
           	<!--</select>-->
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
		<label class="control-label" for="tgl_terima">Tanggal diterima SSDR</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_terima" type="text" name="tgl_terima" value="<?=$e[udtgl_terima];?>"></div>
    </div>
    
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_selesai" value="<?=$e[udtgl_selesai];?>"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
          	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
			  <? 
			  if ($e[jenisud]==1){
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
		<label class="control-label" for="kodedok">No. Reg. Usulan</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="udnmr"  value="<?=$e[udnmr];?>"><?=$e[udnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor CC</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="uccnmr"  value="<?=$e[uccnmr];?>"><?=$e[uccnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
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
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>"></div>
    </div>
	
<? } ?>

	
 <!--   <div class="control-group">-->
 <!--   	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris)</label>-->
 <!--   <div class="controls">-->
		
	<!--		<textarea name="udket" id="editor"><?php //echo $e[udket];?>-->
			
		
				
	<!--			</textarea>-->
 <!--   </div>-->
	<!--</div>-->
	 <div class="control-group">
		<label class="control-label" for="cc">Nomor CC</label>
        <div class="controls"><input type="text" name="uccnmr" value='<? echo"$e[uccnmr]"; ?>' minlength="14" class="input-large span6">
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="ket">Judul Usulan Perubahan CC</label>
        <div class="controls"><input type="text" name="ket" value='<? echo"$e[udket]"; ?>' class="input-large span6">
        </div>
    </div>

   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen Pendukung</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" value="<?php echo $e[udfile] ?>"> Max. 150MB <br><small>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)</small>
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
}elseif($_GET['act']=="edit2"){
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
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>" required="required"><?=$e[udtgl];?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <input class="input-small" id="pengusul" type="hidden" name="pengusul" value="<?= $e[udpengusul]; ?>" required="required"><?php echo $ef[cNama]; ?>
            <!--<select id="pengusul" class="chzn-select span6" name="pengusul">-->
            <?php
				// echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				// $cv = mysql_query("SELECT cId, cNama FROM users");
				// while ($dcv=mysql_fetch_array($cv)){
				// echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				// }
			?>
           	<!--</select>-->
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
		<label class="control-label" for="tgl_terima">Tanggal diterima SSDR</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_terima" type="hidden" name="tgl_terima" value="<?=$e[udtgl_terima];?>"><?= tgl_indo($e[udtgl_terima]);?></div>
    </div>
    
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="hidden" name="tgl_selesai" value="<?=$e[udtgl_selesai];?>"><?= tgl_indo($e[udtgl_selesai]);?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
            <input class="input-small" id="jenisud" type="hidden" name="jenisud" value="<?=$e[jenisud];?>"><?php
            if ($e[jenisud]==1){
				 "Usulan Pembuatan Dokumen Baru";
                
            }elseif ($e[jenisud]==2){
				  echo"Usulan Perubahan Dokumen";
                
            }else {
				  echo"Usulan Penghapusan Dokumen";
			  }
			  ?>
          	  <!--<select id="jenisud" class="chzn-select span5" name="jenisud" required="required">-->
			  <? 
			 // if ($e[jenisud]==1){
				//   echo"
    //         	<option value=0>Pilih/Cari Jenis Usulan</option>
				// <option value=1 selected>Usulan Pembuatan Dokumen Baru</option>
				// <option value=2>Usulan Perubahan Dokumen</option>
			 // <option value=3>Usulan Penghapusan Dokumen</option>";}
			 // elseif ($e[jenisud]==2){
				//   echo"
    //         	<option value=0>Pilih/Cari Jenis Usulan</option>
				// <option value=1>Usulan Pembuatan Dokumen Baru</option>
				// <option value=2 selected>Usulan Perubahan Dokumen</option>
			 // <option value=3>Usulan Penghapusan Dokumen</option>";}
			 // else {
				//   echo"
    //         	<option value=0>Pilih/Cari Jenis Usulan</option>
				// <option value=1>Usulan Pembuatan Dokumen Baru</option>
				// <option value=2>Usulan Perubahan Dokumen</option>
			 // <option value=3 selected>Usulan Penghapusan Dokumen</option>";
			 // }
				?>
           	<!--</select>-->
        </div> 
	</div>
	<div class="control-group">
		<label class="control-label" for="kodedok">No. Reg. Usulan</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="udnmr"  value="<?=$e[udnmr];?>"><?=$e[udnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor CC</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="uccnmr"  value="<?=$e[uccnmr];?>"><?=$e[uccnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
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
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>"></div>
    </div>
	
<? } ?>

	
 <!--   <div class="control-group">-->
 <!--   	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris)</label>-->
 <!--   <div class="controls">-->
		
	<!--		<textarea name="udket" id="editor"><?php //echo $e[udket];?>-->
			
		
				
	<!--			</textarea>-->
 <!--   </div>-->
	<!--</div>-->
	 <div class="control-group">
		<label class="control-label" for="cc">Nomor CC</label>
        <div class="controls"><input type="hidden" name="uccnmr" value='<? echo"$e[uccnmr]"; ?>' minlength="14" class="input-large span6"> <? echo"$e[uccnmr]"; ?>
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="ket">Judul Usulan Perubahan CC</label>
        <div class="controls"><input type="hidden" name="ket" value='<? echo"$e[udket]"; ?>' class="input-large span6"> <? echo"$e[udket]"; ?>
        </div>
    </div>

   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen Pendukung</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" value="<?php echo $e[udfile] ?>"> Max. 150MB <br><small>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)</small>
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
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?php echo $tgl1 ?>" required="required"></div>
    </div>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	?>
   
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<option>Pilih Pengusul</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama, cjabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
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
	 <!--<div class="control-group">-->
		<!--<label class="control-label" for="tgl">Tanggal Usulan</label>-->
  <!--      <div class="controls"> <?  //echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>-->
  <!--  </div>-->
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
    	<label class="control-label" for="fileInput">Lamp. Dokumen Pendukung</label>
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
}elseif($_GET['act']=="terima"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));

if ($e[udstatus1]=='N' AND $_SESSION[cv]==0 OR $e[udstatus1]=='N' AND $_SESSION[cv]=='1' OR $e[udstatus1]=='N' AND $_SESSION[cv]=='53'){

mysql_query("UPDATE udokumen SET udstatus1='Y' WHERE uid='$_GET[id]'");

}

if ($e[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]=='0' OR $e[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]=='1' OR $e[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]=='53'){

if ($e[jenisud]=='1'){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%B$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("B$bln-$thn/$f[bagian]%03s", $noUrut);
}
elseif ($e[jenisud]=='2'){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%R$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("R$bln-$thn/$f[bagian]%03s", $noUrut);
}
elseif ($e[jenisud]=='3'){
$f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));

$tgl_sekarang = date("Y-m-d");
$thn			 = date("y");
$bln			 = date("m");
$query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%O$bln-$thn/$f[bagian]%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 9, 3);
$noUrut++;
$newID = sprintf("O$bln-$thn/$f[bagian]%03s", $noUrut);
}


$qq=mysql_query("UPDATE udokumen SET udtgl_terima='$tgl_sekarang', udstatus1='Y', udnmr='$newID'  WHERE uid='$_GET[id]'");

}

 if ($qq){
	 echo "<script>window.alert('Usulan Dokumen Diterima');window.location=('home.php?pages=usulandok&act=detail&id=$_GET[id]')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }


}elseif($_GET['act']=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));

$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));

if ($e['udstatus1'] == 'N' && in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])) {
 
    mysql_query("UPDATE udokumen SET udstatus1='Y' WHERE uid='$_GET[id]'");

    if ($user['cAudit'] == 'Y') {
        // Jika audit aktif, tidak ada pencatatan aktivitas
    } else {
        $q = mysql_query("INSERT INTO aktivitas_dokumen(
            kode_aktivitas,
            user,
            jabatan,
            ip_address,
            user_agent,
            kode_dokumen,
            dokumen,
            action,
            deskripsi
        ) VALUES(
            '{$e['kode_aktivitas']}',
            '{$user['cNama']}',
            '{$user['cJabatan']}',
            '-',
            '-',
            '{$e['ukodok']}',
            '{$e['ujudok']}',
            'approve',
            '{$user[cNama]} telah membaca detail kirim kembali user, dengan judul Dokumen {$e['ujudok']}. dan nomor CC {$e['uccnmr']}.' 
        )");

        // Tambahkan penanganan error untuk query INSERT
        if (!$q) {
            error_log("Gagal insert aktivitas dokumen: ". mysql_error());
            // Tambahkan penanganan kesalahan yang sesuai, misalnya menampilkan pesan kesalahan kepada pengguna
            echo "<script>alert('Gagal menyimpan aktivitas dokumen. Silakan coba lagi.');window.location.href=window.location.href;</script>"; // Contoh: menampilkan alert dan reload halaman
            exit; // Hentikan eksekusi script jika terjadi kesalahan
        }
    }
}
?>

<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
    <tr><td>Judul Usulan Perubahan /CC</td><b><td>: <b><?=$e[udket];?></b></td></tr>
    <tr><td>Judul Dokumen</td><b><td>: <b><?=$e[ujudok];?></b></td></tr>
	<!--<tr><td>Lihat Usulan CC</td><td>: <strong>-->
	<?php
	
// 	if ($e[uccnmr]!=''){
//     $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
// 	}
// 	else {
	    
// 	}
//     echo"<a href='home.php?pages=ccinter&act=detail&id=$n[ccid]' target=_blank>Klik disini lihat detail usulan CC</a>";
    ?>
	<!--</strong></td></tr>-->
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    <!--: <b><?php //echo $ef[cNama];?> (<?php //echo $ef[cJabatan];?>)</b>-->
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
  
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Lampiran Usulan</td><td>: 	<a href="https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a> </td></tr>
	</table>
	<br></b></strong></b></strong>

<?php /*
  <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
  <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
    
/<a title="Lampiran" href="https://view.officeapps.live.com/op/view.aspx?src=https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Buka Online (Jika Ada)</a>

<!--<table width="100%">-->
<!--    <tr><td><b>Judul Usulan Perubahan :</b></td><tr>-->
<!--	<tr><td><?php //echo $e[udket];?></td></tr>-->
<!--</table>-->
*/ ?>

<?php	


if ($_SESSION[cv]=='0'){ 
if ($e[udtgl_acc]=='0000-00-00' ) {

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
									WHERE b.cId='2' AND pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));


$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ 
?>

<!-- isi alurusulan-->
<legend>Alur Usulan Dokumen (Kirim-Kembali Usulan) :</legend>
<table class="table table-bordered" border=1 width=100% >
<thead>
	<td ><b>Tgl</b></td>
    <td ><b>Kepada</b></td>
	<td width=35%><b>Info Kirim</b></td>
	<td width=25%><b>Info Kembali</b></td>
	<td></td>
	<td></td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM uddis a WHERE a.uid='$_GET[id]' ORDER BY a.pudid DESC");

while ($t=mysql_fetch_array($pds)){
    $edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dNoalur='$t[pNoalur]'"));
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t[psTglbaca]=='' ){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=='' ){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]<br>
				<b>File Usulan untuk dikoreksi :</b> <a href='https://docs.kfpb.kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></td>
				<td>$t[info]";
				if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
				 echo"<a href='?pages=usulandok2&act=kembali&id=$t[pudid]' class='btn btn-info'>Kembali ke SDDR</i>";
								// <td><a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank>
								// <i class='icon-edit'></i> Edit</a></td>
				
				}
				echo"
				</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
			 
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br></td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]<br>
				<b>File Usulan untuk dikoreksi :</b> <a href='https://docs.kfpb/kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></td>
				<td>$t[info]<p><b>File koreksi (dari user) :</b> <a href='https://docs.kfpb.kimiafarma.co.id/jwb_usulandok/$t[filedis]' target=_blank>Download</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
				<td>
				<a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank><i class='icon-edit'></i> Edit</a>";?>
				<!--<a href='include/duin/aksi_duin.php?act=hapusalur&id=$edf[dId]'  onClick=\'return confirm('Yakin ingin menghapus??')\' class='btn btn-info pull-center'><i class='icon-edit'></i> Hapus</a>-->
				<?php
                    $id = htmlspecialchars($edf['dId'], ENT_QUOTES, 'UTF-8'); // Sanitize the ID
                    $idpudid = htmlspecialchars($t['pudid'], ENT_QUOTES, 'UTF-8'); // Sanitize the ID
                    $url = "include/duin/aksi_duin.php?act=hapusalur&id=" . urlencode($id) . "&idpudid=" . urlencode($idpudid); // URL Encode
                ?>
                <a href='<?php echo $url; ?>'  onClick="return confirm('Yakin ingin menghapus??');" class='btn btn-info pull-center' target='_blank'><i class='icon-edit'></i> Hapus</a>
			<?php "</td>
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
}elseif($_GET['act']=="kembali"){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE uddis SET psTglbaca = '$tgl',
							     psTglselesai = '$tgl',
								 psACC 	= 'Y'
								WHERE pudid = '$_GET[id]'");
							   
							   
 if ($q){
      echo "<script>window.location.href = '". $_SERVER['PHP_SELF'] ."?reload=true';</script>";
// 	 echo "<script>window.alert('Usulan Dokumen Kembali ke MR');window.location=('../bnj/home.php?pages=usulandok')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }

?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
    <tr><td>Judul Usulan Perubahan CC</td><b><td>: <b><?=$e[udket];?></b></td></tr>
	<!--<tr><td>Lihat Usulan CC</td><td>: <strong>-->
	<?php
	
// 	if ($e[uccnmr]!=''){
//     $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
// 	}
// 	else {
	    
// 	}
//     echo"<a href='home.php?pages=ccinter&act=detail&id=$n[ccid]' target=_blank>Klik disini lihat detail usulan CC</a>";
    ?>
	<!--</strong></td></tr>-->
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    <!--: <b><?php //echo $ef[cNama];?> (<?php //echo $ef[cJabatan];?>)</b>-->
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
  
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Lampiran Usulan</td><td>: 	<a href="https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a> </td></tr>
	</table>
	<br></b></strong></b></strong>

<?php /*
  <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
  <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
    
/<a title="Lampiran" href="https://view.officeapps.live.com/op/view.aspx?src=https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Buka Online (Jika Ada)</a>

<!--<table width="100%">-->
<!--    <tr><td><b>Judul Usulan Perubahan :</b></td><tr>-->
<!--	<tr><td><?php //echo $e[udket];?></td></tr>-->
<!--</table>-->
*/ ?>

<?php	


if ($_SESSION[cv]=='0'){ 
if ($e[udtgl_acc]=='0000-00-00' ) {

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
									WHERE b.cId='2' AND pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));


$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ 
?>

<!-- isi alurusulan-->
<legend>Alur Usulan Dokumen (Kirim-Kembali Usulan) :</legend>
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
    $edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dNoalur='$t[pNoalur]'"));
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t[psTglbaca]=='' ){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=='' ){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]<br>
				<b>File Usulan untuk dikoreksi :</b> <a href='https://docs.kfpb.kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></td>
				<td>$t[info]";
				if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
				/*echo"<a href='?pages=usulandok2&act=kembali&id=$t[pudid]' class='btn btn-info'>Kembali ke SSDR</i>";
								<td><a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank><i class='icon-edit'></i> Edit</a></td>
					*/
				}
				echo"
				</td>
				<td><b>Tgl Slesai:<br></b> $tglSelesai</td>

			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]<br>
				<b>File Usulan untuk dikoreksi :</b> <a href='https://docs.kfpb.kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></td>
				<td>$t[info]<p><b>File koreksi (dari user) :</b> <a href='https://docs.kfpb.kimiafarma.co.id/jwb_usulandok/$t[filedis]' target=_blank>Download</a></td>
				<td><b>Tgl Slesai:<br></b> $tglSelesai</td>
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
}


elseif($_GET['act']=="terimacc"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));


?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
	<!--<tr><td>Lihat Usulan CC</td><td>: <strong>-->
	<?php
	
// 	if ($e[uccnmr]!=''){
//     $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
// 	}
// 	else {
	    
// 	}
//     echo"<a href='home.php?pages=ccinter&act=detail&id=$n[ccid]' target=_blank>Klik disini lihat detail usulan CC</a>";
    ?>
	<!--</strong></td></tr>-->
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    <!--: <b><?php //echo $ef[cNama];?> (<?php //echo $ef[cJabatan];?>)</b>-->
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
    <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
    <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Dokumen Pendukung Awal</td><td>: 	<a href="https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a></td></tr>
	</table>
	<br></b></strong></b></strong>
<table width="100%">
    <tr><td><b>Judul Usulan Perubahan :</b></td><tr>
	<tr><td><?=$e[udket];?></td></tr>
</table>

<?php	


if ($e[ccstatus]=='N' ) {

    echo"<form method='post' action='include/duin/aksi_duin.php?act=accchangecontrol&id=$e[uid]'>
";?>
<hr>
<h3>Terima Usulan</h3>

    	<div class='control-group'>
			<label class='control-label' for='info'><b>Nomor CC</b> <span style="color: red">*</span></label>
            <div class='controls'>
            <input class="input-large" id="nocc" type="text" name="nocc" value="<?=$e[uccnmr];?>" minlength="14" required>
            <br><small>(Masukkan 14 Karakter. Contoh : CC-12-22-11019)</small></div>
        </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Terima</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
";

}

?>


<?
}



elseif($_GET['act']=="returncc"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));


?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
    <tr><td>Judul Usulan Perubahan</td><b><td>: <b><?=$e[udket];?></b></td></tr>
	<!--<tr><td>Lihat Usulan CC</td><td>: <strong>-->
	<?php
	
// 	if ($e[uccnmr]!=''){
//     $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
// 	}
// 	else {
	    
// 	}
//     echo"<a href='home.php?pages=ccinter&act=detail&id=$n[ccid]' target=_blank>Klik disini lihat detail usulan CC</a>";
    ?>
	<!--</strong></td></tr>-->
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    <!--: <b><?php //echo $ef[cNama];?> (<?php //echo $ef[cJabatan];?>)</b>-->
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Lampiran Usulan</td><td>: 	<a href="https://docs.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a></td></tr>
	</table>
	<br></b></strong></b></strong>
<!--<table width="100%">-->
 <!--   <tr><td><b>Judul Usulan Perubahan :</b></td><tr>-->
	<!--<tr><td><?php //echo $e[udket];?></td></tr>-->
<!--</table>-->

<?php	


if ($e[ccstatus]=='N' ) {

    echo"<form method='post' action='include/duin/aksi_duin.php?act=returncc&id=$e[uid]'>
";?>
<hr>
<h4>Pengembalian Usulan ke User</h4>
    	<div class='control-group'>
			<label class='control-label' for='info'><b>Keterangan/ informasi pengembalian :</b></label>
        <div class='controls'>
		<textarea name='keterangan' id="editor"></textarea>
</div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Return</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
";

}

?>


<?
}


elseif($_GET['act']=="selesai"){
$tgl			 = date("Y-m-d");
$tglthn          = date("Y")+3;
$tglbln			 = date("-m-d");
$tgl1 = $tglthn.$tglbln;

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
if ($e[udrev]=='' OR $e[udrev]=='-'){
$rev = 0;
} else {
$rev = $e[udrev]+1;
}
?>

<form method="post" action="include/duin/aksi_duin.php?act=selesai2&id=<?=$e[uid];?>" class="form-horizontal">
<fieldset>

<legend>Usulan Dokumen Net Selesai</legend>
<input class="input-small datepicker" id="pengusul" type="hidden" name="jenisud" value="<?=$e[jenisud];?>">
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="hidden" name="tgl_selesai" value="<?=$tgl;?>"><?php echo tgl_indo($tgl); ?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_berlaku">Tanggal Efektif</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_berlaku" type="text" name="tgl_berlaku" value="<?=$tgl;?>"></div>
    </div>
  <!--  <div class="control-group">-->
		<!--<label class="control-label" for="tgl_review">Tanggal Review</label>-->
  <!--      <div class="controls"><input class="input-small datepicker" id="tgl_review" type="text" name="tgl_review" value="<?php //echo $tgl1;?>"></div>-->
  <!--  </div>-->
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen <span style="color: red">*</span></label>
        <div class="controls"><input class="input-small focused" id="kodedok" type="text" name="kode_dok"  value="<?=$e[ukodok];?>" required></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="judul_dok"  value="<?=$e[ujudok];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen <span style="color: red">*</span></label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span4" name="jenisdok" required="required">
            	<option>Pilih Jenis Dokumen</option>
            <?php
				$vc = mysql_query("SELECT id_jendok, nama_jendok FROM jendok ORDER BY id_jendok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[id_jendok]'>$dvc[nama_jendok]</option>";
				}
			?>
           	</select> (Wajib Pilih)
        </div> 
	</div>
    
    <div class="control-group">
    	<label class="control-label" for="leveldok">Level Dokumen <span style="color: red">*</span></label>
        <div class="controls">
          	 <select id="leveldok" class="chzn-select span4" name="leveldok" required="required">
            	<option selected>Pilih Level Dokumen</option>
                <option value='1'>Manual MK3L, Manual Sistem Jaminan Halal, Site Master File, Cleaning Validation Plan, Validasi Master Plan, Facility Validation Plan, Proses Validasi & Analisis Metode Validasi Plan</option>
                <option value='2'>Prosedur</option>
                <option value='3'>Instruksi Kerja, Spesifikasi PPI & PGI </option>
                <option value='4'>Formulir/Catatan/Laporan Analisis dan dokumen Lainnya</option>
			
           	</select> (Wajib Pilih)
        </div> 
	</div>

	<div class="control-group">
		<label class="control-label" for="juduldok">Menjadi revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$rev;?>"></div>
    </div>
    
    <? $euser = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'")); ?>
    <div class="control-group">
    	<label class="control-label" for="pjdok">Penanggung jawab dokumen</label>
        <div class="controls">
          	 <select id="atasan" class="chzn-select span6" name="pjdok" required="required">
            	<option>Pilih/Cari</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));
				echo"<option value='$e[udpengusul]' selected>$v[cNama]</option>";
				$vc = mysql_query("SELECT cId, cNama, cJabatan FROM users ORDER BY cNama ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] ($dvc[cJabatan])</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    
	<div class="control-group">
	    <div class="control-label">
	        Tanda <span style="color: red">*</span> Wajib Diisi!
	    </div><br>
        <div class="controls">
            <button class="btn btn-primary">Selesai</button> 
            <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
<br><br><br><br><br><br><br><br>
    
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
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
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
<input  type="hidden" name="tgls" value='0000-00-00'>

    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
		<?php
		
		if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
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

			echo "<input type=hidden name=pengirim value='$_SESSION[cv]'><b>$_SESSION[namacv]</b>";
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
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
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
$pudid=mysql_fetch_array(mysql_query("SELECT * FROM uddis WHERE pudid = '$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=editalur&uid=<?=$uid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Alur Usulan Kirim Kembali</legend>

    <div class="control-group">
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="usulanid" value="<? echo $pudid['uid'] ?>" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noalur" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>

    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="ptgl" type="text" name="ptgl"  value="<?php echo $pudid['ptgl'] ?>"></div>
    </div>

     <div class="control-group">
		<label class="control-label" for="tgls">Tanggal Baca</label>
        <div class="controls"><input class="input-small datepicker" id="psTglBaca" type="text" name="psTglBaca" value="<?php echo $pudid['psTglbaca'] ?>"></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tglselesai" type="text" name="psTglselesai" value="<?php echo $pudid['psTglselesai'] ?>"></div>
    </div>
   

    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Edit</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<!-- batas dari alurusulan.php -->
<?php
}else{
?>
<div>
     <form method="post" action='home1.php?pages=printduin' target=_blank>
        
       <!-- <select class="chzn-select span5" name="jenispptek">-->
       <!--   	 <option value='ALL' selected>Silahkan Pilih Jenis SPPTek</option>  -->
       <!--   	    <option value='ALL'>Semua Teknik</option> -->
			    <!--<option value='APL'>Alat Produksi & Lab (APL)</option>   -->
       <!--         <option value='MP'>Mesin Produksi (MP)</option>  -->
       <!--         <option value='LAK'>Listrik Arus Kuat (LAK)</option>-->
       <!--         <option value='LAL'>Listrik Arus Lemah (LAL)</option>-->
       <!--         <option value='GTK'>Gudang Teknik & Kompressor (GTK)</option>-->
       <!--         <option value='SB'>Sipil Bangunan (SB)</option>-->
       <!--         <option value='BS'>Perbaikan Boiler & Steam (BS)</option>-->
       <!--         <option value='STUDC'>Sistem Tata Udara & Dust Collector (STUDC)</option>-->
       <!--         <option value='PA'>Pengolahan Air (PA)</option>-->
       <!--         <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	-->
       <!-- </select>-->
        <div class="control-group">
    		<label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
            <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Export" />
    </form>
</div>
	<hr>
	
	<div style="width:auto;overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th style="display: none;"></th>
		<th></th>
			<th>Tanggal Kirim User</th>
			<th>Tanggal Kirim CC</th>
			<th>Tanggal Terima MR</th>
			<?php if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==1000){ ?>
			<th>Alur Usulan</th>
			<?php } ?>
			<th>Kode Dok</th>
			<th>Rev</th>
			<th>Judul Dok</th>
			<th>Jenis Usulan Dok</th>
			<th>Pengusul</th>
			<th>Status</th>
            <th width=20%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
// 			$udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udtgl DESC");	  

if($_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==1000){
    $udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");	 
}else{
    $udmasuk = mysql_query("SELECT * FROM udokumen WHERE udtgl_terima!='0000-00-00' AND ccstatus='Y' AND udtgl_selesai='0000-00-00' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");	 
}
			   
				
		while($s = mysql_fetch_array($udmasuk)) {
		if ($s[udstatus]!=2 ){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td style='display: none;'></td><td>$s[udstatus1]</td>";
				//echo"<td>";echo tgl_indo($s[udtgl]); echo"</td>";
				echo"<td>";echo tgl_indo($s[udtgl_kirimusulan]); echo"</td>";
				echo"<td>";echo tgl_indo($s[cctgl_status]); echo"</td>";
				echo"<td>";echo tgl_indo($s[udtgl_terima]); echo"</td>";

				echo "
				<td class='center'>";
				if($_SESSION[cv]==0 AND $s[udtgl_terima]!='0000-00-00' OR $_SESSION[cv]==1 AND $s[udtgl_terima]!='0000-00-00' OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 AND $s[udtgl_terima]!='0000-00-00'){
    				$ds = mysql_query("SELECT * FROM alurusulan WHERE uid='$s[uid]'");
    				$jr = mysql_num_rows($ds);
    				
    					if ($jr<1){
    						echo "<a href='?pages=usulandok&act=tambahalur&id=$s[uid]' class='btn btn-info'>Buat</a>";
    					}else{
    						echo "<a href='?pages=usulandok&act=tambahalur&id=$s[uid]' class='btn btn-info'>Tmbh</i>";
    					}
				}
			echo "</td>";
    				
			$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$s[udpengusul2]'"));
			echo "<td>$s[ukodok]</td>
				<td>$s[udrev]</td>
                <td>$s[ujudok]</td>";
                
                
                echo"<td>"; 
				    if ($s[jenisud]==1) { 
				        echo"<b>Usulan Pembuatan Dokumen Baru</b>";
				        
				    }elseif ($s[jenisud]==2) { 
				        echo"<b>Usulan Perubahan Dokumen</b>";
				        
				    }else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	            echo"</td>
	            
	            
				<td>$user[cJabatan]</td>";
				
				if($s[ccstatus]=='N' AND $s[cctgl_status]='0000-00-00' AND $_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==1000){
				      echo"<td>Usulan Belum Diterima
        			<a href='home.php?pages=usulandok&act=terimacc&id=$s[uid]' title='Detail, Klik disini' class='btn btn-success'> Terima Usulan </a>";
				      echo"
        			<a href='home.php?pages=usulandok&act=returncc&id=$s[uid]' title='Return, Klik disini' class='btn btn-warning'> Return Usulan </a></td>";
				
				    
				}elseif($s[udstatus]==1 AND $s[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059){
				    
				    if ($s[ccstatus]=='N'){
				        echo"<td>Usulan Belum diterima</td>";
				    }
				    
				    elseif($s[udstatus]==1 AND $s[udtgl_terima]=='0000-00-00'){
        				   
        			    echo"<td>Usulan diterima CC / Blm diterima SSDR<br> <a href='home.php?pages=usulandok&act=terima&id=$s[uid]' title='Terima Usulan' class='btn btn-info'>Terima</a>";
        				    
				    }
    				elseif ($s[udstatus]==1 AND $s[udtgl_terima]!='0000-00-00'){echo"
    				    <td>Diterima";}
    				elseif ($s[udstatus]==2){echo"
    				    <td>Selesai/Net";}
    				elseif ($s[udstatus]==3){echo"
    				    <td>Pending";}
    				elseif ($s[udstatus]==4){echo"
    				    <td>Tdk Jadi";}
    				else{echo"
    				    <td>-</td>";}
				}else{
				if($s[udstatus]==1 AND $s[udtgl_terima]!='0000-00-00'){echo"
    				    <td>Diterima";}
    				elseif ($s[udstatus]==2){echo"
    				    <td>Selesai/Net";}
    				elseif ($s[udstatus]==3){echo"
    				    <td>Pending";}
    				elseif ($s[udstatus]==4){echo"
    				    <td>Tdk Jadi";}
    				else{echo"
    				    <td>Usulan diterima CC</td>";}
				}
				
				
				echo "
				<td class='center'>";
				if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059){
				    if($s[udtgl_selesai]='0000-00-00'){
				        if($s[udstatus1]!='Y'){
				            // echo"<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> ";
				        }
				    if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059){
				            echo"<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> ";
				            echo" <a href='?pages=usulandok&act=edit2&id=$s[uid]' title='Edit atau Update Usulan'> <i class='icon-pencil'></i></a>  ";
        				}else{
        				    echo" <a href='?pages=usulandok&act=edit&id=$s[uid]' title='Edit atau Update Usulan'> <i class='icon-pencil'></i></a>  ";
        				}
    				        echo"<a href='home.php?pages=usulandok&act=selesai&id=$s[uid]' title='Usulan Dok. Selesai - Klik Disini' class='btn btn-info'> Selesai </a>";
    				}
				}
				echo" <a href='home.php?pages=usulandok&act=detail&id=$s[uid]' title='Detail, Klik disini' class='btn btn-info'> I</a>
				</td>
				</tr>";	
		
	}
	?>
	</tbody>
</table>
	</div>
<br><br>
	<span class="label label-info">
	<h5>Notifikasi di menu kiri = belum diterima SSDR. Baris Tabel Berwarna HIJAU = <strong>USULAN BELUM SELESAI</strong><br>
	(E) = Untuk edit usulan.
	(D) = Masuk ke Detail dan untuk Konfirmasi Terima Usulan (oleh SSDR) <br>dan Cek Alur Usulan Kirim-Kembali. 
	(S) = Jika usulan selesai klik (S).</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->
 <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

