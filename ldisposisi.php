<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Disposisi/Verifikasi Hasil Lembur</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN isurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

if ($e1[iid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN linter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN isurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

}	
			
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$e[pId]"));			
$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
$sifat = "<span class='label label-".$bdg[$e[pSifat]]."'>".$sft[$e[pSifat]]."</span>";
$tglS=$e[ptgls];
if ($e[ptgls]=="0000-00-00"){
	$tglS="-";
}

if ($e[ptgls]=="0000-00-00"){
	$status = "Belum ACC/Diselesaikan";
}else{
	$status = "Telah ACC/Diselesaikan";
}
		
if ($e[psTglbaca]=="0000-00-00"){
	$vion = "-";
}else{
	$vion = date("Y-m-d");
}

if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}

if ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="Y") {
mysql_query("UPDATE ldis SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="N") {
mysql_query("UPDATE ldis SET psTglbaca='$tglhrini', psTglselesai='$tglhrini', psACC='Y' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
?>
<strong>
<legend>Detail Disposisi/ Verifikasi Hasil Lembur</legend></strong>
<? echo"<a href='home1.php?pages=ldis&act=detail2&id=$e[siid]&pdid=$e[pdid]' class='btn btn-info pull-right'><i class='icon-print' target=_blank></i> Cetak</a>";?>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Agenda Disposisi</td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat Disposisi</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
    <tr>
		<td>Pendisposisi</td>
		<td>: <?=$user[cNama];?> - <?=$user[cIdjab];?>
		</td>
	</tr>
	
<?
if ($e1[iid]==0) {
	$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[cId]"));
	$memo = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$e[siid]'"));
	
    echo"
	<tr><td>Lihat SPK Lembur</td><td>: <strong>
    <a href='home.php?pages=linter&act=detail&id=$e[siid]'>Klik disini lihat detail SPK Lembur</a> <br>: Perihal = $memo[siperihal]
	</strong></td></tr>

</table>
<b>Isi Hasil Lembur</b><br>
$e[pInstruksi]
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ldis WHERE siid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));
	echo"<form method='post' action='?pages=ldis&act=accm&pdid=$e[pdid]&siid=$e[siid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : (Wajib dijawab)</b></label>
        <div class='controls'>
		<input type=hidden name='siid' value='$e[siid]'>
		<input type=hidden name='pid' value='$e[pId]'>
		<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>

	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Kirim</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN linter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM lisposisi WHERE dPendisposisi='$e[pId]' AND siid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM lisposisi a WHERE a.siid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>History Verifikasi Hasil Lembur</legend>
<table class="table table-bordered" border=1 width="100%">
<thead>
    <td width=10%><b>Kepada</b></td>
	<td><b>Isi Hasil Lembur</td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ldis a WHERE a.siid='$_GET[id]' ORDER BY a.pdid DESC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN ldis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				
				<td>$t[kepada] ($t[kepadajab])<br><b>Tgl Disp :</b> $tglDis <br>  <b>Tgl Baca :</b> $tglBaca</td>
				<td>$t[pInstruksi]</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
            	<td>$t[kepada] ($t[kepadajab])<br><b>Tgl Disp :</b> $tglDis <br>  <b>Tgl Baca :</b> $tglBaca</td>
				<td>$t[pInstruksi]</td>
			 </tr>";
	}
}
?>
</table>

<!-- /isi disposisi-->


<?
}

}

else {
/*$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[ipengirim]"));
  echo"<tr><td>Surat Masuk Dari</td><td>: <strong>$nama[cNama]</strong></td></tr>
  */
	$srt = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$e[iid]'"));

	echo"
	<tr><td>Lihat Agenda Surat Masuk Eksternal</td><td><strong>: Perihal = $srt[iperihal]<br>: 
    <a href='home.php?pages=suin&act=detail&id=$e[iid]' target=_blank>Klik disini Lihat Agenda Surat Masuk Eksternal</a><br>: 
    <a href='smasuk/$srt[ifile]' target=_blank>Klik disini Lihat File Surat Masuk Eksternal atau Scan QR Code!</a>
	</strong>
	<br><img src='https://ekfpb.com/bnj/include/srtqrcode.php?id=$srt[ifile]'>
	</td></tr>
   		<tr><td>Isi Hasil Lembur :</td><td>$e[pInstruksi]</td></tr>

    
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ldis WHERE iid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=ldis&act=acc&pdid=$e[pdid]&iid=$e[iid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : (Wajib dijawab) </b></label>
        <div class='controls'>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>
	<div class="control-group">
    	
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>Kirim</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN suin d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM lisposisi WHERE dPendisposisi='$e[pId]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM lisposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>History Disposisi :</legend>
<table class="table table-bordered">
<thead>
	<td width=12%><b>Tgl Disposisi</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Informasi </b></td>
	<td><b>Jawaban/Informasi</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>

<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ldis a WHERE a.iid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN ldis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				<td>$t[kepadajab] (<font size=2>$t[kepada]</font>)</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepadajab] (<font size=2>$t[kepada]</font>)</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>

</table>
<!-- /isi disposisi-->
<?
}

}





} elseif($_GET[act]=="detail2"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN isurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

if ($e1[iid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN linter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN isurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

}	
			
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$e[pId]"));			
$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
$sifat = "<span class='label label-".$bdg[$e[pSifat]]."'>".$sft[$e[pSifat]]."</span>";
$tglS=$e[ptgls];
if ($e[ptgls]=="0000-00-00"){
	$tglS="-";
}

if ($e[ptgls]=="0000-00-00"){
	$status = "Belum ACC/Diselesaikan";
}else{
	$status = "Telah ACC/Diselesaikan";
}
		
if ($e[psTglbaca]=="0000-00-00"){
	$vion = "-";
}else{
	$vion = date("Y-m-d");
}

if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}

if ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="Y") {
mysql_query("UPDATE ldis SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="N") {
mysql_query("UPDATE ldis SET psTglbaca='$tglhrini', psTglselesai='$tglhrini', psACC='Y' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
?>
<strong>
<legend>Detail Disposisi/ Verifikasi Hasil Lembur</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Agenda Disposisi</td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat Disposisi</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
    <tr>
		<td>Pendisposisi</td>
		<td>: <?=$user[cNama];?> - <?=$user[cIdjab];?>
		</td>
	</tr>
	
<?
if ($e1[iid]==0) {
	$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[cId]"));
	$memo = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$e[siid]'"));
	
    echo"
	<tr><td>Perihal</td><td>: <strong>
    : $memo[siperihal]
	</strong></td></tr>

</table>
<b>Isi Hasil Lembur</b><br>
$e[pInstruksi]
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ldis WHERE siid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));
	echo"<form method='post' action='?pages=ldis&act=accm&pdid=$e[pdid]&siid=$e[siid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : (Wajib dijawab)</b></label>
        <div class='controls'>
		<input type=hidden name='siid' value='$e[siid]'>
		<input type=hidden name='pid' value='$e[pId]'>
		<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>

	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Kirim</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN linter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM lisposisi WHERE dPendisposisi='$e[pId]' AND siid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM lisposisi a WHERE a.siid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>



<?
}

}

else {
/*$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[ipengirim]"));
  echo"<tr><td>Surat Masuk Dari</td><td>: <strong>$nama[cNama]</strong></td></tr>
  */
	$srt = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$e[iid]'"));

	echo"
	<tr><td>Lihat Agenda Surat Masuk Eksternal</td><td><strong>: Perihal = $srt[iperihal]<br>: 
    <a href='home.php?pages=suin&act=detail&id=$e[iid]' target=_blank>Klik disini Lihat Agenda Surat Masuk Eksternal</a><br>: 
    <a href='smasuk/$srt[ifile]' target=_blank>Klik disini Lihat File Surat Masuk Eksternal atau Scan QR Code!</a>
	</strong>
	<br><img src='https://ekfpb.com/bnj/include/srtqrcode.php?id=$srt[ifile]'>
	</td></tr>
   		<tr><td>Isi Hasil Lembur :</td><td>$e[pInstruksi]</td></tr>

    
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ldis WHERE iid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=ldis&act=acc&pdid=$e[pdid]&iid=$e[iid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : (Wajib dijawab) </b></label>
        <div class='controls'>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>
	<div class="control-group">
    	
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>Kirim</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN suin d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM lisposisi WHERE dPendisposisi='$e[pId]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM lisposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>History Disposisi :</legend>
<table class="table table-bordered">
<thead>
	<td width=12%><b>Tgl Disposisi</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Informasi </b></td>
	<td><b>Jawaban/Informasi</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>

<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ldis a WHERE a.iid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN ldis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				<td>$t[kepadajab] (<font size=2>$t[kepada]</font>)</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepadajab] (<font size=2>$t[kepada]</font>)</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>

</table>
<!-- /isi disposisi-->
<?
}

}



} elseif($_GET[act]=="acc"){
function UploadJwb($fupload_name){
  //direktori file
  $vdir_upload = "jwb_disp/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwb($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
	$tglhrini = date("Y-m-d");
	mysql_query("UPDATE ldis SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE isurat SET istatus='N' WHERE iid='$_POST[iid]'");

	echo "<script>window.location=('home.php?pages=ldis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";

}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
	
}elseif($_GET[act]=="accm"){
	
function UploadJwb($fupload_name){
  //direktori file
  $vdir_upload = "jwb_disp/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}
  
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file;   
  
 UploadJwb($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
	
	$tglhrini = date("Y-m-d");
	mysql_query("UPDATE ldis SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE psin SET sistatus='N' WHERE siid='$_POST[siid]' AND cId='$_POST[pid]'");
	
	mysql_query("UPDATE tsin SET sistatus='N' WHERE siid='$_POST[siid]' AND cId='$_POST[pid]'");

	echo "<script>window.location=('home.php?pages=ldis&act=detail&pdid=$_GET[pdid]&id=$_GET[siid]');</script>";
 }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
	}
elseif($_GET[act]=="fwd"){
	$ptgl = date("Y-m-d");
	if ($_POST[pdid]==""){
		mysql_query("INSERT INTO ldis (ptgl,pId,cId,psACC,iid) 
					VALUES ('$ptgl','$_SESSION[cv]','$_POST[kepada]','N','$_POST[iid]')");
	}else{
		mysql_query("UPDATE ldis SET ptgl='$ptgl',
									 pId='$_SESSION[cv]',
									 cId='$_POST[kepada]',
									 psACC='N',
									 psTglbaca='0000-00-00',
									 iid='$_POST[iid]'
								 WHERE pdid='$_POST[pdid]'");
	}
	echo "<script>window.location=('home.php?pages=ldis');</script>";
}else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr><th width=1%></th>
			<th width=5%>Tanggal</th>
			<th width=10%>Pendisposisi</th>
			<th>Perihal Lembur</th>
			<th width=15%>Tgl Baca</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM ldis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {
			$p = mysql_fetch_array (mysql_query("SELECT * FROM linter WHERE siid='$s[siid]'"));
			$p1 = mysql_fetch_array (mysql_query("SELECT * FROM isurat WHERE iid='$s[iid]'"));
			$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]=="0000-00-00"){
				$tglS="-";
			}
			
			if ($s[psTglbaca]=="0000-00-00"){
				$st = "<strong>Belum Baca</strong>";
			}else{
				$st = tgl_indo($s[psTglbaca]);
			}
		
			if ($s[psTglselesai]=="0000-00-00"){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptgl]);echo"</td>
					<td>$s[cJabatan]</td>
					<td>$p[siperihal]$p1[iperihal]</td>
					<td>$st</td>";
					
		if ($s[siid]!=0) {
					
		if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=ldis&act=detail&id=$s[siid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
				
					</td>
			  </tr>";	
		}
			  else {
				  echo"<td><a href='?pages=ldis&act=detail&id=$s[siid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
					
				  </td>
			  </tr>";
				  
			  }
		}
		else {
				
			  if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=ldis&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
				
					</td>
			  </tr>";	}
			  else {
				  echo"<td><a href='?pages=ldis&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
				</td>
			  </tr>";
				  
			  }
		
		}	
		}
	?>
	</tbody>
	</table>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA/ JAWAB</strong><br>
	Klik Baca/Detail untuk melihat Detail dan Konfirmasi Telah Dibaca serta menjawab penyelesaian Disposisi Hasil Lembur</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->