<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Penanganan Penyimpangan - (Yang dibuat oleh Anda dan bawahan Anda)</div>
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

$query = "SELECT max(ncnmr) as max_no FROM ncinter WHERE ncnmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("NC-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/ncinter/aksi_ncinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Penyimpangan (Minimal acc Asman)</legend>
<?
 if ($_SESSION[cv]=='81'){ 
?>
  <div class="control-group">
		<label class="control-label" for="ns">Nomor NCP </label>
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
					$cv = mysql_query("SELECT cId, cNama, cJabatan FROM users");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
					}
				?>
           	</select>
        </div> 
    </div>
	 <div class="control-group">
    	<label class="control-label" for="pengirim1">Minta acc atasaan-nya?</label>
        <div class="controls">
            <select id="pengirim1" class="chzn-select" name="pengirim1">
            	<option value='ya'>Ya, minta acc dulu atasan-nya</option>
            	<option value='tidak' selected>Tidak</option>
           	</select>
        </div> 
    </div>
	 <div class="control-group">
    	<label class="control-label" for="pengirim2">acc PNC/ MPM?</label>
        <div class="controls">
            <select id="pengirim2" class="chzn-select" name="pengirim2">
            	<option value='ya' selected>Ya</option>
            	<option value='tidak' selected>Tidak</option>
           	</select>
        </div> 
    </div>
<?
}
else
{
    echo"<input type=hidden name=nomor value='$newID'>";
?>	
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
	<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
        
		 <b>Jika anda Pelaksana, anda harus memilih <u>atasan langsung</u> anda<br></b>
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
			<option value='$e[cId]' >$e[cNama]</option>
		</select>";
         ?> 
		 <br><br>
		 <b>Jika anda Pelaksana/Supervisor, anda harus memilih <u>atasan berikutnya</u><br></b>	
		 <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));
			echo "
			<option value='tidak' selected>Pilih Atasan Berikutnya!</option>
			<option value='$e[cId]' >$e[cNama]</option>
			<option value='$ef[cId]' >$ef[cNama]</option>
		</select>
		<input type=hidden name=pengirim2 value='60'>";
         ?> 
        </div> 
    </div>
<?

        
    }
?>
	<div class="control-group">
    	<label class="control-label" for="tingkat">Tingkat Penyimpangan</label>
        <div class="controls">
          	 <select id="tingkat" class="chzn-select span3" name="tingkat" required="required">
            	<option value='Minor'>Pilih Tingkat Penyimpangan</option>
                <option value='Mayor'>MAYOR</option>
                <option value='Minor' selected>MINOR</option>
           	</select>
        </div> 
	</div>
	<div class="control-group">
    	<label class="control-label" for="jenisnc">Jenis Penyimpangan</label>
        <div class="controls">
          	 <select id="jenisnc" class="chzn-select span7" name="jenisnc" required="required">
            	<option value=0 selected>Pilih/Ketik Cari > Jenis Penyimpangan</option>
            <?php
				$vc = mysql_query("SELECT kode_jnc, nama_jnc FROM jenisnc ORDER BY kode_jnc ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jnc]'>$dvc[nama_jnc]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Nomor</label>
        <div class="controls"><input class="input-small focused" id="perihal" type="text" name="perihal" required="required"> <b></b>Kode Sediaan/Bahan/Alat/Ruangan/Dokumen* (Jika tidak ada tulis "-")</b></div>
    </div>
	 <div class="control-group">
		<label class="control-label" for="perihal">Nama</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal1" type="text" name="perihal1" required="required"> <b></b>Produk/Bahan/Alat/Ruangan/Dokumen*</b></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi_nc_sblm">Proses/Prosedur/Perihal yang berlaku</label>
        <div class="controls">
        	<textarea name="ket" id="isi_nc_sblm" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
         </div>
    </div>
      
  <div class="control-group">
    	<label class="control-label" for="isi_nc_ssdh">Penyimpangan</label>
        <div class="controls">
        	<textarea name="ket2" id="isi_nc_ssdh" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="alasan_nc">Alasan Penyimpangan</label>
        <div class="controls">
        	<textarea name="ket3" id="alasan_nc" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    
    
      <div class="control-group">
    	<label class="control-label" for="daftar_dok">Daftar Dokumen yang berkaitan dengan Penyimpangan</label>
        <div class="controls">
        	<textarea name="ket4" id="daftar_dok" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
 
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran NCP</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Jika lebih dari 2 file, di zip dahulu.
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM ncinter WHERE ncid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ncinter a,users b WHERE a.ncpengirim=b.cId AND a.ncid='$_GET[id]'"));
?>
<form method="post" action="include/ncinter/aksi_ncinter.php?act=edit&id=<?=$e[ncid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit ncp</legend>
	<?
if($_SESSION[cv]=='81' OR $_SESSION[cv]=='1'){
?>
<input class="input-medium focused" id="ns" type="hidden" name="nomor" value="<?=$e[ncnmr];?>">
	<div class="control-group">
		<label class="control-label" for="ns">Nomor NCP</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor1" value="<?=$e[ncnmr1];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal Penyimpangan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[nctgl];?>" required="required">Tahun-Bulan-Tanggal</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Terima PNC</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl_trm" value="<?=$e[nctgl_trm];?>">Tahun-Bulan-Tanggal</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="status">Diterima Petugas NC</label>
        <div class="controls">
          	 <select id="status" class="chzn-select span3" name="status">
            	
				
            <?php
		if ($e[ncstatus]=='Y')
		{
		    echo"<option>Pilih</option><option value='Y' selected>YA</option>
		    <option value='N'>BELUM/ TIDAK</option>
		    ";
		}
		elseif ($e[ncstatus]=='N')  {
		    echo"<option>Pilih</option><option value='Y'>YA</option>
		    <option value='N' selected>BELUM/ TIDAK</option>
		    ";
		}	
		else
		{
		     echo"<option selected>Pilih</option><option value='Y'>YA</option>
		    <option value='N'>TIDAK/BELUM</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="tingkat">Status NC</label>
        <div class="controls">
          	 <select id="status2" class="chzn-select span3" name="status2">
            	
				
            <?php
		if ($e[ncstatus2]=='Open')
		{
		    echo"<option>Pilih Status NC</option><option value='Open' selected>OPEN</option>
		    <option value='Close'>CLOSE</option>
		    ";
		}
		elseif ($e[ncstatus2]=='Close') {
		    echo"<option>Pilih Status NC</option><option value='Open'>OPEN</option>
		    <option value='Close' selected>CLOSE</option>
		    ";
		}
		else {
		    echo"<option selected>Pilih Status NC</option><option value='Open'>OPEN</option>
		    <option value='Close'>CLOSE</option>";
		}
			
			?>
           	</select>
        </div> 
	</div>
	
		<div class="control-group">
    	<label class="control-label" for="tingkat">Persiapan Penyimpangan</label>
        <div class="controls">
          	 <select id="ceklist" class="chzn-select span7" name="ceklist">
            <?php
		if ($e[ceklist]=='1')
		{
		    echo"<option>Pilih Ceklist</option>
			<option value='1' selected>Penyimpangan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Penyimpangan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
			<option value='3'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='2') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Penyimpangan Menunggu Izin POM/Regulator</option>
		    <option value='2' selected>Penyimpangan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
			<option value='3'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		else {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Penyimpangan Menunggu Izin POM/Regulator</option>
		    <option value='2' >Penyimpangan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
			<option value='3' selected>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Disetujui POM</label>
        <div class="controls"><input id="tgl" type="text" name="accpom" value="<?=$e[accpom];?>"></div>
    </div>
    
<?
}
else
{
?>	
<input  type="hidden" name="nomor" value="<?=$e[ncnmr];?>">
<input  type="hidden" name="nomor1" value="<?=$e[ncnmr1];?>">
<input  type="hidden" name="status" value="N">
<input  type="hidden" name="status2" value="Open">

 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[nctgl];?>" required="required"><? echo tgl_indo($e[nctgl]); ?>
        <input type="hidden" name="tgl_trm" value="<?=$e[nctgl_trm];?>">
        </div>
    </div>

<?
}
?>
<div class="control-group">
    	<label class="control-label" for="tingkat">Tingkat Penyimpangan</label>
        <div class="controls">
          	 <select id="tingkat" class="chzn-select span3" name="nctingkat" required="required">
            <?php
		if ($e[nctingkat]=='Mayor')
		{
		    echo"<option>Pilih Tingkat Penyimpangan</option>
		    <option value='Mayor' selected>MAYOR</option>
		    <option value='Minor'>MINOR</option>
		    ";
		}
		elseif ($e[nctingkat]=='Minor') {
		     echo"<option>Pilih Tingkat Penyimpangan</option>
		     <option value='Mayor'>MAYOR</option>
		    <option value='Minor' Selected>MINOR</option>
		    ";
		}
		else {
		     echo"<option selected>Pilih Tingkat Penyimpangan</option>
		    <option value='Mayor'>MAYOR</option>
		    <option value='Minor'>MINOR</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
<div class="control-group">
    	<label class="control-label" for="jenisnc">Jenis Penyimpangan</label>
        <div class="controls">
          	 <select id="jenisnc" class="chzn-select span9" name="jenisnc" required="required">
            	<option>Pilih/Cari Jenis penyimpangan</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jenisnc WHERE kode_jnc='$e[jenisnc]'"));
				echo"<option value='$e[jenisnc]' selected>$v[nama_jnc]</option>";
				$vc = mysql_query("SELECT kode_jnc, nama_jnc FROM jenisnc ORDER BY kode_jnc ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jnc]'>$dvc[nama_jnc]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Nomor</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[ncperihal];?>"> <br>Kode Sediaan/Bahan/Alat/Ruangan/Dokumen*</div>
    </div>
 <div class="control-group">
		<label class="control-label" for="perihal">Nama </label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal1" value="<?=$e[ncperihal1];?>"> Produk/Bahan/Alat/Ruangan/Dokumen*</div>
    </div>

   <div class="control-group">
    	<label class="control-label" for="isi_nc_sblm">Proses/Prosedur/Perihal yang berlaku</label>
        <div class="controls">
        	<textarea name="ket" id="isi_nc_sblm" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[ncket];?></textarea>
        </div>
    </div>
  <div class="control-group">
    	<label class="control-label" for="isi_nc_ssdh">Penyimpangan</label>
        <div class="controls">
        	<textarea name="ket2" id="isi_nc_ssdh" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[ncket2];?></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="alasan_nc">Alasan Penyimpangan</label>
        <div class="controls">
        	<textarea name="ket3" id="alasan_nc" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[ncket3];?></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="daftar_dok">Daftar Dokumen yang berkaitan dengan Penyimpangan</label>
        <div class="controls">
        	<textarea name="ket4" id="alasan_nc" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[ncket4];?></textarea>
        </div>
    </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran NCP</label>
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
// untuk memberitahukan kalau NC harus diperbaiki atau ditolak (lewat memo internal)
}elseif($_GET[act]=="balas"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ncinter WHERE ncid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim1=b.cId AND a.ncid='$_GET[id]'"));
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Jawab Penyimpangan yang perlu diperbaiki</legend>
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
		</select>
         <input type=hidden value='tidak' name=pengirim1>
         <input type=hidden value='tidak' name=pengirim2>";
		 ?> 
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisms">Jenis Memo</label>
        <div class="controls">
          	 <select id="jenisnc" name="jenisms" required="required" class="chzn-select span8">
            	<option value=30 selected>penyimpangan</option>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<? echo" Balas NC : $e[ncperihal] - $e[ncperihal1]";?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Penyimpangan</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><br><? $nctgl=tgl_indo($e[nctgl]); echo" Berdasar ncp tanggal : $nctgl dari $ef[cJabatan], perihal NC : <br><blockquote>No. Kode : $e[ncperihal] - Nama : $e[ncperihal1], Isi Penyimpangan :$e[ncket3]</blockquote>";?></textarea>
        </div>
    </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran NCP</label>
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


<form method="post" action="include/ncinter/aksi_ncinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Daftar Personil yang Membahas dan Menyetujui Hasil Pembahasan (acc) usulan Penanganan Penyimpangan </legend>
	<div class="control-group">
    	<label class="control-label" for="csin">Nama Personil :</label>
        <div class="controls">
        	<select multiple="multiple" id="csin" name="csin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM csin WHERE ncid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM csin WHERE ncid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
        </div> 
    </div>
    <? 
    $nc = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ncid='$_GET[id]'"));
    ?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Pembahasan :</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value='<? echo "$nc[tgl_baca]"; ?>'></div>
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="csin">Disetujui oleh = MPM/ Pgs. MPM :</label>
        <div class="controls">
        	<select multiple="multiple" id="ncsin" name="ncsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM ncsin WHERE ncid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM ncsin WHERE ncid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
        </div> 
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
   <br>
	<b>Keterangan :</b><br>
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
}elseif($_GET[act]=="editurut"){

  $q=mysql_query("UPDATE csin SET tgl_baca = '$_POST[tgl_baca]', 
                                  comment='$_POST[comment]' 
                                  WHERE psid = '$_GET[id]'");

echo"
<script>window.alert('No Urut terupdate !')</script>
<script LANGUAGE=JavaScript>
function closePg(){
	window.close();
	return true;
}
</script>
<body onLoad='return closePg()'></body>";

}elseif($_GET[act]=="editurut2"){

  $q=mysql_query("UPDATE ncsin SET tgl_baca = '$_POST[tgl_baca]', 
                                  comment='$_POST[comment]' 
                                  WHERE tsid = '$_GET[id]'");

echo"
<script>window.alert('No Urut terupdate !')</script>
<script LANGUAGE=JavaScript>
function closePg(){
	window.close();
	return true;
}
</script>
<body onLoad='return closePg()'></body>";


}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim1=b.cId AND a.ncid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim=b.cId AND a.ncid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jnc FROM jenisnc WHERE kode_jnc='$ef[jenisnc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim2=b.cId AND a.ncid='$_GET[id]'"));

	?>

<strong>
<legend>Detail Penyimpangan</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor penyimpangan </td><td>: <?=$e[ncnmr1];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[nctgl]);?></td></tr>
    <tr><td>Jenis Penyimpangan </td><td>: <?=$efg[nama_jnc];?></td></tr>
    <tr><td>Tingkat Penyimpangan</td><td>: <?=$e[nctingkat];?></td></tr>
    <tr><td>No.Kode Sediaan/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ncperihal];?></td></tr>
    <tr><td>Nama Produk/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ncperihal1];?></td></tr>
	<tr><td>Usulan dari</td><td>: <strong><?=$ef[cJabatan];?>/<?=$e[cJabatan];?></strong></td></tr>
	<tr><td>Proses/Prosedur/Perihal yang berlaku</td><td>: <?=$e[ncket];?></td></tr>
	<tr><td>Penyimpangan</td><td>: <?=$e[ncket2];?></td></tr>
	<tr><td>Alasan Penyimpangan</td><td>: <?=$e[ncket3];?></td></tr>
	<tr><td>Daftar Dokumen yang terkait Penyimpangan</td><td>: <?=$e[ncket4];?></td></tr>
	<tr><td>Lampiran NCP </td><td><a href='ncp/<? echo"$e[ncfile]"; ?>'>: <? echo"$e[ncfile]"; ?></a></td></tr>
	<tr><td>Izin POM/Regulator terkait ? </td><td>: <?
	if ($e[ceklist]==1) {
	echo"Penyimpangan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulator terkait diterima, Penyimpangan telah disetujui oleh BPOM /regulator terkait, tanggal : $e[accpom]";
    }
	elseif ($e[ceklist]==2) {
    echo"Penyimpangan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulator terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulator terkait bersama dengan Penyimpangan dokumen secara bertahap";
    }
	else {
    echo"Tidak diperlukan pemberitahuan Penyimpangan kepada BPOM/Regulator terkait";
    }
	
	?>
	</td></tr>
	<tr><td>Status NC</td><td>: <strong>
<?
if ($e[ncstatus]=='N')
{
	echo"Belum Diterima Petugas Penyimpangan";
}
else
{
	echo"Diterima Petugas Penyimpangan";
}
?>
<? if($e[ncstatus]=='N' AND $_SESSION[cv]=='81' OR $e[ncstatus]=='N' AND $_SESSION[cv]=='1'){ 
echo"<br><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$e[ncid]' onClick=\"return confirm('Yakin akan acc NCP ini??')\" class='btn btn-info'>Terima</a>  <a href='?pages=ncinter&act=balas&id=$e[ncid]' class='btn btn-info'>Return</a>";
 } ?>

	</strong></td></tr>
	</table>
	<br></strong>


<legend>Yang menyetujui Hasil Pembahasan Penyimpangan :</legend>
<table class="table table-bordered table-striped" width="100%">
<thead>
	<td>User</td>
    <td>Nama</td>
	<td>Tanggal Pembahasan</td>
	
</thead>
<?php


	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cFoto, a.cJabatan,b.tgl_baca, b.comment, b.nama FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM csin WHERE ncid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		if ($t[nama]==''){
		
		echo "<tr>
				<td>$t[cJabatan]</td>
				<td width=35%>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cJabatan]'>
					$t[cNama] 
				</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
						 <td>$t[comment]</td>
			 </tr>";
		}
		else {
		    	echo "<tr>
				<td>$t[cJabatan]</td>
				<td width=35%>
					
					$t[nama] 
				</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
					
			 </tr>";
		}
		
		

	}
	
	?>
</table>
<br /><br />
<legend>Penyimpangan Disetujui oleh :</legend>
<table class="table table-bordered table-striped" width="100%">
<thead>
	<td>User</td>
    <td>Nama</td>
	<td>Tanggal acc</td>
	<td>Komentar</td>
</thead>
<?php

			    
			    	$psn = mysql_query("SELECT a.cUser,a.cNama, a.cJabatan, a.cFoto,b.tgl_baca, b.comment, b.nama FROM users a
						LEFT JOIN ncsin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM ncsin WHERE ncid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$k++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
	if ($t[nama]==''){
			 		echo "<tr>
				<td>$t[cJabatan]</td>
				<td width=35%>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama]  
				</td>
				
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 <td>$t[comment]</td>
			 </tr> ";
	}
	else
	{
	    	echo "<tr>
				<td>$t[cJabatan]</td>
				<td width=35%>
				
					$t[nama]  
				</td>
				
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 <td>$t[comment]</td>
			 </tr> ";
	}
			 
			 
			}	
			
	
	
	?>
</table>
<br><br>
<?php	
if ($_SESSION[cv]=='3'){ 
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM ncsin WHERE ncid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {


    echo"<form method='post' action='?pages=usranc&act=commentnc'>
	<div class='control-group'>
			<label class='control-label' for='info'><b>Isi Pendapat terkait penyimpangan dan klik tombol COMMENT :</b></label>
        <div class='controls'>
		<input type=hidden name='ncid' value='$_GET[id]'>
		<textarea name='comment'>$baca[comment]</textarea>
    </div>";
	?>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Comment</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<form method='post' action='?pages=usranc&act=accnc'>
<label class='control-label' for='info'><b>Jika setuju terhadap Penyimpangan tekan tombol acc dibawah :</b></label>
<input type=hidden name='ncid' value='$_GET[id]'>
<button class='btn btn-primary'>acc NC</button>
</form>
";

}
elseif  ($baca1[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
    
   

mysql_query("UPDATE ncsin SET sistatus='Y' WHERE ncid='$_GET[id]' AND cId='$_SESSION[cv]'");

}
}
?>

<br><br>
<? echo"<a href='home1.php?pages=ncinter&act=print&id=$e[ncid]' class='btn btn-info pull-right target=_blank'><i class='icon-print'></i> Cetak ncp</a><br>";?>

<?

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtnc a 
									LEFT JOIN cdis b ON a.ncid=b.ncid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ncinter d ON a.ncid=d.ncid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.ncid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM rtnc WHERE dPendisposisi='60' AND ncid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM rtnc a WHERE a.ncid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.Jabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ncid='$_GET[id]' AND a.pId='60' OR  a.ncid='$_GET[id]' AND a.pId='49' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>


<!-- isi disposisi-->
<legend>DAFTAR RENCANA TINDAKAN PENYIMPANGAN</legend>
<?
echo"Lampiran Rencana Tindakan NC : <a href='rtnc/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
    <td width=5%><b>No.</b></td>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>PenanggungJawab</b></td>
	<td><b>Rencana Tindakan & Kode</td>
	<td><b>Hasil Tindakan</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ncid='$_GET[id]' AND a.pId='60' OR a.ncid='$_GET[id]' AND a.pId='49' ORDER BY a.urut ASC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psacc, b.psTglbaca FROM users a LEFT JOIN cdis b ON b.cId=a.cId WHERE b.ncid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psacc]=="N"){
		echo "<tr>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Batas Waktu :</b><br> $tgltarget</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Batas Waktu :</b><br> $tgltarget</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_rtnc/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
<? echo"</table>"; } ?>
<?	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim1=b.cId AND a.ncid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim=b.cId AND a.ncid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jnc FROM jenisnc WHERE kode_jnc='$ef[jenisnc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim2=b.cId AND a.ncid='$_GET[id]'"));
?>
<? echo"<a href='home1.php?pages=ncinter2&act=print&id=$e[ncid]' class='btn btn-info pull-left' target=_blank><i class='icon-print'></i> Cetak Persetujuan</a><br>";?>

<?
}else{
?>
<div>
<div class="span12">

	<button class="btn-info btn-large" onclick="window.location.href='?pages=ncinter&act=tambah'">Buat Penyimpangan</button>       
	
		<br /><br />
	

	<?php
	if($_SESSION[levelcv]==0){
		$smasuk = mysql_query("SELECT * FROM ncinter ORDER BY nctgl DESC");

	
		

     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tgl nc</th>
			<th>Pengusul</th>
			<th>Jenis nc</th>
			<th>ncp</th>
			<th width=10%>Status</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
			if ($s[ncstatus]=='N'){
			echo "<tr class=suncess>";
		}else{
			echo "<tr>";
		}
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ncpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jenisnc WHERE kode_jnc=$s[jenisnc]"));
		
		echo "  <td></td><td>";echo tgl_indo($s[nctgl]);echo"</td>
				<td>$p[cJabatan]</td>
			    <td><font size=1>$j[nama_jnc]</font></td>
				<td>$s[ncket2]</td>
				";
				
				if ($s[ncstatus]=='N'){
					if ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc2&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/ acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' OR $s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Terkirim</b><br><b>($s[ncstatus2])</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					
				elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			   elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum Dikirim Pengusul</b></td>
			<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima Pnc</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Terima</a>
				</td>";
					}
					else {
						if ($s[ncpengirim]==$s[ncpengirim1]) {
			echo "<td>
			<a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum acc/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}
			
		
			else{
			    
if($_SESSION[levelcv]<2){

			    
			echo "<td><b>Diterima</b><br><b>($s[ncstatus2])</b>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a><a href='home.php?pages=ncinter&act=lp&id=$s[ncid]' class='btn btn-info'>acc</a><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a></td>
				</td>
				</tr>";	
				}
				else {
					echo "<td><b>Diterima Pnc</b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				</tr>";	
				}
	}
	}
	
	}

    elseif ($_SESSION[levelcv]==1)
    {
        

	$smasuk = mysql_query("SELECT * FROM ncinter  ORDER BY nctgl DESC");

	
		

     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tgl nc</th>
			<th>Pengusul</th>
			<th>Jenis nc</th>
			<th>Nama nc</th>
			<th>ncp</th>
			<th width=10%>Status</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
			if ($s[ncstatus]=='N'){
			echo "<tr class=suncess>";
		}else{
			echo "<tr>";
		}
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ncpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jenisnc WHERE kode_jnc=$s[jenisnc]"));
		
		echo "  <td><font size=1>$s[ncstatus]</font></td><td><font size=1>";echo tgl_indo($s[nctgl]);echo"</font></td>
				<td><font size=1>$p[cJabatan]</font></td>
			    <td><font size=1>$j[nama_jnc]</font></td>
				<td><font size=2>$s[ncperihal1]</font></td>
				<td><font size=1>$s[ncket2]</font></td>
				";
				
				if ($s[ncstatus]=='N'){
					if ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc2&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/ acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' OR $s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima Pnc</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Terima</a>
				</td>";
					}
					
				elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			   elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum Dikirim Pengusul</b></td>
			<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima Pnc</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Terima</a>
				</td>";
					}
					else {
						if ($s[ncpengirim]==$s[ncpengirim1]) {
			echo "<td>
			<a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum acc/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}	else{
			    
if($_SESSION[cv]=='1' OR $_SESSION[cv]=='81'){

			    
			echo "<td><b>Diterima <br><font size=1>";echo tgl_indo($s[nctgl_trm]);echo"</font></b><br><b>($s[ncstatus2])</b>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a><a href='home.php?pages=ncinter&act=lp&id=$s[ncid]' class='btn btn-info'>acc</a><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a></td>
				</td>
				</tr>";	
				}
				else {
					echo "<td><b>Diterima Pnc<br><font size=1>";echo tgl_indo($s[nctgl_trm]);echo"</font></b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				</tr>";	
				}
	}
	}
	

    }
    

elseif ($_SESSION[cv]=='1')
    {
        
	$smasuk = mysql_query("SELECT * FROM ncinter where jenisnc='11' AND accsipengirim1='Y' ORDER BY nctgl DESC");

     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tgl nc</th>
			<th>Pengusul</th>
			<th>Jenis nc</th>
			<th>Nama nc</th>
			<th>ncp</th>
			<th width=10%>Status</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
			if ($s[ncstatus]=='N'){
			echo "<tr class=suncess>";
		}else{
			echo "<tr>";
		}
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ncpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jenisnc WHERE kode_jnc=$s[jenisnc]"));
		
		echo "  <td><font size=1>$s[ncstatus]</font></td><td><font size=1>";echo tgl_indo($s[nctgl]);echo"</font></td>
				<td><font size=1>$p[cJabatan]</font></td>
			    <td><font size=1>$j[nama_jnc]</font></td>
				<td><font size=2>$s[ncperihal1]</font></td>
				<td><font size=1>$s[ncket2]</font></td>
				";
				
				if ($s[ncstatus]=='N'){
					if ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc2&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/ acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[accsipengirim1]=='Y' OR $s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima PPD</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Terima</a>
				</td>";
					}
					
				elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			   elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum Dikirim Pengusul</b></td>
			<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima Pnc</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Terima</a>
				</td>";
					}
					else {
						if ($s[ncpengirim]==$_SESSION[cv] AND $s[ncpengirim]==$s[ncpengirim1]) {
			echo "<td>
			<a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/acc ncp ini??')\" class='btn btn-info'>Kirim2</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum acc/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}	else{
			    
if($_SESSION[cv]=='1'){

			    
			echo "<td><b>Diterima <br><font size=1>";echo tgl_indo($s[nctgl_trm]);echo"</font></b><br><b>($s[ncstatus2])</b>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a><a href='home.php?pages=ncinter&act=lp&id=$s[ncid]' class='btn btn-info'>acc</a><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a></td>
				</td>
				</tr>";	
				}
				else {
					echo "<td><b>Diterima PPD<br><font size=1>";echo tgl_indo($s[nctgl_trm]);echo"</font></b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				</tr>";	
				}
	}
	}
	

    }


	else {

	$smasuk = mysql_query("SELECT * FROM ncinter WHERE ncpengirim=$_SESSION[cv]  OR ncpengirim1=$_SESSION[cv] OR ncpengirim2=$_SESSION[cv] AND `show`='Y'  ORDER BY nctgl DESC");

	
		

     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tgl nc</th>
			<th>Pengusul</th>
			<th>Jenis nc</th>
			<th>Nama nc</th>
			<th>ncp</th>
			<th width=10%>Status</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
			if ($s[ncstatus]=='N'){
			echo "<tr class=suncess>";
		}else{
			echo "<tr>";
		}
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ncpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jenisnc WHERE kode_jnc=$s[jenisnc]"));
		
		echo "  <td><font size=1>$s[ncstatus]</font></td><td><font size=1>";echo tgl_indo($s[nctgl]);echo"</font></td>
				<td><font size=1>$p[cJabatan]</font></td>
			    <td><font size=1>$j[nama_jnc]</font></td>
				<td><font size=2>$s[ncperihal1]</font></td>
				<td><font size=1>$s[ncket2]</font></td>
				";
				
				if ($s[ncstatus]=='N'){
					if ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc2&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/ acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ncpengirim]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' OR $s[ncpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Terkirim</b><br><b>($s[ncstatus2])</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					
				elseif ($s[ncpengirim1]==$_SESSION[cv] AND $s[ncpengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan acc ncp ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			   elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum Dikirim Pengusul</b></td>
			<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[ncpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima Pnc</b></td>
			<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					else {
						if ($s[ncpengirim]==$s[ncpengirim1]) {
			echo "<td>
			<a href='include/ncinter/aksi_ncinter.php?act=acc&id=$s[ncid]' onClick=\"return confirm('Yakin akan Kirim/acc ncp ini??')\" class='btn btn-info'>Kirim</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum acc/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}	else{
			    
if($_SESSION[levelcv]<2){

			    
			echo "<td><b>Diterima<br><font size=1>";echo tgl_indo($s[nctgl_trm]);echo"</font></b><br><b>($s[ncstatus2])</b>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a><a href='home.php?pages=ncinter&act=lp&id=$s[ncid]' class='btn btn-info'>acc</a><a href='include/ncinter/aksi_ncinter.php?act=hapus&id=$s[ncid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ncinter&act=edit&id=$s[ncid]' class='btn btn-info'>Edit/Koreksi</a></td>
				</td>
				</tr>";	
				}
				else {
					echo "<td><b>Diterima Pnc<br><font size=1>";echo tgl_indo($s[nctgl_trm]);echo"</font></b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=ncinter&act=detail&id=$s[ncid]' class='btn btn-info'>Detail</a>
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
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>Penyimpangan BELUM KIRIM/ DITERIMA PETUGAS nc!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail Penyimpangan,<br>
	Cara Koreksi/EDIT dengan Klik <u>TOMBOL EDIT/KOREKSI</u> di kolom Aksi,<br> 
	Untuk acc Penyimpangan Klik Link di kolom Status : <u>Terima!</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->