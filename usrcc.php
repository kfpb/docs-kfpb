<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>ACC Usulan Change Control</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));

$baca = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if  ($baca[comment]=='Y') {
    
mysql_query("UPDATE csin SET comment='N' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");

}

if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<?// echo"<a href='home1.php?pages=usrcc&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>"; ?>
<strong>
<legend>Detail Usulan Change Control</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor CC </td><td>: <?=$e[ccnmr1];?></td></tr>
	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[cctgl]);?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
    <tr><td>Jenis Perubahan </td><td>: <?=$efg[nama_jcc];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
    <tr><td>Tingkat Perubahan</td><td>: <?=$e[cctingkat];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
   <tr><td>Level Perubahan</td><td>: <?=$e[levelcc];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
    <tr><td>No.Kode Sediaan/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
    <tr><td>Nama Produk/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal1];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Usulan dari</td><td>: <strong><?=$ef[cJabatan];?>/<?=$e[cJabatan];?></strong></td></tr>
		<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Proses/Prosedur/Perihal yang berlaku</td><td>: <?=$e[ccket];?></td></tr>
		<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Usulan Perubahan</td><td>: <?=$e[ccket2];?></td></tr>
		<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Alasan Perubahan</td><td>: <?=$e[ccket3];?></td></tr>
		<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Daftar Dokumen yang terkait Perubahan</td><td>: <?=$e[ccket4];?></td></tr>
		<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Lampiran CC/Risiko </td><td><a href='usulancc/<? echo"$e[ccfile]"; ?>'>: File</a></td></tr>
		<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
<tr><td>Izin POM/Regulator terkait ? </td><td>: <?
	if ($e[ceklist]==1) {
	echo"Perubahan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulator terkait diterima, perubahan telah disetujui oleh BPOM /regulator terkait, pemberitahuan perubahan akan dilaporkan ke BPOM oleh : $e[lapor_oleh] tanggal : $e[tgl_lapor]";
    }
	elseif ($e[ceklist]==2) {
    echo"Perubahan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulator terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulator terkait bersama dengan perubahan dokumen secara bertahap";
    }
	elseif ($e[ceklist]==3) { 
    echo"Perubahan telah di setujui oleh BPOM/regulator terkait tanggal : $e[accpom]";
    }
	else {
    echo"Tidak diperlukan pemberitahuan perubahan kepada BPOM/Regulator terkait";
    }
	
	?>
	</td></tr>
	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>	
	<tr><td>Status CC</td><td>: <strong>
<?
if ($e[ccstatus]=='N')
{
	echo"Belum Diterima Petugas Change Control";
}
else
{
	echo"Diterima Petugas Change Control";
}
?>
	</strong></td></tr>
	</table>
	<br></strong>

<?
	if($_SESSION[cv]=='55' OR $_SESSION[cv]=='81' OR $_SESSION[cv]=='99'){
	
	$ds = mysql_query("SELECT * FROM rtcc WHERE ccid='$e[ccid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " <a href='?pages=usrcc&act=tambahrtcc&id=$e[ccid]' class='btn btn-info'>Buat/Tambah Rencana Tindakan</a>";
					}else{
						echo " <a href='?pages=usrcc&act=tambahrtcc&id=$e[ccid]' class='btn btn-info'>Buat/Tambah Rencana Tindakan</a>";
					}
					
				    echo"<a href='home1.php?pages=ccinter3&act=print&id=$e[ccid]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Form Verifikasi</a><br>";	
					
	
$e = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
?>
<p>
<form method="post" action="include/ccinter/aksi_ccinter.php?act=editceklist&id=<?=$e[ccid];?>" enctype="multipart/form-data" class="form-horizontal">
<div class="control-group">
    	<label class="control-label" for="tingkat">Persiapan Perubahan</label>
        <div class="controls">
          	 <select id="ceklist" class="chzn-select span7" name="ceklist">
            <?php
		if ($e[ceklist]=='1')
		{
		    echo"<option>Pilih Ceklist</option>
			<option value='1' selected>Perubahan Menunggu Izin POM/Regulator</option>
			
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='2') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2' selected>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		elseif ($e[ceklist]=='3') {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3' selected>Perubahan telah disetujui POM/Regulator</option>
			<option value='4'>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
		else {
		    echo"<option>Pilih Ceklist</option>
			<option value='1'>Perubahan Menunggu Izin POM/Regulator</option>
		    <option value='2'>Perubahan tanpa Izin POM/Regulator, tapi dilaporkan bertahap</option>
		    <option value='3'>Perubahan telah disetujui POM/Regulator</option>
			<option value='4' selected>Tidak perlukan Lapor POM/Regulator</option>
		    ";
		}
			
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Disetujui POM</label>
        <div class="controls"><input id="tgl" type="text" name="accpom" value="<?=$e[accpom];?>" ></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Lapor POM</label>
        <div class="controls"><input id="tgl" type="text" name="tgl_lapor" value="<?=$e[tgl_lapor];?>" ></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="ns">Lapor Oleh</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="lapor_oleh" value="<?=$e[lapor_oleh];?>"></div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
	</form>
	<?
	}
	?>


<?php	

$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if  ($baca[tgl_baca]=='0000-00-00') {
/*
mysql_query("UPDATE csin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");
*/
}
elseif  ($baca[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
    

mysql_query("UPDATE csin SET sistatus='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");

}

if($_SESSION[cv]=='6900' AND $baca[sistatus2]=='N'){

mysql_query("UPDATE csin SET sistatus2='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");
   
}

$baca1 = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca1[tgl_baca]=='0000-00-00') {
    
/*
mysql_query("UPDATE ccsin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");
*/
}
elseif  ($baca1[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
    

mysql_query("UPDATE ccsin SET sistatus='Y' WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'");

}


$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM rtcc a 
									LEFT JOIN cdis b ON a.ccid=b.ccid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ccinter d ON a.ccid=d.ccid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.ccid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM rtcc WHERE dPendisposisi='$_SESSION[cv]' AND ccid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dcdisposisi FROM rtcc a WHERE a.ccid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='55' OR a.ccid='$_GET[id]' AND a.pId='81' OR a.ccid='$_GET[id]' AND a.pId='99' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>DAFTAR RENCANA TINDAKAN CHANGE CONTROL</legend>
<?
echo"Lampiran Rencana Tindakan CC : <a href='rtcc/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
    <td width=5%><b>No.</b></td>
	<td width=12%><b>Tanggal</b></td>
    <td width=10%><b>PenanggungJawab</b></td>
	<td width=30%><b>Rencana Tindakan/ Dokumen</td>
	<td width=30%><b>Info Pelaksanaan RTCC</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='55' OR a.ccid='$_GET[id]' AND a.pId='81' OR a.ccid='$_GET[id]' AND a.pId='99' ORDER BY a.urut ASC");
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
	if ($t[psACC]=="N" AND $t[info]!=""){
		echo "<tr class=warning>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Bts Waktu 1:</b><br> $tgltarget<br>
				<b>Bts Waktu 2 :</b> $tgltarget2<br>
				<b>Bts Waktu 3 :</b> $tgltarget3
				
				</td>
				<td>$t[kepadajab]";
            	if($_SESSION[cv]=='55' OR $_SESSION[cv]=='81' OR $_SESSION[cv]=='99'){
				
				
				echo"<br><a href='?pages=usrcc&act=editrtcc&id=$t[pdid]' class='btn btn-info'>Verif</a><a href='?pages=usrcc&act=delrtcc&id=$t[pdid]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-info'>Del</a><br>
				<form method=POST action='?pages=usrcc&act=editurut&id=$t[pdid]' target='_blank'><input class='input-small focused' type=text name=urut value=$t[urut]><input type=submit value=Go></form>";
				}			
				echo"</td>
				<td>$t[pInstruksi] <br>
				</td>
				<td><b>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				</td>
				<td><b>Tgl Hasil:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}
	elseif ($t[psACC]=="Y"){
		echo "<tr class=success>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Bts Waktu 1:</b><br> $tgltarget<br>
				<b>Bts Waktu 2 :</b> $tgltarget2<br>
				<b>Bts Waktu 3 :</b> $tgltarget3
				
				</td>
				<td>$t[kepadajab]";
            	if($_SESSION[cv]=='55' OR $_SESSION[cv]=='81' OR $_SESSION[cv]=='99'){
				
				
				echo"<br><a href='?pages=usrcc&act=editrtcc&id=$t[pdid]' class='btn btn-info'>Verif</a><a href='?pages=usrcc&act=delrtcc&id=$t[pdid]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-info'>Del</a><br>
				<form method=POST action='?pages=usrcc&act=editurut&id=$t[pdid]' target='_blank'><input class='input-small focused' type=text name=urut value=$t[urut]><input type=submit value=Go></form>";
				}			
				echo"</td>
				<td>$t[pInstruksi] <br>
				</td>
				<td><b>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				</td>
				<td><b>Tgl Hasil:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}
	else{
		echo "<tr>
		        <td>$t[urut]</td>
				<td>$tglDis<br><b>Bts Waktu 1:</b><br> $tgltarget
				<br>
				<b>Bts Waktu 2 :</b> $tgltarget2<br>
				<b>Bts Waktu 3 :</b> $tgltarget3
				
				</td>
				<td>$t[kepadajab]";
             	if($_SESSION[cv]=='55' OR $_SESSION[cv]=='81' OR $_SESSION[cv]=='99'){
				
				
				echo"<br><a href='?pages=usrcc&act=editrtcc&id=$t[pdid]' class='btn btn-info'>Verif</a><a href='?pages=usrcc&act=delrtcc&id=$t[pdid]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-info'>Del</a><br>
				<form method=POST action='?pages=usrcc&act=editurut&id=$t[pdid]' target='_blank'><input class='input-small focused' type=text name=urut value=$t[urut]><input type=submit value=Go></form>";
				}
				echo"</td>
				<td>$t[pInstruksi] <br></td>
				</td>
				<td>$t[info]
				<br><b>Verif 1 :<br></b> $t[info1]
				<br><b>Verif 2 (jika ada):<br></b> $t[info2]
				<br><b>Verif 3 (jika ada):<br></b> $t[info3]
				<br>Lampiran : <a href='jwb_rtcc/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Hasil:</b><br> $tglBaca<br><b>Tgl Verif 1:<br></b> $tglSelesai<br><b>Tgl Verif 2:<br></b> $tglSelesai2<br><b>Tgl Verif 3:<br></b> $tglSelesai3</td>
			 </tr>";
	}
}
?>
</table>

<?	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));
?>
<? echo"<a href='home1.php?pages=ccinter2&act=print&id=$e[ccid]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Persetujuan</a><br>";?>


<!-- /isi rtcc-->
<?



}
}

//batas 
elseif($_GET[act]=="tambahrtcc"){
$ccid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM rtcc WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("TC-%04s/$_SESSION[nppcv]/$bln", $noUrut);
?>

<form method="post" action="include/ccinter/aksi_ccinter.php?act=tambahrtcc&ccid=<?=$ccid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat/Tambah Tindak Lanjut CC</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor RTCC</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[cv]=='81' OR $_SESSION[cv]=='81' OR $_SESSION[cv]=='99'){
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
		<label class="control-label" for="tgls">Batas Waktu Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat Tindak Lanjut</label>
        <div class="controls">
		<?php
		
	   if($_SESSION[cv]=='55' OR $_SESSION[cv]=='81' OR $_SESSION[cv]=='99'){
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
		/*$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM csin a,users b WHERE a.cId=b.cId AND a.ccid='$_GET[id]'"));	*/
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
    <input type="hidden" name="sifat" value="A">

     <div class="control-group">
    	<label class="control-label" for="iid">Tampilkan langsung RTCC</label>
        <div class="controls">
        	<select id="iid" name="iid" class="chzn-select span2">
            	<option value="1">Tidak</option>
                <option value="0">Ya</option>
            </select>
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kode">Usulan Dokumen?</label>
        <div class="controls">
        	<select id="kode" name="kode" class="chzn-select span2">
            	<option value="N">Tidak</option>
                <option value="2">UPD</option>
                <option value="1">UPDB</option>
                <option value="3">UHD</option>
            </select>
            Usulan dokumen ada di Change Control?
            <select id="kode3" name="kode3" class="chzn-select span2">
            	<option value="N">Tidak</option>
                <option value="Y">Ya</option>
            </select>
		</div>
    </div>
     
      <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul Dokumen?</label>
        <div class="controls">
        <select id="pengirim" class="chzn-select-large" name="pengusul">
		<?

				$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]-$dcv[cJabatan]</option>";
				}
     
	    echo"</select>";
        ?> 
        Di isi jika usulan dokumen = Ya
		</div>
    </div> 
     		 
         
      <div class="control-group">
    	<label class="control-label" for="kode_dok">Kode Dokumen?</label>
        <div class="controls">
        <input type=text name=kode_dok>Di isi jika usulan dokumen = Ya
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="judul_dok">Judul Dokumen?</label>
        <div class="controls">
        <input type=text name=judul_dok>Di isi jika usulan dokumen = Ya
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="revisi">Revisi terakhir?</label>
        <div class="controls">
        <input type=text name=revisi>Di isi jika usulan dokumen = Ya
		</div>
    </div>
	<? echo"<input type=hidden name=jawab value=Y>"; ?>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada/ Penanggung Jawab Tindakan</label>
    <div class="controls">
        	<select multiple="multiple" id="cdis" name="cdis[]" class="chzn-select span6">
             	<?php
				$cv = mysql_query("SELECT cId, bagian, cJabatan, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select><br>
        </div> 
		</div>
	<div class="control-group">
    	<label class="control-label" for="urut">No Urut</label>
        <div class="controls">
        <input type=text name=urut>1-9 memakai 0 diawal, contoh 01,..dst
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Rencana Tindakan (Tekan Shift+Enter untuk pindah baris)</label>
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
}elseif($_GET[act]=="editurut"){

  $q=mysql_query("UPDATE cdis SET urut = '$_POST[urut]' WHERE pdid = '$_GET[id]'");

echo"
<script>window.alert('No Urut terupdate !')</script>
<script LANGUAGE=JavaScript>
function closePg(){
	window.close();
	return true;
}
</script>
<body onLoad='return closePg()'></body>";
 
}elseif($_GET[act]=="editrtcc"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM cdis WHERE pdid='$_GET[id]'"));
$ccid = $e['ccid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM rtcc WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("TC-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/ccinter/aksi_ccinter.php?act=editrtcc&id=<?=$e[pdid];?>" enctype="multipart/form-data" class="form-horizontal">
<input type=hidden name=ccid value='<?=$e[ccid];?>'>
<fieldset>
<legend>Edit/Verifikasi Tindak Lanjut CC</legend>
    	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor RTCC</label>
        <div class="controls"><?=$e[pNoagenda];?></div>
    </div>
<?php
	if($_SESSION[cv]=='99'){
	?>
    <div class="control-group">
		<label class="control-label">Tanggal RTCC</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required" value='<?=$e[ptgl];?>'></div>
    </div>
    <div class="control-group">
		<label class="control-label">Tanggal Kirim Info Hasil RTCC (User)</label>
        <div class="controls"><input class="input-small datepicker" id="tglbaca" type="text" name="tglbaca" required="required" value='<?=$e[psTglbaca];?>'></div>
    </div>
	
     <div class="control-group">
		<label class="control-label" for="tgls">Penanggungjawab</label>
        <div class="controls">
        
	  <select id="cid" class="chzn-select-8" name="pic">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cJabatan FROM users WHERE cId='$e[cId]'"));			
			echo "
			<option value='$e[cId]' selected>$ef[cNama] ($ef[cJabatan])</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] ($dvc[cJabatan])</option>";
				}
			
		echo"</select>";
         ?> 
        
        </div>
    </div>
    
      <div class="control-group">
		<label class="control-label" for="tgls">Pembuat Tindaklanjut</label>
        <div class="controls">
        
	  <select id="cid" class="chzn-select-8" name="pid">
			<?
			$efg = mysql_fetch_array(mysql_query("SELECT cId, cNama, cJabatan FROM users WHERE cId='$e[pId]'"));			
			echo "
			<option value='$e[pId]' selected>$efg[cJabatan]</option>
			<option value='55'>Supervisor Change Control</option>
			<option value='81'>Admin Change Control</option>
			";
			
		echo"</select>";
         ?> 
        
        </div>
    </div>
	<? } else {	 ?>
	<div class="control-group">
		<label class="control-label">Tanggal RTCC</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$e[ptgl]'><b>$e[ptgl]</b>";  ?></div>
    </div>
    <div class="control-group">
		<label class="control-label">Tanggal Kirim Info Hasil RTCC (User)</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglbaca' value='$e[psTglbaca]'><b>$e[psTglbaca]</b>";  ?></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Penanggungjawab</label>
        <div class="controls">
        
	  <select id="cid" class="chzn-select-8" name="pic">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cJabatan FROM users WHERE cId='$e[cId]'"));			
			echo "
			<option value='$e[cId]' selected>$ef[cNama] ($ef[cJabatan])</option>";
		echo"</select>";
         ?> 
        
        </div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgls">Pembuat Tindaklanjut</label>
        <div class="controls">
        
	  <select id="cid" class="chzn-select-8" name="pid">
			<?
			$efg = mysql_fetch_array(mysql_query("SELECT cId, cNama, cJabatan FROM users WHERE cId='$e[pId]'"));			
			echo "
			<option value='$e[pId]' selected>$efg[cJabatan]</option>
			<option value='55'>Supervisor Change Control</option>
			<option value='81'>Admin Change Control</option>
			";
			
		echo"</select>";
         ?> 
        
        </div>
    </div>
	<? } ?>
     <div class="control-group">
		<label class="control-label" for="tgls">Batas Waktu 1</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" value='<?=$e[ptgls];?>'></div>
    </div>
   <div class="control-group">
		<label class="control-label" for="tgls2">Batas Waktu 2</label>
        <div class="controls"><input class="input-small datepicker" id="tgls2" type="text" name="tgls2" value='<?=$e[ptgls2];?>'></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls3">Batas Waktu 3</label>
        <div class="controls"><input class="input-small datepicker" id="tgls3" type="text" name="tgls3" value='<?=$e[ptgls3];?>'></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tglv">Tgl Verifikasi 1</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tglv" value='<?=$e[psTglselesai];?>'></div>
    </div>
   <div class="control-group">
		<label class="control-label" for="tglv2">Tgl Verifikasi 2</label>
        <div class="controls"><input class="input-small datepicker" id="tgls2" type="text" name="tglv2" value='<?=$e[psTglselesai2];?>'></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tglv3">Tgl Verifikasi 3</label>
        <div class="controls"><input class="input-small datepicker" id="tgls3" type="text" name="tglv3" value='<?=$e[psTglselesai3];?>'></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="acc">Rencana Tindakan Selesai?</label>
        <div class="controls">
            <? if($e[psACC]=='Y'){
            echo"    
        	<select id='acc' name='acc' class='chzn-select span2'>
            	<option value='N'>Belum</option>
                <option value='Y' selected>Selesai</option>
            </select>";
            }
            else {
                 echo"    
        	<select id='acc' name='acc' class='chzn-select span2'>
            	<option value='N' selected>Belum</option>
                <option value='Y'>Selesai</option>
            </select>"; 
            }
            ?>
            
		</div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="kode">Usulan Dokumen?</label>
        <div class="controls">
            <? if($e[kode]=='Y'){
            echo"    
        	<select id='kode' name='kode' class='chzn-select span2'>
            	<option value='N'>Tidak</option>
                <option value='Y' selected>Ya</option>
            </select>";
            }
            else {
                 echo"    
        	<select id='kode' name='kode' class='chzn-select span2'>
            	<option value='N' selected>Tidak</option>
                <option value='Y'>Ya</option>
            </select>"; 
            }
            ?>
            
		</div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="kode_dok">Kode Dokumen?</label>
        <div class="controls">
        <input type=text name=kode_dok value='<?=$e[kode_dok];?>'>Di isi jika usulan dokumen = Ya
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="revisi">Revisi?</label>
        <div class="controls">
        <input type=text name=revisi value='<?=$e[revisi];?>'>Di isi jika usulan dokumen = Ya
		</div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="urut">No Urut</label>
        <div class="controls">
        <input type=text name=urut value='<?=$e[urut];?>'>Angka 1-9 memakai 0 diawal, contoh 01..dst
		</div>
    </div>
    
      <div class="control-group">
    <div class="control-group">
    	<label class="control-label" for="isi">Rencana Tindakan (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
			<textarea name="isi" id="editor"><?=$e[pInstruksi];?></textarea>
        </div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="info">Hasil Rencana Tindakan oleh user (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
            	<textarea name="info" id="info" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[info];?></textarea>
        </div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="info">Hasil Verifikasi-1 (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
            	<textarea name="info1" id="info1" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[info1];?></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="info">Hasil Verifikasi-2 (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
            	<textarea name="info2" id="info" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[info2];?></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="info">Hasil Verifikasi-3 (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
            	<textarea name="info3" id="info" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[info3];?></textarea>
        </div>
    </div>
    
	<div class='controls'>Lampirkan file/bukti verifikasi :
        	<input class='input-file uniform_on' id='fileInput' type='file' name='fupload'> Max. 15 MB
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="selesai">Verifikasi Terakhir? (Untuk close CC)</label>
        <div class="controls">
        	<select id='selesai' name='selesai' class='chzn-select span2'>
            	<option value='N' selected>Bukan</option>
                <option value='Y'>Ya</option>
            </select>
		</div>
    </div>
    
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Update</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?

}elseif($_GET[act]=="delrtcc"){
    
  mysql_query("DELETE FROM cdis WHERE pdid='$_GET[id]'");
     
  echo "<script>window.alert('Rencana Tindakan Sukses di Hapus');window.location=('home.php?pages=usrcc')</script>"; 
  
  
}elseif($_GET[act]=="commentcc"){

$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'"));
$baca1 = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {
    
  mysql_query("UPDATE csin SET comment='$_POST[comment]' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {

mysql_query("UPDATE csin SET comment='$_POST[comment]'  WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}

if ($baca1[tgl_baca]=='0000-00-00') {
    
  mysql_query("UPDATE ccsin SET comment='$_POST[comment]' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca1[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {

mysql_query("UPDATE ccsin SET comment='$_POST[comment]'  WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}
     
  echo "<script>window.alert('Anda sukses isi Comment');window.location=('home.php?pages=usrcc')</script>"; 
}

elseif($_GET[act]=="acccc"){
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'"));
mysql_query("UPDATE csin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
echo "<script>window.alert('Anda telah ACC ChangeControl');window.location=('home.php?pages=usrcc')</script>"; 
}


else{
?>
<div>
<div class="span12">
       <button class="btn-info btn-small" onclick="window.location.href='home3.php?pages=usrcc'"><< Hide Menu</button><button class="btn-info btn-small" onclick="window.location.href='home.php?pages=usrcc'">Show Menu >></button><br>
	
		<br /><br />
	
<div style="width:auto;overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th></th>
			<th>Tgl & No.CC</th>
			<th>Pengusul</th>
			<th>Nama CC</th>
			<th>Usulan CC</th>
			<th>Tgl Bahas</th>
			<th>Lihat CC</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM ccinter a LEFT JOIN csin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' ORDER BY a.cctgl DESC");
		while($s = mysql_fetch_array($smasuk)) {
		if($_SESSION[cv]=='81' OR $_SESSION[cv]=='55'){
		if ($s[sistatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		}
		else {
		    if ($s[comment]=='Y'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		}
		
		
		
		echo"<td>$s[sistatus]</td>";
		echo"<td><font size=1>"; echo tgl_indo1($s[cctgl]); echo"<br>$s[ccnmr1]</font></td>

				<td><font size=1>$s[cJabatan]</font></td>
				<td><font size=2>$s[ccperihal1]</font></td>
				<td><font size=1>$s[ccket2]</font></td>";
				
                
                if ($s[comment]==Y) { 
                
                				echo"<td><center>".tgl_indo($s[tgl_baca])." > <a href='home.php?pages=usrcc&act=detail&id=$s[ccid]' title=Detail class='btn btn-info'>Baca</a></center></td>";	
                
                
                } else { echo "<td><center>".tgl_indo($s[tgl_baca])." > <a href='home.php?pages=usrcc&act=detail&id=$s[ccid]' title=Detail class='btn btn-info'>Detail</a></center></td></td>";
                
                    			
                    
                    
                }
                echo "<td><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info' target=_blank>Lihat RTCC</a></td>
                </tr>";

		}
	?>
	</tbody>
	</table>
	</div>
	
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM DI BACA DAN ACC OLEH ANDA USULAN CHANGE CONTROL</strong><br>
	Untuk melihat detail rencana tindakan klik lihat RTCC
	</h5>
	</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->