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
	<? if ($_SESSION[idj]=='3'){ 
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
							 WHERE ikepada = '$_SESSION[cv]'
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
	


	<? if ($_SESSION[levelcv]<4 or $_SESSION[idj]=='9'){ ?>
	
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
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-Teknik-Pembelian</b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
	
	<li>
	<a href='?pages=sintertp&act=tambah3'><i class='icon-forward'></i>Buat Permohonan SPPTek <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=sintertp'><i class='icon-forward'></i>Daftar Permohonan SPPTek <span class='badge badge-info pull-right'></span></a>
	</li>
	<? 
	if ($_SESSION[cv]=='2'){
	?>
    <li>
	<a href='?pages=sinterm'><i class='icon-forward'></i>Daftar Order PR Teknik <span class='badge badge-info pull-right'></span></a>
	</li>
    <? } ?>
	<li>
	<a href='?pages=sinter&act=tambah4'><i class='icon-forward'></i>Buat Permohonan RAB/PR <span class='badge badge-info pull-right'></span></a>
	</li>

<li>
		<?php
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
	if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='35' or $_SESSION[cv]=='71'){
	?>
	<li>
	<a href='?pages=usrtm'><i class='icon-forward'></i>Daftar PR TEKNIK <span class='badge badge-info pull-right'></span></a>
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
		<? 
	if ($_SESSION[cv]=='79'){
	?>
	 <li>
	<a href='?pages=usrtp'><i class='icon-forward'></i>Daftar SPPTek (Teknik) <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=sinterm'><i class='icon-forward'></i>Daftar Order PR Teknik <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=sinter&act=tambah5'><i class='icon-forward'></i>Buat Memo Rekap PR Order <span class='badge badge-info pull-right'></span></a>
	</li>
	<li>
	<a href='?pages=sinterm&act=tambah5'><i class='icon-forward'></i>Buat Memo Order-PR Teknik <span class='badge badge-info pull-right'></span></a>
	</li>
	<?
	}
	?>
	  </ul>
      </li>
      
     
      
</ul>



<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

		
		<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-ChangeControl</b></font><span class="caret"></span></a>
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
	<li>
	<?php
	$sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN ccsin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus = 'N'");

		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usracc'><i class='icon-arrow-right'></i><strong>ACC Renc.Tind. CC (MPM) <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usracc'><i class='icon-arrow-right'></i>ACC Renc.Tind. CC (MPM) </a>";
		}
		?>
	</li>
	<li>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM ccinter a LEFT JOIN csin b ON a.ccid=b.ccid LEFT JOIN users c ON a.ccpengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.ccstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrcc'><i class='icon-arrow-right'></i><strong>ACC Renc.Tind. CC<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrcc'><i class='icon-arrow-right'></i>ACC Renc.Tind. CC</a>";
		}
		?>
	</li>
	
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM cdis 
							 WHERE cId = '$_SESSION[cv]' AND iid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=rtcc'><i class='icon-forward'></i><strong>Rencana Tindakan CC <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=rtcc'><i class='icon-forward'></i>Rencana Tindakan CC</a>";
		}
		?>
	</li>
	<? if ($_SESSION[levelcv]<2){ ?>	
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM dinter WHERE distatus='N' ");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=dinter'><i class='icon-arrow-left'></i><strong>Info Dokumen Net <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=dinter'><i class='icon-arrow-left'></i>Info  Dokumen Net </a>";
		}
		?>
	</li>
		<li>
	<?php
	 	$sql = mysql_query("SELECT * FROM cdis 
							 WHERE iid=0
							 AND psTglselesai='0000-00-00'");
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
			echo"<a href='?pages=usrtd'><i class='icon-arrow-right'></i>Buat Usulan Dokumen</a>";
		}
	?>
	</li>
<li>
		<?php
		$sql = mysql_query("SELECT * FROM uddis  
							 WHERE cId ='$_SESSION[cv]' AND psTglselesai='0000-00-00'");
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
	    $sql = mysql_query("SELECT * FROM copydok WHERE okepada='$_SESSION[cv]' AND sstatus='N' OR opengirim='$_SESSION[cv]' AND otgl_admin=='0000-00-00' AND sstatus='Y'");
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
							 WHERE cId = '$_SESSION[cv]' AND uid=0
							 AND psTglselesai='0000-00-00'");
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
							 WHERE cId = '$_SESSION[cv]' AND uid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=ddis2'><i class='icon-forward'></i><strong>Arsip Review Dokumen <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=ddis2'><i class='icon-forward'></i>Arsip Review Dokumen </a>";
		}
		?>
	</li>
  </ul>
      </li>
	
</ul>

	 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color=black><b>Menu E-SDM </b></font><span class="caret"></span></a>
        <ul class="dropdown-menu">
	
	<?php
	$sql = mysql_query("SELECT * FROM linter WHERE sipengirim='$_SESSION[cv]' AND sstatus='Y' AND ssdisp='N'");
    $j = mysql_num_rows($sql);
		if($j > 0){
		echo"<li><a href='?pages=linter'><i class='icon-forward'></i>Buat e-Lembur <span class='badge badge-info pull-right'></span></a></li>";
		}
		else {
	?>
	<li>
	<a href='https://sdm.kfpb.kimiafarma.co.id'><i class='icon-forward'></i>Buat e-Lembur <span class='badge badge-info pull-right'></span></a>
	</li>
	<?php
	}
	?>
	<li>
	<a href='https://sdm.kfpb.kimiafarma.co.id'><i class='icon-forward'></i>Arsip e-Lembur <span class='badge badge-info pull-right'></span></a>
	</li>
		<li>
	<a href='https://sdm.kfpb.kimiafarma.co.id'><i class='icon-forward'></i>Persetujuan e-Lembur <span class='badge badge-info pull-right'></span></a>
	</li>
	
	<li>
		<?php
		$sql = mysql_query("SELECT * FROM ldis 
							 WHERE cId = '$_SESSION[cv]' 
							 AND psTglbaca='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='https://sdm.kfpb.kimiafarma.co.id'><i class='icon-forward'></i><strong>Hasil Lembur Masuk <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='https://sdm.kfpb.kimiafarma.co.id'><i class='icon-forward'></i>Hasil Lembur Masuk</a>";
		}
		?>
	</li>
	
	
		<li>
	<a href='https://docs.google.com/forms/d/e/1FAIpQLSe_QsJehCgWRl4c8H-IDRHXLmVLrhXPOkSsuNgOYkf8tQyzdA/viewform' target=_blank><i class='icon-forward'></i>Penilaian Kompetensi <span class='badge badge-info pull-right'></span></a>
	</li>
		<li>
	<a href='https://sdm.kfpb.kimiafarma.co.id'><i class='icon-forward'></i>Info Detail Pegawai<span class='badge badge-info pull-right'></span></a>
	</li>
	
	
		
	<? if ($_SESSION[cv]=='65' or $_SESSION[cv]=='35' or $_SESSION[cv]=='38'){ ?>
	
	<li>
	<a href='?pages=pegawai'><i class='icon-forward'></i>Data Pegawai <span class='badge badge-info pull-right'></span></a>
	</li>
		
	
	<? } ?>
	
  </ul>
      </li>
</ul>


	 
