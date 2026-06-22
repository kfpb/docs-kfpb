<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>ACC Change Control (Khusus AM/MPM)</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim1=b.cId AND a.ccid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim=b.cId AND a.ccid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jcc FROM jeniscc WHERE kode_jcc='$ef[jeniscc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM ccinter a,users b WHERE a.ccpengirim2=b.cId AND a.ccid='$_GET[id]'"));
	

if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<? // echo"<a href='home1.php?pages=usracc&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
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
    <tr><td>No.Kode Sediaan/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
    <tr><td>Nama Produk/Bahan/Alat/Ruangan/Dokumen</td><td>: <?=$e[ccperihal1];?></td></tr>
    	<tr><td bgcolor=grey></td><td bgcolor=grey></td></tr>
	<tr><td>Usulan dari</td><td>: <strong><?=$ef[cJabatan];?>/ <?=$e[cJabatan];?></strong></td></tr>
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
	<tr><td>Status CC</td><td>: <strong>
<?
if ($e[ccstatus]=='N')
{
	echo"Belum ACC Petugas Change Control";
}
else
{
	echo"ACC Petugas Change Control";
}
?>
	</strong></td></tr>
	</table>
	<br></strong>
<?
	if($_SESSION[levelcv]<2){
	
	echo"<a href='?pages=ccinter&act=balas&id=$e[ccid]'' class='btn btn-info'>Klik untuk Balas Usulan CC Untuk diperbaiki!</a>"; 
	
	$ds = mysql_query("SELECT * FROM rtcc WHERE ccid='$e[ccid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " <a href='?pages=usracc&act=tambahrtcc&id=$e[ccid]' class='btn btn-info'>Buat Tindak Lanjut</a>";
					}else{
						echo " <a href='?pages=usracc&act=editrtcc&id=$e[ccid]' class='btn btn-info'>Tambah Tindak Lanjut</a>";
					}
	}
	?>


<?php	

$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {


    echo"<form method='post' action='?pages=usracc&act=commentcc'>
	<div class='control-group'>
			<label class='control-label' for='info'><b>Isi Pendapat terkait Change Control dan klik tombol COMMENT :</b></label>
        <div class='controls'>
		<input type=hidden name='ccid' value='$_GET[id]'>
		<textarea name='comment'>$baca[comment]</textarea>
    </div>";
	?>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Comment</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form><br><br><br><br>
<form method='post' action='?pages=usracc&act=acccc'>
<label class='control-label' for='info'><b>Jika setuju terhadap perubahan tekan tombol ACC dibawah :</b></label>
<input type=hidden name='ccid' value='$_GET[id]'>
<button class='btn btn-primary'>ACC CC</button>
</form>
";

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
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>DAFTAR RENCANA TINDAKAN CHANGE CONTROL</legend>
<?
echo"Lampiran Rencana Tindakan CC : <a href='rtcc/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl</b></td>
    <td width=10%><b>PenanggungJawab</b></td>
	<td><b>Rencana Tindakan & Kode</td>
	<td><b>Info Pelaksanaan RTCC</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ccid='$_GET[id]' AND a.pId='55' OR a.ccid='$_GET[id]' AND a.pId='81' ORDER BY a.pdid DESC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN cdis b ON b.cId=a.cId WHERE b.ccid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="0000-00-00";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="0000-00-00";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br><b>Batas Waktu :</b><br> $tgltarget</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Batas Waktu :</b><br> $tgltarget</td>
				<td>$t[kepadajab]</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_rtcc/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
</table>

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
<legend>Buat Tindak Lanjut CC</legend>
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
		<label class="control-label" for="tgls">Batas Waktu Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat Tindak Lanjut</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]<1){
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
		/*$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ccsin a,users b WHERE a.cId=b.cId AND a.ccid='$_GET[id]'"));	*/
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<option value="A">Rutin</option>
                <option value="B">Cito</option>
                <option value="C">Super Cito</option>
            </select>
		</div>
    </div>
	<? echo"<input type=hidden name=jawab value=Y>"; ?>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada/ Penanggung Jawab Tindakan</label>
    <div class="controls">
        	<select multiple="multiple" id="cdis" name="cdis[]" class="chzn-select span6">
             	<?php
				$cv = mysql_query("SELECT cId, bagian, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select><br>
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
}elseif($_GET[act]=="editrtcc"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM rtcc WHERE ccid='$_GET[id]'"));
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
<form method="post" action="include/ccinter/aksi_ccinter.php?act=editrtcc&ccid=<?=$ccid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Rencana Tindakan</legend>
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
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat Tindak Lanjut</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM rtcc a,users b WHERE a.dpendisposisi=b.cId AND a.ccid='$_GET[id]'"));
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
		<label class="control-label" for="tgls">Batas Waktu Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat Tindak Lanjut</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ccsin a,users b WHERE a.cId=b.cId AND a.ccid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<?php
				$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Super Cito");
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
    	<? echo"<input type=hidden name=jawab value=Y>"; ?>
		
     <div class="control-group">
    	<label class="control-label" for="cdis">Penanggung Jawab</label>
        <div class="controls">
        	<select multiple="multiple" id="cdis" name="cdis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, bagian, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Rencana Tindakan (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
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
     
  echo "<script>window.alert('Anda sukses isi Comment');window.location=('home.php?pages=usracc')</script>"; 
}

elseif($_GET[act]=="acccc"){

$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM csin WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'"));
$baca1 = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'"));
$baca3 = mysql_fetch_array(mysql_query("SELECT * FROM ccsin WHERE ccid='$_POST[ccid]' "));

mysql_query("UPDATE cdis SET iid='0' WHERE ccid='$_POST[ccid]' ");

if ($baca[tgl_baca]=='0000-00-00') {
    
  mysql_query("UPDATE csin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");

}
elseif  ($baca[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {

mysql_query("UPDATE csin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}

if ($baca1[tgl_baca]=='0000-00-00' AND $_POST[status]=='ditolak') {
    
  mysql_query("UPDATE ccsin SET tgl_baca='$tgl_sekarang', sistatus='Y', sistatus2='$_POST[status]', comment='$_POST[comment]' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
  mysql_query("UPDATE ccinter SET ccstatus2='closed' WHERE ccid='$_POST[ccid]'");
}
elseif ($baca1[tgl_baca]=='0000-00-00' AND $_POST[status]=='diterima') {
    
  mysql_query("UPDATE ccsin SET tgl_baca='$tgl_sekarang', sistatus='Y', sistatus2='$_POST[status]', comment='$_POST[comment]' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca1[tgl_baca]!='0000-00-00' AND $baca1[sistatus]=='N') {

mysql_query("UPDATE ccsin SET tgl_baca='$tgl_sekarang', sistatus='Y', sistatus2='$_POST[status]', comment='$_POST[comment]' WHERE ccid='$_POST[ccid]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca3[tgl_baca]!='0000-00-00' AND $baca3[sistatus]=='Y' AND $_POST[status]=='diterima') {

mysql_query("UPDATE ccsin SET sistatus2='$_POST[status]', comment='$_POST[comment]' WHERE ccid='$_POST[ccid]'");
}
elseif  ($baca3[tgl_baca]!='0000-00-00' AND $baca3[sistatus]=='Y' AND $_POST[status]=='ditolak') {

mysql_query("UPDATE ccsin SET sistatus2='$_POST[status]', comment='$_POST[comment]' WHERE ccid='$_POST[ccid]'");
}
elseif  ($baca3[tgl_baca]!='0000-00-00' AND $baca3[sistatus]=='N' AND $baca3[sistatus2]=='') {

mysql_query("UPDATE ccsin SET sistatus='Y', sistatus2='$_POST[status]', comment='$_POST[comment]' WHERE ccid='$_POST[ccid]'");
}

     
  echo "<script>window.alert('Submit Berhasil!');window.location=('home.php?pages=usracc')</script>"; 
}
else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th width=1%>.</th>
			<th width=5%>Tgl & No.CC</th>
			<th width=10%>Pengusul</th>
			<th>Judul CC</th>
			<th>Tgl ACC</th>
			<th>Lihat CC</th>

			
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM ccinter a LEFT JOIN ccsin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' ORDER BY a.cctgl DESC");
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[sistatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"<td>$s[sistatus]</td>";
		echo"<td width=5%><font size=1>";echo tgl_indo1($s[cctgl]);echo"<br>$s[ccnmr1]</font></td>
				<td width=5%>$s[cJabatan]</td>	
				<td>$s[ccperihal1]</td>
			    <td>";
                
                if ($s[tgl_baca]==0000-00-00) { echo "Belum ACC, Lihat CC!";} else { echo tgl_indo($s[tgl_baca]); }
				/*echo"</td>
				<td width=5%><a href='home.php?pages=usracc&act=detail&id=$s[ccid]' title=Detail class='btn btn-info'>ACC!</a>
				</tr>";	
				*/
				echo"</td><td><a href='home.php?pages=ccinter&act=detail&id=$s[ccid]' class='btn btn-info'>Lihat CC</a></td></tr>";
		}
	?>
	
	</tbody>
	</table>
	
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM DI BACA DAN ACC OLEH ANDA USULAN CHANGE CONTROL</strong><br>
	Untuk melihat detail rencana tindakan klik ACC/Detail,<br>
	Lihat dahulu rencana tindakan usulan Change Control-nya sebelum ACC<br>
	Klik 'ACC!' untuk konfirmasi Telah Dibaca, Isi pendapat dan ACC serta melihat Detail
	</h5>
	</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->