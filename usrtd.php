<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Daftar Usulan Dokumen (Change Note)</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET['act']=="detail"){
    
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]' ORDER BY a.udtgl DESC"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]' ORDER BY a.udtgl DESC"));

?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table border=1 width="100%">
    <tr><td>Tanggal Usulan</td><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>No. Usulan Dokumen</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Kode Dokumen</td><td>: <b><?=$e[ukodok];?></b></td></tr>
    <tr><td>Revisi</td><td>: <b><?=$e[udrev];?></b></td></tr>
    <tr><td>Judul Dokumen</td><td>: <b><?=$e[ujudok];?></b></td></tr>
    <tr>
		<td>Pengusul</td>
		<td>: 
			<strong><?=$e[cNama];?> - (<?=$e[cJabatan];?>)</strong><br>
			: <strong><?=$ef[cNama];?> - (<?=$ef[cJabatan];?>)</strong><br>
		</td>
	</tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
    <tr><td>Tgl Diterima SDDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr></tr>
    <?php /*
    <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
    <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
    */ ?>
<?php
	if ($e[uccnmr]!=''){
    $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
	}
	else {
	    
	}
?>
    <tr><td>Nomor CC</td><td>: <b><?php echo $e[uccnmr];?></b></td></tr>
    <tr><td>Judul Usulan Perubahan :</td><td>: <b><?php echo $e[udket];?></b></td></tr>
    <!--<tr><td>Usulan CC</td><td>: <b><a href='home.php?pages=ccinter&act=detail&id=<?php //echo $n[ccid];?>' target=_blank>Klik disini lihat detail usulan CC</a></b></td></tr>-->
    <tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
    <tr><td>Status Kirim</td><td>: 
        <?
    
    if ($e[udstatus2]=='N'){
                    
					if ($e[udpengusul2]==$_SESSION[cv])
					{
// 			echo "<b>Belum Terkirim, Klik >></b><a href='include/duin/aksi_duin.php?act=acc&id=$e[uid]' class='btn btn-info' onClick=\"return confirm('Yakin ACC dan kirim ke MR?.')\">Kirim Usulan ke MR!</a>";
			echo "<b>Belum Terkirim</b>";
					}
					else {
			echo "<b>Belum Terkirim, belum selesai koreksi/ACC oleh Atasan</b>";	
					}
                 }
                 else {
                     echo"<b>Terkirim</b>";
                 }
    
    ?>
    </td></tr>
	</table><br>
	<?php if($e[udtgl_selesai] == 0000-00-00){?>
	<tr>
        <td valign="top">Daftar Distribusi</td>
        <td>: 
            <?php
            // Query mengambil data user yang ada di tabel 'disin' berdasarkan ID dokumen ini ($e[uid])
            // Logika diambil dari snippet yang kamu berikan, tapi disesuaikan untuk tampilan
            $qDistribusi = mysql_query("SELECT cNama, cJabatan FROM users 
                                        WHERE cId IN (SELECT cId FROM disin WHERE suid='$e[uid]') 
                                        AND cId NOT IN (1103, 1104)
                                        ORDER BY cJabatan ASC");
            
            // Cek apakah ada datanya
            if (mysql_num_rows($qDistribusi) > 0) {
                echo "<ul style='margin-top:0px; margin-bottom:0px; padding-left: 20px;'>";
                while ($dDis = mysql_fetch_array($qDistribusi)) {
                    // Menampilkan Jabatan - Nama
                    echo "<li><b>{$dDis['cJabatan']}</b> - {$dDis['cNama']}</li>";
                }
                echo "</ul>";
            } else {
                echo "<b>-</b>"; // Tanda strip jika tidak ada distribusi
            }
            ?>
        </td>
    </tr>
    
    <?php }else{?>
     <?php
	    $dister = mysql_fetch_array(mysql_query("SELECT * FROM dinter where dikodok='$e[ukodok]'"));?>
	    <a href='?pages=dinter&act=detail&id=<?=$dister[suid];?>' class='btn btn-info' target=_blank>Daftar Penerima Dokumen</a>
    <?php } ?>
	<br><table width="100%">
	   
	<!--<tr><td><b>Judul Usulan Perubahan :</b><br><?php //echo $e[udket];?></td></tr>-->
	<tr><td colspan="2"><br>Lampiran : <a target="_blank" href="https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>"> File</a></td></tr>
<?php /*| <a target=_blank href="https://view.officeapps.live.com/op/view.aspx?src=https://docs.kfpb.kimiafarma.co.id/bnj/udmasuk/<?=$e[udfile];?>">Online</a> */ ?>
</table>

<br><br>
 
<?
/*
if ($e[udtgl_terima]='0000-00-00'){
$tgl_sekarang = date("Y-m-d");
mysql_query("UPDATE udokumen SET udtgl_terima='$tgl_sekarang'  WHERE uid='$_GET[id]' AND udkepada='2'");
}
else {}
*/
?>
<?
}else{
?>
<div>
<div class="span12">

	<button class="btn-info btn-large" onclick="window.location.href='?pages=usulandok&act=tambah'">Buat Usulan Dokumen Manual</button>
		

	
	<br><br>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	
	<thead>
		<tr>
			<th></th>
			<th>Tgl Usulan</th>
			<th>Kode Dok</th>
			<th>Judul Dok</th>
			<th>Jenis Usulan</th>
			<th>Rev</th>
			<th>Status Usulan</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	
// 		$udmasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.bagian FROM udokumen a LEFT JOIN $database2.users b ON a.udpengusul=b.cId WHERE a.udpengusul='$_SESSION[cv]' OR a.udpengusul2='$_SESSION[cv]' ORDER BY a.udtgl DESC");
	
// 		$udmasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.bagian FROM udokumen a LEFT JOIN $database2.users b ON a.udpengusul=b.cId WHERE a.udpengusul='$_SESSION[cv]' OR a.udpengusul2='$_SESSION[cv]' ORDER BY a.udtgl DESC");
		$udmasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.bagian FROM udokumen a LEFT JOIN $database2.users b ON a.udpengusul=b.cId WHERE a.udpengusul='$_SESSION[cv]' OR a.udpengusul2='$_SESSION[cv]' ORDER BY CASE WHEN a.udstatus2 = 'N' THEN 0 ELSE 1 END ASC, a.udtgl DESC");
				
		while($s = mysql_fetch_array($udmasuk)) {
		if ($s[udstatus]==2){
			echo "<tr>";
		}elseif($s[udstatus2]=='N' AND $s[ccstatus_ket]!=null){
		    echo "<tr class=warning>";
		}
		else{
			echo "<tr class=success>";
		}
				
			echo "<td>$s[udstatus1]</td><td>";echo tgl_indo($s[udtgl]);echo"</td>
				<td>$s[ukodok]</td>
                <td>$s[ujudok]</td>
      "?>          
                 <?
            	if ($s[jenisud]==1) { echo"<td>Usulan Pembuatan Dokumen Baru</td>";}
            	elseif ($s[jenisud]==2) { echo"<td>Usulan Perubahan Dokumen</td>";}
            	else { echo"<td>Usulan Penghapusan Dokumen</td>";}
            	?>  
            	<?php echo	"<td>$s[udrev]</td>
                ";
                
              
				if($s[udstatus]==1 AND $s[udstatus2]==N){echo"
				<td>Belum Terkirim &<br> Belum Selesai<br>";
		
            			echo "<a href='include/duin/aksi_duin.php?act=kirimusulan&id=$s[uid]' class='btn btn-info' onClick=\"return confirm('Yakin Akan Mengirimkan Usulan Dokumen?, Data yang telah dikirim tidak dapat diubah atau dihapus')\">Kirim Usulan</a>";
            			
				    if($s[ccstatus]=='N'  AND $s[ccstatus_ket]!=null){
				        echo"<hr><b>Keterangan Pengembalian</b> : $s[ccstatus_ket]</td>";
				    }
				}
				elseif ($s[udstatus]==1 AND $s[udstatus2]==Y){echo"
				<td>Terkirim &<br> Belum Selesai<br>";
				if($s[ccstatus]=='N'  AND $s[ccstatus_ket]!=null){
				        echo"<hr>Keterangan<br> Dikembalikan : $s[ccstatus_ket]</td>";
				    }
				}
				elseif ($s[udstatus]==2){echo"
				<td>Selesai/Net</td>";}
				elseif ($s[udstatus]==3){echo"
				<td>Pending</td>";}
				elseif ($s[udstatus]==4){echo"
				<td>Tidak Jadi</td>";}
				else{echo"
				<td></td>";}
				
				
				echo "
				<td class='center'>";
				if ($s[udstatus2]=='N' AND $s[ccstatus_ket]!=null OR $s[udstatus2]=='N'){
				echo"
				<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a><a href='?pages=usulandok&act=edit&id=$s[uid]'> <i class='icon-edit'></i>
				<a href='home.php?pages=usrtd&act=detail&id=$s[uid]' title=Detail' class='btn btn-info'> Detail</a>";
				}else {
				    echo"<a href='home.php?pages=usrtd&act=detail&id=$s[uid]' title=Detail' class='btn btn-info'> Detail</a>";
				}
				echo"
				</td>
				</tr>";	
		}
 ?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Klik tombol DETAIL untuk kirim usulan ke SDDR, klik tombol KIRIM USULAN KE SDDR<br>
	Baris Tabel Berwarna HIJAU = <strong>USULAN YANG BELUM SELESAI/NET <br>
	Baris Tabel Berwarna KUNING = <strong>USULAN DI RETURN <br>
	Notif di menu kiri = belum kirim ke SDDR. Jika sudah di terima SDDR, usulan tidak bisa di edit dan dihapus !</strong></h5>
	</span>
<?
}
?>
</div><!--/span12-->
</div><!--/block-content-->