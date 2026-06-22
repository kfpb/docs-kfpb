<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Registrasi Usulan (LAMA)</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php


function GetCheckboxes($table, $key, $Label, $Nilai='') {
  $s = "select * from cchl order by id_cchl";
  $r = mysql_query($s);
  $_arrNilai = explode(', ', $Nilai);
  $str = '';
  while ($w = mysql_fetch_array($r)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] <br>";
  }
  return $str;
}

$aksi="include/mod_upd/aksi_upd.php";
$aksi1="include/mod_dokumen/aksi_dokumen.php"; 
include "config1/library.php";

switch($_GET[act]){
  // Tampil upd
  default:
  
if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){

    echo "<h2>Buat Usulan Dokumen dan Registrasi Usulan</h2>";
echo "<font size=2><b><u><font color=blue style='background-color:#FFFFFF'>Buat-Entry Manual</u></b></font> UPD/UPDB/ Usulan Penghapusan Dokumen : <input type=button value='>>Klik Disini' onclick=location.href='?pages=upd&act=tambahupd'></font>
          <br><br>";
		  
		    // Form Pencarian Dokumen untuk diusulkan ----------------------------------------------------------------------
			echo "<font size=2><strong><font color=blue style='background-color:#FFFFFF'><u>Buat Registrasi UPD/ OBS</u></strong> dengan cari <b>dokumen</b></font> untuk diusulkan berubah/ revisi dengan kata kunci <b>Kode/Judul Dokumen :</b></font>
      <form method=POST action='$aksi1?module=dokumen&act=caridokumens' target=_blank>    
        
		<select name='kata1'>
            <option value='judul' >Judul Dokumen</option>
            <option value='kode' selected>Kode Dokumen</option>
</select><input name='kata' type=text size=17 />
        <input type=submit value=Cari /></form><br><hr color=#000890 noshade=noshade />";
		
	  
		  
	 		    // Form Pencarian UPD lengkap ---------------------------------------------------------------------------
echo "<font size=2><b><u><font color=blue color=blue style='background-color:#FFFFFF'>Cari & Edit Usulan yang sudah diregistrasi</font></b></u>
<br><br>
<font size=2><b>Edit Usulan singkat, tanpa usulan yang telah NET</b></u><br>berdasarkan kata kunci <b>Kode Dokumen</b> :</font>
      <form method=POST action='$aksi?module=upd&act=cariupd4' target=_blank>    
         <select name='kata1'>
                        <option value='lengkap' selected>Kirim Kembali Manual</option>
						<option value='kirim' >Hanya Kirim</option>
						<option value='kembali' >Hanya Kembali</option>
						<option value='dist' >Hasil Distr & Tarik</option>
	</select>
						<input name='kata' type=text size=17 />     
		<input type=submit value=Cari /></form> 
";
		
		 		    // Form Pencarian UPD hanya konsep
echo "<b>Edit Usulan Lengkap (Net/Konsep)</b><br>berdasarkan kata kunci <b>Kode/ Judul Dokumen/No Reg Usulan :<br></b></font>
      <form method=POST action='$aksi?module=upd&act=cariupd' target=_blank>    
        		<select name='kata1'>
                        <option value=kode selected>Kode Dokumen</option>
						<option value=judul >Judul Dokumen</option>
						<option value=nomor >No Registrasi UPD</option>						
</select>
       					
<input name='kata' type=text size=17 /><input type=submit value=Cari /></form>

<br><hr color=#000890 noshade=noshade />";
		
// Form Pencarian laporan usulan ----------------------------------------------------------------------------------
echo "<font size=2><font color=blue color=blue style='background-color:#FFFFFF'><b><u>Tampilkan Laporan Usulan-Usulan Dokumen </u></font><br>";

// Konfirmasi Usulan + Follow
    echo "<br><font size=2><b>Konfirmasi Usulan (Follow-Up):</b><br><input target=_blank type=button value='Cek Usulan yang lebih dari 7 hari kerja belum kembali !' onclick=\"window.location.href='$aksi?module=upd&act=cariupd60';\"><br>";  


echo"
<br><b>Daftar Usulan Per Bagian yang mengusulkan (PDF) : </b></font>
      <form method=POST target=_blank action='/security1/pdf_usulan_user.php'>  
		  <select name='kata'>
            <option value=0 selected>- Pilih Nama Jabatan -</option>";
				
            $tampil1=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[cchl]>$r[cchl]</option>";
            }
echo "</select>
<select name='kata2'>
                        <option value='11/' >Tahun 2011</option>
						<option value='12/' >Tahun 2012</option>
						<option value='13/' selected>Tahun 2013</option>	
<option value='14/' >Tahun 2014</option>			
<option value='15/' >Tahun 2015</option>	
<option value='16/' >Tahun 2016</option>	
<option value='17/' >Tahun 2017</option>	
<option value='18/' >Tahun 2018</option>	
<option value='19/' >Tahun 2019</option>	
				
</select>
        <input type=submit value=Tampil />
      </form>";
	  // Konfirmasi Usulan user browser
echo"
<br><b>Daftar Usulan Per Bagian yang mengusulkan (browser) : </b></font>
     <form method=POST action='$aksi?module=upd&act=cariupd57a' target=_blank>      
		  <select name='kata'>
            <option value=0 selected>- Pilih Nama Jabatan -</option>";
				
            $tampil1=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[cchl]>$r[cchl]</option>";
            }
echo "</select>
<select name='kata2'>
                        <option value='11/' >Tahun 2011</option>
						<option value='12/' >Tahun 2012</option>
						<option value='13/' selected>Tahun 2013</option>	
<option value='14/' >Tahun 2014</option>	
<option value='15/' >Tahun 2015</option>	
<option value='16/' >Tahun 2016</option>	
<option value='17/' >Tahun 2017</option>	
<option value='18/' >Tahun 2018</option>	
<option value='19/' >Tahun 2019</option>							
</select>
        <input type=submit value=Tampil />
      </form>";
	  
	  
// Form Pencarian Usulan posisi terakhir per jabatan yang masih konsep
echo "<font size=2><b>Pencarian Usulan Konsep pada Posisi Terakhir<br></b>berdasarkan jabatan :<br>
      <form method=POST action='$aksi?module=upd&act=cariupd57' target=_blank>      
				  <select name='kata'>
            <option value=0 selected>- Pilih Nama Jabatan -</option>";
				
			
            $tampil1=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[cchl]>$r[cchl]</option>";
            }
echo "</select>
</font>
        <input type=submit value=Cari /></form>";
	  
	  
	  // Form Pencarian Usulan per bulan yang telah NET
echo "<font size=2><b>Pencarian dari semua usulan yang telah NET/ didistribusikan untuk ditampilkan </font></b></u><br>berdasarkan <b>Bulan dan Tahun :<br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd55'target=_blank>      
		Bulan :
		 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
            <option value=2021- >2021</option>
            <option value=2022- >2022</option>
			</select>
</font>
        <input type=submit value=Cari /></form>";

		 	// Form Pencarian Usulan untuk PPT
echo "<font size=2><b>Laporan Usulan yang berubah pada tahun (Untuk PPT)</b></u><br></b>
     
		      <form method=POST action='$aksi?module=upd&act=cariupd59' target=_blank>     
		Berdasar Jenis Dokumen :
		<select name='kata'>
            <option value=0 selected>- Pilih Jenis Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_jendok]'>$r[nama_jendok]</option>";
            }
echo "</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>	
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
            <option value=2021- >2021</option>
            <option value=2022- >2022</option>
			</select>
</font>
        <input type=submit value=Cari /></form>
		
	  
	  
	  <br><hr color=#000890 noshade=noshade />";
	  
	  
	  
	  
	  
// Form Pencarian laporan usulan SPD ----------------------------------------------------------------------------------
	  
echo"<font size=2 color=Blue><b><u>Laporan Bulanan Usulan (Untuk Target Mutu SPD)</b></u></font><br><br>

<font size=2><b>Laporan Rekap Usulan :</b></font>
	    <form method=POST action='$aksi?module=upd&act=cariupd6' target=_blank>    
		<font size=2><b>Bulan :<select name='kata'>
		  <option value='' selected>Pilih Bulan</option>
		  <option value=01 >Januari</option>
		  <option value=02 >Februari</option>
		  <option value=03 >Maret</option>
		  <option value=04 >April</option>
		  <option value=05 >Mei</option>
		  <option value=06 >Juni</option>
		  <option value=07 >Juli</option>
		  <option value=08 >Agustus</option>
		  <option value=09 >September</option>
		  <option value=10 >Oktober</option>
		  <option value=11 >November</option>
		  <option value=12 >Desember</option>
		 </select>
		Tahun :<select name='kata1'>
                        <option value='' selected>Pilih Tahun</option>
						<option value=11 >2011</option>
						<option value=12 >2012</option>
						<option value=13 >2013</option>
						<option value=14 >2014</option>
			<option value='15' >2015</option>	
<option value='16' >2016</option>	
<option value='17' >2017</option>	
<option value='18' >2018</option>	
<option value='19' >2019</option>	
						</select><input type=submit value=Cari />
						<br>
						Laporan Tahunan :<select name='kata2'>
						<option value='' selected>Pilih Laporan Tahunan</option>
                        <option value='11/' >Laporan Tahun 2011</option>
						<option value='12/' >Laporan Tahun 2012</option>
						<option value='13/' >Laporan Tahun 2013</option>
						<option value='14/' >Tahun 2014</option>	
<option value='15/' >Tahun 2015</option>	
<option value='16/' >Tahun 2016</option>	
<option value='17/' >Tahun 2017</option>	
<option value='18/' >Tahun 2018</option>	
<option value='19/' >Tahun 2019</option>	
						</select>
</font></b>
        </form> <br>
	 ";
		
		// Form Pencarian Usulan per bulan
echo "<font size=2><b>Laporan semua usulan yang masuk untuk ditampilkan </b>berdasarkan <b>Bulan dan Tahun :<br>
      <form method=POST action='$aksi?module=upd&act=cariupd5'target=_blank>      
		Bulan :<select name='kata'>
		  <option value=01 selected>Januari</option>
		  <option value=02 >Februari</option>
		  <option value=03 >Maret</option>
		  <option value=04 >April</option>
		  <option value=05 >Mei</option>
		  <option value=06 >Juni</option>
		  <option value=07 >Juli</option>
		  <option value=08 >Agustus</option>
		  <option value=09 >September</option>
		  <option value=10 >Oktober</option>
		  <option value=11 >November</option>
		  <option value=12 >Desember</option>
		 </select>
		Tahun :<select name='kata1'>
                        <option value=11 selected>2011</option>
						<option value=12 >2012</option>
						<option value=13 >2013</option>
						<option value=14 >2014</option>
						<option value=15 >2015</option>
						<option value=16 >2016</option>
						<option value=17 >2017</option>
						<option value=18 >2018</option>
						<option value=19 >2019</option>
						<option value=20 >2020</option>
                        <option value=2021- >2021</option>
                        <option value=2022- >2022</option>
						</select>
		Jenis Usulan :<select name='kata2'>
                        <option value='' selected>Semua Usulan</option>
						<option value='R' >UPD</option>
						<option value='B' >UPDB</option>
						<option value='O' >OBSOLETE</option>
</select></font>
        <input type=submit value=Cari /></form><br>";
	 
	 

	echo"
		<br><font size=2><b>Laporan Waktu Selesai Usulan di SPD + Waktu Distribusi (Tgl Selesai) </b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd58' target=_blank>    
		Bulan-Tahun :
		 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
            <option value=2021- >2021</option>
            <option value=2022- >2022</option>
	</select>
</font>
        <input type=submit value=Cari /></form>
			
				<br><font size=2><b>Laporan Waktu Selesai Usulan di SPD + Waktu Distribusi (Tgl Berlaku) </b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd680' target=_blank>    
		Bulan-Tahun :
		 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>	
            <option value=2021- >2021</option>
            <option value=2022- >2022</option>
</select>
</font>
        <input type=submit value=Cari /></form>
			
	<br>
		<font size=2><b>Laporan Waktu Selesai Usulan di SPD + Waktu Distribusi bulan... (edit)-Tgl Selesai </b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd589' target=_blank>    
		Bulan-Tahun :
		 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
			<option value=2021- >2021</option>
            <option value=2022- >2022</option>
			
			</select>
</font>
        <input type=submit value=Cari /></form>
		
		<br>
		<font size=2><b>Laporan Waktu Selesai Usulan di SPD + Waktu Distribusi bulan... (edit)-Tgl Berlaku </b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd5890' target=_blank>    
		Bulan-Tahun :
		 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
			<option value=2021- >2021</option>
			<option value=2022- >2022</option>
			</select>
</font>
        <input type=submit value=Cari /></form>
		
		<br>
		<font size=2><b>Laporan Usulan di SPD bulan...</b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd588' target=_blank>    
		Bulan :<select name='kata'>
		  <option value=01 selected>Januari</option>
		  <option value=02 >Februari</option>
		  <option value=03 >Maret</option>
		  <option value=04 >April</option>
		  <option value=05 >Mei</option>
		  <option value=06 >Juni</option>
		  <option value=07 >Juli</option>
		  <option value=08 >Agustus</option>
		  <option value=09 >September</option>
		  <option value=10 >Oktober</option>
		  <option value=11 >November</option>
		  <option value=12 >Desember</option>
		 </select>
		Tahun :<select name='kata1'>
                        <option value=11 selected>2011</option>
						<option value=12 >2012</option>
						<option value=13 >2013</option>
						<option value=14 >2014</option>
						<option value=15 >2015</option>
						<option value=16 >2016</option>
						<option value=17 >2017</option>
						<option value=18 >2018</option>
						<option value=19 >2019</option>
						<option value=20 >2020</option>
						<option value=21 >2021</option>
						<option value=22 >2022</option>						
						</select>
</font>
        <input type=submit value=Cari /></form>
		
		<br>
		
			<font size=2><b>Laporan Usulan di SPD bulan... (Edit) </b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd560' target=_blank>    
		Bulan-Tahun :
		 <select name='kata'>
             <option value=0 selected>- Pilih Bulan -</option>
            <option value=01 >Januari</option>
            <option value=02 >Februari</option>
            <option value=03 >Maret</option>
			<option value=04 >April</option>
			<option value=05 >Mei</option>
			<option value=06 >Juni</option>
			<option value=07 >Juli</option>
			<option value=08 >Agustus</option>
			<option value=09 >September</option>
			<option value=10 >Oktober</option>
			<option value=11 >November</option>
			<option value=12 >Desember</option>		
			
</select>
Tahun :<select name='kata1'>
                        <option value=11 selected>2011</option>
						<option value=12 >2012</option>
						<option value=13 >2013</option>
						<option value=14 >2014</option>
						<option value=15 >2015</option>
						<option value=16 >2016</option>
						<option value=17 >2017</option>
						<option value=18 >2018</option>
						<option value=19 >2019</option>
						<option value=20 >2020</option>
						<option value=21 >2021</option>
						<option value=22 >2022</option>	
						</select>
</font>
        <input type=submit value=Cari /></form>
		
		<br>
		
		<font size=2><b>Laporan Usulan di SPD (Entry Usulan) bulan...(edit)</b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd5881' target=_blank>    
		Tanggal :<select name='kata2'>
		  <option value=tgl_terima >Terima 1</option>
		  <option value=tgl_kbl_k1 >Kembali 1</option>
		  <option value=tgl_kbl_k2 >Kembali 2</option>
		  <option value=tgl_kbl_k3 >Kembali 3</option>
		  <option value=tgl_kbl_n1 >Kembali 4</option>
		  <option value=tgl_kbl_n2 >Kembali 5</option>
		  <option value=tgl_kbl_n3 >Kembali 6</option>
		  <option value=tgl_kbl_k4 >Kembali 7</option>
		  <option value=tgl_kbl_k5 >Kembali 8</option>
		  <option value=tgl_kbl_k6 >Kembali 9</option>
		  <option value=tgl_kbl_n4 >Kembali 10</option>
		  <option value=tgl_kbl_n5 >Kembali 11</option>
		 </select>
		
		Bulan :<select name='kata1'>
		  <option value=01 selected>Januari</option>
		  <option value=02 >Februari</option>
		  <option value=03 >Maret</option>
		  <option value=04 >April</option>
		  <option value=05 >Mei</option>
		  <option value=06 >Juni</option>
		  <option value=07 >Juli</option>
		  <option value=08 >Agustus</option>
		  <option value=09 >September</option>
		  <option value=10 >Oktober</option>
		  <option value=11 >November</option>
		  <option value=12 >Desember</option>
		 </select>
		Tahun :<select name='kata'>
                        <option value=2011- selected>2011</option>
						<option value=2012- >2012</option>
						<option value=2013- >2013</option>
						<option value=2014- >2014</option>
						<option value=2015- >2015</option>
						<option value=2016- >2016</option>
						<option value=2017- >2017</option>
						<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
			<option value=2021- >2021</option>		
			<option value=2022- >2022</option>				
						</select>
						
</font>
        <input type=submit value=Cari /></form>
		<br>
		<font size=2><b>Laporan Usulan di SPD (Entry Usulan) bulan...</b><br></b>
      <form method=POST action='$aksi?module=upd&act=cariupd5601' target=_blank>    
	Tanggal :<select name='kata2'>
		  <option value=tgl_terima >Terima 1</option>
		  <option value=tgl_kbl_k1 >Kembali 1</option>
		  <option value=tgl_kbl_k2 >Kembali 2</option>
		  <option value=tgl_kbl_k3 >Kembali 3</option>
		  <option value=tgl_kbl_n1 >Kembali 4</option>
		  <option value=tgl_kbl_n2 >Kembali 5</option>
		  <option value=tgl_kbl_n3 >Kembali 6</option>
		  <option value=tgl_kbl_k4 >Kembali 7</option>
		  <option value=tgl_kbl_k5 >Kembali 8</option>
		  <option value=tgl_kbl_k6 >Kembali 9</option>
		  <option value=tgl_kbl_n4 >Kembali 10</option>
		  <option value=tgl_kbl_n5 >Kembali 11</option>
		 </select>
		
		Bulan :<select name='kata1'>
		  <option value=01 selected>Januari</option>
		  <option value=02 >Februari</option>
		  <option value=03 >Maret</option>
		  <option value=04 >April</option>
		  <option value=05 >Mei</option>
		  <option value=06 >Juni</option>
		  <option value=07 >Juli</option>
		  <option value=08 >Agustus</option>
		  <option value=09 >September</option>
		  <option value=10 >Oktober</option>
		  <option value=11 >November</option>
		  <option value=12 >Desember</option>
		 </select>
		Tahun :<select name='kata'>
                        <option value=2011- selected>2011</option>
						<option value=2012- >2012</option>
						<option value=2013- >2013</option>
						<option value=2014- >2014</option>
						<option value=2015- >2015</option>
						<option value=2016- >2016</option>
						<option value=2017- >2017</option>
									<option value=2018- >2018</option>
			<option value=2019- >2019</option>
			<option value=2020- >2020</option>
			<option value=2021- >2021</option>
			<option value=2022- >2022</option>
						</select>
</font>
        <input type=submit value=Cari /></form>";
	

echo"<br><hr color=#000890 noshade=noshade /><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	 
	  			    
		  
		
	}
	
	
	
	else {
	  echo "<h2>Progress /Registrasi Usulan</h2>
          ";
		  
		
	  	
	 echo"";
	  
	      // Form Pencarian Menurut Jabatan
echo "<font size=2><strong><u>Melihat Daftar/ Progress/ Registrasi Usulan Dokumen yang di usulkan $_SESSION[bagianuser]</u></strong> :<br><br>
    
	<form method=POST action='$aksi?module=upd&act=caridokumenss' target=_blank> 
	<b>Usulan anda yang masih konsep/pending/follow-up :</b>
	<input type=hidden value='$_SESSION[bagianuser]' name='kata'>
        >><input type=submit value='Klik Disini!' />
      </form>
	  <form method=POST action='$aksi?module=upd&act=caridokumensss' target=_blank> 
	  <b>Usulan anda yang telah NET :</b>
	<input type=hidden value='$_SESSION[bagianuser]' name='kata'>
        >><input type=submit value='Klik Disini!' />
      </form>
	  	  </font>";
		  
// Form Pencarian Usulan per bulan
echo "<font size=2>
      <form method=POST action='$aksi?module=upd&act=cariupd57' target=_blank>    
	  <b>Pencarian usulan yang belum net, posisi terakhir di $_SESSION[bagianuser] :</b>
		<input type=hidden name=kata value=$_SESSION[bagianuser]>
        >><input type=submit value='Klik Disini!' /></form>


<br><hr color=#000890 noshade=noshade />";

		  	 		    // Form Pencarian UPD Kode
echo "<font size=2><b><u>Pencarian progress semua usulan yang masuk untuk ditampilkan</b></u><br>berdasarkan kata kunci <b>Kode Dokumen :<br></b></font>
      <form method=POST action='$aksi?module=upd&act=cariupduser' target=_blank>    
        <input name='kata' type=text size=17 />
		        <input type=submit value=Cari /></form>
		  <br><hr color=#000890 noshade=noshade />";
		  

	
	
	}
	
	    if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM upd"));

    }
    else{
 $jmldata = mysql_num_rows($tampil1);
    }  

	
    break;

  
  
  
  case "tambahupd":
    echo "<h2>Entry/ Buat Usulan Dokumen</h2>
          <font size=2><b><font color=blue style='background-color:#FFFFFF'>Kalau membuat Usulan Perubahan (UPD) sebaiknya dilakukan melalui menu pencarian dahulu</font>, form dibawah baiknya dikhususkan untuk membuat UPDB, Penghapusan Dokumen <a href=home.php?pages=upd><--Kembali</a></font></b><form method=POST enctype='multipart/form-data' action='$aksi?module=upd&act=input' onSubmit='return validasiku(this)'>
          <table>
		  <tr><td>Jenis Usulan :</td>      <td> 
		   <select name='jenis_upd'>
            <option value=0 selected>- Pilih Jenis Usulan -</option>
			<option value='UPD'>Usulan Perubahan Dokumen</option>
			<option value='UPDB'>Usulan Pembuatan Dokumen Baru</option>
			<option value='OBS'>Usulan Obsolete/Hapus Dokumen dari RDT</option>
		
			
		  </td></tr>
          <tr><td>Nama Dokumen :</td>      <td><input type=text name='judul_dok' size=70><input type=hidden name='keterangan' value=''></td></tr>
          <tr><td>Kode Dokumen :</td>      <td><input type=text name='kode_dok' size=25> Tentukan dahulu kode baru jika UPDB</td></tr>
		   <tr><td>Kode Komputer :</td>      <td><input type=text name='kode_kom' size=25></td></tr>
		    <tr><td>PJ/Pmbuat Dok :</td>      <td><input type=text name='pj_dok' size=25> Penanggung Jawab/Pembuat Dokumen Awal</td></tr>
		
		  <tr><td>Dok Terkait :</td>      <td><input type=text name='dok_terkait' size=70></td></tr>
		  <tr><td>Revisi Dok :</td>      <td><input type=text name='revisi' size=1> Ketik strip (-) jika UPDB, masukan satu digit saja bila merevisi.</td></tr>
  <tr><td>Jenis Dokumen :</td>      <td>
 <select name='id_jendok'>
            <option value=0 selected>- Pilih Jenis Dokumen -</option>";
				
			
            $tampil1=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[id_jendok]>$r[nama_jendok]</option>";
            }
echo "</select></td></tr>";
echo "<tr><td><b><font color=blue style='background-color:#FFFFFF'>Kategori Usulan</font></b></td>  <td> <select name='kat_upd'>
<option value='' selected>Isi Jenis Perubahan !</option>
<option value='Dokumen Baru'>Dokumen Baru</option>
<option value='Dokumen Dihilangkan'>Dokumen Dihilangkan</option>

<option value='Perubahan Pemerian'>Spesifikasi-Perubahan Pemerian</option>
<option value='Perubahan Pemeriksaan/Persyaratan'>Spesifikasi-Perubahan Pemeriksaan/Persyaratan</option>
<option value='Perubahan Pustaka'>Spesifikasi-Perubahan Pustaka</option>
<option value='Perubahan Lain-lain'>Spesifikasi-Perubahan lain-lain</option>

<option value='Perubahan Alat/Bahan' >Protap Pemeriksaan - Perubahan Alat/Bahan</option>
<option value='Perubahan Pustaka' >Protap Pemeriksaan - Perubahan Pustaka</option>
<option value='Perubahan Pemeriksaan' >Protap Pemeriksaan - Perubahan Pemeriksaan</option>
<option value='Perubahan Lain-lain' >Protap Pemeriksaan - Perubahan Lain-lain</option>

<option value='Perubahan Alat/Bahan' >Protap Alat - Perubahan Alat/Bahan</option>
<option value='Perubahan Cara Pemakaian' >Protap Alat - Perubahan Cara Pemakaian</option>
<option value='Perubahan Cara Pembersihan' >Protap Alat - Perubahan Cara Pembersihan</option>
<option value='Perubahan Cara Pemeliharaan' >Protap Alat - Perubahan Cara Pemeliharaan</option>
<option value='Perubahan Lain-lain' >Protap Alat - Perubahan Lain-lain</option>

<option value='Perubahan Formula' >CPB-Perubahan Formula</option>
<option value='Perubahan Spesifikasi' >CPB-Perubahan Spesifikasi</option>
<option value='Perubahan Nama Alat' >CPB-Perubahan Nama Alat</option>
<option value='Perubahan Proses' >CPB-Perubahan Proses</option>
<option value='Perubahan Lainnya' >CPB-Perubahan Lainnya</option>

<option value='Perubahan Formula' >CKB-Perubahan Formula</option>
<option value='Perubahan Spesifikasi' >CKB-Perubahan Spesifikasi</option>
<option value='Perubahan Nama Alat' >CKB-Perubahan Nama Alat</option>
<option value='Perubahan Proses' >CKB-Perubahan Proses</option>
<option value='Perubahan Expire Date' >CKB-Perubahan Expire Date</option>
<option value='Perubahan Lainnya' >CKB-Perubahan Lainnya</option>

<option value='Perubahan Protap'>Protap Lain-lain</option>
<option value='Lampiran/ LA'>Perubahan Lampiran/ LA</option>
<option value='Perubahan lain-lain' >Perubahan lain-lain</option>
			</select></td></tr>";
echo "<tr><td><b><font color=blue style='background-color:#FFFFFF'>Isi Usulan (uraian singkat di sejarah rev)</b> Tulis Dokumen baru jika UPDB</font></td>  <td> <textarea name='isi_upd' style='width: 400px; height: 100px;'></textarea></td></tr>";
if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){ 
          echo "

          <tr><td>Pengusul :</td>    <td> 
		  <select name='username'>
		   <option value=0 selected>- Pilih Pengusul Dokumen -</option>";
							
            $tampil1=mysql_query("SELECT * FROM users ORDER BY cIdjab");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[cIdjab]>$r[cIdjab]</option>";
            }
			echo "</select> Isi dengan Supervisor pengusul kalau memungkinkan</td></tr>";
}
			else
			{
			 echo "<tr><td>Pengusul :</td>      <td><input type=hidden name=username 
			 value='$_SESSION[bagianuser]'>$_SESSION[bagianuser]</td></tr>";
			 }
			

echo "
<tr><td><font color=blue style='background-color:#FFFFFF'><b>Bagian/Jajaran :</b></font></td>    <td> 
		  <select name='username2'>
		   <option value=0 selected>- Pilih Jajaran/Bagian Pengusul -</option>
		   <option value='PM.'>Plant Manager</option>
		   <option value='AMUK3L'>Umum dan K3L</option>
		   <option value='MP.'>Manager Produksi</option>
		   <option value='AMP1'>Produksi 1</option>
		   <option value='AMP2'>Produksi 2</option>
		   <option value='AMK'>Pengemasan</option>
		   <option value='AMPM'>Pengawasan Mutu/QC</option>
		   <option value='MPM'>Manager Pemastian Mutu</option>
		   <option value='AMSM'>Sistem Mutu/QA</option>
		   <option value='AMPP'>Pengembangan Produk</option>
		   <option value='AMB'>Pengadaan</option>
		   <option value='AMS'>Penyimpanan</option>
		   <option value='AMDPP'>Pengendalian Proses Produksi</option>
		   <option value='AMSDMA'>SDM & Akuntansi</option>
		   <option value='AMTP'>Teknik & Pemeliharaan</option>";
							
            
			echo "</select></td></tr>";

echo "<tr><td colspan=2><input type=submit value=Simpan>
          <input type=button value=Batal onclick=self.history.back()></td></tr>";
 $cchl = mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
    echo "<tr><td>Penerima Dokumen : <b>(Khusus UPDB, bila belum tahu penerima-nya checklist pada null !)<b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> ";
    while ($t=mysql_fetch_array($cchl)){
      echo "<input type=checkbox value='$t[cchl]' name=cchl[]>>$t[cchl]<br> ";
    }
    
    echo "</td></tr>
        
          
          </table>
          </form>";
    break;
  
  
    case "detailupd":
   
     $edit = mysql_query("SELECT * FROM upd WHERE id_upd='$_GET[id]'");
       $r    = mysql_fetch_array($edit);
      $tgl_pending=tgl_indo($r[tgl_pending]);
	  $tgl_terima=tgl_indo($r[tgl_terima]);
	  
	  
    echo "<h2>Detail Usulan</h2>
          <table>
		  <tr><td width=150><b>Tanggal diterima/acc MR :</b></td>     <td width=350>$tgl_terima</td></tr>
		  <tr><td width=150><b>Tanggal Pending :</b></td>     <td width=350>$tgl_pending (jika di pending)</td></tr>
		  <tr><td width=150><b>Pengusul :</b></td>     <td width=350>$r[username]</td></tr>
		  <tr><td width=150><b>Usulan :</b></td>     <td width=350>";
		   
		  if ($r[keterangan]=="1")
		  { 
		  echo "Sementara";
		  }
		  else 
		  { echo "Normal";
		  }
		  
		  echo"
		  </td></tr>
		   <tr><td width=150><b>Status :</b></td>     <td width=350>$r[status]</td></tr>
          <tr><td width=150><b>Jenis Usulan :</b></td>     <td width=350>$r[jenis_upd]</td></tr>
          <tr><td width=150><b>Kode Dokumen :</b></td>     <td width=350>$r[kode_dok]</td></tr>
		  <tr><td width=150><b>Yg Revisi :</b></td>     <td width=350>$r[revisi]</td></tr>
		   <tr><td width=70><b>Judul Dokumen :</b></td>     <td>$r[judul_dok]</td></tr>
          <tr><td><b>Jenis Dokumen :</b></td><td>";
		   
		   $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  
		  
		  echo "$jenisdok[nama_jendok]</td></tr>";
          
      $tgl_konsep1=tgl_indo3($r[tgl_konsep1]);
	  $tgl_kbl_k1=tgl_indo3($r[tgl_kbl_k1]);
	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);
	  $tgl_kbl_k2=tgl_indo3($r[tgl_kbl_k2]);
	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);
	  $tgl_kbl_k3=tgl_indo3($r[tgl_kbl_k3]);
	  $tgl_net1=tgl_indo3($r[tgl_net1]);
	  $tgl_kbl_n1=tgl_indo3($r[tgl_kbl_n1]);
	  $tgl_net2=tgl_indo3($r[tgl_net2]);
	  $tgl_kbl_n2=tgl_indo3($r[tgl_kbl_n2]);
	  $tgl_net3=tgl_indo3($r[tgl_net3]);
	  $tgl_kbl_n3=tgl_indo3($r[tgl_kbl_n3]);
	  $tgl_konsep4=tgl_indo3($r[tgl_konsep4]);
	  $tgl_kbl_k4=tgl_indo3($r[tgl_kbl_k4]);
	  $tgl_konsep5=tgl_indo3($r[tgl_konsep5]);
	  $tgl_kbl_k5=tgl_indo3($r[tgl_kbl_k5]);
	  $tgl_konsep6=tgl_indo3($r[tgl_konsep6]);
	  $tgl_kbl_k6=tgl_indo3($r[tgl_kbl_k6]);
	  $tgl_net4=tgl_indo3($r[tgl_net4]);
	  $tgl_kbl_n4=tgl_indo3($r[tgl_kbl_n4]);
	  $tgl_net5=tgl_indo3($r[tgl_net5]);
	  $tgl_kbl_n5=tgl_indo3($r[tgl_kbl_n5]);
	  $tgl_net6=tgl_indo3($r[tgl_net6]);
	  $tgl_kbl_n6=tgl_indo3($r[tgl_kbl_n6]);
	  
	  $tgl_terakhir=tgl_indo2($r[tgl_terakhir]);
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
		  		  
    echo "
	<tr><td><b>Kategori Usulan/Perubahan :</b></td><td>$r[kat_upd]</td></tr>
	<tr><td><b>Isi Usulan :</b></td><td>$r[isi_upd]</td></tr>
	<tr><td><b>Posisi terakhir di user :</b></td><td>$r[posisi]</td></tr>
	<tr><td><b>Tgl Terakhir di user :</b></td><td>$tgl_terakhir</td></tr>
	<tr><td><b>Kirim Ke 1 ke :</b></td><td>$r[konsep1_krm]</td></tr>
	<tr><td><b>Tgl Kirim  1 :</b></td><td>$tgl_konsep1</td></tr>
	<tr><td><b>Tgl Kembali ke 1 :</b></td><td>$tgl_kbl_k1</td></tr>

	<tr><td><b>Kirim 2 Ke :</b></td><td>$r[konsep2_krm]</td></tr>
	<tr><td><b>Tgl Kirim 2 :</b></td><td>$tgl_konsep2</td></tr>
		<tr><td><b>Tgl Kembali ke 2 :</b></td><td>$tgl_kbl_k2</td></tr>

	<tr><td><b>Kirim 3 Ke :</b></td><td>$r[konsep3_krm]</td></tr>
	<tr><td><b>Tgl Kirim 3 :</b></td><td>$tgl_konsep3</td></tr>
		<tr><td><b>Tgl Kembali ke 3 :</b></td><td>$tgl_kbl_k3</td></tr>

	<tr><td><b>Kirim 4 Ke :</b></td><td>$r[net1_krm]</td></tr>
	<tr><td><b>Tgl Kirim 4 :</b></td><td>$tgl_net1</td></tr>
		<tr><td><b>Tgl Kembali ke 4 :</b></td><td>$tgl_kbl_n1</td></tr>

	<tr><td><b>Kirim 5 Ke :</b></td><td>$r[net2_krm]</td></tr>
	<tr><td><b>Tgl Kirim 5 :</b></td><td>$tgl_net2</td></tr>
			<tr><td><b>Tgl Kembali ke 5 :</b></td><td>$tgl_kbl_n2</td></tr>

	<tr><td><b>Kirim 6 Ke :</b></td><td>$r[net3_krm]</td></tr>
	<tr><td><b>Tgl Kirim 6 :</b></td><td>$tgl_net3</td></tr>
			<tr><td><b>Tgl Kembali ke 6 :</b></td><td>$tgl_kbl_n3</td></tr>
			
				<tr><td><b>Kirim Ke 7 ke :</b></td><td>$r[konsep4_krm]</td></tr>
	<tr><td><b>Tgl Kirim  7 :</b></td><td>$tgl_konsep4</td></tr>
	<tr><td><b>Tgl Kembali ke 7 :</b></td><td>$tgl_kbl_k4</td></tr>

	<tr><td><b>Kirim 8 Ke :</b></td><td>$r[konsep5_krm]</td></tr>
	<tr><td><b>Tgl Kirim 8 :</b></td><td>$tgl_konsep5</td></tr>
		<tr><td><b>Tgl Kembali ke 8 :</b></td><td>$tgl_kbl_k5</td></tr>

	<tr><td><b>Kirim 9 Ke :</b></td><td>$r[konsep6_krm]</td></tr>
	<tr><td><b>Tgl Kirim 9 :</b></td><td>$tgl_konsep6</td></tr>
		<tr><td><b>Tgl Kembali ke 9 :</b></td><td>$tgl_kbl_k6</td></tr>

	<tr><td><b>Kirim 10 Ke :</b></td><td>$r[net4_krm]</td></tr>
	<tr><td><b>Tgl Kirim 10 :</b></td><td>$tgl_net4</td></tr>
		<tr><td><b>Tgl Kembali ke 10 :</b></td><td>$tgl_kbl_n4</td></tr>

	<tr><td><b>Kirim 11 Ke :</b></td><td>$r[net5_krm]</td></tr>
	<tr><td><b>Tgl Kirim 11 :</b></td><td>$tgl_net5</td></tr>
			<tr><td><b>Tgl Kembali ke 11 :</b></td><td>$tgl_kbl_n5</td></tr>

	<tr><td><b>Kirim 12 Ke :</b></td><td>$r[net6_krm]</td></tr>
	<tr><td><b>Tgl Kirim 12 :</b></td><td>$tgl_net6</td></tr>
			<tr><td><b>Tgl Kembali ke 12 :</b></td><td>$tgl_kbl_n6</td></tr>
			<tr><td><b>Tanggal Selesai:</b></td><td>$r[tgl_selesai]</td></tr>
			<tr><td><b>Tanggal Berlaku:</b></td><td>$r[tgl_berlaku]</td></tr>
			<tr><td><b>Keterangan Tambahan :</b></td><td>$r[keterangan2]</td></tr>
	
 		          <tr><td><b>Penerima Dokumen (CCHL) :</b> </td><td>$r[cchl]</td></tr>
   		          
         </table>";
		 echo "<p align=center>
<center><font size=2><b><a href=home.php?pages=upd><--Kembali</a></p></b></center>";
    break;  


  

  case "editupd":
  
   if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
  
    $edit = mysql_query("SELECT * FROM upd WHERE id_upd='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

      $tgl_konsep1=tgl_indo3($r[tgl_konsep1]);
	  $tgl_kbl_k1=tgl_indo3($r[tgl_kbl_k1]);
	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);
	  $tgl_kbl_k2=tgl_indo3($r[tgl_kbl_k2]);
	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);
	  $tgl_kbl_k3=tgl_indo3($r[tgl_kbl_k3]);
	  $tgl_net1=tgl_indo3($r[tgl_net1]);
	  $tgl_kbl_n1=tgl_indo3($r[tgl_kbl_n1]);
	  $tgl_net2=tgl_indo3($r[tgl_net2]);
	  $tgl_kbl_n2=tgl_indo3($r[tgl_kbl_n2]);
	  $tgl_net3=tgl_indo3($r[tgl_net3]);
	  $tgl_kbl_n3=tgl_indo3($r[tgl_kbl_n3]);
	  $tgl_konsep4=tgl_indo3($r[tgl_konsep4]);
	  $tgl_kbl_k4=tgl_indo3($r[tgl_kbl_k4]);
	  $tgl_konsep5=tgl_indo3($r[tgl_konsep5]);
	  $tgl_kbl_k5=tgl_indo3($r[tgl_kbl_k5]);
	  $tgl_konsep6=tgl_indo3($r[tgl_konsep6]);
	  $tgl_kbl_k6=tgl_indo3($r[tgl_kbl_k6]);
	  $tgl_net4=tgl_indo3($r[tgl_net4]);
	  $tgl_kbl_n4=tgl_indo3($r[tgl_kbl_n4]);
	  $tgl_net5=tgl_indo3($r[tgl_net5]);
	  $tgl_kbl_n5=tgl_indo3($r[tgl_kbl_n5]);
	  $tgl_net6=tgl_indo3($r[tgl_net6]);
	  $tgl_kbl_n6=tgl_indo3($r[tgl_kbl_n6]);
	  $tgl_dist=tgl_indo3($r[tgl_dist]);
	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);
	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]);
	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);
	  $follow1=tgl_indo3($r[follow1]);
	  $follow2=tgl_indo3($r[follow2]);
	  $follow3=tgl_indo3($r[follow3]);
	  $tgl_pending=tgl_indo3($r[tgl_pending]);
	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);
	  $tgl_upd=tgl_indo3($r[tgl_upd]);
	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);
	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);
      $tgl_terima=tgl_indo3($r[tgl_terima]);
	  $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);
      $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

    echo "<h2>Edit Usulan</h2>
	      <b>*) format tgl : thn-bln-tgl (Contoh 12 Mei 10 tulis 2010-05-12) </b>
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=upd&act=update' onSubmit='return validasiupd(this)'>
          <input type=hidden name=id_upd value=$r[id_upd]>
		  <input type=hidden name=$tgl_upd value=$r[tgl_upd]>
          <table>
		  
		  <tr><td width=160><b>Tanggal diterima/acc MR :</b></td>     <td width=350><input type=text name='tgl_terima' size=10 value='$tgl_terima'></td></tr>
		    <tr><td width=160><b>No Registrasi Usulan :</b></td>     <td width=350><input type=text name='reg_upd' size=20 value='$r[reg_upd]'></td></tr>
		  
  <tr><td><b>Pengusul :</b></td><td><input type=text name='username' size=20 value='$r[username]'></td></tr>";
		  		   		  
 
	echo "<tr><td><b>Status usulan :</b></td>  <td><select name='status'>";
 
          if ($r[status]=='Net'){
            echo "<option value='Net' selected>Net/ Selesai</option>
			<option value='Konsep'>Konsep</option>
			<option value='Pending'>Pending</option>
			<option value='Tidak Jadi'>Tidak Jadi</option>
			<option value='Follow-Up'>Follow-Up</option>";
          }   

         if ($r[status]=='Konsep'){
            echo "<option value='Net' >Net/ Selesai</option>
			<option value='Konsep' selected>Konsep</option>
			<option value='Pending'>Pending</option>
			<option value='Tidak Jadi'>Tidak Jadi</option>
			<option value='Follow-Up'>Follow-Up</option>";
          }   
	   if ($r[status]=='Pending'){
            echo "<option value='Net' >Net/ Selesai</option>
			<option value='Konsep'>Konsep</option>
			<option value='Pending' selected>Pending</option>
			<option value='Tidak Jadi'>Tidak Jadi</option>
			<option value='Follow-Up'>Follow-Up</option>";
          }   
		     if ($r[status]=='Tidak Jadi'){
            echo "<option value='Net' >Net/ Selesai</option>
			<option value='Konsep'>Konsep</option>
			<option value='Pending'>Pending</option>
			<option value='Tidak Jadi' selected>Tidak Jadi</option>
			<option value='Follow-Up'>Follow-Up</option>";
          }   
		     if ($r[status]=='Follow-Up'){
            echo "<option value='Net' >Net/ Selesai</option>
			<option value='Konsep'>Konsep</option>
			<option value='Pending'>Pending</option>
			<option value='Tidak Jadi'>Tidak Jadi</option>
			<option value='Follow-Up' selected>Follow-Up</option>";
          }   
		
          
    echo "</select></td></tr>";



	echo "<tr><td><b>Status Reg :</b></td>  <td><select name='keterangan'>";
 
          if ($r[keterangan]=='1'){
            echo "<option value='1' selected>Usulan Sementara</option>
			<option value=''>Usulan Normal</option>";
          }   

         if ($r[keterangan]!='1'){
            echo "<option value='' selected>Usulan Normal</option>
			<option value='1'>Usulan Sementara</option>";
          }   
	
		
          
    echo "</select></td></tr>";

echo"<td width=160><b>Tanggal Pending :</b></td>     <td width=350><input type=text name='tgl_pending' size=10 value='$tgl_pending'></td></tr>";

	echo"<td width=160><b>Tanggal diterima 2 Setelah Pending :</b></td>     <td width=350><input type=text name='tgl_terima2' size=10 value='$tgl_terima2'></td></tr>";


 echo "<tr><td><b>Jenis Usulan :</b></td>  <td><select name='jenis_upd'>";
 
          if ($r[jenis_upd]=='UPD'){
            echo "<option value=UPD selected>Usulan Perubahan Dokumen</option>
			<option value=UPDB>Usulan Pembuatan Dokumen Baru</option>
			<option value=OBS>Usulan Obsolete Dokumen</option>";
          }   

            if ($r[jenis_upd]=='UPDB'){
            echo "<option value=UPD>Usulan Perubahan Dokumen</option>
			<option value=UPDB selected>Usulan Pembuatan Dokumen Baru</option>
			<option value=OBS>Usulan Obsolete Dokumen</option>";
            }
			
			   if ($r[jenis_upd]=='OBS'){
              echo "<option value=UPD>Usulan Perubahan Dokumen</option>
			<option value=UPDB>Usulan Pembuatan Dokumen Baru</option>
			<option value=OBS selected>Usulan Obsolete Dokumen</option>";
            }
          
    echo "</select></td></tr>";

         echo "
          <tr><td width=150><b>Kode Dokumen :</b></td>     <td width=350><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
		  <tr><td width=150><b>Kode Komputer :</b></td>     <td width=350><input type=text name='kode_kom' size=20 value='$r[kode_kom]'></td></tr>
		   <tr><td width=150><b>PJ/Pmbuat Dok :</b></td>     <td width=350><input type=text name='pj_dok' size=20 value='$r[pj_dok]'></td></tr>
		  <tr><td width=150><b>Dok. Terkait :</b></td>     <td width=350><input type=text name='dok_terkait' size=20 value='$r[dok_terkait]'></td></tr>
		  <tr><td width=150><b>Revisi ke :</b></td>     <td width=350><input type=text name='revisi' size=3 value='$r[revisi]'></td></tr>
		   <tr><td width=120><b>Judul Dokumen :</b></td>     <td><input type=text name='judul_dok' size=70 value='$r[judul_dok]'></td></tr>
	  
		    <tr><td><b>Jenis Dokumen :</b></td>  <td><select name='id_jendok'>";
 
          $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
          if ($r[id_jendok]==0){
            echo "<option value=0 selected>- Pilih jendok -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_jendok]==$w[id_jendok]){
              echo "<option value=$w[id_jendok] selected>$w[nama_jendok]</option>";
            }
            else{
              echo "<option value=$w[id_jendok]>$w[nama_jendok]</option>";
            }
          }
    echo "</select></td></tr>
	
			     <tr><td width=120><b>Penerima Dokumen :</b></td>     <td><input type=text name='cchl' size=70 value='$r[cchl]'><br> *) Tambahkan titik(.) setelah singkatan jabatan<br>Untuk PM, MP, AMS, SS, SPK, SPKK, SKB, SP, SIA, MR</td></tr>
	";
		      echo "
		      <tr><td width=120><b>Jenis Perubahan :</b></td>     <td><input type=text name='kat_upd' size=70 value='$r[kat_upd]'></td></tr>
	";
    echo "<tr><td><b>Isi Usulan :</b></td>  <td> <textarea name='isi_upd' style='width: 400px; height: 100px;'>$r[isi_upd]</textarea></td></tr>
	
<tr><td width=150><b><u>Kirim ke-1 Ke :</u></b></td>     <td width=350><input type=text name='konsep1_krm' size=50 value='$r[konsep1_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-1 :</b></td><td width=350><input type=text name='tgl_konsep1' size=10 value='$tgl_konsep1'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-1 :</b></td><td width=350><input type=text name='tgl_kbl_k1' size=10 value='$tgl_kbl_k1'> </td></tr>


<tr><td width=150><b><u>Kirim ke-2 Ke :</u></b></td>     <td width=350><input type=text name='konsep2_krm' size=50 value='$r[konsep2_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-2 :</b></td><td width=350><input type=text name='tgl_konsep2' size=10 value='$tgl_konsep2'> </td></tr>
<tr><td width=150><b>Tgl Kembali Ke-2 :</b></td><td width=350><input type=text name='tgl_kbl_k2' size=10 value='$tgl_kbl_k2'> </td></tr>


<tr><td width=150><b><u>Kirim ke-3 Ke :</u></b></td>     <td width=350><input type=text name='konsep3_krm' size=50 value='$r[konsep3_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-3 :</b></td><td width=350><input type=text name='tgl_konsep3' size=10 value='$tgl_konsep3'> </td></tr>
<tr><td width=150><b>Tgl Kembali Ke-3 :</b></td><td width=350><input type=text name='tgl_kbl_k3' size=10 value='$tgl_kbl_k3'> </td></tr>


<tr><td width=150><b><u>Kirim ke-4 Ke :</u></b></td>     <td width=350><input type=text name='net1_krm' size=50 value='$r[net1_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-4  :</b></td><td width=350><input type=text name='tgl_net1' size=10 value='$tgl_net1'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-4 :</b></td><td width=350><input type=text name='tgl_kbl_n1' size=10 value='$tgl_kbl_n1'> </td></tr>


<tr><td width=150><b><u>Kirim ke-5 Ke :</u></b></td>     <td width=350><input type=text name='net2_krm' size=50 value='$r[net2_krm]'></td></tr>
<tr><td width=150><b>Tgl kirim ke-5 :</b></td><td width=350><input type=text name='tgl_net2' size=10 value='$tgl_net2'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-5 :</b></td><td width=350><input type=text name='tgl_kbl_n2' size=10 value='$tgl_kbl_n2'> </td></tr>

<tr><td width=150><b><u>Kirim ke-6 Ke :</u></b></td>     <td width=350><input type=text name='net3_krm' size=50 value='$r[net3_krm]'></td></tr>
<tr><td width=150><b>Tgl kirim ke-6 :</b></td><td width=350><input type=text name='tgl_net3' size=10 value='$tgl_net3'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-6 :</b></td><td width=350><input type=text name='tgl_kbl_n3' size=10 value='$tgl_kbl_n3'> </td></tr>

<tr><td width=150><b><u>Kirim ke-7 Ke :</u></b></td>     <td width=350><input type=text name='konsep4_krm' size=50 value='$r[konsep4_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-7 :</b></td><td width=350><input type=text name='tgl_konsep4' size=10 value='$tgl_konsep4'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-7 :</b></td><td width=350><input type=text name='tgl_kbl_k4' size=10 value='$tgl_kbl_k4'> </td></tr>


<tr><td width=150><b><u>Kirim ke-8 Ke :</u></b></td>     <td width=350><input type=text name='konsep5_krm' size=50 value='$r[konsep5_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-8 :</b></td><td width=350><input type=text name='tgl_konsep5' size=10 value='$tgl_konsep5'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-8 :</b></td><td width=350><input type=text name='tgl_kbl_k5' size=10 value='$tgl_kbl_k5'> </td></tr>


<tr><td width=150><b><u>Kirim ke-9 Ke :</u></b></td>     <td width=350><input type=text name='konsep6_krm' size=50 value='$r[konsep6_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-9 :</b></td><td width=350><input type=text name='tgl_konsep6' size=10 value='$tgl_konsep6'> </td></tr>
<tr><td width=150><b>Tgl Kembali Ke-9 :</b></td><td width=350><input type=text name='tgl_kbl_k6' size=10 value='$tgl_kbl_k6'> </td></tr>


<tr><td width=150><b><u>Kirim ke-10 Ke :</u></b></td>     <td width=350><input type=text name='net4_krm' size=50 value='$r[net4_krm]'></td></tr>
<tr><td width=150><b>Tgl Kirim ke-10 :</b></td><td width=350><input type=text name='tgl_net4' size=10 value='$tgl_net4'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-10 :</b></td><td width=350><input type=text name='tgl_kbl_n4' size=10 value='$tgl_kbl_n4'> </td></tr>


<tr><td width=150><b><u>Kirim ke-11 Ke :</u></b></td>     <td width=350><input type=text name='net5_krm' size=50 value='$r[net5_krm]'></td></tr>
<tr><td width=150><b>Tgl kirim ke-11 :</b></td><td width=350><input type=text name='tgl_net5' size=10 value='$tgl_net5'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-11 :</b></td><td width=350><input type=text name='tgl_kbl_n5' size=10 value='$tgl_kbl_n5'> </td></tr>

<tr><td width=150><b><u>Kirim ke-12 Ke :</u></b></td>     <td width=350><input type=text name='net6_krm' size=50 value='$r[net6_krm]'></td></tr>
<tr><td width=150><b>Tgl kirim ke-12 :</b></td><td width=350><input type=text name='tgl_net6' size=10 value='$tgl_net6'> </td></tr>
<tr><td width=150><b>Tgl Kembali ke-12 :</b></td><td width=350><input type=text name='tgl_kbl_n6' size=10 value='$tgl_kbl_n6'> </td></tr>



<tr><td width=150><b>Tgl Berlaku :</b></td><td width=350><input type=text name='tgl_berlaku' size=10 value='$tgl_berlaku'> </td></tr>
<tr><td width=150><b>Tgl Selesai :</b></td><td width=350><input type=text name='tgl_selesai' size=10 value='$tgl_selesai'> </td></tr>
<tr><td width=150><b>Tgl Buat Dist :</b></td><td width=350><input type=text name='tgl_dist' size=10 value='$tgl_dist'> </td></tr>
<tr><td width=150><b>Tgl Selesai Dist :</b></td><td width=350><input type=text name='tgl_dist_selesai' size=10 value='$tgl_dist_selesai'> </td></tr>
<tr><td width=150><b>Tgl Selesai Tarik :</b></td><td width=350><input type=text name='tgl_tarik_selesai' size=10 value='$tgl_tarik_selesai'> </td></tr>
<tr><td width=150><b>Keterangan :</b></td><td width=350><input type=text name='keterangan2' size=10 value='$r[keterangan2]'></td></tr>
<tr><td width=150><b>Posisi Terakhir :</b></td><td width=350><input type=text name='posisi' size=10 value='$r[posisi]'></td></tr>
<tr><td width=150><b>Tgl. Terakhir :</b></td><td width=350><input type=text name='tgl_terakhir' size=10 value='$tgl_terakhir'></td></tr>
<tr><td width=150><b>Tgl. Follow 1 :</b></td><td width=350><input type=text name='follow1' size=10 value='$follow1'></td></tr>
<tr><td width=150><b>Follow 1 ke :</b></td><td width=350><input type=text name='follow1ke' size=10 value='$r[follow1ke]'></td></tr>
<tr><td width=150><b>Tgl. Follow 2 :</b></td><td width=350><input type=text name='follow2' size=10 value='$follow2'></td></tr>
<tr><td width=150><b>Follow 2 ke :</b></td><td width=350><input type=text name='follow2ke' size=10 value='$r[follow2ke]'></td></tr>
<tr><td width=150><b>Tgl. Follow 3 :</b></td><td width=350><input type=text name='follow3' size=10 value='$follow3'></td></tr>
<tr><td width=150><b>Follow 3 ke :</b></td><td width=350><input type=text name='follow3ke' size=10 value='$r[follow3ke]'></td></tr>
<tr><td width=150><b>Tgl Kembali Konsep Terakhir :</b></td><td width=350><input type=text name='tgl_knsp_trkhr' size=10 value='$r[tgl_knsp_trkhr]'></td></tr>
<tr><td width=150><b>Tgl Kirim Net Ke-1 :</b></td><td width=350><input type=text name='tgl_krm_net' size=10 value='$r[tgl_krm_net]'></td></tr>";
          
    echo "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
}
else
{
   $edit = mysql_query("SELECT * FROM upd WHERE id_upd='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

      $tgl_konsep1=tgl_indo3($r[tgl_konsep1]);
	  $tgl_kbl_k1=tgl_indo3($r[tgl_kbl_k1]);
	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);
	  $tgl_kbl_k2=tgl_indo3($r[tgl_kbl_k2]);
	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);
	  $tgl_kbl_k3=tgl_indo3($r[tgl_kbl_k3]);
	  $tgl_net1=tgl_indo3($r[tgl_net1]);
	  $tgl_kbl_n1=tgl_indo3($r[tgl_kbl_n1]);
	  $tgl_net2=tgl_indo3($r[tgl_net2]);
	  $tgl_kbl_n2=tgl_indo3($r[tgl_kbl_n2]);
	  $tgl_net3=tgl_indo3($r[tgl_net3]);
	  $tgl_kbl_n3=tgl_indo3($r[tgl_kbl_n3]);
	  
	  $tgl_upd=tgl_indo3($r[tgl_upd]);
	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);
      $tgl_terima=tgl_indo3($r[tgl_terima]);

    echo "<h2>Edit Usulan</h2>
          <table>
		  <tr><td width=160><b>No Reg. Usulan :</b></td>     <td width=350>$r[reg_upd]</td></tr>
		  
		  <tr><td width=150><b>Tanggal Usulan :</b></td>     <td width=350>$tgl_upd</td></tr>
		  <tr><td width=150><b>Tanggal acc MR :</b></td>     <td width=350>$tgl_terima</td></tr>
		  <tr><td width=150><b>Pengusul :</b></td>     <td width=350>$r[username]</td></tr>
		  <tr><td width=150><b>Status :</b></td>     <td width=350>$r[status]</td></tr>
          <tr><td width=150><b>Jenis Usulan :</b></td>     <td width=350>$r[jenis_upd]</td></tr>
          <tr><td width=150><b>Kode Dokumen :</b></td>     <td width=350>$r[kode_dok]</td></tr>
		  <tr><td width=150><b>Revisi ke :</b></td>     <td width=350>$r[revisi]</td></tr>
		   <tr><td width=70><b>Judul Dokumen :</b></td>     <td>$r[judul_dok]</td></tr>
		
          <tr><td><b>Jenis Dokumen :</b></td><td>";
		   
		   $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  	$tgl_sekarang = date("Y-m-d");
		  
		  echo "$jenisdok[nama_jendok]</td></tr>";
		  
		   echo "
		          <tr><td><b>Penerima Dokumen (CCHL) :</b> </td><td>$r[cchl]</td></tr>
				 ";
		  
    echo "<tr><td><b>Isi Usulan :</b></td>  <td>$r[isi_upd]</td></tr>
	<tr><td><b>File Usulan :</b> </td><td><a href='file_upd/$r[nama_file]'>$r[nama_file]</a> <font color=blue style='background-color:#FFFFFF'>>>Download File Usulan terupdate Disini!</font></td></tr>
<tr><td><b>Konsep 1 Kirim Ke :</b></td><td>$r[konsep1_krm]</td></tr>
	<tr><td><b>Tgl Kirim Konsep 1 :</b></td><td>$tgl_konsep1</td></tr>
<tr><td width=150><b><font color=blue style='background-color:#FFFFFF'>Kembali ke MR Konsep 1 :<br>$r[tgl_kbl_k1]</font></b></td><td width=350>
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=upd&act=update3'>
<input type=hidden name=id_upd value=$r[id_upd]>
<input type=hidden name=reg_upd value=$r[reg_upd]>
<input type=hidden name=kode_dok value=$r[kode_dok]>
<input type=hidden name=pengusul value=$r[username]>
<input type=hidden name=konsep value='Konsep Ke-1'>
<input type=hidden name='tgl_kbl_k1' size=10 value='$tgl_sekarang'>
<input type=hidden name='tgl_kbl_k2' size=10 value=''>
<input type=hidden name='tgl_kbl_k3' size=10 value=''>
<br>
Ket.Tambahan :<input type=text name='keterangan2' size=30 value='$r[keterangan2]'>
<input type=submit value=Kirim>
                            <input type=button value=Batal onclick=self.history.back()></form></td></tr>
	<tr><td><b>Konsep 2 Kirim Ke :</b></td><td>$r[konsep2_krm]</td></tr>
	<tr><td><b>Tgl Kirim Konsep 2 :</b></td><td>$tgl_konsep2</td></tr>
<tr><td width=150><b><font color=blue style='background-color:#FFFFFF'>Kembali ke MR Konsep 2 :<br>$r[tgl_kbl_k2]</font></b></td><td width=350>
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=upd&act=update3'>
<input type=hidden name=id_upd value=$r[id_upd]>
<input type=hidden name=reg_upd value=$r[reg_upd]>
<input type=hidden name=kode_dok value=$r[kode_dok]>
<input type=hidden name=pengusul value=$r[username]>
<input type=hidden name=konsep value='Konsep Ke-2'>
<input type=hidden name='tgl_kbl_k2' size=10 value='$tgl_sekarang'>
<input type=hidden name='tgl_kbl_k1' size=10 value='$r[tgl_kbl_k1]'>
<input type=hidden name='tgl_kbl_k3' size=10 value='$r[tgl_kbl_k3]'>
Ket.Tambahan :<input type=text name='keterangan2' size=30 value='$r[keterangan2]'>
<input type=submit value=Kirim>
                            <input type=button value=Batal onclick=self.history.back()></form></td></tr>
<tr><td><b>Konsep 3 Kirim Ke :</b></td><td>$r[konsep3_krm]</td></tr>
	<tr><td><b>Tgl Kirim Konsep 3 :</b></td><td>$tgl_konsep3</td></tr>
<tr><td width=150><b><font color=blue style='background-color:#FFFFFF'>Kembali ke MR Konsep 3 :<br>$r[tgl_kbl_k3]</font></b></td><td width=350>
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=upd&act=update3'>
<input type=hidden name=id_upd value=$r[id_upd]>
<input type=hidden name=reg_upd value=$r[reg_upd]>
<input type=hidden name=kode_dok value=$r[kode_dok]>
<input type=hidden name=pengusul value=$r[username]>
<input type=hidden name=konsep value='Konsep Ke-3'>
<input type=hidden name='tgl_kbl_k3' size=10 value='$tgl_sekarang'>
<input type=hidden name='tgl_kbl_k1' size=10 value='$r[tgl_kbl_k1]'>
<input type=hidden name='tgl_kbl_k2' size=10 value='$r[tgl_kbl_k2]'>
Ket.Tambahan :<input type=text name='keterangan2' size=30 value='$r[keterangan2]'>
<input type=submit value=Kirim>
                            <input type=button value=Batal onclick=self.history.back()></form></td></tr>
<tr><td><b><font color=blue style='background-color:#FFFFFF'>STATUS ALUR USULAN</font></b></td></tr>
<tr><td><b>Konsep 1 Kirim Ke :</b></td><td>$r[konsep1_krm]</td></tr>
	<tr><td><b>Tgl Kirim Konsep 1 :</b></td><td>$tgl_konsep1</td></tr>
	<tr><td><b>Kembali ke MR Konsep 1 :</b></td><td>$tgl_kbl_k1</td></tr>

	<tr><td><b>Konsep 2 Kirim Ke :</b></td><td>$r[konsep2_krm]</td></tr>
	<tr><td><b>Tgl Kirim Konsep 2 :</b></td><td>$tgl_konsep2</td></tr>
		<tr><td><b>Kembali ke MR Konsep 2 :</b></td><td>$tgl_kbl_k2</td></tr>

	<tr><td><b>Konsep 3 Kirim Ke :</b></td><td>$r[konsep3_krm]</td></tr>
	<tr><td><b>Tgl Kirim Konsep 3 :</b></td><td>$tgl_konsep3</td></tr>
		<tr><td><b>Kembali ke MR Konsep 3 :</b></td><td>$tgl_kbl_k3</td></tr>

	<tr><td><b>Net 1 Kirim Ke :</b></td><td>$r[net1_krm]</td></tr>
	<tr><td><b>Tgl Kirim Net 1 :</b></td><td>$tgl_net1</td></tr>
		<tr><td><b>Tgl Kembali ke MR Net 1 :</b></td><td>$tgl_kbl_n1</td></tr>

	<tr><td><b>Net 2 Kirim Ke :</b></td><td>$r[net2_krm]</td></tr>
	<tr><td><b>Tgl Kirim Net 2 :</b></td><td>$tgl_net2</td></tr>
			<tr><td><b>Tgl Kembali ke MR Net2 :</b></td><td>$tgl_kbl_n2</td></tr>

	<tr><td><b>Net 3 Kirim Ke :</b></td><td>$r[net3_krm]</td></tr>
	<tr><td><b>Tgl Kirim Net 3 :</b></td><td>$tgl_net3</td></tr>
			<tr><td><b>Tgl Kembali ke MR Net 3 :</b></td><td>$tgl_kbl_n3</td></tr>

          </table>";
		  }
		  
    break;  
	
	case "netupd":
    $edit = mysql_query("SELECT * FROM upd WHERE id_upd='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

	
  echo "<h2>Usulan NET telah selesai di tindaklanjuti >Registrasi ke Dokumen</h2>
	      <b>*) format tgl : thn-bln-tgl (Contoh 12-Mei-10 tulis : 2010-05-12) </b>
          <form method=POST action=$aksi?module=upd&act=netupd enctype='multipart/form-data'>
          
          <table>
<tr><td width=160><b>Jenis Usulan :</b></td><td width=350>
<input type=hidden name=id_upd value=$r[id_upd]>
		  <input type=hidden name=kode_dok value=$r[kode_dok]>
		  <input type=hidden name=id_jendok value=$r[id_jendok]>
		  <input type=hidden name=status value='Net'>
<input type=text name='jenis_upd' size=10 value='$r[jenis_upd]'> > Pastikan UPD/UPDB/OBS !</td></tr>

<tr><td width=160><b>Tanggal Selesai :</b></td><td width=350><input type=text name='tgl_berlaku1' size=10 value='$tgl_sekarangku'></td></tr>
<tr><td width=70><b>Nama Dokumen :</b></td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
<tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
<tr><td width=70><b>Kode Komputer :</b></td>     <td><input type=text name='kode_kom' size=20 value='$r[kode_kom]'>pisahkan dengan koma (,)</td></tr>
<tr><td width=70><b><font color=blue style='background-color:#FFFFFF'>PJ/Pembuat Dok :</font></b></td>     <td><input type=text name='pj_dok' size=30 value='$r[pj_dok]'>pakai titik utk jabatan tertentu</td></tr>
<tr><td width=70><b>Dokumen terkait :</b></td>     <td><input type=text name='dok_terkait' size=30 value='$r[dok_terkait]'>pisahkan dengan koma (,)</td></tr>
<tr><td width=70><b>Revisi :</b></td>     <td><input type=text name='revisi' size=20 value='$r[revisi]'> > Jangan di rubah!</td></tr>
<tr><td align=center colspan=2><b><u>Table Dokumen (Isi Tgl Revisi/Berlaku terbaru)</u></b></td></tr>";


      $tgl_konsep1=tgl_indo5($r[tgl_konsep1]);
	  $tgl_kbl_k1=tgl_indo5($r[tgl_kbl_k1]);
	  $tgl_konsep2=tgl_indo5($r[tgl_konsep2]);
	  $tgl_kbl_k2=tgl_indo5($r[tgl_kbl_k2]);
	  $tgl_konsep3=tgl_indo5($r[tgl_konsep3]);
	  $tgl_kbl_k3=tgl_indo5($r[tgl_kbl_k3]);
	  $tgl_net1=tgl_indo5($r[tgl_net1]);
	  $tgl_kbl_n1=tgl_indo5($r[tgl_kbl_n1]);
	  $tgl_net2=tgl_indo5($r[tgl_net2]);
	  $tgl_kbl_n2=tgl_indo5($r[tgl_kbl_n2]);
	  $tgl_net3=tgl_indo5($r[tgl_net3]);
	  $tgl_kbl_n3=tgl_indo5($r[tgl_kbl_n3]);
	  $tgl_dist=tgl_indo5($r[tgl_dist]);
	  $tgl_dist_selesai=tgl_indo5($r[tgl_dist_selesai]);  
	  $tgl_upd=tgl_indo5($r[tgl_upd]);
	  $tgl_berlaku=tgl_indo5($r[tgl_berlaku]);
          $tgl_terima=tgl_indo5($r[tgl_terima]);
	  $hasilku1=$tgl_berlaku-$tgl_terima;	 
	  $hasilku2=$tgl_konsep1-$tgl_terima;
	  $hasilku3=$tgl_net1-$tgl_terima;
	  
							
 $edit1 = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$r[kode_dok]'");
    $t    = mysql_fetch_array($edit1);

 $tgl_berlaku=tgl_indo1($t[tgl_berlaku]);
	  $tgl_review=($t[tgl_berlaku]+3);
	
echo"
<tr><td><b>Tgl Revisi 0 :</b></td><td><input type=text name='tgl_rev0' value='$t[tgl_rev0]' size=20>*) Tulis Thn-Bln-Tgl</td></tr>
	<tr><td><b>Tgl Revisi 1 :</b></td><td><input type=text name='tgl_rev1' value='$t[tgl_rev1]' size=20>*) </td></tr>
	<tr><td><b>Tgl Revisi 2 :</b></td><td><input type=text name='tgl_rev2' value='$t[tgl_rev2]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 3 :</b></td><td><input type=text name='tgl_rev3' value='$t[tgl_rev3]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 4 :</b></td><td><input type=text name='tgl_rev4' value='$t[tgl_rev4]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 5 :</b></td><td><input type=text name='tgl_rev5' value='$t[tgl_rev5]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 6 :</b></td><td><input type=text name='tgl_rev6' value='$t[tgl_rev6]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 7 :</b></td><td><input type=text name='tgl_rev7' value='$t[tgl_rev7]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 8 :</b></td><td><input type=text name='tgl_rev8' value='$t[tgl_rev8]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 9 :</b></td><td><input type=text name='tgl_rev9' value='$t[tgl_rev9]' size=20>*)</td></tr>
    <tr><td><b>Tgl Revisi 10 :</b></td><td><input type=text name='tgl_rev10' value='$t[tgl_rev10]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 11 :</b></td><td><input type=text name='tgl_rev11' value='$t[tgl_rev11]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 12 :</b></td><td><input type=text name='tgl_rev12' value='$t[tgl_rev12]' size=20>*)</td></tr>
		<tr><td><b>Tgl Revisi 13 :</b></td><td><input type=text name='tgl_rev13' value='$t[tgl_rev13]' size=20>*)</td></tr>
			<tr><td><b>Tgl Revisi 14 :</b></td><td><input type=text name='tgl_rev14' value='$t[tgl_rev14]' size=20>*)</td></tr>
				<tr><td><b>Tgl Revisi 15 :</b></td><td><input type=text name='tgl_rev15' value='$t[tgl_rev15]' size=20>*)</td></tr>
	<tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Berlaku Terakhir :</font></b></td><td><input type=text name='tgl_berlaku' value='$t[tgl_berlaku]' size=20></td></tr>
	<tr><td><b>Tgl Review :</b></td><td><input type=text name='tgl_review' value='$tgl_review$tgl_berlaku' size=20>Jangan diisi - otomatis</td></tr>	
         <tr><td><b><font color=blue style='background-color:#FFFFFF'>Format Dokumen :</font></b></td>";
		 echo "<td><select name='nama_file'>";
 
          if ($t[nama_file]=='.doc'){
            echo "<option value='.doc' selected>.doc (word)</option>
			<option value='.xls'>.xls (excel)</option>";
          }   

         if ($t[nama_file]=='.xls'){
            echo "<option value='.doc'>.doc (word)</option>
			<option value='.xls' selected>.xls (excel)</option>";
          }   
		  
		  if ($t[nama_file]==''){
            echo "<option value='.doc' selected>.doc (word)</option>
			<option value='.xls'>.xls (excel)</option>";
          } 
		  
		 
		 echo"</select><br><b>Kalau Usulan Obsolete/ dokumen dihilangkan pilih CCHL-nya : KOSONGKAN !</b></td></tr>";

    $d = GetCheckboxes('cchl', 'cchl', 'cchl', $r[cchl]);

    echo "<tr><td><b>Ganti Penerima Dokumen Baru :</b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> $d </b>
	 
	</td></tr>";


echo "<tr><td colspan=2><input type=submit value='Net Selesai'>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
				  </table></form>";
	  break;  
	
case "nettupd":
    $edit = mysql_query("SELECT * FROM upd WHERE id_upd='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

	$tgl_konsep1=tgl_indo3($r[tgl_konsep1]);
	  $tgl_kbl_k1=tgl_indo3($r[tgl_kbl_k1]);
	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);
	  $tgl_kbl_k2=tgl_indo3($r[tgl_kbl_k2]);
	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);
	  $tgl_kbl_k3=tgl_indo3($r[tgl_kbl_k3]);
	  $tgl_net1=tgl_indo3($r[tgl_net1]);
	  $tgl_kbl_n1=tgl_indo3($r[tgl_kbl_n1]);
	  $tgl_net2=tgl_indo3($r[tgl_net2]);
	  $tgl_kbl_n2=tgl_indo3($r[tgl_kbl_n2]);
	  $tgl_net3=tgl_indo3($r[tgl_net3]);
	  $tgl_kbl_n3=tgl_indo3($r[tgl_kbl_n3]);
	  $tgl_konsep4=tgl_indo3($r[tgl_konsep4]);
	  $tgl_kbl_k4=tgl_indo3($r[tgl_kbl_k4]);
	  $tgl_konsep5=tgl_indo3($r[tgl_konsep5]);
	  $tgl_kbl_k5=tgl_indo3($r[tgl_kbl_k5]);
	  $tgl_konsep6=tgl_indo3($r[tgl_konsep6]);
	  $tgl_kbl_k6=tgl_indo3($r[tgl_kbl_k6]);
	  $tgl_net4=tgl_indo3($r[tgl_net4]);
	  $tgl_kbl_n4=tgl_indo3($r[tgl_kbl_n4]);
	  $tgl_net5=tgl_indo3($r[tgl_net5]);
	  $tgl_kbl_n5=tgl_indo3($r[tgl_kbl_n5]);
	  $tgl_net6=tgl_indo3($r[tgl_net6]);
	  $tgl_kbl_n6=tgl_indo3($r[tgl_kbl_n6]);
	  $tgl_dist=tgl_indo3($r[tgl_dist]);
	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);
	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]);
	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);
	  $follow1=tgl_indo3($r[follow1]);
	  $follow2=tgl_indo3($r[follow2]);
	  $follow3=tgl_indo3($r[follow3]);
	  $tgl_pending=tgl_indo3($r[tgl_pending]);
	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);
	  $tgl_upd=tgl_indo3($r[tgl_upd]);
	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);
	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);
      $tgl_terima=tgl_indo3($r[tgl_terima]);
	  $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);
      $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);
	
  echo "<h2>Usulan NET telah selesai di tindaklanjuti >Registrasi ke Dokumen (Khusus!)</h2>
	      <b>*) format tgl : thn-bln-tgl (Contoh 12-Mei-10 tulis : 2010-05-12) </b>
          <form method=POST action=$aksi?module=upd&act=nettupd enctype='multipart/form-data'>
          
          <table>
<tr><td width=160><b>Jenis Usulan :</b></td><td width=350>
<input type=hidden name=id_upd value=$r[id_upd]>
		  <input type=hidden name=kode_dok value=$r[kode_dok]>
		  <input type=hidden name=id_jendok value=$r[id_jendok]>
		  <input type=hidden name=status value='Net'>
		  <input type=hidden name='revisi' value='$r[revisi]'>
		  <input type=hidden name='username' value='$r[username]'>
		  <input type=hidden name='isi_upd' value='$r[isi_upd]'>
		 <input type=hidden name='kat_upd' value='$r[kat_upd]'>
        	 <input type=hidden name='keterangan' value='1'>
		  
<input type=text name='jenis_upd' size=10 value='$r[jenis_upd]'>>pastikan jenis usulan !!</td></tr>

<tr><td width=160><b>Tanggal Selesai (Real) :</b></td><td width=350><input type=text name='tgl_berlaku1' size=10 value='$tgl_sekarangku'></td></tr>
<tr><td width=70><b>Nama Dokumen :</b></td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
<tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
<tr><td width=70><b>Revisi :</b></td>     <td><input type=text name='revisi' size=20 value='$r[revisi]'> >Jangan dirubah!</td></tr>
<tr><td bgcolor=yellow align=center colspan=2><b><u>Isian untuk dibuat Usulan Khusus</u></b></td></tr>
<tr><td width=160><b>No Registrasi Usulan :</b></td><td width=350><input type=text name='reg_upd' size=20 value='$r[reg_upd]'>Ganti bulan dan tahun-nya saja.</td></tr>
<tr><td width=160><b>Tanggal Terima MR :</b></td><td width=350><input type=text name='tgl_terima' size=20 value='0000-00-00'></td></tr>
<tr><td width=160><b>Tanggal kirim Konsep :</b></td><td width=350><input type=text name='tgl_konsep1' size=20 value='0000-00-00'></td></tr>
<tr><td width=160><b>Tanggal kembali Konsep :</b></td><td width=350><input type=text name='tgl_kbl_k1' size=20 value='0000-00-00'></td></tr>
<tr><td width=160><b>Tanggal kirim Net :</b></td><td width=350><input type=text name='tgl_konsep2' size=20 value='0000-00-00'></td></tr>
<tr><td width=160><b>Tanggal kembali Net :</b></td><td width=350><input type=text name='tgl_kbl_k2' size=20 value='0000-00-00'></td></tr>
<tr><td width=160><b>Tanggal kirim Net (MPM) :</b></td><td width=350><input type=text name='tgl_konsep3' size=20 value='0000-00-00'></td></tr>
<tr><td width=160><b>Tanggal kembali Net (MPM) :</b></td><td width=350><input type=text name='tgl_kbl_k3' size=20 value='0000-00-00'></td></tr>


";


							
      $tgl_konsep1=tgl_indo5($r[tgl_konsep1]);
	  $tgl_kbl_k1=tgl_indo5($r[tgl_kbl_k1]);
	  $tgl_konsep2=tgl_indo5($r[tgl_konsep2]);
	  $tgl_kbl_k2=tgl_indo5($r[tgl_kbl_k2]);
	  $tgl_konsep3=tgl_indo5($r[tgl_konsep3]);
	  $tgl_kbl_k3=tgl_indo5($r[tgl_kbl_k3]);
	  $tgl_net1=tgl_indo5($r[tgl_net1]);
	  $tgl_kbl_n1=tgl_indo5($r[tgl_kbl_n1]);
	  $tgl_net2=tgl_indo5($r[tgl_net2]);
	  $tgl_kbl_n2=tgl_indo5($r[tgl_kbl_n2]);
	  $tgl_net3=tgl_indo5($r[tgl_net3]);
	  $tgl_kbl_n3=tgl_indo5($r[tgl_kbl_n3]);
	  $tgl_dist=tgl_indo5($r[tgl_dist]);
	  $tgl_dist_selesai=tgl_indo5($r[tgl_dist_selesai]);  
	  $tgl_upd=tgl_indo5($r[tgl_upd]);
	  $tgl_berlaku=tgl_indo5($r[tgl_berlaku]);
          $tgl_terima=tgl_indo5($r[tgl_terima]);
	  $hasilku1=$tgl_berlaku-$tgl_terima;	 
	  $hasilku2=$tgl_konsep1-$tgl_terima;
	  $hasilku3=$tgl_net1-$tgl_terima;
	  


							
 $edit1 = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$r[kode_dok]'");
    $t    = mysql_fetch_array($edit1);

 $tgl_berlaku=tgl_indo1($t[tgl_berlaku]);
	  $tgl_review=($t[tgl_berlaku]+3);
	
echo"
<tr><td align=center colspan=2><b><u>Registrasi Dokumen (Isi Tgl Revisi/Berlaku terbaru)</u></b></td></tr>
<tr><td width=70><b>Kode Komputer :</b></td>     <td><input type=text name='kode_kom' size=20 value='$r[kode_kom]'>pisahkan dengan koma (,)</td></tr>
<tr><td width=70><b><font color=blue style='background-color:#FFFFFF'>PJ/Pembuat Dok :</font></b></td>     <td><input type=text name='pj_dok' size=30 value='$r[pj_dok]'>pakai titik utk jabatan tertentu</td></tr>
<tr><td width=70><b>Dokumen terkait :</b></td>     <td><input type=text name='dok_terkait' size=30 value='$r[dok_terkait]'>pisahkan dengan koma (,)</td></tr>
<tr><td><b>Tgl Revisi 0 :</b></td><td><input type=text name='tgl_rev0' value='$t[tgl_rev0]' size=20>*) Tulis Thn-Bln-Tgl</td></tr>
	<tr><td><b>Tgl Revisi 1 :</b></td><td><input type=text name='tgl_rev1' value='$t[tgl_rev1]' size=20>*) </td></tr>
	<tr><td><b>Tgl Revisi 2 :</b></td><td><input type=text name='tgl_rev2' value='$t[tgl_rev2]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 3 :</b></td><td><input type=text name='tgl_rev3' value='$t[tgl_rev3]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 4 :</b></td><td><input type=text name='tgl_rev4' value='$t[tgl_rev4]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 5 :</b></td><td><input type=text name='tgl_rev5' value='$t[tgl_rev5]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 6 :</b></td><td><input type=text name='tgl_rev6' value='$t[tgl_rev6]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 7 :</b></td><td><input type=text name='tgl_rev7' value='$t[tgl_rev7]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 8 :</b></td><td><input type=text name='tgl_rev8' value='$t[tgl_rev8]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 9 :</b></td><td><input type=text name='tgl_rev9' value='$t[tgl_rev9]' size=20>*)</td></tr>
    <tr><td><b>Tgl Revisi 10 :</b></td><td><input type=text name='tgl_rev10' value='$t[tgl_rev10]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 11 :</b></td><td><input type=text name='tgl_rev11' value='$t[tgl_rev11]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 12 :</b></td><td><input type=text name='tgl_rev12' value='$t[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Berlaku terakhir :</font></b></td><td><input type=text name='tgl_berlaku' value='$t[tgl_berlaku]' size=20></td></tr>
	<tr><td><b>Tgl Review :</b></td><td><input type=text name='tgl_review' value='$tgl_review$tgl_berlaku' size=20>Jangan diisi - otomatis</td></tr>	
         <tr><td><b><font color=blue style='background-color:#FFFFFF'>Format Dokumen :</font></b></td>";
		 echo "<td><select name='nama_file'>";
 
          if ($t[nama_file]=='.doc'){
            echo "<option value='.doc' selected>.doc (word)</option>
			<option value='.xls'>.xls (excel)</option>";
          }   

         if ($t[nama_file]=='.xls'){
            echo "<option value='.doc'>.doc (word)</option>
			<option value='.xls' selected>.xls (excel)</option>";
          }   
		  
		  if ($t[nama_file]==''){
            echo "<option value='.doc' selected>.doc (word)</option>
			<option value='.xls'>.xls (excel)</option>";
          } 
		  
		 
		 echo"</select><br><b>Kalau Usulan Obsolete/ dokumen dihilangkan pilih CCHL-nya : KOSONGKAN !</b></td></tr>";

    $d = GetCheckboxes('cchl', 'cchl', 'cchl', $r[cchl]);

    echo "<tr><td><b>Ganti Penerima Dokumen Baru :</b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> $d </b>
	 
	</td></tr>";


echo "<tr><td colspan=2><input type=submit value='Net Selesai'>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
				  </table></form>";
	
	
	
}
?>
</div><!--/span12-->
</div><!--/block-content-->