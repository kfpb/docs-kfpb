<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Rencana Tindaklanjut Change Control</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtcc a 
									LEFT JOIN cdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN isurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

if ($e1[iid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtcc a 
									LEFT JOIN cdis b ON a.ccid=b.ccid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ccinter d ON a.ccid=d.ccid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.ccid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtcc a 
									LEFT JOIN cdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN isurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

}	
			
$user = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[pId]"));			
$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Super Cito");
$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
$sifat = "<span class='label label-".$bdg[$e[pSifat]]."'>".$sft[$e[pSifat]]."</span>";
$tglS=$e[ptgls];
$tglS2=$e[ptgls2];
$tglS3=$e[ptgls3];
if ($e[ptgls]=="0000-00-00"){
	$tglS="-";
}

if ($e[psACC]=='N'){
	$status = "Belum Diselesaikan";
}else{
	$status = "Telah Diselesaikan";
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
/*
if ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="Y") {
mysql_query("UPDATE cdis SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="N") {
mysql_query("UPDATE cdis SET psTglbaca='$tglhrini', psTglselesai='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
*/
?>
<strong>
<legend>Detail Rencana Tindaklanjut CC</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Agenda RTCC</td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat RTCC</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
	<tr><td>Batas Waktu Selesai 1</td><td>: <?=tgl_indo($tglS);?></td></tr>
	<tr><td>Batas Waktu Selesai 2</td><td>: <?=tgl_indo($tglS2);?> (jika diperpanjang)</td></tr>
	<tr><td>Batas Waktu Selesai 3</td><td>: <?=tgl_indo($tglS3);?> (jika diperpanjang)</td></tr>
	<tr><td>Status</td><td>: <span class='label label-warning'><?=$status;?></span></td></tr>
	
<?
if ($e1[iid]==0) {
	$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[cId]"));
    echo"
	<tr><td>Lihat Usulan CC</td><td>: <strong>
    <a href='home.php?pages=ccinter&act=detail&id=$e[ccid]'>Klik disini lihat detail usulan CC</a>
	</strong></td></tr>
	<tr><td>Rencana Tindaklanjut :</td><td>$e[pInstruksi]</td></tr>
	<tr><td>Usulan Kode Dokumen :</td><td>$e[kode_dok]/$e[revisi] (Jika ada)";
	
		if ($e[kode]=="Y"){
            if ($e[kode3]=="N"){
			 // hide tombol pengusulan dokumen dari cc
			 //   $data=mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$e[ccid]'"));
					    
				// echo"<br>
				// <b><font color=red>Teruskan/kirim usulan dokumen ke Spv. Dokumentasi-MR, Klik dibawah :</font><br>
				// <a target=_blank href='home.php?pages=usulandok&act=tambah&id=$e[kode_dok]&id2=$data[ccnmr1]&id3=$e[revisi]&pdid=$_GET[pdid]' class='btn btn-info'>Buat Usulan Dokumen!</a>";
				// 	}
				// else {
				//     echo"<br><font color=red><b>Usulan Dokumen Sudah terkirim ke SPD-MR</b></font>";
				// }
		}
		else {
			echo"";    
			}
		
	
	echo"</td></tr>
	<tr><td>Lampiran RTCC :</td><td><a href='rtcc/$e[disfile]'>Klik disini (jika ada)</a></td></tr>
	<tr><td>Info Pelaksanaan RTCC :</td><td>$e[info]</td></tr>
</table>
</strong>
<br>";

if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM cdis WHERE ccid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));
	echo"<form method='post' action='?pages=rtcc&act=accm&pdid=$e[pdid]&ccid=$e[ccid]' enctype='multipart/form-data'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Kirim Informasi Hasil Rencana Tindakan : </b></label>
        <div class='controls'>
		<input type=hidden name='ccid' value='$e[ccid]'>
		<input type=hidden name='pid' value='$e[pId]'>
		<textarea name='info' id='editor'>$e[info]</textarea>
    </div>";
	?>
	<?
		echo"
	    <div class='controls'>Lampirkan file/bukti :
        	<input class='input-file uniform_on' id='fileInput' type='file' name='fupload'> Max. 15 MB
        </div>
		
		<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Kirim</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtcc a 
									LEFT JOIN cdis b ON a.ccid=b.ccid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ccinter d ON a.ccid=d.ccid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.ccid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM rtcc WHERE dPendisposisi='$e[pId]' AND ccid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM rtcc a WHERE a.ccid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>Daftar Rencana Tindaklanjut CC :</legend>
<table class="table table-bordered" width="100%">
<thead>
	<td width=12%><b>Tanggal </b></td>
    <td width=10%><b>PenanggungJawab</b></td>
	<td width=30%><b>Rencana Tindakan/Dokumen</b></td>
	<td width=30%><b>Info Pelaksanaan RTCC</b></td>
	<td width=12%>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cjabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

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
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br><b>Bts Waktu 1 :</b><br> $tgltarget
								<br>
				<b>Bts Waktu 2 :</b> $tgltarget2<br>
				<b>Bts Waktu 3 :</b> $tgltarget3
				
				</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]";
					if ($t[kode]=="Y"){
			    
			    $data=mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$t[ccid]'"));
					    
				echo"<br>
				Mengusulkan dokumen = $t[kode_dok]/$t[revisi] (Jika ada)";
					}
				else {
				    echo"";
				}
				echo"</td>
				<td>$t[info]</td>
				<td><b>Tgl Info:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Bts Waktu 1:</b><br> $tgltarget<br>
				<b>Bts Waktu 2 :</b> $tgltarget2<br>
				<b>Bts Waktu 3 :</b> $tgltarget3</td>
				
				
				
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				<br>Lampiran : <a href='jwb_rtcc/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Info:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
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

}


} elseif($_GET[act]=="acc"){
if ($_POST[info]=="")
	{  echo "<script>window.alert('Jawaban tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
function UploadJwbrtcc($fupload_name){
  //direktori file
  $vdir_upload = "jwb_rtcc/";
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
	mysql_query("UPDATE cdis SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE isurat SET istatus='N' WHERE iid='$_POST[iid]' AND ikepada='$_POST[cid]'");

	echo "<script>window.location=('home.php?pages=rtcc&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";

}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
}	
}
elseif($_GET[act]=="accm"){
if ($_POST[info]=="")
	{  echo "<script>window.alert('Hasil rencana tindakan tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 	
function UploadJwbrtcc($fupload_name){
  //direktori file
  $vdir_upload = "jwb_rtcc/";
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
  
 UploadJwbrtcc($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
	
	$tglhrini = date("Y-m-d");
	mysql_query("UPDATE cdis SET info='$_POST[info]', psTglbaca='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE csin SET sistatus='N' WHERE ccid='$_POST[ccid]' AND cId='$_POST[pid]'");

	echo "<script>window.location=('home.php?pages=rtcc&act=detail&pdid=$_GET[pdid]&id=$_GET[ccid]');</script>";
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
			<th>Tanggal</th>
			<th>Usulan CC</th>
			<th>Rencana Tindaklanjut</th>
			<th>Batas Waktu</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM cdis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' ORDER BY a.pstglselesai ASC");
		while($s = mysql_fetch_array($dsp)) {
			$p = mysql_fetch_array (mysql_query("SELECT * FROM ccinter WHERE ccid='$s[ccid]'"));
			$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Super Cito");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]=="0000-00-00" OR $s[psTgls]==NULL){
				$tglS="-";
			}
			
		
			if ($s[psTglselesai]=="0000-00-00" OR $s[psTglselesai]==NULL){
			    
			    if ($s[psACC]=='N'){
				$st = "<strong>Belum Selesai</strong>";
			}else{
				$st = "Selesai-Belum Verifikasi";
			}
			
				echo "<tr class=success>";
			}else{
			    if ($s[psACC]=='N'){
				$st = "<strong>Belum Selesai</strong>";
			}else{
				$st = "Selesai";
				
			}
				echo "<tr>";
			}
			
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo1($s[ptgl]);echo"</td>
					<td>$p[ccperihal1]</td>
					<td>$s[pInstruksi]</td>
					<td>";echo tgl_indo1($s[ptgls]);echo"</td>
					<td>$st</td>";
					
					
		if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=rtcc&act=detail&id=$s[ccid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
				
					</td>
			  </tr>";	
		}
			  else {
				  echo"<td><a href='?pages=rtcc&act=detail&id=$s[ccid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
			
				  </td>
			  </tr>";
				  
			  }
	
		}
	?>
	</tbody>
	</table>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM SELESAI DIVERIFIKASI</strong><br>
	Klik Baca/Detail untuk melihat Detail dan Konfirmasi Telah Dibaca serta menindaklanjuti Rencana Tindaklanjut CC</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->