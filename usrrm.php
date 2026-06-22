<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Sumber Reminder (Perizinan/Sertifikat/K3L dll)</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM remind a,users b WHERE a.ikepada=b.cId AND a.ikepada='$_SESSION[cv]' AND a.iid='$_GET[id]' ORDER BY a.itgl DESC"));

?>
<strong>
<legend>Detail Sumber Reminder (Perizinan/Sertifikat/K3L/Umum/Pelatihan dll)</legend>
<table width="100%" width="100%">
    <tr><td>Tanggal</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Judul </td><td>: <?=$e[iperihal];?></td></tr>
    <tr><td>Ket</td><td>: <?=$e[iket];?></td></tr>
	<tr><td>Dibaca</td><td>: <?=$e[istatus];?></td></tr>
    <tr><td>Tgl Dibaca</td><td>: <?=tgl_indo($e[itgl_baca]);?></td></tr>
	<tr><td>Tambah</td><td>: 
		
	<?php
				$ds = mysql_query("SELECT * FROM reminder2 WHERE iid='$e[iid]' ");
				$jr = mysql_num_rows($ds);
				
					if ($jr=0){
						echo "<a class='btn btn-info' href='?pages=ruin&act=tambahdisp&id=$e[iid]'>Buat Reminder</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=ruin&act=editdisp&id=$e[iid]'>Tambah Reminder Klik Disini</i>";
					}
	?>
	</td></tr>	
	<tr><td colspan="2"><br><a href="smasuk/$e[ifile]">* Klik Untuk Lihat "Lampiran" (Jika ada)</a></td></tr>
</table>
</strong>
<br><br>
<?php	
$tgl_sekarang = date("20y-m-d");
mysql_query("UPDATE remind SET istatus='Y', itgl_baca='$tgl_sekarang'  WHERE iid='$_GET[id]' AND ikepada='$_SESSION[cv]'");

}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=ruin&act=tambah'">Buat Sumber Reminder</button>
	<br><br><b>Informasi</b> : Untuk membuat sumber-jenis-lokasi dari perizinan atau sertifikat atau pelatihan atau umum lainnya yang akan di reminder,
	<br> <b>Contoh :</b> Reminder APAR lokasi Plant Banjaran, Perizinan Lokasi Plant Bandung Tahun 2020-2021 dll<br />
	<b>Kategori Reminder :</b> A = Bangunan, B = Mesin, C = Fasilitas, D = K3L, E = SDM, F = Umum, G = Pelatihan<br>
	<b>Upload :</b> Download template umum format input massal <a href="https://ekfpb.com/bdg/template_reminder.xls">klik disini</a>, template pelatihan <a href="https://ekfpb.com/bdg/template_reminder_ehp.xls">klik disini</a>, <br>isi id_sumber reminder dan isi PIC dengan id_user <a href="https://ekfpb.com/bdg/kamus_user_id.xlsx">klik disini</a>
	<br /><br>
	<form method="post" enctype="multipart/form-data" action="upload_aksi2.php">
	Pilih File Reminder Umum : 
	<input name="filereminder" type="file" required="required"> 
	<input name="upload" type="submit" value="Import">
    </form>
	<form method="post" enctype="multipart/form-data" action="upload_aksi3.php">
	Pilih File Reminder Pelatihan : 
	<input name="filereminder" type="file" required="required"> 
	<input name="upload" type="submit" value="Import">
    </form>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tanggal</th>
			<th>Daftar/Detail Reminder</th>
			<th>Pembuat</th>
			<th>Perihal Sumber</th>
			<th>Reminder</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
/*$jinbox = mysql_num_rows(mysql_query("SELECT a.*, b.cNama FROM remind a, users b WHERE a.ikepada=b.cId AND a.istatus='N' AND a.ikepada='$_SESSION[cv]'"));
*/		
		$smasuk = mysql_query("SELECT a.*,b.cNama, b.cIdjab FROM remind a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]' ORDER BY a.itgl DESC");
				
		while($s = mysql_fetch_array($smasuk)) {
		if (($s[istatus]=='N')&&($s[ikepada]==$_SESSION[cv])){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				
			echo "<td>$s[istatus]</td><td>";echo tgl_indo($s[itgl]);echo"</td>
			<td><a class='btn btn-info' href='home.php?pages=ruin&act=detail&id=$s[iid]' title=Detail'>Baca! ID Sumber = $s[iid]</a></td>
                <td>$s[cIdjab]</td>
                <td>[$s[iperihal]]<br>$s[iket]</td>";
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM reminder2 WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "<a class='btn btn-info' href='?pages=ruin&act=tambahdisp&id=$s[iid]'>Buat</a>";
					}else{
						echo "<a class='btn btn-info' href='?pages=ruin&act=tambahdisp&id=$s[iid]'>Tambah</i>";
					}
				
			echo "</td>";
				
				echo "
				<td class='center'><a href='include/ruin/aksi_ruin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> 
				<a href='?pages=ruin&act=edit&id=$s[iid]'> <i class='icon-edit'></i>
				</td>

				</tr>";	
		}
 ?>
	</tbody>
</table>
<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA</strong><br>
	Tampilkan/ Masuk ke Detail/Baca Untuk Konfirmasi Telah Dibaca/ACC/Info Jawab
	<br>
	Buat Sumber Reminder, Klik Buat/Tambah</h5>
	</span>

	<?php
	}
	else { ?>
	
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr><th></th>
			<th>Daftar Reminder</th>
			<th>Tanggal</th>
	
			<th>Perihal</th>
            <th>Lampiran</th>
            <th>Tgl Dibaca</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*,b.cNama FROM remind a LEFT JOIN users b ON a.ikepada=b.cId WHERE a.ikepada='$_SESSION[cv]'");
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[istatus]=='N'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo	"<td>$s[istatus]</td><td><a class='btn btn-info' href='home.php?pages=usrrm&act=detail&id=$s[iid]' title=DetailSurat>Detail</a></td>
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
	Buat Reminder, Klik Buat/Tambah Reminder</h5>
	</span>
</div>
</div>
<?php
}
}
?>
</div><!--/span12-->
</div><!--/block-content-->