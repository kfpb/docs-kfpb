<?php

require_once "cek_sesi.php";
session_start();
include "config/koneksi.php";

if ($act=='tambahdisp'){
  $q1=mysql_query("INSERT INTO disposisi(dNoagenda,
                                   dTglM,
                                   dTglS,
                                   dPendisposisi, 
                                   dInstruksi,
                                   dSifat,
								   iid) 
	                     VALUES('$_POST[noagenda]',
                                '$_POST[tglm]',
                                '$_POST[tgls]',
								'$_POST[pendisposisi]',
                                '$_POST[isi]',
								'$_POST[sifat]',
								'$_GET[iid]')");
  $pdis = $_POST["pdis"];
  foreach ($pdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO pdis(cId,iid,psACC) VALUES ('$cid','$_GET[iid]','N')");  
  }
  
  if ($q1&&$q2){
	  echo "<script>window.alert('Data Tersimpan');window.location=('../../home.php?pages=suin')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
  }
//edit disp
}
elseif($act=='editdisp'){
  $q1=mysql_query("UPDATE disposisi SET dNoagenda	= '$_POST[noagenda]',
                                   dTglM	     = '$_POST[tglm]',
                                   dTglS		 = '$_POST[tgls]',
                                   dPendisposisi = '$_POST[pendisposisi]', 
                                   dInstruksi	 = '$_POST[isi]',
								   dSifat		 = '$_POST[sifat]'
								   WHERE iid 	 = '$_GET[iid]'");
  //hapus isi pdis yang sebelumnya
  mysql_query("DELETE FROM pdis WHERE iid='$_GET[iid]'");
  $pdis = $_POST["pdis"];
  foreach ($pdis as $x=>$cid)
  {
	$q2=mysql_query("INSERT INTO pdis(cId,iid,psACC) VALUES ('$cid','$_GET[iid]','N')");  
  }
  if ($q1&&$q2){
	  echo "<script>window.alert('Data Terupdate');window.location=('../../home.php?pages=suin')</script>";
  }else{
	  echo "<script>window.alert('Data Gagal Update');self.history.back();</script>";
  }
}