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
	width:1200px;
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
			<br>...
				
<?
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim1=b.cId AND a.ncid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim=b.cId AND a.ncid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jnc FROM jenisnc WHERE kode_jnc='$ef[jenisnc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim2=b.cId AND a.ncid='$_GET[id]'"));


	
?>
<center><h3><font face=arial>Formulir Verifikasi Tindak Lanjut Penyimpangan</font></h3></center>

	<table width="100%">
	 <tr><td>Penyimpangan No:</td><td><?=$e[ncnmr1];?></td></tr>
    <tr><td width=400>Nama Prod/Bhn/Alat/Ruangan/Prosedur*:</td><td><?=$e[ncperihal1];?></td></tr>
    <tr><td width=400>No.Kode Sediaan/Bhn/Alat/Ruangan/Prosedur*:</td><td><?=$e[ncperihal];?></td></tr>

	</table>

<?

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM ntnc a 
									LEFT JOIN cdis b ON a.ncid=b.ncid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ncinter d ON a.ncid=d.ncid
									WHERE b.cId='$_SESSION[cv]' AND pdid=60 AND a.ncid=$_GET[id] OR b.cId='$_SESSION[cv]' AND pdid=49 AND a.ncid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM ntnc WHERE dPendisposisi='60' AND ncid='$_GET[id]' OR dPendisposisi='49' AND ncid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM ntnc a WHERE a.ncid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ncid='$_GET[id]' AND a.pId='49' OR a.ncid='$_GET[id]' AND a.pId='60' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>


<!-- isi disposisi-->

<table class="table table-bordered" border=1 width="100%">
<thead>
	<td><b><center>Rencana Tindakan</center></b></td>
    <td><b><center></b></center></td>
	<td><b><center>Tgl. Selesai/ Verifikasi</b></center></td> 
	<td><b><center>Hasil Tindakan/ Verifikasi</b></center></td>
    <td><b><center>Tgl Verifikasi Selanjutnya**</b></center></td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ncid='$_GET[id]' AND a.pId='60' OR a.ncid='$_GET[id]' AND a.pId='49' ORDER BY a.pdid DESC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psacc, b.psTglbaca FROM users a LEFT JOIN cdis b ON b.cId=a.cId WHERE b.ncid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	$tgltarget2 = tgl_indo($t[ptgls2]);
	$tgltarget3 = tgl_indo($t[ptgls3]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psacc]=="N"){
		echo "<tr>
				<td width=400>$t[pInstruksi]</td>
				<td>PIC :<br>($t[kepadajab])</td>
				<td>$tglSelesai</td>
				<td width=400>$t[info]</td>
				<td></td>
			 </tr>";
	}else{
		echo "<tr>
				<td width=400>$t[pInstruksi]</td>
				<td>PIC :<br>($t[kepadajab])</td>
				<td>$tglSelesai</td>
                <td width=400>$t[info]</td>
                <td></td>
			 </tr>";
	}
}
?>
<? echo"</table>*Coret yang tidak perlu<br>**Bila belum selesai"; } ?>
<br><br>


</div>

<?php	
} ?>