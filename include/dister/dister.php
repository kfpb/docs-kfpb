<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Distribusi & Info Penarikan Dokumen</div>
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


$query = "SELECT max(dinmr) as max_no FROM dister WHERE dinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("DD-%04s/$bln", $noUrut);

?>
<form method="post" action="include/dister/aksi_dister.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Distribusi Dokumen</legend>
<?
if($_SESSION[cv]=='0' OR $_SESSION[cv]=='1' OR $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1000'){
?>
  <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$tgl1;?>" required="required"><?php echo $tgl; ?></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select span6" name="pengirim" >
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
		<label class="control-label" for="kodedok">Kode Dokumen <span style="color:red;">*</span></label>
        <div class="controls"><input class="input-large focused span6" id="kodedok" type="text" name="dikodok" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi <span style="color: red;">*</span> </label>
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
        <div class="controls"><input class="input-xxlarge focused span6" id="juduldok" type="text" name="dijudok" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Efektif</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_brlk" required="required"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Maks. Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_review" required="required"> 3 Tahun dari tanggal efektif (bisa diketik)</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Info Distribusi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
        	<textarea name="ket" id="editor">
[Jika Dokumen Baru]
Kami informasikan bahwa terdapat <b>DOKUMEN BARU</b> yang telah selesai disahkan,<br>
Jika <b>memerlukan dokumen hardcopy Controlled</b> untuk arsip lapangan dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b><br>
<br><br>
[Jika Dokumen Perubahan]
Kami informasikan bahwa terdapat <b>DOKUMEN REVISI TERBARU</b> yang telah selesai disahkan,<br>
Dokumen lama revisi sebelum-nya <b>HARUS DITARIK/DIKEMBALIKAN & DIMUSNAHKAN</b>,<br> 
Informasikan <b>HASIL PENARIKAN/PENGEMBALIAN/PEMUSNAHAN DOKUMEN LAMA</b> melalui fasilitas <b>BERITA ACARA DOKUMEN</b> ke Spv. Dokumentasi<br>
Jika <b>memerlukan dokumen hardcopy Controlled</b> dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b><br>
<br>
Sosialisasikan dokumen secara manual ke jajaran anda.
<br><br>
[Jika Dokumen Dihapus]
Kami informasikan bahwa terdapat <b>DOKUMEN YANG DIHAPUS/DIHILANGKAN</b>,<br>
Dokumen HARUS DITARIK/DIKEMBALIKAN & DIMUSNAHKAN serta dipastikan tidak dipakai lagi,<br> 
Informasikan <b>HASIL PENARIKAN/PENGEMBALIAN/PEMUSNAHAN DOKUMEN</b> melalui fasilitas <b>BERITA ACARA DOKUMEN</b> ke Spv. Dokumentasi <br>
<br>
Terima kasih.<br>
Spv. Dokumentasi<br>
			
			</textarea>
			</div>
        </div>
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Upload dokumen<span style="color: red;">*</span></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" required> Max. 150 MB<br>
        	<small>(Jika lampiran lebih dari 2, scan/satukan jadi 1 file PDF/ZIP)</small>
        </div>
    </div>
    
    

            
    <div class="control-group">
    	<label class="control-label" for="fileInput">Tanda <span style="color: red;">*</span> Wajib Diisi</label>
        
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
}elseif($_GET['act']=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
?>
<form method="post" action="include/dister/aksi_dister.php?act=edit&id=<?=$e[suid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Distribusi Dokumen</legend>
	<?
if($_SESSION[cv]=='0' OR $_SESSION[cv]=='1' OR $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1000'){
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
		<label class="control-label" for="tgl_brlk">Tanggal Efektif</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="text" name="tgl_brlk" required="required" value="<?=$e[ditgl_brlk];?>" ></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_brlk" type="hidden" name="tgl_review" required="required" value="<?=$e[ditgl_review];?>" ><?=$e[ditgl_review];?></div>
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
		<label class="control-label" for="tgl_review">Tanggal Selesai Penarikan</label>
        <div class="controls"><input class="input-small datepicker" id="ditgl_selesaipenarikan" type="text" name="ditgl_selesaipenarikan" required="required" value="<?=$e[ditgl_selesaipenarikan];?>" ></div>
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
}elseif($_GET['act']=="tambah2"){
$tgl = date("Y-m-d");
$tglthn = date("Y") + 3; // Tahun saat ini ditambah 3
$tglbln = date("-m-d"); // Bagian bulan dan tanggal
$tgl1 = $tglthn . $tglbln; // Kombinasi tahun + bulan + tanggal

// Query untuk mengambil data awal
if (empty($_GET['suid'])) {
    $e = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='" . mysql_real_escape_string($_GET['id']) . "' ORDER BY suid DESC LIMIT 1"));

} else {
    $e = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='" . mysql_real_escape_string($_GET['id']) . "' AND suid='" . mysql_real_escape_string($_GET['suid']) . "' ORDER BY suid DESC LIMIT 1"));
}

// Cek data revisi sebelumnya
$direv = isset($e['direv']) ? (int)$e['direv'] : 0; // Pastikan nilai direv sebagai integer
$rev_before = $direv - 1; // Hitung revisi sebelumnya

// Query untuk mendapatkan revisi sebelumnya, memastikan kesesuaian format angka atau dua digit
$query = sprintf(
    "SELECT * FROM udokumen WHERE ukodok='%s'",
    mysql_real_escape_string($_GET['id']) // Pastikan ID aman dari injeksi
);

$ez = mysql_fetch_array(mysql_query($query));
// var_dump($direv);

// Validasi hasil query revisi
if (!$ez) {
    // Data tidak ditemukan
    $rev = '-';
    $kodok = '-';
    $revv = '-'; // Revisi tidak ada, nilai dimulai dari 0
} elseif (empty($ez['udrev']) || $ez['udrev'] === '-' || !is_numeric($ez['udrev'])) {
    // Data ditemukan tetapi udrev tidak valid
    if (isset($ez['udrev']) OR $ez['udrev'] === '0') {
        // Jika udrev bernilai 0
        $rev = '0';
        $kodok = isset($e['dikodok']) ? $e['dikodok'] : '-';
        $revv = 1; // Revisi dimulai dari 1 jika diperlukan
        // var_dump(1);
    } else {
        // Jika udrev tidak valid
        $rev = '-';
        $kodok = '-';
        $revv = '-'; // Tetap 0 karena tidak ada revisi valid
        // var_dump(2);
    }
} else {
    // Data valid ditemukan dan udrev bernilai numerik
    $rev = (int)$ez['udrev']; // Pastikan nilai udrev sebagai integer
    $revv = $rev; // Tambahkan 1 untuk revisi berikutnya
    $kodok = isset($e['dikodok']) ? $e['dikodok'] : '-';
}

        $ditgl = "ditgl_rev";
        $dipost = $e['direv'];
        $tglrev = $ditgl . $dipost;
        
        
    $tglthnreview = date("Y", strtotime($e[$tglrev])) + 3; // Tahun saat ini ditambah 3
    $tglblnreview = date("-m-d", strtotime($e[$tglrev])); // Bagian bulan dan tanggal
    $tglmaxreview = $tglthnreview . $tglblnreview; // Kombinasi tahun + bulan + tanggal

// var_dump($tglblnreview);
        
    
?>

<form method="post" action="include/dister/aksi_dister.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Distribusi Dokumen</legend>

	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$tgl;?>" required="required"><?php //echo tgl_indo($tgl); ?></div>
    </div>

	<div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='2' selected>Dokumentasi</option>
		</select>"
		;
         ?> 
        </div> 
    </div>

<div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen</label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select" name="jenisdok" required="required">
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
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="dikodok" required="required" value="<?=$e[dikodok];?>" readonly></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi</label>
        <div class="controls"><input class="input-large focused" id="revisi" type="text" name="revisi" required="required" value="<?=$e[direv];?>"></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok1">Kode Dokumen Sebelum</label>
        <div class="controls"><input class="input-large focused" id="kodedok1" type="text" name="dikodok1" required="required" value="<?=$kodok;?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi Sebelum</label>
        <div class="controls"><input class="input-large focused" id="revisi1" type="text" name="revisi1" required="required" value="<?=$revv;?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="hidden" name="dijudok" required="required" value="<?=$e[dijudok];?>" readonly>
        <?=$e[dijudok];?></div>
        
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Efektif</label>
        <!--<div class="controls"><input class="input-large datepicker" id="tgl_brlk" type="hidden" name="tgl_brlk" required="required" value="<?php //echo $e[ditgl_brlk];?>" ><?php //echo tgl_indo($e[ditgl_brlk])?></div>-->
        <div class="controls"><input class="input-large datepicker" id="tgl_brlk" type="hidden" name="tgl_brlk" required="required" value="<?=$e[$tglrev];?>" ><?php echo tgl_indo($e[$tglrev])?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <!--<div class="controls"><input class="input-large datepicker" id="tgl_brlk" type="hidden" name="tgl_review" required="required" value="<?php //echo $e[ditgl_review];?>" ><?php //echo tgl_indo($e[ditgl_review])?></div>-->
        <div class="controls"><input class="input-large datepicker" id="tgl_brlk" type="hidden" name="tgl_review" required="required" value="<?=$tglmaxreview;?>" ><?php echo tgl_indo($tglmaxreview)?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Selesai Penarikan</label>
        <div class="controls"><input class="input-small datepicker" id="ditgl_selesaipenarikan" type="text" name="ditgl_selesaipenarikan" required="required" value="<?=$tgl;?>" ></div>
    </div>
      <div class="control-group">
    	<label class="control-label" for="ket">Info Distribusi <br>(Tekan Shift+Enter untuk pindah baris), <br>Ctrl+V untuk Paste</label>
        <div class="controls">
        	<textarea name="ket" id="editor">
[Jika Dokumen Baru]
Kami informasikan bahwa terdapat <b>DOKUMEN BARU</b> yang telah selesai disahkan,<br>
Jika <b>memerlukan dokumen hardcopy Controlled</b> untuk arsip lapangan dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b><br>
<br><br>
[Jika Dokumen Perubahan]
Kami informasikan bahwa terdapat <b>DOKUMEN REVISI TERBARU</b> yang telah selesai disahkan,<br>
Dokumen lama revisi sebelum-nya <b>HARUS DITARIK/DIKEMBALIKAN & DIMUSNAHKAN</b>,<br> 
Informasikan <b>HASIL PENARIKAN/PENGEMBALIAN/PEMUSNAHAN DOKUMEN LAMA</b> melalui fasilitas <b>BERITA ACARA DOKUMEN</b> ke Spv. Dokumentasi<br>
Jika <b>memerlukan dokumen hardcopy Controlled</b> dapat mengajukan di Menu Permohonan <b>Copy Dokumen</b><br>
<br>
Sosialisasikan dokumen secara manual ke jajaran anda.
<br><br>
[Jika Dokumen Dihapus]
Kami informasikan bahwa terdapat <b>DOKUMEN YANG DIHAPUS/DIHILANGKAN</b>,<br>
Dokumen HARUS DITARIK/DIKEMBALIKAN & DIMUSNAHKAN serta dipastikan tidak dipakai lagi,<br> 
Informasikan <b>HASIL PENARIKAN/PENGEMBALIAN/PEMUSNAHAN DOKUMEN</b> melalui fasilitas <b>BERITA ACARA DOKUMEN</b> ke Spv. Dokumentasi<br>
<br>
Terima kasih.<br>
Spv. Dokumentasi<br>
			</textarea>
			</div>
        </div>
        
       
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Upload dokumen<span style="color: red"><b>*</b></span></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 150 MB<br>
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
}elseif($_GET['act']=="lp1"){
$cc = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
?>
<fieldset>
<legend>List Penerima Dokumen</legend>

		 <br><form method="post" action="include/dinter/aksi_dinter.php?act=lp1&id=<?=$cc[suid_dinter];?>" enctype="multipart/form-data" class="form-horizontal">
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

<?php
}elseif($_GET['act']=="lp(backup)"){
?>

<?php
//include "include/koneksi.php";
?>
<link href="assets/chosen-bootstrap/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
  var config = { 
    '.chzn-select' : {search_contains : true}, 
    '.chzn-select-deselect'  : {allow_single_deselect:true}, 
    '.chzn-select-no-single' : {disable_search_threshold:10}, 
    '.chzn-select-no-results': {no_results_text:'Oops, Tidak ditemukan!'}, 
    '.chzn-select-width'      : {width:"95%"} 
  } 
  for (var selector in config) { 
    $(selector).chosen(config[selector]); 
  } 

  $(document).ready(function() { 
    // Event untuk tombol "Tambah Penerima" 
    $("#tambahPenerima").click(function() { 
      tambahPenerima(); 
    }); 

    // Event untuk tombol "Hapus" di setiap baris 
      $(document).on("click", ".hapusPenerima", function(event) { 
        event.preventDefault(); 
        let row = $(this).closest("tr"); 
        let cId = row.find("select[name='disin[]']").val(); 
        let form = row.find("form"); // Ambil form terdekat 
        let suid_dinter = form.find("input[name='suid_dinter']").val(); // Ambil suid_dinter dari hidden input 
    console.log(cId); 
        if (confirm("Apakah Anda yakin ingin menghapus penerima ini?")) { 
          $.ajax({ 
            url: "include/dister/aksi_dister.php?act=lp&hapus=true&cId=" + cId + "&suid_dinter=" + suid_dinter,  // Sertakan suid_dinter di URL 
            type: "GET", 
            success: function(response) { 
              if (response === "success") { 
                row.remove(); 
                alert("Penerima dihapus!"); 
              } else { 
                alert("Gagal menghapus penerima."); 
              } 
            }, 
            error: function(xhr, status, error) { 
              console.error(error); 
              alert("Terjadi kesalahan saat menghapus data."); 
            } 
          }); 
        } 
      }); 
  }); 

    let counter = <?php
        $data=mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
        $jumlahPenerima = mysql_num_rows(mysql_query("SELECT * FROM disin WHERE suid='$data[suid_dinter]'"));
        echo $jumlahPenerima; // Ditambah 1 untuk penerima berikutnya
    ?>;
  console.log($jumlahPenerima);
    function tambahPenerima() { 
      counter++; 
      const newRow = ` 
        <tr> 
          <td>${counter}</td> 
          <td> 
            <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal"> 
              <input type="hidden" name="copyke" value="${counter}"> 
              <select id="cId" name="cId" class="chzn-select span6"> 
                <option value=0 selected>Pilih Nama/Jabatan</option> 
                <?php 
                $user_query = mysql_query("SELECT cId, cNama, cJabatan FROM users"); // Ambil semua user 
                while ($user_data = mysql_fetch_array($user_query)) { 
                  echo "<option value='$user_data[cId]'>$user_data[cJabatan] - $user_data[cNama]</option>"; 
                } 
                ?> 
              </select> 
              Jml Copy0: <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="1"> 
              <button class="btn btn-primary">Simpan</button> 
              <button type="button" class="btn btn-danger hapusPenerima">Hapus</button> 
            </form> 
          </td> 
        </tr> 
      `; 
      $("#tabelPenerima tbody").append(newRow); 
      $(".chzn-select").chosen(config['.chzn-select']); 
    } 

  function simpanPenerima(form, event) { 
    event.preventDefault(); // Mencegah form submit default 

    // Kode AJAX untuk mengirim data form ke aksi_dister.php 
    $.ajax({ 
      url: form.action, 
      type: form.method, 
      data: $(form).serialize(), 
      success: function(response) { 
        // Handle response dari server (misalnya menampilkan pesan sukses) 
        alert("Data penerima disimpan!"); 
      }, 
      error: function(xhr, status, error) { 
        // Handle error jika terjadi 
        console.error(error); 
        alert("Terjadi kesalahan saat menyimpan data."); 
      } 
    }); 
  } 
</script>

<fieldset>
<legend>List Penerima Dokumen Terkendali</legend>

<table id="tabelPenerima" class="table">
  <thead>
    <tr>
      <th>No. Kopi ke-</th>
      <th>Penerima</th>
      <th>Jumlah Kopi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no = 1; 
    $getdister = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
    // $cv = mysql_query("SELECT * FROM disin WHERE suid='$getdister[suid_dinter]' ORDER BY copyke ASC");
    	$data=mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$data[suid_dinter]')");
    while ($dcv=mysql_fetch_array($cv)):
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td>
        <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET['id'];?>" enctype="multipart/form-data" class="form-horizontal" onsubmit="simpanPenerima(this, event)">
          <input type="hidden" name="copyke" value="<?= $dcv['copyke']?>">
           <input type="hidden" name="suid_dinter" value="<?=$data['suid_dinter']?>">
          <select id="disin" name="disin" class="chzn-select span6">
            <option value=0 selected>Pilih Nama/Jabatan</option>
            <?php
            $user_query = mysql_query("SELECT cId, cNama, cJabatan FROM users"); // Ambil semua user
            while ($user_data=mysql_fetch_array($user_query)){
                var_dump($user_query);
              $selected = ($user_data['cId'] == $dcv['cId']) ? 'selected' : ''; // Set selected jika user sudah ada di database
              echo "<option value='$user_data[cId]' $selected>$user_data[cJabatan] - $user_data[cNama]</option>";
            }
            ?>
          </select>
          <input type="hidden" name="cId[]" value="<?=$dcv['cId']?>">
          Jml Copy1: <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<?= $dcv['jml_copy']?>">
          <button class="btn btn-primary">Simpan</button>
          <!--<button type="button" class="btn btn-danger hapusPenerima">Hapus</button>-->
        </form>
        <a href="include/dister/aksi_dister.php?act=hapuslp&cId=<?php echo $dcv['cId']?>&suid_dinter=<?php echo $data['suid_dinter']?> " onClick="return confirm('Yakin ingin menghapus??')">
            <button type="button" class="btn btn-danger">
                <i class='icon-trash'></i> Hapus
            </button>
        </a>
      </td>
    </tr>
    <?php endwhile; ?>
    <?php if(mysql_num_rows($cv) == 0): ?> 
    <tr>
      <td>1</td>
      <td>
        <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal" onsubmit="simpanPenerima(this, event)">
          <input type="hidden" name="copyke" value="1">
          <select id="disin" name="disin" class="chzn-select span6">
            <option value=0 selected>Pilih Nama/Jabatan</option>
            <?php
            $user_query = mysql_query("SELECT cId, cNama, cJabatan FROM users"); // Ambil semua user
            while ($user_data=mysql_fetch_array($user_query)){
              echo "<option value='$user_data[cId]'>$user_data[cJabatan] - $user_data[cNama]</option>";
            }
            ?>
          </select>
          Jml Copy2: <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="">
          <button class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger hapusPenerima">Hapus</button>
        </form>
      </td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>

<button id="tambahPenerima" class="btn">Tambah Penerima</button>
</fieldset>

<br>
<form method="post" action="include/dister/aksi_dister.php?act=lp2&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
      
    <label for="jabatan_filter">Filter Jabatan:</label>
<select id="jabatan_filter">
  <option value="">Semua Jabatan</option>
  <option value="manager">Asman</option>
  <option value="super">SPV</option>
  <option value="manager + super">Asman + SPV</option>
</select>

    </div><br>
    <label class="control-label" for="dsin">Penerima Dokumen:</label>
    <div class="controls">
     	<select multiple="multiple" id="disin" name="disin[]" class="chzn-select span8">
            	<?php
            	$data=mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$data[suid_dinter]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$data[suid_dinter]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
      <button type="button" class="chosen-toggle select">Pilih Semua</button>
      <button type="button" class="chosen-toggle deselect">Hapus Semua</button>
    <br>
    <div class="control-group">
      <div class="controls">
        <button class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
      </div>
    </div>
  </form>


<br>

<br>

<? }elseif($_GET['act']=="lp"){?>
<style>
    /* =========================================
       STYLE UNTUK MENYATUKAN TAMPILAN (CARD)
       ========================================= */

    /* 1. Wrapper Utama (Standard) */
    .widget-body-uniform {
        background-color: #ffffff;
        border: 1px solid #dcdcdc;
        border-top: 0;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border-radius: 0 0 4px 4px;
    }

    /* 2. Wrapper MODE LEBAR (Khusus LP) */
    /* Ini triknya: margin negatif menarik box keluar dari padding parent */
    .widget-body-uniform.wide {
        margin-left: -20px; 
        margin-right: -20px;
        padding: 20px 30px; /* Isi dalam lebih lega */
        border-left: 0;     /* Hilangkan garis pinggir biar seolah menyatu ke layar */
        border-right: 0;
        border-radius: 0;
    }

    /* Info Dokumen */
    .doc-info-section {
        border-bottom: 1px solid #eeeeee;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    
    .doc-row { margin-bottom: 8px; font-size: 13px; color: #333; }
    .doc-label { font-weight: bold; display: inline-block; width: 150px; color: #555; }

    /* Area Filter */
    .filter-section {
        background-color: #f9f9f9;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    /* Fix Chosen & Tabel */
    .chosen-container .chosen-drop { z-index: 99999 !important; border-bottom: 1px solid #aaa; }
    .chosen-container { width: 100% !important; }
    #tabelPenerima td { vertical-align: middle !important; overflow: visible !important; }
    .input-jml { width: 50px !important; text-align: center; margin: 0 !important; }
</style>

<link href="assets/chosen-bootstrap/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {

  // ==========================
  // LOGIC JAVASCRIPT
  // ==========================

  // Init Chosen
  $("#tabelPenerima .chzn-select").chosen({ search_contains: true, width: "100%", no_results_text: "Oops, Tidak ditemukan!" });
  $("#jabatan_filter").chosen({ search_contains: true, width: "100%", no_results_text: "Tidak ditemukan!" });

  // Fix Overflow (Supaya dropdown bisa keluar dari kotak)
  $('.widget-body-uniform').parents().each(function() {
      var el = $(this);
      if (!el.is('body') && !el.is('html')) { el.css('overflow', 'visible'); }
  });

  function updateNomorUrut() {
    $("#tabelPenerima tbody tr").each(function(index){ $(this).find("td:first").text(index + 1); });
  }

  function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    let regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    let results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  }

  // Tambah Data
  function tambahPenerima(cId = "", jabatan = "", nama = "") {
    let counter = $("#tabelPenerima tbody tr").length + 1;
    let suid_dinter = $("#tabelPenerima").attr("data-suid-dinter") || $("input[name='suid_dinter']").val();
    let suid = getUrlParameter('id');

    $.ajax({
      url: "include/dister/get_dister_userselect.php",
      type: "POST", dataType: "json",
      success: function(users) {
        let options = '<option value="0">Pilih Nama/Jabatan</option>';
        users.forEach(user => {
          let selected = (user.cId == cId) ? 'selected' : '';
          options += `<option value="${user.cId}" ${selected}>${user.cJabatan} - ${user.cNama}</option>`;
        });

        let newRow = `
          <tr class="penerima-row" style="overflow: visible;">
            <td style="text-align:center;">${counter}</td>
            <td style="overflow: visible;">
                <input type="hidden" name="copyke" value="${counter}">
                <input type="hidden" name="suid_dinter" value="${suid_dinter}">
                <input type="hidden" name="suid" value="${suid}">
                <input type="hidden" name="cId[]" value="${cId}">
                <input type="hidden" name="cId_user" value="${cId}">
                <select name="disin" class="chzn-select">${options}</select>
            </td>
            <td style="text-align:center;">
                <div style="display: flex; justify-content: center; gap: 5px;">
                    <input type="text" name="jml_copy" value="" class="input-jml" placeholder="0">
                    <button type="button" class="btn btn-danger btn-small hapusPenerimalp"><i class="icon-trash"></i> Hapus</button>
                </div>
            </td>
          </tr>
        `;
        $("#tabelPenerima tbody").append(newRow);
        $("#tabelPenerima tbody tr:last .chzn-select").chosen({ search_contains: true, width: "100%", no_results_text: "Oops, Tidak ditemukan!" });
        updateNomorUrut();
      },
      error: function(xhr, status, error) { console.error(error); }
    });
  }

  $("#tambahPenerima1").click(function() { tambahPenerima(); });
  
  $("#jabatan_filter").change(function() {
    let selectedJabatan = ($(this).val() || "").toLowerCase();
    if (selectedJabatan === "") return;
    $.ajax({
      url: "include/dister/get_userselect.php", type: "POST", data: { jabatan_filter: selectedJabatan }, dataType: "json",
      success: function(resp) {
        let users = (Array.isArray(resp)) ? resp : (resp && Array.isArray(resp.data) ? resp.data : []);
        users.forEach(user => {
          let exists = false;
          $(".penerima-row select[name='disin']").each(function() { if ($(this).val() == user.cId) exists = true; });
          if (!exists) tambahPenerima(user.cId, user.cJabatan, user.cNama);
        });
      }
    });
  });

  $("#simpanSemua").click(function() {
    let dataPenerima = [];
    $(".penerima-row").each(function() {
      let row = $(this);
      let suidDinterValue = row.find("input[name='suid_dinter']").val();
      let cIdValue = row.find("select[name='disin']").val();
      let jmlCopyValue = row.find("input[name='jml_copy']").val();
      let suidValue = row.find("input[name='suid']").val();
      let copyKeValue = row.find("input[name='copyke']").val();
      if (!suidDinterValue || !cIdValue || cIdValue == "0" || cIdValue == "") return;
      dataPenerima.push({ cId: cIdValue, jml_copy: jmlCopyValue, suid_dinter: suidDinterValue, suid: suidValue, copyke: copyKeValue });
    });

    if (dataPenerima.length === 0) { alert("Tidak ada data valid untuk disimpan."); return; }
    $.ajax({
      url: "include/dister/aksi_dister.php?act=simpansemuapenerima", type: "POST", data: { penerima: JSON.stringify(dataPenerima) }, dataType: "json",
      success: function(response) { (response.success) ? alert("Data berhasil disimpan!") : alert("Gagal menyimpan data."); }
    });
  });

  $("#hapusSemua").click(function() {
    if (confirm("Hapus semua penerima?")) {
      let suid_dinter = $("#tabelPenerima").attr("data-suid-dinter");
      $.ajax({
        url: "include/dister/aksi_dister.php?act=hapussemualist", type: "POST", data: { suid_dinter: suid_dinter }, dataType: "json",
        success: function(response) { if (response.success) { $("#tabelPenerima tbody").empty(); updateNomorUrut(); alert("Berhasil dihapus!"); } }
      });
    }
  });

  $(document).on("click", ".hapusPenerimalp", function(e) {
      e.preventDefault();
      let row = $(this).closest("tr");
      let cId = row.find("input[name='cId[]']").val();
      let suid_dinter = row.find("input[name='suid_dinter']").val();
      if (!cId || cId == "0") { row.remove(); updateNomorUrut(); return; }
      if (confirm("Hapus penerima ini?")) {
          $.ajax({
              url: "include/dister/aksi_dister.php?act=hapus_penerima", type: "POST", data: { cId: cId, suid_dinter: suid_dinter }, dataType: "json",
              success: function(res) { if (res.success) { row.remove(); updateNomorUrut(); } }
          });
      }
  });
  updateNomorUrut();
});
</script>

<?php
$suid = isset($_GET['id']) ? $_GET['id'] : '';
$data = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$suid'"));
?>

<div class="widget-body-uniform">

    <div class="doc-info-section">
        <div class="doc-row">
            <span class="doc-label">Nomor Dokumen</span> : <?= $data['dinmr']; ?>
        </div>
        <div class="doc-row">
            <span class="doc-label">Kode Dokumen</span> : <?= $data['dikodok']; ?>
        </div>
        <div class="doc-row">
            <span class="doc-label">Nama Dokumen</span> : <strong><?= $data['dijudok']; ?></strong>
        </div>
    </div>

    <div class="filter-section">
        <div class="row-fluid">
            <div class="span5">
                <label style="font-weight:bold; margin-bottom:5px;">Filter Jabatan</label>
                <select id="jabatan_filter" data-placeholder="Pilih Jabatan...">
                    <option value="">Semua Jabatan</option>
                    <option value="asisten">Asman</option>
                    <option value="visor">SPV</option>
                    <option value="gabungan">Asman + SPV</option>
                </select>
            </div>
            <div class="span7" style="text-align: right; padding-top: 25px;">
                <button id="tambahPenerima1" class="btn btn-primary"><i class="icon-plus"></i> Tambah Manual</button>
                <button id="simpanSemua" class="btn btn-success"><i class="icon-save"></i> Simpan</button>
                <button id="hapusSemua" class="btn btn-danger"><i class="icon-trash"></i> Reset</button>
            </div>
        </div>
    </div>

    <table id="tabelPenerima" class="table table-striped table-bordered table-hover" data-suid-dinter="<?= $data['suid_dinter']; ?>">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="75%">Penerima Dokumen</th>
                <th width="20%">Jumlah Copy & Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1; 
            $cv = mysql_query("
                SELECT DISTINCT a.cUser, a.cNama, a.cJabatan, b.copyke, b.cId, b.jml_copy
                FROM dister ds
                INNER JOIN disin b ON b.suid = ds.suid_dinter
                LEFT JOIN users a ON a.cId = b.cId
                WHERE ds.suid_dinter = '$data[suid_dinter]'
                GROUP BY a.cId
                ORDER BY b.copyke ASC
            ");
            while ($dcv = mysql_fetch_array($cv)): ?>
            <tr class="penerima-row" style="overflow: visible;">
                <td style="text-align:center;"><?= $no++; ?></td>
                <td style="overflow: visible;">
                    <input type="hidden" name="copyke" value="<?= $dcv['copyke'] ?>">
                    <input type="hidden" name="suid_dinter" value="<?= $data['suid_dinter'] ?>">
                    <input type="hidden" name="suid" value="<?= $data['suid'] ?>">
                    <input type="hidden" name="cId[]" value="<?= $dcv['cId'] ?>">
                    <input type="hidden" name="cId_user" value="<?= $dcv['cId'] ?>">
                    <select name="disin" class="chzn-select">
                        <option value="<?= $dcv['cId'] ?>" selected><?= $dcv['cJabatan'] ?> - <?= $dcv['cNama'] ?></option>
                    </select>
                </td>
                <td style="text-align:center;">
                    <div style="display: flex; justify-content: center; gap: 5px;">
                        <input type="text" name="jml_copy" value="<?= $dcv['jml_copy'] ?>" class="input-jml" placeholder="0">
                        <button type="button" class="btn btn-danger btn-small hapusPenerimalp" title="Hapus"><i class="icon-trash"></i> Hapus</button>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>
<?
}elseif($_GET['act']=="lp2"){
?>
<fieldset>
  <legend>List Penerima Dokumen</legend>

  <br>
  <form method="post" action="include/dister/aksi_dister.php?act=lp2&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
      
    <label for="jabatan_filter">Filter Jabatan:</label>
<select id="jabatan_filter">
  <option value="">Semua Jabatan</option>
  <option value="manager">Asman</option>
  <option value="super">SPV</option>
  <option value="manager + super">Asman + SPV</option>
</select>

    </div><br>
    <label class="control-label" for="dsin">Penerima Dokumen:</label>
    <div class="controls">
     	<select multiple="multiple" id="disin" name="disin[]" class="chzn-select span8">
            	<?php
            	$data=mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$data[suid_dinter]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$data[suid_dinter]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
      <button type="button" class="chosen-toggle select">Pilih Semua</button>
      <button type="button" class="chosen-toggle deselect">Hapus Semua</button>
    <br>
    <div class="control-group">
      <div class="controls">
        <button class="btn btn-primary">Generate Penerima Dokumen</button>
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
      </div>
    </div>
  </form>
</fieldset>
<br>
<b>Keterangan:</b><br> Jika penerima dokumen berubah, harus di edit manual juga di database dokumen.
<br><br><br><br><br><br><br>

</div>
</div>

<script>
$(document).ready(function() {
  let selectedValues = new Set(); // Menyimpan ID yang sudah dipilih

  function pilihSemuaTerfilter() {
    $("#disin option:visible").each(function() {
      $(this).prop("selected", true);
      selectedValues.add($(this).val());
    });
    $("#disin").trigger("chosen:updated");
  }

  function filterDanPilihSemua() {
    var selectedJabatan = $("#jabatan_filter").val().toLowerCase();
    $("#disin option").each(function() {
      var optionText = $(this).text().toLowerCase();
      var optionValue = $(this).val();

      if (selectedJabatan === "" || optionText.includes(selectedJabatan) || 
          (selectedJabatan === "manager + super" && (optionText.includes("manager") || optionText.includes("super")))) {
        $(this).show().prop("selected", true);
        selectedValues.add(optionValue);
      } else {
        $(this).hide().prop("selected", false);
        selectedValues.delete(optionValue);
      }
    });
    $("#disin").trigger("chosen:updated");
  }

  $(".chosen-toggle.select").click(function() {
    pilihSemuaTerfilter();
  });

  $(".chosen-toggle.deselect").click(function() {
    $("#disin option:visible").each(function() {
      $(this).prop("selected", false);
      selectedValues.delete($(this).val());
    });
    $("#disin").trigger("chosen:updated");
  });

  $("#jabatan_filter").change(function() {
    filterDanPilihSemua();
  });

  $("#disin").change(function() {
    $("#disin option:selected").each(function() {
      selectedValues.add($(this).val());
    });
  });
});


</script>



<br>

	
	
<br>

<?
}elseif($_GET['act']=="selesai"){
$tgl			 = date("Y-m-d");

$q=mysql_query("UPDATE dister SET ditgl_slesai = '$tgl'
										WHERE suid = '$_GET[id]'");
							   
							   
 if ($q){
	 echo "<script>window.alert('Tgl Selesai Distribusi telah di input');window.location=('../home.php?pages=dister')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
?>
<?php
}elseif($_GET['act']=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));
    $dok = mysql_query("SELECT * FROM dinter WHERE dikodok='$e[dikodok]'");
    $r    = mysql_fetch_array($dok);
	?>
<strong>
<legend>Detail Distribusi & Penarikan Dokumen </legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor Dist. </td><td>: <?=$e[dinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[ditgl]);?></td></tr>
    <tr><td>Jenis Dokumen</td><td>: <?=$efg[nama_jendok];?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
	<tr><td>Revisi</td><td>: <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
	<tr><td>Tanggal Efektif </td><td>: <?=tgl_indo($e[ditgl_brlk]);?></td></tr>
	<tr><td>Tanggal Maks. Review </td><td>: <?=tgl_indo($e[ditgl_review]);?></td></tr>
<?php /*<tr><td>Tanggal Selesai Dist. Manual </td><td>: <?=tgl_indo($e[ditgl_slesai]);?></td></tr>
 <tr><td>File Dokumen </td><td>: <a title="Lampiran" href="dok/<?=$r[jenisdok];?>/<?=$r[difile];?>" target=_blank>Klik Disini </a></td></tr>
    <tr><td><font color=red>Password Dokumen </td><td>: <?=$r[pass];?></font></td></tr> */ ?>
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

    <?php if($e['difile']!=null){
        if ($e['distatus'] != 'N') { ?>
        <iframe src="dok/web/viewer.html?file=/dok/<?php echo $e['jenisdok']?>/<?php echo $e['difile'] ?>" width=100% height=500></iframe>
         PDF1 <?=$e[jenisdok];?> <?php echo $e['difile']; ?>
        <?php } else { ?>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Perhatian</h5>
            <p class="card-text">Dokumen ini sudah obsolete. File PDF tidak dapat ditampilkan.</p>
        </div>
        </div>
        <?php }
    } else {
        if ($r['distatus'] != 'N') { ?>
         <iframe src="dok/web/viewer.html?file=/dok/<?php echo $r['jenisdok']?>/<?php echo $r['difile'] ?>" width=100% height=500></iframe>
         PDF <?=$r[jenisdok];?> <?php echo $r['difile']; ?>
        <?php } else { ?>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Perhatian</h5>
            <p class="card-text">Dokumen ini sudah obsolete. File PDF tidak dapat ditampilkan.</p>
        </div>
        </div>
        <?php }
    } ?>
 
<br />
<legend>Distribusi Ke :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<tr>
		<td>No</td>
		<td>Nama</td>
		<td width="30%">Bagian/Jabatan</td>
		<td>Tanggal Dibaca/Terima</td>
	</tr>
</thead>
<?php
// Ambil data dari tabel dister berdasarkan suid yang dikirimkan via GET
$getdister = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$_GET[id]'"));

// Inisialisasi jumlah penerima
$j = 0;

// Query untuk mendapatkan data unik tanpa duplikasi
$psn = mysql_query("SELECT DISTINCT a.cUser, a.cNama, a.cJabatan, a.cIdjab, a.cFoto, a.bagian, b.tgl_baca, b.copyke 
                    FROM dister ds
                    INNER JOIN disin b ON b.suid = ds.suid_dinter
                    LEFT JOIN users a ON a.cId = b.cId
                    WHERE ds.suid_dinter = '$getdister[suid_dinter]'
                    GROUP BY a.cId
                    ORDER BY b.copyke ASC");

// Looping untuk menampilkan data
while ($t = mysql_fetch_array($psn)) {
    $j++; // Tambah jumlah penerima setiap looping

    // Tentukan foto pengguna
    $foto = (!empty($t['cFoto'])) ? "foto/{$t['cFoto']}" : "foto/none.jpg";

    echo "<tr>
            <td><center>{$t['copyke']}</center></td>
            <td>
                <img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='{$t['cNama']}'>
                {$t['cNama']}
            </td>
            <td>{$t['cJabatan']}</td>
            <td>";
    
    // Cek apakah tanggal baca kosong atau bernilai default
    if (empty($t['tgl_baca']) || $t['tgl_baca'] == '0000-00-00') {
        echo "Belum";
    } else {
        echo tgl_indo($t['tgl_baca']);
    }

    echo "</td></tr>";
}
?>
</table>
<br />
<big>Jumlah Penerima : <?= $j; ?> Orang</big>


<br><br>
<? 
echo"<a href='home1.php?pages=dister1&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak Distribusi</a>";
echo"<a href='home1.php?pages=dister1&act=print1&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i> Cetak Penarikan</a>";
// echo"<a href='home1.php?pages=dister2&act=print&id=$e[suid]' class='btn btn-info pull-right' target=_blank><i class='icon-print' ></i>QRCode</a>";
?>
<?
}else{
?>

<div class="span12">
	<?php
	if($_SESSION[cv]=='0' OR $_SESSION[cv]=='1' OR $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1000' OR $_SESSION[cv]=='50') {
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=dister&act=tambah'">Buat Distribusi Dokumen Manual</button><br /><br />
	
	<div>
     <form method="post" action='home1.php?pages=printdister' target=_blank>
        
        <div class="control-group">
    		<label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
            <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Export" />
    </form>
</div>
	<hr>
	
	<?php

	$dist = mysql_query("SELECT * FROM dister ORDER BY ditgl DESC");
     ?>
     
    <!-- <a href="include/dister/aksi_dister.php?act=acc_all"-->
    <!--   onclick="return confirm('Yakin akan kirim SEMUA distribusi dokumen yang belum ACC/Kirim?')"-->
    <!--   class="btn btn-danger">-->
    <!--   ACC/Kirim Massal-->
    <!--</a>-->


			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width=100%>
	<thead>
		<tr>
			<th></th>
			<th width=12%>Tgl Dist</th>
			<th width=12%>Tgl Selesai Penarikan</th>
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
                <td>$s[ditgl_selesaipenarikan]</td>
                <td>$s[dikodok]</td>
				<td>$s[direv]</td>
				<td>$s[dijudok]</td>";
				
    //         $getdister = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$s[suid]'"));
				// $cv = mysql_num_rows(mysql_query("SELECT * FROM disin WHERE suid='$s[suid]'"));
				
				
				// $dsin = mysql_num_rows(mysql_query("SELECT * FROM dsin WHERE suid='$getdister[suid_dinter]'"));
				$getdister = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$s[suid]'"));
                // var_dump($getdister['suid_dinter']);
                $psn = mysql_query("SELECT a.cUser, a.cNama, a.cIdjab, a.cJabatan, a.bagian, a.cFoto, b.tgl_baca, b.copyke 
                                    FROM users a
                                    LEFT JOIN disin b ON b.cId = a.cId
                                    WHERE b.suid = '$getdister[suid_dinter]'
                                    ORDER BY b.copyke ASC");
				// $cv = mysql_num_rows(mysql_query("SELECT * FROM disin WHERE suid='$s[suid]'"));
				// echo"$dsin";
				if ($_SESSION[cv]==0 or $_SESSION[cv]=='1' or $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1000')
					{
        				if ($psn==0){
        				    echo"<td><a href='?pages=dister&act=lp2&id=$s[suid]' class='btn btn-info'>Buat</a></td>";
        				}
        				else {
        				    echo"<td><a href='?pages=dister&act=lp&id=$s[suid]' class='btn btn-info'>Edit</a></td>";
        				}
					}else{
					    echo"<td>Tidak Memiliki Akses</td>";
					}
				// if ($s[distatus]=='N'){
					$cv = $_SESSION['cv'];
                    $akses_acc = [0, '1', '53', '1000', '1051', '1052', '1054', '1055', '1056', '1057', '1058', '1059'];
                    
                    if (in_array($cv, $akses_acc)) {
                        if ($cv == '53' || $cv == '1000') {
                            // User dengan hak ACC
                            if ($s['distatus'] == 'N') {
                                echo "<td><a href='include/dister/aksi_dister.php?act=acc&id={$s['suid']}'
                                            onClick=\"return confirm('Yakin akan kirim distribusi dokumen ini??')\"
                                            class='btn btn-info'>ACC/Kirim!</a></td>";
                            } else {
                                echo "<td><b>Sudah ACC</b></td>";
                            }
                        } else {
                            // User akses terbatas, tampilkan status kirim
                            if ($s['distatus'] == 'N') {
                                echo "<td><b>Belum ACC Spv</b></td>";
                            } else {
                                echo "<td><b>Sudah ACC</b></td>";
                            }
                        }
                    
                        // Aksi umum (hapus, edit, detail)
                        echo "<td class='center'>
                                <a href='include/dister/aksi_dister.php?act=hapus&id={$s['suid']}'
                                   onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> -
                                <a href='?pages=dister&act=edit&id={$s['suid']}'><i class='icon-edit'></i></a> -
                                <a href='home.php?pages=dister&act=detail&id={$s['suid']}' class='btn btn-info'>Detail</a>
                              </td>";
                    } else {
                        // Untuk user yang tidak termasuk $akses_acc
                        if ($s['distatus'] == 'N') {
                            echo "<td><b>Belum ACC/Kirim</b></td>";
                        } else {
                            echo "<td><b>Sudah ACC</b></td>";
                        }
                    }
	
				// 	}else{
    //             			echo "<td><b>Terkirim</b></td>";
    //             							echo "
    //             				<td class='center'><a href='?pages=dister&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
    //             				<a href='home.php?pages=dister&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'> Detail</a>
    //             				</td>
    //             				</tr>";	
    //             	}
	}
	}
	?>
	</tbody>
</table>

<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>DISTRIBUSI BELUM TERKIRIM KE PENERIMA DISTRIBUSI!</u>,<br>
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