<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Sasaran/ Target Mutu (KPI)</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
function GetCheckboxes($table, $key, $Label, $Nilai='') {
  $s = "select * from cchl order by id_cchl";
  $r = mysql_query($s);
  $_arrNilai = explode(', ', $Nilai);
  $str = '';
  while ($w = mysql_fetch_array($r)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label]<br>";
  }
  return $str;
}


$aksi="include/mod_sarmut/aksi_sarmut.php";

switch($_GET[act]){
   default:
       echo "";
	   
	    if ($_SESSION[leveluser]=='Admin'){

	    // Tambah sarmut
    echo "<font size=2><b><u><font style='background-color:#00FFFF'>Khusus Admin : </u></b></font><br><font size=2>Tambah Sasaran/Target Mutu bagian</font></font><br><input type=button value='Tambah Target Mutu' onclick=\"window.location.href='?pages=sarmut&act=tambahsarmut';\"><br><br>";  
   		
	  

	     // Cari sasaran mutu per bagian untuk di entry dan edit
	 	 echo "<font size=2>Tampilkan, Entry & Edit Sasaran/Target Mutu Bagian dan Tahun :</b></font>
      <form method=POST action='$aksi?module=sarmut&act=carisarmut'>    
   <select name='kata'>
            <option value=0 selected>- Pilih Bagian -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
<select name='kata1'>
            <option value=0 >- Pilih Tahun -</option>
		    <option value='2020' >2020</option>	</select>
		    <option value='2021' >2021</option>	</select>
		    <option value='2022' >2022</option>	</select>
		    <option value='2023' >2023</option>	</select>
        <input type=submit value=Tampil />
      </form>";
	  
	  	     // Cari sasaran mutu per bagian
	 	 echo "<font size=2>Tampilkan Untuk di Print Sasaran/Target Mutu Bagian dan Tahun :</b></font>
      <form method=POST action='$aksi?module=sarmut&act=carisarmut2'>    
   <select name='kata'>
            <option value=0 selected>- Pilih Bagian -</option>";
			
            $tampil=mysql_query("SELECT * FROM cchl ORDER BY id_cchl");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[cchl]'>$r[cchl]</option>";
            }
echo "</select>
<select name='kata1'>
            <option value=0 >- Pilih Tahun -</option>
			<option value='2020' >2020</option>
			<option value='2021' selected>2021</option>		
            <option value='2022' >2022</option>	
		    <option value='2023' >2023</option>	</select>
		   
        <input type=submit value=Tampil />
      </form>";
	  
	  
	 echo " <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	  
   
		
}

else 

{
    
      // Tambah sarmut
    echo "<font size=2><font size=2><b>Tambah/Tetapkan Sasaran/Target Mutu (KPI)</b></font></font><br><input type=button value='Tambah Target Mutu' onclick=\"window.location.href='?pages=sarmut&act=tambahsarmut';\"><br><br>";  
   		
	echo "<font size=2><b>Entry Realisasi Target Mutu Bagian :</b></font>";
      //Cari sasaran mutu per bagian
	 	 echo "<font size=2><br>Ada link file penetapan sasaran/target mutu tahun yang dipilih.</font>
      <form method=POST action='$aksi?module=sarmut&act=carisarmut' target=_blank>    
  <input type=hidden name=kata value=$_SESSION[bagianuser] >
<select name='kata1'>
            <option value=0>- Pilih Tahun -</option>
			<option value='2020' >2020</option>
			<option value='2021' selected>2021</option>		
            <option value='2022' >2022</option>	
		    <option value='2020' >2020</option>	</select>
		   
        <input type=submit value=Tampil />
      </form>";
	    // Cari sasaran mutu per bagian
	 	 echo "<font size=2><b>Print/ Lihat Realisasi Sasaran/target Mutu Bagian :</b><br>Bila akan print, klik Menu File>Print Preview>Setting ke Fit To Page dan Page Setup Header Footer-nya bila perlu hilangkan (Blank)</font>
      <form method=POST action='$aksi?module=sarmut&act=carisarmut2' target=_blank>    
 <input type=hidden name=kata value=$_SESSION[bagianuser] >
<select name='kata1'>
            <option value=0 >- Pilih Tahun -</option>
			<option value='2020' >2020</option>
			<option value='2021' selected>2021</option>		
            <option value='2022' >2022</option>	
		    <option value='2020' >2020</option>	</select>
		   
        <input type=submit value=Tampil />
      </form>";
	  
	 echo " <br><br><br><br><br><br><br><br><br><br>";
	 
	  }
   break;
  
  
   
  case "tambahsarmut":
    echo "<h2>Tambah Sasaran/Target Mutu</h2>
          <form method=POST action='$aksi?module=sarmut&act=input' onSubmit='return validasip(this)'>
          <table>
		   <tr><td width=170><b>Bagian :</b></td>     <td>	  <select name='bagian'>
            <option value=0 selected>- Pilih Bagian -</option>
			<option value='Umum & SDM>Umum & SDM</option>
            <option value='K3L'>Umum & K3L</option>	
			<option value='Produksi 1'>Produksi 1</option>
			<option value='Produksi 2'>Produksi 2</option>
			<option value='Produksi Herbal'>Produksi Herbal</option>
			<option value='Pengemasan'>Pengemasan</option>
			<option value='Pendukung Teknis'>Pendukung Teknis</option>
			<option value='Validasi & Kualifikasi'>Validasi & Kualifikasi</option>
			<option value='Pemastian Operasional'>Pemastian Operasional</option>
			<option value='Pemenuhan Regulasi'>Pemenuhan Regulasi</option>
		    <option value='Pengawasan Mutu'>Pengawasan Mutu/QC</option>
			<option value='Teknik & Pemeliharaan'>Teknik & Pemeliharaan</option>
			<option value='Penyimpanan'>Penyimpanan</option>
			<option value='Pembelian'>Pembelian</option>
			<option value='Pengendalian Proses Produksi'>Pengendalian Proses Produksi</option>
			</select></td></tr>
          <tr><td width=70><b>Tahun :</b></td>     <td>
		  <select name='tahun'>
            <option value=0 selected>- Pilih Tahun -</option>
			<option value=2020 >2020</option>
			<option value=2021>2021</option>		
            <option value=2022 >2022</option>	
		    <option value=2023 >2023</option>	</select></td></tr>
		  <tr><td width=70><b>Sasaran :</b></td>     <td> <textarea name='sasaran' style='width: 400px; height: 100px;'></textarea></td></tr>
		 <tr><td width=70><b>No Urut Target :</b></td>     <td>  <input type=text name='no_target' size=5></td></tr>
		  <tr><td width=70><b>Target :</b></td>     <td> <textarea name='target' style='width: 400px; height: 100px;'></textarea></td></tr>
		  <tr><td width=70><b>Strategi :</b></td>     <td> <textarea name='strategi' style='width: 400px; height: 100px;'></textarea></td></tr>
		  		 <tr><td width=70><b>Jumlah Target :</b></td>     <td>  <input type=text name='isi_target' size=20> (jumlah target, misal 95%, isi 95)</td></tr>
				      <tr><td width=70><b>Min/ Max :</b></td>     <td>
		  <select name='minmax'>
            <option value=0 selected>- Pilih Min/Max -</option>
			<option value=min >Minimal</option>
			<option value=max >Maksimal</option>		
       	</select> <br>(Apakah isi target minimal/ maksimal, contoh minimal 95%, isi dengan minimal)</td></tr>
		<tr><td width=70><b>Satuan :</b></td>     <td>  <input type=text name='satuan' size=20> (contoh : %, x )</td></tr>
			<tr><td width=70><b>Periode Target :</b></td>     <td>  <input type=text name='periode_target' size=5> bulan</td></tr>
					<tr><td width=70><b>Metoda Pengukuran :</b></td>     <td>  <input type=text name='metoda' size=50></td></tr>
					<tr><td width=70><b>PIC :</b></td>     <td>  <input type=text name='pic' size=50>(Penanggung jawab monitoring)</td></tr>	
					<tr><td width=80><b>Keterangan Tambahan :</b></td>     <td>  <input type=text name='keterangan' size=50></td></tr>	
					
		  ";
       	
    
    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;


  

  case "editsarmut":
    $edit = mysql_query("SELECT * FROM sarmut WHERE id_sarmut='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Sasaran/Target Mutu</h2>
          <form method=POST action=$aksi?module=sarmut&act=update>
          <table>
		  
			<input type=hidden name='id_sarmut' value='$r[id_sarmut]'>  
		   <tr><td width=70><b>Bagian :</b></td>     <td>$r[bagian]	<br>Rubah bagian :  <select name='bagian'>
            <option value='tidak' selected>- Bagian tidak diubah -</option>
			<option value='Umum & SDM>Umum & SDM</option>
            <option value='K3L'>Umum & K3L</option>	
			<option value='Produksi 1'>Produksi 1</option>
			<option value='Produksi 2'>Produksi 2</option>
			<option value='Produksi Herbal'>Produksi Herbal</option>
			<option value='Pengemasan'>Pengemasan</option>
			<option value='Pendukung Teknis'>Pendukung Teknis</option>
			<option value='Validasi & Kualifikasi'>Validasi & Kualifikasi</option>
			<option value='Pemastian Operasional'>Pemastian Operasional</option>
			<option value='Pemenuhan Regulasi'>Pemenuhan Regulasi</option>
		    <option value='Pengawasan Mutu'>Pengawasan Mutu/QC</option>
			<option value='Teknik & Pemeliharaan'>Teknik & Pemeliharaan</option>
			<option value='Penyimpanan'>Penyimpanan</option>
			<option value='Pembelian'>Pembelian</option>
			<option value='Pengendalian Proses Produksi'>Pengendalian Proses Produksi</option>
			</select></td></tr>";
			
        echo "<tr><td><b>Tahun :</b></td>  <td><select name='tahun'>";
 
          if ($r[tahun]=='2020'){
            echo "<option value=2020 selected>2020</option>
			<option value=2021>2021</option>
			<option value=2022>2022</option>";
          }   

          if ($r[tahun]=='2021'){
            echo "<option value=2021 selected>2021</option>
			<option value=2020>2020</option>
			<option value=2022>2022</option>";
            }
			  if ($r[tahun]=='2022'){
            echo "<option value=2022 selected>2022</option>
			<option value=2021>2021</option>
			<option value=2020>2020</option>";
            }
			
			 if ($r[tahun]=='2023'){
            echo "<option value=2023 selected>2023</option>
			<option value=2022>2022</option>
			<option value=2021>2021</option>";
            }
          
    echo "</select></td></tr>

		  <tr><td width=70><b>Sasaran :</b></td>     <td> <textarea name='sasaran' style='width: 400px; height: 100px;'>$r[sasaran]</textarea></td></tr>
		 <tr><td width=70><b>No Urut Target :</b></td>     <td>  <input type=text name='no_target' size=5 value='$r[no_target]'></td></tr>
		  <tr><td width=70><b>Target :</b></td>     <td> <textarea name='target' style='width: 400px; height: 100px;'>$r[target]</textarea></td></tr>
		   <tr><td width=70><b>Strategi :</b></td>     <td> <textarea name='strategi' style='width: 400px; height: 100px;'>$r[strategi]</textarea></td></tr>
		  		 <tr><td width=70><b>Jumlah Target :</b></td>     <td>  <input type=text name='isi_target' size=20 value='$r[isi_target]'> (jumlah target, misal 95%, isi 95)</td></tr>";
				    echo "<tr><td><b>Min/Max :</b></td>  <td><select name='minmax'>";
 
          if ($r[minmax]=='min'){
            echo "<option value=min selected>Minimal</option>
			<option value=max>Maksimal</option>";
          }   

          if ($r[minmax]=='max'){
            echo "<option value=max selected>Maksimal</option>
			<option value=min>Minimal</option>";
            }
         echo "</select><br>(Apakah isi target minimal/ maksimal, contoh minimal 95%, isi dengan minimal)</td></tr>
		<tr><td width=70><b>Satuan :</b></td>     <td>  <input type=text name='satuan' size=20 value='$r[satuan]'> (contoh : %, x )</td></tr>
			<tr><td width=70><b>Periode Target :</b></td>     <td>  <input type=text name='periode_target' size=5 value='$r[periode_target]'> bulan</td></tr>
					<tr><td width=70><b>Metoda Pengukuran :</b></td>     <td>  <input type=text name='metoda' size=50 value='$r[metoda]'></td></tr>
					<tr><td width=70><b>PIC :</b></td>     <td>  <input type=text name='pic' size=50 value='$r[pic]'> <br>(Penanggung jawab monitoring)</td></tr>	
					<tr><td width=80><b>Keterangan Tambahan :</b></td>     <td>  <input type=text name='keterangan' size=50 value='$r[keterangan]'></td></tr>	
						  ";
       	



	echo "
	<td><b>Target Jan :</b></td><td><input type=text name='trg_jan' value='$r[trg_jan]' size=20> </td></tr>
	<td><b>Target Feb :</b></td><td><input type=text name='trg_feb' value='$r[trg_feb]' size=20></td></tr>
	<td><b>Target Mar :</b></td><td><input type=text name='trg_mar' value='$r[trg_mar]' size=20></td></tr>
	<td><b>Target Apr :</b></td><td><input type=text name='trg_apr' value='$r[trg_apr]' size=20></td></tr>
	<td><b>Target Mei :</b></td><td><input type=text name='trg_mei' value='$r[trg_mei]' size=20></td></tr>
	<td><b>Target Jun :</b></td><td><input type=text name='trg_jun' value='$r[trg_jun]' size=20></td></tr>
	<td><b>Target Jul :</b></td><td><input type=text name='trg_jul' value='$r[trg_jul]' size=20></td></tr>
	<td><b>Target Ags :</b></td><td><input type=text name='trg_ags' value='$r[trg_ags]' size=20></td></tr>
	<td><b>Target Sep :</b></td><td><input type=text name='trg_sep' value='$r[ttg_sep]' size=20></td></tr>
    <td><b>Target Okt :</b></td><td><input type=text name='trg_okt' value='$r[trg_okt]' size=20></td></tr>
	<td><b>Target Nov :</b></td><td><input type=text name='trg_nov' value='$r[trg_nov]' size=20></td></tr>
	<td><b>Target Des :</b></td><td><input type=text name='trg_des' value='$r[trg_des]' size=20></td></tr>";
	
    $d = GetCheckboxes('cchl', 'cchl', 'cchl', $r[cchl]);

    echo "<tr><td><b>Jajaran bagian :</b></td><td><input type=checkbox name=checkall onclick=checkUncheckAll(this);><b>Pilih Semua/ Tidak Pilih Semua</b><br> $d
	</td></tr>";
		
    echo  "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  

 
}
?>
</div><!--/span12-->
</div><!--/block-content-->