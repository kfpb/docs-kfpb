<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Shortcut Notifikasi</font></div>
	</div>
	 <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notifikasi <span class="caret"></span></a>

	<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' OR sipengirim2='$_SESSION[cv]' AND accsipengirim1='Y' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"";
		} else {
			echo"";
		}
		?>
		
		
			<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms='33' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N' && jenisms =33 ");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtm'><i class='icon-arrow-right'></i><strong>Release Order PR Teknik <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE a.jenisms!='33' && b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo/Undgn Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
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
			echo"<li><a href='?pages=udis'><i class='icon-forward'></i><strong>Disposisi/Info Masuk <span class='badge badge-info pull-right'>$j</span></strong></a></li><li>
			<a href='?pages=pkl'><i class='icon-arrow-right'></i>Daftar PKL-Kunjungan</a></li>";
		} else {
			echo"";
		}
		?>
        <li>
	<a href='?pages=usrtm'><i class='icon-forward'></i>Daftar Order PR <span class='badge badge-info pull-right'></span></a>
	</li>

	<?php
		$sql = mysql_query("SELECT * FROM isurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
		    
		    echo"<li><a href='?pages=usrte'><i class='icon-arrow-right'></i><strong>Surat Masuk Ekstrnl<span class='badge badge-info pull-right'>$j</span></strong></a></li><li>
			<a href='?pages=pkl'><i class='icon-arrow-right'></i><strong>Daftar PKL-Kunjungan<span class='badge badge-info pull-right'></span></strong></a></li>";
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
			echo"<li><a href='?pages=utis'><i class='icon-forward'></i><strong>Tela'ahan Produk/Jasa <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

	<? 
	if ($_SESSION[levelcv]<1 or $_SESSION[cv]=='35' or $_SESSION[idj]=='9'){
	?>

	<?php
		$sql = mysql_query("SELECT * FROM tsurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=usrtl'><i class='icon-arrow-right'></i><strong>Tela'ahan Produk/Jasa <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>
	
	<? } ?>	
	
		<?php
		$sql = mysql_query("SELECT * FROM pdiss  
							 WHERE cId = '$_SESSION[cv]' AND siid=0
							 AND psTglselesai='0000-00-00'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=udis2'><i class='icon-forward'></i><strong>Tindaklanjuti Tgs & CAPA <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
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
			echo"<li><a href='?pages=usrtes'><i class='icon-arrow-right'></i><strong>Tugas & NC-CAPA <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
	?>

	<? if ($_SESSION[levelcv]<1 or $_SESSION[idj]=='9'){ ?>
	

	<?php
	    $sql = mysql_query("SELECT * FROM osurat WHERE okepada='$_SESSION[cv]' OR opengirim='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"	<li><a href='?pages=sout'><i class='icon-arrow-left'></i><strong>Surat Keluar <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
			echo"";
		}
		?>

<? } ?>

      </li>
</ul>











