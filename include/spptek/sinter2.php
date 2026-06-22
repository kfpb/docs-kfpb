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
			<td><center><b><img src='http://ekfpb.com/bdg/images/logo.png' width=200><br>F.../00<br>Tgl Berlaku :... </b></center></td>
			<td valign='middle'>
				<H2>APLIKASI KFPB.KIMIAFARMA.CO.ID <br>KIMIA FARMA PLANT BANJARAN</H2>
            </td>
		</tr>
        </table>		
	<hr border=1 color=black>
<?
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM spptek a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM spptek a,users b WHERE  a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
?>
<center><H3>Surat Permohonan Perbaikan/Pembelian Teknik (SPPTek)</h4></center>

<table border=0>
<thead>
	<td width="30%"><strong>Kepada Yth :</strong></td>
</thead>
<tr>
    <td>Bagian Teknik & Pemeliharaan</td>    
</tr>
<?php
// 	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cFoto, a.cJabatan,b.tgl_baca FROM users a
// 						LEFT JOIN pstek b ON b.cId=a.cId
// 						WHERE b.spptek_id='$_GET[id]'");
// 	$psn1 = mysql_query("SELECT tgl_bls FROM pstek WHERE spptek_id='$_GET[id]'");
// 	while ($t=mysql_fetch_array($psn)){
// 		$j++;
// 		echo "<tr>
// 				<td>$j. $t[cNama] ($t[cJabatan])
// 				</td>
// 			 </tr>";
// 	}
	?>
</table>


<table width="100%" border=0>
	<tr>
		<td width="24%"><strong>Nomor </strong></td>
		<td>: <?=$e[sinmr];?></td>
	</tr>
	<tr>
		<td><strong>Tanggal </strong></td>
		<td>: <?=tgl_indo($e[sitgl]);?></td>
	</tr>
	<tr>
		<td><strong>Jenis SPPTek </strong></td>
		<td>: <?=$e[jenispptek];?></td>
	</tr>
	<!--<tr><td><strong>Perihal</strong></td><td>: <?=$e[siperihal];?></td></tr>-->

</table>
<hr>

<!--<table width="100%" border=0>-->
<!--	<tr><td width="24%"><strong>Nomor </strong></td><td>: <?php //echo $e[sinmr];?></td></tr>-->
<!--    <tr><td><strong>Tanggal </strong></td><td>: <?php //echo tgl_indo($e[sitgl]);?></td></tr>-->
<!--    <tr><td><strong>Jenis SPPTek </strong></td><td>: <?php //echo $e[jenispptek];?></td></tr>-->
<!--<tr><td><strong>Perihal</strong></td><td>: <?php //echo $e[siperihal];?></td></tr>-->
<!--    <tr><td><strong>Keluhan</strong></td><td>: <?php //echo $e[keluhan];?></td></tr>-->
<!--    <tr><td><strong>Personil Yang bisa dihubungi</strong></td><td>: <?php //echo $e[personil];?></td></tr>-->
<!--</table>-->

<table>
	<table>
		<tr>
			<td align=top><b>Isi SPPTek :</b></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<? //if ($e[lokasi]=='-' OR $e[lokasi]!=''){
$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$e[lokasi]'"));
$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE aknomor='$e[aktiva]'"));
?>
				Dengan Hormat,<br><br>
				<p>Mohon bantuannya untuk dapat diperbaiki/ dibuat/ diganti/ dibeli* (*Coret salah satu) sebagai berikut
				: </p><br><br>
				
				<center><b><u>Di isi Bagian Teknik (Manual)</u></b></center>
				<table border=1 width=100%>
					<tr>
						<td>Tanggal Selesai Pengecekan : ----> Hasil Pengecekan & Barang/jasa yang diperlukan (bisa
							ditulis ditabel
							atas) <br>......<br><br>Oleh : .....</td>
					</tr>
					<tr>
						<td><br>
							No. Notif/ Order/ PR (SAP) : ................................... Tgl. Buat : .......... Tgl.
							Barang Datang :
							.........</td>
					</tr>
					<tr>
						<td><br>Tgl Mulai Pengerjaan : ........... Tgl Selesai Pengerjaan : ........... Tgl Rework (jika
							ada) :
							.......... </td>
					</tr>
					<tr>
						<td>Keterangan (Oleh Teknik) : ...<br></td>
					</tr>
					<tr>
						<td>Keterangan (Oleh User) : ...<br></td>
					</tr>
				</table>
				<b>No Aktiva</b> :
				<? echo"$aktiva[aknomor]"; ?><br>
				<b>Nama Aktiva</b> :
				<? echo"$e[aktiva] $aktiva[aknama] "; ?><br>
				<b>Lokasi</b> :
				<? echo"$e[lokasi] $lokasi[nama_area] "; ?><br>
				<b>Keluhan</b> :
				<? echo"$e[keluhan] "; ?><br>
				<b>Penyebab</b> :
				<? echo"$e[penyebab] "; ?><br><br>
				<b>Personil yang bisa dihubungi</b> :
				<? echo"$e[personil] "; ?><br><br>
				<? //} ?>

				<?=$e[siket];?>
			</td>
		</tr>

		<? if ($e[sipengirim2]==0){ echo"
    <tr><td align=top><b>Hormat Kami</b></td><td></td></tr><tr><td><strong>$e[cNama] ($e[cIdjab])</strong></td></tr>
	";
}
	else { echo"
	<tr><td align=top><b>Hormat Kami</b></td><td></td></tr><tr><td><strong>$ef[cNama] ($ef[cIdjab])</strong></td></tr>";
	}
?>
	</table>


	<table border=0>
		<thead>

			<td width="30%"><strong>Tembusan Yth :</strong></td>

		</thead>
		<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama, a.cIdjab, a.cFoto,b.tgl_baca FROM users a
						LEFT JOIN tsin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM tsin WHERE siid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$k++;
	
		
		echo "<tr>
			
				<td>
					$k. $t[cNama]  ($t[cUser])
				</td>
				
		
			 </tr>";
	}
	?>

	</table>
<br>

<p align=center>Dokumen ini sah diterbitkan secara elektronik melalui sistem e-kfpb Kimia Farma Plant Banjaran sehingga tidak memerlukan tanda tangan/cap basah.</p>


<?php	
} ?>