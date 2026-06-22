<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Menu Memo Int. (A)</div>
	</div>
	 <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
        <ul class="dropdown-menu">
	<li>
		<a href="?pages=sinter"><i class="icon-retweet"></i> Memo Internal</a>
	</li>
	<li>
	<?
	$sql = mysql_query("SELECT * FROM pdis 
							 WHERE cId = '$_SESSION[cv]'
							 AND psTglbaca ='0000-00-00' OR cId = '$_SESSION[cv]'
							 AND psTglbaca IS NULL");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<a href='?pages=udis'><i class='icon-forward'></i><strong> Disposisi <span class='badge badge-info pull-right'>$j</span></strong></a>";
		} else {
			echo"<a href='?pages=udis'><i class='icon-forward'></i> Disposisi</a>";
		}
		?>
		</li>
	</ul>
      </li>
</ul>