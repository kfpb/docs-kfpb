<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
    <div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><strong><font color=black>Shortcut Menu Teknik</font></strong></div>
	</div>

	</li>
		<?php
	    
		echo"<li><a href='?pages=usrtp'><i class='icon-arrow-right'></i><strong>SPPTek <span class='badge badge-info pull-right'>$j</span></strong></a></li>";
	
		?>
	</li>
	
	<?php
	if ($_SESSION[cv]=='10' OR $_SESSION[cv]=='11' or $_SESSION[cv]=='80' or $_SESSION[cv]=='17'){
		//acc barang teknik
	    $sql = mysql_query("SELECT sp.accpesanbarang, sp.sinmr, bt.status FROM spptek sp JOIN pesanan_barangtek bt ON
		bt.id_spptek=sp.siid WHERE sp.accpesanbarang='N' OR bt.status='' GROUP BY sp.sinmr");
	    $sqlu = mysql_query("SELECT status FROM pesanan_barangtek WHERE status=''");
		$j = mysql_num_rows($sql);
		if($j > 0){
			echo"<li><a href='?pages=approvebarangtek'><i class='icon-arrow-left'></i><strong>ACC Pembelian Barang Teknik<span class='badge badge-info pull-right'>$j</span></strong></a></li>";
		} else {
				echo"<li><a href='?pages=approvebarangtek'><i class='icon-arrow-left'></i><strong>ACC Pembelian Barang Teknik</a></li>";
		}
		
	}?>
</ul>
