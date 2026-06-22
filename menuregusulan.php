<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Menu Usulan (A)</div>
	</div>
	
	 <!--<li class="dropdown">-->
  <!--      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>-->
  <!--      <ul class="dropdown-menu">-->
	<li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen WHERE udtgl_terima='0000-00-00' OR udtgl_terima IS NULL");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i><strong> Usulan Dokumen Masuk<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok'><i class='icon-arrow-right'></i> Usulan Dokumen Masuk</a>";
		}
	?>
	</li>
	  <li>
	<?php
		$sql = mysql_query("SELECT * FROM udokumen WHERE udstatus1='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=usulandok2'><i class='icon-arrow-right'></i><strong> Usulan Dokumen Proses<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=usulandok2'><i class='icon-arrow-right'></i> Usulan Dokumen Proses</a>";
		}
	?>
	</li>
	<!--<li>-->
	<!--	<a href="?pages=ccinter"><i class="icon-list-alt"></i> Usulan Perubahan (CC)</a>-->
	<!--</li>-->
		<li>
	<?php
	    $sql = mysql_query("SELECT * FROM copydok WHERE sstatus='N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i><strong> Copy Dokumen<span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=copy'><i class='icon-arrow-right'></i> Copy Dokumen</a>";
		}
		?>
	
	</li>
		 <!--</ul>-->
   <!--   </li>-->
</ul>