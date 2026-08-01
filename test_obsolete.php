<?php
require 'e:/Project/docs-kfpb/config/koneksi_user.php';
$q = mysql_query("SELECT suid, dikodok, distatus FROM dinter WHERE suid IN (39, 52)");
while($r = mysql_fetch_assoc($q)) {
    print_r($r);
}
?>
