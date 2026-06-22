<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Permohonan ATK-RAB</div>
</div>
<div class="block-content collapse in">
<div class="span12">
<?php
if($_GET[act]=="tambah2"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$bln1			 = date("M-Y");
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

$query = "SELECT max(sinmr) as max_no FROM linter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("L-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/linter/aksi_linter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validasi_input(this)">

<fieldset>
<legend>Buat Permohonan ATK-RAB (Form 2 dari 2)</legend>

<?
if($_SESSION[levelcv]==1000){
?>
  <div class="control-group">
		<label class="control-label" for="ns">Nomor Permohonan ATK </label>
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
    	<label class="control-label" for="pengirim1">Minta acc atasan level 2?</label>
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
    	<label class="control-label" for="pengirim">Yang Bertanda Tangan</label>
        <div class="controls">
		1. <select id="pengirim" class="chzn-select" name="pengirim">
			<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>  <b><font color=red>1. Konseptor</font></b>";
         ?> 
		 <br>	
		 2. <select id="pengirim1" class="chzn-select" name="pengirim1">
			<?
			$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));			
			$ef = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$e[cAtasan]'"));
			echo "
			<option value='tidak' selected>Pilih Atasan Level 2!</option>
			<option value='$e[cId]' selected>$e[cNama]</option>
			<option value='$_SESSION[cv]'>$_SESSION[namacv]</option>
			<option value='$ef[cId]'>$ef[cNama]</option>
		</select> <b><font color=red>2. Pilih Asman </font></b>";
         ?> 
		<input type=hidden name=sbnjrn value=N>
        </div> 
    </div>

<?    
}
?>

    <div class="control-group">
		<label class="control-label" for="perihal">Perihal</label>
        <div class="controls"><input class="input-xxlarge focused" id="perihal" type="Hidden" name="perihal" required="required" Value="Permohonan ATK Bagian : <? echo "$_POST[bagian]";?>, Bulan : <? echo $bln1;?>"><b>Permohonan ATK Bagian : <? echo "$_POST[bagian]";?>, Bulan : <? echo $bln1;?></b></div>
    </div>
  
Lengkapi/Edit Isi Permohonan ATK (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste) :
    
        	<textarea name="ket" id="editor" required="required">
        	    Dengan ini melakukan permohonan ATK : <br>


<table border="1" cellpadding="1" cellspacing="1" width=100%>
	<tbody>
		<tr>
			<td style="text-align:center"><b>No</b></td>
			<td style="text-align:center"><b>Nama Barang-Satuan</b></td>
			<td style="text-align:center"><b>Jumlah</b></td>
			<td style="text-align:center"><b>Keterangan</b></td>
		</tr>
			<?
			$e = mysql_fetch_array(mysql_query("SELECT * FROM atk WHERE cId='$_POST[p1]'"));
			?>
		<tr>
			<td>1.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p1] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j1]"; ?></td><td><? echo "$_POST[t1]"; ?></td>
		</tr>
		<?
		if ($_POST[p2]=='')
		{} else {
			$e2 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p2]'"));
			?>
		<tr>
			<td>2.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p2] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j2]"; ?></td><td><? echo "$_POST[t2]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p3]=='')
		{} else {
			$e3 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p3]'"));
			?>
		<tr>
			<td>3.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p3] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j3]"; ?></td><td><? echo "$_POST[t3]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p4]=='')
		{} else {
			$e4 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p4]'"));
			?>
		<tr>
			<td>4.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p4] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j4]"; ?></td><td><? echo "$_POST[t4]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p5]=='')
		{} else {
			$e5 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p5]'"));
			?>
		<tr>
			<td>5.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p5] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j5]"; ?></td><td><? echo "$_POST[t5]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p6]=='')
		{} else {
			$e6 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p6]'"));
			?>
		<tr>
			<td>6.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p6] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j6]"; ?></td><td><? echo "$_POST[t6]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p7]=='')
		{} else {
			$e7 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p7]'"));
			?>
		<tr>
			<td>7.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p7] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j7]"; ?></td><td><? echo "$_POST[t7]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p8]=='')
		{} else {
			$e8 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p8]'"));
			?>
		<tr>
			<td>8.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p8] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j8]"; ?></td><td><? echo "$_POST[t8]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p9]=='')
		{} else {
			$e9 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p9]'"));
			?>
		<tr>
			<td>9.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p9] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j9]"; ?></td><td><? echo "$_POST[t9]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p10]=='')
		{} else {
			$e10 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p10]'"));
			?>
		<tr>
			<td>10.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p10] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j10]"; ?></td><td><? echo "$_POST[t10]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p11]=='')
		{} else {
			$e11 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p11]'"));
			?>
		<tr>
			<td>11.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p11] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j11]"; ?></td><td><? echo "$_POST[t11]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p12]=='')
		{} else {
			$e12 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p12]'"));
			?>
		<tr>
			<td>12.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p12] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j12]"; ?></td><td><? echo "$_POST[t12]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p13]=='')
		{} else {
			$e13 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p13]'"));
			?>
		<tr>
			<td>13.</td>
				<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p13] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j13]"; ?></td><td><? echo "$_POST[t13]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p14]=='')
		{} else {
			$e14 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p14]'"));
			?>
		<tr>
			<td>14.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p14] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j14]"; ?></td><td><? echo "$_POST[t14]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p15]=='')
		{} else {
			$e15 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p15]'"));
			?>
		<tr>
			<td>15.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p15] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j15]"; ?></td><td><? echo "$_POST[t15]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p16]=='')
		{} else {
			$e16 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p16]'"));
			?>
		<tr>
			<td>16.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p16] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j16]"; ?></td><td><? echo "$_POST[t16]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p17]=='')
		{} else {
			$e17 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p17]'"));
			?>
		<tr>
			<td>17.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p17] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j17]"; ?></td><td><? echo "$_POST[t17]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p18]=='')
		{} else {
			$e18 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p18]'"));
			?>
		<tr>
			<td>18.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p18] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j18]"; ?></td><td><? echo "$_POST[t18]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p19]=='')
		{} else {
			$e19 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p19]'"));
			?>
		<tr>
			<td>19.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p19] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j19]"; ?></td><td><? echo "$_POST[t19]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p20]=='')
		{} else {
			$e20 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p20]'"));
			?>
		<tr>
			<td>20.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p20] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j20]"; ?></td><td><? echo "$_POST[t20]"; ?></td>
		</tr>
				<?
		}
		if ($_POST[p21]=='')
		{} else {
			$e21 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p21]'"));
			?>
		<tr>
			<td>21.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p21] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j21]"; ?></td><td><? echo "$_POST[t21]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p22]=='')
		{} else {
			$e22 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p22]'"));
			?>
		<tr>
			<td>22.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p22] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j22]"; ?></td><td><? echo "$_POST[t22]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p23]=='')
		{} else {
			$e23 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p23]'"));
			?>
		<tr>
			<td>23.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p23] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j23]"; ?></td><td><? echo "$_POST[t23]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p24]=='')
		{} else {
			$e24 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p24]'"));
			?>
		<tr>
			<td>24.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p24] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j24]"; ?></td><td><? echo "$_POST[t24]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p25]=='')
		{} else {
			$e25 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p25]'"));
			?>
		<tr>
			<td>25.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p25] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j25]"; ?></td><td><? echo "$_POST[t25]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p26]=='')
		{} else {
			$e26 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p26]'"));
			?>
		<tr>
			<td>26.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p26] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j26]"; ?></td><td><? echo "$_POST[t26]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p27]=='')
		{} else {
			$e27 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p27]'"));
			?>
		<tr>
			<td>27.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p27] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j27]"; ?></td><td><? echo "$_POST[t27]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p28]=='')
		{} else {
			$e28 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p28]'"));
			?>
		<tr>
			<td>28.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p28] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j28]"; ?></td><td><? echo "$_POST[t28]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p29]=='')
		{} else {
			$e29 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p29]'"));
			?>
		<tr>
			<td>29.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p29] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j29]"; ?></td><td><? echo "$_POST[t29]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p30]=='')
		{} else {
			$e30 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p30]'"));
			?>
		<tr>
			<td>30.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p30] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j30]"; ?></td><td><? echo "$_POST[t30]"; ?></td>
		</tr>
						<?
		}
		if ($_POST[p31]=='')
		{} else {
			$e31 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p31]'"));
			?>
		<tr>
			<td>31.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p31] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j31]"; ?></td><td><? echo "$_POST[t31]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p32]=='')
		{} else {
			$e32 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p32]'"));
			?>
		<tr>
			<td>32.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p32] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j32]"; ?></td><td><? echo "$_POST[t32]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p33]=='')
		{} else {
			$e33 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p33]'"));
			?>
		<tr>
			<td>33.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p33] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j33]"; ?></td><td><? echo "$_POST[t33]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p34]=='')
		{} else {
			$e34 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p34]'"));
			?>
		<tr>
			<td>34.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p34] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j34]"; ?></td><td><? echo "$_POST[t34]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p35]=='')
		{} else {
			$e35 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p35]'"));
			?>
		<tr>
			<td>35.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p35] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j35]"; ?></td><td><? echo "$_POST[t35]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p36]=='')
		{} else {
			$e36 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p36]'"));
			?>
		<tr>
			<td>36.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p36] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j36]"; ?></td><td><? echo "$_POST[t36]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p37]=='')
		{} else {
			$e37 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p37]'"));
			?>
		<tr>
			<td>37.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p37] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j37]"; ?></td><td><? echo "$_POST[t37]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p38]=='')
		{} else {
			$e38 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p38]'"));
			?>
		<tr>
			<td>38.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p38] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j38]"; ?></td><td><? echo "$_POST[t38]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p39]=='')
		{} else {
			$e39 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p39]'"));
			?>
		<tr>
			<td>39.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p39] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j39]"; ?></td><td><? echo "$_POST[t39]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p40]=='')
		{} else {
			$e40 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p40]'"));
			?>
		<tr>
			<td>40.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p40] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j40]"; ?></td><td><? echo "$_POST[t40]"; ?></td>
		</tr>
						<?
		}
		if ($_POST[p41]=='')
		{} else {
			$e41 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p41]'"));
			?>
		<tr>
			<td>41.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p41] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j41]"; ?></td><td><? echo "$_POST[t41]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p42]=='')
		{} else {
			$e42 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p42]'"));
			?>
		<tr>
			<td>42.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p42] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j42]"; ?></td><td><? echo "$_POST[t42]"; ?></td>
		</tr>
		<?
		}
		if ($_POST[p43]=='')
		{} else {
			$e43 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p43]'"));
			?>
		<tr>
			<td>43.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p43] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j43]"; ?></td><td><? echo "$_POST[t43]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p44]=='')
		{} else {
			$e44 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p44]'"));
			?>
		<tr>
			<td>44.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p44] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j44]"; ?></td><td><? echo "$_POST[t44]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p45]=='')
		{} else {
			$e45 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p45]'"));
			?>
		<tr>
			<td>45.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p45] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j45]"; ?></td><td><? echo "$_POST[t45]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p46]=='')
		{} else {
			$e46 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p46]'"));
			?>
		<tr>
			<td>46.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p46] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j46]"; ?></td><td><? echo "$_POST[t46]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p47]=='')
		{} else {
			$e47 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p47]'"));
			?>
		<tr>
			<td>47.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p47] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j47]"; ?></td><td><? echo "$_POST[t47]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p48]=='')
		{} else {
			$e48 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p48]'"));
			?>
		<tr>
			<td>48.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p48] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j48]"; ?></td><td><? echo "$_POST[t48]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p49]=='')
		{} else {
			$e49 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p49]'"));
			?>
		<tr>
			<td>49.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p49] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j49]"; ?></td><td><? echo "$_POST[t49]"; ?></td>
		</tr>
		
			<?
		}
		if ($_POST[p50]=='')
		{} else {
			$e50 = mysql_fetch_array(mysql_query("SELECT * FROM Barang WHERE cId='$_POST[p50]'"));
			?>
		<tr>
			<td>50.</td>
			<td><?
			$e = mysql_query("SELECT * FROM atk WHERE id_atk=$_POST[p50] ORDER BY kategori ASC");			
			$ec=mysql_fetch_array($e);
			echo "$ec[kategori] - $ec[nama_atk] ($ec[unit])"; ?></td>
			<td><? echo "$_POST[j50]"; ?></td><td><? echo "$_POST[t50]"; ?></td>
		</tr>
		<? } ?>
	</tbody>
</table>
<br>
Atas perhatiannya kami ucapkan terima kasih.<br>
<b>


        	    
        	    
        	</textarea>
	<br>
     
    <div class="control-group">
		<label class="control-label" for="komentar">Catatan/Keterangan</label>
        <div class="controls"><input class="input-xxlarge focused" id="komentar" type="text" name="sikomen"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran Kartu Stok</label>
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

<?
}
elseif($_GET[act]=="tambah"){

$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
$tgl2			 = date("d");

$query = "SELECT max(sinmr) as max_no FROM linter WHERE sinmr LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 2, 4);
$noUrut++;
$newID = sprintf("L-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<? if ($tgl2 > 10) { echo "<b>Tidak bisa buat permohonan ATK diluar tanggal 1 s/d 10 !, silahkan buat permohonan di bulan depan. Terima kasih</b>"; } else { ?>

<form method="post" action="home.php?pages=linter&act=tambah2" enctype="multipart/form-data" class="form-horizontal" >
<fieldset>
<legend>Buat Permohonan ATK (Form 1 dari 2)</legend>
<b>KETERANGAN :</b><br>
- Permohonan ATK-RAB maksimal dibuat tanggal 10. <br><br>
 <div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input id="tgl" type="text" name="tgl" required="required" value="<? echo $tgl1;?>" disabled></div>
    </div>
      <div class="control-group">
    	<label class="control-label" for="bagian">Bagian</label>
        <div class="controls">
		<select id="bagian" class="chzn-select span7"  name="bagian">
<option value='Plant Banjaran'>-Pilih Bagian-</option>	    
<option value='Bagian Pengawasan Mutu'>Bagian Pengawasan Mutu</option>
<option value='Bagian Mekanik & Electrical'>Bagian Mekanik & Electrical</option>
<option value='Bagian Utility'>Bagian Utility</option>
<option value='Bagian Kualifikasi & Validasi'>Bagian Kualifikasi & Validasi</option>
<option value='Bagian Produksi Farma I'>Bagian Produksi Farma I</option>
<option value='Bagian Produksi Farma II'>Bagian Produksi Farma II</option>
<option value='Bagian Produksi Herbal'>Bagian Produksi Herbal</option>
<option value='Bagian Pengemasan Farma'>Bagian Pengemasan Farma</option>
<option value='Bagian Penyimpanan'>Bagian Penyimpanan</option>
<option value='Bagian Pendukung Teknis'>Bagian Pendukung Teknis</option>
<option value='Bagian Pemenuhan Regulasi'>Bagian Pemenuhan Regulasi</option>
<option value='Bagian Pemastian Operasional'>Bagian Pemastian Operasional</option>
<option value='Bagian K3L'>Bagian K3L</option>
<option value='Bagian SDM & Umum'>Bagian SDM & Umum</option>
<option value='Bagian Akuntansi'>Bagian Akuntansi</option>
<option value='Bagian Pengendalian Proses Produksi'>Bagian Pengendalian Proses Produksi</option>
<option value='Bagian Pembelian Barang Operasional'>Bagian Pembelian Barang Operasional</option>
<option value='Bagian Pengendalian Sistem'>Bagian Pengendalian Sistem</option>
		</select>
	
    
    <br><br>
    <center><b>Jika lebih dari 50 barang buat lagi permohonan ke-2, jika barang tidak ada lapor ke Pembelian</b></center><br>
    
		
		<div class="control-group">
    	<label class="control-label" for="Barang">Barang 1</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p1">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j1"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t1"> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 2</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p2">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j2"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t2"> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 3</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p3">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j3"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t3"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 4</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p4">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j4"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t4"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 5</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p5">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j5"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t5"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 6</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p6">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j6"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t6"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 7</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p7">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j7"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t7"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 8</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p8">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j8"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t8"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 9</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p9">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j9"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t9"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 10</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p10">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j10"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t10"> </div>
    </div>
    
    
 		<div class="control-group">
    	<label class="control-label" for="Barang">Barang 11</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p11">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j11"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t11"> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 12</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p12">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j12"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t12"> </div>
    </div>
    
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 13</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p13">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j13"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t13"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 14</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p14">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j14"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t14"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 15</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p15">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j15"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t15"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 16</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p16">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j16"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t16"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 17</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p17">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j17"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t17"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 18</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p18">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j18"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t18"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 19</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p19">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j19"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t19"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 20</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p20">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j20"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t20"> </div>
    </div>
    
    
    		<div class="control-group">
    	<label class="control-label" for="Barang">Barang 21</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p21">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j21"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t21"> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 22</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p22">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j22"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t22"> </div>
    </div>
    
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 23</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p23">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j23"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t23"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 24</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p24">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j24"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t24"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 25</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p25">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j25"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t25"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 26</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p26">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j26"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t26"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 27</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p27">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j27"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t27"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 28</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p28">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j28"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t28"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 29</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p29">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j29"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t29"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 30</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p30">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j30"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t30"> </div>
    </div>
    
       		<div class="control-group">
    	<label class="control-label" for="Barang">Barang 31</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p31">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j31"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t31"> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 32</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p32">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j32"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t32"> </div>
    </div>
    
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 33</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p33">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j33"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t33"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 34</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p34">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j34"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t34"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 35</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p35">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j35"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t35"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 36</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p36">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j36"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t36"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 37</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p37">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j37"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t37"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 38</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p38">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j38"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t38"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 39</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p39">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j39"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t39"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 40</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p40">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j40"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t40"> </div>
    </div>
    
        		<div class="control-group">
    	<label class="control-label" for="Barang">Barang 41</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p41">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j41"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t41"> </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 42</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p42">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j42"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t42"> </div>
    </div>
    
    
    <div class="control-group">
    	<label class="control-label" for="Barang">Barang 43</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p43">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j43"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t43"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 44</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p44">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j44"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t44"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 45</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p45">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j45"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t45"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 46</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p46">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j46"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t46"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 47</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p47">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j47"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t47"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 48</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p48">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j48"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t48"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 49</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p49">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j49"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t49"> </div>
    </div>
    
     <div class="control-group">
    	<label class="control-label" for="Barang">Barang 50</label>
        <div class="controls">
        <select id="p1" class="chzn-select span9" name="p50">
            <option value=''>Pilih Barang</option>
	<?
			$e = mysql_query("SELECT * FROM atk ORDER BY kategori ASC");			
			while ($ec=mysql_fetch_array($e)){
			echo "<option value='$ec[id_atk]'>$ec[kategori] - $ec[nama_atk] ($ec[unit])</option>";
			}
    ?>
    	</select>
    </div>
    <div class="control-group">
        <div class="controls">Jumlah : <input class="input-medium focused" id="jumlah" type="text" name="j50"> </div><div class="controls">Keterangan : <input class="input-medium focused" id="tugas" type="text" name="t50"> </div>
    </div>
    
           <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Lanjut</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM linter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
?>
<form method="post" action="include/linter/aksi_linter.php?act=edit&id=<?=$e[siid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Permohonan ATK</legend>
	<?
if($_SESSION[levelcv]<1){
?>
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

 Isi Permohonan ATK (Tekan Shift+Enter untuk pindah baris)

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
    	<label class="control-label" for="fileInput">Lampiran Kartu Stok</label>
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
}elseif($_GET[act]=="balas"){
    
$e = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM linter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));

$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
?>
<form method="post" action="include/linter/aksi_linter.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
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
<? $e = mysql_fetch_array(mysql_query("SELECT * FROM linter WHERE siid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM linter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
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


<form method="post" action="include/linter/aksi_linter.php?act=lp&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>List Penerima (Kepada & Tembusan) Memo Internal</legend>
	<div class="control-group">
    	<label class="control-label" for="lsin">Penerima Memo (Kepada)</label>
        <div class="controls">
        	<select multiple="multiple" id="lsin" name="lsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM lsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM lsin WHERE siid='$_GET[id]')");
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
    	<label class="control-label" for="lsin">Penerima Tembusan</label>
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

<form method="post" action="include/linter/aksi_linter.php?act=lpadmin&id=<?=$_GET[id];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah List Penerima (Kepada & Tembusan) Memo Internal (hapus dulu yang ada)</legend>
	<div class="control-group">
    	<label class="control-label" for="lsin">Penerima Memo (Kepada)</label>
        <div class="controls">
        	<select multiple="multiple" id="lsin" name="lsin[]" class="chzn-select span8">
            	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM lsin WHERE siid='$_GET[id]')");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM lsin WHERE siid='$_GET[id]')");
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
    	<label class="control-label" for="lsin">Penerima Tembusan</label>
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
<?php
}elseif($_GET[act]=="detail"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM linter a,users b WHERE a.sipengirim1=b.cId AND a.siid='$_GET[id]'"));
	$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM linter a,users b WHERE a.sipengirim=b.cId AND a.siid='$_GET[id]'"));
	$efg = mysql_fetch_array(mysql_query("SELECT nama_jms FROM jenisms WHERE kode_jms='$ef[jenisms]'"));
	$efgh = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM linter a,users b WHERE a.sipengirim2=b.cId AND a.siid='$_GET[id]'"));
    $efghi = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM linter a,users b WHERE a.sipengirim3=b.cId AND a.siid='$_GET[id]'"));

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
    <tr><td>Lampiran Kartu Stok</td><td>: <a title="Lampiran" href="linternal/<?=$e[sifile];?>">Klik Disini (Jika Ada)</td></tr>
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
    <tr><td align=top><b>Isi Permohonan ATK :</b></td><td></td></tr><tr><td><?=$e[siket];?></td></tr>
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
						LEFT JOIN lsin b ON b.cId=a.cId
						WHERE b.siid='$_GET[id]'");
	$psn1 = mysql_query("SELECT tgl_bls FROM lsin WHERE siid='$_GET[id]'");
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
<? echo"<a href='home1.php?pages=linter&act=print&id=$e[siid]' class='btn btn-info pull-right'><i class='icon-print'></i> Cetak</a>";?>
<?
}else{
?>
<div>
<div class="span12">
	<?php
	$sql = mysql_query("SELECT * FROM linter WHERE sipengirim='$_SESSION[cv]' AND sstatus='Y' AND ssdisp='N'");
    $j = mysql_num_rows($sql);
    $tgl2			 = date("d");
		if($tgl2 > 10){
		echo "<b>Tidak bisa buat permohonan ATK diluar tanggal 1-10</b><br><br>";
		}
		else {
	?>
	<button class="btn-info btn-large" onclick="window.location.href='?pages=linter&act=tambah'">Buat Permohonan ATK</button><br /><br />
	<?php
	}
	?>

	<?php
	if($_SESSION[levelcv]==1000){
		$smasuk = mysql_query("SELECT a.*, b.cNama FROM linter a, users b");
    ?>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Dibuat/ ACC</th>
			<th>Permohonan ATK</th>
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
				<td><a href='?pages=linter&act=lp&id=$s[siid]' class='btn btn-info'>List</a></td>";
				if ($s[sstatus]=='N'){
			echo "<td>Belum ACC/kirim</td>";
			}	else{
			echo "<td>terkirim</td>";
			}	
				echo "
				<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]'><i class='icon-edit'></i></a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' title=DetailMemo> Detail</a>
				</td>
				</tr>";	
		}
	}
	else {
	$smasuk = mysql_query("SELECT * FROM linter WHERE sipengirim=$_SESSION[cv] OR sipengirim1=$_SESSION[cv] OR sipengirim2=$_SESSION[cv] OR sipengirim3=$_SESSION[cv] AND accsipengirim1='Y' ORDER BY sitgl DESC");

     ?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
			<th></th>
			<th>Tanggal</th>
			<th>Perihal </th>
			<th>Status</th>
            <th class='center' width=30%>Aksi</th>
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
	            $tgl2 = date("d");
				if ($s[sstatus]=='N' AND $tgl2 < 11){
				if ($s[sipengirim]==$_SESSION[cv] AND $s[sipengirim2]!=$_SESSION[cv] AND $s[accsipengirim1]=='N' OR  $s[sipengirim]==$_SESSION[cv] AND $s[sipengirim2]!=$_SESSION[cv] AND $s[accsipengirim2]=='N')
					{
			echo "<td><b>Belum Selesai ACC</b></td>
			<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]' class='btn btn-info'>Edit</a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[accsipengirim1]=='Y')
					{
			echo "<td><b>Belum Selesai ACC</b></td>
			<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]' class='btn btn-info'>Edit</a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					
				elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]!=$_SESSION[cv] AND $s[accsipengirim1]=='N' OR $s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]!=$_SESSION[cv] AND $s[accsipengirim2]=='N')
					{
			echo "<td><a href='include/linter/aksi_linter.php?act=acc2&id=$s[siid]' onClick=\"return confirm('Yakin akan ACC dan lanjut ke Atasan??')\" class='btn btn-info'>ACC</a></td>
			<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
				elseif ($s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim2]=='N')
					{
			echo "<td><a href='include/linter/aksi_linter.php?act=acc&id=$s[siid]&p1=$s[sipengirim]&p2=$s[sipengirim1]' onClick=\"return confirm('Yakin akan ACC Permohonan ATK ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
			elseif ($s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N' AND $s[accsipengirim2]=='N')
					{
			echo "<td><a href='include/linter/aksi_linter.php?act=acc&id=$s[siid]&p1=$s[sipengirim]&p2=$s[sipengirim1]' onClick=\"return confirm('Yakin akan ACC Permohonan ATK ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
        	elseif ($s[sipengirim]==$_SESSION[cv] AND $s[sipengirim1]==$_SESSION[cv] AND $s[sipengirim2]==$_SESSION[cv] AND $s[accsipengirim1]=='N' AND $s[accsipengirim2]=='N')
					{
			echo "<td><a href='include/linter/aksi_linter.php?act=acc&id=$s[siid]&p1=$s[sipengirim]&p2=$s[sipengirim1]' onClick=\"return confirm('Yakin akan ACC Permohonan ATK ini??')\" class='btn btn-info'>ACC/Kirim!</a></td>
			<td class='center'><a href='include/linter/aksi_linter.php?act=hapus&id=$s[siid]' onClick=\"return confirm('Yakin ingin menghapus??')\"><i class='icon-trash'></i></a>- 
				<a href='?pages=linter&act=edit&id=$s[siid]' class='btn btn-info'>Koreksi/Komen</a>-<a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>";
					}
					else {
						if ($s[sipengirim]==$s[sipengirim1] AND $s[accsipengirim2]=='Y') {
			echo "<td>
			<b>Belum ACC</b>
			     </td>";
						}
						else {
			echo "<td>
			<b>Belum Selesai ACC</b>
			     </td>";
						}
							echo "
				<td class='center'><a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>Detail</a>
				</td>
				
			";	
					}
			
			}
			elseif ($s[sstatus]=='N' AND $tgl2 > 10) {
			echo "<td><b>Belum ACC, ACC hanya di Tgl 1-10</b></td><td></td>";
			}
			
			elseif ($s[sstatus]=='Y') {
			echo "<td><b>Terkirim</b></td><td></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>
				</td>
				</tr>";	
			}
			
			else{
			echo "<td><b>Cek Detail</b></td>";
			
				echo "
				<td class='center'><a href='home.php?pages=linter&act=detail&id=$s[siid]' class='btn btn-info'>DETAIL</a>
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
	<h5>Baris Tabel Berwarna <u>HIJAU</u> = <strong><u>KONSEP Permohonan ATK BELUM TERKIRIM/ACC!</u>,<br>
	Klik di Kolom <u>Detail (D)</u> untuk Melihat Isi/Detail Permohonan ATK,<br>
	Cara Koreksi/EDIT dan Lihat Komentar Konseptor/ atasan yaitu dengan Klik <u>TOMBOL Koreksi/Komen</u> di kolom Penerima dan Aksi,<br> 
	Untuk ACC atau Kirim Permohonan ATK Klik Link di kolom Status : <u>ACC/KIRIM !</u></h5></strong>

</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->