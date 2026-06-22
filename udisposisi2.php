<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Rencana Tindak Lanjut (RTL) - Tugas/CAPA Untuk ditindaklanjuti </div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi2 a 
									LEFT JOIN pdiss b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ssurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

if ($e1[iid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi2 a 
									LEFT JOIN pdiss b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi2 a 
									LEFT JOIN pdiss b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ssurat d ON a.iid=d.iid
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

if ($e[pTgls]=="0000-00-00"){
	$status = "Belum Selesai";
}else{
	$status = "Telah Selesai";
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
mysql_query("UPDATE pdiss SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="N") {
mysql_query("UPDATE pdiss SET psTglbaca='$tglhrini', psTglselesai='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
?>
<strong>
<legend>Detail Pengingat Tugas/CAPA Untuk ditindaklanjuti</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor </td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
	<tr><td>Target Tanggal Selesai</td><td>: <?=tgl_indo($tglS);?></td></tr>
    <tr>
		<td>Pembuat</td>
		<td>: <?=$user[cJabatan];?> (<?=$user[cNama];?>)
		</td>
	</tr>
	
	<tr><td>Status</td><td>: <span class='label label-warning'><?=$status;?></span></td></tr>
	
<?
if ($e1[iid]==0) {}

else {
/*$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[ipengirim]"));
  echo"<tr><td>Surat Masuk Dari</td><td>: <strong>$nama[cNama]</strong></td></tr>
  */
		$srt = mysql_fetch_array(mysql_query("SELECT * FROM ssurat WHERE iid='$e[iid]'"));
	echo"
	<tr><td>RTL/CAPA :</td><td>$e[pInstruksi]</td></tr>
	<tr><td>Lihat eCAPA</td><td>: <strong>
    <a href='home.php?pages=suin2&act=detail&id=$e[iid]'>Klik disini Lihat eCAPA</a><br>
    : Perihal = $srt[iperihal]
	</strong></td></tr>
	<tr><td>Lampiran (jika ada) </td><td>: <a href='disposisi/$e[disfile]'>Klik disini (jika ada)</a></td></tr>
    <tr><td></td><td colspan='2'></td></tr>
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM pdiss WHERE iid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=udis2&act=acc&pdid=$e[pdid]&iid=$e[iid]' enctype='multipart/form-data'>";
	if ($e[ptgls]=='0000-00-00' OR $e[ptgls]==''){
	echo"<div class='control-group'>
		<label class='control-label' for='tgl'><b>Tanggal Batas Waktu :</b></label>
        <div class='controls'><input class='input-small datepicker' id='tgl' type='text' name='tgls' value='' required='required'></div>
    </div>";
	}
	else
	{
	   echo"<input type=hidden name=tgls value=$e[ptgls]";
	}
	echo"<div class='control-group'>
		<label class='control-label' for='info'><b>Temuan : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='temuan' class='input-large textarea' style='width: 610px; height: 100px'>$e[temuan]</textarea>
    </div>	
	<div class='control-group'>
		<label class='control-label' for='info'><b>Persyaratan : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='syarat' class='input-large textarea' style='width: 610px; height: 100px'>$e[syarat]</textarea>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Kondisi Saat Ini : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='kondisi'' class='input-large textarea' style='width: 610px; height: 100px'>$e[kondisi]</textarea>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'><b>GAP Analisis : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='gap' class='input-large textarea' style='width: 610px; height: 100px'>$e[gap]</textarea>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Root Cause : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='rootcause' class='input-large textarea' style='width: 610px; height: 100px'>$e[rootcause]</textarea>
    </div>
    
	<div class='control-group'>
		<label class='control-label' for='info'><b>Jawaban/ Informasi Penyelesaian : </b></label>
        <div class='controls'>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'>$e[info]</textarea>
    </div>
    <br>
    <div class='control-group'>
		<label class='control-label' for='tgl'><b>Tanggal Batas Waktu 2 :</b></label>
        <div class='controls'><input class='input-small datepicker' id='tgl' type='text' name='tgls2' value=''>*Jika diperpanjang</div>
    </div>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Verifikasi ke-1 : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='verif' class='input-large textarea' style='width: 610px; height: 100px'>$e[verif]</textarea>
    </div>
    	<div class='control-group'>
		<label class='control-label' for='info'><b>Verifikasi ke-2 : (Khusus CAPA)</b></label>
        <div class='controls'>
		<textarea name='verif2' class='input-large textarea' style='width: 610px; height: 100px'>$e[verif2]</textarea>
    </div>
    ";
	?>
	<p>
	<div class="control-group">
    	<label class="control-label" for="fileInput"><b>Lampiran/Bukti Perbaikan (Jika ada)</b></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>Kirim/Selesai</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";
}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi2 a 
									LEFT JOIN pdiss b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ssurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM disposisi2 WHERE dPendisposisi='$e[pId]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM disposisi2 a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>History Disposisi :</legend>
<table class="table table-bordered" width="100%">
<thead>
	<td width=12%><b>Tgl RTL</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Tindak Lanjut </b></td>
	<td><b>Hasil RTL</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM pdiss a WHERE a.iid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN pdiss b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepadajab]</td>
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
if ($_POST[info]=="")
	{  
	    //echo "<script>window.alert('Jawaban tidak boleh kosong, silahkan kembali!');self.history.back();</script>";
	     
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
	mysql_query("UPDATE pdiss SET ptgls='$_POST[tgls]',ptgls2='$_POST[tgls2]',verif='$_POST[verif]',verif2='$_POST[verif2]', temuan='$_POST[temuan]', kondisi='$_POST[kondisi]',syarat='$_POST[syarat]',gap='$_POST[gap]',rootcause='$_POST[rootcause]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");

	echo "<script>window.location=('home.php?pages=udis2&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";

}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
	    
	    
	}
    else{ 
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
	mysql_query("UPDATE pdiss SET ptgls='$_POST[tgls]', temuan='$_POST[temuan]', kondisi='$_POST[kondisi]',syarat='$_POST[syarat]',gap='$_POST[gap]',rootcause='$_POST[rootcause]', info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE ssurat SET istatus='N' WHERE iid='$_POST[iid]'");

	echo "<script>window.location=('home.php?pages=udis2&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";

}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	}	
	
}elseif($_GET[act]=="accm"){
if ($_POST[info]=="")
	{  echo "<script>window.alert('Jawaban tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
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
	mysql_query("UPDATE pdiss SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE psin SET sistatus='N' WHERE siid='$_POST[siid]' AND cId='$_POST[pid]'");
	
	mysql_query("UPDATE tsin SET sistatus='N' WHERE siid='$_POST[siid]' AND cId='$_POST[pid]'");

	echo "<script>window.location=('home.php?pages=udis2&act=detail&pdid=$_GET[pdid]&id=$_GET[siid]');</script>";
 }
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	}	
}
else{
?>
<div class="block-content collapse in">
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th width=1%></th>
			<th width=5%>Tgl Batas Waktu</th>
			<th width=10%>Pembuat/Auditor</th>
			<th>Perihal CAPA</th>
			<th>RTL/CAPA</th>
			<th width=12%>Status/ Tgl Slesai</th>
			<th width=5%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM pdiss a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' AND a.siid=0 ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {

			$p1 = mysql_fetch_array (mysql_query("SELECT * FROM ssurat WHERE iid='$s[iid]'"));
			$sft = Array("14"=>"Improve","16"=>"TargetMutu","22"=>"Risk","23"=>"K.Pelanggan","29"=>"NCP","6b"=>"Audit Internal","6r"=>"Audit Eksternal","6c"=>"Reg","11"=>"Lain2","21"=>"Rapat");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$p1[jenisms]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]=="0000-00-00"){
				$tglS="-";
			}
			
			if ($s[psTglselesai]=="0000-00-00"){
				$st = "<strong>Belum Selesai</strong>";
			}else{
				$st = "Selesai";
			}
		
			if ($s[psTglselesai]=="0000-00-00"){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptgls]);echo"</td>
					<td>$s[cNama]($s[cIdjab])</td>
					<td>$p[siperihal]$p1[iperihal] - $p1[iperihal2]</td>
					<td>$s[pInstruksi]</td>
					<td>$st<br>(";echo tgl_indo($s[psTglselesai]);echo")</td>";
					
		
				
			  if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=udis2&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
				
					</td>
			  </tr>";	}
			  else {
				  echo"<td><a href='?pages=udis2&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
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
	Klik Baca/Detail untuk melihat Detail dan Konfirmasi Telah Dibaca serta menjawab penyelesaian tindak lanjut Tugas</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->