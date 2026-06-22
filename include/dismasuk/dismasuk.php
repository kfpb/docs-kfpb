<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Surat Masuk</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM isurat a,users b WHERE a.ikepada=b.cId AND a.iid='$_GET[id]'"));
?>
<strong>
<legend>Detail Surat Masuk</legend>
<table width="100%">
	<tr><td width="14%">Nomor Surat</td><td>: <?=$e[inmr];?></td></tr>
    <tr><td>Tanggal Surat</td><td>: <?=tgl_indo($e[itgl]);?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[iperihal];?></td></tr>
    <tr><td>Pengirim</td><td>: <strong><?=$e[ipengirim];?></strong></td></tr>
    <tr><td>Kepada</td><td>: <strong><?=$e[cNama];?></strong></td></tr>
    <tr><td>Ket</td><td>: <?=$e[iket];?></td></tr>
</table>
</strong>
<br />
<?php
$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=a.dPendisposisi) as dPdisposisi FROM disposisi a WHERE a.iid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){
?>
<!-- isi disposisi-->
<legend>Disposisi</legend>
<table width="100%">
	<tr><td width="14%">Nomor Agenda</td><td>: <?=$ds[dNoagenda];?></td></tr>
    <tr><td>Tanggal</td><td>: <?=tgl_indo($ds[dTglM]);?></td></tr>
    <?php
	$sft = Array("A"=>"Rutin","B"=>"Penting","C"=>"Rahasia");
	$bdg = Array("A"=>"success","B"=>"warning","C"=>"important");
	$tglS=$ds[dTglS];
	if ($ds[dTglS]=="0000-00-00"){
		$tglS="";
	}
	?>
    <tr><td>Tanggal Penyelesaian</td><td>: <?=tgl_indo($tglS);?></td></tr>
    <tr><td>Pendisposisi</td><td>: <?=$ds[dPdisposisi];?></td></tr>
    <tr><td>Instruksi</td><td>: <?=$ds[dInstruksi];?></td></tr>
    <tr><td>Sifat</td><td>: <span class="label label-<?=$bdg[$ds[dSifat]];?>"><?=$sft[$ds[dSifat]];?></span></td></tr>
</table>
<br />
<legend>Diteruskan Kepada :</legend>
<table class="table table-bordered">
<thead>
	<td width="150">Username</td>
    <td>Nama</td>
    <td width="200">Status</td>
    <td width="150">Dilihat Pada</td>   
</thead>
<?php
$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a
					LEFT JOIN pdis b ON b.cId=a.cId
					WHERE b.iid='$_GET[id]'");
while ($t=mysql_fetch_array($pds)){
	$tglBaca=tgl_indo($t[psTglbaca]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$t[cJabatan]</td>
				<td>$t[cNama]</td>
				<td><span class='label label-warning'>Menunggu Konfirmasi</span></td>
				<td>$tglBaca</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$t[cJabatan]</td>
				<td>$t[cNama]</td>
				<td><span class='label label-success'>ACC</span></td>
				<td>$tglBaca</td>
			 </tr>";
	}
}
?>
</table>
<?php	
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<button class="btn-info btn-large" onclick="window.location.href='?pages=suin&act=tambah'">Tambah Surat Masuk</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>Pengirim</th>
			<th>Kepada</th>
			<th>Perihal</th>
            <th>Lampiran</th>
            <th>Disposisi</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM isurat a, users b WHERE a.ikepada=b.cId");
		while($s = mysql_fetch_array($smasuk)) {
		echo "<tr>
				<td><a href='home.php?pages=suin&act=detail&id=$s[iid]' title=DetailSurat>$s[inmr]</a></td>
                <td>";echo tgl_indo($s[itgl]);echo"</td>
                <td>$s[ipengirim]</td>
                <td>$s[cNama]</td>
                <td>$s[iperihal]</td>
                <td><a href='smasuk/$s[ifile]' target='_blank'>Lampiran Surat</a></td>";
				echo "<td class='center'>";
				$ds = mysql_query("SELECT * FROM disposisi WHERE iid='$s[iid]'");
				$jr = mysql_num_rows($ds);
				if ($jr<1){
					echo "<a href='?pages=suin&act=tambahdisp&id=$s[iid]'>Disposisi</a>";
				}else{
					echo "<a href='?pages=suin&act=editdisp&id=$s[iid]'>Edit Disposisi</i>";
				}
				echo "</td>";
				echo "
				<td class='center'><a href='include/suin/aksi_suin.php?act=hapus&id=$s[iid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=suin&act=edit&id=$s[iid]'><i class='icon-edit'></i>
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->