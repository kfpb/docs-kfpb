<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black></font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if($_GET[act]=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM sinter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM sinter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$e[jenisms]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>
<? echo"<a href='home1.php?pages=usrtp&act=detail&id=$_GET[id]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<strong>
<legend>Detail SPPTek</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?></td></tr>
	<tr><td>Dari</td><td>: <?=$ef[cJabatan];?> / <?=$e[cJabatan];?></td></tr>
	<tr><td>Kepada</td><td>: <? echo"$_SESSION[namacv]";?> (<? echo"$_SESSION[idjab]";?>)</td></tr>
    <tr><td>Jenis Memo </td><td>: <?=$efg[nama_jms];?></td></tr>
    <tr><td>Jenis SPPTek </td><td>: <?=$e[jenispptek];?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
    <tr><td>Tanggal Cek </td><td>: <?=tgl_indo($e[sitgl_cek]);?></td></tr>
    <tr><td>Tanggal Mulai (GR) </td><td>: <?=tgl_indo($e[sitgl_mulai]);?> (atau mulai barang datang)</td></tr>
    <tr><td>Tanggal Selesai </td><td>: <?=tgl_indo($e[sitgl_selesai]);?></td></tr>
    <tr><td>Yang Bertanda Tangan</td><td>: <strong><?=$ef[cNama];?> / <?=$e[cNama];?></strong></td></tr>
	</table>
	<br></strong>
	<table width="100%">
    <tr><td align=top><font color=blue><b>Isi SPPTek :</b></font></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
	<? echo"<tr><td colspan='2'><br><a href='home.php?pages=sintertp&act=detail&id=$e[siid]' class='btn btn-info'>Klik Lihat Detail Penerima!</a> 
	<a href='sinternal/$e[sifile]' class='btn btn-info'>Klik Untuk Lihat Lampiran!</a>";
	?>
	</td></tr>
</table>
<br>
<?php	
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM psin WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {
mysql_query("UPDATE psin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
mysql_query("UPDATE psin SET sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
}

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM disposisi a 
									LEFT JOIN pdis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN sinter d ON a.siid=d.siid
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
<form method="post" action="include/sinter/aksi_sinter.php?act=tambahdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
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
<form method="post" action="include/sinter/aksi_sinter.php?act=editdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
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
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM psin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	
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
}else{
?>
<!--<b>Keterangan = untuk menghapus kata "br" & "strong" di kolom keluhan, hilangkan masal dengan fungsi Replace setelah Export.</b><br><br>-->
<div>
<div class="span12">
    <?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_SPPTek.xls");


//echo cutText($text, 50, 1) . '...'; // Contoh script yang digunakan untuk memotong 50 hur...
//echo cutText($text, 50) . '...'; // Contoh script yang digunakan untuk memotong 50...
//echo cutText($text, 50, 3) . '...'; // Contoh script yang digunakan untuk memotong 50 huruf...

if ($_POST[jenispptek]=='ALL'){
        if ($_POST[blnn1]!=null){
        	$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 && a.sitgl>'$_POST[blnn1]' && a.sitgl<'$_POST[blnn2]' ORDER BY a.sitgl DESC");
        
        }else{
            $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 ORDER BY a.sitgl DESC");
            
        }
}elseif($_POST[jenispptek]== null){
        if ($_POST[blnn1]!=null){
        	$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 && a.sitgl>'$_POST[blnn1]' && a.sitgl<'$_POST[blnn2]' ORDER BY a.sitgl DESC");
        	
        }else{
            $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 ORDER BY a.sitgl DESC");
            
        }
}else{
    if($_POST[blnn1]!=null){
        $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab,pb.nama as nmsj c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId LEFT JOIN pesanan_barangtek pb ON a.siid=pb.id_spptek WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 && jenispptek='$_POST[jenispptek]' && a.sitgl>'$_POST[blnn1]' && a.sitgl<'$_POST[blnn2]' ORDER BY a.sitgl DESC");
       
    }else{
        $smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM spptek a LEFT JOIN pstek b ON a.siid=b.spptek_id LEFT JOIN users c ON a.sipengirim2=c.cId WHERE b.cId='80' && a.sstatus='Y' && jenisms = 20 && jenispptek='$_POST[jenispptek]' ORDER BY a.sitgl DESC");
        
    }
}

    ?>
	<table width="100%" border="1px">
	<thead>
		<tr>
		<th>No</th>
			<th>Tanggal Permohonan</th>
			<th >User/Pemohon</th>
			<th>No SPPTek</th>
			<!--<th>Jenis Memo</th>-->
			<th>Jenis SPPtek</th>
			<th>Bulan</th>
			<th>Tahun</th>
			<th>Keluhan</th>
			<th>Penyebab</th>
			<th>Tindakan Perbaikan</th>
			<th>Tindakan Pencegahan</th>
			<th>Kode Lokasi</th>
			<th>Nama Lokasi</th>
			<th>No Aktiva</th>
			<th>Nama Aktiva</th>
			<!--<th>Keluhan (Baru)</th>-->
			<th>Personil Yang Dihubungi</th>
        	<th>Di Cek Oleh</th>
			<!--<th>No Order</th>-->
			<!--<th>Keterangan</th>-->
			<th>Pihak ke-3?</th>
			<th>Kode PR</th>
			<th>Kode RFQ</th>
			<th>Kode PO</th>
			<th>Kode DO</th>
			<th>Kode GR/Entry Sheet</th>
			<th>Work Permit K3?</th>	
			<th>Tgl Cek</th>
			<th>Tgl Buat Order</th>
			<th>Nama Barang</th>
			<th>Tgl Barang Datang</th>
			<th>Tgl Mulai</th>
			<th>Tgl Slesai</th>
			<th>Tgl Rework</th>
            <th>Status</th>
		</tr>
	</thead>
	<tbody>

<?php

    	$no = 1;	
		while($s = mysql_fetch_array($smasuk)) {
		    $data_barang = mysql_query("SELECT a.siid,pb.* FROM spptek a LEFT JOIN pesanan_barangtek pb ON a.siid=pb.id_spptek WHERE a.siid='$s[siid]'");

	    $loc        = mysql_query("SELECT nama_area FROM area WHERE nomor_area='$s[lokasi]'");
        $loc2       = mysql_fetch_array($loc);
        $akt        = mysql_query("SELECT aknama FROM aktiva WHERE aknomor='$s[aktiva]'");
        $akt2       = mysql_fetch_array($akt);
        $kalimat    = "$s[siket]";
        $string     = "$s[siket]";
        $result     = preg_replace("/[^a-zA-Z0-9 ]/", " ", $string);
        $sub_kalimat = substr($result,27,175);
		?>
        		    </tr><td><?php echo $no; ?></td>
        		<td width=5%><?php echo tgl_indo3($s[sitgl]); ?></td>
				<td width=5%><?php echo $s[cJabatan]; ?></td>
				<td><font size=2><?php echo $s[sinmr] ?></font></td>
				<!--<td><font size=2><?php //echo $s[nama_jms] ?></font></td>-->
				<td><font size=2><?php echo $s[jenispptek] ?></font></td>
				<td><font size=2><?php echo tgl_indo8(date("m", strtotime($s[sitgl]))); ?></font></td>
				<td><font size=2><?php echo tgl_indo9($s[sitgl]); ?></font></td>
				<td><font size=2><?php echo $s[keluhan]; ?></font></td>
				<td><font size=2><?php echo $s[penyebab]; ?></font></td>
				<td><font size=2><?php echo $s[tindakan_perbaikan]; ?></font></td>
				<td><font size=2><?php echo $s[tindakan_pencegahan]; ?></font></td>
				
				<?php
			if ($loc2[nama_area]!='')
		       { ?>
				<td><?php echo $s[lokasi]; ?></td>
	     	    <td><?php echo $loc2[nama_area]; ?></td>
		       <?php
		       }
		       else
		       {?>
				<td></td>
	     	    <td><?php echo $s[lokasi]; ?></td>
		       <?php }
		       
			if ($akt2[aknama]!='')
		       {
		            ?>
				<td><?php echo $s[aktiva]; ?></td>
	     	    <td><?php echo $akt2[aknama]; ?></td>
		       <?php
		           
		       }
		       else
		       { ?>
				<td></td>
	     	    <td><?php echo $s[aktiva]; ?></td>
		      <?php }	?>
		       
				<td><?php echo $s[personil]; ?></td>
				<td><?php echo $s[siket_teknik]; ?></td>
				<!--<td><?php //echo $s[sikomen];?></td>-->
				<!--<td><?php //echo $s[siket];?></td>-->
				<td><?php echo $s[pihak3]; ?></td>
				<td><?php echo $s[pr]; ?></td>
				<td><?php echo $s[rfq]; ?></td>
				<td><?php echo $s[po]; ?></td>
				<td><?php echo $s[kode_do]; ?></td>
				<td><?php echo $s[gr_entrysheet]; ?></td>
				
				<td><?php echo $s[wp];?></td>
				<td><?php echo $s[sitgl_cek]; ?></td>
				<td><?php echo $s[sitgl_order]; ?></td>	
				<td>
            		<?php
            		    while($m = mysql_fetch_array($data_barang)) {
                    ?>
                		<b>Nama Barang</b> (<?php echo $m[nama]; ?>-;) <br>
                		<b>Kode Barang</b> (<?php echo $m[kode_barang]; ?>-;) <br>
                		<b>Jumlah Barang</b> (<?php echo $m[jumlah]; ?> <?php echo $m[satuan]; ?>-;) <br><br>
            		<?php 
            		    }
            		?>
        		</td>
				
				<td><?php echo $s[sitgl_brgdtg]; ?></td>
				<td><?php echo $s[sitgl_mulai]; ?></td>
				<td><?php echo $s[sitgl_selesai]; ?></td>
				<td><?php echo $s[sitgl_rework]; ?></td>	
				<td><?php echo $s[sikomen2]; ?></td>
				</tr>	
				<?php $no++;
		}
	    
	?>
	</tbody>
	</table>
	
	<br><br>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->