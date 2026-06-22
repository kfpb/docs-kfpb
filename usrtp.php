<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

<head>
<!--    <link href="https://thread.ekfpb.com/spawn.css" rel="stylesheet" type="text/css">-->
<!--<script src="https://thread.ekfpb.com/spawn.min.js"></script>-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 19%;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  left: 50%;
  top: 50%;
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>SPPTek Masuk untuk Teknik Pemeliharaan</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM spptek a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM spptek a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<? //echo"<a href='home1.php?pages=usrtp&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<strong>
<legend>Detail SPPTek</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
    <tr><td>Jenis Memo </td><td>: <?=$efg[nama_jms];?></td></tr>
    <tr><td>Jenis SPPTek </td><td>: <?=$e[jenispptek];?></td></tr>
    <!--<tr><td>Perihal</td><td>: <?php //echo $e[siperihal];?></td></tr>-->
    <tr><td>Keluhan</td><td>: <?=$e[keluhan];?></td></tr>
    <tr><td>Penyebab </td><td>: <?=$e[penyebab];?></td></tr>
    <tr><td>Tindakan Perbaikan </td><td>: <?=$e[tindakan_perbaikan];?></td></tr>
    <tr><td>Tindakan Pencegahan </td><td>: <?=$e[tindakan_pencegahan];?></td></tr>
    <tr><td>Personil</td><td>: <?=$e[personil];?></td></tr>
    <tr><td>Pihak ke-3? </td><td>: <?=$e[pihak3];?> (Jika dikerjakan pihak ke-3)</td></tr>    
    <tr><td>Work Permit K3L? </td><td>: <?=$e[wp];?> (Jika diperlukan work permit K3L)</td></tr> 
    <tr><td>Dicek oleh</td><td>: <?=$e[siket_teknik];?></td></tr>   
    <tr><td>Tanggal Cek </td><td>: <?=tgl_indo($e[sitgl_cek]);?></td></tr>
    <tr><td>Tanggal Mulai </td><td>: <?=tgl_indo($e[sitgl_mulai]);?> (atau mulai barang datang)</td></tr>
    <tr><td>Tanggal Selesai </td><td>: <?=tgl_indo($e[sitgl_selesai]);?></td></tr>
    <tr><td>Tanggal Pending </td><td>: <?=tgl_indo($e[sitgl_pending]);?></td></tr>
    <tr><td>Tanggal Buat Order </td><td>: <?=tgl_indo($e[sitgl_order]);?> (jika ada)</td></tr>
    <tr><td>Tanggal Datang Barang </td><td>: <?=tgl_indo($e[sitgl_brgdtg]);?> (jika ada)</td></tr>
    <tr><td>Tindakan Perbaikan Oleh Teknik </td><td>: <?=$e[tindakan_perbaikan];?></td></tr>
    <tr><td>Tindakan Pencegahan </td><td>: <?=$e[tindakan_pencegahan];?></td></tr>
    <tr><td>Kode PR </td><td>: <?=$e[pr];?></td></tr>
    <tr><td>Kode RFQ </td><td>: <?=$e[kode_rfq];?></td></tr>
    <tr><td>Kode PO </td><td>: <?=$e[po];?></td></tr>
    <tr><td>Kode DO </td><td>: <?=$e[kode_do];?></td></tr>
    <tr><td>Kode GR/Entry Sheet </td><td>: <?=$e[gr_entrysheet];?></td></tr>
    <tr><td>Progress/Keterangan/Rework : </td><td>: <?=$e[sikomen2];?></td></tr>
    <tr><td>Keterangan User : </td><td>: <?=$e[siket_user];?></td></tr>
	<tr><td>Lampiran</td><td>: <a title="Lampiran" href="sinternal/<?=$e[sifile];?>">Klik Disini (Jika Ada)
	<br>
	<?php if($e[sifile] != null){?>
	<img src="sinternal/<?=$e[sifile];?>" alt="lampiran" width="150" height="150">
	<?php } ?>
	</td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cJabatan];?>)/ <?=$e[cNama];?> (<?=$e[cJabatan];?>)</strong></td></tr>
	</table>
	<br></strong>
	<table width="100%">
	    <tr>
	        <!--<td>-->
	            <?php
            // $user = mysql_fetch_array(mysql_query(
            //     sprintf("SELECT cSession AS session FROM users WHERE cUser = '%s' LIMIT 1", $_SESSION['nppcv'])
            // ));
            ?>
                <!--<button-->
                <!--    spawner-->
                <!--    scheme="https"-->
                <!--    host="thread.ekfpb.com"-->
                <!--    user="<?=$user['session']?>"-->
                <!--    app="teknik"-->
                <!--    test-->
                <!--    foreign="<?=$_GET['id']?>"-->
                <!--    style="background-color: rgb(6 182 212); border: none; border-radius: 0.375rem; padding: 0.75rem 0.75rem; font-size: 0.875rem; line-height: 1.25rem; color: white; transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 300ms; text-transform: uppercase; font-weight: 600; cursor: pointer;">-->
                <!--        Diskusi-->
                <!--</button>-->
                <!--</td>-->
	<? echo"<td colspan='2'><br><a href='home.php?pages=sintertp&act=detail&id=$e[siid]' class='btn btn-info'>Klik Lihat Detail Penerima!</a> 
	<a href='sinternal/$e[sifile]' class='btn btn-info'>Klik Untuk Lihat Lampiran!</a>
	<a href='?pages=sintertp&act=balas&id=$e[siid]'' class='btn btn-info'>Klik untuk Balas Memo!</a>"; 
	
	$ds = mysql_query("SELECT * FROM disposisi WHERE siid='$e[siid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo " <a href='?pages=usrtp&act=tambahdisp&id=$e[siid]' class='btn btn-info'>Buat Disposisi ke User</a>";
					}else{
						echo " <a href='?pages=usrtp&act=editdisp&id=$e[siid]' class='btn btn-info'>Tambah Disposisi ke User</i>";
					}
	?>
	<? if ($e[lokasi]=='-' OR $e[lokasi]!=''){
$lokasi = mysql_fetch_array(mysql_query("SELECT * FROM area WHERE nomor_area='$e[lokasi]'"));
$aktiva = mysql_fetch_array(mysql_query("SELECT * FROM aktiva WHERE aknomor='$e[aktiva]'"));
?>
	</td></tr>
	<b>No Aktiva</b> : <? echo"$aktiva[aknomor]"; ?><br>
<b>Nama Aktiva</b> : <? echo"$e[aktiva] - $aktiva[aknama] "; ?><br>
<b>Lokasi</b> : <? echo"$e[lokasi] - $lokasi[nama_area] "; ?><br>
<? } ?>
<br>
<b>Keluhan :</b> <?=$e[keluhan];?><br>
<b>Personil yang bisa dihubungi :</b> <?=$e[personil];?><br><br>

<?php //echo $e[siket];?></td></tr>

</table>
<br>
<?php	
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM pstek WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'"));
    if ($baca[tgl_baca]=='0000-00-00') {
        mysql_query("UPDATE pstek SET tgl_baca='$tgl_sekarang' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
    }elseif  ($baca[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
        mysql_query("UPDATE pstek SET WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
    }

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi a 
									LEFT JOIN pdis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN spptek d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE dPendisposisi='$_SESSION[cv]' AND siid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPdisposisi FROM disposisi a WHERE a.siid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM pdis a WHERE a.siid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>History Disposisi No :<? echo"$edf[dNoagenda],"; ?>  oleh : <? echo"$_SESSION[namacv] - $_SESSION[idjab]"; ?></legend>
<?
echo"Lampiran Disposisi : <a href='disposisi/$edf[disfile]'>klik disini (jika ada)</a>";
?>
<table class="table table-bordered" border=1 width="100%">
<thead>
	<td width=12%><b>Tgl Disposisi</b></td>
    <td width=10%><b>Kepada</b></td>
	<td><b>Instruksi/Info</td>
	<td><b>Jawaban/Info</b></td>
	<td width=12%><b>Status</b></td> 
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM pdis a WHERE a.siid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN pdis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

while ($t=mysql_fetch_array($pds)){
	$tglBaca = tgl_indo($t[psTglbaca]);
	$tglSelesai = tgl_indo($t[psTglselesai]);
	$tglDis = tgl_indo($t[ptgl]);
	$tgltarget = tgl_indo($t[ptgls]);
	if ($t[psTglbaca]=="0000-00-00"){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=="0000-00-00"){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Selesai:<br></b> $tglSelesai</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br><b>Target Slesai :</b><br> $tgltarget</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]</td>
				<td>$t[info]Lampiran : <a href='jwb_disp/$t[filedis]'>Jika ada Klik disini</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Selesai:<br></b> $tglSelesai</td>
			 </tr>";
	}
}
?>
</table>

<!-- /isi disposisi-->
<?



}
}
//batas dari disposisi.php
elseif($_GET[act]=="tambahdisp"){
$siid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/spptek/aksi_sinter.php?act=tambahdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Disposisi</legend>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noagenda" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php
	if($_SESSION[levelcv]==0){
	?>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
	<? } else {	 ?>
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
	<? } ?>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
		<?php
		
		if($_SESSION[levelcv]==0){
		            echo "<select id='pendisposisi' class='chzn-select' name='pendisposisi'>";
            
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
					}else{
						echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				}
			
		}
		else {
		/*$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	*/
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<option value="A">Rutin</option>
                <option value="B">Cito</option>
                <option value="C">Rahasia</option>
            </select>
		</div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima disposisi harus jawab</option>
                <option value="N">Tidak, penerima disposisi tidak perlu jawab</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span6">
             	<?php
				$cv = mysql_query("SELECT cId, bagian, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select><br>*Bisa Pilih Grup Seperti Penerima Memo/Undangan
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
			<textarea name="isi" id="editor"></textarea>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran (Jika ada)</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="editdisp"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM disposisi WHERE siid='$_GET[id]'"));
$siid = $e['siid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM disposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/spptek/aksi_sinter.php?act=editdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Disposisi</legend>
<?php
	if($_SESSION[levelcv]==0){
	?>
	<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="text" name="noagenda" value="$newID" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
		
		<?php
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM disposisi a,users b WHERE a.dpendisposisi=b.cId AND a.siid='$_GET[id]'"));
			?>
					
			<select id="pendisposisi" class="chzn-select" name="pendisposisi">
            <?php
				echo "<option value=$e[dpendisposisi] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
				echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				}
			?>
           	</select>
        </div> 
    </div>
	<?
		}      
		
		else { ?>
			<div class="control-group">
		<label class="control-label" for="noagenda">Nomor Agenda</label>
        <div class="controls">
		<? echo"<input type=hidden name='noagenda' value='$e[dNoagenda]'><b>$e[dNoagenda]</b>";  ?>
		</div>
    </div>
	
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
     <div class="control-group">
		<label class="control-label" for="tgls">Target Tanggal Penyelesaian</label>
        <div class="controls"><input class="input-small datepicker" id="tgls" type="text" name="tgls"> *Jika Perlu</div>
    </div>
	    <div class="control-group">
		<label class="control-label" for="pendisposisi">Pendisposisi</label>
        <div class="controls">
	<?
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM pstek a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			?>
           	</select></div></div>
   
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="chzn-select span4">
            	<?php
				$sft = Array("A"=>"Rutin","B"=>"Cito","C"=>"Rahasia");
				foreach($sft as $v=>$t){
					if ($e[dSifat]==$v){
						echo "<option value='$v' selected>$t</option>";
					}else{
						echo "<option value='$v'>$t</option>";
					}
				}
				?>
            </select>
		</div>
    </div>
    	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima disposisi harus jawab</option>
                <option value="N">Tidak, penerima disposisi tidak perlu jawab</option>
            </select>
		</div>
    </div>
     <div class="control-group">
    	<label class="control-label" for="pdis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="pdis" name="pdis[]" class="chzn-select span4">
             	<?php
				
				$cv = mysql_query("SELECT cId, bagian, cNama, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>*Bisa Pilih Grup Seperti Penerima Memo/Undangan
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instruksi/Informasi (Tekan Shift+Enter untuk pindah baris)</label>
        <div class="controls">
        	<textarea name="isi" id="isi" class="input-large textarea" style="width: 610px; height: 100px"></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<!-- batas dari disposisi.php -->


<?
}

else{
?>
<div>
<div class="span12">
    <form method="post" action='home1.php?pages=usrtpp' target=_blank>
        
        <select class="chzn-select span5" name="jenispptek">
          	 <option value='ALL' selected>Silahkan Pilih Jenis SPPTek</option>  
          	    <option value='ALL'>Semua Teknik</option> 
			    <option value='APL'>Alat Produksi & Lab (APL)</option>   
                <option value='MP'>Mesin Produksi (MP)</option>  
                <option value='LAK'>Listrik Arus Kuat (LAK)</option>
                <option value='LAL'>Listrik Arus Lemah (LAL)</option>
                <option value='GTK'>Gudang Teknik & Kompressor (GTK)</option>
                <option value='SB'>Sipil Bangunan (SB)</option>
                <option value='BS'>Perbaikan Boiler & Steam (BS)</option>
                <option value='STUDC'>Sistem Tata Udara & Dust Collector (STUDC)</option>
                <option value='PA'>Pengolahan Air (PA)</option>
                <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	
        </select>
        <div class="control-group">
    		<label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
            <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Export" />
    </form>
    <hr>
    
    <form method="post" action='home.php?pages=usrtp'>
  
        <div class="control-group">
		<label class="control-label" for="lokasi2">Cari Jenis SPPTek</label>
            <div class="controls">
                    <select class="chzn-select span5" name="jenispptek">
                          	 <option value='' selected>Pilih Jenis SPPTek</option>  
                          	    <option value='ALL'>Semua Teknik</option> 
                			    <option value='APL'>Alat Produksi & Lab (APL)</option>   
                                <option value='MP'>Mesin Produksi (MP)</option>  
                                <option value='LAK'>Listrik Arus Kuat (LAK)</option>
                                <option value='LAL'>Listrik Arus Lemah (LAL)</option>
                                <option value='GTK'>Gudang Teknik & Kompressor (GTK)</option>
                                <option value='SB'>Sipil Bangunan (SB)</option>
                                <option value='BS'>Perbaikan Boiler & Steam (BS)</option>
                                <option value='STUDC'>Sistem Tata Udara & Dust Collector (STUDC)</option>
                                <option value='PA'>Pengolahan Air (PA)</option>
                                <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	
                        </select>
                    </div>
                </div>
              
        
        <input class="btn btn-primary" type="submit" value="Cari" />
    </form>
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Informasi SPPTek</font></div>
        </div>
        <?php 
            // $spptek_2021 = mysql_num_rows(mysql_query("SELECT a.* FROM sinter a WHERE a.sitgl>'2021-01-01' && a.sitgl<'2021-12-31' && b.cId='80' && a.sstatus='Y' && a.jenisms = 20")); 
            // $spptek_2022 = mysql_num_rows(mysql_query("SELECT a.* FROM sinter a WHERE a.sitgl>'2022-01-01' && a.sitgl<'2022-12-31' && b.cId='80' && a.sstatus='Y' && a.jenisms = 20")); 
            // $spptek_2023 = mysql_num_rows(mysql_query("SELECT a.* FROM sinter a WHERE a.sitgl>'2023-01-01' && a.sitgl<'2023-12-31' && b.cId='80' && a.sstatus='Y' && a.jenisms = 20")); 
            
            
            $spptek_2021 = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && a.jenisms= 20 && a.sitgl>'2021-01-01' && a.sitgl<'2021-12-31' GROUP BY a.siid"));
            $spptek_2022 = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && a.jenisms= 20 && a.sitgl>'2022-01-01' && a.sitgl<'2022-12-31' GROUP BY a.siid"));
            $spptek_2023 = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && a.jenisms= 20 && a.sitgl>'2023-01-01' && a.sitgl<'2023-12-31' GROUP BY a.siid"));
        ?>
        <div class="row-fluid">
        	<div class="span4">
        	<div class="block-content collapse in">
        		<div class="alert alert-block alert-error" style="padding: 10px 10px 8px 10px;">
        		<h4 class="alert-heading">Total SPPTek 2021</h4><hr />
            		<div style="padding:0px 10px 10px 10px;">
                		<center>
                		<h3><? echo"$spptek_2021"; ?></h3>
                    		<form method="post" action='home.php?pages=usrtp'>
                        		<input type="hidden" value="2021-01-01" name="blnn1"> 
                        		<input type="hidden" value="2021-12-31" name="blnn2">
                                <input class="btn btn-primary" type="submit" value="Lihat" />
                    		</form>
                		</center>
            		</div>
        		</div>
        	</div>
        	</div>
        	<div class="span4">
        	<div class="block-content collapse in">
        		<div class="alert alert-block alert-info" style="padding: 10px 10px 8px 10px;">
        		<h4 class="alert-heading">Total SPPTek 2022</h4><hr />
        		<div style="padding:0px 10px 10px 10px;">
        		<center>
        		<h3><? echo"$spptek_2022"; ?></h3>
        		    <form method="post" action='home.php?pages=usrtp'>
                        <input type="hidden" value="2022-01-01" name="blnn1"> 
                        <input type="hidden" value="2022-12-31" name="blnn2">
                        <input class="btn btn-primary" type="submit" value="Lihat" />
                	</form>
        		</center>
        		</div>
        		</div>
        	</div>
        	</div>
        	<div class="span4">
        	<div class="block-content collapse in">
        		<div class="alert alert-block alert-success" style="padding: 10px 10px 8px 10px;">
        		<h4 class="alert-heading">Total SPPTek 2023</h4><hr />
        		<div style="padding:0px 10px 10px 10px;">
        		<center>
        		<h3><? echo"$spptek_2023"; ?></h3>
        		<form method="post" action='home.php?pages=usrtp'>
                    <input type="hidden" value="2023-01-01" name="blnn1"> 
                	<input type="hidden" value="2023-12-31" name="blnn2">
                    <input class="btn btn-primary" type="submit" value="Lihat" />
                </form>
        		</center>
        		</div>
        		</div>
        	</div>
        	</div>
</div>
	<div style="width:auto;overflow-x:auto;">
	<table class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		    <th></th>
		    <!--<th>Status</th>-->
			<th>Tanggal</th>
			<th>Dari</th>
			<th>No Spptek & PR</th>
			<th style='width:220px; height:50px; display:inline-block !important;'>Keluhan</th>
			<th>Jenis SPPTek</th>
			<th>Aksi</th>
			<th>Status & Tgl Selesai</th>
			<th>Tgl Cek</th>
			<th>Tgl Mulai</th>

		</tr>
	</thead>
	<tbody>
 	<? 
 	$bulan1 = $_POST[blnn1];
    $bulan2 = $_POST[blnn2];
    
        if ($_SESSION[cv]=='10' or $_SESSION[cv]=='80' or $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13'  or $_SESSION[cv]=='14'  or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21'){
            
            if($_POST[jenispptek] == null && $_POST[blnn1] == null){
                $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && a.jenisms= 20 GROUP BY a.siid ORDER BY a.sitgl DESC, a.sinmr");
            }elseif($_POST[jenispptek] =='ALL'){
                $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 GROUP BY a.siid ORDER BY a.sitgl DESC, a.sinmr");
            }elseif($_POST[blnn1] != null){
                $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 && a.sitgl>'$_POST[blnn1]' && a.sitgl<'$_POST[blnn2]' GROUP BY a.siid ORDER BY a.sitgl DESC, a.sinmr");
            }else{
                $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 && a.jenispptek='$_POST[jenispptek]' GROUP BY a.siid ORDER BY a.sitgl DESC, a.sinmr");
            }
        }
        $i = 1;
		while($s = mysql_fetch_array($smasuk)) {
		   
		   $data = mysql_fetch_array(mysql_query("SELECT * FROM pesanan_barangtek WHERE id_spptek='$s[siid]'"));
		    
		if ($s[sinmr]==''){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}?>
		<td>
		    <?php echo $i ?>
		</td>
		<!--<td>-->
		    <!--<?php // echo $s[sistatus] ?>-->
		<!--</td>-->
		<td>
		    <?php echo tgl_indo($s[sitgl]) ?>
		</td>
		<? /*
		<td>
		    <?php echo tgl_indo8(date("m", strtotime($s[sitgl]))) ?>
		</td>
		<td>
		    <?php echo date("Y", strtotime($s[sitgl])) ?>
		</td>
		*/ ?>
		<td>
		    <?php echo $s[cJabatan] ?>
		</td>
		<td>
		        <?php echo"<a data-toggle='modal' data-id='$s[siid]' data-kode-id='$data[kode_barang]' data-nama-id='$data[nama]' data-satuan-id='$data[satuan]' data-jumlah-id='$data[jumlah]' data-keterangan-id='keterangan' data-status-id='$data[status]' title='Add this item' class='open-Dialog' href='#Dialog'>$s[sinmr]</a>"; ?>
		        <br>
		        No.PR : <?php echo $s[pr] ?>
				
		</td>
		<td>
		        <?php echo mb_strimwidth($s[keluhan], 0, 120, "..."); ?>
		    
		</td>
		<td>
		    <?php if($s[jenispptek] == null){ ?>
		        <form method="post" action="include/spptek/aksi_sinter.php?act=jenisspptek&id=<?=$s[siid];?>" enctype="multipart/form-data">
		            
                    <?php if($_SESSION['cv']=='11' OR $_SESSION['cv']=='17'){?>
                    	  <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>  
                    			    <option value=''>Tidak Jadi Memilih</option>   
                    			    <option value='APL'>Perbaikan Alat Produksi & Lab (APL)</option>   
                                    <option value='MP'>Perbaikan Mesin Produksi (MP)</option>  
                                    <option value='LAK'>Perbaikan Listrik Arus Kuat (LAK)</option>
                                    <option value='LAL'>Perbaikan Listrik Arus Lemah (LAL)</option>
                                    <option value='GTK'>Perbaikan Kompressor (GTK)</option>
                                    <option value='SB'>Perbaikan Sipil Bangunan (SB)</option>
                                    <option value='BS'>Perbaikan Boiler & Steam (BS)</option>
                                    <option value='STUDC'>Perbaikan Sistem Tata Udara & Dust Collector (STUDC)</option>
                                    <option value='PA'>Perbaikan Pengolahan Air (PA)</option>
                                    <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	
                                    <option value='SPV'>TEST USER</option>	
                               	</select>
                            </div> 
                    	</div>
                    	<?php }elseif($_SESSION['cv']=='12'){?>
                        <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
                    			    <option value=''>Tidak Jadi Memilih</option>   
                    			    <option value='APL'>Perbaikan Alat Produksi & Lab (APL)</option>
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='13'){?>
                        <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>  
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='MP'>Perbaikan Mesin Produksi (MP)</option>  
                                    	
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='14'){?>
                        <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option> 
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='LAL'>Perbaikan Listrik Arus Lemah (LAL)</option>	
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='15'){?>
                        <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='LAK'>Perbaikan Listrik Arus Kuat (LAK)</option>
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='16'){?>
                        <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='GTK'>Perbaikan Kompressor (GTK)</option>
                                    <option value='PBT'>Pembelian Barang Teknik (PBT)</option>	
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='18'){?>
                        <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='STUDC'>Perbaikan Sistem Tata Udara & Dust Collector (STUDC)</option>
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='19'){?>
                          <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option> 
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='BS'>Perbaikan Boiler & Steam (BS)</option>
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='20'){?>
                          <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='SB'>Perbaikan Sipil Bangunan (SB)</option>
                               	</select>
                            </div> 
                    	</div>
                        <?php }elseif($_SESSION['cv']=='21'){?>
                          <div class="control-group">
                        	<label class="control-label" for="status">Jenis SPPTek</label>
                            <div class="controls">
                              	 <select id="jenispptek" class="chzn-select span8" name="jenispptek" <?php echo $disable ?>>
                              	 <option value='<? echo"$e[jenispptek]";?>' selected><? echo"$e[jenispptek]"; ?></option>   
                    			    <option value=''>Tidak Jadi Memilih</option>   
                                    <option value='PA'>Perbaikan Pengolahan Air (PA)</option>
                               	</select>
                            </div> 
                    	</div>
                        <?php }?>
                        
                    <button class="btn btn-primary">Simpan</button> 
		        </form>
		   <?php }else{ ?>
		    <?php echo $s[jenispptek]; }?>
		    <br>
		</td>
		    </td>
		    <?
		            echo"
			<td width=5%><a href='home.php?pages=usrtp&act=detail&id=$s[siid]' class='btn btn-info'>Baca!</a><br><a href='home.php?pages=sintertp&act=edit&usr=admin&id=$s[siid]' class='btn btn-info'>Update</a>
				</td>
				";	
				?>

		<td>
		Status : <?php echo $s[sikomen2] ?>
	        <?php
	        if($s[sitgl_selesai] == '0000-00-00'){ ?>
	                <form method="post" action="include/spptek/aksi_sinter.php?act=closespptek&id=<?=$s[siid];?>" enctype="multipart/form-data">
                        <div class="control-group">
                            <div class="controls"><input type="date" class="input-small" id="sitgl_selesai" name="sitgl_selesai">
                            <button class="btn btn-primary">Close</button> 
                        </div>
                    </form></td>
            <?php	
                }else{
            	    echo"$s[sitgl_selesai]</td>";
            	}	?>	
            			<td>
		    <?php echo $s[sitgl_cek]?>
		</td>
		<td>
		    <?php echo $s[sitgl_mulai] ?>
		</td>
		<?php
		            echo"</tr>
				";	
	$i++;
	?>
		<?php		
		}
	?>
	</tbody>
	</table>
	</div>
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA OLEH ANDA SPPTek</strong><br>
	Klik 'BACA!' untuk konfirmasi Telah Dibaca, melihat detail dan balas serta buat/tambah disposisi untuk menanyakan apakah ada keluhan setelah perbaikan.<br>
	Jika perlu buat disposisi (instruksi/info) ke bagian lain (Bawahan, Sejajar, Atasan) Klik 'Buat/Tambah' Disposisi di Detail.
	</h5>
	</span>
</div>
</div>
                    <div class="modal hide" id="Dialog" role="dialog">
						<!--<div class="modal-dialog" role="document">-->
							<div class="modal-content" style="width:50%" >
								<div class="modal-header">
									<button class="close" data-dismiss="modal">×</button>
									<h4 class="modal-title" id="myModalLabel">Informasi Pemesanan Barang Teknik</h4>
								</div>
                                <table id="datatbl" style="width:100%" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody class="modal-body">
                                        
                                        <tr>
                                            <td colspan="1">#</td>
                                            <td colspan="1"><span id="kd"></span></td>
                                            <td colspan="1"><span id="namaId"></span></td>
                                            <td colspan="1"><span id="satuanId"></span></td>
                                            <td colspan="1"><span id="jumlahId"></span></td>
                                            <td colspan="1"><span id="keteranganId"></span></td>
                                            <td colspan="1"><span id="statusId"></span></td>
                                        </tr>
                                    </tbody>
        </table>
							    
							</div>
						<!--</div>-->
					</div>


<?php
$act=$_GET[act];
    if($act == 'tambahajax') {
        mysql_query("UPDATE spptek SET jenispptek = '$_GET[jenispptek]' WHERE siid = '30'");
        echo json_encode(['status' => 'sukses']);
    }
        
}
?>
</div><!--/span12-->
</div><!--/block-content-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>
$(document).ready(function () {
    $('#datatbl').DataTable();
});
$(document).on("click", ".open-Dialog", function () {
     var myBookId = $(this).data('id');
     var kodeId = $(this).data('kode-id');
     var namaId = $(this).data('nama-id');
     var satuanId = $(this).data('satuan-id');
     var jumlahId = $(this).data('jumlah-id');
     var keteranganId = $(this).data('keterangan-id');
     var statusId = $(this).data('status-id');
      $(".modal-body #bookId").html( myBookId );
      $(".modal-body #kd").html( kodeId );
      $(".modal-body #namaId").html( namaId );
      $(".modal-body #satuanId").html( satuanId );
      $(".modal-body #jumlahId").html( jumlahId );
      $(".modal-body #keteranganId").html( keteranganId );
      $(".modal-body #statusId").html( statusId );
     
});



  function simpans(e) {
      
    var jenispptek= $('#jenispptek').val();
    var siid= $('#siids').val();
    $.ajax({
		url: "https://ekfpb.com/bnj/coba/home.php?pages=usrtp&act=tambahajax&jenispptek="+ jenispptek +"&siid=" + siid,
		type: "POST",
		dataType: "json",
		data: {
            jenispptek: jenispptek,
        },
        contentType: "application/json;charset=utf-8",
        success: function(status) {
                            alert(msg.d);
                        },
                        error: function(result){ 
                            alert("error occured. Status:" + result.status  
                            + ' --Status Text:' + result.statusText 
                            + " --Error Result:" + result); 
                            location.reload();
                            return false;
                        }
                        
			});
  }


</script>