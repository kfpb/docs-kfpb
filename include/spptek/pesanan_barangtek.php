<?php //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); ?>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Data Pesanan Barang Teknik</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tmbbarang"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/spptek/aksi_sinter.php?act=tambahbarang" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Tambah Stok Ketersediaan Barang Gudang</legend>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tanggal">Tanggal</label>
        <div class="controls">
		 <input type="hidden" name="tanggal" value="$tgl1"><b><?php echo $tgl ?></b> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="kode_barang">Kode Barang</label>
        <div class="controls">
            <input type="text" placeholder="Pilih Kode / Tulis Kode" name="kode_barang" list="kode_barang">
            <datalist id="kode_barang">
               	<?php
					$bt = mysql_query("SELECT * FROM barang_teknik");
					while ($bth=mysql_fetch_array($bt)){ ?>
	    		     	<option><?php echo $bth[kode]; ?></option>
	    		     	<?php
					}
				?>
            </datalist>
        </div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="nama">Nama Barang</label>
        <div class="controls"><input class="input-large focused" id="nama" type="text" name="nama" value=""></div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="jumlah">Jumlah Stok Masuk</label>
        <div class="controls"><input class="input-large focused" id="jumlah" type="number" name="jumlah" value=""></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Jenispptek">Satuan</label>
        <div class="controls">
            <select class="chzn-select" name="satuan" required="required" >
            <option value='' selected>Pilih Jenis Satuan Barang</option>  
            <option value='M'>M</option>   
            <option value='KG'>KG</option>  
            <option value='CAN'>CAN</option>
            <option value='L'>L</option>
            <option value='BH'>BH</option>
            <option value='UNT'>UNT</option>
            <option value='SET'>SET</option>
            <option value='BTL'>BTL</option>
            <option value='TUB'>TUB</option>
            </option>
            </select></b>.
        </div> 
	</div>
	
	<div class="control-group">
		<label class="control-label">Keterangan</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="keterangan" name="keterangan" style="width: 610px; height: 100px"></textarea>
            <!--<textarea id="keluhan" class='input-large textarea' name='keluhan' style='width: 610px; height: 100px'></textarea>-->
    </div>
    
   <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary" id="btnn">Simpan</button> 
        </div>
    </div>
</fieldset>
</form>
<br><br><br><br><br><br><br><br><br><br>
<?php }
elseif($_GET[act]=="editstokpesanantek"){
$e 		= mysql_fetch_array(mysql_query("SELECT * FROM pesanan_barangtek WHERE id_pesanantek='$_GET[kode]'"));
$ef 	= mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/spptek/aksi_sinter.php?act=editpesanbarang&id=<?=$e[id_pesanantek];?>" enctype="multipart/form-data" class="form-horizontal">

<legend>Edit Pesanan Barang SPPTek</legend>
     	<div class="control-group"><div class="control-label">Kode</div><div class="controls"><b><input type="text" id="kode_barang" name="kode_barang" autofocus tabindex="1" class="form-control kode" value="<?=$e[kode_barang];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Nama</div><div class="controls"><b><input type="text" id="nama" name="nama" autofocus tabindex="1" class="form-control nama" value="<?=$e[nama];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Jumlah Barang</div><div class="controls"><b><input type="text" id="nama" name="jumlah" autofocus tabindex="1" class="form-control jumlah" value="<?=$e['jumlah'];?>" readonly></b></div></div>
			<div class="control-group"><div class="control-label">Keterangan</div><div class="controls"><b><textarea name="keterangan" tabindex="1" style="width: 400px; height: 90px" class="form-control"><?=$e['keterangan'];?></textarea></b></div></div>
			<div class="control-group"><div class="control-label">Satuan</div><div class="controls"><b><select name="satuan" class="form-control m-bot15"><option value="M">M</option><option value="KG">KG</option><option value="CAN">CAN</option><option value="L">L</option><option value="BH">BH</option></select></option></select></div></b></div>
		
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

				    
<?php
//end edit barang tek
} elseif($_GET[act]=="tmbtransaksi"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(sinmr) as max_no FROM spptek WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("SPPTek-%04s/$_SESSION[nppcv]/$bln", $noUrut);
// $data = mysql_fetch_array(mysql_query("SELECT a.kode_barang, a.nama, b.keterangan, a.satuan, a.id_stok_barang, b.masuk, b.keluar, b.id_transaksi FROM stok_gudang_barang_teknik a,transaksi_stok_teknik b WHERE a.kode_barang=b.kode_barang AND a.kode_barang='$_GET[kode]'"));
$data = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[kode]'"));
?>
<form method="post" action="include/spptek/aksi_sinter.php?act=tambahtransaksi" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Transaksi Ketersediaan Barang Gudang</legend>

<input type="hidden" name="nomor" value="<? echo "$newID" ?>">

	 <div class="control-group">
		<label class="control-label" for="tanggal">Tanggal</label>
        <div class="controls">
		 <input type="hidden" name="tanggal" value="$tgl1"><b><?php echo $tgl ?></b> </div>
    </div>
    
     <!--<div class="control-group">-->
    	<!--<label class="control-label" for="kode_barang">Kode Barang</label>-->
     <!--   <div class="controls">-->
     <!--       <input type="text" placeholder="Pilih Kode / Tulis Kode" name="kode_barang" list="kode_barang" onchange="getdata(this.value,0)" value="<?php echo $data[kode];?>">-->
     <!--       <datalist id="kode_barang">-->
               	<?php
				//	$bt = mysql_query("SELECT * FROM barang_teknik");
				//	while ($bth=mysql_fetch_array($bt)){ ?>
	    		     	<!--<option><?php //echo $bth[kode]; ?></option>-->
	    		     	<?php
			//		}
				?>
    <!--        </datalist>-->
    <!--    </div>-->
    <!--</div>-->
     <div class="control-group">
		<label class="control-label" for="nama">Kode Barang</label>
        <div class="controls"><input class="input-large focused" id="kode_barang" type="text" name="kode_barang" value="<?php echo $data[kode] ?>"></div>
    </div>
    <p id="nama"></p>
    <div class="control-group">
		<label class="control-label" for="nama">Nama Barang</label>
        <div class="controls"><input class="input-large focused" id="namas" type="text" name="nama" value="<?php echo $data[nama] ?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="jenis">Jenis Stok</label>
        <div class="controls">
            <select class="chzn-select" name="jenis" required="required">
               	<option value="masuk">Stok Masuk</option>
               	<option value="keluar">Stok Keluar</option>
            </select>
        </div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="jumlah">Jumlah Stok</label>
        <div class="controls"><input class="input-large focused" id="stok" type="number" name="stok" value=""></div>
    </div>
    
    
    <div class="control-group">
		<label class="control-label" for="jumlah">Satuan</label>
        <div class="controls"><input class="input-large focused" id="satuan" type="text" name="satuan" value="<?php echo $data[satuan]; ?>" readonly></div>
    </div>
    
    
 <!--   <div class="control-group">-->
 <!--   	<label class="control-label" for="Jenispptek">Satuan</label>-->
 <!--       <div class="controls">-->
 <!--           <select class="chzn-select" name="satuan" required="required" value="" >-->
 <!--           <option value='' selected>Pilih Jenis Satuan Barang</option>  -->
 <!--           <option value='M'>M</option>   -->
 <!--           <option value='KG'>KG</option>  -->
 <!--           <option value='CAN'>CAN</option>-->
 <!--           <option value='L'>L</option>-->
 <!--           <option value='BH'>BH</option>-->
 <!--           <option value='UNT'>UNT</option>-->
 <!--           <option value='SET'>SET</option>-->
 <!--           <option value='BTL'>BTL</option>-->
 <!--           <option value='TUB'>TUB</option>-->
 <!--           </option>-->
 <!--           </select></b>.-->
 <!--       </div> -->
	<!--</div>-->
	
	<div class="control-group">
		<label class="control-label">Keterangan</label>
        <div class="controls">
            <textarea class="input-xxlarge focused" id="keterangan" name="keterangan" style="width: 610px; height: 100px"></textarea>
            <!--<textarea id="keluhan" class='input-large textarea' name='keluhan' style='width: 610px; height: 100px'></textarea>-->
    </div>
    
   <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary" id="btnn">Simpan</button> 
        </div>
    </div>
</fieldset>
</form>
<br><br><br><br><br><br><br><br><br><br>
<?php }
elseif($_GET[act]=="editbarangtransaksi"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM transaksi_stok_teknik WHERE id_transaksi='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/spptek/aksi_sinter.php?act=edittransaksibarang&id=<?=$e[id_brg_teknik];?>" enctype="multipart/form-data" class="form-horizontal">

<legend>Edit Transaksi Barang SPPTek</legend>
     	<div class="control-group"><div class="control-label">Kode</div><div class="controls"><b><input type="text" id="kode_barang" name="kode_barang" autofocus tabindex="1" class="form-control kode" value="<?=$e[kode_barang];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Nama</div><div class="controls"><b><input type="text" id="nama" name="nama" autofocus tabindex="1" class="form-control nama" value="<?=$e[nama];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Nama</div><div class="controls"><b><input type="date" id="tanggal" name="tanggal" autofocus tabindex="1" class="form-control nama" value="<?=$e[tanggal];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Jumlah Stok Masuk</div><div class="controls"><b><input type="text" id="masuk" name="masuk" autofocus tabindex="1" class="form-control jumlah" value="<?=$e['stok_masuk'];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Jumlah Stok Keluar</div><div class="controls"><b><input type="text" id="keluar" name="keluar" autofocus tabindex="1" class="form-control jumlah" value="<?=$e['stok_keluar'];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Keterangan</div><div class="controls"><b><textarea name="keterangan" tabindex="1" style="width: 400px; height: 90px" class="form-control"><?=$e['keterangan'];?></textarea></b></div></div>
			<div class="control-group"><div class="control-label">Satuan</div><div class="controls"><b><select name="satuan" class="form-control m-bot15"><option value="M">M</option><option value="KG">KG</option><option value="CAN">CAN</option><option value="L">L</option><option value="BH">BH</option></select></option></select></div></b></div>
		
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

				    
<?php
//end edit barang tek
}
elseif($_GET[act]=="detailbarang"){

	$tr = mysql_query("SELECT a.kode, a.nama, b.keterangan, a.satuan, a.id_brg_barang, b.stok_masuk, b.stok_keluar, b.id_transaksi FROM barang_teknik a,transaksi_stok_teknik b WHERE a.kode=b.kode_barang AND a.kode='$_GET[kode]'");
	$trss = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[kode]'"));

	$stok = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE id_brg_barang='$_GET[id]'"));

	?>
<strong>
<legend>Detail Transaksi Perbaikan-Pembelian Barang <?= $stok[nama];?> (SPPTek)</legend>
 <?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=barangtek&act=tmbtransaksi&kode=<?php echo $trss[kode] ?>'">Tambah Transaksi Gudang</button><br /><br />
	<?php
	}
	?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>Nama Barang</th>
			<th>Jumlah Stok Masuk</th>
			<th>Jumlah Stok Dipakai</th>
            <th>Satuan</th>
			<th>Keterangan</th>
			<th>Aksi</th>
            
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	while($s = mysql_fetch_array($tr)) {?>
		<tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $s[kode]; ?></td>
                <td><?php echo $s[nama]; ?></td>
                <td><?php echo $s[stok_masuk]; ?></td>
                <td><?php echo $s[stok_keluar]; ?></td>
                <td><?php echo $s[satuan]; ?></td>
                <td><?php echo $s[keterangan];?></td>
                
                <td class='center'>
                    <a href='home.php?pages=barangtek&act=editbarangtransaksi&id=<?php echo $s[id_transaksi] ?>' class='btn btn-success'>Ubah</a>
                    <a href='include/spptek/aksi_sinter.php?act=hapustransaksibarang&id=<?php echo $s[id_transaksi] ?>&kode=<?php echo $s[kode]?>' onClick=\'return confirm("Yakin ingin menghapus??")\' class='btn btn-warning'>Hapus</a>
                </td>
        </tr>
        
                <?php $i++ ?>
				
	<?php
	    }
	?>
	
	</tbody>
	<tfoot>
	     <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Sisa Stok :</td>
            <td><?php echo $trss[jumlah];?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
	</tfoot>
</table>

<?php }//Detail Barang Teknik
elseif($_GET[act]=="detailbarangstok"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM barang_teknik a,spptek b WHERE a.idspptek=b.siid AND a.id_brg_teknik='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[kode]'"));
	
	?>
<strong>
<legend>Detail Barang Teknik</legend>
<table width="100%" border=1>
	<tr><td width="24%">Kode Barang </td><td>: <?=$efg[kode];?></td></tr>
    <tr><td>Nama Barang </td><td>: <?=$efg[nama];?></td></tr>
    <tr><td>Jumlah </td><td>: <?=$efg[jumlah];?></td></tr>
    <tr><td>Satuan </td><td>: <?=$efg[satuan];?></td></tr>
    <tr><td>Keterangan </td><td>: <?=$efg[keterangan];?></td></tr>
</table>
<?php
}elseif($_GET[act]=="detailpesanan"){?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Barang</th>
			<th>No SPPTek & No PR</th>
			<th>Nama Barang</th>
			<th>Tanggal Pesanan</th>
			<th>Jumlah Stok</th>
			<th>Jumlah Dipesan</th>
            <th>Satuan</th>
			<th>Keterangan</th>
			<th>Status</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
                $pesan = mysql_query("SELECT 
	                        bt.id_pesanantek,
							bt.id_spptek,
	                        bt.nama, 
	                        bt.kode_barang,
							bt.tgl_pesanbrg,
	                        bt.keterangan, 
	                        bt.status,
	                        bt.jumlah,
	                        sp.sinmr,
	                        sp.pr,
	                        sp.siid,
							sg.jumlah as jumlah_stok,
							sp.accpesanbarang
	                        FROM pesanan_barangtek bt
							LEFT JOIN barang_teknik sg ON bt.kode_barang=sg.kode
	                        LEFT JOIN spptek sp ON bt.id_spptek=sp.siid
	                        WHERE bt.status!='' AND bt.id_spptek LIKE '$_GET[kode]'
							
	                        ");

	    $i = 1;
		while($s = mysql_fetch_array($pesan)) {
			
			if($s[accpesanbarang]=="Y" AND $s[status]=="Approve"){
				echo "<tr class='success'>";
			}else{
				echo "<tr>";
			}
			echo "<td>$i</td>
                <td>$s[kode_barang]</td>
                <td>No SPPTek : $s[sinmr] <br> No PR : $s[pr]</td>
                <td>$s[nama]</td>
                <td>$s[tgl_pesanbrg]</td>
                <td>$s[jumlah_stok]</td>
                <td>$s[jumlah]</td>
                <td>$s[satuan]</td>
                <td>$s[keterangan]</td>
                <td>$s[status]</td>
                
                <td class='center'>";
                    ?>
                    <?php 
                    if($s[accpesanbarang] == "Y" AND $s[status] != "Barang Datang"){
						echo"<a href='include/spptek/aksi_sinter.php?act=hapuspesanbrg&kode=$s[id_pesanantek]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-warning'>Hapus</a>
						<a href='home.php?pages=pesananbarangtek&act=editstokpesanantek&kode=$s[id_pesanantek]' class='btn btn-success'>Ubah</a>
						<a href='home.php?pages=sintertp&act=approvebarangtek&id=$s[id_pesanantek]' class='btn btn-primary' >Barang Datang</a>";
                    }else{
						'-';
                    }
                    
            echo"</td>
                </tr>";
				$i++;
	    }

	?>
	</tbody>
</table>
<?php
}
else{ ?> 

    <!--Menampilkan Stok gudang barang teknik-->

    <?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=barangtek&act=tmbbarang'">Tambah Pesanan</button><br /><br />
	<?php
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
                
                <div class="control-group">
		<label class="control-label" for="lokasi2">Cari Kode Barang</label>
            <div class="controls">
                    <select class="chzn-select span5" name="kodebarang">
                            <?php
                            $nos = mysql_query("SELECT kode FROM barang_teknik ORDER BY kode ASC");
                            while ($dvc=mysql_fetch_array($nos)){
            	    	     	echo "<option value='$dvc[kode]'>$dvc[kode]</option>";
            				}
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
		<label class="control-label" for="lokasi2">Cari Status</label>
            <div class="controls">
                    <select class="chzn-select span5" name="approve">
                            <option value=''>Pilih Status</option>
                            <option value='Approve'>Status Aprove</option>
                            <option value=''>Status Belum Di Approve</option>
            				
                        </select>
                    </div>
                </div>
        
        <input class="btn btn-primary" type="submit" value="Cari" />
    </form>
    <hr/>
    
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>No SPPTek</th>
			<th>No PR</th>
			<th>Keluhan</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	if($_POST[nospptek] == null AND $_POST[kodebarang] == null AND $_POST[approve] == null){
                 $bmasuk = mysql_query("SELECT distinct 
	                       
	                        sp.sinmr,
	                        sp.siid,
	                        sp.pr,
							sp.keluhan,
							sp.accpesanbarang,
							bt.status,
							bt.id_pesanantek,
							bt.id_spptek
	                        FROM spptek sp,
	                        pesanan_barangtek bt WHERE sp.siid=bt.id_spptek
							AND sp.accpesanbarang LIKE 'Y'
							GROUP BY sp.sinmr
							DESC
	                        ");
    }elseif($_POST[nospptek] != null AND $_POST[kodebarang] == null){
         $bmasuk = mysql_query("SELECT distinct 
	                        bt.id_pesanantek, 
	                        bt.nama, 
	                        bt.kode_barang, 
	                        bt.satuan, 
	                        bt.keterangan, 
	                        bt.status,
	                        bt.jumlah,
	                        sp.sinmr,
	                        sp.siid,
							sp.accpesanbarang,
	                        sp.pr,
							sp.keluhan
							FROM spptek sp
	                        LEFT JOIN pesanan_barangtek bt ON sp.siid=bt.id_spptek
	                        WHERE sp.sinmr LIKE '$_POST[nospptek]'
							WHERE sp.accpesanbarang LIKE 'Y'
							GROUP BY sp.sinmr
							DESC
	                        ");
    }elseif($_POST[kodebarang] != null AND $_POST[nospptek] == null){
         $bmasuk = mysql_query("SELECT distinct 
	                        bt.id_pesanantek, 
	                        bt.nama, 
	                        bt.kode_barang, 
	                        bt.satuan, 
	                        bt.keterangan, 
	                        bt.status,
	                        bt.jumlah,
	                       
	                        sp.sinmr,
	                        sp.siid,
							sp.accpesanbarang,
	                        sp.pr,
							sp.keluhan
							FROM spptek sp
	                        LEFT JOIN pesanan_barangtek bt ON sp.siid=bt.id_spptek
	                        WHERE bt.kode LIKE '$_POST[kodebarang]'
							WHERE sp.accpesanbarang LIKE 'Y'
							GROUP BY sp.sinmr
							DESC
	                        ");
    }elseif($_POST[approve] != null AND $_POST[nospptek] == null AND $_POST[kodebarang] == null){
         $bmasuk = mysql_query("SELECT distinct 
	                        bt.id_pesanantek, 
	                        bt.nama, 
	                        bt.kode_barang, 
	                        bt.satuan, 
	                        bt.keterangan, 
	                        bt.status,
	                        bt.jumlah,
	                       	sp.sinmr,
	                        sp.siid, 
							sp.accpesanbarang,
	                        sp.pr,
							sp.keluhan
							FROM spptek sp
	                        LEFT JOIN pesanan_barangtek bt ON sp.siid=bt.id_spptek
							WHERE sp.accpesanbarang LIKE 'Y'
							GROUP BY sp.sinmr
							DESC
	                        ");
    }else{
                $bmasuk = mysql_query("SELECT distinct 
	                        bt.id_pesanantek, 
	                        bt.nama, 
	                        bt.kode_barang, 
	                        bt.satuan, 
	                        bt.keterangan, 
	                        bt.status,
	                        bt.jumlah,
	                        sp.sinmr,
	                        sp.pr,
	                        sp.siid,
							sp.accpesanbarang,
							sp.keluhan
	                        FROM spptek sp
	                        LEFT JOIN pesanan_barangtek bt ON sp.siid=bt.id_spptek
	                        WHERE sp.sinmr LIKE '$_POST[nospptek]'
	                        WHERE bt.kode_barang LIKE '$_POST[kodebarang]'
							WHERE sp.accpesanbarang LIKE 'Y'
							GROUP BY sp.sinmr
							DESC
	                        ");
    }
	    $i = 1;
		while($s = mysql_fetch_array($bmasuk)) {
			if($s[accpesanbarang]=="Y" AND  $s[status]=="Approve"){
				echo "<tr class='success'>";
			}elseif($_GET[status]=="brgdtg" AND $s[siid]==$_GET[id] AND $s[id_pesanantek]==$_GET[idb]){
				echo "<tr class='success'>";
				
			}else{
				echo "<tr>";
			}
			if($_GET[status]=="brgdtg"){
				mysql_query("UPDATE pesanan_barangtek set sudahbaca='Y' where id_pesanantek='$_GET[idb]'");
			}
			echo "
                <td>$i</td>
                <td>No SPPTek : $s[sinmr] </td>
				<td> No PR : $s[pr]</td>
				<td>$s[keluhan]</td>
                
                <td class='center'>
					<a href='home.php?pages=pesananbarangtek&act=detailpesanan&kode=$s[siid]' class='btn btn-info'>Detail</a>";
                    ?>
                    <?php 
                    if($s[status] != "Approve" AND $s[pr] != ""){
						
                    }elseif($s[pr] == ""){
						?>
						<form method="post" action="include/spptek/aksi_sinter.php?act=simpanpr&id=<?=$s[siid];?>"
							enctype="multipart/form-data">
							<div class="control-group">
								<div class="controls">
								<input list="pilihpr" type="text" placeholder="Tulis No PR / Batal PR" name="pr" id="pr">
								<datalist id="pilihpr">
									<option value="Batal">Tidak Jadi Buat PR</option>
								</datalist>
									<!-- <input class="input-small" id="pr" type="text" name="pr" placeholder="Input No PR"> -->
									<button class="btn btn-primary">Simpan</button>
								</div>
						</form>
					<?php }elseif($_GET[status]=="brgdtg" AND $s[siid]==$_GET[id] AND $s[id_pesanantek]==$_GET[idb]){

					}else{
						
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
