<?php //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); ?>
<head>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>-->
</head>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Data Gudang Barang Teknik</div>
</div>
<div class="block-content collapse in">
<div class="span12">

    
<?php
// 	$smasuk = mysql_query("SELECT * FROM spptek WHERE sipengirim=$_SESSION[cv] OR sipengirim1=$_SESSION[cv] OR sipengirim2=$_SESSION[cv] AND accsipengirim1='Y' ORDER BY sitgl DESC");
	$bmasuk = mysql_query("SELECT * FROM barang_teknik");
	$stokmasuk = mysql_query("SELECT bt.nama, bt.satuan, bt.kode as kodebrg, bt.harga, bt.keterangan, bt.tanggal, tr.stok_masuk, bt.kategori, bt.lokasi,SUM(tr.stok_keluar) as stok_keluar, bt.jumlah as jumlah_stok, pb.jumlah as jumlah_pesan, sp.pr FROM barang_teknik bt
	                        LEFT JOIN transaksi_stok_teknik tr ON tr.kode_barang=bt.kode
	                        LEFT JOIN pesanan_barangtek pb ON pb.kode_barang=bt.kode
	                        LEFT JOIN spptek sp ON sp.siid=pb.id_spptek
                            GROUP BY bt.kode
                            ASC
	                        ")or die(mysql_error());

	// $stokmasuk = mysql_query("SELECT bt.nama, bt.satuan, bt.kode as kodebrg, bt.keterangan, count(tr.stok_keluar) as
	// stok_keluar, tr.stok_masuk, bt.jumlah as pesan, sp.siid, sp.pr, sp.sinmr
	// FROM transaksi_stok_teknik tr, barang_teknik bt, spptek sp WHERE bt.kode=tr.kode_barang AND bt.idspptek=sp.siid GROUP
	// BY bt.kode
	// ");
	
	$bbmasuk = mysql_query("SELECT sg.kode_barang as sg_kode_barang, sg.nama as sg_nama, sg.satuan as sg_satuan, sg.tanggal, sg.masuk, sg.keluar, sg.keterangan as sg_ket, bt.idspptek, bt.kode as bt_kode, bt.nama as bt_nama, bt.satuan as bt_satuan, bt.jumlah as bt_jumlah, bt.keterangan as bt_ket, sg.kode_barang as sg_kodebarang, sg.nama as sg_nama, sg.satuan as sg_satuan, sg.jumlah as sg_jumlah, sg.keterangan as sg_keterangan
	FROM stok_gudang_barang_teknik sg,transaksi_stok_teknik tb, barang_teknik bt WHERE sg.kode_barang=bt.kode AND sg.kode_barang=tb.kode_barang");


     ?>

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
            <input type="text" placeholder="Pilih Kode / Tulis Kode" name="kode_barang" list="kd">
            <datalist id="kd">
               	<?php
					$bt = mysql_query("SELECT * FROM barang_teknik");
					while ($bth=mysql_fetch_array($bt)){ ?>
	    		     	<option value="<?php echo $bth[kode]; ?>"><?php echo $bth[kode]; ?>-<?php echo $bth[nama]; ?></option>
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
            </select></b>
        </div> 
	</div>

    <div class="control-group">
        <label class="control-label" for="harga">Harga</label>
        <div class="controls"><input class="input-large focused" id="harga" type="number" name="harga" value=""></div>
    </div>

    <div class="control-group">
        <label class="control-label" for="harga">Lokasi</label>
        <div class="controls"><input class="input-large focused" id="harga" type="text" name="lokasi" value=""></div>
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
elseif($_GET[act]=="editstokbarangtek"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[kode]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM spptek a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/spptek/aksi_sinter.php?act=editbaranggudang&id=<?=$e[id_brg_teknik];?>"
    enctype="multipart/form-data" class="form-horizontal">

    <legend>Edit Stok Barang SPPTek</legend>
    <div class="control-group">
        <div class="control-label">Kode</div>
        <div class="controls"><b><input type="text" id="kode_barang" name="kode_barang" autofocus tabindex="1"
                    class="form-control kode" value="<?=$e[kode];?>"></b></div>
    </div>
    <div class="control-group">
        <div class="control-label">Nama</div>
        <div class="controls"><b><input type="text" id="nama" name="nama" autofocus tabindex="1"
                    class="form-control nama" value="<?=$e[nama];?>"></b></div>
    </div>
    <div class="control-group">
        <div class="control-label">Jumlah Barang</div>
        <div class="controls"><b><input type="text" id="nama" name="jumlah" autofocus tabindex="1"
                    class="form-control jumlah" value="<?=$e[jumlah];?>"></b></div>
    </div>
    <div class="control-group">
        <div class="control-label">Satuan</div>
        <div class="controls"><b><select name="satuan" class="form-control m-bot15">
                    <option value="M">M</option>
                    <option value="KG">KG</option>
                    <option value="CAN">CAN</option>
                    <option value="L">L</option>
                    <option value="BH">BH</option>
                </select></option></select></div></b>
    </div>
    <div class="control-group">
        <div class="control-label">Harga</div>
        <div class="controls"><b><input type="text" id="harga" name="harga" autofocus tabindex="1"
                    class="form-control harga" value="<?=$e[harga];?>"></b></div>
    </div>
    <div class="control-group">
        <div class="control-label">Lokasi</div>
        <div class="controls"><b><input type="text" id="lokasi" name="lokasi" autofocus tabindex="1"
                    class="form-control lokasi" value="<?=$e[lokasi];?>"></b></div>
    </div>
    <div class="control-group">
        <div class="control-label">Keterangan</div>
        <div class="controls"><b><textarea name="keterangan" tabindex="1" style="width: 400px; height: 90px"
                    class="form-control"><?=$e[keterangan];?></textarea></b></div>
    </div>

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
<form method="post" action="include/spptek/aksi_sinter.php?act=tambahtransaksi" enctype="multipart/form-data"
    class="form-horizontal" onsubmit="return validasi_input(this)">

    <fieldset>
        <legend>Transaksi Ketersediaan Barang Gudang</legend>

        <input type="hidden" name="nomor" value="<? echo " $newID" ?>">

        <div class="control-group">
            <label class="control-label" for="tanggal">Tanggal</label>
            <div class="controls">
                <input type="hidden" name="tanggal" value="$tgl1"><b><?php echo $tgl ?></b> </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="kode_barang">Kode Barang</label>
            <div class="controls">
                <input type="text" placeholder="Pilih Kode / Tulis Kode" name="kode_barang" id="kode_barang" list="kd"
                    value="<?php echo $data[kode]; ?>">
                <datalist id="kd">
                    <?php
					$bt = mysql_query("SELECT * FROM barang_teknik");
					while ($bth=mysql_fetch_array($bt)){ ?>
                    <option value="<?php echo $bth[kode]; ?>"><?php echo $bth[kode]; ?></option>
                    <?php
					}
				?>
                </datalist>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="Jenispptek">No. SPPTek</label>
            <div class="controls">
                <select class="chzn-select" name="sinmr">
                    <option value='' selected>Pilih Nomor SPPTek Untuk Transaksi Ini</option>
                    <?php
					$bt = mysql_query("SELECT * FROM spptek where sinmr");
					while ($bth=mysql_fetch_array($bt)){ ?>
                    <option value="<?php echo $bth[sinmr]; ?>"><?php echo $bth[sinmr]; ?></option>
                    <?php
					}
			?>
                    </option>
                </select></b>
            </div>
        </div>

        <p id="nama"></p>
        <div class="control-group">
            <label class="control-label" for="nama">Nama Barang</label>
            <div class="controls"><input class="input-large focused" id="namas" type="text" name="nama"
                    value="<?php echo $data[nama] ?>"></div>
        </div>

        <div class="control-group">
            <label class="control-label" for="jenis">Jenis Transaksi</label>
            <div class="controls">
                <select class="chzn-select" name="jenis" required="required">
                    <option value="masuk">Stok Masuk</option>
                    <option value="keluar">Stok Keluar</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="jumlah">Jumlah</label>
            <div class="controls"><input class="input-large focused" id="stok" type="number" name="stok" value=""></div>
        </div>


        <div class="control-group">
            <label class="control-label" for="jumlah">Satuan</label>
            <div class="controls"><input class="input-large focused" id="satuan" type="text" name="satuan"
                    value="<?php echo $data[satuan]; ?>" readonly></div>
        </div>


        <div class="control-group">
            <label class="control-label">Keterangan</label>
            <div class="controls">
                <textarea class="input-xxlarge focused" id="keterangan" name="keterangan"
                    style="width: 610px; height: 100px"></textarea>
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
			<div class="control-group"><div class="control-label">Jumlah Stok Masuk</div><div class="controls"><b><input type="text" id="masuk" name="masuk" autofocus tabindex="1" class="form-control jumlah" value="<?=$e['masuk'];?>"></b></div></div>
			<div class="control-group"><div class="control-label">Jumlah Stok Keluar</div><div class="controls"><b><input type="text" id="keluar" name="keluar" autofocus tabindex="1" class="form-control jumlah" value="<?=$e['keluar'];?>"></b></div></div>
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

	$tr     = mysql_query("SELECT a.kode, a.nama, a.satuan, b.keterangan, b.stok_masuk, b.stok_keluar, b.id_transaksi, b.tanggal, b.sinmr
    FROM barang_teknik a,transaksi_stok_teknik b WHERE a.kode=b.kode_barang AND a.kode='$_GET[kode]'");
	$stok   = mysql_fetch_array(mysql_query("SELECT * FROM barang_teknik WHERE kode='$_GET[kode]'"));

	?>
<strong>
<legend>Detail Transaksi Perbaikan-Pembelian Barang <?= $stok[nama];?> (SPPTek)</legend>
 <?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=barangtek&act=tmbtransaksi&kode=<?php echo $stok[kode] ?>'">Tambah Transaksi Gudang</button><br /><br />
	<?php
	}
	?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>No SPPTek</th>
			<th>Nama Barang</th>
            <th>Tanggal Transaksi</th>
			<th>Keterangan</th>
			<th>Jumlah Stok Masuk</th>
			<th>Jumlah Stok Dipakai</th>
            <th>Satuan</th>
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
                <td><?php echo $s[sinmr]; ?></td>
                <td><?php echo $s[nama]; ?></td>
                <td><?php echo tgl_indo($s[tanggal]); ?></td>
                <td><?php echo $s[keterangan];?></td>
                <td><?php echo $s[stok_masuk]; ?></td>
                <td><?php echo $s[stok_keluar]; ?></td>
                <td><?php echo $s[satuan]; ?></td>
                
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
            <td></td>
            <td></td>
            <td>Sisa Stok :</td>
            <td colspan="2"><?php echo $stok[jumlah];?></td>
            <td></td>
            <td></td>
        </tr>
	</tfoot>
</table>

<?php }//Detail Barang Teknik
elseif($_GET[act]=="detailbarangstok"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM barang_teknik a,spptek b WHERE a.idspptek=b.siid AND a.id_barang_teknik='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT * FROM stok_gudang_barang_teknik WHERE kode_barang='$_GET[kode]'"));
	
	?>
<strong>
<legend>Detail Barang Teknik</legend>
<table width="100%" border=1>
	<tr><td width="24%">Kode Barang </td><td>: <?=$efg[kode_barang];?></td></tr>
    <tr><td>Nama Barang </td><td>: <?=$efg[nama];?></td></tr>
    <tr><td>Jumlah </td><td>: <?=$efg[jumlah];?></td></tr>
    <tr><td>Satuan </td><td>: <?=$efg[satuan];?></td></tr>
    <tr><td>Keterangan </td><td>: <?=$efg[keterangan];?></td></tr>
</table>
<?php
}
else{ ?> 

    <!--Menampilkan Stok gudang barang teknik-->

    <?php
	if($_SESSION[levelcv]<7){
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=barangtek&act=tmbbarang'">Tambah Barang Gudang</button><br /><br />
	<?php
	}
	?>
    <div style="overflow-x:auto;">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
			    <thead>
			        <tr>
			            <th>No</th>
			            <th>Kode</th>
			            <th>Nama Barang</th>
			            <th>Jumlah Stok</th>
			            <th>Satuan</th>
			            <th>Kategori</th>
			            <th>Harga</th>
			            <th>Lokasi dan Keterangan</th>
			            <th class='center'>Aksi</th>
			        </tr>
			    </thead>
			    <tbody>
			        <?
	    $i = 1;
		while($s = mysql_fetch_array($stokmasuk)) {
			echo "<tr>
                <td>$i</td>
                <td>$s[kodebrg]</td>
                <td>$s[nama]</td>
                <td>$s[jumlah_stok] </td>
                <td>$s[satuan] </td>
                <td>$s[kategori]</td>
                <td>";?>Rp <?php echo number_format($s[harga],2,',','.') ?><?php echo"</td>
                <td>Lokasi : $s[lokasi]<br>Ket : $s[keterangan]</td>
                
                <td class='center'>
                    <!-- <a href='home.php?pages=barangtek&act=detailbarangstok&kode=$s[kodebrg]' class='btn btn-info'>Detail</a> -->
                    <a href='home.php?pages=barangtek&act=detailbarang&kode=$s[kodebrg]' title=DetailMemo class='btn btn-info'>Detai Transaksi</a>";?>
                    <?php
                    if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='80' or $_SESSION[cv]=='16'){
                    echo"<a href='home.php?pages=barangtek&act=editstokbarangtek&kode=$s[kodebrg]' class='btn btn-success'>Ubah</a>
                    <a href='include/spptek/aksi_sinter.php?act=hapusbarangtekgdng&kode=$s[kodebrg]' onClick=\"return confirm('Yakin ingin menghapus??')\" class='btn btn-warning'>Hapus</a>";?>
                    <?php }
                    echo"
                </td>
                </tr>";
				$i++;
	    }

	?>
			    </tbody>
			</table>
    </div>
<?php } ?>
</div>
</div>

<script>

    //  function getdata(isi, cek) {
         
    //           $.ajax({
    //             type:"GET",
    //             url:"include/spptek/aksi_sinter.php?act=getdatatrans&kode="+isi,
                // dataType : "JSON",
                // success  : function (data) {
                //     var hss = JSON.parse(data);
                //   var prv = "<option value=''>-- Pilih Nama Barang --</option>";
                //   for (var i = 0; i < data.length; i++) {
                //       prv = prv+"<option value='"+data[i].nama+"'>"+data[i].nama+"</option>";
                    
                //   }
//                   $('#nama').val(data['nama']);
//                 },
                
    
//               });
//   }

</script>