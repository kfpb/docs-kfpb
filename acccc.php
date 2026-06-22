<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">ACC CHANGE CONTROL</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM sinter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));

if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<strong>
<legend>Detail Memo</legend>
<table width="100%">
	<tr><td width="24%">Nomor Memo</td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal Memo</td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr>
		<td>Memo dari</td>
		<td>: <img src="<?=$foto;?>" style="width: 60px; height: 60px;" class="tooltip-right" data-original-title="<?=$e[cNama];?>">
			<strong><?=$e[cNama];?></strong>
		</td>
	</tr>
	<tr><td>Memo untuk</td><td>: <?=$_SESSION[namacv];?></td></tr>
    <tr><td>Isi Memo</td><td>: <?=$e[siket];?></td></tr>
	<tr><td colspan="2"><br><a href="sinternal/<?=$e[sifile];?>">* Klik Untuk Lihat "Lampiran" Memo</a></td></tr>
</table>
</strong>
<br><br>
<?php	
$tgl_sekarang = date("Ymd");
mysql_query("UPDATE psin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");


$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi a 
									LEFT JOIN pdis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=a.dPendisposisi) as dPdisposisi FROM disposisi a WHERE a.siid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){
?>
<!-- isi rtcc-->
<legend>Disposisi</legend>
<table width="100%">
	<tr><td width="14%">Nomor Agenda</td><td>: <?=$ds[dNoagenda];?></td></tr>
    <tr><td>Tanggal</td><td>: <?=tgl_indo($ds[dTglM]);?></td></tr>
    <?php
	$sft = Array("A"=>"Rutin","B"=>"Penting","C"=>"Rahasia");
	$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
	$tglS=$ds[dTglS];
	if ($ds[dTglS]=="0000-00-00"){
		$tglS="";
	}
	?>
        <tr><td>Pendisposisi Awal</td><td>: <?=$ds[dPdisposisi];?></td></tr>
    <!--<tr><td>Target Tanggal Penyelesaian</td><td>: <?=tgl_indo($tglS);?></td></tr>	
    <tr><td>Instruksi/Informasi</td><td>: <?=$ds[dInstruksi];?></td></tr> -->
    <tr><td>Sifat</td><td>: <span class="label label-<?=$bdg[$ds[dSifat]];?>"><?=$sft[$ds[dSifat]];?></span></td></tr>
</table>
<br />
<legend>History Disposisi : (Disposisi awal dimulai dari bawah)</legend>
<table class="table table-bordered">
<thead>
	<td>Tgl Disposisi</td>
	<td>Target Selesai</td>
	<td>Disposisi Oleh</td>
    <td>Kepada</td>
	<td>Instruksi/Info</td>
	<td>Dibaca Tgl</td> 
    <td>Status</td>
	<td>Jawaban/Info</td>
	<td>Tgl Selesai</td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada 
					FROM pdis a WHERE a.siid='$_GET[id]' ORDER BY a.pdid DESC");

//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN pdis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				<td>$tglDis</td>
				<td>$tgltarget</td>
				<td>$t[oleh]</td>
				<td>$t[kepada]</td>
				<td>$t[pInstruksi]</td>
				<td>$tglBaca</td>
				<td><span class='label label-warning'>Menunggu</span></td>
				<td>$t[info]</td>
				<td>$tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>$tgltarget</td>
				<td>$t[oleh]</td>
				<td>$t[kepada]</td>
				<td>$t[pInstruksi]</td>
				<td>$tglBaca</td>
				<td><span class='label label-success'>ACC/ Selesai</span></td>
				<td>$t[info]</td>
				<td>$tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi rtcc-->
<?



}
}
//batas dari rtcc.php
elseif($_GET[act]=="tambahdisp"){
$siid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambahdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Disposisi</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noagenda" value="<? echo "DM$acak.$acak2/$_SESSION[nppcv]/$bln" ?>" required="required"></div>
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
		$tgl			 = date("d-m-y");
		$tgl1			 = date("20y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl ($tgl1)</b>";  ?></div>
    </div>
	<? } ?>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
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
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$ef[cNama]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
            	<option value="A">Rutin</option>
                <option value="B">Penting/Cito</option>
                <option value="C">Rahasia</option>
            </select>
		</div>
    </div>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId IN(SELECT cId FROM pdis WHERE siid='$siid')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId NOT IN(SELECT cId FROM pdis WHERE siid='$siid')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
				?>                             
            </select>
        </div> 
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="editdisp"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE siid='$_GET[id]'"));
$siid = $e['siid'];
?>
<form method="post" action="include/sinter/aksi_sinter.php?act=editdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit/Tambah Disposisi</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noagenda" value="<?=$e[dNoagenda];?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" value="<?=$e[dTglM];?>" required="required"></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <?php
		$tglS=$e[dTglS];
		if ($e[dTglS]=="0000-00-00"){
			$tglS="";
		}
		?>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" value="<?=$tglS;?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM disposisi a,users b WHERE a.dpendisposisi=b.cId AND a.siid='$_GET[id]'"));
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
        <div class="controls">
		<? echo"<input type=hidden name='tglm' value='$e[dTglM]'><b>$e[dTglM]</b>";  ?>
		</div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <?php
		$tglS=$e[dTglS];
		if ($e[dTglS]=="0000-00-00"){
			$tglS="";
		}
		?>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" value="<?=$tglS;?>"></div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$ef[cNama]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
            	<?php
				$sft = Array("A"=>"Rutin","B"=>"Penting","C"=>"Rahasia");
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
    	<label class="control-label" for="pdis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId IN(SELECT cId FROM pdis WHERE siid='$siid')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId NOT IN(SELECT cId FROM pdis WHERE siid='$siid')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
				?>                             
            </select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instruksi/Informasi</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"><?=$e[dInstruksi];?></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<!-- batas dari rtcc.php -->

<?php
}elseif($_GET[act]=="accpj"){
?>
<form method="post" action="include/usulancc/aksi_usulancc.php?act=accpj&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>List Nama yang Menyetujui Hasil Pembahasan Pengendalian Perubahan</legend>
	<div class="control-group">
    	<label class="control-label" for="psin">Yang menyetujui</label>
        <div class="controls">
        	<select multiple="multiple" id="acccc" name="acccc[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId IN(SELECT cId FROM acccc WHERE id_cc='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId NOT IN(SELECT cId FROM acccc WHERE id_cc='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
				?>                             
            </select>
        </div> 
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
    <br><br><br><br><br><br>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="accpcc"){
$idcc=$_GET['id']; ?>
<form method="post" action="include/usulancc/aksi_usulancc.php?act=accpcc&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>ACC Change Control oleh PCC</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal ACC</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_acc_pcc" type="text" name="tgl_acc_pcc" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_acc_atasan">Diterima/Ditolak?</label>
        <div class="controls">
		<select id="acc_pcc" class="chzn-select" name="acc_pcc">
		<option >Silahkan pilih</option>
		<option value="Y" selected>Diterima</option>
		<option value="N">Ditolak</option>
		</select>
		</div>
    </div>
	<div class="control-group">
		<label class="control-label" for="alasan_acc">Alasan ditolak (Jika ditolak)</label>
        <div class="controls"><input class="input-xxlarge focused" id="alasan_acc" type="text" name="alasan_acc"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="no_cc">Isi Nomor Change Control (Jika diterima)</label>
        <div class="controls"><input class="input-xxlarge focused" id="no_cc" type="text" name="no_cc"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal Bahas/Rapat</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_bhs" type="text" name="tgl_bhs" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="undangcc">Penerima Undangan Rapat CC</label>
        <div class="controls">
        	<select multiple="multiple" id="undangcc" name="undangcc[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId IN(SELECT cId FROM undangcc WHERE id_cc='$idcc')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama FROM users WHERE cId NOT IN(SELECT cId FROM undangcc WHERE id_cc='$idcc')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
				?>                             
            </select>
        </div> 
    </div>
	
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<? } else{
?>
<div class="block-content collapse in">
<div class="span12">
<?
if($_SESSION[idj]==1){
?>
<b><u>Daftar Usulan Perubahan (CC) yang masuk, belum di ACC oleh Petugas CC</b></u><br><p>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Tanggal CC</th>
			<th>Pengusul</th>
			<th>No. CC</th>
			<th>Nama CC</th>
			<th>Kode CC</th>
			<th>Tindakan PCC</th>
			<th>Lampiran</th>
			
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    $ccacc = mysql_query("SELECT * FROM usulancc WHERE acc_pj!='Y' AND acc_mpm!='Y' AND statuscc!=5 ORDER BY id_cc DESC");
		while($s = mysql_fetch_array($ccacc)) {
		$usercc = mysql_fetch_array (mysql_query("SELECT * FROM users WHERE cId=$s[pengusul]"));
		if ($s[tgl_acc_pcc]!='0000-00-00'){
			echo "<tr>";
		}else{
			echo "<tr class=success>";
		}
		 echo "<td>";echo tgl_indo($s[tgl_cc]);echo"</td>
			   <td>$usercc[cIdjab]</td><td>";
				if ($s[no_cc]=='' AND $s[tgl_acc_pcc]=='0000-00-00') { echo "<a href='?pages=acccc&act=accpcc&id=$s[id_cc]'>ACC PCC!</a>";} else { echo "$s[no_cc]"; } 
				echo"</td>
			   <td>$s[nama_cc]</td></td><td>$s[kode_cc]</td>";
		echo  "<td>";
		        $listpj = mysql_num_rows (mysql_query("SELECT * FROM acccc WHERE id_cc='$s[id_cc]'"));
				$listpj1 = mysql_num_rows (mysql_query("SELECT * FROM acccc WHERE id_cc='$s[id_cc]' AND tgl_acc='0000-00-00'"));
				if ($listp<1) {
					echo "<a href='?pages=acccc&act=accpj&id=$s[id_cc]'>Buat List ACC PJ</a>";}
					else {
					if ($listp1<1) {
				    echo "<a href='?pages=acccc&act=acctompm&id=$s[id_cc]'>Submit ke MPM utk ACC</a>";}
					else { echo "<a href='?pages=acccc&act=accpj&id=$s[id_cc]'>Edit List ACC PJ</a>";}
					}					
				
					$ds = mysql_query("SELECT * FROM rtcc WHERE id_cc='$s[id_cc]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " | <a href='?pages=acccc&act=tambahrtcc&id=$s[id_cc]'>Buat RTCC</a>";
					}else{
					echo " | <a href='?pages=acccc&act=editrtcc&id=$s[id_cc]'>Tambah RTCC</a>";
					}
				$ds1 = mysql_query("SELECT * FROM rtdok WHERE id_cc='$s[id_cc]'");
				$jr1 = mysql_num_rows($ds1);
				
					if ($jr<1){
						echo " | <a href='?pages=acccc&act=tambahrtdok&id=$s[id_cc]'>Buat RTDOK</a>";
					}else{
						echo " | <a href='?pages=acccc&act=editrtdok&id=$s[id_cc]'>Tambah RTDOK</a>";
					}
				
		echo"</td><td><a href='usulancc/$s[file_cc]' target='_blank'>CC</a> | <a href='kajianresiko/$s[file_risk]' target='_blank'>Risk</a></td>";
				echo "
				<td class='center'><a href='include/usulancc/aksi_usulancc.php?act=hapus&id=$s[id_cc]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=usulancc&act=edit&id=$s[id_cc]'> <i class='icon-edit'></i><a href='?pages=usulancc&act=detail&id=$s[id_cc]'> <i class='icon-th-list'></i>";
			echo "</td></tr>";	
		}
?>
	</tbody>
	</table>
	
	<br><br>
	<span class="label label-info">
	Tabel Baris Berwarna HIJAU = <strong>CHANGE CONTROL YANG BELUM ACC OLEH PCC DAN DIBERI NOMOR !</strong><br>
	Tabel Baris Berwarna PUTIH/ABU = <strong>CHANGE CONTROL SUDAH ACC DIBERI NOMOR OLEH PCC TAPI BELUM DIBAHAS DAN BUAT RENCANA TINDAKAN !</strong><br>
	1. Tampilkan Detail (Klik pada kolom No Change Control) Untuk ACC (Diterima/Ditolak) + Beri Nomor CC + Info/Undangan bahas !<br>
	2. Setelah Pembahasan/Rapat, buat daftar personil penanggungjawab yang terkait untuk melakukan ACC CC<br>
	3. Setelah Pembahasan/Rapat, buat/Tambah Rencana Tindakan Change Control + Rencana Tindakan Usulan Dokumen <br>
	4. Apabila selesai semua, maka tombol submit ke MPM akan muncul untuk di ACC MPM.<br>
	5. Apabila sudah di ACC MPM/ CC yang ditolak, maka daftar CC ini akan hilang dan pindah ke CC yang OPEN.
	</span>
</div>
</div>

<?php
}
elseif($_SESSION[idj]==3){
?>
<b><u>Daftar Usulan Perubahan (CC) yang masuk, belum di ACC oleh MPM</b></u><br>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Tanggal CC</th>
			<th>Pengusul</th>
			<th>Nomor CC</th>
			<th>Nama CC</th>
			<th>Kode CC</th>
			<th>Tindakan MPM</th>
			<th>Lampiran CC</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    $ccacc = mysql_query("SELECT * FROM usulancc WHERE tgl_acc_mpm!='0000-00-00' AND acc_pj='Y' ORDER BY id_cc DESC");
		while($s = mysql_fetch_array($ccacc)) {
		$usercc = mysql_fetch_array (mysql_query("SELECT * FROM users WHERE cId=$s[pengusul]"));
		 echo "<tr>
			   <td>";echo tgl_indo($s[tgl_cc]);echo"</td>
			   <td>$usercc[cIdjab]</td>
			   <td>$s[no_cc]</td>
			   <td>$s[nama_cc]</td></td>
			   <td>$s[kode_cc]</td>
			   <td><a href='?pages=acccc&act=accmpm&id=$s[id_cc]'>ACC</a></td>
			   <td><a href='usulancc/$s[file_cc]' target='_blank'>File CC</a> | <a href='kajianresiko/$s[file_risk]' target='_blank'>File Risk</a></td>
			   <td class='center'><a href='?pages=usulancc&act=detail&id=$s[id_cc]'>DETAIL</a></td>
			   </tr>";	
		}
?>
	</tbody>
	</table>
	
	<br><br>
	<span class="label label-info">
	1. Klik 'ACC' untuk ACC Change Control diterima/ ditolak, jika ditolak diisi alasan penolakan.<br>
	2. Klik 'Detail' untuk melihat detail change control.<br>
	</span>
</div>
</div>

<?php
}
}
?>
</div><!--/span12-->
</div><!--/block-content-->