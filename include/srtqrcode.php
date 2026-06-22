<?php

include "../phpqrcode/qrlib.php";

// create a QR Code with this text and display it
QRcode::png("https://ekfpb.com/bdg/smasuk/$_GET[id]");

?>