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
// var_dump($_GET['suid']);
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
    "SELECT * FROM udokumen WHERE ukodok='%s' AND (udrev='%d' OR udrev='%02d')",
    mysql_real_escape_string($_GET['id']), // Pastikan ID aman dari injeksi
    $rev_before,
    $rev_before
);

$ez = mysql_fetch_array(mysql_query($query));


// Validasi hasil query revisi
if (!$ez) {
    // Data tidak ditemukan
    $rev = '-';
    $kodok = '-';
    $revv = 0; // Revisi tidak ada, nilai dimulai dari 0
} elseif (empty($ez['udrev']) || $ez['udrev'] === '-' || !is_numeric($ez['udrev'])) {
    // Data ditemukan tetapi udrev tidak valid
    if (isset($ez['udrev']) && $ez['udrev'] === '0') {
        // Jika udrev bernilai 0
        $rev = '0';
        $kodok = isset($e['dikodok']) ? $e['dikodok'] : '-';
        $revv = 1; // Revisi dimulai dari 1 jika diperlukan
    } else {
        // Jika udrev tidak valid
        $rev = '-';
        $kodok = '-';
        $revv = 0; // Tetap 0 karena tidak ada revisi valid
    }
} else {
    // Data valid ditemukan dan udrev bernilai numerik
    $rev = (int)$ez['udrev']; // Pastikan nilai udrev sebagai integer
    $revv = $rev + 1; // Tambahkan 1 untuk revisi berikutnya
    $kodok = isset($e['dikodok']) ? $e['dikodok'] : '-';
}


// var_dump($revv);
?>

<form method="post" action="include/dister/aksi_dister.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Distribusi Dokumen</legend>

	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$tgl;?>" required="required"><?php echo tgl_indo($tgl); ?></div>
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
        <div class="controls"><input class="input-large focused" id="revisi" type="text" name="revisi" required="required" value="<?=$revv;?>" readonly></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok1">Kode Dokumen Sebelum</label>
        <div class="controls"><input class="input-large focused" id="kodedok1" type="text" name="dikodok1" required="required" value="<?=$kodok;?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi Sebelum</label>
        <div class="controls"><input class="input-large focused" id="revisi1" type="text" name="revisi1" required="required" value="<?=$rev;?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="dijudok" required="required" value="<?=$e[dijudok];?>" readonly></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_brlk">Tanggal Efektif</label>
        <div class="controls"><input class="input-large datepicker" id="tgl_brlk" type="hidden" name="tgl_brlk" required="required" value="<?=$e[ditgl_brlk];?>" ><?php echo tgl_indo($e[ditgl_brlk])?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Maks Review</label>
        <div class="controls"><input class="input-large datepicker" id="tgl_brlk" type="hidden" name="tgl_review" required="required" value="<?=$e[ditgl_review];?>" ><?php echo tgl_indo($e[ditgl_review])?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_review">Tanggal Selesai Penarikan</label>
        <div class="controls"><input class="input-small datepicker" id="ditgl_selesaipenarikan" type="text" name="ditgl_selesaipenarikan" required="required" value="<?=$e[ditgl_review];?>" ></div>
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
}elseif($_GET['act']=="lp"){
?>



<fieldset>
<legend>List Penerima Dokumen Terkendali (Input satu per satu, Simpan)</legend>
	<div class="control-group">
        <div class="controls">
		<form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="1"><select id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=1)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=1)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=1");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="2"><select  id="disin" name="disin" class="chzn-select span6"><option value=0  selected>Pilih Nama/Jabatan</option>
            	
				<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=2)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=2)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=2");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="3"><select  id="disin" name="disin" class="chzn-select span6"><option value=0  selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=3)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=3)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
             </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=3");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="4"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=4)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=4)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=4");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="5"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=5)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=5)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
             </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=5");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="6"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=6)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=6)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=6");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="7"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=7)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=7)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=7");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="8"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=8)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=8)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=8");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="9"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=9)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=9)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=9");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="10"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=10)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=10)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=10");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="11"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=11)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=11)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=11");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="12"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=12)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=12)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=12");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="13"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
				<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=13)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=13)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=13");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="14"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=14)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=14)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=14");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="15"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=15)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=15)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=15");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="16"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=16)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=16)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=16");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="17"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=17)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=17)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select>
            <? 	$cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=17");
                $dcv1=mysql_fetch_array($cv1); ?>
            Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="18"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=18)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=18)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=18"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="19"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=19)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=19)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=19"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="20"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=20)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=20)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=20"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="21"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=21)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=21)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=21"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="22"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=22)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=22)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=22"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="23"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=23)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=23)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=23"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="24"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=24)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=24)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=24"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="25"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=25)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=25)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=25"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 <div class="control-group">
        <div class="controls">
		<form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="26"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=26)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=26)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>
				                      
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=26"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="27"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=27)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=27)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=27"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		
	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="28"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=28)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=28)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=28"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="29"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=29)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=29)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=29"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="30"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=30)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=30)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=30"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="31"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=31)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=31)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=31"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="32"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=32)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=32)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=32"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="33"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=33)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=33)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=33"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="34"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=34)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=34)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=34"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="35"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=35)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=35)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=35"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="36"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=36)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=36)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=36"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="37"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=37)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=37)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=37"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="38"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=38)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=38)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=38"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="39"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=39)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=39)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=39"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="40"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=40)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=40)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=40"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="41"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=41)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=41)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=41"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="42"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=42)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=42)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=42"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="43"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=43)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=43)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=43"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="44"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=44)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=44)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=44"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="45"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=45)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=45)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=45"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="46"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=46)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=46)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=46"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="47"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=47)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=47)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=47"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="48"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=48)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=48)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=48"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="49"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=49)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=49)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=49"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="50"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=50)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=50)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=50"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="51"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=51)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=51)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=51"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="52"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=52)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=52)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=52"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="53"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=53)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=53)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=53"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="54"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=54)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=54)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=54"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="55"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=55)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=55)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=55"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="56"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=56)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=56)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=56"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="57"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=57)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=57)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=57"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="58"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=58)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=58)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=58"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="59"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=59)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=59)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=59"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
		 		 		 	    <div class="control-group">
           <div class="controls">
		   <form method="post" action="include/dister/aksi_dister.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
        	<input class="input-small focused" id="copyke" type="text" name="copyke" required="required" value="60"><select  id="disin" name="disin" class="chzn-select span6"><option value=0 selected>Pilih Nama/Jabatan</option>
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$_GET[id]' AND copyke=60)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]' and copyke=60)");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                    
            </select><? $cv1 = mysql_query("SELECT * FROM disin WHERE suid='$_GET[id]' AND copyke=60"); $dcv1=mysql_fetch_array($cv1); ?>Jml Copy  : <input class="input-small focused" id="jml_copy" type="text" name="jml_copy" value="<? echo"$dcv1[jml_copy]"; ?>"><button class="btn btn-primary">Simpan</button> 
			</form>
			 </div> 
         </div>
		 
	</fieldset>

		 <br><form method="post" action="include/dister/aksi_dister.php?act=lp1&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
			 <label class="control-label" for="disin">Data Semua Penerima Dokumen :</label>
			  <div class="controls">
			<select multiple="multiple" id="disin" name="disin[]" class="chzn-select span8">
			<?php
			$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>       
				</select>
             </div>   
 <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Hapus Semua Penerima Salinan</button> Ulangi lagi input salinan ke & penerima.
        </div>
    </div>
	</fieldset>
</form>


<br>
<?
}elseif($_GET['act']=="lp2"){
?>
<fieldset>
<legend>List Penerima Dokumen</legend>
<?php
            	$id = $_GET['id'];
            	$data = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$id'"));
            // 	var_dump($data['suid_dinter']);
				// $cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM dsin WHERE suid='$data[suid_dinter]')");
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$data[suid_dinter]')");
				
				// var_dump(mysql_fetch_array($cv));
				// $cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				?>
		 <br><form method="post" action="include/dister/aksi_dister.php?act=lp2&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
		    
			 <label class="control-label" for="dsin">Penerima Dokumen:</label>
			  <div class="controls">
			<select multiple="multiple" id="disin" name="disin[]" class="chzn-select span8">
            	
				<?php
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
     </div> 
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Generate Penerima Dokumen</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>
<b>Keterangan :</b><br> Jika penerima dokumen berubah, harus di edit manual juga di database dokumen.
<br><br><br><br><br><br><br>

        </div>
    </div>
	
	
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

    <?php if($e['difile']!=null){?>
        <iframe src="dok/web/viewer.html?file=/dok/<?php echo $e['jenisdok']?>/<?php echo $e['difile'] ?>" width=100% height=500></iframe>
         PDF1 <?=$e[jenisdok];?> <?php echo $e['difile']; ?>
        <?php
    } else {
        ?>
         <iframe src="dok/web/viewer.html?file=/dok/<?php echo $r['jenisdok']?>/<?php echo $r['difile'] ?>" width=100% height=500></iframe>
         PDF <?=$r[jenisdok];?> <?php echo $r['difile']; }
    ?>
 
<br />
<legend>Distribusi Ke :</legend>
<table class="table table-bordered table-striped" width=100%>
<thead>
	<td>No</td>
	<td>Nama</td>
	<td width="30%">Bagian/Jabatan</td>
	<td>Tanggal Dibaca/Terima</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cJabatan, a.bagian, a.cFoto, b.tgl_baca, b.copyke FROM users a
						LEFT JOIN disin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.copyke ASC");
	$psn1 = mysql_query("SELECT tgl_bls FROM disin WHERE suid='$_GET[id]'");
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
					$t[cNama] 
				</td>
				<td>$t[cJabatan]</td>
				<td>";if ($t[tgl_baca]=='' OR $t[tgl_baca]=='0000-00-00') { echo "Belum";} else {echo tgl_indo($t[tgl_baca]); };echo"</td>
			 </tr>";
	}
	?>
</table>
<br />
<big>Jumlah Penerima : <?=$j;?> Orang</big>

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
	if($_SESSION[cv]=='0' OR $_SESSION[cv]=='1' OR $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1000') {
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
				$cv = mysql_num_rows(mysql_query("SELECT * FROM disin WHERE suid='$s[suid]'"));
				if ($cv==0){
				echo"<td><a href='?pages=dister&act=lp2&id=$s[suid]' class='btn btn-info'>Buat</a></td>";
				}
				else {
				echo"<td><a href='?pages=dister&act=lp&id=$s[suid]' class='btn btn-info'>Edit</a></td>";
				}
				
				if ($s[distatus]=='N'){
					if ($_SESSION[cv]==0 or $_SESSION[cv]=='1' or $_SESSION[cv]=='53' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1000')
					{
						if ($_SESSION[cv]=='53'OR $_SESSION[cv]=='1000') {
			            echo "<td><a href='include/dister/aksi_dister.php?act=acc&id=$s[suid]' onClick=\"return confirm('Yakin akan kirim distribusi dokumen ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>";
					    echo "<td class='center'><a href='include/dister/aksi_dister.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				        <a href='?pages=dister&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=dister&act=detail&id=$s[suid]' class='btn btn-info'>Detail</a>
				        </td>";
						}
						else {
			            echo "<td><b>Belum ACC Spv<b></td><td class='center'><a href='include/dister/aksi_dister.php?act=hapus&id=$s[suid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				        <a href='?pages=dister&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=dister&act=detail&id=$s[suid]' class='btn btn-info'>Detail</a>
				        </td>";
						}
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
				<td class='center'><a href='?pages=dister&act=edit&id=$s[suid]'><i class='icon-edit'></i></a>-
				<a href='home.php?pages=dister&act=detail&id=$s[suid]' title=Detail' class='btn btn-info'> Detail</a>
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