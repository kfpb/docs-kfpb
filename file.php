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

       // Audit Trail Pembacaan Dokumen
       $user_logged = !empty($_SESSION['namacv']) ? $_SESSION['namacv'] : (!empty($_SESSION['username']) ? $_SESSION['username'] : 'User');
       $username_logged = !empty($_SESSION['nppcv']) ? $_SESSION['nppcv'] : (!empty($_SESSION['namauser']) ? $_SESSION['namauser'] : '');
       $dev_token = !empty($_COOKIE['kfpb_device_id']) ? $_COOKIE['kfpb_device_id'] : (!empty($_SESSION['device_token']) ? $_SESSION['device_token'] : '');
       $ip_dok = (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');

       if (!empty($username_logged) && !empty($r['kode_dok'])) {
           $judul_dok_esc = mysql_real_escape_string($r['judul_dok']);
           @mysql_query("INSERT INTO log_audit_trail (username, nama_user, kategori, detail_kegiatan, kode_dokumen, judul_dokumen, ip_address, device_token, status_anomali)
                         VALUES ('$username_logged', '$user_logged', 'VIEW_DOKUMEN', 'Membaca dokumen Office: $r[kode_dok]', '$r[kode_dok]', '$judul_dok_esc', '$ip_dok', '$dev_token', 'NORMAL')");
       }
   
    echo "<html><head>
<body>
	<iframe width='100%' height='100%' src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].doc'></iframe>
	<iframe width='100%' height='100%'  src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].docx'></iframe>
	<iframe width='100%' height='100%'  src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].xls'></iframe>
	<iframe width='100%' height='100%'  src='https://view.officeapps.live.com/op/view.aspx?src=http://ekfpb.com/bnj/m/master_dokumen/$r[id_jendok]/$r[kode_dok].xlsx'></iframe>
 </body>";
  
}
  ?>