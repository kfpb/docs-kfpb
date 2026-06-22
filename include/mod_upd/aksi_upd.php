<?php

error_reporting (E_ALL);

ini_set ('display_errors', false);

ini_set ('html_errors', false);

session_start();

include "../../config/koneksi.php";

include "../../config1/library.php";

include "../../config1/fungsi_indotgl.php";

include "../../config1/class_paging.php";

include "../../config1/fungsi_thumb.php";





function GetCheckboxes($table, $key, $Label, $Nilai='') {

  $s = "select * from users order by cUser";

  $r = mysql_query($s);

  $_arrNilai = explode(', ', $Nilai);

  $str = '';

  while ($w = mysql_fetch_array($r)) {

    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';

    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] <br>";

  }

  return $str;

}



$module=$_GET[module];

$act=$_GET[act];

$aksi1="aksi_upd.php";





// ------------------------------------------------------------------------------------------------------------------------------Cari UPD USER

if ($module=='upd' AND $act=='cariupduser'){





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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and keterangan !='1' ORDER BY tgl_upd DESC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b></FONT><center>

<table width=1500>

          <tr><th>No</th><th>Status</th><th>Tgl Terima MR</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Uraian Usulan</th><th>Tgl Selesai Net</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	 	 	  

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

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

      $tgl_terima=tgl_indo2($r[tgl_terima]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   



	   

echo "</td><td align=left width=50>$r[status]</td>";

echo "</td><td align=left width=50>$tgl_terima</td>";   

echo "

             <td align=center width=50>$r[username]</td>

             <td align=left width=50>$r[jenis_upd]</td>

			 <td align=left width=75>$r[kode_dok]</td>

			 			 <td align=left width=10>$r[revisi]</td>

			  <td align=left width=150>$r[judul_dok]</td>

			  <td align=left width=150>$r[isi_upd]</td>

			  <form method=POST action=?module=upd&act=update2 target=_blank><input type=hidden name=id_upd value=$r[id_upd]>";

		     

echo "<td align=center width=50>";

							 if ($tgl_berlaku==0000-00-00){

echo "";

}

else {

echo "$tgl_berlaku";

}		



				    

						   echo "</td></tr>";

      $no++;

	   }

	      echo "</table>";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan kode dokumen tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





// ----------------------------------------------------------------------------------------------Cari dan tampilkan upd berdasarkan kode dokumen

if ($module=='upd' AND $act=='cariupd'){

$kata1 = trim($_POST[kata1]);

if ($kata1=='kode') {



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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan !=1 ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

<b>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</b><br><font style='background-color:#00FFFF'><b>Jika Status Pending/Follow-Up > Klik Konsep-kan dahulu !</b></FONT><center>

<table width=4650>

          <tr><th>No</th><th>Aksi</th><th>Usulan Dari</th><th>Status UPD</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th>Tgl UPD/ Terima</th><th><b>Posisi Terakhir*)</b></th><th><b>Tgl Terakhir</b></th></th><th>Kirim 1 Ke:</th><th>Tgl K1</th><th>Tgl kbl K1</th><th>Kirim 2 Ke:</th><th>Tgl K2</th><th>Tgl kbl K2</th><th>Kirim 3 Ke:</th><th>Tgl K3</th><th>Tgl kbl K3</th><th>Kirim 4 Ke:</th><th>Tgl K4</th><th>Tgl Kbl K4</th><th>Kirim 5 Ke:</th><th>Tgl K5</th><th>Tgl Kbl K5</th><th>Kirim 6 Ke:</th><th>Tgl K6</th><th>Tgl Kbl K6</th><th>Kirim 7 Ke:</th><th>Tgl K7</th><th>Tgl kbl K7</th><th>Kirim 8 Ke:</th><th>Tgl K8</th>

		  <th>Tgl kbl K8</th><th>Kirim 9 Ke:</th><th>Tgl K9</th><th>Tgl kbl K9</th><th>Kirim 10 Ke:</th><th>Tgl K10</th><th>Tgl Kbl K10</th><th>Kirim 11 Ke:</th><th>Tgl K11</th><th>Tgl Kbl K11</th><th>Kirim 12 Ke:</th><th>Tgl K12</th><th>Tgl Kbl K12</th><th>Tgl Selesai</th><th>Tgl Brlku</th><th>Tgl Dist Selesai</th><th>Aksi2</th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

          echo "<td align=left>

 <a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a> | <a href=../../home.php?pages=upd&act=netupd&id=$r[id_upd]>Klik Net</a>|<a href=?module=upd&act=hapus&id=$r[id_upd]>Hapus</a></td>

 <td align=center width=80>$r[username]</td>";

		   

if ($r[status]=='Pending') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Pending</font></td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td>

<form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir";

}

elseif ($r[status]=='Follow-Up') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Follow-up</font></td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td>

<form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir";

}

else {

echo "<td align=left width=50>$r[status]</td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

			  

			  <td align=left width=50>

			  <form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

<input type=text name='tgl_terima' size=12 value='$tgl_terima'></td>	 



			 <td align=left width=50><input type=text name='posisi' size=12 value='$r[posisi]'></td> 

<td align=center width=40>";

				 if ($tgl_terakhir==0000-00-00){

echo "<input type=text name='tgl_terakhir' size=10 value=''>

</td>";

}

else {

echo "<input type=text name='tgl_terakhir' size=10 value='$tgl_terakhir'>";

}		 

		 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

  						

echo "</td>";

 if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		

							

echo "</td><td align=center width=50>";

							 if ($tgl_selesai==0000-00-00){

echo "<input type=text name='tgl_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_selesai' size=8 value='$tgl_selesai'>";

}		

echo "</td><td align=center width=50>";

	 if ($tgl_berlaku==0000-00-00){

echo "<input type=text name='tgl_berlaku' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_berlaku' size=8 value='$tgl_berlaku'>";

}		





 if ($tgl_dist_selesai==0000-00-00){

echo "</td><td align=center width=50><input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "</td><td align=center width=50><input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

}

echo"</td><td align=left><a href=?module=upd&act=konsepupd&id=$r[id_upd] target=_blank>Konsep-kan !</a> | <a href=?module=upd&act=pendingupd&id=$r[id_upd] target=_blank>Pending</a> | <a href=?module=upd&act=followupd&id=$r[id_upd] target=_blank>Follow-Up</a></td>

											   

						   <td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>

		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan kode dokumen tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}

elseif ($kata1=='nomor') {

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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "reg_upd LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan !=1 ORDER BY reg_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan dengan No Registrasi dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

<b>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</b><br><font style='background-color:#00FFFF'><b>Jika Status Pending/Follow-Up > Klik Konsep-kan dahulu !</b></FONT><center>

<table width=6200>

          <tr><th>No</th><th>Aksi</th><th>No Reg Usulan</th><th>Usulan Dari</th><th>Status UPD</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th><b>Tgl kmbl knsp</b></th><th><b>Tgl Kirim Net 1</b><th>Tgl UPD/ Terima</th><th><b>Posisi Terakhir*)</b></th><th><b>Tgl Terakhir</b></th></th><th>Kirim 1 Ke:</th><th>Tgl K1</th><th>Tgl kbl K1</th><th>Kirim 2 Ke:</th><th>Tgl K2</th><th>Tgl kbl K2</th><th>Kirim 3 Ke:</th><th>Tgl K3</th><th>Tgl kbl K3</th><th>Kirim 4 Ke:</th><th>Tgl K4</th><th>Tgl Kbl K4</th><th>Kirim 5 Ke:</th><th>Tgl K5</th><th>Tgl Kbl K5</th><th>Kirim 6 Ke:</th><th>Tgl K6</th><th>Tgl Kbl K6</th><th>Kirim 7 Ke:</th><th>Tgl K7</th><th>Tgl kbl K7</th><th>Kirim 8 Ke:</th><th>Tgl K8</th>

		  <th>Tgl kbl K8</th><th>Kirim 9 Ke:</th><th>Tgl K9</th><th>Tgl kbl K9</th><th>Kirim 10 Ke:</th><th>Tgl K10</th><th>Tgl Kbl K10</th><th>Kirim 11 Ke:</th><th>Tgl K11</th><th>Tgl Kbl K11</th><th>Kirim 12 Ke:</th><th>Tgl K12</th><th>Tgl Kbl K12</th><th>Tgl Pending</th><th>Tgl Terima 2</th><th>Tgl Selesai</th><th>Tgl Brlku</th><th><b>Kategori Usulan</b></th><th><b>Uraian UPD</b></th><th>Tgl Dist</th><th>Tgl Dist Selesai</th><th>Tgl Tarik Selesai</th><th><b>Keterangan</b></th><th><b>Follow1ke</b></th><th><b>TglFol1</b></th><th><b>Follow2ke</b><th><b>TglFol2</b></th></th><th><b>Follow3ke</b></th><th><b>TglFol3</b></th><th>Aksi2</th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

          echo "<td align=left>

 <a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a>|<a href=../../home.php?pages=upd&act=netupd&id=$r[id_upd]>Net</a>|<a href=?module=upd&act=hapus&id=$r[id_upd]>Hapus</a></td>

 <td align=center width=80>$r[reg_upd]</td><td align=center width=80>$r[username]</td>";

		   

if ($r[status]=='Pending') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Pending</font></td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td>

<form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir";

}

elseif ($r[status]=='Follow-Up') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Follow-up</font></td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td>

<form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

		 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir";

}

else {

echo "<td align=left width=50>$r[status]</td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

			  

			  <td align=left width=50>

			  <form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <input type=text name='tgl_knsp_trkhr' size=12 value='$tgl_knsp_trkhr'></td>

			 <td align=left width=50><input type=text name='tgl_krm_net' size=12 value='$tgl_krm_net'></td>

			 <td align=left width=50><input type=text name='tgl_terima' size=12 value='$tgl_terima'></td>	 



			 <td align=left width=50><input type=text name='posisi' size=12 value='$r[posisi]'></td> 

<td align=center width=40>";

				 if ($tgl_terakhir==0000-00-00){

echo "<input type=text name='tgl_terakhir' size=10 value=''>

</td>";

}

else {

echo "<input type=text name='tgl_terakhir' size=10 value='$tgl_terakhir'>";

}		 

		 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

  						

echo "</td>";

 if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>

<td><input type=text name='tgl_pending' size=12 value='$tgl_pending'></td>  

<td align=left width=50><input type=text name='tgl_terima2' size=12 value='$tgl_terima2'>";

							

echo "</td><td align=center width=50>";

							 if ($tgl_selesai==0000-00-00){

echo "<input type=text name='tgl_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_selesai' size=8 value='$tgl_selesai'>";

}		

echo "</td><td align=center width=50>";

	 if ($tgl_berlaku==0000-00-00){

echo "<input type=text name='tgl_berlaku' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_berlaku' size=8 value='$tgl_berlaku'>";

}		



echo "</td>

<td align=left width=75><input type=text name='kat_upd' size=12 value='$r[kat_upd]'></td>

<td align=left width=75><input type=text name='isi_upd' size=12 value='$r[isi_upd]'></td>	

<td align=center width=50>";



 if ($tgl_dist==0000-00-00){

echo "<input type=text name='tgl_dist' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist' size=8 value='$tgl_dist'>";

}		

echo "</td><td align=center width=50>";

 if ($tgl_dist_selesai==0000-00-00){

echo "<input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo "</td><td align=center width=50>";

 if ($tgl_tarik_selesai==0000-00-00){

echo "<input type=text name='tgl_tarik_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_tarik_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo"</td>

<td align=left width=75><input type=text name='keterangan2' size=12 value='$r[keterangan2]'></td>

<td align=left width=50><input type=text name='follow1ke' size=12 value='$r[follow1ke]'></td>

<td align=center width=50>";

	if ($follow1==0000-00-00){

echo "<input type=text name='follow1' size=8 value=''></td>";

}

else {

echo "<input type=text name='follow1' size=8 value='$follow1'></td>

";



}	

 echo "<td align=left width=50><input type=text name='follow2ke' size=12 value='$r[follow2ke]'></td>

	     <td align=center width=50>";

		 

    if ($follow2==0000-00-00){

echo "<input type=text name='follow2' size=8 value=''></td>";

}

else {

echo "<input type=text name='follow2' size=8 value='$follow1'></td>";

}	



echo "<td align=left width=50><input type=text name='follow3ke' size=12 value='$r[follow3ke]'></td>

	     <td align=center width=50>";

	 

    if ($follow3==0000-00-00){

echo "<input type=text name='follow3' size=8 value=''>";

}

else {

echo "<input type=text name='follow3' size=8 value='$follow3'></td>";

}		 

}				   

echo"</td><td align=left><a href=?module=upd&act=konsepupd&id=$r[id_upd] target=_blank>Konsep-kan !</a> | <a href=?module=upd&act=pendingupd&id=$r[id_upd] target=_blank>Pending</a> | <a href=?module=upd&act=followupd&id=$r[id_upd] target=_blank>Follow-Up</a></td>

											   

						   <td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>



		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }



 else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan nomor registrasi dokumen tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





else {

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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "judul_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and keterangan !=1 ORDER BY tgl_upd DESC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan dengan judul dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

<b>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</b><br><font style='background-color:#00FFFF'><b>Jika Status Pending/Follow-Up > Klik Konsep-kan dahulu !</b></FONT><center>

<table width=6200>

          <tr><th>No</th><th>Aksi</th><th>Usulan Dari</th><th>Status UPD</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th><b>Tgl kmbl knsp</b></th><th><b>Tgl Kirim Net 1</b><th>Tgl UPD/ Terima</th><th><b>Posisi Terakhir*)</b></th><th><b>Tgl Terakhir</b></th></th><th>Kirim 1 Ke:</th><th>Tgl K1</th><th>Tgl kbl K1</th><th>Kirim 2 Ke:</th><th>Tgl K2</th><th>Tgl kbl K2</th><th>Kirim 3 Ke:</th><th>Tgl K3</th><th>Tgl kbl K3</th><th>Kirim 4 Ke:</th><th>Tgl K4</th><th>Tgl Kbl K4</th><th>Kirim 5 Ke:</th><th>Tgl K5</th><th>Tgl Kbl K5</th><th>Kirim 6 Ke:</th><th>Tgl K6</th><th>Tgl Kbl K6</th><th>Kirim 7 Ke:</th><th>Tgl K7</th><th>Tgl kbl K7</th><th>Kirim 8 Ke:</th><th>Tgl K8</th>

		  <th>Tgl kbl K8</th><th>Kirim 9 Ke:</th><th>Tgl K9</th><th>Tgl kbl K9</th><th>Kirim 10 Ke:</th><th>Tgl K10</th><th>Tgl Kbl K10</th><th>Kirim 11 Ke:</th><th>Tgl K11</th><th>Tgl Kbl K11</th><th>Kirim 12 Ke:</th><th>Tgl K12</th><th>Tgl Kbl K12</th><th>Tgl Pending</th><th>Tgl Terima 2</th><th>Tgl Selesai</th><th>Tgl Brlku</th><th><b>Kategori Usulan</b></th><th><b>Uraian UPD</b></th><th>Tgl Dist</th><th>Tgl Dist Selesai</th><th>Tgl Tarik Selesai</th><th><b>Keterangan</b></th><th><b>Follow1ke</b></th><th><b>TglFol1</b></th><th><b>Follow2ke</b><th><b>TglFol2</b></th></th><th><b>Follow3ke</b></th><th><b>TglFol3</b></th><th>Aksi2</th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

          echo "<td align=left>

 <a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a>|<a href=../../home.php?pages=upd&act=netupd&id=$r[id_upd]>Net</a>|<a href=?module=upd&act=hapus&id=$r[id_upd]>Hapus</a></td>

 <td align=center width=80>$r[username]</td>";

		   

if ($r[status]=='Pending') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Pending</font></td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td>

<form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

		 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir";

}

elseif ($r[status]=='Follow-Up') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Follow-up</font></td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td>

<form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

	 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir";

}

else {

echo "<td align=left width=50>$r[status]</td>

      <td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

			  

			  <td align=left width=50>

			  <form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <input type=text name='tgl_knsp_trkhr' size=12 value='$tgl_knsp_trkhr'></td>

			 <td align=left width=50><input type=text name='tgl_krm_net' size=12 value='$tgl_krm_net'></td>

			 <td align=left width=50><input type=text name='tgl_terima' size=12 value='$tgl_terima'></td>	 



			 <td align=left width=50><input type=text name='posisi' size=12 value='$r[posisi]'></td> 

<td align=center width=40>";

				 if ($tgl_terakhir==0000-00-00){

echo "<input type=text name='tgl_terakhir' size=10 value=''>

</td>";

}

else {

echo "<input type=text name='tgl_terakhir' size=10 value='$tgl_terakhir'>";

}		 

		 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

  						

echo "</td>";

 if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>

<td><input type=text name='tgl_pending' size=12 value='$tgl_pending'></td>  

<td align=left width=50><input type=text name='tgl_terima2' size=12 value='$tgl_terima2'>";

							

echo "</td><td align=center width=50>";

							 if ($tgl_selesai==0000-00-00){

echo "<input type=text name='tgl_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_selesai' size=8 value='$tgl_selesai'>";

}		

echo "</td><td align=center width=50>";

	 if ($tgl_berlaku==0000-00-00){

echo "<input type=text name='tgl_berlaku' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_berlaku' size=8 value='$tgl_berlaku'>";

}		



echo "</td>

<td align=left width=75><input type=text name='kat_upd' size=12 value='$r[kat_upd]'></td>

<td align=left width=75><input type=text name='isi_upd' size=12 value='$r[isi_upd]'></td>	

<td align=center width=50>";



 if ($tgl_dist==0000-00-00){

echo "<input type=text name='tgl_dist' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist' size=8 value='$tgl_dist'>";

}		

echo "</td><td align=center width=50>";

 if ($tgl_dist_selesai==0000-00-00){

echo "<input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo "</td><td align=center width=50>";

 if ($tgl_tarik_selesai==0000-00-00){

echo "<input type=text name='tgl_tarik_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_tarik_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo"</td>

<td align=left width=75><input type=text name='keterangan2' size=12 value='$r[keterangan2]'></td>

<td align=left width=50><input type=text name='follow1ke' size=12 value='$r[follow1ke]'></td>

<td align=center width=50>";

	if ($follow1==0000-00-00){

echo "<input type=text name='follow1' size=8 value=''></td>";

}

else {

echo "<input type=text name='follow1' size=8 value='$follow1'></td>

";



}	

 echo "<td align=left width=50><input type=text name='follow2ke' size=12 value='$r[follow2ke]'></td>

	     <td align=center width=50>";

		 

    if ($follow2==0000-00-00){

echo "<input type=text name='follow2' size=8 value=''></td>";

}

else {

echo "<input type=text name='follow2' size=8 value='$follow1'></td>";

}	



echo "<td align=left width=50><input type=text name='follow3ke' size=12 value='$r[follow3ke]'></td>

	     <td align=center width=50>";

	 

    if ($follow3==0000-00-00){

echo "<input type=text name='follow3' size=8 value=''>";

}

else {

echo "<input type=text name='follow3' size=8 value='$follow3'></td>";

}		 

}				   

echo"</td><td align=left><a href=?module=upd&act=konsepupd&id=$r[id_upd] target=_blank>Konsep-kan !</a> | <a href=?module=upd&act=pendingupd&id=$r[id_upd] target=_blank>Pending</a> | <a href=?module=upd&act=followupd&id=$r[id_upd] target=_blank>Follow-Up</a></td>

											   

						   <td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>



		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }



  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan judul tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}

}









elseif ($module=='upd' AND $act=='cariupd4'){

$kata1 = trim($_POST[kata1]);

if ($kata1=='lengkap') {

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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND status !='Net' and status !='Tidak Jadi'  ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Konsep Usulan dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

<b>*) Tambahkan titik(.) untuk PM., MP., AMS., SS., SPK., SPKK., SKB., SP., SIA., MR.</b><br><font style='background-color:#00FFFF'><b>Jika Status Pending/Follow-Up > Klik Konsep-kan dahulu !</b></FONT><center>

<table width=4400>

          <tr><th>No</th><th>Status UPD</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th>Tgl Usulan</th><th><b>Posisi Terakhir*)</b></th><th><b>Tgl Terakhir</b></th></th><th>Kirim 1 Ke:</th><th>Tgl K1</th><th>Tgl kbl K1</th><th>Kirim 2 Ke:</th><th>Tgl K2</th><th>Tgl kbl K2</th><th>Kirim 3 Ke:</th><th>Tgl K3</th><th>Tgl kbl K3</th><th>Kirim 4 Ke:</th><th>Tgl K4</th><th>Tgl Kbl K4</th><th>Kirim 5 Ke:</th><th>Tgl K5</th><th>Tgl Kbl K5</th><th>Kirim 6 Ke:</th><th>Tgl K6</th><th>Tgl Kbl K6</th><th>Kirim 7 Ke:</th><th>Tgl K7</th><th>Tgl kbl K7</th><th>Kirim 8 Ke:</th><th>Tgl K8</th>

		  <th>Tgl kbl K8</th><th>Kirim 9 Ke:</th><th>Tgl K9</th><th>Tgl kbl K9</th><th>Kirim 10 Ke:</th><th>Tgl K10</th><th>Tgl Kbl K10</th><th>Kirim 11 Ke:</th><th>Tgl K11</th><th>Tgl Kbl K11</th><th>Kirim 12 Ke:</th><th>Tgl K12</th><th>Tgl Kbl K12</th><th><b>Keterangan</b></th><th>Aksi</th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

if ($r[status]=='Pending') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Pending</font></td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

<form method=POST name='cariupd' action=?module=upd&act=update6 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <td>$r[tgl_terima]</td>

			 <td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir</td>";

}

elseif ($r[status]=='Follow-Up') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Follow-up</font></td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

<form method=POST name='cariupd' action=?module=upd&act=update6 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			<td>$r[tgl_terima]</td>

			<td>$r[posisi]</td>

			 <td align=left width=50>$tgl_terakhir</td>";

}

else {

echo "<td align=left width=50>$r[status]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

			  

			 

			  <form method=POST name='cariupd' action=?module=upd&act=update6 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 			 <td align=left width=50><input type=text name='tgl_terima' size=12 value='$r[tgl_terima]'></td>

						  <td align=left width=50><input type=text name='posisi' size=12 value='$r[posisi]'></td> 

<td align=center width=40>";

				 if ($tgl_terakhir==0000-00-00){

echo "<input type=text name='tgl_terakhir' size=10 value=''>

</td>";

}

else {

echo "<input type=text name='tgl_terakhir' size=10 value='$tgl_terakhir'>";

}		 

		 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

  						

echo "</td>";

 if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>";

							

echo "<td><input type=text name='keterangan2' size=8 value='$r[keterangan2]'></td>



";

	   



}		

  

echo"<td align=left><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a> | <a href=../../home.php?pages=upd&act=netupd&id=$r[id_upd]>Klik Net</a> |<a href=?module=upd&act=hapus&id=$r[id_upd]>Hapus</a> | <a href=?module=upd&act=konsepupd&id=$r[id_upd] target=_blank>Konsep-kan !</a> | <a href=?module=upd&act=pendingupd&id=$r[id_upd] target=_blank>Pending</a> | <a href=?module=upd&act=followupd&id=$r[id_upd] target=_blank>Follow-Up</a></td>

											   

						   <td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>

		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan kode dokumen <b>$kata</b><br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }

}



elseif ($kata1=='kembali') {

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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND status !='Net' and status !='Tidak Jadi'  ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Konsep Usulan dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

<b>*) Jika konsep kembali untuk di print net/ tidak ada koreksi, tolong klik dulu tombol konsep terakhir !</b><br><font style='background-color:#00FFFF'><b>Jika Status Pending/Follow-Up > Klik Konsep-kan dahulu !</b></FONT><center>

<table width=2500>

          <tr><th>No</th><th>Status UPD</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th>Tgl kbl K1</th><th>Tgl kbl K2</th><th>Tgl kbl K3</th><th>Tgl Kbl K4</th><th>Tgl Kbl K5</th><th>Tgl Kbl K6</th><th>Tgl kbl K7</th>

		  <th>Tgl kbl K8</th><th>Tgl kbl K9</th><th>Tgl Kbl K10</th><th>Tgl Kbl K11</th><th>Tgl Kbl K12</th><th><b>Keterangan</b></th><th>Aksi</th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	    $tgl_sekarang = date("Y-m-d");

		

       echo "<tr><td width=30 align=center>$no</td>";

	   

if ($r[status]=='Pending') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Pending</font></td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";

}

elseif ($r[status]=='Follow-Up') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Follow-up</font></td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";

}

else {

echo "<td align=left width=50>$r[status]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>";

				

echo "<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00 OR $tgl_kbl_k1=='') {

echo "<form method=POST action=?module=upd&act=kbl1upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 1'></form>";

}

else {

echo "$tgl_kbl_k1";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00 OR $tgl_kbl_k2==''){

echo "<form method=POST action=?module=upd&act=kbl2upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 2'></form>";

}

else {

echo "$tgl_kbl_k2";

}		  

echo "</td>";

 echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00 OR $tgl_kbl_k3==''){

echo "<form method=POST action=?module=upd&act=kbl3upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 3'></form>";

}

else {

echo "$tgl_kbl_k3";

}

  						

echo "</td>";      

echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00 OR $tgl_kbl_n1==''){

echo "<form method=POST action=?module=upd&act=kbl4upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 4'></form>";

}

else {

echo "$tgl_kbl_n1";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00 OR $tgl_kbl_n2==''){

echo "<form method=POST action=?module=upd&act=kbl5upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 5'></form>";

}

else {

echo "$tgl_kbl_n2";

}	

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00 OR $tgl_kbl_n3==''){

echo "<form method=POST action=?module=upd&act=kbl6upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 6'></form>";

}

else {

echo "$tgl_kbl_n3";

}			

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00 OR $tgl_kbl_k4==''){

echo "<form method=POST action=?module=upd&act=kbl7upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 7'></form>";

}

else {

echo "$tgl_kbl_k4";

}		  

echo "</td>";



echo "<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00 OR $tgl_kbl_k5==''){

echo "<form method=POST action=?module=upd&act=kbl8upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 8'></form>";

}

else {

echo "$tgl_kbl_k5";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00 OR $tgl_kbl_k6==''){

echo "<form method=POST action=?module=upd&act=kbl9upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 9'></form>";

}

else {

echo "$tgl_kbl_k6";

}					

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00 OR $tgl_kbl_n4==''){

echo "<form method=POST action=?module=upd&act=kbl10upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 10'></form>";

}

else {

echo "$tgl_kbl_n4";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00 OR $tgl_kbl_n5==''){

echo "<form method=POST action=?module=upd&act=kbl11upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 11'></form>";

}

else {

echo "$tgl_kbl_n5";

}	

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00 OR $tgl_kbl_n6==''){

echo "<form method=POST action=?module=upd&act=kbl12upd><input type=hidden name=id_upd value=$r[id_upd]><input type=submit value='Kembali ke SPD 12'></form>";

}

else {

echo "$tgl_kbl_n6";

}		



echo "</td>";

							

echo "<td><form method=POST name='cariupd' action=?module=upd&act=update2 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

<input type=text name='keterangan' size=15 value='$r[keterangan]'></td>";

	   

}		

  

echo"<td align=left><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a> | <a href=../../home.php?pages=upd&act=netupd&id=$r[id_upd]>Klik Net</a> | <a href=?module=upd&act=hapus&id=$r[id_upd]>Hapus</a> | <a href=?module=upd&act=konsepupd&id=$r[id_upd] target=_blank>Konsep-kan !</a> | <a href=?module=upd&act=pendingupd&id=$r[id_upd] target=_blank>Pending</a> | <a href=?module=upd&act=followupd&id=$r[id_upd] target=_blank>Follow-Up</a></td>

											   

						   <td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>

		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan kode dokumen <b>$kata</b><br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





elseif ($kata1=='kirim')  {

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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND status !='Net' and status !='Tidak Jadi'  ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Konsep Usulan dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

<b>*) Jika kirim Print Net pertama kali, klik dahulu PRINT NET PERTAMA !</b><br><font style='background-color:#00FFFF'><b>Jika Status Pending/Follow-Up > Klik Konsep-kan dahulu !</b></FONT><center>

<table width=2500>

          <tr><th>No</th><th>Status UPD</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th>Tgl Krm K1</th><th>Tgl Krm K2</th><th>Tgl Krm K3</th><th>Tgl Krm K4</th><th>Tgl Krm K5</th><th>Tgl Krm K6</th><th>Tgl Krm K7</th>

		  <th>Tgl Krm K8</th><th>Tgl Krm K9</th><th>Tgl Krm K10</th><th>Tgl Krm K11</th><th>Tgl Krm K12</th></tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	  $tgl_sekarang = date("Y-m-d");

		

       echo "<tr><td width=30 align=center>$no</td>";

	   

if ($r[status]=='Pending') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Pending</font></td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]

	  

	  </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";

}

elseif ($r[status]=='Follow-Up') {

echo "<td align=left width=50><font style='background-color:#00FFFF'>Follow-up</font></td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";

}

else {

echo "<td align=left width=50>$r[status]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>";

		 

				

echo "<td align=center width=50>";

				 if ($tgl_konsep1==0000-00-00 OR $tgl_konsep1=='') {

echo "<form method=POST action=?module=upd&act=krm1upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Robi' >Robi I.</option><option value='Wulan' >Wulan S.N</option></select>

<select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 1'></form>";

}

else {

echo "$tgl_konsep1";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_konsep2==0000-00-00 OR $tgl_konsep2==''){

echo "<form method=POST action=?module=upd&act=krm2upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Robi' >Robi I.</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 2'></form>";

}

else {

echo "$tgl_konsep2";

}		  

echo "</td>";

 echo "<td align=center width=50>";

				 if ($tgl_konsep3==0000-00-00 OR $tgl_konsep3==''){

echo "<form method=POST action=?module=upd&act=krm3upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 3'></form>";

}

else {

echo "$tgl_konsep3";

}

  						

echo "</td>";      

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00 OR $tgl_net1==''){

echo "<form method=POST action=?module=upd&act=krm4upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 4'></form>";

}

else {

echo "$tgl_net1";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_net2==0000-00-00 OR $tgl_net2==''){

echo "<form method=POST action=?module=upd&act=krm5upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 5'></form>";

}

else {

echo "$tgl_net2";

}	

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_net3==0000-00-00 OR $tgl_net3==''){

echo "<form method=POST action=?module=upd&act=krm6upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 6'></form>";

}

else {

echo "$tgl_net3";

}			

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00 OR $tgl_konsep4==''){

echo "<form method=POST action=?module=upd&act=krm7upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 7'></form>";

}

else {

echo "$tgl_konsep4";

}		  

echo "</td>";



echo "<td align=center width=50>";

				 if ($tgl_konsep5==0000-00-00 OR $tgl_konsep5==''){

echo "<form method=POST action=?module=upd&act=krm8upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 8'></form>";

}

else {

echo "$tgl_konsep5";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_konsep6==0000-00-00 OR $tgl_konsep6==''){

echo "<form method=POST action=?module=upd&act=krm9upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 9'></form>";

}

else {

echo "$tgl_konsep6";

}					

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00 OR $tgl_net4==''){

echo "<form method=POST action=?module=upd&act=krm10upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih PPD</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Yudi' >Yudi SR</option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 10'></form>";

}

else {

echo "$tgl_net4";

}		  

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_net5==0000-00-00 OR $tgl_net5==''){

echo "<form method=POST action=?module=upd&act=krm11upd><input type=hidden name=id_upd value=$r[id_upd]>

 <select name='kata2'><option value='' selected>Pilih User PD</option><option value='Firman'>Firman</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option><option value='Wulan' >Wulan S.N</option></select>

            <select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 11'></form>";

}

else {

echo "$tgl_net5";

}	

echo "</td>";

echo "<td align=center width=50>";

				 if ($tgl_net6==0000-00-00 OR $tgl_net6==''){

echo "<form method=POST action=?module=upd&act=krm12upd><input type=hidden name=id_upd value=$r[id_upd]>

            <select name='kata2'><option value='' selected>Pilih User PD</option><option value='Firman'>Firman</option><option value='Usep'>Usep S.</option><option value='Ikhsan' >Ikhsan A.</option><option value='Wulan' >Wulan S.N</option></select>

			<select name='kata'><option value='(K)' selected>Konsep</option><option value='(KN)' selected>Konsep Koreksi di Net</option><option value='(N)' >Net</option><option value='(NK)' >Net ada koreksi</option></select>

			<select name='kata1'>

            <option value=0 selected>- Pilih Penerima Dokumen -</option>";

			

            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");

            while($r=mysql_fetch_array($tampil)){

              echo "<option value='$r[cchl]'>$r[cchl]</option>";

            }

            echo "</select><input type=submit value='Kirim 12'></form>";

}

else {

echo "$tgl_net6";

}		



echo "</td>";

							



}		

  echo " </tr>";

						   

      $no++;

	   }

	      echo "</table>

		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan kode dokumen <b>$kata</b><br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





else {

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

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "kode_dok LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND status ='Net' ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan untuk di entry hasil distribusi  & penarikan dengan kode dokumen <font style='background-color:#00FFFF'><b>$kata</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br><center>

<table width=1300>

          <tr><th>No</th><th>Status UPD</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th>ket</th><th>Tgl Usulan</th><th>Tgl Selesai</th><th>Tgl Berlaku</th><th><b>Tgl Selesai Dist</b></th><th><b>Tgl Selesai Tarik</b></th><th>Aksi</th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	    $tgl_sekarang = date("Y-m-d");

		

       echo "<tr><td width=30 align=center>$no</td>";

	   echo "<td align=left width=50>$r[status]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

	  <td align=left>";

	  if ($r[keterangan]==1){

echo "Temp";

}

else {

echo "Normal";

}		

	  

	  echo"

	  </td>

	  <td align=center>$tgl_terima</td><td align=center>$tgl_selesai</td><td align=center>$tgl_berlaku</td><form method=POST name='distupd' action=?module=upd&act=update212 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>";

	

echo "<td align=center width=50>";

 if ($tgl_dist_selesai==0000-00-00){

echo "<input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo "</td>";



echo "<td align=center width=50>";

 if ($tgl_tarik_selesai==0000-00-00){

echo "<input type=text name='tgl_tarik_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_tarik_selesai' size=8 value='$tgl_tarik_selesai'>";

}		

echo "</td>";





  

echo"<td align=left><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a> | <a href=?module=upd&act=hapus&id=$r[id_upd]>Hapus</a></td>

											   

						   <td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>

		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dengan kode dokumen <b>$kata</b><br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





}







elseif ($module=='upd' AND $act=='cariupd5'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata2.$kata.-$kata1);

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$gabung);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "reg_upd LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "ORDER BY tgl_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>bulan : $kata tahun :  $kata1</b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=1500>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Status</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Kat. Usulan</th><th>Tgl terima MR</th>

<th>Tgl Konsep 1</th><th>Tgl Kmbl Knsp Terakhir</th><th>Tgl krm net 1</th><th>Edit</th><tr>"; 

		  

		     

  	     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

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

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]);	  

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			              <td align=left width=30>$r[status]</td>

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[kat_upd]</td>";

echo "</td><td align=left width=30>$tgl_terima</td> 

<td align=center width=30>$tgl_konsep1</td>

<td align=center width=30>$tgl_knsp_trkhr</td>

<td align=center width=30>$tgl_krm_net</td>

<td align=center width=30><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd] target=_blank>Edit</a></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan dan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd55'){



	 // menghilangkan spasi di kiri dan kanannya

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

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata2);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_berlaku LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= " ORDER BY tgl_berlaku DESC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>bulan : $kata tahun :  $kata1</b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN YANG TELAH DISAHKAN</b></FONT><center>

<table width=1000>

          <tr><th>No</th><th>Tgl terima MR</th><th>Tgl Berlaku</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th></tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_konsep1=tgl_indo2($r[tgl_konsep1]);

	  $tgl_kbl_k1=tgl_indo3($r[tgl_kbl_k1]);

	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);

	  $tgl_kbl_k2=tgl_indo3($r[tgl_kbl_k2]);

	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);

	  $tgl_kbl_k3=tgl_indo3($r[tgl_kbl_k3]);

	  $tgl_net1=tgl_indo2($r[tgl_net1]);

	  $tgl_kbl_n1=tgl_indo3($r[tgl_kbl_n1]);

	  $tgl_net2=tgl_indo3($r[tgl_net2]);

	  $tgl_kbl_n2=tgl_indo3($r[tgl_kbl_n2]);

	  $tgl_net3=tgl_indo3($r[tgl_net3]);

	  $tgl_kbl_n3=tgl_indo3($r[tgl_kbl_n3]);

	  	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]);	  

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

      $tgl_terima=tgl_indo2($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





  	  

       echo "<tr><td width=10 align=center>$no</td>"; 

echo "<td align=left width=30>$tgl_terima</td>";   

echo "<td align=center width=30>$tgl_berlaku</td>

             <td align=center width=30>$r[username]</td>

             <td align=left width=30>$r[jenis_upd]</td>

			 <td align=left width=55>$r[kode_dok]</td>

			 			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>";

			  echo "</td></tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan dan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }





}









elseif ($module=='upd' AND $act=='cariupd59'){



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

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata1);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_berlaku LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and id_jendok ='$kata' and keterangan !='1'  ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>JenisDokumen : $kata </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=1000>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Status</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Kat. Usulan</th><th>Isi Usulan</th><th>Tgl terima MR</th><th>Tgl Berlaku</th><th>Detail</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	  $tgl_konsep1=tgl_indo2($r[tgl_konsep1]);

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

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);

	 	  

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

          $tgl_terima=tgl_indo2($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username]</td>

             <td align=left width=30>$r[jenis_upd]</td>

			              <td align=left width=30>$r[status]</td>

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			  <td align=left>$r[kat_upd]</td>

			  <td align=left>$r[isi_upd]</td>";

echo "</td><td align=left width=30>$tgl_terima</td>

<td align=center width=30>$tgl_berlaku</td>

<td align=left width=50><a href=../../home.php?pages=upd&act=detailupd&id=$r[id_upd]>Detail</a></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd57'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "posisi LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and status !='net' ORDER BY kode_dok ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>masih di posisi : $kata </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=1000>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Status</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Tgl terima MR</th><th>Posisi Terakhir</th><th>Tgl Terakhir</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

 	  

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_terakhir=tgl_indo2($r[tgl_terakhir]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

          $tgl_terima=tgl_indo2($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





  	  

       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username]</td>

             <td align=left width=30>$r[jenis_upd]</td>

			              <td align=left width=30>$r[status]</td>

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>";

echo "</td><td align=left width=30>$tgl_terima</td> 

<td align=left width=30>$r[posisi]</td>

<td align=left width=30>$tgl_terakhir</td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada posisi tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd57a'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  $kata2 = trim($_POST[kata2]);

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "username LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and keterangan !='1' and reg_upd LIKE '%$kata2%' ORDER BY reg_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>pengusul : $kata tahun : $kata2 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=1000>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Status</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Tgl terima MR</th><th>Tgl Berlaku</th><th>Edit</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

 	  

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_terakhir=tgl_indo2($r[tgl_terakhir]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

          $tgl_terima=tgl_indo2($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





  	  

       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username]</td>

             <td align=left width=30>$r[jenis_upd]</td>

			              <td align=left width=30>$r[status]</td>

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>";

echo "</td><td align=left width=30>$tgl_terima</td> 

<td align=left width=30>$tgl_berlaku</td>

<td align=center width=30><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan dokumen<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd58'){



	 // menghilangkan spasi di kiri dan kanannya

 $kata = trim($_POST[kata]);

$kata1 = trim($_POST[kata1]);

$kata2 = ($kata1.$kata);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata2);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_selesai LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' and status ='net' ORDER BY tgl_selesai ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

include "selisih.php";

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata2 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=2500>

         <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>No Reg</th><th>Tgl Terima SPD</th>

<th>Kirim 1 ke</th><th>Tgl Kirim 1</th><th>Selisih</th><th>Selisih1</th><th>Tgl Kmbl K1</th><th>Kirim 2 ke</th><th>Tgl kirim 2</th><th>Selisih</th><th>Selisih2</th><th>Tgl Kmbl K2</th><th>Kirim 3 ke</th><th>Tgl kirim 3</th><th>Selisih</th><th>Selisih3</th><th>Tgl Kmbl K3</th><th>Kirim 4 ke</th>

<th>Tgl kirim 4</th><th>Selisih</th><th>Selisih4</th><th>Tgl Kmbl K4</th><th>Kirim 5 ke</th><th>Tgl kirim 5</th><th>Selisih</th><th>Selisih5</th><th>Tgl Kmbl K5</th><th>Kirim 6 ke</th><th>Tgl kirim 6</th><th>Selisih</th><th>Selisih6</th><th>Tgl Kmbl K6</th>

<th>Kirim 7 ke</th><th>Tgl Kirim 7</th><th>Selisih</th><th>Selisih7</th><th>Tgl Kmbl K7</th><th>Kirim 8 ke</th><th>Tgl kirim 8</th><th>Selisih</th><th>Selisih8</th><th>Tgl Kmbl K8</th><th>Kirim 9 ke</th><th>Tgl kembali 9</th><th>Selisih</th><th>Selisih9</th><th>Tgl Kmbl K9</th><th>Kirim 10 ke</th>

<th>Tgl kirim 10</th><th>Selisih</th><th>Selisih10</th><th>Tgl Kmbl K10</th><th>Kirim 11 ke</th><th>Tgl kirim 11</th><th>Selisih</th><th>Selisih11</th><th>Tgl Kmbl K11</th><th>Kirim 12 ke</th><th>Tgl kirim 12</th><th>Selisih</th><th>Selisih12</th><th>Tgl Kmbl K12</th>

<th>Tgl Selesai</th><th>Tgl Berlaku</th><th>Total Hari</th><th>Target Total Hari</th><th>Tgl Selesai Dist</th><th>Selisih Total Dist</th><th>Target Dist</th><th>Tgl Selesai Tarik</th><th>Selisih Total Tarik</th><th>Target Tarik</th><th>Selisih Total SPD</th><th>Target SPD All</th><th>Edit</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





	  if ($r[tgl_terima]=='' or $r[tgl_terima]==0000-00-00 or $r[tgl_konsep1]=='' or $r[tgl_konsep1]==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($r[tgl_terima], $r[tgl_konsep1]); }

	  if ($r[tgl_kbl_k1]=='' or $r[tgl_kbl_k1]==0000-00-00 or $r[tgl_konsep2]=='' or $r[tgl_konsep2]==0000-00-00)

{     $selisih2="-"; } else

{	  $selisih2= selisihHari($r[tgl_kbl_k1], $r[tgl_konsep2]); }

	  if ($r[tgl_kbl_k2]=='' or $r[tgl_kbl_k2]==0000-00-00 or $r[tgl_konsep3]=='' or $r[tgl_konsep3]==0000-00-00)

{     $selisih3="-"; } else

{	  $selisih3= selisihHari($r[tgl_kbl_k2], $r[tgl_konsep3]); }

	  if ($r[tgl_kbl_k3]=='' or $r[tgl_kbl_k3]==0000-00-00 or $r[tgl_net1]=='' or $r[tgl_net1]==0000-00-00)  	

{     $selisih4="-"; } else

{	  $selisih4= selisihHari($r[tgl_kbl_k3], $r[tgl_net1]); }

	  if ($r[tgl_kbl_n1]=='' or $r[tgl_kbl_n1]==0000-00-00 or $r[tgl_net2]=='' or $r[tgl_net2]==0000-00-00)  	

{     $selisih5="-"; } else

{	  $selisih5= selisihHari($r[tgl_kbl_n1], $r[tgl_net2]); }

	  if ($r[tgl_kbl_n2]=='' or $r[tgl_kbl_n2]==0000-00-00 or $r[tgl_net3]=='' or $r[tgl_net3]==0000-00-00)  	

{     $selisih6="-"; } else

{	  $selisih6= selisihHari($r[tgl_kbl_n2], $r[tgl_net3]); }



	  if ($r[tgl_kbl_n3]=='' or $r[tgl_kbl_n3]==0000-00-00 or $r[tgl_konsep4]=='' or $r[tgl_konsep4]==0000-00-00) 

{     $selisih7="-"; } else

{	  $selisih7= selisihHari($r[tgl_kbl_n3], $r[tgl_konsep4]); }

	  if ($r[tgl_kbl_k4]=='' or $r[tgl_kbl_k4]==0000-00-00 or $r[tgl_konsep5]=='' or $r[tgl_konsep5]==0000-00-00)

{     $selisih8="-"; } else

{	  $selisih8= selisihHari($r[tgl_kbl_k4], $r[tgl_konsep5]); }

	  if ($r[tgl_kbl_k5]=='' or $r[tgl_kbl_k5]==0000-00-00 or $r[tgl_konsep6]=='' or $r[tgl_konsep6]==0000-00-00)

{     $selisih9="-"; } else

{	  $selisih9= selisihHari($r[tgl_kbl_k5], $r[tgl_konsep6]); }

	  if ($r[tgl_kbl_k6]=='' or $r[tgl_kbl_k6]==0000-00-00 or $r[tgl_net4]=='' or $r[tgl_net4]==0000-00-00)  	

{     $selisih10="-"; } else

{	  $selisih10= selisihHari($r[tgl_kbl_k6], $r[tgl_net4]); }

	  if ($r[tgl_kbl_n4]=='' or $r[tgl_kbl_n4]==0000-00-00 or $r[tgl_net5]=='' or $r[tgl_net5]==0000-00-00)  	

{     $selisih11="-"; } else

{	  $selisih11= selisihHari($r[tgl_kbl_n4], $r[tgl_net5]); }

	  if ($r[tgl_kbl_n5]=='' or $r[tgl_kbl_n5]==0000-00-00 or $r[tgl_net6]=='' or $r[tgl_net6]==0000-00-00)  	

{     $selisih12="-"; } else

{	  $selisih12= selisihHari($r[tgl_kbl_n5], $r[tgl_net6]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00)  	

{     $selisih13="-"; } else

{	  $selisih13= selisihHari($r[tgl_selesai], $r[tgl_dist_selesai]); }





if ($r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih14="-"; } else

{	  $selisih14= selisihHari($r[tgl_dist_selesai], $r[tgl_tarik_selesai]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih15="-"; } else

{	  $selisih15= selisihHari($r[tgl_terima], $r[tgl_tarik_selesai]); }





	  $tots=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12;

      $tots1=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12+$selisih13;

	  

       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[reg_upd]</td>";

echo "<td align=left width=30>$r[tgl_terima]</td> 

<td align=left width=30>$r[konsep1_krm]</td>

<td align=center width=30>$r[tgl_konsep1]</td>



<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2") { echo 0; }elseif ($selisih=="3") { echo 0; }

echo"</td>



<td align=center width=30>$r[tgl_kbl_k1]</td>

<td align=left width=30>$r[konsep2_krm]</td>

<td align=center width=30>$tgl_konsep2</td>

<td align=center>$selisih2</td>

<td align=center>";

if ($selisih2>3){ echo 1; } elseif ($selisih2=="0") { echo 0; } elseif ($selisih2=="1") { echo 0; } elseif ($selisih2=="2") { echo 0; }elseif ($selisih2=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k2</td>

<td align=left width=30>$r[konsep3_krm]</td>

<td align=center width=30>$tgl_konsep3</td>

<td align=center>$selisih3</td>

<td align=center>";

if ($selisih3>3){ echo 1; } elseif ($selisih3=="0") { echo 0; } elseif ($selisih3=="1") { echo 0; } elseif ($selisih3=="2") { echo 0; } elseif ($selisih3=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k3</td>

<td align=left width=30>$r[net1_krm]</td>

<td align=center width=30>$tgl_net1</td>

<td align=center>$selisih4</td>

<td align=center>";

if ($selisih4>3){ echo 1; } elseif ($selisih4=="0") { echo 0; } elseif ($selisih4=="1") { echo 0; } elseif ($selisih4=="2") { echo 0; } elseif ($selisih4=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n1</td>

<td align=left width=30>$r[net2_krm]</td>

<td align=center width=30>$tgl_net2</td>

<td align=center>$selisih5</td>

<td align=center>";

if ($selisih5>3){ echo 1; } elseif ($selisih5=="0") { echo 0; } elseif ($selisih5=="1") { echo 0; } elseif ($selisih5=="2") { echo 0; } elseif ($selisih5=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n2</td>

<td align=left width=30>$r[net3_krm]</td>

<td align=center width=30>$tgl_net3</td>

<td align=center>$selisih6</td>

<td align=center>";

if ($selisih6>3){ echo 1; } elseif ($selisih6=="0") { echo 0; } elseif ($selisih6=="1") { echo 0; } elseif ($selisih6=="2") { echo 0; } elseif ($selisih6=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n3</td>

<td align=left width=30>$r[konsep4_krm]</td>

<td align=center width=30>$r[tgl_konsep4]</td>

<td align=center>$selisih7</td>

<td align=center>";

if ($selisih7>3){ echo 1; } elseif ($selisih7=="0") { echo 0; } elseif ($selisih7=="1") { echo 0; } elseif ($selisih7=="2") { echo 0; } elseif ($selisih7=="3") { echo 0; }

echo"</td>

<td align=center width=30>$r[tgl_kbl_k4]</td>

<td align=left width=30>$r[konsep5_krm]</td>

<td align=center width=30>$tgl_konsep5</td>

<td align=center>$selisih8</td>

<td align=center>";

if ($selisih8>3){ echo 1; } elseif ($selisih8=="0") { echo 0; } elseif ($selisih8=="1") { echo 0; } elseif ($selisih8=="2") { echo 0; } elseif ($selisih8=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k5</td>

<td align=left width=30>$r[konsep6_krm]</td>

<td align=center width=30>$tgl_konsep6</td>

<td align=center>$selisih9</td>

<td align=center>";

if ($selisih9>3){ echo 1; } elseif ($selisih9=="0") { echo 0; } elseif ($selisih9=="1") { echo 0; } elseif ($selisih9=="2") { echo 0; } elseif ($selisih9=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k6</td>

<td align=left width=30>$r[net4_krm]</td>

<td align=center width=30>$tgl_net4</td>

<td align=center>$selisih10</td>

<td align=center>";

if ($selisih10>3){ echo 1; } elseif ($selisih10=="0") { echo 0; } elseif ($selisih10=="1") { echo 0; } elseif ($selisih10=="2") { echo 0; } elseif ($selisih10=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n4</td>

<td align=left width=30>$r[net5_krm]</td>

<td align=center width=30>$tgl_net5</td>

<td align=center>$selisih11</td>

<td align=center>";

if ($selisih11>3){ echo 1; } elseif ($selisih11=="0") { echo 0; } elseif ($selisih11=="1") { echo 0; } elseif ($selisih11=="2") { echo 0; }elseif ($selisih11=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n5</td>

<td align=left width=30>$r[net6_krm]</td>

<td align=center width=30>$tgl_net6</td>

<td align=center>$selisih12</td>

<td align=center>";

if ($selisih12>3){ echo 1; } elseif ($selisih12=="0") { echo 0; } elseif ($selisih12=="1") { echo 0; } elseif ($selisih12=="2") { echo 0; } elseif ($selisih12=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n6</td>

<td align=center width=30>$tgl_selesai</td>

<td align=center width=30>$tgl_berlaku</td>

<td align=center width=30>$tots</td>

<td align=center>";

if ($tots>14){ echo 1; } else { echo 0; } 

echo"</td>

<td align=center width=30>$r[tgl_dist_selesai]</td>

<td align=center width=30>$selisih13</td>

<td align=center>";

if ($selisih13>3){ echo 1; } elseif ($selisih13=="0") { echo 0; } elseif ($selisih13=="1") { echo 0; } elseif ($selisih13=="2") { echo 0; } elseif ($selisih13=="3") { echo 0; } 

echo"</td>

<td align=center width=30>$r[tgl_tarik_selesai]</td>

<td align=center width=30>$selisih14</td>

<td align=center>";

if ($selisih14>5){ echo 1; } else{ echo 0; } 

echo"</td>

<td align=center width=30>$tots1</td>

<td align=center>";

if ($tots1>20){ echo 1; } else{ echo 0; } 

echo"</td>

<td align=center width=30><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a>|<a href=?module=upd&act=tempupd&id=$r[id_upd] target=_blank>Temp</a></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";









echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





elseif ($module=='upd' AND $act=='cariupd680'){



	 // menghilangkan spasi di kiri dan kanannya

 $kata = trim($_POST[kata]);

$kata1 = trim($_POST[kata1]);

$kata2 = ($kata1.$kata);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata2);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_berlaku LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' and status ='net' ORDER BY tgl_selesai ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

include "selisih.php";

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata2 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=2500>

         <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>No Reg</th><th>Tgl Terima SPD</th>

<th>Kirim 1 ke</th><th>Tgl Kirim 1</th><th>Selisih</th><th>Selisih1</th><th>Tgl Kmbl K1</th><th>Kirim 2 ke</th><th>Tgl kirim 2</th><th>Selisih</th><th>Selisih2</th><th>Tgl Kmbl K2</th><th>Kirim 3 ke</th><th>Tgl kirim 3</th><th>Selisih</th><th>Selisih3</th><th>Tgl Kmbl K3</th><th>Kirim 4 ke</th>

<th>Tgl kirim 4</th><th>Selisih</th><th>Selisih4</th><th>Tgl Kmbl K4</th><th>Kirim 5 ke</th><th>Tgl kirim 5</th><th>Selisih</th><th>Selisih5</th><th>Tgl Kmbl K5</th><th>Kirim 6 ke</th><th>Tgl kirim 6</th><th>Selisih</th><th>Selisih6</th><th>Tgl Kmbl K6</th>

<th>Kirim 7 ke</th><th>Tgl Kirim 7</th><th>Selisih</th><th>Selisih7</th><th>Tgl Kmbl K7</th><th>Kirim 8 ke</th><th>Tgl kirim 8</th><th>Selisih</th><th>Selisih8</th><th>Tgl Kmbl K8</th><th>Kirim 9 ke</th><th>Tgl kembali 9</th><th>Selisih</th><th>Selisih9</th><th>Tgl Kmbl K9</th><th>Kirim 10 ke</th>

<th>Tgl kirim 10</th><th>Selisih</th><th>Selisih10</th><th>Tgl Kmbl K10</th><th>Kirim 11 ke</th><th>Tgl kirim 11</th><th>Selisih</th><th>Selisih11</th><th>Tgl Kmbl K11</th><th>Kirim 12 ke</th><th>Tgl kirim 12</th><th>Selisih</th><th>Selisih12</th><th>Tgl Kmbl K12</th>

<th>Tgl Selesai</th><th>Tgl Berlaku</th><th>Total Hari</th><th>Target Total Hari</th><th>Tgl Selesai Dist</th><th>Selisih Total Dist</th><th>Target Dist</th><th>Tgl Selesai Tarik</th><th>Selisih Total Tarik</th><th>Target Tarik</th><th>Selisih Total SPD</th><th>Target SPD All</th><th>Edit</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





	  if ($r[tgl_terima]=='' or $r[tgl_terima]==0000-00-00 or $r[tgl_konsep1]=='' or $r[tgl_konsep1]==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($r[tgl_terima], $r[tgl_konsep1]); }

	  if ($r[tgl_kbl_k1]=='' or $r[tgl_kbl_k1]==0000-00-00 or $r[tgl_konsep2]=='' or $r[tgl_konsep2]==0000-00-00)

{     $selisih2="-"; } else

{	  $selisih2= selisihHari($r[tgl_kbl_k1], $r[tgl_konsep2]); }

	  if ($r[tgl_kbl_k2]=='' or $r[tgl_kbl_k2]==0000-00-00 or $r[tgl_konsep3]=='' or $r[tgl_konsep3]==0000-00-00)

{     $selisih3="-"; } else

{	  $selisih3= selisihHari($r[tgl_kbl_k2], $r[tgl_konsep3]); }

	  if ($r[tgl_kbl_k3]=='' or $r[tgl_kbl_k3]==0000-00-00 or $r[tgl_net1]=='' or $r[tgl_net1]==0000-00-00)  	

{     $selisih4="-"; } else

{	  $selisih4= selisihHari($r[tgl_kbl_k3], $r[tgl_net1]); }

	  if ($r[tgl_kbl_n1]=='' or $r[tgl_kbl_n1]==0000-00-00 or $r[tgl_net2]=='' or $r[tgl_net2]==0000-00-00)  	

{     $selisih5="-"; } else

{	  $selisih5= selisihHari($r[tgl_kbl_n1], $r[tgl_net2]); }

	  if ($r[tgl_kbl_n2]=='' or $r[tgl_kbl_n2]==0000-00-00 or $r[tgl_net3]=='' or $r[tgl_net3]==0000-00-00)  	

{     $selisih6="-"; } else

{	  $selisih6= selisihHari($r[tgl_kbl_n2], $r[tgl_net3]); }



	  if ($r[tgl_kbl_n3]=='' or $r[tgl_kbl_n3]==0000-00-00 or $r[tgl_konsep4]=='' or $r[tgl_konsep4]==0000-00-00) 

{     $selisih7="-"; } else

{	  $selisih7= selisihHari($r[tgl_kbl_n3], $r[tgl_konsep4]); }

	  if ($r[tgl_kbl_k4]=='' or $r[tgl_kbl_k4]==0000-00-00 or $r[tgl_konsep5]=='' or $r[tgl_konsep5]==0000-00-00)

{     $selisih8="-"; } else

{	  $selisih8= selisihHari($r[tgl_kbl_k4], $r[tgl_konsep5]); }

	  if ($r[tgl_kbl_k5]=='' or $r[tgl_kbl_k5]==0000-00-00 or $r[tgl_konsep6]=='' or $r[tgl_konsep6]==0000-00-00)

{     $selisih9="-"; } else

{	  $selisih9= selisihHari($r[tgl_kbl_k5], $r[tgl_konsep6]); }

	  if ($r[tgl_kbl_k6]=='' or $r[tgl_kbl_k6]==0000-00-00 or $r[tgl_net4]=='' or $r[tgl_net4]==0000-00-00)  	

{     $selisih10="-"; } else

{	  $selisih10= selisihHari($r[tgl_kbl_k6], $r[tgl_net4]); }

	  if ($r[tgl_kbl_n4]=='' or $r[tgl_kbl_n4]==0000-00-00 or $r[tgl_net5]=='' or $r[tgl_net5]==0000-00-00)  	

{     $selisih11="-"; } else

{	  $selisih11= selisihHari($r[tgl_kbl_n4], $r[tgl_net5]); }

	  if ($r[tgl_kbl_n5]=='' or $r[tgl_kbl_n5]==0000-00-00 or $r[tgl_net6]=='' or $r[tgl_net6]==0000-00-00)  	

{     $selisih12="-"; } else

{	  $selisih12= selisihHari($r[tgl_kbl_n5], $r[tgl_net6]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00)  	

{     $selisih13="-"; } else

{	  $selisih13= selisihHari($r[tgl_selesai], $r[tgl_dist_selesai]); }





if ($r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih14="-"; } else

{	  $selisih14= selisihHari($r[tgl_dist_selesai], $r[tgl_tarik_selesai]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih15="-"; } else

{	  $selisih15= selisihHari($r[tgl_terima], $r[tgl_tarik_selesai]); }





	  $tots=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12;

      $tots1=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12+$selisih13;

	  

       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[reg_upd]</td>";

echo "<td align=left width=30>$r[tgl_terima]</td> 

<td align=left width=30>$r[konsep1_krm]</td>

<td align=center width=30>$r[tgl_konsep1]</td>



<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2") { echo 0; }elseif ($selisih=="3") { echo 0; }

echo"</td>



<td align=center width=30>$r[tgl_kbl_k1]</td>

<td align=left width=30>$r[konsep2_krm]</td>

<td align=center width=30>$tgl_konsep2</td>

<td align=center>$selisih2</td>

<td align=center>";

if ($selisih2>3){ echo 1; } elseif ($selisih2=="0") { echo 0; } elseif ($selisih2=="1") { echo 0; } elseif ($selisih2=="2") { echo 0; }elseif ($selisih2=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k2</td>

<td align=left width=30>$r[konsep3_krm]</td>

<td align=center width=30>$tgl_konsep3</td>

<td align=center>$selisih3</td>

<td align=center>";

if ($selisih3>3){ echo 1; } elseif ($selisih3=="0") { echo 0; } elseif ($selisih3=="1") { echo 0; } elseif ($selisih3=="2") { echo 0; } elseif ($selisih3=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k3</td>

<td align=left width=30>$r[net1_krm]</td>

<td align=center width=30>$tgl_net1</td>

<td align=center>$selisih4</td>

<td align=center>";

if ($selisih4>3){ echo 1; } elseif ($selisih4=="0") { echo 0; } elseif ($selisih4=="1") { echo 0; } elseif ($selisih4=="2") { echo 0; } elseif ($selisih4=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n1</td>

<td align=left width=30>$r[net2_krm]</td>

<td align=center width=30>$tgl_net2</td>

<td align=center>$selisih5</td>

<td align=center>";

if ($selisih5>3){ echo 1; } elseif ($selisih5=="0") { echo 0; } elseif ($selisih5=="1") { echo 0; } elseif ($selisih5=="2") { echo 0; } elseif ($selisih5=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n2</td>

<td align=left width=30>$r[net3_krm]</td>

<td align=center width=30>$tgl_net3</td>

<td align=center>$selisih6</td>

<td align=center>";

if ($selisih6>3){ echo 1; } elseif ($selisih6=="0") { echo 0; } elseif ($selisih6=="1") { echo 0; } elseif ($selisih6=="2") { echo 0; } elseif ($selisih6=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n3</td>

<td align=left width=30>$r[konsep4_krm]</td>

<td align=center width=30>$r[tgl_konsep4]</td>

<td align=center>$selisih7</td>

<td align=center>";

if ($selisih7>3){ echo 1; } elseif ($selisih7=="0") { echo 0; } elseif ($selisih7=="1") { echo 0; } elseif ($selisih7=="2") { echo 0; } elseif ($selisih7=="3") { echo 0; }

echo"</td>

<td align=center width=30>$r[tgl_kbl_k4]</td>

<td align=left width=30>$r[konsep5_krm]</td>

<td align=center width=30>$tgl_konsep5</td>

<td align=center>$selisih8</td>

<td align=center>";

if ($selisih8>3){ echo 1; } elseif ($selisih8=="0") { echo 0; } elseif ($selisih8=="1") { echo 0; } elseif ($selisih8=="2") { echo 0; } elseif ($selisih8=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k5</td>

<td align=left width=30>$r[konsep6_krm]</td>

<td align=center width=30>$tgl_konsep6</td>

<td align=center>$selisih9</td>

<td align=center>";

if ($selisih9>3){ echo 1; } elseif ($selisih9=="0") { echo 0; } elseif ($selisih9=="1") { echo 0; } elseif ($selisih9=="2") { echo 0; } elseif ($selisih9=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k6</td>

<td align=left width=30>$r[net4_krm]</td>

<td align=center width=30>$tgl_net4</td>

<td align=center>$selisih10</td>

<td align=center>";

if ($selisih10>3){ echo 1; } elseif ($selisih10=="0") { echo 0; } elseif ($selisih10=="1") { echo 0; } elseif ($selisih10=="2") { echo 0; } elseif ($selisih10=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n4</td>

<td align=left width=30>$r[net5_krm]</td>

<td align=center width=30>$tgl_net5</td>

<td align=center>$selisih11</td>

<td align=center>";

if ($selisih11>3){ echo 1; } elseif ($selisih11=="0") { echo 0; } elseif ($selisih11=="1") { echo 0; } elseif ($selisih11=="2") { echo 0; }elseif ($selisih11=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n5</td>

<td align=left width=30>$r[net6_krm]</td>

<td align=center width=30>$tgl_net6</td>

<td align=center>$selisih12</td>

<td align=center>";

if ($selisih12>3){ echo 1; } elseif ($selisih12=="0") { echo 0; } elseif ($selisih12=="1") { echo 0; } elseif ($selisih12=="2") { echo 0; } elseif ($selisih12=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n6</td>

<td align=center width=30>$tgl_selesai</td>

<td align=center width=30>$tgl_berlaku</td>

<td align=center width=30>$tots</td>

<td align=center>";

if ($tots>14){ echo 1; } else { echo 0; } 

echo"</td>

<td align=center width=30>$r[tgl_dist_selesai]</td>

<td align=center width=30>$selisih13</td>

<td align=center>";

if ($selisih13>3){ echo 1; } elseif ($selisih13=="0") { echo 0; } elseif ($selisih13=="1") { echo 0; } elseif ($selisih13=="2") { echo 0; } elseif ($selisih13=="3") { echo 0; } 

echo"</td>

<td align=center width=30>$r[tgl_tarik_selesai]</td>

<td align=center width=30>$selisih14</td>

<td align=center>";

if ($selisih14>5){ echo 1; } else{ echo 0; } 

echo"</td>

<td align=center width=30>$tots1</td>

<td align=center>";

if ($tots1>20){ echo 1; } else{ echo 0; } 

echo"</td>

<td align=center width=30><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a>|<a href=?module=upd&act=tempupd&id=$r[id_upd] target=_blank>Temp</a></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";









echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd560'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata.-$kata1);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

 

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$gabung);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "reg_upd LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' ORDER BY tgl_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

include "selisih.php";

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata/$kata1 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=2500>

           <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Status</th><th>Tgl Terima SPD</th>

<th>Kirim 1 ke</th><th>Tgl Kirim 1</th><th>Selisih</th><th>Selisih1</th><th>Tgl Kmbl K1</th><th>Kirim 2 ke</th><th>Tgl kirim 2</th><th>Selisih</th><th>Selisih2</th><th>Tgl Kmbl K2</th><th>Kirim 3 ke</th><th>Tgl kirim 3</th><th>Selisih</th><th>Selisih3</th><th>Tgl Kmbl K3</th><th>Kirim 4 ke</th>

<th>Tgl kirim 4</th><th>Selisih</th><th>Selisih4</th><th>Tgl Kmbl K4</th><th>Kirim 5 ke</th><th>Tgl kirim 5</th><th>Selisih</th><th>Selisih5</th><th>Tgl Kmbl K5</th><th>Kirim 6 ke</th><th>Tgl kirim 6</th><th>Selisih</th><th>Selisih6</th><th>Tgl Kmbl K6</th>

<th>Kirim 7 ke</th><th>Tgl Kirim 7</th><th>Selisih</th><th>Selisih7</th><th>Tgl Kmbl K7</th><th>Kirim 8 ke</th><th>Tgl kirim 8</th><th>Selisih</th><th>Selisih8</th><th>Tgl Kmbl K8</th><th>Kirim 9 ke</th><th>Tgl kembali 9</th><th>Selisih</th><th>Selisih9</th><th>Tgl Kmbl K9</th><th>Kirim 10 ke</th>

<th>Tgl kirim 10</th><th>Selisih</th><th>Selisih10</th><th>Tgl Kmbl K10</th><th>Kirim 11 ke</th><th>Tgl kirim 11</th><th>Selisih</th><th>Selisih11</th><th>Tgl Kmbl K11</th><th>Kirim 12 ke</th><th>Tgl kirim 12</th><th>Selisih</th><th>Selisih12</th><th>Tgl Kmbl K12</th>

<th>Edit</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





	  if ($r[tgl_terima]=='' or $r[tgl_terima]==0000-00-00 or $r[tgl_konsep1]=='' or $r[tgl_konsep1]==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($r[tgl_terima], $r[tgl_konsep1]); }

	  if ($r[tgl_kbl_k1]=='' or $r[tgl_kbl_k1]==0000-00-00 or $r[tgl_konsep2]=='' or $r[tgl_konsep2]==0000-00-00)

{     $selisih2="-"; } else

{	  $selisih2= selisihHari($r[tgl_kbl_k1], $r[tgl_konsep2]); }

	  if ($r[tgl_kbl_k2]=='' or $r[tgl_kbl_k2]==0000-00-00 or $r[tgl_konsep3]=='' or $r[tgl_konsep3]==0000-00-00)

{     $selisih3="-"; } else

{	  $selisih3= selisihHari($r[tgl_kbl_k2], $r[tgl_konsep3]); }

	  if ($r[tgl_kbl_k3]=='' or $r[tgl_kbl_k3]==0000-00-00 or $r[tgl_net1]=='' or $r[tgl_net1]==0000-00-00)  	

{     $selisih4="-"; } else

{	  $selisih4= selisihHari($r[tgl_kbl_k3], $r[tgl_net1]); }

	  if ($r[tgl_kbl_n1]=='' or $r[tgl_kbl_n1]==0000-00-00 or $r[tgl_net2]=='' or $r[tgl_net2]==0000-00-00)  	

{     $selisih5="-"; } else

{	  $selisih5= selisihHari($r[tgl_kbl_n1], $r[tgl_net2]); }

	  if ($r[tgl_kbl_n2]=='' or $r[tgl_kbl_n2]==0000-00-00 or $r[tgl_net3]=='' or $r[tgl_net3]==0000-00-00)  	

{     $selisih6="-"; } else

{	  $selisih6= selisihHari($r[tgl_kbl_n2], $r[tgl_net3]); }



	  if ($r[tgl_kbl_n3]=='' or $r[tgl_kbl_n3]==0000-00-00 or $r[tgl_konsep4]=='' or $r[tgl_konsep4]==0000-00-00) 

{     $selisih7="-"; } else

{	  $selisih7= selisihHari($r[tgl_kbl_n3], $r[tgl_konsep4]); }

	  if ($r[tgl_kbl_k4]=='' or $r[tgl_kbl_k4]==0000-00-00 or $r[tgl_konsep5]=='' or $r[tgl_konsep5]==0000-00-00)

{     $selisih8="-"; } else

{	  $selisih8= selisihHari($r[tgl_kbl_k4], $r[tgl_konsep5]); }

	  if ($r[tgl_kbl_k5]=='' or $r[tgl_kbl_k5]==0000-00-00 or $r[tgl_konsep6]=='' or $r[tgl_konsep6]==0000-00-00)

{     $selisih9="-"; } else

{	  $selisih9= selisihHari($r[tgl_kbl_k5], $r[tgl_konsep6]); }

	  if ($r[tgl_kbl_k6]=='' or $r[tgl_kbl_k6]==0000-00-00 or $r[tgl_net4]=='' or $r[tgl_net4]==0000-00-00)  	

{     $selisih10="-"; } else

{	  $selisih10= selisihHari($r[tgl_kbl_k6], $r[tgl_net4]); }

	  if ($r[tgl_kbl_n4]=='' or $r[tgl_kbl_n4]==0000-00-00 or $r[tgl_net5]=='' or $r[tgl_net5]==0000-00-00)  	

{     $selisih11="-"; } else

{	  $selisih11= selisihHari($r[tgl_kbl_n4], $r[tgl_net5]); }

	  if ($r[tgl_kbl_n5]=='' or $r[tgl_kbl_n5]==0000-00-00 or $r[tgl_net6]=='' or $r[tgl_net6]==0000-00-00)  	

{     $selisih12="-"; } else

{	  $selisih12= selisihHari($r[tgl_kbl_n5], $r[tgl_net6]); }



  if ($r[tgl_dist]=='' or $r[tgl_dist]==0000-00-00 or $r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00)  	

{     $selisih13="-"; } else

{	  $selisih13= selisihHari($r[tgl_dist], $r[tgl_dist_selesai]); }



	  $tots=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12;



       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[status]</td>";

			 

echo " <td align=left width=50><form method=POST action=?module=upd&act=update451 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

<input type=text name='tgl_terima' size=12 value='$tgl_terima'>";	 



			 	 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		

echo"<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2"){ echo 0; } elseif ($selisih=="3") { echo 0; }

echo"</td>



<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo"<td align=center>$selisih2</td>

<td align=center>";

if ($selisih2>3){ echo 1; } elseif ($selisih2=="0") { echo 0; } elseif ($selisih2=="1") { echo 0; } elseif ($selisih2=="2"){ echo 0; } elseif ($selisih2=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo"<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo"

<td align=center>$selisih3</td>

<td align=center>";

if ($selisih3>3){ echo 1; } elseif ($selisih3=="0") { echo 0; } elseif ($selisih3=="1") { echo 0; } elseif ($selisih3=="2"){ echo 0; } elseif ($selisih3=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

echo"</td>";

if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo"<td align=center>$selisih4</td>

<td align=center>";

if ($selisih4>3){ echo 1; } elseif ($selisih4=="0") { echo 0; } elseif ($selisih4=="1") { echo 0; } elseif ($selisih4=="2"){ echo 0; } elseif ($selisih4=="3") { echo 0; }

echo"</td>";



echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "</td>

<td align=center>$selisih5</td>

<td align=center>";

if ($selisih5>3){ echo 1; } elseif ($selisih5=="0") { echo 0; } elseif ($selisih5=="1") { echo 0; } elseif ($selisih5=="2"){ echo 0; } elseif ($selisih5=="5") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "</td>

<td align=center>$selisih6</td><td>";

if ($selisih6>3){ echo 1; } elseif ($selisih6=="0") { echo 0; } elseif ($selisih6=="1") { echo 0; } elseif ($selisih6=="2"){ echo 0; } elseif ($selisih6=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		

echo"

<td align=center>$selisih7</td>

<td align=center>";

if ($selisih7>3){ echo 1; } elseif ($selisih7=="0") { echo 0; } elseif ($selisih7=="1") { echo 0; } elseif ($selisih7=="2"){ echo 0; } elseif ($selisih7=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}	

echo"	 

<td align=center>$selisih8</td>

<td align=center>";

if ($selisih8>3){ echo 1; } elseif ($selisih8=="0") { echo 0; } elseif ($selisih8=="1") { echo 0; } elseif ($selisih8=="2"){ echo 0; } elseif ($selisih8=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo"<td align=center>$selisih9</td>

<td align=center>";

if ($selisih9>3){ echo 1; } elseif ($selisih9=="0") { echo 0; } elseif ($selisih9=="1") { echo 0; } elseif ($selisih9=="2"){ echo 0; } elseif ($selisih9=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		

echo" 

<td align=center>$selisih10</td>

<td align=center>";

if ($selisih10>3){ echo 1; } elseif ($selisih10=="0") { echo 0; } elseif ($selisih10=="1") { echo 0; } elseif ($selisih10=="2"){ echo 0; } elseif ($selisih10=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo"

<td align=center>$selisih11</td>

<td align=center>";

if ($selisih11>3){ echo 1; } elseif ($selisih11=="0") { echo 0; } elseif ($selisih11=="1") { echo 0; } elseif ($selisih11=="2"){ echo 0; } elseif ($selisih11=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo"

<td align=center>$selisih12</td>

<td align=center>";

if ($selisih12>3){ echo 1; } elseif ($selisih12=="0") { echo 0; } elseif ($selisih12=="1") { echo 0; } elseif ($selisih12=="2"){ echo 0; } elseif ($selisih12=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>";	

echo"

<td align=center width=30><input type=submit value=Update></form></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";









echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





elseif ($module=='upd' AND $act=='cariupd5601'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata.$kata1);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

 

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$gabung);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;

  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "$kata2 LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' ORDER BY tgl_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

include "selisih.php";

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan dengan $kata2 pada <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata/$kata1 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Tgl Terima SPD</th>

<th>Kirim ke</th><th>Tgl Kirim </th><th>Selisih</th><th>0/1</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;



if ($kata2=='tgl_terima') {

	

	$trm=$r[tgl_terima];

	$trm_name='tgl_terima';

	$krm=$r[tgl_konsep1];

	$name='tgl_konsep1';

	$krm1=$r[konsep1_krm];

	$name1='konsep1_krm';

}

elseif ($kata2=='tgl_kbl_k1') {

	

	$trm=$r[tgl_kbl_k1];

	$trm_name='tgl_kbl_k1';

	$krm=$r[tgl_konsep2];

	$name='tgl_konsep2';

	$krm1=$r[konsep2_krm];

	$name1='konsep2_krm';

}

elseif ($kata2=='tgl_kbl_k2') {

	

	$trm=$r[tgl_kbl_k2];

	$trm_name='tgl_kbl_k2';

	$krm=$r[tgl_konsep3];

	$name='tgl_konsep3';

	$krm1=$r[konsep3_krm];

	$name1='konsep3_krm';



}

elseif ($kata2=='tgl_kbl_k3') {

	

	$trm=$r[tgl_kbl_k3];

	$trm_name='tgl_kbl_k3';

	$krm=$r[tgl_net1];

	$name='tgl_net1';

	$krm1=$r[net1_krm];

	$name1='net1_krm';

}

elseif ($kata2=='tgl_kbl_n1') {

	

	$trm=$r[tgl_kbl_n1];

	$trm_name='tgl_kbl_n1';

	$krm=$r[tgl_net2];

	$name='tgl_net2';

	$krm1=$r[net2_krm];

	$name1='net2_krm';

}

elseif ($kata2=='tgl_kbl_n2') {

	

	$trm=$r[tgl_kbl_n2];

	$trm_name='tgl_kbl_n2';

	$krm=$r[tgl_net3];

	$name='tgl_net3';

	$krm1=$r[net3_krm];

	$name1='net3_krm';

}

elseif ($kata2=='tgl_kbl_n3') {

	

	$trm=$r[tgl_kbl_n3];

	$trm_name='tgl_kbl_n3';

	$krm=$r[tgl_konsep4];

	$name='tgl_konsep4';

	$krm1=$r[konsep4_krm];

	$name1='konsep4_krm';

}

elseif ($kata2=='tgl_kbl_k4') {

	

	$trm=$r[tgl_kbl_k4];

	$trm_name='tgl_kbl_k4';

	$krm=$r[tgl_konsep5];

	$name='tgl_konsep5';

	$krm1=$r[konsep5_krm];

	$name1='konsep5_krm';

}

elseif ($kata2=='tgl_kbl_k5') {

	

	$trm=$r[tgl_kbl_k5];

	$trm_name='tgl_kbl_k5';

	$krm=$r[tgl_konsep6];

	$name='tgl_konsep6';

	$krm1=$r[konsep6_krm];

	$name1='konsep6_krm';

}

elseif ($kata2=='tgl_kbl_k6') {

	

	$trm=$r[tgl_kbl_k6];

	$trm_name='tgl_kbl_k6';

	$krm=$r[tgl_net4];

	$name='tgl_net4';

	$krm1=$r[net4_krm];

	$name1='net4_krm';

}

elseif ($kata2=='tgl_kbl_n4') {

	

	$trm=$r[tgl_kbl_n4];

	$trm_name='tgl_kbl_n4';

	$krm=$r[tgl_net5];

	$name='tgl_net5';

	$krm1=$r[net5_krm];

	$name1='net5_krm';



}

elseif ($kata2=='tgl_kbl_n5') {

	

	$trm=$r[tgl_kbl_n5];

	$trm_name='tgl_kbl_n5';

	$krm=$r[tgl_net6];

	$name='tgl_net6';

	$krm1=$r[net6_krm];

	$name1='net6_krm';



}

else {}



if ($trm=='' or $trm==0000-00-00 or $krm=='' or $krm==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($trm, $krm); }



 echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>";

echo "<td align=left width=30>$trm</td> 

<td align=left width=30>$krm1</td>

<td align=center width=30>$krm</td>



<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2") { echo 0; }elseif ($selisih=="3") { echo 0; }

echo"</td>";

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";









echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan $kata2 pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd589'){



	 // menghilangkan spasi di kiri dan kanannya

 $kata = trim($_POST[kata]);

$kata1 = trim($_POST[kata1]);

$kata2 = ($kata1.$kata);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata2);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_selesai LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' and status ='net' ORDER BY tgl_selesai ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

include "selisih.php";

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata2 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=2500>

        <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>No Reg</th><th>Tgl Terima SPD</th>

<th>Kirim 1 ke</th><th>Tgl Kirim 1</th><th>Selisih</th><th>Selisih1</th><th>Tgl Kmbl K1</th><th>Kirim 2 ke</th><th>Tgl kirim 2</th><th>Selisih</th><th>Selisih2</th><th>Tgl Kmbl K2</th><th>Kirim 3 ke</th><th>Tgl kirim 3</th><th>Selisih</th><th>Selisih3</th><th>Tgl Kmbl K3</th><th>Kirim 4 ke</th>

<th>Tgl kirim 4</th><th>Selisih</th><th>Selisih4</th><th>Tgl Kmbl K4</th><th>Kirim 5 ke</th><th>Tgl kirim 5</th><th>Selisih</th><th>Selisih5</th><th>Tgl Kmbl K5</th><th>Kirim 6 ke</th><th>Tgl kirim 6</th><th>Selisih</th><th>Selisih6</th><th>Tgl Kmbl K6</th>

<th>Kirim 7 ke</th><th>Tgl Kirim 7</th><th>Selisih</th><th>Selisih7</th><th>Tgl Kmbl K7</th><th>Kirim 8 ke</th><th>Tgl kirim 8</th><th>Selisih</th><th>Selisih8</th><th>Tgl Kmbl K8</th><th>Kirim 9 ke</th><th>Tgl kembali 9</th><th>Selisih</th><th>Selisih9</th><th>Tgl Kmbl K9</th><th>Kirim 10 ke</th>

<th>Tgl kirim 10</th><th>Selisih</th><th>Selisih10</th><th>Tgl Kmbl K10</th><th>Kirim 11 ke</th><th>Tgl kirim 11</th><th>Selisih</th><th>Selisih11</th><th>Tgl Kmbl K11</th><th>Kirim 12 ke</th><th>Tgl kirim 12</th><th>Selisih</th><th>Selisih12</th><th>Tgl Kmbl K12</th>

<th>Tgl Selesai</th><th>Tgl Berlaku</th><th>Total Hari</th><th>Target Total Hari</th><th>Tgl Selesai Dist</th><th>Selisih Total Dist</th><th>Target Dist</th><th>Tgl Selesai Tarik</th><th>Selisih Total Tarik</th><th>Target Tarik</th><th>Selisih Target SPD</th><th>Target SPD All</th><th>Edit</th><tr>"; 

		  		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





	  if ($r[tgl_terima]=='' or $r[tgl_terima]==0000-00-00 or $r[tgl_konsep1]=='' or $r[tgl_konsep1]==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($r[tgl_terima], $r[tgl_konsep1]); }

	  if ($r[tgl_kbl_k1]=='' or $r[tgl_kbl_k1]==0000-00-00 or $r[tgl_konsep2]=='' or $r[tgl_konsep2]==0000-00-00)

{     $selisih2="-"; } else

{	  $selisih2= selisihHari($r[tgl_kbl_k1], $r[tgl_konsep2]); }

	  if ($r[tgl_kbl_k2]=='' or $r[tgl_kbl_k2]==0000-00-00 or $r[tgl_konsep3]=='' or $r[tgl_konsep3]==0000-00-00)

{     $selisih3="-"; } else

{	  $selisih3= selisihHari($r[tgl_kbl_k2], $r[tgl_konsep3]); }

	  if ($r[tgl_kbl_k3]=='' or $r[tgl_kbl_k3]==0000-00-00 or $r[tgl_net1]=='' or $r[tgl_net1]==0000-00-00)  	

{     $selisih4="-"; } else

{	  $selisih4= selisihHari($r[tgl_kbl_k3], $r[tgl_net1]); }

	  if ($r[tgl_kbl_n1]=='' or $r[tgl_kbl_n1]==0000-00-00 or $r[tgl_net2]=='' or $r[tgl_net2]==0000-00-00)  	

{     $selisih5="-"; } else

{	  $selisih5= selisihHari($r[tgl_kbl_n1], $r[tgl_net2]); }

	  if ($r[tgl_kbl_n2]=='' or $r[tgl_kbl_n2]==0000-00-00 or $r[tgl_net3]=='' or $r[tgl_net3]==0000-00-00)  	

{     $selisih6="-"; } else

{	  $selisih6= selisihHari($r[tgl_kbl_n2], $r[tgl_net3]); }



	  if ($r[tgl_kbl_n3]=='' or $r[tgl_kbl_n3]==0000-00-00 or $r[tgl_konsep4]=='' or $r[tgl_konsep4]==0000-00-00) 

{     $selisih7="-"; } else

{	  $selisih7= selisihHari($r[tgl_kbl_n3], $r[tgl_konsep4]); }

	  if ($r[tgl_kbl_k4]=='' or $r[tgl_kbl_k4]==0000-00-00 or $r[tgl_konsep5]=='' or $r[tgl_konsep5]==0000-00-00)

{     $selisih8="-"; } else

{	  $selisih8= selisihHari($r[tgl_kbl_k4], $r[tgl_konsep5]); }

	  if ($r[tgl_kbl_k5]=='' or $r[tgl_kbl_k5]==0000-00-00 or $r[tgl_konsep6]=='' or $r[tgl_konsep6]==0000-00-00)

{     $selisih9="-"; } else

{	  $selisih9= selisihHari($r[tgl_kbl_k5], $r[tgl_konsep6]); }

	  if ($r[tgl_kbl_k6]=='' or $r[tgl_kbl_k6]==0000-00-00 or $r[tgl_net4]=='' or $r[tgl_net4]==0000-00-00)  	

{     $selisih10="-"; } else

{	  $selisih10= selisihHari($r[tgl_kbl_k6], $r[tgl_net4]); }

	  if ($r[tgl_kbl_n4]=='' or $r[tgl_kbl_n4]==0000-00-00 or $r[tgl_net5]=='' or $r[tgl_net5]==0000-00-00)  	

{     $selisih11="-"; } else

{	  $selisih11= selisihHari($r[tgl_kbl_n4], $r[tgl_net5]); }

	  if ($r[tgl_kbl_n5]=='' or $r[tgl_kbl_n5]==0000-00-00 or $r[tgl_net6]=='' or $r[tgl_net6]==0000-00-00)  	

{     $selisih12="-"; } else

{	  $selisih12= selisihHari($r[tgl_kbl_n5], $r[tgl_net6]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00)  	

{     $selisih13="-"; } else

{	  $selisih13= selisihHari($r[tgl_selesai], $r[tgl_dist_selesai]); }



if ($r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih14="-"; } else

{	  $selisih14= selisihHari($r[tgl_dist_selesai], $r[tgl_tarik_selesai]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih15="-"; } else

{	  $selisih15= selisihHari($r[tgl_selesai], $r[tgl_dist_selesai]); }





	  $tots=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12;

	  $tots1=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12+$selisih13;



       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[reg_upd]</td>";

			 

echo " <td align=left width=50><form method=POST action=?module=upd&act=update4 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

<input type=text name='tgl_terima' size=12 value='$tgl_terima'>";	 



			 	 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		

echo"<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2") { echo 0; } elseif ($selisih=="3") { echo 0; }

echo"</td>



<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo"<td align=center>$selisih2</td>

<td align=center>";

if ($selisih2>3){ echo 1; } elseif ($selisih2=="0") { echo 0; } elseif ($selisih2=="1") { echo 0; } elseif ($selisih2=="2") { echo 0; }elseif ($selisih2=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo"<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo"

<td align=center>$selisih3</td>

<td align=center>";

if ($selisih3>3){ echo 1; } elseif ($selisih3=="0") { echo 0; } elseif ($selisih3=="1") { echo 0; } elseif ($selisih3=="2") { echo 0; }elseif ($selisih3=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

echo"</td>";

if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo"<td align=center>$selisih4</td>

<td align=center>";

if ($selisih4>3){ echo 1; } elseif ($selisih4=="0") { echo 0; } elseif ($selisih4=="1") { echo 0; } elseif ($selisih4=="2") { echo 0; }elseif ($selisih4=="3") { echo 0; }

echo"</td>";



echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "</td>

<td align=center>$selisih5</td>

<td align=center>";

if ($selisih5>3){ echo 1; } elseif ($selisih5=="0") { echo 0; } elseif ($selisih5=="1") { echo 0; } elseif ($selisih5=="2") { echo 0; } elseif ($selisih5=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "</td>

<td align=center>$selisih6</td><td>";

if ($selisih6>3){ echo 1; } elseif ($selisih6=="0") { echo 0; } elseif ($selisih6=="1") { echo 0; } elseif ($selisih6=="2") { echo 0; }elseif ($selisih6=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		

echo"

<td align=center>$selisih7</td>

<td align=center>";

if ($selisih7>3){ echo 1; } elseif ($selisih7=="0") { echo 0; } elseif ($selisih7=="1") { echo 0; } elseif ($selisih7=="2") { echo 0; }elseif ($selisih7=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}	

echo"	 

<td align=center>$selisih8</td>

<td align=center>";

if ($selisih8>3){ echo 1; } elseif ($selisih8=="0") { echo 0; } elseif ($selisih8=="1") { echo 0; } elseif ($selisih8=="2") { echo 0; }elseif ($selisih8=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo"<td align=center>$selisih9</td>

<td align=center>";

if ($selisih9>3){ echo 1; } elseif ($selisih9=="0") { echo 0; } elseif ($selisih9=="1") { echo 0; } elseif ($selisih9=="2") { echo 0; }elseif ($selisih9=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		

echo" 

<td align=center>$selisih10</td>

<td align=center>";

if ($selisih10>3){ echo 1; } elseif ($selisih10=="0") { echo 0; } elseif ($selisih10=="1") { echo 0; } elseif ($selisih10=="2") { echo 0; }elseif ($selisih10=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo"

<td align=center>$selisih11</td>

<td align=center>";

if ($selisih11>3){ echo 1; } elseif ($selisih11=="0") { echo 0; } elseif ($selisih11=="1") { echo 0; } elseif ($selisih11=="2") { echo 0; }elseif ($selisih11=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo"

<td align=center>$selisih12</td>

<td align=center>";

if ($selisih12>3){ echo 1; } elseif ($selisih12=="0") { echo 0; } elseif ($selisih12=="1") { echo 0; } elseif ($selisih12=="2") { echo 0; }elseif ($selisih12=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>

<td align=center width=50>";

							 if ($tgl_selesai==0000-00-00){

echo "<input type=text name='tgl_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_selesai' size=8 value='$tgl_selesai'>";

}		

echo "</td><td align=center width=50>";

	 if ($tgl_berlaku==0000-00-00){

echo "<input type=text name='tgl_berlaku' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_berlaku' size=8 value='$tgl_berlaku'>";

}		



echo "</td>



<td align=center width=30>$tots</td>

<td align=center>";

if ($tots>14){ echo 1; } else { echo 0; } 

echo"</td>";



echo "<td align=center width=50>";

 if ($tgl_dist_selesai==0000-00-00){

echo "<input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo"</td><td align=center width=30>$selisih13</td>

<td align=center>";

if ($selisih13>3){ echo 1; } elseif ($selisih13=="0") { echo 0; } elseif ($selisih13=="1") { echo 0; } elseif ($selisih13=="2") { echo 0; } elseif ($selisih13=="3") { echo 0; } 

echo"</td>";



echo "<td align=center width=50>";

 if ($tgl_tarik_selesai==0000-00-00){

echo "<input type=text name='tgl_tarik_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_tarik_selesai' size=8 value='$tgl_tarik_selesai'>";

}		

echo"</td><td align=center width=30>$selisih14</td>

<td align=center>";

if ($selisih14>5){ echo 1; } else{ echo 0; } 





echo"</td>";





echo"<td align=center width=30>$tots1</td>

<td align=center>";

if ($tots1>20){ echo 1; } else{ echo 0; } 

echo"</td>



<td align=center width=30><input type=submit value=Update></form></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";









echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd5890'){



	 // menghilangkan spasi di kiri dan kanannya

 $kata = trim($_POST[kata]);

$kata1 = trim($_POST[kata1]);

$kata2 = ($kata1.$kata);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata2);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_berlaku LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' and status ='net' ORDER BY tgl_selesai ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

include "selisih.php";

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata2 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=2500>

        <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>No Reg</th><th>Tgl Terima SPD</th>

<th>Kirim 1 ke</th><th>Tgl Kirim 1</th><th>Selisih</th><th>Selisih1</th><th>Tgl Kmbl K1</th><th>Kirim 2 ke</th><th>Tgl kirim 2</th><th>Selisih</th><th>Selisih2</th><th>Tgl Kmbl K2</th><th>Kirim 3 ke</th><th>Tgl kirim 3</th><th>Selisih</th><th>Selisih3</th><th>Tgl Kmbl K3</th><th>Kirim 4 ke</th>

<th>Tgl kirim 4</th><th>Selisih</th><th>Selisih4</th><th>Tgl Kmbl K4</th><th>Kirim 5 ke</th><th>Tgl kirim 5</th><th>Selisih</th><th>Selisih5</th><th>Tgl Kmbl K5</th><th>Kirim 6 ke</th><th>Tgl kirim 6</th><th>Selisih</th><th>Selisih6</th><th>Tgl Kmbl K6</th>

<th>Kirim 7 ke</th><th>Tgl Kirim 7</th><th>Selisih</th><th>Selisih7</th><th>Tgl Kmbl K7</th><th>Kirim 8 ke</th><th>Tgl kirim 8</th><th>Selisih</th><th>Selisih8</th><th>Tgl Kmbl K8</th><th>Kirim 9 ke</th><th>Tgl kembali 9</th><th>Selisih</th><th>Selisih9</th><th>Tgl Kmbl K9</th><th>Kirim 10 ke</th>

<th>Tgl kirim 10</th><th>Selisih</th><th>Selisih10</th><th>Tgl Kmbl K10</th><th>Kirim 11 ke</th><th>Tgl kirim 11</th><th>Selisih</th><th>Selisih11</th><th>Tgl Kmbl K11</th><th>Kirim 12 ke</th><th>Tgl kirim 12</th><th>Selisih</th><th>Selisih12</th><th>Tgl Kmbl K12</th>

<th>Tgl Selesai</th><th>Tgl Berlaku</th><th>Total Hari</th><th>Target Total Hari</th><th>Tgl Selesai Dist</th><th>Selisih Total Dist</th><th>Target Dist</th><th>Tgl Selesai Tarik</th><th>Selisih Total Tarik</th><th>Target Tarik</th><th>Selisih Total SPD</th><th>Target SPD All</th><th>Edit</th><tr>"; 

		  		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;





	  if ($r[tgl_terima]=='' or $r[tgl_terima]==0000-00-00 or $r[tgl_konsep1]=='' or $r[tgl_konsep1]==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($r[tgl_terima], $r[tgl_konsep1]); }

	  if ($r[tgl_kbl_k1]=='' or $r[tgl_kbl_k1]==0000-00-00 or $r[tgl_konsep2]=='' or $r[tgl_konsep2]==0000-00-00)

{     $selisih2="-"; } else

{	  $selisih2= selisihHari($r[tgl_kbl_k1], $r[tgl_konsep2]); }

	  if ($r[tgl_kbl_k2]=='' or $r[tgl_kbl_k2]==0000-00-00 or $r[tgl_konsep3]=='' or $r[tgl_konsep3]==0000-00-00)

{     $selisih3="-"; } else

{	  $selisih3= selisihHari($r[tgl_kbl_k2], $r[tgl_konsep3]); }

	  if ($r[tgl_kbl_k3]=='' or $r[tgl_kbl_k3]==0000-00-00 or $r[tgl_net1]=='' or $r[tgl_net1]==0000-00-00)  	

{     $selisih4="-"; } else

{	  $selisih4= selisihHari($r[tgl_kbl_k3], $r[tgl_net1]); }

	  if ($r[tgl_kbl_n1]=='' or $r[tgl_kbl_n1]==0000-00-00 or $r[tgl_net2]=='' or $r[tgl_net2]==0000-00-00)  	

{     $selisih5="-"; } else

{	  $selisih5= selisihHari($r[tgl_kbl_n1], $r[tgl_net2]); }

	  if ($r[tgl_kbl_n2]=='' or $r[tgl_kbl_n2]==0000-00-00 or $r[tgl_net3]=='' or $r[tgl_net3]==0000-00-00)  	

{     $selisih6="-"; } else

{	  $selisih6= selisihHari($r[tgl_kbl_n2], $r[tgl_net3]); }



	  if ($r[tgl_kbl_n3]=='' or $r[tgl_kbl_n3]==0000-00-00 or $r[tgl_konsep4]=='' or $r[tgl_konsep4]==0000-00-00) 

{     $selisih7="-"; } else

{	  $selisih7= selisihHari($r[tgl_kbl_n3], $r[tgl_konsep4]); }

	  if ($r[tgl_kbl_k4]=='' or $r[tgl_kbl_k4]==0000-00-00 or $r[tgl_konsep5]=='' or $r[tgl_konsep5]==0000-00-00)

{     $selisih8="-"; } else

{	  $selisih8= selisihHari($r[tgl_kbl_k4], $r[tgl_konsep5]); }

	  if ($r[tgl_kbl_k5]=='' or $r[tgl_kbl_k5]==0000-00-00 or $r[tgl_konsep6]=='' or $r[tgl_konsep6]==0000-00-00)

{     $selisih9="-"; } else

{	  $selisih9= selisihHari($r[tgl_kbl_k5], $r[tgl_konsep6]); }

	  if ($r[tgl_kbl_k6]=='' or $r[tgl_kbl_k6]==0000-00-00 or $r[tgl_net4]=='' or $r[tgl_net4]==0000-00-00)  	

{     $selisih10="-"; } else

{	  $selisih10= selisihHari($r[tgl_kbl_k6], $r[tgl_net4]); }

	  if ($r[tgl_kbl_n4]=='' or $r[tgl_kbl_n4]==0000-00-00 or $r[tgl_net5]=='' or $r[tgl_net5]==0000-00-00)  	

{     $selisih11="-"; } else

{	  $selisih11= selisihHari($r[tgl_kbl_n4], $r[tgl_net5]); }

	  if ($r[tgl_kbl_n5]=='' or $r[tgl_kbl_n5]==0000-00-00 or $r[tgl_net6]=='' or $r[tgl_net6]==0000-00-00)  	

{     $selisih12="-"; } else

{	  $selisih12= selisihHari($r[tgl_kbl_n5], $r[tgl_net6]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00)  	

{     $selisih13="-"; } else

{	  $selisih13= selisihHari($r[tgl_selesai], $r[tgl_dist_selesai]); }



if ($r[tgl_dist_selesai]=='' or $r[tgl_dist_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih14="-"; } else

{	  $selisih14= selisihHari($r[tgl_dist_selesai], $r[tgl_tarik_selesai]); }



  if ($r[tgl_selesai]=='' or $r[tgl_selesai]==0000-00-00 or $r[tgl_tarik_selesai]=='' or $r[tgl_tarik_selesai]==0000-00-00)  	

{     $selisih15="-"; } else

{	  $selisih15= selisihHari($r[tgl_selesai], $r[tgl_dist_selesai]); }





	

	  $tots=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12;

  $tots1=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12+$selisih13;



       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[reg_upd]</td>";

			 

echo " <td align=left width=50><form method=POST action=?module=upd&act=update4 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

<input type=text name='tgl_terima' size=12 value='$tgl_terima'>";	 



			 	 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		

echo"<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2") { echo 0; } elseif ($selisih=="3") { echo 0; }

echo"</td>



<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo"<td align=center>$selisih2</td>

<td align=center>";

if ($selisih2>3){ echo 1; } elseif ($selisih2=="0") { echo 0; } elseif ($selisih2=="1") { echo 0; } elseif ($selisih2=="2") { echo 0; }elseif ($selisih2=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo"<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo"

<td align=center>$selisih3</td>

<td align=center>";

if ($selisih3>3){ echo 1; } elseif ($selisih3=="0") { echo 0; } elseif ($selisih3=="1") { echo 0; } elseif ($selisih3=="2") { echo 0; }elseif ($selisih3=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

echo"</td>";

if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo"<td align=center>$selisih4</td>

<td align=center>";

if ($selisih4>3){ echo 1; } elseif ($selisih4=="0") { echo 0; } elseif ($selisih4=="1") { echo 0; } elseif ($selisih4=="2") { echo 0; }elseif ($selisih4=="3") { echo 0; }

echo"</td>";



echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "</td>

<td align=center>$selisih5</td>

<td align=center>";

if ($selisih5>3){ echo 1; } elseif ($selisih5=="0") { echo 0; } elseif ($selisih5=="1") { echo 0; } elseif ($selisih5=="2") { echo 0; } elseif ($selisih5=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "</td>

<td align=center>$selisih6</td><td>";

if ($selisih6>3){ echo 1; } elseif ($selisih6=="0") { echo 0; } elseif ($selisih6=="1") { echo 0; } elseif ($selisih6=="2") { echo 0; }elseif ($selisih6=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		

echo"

<td align=center>$selisih7</td>

<td align=center>";

if ($selisih7>3){ echo 1; } elseif ($selisih7=="0") { echo 0; } elseif ($selisih7=="1") { echo 0; } elseif ($selisih7=="2") { echo 0; }elseif ($selisih7=="3") { echo 0; }

echo"</td>";

echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}	

echo"	 

<td align=center>$selisih8</td>

<td align=center>";

if ($selisih8>3){ echo 1; } elseif ($selisih8=="0") { echo 0; } elseif ($selisih8=="1") { echo 0; } elseif ($selisih8=="2") { echo 0; }elseif ($selisih8=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo"<td align=center>$selisih9</td>

<td align=center>";

if ($selisih9>3){ echo 1; } elseif ($selisih9=="0") { echo 0; } elseif ($selisih9=="1") { echo 0; } elseif ($selisih9=="2") { echo 0; }elseif ($selisih9=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		

echo" 

<td align=center>$selisih10</td>

<td align=center>";

if ($selisih10>3){ echo 1; } elseif ($selisih10=="0") { echo 0; } elseif ($selisih10=="1") { echo 0; } elseif ($selisih10=="2") { echo 0; }elseif ($selisih10=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo"

<td align=center>$selisih11</td>

<td align=center>";

if ($selisih11>3){ echo 1; } elseif ($selisih11=="0") { echo 0; } elseif ($selisih11=="1") { echo 0; } elseif ($selisih11=="2") { echo 0; }elseif ($selisih11=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo"

<td align=center>$selisih12</td>

<td align=center>";

if ($selisih12>3){ echo 1; } elseif ($selisih12=="0") { echo 0; } elseif ($selisih12=="1") { echo 0; } elseif ($selisih12=="2") { echo 0; }elseif ($selisih12=="3") { echo 0; }

echo"</td>

<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>

<td align=center width=50>";

							 if ($tgl_selesai==0000-00-00){

echo "<input type=text name='tgl_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_selesai' size=8 value='$tgl_selesai'>";

}		

echo "</td><td align=center width=50>";

	 if ($tgl_berlaku==0000-00-00){

echo "<input type=text name='tgl_berlaku' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_berlaku' size=8 value='$tgl_berlaku'>";

}		



echo "</td>



<td align=center width=30>$tots</td>

<td align=center>";

if ($tots>14){ echo 1; } else { echo 0; } 

echo"</td>";



echo "<td align=center width=50>";

 if ($tgl_dist_selesai==0000-00-00){

echo "<input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo"</td><td align=center width=30>$selisih13</td>

<td align=center>";

if ($selisih13>3){ echo 1; } elseif ($selisih13=="0") { echo 0; } elseif ($selisih13=="1") { echo 0; } elseif ($selisih13=="2") { echo 0; } elseif ($selisih13=="3") { echo 0; } 

echo"</td>";



echo "<td align=center width=50>";

 if ($tgl_tarik_selesai==0000-00-00){

echo "<input type=text name='tgl_tarik_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_tarik_selesai' size=8 value='$tgl_tarik_selesai'>";

}		

echo"</td><td align=center width=30>$selisih14</td>

<td align=center>";

if ($selisih14>5){ echo 1; } else{ echo 0; } 





echo"</td>";





echo"<td align=center width=30>$tots1</td>

<td align=center>";

if ($tots1>20){ echo 1; } else{ echo 0; } 

echo"</td>



<td align=center width=30><input type=submit value=Update></form></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";









echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd588'){



  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata.-$kata1);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

 

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$gabung);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "reg_upd LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' ORDER BY tgl_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){



include "selisih.php";

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata/$kata1 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=2500>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Status</th><th>Tgl Terima SPD</th>

<th>Kirim 1 ke</th><th>Tgl Kirim 1</th><th>Selisih</th><th>Selisih1</th><th>Tgl Kmbl K1</th><th>Kirim 2 ke</th><th>Tgl kirim 2</th><th>Selisih</th><th>Selisih2</th><th>Tgl Kmbl K2</th><th>Kirim 3 ke</th><th>Tgl kirim 3</th><th>Selisih</th><th>Selisih3</th><th>Tgl Kmbl K3</th><th>Kirim 4 ke</th>

<th>Tgl kirim 4</th><th>Selisih</th><th>Selisih4</th><th>Tgl Kmbl K4</th><th>Kirim 5 ke</th><th>Tgl kirim 5</th><th>Selisih</th><th>Selisih5</th><th>Tgl Kmbl K5</th><th>Kirim 6 ke</th><th>Tgl kirim 6</th><th>Selisih</th><th>Selisih6</th><th>Tgl Kmbl K6</th>

<th>Kirim 7 ke</th><th>Tgl Kirim 7</th><th>Selisih</th><th>Selisih7</th><th>Tgl Kmbl K7</th><th>Kirim 8 ke</th><th>Tgl kirim 8</th><th>Selisih</th><th>Selisih8</th><th>Tgl Kmbl K8</th><th>Kirim 9 ke</th><th>Tgl kembali 9</th><th>Selisih</th><th>Selisih9</th><th>Tgl Kmbl K9</th><th>Kirim 10 ke</th>

<th>Tgl kirim 10</th><th>Selisih</th><th>Selisih10</th><th>Tgl Kmbl K10</th><th>Kirim 11 ke</th><th>Tgl kirim 11</th><th>Selisih</th><th>Selisih11</th><th>Tgl Kmbl K11</th><th>Kirim 12 ke</th><th>Tgl kirim 12</th><th>Selisih</th><th>Selisih12</th><th>Tgl Kmbl K12</th>

<th>Edit</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;

	  

	  if ($r[tgl_terima]=='' or $r[tgl_terima]==0000-00-00 or $r[tgl_konsep1]=='' or $r[tgl_konsep1]==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($r[tgl_terima], $r[tgl_konsep1]); }

	  if ($r[tgl_kbl_k1]=='' or $r[tgl_kbl_k1]==0000-00-00 or $r[tgl_konsep2]=='' or $r[tgl_konsep2]==0000-00-00)

{     $selisih2="-"; } else

{	  $selisih2= selisihHari($r[tgl_kbl_k1], $r[tgl_konsep2]); }

	  if ($r[tgl_kbl_k2]=='' or $r[tgl_kbl_k2]==0000-00-00 or $r[tgl_konsep3]=='' or $r[tgl_konsep3]==0000-00-00)

{     $selisih3="-"; } else

{	  $selisih3= selisihHari($r[tgl_kbl_k2], $r[tgl_konsep3]); }

	  if ($r[tgl_kbl_k3]=='' or $r[tgl_kbl_k3]==0000-00-00 or $r[tgl_net1]=='' or $r[tgl_net1]==0000-00-00)  	

{     $selisih4="-"; } else

{	  $selisih4= selisihHari($r[tgl_kbl_k3], $r[tgl_net1]); }

	  if ($r[tgl_kbl_n1]=='' or $r[tgl_kbl_n1]==0000-00-00 or $r[tgl_net2]=='' or $r[tgl_net2]==0000-00-00)  	

{     $selisih5="-"; } else

{	  $selisih5= selisihHari($r[tgl_kbl_n1], $r[tgl_net2]); }

	  if ($r[tgl_kbl_n2]=='' or $r[tgl_kbl_n2]==0000-00-00 or $r[tgl_net3]=='' or $r[tgl_net3]==0000-00-00)  	

{     $selisih6="-"; } else

{	  $selisih6= selisihHari($r[tgl_kbl_n2], $r[tgl_net3]); }



	  if ($r[tgl_kbl_n3]=='' or $r[tgl_kbl_n3]==0000-00-00 or $r[tgl_konsep4]=='' or $r[tgl_konsep4]==0000-00-00) 

{     $selisih7="-"; } else

{	  $selisih7= selisihHari($r[tgl_kbl_n3], $r[tgl_konsep4]); }

	  if ($r[tgl_kbl_k4]=='' or $r[tgl_kbl_k4]==0000-00-00 or $r[tgl_konsep5]=='' or $r[tgl_konsep5]==0000-00-00)

{     $selisih8="-"; } else

{	  $selisih8= selisihHari($r[tgl_kbl_k4], $r[tgl_konsep5]); }

	  if ($r[tgl_kbl_k5]=='' or $r[tgl_kbl_k5]==0000-00-00 or $r[tgl_konsep6]=='' or $r[tgl_konsep6]==0000-00-00)

{     $selisih9="-"; } else

{	  $selisih9= selisihHari($r[tgl_kbl_k5], $r[tgl_konsep6]); }

	  if ($r[tgl_kbl_k6]=='' or $r[tgl_kbl_k6]==0000-00-00 or $r[tgl_net4]=='' or $r[tgl_net4]==0000-00-00)  	

{     $selisih10="-"; } else

{	  $selisih10= selisihHari($r[tgl_kbl_k6], $r[tgl_net4]); }

	  if ($r[tgl_kbl_n4]=='' or $r[tgl_kbl_n4]==0000-00-00 or $r[tgl_net5]=='' or $r[tgl_net5]==0000-00-00)  	

{     $selisih11="-"; } else

{	  $selisih11= selisihHari($r[tgl_kbl_n4], $r[tgl_net5]); }

	  if ($r[tgl_kbl_n5]=='' or $r[tgl_kbl_n5]==0000-00-00 or $r[tgl_net6]=='' or $r[tgl_net6]==0000-00-00)  	

{     $selisih12="-"; } else

{	  $selisih12= selisihHari($r[tgl_kbl_n5], $r[tgl_net6]); }





	  $tots=$selisih+$selisih2+$selisih3+$selisih4+$selisih5+$selisih6+$selisih7+$selisih8+$selisih9+$selisih10+$selisih11+$selisih12;



       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[status]</td>";

echo "<td align=left width=30>$r[tgl_terima]</td> 

<td align=left width=30>$r[konsep1_krm]</td>

<td align=center width=30>$r[tgl_konsep1]</td>



<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2") { echo 0; }elseif ($selisih=="3") { echo 0; }

echo"</td>



<td align=center width=30>$r[tgl_kbl_k1]</td>

<td align=left width=30>$r[konsep2_krm]</td>

<td align=center width=30>$tgl_konsep2</td>

<td align=center>$selisih2</td>

<td align=center>";

if ($selisih2>3){ echo 1; } elseif ($selisih2=="0") { echo 0; } elseif ($selisih2=="1") { echo 0; } elseif ($selisih2=="2") { echo 0; }elseif ($selisih2=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k2</td>

<td align=left width=30>$r[konsep3_krm]</td>

<td align=center width=30>$tgl_konsep3</td>

<td align=center>$selisih3</td>

<td align=center>";

if ($selisih3>3){ echo 1; } elseif ($selisih3=="0") { echo 0; } elseif ($selisih3=="1") { echo 0; } elseif ($selisih3=="2") { echo 0; } elseif ($selisih3=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k3</td>

<td align=left width=30>$r[net1_krm]</td>

<td align=center width=30>$tgl_net1</td>

<td align=center>$selisih4</td>

<td align=center>";

if ($selisih4>3){ echo 1; } elseif ($selisih4=="0") { echo 0; } elseif ($selisih4=="1") { echo 0; } elseif ($selisih4=="2") { echo 0; } elseif ($selisih4=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n1</td>

<td align=left width=30>$r[net2_krm]</td>

<td align=center width=30>$tgl_net2</td>

<td align=center>$selisih5</td>

<td align=center>";

if ($selisih5>3){ echo 1; } elseif ($selisih5=="0") { echo 0; } elseif ($selisih5=="1") { echo 0; } elseif ($selisih5=="2") { echo 0; } elseif ($selisih5=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n2</td>

<td align=left width=30>$r[net3_krm]</td>

<td align=center width=30>$tgl_net3</td>

<td align=center>$selisih6</td>

<td align=center>";

if ($selisih6>3){ echo 1; } elseif ($selisih6=="0") { echo 0; } elseif ($selisih6=="1") { echo 0; } elseif ($selisih6=="2") { echo 0; } elseif ($selisih6=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n3</td>

<td align=left width=30>$r[konsep4_krm]</td>

<td align=center width=30>$r[tgl_konsep4]</td>

<td align=center>$selisih7</td>

<td align=center>";

if ($selisih7>3){ echo 1; } elseif ($selisih7=="0") { echo 0; } elseif ($selisih7=="1") { echo 0; } elseif ($selisih7=="2") { echo 0; } elseif ($selisih7=="3") { echo 0; }

echo"</td>

<td align=center width=30>$r[tgl_kbl_k4]</td>

<td align=left width=30>$r[konsep5_krm]</td>

<td align=center width=30>$tgl_konsep5</td>

<td align=center>$selisih8</td>

<td align=center>";

if ($selisih8>3){ echo 1; } elseif ($selisih8=="0") { echo 0; } elseif ($selisih8=="1") { echo 0; } elseif ($selisih8=="2") { echo 0; } elseif ($selisih8=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k5</td>

<td align=left width=30>$r[konsep6_krm]</td>

<td align=center width=30>$tgl_konsep6</td>

<td align=center>$selisih9</td>

<td align=center>";

if ($selisih9>3){ echo 1; } elseif ($selisih9=="0") { echo 0; } elseif ($selisih9=="1") { echo 0; } elseif ($selisih9=="2") { echo 0; } elseif ($selisih9=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_k6</td>

<td align=left width=30>$r[net4_krm]</td>

<td align=center width=30>$tgl_net4</td>

<td align=center>$selisih10</td>

<td align=center>";

if ($selisih10>3){ echo 1; } elseif ($selisih10=="0") { echo 0; } elseif ($selisih10=="1") { echo 0; } elseif ($selisih10=="2") { echo 0; } elseif ($selisih10=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n4</td>

<td align=left width=30>$r[net5_krm]</td>

<td align=center width=30>$tgl_net5</td>

<td align=center>$selisih11</td>

<td align=center>";

if ($selisih11>3){ echo 1; } elseif ($selisih11=="0") { echo 0; } elseif ($selisih11=="1") { echo 0; } elseif ($selisih11=="2") { echo 0; } elseif ($selisih11=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n5</td>

<td align=left width=30>$r[net6_krm]</td>

<td align=center width=30>$tgl_net6</td>

<td align=center>$selisih12</td>

<td align=center>";

if ($selisih12>3){ echo 1; } elseif ($selisih12=="0") { echo 0; } elseif ($selisih12=="1") { echo 0; } elseif ($selisih12=="2") { echo 0; } elseif ($selisih12=="3") { echo 0; }

echo"</td>

<td align=center width=30>$tgl_kbl_n6</td>



<td align=center width=30><a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd]>Edit</a></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";







echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd5881'){



  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata.$kata1);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

 

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$gabung);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "$kata2 LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "AND keterangan2 !='khusus' ORDER BY tgl_upd ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){



include "selisih.php";

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan $kata2 pada <font style='background-color:#00FFFF'><b>Bulan/Tahun : $kata/$kata1 </b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Status</th><th>Tgl Terima SPD</th>

<th>Kirim ke</th><th>Tgl Kirim </th><th>Selisih</th><th>0/1</th><th>Edit</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

      $tgl_terima=tgl_indo3($r[tgl_terima]);

	  $hasilku1=$tgl_berlaku-$tgl_terima;	 

	  $hasilku2=$tgl_konsep1-$tgl_terima;

	  $hasilku3=$tgl_net1-$tgl_terima;



if ($kata2=='tgl_terima') {

	

	$trm=$r[tgl_terima];

	$trm_name='tgl_terima';

	$krm=$r[tgl_konsep1];

	$name='tgl_konsep1';

	$krm1=$r[konsep1_krm];

	$name1='konsep1_krm';

}

elseif ($kata2=='tgl_kbl_k1') {

	

	$trm=$r[tgl_kbl_k1];

	$trm_name='tgl_kbl_k1';

	$krm=$r[tgl_konsep2];

	$name='tgl_konsep2';

	$krm1=$r[konsep2_krm];

	$name1='konsep2_krm';

}

elseif ($kata2=='tgl_kbl_k2') {

	

	$trm=$r[tgl_kbl_k2];

	$trm_name='tgl_kbl_k2';

	$krm=$r[tgl_konsep3];

	$name='tgl_konsep3';

	$krm1=$r[konsep3_krm];

	$name1='konsep3_krm';



}

elseif ($kata2=='tgl_kbl_k3') {

	

	$trm=$r[tgl_kbl_k3];

	$trm_name='tgl_kbl_k3';

	$krm=$r[tgl_net1];

	$name='tgl_net1';

	$krm1=$r[net1_krm];

	$name1='net1_krm';

}

elseif ($kata2=='tgl_kbl_n1') {

	

	$trm=$r[tgl_kbl_n1];

	$trm_name='tgl_kbl_n1';

	$krm=$r[tgl_net2];

	$name='tgl_net2';

	$krm1=$r[net2_krm];

	$name1='net2_krm';

}

elseif ($kata2=='tgl_kbl_n2') {

	

	$trm=$r[tgl_kbl_n2];

	$trm_name='tgl_kbl_n2';

	$krm=$r[tgl_net3];

	$name='tgl_net3';

	$krm1=$r[net3_krm];

	$name1='net3_krm';

}

elseif ($kata2=='tgl_kbl_n3') {

	

	$trm=$r[tgl_kbl_n3];

	$trm_name='tgl_kbl_n3';

	$krm=$r[tgl_konsep4];

	$name='tgl_konsep4';

	$krm1=$r[konsep4_krm];

	$name1='konsep4_krm';

}

elseif ($kata2=='tgl_kbl_k4') {

	

	$trm=$r[tgl_kbl_k4];

	$trm_name='tgl_kbl_k4';

	$krm=$r[tgl_konsep5];

	$name='tgl_konsep5';

	$krm1=$r[konsep5_krm];

	$name1='konsep5_krm';

}

elseif ($kata2=='tgl_kbl_k5') {

	

	$trm=$r[tgl_kbl_k5];

	$trm_name='tgl_kbl_k5';

	$krm=$r[tgl_konsep6];

	$name='tgl_konsep6';

	$krm1=$r[konsep6_krm];

	$name1='konsep6_krm';

}

elseif ($kata2=='tgl_kbl_k6') {

	

	$trm=$r[tgl_kbl_k6];

	$trm_name='tgl_kbl_k6';

	$krm=$r[tgl_net4];

	$name='tgl_net4';

	$krm1=$r[net4_krm];

	$name1='net4_krm';

}

elseif ($kata2=='tgl_kbl_n4') {

	

	$trm=$r[tgl_kbl_n4];

	$trm_name='tgl_kbl_n4';

	$krm=$r[tgl_net5];

	$name='tgl_net5';

	$krm1=$r[net5_krm];

	$name1='net5_krm';



}

elseif ($kata2=='tgl_kbl_n5') {

	

	$trm=$r[tgl_kbl_n5];

	$trm_name='tgl_kbl_n5';

	$krm=$r[tgl_net6];

	$name='tgl_net6';

	$krm1=$r[net6_krm];

	$name1='net6_krm';



}

else {}



if ($trm=='' or $trm==0000-00-00 or $krm=='' or $krm==0000-00-00) 

{     $selisih="-"; } else

{	  $selisih= selisihHari($trm, $krm); }

	

       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username] </td>

             <td align=left width=30>$r[jenis_upd]</td>

			        

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>

			 <td align=left>$r[status]</td>";

			 

echo " <td align=left width=50>

<form method=POST action=?module=upd&act=update452 target=_blank><input type=hidden name=id_upd value=$r[id_upd]>

<input type=hidden name=kata2 value=$kata2>

<input type=text name='trm' size=12 value='$trm'>";	 



			 	 

				  if ($krm=='' or $krm=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='$name1' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='$name1' size=12 value='$krm1'></td>";

}		

echo "<td align=center width=50>";



				 if ($krm==0000-00-00){

echo "<input type=text name='krm' size=8 value=''>";

}

else {

echo "<input type=text name='krm' size=8 value='$krm'></td>";

}		

echo"<td align=center>$selisih</td>

<td align=center>";

if ($selisih>3){ echo 1; } elseif ($selisih=="0") { echo 0; } elseif ($selisih=="1") { echo 0; } elseif ($selisih=="2"){ echo 0; } elseif ($selisih=="3") { echo 0; }

echo"</td>";

echo"<td align=center width=30><input type=submit value=Update></form></td>";

			  		  

			  echo "</tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan $kata2 pada bulan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd61'){



	 // menghilangkan spasi di kiri dan kanannya

 $kata = trim($_POST[kata]);

$kata1 = trim($_POST[kata1]);;

$kata2 = ($kata1.$kata);

  

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata2);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_selesai LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and status ='net' ORDER BY tgl_selesai ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

  if ($tampil > 0){

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan yang selesai untuk edit bulan/tahun <font style='background-color:#00FFFF'><b>$kata2</b></font> :</b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN</b><br>

</FONT><center>

<table width=4000>





          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>R</th><th>Jdl Dokumen</th><th><b>Tgl kmbl knsp</b></th><th><b>Tgl Kirim Net 1</b><th>Tgl UPD/ Terima</th></th><th>Kirim 1 Ke:</th><th>Tgl K1</th><th>Tgl kbl K1</th><th>Kirim 2 Ke:</th><th>Tgl K2</th><th>Tgl kbl K2</th><th>Kirim 3 Ke:</th><th>Tgl K3</th><th>Tgl kbl K3</th><th>Kirim 4 Ke:</th><th>Tgl K4</th><th>Tgl Kbl K4</th><th>Kirim 5 Ke:</th><th>Tgl K5</th><th>Tgl Kbl K5</th><th>Kirim 6 Ke:</th><th>Tgl K6</th><th>Tgl Kbl K6</th><th>Kirim 7 Ke:</th><th>Tgl K7</th><th>Tgl kbl K7</th><th>Kirim 8 Ke:</th><th>Tgl K8</th>

		  <th>Tgl kbl K8</th><th>Kirim 9 Ke:</th><th>Tgl K9</th><th>Tgl kbl K9</th><th>Kirim 10 Ke:</th><th>Tgl K10</th><th>Tgl Kbl K10</th><th>Kirim 11 Ke:</th><th>Tgl K11</th><th>Tgl Kbl K11</th><th>Kirim 12 Ke:</th><th>Tgl K12</th><th>Tgl Kbl K12</th><th>Tgl Pending</th><th>Tgl Terima 2</th><th>Tgl Selesai</th><th>Tgl Brlku</th><th><b>Kategori Usulan</b></th><th><b>Uraian UPD</b></th><th>Tgl Dist</th><th>Tgl Dist Selesai</th><th>Tgl Tarik Selesai</th><th><b>Keterangan</b></th><th>Update</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){

	

	  $tgl_terakhir=tgl_indo3($r[tgl_terakhir]);	 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);	  

	  $tgl_terima=tgl_indo3($r[tgl_terima]);	

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

	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

	  $tgl_dist=tgl_indo3($r[tgl_dist]);

	  $tgl_dist_selesai=tgl_indo3($r[tgl_dist_selesai]);  

	  $tgl_tarik_selesai=tgl_indo3($r[tgl_tarik_selesai]); 

	  $tgl_upd=tgl_indo3($r[tgl_upd]);

	  $tgl_pending=tgl_indo3($r[tgl_pending]);

	  $tgl_terima2=tgl_indo3($r[tgl_terima2]);

	  $tgl_berlaku=tgl_indo3($r[tgl_berlaku]);

	  $tgl_selesai=tgl_indo3($r[tgl_selesai]);

      $tgl_knsp_trkhr=tgl_indo3($r[tgl_knsp_trkhr]);

	  $tgl_krm_net=tgl_indo3($r[tgl_krm_net]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

          echo "<td align=left>

 

$r[username]</td>";

echo "<td align=left width=50>$r[jenis_upd]</td>

	  <td align=left width=75>$r[kode_dok]</td>

	  <td align=left width=10>$r[revisi]</td>

	  <td align=left width=220>$r[judul_dok]</td>

			  

			  <td align=left width=50>

			  <form method=POST name='cariupdnet' action=?module=upd&act=update4 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>

			 <input type=text name='tgl_knsp_trkhr' size=12 value='$tgl_knsp_trkhr'></td>

			 <td align=left width=50><input type=text name='tgl_krm_net' size=12 value='$tgl_krm_net'></td>

			 <td align=left width=50><input type=text name='tgl_terima' size=12 value='$tgl_terima'>";	 



			 	 

				  if ($r[konsep1_krm]=='' or $r[konsep1_krm]=='(K/N/KN/NK)') {

echo "</td><td align=left width=75><input type=text name='konsep1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep1_krm' size=12 value='$r[konsep1_krm]'></td>";

}		

echo "<td align=center width=50>";



				 if ($tgl_konsep1==0000-00-00){

echo "<input type=text name='tgl_konsep1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep1' size=8 value='$tgl_konsep1'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k1==0000-00-00){

echo "<input type=text name='tgl_kbl_k1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k1' size=8 value='$tgl_kbl_k1'>";

}		  



echo "</td>";



  if ($r[konsep2_krm]=='' or $r[konsep2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep2_krm' size=12 value='$r[konsep2_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep2==0000-00-00){

echo "<input type=text name='tgl_konsep2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep2' size=8 value='$tgl_konsep2'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k2==0000-00-00){

echo "<input type=text name='tgl_kbl_k2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k2' size=8 value='$tgl_kbl_k2'>";

}		  

echo "</td>";

 if ($r[konsep3_krm]=='' or $r[konsep3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep3_krm' size=12 value='$r[konsep3_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep3==0000-00-00){

echo "<input type=text name='tgl_konsep3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep3' size=8 value='$tgl_konsep3'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k3==0000-00-00){

echo "<input type=text name='tgl_kbl_k3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k3' size=8 value='$tgl_kbl_k3'>";

}

  						

echo "</td>";

 if ($r[net1_krm]=='' or $r[net1_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net1_krm' size=12 value='$r[net1_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net1==0000-00-00){

echo "<input type=text name='tgl_net1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net1' size=8 value='$tgl_net1'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n1==0000-00-00){

echo "<input type=text name='tgl_kbl_n1' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n1' size=8 value='$tgl_kbl_n1'>";

}		  

echo "</td>";

 if ($r[net2_krm]=='' or $r[net2_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net2_krm' size=12 value='$r[net2_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net2==0000-00-00){

echo "<input type=text name='tgl_net2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net2' size=8 value='$tgl_net2'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n2==0000-00-00){

echo "<input type=text name='tgl_kbl_n2' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n2' size=8 value='$tgl_kbl_n2'>";

}	

echo "</td>";

 if ($r[net3_krm]=='' or $r[net3_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net3_krm' size=12 value='$r[net3_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net3==0000-00-00){

echo "<input type=text name='tgl_net3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net3' size=8 value='$tgl_net3'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n3==0000-00-00){

echo "<input type=text name='tgl_kbl_n3' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n3' size=8 value='$tgl_kbl_n3'>";

}			

echo "</td>";

if ($r[konsep4_krm]=='' or $r[konsep4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep4_krm' size=12 value='$r[konsep4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_konsep4==0000-00-00){

echo "<input type=text name='tgl_konsep4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep4' size=8 value='$tgl_konsep4'></td>";

}		



echo "<td align=center width=50>";

				 if ($tgl_kbl_k4==0000-00-00){

echo "<input type=text name='tgl_kbl_k4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k4' size=8 value='$tgl_kbl_k4'>";

}		  

								 echo "</td>";

								 

								 if ($r[konsep5_krm]=='' or $r[konsep5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep5_krm' size=12 value='$r[konsep5_krm]'></td>";

}		

echo "<td align=center width=50>";

				

							 if ($tgl_konsep5==0000-00-00){

echo "<input type=text name='tgl_konsep5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep5' size=8 value='$tgl_konsep5'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k5==0000-00-00){

echo "<input type=text name='tgl_kbl_k5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k5' size=8 value='$tgl_kbl_k5'>";

}		  

echo "</td>";

if ($r[konsep6_krm]=='' or $r[konsep6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='konsep6_krm' size=12 value='$r[konsep6_krm]'></td>";

}		

echo "<td align=center width=50>";

						

 			 if ($tgl_konsep6==0000-00-00){

echo "<input type=text name='tgl_konsep6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_konsep6' size=8 value='$tgl_konsep6'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_k6==0000-00-00){

echo "<input type=text name='tgl_kbl_k6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_k6' size=8 value='$tgl_kbl_k6'>";

}

  						

echo "</td>";

if ($r[net4_krm]=='' or $r[net4_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net4_krm' size=12 value='$r[net4_krm]'></td>";

}		

echo "<td align=center width=50>";

				 if ($tgl_net4==0000-00-00){

echo "<input type=text name='tgl_net4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net4' size=8 value='$tgl_net4'></td>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n4==0000-00-00){

echo "<input type=text name='tgl_kbl_n4' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n4' size=8 value='$tgl_kbl_n4'>";

}		  

echo "</td>";

if ($r[net5_krm]=='' or $r[net5_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net5_krm' size=12 value='$r[net5_krm]'></td>";

}		

echo "<td align=center width=50>";

							 if ($tgl_net5==0000-00-00){

echo "<input type=text name='tgl_net5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net5' size=8 value='$tgl_net5'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n5==0000-00-00){

echo "<input type=text name='tgl_kbl_n5' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n5' size=8 value='$tgl_kbl_n5'>";

}	

echo "</td>";

if ($r[net6_krm]=='' or $r[net6_krm]=='(K/N/KN/NK)') {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='(K/N/KN/NK)'>";

}

else {

echo "<td align=left width=75><input type=text name='net6_krm' size=12 value='$r[net6_krm]'></td>";

}		

echo "<td align=center width=50>";

							

 			 if ($tgl_net6==0000-00-00){

echo "<input type=text name='tgl_net6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_net6' size=8 value='$tgl_net6'>";

}		 

echo "<td align=center width=50>";

				 if ($tgl_kbl_n6==0000-00-00){

echo "<input type=text name='tgl_kbl_n6' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_kbl_n6' size=8 value='$tgl_kbl_n6'>";

}		



echo "</td>

<td><input type=text name='tgl_pending' size=12 value='$tgl_pending'></td>  

<td align=left width=50><input type=text name='tgl_terima2' size=12 value='$tgl_terima2'>";

							

echo "</td><td align=center width=50>";

							 if ($tgl_selesai==0000-00-00){

echo "<input type=text name='tgl_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_selesai' size=8 value='$tgl_selesai'>";

}		

echo "</td><td align=center width=50>";

	 if ($tgl_berlaku==0000-00-00){

echo "<input type=text name='tgl_berlaku' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_berlaku' size=8 value='$tgl_berlaku'>";

}		



echo "</td>

<td align=left width=75><input type=text name='kat_upd' size=12 value='$r[kat_upd]'></td>

<td align=left width=75><input type=text name='isi_upd' size=12 value='$r[isi_upd]'></td>	

<td align=center width=50>";



 if ($tgl_dist==0000-00-00){

echo "<input type=text name='tgl_dist' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist' size=8 value='$tgl_dist'>";

}		

echo "</td><td align=center width=50>";

 if ($tgl_dist_selesai==0000-00-00){

echo "<input type=text name='tgl_dist_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_dist_selesai' size=8 value='$tgl_dist_selesai'>";

}		

echo "</td><td align=center width=50>";

 if ($tgl_tarik_selesai==0000-00-00){

echo "<input type=text name='tgl_tarik_selesai' size=8 value=''>";

}

else {

echo "<input type=text name='tgl_tarik_selesai' size=8 value='$tgl_tarik_selesai'>";

}		

echo"</td>

<td align=left width=75><input type=text name='keterangan2' size=12 value='$r[keterangan2]'></td>";

			   

echo"<td><input type=submit value=Update></form></td></tr>";

						   

      $no++;

	   }

	      echo "</table>

		  ";



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan <br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}



elseif ($module=='upd' AND $act=='cariupd60'){



	 // menghilangkan spasi di kiri dan kanannya

$timestamp = strtotime("-8 day");

$sekarang = date("Y-m-d");

$kata=date("Y-m-d",$timestamp);



 

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Hasil Pencarian Usulan</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$kata);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "tgl_terakhir <= '$kata'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= "and status !='Tidak Jadi' and keterangan !='1' and tgl_terakhir != '0000-00-00' and status !='Pending' and status !='Follow-Up'  ORDER BY tgl_terakhir ASC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p><font size=2><b>Ditemukan <b>$tampil</b> Usulan <font style='background-color:#00FFFF'><b>Dikonfirmasi Yang lebih dari 10 hari/ 7 hari kerja (maks tanya 14 hari kerja ) : $kata , klik follow-up setelah di konfirmasi !</b></font></b></font> </p>"; 

echo "<hr color=#000890 noshade=noshade />";

echo "<p ALIGN=CENTER><font size=3><b>LAPORAN USULAN DOKUMEN</b></FONT><center>

<table width=1700>

          <tr><th>No</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Status</th><th>Kode Dokumen</th><th>Rev</th><th>Jdl Dokumen</th><th>Tgl Terakhir </th><th>Posisi Terakhir</th><th><b>Follow1ke</b></th><th><b>TglFol1</b></th><th><b>Follow2ke</b></th><th><b>TglFol2</b></th><th><b>Follow3ke</b></th><th><b>TglFol3</b></th><th>Aksi</th><th><b>Aksi</b></th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($hasil)){



	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_terakhir=tgl_indo2($r[tgl_terakhir]);

          $tgl_terima=tgl_indo2($r[tgl_terima]);



	  $follow1=tgl_indo3($r[follow1]);

	  $follow2=tgl_indo3($r[follow2]);

	  $follow3=tgl_indo3($r[follow3]);

		  



       echo "<tr><td width=10 align=center>$no</td>

 <td align=center width=30>$r[username]</td>

             <td align=left width=30>$r[jenis_upd]</td>

			              <td align=left width=30>$r[status]</td>

			 <td align=left width=55>$r[kode_dok]</td>

			 <td align=left width=10>$r[revisi]</td>

			  <td align=left>$r[judul_dok]</td>";

echo "

<td align=left width=30>$tgl_terakhir</td> 

<td align=left width=30>$r[posisi]</td>

<form method=POST action=?module=upd&act=update5 target=_blank onSubmit='return validasiupd(this)'><input type=hidden name=id_upd value=$r[id_upd]>";

	

echo"

<td align=left width=50><input type=text name='follow1ke' size=12 value='$r[follow1ke]'></td>

";

echo"

<td align=center width=50>";

	if ($follow1==0000-00-00){

echo "<input type=text name='follow1' size=8 value=''></td>";

}

else {

echo "<input type=text name='follow1' size=8 value='$follow1'></td>";

}	

echo"

<td align=left width=50><input type=text name='follow2ke' size=12 value='$r[follow2ke]'></td><td align=center width=50>

";	 

    if ($follow2==0000-00-00){

echo "<input type=text name='follow2' size=8 value=''></td>";

}

else {

echo "<input type=text name='follow2' size=8 value='$follow2'></td>";

}		 

echo"

<td align=left width=50><input type=text name='follow3ke' size=12 value='$r[follow3ke]'></td><td align=center width=50>

";	 

    if ($follow3==0000-00-00){

echo "<input type=text name='follow3' size=8 value=''>";

}

else {

echo "<input type=text name='follow3' size=8 value='$follow3'>";

}		 

						   echo "</td>

				<td align=left><a href=?module=upd&act=followupd&id=$r[id_upd] target=_blank>Follow-Up</a> | 

<a href=../../home.php?pages=upd&act=editupd&id=$r[id_upd] target=_blank>Edit</a>|<a href=?module=upd&act=pendingupd&id=$r[id_upd] target=_blank>Pending</a></td>

			 <td><input type=submit value=Update></form></td></tr>";

      $no++;

	   }

	      echo "</table>";





echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

      echo "<center><font size=2>Tidak ditemukan usulan<br>



	

	<b><a href=../../home.php?pages=upd><--Kembali</a></b>";





  }



}







elseif ($module=='upd' AND $act=='cariupd6'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata.-$kata1);

  $bln_thn =tgl_indo1($bln_thn_sekarang);

  $bln_thn1 =tgl_indo($bln_thn_sekarang);

  

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>

 

 <h2>Laporan Usulan Perubahan/ Pembuatan Dokumen</h2>";

    // pisahkan kata per kalimat lalu hitung jumlah kata

  $pisah_kata = explode(" ",$gabung);

  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1;



  

  $cari = "SELECT * FROM upd WHERE " ;

    for ($i=0; $i<=$jml_kata; $i++){

      $cari .= "reg_upd LIKE '%$pisah_kata[$i]%'";

      if ($i < $jml_kata ){

        $cari .= " OR ";

      }

    }

  $cari .= " ORDER BY tgl_upd DESC";

  $hasil  = mysql_query($cari);

  $tampil = mysql_num_rows($hasil);

   

   if ($tampil > 0){

      

echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";

echo "<p align=left><font size=2><b>Jumlah Usulan Bulan/Tahun : $kata/$kata1 (yang masuk registrasi) yaitu : $tampil dokumen</b></b></font> <br><br>"; 

  $kata = trim($_POST[kata]);

  $kata1 = trim($_POST[kata1]);

  $kata2 = trim($_POST[kata2]);

  $gabung = ($kata.-$kata1);



	      $tampi23=mysql_query("SELECT * FROM upd WHERE jenis_upd='OBS' and reg_upd LIKE '%$kata2%' and keterangan !='1' ");

  		  $tampi22=mysql_query("SELECT * FROM upd WHERE jenis_upd='UPDB' and reg_upd LIKE '%$kata2%' and keterangan !='1'");

 		  $tampi21=mysql_query("SELECT * FROM upd WHERE jenis_upd='UPD' and reg_upd LIKE '%$kata2%' and keterangan !='1'");

          $tampi20=mysql_query("SELECT * FROM upd WHERE reg_upd LIKE '%$kata2%' and keterangan !='1'");

		  $tampi19=mysql_query("SELECT * FROM upd WHERE tgl_konsep1='' and reg_upd LIKE '%$gabung%' and keterangan !='1'");

		  $tampi8=mysql_query("SELECT * FROM upd WHERE tgl_konsep1!='0000-00-00'and reg_upd LIKE '%$gabung%' and keterangan !='1'");

		  $tampi7=mysql_query("SELECT * FROM upd WHERE tgl_konsep1='0000-00-00' and reg_upd LIKE '%$gabung%' and keterangan !='1'");

		  $tampi6=mysql_query("SELECT * FROM upd WHERE status='pending' and reg_upd LIKE '%$gabung%' and keterangan !='1'");

		  $tampi5=mysql_query("SELECT * FROM upd WHERE status='konsep' and reg_upd LIKE '%$gabung%' and keterangan !='1'");

		  $tampi4=mysql_query("SELECT * FROM upd WHERE jenis_upd='UPDB' and reg_upd LIKE '%$gabung%' and keterangan !='1'");

 		  $tampi3=mysql_query("SELECT * FROM upd WHERE jenis_upd='UPD' and reg_upd LIKE '%$gabung%' and keterangan !='1'");

	 	  $tampil2=mysql_query("SELECT * FROM upd WHERE keterangan !='1' ORDER BY tgl_upd DESC");

		  $tamp=mysql_query("SELECT * FROM upd WHERE status='Konsep' and keterangan !='1' ORDER BY tgl_upd DESC");  

	  

	$jmldata3 = mysql_num_rows($tamp);

	$jmldata4 = mysql_num_rows($tampil2);

	$jmldata5 = mysql_num_rows($tampi3);

	$jmldata6 = mysql_num_rows($tampi4);

	$jmldata7 = mysql_num_rows($tampi5);

	$jmldata8 = mysql_num_rows($tampi6);

	$jmldata9 = mysql_num_rows($tampi7);

	$jmldata10 = mysql_num_rows($tampi8);

	$jmldata11 = mysql_num_rows($tampi9);

	$jmldata12 = mysql_num_rows($tampi10);

	$jmldata12a = mysql_num_rows($tampi12);

	$jmldata13 = mysql_num_rows($tampi13);

	$jmldata14 = mysql_num_rows($tampi14);

	$jmldata15 = mysql_num_rows($tampi15);

	$jmldata16 = mysql_num_rows($tampi16);

	$jmldata17 = mysql_num_rows($tampi17);

	$jmldata18 = mysql_num_rows($tampi18);

	$jmldata19 = mysql_num_rows($tampi19);

	$jmldata20 = mysql_num_rows($tampi20);

	$jmldata21 = mysql_num_rows($tampi21);

	$jmldata22 = mysql_num_rows($tampi22);

	$jmldata23 = mysql_num_rows($tampi23);

	

	$totat = $tampil-$jmldata7;

	$totat1=$jmldata7/$tampil*100;

	$totat2=$totat/$tampil*100;

	

		echo "<font size=2><b><u>Rincian Usulan yang masuk ter-registrasi Bulan/Tahun : $kata/$kata1 :</u></b> <br>";	 

		echo "<font size=2><b>UPD  : $jmldata5</b> <br>";    

		echo "<font size=2><b>UPDB : $jmldata6</b> <br>";  

		echo "<font size=2><b>Usulan Pending  : $jmldata8</b> <br>";  

		echo "<font size=2><b>Usulan yang masih konsep : $jmldata7</b> ($totat1%)<br>"; 

		echo "<font size=2><b>Usulan yang sudah Net : $totat </b> ($totat2%)<br><br>"; 

		



	  $tampil=mysql_query("SELECT * FROM upd WHERE keterangan !='1' ORDER BY id_upd DESC LIMIT $posisi,$batas");

	  $tampil2=mysql_query("SELECT * FROM upd WHERE keterangan !='1'vORDER BY tgl_upd DESC");

	  $tampi=mysql_query("SELECT * FROM upd WHERE tgl_upd='$tgl_sekarang' and keterangan !='1' ORDER BY tgl_upd DESC");

	  $tamp=mysql_query("SELECT * FROM upd WHERE status='Konsep' and keterangan !='1' ORDER BY tgl_upd DESC");  

	  

	   	$jmldata = mysql_num_rows($tampil);

		$jmldata2 = mysql_num_rows($tampi);

		$jmldata3 = mysql_num_rows($tamp);

		$jmldata4 = mysql_num_rows($tampil2);

	    $jmldata5 = $jmldata4-$jmldata3;

		

		echo "<b><u>Total Semua Usulan sejak Januari 2011 :</u></b><br>";

		echo "<b><font size=2>Total Semua Usulan : <b>$jmldata4</b><br>";

		echo "<b><font size=2>Total Usulan yang belum selesai : <b>$jmldata3</b><br>";

		echo "<b><font size=2>Total Usulan yang sudah selesai : <b>$jmldata5</b><br><br>";

		

		

		echo "<b><u>Laporan Tahunan - Total Semua Usulan Tahun /20$kata2 :</u></b><br>";

		echo "<b><font size=2>Total Semua Usulan : <b>$jmldata20</b><br>";

		echo "<b><font size=2>Total Usulan Perubahan Dokumen (UPD) : <b>$jmldata21</b><br>";

		echo "<b><font size=2>Total Usulan Pembuatan Dokumen Baru (UPDB): <b>$jmldata22</b><br>";

		echo "<b><font size=2>Total Usulan Penghapusan Dokumen dari RDT : <b>$jmldata23</b><br>";

		

		

  echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan pada bulan dan tahun tersebut<br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }



}





elseif ($module=='upd' AND $act=='caridokumenss'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);



        $tampil=mysql_query("SELECT * FROM upd WHERE username LIKE '%$kata%' AND status!='net' ORDER BY kode_dok ASC");

  

  if ($tampil > 0){



echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";



echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN YANG MASIH <u>KONSEP/PENDING</u> (SORT BY KODE DOKUMEN) <br>Bagian : $_SESSION[bagianuser] (Ctrl+F untuk mencari lebih cepat)</b></FONT><center>

<table width=1000>

          <tr><th>No</th><th>Status</th><th>Tgl Terima MR</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Judul Dokumen</th><th>Posisi terakhir</th><th>Tgl di posisi terakhir</th><th>Detail Usulan</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($tampil)){

	  $tgl_konsep1=tgl_indo3($r[tgl_konsep1]);

	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);

	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);

	  $tgl_net1=tgl_indo3($r[tgl_net1]);

	  $tgl_net2=tgl_indo3($r[tgl_net2]);

	  $tgl_net3=tgl_indo3($r[tgl_net3]);

	 	  

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

      $tgl_terima=tgl_indo2($r[tgl_terima]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

          						   

	   

echo "</td><td align=left width=50>$r[status]</td>";

echo "<td align=center width=50>$tgl_upd</td>

             <td align=center width=50>$r[username]</td>

             <td align=left width=50>$r[jenis_upd]</td>

			 <td align=left width=75>$r[kode_dok]</td>

			 			 <td align=left width=10>$r[revisi]</td>

			  <td align=left width=200>$r[judul_dok]</td>

			  

			  <td align=left width=200>$r[posisi]</td>

			  

			  <td align=left width=200>$r[tgl_terakhir]</td>

			   <td align=left width=50><a href=../../home.php?pages=upd&act=detailupd&id=$r[id_upd]>Detail</a></td>

 </tr>";

						   

      $no++;

	       

	   }

	    echo "</table>";

	     



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan konsep dengan pengusul <b>$kata</b><br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }





}



elseif ($module=='upd' AND $act=='caridokumensss'){



	 // menghilangkan spasi di kiri dan kanannya

  $kata = trim($_POST[kata]);



        $tampil=mysql_query("SELECT * FROM upd WHERE username LIKE '%$kata%' AND status='net' AND keterangan !='1' ORDER BY kode_dok ASC");

  

  if ($tampil > 0){



echo "

<html>

<head>

<title>Web Aplikasi Pengendalian Dokumen (E-Dokumen) - PT. kimia Farma Plant Banjaran</title>

<link href=../../style.css rel=stylesheet type=text/css />

</head><body>";



echo "<p ALIGN=CENTER><font size=3><b>REGISTRASI/ MONITORING CEKLIST USULAN DOKUMEN YANG SUDAH <u>NET</u> (SORT BY KODE DOKUMEN) <br>Bagian : $_SESSION[bagianuser] (Ctrl+F untuk mencari lebih cepat)</b></FONT><center>

<table width=1000>

          <tr><th>No</th><th>Status</th><th>Tgl Terima MR</th><th>Usulan Dari</th><th>Jenis Usulan</th><th>Kode Dokumen</th><th>Rev</th><th>Judul Dokumen</th><th>Detail Usulan</th><tr>"; 

		  

		     

    $no=1;

    while ($r=mysql_fetch_array($tampil)){

	  $tgl_konsep1=tgl_indo3($r[tgl_konsep1]);

	  $tgl_konsep2=tgl_indo3($r[tgl_konsep2]);

	  $tgl_konsep3=tgl_indo3($r[tgl_konsep3]);

	  $tgl_net1=tgl_indo3($r[tgl_net1]);

	  $tgl_net2=tgl_indo3($r[tgl_net2]);

	  $tgl_net3=tgl_indo3($r[tgl_net3]);

	 	  

	  $tgl_upd=tgl_indo2($r[tgl_upd]);

	  $tgl_berlaku=tgl_indo2($r[tgl_berlaku]);

      $tgl_terima=tgl_indo2($r[tgl_terima]);

	  $tgl_terakhir=tgl_indo2($r[tgl_terakhir]);

	  

       echo "<tr><td width=30 align=center>$no</td>";

	   

          						   

	   

echo "</td><td align=left width=50>$r[status]</td>";

echo "<td align=center width=50>$tgl_upd</td>

             <td align=center width=50>$r[username]</td>

             <td align=left width=50>$r[jenis_upd]</td>

			 <td align=left width=75>$r[kode_dok]</td>

			 			 <td align=left width=10>$r[revisi]</td>

			  <td align=left width=200>$r[judul_dok]</td>



			   <td align=left width=50><a href=../../home.php?pages=upd&act=detailupd&id=$r[id_upd]>Detail</a></td>

 </tr>";

						   

      $no++;

	       

	   }

	    echo "</table>";

	     



echo "

<p align=center>                     

<center><font size=2><b><a href=../../home.php?pages=upd><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";



	 }

  else{

    echo "<center><font size=2>Tidak ditemukan usulan net dengan pengusul <b>$kata</b><br><b><a href=../../home.php?pages=upd><--Kembali</a></b>";

  }





}



// Hapus upd ------------------------------------------------------------------------------------------------------------------

elseif ($module=='upd' AND $act=='hapus'){

echo "<p align=center><b>Apakah anda akan menghapus usulan ini ? <br></b>

<center><a href=$aksi?module=upd&act=hapus2&id=$_GET[id]>Ya !</a> - <a href=../../home.php?pages=upd>Tidak Jadi</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"

;

}







// Hapus upd 2 ------------------------------------------------------------------------------------------------------------------

elseif ($module=='upd' AND $act=='hapus2'){

  mysql_query("DELETE FROM upd WHERE id_upd='$_GET[id]'");

  header('location:../../home.php?pages='.$module);

}



// Duplikasi upd ------------------------------------------------------------------------------------------------------------------

elseif ($module=='upd' AND $act=='duplikasi'){



mysql_query("INSERT INTO upd ('id_upd', 'reg_upd', 'jenis_upd', 'kode_dok', 'kode_kom', 'revisi', 'judul_dok', 'id_jendok', 'tgl_upd', 'isi_upd', 'kat_upd', 'username', 'nama_file', 'cchl', 'tgl_terima', 'tgl_terima2', 'tgl_knsp_trkhr', 'tgl_krm_net', 'konsep1_krm', 'tgl_konsep1', 'tgl_kbl_k1', 'konsep2_krm', 'tgl_konsep2', 'tgl_kbl_k2', 'konsep3_krm', 'tgl_konsep3', 'tgl_kbl_k3', 'net1_krm', 'tgl_net1', 'tgl_kbl_n1', 'net2_krm', 'tgl_net2', 'tgl_kbl_n2', 'net3_krm', 'tgl_net3', 'tgl_kbl_n3', 'konsep4_krm', 'tgl_konsep4', 'tgl_kbl_k4', 'konsep5_krm', 'tgl_konsep5', 'tgl_kbl_k5', 'konsep6_krm', 'tgl_konsep6', 'tgl_kbl_k6', 'net4_krm', 'tgl_net4', 'tgl_kbl_n4', 'net5_krm', 'tgl_net5', 'tgl_kbl_n5', 'net6_krm', 'tgl_net6', 'tgl_kbl_n6', 'tgl_berlaku', 'tgl_selesai', 'tgl_dist', 'tgl_dist_selesai', 'tgl_tarik_selesai', 'status', 'keterangan', 'keterangan2', 'posisi', 'tgl_terakhir', 'follow1', 'follow2', 'follow3', 'tgl_pending', 'follow1ke', 'follow2ke', 'follow3ke', 'dok_terkait')

 VALUES ('$_POST[id_upd]', '$_POST[reg_upd]', '$_POST[jenis_upd]', '$_POST[kode_dok]', '$_POST[kode_kom]', '$_POST[revisi]', '$_POST[judul_dok]', '$_POST[id_jendok]', '$_POST[tgl_upd]', '$_POST[isi_upd]', '$_POST[kat_upd]', '$_POST[username]', '$_POST[nama_file]', '$_POST[cchl]', '$_POST[tgl_terima]', '$_POST[tgl_terima2]', '$_POST[tgl_knsp_trkhr]', '$_POST[tgl_krm_net]', '$_POST[konsep1_krm]', '$_POST[tgl_konsep1]', '$_POST[tgl_kbl_k1]', '$_POST[konsep2_krm]', '$_POST[tgl_konsep2]', '$_POST[tgl_kbl_k2]', '$_POST[konsep3_krm]', '$_POST[tgl_konsep3]', '$_POST[tgl_kbl_k3]', '$_POST[net1_krm]', '$_POST[tgl_net1]', '$_POST[tgl_kbl_n1]', '$_POST[net2_krm]', '$_POST[tgl_net2]', '$_POST[tgl_kbl_n2]', '$_POST[net3_krm]', '$_POST[tgl_net3]', '$_POST[tgl_kbl_n3]', '$_POST[konsep4_krm]', '$_POST[tgl_konsep4]', '$_POST[tgl_kbl_k4]', '$_POST[konsep5_krm]', '$_POST[tgl_konsep5]', '$_POST[tgl_kbl_k5]', '$_POST[konsep6_krm]', '$_POST[tgl_konsep6]', '$_POST[tgl_kbl_k6]', '$_POST[net4_krm]', '$_POST[tgl_net4]', '$_POST[tgl_kbl_n4]', '$_POST[net5_krm]', '$_POST[tgl_net5]', '$_POST[tgl_kbl_n5]', '$_POST[net6_krm]', '$_POST[tgl_net6]', '$_POST[tgl_kbl_n6]', '$_POST[tgl_berlaku]', '$_POST[tgl_selesai]', '$_POST[tgl_dist]', '$_POST[tgl_dist_selesai]', '$_POST[tgl_tarik_selesai]', '$_POST[status]', '$_POST[keterangan]', '$_POST[keterangan2]', '$_POST[posisi]', '$_POST[tgl_terakhir]', '$_POST[follow1]', '$_POST[follow2]', '$_POST[follow3]', '$_POST[tgl_pending]', '$_POST[follow1ke]', '$_POST[follow2ke]', '$_POST[follow3ke]', '$_POST[dok_terkait]') ");

					   

 echo "<p align=center><b>Usulan telah diduplikasi !</b><br><a href=../../home.php?pages=upd>Kembali</a></p>";	

 }



// Input tambah upd ------------------------------------------------------------------------------------------------------------------

elseif ($module=='upd' AND $act=='input'){



$tgl_sekarang1=tgl_indo4(date("Y-m")); 

$tgl_sekarang = date("Y-m-d");

$jenis = $_POST['jenis_upd'];



if ($_POST['jenis_upd']=="UPD"){

$jenis1 = R . $tgl_sekarang1 ;

}

elseif ($_POST['jenis_upd']=="UPDB"){

$jenis1 = B . $tgl_sekarang1;

}

elseif ($_POST['jenis_upd']=="OBS"){

$jenis1 = O . $tgl_sekarang1 ;

}



$query = "SELECT max(reg_upd) as maxreg_upd FROM upd WHERE reg_upd LIKE '$jenis1%'";

$hasil = mysql_query($query);

$data  = mysql_fetch_array($hasil);

$idMax = $data['maxreg_upd'];

$noUrut = (int) substr($idMax, 7, 4);

$noUrut++;

if ($jenis=="UPD"){

$newID = R . $tgl_sekarang1. sprintf("/%04s", $noUrut);

}

elseif ($jenis=="UPDB"){

$newID = B . $tgl_sekarang1. sprintf("/%04s", $noUrut);

}

elseif ($jenis=="OBS"){

$newID = O . $tgl_sekarang1. sprintf("/%04s", $noUrut);

}





 if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }



  $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];



 

	$lihat = mysql_query("SELECT * FROM upd WHERE kode_dok='$_POST[kode_dok]' AND revisi='$_POST[revisi]' ORDER BY tgl_upd");

	$lihat2 = mysql_num_rows($lihat);

	 if ($lihat2 > 0){

	 echo "<font size=6><center>Usulan dengan kode dokumen dan revisi tersebut sudah pernah dibuat, mohon dicek dahulu di registrasi usulan (Klik tombol Back/kembali) <br><img src='../../images/bagus.gif'><br><a href=../../home.php?pages=upd>Kembali</a></font></center>";}

	 else {

	 

	  

	  

if ($_POST['jenis_upd']=="UPD"){

$tgl_sekarang = date("Y-m-d");

if (!empty($lokasi_file)){

    UploadFile($nama_file);



	mysql_query("INSERT INTO upd(jenis_upd,

                                    reg_upd,

									judul_dok,

                                    kode_dok,

									kode_kom,

									pj_dok,

									dok_terkait,

									revisi,

									id_jendok,

									tgl_upd,

									tgl_terima,								

									kat_upd,

									isi_upd,

									username,

									posisi,

									keterangan,

									keterangan2,

									nama_file,

									cchl) 

                            VALUES('$_POST[jenis_upd]','$newID','$_POST[judul_dok]','$_POST[kode_dok]','$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]','$_POST[revisi]','$_POST[id_jendok]','$tgl_sekarang','$tgl_sekarang','$_POST[kat_upd]','$_POST[isi_upd]', '$_POST[username], $_POST[username2]','MR.','$_POST[keterangan]','$_POST[keterangan2]','$nama_file','$tag')");

							

							

  }

  else{

   mysql_query("INSERT INTO upd(jenis_upd,

                                    reg_upd,

									judul_dok,

                                    kode_dok,

									kode_kom,

									pj_dok,

									dok_terkait,

									revisi,

									id_jendok,

									tgl_upd,

									tgl_terima,		

									kat_upd,

									isi_upd,

									username,

									posisi,

									keterangan,

									keterangan2,

									cchl) 

                            VALUES('$_POST[jenis_upd]','$newID','$_POST[judul_dok]','$_POST[kode_dok]','$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]','$_POST[revisi]','$_POST[id_jendok]','$tgl_sekarang','$tgl_sekarang','$_POST[kat_upd]','$_POST[isi_upd]', '$_POST[username], $_POST[username2]','MR.','$_POST[keterangan]','$_POST[keterangan2]','$tag')");

  }

$tag_new = $_POST[cchl];

$tag=implode(', ',$tag_new);

echo "<center><p align=center><b>Usulan telah dibuat ! 

<form method=POST action=/security1/pdf_upd.php target=_blank>

<input type=hidden name='kode_dok' size=20 value='$_POST[kode_dok]'>

<input type=hidden name='username' size=20 value='$_POST[username2]'>

<input type=hidden name='judul_dok' size=20 value='$_POST[judul_dok]'>

<input type=hidden name='revisi' size=20 value='$_POST[revisi]'>

<input type=hidden name='isi_upd' size=20 value='$_POST[isi_upd]'>

<input type=hidden name='reg_upd' size=20 value='$newID'>

<input type=hidden name='cchl' size=20 value='$tag'>

<input type=submit value='Klik disini untuk Print UPD-NYA'>

</form>";

echo "

<br><br>

<form method=post action=$aksi1?module=upd&act=input_reg>

No. Registrasi Usulan: <input type=hidden name=kode_dok value=$_POST[kode_dok]><input type=hidden name=reg_upd value=$newID>$newID<br><img src='../../images/bagus.gif'><br><input type=submit name=submit value='Klik Disini untuk menyelesaikan usulan !!!'>

</form>

 </b></center></p>";

}



elseif ($jenis=="UPDB"){

$tag_new = $_POST[cchl];

$tgl_sekarang = date("Y-m-d");

$tag=implode(', ',$tag_new);

$lihatdoku = mysql_query("SELECT * FROM dokumen WHERE kode_dok = '$_POST[kode_dok]' ");

$lihatdoku2 = mysql_num_rows($lihatdoku);

if ($lihatdoku2 > 0){

	 echo "<font size=6><center>Kode Dokumen Double!, mohon dicek dahulu di registrasi dokumen! <br><img src='../../images/bagus.gif'><br><a href=../../home.php?pages=upd>Kembali</a></font></center>";}

	 else {





if (!empty($lokasi_file)){

    UploadFile($nama_file);

	mysql_query("INSERT INTO upd(jenis_upd,

                                    reg_upd,

									judul_dok,

                                    kode_dok,

									kode_kom,

									pj_dok,

									dok_terkait,

									revisi,

									id_jendok,

									tgl_upd,

									tgl_terima,

									kat_upd,

									isi_upd,

									username,

									posisi,

									keterangan,

									keterangan2,

									nama_file,

									cchl) 

                            VALUES('$_POST[jenis_upd]','$newID','$_POST[judul_dok]','$_POST[kode_dok]','$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]','$_POST[revisi]','$_POST[id_jendok]','$tgl_sekarang','$tgl_sekarang','$_POST[kat_upd]','$_POST[isi_upd]', '$_POST[username], $_POST[username2]','MR.','$_POST[keterangan]','$_POST[keterangan2]','$nama_file','$tag')");

							

							

  }

  else{

   mysql_query("INSERT INTO upd(jenis_upd,

                                    reg_upd,

									judul_dok,

                                    kode_dok,

									kode_kom,

									pj_dok,

									dok_terkait,

									revisi,

									id_jendok,

									tgl_upd,

									tgl_terima,

									kat_upd,

									isi_upd,

									username,

									posisi,

									keterangan,

									keterangan2,

									cchl) 

                            VALUES('$_POST[jenis_upd]','$newID','$_POST[judul_dok]','$_POST[kode_dok]','$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]','$_POST[revisi]','$_POST[id_jendok]','$tgl_sekarang','$tgl_sekarang','$_POST[kat_upd]','$_POST[isi_upd]', '$_POST[username], $_POST[username2]','MR.','$_POST[keterangan]','$_POST[keterangan2]','$tag')");

  }



echo "<center><p align=center><b>Usulan telah dibuat !

<form method=POST action=/security1/pdf_updb.php target=_blank>

<input type=hidden name='kode_dok' size=20 value='$_POST[kode_dok]'>

<input type=hidden name='username' size=20 value='$_POST[username]'>

<input type=hidden name='judul_dok' size=20 value='$_POST[judul_dok]'>

<input type=hidden name='revisi' size=20 value='$_POST[revisi]'>

<input type=hidden name='isi_upd' size=20 value='$_POST[isi_upd]'>

<input type=hidden name='reg_upd' size=20 value='$newID'>

<input type=hidden name='cchl' size=20 value='$tag'>

<input type=submit value='Klik disini untuk Print UPDB-NYA'>

</form>";

echo "

<br><br>

<form method=post action=$aksi1?module=upd&act=input_reg>

No. Registrasi Usulan: <input type=hidden name=kode_dok value=$_POST[kode_dok]><input type=hidden name=reg_upd value=$newID>$newID<br><img src='../../images/bagus.gif'><br><input type=submit name=submit value='Klik Disini untuk menyelesaikan usulan !!!'>

</form>

 </b></center></p>";

}

}

}



if ($_POST['jenis_upd']=="OBS"){

$tgl_sekarang = date("Y-m-d");

if (!empty($lokasi_file)){

    UploadFile($nama_file);

	mysql_query("INSERT INTO upd(jenis_upd,

									reg_upd,

                                    judul_dok,

                                    kode_dok,

									kode_kom,

									pj_dok,

									dok_terkait,

									revisi,

									id_jendok,

									tgl_upd,

									tgl_terima,								

									kat_upd,

									isi_upd,

									username,

									posisi,

									keterangan,

									keterangan2,

									nama_file,

									cchl) 

                            VALUES('$_POST[jenis_upd]','$newID','$_POST[judul_dok]','$_POST[kode_dok]','$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]','$_POST[revisi]','$_POST[id_jendok]','$tgl_sekarang','$tgl_sekarang','$_POST[kat_upd]','$_POST[isi_upd]', '$_POST[username], $_POST[username2]','MR.','$_POST[keterangan]','$_POST[keterangan2]','$nama_file','$tag')");

							

							

  }

  else{

   mysql_query("INSERT INTO upd(jenis_upd,

   									reg_upd,

                                    judul_dok,

                                    kode_dok,

									kode_kom,

									pj_dok,

									dok_terkait,

									revisi,

									id_jendok,

									tgl_upd,

									tgl_terima,								

									kat_upd,

									isi_upd,

									username,

									posisi,

									keterangan,

									keterangan2,

									cchl) 

                            VALUES('$_POST[jenis_upd]','$newID','$_POST[judul_dok]','$_POST[kode_dok]','$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]','$_POST[revisi]','$_POST[id_jendok]','$tgl_sekarang','$tgl_sekarang','$_POST[kat_upd]','$_POST[isi_upd]', '$_POST[username], $_POST[username2]','MR.','$_POST[keterangan]','$_POST[keterangan2]','$tag')");

  }

echo "<p align=center><b>Permohonan telah dibuat !<br>Untuk Print Lembar Permohonan Penghapusan Dokumen <a href='/security1/pdf_uod.php' target=_blank>Klik Disini</a> ";

echo "

<br><br><center>

<form method=post action=$aksi1?module=upd&act=input_reg>

No. Registrasi Usulan: <input type=hidden name=kode_dok value=$_POST[kode_dok]><input type=hidden name=reg_upd value=$newID>$newID<br><img src='../../images/bagus.gif'><br><input type=submit name=submit value='Klik Disini untuk menyelesaikan usulan !!!'>

</form>

 </b></center></p>";

 

}

}



// Update reg upd

elseif ($module=='upd' AND $act=='input_reg'){



  header('location:../../home.php?pages='.$module);

}

  

/* Update reg upd

elseif ($module=='upd' AND $act=='input_reg'){

$reg_upd = $_POST['reg_upd'];

$kode_dok = $_POST['kode_dok'];

$tgl_upd = $_POST['tgl_upd'];



$lihatreg = mysql_query("SELECT * FROM upd WHERE reg_upd = '$reg_upd' ");

$lihatreg2 = mysql_num_rows($lihatreg);

if ($lihatreg2 > 0){

	 echo "<font size=6><center>Nomor Registrasi Usulan double!, mohon dicek dahulu di registrasi usulan! <br><img src='../../images/bagus.gif'><br><a href=../../home.php?pages=upd>Kembali</a></font></center>";}

	 else {

  mysql_query("UPDATE upd SET reg_upd  = '$reg_upd' WHERE kode_dok = '$kode_dok' ");

}



  header('location:../../home.php?pages='.$module);

}

*/ 

  

// Update upd

elseif ($module=='upd' AND $act=='update'){



  $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

  

  if (empty($lokasi_file)){

  mysql_query("UPDATE upd SET    tgl_terima    = '$_POST[tgl_terima]',

  								 reg_upd    = '$_POST[reg_upd]',

								 username    = '$_POST[username]',

								 status    = '$_POST[status]',

								 jenis_upd  = '$_POST[jenis_upd]',

								 kode_dok  = '$_POST[kode_dok]',

								 kode_kom  = '$_POST[kode_kom]',

								 pj_dok  = '$_POST[pj_dok]',

								 dok_terkait  = '$_POST[dok_terkait]',

								 revisi  = '$_POST[revisi]',

								 judul_dok  = '$_POST[judul_dok]',

								 id_jendok  = '$_POST[id_jendok]',

								 cchl  = '$_POST[cchl]',

								 isi_upd  = '$_POST[isi_upd]',

								 konsep1_krm  = '$_POST[konsep1_krm]',

                                 tgl_konsep1   = '$_POST[tgl_konsep1]',

                                 tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 konsep2_krm  = '$_POST[konsep2_krm]',

                                 tgl_konsep2   = '$_POST[tgl_konsep2]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 konsep3_krm  = '$_POST[konsep3_krm]',

                                 tgl_konsep3   = '$_POST[tgl_konsep3]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

                                 net1_krm  = '$_POST[net1_krm]',

                                 tgl_net1   = '$_POST[tgl_net1]',

                                 tgl_kbl_n1   = '$_POST[tgl_kbl_n1]',

                                 net2_krm  = '$_POST[net2_krm]',

                                 tgl_net2   = '$_POST[tgl_net2]',

                                 tgl_kbl_n2   = '$_POST[tgl_kbl_n2]',

                                 net3_krm  = '$_POST[net3_krm]',

                                 tgl_net3   = '$_POST[tgl_net3]',

                                 tgl_kbl_n3   = '$_POST[tgl_kbl_n3]',

 								 konsep4_krm  = '$_POST[konsep4_krm]',

                                 tgl_konsep4   = '$_POST[tgl_konsep4]',

                                 tgl_kbl_k4   = '$_POST[tgl_kbl_k4]',

                                 konsep5_krm  = '$_POST[konsep5_krm]',

                                 tgl_konsep5   = '$_POST[tgl_konsep5]',

                                 tgl_kbl_k5   = '$_POST[tgl_kbl_k5]',

                                 konsep6_krm  = '$_POST[konsep6_krm]',

                                 tgl_konsep6   = '$_POST[tgl_konsep6]',

                                 tgl_kbl_k6   = '$_POST[tgl_kbl_k6]',

                                 net4_krm  = '$_POST[net4_krm]',

                                 tgl_net4   = '$_POST[tgl_net4]',

                                 tgl_kbl_n4   = '$_POST[tgl_kbl_n4]',

                                 net5_krm  = '$_POST[net5_krm]',

                                 tgl_net5   = '$_POST[tgl_net5]',

                                 tgl_kbl_n5   = '$_POST[tgl_kbl_n5]',

                                 net6_krm  = '$_POST[net6_krm]',

                                 tgl_net6   = '$_POST[tgl_net6]',

                                 tgl_kbl_n6   = '$_POST[tgl_kbl_n6]',

								 tgl_knsp_trkhr   = '$_POST[tgl_knsp_trkhr]',

								 tgl_krm_net   = '$_POST[tgl_krm_net]',

                                 tgl_berlaku   = '$_POST[tgl_berlaku]',

								 kat_upd   = '$_POST[kat_upd]',

								 tgl_dist   = '$_POST[tgl_dist]',

								 kat_upd   = '$_POST[kat_upd]',

                                 tgl_dist_selesai   = '$_POST[tgl_dist_selesai]',

								 tgl_tarik_selesai   = '$_POST[tgl_tarik_selesai]',

								 posisi = '$_POST[posisi]',

								 tgl_terakhir   = '$_POST[tgl_terakhir]',

								 follow1   = '$_POST[follow1]',

								 follow2   = '$_POST[follow2]',

								 follow3   = '$_POST[follow3]',

								 follow1ke   = '$_POST[follow1ke]',

								 follow2ke   = '$_POST[follow2ke]',

								 follow3ke   = '$_POST[follow3ke]',

								 tgl_pending = '$_POST[tgl_pending]',

								 tgl_terima2 = '$_POST[tgl_terima2]',

                                 keterangan   = '$_POST[keterangan]',

                                 keterangan2   = '$_POST[keterangan2]'

                           WHERE id_upd   = '$_POST[id_upd]'");

   }

  else{

    UploadFile($nama_file);

	  mysql_query("UPDATE upd SET    tgl_terima    = '$_POST[tgl_terima]',

  								 reg_upd    = '$_POST[reg_upd]',

								 username    = '$_POST[username]',

								 status    = '$_POST[status]',

								 jenis_upd  = '$_POST[jenis_upd]',

								 kode_dok  = '$_POST[kode_dok]',

								 kode_kom  = '$_POST[kode_kom]',

								 pj_dok  = '$_POST[pj_dok]',

								 dok_terkait  = '$_POST[dok_terkait]',

								 revisi  = '$_POST[revisi]',

								 judul_dok  = '$_POST[judul_dok]',

								 id_jendok  = '$_POST[id_jendok]',

								 cchl  = '$_POST[cchl]',

								 nama_file   = '$nama_file',

								 isi_upd  = '$_POST[isi_upd]',

							     konsep1_krm  = '$_POST[konsep1_krm]',

                                 tgl_konsep1   = '$_POST[tgl_konsep1]',

                                 tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 konsep2_krm  = '$_POST[konsep2_krm]',

                                 tgl_konsep2   = '$_POST[tgl_konsep2]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 konsep3_krm  = '$_POST[konsep3_krm]',

                                 tgl_konsep3   = '$_POST[tgl_konsep3]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

                                 net1_krm  = '$_POST[net1_krm]',

                                 tgl_net1   = '$_POST[tgl_net1]',

                                 tgl_kbl_n1   = '$_POST[tgl_kbl_n1]',

                                 net2_krm  = '$_POST[net2_krm]',

                                 tgl_net2   = '$_POST[tgl_net2]',

                                 tgl_kbl_n2   = '$_POST[tgl_kbl_n2]',

                                 net3_krm  = '$_POST[net3_krm]',

                                 tgl_net3   = '$_POST[tgl_net3]',

                                 tgl_kbl_n3   = '$_POST[tgl_kbl_n3]',

 								 konsep4_krm  = '$_POST[konsep4_krm]',

                                 tgl_konsep4   = '$_POST[tgl_konsep4]',

                                 tgl_kbl_k4   = '$_POST[tgl_kbl_k4]',

                                 konsep5_krm  = '$_POST[konsep5_krm]',

                                 tgl_konsep5   = '$_POST[tgl_konsep5]',

                                 tgl_kbl_k5   = '$_POST[tgl_kbl_k5]',

                                 konsep6_krm  = '$_POST[konsep6_krm]',

                                 tgl_konsep6   = '$_POST[tgl_konsep6]',

                                 tgl_kbl_k6   = '$_POST[tgl_kbl_k6]',

                                 net4_krm  = '$_POST[net4_krm]',

                                 tgl_net4   = '$_POST[tgl_net4]',

                                 tgl_kbl_n4   = '$_POST[tgl_kbl_n4]',

                                 net5_krm  = '$_POST[net5_krm]',

                                 tgl_net5   = '$_POST[tgl_net5]',

                                 tgl_kbl_n5   = '$_POST[tgl_kbl_n5]',

                                 net6_krm  = '$_POST[net6_krm]',

                                 tgl_net6   = '$_POST[tgl_net6]',

                                 tgl_kbl_n6   = '$_POST[tgl_kbl_n6]',

								 tgl_knsp_trkhr   = '$_POST[tgl_knsp_trkhr]',

								 tgl_krm_net   = '$_POST[tgl_krm_net]',

                                 tgl_berlaku   = '$_POST[tgl_berlaku]',

								 tgl_dist   = '$_POST[tgl_dist]',

								 kat_upd   = '$_POST[kat_upd]',

                                 tgl_dist_selesai   = '$_POST[tgl_dist_selesai]',

								 tgl_tarik_selesai   = '$_POST[tgl_tarik_selesai]',

								 posisi = '$_POST[posisi]',

								 tgl_terakhir   = '$_POST[tgl_terakhir]',

								 follow1   = '$_POST[follow1]',

								 follow2   = '$_POST[follow2]',

								 follow3   = '$_POST[follow3]',

								 follow1ke   = '$_POST[follow1ke]',

								 follow2ke   = '$_POST[follow2ke]',

								 follow3ke   = '$_POST[follow3ke]',

								 tgl_pending = '$_POST[tgl_pending]',

								 tgl_terima2 = '$_POST[tgl_terima2]',

                                 keterangan   = '$_POST[keterangan]',

                                 keterangan2   = '$_POST[keterangan2]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   }

						   

 echo "<p align=center><b>Usulan telah anda edit !</b><br><a href=../../home.php?pages=upd>Kembali</a></p>";	

}



// Update upd 2

elseif ($module=='upd' AND $act=='update2'){



  mysql_query("UPDATE upd SET    konsep1_krm  = '$_POST[konsep1_krm]',

                                 tgl_konsep1   = '$_POST[tgl_konsep1]',

                                 tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 konsep2_krm  = '$_POST[konsep2_krm]',

                                 tgl_konsep2   = '$_POST[tgl_konsep2]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 konsep3_krm  = '$_POST[konsep3_krm]',

                                 tgl_konsep3   = '$_POST[tgl_konsep3]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

                                 net1_krm  = '$_POST[net1_krm]',

                                 tgl_net1   = '$_POST[tgl_net1]',

                                 tgl_kbl_n1   = '$_POST[tgl_kbl_n1]',

                                 net2_krm  = '$_POST[net2_krm]',

                                 tgl_net2   = '$_POST[tgl_net2]',

                                 tgl_kbl_n2   = '$_POST[tgl_kbl_n2]',

                                 net3_krm  = '$_POST[net3_krm]',

                                 tgl_net3   = '$_POST[tgl_net3]',

                                 tgl_kbl_n3   = '$_POST[tgl_kbl_n3]',

								 konsep4_krm  = '$_POST[konsep4_krm]',

                                 tgl_konsep4   = '$_POST[tgl_konsep4]',

                                 tgl_kbl_k4   = '$_POST[tgl_kbl_k4]',

                                 konsep5_krm  = '$_POST[konsep5_krm]',

                                 tgl_konsep5   = '$_POST[tgl_konsep5]',

                                 tgl_kbl_k5   = '$_POST[tgl_kbl_k5]',

                                 konsep6_krm  = '$_POST[konsep6_krm]',

                                 tgl_konsep6   = '$_POST[tgl_konsep6]',

                                 tgl_kbl_k6   = '$_POST[tgl_kbl_k6]',

                                 net4_krm  = '$_POST[net4_krm]',

                                 tgl_net4   = '$_POST[tgl_net4]',

                                 tgl_kbl_n4   = '$_POST[tgl_kbl_n4]',

                                 net5_krm  = '$_POST[net5_krm]',

                                 tgl_net5   = '$_POST[tgl_net5]',

                                 tgl_kbl_n5   = '$_POST[tgl_kbl_n5]',

                                 net6_krm  = '$_POST[net6_krm]',

                                 tgl_net6   = '$_POST[tgl_net6]',

                                 tgl_kbl_n6   = '$_POST[tgl_kbl_n6]',

								 tgl_knsp_trkhr   = '$_POST[tgl_knsp_trkhr]',

								 tgl_krm_net   = '$_POST[tgl_krm_net]',

                                 tgl_terima   = '$_POST[tgl_terima]',

                                 tgl_berlaku   = '$_POST[tgl_berlaku]',

								 tgl_selesai   = '$_POST[tgl_selesai]',

								 tgl_dist   = '$_POST[tgl_dist]',

								 posisi   = '$_POST[posisi]',

								 keterangan   = '$_POST[keterangan]',

								 keterangan2   = '$_POST[keterangan2]',

								 tgl_upd   = '$_POST[tgl_upd]',

								 kat_upd   = '$_POST[kat_upd]',

								 isi_upd   = '$_POST[isi_upd]',

								 tgl_terakhir   = '$_POST[tgl_terakhir]',

								 follow1   = '$_POST[follow1]',

								 follow2   = '$_POST[follow2]',

								 follow3   = '$_POST[follow3]',

								 follow1ke   = '$_POST[follow1ke]',

								 follow2ke   = '$_POST[follow2ke]',

								 follow3ke   = '$_POST[follow3ke]',

								 tgl_pending = '$_POST[tgl_pending]',

								 tgl_terima2 = '$_POST[tgl_terima2]',

                                 tgl_dist_selesai   = '$_POST[tgl_dist_selesai]',

								 tgl_tarik_selesai   = '$_POST[tgl_tarik_selesai]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Update upd 4

elseif ($module=='upd' AND $act=='update4'){



  mysql_query("UPDATE upd SET    konsep1_krm  = '$_POST[konsep1_krm]',

                                 tgl_konsep1   = '$_POST[tgl_konsep1]',

                                 tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 konsep2_krm  = '$_POST[konsep2_krm]',

                                 tgl_konsep2   = '$_POST[tgl_konsep2]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 konsep3_krm  = '$_POST[konsep3_krm]',

                                 tgl_konsep3   = '$_POST[tgl_konsep3]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

                                 net1_krm  = '$_POST[net1_krm]',

                                 tgl_net1   = '$_POST[tgl_net1]',

                                 tgl_kbl_n1   = '$_POST[tgl_kbl_n1]',

                                 net2_krm  = '$_POST[net2_krm]',

                                 tgl_net2   = '$_POST[tgl_net2]',

                                 tgl_kbl_n2   = '$_POST[tgl_kbl_n2]',

                                 net3_krm  = '$_POST[net3_krm]',

                                 tgl_net3   = '$_POST[tgl_net3]',

                                 tgl_kbl_n3   = '$_POST[tgl_kbl_n3]',

								 konsep4_krm  = '$_POST[konsep4_krm]',

                                 tgl_konsep4   = '$_POST[tgl_konsep4]',

                                 tgl_kbl_k4   = '$_POST[tgl_kbl_k4]',

                                 konsep5_krm  = '$_POST[konsep5_krm]',

                                 tgl_konsep5   = '$_POST[tgl_konsep5]',

                                 tgl_kbl_k5   = '$_POST[tgl_kbl_k5]',

                                 konsep6_krm  = '$_POST[konsep6_krm]',

                                 tgl_konsep6   = '$_POST[tgl_konsep6]',

                                 tgl_kbl_k6   = '$_POST[tgl_kbl_k6]',

                                 net4_krm  = '$_POST[net4_krm]',

                                 tgl_net4   = '$_POST[tgl_net4]',

                                 tgl_kbl_n4   = '$_POST[tgl_kbl_n4]',

                                 net5_krm  = '$_POST[net5_krm]',

                                 tgl_net5   = '$_POST[tgl_net5]',

                                 tgl_kbl_n5   = '$_POST[tgl_kbl_n5]',

                                 net6_krm  = '$_POST[net6_krm]',

                                 tgl_net6   = '$_POST[tgl_net6]',

                                 tgl_kbl_n6   = '$_POST[tgl_kbl_n6]',

                                 tgl_terima   = '$_POST[tgl_terima]',

								 tgl_selesai   = '$_POST[tgl_selesai]',

                                 tgl_berlaku   = '$_POST[tgl_berlaku]',

                                 tgl_dist_selesai   = '$_POST[tgl_dist_selesai]',

								 tgl_tarik_selesai   = '$_POST[tgl_tarik_selesai]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Update upd 451

elseif ($module=='upd' AND $act=='update451'){



  mysql_query("UPDATE upd SET    konsep1_krm  = '$_POST[konsep1_krm]',

                                 tgl_konsep1   = '$_POST[tgl_konsep1]',

                                 tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 konsep2_krm  = '$_POST[konsep2_krm]',

                                 tgl_konsep2   = '$_POST[tgl_konsep2]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 konsep3_krm  = '$_POST[konsep3_krm]',

                                 tgl_konsep3   = '$_POST[tgl_konsep3]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

                                 net1_krm  = '$_POST[net1_krm]',

                                 tgl_net1   = '$_POST[tgl_net1]',

                                 tgl_kbl_n1   = '$_POST[tgl_kbl_n1]',

                                 net2_krm  = '$_POST[net2_krm]',

                                 tgl_net2   = '$_POST[tgl_net2]',

                                 tgl_kbl_n2   = '$_POST[tgl_kbl_n2]',

                                 net3_krm  = '$_POST[net3_krm]',

                                 tgl_net3   = '$_POST[tgl_net3]',

                                 tgl_kbl_n3   = '$_POST[tgl_kbl_n3]',

								 konsep4_krm  = '$_POST[konsep4_krm]',

                                 tgl_konsep4   = '$_POST[tgl_konsep4]',

                                 tgl_kbl_k4   = '$_POST[tgl_kbl_k4]',

                                 konsep5_krm  = '$_POST[konsep5_krm]',

                                 tgl_konsep5   = '$_POST[tgl_konsep5]',

                                 tgl_kbl_k5   = '$_POST[tgl_kbl_k5]',

                                 konsep6_krm  = '$_POST[konsep6_krm]',

                                 tgl_konsep6   = '$_POST[tgl_konsep6]',

                                 tgl_kbl_k6   = '$_POST[tgl_kbl_k6]',

                                 net4_krm  = '$_POST[net4_krm]',

                                 tgl_net4   = '$_POST[tgl_net4]',

                                 tgl_kbl_n4   = '$_POST[tgl_kbl_n4]',

                                 net5_krm  = '$_POST[net5_krm]',

                                 tgl_net5   = '$_POST[tgl_net5]',

                                 tgl_kbl_n5   = '$_POST[tgl_kbl_n5]',

                                 net6_krm  = '$_POST[net6_krm]',

                                 tgl_net6   = '$_POST[tgl_net6]',

                                 tgl_kbl_n6   = '$_POST[tgl_kbl_n6]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Update upd 452

elseif ($module=='upd' AND $act=='update452'){



if ($_POST[kata2]=='tgl_terima') {

	

	$trm=$r[tgl_terima];

	$trm_name='tgl_terima';

	$krm=$r[tgl_konsep1];

	$name='tgl_konsep1';

	$krm1=$r[konsep1_krm];

	$name1='konsep1_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_k1') {

	

	$trm=$r[tgl_kbl_k1];

	$trm_name='tgl_kbl_k1';

	$krm=$r[tgl_konsep2];

	$name='tgl_konsep2';

	$krm1=$r[konsep2_krm];

	$name1='konsep2_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_k2') {

	

	$trm=$r[tgl_kbl_k2];

	$trm_name='tgl_kbl_k2';

	$krm=$r[tgl_konsep3];

	$name='tgl_konsep3';

	$krm1=$r[konsep3_krm];

	$name1='konsep3_krm';



}

elseif ($_POST[kata2]=='tgl_kbl_k3') {

	

	$trm=$r[tgl_kbl_k3];

	$trm_name='tgl_kbl_k3';

	$krm=$r[tgl_net1];

	$name='tgl_net1';

	$krm1=$r[net1_krm];

	$name1='net1_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_n1') {

	

	$trm=$r[tgl_kbl_n1];

	$trm_name='tgl_kbl_n1';

	$krm=$r[tgl_net2];

	$name='tgl_net2';

	$krm1=$r[net2_krm];

	$name1='net2_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_n2') {

	

	$trm=$r[tgl_kbl_n2];

	$trm_name='tgl_kbl_n2';

	$krm=$r[tgl_net3];

	$name='tgl_net3';

	$krm1=$r[net3_krm];

	$name1='net3_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_n3') {

	

	$trm=$r[tgl_kbl_n3];

	$trm_name='tgl_kbl_n3';

	$krm=$r[tgl_konsep4];

	$name='tgl_konsep4';

	$krm1=$r[konsep4_krm];

	$name1='konsep4_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_k4') {

	

	$trm=$r[tgl_kbl_k4];

	$trm_name='tgl_kbl_k4';

	$krm=$r[tgl_konsep5];

	$name='tgl_konsep5';

	$krm1=$r[konsep5_krm];

	$name1='konsep5_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_k5') {

	

	$trm=$r[tgl_kbl_k5];

	$trm_name='tgl_kbl_k5';

	$krm=$r[tgl_konsep6];

	$name='tgl_konsep6';

	$krm1=$r[konsep6_krm];

	$name1='konsep6_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_k6') {

	

	$trm=$r[tgl_kbl_k6];

	$trm_name='tgl_kbl_k6';

	$krm=$r[tgl_net4];

	$name='tgl_net4';

	$krm1=$r[net4_krm];

	$name1='net4_krm';

}

elseif ($_POST[kata2]=='tgl_kbl_n4') {

	

	$trm=$r[tgl_kbl_n4];

	$trm_name='tgl_kbl_n4';

	$krm=$r[tgl_net5];

	$name='tgl_net5';

	$krm1=$r[net5_krm];

	$name1='net5_krm';



}

elseif ($_POST[kata2]=='tgl_kbl_n5') {

	

	$trm=$r[tgl_kbl_n5];

	$trm_name='tgl_kbl_n5';

	$krm=$r[tgl_net6];

	$name='tgl_net6';

	$krm1=$r[net6_krm];

	$name1='net6_krm';



}

else {}



  mysql_query("UPDATE upd SET    $trm_name  = '$_POST[trm]',

                                 $name   = '$_POST[krm]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Update upd 3 xxxxxxxxxxxx tidak dipakai untuk tgl kembali dari user secara elektronik

elseif ($module=='upd' AND $act=='update3'){



  $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

  

   	

	 

  if (empty($lokasi_file)){

	 mysql_query("UPDATE upd SET tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

								 keterangan2 = '$_POST[keterangan2]'

                                  

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

						  						

   }

  else{

    UploadFile($nama_file);

	 mysql_query("UPDATE upd SET tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

								 nama_file   = '$nama_file',

								 keterangan2 = '$_POST[keterangan2]'

                                  

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

    }



mysql_query("INSERT INTO hubungi(nama, subjek, pesan, tanggal) 

                        VALUES('$_POST[pengusul]','$_POST[konsep] - $_POST[kode_dok]','$_POST[pengusul] telah mengirimkan kembali $_POST[konsep] Kode Dok: $_POST[kode_dok] ke MR No Reg :  $_POST[reg_upd] file-nya <a href=../file_upd/$nama_file]>Klik Disini</a> Ket Tambahan : $_POST[keterangan2]','$tgl_sekarang')");

	

	   echo "<p align=center><b>Usulan telah anda edit dan kirim ke MR !</b><br><a href=../../home.php?pages=upd>Kembali</a></p>";	

	}





	// Update upd 5

elseif ($module=='upd' AND $act=='update5'){



  mysql_query("UPDATE upd SET    follow1   = '$_POST[follow1]',

								 follow2   = '$_POST[follow2]',

								 follow3   = '$_POST[follow3]',

								 follow1ke   = '$_POST[follow1ke]',

								 follow2ke   = '$_POST[follow2ke]',

								 follow3ke   = '$_POST[follow3ke]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}

	



// Update upd 6

elseif ($module=='upd' AND $act=='update6'){



  mysql_query("UPDATE upd SET    konsep1_krm  = '$_POST[konsep1_krm]',

                                 tgl_konsep1   = '$_POST[tgl_konsep1]',

                                 tgl_kbl_k1   = '$_POST[tgl_kbl_k1]',

                                 konsep2_krm  = '$_POST[konsep2_krm]',

                                 tgl_konsep2   = '$_POST[tgl_konsep2]',

                                 tgl_kbl_k2   = '$_POST[tgl_kbl_k2]',

                                 konsep3_krm  = '$_POST[konsep3_krm]',

                                 tgl_konsep3   = '$_POST[tgl_konsep3]',

                                 tgl_kbl_k3   = '$_POST[tgl_kbl_k3]',

                                 net1_krm  = '$_POST[net1_krm]',

                                 tgl_net1   = '$_POST[tgl_net1]',

                                 tgl_kbl_n1   = '$_POST[tgl_kbl_n1]',

                                 net2_krm  = '$_POST[net2_krm]',

                                 tgl_net2   = '$_POST[tgl_net2]',

                                 tgl_kbl_n2   = '$_POST[tgl_kbl_n2]',

                                 net3_krm  = '$_POST[net3_krm]',

                                 tgl_net3   = '$_POST[tgl_net3]',

                                 tgl_kbl_n3   = '$_POST[tgl_kbl_n3]',

								 konsep4_krm  = '$_POST[konsep4_krm]',

                                 tgl_konsep4   = '$_POST[tgl_konsep4]',

                                 tgl_kbl_k4   = '$_POST[tgl_kbl_k4]',

                                 konsep5_krm  = '$_POST[konsep5_krm]',

                                 tgl_konsep5   = '$_POST[tgl_konsep5]',

                                 tgl_kbl_k5   = '$_POST[tgl_kbl_k5]',

                                 konsep6_krm  = '$_POST[konsep6_krm]',

                                 tgl_konsep6   = '$_POST[tgl_konsep6]',

                                 tgl_kbl_k6   = '$_POST[tgl_kbl_k6]',

                                 net4_krm  = '$_POST[net4_krm]',

                                 tgl_net4   = '$_POST[tgl_net4]',

                                 tgl_kbl_n4   = '$_POST[tgl_kbl_n4]',

                                 net5_krm  = '$_POST[net5_krm]',

                                 tgl_net5   = '$_POST[tgl_net5]',

                                 tgl_kbl_n5   = '$_POST[tgl_kbl_n5]',

                                 net6_krm  = '$_POST[net6_krm]',

                                 tgl_net6   = '$_POST[tgl_net6]',

                                 tgl_kbl_n6   = '$_POST[tgl_kbl_n6]',

								 tgl_knsp_trkhr   = '$_POST[tgl_knsp_trkhr]',

								 tgl_krm_net   = '$_POST[tgl_krm_net]',

                                 keterangan = '$_POST[keterangan]',

								 keterangan2 = '$_POST[keterangan2]',

								 posisi = '$_POST[posisi]',

								 tgl_terakhir   = '$_POST[tgl_terakhir]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}

	



// xxx ACC oleh MR upd/ UD telah masuk ke MR -----------------------------------------------------------

elseif ($module=='upd' AND $act=='accupd'){



$tgl_sekarang = date("Y-m-d");



  mysql_query("UPDATE upd SET tgl_terima = '$tgl_sekarang'

    

   WHERE id_upd='$_GET[id]'");

  header('location:../../home.php?pages='.$module);

}



// Pending upd -----------------------------------------------------------

elseif ($module=='upd' AND $act=='pendingupd'){



$tgl_sekarang = date("Y-m-d");



  mysql_query("UPDATE upd SET 

tgl_pending = '$tgl_sekarang',

status = 'pending'

    

   WHERE id_upd='$_GET[id]'");

 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// konsep lanjutkan upd setelah pending -----------------------------------------------------------

elseif ($module=='upd' AND $act=='konsepupd'){



$tgl_sekarang = date("Y-m-d");



  mysql_query("UPDATE upd SET 

  tgl_terima2 = '$tgl_sekarang', 

  status = 'konsep'

    

   WHERE id_upd='$_GET[id]'");

   

 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Usulan sedang di konfirmasi -----------------------------------------------------------

elseif ($module=='upd' AND $act=='followupd'){



$tgl_sekarang = date("Y-m-d");



  mysql_query("UPDATE upd SET status = 'Follow-Up'

    

   WHERE id_upd='$_GET[id]'");

   

 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}	





// Temp UPD

elseif ($module=='upd' AND $act=='tempupd'){





  mysql_query("UPDATE upd SET keterangan = '1'

    

   WHERE id_upd='$_GET[id]'");



 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}





// Normalkan kembali UPD

elseif ($module=='upd' AND $act=='normalupd'){



$tgl_sekarang = date("Y-m-d");



  mysql_query("UPDATE upd SET keterangan = '',

	tgl_terima2 = '$tgl_sekarang'

	

   WHERE id_upd='$_GET[id]'");



header('location:../../home.php?pages='.$module);

}



// Tombol K1

elseif ($module=='upd' AND $act=='kbl1upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_kbl_k1 = '$tgl_sekarang',

  tgl_terakhir = '$tgl_sekarang',

  posisi = 'MR.'

	 

   WHERE id_upd='$_POST[id_upd]'");

   

header('location:../../home.php?pages='.$module);

}



// Tombol K2

elseif ($module=='upd' AND $act=='kbl2upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_k2 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module);

}



// Tombol K3

elseif ($module=='upd' AND $act=='kbl3upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_k3 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

header('location:../../home.php?pages='.$module); 

}



// Tombol K4

elseif ($module=='upd' AND $act=='kbl4upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_n1 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K5

elseif ($module=='upd' AND $act=='kbl5upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_n2 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K6

elseif ($module=='upd' AND $act=='kbl6upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_n3 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K7

elseif ($module=='upd' AND $act=='kbl7upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_k4 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K8

elseif ($module=='upd' AND $act=='kbl8upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_k5 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K9

elseif ($module=='upd' AND $act=='kbl9upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_k6 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K10

elseif ($module=='upd' AND $act=='kbl10upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_n4 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K11

elseif ($module=='upd' AND $act=='kbl11upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_n5 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol K12

elseif ($module=='upd' AND $act=='kbl12upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	posisi = 'MR.',

	tgl_kbl_n6 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

header('location:../../home.php?pages='.$module); }



// Tombol Krm 1

elseif ($module=='upd' AND $act=='krm1upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_konsep1 = '$tgl_sekarang',

  tgl_terakhir = '$tgl_sekarang',

  posisi = '$_POST[kata1]',

  konsep1_krm = '$_POST[kata] $_POST[kata1]'

	 

   WHERE id_upd='$_POST[id_upd]'");

   

if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

   

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 2

elseif ($module=='upd' AND $act=='krm2upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	konsep2_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_konsep2 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

	

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 3

elseif ($module=='upd' AND $act=='krm3upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	konsep3_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_konsep3 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

   

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 4

elseif ($module=='upd' AND $act=='krm4upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	net1_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_net1 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

	

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 5

elseif ($module=='upd' AND $act=='krm5upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	net2_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_net2 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 6

elseif ($module=='upd' AND $act=='krm6upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	net3_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_net3 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 7

elseif ($module=='upd' AND $act=='krm7upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	konsep4_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_konsep4 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 8

elseif ($module=='upd' AND $act=='krm8upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	konsep5_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_konsep5 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

  if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 9

elseif ($module=='upd' AND $act=='krm9upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	konsep6_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_konsep6 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

  if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 10

elseif ($module=='upd' AND $act=='krm10upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	net4_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_net4 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 11

elseif ($module=='upd' AND $act=='krm11upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	net5_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_net5 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Tombol Krm 12

elseif ($module=='upd' AND $act=='krm12upd'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_terakhir = '$tgl_sekarang',

	net6_krm = '$_POST[kata] $_POST[kata1]',

	  posisi = '$_POST[kata1]',

	tgl_net6 = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   if ($_POST[kata2]==''){  } else {

   mysql_query("INSERT INTO ppd(tgl, nama, sepnet) 

                        VALUES('$tgl_sekarang','$_POST[kata2]','$_POST[kata]')");

	}

header('location:../../home.php?pages='.$module);

}



// Knsp Trkhr

elseif ($module=='upd' AND $act=='update20'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_knsp_trkhr = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}





// Krm net 1 

elseif ($module=='upd' AND $act=='update30'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET tgl_krm_net = '$tgl_sekarang'

   WHERE id_upd='$_POST[id_upd]'");

   

 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Krm net 1 

elseif ($module=='upd' AND $act=='update212'){

$tgl_sekarang = date("Y-m-d");

  mysql_query("UPDATE upd SET 

  tgl_dist = '$_POST[tgl_dist]',

   tgl_dist_selesai = '$_POST[tgl_dist_selesai]',

    tgl_tarik_selesai = '$_POST[tgl_tarik_selesai]',

	 keterangan = '$_POST[keterangan]'

   WHERE id_upd='$_POST[id_upd]'");

   

 echo"<script LANGUAGE=JavaScript>

function closePg(){

	window.close();

	return true;

}

</script>

<body onLoad='return closePg()'></body>";

}



// Usulan telah selesai save tgl berlaku dan ke table dokumen



elseif ($module=='upd' AND $act=='netupd'){



if ($_POST[jenis_upd]=='UPD'){



 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 				judul_dok = '$_POST[judul_dok]',

 				kode_dok = '$_POST[kode_dok]',

				id_jendok = '$_POST[id_jendok]',

                tgl_selesai   = '$_POST[tgl_berlaku1]',

				tgl_dist = '$_POST[tgl_berlaku1]',

				tgl_berlaku   = '$_POST[tgl_berlaku]',

				tgl_terakhir   = '',

				posisi  = '',

				revisi   = '$_POST[revisi]'

                WHERE id_upd   = '$_POST[id_upd]'");

   

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku1]);

$tgl_review=($_POST[tgl_berlaku1]+3);

 $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

	  

if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }

if (empty($lokasi_file)){

mysql_query("UPDATE dokumen SET

judul_dok	= '$_POST[judul_dok]', 

kode_kom	= '$_POST[kode_kom]',

pj_dok		= '$_POST[pj_dok]',

dok_terkait	= '$_POST[dok_terkait]',

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

tgl_review  = '$tgl_review$tgl_berlaku',

cchl        = '$tag',

keterangan  = '$_POST[keterangan]'

WHERE kode_dok   = '$_POST[kode_dok]'");

}

else

{

UploadFile1($nama_file);

mysql_query("UPDATE dokumen SET

judul_dok	= '$_POST[judul_dok]', 

kode_kom	= '$_POST[kode_kom]',

pj_dok		= '$_POST[pj_dok]',

dok_terkait	= '$_POST[dok_terkait]',

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

tgl_berlaku	= '$_POST[tgl_berlaku1]', 

tgl_review  = '$tgl_review$tgl_berlaku',

nama_file   = '$nama_file',

cchl        = '$tag',

keterangan  = '$_POST[keterangan]'

WHERE kode_dok   = '$_POST[kode_dok]'");

}



  echo "<p align=center><b>Dokumen telah masuk registrasi !<br></b>

<center><a href=../../home.php?pages=upd>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	



}



elseif ($_POST[jenis_upd]=='UPDB') {



$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);

$tgl_review=($_POST[tgl_berlaku]+3);

 $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

	  

  if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }



 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 								judul_dok = '$_POST[judul_dok]',

 								kode_dok = '$_POST[kode_dok]',

								id_jendok = '$_POST[id_jendok]',

                                tgl_selesai   = '$_POST[tgl_berlaku1]',

								tgl_berlaku   = '$_POST[tgl_berlaku]',

								tgl_dist = '$_POST[tgl_berlaku1]',

								tgl_terakhir   = '',

								posisi  = '',

								revisi   = '$_POST[revisi]'

                           WHERE id_upd   = '$_POST[id_upd]'");



if (!empty($lokasi_file)){

    UploadFile1($nama_file); 						   

mysql_query("INSERT INTO dokumen( kode_dok, id_jendok, judul_dok, kode_kom, pj_dok, dok_terkait, tgl_Rev0, tgl_berlaku, tgl_review, nama_file, cchl) VALUES

('$_POST[kode_dok]','$_POST[id_jendok]','$_POST[judul_dok]','$_POST[kode_kom]','$_POST[pj_dok]', '$_POST[dok_terkait]','$_POST[tgl_rev0]','$_POST[tgl_berlaku]','$tgl_review$tgl_berlaku','$nama_file','$tag')");   	}

				   else

				   {	   

mysql_query("INSERT INTO dokumen( kode_dok, id_jendok, judul_dok, kode_kom, pj_dok, dok_terkait, tgl_Rev0, tgl_berlaku, tgl_review, nama_file, cchl) VALUES

('$_POST[kode_dok]','$_POST[id_jendok]','$_POST[judul_dok]', '$_POST[kode_kom]','$_POST[pj_dok]', '$_POST[dok_terkait]',

								   '$_POST[tgl_rev0]',

  								   '$_POST[tgl_berlaku]',

								   '$tgl_review$tgl_berlaku',

								   '$nama_file',

				   '$tag')");   }

				   

    echo "<p align=center><b>Dokumen baru telah dibuat (telah NET) !<br></b>

<center><a href=../../home.php?pages=upd>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	



}







elseif ($_POST[jenis_upd]=='OBS'){



 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 				judul_dok = '$_POST[judul_dok]',

 				kode_dok = '$_POST[kode_dok]',

				id_jendok = '$_POST[id_jendok]',

                tgl_selesai   = '$_POST[tgl_berlaku1]',

				tgl_dist = '$_POST[tgl_berlaku1]',

				tgl_berlaku   = '$_POST[tgl_berlaku]',

				tgl_terakhir   = '',

				posisi  = '',

				revisi   = '$_POST[revisi]'

                           WHERE id_upd   = '$_POST[id_upd]'");

   

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku1]);

$tgl_review=($_POST[tgl_berlaku1]+3);

 $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

	  

if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }

if (empty($lokasi_file)){

mysql_query("UPDATE dokumen SET

judul_dok	= '$_POST[judul_dok]', 

kode_kom	= '$_POST[kode_kom]', 

pj_dok		= '$_POST[pj_dok]', 

dok_terkait	= '$_POST[dok_terkait]',

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

tgl_review  = '$tgl_review$tgl_berlaku',

cchl        = '$tag',

keterangan  = '$_POST[keterangan]'

WHERE kode_dok   = '$_POST[kode_dok]'");

}

else

{

UploadFile1($nama_file);

mysql_query("UPDATE dokumen SET

judul_dok	= '$_POST[judul_dok]', 

kode_kom	= '$_POST[kode_kom]', 

pj_dok		= '$_POST[pj_dok]',

dok_terkait	= '$_POST[dok_terkait]',

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

tgl_berlaku	= '$_POST[tgl_berlaku1]', 

tgl_review  = '$tgl_review$tgl_berlaku',

nama_file   = '$nama_file',

cchl        = '$tag',

keterangan  = '$_POST[keterangan]'

WHERE kode_dok   = '$_POST[kode_dok]'");

}



header('location:../../home.php?pages='.$module);

}





else {

 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 								judul_dok = '$_POST[judul_dok]',

 								kode_dok = '$_POST[kode_dok]',

								id_jendok = '$_POST[id_jendok]',

                                tgl_selesai   = '$_POST[tgl_berlaku1]',

								tgl_berlaku   = '$_POST[tgl_berlaku]',

								tgl_terakhir   = '',

								posisi  = '',

								revisi   = '$_POST[revisi]'

                           WHERE id_upd   = '$_POST[id_upd]'");

     

   header('location:../../home.php?pages='.$module);

   }

}





// Usulan nett



elseif ($module=='upd' AND $act=='nettupd'){



if ($_POST[jenis_upd]=='UPD'){



 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 				judul_dok = '$_POST[judul_dok]',

 				kode_dok = '$_POST[kode_dok]',

				id_jendok = '$_POST[id_jendok]',

                tgl_selesai   = '$_POST[tgl_berlaku1]',

				tgl_dist = '$_POST[tgl_berlaku1]',

				tgl_berlaku   = '$_POST[tgl_berlaku]',

				keterangan = '$_POST[keterangan]',

				tgl_terakhir   = '',

				posisi  = '',

				revisi   = '$_POST[revisi]'

                WHERE id_upd   = '$_POST[id_upd]'");

   



mysql_query("INSERT INTO upd (

reg_upd, 

jenis_upd, 

kode_dok, 

kode_kom, 

revisi, 

judul_dok, 

id_jendok, 

tgl_upd, 

isi_upd, 

kat_upd, 

username, 

nama_file, 

cchl, 

tgl_terima, 

konsep1_krm, 

tgl_konsep1, 

tgl_kbl_k1, 

konsep2_krm, 

tgl_konsep2, 

tgl_kbl_k2, 

konsep3_krm, 

tgl_konsep3, 

tgl_kbl_k3, 

tgl_berlaku, 

tgl_selesai, 

tgl_dist, 

tgl_dist_selesai, 

tgl_tarik_selesai, 

status, 

keterangan, 

keterangan2, 

dok_terkait)



 VALUES ( 

 '$_POST[reg_upd]', 

 '$_POST[jenis_upd]', 

 '$_POST[kode_dok]', 

 '$_POST[kode_kom]', 

 '$_POST[revisi]', 

 '$_POST[judul_dok]', 

 '$_POST[id_jendok]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[isi_upd]', 

 '$_POST[kat_upd]', 

 '$_POST[username]', 

 '$_POST[nama_file]', 

 '$_POST[cchl]', 

 '$_POST[tgl_terima]', 

 '(K) $_POST[username]', 

 '$_POST[tgl_konsep1]', 

 '$_POST[tgl_kbl_k1]', 

 '(N) $_POST[username]', 

 '$_POST[tgl_konsep2]', 

 '$_POST[tgl_kbl_k2]', 

 '(N) MPM', 

 '$_POST[tgl_konsep3]', 

 '$_POST[tgl_kbl_k3]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]',

 '$_POST[tgl_berlaku]', 

 '$_POST[status]', 

 '0',

 'khusus',

 '$_POST[dok_terkait]') ");		   	



   

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);

$tgl_review=($_POST[tgl_berlaku]+3);

 $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

	  

  if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }



mysql_query("UPDATE dokumen SET

judul_dok	= '$_POST[judul_dok]', 

kode_kom	= '$_POST[kode_kom]',

pj_dok	= '$_POST[pj_dok]',

dok_terkait	= '$_POST[dok_terkait]',

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

tgl_review  = '$tgl_review$tgl_berlaku',

cchl        = '$_POST[cchl]',

WHERE kode_dok   = '$_POST[kode_dok]'");





 echo "<p align=center><b>Dokumen telah masuk registrasi !<br></b>

<center><a href=../../home.php?pages=upd>Kembali</a></p>";	





echo "<center><p align=center><b>Usulan khusus telah dibuat ! 

<form method=POST action=/security1/pdf_upd1.php target=_blank>

<input type=hidden name='tgl_upd' size=20 value='$_POST[tgl_berlaku]'>

<input type=hidden name='kode_dok' size=20 value='$_POST[kode_dok]'>

<input type=hidden name='username' size=20 value='$_POST[username]'>

<input type=hidden name='judul_dok' size=20 value='$_POST[judul_dok]'>

<input type=hidden name='revisi' size=20 value='$_POST[revisi]'>

<input type=hidden name='isi_upd' size=20 value='$_POST[isi_upd]'>

<input type=hidden name='reg_upd' size=20 value='$_POST[reg_upd]'>

<input type=hidden name='cchl' size=20 value='$tag'>

<input type=submit value='Klik disini untuk Print UPD-NYA'>

</form>";





}



elseif ($_POST[jenis_upd]=='UPDB') {



$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);

$tgl_review=($_POST[tgl_berlaku]+3);

 $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

	  

  if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }



 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 								judul_dok = '$_POST[judul_dok]',

 								kode_dok = '$_POST[kode_dok]',

								id_jendok = '$_POST[id_jendok]',

								keterangan = '$_POST[keterangan]',

                                tgl_selesai   = '$_POST[tgl_berlaku1]',

								tgl_dist = '$_POST[tgl_berlaku1]',

								tgl_berlaku   = '$_POST[tgl_berlaku]',

								tgl_terakhir   = '',

								posisi  = '',

								revisi   = '$_POST[revisi]'

                           WHERE id_upd   = '$_POST[id_upd]'");

						   

   



					   

mysql_query("INSERT INTO dokumen( kode_dok, id_jendok, judul_dok, kode_kom, pj_dok, dok_terkait, tgl_Rev0, tgl_berlaku, tgl_review, nama_file, cchl) VALUES

('$_POST[kode_dok]','$_POST[id_jendok]','$_POST[judul_dok]', '$_POST[kode_kom]','$_POST[pj_dok]','$_POST[dok_terkait]',

								   '$_POST[tgl_rev0]',

  								   '$_POST[tgl_berlaku]',

								   '$tgl_review$tgl_berlaku',

								   '$nama_file',

								'$tag')");   	

				 

				   

    echo "<p align=center><b>Dokumen baru telah dibuat (telah NET) !<br></b>

<center><a href=../../home.php?pages=upd>Kembali</a></p>";	



echo "<center><p align=center><b>Usulan khusus telah dibuat !

<form method=POST action=/security1/pdf_updb1.php target=_blank>

<input type=hidden name='tgl_upd' size=20 value='$_POST[tgl_berlaku]'>

<input type=hidden name='kode_dok' size=20 value='$_POST[kode_dok]'>

<input type=hidden name='username' size=20 value='$_POST[username]'>

<input type=hidden name='judul_dok' size=20 value='$_POST[judul_dok]'>

<input type=hidden name='revisi' size=20 value='$_POST[revisi]'>

<input type=hidden name='isi_upd' size=20 value='$_POST[isi_upd]'>

<input type=hidden name='reg_upd' size=20 value='$_POST[reg_upd]'>

<input type=hidden name='cchl' size=20 value='$tag'>

<input type=submit value='Klik disini untuk Print UPDB-NYA'>

</form>";



						   mysql_query("INSERT INTO upd (

reg_upd, 

jenis_upd, 

kode_dok, 

kode_kom, 

revisi, 

judul_dok, 

id_jendok, 

tgl_upd, 

isi_upd, 

kat_upd, 

username, 

nama_file, 

cchl, 

tgl_terima, 

konsep1_krm, 

tgl_konsep1, 

tgl_kbl_k1, 

konsep2_krm, 

tgl_konsep2, 

tgl_kbl_k2, 

konsep3_krm, 

tgl_konsep3, 

tgl_kbl_k3, 

tgl_berlaku, 

tgl_selesai, 

tgl_dist, 

tgl_dist_selesai, 

tgl_tarik_selesai, 

status, 

keterangan, 

keterangan2, 

dok_terkait)



 VALUES ( 

 '$_POST[reg_upd]', 

 '$_POST[jenis_upd]', 

 '$_POST[kode_dok]', 

 '$_POST[kode_kom]', 

 '$_POST[revisi]', 

 '$_POST[judul_dok]', 

 '$_POST[id_jendok]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[isi_upd]', 

 '$_POST[kat_upd]', 

 '$_POST[username]', 

 '$_POST[nama_file]', 

 '$_POST[cchl]', 

 '$_POST[tgl_terima]', 

 '(K) $_POST[username]', 

 '$_POST[tgl_konsep1]', 

 '$_POST[tgl_kbl_k1]', 

 '(N) $_POST[username]', 

 '$_POST[tgl_konsep2]', 

 '$_POST[tgl_kbl_k2]', 

 '(N) MPM', 

 '$_POST[tgl_konsep3]', 

 '$_POST[tgl_kbl_k3]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]',

 '$_POST[tgl_berlaku]', 

 '$_POST[status]', 

 '0',

 'khusus',

 '$_POST[dok_terkait]') ");		   	



}







elseif ($_POST[jenis_upd]=='OBS'){



 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 				judul_dok = '$_POST[judul_dok]',

 				kode_dok = '$_POST[kode_dok]',

				id_jendok = '$_POST[id_jendok]',

                tgl_selesai   = '$_POST[tgl_berlaku1]',

				tgl_dist = '$_POST[tgl_berlaku1]',

				tgl_berlaku   = '$_POST[tgl_berlaku]',

				tgl_terakhir   = '',

				posisi  = '',

				revisi   = '$_POST[revisi]'

                WHERE id_upd   = '$_POST[id_upd]'");

				

				mysql_query("INSERT INTO upd (

reg_upd, 

jenis_upd, 

kode_dok, 

kode_kom, 

revisi, 

judul_dok, 

id_jendok, 

tgl_upd, 

isi_upd, 

kat_upd, 

username, 

nama_file, 

cchl, 

tgl_terima, 

konsep1_krm, 

tgl_konsep1, 

tgl_kbl_k1, 

konsep2_krm, 

tgl_konsep2, 

tgl_kbl_k2, 

konsep3_krm, 

tgl_konsep3, 

tgl_kbl_k3, 

tgl_berlaku, 

tgl_selesai, 

tgl_dist, 

tgl_dist_selesai, 

tgl_tarik_selesai, 

status, 

keterangan, 

keterangan2, 

dok_terkait)



 VALUES ( 

 '$_POST[reg_upd]', 

 '$_POST[jenis_upd]', 

 '$_POST[kode_dok]', 

 '$_POST[kode_kom]', 

 '$_POST[revisi]', 

 '$_POST[judul_dok]', 

 '$_POST[id_jendok]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[isi_upd]', 

 '$_POST[kat_upd]', 

 '$_POST[username]', 

 '$_POST[nama_file]', 

 '$_POST[cchl]', 

 '$_POST[tgl_terima]', 

 '(K) $_POST[username]', 

 '$_POST[tgl_konsep1]', 

 '$_POST[tgl_kbl_k1]', 

 '(N) $_POST[username]', 

 '$_POST[tgl_konsep2]', 

 '$_POST[tgl_kbl_k2]', 

 '(N) MPM', 

 '$_POST[tgl_konsep3]', 

 '$_POST[tgl_kbl_k3]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]',

 '$_POST[tgl_berlaku]', 

 '$_POST[status]', 

 '0',

 'khusus',

 '$_POST[dok_terkait]') ");		   	

   

$tgl_berlaku=tgl_indo1($_POST[tgl_berlaku]);

$tgl_review=($_POST[tgl_berlaku]+3);

 $lokasi_file = $_FILES['fupload']['tmp_name'];

  $nama_file   = $_FILES['fupload']['name'];

	  

  if (!empty($_POST[cchl])){

    $tag_new = $_POST[cchl];

    $tag=implode(', ',$tag_new);

  }





mysql_query("UPDATE dokumen SET

judul_dok	= '$_POST[judul_dok]', 

kode_kom	= '$_POST[kode_kom]', 

pj_dok	= '$_POST[pj_dok]', 

dok_terkait	= '$_POST[dok_terkait]',

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

tgl_review  = '$tgl_review$tgl_berlaku',

cchl        = '$tag',

WHERE kode_dok   = '$_POST[kode_dok]'");







header('location:../../home.php?pages='.$module);

}





else {

 mysql_query("UPDATE upd SET    status  = '$_POST[status]',

 								judul_dok = '$_POST[judul_dok]',

 								kode_dok = '$_POST[kode_dok]',

								id_jendok = '$_POST[id_jendok]',

                                tgl_selesai   = '$_POST[tgl_berlaku1]',

								tgl_dist = '$_POST[tgl_berlaku1]',

								tgl_berlaku   = '$_POST[tgl_berlaku]',

								tgl_terakhir   = '',

								posisi  = '',

								revisi   = '$_POST[revisi]'

                           WHERE id_upd   = '$_POST[id_upd]'");

     

	mysql_query("INSERT INTO upd (

reg_upd, 

jenis_upd, 

kode_dok, 

kode_kom, 

revisi, 

judul_dok, 

id_jendok, 

tgl_upd, 

isi_upd, 

kat_upd, 

username, 

nama_file, 

cchl, 

tgl_terima, 

konsep1_krm, 

tgl_konsep1, 

tgl_kbl_k1, 

konsep2_krm, 

tgl_konsep2, 

tgl_kbl_k2, 

konsep3_krm, 

tgl_konsep3, 

tgl_kbl_k3, 

tgl_berlaku, 

tgl_selesai, 

tgl_dist, 

tgl_dist_selesai, 

tgl_tarik_selesai, 

status, 

keterangan, 

keterangan2, 

dok_terkait)



 VALUES ( 

 '$_POST[reg_upd]', 

 '$_POST[jenis_upd]', 

 '$_POST[kode_dok]', 

 '$_POST[kode_kom]', 

 '$_POST[revisi]', 

 '$_POST[judul_dok]', 

 '$_POST[id_jendok]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[isi_upd]', 

 '$_POST[kat_upd]', 

 '$_POST[username]', 

 '$_POST[nama_file]', 

 '$_POST[cchl]', 

 '$_POST[tgl_terima]', 

 '(K) $_POST[username]', 

 '$_POST[tgl_konsep1]', 

 '$_POST[tgl_kbl_k1]', 

 '(N) $_POST[username]', 

 '$_POST[tgl_konsep2]', 

 '$_POST[tgl_kbl_k2]', 

 '(N) MPM', 

 '$_POST[tgl_konsep3]', 

 '$_POST[tgl_kbl_k3]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]', 

 '$_POST[tgl_berlaku]',

 '$_POST[tgl_berlaku]', 

 '$_POST[status]', 

 '0',

 'khusus',

 '$_POST[dok_terkait]') ");		   	

 

   header('location:../../home.php?pages='.$module);

   }

}





?>

