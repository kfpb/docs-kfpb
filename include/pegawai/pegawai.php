<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Daftar Pegawai</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET[act]=="tambah"){
?>
<form method="post" action="include/pegawai/aksi_pegawai.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah pegawai</legend>
	<div class="control-group">
		<label class="control-label" for="user">NPP</label>
        <div class="controls"><input class="input-medium focused" id="user" type="text" name="npp" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="nama">Nama</label>
        <div class="controls"><input class="input-xlarge focused" id="nama" type="text" name="nama" required="required"></div>
    </div>
<?
/*
	 <div class="control-group">
		<label class="control-label" for="jabatan">Jabatan</label>
        <div class="controls">
        	<select name="jabatan" class="span3" required="required">
        	   <option value='' selected>Pilih Jabatan</option>
               <option value='Manager'>Manager</option>
			   <option value='Asman' >Asisten Manager</option>
			   <option value='Supervisor' >Supervisor</option>
			   <option value='Pelaksana' >Pelaksana</option>
            </select>
         </div>
    </div>
*/
?>
     <div class="control-group">
		<label class="control-label" for="status">Status</label>
        <div class="controls">
        	<select name="status" class="span3" required="required">
        	   <option value='' selected>Pilih Status</option>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT' >Pegawai Kerja Waktu Tertentu</option>
			   <option value='TO' >Tenaga Outsourcing</option>
			   <option value='Magang' >Magang</option>
			   <option value='MPP' >MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
         </div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="bagian">Bagian/Sub Bag.</label>
        <div class="controls">
           	<select id="bagian" class="chzn-select span9"  name="bagian">
			<option value='' selected>Pilih Bagian/Sub Bagian</option>
			<option value='UNIT PLANT Banjaran'>UNIT PLANT Banjaran</option>
			<option value='SUB UNIT PEMASTIAN MUTU'>SUB UNIT PEMASTIAN MUTU</option>
			<option value='SUB UNIT PRODUKSI'>SUB UNIT PRODUKSI</option>
			<option value='BAGIAN PEMBELIAN'>BAGIAN PEMBELIAN</option>
			<option value='SUB BAGIAN PENGADAAN'>SUB BAGIAN PENGADAAN</option>
			<option value='BAGIAN PENGAWASAN MUTU'>BAGIAN PENGAWASAN MUTU</option>
			<option value='SUB BAGIAN PEMERIKSAAN BAHAN BAKU' >SUB BAGIAN PEMERIKSAAN BAHAN BAKU</option>
			<option value='SUB BAGIAN PEMERIKSAAN BAHAN PENGEMAS' >SUB BAGIAN PEMERIKSAAN BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN PEMERIKSAAN MIKROBIOLOGI & LIMBAH' >SUB BAGIAN PEMERIKSAAN MIKROBIOLOGI & LIMBAH</option>
			<option value='SUB BAGIAN PEMERIKSAAN  PRODUK ANTARA & RUAHAN' >SUB BAGIAN PEMERIKSAAN  PRODUK ANTARA & RUAHAN</option>
			<option value='SUB BAGIAN PENGAWASAN PROSES PRODUKSI' >SUB BAGIAN PENGAWASAN PROSES PRODUKSI</option>
			<option value='SUB BAGIAN PEMERIKSAAN PRODUK JADI' >SUB BAGIAN PEMERIKSAAN PRODUK JADI</option>
			<option value='BAGIAN TEKNIK & PEMELIHARAAN' >BAGIAN TEKNIK & PEMELIHARAAN</option>
			<option value='SUB BAGIAN MEKANIK' >SUB BAGIAN MEKANIK</option>
			<option value='SUB BAGIAN LISTRIK DAN ENERGI' >SUB BAGIAN LISTRIK DAN ENERGI</option>
			<option value='SUB BAGIAN HARDWARE & NETWORK'>SUB BAGIAN HARDWARE & NETWORK</option>
			<option value='SUB BAGIAN UTILITY'>SUB BAGIAN UTILITY</option>
			<option value='BAGIAN AKUNTANSI & SDM'>BAGIAN AKUNTANSI & SDM</option>
			<option value='SUB BAGIAN AKUNTANSI BIAYA'>SUB BAGIAN AKUNTANSI BIAYA</option>
			<option value='SUB BAGIAN VERIFIKASI BIAYA'>SUB BAGIAN VERIFIKASI BIAYA</option>
			<option value='SUB BAGIAN PAJAK & KEUANGAN'>SUB BAGIAN PAJAK & KEUANGAN</option>
			<option value='SUB BAGIAN ADMINISTRASI PERSONALIA'>SUB BAGIAN ADMINISTRASI PERSONALIA</option>
			<option value='SUB BAGIAN PELATIHAN & KINERJA PEGAWAI'>SUB BAGIAN PELATIHAN & KINERJA PEGAWAI</option>
			<option value='BAGIAN UMUM & K3L'>BAGIAN UMUM & K3L</option>
			<option value='SUB BAGIAN K3'>SUB BAGIAN K3</option>
			<option value='SUB BAGIAN LINGKUNGAN'>SUB BAGIAN LINGKUNGAN</option>
			<option value='SUB BAGIAN UMUM'>SUB BAGIAN UMUM</option>
			<option value='BAGIAN PRODUKSI I'>BAGIAN  PRODUKSI I</option>
			<option value='SUB BAGIAN GRANULASI MASSA TABLET'>SUB BAGIAN GRANULASI MASSA TABLET</option>
			<option value='SUB BAGIAN PENCETAKAN TABLET'>SUB BAGIAN PENCETAKAN TABLET</option>
			<option value='SUB BAGIAN PENYALUTAN TABLET'>SUB BAGIAN PENYALUTAN TABLET</option>
			<option value='BAGIAN PENGEMASAN'>BAGIAN PENGEMASAN</option>
			<option value='SUB BAGIAN PENGEMASAN PRIMER TABLET'>SUB BAGIAN PENGEMASAN PRIMER TABLET</option>
			<option value='SUB BAGIAN PENGEMASAN SEKUNDER TABLET'>SUB BAGIAN PENGEMASAN SEKUNDER TABLET</option>
			<option value='BAGIAN PRODUKSI II'>BAGIAN  PRODUKSI II</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN CAIRAN'>SUB BAGIAN PENGOLAHAN & PENGEMASAN CAIRAN</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN SERBUK'>SUB BAGIAN PENGOLAHAN & PENGEMASAN SERBUK</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN FITOFARMAKA'>SUB BAGIAN PENGOLAHAN & PENGEMASAN FITOFARMAKA</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN PRODUK KB'>SUB BAGIAN PENGOLAHAN & PENGEMASAN PRODUK KB</option>
			<option value='BAGIAN PENGEMBANGAN PRODUK'>BAGIAN PENGEMBANGAN PRODUK</option>
			<option value='SUB BAGIAN PENGEMBANGAN DESAIN & FORMULA BAHAN PENGEMAS'>SUB BAGIAN PENGEMBANGAN DESAIN & FORMULA BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN PENGEMBANGAN FORMULA PRODUK'>SUB BAGIAN PENGEMBANGAN FORMULA PRODUK</option>
			<option value='BAGIAN SISTEM MUTU'>BAGIAN SISTEM MUTU</option>
			<option value='SUB BAGIAN  PENGENDALIAN DOKUMEN, REGULASI & PENANGANAN KELUHAN'>SUB BAGIAN  PENGENDALIAN DOKUMEN, REGULASI & PENANGANAN KELUHAN</option>
			<option value='SUB BAGIAN VALIDASI, KUALIFIKASI & KALIBRASI'>SUB BAGIAN VALIDASI, KUALIFIKASI & KALIBRASI</option>
			<option value='SUB BAGIAN STABILITAS'>SUB BAGIAN STABILITAS</option>
			<option value='SUB BAGIAN INSPEKSI & AUDIT'>SUB BAGIAN INSPEKSI & AUDIT</option>
			<option value='BAGIAN PENGENDALIAN PROSES PRODUKSI'>BAGIAN PENGENDALIAN PROSES PRODUKSI</option>
			<option value='BAGIAN PENYIMPANAN'>BAGIAN PENYIMPANAN</option>
			<option value='SUB BAGIAN GUDANG BAHAN BAKU'>SUB BAGIAN GUDANG BAHAN BAKU</option>
			<option value='SUB BAGIAN GUDANG BAHAN PENGEMAS'>SUB BAGIAN GUDANG BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN GUDANG OBAT JADI'>SUB BAGIAN GUDANG OBAT JADI</option>
			<option value='SUB BAGIAN PENIMBANGAN SENTRAL'>SUB BAGIAN PENIMBANGAN SENTRAL</option>
			<option value='SUB BAGIAN PENANDAAN BAHAN PENGEMAS'>SUB BAGIAN PENANDAAN BAHAN PENGEMAS</option>
			<option value='PABRIK PLANT BANJARAN'>PABRIK PLANT BANJARAN</option>
			<option value='PABRIK PLANT Banjaran'>PABRIK PLANT Banjaran</option>

		</select> 

        </div>
    </div>
	
	 <div class="control-group">
    	<label class="control-label" for="bagian">Pilih Bagian/Unit</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span7"  name="bagian2" required>
			<option value='' selected>Pilih Unit/ Bagian</option>
			<option value='UNIT PLANT Banjaran'>UNIT PLANT Banjaran</option>
			<option value='SUB UNIT PEMASTIAN MUTU'>SUB UNIT PEMASTIAN MUTU</option>
			<option value='SUB UNIT PRODUKSI'>SUB UNIT PRODUKSI</option>
			<option value='BAGIAN PEMBELIAN'>BAGIAN PEMBELIAN</option>
			<option value='BAGIAN PENGAWASAN MUTU'>BAGIAN PENGAWASAN MUTU</option>
			<option value='BAGIAN TEKNIK & PEMELIHARAAN' >BAGIAN TEKNIK & PEMELIHARAAN</option>
			<option value='BAGIAN AKUNTANSI & SDM'>BAGIAN AKUNTANSI & SDM</option>
			<option value='BAGIAN UMUM & K3L'>BAGIAN UMUM & K3L</option>
			<option value='BAGIAN PRODUKSI I'>BAGIAN PRODUKSI I</option>
			<option value='BAGIAN PRODUKSI II'>BAGIAN PRODUKSI II</option>
			<option value='BAGIAN PENGEMASAN'>BAGIAN PENGEMASAN</option>
			<option value='BAGIAN PENGEMBANGAN PRODUK'>BAGIAN PENGEMBANGAN PRODUK</option>
			<option value='BAGIAN SISTEM MUTU'>BAGIAN SISTEM MUTU</option>
			<option value='BAGIAN PENGENDALIAN PROSES PRODUKSI'>BAGIAN PENGENDALIAN PROSES PRODUKSI</option>
			<option value='BAGIAN PENYIMPANAN'>BAGIAN PENYIMPANAN</option>
			<option value='PABRIK PLANT BANJARAN'>PABRIK PLANT BANJARAN</option>
			<option value='PABRIK PLANT Banjaran'>PABRIK PLANT Banjaran</option>
		</select>
		
		</div></div>
	
	
	<div class="control-group">
		<label class="control-label">Foto</label>
		<div class="controls"><input class="input-file uniform_on" id="fileInput" type="file" name="fupload"></div>
    </div>

    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_GET[id]'"));
if ($e[cFoto]==""){
	$foto = "fotopegawai/nophoto.png";
}else{
	$foto = "fotopegawai/$e[cFoto]";
}
?>
<form method="post" action="include/pegawai/aksi_pegawai.php?act=edit&id=<?=$e[cId];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Pegawai</legend>
	<div class="control-group">
		<div class="controls">
		<img src="<?=$foto;?>" style="width: 120px; height: 120px;" class="tooltip-right" data-original-title="<?=$e[cNama];?>">
		<input class="input-file uniform_on" id="fileInput" type="file" name="fupload">
		<?php
		if ($e[cFoto]!=""){
		echo "<span class='help-inline'>*Abaikan bila foto tidak diganti</span>";
		}
		?>
		</div>
    </div>

	<div class="control-group">
		<label class="control-label" for="npp">NPP</label>
        <div class="controls"><input class="input-medium focused" id="user" type="text" name="npp" required="required" value="<?=$e[cNPP];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="nama">Nama</label>
        <div class="controls"><input class="input-xlarge focused" id="nama" type="text" name="nama" required="required" value="<?=$e[cNama];?>"></div>
    </div>
<?
/*
	<div class="control-group">
		<label class="control-label" for="jabatan">Jabatan</label>
        <div class="controls">
        	<?php
			if($e[cJabatan]==Manager){
				echo "
			   <select name='jabatan' class='span3'>
               <option value='Manager' selected>Manager</option>
			   <option value='Asman' >Asisten Manager</option>
			   <option value='Supervisor' >Supervisor</option>
			   <option value='Pelaksana' >Pelaksana</option>
               </select>
				";
			}
			elseif($e[cJabatan]==Asman){
				echo "
			   <select name='jabatan' class='span3'>
               <option value='Manager'>Manager</option>
			   <option value='Asman' selected>Asisten Manager</option>
			   <option value='Supervisor' >Supervisor</option>
			   <option value='Pelaksana' >Pelaksana</option>
               </select>
				";
			}
			elseif($e[cJabatan]==Supervisor){
				echo "
			   <select name='jabatan' class='span3'>
               <option value='Manager'>Manager</option>
			   <option value='Asman'>Asisten Manager</option>
			   <option value='Supervisor' selected>Supervisor</option>
			   <option value='Pelaksana' >Pelaksana</option>
               </select>
				";
			}
			elseif($e[cJabatan]==Pelaksana){
				echo "
			   <select name='jabatan' class='span3'>
               <option value='Manager'>Manager</option>
			   <option value='Asman'>Asisten Manager</option>
			   <option value='Supervisor'>Supervisor</option>
			   <option value='Pelaksana' selected>Pelaksana</option>
               </select>
				";
			}
			else{
			   echo "
			   <select name='jabatan' class='span3'>
			   <option value='' selected>Pilih Jabatan</option>
               <option value='Manager'>Manager</option>
			   <option value='Asman'>Asisten Manager</option>
			   <option value='Supervisor'>Supervisor</option>
			   <option value='Pelaksana' >Pelaksana</option>
               </select>
				";
			}
			?>

            </select>
         </div>
    </div>
*/
?>
    	<div class="control-group">
		<label class="control-label" for="status">Status</label>
        <div class="controls">
        	<?php
			if($e[cStatus]==PT){
				echo "
			   <select name='status' class='span3'>
               <option value='PT' selected>Pegawai Tetap</option>
			   <option value='PKWT' >Pegawai Kerja Waktu Tertentu (PKWT)</option>
			   <option value='Magang' >Magang</option>
			   <option value='TO' >TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]==PKWT){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'  selected>Pegawai Kerja Waktu Tertentu (PKWT)</option>
			   <option value='Magang' >Magang</option>
			   <option value='TO' >TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' >ISS</option>
			  <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]==Magang){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu (PKWT)</option>
			   <option value='Magang' selected>Magang</option>
			   <option value='TO' >TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' >ISS</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]==TO){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu (PKWT)</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO' selected>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' >ISS</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]==MPP){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP' selected>MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]==XPKWT){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT' selected>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]==XTO){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO' selected>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
		elseif($e[cStatus]==ISS){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' selected>Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
		 elseif($e[cStatus]==Security){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' selected>Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
		elseif($e[cStatus]=='Security_Bnjrn'){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security'>Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' selected>Security ISS Banjaran</option>
			   <option value='ISS' >ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
		 elseif($e[cStatus]=='ISS'){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS' selected>ISS Kebersihan Banjaran</option>
			   <option value='B1' >Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
		 elseif($e[cStatus]=='B1'){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS'>ISS Kebersihan Banjaran</option>
			   <option value='B1' selected>Be-One</option>
			   <option value='IP' >Indopsiko</option>
            </select>
				";
			}
			elseif($e[cStatus]=='IP'){
				echo "
			   <select name='status' class='span3'>
               <option value='PT'>Pegawai Tetap</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='TO'>TO</option>
			   <option value='MPP'>MPP</option>
			   <option value='XPKWT>X-PKWT</option>
			   <option value='XTO'>X-TO</option>
			   <option value='EGS' >Kebersihan EGS Banjaran</option>
			   <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS'>ISS Kebersihan Banjaran</option>
			   <option value='B1'>Be-One</option>
			   <option value='IP' selected>Indopsiko</option>
            </select>
				";
			}
			else{
			   echo "
			   <select name='status' class='span3'>
			   <option value='' selected>Pilih Status</option>
               <option value='PT'>Pegawai Tetap</option>
               <option value='TO'>TO</option>
			   <option value='PKWT'>Pegawai Kerja Waktu Tertentu</option>
			   <option value='Magang'>Magang</option>
			   <option value='MPP' selected>MPP</option>
			   <option value='XPKWT' >X-PKWT</option>
			   <option value='XTO' >X-TO</option>
			   <option value='EGS' selected>ISS</option>
			  <option value='Security' >Security EGS Banjaran</option>
			   <option value='Security_Bnjrn' >Security ISS Banjaran</option>
			   <option value='ISS'>ISS Kebersihan Banjaran</option>
			   <option value='B1'>Be-One</option>
            </select>
				";
			}
			?>

            </select>
         </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="bagian">Sub/Bagian</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span9"  name="bagian">
			<option value='<?=$e[cBagian];?>' selected><?=$e[cBagian];?></option>
			<option value='UNIT PLANT Banjaran'>UNIT PLANT Banjaran</option>
			<option value='SUB UNIT PEMASTIAN MUTU'>SUB UNIT PEMASTIAN MUTU</option>
			<option value='SUB UNIT PRODUKSI'>SUB UNIT PRODUKSI</option>
			<option value='BAGIAN PEMBELIAN'>BAGIAN PEMBELIAN</option>
			<option value='SUB BAGIAN PENGADAAN'>SUB BAGIAN PENGADAAN</option>
			<option value='BAGIAN PENGAWASAN MUTU'>BAGIAN PENGAWASAN MUTU</option>
			<option value='SUB BAGIAN PEMERIKSAAN BAHAN BAKU' >SUB BAGIAN PEMERIKSAAN BAHAN BAKU</option>
			<option value='SUB BAGIAN PEMERIKSAAN BAHAN PENGEMAS' >SUB BAGIAN PEMERIKSAAN BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN PEMERIKSAAN MIKROBIOLOGI & LIMBAH' >SUB BAGIAN PEMERIKSAAN MIKROBIOLOGI & LIMBAH</option>
			<option value='SUB BAGIAN PEMERIKSAAN  PRODUK ANTARA & RUAHAN' >SUB BAGIAN PEMERIKSAAN  PRODUK ANTARA & RUAHAN</option>
			<option value='SUB BAGIAN PENGAWASAN PROSES PRODUKSI' >SUB BAGIAN PENGAWASAN PROSES PRODUKSI</option>
			<option value='SUB BAGIAN PEMERIKSAAN PRODUK JADI' >SUB BAGIAN PEMERIKSAAN PRODUK JADI</option>
			<option value='BAGIAN TEKNIK & PEMELIHARAAN' >BAGIAN TEKNIK & PEMELIHARAAN</option>
			<option value='SUB BAGIAN MEKANIK' >SUB BAGIAN MEKANIK</option>
			<option value='SUB BAGIAN LISTRIK DAN ENERGI' >SUB BAGIAN LISTRIK DAN ENERGI</option>
			<option value='SUB BAGIAN HARDWARE & NETWORK'>SUB BAGIAN HARDWARE & NETWORK</option>
			<option value='SUB BAGIAN UTILITY'>SUB BAGIAN UTILITY</option>
			<option value='BAGIAN AKUNTANSI & SDM'>BAGIAN AKUNTANSI & SDM</option>
			<option value='SUB BAGIAN AKUNTANSI BIAYA'>SUB BAGIAN AKUNTANSI BIAYA</option>
			<option value='SUB BAGIAN VERIFIKASI BIAYA'>SUB BAGIAN VERIFIKASI BIAYA</option>
			<option value='SUB BAGIAN PAJAK & KEUANGAN'>SUB BAGIAN PAJAK & KEUANGAN</option>
			<option value='SUB BAGIAN ADMINISTRASI PERSONALIA'>SUB BAGIAN ADMINISTRASI PERSONALIA</option>
			<option value='SUB BAGIAN PELATIHAN & KINERJA PEGAWAI'>SUB BAGIAN PELATIHAN & KINERJA PEGAWAI</option>
			<option value='BAGIAN UMUM & K3L'>BAGIAN UMUM & K3L</option>
			<option value='SUB BAGIAN K3'>SUB BAGIAN K3</option>
			<option value='SUB BAGIAN LINGKUNGAN'>SUB BAGIAN LINGKUNGAN</option>
			<option value='SUB BAGIAN UMUM'>SUB BAGIAN UMUM</option>
			<option value='BAGIAN PRODUKSI I'>BAGIAN  PRODUKSI I</option>
			<option value='SUB BAGIAN GRANULASI MASSA TABLET'>SUB BAGIAN GRANULASI MASSA TABLET</option>
			<option value='SUB BAGIAN PENCETAKAN TABLET'>SUB BAGIAN PENCETAKAN TABLET</option>
			<option value='SUB BAGIAN PENYALUTAN TABLET'>SUB BAGIAN PENYALUTAN TABLET</option>
			<option value='BAGIAN PENGEMASAN'>BAGIAN PENGEMASAN</option>
			<option value='SUB BAGIAN PENGEMASAN PRIMER TABLET'>SUB BAGIAN PENGEMASAN PRIMER TABLET</option>
			<option value='SUB BAGIAN PENGEMASAN SEKUNDER TABLET'>SUB BAGIAN PENGEMASAN SEKUNDER TABLET</option>
			<option value='BAGIAN PRODUKSI II'>BAGIAN  PRODUKSI II</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN CAIRAN'>SUB BAGIAN PENGOLAHAN & PENGEMASAN CAIRAN</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN SERBUK'>SUB BAGIAN PENGOLAHAN & PENGEMASAN SERBUK</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN FITOFARMAKA'>SUB BAGIAN PENGOLAHAN & PENGEMASAN FITOFARMAKA</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN PRODUK KB'>SUB BAGIAN PENGOLAHAN & PENGEMASAN PRODUK KB</option>
			<option value='BAGIAN PENGEMBANGAN PRODUK'>BAGIAN PENGEMBANGAN PRODUK</option>
			<option value='SUB BAGIAN PENGEMBANGAN DESAIN & FORMULA BAHAN PENGEMAS'>SUB BAGIAN PENGEMBANGAN DESAIN & FORMULA BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN PENGEMBANGAN FORMULA PRODUK'>SUB BAGIAN PENGEMBANGAN FORMULA PRODUK</option>
			<option value='BAGIAN SISTEM MUTU'>BAGIAN SISTEM MUTU</option>
			<option value='SUB BAGIAN  PENGENDALIAN DOKUMEN, REGULASI & PENANGANAN KELUHAN'>SUB BAGIAN  PENGENDALIAN DOKUMEN, REGULASI & PENANGANAN KELUHAN</option>
			<option value='SUB BAGIAN VALIDASI, KUALIFIKASI & KALIBRASI'>SUB BAGIAN VALIDASI, KUALIFIKASI & KALIBRASI</option>
			<option value='SUB BAGIAN STABILITAS'>SUB BAGIAN STABILITAS</option>
			<option value='SUB BAGIAN INSPEKSI & AUDIT'>SUB BAGIAN INSPEKSI & AUDIT</option>
			<option value='BAGIAN PENGENDALIAN PROSES PRODUKSI'>BAGIAN PENGENDALIAN PROSES PRODUKSI</option>
			<option value='BAGIAN PENYIMPANAN'>BAGIAN PENYIMPANAN</option>
			<option value='SUB BAGIAN GUDANG BAHAN BAKU'>SUB BAGIAN GUDANG BAHAN BAKU</option>
			<option value='SUB BAGIAN GUDANG BAHAN PENGEMAS'>SUB BAGIAN GUDANG BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN GUDANG OBAT JADI'>SUB BAGIAN GUDANG OBAT JADI</option>
			<option value='SUB BAGIAN PENIMBANGAN SENTRAL'>SUB BAGIAN PENIMBANGAN SENTRAL</option>
			<option value='SUB BAGIAN PENANDAAN BAHAN PENGEMAS'>SUB BAGIAN PENANDAAN BAHAN PENGEMAS</option>
			<option value='PABRIK PLANT BANJARAN'>PABRIK PLANT BANJARAN</option>
			<option value='PABRIK PLANT Banjaran'>PABRIK PLANT Banjaran</option>
		</select>
		</div></div>


 <div class="control-group">
    	<label class="control-label" for="bagian">Bagian/Unit</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span9"  name="bagian2">
			<option value='<?=$e[cBagian2];?>' selected><?=$e[cBagian2];?></option>
					<option value='UNIT PLANT Banjaran'>UNIT PLANT Banjaran</option>
			<option value='SUB UNIT PEMASTIAN MUTU'>SUB UNIT PEMASTIAN MUTU</option>
			<option value='SUB UNIT PRODUKSI'>SUB UNIT PRODUKSI</option>
			<option value='BAGIAN PEMBELIAN'>BAGIAN PEMBELIAN</option>
			<option value='BAGIAN PENGAWASAN MUTU'>BAGIAN PENGAWASAN MUTU</option>
			<option value='BAGIAN TEKNIK & PEMELIHARAAN' >BAGIAN TEKNIK & PEMELIHARAAN</option>
			<option value='BAGIAN AKUNTANSI & SDM'>BAGIAN AKUNTANSI & SDM</option>
			<option value='BAGIAN UMUM & K3L'>BAGIAN UMUM & K3L</option>
			<option value='BAGIAN PRODUKSI I'>BAGIAN PRODUKSI I</option>
			<option value='BAGIAN PRODUKSI II'>BAGIAN PRODUKSI II</option>
			<option value='BAGIAN PENGEMASAN'>BAGIAN PENGEMASAN</option>
			<option value='BAGIAN PENGEMBANGAN PRODUK'>BAGIAN PENGEMBANGAN PRODUK</option>
			<option value='BAGIAN SISTEM MUTU'>BAGIAN SISTEM MUTU</option>
			<option value='BAGIAN PENGENDALIAN PROSES PRODUKSI'>BAGIAN PENGENDALIAN PROSES PRODUKSI</option>
			<option value='BAGIAN PENYIMPANAN'>BAGIAN PENYIMPANAN</option>
			<option value='PABRIK PLANT BANJARAN'>PABRIK PLANT BANJARAN</option>
			<option value='PABRIK PLANT Banjaran'>PABRIK PLANT Banjaran</option>
		</select>
		</div></div>


     <div class="control-group">
    	<label class="control-label" for="bagian">Sub/Bagian Sementara</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span9"  name="sub2">
			<option value='<?=$e[cSub2];?>' selected><?=$e[cSub2];?></option>
			<option value='UNIT PLANT Banjaran'>UNIT PLANT Banjaran</option>
			<option value='SUB UNIT PEMASTIAN MUTU'>SUB UNIT PEMASTIAN MUTU</option>
			<option value='SUB UNIT PRODUKSI'>SUB UNIT PRODUKSI</option>
			<option value='BAGIAN PEMBELIAN'>BAGIAN PEMBELIAN</option>
			<option value='SUB BAGIAN PENGADAAN'>SUB BAGIAN PENGADAAN</option>
			<option value='BAGIAN PENGAWASAN MUTU'>BAGIAN PENGAWASAN MUTU</option>
			<option value='SUB BAGIAN PEMERIKSAAN BAHAN BAKU' >SUB BAGIAN PEMERIKSAAN BAHAN BAKU</option>
			<option value='SUB BAGIAN PEMERIKSAAN BAHAN PENGEMAS' >SUB BAGIAN PEMERIKSAAN BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN PEMERIKSAAN MIKROBIOLOGI & LIMBAH' >SUB BAGIAN PEMERIKSAAN MIKROBIOLOGI & LIMBAH</option>
			<option value='SUB BAGIAN PEMERIKSAAN  PRODUK ANTARA & RUAHAN' >SUB BAGIAN PEMERIKSAAN  PRODUK ANTARA & RUAHAN</option>
			<option value='SUB BAGIAN PENGAWASAN PROSES PRODUKSI' >SUB BAGIAN PENGAWASAN PROSES PRODUKSI</option>
			<option value='SUB BAGIAN PEMERIKSAAN PRODUK JADI' >SUB BAGIAN PEMERIKSAAN PRODUK JADI</option>
			<option value='BAGIAN TEKNIK & PEMELIHARAAN' >BAGIAN TEKNIK & PEMELIHARAAN</option>
			<option value='SUB BAGIAN MEKANIK' >SUB BAGIAN MEKANIK</option>
			<option value='SUB BAGIAN LISTRIK DAN ENERGI' >SUB BAGIAN LISTRIK DAN ENERGI</option>
			<option value='SUB BAGIAN HARDWARE & NETWORK'>SUB BAGIAN HARDWARE & NETWORK</option>
			<option value='SUB BAGIAN UTILITY'>SUB BAGIAN UTILITY</option>
			<option value='BAGIAN AKUNTANSI & SDM'>BAGIAN AKUNTANSI & SDM</option>
			<option value='SUB BAGIAN AKUNTANSI BIAYA'>SUB BAGIAN AKUNTANSI BIAYA</option>
			<option value='SUB BAGIAN VERIFIKASI BIAYA'>SUB BAGIAN VERIFIKASI BIAYA</option>
			<option value='SUB BAGIAN PAJAK & KEUANGAN'>SUB BAGIAN PAJAK & KEUANGAN</option>
			<option value='SUB BAGIAN ADMINISTRASI PERSONALIA'>SUB BAGIAN ADMINISTRASI PERSONALIA</option>
			<option value='SUB BAGIAN PELATIHAN & KINERJA PEGAWAI'>SUB BAGIAN PELATIHAN & KINERJA PEGAWAI</option>
			<option value='BAGIAN UMUM & K3L'>BAGIAN UMUM & K3L</option>
			<option value='SUB BAGIAN K3'>SUB BAGIAN K3</option>
			<option value='SUB BAGIAN LINGKUNGAN'>SUB BAGIAN LINGKUNGAN</option>
			<option value='SUB BAGIAN UMUM'>SUB BAGIAN UMUM</option>
			<option value='BAGIAN PRODUKSI I'>BAGIAN  PRODUKSI I</option>
			<option value='SUB BAGIAN GRANULASI MASSA TABLET'>SUB BAGIAN GRANULASI MASSA TABLET</option>
			<option value='SUB BAGIAN PENCETAKAN TABLET'>SUB BAGIAN PENCETAKAN TABLET</option>
			<option value='SUB BAGIAN PENYALUTAN TABLET'>SUB BAGIAN PENYALUTAN TABLET</option>
			<option value='BAGIAN PENGEMASAN'>BAGIAN PENGEMASAN</option>
			<option value='SUB BAGIAN PENGEMASAN PRIMER TABLET'>SUB BAGIAN PENGEMASAN PRIMER TABLET</option>
			<option value='SUB BAGIAN PENGEMASAN SEKUNDER TABLET'>SUB BAGIAN PENGEMASAN SEKUNDER TABLET</option>
			<option value='BAGIAN PRODUKSI II'>BAGIAN  PRODUKSI II</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN CAIRAN'>SUB BAGIAN PENGOLAHAN & PENGEMASAN CAIRAN</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN SERBUK'>SUB BAGIAN PENGOLAHAN & PENGEMASAN SERBUK</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN FITOFARMAKA'>SUB BAGIAN PENGOLAHAN & PENGEMASAN FITOFARMAKA</option>
			<option value='SUB BAGIAN PENGOLAHAN & PENGEMASAN PRODUK KB'>SUB BAGIAN PENGOLAHAN & PENGEMASAN PRODUK KB</option>
			<option value='BAGIAN PENGEMBANGAN PRODUK'>BAGIAN PENGEMBANGAN PRODUK</option>
			<option value='SUB BAGIAN PENGEMBANGAN DESAIN & FORMULA BAHAN PENGEMAS'>SUB BAGIAN PENGEMBANGAN DESAIN & FORMULA BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN PENGEMBANGAN FORMULA PRODUK'>SUB BAGIAN PENGEMBANGAN FORMULA PRODUK</option>
			<option value='BAGIAN SISTEM MUTU'>BAGIAN SISTEM MUTU</option>
			<option value='SUB BAGIAN  PENGENDALIAN DOKUMEN, REGULASI & PENANGANAN KELUHAN'>SUB BAGIAN  PENGENDALIAN DOKUMEN, REGULASI & PENANGANAN KELUHAN</option>
			<option value='SUB BAGIAN VALIDASI, KUALIFIKASI & KALIBRASI'>SUB BAGIAN VALIDASI, KUALIFIKASI & KALIBRASI</option>
			<option value='SUB BAGIAN STABILITAS'>SUB BAGIAN STABILITAS</option>
			<option value='SUB BAGIAN INSPEKSI & AUDIT'>SUB BAGIAN INSPEKSI & AUDIT</option>
			<option value='BAGIAN PENGENDALIAN PROSES PRODUKSI'>BAGIAN PENGENDALIAN PROSES PRODUKSI</option>
			<option value='BAGIAN PENYIMPANAN'>BAGIAN PENYIMPANAN</option>
			<option value='SUB BAGIAN GUDANG BAHAN BAKU'>SUB BAGIAN GUDANG BAHAN BAKU</option>
			<option value='SUB BAGIAN GUDANG BAHAN PENGEMAS'>SUB BAGIAN GUDANG BAHAN PENGEMAS</option>
			<option value='SUB BAGIAN GUDANG OBAT JADI'>SUB BAGIAN GUDANG OBAT JADI</option>
			<option value='SUB BAGIAN PENIMBANGAN SENTRAL'>SUB BAGIAN PENIMBANGAN SENTRAL</option>
			<option value='SUB BAGIAN PENANDAAN BAHAN PENGEMAS'>SUB BAGIAN PENANDAAN BAHAN PENGEMAS</option>
			<option value='PABRIK PLANT BANJARAN'>PABRIK PLANT BANJARAN</option>
			<option value='PABRIK PLANT Banjaran'>PABRIK PLANT Banjaran</option>
		</select>
		</div></div>


 <div class="control-group">
    	<label class="control-label" for="bagian">Bagian/Unit Sementara</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span9"  name="bagian3">
			<option value='<?=$e[cBagian3];?>' selected><?=$e[cBagian3];?></option>
					<option value='UNIT PLANT Banjaran'>UNIT PLANT Banjaran</option>
			<option value='SUB UNIT PEMASTIAN MUTU'>SUB UNIT PEMASTIAN MUTU</option>
			<option value='SUB UNIT PRODUKSI'>SUB UNIT PRODUKSI</option>
			<option value='BAGIAN PEMBELIAN'>BAGIAN PEMBELIAN</option>
			<option value='BAGIAN PENGAWASAN MUTU'>BAGIAN PENGAWASAN MUTU</option>
			<option value='BAGIAN TEKNIK & PEMELIHARAAN' >BAGIAN TEKNIK & PEMELIHARAAN</option>
			<option value='BAGIAN AKUNTANSI & SDM'>BAGIAN AKUNTANSI & SDM</option>
			<option value='BAGIAN UMUM & K3L'>BAGIAN UMUM & K3L</option>
			<option value='BAGIAN PRODUKSI I'>BAGIAN PRODUKSI I</option>
			<option value='BAGIAN PRODUKSI II'>BAGIAN PRODUKSI II</option>
			<option value='BAGIAN PENGEMASAN'>BAGIAN PENGEMASAN</option>
			<option value='BAGIAN PENGEMBANGAN PRODUK'>BAGIAN PENGEMBANGAN PRODUK</option>
			<option value='BAGIAN SISTEM MUTU'>BAGIAN SISTEM MUTU</option>
			<option value='BAGIAN PENGENDALIAN PROSES PRODUKSI'>BAGIAN PENGENDALIAN PROSES PRODUKSI</option>
			<option value='BAGIAN PENYIMPANAN'>BAGIAN PENYIMPANAN</option>
			<option value='PABRIK PLANT BANJARAN'>PABRIK PLANT BANJARAN</option>
			<option value='PABRIK PLANT Banjaran'>PABRIK PLANT Banjaran</option>
		</select>
		</div></div>

   
    
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
}elseif($_GET[act]=="mutasi"){
?>
<div class="block-content collapse in">
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>NPP</th>
			<th>Nama</th>
			<th>Status</th>
			<th>Sub Bagian</th>
			<th>Bag. Sementara</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$pegawai = mysql_query("SELECT * FROM pegawai WHERE cBagian!=cSub2");
		while($s = mysql_fetch_array($pegawai)) {
		 if ($s[cBagian]!=$s[cSub2]){
			echo "<tr class=success>";
		 }
		 else {
		     echo "<tr>";
		 }
		    
		echo "	<td>$s[cNPP]</td>
                <td>$s[cNama]</td>
                <td>$s[cStatus]</td>
                <td>$s[cBagian]</td>
                <td>$s[cSub2]</td>
				<td class='center'>";
                echo "<a href='include/pegawai/aksi_pegawai.php?act=hapus&id=$s[cId]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=pegawai&act=edit&id=$s[cId]'><i class='icon-edit'></i>";
				echo "
				</td>
				</tr>";	
		}
	?>
	</tbody>
</table>
</div>
</div>   
<?
}else{
?>
<div class="block-content collapse in">
<div class="span12">
	<button class="btn-info btn-large" onclick="window.location.href='?pages=pegawai&act=tambah'">Tambah Pegawai</button>
    <br /><br />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14">
	<thead>
		<tr>
			<th>NPP</th>
			<th>Nama</th>
			<th>Status</th>
			<th>Sub Bagian</th>
			<th>Bagian</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$pegawai = mysql_query("SELECT * FROM pegawai");
		while($s = mysql_fetch_array($pegawai)) {
		 if ($s[cBagian]!=$s[cSub2]){
			echo "<tr class=success>";
		 }
		 else {
		     echo "<tr>";
		 }
		    
		echo "	<td>$s[cNPP]</td>
                <td>$s[cNama]</td>
                <td>$s[cStatus]</td>
                <td>$s[cBagian]</td>
                <td>$s[cBagian2]</td>
				<td class='center'>";
                echo "<a href='include/pegawai/aksi_pegawai.php?act=hapus&id=$s[cId]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a> 
				<a href='?pages=pegawai&act=edit&id=$s[cId]'><i class='icon-edit'></i>";
				echo "
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
