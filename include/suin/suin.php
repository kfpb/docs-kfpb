<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Surat Masuk Eksternal (Surat dari luar perusahaan dll untuk dibuat Disposisi)</div>
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
<form method="post" action="include/suin/aksi_suin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Surat Masuk</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Surat Masuk</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor"></div>
    </div>
<?php
	if($_SESSION[levelcv]==0  OR $_SESSION[cv]==79){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Surat</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM isurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" required="required" id="pengirim" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off">
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            	<option>Pilih Tujuan Surat</option>
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
    	<label class="control-label" for="kepada"><b>Jika Pgs/Plh</b></label>
        <div class="controls">
            <select id="kepada2" class="chzn-select" name="kepada2">
            	<option>Pilih Tujuan Pgs/Plh Surat</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
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
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM isurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" required="required" id="pengirim" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off">
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
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
    	<label class="control-label" for="Jenismemo">Jenis Surat</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span9" name="jenisms" required="required">
            	<option value=0>Pilih/Cari Jenis Surat</option>
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
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ringkasan/Isi Surat (Tekan Shift+Enter untuk pindah baris)</label>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM isurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
?>
<form method="post" action="include/suin/aksi_suin.php?act=edit&id=<?=$e[iid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Surat Masuk</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Surat</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e[inmr];?>"></div>
    </div>
<?php
	if($_SESSION[levelcv]<2  OR $_SESSION[cv]==79){
	?>
	
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[itgl];?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM isurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" id="pengirim" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[ipengirim];?>">
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
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
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM isurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" id="pengirim" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[ipengirim];?>">
        </div>
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
    	<label class="control-label" for="Jenismemo">Jenis Surat</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span9" name="jenisms" required="required">
            	<option>Pilih/Cari Jenis Surat</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jenisms WHERE kode_jms='$e[jenisms]'"));
				echo"<option value='$e[jenisms]' selected>$v[nama_jms]</option>";
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
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[iperihal];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ringkasan/Isi Surat (Tekan Shift+Enter untuk pindah baris)</label>
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
		<label class="control-label" for="tgl_bls">Tanggal Balas Surat</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_bls" type="text" name="tgl_bls" value="<?=$e[itgl_balas];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="nsb">Nomor Surat Balasan</label>
        <div class="controls"><input class="input-medium focused" id="nsb" type="text" name="nomor_bls" value="<?=$e[inmr_bls];?>"></div>
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
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM isurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
$f = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM isurat a,users b WHERE a.ikepada2=b.cId AND a.iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));

if ($e[ikepada]==$_SESSION[cv]){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE isurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");
}
if ($e[ikepada2]==$_SESSION[cv]){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE isurat SET istatus2='Y', itgl_baca2='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada2='$_SESSION[cv]'");
}
?>
<? echo"<a href='home1.php?pages=suin&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>

<legend>Detail Surat Masuk</legend>
<table width="100%" border=1>
	<tr><td width="14%">Nomor Surat</td><td>:  <strong><?=$e[inmr];?></strong></td></tr>
    <tr><td>Tanggal Surat</td><td>:  <strong><?=tgl_indo($e[itgl]);?></strong></td></tr>
    <tr><td>Perihal</td><td>:  <strong><?=$e[iperihal];?></td></strong></tr>
	<tr><td>Jenis Surat</td><td>:  <strong><?=$ef[nama_jms];?></strong></td></tr>
    <tr><td>Pengirim</td><td>: <strong><?=$e[ipengirim];?></strong></td></tr>
    <tr><td>Kepada</td><td>: <strong><?=$e[cJabatan];?> (<?=$e[cNama];?>), Pgs/Plh : <?=$f[cJabatan];?> (<?=$f[cNama];?>)</strong></td></tr>
	<tr><td>Lampiran</td><td>: <a class='btn btn-info' title="Lampiran" href="smasuk/<?=$e[ifile];?>">Klik Disini !</td></tr>
		<tr><td>Buat/Tambah Disposisi</td><td>: 
		
	<?php
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$e[iid]' ");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a class='btn btn-info' href='?pages=suin&act=tambahdisp&id=$e[iid]'>Buat Disposisi Klik Disini</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=suin&act=editdisp&id=$e[iid]'>Tambah Disposisi Klik Disini</i>";
					}
	?>
	</td></tr>	
	<tr><td>Tgl Balas Surat</td><td>: <strong><?=$e[itgl_balas];?></strong></td></tr>
	<tr><td>Nomor Surat Balasan</td><td>: <strong><?=$e[inmr_bls];?></strong></td></tr>
	
	</table>
	<br>
<table width="100%">
    <tr><td>Ringkasan/Info Surat :</td><tr>
	<tr><td><?=$e[iket];?></td></tr>
</table>
<iframe src='smasuk/<?=$e[ifile];?>' width=100% height=500></iframe>

<br />
<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi a 
									LEFT JOIN pdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN suin d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM disposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

/*if ($jds>0){
*/
?>

<!-- isi disposisi-->
<legend>History Disposisi :</legend>
<?
echo"Lampiran Disposisi : <a href='disposisi/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1>
<thead>
	<td width=12%><b>Tgl Disposisi</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Info</b></td>
	<td><b>Jawaban/Info</b></td>
	<td width=12%>Status</b></td> 
      
</thead>

<?   if($_SESSION[levelcv]==0 OR $_SESSION[cv]==79){ ?>

<?php

$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM pdis a WHERE a.iid='$_GET[id]' ORDER BY a.pdid DESC");


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
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>

<? } else { ?>    

<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM pdis a WHERE a.iid='$_GET[id]' ORDER BY a.pdid DESC");

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
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>

<? } ?>

</table>
<!-- /isi disposisi-->
<?php	

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

$query = "SELECT max(dNoagenda) as max_no FROM disposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);


?>
<form method="post" action="include/suin/aksi_suin.php?act=tambahdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Disposisi</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>

	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>

     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
		<?php
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
			
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
                <option value="C">Rahasia</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima disposisi harus jawab</option>
                <option value="N">Tidak, penerima disposisi tidak perlu jawab</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>*Bisa Pilih Grup Seperti Penerima Memo/Undangan
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
        <div class="controls">
			<textarea name="isi" id="editor"></textarea>
        </div>
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

$query = "SELECT max(dNoagenda) as max_no FROM disposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);
?>
<form method="post" action="include/suin/aksi_suin.php?act=editdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Disposisi</legend>

			<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls">
		<? echo"<input type=hidden name='noagenda' value='$e[dNoagenda]'><b>$e[dNoagenda]</b>";  ?>
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
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.iid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
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
            	<option value="Y" selected>Ya, penerima disposisi harus jawab</option>
                <option value="N">Tidak, penerima disposisi tidak perlu jawab</option>
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
	if($_SESSION[levelcv]<1  OR $_SESSION[cv]==79){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=suin&act=tambah'">Tambah Surat Masuk</button>
    <br /><br />
	<?php
	}
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
		<tr>
		    <th width=1%></th>
			<th>Tanggal</th>
			<th>Kepada</th>
			<th>Perihal</th>
			<th>Tgl Balasan</th>
            <th>Disposisi</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM isurat a, users b WHERE a.ikepada=b.cId OR a.ikepada2=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
		
		$smasuk = mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM isurat a, users b WHERE a.ikepada=b.cId OR a.ikepada2=b.cId ORDER BY a.itgl DESC");	
				
		while($s = mysql_fetch_array($smasuk)) {
		if (($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td></td>
                <td>";echo tgl_indo1($s[itgl]);echo"</td>
                <td>$s[cIdjab]</td>
                <td>$s[iperihal]</td><td>";
				if ($s[itgl_balas]==0000-00-00) { echo "Belum";} else { echo tgl_indo1($s[itgl_balas]) ; } 
				echo"</td>";
				echo "
				<td class='center'>";
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=suin&act=tambahdisp&id=$s[iid]' class='btn btn-info'>Buat</a>";
					}else{
						echo "<a href='?pages=suin&act=editdisp&id=$s[iid]' class='btn btn-info'>Tambah</i>";
					}
				
			echo "</td><td>
			<a href='home.php?pages=suin&act=detail&id=$s[iid]' class='btn btn-info' title='Detail'>Detail</a>
				<a href='smasuk/$s[ifile]' class='btn btn-info' target=_blank>File</a>
				<a href='include/suin/aksi_suin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=suin&act=edit&id=$s[iid]'> <i class='icon-edit'></i><a href='?pages=sout&act=tambah&id=$s[iid]'><i class='icon-arrow-right'></i>
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Masuk ke Detail untuk Konfirmasi Telah Dibaca Surat yang dibuat/ Jawaban Info Disposisi</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->