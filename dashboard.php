<?php


	$qsi_ttl = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y'"));
	$qsi_urd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'"));
	$qsi_rd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN psin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'Y'"));
		
	$qsi = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.psid) FROM psin b WHERE a.cId=b.cId) AS ttl,
						(SELECT COUNT(c.psid) FROM psin c WHERE a.cId=c.cId AND c.sistatus='N') AS urd,
						(SELECT COUNT(d.psid) FROM psin d WHERE a.cId=d.cId AND d.sistatus='Y') AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$i=mysql_fetch_array($qsi);
	
	$tsi_ttl = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y'"));
	$tsi_urd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'N'"));
	$tsi_rd = mysql_num_rows(mysql_query("SELECT a.*,b.*,c.cNama FROM sinter a LEFT JOIN tsin b ON a.siid=b.siid LEFT JOIN users c ON a.sipengirim1=c.cId WHERE b.cId='$_SESSION[cv]' && a.sstatus='Y' && b.sistatus = 'Y'"));
	
	$tsi = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.tsid) FROM tsin b WHERE a.cId=b.cId) AS ttl,
						(SELECT COUNT(c.tsid) FROM tsin c WHERE a.cId=c.cId AND c.sistatus='N') AS urd,
						(SELECT COUNT(d.tsid) FROM tsin d WHERE a.cId=d.cId AND d.sistatus='Y') AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$t=mysql_fetch_array($tsi);
	
	$qds = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.pdid) FROM pdis b WHERE a.cId=b.cId AND b.iid=0) AS ttl,
						(SELECT COUNT(c.pdid) FROM pdis c WHERE a.cId=c.cId AND c.psTglbaca='0000-00-00' AND c.iid=0) AS urd,
						(SELECT COUNT(d.pdid) FROM pdis d WHERE a.cId=d.cId AND d.psTglbaca<>'0000-00-00' AND d.iid=0) AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$d=mysql_fetch_array($qds);
	
	$qdt = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.pdid) FROM pdis b WHERE a.cId=b.cId AND b.siid=0) AS ttl,
						(SELECT COUNT(c.pdid) FROM pdis c WHERE a.cId=c.cId AND c.psTglbaca='0000-00-00' AND c.siid=0) AS urd,
						(SELECT COUNT(d.pdid) FROM pdis d WHERE a.cId=d.cId AND d.psTglbaca<>'0000-00-00' AND d.siid=0) AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$s=mysql_fetch_array($qdt);
	
	$qts = mysql_query("SELECT a.cId,a.cNama, 
						(SELECT COUNT(b.pdid) FROM tdis b WHERE a.cId=b.cId AND b.tampil='Y') AS ttl,
						(SELECT COUNT(c.pdid) FROM tdis c WHERE a.cId=c.cId AND c.psTglbaca='0000-00-00' AND c.tampil='Y') AS urd,
						(SELECT COUNT(d.pdid) FROM tdis d WHERE a.cId=d.cId AND d.psTglbaca<>'0000-00-00' AND d.tampil='Y') AS rd
						FROM users a WHERE a.cId='$_SESSION[cv]'");
	$te=mysql_fetch_array($qts);
?>
<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Memo Masuk Internal</font></div>
</div>
<div class="row-fluid">
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-error" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Total Memo Internal</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><? echo"$qsi_ttl"; ?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-info" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Belum Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><? echo"$qsi_urd"; ?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-success" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><? echo"$qsi_rd"; ?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
</div>

<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Tembusan Memo Masuk Internal</font></div>
</div>
<div class="row-fluid">
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-error" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Total Tembusan Memo Internal</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><? echo"$tsi_ttl"; ?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-info" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Belum Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><? echo"$tsi_urd"; ?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-success" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><? echo"$tsi_rd"; ?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
</div>

<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Disposisi</font></div>
</div>
<div class="row-fluid">
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-error" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Total Disposisi</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$d[ttl];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-info" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Belum Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$d[urd];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-success" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$d[rd];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
</div>

<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Tela'ahan</font></div>
</div>
<div class="row-fluid">
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-error" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Total Tela'ahan</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$te[ttl];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-info" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Belum Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$te[urd];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-success" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$te[rd];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
</div>

<div class="navbar navbar-inner block-header">
	<div class="muted pull-left"><font color=black>Change Control</font></div>
</div>
<div class="row-fluid">
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-error" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Total Change Control</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$s[ttl];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-info" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Belum Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$s[urd];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
	<div class="span4">
	<div class="block-content collapse in">
		<div class="alert alert-block alert-success" style="padding: 10px 10px 8px 10px;">
		<h4 class="alert-heading">Terbaca</h4><hr />
		<div style="padding:0px 10px 10px 10px;">
		<center>
		<h3><?=$s[rd];?></h3>
		</center>
		</div>
		</div>
	</div>
	</div>
</div>

