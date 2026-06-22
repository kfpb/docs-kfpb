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
			<br>FQA-04-0001-02/02
				
<?
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim1=b.cId AND a.ncid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim=b.cId AND a.ncid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jnc FROM jenisnc WHERE kode_jnc='$ef[jenisnc]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cJabatan FROM ncinter a,users b WHERE a.ncpengirim2=b.cId AND a.ncid='$_GET[id]'"));


	
?>
<center><h3><font face=arial>Formulir Persetujuan Penyimpangan</font></h3></center>

	<table width="100%">
	 <tr><td width=400>Penyimpangan No:</td><td><?=$e[ncnmr1];?></td></tr>
    <tr><td width=400>Nama Prod/Bhn/Alat/Ruangan/Prosedur*:</td><td><?=$e[ncperihal1];?></td></tr>
    <tr><td width=400>No.Kode Sediaan/Bhn/Alat/Ruangan/Prosedur*:</td><td><?=$e[ncperihal];?></td></tr>

	</table>
<? if ($e[ceklist]==1){
echo"
<table border=0 width=100%>
<tr><td><font size=2>
Ceklist Persiapan Penyimpangan/Change Preparation Checklist : </b><br><br>
|v| Penyimpangan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulatori terkait diterima Penyimpangan telah disetujui oleh BPOM/Regulatori terkait, tanggal : ......<br><br>
| | Penyimpangan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulatori terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulatori terkait bersama dengan Penyimpangan dokumen secara bertahap<br><br>
| | Tidak perlu pemberitahuan kepada BPOM/Regulatori terkait<br>
</font></td></tr>
</table>";
}
elseif ($e[ceklist]==2) {
echo"
<table border=0 width=100%>
<tr><td><font size=2>
Ceklist Persiapan Penyimpangan/Change Preparation Checklist : </b><br><br>
| | Penyimpangan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulatori terkait diterima Penyimpangan telah disetujui oleh BPOM/Regulatori terkait, tanggal : ......<br><br>
|v| Penyimpangan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulatori terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulatori terkait bersama dengan Penyimpangan dokumen secara bertahap<br><br>
| | Tidak perlu pemberitahuan kepada BPOM/Regulatori terkait<br>
</font></td></tr>
</table>";
}
else {
echo"
<table border=0 width=100%>
<tr><td><font size=2>
Ceklist Persiapan Penyimpangan/Change Preparation Checklist : </b><br><br>
| | Penyimpangan tidak dapat dilaksanakan sebelum persetujuan BPOM/Regulatori terkait diterima Penyimpangan telah disetujui oleh BPOM/Regulatori terkait, tanggal : ......<br><br>
| | Penyimpangan dapat langsung dilaksanakan tanpa menunggu izin dari BPOM/Regulatori terkait, dengan catatan pemberitahuan akan disampaikan ke BPOM/Regulatori terkait bersama dengan Penyimpangan dokumen secara bertahap<br><br>
|v| Tidak perlu pemberitahuan kepada BPOM/Regulatori terkait<br>
</font></td></tr>
</table>";
}
?>

<?

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM ntnc a 
									LEFT JOIN cdis b ON a.ncid=b.ncid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN ncinter d ON a.ncid=d.ncid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.ncid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM ntnc WHERE dPendisposisi='60' AND ncid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM ntnc a WHERE a.ncid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ncid='$_GET[id]' AND a.pId='60' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>


<!-- isi disposisi-->
<b><center>Kajian terhadap Penyimpangan (Persiapan dan Dampak Penyimpangan)</b></center>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td><b><center>Rencana Tindakan</center></b></td>
	<td><b><center>Kode Dokumen</center></b></td>
	<td><b><center>Batas Waktu</b></center></td>
    <td><b><center>PenanggungJawab</b></center></td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cJabatan FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM cdis a WHERE a.ncid='$_GET[id]' AND a.pId='60' ORDER BY a.pdid DESC");
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
				<td>$t[kode_dok]/$t[revisi]</td>
				<td>$tgltarget
				</td>
				<td>$t[kepadajab]</td>
			 </tr>";
	}else{
		echo "<tr>
					<td width=400>$t[pInstruksi]</td>
				<td>$t[kode_dok]/$t[revisi]</td>
				<td>$tgltarget
				</td>
				<td>$t[kepadajab]</td>
			 </tr>";
	}
}
?>
<? echo"</table>*Coret yang tidak perlu"; } ?>
<br><br>
<b><center>Dengan ini kami telah menyetujui hasil pembahasan Penyimpangan pada tanggal ...........</b></center>
<table class="table table-bordered table-striped" width="100%" border=1>
<thead>
	<td><center>Bagian/Sub Bagian</center></td>
    <td><center>Nama</center></td>
	<td><center>Tanda Tangan</center></td>
	<td><center>Komentar</center></td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cJabatan, a.cFoto, a.cJabatan,b.tgl_baca, b.nama FROM users a
						LEFT JOIN csin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM csin WHERE ncid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		if ($t[nama]=='') {
		echo "<tr>
			<td width=100>$t[cUser]<br><br><br></td>
				<td>
					$t[cNama]
				</td>
				<td width=200>$t[tgl_baca]</td>
				<td>$t[comment]</td>
			 </tr>";
			 
		}
		else
		{
		    	echo "<tr>
			<td width=100>$t[cUser]<br><br><br></td>
				<td>
					$t[nama]
				</td>
				<td width=200>$t[tgl_baca]</td>
				<td>$t[comment]</td>
			 </tr>";
		}
	}
	?>
</table>
<br /><br />
<b><center></b>Penyimpangan Disetujui oleh :</center></b>
<table class="table table-bordered table-striped" width="100%" border=1>
<thead>
	<td><center>Bagian/Sub Bagian</center></td>
    <td><center>Nama</center></td>
	<td><center>Tanda Tangan</center></td>
	<td><center>Komentar</center></td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama, a.cJabatan, a.cFoto,b.tgl_baca, b.nama FROM users a
						LEFT JOIN ncsin b ON b.cId=a.cId
						WHERE b.ncid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM ncsin WHERE ncid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$k++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
	  if ($t[nama]=='') {
		
		echo "<tr>
				<td width=100>$t[cUser]<br><br><br></td>
				<td>
					$t[cNama]  
				</td>
				
				<td width=200>$t[tgl_baca]</td>
				<td>$t[comment]</td>
			 </tr>";
	  }
	  else {
	      		echo "<tr>
				<td width=100>$t[cUser]<br><br><br></td>
				<td>
					$t[nama]  
				</td>
				
				<td width=200>$t[tgl_baca]</td>
				<td>$t[comment]</td>
			 </tr>";
	  }
	}
	?>
</table>

</div>

<?php	
} ?>