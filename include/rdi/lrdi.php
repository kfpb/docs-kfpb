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
			echo "<h3>LAPORAN DISPOSISI</h3>";
			echo "<h3>Periode ".tgl_indo($tglm)." - ".tgl_indo($tgls)."</h3>";
						
			echo "<table border='1'>
				<tr>
					<th align='center' width='4%'>NO</th>
					<th align='center' width='5%'>NO AGENDA</th>
					<th align='center' width='12%'>TANGGAL</th>
					<th align='center' width='20%'>PENDISPOSISI</th>
					<th align='center' width='20%'>INSTRUKSI/INFORMASI</th>
					<th align='center' width='20%'>SIFAT</th>
				</tr>";	
				
				$sft = Array("A"=>"Rutin","B"=>"Penting","C"=>"Rahasia");
				$qsm = mysql_query("SELECT a.dNoagenda, a.dTglM, b.cNama, a.dInstruksi, a.dSifat 
									FROM disposisi a 
									LEFT JOIN users b ON a.dPendisposisi=b.cId
									WHERE a.dTglM>='$_POST[tglm]' AND a.dTglM<='$_POST[tgls]'");
				
				while($s=mysql_fetch_array($qsm)){
					$no++;
					$sifat=$s[dSifat];
					echo "<tr>
							<td align='center'>$no</td>
							<td>$s[dNoagenda]</td>
							<td align='center'>";
							echo tgl_indo($s[dTglM]);
							echo "</td>
							<td align='center'>$s[cNama]</td>
							<td>$s[dInstruksi]</td>
							<td align='center'>$sft[$sifat]</td>
						 </tr>";
				}
			echo "</table>";
}
else
{
	exit;
}
?>