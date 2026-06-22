<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Mutasi Pegawai Sementara</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="tambah2"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
$tgl2			 = date("d-m-Y");

$tglindo         = tgl_indo3($_POST[tgl]);

$tanggal = $_POST[tgl];
$day = date('D', strtotime($tanggal));
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

$query = "SELECT max(sinmr) as max_no FROM minter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("P-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>

<form method="post" action="include/minter/aksi_minter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Permohonan Mutasi Sementara (Form 2 dari 2)</legend>
<b>KETERANGAN :</b>Permohonan mutasi dibuat sebelum pegawai dipindahkan, pegawai tidak boleh di pindahkan apabila belum ada persetujuan dari manajemen<br>

<?
if($_SESSION[levelcv]==0){
?>
  <div class="control-group">
		<label class="control-label" for="ns">Nomor Permohonan </label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<? echo "$newID" ?>"></div>
    </div>
  <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" required="required"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
            <select id="pengirim" class="chzn-select" name="pengirim" >
            	<option>Pilih User</option>
            	<?php
					$cv = mysql_query("SELECT cId, cNama FROM users");
					while ($dcv=mysql_fetch_array($cv)){
	    		     	echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				?>
           	</select>
        </div> 
    </div>
	 <div class="control-group">
    	<label class="control-label" for="pengirim1">Minta acc atasan?</label>
        <div class="controls">
            <select id="pengirim1" class="chzn-select" name="pengirim1">
            	<option value='ya'>Ya, minta acc dulu atasan-nya</option>
            	<option value='tidak' selected>Tidak</option>
           	</select>
        </div> 
    </div>
	 <div class="control-group">
    	<label class="control-label" for="pengirim2">Minta acc atasan level 2?</label>
        <div class="controls">
            <select id="pengirim2" class="chzn-select" name="pengirim2">
            	<option value='ya'>Ya, minta acc dulu atasan level 2</option>
            	<option value='tidak' selected>Tidak</option>
           	</select>
        </div> 
    </div>
<?
}
else
{
?>	
	 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>

   <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan (ACC)</label>
        <div class="controls">
		1. <select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
		 <br>	
		 2. <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));
			echo "
			<option value='$_SESSION[cv]' selected>Pilih Atasan Level 2!</option>
			<option value='$e[cId]' selected>$e[cNama]</option>
			<option value='$_SESSION[cv]'>$_SESSION[namacv]</option>
			<option value='$ef[cId]'>$ef[cNama]</option>
		</select> <b><font color=red>Jika anda Asman, Pilih anda kembali atau atasan anda !</font></b>";
         ?> 
		 <br>
		 3. <select id="pengirim2" class="chzn-select" name="pengirim2" required="required">
		     <option value='<? echo"$_SESSION[cv]";?>' selected>Pilih Atasan Pegawai</option>
			<?
			$e = mysql_query("SELECT * FROM users WHERE idj='5' OR idj='3' OR idj='4' OR idj='2' ");
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cIdjab]</option>";
			}
		echo"</select><b><font color=red> Pilih Asman atau Manager terkait pegawai untuk ACC mutasi ini!</font></b>";
	?>

        </div> 
    </div>

<?    
        
    }
?>

    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="Hidden" name="perihal" required="required" Value="Permohonan Mutasi Pegawai Sementara ke : <? echo "$_POST[sub]";?>"><b>Permohonan Mutasi Pegawai Sementara ke : <? echo "$_POST[sub]";?></b></div>
    </div>
  
Lengkapi/Edit (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste) :

        	<textarea name="ket" id="editor" required="required">
        	    Dengan ini mengajukan permohonan mutasi pegawai sementara sebagai berikut : <br>


<table border="1" cellpadding="1" cellspacing="1" width=100%>
	<tbody>
		<tr>
			<td style="text-align:center"><b>No</b></td>
			<td style="text-align:center"><b>NPP</b></td>
			<td style="text-align:center"><b>Nama Pegawai</b></td>
			<td style="text-align:center"><b>Gol</b></td>
			<td style="text-align:center"><b>Lokasi Awal</b></td>
			<td style="text-align:center"><b>Lokasi Sebelumnya</b></td>
			<td style="text-align:center"><b>Pindah ke Bagian</b></td>
		</tr>
			<?
			$e = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p1]'"));
			?>
		<tr>
			<td>1.</td>
			<td><? echo"$e[cNPP]";?></td>
			<td><? echo"$e[cNama]";?></td>
			<td><? echo"$e[cStatus]";?></td>
			<td><? echo"$e[cBagian]";?></td>
			<td><? echo"$e[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>


		</tr>
		<?
		if ($_POST[p2]=='')
		{} else {
			$e2 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p2]'"));
			?>
		<tr>
			<td>2.</td>
			<td><? echo"$e2[cNPP]";?></td>
			<td><? echo"$e2[cNama]";?></td>
			<td><? echo"$e2[cStatus]";?></td>
			<td><? echo"$e2[cBagian]";?></td>
			<td><? echo"$e2[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		<?
		}
		if ($_POST[p3]=='')
		{} else {
			$e3 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p3]'"));
			?>
		<tr>
			<td>3.</td>
			<td><? echo"$e3[cNPP]";?></td>
			<td><? echo"$e3[cNama]";?></td>
			<td><? echo"$e3[cStatus]";?></td>
			<td><? echo"$e3[cBagian]";?></td>
			<td><? echo"$e3[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p4]=='')
		{} else {
			$e4 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p4]'"));
			?>
		<tr>
			<td>4.</td>
			<td><? echo"$e4[cNPP]";?></td>
			<td><? echo"$e4[cNama]";?></td>
			<td><? echo"$e4[cStatus]";?></td>
			<td><? echo"$e4[cBagian]";?></td>
			<td><? echo"$e4[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p5]=='')
		{} else {
			$e5 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p5]'"));
			?>
		<tr>
			<td>5.</td>
			<td><? echo"$e5[cNPP]";?></td>
			<td><? echo"$e5[cNama]";?></td>
			<td><? echo"$e5[cStatus]";?></td>
			<td><? echo"$e5[cBagian]";?></td>
			<td><? echo"$e5[cSub2]";?></td>	
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p6]=='')
		{} else {
			$e6 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p6]'"));
			?>
		<tr>
			<td>6.</td>
			<td><? echo"$e6[cNPP]";?></td>
			<td><? echo"$e6[cNama]";?></td>
			<td><? echo"$e6[cStatus]";?></td>
			<td><? echo"$e6[cBagian]";?></td>
			<td><? echo"$e6[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p7]=='')
		{} else {
			$e7 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p7]'"));
			?>
		<tr>
			<td>7.</td>
			<td><? echo"$e7[cNPP]";?></td>
			<td><? echo"$e7[cNama]";?></td>
			<td><? echo"$e7[cStatus]";?></td>
			<td><? echo"$e7[cBagian]";?></td>
			<td><? echo"$e7[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p8]=='')
		{} else {
			$e8 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p8]'"));
			?>
		<tr>
			<td>8.</td>
			<td><? echo"$e8[cNPP]";?></td>
			<td><? echo"$e8[cNama]";?></td>
			<td><? echo"$e8[cStatus]";?></td>
			<td><? echo"$e8[cBagian]";?></td>
			<td><? echo"$e8[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p9]=='')
		{} else {
			$e9 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p9]'"));
			?>
		<tr>
			<td>9.</td>
			<td><? echo"$e9[cNPP]";?></td>
			<td><? echo"$e9[cNama]";?></td>
			<td><? echo"$e9[cStatus]";?></td>
			<td><? echo"$e9[cBagian]";?></td>
			<td><? echo"$e9[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p10]=='')
		{} else {
			$e10 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p10]'"));
			?>
		<tr>
			<td>10.</td>
			<td><? echo"$e10[cNPP]";?></td>
			<td><? echo"$e10[cNama]";?></td>
			<td><? echo"$e10[cStatus]";?></td>
			<td><? echo"$e10[cBagian]";?></td>
			<td><? echo"$e10[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p11]=='')
		{} else {
			$e11 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p11]'"));
			?>
		<tr>
			<td>11.</td>
			<td><? echo"$e11[cNPP]";?></td><td><? echo"$e11[cNama]";?></td>
			<td><? echo"$e11[cStatus]";?></td>
			<td><? echo"$e11[cBagian]";?></td>
			<td><? echo"$e11[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		<?
		}
		if ($_POST[p12]=='')
		{} else {
			$e12 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p12]'"));
			?>
		<tr>
			<td>12.</td>
			<td><? echo"$e12[cNPP]";?></td><td><? echo"$e12[cNama]";?></td>
			<td><? echo"$e12[cStatus]";?></td>
			<td><? echo"$e12[cBagian]";?></td>
			<td><? echo"$e12[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
			<td></td>
		</tr>
		<?
		}
		if ($_POST[p13]=='')
		{} else {
			$e13 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p13]'"));
			?>
		<tr>
			<td>13.</td>
			<td><? echo"$e13[cNPP]";?></td><td><? echo"$e13[cNama]";?></td>
			<td><? echo"$e13[cStatus]";?></td>
			<td><? echo"$e13[cBagian]";?></td>
			<td><? echo"$e13[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p14]=='')
		{} else {
			$e14 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p14]'"));
			?>
		<tr>
			<td>14.</td>
			<td><? echo"$e14[cNPP]";?></td><td><? echo"$e14[cNama]";?></td>
			<td><? echo"$e14[cStatus]";?></td>
			<td><? echo"$e14[cBagian]";?></td>
			<td><? echo"$e14[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p15]=='')
		{} else {
			$e15 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p15]'"));
			?>
		<tr>
			<td>15.</td>
			<td><? echo"$e15[cNPP]";?></td><td><? echo"$e15[cNama]";?></td>
			<td><? echo"$e15[cStatus]";?></td>
			<td><? echo"$e15[cBagian]";?></td>
			<td><? echo"$e15[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p16]=='')
		{} else {
			$e16 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p16]'"));
			?>
		<tr>
			<td>16.</td>
			<td><? echo"$e16[cNPP]";?></td><td><? echo"$e16[cNama]";?></td>
			<td><? echo"$e16[cStatus]";?></td>
			<td><? echo"$e16[cBagian]";?></td>
			<td><? echo"$e16[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p17]=='')
		{} else {
			$e17 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p17]'"));
			?>
		<tr>
			<td>17.</td>
			<td><? echo"$e17[cNPP]";?></td><td><? echo"$e17[cNama]";?></td>
			<td><? echo"$e17[cStatus]";?></td>
			<td><? echo"$e17[cBagian]";?></td>
			<td><? echo"$e17[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p18]=='')
		{} else {
			$e18 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p18]'"));
			?>
		<tr>
			<td>18.</td>
			<td><? echo"$e18[cNPP]";?></td><td><? echo"$e18[cNama]";?></td>
			<td><? echo"$e18[cStatus]";?></td>
			<td><? echo"$e18[cBagian]";?></td>
			<td><? echo"$e18[cSub2]";?></td>	
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p19]=='')
		{} else {
			$e19 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p19]'"));
			?>
		<tr>
			<td>19.</td>
			<td><? echo"$e19[cNPP]";?></td><td><? echo"$e19[cNama]";?></td>
			<td><? echo"$e19[cStatus]";?></td>
			<td><? echo"$e19[cBagian]";?></td>
			<td><? echo"$e19[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p20]=='')
		{} else {
			$e20 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p20]'"));
			?>
		<tr>
			<td>20.</td>
			<td><? echo"$e20[cNPP]";?></td><td><? echo"$e20[cNama]";?></td>
			<td><? echo"$e20[cStatus]";?></td>
			<td><? echo"$e20[cBagian]";?></td>
			<td><? echo"$e20[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
				<?
		}
		if ($_POST[p21]=='')
		{} else {
			$e21 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p21]'"));
			?>
		<tr>
			<td>21.</td>
			<td><? echo"$e21[cNPP]";?></td><td><? echo"$e21[cNama]";?></td>
			<td><? echo"$e21[cStatus]";?></td>
			<td><? echo"$e21[cBagian]";?></td>
			<td><? echo"$e21[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		<?
		}
		if ($_POST[p22]=='')
		{} else {
			$e22 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p22]'"));
			?>
		<tr>
			<td>22.</td>
			<td><? echo"$e22[cNPP]";?></td><td><? echo"$e22[cNama]";?></td>
			<td><? echo"$e22[cStatus]";?></td>
			<td><? echo"$e22[cBagian]";?></td>
			<td><? echo"$e22[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		<?
		}
		if ($_POST[p23]=='')
		{} else {
			$e23 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p23]'"));
			?>
		<tr>
			<td>23.</td>
			<td><? echo"$e23[cNPP]";?></td><td><? echo"$e23[cNama]";?></td>
			<td><? echo"$e23[cStatus]";?></td>
			<td><? echo"$e23[cBagian]";?></td>
			<td><? echo"$e23[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p24]=='')
		{} else {
			$e24 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p24]'"));
			?>
		<tr>
			<td>24.</td>
			<td><? echo"$e24[cNPP]";?></td><td><? echo"$e24[cNama]";?></td>
			<td><? echo"$e24[cStatus]";?></td>
			<td><? echo"$e24[cBagian]";?></td>
			<td><? echo"$e24[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p25]=='')
		{} else {
			$e25 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p25]'"));
			?>
		<tr>
			<td>25.</td>
			<td><? echo"$e25[cNPP]";?></td><td><? echo"$e25[cNama]";?></td>
			<td><? echo"$e25[cStatus]";?></td>
			<td><? echo"$e25[cBagian]";?></td>
			<td><? echo"$e25[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p26]=='')
		{} else {
			$e26 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p26]'"));
			?>
		<tr>
			<td>26.</td>
			<td><? echo"$e26[cNPP]";?></td><td><? echo"$e26[cNama]";?></td>
			<td><? echo"$e26[cStatus]";?></td>
			<td><? echo"$e26[cBagian]";?></td>
			<td><? echo"$e26[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p27]=='')
		{} else {
			$e27 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p27]'"));
			?>
		<tr>
			<td>27.</td>
			<td><? echo"$e27[cNPP]";?></td><td><? echo"$e27[cNama]";?></td>
			<td><? echo"$e27[cStatus]";?></td>
			<td><? echo"$e27[cBagian]";?></td>
			<td><? echo"$e27[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p28]=='')
		{} else {
			$e28 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p28]'"));
			?>
		<tr>
			<td>28.</td>
			<td><? echo"$e28[cNPP]";?></td><td><? echo"$e28[cNama]";?></td>
			<td><? echo"$e28[cStatus]";?></td>
			<td><? echo"$e28[cBagian]";?></td>
			<td><? echo"$e28[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p29]=='')
		{} else {
			$e29 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p29]'"));
			?>
		<tr>
			<td>29.</td>
			<td><? echo"$e29[cNPP]";?></td><td><? echo"$e29[cNama]";?></td>
			<td><? echo"$e29[cStatus]";?></td>
			<td><? echo"$e29[cBagian]";?></td>
			<td><? echo"$e29[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		
			<?
		}
		if ($_POST[p30]=='')
		{} else {
			$e30 = mysql_fetch_array(mysql_query("SELECT * FROM pegawai WHERE cId='$_POST[p30]'"));
			?>
		<tr>
			<td>30.</td>
			<td><? echo"$e30[cNPP]";?></td><td><? echo"$e30[cNama]";?></td>
			<td><? echo"$e30[cStatus]";?></td>
			<td><? echo"$e30[cBagian]";?></td>
			<td><? echo"$e30[cSub2]";?></td>
			<td><? echo"$_POST[sub]";?></td>
		</tr>
		<? } ?>
	</tbody>
</table>
<br>
Mutasi sementara dari tanggal <? echo tgl_indo($_POST[tgl_mulai]); ?> sampai dengan <? echo tgl_indo($_POST[tgl_selesai]); ?>
<br>
Atas perhatiannya kami ucapkan terima kasih.<br>
<b>
	</textarea>
<input type=hidden name=tgl_mulai value='<? echo"$_POST[tgl_mulai]";?>'>
<input type=hidden name=tgl_selesai value='<? echo"$_POST[tgl_selesai]";?>'>
<input type=hidden name=sub value='<? echo"$_POST[sub]";?>'>
<input type=hidden name=bagian value='<? echo"$_POST[bagian]";?>'>
<input type=hidden name=p1 value='<? echo"$_POST[p1]";?>'>
<input type=hidden name=p2 value='<? echo"$_POST[p2]";?>'>
<input type=hidden name=p3 value='<? echo"$_POST[p3]";?>'>
<input type=hidden name=p4 value='<? echo"$_POST[p4]";?>'>
<input type=hidden name=p5 value='<? echo"$_POST[p5]";?>'>
<input type=hidden name=p6 value='<? echo"$_POST[p6]";?>'>
<input type=hidden name=p7 value='<? echo"$_POST[p7]";?>'>
<input type=hidden name=p8 value='<? echo"$_POST[p8]";?>'>
<input type=hidden name=p9 value='<? echo"$_POST[p9]";?>'>
<input type=hidden name=p10 value='<? echo"$_POST[p10]";?>'>
<input type=hidden name=p11 value='<? echo"$_POST[p11]";?>'>
<input type=hidden name=p12 value='<? echo"$_POST[p12]";?>'>
<input type=hidden name=p13 value='<? echo"$_POST[p13]";?>'>
<input type=hidden name=p14 value='<? echo"$_POST[p14]";?>'>
<input type=hidden name=p15 value='<? echo"$_POST[p15]";?>'>
<input type=hidden name=p16 value='<? echo"$_POST[p16]";?>'>
<input type=hidden name=p17 value='<? echo"$_POST[p17]";?>'>
<input type=hidden name=p18 value='<? echo"$_POST[p18]";?>'>
<input type=hidden name=p19 value='<? echo"$_POST[p19]";?>'>
<input type=hidden name=p20 value='<? echo"$_POST[p20]";?>'>
<input type=hidden name=p21 value='<? echo"$_POST[p21]";?>'>
<input type=hidden name=p22 value='<? echo"$_POST[p22]";?>'>
<input type=hidden name=p23 value='<? echo"$_POST[p23]";?>'>
<input type=hidden name=p24 value='<? echo"$_POST[p24]";?>'>
<input type=hidden name=p25 value='<? echo"$_POST[p25]";?>'>
<input type=hidden name=p26 value='<? echo"$_POST[p26]";?>'>
<input type=hidden name=p27 value='<? echo"$_POST[p27]";?>'>
<input type=hidden name=p28 value='<? echo"$_POST[p28]";?>'>
<input type=hidden name=p29 value='<? echo"$_POST[p29]";?>'>
<input type=hidden name=p30 value='<? echo"$_POST[p30]";?>'>

    <div class="control-group">
		<label class="control-label" for="komentar">Catatan</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="sikomen"></div>
    </div>
   	
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

<?
}
elseif($_GET[act]=="tambah"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(sinmr) as max_no FROM minter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("M-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="home.php?pages=minter&act=tambah2" enctype="multipart/form-data" class="form-horizontal" >

<fieldset>
<legend>Buat Permohonan Mutasi Pegawai Sementara</legend>


    <center><b>Pilih pindah ke Sub Bagian & Bagian mana kemudian pilih pegawai-pegawai-nya.</b><br>Bila pindah ke sub bagian pilih sub & bagian-nya, bila pindah ke bagian pilih kedua-nya bagian</center><br>
    
       <div class="control-group">
    	<label class="control-label" for="bagian">Pindah ke (Pilih Sub/Bagian/Unit)</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span7"  name="sub" required="required">
			<option value='' selected>Pilih Unit/ Bagian/ Sub Bagian</option>
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
		</select>
		
		</div></div>
		
		    <div class="control-group">
    	<label class="control-label" for="bagian">Pindah ke (Pilih Bagian/Unit)</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span7"  name="bagian" required>
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
		</select>
		
		</div></div>
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Mulai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl_mulai" required="required"></div>
    </div>
    
       <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl_selesai" required="required"></div>
    </div>
    
    
	<div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 1</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p1">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
    
    
    <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 2</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p2">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
    <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 3</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p3">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 4</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p4">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 5</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p5">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
    
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 6</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p6">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 7</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p7">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 8</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p8">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 9</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p9">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 10</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p10">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
    
 		<div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 11</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p11">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 12</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p12">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
   
    
    
    <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 13</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p13">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 14</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p14">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
 
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 15</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p15">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 16</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p16">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
 
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 17</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p17">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 18</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p18">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 19</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p19">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 20</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p20">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
 
    
    
    		<div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 21</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p21">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    
    <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 22</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p22">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>

    
    
    <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 23</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p23">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>

    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 24</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p24">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>

    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 25</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p25">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>

    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 26</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p26">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
  
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 27</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p27">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
 
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 28</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p28">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>

    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 29</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p29">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>
 
    
     <div class="control-group">
    	<label class="control-label" for="pegawai">Pegawai 30</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p30">
            <option value=''>Pilih Nama - Bagian</option>
	<?
			$e = mysql_query("SELECT * FROM pegawai order BY cBagian ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[cId]'>$ec[cNama] - $ec[cBagian] ($ec[cStatus])</option>";
			}
    ?>
    	</select>
    </div></div>

    
           <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Lanjut</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM minter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM minter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/minter/aksi_minter.php?act=edit&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Permohonan Mutasi Sementara</legend>
	<?
if($_SESSION[levelcv]<1){
?>
    <div class="control-group">
		<label class="control-label" for="ns">Nomor</label>
        <div class="controls"><input class="input-medium focused" id="ns" type="text" name="nomor" value="<?=$e[sinmr];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?=$e[sitgl];?>" required="required"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="pengirim">Tandatangan 1</label>
        <div class="controls">
          	 <select id="pengirim" class="chzn-select span9" name="pengirim" required="required">
            	<option>Pilih Pengirim 1</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim]'"));
				echo"<option value='$e[sipengirim]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="pengirim2">Tandatangan 2</label>
        <div class="controls">
          	 <select id="pengirim2" class="chzn-select span9" name="pengirim2" required="required">
            	<option>Pilih Pengirim 2</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim1]'"));
				echo"<option value='$e[sipengirim1]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
    	<label class="control-label" for="pengirim2">Tandatangan 3</label>
        <div class="controls">
          	 <select id="pengirim2" class="chzn-select span9" name="pengirim3" required="required">
            	<option>Pilih Pengirim 3</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim2]'"));
				echo"<option value='$e[sipengirim2]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    
    	<div class="control-group">
    	<label class="control-label" for="pengirim3">Tandatangan 4</label>
        <div class="controls">
          	 <select id="pengirim2" class="chzn-select span9" name="pengirim3" required="required">
            	<option>Pilih Pengirim 4</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[sipengirim3]'"));
				echo"<option value='$e[sipengirim3]' selected>$v[cNama] - $v[cIdjab]</option>";
				$vc = mysql_query("SELECT * FROM users ORDER BY cId ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] - $dvc[cIdjab]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
    
    <div class="control-group">
    	<label class="control-label" for="status">Status</label>
        <div class="controls">
          	 <select id="status" class="chzn-select span9" name="status" required="required">
            	<option>Pilih Status Terkirim</option>
				
            <?php
            if ($e[sstatus]=='Y') {
				echo"<option value='Y' selected>Terkirim</option>
				<option value='N'>Belum Terkirim</option>
				";
				}
				else {
				echo"<option value='Y'>Terkirim</option>
				<option value='N' selected>Belum Terkirim</option>
				";	
				}?>
           	</select>
        </div> 
	</div>
    
    

<?
}
else
{
?>	
<input type=hidden name=pengirim value=<?=$e[sipengirim];?>>
<input type=hidden name=pengirim2 value=<?=$e[sipengirim1];?>>
<input type=hidden name=pengirim3 value=<?=$e[sipengirim2];?>>
<input type=hidden name=pengirim4 value=<?=$e[sipengirim3];?>>
<input type=hidden name=status value=<?=$e[sstatus];?>>
<input class="input-medium focused" id="ns" type="hidden" name="nomor" value="<?=$e[sinmr];?>">
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input type="hidden" name="tgl" value="<?=$e[sitgl];?>" required="required"><? echo tgl_indo($e[sitgl]); ?></div>
    </div>

<?
}
?>

    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<?=$e[siperihal];?>"></div>
    </div>

 Isi permohonan (Tekan Shift+Enter untuk pindah baris)

		   <textarea name="ket" id="editor"><?=$e[siket];?></textarea>
<br>
  <div class="control-group">
		<label class="control-label" for="komentar">Catatan Konseptor</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="sikomen" value="<?=$e[sikomen];?>"></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="komentar2"><font color=red>Catatan Atasan</font></label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar2" type="text" name="sikomen2" value="<?=$e[sikomen2];?>"></div>
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
}elseif($_GET[act]=="balas"){
    
$e = mysql_fetch_array(mysql_query("SELECT * FROM minter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM minter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));

$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/minter/aksi_minter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Balas Memo</legend>
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls">
		 <?  echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?> </div>
    </div>
 <div class="control-group">
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		<select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
		 <br><br>
		 <b>Jika memo/undangan atas nama <u>atasan langsung</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$e[cId]' >$e[cNama]</option>
		</select>";
         ?> 
		 <br>
		 <b>Jika memo/undangan atas nama <u>atasan langsung Level 2</u> anda, maka harus di-Koreksi,ACC dahulu :<br></b>	
		 <select id="pengirim2" class="chzn-select" name="pengirim2">
			<?
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));			
			
			echo "
			<option value='tidak' selected>Pilih Atasan Langsung!</option>
			<option value='$ef[cId]' >$ef[cNama]</option>
		</select><br>Abaikan/jangan dipilih atasan langsung jika memo dari atas nama anda sendiri/ anda sebagai Pgs.";
         ?> 
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenismemo">Jenis Memo/Undangan</label>
        <div class="controls">
          	 <select id="jenisms" name="jenisms" required="required" class="chzn-select span8">
            	<option value=0>Pilih/Cari Jenis Memo/Surat</option>
            <?php
				$vc = mysql_query("SELECT kode_jms, nama_jms FROM jenisms ORDER BY kode_jms ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[kode_jms]'>$dvc[nama_jms]</option>";
				}
			?>
           	</select>
        </div> 
	</div>
<? $e = mysql_fetch_array(mysql_query("SELECT * FROM minter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM minter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="text" name="perihal" value="<? echo" Balas : $e[siperihal]";?>"></div>
    </div>
    <div class="control-group">
    	<label class="control-label" for="ket">Isi Memo/Undangan</label>
        <div class="controls">
		   <textarea name="ket" id="editor"><br><? $sitgl=tgl_indo($e[sitgl]); echo" Berdasar Memo tanggal : $sitgl dari $ef[cIdjab] nomor : $e[sinmr] dengan isi memo : <br><blockquote>$e[siket]</blockquote>";?></textarea>
        </div>
    </div>
    
      <div class="control-group">
		<label class="control-label" for="komentar">Catatan Konseptor</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="sikomen"></div>
    </div>
    
 	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
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
}elseif($_GET[act]=="lp"){
?>


<form method="post" action="include/minter/aksi_minter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>List Penerima (Kepada & Tembusan) Memo Internal</legend>
	<div class="control-group">
    	<label class="control-label" for="msin">Penerima Memo (Kepada)</label>
        <div class="controls">
        	<select multiple="multiple" id="msin" name="msin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM msin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM msin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="msin">Penerima Tembusan</label>
        <div class="controls">
        	<select multiple="multiple" id="tsin" name="tsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
        </div> 
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

<? if($_SESSION[levelcv]==0){
    ?>

<form method="post" action="include/minter/aksi_minter.php?act=lpadmin&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah List Penerima (Kepada & Tembusan) Memo Internal (hapus dulu yang ada)</legend>
	<div class="control-group">
    	<label class="control-label" for="msin">Penerima Memo (Kepada)</label>
        <div class="controls">
        	<select multiple="multiple" id="msin" name="msin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM msin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM msin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			
<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
			
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="msin">Penerima Tembusan</label>
        <div class="controls">
        	<select multiple="multiple" id="tsin" name="tsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM tsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				?>                             
            </select>
			<button type="button" class="chosen-toggle select">Pilih Semua</button>
<button type="button" class="chosen-toggle deselect">Hapus Semua</button>
        </div> 
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<? } ?>
<br>

   <br>
	<b><u>Keterangan Lainnya :</u></b><br>
	1. Jika akan pilih semua klik tombol "Pilih Semua".<br><br>
	2. Jika akan menghapus semua yang telah dipilih klik tombol "Hapus Semua"<br><br>
	3. Jika akan memilih grup bagian, kode untuk membantu pencarian :<br><br>
	- <b>PM</b> (Para Manager)<br>
	- <b>AM.</b> (Para Asman)<br>
	- <b>DPP</b> (Jajaran Pengendalian Proses Produksi AKA PPC)<br>
	- <b>GD</b> (Jajaran Penyimpanan/Pergudangan)<br>
	- <b>SPG</b> (Sub Bagian Pengadaan)<br>
	- <b>QA</b> (Asman dan Supervisor Fungsional Pemastian Mutu)<br>
	- <b>QC</b> (Jajaran Asman Pengawasan Mutu-QC)<br>
	- <b>SM</b> (Jajaran Sistem Mutu)<br>
	- <b>PP</b> (Jajaran Pengembangan Produk)<br>
	- <b>P1</b> (Jajaran Produksi 1)<br>
	- <b>P2</b> (Jajaran Produksi 2)<br>
	- <b>P3</b> (Jajaran Produksi 3)<br>
	- <b>SDMA</b> (Jajaran SDM & Akuntansi)<br>
	- <b>UK3L</b> (Jajaran Umum & K3L)<br>
	- <b>TP</b> (Jajaran Teknik & Pemeliharaan)<br>
<br>
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM minter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM minter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM minter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
    $efghi = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM minter a,users b WHERE a.sipengirim3=b.cId AND a.siid='$_GET[id]'"));

	?>
<strong>
<legend>Detail Permohonanan Mutasi Pegawai Sementara</legend>
<table width="100%" border=1>
	<tr><td width="24%">Nomor </td><td>: <?=$e[sinmr];?></td></tr>
    <tr><td>Tanggal </td><td>: <?=tgl_indo($e[sitgl]);?> - Jam : <?=$e[sijam];?></td></tr>
    <tr><td>Perihal</td><td>: <?=$e[siperihal];?></td></tr>
	<tr><td>Konsep permohonan dari</td><td>: <strong><?=$ef[cNama];?> (<?=$ef[cIdjab];?>)</strong></td></tr>
    <tr><td>Yang Bertanda Tangan1</td><td>: <strong><?=$e[cNama];?> (<?=$e[cIdjab];?>)</strong></td></tr>
    <tr><td>Yang Bertanda Tangan2</td><td>: <strong><?=$efgh[cNama];?> (<?=$efgh[cIdjab];?>)</strong></td></tr>
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
	</table>
	<br></strong>
	<table width="100%">
    <tr><td align=top><b>Isi permohonan :</b></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
</table>

<br />
<legend>Kepada :</legend>
<table class="table table-bordered table-striped" width="100%">
<thead>
	<td width="30%">User</td>
    <td>Nama</td>
	<td>Tanggal Dibaca</td>
</thead>
<?php
	$psn = mysql_query("SELECT a.cUser,a.cNama,a.cIdjab, a.cFoto, a.cJabatan,b.tgl_baca FROM users a
						LEFT JOIN msin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM msin WHERE siid='$_GET[id]'");
	while ($t=mysql_fetch_array($psn)){
		$j++;
		if ($t[cFoto]==""){
			$foto = "foto/none.jpg";
		}else{
			$foto = "foto/$t[cFoto]";
		}
		
		echo "<tr>
				<td>$t[cJabatan]</td>
				<td>
					<img src='$foto' style='width: 60px; height: 60px;' class='tooltip-right' data-original-title='$t[cNama]'>
					$t[cNama] ($t[cJabatan])
				</td>
				<td>";if ($t[tgl_baca]==0000-00-00) { echo "Belum";} else { echo tgl_indo($t[tgl_baca]); };echo"</td>
			 </tr>";
	}
	?>
</table>
<br />


<br>
<br><br>
<? echo"<a href='home1.php?pages=minter&act=print&id=$e[siid]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<?
}else{
?>
<div>
<div class="span12">

	<button class="btn-info btn-large" onclick="window.location.href='?pages=minter&act=tambah'">Buat Mutasi Sementara</button><br /><br />


	<?php
	if($_SESSION[levelcv]==0){
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM minter a, users b");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Dibuat/ ACC</th>
			<th>Perihal Mutasi Sementara</th>
            <th>Penerima</th>
			<th>Status</th>
            <th class='center'>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
		<?
		while($s = mysql_fetch_array($smasuk)) {
		echo "<tr>
				<td>";echo tgl_indo($s[sitgl]);echo"</td>
                <td>$s[cNama]</td>
                <td>$s[siperihal]</td>
				<td><a href='?pages=minter&act=lp&id=$s[siid]' class='btn btn-info'>List</a></td>";
				if ($s[sstatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' title=DetailMemo> Detail</a>
				</td>
				</tr>";	
		}
	}
	else {
	$smasuk = mysql_query("SELECT * FROM minter WHERE sipengirim='$_SESSION[cv]' OR sipengirim1='$_SESSION[cv]' OR sipengirim2='$_SESSION[cv]' ORDER BY sitgl DESC");

     ?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tanggal</th>
			<th>Perihal</th>
			<th>Status</th>
            <th class='center' width=25%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?
	
		while($s = mysql_fetch_array($smasuk)) {
		        
			if ($s[sstatus]=='N' AND $s[sikomen2]==''){
			echo "<tr class=success>";
				echo "  <td>$s[sstatus]</td><td>";
				echo tgl_indo($s[sitgl]);echo"</td>
                <td>$s[siperihal]</td>";
			}
			elseif ($s[sstatus]=='N' AND $s[sikomen2]!=''){
		echo "<tr>";    
		echo "  <td><font color=red>$s[sstatus]</font></td><td>";
		echo tgl_indo($s[sitgl]);echo"</td>
                <td><font color=red>$s[siperihal]</font></td>";
			
		}else{
			echo "<tr>";
				echo "  <td>$s[sstatus]</td><td>";
				echo tgl_indo($s[sitgl]);echo"</td>
                <td>$s[siperihal]</td>";
		}
	
				if ($s[sstatus]=='N'){
					if ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/minter/aksi_minter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC dan lanjut ke Atasan??')\" class='btn btn-info'>ACC</a><br><br><a href='include/minter/aksi_minter.php?act=acc33&id=$s[siid]' onClick=\"return confirm('Yakin akan mengembalikan e-mutasi ini??')\" class='btn btn-info'>Return</a></td>
			<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]' class='btn btn-info'>Edit</a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><a href='include/minter/aksi_minter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC dan lanjut ke Pengesahan berikutnya??')\" class='btn btn-info'>ACC!</a></td>
			<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]' class='btn btn-info'>Edit</a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			
					elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' AND $s[accsipengirim2]=='N')
					{
		echo "<td><a href='include/minter/aksi_minter.php?act=acc&id=$s[siid]&p1=$s[sipengirim]&p2=$s[sipengirim1]' onClick=\"return confirm('Yakin akan ACC ini??')\" class='btn btn-info'>ACC/Kirim!</a><br><br><a href='include/minter/aksi_minter.php?act=acc33&id=$s[siid]' onClick=\"return confirm('Yakin akan mengembalikan e-mutasi ini??')\" class='btn btn-info'>Return</a></td>
			<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N')
					{
			echo "<td><b>Belum ACC Asman</b></td>
			<td class='center'><a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
						elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' AND $s[accsipengirim2]=='N')
					{
			echo "<td><b>Belum ACC Manager</b></td>
			<td class='center'><a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim]==$_SESSION[cv] AND $s[accsipengirim1]=='N' AND $s[accsipengirim2]=='N')
					{
			echo "<td><b>Belum Selesai ACC</b></td>
			<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]' class='btn btn-info'>Edit</a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='Y' AND $s[accsipengirim2]=='N')
					{
            echo "<td><a href='include/minter/aksi_minter.php?act=acc&id=$s[siid]&p1=$s[sipengirim]&p2=$s[sipengirim1]' onClick=\"return confirm('Yakin akan ACC Mutasi ini??')\" class='btn btn-info'>ACC/Kirim!</a><br><br><a href='include/minter/aksi_minter.php?act=acc33&id=$s[siid]' onClick=\"return confirm('Yakin akan mengembalikan e-mutasi ini??')\" class='btn btn-info'>Return</a></td>
			<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim3]==$_SESSION[cv] AND $s[accsipengirim2]=='Y')
					{
			echo "<td><a href='include/minter/aksi_minter.php?act=acc&id=$s[siid]&p1=$s[sipengirim]&p2=$s[sipengirim1]' onClick=\"return confirm('Yakin akan ACC Mutasi ini??')\" class='btn btn-info'>ACC/Kirim!</a><br><br><a href='include/minter/aksi_minter.php?act=acc33&id=$s[siid]' onClick=\"return confirm('Yakin akan mengembalikan e-mutasi ini??')\" class='btn btn-info'>Return</a></td>
			<td class='center'><a href='include/minter/aksi_minter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=minter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					else {
						if ($s[sipengirim]==$s[sipengirim1] AND $s[accsipengirim2]=='Y') {
			echo "<td>
			<b>Belum ACC PPIC</b>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum Selesai ACC</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}	else{
			echo "<td><b>Terkirim</b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=minter&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>
				</td>
				</tr>";	
	}
	}
	}
	?>
	</tbody>
</table>

<br><br>
	<span class="label label-info">
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>KONSEP MUTASI SEMENTARA BELUM TERKIRIM/ACC!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail Mutasi Sementara,<br>
	Cara Koreksi/EDIT dan Lihat Komentar Konseptor/ atasan yaitu dengan Klik <u>TOMBOL Koreksi/Komen</u> di kolom Penerima dan Aksi,<br> 
	Untuk ACC atau Kirim Permohonan Mutasi Sementara Klik Link di kolom Status : <u>ACC/KIRIM !</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->