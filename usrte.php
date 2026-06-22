<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Surat Masuk Eksternal (Surat dari luar KF untuk dibuat Disposisi)</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM isurat a,users b WHERE a.ikepada=b.cId AND a.ikepada='$_SESSION[cv]' AND a.iid='$_GET[id]' ORDER BY a.itgl DESC"));

?>
<strong>
<legend>Detail Surat Masuk Eksternal</legend>
<table width="100%" border=1>
    <tr><td>Tanggal Surat</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Perihal Surat</td><td>: <?=$e[iperihal];?></td></tr>
    <tr><td>Ket</td><td>: <?=$e[iket];?></td></tr>
	<tr><td>Dibaca</td><td>: <?=$e[istatus];?></td></tr>
    <tr><td>Tgl Dibaca</td><td>: <?=tgl_indo($e[itgl_baca]);?></td></tr>
	<tr><td>Tambah Disposisi</td><td>: 
		
	<?php
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$e[iid]' ");
				$jr = mysql_num_rows($ds);
				
					if ($jr=0){
						echo "<a class='btn btn-info' href='?pages=suin&act=tambahdisp&id=$e[iid]'>Buat Disposisi Klik Disini</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=suin&act=editdisp&id=$e[iid]'>Tambah Disposisi Klik Disini</i>";
					}
	?>
	</td></tr>	
	<tr><td colspan="2"><br><a href="smasuk/$e[ifile]">* Klik Untuk Lihat "Lampiran" Surat</a></td></tr>
</table>
</strong>
<br><br>
<?php	
$tgl_sekarang = date("20y-m-d");
mysql_query("UPDATE isurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");
mysql_query("UPDATE isurat SET istatus2='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada2='$_SESSION[cv]'");
}else{
?>
<div>
<div class="span12">
	<?php
	if($_SESSION[levelcv]<7){
	?>
		<?php
	if($_SESSION[levelcv]<1 OR $_SESSION[idj]=='9'){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=suin&act=tambah'">Buat Surat Masuk Eksternal</button>
	<? } ?>
<p></p>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th width=1%></th>
			<th>Tanggal</th>
			<th>Untuk</th>
			<th>Perihal</th>
            <th>Lampiran</th>
			<th><u>Disposisi</u></th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
		$smasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM isurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]' OR a.ikepada2='$_SESSION[cv]' ORDER BY a.itgl DESC");
		
		while($s = mysql_fetch_array($smasuk)) {
	    if ($s[ikepada]==$_SESSION[cv]) {
		if ($s[istatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td>$s[istatus]</td><td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[cJabatan]</td>
                <td>$s[iperihal]</td>
                <td><a href='smasuk/$s[ifile]' class='btn btn-info' target=_blank>File</a></td>";
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a class='btn btn-info' href='?pages=suin&act=tambahdisp&id=$s[iid]'>Buat</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=suin&act=editdisp&id=$s[iid]'>Tambah</i>";
					}
				
			echo "</td>";
				
				echo "
				<td class='center'><a class='btn btn-info' href='home.php?pages=suin&act=detail&id=$s[iid]' title='Baca/Detail'>Baca!</a> 
				
				</td>

				</tr>";	
		}
		elseif ($s[ikepada2]==$_SESSION[cv]) {
		  if ($s[istatus2]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td>$s[istatus2]</td><td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[cJabatan]</td>
                <td>$s[iperihal]</td>
                <td><a href='smasuk/$s[ifile]' class='btn btn-info' target=_blank>File</a></td>";
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a class='btn btn-info' href='?pages=suin&act=tambahdisp&id=$s[iid]'>Buat</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=suin&act=editdisp&id=$s[iid]'>Tambah</i>";
					}
				
			echo "</td>";
				
				echo "
				<td class='center'><a class='btn btn-info' href='home.php?pages=suin&act=detail&id=$s[iid]' title='Baca/Detail'>Baca!</a> 
				
				</td>

				</tr>";	
		}
		}
 ?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA SURAT/ JAWABAN DISPOSISI</strong><br>
	Buat disposisi, Klik Buat/Tambah Disposisi.</h5>
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
		$smasuk = mysql_query("SELECT a.*,b.cNama FROM isurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]' ORDER BY a.itgl DESC");
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[istatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo	"<td>$s[istatus]</td><td><a class='btn btn-info' href='home.php?pages=usrte&act=detail&id=$s[iid]' title=DetailSurat>Detail</a></td>
                <td>";echo tgl_indo1($s[itgl]);echo"</td>
                <td>$s[ipengirim]</td>
                <td>$s[iperihal]</td>
                <td><a href='smasuk/$s[ifile]' class='btn btn-info'>File</a></td>
				<td>";
				if ($s[itgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo1($s[itgl_baca]); } 
				echo"</td>
				</tr>";	
		}
	?>
	</tbody>
	</table>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Tampilkan/ Masuk ke Detail Untuk Konfirmasi Telah Dibaca/ACC
	<br>
	Buat disposisi, Klik Buat/Tambah Disposisi.</h5>
	</span>
</div>
</div>
<?php
}
}
?>
</div><!--/span12-->
</div><!--/block-content-->