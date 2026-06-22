<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Surat Keluar</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$_GET[id]'"));

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(onmr) as max_no FROM osurat WHERE onmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("S-%04s/$_SESSION[nppcv]/$bln", $noUrut);


?>

<form method="post" action="include/sout/aksi_sout.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Surat Keluar</legend>


    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"> <?  echo "<input type=hidden name=pengirim1 value=$_SESSION[cv]><input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" required="required">
            	<option>Pilih users</option>
				 <?php
				 $e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));	
				echo "
				<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
				<option value='$e[cId]' >$e[cNama]</option>";
			?>
           	</select><br><b>(Jika yang dipilih adalah atasan langsung, <br>maka diperlukan ACC atasan langsung dahulu sebelum surat keluar di print, kecuali anda sebagai Pgs.)</b>
        </div> 
    </div>

	
    <div class="control-group">
		<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT okepada FROM osurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[okepada]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="kepada" class="span4" required="required" id="kepada" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off">
        </div>
    </div>
		<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Surat</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span9" name="jenisms" required="required">
            	<option value=0>Pilih/Cari Jenis Surat</option>
            <?php
				$vc = mysql_query("SELECT kode_jms, nama_jms FROM jenisms ORDER BY kode_jms ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jms]'>$dvc[nama_jms]</option>";
				}
			?>
           	</select>
        </div> 
		</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Surat</label>
        <div class="controls">
				<textarea name="ket" id="editor"></textarea>
        </div>
    </div>
<?
$sm = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$_GET[id]'"));	
?>
<input class="input-medium focused" id="nsm" type="hidden" name="iid" value="<? echo"$_GET[id]";?>">
    <div class="control-group">
		<label class="control-label" for="nsm">Nomor Surat Masuk</label>
        <div class="controls"><input class="input-medium focused" id="nsm" type="text" name="inmr" value="<?=$sm[inmr];?>"> (Untuk balasan surat masuk, jika ada)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_msk">Tanggal Surat Masuk</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_msk" type="text" name="tgl_msk" value="<?=$sm[itgl];?>"> <a href='smasuk/<?=$sm[ifile];?>'>Lampiran Surat Masuk</a> (Jika ada) </div>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM osurat WHERE oid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM osurat a,users b WHERE a.opengirim=b.cId AND a.oid='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM osurat a,users b WHERE a.opengirim1=b.cId AND a.oid='$_GET[id]'"));
?>
<form method="post" action="include/sout/aksi_sout.php?act=edit&id=<?=$e[oid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Surat Keluar</legend>
	

	    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[otgl];?>" required="required"><? echo tgl_indo($e[otgl]); ?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <?  echo "
			<input type=hidden name=pengirim value=$e[opengirim]><input type=hidden name=pengirim1 value=$e[opengirim1]>
			Dibuat oleh : <b>$efg[cNama]</b><br>ACC oleh : <b>$ef[cNama]</b>"; ?>
        </div> 
    </div>

		
    <div class="control-group">
		<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        	<?php
			$sql = mysql_query("SELECT DISTINCT okepada FROM osurat");
			$src="";
			while($r = mysql_fetch_array($sql)) {
				$src = $src."\"".$r[okepada]."\",";
			}
			$isi= substr($src,0,-1);
			?>
        	<input type="text" name="kepada" class="span4" id="kepada" required="required" data-provide="typeahead" data-items="4" data-source='[<?=$isi?>]' autocomplete="off" value="<?=$e[okepada];?>">
        </div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Surat</label>
        <div class="controls">
          	 <select id="jenisms" class="chzn-select span9" name="jenisms" required="required">
            	<option>Pilih/Cari Jenis Surat</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jenisms WHERE kode_jms='$e[jenisms]'"));
				echo"<option value='$e[jenisms]' selected>$v[nama_jms]</option>";
				$vc = mysql_query("SELECT kode_jms, nama_jms FROM jenisms ORDER BY kode_jms ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jms]'>$dvc[nama_jms]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[operihal];?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Surat (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
			<textarea name="ket" id="editor"><?=$e[oket];?></textarea>
        </div>
    </div>
	
	  <div class="control-group">
		<label class="control-label" for="nsm">Nomor Surat Masuk</label>
        <div class="controls"><input class="input-medium focused" id="nsm" type="text" name="inmr" value="<?=$e[inmr];?>"> (Untuk balasan surat masuk, jika ada)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tgl_msk">Tanggal Surat Masuk</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_msk" type="text" name="tgl_msk" value="<?=$e[itgl];?>"> (Jika ada)</div>
    </div>
	
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<? }elseif($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM osurat WHERE oid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[opengirim]'"));
$efg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[opengirim1]'"));
$efgh = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));
$si = mysql_fetch_array(mysql_query("SELECT * FROM isurat WHERE iid='$e[iid]'"));
?>

<legend>Detail Surat Keluar</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor Surat Keluar</td><td>: <?
	
	if ($e[onmr]=='') { echo"<u>Belum ACC anda/ atasan anda!</u>";}
	else  { echo"$e[onmr]";}
	?></td></tr>
    <tr><td>Tanggal Surat</td><td>: <?=tgl_indo($e[otgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[operihal];?></td></tr>
	<tr><td>jenis Surat</td><td>: <?=$efgh[nama_jms];?></td></tr>
    <tr><td>Pengirim</td><td>: <strong><?=$ef[cNama];?> - Konsep oleh : <?=$efg[cNama];?></strong></td></tr>
    <tr><td>Kepada</td><td>: <strong><?=$e[okepada];?></strong></td></tr>
	<tr><td>Jawab Surat Masuk Nomor</td><td>: <strong><?=$e[inmr];?></strong></td></tr>
	<tr><td>Tgl Surat Masuk</td><td>: <strong><?=tgl_indo($e[itgl]);?></strong></td></tr>
</table>
<br>
<table width="100%">
    <tr><td align=top><b>Isi Surat :</b></td></tr>
	<tr><td><?=$e[oket];?></td></tr>
</table>


<br />
<?php
} else{
?>

<div class="span12">

	<button class="btn-info btn-large" onclick="window.location.href='?pages=sout&act=tambah'">Buat Surat Keluar</button>
 <br><br><b>Informasi</b> : Fasilitas Surat keluar ini bisa digunakan untuk membuat konsep surat keluar oleh Supervisor untuk Asman/Manager, nantinya Asman/Manager masukan surat keluar ini ke <b>NDE</b>. 
  
 
    <br /><br />
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr><th></th><th>Tanggal</th>
			<th>Dari</th>
			<th>Kepada</th>
			<th>Perihal</th>
            <th>Lampiran</th>
			<th>Status</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT * FROM osurat WHERE opengirim=$_SESSION[cv] OR opengirim1=$_SESSION[cv] order by otgl DESC");
		
		
		
		while($s = mysql_fetch_array($smasuk)) {
				if ($s[sstatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo "<td></td><td>";echo tgl_indo($s[otgl]);echo"</td>
                <td>$_SESSION[namacv]</td>
                <td>$s[okepada]</td>
                <td>$s[operihal]</td>
                <td><a href='skeluar/$s[ofile]' class='btn btn-info'>File</a></td>";
					if ($s[sstatus]=='N'){
					if ($s[opengirim]==$_SESSION[cv])
					{
			echo "<td><a href='include/sout/aksi_sout.php?act=acc&id=$s[oid]' class='btn btn-info' onClick=\"return confirm('Yakin ACC?, klik Edit dahulu untuk koreksi, karena jika sudah klik ACC tidak bisa edit lagi.')\">ACC/kirim!</a></td>";
					}
					else {
			echo "<td><b>Belum koreksi/ACC Atasan</b></td>";	
					}
			
			}	else{
			echo "<td>Telah ACC</td>";
			}
				if ($s[sstatus]=='N'){
				echo "
				<td class='center'><a href='include/sout/aksi_sout.php?act=hapus&id=$s[oid]'  onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=sout&act=edit&id=$s[oid]'><i class='icon-edit'></i></a> <a href='?pages=sout&act=detail&id=$s[oid]' class='btn btn-info'>Detail</a>
				</td>
				</tr>";
				}
				else {
				echo"<td><a href='?pages=sout&act=detail&id=$s[oid]' class='btn btn-info'>Detail Surat</a></td></tr>";
					
				}
		}
	?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris tabel Berwarna HIJAU = <strong>KONSEP SURAT KELUAR BELUM KOREKSI/ACC SENDIRI atau ATASAN, <BR>
	CARA KOREKSI DENGAN KLIK EDIT, UNTUK ACC KLIK LINK : ACC/KIRIM !<BR>
	</strong></h5>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->