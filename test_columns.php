<?php
require_once 'config/koneksi.php';
$q = mysql_query("SHOW COLUMNS FROM copydok_ebr");
if(!$q) die(mysql_error());
$cols = [];
while($r = mysql_fetch_assoc($q)) {
    $cols[] = $r['Field'];
}
echo implode(", ", $cols);
?>
