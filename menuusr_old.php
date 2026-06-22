<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Shortcut Notifikasi</font></div>
	</div>
	
	
		<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='6o' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo Validasi <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
			<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ssurat a LEFT JOIN psuin b ON a.iid=b.iid LEFT JOIN users c ON a.ikepada=c.cId WHERE b.cId='$_SESSION[cv]' && a.istatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtes3'><i class='icon-arrow-right'></i><strong>Notulen Rapat Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
		
			<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='6p' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo Kualifikasi-Kalibrasi <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
<? 
	if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13' or $_SESSION[cv]=='14' or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21' or $_SESSION[cv]=='80'){
?>
			<?php
        $sql = mysql_query("SELECT a.*,b.*,c.* FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='80' && a.jenisms='20' && a.jenispptek='' ");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtp'><i class='icon-arrow-right'></i><strong>SPPTek Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		
}
		?>

	<? 
if ($_SESSION[cv]=='62'){
	?>
			<?php
        $sql = mysql_query("SELECT a.*,b.*,c.* FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim2=c.cId  WHERE b.cId='$_SESSION[cv]' && b.sistatus='N' && a.jenisms='20'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtpl'><i class='icon-arrow-right'></i><strong>WP SPPTek Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		
}
		?>
		
			<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='999' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N' && jenisms =999 ");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrti'><i class='icon-arrow-right'></i><strong>Tiket IT Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<?php
	if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='73' or $_SESSION[cv]=='74' or $_SESSION[cv]=='83'){


        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='33' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N' && jenisms =33 ");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='home1.php?pages=usrtm1' target=_blank><i class='icon-arrow-right'></i><strong>Memo PR Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	}

    else {
            
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='33' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.tgl_baca='0000-00-00'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtm'><i class='icon-arrow-right'></i><strong>Memo PR Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
        }
        ?>

	<?php
	    $sql = mysql_query("SELECT * FROM linter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N' OR sipengirim3='$_SESSION[cv]' AND accsipengirim2='Y' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=linter'><i class='icon-arrow-left'></i><strong>ACC Permohonan ATK <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
	
		<?php
	    $sql = mysql_query("SELECT * FROM minter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' AND accsipengirim1='N' OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=minter'><i class='icon-arrow-left'></i><strong>ACC Mutasi Sementara <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
	
	<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' AND jenisms!='20' AND jenisms!='33' AND jenisms!='999' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' AND jenisms!='20' AND jenisms!='33' AND jenisms!='999' OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N' AND jenisms!='20' AND jenisms!='33' AND jenisms!='999'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=sinter'><i class='icon-arrow-left'></i><strong>ACC Memo Internal <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
			<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' AND jenisms='20' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' AND jenisms='20' OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N' AND jenisms='20'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=sintertp'><i class='icon-arrow-left'></i><strong>ACC SPPTek/Pmblian Teknik <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
		<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' AND jenisms='999' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' AND jenisms='999' OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N' AND jenisms='999'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=sinterit'><i class='icon-arrow-left'></i><strong>ACC Tiket Sistem IT <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
			<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' AND jenisms='33' AND jenispptek!='pending' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' AND jenisms='33' AND jenispptek!='pending'  OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N' AND jenisms='33' AND jenispptek!='pending' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='home3.php?pages=sinterm' target=_blank><i class='icon-arrow-left'></i><strong>ACC Memo Order/PR <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
    <?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM linter a LEFT JOIN lsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && b.sistatus='N'");
	   
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrl'><i class='icon-arrow-right'></i><strong>Permohonan ATK Masuk<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
		  <?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM minter a LEFT JOIN msin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus='N'");
	   
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrm'><i class='icon-arrow-right'></i><strong>Persetujuan Mutasi Pegawai <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		

	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms!='6o' && a.jenisms!='6p' && a.jenisms!='20' && a.jenisms!='33' && a.jenisms!='999' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
		

	<?php
	$sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	

		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtt'><i class='icon-arrow-right'></i><strong>Tembusan Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

		<?php 
		$sql = mysql_query("SELECT * FROM pdis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=udis'><i class='icon-forward'></i><strong>Disposisi Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<?php 
		$sql = mysql_query("SELECT * FROM ldis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psTglbaca='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=ldis'><i class='icon-forward'></i><strong>Permohonan ATK Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>


	<?php
		$sql = mysql_query("SELECT * FROM isurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
		    
		    echo"<li><a href='?pages=usrte'><i class='icon-arrow-right'></i><strong>Surat Masuk/Jwbn Disp <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	?>
	
		<?php
		$sql = mysql_query("SELECT * FROM isurat 
							 WHERE ikepada2 = '$_SESSION[cv]'
							 AND istatus2 = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
		    
		    echo"<li><a href='?pages=usrte'><i class='icon-arrow-right'></i><strong>Surat Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	?>


		<?php
		$sql = mysql_query("SELECT * FROM tdis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psTglselesai='0000-00-00' AND tampil='Y'" );
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=utis'><i class='icon-forward'></i><strong>Telaahan Prod./Jasa <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<? 
	if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='74' or $_SESSION[cv]=='73' or $_SESSION[cv]=='83'){
	?>

	<?php
	//ikepada = '$_SESSION[cv]' AND
		$sql = mysql_query("SELECT * FROM tsurat 
							 WHERE istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtl'><i class='icon-arrow-right'></i><strong>Baca Tela'ahan Prod./Jasa <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
	
	<? } ?>	
	
		<?php
		$sql = mysql_query("SELECT * FROM pdiss  
							 WHERE cId = '$_SESSION[cv]' AND siid=0
							 AND psTglselesai='0000-00-00' OR pId = '$_SESSION[cv]' AND siid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=udis2'><i class='icon-forward'></i><strong>RTL Tugas/CAPA <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
			<?php
	$thnbln=date("Y-m");
	$now=date("Y-m-d");
	$thn = date("Y");
	$bln = date ("m");
	
	$tambah_tanggal = mktime(0,0,0,date('m')-6);
	$tambah = date('Y-m',$tambah_tanggal);
    $tambah2 = date('Y-m-d',$tambah_tanggal);
	
//	  $tambah_tanggal = mktime(0,0,0,date('m')+6);
//    $tambah = date('Y-m',$tambah_tanggal);
//    $tambah2 = date('Y-m-d',$tambah_tanggal);
	
    $pisah_kata = explode(" ",$tambah);
    $jml_katakan = (integer)count($pisah_kata);
    $jml_kata = $jml_katakan-1;


    $cari = "SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "a.ptgls LIKE '%$pisah_kata[$i]%' AND a.psACC='N' AND a.cId='$_SESSION[cv]' AND a.siid=0 ORDER BY a.ptgl DESC";
      if ($i < $jml_kata ){
        $cari .= "";
      }
    }
  $cari .= "";
  
  $cari2 = "SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE a.ptgls>'$tambah2' && a.kode>365 && a.psACC='N' && a.cId='$_SESSION[cv]' && a.siid=0 && a.pSifat!='G' OR a.ptgls<'$now' && a.kode>365 && a.psACC='N' && a.cId='$_SESSION[cv]' && a.siid=0 && a.pSifat!='G'";

//  $cari2 = "SELECT * FROM premind WHERE ptgls between '$now' and '$tambah2' && kode>365 && psACC='N' && cId='$_SESSION[cv]' && siid=0";
  $hasil  = mysql_query($cari2);
  $j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<li><a href='?pages=udremind6'><i class='icon-forward'></i><strong>Reminder Brlk >1 Thn <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		
					<?php
	$thnbln=date("Y-m");
	$now=date("Y-m-d");
	$thn = date("Y");
	$bln = date ("m");

	$tambah_tanggal = mktime(0,0,0,date('m')-2);
    $tambah = date('Y-m',$tambah_tanggal);
    $tambah2 = date('Y-m-d',$tambah_tanggal);

//	  $tambah_tanggal = mktime(0,0,0,date('m')+2);
//    $tambah = date('Y-m',$tambah_tanggal);
//    $tambah2 = date('Y-m-d',$tambah_tanggal);
	
    $pisah_kata = explode(" ",$tambah);
    $jml_katakan = (integer)count($pisah_kata);
    $jml_kata = $jml_katakan-1;


    $cari = "SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "a.ptgls LIKE '%$pisah_kata[$i]%' AND a.psACC='N' AND a.cId='$_SESSION[cv]' AND a.siid=0 ORDER BY a.ptgl DESC";
      if ($i < $jml_kata ){
        $cari .= "";
      }
    }
  $cari .= "";
  $cari2 = "SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE a.ptgls>'$tambah2' && a.kode<365 && a.psACC='N' && a.cId='$_SESSION[cv]' && a.siid=0 && a.pSifat!='G'  OR a.ptgls<'$now' && a.kode<365 && a.psACC='N' && a.cId='$_SESSION[cv]' && a.siid=0 && a.pSifat!='G'";

//  $cari2 = "SELECT * FROM premind WHERE ptgls between '$now' and '$tambah2' && kode<365 && psACC='N' && cId='$_SESSION[cv]' && siid=0";
  $hasil  = mysql_query($cari2);
  $j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<li><a href='?pages=udremind1'><i class='icon-forward'></i><strong>Reminder Brlk <1 Thn <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>


	<?php
	$thnbln=date("Y-m");
	$now=date("Y-m-d");
	$thn = date("Y");
	$bln = date ("m");

	$tambah_tanggal = mktime(0,0,0,date('m')+1);
    $tambah = date('Y-m',$tambah_tanggal);
    $tambah2 = date('Y-m-d',$tambah_tanggal);

//	  $tambah_tanggal = mktime(0,0,0,date('m')+2);
//    $tambah = date('Y-m',$tambah_tanggal);
//    $tambah2 = date('Y-m-d',$tambah_tanggal);
	
    $pisah_kata = explode(" ",$tambah);
    $jml_katakan = (integer)count($pisah_kata);
    $jml_kata = $jml_katakan-1;


    $cari = "SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "a.ptgls LIKE '%$pisah_kata[$i]%' AND a.psACC='N' AND a.cId='$_SESSION[cv]' AND a.siid=0 ORDER BY a.ptgl DESC";
      if ($i < $jml_kata ){
        $cari .= "";
      }
    }
  $cari .= "";
  $cari3 = "SELECT a.*,b.cNama, b.cIdjab FROM premind a LEFT JOIN users b ON a.pid=b.cId WHERE a.ptgls<'$tambah2' && a.psACC='N' && a.cId='$_SESSION[cv]' && a.siid=0 && a.pSifat='G' OR  a.ptgls<'$now' && a.psACC='N' && a.cId='$_SESSION[cv]' && a.siid=0 && a.pSifat='G'";

//  $cari2 = "SELECT * FROM premind WHERE ptgls between '$now' and '$tambah2' && kode<365 && psACC='N' && cId='$_SESSION[cv]' && siid=0";
  $hasil  = mysql_query($cari3);
  $j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<li><a href='?pages=udremind4'><i class='icon-forward'></i><strong>Reminder EH.Pelatihan <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>


	<?php
		$sql = mysql_query("SELECT * FROM ssurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtes'><i class='icon-arrow-right'></i><strong>Baca CAPA !<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	?>
	
	<?php
		$sql = mysql_query("SELECT * FROM remind 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrrm'><i class='icon-arrow-right'></i><strong>Jawaban Reminder <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	?>

		
	<?php
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dointer a LEFT JOIN dosin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");

	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=ussd'><i class='icon-list-alt'></i><strong>Sosialisasi Dok. MK3L<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
		


		
<? 
	if ($_SESSION[cv]=='51' or $_SESSION[cv]=='3' or $_SESSION[cv]=='16' or $_SESSION[cv]=='75' or $_SESSION[cv]=='55' or $_SESSION[cv]=='64'){
?>			
	<?php
	$thnbln=date("Y-m");
	$thn = date("Y");
	$bln = date ("m");
	$bln1 = $bln+1;
	$kata = tgl_indo($thnbln) ;
	$kata1 = tgl_indo ($thn.-$bln1);
	$kata2 = trim ($thnbln) ;
	$kata3 = trim ($thn.-$bln1);
	
  $pisah_kata = explode(" ",$kata3);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM reminder WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "valid_end LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<li><a href='?pages=data_reminder'><i class='icon-list-alt'></i><strong>Remind Dok Halal ($kata1) <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

<?
}
?>
		
	<li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dester a LEFT JOIN desin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrdek'><i class='icon-list-alt'></i><strong>Dokumen Eksternal Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
		?>
	</li>
	<li>
	<?php
	$thnbln=date("Y-m");
	$kata2 = trim ($thnbln) ;
    $kata3 = trim ($_SESSION[cv]);
	
  $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dinter WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "ditgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " and dipjdok=$kata3";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<a href='?pages=usrdrvw'><i class='icon-list-alt'></i><strong>Review Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
		?>
	</li>

		<li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dister a LEFT JOIN disin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrd'><i class='icon-list-alt'></i><strong>Distribusi Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
		?>
	</li>
		  <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen 
							 WHERE udpengusul2 = '$_SESSION[cv]'
							 AND udstatus2 = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i><strong>Usulan Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
	?>
	</li>
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM udokumen 
							 WHERE udpengusul = '$_SESSION[cv]' AND 
							  udstatus='1'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i><strong>Usulan Dokumen Blm Selesai<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
	?>
	</li>
<li>
		<?php
		$sql = mysql_query("SELECT * FROM uddis  
							 WHERE cId ='$_SESSION[cv]' AND psTglselesai='0000-00-00' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udok'><i class='icon-forward'></i><strong>Koreksi Usulan Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
		?>
	</li>	
	<li>
	<?php
	    $sql = mysql_query("SELECT * FROM copydok WHERE okepada='$_SESSION[cv]' AND sstatus='N' OR opengirim='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i><strong>Permintaan Copy Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"";
		}
		?>
	
	</li>

            
		
		
	<? if ($_SESSION[cv]=='55' OR $_SESSION[cv]=='81'){ ?>	
	<?php
	    $sql = mysql_query("SELECT * FROM ccinter WHERE ccstatus='N' AND accsipengirim1='Y' OR ccstatus='N' AND accsipengirim1='Y'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=ccinter'><i class='icon-arrow-left'></i><strong>Usulan Change Control <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	}
	
		
		else {
		    
		  	    $sql = mysql_query("SELECT * FROM ccinter WHERE ccpengirim='$_SESSION[cv]' AND ccstatus='N' OR ccpengirim1='$_SESSION[cv]' AND ccstatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=ccinter'><i class='icon-arrow-left'></i><strong>Usulan Change Control <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}  
		    
		}
		
		?>
	
	
	<?php
	$sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN ccsin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus = 'N'");

		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usracc'><i class='icon-arrow-right'></i><strong>ACC Usulan CC (MPM/AMPR) <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN csin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.comment = 'Y'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrcc'><i class='icon-arrow-right'></i><strong>Info Usulan CC<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
	
	
	<? if ($_SESSION[cv]=='1' OR $_SESSION[cv]=='81'){ ?>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN csin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrcc'><i class='icon-arrow-right'></i><strong>ACC Usulan CC/ Info RTCC<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
    <? }  ?>
    
    	<? if ($_SESSION[cv]=='55' OR $_SESSION[cv]=='99'){ ?>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN csin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus2 = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrcc'><i class='icon-arrow-right'></i><strong>ACC Usulan CC/ Info RTCC<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
    <? }  ?>
	
	
		<?php
		$sql = mysql_query("SELECT * FROM cdis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psACC='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=rtcc'><i class='icon-forward'></i><strong>Rencana Tindaklanjut CC <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<? if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='1'){ ?>
	

	<?php
	    $sql = mysql_query("SELECT * FROM osurat WHERE okepada='$_SESSION[cv]' OR opengirim='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"	<li><a href='?pages=sout'><i class='icon-arrow-left'></i><strong>Surat Keluar <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

<? } 
/* tidak dilanjutkan
	
*/
?>
	<li>
        <a href='home3.php?pages=dashppic' target=_blank><i class='icon-forward'></i><strong>Dashboard Produk 2020 <span class='badge badge-info pull-right'></span></strong></a>
	</li>
	<li>
        <a href='home3.php?pages=dashppic2021' target=_blank> <i class='icon-forward'></i><strong>Dashboard Produk 2021 <span class='badge badge-info pull-right'></span></strong></a>
	</li>
	<li>
        <a href='home3.php?pages=dashppicnie' target=_blank><i class='icon-forward'></i><strong>Progress NIE Banjaran <span class='badge badge-info pull-right'></span></strong></a>
	</li>
	<li>
    <a href='https://docs.google.com/spreadsheets/d/1_DyaRExloKrJR6Rbw1y27GIt-hO6YVb24KEx2ZTJSfc/edit#gid=1459538396&fvid=949940090' target=_blank><i class='icon-forward'></i><strong>Monitoring BBA<span class='badge badge-info pull-right'></span></strong></a>
    </li>
<?php /*	
	<li>
        <a href='home3.php?pages=dashppic2' target=_blank><i class='icon-forward'></i><strong>Dashboard Mesin <span class='badge badge-info pull-right'></span></strong></a>
	</li>

	<li>
        <a href='?pages=pelulusan'><i class='icon-forward'></i><strong>Monitoring Pelulusan <span class='badge badge-info pull-right'></span></strong></a>
	</li>
	<li>
<a href='?pages=pkl'><i class='icon-forward'></i><strong>Daftar PKL-Kunjungan<span class='badge badge-info pull-right'></span></strong></a>
</li>
<li>
<a href='?pages=mobil'><i class='icon-forward'></i><strong>Pesan Kendaraan Dinas<span class='badge badge-info pull-right'></span></strong></a>
</li>
*/
?>
<li>
<a href='https://meeting.ekfpb.com' target=_blank><i class='icon-forward'></i><strong>Pesan Ruang Rapat<span class='badge badge-info pull-right'></span></strong></a>
</li>

	<li>
<a href='https://eric.ekfpb.com/' target=_blank><i class='icon-forward'></i><strong>e-Improve (SI ERIC)<span class='badge badge-info pull-right'></span></strong></a>
</li>
	<li>
<a href='https://wms.ekfpb.com/' target=_blank><i class='icon-forward'></i><strong>e-Gudang (WMS)<span class='badge badge-info pull-right'></span></strong></a>
</li>
	<li>
<a href='https://sdm.ekfpb.com/cek_login.php?id=<?=$_SESSION[bagian2]?>' target=_blank><i class='icon-forward'></i><strong>e-SDM (Absen-Lembur)<span class='badge badge-info pull-right'></span></strong></a>
</li>
	<li>
<a href='https://project.ekfpb.com/' target=_blank><i class='icon-forward'></i><strong>e-Project (Online)<span class='badge badge-info pull-right'></span></strong></a>
</li>
	<li>
<a href='https://lelang.ekfpb.com/' target=_blank><i class='icon-forward'></i><strong>e-Lelang 5R<span class='badge badge-info pull-right'></span></strong></a>
</li>
	<li>
<a href='https://logbook.ekfpb.com/' target=_blank><i class='icon-forward'></i><strong>e-LogBook<span class='badge badge-info pull-right'></span></strong></a>
</li>
	<li>
<a href='http://192.168.1.14/' target=_blank><i class='icon-forward'></i><strong>e-Batch Record<span class='badge badge-info pull-right'></span></strong></a>
</li>
</ul>










<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	 <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Office </b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
	<li>
	<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' OR sipengirim2='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=sinter'><i class='icon-arrow-left'></i><strong>Memo Internal <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=sinter'><i class='icon-arrow-left'></i>Memo Internal </a>";
		}
		?>
	</li>
    <li>
	<? if ($_SESSION[cv]=='3'){ 
	echo"<a href='home.php?pages=sinter&act=tambah2'><i class='icon-arrow-left'></i>Penunjukan PJ Pelulusan</a>";
	} ?>
    </li>
	<li>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	
/*$sql = mysql_query("SELECT * FROM psin 
							 WHERE cId = '$_SESSION[cv]'
							 AND sistatus = 'N'");
							 */
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo Masuk<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrt'><i class='icon-arrow-right'></i>Memo Masuk</a>";
		}
		?>
	</li>
	

	<li>
	<?php
	$sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	

		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtt'><i class='icon-arrow-right'></i><strong>Tembusan Masuk <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrtt'><i class='icon-arrow-right'></i>Tembusan Masuk</a>";
		}
		?>
	</li>

	<li>
	<?php 
		$sql = mysql_query("SELECT * FROM isurat 
							 WHERE ikepada = '$_SESSION[cv]' OR ikepada2 = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrte'><i class='icon-arrow-right'></i><strong>Surat Masuk Eksternal<span class='badge badge-info pull-right'></span></strong></a>
			";
		} else {
			echo"<a href='?pages=usrte'><i class='icon-arrow-right'></i>Surat Masuk Eksternal</a>";
		}
	?>
	</li>

	<li>
		<?php
		$sql = mysql_query("SELECT * FROM pdis 
							 WHERE cId = '$_SESSION[cv]' 
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udis'><i class='icon-forward'></i><strong>Disposisi/ Info Masuk <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=udis'><i class='icon-forward'></i>Disposisi/ Info Masuk</a>";
		}
		?>
	</li>
	


	<? if ($_SESSION[levelcv]<4 or $_SESSION[cv]=='1'){ ?>
	
		<li>
	<?php

			echo"<a href='?pages=suin'><i class='icon-arrow-right'></i>Surat Masuk (ALL)</a>";
			?>
	
	</li>
	
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM osurat WHERE okepada='$_SESSION[cv]' OR opengirim='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=sout'><i class='icon-arrow-left'></i><strong>Surat Keluar<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=sout'><i class='icon-arrow-left'></i>Surat Keluar</a>";
		}
		?>
	
	</li>
<? } ?>
	
  </ul>
      </li>
</ul>

	<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Notulen (MoM)</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">

    <li>
	<?php
		$sql = mysql_query("SELECT * FROM ssurat 
							 WHERE ikepada = '$_SESSION[cv]' AND jenisms=21
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtes2'><i class='icon-arrow-right'></i><strong>Buat-Daftar Notulen Rapat<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrtes2'><i class='icon-arrow-right'></i>Buat-Daftar Notulen Rapat</a>";
		}
	?>
	</li>
	
	  <li>
	<?php
		$sql = mysql_query("SELECT * FROM ssurat 
							 WHERE jenisms=21");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtes3'><i class='icon-arrow-right'></i><strong>Notulen Rapat Masuk<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrtes3'><i class='icon-arrow-right'></i>Notulen Rapat Masuk</a>";
		}
	?>
	</li>
	
		<li>
		<?php
		$sql = mysql_query("SELECT * FROM pdiss  
							 WHERE cId = '$_SESSION[cv]' AND siid=0 AND kode=0 
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udis3'><i class='icon-forward'></i><strong>Tindaklanjuti Notulen Rapat<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=udis3'><i class='icon-forward'></i>Tindaklanjuti Notulen Rapat</a>";
		}
		?>
	</li>	


	
	  </ul>
      </li>
	 </ul>


<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

		
		<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-ChangeControl (CC)</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM ccinter WHERE ccpengirim1='$_SESSION[cv]' AND ccstatus='N' OR ccpengirim2='$_SESSION[cv]' AND ccstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ccinter'><i class='icon-arrow-left'></i><strong>Usulan Change Control <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=ccinter'><i class='icon-arrow-left'></i>Usulan Change Control</a>";
		}
		?>
	</li>
	
	
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM ccinter WHERE ccpengirim1='$_SESSION[cv]' AND ccstatus='N' OR ccpengirim2='$_SESSION[cv]' AND ccstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ccinter0'target=_blank><i class='icon-arrow-left'></i>Reg. Change Control ALL <span class='badge badge-info pull-right'></span></a>";
		} else {
			echo"<a href='?pages=ccinter0' target=_blank><i class='icon-arrow-left'></i>Reg. Change Control ALL</a>";
		}
		?>
	</li>
<? if ($_SESSION[cv]=='3' OR $_SESSION[cv]=='51'){ ?>
	<li>
	<?php
	$sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN ccsin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus = 'N'");

		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usracc'><i class='icon-arrow-right'></i><strong>ACC Usulan CC (MPM/AMPR) <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usracc'><i class='icon-arrow-right'></i>ACC Usulan CC (MPM/AMPR) </a>";
		}
		?>
	</li>
<? } else {  ?>

	<li>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN csin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrcc'><i class='icon-arrow-right'></i><strong>ACC Usulan CC<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrcc'><i class='icon-arrow-right'></i>ACC Usulan CC</a>";
		}
		?>
	</li>
<? } ?>
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM cdis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=rtcc'><i class='icon-forward'></i><strong>Rencana Tindaklanjut CC <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=rtcc'><i class='icon-forward'></i>Rencana Tindaklanjut CC</a>";
		}
		?>
	</li>
<? if ($_SESSION[cv]=='55' OR $_SESSION[cv]=='81'){ ?>	
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM dister WHERE distatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a target=_blank href='home.php?pages=usulandok'><i class='icon-arrow-left'></i><strong>Info Usulan Dokumen<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a target=_blank href='home.php?pages=usulandok'><i class='icon-arrow-left'></i>Info Usulan Dokumen</a>";
		}
		?>
	</li>
		<li>
	<?php
	 	$sql = mysql_query("SELECT * FROM cdis 
							 WHERE psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='home1.php?pages=ccinter4' target=_blank><i class='icon-arrow-left'></i><strong>Reg. RTCC ALL<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='home1.php?pages=ccinter4' target=_blank><i class='icon-arrow-left'></i>Reg. RTCC ALL</a>";
		}
		?>
	</li>
	<? } ?>
  </ul>
      </li>
</ul>

<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Dokumen</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
<?php /*           
	<li>
		<a href="?pages=dokint"><i class="icon-book"></i>Reg. Dokumen Internal Lama</a>
		<a href="?pages=dokeks"><i class="icon-book"></i>Reg. Dokumen Eksternal Lama</a>
	</li>
*/
?>
	 <li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dinter a LEFT JOIN dsin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrdin'><i class='icon-list-alt'></i><strong>Daftar Dokumen Internal<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdin'><i class='icon-list-alt'></i>Daftar Dokumen Internal</a>";
		}
		?>
	</li>
	<li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dester a LEFT JOIN desin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrdek'><i class='icon-list-alt'></i><strong>Dokumen Eksternal Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdek'><i class='icon-list-alt'></i>Daftar Dokumen Eksternal</a>";
		}
		?>
	</li>
	<li>
	<?php
	$thnbln=date("Y-m");
	$kata2 = trim ($thnbln) ;
    $kata3 = trim ($_SESSION[cv]);
	
  $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM dinter WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "ditgl_review LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " and dipjdok=$kata3";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<a href='?pages=usrdrvw'><i class='icon-list-alt'></i><strong>Review Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdrvw'><i class='icon-list-alt'></i>Review Dokumen</a>";
		}
		?>
	</li>

		<li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dister a LEFT JOIN disin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrd'><i class='icon-list-alt'></i><strong>Distribusi Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrd'><i class='icon-list-alt'></i>Distribusi Dokumen Masuk</a>";
		}
		?>
	</li>
		  <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen 
							 WHERE udpengusul2 = '$_SESSION[cv]'
							 AND udstatus2 = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i><strong>Usulan Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i>Usulan Dokumen</a>";
		}
	?>
	</li>
<li>
		<?php
		$sql = mysql_query("SELECT * FROM uddis  
							 WHERE cId ='$_SESSION[cv]' AND psTglselesai='0000-00-00' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udok'><i class='icon-forward'></i><strong>Koreksi Usulan Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=udok'><i class='icon-forward'></i>Usulan Dokumen InProses</a>";
		}
		?>
	</li>	
	<li>
	<?php
	    $sql = mysql_query("SELECT * FROM copydok WHERE okepada='$_SESSION[cv]' AND sstatus='N' OR opengirim='$_SESSION[cv]' AND otgl_admin='0000-00-00' AND sstatus='Y'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i><strong>Permintaan Copy Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i>Permintaan Copy Dokumen</a>";
		}
		?>
	
	</li>
	
    <li>
		<?php
		$sql = mysql_query("SELECT * FROM ddist 
							 WHERE cId = '$_SESSION[cv]' 
							 AND psTglselesai='0000-00-00' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddist2'><i class='icon-forward'></i><strong>Arsip Informasi Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddist2'><i class='icon-forward'></i>Arsip Informasi Dokumen </a>";
		}
		?>
	</li>

    <li>
		<?php
		$sql = mysql_query("SELECT * FROM ddis
							 WHERE cId = '$_SESSION[cv]' 
							 AND psTglselesai='0000-00-00' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddis2'><i class='icon-forward'></i><strong>Arsip Review Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddis2'><i class='icon-forward'></i>Arsip Review Dokumen </a>";
		}
		?>
	</li>

		<li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dointer a LEFT JOIN dosin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ussd'><i class='icon-list-alt'></i><strong>Sosialisasi Dok. MK3L<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=ussd'><i class='icon-list-alt'></i>Sosialisasi Dok. MK3L</a>";
		}
		?>
	</li>
	
		
	<li>
	<?php
	    $sql = mysql_query("SELECT * FROM dointer WHERE distatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=dointer'><i class='icon-arrow-left'></i><strong>Buat Sosialiasi Dok. MK3L <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=dointer'><i class='icon-arrow-left'></i>Buat Sosialiasi Dok. MK3L</a>";
		}
		?>
	</li>    
            
  </ul>
      </li>
</ul>

	 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Reminder</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
            
            		<li>
	<?php
	$thnbln=date("Y-m");
	$kata2 = trim ($thnbln) ;
	
  $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM reminder WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "valid_end LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= "";
      }
    }
  $cari .= "";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<a href='?pages=data_reminder'><i class='icon-list-alt'></i><strong>Review Dok Halal <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=data_reminder'><i class='icon-list-alt'></i>Review Dok Halal</a>";
		}
		?>
	</li>
            
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM premind  
							 WHERE cId = '$_SESSION[cv]' AND siid=0 AND pSifat!='G'
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udremind'><i class='icon-forward'></i><strong>Reminder Umum <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=udremind'><i class='icon-forward'></i>Reminder Umum </a>";
		}
		?>
	</li>	
	
	
		<li>
		<?php
		$sql = mysql_query("SELECT * FROM premind  
							 WHERE cId = '$_SESSION[cv]' AND siid=0 AND pSifat='G'
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udremind44'><i class='icon-forward'></i><strong>Reminder EHP <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=udremind44'><i class='icon-forward'></i>Reminder EHP </a>";
		}
		?>
	</li>	

    <li>
	<?php
		$sql = mysql_query("SELECT * FROM remind 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrrm'><i class='icon-arrow-right'></i><strong>Sumber Reminder<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrrm'><i class='icon-arrow-right'></i>Buat Sumber Reminder</a>";
		}
	?>
	</li>

<? /*	
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM premind  
							 WHERE siid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udremind2'><i class='icon-forward'></i><strong>Semua Reminder <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=udremind2'><i class='icon-forward'></i>Semua Reminder </a>";
		}
		?>
	</li>
*/ ?>	
	  </ul>
      </li>
	 </ul>
	 
<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Pembelian</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">

	<li>
	<a href='home3.php?pages=sinterm1' target=_blank><i class='icon-forward'></i>Daftar Memo Purchase Request (PR) <span class='badge badge-info pull-right'></span></a>
	</li>

	<li>
	<a href='?pages=sinterm&act=tambah5'><i class='icon-forward'></i>Buat Memo Purchase Request (PR) <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=linter'><i class='icon-forward'></i>Buat Permohonan ATK <span class='badge badge-info pull-right'></span></a>
	</li>
	
	<li>
		<?php
/*
*/			
		
		
		$sql = mysql_query("SELECT * FROM tdis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psTglselesai='0000-00-00' AND tampil='Y'" );
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=utis'><i class='icon-forward'></i><strong>Tela'ahan Produk/Jasa <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=utis'><i class='icon-forward'></i>Tela'ahan Produk/Jasa</a>";
		}
		?>
	</li>
	<? 
	if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='71' or $_SESSION[cv]=='72' or $_SESSION[cv]=='87' or $_SESSION[cv]=='27'){
	?>

	<li>
	<a href='?pages=usrtm' target=_blank><i class='icon-forward'></i>Daftar Purchase Request (PR) Masuk <span class='badge badge-info pull-right'></span></a>
	</li>
	<? 
	}
	if ($_SESSION[cv]=='73' AND $_SESSION[cv]=='74'){
	?>
	<li>
	<a href='home3.php?pages=usrtm' target=_blank><i class='icon-forward'></i>Daftar Memo PR ALL<span class='badge badge-info pull-right'></span></a>
	</li>
	<?php
	}
	
		if ($_SESSION[cv]=='66' or $_SESSION[cv]=='73' or $_SESSION[cv]=='74' or $_SESSION[cv]=='83'){
	?>
	<li>
	<a href='home3.php?pages=usrl' target=_blank><i class='icon-forward'></i>Daftar Permohonan ATK Masuk<span class='badge badge-info pull-right'></span></a>
	</li>
	<?php
	}
	if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='73' or $_SESSION[cv]=='74' or $_SESSION[cv]=='83'){
/*	    
*/
	?>
	<li>
	<a href='?pages=atk' target=_blank><i class='icon-forward'></i>Kelola Database ATK <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='home1.php?pages=usrtm1' target=_blank><i class='icon-forward'></i>Daftar Purchase Request (PR) Masuk <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<?php
		$sql = mysql_query("SELECT * FROM tsurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtl'><i class='icon-arrow-right'></i><strong>Surat Tela'ahan Produk/Jasa <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrtl'><i class='icon-arrow-right'></i>Surat Tela'ahan Produk/Jasa</a>";
		}
		?>
	</li>
	<li>
	<?php
		$sql = mysql_query("SELECT * FROM tsurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus2 = 'Y'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtls'><i class='icon-arrow-right'></i>Reg. Tela'ahan Selesai <span class='badge badge-info pull-right'></span></a>";
		} else {
			echo"<a href='?pages=usrtls'><i class='icon-arrow-right'></i>Reg. Tela'ahan Selesai </a>";
		}
		?>
	</li>
	
	<? } ?>	
	
	  </ul>
      </li>
      
     
      
</ul>




<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Teknik</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">

	
	<li>
	<a href='?pages=sintertp&act=tambah3'><i class='icon-forward'></i>Buat Permohonan SPPTek <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=sintertp'><i class='icon-forward'></i>Daftar Permohonan SPPTek <span class='badge badge-info pull-right'></span></a>
	</li>
	<? 
if ($_SESSION[cv]=='62'){
	?>
	 <li>
	<a href='?pages=usrtpl'><i class='icon-forward'></i>Daftar SPPTek WorkPermit <span class='badge badge-info pull-right'></span></a>
	</li>
<?php
}
?>
	<? 
if ($_SESSION[cv]=='80' or $_SESSION[cv]=='11' or $_SESSION[cv]=='12' or $_SESSION[cv]=='13'  or $_SESSION[cv]=='14'  or $_SESSION[cv]=='15' or $_SESSION[cv]=='16' or $_SESSION[cv]=='17' or $_SESSION[cv]=='18' or $_SESSION[cv]=='19' or $_SESSION[cv]=='20' or $_SESSION[cv]=='21'){
	?>
	 <li>
	<a href='?pages=usrtp'><i class='icon-forward'></i>Daftar SPPTek Masuk (Teknik) <span class='badge badge-info pull-right'></span></a>
	</li>
	
		<li>
		<?php
	$thnbln=date("Y-m");
	$kata2 = trim ($thnbln) ;
    $kata3 = trim ($_SESSION[bagianuser]);
	
  $pisah_kata = explode(" ",$kata2);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

    $cari = "SELECT * FROM pemeliharaan WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tgl_pemeliharaan LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= "";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

	   	$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<a href='?pages=pemeliharaan'><i class='icon-list-alt'></i><strong>Pemeliharaan <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=pemeliharaan'><i class='icon-list-alt'></i>Pemeliharaan Teknik</a>";
		}
		?>
	</li>
	<?
	}
//	}
	?>


	  </ul>
      </li>
      
</ul>


<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Tiket Sistem IT</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">

	<li>
	<a href='?pages=sinterit&act=tambah3'><i class='icon-forward'></i>Buat Tiket Sistem IT <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=sinterit'><i class='icon-forward'></i>Daftar Tiket Sistem IT <span class='badge badge-info pull-right'></span></a>
	</li>
	<? 
	if ($_SESSION[cv]=='75'){
	?>
	<li>
	<a href='?pages=usrti'><i class='icon-forward'></i>Tiket Sistem IT Masuk <span class='badge badge-info pull-right'></span></a>
	</li>
	
<?php	
	}
	?>


	  </ul>
      </li>
      
</ul>




<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

		
		<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Penyimpangan (NCP)-Trial</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM ncinter WHERE ncpengirim1='$_SESSION[cv]' AND ncstatus='N' OR ncpengirim2='$_SESSION[cv]' AND ncstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ncinter'><i class='icon-arrow-left'></i><strong>Penyimpangan <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=ncinter'><i class='icon-arrow-left'></i>Penyimpangan</a>";
		}
		?>
	</li>
	
	
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM ncinter WHERE ncpengirim1='$_SESSION[cv]' AND ncstatus='N' OR ncpengirim2='$_SESSION[cv]' AND ncstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ncinter0'target=_blank><i class='icon-arrow-left'></i>Reg. Penyimpangan ALL <span class='badge badge-info pull-right'></span></a>";
		} else {
			echo"<a href='?pages=ncinter0' target=_blank><i class='icon-arrow-left'></i>Reg. Penyimpangan ALL</a>";
		}
		?>
	</li>
<? if ($_SESSION[cv]=='3' OR $_SESSION[cv]=='51'){ ?>
	<li>
	<?php
	$sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ncinter a LEFT JOIN ncsin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ncpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ncstatus='Y' && b.sistatus = 'N'");

		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrncc'><i class='icon-arrow-right'></i><strong>ACC Usulan Penyimpangan (MPM/AMPR) <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrncc'><i class='icon-arrow-right'></i>ACC Penyimpangan (MPM/AMPR) </a>";
		}
		?>
	</li>
<? } else {  ?>

	<li>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ncinter a LEFT JOIN csin b ON a.ncid=b.ncid LEFT JOIN users c ON a.ncpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ncstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrnc'><i class='icon-arrow-right'></i><strong>ACC Penyimpangan<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrnc'><i class='icon-arrow-right'></i>ACC Penyimpangan</a>";
		}
		?>
	</li>
<? } ?>
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM ndis 
							 WHERE cId = '$_SESSION[cv]' AND iid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=rtnc'><i class='icon-forward'></i><strong>Rencana Tindaklanjut NC <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=rtnc'><i class='icon-forward'></i>Rencana Tindaklanjut NC</a>";
		}
		?>
	</li>
<? if ($_SESSION[cv]=='52' OR $_SESSION[cv]=='82'){ ?>
		<li>
	<?php
	 	$sql = mysql_query("SELECT * FROM ndis 
							 WHERE iid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='home1.php?pages=ncinter4' target=_blank><i class='icon-arrow-left'></i><strong>Reg. NCP ALL<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='home1.php?pages=ncinter4' target=_blank><i class='icon-arrow-left'></i>Reg. NCP ALL</a>";
		}
		?>
	</li>
<?php } ?>
  </ul>
      </li>
</ul>


<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-CAPA (Trial)</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM pdiss  
							 WHERE cId = '$_SESSION[cv]' AND siid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udis2'><i class='icon-forward'></i><strong>Tindaklanjuti CAPA <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=udis2'><i class='icon-forward'></i>Tindaklanjuti CAPA </a>";
		}
		?>
	</li>	

    <li>
	<?php
		$sql = mysql_query("SELECT * FROM ssurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtes'><i class='icon-arrow-right'></i><strong>Sumber CAPA<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrtes'><i class='icon-arrow-right'></i>Buat Sumber CAPA</a>";
		}
	?>
	</li>
<? if ($_SESSION[cv]=='54' OR $_SESSION[cv]=='75'){ ?>
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM pdiss  
							 WHERE siid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='home3.php?pages=udis4'><i class='icon-forward'></i><strong>All CAPA <span class='badge badge-info pull-right'></span>($j)</strong></a>";
		} else {
			echo"<a href='home3.php?pages=udis4'><i class='icon-forward'></i>All CAPA </a>";
		}
		?>
	</li>
<?php } ?>

	
	  </ul>
      </li>
	 </ul>
	 


	 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Aktiva</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
	   <li>
        <a href="https://aktiva.ekfpb.com" target=_blank><font color=black><b>E-Aktiva QRCODE</b></font></a>
      </li>
	<? 
if ($_SESSION[cv]=='75' or $_SESSION[cv]=='64' or $_SESSION[cv]=='66' or $_SESSION[cv]=='8' or $_SESSION[cv]=='55' or $_SESSION[cv]=='14' or $_SESSION[cv]=='20' or $_SESSION[cv]=='11'){

	?>
      	<li>
	   <a href='?pages=aktiva'><i class='icon-forward'></i>Kelola Aktiva <span class='badge badge-info pull-right'></span></a>
	   </li>
	   <li>
	   <a href='?pages=riwayat'><i class='icon-forward'></i>Riwayat <span class='badge badge-info pull-right'></span></a>
	   </li>
	    <li>
	   <a href='?pages=area'><i class='icon-forward'></i>Area/ Ruangan <span class='badge badge-info pull-right'></span></a>
	   </li>
	   <? } ?>
	 </ul>
	 </li>
	 </ul>

	 
	 

	 
	 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
	<li>
        <a href="?pages=sarmut"><font color=black><b>Menu E-TargetMutu (Beta)</b></font></a>
	<li>
	  </ul>
	  
	  	 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	
	<li>
        <a href="https://batch.ekfpb.com" target=_blank><font color=black><b>Menu E-TrackQRCode (Beta)</b></font></a>
	<li>
	 </ul>