<?php

include "phpqrcode/qrlib.php";

// create a QR Code with this text and display it
QRcode::png("$_GET[id]");

?>