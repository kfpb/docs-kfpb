<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Tela'ahan Produk dan Jasa</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
//a.ikepada='$_SESSION[cv]' AND
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM tsurat a,users b WHERE a.ikepada=b.cId AND  a.iid='$_GET[id]' ORDER BY a.itgl DESC"));

?>
<strong>
<legend>Detail Surat Penawaran</legend>
<table width="100%" width="100%">
	<tr><td width="24%">Nomor Surat</td><td>: <?=$e[inmr];?></td></tr>
    <tr><td>Tanggal Surat</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[iperihal];?></td></tr>
    <tr>
		<td>Pengirim</td>
		<td>: 
			<strong><?=$e[ipengirim];?></strong>
		</td>
	</tr>
    <tr><td>Ket</td><td>: <?=$e[iket];?></td></tr>
	<tr><td>Dibaca</td><td>: <?=$e[istatus];?></td></tr>
    <tr><td>Tgl Dibaca</td><td>: <?=tgl_indo($e[itgl_baca]);?></td></tr>
	<tr><td>Tambah Tela'ahan</td><td>: 
		
	<?php
				$ds = mysql_query("SELECT * FROM tisposisi WHERE iid='$e[iid]' ");
				$jr = mysql_num_rows($ds);
				
					if ($jr=0){
						echo "<a class='btn btn-info' href='?pages=tuin&act=tambahdisp&id=$e[iid]'>Buat Tela'ahan Klik Disini</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=tuin&act=editdisp&id=$e[iid]'>Tambah Tela'ahan Klik Disini</i>";
					}
	?>
	</td></tr>
	<tr><td colspan="2"><br><a href="smasuk/$e[ifile]">* Klik Untuk Lihat "Lampiran" Surat</a></td></tr>
</table>
</strong>
<br><br>
<?php	
$tgl_sekarang = date("Y-m-d");
//AND ikepada='$_SESSION[cv]'
mysql_query("UPDATE tsurat SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' ");

}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[cv]==73 OR $_SESSION[cv]==74 OR $_SESSION[cv]==83){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=tuin&act=tambah'">Tambah Surat Penawaran Masuk</button>
    <br /><br />

	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tanggal</th>
			<th>Detail</th>
			<th>Pengirim</th>
			<th>Perihal</th>
            <th>Lampiran</th>
			<th>Tela'ahan</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
/*$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM tsurat a, users b WHERE a.ikepada=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
*/		
		$smasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab, b.cJabatan FROM tsurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.istatus2='N' ORDER BY a.itgl DESC");
				
		while($s = mysql_fetch_array($smasuk)) {
		    //(($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv]))
		if ($s[istatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td>$s[istatus]</td><td>";echo tgl_indo($s[itgl]);echo"</td>
			<td><a class='btn btn-info' href='home.php?pages=tuin&act=detail&id=$s[iid]' title=Detail>Baca!</a></td>
                <td>$s[ipengirim]</td>
                <td>$s[iperihal]</td>
                <td align=center><center><a href='smasuk/$s[ifile]' class='btn btn-info'>File</a><a class='btn btn-info' href='include/tuin/aksi_tuin.php?act=selesai&id=$s[iid]' onClick=\"return confirm('Yakin Tela'ahan ini Selesai??')\"> Selesai</a></center></td>";
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM tisposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a class='btn btn-info' href='?pages=tuin&act=tambahdisp&id=$s[iid]'>Buat Tela'ahan</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=tuin&act=editdisp&id=$s[iid]'>Tambah Tela'ahan</i>";
					}
				
			echo "</td>";
				
				echo "
				<td class='center'><a href='include/tuin/aksi_tuin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=tuin&act=edit&id=$s[iid]'> <i class='icon-edit'></i></a>
				</td>

				</tr>";	
		}
 ?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Tampilkan/ Masuk ke Detail Untuk Konfirmasi Telah Dibaca/ACC.<br>
	Selanjutnya buat Tela'ahan ke bagian terkait, buat tela'ahan satu persatu</h5>
	</h5>
	</span>

	<?php
	}
	else { ?>
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th></th>
			<th>Detail</th>
			<th>Tanggal</th>
			<th>Pengirim</th>
			<th>Perihal</th>
            <th>Lampiran</th>
            <th>Tgl Dibaca</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT * FROM tsurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]'");
/*
		$smasuk = mysql_query("SELECT a.*,b.cNama FROM tsurat a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]'");
		*/
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[istatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo	"<td>$s[istatus]</td><td><a class='btn btn-info' href='home.php?pages=usrtl&act=detail&id=$s[iid]' title=DetailSurat>Baca!</a></td>
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
	Tampilkan/ Masuk ke Detail Untuk Konfirmasi Telah Dibaca/ACC
	<br>
	Selanjutnya buat Tela'ahan ke bagian terkait, buat tela'ahan satu persatu.</h5>
	</span>
</div>
</div>
<?php
}
}
?>
</div><!--/span12-->
</div><!--/block-content-->