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
	
			<p align=right><img src='http://ekfpb.com/bdg/include/ncinter/logo.png'>
			<br>FQA-04-0001-01/04
				
<?
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim1=b.cId AND a.ncid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim=b.cId AND a.ncid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jnc FROM jenisnc WHERE kode_jnc='$ef[jenisnc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim2=b.cId AND a.ncid='$_GET[id]'"));


	
?>
<center><h3><font face=arial>Formulir Penyimpangan</font></h3></center>


	
	<table width="100%" border=1>
    <tr><td>Penyimpangan No: <?=$e[ncnmr1];?><br>&nbsp</td><td>Tanggal : <?=$e[nctgl];?><br>&nbsp</td></tr>
	<tr><td>Diusulkan Bagian : <?=$ef[cJabatan];?>, <?=$e[cJabatan];?><br>&nbsp</td><td>Tanda Tangan : <?=$e[nctgl];?><br>&nbsp</td></tr>
	</table>
	
	<table width="100%">
    <tr><td width=200>Nama Produk/Bahan/Alat/Ruangan/Prosedur*</td><td>: <?=$e[ncperihal1];?></td></tr>
    <tr><td>No. Kode Sediaan/Bahan/Alat/Ruangan/Prosedur*</td><td>: <?=$e[ncperihal];?></td></tr>
    <tr><td>Tingkat Penyimpangan</td><td>: <?=$e[nctingkat];?></td></tr>
    <tr><td>Jenis Penyimpangan</td><td>: <?=$efg[nama_jnc];?></td></tr>
	<tr><td></td><td></td></tr>
	<tr><td>Deskripsi Penyimpangan :</td><td></td></tr>
	</table>
	<table width="100%" border=1>
	<tr><td width=25%>Proses/Prosedur/Perihal Yang Berlaku :</td><td><?=$e[ncket];?></td></tr>
	<tr><td>Penyimpangan :</td><td><?=$e[ncket2];?></td></tr>
	<tr><td>Alasan Penyimpangan :</td><td><?=$e[ncket3];?></td></tr>
	<tr><td>Daftar Dokumen yang berkaitan dengan Penyimpangan : </td><td><?=$e[ncket4];?></td></tr>

	</table>

<table border=0 width=100%>
<tr><td><font size=2>
Catatan :<br>(*) Coret yang tidak perlu<br>
</font></td></tr>
</table>

</div>

<?php	
} ?>