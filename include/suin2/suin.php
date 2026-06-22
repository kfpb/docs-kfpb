<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">eCAPA</div>
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
<form method="post" action="include/suin2/aksi_suin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat eCAPA</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Ditujukan Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            	<option>Pilih Tujuan</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
			?>
           	</select> 
        </div> 
    </div>
	<? }
	else { ?>
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"> <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>
    </div>
  
    <div class="control-group">
    	<label class="control-label" for="kepada">Pembuat</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
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
    	<label class="control-label" for="Jeniscapa">Jenis CAPA</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span4" name="jenisms" required="required">
            	<option value=0>Pilih/Cari Jenis CAPA</option>
	    	    <option value='14'>Improvement</option>
			    <option value='16'>Sasaran/ Target Mutu</option>
				<option value='22'>Kajian Resiko</option>
				<option value='23'>Keluhan/Kepuasan Pelanggan</option>	
				<option value='29'>Penyimpangan/NCP</option>
				<option value='6b'>Audit Internal</option>
				<option value='6r'>Audit Eksternal</option>
				<option value='6s'>Inspeksi Rutin</option>
				<option value='6c'>Data Registrasi</option>
				<option value='11'>Lain-Lain</option>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal CAPA</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal"><br>(contoh : Audit Internal Penyimpanan Semester-2 Tahun 2021)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="perihal">Bagian/Sub yang di Audit/Inspeksi</label>
        <div class="controls"><input class="input-xlarge focused" id="perihal" type="text" name="perihal2"><font color=red>Di isi khusus CAPA Audit/Inspeksi</font><br>(contoh : Penyimpanan Bahan Baku) </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ringkasan CAPA/Temuan (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
				<textarea name="ket" id="editor"></textarea>
        </div>
    </div>
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM ssurat WHERE iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ssurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
?>
<form method="post" action="include/suin2/aksi_suin.php?act=edit&id=<?=$e[iid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit eCAPA</legend>
<?php
	if($_SESSION[levelcv]<2){
	?>
	
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[itgl];?>" required="required"></div>
    </div>

	<div class="control-group">
    	<label class="control-label" for="kepada">Ditujukan Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            <?php
				echo "<option value=$e[ikepada] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
				echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<? } 
	else {
		
	 ?>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[itgl];?>"><? echo tgl_indo($e[itgl]); ?></div>
    </div>

	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            <?php
				echo "<option value=$e[ikepada] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				
			?>
           	</select>
        </div> 
    </div>
<? } ?>
	
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis CAPA</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span9" name="jenisms" required="required">
            	<option>Pilih/Cari Jenis CAPA</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jenisms WHERE kode_jms='$e[jenisms]'"));
				echo"<option value='$e[jenisms]' selected>$v[nama_jms]</option>
	    	    <option value='14'>Improvement</option>
			    <option value='16'>Sasaran/ Target Mutu</option>
				<option value='22'>Kajian Resiko</option>
				<option value='23'>Keluhan/Kepuasan Pelanggan</option>
				<option value='29'>Penyimpangan/NCP</option>
				<option value='6b'>Audit Internal</option>
				<option value='6r'>Audit Eksternal</option>
				<option value='6s'>Inspeksi Rutin</option>
				<option value='6c'>Data Registrasi</option>
				<option value='11'>Lain-Lain</option>";
				
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[iperihal];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="perihal">Bagian</label>
        <div class="controls"><input class="input-xlarge focused" id="perihal2" type="text" name="perihal2" value="<?=$e[iperihal2];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ringkasan eCAPA (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		<textarea name="ket" id="editor"><?=$e[iket];?></textarea>
    </div>
	</div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
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
}elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ssurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));

if ($e[ikepada]==$_SESSION[cv]){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE ssurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");

}
?>
<? 
/*
echo"<a href='home1.php?pages=suin2&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";
*/
?>
<strong>
<legend>Detail eCAPA</legend></strong>
<table width="100%" border=1>
    <tr><td width="14%">Tanggal</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Perihal </td><td>: <?=$e[iperihal];?></td></tr>
	<tr><td>Jenis CAPA</td><td>: <?=$ef[nama_jms];?></td></tr>
    <tr><td>Pembuat</td><td>: <strong><?=$e[cNama];?></strong></td></tr>
	<tr><td>Lampiran</td><td>: <a title="Lampiran" href="smasuk/<?=$e[ifile];?>">Klik Disini (Jika Ada)</td></tr>
	
	</table>
	<br>
<table width="100%">
    <tr><td>Keterangan CAPA :</td><tr>
	<tr><td><?=$e[iket];?></td></tr>
</table>

<br />
<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi a 
									LEFT JOIN pdiss b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN ssurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM disposisi2 WHERE dPendisposisi='$_SESSION[cv]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM disposisi2 a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>History CAPA untuk ditindaklanjuti :</legend>
<?
echo"<b><u>Lampiran Disposisi : <a href='disposisi/$edf[disfile]'>klik disini (jika ada)</a></b></u>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl </b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Tindakan/ CAPA</b></td>
	<td><b>Jawab/hasil/verifikasi</b></td>
	<td width=12%>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM pdiss a WHERE a.iid='$_GET[id]' OR a.iid='$_GET[id]' ORDER BY a.pdid DESC");

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
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br><b>Batas Waktu :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Batas Waktu :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi disposisi-->
<?php	
}
?>

<?php
//batas dari disposisi.php
}elseif($_GET[act]=="tambahdisp"){
	$iid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisi2 WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);


?>
<form method="post" action="include/suin2/aksi_suin.php?act=tambahdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Rencana Tindak Lanjut (RTL)/CAPA</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor RTL/CAPA</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[levelcv]!=0){
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
	?>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal Buat RTL CAPA</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required" value=<?=$tgl1;?>></div>
    </div>
	<? } else {	 ?>
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal Buat RTL CAPA</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
	<? } ?>
 
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat RTL CAPA</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
		            echo "<select id='pendisposisi' class='chzn-select' name='pendisposisi'>";
            
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

			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span4">
            	<option value="Y" selected>Ya, PIC RTL/CAPA harus jawab</option>
                <option value="N">Tidak, PIC RTL/CAPA tidak perlu jawab</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada (PIC RTL/CAPA)</label>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>*Pilih satu-satu sesuai RTL atau semua<br>
	<button type='button' class='chosen-toggle select'>Pilih Semua</button>
     <button type='button' class='chosen-toggle deselect'>Hapus Semua</button>
     		</div>
    </div>	<div class='control-group'>
		<label class='control-label' for='info'>Temuan : (Khusus CAPA)</label>
        <div class='controls'>
		<textarea name='temuan' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>
    </div>
	
	<div class='control-group'>
		<label class='control-label' for='info'>Persyaratan : (Khusus CAPA)</label>
        <div class='controls'>
		<textarea name='syarat' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'>Kondisi Saat Ini : (Khusus CAPA)</label>
        <div class='controls'>
		<textarea name='kondisi'' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'>GAP Analisis : (Khusus CAPA)</label>
        <div class='controls'>
		<textarea name='gap' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'>Root Cause : (Khusus CAPA)</label>
        <div class='controls'>
		<textarea name='rootcause' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>	    	     	
        </div> 

    <div class="control-group">
    	<label class="control-label" for="isi">Tindak Lanjut/CAPA</label>
        <div class="controls">
			<textarea name="isi" id="editor"></textarea>
        </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tgls">Tanggal Batas Waktu Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran (Jika ada)</label>
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
}elseif($_GET[act]=="editdisp"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE iid='$_GET[id]'"));
$iid = $e['iid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisi2 WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);
?>
<form method="post" action="include/suin2/aksi_suin.php?act=editdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah CAPA</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noagenda" value="<?$newID;?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal buat</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Tanggal Batas Waktu</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM disposisi a,users b WHERE a.dpendisposisi=b.cId AND a.iid='$_GET[id]'"));
			?>
					
			<select id="pendisposisi" class="chzn-select" name="pendisposisi">
            <?php
				echo "<option value=$e[dpendisposisi] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
				echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<?
		}      
		
		else { ?>
			<div class="control-group">
		<label class="control-label" for="noagenda">Nomor CAPA</label>
        <div class="controls">
		<? echo"<input type=hidden name='noagenda' value='$newID'><b>$newID</b>";  ?>
		</div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Tanggal Batas Waktu</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.iid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<?php
				$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
				foreach($sft as $v=>$t){
					if ($e[dSifat]==$v){
						echo "<option value='$v' selected>$t</option>";
					}else{
						echo "<option value='$v'>$t</option>";
					}
				}
				?>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima CAPA harus jawab</option>
                <option value="N">Tidak, penerima CAPA tidak perlu jawab</option>
            </select>
		</div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="pdis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select> *Bisa Pilih Grup Seperti Penerima Memo/Undangan
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instruksi/Informasi</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
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
<!-- batas dari disposisi.php -->
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<2){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=suin2&act=tambah'">Buat RTL CAPA</button>
    <br /><br />
	<?php
	}
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>Disposisi</th>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>Pengirim</th>
			<th>Kepada</th>
			<th>Perihal</th>
			<th>Tgl Dibaca</th>
			<th>Tgl Balasan</th>
            <th>Lampiran</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM ssurat a, users b WHERE a.ikepada=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
		
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM ssurat a, users b WHERE a.ikepada=b.cId");	
				
		while($s = mysql_fetch_array($smasuk)) {
		if (($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=suin2&act=tambahdisp&id=$s[iid]'>Buat</a>";
					}else{
						echo "<a href='?pages=suin2&act=editdisp&id=$s[iid]'>Tambah</i>";
					}
				
			echo "</td>";
			echo "<td><a href='home.php?pages=suin2&act=detail&id=$s[iid]' title=Detail'>$s[inmr]</a></td>
                <td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>SPD-MR</td>
                <td>$s[cNama]</td>
                <td>$s[iperihal]</td><td>";
				if ($s[itgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_baca]); } 
				echo"</td>
				<td>";
				if ($s[itgl_balas]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_balas]) ; } 
				echo"</td>	
                <td><a href='smasuk/$s[ifile]'>Lampiran</a></td>";
				echo "
				<td class='center'><a href='include/suin2/aksi_suin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=suin2&act=edit&id=$s[iid]'> <i class='icon-edit'></i><a href='?pages=sout&act=tambah&id=$s[iid]'><i class='icon-arrow-right'></i>
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Masuk ke Detail untuk Konfirmasi Telah Dibaca CAPA yang dibuat/ Jawaba hasil CAPA</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->