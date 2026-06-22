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
			<td><img src='http://ekfpb.com/bnj/images/logo.png'></td>
		</tr>
        </table>		
<?
$e = mysql_fetch_array(mysql_query("SELECT * FROM copydok WHERE oid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[opengirim]'"));
$efg = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[okepada]'"));
$lampiran = mysql_query("SELECT * FROM copydok_lampiran WHERE copydok_id='$_GET[id]'");

	        $sft = Array("1"=>"Controlled","2"=>"Uncontrolled","3"=>"Batch Record","4"=>"Email/File");
			$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
			$jenis = "<span class='label label-".$bdg[$e[jenisms]]."'>".$sft[$e[jenisms]]."</span>";


	
?>
<center><H4><font face=arial>Permohonan (Salinan) Copy Dokumen</font></h4></center>



<table width="100%" border=0>
    <tr><td width=200>Tanggal Permohonan </td><td>: <b><?=tgl_indo($e[otgl]);?></b></td></tr>
    <tr><td>Pemohon Dari</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cIdjab];?>)</strong></td></tr>
    <tr><td>Kepada Yth </td><td>: <b>SPD-MR</b></td></tr>	
	 <tr><td>Tanggal Terima SPD </td><td>: <?=tgl_indo($e[otgl_admin]);?></td></tr>

</table>
<br></b>

<table width="100%" border=0>
    <tr><td align=top><b>Dengan hormat,
Mohon dapat diberi dokumen salinan <b><? echo"$jenis";?></b> sebagai berikut  :
</b></td></tr>
<?php if($e[dinmr]){?>
    
	<tr><td>
    	<table border="1" style="width:100%">
    	<tbody>
    		<tr>
    			<td>
    			<p><strong>No</strong></p>
    			</td>
    			<td>
    			<p><strong>Kode Dokumen(R)/Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Judul Dokumen/ Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Revisi</strong></p>
    			</td>
    			<td>
    			<p><strong>Jumlah</strong></p>
    			</td>
    			<td>
    			<p><strong>Lokasi Dokumen</strong></p>
    			</td>
    			<td>
    			<p><strong>Keterangan</strong></p>
    			</td>
    			<td>
    			<p><strong>Tgl Terima</strong></p>
    			</td>
    			<td>
    			<p><strong>Paraf</strong></p>
    			</td>
    		</tr>
    		<tr>
    			<td></td>
    			<td><?=$e[dinmr];?></td>
    			<td><?=$e[dijudok];?></td>
    			<td><?=$e[direv];?></td>
    			<td><?=$e[dijumlah];?></td>
    			<td><?=$e[dilokasi];?></td>
    			<td><?=$e[diketdok];?></td>
    			<td></td>
    			<td></td>
    		</tr>
    		<tr>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
    		</tr>
    	</tbody>
    </table>
</td></tr>
<p>&nbsp;</p>

	<?php }elseif($lampiran != null){ ?>
	<tr><td>
    	<table border="1" style="width:100%">
    	<tbody>
    		<tr>
    			<td>
    			<p><strong>No</strong></p>
    			</td>
    			<td>
    			<p><strong>Kode Dokumen(R)/Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Judul Dokumen/ Produk</strong></p>
    			</td>
    			<td>
    			<p><strong>Revisi</strong></p>
    			</td>
    			<td>
    			<p><strong>Jumlah</strong></p>
    			</td>
    			<td>
    			<p><strong>Lokasi Dokumen</strong></p>
    			</td>
    			<td>
    			<p><strong>Keterangan</strong></p>
    			</td>
    			<td>
    			<p><strong>Tgl Terima</strong></p>
    			</td>
    			<td>
    			<p><strong>Paraf</strong></p>
    			</td>
    		</tr>
    		<?php
    		$i = 1;
    			while ($lmp=mysql_fetch_array($lampiran)){
				?>
    		<tr>
    			<td><?= $i; ?></td>
    			<td><?=$lmp[dinmr];?></td>
    			<td><?=$lmp[dijudok];?></td>
    			<td><?=$lmp[direv];?></td>
    			<td><?=$lmp[dijumlah];?></td>
    			<td><?=$lmp[dilokasi];?></td>
    			<td><?=$lmp[diketdok];?></td>
    			<td></td>
    			<td></td>
    		</tr>
    		<?  $i++; } ?>
    	
    	</tbody>
    </table>
</td></tr>
<p>&nbsp;</p>
	
	
	<?php }else{ ?>
	
	
	<tr><td><?php echo $e[oket];?></td></tr>
	
	<?php } ?>
</table>
</strong>

<br>
<? echo"
<p align=center>Dokumen ini sah diterbitkan secara elektronik melalui sistem e-kfpb Kimia Farma Plant Banjaran sehingga permohonan copy tidak memerlukan tanda tangan/cap basah.</p>";
?>
</div>

<?php	
} ?>