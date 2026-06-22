<?php
require_once "../cek_sesi.php";
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
require_once "../dompdf/dompdf_config.inc.php";
date_default_timezone_set("Asia/Jakarta");

if (($_SESSION['levelcv']=='0')||($_SESSION['levelcv']=='1'))
{
?>

<script type="text/javascript">
window.print() 
</script>

<style type="text/css">
#print {
	margin:auto;
	border:1px solid #2A9FAA;
	text-align:center;
	font-family:"Courier New", Courier, monospace;
	width:900px;
	font-size:14px;
}
#print .title {
	margin:auto;
	text-align:right;
	font-family:"Courier New", Courier, monospace;
	font-size:12px;
}
#print span {
	text-align:center;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;	
	font-size:18px;
}
#print table {
	border-collapse:collapse;
	width:95%;
	margin:20px;
}
#print .table1 {
	border-collapse:collapse;
	width:100%;
	text-align:center;
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
	font-size:10px;
	font:normal;
	text-transform:uppercase;
	height:30px;
}

#print table tr {
	font-family:Verdana, Geneva, sans-serif;
	font-size:10px
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
			<td><img src='../../images/logo.png'></td>
			<td valign='middle'>
				<H3>APLIKASI E-KFPB</H3>
            	<H1>KIMIA FARMA PLANT</H1>
				<h2>Banjaran</H2>
            </td>
		</tr>
        </table>		
			<hr><strong>PT. Kimia Farma (Persero) Tbk. Plant Banjaran</strong><hr>
            <?php
			echo "<div class='title'>Banjaran, $hari_ini $tanggal</div>";
			echo "<h3>REKAPITULASI PERSURATAN</h3>";
								
			echo "<table border='1'>
				<tr>
					<th rowspan='2'>USER</th>
					<th rowspan='2'>NAMA</th>
					<th colspan='3'>SURAT YANG DIKELUARKAN</th>
					<th colspan='3'>SURAT YANG DITERIMA</th>
				</tr>
				<tr>
					<th>SURAT KELUAR</th>
					<th>SURAT INTERNAL</th>
					<th>DISPOSISI</th>
					<th>SURAT MASUK</th>
					<th>SURAT INTERNAL</th>
					<th>DISPOSISI</th>
				</tr>";	
				
				$q = "SELECT a.cUser,a.cNama,
					 (SELECT COUNT(b.iid) FROM isurat b WHERE b.ikepada=a.cId) AS jsi,
					 (SELECT COUNT(c.oid) FROM osurat c WHERE c.opengirim=a.cId) AS jso,     
					 (SELECT COUNT(d.siid) FROM sinter d JOIN psin e ON d.siid=e.siid WHERE e.cId=a.cId) AS jtsinter,
					 (SELECT COUNT(f.iid) FROM isurat f JOIN pdis g ON f.iid=g.iid WHERE g.cId=a.cId) AS jtdis,
					 (SELECT COUNT(h.siid) FROM sinter h WHERE h.sipengirim=a.cId) AS jmsinter,
					 (SELECT COUNT(i.dId) FROM disposisi i WHERE i.dPendisposisi=a.cId) AS jmdis
					 FROM users a";
			  
				$rkp = mysql_query($q);
		
				while($s = mysql_fetch_array($rkp)) {
				echo "<tr>
						<td align='center'>$s[cUser]</td>
						<td>$s[cNama]</td>
						<td align='center'>$s[jso]</td>
						<td align='center'>$s[jmsinter]</td>
						<td align='center'>$s[jmdis]</td>
						<td align='center'>$s[jsi]</td>
						<td align='center'>$s[jtsinter]</td>
						<td align='center'>$s[jtdis]</td>
					 </tr>";	
				}	
				
			echo "</table>";
}
else
{
	exit;
}
?>