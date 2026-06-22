<?php if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057, 50])){?>
			
				<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><strong><font color=black>Menu Admin Dokumentasi</font></strong></div>
	</div>

	<li>
		<a href="?pages=dinter"><i class="icon-list-alt"></i> Daftar Dokumen Internal</a>
	</li>
	
	<?php if(in_array($_SESSION['cv'], [50])){?>
	
	<li>
		<a href="home.php?pages=dinter&act=rdtcc"><i class="icon-list-alt"></i> Registrasi Dokumen Terkendali CC</a>
	</li>
	<?php } ?>
	<li>
	<?php
	
			if(in_array($_SESSION['cv'], [0, 1, 53, 51, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){
        	    $copybatch = mysql_query("SELECT * FROM permintaan_dokumen_batch WHERE status='diminta'");
        	}
        	
		$sb = mysql_num_rows($copybatch);
		
		if($sb > 0){
			echo"<a href='?pages=dinterebr'><i class='icon-arrow-right'></i><strong> Permintaan Copy Batch Record<span class='badge badge-info pull-right'>$sb</span></strong></a>";
		}else{
			echo"<a href='?pages=dinterebr'><i class='icon-arrow-right'></i> Permintaan Copy Batch Record</a>";
		    
		}?>
	</li>
	
			  <li>
	<?php
	
			if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){
	    $sql = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND udtgl_terima='0000-00-00' AND ccstatus='Y'");
		
	}
    /*
	else{
	    $sql = mysql_query("SELECT * FROM udokumen WHERE ccstatus='N' AND udtgl_terima='0000-00-00' OR udtgl_selesai='0000-00-00' OR udtgl_terima IS NULL OR udtgl_selesai IS NULL");
	}
	*/
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i><strong> Usulan Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i> Usulan Dokumen</a>";
		}
	?>
	</li>
	  <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen WHERE ccstatus='Y' AND udtgl_terima!='0000-00-00' AND udtgl_selesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok2'><i class='icon-arrow-right'></i><strong> Usulan Dokumen InProses<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok2'><i class='icon-arrow-right'></i> Usulan Dokumen InProses</a>";
		}
	?>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen WHERE ccstatus='Y' AND udtgl_terima!='0000-00-00' AND udstatus1='N'");
		
// 		$udmasuk = mysql_query("SELECT a.*, b.cNama, b.cIdjab FROM udokumen a, users b WHERE a.udpengusul=b.cId AND a.ccstatus='Y' AND a.udtgl_terima!='0000-00-00' AND a.udstatus1='N' ORDER BY a.udtgl_kembali DESC");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok3'><i class='icon-arrow-right'></i><strong> Usulan Dokumen Koreksi<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok3'><i class='icon-arrow-right'></i> Usulan Dokumen Koreksi</a>";
		}
	?>
	</li>
<?php /*
	 <li>
	<?php
	$sql = mysql_query("SELECT * FROM ddist WHERE cId = '2' AND psTglselesai='0000-00-00' OR cId = '2' AND psTglselesai IS NULL");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddist'><i class='icon-forward'></i><strong> Info Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddist'><i class='icon-forward'></i> Info Dokumen User</a>";
		}
	?>
	</li>
*/ 
?>

		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM copydok WHERE sstatus='N' And kirim_status='Y'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i><strong> Copy Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i> Permohonan Copy Dokumen</a>";
		}
		?>
	
	</li>
	
		</li>
		<?php
	    $sql = mysql_query("SELECT * FROM dister WHERE distatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=dister'><i class='icon-arrow-left'></i><strong> Distribusi Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"<li><a href='?pages=dister'><i class='icon-arrow-left'></i> Distribusi Dokumen </a></li>";
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
  $cari .= "";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);


	   	$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<a href='?pages=usrdrvw_admin'><i class='icon-list-alt'></i><strong> Review Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdrvw_admin'><i class='icon-list-alt'></i> Review Dokumen</a>";
		}
		?>
	</li>
			 <li>
	<?php
	$sql = mysql_query("SELECT * FROM ddis
							 WHERE cId = '$_SESSION[cv]' and psACC='N'");
// 	$sql = mysql_query("SELECT * FROM ddis
// 							 WHERE cId = '$_SESSION[cv]' AND uid=0
// 							 AND psACC='N' OR cId = '$_SESSION[cv]' AND uid=0
// 							 AND psACC='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddis'><i class='icon-forward'></i><strong> Hasil Review Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddis'><i class='icon-forward'></i> Hasil Review Dokumen</a>";
		}
	?>
	</li>
<?	/* ?>
	<li>
	<?php
	$bln=date("m");
	$bln1=$bln+1;
	$bln2='0'.$bln1;
	$thn=date("Y");
	$kata2 = trim ($thn.'-'.$bln2) ;
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
  $cari .= "";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);


	   	$j = mysql_num_rows($hasil);
		
		if($j > 0){
			echo"<a href='?pages=usrdrvw_admin2'><i class='icon-list-alt'></i><strong>Review Dokumen ($kata2) <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdrvw_admin2'><i class='icon-list-alt'></i>Review Dokumen</a>";
		}
		?>
	</li>
<? */ ?>
	
	
		<li>
	<a href="?pages=jendok"><i class="icon-tasks"></i> Jenis Dokumen</span></a>
	</li>
		
		
</ul><?php
	}elseif($_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==99 OR $_SESSION[cv]==1060 OR $_SESSION[cv]==1000){?>
				<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><strong><font color=black>Menu Admin CC</font></strong></div>
	</div>

	<li>
		<a href="home.php?pages=dinter&act=rdtcc"><i class="icon-list-alt"></i> Registrasi Dokumen Terkendali CC</a>
	</li>
			  <li>
	<?php
	if($_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==81 OR $_SESSION[cv]==99 OR $_SESSION[cv]==1060 OR $_SESSION[cv]==1000){
	    $sql = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND ccstatus='N'");
		
	}else{
	    $sql = mysql_query("SELECT * FROM udokumen WHERE udtgl_terima='0000-00-00' OR udtgl_selesai='0000-00-00' OR udtgl_terima IS NULL OR udtgl_selesai IS NULL");
		
	}
	$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i><strong> Usulan Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i> Usulan Dokumen Masuk</a>";
		}
	?>
	</li>
			
	
</ul>
<?php }elseif($_SESSION[cv]==1103 OR $_SESSION[cv]==1104 OR $_SESSION[cv]==1107 OR $_SESSION[cv]==1108){?>
		<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
            <div class="navbar navbar-inner block-header">
	            <div class="muted pull-left"><strong><font color=black>Menu Dokumen</font></strong></div>
	        </div>

        	<li>
        		<a href="?pages=dinter"><i class="icon-list-alt"></i> Daftar Dokumen Internal</a>
        	</li>
    </ul>

<?php }else{ ?>


<?php } ?>