<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Daftar Induk Dokumen Eksternal</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="tambah"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dikodok) as max_no FROM dester WHERE dikodok LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("DE-%04s/$bln", $noUrut);

?>
<form method="post" action="include/dester/aksi_dester.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Dokumen Eksternal</legend>

    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="penerbit">Penerbit/Pengarang</label>
        <div class="controls"><input class="input-xxlarge focused" id="penerbit" type="text" name="penerbit" required="required"></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tahun">Tahun Terbit Dokumen</label>
        <div class="controls"><input class="input-small focused" id="tahun" type="text" name="tahun" required="required"> Contoh : 2019</div>
    </div>
   <div class="control-group">
    	<label class="control-label" for="jenis">Jenis Dok. Eksternal</label>
        <div class="controls">
            <select id="tahun" class="chzn-select span4" name="jenis" >
            	<option value='' selected>Pilih Jenis Dokumen</option>
            	<option value='soft'>Soft Copy</option>
            	<option value='hard'>Hard Copy</option>
           	</select>
        </div> 
    </div>
     <div class="control-group">
    	<label class="control-label" for="lokasi">Lokasi Dokumen</label>
        <div class="controls">
            <select id="lokasi" class="chzn-select span8" name="lokasi" >
            	<option>Pilih/Cari Lokasi Dokumen Eksternal</option>
            	<?php
					$cv = mysql_query("SELECT cId, cNama FROM users ORDER by cNama ASC");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				?>
           	</select>
        </div> 
    </div>
      <div class="control-group">
		<label class="control-label" for="keterangan">Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="keterangan"></div>
    </div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Upload dokumen</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>(jika terdapat 2 file atau lebih, di zip terlebih dahulu)
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
<br><br><br><br><br><br><br>

<?php
}elseif($_GET['act']=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dester WHERE suid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dester a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
?>
<form method="post" action="include/dester/aksi_dester.php?act=edit&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Dokumen</legend>
<input type=hidden name=difile1 value='<?=$e[difile];?>'>
<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span6" name="jenis" required="required">
            	<option>Pilih/Cari Jenis Dokumen</option>
				
            <?php
            if ($e[jenis]=="soft"){
                echo"<option value='soft' selected>Soft Copy</option><option value='hard'>Hard Copy</option>";
            }
            else {
                  echo"<option value='hard' selected>Hard Copy</option><option value='hard'>Hard Copy</option>";
            }
		
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Lokasi Dokumen</label>
        <div class="controls">
          	 <select id="lokasi" class="chzn-select span6" name="lokasi" required="required">
            	<option>Pilih/Cari Tempat Lokasi Dokumen</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[lokasi]'"));
				echo"<option value='$e[dipjdok]' selected>$v[cNama]</option>";
				$vc = mysql_query("SELECT cId, cNama FROM users ORDER BY cNama ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required" value="<?=$e[dijudok];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="penerbit">Penerbit/ Pengarang</label>
        <div class="controls"><input class="input-xxlarge focused" id="penerbit" type="text" name="penerbit" required="required" value="<?=$e[penerbit];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tahun">Tahun</label>
        <div class="controls"><input class="input-small focused" id="tahun" type="text" name="tahun" required="required" value="<?=$e[tahun];?>"></div>
    </div>

        <div class="control-group">
		<label class="control-label" for="keterangan">Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="penerbit" type="text" name="keterangan" required="required" value="<?=$e[keterangan];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="status">Status</label>
        <div class="controls">
          	 <select id="status" class="chzn-select span3" name="status">
            <?php
		    if ($e[distatus]=='Y')
            { echo"<option value='Y' selected>Terkirim</option><option value='N'>Belum terkirim</option>"; }
            else 
            { echo"<option value='N' selected>Belum terkirim</option><option value='Y'>Terkirim</option>"; }
			?>
           	</select>
        </div> 
	</div>
    
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Ganti File Dokumen</label>
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
}elseif($_GET['act']=="lp"){
?>



<fieldset>
<legend>List Penerima Dokumen</legend>

		 <br><form method="post" action="include/dester/aksi_dester.php?act=lp1&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
			 <label class="control-label" for="desin">Data Semua Penerima Dokumen :</label>
			  <div class="controls">
			<select multiple="multiple" id="desin" name="desin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM desin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] - $dcv[cJabatan]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM desin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] - $dcv[cJabatan]</option>";
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
<br>
<br>
<br><br><br><br><br><br><br>

        </div>
    </div>
	
	
	<br><b>Keterangan :</b><br>
	Jika akan mencari/memilih grup bagian, ketik untuk membantu pencarian :<br>
	- <b>SPI</b> (Grup Divisi Satuan Pengawas Intern)<br>
	- <b>TMO</b> (Grup Divisi Transformation Office)<br>
	- <b>NPD</b> (Grup Divisi Riset & Pengembangan Produk)<br>
	- <b>MNF</b> (Grup Divisi Manufaktur)<br>
	- <b>PRO</b> (Grup Divisi Procurement)<br>
	- <b>SCM</b> (Grup Divisi Supply Chain)<br>
	- <b>MKT</b> (Grup Divisi Marketing & Sales)<br>
	- <b>KEU</b> (Grup Divisi Keuangan)<br>
	- <b>TIK</b> (Grup Divisi Teknologi Informasi)<br>
	- <b>CSC</b> (Grup Divisi Sekretaris Perusahaan)<br>
	- <b>MKTSC</b> (Grup Divisi Marketing Sales CHP & Kosmetik)<br>
	- <b>PRP</b> (Grup Divisi Property)<br>
	- <b>HCP</b> (Grup Divisi Human Capital)<br>
	- <b>BSD</b> (Grup Divisi Pengembangan Bisnis)<br>

<br>
<?
}elseif($_GET['act']=="lengkap"){
?>
<div class="span12">
<center><strong><h4>DAFTAR INDUK DOKUMEN</h4></strong></center>
	<?php
	$dist = mysql_query("SELECT * FROM dester ORDER BY dikodok ASC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr><th>No</th>
		    <th>Lvl.Dok.</th>
			<th>Kode Dok.</th>
			<th>Judul Dokumen</th>
            <th width=9%>Tgl Revisi 0</th>
            <th width=9%>Tgl Revisi 1</th>
            <th width=9%>Tgl Revisi 2</th>
            <th width=9%>Tgl Review 1</th>
            <th width=9%>Tgl Review 2</th>
            <th width=9%>Tgl Review 3</th>
            <th>Ket.</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		$no=1;
		while($s = mysql_fetch_array($dist)) {
        $tgl_rev0=tgl_indo($s[ditgl_rev0]);
        $tgl_rev1=tgl_indo($s[ditgl_rev1]);
        $tgl_rev2=tgl_indo($s[ditgl_rev2]);
        $tgl_review1=tgl_indo($s[ditgl_review1]);
        $tgl_review2=tgl_indo($s[ditgl_review2]);
        $tgl_review3=tgl_indo($s[ditgl_review3]);
        
        
		echo"   <tr>
		        <td>$no</td>
		        <td>$s[jenisdok]</td>
                <td>$s[dikodok]</td>
				<td>$s[dijudok]</td>
				<td>$tgl_rev0</td>
				<td>$tgl_rev1</td>
				<td>$tgl_rev2</td>
				<td>$tgl_review1</td>
				<td>$tgl_review2</td>
				<td>$tgl_review3</td>
				<td>$s[jenis]- <a title='File Dokumen' href='fdok/index1.php?id=$e[suid]' target='_blank'>File </a></td>
				</tr>";	
		$no++;
		}

	?>
	</tbody>
</table>

<br><br>
<span class="label label-info">
<strong>Keterangan :</strong><br>
Dokumen Level 1 : Manual Mutu<br>
Dokumen Level 2 : Prosedur<br>
Dokumen Level 3 : Instruksi Kerja<br>
Dokumen Level 4 : Catatan/Dokumen Mutu<br>
</div>
</div>



<?php
}elseif($_GET['act']=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dester a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dester a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));
    $dok = mysql_query("SELECT * FROM dester WHERE suid='$e[dikodok]'");
    $r    = mysql_fetch_array($dok);
    $pjdok = mysql_query("SELECT * FROM users WHERE cId='$e[lokasi]'");
    $t    = mysql_fetch_array($pjdok);
	?>
<strong>
<legend>Detail Dokumen Eksternal</legend>
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
	<br></strong>

<br />
<legend>Penerima Dokumen Eksternal :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<td>Nama</td>
	<td>Jabatan</td>
	<td>Lingkup Divisi</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cIdjab, a.cFoto, a.bagian, b.* FROM users a
						LEFT JOIN desin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.suid ASC");
	$psn1 = mysql_query("SELECT tgl_bls FROM desin WHERE suid='$_GET[id]'");
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
				<td>$t[cJabatan]</td>
				<td>$t[bagian]</td>
			 </tr>";
	}
	?>
</table>
<br />
<big>Jumlah Penerima : <?=$j;?> Orang</big>

<br><br>
<? /* echo"<a href='home1.php?pages=dester1&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak</a>";
echo"<a href='home1.php?pages=dester2&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i>QRCode</a>";

*/?>
<?
}else{
?>

<div class="span12">
	<?php
	if($_SESSION[cv]=='0' OR $_SESSION[cv]=='1' OR $_SESSION[cv]=='53') {
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=dester&act=tambah'">Tambah Dokumen Eksternal Manual</button><br /><br />
	<?php
	$dist = mysql_query("SELECT * FROM dester ORDER BY dikodok DESC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Judul</th>
			<th>Penerbit</th>
			<th>Tahun</th>
            <th>Penerima</th>
            <th>Status</th>
            <th class='center' width=15%>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		while($s = mysql_fetch_array($dist)) {
        $tgl_input=tgl_indo($s[ditgl_input]);
        if ($s[distatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"   <td>$tgl_input</td>
				<td>$s[dijudok]</td>
				<td>$s[penerbit]</td>
				<td>$s[tahun]</td>
				<td><a href='?pages=dester&act=lp&id=$s[suid]' class='btn btn-info'>List</a></td>";
				
					if ($s[distatus]=='N'){
					if ($s[dipengirim]==$_SESSION[cv])
					{
			echo "<td><a href='include/dester/aksi_dester.php?act=acc&id=$s[suid]' onClick=\"return confirm('Yakin akan kirim distribusi dokumen eksternal ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>";
					}
						else {
			echo "<td>
			<b>Belum ACC/Kirim</b>
			     </td>";
						}
	
					}
			
				else{
			echo "<td><b>Terkirim</b></td>";
				}
				echo "
				<td class='center'><a href='include/dester/aksi_dester.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=dester&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=dester&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'> D</a>
				</td>
				</tr>";	
		}
	}
	else {}
	?>
	</tbody>
</table>

<br><br>
	<span class="label label-info">
<strong>Keterangan :</strong> - Warna hijau = belum terkirim<br>	    
<strong>Pilih Penerima : Klik tombol list untuk pilih penerima dokumen eksternal</strong><br>
<strong>Status : Klik tombol ACC/kirim untuk mengirim ke penerima dokumen</strong><br>
<strong>Tombol D : Detail Informasi Dokumen Eksternal</strong><br>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->