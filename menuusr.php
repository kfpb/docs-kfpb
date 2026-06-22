<?php
    session_start();
    $userId = $_SESSION[cv]; // Ambil ID user dari session
    // var_dump($userId);
    // Hitung notifikasi yang belum dilihat
    $query = "SELECT COUNT(*) as total_notif 
              FROM notifikasi_status_permintaan_bets 
              WHERE user_id = '$userId' AND sudah_dilihat = 'N'";
    $result = mysql_query($query);
    $data = mysql_fetch_assoc($result);
    
    $notifCount = $data['total_notif'];
    
    $getdatabaca = "
                    SELECT COUNT(*) as total_notif 
                    FROM notifikasi_status_permintaan_bets ns
                    INNER JOIN permintaan_dokumen_batch pdb ON ns.id_permintaan = pdb.id_permintaan
                    WHERE ns.user_id = '$userId' 
                      AND ns.sudah_dilihat = 'Y' 
                      AND pdb.status = 'dicetak'
                ";

    $resultdatabaca = mysql_query($getdatabaca);
    $databaca = mysql_fetch_assoc($resultdatabaca);
    
    $notifCountCetak = $databaca['total_notif'];
    
    // Tampilkan notifikasi di navbar
    if ($notifCount > 0) {
    
        echo "<ul class='nav nav-list bs-docs-sidenav nav-collapse collapse'>
                <div class='navbar navbar-inner block-header'>
                    <div class='muted pull-left'><strong><font color=black>Notifikasi</font></strong></div>
                </div>
                <li>";
        echo "<a href='?pages=dinterebr'><i class='icon-list-alt'></i><strong> Permintaan Copy Batch Record<span class='badge badge-info pull-right'>$notifCount</span></strong></a>";
    } 
    elseif($notifCountCetak > 0) {
         echo "<ul class='nav nav-list bs-docs-sidenav nav-collapse collapse'>
                <div class='navbar navbar-inner block-header'>
                    <div class='muted pull-left'><strong><font color=black>Notifikasi</font></strong></div>
                </div>
                <li>";
        echo "<a href='?pages=dinterebr'><i class='icon-list-alt'></i><strong> Permintaan Copy Batch Record Dicetak<span class='badge badge-info pull-right'>$notifCountCetak</span></strong></a>";
    }
    echo "</li></ul>";
?>


<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	    <div class="muted pull-left"><strong><font color=black>Menu e-Dokumen</font></strong></div>
	</div>

	 <li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dinter a LEFT JOIN dsin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = @mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrdin'><i class='icon-list-alt'></i><strong>Daftar Dokumen Internal<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdin'><i class='icon-list-alt'></i>Daftar Dokumen Internal</a>";
		}
		?>
	</li>

    <li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dinter a LEFT JOIN dsin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = @mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrdin&act=dokinterobsolate''><i class='icon-list-alt'></i><strong>Daftar Dokumen Internal (Obsolate)<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdin&act=dokinterobsolate'><i class='icon-list-alt'></i>Daftar Dokumen Internal (Obsolate)</a>";
		}
		?>
	</li>
    
	  <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen 
							 WHERE udpengusul2 = '$_SESSION[cv]'
							 AND udstatus2 = 'N' AND ccstatus = 'N'");
							 // AND cctgl_status!=null
		$j = @mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i><strong>Usulan Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i>Usulan Dokumen</a>";
		}
	?>
	</li>
	
		<li>
	    <?php
	
			if(in_array($_SESSION['cv'], [71, 78, 76, 72])){
			        echo"<a href='?pages=dinterebr'><i class='icon-arrow-right'></i> Permintaan Copy Batch Record</a>";
			}elseif(in_array($_SESSION['cv'], [92, 90, 71, 35, 27, 26, 38, 39, 40, 58, 57, 49, 48, 47, 46, 45, 44, 40, 39, 36, 33, 32, 30, 28, 7, 37, 34, 29, 31])){
			        echo"<a href='?pages=dinterebr'><i class='icon-arrow-right'></i> Permintaan Copy Batch Record</a>";
			    
			}
		?>
	</li>
	
<li>
		<?php
		$sql = mysql_query("SELECT * FROM uddis  
 							 WHERE cId ='$_SESSION[cv]' AND psACC='N'");
// 		$sql = mysql_query("SELECT * FROM uddis  
// 							 WHERE cId ='$_SESSION[cv]' AND psTglselesai='0000-00-00' OR cId ='$_SESSION[cv]' AND psTglselesai IS NULL");
		$j = @mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udok'><i class='icon-forward'></i><strong>Koreksi Usulan Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=udok'><i class='icon-forward'></i>Koreksi Usulan Dokumen <span class='badge badge-info pull-right'></span></a>";
		}
		?>
	</li>	
	
		<li>
	<?php
	
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dister a LEFT JOIN disin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
		$smasuk = mysql_query("
            SELECT a.*, b.*, c.cIdjab 
            FROM dister a 
            LEFT JOIN disin b ON a.suid_dinter = b.suid 
            LEFT JOIN users c ON a.dipengirim = c.cId 
            WHERE b.cId = '$_SESSION[cv]' 
            AND a.distatus = 'Y' AND b.distatus = 'N'
        ");
        
        // $smasuk = mysql_query("
        //     SELECT a.*, b.*, c.cIdjab 
        //     FROM dister a 
        //     LEFT JOIN disin b ON a.suid_dinter = b.suid 
        //     LEFT JOIN users c ON a.dipengirim = c.cId 
        //     WHERE b.cId = '$_SESSION[cv]' 
        //     AND a.distatus = 'Y' 
        //     GROUP BY a.suid 
        //     ORDER BY a.ditgl DESC
        // ");
        
		$j = @mysql_num_rows($smasuk);
		if($j > 0){
			echo"<a href='?pages=usrd'><i class='icon-list-alt'></i><strong>Distribusi Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrd'><i class='icon-list-alt'></i>Distribusi Dokumen Masuk<span class='badge badge-info pull-right'></span></a>";
		}
		?>
	</li>
	<li>
	<?php
	    $sql = mysql_query("SELECT * FROM copydok WHERE okepada='$_SESSION[cv]' AND sstatus='N' OR opengirim='$_SESSION[cv]' AND sstatus='N'");
		$j = @mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i><strong>Permintaan Copy Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i>Permintaan Copy Dokumen<span class='badge badge-info pull-right'></span></a>";
		}
		?>
	
	</li>
	<?php
    	if (in_array($_SESSION['cv'], [
        // SISDOK
        0, 1, 51, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057, 
        // PENGDOK
        50, 22, 1003, 1061, 1062, 1063,
        // PRODUKSI
        92, 90, 74, 71, 35, 27, 26, 38, 39, 40, 30, 36,
        // PENDUKUNG TEKNIS
        46, 49, 48, 47, 59, 
        // PPC
        71, 72, 78, 76, 
        // MANAGER
        2, 26, 3,
        //itsupport
         75,
        //cc
        51, 55, 81, 99, 1060
    ])) {
	?>
	<li>
		<a href="?pages=dinterebr"><i class="icon-list-alt"></i> Permintaan Copy Batch Record</a>
	</li>
	<?php  }?>
	
		<li>
	<?php
	$thnbln=date("Y-m");
	$kata2 = trim ($thnbln) ;
    $kata3 = trim ($_SESSION[cv]);
	
//   $pisah_kata = explode(" ",$kata2);
//   $jml_katakan = (integer)count($pisah_kata);
//   $jml_kata = $jml_katakan-1;
//     $cari = "SELECT * FROM dinter WHERE " ;
//     for ($i=0; $i<=$jml_kata; $i++){
        
//       $cari .= "ditgl_review LIKE '%$pisah_kata[$i]%'";
//       if ($i < $jml_kata ){
//         $cari .= " OR ";
//       }
//     }
    
// // var_dump($kata2);die();
//   $cari .= " and dipjdok=$kata3";
//   $hasil  = mysql_query($cari);
//   $ketemu = @mysql_num_rows($hasil);

// 	   	$j = @mysql_num_rows($hasil);
	   	
	   	
// 	   	$data = mysql_query("SELECT *, datediff(ditgl_review,current_date()) as sisa from dinter
//                                 where dipjdok='$_SESSION[cv]' and datediff(ditgl_review,current_date()) BETWEEN 1 and 30");

	//codingan sementara
	$data = mysql_fetch_array(mysql_query("SELECT *, datediff(ditgl_review,current_date()) as sisa FROM dinter where dipjdok='$_SESSION[cv]' and datediff(ditgl_review,current_date()) BETWEEN 1 and 60"));
	if($data == null){
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
	}else{
	     $hasil = mysql_query("SELECT *, datediff(ditgl_review,current_date()) as sisa FROM dinter
                                where dipjdok='$_SESSION[cv]' and datediff(ditgl_review,current_date()) BETWEEN 1 and 60");
                                
	   
	}
		$s = @mysql_num_rows($hasil);
		if($s > 0){
			echo"<a href='?pages=usrdrvw'><i class='icon-list-alt'></i><strong>Review Dokumen <span class='badge badge-info pull-right'>$s</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdrvw'><i class='icon-list-alt'></i>Review Dokumen <span class='badge badge-info pull-right'></span></a>";
		}
		?>
	</li>
	<li>
	<?php
	if (in_array($_SESSION['cv'], [
        // SISDOK
        0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057, 
        // PENGDOK
        50, 22, 1003, 1061, 1062, 1063, 
        // MANAGER
        2, 26, 3,
        //IT Support
        75,
        //cc
        51, 55, 81, 99, 1060
    ])) {
	if($_SESSION[cv]!=1000){
	  $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM dister a LEFT JOIN disin b ON a.suid=b.suid LEFT JOIN users c ON a.dipengirim=c.cId WHERE b.cId='$_SESSION[cv]' && a.distatus='Y' && b.distatus = 'N'");
	
		$j = @mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=aktivitas_dokumen'><i class='icon-list-alt'></i><strong> Audit Trail Dokumen<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=aktivitas_dokumen'><i class='icon-list-alt'></i> Audit Trail</a>";
		}
	}
        
    }
		?>
	</li>	
		