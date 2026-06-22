<?php
session_start();
include "../../config/koneksi.php";
include "../../config1/library.php";
include "../../config1/fungsi_indotgl.php";
include "../../config1/class_paging.php";
include "../../config1/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];


// Cari dan tampilkan dokumen untuk edit
if ($module=='dokumen' AND $act=='caridokumenedit'){
$kata1 = trim($_POST[kata1]);


 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />
</head><body>
 
 <h2>Hasil Pencarian Usulan</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata1);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $tampil = mysql_num_rows($hasil);
   
   if ($tampil > 0){
  
echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />
</head><body>";
echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Dokumen dengan kata kunci kode dokumen <font style='background-color:#00FFFF'><b>$kata1</b></font> :</b><br><b>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
echo "<p ALIGN=CENTER><font size=3><b>EDIT DOKUMEN KHUSUS</b></FONT><center>
<table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Ext. File</th><th>Kode Komputer</th><th>ID Jendok</th><th>Judul Dokumen</th><th>PJ Dok</th><th>CCHL</th><th>Tgl Berlaku/review Terakhir</th><th>Tgl Maks Review</th><th>Tgl Rev 0</th><th>Tgl Rev 1</th><th>Tgl Rev 2</th><th>Tgl Rev 3</th><th>Tgl Rev 4</th><th>Tgl Rev 5</th><th>Tgl Rev 6</th><th>Tgl Rev 7</th><th>Tgl Rev 8</th><th>Tgl Rev 9</th><th>Tgl Rev 10</th><th>Tgl Rev 11</th><th>Tgl Rev 12</th><th>Tgl Rev 13</th><th>Tgl Rev 14</th><th>Tgl Rev 15</th><th>Tgl Review Sblm</th><th>Tgl Review1</th><th>Hsl Review1</th><th>Tgl Review2</th><th>Hsl Review2</th><th>Tgl Review3</th><th>Hsl Review3</th><th>Copy</th><th>Deret Copy</th><th>Arsip Copy</th><th>Update</th></tr>"; 
		  
		     
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	 	 	  
	 echo "
	 <tr><td width=25><form method=POST action=?module=dokumen&act=update4 target=_blank>
	 $no</td> 
	 <td width=40><input type=text name='kode_dok' size=10 value='$r[kode_dok]'></td>
	 <td width=10><input type=text name='nama_file' size=10 value='$r[nama_file]'></td>
       <td><input type=text name='kode_kom' size=20 value='$r[kode_kom]'></td>
	   <td><input type=text name='id_jendok' size=10 value='$r[id_jendok]'></td>
	   <td><input type=text name='judul_dok' size=50 value='$r[judul_dok]'></td> 
		<td><input type=text name='pj_dok' value='$r[pj_dok]' size=25></td>
	    <td><input type=text name='cchl' size=50 value='$r[cchl]'></td> 	
		<td><input type=text name='tgl_berlaku' value='$r[tgl_berlaku]' size=15></td>
		<td><input type=text name='tgl_review' value='$r[tgl_review]' size=15></td>
		<td>$r[tgl_rev0]</td>
		<td>$r[tgl_rev1]</td>
		<td>$r[tgl_rev2]</td>
		<td>$r[tgl_rev3]</td>
		<td>$r[tgl_rev4]</td>
		<td>$r[tgl_rev5]</td>
		<td>$r[tgl_rev6]</td>
		<td>$r[tgl_rev7]</td>
		<td>$r[tgl_rev8]</td>
		<td>$r[tgl_rev9]</td>
		<td>$r[tgl_rev10]</td>
		<td>$r[tgl_rev11]</td>
		<td>$r[tgl_rev12]</td>
		<td>$r[tgl_rev13]</td>
		<td>$r[tgl_rev14]</td>
		<td>$r[tgl_rev15]</td>
		<td><input type=text name='tgl_review_sebelumnya' value='$r[tgl_review_sebelumnya]' size=15></td>
		<td><input type=text name='tgl_review1' value='$r[tgl_review1]' size=15></td>
		<td><input type=text name='hasil_review1' value='$r[hasil_review1]' size=15></td>
		<td><input type=text name='tgl_review2' value='$r[tgl_review2]' size=15></td>
		<td><input type=text name='hasil_review2' value='$r[hasil_review2]' size=15></td>
		<td><input type=text name='tgl_review3' value='$r[tgl_review3]' size=15></td>
		<td><input type=text name='hasil_review3' value='$r[hasil_review3]' size=15></td>
		<td><input type=text name='cchl2' value='$r[cchl2]' size=15></td>
		<td><input type=text name='keterangan' value='$r[keterangan]' size=15></td>
		<td><input type=text name='keterangan3' value='$r[keterangan3]' size=15></td>
		";	 
 echo "<td><input type=submit value=Update></td></form></tr>";
      $no++;
	   }
	      echo "</table>";

echo "
<p align=center>                     
<center><font size=2><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode dokumen tersebut</center>";
  }


  }


// Cari dan tampilkan dokumen yang didistribusikan pada bulan tertentu pada jabatan tertentu
if ($module=='dokumen' AND $act=='caridokumenbag'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim($_POST[kata2]);
$kata2 = ($kata1.$kata);
 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_berlaku LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " and cchl like '%$kata3%' ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Daftar Dokumen Yang Didistribusikan BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Berlaku/Revisi</th><th>Aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=400>$r[judul_dok]</td>
			 <td align=left width=100><center>$tgl_berlaku</center></td>";
			 if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
			 echo"<td align=left width=200><center><a href='../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf' target='_blank'>Link File PDF</a></center></td>"; }
			 else {
			 echo"<td align=left width=50><center>-</center></td>";
			 }
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang didistribusikan  BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3<br>";
  }
  
  }

// Cari dan tampilkan dokumen yang didistribusikan pada bulan tertentu pada jabatan tertentu
if ($module=='dokumen' AND $act=='caridokumenreview'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_SESSION[bagianuser]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Daftar Dokumen Yang Direview BULAN : -$kata- TAHUN : -$kata1- </b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Maks Review</th><th>PJ Dok</th><th>Review Oleh</th><th>Hasil Review ke-1 </th><th>Tgl Review ke-1 </th>
		  <th>Hasil Review ke-2 </th><th>Tgl Review ke-2 </th><th>Hasil Review ke-3 </th><th>Tgl Review ke-3 </th><th>aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo3($r[tgl_review]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
			 <td align=left><center>$tgl_review</center></td>
			 <td align=left><center>$r[pj_dok]</center></td>
			 
<form method=POST action=?module=dokumen&act=updatereview target=_blank>
<input type=hidden name=kode_dok value=$r[kode_dok]>";
	echo"<td align=left><select name='review_oleh'>
            <option value='0' selected>- Pilih Nama Jabatan -</option>";
			
                     $tampil=mysql_query("SELECT * FROM cchl ORDER BY cchl");
            while($t=mysql_fetch_array($tampil)){
              echo "<option value='$t[cchl]-MR'>$t[cchl]</option>";
            }
echo "</select></td>";
			 echo"
<td align=left width=50><input type=text name='hasil_review1' size=12 value='$r[hasil_review1]'></td>
<td align=center width=50>";
	if ($r[tgl_review1]==0000-00-00){
echo "<input type=text name='tgl_review1' size=8 value=''></td>";
}
else {
echo "<input type=text name='tgl_review1' size=8 value='$r[tgl_review1]'></td>
";

}	
 echo "<td align=left width=50><input type=text name='hasil_review2' size=12 value='$r[hasil_review2]'></td>
	     <td align=center width=50>";
		 
    if ($r[tgl_review2]==0000-00-00){
echo "<input type=text name='tgl_review2' size=8 value=''></td>";
}
else {
echo "<input type=text name='tgl_review2' size=8 value='$r[tgl_review2]'></td>";
}	

echo "<td align=left width=50><input type=text name='hasil_review3' size=12 value='$r[hasil_review3]'></td>
	     <td align=center width=50>";
	 
    if ($r[tgl_review3]==0000-00-00){
echo "<input type=text name='tgl_review3' size=8 value=''>";
}
else {
echo "<input type=text name='tgl_review3' size=8 value='$r[tgl_review3]'></td>
";
}		 
											   
	echo "
	<td><input type=submit value=Update></form></td></tr>";
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

 
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang direview  BULAN : -$kata- TAHUN : -$kata1- ";
  }
  
  }
  
// Cari dan tampilkan dokumen yang harus direview dan entry hasil review
if ($module=='dokumen' AND $act=='caridokumenreviewuser'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_SESSION[bagianuser]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Daftar Dokumen Yang Direview BULAN : -$kata- TAHUN : -$kata1- </b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Maks Review</th><th>Penerima Dokumen</th><th>PJ Dok</th><th>Review Oleh</th><th>Hasil Review ke-1 </th><th>Tgl Review ke-1 </th>
		  <th>Hasil Review ke-2 </th><th>Tgl Review ke-2 </th><th>Hasil Review ke-3 </th><th>Tgl Review ke-3 </th><th>Tgl Maks Review</th><th>aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo3($r[tgl_review]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
			 <td align=left><center>$tgl_review</center></td>
			 <td align=left><center>$r[cchl]</center></td>
			 <td align=left><center>$r[pj_dok]</center></td>
			 
<form method=POST action=?module=dokumen&act=updatereview target=_blank>
<input type=hidden name=kode_dok value=$r[kode_dok]>";
	echo"<td align=left><select name='review_oleh'>
            <option value=0 selected>- Pilih Nama Jabatan -</option>";
			
                     $tampil=mysql_query("SELECT * FROM cchl ORDER BY cchl");
            while($t=mysql_fetch_array($tampil)){
              echo "<option value='$t[cchl]-MR'>$t[cchl]</option>";
            }
echo "</select></td>";
			 echo"
<td align=left width=50><input type=text name='hasil_review1' size=12 value='$r[hasil_review1]'></td>
<td align=center width=50>";
	if ($r[tgl_review1]==0000-00-00){
echo "<input type=text name='tgl_review1' size=8 value=''></td>";
}
else {
echo "<input type=text name='tgl_review1' size=8 value='$r[tgl_review1]'></td>
";

}	
 echo "<td align=left width=50><input type=text name='hasil_review2' size=12 value='$r[hasil_review2]'></td>
	     <td align=center width=50>";
		 
    if ($r[tgl_review2]==0000-00-00){
echo "<input type=text name='tgl_review2' size=8 value=''></td>";
}
else {
echo "<input type=text name='tgl_review2' size=8 value='$r[tgl_review2]'></td>";
}	

echo "<td align=left width=50><input type=text name='hasil_review3' size=12 value='$r[hasil_review3]'></td>
	     <td align=center width=50>";
	 
    if ($r[tgl_review3]==0000-00-00){
echo "<input type=text name='tgl_review3' size=8 value=''>";
}
else {
echo "<input type=text name='tgl_review3' size=8 value='$r[tgl_review3]'></td>
";
}		 
											   
	echo "<td align=left width=50><input type=hidden name='tgl_review' size=8 value='$r[tgl_review]'>$r[tgl_review]</td>
	<td><input type=submit value=Update></form></td></tr>";
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

 
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang direview  BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3";
  }
  
  }

  // Cari dan tampilkan dokumen yang harus direview
if ($module=='dokumen' AND $act=='caridokumenreview0'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_SESSION[bagianuser]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review_sebelumnya LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
    include "selisih.php";
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Laporan Daftar Dokumen Yang telah Direview BULAN : -$kata- TAHUN : -$kata1- </b></FONT><center><table width=2000>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Maks Review</th><th>Penerima Dokumen</th><th>Review terakhir oleh</th><th>Hasil Review ke-1 </th><th>Tgl Review ke-1 </th><th>Tgl Slesai Review ke-1 </th>
		  <th>Hasil Review ke-2 </th><th>Tgl Review ke-2 </th><th>Tgl Slesai Review ke-2 </th><th>Hasil Review ke-3 </th><th>Tgl Review ke-3 </th><th>Tgl Slesai Review ke-3 </th><th>Tgl Real Review</th><th>Tgl Selesai Review</th><th>Selisih</th><th>Selisih1</th><th>Tgl Review selanjutnya</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo3($r[tgl_review]);
	    
	  
	    if ($r[tgl_real_review]=='' or $r[tgl_real_review]==0000-00-00 or $r[tgl_slesai_review]=='' or $r[tgl_slesai_review]==0000-00-00) 
{     $selisih="-"; } else
{	  $selisih= selisihHari($r[tgl_real_review], $r[tgl_slesai_review]); }
	  
	  
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
			 <td align=left><center>$r[tgl_review_sebelumnya]</center></td>
			 <td align=left><center>$r[cchl]</center></td>
			 <td align=left><center>$r[review_oleh]</center></td>
			 <td align=left><center>$r[hasil_review1]</center></td>
			 <td align=left><center>$r[tgl_review1]</center></td>
			 <td align=left><center>$r[tgl_slesai_review1]</center></td>
			  <td align=left><center>$r[hasil_review2]</center></td>
			 <td align=left><center>$r[tgl_review2]</center></td>
			 <td align=left><center>$r[tgl_slesai_review2]</center></td>
			  <td align=left><center>$r[hasil_review3]</center></td>
			 <td align=left><center>$r[tgl_review3]</center></td>
			 <td align=left><center>$r[tgl_slesai_review3]</center></td>
			 <td align=left><center>$r[tgl_real_review]</center></td>
			 <td align=left><center>$r[tgl_slesai_review]</center></td>
			 	 <td align=center>$selisih</td>
<td align=center>";
if ($selisih>2){ echo 1; } else { echo 0; }
echo"</td>
			 <td align=left><center>$r[tgl_review]</center></td>";
			 
			 										   
	echo "</tr>";
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

 
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang telah direview  BULAN : -$kata- TAHUN : -$kata1- <br>";
  }
  
  }

  
  
  // Cari dan tampilkan dokumen yang telah direview user
if ($module=='dokumen' AND $act=='caridokumenreview00'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_SESSION[bagianuser]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review_sebelumnya LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "AND review_oleh='$kata3' ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
    include "selisih.php";
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Laporan Daftar Dokumen Yang telah Direview BULAN : -$kata- TAHUN : -$kata1- oleh $_SESSION[bagianuser]</b></FONT><center><table width=2000>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Maks Review</th><th>Penerima Dokumen</th><th>Review terakhir oleh</th><th>Hasil Review ke-1 </th><th>Tgl Review ke-1 </th>
		  <th>Hasil Review ke-2 </th><th>Tgl Review ke-2 </th><th>Hasil Review ke-3 </th><th>Tgl Review ke-3 </th><th>Tgl Review Terakhir</th><th>Tgl Review selanjutnya</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo3($r[tgl_review]);
	    
	  
	    if ($r[tgl_real_review]=='' or $r[tgl_real_review]==0000-00-00 or $r[tgl_slesai_review]=='' or $r[tgl_slesai_review]==0000-00-00) 
{     $selisih="-"; } else
{	  $selisih= selisihHari($r[tgl_real_review], $r[tgl_slesai_review]); }
	  
	  
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
			 <td align=left><center>$r[tgl_review_sebelumnya]</center></td>
			 <td align=left><center>$r[cchl]</center></td>
			 <td align=left><center>$r[review_oleh]</center></td>
			 <td align=left><center>$r[hasil_review1]</center></td>
			 <td align=left><center>$r[tgl_review1]</center></td>
			  <td align=left><center>$r[hasil_review2]</center></td>
			 <td align=left><center>$r[tgl_review2]</center></td>
			  <td align=left><center>$r[hasil_review3]</center></td>
			 <td align=left><center>$r[tgl_review3]</center></td>
			 <td align=left><center>$r[tgl_real_review]</center></td>";
			 	
echo"
			 <td align=left><center>$r[tgl_review]</center></td>";
			 
			 										   
	echo "</tr>";
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

 
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang telah direview  BULAN : -$kata- TAHUN : -$kata1- oleh $_SESSION[bagianuser]";
  }
  
  }

  

// Cari dan tampilkan dokumen yang direview berdasarkan jabatan
if ($module=='dokumen' AND $act=='caridokumenreview2'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_POST[kata2]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " and pj_dok like '%$kata3%' ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>Daftar Dokumen Yang Harus Direview oleh : -$kata3-  BULAN : -$kata- TAHUN : -$kata1- </b><br>Cek/Lihat dokumen (PDF/Hardcopy) apakah isi dokumen dengan lapangan masih sesuai? (tidak ada perubahan) atau tidak sesuai? (ada perubahan/dihilangkan)<br> (Pilih hasil review [Ada Perubahan/dihilangkan =>Lakukan usulan CC] atau [Tidak ada Perubahan], <br>tanggal review otomatis tanggal sekarang [Tahun-Bulan-Tanggal] kemudian klik UPDATE)<br>Setelah klik UPDATE maka pekerjaan review selesai, daftar dan notifikasi akan berkurang dan hilang, akan muncul di daftar dokumen yang telah direview.</FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Berlaku/Review Terakhr</th><th>Tgl Maks Review</th><th>Link PDF</th><th>PJ/Pmbuat Dokumen</th><th>Hasil Review </th><th>Tgl Review </th><th>aksi</th></tr>"; 


   $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo3($r[tgl_review]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
			  <td align=left><center>$r[tgl_berlaku]</center></td>
			 <td align=left><center>$tgl_review</center></td>
			 <td align=left><center><a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat PDF</a></center></td>
			 <td align=left><center>$r[pj_dok]</center></td>
			 
<form method=POST action=?module=dokumen&act=updatereview target='_blank'>
<input type=hidden name=kode_dok value=$r[kode_dok]>
<input type=hidden name=review_oleh value=$_SESSION[bagianuser]>";

if ($r[tgl_review1]=='0000-00-00' AND $r[tgl_review2]=='0000-00-00' AND $r[tgl_review3]=='0000-00-00'){
    
			 echo"
<td align=left width=50>";

	if ($r[hasil_review1]==''){
echo "<select name='hasil_review1'>
<option value='tidak ada perubahan' selected>Tidak ada perubahan</option>
<option value='ada perubahan'>Ada perubahan</option>
<option value='dihilangkan'>Dihilangkan</option>
</select></td>
";
}
else {
    echo"<input type=text name='hasil_review1' size=12 value='$r[hasil_review1]' disabled></td>
";
}
echo"
<td align=center width=50>";
	if ($r[tgl_review1]==0000-00-00){
	    $tgl_sekarang = date ("Y-m-d");
echo "<input type='hidden' name='tgl_review1' value='$tgl_sekarang'>$tgl_sekarang</td>";
}
else {
echo "<input type=text name='tgl_review1' size=8 value='$r[tgl_review1]' disabled></td>
";

}
echo"<input type=hidden name='tgl_review2' value=''>
<input type=hidden name='tgl_review3' value=''>
<input type=hidden name='hasil_review2' value=''>
<input type=hidden name='hasil_review3' value=''>
";
}

elseif  ($r[tgl_review1]!='0000-00-00' AND $r[tgl_review2]=='0000-00-00' AND $r[tgl_review3]=='0000-00-00')
{
    
			 echo"
<td align=left width=50>";

	if ($r[hasil_review2]==''){
echo "<select name='hasil_review2'>
<option value='tidak ada perubahan' selected>Tidak ada perubahan</option>
<option value='ada perubahan'>Ada perubahan</option>
<option value='dihilangkan'>Dihilangkan</option>
</select></td>
";
}
else {
    echo"<input type=text name='hasil_review2' size=12 value='$r[hasil_review2]' disabled></td>
";
}
echo"
<td align=center width=50>";
	if ($r[tgl_review2]==0000-00-00){
	    $tgl_sekarang = date ("Y-m-d");
echo "<input type='hidden' name='tgl_review2' value='$tgl_sekarang'>$tgl_sekarang</td>";
}
else {
echo "<input type=text name='tgl_review2' size=8 value='$r[tgl_review2]' disabled></td>
";

}
echo"<input type=hidden name='tgl_review1' value='$r[tgl_review1]'>
<input type=hidden name='tgl_review3' value=''>
<input type=hidden name='hasil_review1' value='$r[hasil_review1]'>
<input type=hidden name='hasil_review3' value=''>
";
}  
    
    elseif  ($r[tgl_review1]!='0000-00-00' AND $r[tgl_review2]!='0000-00-00' AND $r[tgl_review3]=='0000-00-00'){

    
			 echo"
<td align=left width=50>";

	if ($r[hasil_review3]==''){
echo "<select name='hasil_review3'>
<option value='tidak ada perubahan' selected>Tidak ada perubahan</option>
<option value='ada perubahan'>Ada perubahan</option>
<option value='dihilangkan'>Dihilangkan</option>
</select></td>
";
}
else {
    echo"<input type=text name='hasil_review3' size=12 value='$r[hasil_review3]' disabled></td>
";
}
echo"
<td align=center width=50>";
	if ($r[tgl_review3]==0000-00-00){
	    $tgl_sekarang = date ("Y-m-d");
echo "<input type='hidden' name='tgl_review3' value='$tgl_sekarang'>$tgl_sekarang</td>";
}
else {
echo "<input type=text name='tgl_review3' size=8 value='$r[tgl_review3]' disabled></td>
";

}
echo"<input type=hidden name='tgl_review1' value='$r[tgl_review1]'>
<input type=hidden name='tgl_review2' value='$r[tgl_review2]'>
<input type=hidden name='hasil_review1' value='$r[hasil_review1]'>
<input type=hidden name='hasil_review2' value='$r[hasil_review2]'>
";
}  
 else {}  
    										   
	echo "<input type=hidden name='tgl_review' size=8 value='$r[tgl_review]'><td><input type=submit value=Update></form></td></tr>";
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

 
	 }
  else{
    echo "<center><font size=2><b>Tidak ditemukan dokumen yang harus direview  BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3</b>";
  }
  
  }

 // Cari dan tampilkan dokumen yang harus direview berdasarkan tanggal berlaku terakhir
if ($module=='dokumen' AND $act=='caridokumenreview3'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_SESSION[bagianuser]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_berlaku LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Daftar Dokumen Yang berlaku atau review terakhir BULAN : -$kata- TAHUN : -$kata1- </b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Berlaku/Review Terakhir</th><th>Tgl Maks Review</th><th>Penerima Dokumen</th><th>Tambahan Dokumen</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo3($r[tgl_review]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
             <td align=left><center>$tgl_berlaku</center></td>
			 <td align=left><center>$tgl_review</center></td>
			 <td align=left><center>$r[cchl]</center></td>
			 <td align=left><center>$r[cchl2]</center></td>";
			 
									   
	echo "</tr>";
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

 
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang tgl berlaku/review terakhir  BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3";
  }
  
  }

  

// Cari dan tampilkan dokumen yang direview berdasarkan PJ DOK
if ($module=='dokumen' AND $act=='caridokumenreview4'){
$kata = trim($_POST[kata]);
$kata1 = trim($_POST[kata1]);
$kata3 = trim ($_POST[kata2]);
$kata2 = ($kata1.$kata);

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya

 $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " and pj_dok like '%$kata3%' ORDER BY id_jendok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$jmldata = mysql_num_rows($hasil);
		
		

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$jmldata</b> Dokumen</font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>Daftar Dokumen Yang Direview BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl Maks Review</th></th><th>Penerima Dokumen</th><th>Tambahan Dokumen</th><th>PJ DOK</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);
	  $tgl_review=tgl_indo2($r[tgl_review]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left >$r[judul_dok]</td>
			 <td align=left><center>$tgl_review</center></td>
			 <td align=left><center>$r[cchl]</center></td>
			 <td align=left><center>$r[cchl2]</center></td>
			 <td align=left><center>$r[pj_dok]</center></td>";
		     
		     
 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";


 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen yang direview  BULAN : -$kata- TAHUN : -$kata1- Jabatan $kata3<br>";
  }
  
  }

// -----------------------------------------------------------------------------Cari dan tampilkan dokumen (RDT) berdasarkan judul dan kode dokumen
if ($module=='dokumen' AND $act=='caridokumen'){
$kata1 = trim($_POST[kata1]);
if ($kata1=='judul') {


 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY judul_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>File/ Aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev13=tgl_indo2($r[tgl_rev13]);
      $tgl_rev14=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev15=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
				 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](0)$r[nama_file]>$tgl_rev0</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](1)$r[nama_file]>$tgl_rev1</a>";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](2)$r[nama_file]>$tgl_rev2</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](3)$r[nama_file]>$tgl_rev3</a>";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](4)$r[nama_file]>$tgl_rev4</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](5)$r[nama_file]>$tgl_rev5</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](6)$r[nama_file]>$tgl_rev6</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](7)$r[nama_file]>$tgl_rev7</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](8)$r[nama_file]>$tgl_rev8</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](9)$r[nama_file]>$tgl_rev9</a>";
}		 
				 echo "</td>";
  if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
             echo "<td align=center width=150><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | ";
              
               if ($r[nama_file]=='.doc' OR $r[nama_file]=='.xls' OR $r[nama_file]=='.xls (excel)' OR $r[nama_file]=='.docx' OR $r[nama_file]=='.xlsx' OR $r[nama_file]=='') {
			      
			       echo"<a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>PDF</a>";
			     
			  }
			  else {
			  		 echo "<a href='../../distribusidok/$r[nama_file]' target=_blank>PDF</a>";
			  }
			  
             echo" | <a href=../../home.php?pages=usulandok&act=tambah2&id=$r[kode_dok] >Usulan</a>|<a  href=../../file.php?&id=$r[kode_dok] target=_blank>File</a>|<a href=../../home.php?pages=dinter&act=tambah2&id=$r[kode_dok] >Dist Baru</a> | <a href=../../home.php?pages=dokint&act=distdokumen&id=$r[kode_dok]>Dist Lama</a> | <a href=../../home.php?pages=dokint&act=editdokumen&id=$r[kode_dok]>Edit</a>|<a href=?module=dokumen&act=hapus&id=$r[kode_dok]>Hapus</a></td></tr>";
			 }
			 
			 elseif ($_SESSION[leveluser2]=='superuser2' OR $_SESSION[levelcv]==2 OR $_SESSION[levelcv]==3 OR $_SESSION[levelcv]==4) {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok] >Detail</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank> PDF</a> </td></tr>";
			 }
			 
			 	 elseif  ($_SESSION[leveluser2]=='superuser' OR $_SESSION[levelcv]==5) {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok] >Detail</a> | <a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat PDF</a> </td></tr>";
			 }
			 
			 else {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok] >Detail</a> | <a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat PDF</a> </td></tr>";
			 }
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kata kunci <b>$kata</b><br>";
  }
  
  
}
elseif ($kata1=='kode') {


 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
        <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>File/ Aksi</th></tr>"; 
   $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev13=tgl_indo2($r[tgl_rev13]);
      $tgl_rev14=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev15=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
								 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](0)$r[nama_file]>$tgl_rev0</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](1)$r[nama_file]>$tgl_rev1</a>";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](2)$r[nama_file]>$tgl_rev2</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](3)$r[nama_file]>$tgl_rev3</a>";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](4)$r[nama_file]>$tgl_rev4</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](5)$r[nama_file]>$tgl_rev5</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](6)$r[nama_file]>$tgl_rev6</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](7)$r[nama_file]>$tgl_rev7</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](8)$r[nama_file]>$tgl_rev8</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](9)$r[nama_file]>$tgl_rev9</a>";
}	
				 echo "</td>";
  if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
              echo "<td align=center width=150><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | ";
              
               if ($r[nama_file]=='.doc' OR $r[nama_file]=='.xls' OR $r[nama_file]=='.xls (excel)' OR $r[nama_file]=='.docx' OR $r[nama_file]=='.xlsx' OR $r[nama_file]=='') {
			      
			       echo"<a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>PDF</a>";
			     
			  }
			  else {
			  		 echo "<a href='../../distribusidok/$r[nama_file]' target=_blank>PDF</a>";
			  }
			  
              echo" | <a href=../../home.php?pages=usulandok&act=tambah2&id=$r[kode_dok] >Usulan</a>| <a href=../../home.php?pages=dinter&act=tambah2&id=$r[kode_dok] >Dist Baru</a> | <a href=../../home.php?pages=dokint&act=distdokumen&id=$r[kode_dok]>Dist Lama</a> | <a  href=../../file.php?&id=$r[kode_dok] target=_blank>File</a> | <a href=../../home.php?pages=dokint&act=editdokumen&id=$r[kode_dok]>Edit</a>|<a href=?module=dokumen&act=hapus&id=$r[kode_dok]>Hapus</a></td></tr>";
			 }
			 else {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> |";
			  
			  if ($r[nama_file]=='.doc' OR $r[nama_file]!='.xls' OR $r[nama_file]=='.xls (excel)' OR $r[nama_file]=='.docx' OR $r[nama_file]=='.xlsx' OR $r[nama_file]=='') {
			      
			      echo"<a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat Dok PDF</a> </td></tr>";
			     
			  }
			  else {
			      
			       echo "<a href='../../distribusidok/$r[nama_file]' target=_blank>Lihat Dok PDF</a> </td></tr>";
			  		
			  }
			 }
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode dokumen <b>$kata</b><br>";
  }
  
  
}
else {


 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_kom LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen dengan kode komputer <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
        <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>File/ Aksi</th></tr>"; 
   $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev13=tgl_indo2($r[tgl_rev13]);
      $tgl_rev14=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev15=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
								 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](0)$r[nama_file]>$tgl_rev0</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](1)$r[nama_file]>$tgl_rev1</a>";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](2)$r[nama_file]>$tgl_rev2</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](3)$r[nama_file]>$tgl_rev3</a>";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](4)$r[nama_file]>$tgl_rev4</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](5)$r[nama_file]>$tgl_rev5</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](6)$r[nama_file]>$tgl_rev6</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](7)$r[nama_file]>$tgl_rev7</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](8)$r[nama_file]>$tgl_rev8</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok](9)$r[nama_file]>$tgl_rev9</a>";
}	
				 echo "</td>";
   if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
          echo "<td align=center width=150><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | ";
              
               if ($r[nama_file]=='.doc' OR $r[nama_file]=='.xls' OR $r[nama_file]=='.xls (excel)' OR $r[nama_file]=='.docx' OR $r[nama_file]=='.xlsx' OR $r[nama_file]=='') {
			      
			       echo"<a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>PDF</a>";
			     
			  }
			  else {
			  		 echo "<a href='../../distribusidok/$r[nama_file]' target=_blank>PDF</a>";
			  }
          
           echo " | <a href=../../home.php?pages=usulandok&act=tambah2&id=$r[kode_dok] >Usulan</a>| <a href=../../home.php?pages=dinter&act=tambah2&id=$r[kode_dok] >Dist Baru</a> | <a href=../../home.php?pages=dokint&act=distdokumen&id=$r[kode_dok]>Dist Lama</a> | <a href=../../home.php?pages=dokint&act=editdokumen&id=$r[kode_dok]>Edit</a>|<a href=?module=dokumen&act=hapus&id=$r[kode_dok]>Hapus</a></td></tr>";
				 }
			 else {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat Dok PDF</a> </td></tr>";
			 }
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode komputer <b>$kata</b><br>";
  }
  
  
}
}

// -----------------------------------------------------------------------------Cari dan tampilkan dokumen (RDT) berdasarkan judul dan kode dokumen di user
if ($module=='dokumen' AND $act=='caridokumenx'){
$kata1 = trim($_POST[kata1]);
if ($kata1=='judul') {


 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  $kata2 = trim($_POST[kata2]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  if ($kata2=='0') {
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "ORDER BY id_jendok ASC";
  }
  else {
  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "AND id_jendok=$kata2 ORDER BY id_jendok ASC";
  }
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen dengan kata kunci judul <font style='background-color:#00FFFF'><b>$kata</b></font> di jenis dokumen tersebut:</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Jenis Dokumen</th><th>Aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev13=tgl_indo2($r[tgl_rev13]);
      $tgl_rev14=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev15=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
				 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}		 
				 echo "</td>";
				 
				   $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  
		  
		  echo "<td>$jenisdok[nama_jendok]</td>";
 
if($_SESSION[levelcv]==0 OR $_SESSION[cv]==1) {
             echo "<td align=center width=150><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../file.php?&id=$r[kode_dok] target=_blank>File</a> |<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf> PDF</a> | <a href=../../home.php?pages=dokint&act=distdokumen&id=$r[kode_dok]>Dist</a> | <a href=../../home.php?pages=dokint&act=editdokumen&id=$r[kode_dok]>Edit</a>|<a href=?module=dokumen&act=hapus&id=$r[kode_dok]>Hapus</a></td></tr>";
			 }
			 elseif ($_SESSION[leveluser2]=='superuser2' OR $_SESSION[levelcv]==2 OR $_SESSION[levelcv]==3 OR $_SESSION[levelcv]==4) {
			 			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf> PDF</a></td></tr>";
			 }
			 
			 	 elseif  ($_SESSION[leveluser2]=='superuser' OR $_SESSION[levelcv]==5) {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>PDF</a></td></tr>";
			 }
			 
			  else {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat PDF</a> </td></tr>";
			 }
			 
						
			 
			 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kata kunci <b>$kata</b> pada jenis dokumen yang dipilih<br>";
  }
  
  
}
else
{

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  $kata2 = trim($_POST[kata2]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  if ($kata2=='0') {
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  }
  else
  {
    $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "AND id_jendok=$kata2 ORDER BY kode_dok ASC";
  }
  
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> di jenis dokumen yang dipilih :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
        <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Jenis Dokumen</th><th>Aksi</th></tr>"; 
   $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev13=tgl_indo2($r[tgl_rev13]);
      $tgl_rev14=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev15=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
								 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}	
				 echo "</td>";
				  echo "<td align=left width=150>";
			  
			  $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  
		  
		  echo "$jenisdok[nama_jendok]</td>";
				 
 
if($_SESSION[levelcv]==0 OR $_SESSION[cv]==1) {
             echo "<td align=center width=150><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../file.php?&id=$r[kode_dok] target=_blank>File</a> |<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf> PDF</a> | <a href=../../home.php?pages=dokint&act=distdokumen&id=$r[kode_dok]>Dist</a> | <a href=../../home.php?pages=dokint&act=editdokumen&id=$r[kode_dok]>Edit</a>|<a href=?module=dokumen&act=hapus&id=$r[kode_dok]>Hapus</a></td></tr>";
			 }
			 elseif ($_SESSION[leveluser2]=='superuser2' OR $_SESSION[levelcv]==2 OR $_SESSION[levelcv]==3 OR $_SESSION[levelcv]==4) {
			 			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf> PDF</a></td></tr>";
			 }
			 
			 	 elseif  ($_SESSION[leveluser2]=='superuser' OR $_SESSION[levelcv]==5) {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>PDF</a></td></tr>";
			 }
			 
			  else {
			  echo "<td align=center width=25><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | 
			  <a href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>Lihat PDF</a> </td></tr>";
			 }
			 
			  
			  
			 
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode dokumen <b>$kata</b> pada jenis dokumen tersebut<br>";
  }
  
  
}
}

// ---------------------------------------------------------------- Cari dan tampilkan dokumen berdasarkan kode/judul dokumen untuk dijadikan UPD
elseif ($module=='dokumen' AND $act=='caridokumens'){
$kata1 = trim($_POST[kata1]);
if ($kata1=='kode') {

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen untuk dijadikan UPD dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Tgl R10</th><th>Tgl R11</th><th>Tgl R12</th><th>AKSI</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev13]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
								 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}	
				 echo "</td>				 
				 <td align=center width=65>";
				 if ($tgl_rev10==00000-00-00){
echo "";
}
else {
echo "$tgl_rev10";
}	
				 echo "</td>"; 
				 
				 echo "</td>				 
				 <td align=center width=65>";
				 if ($tgl_rev11==00000-00-00){
echo "";
}
else {
echo "$tgl_rev11";
}	
				 echo "</td>"; 
				 
				 echo "<td align=center width=65>";
				 if ($tgl_rev12==00000-00-00){
echo "";
}
else {
echo "$tgl_rev12";
}	
				 echo "</td>"; 
				 
				   
			  echo "<td align=center width=65><a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok]$r[nama_file]>File</a>|<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf>PDF</a>|<a href=../../home.php?pages=dokint&act=upddokumen&id=$r[kode_dok]>UPD-Kan</a></td></tr>";
			      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode dokumen <b>$kata</b><br>";
  }
  
  
}

else {

echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen untuk dijadikan UPD dengan judul dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>AKSI</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
					 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td>"; 
				 
				 
				   
			  echo "<td align=center width=65><a href=../../home.php?pages=dokint&act=upddokumen&id=$r[kode_dok]>UPD-Kan</a></td></tr>";
			      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan judul dokumen <b>$kata</b><br>";
  }
  
  
}
}

// ---------------------------------------------------------------- Cari dan tampilkan dokumen berdasarkan kode/judul dokumen untuk dijadikan permohonan copy
elseif ($module=='dokumen' AND $act=='caridokumencopy'){
$kata1 = trim($_POST[kata1]);
if ($kata1=='kode') {

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen untuk dijadikan permohonan copy dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Tgl R10</th><th>Tgl R11</th><th>Tgl R12</th><th>AKSI</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev13]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
								 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}	
				 echo "</td>				 
				 <td align=center width=65>";
				 if ($tgl_rev10==00000-00-00){
echo "";
}
else {
echo "$tgl_rev10";
}	
				 echo "</td>"; 
				 
				 echo "</td>				 
				 <td align=center width=65>";
				 if ($tgl_rev11==00000-00-00){
echo "";
}
else {
echo "$tgl_rev11";
}	
				 echo "</td>"; 
				 
				 echo "<td align=center width=65>";
				 if ($tgl_rev12==00000-00-00){
echo "";
}
else {
echo "$tgl_rev12";
}	
				 echo "</td>"; 
				 
				   
			  echo "<td align=center width=65><a href=../../home.php?pages=dokint&act=copydokumen&id=$r[kode_dok]>P-Copy</a></td></tr>";
			      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode dokumen <b>$kata</b><br>";
  }
  
  
}

elseif ($kata1=='kkom') {

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "kode_kom LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen untuk dijadikan permohonan copy dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Tgl R10</th><th>Tgl R11</th><th>Tgl R12</th><th>AKSI</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev13]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev14]);
	  $tgl_rev12=tgl_indo2($r[tgl_rev15]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
								 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}	
				 echo "</td>				 
				 <td align=center width=65>";
				 if ($tgl_rev10==00000-00-00){
echo "";
}
else {
echo "$tgl_rev10";
}	
				 echo "</td>"; 
				 
				 echo "</td>				 
				 <td align=center width=65>";
				 if ($tgl_rev11==00000-00-00){
echo "";
}
else {
echo "$tgl_rev11";
}	
				 echo "</td>"; 
				 
				 echo "<td align=center width=65>";
				 if ($tgl_rev12==00000-00-00){
echo "";
}
else {
echo "$tgl_rev12";
}	
				 echo "</td>"; 
				 
				   
			  echo "<td align=center width=65><a href=../../home.php?pages=dokint&act=copydokumen&id=$r[kode_dok]>P-Copy</a></td></tr>";
			      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan kode komputer <b>$kata</b><br><b></b>";
  }
  
  
}

else {

echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen untuk dijadikan permohonan copy dengan judul dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>AKSI</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
					 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 
				 echo "</td>"; 
				 
				 
				   
			  echo "<td align=center width=65><a href=../../home.php?pages=dokint&act=copydokumen&id=$r[kode_dok]>P-Copy</a></td></tr>";
			      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan judul dokumen <b>$kata</b><br>";
  }
  
  
}
}


// Tampilkan dokumen berdasarkan Jenis dokumen
elseif ($module=='dokumen' AND $act=='caridokumen3'){
$kata1 = trim($_POST[kata1]);
if ($kata1=='rdt') {

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";
 

	 // menghilangkan spasi di kiri dan kanannya
$kata = trim($_POST[kata]);
      
  $hasil  = mysql_query("SELECT * FROM dokumen WHERE id_jendok='$kata' ORDER BY kode_dok");
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p align=left><table><tr><td>Tgl Berlaku Dok : <b>05 OKT 2017</b></td></tr></table></p>";
   echo "<p align=right><img src=../../images/logokf.jpg alt=kimiafarma border=0/></p>";
   echo "<p align=right><b><font size=2>...</b></font></p>";
 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT></p>";
   
  $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok LIKE $kata ORDER BY id_jendok");
while($r=mysql_fetch_array($tampil)){
              echo " <p align=left><b><font size=2>Jenis Dokumen : $r[nama_jendok] </b></font></p>";
            }
			
			echo "<center><table align=center>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Tgl R10</th><th>Tgl R11</th><th>Tgl R12</th><th>Aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
	  $tgl_rev0=tgl_indo2($r[tgl_rev0]);
      $tgl_rev1=tgl_indo2($r[tgl_rev1]);
      $tgl_rev2=tgl_indo2($r[tgl_rev2]);
      $tgl_rev3=tgl_indo2($r[tgl_rev3]);
      $tgl_rev4=tgl_indo2($r[tgl_rev4]);
      $tgl_rev5=tgl_indo2($r[tgl_rev5]);
      $tgl_rev6=tgl_indo2($r[tgl_rev6]);
      $tgl_rev7=tgl_indo2($r[tgl_rev7]);
      $tgl_rev8=tgl_indo2($r[tgl_rev8]);
      $tgl_rev9=tgl_indo2($r[tgl_rev9]);
      $tgl_rev10=tgl_indo2($r[tgl_rev10]);
      $tgl_rev11=tgl_indo2($r[tgl_rev11]);
      $tgl_rev12=tgl_indo2($r[tgl_rev12]);
	        $tgl_rev12=tgl_indo2($r[tgl_rev13]);
			      $tgl_rev12=tgl_indo2($r[tgl_rev14]);
				        $tgl_rev12=tgl_indo2($r[tgl_rev15]);

       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		       <td align=center width=65>";
					 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](0).pdf>$tgl_rev0</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](1).pdf>$tgl_rev1</a>";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](2).pdf>$tgl_rev2</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](3).pdf>$tgl_rev3</a>";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](4).pdf>$tgl_rev4</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](5).pdf>$tgl_rev5</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](6).pdf>$tgl_rev6</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](7).pdf>$tgl_rev7</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](8).pdf>$tgl_rev8</a>";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](9).pdf>$tgl_rev9</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev10==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](10).pdf>$tgl_rev10</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev11==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](11).pdf>$tgl_rev11</a>";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev12==00000-00-00){
echo "";
}
else {
echo "<a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok](12).pdf>$tgl_rev12</a>";
}		 
				 echo "</td>";
				 
 if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
             echo "<td align=center width=150><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../m/master_dokumen/$r[id_jendok]/$r[kode_dok]$r[nama_file]>File</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf> PDF</a> | <a href=../../home.php?pages=dokint&act=distdokumen&id=$r[kode_dok]>Dist</a> | <a href=../../home.php?pages=dokint&act=editdokumen&id=$r[kode_dok]>Edit</a>|<a href=?module=dokumen&act=hapus&id=$r[kode_dok]>Hapus</a></td></tr>";
			 }
			 else {
			    echo "<td align=center width=65><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a></td></tr>";
				}
      $no++;
	   }
   echo "</table>";
   
	 
echo "<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan id jenis dokumen <b>$kata</b><br>";
  }
  
  
}



// Tampilkan CCHL berdasarkan Jenis dokumen
else {


 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";
 

	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
  $hasil  = mysql_query("SELECT * FROM dokumen WHERE id_jendok='$kata' ORDER BY kode_dok");
  $ketemu = mysql_num_rows($hasil);
  
 
  if ($ketemu > 0){
   echo "<p align=right><img src=../../images/logokf.jpg alt=kimiafarma border=0/></p>";
   echo "<p align=left><b><font size=2></b></font></p>";
 echo "<p ALIGN=CENTER><font size=3><b>DAFTAR PENERIMA DISTRIBUSI DOKUMEN TERKENDALI</b></FONT></p>";
   
  $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok LIKE $kata ORDER BY id_jendok");
while($r=mysql_fetch_array($tampil)){
              echo " <p align=center><b><font size=2>Jenis Dokumen : $r[nama_jendok] </b></font></p>";
            }
			
			echo "<center><table align=center>
          <tr><th>No</th><th>Judul Dokumen</th><th>Kode Dokumen</th><th>Controlled Copy Holder List (CCHL)</tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
       echo "<tr><td align=center>$no</td>
             <td align=left width=150>$r[judul_dok]</td>
             <td align=center width=80>$r[kode_dok]</td>
		         <td align=left width=700>$r[cchl]</td>
		         </tr>";
      $no++;
	   }
   echo "</table>";
  	 
echo "<p align=center>
<center><font size=2><b><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan id jenis dokumen <b>$kata</b><br>";
  }
  
  
}

}


// Cari dan tampilkan dokumen berdasarkan penerima dokumen
elseif ($module=='dokumen' AND $act=='caridokumen4'){

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "cchl LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "AND kode_dok LIKE '%F%' AND judul_dok NOT LIKE '%bsole%' ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen dengan penerima dokumen :<font style='background-color:#00FFFF'><b>$kata</b></font> (Sort By Kode Dokumen - Ctrl+F untuk mencari lebih cepat)<br>Untuk Dokumen Manual Mutu dan Prosedur Sistem Mutu (PSM) tidak ditampilkan disini tetapi di menu pencarian dokumen.</b> </p>"; 
echo "<hr color=#000890 noshade=noshade />";
 if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){
 echo "<b><p align=left>Tgl Berlaku Dokumen : 05 OKT 2017</p><p align=right>Kode Dokumen : ..</p></b><p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Jenis Dokumen</th><th>Aksi</th></tr>"; 
		  }
		  else
		  {
		   echo "<b><p align=left>Tgl Berlaku Dokumen : 05 OKT 2017</p><p align=right>Kode Dokumen : ...</p></b><p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Jenis Dokumen</th><th>Aksi</th></tr>"; 
		  }
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
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
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
					 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 

 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 

 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 

 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}		 


				 echo "</td><td align=left width=150>";
			  
			  $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  
		  
		  echo "$jenisdok[nama_jendok]</td> 
             <td align=center width=65><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../file.php?&id=$r[kode_dok] target=_blank>File Doc/Xls</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>File PDF</a> </td></tr>";
      $no++;

	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan penerima dokumen <b>$kata</b><br>";
  }
  
  
}


// Cari dan tampilkan dokumen berdasarkan penerima dokumen tanpa lampiran
elseif ($module=='dokumen' AND $act=='caridokumen5'){

 echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />

</head><body>
 
 <h2>Hasil Pencarian Dokumen</h2>";
	 // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
  $cari = "SELECT * FROM dokumen WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "cchl LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "AND tgl_Review != 0000-00-00 AND kode_dok NOT LIKE '%F%' AND judul_dok NOT LIKE '%bsole%' ORDER BY kode_dok ASC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> dokumen (tanpa lampiran/ LA) dengan penerima dokumen :<font style='background-color:#00FFFF'><b>$kata</b></font></p>"; 
echo "<hr color=#000890 noshade=noshade />";
 echo "<p align=left>Tgl Berlaku Dokumen : 05 OKT 2017</p><p align=right>Kode Dokumen : ...</p><p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN TERKENDALI</b></FONT><center><table>
          <tr><th>No</th><th>Kode Dokumen</th><th>Judul Dokumen</th><th>Tgl R0</th><th>Tgl R1</th><th>Tgl R2</th><th>Tgl R3</th><th>Tgl R4</th><th>Tgl R5</th><th>Tgl R6</th><th>Tgl R7</th><th>Tgl R8</th><th>Tgl R9</th><th>Jenis Dokumen</th><th>Aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($hasil)){
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
       echo "<tr><td align=center>$no</td>
             <td align=center width=80>$r[kode_dok]</td>
             <td align=left width=200>$r[judul_dok]</td>
		         <td align=center width=65>";
					 if ($tgl_rev0==00000-00-00){
echo "";
}
else {
echo "$tgl_rev0";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev1==00000-00-00){
echo "";
}
else {
echo "$tgl_rev1";
}		 
				 echo "</td> 
		         <td align=center width=65>";
				 if ($tgl_rev2==00000-00-00){
echo "";
}
else {
echo "$tgl_rev2";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev3==00000-00-00){
echo "";
}
else {
echo "$tgl_rev3";
}		 
				 echo "</td> 
				   <td align=center width=65>";
				 if ($tgl_rev4==00000-00-00){
echo "";
}
else {
echo "$tgl_rev4";
}		 
				 echo "</td>
		        <td align=center width=65>";
				 if ($tgl_rev5==00000-00-00){
echo "";
}
else {
echo "$tgl_rev5";
}		 
				 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev6==00000-00-00){
echo "";
}
else {
echo "$tgl_rev6";
}		 

echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev7==00000-00-00){
echo "";
}
else {
echo "$tgl_rev7";
}		 

 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev8==00000-00-00){
echo "";
}
else {
echo "$tgl_rev8";
}		 

 echo "</td> 
		        <td align=center width=65>";
				 if ($tgl_rev9==00000-00-00){
echo "";
}
else {
echo "$tgl_rev9";
}		 

				 echo "</td><td align=left width=150>";
			  
			  $tampil=mysql_query("SELECT * FROM jendok WHERE id_jendok =$r[id_jendok]");
           $jenisdok=mysql_fetch_array($tampil);
		  
		  
		  echo "$jenisdok[nama_jendok]</td> 
             <td align=center width=65><a href=../../home.php?pages=dokint&act=detaildokumen&id=$r[kode_dok]>Detail</a> | <a  href=../../file.php?&id=$r[kode_dok] target=_blank>File Doc/Xls</a> | <a  href=../../m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf target=_blank>File PDF</a> </td></tr>";
      $no++;
	   }
	      echo "</table>
<p align=center>
<center><font size=2><b><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";
		 
   
	 }
  else{
    echo "<center><font size=2>Tidak ditemukan dokumen dengan penerima dokumen <b>$kata</b><br>";
  }
  
  
}
  
// Hapus dokumen ---------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='hapus'){

echo "<p align=center><b>Apakah anda akan menghapus dokumen ini ? <br></b>
<center><a href=$aksi?module=dokumen&act=hapus2&id=$_GET[id]>Ya !</a> - <a href=../../home.php?pages=dokint>Tidak Jadi</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"
;
}

// Hapus dokumen 2 ---------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='hapus2'){
  mysql_query("DELETE FROM dokumen WHERE kode_dok='$_GET[id]'");
  header('location:../../home.php?pages='.$module);

}

// Tambah dokumen ---------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='input'){

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);
	  $tgl_review=($_POST[tgl_berlaku]+3);
	  

  if (!empty($_POST[cchl])){
    $tag_new = $_POST[cchl];
    $tag=implode(', ',$tag_new);
  }
$lihatdok = mysql_query("SELECT * FROM dokumen WHERE kode_dok = '$_POST[kode_dok]' ");
$lihatdok2 = mysql_num_rows($lihatdok);
if ($lihatdok2 > 0){
	 echo "<font size=6><center>Kode Dokumen Double!, mohon dicek dahulu di registrasi dokumen! <br><img src='../../images/bagus.gif'><br><a href=../../home.php?pages=dokint>Kembali</a></font></center>";}
	 else {
 
mysql_query("INSERT INTO dokumen( kode_dok, kode_kom, dok_terkait, id_jendok, judul_dok, pj_dok, tgl_Rev0, tgl_Rev1, tgl_Rev2, tgl_Rev3, tgl_Rev4, tgl_Rev5, tgl_Rev6, tgl_Rev7, tgl_Rev8, tgl_Rev9, tgl_Rev10, tgl_Rev11, tgl_Rev12, tgl_Rev13, tgl_Rev14, tgl_Rev15, tgl_berlaku, nama_file, tgl_review, cchl2, keterangan, keterangan3, cchl)  
VALUES('$_POST[kode_dok]',
								   '$_POST[kode_kom]',
								   '$_POST[dok_terkait]',
								   '$_POST[id_jendok]',
								   '$_POST[judul_dok]',
								   '$_POST[pj_dok]',
								   '$_POST[tgl_rev0]',
                                   '$_POST[tgl_rev1]',
                                   '$_POST[tgl_rev2]',
                                   '$_POST[tgl_rev3]',
                                   '$_POST[tgl_rev4]',
                                   '$_POST[tgl_rev5]',
                                   '$_POST[tgl_rev6]',
                                   '$_POST[tgl_rev7]',
                                   '$_POST[tgl_rev8]',
                                   '$_POST[tgl_rev9]',
                                   '$_POST[tgl_rev10]',
                                   '$_POST[tgl_rev11]',
                                   '$_POST[tgl_rev12]',
								   '$_POST[tgl_rev13]',
								   '$_POST[tgl_rev14]',
								   '$_POST[tgl_rev15]', 
								   '$_POST[tgl_berlaku]',
								   '$_POST[nama_file]',
								   '$tgl_review$tgl_berlaku',
								   '$_POST[cchl2]',
								   '$_POST[keterangan]',
								   '$_POST[keterangan3]',
								   '$tag')");
	
  
    echo "<p align=center><b>Dokumen baru telah dibuat !<br></b>
<center><a href=../../home.php?pages=dokint>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	

}
}

// Update dokumen ----------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='update'){

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);
$tgl_review=($_POST[tgl_berlaku]+3);
  
if (!empty($_POST[cchl])){
    $tag_new = $_POST[cchl];
    $tag=implode(', ',$tag_new);
  }

mysql_query("UPDATE dokumen SET 
kode_dok    = '$_POST[kode_dok]',
kode_kom    = '$_POST[kode_kom]',
dok_terkait = '$_POST[dok_terkait]',
judul_dok   = '$_POST[judul_dok]',
id_jendok   = '$_POST[id_jendok]',
pj_dok	    = '$_POST[pj_dok]',
tgl_rev0	= '$_POST[tgl_rev0]', 
tgl_rev1	= '$_POST[tgl_rev1]',
tgl_rev2    = '$_POST[tgl_rev2]',
tgl_rev3	= '$_POST[tgl_rev3]',
tgl_rev4	= '$_POST[tgl_rev4]',
tgl_rev5	= '$_POST[tgl_rev5]', 
tgl_rev6	= '$_POST[tgl_rev6]', 
tgl_rev7	= '$_POST[tgl_rev7]', 
tgl_rev8	= '$_POST[tgl_rev8]', 
tgl_rev9	= '$_POST[tgl_rev9]', 
tgl_rev10	= '$_POST[tgl_rev10]', 
tgl_rev11	= '$_POST[tgl_rev11]', 
tgl_rev12	= '$_POST[tgl_rev12]', 
tgl_rev13	= '$_POST[tgl_rev13]', 
tgl_rev14	= '$_POST[tgl_rev14]', 
tgl_rev15	= '$_POST[tgl_rev15]', 
tgl_berlaku	= '$_POST[tgl_berlaku]', 
tgl_review  = '$_POST[tgl_review]',
tgl_review1 = '$_POST[tgl_review1]',
tgl_review2 = '$_POST[tgl_review2]',
tgl_review3 = '$_POST[tgl_review3]',
tgl_slesai_review  = '$_POST[tgl_slesai_review]',
tgl_slesai_review1 = '$_POST[tgl_slesai_review1]',
tgl_slesai_review2 = '$_POST[tgl_slesai_review2]',
tgl_slesai_review3 = '$_POST[tgl_slesai_review3]',
tgl_real_review = '$_POST[tgl_real_review]',
tgl_review_sebelumnya = '$_POST[tgl_review_sebelumnya]',
review_oleh = '$_POST[review_oleh]',
hasil_review1  = '$_POST[hasil_review1]',
hasil_review2  = '$_POST[hasil_review2]',
hasil_review3  = '$_POST[hasil_review3]',
cchl        = '$tag',
cchl2       = '$_POST[cchl2]',
nama_file   = '$_POST[nama_file]',
keterangan  = '$_POST[keterangan]',
keterangan3 = '$_POST[keterangan3]'
WHERE kode_dok   = '$_POST[kode_dok]'");
  
   
   echo "<p align=center><b>Dokumen telah di edit !<br></b>
<center><a href=../../home.php?pages=dokint>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	
}


// email dokumen ----------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='email'){

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);
$tgl_review=($_POST[tgl_berlaku]+3);
  
if (!empty($_POST[username])){
    $tag_new = $_POST[username];
    $tag=implode(', ',$tag_new);
  }

mail('$tag', 'Informasi Distribusi Dokumen : $_POST[kode_dok]/$_POST[rev_terakhir]', 'Yth. Bapak/Ibu<br>, SPD-MR menginformasi telah ada dokumen baru <br> kode dokumen : $_POST[kode_dok]/$_POST[rev_terakhir] dan <br> Judul Dokumen : $_POST[judul_dok], <br>mohon di cek di aplikasi http://ekfpb.com. Terima kasih', "From: plant_Banjaran@ekfpb.com");
  
$sql = mysql_query("INSERT INTO pesan(subjek,isi_pesan,username,tgl,jam_pesan,jenis_pesan,nama_file) 
VALUES('Informasi Distribusi Dokumen : $_POST[kode_dok]/$_POST[rev_terakhir]','Yth. Bapak/Ibu<br>, SPD-MR menginformasi telah ada dokumen baru <br> kode dokumen : $_POST[kode_dok]/$_POST[rev_terakhir] dan <br> Judul Dokumen : $_POST[judul_dok], <br>mohon di cek di aplikasi http://kfpb.co.id. Terima kasih','$tag','$tgl_sekarang','$jam_sekarang', 'DISTRIBUSI','$nama_file')");
  
  
   
   echo "<p align=center><b>Informasi Dokumen telah di email sukses !<br>Dikirim ke : $tag</b>
<center><a href=../../home.php?pages=dokint>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	
}


// Update dokumen 4 (khusus) ----------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='update4'){


mysql_query("UPDATE dokumen SET 
judul_dok   	= '$_POST[judul_dok]',
id_jendok   	= '$_POST[id_jendok]',
nama_file 			= '$_POST[nama_file]',
kode_kom  		= '$_POST[kode_kom]',
tgl_berlaku		= '$_POST[tgl_berlaku]', 
tgl_review  	= '$_POST[tgl_review]',
tgl_review_sebelumnya  	= '$_POST[tgl_review_sebelumnya]',
tgl_review1  	= '$_POST[tgl_review1]',
hasil_review1  	= '$_POST[hasil_review1]',
tgl_review2  	= '$_POST[tgl_review2]',
hasil_review2  	= '$_POST[hasil_review2]',
tgl_review3  	= '$_POST[tgl_review3]',
hasil_review3  	= '$_POST[hasil_review3]',
pj_dok 			= '$_POST[pj_dok]',
cchl        	= '$_POST[cchl]',
cchl2        	= '$_POST[cchl2]',
keterangan      = '$_POST[keterangan]',
keterangan3     = '$_POST[keterangan3]'
WHERE kode_dok  = '$_POST[kode_dok]'");
 
echo"<script LANGUAGE=JavaScript>
function closePg(){
	window.close();
	return true;
}
</script>
<body onLoad='return closePg()'></body>";
}

// Update dokumen review ----------------------------------------------------------------------------------------------------
elseif ($module=='dokumen' AND $act=='updatereview'){

if ($_POST[tgl_review1]!='' and $_POST[tgl_review2]=='' and $_POST[tgl_review3]==''){

$tgl_review1 =tgl_indo1($_POST[tgl_review1]);
$tgl_reviewku1 =($_POST[tgl_review1]+3);
$tgl_sekarang = date("Y-m-d");

mysql_query("UPDATE dokumen SET 
review_oleh		= '$_POST[review_oleh]',
tgl_review   	= '$tgl_reviewku1$tgl_review1',
tgl_slesai_review1 = '$tgl_sekarang',
hasil_review1  		= '$_POST[hasil_review1]',
tgl_review1		= '$_POST[tgl_review1]',
tgl_slesai_review = '$tgl_sekarang',
tgl_real_review = '$_POST[tgl_review1]',
tgl_berlaku     = '$_POST[tgl_review1]',
tgl_review_sebelumnya = '$_POST[tgl_review1]'


WHERE kode_dok  = '$_POST[kode_dok]'");
 
 }
 elseif ($_POST[tgl_review1]!='' AND $_POST[tgl_review2]!='' and $_POST[tgl_review3]==''){
 $tgl_review2 =tgl_indo1($_POST[tgl_review2]);
$tgl_reviewku2 =($_POST[tgl_review2]+3);
$tgl_sekarang = date("Y-m-d");

mysql_query("UPDATE dokumen SET 
review_oleh		= '$_POST[review_oleh]',
tgl_review   	= '$tgl_reviewku2$tgl_review2',
tgl_slesai_review2 = '$tgl_sekarang',
hasil_review2  		= '$_POST[hasil_review2]',
tgl_review2		= '$_POST[tgl_review2]',
tgl_slesai_review = '$tgl_sekarang',
tgl_real_review = '$_POST[tgl_review2]',
tgl_berlaku     = '$_POST[tgl_review2]',
tgl_review_sebelumnya = '$_POST[tgl_review2]'

WHERE kode_dok  = '$_POST[kode_dok]'");
 
 }
 
 else {
$tgl_review3=tgl_indo1($_POST[tgl_review3]);
$tgl_reviewku3 =($_POST[tgl_review3]+3);
$tgl_sekarang = date("Y-m-d");

mysql_query("UPDATE dokumen SET 
review_oleh		= '$_POST[review_oleh]',
tgl_review   	= '$tgl_reviewku3$tgl_review3',
tgl_slesai_review3 = '$tgl_sekarang',
hasil_review3  		= '$_POST[hasil_review3]',
tgl_review3		= '$_POST[tgl_review3]',
tgl_slesai_review = '$tgl_sekarang',
tgl_real_review = '$_POST[tgl_review3]',
tgl_berlaku     = '$_POST[tgl_review3]',
tgl_review_sebelumnya = '$_POST[tgl_review3]'

WHERE kode_dok  = '$_POST[kode_dok]'");
 
 }
 
 
 
echo"
<script>window.alert('Review Dokumen tersimpan !')</script>
<script LANGUAGE=JavaScript>
function closePg(){
	window.close();
	return true;
}
</script>
<body onLoad='return closePg()'></body>";
}

elseif ($module=='dokumen' AND $act=='inputdist2'){
	
	
	$sql = mysql_query("INSERT INTO pesan(subjek,isi_pesan,username,tgl,jam_pesan,jenis_pesan) 
VALUES('Distribusi Dokumen $_POST[kode_dok]/$_POST[revisi]','Distribusi Dokumen terbaru, lihat dokumen di menu REGISTRASI DOKUMEN, kode dok : $_POST[kode_dok], Judul : $_POST[judul_dok], Revisi : $_POST[revisi]. Bagi penanggung jawab dokumen yang tercantum di Prosedur harap
							   segera mensosialisasikan pakai lembar sosialisasi, jika dokumen revisi segera kembalikan dokumen lama di lapangan. Data Dokumen di lapangan : $_POST[cchl2] ','$_POST[kata],$_POST[kata2],$_POST[kata3],$_POST[kata4],$_POST[kata5],$_POST[kata6],$_POST[kata7],$_POST[kata8],$_POST[kata9],$_POST[kata10],
							   $_POST[kata11],$_POST[kata12],$_POST[kata13],$_POST[kata14],$_POST[kata15],$_POST[kata16],$_POST[kata17],$_POST[kata18],$_POST[kata19],$_POST[kata20],
							   $_POST[kata21],$_POST[kata22],$_POST[kata23],$_POST[kata24],$_POST[kata25],$_POST[kata26],$_POST[kata27],$_POST[kata28],$_POST[kata29],$_POST[kata30],$_POST[kata31],
							   $_POST[kata32],$_POST[kata33],$_POST[kata34],$_POST[kata35],$_POST[kata36],$_POST[kata37],$_POST[kata38],$_POST[kata39],$_POST[kata40],$_POST[kata41],$_POST[kata42],$_POST[kata43],
							   $_POST[kata44],$_POST[kata45],$_POST[kata46],$_POST[kata47],$_POST[kata48],$_POST[kata49],$_POST[kata50],$_POST[kata51],$_POST[kata52],$_POST[kata53],$_POST[kata54],$_POST[kata55],$_POST[kata56],$_POST[kata57],$_POST[kata58],$_POST[kata59],$_POST[kata60]','$tgl_sekarang','$jam_sekarang', 'DISTRIBUSI')");
	  
}
  
  
  elseif ($module=='dokumen' AND $act=='inputdist'){
	

   echo "<h2>Buat Distribusi Dokumen</h2>
 
   
   
          <form method=POST action=/security1/pdf_dist.php >
<input type=hidden name='kode_dok' value='$_POST[kode_dok]'>
<input type=hidden name='judul_dok' value='$_POST[judul_dok]'>
<input type=hidden name='revisi'  value='$_POST[revisi]'>
<input type=hidden name='id_jendok'  value='$_POST[id_jendok]'>
<input type=hidden name='tgldist' value='$_POST[tgldist]'>
<input type=hidden name='cchl2' value='$_POST[cchl2]'>
<input type=hidden name='kata' value='$_POST[kata]'>
<input type=hidden name='kata2' value='$_POST[kata2]'>
<input type=hidden name='kata3' value='$_POST[kata3]'>
<input type=hidden name='kata4' value='$_POST[kata4]'>
<input type=hidden name='kata5' value='$_POST[kata5]'>
<input type=hidden name='kata6' value='$_POST[kata6]'>
<input type=hidden name='kata7' value='$_POST[kata7]'>
<input type=hidden name='kata8' value='$_POST[kata8]'>
<input type=hidden name='kata9' value='$_POST[kata9]'>
<input type=hidden name='kata10' value='$_POST[kata10]'>
<input type=hidden name='kata11' value='$_POST[kata11]'>
<input type=hidden name='kata12' value='$_POST[kata12]'>
<input type=hidden name='kata13' value='$_POST[kata13]'>
<input type=hidden name='kata14' value='$_POST[kata14]'>
<input type=hidden name='kata15' value='$_POST[kata15]'>
<input type=hidden name='kata16' value='$_POST[kata16]'>
<input type=hidden name='kata17' value='$_POST[kata17]'>
<input type=hidden name='kata18' value='$_POST[kata18]'>
<input type=hidden name='kata19' value='$_POST[kata19]'>
<input type=hidden name='kata20' value='$_POST[kata20]'>
<input type=hidden name='kata21' value='$_POST[kata21]'>
<input type=hidden name='kata22' value='$_POST[kata22]'>
<input type=hidden name='kata23' value='$_POST[kata23]'>
<input type=hidden name='kata24' value='$_POST[kata24]'>
<input type=hidden name='kata25' value='$_POST[kata25]'>
<input type=hidden name='kata26' value='$_POST[kata26]'>
<input type=hidden name='kata27' value='$_POST[kata27]'>
<input type=hidden name='kata28' value='$_POST[kata28]'>
<input type=hidden name='kata29' value='$_POST[kata29]'>
<input type=hidden name='kata30' value='$_POST[kata30]'>
<input type=hidden name='kata31' value='$_POST[kata31]'>
<input type=hidden name='kata32' value='$_POST[kata32]'>
<input type=hidden name='kata33' value='$_POST[kata33]'>
<input type=hidden name='kata34' value='$_POST[kata34]'>
<input type=hidden name='kata35' value='$_POST[kata35]'>
<input type=hidden name='kata36' value='$_POST[kata36]'>
<input type=hidden name='kata37' value='$_POST[kata37]'>
<input type=hidden name='kata38' value='$_POST[kata38]'>
<input type=hidden name='kata39' value='$_POST[kata39]'>
<input type=hidden name='kata40' value='$_POST[kata40]'>
<input type=hidden name='kata41' value='$_POST[kata41]'>
<input type=hidden name='kata42' value='$_POST[kata42]'>
<input type=hidden name='kata43' value='$_POST[kata43]'>
<input type=hidden name='kata44' value='$_POST[kata44]'>
<input type=hidden name='kata45' value='$_POST[kata45]'>
<input type=hidden name='kata46' value='$_POST[kata46]'>
<input type=hidden name='kata47' value='$_POST[kata47]'>
<input type=hidden name='kata48' value='$_POST[kata48]'>
<input type=hidden name='kata49' value='$_POST[kata49]'>
<input type=hidden name='kata50' value='$_POST[kata50]'>
<input type=hidden name='kata51' value='$_POST[kata51]'>
<input type=hidden name='kata52' value='$_POST[kata52]'>
<input type=hidden name='kata53' value='$_POST[kata53]'>
<input type=hidden name='kata54' value='$_POST[kata54]'>
<input type=hidden name='kata55' value='$_POST[kata55]'>
<input type=hidden name='kata56' value='$_POST[kata56]'>
<input type=hidden name='kata57' value='$_POST[kata57]'>
<input type=hidden name='kata58' value='$_POST[kata58]'>
<input type=hidden name='kata59' value='$_POST[kata59]'>
<input type=hidden name='kata60' value='$_POST[kata60]'>


<input type=submit value='Klik disini untuk Buat Distribusi'>
</form>";

   echo "<h2>Buat Berita Acara Pemusnahan Dokumen</h2>
          <form method=POST action=/security1/pdf_musnah.php >
<input type=hidden name='kode_dok' value='$_POST[kode_dok]'>
<input type=hidden name='judul_dok' value='$_POST[judul_dok]'>
<input type=hidden name='revisilama'  value='$_POST[revisilama]'>
<input type=hidden name='id_jendok'  value='$_POST[id_jendok]'>
<input type=hidden name='tgldist' value='$_POST[tgldist]'>
<input type=hidden name='cchl2' value='$_POST[cchl2]'>
<input type=hidden name='kata' value='$_POST[kata]'>
<input type=hidden name='kata2' value='$_POST[kata2]'>
<input type=hidden name='kata3' value='$_POST[kata3]'>
<input type=hidden name='kata4' value='$_POST[kata4]'>
<input type=hidden name='kata5' value='$_POST[kata5]'>
<input type=hidden name='kata6' value='$_POST[kata6]'>
<input type=hidden name='kata7' value='$_POST[kata7]'>
<input type=hidden name='kata8' value='$_POST[kata8]'>
<input type=hidden name='kata9' value='$_POST[kata9]'>
<input type=hidden name='kata10' value='$_POST[kata10]'>
<input type=hidden name='kata11' value='$_POST[kata11]'>
<input type=hidden name='kata12' value='$_POST[kata12]'>
<input type=hidden name='kata13' value='$_POST[kata13]'>
<input type=hidden name='kata14' value='$_POST[kata14]'>
<input type=hidden name='kata15' value='$_POST[kata15]'>
<input type=hidden name='kata16' value='$_POST[kata16]'>
<input type=hidden name='kata17' value='$_POST[kata17]'>
<input type=hidden name='kata18' value='$_POST[kata18]'>
<input type=hidden name='kata19' value='$_POST[kata19]'>
<input type=hidden name='kata20' value='$_POST[kata20]'>
<input type=hidden name='kata21' value='$_POST[kata21]'>
<input type=hidden name='kata22' value='$_POST[kata22]'>
<input type=hidden name='kata23' value='$_POST[kata23]'>
<input type=hidden name='kata24' value='$_POST[kata24]'>
<input type=hidden name='kata25' value='$_POST[kata25]'>
<input type=hidden name='kata26' value='$_POST[kata26]'>
<input type=hidden name='kata27' value='$_POST[kata27]'>
<input type=hidden name='kata28' value='$_POST[kata28]'>
<input type=hidden name='kata29' value='$_POST[kata29]'>
<input type=hidden name='kata30' value='$_POST[kata30]'>
<input type=hidden name='kata31' value='$_POST[kata31]'>
<input type=hidden name='kata32' value='$_POST[kata32]'>
<input type=hidden name='kata33' value='$_POST[kata33]'>
<input type=hidden name='kata34' value='$_POST[kata34]'>
<input type=hidden name='kata35' value='$_POST[kata35]'>
<input type=hidden name='kata36' value='$_POST[kata36]'>
<input type=hidden name='kata37' value='$_POST[kata37]'>
<input type=hidden name='kata38' value='$_POST[kata38]'>
<input type=hidden name='kata39' value='$_POST[kata39]'>
<input type=hidden name='kata40' value='$_POST[kata40]'>
<input type=hidden name='kata41' value='$_POST[kata41]'>
<input type=hidden name='kata42' value='$_POST[kata42]'>
<input type=hidden name='kata43' value='$_POST[kata43]'>
<input type=hidden name='kata44' value='$_POST[kata44]'>
<input type=hidden name='kata45' value='$_POST[kata45]'>
<input type=hidden name='kata46' value='$_POST[kata46]'>
<input type=hidden name='kata47' value='$_POST[kata47]'>
<input type=hidden name='kata48' value='$_POST[kata48]'>
<input type=hidden name='kata49' value='$_POST[kata49]'>
<input type=hidden name='kata50' value='$_POST[kata50]'>
<input type=hidden name='kata51' value='$_POST[kata51]'>
<input type=hidden name='kata52' value='$_POST[kata52]'>
<input type=hidden name='kata53' value='$_POST[kata53]'>
<input type=hidden name='kata54' value='$_POST[kata54]'>
<input type=hidden name='kata55' value='$_POST[kata55]'>
<input type=hidden name='kata56' value='$_POST[kata56]'>
<input type=hidden name='kata57' value='$_POST[kata57]'>
<input type=hidden name='kata58' value='$_POST[kata58]'>
<input type=hidden name='kata59' value='$_POST[kata59]'>
<input type=hidden name='kata60' value='$_POST[kata60]'>


<input type=submit value='Klik disini untuk Buat Berita Acara'>
</form>";

 echo "<h2>Buat Lembar Informasi Supervisor </h2>
          <form method=POST action=/security1/pdf_distkembali2.php >
<input type=hidden name='kode_dok' value='$_POST[kode_dok]'>
<input type=hidden name='judul_dok' value='$_POST[judul_dok]'>
<input type=hidden name='revisi'  value='$_POST[revisi]'>
<input type=hidden name='revisilama'  value='$_POST[revisilama]'>
<input type=hidden name='revisibaru'  value='$_POST[revisibaru]'>
<input type=hidden name='id_jendok'  value='$_POST[id_jendok]'>
<input type=hidden name='tgldist' value='$_POST[tgldist]'>
<input type=hidden name='tglbuat' value='$_POST[tglbuat]'>
<input type=hidden name='keterangan' value='$_POST[keterangan]'>
<input type=hidden name='cchl2' value='$_POST[cchl2]'>
<input type=hidden name='kata' value='$_POST[kata]'>
<input type=hidden name='kata2' value='$_POST[kata2]'>
<input type=hidden name='kata3' value='$_POST[kata3]'>
<input type=hidden name='kata4' value='$_POST[kata4]'>
<input type=hidden name='kata5' value='$_POST[kata5]'>
<input type=hidden name='kata6' value='$_POST[kata6]'>
<input type=hidden name='kata7' value='$_POST[kata7]'>
<input type=hidden name='kata8' value='$_POST[kata8]'>
<input type=hidden name='kata9' value='$_POST[kata9]'>
<input type=hidden name='kata10' value='$_POST[kata10]'>
<input type=hidden name='kata11' value='$_POST[kata11]'>
<input type=hidden name='kata12' value='$_POST[kata12]'>
<input type=hidden name='kata13' value='$_POST[kata13]'>
<input type=hidden name='kata14' value='$_POST[kata14]'>
<input type=hidden name='kata15' value='$_POST[kata15]'>
<input type=hidden name='kata16' value='$_POST[kata16]'>
<input type=hidden name='kata17' value='$_POST[kata17]'>
<input type=hidden name='kata18' value='$_POST[kata18]'>
<input type=hidden name='kata19' value='$_POST[kata19]'>
<input type=hidden name='kata20' value='$_POST[kata20]'>
<input type=hidden name='kata21' value='$_POST[kata21]'>
<input type=hidden name='kata22' value='$_POST[kata22]'>
<input type=hidden name='kata23' value='$_POST[kata23]'>
<input type=hidden name='kata24' value='$_POST[kata24]'>
<input type=hidden name='kata25' value='$_POST[kata25]'>
<input type=hidden name='kata26' value='$_POST[kata26]'>
<input type=hidden name='kata27' value='$_POST[kata27]'>
<input type=hidden name='kata28' value='$_POST[kata28]'>
<input type=hidden name='kata29' value='$_POST[kata29]'>
<input type=hidden name='kata30' value='$_POST[kata30]'>
<input type=hidden name='kata31' value='$_POST[kata31]'>
<input type=hidden name='kata32' value='$_POST[kata32]'>
<input type=hidden name='kata33' value='$_POST[kata33]'>
<input type=hidden name='kata34' value='$_POST[kata34]'>
<input type=hidden name='kata35' value='$_POST[kata35]'>
<input type=hidden name='kata36' value='$_POST[kata36]'>
<input type=hidden name='kata37' value='$_POST[kata37]'>
<input type=hidden name='kata38' value='$_POST[kata38]'>
<input type=hidden name='kata39' value='$_POST[kata39]'>
<input type=hidden name='kata40' value='$_POST[kata40]'>
<input type=hidden name='kata41' value='$_POST[kata41]'>
<input type=hidden name='kata42' value='$_POST[kata42]'>
<input type=hidden name='kata43' value='$_POST[kata43]'>
<input type=hidden name='kata44' value='$_POST[kata44]'>
<input type=hidden name='kata45' value='$_POST[kata45]'>
<input type=hidden name='kata46' value='$_POST[kata46]'>
<input type=hidden name='kata47' value='$_POST[kata47]'>
<input type=hidden name='kata48' value='$_POST[kata48]'>
<input type=hidden name='kata49' value='$_POST[kata49]'>
<input type=hidden name='kata50' value='$_POST[kata50]'>
<input type=hidden name='kata51' value='$_POST[kata51]'>
<input type=hidden name='kata52' value='$_POST[kata52]'>
<input type=hidden name='kata53' value='$_POST[kata53]'>
<input type=hidden name='kata54' value='$_POST[kata54]'>
<input type=hidden name='kata55' value='$_POST[kata55]'>
<input type=hidden name='kata56' value='$_POST[kata56]'>
<input type=hidden name='kata57' value='$_POST[kata57]'>
<input type=hidden name='kata58' value='$_POST[kata58]'>
<input type=hidden name='kata59' value='$_POST[kata59]'>
<input type=hidden name='kata60' value='$_POST[kata60]'>


<input type=submit value='Klik disini untuk Buat Lembar Info Supervisor'>
</form>";



 echo "<h2>Buat Lembar Informasi Asman Keatas </h2>
          <form method=POST action=/security1/pdf_distkembali.php >
<input type=hidden name='kode_dok' value='$_POST[kode_dok]'>
<input type=hidden name='judul_dok' value='$_POST[judul_dok]'>
<input type=hidden name='revisi'  value='$_POST[revisi]'>
<input type=hidden name='revisilama'  value='$_POST[revisilama]'>
<input type=hidden name='revisibaru'  value='$_POST[revisibaru]'>
<input type=hidden name='id_jendok'  value='$_POST[id_jendok]'>
<input type=hidden name='tgldist' value='$_POST[tgldist]'>
<input type=hidden name='tglbuat' value='$_POST[tglbuat]'>
<input type=hidden name='keterangan' value='$_POST[keterangan]'>
<input type=hidden name='cchl2' value='$_POST[cchl2]'>
<input type=hidden name='kata' value='$_POST[kata]'>
<input type=hidden name='kata2' value='$_POST[kata2]'>
<input type=hidden name='kata3' value='$_POST[kata3]'>
<input type=hidden name='kata4' value='$_POST[kata4]'>
<input type=hidden name='kata5' value='$_POST[kata5]'>
<input type=hidden name='kata6' value='$_POST[kata6]'>
<input type=hidden name='kata7' value='$_POST[kata7]'>
<input type=hidden name='kata8' value='$_POST[kata8]'>
<input type=hidden name='kata9' value='$_POST[kata9]'>
<input type=hidden name='kata10' value='$_POST[kata10]'>
<input type=hidden name='kata11' value='$_POST[kata11]'>
<input type=hidden name='kata12' value='$_POST[kata12]'>
<input type=hidden name='kata13' value='$_POST[kata13]'>
<input type=hidden name='kata14' value='$_POST[kata14]'>
<input type=hidden name='kata15' value='$_POST[kata15]'>
<input type=hidden name='kata16' value='$_POST[kata16]'>
<input type=hidden name='kata17' value='$_POST[kata17]'>
<input type=hidden name='kata18' value='$_POST[kata18]'>
<input type=hidden name='kata19' value='$_POST[kata19]'>
<input type=hidden name='kata20' value='$_POST[kata20]'>
<input type=hidden name='kata21' value='$_POST[kata21]'>
<input type=hidden name='kata22' value='$_POST[kata22]'>
<input type=hidden name='kata23' value='$_POST[kata23]'>
<input type=hidden name='kata24' value='$_POST[kata24]'>
<input type=hidden name='kata25' value='$_POST[kata25]'>
<input type=hidden name='kata26' value='$_POST[kata26]'>
<input type=hidden name='kata27' value='$_POST[kata27]'>
<input type=hidden name='kata28' value='$_POST[kata28]'>
<input type=hidden name='kata29' value='$_POST[kata29]'>
<input type=hidden name='kata30' value='$_POST[kata30]'>
<input type=hidden name='kata31' value='$_POST[kata31]'>
<input type=hidden name='kata32' value='$_POST[kata32]'>
<input type=hidden name='kata33' value='$_POST[kata33]'>
<input type=hidden name='kata34' value='$_POST[kata34]'>
<input type=hidden name='kata35' value='$_POST[kata35]'>
<input type=hidden name='kata36' value='$_POST[kata36]'>
<input type=hidden name='kata37' value='$_POST[kata37]'>
<input type=hidden name='kata38' value='$_POST[kata38]'>
<input type=hidden name='kata39' value='$_POST[kata39]'>
<input type=hidden name='kata40' value='$_POST[kata40]'>
<input type=hidden name='kata41' value='$_POST[kata41]'>
<input type=hidden name='kata42' value='$_POST[kata42]'>
<input type=hidden name='kata43' value='$_POST[kata43]'>
<input type=hidden name='kata44' value='$_POST[kata44]'>
<input type=hidden name='kata45' value='$_POST[kata45]'>
<input type=hidden name='kata46' value='$_POST[kata46]'>
<input type=hidden name='kata47' value='$_POST[kata47]'>
<input type=hidden name='kata48' value='$_POST[kata48]'>
<input type=hidden name='kata49' value='$_POST[kata49]'>
<input type=hidden name='kata50' value='$_POST[kata50]'>
<input type=hidden name='kata51' value='$_POST[kata51]'>
<input type=hidden name='kata52' value='$_POST[kata52]'>
<input type=hidden name='kata53' value='$_POST[kata53]'>
<input type=hidden name='kata54' value='$_POST[kata54]'>
<input type=hidden name='kata55' value='$_POST[kata55]'>
<input type=hidden name='kata56' value='$_POST[kata56]'>
<input type=hidden name='kata57' value='$_POST[kata57]'>
<input type=hidden name='kata58' value='$_POST[kata58]'>
<input type=hidden name='kata59' value='$_POST[kata59]'>
<input type=hidden name='kata60' value='$_POST[kata60]'>


<input type=submit value='Klik disini untuk Buat Lembar Info Asman Keatas'>
</form>";



 echo "<h2>Buat Sosialisasi Dokumen</h2>
          <form method=POST action=/security1/pdf_sosial.php >
<input type=hidden name='kode_dok' value='$_POST[kode_dok]'>
<input type=hidden name='judul_dok' value='$_POST[judul_dok]'>
<input type=hidden name='revisi'  value='$_POST[revisi]'>
<input type=hidden name='id_jendok'  value='$_POST[id_jendok]'>
<input type=hidden name='tgldist' value='$_POST[tgldist]'>
<input type=hidden name='cchl2' value='$_POST[cchl2]'>
<input type=hidden name='kata' value='$_POST[kata]'>
<input type=hidden name='kata2' value='$_POST[kata2]'>
<input type=hidden name='kata3' value='$_POST[kata3]'>
<input type=hidden name='kata4' value='$_POST[kata4]'>
<input type=hidden name='kata5' value='$_POST[kata5]'>
<input type=hidden name='kata6' value='$_POST[kata6]'>
<input type=hidden name='kata7' value='$_POST[kata7]'>
<input type=hidden name='kata8' value='$_POST[kata8]'>
<input type=hidden name='kata9' value='$_POST[kata9]'>
<input type=hidden name='kata10' value='$_POST[kata10]'>
<input type=hidden name='kata11' value='$_POST[kata11]'>
<input type=hidden name='kata12' value='$_POST[kata12]'>
<input type=hidden name='kata13' value='$_POST[kata13]'>
<input type=hidden name='kata14' value='$_POST[kata14]'>
<input type=hidden name='kata15' value='$_POST[kata15]'>
<input type=hidden name='kata16' value='$_POST[kata16]'>
<input type=hidden name='kata17' value='$_POST[kata17]'>
<input type=hidden name='kata18' value='$_POST[kata18]'>
<input type=hidden name='kata19' value='$_POST[kata19]'>
<input type=hidden name='kata20' value='$_POST[kata20]'>
<input type=hidden name='kata21' value='$_POST[kata21]'>
<input type=hidden name='kata22' value='$_POST[kata22]'>
<input type=hidden name='kata23' value='$_POST[kata23]'>
<input type=hidden name='kata24' value='$_POST[kata24]'>
<input type=hidden name='kata25' value='$_POST[kata25]'>
<input type=hidden name='kata26' value='$_POST[kata26]'>
<input type=hidden name='kata27' value='$_POST[kata27]'>
<input type=hidden name='kata28' value='$_POST[kata28]'>
<input type=hidden name='kata29' value='$_POST[kata29]'>
<input type=hidden name='kata30' value='$_POST[kata30]'>
<input type=hidden name='kata31' value='$_POST[kata31]'>
<input type=hidden name='kata32' value='$_POST[kata32]'>
<input type=hidden name='kata33' value='$_POST[kata33]'>
<input type=hidden name='kata34' value='$_POST[kata34]'>
<input type=hidden name='kata35' value='$_POST[kata35]'>
<input type=hidden name='kata36' value='$_POST[kata36]'>
<input type=hidden name='kata37' value='$_POST[kata37]'>
<input type=hidden name='kata38' value='$_POST[kata38]'>
<input type=hidden name='kata39' value='$_POST[kata39]'>
<input type=hidden name='kata40' value='$_POST[kata40]'>
<input type=hidden name='kata41' value='$_POST[kata41]'>
<input type=hidden name='kata42' value='$_POST[kata42]'>
<input type=hidden name='kata43' value='$_POST[kata43]'>
<input type=hidden name='kata44' value='$_POST[kata44]'>
<input type=hidden name='kata45' value='$_POST[kata45]'>
<input type=hidden name='kata46' value='$_POST[kata46]'>
<input type=hidden name='kata47' value='$_POST[kata47]'>
<input type=hidden name='kata48' value='$_POST[kata48]'>
<input type=hidden name='kata49' value='$_POST[kata49]'>
<input type=hidden name='kata50' value='$_POST[kata50]'>
<input type=hidden name='kata51' value='$_POST[kata51]'>
<input type=hidden name='kata52' value='$_POST[kata52]'>
<input type=hidden name='kata53' value='$_POST[kata53]'>
<input type=hidden name='kata54' value='$_POST[kata54]'>
<input type=hidden name='kata55' value='$_POST[kata55]'>
<input type=hidden name='kata56' value='$_POST[kata56]'>
<input type=hidden name='kata57' value='$_POST[kata57]'>
<input type=hidden name='kata58' value='$_POST[kata58]'>
<input type=hidden name='kata59' value='$_POST[kata59]'>
<input type=hidden name='kata60' value='$_POST[kata60]'>


<input type=submit value='Klik disini untuk Buat Sosialisasi'>
</form>";

}

?>
