<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Buat Sosialisasi Dokumen MK3L</div>
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

$query = "SELECT max(dinmr) as max_no FROM dointer WHERE dinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("SD-%04s/$bln", $noUrut);

?>
<form method="post" action="include/dointer/aksi_dointer.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Sosialisasi Dokumen MK3L</legend>
<?
if($_SESSION[levelcv]==0){
?>
  <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" >
            	<option>Pilih User</option>
            	<?php
					$cv = mysql_query("SELECT cId, cNama FROM users");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				?>
           	</select>
        </div> 
    </div>
<?
}
else
{
?>	
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
    
    	<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>"
		;
         ?> 
        </div> 
    </div>
<?    
    }
?>

	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span3" name="jenisdok" required="required">
             	<option>Pilih/Cari Jenis Dokumen</option>
                <option value='Manual'>Manual</option>
                <option value='Prosedur'>Prosedur</option>
                <option value='Instruksi Kerja'>Instruksi Kerja</option>
                <option value='Lainnya'>Lainnya</option>
           	</select>
        </div> 
	</div>
	  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi1" type="text" name="revisi" required="required"> Tulis 0,1,2.. jangan 00,01..</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Berlaku</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_brlk" required="required"></div>
    </div>

    <div class="control-group">
    	<label class="control-label" for="ket">Info Sosialisasi Dokumen <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
        	<textarea name="ket" id="editor">
			
			</textarea>
			</div>
        </div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Upload dokumen</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM dointer WHERE suid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
?>
<form method="post" action="include/dointer/aksi_dointer.php?act=edit&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Sosialisasi Dokumen MK3L</legend>
	<?
if($_SESSION[levelcv]<1){
?>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[ditgl];?>" required="required"></div>
    </div>

<?
}
else
{
?>	
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[ditgl];?>" required="required"><? echo tgl_indo($e[ditgl]); ?></div>
    </div>
<?
}
?>
<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">	
         <?  echo "<b>$_SESSION[namacv]</b>";  ?> 
        </div> 
    </div>
<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span6" name="jenisdok" required="required">
            	<option>Pilih/Cari Jenis Dokumen</option>
				<option value='<?=$e[jenisdok];?>' selected><?=$e[jenisdok];?></option>
                <option value='Manual'>Manual</option>
                <option value='Prosedur'>Prosedur</option>
                <option value='Instruksi Kerja'>Instruksi Kerja</option>
                <option value='Lainnya'>Lainnya</option>
           	</select>
        </div> 
	</div>
     <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required" value="<?=$e[dikodok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi" required="required" value="<?=$e[direv];?>"></div>
    </div>

    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required" value="<?=$e[dijudok];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Berlaku</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_brlk" required="required" value="<?=$e[ditgl_brlk];?>" ></div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Info Sosialisasi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><?=$e[diket];?></textarea>
        </div>
    </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran File</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload">
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
}elseif($_GET[act]=="tambah2"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
?>
<form method="post" action="include/dointer/aksi_dointer.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Sosialisasi Dokumen MK3L</legend>
	
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="" required="required"></div>
    </div>

	<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='49' selected>SPD-MR</option>
		</select>"
		;
         ?> 
        </div> 
    </div>

<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span6" name="jenisdok" required="required">
            	<option>Pilih/Cari Jenis Dokumen</option>
                <option value='Manual'>Manual</option>
                <option value='Prosedur'>Prosedur</option>
                <option value='Instruksi Kerja'>Instruksi Kerja</option>
                <option value='Lainnya'>Lainnya</option>
           	</select>
        </div> 
	</div>
     <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required" value="<?=$e[kode_dok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi" required="required" value=""></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required" value="<?=$e[judul_dok];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Berlaku</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_brlk" required="required" value="<?=$e[tgl_berlaku];?>" ></div>
    </div>
	
      <div class="control-group">
    	<label class="control-label" for="ket">Info Sosialisasi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
        	<textarea name="ket" id="editor">

			</textarea>
			</div>
        </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Upload Dokumen</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload">
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
}elseif($_GET[act]=="lp"){
?>


<form method="post" action="include/dointer/aksi_dointer.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>List Penerima Sosialisasi Dokumen</legend>
	<div class="control-group">
    	<label class="control-label" for="psin">Penerima</label>
        <div class="controls">
        	<select multiple="multiple" id="dosin" name="dosin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian FROM users WHERE level='' AND cId IN(SELECT cId FROM dosin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[bagian] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian FROM users WHERE level='' AND cId NOT IN(SELECT cId FROM dosin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
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

<? if($_SESSION[levelcv]==0){
    ?>

<form method="post" action="include/sinter/aksi_sinter.php?act=lpadmin&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah List Penerima Sosialisasi Dokumen MK3L (hapus dulu yang ada)</legend>
	<div class="control-group">
    	<label class="control-label" for="dosin">Penerima </label>
        <div class="controls">
        	<select multiple="multiple" id="dosin" name="psin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian FROM users WHERE cId IN(SELECT cId FROM dosin WHERE suid='$_GET[id]')  AND level==''");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[bagian] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian FROM users WHERE cId NOT IN(SELECT cId FROM dosin WHERE suid='$_GET[id]')  AND level==''");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
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
<? } ?>
	
<br>
<?
}elseif($_GET[act]=="selesai"){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE dointer SET ditgl_slesai = '$tgl'
										WHERE suid = '$_GET[id]'");
							   
							   
 if ($q){
	 echo "<script>window.alert('Tgl Selesai Sosialisasi telah di input');window.location=('../home.php?pages=dointer')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
?>
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));
    $dok = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$e[dikodok]'");
    $r    = mysql_fetch_array($dok);
	?>
<strong>
<legend>Detail Sosialisasi Dokumen MK3L</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[dinmr];?></td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$e[cNama];?> (<?=$e[cIdjab];?>)</strong></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[ditgl]);?></td></tr>
    <tr><td>Jenis Dokumen</td><td>: <?=$e[jenisdok];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Revisi</td><td>: <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
	<tr><td>Tanggal Berlaku </td><td>: <?=tgl_indo($e[ditgl_brlk]);?></td></tr>
	<tr><td>File Dokumen PDF</td><td>: <a title="Lampiran" href="sosialisasidok/<?=$e[difile];?>">Klik Disini</a></td></tr>
	<tr><td>Status</td><td>: <strong>
<?
if ($e[distatus]=='N')
{
	echo"Belum Terkirim";
}
else
{
	echo"Terkirim";
}
?>
	</strong></td></tr>
	</table>
	<br></strong>
	<table>
    <tr><td align=top><b>Informasi Sosialisasi :</b></td><td></td></tr><tr><td><?=$e[diket];?></td></tr>
</table>
<iframe src="sosialisasidok/<?=$e[difile];?>" width=100% height=1000></iframe>
<br />
<legend>Distribusi Ke :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<td>Nama/Jabatan</td>
	<td>Tanggal Selesai Dibaca</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cFoto,b.tgl_baca FROM users a
						LEFT JOIN dosin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM dosin WHERE suid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		echo "<tr>
				<td>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama] ($t[cIdjab])
				</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo $t[tgl_baca]; };echo"</td>
			 </tr>";
	}
	?>
</table>
<br />
<big>Jumlah Penerima : <?=$j-1;?> Orang</big>

<br><br>
<? echo"<a href='home1.php?pages=dointer1&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak</a>";
echo"";
?>
<?
}else{
?>

<div class="span12">
	<?php
	//if($_SESSION[levelcv]==0 OR $_SESSION[cv]==49) {
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=dointer&act=tambah'">Buat Sosialisasi Dokumen MK3L</button><br /><br />
	<?php
//	}
	?>

	<?php
	if($_SESSION[levelcv]==0 OR $_SESSION[cv]==60){
		$dist = mysql_query("SELECT a.*, b.cNama FROM dointer a, users b WHERE a.dipengirim=b.cId ORDER BY ditgl DESC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th></th>
			<th>Tanggal</th>
			<th>Kode</th>
			<th>Rev</th>
			<th>Judul</th>
            <th>Penerima</th>
			<th>Status</th>
            <th class='center' width=17%>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		while($s = mysql_fetch_array($dist)) {
		if ($s[distatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"
				<td>$s[distatus]</td>
				<td>";echo tgl_indo($s[ditgl]);echo"</td>
                <td>$s[dikodok]</td>
				<td>$s[direv]</td>
				<td>$s[dijudok]</td>
				<td><a href='?pages=dointer&act=lp&id=$s[suid]' class='btn btn-info'>List</a></td>
                ";
                //<td><a href='sosialisasidok/$s[difile]'class='btn btn-info'>File</a></td>
				if ($s[distatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>Terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/dointer/aksi_dointer.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=dointer&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=dointer&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'> D</a>
				<a href='home.php?pages=dointer&act=selesai&id=$s[suid]' title=Selesai' class='btn btn-info'> S</a>
				</td>
				</tr>";	
		}
	}
	else {
	$dist = mysql_query("SELECT * FROM dointer WHERE dipengirim=$_SESSION[cv] ORDER BY ditgl DESC");
     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
		<tr>
			<th></th>
			<th width=12%>Tanggal</th>
			<th width=12%>Kode</th>
			<th width=3%>Rev</th>
			<th>Judul</th>
            <th width=10%>Penerima</th>
			<th width=10%>Status</th>
            <th class='center' width=17%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($dist)) {
			if ($s[distatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo "  <td>$s[distatus]</td><td>";echo tgl_indo1($s[ditgl]);echo"</td>
                <td>$s[dikodok]</td>
				<td>$s[direv]</td>
				<td>$s[dijudok]</td>";
				$cv = mysql_num_rows(mysql_query("SELECT * FROM dosin WHERE suid='$s[suid]'"));
				if ($cv==0 OR $s[distatus]=='N'){
				echo"<td><a href='?pages=dointer&act=lp&id=$s[suid]' class='btn btn-info'>Pilih</a></td>";
				}
				else 
				{
				echo"<td><b>Terpilih</b></td>";  
				}
				
                //echo"<td><a href='sosialisasidok/$s[difile]' class='btn btn-info'>File</a></td>";
				if ($s[distatus]=='N'){
					if ($s[dipengirim]==$_SESSION[cv])
					{
			echo "<td><a href='include/dointer/aksi_dointer.php?act=acc&id=$s[suid]' onClick=\"return confirm('Yakin akan kirim sosialisasi dokumen ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/dointer/aksi_dointer.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=dointer&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=dointer&act=detail&id=$s[suid]' class='btn btn-info'>Detail</a>
				</td>";
					}
						else {
			echo "<td>
			<b>Belum ACC/Kirim</b>
			     </td>";
						}
	
					}
			
				else{
			echo "<td><b>Terkirim</b></td>";
							echo "
				<td class='center'>
				<a href='home.php?pages=dointer&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'> Detail</a>
				</td>
				</tr>";	
	}
	}
	}
	?>
	</tbody>
</table>

<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>SOSIALISASI BELUM ACC & TERKIRIM KE PENERIMA SOSIALISASI !</u>,<br>
	(D) = Detail dan Print Lembar Sosialisasi, klik tombol D<br>
	(S) = Sosialisasi selesai dilakukan, klik tombol S
	</h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->