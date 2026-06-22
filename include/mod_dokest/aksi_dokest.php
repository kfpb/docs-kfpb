<?php

session_start();

include "../../config/koneksi.php";

include "../../config1/library.php";

include "../../config1/fungsi_indotgl.php";

include "../../config1/class_paging.php";

include "../../config1/fungsi_thumb.php";



$module=$_GET[module];

$act=$_GET[act];





// -----------------------------------------------------------------------------Cari dan tampilkan dokumen (RDT) berdasarkan judul dan kode dokumen

if ($module=='dokest' AND $act=='caridokumen'){

$kata1 = trim($_POST[kata1]);

if ($kata1=='judul') {

 echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />



</head><body>

 

 <h2>Hasil Pencarian Dokumen Eksternal</h2>";

	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM dokumen_ekst WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= " ORDER BY no_dok ASC";

  $hasil  = mysql_query($cari);

  $ketemu = mysql_num_rows($hasil);



  if ($ketemu > 0){

   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen Eksternal dengan Judul Dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN EKSTERNAL</b></FONT><center><table>

          <tr><th>No</th><th>Nomor Dokumen</th><th>Kelompok Dokumen</th><th>Judul Dokumen</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Keterangan</th><th>Lokasi</th><th>Tgl Reg</th><th>Pengirim</th><th>Aksi</th></tr>"; 

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_reg=tgl_indo2($r[tgl_reg]);

     

       echo "<tr><td align=center>$no</td>

             <td align=center width=80>$r[no_dok]</td>

             <td align=left>$r[kel_dok]</td>

			 <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[pengarang]</td>

			 <td align=left>$r[penerbit]</td>

			 <td align=left>$r[tahun]</td>

			 <td align=left>$r[keterangan]</td>

			 <td align=left>$r[lokasi]</td>

			 <td align=left>$tgl_reg</td>

			 <td align=left>$r[pengirim]</td>";

		        

  if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){

             echo "<td align=center width=150><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok]>Detail</a> | <a  href=../../m/master_dokest/$r[kel_dok]/$r[no_dok].pdf>File</a> |<a href=../../home.php?pages=dokeks&act=editdokumen&id=$r[no_dok]>Edit</a>|<a href=?pages=dokeks&act=hapus&id=$r[no_dok]>Hapus</a></td></tr>";

			 }

			 else {

			  echo "<td align=center width=25><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok] >Detail</a> </td></tr>";

			 }

      $no++;

	   }

	      echo "</table>

<p align=center>

<center><font size=2><b><a href=../../home.php?pages=dokeks><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

		 

   

	 }

  else{

    echo "<center><font size=2>Tidak ditemukan dokumen eksternal dengan kata kunci judul : <b>$kata</b><br><b><a href=../../home.php?pages=dokeks><--Kembali</a></b>";

  }

  }

  

else {

 echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />



</head><body>

 

 <h2>Hasil Pencarian Dokumen Eksternal</h2>";

	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM dokumen_ekst WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "no_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= " ORDER BY no_dok ASC";

  $hasil  = mysql_query($cari);

  $ketemu = mysql_num_rows($hasil);



  if ($ketemu > 0){

   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen Eksternal dengan Nomor Dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN EKSTERNAL</b></FONT><center><table>

          <tr><th>No</th><th>Nomor Dokumen</th><th>Kelompok Dokumen</th><th>Judul Dokumen</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Keterangan</th><th>Lokasi</th><th>Tgl Reg</th><th>Pengirim</th><th>Aksi</th></tr>"; 

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_reg=tgl_indo2($r[tgl_reg]);

     

       echo "<tr><td align=center>$no</td>

             <td align=center width=80>$r[no_dok]</td>

             <td align=left>$r[kel_dok]</td>

			 <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[pengarang]</td>

			 <td align=left>$r[penerbit]</td>

			 <td align=left>$r[tahun]</td>

			 <td align=left>$r[keterangan]</td>

			 <td align=left>$r[lokasi]</td>

			 <td align=left>$tgl_reg</td>

			 <td align=left>$r[pengirim]</td>";

		        

  if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){

             echo "<td align=center width=150><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok]>Detail</a> | <a  href=../../m/master_dokest/$r[kel_dok]/$r[no_dok].pdf>File</a> |<a href=../../home.php?pages=dokeks&act=editdokumen&id=$r[no_dok]>Edit</a>|<a href=?pages=dokeks&act=hapus&id=$r[no_dok]>Hapus</a></td></tr>";

			 }

			 else {

			  echo "<td align=center width=25><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok] >Detail</a> </td></tr>";

			 }

      $no++;

	   }

	      echo "</table>

<p align=center>

<center><font size=2><b><a href=../../home.php?pages=dokeks><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

		 

   

	 }

  else{

    echo "<center><font size=2>Tidak ditemukan dokumen eksternal dengan kata kunci Nomor : <b>$kata</b><br><b><a href=../../home.php?pages=dokeks><--Kembali</a></b>";

  }

  

  }

  



}









// Tampilkan dokumen berdasarkan Lokasi Dokumen

elseif ($module=='dokest' AND $act=='caridokumen2'){



 echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />



</head><body>

 

 <h2>Hasil Pencarian Dokumen Eksternal</h2>";

	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM dokumen_ekst WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "lokasi LIKE '$kata'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= " ORDER BY no_dok ASC";

  $hasil  = mysql_query($cari);

  $ketemu = mysql_num_rows($hasil);



  if ($ketemu > 0){

   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen Eksternal dengan Lokasi Dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN EKSTERNAL</b></FONT><center><table>

          <tr><th>No</th><th>Nomor Dokumen</th><th>Kelompok Dokumen</th><th>Judul Dokumen</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Keterangan</th><th>Lokasi</th><th>Tgl Reg</th><th>Pengirim</th><th>Aksi</th></tr>"; 

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_reg=tgl_indo2($r[tgl_reg]);

     

       echo "<tr><td align=center>$no</td>

             <td align=center width=80>$r[no_dok]</td>

             <td align=left>$r[kel_dok]</td>

			 <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[pengarang]</td>

			 <td align=left>$r[penerbit]</td>

			 <td align=left>$r[tahun]</td>

			 <td align=left>$r[keterangan]</td>

			 <td align=left>$r[lokasi]</td>

			 <td align=left>$tgl_reg</td>

			 <td align=left>$r[pengirim]</td>";

		        

  if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){

             echo "<td align=center width=150><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok]>Detail</a> | <a  href=../../m/master_dokest/$r[kel_dok]/$r[no_dok].pdf>File</a> |<a href=../../home.php?pages=dokeks&act=editdokumen&id=$r[no_dok]>Edit</a>|<a href=?pages=dokeks&act=hapus&id=$r[no_dok]>Hapus</a></td></tr>";

			 }

			 else {

			  echo "<td align=center width=25><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok] >Detail</a> </td></tr>";

			 }

      $no++;

	   }

	      echo "</table>

<p align=center>

<center><font size=2><b><a href=../../home.php?pages=dokeks><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

		 

   

	 }

  else{

    echo "<center><font size=2>Tidak ditemukan dokumen eksternal dengan kata kunci Lokasi : <b>$kata</b><br><b><a href=../../home.php?pages=dokeks><--Kembali</a></b>";

  }

  



}





// -----------------------------------------Cari dan tampilkan dokumen berdasarkan Kelompok Dokumen

elseif ($module=='dokest' AND $act=='caridokumen3'){



 echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />



</head><body>

 

 <h2>Hasil Pencarian Dokumen Eksternal</h2>";

	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM dokumen_ekst WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kel_dok LIKE '$kata'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= " ORDER BY no_dok ASC";

  $hasil  = mysql_query($cari);

  $ketemu = mysql_num_rows($hasil);



  if ($ketemu > 0){

   echo "<p><font size=2><b>Ditemukan <b>$ketemu</b> Dokumen Eksternal dengan Kelompok Dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

 echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI DOKUMEN EKSTERNAL</b></FONT><center><table>

          <tr><th>No</th><th>Nomor Dokumen</th><th>Kelompok Dokumen</th><th>Judul Dokumen</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Keterangan</th><th>Lokasi</th><th>Tgl Reg</th><th>Pengirim</th><th>Aksi</th></tr>"; 

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_reg=tgl_indo2($r[tgl_reg]);

     

       echo "<tr><td align=center>$no</td>

             <td align=center width=80>$r[no_dok]</td>

             <td align=left>$r[kel_dok]</td>

			 <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[pengarang]</td>

			 <td align=left>$r[penerbit]</td>

			 <td align=left>$r[tahun]</td>

			 <td align=left>$r[keterangan]</td>

			 <td align=left>$r[lokasi]</td>

			 <td align=left>$tgl_reg</td>

			 <td align=left>$r[pengirim]</td>";

		        

  if ($_SESSION[leveluser]=='Admin' OR $_SESSION[levelcv]==1){

             echo "<td align=center width=150><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok]>Detail</a> | <a  href=../../m/master_dokest/$r[kel_dok]/$r[no_dok].pdf>File</a> |<a href=../../home.php?pages=dokeks&act=editdokumen&id=$r[no_dok]>Edit</a>|<a href=?pages=dokeks&act=hapus&id=$r[no_dok]>Hapus</a></td></tr>";

			 }

			 else {

			  echo "<td align=center width=25><a href=../../home.php?pages=dokeks&act=detaildokumen&id=$r[no_dok] >Detail</a> </td></tr>";

			 }

      $no++;

	   }

	      echo "</table>

<p align=center>

<center><font size=2><b><a href=../../home.php?pages=dokeks><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

		 

   

	 }

  else{

    echo "<center><font size=2>Tidak ditemukan dokumen eksternal dengan kata kunci kelompok dokumen : <b>$kata</b><br><b><a href=../../home.php?pages=dokeks><--Kembali</a></b>";

  }

  

  

}





  

// Hapus dokumen ---------------------------------------------------------------------------------------------------

elseif ($module=='dokest' AND $act=='hapus'){



echo "<p align=center><b>Apakah anda akan menghapus dokumen eksternal ini ? <br></b>

<center><a href=$aksi?pages=dokeks&act=hapus2&id=$_GET[id]>Ya !</a> - <a href=../../home.php?pages=dokeks>Tidak Jadi</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"

;

}



// Hapus dokumen 2 ---------------------------------------------------------------------------------------------------

elseif ($module=='dokest' AND $act=='hapus2'){

  mysql_query("DELETE FROM dokumen_ekst WHERE no_dok='$_GET[id]'");

  header('location:../../media.php?module='.$module);



}





// Tambah dokumen ---------------------------------------------------------------------------------------------------

elseif ($module=='dokest' AND $act=='input'){



$lihatdok = mysql_query("SELECT * FROM dokumen_ekst WHERE no_dok = '$_POST[no_dok]' ");

$lihatdok2 = mysql_num_rows($lihatdok);

if ($lihatdok2 > 0){

	 echo "<font size=6><center>Kode Dokumen Eksternal Double!, mohon dicek dahulu di registrasi dokumen eksternal! <br><img src='../../images/bagus.gif'><br><a href=../../home.php?pages=dokeks>Kembali</a></font></center>";}

	 else {

 

mysql_query("INSERT INTO dokumen_ekst (no_dok, kel_dok, judul_dok, pengarang, penerbit, tahun, keterangan, lokasi, tgl_reg, pengirim)



VALUES('$_POST[no_dok]',

								   '$_POST[kata1]',

								   '$_POST[judul_dok]',

								   '$_POST[pengarang]',

                                   '$_POST[penerbit]',

                                   '$_POST[tahun]',

                                   '$_POST[keterangan]',

                                   '$_POST[kata]',

                                   '$_POST[tgl_reg]',

                                   '$_POST[pengirim]')");

	

  

    echo "<p align=center><b>Dokumen eksternal baru telah dibuat !<br></b>

<center><a href=../../home.php?pages=dokeks>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	



}

}



// Update dokumen ----------------------------------------------------------------------------------------------------

elseif ($module=='dokest' AND $act=='update'){



mysql_query("UPDATE dokumen_ekst SET 

no_dok    = '$_POST[no_dok]',

kel_dok    = '$_POST[kata1]',

judul_dok   = '$_POST[judul_dok]',

pengarang   = '$_POST[pengarang]',

penerbit	= '$_POST[penerbit]', 

tahun	= '$_POST[tahun]',

keterangan   = '$_POST[keterangan]',

lokasi	= '$_POST[kata]',

tgl_reg	= '$_POST[tgl_reg]',

pengirim	= '$_POST[pengirim]'

WHERE no_dok   = '$_POST[no_dok]'");

  

   

   echo "<p align=center><b>Dokumen Eksternal telah di edit !<br></b>

<center><a href=../../home.php?pages=dokeks>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	

}





?>

