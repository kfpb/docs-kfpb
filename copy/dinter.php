<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Buat Distribusi & Penarikan Dokumen (Khusus SPD-MR)</div>
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
<legend>Buat Distribusi Dokumen</legend>
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
          	 <select id="jenisdok" class="chzn-select span9" name="jenisdok" required="required">
            	<option>Pilih/Cari Jenis Dokumen</option>
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
        <div class="controls"><input class="input-small focused" id="revisi1" type="text" name="revisi" required="required"> Tulis 0,1,2.. jangan 00,01..</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="kodedok1">Kode Dokumen Sebelum</label>
        <div class="controls"><input class="input-large focused" id="kodedok1" type="text" name="dikodok1" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi1">Revisi Sebelum</label>
        <div class="controls"><input class="input-small focused" id="revisi1" type="text" name="revisi1" required="required"> Tulis 0,1,2.. jangan 00,01..</div>
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
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_review" required="required"> 3 Tahun dari tanggal berlaku (bisa diketik)</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Info Distribusi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
        	<textarea name="ket" id="editor">
[Jika Baru]
Kami informasikan bahwa terdapat <b>DOKUMEN BARU</b> yang telah selesai disahkan,<br>
Jika <b>memerlukan dokumen hardcopy Controlled</b> untuk arsip lapangan dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b><br>
User bagian bisa print langsung sendiri dokumen dengan status UNCONTROLLED<br>
<b>Sosialisasikan dokumen</b> secara manual atau secara elektronik, melalui INFO DOKUMEN (SPD-MR diberi tembusan).
<br><br>
[Jika Perubahan]
Kami informasikan bahwa terdapat <b>DOKUMEN REVISI TERBARU</b> yang telah selesai disahkan,<br>
Ringkasan perubahan...(Jika perlu)<br>
Dokumen yang <b>HARUS DITARIK/DIKEMBALIKAN & DIMUSNAHKAN</b> yaitu .... (KODE DOK/REV),<br> 
Data jumlah & pemilik dokumen untuk ditarik/dimusnahkan : ............., <br>
Informasikan <b>HASIL PENARIKAN/PENGEMBALIAN/PEMUSNAHAN DOKUMEN LAMA</b> melalui fasilitas <b>INFO DOKUMEN</b> ke SPD-MR<br>
Jika <b>memerlukan dokumen hardcopy Controlled</b> dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b><br>
User bagian bisa print langsung sendiri dokumen dengan status UNCONTROLLED<br>
<br>
Sosialisasikan dokumen secara manual atau secara elektronik, melalui <b>INFO DOKUMEN</b> (SPD-MR diberi tembusan).
<br><br>
[Jika Penghapusan]
Kami informasikan bahwa terdapat <b>DOKUMEN YANG DIHAPUS/DIHILANGKAN</b>,<br>
Alasan penghapusan...<br>
Dokumen HARUS DITARIK/DIKEMBALIKAN & DIMUSNAHKAN serta dipastikan tidak dipakai lagi,<br> 
Informasikan <b>HASIL PENARIKAN/PENGEMBALIAN/PEMUSNAHAN DOKUMEN</b> melalui fasilitas <b>INFO DOKUMEN</b> ke SPD-MR<br>
<br>
Terima kasih.<br>
SPD-MR<br>
			
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
?>
<form method="post" action="include/dinter/aksi_dinter.php?act=edit&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Distribusi Dokumen</legend>
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
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required" value="<?=$e[dikodok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi" required="required" value="<?=$e[direv];?>"></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok1">Kode Dokumen Sebelum</label>
        <div class="controls"><input class="input-large focused" id="kodedok1" type="text" name="dikodok1" required="required" value="<?=$e[dikodok1];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi Sebelum</label>
        <div class="controls"><input class="input-small focused" id="revisi1" type="text" name="revisi1" required="required" value="<?=$e[direv1];?>"></div>
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
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_review" required="required" value="<?=$e[ditgl_review];?>" ></div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Info Distribusi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
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
		<label class="control-label" for="tgl_slesai">Tanggal Selesai Dist</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_slesai" value="<?=$e[ditgl_slesai];?>" ></div>
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
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
?>
<form method="post" action="include/dinter/aksi_dinter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Distribusi Dokumen</legend>
	
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
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM jendok WHERE id_jendok='$e[id_jendok]'"));
				echo"<option value='$e[id_jendok]' selected>$v[nama_jendok]</option>";
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
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required" value="<?=$e[kode_dok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi" required="required" value=""></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok1">Kode Dokumen Sebelum</label>
        <div class="controls"><input class="input-large focused" id="kodedok1" type="text" name="dikodok1" required="required" value="<?=$e[kode_dok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi Sebelum</label>
        <div class="controls"><input class="input-small focused" id="revisi1" type="text" name="revisi1" required="required" value=""></div>
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
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_review" required="required" value="<?=$e[tgl_review];?>" ></div>
    </div>
	
      <div class="control-group">
    	<label class="control-label" for="ket">Info Distribusi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
        	<textarea name="ket" id="editor">
[Jika Baru]
Kami informasikan bahwa terdapat <b>DOKUMEN BARU</b> yang telah selesai disahkan,<br>
Jika memerlukan dokumen hardcopy Controlled dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b>,<br>
User dapat melakukan Print Sendiri Dokumen yang dimiliki (Uncontrolled) di Menu Registrasi Dokumen masing-masing,<br>
Sosialisasikan dokumen secara manual atau secara elektronik, melalui INFO DOKUMEN (SPD-MR diberi tembusan).<br>
Jika PDF terdapat password dicoba beberapa opsi : kfpbmr, spd, mr
<br><br>
[Jika Perubahan]
Kami informasikan bahwa terdapat <b>DOKUMEN REVISI TERBARU</b> yang telah selesai disahkan,<br>
Ringkasan perubahan...(Jika perlu)<br>
Dokumen yang harus ditarik & dimusnahkan yaitu .... (KODE/REV),<br> 
Data jumlah & pemilik dokumen untuk ditarik/dimusnahkan : ............., <br>
Informasikan hasil penarikan/pemusnahan melalui fasilitas <b>INFO DOKUMEN</b> ke SPD-MR<br>
Jika memerlukan dokumen hardcopy Controlled dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b>,
<br>
User dapat melakukan Print Sendiri Dokumen yang dimiliki (Uncontrolled) di Menu Registrasi Dokumen masing-masing,
<br>
Sosialisasikan dokumen secara manual atau secara elektronik, melalui <b>INFO DOKUMEN</b> (SPD-MR diberi tembusan).
<br>
Jika PDF terdapat password dicoba beberapa opsi : kfpbmr, spd, mr
<br><br>
[Jika Penghapusan]
Kami informasikan bahwa terdapat <b>DOKUMEN YANG DIHAPUS/DIHILANGKAN</b>,<br>
Alasan penghapusan...<br>
Dokumen harus ditarik & dimusnahkan serta tidak dipakai lagi,<br> 
Data jumlah & pemilik dokumen untuk ditarik/dimusnahkan : ............., <br>
Informasikan hasil penarikan/pemusnahan melalui fasilitas <b>INFO DOKUMEN</b> ke SPD-MR<br>
<br>
Terima kasih.<br>
SPD-MR<br>
			
			</textarea>
			</div>
        </div>
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Upload dokumen</label>
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



<fieldset>
<legend>List Penerima Dokumen Terkendali (Input satu per satu, Simpan)</legend>
	<div class="control-group">
        <div class="controls">
		<form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="1"><select id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=1)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=1)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>
				                      
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="2"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	
				<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=2)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=2)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="3"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=3)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=3)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="4"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=4)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=4)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="5"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=5)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=5)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="6"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=6)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=6)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="7"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=7)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=7)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="8"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=8)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=8)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="9"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=9)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=9)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="10"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=10)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=10)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="11"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=11)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=11)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="12"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=12)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=12)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="13"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
				<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=13)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=13)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="14"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=14)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=14)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="15"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=15)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=15)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="16"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=16)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=16)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="17"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=17)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=17)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="18"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=18)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=18)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="19"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=19)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=19)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="20"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=20)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=20)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="21"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=21)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=21)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="22"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=22)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=22)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="23"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=23)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=23)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="24"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=24)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=24)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="25"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=25)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=25)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 <div class="control-group">
        <div class="controls">
		<form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="26"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=26)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=26)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>
				                      
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="27"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=27)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=27)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="28"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=28)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=28)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="29"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=29)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=29)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="30"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=30)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=30)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="31"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=31)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=31)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="32"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=32)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=32)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="33"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=33)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=33)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="34"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=34)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=34)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="35"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=35)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=35)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="36"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=36)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=36)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="37"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=37)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=37)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="38"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=38)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=38)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="39"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=39)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=39)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="40"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=40)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=40)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="41"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=41)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=41)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="42"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=42)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=42)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="43"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=43)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=43)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="44"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=44)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=44)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="45"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=45)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=45)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="46"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=46)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=46)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="47"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=47)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=47)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="48"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=48)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=48)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="49"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=49)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=49)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="50"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=50)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=50)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="51"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=51)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=51)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="52"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=52)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=52)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="53"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=53)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=53)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="54"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=54)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=54)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="55"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=55)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=55)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="56"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=56)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=56)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="57"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=57)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=57)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="58"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=58)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=58)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="59"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=59)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=59)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dinter/aksi_dinter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="60"><select  id="dsin" name="dsin[]" class="chzn-select span6"><option selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' AND copyke=60)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]' and copyke=60)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                    
            </select><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
	</fieldset>

		 <br><form method="post" action="include/dinter/aksi_dinter.php?act=lp1&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
			 <label class="control-label" for="dsin">Data Semua Penerima Dokumen :</label>
			  <div class="controls">
			<select multiple="multiple" id="dsin" name="dsin[]" class="chzn-select span8">
			<?php
			$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>       
				</select>
             </div>   
 <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Hapus Semua Penerima Salinan</button> Ulangi lagi input salinan ke & penerima.
        </div>
    </div>
	
	<br><b>Keterangan :</b><br>
	Jika akan mencari/memilih grup bagian, kode untuk membantu pencarian :<br>
	- <b>PM</b> (Para Manager)<br>
	- <b>AM.</b> (Para Asman)<br>
	- <b>DPP</b> (Jajaran Pengendalian Proses Produksi AKA PPC)<br>
	- <b>GD</b> (Jajaran Penyimpanan/Pergudangan)<br>
	- <b>SPG</b> (Sub Bagian Pengadaan)<br>
	- <b>QA</b> (Asman dan Supervisor Fungsional Pemastian Mutu)<br>
	- <b>QC</b> (Jajaran Asman Pengawasan Mutu-QC)<br>
	- <b>SM</b> (Jajaran Sistem Mutu)<br>
	- <b>PP</b> (Jajaran Pengembangan Produk)<br>
	- <b>P1</b> (Jajaran Produksi 1)<br>
	- <b>P2</b> (Jajaran Produksi 2)<br>
	- <b>P3</b> (Jajaran Produksi 3)<br>
	- <b>SDMA</b> (Jajaran SDM & Akuntansi)<br>
	- <b>UK3L</b> (Jajaran Umum & K3L)<br>
	- <b>TP</b> (Jajaran Teknik & Pemeliharaan)<br>
<br>
<?
}elseif($_GET[act]=="selesai"){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE dinter SET ditgl_slesai = '$tgl'
										WHERE suid = '$_GET[id]'");
							   
							   
 if ($q){
	 echo "<script>window.alert('Tgl Selesai Distribusi telah di input');window.location=('../home.php?pages=dinter')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
?>
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dinter a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));
    $dok = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$e[dikodok]'");
    $r    = mysql_fetch_array($dok);
	?>
<strong>
<legend>Detail Distribusi Dokumen </legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[dinmr];?></td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$e[cNama];?> (<?=$e[cIdjab];?>)</strong></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[ditgl]);?></td></tr>
    <tr><td>Jenis Dokumen</td><td>: <?=$efg[nama_jendok];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Revisi</td><td>: <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
	<tr><td>Tanggal Berlaku </td><td>: <?=tgl_indo($e[ditgl_brlk]);?></td></tr>
	<tr><td>Tanggal Maks Review </td><td>: <?=tgl_indo($e[ditgl_review]);?></td></tr>
    <tr><td>Tanggal Selesai Dist Manual </td><td>: <?=tgl_indo($e[ditgl_slesai]);?></td></tr>
    <tr><td>File Dokumen </td><td>: <a title="Lampiran" href="distribusidok/<?=$e[difile];?>">Klik Disini </a> atau <a target=_blank href="../../m/master_pdf/<?=$r[id_jendok];?>/<?=$r[kode_dok];?>.pdf">Klik Disini (Alternatif)</a></td></tr>
	<tr><td>Dokumen yang ditarik/dimusnahkan</td><td>: <?=$e[dikodok1];?> - Revisi : <?=$e[direv1];?></td></tr>
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
    <tr><td align=top><b>Informasi Distribusi :</b></td><td></td></tr><tr><td><?=$e[diket];?></td></tr>
</table>
<iframe src="distribusidok/<?=$e[difile];?>" width=100% height=500></iframe>
<br />
<legend>Distribusi Ke :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<td>No</td>
	<td>Nama</td>
	<td width="30%">User</td>
	<td>Tanggal Dibaca/Terima</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cFoto, a.cJabatan,b.tgl_baca, b.copyke FROM users a
						LEFT JOIN dsin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.copyke ASC");
	$psn1 = mysql_query("SELECT tgl_bls FROM dsin WHERE suid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		echo "<tr>
		        <td><center>$t[copyke]</center></td>
				<td>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama] ($t[cJabatan])
				</td>
				<td>$t[cJabatan]</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 </tr>";
	}
	?>
</table>
<br />
<big>Jumlah Penerima : <?=$j;?> Orang</big>

<br><br>
<? echo"<a href='home1.php?pages=dinter1&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak</a>";
echo"<a href='home1.php?pages=dinter2&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i>QRCode</a>";
?>
<?
}else{
?>

<div class="span12">
	<?php
	if($_SESSION[levelcv]==0 OR $_SESSION[idj]==9) {
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=dinter&act=tambah'">Buat Distribusi Dokumen</button><br /><br />
	<?php
	}
	?>

	<?php
	if($_SESSION[levelcv]==0 OR $_SESSION[idj]==1){
		$dist = mysql_query("SELECT a.*, b.cNama FROM dinter a, users b WHERE a.dipengirim=b.cId ORDER BY ditgl DESC");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
		    <th></th>
			<th>Tgl Dist</th>
			<th>Kode</th>
			<th>Rev</th>
			<th>Judul</th>
            <th>Penerima</th>
            <th>Lamp.</th>
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
				<td><a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>List</a></td>
                <td><a href='distribusidok/$s[difile]'class='btn btn-info'>File</a></td>";
				if ($s[distatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>Terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/dinter/aksi_dinter.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'> D</a>
				<a href='home.php?pages=dinter&act=selesai&id=$s[suid]' title=Selesai' class='btn btn-info'> S</a>
				</td>
				</tr>";	
		}
	}
	else {
	$dist = mysql_query("SELECT * FROM dinter WHERE dipengirim=$_SESSION[cv] ORDER BY ditgl DESC");
     ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
		<tr>
			<th></th>
			<th width=12%>Tgl Dist</th>
			<th width=12%>Kode</th>
			<th width=3%>Rev</th>
			<th>Judul</th>
            <th width=10%>Penerima</th>
            <th width=10%>Lamp.</th>
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
				$cv = mysql_num_rows(mysql_query("SELECT * FROM dsin WHERE suid='$s[suid]'"));
				if ($cv==0 OR $s[distatus]=='N'){
				echo"<td><a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>Edit</a></td>";
				}
				else {
				echo"<td><a href='?pages=dinter&act=lp&id=$s[suid]' class='btn btn-info'>Edit</a></td>";
				}
				
                echo"<td><a href='distribusidok/$s[difile]' class='btn btn-info'>File</a></td>";
				if ($s[distatus]=='N'){
					if ($s[dipengirim]==$_SESSION[cv])
					{
			echo "<td><a href='include/dinter/aksi_dinter.php?act=acc&id=$s[suid]' onClick=\"return confirm('Yakin akan kirim distribusi dokumen ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/dinter/aksi_dinter.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=dinter&act=detail&id=$s[suid]' class='btn btn-info'>Detail</a>
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
				<td class='center'><a href='?pages=dinter&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=dinter&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'> Detail</a>
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
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>DISTRIBUSI BELUM ACC SPD-MR & TERKIRIM KE PENERIMA DISTRIBUSI!</u>,<br>
	(D) = Detail dan Print Lembar Distribusi, klik tombol D<br>
	(S) = Distribusi selesai dilakukan, klik tombol S
	</h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->