<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Pencarian Dokumen Internal</div>
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

$query = "SELECT max(dinmr) as max_no FROM dinter WHERE dinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("DD-%04s/$bln", $noUrut);

?>
<form method="post" action="include/dinter/aksi_dinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Dokumen Internal</legend>


	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span3" name="jenisdok" required="required">
            	<option>Pilih Jenis Dokumen</option>
            <?php
				$vc = mysql_query("SELECT id_jendok, nama_jendok FROM jendok ORDER BY id_jendok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[id_jendok]'>$dvc[nama_jendok]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	 <div class="control-group">
		<label class="control-label" for="jenis">Lingkup Bagian</label>
        <div class="controls"><input class="input-small focused" id="jenis" type="text" name="jenis"> Ketik lingkup bagian dokumen misal HCO, AKN dll</div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi1" type="text" name="revisi" required="required"> Ketik 0,1,2.. jangan 00,01..</div>
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
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_review" type="text" name="tgl_review" required="required"> 3 Tahun dari tanggal berlaku (bisa diketik)</div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="pjdok">Penanggung Jawab Dokumen</label>
        <div class="controls">
            <select id="pjdok" class="chzn-select span8" name="pjdok" >
            	<option>Pilih/Cari User</option>
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
    	<label class="control-label" for="fileInput">Upload dokumen PDF</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB<br>(Nama file ada kode dokumen dan jangan ada spasi)
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
$e = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$_GET[id]'");
$ef = mysql_fetch_array("SELECT a.*, b.cNama FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'");
?>
<form method="post" action="include/dinter/aksi_dinter.php?act=edit&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Dokumen</legend>
<input type=hidden name=difile1 value='<?=$e[difile];?>'>
<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span6" name="jenisdok" required="required">
            	<option>Pilih/Cari Jenis Dokumen</option>
				
            <?php
			$v = mysql_fetch_array("SELECT * FROM jendok WHERE id_jendok='$e[jenisdok]'");
				echo"<option value='$e[jenisdok]' selected>$v[nama_jendok]</option>";
				$vc = mysql_query( "SELECT id_jendok, nama_jendok FROM jendok ORDER BY id_jendok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[id_jendok]'>$dvc[nama_jendok]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="Jenisdok">Penanggung Jawab Dokumen</label>
        <div class="controls">
          	 <select id="pjdok" class="chzn-select span6" name="pjdok" required="required">
            	<option>Pilih/Cari Penanggung Jawab Dokumen</option>
				
            <?php
			$v = mysql_fetch_array("SELECT * FROM users WHERE cId='$e[dipjdok]'");
				echo"<option value='$e[dipjdok]' selected>$v[cNama]</option>";
				$vc = mysql_query( "SELECT cId, cNama FROM users ORDER BY cNama ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	
    <div class="control-group">
		<label class="control-label" for="jenis">Lingkup Bagian</label>
        <div class="controls"><input class="input-small focused" id="jenis" type="text" name="jenis" value="<?=$e[jenis];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pass">Password</label>
        <div class="controls"><input class="input-small focused" id="pass" type="text" name="pass" value="<?=$e[pass];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="dokait1">Dok. terkait 1</label>
        <div class="controls">
          	 <select id="dokait1" class="chzn-select span6" name="dokait1">
            <?php
			$v = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$e[dok_terkait1]'");
				 if ($e[dok_terkait1]=='')
            { echo"<option value='IS NULL'>Pilih/Cari Dokumen</option>"; }
            else {
				echo"<option value='$e[dok_terkait1]' selected>$v[dikodok]-$v[dijudok]</option>";
            }
				$vc = mysql_query( "SELECT * FROM dinter ORDER BY dikodok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[suid]'>$dvc[dikodok]-$dvc[dijudok]</option>";
				}
			?>
			<option value='IS NULL'>Pilih/Cari Dokumen</option>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="dokait2">Dok. terkait 2</label>
        <div class="controls">
          	 <select id="dokait2" class="chzn-select span6" name="dokait2">
            <?php
			$v = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$e[dok_terkait2]'");
				 if ($e[dok_terkait2]=='')
            { echo"<option value='IS NULL'>Pilih/Cari Dokumen</option>"; }
            else {
				echo"<option value='$e[dok_terkait2]' selected>$v[dikodok]-$v[dijudok]</option>";
            }
				$vc = mysql_query( "SELECT * FROM dinter ORDER BY dikodok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[suid]'>$dvc[dikodok]-$dvc[dijudok]</option>";
				}
			?>
			<option value='IS NULL'>Pilih/Cari Dokumen</option>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="dokait3">Dok. terkait 3</label>
        <div class="controls">
          	 <select id="dokait3" class="chzn-select span6" name="dokait3">
            <?php
			$v = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$e[dok_terkait3]'");
				 if ($e[dok_terkait3]=='')
            { echo"<option value='IS NULL'>Pilih/Cari Dokumen</option>"; }
            else {
				echo"<option value='$e[dok_terkait3]' selected>$v[dikodok]-$v[dijudok]</option>";
            }
				$vc = mysql_query( "SELECT * FROM dinter ORDER BY dikodok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[suid]'>$dvc[dikodok]-$dvc[dijudok]</option>";
				}
			?>
			<option value='IS NULL'>Pilih/Cari Dokumen</option>
           	</select>
        </div> 
	</div>
    
     <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required" value="<?=$e[dikodok];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi" required="required" value="<?=$e[direv];?>">Isi 0,1,2,3.. (jangan 01,02,03..)</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required" value="<?=$e[dijudok];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Berlaku Terakhir</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_brlk" required="required" value="<?=$e[ditgl_brlk];?>" ></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_review" required="required" value="<?=$e[ditgl_review];?>" ></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_rev0">Tanggal Revisi 0</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_rev0" type="text" name="tgl_rev0" required="required" value="<?=$e[ditgl_rev0];?>" ></div>
    </div>

    <div class="control-group">
    	<label class="control-label" for="status">Status</label>
        <div class="controls">
          	 <select id="status" class="chzn-select span3" name="status">
            <?php
		    if ($e[distatus]=='Y')
            { echo"<option value='Y' selected>Masih Berlaku</option><option value='N'>Obsolete/ Dihilangkan</option>"; }
            else 
            { echo"<option value='N' selected>Obsolete/ Dihilangkan</option><option value='Y'>Masih Berlaku</option>"; }
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
<form method="post" action="include/dinter/aksi_dinter.php?act=edit2&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Tanggal Revisi Dokumen</legend>
    <div class="control-group">
		<label class="control-label" for="rev">Revisi ke :</label>
        <div class="controls">
        <select id="rev" class="chzn-select span1" name="rev">
           <option value='-' selected>-</option>
           <option value='1' >1</option> 
           <option value='2' >2</option> 
           <option value='3' >3</option> 
           <option value='4' >4</option> 
           <option value='5' >5</option> 
           <option value='6' >6</option> 
           <option value='7' >7</option> 
           <option value='8' >8</option> 
           <option value='9' >9</option> 
        </select>   
        </div>
    </div>    
    <div class="control-group">
		<label class="control-label" for="tgl_rev">Tanggal Revisi :</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_rev" type="text" name="tgl_rev"  value="0000-00-00" ></div>
    </div>
   <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>    
<form method="post" action="include/dinter/aksi_dinter.php?act=edit3&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Tanggal Review Dokumen</legend>
    <div class="control-group">
		<label class="control-label" for="rev">Review ke :</label>
        <div class="controls">
        <select id="rev" class="chzn-select span1" name="rev">
           <option value='-' selected>-</option>
           <option value='1' >1</option> 
           <option value='2' >2</option> 
           <option value='3' >3</option> 
        </select>   
        </div>
    </div>    
     <div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_review" type="text" name="tgl_review"  value="0000-00-00" ></div>
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

		 <br><form method="post" action="include/dinter/aksi_dinter.php?act=lp1&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
			 <label class="control-label" for="dsin">Data Semua Penerima Dokumen :</label>
			  <div class="controls">
			<select multiple="multiple" id="dsin" name="dsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query( "SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query( "SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
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
<center><strong><h4>DAFTAR INDUK DOKUMEN (ALL)</h4></strong></center>
	<?php
	$dist = mysql_query( "SELECT * FROM dinter ORDER BY dikodok ASC");
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
				<td>$s[jenis]"; 
			    if ($_SESSION[levelcv]<2){
	            echo"-<a title='File Dokumen' href='fdok/index1.php?id=$s[suid]' target='_blank'>File </a>"; }
				echo"</td>
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
	$e = mysql_fetch_array("SELECT a.*, b.cNama, b.cIdjab FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'");
	$ef = mysql_fetch_array("SELECT a.*, b.cNama, b.cIdjab FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'");
	$efg = mysql_fetch_array("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'");
    $dok = mysql_query( "SELECT * FROM dinter WHERE suid='$e[dikodok]'");
    $dok1 = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$e[dok_terkait1]'");
    $dok2 = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$e[dok_terkait2]'");
    $dok3 = mysql_fetch_array("SELECT * FROM dinter WHERE suid='$e[dok_terkait3]'");
    $r    = mysql_fetch_array($dok);
    $pjdok = mysql_query( "SELECT * FROM users WHERE cId='$e[dipjdok]'");
    $t    = mysql_fetch_array($pjdok);
	?>
<strong>
<legend>Detail Dokumen Internal </legend>
<table width="100%" border=1>
    <tr><td width=25%>Jenis Dokumen</td><td>: <?=$efg[nama_jendok];?></td></tr>
    <tr><td>Lingkup Bagian</td><td>: <?=$e[jenis];?></td></tr>
    <tr><td>Penanggung Jawab Dokumen</td><td>: <?=$t[cNama];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Revisi</td><td>: <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
	<tr><td>Tanggal Berlaku Terakhir </td><td>: <?=tgl_indo($e[ditgl_brlk]);?></td></tr>
	<tr><td>Tanggal Maks Review </td><td>: <?=tgl_indo($e[ditgl_review]);?></td></tr>
    <tr><td>Tanggal Revisi 0 </td><td>: <?=tgl_indo($e[ditgl_rev0]);?></td></tr>
    <tr><td>Tanggal Revisi 1 </td><td>: <?=tgl_indo($e[ditgl_rev1]);?></td></tr>
    <tr><td>Tanggal Revisi 2 </td><td>: <?=tgl_indo($e[ditgl_rev2]);?></td></tr>
    <tr><td>Tanggal Revisi 3 </td><td>: <?=tgl_indo($e[ditgl_rev3]);?></td></tr>
    <tr><td>Tanggal Revisi 4 </td><td>: <?=tgl_indo($e[ditgl_rev4]);?></td></tr>
    <tr><td>Tanggal Revisi 5 </td><td>: <?=tgl_indo($e[ditgl_rev5]);?></td></tr>
    <tr><td>Tanggal Revisi 6 </td><td>: <?=tgl_indo($e[ditgl_rev6]);?></td></tr>
    <tr><td>Tanggal Revisi 7 </td><td>: <?=tgl_indo($e[ditgl_rev7]);?></td></tr>
    <tr><td>Tanggal Revisi 8 </td><td>: <?=tgl_indo($e[ditgl_rev6]);?></td></tr>
    <tr><td>Tanggal Revisi 9 </td><td>: <?=tgl_indo($e[ditgl_rev7]);?></td></tr>   
    <tr><td>Tanggal Review 1 </td><td>: <?=tgl_indo($e[ditgl_review1]);?></td></tr>
    <tr><td>Tanggal Review 2 </td><td>: <?=tgl_indo($e[ditgl_review2]);?></td></tr>
    <tr><td>Tanggal Review 3 </td><td>: <?=tgl_indo($e[ditgl_review3]);?></td></tr>
    <tr><td>File Dokumen </td><td>: <a title='File Dokumen' href='fdok/index1.php?id=<?=$e[suid];?>' target='_blank'>Klik Disini </a></td></tr>
    <tr><td><font color=red>Password PDF</font></td><td>: <font color=red><?=$e[pass];?></font></td></tr>
<? 	if($_SESSION[levelcv]==0 OR $_SESSION[levelcv]==1) { ?>
    <tr><td>File Khusus MR </td><td>: <a title='File Dokumen' href='fdok/src/index1.php?id=<?=$e[suid];?>' target='_blank'>File Revisi Terbaru </a>| <a title='File Dokumen' href='fdok/src/index.php?id=<?=$e[suid];?>' target='_blank'>File Revisi Sebelumnya (Obsolete) </a></td></tr>
<? } ?>    
	<tr><td>Dokumen Terkait 1</td><td>: Kode :<?=$dok1[dikodok];?>- Judul :<?=$dok1[dijudok];?> </td></tr>
	<tr><td>Dokumen Terkait 2</td><td>: Kode :<?=$dok2[dikodok];?>- Judul :<?=$dok2[dijudok];?> </td></tr>
	<tr><td>Dokumen Terkait 3</td><td>: Kode :<?=$dok3[dikodok];?>- Judul :<?=$dok3[dijudok];?> </td></tr>
	<tr><td>Status</td><td>: <strong>
<?
if ($e[distatus]=='N')
{
	echo"Obsolete/ Dihilangkan";
}
else
{
	echo"Masih Berlaku";
}
?>
	</strong></td></tr>
	</table>
	<br></strong>
	<table>
    <tr><td align=top><b>Dokumen PDF :</b></td><td></td></tr>
</table>
<iframe src="fdok/index1.php?id=<?=$e[suid];?>" width=100% height=500></iframe>
<br />
<legend>Penerima Dokumen :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<td>Nama</td>
	<td>Jabatan</td>
	<td>Lingkup Divisi</td>
</thead>
<?php
	$psn = mysql_query( "SELECT a.cUser,a.cNama,a.cJabatan, a.cIdjab, a.cFoto, a.bagian, b.* FROM users a
						LEFT JOIN dsin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.suid ASC");
	$psn1 = mysql_query( "SELECT tgl_bls FROM dsin WHERE suid='$_GET[id]'");
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
					$t[cNama] ($t[cJabatan])
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
<? /* echo"<a href='home1.php?pages=dinter1&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak</a>";
echo"<a href='home1.php?pages=dinter2&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i>QRCode</a>";

*/?>
<?
}else{
if ($_POST['judul']==''){
    
    echo "<b>Pencarian kosong <a href=?pages=dinter>Kembali</a></b>";

}
else
{
?>

<div class="span12">
	<?php
	if($_SESSION[cv]==16 OR $_SESSION[cv]==63) {
	?>
	<?php
$dist = mysql_query( "SELECT * FROM dinter WHERE dijudok LIKE '%$_POST[judul]%' OR dikodok LIKE '%$_POST[judul]%' ORDER BY dikodok DESC");	
//$dist = mysql_query( "SELECT a.*, b.* FROM dinter a, dsin b WHERE a.suid=b.suid AND b.cId='$_POST[user]' AND a.dijudok LIKE '%$_POST[judul]%' ORDER BY a.dikodok DESC");
$vc = mysql_fetch_array("SELECT * FROM users WHERE cId='$_POST[user]' ORDER BY cId DESC");
$tampil = mysql_num_rows($dist)
    ?> Ditemukan = <b><?=$tampil;?></b> dokumen dengan kata kunci judul/kode dokumen =<b><?=$_POST[judul];?> </b> </b><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Kode</th>
			<th>Judul</th>
            <th>Penerima</th>
            <th>File</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		while($s = mysql_fetch_array($dist)) {
        $file =$s[difile];
		echo"   <tr>
                <td>$s[dikodok]</td>
				<td>$s[dijudok]</td>
				<td><a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>List</a></td>
                <td><a href='fdok/$file'class='btn btn-info' target=_blank>File</a></td>";
				echo "
				<td class='center'><a href='include/dinter/aksi_dinter.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'> I</a>
				<a href='home.php?pages=usulandok&act=tambah&id=$s[suid]' title='Buat Usulan Dokumen' class='btn btn-info'> U</a>
				<a href='home.php?pages=dister&act=tambah2&id=$s[dikodok]' title='Buat Distribusi Dokumen' class='btn btn-info'> D</a>
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
<strong>Keterangan :</strong><br>	    
<strong>I : Informasi Detail Dokumen</strong><br>
<strong>D : Buat Distribusi Dokumen Manual</strong><br>
<strong>U : Buat Usulan Dokumen Manual</strong><br>
</div>
</div>
<?php

}
}
?>
</div><!--/span12-->
</div><!--/block-content-->