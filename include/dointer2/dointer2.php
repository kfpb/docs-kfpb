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
	width:1000px;
	padding:1px;
	text-align:left;	
}
#print .grand table {
	margin-left:-10px;	
}
}
</style>

<title>QRCODE Dokumen E-KFPB Kimia Farma Plant Banjaran</title>
<?php

	$tanggal = tgl_indo(date("Y-m-d"));
	$jam     = date("H:i:s");
	$hari_ini = $seminggu[$hari];
	$tglm = $_POST[tglm];
	$tgls = $_POST[tgls];
	
?>
	<div id="print">
<?
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM dointer a,users b WHERE a.dipengirim=b.cId AND a.suid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jendok FROM jendok WHERE id_jendok='$ef[jenisdok]'"));

  $dok = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$e[dikodok]'");
  $r    = mysql_fetch_array($dok);


	
?>
<table width="100%" border=1>
    <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>
        
            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>
        
            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>
        
            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>
        
            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>


            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>
        
        
            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr>
        
                    
            <tr><td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        
        <td align=center><b>Scan QRCode</b><img src="https://ekfpb.com/bdg/tryqrcode.php?id=<?=$r[id_jendok];?>&id2=<?=$r[kode_dok];?>"><br><b>Cek e-kfpb</b></td><td><b>Info Distribusi/Penarikan Dokumen</b><br>
        Kode Dok : <?=$e[dikodok];?>/<?=$e[direv];?>,<br>
        Judul Dok : <?=$e[dijudok];?>,<br>
        Mohon tarik/musnahkan/kembalikan dokumen revisi <?=$e[direv1];?>,<br>
        Jika perlu copy controlled lakukan permohonan copy di e-kfpb.<br>
        Terima kasih (SPD-MR)</td>
        </tr> 
   

	</table>
</div>

<?php	
} ?>