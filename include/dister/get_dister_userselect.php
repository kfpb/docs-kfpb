<?php
include "../../config/koneksi.php";

$query = mysql_query("SELECT cId, cNama, cJabatan FROM users");
$data = array();

while ($row = mysql_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
?>