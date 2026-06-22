<?php
$user = mysql_fetch_array(mysql_query(
    sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
));
?>

<!--<link href="https://thread.ekfpb.com/spawn.css" rel="stylesheet" type="text/css">-->
<!--<link href="https://thread.ekfpb.com/floating.css" rel="stylesheet" type="text/css">-->
<!--<script src="https://thread.ekfpb.com/spawn.min.js"></script>-->
<!--<script-->
<!--    floating-->
<!--    scheme="https"-->
<!--    host="thread.ekfpb.com"-->
<!--    user="<?php //echo $user['session'] ?>"-->
<!--    app="cc"-->
<!--    src="https://thread.ekfpb.com/floating.js"></script>-->

<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Penanganan Perubahan (Change Control) - (Yang dibuat oleh Anda dan bawahan Anda)</div>
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

$query = "SELECT max(ccnmr) as max_no FROM ccinter WHERE ccnmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("CC-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="?pages=ccinter&act=tambah2" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Usulan Change Control (Minimal ACC Asman)</legend>
<?
 if ($_SESSION[cv]=='99'){ 
?>
  <div class="control-group">
		<label class="control-label" for="ns">Nomor CC </label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value=""></div>
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
            <select id="pengirim1" class="chzn-select" name="pengirim1" >
            	<option>Pilih User</option>
            	<option value='tidak' selected>Tidak</option>
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
    	<label class="control-label" for="pengirim2">ACC PCC/ MPM?</label>
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
    echo"<input type=hidden name=nomor value=''>";
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
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan, cJabatan FROM users WHERE cId='$_SESSION[atasan]'"));
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv] </option>
			<option value='$e[cId]' >$e[cNama] ($e[cJabatan])</option>
		</select>";
         ?> 
		 <br><br>
		 <b>Jika anda Pelaksana/Supervisor, anda harus memilih <u>atasan berikutnya</u><br></b>	
		 <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan, cJabatan FROM users WHERE cId='$_SESSION[atasan]'"));			
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan, cJabatan FROM users WHERE cId='$e[cAtasan]'"));
			echo "
			<option value='tidak' selected>Pilih Atasan Berikutnya!</option>
			<option value='$e[cId]' >$e[cNama] ($e[cJabatan])</option>
			<option value='$ef[cId]' >$ef[cNama] ($ef[cJabatan])</option>
		</select>
		<input type=hidden name=pengirim2 value='81'>";
         ?> 
        </div> 
    </div>
<?

        
    }
?>
	<div class="control-group">
    	<label class="control-label" for="tingkat">Tingkat Perubahan</label>
        <div class="controls">
          	 <select id="tingkat" class="chzn-select span3" name="tingkat" required="required">
            	<option value='Minor'>Pilih Tingkat Perubahan</option>
                <option value='Mayor'>MAYOR</option>
                <option value='Minor' selected>MINOR</option>
           	</select>
        </div> 
	</div>
	<div class="control-group">
    	<label class="control-label" for="Jeniscc">Jenis Perubahan</label>
        <div class="controls">
          	 <select id="jeniscc" class="chzn-select span7" name="jeniscc" required="required">
            	<option value='' selected>Pilih/Ketik Cari > Jenis Perubahan</option>
            <?php
				$vc = mysql_query("SELECT kode_jcc, nama_jcc FROM jeniscc ORDER BY kode_jcc ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jcc]'>$dvc[nama_jcc]</option>";
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
    	<label class="control-label" for="isi_cc_sblm">Proses/Prosedur/Perihal yang berlaku</label>
        <div class="controls">
        	<textarea name="ket" id="editor" style="width: 610px; height: 100px"></textarea>
         </div>
    </div>
      
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Lanjut</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php 
}
elseif($_GET[act]=="tambah2"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(ccnmr) as max_no FROM ccinter WHERE ccnmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("CC-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/ccinter/aksi_ccinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Usulan Change Control (Minimal ACC Asman)</legend>
<input type=hidden name=nomor value='<?=$_POST[nomor];?>'>
<input type=hidden name=tgl value='<?=$_POST[tgl];?>'>
<input type=hidden name=pengirim value='<?=$_POST[pengirim];?>'>
<input type=hidden name=pengirim1 value='<?=$_POST[pengirim1];?>'>
<input type=hidden name=pengirim2 value='<?=$_POST[pengirim2];?>'>
<input type=hidden name=tingkat value='<?=$_POST[tingkat];?>'>
<input type=hidden name=jeniscc value='<?=$_POST[jeniscc];?>'>
<input type=hidden name=perihal value='<?=$_POST[perihal];?>'>
<input type=hidden name=perihal1 value='<?=$_POST[perihal1];?>'>
<input type=hidden name=ket value='<?=$_POST[ket];?>'>
  <div class="control-group">
    	<label class="control-label" for="isi_cc_ssdh">Usulan Perubahan</label>
        <div class="controls">
        	<textarea name="ket2" id="editor"   style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="alasan_cc">Alasan Perubahan</label>
        <div class="controls">
        	<textarea name="ket3" id="editor"  class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    
    
      <div class="control-group">
    	<label class="control-label" for="daftar_dok">Daftar Dokumen yang berkaitan dengan Usulan Perubahan</label>
        <div class="controls">
        	<textarea name="ket4" id="daftar_dok" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
 
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran CC/Kajian Risiko</label>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
?>
<form method="post" action="?pages=ccinter&act=edit2&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit usulan CC (1/2)</legend>
	<?
if($_SESSION[cv]=='99'){
?>
<input class="input-medium focused" id="ns" type="hidden" name="nomor" value="<?=$e[ccnmr];?>">
	<div class="control-group">
		<label class="control-label" for="ns">Nomor CC</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor1" value="<?=$e[ccnmr1];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[cctgl];?>" required="required">Tahun-Bulan-Tanggal</div>
    </div>
    
    
        <div class="control-group">
    	<label class="control-label" for="pengirim">Pengusul</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select6" name="pengirim" >
            	<option>Pilih User</option>
	            <?php
					$cvc = mysql_query("SELECT cId, cNama, cJabatan FROM users WHERE cId='$e[ccpengirim]'");
					$dcvc=mysql_fetch_array($cvc);
	    		     echo "<option selected value='$dcvc[cId]'>$dcvc[cNama] ($dcvc[cJabatan])</option>";
				?>
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
    	<label class="control-label" for="pengirim1">Atasan Pengusul</label>
        <div class="controls">
            <select id="pengirim1" class="chzn-select6" name="pengirim1" >
            	<option>Pilih User</option>
	            <?php
					$cvv = mysql_query("SELECT cId, cNama, cJabatan FROM users WHERE cId='$e[ccpengirim1]'");
					$dcvv=mysql_fetch_array($cvv);
	    		     echo "<option selected value='$dcvv[cId]'>$dcvv[cNama] ($dcvv[cJabatan])</option>";
				?>
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
		<label class="control-label" for="tgl">Tanggal Terima PCC</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl_trm" value="<?=$e[cctgl_trm];?>">Tahun-Bulan-Tanggal</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="status">Diterima Petugas CC</label>
        <div class="controls">
          	 <select id="status" class="chzn-select span3" name="status">
            	
				
            <?php
		if ($e[ccstatus]=='Y')
		{
		    echo"<option>Pilih</option><option value='Y' selected>YA</option>
		    <option value='N'>BELUM/ TIDAK</option>
		    ";
		}
		elseif ($e[ccstatus]=='N')  {
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
    	<label class="control-label" for="tingkat">Status CC</label>
        <div class="controls">
          	 <select id="status2" class="chzn-select span3" name="status2">
            	
				
            <?php
		if ($e[ccstatus2]=='Open')
		{
		    echo"<option>Pilih Status CC</option><option value='Open' selected>OPEN</option>
		    <option value='Closed'>CLOSED</option>
		    ";
		}
		elseif ($e[ccstatus2]=='Closed') {
		    echo"<option>Pilih Status CC</option><option value='Open'>OPEN</option>
		    <option value='Closed' selected>CLOSED</option>
		    ";
		}
		else {
		    echo"<option selected>Pilih Status CC</option><option value='Open'>OPEN</option>
		    <option value='Closed'>CLOSED</option>";
		}
			
			?>
           	</select>
        </div> 
	</div>
			<div class="control-group">
    	<label class="control-label" for="tingkat">Persiapan Perubahan</label>
        <div class="controls">
          	 <select id="ceklist" class="chzn-select span7" name="ceklist">
            <?php
		if ($e[ceklist]=='1')
		{
		    echo"<option>Pilih Ceklist</option>
			<option value='1' selected>Perubahan Menunggu Izin POM/Regulator</option>
			
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='2') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2' selected>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='3') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3' selected>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		else {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4' selected>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Disetujui POM</label>
        <div class="controls"><input class="input-small datepicker"  id="tgl" type="text" name="accpom" value="<?=$e[accpom];?>"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="tgl_lapor">Tanggal Lapor POM</label>
        <div class="controls"><input class="input-small datepicker"  id="tgl_lapor" type="text" name="tgl_lapor" value="<?=$e[tgl_lapor];?>"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="ns">Lapor Oleh</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="lapor_oleh" value="<?=$e[lapor_oleh];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="tingkat">Level Perubahan</label>
        <div class="controls">
          	 <select id="level" class="chzn-select span3" name="levelcc">
            <?php
		if ($e[levelcc]=='1')
		{
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' selected>1</option>
		    <option value='2'>2</option>
		    <option value='3'>3</option>
		    ";
		}
		elseif ($e[levelcc]=='2') {
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' >1</option>
		    <option value='2' selected>2</option>
		    <option value='3'>3</option>
		    ";
		}
		elseif ($e[levelcc]=='3') {
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' >1</option>
		    <option value='2' >2</option>
		    <option value='3' selected>3</option>
		    ";
		}
		else {
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' >1</option>
		    <option value='2' >2</option>
		    <option value='3' >3</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
	<?
}
elseif($_SESSION[cv]=='55' OR $_SESSION[cv]=='81'){
?>
<input  type="hidden" name="nomor" value="<?=$e[ccnmr];?>">
<input  type="hidden" name="tgl" value="<?=$e[cctgl];?>">
<input  type="hidden" name="tgl_trm" value="<?=$e[cctgl_trm];?>">
<input  type="hidden" name="status" value="<?=$e[ccstatus];?>">
<input  type="hidden" name="pengirim" value="<?=$e[ccpengirim];?>">
<input  type="hidden" name="pengirim1" value="<?=$e[ccpengirim1];?>">

	<div class="control-group">
		<label class="control-label" for="ns">Nomor CC</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor1" value="<?=$e[ccnmr1];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><?=$e[cctgl];?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Terima PCC</label>
        <div class="controls"><?=$e[cctgl_trm];?></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="status">Diterima Petugas CC</label>
        <div class="controls"><?=$e[ccstatus];?>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="tingkat">Status CC</label>
        <div class="controls">
          	 <select id="status2" class="chzn-select span3" name="status2">
            	
				
            <?php
		if ($e[ccstatus2]=='Open')
		{
		    echo"<option>Pilih Status CC</option><option value='Open' selected>OPEN</option>
		    <option value='Closed'>CLOSED</option>
		    ";
		}
		elseif ($e[ccstatus2]=='Closed') {
		    echo"<option>Pilih Status CC</option><option value='Open'>OPEN</option>
		    <option value='Closed' selected>CLOSE</option>
		    ";
		}
		else {
		    echo"<option selected>Pilih Status CC</option><option value='Open'>OPEN</option>
		    <option value='Closed'>CLOSED</option>";
		}
			
			?>
           	</select>
        </div> 
	</div>
		<div class="control-group">
    	<label class="control-label" for="tingkat">Persiapan Perubahan</label>
        <div class="controls">
          	 <select id="ceklist" class="chzn-select span7" name="ceklist">
            <?php
		if ($e[ceklist]=='1')
		{
		    echo"<option>Pilih Ceklist</option>
			<option value='1' selected>Perubahan Menunggu Izin POM/Regulator</option>
			
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='2') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2' selected>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='3') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3' selected>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		else {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4' selected>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Disetujui POM</label>
        <div class="controls"><input class="input-small datepicker"  id="tgl" type="text" name="accpom" value="<?=$e[accpom];?>"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="tgl_lapor">Tanggal Lapor POM</label>
        <div class="controls"><input class="input-small datepicker"  id="tgl_lapor" type="text" name="tgl_lapor" value="<?=$e[tgl_lapor];?>"></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="ns">Lapor Oleh</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="lapor_oleh" value="<?=$e[lapor_oleh];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="tingkat">Level Perubahan</label>
        <div class="controls">
          	 <select id="level" class="chzn-select span3" name="levelcc">
            <?php
		if ($e[levelcc]=='1')
		{
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' selected>1</option>
		    <option value='2'>2</option>
		    <option value='3'>3</option>
		    ";
		}
		elseif ($e[levelcc]=='2') {
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' >1</option>
		    <option value='2' selected>2</option>
		    <option value='3'>3</option>
		    ";
		}
		elseif ($e[levelcc]=='3') {
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' >1</option>
		    <option value='2' >2</option>
		    <option value='3' selected>3</option>
		    ";
		}
		else {
		    echo"<option>Pilih Level Perubahan</option>
		    <option value='1' >1</option>
		    <option value='2' >2</option>
		    <option value='3' >3</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
    
<?
}
else
{
?>	
<input  type="hidden" name="nomor" value="<?=$e[ccnmr];?>">
<input  type="hidden" name="nomor1" value="<?=$e[ccnmr1];?>">
<input  type="hidden" name="status" value="N">
<input  type="hidden" name="status2" value="Open">
<input  type="hidden" name="levelcc" value="<?=$e[levelcc];?>">
<input  type="hidden" name="pengirim" value="<?=$e[ccpengirim];?>">
<input  type="hidden" name="pengirim1" value="<?=$e[ccpengirim1];?>">

 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[cctgl];?>" required="required"><? echo tgl_indo($e[cctgl]); ?>
        <input type="hidden" name="tgl_trm" value="<?=$e[cctgl_trm];?>">
        </div>
    </div>

<?
}
?>
<div class="control-group">
    	<label class="control-label" for="tingkat">Tingkat Perubahan</label>
        <div class="controls">
          	 <select id="tingkat" class="chzn-select span3" name="tingkat" required="required">
            <?php
		if ($e[cctingkat]=='Mayor')
		{
		    echo"<option>Pilih Tingkat Perubahan</option>
		    <option value='Mayor' selected>MAYOR</option>
		    <option value='Minor'>MINOR</option>
		    ";
		}
		elseif ($e[cctingkat]=='Minor') {
		     echo"<option>Pilih Tingkat Perubahan</option>
		     <option value='Mayor'>MAYOR</option>
		    <option value='Minor' Selected>MINOR</option>
		    ";
		}
		else {
		     echo"<option selected>Pilih Tingkat Perubahan</option>
		    <option value='Mayor'>MAYOR</option>
		    <option value='Minor'>MINOR</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
<div class="control-group">
    	<label class="control-label" for="Jeniscc">Jenis Perubahan</label>
        <div class="controls">
          	 <select id="jeniscc" class="chzn-select span9" name="jeniscc" required="required">
            	<option>Pilih/Cari Jenis Change Control</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jeniscc WHERE kode_jcc='$e[jeniscc]'"));
				echo"<option value='$e[jeniscc]' selected>$v[nama_jcc]</option>";
				$vc = mysql_query("SELECT kode_jcc, nama_jcc FROM jeniscc ORDER BY kode_jcc ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jcc]'>$dvc[nama_jcc]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Nomor</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[ccperihal];?>"> <br>Kode Sediaan/Bahan/Alat/Ruangan/Dokumen*</div>
    </div>
 <div class="control-group">
		<label class="control-label" for="perihal">Nama </label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal1" value="<?=$e[ccperihal1];?>"> Produk/Bahan/Alat/Ruangan/Dokumen*</div>
    </div>

   <div class="control-group">
    	<label class="control-label" for="isi_cc_sblm">Proses/Prosedur/Perihal yang berlaku</label>
        <div class="controls">
        	<textarea name="ket" id="editor" style="width: 610px; height: 100px"><?php echo $e[ccket];?></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Lanjut</button> 
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="edit2"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
?>
<form method="post" action="include/ccinter/aksi_ccinter.php?act=edit&id=<?=$e[ccid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit usulan CC (2/2)</legend>

<input type=hidden name=nomor value='<?=$_POST[nomor];?>'>
<input type=hidden name=nomor1 value='<?=$_POST[nomor1];?>'>
<input type=hidden name=tgl value='<?=$_POST[tgl];?>'>
<input type=hidden name=tgl_trm value='<?=$_POST[tgl_trm];?>'>
<input type=hidden name=status value='<?=$_POST[status];?>'>
<input type=hidden name=status2 value='<?=$_POST[status2];?>'>
<input type=hidden name=levelcc value='<?=$_POST[levelcc];?>'>
<input type=hidden name=pengirim value='<?=$_POST[pengirim];?>'>
<input type=hidden name=pengirim1 value='<?=$_POST[pengirim1];?>'>
<input type=hidden name=pengirim2 value='<?=$_POST[pengirim2];?>'>
<input type=hidden name=tingkat value='<?=$_POST[tingkat];?>'>
<input type=hidden name=jeniscc value='<?=$_POST[jeniscc];?>'>
<input type=hidden name=perihal value='<?=$_POST[perihal];?>'>
<input type=hidden name=perihal1 value='<?=$_POST[perihal1];?>'>
<input type=hidden name=ket value='<?=$_POST[ket];?>'>

  <div class="control-group">
    	<label class="control-label" for="isi_cc_ssdh">Usulan Perubahan</label>
        <div class="controls">
        	<textarea name="ket2" id="editor" style="width: 610px; height: 100px"><?=$e[ccket2];?></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="alasan_cc">Alasan Perubahan</label>
        <div class="controls">
        	<textarea name="ket3" id="alasan_cc" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[ccket3];?></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="daftar_dok">Daftar Dokumen yang berkaitan dengan Usulan Perubahan</label>
        <div class="controls">
        	<textarea name="ket4" id="alasan_cc" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[ccket4];?></textarea>
        </div>
    </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran CC/Risiko</label>
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
// untuk memberitahukan kalau CC harus diperbaiki atau ditolak (lewat memo internal)
}elseif($_GET[act]=="balas"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Jawab Usulan Change Control yang perlu diperbaiki</legend>
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
          	 <select id="jeniscc" name="jenisms" required="required" class="chzn-select span8">
            	<option value=30 selected>Change Control</option>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<? echo" Balas CC : $e[ccperihal] - $e[ccperihal1]";?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Usulan Change Control</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><br><? $cctgl=tgl_indo($e[cctgl]); echo" Berdasar usulan CC tanggal : $cctgl dari $ef[cJabatan], perihal CC : <br><blockquote>No. Kode : $e[ccperihal] - Nama : $e[ccperihal1], Isi Usulan Perubahan :$e[ccket3]</blockquote>";?></textarea>
        </div>
    </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran CC/Risk</label>
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


<form method="post" action="include/ccinter/aksi_ccinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Daftar Personil yang Membahas dan Menyetujui Hasil Pembahasan (ACC) usulan Penanganan Perubahan </legend>
	<div class="control-group">
    	<label class="control-label" for="csin">Nama Personil :</label>
        <div class="controls">
        	<select multiple="multiple" id="csin" name="csin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM csin WHERE ccid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM csin WHERE ccid='$_GET[id]')");
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
    $cc = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ccid='$_GET[id]'"));
    ?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Pembahasan :</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value='<? echo "$cc[tgl_baca]"; ?>'></div>
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="csin">Disetujui oleh =<br> AMPR (Lv.1-2)<br> MPM/Pgs.MPM (Lv.3)</label>
        <div class="controls">
        	<select multiple="multiple" id="ccsin" name="ccsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM ccsin WHERE ccid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM ccsin WHERE ccid='$_GET[id]')");
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
     if ($_SESSION[cv]=='99'){ 
    $ccs = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]'"));
    ?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Persetujuan :</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgls" value='<? echo "$ccs[tgl_baca]"; ?>'></div>
    </div>
    <?php } ?>
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

  $q=mysql_query("UPDATE ccsin SET tgl_baca = '$_POST[tgl_baca]', 
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
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));
	$e33 = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	?>

<strong>
<legend>Detail Usulan Change Control</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor Change Control </td><td>: <?=$e[ccnmr1];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[cctgl]);?></td></tr>
    <tr><td>Jenis Perubahan </td><td>: <?=$efg[nama_jcc];?></td></tr>
    <tr><td>Level Perubahan </td><td>: <?=$e[levelcc];?></td></tr>
    <tr><td>Tingkat Perubahan</td><td>: <?=$e[cctingkat];?></td></tr>
    <tr><td>No.Kode Sediaan/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal];?></td></tr>
    <tr><td>Nama Produk/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal1];?></td></tr>
	<tr><td>Usulan dari</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cJabatan];?>)- <?=$e33[cNama];?> (<?=$e33[cJabatan];?>)</strong></td></tr>
	<tr><td>Proses/Prosedur/Perihal yang berlaku</td><td>: <?php echo preg_replace("/Â/","", $e[ccket]); ?><?php //echo $e[ccket];?></td></tr>
	<tr><td>Usulan Perubahan</td><td>: <?php echo preg_replace("/Â/","", $e[ccket2]); ?><?php //echo $e[ccket2];?></td></tr>
	<tr><td>Alasan Perubahan</td><td>: <?php echo preg_replace("/Â/","", $e[ccket3]); ?><?php //echo $e[ccket3];?></td></tr>
	<tr><td>Daftar Dokumen yang terkait Perubahan</td><td>: <?= preg_replace("/Â/","", $e[ccket4]); ?><?php //echo $e[ccket4];?></td></tr>
	<tr><td>Lampiran CC/Risiko </td><td><a href='usulancc/<? echo"$e[ccfile]"; ?>'>: <? echo"$e[ccfile]"; ?></a></td></tr>
	<tr><td>Izin POM/Regulator terkait ? </td><td>: <?
	if ($e[ceklist]==1) {
	echo"Perubahan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulator terkait diterima, perubahan telah disetujui oleh BPOM /regulator terkait, pemberitahuan perubahan akan dilaporkan ke BPOM oleh : $e[lapor_oleh] tanggal : $e[tgl_lapor]";
    }
	elseif ($e[ceklist]==2) {
    echo"Perubahan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulator terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulator terkait bersama dengan perubahan dokumen secara bertahap";
    }
	elseif ($e[ceklist]==3) { 
    echo"Perubahan telah di setujui oleh BPOM/regulator terkait tanggal : $e[accpom]";
    }
	else {
    echo"Tidak diperlukan pemberitahuan perubahan kepada BPOM/Regulator terkait";
    }
	
	?>
	</td></tr>
	<tr><td>Status CC</td><td>: <strong>
<?
if ($e[ccstatus]=='N')
{
	echo"Belum Diterima Petugas Change Control/ Dokumen";
}
else
{
	echo"Diterima Petugas Change Control/ Dokumen";
}
?>
<? if($e[ccstatus]=='N' AND $_SESSION[cv]=='99' AND $e[accsipengirim1]=='Y' OR $e[ccstatus]=='N' AND $_SESSION[cv]=='55'  AND $e[accsipengirim1]=='Y' OR $e[ccstatus]=='N' AND $_SESSION[cv]=='81'  AND $e[accsipengirim1]=='Y'){ 
echo"<br><a href='include/ccinter/aksi_ccinter.php?act=acc&id=$e[ccid]&id2=1' onClick=\"return confirm('Yakin akan ACC usulan CC ini di Level 1??')\" class='btn btn-info'>Terima Lv1</a> | <a href='include/ccinter/aksi_ccinter.php?act=acc&id=$e[ccid]&id2=2' onClick=\"return confirm('Yakin akan ACC usulan CC ini di Level 2??')\" class='btn btn-info'>Terima Lv2</a> | <a href='include/ccinter/aksi_ccinter.php?act=acc&id=$e[ccid]&id2=3' onClick=\"return confirm('Yakin akan ACC usulan CC ini di Level 3??')\" class='btn btn-info'>Terima Lv3</a>";
 } ?>

	</strong></td></tr>
	</table>
	<br></strong>


<legend>Yang menyetujui Hasil Pembahasan Pengendalian Perubahan :</legend>
<table class="table table-bordered table-striped" width="100%">
<thead>
	<td>User</td>
    <td>Nama</td>
	<td>Tanggal Pembahasan</td>
	
</thead>
<?php


	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cFoto, a.cJabatan,b.tgl_baca, b.comment, b.nama FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ccid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM csin WHERE ccid='$_GET[id]'");
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
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo1($t[tgl_baca]); };echo"</td>
						 <td>$t[comment]</td>
			 </tr>";
		}
		else {
		    	echo "<tr>
				<td>$t[cJabatan]</td>
				<td width=35%>
					
					$t[nama] 
				</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo1($t[tgl_baca]); };echo"</td>
					
			 </tr>";
		}
		
		

	}
	
	?>
</table>

<div style="display: flex; align-items: center; justify-content: end;">
    <!--<button-->
    <!--    spawner-->
    <!--    scheme="https"-->
    <!--    host="thread.ekfpb.com"-->
    <!--    user="<?php //echo $user['session'] ?>"-->
    <!--    app="cc"-->
    <!--    foreign="<?php //echo $_GET['id'] ?>"-->
    <!--    style="background-color: rgb(6 182 212); border: none; border-radius: 0.375rem; padding: 0.25rem 0.75rem; font-size: 0.875rem; line-height: 1.25rem; color: white; transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 300ms; text-transform: uppercase; font-weight: 600; cursor: pointer;">-->
    <!--        pembahasan-->
    <!--</button>-->
</div>

<br /><br />
<legend>Usulan Perubahan Disetujui oleh :</legend>
<table class="table table-bordered table-striped" width="100%">
<thead>
	<td>User</td>
    <td>Nama</td>
	<td>Tanggal</td>
	<td>Status</td>
	<td>Alasan</td>
</thead>
<?php

			    
			    	$psn = mysql_query("SELECT a.cUser,a.cNama, a.cJabatan, a.cFoto,b.tgl_baca, b.comment, b.sistatus2, b.nama FROM users a
						LEFT JOIN ccsin b ON b.cId=a.cId
						WHERE b.ccid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM ccsin WHERE ccid='$_GET[id]'");
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
				
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo1($t[tgl_baca]); };echo"</td>
			 <td>$t[sistatus2]</td>
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
				
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo1($t[tgl_baca]); };echo"</td>
			 <td>$t[sistatus2]</td>
			 <td>$t[comment]</td>
			 </tr> ";
	}
			 
			 
			}	
			
	
	
	?>
</table>
<br><br>
<?php	
if ($_SESSION[cv]=='3' OR $_SESSION[cv]=='51' OR $_SESSION[cv]=='99'){ 
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {

echo"
<form method='post' action='?pages=usracc&act=acccc'>
<label class='control-label' for='info'><b>Pilih Diterima/Ditolak terhadap perubahan dan alasannya :</b></label>
<input type=hidden name='ccid' value='$_GET[id]'>
Status : <select name=status>
    <option value='diterima'>Diterima</option>
    <option value='ditolak'>Ditolak</option>
</select>
<br>Alasan : <textarea name='comment'>$baca[comment]</textarea>
<br><button class='btn btn-primary'>SUBMIT</button>
</form>
";

}
elseif  ($baca1[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
mysql_query("UPDATE ccsin SET sistatus='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");

}
else
{
if ($_SESSION[cv]=='99'){ 
$baca3 = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]'"));
echo"
<form method='post' action='?pages=usracc&act=acccc'>
<label class='control-label' for='info'><b>Pilih Diterima/Ditolak terhadap perubahan dan alasannya :</b></label>
<input type=hidden name='ccid' value='$_GET[id]'>
Status : <select name=status>
    <option value='$baca3[sistatus2]'>$baca3[sistatus2]</option>
    <option value='diterima'>Diterima</option>
    <option value='ditolak'>Ditolak</option>
</select>
<br>Alasan : <textarea name='comment'>$baca3[comment]</textarea>
<br><button class='btn btn-primary'>UPDATE</button>
</form>
";
  
}
}
}
?>

<br><br>
<? echo"<a href='home1.php?pages=ccinter&act=print&id=$e[ccid]' class='btn btn-info pull-right target=_blank'><i class='icon-print'></i> Cetak Usulan CC</a><br>";?>

<?

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtcc a 
									LEFT JOIN cdis b ON a.ccid=b.ccid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ccinter d ON a.ccid=d.ccid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.ccid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM rtcc WHERE dPendisposisi='55' AND ccid='$_GET[id]' OR dPendisposisi='81' AND ccid='$_GET[id]' OR dPendisposisi='99' AND ccid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM rtcc a WHERE a.ccid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

//AND a.pId='49' 
$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='81' OR a.ccid='$_GET[id]' AND a.pId='55' OR a.ccid='$_GET[id]' AND a.pId='99' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>
<?php
$sql =  mysql_num_rows(mysql_query("SELECT * FROM cdis WHERE pId='81' && psACC='Y' && ccid='$_GET[id]' GROUP BY ccid"));
$sql2 =  mysql_num_rows(mysql_query("SELECT * FROM cdis WHERE pId='81' && ccid='$_GET[id]'"));
var_dump($sql == $sql2);
?>
	<!--<a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-warning'>Permintaan Implementasi</a>-->
	
	<!--<a href='include/ccinter/aksi_ccinter.php?act=hapus&id=' onClick=\"return confirm('Yakin, akan melakukan Permintaan Implementasi ??')\">Permintaan Implementasi</a>-->
	<a href='include/ccinter/aksi_ccinter.php?act=persetujuainimprove&id=<?php echo $_GET[id] ?>' onClick=\"return confirm('Yakin, akan melakukan Permintaan Implementasi ??')\" class='btn btn-info'>Permintaan Implementasi</a>
<!-- isi disposisi-->
<legend>DAFTAR RENCANA TINDAKAN CHANGE CONTROL</legend>
<?
echo"Lampiran Rencana Tindakan CC : <a href='rtcc/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
    <td width=5%><b>No.</b></td>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>PenanggungJawab</b></td>
	<td><b>Rencana Tindakan</td>
	<td><b>Info Pelaksanaan RTCC</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
//OR a.ccid='$_GET[id]' AND a.pId='49'
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='81' OR a.ccid='$_GET[id]' AND a.pId='55' OR a.ccid='$_GET[id]' AND a.pId='99' ORDER BY a.urut ASC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN cdis b ON b.cId=a.cId WHERE b.ccid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglSelesai2 = tgl_indo($t[psTglselesai2]);
	$tglSelesai3 = tgl_indo($t[psTglselesai3]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	$tgltarget2 = tgl_indo($t[ptgls2]);	
	$tgltarget3 = tgl_indo($t[ptgls3]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="0000-00-00";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="0000-00-00";
	}
	if ($t[psACC]=="N" AND $t[info]!=""){
		echo "<tr class='warning'>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Bts Waktu-1 :</b><br> $tgltarget<br><b>Bts Waktu-2 :</b><br> $tgltarget2<br><b>Bts Waktu-3 :</b><br> $tgltarget3</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td><b>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				</td>
				
				<td><b>Tgl Hasil:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}
    elseif ($t[psACC]=="Y"){
		echo "<tr class='success'>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Bts Waktu-1 :</b><br> $tgltarget<br><b>Bts Waktu-2 :</b><br> $tgltarget2<br><b>Bts Waktu-3 :</b><br> $tgltarget3</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td><b>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				<br>Lampiran : <a href='jwb_rtcc/$t[filedis]'>Jika ada Klik disini</a></td>
				</td>
				
				<td><b>Tgl Hasil:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}
	else{
		echo "<tr>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Bts Waktu-1 :</b><br> $tgltarget<br><b>Bts Waktu-2 :</b><br> $tgltarget2<br><b>Bts Waktu-3 :</b><br> $tgltarget3</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				<td><b>Tgl Hasil:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}
}
?>
<? echo"</table>"; } ?>
<?	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));
?>
<? echo"<a href='home1.php?pages=ccinter2&act=print&id=$e[ccid]' class='btn btn-info pull-left' target=_blank><i class='icon-print'></i> Cetak Persetujuan</a><br>";
//fitur halaman kembali
}elseif($_GET[act]=="kembali"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));
	$e33 = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
	?>

<strong>
<legend>Detail Usulan Change Control</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor Change Control </td><td>: <?=$e[ccnmr1];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[cctgl]);?></td></tr>
    <tr><td>Jenis Perubahan </td><td>: <?=$efg[nama_jcc];?></td></tr>
    <tr><td>Level Perubahan </td><td>: <?=$e[levelcc];?></td></tr>
    <tr><td>Tingkat Perubahan</td><td>: <?=$e[cctingkat];?></td></tr>
    <tr><td>No.Kode Sediaan/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal];?></td></tr>
    <tr><td>Nama Produk/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal1];?></td></tr>
	<tr><td>Usulan dari</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cJabatan];?>)- <?=$e33[cNama];?> (<?=$e33[cJabatan];?>)</strong></td></tr>
	<tr><td>Proses/Prosedur/Perihal yang berlaku</td><td>: <?php echo preg_replace("/Â/","", $e[ccket]); ?><?php //echo $e[ccket];?></td></tr>
	<tr><td>Usulan Perubahan</td><td>: <?php echo preg_replace("/Â/","", $e[ccket2]); ?><?php //echo $e[ccket2];?></td></tr>
	<tr><td>Alasan Perubahan</td><td>: <?php echo preg_replace("/Â/","", $e[ccket3]); ?><?php //echo $e[ccket3];?></td></tr>
	<tr><td>Daftar Dokumen yang terkait Perubahan</td><td>: <?= preg_replace("/Â/","", $e[ccket4]); ?><?php //echo $e[ccket4];?></td></tr>
	<tr><td>Lampiran CC/Risiko </td><td><a href='usulancc/<? echo"$e[ccfile]"; ?>'>: <? echo"$e[ccfile]"; ?></a></td></tr>
	<tr><td>Izin POM/Regulator terkait ? </td><td>: <?
	if ($e[ceklist]==1) {
	echo"Perubahan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulator terkait diterima, perubahan telah disetujui oleh BPOM /regulator terkait, pemberitahuan perubahan akan dilaporkan ke BPOM oleh : $e[lapor_oleh] tanggal : $e[tgl_lapor]";
    }
	elseif ($e[ceklist]==2) {
    echo"Perubahan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulator terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulator terkait bersama dengan perubahan dokumen secara bertahap";
    }
	elseif ($e[ceklist]==3) { 
    echo"Perubahan telah di setujui oleh BPOM/regulator terkait tanggal : $e[accpom]";
    }
	else {
    echo"Tidak diperlukan pemberitahuan perubahan kepada BPOM/Regulator terkait";
    }
	
	?>
	</td></tr>
	<tr><td>Status CC</td><td>: <strong>
<?
if ($e[ccstatus]=='N')
{
	echo"Belum Diterima Petugas Change Control/ Dokumen";
}
else
{
	echo"Diterima Petugas Change Control/ Dokumen";
}
?>
<? if($e[ccstatus]=='N' AND $_SESSION[cv]=='99' AND $e[accsipengirim1]=='Y' OR $e[ccstatus]=='N' AND $_SESSION[cv]=='55'  AND $e[accsipengirim1]=='Y' OR $e[ccstatus]=='N' AND $_SESSION[cv]=='81'  AND $e[accsipengirim1]=='Y'){ 
echo"<br><a href='include/ccinter/aksi_ccinter.php?act=acc&id=$e[ccid]&id2=1' onClick=\"return confirm('Yakin akan ACC usulan CC ini di Level 1??')\" class='btn btn-info'>Terima Lv1</a> | <a href='include/ccinter/aksi_ccinter.php?act=acc&id=$e[ccid]&id2=2' onClick=\"return confirm('Yakin akan ACC usulan CC ini di Level 2??')\" class='btn btn-info'>Terima Lv2</a> | <a href='include/ccinter/aksi_ccinter.php?act=acc&id=$e[ccid]&id2=3' onClick=\"return confirm('Yakin akan ACC usulan CC ini di Level 3??')\" class='btn btn-info'>Terima Lv3</a>";
 } ?>

	</strong></td></tr>
	</table>
	<br></strong>
<!--Form pengembalian usulan cc-->

<legend>Form Pengembalian Change Control</legend>
<form method="post" action="include/ccinter/aksi_ccinter.php?act=addkembali&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?php  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    

    <div class="control-group">
		<label class="control-label">Keterangan <span style="color:red">*</span><br>
		
		</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="komentar" name="komentar" required="required" minlength="8" style="width: 570px; height: 100px" placeholder="Isi Keterangan pengembalian Dengan Jelas Untuk Dikembalikan."></textarea>
    </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim Kembali</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>


<div style="display: flex; align-items: center; justify-content: end;">
   
</div>

<br><br>
<?php	
if ($_SESSION[cv]=='3' OR $_SESSION[cv]=='51' OR $_SESSION[cv]=='99'){ 
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {

echo"
<form method='post' action='?pages=usracc&act=acccc'>
<label class='control-label' for='info'><b>Pilih Diterima/Ditolak terhadap perubahan dan alasannya :</b></label>
<input type=hidden name='ccid' value='$_GET[id]'>
Status : <select name=status>
    <option value='diterima'>Diterima</option>
    <option value='ditolak'>Ditolak</option>
</select>
<br>Alasan : <textarea name='comment'>$baca[comment]</textarea>
<br><button class='btn btn-primary'>SUBMIT</button>
</form>
";

}
elseif  ($baca1[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
mysql_query("UPDATE ccsin SET sistatus='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");

}
else
{
if ($_SESSION[cv]=='99'){ 
$baca3 = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]'"));
echo"
<form method='post' action='?pages=usracc&act=acccc'>
<label class='control-label' for='info'><b>Pilih Diterima/Ditolak terhadap perubahan dan alasannya :</b></label>
<input type=hidden name='ccid' value='$_GET[id]'>
Status : <select name=status>
    <option value='$baca3[sistatus2]'>$baca3[sistatus2]</option>
    <option value='diterima'>Diterima</option>
    <option value='ditolak'>Ditolak</option>
</select>
<br>Alasan : <textarea name='comment'>$baca3[comment]</textarea>
<br><button class='btn btn-primary'>UPDATE</button>
</form>
";
  
}
}
}
?>

<br><br>
<? echo"<a href='home1.php?pages=ccinter&act=print&id=$e[ccid]' class='btn btn-info pull-right target=_blank'><i class='icon-print'></i> Cetak Usulan CC</a><br>";?>

<?	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));
?>
<? echo"<a href='home1.php?pages=ccinter2&act=print&id=$e[ccid]' class='btn btn-info pull-left' target=_blank><i class='icon-print'></i> Cetak Persetujuan</a><br>";?>

<?
}// end form kembali
else{
?>
<div>
<div class="span12">
    <button class="btn-info btn-small" onclick="window.location.href='home3.php?pages=ccinter'"><< Hide Menu</button><button class="btn-info btn-small" onclick="window.location.href='home.php?pages=ccinter'">Show Menu >></button><br>
	<!--<button class="btn-info btn-large" onclick="window.location.href='?pages=ccinter&act=tambah'">Buat Usulan Change Control</button>       -->
	
		<br /><br />
	
	<?php

    if ($_SESSION[cv]=='81' OR $_SESSION[cv]=='99')
    {
// 	$smasuk = mysql_query("SELECT * FROM ccinter  ORDER BY cctgl DESC");
	
	$smasuk = mysql_query("SELECT * FROM ccinter ORDER BY cctgl DESC");
     ?>
<div style="width:auto;overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tgl CC</th>
			<th>No & Nama CC</th>
			<th width=10%>Status</th>
            <th class='center' width=25%>Aksi</th>
            <th>Pengusul</th>
			<th>Jenis CC</th>
			<th width=10%>Usulan CC</th>
		</tr>
	</thead>
	<tbody>
	<?
		while($s = mysql_fetch_array($smasuk)) {
		    $ccsin = mysql_query("SELECT * FROM ccsin WHERE ccid=$s[ccid]");
		    $cs = mysql_fetch_array($ccsin);
		    if ($cs[sistatus2]=='ditolak')
		    {
			    if ($s[ccstatus]=='N'){
			        echo "<tr class=success>";
		        }else{
			        echo "<tr class=warning>";
                }
		    }
		    else
		    {
		        
		        if($s[ccstatus]=='N' && $s[ccstatus3]=='Tidak'){
			        echo "<tr class=success>";
		        }elseif($s[ccstatus]=='N' && $s[ccstatus3]=='Kirim Kembali'){
		            echo "<tr class=warning>";
		        }
		        else{
			        echo "<tr>";
                }
		    }
		
				$sub_kalimat = substr($s[ccket2],0,100);
		echo "  <td><font size=1>$s[ccstatus]</font></td><td><font size=1>";echo tgl_indo($s[cctgl]);echo"</font></td>
				<td><font size=2>$s[ccnmr1]<br>$s[ccperihal1]</font></td>
                
				";
				
				if ($s[ccstatus]=='N'){

			  if ($s[accsipengirim1]=='N')
					{
					        if ($_SESSION[cv]=='55') {
			echo "<td><b>Belum Dikirim Pengusul</b></td>";
					        }
					        else
					        {
			echo "<td><b>Belum Dikirim Pengusul</b></td>";
					        }
			echo"
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				
				</td>";
					}
				elseif ($s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima PCC</b></td>
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Terima</a>
				
				
			<a href='home.php?pages=ccinter&act=kembali&id=$s[ccid]' class='btn btn-warning'>Return</a>
				</td>";
					}
					else {
			echo "<td>
			<b>Belum diterima PCC</b>
			     </td>";
							echo "
				<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";	
					}
			$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ccpengirim1]"));
		    $j = mysql_fetch_array(mysql_query("SELECT * FROM jeniscc WHERE kode_jcc=$s[jeniscc]"));		
			echo"<td><font size=1>$p[cJabatan]</font></td>
			    <td><font size=1>$j[nama_jcc]</font></td>
			    <td width=50><font size=1>"?>
			    <?php echo preg_replace("/Â/","", $s[ccket2]); ?><?php //echo $s[ccket2]; ?> <?php echo"</font></td>
				</tr>";
			}	else{
			    
			echo "<td><b>Diterima <br><font size=1>";echo tgl_indo($s[cctgl_trm]);echo"</font></b><br><b>($s[ccstatus2])</b>";
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ccpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jeniscc WHERE kode_jcc=$s[jeniscc]"));
				echo "
				<td class='center'><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a><a href='home.php?pages=ccinter&act=lp&id=$s[ccid]' class='btn btn-info'>ACC</a><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a></td>
				</td>
				<td><font size=1>$p[cJabatan]</font></td>
			    <td><font size=1>$j[nama_jcc]</font></td>
			    <td width=50><font size=1>";?><?php echo preg_replace("/Â/","", $s[ccket2]); ?> <?php //echo $s[ccket2]; ?><?php echo"</font></td>
				</tr>";	
	}
	}
	

    }
    

	else {

	$smasuk = mysql_query("SELECT * FROM ccinter WHERE ccpengirim=$_SESSION[cv]  OR ccpengirim1=$_SESSION[cv] OR ccpengirim2=$_SESSION[cv] AND `show`='Y'  ORDER BY cctgl DESC");

     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tgl CC</th>
			<th>No & Nama CC</th>
			<th width=10%>Status</th>
            <th class='center' width=25%>Aksi</th>
            <th width=10%>Usulan CC</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
// 			if ($s[ccstatus]=='N'){
// 			echo "<tr class=success>";
// 		}else{
// 			echo "<tr>";
			
// 		}
		
		 if($s[ccstatus]=='N' && $s[ccstatus3]=='Tidak'){
			        echo "<tr class=success>";
		        }elseif($s[ccstatus]=='N' && $s[ccstatus3]=='Kirim Kembali'){
		            echo "<tr class=warning>";
		        }
		        else{
			        echo "<tr>";
                }
		$p = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$s[ccpengirim1]"));
		$j = mysql_fetch_array(mysql_query("SELECT * FROM jeniscc WHERE kode_jcc=$s[jeniscc]"));
		
		$kirimkembali = mysql_fetch_array(mysql_query("SELECT * FROM cckembali WHERE ccid=$s[ccid]"));
		
// 		var_dump($kirimkembali[komentar]);die();
		$sub_kalimat = substr($s[ccket2],0,100);
		
		echo "  <td><font size=1>$s[ccstatus]</font></td><td><font size=1>";echo tgl_indo($s[cctgl]);echo"</font></td>
				<td><font size=2>$s[ccnmr1]<br>$s[ccperihal1]</font>";?> 
				<?php
				if($kirimkembali !== null){?>
				    <br>Catatan Pengembalian : <font size=2><?php echo $kirimkembali[komentar] ?></font>
				<?php
				}else{
				?>
				    
				<?php }
				
				?>
				<?php echo"</td>
			
				";
				
				if ($s[ccstatus]=='N'){
					if ($s[ccpengirim1]==$_SESSION[cv] AND $s[ccpengirim2]==$_SESSION[cv])
					{
			echo "<td><a href='include/ccinter/aksi_ccinter.php?act=acc&id=$s[ccid]' onClick=\"return confirm('Yakin akan kirim/ACC usulan CC ini??')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ccpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/ccinter/aksi_ccinter.php?act=acc2&id=$s[ccid]' onClick=\"return confirm('Yakin akan Kirim/ ACC Usulan CC ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[ccpengirim]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' OR $s[ccpengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Terkirim</b><br><b>($s[ccstatus2])</b></td>
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					
				elseif ($s[ccpengirim1]==$_SESSION[cv] AND $s[ccpengirim2]==0 AND $s[accsipengirim1]=='Y')
					{
			echo "<td><a href='include/ccinter/aksi_ccinter.php?act=acc&id=$s[ccid]' onClick=\"return confirm('Yakin akan ACC Usulan CC ini?')\" class='btn btn-info'>Kirim</a></td>
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			   elseif ($s[ccpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum Dikirim Pengusul</b></td>
			<td class='center'><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[ccpengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum diterima PCC</b></td>
			<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					else {
						if ($s[ccpengirim]==$s[ccpengirim1]) {
			echo "<td>
			<a href='include/ccinter/aksi_ccinter.php?act=acc&id=$s[ccid]' onClick=\"return confirm('Yakin akan Kirim/ACC usulan CC ini??')\" class='btn btn-info'>Kirim</a>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum ACC/Kirim</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='include/ccinter/aksi_ccinter.php?act=hapus&id=$s[ccid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=ccinter&act=edit&id=$s[ccid]' class='btn btn-info'>edit/update</a><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>
			";	
					}
					
				echo "<td width=200><font size=1>";?><?php echo preg_replace("/Â/","", $s[ccket2]); ?><?php echo"</font></td> ";
			
			}	else{
			    

					echo "<td><b>Diterima PCC<br><font size=1>";echo tgl_indo($s[cctgl_trm]);echo"</font></b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Detail</a>
				</td>
				<td width=200><font size=1>";?><?php echo preg_replace("/Â/","", $s[ccket2]); ?><?php echo"</font></td>
				</tr>";	
				
	}
	}
	
}
	?>
	</tbody>
</table>
</div>

<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>USULAN CHANGE CONTROL BELUM KIRIM/ DITERIMA PETUGAS CC!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail Usulan Change Control,<br>
	Cara Koreksi/EDIT dengan Klik <u>TOMBOL edit/update</u> di kolom Aksi,<br> 
	Untuk ACC Usulan Change Control Klik Link di kolom Status : <u>Terima!</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->