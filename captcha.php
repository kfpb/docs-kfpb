<?php
session_start();
$font = 'Montserrat.ttf';
function acakCaptcha() {
    $alphabet = "0123456789";
   
//untuk menyatakan $pass sebagai array
$pass = array(); 
 
   //masukkan -2 dalam string length
    $panjangAlpha = strlen($alphabet) - 2; 
    for ($i = 0; $i < 5; $i++) {
        $n = rand(0, $panjangAlpha);
        $pass[] = $alphabet[$n];
    }
 
   //ubah array menjadi string
    return implode($pass); 
}
 
 // untuk mengacak captcha
$code = acakCaptcha();
$_SESSION["code"] = $code;
 
//lebar dan tinggi captcha
$wh = imagecreatetruecolor(150, 40);
 
//background color biru
$bgc = imagecolorallocate($wh, 20, 43, 80);
 
//text color abu-abu
$fc = imagecolorallocate($wh, 223, 230, 233);
imagefill($wh, 0, 0, $bgc);
 
//( $image , $fontsize , $string , $fontcolor )
imagettftext($wh, 25, 0, 10, 30, $fc, $font, $code);
// imagestring($wh, 20, 50, 15,  $code, $fc);
 
//buat gambar
header('content-type: image/jpg');
imagejpeg($wh);
imagedestroy($wh);
?>