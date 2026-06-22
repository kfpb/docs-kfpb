<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Alur Usulan Dokumen Kirim-Kembali (Untuk Koreksi/ ACC - NET)</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN udokumen d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND b.pudid=$_GET[pudid] AND a.uid=$_GET[id]"));

if ($e1[uid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND b.pudid=$_GET[pudid] AND a.suid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN udokumen d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND b.pudid=$_GET[pudid] AND a.uid=$_GET[id]"));

}	
			
$user = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[pId]"));			
$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Super Cito");
$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
$sifat = "<span class='label label-".$bdg[$e[pSifat]]."'>".$sft[$e[pSifat]]."</span>";
$tglS=$e[ptgls];
if ($e[ptgls]==''){
	$tglS="-";
}

if ($e[psACC]=='N'){
	$status = "Belum Diselesaikan";
}else{
	$status = "Telah Diselesaikan";
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
mysql_query("UPDATE uddis SET psTglbaca='$tglhrini' WHERE pudid='$e[pudid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=='' AND $e[jawab]=="N") {
mysql_query("UPDATE uddis SET psTglbaca='$tglhrini', psTglselesai='$tglhrini' WHERE pudid='$e[pudid]' AND cId='$_SESSION[cv]'");
}
?>
<strong>
<legend>Detail ALUR Usulan Dokumen (Kirim-Kembali)</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Alur Usulan</td><td>: <?=$e[pNoalur];?></td>
	</tr>
    <tr><td>Tanggal</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
	<tr><td>Target Selesai</td><td>: <?=tgl_indo($tglS);?></td></tr>
    <tr>
		<td>Pengirim</td>
		<td>: <?=$user[cNama];?>
		</td>
	</tr>
	<tr><td>Sifat</td><td>: <?=$sifat;?></td></tr>
	<tr><td>Status</td><td>: <span class='label label-warning'><?=$status;?></span></td></tr>
	
<?
if ($e1[uid]==0) {
}

else {
    $edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dNoalur='$e[pNoalur]'"));	
	echo"
	<tr><td>Detail Usulan Dokumen </td><td>: <strong><a href='home.php?pages=usulandok&act=detail&id=$e[uid]' target=_blank>Klik disini</a></td></tr>
	<tr><td>Info Kirim Usulan :</td><td>
	<b>File Konsep (dari SDDR) : <a href='https://docs.kfpb.kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></b><br>
	<b>$e[pInstruksi]</b></td></tr>
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM uddis WHERE uid=$_GET[id] AND pudid=$_GET[pudid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=udok&act=acc&pudid=$e[pudid]&uid=$e[uid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban Koreksi/ACC Net Usulan Dokumen kembali ke SDDR : </b></label>
        <div class='controls'>
		<input type=hidden name=uid value=$e[uid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'></textarea>
    </div>";
	?>
	<p>
	<div class="control-group">
    	<label class="control-label" for="fileInput"><b>Lampirkan file usulan hasil koreksi (Jika ada)</b></label>
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
if ($e1[uid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND b.pudid=$_GET[pudid] AND a.suid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN udokumen d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND b.pudid=$_GET[pudid] AND a.uid=$_GET[id]"));

}	

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN udokumen d ON a.uid=d.uid
									WHERE b.cId='$_SESSION[cv]' AND pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dPengirim='$e[pId]' AND uid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi alurusulan-->
<legend>Alur Usulan Dokumen Kirim Kembali :</legend>
<table class="table table-bordered" width="100%">
<thead>
	<td width=12%><b>Tgl Kirim</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Informasi </b></td>
	<td><b>Jawaban Koreksi/ACC</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM uddis a WHERE a.uid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pudid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN uddis b ON b.cId=a.cId WHERE b.suid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t[psTglbaca]==''){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]==''){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}

	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br><b>Target-Slesai:</b><br> $tgltarget</td>
				<td>$t[kepada]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Selesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target-Slesai:</b><br> $tgltarget</td>
				<td>$t[kepada]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info] <b><u>File Koreksi : <a href='https://docs.kfpb.kimiafarma.co.id/jwb_usulandok/$t[filedis]' target=_blank>Download</a></u></td>
				<td><b>Tgl Selesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi alurusulan-->
<?
}

}


} elseif($_GET['act']=="acc"){
if ($_POST[info]=="")
	{  echo "<script>window.alert('Jawaban tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
function UploadJwbud($fupload_name){
  //direktori file
  $vdir_upload = "jwb_usulandok/";
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
  
 UploadJwbud($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
	$tglhrini = date("Y-m-d");
	mysql_query("UPDATE uddis SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pudid='$_GET[pudid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE udokumen SET udstatus1='N', udtgl_kembali='$tglhrini' WHERE uid='$_POST[uid]'");

	echo "<script>window.alert('Terkirim');window.location=('https://docs.kfpb.kimiafarma.co.id/home.php?pages=udok')</script>";
	

}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
}	
}
else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th width=1%></th>
			<th width=5%>Tanggal</th>
			<th width=10%>Pengirim</th>
			<th>Usulan Dokumen</th>
			<th width=5%>Sifat</th>
			<th width=5%>Status</th>
			<th width=5%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab FROM uddis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {

			$p1 = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$s[uid]'"));
			$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Super Cito");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]==''){
				$tglS="-";
			}
			
			if ($s[psACC]=='N'){
				$st = "<strong>Belum Selesai</strong>";
			}else{
				$st = "Selesai";
			}
		
			if ($s[psTglselesai]=='0000-00-00'){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptgl]);echo"</td>
					<td>SDDR</td>
					<td>$p1[ukodok]/$p1[udrev] ($p1[ujudok])</td>
					<td>$sifat</td>
					<td>$st</td>";
					
		
				
			  if ($s[psTglbaca] ==''){
					echo"<td><a href='?pages=udok&act=detail&id=$s[uid]&pudid=$s[pudid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
				
					</td>
			  </tr>";	}
			  else {
				  echo"<td><a href='?pages=udok&act=detail&id=$s[uid]&pudid=$s[pudid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
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
	Klik Baca/Detail untuk melihat Detail dan Konfirmasi Telah Dibaca serta Jawab untuk hasil Koreksi/Net Usulan<br>
	Jika belum dijawab, maka notifikasi di menu kiri dan kolom warna hijau tetap ada</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->