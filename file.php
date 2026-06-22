<?php
session_start();

if (empty($_SESSION[username]) AND empty($_SESSION[passuser])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses FILE, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{

mysql_connect("localhost", "u1076510_bnjku", "kfpb16081971");
mysql_select_db("u1076510_bnj");

      $edit = mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'");
       $r    = mysql_fetch_array($edit);
   
    echo "<html><head>
<body>
	<iframe width='100%' height='100%' src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].doc'></iframe>
	<iframe width='100%' height='100%'  src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].docx'></iframe>
	<iframe width='100%' height='100%'  src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].xls'></iframe>
	<iframe width='100%' height='100%'  src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].xlsx'></iframe>
 </body>";
  
}
  ?>