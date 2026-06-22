<?php
if($_GET['act']=="print"){
?>
<script type="text/javascript">
window.print() 
</script>

<style type="text/css">
#print {
	margin:auto;
	border:1px solid #FFFF;
	text-align:left;
	font-family:"Courier New", Courier, monospace;
	width:900px;
	font-size:14px;
}
#print .title {
	margin:auto;
	text-align:right;
	font-family:"Courier New", Courier, monospace;
	font-size:14px;
}
#print span {
	text-align:left;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;	
	font-size:14px;
}
#print table {
	border-collapse:collapse;
	width:90%;
	margin:10px;
}
#print .table1 {
	border-collapse:collapse;
	width:100%;
	text-align:left;
}
#print .table2 {
	margin:10px;
	border-collapse:collapse;;
	width:auto;
}
#print table hr {
	border:1px dashed #A0A0A4;	
}
#print .ttd {
	margin-right:500px;
}
#print table th {
	background:#A0A0A4;
	color:#000;
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
	font:normal;
	text-transform:uppercase;
	height:30px;
}

#print table tr {
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px
}

#print .grand {
	width:700px;
	padding:10px;
	text-align:left;	
}
#print .grand table {
	margin-left:-90px;	
}
#logo{
	width:111px;
	height:90px;
	padding-top:10px;	
	margin-left:10px;
}
</style>

<title>Aplikasi Document Management System - Kimia Farma Plant Banjaran</title>
<?php

	$tanggal = tgl_indo(date("Y-m-d"));
	$jam     = date("H:i:s");
	$hari_ini = $seminggu[$hari];
	$tglm = $_POST[tglm];
	$tgls = $_POST[tgls];
	
?>
	<div id="print">
		<table class='table1'>
                <tr border=1><td><font size=1>
                <b>Lampiran Ke 11</b><br>
                No Dokumen F-PQS-01-001-11/09<br>
               Tanggal Efektif 21 Nov 23<br>
                </font></td>
  <!--              </tr>-->
		<!--<tr>-->
			<td align=right><img src='http://edoc.kimiafarma.co.id/images/logo.png'><br></td>
		</tr>
        </table>		
<?
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));

    $dok = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE dikodok='$e[dikodok]'"));
	
?>
<center><h2><font face=arial>Lembar Distribusi Dokumen</font></h2></center>

<table width="100%" border=0>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
    <tr><td width=200>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
    <tr><td width=200>Revisi</td><td>: <?=$e[direv];?></td></tr>
    <tr><td>Level Dokumen</td><td>: <?=$ef[jenisdok];?></td></tr>
	</table>
<table width=100% border=1>
<tr>
	<td rowspan=2 width=3%><b><center>No</center></b></td>
	<td rowspan=2 width=25%><b><center>Bagian Penerima Dokumen</center></b></td>
	<td rowspan=2 width=10%><b><center>Jumlah Copy</center></b></td>
	<td rowspan=2 width=10%><b><center>Nama Penerima</center></b></td>
	<td rowspan=2 width=10%><b><center>Nama Yang Menyerahkan</center></b></td>
</tr>
<tr>
	<td width=10%><b><center>Tanggal</center></b></td>
	<td width=10%><b><center>Tanda Tangan</center></b></td>
	<td width=10%><b><center>Keterangan</center></b></td>
</tr>
<?php
	$psn = mysql_query("SELECT a.*,b.* FROM users a
						LEFT JOIN disin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.copyke ASC");
	$psn1 = mysql_query("SELECT tgl_baca FROM disin WHERE suid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		
		echo "<tr>
		        <td><center>$t[copyke]<br>&nbsp</center></td>
				<td>$t[cJabatan]
				</td>
				<td></td>
				<td>$t[cNama] </td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			 </tr>";
	}
	?>
</table><br>
<p align=right>
Banjaran, <?=tgl_indo($e[ditgl]);?><br><br><br><br>Supervisor <b>Sistem Dokumentasi</b></strong>

<br>
<table border=1 width=100%>
<tr><td><font size=2>
<b>Keterangan :</b><br>
Dokumen Level 1 : Manual Mutu<br>
Dokumen Level 2 : Prosedur Sistem Manajemen Mutu<br>
Dokumen Level 3 : Instruksi Kerja<br>
Dokumen Level 4 : Catatan Mutu/Dokumen<br>
</font></td></tr>
</table>

</div>

<?php	
} 
elseif($_GET['act']=="print1"){
?>
<script type="text/javascript">
window.print() 
</script>

<style type="text/css">
#print {
	margin:auto;
	border:1px solid #FFFF;
	text-align:left;
	font-family:"Courier New", Courier, monospace;
	width:900px;
	font-size:14px;
}
#print .title {
	margin:auto;
	text-align:right;
	font-family:"Courier New", Courier, monospace;
	font-size:14px;
}
#print span {
	text-align:left;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;	
	font-size:14px;
}
#print table {
	border-collapse:collapse;
	width:90%;
	margin:10px;
}
#print .table1 {
	border-collapse:collapse;
	width:100%;
	text-align:left;
}
#print .table2 {
	margin:10px;
	border-collapse:collapse;;
	width:auto;
}
#print table hr {
	border:1px dashed #A0A0A4;	
}
#print .ttd {
	margin-right:500px;
}
#print table th {
	background:#A0A0A4;
	color:#000;
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
	font:normal;
	text-transform:uppercase;
	height:30px;
}

#print table tr {
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px
}

#print .grand {
	width:700px;
	padding:10px;
	text-align:left;	
}
#print .grand table {
	margin-left:-90px;	
}
#logo{
	width:111px;
	height:90px;
	padding-top:10px;	
	margin-left:10px;
}
</style>

<title>Aplikasi Document Management System - Kimia Farma Plant Banjaran</title>
<?php

	$tanggal = tgl_indo(date("Y-m-d"));
	$jam     = date("H:i:s");
	$hari_ini = $seminggu[$hari];
	$tglm = $_POST[tglm];
	$tgls = $_POST[tgls];
	
?>


	<div id="print">
		<table class='table1'>
                <tr border=1><td><font size=1>
                <b>Lampiran Ke 11</b><br>
                No Dokumen F-PQS-01-001-11/09<br>
               Tanggal Efektif 23 Nov 23<br>
                </font></td>
  <!--              </tr>-->
		<!--<tr>-->
			<td align=right><img src='http://edoc.kimiafarma.co.id/images/logo.png'><br></td>
		</tr>
        </table>		
<?
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM dister a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));

    $dok = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE dikodok='$e[dikodok]'"));
	
?>
<center><h2><font face=arial>Formulir Penarikan Dokumen</font></h2></center>

<table width="100%" border=0>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?></td></tr>
    <tr><td width=200>Kode Dokumen</td><td>: <?=$e[dikodok];?></td></tr>
    <tr><td width=200>Revisi</td><td>: <?=$e[direv];?></td></tr>
    <tr><td>Level Dokumen</td><td>: <?=$ef[jenisdok];?></td></tr>
	</table>
<table width=100% border=1>
<tr>
	<td rowspan=2 width=3%><b><center>No</center></b></td>
	<td rowspan=2 width=25%><b><center>Bagian Penerima Dokumen</center></b></td>
	<td rowspan=2 width=10%><b><center>Jumlah Yang diterima</center></b></td>
	<!--<td colspan=3><b><center>Tanda Terima & Penarikan Dokumen</center></b></td>-->
	<!--<td rowspan=2 width=10%><b><center>Nama Penerima</center></b></td>-->
	<!--<td rowspan=2 width=10%><b><center>Tanggal</center></b></td>-->
	<!--<td rowspan=2 width=10%><b><center>Tanda Tangan</center></b></td>-->
	<td rowspan=2 width=10%><b><center>Jumlah Yang Ditarik</center></b></td>
	<td rowspan=2 width=10%><b><center>Nama Yang Menyerahkan</center></b></td>
	<!--<td rowspan=2 width=10%><b><center>Keterangan</center></b></td>-->
</tr>
<tr>
	<td width=10%><b><center>Tanggal</center></b></td>
	<td width=10%><b><center>Tanda Tangan</center></b></td>
	<td width=10%><b><center>Keterangan</center></b></td>
</tr>
<?php
	$psn = mysql_query("SELECT a.*,b.* FROM users a
						LEFT JOIN disin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.copyke ASC");
	$psn1 = mysql_query("SELECT tgl_baca FROM disin WHERE suid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		
		echo "<tr>
		        <td><center>$t[copyke]<br>&nbsp</center></td>
				<td>$t[cNama] ($t[cJabatan])<br>&nbsp
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			 </tr>";
	}
	?>
</table><br>
<p align=right>
Banjaran, <?=tgl_indo($e[ditgl]);?><br><br><br><br>Supervisor <b>Sistem Dokumentasi</b></strong>

<br>
<table border=1 width=100%>
<tr><td><font size=2>
<b>Keterangan :</b><br>
Dokumen Level 1 : Manual Mutu<br>
Dokumen Level 2 : Prosedur Sistem Manajemen Mutu<br>
Dokumen Level 3 : Instruksi Kerja<br>
Dokumen Level 4 : Catatan Mutu/Dokumen<br>
</font></td></tr>
</table>

</div>

<?php	
} ?>