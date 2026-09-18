<?php
if ($_POST['struktur']=='baru')
{
// include "config/koneksi_user.php";
include "config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = trim(anti_injection($_POST['username']));
$pass     = trim(anti_injection(md5($_POST['password'])));

// pastikan username dan password adalah karakter yang valid (huruf, angka, underscore, titik, strip).
if (!preg_match('/^[a-zA-Z0-9_.-]+$/', $username) OR !ctype_alnum($pass)){
  header('location:index.php');
}else{
	$login=mysql_query("SELECT * FROM users WHERE cUser='$username' AND cPass='$pass'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	
	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		session_start();
		include "timeout.php";
		$_SESSION[cv]      = $r[cId];
		$j = mysql_fetch_array(mysql_query("SELECT jabatan FROM jabatan WHERE idj='$r[idj]'"));
    		$_SESSION[nppcv]     = $r[cUser];
    		$_SESSION[namacv]    = $r[cNama];
    		$_SESSION[passcv]    = $r[cPass];
    		$_SESSION[jabatan]   = $r[cJabatan];
    		$_SESSION[jabatancv] = $j[jabatan];
    		$_SESSION[levelcv]   = $r[idj];
    		$_SESSION[idjab]     = $r[cIdjab];
    		$_SESSION[atasan]    = $r[cAtasan];
    		$_SESSION[idj]       = $r[idj];
		
          $_SESSION[namauser]     = $r[cUser];
          $_SESSION[namalengkap]  = $r[cNama];
          $_SESSION[passuser]     = $r[cPass];
          $_SESSION[leveluser]    = $r[level];
          $_SESSION[leveluser2]    = $r[level];
          $_SESSION[bagian]        = $r[cIdjab];
          $_SESSION[bagian2]        = $r[bagian2]; 
          $_SESSION[bagianuser]    = $r[cIdjab];
          $is_pkpa_user = ((isset($r['is_pkpa']) && $r['is_pkpa'] == 'Y') || (stripos($r['cUser'], 'pkpa') !== false));
          $_SESSION['is_pkpa']     = $is_pkpa_user ? 'Y' : 'N';
          $_SESSION['tgl_expired'] = isset($r['tgl_expired']) ? $r['tgl_expired'] : '';
		
		// session timeout
 
		$_SESSION[loginefile] = 1;
	
// 		timer();
		$sid_lama = session_id();
		session_regenerate_id();
		$sid_baru = session_id();
		mysql_query("UPDATE users SET cSession='$sid_baru' WHERE cId='$r[cId]'");
		
		
			
		// Function to get the client IP address
        // function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
              $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            // return $ipaddress;
        // }
	
	
            function getBrowser() { 
              $u_agent = $_SERVER['HTTP_USER_AGENT'];
              $bname = 'Unknown';
              $platform = 'Unknown';
              $version= "";
            
              //First get the platform?
              if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
              }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
              }elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
              }
            
              // Next get the name of the useragent yes seperately and for good reason
              if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
              }elseif(preg_match('/Firefox/i',$u_agent)){
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
              }elseif(preg_match('/OPR/i',$u_agent)){
                $bname = 'Opera';
                $ub = "Opera";
              }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Google Chrome';
                $ub = "Chrome";
              }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Apple Safari';
                $ub = "Safari";
              }elseif(preg_match('/Netscape/i',$u_agent)){
                $bname = 'Netscape';
                $ub = "Netscape";
              }elseif(preg_match('/Edge/i',$u_agent)){
                $bname = 'Edge';
                $ub = "Edge";
              }elseif(preg_match('/Trident/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
              }
            
              // finally get the correct version number
              $known = array('Version', $ub, 'other');
              $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
              if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
              }
              // see how many we have
              $i = count($matches['browser']);
              if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }else {
                    $version= $matches['version'][1];
                }
              }else {
                $version= $matches['version'][0];
              }
            
              // check if we have a number
              if ($version==null || $version=="") {$version="?";}
            
              return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
              );
            } 
            
            
	   //mengecek apakah user menginput captcha dengan benar
	    //jika captcha salah, maka akan menjalankan yang pertama
	    if ($_SESSION["code"] != $_POST["kodecaptcha"]) {
		  //  echo "Username anda adalah <b>$_SESSION[username]</b>"; echo "<br />";
		  //  echo "Password anda adalah <b>$_SESSION[password]</b>"; echo "<br />"; echo "<br/>";
		  //  echo "Kode CAPTCHA anda salah";
		    echo "<script>alert('Maaf, Ulangi CAPTCHA...!'); parent.location = 'index.php';</script>";
		    session_destroy();
		} else { // jika captcha benar, maka perintah yang bawah akan dijalankan
            $ua=getBrowser();
            $yourbrowser= $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];

            // 1. Validasi Khusus Akun PKPA (Masa Berlaku 30 Hari & Status Akun)
            if (isset($r['is_pkpa']) && $r['is_pkpa'] == 'Y') {
                $today = date('Y-m-d');
                if (isset($r['status_akun']) && $r['status_akun'] == 'dibekukan') {
                    echo "<script>alert('Akun PKPA Anda telah dinonaktifkan / dibekukan oleh Supervisor Sistem Dokumentasi.'); parent.location = 'index.php';</script>";
                    session_destroy();
                    exit;
                }
                if (!empty($r['tgl_expired']) && $today > $r['tgl_expired']) {
                    @mysql_query("INSERT INTO log_audit_trail (username, nama_user, kategori, detail_kegiatan, ip_address, status_anomali) 
                                  VALUES ('$r[cUser]', '$r[cNama]', 'EXPIRED_ATTEMPT', 'Mencoba login dengan akun PKPA yang sudah kadaluarsa (Expired: $r[tgl_expired])', '$ipaddress', 'PERINGATAN')");
                    @mysql_query("UPDATE users SET status_akun='expired' WHERE cId='$r[cId]'");
                    echo "<script>alert('Masa berlaku akun PKPA Anda telah berakhir (30 hari sejak dibuat). Anda tidak dapat login lagi. Silakan hubungi Supervisor Sistem Dokumentasi.'); parent.location = 'index.php';</script>";
                    session_destroy();
                    exit;
                }
            }

            // 2. Pelacakan Perangkat PC (Device Token & Soft Enforcement)
            $device_token = !empty($_COOKIE['kfpb_device_id']) ? $_COOKIE['kfpb_device_id'] : '';
            if (empty($device_token)) {
                $device_token = md5($ipaddress . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '') . microtime());
                setcookie('kfpb_device_id', $device_token, time() + (86400 * 365), "/");
            }
            $_SESSION['device_token'] = $device_token;

            // Cek apakah PC ini sudah pernah terdaftar untuk user ini
            $cek_dev = mysql_query("SELECT * FROM user_registered_devices WHERE username='$r[cUser]' AND device_token='$device_token'");
            if (!$cek_dev || mysql_num_rows($cek_dev) == 0) {
                // Hitung total PC terdaftar sebelumnya
                $q_c = mysql_query("SELECT COUNT(*) as total FROM user_registered_devices WHERE username='$r[cUser]'");
                $d_c = ($q_c) ? mysql_fetch_assoc($q_c) : array('total' => 0);
                $device_seq = intval($d_c['total']) + 1;

                // Daftarkan PC baru ini
                $uagent_esc = mysql_real_escape_string($yourbrowser);
                @mysql_query("INSERT INTO user_registered_devices (user_id, username, device_token, device_sequence, ip_address, user_agent, login_count, status) 
                              VALUES ('$r[cId]', '$r[cUser]', '$device_token', '$device_seq', '$ipaddress', '$uagent_esc', 1, 'aktif')");

                if (isset($r['is_pkpa']) && $r['is_pkpa'] == 'Y') {
                    if ($device_seq > 1) {
                        $_SESSION['peringatan_device_baru'] = array(
                            'device_sequence' => $device_seq,
                            'ip_address' => $ipaddress
                        );
                        @mysql_query("INSERT INTO log_audit_trail (username, nama_user, kategori, detail_kegiatan, ip_address, device_token, device_sequence, status_anomali) 
                                      VALUES ('$r[cUser]', '$r[cNama]', 'ANOMALI_DEVICE', 'Login dari PC baru (Perangkat ke-$device_seq) dengan IP $ipaddress', '$device_token', '$device_seq', 'PERINGATAN')");
                    } else {
                        @mysql_query("INSERT INTO log_audit_trail (username, nama_user, kategori, detail_kegiatan, ip_address, device_token, device_sequence, status_anomali) 
                                      VALUES ('$r[cUser]', '$r[cNama]', 'LOGIN', 'Login pertama kali - PC Utama (Perangkat ke-1) terdaftar', '$device_token', 1, 'NORMAL')");
                    }
                }
            } else {
                // PC sudah terdaftar
                $dev_row = mysql_fetch_assoc($cek_dev);
                @mysql_query("UPDATE user_registered_devices SET last_login=NOW(), login_count=login_count+1, ip_address='$ipaddress' WHERE id='$dev_row[id]'");
                if (isset($r['is_pkpa']) && $r['is_pkpa'] == 'Y') {
                    @mysql_query("INSERT INTO log_audit_trail (username, nama_user, kategori, detail_kegiatan, ip_address, device_token, device_sequence, status_anomali) 
                                  VALUES ('$r[cUser]', '$r[cNama]', 'LOGIN', 'Login normal dari Perangkat ke-$dev_row[device_sequence]', '$device_token', '$dev_row[device_sequence]', 'NORMAL')");
                }
            }

            // Catat log activity bawaan sistem
    		$q=mysql_query("INSERT INTO log_activity(user,
                                      jabatan,
                                      action,
                                      ip_address,
                                      user_agent ) 
    	                     VALUES('$_SESSION[namacv]',
    	                            '$_SESSION[jabatan]',
    	                            'login',
    	                            '$ipaddress',
    	                            '$yourbrowser'
    	                     )");
	                     
			echo "<script>parent.location = 'home.php';</script>";
			exit;
		}
		
// 		header('location:home.php');
	}else{
		echo "<script>alert('Punten..Username atau Password Salah..!'); parent.location = 'index.php';</script>";
	}
}
}else{
    echo "<script>alert('Punten Salah..!'); parent.location = 'index.php';</script>";
}
?>
