<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/fungsi_thumb_luar.php";

$halamane=$_GET[halamane];
$act=$_GET[act];
// Hapus notulen header
if ($halamane=='notulen' AND $act=='hapus'){
mysql_query("DELETE FROM notulen WHERE id_notulen=$_GET[id]");
header('location:../../index.php?halamane='.$halamane);
}

// Hapus notulen detail
elseif ($halamane=='notulen' AND $act=='hapusdetail'){
mysql_query("DELETE FROM notulen_detail WHERE id_notulen_detail=$_GET[id]");

header('location:../../notulen-detail-'.$_GET['id_notulen'].'.html');	
}

elseif ($halamane=='notulen' AND $act=='updatestatus'){
mysql_query("UPDATE notulen_detail SET status = '$_GET[status]' WHERE id_notulen_detail = '$_GET[id]'");
header('location:../../notulen-detail-'.$_GET['id_notulen'].'.html');	
}

// Input data
elseif ($halamane=='notulen' AND $act=='input'){
  //buat notulen otomatis
	$query = "select max(id_notulen) as maksi from notulen";
    $hasil = mysql_query($query);
    $data_oto     = mysql_fetch_array($hasil);
	  
	$data_potong = substr($data_oto['maksi'],0,5);
	$data_potong++;
	$kode="";
	for ($i=strlen($data_potong); $i<=1; $i++)
	$kode = $kode."0";
	$notulen_id = "$kode$data_potong";
	
  mysql_query("INSERT INTO notulen(id_notulen,date_isseus,start_time,end_time,place,agenda,participant)
	                       VALUES('$notulen_id','$_POST[date_isseus]','$_POST[start_time]','$_POST[end_time]','$_POST[place]','$_POST[agenda]','$_POST[participant]')");

  header('location:../../index.php?halamane='.$halamane);
 
}


// inputdetail data
elseif ($halamane=='notulen' AND $act=='inputdetail'){
$bln_sekarang = date("F");
 mysql_query("INSERT INTO notulen_detail(id_notulen,issues,pic,due_date,division,remark,bulan,point)
	                       VALUES('$_POST[id_notulen]','$_POST[issues]','$_POST[pic]','$_POST[due_date]','$_POST[division]','$_POST[remark]','$bln_sekarang','1')");

  header('location:../../notulen-detail-'.$_POST['id_notulen'].'.html');	
}


// Update notulen
elseif ($halamane=='notulen' AND $act=='update') {
  
    mysql_query("UPDATE notulen SET date_isseus  = '$_POST[date_isseus]',
    								start_time  = '$_POST[start_time]',
                    end_time  = '$_POST[end_time]',
    								place  = '$_POST[place]',
    								agenda  = '$_POST[agenda]',
    								participant  = '$_POST[participant]',
    									  blokir ='$_POST[blokir]'
								  WHERE id_notulen = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  


}
?>
