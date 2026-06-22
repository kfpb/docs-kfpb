<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Dokumen Internal</div>
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
    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label]<br>";
  }
  return $str;
}


$aksi="../../include/mod_dokumen/aksi_dokumen.php";
$aksis="home.php?pages=dokint";
$aksi1="../../include/mod_upd/aksi_upd.php";
$aksi2="../../include/mod_pcopy/aksi_copy.php";
switch($_GET[act]){
   default:
       echo "<h2>Registrasi Dokumen Internal</h2>";
   		  // Form Pencarian Dokumen Judul

    if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){		 
// Tambah dokumen
    echo "<font size=2><b><u><font color=blue style='background-color:#FFFFFF'>Tambah Database Dokumen Manual : </font></u></b></font><input type=button value='Klik Disini' target='_blank' onclick=\"window.location.href='$aksis?act=tambahdokumen';\"><br>

	<br><hr color=#000890 noshade=noshade />";  
		
		  
echo "<b><u><font size=2><font color=blue style='background-color:#FFFFFF'>Cari - Tampilkan Semua Database Dokumen :</font></u></b></font><table><tr><td>
<font size=2>Berdasarkan kata kunci <b>Judul/ Kode Dokumen :</b></font>
      <form target=_blank method=POST action='$aksi?module=dokumen&act=caridokumen'>    
        <input name=kata type=text size=17 />
		<select name='kata1'>
            <option value=judul >Judul Dokumen</option>
            <option value=kode selected>Kode Dokumen</option>
			<option value=kode_kom>Kode Komputer</option>
</select>
        >><input type=submit value=Cari />
      </form></td></tr></table>";
	  
	  echo "<b><font size=2><font  style='background-color:#FFFFFF'>Cari Dokumen untuk Edit Khusus:</font></b></font><table><tr><td>
<font size=2>Berdasarkan kata kunci <b>Kode Dokumen :</b></font>
      <form target=_blank method=POST action='$aksi?module=dokumen&act=caridokumenedit'>    
        <input name=kata1 type=text size=17 />
	
        >><input type=submit value=Cari />
      </form></td></tr></table><br><hr color=#000890 noshade=noshade />";
	  
	   // Form Pencarian Per Jenis Dokumen tampilkan
echo "<b><u><font size=2><font color=blue style='background-color:#FFFFFF'>Tampil Registrasi Dokumen Terkendali (RDT) dan Copy Controlled Hold List (CCHL):</font></u></b></font><br><br>";
 
 // Form Pencarian RDT CCHL Per Jenis Dokumen tampilkan
echo "<font size=2>Tampilkan <b>RDT & CCHL</b>, per <b>Jenis Dokumen :</b></font>
      <form target=_blank method=POST action='$aksi?module=dokumen&act=caridokumen3'>    
 <select name='kata1'>
            <option value=rdt selected>RDT</option>
            <option value=cchl>CCHL</option>
</select>
<select name='kata'>
            <option value=0 selected>- Pilih Jenis Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_jendok]'>$r[nama_jendok]</option>";
            }
echo "</select>
        <br>>><input type=submit value=Tampil />
      </form><br>";
	  
	   // Form Pencarian RDT CCHL Per Jenis Dokumen tampilkan PDF
echo "<font size=2><u>Tampilkan dalam PDF</u> <b>RDT, CCHL, Jumlah Copy & Daftar Isi</b>, per <b>Jenis Dokumen :</b></font>
      <form target=_blank method=POST target=_blank action='/security1/pdf_lap.php'>    
 <select name='kata1'>
            <option value=rdt selected>RDT</option>
            <option value=cchl>CCHL</option>
			<option value=daftarisi>Daftar Isi</option>
			<option value=copy>Jumlah Copy</option>
</select>
<select name='kata'>
            <option value=0 selected>- Pilih Jenis Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_jendok]'>$r[nama_jendok]</option>";
            }
echo "</select>
        >><input type=submit value=Tampil />
      </form>";
	 echo "<br><hr color=#000890 noshade=noshade />";
	 
	 
	     // Cari dokumen yang harus direview
	 echo "<font size=2><font color=blue style='background-color:#FFFFFF'><b><u>Tampil Dokumen yang harus di Review</u></b></font> : </font><br>";
	 
	  echo "<font size=2><br>Tampilkan dalam browser <b>Dokumen yang harus di review </b> pada bulan:</b></font>
<form method=POST action='$aksi?module=dokumen&act=caridokumenreview' target=_blank>      
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
			<option value=2018- >2018</option></select>
		  
        >><input type=submit value=Tampil />
      </form>";
	  
	  
	    // Cari dokumen yang harus direview per PJ DOK
	 echo "<font size=2><font color=blue style='background-color:#FFFFFF'><b><u>Tampil Dokumen yang harus di Review Pejabat</u></b></font> : </font><br>";
	 
	  echo "<font size=2><br>Tampilkan dalam browser <b>Dokumen yang harus di review</b> pada bulan:</b></font>
<form method=POST action='$aksi?module=dokumen&act=caridokumenreview4' target=_blank>      
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
			<option value=2018- >2018</option></select>
		  
		  <select name='kata2'>
            <option value=0 selected>- Pilih Nama Jabatan -</option>";
			
            $tampil=mysql_query("SELECT * FROM CCHL ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
		  
		  
        >><input type=submit value=Tampil />
      </form>";
	  
	  
	   echo "<br><font size=2><br>Tampilkan dalam browser <br> (hanya untuk pembanding memastikan jumlah yang direview berdasarkan bulan tgl berlaku terakhir sama dengan tgl harus review)<br><b>Dokumen tgl berlaku terakhir </b> pada bulan:</b></font>
<form method=POST action='$aksi?module=dokumen&act=caridokumenreview3' target=_blank>      
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
			<option value=2010- >2010</option>
			<option value=2011- >2011</option>
			<option value=2012- >2012</option>
			<option value=2013- >2013</option>
			<option value=2014- >2014</option>		
            <option value=2015- >2015</option>	
		    <option value=2016- >2016</option>	
			<option value=2017- >2017</option>
			<option value=2018- >2018</option>
			
			</select>
		  
        >><input type=submit value=Tampil />
      </form>";
	 
	    echo "<font size=2><br>Tampilkan LAPORAN dalam browser <b>Dokumen yang TELAH di review </b> pada bulan:</b></font>
<form method=POST action='$aksi?module=dokumen&act=caridokumenreview0' target=_blank>      
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
			<option value=2018- >2018</option></select>
		  
        >><input type=submit value=Tampil />
      </form>";
		  
	  
	 echo "<br><hr color=#000890 noshade=noshade />";
	  


	    	    /* Tampilkan dokumen tgl berlaku per bulan
				
	 echo "<font size=2><font color=blue style='background-color:#FFFFFF'><b><u>Laporan-laporan Dokumen</u></b></font> : </font><br>";
		 echo "<font size=2><br>Tampilkan dalam PDF <b>Dokumen yang diterima bagian</b> pada bulan:</b></font>
      <form method=POST target=_blank action='/security11/pdf_dok_berlaku.php'>    
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
		    <option value=2016- >2016</option>	</select>
		    <select name='kata2'>
            <option value=0 selected>- Pilih Penerima Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
        >><input type=submit value=Tampil />
      </form>";
	  
		// Tampilkan dokumen tgl berlaku per bulan
		 echo "<font size=2><br>Tampilkan dalam halaman web <b>Dokumen yang diterima bagian</b> pada bulan:</b></font>
<form target=_blank method=POST action='$aksi?module=dokumen&act=caridokumenbag'>        
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
		    <option value=2016- >2016</option>	</select>
		    <select name='kata2'>
            <option value=0 selected>- Pilih Penerima Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
        >><input type=submit value=Tampil />
      </form>";
		
					
	  // Form Pencarian CCHL Per Jenis Dokumen tampilkan
echo "<font size=2><br>Tampilkan Daftar Dokumen yang dimiliki oleh <b>Penerima Dokumen :</b></font>
      <form method=POST action='$aksi?module=dokumen&act=caridokumen4' target=_blank>    
       	    <select name='kata'>
            <option value=0 selected>- Pilih Penerima Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
        <input type=submit value=Tampil />
      </form>
	  
	  <form method=POST action='$aksi?module=dokumen&act=caridokumen5' target=_blank>   
	<select name='kata'>
            <option value=0 selected>- Pilih Penerima Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
       	           <input type=submit value='Tampilkan Registrasi Dokumen (tanpa lampiran)' />
      </form>";
	  
	  
	  
 // Form Pencarian RDT Per Jenis Dokumen Per Jabatan
echo "<font size=2><br>Tampilkan Daftar Dokumen RDT Per <b>Penerima & Jenis Dokumen :</b></font>
      <form method=POST action='/security11/pdf_jendok_bag.php' target=_blank>    
       	    
			
			<select name='kata'>
            <option value=0 selected>- Pilih Penerima Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
<select name='kata1'>
            <option value=0 selected>- Pilih Jenis Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_jendok]'>$r[nama_jendok]</option>";
            }
echo "</select>
        <input type=submit value=Tampil />
      </form>";
	  
	  echo "<font size=2><br>Tampilkan Daftar Dokumen RDT (PDF) Per <b>Penerima Dokumen :</b></font>
      <form method=POST action='/security1/pdf_reg_bag.php' target=_blank>    
       	    
			
			<select name='kata'>
            <option value=0 selected>- Pilih Penerima Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
        <input type=submit value=Tampil />
      </form>";
	  
echo "<br><hr color=#000890 noshade=noshade />";

*/
}
else {

echo"";
}  
	  
	  	    
    if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){

      $tampil = mysql_query("SELECT * FROM dokumen ORDER BY kode_dok ASC LIMIT $posisi,$batas");
	  $tampil2 = mysql_query("SELECT * FROM dokumen ORDER BY kode_dok ASC");
	  $tampil3 = mysql_query("SELECT * FROM dokumen WHERE tgl_rev0 IS NULL");
	  $tampil4 = mysql_query("SELECT * FROM dokumen WHERE tgl_rev0='0000-00-00' ");
	  $tampil5 = mysql_query("SELECT * FROM dokumen WHERE judul_dok LIKE '%obsolete%'");
	  
	   	$jmldata = mysql_num_rows($tampil);
		$jmldata2 = mysql_num_rows($tampil2);
		$jmldata3 = mysql_num_rows($tampil3);
		$jmldata4 = mysql_num_rows($tampil4);
		$jmldata5 = mysql_num_rows($tampil5);
		$totaljmlh=$jmldata2-$jmldata5;
		
		echo "<font size=2><br>Total Semua Dokumen : $jmldata2";
	    echo "<font size=2><br>Total Dokumen Yang di Hilangkan/Obsolete : $jmldata5";
		echo "<font size=2><br>Total Dokumen Yang Aktif : $totaljmlh";
    }
    else{
      $kata = trim($_SESSION[bagian]) ;
	      
		  echo "<table><tr><td><b><u><font size=2>Cari dari semua database Dokumen :</u></b></font><br>
<font size=2>Berdasarkan kata kunci <b>Judul/ Kode Dokumen/ Kosongkan dan pilih Jenis Dokumen  :</b></font>
      <form method=POST action='$aksi?module=dokumen&act=caridokumenx' target=_blank>    
        
		<select name='kata1'>
            <option value=judul >Judul Dokumen</option>
            <option value=kode selected>Kode Dokumen</option>
</select> <br><input name=kata type=text size=17 /><br>
<select name='kata2'>
            <option value='0' selected>- Semua Jenis Dokumen/ Pilih Jenis Dokumen -</option>";
			
            $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_jendok]'>$r[nama_jendok]</option>";
            }
echo "</select><br>
        >><input type=submit value=Cari />
      </form></td></tr></table><br><hr color=#000890 noshade=noshade />";
		  
		  echo "
		  	<b><font size=2><u>Registrasi Dokumen Terkendali yang dimiliki $_SESSION[bagianuser] (RDT)</b></u> <br>>> Untuk melihat detail & PDF dokumen (Tgl Revisi Dokumen, Tgl Review, Tambahan Copy Controlled dll) klik DETAIL</font> </font><br>
			<form method=POST action='$aksi?module=dokumen&act=caridokumen5' target=_blank>   
	<input type=hidden value='$_SESSION[bagianuser]' name='kata'> 
       	           <input type=submit value='Tampilkan Registrasi Dokumen (tanpa lampiran!)' />
      </form><form method=POST action='$aksi?module=dokumen&act=caridokumen4' target=_blank>   
	<input type=hidden value='$_SESSION[bagianuser]' name='kata'> 
       	           <input type=submit value='Tampilkan Registrasi Dokumen (hanya lampiran!)' />
      </form>";
/*
	  // Tampilkan dokumen tgl berlaku per bulan
		 echo "<font size=2><br>Tampilkan <b>Dokumen yang diterima bagian $_SESSION[bagianuser]</b> pada bulan:</b></font>
      <form method=POST target=_blank action='$aksi?module=dokumen&act=caridokumenbag'>    
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
<option value=2016- >2018</option>
			</select>
		  
          <input type=hidden name=kata2 value='$_SESSION[bagianuser]'>
        >><input type=submit value=Tampil />
      </form>";
	  

	     // Cari dokumen yang harus direview
	 echo "<font size=2><b>Dokumen yang harus di Review Bulan & tahun yang dipilih oleh $_SESSION[bagianuser] </b> : </font><br>
	 <form method=POST action='$aksi?module=dokumen&act=caridokumenreview2'>      
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
		</select>
		  <input type=hidden name=kata2 value='$_SESSION[bagianuser]'>
        >><input type=submit value=Tampil />
      </form>";
	
	
	 // Cari dokumen yang harus direview
	 echo "<font size=2><b>Dokumen yang telah di Review Bulan & tahun yang dipilih </b> : </font><br>
	 <form method=POST action='$aksi?module=dokumen&act=caridokumenreview00'>      
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
		</select>
        >><input type=submit value=Tampil />
      </form>
	 */
      echo"	<br>
  <br>

      
      ";

    }
	
   break;
  
  
// -------------------------------------------------------------------------------------------REVIEW DOKUMEN
  case "reviewdokumen":

  $bln_thn =tgl_indo1($bln_thn_sekarang);
   $bln_thn1 =tgl_indo($bln_thn_sekarang);
$kata3 = $_SESSION[bagianuser];

  echo "<h2>Dokumen yang harus direview bulan : $bln_thn1</h2>";
	
echo "<font size=2><b>Cek dokumen-dokumen dibawah yang harus direview bulan ini di jajaran $_SESSION[bagianuser]. Jika bagian anda memiliki dokumen yang harus direview dibawah ini, silahkan lakukan review dan cek isi dokumen tersebut apakah masih sesuai atau tidak. Bila tidak ada perubahan hubungi dan serahkan dokumen ke MR untuk di lakukan penulisan review pada dokumen controlled bersamaan dengan dokumen master, bila ada perubahan setelah anda review segera lakukan usulan perubahan dokumen (UPD)</b><br><table>
          <tr><th>No</th><th>Kode Dok</th><th>Judul Dok</th><th>Tgl Review</th></tr>";
	 
	 $bln_thn_sekarang = date("2012-10");
	 $kata = $bln_thn_sekarang ;
	 
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " and cchl like '%$kata3%' ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		echo "<font size=2><br>Total Dokumen yang harus di review : $jmldata";
	   
    $no = $posisi+1;
    while($r=mysql_fetch_array($hasil)){
	
    $tgl_review=tgl_indo($r[tgl_review]);
     
      echo "
	  <tr><td>$no</td>
				<td width=60>$r[kode_dok]</td>
                <td width=200>$r[judul_dok]</td>
				<td width=100>$tgl_review</td></tr>";
			$no++;
	  }
	
    echo "</table>";

 	
 		 echo "<p align=center>
<center><font size=2><b><a href=media.php?module=dokumen><--Kembali</a></p></b></center>";

    break;
  
  
  
 
   case "detaildokumen":
   
      $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
       $r    = mysql_fetch_array($edit);
   
    echo "<h2>Detail Dokumen</h2>
          <table border=1>
          <tr><td width=150><b>Kode Dokumen :</b></td>     <td width=350>$r[kode_dok]</td></tr>
		   <tr><td width=70><b>Judul Dokumen :</b></td>     <td>$r[judul_dok]</td></tr>
		   	<tr><td><b>Penanggung Jawab/ Pembuat Dokumen :</b> </td><td>$r[pj_dok]</td></tr>
		   <tr><td width=150><b>Kode Komputer : (Bahan,Produk,Aktiva)</b></td>     <td width=350>$r[kode_kom]</td></tr>
		   <tr><td width=150><b>Dokumen terkait : </b></td>     <td width=350>$r[dok_terkait]</td></tr>
          <tr><td><b>Jenis Dokumen :</b></td><td>";
		   
		   $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  
		  
		  echo "$jenisdok[nama_jendok]</td></tr>";
          
	  $tgl_rev0=tgl_indo($r[tgl_rev0]);
      $tgl_rev1=tgl_indo($r[tgl_rev1]);
      $tgl_rev2=tgl_indo($r[tgl_rev2]);
      $tgl_rev3=tgl_indo($r[tgl_rev3]);
      $tgl_rev4=tgl_indo($r[tgl_rev4]);
      $tgl_rev5=tgl_indo($r[tgl_rev5]);
      $tgl_rev6=tgl_indo($r[tgl_rev6]);
      $tgl_rev7=tgl_indo($r[tgl_rev7]);
      $tgl_rev8=tgl_indo($r[tgl_rev8]);
      $tgl_rev9=tgl_indo($r[tgl_rev9]);
      $tgl_rev10=tgl_indo($r[tgl_rev10]);
      $tgl_rev11=tgl_indo($r[tgl_rev11]);
      $tgl_rev12=tgl_indo($r[tgl_rev12]);
	  $tgl_rev13=tgl_indo($r[tgl_rev13]);
      $tgl_rev14=tgl_indo($r[tgl_rev14]);
      $tgl_rev15=tgl_indo($r[tgl_rev15]);
	  $tgl_berlaku=tgl_indo($r[tgl_berlaku]);
      $tgl_review=tgl_indo($r[tgl_review]);
	  $tgl_review1=tgl_indo($r[tgl_review1]);
	  $tgl_review2=tgl_indo($r[tgl_review2]);
	  $tgl_review3=tgl_indo($r[tgl_review3]);
	  
		  		  
    echo "<td><b>Tgl Revisi 0 :</b></td><td>$tgl_rev0</td></tr>
	<td><b>Tgl Revisi 1 :</b></td><td>$tgl_rev1</td></tr>
	<td><b>Tgl Revisi 2 :</b></td><td>$tgl_rev2</td></tr>
	<td><b>Tgl Revisi 3 :</b></td><td>$tgl_rev3</td></tr>
	<td><b>Tgl Revisi 4 :</b></td><td>$tgl_rev4</a></td></tr>
	<td><b>Tgl Revisi 5 :</b></td><td>$tgl_rev5</a></td></tr>
	<td><b>Tgl Revisi 6 :</b></td><td>$tgl_rev6</a></td></tr>
	<td><b>Tgl Revisi 7 :</b></td><td>$tgl_rev7</a></td></tr>
	<td><b>Tgl Revisi 8 :</b></td><td>$tgl_rev8</a></td></tr>
	<td><b>Tgl Revisi 9 :</b></td><td>$tgl_rev9</a></td></tr>
    <td><b>Tgl Revisi 10 :</b></td><td>$tgl_rev10</a></td></tr>
	<td><b>Tgl Revisi 11 :</b></td><td>$tgl_rev11</a></td></tr>
	<td><b>Tgl Revisi 12 :</b></td><td>$tgl_rev12</a></td></tr>
	<td><b>Tgl Revisi 13 :</b></td><td>$tgl_rev13</a></td></tr>
	<td><b>Tgl Revisi 14 :</b></td><td>$tgl_rev14</a></td></tr>
	<td><b>Tgl Revisi 15 :</b></td><td>$tgl_rev15</a></td></tr>
         </tr>
		          <tr><td><b>Penerima Dokumen :</b> </td><td>$r[cchl]</td></tr>

				  <tr><td><b>Tambahan Copy Controlled :</b> </td><td>$r[cchl2]</td></tr>
   		          <tr><td><b>Tgl berlaku terakhir :</b> </td><td>$tgl_berlaku</td></tr>
				  <tr><td><b>Tgl Review 1 :</b> </td><td>$tgl_review1</td></tr>
				  <tr><td><b>Hasil Review 1 :</b> </td><td>$r[hasil_review1]</td></tr>
				  <tr><td><b>Tgl Review 2 :</b> </td><td>$tgl_review2</td></tr>
				  <tr><td><b>Hasil Review 2 :</b> </td><td>$r[hasil_review2]</td></tr>
				  <tr><td><b>Tgl Review 3 :</b> </td><td>$tgl_review3</td></tr>
				  <tr><td><b>Hasil Review 3 :</b> </td><td>$r[hasil_review3]</td></tr>
				  <tr><td><b>Review terakhir oleh :</b> </td><td>$r[review_oleh]</td></tr>
				    <tr><td><b>Tgl Maks Review selanjutnya :</b> </td><td>$tgl_review</td></tr>
	
         </table>";

    break;  
  
   case "pdfdokumen":
   
      $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
       $r    = mysql_fetch_array($edit);
   
    echo "<object data='http://localhost/master_pdf/$r[id_jendok]/$r[kode_dok].pdf' type='application/pdf' width='100%' height='100%'>
 
  <p>Nampaknya komputer browser anda tidak memiliki program untuk melihat dokumen PDF. Silahkan install dulu misalnya Adobe Reader.
  Tapi jangan khawatir anda dapat download file-nya : <a href='../../master_pdf/$r[id_jendok]/$r[kode_dok].pdf'>Klik disini.</a></p>
  
</object>";
    break;  
  
  case "tambahdokumen":
    echo "<h2>Tambah Dokumen</h2>
          <form method=POST action='$aksi?module=dokumen&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table>
		  <tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20></td></tr>
          <tr><td width=70><b>Nama Dokumen:</b></td>     <td><input type=text name='judul_dok' size=60></td></tr>
          <tr><td><b>Jenis Dokumen :<b></td>  <td> 
          <select name='id_jendok'>
            <option value=0 selected>- Pilih Jenis Dokumen -</option>";
            $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_jendok]>$r[nama_jendok]</option>";
            }
    echo "</select></td>
		</tr>
<tr><td width=70><b>Kode Komputer:</b></td><td><input type=text name='kode_kom' size=40> >Pisahkan dengan koma spasi (, )</td></tr>
<tr><td width=70><b>Dok Terkait:</b></td><td><input type=text name='dok_terkait' size=40> >Pisahkan dengan koma spasi (, )</td></tr>
<tr><td><b>Tgl Revisi 0 :</b></td><td><input type=text name='tgl_rev0' size=20>*) Tulis Thn-Bln-Tgl</td></tr>
<tr><td><b>Tgl Revisi 1 :</b></td><td><input type=text name='tgl_rev1' size=20>*) </td></tr>
<tr><td><b>Tgl Revisi 2 :</b></td><td><input type=text name='tgl_rev2' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 3 :</b></td><td><input type=text name='tgl_rev3' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 4 :</b></td><td><input type=text name='tgl_rev4' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 5 :</b></td><td><input type=text name='tgl_rev5' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 6 :</b></td><td><input type=text name='tgl_rev6' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 7 :</b></td><td><input type=text name='tgl_rev7' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 8 :</b></td><td><input type=text name='tgl_rev8' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 9 :</b></td><td><input type=text name='tgl_rev9' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 10 :</b></td><td><input type=text name='tgl_rev10' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 11 :</b></td><td><input type=text name='tgl_rev11' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 12 :</b></td><td><input type=text name='tgl_rev12' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 13 :</b></td><td><input type=text name='tgl_rev13' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 14 :</b></td><td><input type=text name='tgl_rev14' size=20>*)</td></tr>
<tr><td><b>Tgl Revisi 15 :</b></td><td><input type=text name='tgl_rev15' size=20>*)</td></tr>
<tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Berlaku Terakhir :</font'></b></td><td><input type=text name='tgl_berlaku' size=20>*) Isi dengan tgl revisi terakhir</td></tr>
<tr><td><b>Tambahan Copy Controlled :</b></td><td><input type=text name='cchl2' size=60></td></tr>
<tr><td><b>Deret Pemohon Copy :</b></td><td><input type=text name='keterangan' size=60></td></tr>
<tr><td><b>Arsip Pemohon Copy:</b></td><td><input type=text name='keterangan3' size=60></td></tr>
<tr><td><b>Ekstension File :</b></td><td>
<select name='nama_file'><option value='.doc' selected>.doc (word)</option><option value'.xls'>.xls (excel)</option></select>
default .doc ganti .xls jika excel</td></tr>";

    $cchl = mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
    echo "<tr><td><b>Penerima Dokumen : </b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> ";
    while ($t=mysql_fetch_array($cchl)){
      echo "<input type=checkbox value='$t[cchl]' name=cchl[]>>$t[cchl]<br> ";
    }
    
    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;


  
	  case "copydokumen":
    $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Entry permohonan copy Dokumen</h2>
	<font size=2><b><font color=blue style='background-color:#FFFFFF'>Mohon isi yang belum terisi (Yang cetak tebal & Highlight)</font></b></font>
          <form target=_blank method=POST action=$aksi2?module=pcopy&act=input enctype='multipart/form-data'>
          <table>
		    <tr><td><b><font color=blue style='background-color:#FFFFFF'>Jenis Permohonan Copy :</font></b></td>      <td> 
		  
		   <select name='kat_copy'>
            <option value=0 >- Pilih Jenis Usulan -</option>
			<option value='controlled' selected>Permintaan Salinan Controlled</option>
			<option value='cpb-ckb'>Permintaan Batch Record (CPB-CKB)</option>
			<option value='bekas'>Permintaan Print Kertas Bekas</option>
			<option value='file'>Permintaan File/Kirim Email</option>
			</select>
		  </td></tr>
		  <tr><td width=70>Dok 1</td><td>Kode Dokumen :<input type=text name='kode_dok' size=10 value='$r[kode_dok]'>
	Kode Komputer : <input type=text name='kode_kom' size=10 value='$r[kode_kom]'><br>
    Nama Dokumen : <input type=text name='judul_dok' size=40 value='$r[judul_dok]'>
	<input type=hidden name='id_jendok' size=60 value='$r[id_jendok]'></td></tr>
		
		
		  <tr><td><b><font color=blue style='background-color:#FFFFFF'>Revisi Dok 1 :</font></b></td>      <td><input type=text name='revisi' value='-' size=1><b>*)Isi revisi dokumen ke-1 yang dicopy (untuk rev 0-9 satu digit saja!)</B></td></tr>
           <tr><td><b><font color=blue style='background-color:#FFFFFF'>Jumlah Copy 1 :</font></b></td>      <td><input type=text name='jml_copy' value='1' size=3><b>EDIT JIKA PERLU (Copy dokumen ke-1)</B></td></tr>
         
		 
		  <tr><td width=70>Dok 2</td><td>Kode Dokumen : <input type=text name='kode_dok2' size=10 value=''>
	Revisi : <input type=text name='revisi2' size=3 value=''> Jml : <input type=text name='jml_copy2' value='' size=3><br>
    Nama Dokumen : <input type=text name='judul_dok2' size=40 value=''></td></tr>
		  <tr><td width=70>Dok 3</td><td>Kode Dokumen : <input type=text name='kode_dok3' size=10 value=''>
	Revisi : <input type=text name='revisi3' size=3 value=''>  Jml : <input type=text name='jml_copy3' value='' size=3><br>
    Nama Dokumen : <input type=text name='judul_dok3' size=40 value=''></td></tr>
					  <tr><td width=70>Dok 4</td><td>Kode Dokumen :<input type=text name='kode_dok4' size=10 value=''>
	Revisi : <input type=text name='revisi4' size=3 value=''>  Jml : <input type=text name='jml_copy4' value='' size=3><br>
    Nama Dokumen : <input type=text name='judul_dok4' size=40 value=''></td></tr>
						  <tr><td width=70>Dok 5</td><td>Kode Dokumen :<input type=text name='kode_dok5' size=10 value=''>
	Revisi : <input type=text name='revisi5' size=3 value=''>  Jml : <input type=text name='jml_copy5' value='' size=3><br>
    Nama Dokumen : <input type=text name='judul_dok5' size=40 value=''></td></tr>
<tr><td><b><font color=blue style='background-color:#FFFFFF'>Kepentingan/Alasan Copy :</font></b></td>      <td><input type=text name='keterangan1' value='' size=40></td></tr>
		 ";
        
		  
		  
    
$tgl_sekarang = date("Y-m-d");
 	if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){ 
          echo "

          <tr><td><b><font color=blue style='background-color:#FFFFFF'>Pemohon :</font></b></td>    <td> 
		  <select name='username'>
		   <option value=0 selected>- Pilih Pemohon Copy -</option>";
							
            $tampil1=mysql_query("SELECT * FROM users ORDER BY nama_lengkap");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[bagian]>$r[bagian]</option>";
            }
			echo "</select></td></tr>";
}
			else
			{
			 echo "<tr><td>Pemohon :</td>      <td><input type=hidden name=username 
			 value='$_SESSION[bagianuser]'>$_SESSION[bagianuser]</td></tr>";
			 }
			
		if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){ 
          echo "
				 <tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Permohonan Copy :</font></b></td>      <td><input type=text name='tgl_copy' value='$tgl_sekarang' size=10><b>EDIT IF *)Tahun-Bulan-tanggal</B></td></tr>
     <tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Selesai Copy :</font></b></td>      <td><input type=text name='tgl_slesai_copy' value='0000-00-00' size=10><b>EDIT *)Tahun-Bulan-tanggal</B></td></tr>
    			";
		}
		else{
			
			 echo "
				 <tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Permohonan Copy :</font></b></td>      <td><input type=hidden name='tgl_copy' value='$tgl_sekarang' size=10><b>$tgl_sekarang</B></td></tr>
    			";
			
			
		}
				
					if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){ 
      		
				
	$edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
				  echo "<tr><td colspan=2><b>Permintaan tambahan copy controlled + jumlah + dimana, [ Contoh : AMPP+1 (R0-di alat) ] : </td></tr>";
	
	    echo "<tr><td colspan=2><input type=text name='cchl2' value='$r[cchl2]' size=80></td></tr>";
    echo "<tr><td><b>Deret Tambahan Copy :</b></td><td><input type=text name='keterangan' value='$r[keterangan]' size=60><br>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SKB., SP., SIA., MR.</td></tr>";
	echo "<tr><td><b>Arsip Permintaan Copy :</b></td><td><input type=text name='keterangan3' value='$r[keterangan3]' size=60><br></td></tr>";

					}
					else {}
	
	
    echo  "<tr><td colspan=2><input type=submit value='Simpan P-Copy'>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
	
	
	  case "upddokumen":
    $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Entry/ Buat Usulan Dokumen</h2>
	<font size=2><b><font color=blue style='background-color:#FFFFFF'>Mohon isi yang belum terisi (Wajib diisi yang warna biru)</font></b></font>
          <form target=_blank method=POST action=$aksi1?module=upd&act=input enctype='multipart/form-data' onSubmit='return validasiku(this)'>
          <table>
		  
		    <tr><td width=120>Jenis Usulan :</td>      <td> 
		  
		   <select name='jenis_upd'>
            <option value=0 >- Pilih Jenis Usulan -</option>
			<option value='UPD' selected>Usulan Perubahan Dokumen</option>
			<option value='OBS'>Usulan Obsolete/Hapus Dokumen dari RDT</option>
			</select>
		  </td></tr>
		  <tr><td width=70>No Change Control :</td><td><input type=text name='no_cc' size=20 value='$r[no_cc]'> Jika ada</td></tr>
		  <tr><td width=70>Kode Dokumen :</td><td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'><input type=hidden name='keterangan' value='0'></td></tr>
		   <tr><td width=70>Kode Komputer :</td><td><input type=text name='kode_kom' size=20 value='$r[kode_kom]'> Jika ada</td></tr>
		      	<tr><td width=70>PJ/Pmbuat Dok :</td><td><input type=text name='pj_dok' size=20 value='$r[pj_dok]'></td></tr>
		   	<tr><td width=70>Dokumen Terkait :</td><td><input type=text name='dok_terkait' size=20 value='$r[dok_terkait]'> Jika ada</td></tr>
		  <tr><td><b><font color=blue style='background-color:#FFFFFF'>Revisi Dok :</font></b></td>      <td><input type=text name='revisi' size=1><b>*)Isi rev dok yang akan dirubah (untuk rev 0-9 satu digit saja!)</B></td></tr>
          <tr><td width=70>Nama Dokumen :</td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
		  
        <tr><td>Jenis Dokumen :</td>  <td><select name='id_jendok'>";
 
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
echo"<tr><td><b><font color=blue style='background-color:#FFFFFF'>Isi Usulan</font> (Uraian usulan sebelum dan sesudah):</b></td>  <td> <textarea name='isi_upd' style='width: 400px; height: 100px;'></textarea></td></tr>";
	    $d = GetCheckboxes('cchl', 'cchl', 'cchl', $r[cchl]);

    echo "<tr><td>Penerima Dokumen (Jika tidak ada perubahan, jangan di ubah) :</td><td><input type=checkbox name='checkall' onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> $d </td></tr>";
 
 	if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){ 
          echo "
			<tr><td>Usulan Elektronik</td>     <td> : <input type=radio name='usulan_eks' value='Y'> Y   
                                           <input type=radio name='usulan_eks' value='N' checked> N </td></tr>
          <tr><td><b><font color=blue style='background-color:#FFFFFF'>Pengusul :</font></b></td>    <td> 
		  <select name='username'>
		   <option value=0 selected>- Pilih Pengusul Dokumen -</option>";
							
            $tampil1=mysql_query("SELECT * FROM users ORDER BY nama_lengkap");
            while($r=mysql_fetch_array($tampil1)){
              echo "<option value=$r[bagian]>$r[bagian]</option>";
            }
			echo "</select></td>Isi dengan Supervisor pengusul kalau memungkinkan, penanggung jawab dokumen yang tercantum di prosedur</tr>";
			
			echo "
<tr><td><font color=blue style='background-color:#FFFFFF'><b>Bagian/Jajaran :</b></font></td>    <td> 
		  <select name='username2'>
		   <option value=0 selected>- Pilih Jajaran/Bagian Pengusul -</option>
		   <option value='PM.'>Plant Manager</option>
		   <option value='AMK3L'>K3L</option>
		   <option value='MP.'>Manager Produksi</option>
		   <option value='AMP1'>Produksi 1</option>
		   <option value='AMP2'>Produksi 2</option>
		   <option value='AMP3'>Produksi 3</option>
		   <option value='AMPM'>Pengawasan Mutu/QC</option>
		   <option value='MPM'>Manager Pemastian Mutu</option>
		   <option value='AMSM'>Sistem Mutu/QA</option>
		   <option value='AMPP'>Pengembangan Produk</option>
		   <option value='AMB'>Pembelian</option>
		   <option value='MPPPI'>Manager PPPI</option>
		   <option value='AMS'>Penyimpanan</option>
		   <option value='AMRDBPP'>Rendal Bahan Proses Produksi</option>
		   <option value='AMAU'>Akuntansi & Keuangan</option>
		   <option value='AMUSDM'>Umum & Adm Personalia</option>
		   <option value='AMTP'>Teknik & Pemeliharaan</option>";
										
            
			echo "</select></td></tr>";
			
			
			
}
			else
			{
			 echo "		    <input type=hidden name='usulan_elk' 
			 value='Y'>
			 <tr><td>Pejabat Pengusul :</td>      <td><input type=hidden name=username 
			 value='$_SESSION[bagianuser]'>$_SESSION[bagianuser]</td></tr>
			 <tr><td>Bagian Pengusul :</td>      <td><input type=hidden name=username 
			 value='$_SESSION[bagianuser2]'>$_SESSION[bagianuser2]</td></tr>
			 ";
			 }
			
			
			
 
echo "
<tr><td><b>Upload File UPD :</font></b></td><td><input type=file name='fupload' size=40><b>*)jika ada</b></td></tr>";
if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]=1){ 
          echo "<tr><td colspan=2><b>Permintaan tambahan copy controlled (Jumlah diuser default = 1 dokumen jika akan menambah tulis +, contoh MR+1, jadi MR punya 2 dokumen controlled) : </td></tr>";
	
	    echo "<tr><td colspan=2><input type=text name='cchl2' value='$r[cchl2]' size=80></td></tr>";
    echo "<tr><td><b>Deret Tambahan Copy :</b></td><td><input type=text name='keterangan' value='$r[keterangan]' size=60><br>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</td></tr>";
	echo "<tr><td><b>Arsip/ Keterangan :</b></td><td><input type=text name='keterangan3' value='$r[keterangan3]' size=60><br></td></tr>";
}
else { }
	
	
    echo  "<tr><td colspan=2><input type=submit value='Simpan'>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
	
	
	
	
  case "emaildokumen":
    $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Email Informasi Distribusi dokumen</h2>
          <form name=myform method=POST action=$aksi?module=dokumen&act=email enctype='multipart/form-data'>
          <table>
		  <tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
		  <tr><td width=70><b>Kode Komputer :</b></td>     <td><input type=text name='kode_kom' size=20 value='$r[kode_kom]'></td></tr>
		  <tr><td width=70><b>Dokumen terkait :</b></td>     <td><input type=text name='dok_terkait' size=50 value='$r[dok_terkait]'></td></tr>
          <tr><td width=70><b>Nama Dokumen :</b></td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
		  
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
    echo "</select></td></tr>";
 $tgl_berlaku=tgl_indo1($r[tgl_berlaku]);
	  $tgl_review=($r[tgl_berlaku]+3);
	  
	echo "<tr><td width=70><b>PJ/ Pembuat Dok :</b></td>     <td><input type=text name='pj_dok' size=60 value='$r[pj_dok]'></td></tr>
	<tr><td><b>Tgl Revisi 0 :</b></td><td><input type=text name='tgl_rev0' value='$r[tgl_rev0]' size=20>*) Tulis Thn-Bln-Tgl</td></tr>
	<tr><td><b>Tgl Revisi 1 :</b></td><td><input type=text name='tgl_rev1' value='$r[tgl_rev1]' size=20>*) </td></tr>
	<tr><td><b>Tgl Revisi 2 :</b></td><td><input type=text name='tgl_rev2' value='$r[tgl_rev2]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 3 :</b></td><td><input type=text name='tgl_rev3' value='$r[tgl_rev3]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 4 :</b></td><td><input type=text name='tgl_rev4' value='$r[tgl_rev4]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 5 :</b></td><td><input type=text name='tgl_rev5' value='$r[tgl_rev5]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 6 :</b></td><td><input type=text name='tgl_rev6' value='$r[tgl_rev6]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 7 :</b></td><td><input type=text name='tgl_rev7' value='$r[tgl_rev7]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 8 :</b></td><td><input type=text name='tgl_rev8' value='$r[tgl_rev8]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 9 :</b></td><td><input type=text name='tgl_rev9' value='$r[tgl_rev9]' size=20>*)</td></tr>
   <tr> <td><b>Tgl Revisi 10 :</b></td><td><input type=text name='tgl_rev10' value='$r[tgl_rev10]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 11 :</b></td><td><input type=text name='tgl_rev11' value='$r[tgl_rev11]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 12 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 13 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 14 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 15 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b><font color=blue style='background-color:#FFFFFF'>Revisi Terakhir :</font></b></td><td><input type=text name='rev_terakhir' value='' size=20> Isi dengan revisi terakhir !!</td></tr>
	<tr><td><b>Tgl Berlaku Terakhir :</b></td><td><input type=text name='tgl_berlaku' value='$r[tgl_berlaku]' size=20> tgl revisi terakhir</td></tr>
	<tr><td><b>Tgl Review :</b></td><td><input type=text name='tgl_review' value='$r[tgl_review]' size=20>Maks Review selanjutnya</td></tr>
	<tr><td><b>Penerima Dokumen :</b></td><td>$r[cchl]</td></tr>";
   	
	$user = mysql_query("SELECT * FROM users ORDER BY username");
    echo "<tr><td><b>Penerima E-Mail</b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> ";
    while ($t=mysql_fetch_array($user)){
      echo "<input type=checkbox value='$t[email]' name=username[]>->$t[bagian] <br>";
    }
	

	
    echo  "</td></tr><tr><td colspan=2><input type=submit value=Kirim_email>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
	
	
	case "editdokumen":
    $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit dokumen</h2>
          <form name=myform method=POST action=$aksi?module=dokumen&act=update enctype='multipart/form-data'>
          <table>
		  <tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
		  <tr><td width=70><b>Kode Komputer :</b></td>     <td><input type=text name='kode_kom' size=20 value='$r[kode_kom]'></td></tr>
		  <tr><td width=70><b>Dokumen terkait :</b></td>     <td><input type=text name='dok_terkait' size=50 value='$r[dok_terkait]'></td></tr>
          <tr><td width=70><b>Nama Dokumen :</b></td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
		  
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
    echo "</select></td></tr>";
 $tgl_berlaku=tgl_indo1($r[tgl_berlaku]);
	  $tgl_review=($r[tgl_berlaku]+3);
	  
	echo "<tr><td width=70><b>PJ/ Pembuat Dok :</b></td>     <td><input type=text name='pj_dok' size=60 value='$r[pj_dok]'></td></tr>
	<tr><td><b>Tgl Revisi 0 :</b></td><td><input type=text name='tgl_rev0' value='$r[tgl_rev0]' size=20>*) Tulis Thn-Bln-Tgl</td></tr>
	<tr><td><b>Tgl Revisi 1 :</b></td><td><input type=text name='tgl_rev1' value='$r[tgl_rev1]' size=20>*) </td></tr>
	<tr><td><b>Tgl Revisi 2 :</b></td><td><input type=text name='tgl_rev2' value='$r[tgl_rev2]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 3 :</b></td><td><input type=text name='tgl_rev3' value='$r[tgl_rev3]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 4 :</b></td><td><input type=text name='tgl_rev4' value='$r[tgl_rev4]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 5 :</b></td><td><input type=text name='tgl_rev5' value='$r[tgl_rev5]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 6 :</b></td><td><input type=text name='tgl_rev6' value='$r[tgl_rev6]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 7 :</b></td><td><input type=text name='tgl_rev7' value='$r[tgl_rev7]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 8 :</b></td><td><input type=text name='tgl_rev8' value='$r[tgl_rev8]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 9 :</b></td><td><input type=text name='tgl_rev9' value='$r[tgl_rev9]' size=20>*)</td></tr>
   <tr> <td><b>Tgl Revisi 10 :</b></td><td><input type=text name='tgl_rev10' value='$r[tgl_rev10]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 11 :</b></td><td><input type=text name='tgl_rev11' value='$r[tgl_rev11]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 12 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 13 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 14 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b>Tgl Revisi 15 :</b></td><td><input type=text name='tgl_rev12' value='$r[tgl_rev12]' size=20>*)</td></tr>
	<tr><td><b><font color=blue style='background-color:#FFFFFF'>Tgl Berlaku Terakhir :</font></b></td><td><input type=text name='tgl_berlaku' value='$r[tgl_berlaku]' size=20> Isi dengan tgl revisi terakhir</td></tr>
	<tr><td><b>Tgl Review :</b></td><td><input type=text name='tgl_review' value='$r[tgl_review]' size=20>Maks Review selanjutnya (Edit Manual!)</td></tr>
	<tr><td><b>Tgl Review 1 :</b></td><td><input type=text name='tgl_review1' value='$r[tgl_review1]' size=20></td>
    <tr><td><b>Hasil Review 1 :</b></td>  <td><select name='hasil_review1'>";
 
          if ($r[hasil_review1]==''){
            echo "<option value='' selected>Belum ada hasil review</option>
			<option value='Ada Perubahan'>Ada Perubahan</option>
			<option value='Tidak ada Perubahan'>Tidak ada Perubahan</option>
			";
          }   
         if ($r[hasil_review1]=='Ada Perubahan'){
            echo "<option value='' selected>Belum ada hasil review</option>
			<option value='Ada Perubahan' selected>Ada Perubahan</option>
			<option value='Tidak ada Perubahan'>Tidak ada Perubahan</option>
			";
          }   
		  
		   if ($r[hasil_review1]=='Tidak ada Perubahan'){
            echo "<option value=''>Belum ada hasil review</option>
			<option value='Ada Perubahan' selected>Ada Perubahan</option>
			<option value='Tidak ada Perubahan' selected>Tidak ada Perubahan</option>
			";
          }   
        	
	echo"</td></tr>
    <tr><td><b>Tgl Review 2 :</b></td><td><input type=text name='tgl_review2' value='$r[tgl_review2]' size=20></td></tr>
   <tr><td><b>Hasil Review 2 :</b></td>  <td><select name='hasil_review2'>";
 
          if ($r[hasil_review2]==''){
            echo "<option value='' selected>Belum ada hasil review</option>
			<option value='Ada Perubahan'>Ada Perubahan</option>
			<option value='Tidak ada Perubahan'>Tidak ada Perubahan</option>
			";
          }   
         if ($r[hasil_review2]=='Ada Perubahan'){
            echo "<option value='' selected>Belum ada hasil review</option>
			<option value='Ada Perubahan' selected>Ada Perubahan</option>
			<option value='Tidak ada Perubahan'>Tidak ada Perubahan</option>
			";
          }   
		  
		   if ($r[hasil_review2]=='Tidak ada Perubahan'){
            echo "<option value=''>Belum ada hasil review</option>
			<option value='Ada Perubahan' selected>Ada Perubahan</option>
			<option value='Tidak ada Perubahan' selected>Tidak ada Perubahan</option>
			";
          }   
        	
	echo"</td></tr>
	<tr><td><b>Tgl Review 3 :</b></td><td><input type=text name='tgl_review3' value='$r[tgl_review3]' size=20></td></tr>
	   <tr><td><b>Hasil Review 3 :</b></td>  <td><select name='hasil_review3'>";
 
          if ($r[hasil_review3]==''){
            echo "<option value='' selected>Belum ada hasil review</option>
			<option value='Ada Perubahan'>Ada Perubahan</option>
			<option value='Tidak ada Perubahan'>Tidak ada Perubahan</option>
			";
          }   
         if ($r[hasil_review3]=='Ada Perubahan'){
            echo "<option value='' selected>Belum ada hasil review</option>
			<option value='Ada Perubahan' selected>Ada Perubahan</option>
			<option value='Tidak ada Perubahan'>Tidak ada Perubahan</option>
			";
          }   
		  
		   if ($r[hasil_review3]=='Tidak ada Perubahan'){
            echo "<option value=''>Belum ada hasil review</option>
			<option value='Ada Perubahan' selected>Ada Perubahan</option>
			<option value='Tidak ada Perubahan' selected>Tidak ada Perubahan</option>
			";
          }   
        	
	echo"</td></tr>
	<tr><td><b>Jenis File :</b></td>  <td><select name='nama_file'>";
 
          if ($r[nama_file]=='.doc'){
            echo "<option value='.doc' selected>.doc (word)</option>
			<option value='.xls'>.xls (excel)</option>
			";
          }   
          if ($r[nama_file]=='.xls'){
            echo "<option value='.doc' >.doc (word)</option>
			<option value='.xls' selected>.xls (excel)</option>
			";
          } 
        if ($r[nama_file]==''){
            echo "<option value='.doc' selected>.doc (word)</option>
			<option value='.xls' >.xls (excel)</option>
			";
          } 
		     

    $d = GetCheckboxes('cchl', 'cchl', 'cchl', $r[cchl]);

    echo "<tr><td><b>Penerima Dokumen :</b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> $d
	</td></tr>";
	


    echo "<tr><td colspan=2><b>Permintaan tambahan copy controlled (Jumlah diuser default = 1 dokumen jika akan menambah tulis +, contoh MR+1, jadi MR punya 2 dokumen controlled) : </td></tr>";
	
	    echo "<tr><td colspan=2><input type=text name='cchl2' value='$r[cchl2]' size=80></td></tr>";
    echo "<tr><td><b>Deret Tambahan Copy :</b></td><td><input type=text name='keterangan' value='$r[keterangan]' size=60><br>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</td></tr>";
	echo "<tr><td><b>Arsip/ Keterangan :</b></td><td><input type=text name='keterangan3' value='$r[keterangan3]' size=60><br></td></tr>";
    echo  "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
	

  case "distdokumen":
    $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	$datenow = date( 'd-m-Y');

	    echo "<h2>Buat Distribusi-Berita Acara-Lembar Info-Sosialisasi Dokumen (All in One)</h2>
          <form method=POST action='$aksi?module=dokumen&act=inputdist' target=_blank>
          <table>
		 <tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
          <tr><td width=70><b>Nama Dokumen :</b></td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
		  
        <tr><td><b>Jenis Dokumen :</b></td>  <td><select name='id_jendok'>";
 
          $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
          if ($r[id_jendok]==0){
            echo "<option value=0 selected>- Pilih jendok -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_jendok]==$w[id_jendok]){
              echo "<option value='$w[nama_jendok]' selected>$w[nama_jendok]</option>";
            }
            else{
              echo "<option value='$w[nama_jendok]'>$w[nama_jendok]</option>";
            }
          }
    echo "</select></td></tr>";
          
	  $tgl_rev0=tgl_indo($r[tgl_rev0]);
      $tgl_rev1=tgl_indo($r[tgl_rev1]);
      $tgl_rev2=tgl_indo($r[tgl_rev2]);
      $tgl_rev3=tgl_indo($r[tgl_rev3]);
      $tgl_rev4=tgl_indo($r[tgl_rev4]);
      $tgl_rev5=tgl_indo($r[tgl_rev5]);
      $tgl_rev6=tgl_indo($r[tgl_rev6]);
      $tgl_rev7=tgl_indo($r[tgl_rev7]);
      $tgl_rev8=tgl_indo($r[tgl_rev8]);
      $tgl_rev9=tgl_indo($r[tgl_rev9]);
      $tgl_rev10=tgl_indo($r[tgl_rev10]);
      $tgl_rev11=tgl_indo($r[tgl_rev11]);
      $tgl_rev12=tgl_indo($r[tgl_rev12]);
		  		  
    echo "<td><b>Tgl Revisi 0 :</b></td><td>$tgl_rev0</td></tr>
	<td><b>Tgl Revisi 1 :</b></td><td>$tgl_rev1</td></tr>
	<td><b>Tgl Revisi 2 :</b></td><td>$tgl_rev2</td></tr>
	<td><b>Tgl Revisi 3 :</b></td><td>$tgl_rev3</td></tr>
	<td><b>Tgl Revisi 4 :</b></td><td>$tgl_rev4</td></tr>
	<td><b>Tgl Revisi 5 :</b></td><td>$tgl_rev5</td></tr>
	<td><b>Tgl Revisi 6 :</b></td><td>$tgl_rev6</td></tr>
	<td><b>Tgl Revisi 7 :</b></td><td>$tgl_rev7</td></tr>
	<td><b>Tgl Revisi 8 :</b></td><td>$tgl_rev8</td></tr>
	<td><b>Tgl Revisi 9 :</b></td><td>$tgl_rev9</td></tr>
    <td><b>Tgl Revisi 10 :</b></td><td>$tgl_rev10</td></tr>
	<td><b>Tgl Revisi 11 :</b></td><td>$tgl_rev11</td></tr>
	<td><b>Tgl Revisi 12 :</b></td><td>$tgl_rev12</td></tr>
		          <tr><td><b>Penerima Dokumen :</b> </td><td>$r[cchl]</td></tr>
				        <tr><td><b>Tambahan Copy Dokumen :</b> </td><td><input type=text name='cchl2' size=20 value='$r[cchl2]'></td></tr>
				   <tr><td width=70><b>Revisi ke :</b></td>     <td><input type=text name='revisi' size=20 value=''></td></tr>
				   <tr><td width=70><b>Tgl Buat Dist :</b></td>     <td><input type=text name='tgldist' size=20 value=$datenow></td></tr>
				   
				
	  <tr><td width=70><font color=red><b>Revisi Baru Utk Lembar Info :</font></b></td>     <td><input type=text name='revisibaru' size=20 value=''></td></tr> 
	  <tr><td width=70><font color=red><b>Revisi Lama/Yg ditarik Utk Lembar Info :</font></b></td>     <td><input type=text name='revisilama' size=20 value=''></td></tr>
<tr><td width=70><b><font color=red>Keterangan di Lembar Info	 :</font></b></td><td><input type=text name='keterangan' size=60 value=''></td></tr>
<tr><td width=70><b>Tgl Buat lembar :</b></td>     <td><input type=text name='tglbuat' size=20 value=$datenow></td></tr>";
				   
				   
				   
				
				   
				  echo"<tr><td>Pilih untuk distribusi dokumen : </td><td>
				  
				  <select name='kata'>
            <option value='' selected>- Pilih Penerima Dokumen 1 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='01. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata2'>
            <option value='' selected>- Pilih Penerima Dokumen 2 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='02. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata3'>
            <option value='' selected>- Pilih Penerima Dokumen 3 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='03. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata4'>
            <option value='' selected>- Pilih Penerima Dokumen 4 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='04. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata5'>
            <option value='' selected>- Pilih Penerima Dokumen 5 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='05. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata6'>
            <option value='' selected>- Pilih Penerima Dokumen 6 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='06. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata7'>
            <option value='' selected>- Pilih Penerima Dokumen 7 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='07. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata8'>
            <option value='' selected>- Pilih Penerima Dokumen 8 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='08. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata9'>
            <option value='' selected>- Pilih Penerima Dokumen 9 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='09. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata10'>
            <option value='' selected>- Pilih Penerima Dokumen 10 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='10. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata11'>
            <option value='' selected>- Pilih Penerima Dokumen 11 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='11. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata12'>
            <option value='' selected>- Pilih Penerima Dokumen 12 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='12. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata13'>
            <option value='' selected>- Pilih Penerima Dokumen 13 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='13. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata14'>
            <option value='' selected>- Pilih Penerima Dokumen 14 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='14. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata15'>
            <option value='' selected>- Pilih Penerima Dokumen 15 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='15. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata16'>
            <option value='' selected>- Pilih Penerima Dokumen 16 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='16. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata17'>
            <option value='' selected>- Pilih Penerima Dokumen 17 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='17. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata18'>
            <option value='' selected>- Pilih Penerima Dokumen 18 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='18. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata19'>
            <option value='' selected>- Pilih Penerima Dokumen 19 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='19. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata20'>
            <option value='' selected>- Pilih Penerima Dokumen 20 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='20. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata21'>
            <option value='' selected>- Pilih Penerima Dokumen 21 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='21. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata22'>
            <option value='' selected>- Pilih Penerima Dokumen 22 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='22. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata23'>
            <option value='' selected>- Pilih Penerima Dokumen 23 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='23. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata24'>
            <option value='' selected>- Pilih Penerima Dokumen 24 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='24. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata25'>
            <option value='' selected>- Pilih Penerima Dokumen 25 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='25. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata26'>
            <option value='' selected>- Pilih Penerima Dokumen 26 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='26. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata27'>
            <option value='' selected>- Pilih Penerima Dokumen 27 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='27. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata28'>
            <option value='' selected>- Pilih Penerima Dokumen 28 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='28. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata29'>
            <option value='' selected>- Pilih Penerima Dokumen 29 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='29. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata30'>
            <option value='' selected>- Pilih Penerima Dokumen 30 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='30. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo"</select>

	  <select name='kata31'>
            <option value='' selected>- Pilih Penerima Dokumen 31 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='31. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata32'>
            <option value='' selected>- Pilih Penerima Dokumen 32 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='32. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata33'>
            <option value='' selected>- Pilih Penerima Dokumen 33 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='33. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata34'>
            <option value='' selected>- Pilih Penerima Dokumen 34 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='34. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata35'>
            <option value='' selected>- Pilih Penerima Dokumen 35 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='35. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata36'>
            <option value='' selected>- Pilih Penerima Dokumen 36 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='36. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata37'>
            <option value='' selected>- Pilih Penerima Dokumen 37 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='37. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata38'>
            <option value='' selected>- Pilih Penerima Dokumen 38 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='38. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata39'>
            <option value='' selected>- Pilih Penerima Dokumen 39 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='39. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata40'>
            <option value='' selected>- Pilih Penerima Dokumen 40 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='40. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo"</select>

	  <select name='kata41'>
            <option value='' selected>- Pilih Penerima Dokumen 41 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='41. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata42'>
            <option value='' selected>- Pilih Penerima Dokumen 42 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='42. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata43'>
            <option value='' selected>- Pilih Penerima Dokumen 43 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='43. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata44'>
            <option value='' selected>- Pilih Penerima Dokumen 44 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='44. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata45'>
            <option value='' selected>- Pilih Penerima Dokumen 45 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='45. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata46'>
            <option value='' selected>- Pilih Penerima Dokumen 46 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='46. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata47'>
            <option value='' selected>- Pilih Penerima Dokumen 47 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='47. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata48'>
            <option value='' selected>- Pilih Penerima Dokumen 48 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='48. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata49'>
            <option value='' selected>- Pilih Penerima Dokumen 49 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='49. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata50'>
            <option value='' selected>- Pilih Penerima Dokumen 50 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='50. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo"</select>
	  <select name='kata51'>
            <option value='' selected>- Pilih Penerima Dokumen 51 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='51. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata52'>
            <option value='' selected>- Pilih Penerima Dokumen 52 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='52. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata53'>
            <option value='' selected>- Pilih Penerima Dokumen 53 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='53. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata54'>
            <option value='' selected>- Pilih Penerima Dokumen 54 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='54. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata55'>
            <option value='' selected>- Pilih Penerima Dokumen 55 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='55. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata56'>
            <option value='' selected>- Pilih Penerima Dokumen 56 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='56. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata57'>
            <option value='' selected>- Pilih Penerima Dokumen 57 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='57. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata58'>
            <option value='' selected>- Pilih Penerima Dokumen 58 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='58. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata59'>
            <option value='' selected>- Pilih Penerima Dokumen 59 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='59. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata60'>
            <option value='' selected>- Pilih Penerima Dokumen 60 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='60. | $r[nama_lengkap] ($r[cchl])'>$r[cchl]</option>";
            }
echo"</select>
</td></tr>";

    echo  "<tr><td colspan=2><input type=submit value=BuatDistribusi>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
		 
		 
//--------------------------
$edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	$datenow = date( 'd-m-Y');
  echo "<h2>Kirim Distribusi Dokumen Secara Elektronik (WAPD/EMAIL)</h2>
          <form method=POST action='$aksi?module=dokumen&act=inputdist2' target=_blank>
          <table>
		 <tr><td width=70><b>Kode Dokumen :</b></td>     <td><input type=text name='kode_dok' size=20 value='$r[kode_dok]'></td></tr>
          <tr><td width=70><b>Nama Dokumen :</b></td>     <td><input type=text name='judul_dok' size=60 value='$r[judul_dok]'></td></tr>
		  
        <tr><td><b>Jenis Dokumen :</b></td>  <td><select name='id_jendok'>";
 
          $tampil=mysql_query("SELECT * FROM jendok ORDER BY nama_jendok");
          if ($r[id_jendok]==0){
            echo "<option value=0 selected>- Pilih jendok -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_jendok]==$w[id_jendok]){
              echo "<option value='$w[nama_jendok]' selected>$w[nama_jendok]</option>";
            }
            else{
              echo "<option value='$w[nama_jendok]'>$w[nama_jendok]</option>";
            }
          }
    echo "</select></td></tr>";
          
	  $tgl_rev0=tgl_indo($r[tgl_rev0]);
      $tgl_rev1=tgl_indo($r[tgl_rev1]);
      $tgl_rev2=tgl_indo($r[tgl_rev2]);
      $tgl_rev3=tgl_indo($r[tgl_rev3]);
      $tgl_rev4=tgl_indo($r[tgl_rev4]);
      $tgl_rev5=tgl_indo($r[tgl_rev5]);
      $tgl_rev6=tgl_indo($r[tgl_rev6]);
      $tgl_rev7=tgl_indo($r[tgl_rev7]);
      $tgl_rev8=tgl_indo($r[tgl_rev8]);
      $tgl_rev9=tgl_indo($r[tgl_rev9]);
      $tgl_rev10=tgl_indo($r[tgl_rev10]);
      $tgl_rev11=tgl_indo($r[tgl_rev11]);
      $tgl_rev12=tgl_indo($r[tgl_rev12]);
		  		  
    echo "<tr><td><b>Penerima Dokumen :</b> </td><td>$r[cchl]</td></tr>
				        <tr><td><b>Tambahan Copy Dokumen :</b> </td><td><input type=text name='cchl2' size=20 value='$r[cchl2]'></td></tr>
				   <tr><td width=70><b>Revisi ke :</b></td>     <td><input type=text name='revisi' size=20 value=''></td></tr>
				   ";
				   
				  echo"<tr><td>Pilih untuk distribusi dokumen : </td><td>
				  
				  <select name='kata'>
            <option value='' selected>- Pilih Penerima Dokumen 1 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata2'>
            <option value='' selected>- Pilih Penerima Dokumen 2 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata3'>
            <option value='' selected>- Pilih Penerima Dokumen 3 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata4'>
            <option value='' selected>- Pilih Penerima Dokumen 4 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata5'>
            <option value='' selected>- Pilih Penerima Dokumen 5 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata6'>
            <option value='' selected>- Pilih Penerima Dokumen 6 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata7'>
            <option value='' selected>- Pilih Penerima Dokumen 7 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata8'>
            <option value='' selected>- Pilih Penerima Dokumen 8 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata9'>
            <option value='' selected>- Pilih Penerima Dokumen 9 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata10'>
            <option value='' selected>- Pilih Penerima Dokumen 10 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata11'>
            <option value='' selected>- Pilih Penerima Dokumen 11 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata12'>
            <option value='' selected>- Pilih Penerima Dokumen 12 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata13'>
            <option value='' selected>- Pilih Penerima Dokumen 13 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata14'>
            <option value='' selected>- Pilih Penerima Dokumen 14 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata15'>
            <option value='' selected>- Pilih Penerima Dokumen 15 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata16'>
            <option value='' selected>- Pilih Penerima Dokumen 16 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata17'>
            <option value='' selected>- Pilih Penerima Dokumen 17 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata18'>
            <option value='' selected>- Pilih Penerima Dokumen 18 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata19'>
            <option value='' selected>- Pilih Penerima Dokumen 19 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata20'>
            <option value='' selected>- Pilih Penerima Dokumen 20 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata21'>
            <option value='' selected>- Pilih Penerima Dokumen 21 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata22'>
            <option value='' selected>- Pilih Penerima Dokumen 22 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata23'>
            <option value='' selected>- Pilih Penerima Dokumen 23 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata24'>
            <option value='' selected>- Pilih Penerima Dokumen 24 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata25'>
            <option value='' selected>- Pilih Penerima Dokumen 25 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata26'>
            <option value='' selected>- Pilih Penerima Dokumen 26 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata27'>
            <option value='' selected>- Pilih Penerima Dokumen 27 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata28'>
            <option value='' selected>- Pilih Penerima Dokumen 28 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata29'>
            <option value='' selected>- Pilih Penerima Dokumen 29 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata30'>
            <option value='' selected>- Pilih Penerima Dokumen 30 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo"</select>

	  <select name='kata31'>
            <option value='' selected>- Pilih Penerima Dokumen 31 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata32'>
            <option value='' selected>- Pilih Penerima Dokumen 32 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata33'>
            <option value='' selected>- Pilih Penerima Dokumen 33 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata34'>
            <option value='' selected>- Pilih Penerima Dokumen 34 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata35'>
            <option value='' selected>- Pilih Penerima Dokumen 35 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata36'>
            <option value='' selected>- Pilih Penerima Dokumen 36 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata37'>
            <option value='' selected>- Pilih Penerima Dokumen 37 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata38'>
            <option value='' selected>- Pilih Penerima Dokumen 38 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata39'>
            <option value='' selected>- Pilih Penerima Dokumen 39 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata40'>
            <option value='' selected>- Pilih Penerima Dokumen 40 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo"</select>

	  <select name='kata41'>
            <option value='' selected>- Pilih Penerima Dokumen 41 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata42'>
            <option value='' selected>- Pilih Penerima Dokumen 42 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata43'>
            <option value='' selected>- Pilih Penerima Dokumen 43 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata44'>
            <option value='' selected>- Pilih Penerima Dokumen 44 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata45'>
            <option value='' selected>- Pilih Penerima Dokumen 45 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata46'>
            <option value='' selected>- Pilih Penerima Dokumen 46 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata47'>
            <option value='' selected>- Pilih Penerima Dokumen 47 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata48'>
            <option value='' selected>- Pilih Penerima Dokumen 48 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata49'>
            <option value='' selected>- Pilih Penerima Dokumen 49 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata50'>
            <option value='' selected>- Pilih Penerima Dokumen 50 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo"</select>
	  <select name='kata51'>
            <option value='' selected>- Pilih Penerima Dokumen 51 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata52'>
            <option value='' selected>- Pilih Penerima Dokumen 52 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata53'>
            <option value='' selected>- Pilih Penerima Dokumen 53 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata54'>
            <option value='' selected>- Pilih Penerima Dokumen 54 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata55'>
            <option value='' selected>- Pilih Penerima Dokumen 55 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata56'>
            <option value='' selected>- Pilih Penerima Dokumen 56 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata57'>
            <option value='' selected>- Pilih Penerima Dokumen 57 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata58'>
            <option value='' selected>- Pilih Penerima Dokumen 58 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata59'>
            <option value='' selected>- Pilih Penerima Dokumen 59 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>

				  <select name='kata60'>
            <option value='' selected>- Pilih Penerima Dokumen 60 -</option>";
			            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo"</select>
</td></tr>";

    echo  "<tr><td colspan=2><input type=submit value=BuatDistribusi>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";

//-----------------
		 
		 
		 
		 
		 
		 

		 
	$edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
		 
  echo "<h2>Buat Dokumen Terlampir (Satu Jenis Dokumen dan Revisi Sama !!)</h2>
  
  
          <form target=_blank method=POST action=/security1/pdf_dist_terlampir.php target=_blank>
          <table>
		  
		  
        <tr><td><b>Dokumen ke-1 :</b></td>  <td><select name='nama_dok'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
	
echo "<tr><td><b>Dokumen ke-2 :</b></td>  <td><select name='nama_dok2'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";

echo"<tr><td><b>Dokumen ke-3 :</b></td>  <td><select name='nama_dok3'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		
		echo"<tr><td><b>Dokumen ke-4 :</b></td>  <td><select name='nama_dok4'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
	
	
	echo"<tr><td><b>Dokumen ke-5 :</b></td>  <td><select name='nama_dok5'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
	echo"<tr><td><b>Dokumen ke-6 :</b></td>  <td><select name='nama_dok6'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";	
		
		
			echo"<tr><td><b>Dokumen ke-7 :</b></td>  <td><select name='nama_dok7'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		
			echo"<tr><td><b>Dokumen ke-8 :</b></td>  <td><select name='nama_dok8'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		
			echo"<tr><td><b>Dokumen ke-9 :</b></td>  <td><select name='nama_dok9'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		
			echo"<tr><td><b>Dokumen ke-10 :</b></td>  <td><select name='nama_dok10'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
			echo"<tr><td><b>Dokumen ke-11 :</b></td>  <td><select name='nama_dok11'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
			echo"<tr><td><b>Dokumen ke-12 :</b></td>  <td><select name='nama_dok12'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		echo"<tr><td><b>Dokumen ke-13 :</b></td>  <td><select name='nama_dok13'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		echo"<tr><td><b>Dokumen ke-14 :</b></td>  <td><select name='nama_dok14'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
		echo"<tr><td><b>Dokumen ke-15 :</b></td>  <td><select name='nama_dok15'>";
        $tampil=mysql_query("SELECT * FROM dokumen WHERE id_jendok=$r[id_jendok] ORDER BY kode_dok");
        echo "<option value='' selected>- Pilih Kode Dokumen -</option>";
        while($w=mysql_fetch_array($tampil)){
        echo "<option value='$w[kode_dok] | $w[judul_dok]'>$w[kode_dok]</option>";
                     }
        echo "</select></td></tr>";
		
    echo  "<tr><td colspan=2><input type=submit value=Buat_Daftar_Terlampir>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
		 
		 
		 
    break;  
}
?>
</div><!--/span12-->
</div><!--/block-content-->