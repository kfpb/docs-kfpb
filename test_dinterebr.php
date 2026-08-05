<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$_SESSION['loginefile'] = 1;
$_SESSION['cv'] = 1000;
$_SESSION['namacv'] = 'test';
$_GET['pages'] = 'dinterebr';
$_SERVER['HTTP_USER_AGENT'] = 'TestAgent/1.0';

echo "=== TEST INCLUDE dinter_ebr.php ===\n";
include 'include/copy_ebr/dinter_ebr.php';
echo "\n=== SELESAI ===\n";
