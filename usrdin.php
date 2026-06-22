<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Daftar Dokumen Internal yang dimiliki</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$e[jenisdok]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}

?>
<? /* echo"<a href='home1.php?pages=usrd&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>"; */?>
<strong>
<legend>Detail Dokumen Internal</legend>
<table width="100%" border=1>
<? 

    $dok1 = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait1]'"));
    $dok2 = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait2]'"));
    $dok3 = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait3]'"));
    
$server2 = "localhost";
$username2 = "sql_kfpb_kimiafa";
$password2 = "PeGPLkNzBaMz32kH";
$database2 = "sql_kfpb_kimiafa";

// Koneksi dan memilih database di server
$conn2 = mysql_connect($server2,$username2,$password2) or die("Koneksi gagal");
$select2 = mysql_select_db($database2) or die("Database tidak bisa dibuka");

  $pjdok = mysql_query("SELECT * FROM users WHERE cId='$e[dipjdok]'", $conn2);
  $r    = mysql_fetch_array($pjdok);
?>
    <tr><td>Penanggung Jawab Dokumen</td><td>: <?=$r[cNama];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Revisi</td><td>: <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
	<tr><td>Tanggal Berlaku Terakhir </td><td>: <?=tgl_indo($e[ditgl_brlk]);?></td></tr>
	<tr><td>Tanggal Maks Review </td><td>: <?=tgl_indo($e[ditgl_review]);?></td></tr>
    <tr><td>Tanggal Revisi 0 </td><td>: <?=tgl_indo($e[ditgl_rev0]);?></td></tr>
    <tr><td>Tanggal Revisi 1 </td><td>: <?=tgl_indo($e[ditgl_rev1]);?></td></tr>
    <tr><td>Tanggal Revisi 2 </td><td>: <?=tgl_indo($e[ditgl_rev2]);?></td></tr>
    <tr><td>Tanggal Revisi 3 </td><td>: <?=tgl_indo($e[ditgl_rev3]);?></td></tr>
    <tr><td>Tanggal Revisi 4 </td><td>: <?=tgl_indo($e[ditgl_rev4]);?></td></tr>
    <tr><td>Tanggal Revisi 5 </td><td>: <?=tgl_indo($e[ditgl_rev5]);?></td></tr>
    <tr><td>Tanggal Revisi 6 </td><td>: <?=tgl_indo($e[ditgl_rev6]);?></td></tr>
    <tr><td>Tanggal Revisi 7 </td><td>: <?=tgl_indo($e[ditgl_rev7]);?></td></tr>
    <tr><td>Tanggal Revisi 8 </td><td>: <?=tgl_indo($e[ditgl_rev6]);?></td></tr>
    <tr><td>Tanggal Revisi 9 </td><td>: <?=tgl_indo($e[ditgl_rev7]);?></td></tr>   
    <tr><td>Tanggal Review 1 </td><td>: <?=tgl_indo($e[ditgl_review1]);?></td></tr>
    <tr><td>Tanggal Review 2 </td><td>: <?=tgl_indo($e[ditgl_review2]);?></td></tr>
    <tr><td>Tanggal Review 3 </td><td>: <?=tgl_indo($e[ditgl_review3]);?></td></tr>

	<tr><td>Dokumen Terkait 1</td><td>: Kode :<?=$dok1[dikodok];?>- Judul :<?=$dok1[dijudok];?> </td></tr>
	<tr><td>Dokumen Terkait 2</td><td>: Kode :<?=$dok2[dikodok];?>- Judul :<?=$dok2[dijudok];?> </td></tr>
	<tr><td>Dokumen Terkait 3</td><td>: Kode :<?=$dok3[dikodok];?>- Judul :<?=$dok3[dijudok];?> </td></tr>
<? /*
    <tr><td>File Dokumen </td><td>: <a title='File Dokumen' href='dok/<?=$e[jenisdok];?>/<?=$e[difile];?>' target='_blank'>Klik Disini </a></td></tr>
    <tr><td><font color=red>Password PDF</font></td><td>: <font color=red><?=$e[pass];?></font></td></tr>
 <tr><td>File Dokumen </td><td>: <a title='File Dokumen' href='fdok/src/index1.php?id=<?=$e[suid];?>' target='_blank'>Klik Disini </a></td></tr>
 
	<tr><td>File Dokumen PDF</td><td>: <a target=_blank href="fdok/index1.php?id=<?=$e[suid];?>" target=_blank>Klik Disini!</a> Atau ada dibawah ! Atau Scan Me! (QR Code) <br>
  <img src="https://e-kfpb.co.id/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>">
	</td></tr>
*/ ?>
	</table>
	<a href='?pages=dinter&act=detail&id=<?=$e[suid];?>' class='btn btn-info' target=_blank>Daftar Penerima Dokumen</a>
	<br>
<!--<iframe src="dok/web/viewer.html?file=index1.php?id=<?php //echo $e[suid];?>" width=100% height=500></iframe>-->
<?php /*<iframe src="dok/<?=$e[jenisdok];?>/<?=$e[difile];?>" width=100% height=500></iframe>*/ ?>

<?php
// $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM dinter WHERE suid='%$_GET[id]%'");
//     $r = mysqli_fetch_array($edit);

//     $pdfFile = dirname(__DIR__ ) . "/$r[jenisdok]/$r[difile]";
//  if (file_exists($pdfFile)) {
     ?>
<?php if ($e['distatus'] != 'N') { ?>
         <!--<iframe src="dok/<?=$e[jenisdok];?>/<?=$e[difile];?>" width=100% height=500></iframe>-->
        <iframe src="dok/web/viewer.html?file=/dok/<?php echo $e['jenisdok']?>/<?php echo $e['difile'] ?>" width=100% height=500></iframe>
<?php } else { ?>
        <div class="alert alert-warning">
            <b>Perhatian:</b> Dokumen ini sudah obsolete. File PDF tidak ditampilkan.
        </div>
<?php } ?>
     
<?

	$ds = mysql_query("SELECT * FROM disposisidok WHERE suid='$e[suid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " <a href='?pages=usrdin&act=tambahdisp&id=$e[suid]' class='btn btn-info'>Review Dokumen</a>";
					}else{
						echo " <a href='?pages=usrdin&act=tambahdisp&id=$e[suid]' class='btn btn-info'>Review Dokumen</a>";
					}
					?>

<br><br>
<?php	
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM dsin WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca['tgl_baca']=='IS NULL') {
mysql_query("UPDATE dsin SET tgl_baca='$tgl_sekarang', distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca[tgl_baca]='IS NOT NULL' AND $baca[distatus]=='N') {
mysql_query("UPDATE dsin SET distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");
}

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN dinter d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.suid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM disposisidok WHERE dPendisposisi='$_SESSION[cv]' AND suid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPendisposisi FROM disposisidok a WHERE a.suid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddis a WHERE a.suid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>Review Dokumen oleh : <? echo"$_SESSION[namacv]"; ?></legend>
</strong>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Informasi</td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddis a WHERE a.suid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t['psTglbaca']=='IS NULL'){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t['psTglselesai']=='IS NULL'){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis</td>
				<td>$t[kepada] </td>
				<td>";
				if ($t[pSifat]==A) { echo"<b><u>Pemusnahan Dokumen</u></b>";}
				elseif ($t[pSifat]==B) { echo"<b><u>Review Dokumen</u></b>";}
				else { echo"<b><u>Sosialisasi Dokumen</u></b>";}
				echo"<br>$t[pInstruksi]
			    <br>Lampiran : <a href='disposisidok/$t[disfiles]'>klik disini (jika ada)</a>
				</td>
				<td><b>Tgl Baca/Selesai :</b><br> $tglBaca</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>$t[kepada]</td>
				<td>";
				if ($t[pSifat]==A) { echo"<b><u>Pemusnahan Dokumen</u></b>";}
				elseif ($t[pSifat]==B) { echo"<b><u>Review Dokumen</u></b>";}
				else { echo"<b><u>Sosialisasi Dokumen</u></b>";}
				echo"<br>$t[pInstruksi]
				<br>Lampiran : <a href='disposisidok/$t[disfiles]'>klik disini (jika ada)</a>
				</td>
				<td><b>Tgl Baca/Selesai:</b><br> $tglBaca</td>
			 </tr>";
	}
}
?>
</table>

<!-- /isi disposisi-->
<?



}
}
//batas dari disposisi.php
elseif($_GET['act']=="tambahdisp"){
$suid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisidok WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("RD-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/dinter/aksi_dinter.php?act=tambahdisp&suid=<?=$suid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Hasil Review Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[levelcv]<2){
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
    
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pengirim</label>
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
		$ef = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]'"));
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>
			<input type=hidden name=jawab value='N'>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenis">Jenis Info Dokumen</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
                <option value="B" selected>Laporan Review Dokumen</option>
            </select>
		</div>
    </div>
    <input type='hidden' name='ddis' value='1'>
    <div class="control-group">
    	<label class="control-label" for="isi">Informasi (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>	
        <div class="controls">
			<textarea name="isi" id="editor">
			<b>Hasil Review Dokumen</b><br>
			Telah direview dokumen pada tanggal : <?=tgl_indo($tgl1);?><br>
			Kode  : <?=$ef[dikodok];?>  Revisi : <?=$ef[direv];?> <br>
			Judul : <?=$ef[dijudok];?>.<br>  
			<!--Hasil Review : ...........<br>-->
			Tindaklanjut Review : ..........<br>
			Bukti review terlampir (jika ada)<br>   
			</textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="Jenis">Hasil Review</label>
        <div class="controls">
        	<select id="perubahan" name="perubahan" class="chzn-select span4">
                <option value="" selected>-- Pilih Hasil Review --</option>
                <option value="perubahan">Terdapat Perubahan</option>
                <option value="penghapusan">Penghapusan</option>
                <option value="tidakberubah">Tidak Terdapat Perubahan</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran (Jika ada)</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 150 MB
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
}elseif($_GET['act']=="editdisp"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisidok WHERE suid='$_GET[id]'"));
$suid = $e['suid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisidok WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("ID-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/dinter/aksi_dinter.php?act=editdisp&suid=<?=$suid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Hasil Review Dokumen</legend>
<?php
	if($_SESSION[levelcv]<2){
	?>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noagenda" value="<?=$e[dNoagenda];?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>

    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pengirim</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM disposisidok a,users b WHERE a.dpendisposisi=b.cId AND a.suid='$_GET[id]'"));
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
		<label class="control-label" for="pendisposisi">Pengirim</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dsin a,users b WHERE a.cId=b.cId AND a.suid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<?php
				$sft = Array("A"=>"Laporan Pemusnahan Dokumen","B"=>"Laporan Review Dokumen","C"=>"Laporan Sosialisasi Dokumen");
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
    	<label class="control-label" for="ddis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="ddis" name="ddis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, bagian, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select><br>*Khusus Untuk Laporan Pemusnahan Dokumen Lama, Upload Lembar Sosialisasi Dokumen & Lembar Review Dokumen ditujukan ke SPD-MR !
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Informasi (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paster)</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
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
<!-- batas dari disposisi.php -->
<?
}elseif($_GET['act']=="dokinterobsolate"){?>

<div>
<div class="span12">
    <button class="btn-info btn-small"  onclick="window.location.href='home.php?pages=dinter&act=lengkap'" target='_blank'>Registrasi Dokumen Terkendali (All)</button>
    <button class="btn-info btn-small"  onclick="window.location.href='home.php?pages=dinter&act=registuser'" target='_blank'>Registrasi Dokumen Terkendali (User)</button>
    <button class="btn-info btn-small"  onclick="window.location.href='?pages=usulandok&act=tambah'" target='_blank'>Usulan Pembuatan Dokumen Baru</button>
    
    <br /><br />

<form method="post" action="?pages=dinterfind" enctype="multipart/form-data" class="form-horizontal">
<b>Cari Kode/Judul Dokumen : </b>
<input class="input-large focused" type="text" name="judul" value="">
<input type=submit value=Cari />
</form>


	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
	    
	    <tr><th width=5%>No</th>
			<th width=10%>Kode</th>
			<th>Judul</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
		
	</thead>
	<tbody>
	<?php
  
		$smasuk = mysql_query("SELECT a.*,b.* FROM dinter a LEFT JOIN disin b ON a.suid=b.suid WHERE b.cId='$_SESSION[cv]' && a.distatus='N' ORDER BY a.dikodok DESC");
    


		$no=1;
		while($s = mysql_fetch_array($smasuk)) {
		    
		echo"   <tr>
		        <td>$no</td>
                <td>$s[dikodok]</td>
				<td>$s[dijudok]</td>";
				echo "<td><center>
				<a href='home.php?pages=usrdin&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-small btn-info'> Detail</a>
				<a href='home.php?pages=usulandokumen&act=perubahan&id=$s[suid]' title='Buat Usulan Perubahan Dokumen' class='btn btn-small btn-info'> UPD</a>
				<a href='home.php?pages=usulandokumen&act=penghapusan&id=$s[suid]' title='Buat Usulan Hapus Dokumen' class='btn btn-small btn-info'> UHD</a>
				<a href='home.php?pages=copy&act=tambah&id=$s[suid]' title='Buat Permohonan Copy Dokumen' class='btn btn-small btn-info'> Copy</a>
				</center>
				</td>
				</tr>";	
		$no++;
		}
	?>
	</tbody>
	</table>
	
	<span class="label label-info">
<strong>Keterangan :</strong><br>	    
<strong>Detail : Detail Informasi Dokumen Lengkap</strong><br>
<strong>UPD : Buat Usulan Perubahan Dokumen</strong><br>
<strong>UHD : Buat Usulan Penghapusan Dokumen</strong><br>
<strong>Copy : Buat Permohonan Copy Dokumen</strong>
</span>
</div>
</div>


<?
}else{
?>
<div>
<div class="span12">
    <button class="btn-info btn-small"  onclick="window.location.href='home.php?pages=dinter&act=lengkap'" target='_blank'>Registrasi Dokumen Terkendali (All)</button>
    <button class="btn-info btn-small"  onclick="window.location.href='home.php?pages=dinter&act=registuser'" target='_blank'>Registrasi Dokumen Terkendali (User)</button>
    <button class="btn-info btn-small"  onclick="window.location.href='?pages=usulandok&act=tambah'" target='_blank'>Usulan Pembuatan Dokumen Baru</button>
    
    <br /><br />

<form method="post" action="?pages=dinterfind" enctype="multipart/form-data" class="form-horizontal">
<b>Cari Kode/Judul Dokumen : </b>
<input class="input-large focused" type="text" name="judul" value="">
<input type=submit value=Cari />
</form>


	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
	    
	    <tr><th width=5%>No</th>
			<th width=10%>Kode</th>
			<th>Judul</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
		
	</thead>
	<tbody>
	<?php
// 		$smasuk = mysql_query("SELECT a.*,b.*,c.* FROM dinter a LEFT JOIN disin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' ORDER BY a.dikodok ASC");
      
		$smasuk = mysql_query("SELECT a.*,b.* FROM dinter a LEFT JOIN disin b ON a.suid=b.suid WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' ORDER BY a.dikodok DESC");
    //   $smasuk = mysql_query("
    //         SELECT a.*, b.*, c.*, d.*
    //         FROM dinter a 
    //         LEFT JOIN dsin b ON a.suid = b.suid 
    //         LEFT JOIN disin d ON a.suid = d.suid 
    //         LEFT JOIN users c ON a.dipengirim = c.cId 
    //         WHERE b.cId = '$_SESSION[cv]' 
    //         AND a.distatus = 'Y' 
    //         GROUP BY a.dikodok
    //         ORDER BY a.dikodok ASC
    //     ");



		$no=1;
		while($s = mysql_fetch_array($smasuk)) {
		    
		echo"   <tr>
		        <td>$no</td>
                <td>$s[dikodok]</td>
				<td>$s[dijudok]</td>";
				echo "<td><center>
				<a href='home.php?pages=usrdin&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-small btn-info'> Detail</a>
				<a href='home.php?pages=usulandokumen&act=perubahan&id=$s[suid]' title='Buat Usulan Perubahan Dokumen' class='btn btn-small btn-info'> UPD</a>
				<a href='home.php?pages=usulandokumen&act=penghapusan&id=$s[suid]' title='Buat Usulan Hapus Dokumen' class='btn btn-small btn-info'> UHD</a>
				<a href='home.php?pages=copy&act=tambah&id=$s[suid]' title='Buat Permohonan Copy Dokumen' class='btn btn-small btn-info'> Copy</a>
				</center>
				</td>
				</tr>";	
		$no++;
		}
	?>
	</tbody>
	</table>
	
	<span class="label label-info">
<strong>Keterangan :</strong><br>	    
<strong>Detail : Detail Informasi Dokumen Lengkap</strong><br>
<strong>UPD : Buat Usulan Perubahan Dokumen</strong><br>
<strong>UHD : Buat Usulan Penghapusan Dokumen</strong><br>
<strong>Copy : Buat Permohonan Copy Dokumen</strong>
</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->