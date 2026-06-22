<?php
session_start();
error_reporting (E_ALL);
ini_set ('display_errors', false);
ini_set ('html_errors', false);
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Cari dan tampilkan dokumen berdasarkan judul dokumen
if ($module=='sarmut' AND $act=='carisarmut'){
$kata1 = trim($_POST[kata1]);
$kata = trim($_POST[kata]);
echo "
<html>
<head>
<title>Web Aplikasi e-KFPB - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />
<SCRIPT language=JavaScript>
<!-- http://www.spacegun.co.uk -->
	var message = 'Tidak boleh klik kanan!'; 
	function rtclickcheck(keyp){ if (navigator.appName == 'Netscape' && keyp.which == 3){ 	alert(message); return false; } 
	if (navigator.appVersion.indexOf('MSIE') != -1 && event.button == 2) { 	alert(message); 	return false; } } 
	document.onmousedown = rtclickcheck;
</SCRIPT>
</head><body>
 
 <h2>Entry Realisasi Sasaran Mutu</h2><p align=left><font size=2><b>Perhatian</b> :<br>
 <b>- Isi dengan angka saja pada isian bulan ! tanpa persen (%) misalnya 98, klik tombol UPDATE per-target di sebelah kanan<br>
 - Jika ada koma pada nilai yang akan diisi pakai titik (contoh 98.50)<br>
 - Jika pada bulan tersebut tidak ada realisasi, kosongkan saja<br>
- Jika isi realisasi bukan angka (kualitatif) misalnya hanya kata TERCAPAI/SESUAI isi saja dengan 100.<br> 
- Jika salah entry harap hubungi SPD-MR.</b><br><br>
 <b>Informasi : </b> <br>
- Bila akan entry data triwulan saja, isi pada bulan ke-3 dari triwulan tersebut, misalnya di bulan Maret untuk TW-1.<br>
- Hasil target mutu TW 1- TW 4 akan otomatis terisi yaitu rata-rata dari bulan-bulan yang diisi pada TW tersebut.<br> 
- Bila tidak tercapai targetnya maka segera buat CAPA. Bila telah diisi akan muncul tanggal entry dan tercapai tidaknya target tersebut.<br>- Jika periode target-nya triwulan cukup masukkan pada bulan terakhir triwulan tersebut, begitu juga jika periode target-nya per semester maka masukkan realisasi target pada bulan terakhir semester tersebut (Juni & Desember). <br>- Jika periode target-nya per tahun maka masukan realisasi target pada bulan Desember.
 </font></p>";
	 // menghilangkan spasi di kiri dan kanannya


    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
   $cari = "SELECT * FROM sarmut WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "cchl LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY no_target ASC";
  $hasil  = mysql_query($cari);
  $tampil = mysql_num_rows($hasil);

  $cari2 = "SELECT * FROM sarmut WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari2 .= "cchl LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari2 .= " OR ";
      }
    }
  $cari2 .= " ORDER BY no_target ASC";
  $hasil2  = mysql_query($cari2);
  $tampil2 = mysql_num_rows($hasil2);
$d=mysql_fetch_array($hasil2);

   if ($tampil > 0){
  
echo "
<html>
<head>
<title>Web Aplikasi e-KFPB - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />
<SCRIPT language=JavaScript>
<!-- http://www.spacegun.co.uk -->
	var message = 'Tidak boleh klik kanan!'; 
	function rtclickcheck(keyp){ if (navigator.appName == 'Netscape' && keyp.which == 3){ 	alert(message); return false; } 
	if (navigator.appVersion.indexOf('MSIE') != -1 && event.button == 2) { 	alert(message); 	return false; } } 
	document.onmousedown = rtclickcheck;
</SCRIPT>
</head><body>";

echo "<hr color=#FCE007 noshade=noshade />";
echo "<center><font size=3><b>REALISASI PENCAPAIAN SASARAN MUTU</b></FONT></center><br>
<p align=left>Bagian : $d[bagian]	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun : $kata1<br>
<center><table width=1600>
          <tr><th>Sasaran</th><th>Target</th><th>Periode Target</th><th>Metoda Pengukuran</th><th>Penanggung Jawab</th><th>Jan</th><th>Feb</th><th>Mar</th><th>TW-1</th><th>Apr</th><th>Mei</th><th>Jun</th><th>TW-2</th><th>Jul</th><th>Ags</th><th>Sep</th><th>TW-3</th><th>okt</th><th>Nop</th><th>Des</th><th>TW-4</th><th>Update/Entry</th><th>Aksi</th><tr>"; 
$tgl_sekarang = date("Y-m-d");
    while ($r=mysql_fetch_array($hasil)){
	
	$tgl_jan=tgl_indo2($r[tgl_jan]);
		$tgl_feb=tgl_indo2($r[tgl_feb]);
			$tgl_mar=tgl_indo2($r[tgl_mar]);
				$tgl_apr=tgl_indo2($r[tgl_apr]);
					$tgl_mei=tgl_indo2($r[tgl_mei]);
						$tgl_jun=tgl_indo2($r[tgl_jun]);
							$tgl_jul=tgl_indo2($r[tgl_jul]);
								$tgl_ags=tgl_indo2($r[tgl_ags]);
									$tgl_sep=tgl_indo2($r[tgl_sep]);
										$tgl_okt=tgl_indo2($r[tgl_okt]);
											$tgl_nov=tgl_indo2($r[tgl_nov]);
												$tgl_des=tgl_indo2($r[tgl_des]);
	
if ($r[tahun]==$kata1) {	 	 	  
echo "<tr><td align=left width=100>$r[sasaran]</td>";
echo "<td align=left width=150>$r[target]</td>";   
echo "<td align=center width=50>$r[periode_target] bulan</td>
             <td align=center width=50>$r[metoda]</td>
             <td align=center width=50>$r[pic]</td>
			 
			  
			  <td align=center width=5><form method=POST action=?module=sarmut&act=update2 target=_blank><input type=hidden name=id_sarmut value='$r[id_sarmut]'>";
			   if ($r[trg_jan]==''){
echo "<input type=text name='trg_jan' size=5>
<input type=hidden name='tgl_jan' value='$tgl_sekarang'>
</td>";
}
else {
echo "$r[trg_jan]$r[satuan]<br>$tgl_jan<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_jan]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_jan]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "<input type=hidden name='trg_jan' value='$r[trg_jan]'>
<input type=hidden name='tgl_jan' value='$r[tgl_jan]'></td>";
}
			   if ($r[trg_feb]=='' ){
echo "<td align=center width=5><input type=text name='trg_feb' size=5>
<input type=hidden name='tgl_feb' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_feb]$r[satuan]<br>$tgl_feb<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_feb]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_feb]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_feb' value='$r[trg_feb]'>
<input type=hidden name='tgl_feb' value='$r[tgl_feb]'></td>";
}
	   if ($r[trg_mar]==''){
echo "<td align=center width=5><input type=text name='trg_mar' size=5>
<input type=hidden name='tgl_mar' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_mar]$r[satuan]<br>$tgl_mar<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_mar]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_mar]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_mar' value='$r[trg_mar]'>
<input type=hidden name='tgl_mar' value='$r[tgl_mar]'></td>";
}

if ($r[trg_jan]=='' OR $r[trg_jan]=='0') 
{ 
$jan='0';
 } else {
$jan='1';} 
if ($r[trg_feb]=='' OR $r[trg_feb]=='0') 
{ 
$feb='0';
 } else {
$feb='1';} 
if ($r[trg_mar]=='' OR $r[trg_mar]=='0') 
{ 
$mar='0';
 } else {
$mar='1';} 

$twww1=($jan+$feb+$mar);
$tww1=($r[trg_jan]+$r[trg_feb]+$r[trg_mar])/$twww1;
$tw1 = round ($tww1,2);
if ($r[trg_jan]!='')
{
echo "<td align=center width=5>$tw1$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw1>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw1<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_feb]!=''){
echo "<td align=center width=5>$tw1$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw1>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw1<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_mar]!=''){
echo "<td align=center width=5>$tw1$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw1>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw1<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}


	   if ($r[trg_apr]=='' ){
echo "<td align=center width=5><input type=text name='trg_apr' size=5>
<input type=hidden name='tgl_apr' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_apr]$r[satuan]<br>$tgl_apr<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_apr]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_apr]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_apr' value='$r[trg_apr]'>
<input type=hidden name='tgl_apr' value='$r[tgl_apr]'></td>";
}		      
	   if ($r[trg_mei]=='' ){
echo "<td align=center width=5><input type=text name='trg_mei' size=5>
<input type=hidden name='tgl_mei' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_mei]$r[satuan]<br>$tgl_mei<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_mei]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_mei]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_mei' value='$r[trg_mei]'>
<input type=hidden name='tgl_mei' value='$r[tgl_mei]'></td>";
}
	   if ($r[trg_jun]=='' ){
echo "<td align=center width=5><input type=text name='trg_jun' size=5>
<input type=hidden name='tgl_jun' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_jun]$r[satuan]<br>$tgl_jun<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_jun]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_jun]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_jun' value='$r[trg_jun]'>
<input type=hidden name='tgl_jun' value='$r[tgl_jun]'></td>";
}

if ($r[trg_apr]=='' OR $r[trg_apr]=='0') 
{ 
$apr='0';
 } else {
$apr='1';} 
if ($r[trg_mei]=='' OR $r[trg_mei]=='0') 
{ 
$mei='0';
 } else {
$mei='1';} 
if ($r[trg_jun]=='' OR $r[trg_jun]=='0') 
{ 
$jun='0';
 } else {
$jun='1';} 

$twww2=($apr+$mei+$jun);
$tww2=($r[trg_apr]+$r[trg_mei]+$r[trg_jun])/$twww2;
$tw2 = round ($tww2,2);
if ($r[trg_apr]!='')
{
echo "<td align=center width=5>$tw2$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw2>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw2<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_mei]!=''){
echo "<td align=center width=5>$tw2$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw2>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw2<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_jun]!=''){
echo "<td align=center width=5>$tw2$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw2>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw2<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}

	   if ($r[trg_jul]=='' ){
echo "<td align=center width=5><input type=text name='trg_jul' size=5>
<input type=hidden name='tgl_jul' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_jul]$r[satuan]<br>$tgl_jul<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_jul]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_jul]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_jul' value='$r[trg_jul]'>
<input type=hidden name='tgl_jul' value='$r[tgl_jul]'></td>";
}			  
	   if ($r[trg_ags]=='' ){
echo "<td align=center width=5><input type=text name='trg_ags' size=5>
<input type=hidden name='tgl_ags' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_ags]$r[satuan]<br>$tgl_ags<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_ags]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_ags]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_ags' value='$r[trg_ags]'>
<input type=hidden name='tgl_ags' value='$r[tgl_ags]'></td>";
}  
	   if ($r[trg_sep]=='' ){
echo "<td align=center width=5><input type=text name='trg_sep' size=5>
<input type=hidden name='tgl_sep' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_sep]$r[satuan]<br>$tgl_sep<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_sep]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_sep]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_sep' value='$r[trg_sep]'>
<input type=hidden name='tgl_sep' value='$r[tgl_sep]'></td>";
}

if ($r[trg_jul]=='' OR $r[trg_jul]=='0') 
{ 
$jul='0';
 } else {
$jul='1';} 
if ($r[trg_ags]=='' OR $r[trg_ags]=='0') 
{ 
$ags='0';
 } else {
$ags='1';} 
if ($r[trg_sep]=='' OR $r[trg_sep]=='0') 
{ 
$sep='0';
 } else {
$sep='1';} 

$twww3=($jul+$ags+$sep);
$tww3=($r[trg_jul]+$r[trg_ags]+$r[trg_sep])/$twww3;
$tw3 = round ($tww3,2);
if ($r[trg_jul]!='')
{
echo "<td align=center width=5>$tw3$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw3>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw3<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_ags]!=''){
echo "<td align=center width=5>$tw3$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw3>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw3<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_sep]!=''){
echo "<td align=center width=5>$tw3$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw3>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw3<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}

	   if ($r[trg_okt]=='' ){
echo "<td align=center width=5><input type=text name='trg_okt' size=5>
<input type=hidden name='tgl_okt' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_okt]$r[satuan]<br>$tgl_okt<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_okt]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_okt]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_okt' value='$r[trg_okt]'>
<input type=hidden name='tgl_okt' value='$r[tgl_okt]'></td>";
}
	   if ($r[trg_nov]=='' ){
echo "<td align=center width=5><input type=text name='trg_nov' size=5>
<input type=hidden name='tgl_nov' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_nov]$r[satuan]<br>$tgl_nov<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_nov]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_nov]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_nov' value='$r[trg_nov]'>
<input type=hidden name='tgl_nov' value='$r[tgl_nov]'></td>";
}
	   if ($r[trg_des]=='' ){
echo "<td align=center width=5><input type=text name='trg_des' size=5>
<input type=hidden name='tgl_des' value='$tgl_sekarang'>
</td>";
}
else {
echo "<td align=center width=5>$r[trg_des]$r[satuan]<br>$tgl_des<br>";
		if ($r[minmax]=='min'){ 
		if ($r[trg_des]>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($r[trg_des]<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo "
<input type=hidden name='trg_des' value='$r[trg_des]'>
<input type=hidden name='tgl_des' value='$r[tgl_des]'></td>";
}
if ($r[trg_okt]=='' OR $r[trg_okt]=='0') 
{ 
$okt='0';
 } else {
$okt='1';} 
if ($r[trg_nov]=='' OR $r[trg_nov]=='0') 
{ 
$nov='0';
 } else {
$nov='1';} 
if ($r[trg_des]=='' OR $r[trg_des]=='0') 
{ 
$des='0';
 } else {
$des='1';} 

$twww4=($okt+$nov+$des);
$tww4=($r[trg_okt]+$r[trg_nov]+$r[trg_des])/$twww4;
$tw4 = round ($tww4,2);

if ($r[trg_okt]!='')
{
echo "<td align=center width=5>$tw4$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw4>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw4<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_nov]!=''){
echo "<td align=center width=5>$tw4$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw4>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw4<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
elseif ($r[trg_des]!=''){
echo "<td align=center width=5>$tw4$r[satuan]<br>";
if ($r[minmax]=='min'){ 
		if ($tw4>=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } } else {
		if ($tw4<=$r[isi_target]) { echo "Tercapai"; } else { echo "Tdk Trcapai"; } }
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}

						   echo "<td width=5><input type=submit value=Update></form></td>
						         <td width=100>";
								    if ($_SESSION[leveluser]=='Admin'){
								 if ($r[no_target]=='a') { echo"<font style='background-color:#00FFFF'><a target=_blank href=../../file_tm/$r[file_pntpn_sarmut]>File Penetapan Sarmut</a>| <a href=../../home.php?pages=sarmut&act=editsarmut&id=$r[id_sarmut]>Edit</a> | <a href=?module=sarmut&act=hapus&id=$r[id_sarmut]>Hapus</a>"; } else { 
echo"<a href=../../home.php?pages=sarmut&act=editsarmut&id=$r[id_sarmut]>Edit</a> | <a href=?module=sarmut&act=hapus&id=$r[id_sarmut]>Hapus</a>"; }
 }
 else {
 if ($r[no_target]=='a') { echo"<font style='background-color:#00FFFF'><a target=_blank href=../../file_tm/$r[file_pntpn_sarmut]>File Penetapan Sarmut</a></font>"; } else { 
echo""; }
}
 
echo"</td> </tr>";
     }
	 else {
echo "";
}
	   }
	      echo "</table>
<form method=POST action=?module=sarmut&act=update3>
<input type=hidden name=bagian value=$kata>
Isi tiap baris sesuai bulan yang diisi kemudian klik tombol UPDATE disebelah kanan, <br>jika pengisian realisasi target mutu telah selesai seluruhnya informasikan lewat memo ke SPD-MR</form>

";

echo "
<p align=center>                     
<center><font size=2><b><a href=../../home.php?pages=sarmut><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>";

	 }
	 
	 
  else{
    echo "<center><font size=2><b>Tidak ditemukan sasaran mutu dengan bagian dan tahun tersebut<br></b><b><a href=../../home.php?pages=sarmut><--Kembali</a></b>";
  }
  
  
}

elseif ($module=='sarmut' AND $act=='carisarmut2'){
$kata1 = trim($_POST[kata1]);
$kata = trim($_POST[kata]);
echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen ISO 9001 : 2008 - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />
<SCRIPT language=JavaScript>
<!-- http://www.spacegun.co.uk -->
	var message = 'Tidak boleh klik kanan!'; 
	function rtclickcheck(keyp){ if (navigator.appName == 'Netscape' && keyp.which == 3){ 	alert(message); return false; } 
	if (navigator.appVersion.indexOf('MSIE') != -1 && event.button == 2) { 	alert(message); 	return false; } } 
	document.onmousedown = rtclickcheck;
</SCRIPT>
</head><body>";
 
 
    // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  
   $cari = "SELECT * FROM sarmut WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "cchl LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY no_target ASC";
  $hasil  = mysql_query($cari);
  $tampil = mysql_num_rows($hasil);

  $cari2 = "SELECT * FROM sarmut WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari2 .= "cchl LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari2 .= " OR ";
      }
    }
  $cari2 .= " ORDER BY no_target ASC";
  $hasil2  = mysql_query($cari2);
  $tampil2 = mysql_num_rows($hasil2);
$d=mysql_fetch_array($hasil2);

   if ($tampil > 0){

echo "
<html>
<head>
<title>Web Aplikasi Pengendalian Dokumen ISO 9001 : 2008 - PT. kimia Farma Plant Banjaran</title>
<link href=../../style.css rel=stylesheet type=text/css />
<SCRIPT language=JavaScript>
<!-- http://www.spacegun.co.uk -->
	var message = 'Tidak boleh klik kanan!'; 
	function rtclickcheck(keyp){ if (navigator.appName == 'Netscape' && keyp.which == 3){ 	alert(message); return false; } 
	if (navigator.appVersion.indexOf('MSIE') != -1 && event.button == 2) { 	alert(message); 	return false; } } 
	document.onmousedown = rtclickcheck;
</SCRIPT>
</head><body>";
    echo "<table><tr><td>Tgl Berlaku Lamp : <b></b></td></tr></table><br>";
   echo "<p align=right><img src=../../images/logokf.jpg alt=kimiafarma border=0/><br>";
   echo "<b><font size=2>...</b></font></p>";
echo "<center><font size=3><b>REALISASI PENCAPAIAN TARGET MUTU</b></FONT></center><br>
<p align=left>Bagian : $d[bagian]	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun : $kata1<br>
<center><table width=1100>
          <tr><th>Sasaran</th><th>Target</th><th>Periode Target</th><th>Metoda Pengukuran</th><th>Penanggung Jawab</th><th>Jan</th><th>Feb</th><th>Mar</th><th>TW-1</th><th>Apr</th><th>Mei</th><th>Jun</th><th>TW-2</th><th>Jul</th><th>Ags</th><th>Sep</th><th>TW-3</th><th>okt</th><th>Nop</th><th>Des</th><th>TW-4</th><tr>"; 
$tgl_sekarang = date("Y-m-d");
    while ($r=mysql_fetch_array($hasil)){
if ($r[tahun]==$kata1) {	 	 	  
echo "<tr><td align=left width=100>$r[sasaran]</td>";
echo "<td align=left width=150>$r[target]</td>";   
echo "<td align=center width=50>$r[periode_target] bulan</td>
             <td align=center width=50>$r[metoda]</td>
             <td align=center width=100>$r[pic]</td>" ;
			 
			   if ($r[trg_jan]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_jan]$r[satuan]</td>";
}
  if ($r[trg_feb]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_feb]$r[satuan]</td>";
}
  if ($r[trg_mar]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_mar]$r[satuan]</td>";
}
if ($r[trg_jan]=='' OR $r[trg_jan]=='0') 
{ 
$jan='0';
 } else {
$jan='1';} 
if ($r[trg_feb]=='' OR $r[trg_feb]=='0') 
{ 
$feb='0';
 } else {
$feb='1';} 
if ($r[trg_mar]=='' OR $r[trg_mar]=='0') 
{ 
$mar='0';
 } else {
$mar='1';} 

$twww1=($jan+$feb+$mar);
$tww1=($r[trg_jan]+$r[trg_feb]+$r[trg_mar])/$twww1;
$tw1 = round ($tww1,2);
if ($r[trg_jan]!='')
{
echo "<td align=center width=5>$tw1$r[satuan]";
echo"</td>";
}
elseif ($r[trg_feb]!=''){
echo "<td align=center width=5>$tw1$r[satuan]";
echo"</td>";
}
elseif ($r[trg_mar]!=''){
echo "<td align=center width=5>$tw1$r[satuan]";
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}

  if ($r[trg_apr]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_apr]$r[satuan]</td>";
}
  if ($r[trg_mei]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_mei]$r[satuan]</td>";
}
  if ($r[trg_jun]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_jun]$r[satuan]</td>";
}
if ($r[trg_apr]=='' OR $r[trg_apr]=='0') 
{ 
$apr='0';
 } else {
$apr='1';} 
if ($r[trg_mei]=='' OR $r[trg_mei]=='0') 
{ 
$mei='0';
 } else {
$mei='1';} 
if ($r[trg_jun]=='' OR $r[trg_jun]=='0') 
{ 
$jun='0';
 } else {
$jun='1';} 

$twww2=($apr+$mei+$jun);
$tww2=($r[trg_apr]+$r[trg_mei]+$r[trg_jun])/$twww2;
$tw2 = round ($tww2,2);
if ($r[trg_apr]!='')
{
echo "<td align=center width=5>$tw2$r[satuan]";
echo"</td>";
}
elseif ($r[trg_mei]!=''){
echo "<td align=center width=5>$tw2$r[satuan]";
echo"</td>";
}
elseif ($r[trg_jun]!=''){
echo "<td align=center width=5>$tw2$r[satuan]";
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}
  if ($r[trg_jul]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_jul]$r[satuan]</td>";
}
  if ($r[trg_ags]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_ags]$r[satuan]</td>";
}
  if ($r[trg_sep]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_sep]$r[satuan]</td>";
}
if ($r[trg_jul]=='' OR $r[trg_jul]=='0') 
{ 
$jul='0';
 } else {
$jul='1';} 
if ($r[trg_ags]=='' OR $r[trg_ags]=='0') 
{ 
$ags='0';
 } else {
$ags='1';} 
if ($r[trg_sep]=='' OR $r[trg_sep]=='0') 
{ 
$sep='0';
 } else {
$sep='1';} 

$twww3=($jul+$ags+$sep);
$tww3=($r[trg_jul]+$r[trg_ags]+$r[trg_sep])/$twww3;
$tw3 = round ($tww3,2);
if ($r[trg_jul]!='')
{
echo "<td align=center width=5>$tw3$r[satuan]";
echo"</td>";
}
elseif ($r[trg_ags]!=''){
echo "<td align=center width=5>$tw3$r[satuan]";
echo"</td>";
}
elseif ($r[trg_sep]!=''){
echo "<td align=center width=5>$tw3$r[satuan]";
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}
  if ($r[trg_okt]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_okt]$r[satuan]</td>";
}
  if ($r[trg_nov]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_nov]$r[satuan]</td>";
}
  if ($r[trg_des]=='' ){
echo "<td align=center width=5></td>";
}
else 
{
echo "<td align=center width=5>$r[trg_des]$r[satuan]</td>";
}
if ($r[trg_okt]=='' OR $r[trg_okt]=='0') 
{ 
$okt='0';
 } else {
$okt='1';} 
if ($r[trg_nov]=='' OR $r[trg_nov]=='0') 
{ 
$nov='0';
 } else {
$nov='1';} 
if ($r[trg_des]=='' OR $r[trg_des]=='0') 
{ 
$des='0';
 } else {
$des='1';} 

$twww4=($okt+$nov+$des);
$tww4=($r[trg_okt]+$r[trg_nov]+$r[trg_des])/$twww4;
$tw4 = round ($tww4,2);
if ($r[trg_okt]!='')
{
echo "<td align=center width=5>$tw4$r[satuan]";
echo"</td>";
}
elseif ($r[trg_nov]!=''){
echo "<td align=center width=5>$tw4$r[satuan]";
echo"</td>";
}
elseif ($r[trg_des]!=''){
echo "<td align=center width=5>$tw4$r[satuan]";
echo"</td>";
}
else
{
echo"<td align=center width=5></td>";
}			  
						   
echo " </tr>";
     }
	 else {
echo "";
}
	   }
	      echo "</table><br>
		  <p align=center>                     
<center><font size=2><b><a href=../../home.php?pages=sarmut><--Kembali</a><br><a href=javascript:print(document)><img src=../../images/printer.png alt=print this page border=0/>&#160;Print/Cetak Halaman Ini</a></p></b></center>
		  
		  ";



	 }
	 
	 
  else{
    echo "<center><font size=2>Tidak ditemukan sasaran mutu dengan bagian dan tahun tersebut<br><b><a href=../../home.php?pages=sarmut><--Kembali</a></b>";
  }
  
  
}

  
// Hapus sarmut
elseif ($module=='sarmut' AND $act=='hapus'){

echo "<p align=center><b>Apakah anda akan menghapus sasaran mutu ini ? <br></b>
<center><a href=$aksi?module=sarmut&act=hapus2&id=$_GET[id]>Ya !</a> - <a href=../../home.php?pages=sarmut>Tidak Jadi</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"
;
}

// Hapus sarmut 2
elseif ($module=='sarmut' AND $act=='hapus2'){
  mysql_query("DELETE FROM sarmut WHERE id_sarmut='$_GET[id]'");
  header('location:../../home.php?pages='.$module);

}

// Tambah sarmut
elseif ($module=='sarmut' AND $act=='input'){

  if (!empty($_POST[cchl])){
    $tag_new = $_POST[cchl];
    $tag=implode(', ',$tag_new);
  }
$lihatsarmut = mysql_query("SELECT * FROM sarmut WHERE bagian = '$_POST[bagian]' AND no_target = '$_POST[no_target]' ");
$lihatsarmut2 = mysql_num_rows($lihatsarmut);
if ($lihatsarmut2 > 0){
	 echo "<font size=6><center>No Urut target bagian tersebut Double!, mohon dicek dahulu ! <br><img src='../../images/bagus.gif'><br><a href=../../home.php?pages=sarmut>Kembali</a></font></center>";}
	 else {
 
mysql_query("INSERT INTO sarmut( bagian, tahun, sasaran, no_target, target, strategi, isi_target, minmax, satuan, periode_target, metoda, pic, file_pntpn_sarmut, file_daftar_induk, keterangan, cchl)  
VALUES('$_POST[bagian]','$_POST[tahun]','$_POST[sasaran]', '$_POST[no_target]', '$_POST[target]','$_POST[strategi]', '$_POST[isi_target]', '$_POST[minmax]', '$_POST[satuan]', '$_POST[periode_target]', '$_POST[metoda]', '$_POST[pic]', '$_POST[file_pntpn_sarmut]', '$_POST[file_daftar_induk]', '$_POST[keterangan]', '$tag')");
	
  
    echo "<p align=center><b>Sasaran Mutu untuk bagian $_POST[bagian] telah dibuat/ ditambah !<br></b>
<center><a href=../../home.php?pages=sarmut>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	

}
}

// Update sarmut
elseif ($module=='sarmut' AND $act=='update'){

  
if (!empty($_POST[cchl])){
    $tag_new = $_POST[cchl];
    $tag=implode(', ',$tag_new);
  }

if ($_POST[bagian]=='tidak'){

mysql_query("UPDATE sarmut SET 
tahun   	= '$_POST[tahun]',
sasaran  	= '$_POST[sasaran]',
no_target	= '$_POST[no_target]', 
target		= '$_POST[target]',
strategi	= '$_POST[strategi]',
isi_target  = '$_POST[isi_target]',
minmax		= '$_POST[minmax]',
satuan		= '$_POST[satuan]',
periode_target	= '$_POST[periode_target]', 
metoda		= '$_POST[metoda]', 
pic			= '$_POST[pic]', 
keterangan	= '$_POST[keterangan]', 
file_pntpn_sarmut	= '$_POST[file_pntpn_sarmut]', 
file_daftar_induk	= '$_POST[file_daftar_induk]', 
trg_jan		= '$_POST[trg_jan]', 
trg_feb		= '$_POST[trg_feb]', 
trg_mar		= '$_POST[trg_mar]', 
trg_apr  	= '$_POST[trg_apr]', 
trg_mei  	= '$_POST[trg_mei]', 
trg_jun  	= '$_POST[trg_jun]', 
trg_jul  	= '$_POST[trg_jul]', 
trg_ags 	= '$_POST[trg_ags]', 
trg_sep  	= '$_POST[trg_sep]', 
trg_okt  	= '$_POST[trg_okt]', 
trg_nov 	= '$_POST[trg_nov]', 
trg_des  	= '$_POST[trg_des]', 
cchl        = '$tag'
WHERE id_sarmut   = '$_POST[id_sarmut]'");

  }
  else 
  {
  
  mysql_query("UPDATE sarmut SET 
bagian      = '$_POST[bagian]',
tahun   	= '$_POST[tahun]',
sasaran  	= '$_POST[sasaran]',
no_target	= '$_POST[no_target]', 
target		= '$_POST[target]',
strategi	= '$_POST[strategi]',
isi_target  = '$_POST[isi_target]',
minmax		= '$_POST[minmax]',
satuan		= '$_POST[satuan]',
periode_target	= '$_POST[periode_target]', 
metoda		= '$_POST[metoda]', 
pic			= '$_POST[pic]', 
keterangan	= '$_POST[keterangan]', 
file_pntpn_sarmut	= '$_POST[file_pntpn_sarmut]', 
file_daftar_induk	= '$_POST[file_daftar_induk]', 
trg_jan		= '$_POST[trg_jan]', 
trg_feb		= '$_POST[trg_feb]', 
trg_mar		= '$_POST[trg_mar]', 
trg_apr  	= '$_POST[trg_apr]', 
trg_mei  	= '$_POST[trg_mei]', 
trg_jun  	= '$_POST[trg_jun]', 
trg_jul  	= '$_POST[trg_jul]', 
trg_ags 	= '$_POST[trg_ags]', 
trg_sep  	= '$_POST[trg_sep]', 
trg_okt  	= '$_POST[trg_okt]', 
trg_nov 	= '$_POST[trg_nov]', 
trg_des  	= '$_POST[trg_des]', 
cchl        = '$tag'
WHERE id_sarmut   = '$_POST[id_sarmut]'");
}
   
   echo "<p align=center><b>Sasaran mutu telah di edit !<br></b>
<center><a href=../../home.php?pages=sarmut>Kembali</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";	
}

// Update sarmut 2
elseif ($module=='sarmut' AND $act=='update2'){

mysql_query("UPDATE sarmut SET 
trg_jan		= '$_POST[trg_jan]', 
trg_feb		= '$_POST[trg_feb]', 
trg_mar		= '$_POST[trg_mar]', 
trg_apr  	= '$_POST[trg_apr]', 
trg_mei  	= '$_POST[trg_mei]', 
trg_jun  	= '$_POST[trg_jun]', 
trg_jul  	= '$_POST[trg_jul]', 
trg_ags 	= '$_POST[trg_ags]', 
trg_sep  	= '$_POST[trg_sep]', 
trg_okt  	= '$_POST[trg_okt]', 
trg_nov 	= '$_POST[trg_nov]', 
trg_des  	= '$_POST[trg_des]', 
tgl_jan		= '$_POST[tgl_jan]', 
tgl_feb		= '$_POST[tgl_feb]', 
tgl_mar		= '$_POST[tgl_mar]', 
tgl_apr  	= '$_POST[tgl_apr]', 
tgl_mei  	= '$_POST[tgl_mei]', 
tgl_jun  	= '$_POST[tgl_jun]', 
tgl_jul  	= '$_POST[tgl_jul]', 
tgl_ags 	= '$_POST[tgl_ags]', 
tgl_sep  	= '$_POST[tgl_sep]', 
tgl_okt  	= '$_POST[tgl_okt]', 
tgl_nov 	= '$_POST[tgl_nov]', 
tgl_des  	= '$_POST[tgl_des]'

WHERE id_sarmut   = '$_POST[id_sarmut]'");


  echo"<script LANGUAGE=JavaScript>
function closePg(){
	window.close();
	return true;
}
</script>
<body onLoad='return closePg()'></body>";

}

// Update sarmut 3
elseif ($module=='sarmut' AND $act=='update3'){

mysql_query("INSERT INTO hubungi(nama, subjek, pesan, tanggal) 
                        VALUES('$_POST[bagian]','$_POST[trg_feb] telah entry target mutu, silahkan cek!','$_POST[bagian] telah mengentry sasaran mutu mohon di cek. Terima kasih','$tgl_sekarang')");

   
echo"<p align=center><b>Sasaran mutu telah selesai anda Entry !<br></b>
<center><a href=../../home.php?pages=sarmut>Kembali ke halaman sasaran mutu!</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></body>";	
}
?>
