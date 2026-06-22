<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">IMPROVEMENT/ CAPA</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(icnmr) as max_no FROM icapa WHERE icnmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("SC-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/scapa/aksi_scapa.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Sumber CAPA (Admin)</legend>
<input type="hidden" name="nomor" value="<? echo "$newID" ?>">
<?php
	if($_SESSION[levelcv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="dari">Dari</label>
        <div class="controls">
            <select id="dari" class="chzn-select" name="dari">
            	<option>Pilih Dari</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            	<option>Pilih Kepada</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<? }
	else { ?>
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"> <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="dari">dari</label>
        <div class="controls"><?  echo "<input type=hidden name=dari value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";  ?>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
         <?  echo "<input type=hidden name=kepada value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";  ?>
        </div> 
    </div>
	
	<? } ?>	
	<div class="control-group">
    	<label class="control-label" for="Jeniscapa">Jenis CAPA</label>
        <div class="controls">
          	 <select id="jeniscapa" class="chzn-select span9" name="jeniscapa" required="required">
            	<option value=0>Pilih/Cari Jenis CAPA</option>
            <?php
				$vc = mysql_query("SELECT kode_jcp, nama_jcp FROM jeniscapa ORDER BY kode_jcp ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jcp]'>$dvc[nama_jcp]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal/ Judul</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ringkasan/Isi Sumber Improve/CAPA (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
				<textarea name="ket" id="editor"></textarea>
        </div>
    </div>
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM icapa WHERE icid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM icapa a,users b WHERE a.ickepada=b.cId AND a.icid='$_GET[id]'"));
?>
<form method="post" action="include/scapa/aksi_scapa.php?act=edit&id=<?=$e[icid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Sumber CAPA</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor </label>
        <div class="controls"><input type="hidden" name="nomor" value="<?=$e[icnmr];?>"><?=$e[icnmr];?></div>
    </div>
<?php
	if($_SESSION[levelcv]<1){
	?>
	
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[ictgl];?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="dari">Dari</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT idari FROM icapa");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[idari]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="dari" class="span4" id="dari" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[idari];?>">
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            <?php
				echo "<option value=$e[ickepada] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
				echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
		
	<? } 
	else {
		
	 ?>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[ictgl];?>"><? echo tgl_indo($e[ictgl]); ?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="dari"></label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT idari FROM icapa");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[idari]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="hidden" name="dari" class="span4" id="dari" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[idari];?>">
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            <?php
				echo "<option value=$e[ickepada] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				
			?>
           	</select>
        </div> 
    </div>
<? } ?>
	
	<div class="control-group">
    	<label class="control-label" for="Jeniscapa">Jenis Sumber CAPA</label>
        <div class="controls">
          	 <select id="jeniscapa" class="chzn-select span9" name="jeniscapa" required="required">
            	<option>Pilih/Cari Jenis CAPA</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jeniscapa WHERE kode_jcp='$e[jeniscapa]'"));
				echo"<option value='$e[jeniscapa]' selected>$v[nama_jcp]</option>";
				$vc = mysql_query("SELECT kode_jcp, nama_jcp FROM jeniscapa ORDER BY kode_jcp ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jcp]'>$dvc[nama_jcp]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[icperihal];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Ringkasan/Isi Sumber CAPA (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		<textarea name="ket" id="editor"><?=$e[icket];?></textarea>
    </div>
	</div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB <br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
}elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM icapa a,users b WHERE a.ickepada=b.cId AND a.icid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT nama_jcp FROM jeniscapa WHERE kode_jcp='$e[jeniscapa]'"));
$s1 = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[idari]'"));

if ($e[ickepada]==$_SESSION[cv]){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE icapa SET icstatus='Y', ictgl_baca='$tgl_sekarang'  WHERE icid='$_GET[id]' AND ickepada='$_SESSION[cv]'");

}
?>
<? echo"<a href='home1.php?pages=scapa&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<strong>
<legend>Detail Sumber CAPA</legend>
<table width="100%" border=1>
    <tr><td>Tanggal</td><td>: <?=tgl_indo($e[ictgl]);?></td></tr>
    <tr><td>Perihal/ Judul</td><td>: <?=$e[icperihal];?></td></tr>
	<tr><td>Jenis CAPA</td><td>: <?=$ef[nama_jcp];?></td></tr>
    <tr><td>dari</td><td>: <strong><?=$s1[cNama];?> (<?=$s1[cIdjab];?>)</strong></td></tr>
    <tr><td>Kepada</td><td>: <strong><?=$e[cNama];?> (<?=$e[cIdjab];?>)</strong></td></tr>
	<tr><td>Lampiran</td><td>: <a title="Lampiran" href="scapa/<?=$e[icfile];?>">Klik Disini (Jika Ada)</td></tr>
	</table>
	<br>
<table width="100%">
    <tr><td>Ringkasan Sumber CAPA :</td><tr>
	<tr><td><?=$e[icket];?></td></tr>
</table>
</strong>
<br />
<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM ucapa a 
									LEFT JOIN pcapa b ON a.icid=b.icid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN scapa d ON a.icid=d.icid
									WHERE b.cId='$_SESSION[cv]' AND pcid=$_GET[pcid] AND a.icid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM ucapa WHERE dPembuat='$_SESSION[cv]' AND icid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dpcapaposisi FROM ucapa a WHERE a.icid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi capa-->
<legend>Daftar CAPA :</legend>
<table class="table table-bordered" border=1>
<thead>
	<td width=12%><b>Tgl CAPA</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Info</b></td>
	<td><b>Jawaban/Info</b></td>
	<td width=12%>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM pcapa a WHERE a.icid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pcid DESC");

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
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi capa-->
<?php	
}
?>

<?php
//batas dari ucapa
}elseif($_GET[act]=="tambahcapa"){
$icid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNo) as max_no FROM ucapa WHERE dNo LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("C-%04s/$_SESSION[nppcv]/$bln", $noUrut);

$capa = mysql_fetch_array(mysql_query("SELECT * FROM icapa WHERE icid=$icid"));

?>
<form method="post" action="include/scapa/aksi_scapa.php?act=tambahcapa&icid=<?=$icid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Improvement/CAPA</legend>
	
<?php
	if($_SESSION[levelcv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal :</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
	<? } else {	 ?>
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal :</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
	<? } ?>
     
    <div class="control-group">
		<label class="control-label" for="dari">Dari/Pembuat :</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
		            echo "<select id='dari' class='chzn-select' name='dari'>";
            
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
					}else{
						echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				}
			?>
			    	</select>
					</div>
					</div>
			  <div class="control-group">
		<label class="control-label" for="kategori">Sumber CAPA :</label>
        <div class="controls">
			<?			
			 echo "<select id='kategori' class='chzn-select' name='kat_scapa'>
					<option value='0'>Pilih Sumber CAPA</option>";
            $capa1 = mysql_query("SELECT * FROM icapa");
				while ($dcapa=mysql_fetch_array($capa1)){
		    	     	echo "<option value='$dcapa[icperihal]'>$dcapa[icperihal]</option>";
				}
				?>
			</select>
					</div>
					</div>
			<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="pcapa" name="pcapa[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                            
            </select>*Bisa Pilih Grup
        </div> 
		</div>
		<?	
		}
		else {
		$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));
			echo "<input type=hidden name=dari value=$_SESSION[cv]><b>$_SESSION[namacv]</b><br>
			<input type=hidden name=dari2 value=$e[cId]>Atasan : <b>$e[cNama]</b><br>
			<input type=hidden name=pcapa value=$_SESSION[cv]>
			
			</div>
			</div>";
			?>
			 <div class="control-group">
		<label class="control-label" for="kategori">Sumber CAPA :</label>
        <div class="controls">
			<?			
			 echo "<input type=hidden name=kat_scapa value=$capa[cv]><b>$capa[icperihal]</b>";
				?>
			</select>
					</div>
					</div>
			<?
		}
			
		?>
           	
      
	<div class="control-group">
    	<label class="control-label" for="kategori">Kategori CAPA :</label>
        <div class="controls">
        	<select id="kategori" name="kategori" class="span2">
            	<option value="0" selected>-Pilih Kategori CAPA-</option>
				<option value="Critical (Temuan Audit)">Critical (Temuan Audit)</option>
                <option value="Mayor (Temuan Audit)">Mayor (Temuan Audit)</option>
                <option value="Minor (Temuan Audit)">Minor (Temuan Audit)</option>
				<option value="Observasi (Temuan Audit)">Observasi (Temuan Audit)</option>
				<option value="Rapat Tinjauan Manajemen (RTM)">Rapat Tinjauan Manajemen (RTM)</option>
				<option value="Sasaran/ Target Mutu">Sasaran/ Target Mutu</option>
				<option value="Kepuasan Pelanggan">Kepuasan Pelanggan</option>
				<option value="Kajian Resiko">Kajian Resiko</option>
				<option value="Lainnya">Lainnya</option>
				
            </select> *Harus dipilih
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="kelompok">Kelompok CAPA :</label>
        <div class="controls">
        	<select id="kategori" name="kelompok" class="span2">
            	<option value="0" selected>-Pilih Kelompok CAPA-</option>
				<option value="Dokumentasi">Dokumentasi</option>
                <option value="Alat/ Mesin/ Ruangan/ Bangunan">Alat/ Mesin/ Ruangan/ Bangunan</option>
                <option value="Bahan/ Produk">Bahan/ Produk</option>
				<option value="Kebersihan & Kerapihan">Kebersihan & Kerapihan</option>
				<option value="Sumber Daya Manusia (SDM)">Sumber Daya Manusia (SDM)</option>
				<option value="Mutu/ Quality/ Sistem">Mutu/ Quality/ Sistem</option>
				<option value="K3 dan Lingkungan">K3 dan Lingkungan</option>
				<option value="Lainnya">Lainnya</option>
				
            </select> *Harus dipilih
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pJudul">Judul CAPA/Temuan :</label>
        <div class="controls">
			<textarea name="pJudul"></textarea>
        </div>
    </div>
	 <div class="control-group">
    	<label class="control-label">Persyaratan :</label>
        <div class="controls">
			<textarea name="pSyarat"></textarea><br><br><b>(Shift+Enter untuk pindah baris)</b>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label">Kondisi saat ini :</label>
        <div class="controls">
			<textarea name="pKondisi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label">GAP Analysis :</label>
        <div class="controls">
			<textarea name="pTujuan" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
  <div class="control-group">
    	<label class="control-label">Root Cause :</label>
        <div class="controls">
			<textarea name="pRoot" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label">Tindakan Perbaikan :</label>
        <div class="controls">
			<textarea name="pCa" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
		<div class="control-group">
    	<label class="control-label">Tindakan Pencegahan :</label>
        <div class="controls">
			<textarea name="pPa" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="tgls">Tgl. Batas Waktu CAPA :</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" required="required"> *Wajib disi</div>
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
//batas dari ucapa
}elseif($_GET[act]=="tambahcapa2"){
$icid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNo) as max_no FROM ucapa WHERE dNo LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("I-%04s/$_SESSION[nppcv]/$bln", $noUrut);

$capa = mysql_fetch_array(mysql_query("SELECT * FROM icapa WHERE icid=$icid"));

?>
<form method="post" action="include/scapa/aksi_scapa.php?act=tambahcapa2&icid=<?=$icid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Improvement</legend>
	
<?php
	if($_SESSION[levelcv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal :</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
	<? } else {	 ?>
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal :</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
	<? } ?>
     
    <div class="control-group">
		<label class="control-label" for="dari">Dari/Pembuat :</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
		            echo "<select id='dari' class='chzn-select' name='dari'>";
            
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
					}else{
						echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				}
			?>
			    	</select>
					</div>
					</div>
			  <div class="control-group">
		<label class="control-label" for="kategori">Sumber Improve/CAPA :</label>
        <div class="controls">
			<?			
			 echo "<select id='kategori' class='chzn-select' name='kat_scapa'>
					<option value='0'>Pilih Sumber CAPA</option>";
            $capa1 = mysql_query("SELECT * FROM icapa");
				while ($dcapa=mysql_fetch_array($capa1)){
		    	     	echo "<option value='$dcapa[icperihal]'>$dcapa[icperihal]</option>";
				}
				?>
			</select>
					</div>
					</div>
			<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="pcapa" name="pcapa[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                            
            </select>*Bisa Pilih Grup
        </div> 
		</div>
		<?	
		}
		else {
		$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));
			echo "<input type=hidden name=dari value=$_SESSION[cv]><b>$_SESSION[namacv]</b><br>
			<input type=hidden name=dari2 value=$e[cId]>Atasan : <b>$e[cNama]</b><br>
			<input type=hidden name=pcapa value=$_SESSION[cv]>
			
			</div>
			</div>";
			?>
			 <div class="control-group">
		<label class="control-label" for="kategori">Sumber Improve/CAPA :</label>
        <div class="controls">
			<?			
			 echo "<input type=hidden name=kat_scapa value=$capa[cv]><b>$capa[icperihal]</b>";
				?>
			</select>
					</div>
					</div>
			<?
		}
			
		?>
           	
      
	<div class="control-group">
    	<label class="control-label" for="kategori">Kategori Improvement :</label>
        <div class="controls">
        	<select id="kategori" name="kategori" class="span2">
            	<option value="0" selected>-Pilih Kategori Improvement-</option>
            	<option value="Improvement (Aktual)">Saran/ Improvement (Aktual)</option>
            	<option value="Improvement (Potensial)">Saran/ Improvement (Potensial)</option>
				<option value="Improvement Lainnya">Improvement Lainnya</option>
				
            </select> *Harus dipilih
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="kelompok">Kelompok Improvement :</label>
        <div class="controls">
        	<select id="kategori" name="kelompok" class="span2">
            	<option value="0" selected>-Pilih Kelompok Improve/CAPA-</option>
				<option value="Dokumentasi">Dokumentasi</option>
                <option value="Alat/ Mesin/ Ruangan/ Bangunan">Alat/ Mesin/ Ruangan/ Bangunan</option>
                <option value="Bahan/ Produk">Bahan/ Produk</option>
				<option value="Kebersihan & Kerapihan">Kebersihan & Kerapihan</option>
				<option value="Sumber Daya Manusia (SDM)">Sumber Daya Manusia (SDM)</option>
				<option value="Mutu/ Quality/ Sistem">Mutu/ Quality/ Sistem</option>
				<option value="K3 dan Lingkungan">K3 dan Lingkungan</option>
				<option value="Lainnya">Lainnya</option>
				
            </select> *Harus dipilih
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pJudul">Judul Improvement :</label>
        <div class="controls">
			<textarea name="pJudul"></textarea>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label">Kondisi saat ini :</label>
        <div class="controls">
			<textarea name="pKondisi" class="input-large textarea" style="width: 610px; height: 100px"><i>(Info : Shift+Enter untuk pindah baris - hapus baris ini)</i><br>Tulis kondisi semula atau saat ini</textarea>
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label">Tujuan Improvement :</label>
        <div class="controls">
			<textarea name="pTujuan" class="input-large textarea" style="width: 610px; height: 100px"><i>(Info : Shift+Enter untuk pindah baris - hapus baris ini)</i><br>Tulis rencana hasil akhir improvement.<br>Tulis Efisiensi (Jumlah Pengurangan Biaya, SDM dll) & Peningkatan Produktivitas</textarea>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label">Langkah Improvement :</label>
        <div class="controls">
			<textarea name="pCa" class="input-large textarea" style="width: 610px; height: 100px"><i>(Info : Shift+Enter untuk pindah baris - hapus baris ini)</i><br>1. ...<br>2. ...</textarea>
        </div>
	
	<div class="control-group">
		<label class="control-label" for="tgls">Tgl. Batas Waktu Selesai :</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" required="required"> *Wajib disi</div>
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
}
elseif($_GET[act]=="editcapa"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ucapa WHERE icid='$_GET[id]'"));
$icid = $e['icid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNo) as max_no FROM ucapa WHERE dNo LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("C-%04s/$_SESSION[nppcv]/$bln", $noUrut);
?>
<form method="post" action="include/scapa/aksi_scapa.php?act=editcapa&icid=<?=$icid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah CAPA</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
	<div class="control-group">
		<label class="control-label" for="nocapa">Nomor capa</label>
        <div class="controls"><input class="input-medium focused" id="nocapa" type="text" name="nocapa" value="<?=$e[dNo];?>" required="required"></div>
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
		<label class="control-label" for="dari">dari</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ucapa a,users b WHERE a.dPembuat=b.cId AND a.icid='$_GET[id]'"));
			?>
					
			<select id="dari" class="chzn-select" name="dari">
            <?php
				echo "<option value=$e[dPembuat] selected>$ef[cNama]</option>";
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
		<label class="control-label" for="nocapa">Nomor CAPA</label>
        <div class="controls">
		<? echo"<input type=hidden name='nocapa' value='$e[dNo]'><b>$e[dNo]</b>";  ?>
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
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="dari">Dari</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.icid='$_GET[id]'"));	
			echo "<input type=hidden name=dari value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
            	<?php
				$sft = Array("A"=>"Rutin","B"=>"CITO","C"=>"Rahasia");
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
    	<label class="control-label" for="pcapa">CAPA Dikirim ke</label>
        <div class="controls">
        	<select multiple="multiple" id="pcapa" name="pcapa[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select> *Bisa Pilih Grup 
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instruksi/Informasi</label>
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
<!-- batas dari ucapa -->
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<1 or $_SESSION[cv]=='1'){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=scapa&act=tambah'">Tambah Sumber CAPA/Improve</button>
    <br /><br />
	<?php
	}
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr><th></th>
			<th>Tanggal</th>
			<th>Jenis CAPA</th>
			<th>Dari</th>
			<th>Kepada</th>
			<th>Perihal</th>
			<th>Tgl Dibaca</th>
            <th>Lamp.</th>
			<th>CAPA (RTL)</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM icapa a, users b WHERE a.ickepada=b.cId AND a.icstatus='N' AND a.ickepada='$_SESSION[cv]'"));
		
		$smasuk = mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM icapa a, users b WHERE a.ickepada=b.cId");	
		$s1 = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM icapa a, users b WHERE a.idari=b.cId"));	
				
		while($s = mysql_fetch_array($smasuk)) {
			
		$s2 = mysql_fetch_array(mysql_query("SELECT * FROM jeniscapa WHERE kode_jcp='$s[jeniscapa]'"));		
		if (($s[icstatus]=='N')&&($s[ickepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td></td><td>";echo tgl_indo($s[ictgl]);echo"</td>
				<td>$s2[nama_jcp]</td>
                <td>$s1[cIdjab]</td>
                <td>$s[cIdjab]</td>
                <td>$s[icperihal]</td><td>";
				if ($s[ictgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[ictgl_baca]); } 
				echo"</td>
                <td><a href='scapa/$s[icfile]'>File</a></td>";
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM ucapa WHERE icid='$s[icid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=scapa&act=tambahcapa&id=$s[icid]'>Buat CAPA</a>";
					}else{
						echo "<a href='?pages=scapa&act=editcapa&id=$s[icid]'>Tambah CAPA</i>";
					}
				
			echo "</td>";
				echo "
				<td class='center'><a href='include/scapa/aksi_scapa.php?act=hapus&id=$s[icid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=scapa&act=edit&id=$s[icid]'> <i class='icon-edit'></i><a href='home.php?pages=scapa&act=detail&id=$s[icid]' title=Detail'>Detail</a>
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Masuk ke Detail untuk Konfirmasi Telah Dibaca yang dibuat/ Info CAPA yang selesai</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->