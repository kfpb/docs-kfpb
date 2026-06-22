<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Disposisi Tela'ahan dari Bagian Pembelian</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$tglhrini = date("Y-m-d");
$e1 = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM tisposisi a 
									LEFT JOIN tdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN tsurat d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));

if ($e1[iid]==0) {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM tisposisi a 
									LEFT JOIN tdis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
}
else {
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM tisposisi a 
									LEFT JOIN tdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN tsurat d ON a.iid=d.iid
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

if ($e[psACC]=='N'){
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

if ($e[psTglbaca]=="0000-00-00") {
mysql_query("UPDATE tdis SET psTglbaca='$tglhrini' WHERE pdid='$e[pdid]' AND cId='$_SESSION[cv]'");
}
else {}

?>
<strong>
<legend>Detail Disposisi Tela'ahan</legend></strong>
<table width="100%" border=1>
	<tr>
		<td width="24%">Nomor Disposisi Tela'ahan</td><td>: <?=$e[pNoagenda];?></td>
	</tr>
    <tr><td>Tanggal Buat Disposisi</td><td>: <?=tgl_indo($e[ptgl]);?></td></tr>
	<tr><td>Target Tanggal Selesai</td><td>: <?=tgl_indo($tglS);?></td></tr>
    <tr>
		<td>Pendisposisi</td>
		<td>: <?=$user[cJabatan];?>
		</td>
	</tr>
	<tr><td>Informasi Tela'ahan :</td><td><?=$e[pInstruksi];?></td></tr>
	<tr><td>Sifat</td><td>: <?=$sifat;?></td></tr>
	<tr><td>Status</td><td>: <span class='label label-warning'><?=$status;?></span></td></tr>
	<tr><td>Jawaban/Informasi</td><td>: <span class='label label-warning'><?=$e[info];?></span></td></tr>
<?
if ($e1[iid]==0) {
}

else {
/*$nama = mysql_fetch_array(mysql_query("SELECT cNama FROM users WHERE cId=$e[ipengirim]"));
  echo"<tr><td>Surat Masuk Dari</td><td>: <strong>$nama[cNama]</strong></td></tr>
  */
$surat = mysql_fetch_array(mysql_query("SELECT * FROM tsurat WHERE iid=$e[iid]"));
	echo"<tr><td>Lihat Agenda Surat Penawaran</td><td>: <strong>
    <a href='home.php?pages=tuin&act=detail&id=$e[iid]' target=_blank>Klik disini Agenda Surat Penawaran</a><br>: 
     <a target=_blank title='Lampiran' href='smasuk/$surat[ifile]'>Klik disini File Surat Penawaran</a><br>
     : Perihal = $surat[iperihal]
	</strong></td></tr>
</table>
</strong>
<br>";
	
if ($e[psACC]=="N" AND $e[info]==""){
$e = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=utis&act=acc&pdid=$e[pdid]&iid=$e[iid]' enctype='multipart/form-data' onsubmit=return validasi_input(this)>
	<div class='control-group'>
	<label class='control-label' for='info'><b>(Jika ACC) Isi Disposisi/Pendapat/Jawaban/Informasi Tela'ahan :</b></font></label>
		<div class='controls'>
		<input type=hidden name=urut value='$e[urut]'>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'></textarea>
    </div>
    	<div class='control-group'>
    	<label class='control-label' for='fileInput'><b>Lampiran Jawaban Disposisi (Jika ada)</b></label>
        <div class='controls'>
        	<input class='input-file uniform_on' id='fileInput' type='file' name='fupload'> Max. 15 MB
        </div>
    </div>
		<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>ACC/Selesai</button>
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";

	echo"<form method='post' action='?pages=utis&act=accr&pdid=$e[pdid]&iid=$e[iid]'  onsubmit=return validasi_input(this)>
	<div class='control-group'>
	<label class='control-label' for='info'><b><font color=red><u>Jika Tidak/Belum ACC</u> dan perlu Konfirmasi/dikembalikan ke semua urutan sebelumnya<br> untuk di JAWAB ULANG oleh semua urutan sebelumnya, Isi disini :</b></font></font></label>
		<div class='controls'>
		<input type=hidden name=urut value=$e[urut]>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
		<textarea name='info' id='info' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
		
    </div>
		<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-danger'>Tidak ACC</button>
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br><br>";


}
elseif ($e[info]!=="" AND $e[psTglselesai]=='0000-00-00')
{
$e = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid=$_GET[id] AND pdid=$_GET[pdid]"));	
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[cId]'"));	
	
	echo"<form method='post' action='?pages=utis&act=acc&pdid=$e[pdid]&iid=$e[iid]' enctype='multipart/form-data'  onsubmit='return validasi_input(this)'>
	<div class='control-group'>
		<label class='control-label' for='info'><b>Edit Disposisi/Pendapat/Jawaban/Informasi Tela'ahan :</b></font></label>
        <div class='controls'>
		<input type=hidden name=urut value=$e[urut]>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
	<textarea name='info' id='editor'>$e[info]</textarea>
    </div>
        	<div class='control-group'>
    	<label class='control-label' for='fileInput'><b>Lampiran Jawaban Disposisi (Jika ada)</b></label>
        <div class='controls'>
        	<input class='input-file uniform_on' id='fileInput' type='file' name='fupload'> Max. 15 MB
        </div>
    </div>
		<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>ACC/Selesai</button>
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>";


	echo"<form method='post' action='?pages=utis&act=accr&pdid=$e[pdid]&iid=$e[iid]'  onsubmit='return validasi_input(this)'>
	<div class='control-group'>
	<label class='control-label' for='info'><font color=red><b>Jika belum ACC dan perlu Konfirmasi/dikembalikan ke semua urutan sebelumnya<br> untuk di JAWAB ULANG oleh semua urutan sebelumnya, Isi disini :</b></font></font></label>
		<div class='controls'>
		<input type=hidden name=urut value=$e[urut]>
		<input type=hidden name=iid value=$e[iid]>
		<input type=hidden name=cid value=$ed[cId]>
		<textarea name='info' id='info' class='input-large textarea' style='width: 610px; height: 100px'></textarea>
    </div>
		<div class='control-group'>
        <div class='controls'>
        <button class='btn btn-primary'>Kirim</button>
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>";


}

$f = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM tisposisi a 
									LEFT JOIN tdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN tuin d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$fg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$fgh = mysql_fetch_array(mysql_query("SELECT * FROM tisposisi WHERE dPentisposisi='$e[pId]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$e[pId]) as dPtisposisi FROM tisposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi tisposisi-->
<legend>History Disposisi Tela'ahan : </legend><b>
(Pengisian otomatis bertahap sesuai nomor urut !, Jika no urut ke-1 sudah menulis disposisi/pendapat dan klik ACC/Selesai maka notifikasi akan muncul di Bag.Pembelian dan di No.urut ke-2 dst.)</b>
<table class="table table-bordered" width="100%">
<thead>
	<td>No Urut</td>
    <td>Kepada</td>
	<td>Dibaca Tgl</td> 
    <td>Status/ Tgl Selesai</td>
	<td>Disposisi/Jawaban/Informasi/Pendapat</td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM tdis a WHERE a.iid='$_GET[id]' AND a.pId='$e[pId]' ORDER BY a.urut ASC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN tdis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				<td width=5%>$t[urut]</td>
				 <td width=15%>$t[kepada] ($t[kepadajab])</td>
				 <td width=15%>$tglBaca</td>
				<td width=15%><span class='label label-warning'>Menunggu</span><br>$tglSelesai</td>
				<td>$t[info], Lampiran : <a target='_blank' href='jwb_tisp/$t[filetdis]'>Jika ada Klik disini</a></td>
			 </tr>";
	}else{
		echo "<tr class='info'>
                <td width=5%>$t[urut]</td>
				 <td width=15%>$t[kepada] ($t[kepadajab])</td>
				 <td width=15%>$tglBaca</td>
				<td width=15%><span class='label label-success'>Selesai</span><br>$tglSelesai</td>
				<td>$t[info], Lampiran : <a href='jwb_tisp/$t[filetdis]'>Jika ada Klik disini</a></td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi disposisi-->
<?
}

}

/*}elseif(($e[psACC]=="Y") && ($_SESSION[levelcv]>=2) && ($_SESSION[levelcv]<=10)){ 
}elseif($e[psACC]=="Y"){ 
	$qcd =mysql_query("SELECT * FROM tdis WHERE iid='$_GET[id]' AND pId<>1");
	$cd = mysql_fetch_array($qcd);
	$ada = mysql_num_rows($qcd);
		
					
	$cv = mysql_query("SELECT a.cId, a.cNama FROM users a 
					   LEFT JOIN jabatan b ON b.idj=a.idj
					   WHERE a.cId<>'$_SESSION[cId]' AND b.idj>5");
	?>
	
	<form method="post" action="?pages=utis&act=fwd" enctype="multipart/form-data" class="form-horizontal">
	<div class="control-group">
		<input type="hidden" name="iid" value="<?=$e[iid];?>">
		<input type="hidden" name="pdid" value="<?=$a[pdid];?>">
		<label class="control-label" for="kepada"><strong>Teruskan Kepada</strong></label>
		<div class="controls">
			<select id="kepada" class="chzn-select" name="kepada">
			<?php
				if ($ada==0){
					echo "<option>Pilih users</option>";
				}
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$cd[cId]){
						echo "<option value=$dcv[cId] selected>$dcv[cNama]</option>";
					}else{
						echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
					}
				}
			?>
			</select>
			<span class="help-inline">* Abaikan Jika Tidak Diteruskan</span>
		</div> 
	</div>
	<div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        </div>
    </div>
	</form>
	*/
}elseif($_GET[act]=="acc"){

function UploadJwbt($fupload_name){
  //direktori file
  $vdir_upload = "jwb_tisp/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

	$tglhrini = date("Y-m-d");
	$tgl_sekarang = date ("Y-m-d");
	
if ($_POST[urut]==1){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Pendapat tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
        
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("d-M-Y");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwbt($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
        
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y', filetdis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET tampil='Y', psTglselesai='0000-00-00' WHERE iid='$_GET[iid]' AND urut='2'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]'");

	$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='2'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cId]'"));
/*
	$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Telaahan Produk/Jasa di ekfpb.com!',
								'Yth. $e[cNama] <br>Ada Telaahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Telaahan perihal : $ee[pInstruksi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
/*	
include "classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "ekfpb.com"; //host masing2 provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@ekfpb.com"; //user email
$mail->Password = "isokfpb9001"; //password email 
$mail->SetFrom("admin@ekfpb.com","ekfpb.com"); //set email pengirim
$mail->Subject = "Ada Tela'ahan Produk/Jasa di ekfpb.com!"; //subyek email
$mail->AddAddress("$e[cEmail2]","$e[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $e[cNama], <br>Ada Tela'ahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Tela'ahan perihal : $ee[pInstruksi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Disposisi berhasil terkirim dan email terkirim !, <br><a href=home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Disposisi berhasil terkirim tetapi email gagal terkirim !, <br><a href=home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]>KLIK DISINI</a> untuk kembali!
</h4></center>";

    echo"
    <script>
            var timer = setTimeout(function() {
                window.location='home.php?pages=utis'
            }, 3000);
    </script>";
*/
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}

if ($_POST[urut]==2){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Pendapat tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
        
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwbt($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
        
        
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y', filetdis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET tampil='Y', psTglselesai='0000-00-00' WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]'");

		$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='3'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cId]'"));

	
	echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}
elseif ($_POST[urut]==3){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Pendapat tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
        
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwbt($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
        
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y', filetdis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET tampil='Y', psTglselesai='0000-00-00' WHERE iid='$_GET[iid]' AND urut='4'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]' AND ikepada='30'");
	
	$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='4'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cId]'"));
/*
	$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Telaahan Produk/Jasa di ekfpb.com!',
								'Yth. $e[cNama], <br>Ada Telaahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Telaahan perihal : $ee[pInstruksi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
	
	echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";	
/*	
		$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='4'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cid]'"));

include "classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "ekfpb.com"; //host masing2 provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@ekfpb.com"; //user email
$mail->Password = "isokfpb9001"; //password email 
$mail->SetFrom("admin@ekfpb.com","ekfpb.com"); //set email pengirim
$mail->Subject = "Ada Tela'ahan Produk/Jasa di ekfpb.com!"; //subyek email
$mail->AddAddress("$e[cEmail2]","$e[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $e[cNama], <br>Ada Tela'ahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Tela'ahan perihal : $ee[pInstruksi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Disposisi berhasil terkirim dan email terkirim !, <br><a href=home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Disposisi berhasil terkirim tetapi email gagal terkirim !, <br><a href=home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]>KLIK DISINI</a> untuk kembali!
</h4></center>";	

echo"
<script>
        var timer = setTimeout(function() {
            window.location='home.php?pages=utis'
        }, 3000);
</script>";
*/	
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}
elseif ($_POST[urut]==4){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Pendapat tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
        
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwbt($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
        
        
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y', filetdis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET tampil='Y', psTglselesai='0000-00-00' WHERE iid='$_GET[iid]' AND urut='5'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]'");
	
	$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='5'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cId]'"));
/*
	$z=mysql_query("INSERT INTO emails (tgl,kepada,email,subjek,isi_email)
	                     VALUES('$tgl_sekarang',
                                '$e[cNama]',
                                '$e[cEmail2]',
								'Ada Telaahan Produk/Jasa di ekfpb.com!',
								'Yth. $e[cNama], <br>Ada Telaahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Telaahan perihal : $ee[pInstruksi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)')");
*/
	
	echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
/*
		$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='5'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cid]'"));

include "classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "ekfpb.com"; //host masing2 provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@ekfpb.com"; //user email
$mail->Password = "isokfpb9001"; //password email 
$mail->SetFrom("admin@ekfpb.com","ekfpb.com"); //set email pengirim
$mail->Subject = "Ada Tela'ahan Produk/Jasa di ekfpb.com!"; //subyek email
$mail->AddAddress("$e[cEmail2]","$e[cNama]");  //tujuan email
$mail->MsgHTML("Yth. $e[cNama], <br>Ada Tela'ahan Produk/Jasa dari Bagian Pengadaan di aplikasi http://ekfpb.com, <br>
Tela'ahan perihal : $ee[pInstruksi]
Untuk mengisi pendapat/disposisi silahkan segera login ke http://ekfpb.com<br>
Terima kasih<br>
Admin E-kfpb (Firman)
");
if($mail->Send()) echo "<center><h4>Disposisi berhasil terkirim dan email terkirim !, <br><a href=home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]>KLIK DISINI</a> untuk kembali!
</h4></center>";
else echo "<center><h4>Disposisi berhasil terkirim tetapi email gagal terkirim !, <br><a href=home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]>KLIK DISINI</a> untuk kembali!
</h4></center>";	

echo"
<script>
        var timer = setTimeout(function() {
            window.location='home.php?pages=utis'
        }, 3000);
</script>";
*/
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}
if ($_POST[urut]==5){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Pendapat tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
        
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwbt($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
        
        
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y', filetdis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET tampil='Y', psTglselesai='0000-00-00' WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]'");

		$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='3'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cId]'"));

	
	echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}
if ($_POST[urut]==6){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Pendapat tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
        
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $maxsize 		  = 1024 * 15000; // maksimal 15 MB
  $size_file	  = $_FILES['fupload']['size']<=$maxsize;
  $acak           = rand(1,99);
  $tgl_sekarang = date ("Y-m-d");
  $bln_sekarang = date("y-m.");
  $nama_file_unik = $bln_sekarang.$acak.$nama_file; 
  
 UploadJwbt($nama_file_unik);
 if($_FILES['fupload']['size']<=$maxsize){
        
        
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y', filetdis='$nama_file_unik' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET tampil='Y', psTglselesai='0000-00-00' WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]'");

		$ee = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE iid='$_GET[iid]' AND urut='3'"));
	$e = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$ee[cId]'"));

	
	echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
}
  else {
	   echo "<script>window.alert('Maaf... file yang ada pilih terlalu besar, maksimal 15 MB..!');self.history.back();</script>";
  }  	
	
}}
else {
	mysql_query("UPDATE tdis SET info='(Tgl ACC : $tgl_sekarang) $_POST[info]', psTglselesai='$tglhrini', psACC='Y' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tsurat SET istatus='N' WHERE iid='$_POST[iid]'");
	
		echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
	
}


}

elseif($_GET[act]=="accr"){
    $tglhrini = date("d-M-Y");

if ($_POST[urut]==1){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
}}

elseif ($_POST[urut]==2){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N' WHERE iid='$_GET[iid]' AND urut='1'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N' WHERE iid='$_GET[iid]' AND urut='2'");
}}
elseif ($_POST[urut]==3){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N' WHERE iid='$_GET[iid]' AND urut='1'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N' WHERE iid='$_GET[iid]' AND urut='2'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N' WHERE iid='$_GET[iid]' AND urut='3'");
}}
elseif ($_POST[urut]==4){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N' WHERE iid='$_GET[iid]' AND urut='1'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='2'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='4'");
}}
elseif ($_POST[urut]==5){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N' WHERE iid='$_GET[iid]' AND urut='1'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N' WHERE iid='$_GET[iid]' AND urut='2'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='4'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='5'");
	
}}
elseif ($_POST[urut]==6){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N' WHERE iid='$_GET[iid]' AND urut='1'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N' WHERE iid='$_GET[iid]' AND urut='2'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='4'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='5'");
	
}}
elseif ($_POST[urut]==7){
	if ($_POST[info]=="")
	{  echo "<script>window.alert('Isi tidak boleh kosong, silahkan kembali!');self.history.back();</script>";}
    else{ 
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N' WHERE iid='$_GET[iid]' AND urut='1'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N' WHERE iid='$_GET[iid]' AND urut='2'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='3'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='4'");
	mysql_query("UPDATE tdis SET psTglselesai='0000-00-00', psACC='N', tampil='N', tampil='N'  WHERE iid='$_GET[iid]' AND urut='5'");
	
}}
else {
	mysql_query("UPDATE tdis SET info='(Tgl Belum ACC : $tglhrini) $_POST[info]' WHERE pdid='$_GET[pdid]' AND cId='$_SESSION[cv]'");
}

	echo "<script>window.location=('home.php?pages=utis&act=detail&pdid=$_GET[pdid]&id=$_GET[iid]');</script>";
}

else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th width=1%></th>
			<th width=15%>Tanggal</th>
			<th>Isi Disposisi</th>	
			<th width=20%>Status</th>
			<th width=10%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    $dsp1 = mysql_fetch_array (mysql_query("SELECT a.*,b.cNama FROM tdis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' ORDER BY a.ptgl DESC"));
		if ($dsp1[iid]==0) {
		$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM tdis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' AND a.tampil='Y' ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {
			$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]=="0000-00-00"){
				$tglS="-";
			}
			
			if ($s[psACC]=='N'){
				$st = "<strong>Belum</strong>";
			}else{
				$st = "ACC/Selesai";
			}
		
			if ($s[psTglselesai]=="0000-00-00"){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			
							
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptgl]);echo"</td>
					<td>$s[pInstruksi]</td>
					<td>$st</td>";
		if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=utis&act=detail&id=$s[siid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca!</a></td>
			  </tr>";	
		}
			  else {
				  echo"<td><a href='?pages=utis&act=detail&id=$s[siid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail!</a></td>
			  </tr>";
				  
			  }
			 

		}	  

		}
		else {
			
			$dsp = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM tdis a LEFT JOIN users b ON a.pid=b.cId WHERE a.cId='$_SESSION[cv]' AND a.tampil='Y' ORDER BY a.ptgl DESC");
		while($s = mysql_fetch_array($dsp)) {
			$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$sifat = "<span class='label label-".$bdg[$s[dSifat]]."'>".$sft[$s[pSifat]]."</span>";
			$tglS=$s[ptgls];
			if ($s[ptgls]=="0000-00-00"){
				$tglS="-";
			}
			
			if ($s[psACC]=='N' OR $s[psTglselesai]=='0000-00-00'){
				$st = "<strong>Belum ACC/Selesai</strong>";
			}
			
			else{
				$st = "Telah ACC/Selesai";
			}
		
			if ($s[psTglselesai]=="0000-00-00"){
				echo "<tr class=success>";
			}else{
				echo "<tr>";
			}
			
							
			echo	"<td>$s[psACC]</td><td>";echo tgl_indo($s[ptgl]);echo"</td>
					<td>$s[pInstruksi]</td>
					<td>$st</td>";
			  if ($s[psTglbaca]=='0000-00-00'){
					echo"<td><a href='?pages=utis&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Baca!</a></td>
			  </tr>";	}
			  else {
				  echo"<td><a href='?pages=utis&act=detail&id=$s[iid]&pdid=$s[pdid]' title='Baca/Detail' class='btn btn-info'>Detail!</a></td>
			  </tr>";
				  
			  }
			 

		}	  
			

		}
	?>
	</tbody>
	</table>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Klik Baca/Detail untuk melihat Detail dan Konfirmasi Telah Dibaca serta menjawab penyelesaian Disposisi Tela'ahan</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->