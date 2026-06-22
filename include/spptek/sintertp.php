
<?php

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
<!--<link href="https://thread.ekfpb.com/spawn.css" rel="stylesheet" type="text/css">-->
<!--<script src="https://thread.ekfpb.com/spawn.min.js"></script>-->

<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Surat Permohonan Perbaikan-Pembelian Teknik (SPPTek) - (Daftar yang dibuat oleh Anda dan bawahan Anda)</div>
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

$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("M-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/spptek/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat-Daftar Memo/Undangan Internal oleh Anda dan Bawahan Anda</legend>
<?

if($_SESSION[levelcv]==0){
?>
  <div class="control-group">
		<label class="control-label" for="ns">Nomor Memo </label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<? echo "$newID" ?>"></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" >
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
    	<label class="control-label" for="pengirim1">Minta koreksi atasaan-nya?</label>
        <div class="controls">
            <select id="pengirim1" class="chzn-select" name="pengirim1">
            	<option value='ya'>Ya, minta koreksi dulu atasan-nya</option>
            	<option value='tidak' selected>Tidak</option>
           	</select>
        </div> 
    </div>
	 <div class="control-group">
    	<label class="control-label" for="pengirim1">Minta koreksi atasan-nya level 2?</label>
        <div class="controls">
            <select id="pengirim2" class="chzn-select" name="pengirim2">
            	<option value='ya'>Ya, minta koreksi dulu atasan level 2</option>
            	<option value='tidak' selected>Tidak</option>
           	</select>
        </div> 
    </div>
<?
}
else
{
?>	
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
		 <br><br>
		 <b>Jika memo/undangan atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$e[cId]' >$e[cNama]</option>";
			
						$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users WHERE idj=2 OR idj=3 OR idj=4 OR idj=5");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
     
			
	echo "</select>";
         ?> 
		 <br>
		 <b>Jika memo/undangan atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select" name="pengirim2">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$ef[cId]' >$ef[cNama]</option>";
			$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users WHERE idj=2 OR idj=3 OR idj=4 OR idj=5");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
     			
		echo"</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
        </div> 
    </div>
<?

        
    }
?>

	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Memo/Undangan</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span7" name="jenisms" required="required">
            	<option value=0 selected>Pilih/Ketik Cari > Jenis Memo/Undangan</option>
            <?php
				$vc = mysql_query("SELECT kode_jms, nama_jms FROM jenisms ORDER BY kode_jms ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jms]'>$dvc[nama_jms]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo/Undangan (Tekan Shift+Enter untuk pindah baris,<br> Ctrl+V Paste)</label>
        <div class="controls">
        	<textarea name="ket" id="editor" requiresd="required"></textarea>
			</div>
        </div>
    <div class="control-group">
		<label class="control-label" for="komentar">Catatan Konseptor</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="sikomen"></div>
    </div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" > Max. 15 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)<br>
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
    }elseif($_GET[act]=="tambah3" && $_SESSION[bagian2]=='PTK'){
?>
<?php
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

// $query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$thn%'";
// $hasil = mysql_query($query);
// $hitung = mysql_num_rows($hasil);
// $data  = mysql_fetch_array($hasil); 
// $idMax = $data['max_no'];
// $noUrut = (int) substr($idMax, 2, 4);
// $noUrut++;
// $newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="?pages=sintertp&act=tambah33" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Surat Permintaan Perbaikan-Pembelian Oleh Teknik (Notif SPPTek)</legend>
<br><b><u>KETERANGAN</u> :<br>
- SPPTek ini tidak perlu pilih penerima & tembusan, karena sudah otomatis.<br>
- Menu SPPTek ini dikhususkan untuk user TEKNIK yang bertugas.<br>
- Setiap 1 jenis perbaikan hanya untuk 1 SPPTek (Misal perbaikan mekanik dan listrik tidak boleh digabung dalam 1 SPPTek)<br><br></b>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select span8" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
		 <br><br>
		
        </div> 
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo"></label>
        <div class="controls">
            <input type=hidden name=jenisms value=20><b>Permohonan SPPTek</b>
        </div> 
	</div>

    <div class="control-group">
		<label class="control-label">Keluhan <span style="color:red">*</span> <br>
		<small>Minimal 40 Karakter</small></label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="keluhan" name="keluhan" required="required" id="limit" minlength="40" style="width: 570px; height: 100px" placeholder="Isi Penjelasan Permintaan/Keluhan, Kronologi & Waktu Dengan Jelas."></textarea>
            <!--<textarea id="keluhan" class='input-large textarea' name='keluhan' style='width: 610px; height: 100px'></textarea>-->
    </div>
    </div>
    
    <div class="control-group">
		<label class="control-label">Penyebab</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="penyebab" name="penyebab" style="width: 570px; height: 100px" placeholder="Isi Penyebab"></textarea>
        </div>
    </div>
    
 	<div class="control-group">
    	<label class="control-label" for="lokasi">Pilih Lokasi <span style="color:red">*</span></label>
        <div class="controls">
          	 <select id="lokasi" class="chzn-select span8" name="lokasi" required="required">
            	<option value='-' selected>Pilih/Ketik Cari > Nomor - Area - Lokasi</option>
            	<option value='-'>TIDAK ADA DI DALAM DAFTAR GEDUNG/AREA/RUANGAN/KELOMPOK</option>
            <?php
            
				$vc = mysql_query("SELECT * FROM area ORDER BY id_area ASC");
				while ($dvc=mysql_fetch_array($vc)){
				$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$dvc[area_utama]'"));
	    	     	echo "<option value='$dvc[nomor_area]'>$dvc[nomor_area] - $dvc[nama_area]</option>";
				}
				
			?>
           	</select>
        </div> 
	</div>
   <div class="control-group">
		<label class="control-label" for="lokasi2">Lokasi</label>
        <div class="controls"><input class="input-large focused span7" id="lokasi2" type="text" name="lokasi2" value=""><font color=red> Tulis disini, Jika tidak ada di daftar/pilih lokasi diatas</font></div>
    </div>
   <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary" id="btnn" value="Check" disabled>Lanjut</button> 
        
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="tambah3"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);

$nospptek = sprintf("SPPTek-%04s/$_SESSION[jabatan]/$bln", $noUrut);

?>
<form method="post" action="?pages=sintertp&act=tambah33" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Surat Permintaan Perbaikan-Pembelian Teknik (Notif SPPTek)</legend>
<br><b><u>KETERANGAN</u> :<br>
- SPPTek ini tidak perlu pilih penerima & tembusan, karena sudah otomatis.<br>
- SPPTek Minimal harus keluar dari Asman, tidak boleh langsung dibuat Supervisor (hanya konsep)<br>
- Setiap 1 jenis perbaikan hanya untuk 1 SPPTek (Misal perbaikan mekanik dan listrik tidak boleh digabung dalam 1 SPPTek)<br><br></b>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select span8" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
		 <br><br>
		 <b>Jika SPPTek atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim1" class="chzn-select span8" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$e[cId]' >$e[cNama]</option>";
						$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users WHERE idj=2 OR idj=3 OR idj=4 OR idj=5");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
     
		echo"</select>";
         ?> 
		 <br><br>
		 <b>Jika SPPTek atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select span8" name="pengirim2">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Level 2!</option>
			<option value='$ef[cId]' >$ef[cNama]</option>";
						$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users WHERE idj=2 OR idj=3 OR idj=4 OR idj=5");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
     
		echo"</select>";
         ?> 
        </div> 
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo"></label>
        <div class="controls">
            <input type=hidden name=jenisms value=20><b>Permohonan SPPTek</b>
        </div> 
	</div>
<? /*
		<div class="control-group">
    	<label class="control-label" for="Jenispptek">Jenis SPPTek</label>
        <div class="controls">
            <select class="chzn-select" name="jenispptek" required="required" >
            <option value='' selected>Pilih Jenis SPPTek</option>  
            <option value='Mekanik'>Perbaikan Mekanik</option>   
            <option value='Listrik'>Perbaikan Listrik</option>  
            <option value='Utility'>Perbaikan Utility, HVAC</option>
            <option value='Harnet'>Perbaikan Hardware, Software dan Jaringan</option>
            <option value='Sipil'>Perbaikan Bangunan/Sipil</option>
            <option value='PR-Teknik'>Pembelian Teknik</option>
            </option>
            </select></b>.
        </div> 
	</div>
*/ ?>	

  <!--  <div class="control-group">-->
		<!--<label class="control-label" for="perihal">Keluhan <span style="color:red">*</span></label>-->
  <!--      <div class="controls"><textarea class="input-xxlarge focused" id="perihal" name="perihal" required="required" value="[SPPTEK]..."></textarea></div>-->
  <!--  </div>-->
    <div class="control-group">
		<label class="control-label">Keluhan <span style="color:red">*</span> <br>
		<small>Minimal 40 Karakter</small></label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="keluhan" name="keluhan" required="required" id="limit" minlength="40" style="width: 570px; height: 100px" placeholder="Isi Penjelasan Permintaan/Keluhan, Kronologi & Waktu Dengan Jelas."></textarea>
            <!--<textarea id="keluhan" class='input-large textarea' name='keluhan' style='width: 610px; height: 100px'></textarea>-->
    </div>
    </div>
    
    <div class="control-group">
		<label class="control-label">Penyebab</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="penyebab" name="penyebab" style="width: 570px; height: 100px" placeholder="Isi Penyebab"></textarea>
        </div>
    </div>
    
 	<div class="control-group">
    	<label class="control-label" for="lokasi">Pilih Lokasi <span style="color:red">*</span></label>
        <div class="controls">
          	 <select id="lokasi" class="chzn-select span8" name="lokasi" required="required">
            	<option value='-' selected>Pilih/Ketik Cari > Nomor - Area - Lokasi</option>
            	<option value='-'>TIDAK ADA DI DALAM DAFTAR GEDUNG/AREA/RUANGAN/KELOMPOK</option>
            <?php
            
				$vc = mysql_query("SELECT * FROM area ORDER BY id_area ASC");
				while ($dvc=mysql_fetch_array($vc)){
				$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$dvc[area_utama]'"));
	    	     	echo "<option value='$dvc[nomor_area]'>$dvc[nomor_area] - $dvc[nama_area]</option>";
				}
				
			?>
           	</select>
        </div> 
	</div>
   <div class="control-group">
		<label class="control-label" for="lokasi2">Lokasi</label>
        <div class="controls"><input class="input-large focused span7" id="lokasi2" type="text" name="lokasi2" value=""><font color=red> Tulis disini, Jika tidak ada di daftar/pilih lokasi diatas</font></div>
    </div>
   <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary" id="btnn" value="Check" disabled>Lanjut</button> 
        </div>
    </div>
</fieldset>
</form>
<br><br><br><br><br><br><br><br><br><br>
<?php
}
elseif($_GET[act]=="tambah33"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/spptek/aksi_sinter.php?act=tambah2" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">
<fieldset>
<input type=hidden name=tgl value='<?=$_POST[tgl];?>'>
<input type=hidden name=pengirim value='<?=$_POST[pengirim];?>'>
<input type=hidden name=pengirim1 value='<?=$_POST[pengirim1];?>'>
<input type=hidden name=pengirim2 value='<?=$_POST[pengirim2];?>'>
<input type=hidden name=perihal value='<?=$_POST[perihal];?>'>
<input type=hidden name=lokasi value='<?=$_POST[lokasi];?>'>
<input type=hidden name=jenispptek value='<?=$_POST[jenispptek];?>'>
<input type=hidden name=keluhan value='<?=$_POST[keluhan];?>'>
<input type=hidden name=penyebab value='<?=$_POST[penyebab];?>'>
<input type=hidden name=jenisms value='20'>
<input type=hidden name=lokasi2 value='<?=$_POST[lokasi2];?>'>
   <div class="control-group">
    	<label class="control-label" for="aktiva">Pilih Aktiva</label>
        <div class="controls">
          	 <select id="aktiva" class="chzn-select span8" name="aktiva" required="required">
            	<option value='-' selected>Pilih/Ketik Cari > Nomor - Nama Aktiva/Inventaris</option>
            	<option value='-'>TIDAK ADA DI DALAM DAFTAR AKTIVA !</option>
            <?php
            
				//$vc = mysql_query("SELECT * FROM aktiva WHERE aklokasi=$_POST[lokasi] ORDER BY aknomor ASC");
				$vc = mysql_query("SELECT * FROM aktiva ORDER BY aknomor ASC");
				while ($dvc=mysql_fetch_array($vc)){
				$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE area_utama='$dvc[area_utama]' AND akkelomok2='Mesin dan peralatan pabrik/laboratorium'"));
	    	     	echo "<option value='$dvc[aknomor]'>$dvc[aknomor] - $dvc[aknama] - $dvc[akmerk]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="aktiva2">Nama Aktiva</label>
        <div class="controls"><input class="input-large focused span8" id="aktiva2" type="text" name="aktiva2" value=""><font color=red>Tulis disini, Jika tidak ada di daftar/pilih aktiva diatas.</font></div>
    </div>
  <!-- <div class="control-group">-->
		<!--<label class="control-label">Keluhan</label>-->
  <!--      <div class="controls">-->
  <!--          <textarea name='keluhan' class='input-large textarea' style='width: 610px; height: 100px'></textarea>-->
  <!--  </div>-->

  
   <div class="control-group">
		<label class="control-label" >Personil yg bisa dihubungi</label>
        <div class="controls"><input class="input-large focused span8" type="text" name="personil" value=""></div>
    </div>
    
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" onchange="lihatgambar(this);"><br>
        	<img id="blah" src="sinternal/notfound.png" alt="Gambar Preview" width="250" hight="250" /><br><br>
        	Max. 15 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
}
elseif($_GET[act]=="tambah4"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("RAB-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Memo Permohonan Pembelian Barang (RAB/PR)</legend>

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
		 <br><br>
		 <b>Jika atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$e[cId]' >$e[cNama]</option>
		</select>";
         ?> 
		 <br>
		 <b>Jika atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select" name="pengirim2">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$ef[cId]' >$ef[cNama]</option>
		</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
        </div> 
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Memo</label>
        <div class="controls">
            <input type=hidden name=jenisms value=19><b>Permohonan Pembelian Barang (RAB/PR)</b>
        </div> 
	</div>
	
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required" value="[RAB/PR] Permohonan Pembelian Bagian .... Bulan .... Tahun ...."></div>
    </div>
 
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo (Tekan Shift+Enter untuk pindah baris,<br> Ctrl+V Paste)</label>
        <div class="controls">
        	<textarea name="ket" id="editor" required="required">
Dengan Hormat,<br><br>

Mohon untuk dibuatkan permohonan pembelian (RAB/PR) bagian ... bulan ... tahun ..., sebagai berikut :<br>


<table border="1" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td style="text-align:center">No</td>
			<td style="text-align:center">Kode</td>
			<td style="text-align:center">Nama Barang</td>
			<td style="text-align:center">Jumlah</td>
			<td style="text-align:center">Keterangan</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
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
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
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
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>



Atas perhatian dan kerjasamanya kami ucapkan terima kasih.<br><br>

        	</textarea>
			</div>
        </div>
        
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
}elseif($_GET['act']=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'"));
// var_dump($e);die();
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
$usr = $_GET['usr'];
$status = $_GET['status'];

?>
<form method="post" action="include/spptek/aksi_sinter.php?act=edit2&usr=<?=$usr?>&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal" readonly="true">
<fieldset>
<legend>Edit Permohonan SPPTek</legend>
	<?
if($_SESSION['cv']==1000){
?>

    <div class="control-group">
		<label class="control-label" for="ns">Nomor SPPTek</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e['sinmr'];?>" ></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e['sitgl'];?>" required="required"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="pengirim">Pengirim 1</label>
        <div class="controls">
          	 <select id="pengirim" class="chzn-select span9" name="pengirim" required="required">
            	<option>Pilih Pengirim 1</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim]'"));
				echo"<option value='$e[sipengirim]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="pengirim2">Pengirim 2</label>
        <div class="controls">
          	 <select id="pengirim2" class="chzn-select span9" name="pengirim2" required="required">
            	<option>Pilih Pengirim 2</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim1]'"));
				echo"<option value='$e[sipengirim1]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="pengirim2">Pengirim 3</label>
        <div class="controls">
          	 <select id="pengirim2" class="chzn-select span9" name="pengirim3" required="required">
            	<option>Pilih Pengirim 3</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim2]'"));
				echo"<option value='$e[sipengirim2]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    
    <div class="control-group">
    	<label class="control-label" for="status">Status</label>
        <div class="controls">
          	 <select id="status" class="chzn-select span9" name="status" required="required">
            	<option>Pilih Status Terkirim</option>
				
            <?php
            if ($e['sstatus']=='Y') {
				echo"<option value='Y' selected>Terkirim</option>
				<option value='N'>Belum Terkirim</option>
				";
				}
				else {
				echo"<option value='Y'>Terkirim</option>
				<option value='N' selected>Belum Terkirim</option>
				";	
				}?>
           	</select>
        </div> 
	</div>
	
    

<?
echo"<input type=hidden name=jenisms value=$e[jenisms]>";
}
else

{
?>	
<input type=hidden name=jenisms value=<?=$e[jenisms];?>>
<input type=hidden name=pengirim value=<?=$e[sipengirim];?>>
<input type=hidden name=pengirim2 value=<?=$e[sipengirim1];?>>
<input type=hidden name=pengirim3 value=<?=$e[sipengirim2];?>>
<input type=hidden name=status value=<?=$e[sstatus];?>>
<?php
    if($_SESSION[cv]=='11' OR $_SESSION[cv]=='17'){
    		
    }else{
    	if(!empty($e[jenispptek])){
    		if(time() - strtotime($e[sitgl]) >= 3 * 86400){
			$disable = 'disabled';?>
<input type=hidden name=jenispptek value=<?=$e[jenispptek];?>>		
		<?php
    		}else{
    	
    		}
    	}else{
    		
    	}
    }
?>
<? 
	if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
?>
 <div class="control-group">
		<label class="control-label" for="ns">Nomor SPPTek</label>
        <div class="controls"><input class="input-large focused" id="sinmr" type="text" name="nomor" value="<?=$e[sinmr];?>" readonly></div>
    </div>
<?
}
else 
{
?>
 <div class="control-group">
		<label class="control-label" for="ns">Nomor SPPTek</label>
        <div class="controls"><?=$e[sinmr];?></div>
    </div>  
<?
}
?>
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[sitgl];?>" required="required"><? echo tgl_indo($e[sitgl]); ?></div>
    </div>
<?
}
?>

    <div class="control-group">
		<label class="control-label" for="keluhan">Keluhan</label>
        <div class="controls"><textarea tabindex="1" class="form-control" id="keluhan" style="width: 570px; height: 90px" type="text" name="keluhan" <?php echo $readonly ?>><?=$e[keluhan];?></textarea></div>
    </div>
  <!--  <div class="control-group">-->
		<!--<label class="control-label" for="keluhan">Keterangan</label>-->
  <!--      <div class="controls"><input class="input-xxlarge focused" id="siket_user" type="text" name="siket_user" value="<?php //echo $e[siket_user];?>"></div>-->
  <!--  </div>-->
    
    <div class="control-group">
    	<label class="control-label" for="lokasi">Pilih Lokasi</label>
        <div class="controls">
          	 <select id="lokasi" class="chzn-select span8" name="lokasi">
            	<option value=''>Pilih/Ketik Cari > Nomor - Area - Lokasi</option>
            	<option value='-'>TIDAK ADA DI DALAM DAFTAR GEDUNG/AREA/RUANGAN/KELOMPOK</option>
            <?php
            
                $lok = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$e[lokasi]'"));
                $loka = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$lok[area_utama]'"));
                echo "<option value='$e[lokasi]' selected>$e[lokasi] - $loka[nama_area] - $lok[nama_area]</option>";
				$vc = mysql_query("SELECT * FROM area ORDER BY id_area ASC");
				while ($dvc=mysql_fetch_array($vc)){
				$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$dvc[area_utama]'"));
				
	    	     	echo "<option value='$dvc[nomor_area]'>$dvc[nomor_area] - $lokasi[nama_area] - $dvc[nama_area]</option>";
				}
				
			?>
           	</select>
        </div> 
	</div>
       <div class="control-group">
		<label class="control-label" for="lokasi2">Kode/Lokasi</label>
        <div class="controls"><input class="input-large focused span8" id="lokasi2" type="text" name="lokasi2" value="<?=$e[lokasi];?>"></div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="aktiva">Pilih Aktiva</label>
        <div class="controls">
          	 <select id="aktiva" class="chzn-select span8" name="aktiva">
            	<option value=''>Pilih/Ketik Cari > Nomor - Nama Aktiva/Inventaris</option>
            	<option value='-'>TIDAK ADA DI DALAM DAFTAR AKTIVA !</option>
            <?php
           
                $aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE aknomor='$e[aktiva]'"));

                echo "<option value='$e[aktiva]' selected>$e[aktiva] - $aktiva[aknama] - $aktiva[akmerk]</option>";
                 
				$vc = mysql_query("SELECT * FROM aktiva ORDER BY aknomor ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[aknomor]'>$dvc[aknomor] - $dvc[aknama] - $dvc[akmerk]</option>";
				}
				
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="aktiva2">Nama/Kode Aktiva</label>
        <div class="controls"><input class="input-large focused span8" id="aktiva2" type="text" name="aktiva2" value="<?=$e[aktiva];?>"></div>
    </div>
  <!--  <div class="control-group">-->
		<!--<label class="control-label" for="keluhan">Keluhan</label>-->
  <!--      <div class="controls"><input class="input-xxlarge focused" id="keluhan" type="text" name="keluhan" value="<?php //echo $e[keluhan];?>"></div>-->
  <!--  </div>-->
    <div class="control-group">
		<label class="control-label" for="personil">Personil yg bisa dihubungi</label>
        <div class="controls"><input class="input-large focused span8" id="personil" type="text" name="personil" value="<?=$e[personil];?>"></div>
    </div>
    <!--<div class="control-group">-->
    <!--	<label class="control-label" for="ket">Ket. SPPTek (Tekan Shift+Enter untuk pindah baris)</label>-->
    <!--    <div class="controls">-->
		  <!-- <textarea name="ket" id="editor"><?php //echo $e[siket];?></textarea>-->
    <!--    </div>-->
    <!--</div>-->
	<!--<div class="control-group">-->
	<!--	<label class="control-label" for="siket_user">Keterangan (User & Teknik)</label>-->
 <!--       <div class="controls"><input class="input-xlarge focused" id="siket_user" type="text" name="siket_user" value="<?php //echo $e[siket_user];?>"></div>-->
 <!--   </div>-->
 
    <div class="control-group">
		<label class="control-label">Penyebab</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="penyebab" name="penyebab" style="width: 570px; height: 100px" placeholder="Isi Penyebab"><?php echo $e[penyebab]?></textarea>
        </div>
    </div>
<? 
	if ($_SESSION['cv']=='10' OR $_SESSION['cv']=='11' or $_SESSION['cv']=='12' or $_SESSION['cv']=='13' or $_SESSION['cv']=='14' or $_SESSION['cv']=='15' or $_SESSION['cv']=='16' or $_SESSION['cv']=='17' or $_SESSION['cv']=='18' or $_SESSION['cv']=='19' or $_SESSION['cv']=='20' or $_SESSION['cv']=='21' or $_SESSION['cv']=='80'){
?>

<?php if($_SESSION['cv']=='11' OR $_SESSION['cv']=='17'){?>
	  <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>  
			    <option value=''>Tidak Jadi Memilih</option>   
			    <option value='APL'>Perbaikan Alat Produksi & Lab (APL)</option>   
                <option value='MP'>Perbaikan Mesin Produksi (MP)</option>  
                <option value='LAK'>Perbaikan Listrik Arus Kuat (LAK)</option>
                <option value='LAL'>Perbaikan Listrik Arus Lemah (LAL)</option>
                <option value='GTK'>Perbaikan Kompressor (GTK)</option>
                <option value='SB'>Perbaikan Sipil Bangunan (SB)</option>
                <option value='BS'>Perbaikan Boiler & Steam (BS)</option>
                <option value='STUDC'>Perbaikan Sistem Tata Udara & Dust Collector (STUDC)</option>
                <option value='PA'>Perbaikan Pengolahan Air (PA)</option>
                <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	
                <option value='SPV'>TEST USER</option>	
           	</select>
        </div> 
	</div>
	<?php }elseif($_SESSION['cv']=='12'){?>
    <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
			    <option value=''>Tidak Jadi Memilih</option>   
			    <option value='APL'>Perbaikan Alat Produksi & Lab (APL)</option>
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='13'){?>
    <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>  
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='MP'>Perbaikan Mesin Produksi (MP)</option>  
                	
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='14'){?>
    <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option> 
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='LAL'>Perbaikan Listrik Arus Lemah (LAL)</option>	
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='15'){?>
    <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='LAK'>Perbaikan Listrik Arus Kuat (LAK)</option>
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='16'){?>
    <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='GTK'>Perbaikan Kompressor (GTK)</option>
                <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='18'){?>
    <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='STUDC'>Perbaikan Sistem Tata Udara & Dust Collector (STUDC)</option>
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='19'){?>
      <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option> 
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='BS'>Perbaikan Boiler & Steam (BS)</option>
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='20'){?>
      <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='SB'>Perbaikan Sipil Bangunan (SB)</option>
           	</select>
        </div> 
	</div>
    <?php }elseif($_SESSION['cv']=='21'){?>
      <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
			    <option value=''>Tidak Jadi Memilih</option>   
                <option value='PA'>Perbaikan Pengolahan Air (PA)</option>
           	</select>
        </div> 
	</div>
    <?php }?>
	  <div class="control-group">
    	<label class="control-label" for="pihak3">Pihak ke-3?</label>
        <div class="controls">
          	 <select id="pihak3" class="chzn-select span8" name="pihak3">
				
            <?php
            if ($e['pihak3']=='Y') {
				echo"
				<option value='Y' selected>Dikerjakan pihak ke-3</option>   
                <option value='N'>Dikerjakan internal</option>
				";
				}
			else {
				echo"
				<option value='Y'>Dikerjakan pihak ke-3</option>   
                <option value='N' selected>Dikerjakan internal</option>
				";
				}
				?>
				</select>
		</div> 
	</div>
	
		  <div class="control-group">
    	<label class="control-label" for="wp">Work Permit K3L?</label>
        <div class="controls">
          	 <select id="wp" class="chzn-select span8" name="wp">
				
            <?php
            if ($e[wp]=='Y') {
				echo"
				<option value='Y' selected>Perlu Work Permit</option>   
                <option value='N'>Tidak Perlu Work Permit</option>
				";
				}
			else {
				echo"
				<option value='Y'>Perlu Work Permit</option>   
                <option value='N' selected>Tidak Perlu Work Permit</option>
				";
				}
				?>
				</select>
		</div> 
	</div>
    
    <div class="control-group">
    	<label class="control-label" for="pihak3">Progress/ Status</label>
        <div class="controls">
          	 <select id="pihak3" class="chzn-select span8" name="sikomen2">
				
            <?php
            if ($e['sikomen2']=='Belum-Non Barang') {
				echo"
				<option value='Belum-Non Barang' selected>Tanpa Barang, Belum dikerjakan</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
			elseif ($e['sikomen2']=='Belum Cek') {
				echo"
				<option value='Belum Cek' selected>Belum di cek</option>
                <option value='Sedang Dikerajakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang'>Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
			elseif ($e['sikomen2']=='Menunggu Barang') {
				echo"
				<option value='Menunggu Barang' selected>Menunggu Barang</option> 
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
	        elseif ($e['sikomen2']=='Belum-Barang') {
				echo"
				<option value='Belum-Barang' selected>Barang Datang, Belum dikerjakan</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
	        elseif ($e['sikomen2']=='Selesai') {
				echo"
                <option value='Selesai' selected>Selesai (Close oleh Teknik dan User)</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
	        elseif ($e['sikomen2']=='Pending') {
				echo"
                <option value='Pending' selected>Pending/ Ditunda</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
	        elseif ($e['sikomen2']=='Tidak Jadi') {
				echo"
                <option value='Tidak Jadi' selected>Tidak Jadi/ Dibatalkan</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}	
	        elseif ($e['sikomen2']=='Rework') {
				echo"
                <option value='Rework' selected>Rework</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}	
			elseif ($e['sikomen2']=='Proses P3') {
				echo"
                <option value='Proses P3'selected>Proses Pihak ke-3</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}	
			elseif ($e['sikomen2']=='Close Teknik') {
				echo"
                <option value='Close Teknik' selected>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				<option value='Belum Cek'>Belum di cek</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
				";
				}	
			else {
				echo"
				<option value='$e[sikomen2]' selected>Pilih Progress/ Status</option>
                <option value='Sedang Dikerjakan'>Sedang Dikerjakan</option>
				<option value='Belum Cek'>Belum di cek</option>
		        <option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang'>Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
                <option value='Selesai'>Selesai (Close oleh Teknik dan User)</option>
                <option value='Close Teknik'>Close Karena Selesai Dikerjakan / Close Karena Dibatalkan</option>
				";
				}
				?>
				</select>
		</div> 
	</div>
	
	<div class="control-group">
		<label class="control-label">Tindakan Perbaikan</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="tindakan_perbaikan" name="tindakan_perbaikan" style="width: 570px; height: 100px" placeholder="Isi Tindakan Perbaikan Yang dilakukan"><?=$e['tindakan_perbaikan'];?></textarea>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label">Tindakan Pencegahan </label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="tindakan_pencegahan" name="tindakan_pencegahan" style="width: 570px; height: 100px" placeholder="Isi Tindakan Pencegahan yang dilakukan"><?=$e['tindakan_pencegahan']?></textarea>
        </div>
    </div>
    
	
	<div class="control-group">
		<label class="control-label" for="cek"><b>Di Cek Dan Dikerjakan Oleh</b></label>
        <div class="controls">
            <!--<input class="input-xlarge focused" id="komentar" type="text" name="siket_teknik" value="<?php //echo $e[siket_teknik];?>">-->
              <select class="chzn-select span8" name="siket_teknik[]" multiple="multiple">
                 <?php 
                 $expld = explode(",", $e['siket_teknik']);
                 foreach( $expld as $p){?>
          	 <option value='<?php echo $p ?>' selected><?php echo $p ?></option>
          	 <?php } ?>
                  <?php
                $pt = mysql_query("SELECT * FROM pegawai_teknik ORDER BY id_pegtek ASC");
				while ($lop=mysql_fetch_array($pt)){
	    	     	echo "<option value='$lop[nama]'>$lop[nama]</option>";
				}
				?>
                   
                    
            </select>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="pr">Kode PR</label>
        <div class="controls"><input class="input-xlarge focused" id="pr" type="text" name="pr" value="<?=$e['pr'];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="rfq">Kode RFQ</label>
        <div class="controls"><input class="input-xlarge focused" id="rfq" type="text" name="rfq" value="<?=$e['rfq'];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="po">Kode PO</label>
        <div class="controls"><input class="input-xlarge focused" id="po" type="text" name="po" value="<?=$e['po'];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kode_do">Kode DO</label>
        <div class="controls"><input class="input-xlarge focused" id="kode_do" type="text" name="kode_do" value="<?=$e['kode_do'];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="gr_entrysheet">Kode GR/Entry Sheet</label>
        <div class="controls"><input class="input-xlarge focused" id="gr_entrysheet" type="text" name="gr_entrysheet" value="<?=$e['gr_entrysheet'];?>"></div>
    </div>
<? /*  
		<div class="control-group">
    	<label class="control-label" for="Jenispptek">Di cek Oleh</label>
        <div class="controls">
            <select class="chzn-select" name="siket_teknik" >
            <option value='<?=$e[siket_teknik];?>' selected><?=$e[siket_teknik];?></option>  
            <option value='Bambang Iswahyudi'>Bambang Iswahyudi</option>   
            <option value='Firmansyah P'>Firmansyah P</option>  
            <option value='Suryaman'>Suryaman</option>
            <option value='Ardi Hardiyanto'>Ardi Hardiyanto</option>
            <option value='Suryana'>Suryana</option>
            <option value='Toni Yulianto'>Toni Yulianto</option>
            <option value='Deddy Sudiana'>Deddy Sudiana</option>
            <option value='Mental Subiarto'>Mental Subiarto</option> 
            <option value='Roni Raspati'>Roni Raspati</option>
            <option value='Udin Komaludin'>Udin Komaludin</option>
            <option value='Rahmat Dwi Subagia'>Rahmat Dwi Subagia</option>   
            <option value='Asep Hadiman'>Asep Hadiman</option>  
            <option value='Septhian Adhika'>Septhian Adhika</option>
            <option value='Ricky Hasbi'>Ricky Hasbi</option>
            <option value='Lili Djumeli'>Lili Djumeli</option>
            <option value='Kholip Pahrudin'>Kholip Pahrudin</option>
            <option value='Asep Saepudin'>Asep Saepudin</option>
            <option value='Andri Sukma'>Andri Sukma</option> 
            <option value='Eka Jatnika'>Eka Jatnika</option>
            <option value='Dohir Maulid'>Dohir Maulid</option>            
            <option value='Nandang Kurnia'>Nandang Kurnia</option>
            <option value='Hari Ramdani'>Hari Ramdani</option>            
            <option value='Maulana Yusuf'>Maulana Yusuf</option>
            </option>
            </select></b>.
        </div> 
	</div>    
*/ ?>    
    <?php
        $tanggal_cek = date("Y-m-d",strtotime($e['sitgl_cek']));
        // var_dump($tanggal_cek);die();
    ?>
   <div class="control-group">
		<label class="control-label" for="tgl_cek">Tanggal Cek</label>
        <div class="controls"><input id="tgl" type="date" class="input-xlarge focused" name="tgl_cek" value="<?php echo $e['sitgl_cek'] ?>"> Selesai Pengecekan (Tahun-Bulan-Tanggal !)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_order">Tanggal Buat Order/PR</label>
        <div class="controls"><input id="tgl" type="date" class="input-xlarge focused" name="tgl_order" value="<?= $e['sitgl_order']?>"> Selesai Buat Order</div>
    </div>
      <div class="control-group">
		<label class="control-label" for="tgl_brgdtg">Tanggal Barang Datang</label>
        <div class="controls"><input id="tgl" type="date" class="input-xlarge focused" name="tgl_brgdtg" value="<?=$e['sitgl_brgdtg'];?>"> Barang datang</div>
    </div>


    <div class="control-group">
		<label class="control-label" for="tgl_mulai">Tanggal Mulai</label>
        <div class="controls"><input  id="tgl" type="date" class="input-xlarge focused" name="tgl_mulai" value="<?=$e['sitgl_mulai'];?>"> SPPTek mulai dikerjakan</div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgl_selesai">Tanggal Selesai</label>
        <div class="controls"><input  id="tgl" type="date" class="input-xlarge focused" name="tgl_selesai" value="<?=$e['sitgl_selesai'];?>"> SPPTek selesai, disposisi konfirm ke user</div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgl_pending">Tanggal Pending</label>
        <div class="controls"><input  id="tgl" type="date" class="input-xlarge focused" name="tgl_pending" value="<?=$e['sitgl_pending'];?>"> SPPTek pending</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_rework">Tanggal Rework</label>
        <div class="controls"><input  id="tgl" type="date" class="input-xlarge focused" name="tgl_rework" value="<?=$e['sitgl_rework'];?>"> (Jika ada setelah 1 bulan selesai)</div>
    </div>
<?
}
else {
   echo"<input type=hidden name=tgl_cek value=$e[sitgl_cek]><input type=hidden name=tgl_mulai value=$e[sitgl_mulai]><input type=hidden name=tgl_selesai value=$e[sitgl_selesai]>";
}
?>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
        </div>
    </div>
    <? 
	    if ($_SESSION['cv']=='10' OR $_SESSION['cv']=='11' or $_SESSION['cv']=='12' or $_SESSION['cv']=='13' or $_SESSION['cv']=='14' or $_SESSION['cv']=='15' or $_SESSION['cv']=='16' or $_SESSION['cv']=='17' or $_SESSION['cv']=='18' or $_SESSION['cv']=='19' or $_SESSION['cv']=='20' or $_SESSION['cv']=='21' or $_SESSION['cv']=='80'){
    ?>
    <div class="control-group dynamic_form">
      <div class="controls"><button type="button" name="tambahin" id="tambahin" class="btn btn-warning text-white tambahin">Tambah Keterangan/ Barang Dan Teknik</button></div><br>
    </div>
    <?php 
	    }
    ?>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
    
    
</fieldset>
</form>
<div class"control-group">
        <?php $bmasuk = mysql_query("SELECT bt.*, sg.kode, sg.jumlah as stok FROM pesanan_barangtek bt LEFT JOIN barang_teknik sg ON sg.kode=bt.kode_barang  WHERE bt.id_spptek='$_GET[id]'");
        $bs = mysql_query("SELECT * FROM pesanan_barangtek WHERE id_spptek='$_GET[id]'");
        ?>
        <legend>Data Barang Teknik</legend>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Jumlah Dipesan</th>
                <th>Keterangan</th>
                <?php $m = mysql_fetch_array($bs) ?>
                <?php //if($m[status] != null){ ?>
                <th>Status</th>
                <?php //} ?>
                <th>Aksi</th>
            </tr>
            </thead>
             <tbody>
	<?php
	$i = 1;
		while($s = mysql_fetch_array($bmasuk)) { ?>
			<tr>
                <td><?php echo $i ?></td>
                <td><?php echo $s[kode_barang] ?></td>
                <td><?php echo $s[nama] ?></td>
                <td><?php echo $s[satuan] ?></td>
                <td><?php echo $s[jumlah] ?></td>
                <td><?php echo $s[keterangan] ?></td>
                <td>
				<?php echo isset($s[status]) ? $s[status] : '-'; ?>
				</td>
				<td>
					<a href='home.php?pages=sintertp&act=detailbarangtek&id= <?php echo $s[id_pesanantek] ?>'
						class='btn btn-info'>Baca!</a><br>
					<?php //if($s[status] == 'Approve' OR $s[status] == 'Barang Datang'){?>

					<?php //}else{?>
					<a href='home.php?pages=sintertp&act=editbarangtek&id=<?php echo $s[id_pesanantek] ?>'
						class='btn btn-info'>Update</a>
					<a href='include/spptek/aksi_sinter.php?act=hapusbarangtek&id=<?php echo $s[id_pesanantek] ?>' onClick=\"return
						confirm('Yakin ingin menghapus??')\" class='btn btn-warning'>Hapus</a>

					<?php //}?>
				</td>
            	
                </tr>
                <?php $i++;
				
	        
	    }

	?>
	</tbody>
        </table>
    </div>
	<? 
if ($_SESSION[cv]=='80' or $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13'  or $_SESSION[cv]=='14'  or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21'){
	?>
<br>
<center><b>ISI RIWAYAT ALAT/MESIN :</b>
	<form method="post" action='include/spptek/aksi_sintertp.php' target=_blank>
		<b>Thn-Bln-Tgl</b> :<input type="text" name="tgl" value="<? echo $e[sitgl] ?>"><br>
		PEMAKAIAN (utk Jam kerja alat), uraian :
		tulis angka/jumlah jam saja<br>PERBAIKAN : uraian isi perbaiki apa dan spare part apa diketerangan, kalau perlu
		no spptek<br>PEMELIHARAAN : uraian : pemeliharaan sesuai form ceklist, di Ket : Tulis jika ada tidak
		sesuai<br><br>
		<b>Nomor Aktiva </b> : <input type="text" name="qrcode" value="<?php echo $e[aktiva]; ?>"><br><br>
		<b>Pilih Jenis Riwayat</b> :</b><br><select name="jenis" />
		<option value=3>Mutasi/Pindah</option>
		<option value=4>Pinjam/Kembali</option>
		<option value=5>Rusak/5R/Pemusnahan</option>
		<option value=6>Pemakaian/Pembersihan</option>
		<option value=7>Kalibrasi/Adjust</option>
		<option value=1 selected>Perbaikan</option>
		<option value=2>Pemeliharaan</option>
		<option value=0>Lainnya</option></select><br><br>
		<b>Uraian Riwayat</b> :</b><br><input type="text" name="uraian"
			value="<?php echo $e[keluhan]?>" /><br><br>
		<b>Keterangan</b> :</b><br><input type="text" name="keterangan"
			value="<?php echo $e[penyebab]?>" /><br><br>
		<input class="btn btn-primary" type="submit" value="Isi Riwayat" />
	</form>
</center>
				    
<?php
}
}elseif($_GET[act]=="editbarangtek"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE id_brg_teknik='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/spptek/aksi_sinter.php?act=editbarangtek&id=<?=$e[id_brg_teknik];?>" enctype="multipart/form-data" class="form-horizontal">

<legend>Edit Barang Permohonan SPPTek</legend>
     	<div class="control-group"><div class="control-label">Kode</div><div class="controls"><b><input type="text" id="kode" name="kode" autofocus tabindex="1" class="form-control kode" value="<?=$e[kode];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Nama</div><div class="controls"><b><input type="text" id="nama" name="nama" autofocus tabindex="1" class="form-control nama" value="<?=$e[nama];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Jumlah Barang</div><div class="controls"><b><input type="text" id="nama" name="jumlah" autofocus tabindex="1" class="form-control jumlah" value="<?=$e[jumlah];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Keterangan</div><div class="controls"><b><textarea name="keterangan" tabindex="1" style="width: 400px; height: 90px" class="form-control"><?=$e[keterangan];?></textarea></b></div></div>
			<div class="control-group"><div class="control-label">Satuan</div><div class="controls"><b><select name="satuan" class="form-control m-bot15"><option value="M">M</option><option value="KG">KG</option><option value="CAN">CAN</option><option value="L">L</option><option value="BH">BH</option><option value="UNT">UNT</option><option value="SET">SET</option><option value="BTL">BTL</option><option value="TUB">TUB</option></select></option></select></div></b></div>
		
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

				    
<?php
//end edit barang tek
}
elseif($_GET[act]=="balas"){
    
$e = mysql_fetch_array(mysql_query("SELECT * FROM spptek WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));

$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/spptek/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Balas Memo</legend>
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
 <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
		 <br><br>
		 <b>Jika memo/undangan atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$e[cId]' >$e[cNama]</option>
		</select>";
         ?> 
		 <br>
		 <b>Jika memo/undangan atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select" name="pengirim2">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$ef[cId]' >$ef[cNama]</option>
		</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Memo/Undangan</label>
        <div class="controls">
          	 <select id="jenisms" name="jenisms" required="required" class="chzn-select span8">
            	<option value=0>Pilih/Cari Jenis Memo/Surat</option>
            <?php
				$vc = mysql_query("SELECT kode_jms, nama_jms FROM jenisms ORDER BY kode_jms ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jms]'>$dvc[nama_jms]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
<? $e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<? echo" Balas : $e[siperihal]";?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo/Undangan</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><br><? $sitgl=tgl_indo($e[sitgl]); echo" Berdasar Memo tanggal : $sitgl dari $ef[cIdjab] nomor : $e[sinmr] dengan isi memo : <br><blockquote>$e[siket]</blockquote>";?></textarea>
        </div>
    </div>
    
      <div class="control-group">
		<label class="control-label" for="komentar">Catatan Konseptor</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="sikomen"></div>
    </div>
    
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
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


<form method="post" action="include/sinter/aksi_sinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>List Penerima (Kepada & Tembusan) Memo Internal</legend>
	<div class="control-group">
    	<label class="control-label" for="psin">Penerima Memo (Kepada)</label>
        <div class="controls">
        	<select multiple="multiple" id="psin" name="psin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM psin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM psin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="psin">Penerima Tembusan</label>
        <div class="controls">
        	<select multiple="multiple" id="tstek" name="tstek[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM tstek WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM tstek WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
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

<? if($_SESSION[levelcv]==0){
    ?>

<form method="post" action="include/sinter/aksi_sinter.php?act=lpadmin&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah List Penerima (Kepada & Tembusan) Memo Internal (hapus dulu yang ada)</legend>
	<div class="control-group">
    	<label class="control-label" for="psin">Penerima Memo (Kepada)</label>
        <div class="controls">
        	<select multiple="multiple" id="psin" name="psin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM psin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM psin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="psin">Penerima Tembusan</label>
        <div class="controls">
        	<select multiple="multiple" id="tstek" name="tstek[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM tstek WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM tstek WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
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
<? } ?>
<br>

   <br>
	<b><u>Keterangan Lainnya :</u></b><br>
	1. Jika akan pilih semua klik tombol "Pilih Semua".<br><br>
	2. Jika akan menghapus semua yang telah dipilih klik tombol "Hapus Semua"<br><br>
<br>
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM spptek a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM spptek a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));

	?>
<strong>
<legend>Detail Surat Permohonan Perbaikan-Pembelian Teknik (SPPTek)</legend>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor </td>
		<td>: <?=$e[sinmr];?></td>
	</tr>
	<tr>
		<td>Tanggal </td>
		<td>: <?=tgl_indo($e[sitgl]);?></td>
	</tr>
	<tr>
		<td>Jenis Memo </td>
		<td>: <?=$efg[nama_jms];?></td>
	</tr>
	<tr>
		<td>Jenis SPPTek </td>
		<td>: <?=$e[jenispptek];?></td>
	</tr>
	<tr>
		<td>Pihak ke-3? </td>
		<td>: <?=$e[pihak3];?> (Jika dikerjakan pihak ke-3)</td>
	</tr>
	<tr>
		<td>Work Permit K3L? </td>
		<td>: <?=$e[wp];?> (Jika diperlukan work permit K3L)</td>
	</tr>
	<!--<tr><td>Perihal</td><td>: <?php //echo $e[siperihal];?></td></tr>-->
	<tr>
		<td>Keluhan</td>
		<td>: <?=$e[keluhan];?></td>
	</tr>
	<tr>
		<td>Penyebab </td>
		<td>: <?=$e[penyebab];?></td>
	</tr>
	<tr>
		<td>Tindakan Perbaikan </td>
		<td>: <?=$e[tindakan_perbaikan];?></td>
	</tr>
	<tr>
		<td>Tindakan Pencegahan </td>
		<td>: <?=$e[tindakan_pencegahan];?></td>
	</tr>
	<tr>
		<td>Personil Yang bisa Dihubungi</td>
		<td>: <?=$e[personil];?></td>
	</tr>
	<tr>
		<td>Tanggal Cek </td>
		<td>: <?=tgl_indo($e[sitgl_cek]);?></td>
	</tr>
	<tr>
		<td>Dicek oleh</td>
		<td>: <?=$e[siket_teknik];?></td>
	</tr>
	<tr>
		<td>Tanggal Mulai </td>
		<td>: <?=tgl_indo($e[sitgl_mulai]);?></td>
	</tr>
	<tr>
		<td>Tanggal Pending </td>
		<td>: <?=tgl_indo($e[sitgl_pending]);?></td>
	</tr>
	<tr>
		<td>Tanggal Selesai </td>
		<td>: <?=tgl_indo($e[sitgl_selesai]);?></td>
	</tr>
	<tr>
		<td>Tanggal Rework </td>
		<td>: <?=tgl_indo($e[sitgl_rework]);?> (Jika ada dalam 1 bulan)</td>
	</tr>
	<tr>
		<td>Tanggal Buat Order </td>
		<td>: <?=tgl_indo($e[sitgl_order]);?> (jika ada)</td>
	</tr>
	<tr>
		<td>Tanggal Datang Barang </td>
		<td>: <?=tgl_indo($e[sitgl_brgdtg]);?> (jika ada)</td>
	</tr>
	<tr>
		<td>Kode PR </td>
		<td>: <?=$e[pr];?></td>
	</tr>
	<tr>
		<td>Kode RFQ </td>
		<td>: <?=$e[kode_rfq];?></td>
	</tr>
	<tr>
		<td>Kode PO </td>
		<td>: <?=$e[po];?></td>
	</tr>
	<tr>
		<td>Kode DO </td>
		<td>: <?=$e[kode_do];?></td>
	</tr>
	<tr>
		<td>Kode GR/Entry Sheet </td>
		<td>: <?=$e[gr_entrysheet];?></td>
	</tr>
	<tr>
		<td>Status SPPTek : </td>
		<td>: <?=$e[sikomen2];?></td>
	</tr>
	<tr>
		<td>Keterangan User : </td>
		<td>: <?=$e[siket_user];?> <br> (<?= $e[komen_user]?>)</td>
	</tr>
	<tr>
		<td>Lampiran</td>
		<td>: <a title="Lampiran" href="sinternal/<?=$e[sifile];?>">Klik Disini (Jika Ada)
				<br>
				<?php if($e[sifile] != null){?>
				<img src="sinternal/<?=$e[sifile];?>" alt="lampiran" width="150" height="150">
				<?php } ?>
		</td>
		</td>
	</tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cJabatan];?>) / <?=$e[cNama];?> (<?=$e[cJabatan];?>)</strong></td></tr>
	<tr><td>Status</td><td>: <strong>
<?
if ($e[sstatus]=='N')
{
	echo"Belum Terkirim (Tanda tangan/ ACC $e[cJabatan] = $e[accsipengirim1])";
}
else
{
	echo"Terkirim";
}
?>
	</strong></td></tr>
	</table>
	<br></strong>
	<div class"control-group">
        <?php $bmasuk = mysql_query("SELECT * FROM barang_teknik WHERE idspptek='$_GET[id]'"); ?>
        <legend>Data Barang Teknik</legend>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14"
        	width="100%">
        	<thead>
        		<tr>
        			<th>No</th>
        			<th>Kode Barang</th>
        			<th>Nama Barang</th>
        			<th>Satuan</th>
        			<th>Jumlah</th>
        			<th>Keterangan</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php
	$i = 1;
		while($s = mysql_fetch_array($bmasuk)) { ?>
        		<tr>
        			<td><?php echo $i ?></td>
        			<td><?php echo $s[kode] ?></td>
        			<td><?php echo $s[nama] ?></td>
        			<td><?php echo $s[satuan] ?></td>
        			<td><?php echo $s[jumlah] ?></td>
        			<td><?php echo $s[keterangan] ?></td>
        			<?php //}?>
        		</tr>
        		<?php $i++;
				
	    }
		?>
        	</tbody>
        	</table>
    </div>
	<table width="100%">
		<tr>
			<td align=top><b>Ket SPPTek :</b></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<? if ($e[lokasi]=='-' OR $e[lokasi]!=''){
$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$e[lokasi]'"));
$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE aknomor='$e[aktiva]'"));
?>
				Dengan Hormat,<br><br>

				Mohon bantuannya untuk dapat diperbaiki/ dibuat/ diganti/ dibeli* (*Coret salah satu) sebagai berikut
				:<br><br>

				<b>No Aktiva</b> :
				<? echo"$aktiva[aknomor]"; ?><br>
				<b>Nama Aktiva</b> :
				<? echo"$e[aktiva] - $aktiva[aknama] "; ?><br>
				<b>Lokasi</b> :
				<? echo"$e[lokasi] - $lokasi[nama_area] "; ?><br>
				<? } ?>
				<br>
				<b>Keluhan :</b> <?=$e[keluhan];?><br>
				<b>Personil yang bisa dihubungi :</b> <?=$e[personil];?><br><br>

				<?php //echo $e[siket];?></td>
		</tr>
	</table>

<br />
<legend>Kepada :</legend>
<table class="table table-bordered table-striped" width="100%">
	<thead>
		<td width="30%">User</td>
		<td>Nama</td>
		<td>Tanggal Dibaca</td>
	</thead>
	<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cFoto, a.cJabatan,b.tgl_baca FROM users a
						LEFT JOIN pstek b ON b.cId=a.cId
						WHERE b.spptek_id='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM pstek WHERE spptek_id='$_GET[id]'");
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
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama] ($t[cJabatan])
				</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 </tr>";
	}
	?>
</table>
<br />
<big>Jumlah Penerima : <?=$j;?> Orang</big>

<br /><br /><br />
<legend>Tembusan :</legend>
<table class="table table-bordered table-striped" width="100%">
<thead>
	<td width="30%">User</td>
    <td>Nama</td>
	<td>Tanggal Dibaca</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama, a.cIdjab, a.cFoto,b.tgl_baca FROM users a
						LEFT JOIN tstek b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM tstek WHERE siid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$k++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		echo "<tr>
				<td>$t[cJabatan]</td>
				<td>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama]  ($t[cUser])
				</td>
				
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 </tr>";
	}
	?>
</table>
<br />
<big>Jumlah Penerima : <?=$k;?> Orang</big>
<br><br>
            <?php
            // $user = mysql_fetch_array(mysql_query(
            //     sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
            // ));
            ?>
            <!--<div style="display: flex; align-items: center; justify-content: end;">-->
            <!--    <button-->
            <!--        spawner-->
            <!--        scheme="https"-->
            <!--        host="thread.ekfpb.com"-->
            <!--        user="<?php //echo $user['session']?>"-->
            <!--        app="teknik"-->
            <!--        foreign="<?php //echo $_GET['id']?>"-->
            <!--        style="background-color: rgb(6 182 212); border: none; border-radius: 0.375rem; padding: 0.25rem 0.75rem; font-size: 0.875rem; line-height: 1.25rem; color: white; transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 300ms; text-transform: uppercase; font-weight: 600; cursor: pointer;">-->
            <!--            Diskusi-->
            <!--    </button> &nbsp;-->
            
<? echo"<a href='home1.php?pages=sintertp&act=print&id=$e[siid]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
</div>
<?
} //Detail Barang Teknik
elseif($_GET[act]=="detailbarangtek"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM barang_teknik a,spptek b WHERE a.idspptek=b.siid AND a.id_barang_teknik='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE id_brg_teknik='$_GET[id]'"));
	
	?>
<strong>
<legend>Detail Barang Teknik</legend>
<table width="100%" border=1>
	<tr>
		<td width="24%">Kode Barang </td>
		<td>: <?=$efg[kode];?></td>
	</tr>
	<tr>
		<td>Nama Barang </td>
		<td>: <?=$efg[nama];?></td>
	</tr>
	<tr>
		<td>Jumlah </td>
		<td>: <?=$efg[jumlah];?></td>
	</tr>
	<tr>
		<td>Satuan </td>
		<td>: <?=$efg[satuan];?></td>
	</tr>
	<tr>
		<td>Keterangan </td>
		<td>: <?=$efg[keterangan];?></td>
	</tr>
</table>
<?
}//end detail barang teknik

//Approve Barang Teknik
elseif($_GET[act]=="approvepesananbrg"){
	$e 			= mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM pesanan_barangtek a,spptek b WHERE a.id_spptek=b.siid AND a.id_spptek='$_GET[id]'"));
	$efg 		= mysql_fetch_array(mysql_query("SELECT * FROM pesanan_barangtek WHERE id_spptek='$_GET[id]'"));
	$pesanan 	= mysql_query("SELECT distinct 
	                        bt.id_pesanantek, 
	                        bt.id_spptek, 
	                        bt.nama, 
	                        bt.kode_barang,
	                        bt.keterangan, 
	                        bt.status,
	                        bt.satuan,
	                        bt.jumlah,
	                        -- sg.jumlah as stok, 
	                        -- ts.stok_masuk, 
	                        -- ts.stok_keluar,
	                        sp.sinmr,
	                        sp.pr,
	                        sp.siid
	                        FROM pesanan_barangtek bt
	                        LEFT JOIN spptek sp ON bt.id_spptek=sp.siid
	                        -- LEFT JOIN stok_gudang_barang_teknik sg ON bt.kode=sg.kode_barang
	                        -- LEFT JOIN transaksi_stok_teknik ts ON bt.kode=ts.kode_barang
	                        WHERE bt.id_spptek LIKE '$_GET[id]'
	                        ");
	$pes 	= mysql_fetch_array(mysql_query("SELECT distinct 
	                        bt.id_pesanantek, 
	                        bt.id_spptek, 
	                        bt.nama, 
	                        bt.kode_barang, 
	                        bt.keterangan, 
	                        bt.status,
	                        bt.jumlah,
	                        -- sg.jumlah as stok, 
	                        -- ts.stok_masuk, 
	                        -- ts.stok_keluar,
	                        sp.sinmr,
	                        sp.pr,
	                        sp.siid
	                        FROM pesanan_barangtek bt
	                        LEFT JOIN spptek sp ON bt.id_spptek=sp.siid
	                        -- LEFT JOIN stok_gudang_barang_teknik sg ON bt.kode=sg.kode_barang
	                        -- LEFT JOIN transaksi_stok_teknik ts ON bt.kode=ts.kode_barang
	                        WHERE bt.id_spptek LIKE '$_GET[id]'
	                        "));
// 	$pesan = mysql_fetch_array($pes);
	?>
<strong>
	<legend>Approve Pemesanan SPPTEK ( <quote><?php echo $pes[sinmr] ?></quote> )</legend>
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Jumlah Dipesan</th>
				<th>Satuan</th>
				<th>Keterangan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?
                
	    $i = 1;
		while($s = mysql_fetch_array($pesanan)) {
			if($s[status]==''){
				echo "<tr class='success'>";
			}else{
				echo "<tr>";
			}
			echo "
			
                <td>$i</td>
                <td>$s[kode_barang]</td>
                <td>$s[nama]</td>
                <td>$s[jumlah]</td>
                <td>$s[satuan]</td>
                <td>$s[keterangan]</td>
                <td>$s[status]</td>
                
                </tr>";
				$i++;
	    }

	?>
		</tbody>
	</table>
	<br>
	<br>
	<form method="post" action="include/spptek/aksi_sinter.php?act=approvebarang" enctype="multipart/form-data"
		class="form-horizontal" onsubmit="return validasi_input(this)">

		<fieldset>
		    
			<input type="hidden" name="kode_barang" value="<?php echo $efg[kode_barang]; ?>">
			<input type="hidden" name="nama" value="<?php echo $efg[nama]; ?>">
			<input type="hidden" name="jumlah" value="<?php echo $efg[jumlah]; ?>">
			<input type="hidden" name="satuan" value="<?php echo $efg[satuan];?>">
			<input type="hidden" name="keterangan" value="<?php echo $efg[keterangan];?>">
			<input type="hidden" name="siid" value="<?php echo $pes[siid]; ?>">
		
			<div class="control-group">
				<div class="controls">
					<button class="btn btn-primary pull-right" id="btn" onClick=\"return confirm('Yakin!! Approve Pemesanan
						Barang Teknik??')\">Approve Pemesanan</button>
				</div>
			</div>
		</fieldset>
	</form>
<?
}//end approve barang teknik

//Masuk Barang Teknik
elseif($_GET[act]=="approvebarangtek"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM pesanan_barangtek a,spptek b WHERE a.id_spptek=b.siid AND a.id_pesanantek='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT * FROM pesanan_barangtek WHERE id_pesanantek='$_GET[id]'"));
	
	?>
<strong>
	<legend>Masukkan Sebagai Stok Gudang Barang Teknik</legend>
	<table width="50%" border="0">
		<tr>
			<td width="24%">Kode Barang </td>
			<td>: <?=$efg[kode_barang];?></td>
		</tr>
		<tr>
			<td>Nama Barang </td>
			<td>: <?=$efg[nama];?></td>
		</tr>
		<tr>
			<td>Jumlah </td>
			<td>: <?=$efg[jumlah];?></td>
		</tr>
		<tr>
			<td>Satuan </td>
			<td>: <?=$efg[satuan];?></td>
		</tr>
		<tr>
			<td>Tanggal Pemesanan </td>
			<td>: <?=$efg[tgl_pesanbrg];?></td>
		</tr>
		<tr>
			<td>Keterangan </td>
			<td>: <?=$efg[keterangan];?></td>
		</tr>
	</table>
	<br>
	<br>
	<form method="post" action="include/spptek/aksi_sinter.php?act=approvestok" enctype="multipart/form-data"
		class="form-horizontal" onsubmit="return validasi_input(this)">

		<fieldset>

			<input type="hidden" name="kode_barang" value="<?php echo $efg[kode_barang]; ?>">
			<input type="hidden" name="nama" value="<?php echo $efg[nama]; ?>">
			<input type="hidden" name="jumlah" value="<?php echo $efg[jumlah]; ?>">
			<input type="hidden" name="satuan" value="<?php echo $efg[satuan];?>">
			<input type="hidden" name="keterangan" value="<?php echo $efg[keterangan];?>">
			<input type="hidden" name="idspptek" value="<?php echo $efg[id_spptek];?>">
			<input type="hidden" name="idpesanantek" value="<?php echo $efg[id_pesanantek];?>">

			<div class="control-group">
				<div class="controls">
					<button class="btn btn-primary" id="btn" onClick=\"return confirm('Yakin Akan Menambahkan ke
						Stok??')\">Barang Telah Datang</button>
				</div>
			</div>
		</fieldset>
	</form>
<?
}//end approve barang teknik

else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=sintertp&act=tambah3'">Buat SPPTek</button><br /><br />
	<?php
	}
	?>

	<?php
	if($_SESSION[levelcv]==0){
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM spptek a, users b WHERE a.sipengirim=b.cId ORDER BY a.siid ASC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Dibuat/ ACC</th>
						<th>Perihal SPPTek</th>
						<th>Jenis PPTek</th>
						<th>Lampiran</th>
						<th>Status</th>
						<th class='center'>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?
		while($s = mysql_fetch_array($smasuk)) {
		echo "<tr>
				<td>";echo tgl_indo($s[sitgl]);echo"</td>
                <td>$s[cNama]</td>
                <td>$s[keluhan]</td>
				<td>$s[jenispptek]<br><a href='?pages=sintertp&act=lp&id=$s[siid]' class='btn btn-info'>List</a></td>
                <td><a href='sinternal/$s[sifile]'>File</a></td>";
				if ($s[sstatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/spptek/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=sintertp&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=sintertp&act=detail&id=$s[siid]' title=DetailMemo> Detail</a>";?>

					<?php echo "</td>
				</tr>";	
		}
	}
	else {
	$smasuk = mysql_query("SELECT * FROM spptek WHERE sipengirim=$_SESSION[cv] OR sipengirim1=$_SESSION[cv] OR sipengirim2=$_SESSION[cv] AND accsipengirim1='Y' ORDER BY sitgl DESC");
	
/*$smasuk1 = mysql_query("SELECT a.*, b.cNama FROM sinter a, users b WHERE a.sipengirim=$_SESSION[cv] AND a.sipengirim1=$_SESSION[cv]");
	$s1 = mysql_fetch_array($smasuk1);
	*/
     ?>
	<div style="width:auto;overflow-x:auto;">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14"
						width="100%">
						<thead>
							<tr>
								<th></th>
								<th>Tanggal</th>
								<th>No Spptek</th>
								<th>Keluhan SPPTek</th>
								<th>Jenis</th>
								<th>Status</th>
								<th>Tgl Cek</th>
								<th>Tgl Mulai</th>
								<th>Status & Tgl Slesai</th>
								<th class='center'>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?
            	
		while($s = mysql_fetch_array($smasuk)) {
		    if ($s[jenisms]=='20'){
			if ($s[sstatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr><font>";
		}
		echo "  <td>$s[sstatus]</td>
		<td>";echo tgl_indo($s[sitgl]);echo"</td>
                 <td><font size=2>$s[sinmr]</font></td>
                <td>$s[keluhan]</td>
				<td><b>$s[jenispptek]</b></td>";
				if ($s[sstatus]=='N'){
					if ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/spptek/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim SPPTek ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/spptek/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&usr=usr&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>";?>
							<?php echo"
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/spptek/aksi_sinter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC dan lanjut ke Atasan??')\" class='btn btn-info'>ACC !</a></td>
			<td class='center'><a href='include/spptek/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&usr=usr&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/spptek/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC ?')\" class='btn btn-info'>ACC !</a></td>
			<td class='center'><a href='include/spptek/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&usr=usr&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum ACC AM</b></td>
			<td class='center'><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/spptek/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim SPPTek ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/spptek/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&usr=usr&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					else {
						if ($s[sipengirim]==$s[sipengirim1]) {
			echo "<td>
			<a href='include/spptek/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim SPPTek ini??')\" class='btn btn-info'>ACC/Kirim!</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum ACC/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/spptek/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&usr=usr&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td>";?>


							<td>
							</td>

							<?php
					}
			
			}	else{
			echo "<td><b>Terkirim</b></td>
			<td>$s[sitgl_cek]</td>
				<td>$s[sitgl_mulai]</td><td>";?>



							<?php
	        if ($s[sipengirim]==$s[sipengirim1]) {?>
	        Status <?php echo"$s[sikomen2] <br>"; 
	        if($s[sitgl_selesai2]=='0000-00-00' AND $s[sikomen2]=='Close Teknik'){ ?>
							<br><br>
							<form method="post" action="include/spptek/aksi_sinter.php?act=closespptekusr&id=<?=$s[siid];?>"
								enctype="multipart/form-data">
								<div class="control-group">
									<div class="controls">
										<!--<input type="text" placeholder="puas/tidak puas/komentar lain" class="input-small" id="siket_user" name="siket_user">-->
										<div class="control-group">
											<label class="control-label" for="siket_user">Pilih Kepuasan</label>
											<div class="controls">
												<select class="chzn-select span12" placeholder="Pilih puas/tidak"
													name="siket_user">
													<option value='<?php echo $s[siket_user]?>' selected>
														<?php echo $s[siket_user]?></option>
													<option value="Puas">Puas</option>
													<option value="Tidak Puas">Tidak Puas</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="siket_user">Komentar User <span
													style="color: red">*</span></label>
											<div class="controls">
												<input type="text" class="input-small" placeholder="Tuliskan Komentar"
													name="komen_user" value="<?php echo $s[komen_user]?>" required>
											</div>
										</div>
										<button class="btn btn-primary">Close</button>
									</div>
							</form>
							<?php	
                }else{
            	    echo"<br>$s[sitgl_selesai2]";
            	}
	            
	        }elseif($_SESSION['bagian2']=='PTK'){?>
	            <b>Status</b> : <?php echo"$s[sikomen2] <br>"; 
	            
            	    echo"<br>$s[sitgl_selesai2]";
            	    ?>
	        <?php
	            
	        }
            	
			
				echo "</td>
				<td class='center'><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>";?>
							<?php echo "
				</td>
				</tr>";	
	}
	}
	}
	}
	
	?>
						</tbody>
					</table>
</div>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>KONSEP SPPTEK BELUM TERKIRIM/ACC!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail SPPTEK,<br>
	Cara Koreksi/EDIT dan Lihat Komentar Konseptor/ atasan yaitu dengan Klik <u>TOMBOL Koreksi/Komen</u> di kolom Penerima dan Aksi,<br> 
	Untuk ACC atau Kirim SPPTEK Klik Link di kolom Status : <u>ACC/KIRIM !</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->
<?php $select = mysql_query("SELECT kode, nama FROM barang_teknik"); ?>
<?php
$act=$_GET[act];
if($act=='closespptekusr'){
    $tgl_sekarang = date("Y-m-d");
    $tanggal = $_POST['sitgl_selesai2'];
    $updt = mysql_query("UPDATE spptek SET sikomen2 = 'Selesai', siket_user = '$_POST[siket_user]', komen_user = '$_POST[komen_user]', sitgl_selesai2 = '$tgl_sekarang' WHERE siid = '$_GET[id]'");
        
        if ($updt){
        	echo "<script>window.alert('Komentar SPPTek Berhasil Disimpan..');</script>";
        }
        else {
            echo "<script>window.alert('Data Komentar Gagal Disimpan...');</script>"; 
        }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script>
        let button = document.getElementById("btnn")
        let input = document.getElementById("keluhan", "lokasi")
        input.addEventListener("input", function(e) {
        	if(input.value.length < 40) {
              	button.disabled = true
              } else {
              	button.disabled = false
              }
        });
        
        
     function lihatgambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    
    $(document).ready(function() {
	
		var i = 1;
		$('.tambahin').click(function() {
			i++;
			$('.dynamic_form').append(
				'<div id="row' + i + '" class="control-group"><div class="control-label">Kode</div><div class="controls"><b><input type="text" onchange="getdata' + i + '(this.value,0)" placeholder="Pilih / Tulis Kode" id="kode" name="kode[]" autofocus tabindex="1" class="chzn-select open-data" list="kd"><datalist id="kd"><?php while($a=mysql_fetch_array($select)){ ?><option value="<?php echo $a[kode]; ?>"><?php echo $a[kode]; ?> - <?php echo $a[nama]; ?></option><?php } ?></datalist></b> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus</button></div></div>',
			'<div id="row2' + i + '" class="control-group"><div class="control-label">Nama</div><div class="controls"><b><input type="text" id="nama' + i + '" name="nama[]" autofocus tabindex="1" class="input-xlarge form-control nama"></b></div></div>',
			'<div id="row3' + i + '" class="control-group"><div class="control-label">Jumlah Barang</div><div class="controls"><b><input type="text" id="jumlah" name="jumlah[]" autofocus tabindex="1" class="input-xlarge form-control jumlah"></b></div></div>',
			'<div id="row5' + i + '" class="control-group"><div class="control-label">Satuan</div><div class="controls"><b><input type="text" placeholder="Pilih / Tulis Satuan" id="satuan' + i + '" name="satuan[]" autofocus tabindex="1" class="chzn-select open-data" list="satu"><datalist id="satu"><option value="-">Pilih Satuan</option><option value="M">Meter</option><option value="KG">Kilogram</option><option value="CAN">CAN</option><option value="L">Liter</option><option value="BH">Buah</option><option value="UNT">Unit</option><option value="SET">SET</option><option value="BTL">Botol</option><option value="TUB">TUB</option></datalist></div></b></div>',
			'<div id="row7' + i + '" class="control-group"><div class="control-label">Keterangan</div><div class="controls"><b><textarea name="keterangan[]" tabindex="1" style="width: 400px; height: 90px" class="form-control"><?=$e[sinmr];?> </textarea></b></div></div>',
			'<div id="row4' + i + '"><hr></div>'

			);
		});
		

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
			$('#row2' + button_id + '').remove();
			$('#row3' + button_id + '').remove();
			$('#row4' + button_id + '').remove();
			$('#row5' + button_id + '').remove();
			$('#row6' + button_id + '').remove();
			$('#row7' + button_id + '').remove();
			$('#row8' + button_id + '').remove();
		});
		$('#submit').click(function() {
			$.ajax({
				url: "aksi.php",
				method: "POST",
				data: $('#form_hasil').serialize(),
				success: function(response) {
					alert(response);
					$('#form_hasil')[0].reset();
					console.log(response);
				},

				error: function(response) {

					Swal.fire({
						icon: 'error',
						title: '3rrrr0rr..!',
						text: 'Server error!'
					});

					console.log(response);

				}
			});
		});

	});

	function getdata1(isi) {
		$.ajax({
			url: "include/spptek/aksi_sinter.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#nama1').val(data.nama);
				$('#satuan1').val(data.satuan);

			}
		});
	};
	function getdata2(isi) {
		$.ajax({
			url: "include/spptek/aksi_sinter.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#nama2').val(data.nama);
				$('#satuan2').val(data.satuan);

			}
		});
	};
	function getdata3(isi) {
		$.ajax({
			url: "include/spptek/aksi_sinter.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#nama3').val(data.nama);
				$('#satuan3').val(data.satuan);

			}
		});
	};
	function getdata4(isi) {
		$.ajax({
			url: "include/spptek/aksi_sinter.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#nama4').val(data.nama);
				$('#satuan4').val(data.satuan);

			}
		});
	};
	function getdata5(isi) {
		$.ajax({
			url: "include/spptek/aksi_sinter.php?act=coba&id=" + isi,
			type: "get",
			dataType: "JSON",
			success: function (data) {
				$('#nama5').val(data.nama);
				$('#satuan5').val(data.satuan);

			}
		});
	};
	
	
</script>