<?php
require_once "../cek_sesi.php";
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$act=$_GET[act];

// Input
if ($act=='tambah'){
  
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");
$lokasi          = $_POST[aklokasi];
$kel             = "0"."$_POST[akkelompok]";

$query = "SELECT max(aknomor) as max_no FROM aktiva WHERE aknomor LIKE '%$lokasi$kel%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 7, 3);
$noUrut++;
$newID = sprintf("$lokasi$kel%03s", $noUrut);

if ($_POST[akkelompok]==1) { $kelompok='Bangunan'; } 
					elseif ($_POST[akkelompok]==2) { $kelompok='Kendaraan'; } 
					elseif ($_POST[akkelompok]==3) { $kelompok='Mesin & Alat Bantu Produksi/Lab'; } 
					elseif ($_POST[akkelompok]==4) { $kelompok='Furniture'; }
					elseif ($_POST[akkelompok]==5) { $kelompok='Alat Kantor'; }
					elseif ($_POST[akkelompok]==6) { $kelompok='Perlengkapan Rumah Tangga'; }
					elseif ($_POST[akkelompok]==7) { $kelompok='Utility'; }
					elseif ($_POST[akkelompok]==8) { $kelompok='Perlengkapan K3'; }
					else { $kelompok='Lainnya'; }
					
$sql=mysql_query("SELECT * FROM area WHERE nomor_area='$_POST[aklokasi]'");
$d=mysql_fetch_array($sql);

if ($_POST[aknomor]==''){
		 $q=mysql_query("INSERT INTO aktiva(aktgl,
		                           aknomor,
                                   aknomor2,
                                   akkelompok,
								   akkelompok2,
								   aknama,
								   akmerk,
								   jumlah,
								   aktahun,
								   aklokasi,
								   aklokasi2,
                                   akket,
                                   area,
								   distatus) 
	                     VALUES('$_POST[aktgl]',
	                            '$newID',
                                '$_POST[aknomor2]',
								'$_POST[akkelompok]',
								'$kelompok',
								'$_POST[aknama]',
								'$_POST[akmerk]',
								'$_POST[jumlah]',
								'$_POST[aktahun]',
								'$_POST[aklokasi]',
								'$d[nama_area]',
								'$_POST[akket]',
								'$_POST[aklokasi]',
								'Y')");
							
}
else {
    
    	 $q=mysql_query("INSERT INTO aktiva(aktgl,
    	                           aknomor,
                                   aknomor2,
                                   akkelompok,
								   akkelompok2,
								   aknama,
								   akmerk,
								   jumlah,
								   aktahun,
								   aklokasi,
								   aklokasi2,
                                   akket,
                                   area,
								   distatus) 
	                     VALUES('$_POST[aktgl]',
	                            '$_POST[aknomor]',
                                '$_POST[aknomor2]',
								'$_POST[akkelompok]',
								'$kelompok',
								'$_POST[aknama]',
								'$_POST[akmerk]',
								'$_POST[jumlah]',
								'$_POST[aktahun]',
								'$_POST[aklokasi]',
								'$d[nama_area]',
								'$_POST[akket]',
								'$_POST[aklokasi]',
								'Y')");
    
}
  if ($q){
echo "<script>window.alert('Aktiva telah dibuat');window.location=('../../home.php?pages=aktiva')</script>";

  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";

  }
   


}elseif($act=='edit'){
$sql=mysql_query("SELECT * FROM area WHERE nomor_area='$_POST[aklokasi]'");
$d=mysql_fetch_array($sql);

if ($_POST[akkelompok]==1) { $kelompok='Bangunan'; } 
					elseif ($_POST[akkelompok]==2) { $kelompok='Kendaraan'; } 
					elseif ($_POST[akkelompok]==3) { $kelompok='Mesin & Alat Bantu Produksi/Lab'; } 
					elseif ($_POST[akkelompok]==4) { $kelompok='Furniture'; }
					elseif ($_POST[akkelompok]==5) { $kelompok='Alat Kantor'; }
					elseif ($_POST[akkelompok]==6) { $kelompok='Perlengkapan Rumah Tangga'; }
					elseif ($_POST[akkelompok]==7) { $kelompok='Utility'; }
					elseif ($_POST[akkelompok]==8) { $kelompok='Perlengkapan K3'; }
					else { $kelompok='Lainnya'; }

     $q=mysql_query("UPDATE aktiva SET aktgl 	  = '$_POST[aktgl]',
								   aknomor	  = '$_POST[aknomor]',
								   aknomor2	 = '$_POST[aknomor2]',
                                   akkelompok = '$_POST[akkelompok]',
                                   akkelompok2 = '$kelompok',
								   aknama = '$_POST[aknama]',
                                   akmerk = '$_POST[akmerk]',
								   aklokasi = '$_POST[aklokasi]',
								   aklokasi2 = '$d[nama_area]',
								   jumlah = '$_POST[jumlah]',
								   aktahun = '$_POST[aktahun]',
								   akket	 = '$_POST[akket]',
								   distatus	 = '$_POST[status]'
								   WHERE suid = '$_GET[id]'");
								   
								   
  if ($q){
	  echo "<script>window.alert('Aktiva telah diupdate');window.location=('../../home.php?pages=aktiva')</script>";
  }else{
       echo "<script>window.alert('Gagal Update');self.history.back();</script>";
  }
   
  
}
// hapus smasuk
elseif ($act=='hapus'){
     mysql_query("DELETE FROM aktiva WHERE suid='$_GET[id]'");

  echo "<script>window.location=('../../home.php?pages=aktiva')</script>"; 
}

?>
