<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Permohonan ATK yang Masuk</font></div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="detail"){
    $e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM linter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM linter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM linter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
    $efghi = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.cJabatan FROM linter a,users b WHERE a.sipengirim3=b.cId AND a.siid='$_GET[id]'"));
if ($e[cFoto]==""){
	$foto = "foto/none.jpg";
}else{
	$foto = "foto/$e[cFoto]";
}
?>

<strong>
<legend>Detail Permohonan ATK</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?> - Jam : <?=$e[sijam];?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
	<tr><td>Konsep dari</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cIdjab];?>)</strong></td></tr>
    <tr><td>Yang Bertanda Tangan1</td><td>: <strong><?=$e[cNama];?> (<?=$e[cIdjab];?>)</strong></td></tr>
    <tr><td>Yang Bertanda Tangan2</td><td>: <strong><?=$efgh[cNama];?> (<?=$efgh[cIdjab];?>)</strong></td></tr>
    <tr><td>Lampiran</td><td>: <a title="Lampiran" href="linternal/<?=$e[sifile];?>">Klik Disini (Jika Ada)</td></tr>
	<tr><td>Status</td><td>: <strong>
	
<?
if ($e[sstatus]=='N')
{
	echo"Belum Terkirim (ACC TTD Ke-1 = $e[accsipengirim1], ACC TTD ke-2 = $e[accsipengirim2])";
}
else
{
	echo"Terkirim";
}
?>
	</strong></td></tr>
	<tr><td colspan=2>
	    <? echo"<tr><td colspan='2'><br><a href='home.php?pages=linter&act=detail&id=$e[siid]' class='btn btn-info'>Klik Lihat Detail & Print Permohonan ATK</a>";
	
	$ds = mysql_query("SELECT * FROM lisposisi WHERE siid='$e[siid]' AND dPendisposisi='$_SESSION[cv]'");
				$jr = mysql_num_rows($ds);
				
					if ($jr<1){
						echo "";
					}else{
						echo "";
					}
	?>
	    
	    </td>
	</tr>
	</table>
	<br></strong>
	<table width="100%">
    <tr><td align=top><b>Isi Permohonan ATK :</b></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
    <tr><td>Keterangan : <?=$e[sikomen];?></td></tr>
</table>

<br>
<?php	
$tgl_sekarang = date("Y-m-d");
$baca = mysql_fetch_array(mysql_query("SELECT * FROM lsin WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'"));
if ($baca[tgl_baca]=='0000-00-00') {
mysql_query("UPDATE lsin SET tgl_baca='$tgl_sekarang', sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
}
elseif  ($baca[tgl_baca]!='0000-00-00' AND $baca[sistatus]=='N') {
mysql_query("UPDATE lsin SET sistatus='Y' WHERE siid='$_GET[id]' AND cId='$_SESSION[cv]'");
}

$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM lisposisi a 
									LEFT JOIN ldis b ON a.siid=b.siid 
									LEFT JOIN users c ON b.pid=c.cId 
									LEFT JOIN linter d ON a.siid=d.siid
									WHERE b.cId='$_SESSION[cv]' AND pdid=$_GET[pdid] AND a.siid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));
$edf = mysql_fetch_array(mysql_query("SELECT * FROM lisposisi WHERE dPendisposisi='$_SESSION[cv]' AND siid='$_GET[id]'"));

$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dldisposisi FROM lisposisi a WHERE a.siid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

$pds0 = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ldis a WHERE a.siid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");

$jds0 = mysql_num_rows($pds0);

if ($jds0>0){ ?>

<!-- isi disposisi-->
<legend>Verifikasi No :<? echo"$edf[dNoagenda],"; ?>  oleh : <? echo"$_SESSION[namacv] - $_SESSION[idjab]"; ?></legend>
<table class="table table-bordered" border=1 width="100%">
<thead>
    <td width=10%><b>Kepada</b></td>
	<td><b>Isi Hasil</td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab 
					FROM ldis a WHERE a.siid='$_GET[id]' AND a.pId='$_SESSION[cv]' ORDER BY a.pdid DESC");
//$pds = mysql_query("SELECT a.cUser, a.cNama, b.psACC, b.psTglbaca FROM users a LEFT JOIN ldis b ON b.cId=a.cId WHERE b.siid='$_GET[id]'");

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
				
				<td>$t[kepada] ($t[kepadajab])<br><b>Tgl Disp :</b> $tglDis <br>  <b>Tgl Baca :</b> $tglBaca</td>
				<td>$t[pInstruksi]</td>
			 </tr>";
	}else{
		echo "<tr class='info'>
            	<td>$t[kepada] ($t[kepadajab])<br><b>Tgl Disp :</b> $tglDis <br>  <b>Tgl Baca :</b> $tglBaca</td>
				<td>$t[pInstruksi]</td>
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

$query = "SELECT max(dNoagenda) as max_no FROM lisposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/linter/aksi_linter.php?act=tambahdisp&siid=<?=$siid;?>" class="form-horizontal">
<fieldset>
<legend>Buat Disposisi/ Verifikasi</legend>
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
		/*$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM lsin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	*/
			echo "<input type=hidden name=pendisposisi value=$_SESSION[cv]><b>$_SESSION[namacv]</b>
			<input type=hidden name=siid value=$siid>";
		}
		
		
		?>
           	</select>
        </div>
    </div>
<? 
	$e = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$siid'"));	

?>
<input type=hidden name=sbnjrn value=<? echo"$e[sbnjrn]"; ?>>
<b>Isi Verifikasi</b><br>
<textarea name="isi" id="editor"><? echo"$e[siket]"; ?></textarea>
<? /*
<table border=0>
    <tr>
        <td width=65% valign=top><? echo"$e[siket]"; ?>
        <b>Keterangan Tambahan Lainnya :</b><br><textarea name="isi"></textarea></td>
        <td width=35% valign=top>
        <p>Jika tidak jadi beri keterangan</p>
        <table border=1>
            <tr>
                <td><b>No.</b></td>
                <td><b><center>Selesai Pukul</center></b></td>
                <td><b><center>Hasil yang dikerjakan</center></b></td>
            </tr>
            <tr>
                <td><input class="input-small focused" type="text" name="n1" value="1. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j1"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t1"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n2" value="2. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j2"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t2"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n3" value="3. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j3"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t3"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n4" value="4. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j4"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t4"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n5" value="5. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j5"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t5"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n6" value="6. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j6"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t6"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n7" value="7. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j7"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t7"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n8" value="8. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j8"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t8"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n9" value="9. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j9"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t9"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n10" value="10. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j10"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t10"><br></td>
            </tr>
                        <tr>
                <td><input class="input-small focused" type="text" name="n11" value="11. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j11"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t11"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n12" value="12. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j12"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t12"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n13" value="13. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j13"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t13"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n14" value="14. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j14"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t14"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n15" value="15. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j15"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t15"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n16" value="16. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j16"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t16"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n17" value="17. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j17"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t17"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n18" value="18. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j18"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t18"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n19" value="19. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j19"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t19"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n20" value="20. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j20"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t20"><br></td>
            </tr>
                        <tr>
                <td><input class="input-small focused" type="text" name="n21" value="21. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j21"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t21"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n22" value="22. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j22"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t22"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n23" value="23. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j23"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t23"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n24" value="24. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j24"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t24"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n25" value="25. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j25"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t25"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n26" value="26. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j26"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t26"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n27" value="27. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j27"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t27"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n28" value="28. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j28"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t28"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n29" value="29. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j29"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t29"><br></td>
            </tr>
              <tr>
                <td><input class="input-small focused" type="text" name="n30" value="30. "></td>
                <td><input class="input-small focused" id="jam" type="text" name="j30"><br></td>
                <td><input class="input-medium focused" id="tugas" type="text" name="t30"><br></td>
            </tr>
        </table>
       
        </td>
    </tr>
    </table>
			
     <br>
*/
?>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM lisposisi WHERE siid='$_GET[id]'"));
$siid = $e['siid'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoagenda) as max_no FROM lisposisi WHERE dNoagenda LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("D-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/linter/aksi_linter.php?act=editdisp&siid=<?=$siid;?>" enctype="multipart/form-data" class="form-horizontal">
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
	
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM lisposisi a,users b WHERE a.dpendisposisi=b.cId AND a.siid='$_GET[id]'"));
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
			$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM lsin a,users b WHERE a.cId=b.cId AND a.siid='$_GET[id]'"));	
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
    	<label class="control-label" for="ldis">Diteruskan Kepada</label>
        <div class="controls">
        	<select multiple="multiple" id="ldis" name="ldis[]" class="chzn-select span4">
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
<div>
<div class="span12">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th width=1%></th>
			<th width=8%>Tanggal</th>
			<th width=5%>Nomor</th>
			<th>Perihal</th>
			<th width=10%>Tgl baca</th>
			<th width=5%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$smasuk = mysql_query("SELECT a.*,b.*,c.cIdjab, c.cJabatan FROM linter a LEFT JOIN lsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' ORDER BY a.sitgl DESC");
			
		while($s = mysql_fetch_array($smasuk)) {
		if ($s[sistatus]!='Y'){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
		echo"<td>$s[sistatus]</td>";
		echo"<td width=5%>";echo tgl_indo($s[sitgl]);echo"</td>
				<td width=5%><font size=1>$s[sinmr]</font></td>
				
				<td>$s[siperihal]</td><td width=10%>";
			
                
                if ($s[tgl_baca]==0000-00-00) { echo "Belum dibaca, klik Baca!";} else { echo tgl_indo($s[tgl_baca]); }
				echo"</td>
				<td width=5%><a href='home.php?pages=usrl&act=detail&id=$s[siid]' title=DetailMemo class='btn btn-info'>Baca!</a></td>
				</tr>";	
		
		}
	?>
	</tbody>
	</table>
	
	<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna HIJAU = <strong>BELUM TERBACA OLEH ANDA PERMOHONAN ATK</strong><br>
	Klik 'BACA!' untuk konfirmasi Telah Dibaca, melihat detail dan balas serta buat/tambah disposisi.
	</h5>
	</span>
</div>
</div>

<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->