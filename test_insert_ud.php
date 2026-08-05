<?php
include "config/koneksi.php";
$q = mysql_query("INSERT INTO udokumen (udtgl, udpengusul, udpengusul2, udkepada, jenisud, ukodok, udrev, ccstatus, ujudok, udket, uccnmr, kode_aktivitas) VALUES ('2026-08-03', '0', '0', '1', '1', 'TEST', '0', 'N', 'TEST', 'TEST', 'TEST', 'DOK-12345')");
if (!$q) {
    file_put_contents('test_db_error.txt', "ERROR: " . mysql_error());
} else {
    file_put_contents('test_db_error.txt', "SUCCESS");
    mysql_query("DELETE FROM udokumen WHERE uid = " . mysql_insert_id());
}
?>
