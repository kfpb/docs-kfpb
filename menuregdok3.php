<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
   <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu Admin Dok.</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">

	<li>
		<a href="?pages=dinter"><i class="icon-list-alt"></i> Daftar Dokumen Internal</a>
	</li>
		</li>
		<?php
	    $sql = mysql_query("SELECT * FROM dester WHERE distatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=dester'><i class='icon-arrow-left'></i><strong> Kirim Dokumen Eksternal <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"<li><a href='?pages=dester'><i class='icon-arrow-left'></i> Daftar Dokumen Eksternal </a></li>";
		}
		?>
	</li>
	</li>
		<?php
	    $sql = mysql_query("SELECT * FROM dister WHERE distatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=dister'><i class='icon-arrow-left'></i><strong> ACC Distribusi Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
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
			echo"<a href='?pages=usrdrvw_admin'><i class='icon-list-alt'></i><strong>Review Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usrdrvw_admin'><i class='icon-list-alt'></i>Review Dokumen</a>";
		}
		?>
	</li>
	
	
	 <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen WHERE udtgl_terima='0000-00-00' OR udtgl_terima IS NULL");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i><strong> Usulan Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i> Usulan Dokumen </a>";
		}
	?>
	</li>
	  <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen WHERE udstatus1='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok2'><i class='icon-arrow-right'></i><strong> Usulan InProses Masuk <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok2'><i class='icon-arrow-right'></i> Usulan Dokumen InProses</a>";
		}
	?>
	</li>
	
	 <li>
	<?php
	$sql = mysql_query("SELECT * FROM ddist 
							 WHERE cId = '$_SESSION[cv]' AND uid=0
							 AND psTglselesai='0000-00-00' OR cId = '$_SESSION[cv]' AND uid=0
							 AND psTglselesai IS NULL");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddist'><i class='icon-forward'></i><strong> Info Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddist'><i class='icon-forward'></i> Info Dokumen User</a>";
		}
	?>
	</li>
			 <li>
	<?php
	$sql = mysql_query("SELECT * FROM ddis
							 WHERE cId = '$_SESSION[cv]' AND uid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddis'><i class='icon-forward'></i><strong> Hasil Review Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddis'><i class='icon-forward'></i> Hasil Review Dokumen</a>";
		}
	?>
	</li>
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM copydok WHERE sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i><strong> Copy Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i> Permohonan Copy Dokumen </a>";
		}
		?>
	
	</li>
	 </ul>
      </li>
	
	</ul>