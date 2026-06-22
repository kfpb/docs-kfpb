<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Surat Penawaran Masuk (Untuk Tela'ahan Produk/ Jasa)</div>
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
<form method="post" action="include/tuin/aksi_tuin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Surat Penawaran Masuk</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Surat Masuk</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor"> Jika lebih dari 1 surat penawaran pakai koma (,)</div>
    </div>
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"> <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM tsurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" required="required" id="pengirim" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off">
         Jika lebih dari 1 surat pakai koma (,)</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
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

    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi untuk Tela'ahan (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
        	<textarea name="ket" id="editor">
				<b>Contoh (Edit) :</b><br>
				Nama Barang/Jasa 	:<br>
				Aktiva 				:<br>
				Lokasi 				:<br>
				Nomor PR 			:<br>
				Tanggal PR 			:<br>
				Harga Total 		:<br>
				Peminta/Pemakai 	:<br>
				Keterangan			:<br>
				<i>dan lainnya jika diperlukan yang biasa di dalam form tela'ahan..</i>
				</textarea></div>
    </div>
    
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 20MB <br>(Jika ada 2 surat atau lebih, disatukan jadi 1 file PDF/ZIP)
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM tsurat WHERE iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
?>
<form method="post" action="include/tuin/aksi_tuin.php?act=edit&id=<?=$e[iid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Surat Masuk</legend>
	<div class="control-group">
		<label class="control-label" for="ns">Nomor Surat</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e[inmr];?>"></div>
    </div>
<?php
	if($_SESSION[levelcv]<2){
	?>
	
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[itgl];?>" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM tsurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" id="pengirim" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[ipengirim];?>">
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
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
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT ipengirim FROM tsurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[ipengirim]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="pengirim" class="span4" id="pengirim" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[ipengirim];?>">
        </div>
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
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[iperihal];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Surat</label>
        <div class="controls">
		<textarea name="ket" id="editor"><?=$e[iket];?></textarea>
    </div>
		<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 20MB (Jika ada 2 surat atau lebih, disatukan jadi 1 file PDF/ZIP)
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
<?
}elseif($_GET[act]=="editt"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM tdis WHERE pdid='$_GET[id]'"));
?>
<form method="post" action="include/tuin/aksi_tuin.php?act=editt&id=<?=$e[pdid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Telaahan</legend>

<div class="control-group">
    	<label class="control-label" for="urut">Urutan ke</label>
        <div class="controls">
        <input type=text class="input-small"  name=urut value='<?=$e[urut];?>'>
		</div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="ptgl">Tanggal Buat telaahan</label>
        <div class="controls"><input class="input-small datepicker" id="ptgl" type="text" name="ptgl" required="required" value='<?=$e[ptgl];?>'></div>
    </div>

    <div class="control-group">
    	<label class="control-label" for="tampil">Tampilkan?</label>
        <div class="controls">
            <? if($e[tampil]=='Y'){
            echo"    
        	<select id='tampil' name='tampil' class='chzn-select span3'>
            	<option value='N'>Belum tampil di user</option>
                <option value='Y' selected>Ya, Tampil di user</option>
            </select>";
            }
            else {
                 echo"    
        	<select id='tampil' name='tampil' class='chzn-select span3'>
            	<option value='N' selected>Belum tampil di user</option>
                <option value='Y'>Ya, Tampil di user</option>
            </select>"; 
            }
            ?>
            
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
    	<label class="control-label" for="kode_dok">Jawaban Telaahan</label>
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
    
  mysql_query("DELETE FROM tdis WHERE pdid='$_GET[id]'");
     
  echo "<script>window.alert('Telaahan Sukses di Hapus');window.location=('home.php?pages=tuin&act=detail&id=$_GET[id2]')</script>"; 
  
}elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));
$s = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a, users b WHERE a.ikepada=b.cId"));	

if ($e[istatus]=='N'){
    //$e[ikepada]==$_SESSION[cv]
$tgl_sekarang = date("Y-m-d");
//AND ikepada='$_SESSION[cv]'
mysql_query("UPDATE tsurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' ");

}
?>
<? echo"<a href='home1.php?pages=tuin&act=print&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<strong>
<legend>Detail Surat Penawaran Masuk untuk Tela'ahan</legend>
<table width="100%" border=1>
	<tr><td width="14%">Nomor Surat</td><td>: <?=$e[inmr];?></td></tr>
    <tr><td>Tanggal Surat</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[iperihal];?></td></tr>
	<tr><td>Jenis Surat</td><td>: <?=$ef[nama_jms];?></td></tr>
    <tr><td>Pengirim</td><td>: <strong><?=$e[ipengirim];?></strong></td></tr>
    <tr><td>Kepada</td><td>: <strong>Bagian Pembelian (<?=$e[cNama];?>)</strong></td></tr>
	<tr><td>Lampiran</td><td>: <a title="Lampiran" href="smasuk/<?=$e[ifile];?>">Klik Disini (Jika Ada)</td></tr>
	
	</table>
	<br></strong>
<table width="100%">
    <tr><td>Isi Surat :</td><tr>
	<tr><td><?=$e[iket];?></td></tr>
</table>

<br />
<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM tisposisi a 
									LEFT JOIN tdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN tuin d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM tisposisi WHERE dPentisposisi='$_SESSION[cv]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPtisposisi FROM tisposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi tisposisi-->
<legend>History Tela'ahan : (Disposisi atau Pendapat)</legend>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=5%>No Urut</td>
    <td width=10%>Kepada</td>
	<td width=10%>Dibaca Tgl</td> 
	<td>Jawaban/ Informasi</td>
	<td width=10%>Tgl Selesai</td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada,
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM tdis a WHERE a.iid='$_GET[id]' ORDER BY a.urut ASC");

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
				<td>$t[urut]</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$tglBaca</td>
				<td>";
				if($_SESSION[cv]==74 OR $_SESSION[cv]==83) {
				
				echo"<a href='?pages=tuin&act=editt&id=$t[pdid]' class='btn btn-info'>Edit</a><a href='?pages=tuin&act=delt&id=$t[pdid]&id2=$_GET[id]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-info'>Del</a><br>";
				}
				echo"$t[info]</td>
				<td><span class='label label-warning'>Menunggu</span><br>$tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$t[urut]</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$tglBaca</td>
							<td>";
				if($_SESSION[cv]==73 OR $_SESSION[cv]==74 OR $_SESSION[cv]==83){
				
			echo"<a href='?pages=tuin&act=editt&id=$t[pdid]' class='btn btn-info'>Edit</a><a href='?pages=tuin&act=delt&id=$t[pdid]&id2=$_GET[id]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-info'>Del</a><br>";
				}
				echo"$t[info]</td>
				<td><span class='label label-success'>Selesai</span><br>$tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi tisposisi-->
<?php	
}
?>

<?php
//batas dari tisposisi.php
}elseif($_GET[act]=="tambahdisp"){
	$iid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM tisposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("T-%04s/$_SESSION[nppcv]/$bln", $noUrut);


?>
<form method="post" action="include/tuin/aksi_tuin.php?act=tambahdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Tela'ahan</legend>
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
		<label class="control-label" for="tgls">Target Tanggal Selesai (Jika ada)</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pentisposisi">Pembuat Tela'ahan</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
		            echo "<select id='pentisposisi' class='chzn-select' name='pentisposisi'>";
            
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

			echo "<input type=hidden name=pentisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
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
                <option value="B">Cito</option>
                <option value="C">Rahasia</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="urut">Urutan</label>
        <div class="controls">
        	<select id="urut" name="urut" class="span2">
            	<option value="1" selected>Ke-1</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="tdis" name="tdis[]" class="chzn-select span4">
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
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
	<div class="controls">
        	<textarea name="isi" id="editor">
			Tulis perihal surat penawaran produk/jasa tentang apa disini!<br><b>Misal :</b> Tela'ahan Laptop, peminta : ....</textarea>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM tisposisi WHERE iid='$_GET[id]'"));
$iid = $e['iid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM tisposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("T-%04s/$_SESSION[nppcv]/$bln", $noUrut);
?>
<form method="post" action="include/tuin/aksi_tuin.php?act=editdisp&iid=<?=$iid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Tela'ahan</legend>
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
		<label class="control-label" for="pentisposisi">Pembuat Tela'ahan</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tisposisi a,users b WHERE a.dpentisposisi=b.cId AND a.iid='$_GET[id]'"));
			?>
					
			<select id="pentisposisi" class="chzn-select" name="pentisposisi">
            <?php
				echo "<option value=$e[dpentisposisi] selected>$ef[cNama]</option>";
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
		<label class="control-label" for="pentisposisi">Pendisposisi</label>
        <div class="controls">
	<?
			
			echo "<input type=hidden name=pentisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
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
    	<label class="control-label" for="urut"><b>Urutan</b></label>
        <div class="controls">
        	<select id="urut" name="urut" class="span2">
        	    <option>Pilih urutan</option>
        	    <option value="1">Ke-1</option>
                <option value="2">Ke-2</option>
                <option value="3">Ke-3</option>
				<option value="4">Ke-4</option>
				<option value="5">Ke-5</option>
				<option value="6">Ke-6</option>
				<option value="7">Ke-7</option>
            </select> *Wajib dipilih dengan benar!
		</div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="tdis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="tdis" name="tdis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instruksi/Informasi</label>
       <div class="controls">
        	<textarea name="isi" id="editor" style="width: 610px; height: 100px">
			Tulis perihal surat penawaran produk/jasa tentang apa disini!<br><b>Misal :</b> Tela'ahan Laptop, peminta : ....</textarea>
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
<!-- batas dari tisposisi.php -->
<?php
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<2){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=tuin&act=tambah'">Tambah Surat Masuk untuk Tela'ahan</button>
    <br /><br />
	<?php
	}
	?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>Tela'ahan</th>
			<th>Detail</th>
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
		$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM tsurat a, users b WHERE a.ikepada=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
		
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM tsurat a, users b WHERE a.ikepada=b.cId");	
				
		while($s = mysql_fetch_array($smasuk)) {
		if (($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM tisposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a href='?pages=tuin&act=tambahdisp&id=$s[iid]'>Buat Telaahan</a>";
					}else{
						echo "<a href='?pages=tuin&act=editdisp&id=$s[iid]'>Edit/Tambah Telaahan</i>";
					}
				
			echo "</td>";
			echo "<td><a href='home.php?pages=tuin&act=detail&id=$s[iid]' title=Detail'>$s[inmr]</a></td>
                <td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[ipengirim]</td>
                <td>$s[cNama]</td>
                <td>$s[iperihal]</td><td>";
				if ($s[itgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_baca]); } 
				echo"</td>
				<td>";
				if ($s[itgl_balas]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_balas]) ; } 
				echo"</td>	
                <td><a href='smasuk/$s[ifile]' target='_blank'>Lamp. Surat</a></td>";
				echo "
				<td class='center'><a href='include/tuin/aksi_tuin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=tuin&act=edit&id=$s[iid]'> <i class='icon-edit'></i></a>
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Masuk ke Detail untuk Konfirmasi Telah Dibaca Surat yang dibuat/ Jawaban Info Tela'ahan</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->