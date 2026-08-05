<?php
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("ekfpb_bnj", $conn);

$q=mysql_query("INSERT INTO linter(sitgl,
                                   sijam,
                                   sipengirim,
								   sipengirim1,
								   sipengirim2,
								   sipengirim3,
                                   siperihal,
								   sikomen,
								   sbnjrn,
                                   siket,
								   sstatus) 
	                     VALUES('2023-01-01',
	                            '12:00',
                                '1',
								'1',
								'1',
								'1',
								'Test perihal',
								'Test komen',
								'N',
								'Test ket',
								'N')", $conn);

if(!$q) {
    echo "ERROR: " . mysql_error($conn) . "\n";
} else {
    echo "SUCCESS\n";
    // Cleanup
    mysql_query("DELETE FROM linter WHERE siperihal='Test perihal'");
}
?>
