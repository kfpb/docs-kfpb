<?php
if($_GET[act]=="print"){
?>
<script type="text/javascript">
window.print() 
</script>

<style type="text/css">
#print {
	margin:auto;
	border:1px solid #2A9FAA;
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
	width:95%;
	margin:20px;
}
#print .table1 {
	border-collapse:collapse;
	width:100%;
	text-align:left;
}
#print .table2 {
	margin:20px;
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

<title>E-KFPB Kimia Farma Plant Banjaran</title>
<?php

	$tanggal = tgl_indo(date("Y-m-d"));
	$jam     = date("H:i:s");
	$hari_ini = $seminggu[$hari];
	$tglm = $_POST[tglm];
	$tgls = $_POST[tgls];
	
?>
	<div id="print">
		<table class='table1'>
		<tr>
			<td align="center"><img src='http://ekfpb.com/bdg/include/dointer/logo.png'></td>
		</tr>
        </table>		
<?
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));

	
?>
<center><h2><font face=arial>Laporan Sosialisasi Dokumen MK3L</font></h2></center>

<table width="100%" border=0>
    <tr><td width=200>Kode Dokumen</td><td>: <?=$e[dikodok];?> - Revisi : <?=$e[direv];?></td></tr>
	<tr><td>Judul Dokumen</td><td>: <?=$e[dijudok];?> (<?=$e[jenisdok];?>)</td></tr>
<table width=100% border=1>
<tr>
	<td width=3%><b><center>No</center></b></td>
	<td width=25%><b><center>Penerima Sosialisasi Dokumen</center></b></td>
	<td width=10%><b><center>Tanggal Baca</center></b></td>
</tr>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cFoto, a.cJabatan,b.tgl_baca, b.copyke FROM users a
						LEFT JOIN dosin b ON b.cId=a.cId
						WHERE b.suid='$_GET[id]' ORDER BY b.copyke ASC");
	$psn1 = mysql_query("SELECT tgl_bls FROM dosin WHERE suid='$_GET[id]'");
	$no=0;
	while ($t=mysql_fetch_array($psn)){
		$no++;
		
		echo "<tr>
		        <td><center>$no<br>&nbsp</center></td>
				<td>$t[cNama] ($t[cJabatan])<br>&nbsp
				</td>
				<td>$t[tgl_baca]</td>

			 </tr>";
	}
	?>
</table><br>
<p align=right>Tanggal Print :<br>
Banjaran, <?=tgl_indo($e[ditgl]);?><br><br><br><br><b>(MR)</b></strong>

<br>
<table border=1 width=100%>
<tr><td><font size=2>

</font></td></tr>
</table>

</div>

<?php	
} ?>