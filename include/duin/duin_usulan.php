<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Dokumen</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET['act']=="perubahan"){
    
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");
$tgl			 = date("d-m-y");
$tgl1			 = date("Y-m-d");
$tgl1			 = date("d-M-Y");
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Usulan Perubahan Dokumen</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker span6" id="tgl" type="hidden" name="tgl" value="<?php echo $tgl1 ?>" required="required" ><?php  echo $tgl1; ?></div>
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
	<? 
// 	var_dump($_GET);die();
	$data = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]' OR dikodok='$_GET[id]'")); ?>
	<!--<div class="control-group">-->
 <!--   	<label class="control-label" for="Jenisud">Jenis Usulan <span style="color:red">*</span></label>-->
 <!--       <div class="controls">-->
 <!--         	 <select id="jenisud" class="chzn-select span6" name="jenisud" required>-->
 <!--           	<option value=''><strong>Pilih Jenis Usulan (Wajib pilih !)</strong></option>-->
	<!--			<option value=1>Usulan Pembuatan Dokumen Baru</option>-->
	<!--			<option value=2>Usulan Perubahan Dokumen</option>-->
	<!--			<option value=3>Usulan Penghapusan Dokumen</option>-->
 <!--          	</select>-->
 <!--       </div> -->
	<!--</div>-->
	 <div class="control-group">
		<label class="control-label" for="jenisud">Jenis Usulan</label>
        <div class="controls"><input type="hidden" name="jenisud" value='2' class="input-large span6">Usulan Perubahan Dokumen</div>
        
    </div>
  <!--<div class="control-group">-->
		<!--<label class="control-label" for="cc">Nomor CC</label>-->
  <!--      <div class="controls"><input type="text" name="uccnmr" value='<? //echo"$_GET[id2]"; ?>' minlength="14" class="input-large span6"> -->
  <!--      <br><small>(Masukkan 14 Karakter. Contoh : CC-12-22-11019)</small></div>-->
  <!--  </div>-->
  <div class="control-group">
		<label class="control-label" for="udket">Judul Usulan Perubahan CC</label>
        <div class="controls"><input type="text" name="udket" value='<? echo"$_GET[udket]"; ?>' class="input-large span6"> 
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input type="text" name="ukodok" value='<?=$data[dikodok];?>' class="input-large span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input type="text" name="revisi" value='<?=$data[direv];?>' class="input-small span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input type="text" name="ujudok" value='<?=$data[dijudok];?>' class="input-xxlarge span6" required="required"></div>
    </div>
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen Pendukung <span style="color: red;">*</span></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" required > Max. 150 MB<br>
        	<small>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)</small>
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
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET['act']=="penghapusan"){

    
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");
$tgl			 = date("d-m-y");
$tgl1			 = date("Y-m-d");
$tgl1			 = date("d-M-Y");
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Usulan Penghapusan Dokumen</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker span6" id="tgl" type="hidden" name="tgl" value="<?php echo $tgl1 ?>" required="required" ><?php  echo $tgl1; ?></div>
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
	<? 
// 	var_dump($_GET);die();
	$data = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]' OR dikodok='$_GET[id]'")); ?>

	 <div class="control-group">
		<label class="control-label" for="jenisud">Jenis Usulan</label>
        <div class="controls"><input type="hidden" name="jenisud" value='3' class="input-large span6">Usulan Penghapusan Dokumen</div>
        
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
        <div class="controls"><input type="text" name="ukodok" value='<?=$data[dikodok];?>' class="input-large span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input type="text" name="revisi" value='<?=$data[direv];?>' class="input-small span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input type="text" name="ujudok" value='<?=$data[dijudok];?>' class="input-xxlarge span6" required="required"></div>
    </div>
	
   	<!--<div class="control-group">-->
    <!--	<label class="control-label" for="fileInput">Lamp. Dokumen  </label>-->
    <!--    <div class="controls">-->
    <!--    	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" required > Max. 150 MB<br>-->
        	
    <!--    </div>-->
    <!--</div>-->
 

	
	
<br>

    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

<?php }?>