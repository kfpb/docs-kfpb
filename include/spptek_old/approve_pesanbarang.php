<?php //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); ?>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Approve Data Pesanan Barang Teknik</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
	$bmasuk2 = mysql_query("SELECT bt.nama, bt.kode_barang, bt.id_spptek, bt.satuan, bt.jumlah, bt.keterangan, bt.status, sp.sinmr, sg.jumlah, ts.stok_masuk, ts.stok_keluar FROM stok_gudang_barang_teknik bt, spptek sp, barang_teknik sg, transaksi_stok_teknik ts WHERE bt.id_spptek=sp.siid AND bt.kode_barang=sg.kode AND bt.kode_barang=ts.kode_barang");
	$bmasuk3 = mysql_query("SELECT * FROM barang_teknik");
	$stokmasuk = mysql_query("SELECT * FROM barang_teknik");

?>

<?php
if($_GET[act]=="detailpesanantek"){?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Barang</th>
			<th>No SPPTek & NO PR</th>
			<th>Nama Barang</th>
			<th>Jumlah Dipesan</th>
            <th>Satuan</th>
			<th>Keterangan</th>
			<th>Status</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
                $pesanan 	= mysql_query("SELECT distinct 
					bt.id_pesanantek, 
					bt.nama, 
					bt.kode_barang, 
					bt.keterangan, 
					bt.status,
					bt.jumlah,
					bt.satuan,
					bt.id_spptek,
					-- sg.jumlah as stok, 
					-- ts.stok_masuk, 
					-- ts.stok_keluar,
					sp.sinmr,
					sp.pr,
					sp.accpesanbarang,
					sp.siid
					FROM pesanan_barangtek bt
					LEFT JOIN spptek sp ON bt.id_spptek=sp.siid
					-- LEFT JOIN stok_gudang_barang_teknik sg ON bt.kode=sg.kode_barang
					-- LEFT JOIN barang_teknik ts ON bt.kode_barang=ts.kode
					WHERE bt.id_spptek LIKE '$_GET[kode]'
				");

	    $i = 1;
		while($s = mysql_fetch_array($pesanan)) {
			if($s[accpesanbarang]=="N" OR $s[status]==""){
				echo"<tr class='success'>";
			}else{
				echo"<tr>";
			}
			echo "
                <td>$i</td>
                <td>$s[kode_barang]</td>
                <td>No SPPTek : $s[sinmr] <br> No PR : $s[pr]</td>
                <td>$s[nama]</td>
                <td>$s[jumlah]</td>
                <td>$s[satuan]</td>
                <td>$s[keterangan]</td>
                <td>$s[status]</td>
                
                <td class='center'>
                    <a href='include/spptek/aksi_sinter.php?act=hapuspesanbrg&kode=$s[kode_barang]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-warning'>Hapus</a>";
            echo"</td>
                </tr>";
				$i++;
	    }

	?>
	</tbody>
</table>
<?php }else{ ?>
	<?php
	$bbmasuk = mysql_query("SELECT sg.kode_barang as sg_kode_barang, sg.nama as sg_nama, sg.satuan as sg_satuan, sg.tanggal, sg.masuk, sg.keluar, sg.keterangan as sg_ket, bt.idspptek, bt.kode as bt_kode, bt.nama as bt_nama, bt.satuan as bt_satuan, bt.jumlah as bt_jumlah, bt.keterangan as bt_ket, sg.kode_barang as sg_kodebarang, sg.nama as sg_nama, sg.satuan as sg_satuan, sg.jumlah as sg_jumlah, sg.keterangan as sg_keterangan
	FROM stok_gudang_barang_teknik sg,transaksi_stok_teknik tb, barang_teknik bt WHERE sg.kode_barang=bt.kode AND sg.kode_barang=tb.kode_barang");
		
		if($_POST[nospptek] != null AND $_POST[kodebarang] == null){
			$bmasuk = mysql_query("SELECT distinct 
							sp.sinmr,
							sp.siid,
							sp.pr,
							sp.accpesanbarang,
							bt.status,
							bt.kode_barang
							FROM spptek sp
							LEFT JOIN pesanan_barangtek bt ON bt.id_spptek=sp.siid
							WHERE sp.sinmr LIKE '$_POST[nospptek]'
							ORDER BY sp.sitgl DESC
							");
	}else{
			$bmasuk = mysql_query("SELECT distinct
							sp.sinmr,
							sp.pr,
							sp.siid,
							sp.sinmr,
							bt.status,
							sp.accpesanbarang,
							sp.keluhan,
							bt.kode_barang
							FROM spptek sp, pesanan_barangtek bt WHERE bt.id_spptek=sp.siid AND bt.id_pesanantek IN(select MAX(id_pesanantek) as id FROM pesanan_barangtek GROUP BY id_spptek)
							GROUP BY sp.sinmr
							DESC
							");
	}
	?>
	<form method="post" action='home.php?pages=pesananbarangtek'>
		<div class="control-group">
			<label class="control-label" for="lokasi2">Cari No SPPTek</label>
			<div class="controls">
				<select class="chzn-select span5" name="nospptek">
					<?php
                            $nos = mysql_query("SELECT sinmr FROM spptek ORDER BY sinmr ASC");
                            while ($dvc=mysql_fetch_array($nos)){
            	    	     	echo "<option value='$dvc[sinmr]'>$dvc[sinmr]</option>";
            				}
                            ?>
				</select>
			</div>
		</div>

		<input class="btn btn-primary" type="submit" value="Cari" />
	</form>
	<hr />
    
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>No SPPTek</th>
			<th>NO PR</th>
			<th>Keluhan</th>
			<th>Keterangan</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	    $i = 1;
		while($s = mysql_fetch_array($bmasuk)) {
			if($s[accpesanbarang]=="N" OR $s[status]==""){
				echo"<tr class='success'>";
			}else{
				echo"<tr>";
			}
			echo "
			
                <td>$i</td>
                <td>$s[sinmr] </td>
				<td>$s[pr]</td>
				<td>$s[keluhan]</td>
                <td>$s[keterangan]</td>
                
                <td class='center'>
                    <a href='home.php?pages=approvebarangtek&act=detailpesanantek&kode=$s[siid]' class='btn btn-info'>Detail</a>";
                    
						if($s[accpesanbarang]=="N" OR $s[status]==""){
							echo"
							<a href='home.php?pages=barangtek&act=editstokbarangtek&kode=$s[kode_barang]' class='btn btn-success'>Ubah</a>
							<a href='include/spptek/aksi_sinter.php?act=hapuspesanbrg&kode=$s[kode_barang]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-warning'>Hapus</a>
							<a href='home.php?pages=sintertp&act=approvepesananbrg&id=$s[siid]' class='btn btn-primary' >Approve Pemesanan Barang Teknik</a>";
						}else{
							echo"";
						}
						
            echo"</td>
                </tr>";
				$i++;
	    }
	?>
	</tbody>
</table>
<?php } ?>	
</div>
</div>
<?php
$act=$_GET[act];

?>
