<?php
include "../../config/koneksi.php";
if($_GET[act]=="print"){
?>
<script type="text/javascript">
window.print() 
</script>

<style type="text/css">
#print {
	margin:auto;
	border:1px solid #000000;
	text-align:left;
	font-family:"calibri", Courier, monospace;
	width:450px;
	font-size:14px;
}
#print .title {
	margin:auto;
	text-align:right;
	font-family:"Calibri", Courier, monospace;
	font-size:14px;
}
#print span {
	text-align:left;
	font-family:"Calibri", Arial, Helvetica, sans-serif;	
	font-size:14px;
}
#print table {
	border-collapse:collapse;
	width:95%;
	margin:10px;
}
#print .table1 {
	border-collapse:collapse;
	width:100%;
	text-align:left;
}
#print .table2 {
	margin:10px;
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
	font-family:calibri, Geneva, sans-serif;
	font-size:14px;
	font:normal;
	text-transform:uppercase;
	height:10px;
}

#print table tr {
	font-family:calibri, Geneva, sans-serif;
	font-size:14px
}

#print .grand {
	width:100px;
	padding:0px;
	text-align:left;	
}
#print .grand table {
	margin-left:-10px;	
}
}
</style>

<title>QRCODE PRINT AKTIVA</title>
	<div id="print">
<? 	$e = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE suid='$_GET[id]'")); ?> 
<table border=0 width=100%><tr><td>
<img src="https://kfpb.kimiafarma.co.id/bnj/images/logokf.png" width=110></td><td align=center><h3>AKTIVA TETAP<br>PT.KIMIA FARMA - PLANT BANJARAN</h3></td><td>
</td></tr></table>
 
 
<table width="100%" border=1>
    <tr>
    <td width=90>Nama Aktiva</td>
   <td>: <?=$e[aknama];?></td>
   <td rowspan=5 align=center border=0><img src="https://kfpb.kimiafarma.co.id/bnj/qrcode_aktiva.php?id=<?=$e[aknomor];?>">
   </tr>
   <tr>
    <td width=90>No.Aktiva/SAP</td>
   <td>: <?=$e[aknomor];?>/<?=$e[aknomor2];?></td>
   </tr>
   <tr>
    <td width=90>Merk/Type</td>
   <td>: <?=$e[akmerk];?></td>
   </tr>
   <tr>
    <td width=90>Thn Perolehan</td>
   <td>: <?=$e[aktahun];?></td>
    </tr>
   <tr>
       <td width=90>Lokasi</td>
   <td>: <?=$e[aklokasi2];?></td>
</tr>
	</table>
	
</div>

<?php	
} ?>