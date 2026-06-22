<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Notulen Rapat</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM ssurat a,users b WHERE a.ikepada=b.cId AND a.ikepada='$_SESSION[cv]' AND a.iid='$_GET[id]' AND a.jenisms=21 ORDER BY a.itgl DESC"));

?>
<strong>
<legend>Detail Agenda Notulen Rapat</legend>
<table width="100%" width="100%">
    <tr><td>Rapat Tanggal</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Judul Agenda Rapat </td><td>: <?=$e[iperihal];?></td></tr>
    <tr><td>Jam,Tempat & Peserta</td><td>: <?=$e[iket];?></td></tr>
	<tr><td>Dibaca</td><td>: <?=$e[istatus];?></td></tr>
    <tr><td>Tgl Dibaca</td><td>: <?=tgl_indo($e[itgl_baca]);?></td></tr>
	<tr><td>Tambah Isi Notulen</td><td>: 
		
	<?php
				$ds = mysql_query("SELECT * FROM disposisi2 WHERE iid='$e[iid]' ");
				$jr = mysql_num_rows($ds);
				
					if ($jr=0){
						echo "<a class='btn btn-info' href='?pages=suin3&act=tambahdisp&id=$e[iid]'>Buat Isi Notulen Klik Disini</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=suin3&act=editdisp&id=$e[iid]'>Tambah Isi Notulen Klik Disini</i>";
					}
	?>
	</td></tr>	
	<tr><td colspan="2"><br><a href="smasuk/$e[ifile]">* Klik Untuk Lihat "Lampiran" (Jika ada)</a></td></tr>
</table>
</strong>
<br><br>
<?php	
$tgl_sekarang = date("20y-m-d");
mysql_query("UPDATE ssurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");

}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=suin3&act=tambah'">Buat Agenda Rapat</button><br><br>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tgl Rapat</th>
			<th>Perihal Rapat</th>
			<th>Penerima Notulen</th>
			<th>Isi Notulen/RTL</th>
            <th>Status</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
/*$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM ssurat a, users b WHERE a.ikepada=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
*/		
		$smasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM ssurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]' AND jenisms='21' ORDER BY a.itgl DESC");
				
		while($s = mysql_fetch_array($smasuk)) {
		if (($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td>$s[istatus]</td><td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[iperihal]</td>";
                
                	$cv = mysql_num_rows(mysql_query("SELECT * FROM psuin WHERE iid='$s[iid]'"));
				if ($cv==0 OR $s[istatus]=='N'){
				echo"<td><a href='?pages=suin3&act=lp&id=$s[iid]' class='btn btn-info'>Pilih</a></td>";
				}
				else {
				echo"<td><b>Lihat Detail</b></td>";
				}
                
                
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM disposisi2 WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a class='btn btn-info' href='?pages=suin3&act=tambahdisp&id=$s[iid]'>Buat</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=suin3&act=editdisp&id=$s[iid]'>Tambah</i>";
					}
				
			echo "</td>";
				
				if ($s[istatus]=='N'){
				    echo"<td><a href='include/suin3/aksi_suin.php?act=acc&id=$s[iid]' onClick=\"return confirm('Yakin akan ACC/kirim Notulen ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>";
				}
				    else {
				        echo"<td>
			<b>Terkirim</b>";
				    }
				
				echo "<td class='center'><a href='include/suin3/aksi_suin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=suin3&act=edit&id=$s[iid]'> <i class='icon-edit'></i>-<a class='btn btn-info' href='home.php?pages=suin3&act=detail&id=$s[iid]' title='Detail'>Detail</a>
				</td>
				</tr>";	
		}
 ?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Klik Baca Untuk Konfirmasi Telah Dibaca.
	<br>
	Buat isi Notulen Rapat/ RTL, Klik Buat/Tambah Notulen.</h5>
	</span>

	<?php
	}
	else { ?>
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th></th>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>Perihal</th>
            <th>Lampiran</th>
            <th>Tgl Dibaca</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*,b.cNama FROM ssurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]'");
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[istatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo	"<td>$s[istatus]</td><td><a class='btn btn-info' href='home.php?pages=usrtes2&act=detail&id=$s[iid]' title='Detail'>Detail</a></td>
                <td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[ipengirim]</td>
                <td>$s[iperihal]</td>
                <td><a href='smasuk/$s[ifile]' class='btn btn-info'>File</a></td>
				<td>";
				if ($s[itgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($s[itgl_baca]); } 
				echo"</td>
				</tr>";	
		}
	?>
	</tbody>
	</table>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Klik Detail Untuk Konfirmasi Telah Dibaca.
	<br>
	Buat Isi Notulen Rapat/ RTL, Klik Buat/Tambah Notulen.</h5>
	</span>
</div>
</div>
<?php
}
}
?>
</div><!--/span12-->
</div><!--/block-content-->