<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Memo Purchase Request (PR) Masuk untuk ditindaklanjuti</font></div>
</div>
<div>
<div>
<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM sinter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM sinter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<? echo"<a href='home1.php?pages=usrtm&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<strong>
<legend>Detail Memo Persetujuan Order-PR</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
	<tr><td>Kepada</td><td>: <? echo"$_SESSION[namacv]";?> (<? echo"$_SESSION[jabatan]";?>)</td></tr>
    <tr><td>Nomor Order/PR </td><td>: <?=$e[jenispptek];?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cJabatan];?>) / <?=$e[cNama];?> (<?=$e[cJabatan];?>)</strong></td></tr>
	</table>
	<br></strong>
	<table width="100%">
    <tr><td align=top><font color=blue><b>Daftar Barang/Jasa :</b></font></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
	<? echo"<tr><td colspan='2'><br><a href='home.php?pages=sinterm&act=detail&id=$e[siid]' class='btn btn-info'>Klik Lihat Detail Penerima!</a> 
	<a href='sinternal/$e[sifile]' class='btn btn-info'>Klik Untuk Lihat Lampiran!</a>
	<a href='?pages=sinter&act=balas&id=$e[siid]'' class='btn btn-info'>Klik untuk Balas Memo!</a>"; 
	
	$ds = mysql_query("SELECT * FROM disposisi WHERE siid='$e[siid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " <a href='?pages=usrtm&act=tambahdisp&id=$e[siid]' class='btn btn-info'>Buat Disposisi</a>";
					}else{
						echo " <a href='?pages=usrtm&act=editdisp&id=$e[siid]' class='btn btn-info'>Tambah Disposisi</i>";
					}
	?>
	</td></tr>
</table>
<br>
<?php	
$tgl_sekarang = date("Y-m-d");
// var_dump($_GET[id]);
$baca = mysql_fetch_array(mysql_query("SELECT * FROM psin WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca['tgl_baca']=='0000-00-00') {
mysql_query("UPDATE psin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
mysql_query("INSERT INTO psin(cId,siid) VALUES (73,'$_GET[id]')");
mysql_query("INSERT INTO psin(cId,siid) VALUES (74,'$_GET[id]')");
mysql_query("INSERT INTO psin(cId,siid) VALUES (83,'$_GET[id]')");

}
elseif  ($baca['tgl_baca']!='0000-00-00' AND $baca['sistatus']=='N') {
mysql_query("UPDATE psin SET sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
}

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi a 
									LEFT JOIN pdis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE dPendisposisi='$_SESSION[cv]' AND siid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM disposisi a WHERE a.siid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM pdis a WHERE a.siid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>History Disposisi No :<? echo"$edf[dNoagenda],"; ?>  oleh : <? echo"$_SESSION[namacv] - $_SESSION[idjab]"; ?></legend>
<?
echo"Lampiran Disposisi : <a href='disposisi/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl Disposisi</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Info</td>
	<td><b>Jawaban/Info</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM pdis a WHERE a.siid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");
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
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
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
//batas dari disposisi.php
elseif($_GET[act]=="tambahdisp"){
$siid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=tambahdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Disposisi</legend>
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
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
		            echo "<select id='pendisposisi' class='chzn-select' name='pendisposisi'>";
            
				$cv = mysql_query("SELECT cId, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
					}else{
						echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
					}
				}
			
		}
		else {
		/*$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	*/
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
                <option value="C">Rahasia</option>
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
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span6">
             	<?php
				$cv = mysql_query("SELECT cId, bagian, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select><br>*Bisa Pilih Grup Seperti Penerima Memo/Undangan
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi (Tekan Shift+Enter untuk pindah baris)</label>
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
}elseif($_GET[act]=="editdisp"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE siid='$_GET[id]'"));
$siid = $e['siid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/sinter/aksi_sinter.php?act=editdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Disposisi</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noagenda" value="$newID" required="required"></div>
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
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<?php
				$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
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
    	<label class="control-label" for="pdis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, bagian, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>*Bisa Pilih Grup Seperti Penerima Memo
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instruksi/Informasi (Tekan Shift+Enter untuk pindah baris)</label>
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
}else{
?>
<div>
<div>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th width=1%>Status</th>
			<th>Tanggal</th>
			<th width=25%>Perihal</th>
			<th>Isi</th>
			<th width=10%>Tgl Release</th>
			<th width=5%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	    	<?php
	    	
	if ($_SESSION[cv]=='73'){

		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='71' OR b.cId='72' OR b.cId='87' OR b.cId='27' OR a.sstatus='N'  ORDER BY a.sitgl DESC");
	    
	}
else {
		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId  WHERE a.jenisms='33' && b.cId='$_SESSION[cv]' && a.sstatus='Y' ORDER BY b.tgl_baca ASC");
}

// lama > SELECT a.*,b.*,c.cIdjab FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y'
// baru > SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='33' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N' && jenisms =33 
?>
	<?php			
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[jenisms]=='33'){
		if ($s[tgl_baca]==0000-00-00){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"<td>$s[sstatus]</td>";
		echo"<td width=5%>";echo tgl_indo($s[sitgl]);echo"</td>
				   <td><font size=2>$s[siperihal]<br><b>Note User :</b>$s[sikomen]</font></td>
				  <td><font size=2><b>No. Order/PR :$s[jenispptek]</b><br><b>Note Manager :</b>$s[sikomen2]<br>
				  <a href='sinternal/$s[sifile]'>Klik Untuk Lihat Lampiran!</a>
				  </font></td><td>";
			
                
                if ($s[tgl_baca]==0000-00-00) { echo "Belum di release SAP, klik Release SAP!";} else { echo tgl_indo($s[tgl_baca]); }
				echo"</td>
				<td width=5%><a href='home.php?pages=usrtm&act=detail&id=$s[siid]' title=DetailMemo class='btn btn-info'>Telah Release SAP!</a></td>
				</tr>";	
		}
		}
	?>
	</tbody>
	</table>
	
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA OLEH ANDA MEMO PR</strong><br>
	Klik 'BACA!' untuk konfirmasi Telah Dibaca, melihat detail dan balas serta buat/tambah disposisi<br>
	Jika perlu buat disposisi (instruksi/info) ke bagian lain (Bawahan, Sejajar, Atasan) Klik 'Buat/Tambah' Disposisi di Detail.
	</h5>
	</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->