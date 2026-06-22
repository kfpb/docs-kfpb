<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Menu Surat Ekt. (A)</div>
	</div>
	 <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
        <ul class="dropdown-menu">
	<li>
	<?php
		$sql = mysql_query("SELECT * FROM ssurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=suin'><i class='icon-arrow-right'></i> Surat Masuk <span class='badge badge-info pull-right'></span></a>";
		} else {
			echo"<a href='?pages=suin'><i class='icon-arrow-right'></i> Surat Masuk</a>";
		}
		?>
	</li>
	<li>	
		<a href="?pages=sout"><i class="icon-arrow-left"></i> Surat Keluar</a>
	</li>
		 </ul>
      </li>
      <li>
	<?php
		$sql = mysql_query("SELECT * FROM ssurat 
							 WHERE ikepada = '$_SESSION[cv]'
							 AND istatus = 'N'");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=suin'><i class='icon-arrow-right'></i> Surat Masuk <span class='badge badge-info pull-right'></span></a>";
		} else {
			echo"<a href='?pages=suin'><i class='icon-arrow-right'></i> Surat Masuk</a>";
		}
		?>
	</li>
</ul>