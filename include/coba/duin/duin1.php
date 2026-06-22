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
				<H3>APLIKASI ekfpb.com <br>KIMIA FARMA PLANT Banjaran</H3>
            </td>
		</tr>
        </table>		
	<hr border=1 color=black>
<?
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));

?>
<center><H3>Data Usulan Dokumen</h4></center>

<table width="100%" border=1>
	<tr><td width="20%">Nomor CC</td><td>: <b><?=$e[uccnmr];?></b></td></tr>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
	<tr><td>Kode Dokumen/Rev</td><td>: <b><?=$e[ukodok];?>/<?=$e[udrev];?></b></td></tr>
	<tr><td>Judul Dokumen</td><td>: <b><?=$e[ujudok];?></b></td></tr>
    <tr><td>Usulan dikirim oleh</td><td>: <b><?=$e[cNama];?> (<?=$e[cIdjab];?>)</b></td></tr>
    <tr><td>Tgl Terima SPD-MR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Dalam Proses</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai/Berlaku</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	</table>

<table><tr><td>Alasan/ Ringkasan/ Isi Usulan :</td>
<tr><td><?=$e[udket];?></td></tr>
</table>
</b></strong>
<?
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN duin d ON a.uid=d.uid
									WHERE b.cId='49' AND pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dPengirim='$_SESSION[cv]' AND uid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);
if ($jds>0){ ?>

<!-- isi alurusulan-->
<legend><center><b>Alur Usulan Dokumen (Kirim-Kembali Konsep Net Usulan) :</b></center></legend>
<table border=1 width=100%>
<thead>
	<td><b>Tgl Kirim</b></td>
    <td><b>Kepada</b></td>
	<td><b>Info Kirim</b></td>
	<td><b>Info Kembali</b></td>
	<td><b>Tgl Baca</b></td> 
	<td><b>Tgl Kembali</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM uddis a WHERE a.uid='$_GET[id]' ORDER BY a.pudid DESC");
				

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td>$tglBaca</td>
				<td>$tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td>$tglBaca</td>
				<td>$tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi alurusulan-->
<?php	
}
?>
<br>
<p align=center>Dokumen ini sah diterbitkan secara elektronik melalui sistem e-kfpb Kimia Farma Plant Banjaran sehingga tidak memerlukan tulisan atau tanda tangan/cap basah.</p>


<?php	
} ?>