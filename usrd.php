<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Distribusi & Penarikan Dokumen Terkendali</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid_dinter='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$e[jenisdok]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}

$get_dinter = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]'"));
//fungsi untuk post audit trail
 $session = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));

		$q = mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
		                            user,
                                   jabatan,
                                   ip_address,
                                   user_agent, 
				   kode_dokumen,
				   dokumen,
				   action,
				   deskripsi) 
	                     VALUES('$get_dinter[kode_aktivitas]',
	                            '$session[cNama]',
	                            '$session[cJabatan]',
	                            '-',
	                            '-',
	                            '$get_dinter[dikodok]',
	                            '$e[dijudok]',
	                            'read',
	                            'Membaca Distribusi Dokumen dengan judul $e[dijudok]'
	                     )");

?>
<? echo"<a href='home1.php?pages=usrd&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<strong>
<legend>Detail Distribusi Dokumen Terkendali</legend>
<table width="100%" border=1>
<? 
  $dok = mysql_query("SELECT * FROM dinter WHERE dikodok='$e[dikodok]'");
  $r    = mysql_fetch_array($dok);
?>
	<tr><td width="24%">Nomor </td><td>: <?=$e[dinmr];?></td></tr>
	<tr><td>Yang Bertanda Tangan</td><td>: <strong>Dokumentasi</strong></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[ditgl]);?></td></tr>
    <tr><td>Jenis Dokumen</td><td>: <?=$efg[nama_jendok];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Revisi</td><td>: <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
	<tr><td>Tanggal Efektif </td><td>: <?=tgl_indo($e[ditgl_brlk]);?></td></tr>
	<tr><td>Tanggal Maks Review </td><td>: <?=tgl_indo($e[ditgl_review]);?></td></tr>
    <!--<tr><td>File Dokumen </td><td>: <a title="Lampiran" href="dok/<?=$r[jenisdok];?>/<?=$r[difile];?>" target=_blank>Klik Disini </a></td></tr>-->
    <tr><td>File Dokumen </td><td>: Terlampir</td></tr>
<?php /*    <tr><td><font color=red>Password Dokumen </font></td><td>: <font color=red><?=$r[pass];?></font></td></tr> */ ?>
	</table>
	<br></strong>
	<table width="100%">
	
    <tr><td align=top><font color=blue><b>Informasi Distribusi :</b></font></td><td></td></tr><tr><td><?=$e[diket];?></td></tr>
	<? echo"<tr><td colspan='2'>
	<br><a href='home.php?pages=dister&act=detail&id=$e[suid]' class='btn btn-info'>Detail Penerima Dokumen</a>"; 
	
	?>
	</td></tr>
</table>
<?php if ($r['distatus'] != 'N') { ?>
<!--<iframe src="dok/web/viewer.html?file=index1.php?id=<?php //echo $r[suid];?>" width=100% height=500></iframe>-->
<iframe src="dok/web/viewer.html?file=/dok/<?php echo $r['jenisdok']?>/<?php echo $r['difile'] ?>" width=100% height=500></iframe>
<?php } else { ?>
<div class="alert alert-warning">
    <b>Perhatian:</b> Dokumen ini sudah obsolete. File PDF tidak ditampilkan.
</div>
<?php } ?>
<?php /*<iframe src="dok/<?=$r[jenisdok];?>/<?=$r[difile];?>" width=100% height=500></iframe> 
<br><br>
<b>Informasikan hasil pemusnahan/pengembalian dokumen, hasil sosialisasi dokumen melalui tombol di bawah ini :</b><br>
<?

	$ds = mysql_query("SELECT * FROM distribusidok WHERE suid='$e[suid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " <a href='?pages=usrd&act=tambahdisp&id=$e[suid]' class='btn btn-info'>Buat Info Dokumen ke Spv. Dokumentasi-MR</a>";
					}else{
						echo " <a href='?pages=usrd&act=tambahdisp&id=$e[suid]' class='btn btn-info'>Tambah Info Dokumen ke Spv. Dokumentasi-MR</a>";
					}
					?>

<br><br>
*/ ?>
<?php	
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]='IS NULL') {
mysql_query("UPDATE disin SET tgl_baca='$tgl_sekarang', distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca[tgl_baca]='IS NOT NULL' AND $baca[distatus]=='N') {
mysql_query("UPDATE disin SET distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");
}

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM distribusidok a 
									LEFT JOIN ddist b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN dister d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.suid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM distribusidok WHERE dPendisposisi='$_SESSION[cv]' AND suid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPendisposisi FROM distribusidok a WHERE a.suid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddist a WHERE a.suid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>Info Dokumen dari : <? echo"$_SESSION[namacv]"; ?></legend>

<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Informasi Dok.</td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddist a WHERE a.suid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t[psTglbaca]='IS NULL'){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br></td>
				<td>Dokumentasi</td>
				<td>";
				if ($t[pSifat]==A) { echo"<b><u>Pemusnahan Dokumen</u></b>";}
				elseif ($t[pSifat]==B) { echo"<b><u>Pengembalian Dokumen</u></b>";}
				else { echo"<b><u>Sosialisasi Dokumen</u></b>";}
				echo"<br>$t[pInstruksi]
			    <br>Lampiran : <a href='distribusidok/$t[disfiles]'>klik disini (jika ada)</a>
				</td>
				<td><b>Tgl Baca:</b></td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>Dokumentasi</td>
				<td>";
				if ($t[pSifat]==A) { echo"<b><u>Pemusnahan Dokumen</u></b>";}
				elseif ($t[pSifat]==B) { echo"<b><u>Pengembalian Dokumen</u></b>";}
				else { echo"<b><u>Sosialisasi Dokumen</u></b>";}
				echo"<br>$t[pInstruksi]
				<br>Lampiran : <a href='distribusidokumen/$t[disfiles]'>klik disini (jika ada)</a>
				</td>
				<td><b>Tgl Baca:</b>
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

$query = "SELECT max(dNoagenda) as max_no FROM distribusidok WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("ID-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/dister/aksi_dister.php?act=tambahdisp&suid=<?=$suid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Laporan/Informasi Dokumen ke Spv. Dokumentasi</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[levelcv]==0 OR $_SESSION[levelcv]==1){
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
		
		if($_SESSION[levelcv]==0 OR $_SESSION[levelcv]==1){
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
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>
			<input type=hidden name=jawab value='N'>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenis"><font color=red>Jenis Info Dokumen</font></label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span6" required="required">
        	    <option value="" selected>Pilih Jenis info dokumen</option>
                <option value="A">Laporan Pemusnahan Dokumen</option>
                <option value="B">Laporan Pengembalian Dokumen</option>
                <option value="C">Laporan Sosialisasi Dokumen</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        
    <input type='hidden' name='ddist' value='2'><b>Spv. Dokumentasi</b>
        
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Informasi (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>	
        <div class="controls">
			<textarea name="isi" id="editor">
			<b>[Jika Pemusnahan Dokumen]</b><br>
			<b>Berita Acara Pemusnahan Dokumen</b><br>
			Telah dimusnahkan dokumen pada hari/tanggal : .........<br>
			Kode dokumen .....  Revisi ..... Jumlah Copy : ........<br>
			Judul ...............<br>  
			Cara pemusnahan : ...........<br>
			Bukti pemusnahan terlampir<br>
			
			<br><br><br>
			<b>[Jika Sosialisasi Dokumen]</b><br>   
			Telah disosialisasikan dokumen pada hari/tanggal : .........<br>
			Kode dokumen .....  Revisi .....<br>  
			Judul ...............<br>
			Cara sosialisasi : ...........<br>
			Bukti sosialisasi terlampir<br>
			
			<br><br><br>
			<b>[Jika Pengembalian Dokumen]</b><br>   
			Telah dikembalikan pada hari/tanggal : .........<br>
			Dokumen lama ke SRRD =<br>
			Kode dokumen .....  Revisi .....<br>  
			Judul ...............<br>

			
			    
			</textarea>
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
}else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
		<tr>
		<th width=1%></th>
			<th width=13%>Tanggal</th>
			<th width=12%>Kode</th>
			<th width=5%>Rev</th>
			<th>Judul</th>
			<th width=13%>Tgl baca</th>
			<th width=5%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
// 		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab FROM dister a LEFT JOIN disin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' GROUP BY a.suid ORDER BY a.ditgl DESC");
		$smasuk = mysql_query("SELECT a.*,b.* FROM dister a LEFT JOIN disin b ON a.suid_dinter=b.suid WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' GROUP BY b.suid ORDER BY a.ditgl DESC");
		
// 		$smasuk = mysql_query("
//             SELECT a.*, b.*, c.cIdjab 
//             FROM dister a 
//             LEFT JOIN disin b ON a.suid_dinter = b.suid 
//             LEFT JOIN users c ON a.dipengirim = c.cId 
//             WHERE b.cId = '$_SESSION[cv]' 
//             AND a.distatus = 'Y' 
//             GROUP BY a.suid 
//             ORDER BY a.ditgl DESC
//         ");
        


		while($s = mysql_fetch_array($smasuk)) {
		if ($s[distatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"<td>$s[distatus]</td>";
		echo"<td>";echo tgl_indo1($s[ditgl]);echo"</td>
				<td >$s[dikodok]</td>
				<td>$s[direv]</td>
				<td>$s[dijudok]</td><td>";
                
                if ($s[tgl_baca]='IS NOT NULL') { echo "Belum dibaca,<br> klik Baca!";} else { echo tgl_indo1($s[tgl_baca]); }
				echo"</td>
				<td><a href='home.php?pages=usrd&act=detail&id=$s[suid]' title=Detail class='btn btn-info'>Baca!</a></td>
				</tr>";	
		}
	?>
	</tbody>
	</table>
	
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>DISTRIBUSI DOKUMEN BELUM TERBACA OLEH ANDA</strong><br>
	Klik 'BACA!' untuk konfirmasi Telah Dibaca, melihat detail dan Buat/Tambah info dokumen <br>(Pemusnahan, Pengembalian & Sosialisasi Dokumen)
	</h5>
	</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->