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
			<td><img src='http://ekfpb.com/bdg/images/logo.png' width=200></td>
			<td valign='middle'>
				<H2>APLIKASI ekfpb.com <br>KIMIA FARMA PLANT Banjaran</H2>
            </td>
		</tr>
        </table>		
	<hr border=1 color=black>
<?
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM minter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM minter a,users b WHERE  a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
?>
<center><H3>Permohonan Mutasi Pegawai Sementara</h4></center>


<table width="100%" border=0>
	<tr><td width="24%"><strong>Nomor </strong></td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td><strong>Tanggal </strong></td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
    <tr><td><strong>Perihal</strong></td><td>: <?=$e[siperihal];?></td></tr>
	</table>
	<table>
    <tr><td align=top><b>Isi Permohonan Mutasi :</b></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
	<tr><td align=top><br><b></b></td><td></td></tr><tr><td></td></tr>
		<tr><td align=top><br><b></b></td><td></td></tr><tr><td></td></tr>
			<tr><td align=top><br><b></b></td><td></td></tr><tr><td></td></tr>
<? if ($e[sipengirim2]==0){ echo"
    <tr><td align=top><b>Pemberi Perintah</b></td><td></td></tr><tr><td><strong>$e[cNama] ($e[cIdjab])</strong></td></tr>
	";
}
	else { echo"
	<tr><td align=top><b>Pemberi Perintah</b></td><td></td></tr><tr><td><strong>$ef[cNama] ($ef[cIdjab])</strong></td></tr>";
	}
?>
</table>



<p align=center>Dokumen ini sah diterbitkan secara elektronik melalui sistem e-kfpb Kimia Farma Plant Banjaran sehingga tidak memerlukan tanda tangan/cap basah.</p>


<?php	
} ?>