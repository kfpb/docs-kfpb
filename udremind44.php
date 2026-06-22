<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Tindaklanjuti Reminder/Pengingat Evaluasi Hasil Pelatihan</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM reminder2 a 
									LEFT JOIN premind b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN remind d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

if ($e1[iid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM reminder2 a 
									LEFT JOIN premind b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM reminder2 a 
									LEFT JOIN premind b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN remind d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

}	
			
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId=$e[pId]"));			
$sft = Array("A"=>"Bangunan","B"=>"Mesin","C"=>"Fasilitas","D"=>"K3L","E"=>"SDM");
$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
$sifat = "<span class='label label-".$bdg[$e[pSifat]]."'>".$sft[$e[pSifat]]."</span>";
$tglM=$e[ptglm];
$tglS=$e[ptgls];
if ($e[ptgls]=="0000-00-00"){
	$tglS="-";
}

if ($e[psTglselesai]=="0000-00-00"){
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

if ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="Y") {
mysql_query("UPDATE premind SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
elseif ($e[psTglbaca]=="0000-00-00" AND $e[jawab]=="N") {
mysql_query("UPDATE premind SET psTglbaca='$tglhrini', psTglselesai='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
?>
<strong>
<legend>Detail Pengingat/Reminder Untuk ditindaklanjuti</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Reminder </td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
    <tr><td>Masa Berlaku Mulai</td><td>: <?=tgl_indo($tglM);?></td></tr>
	<tr><td>Masa Berlaku Selesai</td><td>: <?=tgl_indo($tglS);?></td></tr>
    <tr>
		<td>Pembuat Reminder</td>
		<td>: <?=$user[cIdjab];?>
		</td>
	</tr>
	
	<tr><td>Kategori</td><td>: <?=$sifat;?></td></tr>
	<tr><td>Status</td><td>: <span class='label label-warning'><?=$status;?></span><br><?=$e[info];?></td></tr>
	
<?
if ($e1[iid]==0) {}

else {
/*$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[ipengirim]"));
  echo"<tr><td>Surat Masuk Dari</td><td>: <strong>$nama[cNama]</strong></td></tr>
  */
  
$ee = mysql_fetch_array(mysql_query("SELECT * FROM reminder2 WHERE dNoagenda='$e[pNoagenda]' AND iid=$_GET[id]")); 
									
	$srt = mysql_fetch_array(mysql_query("SELECT * FROM remind WHERE iid='$e[iid]'"));
	echo"
	<tr><td>Judul/ Perihal </td><td>: $e[pJudul]</td></tr>
	<tr><td>Keterangan </td><td>: $e[pInstruksi]</td></tr>
	<tr><td>Lihat Sumber Reminder</td><td>: <strong>
    <a href='home.php?pages=ruin&act=detail&id=$e[iid]'>Klik disini Lihat Agenda Reminder</a><br>
    : Perihal Reminder = $srt[iperihal]
	</strong></td></tr>
	<tr><td>Lampiran Pengingat/Reminder</td><td>: <a href='disposisi/$ee[disfile]'>Klik disini  (jika ada)</a></td></tr>
    <tr><td></td><td colspan='2'></td></tr>
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[jawab]=="Y"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM premind WHERE iid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=udremind&act=acc&pdid=$e[pdid]&iid=$e[iid]' enctype='multipart/form-data'>
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
    	<label class="control-label" for="fileInput"><b>Lampiran Jawaban Reminder (Jika ada)</b></label>
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

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM reminder2 a 
									LEFT JOIN premind b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN remind d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM reminder2 WHERE dPendisposisi='$e[pId]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPdisposisi FROM reminder2 a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<?php /*>
<legend>History Disposisi :</legend>
<table class="table table-bordered" width="100%">
<thead>
	<td width=12%><b>Tgl Buat</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Tindak Lanjut </b></td>
	<td><b>Hasil </b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM premind a WHERE a.iid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN premind b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
<?php */ ?>
<?
}

}


} elseif($_GET[act]=="acc"){
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
	mysql_query("UPDATE premind SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE remind SET istatus='N' WHERE iid='$_POST[iid]'");

	echo "<script>window.location=('home.php?pages=udremind&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";

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
	mysql_query("UPDATE premind SET info='$_POST[info]', psTglselesai='$tglhrini', psACC='Y', filedis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	
	mysql_query("UPDATE psin SET sistatus='N' WHERE siid='$_POST[siid]' AND cId='$_POST[pid]'");
	
	mysql_query("UPDATE tsin SET sistatus='N' WHERE siid='$_POST[siid]' AND cId='$_POST[pid]'");

	echo "<script>window.location=('home.php?pages=udremind&act=detail&pdid=$_GET[pdid]&id=$_GET[siid]');</script>";
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
		    <th width=5%>Masa berlaku Mulai</th>
			<th width=5%>Masa berlaku Slesai</th>
			<th width=10%>Pembuat</th>
			<th width=5%>Kategori</th>
			<th>Judul & Keterangan</th>
			<th width=10%>Status/ Tgl Slesai</th>
			<th width=5%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' AND pSifat='G' AND a.siid=0 ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {

			$p1 = mysql_fetch_array (mysql_query("SELECT * FROM remind WHERE iid='$s[iid]'"));			
            $sft = Array("A"=>"Bangunan","B"=>"Mesin","C"=>"Fasilitas","D"=>"K3L","E"=>"SDM","F"=>"UMUM","G"=>"Pelatihan");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
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
			
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptglm]);echo"</td>
			        <td>";echo tgl_indo($s[ptgls]);echo"</td>
					<td>$s[cNama]($s[cIdjab])</td>
					<td>$sifat</td>
					<td>$s[pJudul] - $s[pInstruksi] ($p[siperihal]$p1[iperihal])</td>
					<td>$st<br>(";echo tgl_indo($s[psTglselesai]);echo")</td>";
					
		
				
			  if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=udremind&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca</a>
				
					</td>
			  </tr>";	}
			  else {
				  echo"<td><a href='?pages=udremind&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail</a>
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