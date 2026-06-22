<?php
if(($_SESSION[levelcv]==0)||($_SESSION[cv]==79)){
?>
<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><b>Menu Admin Laporan</b></div>
	</div>
    	<li>
    		<a href="?pages=aktivitas_dokumen"><i class="icon-th-list"></i> Audit Trail</a>
    	</li>
    	<li>
    		<a href="?pages=aktivitas_login"><i class="icon-user"></i> User Log</a>
    	</li>
	<!--</ul>-->
	<!--</li>-->
</ul>
<?php
}
?>