<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Memo Persetujuan Purchase Request (Order/PR)</div>
</div>
<div class="block-content collapse in">
<div>
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
    	<label class="control-label" for="pengirim">Dari</label>
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
     
		echo"</select>";
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
        	<textarea name="ket" id="editor" required="required"></textarea>
			</div>
        </div>
    <div class="control-group">
		<label class="control-label" for="komentar">Catatan</label>
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
<?
}
elseif($_GET[act]=="tambah2"){
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
<legend>Buat Memo Penanggung Jawab Pelulusan Batch</legend>

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="pengirim">Dari</label>
        <div class="controls">
        	 <?  echo "<input type=hidden name=pengirim value=$_SESSION[cv]><input type=hidden name=pengirim1 value=tidak><input type=hidden name=pengirim2 value=tidak><b>$_SESSION[namacv]</b>";  
        	 
        	 ?> </div>    

    </div>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Memo/Undangan</label>
        <div class="controls">
            <input type=hidden name=jenisms value=32><b>Pelulusan</b>
        </div> 
	</div>
	
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required" value="Penanggung Jawab Pelulusan Batch Tanggal .... s.d ......"></div>
    </div>
 
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo/Undangan (Tekan Shift+Enter untuk pindah baris,<br> Ctrl+V Paste)</label>
        <div class="controls">
        	<textarea name="ket" id="editor" required="required">
    
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
$noUrut = (int) substr($idMax, 2, 3);
$noUrut++;
$newID = sprintf("S-%03s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah2" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Surat Permintaan Pembelian (PR)</legend>
<br><b><u>KETERANGAN</u> :<br>
- Memo PR ini tidak perlu pilih penerima & tembusan, karena sudah otomatis.<br>
- Memo PR Minimal harus keluar dari Asman, tidak boleh langsung dibuat Supervisor (hanya konsep)<br>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="pengirim">Dari</label>
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
			<option value='$e[cId]' >$e[cNama]</option>
		</select>";
         ?> 
		 <br>
		 <b>Jika SPPTek atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select" name="pengirim2">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Level 2!</option>
			<option value='$ef[cId]' >$ef[cNama]</option>
		</select>";
         ?> 
        </div> 
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo"></label>
        <div class="controls">
            <input type=hidden name=jenisms value=20><b>Permohonan SPPTek</b>
        </div> 
	</div>
	
		<div class="control-group">
    	<label class="control-label" for="Jenispptek">Jenis Perbaikan/Pembelian</label>
        <div class="controls">
            <select class="chzn-select" name="jenispptek">
            <option value='Teknik' selected>Pilih Jenis SPPTek</option>  
            <option value='Mekanik'>Perbaikan Mekanik</option>   
            <option value='Listrik'>Perbaikan Listrik</option>  
            <option value='Utility'>Perbaikan Utility, HVAC</option>
            <option value='IT'>Perbaikan Hardware, Software dan Jaringan</option>
            <option value='Sipil'>Perbaikan Bangunan/Sipil</option>
            <option value='PR-Teknik'>Pembelian Teknik</option>
            </option>
            </select></b>.
        </div> 
	</div>
	
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required" value="[SPPTek] Permohonan Perbaikan/ Pembelian Teknik* ..."></div>
    </div>
 
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo (Tekan Shift+Enter untuk pindah baris,<br> Ctrl+V Paste)</label>
        <div class="controls">
        	<textarea name="ket" id="editor" required="required">
Dengan Hormat,<br><br>

Mohon bantuannya untuk dapat diperbaiki/ dibuat/ diganti/ dibeli* sebagai berikut :<br><br>

<b>No Aktiva</b> : ...<br>
<b>Nama Aktiva</b> : ...<br>
<b>Lokasi</b> : ...<br>
<b>Keluhan</b> : ...<br><br>
<b>Personil yang bisa dihubungi</b> : ...<br><br>

<b>Jika pembelian barang/jasa teknik (isi disini) :</b><br>
<table border="1" cellpadding="1" cellspacing="1" style="width:500px">
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

Demikian bantuan dan kerjasamanya kami ucapkan terima kasih.<br><br>
*Pilih salah satu
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
$newID = sprintf("PR%04s/$_SESSION[nppcv]/$bln", $noUrut);

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
    	<label class="control-label" for="pengirim">Dari</label>
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
}
elseif($_GET[act]=="tambah5"){

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
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah3" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Memo Persetujuan Order/PR</legend>

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="pengirim">Dari</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>

		</select>";
         ?> 
		 <br><br>
		 <b>Pilih atasan anda atau yang meng-ACC berikutnya, jika anda Asman maka pilih kembali : <br></b>	
		 
		  <select id="pengirim1" class="chzn-select" name="pengirim1" required>
            	<option value=''>Pilih User yang ACC</option>
            	<?php
					$cv = mysql_query("SELECT cId, cNama FROM users WHERE idj=5 OR idj=2 OR idj=3 OR idj=4");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				?>
           	</select>
		 <br>
		 	
		 <select id="pengirim2" class="chzn-select" name="pengirim2" required>
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));	
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='' selected>Pilih Jajaran</option>
			<option value='11' >Bagian Support Plant</option>
			<option value='23' >Bagian Pemastian Mutu</option>
			<option value='19' >Bagian Produksi</option>
			<option value='94' >Bagian Teknik Pemeliharaan</option>
		</select>";
         ?> 
        </div> 
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Memo</label>
        <div class="controls">
            <input type=hidden name=jenisms value=33><b>Persetujuan Purchase Request (Order/PR)</b>
        </div> 
	</div>
	
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required" placeholder="MEMO PR BAGIAN .... BULAN .... TAHUN ...." value=""></div>
    </div>
    
      <div class="control-group">
		<label class="control-label" for="komen">No.Order/PR</label>
        <div class="controls"><input class="input-large focused" id="nopr" type="text" name="jenispptek" required="required" value=""></div>
    </div>
 
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo (Tekan Shift+Enter untuk pindah baris,<br> Ctrl+V Paste)</label>
        <div class="controls">
        	<textarea name="ket" id="editor" required="required">
<table border="1" cellpadding="1" cellspacing="1" width=100%>
	<tbody>
		<tr>
			<td style="text-align:center"><b>No</b></td>
			<td style="text-align:center"><b>Barang/Jasa</b></td>
			<td style="text-align:center"><b>Jml</b></td>
			<td style="text-align:center"><b>Stn</b></td>

		</tr>
		<tr>
			<td style="text-align:center">Tulis Barang/Jasa atau <br>Upload file/screenshot PR sebagai Attachment (nama file jangan ada spasi)</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
		</tr>
	</tbody>
</table>
        	</textarea>
			</div>
        </div>
        
      <div class="control-group">
		<label class="control-label" for="komen">Keterangan</label>
        <div class="controls"><input class="input-large focused" id="sikomen" type="text" name="sikomen" value=""></div>
    </div>
    
   <div class="control-group">
    	<label class="control-label" for="fileInput">Lampirkan Scan/Screenshot PR</label>
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
<form method="post" action="include/sinter/aksi_sinter.php?act=edit4&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Memo Persetujuan PR</legend>
	<?
if($_SESSION[levelcv]<1){
?>
    <div class="control-group">
		<label class="control-label" for="ns">Nomor</label>
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
<input type=hidden name=status value=<?=$e[sstatus];?>>

<div class="control-group">
		<label class="control-label" for="ns">Nomor</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="hidden" name="nomor" value="<?=$e[sinmr];?>"><?=$e[sinmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[sitgl];?>" required="required"><?=$e[sitgl];?></div>
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
<?
}
?>

    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[siperihal];?>"></div>
    </div>
   <div class="control-group">
		<label class="control-label" for="komentar">Nomor Order PR</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="jenispptek" value="<?=$e[jenispptek];?>"></div>
    </div> 
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><?=$e[siket];?></textarea>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="komentar2">Catatan User</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar2" type="text" name="sikomen" value="<?=$e[sikomen];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="komentar2">Catatan Atasan</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar2" type="text" name="sikomen2" value="<?=$e[sikomen2];?>"></div>
    </div>
<? 
	if ($_SESSION[cv]=='80' or $_SESSION[cv]=='16' or $_SESSION[cv]=='75'){
?>
    
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
<?php
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
    	<label class="control-label" for="pengirim">Dari</label>
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
	<b><u>Keterangan SPPTek/RAB :</u></b><br>
	 1. Untuk SPPTek Mekanik/Listrik/Utility/IT & Bangunan/Sipil Pihak ke-3 dikirim kepada <b>AMTP</b>, Tembusan ke <b>Spv. Teknik terkait</b><br>
	 2. Untuk SPPTek Bangunan/Sipil perbaikan oleh pelaksana teknik dikirim kepada <b>AMUK3L</b>, Tembusan ke <b></b>AMTP, Ibu Anin/ Ibu Budi</b><br>
	 3. Untuk RAB/PR Barang Lain-lain dikirim kepada <b>AMUK3L</b>, Tembusan Pembelian<br>
	 4. Untuk RAB/PR Pakaian Kerja dikirim kepada <b>AMSM</b>, Tembusan Pembelian<br>

   <br>
	<b><u>Keterangan Lainnya :</u></b><br>
	1. Jika akan pilih semua klik tombol "Pilih Semua".<br><br>
	2. Jika akan menghapus semua yang telah dipilih klik tombol "Hapus Semua"<br><br>
	3. Jika akan memilih grup bagian, kode untuk membantu pencarian :<br><br>
	- <b>PM</b> (Para Manager)<br>
	- <b>AM.</b> (Para Asman)<br>
	- <b>DPP</b> (Jajaran Pengendalian Proses Produksi AKA PPC)<br>
	- <b>GD</b> (Jajaran Penyimpanan/Pergudangan)<br>
	- <b>SPG</b> (Sub Bagian Pengadaan)<br>
	- <b>QA</b> (Asman dan Supervisor Fungsional Pemastian Mutu)<br>
	- <b>QC</b> (Jajaran Asman Pengawasan Mutu-QC)<br>
	- <b>SM</b> (Jajaran Sistem Mutu)<br>
	- <b>PP</b> (Jajaran Pengembangan Produk)<br>
	- <b>P1</b> (Jajaran Produksi 1)<br>
	- <b>P2</b> (Jajaran Produksi 2)<br>
	- <b>P3</b> (Jajaran Produksi 3)<br>
	- <b>SDMA</b> (Jajaran SDM & Akuntansi)<br>
	- <b>UK3L</b> (Jajaran Umum & K3L)<br>
	- <b>TP</b> (Jajaran Teknik & Pemeliharaan)<br>
<br>
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));

	?>
<strong>
<legend>Detail Memo Persetujuan Order/PR</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr><td>No.PR</td><td>: <?=$e[jenispptek];?></td></tr>
	<tr><td>Konsep dari</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cIdjab];?>)</strong></td></tr>
    <tr><td>ACC 1</td><td>: <strong><?=$e[cNama];?> (<?=$e[cIdjab];?>)</strong></td></tr>
    <tr><td>ACC 2</td><td>: <strong><?=$efgh[cNama];?> (<?=$efgh[cIdjab];?>)</strong></td></tr>
	<tr><td>Lampiran</td><td>: <a title="Lampiran" href="sinternal/<?=$e[sifile];?>">Klik Disini</td></tr>
	<tr><td>Komentar Atasan</td><td>: <?=$e[sikomen2];?></td></tr>
	<tr><td>Komentar User</td><td>: <?=$e[sikomen];?></td></tr>
	<tr><td>Status</td><td>: <strong>
<?
if ($e[sstatus]=='N')
{
	echo"Belum Terkirim (Tanda tangan/ ACC $e[cIdjab] = $e[accsipengirim1])";
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
    <tr><td align=top><b>Isi :</b></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
</table>
<br>
<iframe width=100% height=500 src="sinternal/<?=$e[sifile];?>"></iframe>
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
<? echo"<a href='home1.php?pages=sinterm&act=print&id=$e[siid]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<?
}else{
?>
<div>
<div>


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
            <th class='center'>Penerima & Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		while($s = mysql_fetch_array($smasuk)) {
		echo "<tr>
				<td>";echo tgl_indo($s[sitgl]);echo"</td>
                <td>$s[cNama]</td>
                <td>$s[siperihal]<br><b>Note User :</b>$s[sikomen]</td>
				<td>$s[jenispptek]<br><a href='?pages=sinterm&act=lp&id=$s[siid]' class='btn btn-info'>List</a></td>
                <td><a href='sinternal/$s[sifile]'>File</a></td>";
				if ($s[sstatus]=='N'){
			echo "<td>Belum ACC/kirim-";
			}	else{
			echo "<td>terkirim-";
			}	
				echo "
				<a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=sinterm&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' title=Detail> Detail</a>
				</td>
				</tr>";	
		}
	}
	else {
	$smasuk = mysql_query("SELECT * FROM sinter WHERE sipengirim=$_SESSION[cv] OR sipengirim1=$_SESSION[cv] OR sipengirim2=$_SESSION[cv] AND accsipengirim1='Y' ORDER BY sitgl DESC");
	
     ?>
     
<center></p><b>Klik Tombol <font color=red>ACC!</font>, PR terkirim ke Bagian Pembelian setelah di klik tombol <font color=red>Telah Release SAP</font> di Memo (Release dulu di SAP baru Klik). <br>Jika ada yang perlu ditanyakan ke pembuat PR, mohon isi di kolom dan klik <font color=red>KOMEN</font></b><br>
<b>Keterangan : Highlight hijau = belum acc-untuk di ACC, Highlight merah = belum acc, ada komentar dari atasan, pindahkan pertanyaan atasan ke jawaban dalam kurung.</b></center>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th width=10%>Tanggal</th>
			<th width=30%>Perihal</th>
            <th width=35%>Isi Barang/Jasa</th>
			<th width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
		    if ($s[jenisms]=='33'){
			if ($s[sstatus]=='N' AND $s[sikomen2]=='' AND $s[jenispptek]!='pending'){
			echo "<tr class=success>";
			echo "<td>$s[sstatus]</td>
		          <td>";echo tgl_indo($s[sitgl]);echo"</td>
                  <td><font size=2><b>$s[siperihal]</b><br><b>No : $s[jenispptek]</b></font></td>
				  <td><font size=2>$s[siket]<b>Link Lampiran : <a href=sinternal/$s[sifile] target=_blank>Klik Disini/Detail!</a> </b><br><b>Note User :</b>$s[sikomen]<br><b>Note Atasan :</b> $s[sikomen2]</font></td>";
			}    
			elseif ($s[sstatus]=='N' AND $s[sikomen2]!=''){
			echo "<tr>";
			echo "<td><font color=red>$s[sstatus]</font></td>
		          <td>";echo tgl_indo($s[sitgl]);echo"</td>
                  <td><font size=2 color=red><b>$s[siperihal]</b><br><b>No : $s[jenispptek]</b></font></td>
				  <td><font size=2 color=red><b>Link Lampiran : $s[siket]<b>Link Lampiran : <a href=sinternal/$s[sifile] target=_blank>Klik Disini/Detail!</a> </b><br><b>Note User :</b>$s[sikomen]<br><b>Note Atasan :</b> $s[sikomen2]</font></td>";
			    
		}else{
			echo "<tr>";
				echo "<td>$s[sstatus]</td>
		          <td>";echo tgl_indo($s[sitgl]);echo"</td>
                  <td><font size=2><b>$s[siperihal]</b><br><b>No : $s[jenispptek]</b></font></td>
				  <td><font size=2>$s[siket]<b>Link Lampiran : <a href=sinternal/$s[sifile] target=_blank>Klik Disini/Detail!</a> </b><br><b>Note User :</b>$s[sikomen]<br><b>Note Atasan :</b> $s[sikomen2]</font></td>";
			
		
		}
				if ($s[sstatus]=='N'){
					if ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc4&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim memo ini??')\" class='btn btn-info'>ACC !</a>-<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
			<a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>-<a href='home.php?pages=sinterm&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-
			<br><b>Jika belum ACC, isi disini:</b><br>
			<form method='post' action='include/sinter/aksi_sinter.php?act=edit3&id=$s[siid]'><input class='input-medium focused' type=text name=sikomen2 ><button class='btn btn-primary'>Komen</button></form><br>
		
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC dan lanjut ke Atasan??')\" class='btn btn-info'>ACC !</a><br><br><form method='post' action='include/sinter/aksi_sinter.php?act=edit3&id=$s[siid]'><input type=text placeholder=isi_komen name=sikomen2 value='$s[sikomen2]' > <button class='btn btn-primary'>Komen</button></form></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc4&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim memo ini??')\" class='btn btn-info'>ACC !</a>-<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
			<a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>-<a href='home.php?pages=sinterm&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-
			<br><b>Jika belum ACC, isi disini:</b><br>
			<form method='post' action='include/sinter/aksi_sinter.php?act=edit3&id=$s[siid]'><input class='input-medium focused' type=text name=sikomen2 ><button class='btn btn-primary'>Komen</button></form><br>
		
				</td>";
					}
					elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum ACC Ke-1</b></td>
			<td class='center'><a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc4&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim memo ini??')\" class='btn btn-info'>ACC !</a>-<form method='post' action='include/sinter/aksi_sinter.php?act=edit3&id=$s[siid]'><input type=text name=sikomen2 value='$s[sikomen2]'> <button class='btn btn-primary'>Komen</button></form></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					else {
						if ($s[sipengirim]==$s[sipengirim1]) {
			echo "<td>
			<a href='include/sinter/aksi_sinter.php?act=acc4&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim memo ini??')\" class='btn btn-info'>ACC !</a>-<form method='post' action='include/sinter/aksi_sinter.php?act=edit3&id=$s[siid]'><input type=text name=sikomen2 value='$s[sikomen2]'> <button class='btn btn-primary'>Komen</button></form></a>
			     </td>";
						}
						else {
			echo "";
						}
							echo "
				<td class='center'>	<b>Belum ACC/Kirim</b>-<a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='home.php?pages=sinterm&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}	else{
			echo "<td class='center'><b>Terkirim</b><br>";
			//<a href='home.php?pages=sinterm&act=edit&id=$s[siid]' class='btn btn-info'>Update</a>
				echo "<a href='home.php?pages=sinterm&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>
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
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>KONSEP MEMO PERSETUJUAN PR BELUM TERKIRIM/ACC!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail MEMO PERSETUJUAN PR,<br>
	Cara Komen : isi komen, Klik <u>TOMBOL Komen</u><br> 
	Untuk ACC klik : <u>ACC !</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->