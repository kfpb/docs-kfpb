<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Buat Tiket Sistem IT</div>
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
$newID = sprintf("SIT-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah4" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Tiket Sistem IT</legend>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
<?php    
if($_SESSION[levelcv]<1 OR $_SESSION[cv]=='75' OR $_SESSION[cv]=='76' OR $_SESSION[cv]=='1001'){
?>
      <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		 <select id="pengirim" class="chzn-select" name="pengirim">
			<?

				$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
     
	echo"</select>";
         ?> 
		 <br><br>
		 <b>Jika permintaan atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
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
        </div> 
    </div>
    
<?php
}
else
{
?>
    
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
		 <b>Jika permintaan atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
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
        </div> 
    </div>

<?php
}
?>
    
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Perihal</label>
        <div class="controls">
            <input type=hidden name=jenisms value='999'><b>Tiket Sistem IT</b>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="jenispptek">Jenis Permintaan</label>
        <div class="controls">
            <select class="chzn-select" name="jenispptek" required="required" >
            <option value='' selected>-Pilih-</option>
            <option value='aplikasi'>Aplikasi</option>
            <option value='database'>Database</option>
            <option value='lainnya'>Lainnya</option>
            </option>
            </select></b>
        </div> 
	</div>
	
	
    <div class="control-group">
		<label class="control-label" for="perihal">Judul Permintaan</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required" value="..."></div>
    </div>
    

    <div class="control-group">
    	<label class="control-label" for="ket">Uraian Permintaan (Tekan Shift+Enter untuk pindah baris,<br> Ctrl+V Paste)</label>
        <div class="controls">
        	<textarea name="ket" id="editor" required="required">
Dengan Hormat,<br><br>

<b>Penjelasan Permintaan</b> : ...<br><br>

<b>Personil yang bisa dihubungi </b> : ...<br><br>

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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM sinter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/sinter/aksi_sinter.php?act=edit5&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Permohonan Tiket Sistem IT</legend>
	<?
if($_SESSION[levelcv]<1 OR $_SESSION[cv]=='75' OR $_SESSION[cv]=='76' OR $_SESSION[cv]=='1001'){
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
<input type=hidden name=pengirim value=<?=$e[sipengirim];?>>
<input type=hidden name=pengirim2 value=<?=$e[sipengirim1];?>>
<input type=hidden name=pengirim3 value=<?=$e[sipengirim2];?>>
<input type=hidden name=status value=<?=$e[sstatus];?>>
 <div class="control-group">
		<label class="control-label" for="ns">Nomor</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e[sinmr];?>"></div>
    </div>
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[sitgl];?>" required="required"><? echo tgl_indo($e[sitgl]); ?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">	
         <?  echo "<b>$_SESSION[namacv]</b>";  ?> 
        </div> 
    </div>
<?
}
?>

    <div class="control-group">
		<label class="control-label" for="perihal">Perihal/Judul</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[siperihal];?>"></div>
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="jenispptek">Jenis Permintaan</label>
        <div class="controls">
            <select class="chzn-select" name="jenispptek" required="required" >
            <option value='<?=$e[jenispptek];?>' selected><?=$e[jenispptek];?></option>  
            <option value='aplikasi'>Aplikasi</option>
            <option value='database'>Database</option>
            <option value='lainnya'>Lainnya</option>
            </option>
            </select></b>
        </div> 
	</div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Permintaan IT (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><?=$e[siket];?></textarea>
        </div>
    </div>
	<div class="control-group">
		<label class="control-label" for="siket_user">Komentar Atasan</label>
        <div class="controls"><input class="input-xlarge focused" id="siket_user" type="text" name="siket_user" value="<?=$e[siket_user];?>"></div>
    </div>
<? 
	if ($_SESSION[cv]=='75' OR $_SESSION[cv]=='76' OR $_SESSION[cv]=='1001' ){
?>
 <div class="control-group">
		<label class="control-label" for="komentar">Keterangan (IT)</b></label>
        <div class="controls"><input class="input-xlarge focused" id="komentar" type="text" name="sikomen" value="<?=$e[sikomen];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="pihak3">Progress/ Status</label>
        <div class="controls">
          	 <select id="pihak3" class="chzn-select span6" name="sikomen2" required="required">
				
            <?php
            if ($e[sikomen2]=='Belum Diterima') {
				echo"
				<option value='Diterima' selected>Diterima</option>
				<option value='Penjadwalan' >Sudah Dijadwalkan</option> 
				<option value='inproses'>Sedang dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
				";
				}
			elseif ($e[sikomen2]=='Penjadwalan') {
				echo"
				<option value='Diterima' >Diterima</option>
				<option value='Penjadwalan' selected>Sudah Dijadwalkan</option> 
				<option value='inproses'>Sedang dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
				";
				}
			elseif ($e[sikomen2]=='Inproses') {
				echo"
				<option value='Diterima' >Diterima</option>
				<option value='Penjadwalan' >Sudah Dijadwalkan</option> 
				<option value='inproses' selected>Sedang dikerjakan</option>
                <option value='Selesai'>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
				";
				}
			elseif ($e[sikomen2]=='Selesai') {
				echo"
				<option value='Diterima' >Diterima</option>
				<option value='Penjadwalan' >Sudah Dijadwalkan</option> 
				<option value='inproses' >Sedang dikerjakan</option>
                <option value='Selesai' selected>Selesai</option>
                <option value='Pending'>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
				";
				}
			elseif ($e[sikomen2]=='Pending') {
				echo"
				<option value='Belum Diterima' >Belum Diterima</option>
				<option value='Penjadwalan' >Sudah Dijadwalkan</option> 
				<option value='inproses' >Sedang dikerjakan</option>
                <option value='Selesai' >Selesai</option>
                <option value='Pending' selected>Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
				";
				}
			elseif ($e[sikomen2]=='Tidak Jadi') {
				echo"
				<option value='Diterima' >Diterima</option>
				<option value='Penjadwalan' >Sudah Dijadwalkan</option> 
				<option value='inproses' >Sedang dikerjakan</option>
                <option value='Selesai' >Selesai</option>
                <option value='Pending' >Pending/ Ditunda</option>
                <option value='Tidak Jadi' selected>Tidak Jadi/ Dibatalkan</option>
				";
				}
			else {
				echo"
				<option value='$e[sikomen2]' selected>Pilih Progress/ Status</option>
				<option value='Diterima' >Diterima</option>
				<option value='Penjadwalan' >Sudah Dijadwalkan</option> 
				<option value='inproses' >Sedang dikerjakan</option>
                <option value='Selesai' >Selesai</option>
                <option value='Pending' >Pending/ Ditunda</option>
                <option value='Tidak Jadi'>Tidak Jadi/ Dibatalkan</option>
				";
				}
				?>
				</select>
		</div> 
	</div>

    
   <div class="control-group">
		<label class="control-label" for="tgl_cek">Tanggal Terima</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_cek" value="<?=$e[sitgl_cek];?>"> Tanggal Terima (Tahun-Bulan-Tanggal !)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_order">Tanggal Rencana Mulai</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_order" value="<?=$e[sitgl_order];?>"> Tanggal rencana jadwal pengerjaan</div>
    </div>
   <div class="control-group">
		<label class="control-label" for="tgl_brgdtg">Tanggal Rencana Selesai</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_brgdtg" value="<?=$e[sitgl_brgdtg];?>"> Tanggal rencana jadwal pengerjaan</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_mulai">Tanggal Mulai</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_mulai" value="<?=$e[sitgl_mulai];?>"> Permintaan Aplikasi IT mulai dikerjakan</div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgl_selesai">Tanggal Selesai</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_selesai" value="<?=$e[sitgl_selesai];?>"> Permintaan Aplikasi IT selesai, disposisi konfirm ke user</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_rework">Tanggal Rework</label>
        <div class="controls"><input  id="tgl" type="text" name="tgl_rework" value="<?=$e[sitgl_rework];?>"></div>
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

<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM sinter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));

	?>
<strong>
<legend>Detail Tiket Sistem IT</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
	<tr><td>Dari</td><td>: <?=$ef[cIdjab];?> / <?=$e[cIdjab];?></td></tr>
	<tr><td>Kepada</td><td>: <? echo"$_SESSION[namacv]";?> (<? echo"$_SESSION[idjab]";?>)</td></tr>
    <tr><td>Jenis Memo </td><td>: <?=$efg[nama_jms];?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr><td>Tanggal Terima </td><td>: <?=tgl_indo($e[sitgl_cek]);?></td></tr>
    <tr><td>Tanggal Rencana Mulai </td><td>: <?=tgl_indo($e[sitgl_order]);?></td></tr>   
    <tr><td>Tanggal Rencana Selesai </td><td>: <?=tgl_indo($e[sitgl_brgdtg]);?></td></tr>
    <tr><td>Tanggal Mulai </td><td>: <?=tgl_indo($e[sitgl_mulai]);?></td></tr>
    <tr><td>Tanggal Selesai </td><td>: <?=tgl_indo($e[sitgl_selesai]);?></td></tr>
    <tr><td>Tanggal Rework </td><td>: <?=tgl_indo($e[sitgl_rework]);?></td></tr>
    <tr><td>Keterangan (IT) </td><td>: <?=$e[sikomen];?></td></tr>
    <tr><td>Komentar Atasan </td><td>: <?=$e[siket_user];?></td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$ef[cNama];?> / <?=$e[cNama];?></strong></td></tr>
    <tr><td>Status Tiket</td><td>: <strong><?=$e[sikomen2];?></strong></td></tr>
    <tr><td>Lampiran</td><td>: <strong><a href='sinternal/<?=$e[sifile];?>'><?=$e[sifile];?></a></strong></td></tr>
	<tr><td>Status Memo</td><td>: <strong>
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
    <tr><td align=top><b>Isi Permintaan :</b></td><td></td></tr><tr><td>
<? if ($e[lokasi]=='-' OR $e[lokasi]!=''){
$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$e[lokasi]'"));
$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE aknomor='$e[aktiva]'"));
?>
Dengan Hormat,<br><br>

Mohon bantuannya untuk dapat diperbaiki/ dibuat/ diganti/ dibeli* (*Coret salah satu) sebagai berikut :<br><br>

<b>No Aktiva</b> : <? echo"$aktiva[aknomor]"; ?><br>
<b>Nama Aktiva</b> : <? echo"$e[aktiva] $aktiva[aknama] "; ?><br>
<b>Lokasi</b> : <? echo"$e[lokasi] $lokasi[nama_area] "; ?><br>
<? } ?>

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
<? echo"<a href='home1.php?pages=sinterit&act=print&id=$e[siid]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<?
}else{
?>
<div class="block-content collapse in">
<div class="span12">

	<button class="btn-info btn-large" onclick="window.location.href='?pages=sinterit&act=tambah3'">Buat Tiket Sistem IT </button><br /><b>*Apabila permintaan ini merubah bisnis proses plant, harap membuat usulan Change Control terlebih dahulu</b><br />


	<?php
	if($_SESSION[levelcv]==0){
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM sinter a, users b WHERE a.sipengirim=b.cId");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Dibuat/ ACC</th>
			<th>Perihal</th>
            <th>Jenis </th>
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
				<td>$s[jenispptek]<br><a href='?pages=sinterit&act=lp&id=$s[siid]' class='btn btn-info'>List</a></td>
                <td><a href='sinternal/$s[sifile]'>File</a></td>";
				if ($s[sstatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=sinterit&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=sinterit&act=detail&id=$s[siid]' title=DetailMemo> Detail</a>
				</td>
				</tr>";	
		}
	}
	else {
	$smasuk = mysql_query("SELECT * FROM sinter WHERE sipengirim=$_SESSION[cv] OR sipengirim1=$_SESSION[cv] OR sipengirim2=$_SESSION[cv] AND accsipengirim1='Y' ORDER BY sitgl DESC");

     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tanggal</th>
			<th>No</th>
			<th>Judul</th>
            <th>Jenis</th>
			<th>Status</th>
			<th>Tgl Terima</th>
			<th>Tgl Mulai</th>
			<th>Tgl Slesai</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
		    if ($s[jenisms]=='999'){
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
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc5&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim Permintaan IT ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sinterit&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim Permintaan IT ini??')\" class='btn btn-info'>ACC !</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sinterit&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc5&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC ?')\" class='btn btn-info'>ACC !</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sinterit&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum ACC AM</b></td>
			<td class='center'><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/sinter/aksi_sinter.php?act=acc5&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim permintaan IT ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sinterit&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>";
					}
					else {
						if ($s[sipengirim]==$s[sipengirim1 AND $s[sipengirim2]==0]) {
			echo "<td>
			<a href='include/sinter/aksi_sinter.php?act=acc5&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC/kirim permintaan IT ini??')\" class='btn btn-info'>ACC/Kirim!</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum ACC Manager</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/sinter/aksi_sinter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a></td><td> 
				<a href='?pages=sinterit&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a></td><td><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a></td><td>
				</td>
				
			";	
					}
			
			}	else{
			echo "<td><b>Telah ACC</b></td>
			<td>$s[sitgl_cek]</td>
				<td>$s[sitgl_mulai]</td>
				<td>$s[sitgl_selesai]</td>";
			
				echo "
				<td class='center'><a href='home.php?pages=sinterit&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>
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
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>KONSEP Permintaan IT BELUM TERKIRIM/ACC!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail Permintaan IT,<br>
	Cara Koreksi/EDIT dan Lihat Komentar Konseptor/ atasan yaitu dengan Klik <u>TOMBOL Koreksi/Komen</u> di kolom Penerima dan Aksi,<br> 
	Untuk ACC atau Kirim permintaan IT Klik Link di kolom Status : <u>ACC/KIRIM !</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->