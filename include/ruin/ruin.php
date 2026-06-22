<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Sumber Reminder (Jenis-Lokasi-Waktu)</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");
$tgl			 = date("d-m-y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/ruin/aksi_ruin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Sumber (Jenis-Lokasi-Waktu) Reminder</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Ditujukan Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            	<option>Pilih Tujuan</option>
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
    	<label class="control-label" for="kepada">Pembuat</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            	<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
			
		</select>";
         ?> 
           	</select>
        </div> 
    </div>
	
	<? } ?>	
	<div class="control-group">
    	<label class="control-label" for="perihal">Perihal Sumber</label>
        <div class="controls">
          	 <select id="jenisrm" class="chzn-select span4" name="perihal" required="required">
            	<option value=0>Pilih/Cari Sumber Reminder-Lokasi</option>
	    	    <option value='izin-Banjaran'>Perizinan Banjaran</option>
			    <option value='izin-banjaran'>Perizinan Banjaran</option>
				<option value='sertifikat-Banjaran'>Sertifikat Banjaran</option>
				<option value='sertifikat-banjaran'>Sertifikat Banjaran</option>
				<option value='pelatihan'>Pelatihan</option>
				<option value='lainnya-Banjaran'>Lainnya Banjaran</option>
				<option value='lainnya-banjaran'>Lainnya Banjaran</option>
				
           	</select>
        </div> 
	</div>
    <div class="control-group">
    	<label class="control-label" for="ket">Keterangan Reminder (Tekan Shift+Enter untuk pindah baris)</label>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM remind WHERE iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM remind a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
?>
<form method="post" action="include/ruin/aksi_ruin.php?act=edit&id=<?=$e[iid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Sumber Reminder</legend>
<?php
	if($_SESSION[levelcv]<2){
	?>
	
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[itgl];?>" required="required"></div>
    </div>

	<div class="control-group">
    	<label class="control-label" for="kepada">Ditujukan Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            <?php
				echo "<option value=$e[ikepada] selected>$ef[cNama]</option>";
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
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[itgl];?>"><? echo tgl_indo($e[itgl]); ?></div>
    </div>

	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
            <select id="kepada" class="chzn-select" name="kepada">
            <?php
				echo "<option value=$e[ikepada] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				
			?>
           	</select>
        </div> 
    </div>
<? } ?>
	
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Perihal Sumber</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span3" name="perihal" required="required">
            	<option>Pilih/Cari Sumber Reminder</option>
				
            <?php
				echo"<option value='$e[iperihal]' selected>$e[iperihal]</option>
	    	    <option value='izin-Banjaran'>Perizinan Banjaran</option>
			    <option value='izin-banjaran'>Perizinan Banjaran</option>
				<option value='sertifikat-Banjaran'>Sertifikat Banjaran</option>
				<option value='sertifikat-banjaran'>Sertifikat Banjaran</option>	
				<option value='pelatihan'>Pelatihan</option>
				<option value='lainnya-Banjaran'>Lainnya Banjaran</option>
				<option value='lainnya-banjaran'>Lainnya Banjaran</option>";
				
			?>
           	</select>
        </div> 
	</div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Keterangan Sumber Reminder (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
		<textarea name="ket" id="editor"><?=$e[iket];?></textarea>
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

}elseif($_GET[act]=="editt"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM premind WHERE pdid='$_GET[id]'"));
?>
<form method="post" action="include/ruin/aksi_ruin.php?act=editt&id=<?=$e[pdid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Reminder</legend>
    
    <div class="control-group">
		<label class="control-label" for="ptgl">Tanggal Buat Reminder</label>
        <div class="controls"><input class="input-small datepicker" id="ptgl" type="text" name="ptgl" required="required" value='<?=$e[ptgl];?>'></div>
    </div>

    <div class="control-group">
		<label class="control-label" for="ptglm">Tanggal Mulai Masa Berlaku</label>
        <div class="controls"><input class="input-small datepicker" id="ptglm" type="text" name="ptglm" required="required" value='<?=$e[ptglm];?>'></div>
    </div>
    
    
    <div class="control-group">
		<label class="control-label" for="ptgls">Tanggal Selesai Masa Berlaku</label>
        <div class="controls"><input class="input-small datepicker" id="ptgls" type="text" name="ptgls" required="required" value='<?=$e[ptgls];?>'></div>
    </div>

    
    <div class="control-group">
    	<label class="control-label" for="judul">Judul Reminder</label>
        <div class="controls">
        <input type=text name="judul" value="<?=$e[pJudul];?>">
		</div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="ket">Keterangan/Persyaratan</label>
        <div class="controls">
        <textarea name="instruksi" id="editor"><?=$e[pInstruksi];?></textarea>
		</div>
    </div>
    
    
         <div class="control-group">
		<label class="control-label" for="tglbaca">Tgl dibaca</label>
        <div class="controls"><input  id="tglbaca"  class="input-small" type="text" name="tglbaca" value='<?=$e[psTglbaca];?>'>tulis 0000-00-00 jika akan hapus tgl</div>
    </div>
   <div class="control-group">
		<label class="control-label" for="tglslesai">Tgl Selesai Dijawab</label>
        <div class="controls"><input id="tglslesai"   class="input-small" type="text" name="tglslesai" value='<?=$e[psTglselesai];?>'>tulis 0000-00-00 jika akan hapus tgl</div>
    </div>
    
    
    <div class="control-group">
    	<label class="control-label" for="kode">Selesai Dijawab ?</label>
        <div class="controls">
            <? if($e[psACC]=='Y'){
            echo"    
        	<select id='acc' name='acc' class='chzn-select span3'>
            	<option value='N'>Belum</option>
                <option value='Y' selected>Ya, sudah jawab</option>
            </select>";
            }
            else {
                 echo"    
        	<select id='kode' name='acc' class='chzn-select span3'>
            	<option value='N' selected>Belum</option>
                <option value='Y'>Ya, sudah jawab</option>
            </select>"; 
            }
            ?>
            
		</div>
    </div>
    
      <div class="control-group">
    	<label class="control-label" for="info">Jawaban Reminder</label>
        <div class="controls">
        <textarea name="info" id="editor"><?=$e[info];?></textarea>
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
<?

}elseif($_GET[act]=="delt"){
    
  mysql_query("DELETE FROM premind WHERE pdid='$_GET[id]'");
     
  echo "<script>window.alert('Reminder Sukses di Hapus');window.location=('home.php?pages=ruin&act=detail&id=$_GET[id2]')</script>"; 
  

}elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM remind a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));

if ($e[ikepada]==$_SESSION[cv]){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE remind SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");

}
?>
<? 
/*
echo"<a href='home1.php?pages=ruin&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";
*/
?>
<strong>
<legend>Detail Sumber Reminder</legend></strong>
<table width="100%" border=1>
    <tr><td width="14%">Tanggal Buat</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Perihal Sumber </td><td>: <?=$e[iperihal];?></td></tr>
    <tr><td>Pembuat Sumber</td><td>: <strong><?=$e[cNama];?></strong></td></tr>
	<tr><td>Lampiran Sumber</td><td>: <a title="Lampiran" href="smasuk/<?=$e[ifile];?>">Klik Disini</a> (Jika Ada)</td></tr>
	
	</table>
	<br>
<table width="100%">
    <tr><td>Isi Sumber Pengingat/Reminder :</td><tr>
	<tr><td><?=$e[iket];?></td></tr>
</table>

<br />
<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM reminder2 a 
									LEFT JOIN premind b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN remind d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM reminder2 WHERE dPendisposisi='$_SESSION[cv]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM reminder2 a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi disposisi-->
<legend>History Reminder untuk ditindaklanjuti :</legend>
<?
echo"<b><u>Lampiran Reminder : <a href='disposisi/$edf[disfile]'>klik disini (jika ada)</a></b></u>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl </b></td>
    <td width=10%><b>Kepada (PIC)</b></td>
	<td><b>Kategori-Jenis-Nama-Keterangan</b></td>
	<td><b>Jawab/hasil/verifikasi</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM premind a WHERE a.iid='$_GET[id]' AND a.pId='$_SESSION[cv]' OR a.iid='$_GET[id]' AND a.cId='$_SESSION[cv]' ORDER BY a.pdid DESC");

while ($t=mysql_fetch_array($pds)){
    $sft = Array("A"=>"Bangunan","B"=>"Mesin","C"=>"Fasilitas","D"=>"K3L","E"=>"SDM","F"=>"UMUM","G"=>"PELATIHAN" );
    $sifat =$t[pSifat];
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptglm]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td><b>Berlaku Mulai:</b><br>$tglDis<br><b>Berlaku Slesai:</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])
				<br><a href='?pages=ruin&act=editt&id=$t[pdid]'>.</a><br><a href='?pages=ruin&act=delt&id=$t[pdid]&id2=$_GET[id]' onClick=\"return confirm('Yakin ingin menghapus??')\">..</a><br>
				
				</td>
				<td>[$sft[$sifat]] $t[pJudul] <br> $t[pInstruksi] </td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td><b>Berlaku Mulai:</b><br>$tglDis<br><b>Berlaku Slesai:</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])
				<br><a href='?pages=ruin&act=editt&id=$t[pdid]'>.</a><br><a href='?pages=ruin&act=delt&id=$t[pdid]&id2=$_GET[id]' onClick=\"return confirm('Yakin ingin menghapus??')\">..</a><br>

				</td>
				<td>[$sft[$sifat]] $t[pJudul] <br> $t[pInstruksi] </td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi disposisi-->
<?php	
}
?>

<?php
//batas dari disposisi.php
}elseif($_GET[act]=="tambahdisp"){
	$iid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM reminder2 WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("R-%04s/$_SESSION[nppcv]/$bln", $noUrut);


?>
<form method="post" action="include/ruin/aksi_ruin.php?act=tambahdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<?php echo"<input type=hidden name=tgl value=$tgl1>"; ?>
<legend>Buat Reminder</legend>
    <input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required">
    <div class="control-group">
		<label class="control-label" for="tglm">Masa Berlaku Mulai</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgls">Masa Berlaku Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat Reminder</label>
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

			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Jenis Reminder</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span5">
            	<option value="A">Bangunan</option>
                <option value="B">Mesin</option>
                <option value="C">Fasilitas</option>
                <option value="D">K3L</option>
                <option value="E">SDM</option>
                <option value="F">Umum</option>
                <option value="G">Pelatihan</option>
            </select>
		</div>
    </div>
    <input type=hidden name="jawab" value="Y">

	<div class="control-group">
    	<label class="control-label" for="isi">Kepada (PIC)</label>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>*Pilih satu-satu atau semua<br>
	<button type='button' class='chosen-toggle select'>Pilih Semua</button>
     <button type='button' class='chosen-toggle deselect'>Hapus Semua</button>
		    	     	
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="judul">Jenis Perizinan/ Sertifikasi/ Pelatihan/ Umum Lainnya</label>
        <div class="controls">
			<input type=text name="judul" required="required">
        </div>
	</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Keterangan/ Persyaratan</label>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE iid='$_GET[id]'"));
$iid = $e['iid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM reminder2 WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("R-%04s/$_SESSION[nppcv]/$bln", $noUrut);
?>
    
<form method="post" action="include/ruin/aksi_ruin.php?act=tambahdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<?php echo"<input type=hidden name=tgl value=$tgl1>"; ?>
<legend>Tambah Reminder</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Reminder</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tglm">Masa Berlaku Mulai</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgls">Masa Berlaku Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pembuat Reminder</label>
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

			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Jenis Reminder</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span5">
            	<option value="A">Bangunan</option>
                <option value="B">Mesin</option>
                <option value="C">Fasilitas</option>
                <option value="D">K3L</option>
                <option value="E">SDM</option>
                <option value="F">UMUM</option>
                <option value="G">Pelatihan</option>
            </select>
		</div>
    </div>
     <input type=hidden name="jawab" value="Y">
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada (PIC)</label>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>*Pilih satu-satu atau semua<br>
	<button type='button' class='chosen-toggle select'>Pilih Semua</button>
     <button type='button' class='chosen-toggle deselect'>Hapus Semua</button>
		    	     	
        </div> 
		</div>
   <div class="control-group">
    	<label class="control-label" for="judul">Jenis Perizinan/ Sertifikasi/ Pelatihan/ Umum Lainnya</label>
        <div class="controls">
			<input type=text name="judul" required="required">
        </div>
	</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Keterangan</label>
        <div class="controls">
			<input type=text name="isi">
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
<!-- batas -->
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<2){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=ruin&act=tambah'">Buat Pengingat/Reminder</button>
    <br /><br />
	<?php
	}
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>Reminder</th>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>Pengirim</th>
			<th>Kepada</th>
			<th>Perihal</th>
			<th>Tgl Dibaca</th>
			<th>Tgl Balasan</th>
            <th>Lampiran</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM remind a, users b WHERE a.ikepada=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
		
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM remind a, users b WHERE a.ikepada=b.cId");	
				
		while($s = mysql_fetch_array($smasuk)) {
		if (($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM reminder2 WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=ruin&act=tambahdisp&id=$s[iid]'>Buat</a>";
					}else{
						echo "<a href='?pages=ruin&act=editdisp&id=$s[iid]'>Tambah</i>";
					}
				
			echo "</td>";
			echo "<td><a href='home.php?pages=ruin&act=detail&id=$s[iid]' title=Detail'>$s[inmr]</a></td>
                <td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>SPD-MR</td>
                <td>$s[cNama]</td>
                <td>$s[iperihal]</td><td>";
				if ($s[itgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_baca]); } 
				echo"</td>
				<td>";
				if ($s[itgl_balas]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_balas]) ; } 
				echo"</td>	
                <td><a href='smasuk/$s[ifile]'>Lampiran</a></td>";
				echo "
				<td class='center'><a href='include/ruin/aksi_ruin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=ruin&act=edit&id=$s[iid]'> <i class='icon-edit'></i><a href='?pages=sout&act=tambah&id=$s[iid]'><i class='icon-arrow-right'></i>
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Masuk ke Detail untuk Konfirmasi Telah Dibaca sumber reminder yang dibuat/ Jawaban hasil reminder</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->