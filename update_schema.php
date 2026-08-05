<?php
$conn = mysqli_connect("localhost", "root", "", "ekfpb_bnj");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$res = mysqli_query($conn, "SHOW COLUMNS FROM copydok_ebr");
$cols = [];
while($row = mysqli_fetch_assoc($res)){
    $cols[] = $row['Field'];
}
print_r($cols);

// Let's add missing columns if they don't exist
$alter_queries = [];
if(!in_array('kirim_status', $cols)) $alter_queries[] = "ADD COLUMN kirim_status VARCHAR(10) DEFAULT 'N'";
if(!in_array('sstatus', $cols)) $alter_queries[] = "ADD COLUMN sstatus VARCHAR(10) DEFAULT 'N'";
if(!in_array('tgl_kirimajuan', $cols)) $alter_queries[] = "ADD COLUMN tgl_kirimajuan DATE DEFAULT NULL";
if(!in_array('otgl_admin', $cols)) $alter_queries[] = "ADD COLUMN otgl_admin DATE DEFAULT NULL";
if(!in_array('otgl_slesai', $cols)) $alter_queries[] = "ADD COLUMN otgl_slesai DATE DEFAULT NULL";
if(!in_array('jenisms', $cols)) $alter_queries[] = "ADD COLUMN jenisms INT(11) DEFAULT 3";
if(!in_array('okepada', $cols)) $alter_queries[] = "ADD COLUMN okepada INT(11) DEFAULT 2";
if(!in_array('onmr', $cols)) $alter_queries[] = "ADD COLUMN onmr VARCHAR(50) DEFAULT NULL";

if(count($alter_queries) > 0){
    $alter_sql = "ALTER TABLE copydok_ebr " . implode(", ", $alter_queries);
    echo "\nExecuting: $alter_sql\n";
    if(mysqli_query($conn, $alter_sql)){
        echo "Columns added successfully!\n";
    } else {
        echo "Error adding columns: " . mysqli_error($conn) . "\n";
    }
} else {
    echo "\nAll columns already exist.\n";
}
?>
