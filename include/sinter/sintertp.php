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

$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("M-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

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
}
elseif($_GET[act]=="tambah3"){

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
$newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);

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
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
		 <br><br>
		 <b>Jika SPPTek atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
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
     
		echo"</select>";
         ?> 
		 <br>
		 <b>Jika SPPTek atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select" name="pengirim2">
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
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal SPPTek</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required" value="[SPPTEK]..."></div>
    </div>
    
 	<div class="control-group">
    	<label class="control-label" for="lokasi">Pilih Lokasi</label>
        <div class="controls">
          	 <select id="lokasi" class="chzn-select span12" name="lokasi" required="required">
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
        <div class="controls"><input class="input-large focused" id="lokasi2" type="text" name="lokasi2" value=""><font color=red>Tulis disini, Jika tidak ada di daftar/pilih lokasi diatas</font></div>
    </div>
   <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Lanjut</button> 
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

$query = "SELECT max(sinmr) as max_no FROM sinter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah2" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">
<fieldset>
<input type=hidden name=tgl value='<?=$_POST[tgl];?>'>
<input type=hidden name=pengirim value='<?=$_POST[pengirim];?>'>
<input type=hidden name=pengirim1 value='<?=$_POST[pengirim1];?>'>
<input type=hidden name=pengirim2 value='<?=$_POST[pengirim2];?>'>
<input type=hidden name=perihal value='<?=$_POST[perihal];?>'>
<input type=hidden name=lokasi value='<?=$_POST[lokasi];?>'>
<input type=hidden name=jenispptek value='<?=$_POST[jenispptek];?>'>
<input type=hidden name=jenisms value='20'>
<input type=hidden name=lokasi2 value='<?=$_POST[lokasi2];?>'>
   <div class="control-group">
    	<label class="control-label" for="aktiva">Pilih Aktiva</label>
        <div class="controls">
          	 <select id="aktiva" class="chzn-select span12" name="aktiva" required="required">
            	<option value='-' selected>Pilih/Ketik Cari > Nomor - Nama Aktiva/Inventaris</option>
            	<option value='-'>TIDAK ADA DI DALAM DAFTAR AKTIVA !</option>
            <?php
            
				//$vc = mysql_query("SELECT * FROM aktiva WHERE aklokasi=$_POST[lokasi] ORDER BY aknomor ASC");
				$vc = mysql_query("SELECT * FROM aktiva ORDER BY aknomor ASC");
				while ($dvc=mysql_fetch_array($vc)){
				$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM  WHERE area_utama='$dvc[area_utama]'"));
	    	     	echo "<option value='$dvc[aknomor]'>$dvc[aknomor] - $dvc[aknama] - $dvc[akmerk]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="aktiva2">Nama Aktiva</label>
        <div class="controls"><input class="input-large focused" id="aktiva2" type="text" name="aktiva2" value=""><font color=red>Tulis disini, Jika tidak ada di daftar/pilih aktiva diatas.</font></div>
    </div>
   <div class="control-group">
		<label class="control-label">Keluhan</label>
        <div class="controls">
            <textarea name='keluhan' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>
   <div class="control-group">
		<label class="control-label" >Personil yg bisa dihubungi</label>
        <div class="controls"><input class="input-large focused" type="text" name="personil" value=""></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Keterangan/Barang Teknik</label>
        <div class="controls">
        	<textarea name="ket" id="editor" required="required">
<b>Jika <u>pengadaan barang/jasa</u> PR teknik (Isi disini) :</b>
<table border="1" cellpadding="1" cellspacing="1" style="width:700px">
	<tbody>
		<tr>
			<td style="text-align:center">No</td>
			<td style="text-align:center">Kode</td>
			<td style="text-align:center">Nama Barang/ Jasa</td>
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
	</tbody>
</table>

Demikian bantuan dan kerjasamanya kami ucapkan terima kasih.<br>
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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/sinter/aksi_sinter.php?act=edit2&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Permohonan SPPTek</legend>
	<?
if($_SESSION[cv]==1000){
?>
    <div class="control-group">
		<label class="control-label" for="ns">Nomor SPPTek</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e[sinmr];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[sitgl];?>" required="required"></div>
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
            if ($e[sstatus]=='Y') {
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
<? 
	if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
?>
 <div class="control-group">
		<label class="control-label" for="ns">Nomor SPPTek</label>
        <div class="controls"><input class="input-large focused" id="sinmr" type="text" name="nomor" value="<?=$e[sinmr];?>"></div>
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
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[siperihal];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="lokasi">Pilih Lokasi</label>
        <div class="controls">
          	 <select id="lokasi" class="chzn-select span12" name="lokasi">
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
        <div class="controls"><input class="input-large focused" id="lokasi2" type="text" name="lokasi2" value="<?=$e[lokasi];?>"></div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="aktiva">Pilih Aktiva</label>
        <div class="controls">
          	 <select id="aktiva" class="chzn-select span12" name="aktiva">
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
        <div class="controls"><input class="input-large focused" id="aktiva2" type="text" name="aktiva2" value="<?=$e[aktiva];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="keluhan">Keluhan</label>
        <div class="controls"><input class="input-xxlarge focused" id="keluhan" type="text" name="keluhan" value="<?=$e[keluhan];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="personil">Personil yg bisa dihubungi</label>
        <div class="controls"><input class="input-large focused" id="personil" type="text" name="personil" value="<?=$e[personil];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ket. SPPTek (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><?=$e[siket];?></textarea>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="siket_user">Keterangan (User & Teknik)</label>
        <div class="controls"><input class="input-xlarge focused" id="siket_user" type="text" name="siket_user" value="<?=$e[siket_user];?>"></div>
    </div>
<? 
	if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
?>

	  <div class="control-group">
    	<label class="control-label" for="status">Jenis SPPTek</label>
        <div class="controls">
          	 <select id="jenispptek" class="chzn-select span5" name="jenispptek">
          	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>  
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
           	</select>
        </div> 
	</div>

	  <div class="control-group">
    	<label class="control-label" for="pihak3">Pihak ke-3?</label>
        <div class="controls">
          	 <select id="pihak3" class="chzn-select span3" name="pihak3">
				
            <?php
            if ($e[pihak3]=='Y') {
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
          	 <select id="wp" class="chzn-select span4" name="wp">
				
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
		<label class="control-label" for="komentar">No.<b>Order/PR SAP</b></label>
        <div class="controls"><input class="input-xlarge focused" id="komentar" type="text" name="sikomen" value="<?=$e[sikomen];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="pihak3">Progress/ Status</label>
        <div class="controls">
          	 <select id="pihak3" class="chzn-select span6" name="sikomen2">
				
            <?php
            if ($e[sikomen2]=='Belum-Non Barang') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang' selected>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
			elseif ($e[sikomen2]=='Belum Cek') {
				echo"
				<option value='Belum Cek' selected>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang'>Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
			elseif ($e[sikomen2]=='Menunggu Barang') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' selected>Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
	        elseif ($e[sikomen2]=='Belum-Barang') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' selected>Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
	        elseif ($e[sikomen2]=='Selesai') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Selesai' selected>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
	        elseif ($e[sikomen2]=='Pending') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending' selected>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
	        elseif ($e[sikomen2]=='Tidak Jadi') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi' selected>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}	
	        elseif ($e[sikomen2]=='Rework') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework' selected>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}	
			elseif ($e[sikomen2]=='Proses P3') {
				echo"
				<option value='Belum Cek'>Belum di cek</option>
				<option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang' >Menunggu Barang</option> 
				<option value='Belum-Barang' >Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'selected>Proses Pihak ke-3</option>
				";
				}	
			else {
				echo"
				<option value='$e[sikomen2]' selected>Pilih Progress/ Status</option>
				<option value='Belum Cek'>Belum di cek</option>
		        <option value='Belum-Non Barang'>Tanpa Barang, Belum dikerjakan</option>
				<option value='Menunggu Barang'>Menunggu Barang</option> 
				<option value='Belum-Barang'>Barang Datang, Belum dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
                <option value='Rework'>Rework</option>
                <option value='Proses P3'>Proses Pihak ke-3</option>
				";
				}
				?>
				</select>
		</div> 
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="cek"><b>Di Cek Oleh</b></label>
        <div class="controls"><input class="input-xlarge focused" id="komentar" type="text" name="siket_teknik" value="<?=$e[siket_teknik];?>"></div>
    </div>
<? /*  
		<div class="control-group">
    	<label class="control-label" for="Jenispptek">Dicek Oleh</label>
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
    
   <div class="control-group">
		<label class="control-label" for="tgl_cek">Tanggal Cek</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_cek" value="<?=$e[sitgl_cek];?>"> Selesai Pengecekan (Tahun-Bulan-Tanggal !)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_order">Tanggal Buat Order/PR</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_order" value="<?=$e[sitgl_order];?>"> Selesai Buat Order</div>
    </div>
      <div class="control-group">
		<label class="control-label" for="tgl_brgdtg">Tanggal Barang Datang</label>
        <div class="controls"><input id="tgl" type="text" name="tgl_brgdtg" value="<?=$e[sitgl_brgdtg];?>"> Barang datang</div>
    </div>


    <div class="control-group">
		<label class="control-label" for="tgl_mulai">Tanggal Mulai</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_mulai" value="<?=$e[sitgl_mulai];?>"> SPPTek mulai dikerjakan</div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgl_selesai">Tanggal Selesai</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_selesai" value="<?=$e[sitgl_selesai];?>"> SPPTek selesai, disposisi konfirm ke user</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_rework">Tanggal Rework</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_rework" value="<?=$e[sitgl_rework];?>"> (Jika ada setelah 1 bulan selesai)</div>
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
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
	<? 
if ($_SESSION[cv]=='80' or $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13'  or $_SESSION[cv]=='14'  or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21'){
	?>
<br><center><b>ISI RIWAYAT ALAT/MESIN :</b>
                   	<form method="post" action='include/sinter/aksi_sintertp.php' target=_blank>
                   	<b>Thn-Bln-Tgl</b> :<input type=text name=tgl value=0000-00-00><br>PEMAKAIAN (utk Jam kerja alat), uraian : tulis angka/jumlah jam saja<br>PERBAIKAN : uraian isi perbaiki apa dan spare part apa diketerangan, kalau perlu no spptek<br>PEMELIHARAAN : uraian : pemeliharaan sesuai form ceklist, di Ket : Tulis jika ada tidak sesuai<br><br>
                   	<b>Nomor Aktiva </b> : <input type="text" name="qrcode" value="<?php echo $e[qrcode]; ?>"><br><br>
                   	<b>Pilih Jenis Riwayat</b> :</b><br><select name="jenis" /><option value=3>Mutasi/Pindah</option><option value=4>Pinjam/Kembali</option><option value=5>Rusak/5R/Pemusnahan</option><option value=6>Pemakaian/Pembersihan</option><option value=7>Kalibrasi/Adjust</option><option value=1 selected>Perbaikan</option><option value=2>Pemeliharaan</option><option value=0>Lainnya</option></select><br><br>
				    <b>Uraian Riwayat</b> :</b><br><input type="text" name="uraian" /><br><br>
				    <b>Keterangan</b> :</b><br><input type="text" name="keterangan" /><br><br>
				    <input class="btn btn-primary" type="submit" value="Isi Riwayat" />
				    </center>
				    
<?php
}
}elseif($_GET[act]=="balas"){
    
$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));

$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
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
        	<select multiple="multiple" id="tsin" name="tsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
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
        	<select multiple="multiple" id="tsin" name="tsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
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
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM sinter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));

	?>
<strong>
<legend>Detail Surat Permohonan Perbaikan-Pembelian Teknik (SPPTek)</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
    <tr><td>Jenis Memo </td><td>: <?=$efg[nama_jms];?></td></tr>
    <tr><td>Jenis SPPTek </td><td>: <?=$e[jenispptek];?></td></tr>
    <tr><td>Pihak ke-3? </td><td>: <?=$e[pihak3];?> (Jika dikerjakan pihak ke-3)</td></tr>    
    <tr><td>Work Permit K3L? </td><td>: <?=$e[wp];?> (Jika diperlukan work permit K3L)</td></tr>    
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr><td>Keluhan</td><td>: <?=$e[keluhan];?></td></tr>
    <tr><td>Personil</td><td>: <?=$e[personil];?></td></tr>
    <tr><td>Tanggal Cek </td><td>: <?=tgl_indo($e[sitgl_cek]);?></td></tr>
    <tr><td>Dicek oleh</td><td>: <?=$e[siket_teknik];?></td></tr>    
    <tr><td>Tanggal Mulai </td><td>: <?=tgl_indo($e[sitgl_mulai]);?></td></tr>
    <tr><td>Tanggal Selesai </td><td>: <?=tgl_indo($e[sitgl_selesai]);?></td></tr>
    <tr><td>Tanggal Rework </td><td>: <?=tgl_indo($e[sitgl_rework]);?> (Jika ada dalam 1 bulan)</td></tr>
    <tr><td>No.Notif/Order/PR : </td><td>: <?=$e[sikomen];?> (jika ada)</td></tr>
    <tr><td>Tanggal Buat Order/PR </td><td>: <?=tgl_indo($e[sitgl_order]);?> (jika ada)</td></tr>
    <tr><td>Tanggal Datang Barang </td><td>: <?=tgl_indo($e[sitgl_brgdtg]);?> (jika ada)</td></tr>
    <tr><td>Progress/Keterangan Teknik : </td><td>: <?=$e[sikomen2];?></td></tr>
    <tr><td>Keterangan User : </td><td>: <?=$e[siket_user];?></td></tr>
	<tr><td>Lampiran</td><td>: <a title="Lampiran" href="sinternal/<?=$e[sifile];?>">Klik Disini (Jika Ada)</td></tr>
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
	<table width="100%">
    <tr><td align=top><b>Ket SPPTek :</b></td><td></td></tr><tr><td>
<? if ($e[lokasi]=='-' OR $e[lokasi]!=''){
$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$e[lokasi]'"));
$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE aknomor='$e[aktiva]'"));
?>
Dengan Hormat,<br><br>

Mohon bantuannya untuk dapat diperbaiki/ dibuat/ diganti/ dibeli* (*Coret salah satu) sebagai berikut :<br><br>

<b>No Aktiva</b> : <? echo"$aktiva[aknomor]"; ?><br>
<b>Nama Aktiva</b> : <? echo"$e[aktiva] - $aktiva[aknama] "; ?><br>
<b>Lokasi</b> : <? echo"$e[lokasi] - $lokasi[nama_area] "; ?><br>
<? } ?>
<br>
<b>Keluhan :</b> <?=$e[keluhan];?><br>
<b>Personil yang bisa dihubungi :</b> <?=$e[personil];?><br><br>

<?=$e[siket];?></td></tr>
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
						LEFT JOIN psin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM psin WHERE siid='$_GET[id]'");
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
						LEFT JOIN tsin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM tsin WHERE siid='$_GET[id]'");
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
<? echo"<a href='home1.php?pages=sintertp&act=print&id=$e[siid]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<?
}else{
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
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM sinter a, users b WHERE a.sipengirim=b.cId");
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
                <td>$s[siperihal]</td>
				<td>$s[jenispptek]<br><a href='?pages=sintertp&act=lp&id=$s[siid]' class='btn btn-info'>List</a></td>
                <td><a href='sinternal/$s[sifile]'>File</a></td>";
				if ($s[sstatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=sintertp&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=sintertp&act=detail&id=$s[siid]' title=DetailMemo> Detail</a>
				</td>
				</tr>";	
		}
	}
	else {
	$smasuk = mysql_query("SELECT * FROM sinter WHERE sipengirim=$_SESSION[cv] OR sipengirim1=$_SESSION[cv] OR sipengirim2=$_SESSION[cv] AND accsipengirim1='Y' ORDER BY sitgl DESC");
	
/*$smasuk1 = mysql_query("SELECT a.*, b.cNama FROM sinter a, users b WHERE a.sipengirim=$_SESSION[cv] AND a.sipengirim1=$_SESSION[cv]");
	$s1 = mysql_fetch_array($smasuk1);
	*/
     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tanggal</th>
			<th>No</th>
			<th>Perihal SPPTek</th>
            <th>Jenis</th>
			<th>Status</th>
			<th>Tgl Cek</th>
			<th>Tgl Mulai</th>
			<th>Tgl Slesai</th>
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
                <td>$s[siperihal]</td>
				<td><b>$s[jenispptek]</b></td>";
				if ($s[sstatus]=='N'){
					if ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim SPPTek ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC dan lanjut ke Atasan??')\" class='btn btn-info'>ACC !</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC ?')\" class='btn btn-info'>ACC !</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
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
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim SPPTek ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					else {
						if ($s[sipengirim]==$s[sipengirim1]) {
			echo "<td>
			<a href='include/sinter/aksi_sinter.php?act=acc3&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim SPPTek ini??')\" class='btn btn-info'>ACC/Kirim!</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum ACC/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sintertp&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>
				
			";	
					}
			
			}	else{
			echo "<td><b>Terkirim</b></td>
			<td>$s[sitgl_cek]</td>
				<td>$s[sitgl_mulai]</td>
				<td>$s[sitgl_selesai]</td>";
			
				echo "
				<td class='center'><a href='home.php?pages=sintertp&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>
				</td>
				</tr>";	
	}
	}
	}
	}
	
	?>
	</tbody>
</table>

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