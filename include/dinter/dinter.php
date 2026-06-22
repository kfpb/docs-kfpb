<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Daftar Induk Dokumen Internal</div>
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
					$cv = mysql_query("SELECT cId, cNama, cJabatan FROM users ORDER by cNama ASC");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
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
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jendok WHERE id_jendok='$e[jenisdok]'"));
				echo"<option value='$e[jenisdok]' selected>$v[nama_jendok]</option>";
				$vc = mysql_query("SELECT id_jendok, nama_jendok FROM jendok ORDER BY id_jendok ASC");
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
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[dipjdok]'"));
				echo"<option value='$e[dipjdok]' selected>$v[cNama]</option>";
				$vc = mysql_query("SELECT cId, cNama, cJabatan FROM users ORDER BY cNama ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] ($dvc[cJabatan])</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	<? /*
    <div class="control-group">
		<label class="control-label" for="pass">Password</label>
        <div class="controls"><input class="input-small focused" id="pass" type="text" name="pass" value="<?=$e[pass];?>"></div>
    </div>
    */?>
    <div class="control-group">
    	<label class="control-label" for="dokait1">Dok. terkait 1</label>
        <div class="controls">
          	 <select id="dokait1" class="chzn-select span6" name="dokait1">
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait1]'"));
				 if ($e[dok_terkait1]=='')
            { echo"<option value='IS NULL'>Pilih/Cari Dokumen</option>"; }
            else {
				echo"<option value='$e[dok_terkait1]' selected>$v[dikodok]-$v[dijudok]</option>";
            }
				$vc = mysql_query("SELECT * FROM dinter");
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
			$v = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait2]'"));
				 if ($e[dok_terkait2]=='')
            { echo"<option value='IS NULL'>Pilih/Cari Dokumen</option>"; }
            else {
				echo"<option value='$e[dok_terkait2]' selected>$v[dikodok]-$v[dijudok]</option>";
            }
				$vc = mysql_query("SELECT * FROM dinter ORDER BY dikodok ASC");
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
			$v = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait3]'"));
				 if ($e[dok_terkait3]=='')
            { echo"<option value='IS NULL'>Pilih/Cari Dokumen</option>"; }
            else {
				echo"<option value='$e[dok_terkait3]' selected>$v[dikodok]-$v[dijudok]</option>";
            }
				$vc = mysql_query("SELECT * FROM dinter ORDER BY dikodok ASC");
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
           <option value='0' selected>-</option>
           <option value='0' >0</option> 
           <option value='1' >1</option> 
           <option value='2' >2</option> 
           <option value='3' >3</option> 
           <option value='4' >4</option> 
           <option value='5' >5</option> 
           <option value='6' >6</option> 
           <option value='7' >7</option> 
           <option value='8' >8</option> 
           <option value='9' >9</option> 
           <option value='10' >10</option> 
           <option value='11' >11</option> 
           <option value='12' >12</option> 
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
           <option value='0' >0</option> 
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
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] - $dcv[cJabatan]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]')");
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
<br>
<?
}elseif($_GET['act']=="lengkap"){
?>
<div class="span12">
<center><strong><h4>REGISTRASI DOKUMEN TERKENDALI</h4></strong></center>
	<?php
	$dist = mysql_query("SELECT * FROM dinter ORDER BY dikodok ASC");
    ?>	
     <a href="include/dinter/rdt_cetak.php" class="btn btn-success" style="margin-bottom: 10px;">
        <i class="icon-print icon-white"></i> Cetak ke Excel
    </a>
    
	<div style="width:auto;overflow-x:auto;">
	    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th>No</th>
			<th width=9%>Kode_Dok</th>
			<th width=15%>Judul_Dokumen</th>
            <th width=9%>Aksi</th>
            <th width=9%>Tgl_R0</th>
            <th width=9%>Tgl_R1</th>
            <th width=9%>Tgl_R2</th>
            <th width=9%>Tgl_R3</th>
            <th width=9%>Tgl_R4</th>
            <th width=9%>Tgl_R5</th>
            <th width=9%>Tgl_R6</th>
            <th width=9%>Tgl_R7</th>
            <th width=9%>Tgl_R8</th>
            <th width=9%>Tgl_R9</th>
            <th width=9%>Tgl_R10</th>
            <th width=9%>Tgl_R11</th>
            <th width=9%>Tgl_R12</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		$no=1;
		while($s = mysql_fetch_array($dist)) {
        $tgl_rev0=tgl_indo2($s[ditgl_rev0]);
        $tgl_rev1=tgl_indo2($s[ditgl_rev1]);
        $tgl_rev2=tgl_indo2($s[ditgl_rev2]);
        $tgl_rev3=tgl_indo2($s[ditgl_rev3]);       
        $tgl_rev4=tgl_indo2($s[ditgl_rev4]);       
        $tgl_rev5=tgl_indo2($s[ditgl_rev5]);
        $tgl_rev6=tgl_indo2($s[ditgl_rev6]); 
        $tgl_rev7=tgl_indo2($s[ditgl_rev7]);   
        $tgl_rev8=tgl_indo2($s[ditgl_rev8]);    
        $tgl_rev9=tgl_indo2($s[ditgl_rev9]);  
        $tgl_rev10=tgl_indo2($s[ditgl_rev10]);
        $tgl_rev11=tgl_indo2($s[ditgl_rev11]); 
        $tgl_rev12=tgl_indo2($s[ditgl_rev12]); 
        $tgl_rev13=tgl_indo2($s[ditgl_rev13]); 
        $tgl_rev14=tgl_indo2($s[ditgl_rev14]); 
        $tgl_rev15=tgl_indo2($s[ditgl_rev15]); 
        $tgl_review1=tgl_indo2($s[ditgl_review1]);
        $tgl_review2=tgl_indo2($s[ditgl_review2]);
        $tgl_review3=tgl_indo2($s[ditgl_review3]);
        
        
		echo"   <tr>
		        <td>$no</td>
                <td>$s[dikodok]</td>
	        	
				<td>$s[dijudok]</td><td class='center'>
	        	<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn-small btn-info' target='_blank'>Detail</a>
				
				</td>
				<td>$tgl_rev0</td>
				<td>$tgl_rev1</td>
				<td>$tgl_rev2</td>
				<td>$tgl_rev3</td>				
				<td>$tgl_rev4</td>				
				<td>$tgl_rev5</td>				
				<td>$tgl_rev6</td>				
				<td>$tgl_rev7</td>
				<td>$tgl_rev8</td>
				<td>$tgl_rev9</td>
				<td>$tgl_rev10</td>
				<td>$tgl_rev11</td>
				<td>$tgl_rev12</td>				

				</td>
	         
				</tr>";
				// <a title='File Dokumen' href='dok/web/viewer.html?file=/fdok/$s[difile]' target='_blank'>File</a> | 
				// <a title='File Dokumen' href='dok/web/viewer.html?file=/fdok/$s[difile1]' target='_blank'>File 2</a>
			// <a title='File Dokumen' href='fdok/index1.php?id=$s[suid]' target='_blank'>File</a>
	   //         <a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>Detail</a>
    //             <a href='dok/$s[jenisdok]/$s[difile]'class='btn btn-info' target=_blank>F</a>
	   //         <a href='include/dinter/aksi_dinter.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				// <a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>
				// <a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'>I</a>
				// <a href='home.php?pages=usulandok&act=tambah&id=$s[suid]' title='Buat Usulan Dokumen' class='btn btn-info'>U</a>
				// <a href='home.php?pages=dister&act=tambah2&id=$s[dikodok]' title='Buat Distribusi Dokumen' class='btn btn-info'>D</a>
		$no++;
	
		
		}

	?>
	</tbody>
</table>
</div>
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
}elseif($_GET['act']=="rdtcc"){
?>
<div class="span12">
<center><strong><h4>REGISTRASI DOKUMEN TERKENDALI (Change Control)</h4></strong></center>
<?php
$dist = mysql_query("SELECT * FROM dinter ORDER BY dikodok ASC");


// Ambil daftar penanggung jawab unik dari tabel users
$user_list_query = mysql_query("SELECT DISTINCT cId, cNama FROM users ORDER BY cNama ASC");

// Ambil filter yang dipilih oleh pengguna
$filter_pj = isset($_GET['filter_pj']) ? $_GET['filter_pj'] : '';
?>

<!--<form method="POST" action="home1.php?pages=cetakRDTCC">-->
<!--    <label for="filter_pj">Filter Penanggung Jawab:</label>-->
<!--    <select name="filter_pj" id="filter_pj">-->
        <!--<option value="">-- Semua --</option>-->
        <?php
        // while ($user = mysql_fetch_array($user_list_query)) {
        //     $selected = ($filter_pj == $user['cId']) ? 'selected' : '';
        //     echo "<option value='{$user['cId']}' {$selected}>{$user['cNama']}</option>";
        // }
        ?>
    <!--</select>-->
<!--<input class="btn btn-primary" type="submit" value="Export" />-->
<!--<a href='home1.php?pages=cetakRDTCC' class='btn btn-info'>Export ke Excel</a>-->
<!--</form>-->

<div style="width:auto;overflow-x:auto;">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Dok</th>
                <th width=9%>No Revisi</th>
                <th width=15%>Judul Dokumen</th>
                <th width=15%>Tanggal Efektif</th>
                <th width=15%>Penanggung Jawab Dok</th>
                <th width=15%>Bagian</th>
                <th width=9%>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($s = mysql_fetch_array($dist)) {
                // Konversi tanggal ke format yang sesuai
                $tgl_review1 = tgl_indo2($s['ditgl_review1']);
                $tgl_review2 = tgl_indo2($s['ditgl_review2']);
                $tgl_review3 = tgl_indo2($s['ditgl_review3']);
                $ditgl_brlk = tgl_indo($s['ditgl_brlk']);
                
                // Mengambil nama penanggung jawab dokumen dari tabel users
                $user_query = mysql_query("SELECT cNama, cJabatan, bagian FROM users WHERE cId = '{$s['dipjdok']}'");
                $user = mysql_fetch_array($user_query);
                $penanggung_jawab = $user ? $user['cNama'] : "Tidak Ditemukan";
                $jabatan = $user ? $user['cJabatan'] : "Tidak Ditemukan";
                $bagian = $user ? $user['bagian'] : "Tidak Ditemukan";

                echo "<tr>
                    <td>{$no}</td>
                    <td>{$s['dikodok']}</td>
                    <td>{$s['direv']}</td>
                    <td>{$s['dijudok']}</td>
                    <td>{$ditgl_brlk}</td>
                    <td>{$penanggung_jawab}</td>
                    <td>{$jabatan}<br>
                    {$bagian}
                    
                    </td>
                    <td class='center'>
                        <a href='home.php?pages=dinter&act=detail&id={$s['suid']}' title='Detail Info Dokumen' class='btn-small btn-info' target='_blank'>Detail</a>
                    </td>
                </tr>";

                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

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
}elseif($_GET['act']=="registuser"){
    ?>
    <div class="span12">
    <div style="text-align: center; margin-bottom: 20px;">
        <strong><h4>REGISTRASI DOKUMEN TERKENDALI</h4></strong>
    </div>

    <?php
    $dist = mysql_query("SELECT * FROM dinter WHERE dipjdok='$_SESSION[cv]' ORDER BY dikodok ASC");
    ?>    

    <div style="width: 100%; overflow-x: auto; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 4px;">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="Tb14" style="white-space: nowrap; margin-bottom: 0;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="text-align: center; vertical-align: middle; width: 5%;">No</th>
                    <th style="text-align: center; vertical-align: middle; width: 9%;">Detail</th>
                    <th style="vertical-align: middle; width: 10%;">Kode_Dok</th>
                    <th style="vertical-align: middle; width: 15%;">Judul_Dokumen</th>
                    <th style="text-align: center; vertical-align: middle; width: 10%;">Status</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R0</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R1</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R2</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R3</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R4</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R5</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R6</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R7</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R8</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R9</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R10</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R11</th>
                    <th style="text-align: center; vertical-align: middle;">Tgl_R12</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                $no = 1;
                while($s = mysql_fetch_array($dist)) {
                    $tgl_rev0  = tgl_indo2($s['ditgl_rev0']);
                    $tgl_rev1  = tgl_indo2($s['ditgl_rev1']);
                    $tgl_rev2  = tgl_indo2($s['ditgl_rev2']);
                    $tgl_rev3  = tgl_indo2($s['ditgl_rev3']);        
                    $tgl_rev4  = tgl_indo2($s['ditgl_rev4']);        
                    $tgl_rev5  = tgl_indo2($s['ditgl_rev5']);
                    $tgl_rev6  = tgl_indo2($s['ditgl_rev6']);  
                    $tgl_rev7  = tgl_indo2($s['ditgl_rev7']);    
                    $tgl_rev8  = tgl_indo2($s['ditgl_rev8']);    
                    $tgl_rev9  = tgl_indo2($s['ditgl_rev9']);    
                    $tgl_rev10 = tgl_indo2($s['ditgl_rev10']);
                    $tgl_rev11 = tgl_indo2($s['ditgl_rev11']);  
                    $tgl_rev12 = tgl_indo2($s['ditgl_rev12']);  
                    $tgl_rev13 = tgl_indo2($s['ditgl_rev13']);  
                    $tgl_rev14 = tgl_indo2($s['ditgl_rev14']);  
                    $tgl_rev15 = tgl_indo2($s['ditgl_rev15']);  
                    $tgl_review1 = tgl_indo2($s['ditgl_review1']);
                    $tgl_review2 = tgl_indo2($s['ditgl_review2']);
                    $tgl_review3 = tgl_indo2($s['ditgl_review3']);
                    
                    // Logika penentuan status dokumen
                    if ($s['distatus'] == 'Y') {
                        $status_dokumen = "<span style='color: #28a745; font-weight: bold;'>Berlaku</span>";
                    } elseif ($s['distatus'] == 'N') {
                        $status_dokumen = "<span style='color: #dc3545; font-weight: bold;'>Obsolete</span>";
                    } else {
                        $status_dokumen = "-";
                    }
                    
                    echo "<tr>
                            <td style='text-align: center;'>$no</td>
                            <td style='text-align: center;'>
                                <a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-small btn-info' target='_blank'>Detail</a>
                            </td>
                            <td>$s[dikodok]</td>
                            <td>$s[dijudok]</td>
                            <td style='text-align: center;'>$status_dokumen</td>
                            <td style='text-align: center;'>$tgl_rev0</td>
                            <td style='text-align: center;'>$tgl_rev1</td>
                            <td style='text-align: center;'>$tgl_rev2</td>
                            <td style='text-align: center;'>$tgl_rev3</td>              
                            <td style='text-align: center;'>$tgl_rev4</td>              
                            <td style='text-align: center;'>$tgl_rev5</td>              
                            <td style='text-align: center;'>$tgl_rev6</td>              
                            <td style='text-align: center;'>$tgl_rev7</td>
                            <td style='text-align: center;'>$tgl_rev8</td>
                            <td style='text-align: center;'>$tgl_rev9</td>
                            <td style='text-align: center;'>$tgl_rev10</td>
                            <td style='text-align: center;'>$tgl_rev11</td>
                            <td style='text-align: center;'>$tgl_rev12</td>             
                        </tr>";
                    
                    /* echo "<tr> 
                            <td class='center'>
                                <a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>Detail</a>
                                <a href='dok/$s[jenisdok]/$s[difile]' class='btn btn-info' target=_blank>F</a>
                                <a href='include/dinter/aksi_dinter.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
                                <a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>
                                <a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'>I</a>
                                <a href='home.php?pages=usulandok&act=tambah&id=$s[suid]' title='Buat Usulan Dokumen' class='btn btn-info'>U</a>
                                <a href='home.php?pages=dister&act=tambah2&id=$s[dikodok]' title='Buat Distribusi Dokumen' class='btn btn-info'>D</a>
                            </td>
                        </tr>";
                    // <a title='File Dokumen' href='fdok/index1.php?id=$s[suid]' target='_blank'>File | </a>
                    */
                    
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <br>
    
    <div style="background-color: #f9f9f9; padding: 15px; border: 1px solid #e3e3e3; border-radius: 4px;">
        <span class="label label-info" style="font-size: 13px; display: inline-block; margin-bottom: 8px;">
            <strong>Keterangan :</strong>
        </span>
        <ul style="margin: 0 0 0 20px; padding: 0; line-height: 1.8;">
            <li><strong>Dokumen Level 1 :</strong> Manual Mutu</li>
            <li><strong>Dokumen Level 2 :</strong> Prosedur</li>
            <li><strong>Dokumen Level 3 :</strong> Instruksi Kerja</li>
            <li><strong>Dokumen Level 4 :</strong> Catatan/Dokumen Mutu</li>
        </ul>
    </div>
</div>
<? }elseif($_GET['act']=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));
    $dok = mysql_query("SELECT * FROM dinter WHERE suid='$e[dikodok]'");
    $dok1 = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait1]'"));
    $dok2 = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait2]'"));
    $dok3 = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$e[dok_terkait3]'"));
    $r    = mysql_fetch_array($dok);
    $pjdok = mysql_query("SELECT * FROM users WHERE cId='$e[dipjdok]'");
    $t    = mysql_fetch_array($pjdok);
	?>
<strong>
<legend>Detail Dokumen Internal </legend>
<table width="100%" border=1>
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
    <tr><td>Tanggal Revisi 8 </td><td>: <?=tgl_indo($e[ditgl_rev8]);?></td></tr>
    <tr><td>Tanggal Revisi 9 </td><td>: <?=tgl_indo($e[ditgl_rev9]);?></td></tr>   
    <tr><td>Tanggal Revisi 10 </td><td>: <?=tgl_indo($e[ditgl_rev10]);?></td></tr>
    <tr><td>Tanggal Revisi 11 </td><td>: <?=tgl_indo($e[ditgl_rev11]);?></td></tr>
    <tr><td>Tanggal Revisi 12 </td><td>: <?=tgl_indo($e[ditgl_rev12]);?></td></tr>
    <tr><td>Tanggal Revisi 13 </td><td>: <?=tgl_indo($e[ditgl_rev13]);?></td></tr>
    <tr><td>Tanggal Revisi 14 </td><td>: <?=tgl_indo($e[ditgl_rev14]);?></td></tr>    
    <tr><td>Tanggal Revisi 15 </td><td>: <?=tgl_indo($e[ditgl_rev15]);?></td></tr>  
    
    <tr><td>Tanggal Review 1 </td><td>: <?=tgl_indo($e[ditgl_review1]);?></td></tr>
    <tr><td>Tanggal Review 2 </td><td>: <?=tgl_indo($e[ditgl_review2]);?></td></tr>
    <tr><td>Tanggal Review 3 </td><td>: <?=tgl_indo($e[ditgl_review3]);?></td></tr>
<?
/*
    <tr><td>File Dokumen </td><td>: <a title='File Dokumen' href='dok/<?=$e[jenisdok];?>/<?=$e[difile];?>' target='_blank'>Klik Disini </a></td></tr>

<tr><td><font color=red>Password PDF</font></td><td>: <font color=red><?=$e[pass];?></font></td></tr>
<tr><td>File Dokumen </td><td>: <a title='File Dokumen' href='fdok/index1.php?id=<?=$e[suid];?>' target='_blank'>Klik Disini </a></td></tr>

 <tr><td>File Khusus MR </td><td>: <a title='File Dokumen' href='fdok/src/index1.php?id=<?=$e[suid];?>' target='_blank'>File Revisi Terbaru </a>| <a title='File Dokumen' href='fdok/src/index.php?id=<?=$e[suid];?>' target='_blank'>File Revisi Sebelumnya (Obsolete) </a></td></tr>

if($_SESSION[cv]==0 OR $_SESSION[cv]==1) { ?>
    <tr><td>File Khusus MR </td><td>: <a title='File Dokumen' href='dok/<?=$e[jenisdok];?>/<?=$e[difile];?>' target='_blank'>File Revisi Terbaru </a>| <a title='File Dokumen' href='fdok/<?=$e[difile1];?>' target='_blank'>File Revisi Sebelumnya (Obsolete) </a></td></tr>
<? } */?>   

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
/*<iframe src="fdok/index1.php?id=<?=$e[suid];?>" width=100% height=500></iframe>*/
?>
	</strong></td></tr>
	</table>
	<br></strong>
	<table>
    <tr><td align=top><b>Dokumen PDF :</b></td><td></td></tr>
</table>

<!--<iframe src="dok/web/viewer.html?file=/dok/<?php //echo $e['jenisdok']?>/<?php //echo $e['difile'] ?>" width=100% height=500></iframe>-->
<?php
$edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM dinter WHERE suid='$_GET[id]'");
    $r = mysqli_fetch_array($edit);

    $pdfFile = dirname(__DIR__ ) . "/$r[jenisdok]/$r[difile]";
    ?>
    Nomor Jenis Dokumen : <?php echo isset($r['jenisdok']) ? $r['jenisdok'] : 'Data tidak tersedia'; ?>

    <?php
 if (file_exists($pdfFile)) {
        ?>
        <iframe src="dok/web/viewer.html?file=/dok/<?php echo $e['jenisdok']?>/<?php echo $e['difile'] ?>" width=100% height=500></iframe>
        <?php
    } else {
        ?>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Maaf</h5>
            <p class="card-text">Tidak dapat menampilkan PDF <?=$e[jenisdok];?> <?php echo $e['difile']; ?> karena data tidak ada pada sistem.</p>
        </div>
    </div><?
        // echo "<center>Tidak dapat menampilkan PDF ".$e['jenisdok']." ".$e['difile']." karena data tidak ada Pada sistem.</center>";
    }?>
<!--<iframe src="dok/web/viewer.html?file=old_index1.php?id=<?php //echo $e[suid];?>" width="100%" height="500"></iframe>-->
<!--<iframe src="dok/web/viewerDownload.html?file=/dok/<?php //echo $e['jenisdok']?>/<?php //echo $e['difile'] ?>" width=100% height=500></iframe>-->

<?php /*<iframe src="dok/<?=$e[jenisdok];?>/<?=$e[difile];?>" width=100% height=500></iframe> */ ?>


<br />
<legend>Penerima Dokumen :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<tr>
		<td>Nama</td>
		<td>Jabatan</td>
	</tr>
</thead>
<?php
	// Inisialisasi counter $j
	$j = 0;

// 	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cIdjab, a.cFoto, a.bagian, b.* FROM users a
// 						LEFT JOIN dsin b ON b.cId=a.cId
// 						WHERE b.suid='$_GET[id]' ORDER BY b.suid ASC");
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cIdjab, a.cFoto, a.bagian, b.* FROM users a
						LEFT JOIN disin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.suid ASC");
        // $data = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
        // $psn = mysql_query("SELECT DISTINCT a.cUser, a.cNama, a.cJabatan, a.cIdjab, a.cFoto, a.bagian, b.tgl_baca, b.copyke 
        //                     FROM dister ds
        //                     INNER JOIN disin b ON b.suid = ds.suid_dinter
        //                     LEFT JOIN users a ON a.cId = b.cId
        //                     WHERE ds.suid_dinter = '$data[suid_dinter]'
        //                     GROUP BY a.cId
        //                     ORDER BY b.copyke ASC");
                    
	$psn1 = mysql_query("SELECT tgl_bls FROM dsin WHERE suid='$_GET[id]'");
	
	while ($t = mysql_fetch_array($psn)){
		$j++; // Tambah counter setiap ada data baru

		// Cek apakah ada foto atau tidak
		$foto = empty($t['cFoto']) ? "foto/none.jpg" : "foto/{$t['cFoto']}";

		echo "<tr>
				<td>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='{$t['cNama']}'>
					{$t['cNama']} ({$t['cIdjab']})
				</td>
				<td>{$t['cJabatan']}</td>
				<td>{$t['bagian']}</td>
			 </tr>";
	}
?>
</table>
<br />
<big>Jumlah Penerimas : <?= $j; ?> Orang</big>


<br><br>
<? /* echo"<a href='home1.php?pages=dinter1&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak</a>";
echo"<a href='home1.php?pages=dinter2&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i>QRCode</a>";

*/?>
<?
}else{
?>

<div class="span12">
	<?php
	if($_SESSION[cv]=='1' OR $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1000' OR $_SESSION[cv]=='50') {
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=dinter&act=tambah'">Tambah Dokumen Manual</button> <button class="btn-info btn-large" target=_blank onclick="window.location.href='home.php?pages=dinter&act=lengkap'">Registrasi Dokumen Terkendali</button>
	<button class="btn-info btn-large" target=_blank onclick="window.location.href='home.php?pages=dinter&act=rdtcc'">Registrasi Dokumen Terkendali CC</button>
	<br /><br />

<form method="post" action="?pages=dintercari" enctype="multipart/form-data" class="form-horizontal">
<b>Cari Kode/Judul Dokumen : </b>
<input class="input-large focused" type="text" name="judul" value="">
<select id="user" class="chzn-select span5" name="user" required="required">
            	<option value=0><b>Pilih/Cari Dokumen di User-Bagian</b></option>
            <?php
				$vc = mysql_query("SELECT * FROM users ORDER BY cId DESC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama]-$dvc[cJabatan]</option>";
				}
			?>
           	</select>
<input type=submit value=Cari />
</form>

	<?php
	$dist = mysql_query("SELECT * FROM dinter ORDER BY dikodok DESC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Kode</th>
			<th>Judul</th>
            <!--<th>Penerima</th>-->
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		while($s = mysql_fetch_array($dist)) {

		echo"   <tr>
                <td>$s[dikodok]</td>
				<td>$s[dijudok]</td>
                ";
                
				// <td><a href='?pages=dister&act=lp&id=$s[suid]' class='btn btn-info'>List</a></td>
				// <td><a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>List</a></td>
                //<td><a href='dok/web/viewer.html?file=index1.php?id=$s[suid]'class='btn btn-info' target=_blank>File</a></td>
                // 	<a href='include/dinter/aksi_dinter.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>  
				
				echo "
				 
				<td class='center'>
			    <a href='javascript:void(0);' onClick=\"hapusDinter('$s[suid]')\"> <i class='icon-trash'></i></a>
				<a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a> 
				<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'> I</a>
				<a href='home.php?pages=usulandok&act=tambah&id=$s[suid]' title='Buat Usulan Dokumen' class='btn btn-info'> U</a>
				<a href='home.php?pages=dister&act=tambah2&id=$s[dikodok]' title='Buat Distribusi Dokumen' class='btn btn-info'> D</a>
				</td>
				</tr>";	
		}
	}elseif($_SESSION[cv]==1103 OR $_SESSION[cv]==1104 OR $_SESSION[cv]==1107){
    	   ?> 
    
        <form method="post" action="?pages=dintercari" enctype="multipart/form-data" class="form-horizontal">
        <b>Cari Kode/Judul Dokumen : </b>
        <input class="input-large focused" type="text" name="judul" value="">
        <select id="user" class="chzn-select span5" name="user" required="required">
                    	<option value=0><b>Pilih/Cari Dokumen di User-Bagian</b></option>
                    <?php
        				$vc = mysql_query("SELECT * FROM users ORDER BY cId DESC");
        				while ($dvc=mysql_fetch_array($vc)){
        	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama]-$dvc[cJabatan]</option>";
        				}
        			?>
                   	</select>
        <input type=submit value=Cari />
        </form>
        
        	<?php
        	$dist = mysql_query("SELECT * FROM dinter ORDER BY dikodok DESC");
            ?>	
        			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
        	<thead>
        		<tr>
        			<th>Kode</th>
        			<th>Judul</th>
                    <th class='center' width=25%>Aksi</th>
        		</tr>
        	</thead>
        	<tbody>
        		
        		<?
        		while($s = mysql_fetch_array($dist)) {
        
        		echo"   <tr>
                        <td>$s[dikodok]</td>
        				<td>$s[dijudok]</td>
                     
        				<td class='center'>
        				<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'> Detail</a>
        				</td>
        				</tr>";	
        		}
    	
    	}elseif($_SESSION[cv]==1108){
    	   ?> 
    
        	<?php
                // 1. Daftar kode yang diambil dari gambar
                $filter_kode = array(
                    'PC-01-0139',
                    'PR-01-2003',
                    'PC-02-0058',
                    'PR-02-3008',
                    'PC-01-0144',
                    'PR-01-1076',
                    'PR-01-2035',
                    'PC-03-0018',
                    'PR-03-2010'
                );
            
                // 2. Menggabungkan array menjadi string untuk query SQL: 'KODE1','KODE2',...
                $sql_in = "'" . implode("','", $filter_kode) . "'";
            
                // 3. Jalankan Query dengan filter WHERE IN
                // Query sebelumnya: SELECT * FROM dinter ORDER BY dikodok DESC
                $dist = mysql_query("SELECT * FROM dinter WHERE dikodok IN ($sql_in) ORDER BY dikodok DESC");
            ?>
            
        			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
        	<thead>
        		<tr>
        			<th>Kode</th>
        			<th>Judul</th>
                    <th class='center' width=25%>Aksi</th>
        		</tr>
        	</thead>
        	<tbody>
        		
        		<?
        		while($s = mysql_fetch_array($dist)) {
        
        		echo"   <tr>
                        <td>$s[dikodok]</td>
        				<td>$s[dijudok]</td>
                     
        				<td class='center'>
        				<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title='Detail Info Dokumen' class='btn btn-info'> Detail</a>
        				</td>
        				</tr>";	
        		}
    	
    	}
    	
    	
    	else{
	    
	}
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
?>
</div><!--/span12-->
</div><!--/block-content-->
<script>
document.addEventListener('keydown', function(event) {
    if (event.ctrlKey && event.keyCode === 80) {
        event.preventDefault();
        // Tampilkan pesan atau lakukan tindakan lain
        alert("Pencetakan tidak diizinkan.");
    }
});
 
     function hapusDinter(suid) {
        // Prompt untuk alasan penghapusan
        let alasan = prompt("Masukkan alasan penghapusan data:");
        if (alasan === null || alasan.trim() === "") {
            alert("Penghapusan dibatalkan.");
            return;
        }
    
        // Redirect ke aksi PHP dengan alasan sebagai parameter
        window.location.href = `include/dinter/aksi_dinter.php?act=hapus&id=${suid}&alasan=${encodeURIComponent(alasan)}`;
    }
</script>