<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Informasi Hasil Review Dokumen (MR)</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN udokumen d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.uid=$_GET[id]"));

if ($e1[uid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN dinter d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.suid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN udokumen d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.uid=$_GET[id]"));

}	
			
$user = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[pId]"));			
$sft = Array("A"=>"Pemusnahan Dokumen","B"=>"Review Dokumen","C"=>"Sosialisasi Dokumen");
$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
$sifat = "<span class='label label-".$bdg[$e[pSifat]]."'>".$sft[$e[pSifat]]."</span>";
$tglS=$e[ptgls];
if ($e[ptgls]==''){
	$tglS="-";
}

if ($e[psACC]=='N'){
	$status = "Belum ditindaklanjuti MR";
}else{
	$status = "Telah ditindaklanjuti MR";
}
		
if ($e[psTglbaca]==''){
	$vion = "-";
}else{
	$vion = date("Y-m-d");
}

if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}

if ($e[psTglbaca]=='' AND $e[jawab]=="Y") {
mysql_query("UPDATE ddis SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=='' AND $e[jawab]=="N") {
mysql_query("UPDATE ddis SET psTglbaca='$tglhrini', psTglselesai='$tglhrini', psACC='Y' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
?>
<strong>
<legend>Detail Hasil Review Dokumen</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Agenda</td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat </td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
    <tr>
		<td>Pengirim</td>
		<td>: <?=$user[cNama];?>
		</td>
	</tr>
	
	<tr><td>Jenis</td><td>: <?=$sifat;?></td></tr>
	<tr><td>Status</td><td>: <span class='label label-warning'><?=$status;?></span></td></tr>
	
<?
if ($e1[uid]==0) {
	$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[cId]"));
    echo"
	<tr><td>Isi Informasi :</td><td>$e[pInstruksi]</td></tr>

</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ddis WHERE suid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));
	echo"<form method='post' action='?pages=ddis&act=accm&pdid=$e[pdid]&suid=$e[suid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : (Wajib dijawab)</b></label>
        <div class='controls'>
		<input type=hidden name='suid' value='$e[suid]'>
		<input type=hidden name='pid' value='$e[pId]'>
		<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>
	<div class="control-group">
    	<label class="control-label" for="fileInput"><b>Lampiran Jawaban (Jika ada)</b></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>ACC/Selesai</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN dinter d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.suid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE dPendisposisi='$e[pId]' AND suid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPendisposisi FROM disposisidok a WHERE a.suid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>Hasil Review Dokumen :</legend>
<table class="table table-bordered" width="100%">
<thead>
	<td width=12%><b>Tanggal</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Informasi</b></td>
	<td width=12%>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddis a WHERE a.suid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN ddis b ON b.cId=a.cId WHERE b.suid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t['psTglbaca']==''){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t['psTglselesai']==''){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t['psACC']=="N"){
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
				<td><b>Tgl Baca:</b><br> $tglBaca</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>$t[kepada] </td>
				<td>";
				if ($t[pSifat]==A) { echo"<b><u>Pemusnahan Dokumen</u></b>";}
				elseif ($t[pSifat]==B) { echo"<b><u>Review Dokumen</u></b>";}
				else { echo"<b><u>Sosialisasi Dokumen</u></b>";}
				echo"<br>$t[pInstruksi]
				<br>Hasil Review : $t[perubahan]
				<br>Lampiran : <a href='disposisidok/$t[disfiles]'>klik disini (jika ada)</a>
				</td>
				<td><b>Tgl Baca:</b><br> $tglBaca</td>
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
	
	echo"<tr><td>Lihat Agenda Surat</td><td>: <strong>
    <a href='home.php?pages=suin&act=detail&id=$e[uid]'>Klik disini Agenda Surat</a>
	</strong></td></tr>
	<tr><td>Lampiran Disposisi :</td><td><a href='disposisi/$e[disfile]'>Klik disini (jika ada)</a></td></tr>
    <tr><td></td><td colspan='2'></td></tr>
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ddis WHERE uid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=ddis&act=acc&pdid=$e[pdid]&uid=$e[uid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : (Wajib dijawab) </b></label>
        <div class='controls'>
		<input type=hidden name=uid value=$e[uid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>
	<div class="control-group">
    	<label class="control-label" for="fileInput"><b>Lampiran Jawaban Disposisi (Jika ada)</b></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>ACC/Selesai</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN suin d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.uid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE dPendisposisi='$e[pId]' AND uid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dddisposisi FROM disposisidok a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>Sejarah Informasi Dokumen :</legend>
<table class="table table-bordered" width="100%">
<thead>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Informasi </b></td>
	<td><b>Jawaban/Informasi</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddis a WHERE a.uid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN ddis b ON b.cId=a.cId WHERE b.suid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t['psTglbaca']==''){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t['psTglselesai']==''){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t['psACC']=="N"){
		echo "<tr>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>";
				if ($t[pSifat]==A) { echo"<b>Pemusnahan Dokumen</b>";}
				elseif ($t[pSifat]==B) { echo"<b>Review Dokumen</b>";}
				else { echo"<b>Sosialisasi Dokumen</b>";}
				echo"<br>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>";
				if ($t[pSifat]==A) { echo"<b>Pemusnahan Dokumen</b>";}
				elseif ($t[pSifat]==B) { echo"<b>Review Dokumen</b>";}
				else { echo"<b>Sosialisasi Dokumen</b>";}
				echo"<br>
				$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_infodok/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi disposisi-->
<?
}

}


} elseif($_GET['act']=="acc"){
if ($_POST[info]=="")
	{  echo "<script>window.alert('Jawaban tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
function UploadJwbid($fupload_name){
  //direktori file
  $vdir_upload = "jwb_infodok/";
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
  
 UploadJwbid($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
	$tglhrini = date("Y-m-d");
	mysql_query("UPDATE ddis SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE udokumen SET istatus='N' WHERE uid='$_POST[uid]' AND ikepada='$_POST[cId]'");

	echo "<script>window.location=('home.php?pages=ddis&act=detail&pdid=$_GET[pdid]&id=$_GET[uid]');</script>";

}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
}	
}
elseif($_GET['act']=="accm"){
if ($_POST[info]=="")
	{  echo "<script>window.alert('Jawaban tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 	
function UploadJwbid($fupload_name){
  //direktori file
  $vdir_upload = "jwb_infodok/";
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
  
 UploadJwbid($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
	
	$tglhrini = date("Y-m-d");
	mysql_query("UPDATE ddis SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE dsin SET distatus='N' WHERE suid='$_POST[suid]' AND cId='$_POST[pid]'");


	echo "<script>window.location=('home.php?pages=ddis&act=detail&pdid=$_GET[pdid]&id=$_GET[suid]');</script>";
 }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}
else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th width=1%></th>
			<th width=5%>Tanggal</th>
			<th width=10%>Pengirim</th>
			<th width=10%>Kode Dokumen/Rev</th>
			<th width=25%>Judul Dokumen</th>
			<th width=5%>Status</th>
			<th width=17%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab FROM ddis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {
			$p = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$s[suid]'"));
			$sft = Array("A"=>"Pemusnahan Dokumen","B"=>"Review Dokumen","C"=>"Sosialisasi Dokumen");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s['ptgls'];
			if ($s['ptgls']==''){
				$tglS="-";
			}
			
			if ($s['psACC']=='N'){
				$st = "<strong>Belum Selesai</strong>";
			}else{
				$st = "Selesai";
			}
		
			if ($s[psTglselesai]==''){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptgl]);echo"</td>
					<td>$s[cNama]</td>
					<td>$p[dikodok]/$p[direv]</td>
					<td>$p[dijudok]</td>
					<td>$st</td>";
					
					
		if ($s[psTglbaca]==''){
					echo"<td><a href='?pages=ddis&act=detail&id=$s[suid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
					</td>
			  </tr>";	
		}
			  else {
				  echo"<td><a href='?pages=ddis&act=detail&id=$s[suid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
				  </td>
			  </tr>";
				  
			  }
	
		}
	?>
	</tbody>
	</table>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Klik Baca/Detail untuk melihat Detail dan Konfirmasi Telah Diinput hasil review dokumen</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->