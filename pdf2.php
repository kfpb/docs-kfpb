<?php
session_start();

if (empty($_SESSION[username]) AND empty($_SESSION[passuser])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses PDF, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{

mysql_connect("localhost", "u1076510_bnjku", "kfpb16081971");
mysql_select_db("u1076510_bnj");

      $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
       $r    = mysql_fetch_array($edit);
   
    echo "<html><head>
	<SCRIPT language=JavaScript>
	var message = 'Maaf, Tidak boleh klik kanan! (SPD-MR)'; 
	function rtclickcheck(keyp){ if (navigator.appName == 'Netscape' && keyp.which == 3){ 	alert(message); return false; } 
	if (navigator.appVersion.indexOf('MSIE') != -1 && event.button == 2) { 	alert(message); 	return false; } } 
	document.onmousedown = rtclickcheck;
</SCRIPT><title>Dok. Elekronik Terkendali : $r[kode_dok] - $r[judul_dok]</title></head>
<body>
	<iframe width='100%' height='100%' src='http://ekfpb.com/bnj/m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf'></iframe>
 </body>";

//  <iframe width='100%' height='100%' src='http://ekfpb.com/bnj/dok/web/viewer.html?file=/m/master_pdf/$r[id_jendok]/$r[kode_dok].pdf'></iframe>
}
  ?>