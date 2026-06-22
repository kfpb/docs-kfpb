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
				<H2>APLIKASI eKFPB <br>KIMIA FARMA PLANT BANJARAN</H2>
            </td>
		</tr>
        </table>		
	<hr border=1 color=black>
<?
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));
$s = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a, users b WHERE a.ikepada=b.cId"));	

if ($e[ikepada]==$_SESSION[cv]){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE tsurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");

}
?>
<center><H3>Tela'ahan Pengadaan Barang atau Jasa</h4></center>

<table width="100%" border=1>
	<tr><td><?=$e[iket];?></td></tr>
</table>

<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM tisposisi a 
									LEFT JOIN tdis b ON a.iid=b.iid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN tuin d ON a.iid=d.iid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.iid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM tisposisi WHERE dPentisposisi='$_SESSION[cv]' AND iid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPtisposisi FROM tisposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ ?>

<!-- isi tisposisi-->
<table border=1>
<thead>
	<td align=center width=5%><b>No</b></td>
    <td align=center width=15%><b>Kepada</b></td>
	<td><b>Pendapat/Disposisi</b></td>
	<td align=center width=15%><b>Paraf/ Tanggal ACC Elektronik</b></td> 
    
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM tdis a WHERE a.iid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.urut ASC");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum ACC</span>";
	}
	if ($t[psACC]=="N"){
	    	$tglSelesai = tgl_indo($t[psTglselesai]);
		echo "<tr>
				<td align=center >$t[urut]</td>
				<td align=center >$t[kepada] ($t[kepadajab])</td>
				<td>$t[info]</td>
				<td align=center >$tglSelesai</td>
			 </tr>";
	}else{
	    	$tglSelesai = tgl_indo($t[psTglselesai]);
		echo "<tr class='info'>
				<td align=center >$t[urut]</td>
				<td align=center >$t[kepada] ($t[kepadajab])</td>
				<td>$t[info]</td>
				<td align=center >$tglSelesai</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi tisposisi-->
<?php	
}
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
?>
<table width="100%">
	<tr><td></td><td></td><td align=right>Banjaran, <?=tgl_indo($e[itgl]);?><br><br><br><br><b>Bagian Pembelian</b><br>Plant Banjaran</td></tr>
</table>

<p align=center>Dokumen ini sah diterbitkan secara elektronik melalui sistem e-kfpb Kimia Farma Plant Banjaran sehingga tidak memerlukan tandatangan/paraf/cap basah.</p>


<?php	
} ?>