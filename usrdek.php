<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Daftar Dokumen Eksternal</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dester a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$e[jenisdok]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}

?>
<? /* echo"<a href='home1.php?pages=usrdek&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>"; */?>
<strong>
<legend>Detail Dokumen Eksternal</legend>
<table width="100%" border=1>
<? 
  $dok = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$e[lokasi]'");
  $r    = mysql_fetch_array($dok);
?>

<table width="100%" border=1>
    <tr><td>Tanggal Input </td><td>: <?=tgl_indo($e[ditgl_input]);?></td></tr>
    <tr><td width=25%>Jenis Dokumen</td><td>: <? if ($e[jenis]=='soft') { echo "Soft Copy/ File"; } else { echo "Hard Copy";} ?></td></tr>
    <tr><td>Lokasi dokumen</td><td>: <?=$t[cNama];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
    <tr><td>Penerbit/Pengarang</td><td>: <?=$e[penerbit];?></td></tr>
    <tr><td>Tahun</td><td>: <?=$e[tahun];?></td></tr>
    <tr><td>Keterangan</td><td>: <?=$e[keterangan];?></td></tr>
    <tr><td>File Dokumen </td><td>: <a title='File Dokumen' href='fdokest/<?=$e[difile];?>' target='_blank'>Klik Disini </a></td></tr>
	<tr><td>Status</td><td>: <strong>
<?
if ($e[distatus]=='N')
{
	echo"Belum terkirim";
}
else
{
	echo"Terkirim";
}
?>
	</strong></td></tr>
	</table>
	</table><br><br>
	<a href='?pages=dester&act=detail&id=<?=$e[suid];?>' class='btn btn-info' target=_blank>Daftar Penerima Dokumen</a>
	<br>

<br><br>
<?php	
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM desin WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]='IS NULL') {
mysql_query("UPDATE desin SET tgl_baca='$tgl_sekarang', distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca[tgl_baca]='IS NOT NULL' AND $baca[distatus]=='N') {
mysql_query("UPDATE desin SET distatus='Y' WHERE suid='$_GET[id]' AND cId='$_SESSION[cv]'");
}

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisidok a 
									LEFT JOIN ddis b ON a.suid=b.suid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN dester d ON a.suid=d.suid
									WHERE b.cId='$_SESSION[cv]' AND b.pdid=$_GET[pdid] AND a.suid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM disposisidok WHERE dPendisposisi='$_SESSION[cv]' AND suid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPendisposisi FROM disposisidok a WHERE a.suid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ddis a WHERE a.suid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

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

$query = "SELECT max(dNoagenda) as max_no FROM disposisidok WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("ID-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/dester/aksi_dester.php?act=tambahdisp&suid=<?=$suid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Disposisi Informasi Dokumen</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[levelcv]==0){
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
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pengirim</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
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
		/*$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM desin a,users b WHERE a.cId=b.cId AND a.suid='$_GET[id]'"));	*/
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>
			<input type=hidden name=jawab value='N'>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenis">Jenis Info Dokumen</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
                <option value="A">Laporan Pemusnahan Dokumen</option>
                <option value="B">Laporan Review Dokumen</option>
				<option value="C">Laporan Sosialisasi Dokumen</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="ddis" name="ddis[]" class="chzn-select span6">
             	<?php
				$cv = mysql_query("SELECT cId, bagian, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select><br>*Khusus Untuk Laporan Pemusnahan Dokumen Lama, Upload Lembar Sosialisasi Dokumen & Lembar Review Dokumen ditujukan ke SPD-MR !
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Informasi (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>	
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
}elseif($_GET['act']=="editdisp"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisidok WHERE suid='$_GET[id]'"));
$suid = $e['suid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisidok WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("ID-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/dester/aksi_dester.php?act=editdisp&suid=<?=$suid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Disposisi Informasi Dokumen</legend>
<?php
	if($_SESSION[levelcv]==0){
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
		<label class="control-label" for="pendisposisi">Pengirim</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM disposisidok a,users b WHERE a.dpendisposisi=b.cId AND a.suid='$_GET[id]'"));
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
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pengirim</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM desin a,users b WHERE a.cId=b.cId AND a.suid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<?php
				$sft = Array("A"=>"Laporan Pemusnahan Dokumen","B"=>"Laporan Review Dokumen","C"=>"Laporan Sosialisasi Dokumen");
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
    	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima disposisi harus jawab</option>
                <option value="N">Tidak, penerima disposisi tidak perlu jawab</option>
            </select>
		</div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="ddis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="ddis" name="ddis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, bagian, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select><br>*Khusus Untuk Laporan Pemusnahan Dokumen Lama, Upload Lembar Sosialisasi Dokumen & Lembar Review Dokumen ditujukan ke SPD-MR !
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Informasi (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paster)</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
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
<!-- batas dari disposisi.php -->


<?
}else{
?>
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
	    
	    <tr><th width=5%>No</th>
	        <th>Tanggal</th>
			<th>Judul</th>
			<th>Penerbit</th>
			<th>Tahun</th>
            <th class='center' width=20%>Aksi</th>
		</tr>
		
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab FROM dester a LEFT JOIN desin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' ORDER BY a.ditgl_input ASC");
		$no=1;
		while($s = mysql_fetch_array($smasuk)) {
		$tgl_input = tgl_indo($s[ditgl_input]);
		if ($s[distatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"   <td>$no</td>
		        <td>$tgl_input</td>
				<td>$s[dijudok]</td>
				<td>$s[penerbit]</td>
				<td>$s[tahun]</td>";
				echo "<td><center>
				<a href='home.php?pages=usrdek&act=detail&id=$s[suid]' title='Detail Dokumen' class='btn btn-info'> Baca/Detail</a>
				</center>
				</td>
				</tr>";	
		$no++;
		}
	?>
	</tbody>
	</table>
	
	<span class="label label-info">
<strong>Keterangan :</strong><br>	
<strong>Hijau : Belum dibaca Dokumen Eksternal masuk</strong><br>
<strong>Detail : Detail Informasi Dokumen Eksternal Lengkap</strong><br>

</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->