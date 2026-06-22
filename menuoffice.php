

<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Menu E-Office</font></div>
	</div>
	
	 <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">E-Office <span class="caret"></span></a>
        <ul class="dropdown-menu">
	
	
	<li>
	<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' OR sipengirim2='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=sinter'><i class='icon-arrow-left'></i><strong>Memo/Undangan Internal <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=sinter'><i class='icon-arrow-left'></i>Memo/Undangan Internal </a>";
		}
		?>
	</li>
	<li>
	<?php
        $sql = mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'");
	
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo/Undangan Masuk<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrt'><i class='icon-arrow-right'></i>Memo/Undangan Masuk</a>";
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
	


	<? if ($_SESSION[levelcv]==0 or $_SESSION[cv]==79){ ?>
	
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
      <li>
	<?php
	    $sql = mysql_query("SELECT * FROM sinter WHERE sipengirim='$_SESSION[cv]' AND sstatus='N' OR sipengirim1='$_SESSION[cv]' AND sstatus='N' OR sipengirim2='$_SESSION[cv]' AND sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=sinter'><i class='icon-arrow-left'></i><strong>Memo/Undangan Internal <span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=sinter'><i class='icon-arrow-left'></i>Memo/Undangan Internal </a>";
		}
		?>
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
			echo"<a href='?pages=usrt'><i class='icon-arrow-right'></i><strong>Memo/Undangan Masuk<span class='badge badge-info pull-right'></span></strong></a>";
		} else {
			echo"<a href='?pages=usrt'><i class='icon-arrow-right'></i>Memo/Undangan Masuk</a>";
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
	
	
	
</ul>